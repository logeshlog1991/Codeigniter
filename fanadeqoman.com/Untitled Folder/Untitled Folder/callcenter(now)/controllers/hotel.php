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
	  $this->sess_id = $this->session->userdata('session_id');
	  if(empty($_SESSION['langH'])){
			$_SESSION['langH']='english';
	  }
	  $this->lang->load('fi',$_SESSION['langH']);
	}
	function change_language()
	{
		$return=0;
		$post=$this->input->post('lang');
		if($post==''){
		}else{
			$_SESSION['langH']=$post;
			$return=1;
		}
		echo $return;exit;
	}
	public function index()
	{
		if($_SESSION['langH']=='english')
		{
			$this->load->view('hotel_index');
		}else{
			$this->load->view('arabic/hotel_index');
		}
	}
	public function search_data()
	{
		$return = array();
		$data['result'] = $this->Hotel_Model->search_data();
		if(isset($data['result']) && $data['result']!='')
		{
			foreach($data['result'] as $value){
				if($_SESSION['langH']=='english')
				{
					array_push($return,array('label'=>$value->city_name,'value'=>$value->city_name,'id'=>$value->c_no));
				}else{
					array_push($return,array('label'=>$value->city_nameA,'value'=>$value->city_nameA,'id'=>$value->c_no));
				}
			}
		}else{
			if($_SESSION['langH']=='english')
			{
				array_push($return,array('label'=>'No Results','value'=>'No Results'));
			}else{
				array_push($return,array('label'=>'No Results','value'=>'No Results'));
				//array_push($return,array('label'=>'لا يوجد نتائ','value'=>'لا يوجد نتائج'));
			}
		}
		echo(json_encode($return));
	}
	
	
	public function results()
	{
		if($_POST){
			$cityname1 = $this->input->post('searchid1');
			$cityname = $this->input->post('searchid');
			$city_id = $this->input->post('searchid');
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
					'city_id' => $city_id,
					'cityname' => $cityname1,
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
			
			$cityname1=$combination['city_id'];
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
			
			if($_SESSION['langH']=='english')
			{
				$this->load->view('search_result',$data);
			}else{
				$this->load->view('arabic/search_result',$data);
			}
		}else{
			redirect('hotel/index','refresh');
		}
	}
	
	function sortbyresult() {
		$data['acc_type']=$this->Hotel_Model->get_accType();
		$data['hotel_amen']=$this->Hotel_Model->get_hotelAmenites();
		$data['room_amen']=$this->Hotel_Model->get_roomAmenites();
		$data['other_amen']=$this->Hotel_Model->get_otherAmenites();
		$data['location']=$this->Hotel_Model->get_Location();
			
		$combination=$this->session->userdata('hotel_search_data');
		$val=$this->uri->segment(3);
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
		$config['base_url'] = WEB_DIR.'index.php/hotel/sortbyresult';
		$config['total_rows'] = $room;
		$config['per_page'] = 10;
		$config['next_link'] = '&gt;';
		$config['last_link'] = false;
		$this->pagination->initialize($config);
		return $this->pagination->create_links(); exit;
	}
	
	function hotel_details($hotel_id,$sup_rate_id)
	{ 
		$hotel_id=$this->uri->segment(3);
		$sup_rate_id=$this->uri->segment(4);
		$data['hotel_info']=$this->Hotel_Model->get_hotel($hotel_id);
		$data['hotel_tactic']=$this->Hotel_Model->get_sup_rate_tactics($sup_rate_id);
		if($_SESSION['langH']=='english')
		{
			$this->load->view('hotel_details',$data);
		}else{
			$this->load->view('arabic/hotel_details',$data);
		}
	}
	function check_availabilty()
	{
		$post=$this->input->post();
		$datas=$this->Hotel_Model->check_availabilty($post);
		echo $datas;
	}
    function pre_booking()
	{
		$data['country']=$this->Hotel_Model->country_list();
		$data['hotel_book_details']=$this->session->userdata('hotel_search_data');
		$data['details']=$this->input->post();
		if($_SESSION['langH']=='english')
		{
			$this->load->view('prebooking',$data);
		}else{
			$this->load->view('arabic/prebooking',$data);
		}
	}
	function payment_Process()
	{
		$post=$this->input->post();
		$data['book_info']=$this->Hotel_Model->book_hotel($post);
		
		if($data['book_info']=='fail'){
			$this->load->view('booking_cancelled');
		}else{
			redirect('hotel/voucher/'.$data['book_info']->hotel_id.'/'.$data['book_info']->booking_id);
		}
	}
	
	function voucher()
	{
		$data['hotel_info']=$this->Hotel_Model->get_hotel($this->uri->segment(3));
		$data['book_info']=$this->Hotel_Model->get_bookhotel($this->uri->segment(4));
		$this->load->view('voucher',$data);
	}
		
	//static pages
	function about_us()
	{
		if($_SESSION['langH']=='english')
		{
			$this->load->view('aboutus');
		}else{
			$this->load->view('arabic/aboutus');
		}
	}
	function contact_us()
	{
		if($_SESSION['langH']=='english')
		{
			$this->load->view('contactus');
		}else{
			$this->load->view('arabic/contactus');
		}
	}
	function faq()
	{
		if($_SESSION['langH']=='english')
		{
			$this->load->view('faq');
		}else{
			$this->load->view('arabic/faq');
		}
	}
	function terms_conditions()
	{
		if($_SESSION['langH']=='english')
		{
			$this->load->view('terms_conditions');
		}else{
			$this->load->view('arabic/terms_conditions');
		}
	}

//------------closing class---------------//
}

