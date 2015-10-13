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
		$this->load->view("about/index.php",$data);
	}
	public function contact(){
		
		$this->load->model('database_model');
		$result= $this->database_model->view();
		if($result){
			$data['result'] = $result;
		}else{
			$data['result'] = "no data found in there";
		}
		$this->load->view("contact/index.php",$data);

	}
}