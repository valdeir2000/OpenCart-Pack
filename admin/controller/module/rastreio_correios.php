<?php
class ControllerModuleRastreioCorreios extends Controller {
	
	public function index() {
		$this->response->setOutput($this->load->view('module/rastreio_correios.tpl'));
	}

}