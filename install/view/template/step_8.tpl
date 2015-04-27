<?php echo $header ?>
<div class="container">
  <header class="div row">
    <div class="col-sm-6">
      <h1 class="pull-left">6<small>/finish</small></h1>
      <h3>Feed<small>Configure as opções de Feed</small>
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
        <p>Escolha os módulos</p>
        <fieldset>
          <?php foreach($extensions as $extension) { ?>
          <div class="col-sm-6">
            <div class="form-group">
            	<div class="checkbox col-sm-12">
            	  <label for="">
            	  	<input type="checkbox" name="modules[]" value="<?php echo $extension['extension'] ?>" /> <?php echo $extension['name'] ?>
            	  </label>
            	</div>
            </div>
          </div>
      	  <?php } ?>
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
        <li class="list-group-item">Passo 1</li>
        <li class="list-group-item">Passo 2</li>
        <li class="list-group-item">Passo 3</li>
        <li class="list-group-item">Passo 4</li>
        <li class="list-group-item">Passo 5</li>
        <li class="list-group-item">Passo 6</li>
        <li class="list-group-item"><b>Passo 7</b></li>
        <li class="list-group-item">Passo 8</li>
      </ul>
    </div>
  </div>
</div>
<?php echo $footer ?>