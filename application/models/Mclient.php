<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mclient extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	public function record_count() {
        return $this->db->count_all("enquiry");
    }
    public function all_client_list(){
        $start_date='';
        $end_date='';
        if(isset($_REQUEST['start_date']) && $_REQUEST['start_date']!='' && isset($_REQUEST['end_date']) && $_REQUEST['end_date']!=''){
            $start_date= $_REQUEST['start_date'];
            $end_date= $_REQUEST['end_date'];
        }
        $aColumns = array(
            'id',
            'id',
            'first_name',
            'last_name',
            'email',
            'company',
            'created_at'
            );
        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "id";
 
        /* Total data set length */
        $sQuery = "SELECT COUNT('" . $sIndexColumn . "') AS row_count
            FROM enquiry ";
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
         if($sWhere!=''){
             if(isset($start_date) && $start_date!='' && isset($end_date) && $end_date!=''){
              $sWhere.=" and created_at >='".$start_date."' and  created_at <= '".$end_date."' ";   
             }
         }else{
             if(isset($start_date) && $start_date!='' && isset($end_date) && $end_date!=''){
             $sWhere.=" where  created_at >='".$start_date."' and created_at <= '".$end_date."' ";
             }
         }
         
         $sQuery = "SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) . "
                    FROM enquiry $sWhere $sOrder $sLimit"; 

         
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
            $i=1;
            foreach ($aColumns as $col) {
                if($i==1){
                $row[] = "<input type='checkbox' name='mail' value='".$aRow[$col]."'>";        
                }else{
                 if($col == 'created_at'){
                    $row[] = date('Y-m-d',strtotime($aRow[$col])); 
                 }else{
                    $row[] = $aRow[$col];     
                 }   
                }
                $i++;
            }
            $output['data'][] = $row;
        }
 
        return $output;
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
	public function all_client_details($user_id){
        $sql="select id,first_name,last_name,email from enquiry where id in (".$user_id.")";
        $query=$this->db->query($sql);
        return $query->result_array(); 
	}
    public function last_five_user(){
        $this->db->select('*');
        $this->db->from('enquiry');
        $this->db->order_by("created_at", "desc");
        $this->db->limit(5);
        $query=$this->db->get();
        return $query->result_array();
    }
}