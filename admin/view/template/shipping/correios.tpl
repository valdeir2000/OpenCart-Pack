<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/shipping.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
    </div>
  	<div class="content">
	  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
	    <table class="form">
	      <tr>
	        <td><span class="required">*</span> <?php echo $entry_postcode; ?><br />
	          </td>
	        <td><input name="correios_postcode" type="text" id="correios_postcode" value="<?php echo $correios_postcode; ?>" />
	         <?php if ($error_postcode) { ?>
	         <span class="error"><?php echo $error_postcode; ?></span>
	         <?php  } ?>
	        </td>
	      </tr>
	      
          <tr>
            <td><?php echo $entry_servicos; ?></td>
            <td>
            <div class="scrollbox">
                <div class="odd">
                  <?php if ($correios_40010) { ?>
                  <input type="checkbox" name="correios_40010" value="1" checked="checked" />
                  <?php echo $text_sedex; ?>
                  <?php } else { ?>
                  <input type="checkbox" name="correios_40010" value="1" />
                  <?php echo $text_sedex; ?>
                  <?php } ?>
                </div>
                <div class="even">
                  <?php if ($correios_40045) { ?>
                  <input type="checkbox" name="correios_40045" value="1" checked="checked" />
                  <?php echo $text_sedex_cobrar; ?>
                  <?php } else { ?>
                  <input type="checkbox" name="correios_40045" value="1" />
                  <?php echo $text_sedex_cobrar; ?>
                  <?php } ?>
                </div>
                <div class="odd">
                  <?php if ($correios_40126) { ?>
                  <input type="checkbox" name="correios_40126" value="1" checked="checked" />
                  <?php echo $text_sedex_cobrar_contrato; ?>
                  <?php } else { ?>
                  <input type="checkbox" name="correios_40126" value="1" />
                  <?php echo $text_sedex_cobrar_contrato; ?>
                  <?php } ?>
                </div>
                <div class="even">
                  <?php if ($correios_40215) { ?>
                  <input type="checkbox" name="correios_40215" value="1" checked="checked" />
                  <?php echo $text_sedex_10; ?>
                  <?php } else { ?>
                  <input type="checkbox" name="correios_40215" value="1" />
                  <?php echo $text_sedex_10; ?>
                  <?php } ?>
                </div>
                <div class="odd">
                  <?php if ($correios_40290) { ?>
                  <input type="checkbox" name="correios_40290" value="1" checked="checked" />
                  <?php echo $text_sedex_hoje; ?>
                  <?php } else { ?>
                  <input type="checkbox" name="correios_40290" value="1" />
                  <?php echo $text_sedex_hoje; ?>
                  <?php } ?>
                </div> 
                <div class="even">
                  <?php if ($correios_40096) { ?>
                  <input type="checkbox" name="correios_40096" value="1" checked="checked" />
                  <?php echo $text_sedex_contrato_40096; ?>
                  <?php } else { ?>
                  <input type="checkbox" name="correios_40096" value="1" />
                  <?php echo $text_sedex_contrato_40096; ?>
                  <?php } ?>
                </div>
                <div class="odd">
                  <?php if ($correios_40436) { ?>
                  <input type="checkbox" name="correios_40436" value="1" checked="checked" />
                  <?php echo $text_sedex_contrato_40436; ?>
                  <?php } else { ?>
                  <input type="checkbox" name="correios_40436" value="1" />
                  <?php echo $text_sedex_contrato_40436; ?>
                  <?php } ?>
                </div>
                <div class="even">
                  <?php if ($correios_40444) { ?>
                  <input type="checkbox" name="correios_40444" value="1" checked="checked" />
                  <?php echo $text_sedex_contrato_40444; ?>
                  <?php } else { ?>
                  <input type="checkbox" name="correios_40444" value="1" />
                  <?php echo $text_sedex_contrato_40444; ?>
                  <?php } ?>
                </div>
                <div class="odd">
                  <?php if ($correios_40568) { ?>
                  <input type="checkbox" name="correios_40568" value="1" checked="checked" />
                  <?php echo $text_sedex_contrato_40568; ?>
                  <?php } else { ?>
                  <input type="checkbox" name="correios_40568" value="1" />
                  <?php echo $text_sedex_contrato_40568; ?>
                  <?php } ?>
                </div>
                <div class="even">
                  <?php if ($correios_40606) { ?>
                  <input type="checkbox" name="correios_40606" value="1" checked="checked" />
                  <?php echo $text_sedex_contrato_40606; ?>
                  <?php } else { ?>
                  <input type="checkbox" name="correios_40606" value="1" />
                  <?php echo $text_sedex_contrato_40606; ?>
                  <?php } ?>
                </div>
                <div class="odd">
                  <?php if ($correios_41106) { ?>
                  <input type="checkbox" name="correios_41106" value="1" checked="checked" />
                  <?php echo $text_pac; ?>
                  <?php } else { ?>
                  <input type="checkbox" name="correios_41106" value="1" />
                  <?php echo $text_pac; ?>
                  <?php } ?>
                </div>
                <div class="even">
                  <?php if ($correios_41068) { ?>
                  <input type="checkbox" name="correios_41068" value="1" checked="checked" />
                  <?php echo $text_pac_contrato; ?>
                  <?php } else { ?>
                  <input type="checkbox" name="correios_41068" value="1" />
                  <?php echo $text_pac_contrato; ?>
                  <?php } ?>
                </div>                
                <div class="odd">
                  <?php if ($correios_81019) { ?>
                  <input type="checkbox" name="correios_81019" value="1" checked="checked" />
                  <?php echo $text_esedex; ?>
                  <?php } else { ?>
                  <input type="checkbox" name="correios_81019" value="1" />
                  <?php echo $text_esedex; ?>
                  <?php } ?>
                </div> 
                <div class="even">
                  <?php if ($correios_81027) { ?>
                  <input type="checkbox" name="correios_81027" value="1" checked="checked" />
                  <?php echo $text_esedex_prioritario; ?>
                  <?php } else { ?>
                  <input type="checkbox" name="correios_81027" value="1" />
                  <?php echo $text_esedex_prioritario; ?>
                  <?php } ?>
                </div>
                <div class="odd">
                  <?php if ($correios_81035) { ?>
                  <input type="checkbox" name="correios_81035" value="1" checked="checked" />
                  <?php echo $text_esedex_express; ?>
                  <?php } else { ?>
                  <input type="checkbox" name="correios_81035" value="1" />
                  <?php echo $text_esedex_express; ?>
                  <?php } ?>
                </div> 
                <div class="even">
                  <?php if ($correios_81868) { ?>
                  <input type="checkbox" name="correios_81868" value="1" checked="checked" />
                  <?php echo $text_esedex_grupo1; ?>
                  <?php } else { ?>
                  <input type="checkbox" name="correios_81868" value="1" />
                  <?php echo $text_esedex_grupo1; ?>
                  <?php } ?>
				</div>
                <div class="odd">
                  <?php if ($correios_81833) { ?>
                  <input type="checkbox" name="correios_81833" value="1" checked="checked" />
                  <?php echo $text_esedex_grupo2; ?>
                  <?php } else { ?>
                  <input type="checkbox" name="correios_81833" value="1" />
                  <?php echo $text_esedex_grupo2; ?>
                  <?php } ?>
				</div>
                <div class="even">
                  <?php if ($correios_81850) { ?>
                  <input type="checkbox" name="correios_81850" value="1" checked="checked" />
                  <?php echo $text_esedex_grupo3; ?>
                  <?php } else { ?>
                  <input type="checkbox" name="correios_81850" value="1" />
                  <?php echo $text_esedex_grupo3; ?>
                  <?php } ?>
				</div>								
          	</div>
         	</td>
          </tr>	      

	      <tr>
	        <td><?php echo $entry_contrato; ?><br />
	          </td>
	        <td>
	        <?php echo $entry_contrato_codigo; ?><br /><input name="correios_contrato_codigo" type="text" id="correios_contrato_codigo" value="<?php echo $correios_contrato_codigo; ?>" /><br/>
	        <?php echo $entry_contrato_senha; ?><br /><input name="correios_contrato_senha" type="text" id="correios_contrato_senha" value="<?php echo $correios_contrato_senha; ?>" />
	        </td>
	      </tr>
	      
	      <tr>
	        <td><?php echo $entry_mao_propria; ?><br />
	          </td>
	        <td>
	        <select name="correios_mao_propria">
		        <option value="n" <?php echo ($correios_mao_propria == 'n') ? ' selected="selected" ' : ''; ?>><?php echo $text_nao; ?></option>
		        <option value="s" <?php echo ($correios_mao_propria == 's') ? ' selected="selected" ' : ''; ?>><?php echo $text_sim; ?></option>
			</select>
	        </td>
	      </tr>
	      
	      <tr>
	        <td><?php echo $entry_aviso_recebimento; ?><br />
	          </td>
	        <td>
	        <select name="correios_aviso_recebimento">
		        <option value="n" <?php echo ($correios_aviso_recebimento == 'n') ? ' selected="selected" ' : ''; ?>><?php echo $text_nao; ?></option>
		        <option value="s" <?php echo ($correios_aviso_recebimento == 's') ? ' selected="selected" ' : ''; ?>><?php echo $text_sim; ?></option>
			</select>
	        </td>
	      </tr> 
	      
	      <tr>
	        <td><?php echo $entry_declarar_valor; ?><br />
	          </td>
	        <td>
	        <select name="correios_declarar_valor">
		        <option value="n" <?php echo ($correios_declarar_valor == 'n') ? ' selected="selected" ' : ''; ?>><?php echo $text_nao; ?></option>
		        <option value="s" <?php echo ($correios_declarar_valor == 's') ? ' selected="selected" ' : ''; ?>><?php echo $text_sim; ?></option>
			</select>
	        </td>
	      </tr>
	      
	      <tr>
	        <td><?php echo $entry_adicional; ?><br />
	          </td>
	        <td><input name="correios_adicional" type="text" id="correios_adicional" value="<?php echo $correios_adicional; ?>" />
	        </td>
	      </tr> 
	      
	      <tr>
	        <td><?php echo $entry_prazo_adicional; ?><br />
	          </td>
	        <td><input name="correios_prazo_adicional" type="text" id="correios_prazo_adicional" value="<?php echo $correios_prazo_adicional; ?>" />
	        </td>
	      </tr> 	                            
	      
	      <tr>
	        <td><?php echo $entry_tax; ?></td>
	        <td><select name="correios_tax_class_id">
	          <option value="0"><?php echo $text_none; ?></option>
	          <?php foreach ($tax_classes as $tax_class) { ?>
	          <?php if ($tax_class['tax_class_id'] == $correios_tax_class_id) { ?>
	          <option value="<?php echo $tax_class['tax_class_id']; ?>" selected="selected"><?php echo $tax_class['title']; ?></option>
	          <?php } else { ?>
	          <option value="<?php echo $tax_class['tax_class_id']; ?>"><?php echo $tax_class['title']; ?></option>
	          <?php } ?>
	          <?php } ?>
	        </select></td>
	      </tr>
	      <tr>
	        <td><?php echo $entry_geo_zone; ?></td>
	        <td><select name="correios_geo_zone_id">
	            <option value="0"><?php echo $text_all_zones; ?></option>
	            <?php foreach ($geo_zones as $geo_zone) { ?>
	            <?php if ($geo_zone['geo_zone_id'] == $correios_geo_zone_id) { ?>
	            <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
	            <?php } else { ?>
	            <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
	            <?php } ?>
	            <?php } ?>
	          </select></td>
	      </tr>
	      <tr>
	        <td width="25%"><?php echo $entry_status; ?></td>
	        <td><select name="correios_status">
	            <?php if ($correios_status) { ?>
	            <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
	            <option value="0"><?php echo $text_disabled; ?></option>
	            <?php } else { ?>
	            <option value="1"><?php echo $text_enabled; ?></option>
	            <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
	            <?php } ?>
	          </select></td>
	      </tr>
	      <tr>
	        <td><?php echo $entry_sort_order; ?></td>
	        <td><input type="text" name="correios_sort_order" value="<?php echo $correios_sort_order; ?>" size="1" /></td>
	      </tr>
	    </table>
	  </form>
    </div>
  </div>
</div>
<?php echo $footer; ?>
