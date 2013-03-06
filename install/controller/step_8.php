<?php
############################################
# Autor: Valdeir Santana
# Email: valdeirpsr@hotmail.com.br
# Site: http://www.valdeirsantana.com.br
############################################
class ControllerStep8 extends Controller {

	private $folders = array();
	private $files = array();

	public function index() {
	
		//Link - Voltar
		$this->data['back'] = $this->url->link('step_7');
		//Link - Finalizar
		$this->data['finish'] = $this->url->link('step_8/finish');
		
		$this->template = 'step_8.tpl';
		$this->children = array(
			'header',
			'footer'
		);
		$this->response->setOutput($this->render());
		
	}
	
	public function finish(){
		$this->deleteFiles(DIR_ROOT . 'install');
		rmdir(DIR_ROOT . 'install');
	
		$this->redirect(HTTP_ROOT);
	}
	
	protected function deleteFiles( $folder = '') {
		if ( empty($folder) )
			return false;

		$files = array();
		if ( $dir = @opendir( $folder ) ) {
			while (($file = readdir( $dir ) ) !== false ) {
				if ( in_array($file, array('.', '..') ) )
					continue;
				if ( is_dir( $folder . '/' . $file ) ) {
					$files2 = $this->deleteFiles( $folder . '/' . $file);
					if ( $files2 )
						$files = array_merge($files, $files2 );
						rmdir($folder . '/' . $file);
				} else {
					unlink($folder . '/' . $file);
				}
			}
		}
		@closedir($dir);
	}
}
?>