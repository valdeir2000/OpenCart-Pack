<?php
############################################
# Autor: Valdeir Santana
# Email: valdeirpsr@hotmail.com.br
# Site: http://www.valdeirsantana.com.br
############################################
class ControllerStep4 extends Controller {

	public function index() {
		
		//Deleta os dados da session shipping
		unset($this->session->data['shipping']);
		
		$this->data['extensions'] = array();
		
		//Aqruivos não exibidos
		$fileNotPermited = array(
			'auspost',
			'citylink',
			'fedex',
			'parcelforce_48',
			'pickup',
			'royal_mail',
			'ups',
			'usps',
			'weight',
		);
		
		//Carrega todos os arquivos .php da pasta shipping
		$files = glob(DIR_ROOT . 'admin/controller/shipping/*.php');
		
		if ($files) {
			foreach ($files as $file) {
				$extension = basename($file, '.php');
				
				//Instancia o idioma portuguese-br
				$language = new Language('../../admin/language/portuguese-br');
				
				//Carrega a linguagem do módulo
				$language->load('shipping/' . $extension);
	
				$action = array();
				
				//Verifica se o arquivo está permitido para ser exibido
				if (!in_array($extension, $fileNotPermited)){
					//Armazena o título da extensão e o nome do arquivo
					$this->data['extensions'][] = array(
						'name'		=> $language->get('heading_title'),
						'extension'	=> $extension
					);
				}
			}
		}
		
		//Link - Voltar a Página Anterior
		$this->data['back'] = $this->url->link('step_3');
	
		$this->template = 'step_4.tpl';
		$this->children = array(
			'header',
			'footer'
		);
		
		$this->response->setOutput($this->render());
		
		//Verifica se existe um método POST
		if ($this->request->server['REQUEST_METHOD'] == 'POST'){
			//Carrega a função configure()
			$this->configure();
		}
		
	}
	
	//Função responsável por instalar o módulo e definir as permissões de acesso
	public function configure(){
		
		//Verifica se o POST enviado contém o campo shipping
		if (isset($this->request->post['shipping'])){
			//Salva os dados do campo shipping na session
			$this->session->data = $this->request->post;
		}
		
		//Verifica se existe o método POST e se existe o parâmetro NEXT na url
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && isset($this->request->get['next'])){
			//Carrega o model setting
			$this->load->model('setting');
			//Verifica se o módulo possui arquivo .sql
			if (file_exists(DIR_APPLICATION . 'sql/payment/' . current($this->session->data['shipping']) . '.sql'))
				//Executa arquivo .sql do módulo caso haja
				$this->model_setting->mysql(DIR_APPLICATION . 'sql/payment/' . current($this->session->data['shipping']) . '.sql');
			//Salva as configurações do módulo
			$this->model_setting->editSetting(current($this->session->data['shipping']), $this->request->post);
			//Instala o módulo
			$this->model_setting->install('shipping', current($this->session->data['shipping']));
			//Define a permissão de acesso
			$this->model_setting->addPermission('access', 'shipping/' . current($this->session->data['shipping']));
			//Define a permissão de modificação
			$this->model_setting->addPermission('modify', 'shipping/' . current($this->session->data['shipping']));
			//Deleta o primeiro índice do array
			array_shift($this->session->data['shipping']);
		}
		
		//Verifica se a session está vázia,
		if (!empty($this->session->data['shipping'])){
			//Caso não esteja vazia, carrega o layout do módulo escolhido
			$this->template = 'shipping/' . current($this->session->data['shipping']) . '.tpl';
			$this->children = array(
				'header',
				'footer'
			);
			$this->response->setOutput($this->render());
		}else{
			//Caso esteja vazio redireciona para a próxima etapa
			$this->redirect($this->url->link('step_5'));
		}
	}
}
?>