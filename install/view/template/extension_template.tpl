<?php echo $header ?>
<div class="container">
  <header class="div row">
    <div class="col-sm-6">
      <h1 class="pull-left">4<small>/finish</small></h1>
    </div>
    <div class="col-sm-6">
      <div id="logo" class="pull-right hidden-xs">
        <img src="view/image/logo.png" alt="OpenCart" title="OpenCart" />
      </div>
    </div>
  </header>

  <div class="row">
    <div class="col-sm-9">
      <div id="content">
		  <div class="container-fluid">
		    <div class="panel panel-default">
		      <div class="panel-heading">
		        <h3 class="panel-title"><i class="fa fa-pencil"></i> Editar</h3>
		      </div>
		      <div class="panel-body">
		        <?php echo $code ?>
		      </div>
		    </div>
		    <div class="buttons">
	          <div class="pull-left"><a href="<?php echo $back ?>" class="btn btn-default"><?php echo $button_back ?></a></div>
	          <div class="pull-right">
	            <input type="submit" value="<?php echo $button_continue ?>" id="submit" class="btn btn-primary" />
	          </div>
	        </div>
		  </div>
		</div>
    </div>

    <div class="col-sm-3">
      <ul class="list-group">
        <li class="list-group-item">Passo 1</li>
        <li class="list-group-item">Passo 2</li>
        <li class="list-group-item">Passo 3</li>
        <li class="list-group-item"><b>Passo 4</b></li>
        <li class="list-group-item">Passo 5</li>
      </ul>
    </div>
  </div>

  <script type="text/javascript">
  	$(function(){

  		var html = '';

  		<?php foreach($modules as $key => $module) { ?>
  		html += '<input type="hidden" name="modules[]" value="<?php echo $modules[$key] ?>" />';
  		<?php } ?>

  		$('form').append(html);
  		
  		$('form').append('<input type="hidden" name="module_name" value="<?php echo $module_name ?>" />');

  		$('form').attr('action', '<?php echo $action ?>');

  		$('form input, form textarea, form select').map(function(i, e){
  			if ($(e).attr('name') != 'module_name' && $(e).attr('name') != 'modules[]') {
  				$(e).attr('name', 'config[' + $(e).attr('name') + ']');
  			}
  		})
  		
  		$('#submit').attr('form', $('form').attr('id'));
  	})
  </script>
<?php echo $footer ?>