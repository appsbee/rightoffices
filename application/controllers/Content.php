<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Content extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->redirect_guest();
        $this->load->model('mcontent');
    }
    public function get_content_list(){
        $this->_load_contentlist_view();
    }
    public function get_all_content_list(){
        $data=$this->mcontent->all_content_list();
        echo json_encode($data);  
    }
    public function edit_content($id){
        $content_details=$this->mcontent->get_content_details($id);
        $this->_load_contentedit_view($content_details);
    }
    public function update_content_data(){
        $id=$this->input->post('id');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title','Title','required');
        $this->form_validation->set_rules('description','Description','required');
         if ($this->form_validation->run() == FALSE){
            $content_details=$this->mcontent->get_content_details($id);
            $this->_load_contentedit_view($content_details);
         }else{
              $condition['id']=$id;
              $data['title']=$this->input->post('title');
              $data['description']=$this->input->post('description');
              $this->mcontent->content_update($data,$condition);
              $this->session->set_flashdata('msgtype', 'success');
              $this->session->set_flashdata('msg', 'Content updated successfully');
              redirect(base_url('content/get_content_list'),'refresh');
          }
    }
    public function delete_content(){
        $id=$this->input->post('id');
        $status=$this->mcontent->content_delete($id);
        if($status){
            echo 'Content deleted successfully';
        }else{
            echo 'Error in content delete';
        }
    }
    public function _load_contentlist_view(){
        $data=array();
        $data['content']='contentlist';
        $this->load->view('layouts/index', $data);
    }
    public function _load_contentedit_view($content_details){
        $data=array();
        $data['content']='editcontent';
        $data['content_details']=$content_details;
        $this->load->view('layouts/index', $data);
    }
}
