<?php
class ModelPaymentPagseguro extends Controller {

	public function getMethod() {
		return array();
	}
	
	/* Captura token de autorização */
	public function captureToken() {
		
		if ($this->config->get('pagseguro_modo_teste')){
			$url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/sessions/';
		} else {
			$url = 'https://ws.pagseguro.uol.com.br/v2/sessions/';
		}
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
			'email' => $this->config->get('pagseguro_email'),
			'token' => $this->config->get('pagseguro_token')
		)));
		
		$response = curl_exec($ch);
		
		curl_close($ch);
		
		$this->session->data['xml'] = $url;
		
		$xml = simplexml_load_string($response);
		
		
		if (isset($xml->error)) {
			$this->log->write('PagSeguro Error: ' . $xml->error->code . ' - ' . $xml->error->message);
			return false;
		} else {
			return $xml->id;
		}
		
	}
	
	/* Envia os dados da transação par ao pagseguro  */
	public function transition($data) {
		
		if ($this->config->get('pagseguro_modo_teste')){
			$url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/';
		} else {
			$url = 'https://ws.pagseguro.uol.com.br/v2/transactions/';
		}
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		
		$response = curl_exec($ch);
		
		curl_close($ch);
		
		$xml = simplexml_load_string($response);
		
		if (isset($xml->error)){
			$json = array(
				'error' => $xml->error
			);
		} else {
			$json = $xml;
		}
		
		return $json;
	}
	
	/* Captura o tipo de frete (1 - PAC; 2 - Sedex; 3 - Outros) */
	public function getShippingType() {
		if(preg_match('/correios/', $this->session->data['shipping_method']['code'])) {
			if(preg_match('/(41106|41068)/', $this->session->data['shipping_method']['code'])) {
				return 1;
			} else {
				return 2;
			}
		} else {
			return 3;
		}
	}

	/* Captura o número da residência */
	public function getAddressNumber($custom_field) {
		if (array_key_exists($this->config->get('pagseguro_numero_residencia'), $custom_field)) {
			return $custom_field[$this->config->get('pagseguro_numero_residencia')];
		} else {
			return 0;
		}
	}

	/* Verifica as notificações */
	public function notification($notificationCode = false) {
		if ($notificationCode === false) {
			return false;
		}
		
		/* Verifica se está em modo de teste */
		if ($this->config->get('pagseguro_modo_teste')){
			$url = 'https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications/';
		} else {
			$url = 'https://ws.pagseguro.uol.com.br/v3/transactions/notifications/';
		}
		
		/* Captura o código da notificação */
		$url .= $notificationCode;
		
		/* Captura o E-mail do lojista */
		$url .= '?email=' . $this->config->get('pagseguro_email');
		
		/* Captura o token de acesso */
		$url .= '&token=' . $this->config->get('pagseguro_token');
		
		/* Envia uma requisição para obtenção dos dados */
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		$response = curl_exec($ch);
		
		curl_close($ch);
		
		$xml = simplexml_load_string($response);
		
		/* Verifica se há erros */
		if (!$xml->error) {
			return array(
				'order_id' => preg_replace('/[^0-9]/', '', $xml->reference),
				'status' => $xml->status
			);
		} else {
			$this->log->write('Falha na notificação do PagSeguro. Errr: ' . $xml->error->message);
			
			return false;
		}
		
	}
}