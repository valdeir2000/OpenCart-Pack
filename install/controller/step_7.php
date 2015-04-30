<?php
############################################
# Autor: Valdeir Santana
# Email: valdeir.naval@gmail.com
# Site: http://www.valdeirsantana.com.br
############################################
class ControllerStep7 extends Controller {

	public function index() {

		$data['extensions'] = array();

		$this->document->setTitle($this->language->get('heading_step_7'));

		$data['heading_step_7'] = $this->language->get('heading_step_7');
		$data['heading_step_7_small'] = $this->language->get('heading_step_7_small');
		
		/* Captura módulos */
		$files = glob(DIR_OPENCART . 'admin/controller/total/*.php');

		if ($files) {
			foreach ($files as $file) {

				/* Captura nome do arquivo */
				$extension = basename($file, '.php');
				
				/* Carrega classe de linguagem */
				$language = new Language('../../admin/language/portuguese-br/');

				/* Carrega linguagem do módulo */
				$language->load('total/' . $extension);
				
				/* Salva os módulos disponíveis */
				$data['extensions'][$extension] = array(
					'name' => $language->get('heading_title'),
					'extension' => $extension,
					'template' => 'total/' . $extension,
				);
			}
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
		$data['action'] = $this->url->link('step_7/install');
		$data['back'] = $this->url->link('step_6');

		/* Controller */
		$data['footer'] = $this->load->controller('footer');
		$data['header'] = $this->load->controller('header');

		/* Template */
		$this->response->setOutput($this->load->view('step_7.tpl', $data));
	}

	public function install() {

		/* Salva informações dos módulos */
		if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->request->server['HTTP_REFERER'] != $this->url->link('step_7')) {
			
			/* Model Setting */
			$this->load->model('setting');

			/* Salva configurações */
			$this->model_setting->editSetting($this->request->post['module_name'], $this->request->post['config']);

			/* Instala módulo */
			$this->model_setting->install('total', $this->request->post['module_name']);
			
			/* Adiciona Permissões */
			$this->model_setting->addPermission(1, 'access', 'total/' . $this->request->post['module_name']);
			$this->model_setting->addPermission(1, 'modify', 'total/' . $this->request->post['module_name']);

			/* Redireciona para o próximo passo */
			if (empty($this->request->post['modules'])) {
				$this->response->redirect($this->url->link('step_8'));
			}
		}

		/* Redireciona para o próximo passo */
		if (empty($this->request->post['modules'])) {
			$this->response->redirect($this->url->link('step_8'));
		}

		/* Passo atual */
		$data['step'] = 7;

		/* Link */
		$data['action'] = $this->url->link('step_7/install');
		$data['back'] = $this->url->link('step_7');

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
		$data['text_setting_module'] = $this->language->get('text_setting_module');
		$data['text_config_module'] = $this->language->get('text_config_module');

		/* Botões */
		$data['button_back'] = $this->language->get('button_back');
		$data['button_continue'] = $this->language->get('button_continue');

		/* Módulo atual */
		$data['module_name'] = reset($this->request->post['modules']);

		/* Captura código do módulo */
		$this->load->model('template');
		$code = $this->model_template->get_template('total', reset($this->request->post['modules']));

		/* Carrega libravia */
		$this->load->library('simple_html_dom');

		/* Classe responsável pela manipulação do HTML */
		$html = new simpleHtmlDom();
		$response = $html->str_get_html($code)->find('form');
		$scripts = $html->str_get_html($code)->find('script[type="text/javascript"]');

		$data['scripts_modules'] = array();

		foreach ($scripts as $key => $value) {
			if (!isset($value->attr['src'])) {
				$data['scripts_modules'][] = $value->innertext;
			}
		}

		/* Captura código do formulário */
		$data['code'] = reset($response);

		/* Deleta primeiro array */
		array_shift($this->request->post['modules']);

		/* Armazena os módulos para configuração */
		$data['modules'] = $this->request->post['modules'];

		/* Controller */
		$data['footer'] = $this->load->controller('footer');
		$data['header'] = $this->load->controller('header');

		/* Template */
		$this->response->setOutput($this->load->view('extension_template.tpl', $data));

	}
}
?>