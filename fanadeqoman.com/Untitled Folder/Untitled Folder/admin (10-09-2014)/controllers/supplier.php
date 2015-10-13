<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(0);
session_start();
class Supplier extends CI_Controller {

	public function __construct(){
      parent::__construct();
	  $this->load->helper(array('url', 'form', 'date'));
	  $this->load->library('session');
	  $this->load->library('form_validation');
	  $this->load->database(); 
	  $this->load->model('Supplier_Model');  
	   if(empty($_SESSION['lang'])){
			$_SESSION['lang']='english';
	  }
	  $this->lang->load('fi',$_SESSION['lang']);
	}
	/*
	 * Admin going to load supplier list
	 */ 
	function supplier_list($status='')
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['sup_list'] = $this->Supplier_Model->getSuppliers($status);
		$this->load->view('supplier/suppliers_list',$data);	
	}
	/*
	 * Admin going to inactive supplier 
	 */ 
	function Inactive_supplier($sup_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['sup_list'] = $this->Supplier_Model->Inactive_supplier($sup_id);
		redirect('supplier/supplier_list', 'refresh'); 
	}
	/*
	 * Admin going to Active supplier 
	 */ 
	function Active_supplier($sup_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['sup_list'] = $this->Supplier_Model->Active_supplier($sup_id);
		redirect('supplier/supplier_list', 'refresh'); 
	}
	/*
	 * Admin going to load all InActive supplier list
	 */
	function inactive_suppliers()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['sup_list'] = $this->Supplier_Model->inactive_suppliers();
		$this->load->view('supplier/inactive_suppliers',$data);	
	}
	/*
	 * Admin going to Active supplier 
	 */
	function Active_supplier_ad($sup_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['sup_list'] = $this->Supplier_Model->Active_supplier($sup_id);
		redirect('supplier/inactive_suppliers', 'refresh'); 
	}
	/*
	 * Admin going to load only Active suppliers 
	 */
	function active_suppliers()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['sup_list'] = $this->Supplier_Model->active_suppliers();
		$this->load->view('supplier/active_suppliers',$data);	
	}
	/*
	 * Admin going to InActive suppliers 
	 */
	function Inactive_supplier_ad($sup_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['sup_list'] = $this->Supplier_Model->Inactive_supplier($sup_id);
		redirect('supplier/active_suppliers', 'refresh'); 
	}
	/*
	 * Admin going to load add suppliers view page
	 */
	function add_supplier()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotels']=$this->Supplier_Model->getting_all_hotels();
		$data['currency']=$this->Supplier_Model->fetch_currency_val();
		$data['country'] = $this->Supplier_Model->country_list();
		$this->load->view('supplier/add_supplier',$data);	
	}
	/*
	 * Admin going to insert into suppliers details
	 */
	function add_supplier_ad()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		if(isset($_FILES["file"]["name"]) && $_FILES["file"]["size"]>0){
			$upload=ROOT_PATH.$_FILES["file"]["name"];
			move_uploaded_file($_FILES["file"]["tmp_name"],$upload);
		}
		$data=$this->input->post();
		$data['result']=$this->Supplier_Model->add_supplier($data);
		redirect('supplier/supplier_list', 'refresh'); 
	}
	/*
	 * Admin going to load suppliers details view page
	 */
	function edit_supplier($sup_id)
    {
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotels']=$this->Supplier_Model->getting_all_hotels();
		$data['currency']=$this->Supplier_Model->fetch_currency_val();
		$data['country'] = $this->Supplier_Model->country_list();
		$data['result']=$this->Supplier_Model->edit_supplier($sup_id);
		$this->load->view('supplier/edit_supplier',$data);
	}
	/*
	 * Admin going to update suppliers details 
	 */
	function edit_supplier_ad($sup_id)
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
		$data['result']=$this->Supplier_Model->edit_supplier_ad($sup_id,$data);
		redirect('supplier/supplier_list', 'refresh'); 
	}
	/*
	 * Admin going to delete suppliers  
	 */
	function Delete_supplier($sup_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['result']=$this->Supplier_Model->Delete_supplier($sup_id);
		redirect('supplier/supplier_list', 'refresh'); 
	}
	/*
	 * Admin going to check supplier is exits or not  
	 */
	function check_Supplier()
	{
		$data['result']=$this->Supplier_Model->check_Supplier($this->input->post('email'));
		echo $data['result'];exit;
	}
	/*
	 * Admin going to check supplier is exits or not  
	 */
	function check_Supplier_ed()
	{
		$data['result']=$this->Supplier_Model->check_Supplier_ed($this->input->post('email'),$this->input->post('main_email'));
		echo $data['result'];exit;
	}
	
	
	
	
}


