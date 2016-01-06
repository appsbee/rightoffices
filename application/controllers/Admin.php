<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->redirect_guest();
		$this->load->model('madmin');
	}

	public function add_admin() {
		$this->_load_admin_add_view();
	}

	public function create_admin() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('phone_no', 'Phone number', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$this->_load_admin_add_view();
		} else {
			$data['email'] = $this->input->post('email');
			$data['password'] = md5('123456');
			$data['name'] = $this->input->post('name');
			$data['phone_no'] = $this->input->post('phone_no');
			$data['created_at'] = date('Y-m-d H:i:s');
			$data['role'] = 'A';
			$user_id = $this->madmin->create_admin_user($data);
			if ($_FILES['image']['name'] != '') {
				if(file_exists('./upload')){
					 if(file_exists('./upload/'.$user_id)){
					 			$config['upload_path'] = "upload/$user_id/image/";
								$config['allowed_types'] = 'gif|jpg|jpeg|png';
								$config['max_size'] = '1000';
								$config['max_width'] = '1920';
								$config['max_height'] = '1280';
								$config['encrypt_name'] = TRUE;
								$this->load->library('upload', $config);
								if (!$this->upload->do_upload('image')) {
									$erro_msg = $this->upload->display_errors();
									$this->session->set_flashdata('msgtype', 'error');
									$this->session->set_flashdata('msg', $erro_msg);
									redirect(base_url('admin/add_admin'), 'refresh');
								} else {
									$thumbpath="upload/$user_id/image/thumbs/";
									//$imagepath="upload/$user_id/image/";
									$fInfo = $this->upload->data();
									$image = explode('.', $fInfo['file_name']);
									$mid_image = $image[0] . '_mid.' . $image[1];
									$small_image = $image[0] . '_small.' . $image[1];
									$data['profileimage']=$fInfo['file_name'];
									$condition['id']=$user_id;
									$this->madmin->user_update($data,$condition);
									$this->image_thumb($fInfo['full_path'],$thumbpath, $mid_image, 250, 200);
									$this->image_thumb($fInfo['full_path'],$thumbpath, $small_image, 50, 50);
									$data['profileimage'] = $fInfo['file_name'];
									$this->session->set_flashdata('msgtype', 'success');
									$this->session->set_flashdata('msg', 'Admin added successfuly');
									redirect(base_url('admin/get_admin_list'), 'refresh');
								}
					 }else{
					 	if(mkdir('./upload/'.$user_id) && mkdir('./upload/'.$user_id.'/image') && mkdir('./upload/'.$user_id.'/image/thumbs')){
					 		    $config['upload_path'] = "upload/$user_id/image/";
								$config['allowed_types'] = 'gif|jpg|jpeg|png';
								$config['max_size'] = '1000';
								$config['max_width'] = '1920';
								$config['max_height'] = '1280';
								$config['encrypt_name'] = TRUE;
								$this->load->library('upload', $config);
								if (!$this->upload->do_upload('image')) {
									$erro_msg = $this->upload->display_errors();
									$this->session->set_flashdata('msgtype', 'error');
									$this->session->set_flashdata('msg', $erro_msg);
									redirect(base_url('admin/add_admin'), 'refresh');
								} else {
									$thumbpath="upload/$user_id/image/thumbs/";
									//$imagepath="upload/$user_id/image/";
									$fInfo = $this->upload->data();
									$data['profileimage']=$fInfo['file_name'];
									$condition['id']=$user_id;
									$this->madmin->user_update($data,$condition);
									$image = explode('.', $fInfo['file_name']);
									$mid_image = $image[0] . '_mid.' . $image[1];
									$small_image = $image[0] . '_small.' . $image[1];
									$this->image_thumb($fInfo['full_path'],$thumbpath, $mid_image, 250, 200);
									$this->image_thumb($fInfo['full_path'],$thumbpath, $small_image, 50, 50);
									$data['profileimage'] = $fInfo['file_name'];
									$this->session->set_flashdata('msgtype', 'success');
									$this->session->set_flashdata('msg', 'Admin added successfuly');
									redirect(base_url('admin/get_admin_list'), 'refresh');
								}
					 	}else{
					 				$this->session->set_flashdata('msgtype', 'success');
									$this->session->set_flashdata('msg', 'Error in creating image folder');
									redirect(base_url('admin/get_admin_list'), 'refresh');
					 	}
					 }
				}else{
					if(mkdir('./upload')){
						if(mkdir('./upload/'.$user_id)){
							if(mkdir('./upload/'.$user_id.'/image') && mkdir('./upload/'.$user_id.'/image/thumbs')){
								$config['upload_path'] = "upload/$user_id/image/";
								$config['allowed_types'] = 'gif|jpg|jpeg|png';
								$config['max_size'] = '1000';
								$config['max_width'] = '1920';
								$config['max_height'] = '1280';
								$config['encrypt_name'] = TRUE;
								$this->load->library('upload', $config);
								if (!$this->upload->do_upload('image')) {
									$erro_msg = $this->upload->display_errors();
									$this->session->set_flashdata('msgtype', 'error');
									$this->session->set_flashdata('msg', $erro_msg);
									redirect(base_url('admin/add_admin'), 'refresh');
								} else {
									$thumbpath="upload/$user_id/image/thumbs/";
									//$imagepath="upload/$user_id/image/";
									$fInfo = $this->upload->data();
									$data['profileimage']=$fInfo['file_name'];
									$condition['id']=$user_id;
									$this->madmin->user_update($data,$condition);
									$image = explode('.', $fInfo['file_name']);
									$mid_image = $image[0] . '_mid.' . $image[1];
									$small_image = $image[0] . '_small.' . $image[1];
									$this->image_thumb($fInfo['full_path'],$thumbpath, $mid_image, 250, 200);
									$this->image_thumb($fInfo['full_path'],$thumbpath, $small_image, 50, 50);
									$data['profileimage'] = $fInfo['file_name'];
									$this->session->set_flashdata('msgtype', 'success');
									$this->session->set_flashdata('msg', 'Admin added successfuly');
									redirect(base_url('admin/get_admin_list'), 'refresh');
								}
							}else{
								    $this->session->set_flashdata('msgtype', 'success');
									$this->session->set_flashdata('msg', 'image DIR error');
									redirect(base_url('admin/get_admin_list'), 'refresh');
							}
						}else{
									$this->session->set_flashdata('msgtype', 'success');
									$this->session->set_flashdata('msg', 'userid DIR error');
									redirect(base_url('admin/get_admin_list'), 'refresh');
						}
					}else{
									$this->session->set_flashdata('msgtype', 'success');
									$this->session->set_flashdata('msg', 'upload DIR error');
									redirect(base_url('admin/get_admin_list'), 'refresh');
					}
				}
				/*$config['upload_path'] = 'upload/images/admin/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['max_size'] = '1000';
				$config['max_width'] = '1920';
				$config['max_height'] = '1280';
				$config['encrypt_name'] = TRUE;
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('image')) {
					$erro_msg = $this->upload->display_errors();
					$this->session->set_flashdata('msgtype', 'error');
					$this->session->set_flashdata('msg', $erro_msg);
					redirect(base_url('admin/add_admin'), 'refresh');
				} else {
					$fInfo = $this->upload->data();
					$image = explode('.', $fInfo['file_name']);
					$mid_image = $image[0] . '_mid.' . $image[1];
					$small_image = $image[0] . '_small.' . $image[1];
					$this->image_thumb($fInfo['full_path'], $mid_image, 250, 200);
					$this->image_thumb($fInfo['full_path'], $small_image, 50, 50);
					$data['profileimage'] = $fInfo['file_name'];
					$status = $this->madmin->create_admin_user($data);
					if ($status) {
						$this->session->set_flashdata('msgtype', 'success');
						$this->session->set_flashdata('msg', 'Admin added successfuly');
						redirect(base_url('admin/get_admin_list'), 'refresh');
					} else {
						$this->session->set_flashdata('msgtype', 'error');
						$this->session->set_flashdata('msg', 'Error in create admin.Please try again');
						redirect(base_url('admin/add_admin'), 'refresh');
					}
				}*/
			} else {
				//$status = $this->madmin->create_admin_user($data);
				if ($user_id) {
					$this->session->set_flashdata('msgtype', 'success');
					$this->session->set_flashdata('msg', 'Admin added successfuly');
					redirect(base_url('admin/get_admin_list'), 'refresh');
				} else {
					$this->session->set_flashdata('msgtype', 'error');
					$this->session->set_flashdata('msg', 'Error in create admin.Please try again');
					redirect(base_url('admin/add_admin'), 'refresh');
				}
			}
		}
	}

	function image_thumb($source_image,$thumbpath, $new_image_name, $width, $height) {
		$this->load->library('image_lib');
		$config['image_library'] = 'gd2';
		$config['source_image'] = $source_image;
		//$config['new_image'] = 'upload/images/admin/' . $new_image_name;
		$config['new_image'] = $thumbpath.$new_image_name;
		$config['maintain_ratio'] = TRUE;
		$config['height'] = $height;
		$config['width'] = $width;
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
		$this->image_lib->clear();
	}

	public function get_all_admin_list() {
		$data = $this->madmin->all_admin_list();
		echo header('Content-Type: application/json');
		echo json_encode($data);
	}

	public function get_admin_list() {
		// $userlist= $this->madmin->user_list();
		$this->_load_userlist_view();

	}

	public function delete_admin() {
		$user_id = $this->input->post('user_id');
		$status = $this->madmin->user_delete($user_id);
		if ($status) {
			echo 'Admin deleted successfully';
		} else {
			echo 'Error in admin delete';
		}
	}

	public function edit_admin($user_id) {
		$user_details = $this->madmin->get_user_details($user_id);
		$this->_load_useredit_view($user_details);
	}

	public function update_admin_data() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('phone_no', 'Phone number', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$user_id = $this->input->post('user_id');
			$user_details = $this->madmin->get_user_details($user_id);
			$this->_load_useredit_view($user_details);
		} else {
			$condition['id'] = $this->input->post('user_id');
			$data['email'] = $this->input->post('email');
			$data['name'] = $this->input->post('name');
			$data['phone_no'] = $this->input->post('phone_no');
			$this->madmin->user_update($data, $condition);
			$this->session->set_flashdata('msgtype', 'success');
			$this->session->set_flashdata('msg', 'Admin updated successfully');
			redirect(base_url('admin/get_admin_list'), 'refresh');
		}
	}

	public function change_password() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required');
		$user_id = $this->input->post('user_id');
		$password = $this->input->post('password');
		$confirm_password = $this->input->post('confirm_password');
		if ($this->form_validation->run() == FALSE) {
			$user_details = $this->madmin->get_user_details($user_id);
			$this->_load_useredit_view($user_details);
		} else {
			if ($password != $confirm_password) {
				$this->session->set_flashdata('msgtype', 'error');
				$this->session->set_flashdata('msg', 'Password field does not match with confirm password');
				redirect(base_url('admin/edit_admin/' . $user_id));
			} else {
				$condition['id'] = $user_id;
				$data['password'] = md5($password);
				$this->madmin->change_user_password($data, $condition);
				$this->session->set_flashdata('msgtype', 'success');
				$this->session->set_flashdata('msg', 'Password changed successfully');
				redirect(base_url('admin/get_admin_list'));
			}
		}
	}

	private function _load_useredit_view($user_details) {
		$data = array();
		$data['content'] = 'editadmin';
		$data['userdetails'] = $user_details;
		$this->load->view('layouts/index', $data);
	}

	private function _load_userlist_view() {
		$data = array();
		$data['content'] = 'adminlist';
		//$data['users'] = $userlist;
		$this->load->view('layouts/index', $data);
	}

	private function _load_admin_add_view() {
		$data = array();
		$data['content'] = 'addadmin';
		$this->load->view('layouts/index', $data);
	}

}
