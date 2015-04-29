<table class="table table-hover table-bordered">
	<thead>
		<tr>
			<th>Date Added</th>
			<th>Comment</th>
			<th>Status</th>
			<th>Notified&nbsp;&nbsp;&nbsp;</th>
		</tr>
	</thead>
	
	<tbody>
		<?php foreach($histories as $history): ?>
		<tr>
			<td><?php echo $history['date_added'] ?></td>
			<td>
				<div class="limit-text" rel="tooltip" data-placement="bottom" title="<?php echo $history['comment'] ?>"><?php echo $history['comment'] ?></div>
			</td>
			<td><?php echo $history['status'] ?></td>
			<td><?php echo $history['notify'] ?></td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>

<div id="pagination-history" class="pagination">
	<?php echo $pagination ?>
</div>