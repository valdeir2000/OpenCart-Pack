<?php
/**
 * Módulo akatus Transparente
 *
 * @Autores: Valdeir Santana <valdeirpsr@hotmail.com.br>
 * 
 * @version 1.0.0
 */
?>
<style>
	#cartaoCredito .checkout-heading, #debito .checkout-heading, #pagarBoleto .checkout-heading {cursor:pointer;}
	#erro, #sucesso, #atencao {display:none;}
</style>

<!-- Tipo de Pagamento -->
<input type="hidden" name="tipoPagamento" value="" />
<br />

<div class="warning" id="erro"> ERRO Token de Segurança </div>
<div class="attention" id="atencao"> Atenção </div>
<div class="success" id="sucesso"> Sucesso </div>
<br />

<?php if ($accCartaoCredito != 0): ?>
<div id="cartaoCredito">
	<div class="checkout-heading" alt="cartaoCredito">
		Pagar Com Cartão de Crédito
	</div>
	<div class="checkout-content" style="display:block;">
		<!-- Formas de Pagamento -->
		<table>           
			   <tr>
				   <!-- American Express -->
				   <td><img src="image/akatus/cartaoCredito/1.jpg"/></td>
				   <!-- Diners -->
				   <td><img src="image/akatus/cartaoCredito/2.jpg"/></td>
				   <!-- Elo -->
				   <td><img src="image/akatus/cartaoCredito/3.png"/></td>
				   <!-- Mastercard -->
				   <td><img src="image/akatus/cartaoCredito/4.jpg"/></td>
				   <!-- Visa -->
				   <td><img src="image/akatus/cartaoCredito/5.jpg"/></td>
			   </tr>
			   <tr align="center">
				   <!-- American Express -->
				   <td><input type="radio" name="pgtipo" value="cartao_amex" /></td>
				   <!-- Diners -->
				   <td><input type="radio" name="pgtipo" value="cartao_diners" /></td>
				   <!-- Elo -->
				   <td><input type="radio" name="pgtipo" value="cartao_elo" /></td>
				   <!-- Mastercard -->
				   <td><input type="radio" name="pgtipo" value="cartao_master" /></td>
				   <!-- Visa -->
				   <td><input type="radio" name="pgtipo" value="cartao_visa" /></td>
			   </tr>
			   <br/>
			</table>

			<!-- Dados do Cartão / Inicio -->
			<div id="optCartao" style="display:none;margin-top:50px;">
				<table>
					<!-- Número do Cartão -->
					<tr>
						<td>
							Nome:
							<span class="help">Conforme escrito no cartão</span>
						</td>
						<td>
							<input type="text" name="nomeTitularCartao" alt="Nome do Titular do Cartão" value="<?php echo $nome ?>" />
							<span class='error' name='erroNomeTitular'></span>
						</td>
					</tr>
					<!-- Número do Cartão -->
					<tr>
						<td>
							Número do cartão:
							<span class="help">Apenas números</span>
						</td>
						<td>
							<input type="text" name="numeroCartao" alt="Número do Cartão" />
							<span class='error' name='erroCartaoDeCredito'></span>
						</td>
					</tr>
					<!-- Validade -->
					<tr>
						<td>
							Validade
							<span class="help">Apenas números (MM/AAAA)</span>
						</td>
						<td>
							<input type="text" name="validadeCartao" alt="Validade do Cartão" />
							<span class='error' name='validadeCartaoCredito'></span>
						</td>
					</tr>
					<!-- Código de Segurança -->
					<tr>
						<td>
							Código de Segurança:
							<span class="help">Apenas números</span>
						</td>
						<td>
							<input type="text" name="codSegurancaCartao" alt="Código de Segurança do Cartão"/>
							<span class='error' name='erroCodSeguranca'></span>
						</td>
					</tr>
					<!-- Data de Nascimento -->
					<tr>
						<td>
							Data de nascimento:
							<span class="help">Apenas números</span>
						</td>
						<td>
							<input type="text" name="datanascimento" alt="Data de Nascimento" />
							<span class='error' name='erroDataNascimento'></span>
						</td>
					</tr>
					<!-- Tipo Telefone -->
					<tr>
						<td>Tipo de Telefone:</td>
						<td>
							<select name="telefone_tipo">
								<option value="residencial">Residencial</option>
								<option value="celular">Celular</option>
								<option value="comercial">Comercial</option>
							</select>
						</td>
					</tr>
					<!-- Telefone -->
					<tr>
						<td>
							Telefone:
							<span class="help">Apenas números</span>
						</td>
						<td>
							<input type="text" name="telefone" alt="Telefone para Contato" value="<?php echo $telephone ?>" />
							<span class='error' name='erroTelefone'></span>
						</td>
					</tr>
					<!-- Tipo de Endereço -->
					<tr>
						<td>Tipo de Endereço:</td>
						<td>
							<select name="endereco_tipo">
								<option value="entrega">Entrega</option>
								<option value="comercial">Comercial</option>
							</select>
						</td>
					</tr>
					<!-- Número de CPF -->
					<tr>
						<td>
							Nº CPF':
							<span class="help">Apenas números</span>
						</td>
						<td>
							<input type="text" name="CPF" alt="Número de CPF do Titular" />
							<span class='error' name='erroCPF'></span>
						</td>
					</tr>
					<!-- Parcelas -->
					<tr>
						<td valign="top">Desejo parcelar em: </td>
						<td>
							<!-- As parcelas irão aparecer aqui -->
							<select name="qntParcelas" id="qntParcelas"></select>
							<span class="help" id="jurosParcela"></span>
							<span class='error' name='erroParcelas'></span>
						</td>
					</tr>
					
					<?php if (isset($this->session->data['customer_id'])): ?>
					<!-- Remover/Adicionar Cartão de Crédito para compra 1-Click -->
					<tr title="salvarCartao">
						<td>Desejo Armazenar as informações: </td>
						<td>
							<input type="checkbox" checked="checked" name="salvarCartao" />
							<input type="hidden" value="<?php echo $customer_id ?>" name="customer_id" />
						</td>
					</tr>
					<?php endif; ?>
					
					<tr>
						<td>
							<a onClick="Pagar();"><img src="image/akatus/pagar_akatus.png" alt="Pagar" /></a>
						</td>
					</tr>
				</table>
			</div>
			<!-- Dados do Cartão / Fim -->
		</div>
</div>
<?php endif; ?>

<?php if ($accBoleto != 0): ?>
<div id="pagarBoleto">
	<div class="checkout-heading" alt="pagarBoleto">
		Pagar Com Boleto
	</div>
	<div class="checkout-content">
		<!-- Botão Pagar -->
		<a onClick="processaPagto('boleto');"><img src="image/akatus/pagar_akatus.png" alt="Pagar" /></a>
	</div>
</div>
<?php endif; ?>

<?php if ($accDebito != 0): ?>
<div id="debito">
	<div class="checkout-heading" alt="debito">
		Pagar Com Débito em Conta
	</div>
	<div class="checkout-content">
		<!-- Formas de Pagamento -->
		<table>           
			<tr>
				<!-- Bradesco -->
				<td><img src="image/akatus/debito/7.jpg"/></td>
				<!-- Itaú -->
				<td><img src="image/akatus/debito/9.gif"/></td>
		   </tr>
		   <tr align="center">
				<!-- Bradesco -->
				<td><input type="radio" name="pgDebito" value="tef_bradesco" /></td>
				<!-- Itaú -->
				<td><input type="radio" name="pgDebito" value="tef_itau" /></td>       
			</tr>
			<!-- Botão Pagar -->
			<tr >
				<td colspan="4"><a onClick="processaPagto('debito');"><img src="image/akatus/pagar_akatus.png" alt="Pagar" /></a></td>
			</tr>
		   <br/>
		</table>
	</div>
</div>
<?php endif; ?>

<script type="text/javascript" src="catalog/view/javascript/jquery.meio.mask.js"></script>
<script type="text/javascript">
$(function () {
	
	//Mascara - Número de Cartão
	$('input[name="numeroCartao"]').setMask({
		mask:'99999999999999999999',
		onValid: function () {
			$(this).css('background','#EAF7D9');
			$('span[name="erroCartaoDeCredito"]').empty().hide();
		},
		onInvalid: function () {
			$(this).css('background','#FFD1D1');
			$('span[name="erroCartaoDeCredito"]').text('Digite somente números').show();
		}
	});
	
	//Mascara - Validade do Cartão
	$('input[name="validadeCartao"]').setMask({
		mask:'19/9999',
		onValid: function () {
			$(this).css('background','#EAF7D9');
			$('span[name="validadeCartaoCredito"]').empty().hide();
		},
		onInvalid: function () {
			$(this).css('background','#FFD1D1');
			$('span[name="validadeCartaoCredito"]').text('Data Inválida').show();
		}
	});
	
	//Mascara - Codigo de Segurança do Cartão
	$('input[name="codSegurancaCartao"]').setMask({
		mask:'9',
		type:'repeat',
		maxLength:5,
		onValid: function () {
			$(this).css('background','#EAF7D9');
			$('span[name="erroCodSeguranca"]').empty().hide();
		},
		onInvalid: function () {
			$(this).css('background','#FFD1D1');
			$('span[name="erroCodSeguranca"]').text('Código de Segurança Inválido').show();
		}
	});
	
	//Mascara - Data de Nascimento
	$('input[name="datanascimento"]').setMask({
		mask:'39/19/9999',
		onValid: function () {
			$(this).css('background','#EAF7D9');
			$('span[name="erroDataNascimento"]').empty().hide();
		},
		onInvalid: function () {
			$(this).css('background','#FFD1D1');
			$('span[name="erroDataNascimento"]').text('Data Inválida').show();
		}
	});
	
	//Mascara - Telefone
	$('input[name="telefone"]').setMask({
		mask:'99999999999',
		onValid: function () {
			$(this).css('background','#EAF7D9');
			$('span[name="erroTelefone"]').empty().hide();
		},
		onInvalid: function () {
			$(this).css('background','#FFD1D1');
			$('span[name="erroTelefone"]').text('Número Inválido').show();
		}
	});
	
	//Mascara - CPF
	$('input[name="CPF"]').setMask({
		mask:'99999999999',
		onValid: function () {
			$(this).css('background','#EAF7D9');
			$('span[name="erroCPF"]').empty().hide();
		},
		onInvalid: function () {
			$(this).css('background','#FFD1D1');
			$('span[name="erroCPF"]').text('Número Inválido').show();
		}
	});
	
	//Cartão de Credito
	$('#cartaoCredito .checkout-heading').click(function () {
		$('#pagarBoleto, #debito').find('.checkout-content').slideUp('slow');
		$('#cartaoCredito').find('.checkout-content').slideDown('slow');
	});
	
	//Boleto
	$('#pagarBoleto .checkout-heading').click(function () {
		$('#cartaoCredito, #debito').find('.checkout-content').slideUp('slow');
		$('#pagarBoleto').find('.checkout-content').slideDown('slow');
	});
	
	//Debito
	$('#debito .checkout-heading').click(function () {
		$('#cartaoCredito, #pagarBoleto').find('.checkout-content').slideUp('slow');
		$('#debito').find('.checkout-content').slideDown('slow');
	});

	//Abre tela cartão de crédito
	$("input[name='pgtipo']").click(function (){
		$('#optCartao').show('slow');
		$.ajax({
			url:'index.php?route=payment/akatus/getCartao',
			type:'GET',
			data:'customer_id=<?php echo $customer_id; ?>&bandeira='+$(this).val(),
			dataType:'JSON',
			beforeSend: function () {
				$('input[name="nomeTitularCartao"]').val('Aguarde...');
				$('input[name="numeroCartao"]').val('Aguarde...');
				$('input[name="validadeCartao"]').val('Aguarde...');
				$('input[name="codSegurancaCartao"]').val('Aguarde...');
				$('input[name="datanascimento"]').val('Aguarde...');
				$('input[name="telefone"]').val('Aguarde...');
				$('input[name="CPF"]').val('Aguarde...');
			},
			success: function (data) {
				if (data['error']) {
					$('input[name="customer_id"]').val('<?php echo $customer_id ?>');
					$('input[name="nomeTitularCartao"]').val('<?php echo $nome ?>');
					$('input[name="numeroCartao"]').val('');
					$('input[name="validadeCartao"]').val('');
					$('input[name="codSegurancaCartao"]').val('');
					$('input[name="datanascimento"]').val('');
					$('input[name="telefone"]').val('<?php echo $telephone ?>');
					$('input[name="CPF"]').val('');
					$('tr[title="salvarCartao"]').show();
					$('input[name="salvarCartao"]').attr('checked', true);
				}else{
					$('input[name="customer_id"]').val(data['customer_id']);
					$('input[name="nomeTitularCartao"]').val(data['titularCartao']);
					$('input[name="numeroCartao"]').val(data['numeroCartao']);
					$('input[name="validadeCartao"]').val(data['validadeCartao']);
					$('input[name="codSegurancaCartao"]').val(data['codCartao']);
					$('input[name="datanascimento"]').val(data['nascimentoTitular']);
					$('input[name="telefone"]').val(data['telefoneTitular']);
					$('input[name="CPF"]').val(data['CPFTitular']);
					$('tr[title="salvarCartao"]').hide();
					$('input[name="salvarCartao"]').attr('checked', false);
				}
			}
		});
		calculaParcelas($(this).val());
	})
});
</script>

<script type="text/javascript">
	
	function calculaParcelas(payment_method){
		var qntParcelas = <?php echo $qntParcelas[0]['para'] ?>;
		$('#qntParcelas').empty();
		$.ajax({
			url: 'index.php?route=payment/akatus/parcelas/&payment_method='+payment_method,
			dataType: 'JSON',
			beforeSend: function (){
				$('#qntParcelas').attr('disabled', 'disabled');
			},
			success: function (data){
				numParcela = 0;
				$('#jurosParcela').empty().append(data.resposta.descricao);
				for(i = 0; i < qntParcelas; i++){
					numParcela++;
					if (i == 0){
						$('#qntParcelas').append('<option value="'+numParcela+'">À vista de '+data.resposta.parcelas[i].valor+'</option>');
					}else{
						$('#qntParcelas').append('<option value="'+numParcela+'">'+numParcela+'x de '+data.resposta.parcelas[i].valor+' ao mês '+<?php echo $exibiTotalParcela ?>+'</option>');
					}
					$('#qntParcelas').removeAttr('disabled');
				}
			}
		})
		$('.loadingParcela').remove();
		$('#parcelas_valorTotal').show();
	}
	
	//Pagar via cartão de crédito
	function Pagar(){
		$.ajax({
			url: 'index.php?route=payment/akatus/pagar',
			type: 'post',
			data: 'numero='+$('input[name="numeroCartao"]').val()+'&parcelas='+$('#qntParcelas').val()+'&codigo_de_seguranca='+$('input[name="codSegurancaCartao"]').val()+'&expiracao='+$('input[name="validadeCartao"]').val()+'&meio_de_pagamento='+$('input:radio[name="pgtipo"]:checked').val()+'&nome='+$('input[name="nomeTitularCartao"]').val()+'&cpf='+$('input[name="CPF"]').val()+'&telefone='+$('input[name="telefone"]').val()+'&telefone_tipo='+$('select[name="telefone_tipo"]').val()+'&endereco_tipo='+$('select[name="endereco_tipo"]').val(),
			dataType: 'json',
			beforeSend: function (){
				$('#atencao').empty().append('Por favor, aguarde um momento!').show();
			},
			success: function (data){
				if (data.status != 'erro'){
					salvarCartao();
					$('#sucesso').empty().show('slow');
					Redireciona(10, '<?php echo $continue; ?>', 'sucesso', 'Obrigado por realizar a compra em nosso site! <br/><strong>Dados da Compra:</strong></br>Status: ' + data.status + '<br/>Transacao: ' + data.transacao + '<br/><br/>Você será redirecionado em !tempo segundos.');
				}else{
					$('#erro').empty().append(data.descricao);
				}
			}
		})
	}
	
	function salvarCartao(){		
		if ($('input[name="salvarCartao"]').attr('checked') == 'checked'){
			$.ajax ({
				url:'index.php?route=payment/akatus/salvarCartao',
				data:'customer_id='+$('input[name="customer_id"]').val()+'&bandeiraCartao='+$('input:radio[name="pgtipo"]:checked').val()+'&titularCartao='+$('input[name="nomeTitularCartao"]').val()+'&numeroCartao='+$('input[name="numeroCartao"]').val()+'&validadeCartao='+$('input[name="validadeCartao"]').val()+'&codCartao='+$('input[name="codSegurancaCartao"]').val()+'&nascimentoTitular='+$('input[name="datanascimento"]').val()+'&telefone='+$('input[name="telefone"]').val()+'&cpf='+$('input[name="CPF"]').val(),
				type:'GET',
				success: function () {
					//Codigo
				}
			});
		}
	}
	
	function processaPagto (tipo){
		if (tipo == 'boleto'){
			var meio_de_pagamento = 'boleto';
		}else{
			var meio_de_pagamento = $('input[name="pgDebito"]:checked').val();
		}
		
		$.ajax({
			url: 'index.php?route=payment/akatus/processaPagto',
			type: 'post',
			data: 'numero='+$('input[name="numeroCartao"]').val()+'&parcelas='+$('#qntParcelas').val()+'&codigo_de_seguranca='+$('input[name="codSegurancaCartao"]').val()+'&expiracao='+$('input[name="validadeCartao"]').val()+'&meio_de_pagamento='+meio_de_pagamento+'&nome='+$('input[name="nomeTitularCartao"]').val()+'&cpf='+$('input[name="CPF"]').val()+'&telefone='+$('input[name="telefone"]').val()+'&telefone_tipo='+$('select[name="telefone_tipo"]').val()+'&endereco_tipo='+$('select[name="endereco_tipo"]').val(),
			dataType: 'json',
			beforeSend: function (){
				$('#atencao').empty().append('Por favor, aguarde um momento!').show();
			},
			success: function (data){
				if (data.status != 'erro'){
					$.colorbox({
						iframe:true,
						open:true,
						href:data.url_retorno,
						innerWidth:'90%',
						innerHeight:'90%',
						onClosed: function () {
							$('#sucesso').show('slow');
							Redireciona(10, '<?php echo $continue; ?>', 'sucesso', 'Você será redirecionado em !tempo segundos.');
						}
					});
				}else{
					$('#erro').empty().append(data.descricao);
				}
			}
		})
	}
	
	//Função Redirecionamento
	function Redireciona(tempo, url, onde, msg) {
		$('#erro, #atencao').hide('fast');
		var NovaMsg = msg.replace('!tempo', tempo);
		document.getElementById(onde).innerHTML = NovaMsg;
		tempo--;
		if (tempo == -1)
			location.href = url;
		var nr = 'setTimeout("Redireciona(' + tempo + ',\'' + url + '\',\'' + onde + '\',\'' + msg + '\')",1000)';
		eval(nr);
	};
</script>