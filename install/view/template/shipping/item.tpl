<?php echo $header; ?>
<div id="content">
	<div class="box">
		<div class="heading">
			<h1>Frete por Itens</h1>
			<div class="buttons">
				<a onclick="$('#form').submit();" class="button">Salvar</a>
				<a href="index.php?route=step_4" class="button">Cancelar</a>
			</div>
		</div>
		<div class="content">
			<form action="index.php?route=step_4/configure&next=true" method="post" enctype="multipart/form-data" id="form">
				<table class="form">
					<tbody>
						<tr>
							<td>Valor por Item:<br /><span class="help">Valor a ser cobrado por item do pedido.<br />Supondo que há 3 itens no carrinho: <b>3 x Valor por Item</b>.</span></td>
							<td><input type="text" name="item_cost" value="" /></td>
						</tr>
						<tr>
							<td>Grupo de Impostos:</td>
							<td>
								<select name="item_tax_class_id">
									<option value="0"> --- Vazio --- </option>
								</select>
							</td>
						</tr>
						<tr>
							<td>Região Geográfica:</td>
							<td>
								<select name="item_geo_zone_id">
									<option value="0">Todas as Regiões</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>Situação:</td>
							<td>
								<select name="item_status">
									<option value="1">Habilitado</option>
									<option value="0" selected="selected">Desabilitado</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>Ordem:</td>
							<td><input type="text" name="item_sort_order" value="" size="1" /></td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
	</div>
</div>

<?php echo $footer; ?> 