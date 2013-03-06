<?php
class ControllerPaymentAkatus extends Controller {
	protected function index() {
		
		/* Carrega o arquivo de linguagem */
		$this->load->language('payment/akatus');
		
		/* Botão Continuar */
		$this->data['button_continue'] = $this->language->get('button_continue');

		/* Aceita Cartão? */
		$this->data['accCartaoCredito'] = $this->config->get("akatus_accCartao");

		/* Aceita Débito? */
		$this->data['accDebito'] = $this->config->get("akatus_accDebito");

		/* Aceita Boleto? */
		$this->data['accBoleto'] = $this->config->get("akatus_accBoleto");
		
		/* Captura quantidade de parcelas aceitas */
		$this->data['qntParcelas'] = $this->config->get('akatus_parcelas');
		
		/* Verifica se é para exibi o valor total das parcelas */
		//Verifica se é para exibi o valor total das parcelas
		if ($this->config->get('akatus_valorTotalParcela') == '1'):
			$this->data['exibiTotalParcela'] =  '" = R$ " + data.resposta.parcelas[i].total ';
		else:
			$this->data['exibiTotalParcela'] =  "''";
		endif;
		
		/* Carrega as informações da compra */
		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
		
		/* Captura o id do cliente */
		$this->data['customer_id'] = $order_info['customer_id'];

		/* Captura o valor total da compra */
		$this->data['amount'] = $this->currency->format($order_info['total'], $order_info['currency_code'], FALSE);
		
		/* Captura telefone do cliente */
		$this->data['telephone'] = preg_replace('/[^0-9]/', '', $order_info['telephone']);
	
		/* Captura o nome completo do cliente */
		$this->data['nome'] = $order_info['firstname'] . ' ' . $order_info['lastname'];

		//Link de redirecionamento
		$this->data['continue'] = $this->url->link('checkout/success');
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/akatus.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/payment/akatus.tpl';
		} else {
			$this->template = 'default/template/payment/akatus.tpl';
		}	
		
		$this->render();
					
	}
	
	public function confirm() {
		$this->load->language('payment/akatus');
		$this->load->model('checkout/order');	
		$comment  = $this->language->get('text_instruction') . "\n\n";
		$comment .= $this->language->get('text_payment');
		$this->model_checkout_order->confirm($this->session->data['order_id'], $this->config->get('config_order_status_id'), $comment);
		
		if (isset($this->session->data['order_id'])) {
			$this->cart->clear();
			unset($this->session->data['shipping_method']);
			unset($this->session->data['shipping_methods']);
			unset($this->session->data['payment_method']);
			unset($this->session->data['payment_methods']);
			unset($this->session->data['comment']);
			unset($this->session->data['coupon']);
		}
		
	}
	
	public function salvarCartao () {
		//Carrega o model do MoiIP
		$this->load->model('payment/akatus');
		//Carrega a livraria de criptografia
		$this->load->library('criptografiacartao');
		//Instacia um novo objeto de criptografia
		$encryption = new CriptografiaCartao($this->config->get('config_encryption'));
		//Captura o id do cliente
		$dados['customer_id'] = $this->request->get['customer_id'];
		//Captura a bandeira do cartão
		$dados['bandeiraCartao'] = $encryption->encrypt($this->request->get['bandeiraCartao']);
		//Captura o nome do titular do cartão
		$dados['titularCartao'] = $encryption->encrypt($this->request->get['titularCartao']); 
		//Captura o número do cartão
		$dados['numeroCartao'] = $encryption->encrypt($this->request->get['numeroCartao']); 
		//Captura a data de validade do cartão
		$dados['validadeCartao'] = $encryption->encrypt($this->request->get['validadeCartao']); 
		//Captura o código de segurança do cartão
		$dados['codCartao'] = $encryption->encrypt($this->request->get['codCartao']); 
		//Captura a data de nascimento do titular
		$dados['nascimentoTitular'] = $encryption->encrypt($this->request->get['nascimentoTitular']); 
		//Captura o telefone do titular
		$dados['telefone'] = $encryption->encrypt($this->request->get['telefone']); 
		//Captura o cpf do titular
		$dados['cpf'] = $encryption->encrypt($this->request->get['cpf']);
		//Salva os dados do Cartão
		$this->model_payment_akatus->salvarCartao($dados);
	}
	
	public function getCartao () {
		//Carrega o model do MoIP
		$this->load->model('payment/akatus');
		//Captura os dados do cartão escolhido
		$resultado = $this->model_payment_akatus->getCartao($this->request->get['customer_id'],$this->request->get['bandeira']);
		//Verifica se foi localizado
		if (isset($resultado['localizado']) && $resultado['localizado'] === 'sim'):
			echo json_encode($resultado);
		else:
			echo json_encode(array('error' => 'Nao Localizado'));
		endif;
	}
	
	private function format_money($total){
		if (!preg_match('/[.]/', $total)){
			return $total.'.00';
		}else{
			if(strlen($total)>2){
				$n=strlen($total)-2;
				$preco=substr($total,0,$n).".".substr($total,$n);
				return $preco;
			}else{
				return $total;
			}
		}
	}
	
	private function removeAcentos ($value) {
		$acentos = array('Á','À','Â','Ã','É','Ê','Í','Ó','Ô','Õ','Ú','Ç','á','à','â','ã','é','ê','í','ó','ô','õ','ú','ç','æ');
		$sAcentos = array('A','A','A','A','E','E','I','O','O','O','U','C','a','a','a','a','e','e','i','o','o','o','u','c','AE');
		
		return str_replace($acentos, $sAcentos, $value);
	}
	
	private function somenteNumero ($value) {
		return preg_replace('/[^0-9]/', '', $value);
	}
	
	public function pagar(){
	
		/* Carrega model order */
		$this->load->model('checkout/order');
		
		/* Captura os dados da compra */
		$order_info = $this->load->model_checkout_order->getOrder($this->session->data['order_id']);
		
		/* Carrega model do akatus */
		$this->load->model('payment/akatus');
		
		/* Captura total, sub-total e valor do frete */
		$order_totals = $this->load->model_payment_akatus->getOrderTotals($this->session->data['order_id']);
		foreach ($order_totals as $order_total){
			if ($order_total['code'] == 'shipping'){
				$valorTotalFrete = $order_total['value'];
			}
		}
		
		/* Carrega model country */
		$this->load->model('localisation/country');
		
		/* Captura todos os paises */
        $paises = $this->model_localisation_country->getCountries();		
		foreach ($paises as $country) {
			if($country['name']==$order_info['payment_country']){
				$codigodopais = $country['country_id'];
			}
		}
		
		/* Carrega model zone */
		$this->load->model('localisation/zone');
		
		/* Com id do país pega o code da cidade */
		$results = $this->model_localisation_zone->getZonesByCountryId($codigodopais);
   
		foreach ($results as $result) {
			if($result['name']==$order_info['payment_zone']){
				$estado =$result['code'];
			}
		}
		
		/* Inicio do XML */
		$codCartao  = '<carrinho>';
		$codCartao .= '	<recebedor>';
		/* Api Key do lojista */
		$codCartao .= '		<api_key>' . $this->config->get('akatus_apiKey') . '</api_key>';
		/* Email do lojista */
		$codCartao .= '		<email>' . $this->config->get('akatus_email') . '</email>';
		$codCartao .= '	</recebedor>';
		$codCartao .= '	<pagador>';
		/* Nome do Cliente */
		$codCartao .= '		<nome>' . $this->removeAcentos($order_info['firstname'] . ' ' . $order_info['lastname']) . '</nome>';
		/* E-mail do cliente */
		$codCartao .= '		<email>' . $order_info['email'] . '</email>';
		/* Verifica se o endereço é obrigatório */
		if ($this->cart->hasShipping()){
		$codCartao .= '		<enderecos>';
		$codCartao .= '			<endereco>';
		/* Captura o tipo de endereço: Entrega ou Comercial */
		$codCartao .= '				<tipo>' . $this->request->post['endereco_tipo'] . '</tipo>';
		/* Captura o endereço do cliente */
		$codCartao .= '				<logradouro>' . $this->removeAcentos($order_info['payment_address_1']) . '</logradouro>';
		/* Número da residência do cliente - Campo inexistente no OpenCart */
		$codCartao .= '				<numero>00</numero>';
		/* Captura o bairro do cliente */
		$codCartao .= '				<bairro>' . $this->removeAcentos($order_info['payment_address_2']) . '</bairro>';
		/* Captura a cidade do cliente */
		$codCartao .= '				<cidade>' . $this->removeAcentos($order_info['payment_city']) . '</cidade>';
		/* Captura o estado do cliente */
		$codCartao .= '				<estado>' . $estado . '</estado>';
		/* O Akatus aceita apenas o BRA */
		$codCartao .= '				<pais>BRA</pais>';
		/* Captura o CEP do cliente */
		$codCartao .= '				<cep>' . $order_info['payment_postcode'] . '</cep>';
		$codCartao .= '			</endereco>';
		$codCartao .= '		</enderecos>';
		}
		$codCartao .= '		<telefones>';
		$codCartao .= '			<telefone>';
		/* Captura o tipo de telefone: Residencial, Celular ou Comercial */
		$codCartao .= '				<tipo>' . $this->request->post['telefone_tipo'] . '</tipo>';
		/* Captura o número do telefone */
		$codCartao .= '				<numero>' . $this->request->post['telefone'] . '</numero>';
		$codCartao .= '			</telefone>';
		$codCartao .= '		</telefones>';
		$codCartao .= '	</pagador>';
		$codCartao .= '	<produtos>';
		/* Captura todos os produtos do carrinho */
		foreach ($this->cart->getProducts() as $product){
		$codCartao .= '		<produto>';
		/* Captura o ID do produto */
		$codCartao .= '			<codigo>' . $product['product_id'] . '</codigo>';
		/* Captura o nome e modelo do produto */
		$codCartao .= '			<descricao>Nome: ' . $this->removeAcentos($product['name']) . ' / Modelo: ' . $this->removeAcentos($product['model']) . '</descricao>';
		/* Captura a quantidade do produto */
		$codCartao .= '			<quantidade>' . $product['quantity'] . '</quantidade>';
		/* Captura o preço do produto */
		$codCartao .= '			<preco>' . number_format($this->currency->convert($this->format_money($product['price']), $order_info['currency_code'], 'BRL'), 2, '.', '') . '</preco>';
		/* Peso do Produto */
		$codCartao .= '			<peso>0.0</peso>';
		/* Frete do Produto */
		$codCartao .= '			<frete>0.00</frete>';
		/* Desconto do Produto */
		$codCartao .= '			<desconto>0.00</desconto>';
		$codCartao .= '		</produto>';
		}
		$codCartao .= '	</produtos>';
		/* Dados da transação */
		$codCartao .= '	<transacao>';
		/* Número do cartão */
		$codCartao .= '		<numero>' . $this->request->post['numero'] . '</numero>';
		/* Quantidade de parcelas */
		$codCartao .= '		<parcelas>' . $this->request->post['parcelas'] . '</parcelas>';
		/* Código de segurança do cartão */
		$codCartao .= '		<codigo_de_seguranca>' . $this->request->post['codigo_de_seguranca'] . '</codigo_de_seguranca>';
		/* Data de expiração do cartão */
		$codCartao .= '		<expiracao>' . $this->request->post['expiracao'] . '</expiracao>';
		/* Desconto na forma de pagamento */
		$codCartao .= '		<desconto>' . $this->config->get('akatus_descontoCartao') . '</desconto>';
		/* Pedo total dos produtos */
		$codCartao .= '		<peso_total>' . $this->cart->getWeight() . '</peso_total>';
		/* Frete total dos produtos */
		if ($this->cart->hasShipping()){
		$codCartao .= '		<frete>' . number_format($this->currency->convert($valorTotalFrete, $order_info['currency_code'], 'BRL'), 2, '.', '') . '</frete>';
		}
		/* Moeda - O Akatus aceita somente o real brasileiro */
		$codCartao .= '		<moeda>BRL</moeda>';
		/* Comentário da compra */
		$codCartao .= '		<referencia>' . $order_info['comment'] . '</referencia>';
		/* Cartão utilizado */
		$codCartao .= '		<meio_de_pagamento>' . strtolower($this->request->post['meio_de_pagamento']) . '</meio_de_pagamento>';
		/* Dados do portador */
		$codCartao .= '		<portador>';
		/* Nome do portador */
		$codCartao .= '			<nome>' . $this->request->post['nome'] . '</nome>';
		/* CPF do portador */
		$codCartao .= '			<cpf>' . $this->request->post['cpf'] . '</cpf>';
		/* Telefone do portador */
		$codCartao .= '			<telefone>' . $this->request->post['telefone'] . '</telefone>';
		$codCartao .= '		</portador>';
		$codCartao .= '	</transacao>';
		$codCartao .= '</carrinho>';
		
		//Calcula desconto no preço total do pedido
		$precoTotal = $order_info['total']-$this->config->get('akatus_descontoBoleto');
		
		//Verifica se o valor total do pedido é negativo
		if ($precoTotal < 0) {
			$precoTotal = 0;
		}
		
		//Aplica o novo valor ao banco de dados
		$this->db->query("UPDATE `" . DB_PREFIX . "order` SET total = '" . $precoTotal . "', date_modified = NOW() WHERE order_id = '" . (int)$this->session->data['order_id'] . "'");
		
		// Inicia cURL
		$ch = curl_init();
			
		// Seta opçoes e parâmetro
		$options = array(CURLOPT_URL => 'https://www.akatus.com/api/v1/carrinho.xml',
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_SSL_VERIFYPEER => 0,
			CURLOPT_POST => true,
			CURLOPT_HTTPHEADER => array('Content-Type: text/xml'),
			CURLOPT_POSTFIELDS => utf8_encode($codCartao),
			CURLOPT_RETURNTRANSFER => true
		);
		curl_setopt_array($ch, $options);
		
		// Executa cURL
		$response = curl_exec($ch);
		
		// Fecha coneçao cURL
		curl_close($ch);
		
		$xml = simplexml_load_string($response);
		
		if ($xml->status != 'erro'){
			$this->salvarDadosDaCompra($this->session->data['order_id'], $xml->transacao);
			$this->confirm();
		}
		
		echo json_encode($xml);
		
	}
	
	public function processaPagto(){
		/* Carrega model order */
		$this->load->model('checkout/order');
		
		/* Captura os dados da compra */
		$order_info = $this->load->model_checkout_order->getOrder($this->session->data['order_id']);
		
		/* Carrega model do akatus */
		$this->load->model('payment/akatus');
		
		/* Captura total, sub-total e valor do frete */
		$order_totals = $this->load->model_payment_akatus->getOrderTotals($this->session->data['order_id']);
		foreach ($order_totals as $order_total){
			if ($order_total['code'] == 'shipping'){
				$valorTotalFrete = $order_total['value'];
			}
		}
		
		/* Carrega model country */
		$this->load->model('localisation/country');
		
		/* Captura todos os paises */
        $paises = $this->model_localisation_country->getCountries();		
		foreach ($paises as $country) {
			if($country['name']==$order_info['payment_country']){
				$codigodopais = $country['country_id'];
			}
		}
		
		/* Carrega model zone */
		$this->load->model('localisation/zone');
		
		/* Com id do país pega o code da cidade */
		$results = $this->model_localisation_zone->getZonesByCountryId($codigodopais);
   
		foreach ($results as $result) {
			if($result['name']==$order_info['payment_zone']){
				$estado =$result['code'];
			}
		}
		
		/* Inicio do XML */
		$codCartao  = '<carrinho>';
		$codCartao .= '	<recebedor>';
		/* Api Key do lojista */
		$codCartao .= '		<api_key>' . $this->config->get('akatus_apiKey') . '</api_key>';
		/* Email do lojista */
		$codCartao .= '		<email>' . $this->config->get('akatus_email') . '</email>';
		$codCartao .= '	</recebedor>';
		$codCartao .= '	<pagador>';
		/* Nome do Cliente */
		$codCartao .= '		<nome>' . $this->removeAcentos($order_info['firstname'] . ' ' . $order_info['lastname']) . '</nome>';
		/* E-mail do cliente */
		$codCartao .= '		<email>' . $order_info['email'] . '</email>';
		/* Verifica se o endereço é obrigatório */
		if ($this->cart->hasShipping()){
		$codCartao .= '		<enderecos>';
		$codCartao .= '			<endereco>';
		/* Captura o tipo de endereço: Entrega ou Comercial */
		$codCartao .= '				<tipo>' . $this->request->post['endereco_tipo'] . '</tipo>';
		/* Captura o endereço do cliente */
		$codCartao .= '				<logradouro>' . $this->removeAcentos($order_info['payment_address_1']) . '</logradouro>';
		/* Número da residência do cliente - Campo inexistente no OpenCart */
		$codCartao .= '				<numero>00</numero>';
		/* Captura o bairro do cliente */
		$codCartao .= '				<bairro>' . $this->removeAcentos($order_info['payment_address_2']) . '</bairro>';
		/* Captura a cidade do cliente */
		$codCartao .= '				<cidade>' . $this->removeAcentos($order_info['payment_city']) . '</cidade>';
		/* Captura o estado do cliente */
		$codCartao .= '				<estado>' . $estado . '</estado>';
		/* O Akatus aceita apenas o BRA */
		$codCartao .= '				<pais>BRA</pais>';
		/* Captura o CEP do cliente */
		$codCartao .= '				<cep>' . $order_info['payment_postcode'] . '</cep>';
		$codCartao .= '			</endereco>';
		$codCartao .= '		</enderecos>';
		}
		$codCartao .= '		<telefones>';
		$codCartao .= '			<telefone>';
		/* Captura o tipo de telefone: Residencial, Celular ou Comercial */
		$codCartao .= '				<tipo>' . $this->request->post['telefone_tipo'] . '</tipo>';
		/* Captura o número do telefone */
		$codCartao .= '				<numero>' . $this->request->post['telefone'] . '</numero>';
		$codCartao .= '			</telefone>';
		$codCartao .= '		</telefones>';
		$codCartao .= '	</pagador>';
		$codCartao .= '	<produtos>';
		/* Captura todos os produtos do carrinho */
		foreach ($this->cart->getProducts() as $product){
		$codCartao .= '		<produto>';
		/* Captura o ID do produto */
		$codCartao .= '			<codigo>' . $product['product_id'] . '</codigo>';
		/* Captura o nome e modelo do produto */
		$codCartao .= '			<descricao>Nome: ' . $this->removeAcentos($product['name']) . ' / Modelo: ' . $this->removeAcentos($product['model']) . '</descricao>';
		/* Captura a quantidade do produto */
		$codCartao .= '			<quantidade>' . $product['quantity'] . '</quantidade>';
		/* Captura o preço do produto */
		$codCartao .= '			<preco>' . number_format($product['price'], 2, '.', '') . '</preco>';
		/* Peso do Produto*/
		$codCartao .= '			<peso>0.0</peso>';
		/* Frete do Produto */
		$codCartao .= '			<frete>0.0</frete>';
		/* Desconto do Produto */
		$codCartao .= '			<desconto>0.0</desconto>';
		$codCartao .= '		</produto>';
		}
		$codCartao .= '	</produtos>';
		/* Dados da transação */
		$codCartao .= '	<transacao>';
		/* Verifica se o meio de pagamento é boleto */
		if ($this->request->post['meio_de_pagamento'] == 'boleto'){
		/* Caso sim, aplica o desconto do boleto */
		$codCartao .= '		<desconto>' . $this->config->get('akatus_descontoBoleto') . '</desconto>';
		}else{
		/* Caso não, aplica o desconto do débito */
		$codCartao .= '		<desconto>' . $this->config->get('akatus_descontoDebito') . '</desconto>';
		}
		/* Captura o peso total do carrinho */
		$codCartao .= '		<peso_total>' . $this->cart->getWeight() . '</peso_total>';
		/* Verifica se é necessário frete */
		if ($this->cart->hasShipping()){
		$codCartao .= '		<frete>' . number_format($this->currency->convert($valorTotalFrete, $order_info['currency_code'], 'BRL'), 2, '.', '') . '</frete>';
		}
		/* Define moeda no Akatus - A akatus só aceita BRL */
		$codCartao .= '		<moeda>BRL</moeda>';
		/* Capturao  comentário do pedido */
		$codCartao .= '		<referencia>' . $order_info['comment'] . '</referencia>';
		/* Captura o meio de pagamento */
		$codCartao .= '		<meio_de_pagamento>' . $this->request->post['meio_de_pagamento'] . '</meio_de_pagamento>';
		$codCartao .= '	</transacao>';
		$codCartao .= '</carrinho>';
		
		//Calcula desconto no preço total do pedido
		$precoTotal = $order_info['total']-$this->config->get('akatus_descontoBoleto');
		
		//Verifica se o valor total do pedido é negativo
		if ($precoTotal < 0) {
			$precoTotal = 0;
		}
		
		//Aplica o novo valor ao banco de dados
		$this->db->query("UPDATE `" . DB_PREFIX . "order` SET total = '" . $precoTotal . "', date_modified = NOW() WHERE order_id = '" . (int)$this->session->data['order_id'] . "'");
		
		// Inicia cURL145.82
		$ch = curl_init();
			
		// Seta opçoes e parâmetro
		$options = array(CURLOPT_URL => 'https://www.akatus.com/api/v1/carrinho.xml',
			CURLOPT_POST => true,
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_SSL_VERIFYPEER => 0,
			CURLOPT_HTTPHEADER => array('Content-Type: text/xml'),
			CURLOPT_POSTFIELDS => utf8_encode($codCartao),
			CURLOPT_RETURNTRANSFER => true
		);
		curl_setopt_array($ch, $options);
		
		// Executa cURL
		$response = curl_exec($ch);
		
		// Fecha coneçao cURL
		curl_close($ch);
		
		$xml = simplexml_load_string($response);
		
		if ($xml->status != 'erro'){
			$this->salvarDadosDaCompra($this->session->data['order_id'], $xml->transacao);
			$this->confirm();
		}
		
		echo json_encode($xml);
	}

	public function parcelas (){
		/* Carrega model de compra */
		$this->load->model('checkout/order');
		
		/* Captura bandeira do cartão */
		$payment_method = $this->request->get['payment_method'];
		
		/* Captura a Api Key do lojista */
		$apikey = $this->config->get('akatus_apiKey');
		
		/* Captura o email do lojista */
		$email = $this->config->get('akatus_email');
		
		/* Captura informações da compra */
		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
		
		/* Captura o desconto do cartão de crédito */
		$amount = $order_info['total']-$this->config->get('akatus_descontoCartao');
		
		/* Captura os parcelamentos */
		$url = "http://www.akatus.com/api/v1/parcelamento/simulacao.json?email={$email}&amount={$amount}&payment_method={$payment_method}&api_key={$apikey}";
		
		// Inicia cURL145.82
		$ch = curl_init();
			
		// Seta opçoes e parâmetro
		$options = array(CURLOPT_URL => $url,
			CURLOPT_FOLLOWLOCATION  => 1,
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_SSL_VERIFYPEER => 0,
			CURLOPT_RETURNTRANSFER => true
		);
		curl_setopt_array($ch, $options);
		
		// Executa cURL
		$response = curl_exec($ch);
		
		// Fecha coneçao cURL
		curl_close($ch);

		echo $response;
		
	}
	
	public function salvarDadosDaCompra($order_id, $transacao_id){
		$this->db->query('INSERT INTO ' . DB_PREFIX . 'nip (order_id, transacao_id) VALUES ("' . $order_id . '", "' . $transacao_id . '")');
	}
}