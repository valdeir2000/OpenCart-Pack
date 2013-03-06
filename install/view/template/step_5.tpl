<?php echo $header; ?>
<h1>Step 5 - Formas de Pagamento!</h1>
<div id="column-right">
  <ul>
    <li>Licença</li>
    <li>Pré Instalação</li>
    <li>Configuração</li>
    <li>Formas de Envio</li>
    <li><b>Formas de Pagamento</b></li>
    <li>Módulos</li>
    <li>VQMod</li>
    <li>Finalização</li>
  </ul>
</div>
<div id="content">
  
	<form name="payment" action="index.php?route=step_5/configure" method="post">
		<table>
			<?php foreach ($extensions as $extension): ?>
			<tr>
				<td><input type="checkbox" name="payments[]" value="<?php echo $extension['extension'] ?>" /></td>
				<td><label><?php echo $extension['name'] ?></label></td>
			</tr>
			<?php endforeach; ?>
		</table>
		<br/>
		<div class="buttons">
			<a href="<?php echo $back; ?>" class="button left">Voltar</a>
			<input type="submit" class="button right" value="Continuar" />
		</div>
	</form>
  
</div>
<?php echo $footer; ?>