<?php
############################################
# Autor: Valdeir Santana
# Email: valdeir.naval@gmail.com
# Site: http://www.valdeirsantana.com.br
############################################
class ControllerStep6 extends Controller {

	public function index() {

		$data['extensions'] = array();
		
		/* Captura módulos */
		$files = glob(DIR_OPENCART . 'admin/controller/shipping/*.php');

		if ($files) {
			foreach ($files as $file) {

				/* Captura nome do arquivo */
				$extension = basename($file, '.php');
				
				/* Carrega classe de linguagem */
				$language = new Language('../../admin/language/english/');

				/* Carrega linguagem do módulo */
				$language->load('shipping/' . $extension);
				
				/* Salva os módulos disponíveis */
				$data['extensions'][$extension] = array(
					'name' => $language->get('heading_title'),
					'extension' => $extension,
					'template' => 'shipping/' . $extension,
				);
			}
		}

		/* Butões */
		$data['button_continue'] = $this->language->get('button_continue');
		$data['button_back'] = $this->language->get('button_back');

		/* Links */
		$data['action'] = $this->url->link('step_6/install');
		$data['back'] = $this->url->link('step_4');

		/* Controller */
		$data['footer'] = $this->load->controller('footer');
		$data['header'] = $this->load->controller('header');

		/* Template */
		$this->response->setOutput($this->load->view('step_6.tpl', $data));
	}

	public function install() {

		/* Salva informações dos módulos */
		if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->request->server['HTTP_REFERER'] != $this->url->link('step_6')) {
			
			/* Model Setting */
			$this->load->model('setting');

			/* Salva configurações */
			$this->model_setting->editSetting($this->request->post['module_name'], $this->request->post['config']);
			
			/* Adiciona Permissões */
			$this->model_setting->addPermission(1, 'access', 'shipping/' . $this->request->post['module_name']);
			$this->model_setting->addPermission(1, 'modify', 'shipping/' . $this->request->post['module_name']);

			/* Redireciona para o próximo passo */
			if (empty($this->request->post['modules'])) {
				$this->response->redirect($this->url->link('step_7'));
			}
		}

		/* Passo atual */
		$data['step'] = 5;

		/* Link */
		$data['action'] = $this->url->link('step_6/install');
		$data['back'] = $this->url->link('step_5');

		/* Botões */
		$data['button_back'] = $this->language->get('button_back');
		$data['button_continue'] = $this->language->get('button_continue');

		/* Módulo atual */
		$data['module_name'] = reset($this->request->post['modules']);

		/* Captura código do módulo */
		$code = $this->get_template(reset($this->request->post['modules']));

		/* Carrega libravia */
		$this->load->library('simple_html_dom');

		/* Classe responsável pela manipulação do HTML */
		$html = new simpleHtmlDom();
		$response = $html->str_get_html($code)->find('form');

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

	private function get_template($extension = '') {
		if (!empty($extension)) {

			/* Define usuário como logado */
			$this->session->data['user_id'] = '1';
			$this->session->data['token'] = 'valdeir';

			/* Url do módulo */
			$url = HTTP_OPENCART . 'admin/index.php?route=shipping/' . $extension . '&token=valdeir';

			/* Armazena session */
			$strCookie = session_name() . '=' . $_COOKIE[ session_name() ] . '; path=/';
			session_write_close(); 

			/* CURL */
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLINFO_HEADER_OUT, true);
			curl_setopt($ch, CURLOPT_USERAGENT, $this->request->server['HTTP_USER_AGENT']);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_FORBID_REUSE, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_COOKIESESSION, true);
			curl_setopt($ch, CURLOPT_COOKIE, $strCookie);
			$response = curl_exec($ch);
			curl_close($ch);

			return $response;
		} else {
			return false;
		}
	}
}
?>