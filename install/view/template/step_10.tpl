<?php echo $header ?>
<div class="container">
  <header class="div row">
    <div class="col-sm-6">
      <h1 class="pull-left">10<small>/11</small></h1>
      <h3><?php echo $heading_step_10 ?><small><?php echo $heading_step_10_small ?></small>
    </div>
    <div class="col-sm-6">
      <div id="logo" class="pull-right hidden-xs">
        <img src="view/image/logo.png" alt="OpenCart" title="OpenCart" />
      </div>
    </div>
  </header>

  <div class="row">
    <div class="col-sm-9">
      <form action="<?php echo $action ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
        <p><?php echo $text_choose_modules ?></p>
        <fieldset>
          <?php foreach($themes as $theme) { ?>
          <div class="col-sm-6">
            <div class="form-group">
              <div class="checkbox col-sm-12">
                <?php if ($theme['name'] == 'default') { ?>
                <a class="overlay active"></a>
                <?php } else {?>
                <a class="overlay"></a>
                <?php } ?>
                <img src="<?php echo $theme['image'] ?>" alt="<?php echo $theme['name'] ?>" width="250" height="180" />
              </div>
            </div>
          </div>
          <?php } ?>

          <input type="hidden" name="theme" value="default" />
        </fieldset>

        <div class="buttons">
          <div class="pull-left"><a href="<?php echo $back; ?>" class="btn btn-default"><?php echo $button_back; ?></a></div>
          <div class="pull-right">
            <input type="submit" value="<?php echo $button_continue; ?>" class="btn btn-primary" />
          </div>
        </div>
      </form>
    </div>

    <div class="col-sm-3">
      <ul class="list-group">
        <li class="list-group-item"><?php echo $text_license; ?></li>
        <li class="list-group-item"><?php echo $text_installation; ?></li>
        <li class="list-group-item"><?php echo $text_configuration; ?></li>
        <li class="list-group-item"><?php echo $text_modules; ?></li>
        <li class="list-group-item"><?php echo $text_payment_method; ?></li>
        <li class="list-group-item"><?php echo $text_shipping_method; ?></li>
        <li class="list-group-item"><?php echo $text_order_total; ?></li>
        <li class="list-group-item"><?php echo $text_feed; ?></li>
        <li class="list-group-item"><?php echo $text_modification; ?></li>
        <li class="list-group-item"><b><?php echo $text_themes; ?></b></li>
        <li class="list-group-item"><?php echo $text_finished; ?></li>
      </ul>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(function(){
    $('.overlay').click(function(){
      $('.overlay').removeClass('active');
      $(this).addClass('active');
      $('input[name="theme"]').val($(this).parent().find('img').attr('alt'));
    })
  })
</script>
<?php echo $footer ?>