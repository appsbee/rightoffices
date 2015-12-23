<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mclient extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	public function record_count() {
        return $this->db->count_all("enquiry");
    }
	public function client_list($limit, $start){
		$this->db->limit($limit, $start);
        $query = $this->db->get("enquiry");
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
		$this->db->delete('enquiry',array('id'=>$user_id));
		return $this->db->affected_rows();
	}
	public function client_details($user_id){
		$this->db->select('*');
		$this->db->from('enquiry');
		$this->db->where(array('id'=>$user_id));
		$query=$this->db->get();
		return $query->row_array();
	}
	public function update_client($data,$condition){
		$this->db->where($condition);
		$this->db->update('enquiry',$data);
	}
	public function change_client_password($data,$condition){
		$this->db->where($condition);
		$this->db->update('enquiry',$data);
	}
	public function change_client_status($data,$condition){
		$this->db->where($condition);
		$this->db->update('enquiry',$data);
	}
	public function client_search_data($start_data,$end_data){
		$sql="select * from enquiry where DATE(created_at) between '".$start_data."' and '".$end_data."'";
		$query=$this->db->query($sql);
		return $query->result_array(); 
	}
	public function all_client_details(){
		$this->db->select('*');
		$this->db->from('enquiry');
		$query=$this->db->get();
		return $query->result_array();
	}
}