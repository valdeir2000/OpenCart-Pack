<?php echo $header; ?>

<div id="content">
	<div class="box">
		<div class="heading">
			<h1>Mensagem de Boas Vindas</h1>
			<div class="buttons">
				<a onclick="$('#form').submit();" class="button">Salvar</a>
				<a href="index.php?route=step_6" class="button">Cancelar</a>
			</div>
		</div>
		<div class="content">
			<form action="index.php?route=step_6/configure&next=true" method="post" enctype="multipart/form-data" id="form">
				<div class="vtabs">
					<span id="module-add">Adicionar&nbsp;<img src="view/image/add.png" alt="" onclick="addModule();" /></span> 
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script>
<script type="text/javascript"><!--
var module_row = 1;

function addModule() {	
	html  = '<div id="tab-module-' + module_row + '" class="vtabs-content">';
	html += '  <div id="language-' + module_row + '" class="htabs">';
        html += '    <a href="#tab-language-'+ module_row + '-1"><img src="view/image/flags/br.png" title="Português (BR)" /> Português (BR)</a>';
    	html += '  </div>';

		html += '    <div id="tab-language-'+ module_row + '-1">';
	html += '      <table class="form">';
	html += '        <tr>';
	html += '          <td>Mensagem de Boas Vindas:</td>';
	html += '          <td><textarea name="welcome_module[' + module_row + '][description][1]" id="description-' + module_row + '-1"></textarea></td>';
	html += '        </tr>';
	html += '      </table>';
	html += '    </div>';
	
	html += '  <table class="form">';
	html += '    <tr>';
	html += '      <td>Layout:</td>';
	html += '      <td><select name="welcome_module[' + module_row + '][layout_id]">';
		html += '           <option value="6">Account</option>';
		html += '           <option value="10">Affiliate</option>';
		html += '           <option value="3">Category</option>';
		html += '           <option value="7">Checkout</option>';
		html += '           <option value="8">Contact</option>';
		html += '           <option value="4">Default</option>';
		html += '           <option value="1">Home</option>';
		html += '           <option value="11">Information</option>';
		html += '           <option value="5">Manufacturer</option>';
		html += '           <option value="2">Product</option>';
		html += '           <option value="9">Sitemap</option>';
		html += '      </select></td>';
	html += '    </tr>';
	html += '    <tr>';
	html += '      <td>Posição:</td>';
	html += '      <td><select name="welcome_module[' + module_row + '][position]">';
	html += '        <option value="content_top">Topo do Conteúdo</option>';
	html += '        <option value="content_bottom">Rodapé do Conteúdo</option>';
	html += '        <option value="column_left">Coluna da Esquerda</option>';
	html += '        <option value="column_right">Coluna da Direita</option>';
	html += '      </select></td>';
	html += '    </tr>';
	html += '    <tr>';
	html += '      <td>Situação:</td>';
	html += '      <td><select name="welcome_module[' + module_row + '][status]">';
	html += '        <option value="1">Habilitado</option>';
	html += '        <option value="0">Desabilitado</option>';
	html += '      </select></td>';
	html += '    </tr>';
	html += '    <tr>';
	html += '      <td>Ordem:</td>';
	html += '      <td><input type="text" name="welcome_module[' + module_row + '][sort_order]" value="" size="3" /></td>';
	html += '    </tr>';
	html += '  </table>'; 
	html += '</div>';
	
	$('#form').append(html); 
		
	$('#language-' + module_row + ' a').tabs();
	
	$('#module-add').before('<a href="#tab-module-' + module_row + '" id="module-' + module_row + '">Módulo ' + module_row + '&nbsp;<img src="view/image/delete.png" alt="" onclick="$(\'.vtabs a:first\').trigger(\'click\'); $(\'#module-' + module_row + '\').remove(); $(\'#tab-module-' + module_row + '\').remove(); return false;" /></a>');
	
	$('.vtabs a').tabs();
	
	$('#module-' + module_row).trigger('click');
	
	module_row++;
}
//--></script>
<script type="text/javascript"><!--
$('.vtabs a').tabs();
//--></script>

<?php echo $footer; ?>