<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller {

	public function index(){
		$value['data'] = "login";
		$value['data_2'] = "signin";
		$this->load->view("site/index.php",$value);
	}
	public function about(){
		
		$this->load->model('site_model');
		$data['result'] = $this->site_model->get_data();
		//$result['data'] = $
		$this->load->view("about/index.php",$data);
	}
}