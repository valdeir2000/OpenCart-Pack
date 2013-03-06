<?php echo $header; ?>

<div id="content">
	<!--------------- -->
	<!--   Content    -->
	<!--------------- -->
	<div class="box">
	
		<div class="attention">Habilite os vqmods da Akatus no passo 7</div>
	
		<!--------------- -->
		<!--   Heading    -->
		<!--------------- -->
		<div class="heading">
			<h1 style="background-image: url('view/image/payment.png');">Akatus</h1>
			<div class="buttons">
				<a onclick="$('#form').submit();" class="button"><span>Salvar</span></a>
				<a href="index.php?route=step_5" class="button"><span>Cancelar</span></a>
			</div>
		</div>
		<div class="content" style="min-height:1100px;">
			<!--------------- -->
			<!--     Tabs     -->
			<!--------------- -->
			<div id="vtabs" class="vtabs">
				<a href="#tab-config" style="" class="selected">Configuração</a>
				<a href="#tab-statusPayment" style="">Status de Pagamento</a>
				<a href="#tab-areaAndOrder" style="">Área e Ordem</a>
				<a href="#tab-plots" style="">Parcelas</a>
				<a href="#tab-paymentMethod" style="">Métodos de Pagamento</a>
			</div>
			<!--------------- -->
			<!--Configurações -->
			<!--------------- -->
			<div id="tab-config" style="display: block;">
				<form method="post" enctype="multipart/form-data" id="form" action="index.php?route=step_5/configure&next=true">
					<table class="form" style="width:auto !important">
						<tbody>
							<tr>
								<td>Situação:</td>
								<td>
									<select name="akatus_status">
										<option value="1">Habilitado</option>
										<option value="0" selected="selected">Desabilitado</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>E-mail:</td>
								<td><input type="text" name="akatus_email" value="" /></td>
							</tr>
							<tr>
								<td>Api Key:</td>
								<td><input type="text" name="akatus_apiKey" value="" /></td>
							</tr>
							<tr>
								<td>Notificar Clientes?</td>
								<td>
									<select name="akatus_notify">
										<option value="1">Habilitado</option>
										<option value="0" selected="selected">Desabilitado</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>Api Nip:</td>
								<td><input type="text" name="akatus_apiNip" value="" /></td>
							</tr>
							<tr>
								<td>Exibi valor total da parcela?</td>
								<td>
									<select name="akatus_valorTotalParcela">
										<option value="1">Habilitado</option>
										<option value="0" selected="selected">Desabilitado</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>Desconto no Cartão de Crédito:</td>
								<td>
									<select name="akatus_descontoCartao">
										<option value="1">Habilitado</option>
										<option value="0" selected="selected">Desabilitado</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>Desconto no Cartão de Débito:</td>
								<td>
									<select name="akatus_descontoDebito">
										<option value="1">Habilitado</option>
										<option value="0" selected="selected">Desabilitado</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>Desconto no Boleto:</td>
								<td>
									<select name="akatus_descontoBoleto">
										<option value="1">Habilitado</option>
										<option value="0" selected="selected">Desabilitado</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									Etapa 5:								<span class="help">Deseja Ocultar a Etapa 5 do Checkout?</span>
								</td>
								<td>
									<select name="akatus_activeStepFive">
										<option value="1">Habilitado</option>
										<option value="0" selected="selected">Desabilitado</option>
									</select>
								</td>
							</tr>
						</tbody>
					</table>
				</form>
			</div>
			<!--------------- -->
			<!--  Pagamento   -->
			<!--------------- -->
			<div id="tab-statusPayment" style="display: none;">
				<table class="form" style="width:auto !important">
					<!--------------- -->
					<!--  Aguard Pag. -->
					<!--------------- -->
					<tbody>
						<tr>
							<td>Aguardando Pagamento:</td>
							<td>
								<select name="akatus_status_pending" <option="" value="16">Anulado
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
						<!--------------- -->
						<!--   Aprovado   -->
						<!--------------- -->
						<tr>
							<td>Aprovado:</td>
							<td>
								<select name="akatus_status_complete" <option="" value="16">Anulado
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
						<!--------------- -->
						<!--  Cancelado   -->
						<!--------------- -->
						<tr>
							<td>Cancelado:</td>
							<td>
								<select name="akatus_status_canceled" <option="" value="16">Anulado
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
						<!--------------- -->
						<!--  Em Analise  -->
						<!--------------- -->
						<tr>
							<td>Em análise:</td>
							<td>
								<select name="akatus_status_analysing" <option="" value="16">Anulado
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
					</tbody>
				</table>
			</div>
			<!--------------- -->
			<!-- Area e Ordem -->
			<!--------------- -->
			<div id="tab-areaAndOrder" style="display: none;">
				<table class="form" style="width: auto !important">
					<!--------------- -->
					<!--     Area     -->
					<!--------------- -->
					<tbody>
						<tr>
							<td>Área Geográfica:</td>
							<td>
								<select name="akatus_area">
									<option value="0">Todas as Áreas</option>
								</select>
							</td>
						</tr>
						<!--------------- -->
						<!--    Ordem     -->
						<!--------------- -->
						<tr>
							<td>Ordem:</td>
							<td><input type="text" name="akatus_order" value="" /></td>
						</tr>
					</tbody>
				</table>
			</div>
			<!--------------- -->
			<!--   Parcelas   -->
			<!--------------- -->
			<div id="tab-plots" style="display: none;">
				<table class="list" style="margin:10px 0 0 200px;width:85% !important;">
					<thead>
						<tr>
							<td class="left">De</td>
							<td class="left">Para</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="left">
								<select name="akatus_parcelas[0][de]">
									<option value="1" selected="selected">1</option>
								</select>
							</td>
							<td class="left">
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
			</div>
			<!--------------- -->
			<!--  Pagamento   -->
			<!--------------- -->
			<div id="tab-paymentMethod" style="display: none;">
				<table class="form" style="width: auto !important;">
					<!--------------- -->
					<!--   Cartão    -->
					<!--------------- -->
					<tbody>
						<tr>
							<td>Cartão de Crédito:</td>
							<td>
								<select name="akatus_accCartao">
									<option value="1">Habilitado</option>
									<option value="0" selected="selected">Desabilitado</option>
								</select>
							</td>
						</tr>
						<!--------------- -->
						<!--   Débito    -->
						<!--------------- -->
						<tr>
							<td>Cartão de Débito:</td>
							<td>
								<select name="akatus_accDebito">
									<option value="1">Habilitado</option>
									<option value="0" selected="selected">Desabilitado</option>
								</select>
							</td>
						</tr>
						<!--------------- -->
						<!--   Boleto    -->
						<!--------------- -->
						<tr>
							<td>Boleto:</td>
							<td>
								<select name="akatus_accBoleto">
									<option value="1">Habilitado</option>
									<option value="0" selected="selected">Desabilitado</option>
								</select>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script><!--

	$('.vtabs a').tabs();

//--></script>

<?php echo $footer; ?>
