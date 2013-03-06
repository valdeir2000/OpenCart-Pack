<?php echo $header; ?>

<div id="content">
	<div class="box">
		<div class="heading">
			<h1>Google Talk</h1>
			<div class="buttons">
				<a onclick="$('#form').submit();" class="button">Salvar</a>
				<a href="index.php?route=step_6" class="button">Cancelar</a>
			</div>
		</div>
		<div class="content">
			<form action="index.php?route=step_6/configure&next=true" method="post" enctype="multipart/form-data" id="form">
				<table class="form">
					<tbody>
						<tr>
							<td><span class="required">*</span> Código Google Talk:<br /><span class="help">Vá em <a onclick="window.open('http://www.google.com/talk/service/badge/New');"><u>Crie Google Talk chatback badge</u></a>, copie e cole o código gerado na caixa de texto ao lado.</span></td>
							<td><textarea name="google_talk_code" cols="40" rows="5"></textarea>
							</td>
						</tr>
					</tbody>
				</table>
				<table id="module" class="list">
					<thead>
						<tr>
							<td class="left">Layout:</td>
							<td class="left">Posição:</td>
							<td class="left">Situação:</td>
							<td class="right">Ordem:</td>
							<td></td>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<td colspan="4"></td>
							<td class="left"><a onclick="addModule();" class="button">Adicionar</a></td>
						</tr>
					</tfoot>
				</table>
			</form>
		</div>
	</div>
</div>


<script type="text/javascript"><!--
var module_row = 0;

function addModule() {	
	html  = '<tbody id="module-row' + module_row + '">';
	html += '  <tr>';
	html += '    <td class="left"><select name="google_talk_module[' + module_row + '][layout_id]">';
		html += '      <option value="6">Account</option>';
		html += '      <option value="10">Affiliate</option>';
		html += '      <option value="3">Category</option>';
		html += '      <option value="7">Checkout</option>';
		html += '      <option value="8">Contact</option>';
		html += '      <option value="4">Default</option>';
		html += '      <option value="1">Home</option>';
		html += '      <option value="11">Information</option>';
		html += '      <option value="5">Manufacturer</option>';
		html += '      <option value="2">Product</option>';
		html += '      <option value="9">Sitemap</option>';
		html += '    </select></td>';
	html += '    <td class="left"><select name="google_talk_module[' + module_row + '][position]">';
	html += '      <option value="content_top">Topo do Conteúdo</option>';
	html += '      <option value="content_bottom">Rodapé do Conteúdo</option>';
	html += '      <option value="column_left">Coluna da Esquerda</option>';
	html += '      <option value="column_right">Coluna da Direita</option>';
	html += '    </select></td>';
	html += '    <td class="left"><select name="google_talk_module[' + module_row + '][status]">';
    html += '      <option value="1" selected="selected">Habilitado</option>';
    html += '      <option value="0">Desabilitado</option>';
    html += '    </select></td>';
	html += '    <td class="right"><input type="text" name="google_talk_module[' + module_row + '][sort_order]" value="" size="3" /></td>';
	html += '    <td class="left"><a onclick="$(\'#module-row' + module_row + '\').remove();" class="button">Remover</a></td>';
	html += '  </tr>';
	html += '</tbody>';
	
	$('#module tfoot').before(html);
	
	module_row++;
}
//--></script>

<?php echo $footer; ?>