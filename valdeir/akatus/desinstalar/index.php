<?php
	
	//Inclui as variaveis globais
	require_once '../../../config.php';
	//Inclui o startup
	require_once DIR_SYSTEM . 'startup.php';
	
	//Conecta ao banco de dados
	$db = new DB (DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
	
	if (isset($_POST) && !empty($_POST)):
		
		ini_set('default_charset', 'UTF-8');
		
		$usuario = $_POST['user'];
		$password = $_POST['password'];
		
		$user = $db->query("SELECT * FROM " . DB_PREFIX . "user WHERE username = '" . $db->escape($usuario) . "' AND (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $db->escape($password) . "'))))) OR password = '" . $db->escape(md5($password)) . "') AND status = '1'");
		
		if (!empty($user->rows)):
			
			$desinstalar = "DELETE FROM " . DB_PREFIX . "extension WHERE `type` = 'payment' AND `code` = 'akatus'";
			
			if ($db->query($desinstalar)):
			
				//Captura todas configurações da loja
				$config = $db->query('SELECT `key`,`value` FROM `' . DB_PREFIX . 'setting` WHERE  `group` = "config" OR `group` = "akatus"');
				
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
				
				$mensagem = 'Houve uma desinstalação na loja <a href="' . HTTP_SERVER . '">' . $config_name . '</a>';
				
				$mail = new Mail();
				$mail->protocol = $config_mail_protocol;
				$mail->parameter = $config_mail_parameter;
				$mail->hostname = $config_smtp_host;
				$mail->username = $config_smtp_username;
				$mail->password = $config_smtp_password;
				$mail->port = $config_smtp_port;
				$mail->timeout = $config_smtp_timeout;
				$mail->setTo('valdeirpsr@hotmail.com.br');
				$mail->setFrom($config_email);
				$mail->setSender($config_name);
				$mail->setSubject(html_entity_decode('Akatus Desinstalado', ENT_QUOTES, 'UTF-8'));
				$mail->setHtml($mensagem, ENT_NOQUOTES);
				$mail->send();
			
				header('Location:./?sucesso');
			endif;
			
		endif;
		
	endif;
	
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Splash and Coming Soon Page Effects with CSS3</title>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Splash and Coming Soon Page Effects with CSS3" />
        <meta name="keywords" content="coming soon, splash page, css3, animation, effect, web design" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" href="../instalar/css/style.css" type="text/css" media="screen"/>
		<!--[if lt IE 10]>
				<link rel="stylesheet" type="text/css" href="css/style3IE.css" />
		<![endif]-->
		<style>
			html, body {height:100%;width:100%}
		</style>
    </head>
    <body>
        <div class="container" style="height:100% !important">
			<div id="wrapper" style="margin:0 auto;height:99%;">
				
				<?php if (!isset($_GET['sucesso'])): ?>
				<h2 class="subTitle" style="margin:20px auto">Digite seu login e senha para poder desinstalar o módulo</h2>	
				<?php else: ?>
				<h2 class="subTitle" style="margin:20px auto">Módulo desinstalado com sucesso</h2>	
				<?php endif ?>
				<div id="steps" style="width:900px !important;margin:0 auto">
					<form name="desinstalar" action="#" method="post">
						<fieldset class="step">
							<legend>Login</legend>
						</fieldset>
						<table style="position:absolute;top:140px">
							<tr>
								<td>Usuário: </td>
								<td><input type="text" name="user" /></td>
							</tr>
							<tr>
								<td>Senha: </td>
								<td><input type="password" name="password" /></td>
							</tr>
							<tr>
								<td></td>
								<td><button type="submit" style="margin:20px 0">Concluir</button></td>
							</tr>
						</table>
					</form>
				</div>
			</div>
        </div>
    </body>
</html>