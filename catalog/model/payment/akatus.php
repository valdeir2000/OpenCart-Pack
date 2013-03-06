<?php 
class ModelPaymentakatus extends Model {
  	public function getMethod($address) {
		$this->load->language('payment/akatus');
		
		if ($this->config->get('akatus_status')) {	
		    $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$this->config->get('akatus_geo_zone_id') . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");
			
			if (!$this->config->get('akatus_geo_zone_id')) {
        		$status = TRUE;
      		} elseif ($query->num_rows) {
      		  	$status = TRUE;
      		} else {
     	  		$status = FALSE;
			}	
      	} else {
			$status = FALSE;
		}
		
		$method_data = array();
	
		if ($status) {  
      		$method_data = array( 
        		'code'         => 'akatus',
        		'title'      => $this->language->get('text_title'),
				'sort_order' => $this->config->get('akatus_order')
      		);
    	}
   
    	return $method_data;
  	}
	
	public function salvarCartao($dados) {
		$sql = "INSERT INTO `cartaocredito` 
															(
															`customer_id`, 
															`bandeiraCartao`, 
															`titularCartao`, 
															`numeroCartao`, 
															`validadeCartao`, 
															`codCartao`, 
															`nascimentoTitular`, 
															`telefoneTitular`, 
															`CPFTitular`) 
															VALUES (
															'".$dados['customer_id']."', 
															'".$dados['bandeiraCartao']."', 
															'".$dados['titularCartao']."', 
															'".$dados['numeroCartao']."', 
															'".$dados['validadeCartao']."', 
															'".$dados['codCartao']."', 
															'".$dados['nascimentoTitular']."', 
															'".$dados['telefone']."', 
															'".$dados['cpf']."');";
		
		$this->db->query($sql);
	}
	
	public function getCartao($customer_id, $bandeira) {
		
		$this->load->library('criptografiacartao');
		$encryption = new CriptografiaCartao($this->config->get('config_encryption'));
		
		$bandeira = $encryption->encrypt($bandeira);
		
		$sql = "SELECT * FROM `cartaocredito` WHERE `customer_id` = ".$customer_id." AND `bandeiraCartao` = '".$bandeira."'";
		$dados = $this->db->query($sql);		
		if (!empty($dados->rows)):
			$retorno['localizado']        = 'sim';
			$retorno['customer_id']       = $dados->row['customer_id'];
			$retorno['bandeiraCartao']    = $encryption->decrypt($dados->row['bandeiraCartao']);
			$retorno['titularCartao']     = $encryption->decrypt($dados->row['titularCartao']);
			$retorno['numeroCartao']      = $encryption->decrypt($dados->row['numeroCartao']);
			$retorno['validadeCartao']    = $encryption->decrypt($dados->row['validadeCartao']);
			$retorno['codCartao']         = $encryption->decrypt($dados->row['codCartao']);
			$retorno['nascimentoTitular'] = $encryption->decrypt($dados->row['nascimentoTitular']);
			$retorno['telefoneTitular']   = $encryption->decrypt($dados->row['telefoneTitular']);
			$retorno['CPFTitular']        = $encryption->decrypt($dados->row['CPFTitular']);
		else:
			$retorno['localizado']        = 'nao';
		endif;
		return $retorno;
	}

	/* Captura o Sub-Total / Valda da Forma de Entrega e valor total da compra utilizando o ID */
	public function getOrderTotals($order_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_total WHERE order_id = '" . (int)$order_id . "' ORDER BY sort_order");

		return $query->rows;
	}
	
}
?>
