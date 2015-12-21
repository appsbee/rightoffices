<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends MY_Controller {

	public function __construct() {
		  parent::__construct();
		  $this->redirect_guest();
		  $this->load->model('mclient');
	}	
	public function get_client_list(){
	      $this->load->library("pagination"); 
		  $config = array();
          $config["base_url"] = base_url() . "client/get_client_list";
          $config["total_rows"] = $this->mclient->record_count();
          $config["per_page"] = 2;
          $config["uri_segment"] = 3;
		  $config["num_links"]=5;
		  $this->pagination->initialize($config);
		  $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
          $links = $this->pagination->create_links();	
		  $clientlist= $this->mclient->client_list($config["per_page"], $page);
		  $this->_load_clientlist_view($clientlist, $links);
   }
   public function delete_client(){
   		  $user_id=$this->input->post('user_id');
		  $status=$this->mclient->client_delete($user_id);	
		  if($status){
		  	echo 'Client deleted successfully';
		  }else{
		  	echo 'Error in deleting client';
		  }
   }
   public function edit_client($user_id){
   		  $client_details=$this->mclient->client_details($user_id);	
		  $this->_load_clientedit_view($client_details);
   }
   public function _load_clientlist_view($clientlist,$links) {
		  $data = array();
		  $data['content'] = 'clientlist';
		  $data['clients'] = $clientlist;
		  $data['links'] = $links;
		  $this->load->view('layouts/index', $data);
   }
   public function _load_clientedit_view($client_details){
   		  $data = array();
		  $data['content'] = 'editclient';
		  $data['client_details'] = $client_details;
		  $this->load->view('layouts/index', $data);
   }
}
