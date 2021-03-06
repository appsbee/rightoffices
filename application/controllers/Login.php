<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('muser');
	}

	public function index() {
		if ($this->input->post()) {
			/* Set the validation rules */
			$this->form_validation->set_rules('email', '"Email"', 'trim|required|valid_email');
			$this->form_validation->set_rules('password', '"Password"', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$this->_load_login_view();
			} else {
				$email = $this->input->post('email', true);
				$password = $this->input->post('password', true);
				$userdata = $this->muser->user_check($email, $password);

				if (empty($userdata)) {
					$this->session->set_flashdata('error_msg', 'Invalid Credential');
					$this->_load_login_view();
				} else {
					// $this->session->set_userdata('login_check', 'true');
					$this->session->set_userdata('admin', $userdata);
					/*$data['content'] = 'dashboard';
					$this->load->view('layouts/dashboard', $data);*/
					redirect('dashboard','refresh');
				}	
			}
		} else {
			$this->_load_login_view();
		}
	}

	public function _load_login_view() {
		$data = array();
		$data['content'] = 'login';
		$this->load->view('layouts/login', $data);
	}
}
