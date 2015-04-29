<!-- Table Orders -->
<table class="table table-striped table-hover table-bordered">
	
	<!-- Table Header -->
	<thead>
		<tr>
			<th>Order ID</th>
			<th>Customer</th>
			<th>E-mail</th>
			<th>Status</th>
			<th>Total</th>
			<th>Store</th>
			<th>Date</th>
		</tr>
	</thead>
	
	<!-- Table Body -->
	<tbody>

		<!-- Order Details -->
		<?php foreach($orders as $order): ?>
		<tr class="success" id="order<?php echo $order['order_id'] ?>">
			<td>
				#<?php echo $order['order_id'] ?>
				<input type="hidden" value="<?php echo $order['order_update'] ?>" />
			</td>
			<td><?php echo $order['customer'] ?></td>
			<td><?php echo $order['email'] ?></td>
			<td><?php echo $order['status'] ?></td>
			<td><?php echo $order['total'] ?></td>
			<td><?php echo $order['store'] ?></td>
			<td><?php echo $order['date_added'] ?></td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>

<!-- Pagination -->
<div class="pagination">
	<?php echo $pagination ?>
</div>