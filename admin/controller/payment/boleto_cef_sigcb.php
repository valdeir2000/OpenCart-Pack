<?php
class ControllerPaymentBoletocefsigcb extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('payment/boleto_cef_sigcb');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('boleto_cef_sigcb', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_all_zones'] = $this->language->get('text_all_zones');

		$data['text_none'] = $this->language->get('text_none');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');

		$data['text_approved'] = $this->language->get('text_approved');
		$data['text_declined'] = $this->language->get('text_declined');
		$data['text_off'] = $this->language->get('text_off');

		$data['entry_logo'] = $this->language->get('entry_logo');
		$data['entry_identificacao'] = $this->language->get('entry_identificacao');
		$data['entry_cpf_cnpj'] = $this->language->get('entry_cpf_cnpj');
		$data['entry_endereco'] = $this->language->get('entry_endereco');
		$data['entry_cidade_uf'] = $this->language->get('entry_cidade_uf');
		$data['entry_cedente'] = $this->language->get('entry_cedente');
		$data['entry_agencia'] = $this->language->get('entry_agencia');
		$data['entry_conta'] = $this->language->get('entry_conta');
		$data['entry_conta_cedente'] = $this->language->get('entry_conta_cedente');
		$data['entry_carteira'] = $this->language->get('entry_carteira');
		$data['entry_dia_prazo_pg'] = $this->language->get('entry_dia_prazo_pg');
		$data['entry_taxa_boleto'] = $this->language->get('entry_taxa_boleto');
		$data['entry_nosso_numero1'] = $this->language->get('entry_nosso_numero1');
		$data['entry_nosso_numero2'] = $this->language->get('entry_nosso_numero2');
		$data['entry_nosso_numero3'] = $this->language->get('entry_nosso_numero3');
		$data['entry_nosso_numero_const1'] = $this->language->get('entry_nosso_numero_const1');
		$data['entry_nosso_numero_const2'] = $this->language->get('entry_nosso_numero_const2');
		$data['entry_demonstrativo1'] = $this->language->get('entry_demonstrativo1');
		$data['entry_demonstrativo2'] = $this->language->get('entry_demonstrativo2');
		$data['entry_demonstrativo3'] = $this->language->get('entry_demonstrativo3');
		$data['entry_instrucoes1'] = $this->language->get('entry_instrucoes1');
		$data['entry_instrucoes2'] = $this->language->get('entry_instrucoes2');
		$data['entry_instrucoes3'] = $this->language->get('entry_instrucoes3');
		$data['entry_instrucoes4'] = $this->language->get('entry_instrucoes4');

		$data['entry_order_status'] = $this->language->get('entry_order_status');
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['tab_general'] = $this->language->get('tab_general');

		//$data['error_warning'] = @$this->error['warning'];

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_payment'),
			'href' => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('payment/boleto_cef_sigcb', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('payment/boleto_cef_sigcb', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['boleto_cef_sigcb_logo'])) {
			$data['boleto_cef_sigcb_logo'] = $this->request->post['boleto_cef_sigcb_logo'];
		} else {
			$data['boleto_cef_sigcb_logo'] = $this->config->get('boleto_cef_sigcb_logo');
		}
		
		if (isset($this->request->post['boleto_cef_sigcb_identificacao'])) {
			$data['boleto_cef_sigcb_identificacao'] = $this->request->post['boleto_cef_sigcb_identificacao'];
		} else {
			$data['boleto_cef_sigcb_identificacao'] = $this->config->get('boleto_cef_sigcb_identificacao');
		}

		if (isset($this->request->post['boleto_cef_sigcb_cpf_cnpj'])) {
			$data['boleto_cef_sigcb_cpf_cnpj'] = $this->request->post['boleto_cef_sigcb_cpf_cnpj'];
		} else {
			$data['boleto_cef_sigcb_cpf_cnpj'] = $this->config->get('boleto_cef_sigcb_cpf_cnpj');
		}

		if (isset($this->request->post['boleto_cef_sigcb_endereco'])) {
			$data['boleto_cef_sigcb_endereco'] = $this->request->post['boleto_cef_sigcb_endereco'];
		} else {
			$data['boleto_cef_sigcb_endereco'] = $this->config->get('boleto_cef_sigcb_endereco');
		}

		if (isset($this->request->post['boleto_cef_sigcb_cidade_uf'])) {
			$data['boleto_cef_sigcb_cidade_uf'] = $this->request->post['boleto_cef_sigcb_cidade_uf'];
		} else {
			$data['boleto_cef_sigcb_cidade_uf'] = $this->config->get('boleto_cef_sigcb_cidade_uf');
		}

		if (isset($this->request->post['boleto_cef_sigcb_cedente'])) {
			$data['boleto_cef_sigcb_cedente'] = $this->request->post['boleto_cef_sigcb_cedente'];
		} else {
			$data['boleto_cef_sigcb_cedente'] = $this->config->get('boleto_cef_sigcb_cedente');
		}
		
		if (isset($this->request->post['boleto_cef_sigcb_agencia'])) {
			$data['boleto_cef_sigcb_agencia'] = $this->request->post['boleto_cef_sigcb_agencia'];
		} else {
			$data['boleto_cef_sigcb_agencia'] = $this->config->get('boleto_cef_sigcb_agencia');
		}
		
		if (isset($this->request->post['boleto_cef_sigcb_conta'])) {
			$data['boleto_cef_sigcb_conta'] = $this->request->post['boleto_cef_sigcb_conta'];
		} else {
			$data['boleto_cef_sigcb_conta'] = $this->config->get('boleto_cef_sigcb_conta');
		}
		
		if (isset($this->request->post['boleto_cef_sigcb_conta_cedente'])) {
			$data['boleto_cef_sigcb_conta_cedente'] = $this->request->post['boleto_cef_sigcb_conta_cedente'];
		} else {
			$data['boleto_cef_sigcb_conta_cedente'] = $this->config->get('boleto_cef_sigcb_conta_cedente');
		}
		if (isset($this->request->post['boleto_cef_sigcb_carteira'])) {
			$data['boleto_cef_sigcb_carteira'] = $this->request->post['boleto_cef_sigcb_carteira'];
		} else {
			$data['boleto_cef_sigcb_carteira'] = $this->config->get('boleto_cef_sigcb_carteira');
		}

			if (isset($this->request->post['boleto_cef_sigcb_dia_prazo_pg'])) {
			$data['boleto_cef_sigcb_dia_prazo_pg'] = $this->request->post['boleto_cef_sigcb_dia_prazo_pg'];
		} else {
			$data['boleto_cef_sigcb_dia_prazo_pg'] = $this->config->get('boleto_cef_sigcb_dia_prazo_pg');
		}
			if (isset($this->request->post['boleto_cef_sigcb_taxa_boleto'])) {
			$data['boleto_cef_sigcb_taxa_boleto'] = $this->request->post['boleto_cef_sigcb_taxa_boleto'];
		} else {
			$data['boleto_cef_sigcb_taxa_boleto'] = $this->config->get('boleto_cef_sigcb_taxa_boleto');
		}
			if (isset($this->request->post['boleto_cef_sigcb_nosso_numero1'])) {
			$data['boleto_cef_sigcb_nosso_numero1'] = $this->request->post['boleto_cef_sigcb_nosso_numero1'];
		} else {
			$data['boleto_cef_sigcb_nosso_numero1'] = $this->config->get('boleto_cef_sigcb_nosso_numero1');
		}
			if (isset($this->request->post['boleto_cef_sigcb_nosso_numero2'])) {
			$data['boleto_cef_sigcb_nosso_numero2'] = $this->request->post['boleto_cef_sigcb_nosso_numero2'];
		} else {
			$data['boleto_cef_sigcb_nosso_numero2'] = $this->config->get('boleto_cef_sigcb_nosso_numero2');
		}
			if (isset($this->request->post['boleto_cef_sigcb_nosso_numero3'])) {
			$data['boleto_cef_sigcb_nosso_numero3'] = $this->request->post['boleto_cef_sigcb_nosso_numero3'];
		} else {
			$data['boleto_cef_sigcb_nosso_numero3'] = $this->config->get('boleto_cef_sigcb_nosso_numero3');
		}
			if (isset($this->request->post['boleto_cef_sigcb_nosso_numero_const1'])) {
			$data['boleto_cef_sigcb_nosso_numero_const1'] = $this->request->post['boleto_cef_sigcb_nosso_numero_const1'];
		} else {
			$data['boleto_cef_sigcb_nosso_numero_const1'] = $this->config->get('boleto_cef_sigcb_nosso_numero_const1');
		}
			if (isset($this->request->post['boleto_cef_sigcb_nosso_numero_const2'])) {
			$data['boleto_cef_sigcb_nosso_numero_const2'] = $this->request->post['boleto_cef_sigcb_nosso_numero_const2'];
		} else {
			$data['boleto_cef_sigcb_nosso_numero_const2'] = $this->config->get('boleto_cef_sigcb_nosso_numero_const2');
		}

		if (isset($this->request->post['boleto_cef_sigcb_demonstrativo1'])) {
			$data['boleto_cef_sigcb_demonstrativo1'] = $this->request->post['boleto_cef_sigcb_demonstrativo1'];
		} else {
			$data['boleto_cef_sigcb_demonstrativo1'] = $this->config->get('boleto_cef_sigcb_demonstrativo1');
		}
		if (isset($this->request->post['boleto_cef_sigcb_demonstrativo2'])) {
			$data['boleto_cef_sigcb_demonstrativo2'] = $this->request->post['boleto_cef_sigcb_demonstrativo2'];
		} else {
			$data['boleto_cef_sigcb_demonstrativo2'] = $this->config->get('boleto_cef_sigcb_demonstrativo2');
		}
		if (isset($this->request->post['boleto_cef_sigcb_demonstrativo3'])) {
			$data['boleto_cef_sigcb_demonstrativo3'] = $this->request->post['boleto_cef_sigcb_demonstrativo3'];
		} else {
			$data['boleto_cef_sigcb_demonstrativo3'] = $this->config->get('boleto_cef_sigcb_demonstrativo3');
		}
		if (isset($this->request->post['boleto_cef_sigcb_instrucoes1'])) {
			$data['boleto_cef_sigcb_instrucoes1'] = $this->request->post['boleto_cef_sigcb_instrucoes1'];
		} else {
			$data['boleto_cef_sigcb_instrucoes1'] = $this->config->get('boleto_cef_sigcb_instrucoes1');
		}
		if (isset($this->request->post['boleto_cef_sigcb_instrucoes2'])) {
			$data['boleto_cef_sigcb_instrucoes2'] = $this->request->post['boleto_cef_sigcb_instrucoes2'];
		} else {
			$data['boleto_cef_sigcb_instrucoes2'] = $this->config->get('boleto_cef_sigcb_instrucoes2');
		}
		if (isset($this->request->post['boleto_cef_sigcb_instrucoes3'])) {
			$data['boleto_cef_sigcb_instrucoes3'] = $this->request->post['boleto_cef_sigcb_instrucoes3'];
		} else {
			$data['boleto_cef_sigcb_instrucoes3'] = $this->config->get('boleto_cef_sigcb_instrucoes3');
		}

		if (isset($this->request->post['boleto_cef_sigcb_instrucoes4'])) {
			$data['boleto_cef_sigcb_instrucoes4'] = $this->request->post['boleto_cef_sigcb_instrucoes4'];
		} else {
			$data['boleto_cef_sigcb_instrucoes4'] = $this->config->get('boleto_cef_sigcb_instrucoes4');
		}

		if (isset($this->request->post['boleto_cef_sigcb_order_status_id'])) {
			$data['boleto_cef_sigcb_order_status_id'] = $this->request->post['boleto_cef_sigcb_order_status_id'];
		} else {
			$data['boleto_cef_sigcb_order_status_id'] = $this->config->get('boleto_cef_sigcb_order_status_id'); 
		}

		$this->load->model('localisation/order_status');

		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		if (isset($this->request->post['boleto_cef_sigcb_geo_zone_id'])) {
			$data['boleto_cef_sigcb_geo_zone_id'] = $this->request->post['boleto_cef_sigcb_geo_zone_id'];
		} else {
			$data['boleto_cef_sigcb_geo_zone_id'] = $this->config->get('boleto_cef_sigcb_geo_zone_id'); 
		}

		$this->load->model('localisation/geo_zone');

		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		if (isset($this->request->post['boleto_cef_sigcb_status'])) {
			$data['boleto_cef_sigcb_status'] = $this->request->post['boleto_cef_sigcb_status'];
		} else {
			$data['boleto_cef_sigcb_status'] = $this->config->get('boleto_cef_sigcb_status');
		}

		if (isset($this->request->post['boleto_cef_sigcb_sort_order'])) {
			$data['boleto_cef_sigcb_sort_order'] = $this->request->post['boleto_cef_sigcb_sort_order'];
		} else {
			$data['boleto_cef_sigcb_sort_order'] = $this->config->get('boleto_cef_sigcb_sort_order');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('payment/boleto_cef_sigcb.tpl', $data));

/*
		//$this->id       = 'content';
		$this->template = 'payment/boleto_cef_sigcb.tpl';
		//$this->layout   = 'common/layout';
 		//$this->render();
		$this->children = array(
			'common/header',
			'common/footer'
		);
		$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));*/
	}
/*
	private function validate() {
		if (!$this->user->hasPermission('modify', 'payment/boleto_cef_sigcb')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
*/

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'payment/boleto_cef_sigcb')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}
?>