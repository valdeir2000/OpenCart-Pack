<?php
class ControllerModuleCalculaFrete extends Controller {
	
	public function index() {
		$this->response->setOutput($this->load->view('module/calcula_frete.tpl'));
	}

}