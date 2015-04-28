<div class="buttons">
  <?php if (preg_match('/[0-9]/', $code)) { ?>
  <div class="alert alert-success hide" role="alert" id="success"></div>
  <div class="alert alert-danger hide" role="alert" id="warning"></div>
  <div class="pull-right">
    <a id="button-confirm" style="cursor:pointer" onClick="pagarBoleto()"><img src="image/moip/pagar_moip.png" /></a>
    <div id="MoipWidget" data-token="<?php echo $code ?>" callback-method-success="funcaoSucesso" callback-method-error="funcaoFalha"></div>
  </div>
  <?php } else { ?>
  <div class="alert alert-danger" role="alert" id="warning"><?php echo $code ?></div>
  <?php } ?>
</div>
<script type="text/javascript" src="catalog/view/javascript/moip/colorbox/jquery.colorbox-min.js"></script>
<link href="catalog/view/javascript/moip/colorbox/colorbox.css" rel="stylesheet" media="all" />
<script type="text/javascript"><!--
var funcaoSucesso = function(data){
	$.colorbox({
		iframe:true,
		open:true,
		href:data.url,
		innerWidth:'90%',
		innerHeight:'90%',
		onClosed: function () {
			$.ajax({
				type: 'GET',
				url: 'index.php?route=payment/moip_boleto/confirm',
				cache: false,
				beforeSend: function() {
					$('#success').removeClass('hide').html(data.Mensagem);
				},
				complete: function() {
					location.href = '<?php echo $continue ?>';
				}
			});
		}
	});
};

var funcaoFalha = function(data) {
	$('#warning').removeClass('hide').html(data.Mensagem);
};

pagarBoleto = function() {
	var settings = {
		"Forma": "BoletoBancario"
	}
	MoipWidget(settings);
}
//--></script> 
