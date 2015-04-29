<?php
class ControllerPaymentMoip extends Controller {
	private $error = array();
	
	public function index() {
		/* Carrega Linguagem */
		$data = $this->load->language('payment/moip');
		
		/* Define <title></title> */
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->packNacional();

		/* Salva os Dados */
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->load->model('setting/setting');
			
			$this->model_setting_setting->editSetting('moip', $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->response->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		/* Load Models */
		$this->load->model('localisation/order_status');
		$this->load->model('localisation/geo_zone');
		
		/* Error Permission */
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		/* Error Razão do Pagamento */
		if (isset($this->error['razao_pagamento'])) {
			$data['error_razao_pagamento'] = $this->error['razao_pagamento'];
		} else {
			$data['error_razao_pagamento'] = '';
		}
		
		/* Error Token */
		if (isset($this->error['token'])) {
			$data['error_token'] = $this->error['token'];
		} else {
			$data['error_token'] = '';
		}
		
		/* Error Key */
		if (isset($this->error['key'])) {
			$data['error_key'] = $this->error['key'];
		} else {
			$data['error_key'] = '';
		}
		
		/* Error Parcelas */
		if (isset($this->error['parcelas'])) {
			$data['error_parcelas'] = $this->error['parcelas'];
		} else {
			$data['error_parcelas'] = '';
		}
		
		
		/* Breadcrumbs */
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
			'href' => $this->url->link('payment/moip', 'token=' . $this->session->data['token'], 'SSL')
		);
		
		/* Status */
		if (isset($this->request->post['moip_status'])) {
			$data['moip_status'] = $this->request->post['moip_status'];
		} else {
			$data['moip_status'] = $this->config->get('moip_status');
		}
		
		/* Razão do Pagamento */
		if (isset($this->request->post['moip_razao_pagamento'])) {
			$data['moip_razao_pagamento'] = $this->request->post['moip_razao_pagamento'];
		} else {
			$data['moip_razao_pagamento'] = $this->config->get('moip_razao_pagamento');
		}
		
		/* Token */
		if (isset($this->request->post['moip_token'])) {
			$data['moip_token'] = $this->request->post['moip_token'];
		} else {
			$data['moip_token'] = $this->config->get('moip_token');
		}
		
		/* Key */
		if (isset($this->request->post['moip_key'])) {
			$data['moip_key'] = $this->request->post['moip_key'];
		} else {
			$data['moip_key'] = $this->config->get('moip_key');
		}
		
		/* Modo de Teste */
		if (isset($this->request->post['moip_modo_teste'])) {
			$data['moip_modo_teste'] = $this->request->post['moip_modo_teste'];
		} else {
			$data['moip_modo_teste'] = $this->config->get('moip_modo_teste');
		}
		
		/* Notificar Cliente */
		if (isset($this->request->post['moip_notificar_cliente'])) {
			$data['moip_notificar_cliente'] = $this->request->post['moip_notificar_cliente'];
		} else {
			$data['moip_notificar_cliente'] = $this->config->get('moip_notificar_cliente');
		}
		
		/* Desconto Boleto */
		if (isset($this->request->post['moip_desconto_boleto'])) {
			$data['moip_desconto_boleto'] = $this->request->post['moip_desconto_boleto'];
		} else {
			$data['moip_desconto_boleto'] = $this->config->get('moip_desconto_boleto');
		}
		
		/* Desconto Débito */
		if (isset($this->request->post['moip_desconto_debito'])) {
			$data['moip_desconto_debito'] = $this->request->post['moip_desconto_debito'];
		} else {
			$data['moip_desconto_debito'] = $this->config->get('moip_desconto_debito');
		}
		
		/* Desconto Cartão de Crédito */
		if (isset($this->request->post['moip_desconto_cartao'])) {
			$data['moip_desconto_cartao'] = $this->request->post['moip_desconto_cartao'];
		} else {
			$data['moip_desconto_cartao'] = $this->config->get('moip_desconto_cartao');
		}
		
		/* Autorizado */
		if (isset($this->request->post['moip_autorizado'])) {
			$data['moip_autorizado'] = $this->request->post['moip_autorizado'];
		} else {
			$data['moip_autorizado'] = $this->config->get('moip_autorizado');
		}
		
		/* Status Iniciado */
		if (isset($this->request->post['moip_iniciado'])) {
			$data['moip_iniciado'] = $this->request->post['moip_iniciado'];
		} else {
			$data['moip_iniciado'] = $this->config->get('moip_iniciado');
		}
		
		/* Status Boleto Impresso */
		if (isset($this->request->post['moip_boleto_impresso'])) {
			$data['moip_boleto_impresso'] = $this->request->post['moip_boleto_impresso'];
		} else {
			$data['moip_boleto_impresso'] = $this->config->get('moip_boleto_impresso');
		}
		
		/* Status Completo */
		if (isset($this->request->post['moip_completo'])) {
			$data['moip_completo'] = $this->request->post['moip_completo'];
		} else {
			$data['moip_completo'] = $this->config->get('moip_completo');
		}
		
		/* Status Cancelado */
		if (isset($this->request->post['moip_cancelado'])) {
			$data['moip_cancelado'] = $this->request->post['moip_cancelado'];
		} else {
			$data['moip_cancelado'] = $this->config->get('moip_cancelado');
		}
		
		/* Em Análise */
		if (isset($this->request->post['moip_em_analise'])) {
			$data['moip_em_analise'] = $this->request->post['moip_em_analise'];
		} else {
			$data['moip_em_analise'] = $this->config->get('moip_em_analise');
		}
		
		/* Revertido */
		if (isset($this->request->post['moip_revertido'])) {
			$data['moip_revertido'] = $this->request->post['moip_revertido'];
		} else {
			$data['moip_revertido'] = $this->config->get('moip_revertido');
		}
		
		/* Em Revisão */
		if (isset($this->request->post['moip_em_revisao'])) {
			$data['moip_em_revisao'] = $this->request->post['moip_em_revisao'];
		} else {
			$data['moip_em_revisao'] = $this->config->get('moip_em_revisao');
		}
		
		/* Reembolsado */
		if (isset($this->request->post['moip_reembolsado'])) {
			$data['moip_reembolsado'] = $this->request->post['moip_reembolsado'];
		} else {
			$data['moip_reembolsado'] = $this->config->get('moip_reembolsado');
		}
		
		/* Geo Zone */
		if (isset($this->request->post['moip_geo_zone_id'])) {
			$data['moip_geo_zone_id'] = $this->request->post['moip_geo_zone_id'];
		} else {
			$data['moip_geo_zone_id'] = $this->config->get('moip_geo_zone_id');
		}
		
		/* Sort Order / Ordem */
		if (isset($this->request->post['moip_sort_order'])) {
			$data['moip_sort_order'] = $this->request->post['moip_sort_order'];
		} else {
			$data['moip_sort_order'] = $this->config->get('moip_sort_order');
		}
		
		/* Parcelas */
		if (isset($this->request->post['moip_parcela'])) {
			$data['moip_parcela'] = $this->request->post['moip_parcela'];
		} elseif ($this->config->get('moip_parcela')) {
			$data['moip_parcela'] = $this->config->get('moip_parcela');
		} else {
			$data['moip_parcela'] = array();
		}
		
		/* Boleto: Vencimento */
		if (isset($this->request->post['moip_boleto_vencimento'])) {
			$data['moip_boleto_vencimento'] = $this->request->post['moip_boleto_vencimento'];
		} else {
			$data['moip_boleto_vencimento'] = $this->config->get('moip_boleto_vencimento');
		}
		
		/* Boleto: Instrução 1 */
		if (isset($this->request->post['moip_boleto_instrucao_1'])) {
			$data['moip_boleto_instrucao_1'] = $this->request->post['moip_boleto_instrucao_1'];
		} else {
			$data['moip_boleto_instrucao_1'] = $this->config->get('moip_boleto_instrucao_1');
		}
		
		/* Boleto: Instrução 2 */
		if (isset($this->request->post['moip_boleto_instrucao_2'])) {
			$data['moip_boleto_instrucao_2'] = $this->request->post['moip_boleto_instrucao_2'];
		} else {
			$data['moip_boleto_instrucao_2'] = $this->config->get('moip_boleto_instrucao_2');
		}
		
		/* Boleto: Instrução 3 */
		if (isset($this->request->post['moip_boleto_instrucao_3'])) {
			$data['moip_boleto_instrucao_3'] = $this->request->post['moip_boleto_instrucao_3'];
		} else {
			$data['moip_boleto_instrucao_3'] = $this->config->get('moip_boleto_instrucao_3');
		}
		
		/* Boleto: Logo */
		if (isset($this->request->post['moip_boleto_logo'])) {
			$data['moip_boleto_logo'] = $this->request->post['moip_boleto_logo'];
		} else {
			$data['moip_boleto_logo'] = $this->config->get('moip_boleto_logo');
		}
		
		/* Cartão de Crédito */
		if (isset($this->request->post['moip_cartao'])) {
			$data['moip_cartao_credito'] = $this->request->post['moip_cartao'];
		} else {
			$data['moip_cartao_credito'] = $this->config->get('moip_cartao');
		}
		
		/* Cartão de Débito */
		if (isset($this->request->post['moip_debito'])) {
			$data['moip_debito'] = $this->request->post['moip_debito'];
		} else {
			$data['moip_debito'] = $this->config->get('moip_debito');
		}
		
		/* Boleto */
		if (isset($this->request->post['moip_boleto'])) {
			$data['moip_boleto'] = $this->request->post['moip_boleto'];
		} else {
			$data['moip_boleto'] = $this->config->get('moip_boleto');
		}
		
		/* Situações do Pedido */
		$data['statuses'] = $this->model_localisation_order_status->getOrderStatuses();
		
		/* Zonas Geográficas */
		$data['zones'] = $this->model_localisation_geo_zone->getGeoZones();
		
		/* Links */
		$data['action'] = $this->url->link('payment/moip', 'token=' . $this->session->data['token'], 'SSL');
		$data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('payment/moip.tpl', $data));
	}
	
	public function validate() {
		if (!$this->user->hasPermission('modify', 'payment/moip')) {
			$this->error['warning'] = $this->language->get('warning');
		}

		if (empty($this->request->post['moip_razao_pagamento'])) {
			$this->error['razao_pagamento'] = $this->language->get('error_razao_pagamento');
		}

		if (empty($this->request->post['moip_token'])) {
			$this->error['moip_token'] = $this->language->get('error_token');
		}

		if (empty($this->request->post['moip_key'])) {
			$this->error['key'] = $this->language->get('error_key');
		}

		if ($this->request->post['moip_status']) {
			
			$this->request->post['moip_desconto_status'] = 1;
			
			if ($this->request->post['moip_cartao']) {
				$this->request->post['moip_cartao_status'] = 1;
				
				if (!isset($this->request->post['moip_parcela']) || empty($this->request->post['moip_parcela'])) {
					$this->error['parcelas'] = $this->language->get('error_parcelas');
				}
			} else {
				$this->request->post['moip_cartao_status'] = 0;
			}
			
			if ($this->request->post['moip_debito']) {
				$this->request->post['moip_debito_status'] = 1;
			} else {
				$this->request->post['moip_debito_status'] = 0;
			}
			
			if ($this->request->post['moip_boleto']) {
				$this->request->post['moip_boleto_status'] = 1;
			} else {
				$this->request->post['moip_boleto_status'] = 0;
			}
			
		} else {
			$this->request->post['moip_boleto_status'] = 0;
			$this->request->post['moip_debito_status'] = 0;
			$this->request->post['moip_debito_status'] = 0;
			$this->request->post['moip_desconto_status'] = 0;
		}

		return !$this->error;
	}

	public function install(){
		$this->db->query("INSERT INTO `" . DB_PREFIX . "extension` (`type`, `code`) VALUES ('payment', 'moip_boleto') ");
		$this->db->query("INSERT INTO `" . DB_PREFIX . "extension` (`type`, `code`) VALUES ('payment', 'moip_cartao') ");
		$this->db->query("INSERT INTO `" . DB_PREFIX . "extension` (`type`, `code`) VALUES ('payment', 'moip_debito') ");
		$this->db->query("INSERT INTO `" . DB_PREFIX . "extension` (`type`, `code`) VALUES ('total', 'moip_discount') ");
	}

	public function packNacional() {

		/* Boleto */
		$result = $this->db->query('SELECT * FROM `" . DB_PREFIX . "extension` WHERE `code` = "moip_boleto"');

		if ($result->num_rows == 0) {
			$this->db->query("INSERT INTO `" . DB_PREFIX . "extension` (`type`, `code`) VALUES ('payment', 'moip_boleto') ");
		}

		/* Cartão */
		$result = $this->db->query('SELECT * FROM `" . DB_PREFIX . "extension` WHERE `code` = "moip_cartao"');

		if ($result->num_rows == 0) {
			$this->db->query("INSERT INTO `" . DB_PREFIX . "extension` (`type`, `code`) VALUES ('payment', 'moip_cartao') ");
		}

		/* Débito */
		$result = $this->db->query('SELECT * FROM `" . DB_PREFIX . "extension` WHERE `code` = "moip_debito"');

		if ($result->num_rows == 0) {
			$this->db->query("INSERT INTO `" . DB_PREFIX . "extension` (`type`, `code`) VALUES ('payment', 'moip_debito') ");
		}

		/* Total */
		$result = $this->db->query('SELECT * FROM `" . DB_PREFIX . "extension` WHERE `code` = "moip_discount"');

		if ($result->num_rows == 0) {
			$this->db->query("INSERT INTO `" . DB_PREFIX . "extension` (`type`, `code`) VALUES ('total', 'moip_discount') ");
		}
	}
}