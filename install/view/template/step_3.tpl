<?php echo $header; ?>
<h1>Step 3 - Configuração</h1>
<div id="column-right">
  <ul>
    <li>Licença</li>
    <li>Pré Instalação</li>
    <li><b>Configuração</b></li>
    <li>Formas de Envio</li>
    <li>Formas de Pagamento</li>
    <li>Módulos</li>
    <li>VQMod</li>
    <li>Finalização</li>
  </ul>
</div>
<div id="content">
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
    <p>1. Por favor insira os seus dados de conexão de banco de dados.</p>
    <fieldset>
      <table class="form">
        <tr>
          <td>Database Driver:</td>
          <td><select name="db_driver">
              <option value="mysql">MySQL</option>
            </select></td>
        </tr>
        <tr>
          <td><span class="required">*</span> Database Host:</td>
          <td><input type="text" name="db_host" value="<?php echo $db_host; ?>" />
            <br />
            <?php if ($error_db_host) { ?>
            <span class="required"><?php echo $error_db_host; ?></span>
            <?php } ?></td>
        </tr>
        <tr>
          <td><span class="required">*</span> Usuário:</td>
          <td><input type="text" name="db_user" value="<?php echo $db_user; ?>" />
            <br />
            <?php if ($error_db_user) { ?>
            <span class="required"><?php echo $error_db_user; ?></span>
            <?php } ?></td>
        </tr>
        <tr>
          <td>Senha:</td>
          <td><input type="text" name="db_password" value="<?php echo $db_password; ?>" /></td>
        </tr>
        <tr>
          <td><span class="required">*</span> Banco de Dados:</td>
          <td><input type="text" name="db_name" value="<?php echo $db_name; ?>" />
            <br />
            <?php if ($error_db_name) { ?>
            <span class="required"><?php echo $error_db_name; ?></span>
            <?php } ?></td>
        </tr>
        <tr>
          <td>Prefixo:</td>
          <td><input type="text" name="db_prefix" value="<?php echo $db_prefix; ?>" />
            <br />
            <?php if ($error_db_prefix) { ?>
            <span class="required"><?php echo $error_db_prefix; ?></span>
            <?php } ?></td>
        </tr>
      </table>
    </fieldset>
    <p>2. Por favor insira um nome de usuário e senha para a administração.</p>
    <fieldset>
      <table class="form">
        <tr>
          <td><span class="required">*</span> Usuário:</td>
          <td><input type="text" name="username" value="<?php echo $username; ?>" />
            <br />
            <?php if ($error_username) { ?>
            <span class="required"><?php echo $error_username; ?></span>
            <?php } ?></td>
        </tr>
        <tr>
          <td><span class="required">*</span> Senha:</td>
          <td><input type="text" name="password" value="<?php echo $password; ?>" />
            <br />
            <?php if ($error_password) { ?>
            <span class="required"><?php echo $error_password; ?></span>
            <?php } ?></td>
        </tr>
        <tr>
          <td><span class="required">*</span> E-Mail:</td>
          <td><input type="text" name="email" value="<?php echo $email; ?>" />
            <br />
            <?php if ($error_email) { ?>
            <span class="required"><?php echo $error_email; ?></span>
            <?php } ?></td>
        </tr>
      </table>
    </fieldset>
    <div class="buttons">
      <div class="left"><a href="<?php echo $back; ?>" class="button">Voltar</a></div>
      <div class="right">
        <input type="submit" value="Continue" class="button" />
      </div>
    </div>
  </form>
</div>
<?php echo $footer; ?>