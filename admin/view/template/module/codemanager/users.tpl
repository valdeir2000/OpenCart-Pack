<table class="table table-hover">
  <thead>
    <tr>
      <th width="5%">#</th>
      <th width="20%">Name</th>
      <th width="25%">Email</th>
      <th width="25%">Date Added</th>
      <th width="25%">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php if (sizeof($results)>0) { ?>
   <?php foreach ($results as $result) { ?>
	<tr>
    	<td><?php echo $result['user_id'] ?></td> 
        <td><?php echo $result['username'] ?></td>
        <td><?php echo $result['email'] ?></td>
        <td><?php echo $result['date_added'] ?></td>
        <td>
        	<a target="_blank" href="index.php?route=user/user/edit&token=<?php echo $token; ?>&user_id=<?php echo $result['user_id'] ?>" class="btn btn-default btn-sm">Edit</a>
        	<button type="button" class="btn btn-primary btn-sm" onClick="removeUser(<?php echo $result['user_id'] ?>);">Delete</button>
  		</td>       
	</tr>
   <?php } ?>
  <?php } else { ?>
  	<tr>
    	<td colspan="5"><center>There are no users with access yet.</center></td>
    </tr>
  <?php } ?>
  </tbody>
</table>
<script>
function removeUser(user_id) {      
			var r=confirm("Are you sure you want to remove this user?");
			if (r==true) {
				$.ajax({
					url: 'index.php?route=module/<?php echo $moduleNameSmall; ?>/removeuser&token=<?php echo $token; ?>',
					type: 'post',
					data: {'user_id': user_id},
					success: function(response) {
						$("#data").load('index.php?route=module/<?php echo $moduleNameSmall; ?>/showusers&token=<?php echo $token; ?>');
					}
			});
		 }
		}	
</script>