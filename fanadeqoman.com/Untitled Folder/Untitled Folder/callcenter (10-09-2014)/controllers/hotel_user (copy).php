<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(0);
session_start();
class Hotel_user extends CI_Controller {

	public function __construct(){
      parent::__construct();
	  $this->load->helper(array('url', 'form', 'date'));
	  $this->load->library('session');
	  $this->load->library('form_validation');
	  $this->load->database(); 
	  $this->load->model('Account_model');  
	  $this->sess_id = $this->session->userdata('session_id');
	}
	
	function my_booking() {
		
		if (!$this->session->userdata('callcenter_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$user_id=$this->session->userdata('user_id');
		$data['result']=$this->Account_model->my_booking($user_id);
		$this->load->view('mybooking',$data);
	}
	
	function cancel_booking($book_id) {
		
		$this->Account_model->cancel_booking($book_id);
		redirect('hotel_user/my_booking','refresh');
	}
	
	
//-------------closing controller class-----------//

  }
