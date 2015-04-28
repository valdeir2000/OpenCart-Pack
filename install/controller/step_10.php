<?php
class ControllerStep10 extends Controller {
	public function index() {

		$data['themes'] = array();

		$files = glob(DIR_OPENCART . 'catalog/view/theme/*');

		foreach($files as $file) {
			$data['themes'][] = array(
				'name' => basename($file),
				'image' => '../image/templates/' . basename($file) . '.png'
			);
		}

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