<?php echo $header; ?>
<div id="content">
	
	<!--------------- -->
	<!--  Breadcrumb  -->
	<!--------------- -->
	<div class="breadcrumb">
		<?php foreach ($breadcrumbs as $breadcrumb): ?>
		<?php echo $breadcrumb['separator'] ?><a href="<?php echo $breadcrumb['href'] ?>"><?php echo $breadcrumb['text'] ?></a>
		<?php endforeach; ?>
	</div>
	
	<!--------------- -->
	<!--   Content    -->
	<!--------------- -->
	<div class="box">
		
		<!--------------- -->
		<!--   Heading    -->
		<!--------------- -->
		<div class="heading">
			<h1 style="background-image: url('view/image/payment.png');"><?php echo $heading_title; ?></h1>
			<div class="buttons">
				<a onclick="$('#form').submit();" class="button"><span><?php echo $btn_save ?></span></a>
				<a onclick="location='<?php echo $cancel; ?>';" class="button"><span><?php echo $btn_cancel ?></span></a>
			</div>
		</div>
		<div class="content" style="min-height:1100px;">
			
			<!--------------- -->
			<!--     Tabs     -->
			<!--------------- -->
			<div id="vtabs" class="vtabs">
				<a href="#tab-config"><?php echo $tab_config ?></a>
				<a href="#tab-statusPayment"><?php echo $tab_statusPayment ?></a>
				<a href="#tab-areaAndOrder"><?php echo $tab_areaAndOrder ?></a>
				<a href="#tab-plots"><?php echo $tab_plots ?></a>
				<a href="#tab-paymentMethod"><?php echo $tab_paymentMethod ?></a>
			</div>
			
			<!--------------- -->
			<!--Configurações -->
			<!--------------- -->
			<div id="tab-config">
				<form method="post" enctype="multipart/form-data" id="form" action="<?php echo $action ?>">
					<table class="form" style="width:auto !important">
						<tr>
							<td><?php echo $text_situacao ?></td>
							<td>
								<select name="akatus_status">
									<?php if ($akatus_status == 1): ?>
									<option value="1" selected="selected"><?php echo $text_enabled ?></option>
									<?php else: ?>
									<option value="1"><?php echo $text_enabled ?></option>
									<?php endif ?>
									<?php if ($akatus_status == 0): ?>
									<option value="0" selected="selected"><?php echo $text_disabled ?></option>
									<?php else: ?>
									<option value="0"><?php echo $text_disabled ?></option>
									<?php endif ?>
								</select>
							</td>
						</tr>

						<tr>
							<td><?php echo $text_email ?></td>
							<td><input type="text" name="akatus_email" value="<?php echo $akatus_email ?>" /></td>
						</tr>

						<tr>
							<td><?php echo $text_apiKey ?></td>
							<td><input type="text" name="akatus_apiKey" value="<?php echo $akatus_apiKey ?>" /></td>
						</tr>

						<tr>
							<td><?php echo $text_notify ?></td>
							<td>
								<select name="akatus_notify">
									<?php if ($akatus_notify == 1): ?>
									<option value="1" selected="selected"><?php echo $text_enabled ?></option>
									<?php else: ?>
									<option value="1"><?php echo $text_enabled ?></option>
									<?php endif ?>
									<?php if ($akatus_notify == 0): ?>
									<option value="0" selected="selected"><?php echo $text_disabled ?></option>
									<?php else: ?>
									<option value="0"><?php echo $text_disabled ?></option>
									<?php endif ?>
								</select>
							</td>
						</tr>

						<tr>
							<td><?php echo $text_apiNip ?></td>
							<td><input type="text" name="akatus_apiNip" value="<?php echo $akatus_apiNip ?>" /></td>
						</tr>

						<tr>
							<td><?php echo $text_exibiTotalParcela ?></td>
							<td>
								<select name="akatus_valorTotalParcela">
									<?php if ($akatus_valorTotalParcela == 1): ?>
									<option value="1" selected="selected"><?php echo $text_enabled ?></option>
									<?php else: ?>
									<option value="1"><?php echo $text_enabled ?></option>
									<?php endif ?>
									<?php if ($akatus_valorTotalParcela == 0): ?>
									<option value="0" selected="selected"><?php echo $text_disabled ?></option>
									<?php else: ?>
									<option value="0"><?php echo $text_disabled ?></option>
									<?php endif; ?>
								</select>
							</td>
						</tr>
						
						<tr>
							<td><?php echo $text_descontoCartao ?></td>
							<td>
								<select name="akatus_descontoCartao">
									<?php if ($akatus_descontoCartao == 1): ?>
									<option value="1" selected="selected"><?php echo $text_enabled ?></option>
									<?php else: ?>
									<option value="1"><?php echo $text_enabled ?></option>
									<?php endif; ?>
									
									<?php if ($akatus_descontoCartao == 0): ?>
									<option value="0" selected="selected"><?php echo $text_disabled ?></option>
									<?php else: ?>
									<option value="0"><?php echo $text_disabled ?></option>
									<?php endif; ?>
								</select>
							</td>
						</tr>
						
						<tr>
							<td><?php echo $text_descontoDebito ?></td>
							<td>
								<select name="akatus_descontoDebito">
									<?php if ($akatus_descontoDebito == 1): ?>
									<option value="1" selected="selected"><?php echo $text_enabled ?></option>
									<?php else: ?>
									<option value="1"><?php echo $text_enabled ?></option>
									<?php endif; ?>
									
									<?php if ($akatus_descontoDebito == 0): ?>
									<option value="0" selected="selected"><?php echo $text_disabled ?></option>
									<?php else: ?>
									<option value="0"><?php echo $text_disabled ?></option>
									<?php endif; ?>
								</select>
							</td>
						</tr>
						
						<tr>
							<td><?php echo $text_descontoBoleto ?></td>
							<td>
								<select name="akatus_descontoBoleto">
									<?php if ($akatus_descontoBoleto == 1): ?>
										<option value="1" selected="selected"><?php echo $text_enabled ?></option>
									<?php else: ?>
									<option value="1"><?php echo $text_enabled ?></option>
									<?php endif ?>
									
									<?php if ($akatus_descontoBoleto == 0): ?>
									<option value="0" selected="selected"><?php echo $text_disabled ?></option>
									<?php else: ?>
									<option value="0"><?php echo $text_disabled ?></option>
									<?php endif; ?>
								</select>
							</td>
						</tr>
						
						<tr>
							<td>
								<?php echo $text_activeStepFive; ?>
								<span class="help"><?php echo $help_activeStepFive ?></span>
							</td>
							<td>
								<select name="akatus_activeStepFive">
									<?php if ($akatus_activeStepFive == 1): ?>
									<option value="1" selected="selected"><?php echo $text_enabled ?></option>
									<?php else: ?>
									<option value="1"><?php echo $text_enabled ?></option>
									<?php endif; ?>
									
									<?php if ($akatus_activeStepFive == 0): ?>
									<option value="0" selected="selected"><?php echo $text_disabled ?></option>
									<?php else: ?>
									<option value="0"><?php echo $text_disabled ?></option>
									<?php endif; ?>
								</select>
							</td>
						</tr>
					</table>
				</div>

				<!--------------- -->
				<!--  Pagamento   -->
				<!--------------- -->
				<div id="tab-statusPayment">
					<table class="form" style="width:auto !important">

						<!--------------- -->
						<!--  Aguard Pag. -->
						<!--------------- -->
						<tr>
							<td><?php echo $text_status_pending ?></td>
							<td>
								<select name="akatus_status_pending"
									<?php foreach ($order_statuses as $order_status): ?>
									<?php if ($akatus_status_pending == $order_status['order_status_id']): ?>
									<option value="<?php echo $order_status['order_status_id'] ?>" selected="selected"><?php echo $order_status['name'] ?></option>
									<?php else: ?>
									<option value="<?php echo $order_status['order_status_id'] ?>"><?php echo $order_status['name'] ?></option>
									<?php endif ?>
									<?php endforeach ?>
								</select>
							</td>
						</tr>

						<!--------------- -->
						<!--   Aprovado   -->
						<!--------------- -->
						<tr>
							<td><?php echo $text_status_complete ?></td>
							<td>
								<select name="akatus_status_complete"
									<?php foreach ($order_statuses as $order_status): ?>
									<?php if ($akatus_status_complete == $order_status['order_status_id']): ?>
									<option value="<?php echo $order_status['order_status_id'] ?>" selected="selected"><?php echo $order_status['name'] ?></option>
									<?php else: ?>
									<option value="<?php echo $order_status['order_status_id'] ?>"><?php echo $order_status['name'] ?></option>
									<?php endif ?>
									<?php endforeach ?>
								</select>
							</td>
						</tr>

						<!--------------- -->
						<!--  Cancelado   -->
						<!--------------- -->
						<tr>
							<td><?php echo $text_status_canceled ?></td>
							<td>
								<select name="akatus_status_canceled"
									<?php foreach ($order_statuses as $order_status): ?>
									<?php if ($akatus_status_canceled == $order_status['order_status_id']): ?>
									<option value="<?php echo $order_status['order_status_id'] ?>" selected="selected"><?php echo $order_status['name'] ?></option>
									<?php else: ?>
									<option value="<?php echo $order_status['order_status_id'] ?>"><?php echo $order_status['name'] ?></option>
									<?php endif ?>
									<?php endforeach ?>
								</select>
							</td>
						</tr>

						<!--------------- -->
						<!--  Em Analise  -->
						<!--------------- -->
						<tr>
							<td><?php echo $text_status_analysing ?></td>
							<td>
								<select name="akatus_status_analysing"
									<?php foreach ($order_statuses as $order_status): ?>
									<?php if ($akatus_status_analysing == $order_status['order_status_id']): ?>
									<option value="<?php echo $order_status['order_status_id'] ?>" selected="selected"><?php echo $order_status['name'] ?></option>
									<?php else: ?>
									<option value="<?php echo $order_status['order_status_id'] ?>"><?php echo $order_status['name'] ?></option>
									<?php endif ?>
									<?php endforeach ?>
								</select>
							</td>
						</tr>
					</table>
				</div>


				<!--------------- -->
				<!-- Area e Ordem -->
				<!--------------- -->
				<div id="tab-areaAndOrder">
					<table class="form" style="width: auto !important">

						<!--------------- -->
						<!--     Area     -->
						<!--------------- -->
						<tr>
							<td><?php echo $text_area ?></td>
							<td>
								<select name="akatus_area">
									<option value="0"><?php echo $text_todasAreas ?></option>
									<?php foreach ($geo_zones as $geo_zone): ?>
									<?php if ($akatus_area == $geo_zone['geo_zone_id']): ?>
									<option value="<?php echo $geo_zone['geo_zone_id'] ?>" selected="selected"><?php echo $geo_zone['name'] ?></option>
									<?php else: ?>
									<option value="<?php echo $geo_zone['geo_zone_id'] ?>"><?php echo $geo_zone['name'] ?></option>
									<?php endif ?>
									<?php endforeach ?>
								</select>
							</td>
						</tr>

						<!--------------- -->
						<!--    Ordem     -->
						<!--------------- -->
						<tr>
							<td><?php echo $text_order ?></td>
							<td><input type="text" name="akatus_order" value="<?php echo $akatus_order ?>" /></td>
						</tr>
					</table>
				</div>


				<!--------------- -->
				<!--   Parcelas   -->
				<!--------------- -->
				<div id="tab-plots">
					<table class="list" style="margin:10px 0 0 200px;width:85% !important;">
						<thead>
							<tr>
								<td class="left"><?php echo $text_parcela_de ?></td>
								<td class="left"><?php echo $text_parcela_para ?></td>
							</tr>
						</thead>

						<?php $module_row = 0; ?>
						<tbody>
							<tr>
								<td class="left">
									<select name="akatus_parcelas[<?php echo $module_row ?>][de]">
										<option value="1" selected="selected">1</option>
									</select>
								</td>
								<td class="left">
									<select name="akatus_parcelas[<?php echo $module_row ?>][para]">
										<?php if($akatus_parcelas[0]['para'] == 1): ?>
										<option value="1" selected="selected">1</option>
										<?php else: ?>
										<option value="1">1</option>
										<?php endif ?>
										<?php if($akatus_parcelas[0]['para'] == 2): ?>
										<option value="2" selected="selected">2</option>
										<?php else: ?>
										<option value="2">2</option>
										<?php endif ?>
										<?php if($akatus_parcelas[0]['para'] == 3): ?>
										<option value="3" selected="selected">3</option>
										<?php else: ?>
										<option value="3">3</option>
										<?php endif ?>
										<?php if($akatus_parcelas[0]['para'] == 4): ?>
										<option value="4" selected="selected">4</option>
										<?php else: ?>
										<option value="4">4</option>
										<?php endif ?>
										<?php if($akatus_parcelas[0]['para'] == 5): ?>
										<option value="5" selected="selected">5</option>
										<?php else: ?>
										<option value="5">5</option>
										<?php endif ?>
										<?php if($akatus_parcelas[0]['para'] == 6): ?>
										<option value="6" selected="selected">6</option>
										<?php else: ?>
										<option value="6">6</option>
										<?php endif ?>
										<?php if($akatus_parcelas[0]['para'] == 7): ?>
										<option value="7" selected="selected">7</option>
										<?php else: ?>
										<option value="7">7</option>
										<?php endif ?>
										<?php if($akatus_parcelas[0]['para'] == 8): ?>
										<option value="8" selected="selected">8</option>
										<?php else: ?>
										<option value="8">8</option>
										<?php endif ?>
										<?php if($akatus_parcelas[0]['para'] == 9): ?>
										<option value="9" selected="selected">9</option>
										<?php else: ?>
										<option value="9">9</option>
										<?php endif ?>
										<?php if($akatus_parcelas[0]['para'] == 10): ?>
										<option value="10" selected="selected">10</option>
										<?php else: ?>
										<option value="10">10</option>
										<?php endif ?>
										<?php if($akatus_parcelas[0]['para'] == 11): ?>
										<option value="11" selected="selected">11</option>
										<?php else: ?>
										<option value="11">11</option>
										<?php endif ?>
										<?php if($akatus_parcelas[0]['para'] == 12): ?>
										<option value="12" selected="selected">12</option>
										<?php else: ?>
										<option value="12">12</option>
										<?php endif ?>
									</select>
								</td>
							</tr>
						</tbody>
					</table>
				</div>


				<!--------------- -->
				<!--  Pagamento   -->
				<!--------------- -->
				<div id="tab-paymentMethod">
					<table class="form" style="width: auto !important;">

						<!--------------- -->
						<!--   Cartão    -->
						<!--------------- -->
						<tr>
							<td><?php echo $text_cartaoCredito ?></td>
							<td>
								<select name="akatus_accCartao">
									<?php if($akatus_accCartao == 1): ?>
									<option value="1" selected="selected"><?php echo $text_enabled ?></option>
									<?php else: ?>
									<option value="1"><?php echo $text_enabled ?></option>
									<?php endif ?>
									<?php if($akatus_accCartao == 0): ?>
									<option value="0" selected="selected"><?php echo $text_disabled ?></option>
									<?php else: ?>
									<option value="0"><?php echo $text_disabled ?></option>
									<?php endif; ?>
								</select>
							</td>
						</tr>

						<!--------------- -->
						<!--   Débito    -->
						<!--------------- -->
						<tr>
							<td><?php echo $text_cartaoDebito ?></td>
							<td>
								<select name="akatus_accDebito">
									<?php if($akatus_accDebito == 1): ?>
									<option value="1" selected="selected"><?php echo $text_enabled ?></option>
									<?php else: ?>
									<option value="1"><?php echo $text_enabled ?></option>
									<?php endif ?>
									<?php if($akatus_accDebito == 0): ?>
									<option value="0" selected="selected"><?php echo $text_disabled ?></option>
									<?php else: ?>
									<option value="0"><?php echo $text_disabled ?></option>
									<?php endif; ?>
								</select>
							</td>
						</tr>

						<!--------------- -->
						<!--   Boleto    -->
						<!--------------- -->
						<tr>
							<td><?php echo $text_boletoBancario ?></td>
							<td>
								<select name="akatus_accBoleto">
									<?php if($akatus_accBoleto == 1): ?>
									<option value="1" selected="selected"><?php echo $text_enabled ?></option>
									<?php else: ?>
									<option value="1"><?php echo $text_enabled ?></option>
									<?php endif ?>
									<?php if($akatus_accBoleto == 0): ?>
									<option value="0" selected="selected"><?php echo $text_disabled ?></option>
									<?php else: ?>
									<option value="0"><?php echo $text_disabled ?></option>
									<?php endif; ?>
								</select>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</form>
	</div>
</div>
<script><!--

	$('.vtabs a').tabs();

//--></script>
<?php echo $footer; ?>
