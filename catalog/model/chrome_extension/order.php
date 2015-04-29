<?php
Class ModelChromeExtensionOrder extends Model
{

	public function getStore($store_id)
	{
		$result = $this->db->query('SELECT SUM(o.total) AS total_sales, COUNT(o.order_id) as total_orders, (SELECT COUNT(a.affiliate_id) FROM ' . DB_PREFIX . 'affiliate a) AS total_affiliates, (SELECT COUNT(aa.affiliate_id) FROM ' . DB_PREFIX . 'affiliate aa WHERE aa.status = 0) AS affiliates_awaiting_approval, (SELECT COUNT(cc.customer_id) FROM ' . DB_PREFIX . 'customer cc WHERE cc.status = 0) AS customers_awaiting_approval, (SELECT COUNT(c.customer_id) FROM ' . DB_PREFIX . 'customer c WHERE c.status > 0) AS total_customers, (SELECT COUNT(r.review_id) FROM ' . DB_PREFIX . 'review r WHERE r.status = 0) AS reviews_awaiting_approval, (SELECT SUM(oo.total) FROM ' . DB_PREFIX . 'order oo WHERE YEAR(date_added) = "' . DATE('Y') . '" AND oo.order_status_id > 0 AND oo.store_id = 0) AS total_sales_year FROM ' . DB_PREFIX . 'order o WHERE o.order_status_id > 0 AND o.store_id = 0');
		
		$stores = $this->getStores();
		
		return array(
			'store_id' => $store_id,
			'name' => $stores[$store_id]['name'],
			'address' => $stores[$store_id]['address'],
			'link' => $stores[$store_id]['url'],
			'total_sales' => $this->currency->format($result->row['total_sales']),
			'total_sales_year' => $this->currency->format($result->row['total_sales_year']),
			'total_orders' => $result->row['total_orders'],
			'total_customers' => $result->row['total_customers'],
			'customers_awaiting_approval' => $result->row['customers_awaiting_approval'],
			'reviews_awaiting_approval' => $result->row['reviews_awaiting_approval'],
			'total_affiliates' => $result->row['total_affiliates'],
			'affiliates_awaiting_approval' => $result->row['affiliates_awaiting_approval'],
		);
	}

	public function getStores()
	{	
		$this->cache->delete('chrome_extension_store');
		$store_data = $this->cache->get('chrome_extension_store');
		
		/* Other Store */
		if (!$store_data) {
			
			$this->load->model('setting/setting');
			$this->load->model('setting/store');
			
			$store_default = $this->model_setting_setting->getSetting('config', 0);
			
			/* Store Home */
			$store_data[] = array(
				'store_id' => 0,
				'name' => $store_default['config_meta_title'],
				'url' => HTTP_SERVER,
				'ssl' => HTTPS_SERVER,
				'logo' => $store_default['config_logo'],
				'address' => $store_default['config_address']
			);
			
			$stores = $this->model_setting_store->getStores();
			
			foreach($stores as $store){
				$data = $this->model_setting_setting->getSetting('config', $store['store_id']);
			
				/* Store */
				$store_data[] = array(
					'store_id' => $store['store_id'],
					'name' => $data['config_meta_title'],
					'url' => $data['config_url'],
					'ssl' => '',
					'logo' => $data['config_logo'],
					'address' => $data['config_address']
				);
			}
		}
		
		$this->cache->set('chrome_extension_store', $store_data);

		return $store_data;
	}

	public function getOrders($data = array())
	{

		/* Start SQL */
		$sql = "SELECT o.order_id, o.email, o.store_name, CONCAT(o.firstname, ' ', o.lastname) AS customer, (SELECT os.name FROM " . DB_PREFIX . "order_status os WHERE os.order_status_id = o.order_status_id AND os.language_id = '1') AS status, o.total, o.currency_code, o.currency_value, o.date_added, o.date_modified FROM `" . DB_PREFIX . "order` o";

		/* Filter Order Status */
		if (isset($data['filter_order_status']))
			$sql .= " WHERE o.order_status_id = " . (int)$data['filter_order_status'];
		else
			$sql .= " WHERE o.order_status_id > '0'";
			
		/* Filter Order ID */
		if (isset($data['filter_order_id']))
			$sql .= " AND o.order_id = '" . (int)$data['filter_order_id'] . "'";
		
		/* Filter Customer */
		if (isset($data['filter_customer']))
			$sql .= " AND CONCAT(o.firstname, ' ', o.lastname) LIKE '%" . $this->db->escape($data['filter_customer']) . "%'";
		
		/* Filter Date Added */
		if (isset($data['filter_date_added']))
			$sql .= " AND DATE(o.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";

		/* Filter Total */
		if (isset($data['filter_total']))
			$sql .= " AND o.total = '" . (float)$data['filter_total'] . "'";
		
		/* Filter Store */
		if (isset($data['filter_store']))
			$sql .= " AND o.store_id = '" . (int)$data['filter_store'] . "'";
		
		/* Filter Last ID */
		if (isset($data['filter_last_id']))
			$sql .= " AND o.order_id > '" . (int)$data['filter_last_id'] . "'";
		
		
		/* Sort */
		$sort_data = array(
			'o.order_id',
			'customer',
			'status',
			'o.date_added',
			'o.total'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data))
			$sql .= " ORDER BY " . $data['sort'];
		else
			$sql .= " ORDER BY o.order_id";

		if (isset($data['order']) && ($data['order'] == 'ASC'))
			$sql .= " ASC";
		else
			$sql .= " DESC";


		/* Limit */
		if ((!isset($data['start'])) || $data['start'] < 0)
			$data['start'] = 0;

		if (!isset($data['limit']))
			$data['limit'] = $this->config->get('chrome_extension_quantity_per_page');
		
		
		/* End SQL */
		$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		
		/* Execute SQL */
		$query = $this->db->query($sql);

		return $query->rows;
	}
	
	public function getTotalOrders($data = array())
	{
		/* Start SQL */
		$sql = "SELECT count(o.order_id) AS total FROM `" . DB_PREFIX . "order` o";

		/* Filter Order Status */
		if (isset($data['filter_order_status']))
			$sql .= " WHERE o.order_status_id = " . (int)$data['filter_order_status'];
		else
			$sql .= " WHERE o.order_status_id > '0'";
			
		/* Filter Order ID */
		if (isset($data['filter_order_id']))
			$sql .= " AND o.order_id = '" . (int)$data['filter_order_id'] . "'";
		
		/* Filter Customer */
		if (isset($data['filter_customer']))
			$sql .= " AND CONCAT(o.firstname, ' ', o.lastname) LIKE '%" . $this->db->escape($data['filter_customer']) . "%'";
		
		/* Filter Date Added */
		if (isset($data['filter_date_added']))
			$sql .= " AND DATE(o.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";

		/* Filter Total */
		if (isset($data['filter_total']))
			$sql .= " AND o.total = '" . (float)$data['filter_total'] . "'";
		
		/* Filter Store */
		if (isset($data['filter_store']))
			$sql .= " AND o.store_id = '" . (int)$data['filter_store'] . "'";
		
		
		/* Sort */
		$sort_data = array(
			'o.order_id',
			'customer',
			'status',
			'o.date_added',
			'o.total'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data))
			$sql .= " ORDER BY " . $data['sort'];
		else
			$sql .= " ORDER BY o.order_id";
		
		/* Execute SQL */
		$query = $this->db->query($sql);

		return $query->row['total'];
	}
	
	public function getOrder($order_id)
	{
		$order_query = $this->db->query("SELECT *, (SELECT CONCAT(c.firstname, ' ', c.lastname) FROM " . DB_PREFIX . "customer c WHERE c.customer_id = o.customer_id) AS customer FROM `" . DB_PREFIX . "order` o WHERE o.order_id = '" . (int)$order_id . "'");

		if ($order_query->num_rows) {
			$reward = 0;

			$order_product_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int)$order_id . "'");

			foreach ($order_product_query->rows as $product) {
				$reward += $product['reward'];
			}

			$country_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "country` WHERE country_id = '" . (int)$order_query->row['payment_country_id'] . "'");

			if ($country_query->num_rows) {
				$payment_iso_code_2 = $country_query->row['iso_code_2'];
				$payment_iso_code_3 = $country_query->row['iso_code_3'];
			} else {
				$payment_iso_code_2 = '';
				$payment_iso_code_3 = '';
			}

			$zone_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "zone` WHERE zone_id = '" . (int)$order_query->row['payment_zone_id'] . "'");

			if ($zone_query->num_rows) {
				$payment_zone_code = $zone_query->row['code'];
			} else {
				$payment_zone_code = '';
			}

			$country_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "country` WHERE country_id = '" . (int)$order_query->row['shipping_country_id'] . "'");

			if ($country_query->num_rows) {
				$shipping_iso_code_2 = $country_query->row['iso_code_2'];
				$shipping_iso_code_3 = $country_query->row['iso_code_3'];
			} else {
				$shipping_iso_code_2 = '';
				$shipping_iso_code_3 = '';
			}

			$zone_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "zone` WHERE zone_id = '" . (int)$order_query->row['shipping_zone_id'] . "'");

			if ($zone_query->num_rows) {
				$shipping_zone_code = $zone_query->row['code'];
			} else {
				$shipping_zone_code = '';
			}

			if ($order_query->row['affiliate_id']) {
				$affiliate_id = $order_query->row['affiliate_id'];
			} else {
				$affiliate_id = 0;
			}

			$this->load->model('marketing/affiliate');

			$affiliate_info = $this->model_marketing_affiliate->getAffiliate($affiliate_id);

			if ($affiliate_info) {
				$affiliate_firstname = $affiliate_info['firstname'];
				$affiliate_lastname = $affiliate_info['lastname'];
			} else {
				$affiliate_firstname = '';
				$affiliate_lastname = '';
			}

			$this->load->model('localisation/language');

			$language_info = $this->model_localisation_language->getLanguage($order_query->row['language_id']);

			if ($language_info) {
				$language_code = $language_info['code'];
				$language_directory = $language_info['directory'];
			} else {
				$language_code = '';
				$language_directory = '';
			}

			return array(
				'order_id'                => $order_query->row['order_id'],
				'invoice_no'              => $order_query->row['invoice_no'],
				'invoice_prefix'          => $order_query->row['invoice_prefix'],
				'store_id'                => $order_query->row['store_id'],
				'store_name'              => $order_query->row['store_name'],
				'store_url'               => $order_query->row['store_url'],
				'customer_id'             => $order_query->row['customer_id'],
				'customer'                => $order_query->row['customer'],
				'customer_group_id'       => $order_query->row['customer_group_id'],
				'firstname'               => $order_query->row['firstname'],
				'lastname'                => $order_query->row['lastname'],
				'email'                   => $order_query->row['email'],
				'telephone'               => $order_query->row['telephone'],
				'fax'                     => $order_query->row['fax'],
				'custom_field'            => unserialize($order_query->row['custom_field']),
				'payment_firstname'       => $order_query->row['payment_firstname'],
				'payment_lastname'        => $order_query->row['payment_lastname'],
				'payment_company'         => $order_query->row['payment_company'],
				'payment_address_1'       => $order_query->row['payment_address_1'],
				'payment_address_2'       => $order_query->row['payment_address_2'],
				'payment_postcode'        => $order_query->row['payment_postcode'],
				'payment_city'            => $order_query->row['payment_city'],
				'payment_zone_id'         => $order_query->row['payment_zone_id'],
				'payment_zone'            => $order_query->row['payment_zone'],
				'payment_zone_code'       => $payment_zone_code,
				'payment_country_id'      => $order_query->row['payment_country_id'],
				'payment_country'         => $order_query->row['payment_country'],
				'payment_iso_code_2'      => $payment_iso_code_2,
				'payment_iso_code_3'      => $payment_iso_code_3,
				'payment_address_format'  => $order_query->row['payment_address_format'],
				'payment_custom_field'    => unserialize($order_query->row['payment_custom_field']),
				'payment_method'          => $order_query->row['payment_method'],
				'payment_code'            => $order_query->row['payment_code'],
				'shipping_firstname'      => $order_query->row['shipping_firstname'],
				'shipping_lastname'       => $order_query->row['shipping_lastname'],
				'shipping_company'        => $order_query->row['shipping_company'],
				'shipping_address_1'      => $order_query->row['shipping_address_1'],
				'shipping_address_2'      => $order_query->row['shipping_address_2'],
				'shipping_postcode'       => $order_query->row['shipping_postcode'],
				'shipping_city'           => $order_query->row['shipping_city'],
				'shipping_zone_id'        => $order_query->row['shipping_zone_id'],
				'shipping_zone'           => $order_query->row['shipping_zone'],
				'shipping_zone_code'      => $shipping_zone_code,
				'shipping_country_id'     => $order_query->row['shipping_country_id'],
				'shipping_country'        => $order_query->row['shipping_country'],
				'shipping_iso_code_2'     => $shipping_iso_code_2,
				'shipping_iso_code_3'     => $shipping_iso_code_3,
				'shipping_address_format' => $order_query->row['shipping_address_format'],
				'shipping_custom_field'   => unserialize($order_query->row['shipping_custom_field']),
				'shipping_method'         => $order_query->row['shipping_method'],
				'shipping_code'           => $order_query->row['shipping_code'],
				'comment'                 => $order_query->row['comment'],
				'total'                   => $order_query->row['total'],
				'reward'                  => $reward,
				'order_status_id'         => $order_query->row['order_status_id'],
				'affiliate_id'            => $order_query->row['affiliate_id'],
				'affiliate_firstname'     => $affiliate_firstname,
				'affiliate_lastname'      => $affiliate_lastname,
				'commission'              => $order_query->row['commission'],
				'language_id'             => $order_query->row['language_id'],
				'language_code'           => $language_code,
				'language_directory'      => $language_directory,
				'currency_id'             => $order_query->row['currency_id'],
				'currency_code'           => $order_query->row['currency_code'],
				'currency_value'          => $order_query->row['currency_value'],
				'ip'                      => $order_query->row['ip'],
				'forwarded_ip'            => $order_query->row['forwarded_ip'],
				'user_agent'              => $order_query->row['user_agent'],
				'accept_language'         => $order_query->row['accept_language'],
				'date_added'              => $order_query->row['date_added'],
				'date_modified'           => $order_query->row['date_modified']
			);
		} else {
			return;
		}
	}

	public function getOrderProducts($order_id)
	{
		$result = $this->db->query('SELECT * FROM ' . DB_PREFIX . 'order_product WHERE order_id = "' . (int)$order_id . '"');
		
		return $result->rows;
	}
	
	public function getOrderProductOptions($order_id, $order_product_id)
	{
		$result = $this->db->query('SELECT name, value, type FROM ' . DB_PREFIX . 'order_option WHERE order_id = "' . (int)$order_id . '" AND order_product_id = "' . (int)$order_product_id . '"');
		
		return $result->rows;
	}
	
	public function getOrderTotals($order_id)
	{
		$result = $this->db->query('SELECT * FROM ' . DB_PREFIX . 'order_total WHERE order_id = "' . (int)$order_id . '" ORDER BY sort_order ASC');
		
		return $result->rows;
	}
	
	public function getOrderHistories($order_id, $start = 0, $limit = 2)
	{
		if ($start < 0) {
			$start = 0;
		}

		if ($limit < 1) {
			$limit = 10;
		}

		$query = $this->db->query("SELECT oh.date_added, os.name AS status, oh.comment, oh.notify FROM " . DB_PREFIX . "order_history oh LEFT JOIN " . DB_PREFIX . "order_status os ON oh.order_status_id = os.order_status_id WHERE oh.order_id = '" . (int)$order_id . "' AND os.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY oh.date_added DESC LIMIT " . (int)$start . "," . (int)$limit);
		
		return $query->rows;
	}
	
	public function getTotalOrderHistories($order_id)
	{
		$query = $this->db->query("SELECT count(oh.order_history_id) AS total FROM " . DB_PREFIX . "order_history oh WHERE order_id = '" . (int)$order_id . "'");
		
		return $query->row['total'];
	}
	
	public function getTotalOrderNotDisplay($order_last_id)
	{
		$query = $this->db->query("SELECT count(o.order_id) AS total FROM " . DB_PREFIX . "order o WHERE o.order_id > '" . (int)$order_last_id . "' and o.order_status_id > 0");
		
		return $query->row['total'];
	}
	
	public function getOrderStatus($status_id)
	{
		$result = $this->db->query('SELECT * FROM ' . DB_PREFIX . 'order_status WHERE order_status_id = "' . $status_id . '" AND language_id = ' . (int)$this->config->get('config_language_id') . ' ORDER BY name ASC');
		
		return $result->row['name'];
	}

	public function addOrderHistory($order_id, $order_status_id, $notify = false, $comment = '')
	{
		$this->db->query('INSERT INTO ' . DB_PREFIX . 'order_history SET order_id = "' . (int)$order_id . '", order_status_id = "' . (int)$order_status_id . '", notify = "' . (int)$notify . '", comment = "' . $this->db->escape($comment) . '", date_added = NOW()');
		
		$this->db->query("UPDATE `" . DB_PREFIX . "order` SET order_status_id = '" . (int)$order_status_id . "', date_modified = NOW() WHERE order_id = '" . (int)$order_id . "'");
		
		$order_info = $this->getOrder($order_id);
		
		$language = new Language($order_info['language_directory']);
		$language->load($order_info['language_filename']);
		$language->load('mail/order');

		$subject = sprintf($language->get('text_update_subject'), html_entity_decode($order_info['store_name'], ENT_QUOTES, 'UTF-8'), $order_id);

		$message  = $language->get('text_update_order') . ' ' . $order_id . "\n";
		$message .= $language->get('text_update_date_added') . ' ' . date($language->get('date_format_short'), strtotime($order_info['date_added'])) . "\n\n";

		$order_status_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_status WHERE order_status_id = '" . (int)$order_status_id . "' AND language_id = '" . (int)$order_info['language_id'] . "'");

		if ($order_status_query->num_rows) {
			$message .= $language->get('text_update_order_status') . "\n\n";
			$message .= $order_status_query->row['name'] . "\n\n";
		}

		if ($order_info['customer_id']) {
			$message .= $language->get('text_update_link') . "\n";
			$message .= $order_info['store_url'] . 'index.php?route=account/order/info&order_id=' . $order_id . "\n\n";
		}

		if ($notify && $comment) {
			$message .= $language->get('text_update_comment') . "\n\n";
			$message .= $comment . "\n\n";
		}

		$message .= $language->get('text_update_footer');

		$mail = new Mail($this->config->get('config_mail'));
		$mail->setTo($order_info['email']);
		$mail->setFrom($this->config->get('config_email'));
		$mail->setSender($order_info['store_name']);
		$mail->setSubject($subject);
		$mail->setText(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
		$mail->send();
		
		return true;
	}

	public function updateLastOrderId($order_id)
	{
		$setting = $this->db->query('SELECT * FROM `' . DB_PREFIX . 'setting` WHERE `code` = "chrome_extension_extra"');
		
		if ($setting->num_rows){
			$this->db->query('UPDATE `' . DB_PREFIX . 'setting` SET `value` = ' . (int)$order_id . ' WHERE `key` = "chrome_extension_last_order" AND `code` = "chrome_extension_extra"');
		}else{
			$this->db->query('INSERT INTO `' . DB_PREFIX . 'setting` SET `value` = ' . (int)$order_id . ', `code` = "chrome_extension_extra", `key` = "chrome_extension_last_order"');
		}
		
		return $order_id;
	}
}