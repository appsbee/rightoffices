<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->redirect_guest();
		$this->load->model('mdashboard');
        $this->load->model('mclient');
	}

	public function index() {
        $top_five_user=$this->mclient->last_five_user();
        // echo '<pre>'; print_r($top_five_user);die;
		$this->_load_dashboard_view($top_five_user);
	}

	private function _load_dashboard_view($top_five_user) {
		$data = array();
        $data['users'] = $top_five_user;
		$data['content'] = 'dashboard';
		$this->load->view('layouts/index', $data);
	}
}