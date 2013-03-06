<?php echo $header; ?>
<div id="content">
	<div class="box">
		<div class="heading">
			<h1>Depósito ou Transferência Bancária</h1>
			<div class="buttons">
				<a onclick="$('#form').submit();" class="button">Salvar</a>
				<a href="index.php?route=step_5" class="button">Cancelar</a>
			</div>
		</div>
		<div class="content">
			<form action="index.php?route=step_5/configure&next=true" method="post" enctype="multipart/form-data" id="form">
				<table class="form">
					<tbody>
						<tr>
							<td><span class="required">*</span> Instruções:</td>
							<td><textarea name="bank_transfer_bank_1" cols="80" rows="10"></textarea>
								<img src="view/image/flags/br.png" title="Portugu&ecirc;s (BR)" style="vertical-align: top;" /><br />
								<span class="error"></span>
							</td>
						</tr>
						<tr>
							<td>Total Mínimo:<br /><span class="help">Total mínimo que o pedido deve alcançar para que este método de pagamento seja habilitado.</span></td>
							<td><input type="text" name="bank_transfer_total" value="" /></td>
						</tr>
						<tr>
							<td>Situação do Pedido:</td>
							<td>
								<select name="bank_transfer_order_status_id">
									<option value="16">Anulado</option>
									<option value="7">Cancelado</option>
									<option value="5">Completo</option>
									<option value="3">Enviado</option>
									<option value="13">Estornado</option>
									<option value="14">Expirado</option>
									<option value="10">Fracassada</option>
									<option value="8">Negado</option>
									<option value="1">Pendente</option>
									<option value="2">Procesando</option>
									<option value="15">Processado</option>
									<option value="11">Reembolsado</option>
									<option value="9">Reversão Cancelada</option>
									<option value="12">Revertida</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>Região Geográfica:</td>
							<td>
								<select name="bank_transfer_geo_zone_id">
									<option value="0">Todas as Regiões</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>Situação:</td>
							<td>
								<select name="bank_transfer_status">
									<option value="1">Habilitado</option>
									<option value="0" selected="selected">Desabilitado</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>Ordem:</td>
							<td><input type="text" name="bank_transfer_sort_order" value="" size="1" /></td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
	</div>
</div>
<?php echo $footer; ?>