<?php
class ModelTotalGift extends Model {
	public function getTotal(&$total_data, &$total, &$taxes) {
		if ($this->config->get('gift_status')  && isset($this->session->data['giftWrapping'])){

			$total_data[] = array(
				'code' => 'gift',
				'title' => 'For Gift',
				'text' => $this->currency->format(+$this->config->get('gift_price')),
				'value' => +$this->config->get('gift_price'),
				'sort_order' => $this->config->get('gift_sort_order')
			);

			$total += $this->config->get('gift_price');

		}
	}	
}
?>