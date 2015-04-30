<?php
class ControllerValdeirAutocep extends Controller {
	
	public function index() {
		header('Content-Type: application/json');
		echo file_get_contents('http://cep.republicavirtual.com.br/web_cep.php?cep=' . $this->request->get['cep'] . '&formato=json');
	}
}