<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fepi extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->redirect_guest();
		$this->load->model('mfepi');
	}

	public function update_data() {
		// ini_set('memory_limit', '-1');
		// $xmldata = simplexml_load_string(file_get_contents('/var/www/html/slate/type2.xml')) or die("Error: Cannot create object");
		// $xml = $this->object_to_array($xmldata);
		// echo '<pre>';print_r($xml); die;
		// $this->mfepi->set_existing_data($xml);die;

		if ($this->input->post('type') != '') {

			ini_set('memory_limit', '-1');
			$type = $this->input->post('type');
			// $type = 'new';
			// echo $type; die;
			$url = 'http://fred.instantoffices.com/fepi/FEPIDatafeed5.aspx';
			$partnerName = 'rightoffices';
			$partnerPassword = 'Madrid55';
			$post_data = array(
				"pname" => $partnerName,
				"password" => $partnerPassword,
				"country" => "GB",
				"types" => "1,2,3,4,5",
				// "types" => "2",
			);
			$ch = curl_init($url);
			$opts[CURLOPT_POST] = true;
			$opts[CURLOPT_POSTFIELDS] = $post_data;
			foreach ($opts as $k => $v) {
				$opts[$k] = $v;
			}
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt_array($ch, $opts);
			$output = curl_exec($ch);
			curl_close($ch);
			$xmldata = simplexml_load_string($output) or die("Error: Cannot create object");
			$xml = $this->object_to_array($xmldata);
			if ($type == 'old') {
				$status = $this->mfepi->set_existing_data($xml);
			} else {
				$status = $this->mfepi->set_new_data($xml);
			}
			if ($status) {
				$result = array(
					'status' => 1,
					'error' => 'Success',
				);
			} else {
				$result = array(
					'status' => 0,
					'error' => 'Error in loading data.Please try again later',
				);
			}
		} else {
			$result = array(
				'status' => 0,
				'error' => 'Invalid request',
			);
		}
		echo header('Content-Type: application/json');
		echo json_encode($result);
		die;
	}

	public function object_to_array($obj) {
		if (is_object($obj)) {
			$obj = (array) $obj;
		}

		if (is_array($obj)) {
			$new = array();
			foreach ($obj as $key => $val) {
				$new[$key] = $this->object_to_array($val);
			}
		} else {
			$new = $obj;
		}
		return $new;
	}
}