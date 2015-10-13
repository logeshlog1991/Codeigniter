<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
session_start();
class Hotel_book extends CI_Controller {

	public function __construct(){
      parent::__construct();
	  $this->load->helper(array('url', 'form', 'date'));
	  $this->load->library('session');
	  $this->load->library('form_validation');
	  $this->load->database(); 
	  $this->load->model('Hotel_Model');  
	  $this->sess_id = $this->session->userdata('session_id');
	  if(empty($_SESSION['lang'])){
			$_SESSION['lang']='english';
	  }
	  $this->lang->load('fi',$_SESSION['lang']);
	}
	public function pre_booking()
	{ 
		if (!$this->session->userdata('callcenter_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['details']=$this->input->post();
		$this->load->view('prebooking',$data);
	}
}

