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
	  if(empty($_SESSION['langH'])){
			$_SESSION['langH']='english';
	  }
	  $this->lang->load('fi',$_SESSION['langH']);
	}
	
	public function registration() {
		$data['country'] = $this->Account_model->country_list();			
		$this->load->view('register',$data);
				
	}
	public function add_user() {
		if(isset($_FILES["image"]["name"]) && $_FILES["image"]["size"]>0){
			$upload=ROOT_PATH.$_FILES["image"]["name"];
			move_uploaded_file($_FILES["image"]["tmp_name"],$upload);
			$filename=$_FILES["image"]["name"];
		} else {
			$filename='user.png';
		}
		$data=$this->input->post();
		$res=$this->Account_model->add_user($data,$filename);
			/****** EMAIL **********/
		 if($res){		 
			 $message = 'Thanks for Registing with fanadeqoman.com';
			 $message .='<table width="100%" border="0" cellspacing="5" cellpadding="5"><tr><td rowspan="3"></td><td rowspan="3" align="left" valign="top"><strong>Email</strong> : '.$data['email'].'<br><strong>Password</strong> : '.$data['password'].'<br></td></tr></table>';				
			 $message_header='User Registration';
			 $subject='Fanadeqoman User Registration';
				$res =	$this->Account_model->send_email($data['first_name'],$data['last_name'],$subject,$data['email'],$message_header,$message);
				redirect('hotel/index','refresh');
		 }else{
				redirect('hotel_user/registration','refresh');
		 }
	}
	public function userlogin(){
				$email = $this->input->post('log_email');
				$password =  $this->input->post('log_pass');
				$remember =  $this->input->post('remember');
				$res = $this->Account_model->check_user_login($email,$password);
					//~ echo $_COOKIE["user_name"];exit;
				if(count($res) >0){
					if($remember==1){
						setcookie("user_name",$email);
						setcookie("password",$password);
						setcookie("check",$remember);
					}else{
						setcookie ("user_name", "", time() - 3600);	
						setcookie ("password", "", time() - 3600);	
						setcookie ("check", "", time() - 3600);	
					}	
					$_SESSION['user_id']  = $res->user_id;
					$_SESSION['email']    = $res->email;
					$_SESSION['username'] = $res->first_name.' '.$res->last_name;
					$_SESSION['user_type']    = "user";
					$_SESSION['mname']    = "yes";
					$_SESSION['login_status']  = 1;
					echo "1";	
				}
	 
	 }
	 public function forgetpass(){
			$email    = $this->input->post('for_email');
			$res_check      = $this->Account_model->emailExistingCheck($email);		
			$password = $this->random_password();
			/****** EMAIL **********/	
			 if($res_check){ 
				$res      = $this->Account_model->updatepassword($password,$email);	 
				 $message = 'System has genarated new password for you ';

				 
				  $message .='<table width="100%" border="0" cellspacing="5" cellpadding="5"><tr>
		 					<td rowspan="3"></td>
							<td rowspan="3" align="left" valign="top">
							<strong>Password</strong> : '.$password.' <br>				
							</td>
							</tr>
							</table>';			
				 $message_header='Forget password';
				 $subject='Fanadquoman Forget Password';						 
				 $res =	$this->Account_model->send_email_forgetpass($subject,$email,$message_header,$message); 
				 echo "1";				
			/****** EMAIL **********/
			}else{
				//$data['msg'] = "Give proper Email";	
				//$this->load->view('forgetpass',$data);	
				echo "0";
			}
	}
	function random_password(){
		$seed = str_split('abcdefghijklmnopqrstuvwxyz'
                 .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                 .'0123456789!@#$%^&*()'); // and any other characters
		shuffle($seed); // probably optional since array_is randomized; this may be redundant
		$rand = '';
		foreach (array_rand($seed, 10) as $k) $rand .= $seed[$k];
		return $rand;
	} 
	public function check_user() {
		$data['result']=$this->Account_model->check_user($this->input->post('email'));
		echo $data['result'];exit;
	}
	
	function sign_out(){
		session_destroy();
		redirect('hotel/index','refresh');
	}
	
	function my_booking() {
		if(!isset($_SESSION['email']) && $_SESSION['email']=='') {
			redirect('hotel','refresh');
		}
		$user_email=$_SESSION['email']; 
		$user_id=$_SESSION['user_id'];
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
		$this->load->view('cancel_voucher',$data);
		//redirect('hotel/booking_details');
	}
	//-------------closing controller class-----------//
}
