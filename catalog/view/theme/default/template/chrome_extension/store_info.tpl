<div id="store<?php echo $store['store_id'] ?>" class="content pull-left" data-toggle="store-info">
	<table class="table table-hover">
		<caption>
			<a href="<?php echo $store['link'] ?>" target="_blank"><h3><?php echo $store['name'] ?> - Overview</h3></a>
		</caption>
		
		<tbody>
			<tr>
				<td>Total Sales:</td>
				<td><?php echo $store['total_sales'] ?></td>
			</tr>

			<tr>
				<td>Total Sales This Year:</td>
				<td><?php echo $store['total_sales_year'] ?></td>
			</tr>

			<tr>
				<td>Total Orders:</td>
				<td><?php echo $store['total_orders'] ?></td>
			</tr>

			<tr>
				<td>No. of Customers:</td>
				<td><?php echo $store['total_customers'] ?></td>
			</tr>

			<tr>
				<td>Customers Awaiting Approval:</td>
				<td><?php echo $store['customers_awaiting_approval'] ?></td>
			</tr>

			<tr>
				<td>Reviews Awaiting Approval:</td>
				<td><?php echo $store['reviews_awaiting_approval'] ?></td>
			</tr>

			<tr>
				<td>No. of Affiliates:</td>
				<td><?php echo $store['total_affiliates'] ?></td>
			</tr>

			<tr>
				<td>Affiliates Awaiting Approval:</td>
				<td><?php echo $store['affiliates_awaiting_approval'] ?></td>
			</tr>
		</tbody>
	</table>
</div>