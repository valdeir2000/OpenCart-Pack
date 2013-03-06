<?php echo $header ?>

<div id="content">

	<div class="breadcrumb">
		<?php foreach($breamcrumbs as $breamcrumb): ?>
		<?php echo $breamcrumb['separator'] ?><a href="<?php echo $breamcrumb['href'] ?>"><?php echo $breamcrumb['name'] ?></a>
		<?php endforeach; ?>
	</div>

	<?php if ($error_warning): ?>
	<div class="warning"><?php echo $error_warning ?></div>
	<?php endif; ?>

	<div class="box">
		<div class="heading">
			<h1><?php echo $heading_title ?></h1>
			<div class="buttons">
				<a onClick="$('form').submit()" class="button"><?php echo $btn_save ?></a>
				<a href="<?php echo $cancel ?>" class="button"><?php echo $btn_cancel ?></a>
			</div>
		</div>

		<div class="content">
			<form action="<?php echo $action ?>" method="post">
				<table class="form">
					<tr>
						<td><?php echo $entry_status ?></td>
						<td>
							<select name="gift_status">
								<?php if ($gift_status == 1): ?>
								<option value="1" selected="selected"><?php echo $entry_enabled ?></option>
								<option value="0"><?php echo $entry_disabled ?></option>
								<?php else: ?>
								<option value="1"><?php echo $entry_enabled ?></option>
								<option value="0" selected="selected"><?php echo $entry_disabled ?></option>
								<?php endif; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo $entry_price ?></td>
						<td><input type="text" name="gift_price" value="<?php echo $gift_price ?>" /></td>
					</tr>
					<tr>
						<td><?php echo $entry_maxProduct ?></td>
						<td><input type="text" name="gift_maxProduct" value="<?php echo $gift_maxProduct ?>" /></td>
					</tr>
					<tr>
						<td><?php echo $entry_sort_order ?></td>
						<td><input type="text" name="gift_sort_order" value="<?php echo $gift_sort_order ?>" /></td>
					</tr>
				</table>
			</form>
		</div>

	</div>
</div>

<?php echo $footer ?>