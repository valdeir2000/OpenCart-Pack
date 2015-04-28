<?php
class ModelSetting extends Model {
	
	private $db;

	public function start() {
		$this->db = new DB(
			$this->session->data['db']['DB_DRIVER'],
			$this->session->data['db']['DB_HOSTNAME'],
			$this->session->data['db']['DB_USERNAME'],
			$this->session->data['db']['DB_PASSWORD'],
			$this->session->data['db']['DB_DATABASE']
		);
	}

	public function editSetting($code, $data, $store_id = 0) {

		$this->start();

		$this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE store_id = '" . (int)$store_id . "' AND `code` = '" . $this->db->escape($code) . "'");

		foreach ($data as $key => $value) {
			if (substr($key, 0, strlen($code)) == $code) {
				if (!is_array($value)) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "setting SET store_id = '" . (int)$store_id . "', `code` = '" . $this->db->escape($code) . "', `key` = '" . $this->db->escape($key) . "', `value` = '" . $this->db->escape($value) . "'");
				} else {
					$this->db->query("INSERT INTO " . DB_PREFIX . "setting SET store_id = '" . (int)$store_id . "', `code` = '" . $this->db->escape($code) . "', `key` = '" . $this->db->escape($key) . "', `value` = '" . $this->db->escape(serialize($value)) . "', serialized = '1'");
				}
			}
		}
	}

	public function addPermission($user_group_id, $type, $route) {
		$user_group_query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "user_group WHERE user_group_id = '" . (int)$user_group_id . "'");

		if ($user_group_query->num_rows) {
			$data = unserialize($user_group_query->row['permission']);

			$data[$type][] = $route;

			$this->db->query("UPDATE " . DB_PREFIX . "user_group SET permission = '" . $this->db->escape(serialize($data)) . "' WHERE user_group_id = '" . (int)$user_group_id . "'");
		}
	}

	public function updateTheme($theme = '') {
		if (!empty($theme)) {
			$this->start();

			$this->db->query("UPDATE " . DB_PREFIX . "setting SET `value` = '" . $this->db->escape($theme) . "' WHERE `key` = 'config_template'");
		}
	}
}