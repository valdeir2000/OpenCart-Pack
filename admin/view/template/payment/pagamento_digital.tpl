<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-pagamento-digital" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
      	<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-pagamento-digital" class="form-horizontal">
          <div class="form-group required">
          	<label class="col-sm-2 control-label" for="input-token"><span data-toggle="tooltip" title="<?php echo $help_token; ?>"><?php echo $entry_token; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="pagamento_digital_token" value="<?php echo $pagamento_digital_token; ?>" placeholder="<?php echo $entry_token; ?>" id="input-token" class="form-control" />
              <?php if ($error_token) { ?>
              <div class="text-danger"><?php echo $error_token; ?></div>
              <?php } ?>
            </div>
          </div>      
          <div class="form-group required">
          	<label class="col-sm-2 control-label" for="input-email"><span data-toggle="tooltip" title="<?php echo $help_email; ?>"><?php echo $entry_email; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="pagamento_digital_email" value="<?php echo $pagamento_digital_email; ?>" placeholder="<?php echo $entry_email; ?>" id="input-email" class="form-control" />
              <?php if ($error_email) { ?>
              <div class="text-danger"><?php echo $error_email; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-total"><span data-toggle="tooltip" title="<?php echo $help_total; ?>"><?php echo $entry_total; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="pagamento_digital_total" value="<?php echo $pagamento_digital_total; ?>" placeholder="<?php echo $entry_total; ?>" id="input-total" class="form-control" />
            </div>
          </div> 
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-posfixo"><span data-toggle="tooltip" title="<?php echo $help_posfixo; ?>"><?php echo $entry_posfixo; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="pagamento_digital_posfixo" value="<?php echo $pagamento_digital_posfixo; ?>" placeholder="<?php echo $entry_posfixo; ?>" id="input-posfixo" class="form-control" />
            </div>
          </div> 
          <div class="form-group">
          	<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_update_status_alert; ?>"><?php echo $entry_update_status_alert; ?></span></label>
            <div class="col-sm-10">
              <label class="radio-inline">
                <?php if ($pagamento_digital_update_status_alert) { ?>
                <input type="radio" name="pagamento_digital_update_status_alert" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <?php } else { ?>
                <input type="radio" name="pagamento_digital_update_status_alert" value="1" />
                <?php echo $text_yes; ?>
                <?php } ?>
              </label>
              <label class="radio-inline">
                <?php if (!$pagamento_digital_update_status_alert) { ?>
                <input type="radio" name="pagamento_digital_update_status_alert" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="pagamento_digital_update_status_alert" value="0" />
                <?php echo $text_no; ?>
                <?php } ?>
              </label>
            </div>
          </div>
          <div class="form-group">
          	<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_usar_iframe; ?>"><?php echo $entry_usar_iframe; ?></span></label>
            <div class="col-sm-10">
              <label class="radio-inline">
                <?php if ($pagamento_digital_usar_iframe) { ?>
                <input type="radio" name="pagamento_digital_usar_iframe" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <?php } else { ?>
                <input type="radio" name="pagamento_digital_usar_iframe" value="1" />
                <?php echo $text_yes; ?>
                <?php } ?>
              </label>
              <label class="radio-inline">
                <?php if (!$pagamento_digital_usar_iframe) { ?>
                <input type="radio" name="pagamento_digital_usar_iframe" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="pagamento_digital_usar_iframe" value="0" />
                <?php echo $text_no; ?>
                <?php } ?>
              </label>
            </div>
          </div>
          <div class="form-group">
          	<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_validar_dados; ?>"><?php echo $entry_validar_dados; ?></span></label>
            <div class="col-sm-10">
              <label class="radio-inline">
                <?php if ($pagamento_digital_validar_dados) { ?>
                <input type="radio" name="pagamento_digital_validar_dados" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <?php } else { ?>
                <input type="radio" name="pagamento_digital_validar_dados" value="1" />
                <?php echo $text_yes; ?>
                <?php } ?>
              </label>
              <label class="radio-inline">
                <?php if (!$pagamento_digital_validar_dados) { ?>
                <input type="radio" name="pagamento_digital_validar_dados" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="pagamento_digital_validar_dados" value="0" />
                <?php echo $text_no; ?>
                <?php } ?>
              </label>
            </div>
          </div>		  
          <div class="form-group">
          	<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_order_andamento; ?>"><?php echo $entry_order_andamento; ?></span></label>
            <div class="col-sm-10">
              <select name="pagamento_digital_order_andamento" id="input-order-status-andamento" class="form-control">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $pagamento_digital_order_andamento) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
          	<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_order_analise; ?>"><?php echo $entry_order_analise; ?></span></label>
            <div class="col-sm-10">
              <select name="pagamento_digital_order_analise" id="input-order-status-concluido" class="form-control">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $pagamento_digital_order_analise) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
          	<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_order_aprovado; ?>"><?php echo $entry_order_aprovado; ?></span></label>
            <div class="col-sm-10">
              <select name="pagamento_digital_order_aprovado" id="input-order-status-concluido" class="form-control">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $pagamento_digital_order_aprovado) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
          	<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_order_concluido; ?>"><?php echo $entry_order_concluido; ?></span></label>
            <div class="col-sm-10">
              <select name="pagamento_digital_order_concluido" id="input-order-status-concluido" class="form-control">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $pagamento_digital_order_concluido) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>		  
          <div class="form-group">
          	<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_order_cancelado; ?>"><?php echo $entry_order_cancelado; ?></span></label>
            <div class="col-sm-10">
              <select name="pagamento_digital_order_cancelado" id="input-order-status-cancelado" class="form-control">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $pagamento_digital_order_cancelado) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>	            
          <div class="form-group">
          	<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_order_chargeback; ?>"><?php echo $entry_order_chargeback; ?></span></label>
            <div class="col-sm-10">
              <select name="pagamento_digital_order_chargeback" id="input-order-status-concluido" class="form-control">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $pagamento_digital_order_chargeback) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
          	<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_order_devolvido; ?>"><?php echo $entry_order_devolvido; ?></span></label>
            <div class="col-sm-10">
              <select name="pagamento_digital_order_devolvido" id="input-order-status-concluido" class="form-control">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $pagamento_digital_order_devolvido) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>		  
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-geo-zone"><?php echo $entry_geo_zone; ?></label>
            <div class="col-sm-10">
              <select name="pagamento_digital_geo_zone_id" id="input-geo-zone" class="form-control">
                <option value="0"><?php echo $text_all_zones; ?></option>
                <?php foreach ($geo_zones as $geo_zone) { ?>
                <?php if ($geo_zone['geo_zone_id'] == $pagamento_digital_geo_zone_id) { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>          
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="pagamento_digital_status" id="input-status" class="form-control">
                <?php if ($pagamento_digital_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
            <div class="col-sm-10">
              <input type="text" name="pagamento_digital_sort_order" value="<?php echo $pagamento_digital_sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />
            </div>
          </div>
      	</form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>