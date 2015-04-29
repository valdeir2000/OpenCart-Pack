<ul class="nav nav-tabs tabs-left span3">
	<li class="active"><a href="#tabOrderDetails" data-toggle="tab">Order Details</a></li>
	<li><a href="#tabPaymentDetails" data-toggle="tab">Payment Details</a></li>
	<?php if (!empty($shipping_method)) { ?>
	<li><a href="#tabShippingDetails" data-toggle="tab">Shipping Details</a></li>
	<?php } ?>
	<li><a href="#tabProducts" data-toggle="tab">Products</a></li>
	<li><a href="#tabHistory" data-toggle="tab">History</a></li>
</ul>

<div class="tab-content span9">
	<div class="tab-pane active" id="tabOrderDetails">
		<table class="table table-hover">
			<tr>
				<td>Order ID:</td>
				<td>#<?php echo $order_id ?></td>
			</tr>
			
			<tr>
				<td>Invoice:</td>
				<td><?php echo $invoice_prefix ?> [<a id="downloadInvoice">Download</a>]</td>
			</tr>
			
			<tr>
				<td>Store Name:</td>
				<td><?php echo $store_name ?></td>
			</tr>
			
			<tr>
				<td>Store URL:</td>
				<td><a href="<?php echo $store_url ?>" target="_blank"><?php echo $store_url ?></a></td>
			</tr>
			
			<tr>
				<td>Customer:</td>
				<td><a href="<?php echo $customer_link ?>" target="_blank"><?php echo $customer_name ?></a></td>
			</tr>
			
			<tr>
				<td>Customer Group:</td>
				<td><?php //echo $order_info[''] ?></td>
			</tr>
			
			<tr>
				<td>E-mail:</td>
				<td><a href="mailto:<?php echo $email ?>"><?php echo $email ?></a></td>
			</tr>
			
			<tr>
				<td>Telephone:</td>
				<td><?php echo $telephone ?></td>
			</tr>
			
			<tr>
				<td>Total:</td>
				<td><?php echo $total ?></td>
			</tr>
			
			<tr>
				<td>Order Status:</td>
				<td><?php echo $order_status ?></td>
			</tr>
			
			<tr>
				<td>Date Added:</td>
				<td><?php echo $date_added ?></td>
			</tr>
			
			<tr>
				<td>Date Modified:</td>
				<td><?php echo $date_modified ?></td>
			</tr>
		</table>
	</div>
	
	<div class="tab-pane" id="tabPaymentDetails">
		<table class="table table-hover">
			<tr>
				<td>First Name:</td>
				<td><?php echo $payment_firstname ?></td>
			</tr>
			
			<tr>
				<td>Last Name:</td>
				<td><?php echo $payment_lastname ?></td>
			</tr>
			
			<tr>
				<td>Address 1:</td>
				<td><?php echo $payment_address_1 ?></td>
			</tr>
			
			<tr>
				<td>Address 2:</td>
				<td><?php echo $payment_address_2 ?></td>
			</tr>
			
			<tr>
				<td>City:</td>
				<td><?php echo $payment_city ?></td>
			</tr>
			
			<tr>
				<td>Postcode:</td>
				<td><?php echo $payment_postcode ?></td>
			</tr>
			
			<tr>
				<td>Region/State:</td>
				<td><?php echo $payment_zone ?></td>
			</tr>
			
			<tr>
				<td>Country:</td>
				<td><?php echo $payment_country ?></td>
			</tr>
			
			<tr>
				<td>Payment Method:</td>
				<td><?php echo $payment_method ?></td>
			</tr>
			
			<?php foreach($payment_custom_field as $custom_field) { ?>
			<tr data-sort="<?php echo $custom_field['sort_order'] ?>">
				<td><?php echo $custom_field['name'] ?></td>
				<td><?php echo $custom_field['value'] ?></td>
			</tr>
			<?php } ?>
		</table>
	</div>
	
	<?php if (!empty($shipping_method)) { ?>
	<div class="tab-pane" id="tabShippingDetails">
		<table class="table table-hover">
			<tr>
				<td>First Name:</td>
				<td><?php echo $shipping_firstname ?></td>
			</tr>
			
			<tr>
				<td>Last Name:</td>
				<td><?php echo $shipping_lastname ?></td>
			</tr>
			
			<tr>
				<td>Address 1:</td>
				<td><?php echo $shipping_address_1 ?></td>
			</tr>
			
			<tr>
				<td>Address 2:</td>
				<td><?php echo $shipping_address_2 ?></td>
			</tr>
			
			<tr>
				<td>City:</td>
				<td><?php echo $shipping_city ?></td>
			</tr>
			
			<tr>
				<td>Postcode:</td>
				<td><?php echo $shipping_postcode ?></td>
			</tr>
			
			<tr>
				<td>Region/State:</td>
				<td><?php echo $shipping_zone ?></td>
			</tr>
			
			<tr>
				<td>Country:</td>
				<td><?php echo $shipping_country ?></td>
			</tr>
			
			<tr>
				<td>Shipping Method:</td>
				<td><?php echo $shipping_method ?></td>
			</tr>
			
			<?php foreach($shipping_custom_field as $custom_field) { ?>
			<tr data-sort="<?php echo $custom_field['sort_order'] ?>">
				<td><?php echo $custom_field['name'] ?></td>
				<td><?php echo $custom_field['value'] ?></td>
			</tr>
			<?php } ?>
		</table>
	</div>
	<?php } ?>
	
	<div class="tab-pane" id="tabProducts">
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>Product</th>
					<th>Model</th>
					<th>Quantity</th>
					<th>Unit Price</th>
					<th>Total</th>
				</tr>
			</thead>
			
			<tbody>
				<?php foreach($products as $product): ?>
				<tr>
					<td>
						<a href="#"><?php echo $product['name'] ?></a>
						<?php foreach($product['options'] as $option): ?>
							<?php if ($option['type'] != 'file'): ?>
							<br>&nbsp;<small> - <?php echo $option['name'] ?>: <?php echo $option['value'] ?></small>
							<?php else: ?>
							<br>&nbsp;<small> - <?php echo $option['name'] ?>: <a href="<?php echo $this->url->link('chrome_extension/download', 'file=' . $option['value']) ?>"><?php echo $option['value'] ?></a></small>
							<?php endif ?>
						<?php endforeach ?>
					</td>
					<td><?php echo $product['model'] ?></td>
					<td><?php echo $product['quantity'] ?></td>
					<td><?php echo $product['price'] ?></td>
					<td><?php echo $product['total'] ?></td>
				</tr>
				<?php endforeach ?>
			</tbody>
			
			<tfoot>
				<?php foreach($totals as $total): ?>
				<tr>
					<td colspan="4" class="text-right"><?php echo $total['title'] ?>:</td>
					<td><?php echo $total['value'] ?></td>
				</tr>
				<?php endforeach ?>
			</tfoot>
		</table>
	</div>
	
	<div class="tab-pane" id="tabHistory">
		<div class="load">
			<?php echo $history ?>
		</div>
		
		<fieldset id="form-add-history">
			<legend>History</legend>
			
			<form class="form-horizontal">
				<div class="control-group">
					<label for="" class="control-label">Order Status:</label>
					<div class="controls">
						<input type="hidden" name="order_id" value="<?php echo $order_id ?>" />
						<select name="order_status_id">
							<?php foreach($statuses as $status): ?>
							<option value="<?php echo $status['status_id'] ?>"><?php echo $status['name'] ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>
				
				<div class="control-group">
					<label for="" class="control-label">Notify Customer:</label>
					<div class="controls">
						<input type="checkbox" name="notify" />
					</div>
				</div>
				
				<div class="control-group">
					<label for="" class="control-label">Comment:</label>
					<div class="controls">
						<textarea name="comment"></textarea>
					</div>
				</div>
				
				<div class="control-group">
					<div class="controls">
						<button type="button" class="btn btn-primary" id="btnAddHistory">Send</button>
					</div>
				</div>
			</form>
		</fieldset>
	</div>
</div>