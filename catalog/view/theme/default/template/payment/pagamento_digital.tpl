<?php if ($usar_iframe){ ?>
<div class="buttons">
  <div class="pull-right">
    <input type="button" value="<?php echo $button_confirm; ?>" id="button-confirm-iframe" class="btn btn-primary" />
  </div>
</div>
<?php } else { ?>
<form action="<?php echo $action; ?>" method="post" id="payment">
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

<div class="buttons">
  <div class="pull-right">
    <input type="button" value="<?php echo $button_confirm; ?>" id="button-confirm" class="btn btn-primary" />
  </div>
</div>	
</form>
<?php } ?>
<script type="text/javascript">
<?php if ($usar_iframe){ ?>
$('#button-confirm-iframe').on('click', function() {
	$.ajax({
		url: '<?php echo $url_payment; ?>',
		type: 'get',
		dataType: 'html',
		success: function(data) {
			html  = '<div id="modal-bcash" class="modal">';
			html += '  <div class="modal-dialog" style="width: 95%; height:95%;margin: 10px auto;">';
			html += '    <div class="modal-content">';
			html += '      <div class="modal-header">';
			html += '        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
			html += '        <h4 class="modal-title"><?php echo $text_title; ?></h4>';
			html += '      </div>';
			html += '      <div class="modal-body" style="height: 99%;padding: 1px;">' + data + '</div>';
			html += '    </div';
			html += '  </div>';
			html += '</div>';

			$('body').append(html);

			$('#modal-bcash').modal('show');
		}
	});
});
<?php } else { ?>
$('#button-confirm').on('click', function() {
	$.ajax({ 
		type: 'get',
		url: 'index.php?route=payment/pagamento_digital/confirm',
		cache: false,
		beforeSend: function() {
			$('#button-confirm').button('loading');
		},
		complete: function() {
			$('#button-confirm').button('reset');
		},		
		success: function() {
			$('#payment').submit();
		}		
	});
});
<?php } ?>
</script> 
