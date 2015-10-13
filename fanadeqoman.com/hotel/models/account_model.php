<?php
class Account_model extends CI_Model {
	
	public function __construct()
    {
      parent::__construct();
    }
    
    function check_user($email)
	{
		$select = "SELECT * FROM users where email='".$email."'";
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return 1;
		} else {
			return '';	
		}
	}
	
	function add_user($user_details,$filename)
	{ 
		$data = array('first_name'=> $user_details['first_name'],'last_name' => $user_details['last_name'],'email' => $user_details['email'],
		'contact_number' => $user_details['contact'],'password' => $user_details['password'],'address' => $user_details['address'],
		'country' => $user_details['country'],'city' => $user_details['city'],'postal_code' => $user_details['postcode'],
		'state' => $user_details['state'],'image' => $filename,'user_type' => 1,'status' => 1
		);	
		$this->db->insert('users', $data);
		$id = $this->db->insert_id();	
		$data1 = array('user_id' => 'FOU'.$id );
		$this->db->where('prim_uid',$id);
		$this->db->update('users	', $data1);
		
		if(!empty($id)){		
			return true;
		} else {
			return false;
		}
	}
	
	function country_list()
    {
		$que="select * from  country";
		$query= $this->db->query($que);
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	
	function send_email($f_name='',$l_name='',$subject='',$to='',$message_header='',$message='') {	
		
	 $message1 ='Dear '.$f_name.' '.$l_name.',<br><br>'; 
	 $message1 .= 'Greetings From fanadaquoman.com<br>';			 
	 $message1 .= $message;
	 $message1 .= '<br><br>Best regards, <br>Team Fanadaqouman';
	 $data['message']= $message1;
	 $data['message_header']= $message_header;
	 $body = $this->load->view('email',$data,true);
	 $fromemail='support@fanadaqouman.com';
		 $headers  = 'MIME-Version: 1.0' . "\r\n";
		 $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		 // Additional headers
		 $headers .= 'To:'.  $to ."\r\n";
			$headers .= 'From:'.$fromemail. "\r\n";
			// Mail it
		$sendmail=mail($to, $subject, $body, $headers);	
			if($sendmail)  {		
				return true;
			} 		 
	 }
	 
	 public function check_user_login($email,$password){

		$this->db->select('*')
				 ->from('users')
				 ->where('email', $email)
				 ->where('password',$password)
				 ->where('status', 1)
				 ->limit(1);
		$query = $this->db->get();
		return $query->row();
	}
	
	public function emailExistingCheck($email){
		
		$this->db->select('*')
				 ->from('users')
				 -> where('email',$email);
		$query = $this->db->get();		
		if ($query->num_rows() > 0)
		{
			return true;
		} else {
			return false;	
		}

	}
	
	public function updatepassword($password,$email){

		$data = array(
               'password' => $password               
            );

		$this->db->where('email',$email);
		$this->db->update('users', $data); 

	}
	
	 public function send_email_forgetpass($subject='',$to='',$message_header='',$message='') {
		 
		 $message1 = 'Greetings From Fanadquoman<br>';			 
		 $message1 .= $message;
		 $message1 .= '<br><br>Best regards, <br>Team Fanadquoman';
		 $data['message']= $message1;
		 $data['message_header']= $message_header;
		 $body = $this->load->view('email',$data,true);
		 $fromemail='support@fanadaqouman.com';
		 $headers  = 'MIME-Version: 1.0' . "\r\n";
		 $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		 // Additional headers
		 $headers .= 'To:'.  $to ."\r\n";
			$headers .= 'From:'.$fromemail. "\r\n";
			// Mail it
		$sendmail=mail($to, $subject, $body, $headers);
		
			if($sendmail)  {		
				return true;
			} 
	}
		
	public function my_booking($agent_id) { 
		$sql="SELECT * FROM booking_info WHERE agent_id='$agent_id' order by sno desc";
		$query=$this->db->query($sql);
		if($query->num_rows()>0) {
			return $query->result();
		} else {
			return '';
		}
	}
		
    public function insert_contact($detail) {
		$data = array(
			'name' => $detail['name'] ,
			'email' => $detail['email'] ,
			'contact_num' => $detail['contact'] ,
			'message'=>$detail['message'],
			'date'=> date("Y-m-d").' '.date("h:i:sa")
		);
		$this->db->insert('contact_us', $data); 
		return true;
    }
   
   	function get_cancelVocher($hotel_id,$sup_rate_id,$booking_id)
	{
		$this->db->select('*')
				  ->from('booking_info')
				  ->where('booking_id',$booking_id)
				  ->where('hotel_id',$hotel_id)
				  ->where('sup_ratetacktics_id',$sup_rate_id);
		 $query=$this->db->get();
		 if($query->num_rows()>0){
			$book_details=$query->row();
			//free the room
			$startDate = strtotime($book_details->customer_checkin);
			$endDate = strtotime($book_details->customer_checkout);
		
			$i=0;$j=0;
			while ($startDate < $endDate) {
				$startsDate = date("Y-m-d",strtotime('+0 day', $startDate));
				$startDate  = strtotime('+1 day', $startDate);
		
				$this->db->select('*')
						 ->from('sup_apart_maintain_month')
						 ->where('date',$startsDate)
						 ->where('hotel_id',$book_details->hotel_id);
				$query=$this->db->get();
				$rooms=$query->row()->available_rooms+$book_details->coustomer_room;
				
				$data = array('available_rooms' => $rooms);
				$where = "date = '".$startsDate."' && hotel_id= '".$book_details->hotel_id."'";
				$this->db->update('sup_apart_maintain_month', $data, $where);
			}
			$today_date=strtotime(date("d-m-Y"));
			$startDatess = strtotime($book_details->customer_checkin);
			$update_price=0;$markup=$book_details->customer_finalcost;$gateway=0;
			if($today_date < $startDatess){
				//update amount
				$gateway_Amount=$book_details->gateway/100*$book_details->room_baseprice;
				$update_price=$book_details->customer_finalcost-($gateway_Amount);
			}
			$data = array('customer_canceltotal' => $update_price,'status'=>2,'cancel_bookdate'=>date("Y-m-d h:i:s"),'cancelmarkup_amt' =>$gateway_Amount);
			$where = "booking_id = '".$booking_id."' && hotel_id= '".$hotel_id."'";
			$this->db->update('booking_info', $data, $where);
		 }else{
			return '';
		 }
	}
//--------closing class------------//
 
  }
