<?php
class ModelTotalMoipDesconto extends Model {
	public function getTotal(&$total_data, &$total, &$taxes) {
		if (isset($this->session->data['payment_method']['code'])) {
			if ($this->session->data['payment_method']['code'] == 'moip_boleto') {
				
				$this->load->language('payment/moip');

				if (preg_match('/[%]/', $this->config->get('moip_desconto_boleto'))) {
					$percentual = preg_replace('/[^0-9.]/', '', $this->config->get('moip_desconto_boleto')) / 100;
					$valor_desconto = ($percentual * $this->cart->getSubTotal());
				} else {
					$valor_desconto = preg_replace('/[^0-9.]/', '', $this->config->get('moip_desconto_boleto'));
				}

				
				$total_data[] = array(
					'code'       => 'moip_desconto',
					'title'      => $this->language->get('text_desconto'),
					'value'      => $valor_desconto,
					'sort_order' => $this->config->get('moip_sort_order')
				);

				$total -= $valor_desconto;
				
			} elseif ($this->session->data['payment_method']['code'] == 'moip_cartao') {
				
				$this->load->language('payment/moip');

				if (preg_match('/[%]/', $this->config->get('moip_desconto_cartao'))) {
					$percentual = preg_replace('/[^0-9.]/', '', $this->config->get('moip_desconto_cartao')) / 100;
					$valor_desconto = ($percentual * $this->cart->getSubTotal());
				} else {
					$valor_desconto = preg_replace('/[^0-9.]/', '', $this->config->get('moip_desconto_cartao'));
				}

				
				$total_data[] = array(
					'code'       => 'moip_desconto',
					'title'      => $this->language->get('text_desconto'),
					'value'      => $valor_desconto,
					'sort_order' => $this->config->get('moip_sort_order')
				);

				$total -= $valor_desconto;
				
			} elseif ($this->session->data['payment_method']['code'] == 'moip_debito') {
				
				$this->load->language('payment/moip');

				if (preg_match('/[%]/', $this->config->get('moip_desconto_debito'))) {
					$percentual = preg_replace('/[^0-9.]/', '', $this->config->get('moip_desconto_debito')) / 100;
					$valor_desconto = ($percentual * $this->cart->getSubTotal());
				} else {
					$valor_desconto = preg_replace('/[^0-9.]/', '', $this->config->get('moip_desconto_debito'));
				}

				
				$total_data[] = array(
					'code'       => 'moip_desconto',
					'title'      => $this->language->get('text_desconto'),
					'value'      => $valor_desconto,
					'sort_order' => $this->config->get('moip_sort_order')
				);

				$total -= $valor_desconto;
			}
		}
	}
}