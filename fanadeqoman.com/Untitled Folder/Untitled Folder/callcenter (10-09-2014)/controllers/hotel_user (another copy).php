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
	  $this->load->model('Hotel_Model');  
	  $this->sess_id = $this->session->userdata('session_id');
	  if(empty($_SESSION['lang'])){
			$_SESSION['lang']='english';
	  }
	  $this->lang->load('fi',$_SESSION['lang']);
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
	
		function contact() {
		
		 $res=$this->Account_model->insert_contact($_POST);
		 if($res) {
			$fromemail=$_POST['email'];
			$data['message1']=$_POST['message'];
			$data['contact']=$_POST['contact'];
			$data['name']=$_POST['name'];
			$data['email']=$_POST['email'];
			$toemail="fanadeqoman2702@gmail.com";
			$subject = 'Request Message from customer ';

			$message = $this->load->view('mail_contact_us',$data,TRUE);

			// To send HTML mail, the Content-type header must be set
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

			// Additional headers
			$headers .= 'To:'.  $toemail ."\r\n";
			$headers .= 'From:'.$fromemail. "\r\n";
			// Mail it
			$sendmail=mail($toemail, $subject, $message, $headers); 
			 echo  "1";
		}
	}
	
	function print_cancelVoucher(){ 
		$hotel_id=$this->uri->segment(3);
		$sup_rate_id=$this->uri->segment(4);
		$booking_id=$this->uri->segment(5);
		$data['hotel_info']=$this->Account_model->get_cancelVocher($hotel_id,$sup_rate_id,$booking_id);
		//add cancel chrarge to callcenter agent
		$agent_id=$this->session->userdata('user_id');
		$this->Account_model->add_cancelamt($agent_id,$booking_id);
		redirect('hotel_user/cancelVoucher/'.$hotel_id.'/'.$booking_id);
	}
	
	function cancelVoucher()
	{ 
		$hotel_id=$this->uri->segment(3);
		$booking_id=$this->uri->segment(4);
		$data['hotel_info']=$this->Hotel_Model->get_hotel($hotel_id);
		$data['book_info']=$this->Hotel_Model->get_bookhotel($booking_id);
		$toemail= $data['book_info']->customer_email;;
	    $fromemail='fanadeqoman.support@provabextranet.com';
		$subject = 'Cancelltion Voucher from fanadeqoman';
		$message = $this->load->view('cancel_voucher',$data,TRUE);
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		// Additional headers
		$headers .= 'To:'.  $toemail ."\r\n";
		$headers .= 'From:'.$fromemail. "\r\n";
		// Mail it
		$sendmail=mail($toemail, $subject, $message, $headers);
		//$this->load->view('cancel_voucher',$data);
		redirect('hotel_user/my_booking');
	}
	
	
//-------------closing controller class-----------//

  }
