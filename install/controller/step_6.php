<?php
############################################
# Autor: Valdeir Santana
# Email: valdeirpsr@hotmail.com.br
# Site: http://www.valdeirsantana.com.br
############################################
class ControllerStep6 extends Controller{
	
	public function index(){
		
		//Deleta os dados da session shipping
		unset($this->session->data['modules']);
		
		$this->data['extensions'] = array();
		
		//Aqruivos não exibidos
		$fileNotPermited = array(
			'banner',
			'carousel',
			'featured',
			'slideshow',
			'vqmod_manager',
		);
		
		//Carrega todos os arquivos .php da pasta shipping
		$files = glob(DIR_ROOT . 'admin/controller/module/*.php');
		
		if ($files) {
			foreach ($files as $file) {
				$extension = basename($file, '.php');
				
				//Instancia o idioma portuguese-br
				$language = new Language('../../admin/language/portuguese-br');
				
				//Carrega a linguagem do módulo
				$language->load('module/' . $extension);
				
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
		$this->data['back'] = $this->url->link('step_5');
		
		$this->template = 'step_6.tpl';
		$this->children = array(
			'header',
			'footer'
		);
		
		$this->response->setOutput($this->render());
		
	}
	
	//Função responsável por instalar o módulo e definir as permissões de acesso
	public function configure(){
		//Verifica se o POST enviado contém o campo shipping
		if (isset($this->request->post['modules'])){
			//Salva os dados do campo shipping na session
			$this->session->data = $this->request->post;
		}
		
		//Verifica se existe o método POST e se existe o parâmetro NEXT na url
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && isset($this->request->get['next'])){
			//Carrega o model setting 
			$this->load->model('setting');
			//Verifica se o módulo possui arquivo .sql
			if (file_exists(DIR_APPLICATION . 'sql/module/' . current($this->session->data['modules']) . '.sql'))
				//Executa arquivo .sql do módulo caso haja
				$this->model_setting->mysql(DIR_APPLICATION . 'sql/module/' . current($this->session->data['modules']) . '.sql');
			//Salva as configurações do módulo
			$this->model_setting->editSetting(current($this->session->data['modules']), $this->request->post);
			//Instala o módulo
			$this->model_setting->install('module', current($this->session->data['modules']));
			//Define a permissão de acesso
			$this->model_setting->addPermission('access', 'module/' . current($this->session->data['modules']));
			//Define a permissão de modificação
			$this->model_setting->addPermission('modify', 'module/' . current($this->session->data['modules']));
			//Deleta o primeiro índice do array
			array_shift($this->session->data['modules']);
		}
		
		//Verifica se a session está vázia,
		if (!empty($this->session->data['modules'])){
			//Caso não esteja vazia, carrega o layout do módulo escolhido
			$this->template = 'module/' . current($this->session->data['modules']) . '.tpl';
			$this->children = array(
				'header',
				'footer'
			);
		
			$this->response->setOutput($this->render());
		}else{
			//Caso esteja vazio redireciona para a próxima etapa
			$this->redirect($this->url->link('step_7'));
		}
		
	}
	
}
?>