<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(0);
session_start();
class Users extends CI_Controller {

	public function __construct(){
      parent::__construct();
	  $this->load->helper(array('url', 'form', 'date'));
	  $this->load->library('session');
	  $this->load->library('form_validation');
	  $this->load->database(); 
	  $this->load->model('Users_Model');  
	   if(empty($_SESSION['lang'])){
			$_SESSION['lang']='english';
	  }
	  $this->lang->load('fi',$_SESSION['lang']);
	}
	/*
	 * admin load all users list
	 */ 
	function users_list()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['users_list'] = $this->Users_Model->getUsers();
		$this->load->view('users/users_list',$data);	
	}
	/*
	 * admin Inactive user
	 */
	function Inactive_users($user_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['users_list'] = $this->Users_Model->Inactive_users($user_id);
		redirect('users/users_list', 'refresh'); 
	}
	/*
	 * admin Active user
	 */
	function Active_users($user_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['users_list'] = $this->Users_Model->Active_users($user_id);
		redirect('users/users_list', 'refresh'); 
	}
	/*
	 * admin delete user
	 */
	function delete_users($user_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['result']=$this->Users_Model->delete_users($user_id);
		redirect('users/users_list', 'refresh'); 
	}
	/*
	 * admin load add user view page
	 */
	function add_users()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['country'] = $this->Users_Model->country_list();
		$this->load->view('users/add_users',$data);
	}
	/*
	 * admin insert user data into database
	 */
	function add_users_ad()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		if(isset($_FILES["file"]["name"]) && $_FILES["file"]["size"]>0){
			$upload=ROOT_PATH.$_FILES["file"]["name"];
			move_uploaded_file($_FILES["file"]["tmp_name"],$upload);
		}
		$data=$this->input->post();
		$data['result']=$this->Users_Model->add_users($data,$_FILES["file"]["name"]);
		redirect('users/users_list', 'refresh'); 
	}
	/*
	 * admin to load edit user page
	 */
	function edit_users($user_id)
    {
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['country'] = $this->Users_Model->country_list();
		$data['result']=$this->Users_Model->edit_users($user_id);
		$this->load->view('users/edit_users',$data);
	}
	/*
	 * admin to load edit user page
	 */
	function edit_users_ad($user_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$img_name='';
		if(isset($_FILES["file1"]["name"]) && $_FILES["file1"]["size"]>0){
			$upload=ROOT_PATH.$_FILES["file1"]["name"];
			move_uploaded_file($_FILES["file1"]["tmp_name"],$upload);
			$img_name=$_FILES["file1"]["name"];
		}else{
			$img_name=$this->input->post('img');
		}
		$data=$this->input->post();
		$data['result']=$this->Users_Model->edit_users_ad($user_id,$data,$img_name);
		redirect('users/users_list', 'refresh'); 
	
	}
}


