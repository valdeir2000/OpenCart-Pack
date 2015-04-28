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
* Ajustado para versão 2.0.1.1 sem vqMod por: Ibrahim Brumate
* @01/2015
* Sob licença GPL.
*/
// Heading
$_['heading_title'] = 'Boleto Bancário Banco Itaú';

// Text
$_['text_payment'] = 'Pagamento';
$_['text_success'] = 'Boleto Bancário Banco Itaú modificado com sucesso!';
$_['text_edit']    = 'Configurações do Boleto Bancário Banco Itaú';
$_['text_boleto_itau'] = '<img src="view/image/payment/boleto_itau.jpg" alt="Boleto Banco Itaú" title="Boleto Banco Itaú" style="border: 1px solid #EEEEEE;" /></a>';
$_['text_development'] = '<span style="color: green;">Ready</span>';
$_['text_approved'] = 'Em (Aprovado)';
$_['text_declined'] = 'On (Recusado)';
$_['text_off'] = 'Off';

// Entry
$_['entry_logo'] = 'URL da logo';
$_['entry_order_status'] = 'Status inicial do pedido';
$_['entry_convenio'] = 'Conv&ecirc;nio (6 ou 7 ou 8 dígitos)';
$_['entry_contrato'] = 'Contrato';
$_['entry_variacao_carteira'] = 'Variação da Carteira (com traço)';
$_['entry_aceite'] = 'Aceite (S ou N)';
$_['entry_identificacao']= 'Noma da loja';
$_['entry_cpf_cnpj'] = 'CPF ou CNPJ';
$_['entry_endereco'] = 'Endere&ccedil;o da Loja';
$_['entry_cidade_uf'] = 'Cidade / Estado';
$_['entry_cedente'] = 'Nome Cedente - Raz&#227;o Social';
$_['entry_agencia'] = 'Ag&ecirc;ncia (sem d&iacute;gito verificador)';
$_['entry_conta'] = 'Conta (sem d&iacute;gito verificador)';
$_['entry_carteira'] = 'Carteira';
$_['entry_dia_prazo_pg'] = 'Prazo Pagamento em dias (ex: 5)';
$_['entry_taxa_boleto'] = 'Taxa do Boleto em Reais (ex: 2.60)';
$_['entry_nosso_numero'] = 'Formata&ccedil;&atilde;o do nosso n&uacute;mero (Usado apenas p/ convênio c/ 6 dígitos: informe 1 se for nosso número de até 5 dígitos ou 2 para opção de até 17 dígitos)';
$_['entry_formatacao_convenio'] = 'Formata&ccedil;&atilde;o do Conv&ecirc;nio (8 p/ Convênio c/ 8 dígitos, 7 p/ Convênio c/ 7 dígitos, ou 6 se Convênio c/ 6 dígitos)';
$_['entry_demonstrativo1'] = 'Demonstrativo 1';
$_['entry_demonstrativo2'] = 'Demonstrativo 2';
$_['entry_demonstrativo3'] = 'Demonstrativo 3';
$_['entry_instrucoes1'] = 'Instru&ccedil;&otilde;es 1';
$_['entry_instrucoes2'] = 'Instru&ccedil;&otilde;es 2';
$_['entry_instrucoes3'] = 'Instru&ccedil;&otilde;es 3';
$_['entry_instrucoes4'] = 'Instru&ccedil;&otilde;es 4';

$_['entry_geo_zone'] = 'Zona Geografica';
$_['entry_status'] = 'Status';
$_['entry_sort_order'] = 'Ordem de exibi&ccedil;&#227;o';

// Error
$_['error_permission'] = 'ERRO: Voc&ecirc; n&#227;o tem primis&#227;o para modificar Boleto Bancário Banco Itaú!';
?>