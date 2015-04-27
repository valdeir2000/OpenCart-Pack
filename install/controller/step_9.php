<?php
############################################
# Autor: Valdeir Santana
# Email: valdeir.naval@gmail.com
# Site: http://www.valdeirsantana.com.br
############################################
class ControllerStep9 extends Controller {

	public function index() {

		$this->document->addScript('view/javascript/jquery/switchery/switchery.min.js');
		$this->document->addStyle('view/javascript/jquery/switchery/switchery.min.css');
		
		$data['extensions'] = array();
		
		$this->load->model('modification');
		$modifications = $this->model_modification->getModifications();

		$data['modifications'] = array();

		foreach($modifications as $modification) {
			$data['modifications'][] = array(
				'id' => $modification['modification_id'],
				'name' => $modification['name'],
				'author' => $modification['author'],
				'version' => $modification['version'],
				'status' => $modification['status'],
				'date_added' => $modification['date_added']
			);
		}

		/* Butões */
		$data['button_continue'] = $this->language->get('button_continue');
		$data['button_back'] = $this->language->get('button_back');

		/* Links */
		$data['action'] = $this->url->link('step_9/install');
		$data['back'] = $this->url->link('step_8');

		/* Controller */
		$data['footer'] = $this->load->controller('footer');
		$data['header'] = $this->load->controller('header');

		/* Template */
		$this->response->setOutput($this->load->view('step_9.tpl', $data));
	}

	public function install() {

		/* Salva informações dos módulos */
		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			$this->load->model('modification');
			
			foreach($this->request->post as $modification) {
				$modification_id = array_keys($modification);

				$this->model_modification->activeModification($modification_id);
			}

			$this->response->redirect($this->url->link('step_10'));
		}
	}
}
?>