<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(0);
session_start();
class Index extends CI_Controller {

	public function __construct(){
      parent::__construct();
	  $this->load->helper(array('url', 'form', 'date'));
	  $this->load->library('session');
	  $this->load->library('form_validation');
	  $this->load->database(); 
	  $this->load->model('Callcenter_Model'); 
	}
	/*
	 *Admin login page 
	 */
	public function index()
	{ 
		if ($this->session->userdata('callcenter_logged_in')) {
			redirect('hotel/index', 'refresh'); 
		} else {
			redirect('index/login', 'refresh'); 
		}
	}
	
	/*
	 *call center login checking 
	 */
	public function login()
	{
		
		if ($this->session->userdata('callcenter_logged_in')) {
			redirect('hotel/index', 'refresh'); 
		}	
		$data['fail']='';
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email-Id', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() !== false ) {
			 $res = $this->Callcenter_Model->verify_user($this->input->post('email'),$this->input->post('password'));
			 if ( $res !== false ) {
				$sessionUserInfo = array( 
					'user_id' 				=> $res->callagent_id,
					'username' 				=> $res->name,
					'email'	 				=> $res->email_id,
					'login_status =>'		=>1,
					'user_type'      		=>"callcenter",
					'callcenter_logged_in' 	=> TRUE
				);
				$this->session->set_userdata($sessionUserInfo);
				redirect('hotel/index', 'refresh'); 
			 }else{
				$data['fail']=1;
			 }
		} 
		$this->load->view('login',$data);
	}
	
	/*
	 *call center logout
	 */
	public function logout()
    {
        $this->session->unset_userdata('sessionUserInfo');
		$this->session->sess_destroy();
        redirect('index/login', 'refresh'); 
    }
	 
//-----------closing class---------------//
}


