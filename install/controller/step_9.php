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

		$this->document->setTitle($this->language->get('heading_step_9'));

		$data['heading_step_9'] = $this->language->get('heading_step_9');
		$data['heading_step_9_small'] = $this->language->get('heading_step_9_small');
		
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

		/* Text */
		$data['text_license'] = $this->language->get('text_license');
		$data['text_installation'] = $this->language->get('text_installation');
		$data['text_configuration'] = $this->language->get('text_configuration');
		$data['text_modules'] = $this->language->get('text_modules');
		$data['text_payment_method'] = $this->language->get('text_payment_method');
		$data['text_shipping_method'] = $this->language->get('text_shipping_method');
		$data['text_order_total'] = $this->language->get('text_order_total');
		$data['text_feed'] = $this->language->get('text_feed');
		$data['text_modification'] = $this->language->get('text_modification');
		$data['text_themes'] = $this->language->get('text_themes');
		$data['text_finished'] = $this->language->get('text_finished');
		$data['text_choose_modules'] = $this->language->get('text_choose_modules');

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
			
			if (is_array($this->request->post['modification'])) {
				foreach($this->request->post['modification'] as $key => $modification) {
					$this->model_modification->activeModification($key);
				}
			}

			$this->response->redirect($this->url->link('step_10'));
		}
	}
}
?>