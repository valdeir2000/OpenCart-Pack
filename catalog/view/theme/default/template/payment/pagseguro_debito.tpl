<style type="text/css">
  a {cursor: pointer}
  .overlay {height: 30px;width: 68px;background: #FFF;position: absolute;opacity: 0.7;}
  .overlay:hover {opacity: 0;}
  .vhide {display:none}
  #button-confirm {margin-right: 40px}
</style>

<div class="container">
  <div class="row-fluid">

    <div class="alert alert-danger vhide" id="warning" role="alert"></div>
    <div class="alert alert-info vhide" id="info" role="alert">Aguarde...</div>

    <div class="form-horizontal">
      <div class="form-group">
        <label class="col-sm-4 col-sm-offset-4">Selecione seu banco</label>
        <div id="bandeiras" class="col-sm-4 col-sm-offset-4"></div>
      </div>

      <div class="form-group">
        <label class="col-sm-4 control-label">CPF:</label>
        <div class="col-sm-4">
          <input class="form-control" id="cpf" name="cpf" type="text" />
          <input id="bandeira" name="bandeira" type="hidden" />
        </div>
      </div>

      <div class="form-group" id="button">
        <div class="col-sm-4 col-sm-offset-4">
          <a id="button-confirm" class="btn btn-primary pull-right">Confirmar</a>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	PagSeguroDirectPayment.setSessionId('<?php echo $session_id ?>');
	
	PagSeguroDirectPayment.getPaymentMethods({
		success: function(bandeiras){
			var cards = bandeiras.paymentMethods.ONLINE_DEBIT.options;
			
			$.map(cards, function(e){
				$('#bandeiras').append('<a class="pull-left" onClick="escolherBanco(\'' + e.name + '\')" id="' + e.name + '"><div class="overlay"></div><img src="https://stc.pagseguro.uol.com.br' + e.images.MEDIUM.path + '" /></a>');
			});
			
			$('#info').hide();
		}
	});
	
	$('#button-confirm').click(function(){
		
		var banco = $('input#bandeira').val();
		var cpf = $('input#cpf').val();
		
		if (cpf == '') {
			$('#warning').html('Informe seu CPF').show();
		} else if (banco == '') {
			$('#warning').html('Informe a bandeira do seu banco').show();
		} else {
			$('#warning').html('').hide();
		}
		
		$.ajax({
			url: 'index.php?route=payment/pagseguro_debito/transition',
			data: 'banco=' + banco.toLowerCase() + '&senderHash=' + PagSeguroDirectPayment.getSenderHash() + '&cpf=' + cpf,
			type: 'POST',
			dataType: 'JSON',
			beforeSend: function() {
				$('#info').show();
			},
			success: function (json) {
				if (json.error) {
					$('#warning').html(json.error.message).show();
				} else {
					$('#button-confirm').hide().attr('disabled');
					$('#button div').append('<a href="' + json.paymentLink + '" target="_blank" class="btn btn-primary pull-right">Finalizar Pagametno</a>');
					
					$.ajax({
						url: 'index.php?route=payment/pagseguro_debito/confirm',
						data: 'status=' + json.status,
						type: 'POST',
						success: function (){
							setTimeout(function(){
								location.href = '<?php echo $continue ?>';
							}, 5000);
						}
					})
				}
			},
			complete: function(data) {
				$('#info').hide();
			}
		})
	})
	
	function escolherBanco(banco) {
		if (typeof(banco) == 'undefined') {
			$('#warning').html('Selecione seu banco');
			return;
		}
		
		$('input#bandeira').val(banco);
		
		$('.overlay').css('opacity', '0.7');
		$('#' + banco).find('.overlay').css('opacity', 0);
	}
</script>