<?php
class ControllerPaymentPagseguroCartao extends Controller {
	
	public function index() {
	
		$data = array();
		
		/* Models */
		$this->load->model('payment/pagseguro');
		$this->load->model('checkout/order');
		
		/* Informações do Pedido */
		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
		
		/* Token */
		$session_id = $this->model_payment_pagseguro->captureToken();
		
		if ($session_id === false) {
			$data['session_id'] = $this->model_payment_pagseguro->captureToken();
		} else {
			$data['session_id'] = $session_id;
		}
		
		/* Total */
		$data['total'] = (float)number_format($order_info['total'], 2, '.', '');
		
		/* Quantidade de Parcelas */
		$data['qntParcelas'] = (int)$this->config->get('pagseguro_qnt_parcelas');
		
		/* Quantidade parcelas sem juros */
		$data['max_parcelas_sem_juros'] = (int)$this->config->get('pagseguro_parcelas_sem_juros');
		
		/* Link */
		$data['continue'] = $this->url->link('checkout/success', '', 'SSL');
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/pagseguro_cartao.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/payment/pagseguro_cartao.tpl', $data);
		} else {
			return $this->load->view('default/template/payment/pagseguro_cartao.tpl', $data);
		}
		
	}
	
	public function transition() {
		
		/* ID do Pedido */
		$order_id = $this->session->data['order_id'];
		
		/* Models */
		$this->load->model('checkout/order');
		$this->load->model('payment/pagseguro');
		
		/* Informações do Pedido */
		$order_info = $this->model_checkout_order->getOrder($order_id);
		
		
		/* Config */
		$data['email'] = $this->config->get('pagseguro_email');
		$data['token'] = $this->config->get('pagseguro_token');
		$data['paymentMode'] = 'default';
		$data['paymentMethod'] = 'creditCard';
		$data['currency'] = 'BRL';
		$data['notificationURL'] = $this->url->link('payment/pagseguro/callback');
		$data['reference'] = 'Pedido #' . $order_id;

		/* Produtos */
		$count = 1;
		
		foreach($this->cart->getProducts() as $product) {	
			$data['itemId' . $count] = $product['product_id'];
			$data['itemDescription' . $count] = $product['name'] . ' | ' . $product['model'];
			$data['itemAmount' . $count] = $this->currency->format($product['price'], $order_info['currency_code'], $order_info['currency_value'], false);
			$data['itemQuantity' . $count] = $product['quantity'];
			
			$count++;
		}

		/* Nome do Cliente */
		$data['senderName'] = $order_info['firstname'] . ' ' . $order_info['lastname'];
		
		/* CPF do Cliete */
		$data['senderCPF'] = preg_replace('/[^0-9]/', '', $this->request->post['creditCardHolderCPF']);
		
		/* DDD */
		$data['senderAreaCode'] = substr(preg_replace('/[^0-9]/', '', $order_info['telephone']), 0, 2);
		
		/* Telefone do Cliente */
		$data['senderPhone'] = substr(preg_replace('/[^0-9]/', '', $order_info['telephone']), 2);
		
		/* E-mail do Cliente */
		$data['senderEmail'] = $order_info['email'];
		
		/* Hash(Identificador) da transação */
		$data['senderHash'] = $this->request->post['senderHash'];
		
		/* Endereço do Cliente */
		$data['shippingAddressStreet'] = $this->removeAcentos($order_info['payment_address_1']);
		$data['shippingAddressNumber'] = $this->model_payment_pagseguro->getAddressNumber($order_info['payment_custom_field']);
		$data['shippingAddressDistrict'] = $this->removeAcentos($order_info['payment_address_2']);
		$data['shippingAddressPostalCode'] = $order_info['payment_postcode'];
		$data['shippingAddressCity'] = $this->removeAcentos($order_info['payment_city']);
		$data['shippingAddressState'] = $order_info['payment_zone_code'];
		$data['shippingAddressCountry'] = $order_info['payment_iso_code_3'];
		
		/* Tipo e Valor do Frete */
		if ($this->cart->hasShipping()){
			$data['shippingType'] = $this->model_payment_pagseguro->getShippingType();
		
			$data['shippingCost'] = number_format($this->session->data['shipping_method']['cost'], 2, '.', '');
		}

		$data['creditCardToken'] = $this->request->post['creditCardToken'];
		$data['installmentQuantity'] = $this->request->post['installmentQuantity'];
		$data['installmentValue'] = number_format($this->request->post['installmentValue'], 2, '.', '');
		$data['noInterestInstallmentQuantity'] = $this->config->get('pagseguro_parcelas_sem_juros');
		$data['creditCardHolderName'] = $this->request->post['creditCardHolderName'];
		$data['creditCardHolderCPF'] = preg_replace('/[^0-9]/', '', $this->request->post['creditCardHolderCPF']);
		$data['creditCardHolderBirthDate'] = $this->request->post['creditCardHolderBirthDate'];
		$data['creditCardHolderAreaCode'] = substr(preg_replace('/[^0-9]/', '', $this->request->post['creditCardHolderPhone']), 0, 2);
		$data['creditCardHolderPhone'] = substr(preg_replace('/[^0-9]/', '', $this->request->post['creditCardHolderPhone']), 2);

		/* Endereço de Pagamento */
		$data['billingAddressStreet'] = $this->removeAcentos($order_info['payment_address_1']);
		$data['billingAddressNumber'] = $this->model_payment_pagseguro->getAddressNumber($order_info['payment_custom_field']);
		$data['billingAddressDistrict'] = $this->removeAcentos($order_info['payment_address_2']);
		$data['billingAddressPostalCode'] = $order_info['payment_postcode'];
		$data['billingAddressCity'] = $this->removeAcentos($order_info['payment_city']);
		$data['billingAddressState'] = $order_info['payment_zone_code'];
		$data['billingAddressCountry'] = $order_info['payment_iso_code_3'];

		
		$this->load->model('payment/pagseguro');
		
		$result = $this->model_payment_pagseguro->transition($data);
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($result));
	}
	
	public function confirm() {
		$this->load->model('checkout/order');
		
		switch ($this->request->post['status']) {
			case 1:
				$status = $this->config->get('pagseguro_aguardando_pagamento');
				break;
			case 2:
				$status = $this->config->get('pagseguro_analise');
				break;
			case 3:
				$status = $this->config->get('pagseguro_paga');
				break;
			case 4:
				$status = $this->config->get('pagseguro_disponivel');
				break;
			case 5:
				$status = $this->config->get('pagseguro_disputa');
				break;
			case 6:
				$status = $this->config->get('pagseguro_devolvida');
				break;
			case 7:
				$status = $this->config->get('pagseguro_cancelada');
				break;
			default: 
				$status = $this->config->get('pagseguro_aguardando_pagamento');
				break;
		}
		
		$this->model_checkout_order->addOrderHistory($this->session->data['order_id'], $status);
			
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
	
	private function removeAcentos($text) {
		$acentos = array('Á','À','Â','Ã','É','Ê','Í','Ó','Ô','Õ','Ú','Ç','á','à','â','ã','é','ê','í','ó','ô','õ','ú','ç','æ');
		$sAcentos = array('A','A','A','A','E','E','I','O','O','O','U','C','a','a','a','a','e','e','i','o','o','o','u','c','AE');
		
		return str_replace($acentos, $sAcentos, $text);
	}
}