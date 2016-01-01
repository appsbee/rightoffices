<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpage extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    public function all_page_list(){
        $this->db->select('*');
        $this->db->from('pages');
        $query=$this->db->get();
        return $query->result_array();
    }
}