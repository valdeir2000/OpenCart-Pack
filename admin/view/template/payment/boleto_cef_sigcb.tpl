<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="page-header">
		<div class="container-fluid">
			<div class="pull-right">
				<button type="submit" form="form-boleto" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
				<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
			</div>
			<h1><?php echo $heading_title; ?></h1>
			<ul class="breadcrumb">
				<?php foreach ($breadcrumbs as $breadcrumb) { ?>
				<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
	<div class="container-fluid">
		<?php if ($error_warning) { ?>
		<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
			<button type="button" class="close" data-dismiss="alert">&times;</button>
		</div>
		<?php } ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
			</div>
			<div class="panel-body">
				<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-boleto" class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-order-status"><?php echo $entry_order_status; ?></label>
						<div class="col-sm-10">
							<select name="boleto_cef_sigcb_order_status_id" class="form-control">
								<?php foreach ($order_statuses as $order_status) { ?>
								<?php if ($order_status['order_status_id'] == $boleto_cef_sigcb_order_status_id) { ?>
								<option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
								<?php } else { ?>
								<option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
								<?php } ?>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-logo"><?php echo $entry_logo; ?></label>
						<div class="col-sm-10">
							<input type="text" name="boleto_cef_sigcb_logo" value="<?php echo $boleto_cef_sigcb_logo; ?>" class="form-control"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-identificacao"><?php echo $entry_identificacao; ?></label>
						<div class="col-sm-10">
							<input type="text" name="boleto_cef_sigcb_identificacao" value="<?php echo $boleto_cef_sigcb_identificacao; ?>" class="form-control"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-cpf-cnpj"><?php echo $entry_cpf_cnpj; ?></label>
						<div class="col-sm-10">
							<input name="boleto_cef_sigcb_cpf_cnpj" type="text" id="boleto_cef_sigcb_cpf_cnpj" value="<?php echo $boleto_cef_sigcb_cpf_cnpj; ?>" class="form-control"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-endereco"><?php echo $entry_endereco; ?></label>
						<div class="col-sm-10">
							<input name="boleto_cef_sigcb_endereco" type="text" id="boleto_cef_sigcb_endereco" value="<?php echo $boleto_cef_sigcb_endereco; ?>" class="form-control"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-cidade-uf"><?php echo $entry_cidade_uf; ?></label>
						<div class="col-sm-10">
							<input name="boleto_cef_sigcb_cidade_uf" type="text" id="boleto_cef_sigcb_cidade_uf" value="<?php echo $boleto_cef_sigcb_cidade_uf; ?>" class="form-control"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-cedente"><?php echo $entry_cedente; ?></label>
						<div class="col-sm-10">
							<input name="boleto_cef_sigcb_cedente" type="text" id="boleto_cef_sigcb_cedente" value="<?php echo $boleto_cef_sigcb_cedente; ?>" class="form-control"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-agencia"><?php echo $entry_agencia; ?></label>
						<div class="col-sm-10">
							<input name="boleto_cef_sigcb_agencia" type="text" id="boleto_cef_sigcb_agencia" value="<?php echo $boleto_cef_sigcb_agencia; ?>" maxlength="4" class="form-control"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-conta"><?php echo $entry_conta; ?></label>
						<div class="col-sm-10">
							<input name="boleto_cef_sigcb_conta" type="text" id="boleto_cef_sigcb_conta" value="<?php echo $boleto_cef_sigcb_conta; ?>" maxlength="6" class="form-control"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-conta-cedente"><?php echo $entry_conta_cedente; ?></label>
						<div class="col-sm-10">
							<input name="boleto_cef_sigcb_conta_cedente" type="text" id="boleto_cef_sigcb_conta_cedente" value="<?php echo $boleto_cef_sigcb_conta_cedente; ?>" maxlength="6" class="form-control"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-carteira"><?php echo $entry_carteira; ?></label>
						<div class="col-sm-10">
							<input name="boleto_cef_sigcb_carteira" type="text" id="boleto_cef_sigcb_carteira" value="<?php echo $boleto_cef_sigcb_carteira; ?>" maxlength="3" class="form-control"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-dia-prazo"><?php echo $entry_dia_prazo_pg; ?></label>
						<div class="col-sm-10">
							<input name="boleto_cef_sigcb_dia_prazo_pg" type="text" id="boleto_cef_sigcb_dia_prazo_pg" value="<?php echo $boleto_cef_sigcb_dia_prazo_pg; ?>" maxlength="2" class="form-control"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-taxa-boleto"><?php echo $entry_taxa_boleto; ?></label>
						<div class="col-sm-10">
							<input name="boleto_cef_sigcb_taxa_boleto" type="text" id="boleto_cef_sigcb_taxa_boleto" value="<?php echo $boleto_cef_sigcb_taxa_boleto; ?>" maxlength="4" class="form-control"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-nosso-numero1"><?php echo $entry_nosso_numero1; ?></label>
						<div class="col-sm-10">
							<input name="boleto_cef_sigcb_nosso_numero1" type="text" id="boleto_cef_sigcb_nosso_numero1" value="<?php echo $boleto_cef_sigcb_nosso_numero1; ?>" maxlength="3" class="form-control"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-nosso-numero2"><?php echo $entry_nosso_numero2; ?></label>
						<div class="col-sm-10">
							<input name="boleto_cef_sigcb_nosso_numero2" type="text" id="boleto_cef_sigcb_nosso_numero2" value="<?php echo $boleto_cef_sigcb_nosso_numero2; ?>" maxlength="3" class="form-control"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-nosso-numero3"><?php echo $entry_nosso_numero3; ?></label>
						<div class="col-sm-10">
							<input name="boleto_cef_sigcb_nosso_numero3" type="text" id="boleto_cef_sigcb_nosso_numero3" value="<?php echo $boleto_cef_sigcb_nosso_numero3; ?>" maxlength="9" class="form-control"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-nosso-numero-const1"><?php echo $entry_nosso_numero_const1; ?></label>
						<div class="col-sm-10">
							<input name="boleto_cef_sigcb_nosso_numero_const1" type="text" id="boleto_cef_sigcb_nosso_numero_const1" value="<?php echo $boleto_cef_sigcb_nosso_numero_const1; ?>" maxlength="1" class="form-control"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-nosso-numero-const2"><?php echo $entry_nosso_numero_const2; ?></label>
						<div class="col-sm-10">
							<input name="boleto_cef_sigcb_nosso_numero_const2" type="text" id="boleto_cef_sigcb_nosso_numero_const2" value="<?php echo $boleto_cef_sigcb_nosso_numero_const2; ?>" maxlength="2" class="form-control"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-demonstrativo1"><?php echo $entry_demonstrativo1; ?></label>
						<div class="col-sm-10">
							<input name="boleto_cef_sigcb_demonstrativo1" type="text" id="boleto_cef_sigcb_demonstrativo1" value="<?php echo $boleto_cef_sigcb_demonstrativo1; ?>" class="form-control"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-demonstrativo2"><?php echo $entry_demonstrativo2; ?></label>
						<div class="col-sm-10">
							<input name="boleto_cef_sigcb_demonstrativo2" type="text" id="boleto_cef_sigcb_demonstrativo2" value="<?php echo $boleto_cef_sigcb_demonstrativo2; ?>" class="form-control"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-demonstrativo3"><?php echo $entry_demonstrativo3; ?></label>
						<div class="col-sm-10">
							<input name="boleto_cef_sigcb_demonstrativo3" type="text" id="boleto_cef_sigcb_demonstrativo3" value="<?php echo $boleto_cef_sigcb_demonstrativo3; ?>" class="form-control"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-instrucoes1"><?php echo $entry_instrucoes1; ?></label>
						<div class="col-sm-10">
							<input name="boleto_cef_sigcb_instrucoes1" type="text" id="boleto_cef_sigcb_instrucoes1" value="<?php echo $boleto_cef_sigcb_instrucoes1; ?>" class="form-control"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-instrucoes2"><?php echo $entry_instrucoes2; ?></label>
						<div class="col-sm-10">
							<input name="boleto_cef_sigcb_instrucoes2" type="text" id="boleto_cef_sigcb_instrucoes2" value="<?php echo $boleto_cef_sigcb_instrucoes2; ?>" class="form-control"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-instrucoes3"><?php echo $entry_instrucoes3; ?></label>
						<div class="col-sm-10">
							<input name="boleto_cef_sigcb_instrucoes3" type="text" id="boleto_cef_sigcb_instrucoes3" value="<?php echo $boleto_cef_sigcb_instrucoes3; ?>" class="form-control"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-instrucoes4"><?php echo $entry_instrucoes4; ?></label>
						<div class="col-sm-10">
							<input name="boleto_cef_sigcb_instrucoes4" type="text" id="boleto_cef_sigcb_instrucoes4" value="<?php echo $boleto_cef_sigcb_instrucoes4; ?>" class="form-control"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-geo-zone"><?php echo $entry_geo_zone; ?></label>
						<div class="col-sm-10">
							<select name="boleto_cef_sigcb_geo_zone_id" class="form-control">
								<option value="0"><?php echo $text_all_zones; ?></option>
								<?php foreach ($geo_zones as $geo_zone) { ?>
								<?php if ($geo_zone['geo_zone_id'] == $boleto_cef_sigcb_geo_zone_id) { ?>
								<option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
								<?php } else { ?>
								<option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
								<?php } ?>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
						<div class="col-sm-10">
							<select name="boleto_cef_sigcb_status" class="form-control">
								<?php if ($boleto_cef_sigcb_status) { ?>
								<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
								<option value="0"><?php echo $text_disabled; ?></option>
								<?php } else { ?>
								<option value="1"><?php echo $text_enabled; ?></option>
								<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
						<div class="col-sm-10">
							<input type="text" name="boleto_cef_sigcb_sort_order" value="<?php echo $boleto_cef_sigcb_sort_order; ?>" size="1" class="form-control"/>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php echo $footer; ?>