<?php echo $header; ?>
<div id="content">
	<div class="box">
		<div class="heading">
			<h1>Pagamento Grátis</h1>
			<div class="buttons">
				<a onclick="$('#form').submit();" class="button">Salvar</a>
				<a href="index.php?route=step_5" class="button">Cancelar</a>
			</div>
		</div>
		<div class="content">
			<form action="index.php?route=step_5/configure&next=true" method="post" enctype="multipart/form-data" id="form">
				<div id="tab-general" class="page">
					<table class="form">
						<tbody>
							<tr>
								<td>Situação do Pedido:</td>
								<td>
									<select name="free_checkout_order_status_id">
										<option value="16">Anulado</option>
										<option value="7">Cancelado</option>
										<option value="5">Completo</option>
										<option value="3">Enviado</option>
										<option value="13">Estornado</option>
										<option value="14">Expirado</option>
										<option value="10">Fracassada</option>
										<option value="8">Negado</option>
										<option value="1" selected="selected">Pendente</option>
										<option value="2">Procesando</option>
										<option value="15">Processado</option>
										<option value="11">Reembolsado</option>
										<option value="9">Reversão Cancelada</option>
										<option value="12">Revertida</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>Situação:</td>
								<td>
									<select name="free_checkout_status">
										<option value="1" selected="selected">Habilitado</option>
										<option value="0">Desabilitado</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>Ordem:</td>
								<td><input type="text" name="free_checkout_sort_order" value="1" size="1" /></td>
							</tr>
						</tbody>
					</table>
				</div>
			</form>
		</div>
	</div>
</div>

<?php echo $footer; ?> 