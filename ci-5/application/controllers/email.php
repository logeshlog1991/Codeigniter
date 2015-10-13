<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email extends CI_Controller {

	public function index(){
		$this->load->view('email/index.php');
	}

	public function send(){

		$this->load->library('form_validation');

		$this->form_validation->set_rules('name','NAME','required');
		$this->form_validation->set_rules('email','EMAIL','required');

		if($this->form_validation->run()){

			$data = array(
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email')
			);

			$this->load->model('email_model');
			$check = $this->email_model->add($data);
			if($check){
				echo "inserted";
			}else{
				echo "not inserted";
			}

		}else{
			$this->load->view("email/index.php");	
		}
		

/*		$config = array(
			'protcol' => 'SMTP',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => '',
			'smtp_pass' => ''
		);
		$this->load->library('email',$config);*/
	}
}