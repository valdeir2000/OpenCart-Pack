<?php
class ModelTemplate extends Model {
	public function get_template($base = '', $extension = '') {
		if (!empty($extension) || !empty($base)) {

			/* Define usuário como logado */
			$this->session->data['user_id'] = '1';
			$this->session->data['token'] = 'valdeir';

			/* Url do módulo */
			$url = HTTP_OPENCART . 'admin/index.php?route=' . $base. '/' . $extension . '&token=valdeir';

			/* Armazena session */
			$strCookie = session_name() . '=' . $_COOKIE[ session_name() ] . '; path=/';
			session_write_close(); 

			/* CURL */
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLINFO_HEADER_OUT, true);
			curl_setopt($ch, CURLOPT_USERAGENT, $this->request->server['HTTP_USER_AGENT']);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_FORBID_REUSE, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_COOKIESESSION, true);
			curl_setopt($ch, CURLOPT_COOKIE, $strCookie);
			$response = curl_exec($ch);
			curl_close($ch);

			return $response;
		} else {
			return false;
		}
	}
}