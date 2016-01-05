<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Centre extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->redirect_guest();
		$this->load->model('mcentre');
	}

	public function get_all_centre_list() {
		$data = $this->mcentre->all_centre_list();
		echo header('Content-Type: application/json');
		echo json_encode($data);
	}

	public function get_centre_list() {
		$this->_load_centrelist_view();
		/* $this->load->library("pagination");
					  $config = array();
			          $config["base_url"] = base_url() . "centre/get_centre_list";
			          $config["total_rows"] = $this->mcentre->record_count();
			          $config["per_page"] = 20;
			          $config["uri_segment"] = 3;
					  $config["num_links"]=10;
					  $this->pagination->initialize($config);
					  $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			          $links = $this->pagination->create_links();
		*/
	}

	public function get_centre_details() {
		$CenterId = $this->input->post('CenterId');
		$centre_details = $this->mcentre->centre_details($CenterId);
		echo header('Content-Type: application/json');
		echo json_encode($centre_details);
	}


	public function edit_centre($CentreId) {
		$centre_details = $this->mcentre->centre_details($CentreId);
		$this->_load_centreedit_view($centre_details);
	}

	public function update_centre_data() {
		$CentreId = $this->input->post('CentreId');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('CentreDescription', 'Centre Description', 'required');
		$this->form_validation->set_rules('OperatorCode', 'Operator Code', 'required');
		$this->form_validation->set_rules('City', 'City', 'required');
		$this->form_validation->set_rules('Address', 'Address', 'required');
		$this->form_validation->set_rules('Postcode', 'Postcode', 'required');
		if ($this->form_validation->run() == FALSE) {
			$centre_details = $this->mcentre->centre_details($CentreId);
			$this->_load_centreedit_view($centre_details);
		} else {
			$data['CentreDescription'] = $this->input->post('CentreDescription');
			$data['OperatorCode'] = $this->input->post('OperatorCode');
			$data['City'] = $this->input->post('City');
			$data['Address'] = $this->input->post('Address');
			$data['Postcode'] = $this->input->post('Postcode');
			$condition['CentreId'] = $CentreId;
			$this->mcentre->update_centre($data, $condition);
			$this->session->set_flashdata('msgtype', 'success');
			$this->session->set_flashdata('msg', 'Centre update successfully done');
			redirect(base_url('centre/get_centre_list'), 'refresh');
		}
	}

	private function _load_centrelist_view() {
		$data = array();
		$data['content'] = 'centrelist';
		//  $data['centres'] = $centrelist;
		//  $data['links'] = $links;
		$this->load->view('layouts/index', $data);
	}

	private function _load_centreedit_view($centre_details) {
		$data = array();
		$data['centre_details'] = $centre_details;
		$data['content'] = 'editcentre';
		$this->load->view('layouts/index', $data);
	}

}
