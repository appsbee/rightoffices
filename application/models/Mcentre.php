<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcentre extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	public function record_count() {
        return $this->db->count_all("Centre");
    }
	public function centre_list($limit, $start){
		$this->db->limit($limit, $start);
        $query = $this->db->get("Centre");
		if ($query->num_rows() > 0) {
		    $results=$query->result_array();
            foreach ($results as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}
	public function centre_details($CentreId){
		$this->db->select('*');
		$this->db->from('Centre');
		$this->db->where(array('CentreId'=>$CentreId));
		$query=$this->db->get();
		return $query->row_array();
	}
	public function centre_images($CentreId){
	    $this->db->select('CentreID,displayorder,url');
		$this->db->from('Photos');
		$this->db->where(array('CentreId'=>$CentreId));
		$query=$this->db->get();
		return $query->result_array(); 
	}
	
}