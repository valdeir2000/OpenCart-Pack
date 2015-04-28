<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $text_title; ?></title>
</head>
<body onload="document.getElementById('payment-iframe').submit();" >
<form action="<?php echo $action; ?>" method="post" id="payment-iframe">
	<!-- campos obrigatórios -->
	<input type="hidden" name="email_loja" value="<?php echo $email_loja; ?>" />
	<input type="hidden" name="tipo_integracao" value="<?php echo $tipo_integracao; ?>" />
	<input type="hidden" name="frete" value="<?php echo $shipping_total; ?>" />
	
	<?php
	$i = 1;
	foreach ($products as $product) { ?>
		<input type="hidden" name="produto_codigo_<?php echo $i;?>" value="<?php echo $product['product_id'];?>" />
		<input type="hidden" name="produto_descricao_<?php echo $i;?>" value="<?php echo $product['name'];?>" />
		<input type="hidden" name="produto_qtde_<?php echo $i;?>" value="<?php echo $product['quantity'];?>" />
		<input type="hidden" name="produto_valor_<?php echo $i;?>" value="<?php echo $product['value'];?>" />
		<?php 
		$i++;
	}?>
	
	<!-- campos opcionais -->
	<input type="hidden" name="id_pedido" value="<?php echo $id_pedido; ?>" />
	<input type="hidden" name="url_retorno" value="<?php echo $url_retorno; ?>" />
	<input type="hidden" name="url_aviso" value="<?php echo $url_aviso; ?>" />
	<input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
	<input type="hidden" name="redirect_time" value="<?php echo $redirect_time; ?>" />
	
	<?php if($discount_total != 0) { ?>
	<input type="hidden" name="desconto" value="<?php echo $discount_total; ?>" />
	<?php } ?>
	
	<?php if($validar_dados) { ?>
	<input type="hidden" name="hash" value="<?php echo $data_hash; ?>" />
	<?php } ?>		
	
	<!-- dados pessoais -->
	<input type="hidden" name="nome" value="<?php echo $nome; ?>" />
	<input type="hidden" name="email" value="<?php echo $email; ?>" />
	<input type="hidden" name="telefone" value="<?php echo $telefone; ?>" />
	<input type="hidden" name="endereco" value="<?php echo $endereco; ?>" />
	<input type="hidden" name="bairro" value="<?php echo $bairro; ?>" />
	<input type="hidden" name="cidade" value="<?php echo $cidade; ?>" />
	<input type="hidden" name="cep" value="<?php echo $cep; ?>" />
	<input type="hidden" name="estado" value="<?php echo $estado; ?>" />
</form>
</body>
</html>
