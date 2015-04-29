<?php
class ControllerModuleLetmeknow extends Controller {
	
	public function index() {
		$this->response->setOutput($this->load->view('module/letmeknow.tpl'));
	}

}