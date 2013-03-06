<?php
	
	//Inclui as variaveis globais
	require_once '../../../config.php';
	//Inclui o startup
	require_once DIR_SYSTEM . 'startup.php';
	
	//Conecta ao banco de dados
	$db = new DB (DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
	
	$session = new Cache();
	
	if (isset($_POST) && !empty($_POST)):
		
		$usuario = $_POST['user'];
		$password = $_POST['password'];
		
		$user = $db->query("SELECT * FROM " . DB_PREFIX . "user WHERE username = '" . $db->escape($usuario) . "' AND (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $db->escape($password) . "'))))) OR password = '" . $db->escape(md5($password)) . "') AND status = '1'");
		
		if (!empty($user->rows)):
			$session->set('logado', 'sim');
			echo "<script>location = 'steps.php'</script>";
		endif;
		
	endif;
	
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Akatus Checkout Transparente</title>
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
				<h2 class="subTitle" style="margin:20px auto">Digite seu login e senha para poder instalar o módulo</h2>	
				<?php else: ?>
				<h2 class="subTitle" style="margin:20px auto">Módulo instalado com sucesso</h2>	
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