<?php echo $header; ?>
<div id="content">
	<div class="box">
		<div class="heading">
			<h1>Frete Fixo</h1>
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
							<td>Valor Fixo:<br /><span class="help">Valor fixo a ser cobrado pelo envio de todos os itens do pedido.</span></td>
							<td><input type="text" name="flat_cost" value="5.00" /></td>
						</tr>
						<tr>
							<td>Grupo de Impostos:</td>
							<td>
								<select name="flat_tax_class_id">
									<option value="0"> --- Vazio --- </option>
								</select>
							</td>
						</tr>
						<tr>
							<td>Região Geográfica:</td>
							<td>
								<select name="flat_geo_zone_id">
									<option value="0">Todas as Regiões</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>Situação:</td>
							<td>
								<select name="flat_status">
									<option value="1" selected="selected">Habilitado</option>
									<option value="0">Desabilitado</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>Ordem:</td>
							<td><input type="text" name="flat_sort_order" value="1" size="1" /></td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
	</div>
</div>
<?php echo $footer; ?> 