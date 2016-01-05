<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcentre extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	public function record_count() {
        return $this->db->count_all("Centre");
    }
    public function all_centre_list(){
        $aColumns = array(
            'CentreID',
            'CentreDescription',
            'Address',
            'City',
            'Postcode'
            );
        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "CentreID";
 
        /* Total data set length */
        $sQuery = "SELECT COUNT('" . $sIndexColumn . "') AS row_count
            FROM Centre ";
        $rResultTotal = $this->db->query($sQuery);
        $aResultTotal = $rResultTotal->row();
        $iTotal = $aResultTotal->row_count;
        /*
         * Paging
         */
        $sLimit = "";
        $iDisplayStart = $this->input->get_post('start', true);
        $iDisplayLength = $this->input->get_post('length', true);
        if (isset($iDisplayStart) && $iDisplayLength != '-1') {
            $sLimit = "LIMIT " . intval($iDisplayStart) . ", " .
                    intval($iDisplayLength);
        }
        
        $uri_string = $_SERVER['QUERY_STRING'];
        $uri_string = preg_replace("/\%5B/", '[', $uri_string);
        $uri_string = preg_replace("/\%5D/", ']', $uri_string);
 
        $get_param_array = explode("&", $uri_string);
        $arr = array();
        foreach ($get_param_array as $value) {
            $v = $value;
            $explode = explode("=", $v);
            $arr[$explode[0]] = $explode[1];
        }
        
        $index_of_columns = strpos($uri_string, "columns", 1);
        $index_of_start = strpos($uri_string, "start");
        $uri_columns = substr($uri_string, 7, ($index_of_start - $index_of_columns - 1));
        $columns_array = explode("&", $uri_columns);
        $arr_columns = array();
        foreach ($columns_array as $value) {
            $v = $value;
            $explode = explode("=", $v);
            if (count($explode) == 2) {
                $arr_columns[$explode[0]] = $explode[1];
            } else {
                $arr_columns[$explode[0]] = '';
            }
        }
 
        /*
         * Ordering
         */
        $sOrder = "ORDER BY ";
        $sOrderIndex = $arr['order[0][column]'];
        $sOrderDir = $arr['order[0][dir]'];
        $bSortable_ = $arr_columns['columns[' . $sOrderIndex . '][orderable]'];
        if ($bSortable_ == "true") {
            $sOrder .= $aColumns[$sOrderIndex] .
                    ($sOrderDir === 'asc' ? ' asc' : ' desc');
        }
        
         /*
         * Filtering
         */
        $sWhere = "";
        $sSearchVal = $arr['search[value]'];
        if (isset($sSearchVal) && $sSearchVal != '') {
            $sWhere = "WHERE (";
            for ($i = 0; $i < count($aColumns); $i++) {
                $sWhere .= $aColumns[$i] . " LIKE '%" . $this->db->escape_like_str($sSearchVal) . "%' OR ";
            }
            $sWhere = substr_replace($sWhere, "", -3);
            $sWhere .= ')';
        }
 
        /* Individual column filtering */
        $sSearchReg = $arr['search[regex]'];
        for ($i = 0; $i < count($aColumns); $i++) {
            $bSearchable_ = $arr['columns[' . $i . '][searchable]'];
            if (isset($bSearchable_) && $bSearchable_ == "true" && $sSearchReg != 'false') {
                $search_val = $arr['columns[' . $i . '][search][value]'];
                if ($sWhere == "") {
                    $sWhere = "WHERE ";
                } else {
                    $sWhere .= " AND ";
                }
                $sWhere .= $aColumns[$i] . " LIKE '%" . $this->db->escape_like_str($search_val) . "%' ";
            }
        }
        
                /*
         * SQL queries
         * Get data to display
         */
          $sQuery = "SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) . "
                     FROM Centre $sWhere $sOrder $sLimit";
         
        $rResult = $this->db->query($sQuery);
 
        /* Data set length after filtering */
        $sQuery = "SELECT FOUND_ROWS() AS length_count";
        $rResultFilterTotal = $this->db->query($sQuery);
        $aResultFilterTotal = $rResultFilterTotal->row();
        $iFilteredTotal = $aResultFilterTotal->length_count;
        
        $sEcho = $this->input->get_post('draw', true);
        $output = array(
            "draw" => intval($sEcho),
            "recordsTotal" => $iTotal,
            "recordsFiltered" => $iFilteredTotal,
            "data" => array()
        );
 
        foreach ($rResult->result_array() as $aRow) {
            $row = array();
            foreach ($aColumns as $col) {
                $row[] = $aRow[$col];
            }
            $output['data'][] = $row;
        }
 
        return $output;
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
    public function update_centre($data,$condition){
       $this->db->where($condition); 
       $this->db->update('Centre',$data);
    }
	public function centre_images($CentreId){
	    $this->db->select('CentreID,displayorder,url');
		$this->db->from('Photos');
		$this->db->where(array('CentreId'=>$CentreId));
		$query=$this->db->get();
		return $query->result_array(); 
	}
    public function add_meta_keywords($centreid,$keywords,$contents){
        for($i=0;$i<count($keywords);$i++){
            $centre_meta= array('centreid'=>$centreid,'keyword'=>$keywords[$i],'content'=>$contents[$i]);
            $all_centre[]=$centre_meta;
        }
        $this->db->insert_batch('centre_metakeyword',$all_centre);
    }
	
}