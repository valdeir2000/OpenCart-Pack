<?php if (preg_match('/[0-9]/', $code)) { ?>
  <style type="text/css">
  a {cursor:pointer}
  #warning, #success, #form {display:none;}
  .overlay {height: 40px;width: 80px;background: #FFF;position: absolute;opacity: 0.5;}
  .overlay:hover {opacity: 0;}
  </style>
  
  <div id="warning" class="alert alert-danger"></div>
  <div id="success" class="alert alert-success"></div>
  
  <div class="form-horizontal">
    <div class="form-group" id="bandeiras">
      <div class="col-sm-5 col-sm-offset-2">
        <div class="pull-left">
          <a id="american">
            <div class="overlay"></div>
            <img src="image/moip/cartaoCredito/1.jpg" alt="American Express" title="American Express" />
          </a>
        </div>
  
        <div class="pull-left">
          <a id="diners">
            <div class="overlay"></div>
            <img src="image/moip/cartaoCredito/2.jpg" alt="Diners" title="Diners" />
          </a>
        </div>
  
        <div class="pull-left">
          <a id="hipercard">
            <div class="overlay"></div>
            <img src="image/moip/cartaoCredito/3.jpg" alt="Hipercard" title="Hipercard" />
          </a>
        </div>
  
        <div class="pull-left">
          <a id="mastercard">
            <div class="overlay"></div>
            <img src="image/moip/cartaoCredito/4.jpg" alt="Mastercard" title="Mastercard" />
          </a>
        </div>
  
        <div class="pull-left">
          <a id="visa">
            <div class="overlay"></div>
            <img src="image/moip/cartaoCredito/5.jpg" alt="Visa" title="Visa" />
          </a>
        </div>
      </div>
    </div>
  
    <div id="form">
      <div class="form-group">
        <label class="col-sm-2 control-label">Nome:</label>
        <div class="col-sm-5">
          <input class="form-control" type="text" id="nome" name="nome" value="<?php echo $firstname . ' ' . $lastname ?>" placeholder="Ex: Valdeir Santana" />
          <input class="form-control" type="hidden" id="bandeira" name="bandeira" />
        </div>
      </div>
  
      <div class="form-group">
        <label class="col-sm-2 control-label">Data de Nascimento:</label>
        <div class="col-sm-5">
          <input class="form-control" type="text" id="data-nascimento" name="data-nascimento" placeholder="Ex: 13/07/1993" />
        </div>
      </div>
  
      <div class="form-group">
        <label class="col-sm-2 control-label">CPF:</label>
        <div class="col-sm-5">
          <input class="form-control" type="text" id="cpf" name="cpf" placeholder="Ex: 222.222.222-22" />
        </div>
      </div>
  
      <div class="form-group">
        <label class="col-sm-2 control-label">Telefone:</label>
        <div class="col-sm-5">
          <input class="form-control" type="text" id="telefone" name="telefone" value="<?php echo $telephone ?>" placeholder="Ex: 11987654321" />
        </div>
      </div>
  
      <div class="form-group">
        <label class="col-sm-2 control-label">Número do Cartão:</label>
        <div class="col-sm-5">
          <input class="form-control" type="text" id="numero-cartao" name="numero-cartao" />
        </div>
      </div>
  
      <div class="form-group">
        <label class="col-sm-2 control-label">Validade:</label>
        <div class="col-sm-5">
          <input class="form-control" type="text" id="validade" name="validade" placeholder="Ex: 12/15" />
        </div>
      </div>
  
      <div class="form-group">
        <label class="col-sm-2 control-label">Código de Segurança:</label>
        <div class="col-sm-5">
          <input class="form-control" type="text" id="cvv" name="cvv" placeholder="Ex: 123 ou 1234" />
        </div>
      </div>
  
      <div class="form-group">
        <label class="col-sm-2 control-label">Parcelas:</label>
        <div class="col-sm-5">
          <select class="form-control" id="parcelas" name="parcelas"></select>
        </div>
      </div>
  
      <!--<div class="form-group">
        <div class="col-sm-offset-2 col-sm-5">
          <div class="checkbox">
            <label>
              <input type="checkbox" /> Salvar informações para futuras compras
            </label>
          </div>
        </div>
      </div>-->
  
      <div class="form-group">
        <div class="col-sm-5 col-sm-offset-2">
          <a id="button-confirm" style="cursor:pointer" onClick="pagarCartao()"><img src="image/moip/pagar_moip.png" /></a>
          <div id="MoipWidget" data-token="<?php echo $code ?>" callback-method-success="funcaoSucesso" callback-method-error="funcaoFalha"></div>
        </div>
      </div>
    </div>
  </div>

<script type="text/javascript"><!--
var funcaoSucesso = function(data){
	$.ajax({
		type: 'GET',
		url: 'index.php?route=payment/moip_cartao/confirm',
		cache: false,
		beforeSend: function() {
			$('#success').html(data.Mensagem);
		},
		complete: function() {
			$('#success').html(data.Mensagem).show('slow', function(){
				location.href = '<?php echo $continue ?>';
			});
		}
	});
};

var funcaoFalha = function(data) {
	if (data.Codigo) {
		$('#warning').html(data.Mensagem).show();
	} else {
		var html = '';
		html += '<ul>';
		for(var i=0;i<data.length;i++){
			html += '<li>' + data[i].Mensagem + '</li>';
		}
		html += '</ul>';
		$('#warning').html(html).show();
	}
};
//--></script> 

<script type="text/javascript"><!--

// Função para calcular parcelamento
calcular = function() {
	var settings = {
		cofre: "",
		instituicao: "Visa",
		callback: "retornoCalculoParcelamento"
	};

	MoipUtil.calcularParcela(settings);
};

pagarCartao = function() {
	
	$('#warning').hide().html('pagarCartao');
	
	var data = {
		"Forma": "CartaoCredito",
		"Instituicao": $('#bandeira').val(),
		"Parcelas": $('#parcelas').val(),
		"CartaoCredito": {
			"Numero": $('#numero-cartao').val(),
			"Expiracao": $('#validade').val(),
			"CodigoSeguranca": $('#cvv').val(),
			"Portador": {
				"Nome": $('#nome').val(),
				"DataNascimento": $('#data-nascimento').val(),
				"Telefone": $('#telefone').val(),
				"Identidade": $('#cpf').val()
			}
		}
	}

	MoipWidget(data);
}

retornoCalculoParcelamento = function(data) {

	if (data.codigoErro) {
		$('#warning').show().html(data.message);
	} else {
		$('#parcelas').html('');
		for(var i=0;i<data.parcelas.length;i++){
			if(i == 0){
				$('#parcelas').append('<option value="1">R$' + data.parcelas[i].valor.replace(".",",") + ' à vista </option>');
			}else{
				$('#parcelas').append('<option value=' + data.parcelas[i].quantidade + '>' + data.parcelas[i].quantidade + "x de R$" + data.parcelas[i].valor.replace(".",",") + "</option>");
			};
		};
	}
};

$('#bandeiras a').click(function(){
	$('#bandeiras .overlay').css('opacity', '0.5');
	$(this).find('.overlay').css('opacity', 0);
	$('#form').hide('slow');
	$('#form input').val('');
	$('#form input#bandeira').val($(this).attr('id'));
	$('#form').show('slow');
});

calcular();
//--></script> 
<?php } else { ?>
  <div class="alert alert-danger"><?php echo $code ?></div>
<?php } ?>