<?php class ControllerPaymentAkatus extends Controller {

	private $error = array();

	public function index() {

		/* Carrega arquivo de linguagem */
		$this->load->language('payment/akatus');
		/* Define o título da página */
		$this->document->setTitle($this->language->get('heading_title'));
		/* Título */
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		/* Botão Salvar */
		$this->data['btn_save'] = $this->language->get('btn_save');
		/* Botão Cancelar */
		$this->data['btn_cancel'] = $this->language->get('btn_cancel');
		
		/* Tab Configuração */
		$this->data['tab_config'] = $this->language->get('tab_config');
		/* Tab Status de Pagamento */
		$this->data['tab_statusPayment'] = $this->language->get('tab_statusPayment');
		/* Tab Área e Ordem */
		$this->data['tab_areaAndOrder'] = $this->language->get('tab_areaAndOrder');
		/* Tabela Parcelas */
		$this->data['tab_plots'] = $this->language->get('tab_plots');
		/* Tab Métodos de Pagamento */
		$this->data['tab_paymentMethod'] = $this->language->get('tab_paymentMethod');
		
		/* Mensagem Sucesso */
		$this->data['text_success'] = $this->language->get('text_success');
		/* Situação */
		$this->data['text_situacao'] = $this->language->get('text_situacao');
		/* Habilitado */
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		/* Desabilitado */
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		/* E-mail */
		$this->data['text_email'] = $this->language->get('text_email');
		/* Api Key */
		$this->data['text_apiKey'] = $this->language->get('text_apiKey');
		/* Api Nip */
		$this->data['text_apiNip'] = $this->language->get('text_apiNip');
		/* Notificar cliente? */
		$this->data['text_notify'] = $this->language->get('text_notify');
		/* Exibi valor total das parcelas? */
		$this->data['text_exibiTotalParcela'] = $this->language->get('text_exibiTotalParcela');
		/* Desconto Cartão de Crédito */
		$this->data['text_descontoCartao'] = $this->language->get('text_descontoCartao');
		/* Desconto Débito */
		$this->data['text_descontoDebito'] = $this->language->get('text_descontoDebito');
		/* Desconto Boleto */
		$this->data['text_descontoBoleto'] = $this->language->get('text_descontoBoleto');
		/* Pular Etapa 5 */
		$this->data['text_activeStepFive'] = $this->language->get('text_activeStepFive');
		/* Status Aguardando Pagamento */
		$this->data['text_status_pending'] = $this->language->get('text_status_pending');
		/* Status Completo */
		$this->data['text_status_complete'] = $this->language->get('text_status_complete');
		/* Status Cancelado */
		$this->data['text_status_canceled'] = $this->language->get('text_status_canceled');
		/* Status Em Análise */
		$this->data['text_status_analysing'] = $this->language->get('text_status_analysing');
		/* Área */
		$this->data['text_area'] = $this->language->get('text_area');
		/* Ordem */
		$this->data['text_order'] = $this->language->get('text_order');
		/* De */
		$this->data['text_parcela_de'] = $this->language->get('text_parcela_de');
		/* Para */
		$this->data['text_parcela_para'] = $this->language->get('text_parcela_para');
		/* Cartão de Crédito */
		$this->data['text_cartaoCredito'] = $this->language->get('text_cartaoCredito');
		/* Cartão de Débito */
		$this->data['text_cartaoDebito'] = $this->language->get('text_cartaoDebito');
		/* Boleto Báncario */
		$this->data['text_boletoBancario'] = $this->language->get('text_boletoBancario');
		/* Todas as Áreas */
		$this->data['text_todasAreas'] = $this->language->get('text_todasAreas');
		
		/* Ajuda Pular Etapa 5 */
		$this->data['help_activeStepFive'] = $this->language->get('help_activeStepFive');
		
		/* Carrega model setting */
		$this->load->model('setting/setting');

		/* Salva as informações */
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
            $this->load->model('setting/setting');
			$this->load->model('payment/akatus');
        	
        	$this->load->model_payment_akatus->updateModule($_POST);

            $this->model_setting_setting->editSetting('akatus', $this->request->post);				

            $this->session->data['success'] = $this->language->get('text_success');

            $this->redirect(HTTPS_SERVER . 'index.php?route=extension/payment&token=' . $this->session->data['token']);
        }

        /* Carrega todos status cadastrado */
		$this->load->model('localisation/order_status');
		/* Recebe todos status cadastrado */
		$this->data['order_statuses'] = $this->load->model_localisation_order_status->getOrderStatuses();

		/* Carrega todas zonas geográficas */
		$this->load->model('localisation/geo_zone');
		/* Recebe todas zonas geográficas */
		$this->data['geo_zones'] = $this->load->model_localisation_geo_zone->getGeoZones();

		/* Status */
		if (isset($this->request->post['akatus_status'])){
			$this->data['akatus_status'] = $this->request->post['akatus_status'];
		}else{
			$this->data['akatus_status'] = $this->config->get('akatus_status');
		}

		/* E-mail */
		if (isset($this->requets->post['akatus_email'])){
			$this->data['akatus_email'] = $this->request->post['akatus_email'];
		}else{
			$this->data['akatus_email'] = $this->config->get('akatus_email');
		}

		/* Api Key */
		if (isset($this->request->post['akatus_apiKey'])){
			$this->data['akatus_apiKey'] = $this->request->post['akatus_apiKey'];
		}else{
			$this->data['akatus_apiKey'] = $this->config->get('akatus_apiKey');
		}

		/* Api Nip */
		if (isset($this->request->post['akatus_apiNip'])){
			$this->data['akatus_apiNip'] = $this->request->post['akatus_apiNip'];
		}else{
			$this->data['akatus_apiNip'] = $this->config->get('akatus_apiNip');
		}

		/* Notificação */
		if (isset($this->request->post['akatus_notify'])){
			$this->data['akatus_notify'] = $this->request->post['akatus_notify'];
		}else{
			$this->data['akatus_notify'] = $this->config->get('akatus_notify');
		}
		
		/* Pular Etapa 5 */
		if (isset($this->request->post['akatus_activeStepFive'])){
			$this->data['akatus_activeStepFive'] = $this->request->post['akatus_activeStepFive'];
		}else{
			$this->data['akatus_activeStepFive'] = $this->config->get('akatus_activeStepFive');
		}
		
		/* Valor total das parcelas */
		if (isset($this->request->post['akatus_valorTotalParcela'])){
			$this->data['akatus_valorTotalParcela'] = $this->request->post['akatus_valorTotalParcela'];
		}else{
			$this->data['akatus_valorTotalParcela'] = $this->config->get('akatus_valorTotalParcela');
		}

		/* Status Aguardando Pagamento */
		if (isset($this->request->post['akatus_status_pending'])){
			$this->data['akatus_status_pending'] = $this->request->post['akatus_status_pending'];
		}else{
			$this->data['akatus_status_pending'] = $this->config->get('akatus_status_pending');
		}

		/* Status Completo */
		if (isset($this->request->post['akatus_status_complete'])){
			$this->data['akatus_status_complete'] = $this->request->post['akatus_status_complete'];
		}else{
			$this->data['akatus_status_complete'] = $this->config->get('akatus_status_complete');
		}

		/* Status Cancelado */
		if (isset($this->request->post['akatus_status_canceled'])){
			$this->data['akatus_status_canceled'] = $this->request->post['akatus_status_canceled'];
		}else{
			$this->data['akatus_status_canceled'] = $this->config->get('akatus_status_canceled');
		}

		/* Status Em Análise */
		if (isset($this->request->post['akatus_status_analysing'])){
			$this->data['akatus_status_analysing'] = $this->request->post['akatus_status_analysing'];
		}else{
			$this->data['akatus_status_analysing'] = $this->config->get('akatus_status_analysing');
		}

		/* Área */
		if (isset($this->request->post['akatus_area'])){
			$this->data['akatus_area'] = $this->request->post['akatus_area'];
		}else{
			$this->data['akatus_area'] = $this->config->get('akatus_area');
		}

		/* Ordem */
		if (isset($this->reqeuest->post['akatus_order'])){
			$this->data['akatus_order'] = $this->request->post['akatus_order'];
		}else{
			$this->data['akatus_order'] = $this->config->get('akatus_order');
		}

		/* Parcelas */
		if (isset($this->request->post['akatus_parcelas'])){
			$this->data['akatus_parcelas'] = serialize($this->request->post['akatus_parcelas']);
		}else{
			$this->data['akatus_parcelas'] = $this->config->get('akatus_parcelas');
		}

		/* Aceita Cartão de Crédito */
		if (isset($this->request->post['akatus_accCartao'])) {
			$this->data['akatus_accCartao'] = $this->request->post['akatus_accCartao'];
		} else {
			$this->data['akatus_accCartao'] = $this->config->get('akatus_accCartao');
		}
		
		/* Aceita Cartão Débito */
		if (isset($this->request->post['akatus_accDebito'])) {
			$this->data['akatus_accDebito'] = $this->request->post['akatus_accDebito'];
		} else {
			$this->data['akatus_accDebito'] = $this->config->get('akatus_accDebito');
		}

		/* Aceita Boleto */
		if (isset($this->request->post['akatus_accBoleto'])) {
			$this->data['akatus_accBoleto'] = $this->request->post['akatus_accBoleto'];
		} else {
			$this->data['akatus_accBoleto'] = $this->config->get('akatus_accBoleto');
		}
		
		/* Desconto Cartão de Crédito */
		if (isset($this->request->post['akatus_descontoCartao'])){
			$this->data['akatus_descontoCartao'] = $this->request->post['akatus_descontoCartao'];
		}else{
			$this->data['akatus_descontoCartao'] = $this->config->get('akatus_descontoCartao');
		}
		
		/* Desconto Débito */
		if (isset($this->request->post['akatus_descontoDebito'])){
			$this->data['akatus_descontoDebito'] = $this->request->post['akatus_descontoDebito'];
		}else{
			$this->data['akatus_descontoDebito'] = $this->config->get('akatus_descontoDebito');
		}
		
		/* Desconto Boleto */
		if (isset($this->request->post['akatus_descontoBoleto'])){
			$this->data['akatus_descontoBoleto'] = $this->request->post['akatus_descontoBoleto'];
		}else{
			$this->data['akatus_descontoBoleto'] = $this->config->get('akatus_descontoBoleto');
		}

		/* Ação action */
		$this->data['action'] = $this->url->link('payment/akatus', 'token=' . $this->session->data['token']);
		$this->data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token']);

		/* Breadcrumbs */
		$this->data['breadcrumbs'] = array();
		$this->data['breadcrumbs'][] = array(
			'text' => 'Home',
			'href' => $this->url->link('common/home'),
			'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
			'text' => 'Formas de Pagamento',
			'href' => $this->url->link('extension/payment'),
			'separator' => ' :: '
		);

		$this->data['breadcrumbs'][] = array(
			'text' => 'Akatus',
			'href' => $this->url->link('payment/akatus'),
			'separator' => ' :: '
		);

		/* Captura quais layouts serão carregados */
        $this->id       = 'content';
        $this->template = 'payment/akatus.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );
		
		/* Carrega Layout */
        $this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));

	}


	public function validate(){

		$this->load->model('payment/akatus');

		if (!$this->user->hasPermission('modify', 'payment/akatus')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
		
		if ($this->request->post['akatus_activeStepFive'] == 1){
			if (file_exists('../vqmod/xml/pular_etapa5_akatus')){
				rename('../vqmod/xml/pular_etapa5_akatus', '../vqmod/xml/pular_etapa5_akatus.xml');
			}
		}else{
			if (file_exists('../vqmod/xml/pular_etapa5_akatus.xml')){
				rename('../vqmod/xml/pular_etapa5_akatus.xml', '../vqmod/xml/pular_etapa5_akatus');
			}
		}

        $this->load->model_payment_akatus->verifyCrypt();

        if (!$this->error) {
            return TRUE;
        } else {
            return FALSE;
        }
	}

} ?>