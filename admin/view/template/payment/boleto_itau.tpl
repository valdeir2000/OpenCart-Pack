<!--
* Módulo de Pagamento Boleto Bancário Banco Itaú
* Feito sobre OpenCart 1.5.1.2
* Autor Guilherme Desimon - http://www.desimon.net
* @12/2010
* Alterado para versão 1.5.1.2 por: Toni Lopes :D
* @09/2011
* colaboração de marciosolano
* Alterado para versão 2.0.1.1 por: Rogério Banquieri
* @12/2014
* Sob licença GPL.
-->
<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-boleto" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-boleto" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-order-status"><?php echo $entry_order_status; ?></label>
            <div class="col-sm-10">
              <select name="boleto_itau_order_status_id" id="boleto_itau_order_status_id" class="form-control">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $boleto_itau_order_status_id) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_logo; ?></label>
            <div class="col-sm-10">
            <input type="text" name="boleto_itau_logo" value="<?php echo $boleto_itau_logo; ?>" placeholder="<?php echo $entry_logo; ?>" class="form-control"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_identificacao; ?></label>
            <div class="col-sm-10">
            <input type="text" name="boleto_itau_identificacao" value="<?php echo $boleto_itau_identificacao; ?>" placeholder="<?php echo $entry_identificacao; ?>" class="form-control"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_cpf_cnpj; ?></label>
            <div class="col-sm-10">
              <input type="text" name="boleto_itau_cpf_cnpj" value="<?php echo $boleto_itau_cpf_cnpj; ?>" id="boleto_itau_cpf_cnpj" placeholder="<?php echo $entry_cpf_cnpj; ?>" class="form-control"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_endereco; ?></label>
            <div class="col-sm-10">
              <input type="text" name="boleto_itau_endereco" value="<?php echo $boleto_itau_endereco; ?>" id="boleto_itau_endereco" placeholder="<?php echo $entry_endereco; ?>" class="form-control"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_cidade_uf; ?></label>
            <div class="col-sm-10">
              <input type="text" name="boleto_itau_cidade_uf" value="<?php echo $boleto_itau_cidade_uf; ?>" id="boleto_itau_cidade_uf" placeholder="<?php echo $entry_cidade_uf; ?>" class="form-control"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_cedente; ?></label>
            <div class="col-sm-10">
              <input type="text" name="boleto_itau_cedente" value="<?php echo $boleto_itau_cedente; ?>" id="boleto_itau_cedente" placeholder="<?php echo $entry_cedente; ?>" class="form-control"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_agencia; ?></label>
            <div class="col-sm-10">
              <input type="text" name="boleto_itau_agencia" value="<?php echo $boleto_itau_agencia; ?>" id="boleto_itau_agencia" placeholder="<?php echo $entry_agencia; ?>" class="form-control"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_conta; ?></label>
            <div class="col-sm-10">
              <input type="text" name="boleto_itau_conta" value="<?php echo $boleto_itau_conta; ?>" id="boleto_itau_conta" placeholder="<?php echo $entry_conta; ?>" class="form-control"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_carteira; ?></label>
            <div class="col-sm-10">
              <input type="text" name="boleto_itau_carteira" value="<?php echo $boleto_itau_carteira; ?>" id="boleto_itau_carteira" placeholder="<?php echo $entry_carteira; ?>" class="form-control"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_variacao_carteira; ?></label>
            <div class="col-sm-10">
              <input type="text" name="boleto_itau_variacao_carteira" value="<?php echo $boleto_itau_variacao_carteira; ?>" id="boleto_itau_variacao_carteira" placeholder="<?php echo $entry_variacao_carteira; ?>" class="form-control"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_convenio; ?></label>
            <div class="col-sm-10">
              <input type="text" name="boleto_itau_convenio" value="<?php echo $boleto_itau_convenio; ?>" id="boleto_itau_convenio" placeholder="<?php echo $entry_convenio; ?>" class="form-control"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_contrato; ?></label>
            <div class="col-sm-10">
              <input type="text" name="boleto_itau_contrato" value="<?php echo $boleto_itau_contrato; ?>" id="boleto_itau_contrato" placeholder="<?php echo $entry_contrato; ?>" class="form-control"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_aceite; ?></label>
            <div class="col-sm-10">
              <input type="text" name="boleto_itau_aceite" value="<?php echo $boleto_itau_aceite; ?>" id="boleto_itau_aceite" placeholder="<?php echo $entry_aceite; ?>" class="form-control"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_dia_prazo_pg; ?></label>
            <div class="col-sm-10">
              <input type="text" name="boleto_itau_dia_prazo_pg" value="<?php echo $boleto_itau_dia_prazo_pg; ?>" id="boleto_itau_dia_prazo_pg" placeholder="<?php echo $entry_dia_prazo_pg; ?>" class="form-control"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_taxa_boleto; ?></label>
            <div class="col-sm-10">
              <input type="text" name="boleto_itau_taxa_boleto" value="<?php echo $boleto_itau_taxa_boleto; ?>" id="boleto_itau_taxa_boleto" placeholder="<?php echo $entry_taxa_boleto; ?>" class="form-control"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_nosso_numero; ?></label>
            <div class="col-sm-10">
              <input type="text" name="boleto_itau_nosso_numero" value="<?php echo $boleto_itau_nosso_numero; ?>" id="boleto_itau_nosso_numero" placeholder="<?php echo $entry_nosso_numero; ?>" class="form-control"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_formatacao_convenio; ?></label>
            <div class="col-sm-10">
              <input type="text" name="boleto_itau_formatacao_convenio" value="<?php echo $boleto_itau_formatacao_convenio; ?>" id="boleto_itau_formatacao_convenio" placeholder="<?php echo $entry_formatacao_convenio; ?>" class="form-control"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_demonstrativo1; ?></label>
            <div class="col-sm-10">
              <input type="text" name="boleto_itau_demonstrativo1" value="<?php echo $boleto_itau_demonstrativo1; ?>" id="boleto_itau_demonstrativo1" placeholder="<?php echo $entry_demonstrativo1; ?>" class="form-control"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_demonstrativo2; ?></label>
            <div class="col-sm-10">
              <input type="text" name="boleto_itau_demonstrativo2" value="<?php echo $boleto_itau_demonstrativo2; ?>" id="boleto_itau_demonstrativo2" placeholder="<?php echo $entry_demonstrativo2; ?>" class="form-control"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_demonstrativo3; ?></label>
            <div class="col-sm-10">
              <input type="text" name="boleto_itau_demonstrativo3" value="<?php echo $boleto_itau_demonstrativo3; ?>" id="boleto_itau_demonstrativo3" placeholder="<?php echo $entry_demonstrativo3; ?>" class="form-control"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_instrucoes1; ?></label>
            <div class="col-sm-10">
              <input type="text" name="boleto_itau_instrucoes1" value="<?php echo $boleto_itau_instrucoes1; ?>" id="boleto_itau_instrucoes1" placeholder="<?php echo $entry_instrucoes1; ?>" class="form-control"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_instrucoes2; ?></label>
            <div class="col-sm-10">
              <input type="text" name="boleto_itau_instrucoes2" value="<?php echo $boleto_itau_instrucoes2; ?>" id="boleto_itau_instrucoes2" placeholder="<?php echo $entry_instrucoes2; ?>" class="form-control"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_instrucoes3; ?></label>
            <div class="col-sm-10">
              <input type="text" name="boleto_itau_instrucoes3" value="<?php echo $boleto_itau_instrucoes3; ?>" id="boleto_itau_instrucoes3" placeholder="<?php echo $entry_instrucoes3; ?>" class="form-control"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_instrucoes4; ?></label>
            <div class="col-sm-10">
              <input type="text" name="boleto_itau_instrucoes4" value="<?php echo $boleto_itau_instrucoes4; ?>" id="boleto_itau_instrucoes4" placeholder="<?php echo $entry_instrucoes4; ?>" class="form-control"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-geo-zone"><?php echo $entry_geo_zone; ?></label>
            <div class="col-sm-10">
              <select name="boleto_itau_geo_zone_id" id="input-geo-zone" class="form-control">
                <option value="0"><?php echo $text_all_zones; ?></option>
                <?php foreach ($geo_zones as $geo_zone) { ?>
                <?php if ($geo_zone['geo_zone_id'] == $boleto_itau_geo_zone_id) { ?>
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
              <select name="boleto_itau_status" id="input-status" class="form-control">
                <?php if ($boleto_itau_status) { ?>
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
              <input type="text" name="boleto_itau_sort_order" value="<?php echo $boleto_itau_sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>
