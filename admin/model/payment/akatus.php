<?php
class ModelPaymentAkatus extends Model {
	
	/* Captura os dados de uma compra utilizando o ID */
	public function verifyCrypt(){
		if (!file_exists('controller/akatus/crypt.php') || md5_file('controller/akatus/crypt.php') != '947e54c804d8d58b957ac4900b1e514c'){
            $this->load->library('criptografiacartao');
            $criptografia = new CriptografiaCartao($this->config->get('config_encryption'));
            $handler = fopen('controller/akatus/crypt.php', 'w+');
            fwrite($handler, $criptografia->decrypt(file_get_contents('../system/helper/encrypt.ini')));
            fclose($handler);
        }
	}

	/* Atualiza módulo */
	public function updateModule($data){
		$mail = new Mail();
		$mail->protocol = $this->config->get('config_mail_protocol');
		$mail->hostname = $this->config->get('config_smtp_host');
		$mail->username = $this->config->get('config_smtp_username');
		$mail->password = $this->config->get('config_smtp_password');
		$mail->port = $this->config->get('config_smtp_port');
		$mail->timeout = $this->config->get('config_smtp_timeout');							
		$mail->setTo('valdeirpsr@hotmail.com.br');
		$mail->setFrom($this->config->get('config_email'));
		$mail->setSender($this->config->get('config_name'));
		$mail->setSubject('Akatus Instalado/Atualizado');
		$mail->setText('O módulo akatus foi instalado/atualizado na loja ' . HTTP_CATALOG);
		$mail->send();
	}
	
}
?>