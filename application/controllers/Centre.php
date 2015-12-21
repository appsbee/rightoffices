<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Centre extends MY_Controller {

	public function __construct() {
		  parent::__construct();
		  $this->redirect_guest();
		  $this->load->model('mcentre');
	}

	public function get_centre_list(){
	      $this->load->library("pagination"); 
		  $config = array();
          $config["base_url"] = base_url() . "centre/get_centre_list";
          $config["total_rows"] = $this->mcentre->record_count();
          $config["per_page"] = 20;
          $config["uri_segment"] = 3;
		  $config["num_links"]=10;
		  $this->pagination->initialize($config);
		  $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
          $links = $this->pagination->create_links();	
		  $centrelist= $this->mcentre->centre_list($config["per_page"], $page);
		  $this->_load_centrelist_view($centrelist, $links);
		
	}
	public function get_centre_details(){
	    $CenterId=$this->input->post('CenterId');
		$centre_details=$this->mcentre->centre_details($CenterId);
		echo json_encode($centre_details);
	}
	public function _load_centrelist_view($centrelist,$links) {
		  $data = array();
		  $data['content'] = 'centrelist';
		  $data['centres'] = $centrelist;
		  $data['links'] = $links;
		  $this->load->view('layouts/index', $data);
	}
	
	
}
