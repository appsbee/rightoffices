<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mclient extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	public function record_count() {
        return $this->db->count_all("users");
    }
	public function client_list($limit, $start){
		$this->db->limit($limit, $start);
        $query = $this->db->get("users");
		if ($query->num_rows() > 0) {
		    $results=$query->result_array();
            foreach ($results as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}
	public function client_delete($user_id){
		$this->db->delete('users',array('user_id'=>$user_id));
		return $this->db->affected_rows();
	}
	public function client_details($user_id){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where(array('user_id'=>$user_id));
		$query=$this->db->get();
		$query->row_array();
	}
}