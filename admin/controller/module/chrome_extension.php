<?php
Class ControllerModuleChromeExtension extends Controller
{
	private $error = array();

	public function index()
	{
		/* Load Language */
		$data = $this->load->language('module/chrome_extension');
		
		/* Set <title></title> */
		$this->document->setTitle($this->language->get('heading_title'));

		/* Saves the information */
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()){
			$this->load->model('setting/setting');
			
			$this->model_setting_setting->editSetting('chrome_extension', $this->request->post);
			
			$this->session->data['success'] = $this->language->get('success');
			
			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		/* Error Permission */
		if (isset($this->error['warning']))
			$data['error_status'] = $this->error['warning'];
		
		/* Error Status */
		if (isset($this->error['error_status']))
			$data['warning'] = $this->error['error_status'];
		
		/* Error Token */
		if (isset($this->error['error_token']))
			$data['error_token'] = $this->error['error_token'];
		
		/* Error Key */
		if (isset($this->error['error_key']))
			$data['error_key'] = $this->error['error_key'];
		
		/* Links */
		$data['action'] = $this->url->link('module/chrome_extension', 'token=' . $this->session->data['token']);
		$data['cancel'] = $this->url->link('module/chrome_extension', 'token=' . $this->session->data['token']);
		$data['url_order_update'] = $this->url->link('sale/order/info', 'token=%s&order_id=%d', 'SSL');
		
		/* Status */
		if (isset($this->request->post['chrome_extension_status']))
			$data['status'] = $this->request->post['chrome_extension_status'];
		else
			$data['status'] = $this->config->get('chrome_extension_status');
		
		/* Status */
		if (isset($this->request->post['chrome_extension_token']))
			$data['token'] = $this->request->post['chrome_extension_token'];
		else
			$data['token'] = $this->config->get('chrome_extension_token');
		
		/* Status */
		if (isset($this->request->post['chrome_extension_key']))
			$data['key'] = $this->request->post['chrome_extension_key'];
		else
			$data['key'] = $this->config->get('chrome_extension_key');
		
		/* Language */
		if (isset($this->request->post['chrome_extension_language_id']))
			$data['language_id'] = $this->request->post['chrome_extension_language_id'];
		else
			$data['language_id'] = $this->config->get('chrome_extension_language_id');
			
		/* Range Checking */
		if (isset($this->request->post['chrome_extension_range_checking']))
			$data['range_checking'] = $this->request->post['chrome_extension_range_checking'];
		else
			$data['range_checking'] = $this->config->get('chrome_extension_range_checking');
			
		/* Quantity Per Page */
		if (isset($this->request->post['chrome_extension_quantity_per_page']))
			$data['quantity_per_page'] = $this->request->post['chrome_extension_quantity_per_page'];
		else
			$data['quantity_per_page'] = $this->config->get('chrome_extension_quantity_per_page');
			
		/* Alert Sound */
		if (isset($this->request->post['chrome_extension_alert_sound']))
			$data['alert_sound'] = $this->request->post['chrome_extension_alert_sound'];
		else
			$data['alert_sound'] = $this->config->get('chrome_extension_alert_sound');
			
		/* Admin */
		if (isset($this->request->post['chrome_extension_admin']))
			$data['admin'] = $this->request->post['chrome_extension_admin'];
		else
			$data['admin'] = $this->config->get('chrome_extension_admin');
			
		/* Password */
		if (isset($this->request->post['chrome_extension_password']))
			$data['password'] = $this->request->post['chrome_extension_password'];
		else
			$data['password'] = $this->config->get('chrome_extension_password');
		
		
		/* Load All Languages */
		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();
		
		
		/* Template */
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('module/chrome_extension.tpl', $data));
	}
	
	public function validate()
	{
		if (!$this->user->hasPermission('modify', 'module/chrome_extension'))
			$this->error['warning'] = $this->language->get('permission');
		
		if (empty($this->request->post['chrome_extension_token']) || strlen($this->request->post['chrome_extension_token']) < 256)
			$this->error['error_token'] = $this->language->get('required');
		
		if (empty($this->request->post['chrome_extension_key']) || strlen($this->request->post['chrome_extension_key']) < 256)
			$this->error['error_key'] = strlen($this->request->post['chrome_extension_key']) < 256;
		
		return !$this->error;
	}
}