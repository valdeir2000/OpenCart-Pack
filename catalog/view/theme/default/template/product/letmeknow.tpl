<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <h1><?php echo $heading_title_letmeknow; ?></h1>
  <div>
  <!-- Let Me Know - VALDEIR -->
  <div id="formLetMeKnow">
	<form name="LetMeKnow" method="post" action="<?php echo $action; ?>">
		<table>
			<!-- NAME -->
			<tr>
				<td><label>Nome:</label></td>
				<td><input type="text" name="name" placeholder="<?php echo $entry_nome ?>" size="27" /></td>
				<td>
					<?php if ($error_name) { ?>
					<span class="error"><?php echo $error_name; ?></span>
					<?php } ?>
				</td>
			</tr>
			
			<!-- EMAIL -->
			<tr>
				<td><label>Email:</label></td>
				<td><input type="text" name="email" placeholder="<?php echo $entry_email ?>" size="27" /></td>
				<td>
					<?php if ($error_email) { ?>
					<span class="error"><?php echo $error_email; ?></span>
					<?php } ?>
				</td>
			</tr>
			
			<!-- CAPTCHA -->
			<tr>
				<td valign="top"><label>Captcha:</label></td>
				<td><input type="text" name="captcha" value="" placeholder="<?php echo $entry_captcha; ?>" size="27" /><br /><img src="index.php?route=information/contact/captcha" alt="" /></td>
				<td valign="top">
					<?php if ($error_captcha) { ?>
					<span class="error"><?php echo $error_captcha; ?></span>
					<?php } ?>
				</td>
			</tr>
			
			<!-- HIDDEN | BUTTON -->
			<tr>
				<td>
					<input type="hidden" name="body_message" value="<?php echo $body_message; ?>" />
					<input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
				</td>
				<td><div class="right"><input type="submit" value="<?php echo $text_continue ?>" class="button" /></div></td>
			</tr>
		</table>
	</form>
  </div>
  
  
<script type="text/javascript"><!--
$('.colorbox').colorbox({
	overlayClose: true,
	opacity: 0.5
});
//--></script> 
<script type="text/javascript"><!--

var quantityStock = <?php echo $product_info['quantity']; ?>;

if (quantityStock <= 0) {
	$("#letmeknow").html("<?php echo sprintf($btnStock,$heading_title_letmeknow); ?>");
	$(".cart").remove();
}

$("#btnStock").click (function (){
	$("#formLetMeKnow").dialog({
		title: '<?php echo $heading_title_letmeknow; ?>'
	});
});
//--></script>
<?php echo $footer; ?>