<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Muser extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function user_check($email, $password) {
		$this->db->select('email, name, phone_no, role');
		$this->db->from('admin');
		$this->db->where(array('email' => $email, 'password' => md5($password)));
		$query = $this->db->get();
		return $query->row_array();
	}
}