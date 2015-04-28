<?php
class ControllerPaymentPagamentoDigital extends Controller {
 	public function index() {
			
		$this->language->load('payment/pagamento_digital');
		
		$data['text_title'] = $this->language->get('text_title');
		
	    $data['button_confirm'] = $this->language->get('button_confirm_bcash');
	    $data['action'] = 'https://www.bcash.com.br/checkout/pay/';
		
    	$this->load->model('checkout/order');
	    $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);			
	    
	    // valor do frete será 0 pois o módulo enviará de forma diferente este valor para o Pagamento Digital
	   	$data['shipping_total'] = 0;
	    
	    $data['products'] = array();
		
		$this->load->model('tool/upload');
	    	
	    foreach ($this->cart->getProducts() as $product) {
			
			$options_names = array();
			$model = ($product['model'] != '') ? ' | Modelo: ' . $product['model'] : '';
	    
	    	foreach ($product['option'] as $option) {
				if ($option['type'] != 'file') {
					$value = $option['value'];
				} else {
					$upload_info = $this->model_tool_upload->getUploadByCode($option['value']);

					if ($upload_info) {
						$value = $upload_info['name'];
					} else {
						$value = '';
					}
				}
				$options_names[] = $option['name'] . ": " . (utf8_strlen($value) > 20 ? utf8_substr($value, 0, 20) . '..' : $value);
	    	}
			
			if(!empty($options_names)){
				$options = " | Opções= " . implode(', ', $options_names);
			}
			else{
				$options = '';
			}			
	    
	    	$data['products'][] = array(
	    		'product_id'=> $product['product_id'],
				'name'     => htmlspecialchars($product['name'] . $model . $options),
				// uso do 'convert' ao invés do 'format' preserva o número de dígitos após a vírgula que evita o problema de arredondamento no Bcash
	    		'value'     => $this->currency->convert($product['price'], $this->config->get('config_currency'), $order_info['currency_code']),
    			'quantity' 	=> $product['quantity']
	    	);
	    }
		
	    // obtendo frete, descontos e taxas
	    $data['discount_total'] = 0;
		 
		$total = $this->currency->format($order_info['total'] - $this->cart->getSubTotal(), $order_info['currency_code'], false, false);

		if ($total > 0) {
	    	$data['products'][] = Array(
				'product_id' 	=> '-',
				'name' 			=> $this->language->get('text_extra_amount'),
				'value' 		=> $total,
				'quantity' 		=> 1
			);
		} 
		else{
			$data['discount_total'] = $total * (-1);
		} 		
	    
	    $data['email_loja']    		= $this->config->get('pagamento_digital_email');
		$data['usar_iframe']   		= $this->config->get('pagamento_digital_usar_iframe');
		$data['validar_dados'] 		= $this->config->get('pagamento_digital_validar_dados');
		$data['tipo_integracao'] 	= "PAD";
		$data['redirect'] 			= "true";
		$data['redirect_time'] 		= 10;
	    
	    if($this->config->get('pagamento_digital_posfixo') != ""){
	    	$data['id_pedido'] = $this->session->data['order_id']."_".$this->config->get('pagamento_digital_posfixo');
	    }
	    else{
	    	$data['id_pedido'] = $this->session->data['order_id'];
	    }
	    
	    $data['url_retorno'] = $this->url->link('payment/pagamento_digital/success');
		$data['url_aviso'] = $this->url->link('payment/pagamento_digital/callback');
		$data['url_payment'] = $this->url->link('payment/pagamento_digital/payment');
		
		$this->load->model('localisation/zone');
		
		$data['estado'] = '';
	    
	   	if ($this->cart->hasShipping()) {

			$zone = $this->model_localisation_zone->getZone($order_info['shipping_zone_id']);
			
		    $data['nome'] = html_entity_decode($order_info['shipping_firstname'].' '.$order_info['shipping_lastname'], ENT_QUOTES, 'UTF-8');
		    $data['endereco'] = html_entity_decode($order_info['shipping_address_1'], ENT_QUOTES, 'UTF-8');
			$data['bairro'] = html_entity_decode($order_info['shipping_address_2'], ENT_QUOTES, 'UTF-8');
		    $data['cidade'] = html_entity_decode($order_info['shipping_city'], ENT_QUOTES, 'UTF-8');
		    $data['cep'] = preg_replace ("/[^0-9]/", '', $order_info['shipping_postcode']);
	    	$data['email'] = html_entity_decode($order_info['email'], ENT_QUOTES, 'UTF-8');
	    	$data['telefone'] = html_entity_decode($order_info['telephone'], ENT_QUOTES, 'UTF-8');
			
	    	if (isset($zone['code'])) {
	    		$data['estado'] = html_entity_decode($zone['code'], ENT_QUOTES, 'UTF-8');
	    	}
		}
		else{
			$zone = $this->model_localisation_zone->getZone($order_info['payment_zone_id']);
			
		    $data['nome'] = html_entity_decode($order_info['payment_firstname'].' '.$order_info['payment_lastname'], ENT_QUOTES, 'UTF-8');
		    $data['endereco'] = html_entity_decode($order_info['payment_address_1'], ENT_QUOTES, 'UTF-8');
			$data['bairro'] = html_entity_decode($order_info['payment_address_2'], ENT_QUOTES, 'UTF-8');
		    $data['cidade'] = html_entity_decode($order_info['payment_city'], ENT_QUOTES, 'UTF-8');
		    $data['cep'] = preg_replace ("/[^0-9]/", '', $order_info['payment_postcode']);
	    	$data['email'] = html_entity_decode($order_info['email'], ENT_QUOTES, 'UTF-8');
	    	$data['telefone'] = html_entity_decode($order_info['telephone'], ENT_QUOTES, 'UTF-8');
			
	    	if (isset($zone['code'])) {
	    		$data['estado'] = html_entity_decode($zone['code'], ENT_QUOTES, 'UTF-8');
	    	}
		}
		$data["data_hash"] = "";
		
		if ($data['validar_dados']){
			$data_for_hash = array();
			
			$data_for_hash['email_loja']	  	= $data['email_loja'];
			$data_for_hash['tipo_integracao'] 	= $data['tipo_integracao'];
			$data_for_hash['frete'] 		  	= $data['shipping_total'];
			$data_for_hash['id_pedido']   		= $data['id_pedido'];
			$data_for_hash['redirect']    		= $data['redirect'];
			$data_for_hash['redirect_time']    	= $data['redirect_time'];
			$data_for_hash['url_retorno'] 		= $data['url_retorno'];
			$data_for_hash['url_aviso'] 		= $data['url_aviso'];
			
			if($data['discount_total']) {
				$data_for_hash['desconto'] 		= $data['discount_total'];
			}
		    
			$data_for_hash['nome'] 		= $data['nome'];
		    $data_for_hash['endereco'] 	= $data['endereco'];
			$data_for_hash['bairro'] 	= $data['bairro'];
		    $data_for_hash['cidade'] 	= $data['cidade'];
		    $data_for_hash['cep'] 		= $data['cep'];
	    	$data_for_hash['email'] 	= $data['email'];
	    	$data_for_hash['telefone']  = $data['telefone'];
			$data_for_hash['estado'] 	= $data['estado'];			

			$i = 1;
			foreach ($data['products'] as $product) {
				$data_for_hash["produto_codigo_" . $i]    = $product['product_id'];
				$data_for_hash["produto_descricao_" . $i] = $product['name'];
				$data_for_hash["produto_qtde_" . $i] 	  = $product['quantity'];
				$data_for_hash["produto_valor_" . $i] 	  = $product['value'];				

				$i++;
			}
			ksort($data_for_hash);

			$data_param	  = http_build_query($data_for_hash) . $this->config->get('pagamento_digital_token');

			$data["data_hash"] = md5($data_param);
		}		

		$this->session->data['bcash_data'] = $data;		
	    
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/pagamento_digital.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/payment/pagamento_digital.tpl', $data);
		} else {
			return $this->load->view('default/template/payment/pagamento_digital.tpl', $data);
		}
	}

	public function confirm() {
		if ($this->session->data['payment_method']['code'] == 'pagamento_digital') {
			$this->load->model('checkout/order');

			$this->model_checkout_order->addOrderHistory($this->session->data['order_id'], $this->config->get('config_order_status_id'));
		}
	}
	
 	public function payment() {
		$html = "";
		
		if ($this->session->data['payment_method']['code'] == 'pagamento_digital') {
			$this->load->model('checkout/order');

			$this->model_checkout_order->addOrderHistory($this->session->data['order_id'], $this->config->get('config_order_status_id'));

			$this->language->load('payment/pagamento_digital');
			
			$data['text_title'] = $this->language->get('text_title');
			
			$data['url_iframe']  = $this->url->link('payment/pagamento_digital/iframe');
			
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/pagamento_digital_form.tpl')) {
				$html = $this->load->view($this->config->get('config_template') . '/template/payment/pagamento_digital_form.tpl', $data);
			} else {
				$html = $this->load->view('default/template/payment/pagamento_digital_form.tpl', $data);
			}	
		}
		$this->response->setOutput($html);
	}

 	public function iframe() {
		
		if(isset($this->session->data['bcash_data'])) {
			$data = $this->session->data['bcash_data'];
			
			$this->language->load('payment/pagamento_digital');
			
			$data['text_title'] = $this->language->get('text_title');
			
			$data['action'] = 'https://www.bcash.com.br/checkout/pay/';
			
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/pagamento_digital_iframe.tpl')) {
				$html = $this->load->view($this->config->get('config_template') . '/template/payment/pagamento_digital_iframe.tpl', $data);
			} else {
				$html = $this->load->view('default/template/payment/pagamento_digital_iframe.tpl', $data);
			}	
			
			$this->response->setOutput($html);
		}
	}	
		
	public function callback() {
	
		if (!isset($_POST)) {
			$this->log->write('Bcash :: erro ao obter os dados de aviso!');
			$id_transacao = 0;
		}
		else {
			$token 			= $this->config->get('pagamento_digital_token');
			$email_loja 	= $this->config->get('pagamento_digital_email');
			$tipo_retorno	= 2; // 1 – XML (padrão) ou 2 – JSON
			$codificacao 	= 1; // 1- UTF-8 (padrão) ou 2 – ISO–8859–1			
			
			if(isset($_POST['transacao_id'])){
				$id_transacao = $_POST['transacao_id'];
			}
			else if (isset($_POST['id_transacao'])){
				$id_transacao = $_POST['id_transacao'];
			}
		}

		if($id_transacao) {
		
		    $post_fields = array('id_transacao' => $id_transacao, 'tipo_retorno' => $tipo_retorno, 'codificacao' => $codificacao);	
			$http_header = array("Authorization: Basic " . base64_encode($email_loja. ':' . $token));
		
			ob_start();
			
			$curl = curl_init(); 
			curl_setopt($curl, CURLOPT_URL, 'https://www.bcash.com.br/transacao/consulta/');
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $post_fields);
			curl_setopt($curl, CURLOPT_HTTPHEADER, $http_header);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
			curl_exec ($curl);
			$response = ob_get_contents(); 
			
			ob_end_clean(); 

			$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
			
			curl_close($curl);

			$data = json_decode($response, true);

		    if(isset($http_code) && $http_code == "200"){
			
				$update_status_alert = $this->config->get('pagamento_digital_update_status_alert');
		
				$cod_status      = $data['transacao']['cod_status'];
				$status			 = $data['transacao']['status'];
				$meio_pagamento  = $data['transacao']['meio_pagamento'];
				$parcelas        = $data['transacao']['parcelas'];
				$valor_total     = $data['transacao']['valor_total'];
				$id_pedido 		 = explode('_', $data['transacao']['id_pedido']);
				$data_credito    = $data['transacao']['data_credito'];
				$data_alteracao_status = $data['transacao']['data_alteracao_status'];
				
				$this->load->model('checkout/order');
				$order = $this->model_checkout_order->getOrder($id_pedido[0]);

				$comment = "Atualizado em: " . $data_alteracao_status . "\nStatus atual: " . $status;				
				$comment_aprovado = "Forma de pagamento escolhida: " . $meio_pagamento . "\nParcelas: " . $parcelas . "\nTotal a pagar no Bcash: ". $this->currency->format($valor_total);				
				
				if($order) {
					switch($cod_status){
			
						case 1:
							if($order['order_status_id'] != $this->config->get('pagamento_digital_order_andamento')){
								$this->model_checkout_order->addOrderHistory($id_pedido[0], $this->config->get('pagamento_digital_order_andamento'), $comment, $update_status_alert);
							}
							break;
										
						case 3:
							if($order['order_status_id'] != $this->config->get('pagamento_digital_order_aprovado')){
								$this->model_checkout_order->addOrderHistory($id_pedido[0], $this->config->get('pagamento_digital_order_aprovado'), $comment_aprovado, $update_status_alert);
							}
							break;
						
						case 4:
							if($order['order_status_id'] != $this->config->get('pagamento_digital_order_concluido')){
								if(date('d/m/Y') != $data_credito) {
									$this->model_checkout_order->addOrderHistory($id_pedido[0], $this->config->get('pagamento_digital_order_concluido'), $comment, $update_status_alert);
								}
							}
							break;
							
						case 5:
							if($order['order_status_id'] != $this->config->get('pagamento_digital_order_disputa')){
								$this->model_checkout_order->addOrderHistory($id_pedido[0], $this->config->get('pagamento_digital_order_disputa'), $comment, $update_status_alert);
							}
							break;
						
						case 6:
							if($order['order_status_id'] != $this->config->get('pagamento_digital_order_devolvido')){
								$this->model_checkout_order->addOrderHistory($id_pedido[0], $this->config->get('pagamento_digital_order_devolvido'), $comment, $update_status_alert);
							}
							break;
						
						case 7:
							if($order['order_status_id'] != $this->config->get('pagamento_digital_order_cancelado')){
								$this->model_checkout_order->addOrderHistory($id_pedido[0], $this->config->get('pagamento_digital_order_cancelado'), $comment, $update_status_alert);
							}
							break;
							
						case 8:
							if($order['order_status_id'] != $this->config->get('pagamento_digital_order_chargeback')){
								$this->model_checkout_order->addOrderHistory($id_pedido[0], $this->config->get('pagamento_digital_order_chargeback'), $comment, $update_status_alert);
							}
							break;
					}
				}
				else{
					$this->log->write('Bcash :: Pedido número '. $id_pedido[0] . ' não encontrado para atualização do status');
				}				
			}
			else{
				$this->log->write('Bcash ::  Erro: '. $data['erro']['descricao']);
			}
		}
		else{
			$this->log->write('Bcash :: ID de transação incorreto: ' . $id_transacao);
		}
	}
	
	public function success() {

		unset($this->session->data['bcash_data']);
		
		$redirect = $this->url->link('checkout/success');
		
		$output = '<script type="text/javascript">top.location.href = "' . $redirect . '"</script>';
		
		$this->response->setOutput($output);
	}	
}
?>
