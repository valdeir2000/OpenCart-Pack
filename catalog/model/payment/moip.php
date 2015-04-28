<?php
class ModelPaymentMoip extends Model {
	public function getMethod($address, $total) {
		return array();
	}
	
	public function captureToken($data) {
		
		//Verifica se está em modo de teste
		if (!$this->config->get('moip_modo_teste')) {
        	$action     = 'https://www.moip.com.br/ws/alpha/EnviarInstrucao/Unica';
  		} else {
			$action     = 'https://desenvolvedor.moip.com.br/sandbox/ws/alpha/EnviarInstrucao/Unica';
		}
	
		// Inicia cURL
		$ch = curl_init();

		$header[] = "Authorization: Basic " . base64_encode($this->config->get('moip_token').':'.$this->config->get('moip_key'));
			
		// Seta opçoes e parâmetro
		$options = array(CURLOPT_URL => $action,
			CURLOPT_HTTPHEADER => $header,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => utf8_encode('
				<EnviarInstrucao>
					<InstrucaoUnica TipoValidacao="Transparente">
						<Razao>' . $this->config->get('moip_razao_pagamento') . '</Razao>
						<Valores>
							<Valor moeda="BRL">' . $data['amount'] . '</Valor>
						</Valores>
						<IdProprio>' . $data['order_id'] . '</IdProprio>
						<Pagador>
							<Nome>' . $data['firstname'] . ' ' . $data['lastname'] . '</Nome>
							<Email>' . $data['email'] . '</Email>
							<IdPagador>' . $data['customer_id'] . '</IdPagador>
							<EnderecoCobranca>
								<Logradouro>' . $data['address_1'] . '</Logradouro>
								<Numero>00</Numero>
								<Complemento>Desconhecido</Complemento>
								<Bairro>' . $data['address_2'] . '</Bairro>
								<Cidade>' . $data['city'] . '</Cidade>
								<Estado>' . $data['zone'] . '</Estado>
								<Pais>BRA</Pais>
								<CEP>' . $data['postcode'] . '</CEP>
								<TelefoneFixo>' . $data['telephone'] . '</TelefoneFixo>
							</EnderecoCobranca>
						</Pagador>
						<Boleto>
							<DiasExpiracao Tipo="Corridos">' . $this->config->get('moip_boleto_vencimento') . '</DiasExpiracao>
							<Instrucao1>' . $this->config->get('moip_boleto_instrucao_1') . '</Instrucao1>
							<Instrucao2>' . $this->config->get('moip_boleto_instrucao_2') . '</Instrucao2>
							<Instrucao3>' . $this->config->get('moip_boleto_instrucao_3') . '</Instrucao3>
							<URLLogo>' . $this->config->get('moip_boleto_logo') . '</URLLogo>
						</Boleto>
						<Mensagens>
							<Mensagem>' . $data['comment'] . '</Mensagem>
						</Mensagens>
						' . $this->parcelas() . '
					</InstrucaoUnica>
				</EnviarInstrucao>'),
			CURLOPT_RETURNTRANSFER => true
		);
		curl_setopt_array($ch, $options);
		
		// Executa cURL
		$response = curl_exec($ch);
		
		// Fecha coneçao cURL
		curl_close($ch);
		
		// Transforma string em elemento XML
		$xml = simplexml_load_string($response);
		
		// Acessa XML e pega "Token de Pagamento"
		if (isset($xml->Resposta->Erro))
			return $xml->Resposta->Erro;
		else
			return $xml->Resposta->Token;
	}

	public function parcelas() {
		$parcelas = $this->config->get('moip_parcela');
		
		$parcelamento  = '';
		
		if (!empty($parcelas)) {
			$parcelamento .= '<Parcelamentos>';
			
			foreach($parcelas as $parcela) {
				$parcelamento .= '	<Parcelamento>';
				$parcelamento .= '		<MinimoParcelas>' . $parcela['de'] . '</MinimoParcelas>';
				$parcelamento .= '		<MaximoParcelas>' . $parcela['para'] . '</MaximoParcelas>';
				$parcelamento .= '		<Juros>' . $parcela['juros'] . '</Juros>';
				$parcelamento .= '	</Parcelamento>';
			}
			$parcelamento .= '</Parcelamentos>';
		}
		
		return $parcelamento;
	}
	
	public function nasp($order_id, $order_status_id, $comment = '', $notify = false) {
		$this->load->model('checkout/order');	
			
		$this->model_checkout_order->addOrderHistory($order_id, $order_status_id, $comment, $notify);
	}

}