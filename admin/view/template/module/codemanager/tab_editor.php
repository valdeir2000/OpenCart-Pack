<?php
$path = (dirname(DIR_APPLICATION)).'/vendors/'.$moduleNameSmall;
$workspace = is_writable( $path . "/workspace");
$data = is_writable($path . "/data");
$plugins = is_writable($path . "/plugins");
$themes = is_writable($path . "/themes");
$workspace = is_writable( $path . "/workspace");
$project_path = is_writable(dirname(DIR_APPLICATION));
$path_writable = is_writable((dirname(DIR_APPLICATION)).'/vendors/'.$moduleNameSmall);

$conf = $path . '/config.php';

$config = is_writable(file_exists($conf) ? $conf : $path);

// Check if the module is installed
$users = file_exists($path . "/data/users.php");
$projects = file_exists($path . "/data/projects.php");
$active = file_exists($path . "/data/active.php");	
// Check end
?>

<?php if(!$users && !$projects && !$active) {
	
?>
<div style="padding:10px;">
    <div class="row">
        <div class="col-xs-12">    
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Requirements check</strong></h3>
                </div>
                <div class="panel-body">
                    <p>Please make sure the following exist and are writeable:</p>
                    <ul>
						<li><?php echo dirname(DIR_APPLICATION); ?> - <?php if($project_path) { echo '<font style="color:green">PASSED</font>'; } else { echo '<font style="color:red">ERROR</font>'; } ?></li>
                        <li><?php echo $path; ?> - <?php if($path_writable) { echo '<font style="color:green">PASSED</font>'; } else { echo '<font style="color:red">ERROR</font>'; } ?></li>
                        <li><?php echo $path; ?>/config.php - <?php if($config) { echo '<font style="color:green">PASSED</font>'; } else { echo '<font style="color:red">ERROR</font>'; } ?></li>
                        <li><?php echo $path; ?>/workspace - <?php if($workspace) { echo '<font style="color:green">PASSED</font>'; } else { echo '<font style="color:red">ERROR</font>'; } ?></li>
                        <li><?php echo $path; ?>/plugins - <?php if($plugins) { echo '<font style="color:green">PASSED</font>'; } else { echo '<font style="color:red">ERROR</font>'; } ?></li>
                        <li><?php echo $path; ?>/themes - <?php if($themes) { echo '<font style="color:green">PASSED</font>'; } else { echo '<font style="color:red">ERROR</font>'; } ?></li>
                        <li><?php echo $path; ?>/data - <?php if($data) { echo '<font style="color:green">PASSED</font>'; } else { echo '<font style="color:red">ERROR</font>'; } ?></li>						

                    </ul>
                    <br />
                    <?php if(!$workspace || !$data || !$config || !$project_path || !$path_writable){ ?>
                        <p><a class="btn btn-warning btn-lg" onclick="window.location.reload();" role="button">Check again</a></p>
                    <?php } else { ?>
                        <p><a class="btn btn-primary btn-lg" id="install" role="button">Finish installing</a></p>	
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$('#install').on('click', function(e){
	 var array = {
		 project_name : '<?php echo $store['name']; ?>',
		 project_path : '<?php echo (dirname(DIR_APPLICATION)); ?>',
		 path : '<?php echo $path; ?>',
		 username : 'admin',
		 password : 'p@$$w04dp@$$w04d',
		 timezone : '<?php echo date_default_timezone_get(); ?>'
	   };
	$.ajax({
			url: '../vendors/<?php echo $moduleNameSmall; ?>/components/install/process.php',
			type: 'post',
			data: array,
			dataType: 'html',
			success: function(data) {
				if(data=='success'){
					window.location.reload();
				} else {
					alert("An Error Occoured<br><br>"+data);
				}
			}
	});
});
</script>
<?php } else { ?>
	<a class="fullscrbtn" onClick="fullscreen()"><span class="glyphicon glyphicon-fullscreen"></span></a>
    <a class="bigscrbtn" onClick="bigscreen();"><span class="glyphicon glyphicon-sound-stereo"></span></a>

	<iframe id="iFrame" style="width: 100%;height:750px" frameborder="0" hspace="0" vspace="0" marginheight="0" marginwidth="0" align="top" src="../vendors/<?php echo $moduleNameSmall; ?>/index.php"></iframe>
    
    <!-- Modal -->
<div class="modal fade" id="modalUsers" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="myModalLabel">Show all users with access to the module</h3>
      </div>
      <div class="modal-body">
            <div id="data"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="newUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="myModalLabel">Grant temporary access details</h3>
      </div>
      <div class="modal-body">
			<div id="CustomerData"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
$('#showModal').on('click', function(e){
	$('#newUserModal').modal('show');
	$("#CustomerData").load('index.php?route=module/<?php echo $moduleNameSmall; ?>/givecredentials&token=<?php echo $token; ?>');
});
$('#showUsers').on('click', function(e){
	$('#modalUsers').modal('show');
	$("#data").load('index.php?route=module/<?php echo $moduleNameSmall; ?>/showusers&token=<?php echo $token; ?>');
});

function send(url) { 
 	var UserData= {
		name : $('input[id="name"]').val(),
		password : $('input[id="password"]').val(),
		password2 : $('input[id="password2"]').val(),
		email: $('input[id="email"]').val()
	};
	$('.success, .warning, .error').remove();
	$('div#success').html('');
	$.ajax({
		url: url,
		type: 'post',
		data: UserData,		
		dataType: 'json',
		beforeSend: function() {
			$('#button-send').attr('disabled', true);
		},
		complete: function() {
			$('#button-send').attr('disabled', false);
		},
		success: function(json) {
			$('.success, .warning, .error').remove();
			
			if (json['error']) {
				if (json['error']['name']) {
					$('input[id=\'name\']').parent().append('<span class="error">' + json['error']['name'] + '</span>');
				}
				if (json['error']['password']) {
					$('input[id=\'password\']').parent().append('<span class="error">' + json['error']['password'] + '</span>');
				}
				if (json['error']['password2']) {
					$('input[id=\'password2\']').parent().append('<span class="error">' + json['error']['password2'] + '</span>');
				}
				if (json['error']['email']) {
					$('input[id=\'email\']').parent().append('<span class="error">' + json['error']['email'] + '</span>');
				}
				if (json['error']['mismatch']) {
					$('input[id=\'password2\']').parent().append('<span class="error">' + json['error']['mismatch'] + '</span>');
				}
				if (json['error']['exists']) {
					$('input[id=\'name\']').parent().append('<span class="error">' + json['error']['exists'] + '</span>');
				}									
			}

			if (json['success']) {
				$('div#success').html('<br /><div class="well"><strong>' + json['success'] + '</strong><br /><br />You copy & paste this to your developer:<br/>Username: '+ json['username'] +'<br />Password: '+ json['password'] +'</div>');
			}
		}
	});
}
</script>
<?php } ?>