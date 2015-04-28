<?php
// Heading
$_['heading_title']       		= 'Bcash';

// Text
$_['text_payment']        		= 'Pagamento';
$_['text_success']        		= 'Sucesso: Você modificou os detalhes da conta do Bcash!';
$_['text_edit']                 = 'Editar o Bcash';
$_['text_pagamento_digital']	= '<a target="_BLANK" href="http://www.bcash.com.br"><img src="view/image/payment/bcash.png" alt="Bcash" title="Bcash" style="border: 1px solid #EEEEEE;" /></a>';

// Entry
$_['entry_token']         		= 'Chave de acesso';
$_['entry_email']         		= 'Email';
$_['entry_posfixo']         	= 'Pós-fixo do número do pedido';
$_['entry_usar_iframe']         = 'Usar iframe';
$_['entry_validar_dados']       = 'Validar dados';
$_['entry_order_andamento'] 	= 'Status em andamento';
$_['entry_order_concluido'] 	= 'Status concluído';
$_['entry_order_cancelado'] 	= 'Status cancelado';
$_['entry_order_analise'] 		= 'Status análise';
$_['entry_order_aprovado'] 		= 'Status aprovado';
$_['entry_order_chargeback'] 	= 'Status chargeback';
$_['entry_order_devolvido'] 	= 'Status devolvido';
$_['entry_geo_zone']      		= 'Região geográfica';
$_['entry_status']        		= 'Situação';
$_['entry_sort_order']    		= 'Ordenação';
$_['entry_update_status_alert'] = 'Alertar sobre mudança no status';
$_['entry_total']       		= 'Total mínimo'; 

$_['help_token']				= 'Chave/token de acesso que identifica a loja no Bcash';
$_['help_email']				= 'Email da conta no Bcash';
$_['help_posfixo']				= 'Útil para quando tiver várias lojas na mesma conta no Bcash, evitando conflito de pedidos com o mesmo número na mesma conta. Ex. para pedido de nro. 15 e pós-fixo lojaX aparecerá no Bcash como 15_lojaX';
$_['help_usar_iframe']         	= 'O pagamento é feito em uma janela dentro da loja evitando assim abrir uma aba do site do Bcash';
$_['help_validar_dados']      	= 'Criptografa os dados usando Hash para validação pelo Bcash';
$_['help_order_finalizando']	= 'Status quando a loja aguarda o primeiro retorno da confirmação da transação pelo Bcash';
$_['help_order_andamento']		= 'O Bcash recebeu a transação, está analisando ou aguardando o pagamento';
$_['help_order_concluido']		= 'A transação já passou por todo o processo e foi finalizada ou foi confirmado o pagamento';
$_['help_order_cancelado']		= 'Por qualquer motivo a transação foi cancelada, pagamento foi negado, estornado, ocorreu um chargeback';
$_['help_order_analise'] 		= 'A transação está sendo analisada internamente pelo Bcash para aprovação, aguardar posicionamento';
$_['help_order_aprovado'] 		= 'Pagamento do consumidor confirmado pelo Bcash, neste caso deve-se enviar ou disponibilizar o pedido adquirido';
$_['help_order_chargeback'] 	= 'Transação cancelada pelo motivo de chargeback do consumidor, se necessário maiores informações, favor acionar a Central de Atendimentos Bcash';
$_['help_order_devolvido'] 		= 'Transação cancelada e montante pago ou debitado até então restituido ao consumidor, se necessário maiores informações, favor acionar a Central de Atendimentos Bcash';
$_['help_update_status_alert']	= 'Envia email para o cliente avisando-o sobre mudança no status do pedido.';
$_['help_total']				= 'Total mínimo que o pedido deve alcançar para que este método de pagamento seja habilitado.';

// Error
$_['error_permission']    		= 'Atenção: Você não possui permissão para modificar o Bcash!';
$_['error_token']         		= 'Digite a chave/token acesso';
$_['error_email']         		= 'Digite o e-mail cadastrado no Bcash';
?>