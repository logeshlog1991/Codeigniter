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
	  $this->load->model('Hotel_Model');  
	  $this->load->library('email');
	  if(empty($_SESSION['lang'])){
			$_SESSION['lang']='english';
	  }
	  $this->lang->load('fi',$_SESSION['lang']);
	}
	function change_language()
	{
		$return=0;
		$post=$this->input->post('lang');
		if($post==''){
		}else{
			$_SESSION['lang']=$post;
			$return=1;
		}
		echo $return;exit;
	}
	/*
	 *Admin login page 
	 */
	public function index()
	{
		
		if ($this->session->userdata('admin_logged_in')) {
			redirect('index/dashboard', 'refresh'); 
		} else {
			redirect('index/login', 'refresh'); 
		}
	}
	/*
	 *Admin login checking 
	 */
	public function login()
	{
		if ($this->session->userdata('admin_logged_in')) {
			redirect('index/dashboard', 'refresh'); 
		}
		$data['fail']='';
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email-Id', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ( $this->form_validation->run() !== false ) {
			 $this->load->model('admin_model');
			 $res = $this->admin_model->verify_user($this->input->post('email'),$this->input->post('password'));
			 if ( $res !== false ) {
				$sessionUserInfo = array( 
				'user_id' 		=> $res->user_id,
				'firstname' 	=> $res->firstname,
				'lastname'	 	=> $res->lastname,
				'email'	 		=> $res->email,
				'admin_logged_in' 	=> TRUE
				);
				$this->session->set_userdata($sessionUserInfo);
				redirect('index/dashboard', 'refresh'); 
			 }else{
				$data['fail']=1;
			 }
		} 
		
		$this->load->view('login',$data);
	}
	/*
	 *Admin logout
	 */
	public function logout()
    {
        $this->session->unset_userdata('sessionUserInfo');
		$this->session->sess_destroy();
        redirect('index/login', 'refresh'); 
    }
    /*
	 *Admin dash board
	 */
	public function dashboard()
	{
		if (!$this->session->userdata('admin_logged_in') || $this->session->userdata('admin_logged_in')=='') {
			redirect('index/login', 'refresh'); 
		} 
		   
	$this->load->view('dashboard');
	}
	/*
	 *Admin go profile view page
	 */
	public function profile($id='')
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$this->load->model('admin_model');
		$data['country'] = $this->admin_model->country_list();
		$data['admin_profile']=$this->admin_model->get_admin_profile($this->session->userdata('user_id'));
		$data['id']=$id;
		$this->load->view('admin/admin_profile',$data);
	}
	/*
	 *Admin update his profile 
	 */
	public function update_profile()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$img='';
		if($_POST['profile_pic']!=''){
			$img=$_POST['profile_pic'];
		}
		if($_FILES['img']['size']>0){
			$upload=ROOT_PATH.$_FILES["img"]["name"];
			move_uploaded_file($_FILES["img"]["tmp_name"],$upload);
			$img=$_FILES["img"]["name"];
		}
		
		$data['admin_details']=$this->input->post();
		$this->load->model('admin_model');
		$data['admin_profile']=$this->admin_model->update_profile($data['admin_details'],$img);
		redirect('index/profile/1', 'refresh'); 
	}
	/*
	 *Admin going change password view page 
	 */
	public function change_password()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$this->load->view('admin/change_password');
	}
	/*
	 *Admin going to update password 
	 */
	public function change_password_ad()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['admin_details']=$this->input->post();
		$user_id=$this->session->userdata('user_id');
		$this->load->model('admin_model');
		$data['admin_pass']=$this->admin_model->change_password($data['admin_details'],$user_id);
		if(isset($data['admin_pass']) && $data['admin_pass']!=''){
			$this->email->from('support@fanadeqoman.com');
			//~ $this->email->to($data['admin_pass']->email);
			$this->email->to('hamudiz@hotmail.com');
			$this->email->subject('New Password');
			$this->email->message('Username :'.$data['admin_pass']->email.',   Password :'.$data['admin_pass']->password.'.');
			$this->email->send();
		}
		$this->session->unset_userdata('sessionUserInfo');
		$this->session->sess_destroy();
        redirect('index/login', 'refresh'); 
	}
	/*
	 *Admin going to check password is correct or not 
	 */
	public function check_pass()
	{
		
		$data['admin_details']=$this->input->post();
		$user_id=$this->session->userdata('user_id');
		$this->load->model('admin_model');
		$data['admin_pass']=$this->admin_model->check_pass($data['admin_details'],$user_id);
		if(isset($data['admin_pass']) && $data['admin_pass']==1){
			echo 'sucess';exit;
		}else{
			echo 'fail';exit;
		}
	}
	/*
	 *Admin going to load global settings view page 
	 */
	public function global_settings()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['currnecy'] = $this->admin_model->getCurrencyData();
		$this->load->view('admin/currency_converter',$data);	
	}
	/*
	 *Admin going to inactive particular currency value
	 */
	public function Inactive_currency($cur_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['currnecy'] = $this->admin_model->Inactive_currency($cur_id);
		redirect('index/global_settings', 'refresh'); 
	}
	/*
	 *Admin going to active particular currency value
	 */
	public function Active_currency($cur_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['currnecy'] = $this->admin_model->Active_currency($cur_id);
		redirect('index/global_settings', 'refresh'); 
	}
	/*
	 *Admin going to load edit currency page
	 */
	public function edit_currency($cur_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['currnecy'] = $this->admin_model->edit_currency($cur_id);
		$this->load->view('admin/edit_currency',$data);
	}
	/*
	 *Admin going to update currency 
	 */
	public function update_currency($cur_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$currency_value=$this->input->post('currency_value');
		$data['currnecy'] = $this->admin_model->update_currency($cur_id,$currency_value);
		redirect('index/global_settings', 'refresh'); 
	}
	/*
	 *Admin going to delete currency 
	 */
	public function delete_currency($cur_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['currnecy'] = $this->admin_model->delete_currency($cur_id);
		redirect('index/global_settings', 'refresh'); 
	}
	/*
	 *Admin going to load payment gateway view page
	 */
	public function payment_gateway($id='')
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['id']=$id;
		$this->load->view('admin/payment_charge',$data);
	}
	/*
	 *Admin going to update payment gateway
	 */
	public function update_payment_charge()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$amount=$this->input->post('currency_value');
		$data['currnecy'] = $this->admin_model->update_payment_charge($amount);
		redirect('index/payment_gateway/1', 'refresh'); 
	}
	/*
	 *Admin going to load markup view page
	 */
	public function markup_manager($id='')
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['id']=$id;
		$this->load->view('admin/admin_markup',$data);
	}
	/*
	 *Admin going to update markup 
	 */
	public function update_admin_markup()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$amount=$this->input->post('currency_value');
		$data['currnecy'] = $this->admin_model->update_admin_markup($amount);
		redirect('index/markup_manager/1', 'refresh'); 
	}
	/*
	 *Admin going to load country markup view page
	 */
	public function country_markup($id='')
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['id']=$id;
		$data['country'] = $this->admin_model->country_list();
		$data['country_markup'] = $this->admin_model->country_markup();
		$this->load->view('admin/country_markup',$data);
	}
	/*
	 *Admin going to update country markup 
	 */
	public function update_country_markup()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$post=$this->input->post();
		$data['country'] = $this->admin_model->update_country_markup($post);
		redirect('index/country_markup/1', 'refresh'); 
	}
	/*
	 *Admin going to check country markup alread exits or not
	 */
	public function country_markup_value()
	{
		$post=$this->input->post();
		$data['country'] = $this->admin_model->country_markup_value($post);
		echo $data['country'];exit;
	}
	/*
	 *Admin going to Inactive country markup 
	 */
	public function InActive_country_markup($cur_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['currnecy'] = $this->admin_model->InActive_country_markup($cur_id);
		redirect('index/country_markup', 'refresh'); 
	}	
	/*
	 *Admin going to Active country markup 
	 */
	public function Active_country_markup($cur_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['currnecy'] = $this->admin_model->Active_country_markup($cur_id);
		redirect('index/country_markup', 'refresh'); 
	}
	/*
	 *Admin going to delete country markup 
	 */
	public function delete_country_markup($cur_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['currnecy'] = $this->admin_model->delete_country_markup($cur_id);
		redirect('index/country_markup', 'refresh'); 
	}	
	/*
	 *Admin going to load call center markup 
	 */
	public function call_center_markup($id='')
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['id']=$id;
		$data['callcenter_agents'] = $this->admin_model->callcenter_agents();
		$this->load->view('admin/call_center_markup',$data);
	}
	/*
	 *Admin going to check call center markup alrady exits or not
	 */	
	public function CCagents_markup_value()
	{
		$post=$this->input->post();
		$data['country'] = $this->admin_model->CCagents_markup_value($post);
		echo $data['country'];exit;
	}
	/*
	 *Admin going to update call center markup 
	 */
	public function update_callcenter_markup()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$post=$this->input->post();
		$data['country'] = $this->admin_model->update_callcenter_markup($post);
		redirect('index/call_center_markup/1', 'refresh'); 
	}
	/*
	 *Admin going to Inactive call center markup 
	 */
	public function InActive_callcenter_markup($cur_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['currnecy'] = $this->admin_model->InActive_callcenter_markup($cur_id);
		redirect('index/call_center_markup', 'refresh'); 
	}
	/*
	 *Admin going to Active call center markup 
	 */
	public function Active_callcenter_markup($cur_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['currnecy'] = $this->admin_model->Active_callcenter_markup($cur_id);
		redirect('index/call_center_markup', 'refresh'); 
	}
	/*
	 *Admin going to delete call center markup 
	 */
	public function delete_callcenter_markup($cur_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['currnecy'] = $this->admin_model->delete_callcenter_markup($cur_id);
		redirect('index/call_center_markup', 'refresh'); 
	}
	/*
	 *Admin going to load all call center agents
	 */
	public function callcenter_agentlist($id='')
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['id']=$id;
		$data['callcenter_agents'] = $this->admin_model->callcenter_agents();
		$this->load->view('admin/callcenter_agentlist',$data);
	}	
	/*
	 *Admin going to active call center agents 
	 */
	public function Active_ccagents_list($id='')
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['id']=$id;
		$data['callcenter_agents'] = $this->admin_model->Active_ccagents_list();
		$this->load->view('admin/Active_ccagents_list',$data);
	}	
	/*
	 *Admin going to active call center markup 
	 */	
	public function CCActive_callcenter_markup($cur_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['currnecy'] = $this->admin_model->Active_callcenter_markup($cur_id);
		redirect('index/callcenter_agentlist', 'refresh'); 
	}
	/*
	 *Admin going to Inactive call center markup 
	 */	
	public function CCInActive_callcenter_markup($cur_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['currnecy'] = $this->admin_model->InActive_callcenter_markup($cur_id);
		redirect('index/callcenter_agentlist', 'refresh'); 
	}
	/*
	 *Admin going to delete call center markup 
	 */	
	public function CCdelete_callcenter_markup($cur_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['currnecy'] = $this->admin_model->delete_callcenter_markup($cur_id);
		redirect('index/callcenter_agentlist', 'refresh'); 
	}
	/*
	 *Admin going to inactive call center agents
	 */	
	public function CCInActive_callcenter_markups($cur_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['currnecy'] = $this->admin_model->InActive_callcenter_markup($cur_id);
		redirect('index/Active_ccagents_list', 'refresh'); 
	}
	/*
	 *Admin going to load inactive call center agentslist
	 */	
	public function InActive_ccagents_list($id='')
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['id']=$id;
		$data['callcenter_agents'] = $this->admin_model->InActive_ccagents_list();
		$this->load->view('admin/InActive_ccagents_list',$data);
	}	
	/*
	 *Admin going to  Active call center markup
	 */	
	public function CCActive_callcenter_markups($cur_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['currnecy'] = $this->admin_model->Active_callcenter_markup($cur_id);
		redirect('index/InActive_ccagents_list', 'refresh'); 
	}
	/*
	 *Admin going to  load call center agents view page
	 */	
	public function add_callcenter_agents()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['country'] = $this->admin_model->country_list();
		$data['currency'] = $this->admin_model->getCurrencyData();
		$this->load->view('admin/add_callcenter_agents',$data);
	}
	/*
	 *Admin going to inserting call center agents 
	 */	
	public function callcenter_agents_ad()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$fileimage='';
		if($_FILES){
			$target= ROOT_PATH;
			if(isset($_FILES['file']['name'])){
				move_uploaded_file($_FILES['file']['tmp_name'],$target.$_FILES['file']['name']);
				$fileimage=$_FILES['file']['name'];
			}
		}
		$post=$this->input->post();
		$data['call_centeragents'] = $this->admin_model->callcenter_agents_ad($post,$fileimage);
		redirect('index/callcenter_agentlist', 'refresh'); 
	}
	/*
	 *Admin going to load call center agent edit view page 
	 */	
	public function edit_callcenter_markup($agent_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['agent'] = $this->admin_model->get_agent($agent_id);
		$data['country'] = $this->admin_model->country_list();
		$data['currency'] = $this->admin_model->getCurrencyData();
		$this->load->view('admin/edit_callcenter_agents',$data);
	}
	/*
	 *Admin going to update call center agent 
	 */
	public function editcallcenter_agents_ad($agent_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$fileimage='';
		if($_FILES){
			$target= ROOT_PATH;
			if(isset($_FILES['file']['name'])){
				move_uploaded_file($_FILES['file']['tmp_name'],$target.$_FILES['file']['name']);
				$fileimage=$_FILES['file']['name'];
			}
		}
		$post=$this->input->post();
		$data['call_centeragents'] = $this->admin_model->editcallcenter_agents_ad($post,$fileimage,$agent_id);
		redirect('index/callcenter_agentlist', 'refresh');
	}
	/*
	 *Admin going to load all call center agents credit
	 */
	public function callcenter_creditlist($id='')
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['id']=$id;
		$data['callcenter_agents1'] = $this->admin_model->callcenter_agents();
		$data['callcenter_agents'] = $this->admin_model->callcenter_credits();
		$this->load->view('admin/callcenter_creditlist',$data);
	}
	/*
	 *Admin going to load all call center agents credit
	 */
	public function callcenter_credit()
	{
		$callcenter_credit = $this->admin_model->get_callcenter_credit($_POST['callcenter_id']);
		echo $callcenter_credit;exit;
	}
	/*
	 *Admin going to update callcenter agents credit
	 */
	public function callcenter_credit_Ad($id='')
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$post=$this->input->post();
		$data['callcenter_agents'] = $this->admin_model->update_callcenter_credit($post);
		redirect('index/callcenter_creditlist', 'refresh');
	}
	/*
	 *Admin going to active call center credit 
	 */	
	public function callcenter_credit_active($cur_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['currnecy'] = $this->admin_model->Active_callcenter_markup($cur_id);
		redirect('index/callcenter_creditlist', 'refresh');
	}
	/*
	 *Admin going to Inactive call center credit 
	 */	
	public function callcenter_credit_inactive($cur_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['currnecy'] = $this->admin_model->InActive_callcenter_markup($cur_id);
		redirect('index/callcenter_creditlist', 'refresh');
	}
	
	public function print_voucher() {
		
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_info']=$this->Hotel_Model->get_hotel($this->uri->segment(3));
		$data['book_info']=$this->Hotel_Model->get_bookhotel($this->uri->segment(4));
		$this->load->view('voucher',$data);
	
	}
	public function Star_markup()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$this->load->view('admin/star_markup');
	}
	public function update_star_markup()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_info']=$this->admin_model->update_star_markup($this->input->post());
		redirect('index/Star_markup', 'refresh');
	}
	public function banners()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['banners']=$this->admin_model->get_banners();
		$img_db='';
		if(isset($data['banners'][0]->banner_name) && $data['banners'][0]->banner_name!=''){
			$arr=unserialize($data['banners'][0]->banner_name);
				foreach($arr as $val){
					$img_db=$img_db.$val.',';
				}
		}
		$data['im']=$img_db;
		$this->load->view('admin/banners',$data);
	}
	public function edit_banners($id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		if(isset($_POST['img_db']) && $_POST['img_db']!='' ){
			$ximg=rtrim($_POST['img_db'],",");
			$ximg1=explode(",",$ximg);
			foreach($ximg1 as $val){
				array_push($_FILES['image']['name'],$val);
			}
		}
		$image='';$target= ROOT_PATH;$i=0;$main_image='';
		if (isset($_FILES) && $_FILES!=''){
			$image=serialize($_FILES['image']['name']);
			foreach($_FILES['image']['tmp_name'] as $tmp_name){
				move_uploaded_file($tmp_name,$target.$_FILES['image']['name'][$i]);
				$i++;
			}
		}else{
			$image=$this->input->post('img_db');
		}
		$data['banners']=$this->admin_model->update_banners($id,$image);
		redirect('index/banners', 'refresh');
	}
	public function delete_img()
	{
		$img_main=$this->input->post('img_id');
		$db_id=$this->input->post('db_id');
		$img_db=explode(",",$this->input->post('img_db'));
		$a=array();
		foreach($img_db as $img){
			if($img_main!=$img){
				array_push($a,$img);
			}
		}
		$data['delete_img']=$this->admin_model->delete_img($a,$db_id); 
		exit;
	}
	public function popular_banners()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['banners']=$this->admin_model->get_popular_banners();
		$img_db='';
		if(isset($data['banners'][0]->banner_name) && $data['banners'][0]->banner_name!=''){
			$arr=unserialize($data['banners'][0]->banner_name);
				foreach($arr as $val){
					$img_db=$img_db.$val.',';
				}
		}
		$data['im']=$img_db;
		$this->load->view('admin/popular_banners',$data);
	}
	public function edit_popularBanners($id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		if(isset($_POST['img_db']) && $_POST['img_db']!='' ){
			$ximg=rtrim($_POST['img_db'],",");
			$ximg1=explode(",",$ximg);
			foreach($ximg1 as $val){
				array_push($_FILES['image']['name'],$val);
			}
		}
		$image='';$target= ROOT_PATH;$i=0;$main_image='';
		if (isset($_FILES) && $_FILES!=''){
			$image=serialize($_FILES['image']['name']);
			foreach($_FILES['image']['tmp_name'] as $tmp_name){
				move_uploaded_file($tmp_name,$target.$_FILES['image']['name'][$i]);
				$i++;
			}
		}else{
			$image=$this->input->post('img_db');
		}
		$data['banners']=$this->admin_model->update_popularBanners($id,$image);
		redirect('index/popular_banners', 'refresh');
	}
	public function delete_popularImg()
	{
		$img_main=$this->input->post('img_id');
		$db_id=$this->input->post('db_id');
		$img_db=explode(",",$this->input->post('img_db'));
		$a=array();
		foreach($img_db as $img){
			if($img_main!=$img){
				array_push($a,$img);
			}
		}
		$data['delete_img']=$this->admin_model->delete_popularImg($a,$db_id); 
		exit;
	}
    public function static_pages()
    {
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['banners']=$this->admin_model->get_pages();
		$this->load->view('admin/pages',$data);
	}
	public function add_page()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$this->load->view('admin/add_page');
	}
	public function add_page_ad()
	{
		$data['page']=$this->admin_model->add_page($this->input->post());
		echo $data['page'];exit;
		//redirect('index/static_pages', 'refresh');
	}
	public function Inactive_page($page_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['page']=$this->admin_model->Inactive_page($page_id);
		redirect('index/static_pages', 'refresh');
	}
	public function Active_page($page_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['page']=$this->admin_model->Active_page($page_id);
		redirect('index/static_pages', 'refresh');
	}
	public function delete_page($page_id)
	{
		$data['page']=$this->admin_model->delete_page($page_id);
		redirect('index/static_pages', 'refresh');
	}
	public function edit_page($page_id)
	{
		$data['page']=$this->admin_model->get_page($page_id);
		$this->load->view('admin/edit_page',$data);
	}
	public function update_page_ad($page_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['page']=$this->admin_model->update_page_ad($this->input->post(),$page_id);
		echo $data['page'];exit;
	}
	public function emails()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['email']=$this->admin_model->get_emailManager();
		$this->load->view('admin/email_manager',$data);
	}
	public function add_emailPage()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$this->load->view('admin/add_emailPage');
	}
	public function add_emailPage_ad()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$post=$this->input->post();
		//~ echo '<pre>';
		//~ print_r($post);die;
		$data['email']=$this->admin_model->add_emailPage_ad($post);
		redirect('index/emails', 'refresh');
	}
	public function delete_emailpage($page_id)
	{
		$data['page']=$this->admin_model->delete_emailpage($page_id);
		redirect('index/emails', 'refresh');
	}
	
	public function Inactive_emailpage($page_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['page']=$this->admin_model->Inactive_emailpage($page_id);
		redirect('index/emails', 'refresh');
	}
	public function Active_emailpage($page_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['page']=$this->admin_model->Active_emailpage($page_id);
		redirect('index/emails', 'refresh');
	}
	public function edit_emailpage($page_id)
	{
		$data['page']=$this->admin_model->edit_emailpage($page_id);
		$this->load->view('admin/edit_emailpage',$data);
	}
	public function edit_emailPage_ad($page_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['page']=$this->admin_model->edit_emailPage_ad($this->input->post(),$page_id);
		redirect('index/emails', 'refresh');
	}
//-------------------closing class-----------------//
}


