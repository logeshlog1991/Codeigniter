<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crud extends CI_Controller {

	public function index(){
		if($this->session->userdata('is_log')){
			$this->load->model('crud_model');
			$data['value'] = $this->crud_model->select();
			if($data){
				$this->load->view('crud/index.php',$data);
			}else{
				$this->load->view('crud/index.php');
			}
		}else{
			$this->load->view("login/index.php");
		}	
	}

	public function creat(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('email','Email','required');

		if($this->form_validation->run()){
			$this->load->model('crud_model');			
			$insert = $this->crud_model->insert();
			if($insert){
				$this->index();
			}
		}else{
			$this->load->view("crud/index.php");
		}
	}

	public function delete(){
		$this->load->model('crud_model');
		if($this->crud_model->delete())
		{
			$this->index();
		}else{
			echo "no";
		}
	}

	public function login(){
		$this->load->view("login/index.php");
	}

	public function login_check(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('email','Email','required');

		if($this->form_validation->run()){
			$this->load->model('crud_model');			
			$insert = $this->crud_model->login_check();
			if($insert){
				$data = array(
					'is_log' => 1
					);
				$this->session->set_userdata($data);
				$this->index();
			}else{
				$this->load->view("login/index.php");
			}
		}else{
			$this->load->view("login/index.php");
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		$this->load->view('login/index.php');
	}

}