<!------------>
<!-- Header -->
<!------------>
<?php echo $header; ?><?php echo $column_left; ?>

<!-------------->
<!-- #Content -->
<!-------------->
<div id="content">
	
	<!------------------>
	<!-- .Page-Header -->
	<!------------------>
	<div class="page-header">
		<div class="container-fluid">
			
			<!------------>
			<!-- Title  -->
			<!------------>
			<h1 class="pull-left"><i class="fa fa-puzzle-piece"></i> <?php echo $heading_title ?></h1>
			
			<!-------------->
			<!-- Buttons -->
			<!-------------->
			<div class="pull-right">
				<button type="submit" form="form-chrome-extension" data-toggle="tooltip" title="<?php echo $button_save ?>" class="btn btn-primary"><i class="fa fa-check-circle"></i></button>
				<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
			</div>
		</div>
	</div>
	<!-- /.Page-Header -->
	
	<!---------------------->
	<!-- .Container-Fluid -->
	<!---------------------->
	<div class="container-fluid">
		
		<!------------>
		<!-- Error -->
		<!------------>
		<?php if (isset($warning)): ?>
		<div class="alert alert-danger">
			<i class="fa fa-exclamation-circle"></i> <?php echo $warning ?>
			<button type="button" class="close" data-dimiss="alert">&times;</button>
		</div>
		<?php endif; ?>
		
		<!---------->
		<!-- Form -->
		<!---------->
		<form action="<?php echo $action ?>" method="post" id="form-chrome-extension" enctype="multipart/form-data" class="form-horizontal" role="form">
			
			<!------------>
			<!-- Status -->
			<!------------>
			<div class="form-group required">
				<label for="status" class="control-label col-sm-2"><?php echo $entry_status ?></label>
				<div class="col-sm-10">
					<select name="chrome_extension_status" id="status" class="form-control">
						<?php if ($status): ?>
						<option value="1" selected><?php echo $text_enabled ?></option>
						<option value="0"><?php echo $text_disabled ?></option>
						<?php else: ?>
						<option value="1"><?php echo $text_enabled ?></option>
						<option value="0" selected><?php echo $text_disabled ?></option>
						<?php endif ?>
					</select>
				</div>
			</div>
			
			<!------------>
			<!-- Token -->
			<!------------>
			<div class="form-group required">
				<label for="token" class="control-label col-sm-2"><?php echo $entry_token ?></label>
				<div class="col-sm-10">
					<textarea class="form-control" name="chrome_extension_token" id="token" rows="3"><?php echo $token ?></textarea>
					<?php if (isset($error_token)): ?>
					<div class="text-danger"><?php echo $error_token ?></div>
					<?php endif ?>
					<button type="button" onClick="generateCode('token')" class="btn btn-primary"><i class="fa fa-refresh"></i> <?php echo $button_generate ?></button>
				</div>
			</div>
			
			<!---------->
			<!-- Key -->
			<!---------->
			<div class="form-group required">
				<label for="key" class="control-label col-sm-2"><?php echo $entry_key ?></label>
				<div class="col-sm-10">
					<textarea class="form-control" name="chrome_extension_key" id="key" rows="3"><?php echo $key ?></textarea>
					<?php if (isset($error_key)): ?>
					<div class="text-danger"><?php echo $error_key ?></div>
					<?php endif ?>
					<button type="button" onClick="generateCode('key')" class="btn btn-primary"><i class="fa fa-refresh"></i> <?php echo $button_generate ?></button>
				</div>
			</div>
			
			<!-------------->
			<!-- Language -->
			<!-------------->
			<div class="form-group required">
				<label for="language" class="control-label col-sm-2">Language:</label>
				<div class="col-sm-10">
					<select name="chrome_extension_language_id" id="language" class="form-control">
						<?php foreach($languages as $language): ?>
							<?php if ($language['language_id'] == $language_id): ?>
							<option value="<?php echo $language['language_id'] ?>" selected><?php echo $language['name'] ?></option>
							<?php else: ?>
							<option value="<?php echo $language['language_id'] ?>"><?php echo $language['name'] ?></option>
							<?php endif ?>
						<?php endforeach ?>
					</select>
				</div>
			</div>
			
			<!-------------------->
			<!-- Range Checking -->
			<!-------------------->
			<div class="form-group required">
				<label for="range_checking" class="control-label col-sm-2">Range Checking:</label>
				<div class="col-sm-10">
					<input name="chrome_extension_range_checking" value="<?php echo $range_checking ?>" id="range_checking" class="form-control" />
				</div>
			</div>
			
			<!-------------------->
			<!--  -->
			<!-------------------->
			<div class="form-group required">
				<label for="QuantityPerPage" class="control-label col-sm-2">Quantity Per Page:</label>
				<div class="col-sm-10">
					<input name="chrome_extension_quantity_per_page" value="<?php echo $quantity_per_page ?>" id="QuantityPerPage" class="form-control" />
				</div>
			</div>
			
			<!------------------>
			<!-- Alert Sound -->
			<!------------------>
			<div class="form-group required">
				<label for="AlertSound" class="control-label col-sm-2">Alert Sound:</label>
				<div class="col-sm-10">
					<div class="input-append">
						<select name="chrome_extension_alert_sound" id="AlertSound" class="form-control">
							<option value="../sounds/alert1.ogg">Alert 1</option>
							<option value="../sounds/alien.mp3">Alien</option>
							<option value="../sounds/car.mp3">Car</option>
						</select>
					</div>
				</div>
			</div>
			
			<!---------->
			<!-- URL -->
			<!---------->
			<div class="form-group required">
				<label for="url" class="control-label col-sm-2">URL:</label>
				<div class="col-sm-10">
					<input name="chrome_extension_url" id="url" value="<?php echo HTTP_CATALOG ?>" class="form-control" />
				</div>
			</div>
			
			<!------------>
			<!-- Admin -->
			<!------------>
			<div class="form-group required">
				<label for="admin" class="control-label col-sm-2">Admin:</label>
				<div class="col-sm-10">
					<input name="chrome_extension_admin" value="<?php echo $admin ?>" id="admin" class="form-control" />
				</div>
			</div>
			
			<!-------------->
			<!-- Password -->
			<!-------------->
			<div class="form-group required">
				<label for="password" class="control-label col-sm-2">Password:</label>
				<div class="col-sm-10">
					<input name="chrome_extension_password" value="<?php echo $password ?>" id="password" class="form-control" />
				</div>
			</div>
			
			<!---------------------->
			<!-- URL Order Update -->
			<!---------------------->
			<div class="form-group required">
				<label for="url_order_update" class="control-label col-sm-2">URL Order Update:</label>
				<div class="col-sm-10">
					<input type="text" name="chrome_extension_url_order_update" value="<?php echo $url_order_update ?>" class="form-control" />
				</div>
			</div>
			
			<!---------------------->
			<!-- URL Extension -->
			<!---------------------->
			<div class="form-group">
				<label for="url_order_update" class="control-label col-sm-2"></label>
				<div class="col-sm-10">
					<a href="https://chrome.google.com/webstore/detail/opencart-chrome-extension/ebcdghpcgkemkmfchffgekiaijcpminl" target="_blank">Baixe a Extensão para o Google Chrome</a>
				</div>
			</div>
			
		</form> <!-- /Form -->
	</div> <!-- /.Container-Fluid -->
</div> <!-- #Content -->

<script type="text/javascript"><!--
	$(function(){
		$('.nav-tabs').tab('show');
	});
//--></script>

<script type="text/javascript">
function generateCode(input) {
	rand = '';
	
	string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

	for (i = 0; i < 256; i++) {
		rand += string[Math.floor(Math.random() * (string.length - 1))];
	}
	
	$('#' + input).val(rand);
};
</script>
<?php echo $footer ?>