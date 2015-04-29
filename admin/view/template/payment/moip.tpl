<?php echo $header ?><?php echo $column_left ?>
<div id="content">
	
	<!-- Page Header -->
	<div class="page-header">
		<div class="container-fluid">
		
			<div class="pull-right">
				<button type="submit" form="form-moip" data-toggle="tooltip" title="Save" class="btn btn-primary"><i class="fa fa-save"></i></button>
				<a href="#" data-toggle="tooltip" title="Cancel" class="btn btn-default"><i class="fa fa-reply"></i></a>	
			</div>
			
			<h1><?php echo $heading_title ?></h1>
			
			<ul class="breadcrumb">
				<?php foreach ($breadcrumbs as $breadcrumb) { ?>
				<li><a href="<?php echo $breadcrumb['href'] ?>"><?php echo $breadcrumb['text'] ?></a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
	
	<!-- Container -->
	<div class="container-fluid">
	
		<!-- Error -->
		<?php if ($error_warning) { ?>
		<div class="alert alert-danger">
		  <i class="fa fa-exclamation-circle"></i> <?php echo $error_warning ?>
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		</div>
		<?php } ?>
		
		<!-- Panel -->
		<div class="panel panel-default">
		
			<!-- Title -->
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $heading_title ?></h3>
			</div>
			
			<!-- Body -->
			<div class="panel-body">

				<!-- Form -->
				<form action="<?php echo $action ?>" method="post" enctype="multipart/form-data" id="form-moip" class="form-horizontal">

					<!-- Nav -->
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#config"><?php echo $tab_config ?></a></li>
						<li><a data-toggle="tab" href="#payment-status"><?php echo $tab_status_payment ?></a></li>
						<li><a data-toggle="tab" href="#area"><?php echo $tab_geo_zone ?></a></li>
						<li><a data-toggle="tab" href="#plots"><?php echo $tab_plots ?></a></li>
						<li><a data-toggle="tab" href="#billet"><?php echo $tab_billet ?></a></li>
						<li><a data-toggle="tab" href="#payment-method"><?php echo $tab_payment_method ?></a></li>
					</ul>

					<div class="tab-content">
						
						<!-- Tab Config -->
						<div class="tab-pane active" id="config">
							
							<!-- Status -->
							<div class="form-group required">
								<label class="col-sm-2 control-label" for="moip_status"><?php echo $entry_status ?></label>
								<div class="col-sm-10">
									<select name="moip_status" id="moip_status" class="form-control">
										<?php if ($moip_status) { ?>
										<option value="1" selected><?php echo $text_enabled ?></option>
										<?php } else { ?>
										<option value="1"><?php echo $text_enabled ?></option>
										<?php } ?>
										
										<?php if (!$moip_status) { ?>
										<option value="0" selected><?php echo $text_disabled ?></option>
										<?php } else { ?>
										<option value="0"><?php echo $text_disabled ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							
							<!-- Razão do Pagamento -->
							<div class="form-group required">
								<label class="col-sm-2 control-label" for="moip_razao_pagamento"><?php echo $entry_razao_pagamento ?></label>
								<div class="col-sm-10">
									<input type="text" name="moip_razao_pagamento" id="moip_razao_pagamento" class="form-control" value="<?php echo $moip_razao_pagamento ?>" />
									<?php if ($error_razao_pagamento) { ?>
									<div class="text-danger"><?php echo $error_razao_pagamento ?></div>
									<?php } ?>
								</div>
							</div>
							
							<!-- Token -->
							<div class="form-group required">
								<label class="col-sm-2 control-label" for=""><?php echo $entry_token ?></label>
								<div class="col-sm-10">
									<input type="text" name="moip_token" value="<?php echo $moip_token ?>" class="form-control" />
									<?php if ($error_token) { ?>
									<div class="text-danger"><?php echo $error_token ?></div>
									<?php } ?>
								</div>
							</div>
							
							<!-- Key -->
							<div class="form-group required">
								<label class="col-sm-2 control-label" for=""><?php echo $entry_key ?></label>
								<div class="col-sm-10">
									<input type="text" name="moip_key" value="<?php echo $moip_key ?>" class="form-control" />
									<?php if ($error_key) { ?>
									<div class="text-danger"><?php echo $error_key ?></div>
									<?php } ?>
								</div>
							</div>
							
							<!-- Modo de Teste -->
							<div class="form-group required">
								<label class="col-sm-2 control-label" for=""><?php echo $entry_modo_teste ?></label>
								<div class="col-sm-10">
									<?php if ($moip_modo_teste) { ?>
									<label class="radio-inline"><input type="radio" name="moip_modo_teste" value="1" checked /> <?php echo $text_yes ?></label>
									<?php } else { ?>
									<label class="radio-inline"><input type="radio" name="moip_modo_teste" value="1" /> <?php echo $text_yes ?></label>
									<?php } ?>
									
									<?php if (!$moip_modo_teste) { ?>
									<label class="radio-inline"><input type="radio" name="moip_modo_teste" value="0" checked /> <?php echo $text_no ?></label>
									<?php } else { ?>
									<label class="radio-inline"><input type="radio" name="moip_modo_teste" value="0" /> <?php echo $text_no ?></label>
									<?php } ?>
								</div>
							</div>
							
							<!-- Notificar Cliente -->
							<div class="form-group required">
								<label class="col-sm-2 control-label"><?php echo $entry_notificar_cliente ?></label>
								<div class="col-sm-10">
									<?php if ($moip_notificar_cliente) { ?>
									<label class="radio-inline"><input type="radio" name="moip_notificar_cliente" value="1" checked /> <?php echo $text_yes ?></label>
									<?php } else { ?>
									<label class="radio-inline"><input type="radio" name="moip_notificar_cliente" value="1" /> <?php echo $text_yes ?></label>
									<?php } ?>
									
									<?php if (!$moip_notificar_cliente) { ?>
									<label class="radio-inline"><input type="radio" name="moip_notificar_cliente" value="0" checked /> <?php echo $text_no ?></label>
									<?php } else { ?>
									<label class="radio-inline"><input type="radio" name="moip_notificar_cliente" value="0" /> <?php echo $text_no ?></label>
									<?php } ?>
								</div>
							</div>
							
							<!-- Desconto Boleto -->
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $entry_desconto_boleto ?></label>
								<div class="col-sm-10">
									<input class="form-control" name="moip_desconto_boleto" value="<?php echo $moip_desconto_boleto ?>" type="text" />
								</div>
							</div>
							
							<!-- Desconto Débito -->
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $entry_desconto_debito ?></label>
								<div class="col-sm-10">
									<input class="form-control" name="moip_desconto_debito" value="<?php echo $moip_desconto_debito ?>" type="text" />
								</div>
							</div>
							
							<!-- Desconto Cartão de Crédito -->
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $entry_desconto_cartao ?></label>
								<div class="col-sm-10">
									<input class="form-control" name="moip_desconto_cartao" value="<?php echo $moip_desconto_cartao ?>" type="text" />
								</div>
							</div>
						</div>
						
						<!-- Tab Status de Pagamento -->
						<div class="tab-pane" id="payment-status">
						
							<!-- Status Autorizado -->
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $entry_autorizado ?></label>
								<div class="col-sm-10">
									<select name="moip_autorizado" class="form-control">
										<?php foreach($statuses as $status) { ?>
										<?php if ($moip_autorizado == $status['order_status_id']) { ?>
										<option value="<?php echo $status['order_status_id'] ?>" selected><?php echo $status['name'] ?></option>
										<?php } else { ?>
										<option value="<?php echo $status['order_status_id'] ?>"><?php echo $status['name'] ?></option>
										<?php } ?>
										<?php } ?>
									</select>
								</div>
							</div>
							
							<!-- Status Iniciado -->
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $entry_iniciado ?></label>
								<div class="col-sm-10">
									<select name="moip_iniciado" class="form-control">
										<?php foreach($statuses as $status) { ?>
										<?php if ($moip_iniciado == $status['order_status_id']) { ?>
										<option value="<?php echo $status['order_status_id'] ?>" selected><?php echo $status['name'] ?></option>
										<?php } else { ?>
										<option value="<?php echo $status['order_status_id'] ?>"><?php echo $status['name'] ?></option>
										<?php } ?>
										<?php } ?>
									</select>
								</div>
							</div>
							
							<!-- Status Boleto Impresso -->
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $entry_boleto_impresso ?></label>
								<div class="col-sm-10">
									<select name="moip_boleto_impresso" class="form-control">
										<?php foreach($statuses as $status) { ?>
										<?php if ($moip_boleto_impresso == $status['order_status_id']) { ?>
										<option value="<?php echo $status['order_status_id'] ?>" selected><?php echo $status['name'] ?></option>
										<?php } else { ?>
										<option value="<?php echo $status['order_status_id'] ?>"><?php echo $status['name'] ?></option>
										<?php } ?>
										<?php } ?>
									</select>
								</div>
							</div>
							
							<!-- Status Completo -->
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $entry_completo ?></label>
								<div class="col-sm-10">
									<select name="moip_completo" class="form-control">
										<?php foreach($statuses as $status) { ?>
										<?php if ($moip_completo == $status['order_status_id']) { ?>
										<option value="<?php echo $status['order_status_id'] ?>" selected><?php echo $status['name'] ?></option>
										<?php } else { ?>
										<option value="<?php echo $status['order_status_id'] ?>"><?php echo $status['name'] ?></option>
										<?php } ?>
										<?php } ?>
									</select>
								</div>
							</div>
							
							<!-- Status Cancelado -->
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $entry_cancelado ?></label>
								<div class="col-sm-10">
									<select name="moip_cancelado" class="form-control">
										<?php foreach($statuses as $status) { ?>
										<?php if ($moip_cancelado == $status['order_status_id']) { ?>
										<option value="<?php echo $status['order_status_id'] ?>" selected><?php echo $status['name'] ?></option>
										<?php } else { ?>
										<option value="<?php echo $status['order_status_id'] ?>"><?php echo $status['name'] ?></option>
										<?php } ?>
										<?php } ?>
									</select>
								</div>
							</div>
							
							<!-- Status Em Análise -->
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $entry_em_analise ?></label>
								<div class="col-sm-10">
									<select name="moip_em_analise" class="form-control">
										<?php foreach($statuses as $status) { ?>
										<?php if ($moip_em_analise == $status['order_status_id']) { ?>
										<option value="<?php echo $status['order_status_id'] ?>" selected><?php echo $status['name'] ?></option>
										<?php } else { ?>
										<option value="<?php echo $status['order_status_id'] ?>"><?php echo $status['name'] ?></option>
										<?php } ?>
										<?php } ?>
									</select>
								</div>
							</div>
							
							<!-- Status Revertido -->
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $entry_revertido ?></label>
								<div class="col-sm-10">
									<select name="moip_revertido" class="form-control">
										<?php foreach($statuses as $status) { ?>
										<?php if ($moip_revertido == $status['order_status_id']) { ?>
										<option value="<?php echo $status['order_status_id'] ?>" selected><?php echo $status['name'] ?></option>
										<?php } else { ?>
										<option value="<?php echo $status['order_status_id'] ?>"><?php echo $status['name'] ?></option>
										<?php } ?>
										<?php } ?>
									</select>
								</div>
							</div>
							
							<!-- Status Em Revisão -->
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $entry_em_revisao ?></label>
								<div class="col-sm-10">
									<select name="moip_em_revisao" class="form-control">
										<?php foreach($statuses as $status) { ?>
										<?php if ($moip_em_revisao == $status['order_status_id']) { ?>
										<option value="<?php echo $status['order_status_id'] ?>" selected><?php echo $status['name'] ?></option>
										<?php } else { ?>
										<option value="<?php echo $status['order_status_id'] ?>"><?php echo $status['name'] ?></option>
										<?php } ?>
										<?php } ?>
									</select>
								</div>
							</div>
							
							<!-- Status Reembolsado -->
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $entry_reembolsado ?></label>
								<div class="col-sm-10">
									<select name="moip_reembolsado" class="form-control">
										<?php foreach($statuses as $status) { ?>
										<?php if ($moip_reembolsado == $status['order_status_id']) { ?>
										<option value="<?php echo $status['order_status_id'] ?>" selected><?php echo $status['name'] ?></option>
										<?php } else { ?>
										<option value="<?php echo $status['order_status_id'] ?>"><?php echo $status['name'] ?></option>
										<?php } ?>
										<?php } ?>
									</select>
								</div>
							</div>							
						</div>
						
						<!-- Tab Área Geográfica e Ordem -->
						<div class="tab-pane" id="area">
							
							<!-- Área/Zona Geográfica -->
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $entry_geo_zone ?></label>
								<div class="col-sm-10">
									<select name="moip_geo_zone_id" class="form-control">
										<option value="0"><?php echo $text_all_zones ?></option>
										<?php foreach($zones as $zone) { ?>
										<?php if ($moip_geo_zone_id == $zone['geo_zone_id']) { ?>
										<option value="<?php echo $zone['geo_zone_id'] ?>"><?php echo $zone['name'] ?></option>
										<?php } else { ?>
										<option value="<?php echo $zone['geo_zone_id'] ?>"><?php echo $zone['name'] ?></option>
										<?php } ?>
										<?php } ?>
									</select>
								</div>
							</div>
							
							<!-- Ordem -->
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $entry_sort_order ?></label>
								<div class="col-sm-10">
									<input type="text" name="moip_sort_order" value="<?php echo $moip_sort_order ?>" class="form-control" />
								</div>
							</div>
						</div>
						
						<!-- Tab Parcelas -->
						<div class="tab-pane" id="plots">
						
							<!-- Parcelas -->
							<div class="form-group">
								
								<?php if ($error_parcelas) { ?>
								<div class="alert alert-danger"><?php echo $error_parcelas ?></div>
								<?php } ?>
								
								<table class="table table-bordered table-hover table-striped" id="table-plot">
									<thead>
										<tr>
											<th><?php echo $entry_parcela_de ?></th>
											<th><?php echo $entry_parcela_para ?></th>
											<th><?php echo $entry_parcela_juros ?></th>
											<th></th>
										</tr>
									</thead>
									
									<tbody>
										<?php $count_plot = 0; ?>
										<?php foreach($moip_parcela as $parcela) { ?>
										<tr id="plot<?php echo $count_plot ?>">
											<td>
												<select name="moip_parcela[<?php echo $count_plot ?>][de]" class="number-plots form-control">
													<?php for($i=2;$i<=12;$i++) { ?>
													<?php if ($parcela['de'] == $i) { ?>
													<option value="<?php echo $i ?>" selected><?php echo $i ?></option>
													<?php } else { ?>
													<option value="<?php echo $i ?>"><?php echo $i ?></option>
													<?php } ?>
													<?php } ?>
												</select>
											</td>
											<td>
												<select name="moip_parcela[<?php echo $count_plot ?>][para]" class="number-plots form-control">
													<?php for($i=2;$i<=12;$i++) { ?>
													<?php if ($parcela['para'] == $i) { ?>
													<option value="<?php echo $i ?>" selected><?php echo $i ?></option>
													<?php } else { ?>
													<option value="<?php echo $i ?>"><?php echo $i ?></option>
													<?php } ?>
													<?php } ?>
												</select>
											</td>
											<td><input type="text" name="moip_parcela[<?php echo $count_plot ?>][juros]" value="<?php echo $parcela['juros'] ?>" class="form-control" /></td>
											<td class="text-right"><button type="button" onClick="$('#plot<?php echo $count_plot ?>').remove()" class="btn btn-danger"><i class="fa fa-remove"></i></button></td>
										</tr>
										<?php $count_plot++ ?>
										<?php } ?>
									</tbody>
									
									<tfoot>
										<tr>
											<td colspan="4" class="text-right"><button type="button" id="add-plot" class="btn btn-primary"><i class="fa fa-plus"></i></button></td>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
						
						<!-- Tab Boleto -->
						<div class="tab-pane" id="billet">
							
							<!-- Vencimento -->
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $entry_boleto_vencimento ?></label>
								<div class="col-sm-10">
									<input type="text" name="moip_boleto_vencimento" value="<?php echo $moip_boleto_vencimento ?>" class="form-control" />
								</div>
							</div>
							
							<!-- Instrução 1 -->
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $entry_boleto_instrucao_1 ?></label>
								<div class="col-sm-10">
									<input type="text" name="moip_boleto_instrucao_1" value="<?php echo $moip_boleto_instrucao_1 ?>" class="form-control" />
								</div>
							</div>
							
							<!-- Instrução 2 -->
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $entry_boleto_instrucao_2 ?></label>
								<div class="col-sm-10">
									<input type="text" name="moip_boleto_instrucao_2" value="<?php echo $moip_boleto_instrucao_2 ?>" class="form-control" />
								</div>
							</div>
							
							<!-- Instrução 3 -->
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $entry_boleto_instrucao_3 ?></label>
								<div class="col-sm-10">
									<input type="text" name="moip_boleto_instrucao_3" value="<?php echo $moip_boleto_instrucao_3 ?>" class="form-control" />
								</div>
							</div>
							
							<!-- Logo -->
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $entry_boleto_logo ?></label>
								<div class="col-sm-10">
									<input type="text" name="moip_boleto_logo" value="<?php echo $moip_boleto_logo ?>" class="form-control" />
								</div>
							</div>
						</div>
						
						<!-- Tab Métodos de Pagamento -->
						<div class="tab-pane" id="payment-method">
							
							<!-- Cartão de Crédito -->
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $entry_cartao_credito ?></label>
								<div class="col-sm-10">
									<select name="moip_cartao" class="form-control">
										<?php if ($moip_cartao_credito) { ?>
										<option value="1" selected><?php echo $text_enabled ?></option>
										<?php } else { ?>
										<option value="1"><?php echo $text_enabled ?></option>
										<?php } ?>
										
										<?php if (!$moip_cartao_credito) { ?>
										<option value="0" selected><?php echo $text_disabled ?></option>
										<?php } else { ?>
										<option value="0"><?php echo $text_disabled ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							
							<!-- Cartão de Débito -->
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $entry_cartao_debito ?></label>
								<div class="col-sm-10">
									<select name="moip_debito" class="form-control">
										<?php if ($moip_debito) { ?>
										<option value="1" selected><?php echo $text_enabled ?></option>
										<?php } else { ?>
										<option value="1"><?php echo $text_enabled ?></option>
										<?php } ?>
										
										<?php if (!$moip_debito) { ?>
										<option value="0" selected><?php echo $text_disabled ?></option>
										<?php } else { ?>
										<option value="0"><?php echo $text_disabled ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							
							<!-- Boleto -->
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $entry_boleto ?></label>
								<div class="col-sm-10">
									<select name="moip_boleto" class="form-control">
										<?php if ($moip_boleto) { ?>
										<option value="1" selected><?php echo $text_enabled ?></option>
										<?php } else { ?>
										<option value="1"><?php echo $text_enabled ?></option>
										<?php } ?>
										
										<?php if (!$moip_boleto) { ?>
										<option value="0" selected><?php echo $text_disabled ?></option>
										<?php } else { ?>
										<option value="0"><?php echo $text_disabled ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var count_plot = <?php echo (int)$count_plot; ?>;
	$('#add-plot').click(function(){
			
		var html = '';
		
		html += '<tr id="plot' + count_plot + '">';
		html += '	<td>';
		html += '		<select name="moip_parcela[' + count_plot + '][de]" class="number-plots form-control">';
							for(i=2;i<=12;i++) {
		html += '			<option value="' + i + '">' + i + '</option>';
							}
		html += '		</select>';
		html += '	</td>';
		html += '	<td>';
		html += '		<select name="moip_parcela[' + count_plot + '][para]" class="number-plots form-control">';
							for(i=2;i<=12;i++) {
		html += '			<option value="' + i + '">' + i + '</option>';
							}
		html += '		</select>';
		html += '	</td>';
		html += '	<td><input type="text" name="moip_parcela[' + count_plot + '][juros]" value="" class="form-control" /></td>';
		html += '	<td class="text-right"><button type="button" onClick="$(\'#plot' + count_plot + '\').remove()" class="btn btn-danger"><i class="fa fa-remove"></i></button></td>';
		html += '</tr>';
		
		count_plot++;

		$('#table-plot tbody').append(html);
	});
</script>

<?php echo $footer ?>