<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends MY_Controller {

	public function __construct() {
		  parent::__construct();
		  $this->redirect_guest();
		  $this->load->model('mclient');
		  $this->load->model('madminnote');
	}	
    public function get_all_client_list(){
    	// echo '<pre>'; print_r($_REQUEST);die;
        $data=$this->mclient->all_client_list();
        echo json_encode($data);
    }
	public function get_client_list(){
        $this->_load_clientlist_view();
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
   public function get_client_all_details(){
       $id=$this->input->post('id');
       $client_details=$this->mclient->client_details($id);  
       echo json_encode($client_details);  
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
             $data['status']=$this->input->post('status');
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
   public function client_search(){
   		$this->load->library('form_validation');
		$this->form_validation->set_rules('start_date','Start date','required');
		$this->form_validation->set_rules('end_date','End date','required');
		if ($this->form_validation->run() == FALSE){
			redirect(base_url('client/get_client_list'),'refresh');
		}else{
			$start_date=$this->input->post('start_date');
			$end_date=$this->input->post('end_date');
			$client_details=$this->mclient->client_search_data($start_date,$end_date);
		    $this->_load_clientsearchresult_view($client_details);
		}
   }
   public function add_notes(){
   		$this->load->library('form_validation');
		$this->form_validation->set_rules('property','Property','required');
		$user_id=$this->input->post('user_id');
		if ($this->form_validation->run() == FALSE){
			$client_details=$this->mclient->client_details($user_id);	
		    $this->_load_clientedit_view($client_details);
		}else{
		    $property=$this->input->post('property');
			$data=array('user_id'=>$user_id,'type'=>'note','property'=>$property);
			$insert_id=$this->madminnote->add_note($data);
			if($insert_id){
				$this->session->set_flashdata('msgtype','success');
			    $this->session->set_flashdata('msg','Note successfully added');
     			redirect(base_url('client/get_client_list'),'refresh');
			}else{
				$this->session->set_flashdata('msgtype','error');
			    $this->session->set_flashdata('msg','Error in adding note');
				redirect(base_url('client/get_client_list'),'refresh');
			}
		}
   }
   public function send_mail_notification(){
            $user_id=$this->input->post('user_id');   
            if($user_id!=''){
                $data['formtype']=$this->input->post('formtype');  
                $data['subject']=$this->input->post('subject');
                $data['message']=$this->input->post('message');
                if($data['formtype']=='popup'){
                    $data['users']=$this->mclient->all_client_details($user_id);
                    $this->send_mail($data); 
                    echo 'Mail sent successfully';
                }else{
                    $data['users']=$this->mclient->client_details($user_id);
                    $this->send_mail($data);
                    $this->session->set_flashdata('msgtype','success');
                    $this->session->set_flashdata('msg','Mail sent successfully');
                    redirect(base_url('client/get_client_list'),'refresh');
                    
                } 
            }else{
                echo 'Please select client to send mail';
            }
   }
   public function send_mail($data){
            $this->load->library('email');
            $admin=$this->session->userdata('admin');
            if($data['formtype']=='popup'){
                foreach($data['users'] as $user){
                    $this->email->clear();
                    $this->email->to($user['email']);
                    $this->email->from($admin['email'],$admin['name']);
                    $this->email->subject($data['subject']);
                    $this->email->message($data['message']);
                    $this->email->send();
                }
            }else{
                    $this->email->from($admin['email'],$admin['name']);
                    $this->email->to($data['users']['email']);
                    $this->email->subject($data['subject']);
                    $this->email->message($data['message']);
                    $this->email->send();
            }
   }
   public function add_client(){
   		$this->_load_addclient_view();
   }
   public function _load_addclient_view() {
		  $data = array();
		  $data['content'] = 'addclient';
		  $this->load->view('layouts/index', $data);
   }
   public function _load_clientsearchresult_view($client_details){
   		  $data = array();
		  $data['content'] = 'clientsearchresult';
		  $data['clients'] = $client_details;
		  $this->load->view('layouts/index', $data);
   }
   public function _load_clientlist_view() {
		  $data = array();
		  $data['content'] = 'clientlist';
		  //$data['clients'] = $clientlist;
		  //$data['links'] = $links;
		  $this->load->view('layouts/index', $data);
   }
   public function _load_clientedit_view($client_details){
   		  $data = array();
		  $data['content'] = 'editclient';
		  $data['client_details'] = $client_details;
		  $this->load->view('layouts/index', $data);
   }
   
}
