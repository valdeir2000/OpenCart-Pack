<?php 
class ControllerPaymentPagamentoDigital extends Controller {
 	private $error = array(); 
	
	public function index() {
		$this->load->language('payment/pagamento_digital');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('pagamento_digital', $this->request->post);				
		  	
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
		
		$data['entry_token'] = $this->language->get('entry_token');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_posfixo'] = $this->language->get('entry_posfixo');
		$data['entry_usar_iframe'] = $this->language->get('entry_usar_iframe');
		$data['entry_validar_dados'] = $this->language->get('entry_validar_dados');		
		$data['entry_order_status'] = $this->language->get('entry_order_status');		
		$data['entry_order_andamento'] = $this->language->get('entry_order_andamento');
		$data['entry_order_concluido'] = $this->language->get('entry_order_concluido');
		$data['entry_order_cancelado'] = $this->language->get('entry_order_cancelado');
		$data['entry_order_analise'] = $this->language->get('entry_order_analise');
		$data['entry_order_aprovado'] = $this->language->get('entry_order_aprovado');
		$data['entry_order_chargeback'] = $this->language->get('entry_order_chargeback');
		$data['entry_order_devolvido'] = $this->language->get('entry_order_devolvido');		
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');	
		$data['entry_update_status_alert'] = $this->language->get('entry_update_status_alert');
		$data['entry_total'] = $this->language->get('entry_total');
		
		$data['help_token'] = $this->language->get('help_token');
		$data['help_email'] = $this->language->get('help_email');
		$data['help_posfixo'] = $this->language->get('help_posfixo');
		$data['help_usar_iframe'] = $this->language->get('help_usar_iframe');
		$data['help_validar_dados'] = $this->language->get('help_validar_dados');		
		$data['help_order_andamento'] = $this->language->get('help_order_andamento');
		$data['help_order_concluido'] = $this->language->get('help_order_concluido');
		$data['help_order_cancelado'] = $this->language->get('help_order_cancelado');
		$data['help_order_analise'] = $this->language->get('help_order_analise');
		$data['help_order_aprovado'] = $this->language->get('help_order_aprovado');
		$data['help_order_chargeback'] = $this->language->get('help_order_chargeback');
		$data['help_order_devolvido'] = $this->language->get('help_order_devolvido');			
		$data['help_update_status_alert'] = $this->language->get('help_update_status_alert');
		$data['help_total'] = $this->language->get('help_total');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		
		if (isset($this->error['warning'])) {
		  $data['error_warning'] = $this->error['warning'];
		} else {
		  $data['error_warning'] = '';
		}
					
		if (isset($this->error['token'])) {
		  $data['error_token'] = $this->error['token'];
		} else {
		  $data['error_token'] = '';
		}
		
		if (isset($this->error['email'])) {
		  $data['error_email'] = $this->error['email'];
		} else {
		  $data['error_email'] = '';
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
			'href' => $this->url->link('payment/pagamento_digital', 'token=' . $this->session->data['token'], 'SSL')
		);
					
		$data['action'] = $this->url->link('payment/pagamento_digital', 'token=' . $this->session->data['token'], 'SSL');
			
		$data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');
		
		if (isset($this->request->post['pagamento_digital_token'])) {
		  $data['pagamento_digital_token'] = $this->request->post['pagamento_digital_token'];
		} else {
		  $data['pagamento_digital_token'] = $this->config->get('pagamento_digital_token');
		}
			
		if (isset($this->request->post['pagamento_digital_email'])) {
		  $data['pagamento_digital_email'] = $this->request->post['pagamento_digital_email'];
		} else {
		  $data['pagamento_digital_email'] = $this->config->get('pagamento_digital_email');
		}
		
		if (isset($this->request->post['pagamento_digital_total'])) {
			$data['pagamento_digital_total'] = $this->request->post['pagamento_digital_total'];
		} else {
			$data['pagamento_digital_total'] = $this->config->get('pagamento_digital_total'); 
		}

		if (isset($this->request->post['pagamento_digital_posfixo'])) {
			$data['pagamento_digital_posfixo'] = $this->request->post['pagamento_digital_posfixo'];
		} else {
			$data['pagamento_digital_posfixo'] = $this->config->get('pagamento_digital_posfixo');
		}

		if (isset($this->request->post['pagamento_digital_update_status_alert'])) {
			$data['pagamento_digital_update_status_alert'] = $this->request->post['pagamento_digital_update_status_alert'];
		} else {
			$data['pagamento_digital_update_status_alert'] = $this->config->get('pagamento_digital_update_status_alert');
		}

		if (isset($this->request->post['pagamento_digital_usar_iframe'])) {
			$data['pagamento_digital_usar_iframe'] = $this->request->post['pagamento_digital_usar_iframe'];
		} else {
			$data['pagamento_digital_usar_iframe'] = $this->config->get('pagamento_digital_usar_iframe');
		}
		
		if (isset($this->request->post['pagamento_digital_validar_dados'])) {
			$data['pagamento_digital_validar_dados'] = $this->request->post['pagamento_digital_validar_dados'];
		} else {
			$data['pagamento_digital_validar_dados'] = $this->config->get('pagamento_digital_validar_dados');
		}		
		
		if (isset($this->request->post['pagamento_digital_order_andamento'])) {
			$data['pagamento_digital_order_andamento'] = $this->request->post['pagamento_digital_order_andamento'];
		} else {
			$data['pagamento_digital_order_andamento'] = $this->config->get('pagamento_digital_order_andamento'); 
		}
			
		if (isset($this->request->post['pagamento_digital_order_concluido'])) {
			$data['pagamento_digital_order_concluido'] = $this->request->post['pagamento_digital_order_concluido'];
		} else {
			$data['pagamento_digital_order_concluido'] = $this->config->get('pagamento_digital_order_concluido'); 
		}
			
		if (isset($this->request->post['pagamento_digital_order_cancelado'])) {
			$data['pagamento_digital_order_cancelado'] = $this->request->post['pagamento_digital_order_cancelado'];
		} else {
			$data['pagamento_digital_order_cancelado'] = $this->config->get('pagamento_digital_order_cancelado'); 
		}
		
		if (isset($this->request->post['pagamento_digital_order_analise'])) {
			$data['pagamento_digital_order_analise'] = $this->request->post['pagamento_digital_order_analise'];
		} else {
			$data['pagamento_digital_order_analise'] = $this->config->get('pagamento_digital_order_analise'); 
		}

		if (isset($this->request->post['pagamento_digital_order_aprovado'])) {
			$data['pagamento_digital_order_aprovado'] = $this->request->post['pagamento_digital_order_aprovado'];
		} else {
			$data['pagamento_digital_order_aprovado'] = $this->config->get('pagamento_digital_order_aprovado'); 
		}

		if (isset($this->request->post['pagamento_digital_order_chargeback'])) {
			$data['pagamento_digital_order_chargeback'] = $this->request->post['pagamento_digital_order_chargeback'];
		} else {
			$data['pagamento_digital_order_chargeback'] = $this->config->get('pagamento_digital_order_chargeback'); 
		}
		
		if (isset($this->request->post['pagamento_digital_order_devolvido'])) {
			$data['pagamento_digital_order_devolvido'] = $this->request->post['pagamento_digital_order_devolvido'];
		} else {
			$data['pagamento_digital_order_devolvido'] = $this->config->get('pagamento_digital_order_devolvido'); 
		}		
		
		if (isset($this->request->post['pagamento_digital_order_nao_efetivado'])) {
			$data['pagamento_digital_order_nao_efetivado'] = $this->request->post['pagamento_digital_order_nao_efetivado'];
		} else {
			$data['pagamento_digital_order_nao_efetivado'] = $this->config->get('pagamento_digital_order_nao_efetivado');
		}    
		
		if (isset($this->request->post['pagamento_digital_order_status_id'])) {
		  $data['pagamento_digital_order_status_id'] = $this->request->post['pagamento_digital_order_status_id'];
		} else {
		  $data['pagamento_digital_order_status_id'] = $this->config->get('pagamento_digital_order_status_id'); 
		}
		
		$this->load->model('localisation/order_status');
		
		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
		
		if (isset($this->request->post['pagamento_digital_geo_zone_id'])) {
		  $data['pagamento_digital_geo_zone_id'] = $this->request->post['pagamento_digital_geo_zone_id'];
		} else {
		  $data['pagamento_digital_geo_zone_id'] = $this->config->get('pagamento_digital_geo_zone_id'); 
		} 
		
		$this->load->model('localisation/geo_zone');
		
		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
		
		if (isset($this->request->post['pagamento_digital_status'])) {
		  $data['pagamento_digital_status'] = $this->request->post['pagamento_digital_status'];
		} else {
		  $data['pagamento_digital_status'] = $this->config->get('pagamento_digital_status');
		}
		
		if (isset($this->request->post['pagamento_digital_sort_order'])) {
		  $data['pagamento_digital_sort_order'] = $this->request->post['pagamento_digital_sort_order'];
		} else {
		  $data['pagamento_digital_sort_order'] = $this->config->get('pagamento_digital_sort_order');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('payment/pagamento_digital.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'payment/pagamento_digital')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->request->post['pagamento_digital_token']) {
		  $this->error['token'] = $this->language->get('error_token');
		}
		
		if (!$this->request->post['pagamento_digital_email']) {
		  $this->error['email'] = $this->language->get('error_email');
		}

		return !$this->error;
	}
}
?>