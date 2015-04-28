<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-correios" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
      	<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-correios" class="form-horizontal">
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-postcode"><?php echo $entry_postcode; ?></label>
            <div class="col-sm-10">
              <input type="text" name="correios_postcode" value="<?php echo $correios_postcode; ?>" placeholder="<?php echo $entry_postcode; ?>" id="input-postcode" class="form-control" />
              <?php if ($error_postcode) { ?>
              <div class="text-danger"><?php echo $error_postcode; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_servicos; ?>"><?php echo $entry_servicos; ?></span></label>
            <div class="col-sm-10">
              <div id="service" class="well well-sm" style="height: 150px; overflow: auto;">
                <div id="Correios">
                  <div class="checkbox">
                    <label>
                      <?php if ($correios_40010) { ?>
                      <input type="checkbox" name="correios_40010" value="1" checked="checked" />
                      <?php echo $text_sedex; ?>
                      <?php } else { ?>
                      <input type="checkbox" name="correios_40010" value="1" />
                      <?php echo $text_sedex; ?>
                      <?php } ?>
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <?php if ($correios_40045) { ?>
                      <input type="checkbox" name="correios_40045" value="1" checked="checked" />
                      <?php echo $text_sedex_cobrar; ?>
                      <?php } else { ?>
                      <input type="checkbox" name="correios_40045" value="1" />
                      <?php echo $text_sedex_cobrar; ?>
                      <?php } ?>
                    </label>
                  </div> 
                  <div class="checkbox">
                    <label>
                      <?php if ($correios_40126) { ?>
                      <input type="checkbox" name="correios_40126" value="1" checked="checked" />
                      <?php echo $text_sedex_cobrar_contrato; ?>
                      <?php } else { ?>
                      <input type="checkbox" name="correios_40126" value="1" />
                      <?php echo $text_sedex_cobrar_contrato; ?>
                      <?php } ?>
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <?php if ($correios_40215) { ?>
                      <input type="checkbox" name="correios_40215" value="1" checked="checked" />
                      <?php echo $text_sedex_10; ?>
                      <?php } else { ?>
                      <input type="checkbox" name="correios_40215" value="1" />
                      <?php echo $text_sedex_10; ?>
                      <?php } ?>
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
	                  <?php if ($correios_40290) { ?>
	                  <input type="checkbox" name="correios_40290" value="1" checked="checked" />
	                  <?php echo $text_sedex_hoje; ?>
	                  <?php } else { ?>
	                  <input type="checkbox" name="correios_40290" value="1" />
	                  <?php echo $text_sedex_hoje; ?>
	                  <?php } ?>
                    </label>                  
                </div> 
                  <div class="checkbox">
                    <label>
	                  <?php if ($correios_40096) { ?>
	                  <input type="checkbox" name="correios_40096" value="1" checked="checked" />
	                  <?php echo $text_sedex_contrato_40096; ?>
	                  <?php } else { ?>
	                  <input type="checkbox" name="correios_40096" value="1" />
	                  <?php echo $text_sedex_contrato_40096; ?>
	                  <?php } ?>
                    </label>                  
                </div>
                  <div class="checkbox">
                    <label>
	                  <?php if ($correios_40436) { ?>
	                  <input type="checkbox" name="correios_40436" value="1" checked="checked" />
	                  <?php echo $text_sedex_contrato_40436; ?>
	                  <?php } else { ?>
	                  <input type="checkbox" name="correios_40436" value="1" />
	                  <?php echo $text_sedex_contrato_40436; ?>
	                  <?php } ?>
                    </label>                  
                </div>
                  <div class="checkbox">
                    <label>
	                  <?php if ($correios_40444) { ?>
	                  <input type="checkbox" name="correios_40444" value="1" checked="checked" />
	                  <?php echo $text_sedex_contrato_40444; ?>
	                  <?php } else { ?>
	                  <input type="checkbox" name="correios_40444" value="1" />
	                  <?php echo $text_sedex_contrato_40444; ?>
	                  <?php } ?>
                    </label>                  
                </div>
                  <div class="checkbox">
                    <label>
	                  <?php if ($correios_40568) { ?>
	                  <input type="checkbox" name="correios_40568" value="1" checked="checked" />
	                  <?php echo $text_sedex_contrato_40568; ?>
	                  <?php } else { ?>
	                  <input type="checkbox" name="correios_40568" value="1" />
	                  <?php echo $text_sedex_contrato_40568; ?>
	                  <?php } ?>
                    </label>                  
                </div>
                  <div class="checkbox">
                    <label>
	                  <?php if ($correios_40606) { ?>
	                  <input type="checkbox" name="correios_40606" value="1" checked="checked" />
	                  <?php echo $text_sedex_contrato_40606; ?>
	                  <?php } else { ?>
	                  <input type="checkbox" name="correios_40606" value="1" />
	                  <?php echo $text_sedex_contrato_40606; ?>
	                  <?php } ?>
                    </label>                  
                </div>
                  <div class="checkbox">
                    <label>
	                  <?php if ($correios_41106) { ?>
	                  <input type="checkbox" name="correios_41106" value="1" checked="checked" />
	                  <?php echo $text_pac; ?>
	                  <?php } else { ?>
	                  <input type="checkbox" name="correios_41106" value="1" />
	                  <?php echo $text_pac; ?>
                    </label>                  
                  <?php } ?>
                </div>
                  <div class="checkbox">
                    <label>
	                  <?php if ($correios_41068) { ?>
	                  <input type="checkbox" name="correios_41068" value="1" checked="checked" />
	                  <?php echo $text_pac_contrato; ?>
	                  <?php } else { ?>
	                  <input type="checkbox" name="correios_41068" value="1" />
	                  <?php echo $text_pac_contrato; ?>
	                  <?php } ?>
                    </label>                  
                </div>                
                  <div class="checkbox">
                    <label>
	                  <?php if ($correios_81019) { ?>
	                  <input type="checkbox" name="correios_81019" value="1" checked="checked" />
	                  <?php echo $text_esedex; ?>
	                  <?php } else { ?>
	                  <input type="checkbox" name="correios_81019" value="1" />
	                  <?php echo $text_esedex; ?>
	                  <?php } ?>
                  	</label> 
                </div> 
                  <div class="checkbox">
                    <label>
	                  <?php if ($correios_81027) { ?>
	                  <input type="checkbox" name="correios_81027" value="1" checked="checked" />
	                  <?php echo $text_esedex_prioritario; ?>
	                  <?php } else { ?>
	                  <input type="checkbox" name="correios_81027" value="1" />
	                  <?php echo $text_esedex_prioritario; ?>
	                  <?php } ?>
                    </label>                  
                </div>
                  <div class="checkbox">
                    <label>
	                  <?php if ($correios_81035) { ?>
	                  <input type="checkbox" name="correios_81035" value="1" checked="checked" />
	                  <?php echo $text_esedex_express; ?>
	                  <?php } else { ?>
	                  <input type="checkbox" name="correios_81035" value="1" />
	                  <?php echo $text_esedex_express; ?>
	                  <?php } ?>
                    </label>                  
                </div> 
                  <div class="checkbox">
                    <label>
	                  <?php if ($correios_81868) { ?>
	                  <input type="checkbox" name="correios_81868" value="1" checked="checked" />
	                  <?php echo $text_esedex_grupo1; ?>
	                  <?php } else { ?>
	                  <input type="checkbox" name="correios_81868" value="1" />
	                  <?php echo $text_esedex_grupo1; ?>
	                  <?php } ?>
                    </label>                  
				</div>
                  <div class="checkbox">
                    <label>
	                  <?php if ($correios_81833) { ?>
	                  <input type="checkbox" name="correios_81833" value="1" checked="checked" />
	                  <?php echo $text_esedex_grupo2; ?>
	                  <?php } else { ?>
	                  <input type="checkbox" name="correios_81833" value="1" />
	                  <?php echo $text_esedex_grupo2; ?>
	                  <?php } ?>
                    </label>                  
				</div>
                  <div class="checkbox">
                    <label>
	                  <?php if ($correios_81850) { ?>
	                  <input type="checkbox" name="correios_81850" value="1" checked="checked" />
	                  <?php echo $text_esedex_grupo3; ?>
	                  <?php } else { ?>
	                  <input type="checkbox" name="correios_81850" value="1" />
	                  <?php echo $text_esedex_grupo3; ?>
	                  <?php } ?>
                    </label>                  
				</div>                                                                        
                </div>
              </div>
              <a onclick="$(this).parent().find(':checkbox').prop('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').prop('checked', false);"><?php echo $text_unselect_all; ?></a> </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-contrato-codigo"><span data-toggle="tooltip" title="<?php echo $help_contrato; ?>"><?php echo $entry_contrato; ?></span></label>
            <div class="col-sm-10">
              <div class="row">
                <div class="col-sm-4">
                  <input type="text" name="correios_contrato_codigo" value="<?php echo $correios_contrato_codigo; ?>" placeholder="<?php echo $entry_contrato_codigo; ?>" id="input-contrato-codigo" class="form-control" />
                </div>
                <div class="col-sm-4">
                  <input type="text" name="correios_contrato_senha" value="<?php echo $correios_contrato_senha; ?>" placeholder="<?php echo $entry_contrato_senha; ?>" id="input-contrato-senha" class="form-control" />
                </div>
                <div class="col-sm-4">
                  
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
          	<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_mao_propria; ?>"><?php echo $entry_mao_propria; ?></span></label>
            <div class="col-sm-10">
              <label class="radio-inline">
                <?php if ($correios_mao_propria == 's') { ?>
                <input type="radio" name="correios_mao_propria" value="s" checked="checked" />
                <?php echo $text_yes; ?>
                <?php } else { ?>
                <input type="radio" name="correios_mao_propria" value="s" />
                <?php echo $text_yes; ?>
                <?php } ?>
              </label>
              <label class="radio-inline">
                <?php if ($correios_mao_propria == 'n') { ?>
                <input type="radio" name="correios_mao_propria" value="n" checked="checked" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="correios_mao_propria" value="n" />
                <?php echo $text_no; ?>
                <?php } ?>
              </label>
            </div>
          </div>
          <div class="form-group">
          	<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_aviso_recebimento; ?>"><?php echo $entry_aviso_recebimento; ?></span></label>
            <div class="col-sm-10">
              <label class="radio-inline">
                <?php if ($correios_aviso_recebimento == 's') { ?>
                <input type="radio" name="correios_aviso_recebimento" value="s" checked="checked" />
                <?php echo $text_yes; ?>
                <?php } else { ?>
                <input type="radio" name="correios_aviso_recebimento" value="s" />
                <?php echo $text_yes; ?>
                <?php } ?>
              </label>
              <label class="radio-inline">
                <?php if ($correios_aviso_recebimento == 'n') { ?>
                <input type="radio" name="correios_aviso_recebimento" value="n" checked="checked" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="correios_aviso_recebimento" value="n" />
                <?php echo $text_no; ?>
                <?php } ?>
              </label>
            </div>
          </div> 
          <div class="form-group">
          	<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_declarar_valor; ?>"><?php echo $entry_declarar_valor; ?></span></label>
            <div class="col-sm-10">
              <label class="radio-inline">
                <?php if ($correios_declarar_valor == 's') { ?>
                <input type="radio" name="correios_declarar_valor" value="s" checked="checked" />
                <?php echo $text_yes; ?>
                <?php } else { ?>
                <input type="radio" name="correios_declarar_valor" value="s" />
                <?php echo $text_yes; ?>
                <?php } ?>
              </label>
              <label class="radio-inline">
                <?php if ($correios_declarar_valor == 'n') { ?>
                <input type="radio" name="correios_declarar_valor" value="n" checked="checked" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="correios_declarar_valor" value="n" />
                <?php echo $text_no; ?>
                <?php } ?>
              </label>
            </div>
          </div>
          <div class="form-group">
          	<label class="col-sm-2 control-label" for="input-correios-adicional"><span data-toggle="tooltip" title="<?php echo $help_adicional; ?>"><?php echo $entry_adicional; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="correios_adicional" value="<?php echo $correios_adicional; ?>" placeholder="<?php echo $entry_adicional; ?>" id="input-correios-adicional" class="form-control" />
            </div>
          </div>
          <div class="form-group">
          	<label class="col-sm-2 control-label" for="input-correios-prazo-adicional"><span data-toggle="tooltip" title="<?php echo $help_prazo_adicional; ?>"><?php echo $entry_prazo_adicional; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="correios_prazo_adicional" value="<?php echo $correios_prazo_adicional; ?>" placeholder="<?php echo $entry_prazo_adicional; ?>" id="input-correios-prazo-adicional" class="form-control" />
            </div>
          </div>  
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-tax-class"><?php echo $entry_tax_class; ?></label>
            <div class="col-sm-10">
              <select name="correios_tax_class_id" id="input-tax-class" class="form-control">
                <option value="0"><?php echo $text_none; ?></option>
                <?php foreach ($tax_classes as $tax_class) { ?>
                <?php if ($tax_class['tax_class_id'] == $correios_tax_class_id) { ?>
                <option value="<?php echo $tax_class['tax_class_id']; ?>" selected="selected"><?php echo $tax_class['title']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $tax_class['tax_class_id']; ?>"><?php echo $tax_class['title']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-geo-zone"><?php echo $entry_geo_zone; ?></label>
            <div class="col-sm-10">
              <select name="correios_geo_zone_id" id="input-geo-zone" class="form-control">
                <option value="0"><?php echo $text_all_zones; ?></option>
                <?php foreach ($geo_zones as $geo_zone) { ?>
                <?php if ($geo_zone['geo_zone_id'] == $correios_geo_zone_id) { ?>
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
              <select name="correios_status" id="input-status" class="form-control">
                <?php if ($correios_status) { ?>
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
              <input type="text" name="correios_sort_order" value="<?php echo $correios_sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />
            </div>
          </div>          
 		</form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>
