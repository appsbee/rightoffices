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
   public function update_client_data(){
   		  $user_id=$this->input->post('user_id');	
   		  $this->load->library('form_validation');
		  $this->form_validation->set_rules('title','Title','required');
		  $this->form_validation->set_rules('first_name','First name','required');
		  $this->form_validation->set_rules('last_name','Last name','required');
		  $this->form_validation->set_rules('email','Email','required|valid_email');
		  $this->form_validation->set_rules('company','Company','required');
		  $this->form_validation->set_rules('phone_no','Phone no','required');
		  $this->form_validation->set_rules('office_size','Office size','required');
		  $this->form_validation->set_rules('note','Note','required');
		  
		  if ($this->form_validation->run() == FALSE){
			 $client_details=$this->mclient->client_details($user_id);	
		     $this->_load_clientedit_view($client_details);
		  }else{
		  	 $data['title']=$this->input->post('title');
			 $data['first_name']=$this->input->post('first_name');
			 $data['last_name']=$this->input->post('last_name');
			 $data['email']=$this->input->post('email');
			 $data['company']=$this->input->post('company');
			 $data['phone_no']=$this->input->post('phone_no');
			 $data['office_size']=$this->input->post('office_size');
			 $data['note']=$this->input->post('note');
			 $condition['id']=$user_id;
			 $this->mclient->update_client($data,$condition);
			 $this->session->set_flashdata('msgtype','success');
			 $this->session->set_flashdata('msg','Client update successfully done');
			 redirect(base_url('client/get_client_list'),'refresh');
		  }
   }
   public function change_password(){
   		  $user_id=$this->input->post('user_id');	
   		  $this->load->library('form_validation');
		  $this->form_validation->set_rules('password','Password','required');
		  $this->form_validation->set_rules('confirm_password','Confirm password','required');
		  if ($this->form_validation->run() == FALSE){
			 $client_details=$this->mclient->client_details($user_id);	
		     $this->_load_clientedit_view($client_details);
		  }else{
			 $password=$this->input->post('password');
			 $confirm_password=$this->input->post('confirm_password');
			 if($password != $confirm_password){
			 	$this->session->set_flashdata('msgtype','error');
			 	$this->session->set_flashdata('msg','Password field does not match with confirm password field');
				$client_details=$this->mclient->client_details($user_id);	
		        $this->_load_clientedit_view($client_details);
			 }else{
			 	$data['password']=md5($password);
				$condition['id']=$user_id;
				$this->mclient->change_client_password($data,$condition);
				$this->session->set_flashdata('msgtype','success');
			    $this->session->set_flashdata('msg','Password change successfully done');
     			redirect(base_url('client/get_client_list'),'refresh');
			 }
		  }	
   }
   public function change_status(){
   		$condition['id']=$this->input->post('user_id');
		$status=$this->input->post('status');
		if(strtolower($status)=='active'){
			$data['status']=0;
		}else if(strtolower($status)=='inactive'){
			$data['status']=1;
		}
		$this->mclient->change_client_status($data,$condition);
		echo $data['status'];
   }
   public function add_client(){
   		$this->_load_addclient_view();
   }
   public function _load_addclient_view() {
		  $data = array();
		  $data['content'] = 'addclient';
		  $this->load->view('layouts/index', $data);
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
