<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Madminnote extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	public function add_note($data){
		$this->db->insert('admin_notes',$data);
		return $this->db->insert_id();
	}
}