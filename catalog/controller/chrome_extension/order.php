<?php
Class ControllerChromeExtensionOrder extends Controller
{
	/* Checks last orders not displayed */
	public function index()
	{
		$data = array();
		$orders = array();
	
		/* Load Model */
		$this->load->model('chrome_extension/order');
		
		/* Verify Token and Key */
		$this->verifyAccess($this->request->get['token'], $this->request->get['key']);

		/* Verify last id */
		if(!$this->config->get('chrome_extension_last_order')){
			$orders = $this->model_chrome_extension_order->getOrders();
		}else{			
			$orders = $this->model_chrome_extension_order->getOrders(array(
				'filter_last_id' => $this->config->get('chrome_extension_last_order'),
				'limit' => 6
			));
		}
		
		/* Create JSON */
		foreach($orders as $order){
			$data['orders'][] = array(
				'order_id' => $order['order_id'],
				'customer' => $order['customer'],
				'message' => 'You have a new order.\nOrder #' . str_pad($order['order_id'], 5, 0, STR_PAD_LEFT) . ' - ' . $order['customer'],
				'order_update' => $this->url->link('chrome_extension/order/update', 'token=' . $this->config->get('chrome_extension_token') . '&key=' . $this->config->get('chrome_extension_key') . '&order_id=' . $order['order_id'])
			);
		}
		
		/* Update Last ID and Capture total order not displayed */
		if (!empty($orders)){
			$this->model_chrome_extension_order->updateLastOrderId($orders[0]['order_id']);
			$data['total_order'] = $this->model_chrome_extension_order->getTotalOrderNotDisplay($this->config->get('chrome_extension_last_order'));
		}else{
			$data['total_order'] = 0;
		}
		
		/* Show data */
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($data));
	}
	
	/* Capture Orders */
	public function order_list()
	{
		$data = array();
		$filter = array();
		$data['orders'] = array();
		
		/* Verify Token and Key */
		$this->verifyAccess($this->request->get['token'], $this->request->get['key']);
		
		/* Filter Order Id */
		if (isset($this->request->post['filter_order_id']))
			$filter['filter_order_id'] = $this->request->post['filter_order_id'];
		
		/* Filter Customer */
		if (isset($this->request->post['filter_customer']))
			$filter['filter_customer']  = $this->request->post['filter_customer'];
		
		/* Filter Status */
		if (isset($this->request->post['filter_status']))
			$filter['filter_order_status']  = $this->request->post['filter_status'];
		
		/* Filter Total */
		if (isset($this->request->post['filter_total']))
			$filter['filter_total']  = $this->request->post['filter_total'];
		
		/* Filter Date Added */
		if (isset($this->request->post['filter_date_added']))
			$filter['filter_date_added']  = $this->request->post['filter_date_added'];
		
		/* Filter Store */
		if (isset($this->request->post['filter_store']))
			$filter['filter_store']  = $this->request->post['filter_store'];
			
		/* Filter Page */
		if (isset($this->request->post['page']))
			$filter['start'] = ($this->request->post['page'] - 1) * 2;
		else
			$filter['start'] = 0;
			
		/* Page */
		if (isset($this->request->post['page']))
			$page = $this->request->post['page'];
		else
			$page = 1;
			
			
		/* Load Model */
		$this->load->model('chrome_extension/order');
		
		/* Get All Orders */
		$orders = $this->model_chrome_extension_order->getOrders($filter);
		
		/* Format values */
		foreach($orders as $order){
			$data['orders'][] = array(
				'order_id' => $order['order_id'],
				'customer' => $order['customer'],
				'email' => $order['email'],
				'status' => $order['status'],
				'total' => $this->currency->format($order['total'], $order['currency_code']),
				'store' => $order['store_name'],
				'date_added' => date($this->language->get('date_format_short'), strtotime($order['date_added'])),
				'order_update' => $this->url->link('chrome_extension/order/update', 'token=' . $this->config->get('chrome_extension_token') . '&key=' . $this->config->get('chrome_extension_key') . '&order_id=' . $order['order_id'])
			);
		}
		
		$total_orders = $this->model_chrome_extension_order->getTotalOrders();
		
		/* Pagination */
		$pagination = new Pagination;
		$pagination->total = $total_orders;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('chrome_extension_quantity_per_page');
		$pagination->url = '#';
		$pagination->text_prev = '«';
		$pagination->text_next = '»';
		$data['pagination'] = $pagination->render();
		
		/* Template */
		$this->response->setOutput($this->load->view('default/template/chrome_extension/order_list.tpl', $data));
	}
	
	/* Captures information from an order */
	public function order_info()
	{
		$data = array();
		
		/* Verify Token and Key */
		$this->verifyAccess($this->request->get['token'], $this->request->get['key']);
		
		/* Checks the id of purchase and capture only the numbers */
		if (isset($this->request->post['order_id']))
			$order_id = preg_replace('/[^0-9]/', '', $this->request->post['order_id']);
		else
			$order_id = 1;
		
		
		$this->load->model('chrome_extension/order');
		$this->load->model('chrome_extension/order_status');
		
		/* Capture the data of Purchase */
		$order_info = $this->model_chrome_extension_order->getOrder($order_id);
		
		/* Information Order */
		$data['order_id'] = $order_id;
		$data['invoice_prefix'] = $order_info['invoice_prefix'];
		
		/* Information Store */
		$data['store_name'] = $order_info['store_name'];
		$data['store_url'] = $order_info['store_url'];
		
		/* Information Customer */
		$data['customer_name'] = $order_info['firstname'] . ' ' . $order_info['lastname'];
		$data['customer_link'] = $this->url->link('sale/customer/update', '&customer_id=' . $order_info['customer_id']);		
		$data['email'] = $order_info['email'];		
		$data['telephone'] = $order_info['telephone'];
		
		/* Capture the total values */
		$data['total'] = $this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value']);
		
		/* Status */
		$data['order_status'] = $this->model_chrome_extension_order->getOrderStatus($order_info['order_status_id']);
		
		/* Date */
		$data['date_added'] = $order_info['date_added'];
		$data['date_modified'] = $order_info['date_modified'];
		
		/* Payment Information */
		$data['payment_firstname'] = $order_info['payment_firstname'];
		$data['payment_lastname'] = $order_info['payment_lastname'];
		$data['payment_address_1'] = $order_info['payment_address_1'];
		$data['payment_address_2'] = $order_info['payment_address_2'];
		$data['payment_city'] = $order_info['payment_city'];
		$data['payment_postcode'] = $order_info['payment_postcode'];
		$data['payment_zone'] = $order_info['payment_zone'];
		$data['payment_country'] = $order_info['payment_country'];
		$data['payment_method'] = $order_info['payment_method'];
		
		/* Shipping Information */
		$data['shipping_firstname'] = $order_info['shipping_firstname'];
		$data['shipping_lastname'] = $order_info['shipping_lastname'];
		$data['shipping_address_1'] = $order_info['shipping_address_1'];
		$data['shipping_address_2'] = $order_info['shipping_address_2'];
		$data['shipping_city'] = $order_info['shipping_city'];
		$data['shipping_postcode'] = $order_info['shipping_postcode'];
		$data['shipping_zone'] = $order_info['shipping_zone'];
		$data['shipping_country'] = $order_info['shipping_country'];
		$data['shipping_method'] = $order_info['shipping_method'];
		
		/* Capture products purchased */
		$products = $this->model_chrome_extension_order->getOrderProducts($order_id);
		
		$data['products'] = array();
		
		/* Format the information */
		foreach($products as $product){
			$data['products'][] = array(
				'product_id' => $product['product_id'],
				'name' => $product['name'],
				'model' => $product['model'],
				'quantity' => $product['quantity'],
				'price' => $this->currency->format($product['price'], $order_info['currency_code'], $order_info['currency_value']),
				'total' => $this->currency->format($product['total'], $order_info['currency_code'], $order_info['currency_value']),
				'link' => $this->url->link('product/product&product_id=' . $product['product_id']),
				'options' => $this->model_chrome_extension_order->getOrderProductOptions($order_id, $product['order_product_id'])
			);
		}
		
		/* Capture the total values */
		$totals = $this->model_chrome_extension_order->getOrderTotals($order_id);
		
		foreach($totals as $total){
			$data['totals'][] = array(
				'title' => $total['title'],
				'value' => $this->currency->format($total['value'], $order_info['currency_code'], $order_info['currency_value'])
			);
		}
		
		/* Capture the purchase history */
		$data['history'] = $this->history($order_id, true);
		
		/* Capture Status */
		$statuses = $this->model_chrome_extension_order_status->getOrderStatuses();
		
		$data['statuses'] = array();
		
		foreach($statuses as $status){
			$data['statuses'][] = array(
				'status_id' => $status['order_status_id'],
				'name' => $status['name']
			);
		}
		
		/* Custom Field */
		$this->load->model('account/custom_field');
		
		/* Payment Custom Field */
		$data['payment_custom_field'] = array();
		
		foreach($order_info['payment_custom_field'] as $key => $value) {
			$custom_field = $this->model_account_custom_field->getCustomField($key);
			$data['payment_custom_field'][] = array(
				'name' => $custom_field['name'],
				'value' => $value,
				'sort_order' => $custom_field['sort_order']
			);
		}
		unset($custom_field);
		
		/* Shipping Custom Field */
		$data['shipping_custom_field'] = array();
		
		foreach($order_info['shipping_custom_field'] as $key => $value) {
			$custom_field = $this->model_account_custom_field->getCustomField($key);
			$data['shipping_custom_field'][] = array(
				'name' => $custom_field['name'],
				'value' => $value,
				'sort_order' => $custom_field['sort_order']
			);
		}
		unset($custom_field);
		
		/* Template */
		$this->response->setOutput($this->load->view('default/template/chrome_extension/order_info.tpl', $data));
	}
	
	/* Captures the history of a order */
	public function history($order_id = '', $return = false)
	{
		
		/* Checks the id of purchase and capture only the numbers */
		if (isset($this->request->post['order_id']))
			$order_id = preg_replace('/[^0-9]/', '', $this->request->post['order_id']);
		else
			$order_id = 1;
			
		/* Checks the number of page */
		if (isset($this->request->post['page']))
			$page = ($this->request->post['page'] - 1) * 2;
		else
			$page = 0;
		
		/* Verify Token and Key */
		$this->verifyAccess($this->request->get['token'], $this->request->get['key']);
		
		$this->load->model('chrome_extension/order');
		
		/* Captures the history */
		$histories = $this->model_chrome_extension_order->getOrderHistories($order_id, $page);
		
		$data['histories'] = array();
		
		/* Format the information */
		foreach($histories as $hitory){
			$data['histories'][] = array(
				'date_added' => $hitory['date_added'],
				'status' => $hitory['status'],
				'comment' => $hitory['comment'],
				'notify' => ($hitory['notify']) ? $this->language->get('text_yes') : $this->language->get('text_no'),
			);
		}
		
		/* Captures the total amount of message */
		$histories_total = $this->model_chrome_extension_order->getTotalOrderHistories($order_id);
		
		/* Pagination */
		$pagination = new Pagination;
		$pagination->total = $histories_total;
		$pagination->page = $page;
		$pagination->limit = 2;
		$pagination->url = '#';
		$pagination->num_links = 5;
		$pagination->text_prev = '«';
		$pagination->text_next = '»';
		$data['pagination'] = $pagination->render();
		
		/* Template */
		if ($return)
			return $this->load->view('default/template/chrome_extension/order_history.tpl', $data);
		else
			$this->response->setOutput($this->load->view('default/template/chrome_extension/order_history.tpl', $data));
	}
	
	/* Add a comment to the history of a order */
	public function order_add_history()
	{
		/* Verify Token and Key */
		$this->verifyAccess($this->request->get['token'], $this->request->get['key']);
		
		/* Load Modal */
		$this->load->model('chrome_extension/order');
		
		$order_id = (int)$this->request->post['order_id'];
		
		$order_status_id = (int)$this->request->post['order_status_id'];
		
		$notify = isset($this->request->post['notify']) ? true : false;
		
		$comment = addslashes($this->request->post['comment']);
		
		/* Add History */
		$this->model_chrome_extension_order->addOrderHistory($order_id, $order_status_id, $notify, $comment);
	}	
	
	/* Invoice */
	public function order_invoice()
	{
		/* Load Language */
		$data = $this->load->language('chrome_extension/order_invoice');
		
		/* Verify Token and Key */
		$this->verifyAccess($this->request->get['token'], $this->request->get['key']);
		
		$order_id = (int)$this->request->post['order_id'];
		
		/* Load Models */
		$this->load->model('chrome_extension/order');
		$this->load->model('setting/setting');
		
		/* Capture order information */
		$order_info = $this->model_chrome_extension_order->getOrder($order_id);
		
		/* Captures information Store */
		$store_info = $this->model_chrome_extension_order->getStore($order_info['store_id']);
		
		/* Information Store */
		$data['store_name'] = $store_info['name'];
		$data['store_logo'] = $this->config->get('config_ssl') . 'image/' . $this->config->get('config_logo');
		$data['store_address'] = nl2br($store_info['address']);
		$data['store_url'] = $store_info['link'];
		
		/* Information Order */
		$data['invoice'] = '#' . str_pad($order_info['order_id'], 6, 0, STR_PAD_LEFT);
		$data['date_added'] = date($this->language->get('date_format_short'), strtotime($order_info['date_added']));
		
		/* Customer Contact */
		$data['email'] = $order_info['email'];
		$data['telephone'] = $order_info['telephone'];
		
		/* Information Payment */
		$data['payment_firstname'] = $order_info['payment_firstname'];
		$data['payment_lastname'] = $order_info['payment_lastname'];
		$data['payment_address_1'] = $order_info['payment_address_1'];
		$data['payment_address_2'] = $order_info['payment_address_2'];
		$data['payment_postcode'] = $order_info['payment_postcode'];
		$data['payment_city'] = $order_info['payment_city'];
		$data['payment_zone'] = $order_info['payment_zone'];
		$data['payment_country'] = $order_info['payment_country'];
		$data['payment_method'] = $order_info['payment_method'];
		
		/* Information Shipping */
		$data['shipping_firstname'] = $order_info['shipping_firstname'];
		$data['shipping_lastname'] = $order_info['shipping_lastname'];
		$data['shipping_address_1'] = $order_info['shipping_address_1'];
		$data['shipping_address_2'] = $order_info['shipping_address_2'];
		$data['shipping_postcode'] = $order_info['shipping_postcode'];
		$data['shipping_city'] = $order_info['shipping_city'];
		$data['shipping_zone'] = $order_info['shipping_zone'];
		$data['shipping_country'] = $order_info['shipping_country'];
		$data['shipping_method'] = $order_info['shipping_method'];
		
		/* Capture products purchased */
		$products = $this->model_chrome_extension_order->getOrderProducts($order_id);
		
		/* Format the informations */
		foreach($products as $product){
			$data['products'][] = array(
				'name' => $product['name'],
				'model' => $product['model'],
				'quantity' => (int)$product['quantity'],
				'price' => $this->currency->format($product['price'], $order_info['currency_code'], $order_info['currency_value']),
				'total' => $this->currency->format($product['total'], $order_info['currency_code'], $order_info['currency_value']),
			);
		}
		
		/* Capture the total values */
		$totals = $this->model_chrome_extension_order->getOrderTotals($order_id);
		
		/* Format the informations */
		foreach($totals as $total){
			$data['totals'][] = array(
				'title' => $total['title'],
				'value' => $this->currency->format($total['value'], $order_info['currency_code'], $order_info['currency_value']),
			);
		}
		
		/* Captures comment */
		$data['comment'] = html_entity_decode(nl2br($order_info['comment']));
		
		$this->response->setOutput($this->load->view('default/template/chrome_extension/order_invoice.tpl', $data));
	}
	
	/* Download Invoice */
	public function invoice_download()
	{
		/* Capture file format */
		$format = isset($this->request->get['format']) ? $this->request->get['format'] : 'pdf';
		
		/* Checks the id of purchase and capture only the numbers */
		$order_id = isset($this->request->get['order_id']) ? preg_replace('/[^0-9]/', '', $this->request->get['order_id']) : 1;
		
		/* Verify Token and Key */
		$this->verifyAccess($this->request->get['token'], $this->request->get['key']);
		
		/* Load Model */
		$this->load->model('chrome_extension/order');
		
		/* Capture purchase information */
		$order_info = $this->model_chrome_extension_order->getOrder($order_id);
		
		/* Captures information store */
		$store_info = $this->model_chrome_extension_order->getStore($order_info['store_id']);
		
		$data = array();
		
		/* Purchase Information */
		$data['invoice'] = str_pad($order_info['order_id'], 6, 0, STR_PAD_LEFT);
		$data['date_added'] = date($this->language->get('date_format_short'), strtotime($order_info['date_added']));
		
		/* Information Store */
		$data['store_name'] = $store_info['name'];
		$data['store_address'] = nl2br($store_info['address']);
		
		/* Payment Information */
		$data['payment_firstname'] = $order_info['payment_firstname'];
		$data['payment_lastname'] = $order_info['payment_lastname'];
		$data['payment_address_1'] = $order_info['payment_address_1'];
		$data['payment_address_2'] = $order_info['payment_address_2'];
		$data['payment_city'] = $order_info['payment_city'];
		$data['payment_zone'] = $order_info['payment_zone_code'];
		$data['payment_country'] = $order_info['payment_country'];
		$data['payment_postcode'] = $order_info['payment_postcode'];
		
		/* Shipping Information */
		$data['shipping_firstname'] = $order_info['shipping_firstname'];
		$data['shipping_lastname'] = $order_info['shipping_lastname'];
		$data['shipping_address_1'] = $order_info['shipping_address_1'];
		$data['shipping_address_2'] = $order_info['shipping_address_2'];
		$data['shipping_city'] = $order_info['shipping_city'];
		$data['shipping_zone'] = $order_info['shipping_zone_code'];
		$data['shipping_country'] = $order_info['shipping_country'];
		$data['shipping_postcode'] = $order_info['shipping_postcode'];
		
		/* Purchased Products */
		$products = $this->model_chrome_extension_order->getOrderProducts($order_id);
		
		/* Format the information */
		foreach($products as $product){
			$data['products'][] = array(
				'product_id' => $product['product_id'],
				'name' => $product['name'],
				'model' => $product['model'],
				'quantity' => $product['quantity'],
				'price' => $this->currency->format($product['price'], $order_info['currency_code'], $order_info['currency_value']),
				'total' => $this->currency->format($product['total'], $order_info['currency_code'], $order_info['currency_value']),
			);
		}
		
		/* Capture the total values */
		$totals = $this->model_chrome_extension_order->getOrderTotals($order_id);
		
		/* Format the information */
		foreach($totals as $total){
			$data['totals'][] = array(
				'code' => $total['code'],
				'title' => $total['title'],
				'value' => $this->currency->format($total['value'], $order_info['currency_code'], $order_info['currency_value']),
			);
		}
		
		/* Captures the order comment */
		$data['comment'] = nl2br($order_info['comment']);
		
		$this->invoice_download_pdf($data);
	}
	
	/* Download Invoice (PDF) */
	private function invoice_download_pdf($data = '')
	{	
		/* Get The HTML */
		header('Content-Type: application/pdf');
		
		ob_start();
		
		echo $this->load->view('default/template/chrome_extension/order_invoice_pdf.tpl', $data);
		
		$content = ob_get_contents();
		ob_get_clean();
		
		// convert in PDF
		$this->load->library('chrome_extension/html2pdf/html2pdf.class');
		
		$html2pdf = new HTML2PDF('P', 'A4', 'en', true, 'UTF-8', array(0, 0, 0, 0));
		$html2pdf->setDefaultFont('Arial');
		$html2pdf->writeHTML($content);
		$html2pdf->Output($data['store_name'] .  ' - Order #' . $data['invoice'] . '.pdf');
	}
	
	/* List of Store */
	public function store_list()
	{
		/* Verify Token and Key */
		$this->verifyAccess($this->request->get['token'], $this->request->get['key']);
		
		/* Load Model */
		$this->load->model('chrome_extension/order');
		
		/* Template */
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($this->model_chrome_extension_order->getStores()));
	}
	
	/* Captures information from a store */
	public function store_info()
	{
		$this->load->model('chrome_extension/order');
		
		$this->verifyAccess($this->request->get['token'], $this->request->get['key']);
		
		$store_id = isset($this->request->post['store_id']) ? (int)$this->request->post['store_id'] : 0;
		
		$data['store'] = $this->model_chrome_extension_order->getStore($store_id);
		
		$this->response->setOutput($this->load->view('default/template/chrome_extension/store_info.tpl', $data));
	}

	/* Captures configs from a store */
	public function get_configs()
	{
		/* Username */
		if (isset($this->request->post['username']))
			$username = $this->request->post['username'];
		else
			$username = '';
			
		/* Password */
		if (isset($this->request->post['password']))
			$username = $this->request->post['password'];
		else
			$username = '';
			
		
		if (
			($username != $this->config->get('chrome_extension_admin')) || 
			($username != $this->config->get('chrome_extension_password'))
		){
			exit('Your not permission.');
		}
		
		
		$data = array();
		
		$data['settingRangeChecking'] = $this->config->get('chrome_extension_range_checking');
		$data['settingQuantityPerPage'] = $this->config->get('chrome_extension_quantity_per_page');
		$data['settingAlertSound'] = $this->config->get('chrome_extension_alert_sound');
		$data['settingToken'] = $this->config->get('chrome_extension_token');
		$data['settingKey'] = $this->config->get('chrome_extension_key');
		$data['settingURL'] = $this->config->get('chrome_extension_url');
		$data['settingAdmin'] = $this->config->get('chrome_extension_admin');
		$data['settingPassword'] = $this->config->get('chrome_extension_password');
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($data));
	}
	
	/* Login OpenCart */
	public function update()
	{
		$token = isset($this->request->get['token']) ? $this->request->get['token'] : '';
		$key = isset($this->request->get['key']) ? $this->request->get['key'] : '';
		
		if ($this->verifyAccess($token, $key)) {
			/* Generate Token */
			$token = md5($token . $key);
			
			/* Define user id and token */
			$this->session->data['user_id'] = 1;
			$this->session->data['token'] = $token;
			
			/* Redirect */
			$this->response->redirect(sprintf($this->config->get('chrome_extension_url_order_update'), $token, $this->request->get['order_id']));
		}
	}
	
	/* Checks whether the user is allowed to access */
	protected function verifyAccess($token = '', $key = '')
	{
		if (
			(empty($token) || empty($key)) ||
			($this->config->get('chrome_extension_token') != $token ||
			$this->config->get('chrome_extension_key') != $key)
		){
			exit('You do not have permission');
		}else{
			return true;
		}
	}
}