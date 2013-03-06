<?php
/**
 * MIT License
 * ===========
 *
 * Copyright (c) 2013 Valdeir <valdeirpsr@hotmail.com.br>
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be included
 * in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
 * CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 * @author     Valdeir <valdeirpsr@hotmail.com.br>
 * @copyright  2013 Valdeir.
 * @version    [ 1.0 ]
 * @link       http://www.valdeirsantana.com.br
 */
class ControllerTotalGift extends Controller {
	
	private $error = array(); 

	public function index(){

		/* Carrega a linguagem */
		$this->load->language('total/gift');

		/* Define o <title></title> da página */
		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model("setting/setting");

		/* Salva as informações */
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('gift', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->redirect($this->url->link('extension/total', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->data['heading_title'] = $this->language->get('heading_title');

		/* Entry */
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_price'] = $this->language->get('entry_price');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['entry_maxProduct'] = $this->language->get('entry_maxProduct');
		$this->data['entry_enabled'] = $this->language->get('entry_enabled');
		$this->data['entry_disabled'] = $this->language->get('entry_disabled');
		
		/* Help */
		$this->data['help_maxProduct'] = $this->language->get('help_maxProduct');
		
		/* Buttons */
		$this->data['btn_save'] = $this->language->get('btn_save');
		$this->data['btn_cancel'] = $this->language->get('btn_cancel');

		/* Botões */
		$this->data['action'] = $this->url->link('total/gift', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['cancel'] = $this->url->link('extension/total', 'token=' . $this->session->data['token'], 'SSL');

		/* Status */
		if (isset($this->request->post['gift_status'])){
			$this->data['gift_status'] = $this->request->post['gift_status'];
		}else{
			$this->data['gift_status'] = $this->config->get('gift_status');
		}

		/* Price */
		if (isset($this->request->post['gift_price'])){
			$this->data['gift_price'] = $this->request->post['gift_price'];
		}else{
			$this->data['gift_price'] = $this->config->get('gift_price');
		}

		/* Max Product */
		if (isset($this->request->post['gift_maxProduct'])){
			$this->data['gift_maxProduct'] = $this->request->post['gift_maxProduct'];
		}else{
			$this->data['gift_maxProduct'] = $this->config->get('gift_maxProduct');
		}

		/* Sort Order */
		if (isset($this->request->post['gift_sort_order'])){
			$this->data['gift_sort_order'] = $this->request->post['gift_sort_order'];
		}else{
			$this->data['gift_sort_order'] = $this->config->get('gift_sort_order');
		}

		/* Erro */
		if (isset($this->error['warning'])){
			$this->data['error_warning'] = $this->error['warning'];
		}else{
			$this->data['error_warning'] = '';
		}

		/* Breamcrumbs */
		$this->data['breamcrumbs'] = array();

		$this->data['breamcrumbs'][] = array(
			'name' => 'Home',
			'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$this->data['breamcrumbs'][] = array(
			'name' => 'Modules',
			'href' => $this->url->link('extension/total', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);

		$this->data['breamcrumbs'][] = array(
			'name' => 'Gift',
			'href' => $this->url->link('total/gift', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);

		$this->template = 'total/gift.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		$this->response->setOutput($this->render());

	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'total/gift')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}

}