<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(0);
session_start();
class Hotel extends CI_Controller {
	public function __construct(){
      parent::__construct();
	  $this->load->helper(array('url', 'form', 'date'));
	  $this->load->library('session');
	  $this->load->library('form_validation');
	  $this->load->database(); 
	  $this->load->model('Hotel_Model');
	  $this->load->model('Account_model');    
	  $this->sess_id = $this->session->userdata('session_id');
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
	public function index()
	{ 	 
		if (!$this->session->userdata('callcenter_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
			$this->load->view('hotel_index'); 	
	}
	
	public function search_data()
	{
		if (!$this->session->userdata('callcenter_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		
		$return = array();
		$data['result'] = $this->Hotel_Model->search_data();
			
		if(isset($data['result']) && $data['result']!='')
		{
			foreach($data['result'] as $value){
				array_push($return,array('label'=>$value->city,'value'=>$value->city));
			}
		}else{
			array_push($return,array('label'=>'No Results','value'=>'No Results'));
		}
		echo(json_encode($return));
	}
	
	
	public function results()
	{
		if (!$this->session->userdata('callcenter_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		
		if($_POST){
			$cityname = $this->input->post('searchid');
			$checkin = $this->input->post('checkin');
			$checkout = $this->input->post('checkout');
			$rooms = $this->input->post('room'); 
			$chekin1=explode("-",$_POST['checkin']);
			$checkout1=explode("-",$_POST['checkout']);
			
			$checkIN = strtotime($checkin);
			$checkOUT = strtotime($checkout);
			$diff = abs($checkOUT - $checkIN); 
			$nights = $diff/(24*60*60);
			
			$hotels_search['room_quantity'] = array();
			$hotels_search['adults'] = array();
			$hotels_search['childs'] = array();
			$hotels_search['childs_ages'] = array();
			
			$hotels_search['room_quantity'] = $this->input->post('room');	
			
			for($rm=0;$rm < $rooms;$rm++)
			{
				$hotels_search['adults'][$rm] = $_POST['adult'][$rm];
				$hotels_search['childs'][$rm] = $_POST['child'][$rm];
				if(isset($_POST['child'][$rm])){
					if($rm==0){ 	
						for($chag=0;$chag<$_POST['child'][$rm];$chag++)
						{
							if(isset($_POST['child_age'][$chag])){
								$hotels_search['childs_ages'][$rm][$chag] =$_POST['child_age'][$chag];
							}
						}	
					}
					if($rm==1){ 	
						for($chag1=($_POST['child'][0]);$chag1<($_POST['child'][0]+$_POST['child'][1]);$chag1++)
						{
							$hotels_search['childs_ages'][$rm][$chag1] = $_POST['child_age'][$chag1];
						}	
					}
					if($rm==2){ 	
						for($chag2=($_POST['child'][0]+$_POST['child'][1]);$chag2<($_POST['child'][0]+$_POST['child'][1]+$_POST['child'][2]);$chag2++)
						{
							$hotels_search['childs_ages'][$rm][$chag2] = $_POST['child_age'][$chag2];
						}	
					}
				}
			}
			
			if(!empty($_POST)) {		
				$hotel_search_data['hotel_search_data'] = array(
					'sess_id' => $this->sess_id,
					'cityname' => $cityname,
					'checkin' => $checkin,
					'checkout' => $checkout,
					'adults' => $hotels_search['adults'],
					'childs' => $hotels_search['childs'],
					'rooms' => $rooms,		
					'room_quantity' => $hotels_search['room_quantity'],	
					'adults_count' => array_sum($hotels_search['adults']),	
					'childs_count' => array_sum($hotels_search['childs']),
					'childs_ages' => $hotels_search['childs_ages'],
					'nights' => $nights,
					'hotel_details' => FALSE										
				); 
				$this->session->set_userdata($hotel_search_data);
			
			}else{
				redirect('hotel/index','refresh');
			}	
			$combination=$this->session->userdata('hotel_search_data');
			
			$cityname1=$combination['cityname'];
			$cin=$combination['checkin'];          
			$cout=$combination['checkout'];       
			$rooms1=$combination['rooms'];  
			$adults=$combination['adults_count']; 
			$childs=$combination['childs_count']; 
			$data['hotel_data'] = $this->Hotel_Model->hotels_data($hotel_search_data);
			$val='';
			$data['room_info']=$this->Hotel_Model->fetchingresult($cityname1,$cin,$cout,$rooms1,$adults,$childs,$val);
			
			$count=count($data['room_info']);
			if(isset($count) && $count>1){
				$data['pagi'] = $this->pagination($data['room_info'][1][0]->ffff);
			}
			
			$data['acc_type']=$this->Hotel_Model->get_accType();
			$data['hotel_amen']=$this->Hotel_Model->get_hotelAmenites();
			$data['room_amen']=$this->Hotel_Model->get_roomAmenites();
			$data['other_amen']=$this->Hotel_Model->get_otherAmenites();
			$data['location']=$this->Hotel_Model->get_Location();
			$this->load->view('search_result',$data);
		}else{
			redirect('hotel/index','refresh');
		}
	}
	
	function sortbyresult() {
					if (!$this->session->userdata('callcenter_logged_in')) {
						redirect('index/login', 'refresh'); 
					}
			$val=$this->uri->segment(3);
			$combination=$this->session->userdata('hotel_search_data');		
			$cityname1=$combination['cityname']; 
			$cin=$combination['checkin'];          
			$cout=$combination['checkout'];       
			$rooms1=$combination['rooms'];  
			$adults=$combination['adults_count']; 
			$childs=$combination['childs_count'];
		$data['room_info']=$this->Hotel_Model->fetchingresult($cityname1,$cin,$cout,$rooms1,$adults,$childs,$val);
		$data['pagi'] = $this->pagination($data['room_info'][1][0]->ffff);
		$data['result_counts']=$val;
		$this->load->view('search_result',$data);
	
	}
	
	function pagination($room){
		
		$this->load->library('pagination');
		$config['base_url'] = WEB_URL.'hotel/sortbyresult';
		$config['total_rows'] = $room;
		$config['per_page'] = 10;
		$config['next_link'] = '&gt;';
		$config['last_link'] = false;
		$this->pagination->initialize($config);
		return $this->pagination->create_links(); exit;
	}
	
	
	
	function hotel_details($hotel_id,$sup_rate_id)
	{ 
		if (!$this->session->userdata('callcenter_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$hotel_id=$this->uri->segment(3);
		$sup_rate_id=$this->uri->segment(4);
		$data['hotel_info']=$this->Hotel_Model->get_hotel($hotel_id);
		$data['hotel_tactic']=$this->Hotel_Model->get_sup_rate_tactics($sup_rate_id);
		$this->load->view('hotel_details',$data);
	}
	function check_availabilty()
	{	
		if (!$this->session->userdata('callcenter_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$post=$this->input->post();
		$datas=$this->Hotel_Model->check_availabilty($post);
		echo $datas;
	}
    function pre_booking()
	{   if (!$this->session->userdata('callcenter_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['country']=$this->Hotel_Model->country_list();
		$data['hotel_book_details']=$this->session->userdata('hotel_search_data');
		$data['details']=$this->input->post();
		$this->load->view('prebooking',$data);
	}
	function payment_Process()
	{	
		if (!$this->session->userdata('callcenter_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$post=$this->input->post();
		$user_id=$this->session->userdata('user_id');
		$res=$this->Account_model->balance($user_id);
		$balance=$res->credit;
		$markup=$this->Hotel_Model->get_agentinfo($user_id);
		$agent_tax=$markup->callcenter_markup;
		$result=$this->Hotel_Model->detect_cost($post,$balance,$user_id,$agent_tax);
		if($result) {
		$data['book_info']=$this->Hotel_Model->book_hotel($post,$user_id);
		redirect('hotel/voucher/'.$data['book_info']->hotel_id.'/'.$data['book_info']->booking_id);
	    } else {
			echo 'You dont have sufficient balance contact your admin!!!';		
		}
	}
	function voucher()
	{	
		if (!$this->session->userdata('callcenter_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_info']=$this->Hotel_Model->get_hotel($this->uri->segment(3));
		$data['book_info']=$this->Hotel_Model->get_bookhotel($this->uri->segment(4));
		$this->load->view('voucher',$data);
	}
	
	//static pages
	function about_us()
	{ if (!$this->session->userdata('callcenter_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$this->load->view('aboutus');
	}
	function contact_us()
	{	if (!$this->session->userdata('callcenter_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$this->load->view('contactus');
	}
	function faq()
	{	if (!$this->session->userdata('callcenter_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$this->load->view('faq');
	}
	function terms_conditions()
	{	if (!$this->session->userdata('callcenter_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$this->load->view('terms_conditions');
	}

//------------closing class---------------//
}

