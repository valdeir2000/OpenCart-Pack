<?php
/*
* Módulo de Pagamento Boleto Bancário Banco Itaú
* Feito sobre OpenCart 1.5.1.2
* Autor Guilherme Desimon - http://www.desimon.net
* @12/2010
* Alterado para versão 1.5.1.2 por: Toni Lopes :D
* @09/2011
* colaboração de marciosolano
* Alterado para versão 2.0.1.1 por: Rogério Banquieri
* @12/2014
* Sob licença GPL.
*/
// Text
$_['text_title'] = 'Boleto Banco Itaú';
$_['text_instruction'] = 'Pagamento preferencialmente nas Ag&ecirc;ncias do Banco itaú ou Internet Banking.';
$_['text_instruction2'] = 'Por favor, clique em continuar para geração do boleto bancário e finalizar o pedido.';
$_['text_bank'] = 'Boleto Banco Itaú';
$_['text_linkboleto'] = '<a href="index.php?route=payment/boleto_itau/callback&order_id=<?php echo $idboleto; ?>" target="_blank">Gerar Segunda Via do Boleto</a>';
$_['text_payment'] = 'Seu pedido n&#227;o ser&aacute; enviado at&eacute; o recebimento da confirma&ccedil;&#227;o do pagamento.';
?>