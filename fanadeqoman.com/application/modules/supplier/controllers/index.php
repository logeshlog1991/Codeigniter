<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
session_start();
class Index extends CI_Controller {

	public function __construct(){
      parent::__construct();
	  $this->load->helper(array('url', 'form', 'date'));
	  $this->load->library('session');
	  $this->load->library('form_validation');
	  $this->load->database(); 
	  $this->load->model('admin_model');  
	  if(empty($_SESSION['langA'])){
			$_SESSION['langA']='english';
	  }
	  $this->lang->load('fi',$_SESSION['langA']);
	}
	function change_language()
	{
		$return=0;
		$post=$this->input->post('lang');
		if($post==''){
		}else{
			$_SESSION['langA']=$post;
			$return=1;
		}
		echo $return;exit;
	}
	public function index()
	{
	
		if ($this->session->userdata('supplier_logged_in')) {
			redirect('index/dashboard', 'refresh'); 
		} else {
			redirect('index/login', 'refresh'); 
		}
	}
	public function login()
	{
		if ($this->session->userdata('supplier_logged_in')) {
			redirect('index/dashboard', 'refresh'); 
		}
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email-Id', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ( $this->form_validation->run() !== false ) {
			 // then validation passed. Get from db
			 $this->load->model('admin_model');
			 $res = $this->admin_model->verify_user($this->input->post('email'),$this->input->post('password'));

			 if ( $res !== false ) {
				$sessionUserInfo1 = array( 
				'supplier_id' 		=> $res->supplier_id,
				'admin_name' 		=> $res->name,
				'admin_email'	 	=> $res->email_id,
				 'hotel_id'			=>$res->hotel_id,
				'supplier_logged_in'=> TRUE
				);
				$this->session->set_userdata($sessionUserInfo1);
				
				redirect('index/dashboard', 'refresh'); 
			 } else { $data['fail']=1; }
		} 
		$this->load->view('login',$data);
	}
	
	public function logout()
    {
        $this->session->unset_userdata('sessionUserInfo1');
		$this->session->sess_destroy();
        redirect('index/login', 'refresh'); 
    }
	public function dashboard()
	{
		if (!$this->session->userdata('supplier_logged_in') || $this->session->userdata('supplier_logged_in')=='') {
			redirect('index/login', 'refresh'); 
		} 
		  
	$this->load->view('dashboard');
	}
	
	public function myacc_details() {
		
		if (!$this->session->userdata('supplier_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		
		$data['country'] = $this->admin_model->country_list();
		$data['admin_profile']=$this->admin_model->get_admin_profile($this->session->userdata('supplier_id'));
		$this->load->view('admin/admin_profile',$data); 
		
	}
	
	public function edit_profile() {
		
		if (!$this->session->userdata('supplier_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		if($_POST){
			$data['user_info'] = $this->admin_model->updateSupplierInfo($_POST);
			redirect('index/myacc_details'); 
		}else{
			$supplier_id = $this->session->userdata('supplier_id');
			$data['admin_profile'] = $this->admin_model->getSupplierInfo($supplier_id);
			$this->load->view('admin/edit_profile', $data);
		}
		
	}
	
	public function add_logo(){
		
		if (!$this->session->userdata('supplier_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$user_id = $this->session->userdata('supplier_id');
		if(isset($_FILES['img']['name']) && $_FILES['img']['name']!=''){ 
			$image_name=time().$_FILES["img"]["name"];
		    $path_name= ROOT_PATH.$image_name; 
			 move_uploaded_file($_FILES["img"]["tmp_name"],$path_name);
			 $data['user_info'] = $this->admin_model->supplerHotelLogo($image_name,$user_id);
			 redirect('index/add_logo','refresh'); 
		}else{
			$data['user_info'] = $this->admin_model->getSupplierInfo($user_id);
			$this->load->view('admin/add_logo',$data);
		}
	}
	
	public function change_password()
	{
		if (!$this->session->userdata('supplier_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$this->load->view('admin/change_password');
	}
	
	
		public function change_password_ad()
	{
		if (!$this->session->userdata('supplier_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['admin_details']=$this->input->post();
		$user_id=$this->session->userdata('supplier_id');
		$data['admin_pass']=$this->admin_model->change_password($data['admin_details'],$user_id);
		$this->session->unset_userdata('sessionUserInfo');
		$this->session->sess_destroy();
        redirect('index/login', 'refresh'); 
	}
	
		public function check_pass()
	{
		
		$data['admin_details']=$this->input->post();
		$user_id=$this->session->userdata('supplier_id');
		$data['admin_pass']=$this->admin_model->check_pass($data['admin_details'],$user_id);
		if(isset($data['admin_pass']) && $data['admin_pass']==1){
			echo 'sucess';exit;
		}else{
			echo 'fail';exit;
		}
	}
	
	public function country_markup_value()
	{
		$post=$this->input->post();
		$data['country'] = $this->admin_model->country_markup_value($post);
		echo $data['country'];exit;
	}
	
		public function CCagents_markup_value()
	{
		$post=$this->input->post();
		$data['country'] = $this->admin_model->CCagents_markup_value($post);
		echo $data['country'];exit;
	}
//---------------closing class------------------//
}


