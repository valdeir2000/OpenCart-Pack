<?php
	
	//Instancia o arquivo com as configurações
	require_once('config.php');
	
	//Instaria o startup
	require_once( DIR_SYSTEM . 'startup.php');
	
	//Instancia um novo banco de dados
	$db = new DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
	
	//Instancia um novo objeto Language
	$languageMail = new Language('portuguese-br');

	//Carrega o arquivo 
	$languageMail->load('mail/akatus');
	
	//Captura todas configurações da loja
	$config = $db->query('SELECT * FROM `' . DB_PREFIX . 'setting` WHERE `group` = "config"');
	
	//Configura todas configuração do módulo Akatus
	$config_akatus = $db->query('SELECT * FROM  `' . DB_PREFIX . 'setting` WHERE  `group` = "akatus"');

	//Separa as informações do módulo Akatus em determinadas variáveis
	foreach($config_akatus->rows as $key => $value){
		
		//Captura o API Token
		if ($value['key'] == 'akatus_apiNip')
			$apiNip = $value['value'];
		
		//Captura o id do status cancelado
		if ($value['key'] == 'akatus_status_canceled')
			$status_canceled = $value['value'];
		
		//Captura o id do status pendente
		if ($value['key'] == 'akatus_status_pending')
			$status_pending = $value['value'];
			
		//Captura o id do status completo
		if ($value['key'] == 'akatus_status_complete')
			$status_complete = $value['value'];
			
		//Captura o id do status em análise
		if ($value['key'] == 'akatus_status_analysing')
			$status_analysing = $value['value'];
		
		//Captura a opção de notificação
		if ($value['key'] == 'akatus_notify')
			$notify = $value['value'];
			
	}
	
	//Recebe o token
	$token        = $_POST['token'];
	//Recebe o id da transação
	$transacao_id = $_POST['transacao_id'];
	//Recebe o status
	$status       = $_POST['status'];
	//Recebe o comentário do pedido
	$referencia   = $_POST['referencia'];
	
	//Captura o id da compra
	$order_id = $db->query('SELECT order_id FROM nip WHERE transacao_id = "' . $transacao_id . '"');
	
	//Captura todas informações da compra
	$data_order = $db->query('SELECT * FROM `order` WHERE order_id = "' . $order_id->row['order_id'] . '"');
	
	//Verifica se a compra existe
	if ($order_id->row > 0):
		
		//Verifica se a Api Token do lojista é igual a enviada
		if ($apiNip == $token):
			
			//Verifica o status recebido
			if ($status == 'Aguardando Pagamento'):
				$order_status_id = $status_pending;
			elseif ($status == 'Em Análise'):
				$order_status_id = $status_analysing;
			elseif ($status == 'Aprovado'):
				$order_status_id = $status_complete;
			elseif ($status == 'Cancelado'):
				$order_status_id = $status_canceled;
			endif;
			
			//Atualiza o status
			$db->query('UPDATE `order` SET order_status_id = "' . $order_status_id . '" WHERE order_id = "' . $order_id->row['order_id'] . '"');
			
			//Verifica se é para enviar notificação ao cliente
			if ($notify == 1):
				//Captura as configurações de email para o envio
				for ($i = 0;$i < count($config->rows);$i++) {
					
					if ($config->rows[$i]['key'] == 'config_mail_protocol') {
						$config_mail_protocol = $config->rows[$i]['value'];
					}
					
					if ($config->rows[$i]['key'] == 'config_mail_parameter') {
						$config_mail_parameter = $config->rows[$i]['value'];
					}
					
					if ($config->rows[$i]['key'] == 'config_smtp_host') {
						$config_smtp_host = $config->rows[$i]['value'];
					}
					
					if ($config->rows[$i]['key'] == 'config_smtp_username') {
						$config_smtp_username = $config->rows[$i]['value'];
					}
					
					if ($config->rows[$i]['key'] == 'config_smtp_password') {
						$config_smtp_password = $config->rows[$i]['value'];
					}
					
					if ($config->rows[$i]['key'] == 'config_smtp_port') {
						$config_smtp_port = $config->rows[$i]['value'];
					}
					
					if ($config->rows[$i]['key'] == 'config_smtp_timeout') {
						$config_smtp_timeout = $config->rows[$i]['value'];
					}
					
					if ($config->rows[$i]['key'] == 'config_email') {
						$config_email = $config->rows[$i]['value'];
					}
					
					if ($config->rows[$i]['key'] == 'config_name') {
						$config_name = $config->rows[$i]['value'];
					}
				}
					
				//Cria uma mensagem para enviar ao cliente
				//Assunto
				$assunto = sprintf($languageMail->get('text_update_subject'), $config_name, $order_id->row['order_id']);
				//Número do pedido
				$mensagem  = sprintf($languageMail->get('text_update_order'), $data_order->row['order_id']);
				//Data de criação do pedido
				$mensagem .= sprintf($languageMail->get('text_update_date_added'), date('d/m/Y', strtotime($data_order->row['date_added'])));
				//Status do pedido
				$mensagem .= sprintf($languageMail->get('text_update_order_status'), $status);
				//Comentário do pedido
				if ($referencia)
					$mensagem .= sprintf($languageMail->get('text_update_comment'), $referencia);
				//Link do pedido
				$mensagem .= sprintf($languageMail->get('text_update_link'), HTTP_SERVER . 'index.php?route=account/order/info&order_id=' . $data_order->row['order_id'], HTTP_SERVER . 'index.php?route=account/order/info&order_id=' . $data_order->row['order_id']);
				//Footer
				$mensagem .= $languageMail->get('text_update_footer');
				
				$mail = new Mail();
				$mail->protocol = $config_mail_protocol;
				$mail->parameter = $config_mail_parameter;
				$mail->hostname = $config_smtp_host;
				$mail->username = $config_smtp_username;
				$mail->password = $config_smtp_password;
				$mail->port = $config_smtp_port;
				$mail->timeout = $config_smtp_timeout;
				$mail->setTo($data_order->row['email']);
				$mail->setFrom($config_email);
				$mail->setSender($config_name);
				$mail->setSubject(html_entity_decode($assunto, ENT_QUOTES, 'UTF-8'));
				$mail->setHtml($mensagem, ENT_NOQUOTES);
				$mail->send();
			endif;
			
		endif;
		
	endif;
	
	
	
	
	