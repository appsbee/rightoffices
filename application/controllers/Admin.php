<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

	public function __construct() {
		  parent::__construct();
		  $this->redirect_guest();
		  $this->load->model('madmin');
	}

	public function get_admin_list(){
		  $userlist= $this->madmin->user_list();
		  $this->_load_userlist_view($userlist);
		
	}
	public function delete_admin(){
		  $user_id = $this->input->post('user_id');
		  $status=$this->madmin->user_delete($user_id);
		  if($status){
			echo 'Admin deleted successfully';
		  }else{
			echo 'Error in admin delete';
		  }
	  
	}
	public function edit_admin($user_id){
		  $user_details=$this->madmin->get_user_details($user_id);
		  $this->_load_useredit_view($user_details);
	}
	public function update_admin_data(){
		  $this->load->library('form_validation');
		  $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		  $this->form_validation->set_rules('name', 'Name', 'trim|required');
		  $this->form_validation->set_rules('phone_no', 'Phone number', 'trim|required');
		  if ($this->form_validation->run() == FALSE){
		       $user_id=$this->input->post('user_id');
               $user_details=$this->madmin->get_user_details($user_id);
		  	   $this->_load_useredit_view($user_details);
          }else{
		      $condition['id']=$this->input->post('user_id');
			  $data['email']=$this->input->post('email');
			  $data['name']=$this->input->post('name');
			  $data['phone_no']=$this->input->post('phone_no');
              $this->madmin->user_update($data,$condition);
			  $this->session->set_flashdata('msgtype', 'success');
			  $this->session->set_flashdata('msg', 'User updated successfully');
			  redirect(base_url('admin/get_admin_list'),'refresh');
          }
		
	}
	public function change_password(){
		$this->load->library('form_validation');
	 	$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required');
		$user_id=$this->input->post('user_id');
		$password=$this->input->post('password');
		$confirm_password=$this->input->post('confirm_password');
		if ($this->form_validation->run() == FALSE){
			$user_details=$this->madmin->get_user_details($user_id);
		    $this->_load_useredit_view($user_details);
		}else{
			if($password != $confirm_password){
				$this->session->set_flashdata('msgtype', 'error');
			    $this->session->set_flashdata('msg', 'Password field does not match with confirm password');
				redirect(base_url('admin/edit_admin/'.$user_id));
			}else{
				$condition['id']=$user_id;
				$data['password']=md5($password);
				$this->madmin->change_user_password($data,$condition);
				$this->session->set_flashdata('msgtype', 'success');
			    $this->session->set_flashdata('msg', 'Password changed successfully');
				redirect(base_url('admin/get_admin_list'));
			}
		}
	}
	public function _load_useredit_view($user_details) {
		  $data = array();
		  $data['content'] = 'editadmin';
		  $data['userdetails'] = $user_details;
  	      $this->load->view('layouts/index', $data);
	}
	public function _load_userlist_view($userlist) {
		  $data = array();
		  $data['content'] = 'adminlist';
		  $data['users'] = $userlist;
		  $this->load->view('layouts/index', $data);
	}
	
	
}
