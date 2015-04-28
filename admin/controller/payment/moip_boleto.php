<?php
class ControllerPaymentMoipBoleto extends Controller {
	
	public function index() {
		$this->response->redirect($this->url->link('payment/moip', 'token=' . $this->session->data['token'], 'SSL'));
	}
	
}