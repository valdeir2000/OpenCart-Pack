<?php

    /*
     * class Controller_Letmeknow
     */
    
    class ControllerModuleLetmeknow extends Controller {
        
    	protected $error;

        public function index(){
            /* Linguagem */
            $this->language->load('module/letmeknow');
            $this->document->setTitle($this->language->get('heading'));
            $this->data['heading'] = $this->language->get('heading');
            
            //Text
            $this->data['text_status'] = $this->language->get('text_status');
            $this->data['text_enabled'] = $this->language->get('text_enabled');
            $this->data['text_disabled'] = $this->language->get('text_disabled');
            $this->data['text_title'] = $this->language->get('text_title');
            $this->data['text_subject'] = $this->language->get('text_subject');
            $this->data['text_message'] = $this->language->get('text_message');
            
            //Entry
            $this->data['entry_customerName'] = $this->language->get('entry_customerName');
            $this->data['entry_productName'] = $this->language->get('entry_productName');
            $this->data['entry_productModel'] = $this->language->get('entry_productModel');
            $this->data['entry_productSKU'] = $this->language->get('entry_productSKU');
            $this->data['entry_productQuantity'] = $this->language->get('entry_productQuantity');
            $this->data['entry_productLink'] = $this->language->get('entry_productLink');
            
            //Buttons
            $this->data['btn_save'] = $this->language->get('btn_save');
            $this->data['btn_cancel'] = $this->language->get('btn_cancel');

            //Help
            $this->data['help_greeting'] = $this->language->get('help_greeting');
            /* /Linguagem */

            /* Links */
            $this->data['action_form'] 	 = $this->url->link('module/letmeknow', 'token=' . $this->session->data['token'], 'SSL');
            $this->data['action_cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

            /* Captura o token */
            $this->data['token'] = $this->session->data['token'];

            $this->load->model('setting/setting');

            if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate($this->request->post)){
            	$this->model_setting_setting->editSetting('letmeknow', $this->request->post);

            	$this->session->data['success'] = $this->language->get('text_success');

            	$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
            }

            /* Erro */
            $this->data['error_warning'] = $this->error_warning;

            /* Breadcrumbs */
            $this->data['breadcrumbs'] = array();

            $this->data['breadcrumbs'][] = array(
            	'name' => $this->language->get('text_home'),
            	'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            	'separator' => false
            );

            $this->data['breadcrumbs'][] = array(
            	'name' => $this->language->get('text_module'),
            	'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
            	'separator' => ' :: '
            );

            $this->data['breadcrumbs'][] = array(
            	'name' => $this->language->get('heading'),
            	'href' => $this->url->link('module/letmeknow', 'token=' . $this->session->data['token'], 'SSL'),
            	'separator' => ' :: '
            );
            /* /Breadcrumbs */

            /* Status */
            if (isset($this->request->post['letmeknow_status'])){
            	$this->data['letmeknow_status'] = $this->request->post['letmeknow_status'];
            }else{
            	$this->data['letmeknow_status'] = $this->config->get('letmeknow_status');
            }

            /* Title */
            if (isset($this->request->post['letmeknow_title'])){
            	$this->data['letmeknow_title'] = $this->request->post['letmeknow_title'];
            }else{
            	$this->data['letmeknow_title'] = $this->config->get('letmeknow_title');
            }

            /* Subject */
            if (isset($this->request->post['letmeknow_subject'])){
            	$this->data['letmeknow_subject'] = $this->request->post['letmeknow_subject'];
            }else{
            	$this->data['letmeknow_subject'] = $this->config->get('letmeknow_subject');
            }

            /* Message */
            if (isset($this->request->post['letmeknow_message'])){
            	$this->data['letmeknow_message'] = $this->request->post['letmeknow_message'];
            }else{
            	$this->data['letmeknow_message'] = $this->config->get('letmeknow_message');
            }

            /* Template */
            $this->template = 'module/letmeknow.tpl';
            $this->children = array(
            	'common/header',
            	'common/footer'
            );
            $this->response->setOutput($this->render());
            /* /Template */
            
        }

        public function validate(){
        	if (!$this->user->hasPermission('modify', 'module/welcome')) {
				$this->error['warning'] = $this->language->get('error_permission');
			}
			
			if (!$this->error) {
				return true;
			} else {
				return false;
			}
        }
        
    }
    