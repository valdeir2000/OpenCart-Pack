<?php
class ControllerPaymentMoip extends Controller {
	public function callback() {
		//Carrega model
		$this->load->model('payment/moip');
		
		//Captura o ID do Pedido
		$order_id = $this->request->post['id_transacao'];
		
		//Captura o Status de Pagamento
		switch ($this->request->post['status_pagamento']) {
			case 1:
				$status_pagamento = $this->config->get('moip_autorizado');
				break;
			case 2:
				$status_pagamento = $this->config->get('moip_iniciado');
				break;
			case 3:
				$status_pagamento = $this->config->get('moip_boleto_impresso');
				break;
			case 4:
				$status_pagamento = $this->config->get('moip_completo');
				break;
			case 5:
				$status_pagamento = $this->config->get('moip_cancelado');
				break;
			case 6:
				$status_pagamento = $this->config->get('moip_em_analise');
				break;
			case 7:
				$status_pagamento = $this->config->get('moip_revertido');
				break;
			case 8:
				$status_pagamento = $this->config->get('moip_em_revisao');
				break;
			case 9:
				$status_pagamento = $this->config->get('moip_reembolsado');
				break;
			default:
				$status_pagamento = $this->config->get('moip_iniciado');
				break;
		}

		//Captura a informação caso o pedido seja cancelado
		if (isset($this->request->post['classificacao'])) {
			$classificacao = $this->request->post['classificacao'];
		} else {
			$classificacao = '';
		}
		
		//Verifica se notifica ao cliente
		if ($this->config->get('moip_notificar_cliente')) {
			$notificacao = true;
		} else {
			$notificacao = false;
		}
		
		//Atualiza pedido
		$this->model_payment_moip->nasp($order_id, $status_pagamento, $classificacao, $notificacao);
	}
}