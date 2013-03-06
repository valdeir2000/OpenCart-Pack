<?php
// Text
$_['text_title']          = 'Klarna Invoice';
$_['text_fee']            = 'Klarna Invoice - Pague dentro de 14 dias <span id="klarna_invoice_toc_link"></span> (+%s)<script text="javascript\">$.getScript(\'http://cdn.klarna.com/public/kitt/toc/v1.0/js/klarna.terms.min.js\', function(){ var terms = new Klarna.Terms.Invoice({ el: \'klarna_invoice_toc_link\', eid: \'%s\', country: \'%s\', charge: %s});})</script>';
$_['text_no_fee']         = 'Klarna Invoice - Pague dentro de 14 dias <span id="klarna_invoice_toc_link"></span><script text="javascript">$.getScript(\'http://cdn.klarna.com/public/kitt/toc/v1.0/js/klarna.terms.min.js\', function(){ var terms = new Klarna.Terms.Invoice({ el: \'klarna_invoice_toc_link\', eid: \'%s\', country: \'%s\'});})</script>';
$_['text_additional']     = 'Klarna requires some additional information before they can proccess your order.';
$_['text_wait']           = 'Aguarde!';
$_['text_male']           = 'Masculino';
$_['text_female']         = 'Feminino';
$_['text_year']           = 'Ano';
$_['text_month']          = 'Mês';
$_['text_day']            = 'Dia';
$_['text_comment']        = 'ID da Klarna Invoice: %s\n%s/%s: %.4f';

// Entry
$_['entry_gender']         = 'Gênero:';
$_['entry_pno']            = 'PNO / BIRTH DATA:<span class="help">(07071960)</span>';
$_['entry_dob']            = 'Data de Nascimento';
$_['entry_phone_no']       = 'Número de telefone:<br /><span class="help">Por favor, insira o seu número de telefone.</span>';
$_['entry_street']         = 'Rua:<br /><span class="help">Por favor, observe que a entrega só pode ser efetuada ao endereço registrado quando o pagamento for concluído através do Klarna.</span>';
$_['entry_house_no']       = 'House No.:';
$_['entry_house_ext']      = 'House Ext.:';
$_['entry_company']        = 'Número de Registro da Empresa:<br /><span class="help">Por favor, insira o número do registro da sua empresa</span>';

// Error
$_['error_deu_terms']     = 'Você precisa concordar com a Política de Privacidade do Klarna (Datenschutz)';
$_['error_address_match'] = 'Os endereços de cobrança e entrega precisam ser iguais se você quiser utilizar o Klarna Invoice';
$_['error_network']       = 'Ocorreu um erro durante a conexão com Klarna. Por favor, tente novamente mais tarde.';
?>