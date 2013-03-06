<?php echo $header; ?>
<h1>Atualização</h1>
<div id="column-right">
  <ul>
    <li><b>Atualização</b></li>
    <li>Finalização</li>
  </ul>
</div>
<div id="content">
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
    <fieldset>
    <p><b>Siga estes passos com cuidado!</b></p>
    <ol>
      <li>Publicar quaisquer erros de script de atualização problemas no fórum</li>
      <li>Após a atualização, limpar os cookies de seu navegador para evitar erros de token.</li>
      <li>Carregue a página de administração e pressione Ctrl + F5 duas vezes para forçar o navegador para atualizar as alterações de css.</li>
      <li>Vá para área de Administração -> Usuários -> Grupos de Usuários e Editar o grupo Top Adminstrator. Marque todos checkbox.</li>
      <li>Vá para área de Administração e Editar as configurações do Sistema. Atualize todos os campos e clique em salvar, mesmo que nada mudou.</li>
      <li>Carregue a frente de loja e pressione Ctrl + F5 duas vezes para forçar o navegador para atualizar as alterações de css.</li>
    </ol>
    </fieldset>
    <div class="buttons">
	  <div class="right">
        <input type="submit" value="Continue" class="button" />
      </div>
	</div>
  </form>
</div>
<?php echo $footer; ?> 