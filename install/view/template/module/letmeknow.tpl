<?php echo $header ?>

<div id="content">

	<div class="box">
		<div class="heading">
			<div class="buttons">
				<a onClick="$('form').submit()" class="button">Salvar</a>
				<a href="#" class="button">Cancelar</a>
			</div>
		</div>

		<div class="content">
			<form action="index.php?route=step_6/configure&next=true" method="post">
				<table class="form">
					<tr>
						<td>Situação:</td>
						<td>
							<select name="letmeknow_status">
								<option value="1">Habilitar</option>
								<option value="0">Desabilitar</option>
							</select>
						</td>
					</tr>

					<tr>
						<td>
							Tìtulo do Email:
							<span class="help">Saudação</span>
						</td>
						<td><input type="text" name="letmeknow_title"></td>
					</tr>

					<tr>
						<td>
							Assunto do Email:
							<span class="help">Ex: Olá %customerName%</span>
						</td>
						<td><input type="text" name="letmeknow_subject" /></td>
					</tr>

					<tr>
						<td>
							Mensagem:
							<span class="help">
								<strong>%customerName%</strong> = Nome do Cliente<br/>
								<strong>%productName%</strong> = Nome do Produto<br/>
								<strong>%productModel%</strong> = Modelo do Produto<br/>
								<strong>%productSKU%</strong> = SKU do Produto<br/>
								<strong>%productQuantity%</strong> = Quantidade do Produto<br/>
								<strong>%productLink%</strong> = Link do Produto
							</span>
						</td>
						<td>
							<textarea name="letmeknow_message" id="message" cols="70" rows="10" placeholder="Ex: O produto %productName% já está disponível em nosso estoque, confira acessando o link %productLink%"></textarea>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>

</div>
<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script> 
<script type="text/javascript"><!--
	CKEDITOR.replace('message', {
		filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
	});
//--></script>


<script type="text/javascript"><!--
	$('.vtabs a').tabs();
//--></script>
<?php echo $footer ?>