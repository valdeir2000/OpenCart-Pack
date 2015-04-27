<?php
class ModelModification extends Model {

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

	public function getModifications() {
		$this->start();

		$result = $this->db->query('SELECT * FROM ' . DB_PREFIX . 'modification');

		return $result->rows;
	}

	public function activeModification($modification_id = 0) {
		$this->start();

		if ($modification_id != 0) {
			$this->db->query('UPDATE ' . DB_PREFIX . 'modification SET status = 1 WHERE modification_id = "' . (int)$modification_id . '"');
		}
	}
}