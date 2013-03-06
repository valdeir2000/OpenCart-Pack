<?php echo $header; ?>
<h1>Step 7 - VQMod!</h1>
<div id="column-right">
  <ul>
    <li>Licença</li>
    <li>Pré Instalação</li>
    <li>Configuração</li>
    <li>Formas de Envio</li>
    <li>Formas de Pagamento</li>
    <li>Módulos</li>
    <li><b>VQMod</b></li>
	<li>Finalização</li>
  </ul>
</div>
<div id="content">
	
	<div class="box">
		<form id="vqmod" action="#" method="post">
			<table class="list">
				<thead>
					<tr>
						<td class="left">Nome</td>
						<td class="left">Versão</td>
						<td class="left">Autor</td>
						<td class="left">Ação</td>
					</tr>
				</thead>
				
				<tbody>
					<?php foreach($extensions as $extension): ?>
					<tr>
						<td class="left"><?php echo $extension['name'] ?></td>
						<td class="left"><?php echo $extension['version'] ?></td>
						<td class="left"><?php echo $extension['author'] ?></td>
						<td class="left">
							<?php if ($extension['actived']): ?>
							<a class="removeVqmod"><img src="view/image/delete.png" /></a>
							<?php else: ?>
							<a class="addVqmod"><img src="view/image/add.png" /></a>
							<?php endif; ?>
							<input type="hidden" value="<?php echo $extension['basename'] ?>" />
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<br/>
			<div class="buttons">
				<a href="<?php echo $back; ?>" class="button left">Voltar</a>
				<a href="index.php?route=step_8" class="button right">Continuar</a>
			</div>
		</form>
	</div>
</div>

<script><!--
	
	$('.removeVqmod').click(function(){
		element = $(this);
		$.ajax({
			url: 'index.php?route=step_7/removeVqmod',
			type: 'GET',
			data: '&vqmod=' + $(this).next().val(),
			success: function(e){
				$('.box').before('<div class="success" style="display:none">VQMod removido com sucesso</div>');
				$('.success').fadeIn('slow');
				setTimeout(function (){
					$('.success').hide('slow');
				}, 3000);
				element.replaceWith('<a class="removeVqmod"><img src="view/image/add.png" /></a>');
			}
		});
	});
	
	$('.addVqmod').click(function(){
		element = $(this);
		$.ajax({
			url: 'index.php?route=step_7/addVqmod',
			type: 'GET',
			data: '&vqmod=' + $(this).next().val(),
			success: function(e){
				$('.box').before('<div class="success" style="display:none">VQMod adicionado com sucesso</div>');
				$('.success').fadeIn('slow');
				setTimeout(function (){
					$('.success').hide('slow');
				}, 3000);
				element.replaceWith('<a class="removeVqmod"><img src="view/image/delete.png" /></a>');
			}
		});
	});
	
//--></script>

<?php echo $footer; ?>