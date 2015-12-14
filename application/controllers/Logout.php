<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('muser');
	}

	public function index() {
		$this->session->sess_destroy();
		redirect('login','refresh');
	}
}