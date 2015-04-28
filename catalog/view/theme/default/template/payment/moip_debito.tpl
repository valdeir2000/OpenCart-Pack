<?php if (preg_match('/[0-9]/', $code)) { ?>
<style type="text/css" >
  #success, #warning {display: none}
  .overlay {height: 40px;width: 80px;background: #FFF;position: absolute;opacity: 0.5;}
  .overlay:hover {opacity: 0;}
</style>

<div class="form-horizontal">
  <div class="form-group" id="bandeiras">
    <div style="margin: 0 auto;width: 320px;">
      <div class="pull-left">
        <a id="banco-do-brasil" onClick="escolherBanco('BancoDoBrasil')" title="Banco Do Brasil">
          <div class="overlay"></div>
          <img src="image/moip/debito/6.jpg" alt="Banco Do Brasil" title="Banco Do Brasil" />
        </a>
      </div>
      
      <div class="pull-left">
        <a id="bradesco" onClick="escolherBanco('Bradesco')" title="Bradesco">
          <div class="overlay"></div>
          <img src="image/moip/debito/7.jpg" alt="Bradesco" title="Bradesco" />
        </a>
      </div>
      
      <div class="pull-left">
        <a id="banrisul" onClick="escolherBanco('Banrisul')" title="Banrisul">
          <div class="overlay"></div>
          <img src="image/moip/debito/8.jpg" alt="Banrisul" title="Banrisul" />
        </a>
      </div>
      
      <div class="pull-left">
        <a id="itau" onClick="escolherBanco('Itau')" title="Itaú">
          <div class="overlay"></div>
          <img src="image/moip/debito/9.gif" alt="Itaú" title="Itaú" />
        </a>
      </div>
    </div>
  </div>
</div>

<div class="buttons">
  <div class="alert alert-success" id="success"></div>
  <div class="alert alert-danger" id="warning"></div>
  
  <div id="MoipWidget" data-token="<?php echo $code ?>" callback-method-success="funcaoSucesso" callback-method-error="funcaoFalha"></div>
  
  <div class="pull-right" id="btn-pagar"></div>
</div>

<script type="text/javascript"><!--
var funcaoSucesso = function(data){
	$('#btn-pagar').html('<a id="button-confirm" href="' + data.url + '" target="_blank"><img src="image/moip/pagar_moip.png" /></a>');
	
	$('#button-confirm').click(function(){
		$.ajax({
			type: 'GET',
			url: 'index.php?route=payment/moip_debito/confirm',
			cache: false,
			complete: function() {
				setTimeout(function(){
					location.href = '<?php echo $continue ?>';
				}, 5000)
			}
		});
	});
};

var funcaoFalha = function(data) {
	$('#warning').html(data.Mensagem).show();
};

function escolherBanco(instituicao) {
	if (typeof(instituicao) != "undefined") {
		var settings = {
			"Forma": "DebitoBancario",
			"Instituicao": instituicao
		}
		MoipWidget(settings);
	}
}

$('#bandeiras a').click(function(){
	$('#btn-pagar').hide('slow');
	$('#bandeiras .overlay').css('opacity', '0.5');
	$(this).find('.overlay').css('opacity', 0);
	$('#btn-pagar').show('slow');
});
//--></script> 
<?php } else { ?>
<div class="alert alert-danger" role="alert" id="warning"><?php echo $code ?></div>
<?php } ?>