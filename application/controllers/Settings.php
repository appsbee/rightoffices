<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->redirect_guest();
		$this->load->model('madmin');
	}
	public function index() {
		$user = $this->session->userdata('admin');
		$admin_details = $this->madmin->get_user_details($user['id']);
		$this->_load_adminedit_view($admin_details);
	}

	public function update_admin_data() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('phone_no', 'Phone number', 'trim|required');
		$user_id = $this->input->post('user_id');
		if ($this->form_validation->run() == FALSE) {
			$user_details = $this->madmin->get_user_details($user_id);
			$this->_load_adminedit_view($user_details);
		} else {
			$loginuser = $this->session->userdata('admin');
			$condition['id'] = $user_id;
			$data['name'] = $this->input->post('name');
			$data['phone_no'] = $this->input->post('phone_no');

			if ($_FILES['image']['name'] != '') {

				/*if (!is_dir('.upload')) {
						mkdir('./upload');
					}

					if (!is_dir('.upload/' . $user_id)) {
						mkdir('.upload/' . $user_id);
					}

					if (!is_dir('upload/' . $user_id . '/image/')) {
						mkdir('upload/' . $user_id . '/image/');
					}

					if (!is_dir('upload/' . $user_id . '/image/thumbs/')) {
						mkdir('upload/' . $user_id . '/image/thumbs/');
				*/

				$struct = 'upload/' . $user_id . '/image/thumbs/';
				if (!is_dir($struct)) {
					if (!mkdir($struct, 0755, true)) {
						die('could not create folders');
					}
				}

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
					redirect(base_url('settings'), 'refresh');
				} else {
					$thumbpath = "upload/$user_id/image/thumbs/";
					$fInfo = $this->upload->data();
					$image = explode('.', $fInfo['file_name']);
					$mid_image = $image[0] . '_mid.' . $image[1];
					$small_image = $image[0] . '_small.' . $image[1];
					$data['profileimage'] = $fInfo['file_name'];
					$this->madmin->user_update($data, $condition);
					$this->image_thumb($fInfo['full_path'], $thumbpath, $mid_image, 250, 200);
					$this->image_thumb($fInfo['full_path'], $thumbpath, $small_image, 50, 50);
					if (!empty($loginuser['profileimage'])) {
						$this->madmin->delete_image($loginuser['profileimage'], $user_id);
					}
					$userdata = $this->madmin->get_user_details($user_id);
					$this->session->set_userdata('admin', $userdata);
					$this->session->set_flashdata('msgtype', 'success');
					$this->session->set_flashdata('msg', 'Settings updated successfuly');
					redirect(base_url('settings'), 'refresh');
				}
			} else {
				$this->madmin->user_update($data, $condition);
				$userdata = $this->madmin->get_user_details($user_id);
				$this->session->set_userdata('admin', $userdata);
				$this->session->set_flashdata('msgtype', 'success');
				$this->session->set_flashdata('msg', 'Settings updated successfuly');
				redirect(base_url('settings'), 'refresh');
			}
		}
	}

	private function image_thumb($source_image, $thumbpath, $new_image_name, $width, $height) {
		$this->load->library('image_lib');
		$config['image_library'] = 'gd2';
		$config['source_image'] = $source_image;
		//$config['new_image'] = 'upload/images/admin/' . $new_image_name;
		$config['new_image'] = $thumbpath . $new_image_name;
		$config['maintain_ratio'] = TRUE;
		$config['height'] = $height;
		$config['width'] = $width;
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
		$this->image_lib->clear();
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
			$this->_load_adminedit_view($user_details);
		} else {
			if ($password != $confirm_password) {
				$this->session->set_flashdata('msgtype', 'error');
				$this->session->set_flashdata('msg', 'Password field does not match with confirm password');
				redirect(base_url('settings' . $user_id), 'refresh');
			} else {
				$condition['id'] = $user_id;
				$data['password'] = md5($password);
				$this->madmin->change_user_password($data, $condition);
				$this->session->set_flashdata('msgtype', 'success');
				$this->session->set_flashdata('msg', 'Password changed successfully');
				redirect(base_url('settings' . $user_id), 'refresh');
			}
		}
	}

	private function _load_adminedit_view($admin_details) {
		$data = array();
		$data['admin_details'] = $admin_details;
		$data['content'] = 'edit_admin_settings';
		$this->load->view('layouts/index', $data);
	}
}
