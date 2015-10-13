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
		if(empty($this->session->userdata('lang'))){
			$this->session->set_userdata(array('lang'=>'english'));
		}else{
			//echo $_SESSION['lang'];exit;
		}
		$this->lang->load('fi',$this->session->userdata('lang'));
	}
	public function pre_booking()
	{
		$data['details']=$this->input->post();
		$this->load->view('prebooking',$data);
	}
}

