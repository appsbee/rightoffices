<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->redirect_guest();
		$this->load->model('mdashboard');
	}

	public function index() {
		$this->_load_dashboard_view();
	}

	private function _load_dashboard_view() {
		$data = array();
		$data['content'] = 'dashboard';
		$this->load->view('layouts/index', $data);
	}
}