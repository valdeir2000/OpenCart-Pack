<?php echo $header; ?>
<div id="content">
  
  <div class="box">
    <div class="heading">
      <h1>Frete Grátis</h1>
      <div class="buttons">
		<a onclick="$('#form').submit();" class="button">Salvar</a>
		<a href="index.php?route=step_4" class="button">Cancelar</a>
	  </div>
    </div>
    <div class="content">
      <form action="index.php?route=step_4/configure&next=true" method="post" enctype="multipart/form-data" id="form">
        <table class="form">
          <tr>
            <td>
				Total Mínimo:
				<span class="help">Total mínimo que o pedido deve alcançar para que este método de envio seja habilitado.</span>
			</td>
            <td><input type="text" name="free_total" /></td>
          </tr>
          <tr>
            <td>Região Geográfica:</td>
            <td><select name="free_geo_zone_id">
                <option value="0">Todas as regiões</option>
              </select></td>
          </tr>
          <tr>
            <td>Situação:</td>
            <td><select name="free_status">
                <option value="1">Sim</option>
                <option value="0">Não</option>
              </select></td>
          </tr>
          <tr>
            <td>Ordem:</td>
            <td><input type="text" name="free_sort_order" size="1" /></td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>
<?php echo $footer; ?> 