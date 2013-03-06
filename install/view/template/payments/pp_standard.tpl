<?php echo $header; ?>
<div id="content">
	<div class="box">
		<div class="heading">
			<h1>PayPal</h1>
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
							<td><span class="required">*</span> E-mail:</td>
							<td><input type="text" name="pp_standard_email" value="" />
							</td>
						</tr>
						<tr>
							<td>Modo de Teste:</td>
							<td>
								<input type="radio" name="pp_standard_test" value="1" />Sim
								<input type="radio" name="pp_standard_test" value="0" checked="checked" />Não              
							</td>
						</tr>
						<tr>
							<td>Método de Transação:</td>
							<td>
								<select name="pp_standard_transaction">
									<option value="0" selected="selected">Autorização</option>
									<option value="1">Venda</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>Modo de Debug:<br /><span class="help">Logs de informações adicionais para o sistema de log.</span></td>
							<td>
								<select name="pp_standard_debug">
									<option value="1">Habilitado</option>
									<option value="0" selected="selected">Desabilitado</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>Total Mínimo:<br /><span class="help">Total mínimo que o pedido deve alcançar para que este método de pagamento seja habilitado.</span></td>
							<td><input type="text" name="pp_standard_total" value="" /></td>
						</tr>
						<tr>
							<td>Situação do Cancelamento Revertido:<br /><span class="help">Isto significa que uma reversão foi cancelada, por exemplo, você, o comerciante, ganhou uma disputa com o cliente e os fundos para a operação, que foi revertida foram devolvidos.</span></td>
							<td>
								<select name="pp_standard_canceled_reversal_status_id">
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
							<td>Situação do Pedido Completo:</td>
							<td>
								<select name="pp_standard_completed_status_id">
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
							<td>Situação do Pedido Negado:</td>
							<td>
								<select name="pp_standard_denied_status_id">
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
							<td>Situação do Pedido Expirado:</td>
							<td>
								<select name="pp_standard_expired_status_id">
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
							<td>Situação do Pedido que Falhou:</td>
							<td>
								<select name="pp_standard_failed_status_id">
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
							<td>Situação do Pedido Pendente:</td>
							<td>
								<select name="pp_standard_pending_status_id">
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
							<td>Situação do Pedido Processando:</td>
							<td>
								<select name="pp_standard_processed_status_id">
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
							<td>Situação do Pedido Reembolsado :</td>
							<td>
								<select name="pp_standard_refunded_status_id">
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
							<td>Situação do Pedido Invertido:</td>
							<td>
								<select name="pp_standard_reversed_status_id">
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
							<td>Situação do Pedido Cancelado</td>
							<td>
								<select name="pp_standard_voided_status_id">
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
								<select name="pp_standard_geo_zone_id">
									<option value="0">Todas as Regiões</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>Situação:</td>
							<td>
								<select name="pp_standard_status">
									<option value="1">Habilitado</option>
									<option value="0" selected="selected">Desabilitado</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>Ordem:</td>
							<td><input type="text" name="pp_standard_sort_order" value="" size="1" /></td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
	</div>
</div>

<?php echo $footer; ?> 