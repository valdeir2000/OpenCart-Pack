<?php 
class ModelSetting extends Model {
	
	protected $db;
	
	public function __construct(){
		$this->db = new DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
	}

	public function editSetting($group, $data, $store_id = 0) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "setting WHERE store_id = '" . (int)$store_id . "' AND `group` = '" .$group . "'");

		foreach ($data as $key => $value) {
			if (!is_array($value)) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "setting SET store_id = '" . (int)$store_id . "', `group` = '" . $group . "', `key` = '" . $key . "', `value` = '" . $value . "'");
			} else {
				$this->db->query("INSERT INTO " . DB_PREFIX . "setting SET store_id = '" . (int)$store_id . "', `group` = '" . $group . "', `key` = '" . $key . "', `value` = '" . serialize($value) . "', serialized = '1'");
			}
		}
	}
	
	public function install($type, $code) {
		
		$verifyInstalled = $this->db->query("SELECT * FROM " . DB_PREFIX . "extension WHERE `type` = '" . $this->db->escape($type) . "' AND `code` = '" . $this->db->escape($code) . "'");
		
		if ($verifyInstalled->num_rows == 0){
			$this->db->query("INSERT INTO " . DB_PREFIX . "extension SET `type` = '" . $this->db->escape($type) . "', `code` = '" . $this->db->escape($code) . "'");
		}
	}
	
	public function addPermission($type, $page, $user_id = 1) {
		$user_query = $this->db->query("SELECT DISTINCT user_group_id FROM " . DB_PREFIX . "user WHERE user_id = '" . (int)$user_id . "'");
		
		if ($user_query->num_rows) {
			$user_group_query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "user_group WHERE user_group_id = '" . (int)$user_query->row['user_group_id'] . "'");
		
			if ($user_group_query->num_rows) {
				$data = unserialize($user_group_query->row['permission']);
		
				$data[$type][] = $page;
		
				$this->db->query("UPDATE " . DB_PREFIX . "user_group SET permission = '" . serialize($data) . "' WHERE user_group_id = '" . (int)$user_query->row['user_group_id'] . "'");
			}
		}
	}

	public function mysql($file) {
	
		if (!file_exists($file)) { 
			exit('Could not load sql file: ' . $file); 
		}
		
		$lines = file($file);
		
		if ($lines) {
			$sql = '';

			foreach($lines as $line) {
				if ($line && (substr($line, 0, 2) != '--') && (substr($line, 0, 1) != '#')) {
					$sql .= $line;
  
					if (preg_match('/;\s*$/', $line)) {
						$sql = str_replace("DROP TABLE IF EXISTS `oc_", "DROP TABLE IF EXISTS `" . DB_PREFIX, $sql);
						$sql = str_replace("CREATE TABLE `oc_", "CREATE TABLE `" . DB_PREFIX, $sql);
						$sql = str_replace("INSERT INTO `oc_", "INSERT INTO `" . DB_PREFIX, $sql);
						
						$this->db->query($sql);
	
						$sql = '';
					}
				}
			}
		}
	}
}
?>