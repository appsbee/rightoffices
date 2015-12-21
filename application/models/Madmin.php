<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Madmin extends CI_Model {

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
	public function user_list(){
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where(array('role'=>'A'));
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function user_delete($user_id){
		$this->db->delete('admin',array('id'=>$user_id));
		return $this->db->affected_rows();
	}
	public function get_user_details($user_id){
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where(array('id'=>$user_id));
		$query=$this->db->get();
		return $query->row_array();
	}
	public function user_update($data,$condition){
		$this->db->where($condition);
		$this->db->update('admin', $data); 
	}
	public function change_user_password($data,$condition){
		$this->db->where($condition);
		$this->db->update('admin', $data); 
	}
}