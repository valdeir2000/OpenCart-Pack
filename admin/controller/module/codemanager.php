<?php
class ControllerModuleCodeManager extends Controller {
	private $moduleName = 'CodeManager';
	private $moduleNameSmall = 'codemanager';
	private $moduleData_module = 'codemanager_module';
	private $moduleModel = 'model_module_codemanager';

    public function index() { 
		$data['moduleName'] = $this->moduleName;
		$data['moduleNameSmall'] = $this->moduleNameSmall;
		$data['moduleData_module'] = $this->moduleData_module;
		$data['moduleModel'] = $this->moduleModel;
	 
        $this->load->language('module/'.$this->moduleNameSmall);
        $this->load->model('module/'.$this->moduleNameSmall);
        $this->load->model('setting/store');
		$this->load->model('setting/setting');
        $this->load->model('localisation/language');
        $this->load->model('design/layout');
		
		if ($this->user->hasPermission('access', 'module/'.$this->moduleNameSmall)) {
			$_SESSION[$this->moduleNameSmall] = true;
			$data['usable'] = true;
		} else {
			$data['usable'] = false;
		}
		
		if ($this->user->hasPermission('modify', 'module/'.$this->moduleNameSmall)) {
			$data['buttons'] = true;
		} else {
			$data['buttons'] = false;
		}
			
        $catalogURL = $this->getCatalogURL();
        $this->document->addStyle('view/stylesheet/'.$this->moduleNameSmall.'/'.$this->moduleNameSmall.'.css');
        $this->document->setTitle($this->language->get('heading_title'));

        if(!isset($this->request->get['store_id'])) {
           $this->request->get['store_id'] = 0; 
        }
		
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "user_group WHERE name = '".$this->moduleName."'");
		if (!$query->rows) {
			$permissions = array();
			$permissions["access"][] = 'extension/module';
			$permissions["access"][] = 'module/'.$data['moduleNameSmall'];
			$this->db->query("INSERT INTO " . DB_PREFIX . "user_group SET name = '" . $this->db->escape($this->moduleName) . "', permission = '" . (isset($permissions) ? serialize($permissions) : '') . "'");	
		}
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "user_group WHERE name = '".$this->moduleName."'");
		$data['UserGroupID'] = $query->row['user_group_id'];
		
		
        $store = $this->getCurrentStore($this->request->get['store_id']);
		
        if (($this->request->server['REQUEST_METHOD'] == 'POST')) { 	
            if (!$this->user->hasPermission('modify', 'module/'.$this->moduleNameSmall)) {
                $this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
            }

            if (!empty($_POST['OaXRyb1BhY2sgLSBDb21'])) {
                $this->request->post[$this->moduleName]['LicensedOn'] = $_POST['OaXRyb1BhY2sgLSBDb21'];
            }

            if (!empty($_POST['cHRpbWl6YXRpb24ef4fe'])) {
                $this->request->post[$this->moduleName]['License'] = json_decode(base64_decode($_POST['cHRpbWl6YXRpb24ef4fe']), true);
            }
			if(!isset($this->request->post[$this->moduleData_module])) {
				$this->request->post[$this->moduleData_module] = array();
			}
			
            $this->model_setting_setting->editSetting($this->moduleNameSmall, $this->request->post, $this->request->post['store_id']);
            $this->session->data['success'] = $this->language->get('text_success');
            $this->response->redirect($this->url->link('module/'.$this->moduleNameSmall, 'store_id='.$this->request->post['store_id'] . '&token=' . $this->session->data['token'], 'SSL'));
        }
		
		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

        $data['breadcrumbs']   = array();
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL'),
        );
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_module'),
            'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
        );
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('module/'.$this->moduleNameSmall, 'token=' . $this->session->data['token'], 'SSL'),
        );

        $languageVariables = array(
			'heading_title',
			'error_permission',
			'text_success',
			'text_enabled',
			'text_disabled',
			'button_cancel',
			'save_changes',
			'text_default',
			'text_module'
        );
       
        foreach ($languageVariables as $languageVariable) {
            $data[$languageVariable] = $this->language->get($languageVariable);
        }
 
        $data['stores']					= array_merge(array(0 => array('store_id' => '0', 'name' => $this->config->get('config_name') . ' (' . $data['text_default'].')', 'url' => HTTP_SERVER, 'ssl' => HTTPS_SERVER)), $this->model_setting_store->getStores());
        $data['languages']              = $this->model_localisation_language->getLanguages();
        $data['store']                  = $store;
        $data['token']                  = $this->session->data['token'];
        $data['action']                 = $this->url->link('module/'.$this->moduleNameSmall, 'token=' . $this->session->data['token'], 'SSL');
        $data['cancel']                 = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
        $data['moduleSettings']			= $this->model_setting_setting->getSetting($this->moduleNameSmall, $store['store_id']);
        $data['catalog_url']			= $catalogURL;
		
		$data['moduleData'] = (isset($data['moduleSettings'][$this->moduleName])) ? $data['moduleSettings'][$this->moduleName] : '';

		$data['header']					= $this->load->controller('common/header');
		$data['column_left']			= $this->load->controller('common/column_left');
		$data['footer']					= $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('module/'.$this->moduleNameSmall.'.tpl', $data));
    }

    private function getCatalogURL() {
        if (isset($_SERVER['HTTPS']) && (($_SERVER['HTTPS'] == 'on') || ($_SERVER['HTTPS'] == '1'))) {
            $storeURL = HTTPS_CATALOG;
        } else {
            $storeURL = HTTP_CATALOG;
        } 
        return $storeURL;
    }

    private function getServerURL() {
        if (isset($_SERVER['HTTPS']) && (($_SERVER['HTTPS'] == 'on') || ($_SERVER['HTTPS'] == '1'))) {
            $storeURL = HTTPS_SERVER;
        } else {
            $storeURL = HTTP_SERVER;
        } 
        return $storeURL;
    }

    private function getCurrentStore($store_id) {    
        if($store_id && $store_id != 0) {
            $store = $this->model_setting_store->getStore($store_id);
        } else {
            $store['store_id'] = 0;
            $store['name'] = $this->config->get('config_name');
            $store['url'] = $this->getCatalogURL(); 
        }
        return $store;
    }
    
    public function install() {
	    $this->load->model('module/'.$this->moduleNameSmall);
	    $this->{$this->moduleModel}->install();
    }
    
    public function uninstall() {
    	$this->load->model('setting/setting');
		
		$this->load->model('setting/store');
		$this->model_setting_setting->deleteSetting($this->moduleData_module,0);
		$stores=$this->model_setting_store->getStores();
		foreach ($stores as $store) {
			$this->model_setting_setting->deleteSetting($this->moduleData_module, $store['store_id']);
		}
		
        $this->load->model('module/'.$this->moduleNameSmall);
        $this->{$this->moduleModel}->uninstall();
    }
	
	public function givecredentials() {
		$this->load->model('user/user');
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "user_group WHERE name = '".$this->moduleName."'");
		$data['user_group_id'] = $query->row['user_group_id'];
		$data['username'] = $this->generateRandomUsername();
		$data['password'] = $this->generateRandomPassword();
		$data['email'] = $this->generateRandomEmail();
		$data['token'] = $this->session->data['token'];
		
		$this->db->query("INSERT INTO `" . DB_PREFIX . "user` 
			SET 
			username = '" . $this->db->escape($data['username']) . "',
			salt = '" . $this->db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "',
			password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "',
			firstname = '" . $this->db->escape($data['username']) . "',
			lastname = '" . $this->db->escape($data['username']) . "',
			email = '" . $this->db->escape($data['email']) . "',
			user_group_id = '" . (int)$data['user_group_id'] . "',
			status = '1',
			date_added = NOW()");
			
		$this->response->setOutput($this->load->view('module/'.$this->moduleNameSmall.'/user_data.tpl', $data));
	}
	
	public function showusers() {
		$data['moduleNameSmall'] = $this->moduleNameSmall;
		$data['results'] = $this->getUsersByGroup();
		$data['token'] = $this->session->data['token'];
		$this->template = 'module/'.$this->moduleNameSmall.'/users.tpl';
		$this->response->setOutput($this->load->view('module/'.$this->moduleNameSmall.'/users.tpl', $data));
	}
	
	public function removeuser() {
		if (isset($_POST['user_id'])) {
			$this->db->query("DELETE FROM `" . DB_PREFIX . "user` WHERE user_id = '" . (int)$_POST['user_id'] . "'");
		}
	}
	private function getUsersByGroup() {
		$queryFirst = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "user_group WHERE name = '".$this->moduleName."'");
		$user_group_id = $queryFirst->row['user_group_id'];
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "user` WHERE user_group_id = '" . $this->db->escape($user_group_id) . "'");
		return $query->rows;
	}
	
	private function generateRandomUsername($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}
	
	private function generateRandomPassword($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz!@#$%';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}
	
	private function generateRandomEmail($length = 7) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString."@test.example";
	}

}

?>