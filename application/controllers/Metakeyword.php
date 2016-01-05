<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metakeyword extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->redirect_guest();
		$this->load->model('mmetakeyword');
		// $this->load->model('mcontent');
		$this->load->model('mpage');
	}

	public function get_all_metakeyword_list() {
		$data = $this->mmetakeyword->metakeyword_list();
		echo header('Content-Type: application/json');
		echo json_encode($data);
	}

	public function get_metakeyword_list() {
		$this->_load_metakeyword_view();
	}

	public function add_metakeyword() {
		$content_pagelist = $this->mpage->all_page_list();
		$this->_load_add_metakeyword_view($content_pagelist);
	}

	public function delete_metakeyword() {
		$id = $this->input->post('id');
		$status = $this->mmetakeyword->metakeyword_delete($id);
		if ($status) {
			echo 'Metakeyword deleted successfully';
		} else {
			echo 'Error in delete metakeyword';
		}
	}

	public function edit_metakeyword($id) {
		$page_meta_detail = $this->mmetakeyword->page_metakey_details($id);
		//$content_pagelist=$this->mcontent->all_content_page_list();
		$content_pagelist = $this->mpage->all_page_list();
		$this->_load_edit_metakeyword_view($content_pagelist, $page_meta_detail);
	}

	public function add_metakeyword_details() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('pagename', 'Pagename', 'required');
		$this->form_validation->set_rules('keyword[]', 'Keyword', 'required');
		$this->form_validation->set_rules('content[]', 'Content', 'required');
		if ($this->form_validation->run() == FALSE) {
			$content_pagelist = $this->mpage->all_page_list();
			$this->_load_add_metakeyword_view($content_pagelist);
		} else {
			$pagename = $this->input->post('pagename');
			$keywords = $this->input->post('keyword');
			$contents = $this->input->post('content');
			$this->mmetakeyword->add_meta_keywords($pagename, $keywords, $contents);
			$this->session->set_flashdata('msgtype', 'success');
			$this->session->set_flashdata('msg', 'Metakeyword added successfully');
			redirect(base_url('metakeyword/get_metakeyword_list'), 'refresh');
		}
	}

	public function update_metakeyword_details() {
		$id = $this->input->post('pageid');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('pagename', 'Pagename', 'required');
		$this->form_validation->set_rules('keyword[]', 'Keyword', 'required');
		$this->form_validation->set_rules('content[]', 'Content', 'required');
		if ($this->form_validation->run() == FALSE) {
			$page_meta_detail = $this->mmetakeyword->page_metakey_details($id);
			//$content_pagelist=$this->mcontent->all_content_page_list();
			$content_pagelist = $this->mpage->all_page_list();
			$this->_load_edit_metakeyword_view($content_pagelist, $page_meta_detail);
		} else {
			$pagename = $this->input->post('pagename');
			$keywords = $this->input->post('keyword');
			$contents = $this->input->post('content');
			$this->mmetakeyword->metakeyword_delete($id);
			$this->mmetakeyword->add_meta_keywords($pagename, $keywords, $contents);
			$this->session->set_flashdata('msgtype', 'success');
			$this->session->set_flashdata('msg', 'Metakeyword updated successfully');
			redirect(base_url('metakeyword/get_metakeyword_list'), 'refresh');
		}
	}

	private function _load_metakeyword_view() {
		$data = array();
		$data['content'] = 'metakeywordlist';
		$this->load->view('layouts/index', $data);
	}

	private function _load_add_metakeyword_view($content_pagelist) {
		$data = array();
		$data['content_pagelist'] = $content_pagelist;
		$data['content'] = 'addmetakeyword';
		$this->load->view('layouts/index', $data);
	}

	private function _load_edit_metakeyword_view($content_pagelist, $page_meta_detail) {
		$data = array();
		$data['content_pagelist'] = $content_pagelist;
		$data['page_meta_detail'] = $page_meta_detail;
		$data['content'] = 'editmetakeyword';
		$this->load->view('layouts/index', $data);
	}

}
