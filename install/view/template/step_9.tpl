<?php echo $header ?>
<div class="container">
  <header class="div row">
    <div class="col-sm-7">
      <h1 class="pull-left">9<small>/11</small></h1>
      <h3><?php echo $heading_step_9 ?><small><?php echo $heading_step_9_small ?></small>
    </div>
    <div class="col-sm-5">
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
          <table class="table-responsive">
            <table class="table table-hover table-bordered">
              <thead>
                <tr>
                  <td class="text-left">Modificação</td>
                  <td class="text-left">Autor</td>
                  <td class="text-left">Versão</td>
                  <td class="text-left">Data</td>
                  <td class="text-right">Status</td>
                </tr>
              </thead>

              <tbody>
                <?php foreach($modifications as $modification) { ?>
                <tr>
                  <td><?php echo $modification['name'] ?></td>
                  <td><?php echo $modification['author'] ?></td>
                  <td><?php echo $modification['version'] ?></td>
                  <td><?php echo $modification['date_added'] ?></td>
                  <td><input type="checkbox" name="modification[<?php echo $modification['id'] ?>]" class="js-switch" /> </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </table>
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
        <li class="list-group-item"><b><?php echo $text_modification; ?></b></li>
        <li class="list-group-item"><?php echo $text_themes; ?></li>
        <li class="list-group-item"><?php echo $text_finished; ?></li>
      </ul>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(function(){
    var elem = $('.js-switch');
    $(elem).each(function(i,e){
      Switchery(e, {
        color: '#8FBB6C',
        secondaryColor: '#F56B6B'
      });
    })
  })
</script>

<?php echo $footer ?>