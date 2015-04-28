<?php
class ControllerStep10 extends Controller {
	public function index() {

		$data['themes'] = array();

		$this->document->setTitle($this->language->get('heading_step_10'));

		$data['heading_step_10'] = $this->language->get('heading_step_10');
		$data['heading_step_10_small'] = $this->language->get('heading_step_10_small');

		$files = glob(DIR_OPENCART . 'catalog/view/theme/*');

		foreach($files as $file) {
			$data['themes'][] = array(
				'name' => basename($file),
				'image' => '../image/templates/' . basename($file) . '.png'
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

		$data['button_back'] = $this->language->get("button_back");
		$data['button_continue'] = $this->language->get("button_continue");

		$data['action'] = $this->url->link('step_10/install');
		$data['back'] = $this->url->link('step_9');

		$data['footer'] = $this->load->controller('footer');
		$data['header'] = $this->load->controller('header');

		$this->response->setOutput($this->load->view('step_10.tpl', $data));
	}

	public function install() {

		/* Salva informações dos módulos */
		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			$this->load->model('setting');
			
			$this->model_setting->updateTheme($this->request->post['theme']);

			$this->response->redirect($this->url->link('step_11'));
		}
	}
}