<?php echo $header ?>

<div id="content">
	
	<div class="breadcrumbs">
		<?php foreach($breadcrumbs as $breadcrumb){ ?>
			<?php echo $breadcrumb['separator'] ?>
			<a href="<?php echo $breadcrumb['href'] ?>"><?php echo $breadcrumb['name'] ?></a>
		<?php } ?>
	</div>

	<?php if ($error_warning){ ?>
	<span class="warning"><?php echo $error_warning ?></span>
	<?php } ?>

	<div class="box">
		<div class="heading">
			<div class="buttons">
				<a onClick="$('form').submit()" class="button"><?php echo $btn_save; ?></a>
				<a href="<?php echo $action_cancel ?>" class="button"><?php echo $btn_cancel; ?></a>
			</div>
		</div>

		<div class="content">
			<form action="<?php echo $action_form ?>" method="post">
				<table class="form">
					<tr>
						<td><?php echo $text_status; ?></td>
						<td>
							<select name="letmeknow_status">
								<?php if ($letmeknow_status == 1){ ?>
								<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
								<option value="0"><?php echo $text_disabled; ?></option>
								<?php }else{ ?>
								<option value="1"><?php echo $text_enabled; ?></option>
								<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
								<?php } ?>
							</select>
						</td>
					</tr>

					<tr>
						<td>
							<?php echo $text_title; ?>
							<span class="help"><?php echo $help_greeting; ?></span>
						</td>
						<td><input type="text" name="letmeknow_title" value="<?php echo $letmeknow_title ?>"></td>
					</tr>

					<tr>
						<td><?php echo $text_subject; ?></td>
						<td><input type="text" name="letmeknow_subject" value="<?php echo $letmeknow_subject ?>" /></td>
					</tr>

					<tr>
						<td>
							<?php echo $text_message; ?>
							<span class="help">
								<strong>%customerName%</strong><?php echo $entry_customerName; ?><br/>
								<strong>%productName%</strong><?php echo $entry_productName; ?><br/>
								<strong>%productModel%</strong><?php echo $entry_productModel; ?><br/>
								<strong>%productSKU%</strong><?php echo $entry_productSKU; ?><br/>
								<strong>%productQuantity%</strong><?php echo $entry_productQuantity; ?><br/>
								<strong>%productLink%</strong><?php echo $entry_productLink; ?>
							</span>
						</td>
						<td>
							<textarea name="letmeknow_message" id="message" cols="70" rows="10"><?php echo $letmeknow_message ?></textarea>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>

</div>
<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script> 
<script type="text/javascript"><!--
	CKEDITOR.replace('message', {
		filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
	});
//--></script>


<script type="text/javascript"><!--
	$('.vtabs a').tabs();
//--></script>
<?php echo $footer ?>