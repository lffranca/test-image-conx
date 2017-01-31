<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url', "file"));
	}

	public function index() {
		$this->load->view('upload_form', array('error' => ' ' ));
	}

	public function update_db_user_info($imgdata) {
       $imgdata = file_get_contents($imgdata['full_path']);

	   echo $imgdata;
   } 

	public function do_upload() {
		$config['upload_path']          = '/home/devolus/Applications/laravel/test-image-conx/storage/app/images/';
		$config['allowed_types']        = 'gif|jpg|png';
		// $config['max_size']             = 100;
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('foto')) {
			$error = array('error' => $this->upload->display_errors());

			// $this->load->view('upload_form', $error);
			var_dump($error);
		} else {
			$data = array('upload_data' => $this->upload->data());

			$imgdata = file_get_contents($data['upload_data']['full_path']);

			delete_files($data['upload_data']['full_path']);

			echo $imgdata;
		}
	}
	
}
