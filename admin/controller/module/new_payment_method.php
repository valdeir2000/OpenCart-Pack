<?php
class ControllerModuleNewPaymentMethod extends Controller {
	
	public function index() {
		$this->response->setOutput($this->load->view('module/new_payment_method.tpl'));
	}

}