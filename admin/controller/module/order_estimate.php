<?php
class ControllerModuleOrderEstimate extends Controller {
	
	public function index() {
		$this->response->setOutput($this->load->view('module/order_estimate.tpl'));
	}

}