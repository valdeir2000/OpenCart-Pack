<?php echo $header ?>
<div class="container">
  <header class="div row">
    <div class="col-sm-6">
      <h1 class="pull-left"><?php echo $step ?><small>/10</small></h1>
      <h3><?php echo $text_setting_module ?><small><?php echo $text_config_module ?></small></h3>
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
        <li id="step1" class="list-group-item"><?php echo $text_license; ?></li>
        <li id="step2" class="list-group-item"><?php echo $text_installation; ?></li>
        <li id="step3" class="list-group-item"><?php echo $text_configuration; ?></li>
        <li id="step4" class="list-group-item"><?php echo $text_modules; ?></li>
        <li id="step5" class="list-group-item"><?php echo $text_payment_method; ?></li>
        <li id="step6" class="list-group-item"><?php echo $text_shipping_method; ?></li>
        <li id="step7" class="list-group-item"><?php echo $text_order_total; ?></li>
        <li id="step8" class="list-group-item"><?php echo $text_feed; ?></li>
        <li id="step9" class="list-group-item"><?php echo $text_modification; ?></li>
        <li id="step10" class="list-group-item"><?php echo $text_themes; ?></li>
        <li id="step11" class="list-group-item"><?php echo $text_finished; ?></li>
      </ul>
    </div>
  </div>

  <script type="text/javascript">
  	$(function(){

  		var html = '';
      var current_step = '#step<?php echo $step ?>';

      $('.list-group ' + current_step).html('<b>' + $('.list-group ' + current_step).text() + '</b>');

  		<?php foreach($modules as $key => $module) { ?>
  		html += '<input type="hidden" name="modules[]" value="<?php echo $modules[$key] ?>" />';
  		<?php } ?>

  		$('form').append(html);
  		
  		$('form').append('<input type="hidden" name="module_name" value="<?php echo $module_name ?>" />');

  		$('form').attr('action', '<?php echo $action ?>');

      $('form input, form textarea, form select').map(function(i, e){
        if (typeof($(e).attr("name")) != 'undefined') {
          if ($(e).attr('name') != 'module_name' && $(e).attr('name') != 'modules[]') {
            $(e).attr('name', 'config[' + $(e).attr('name') + ']');
          }
        }
      })
  		
  		$('#submit').attr('form', $('form').attr('id'));
  	})
  </script>
<?php echo $footer ?>