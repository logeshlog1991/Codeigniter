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
	   if(empty($_SESSION['lang'])){
			$_SESSION['lang']='english';
	  }
	  $this->lang->load('fi',$_SESSION['lang']);
	}
	/*
	 * admin adding the marktes
	 */
	public function add_markets()
	{
		$val=$this->input->post('add_market_name');
		$data['new_val'] = $this->Hotel_Model->add_market($val);
		redirect('hotel/add_hotel','refresh');
	}
	/*
	 * admin adding accommodation
	 */
	public function add_accommodation()
	{
		$val=$this->input->post('add_acc_name');
		$data['new_val'] = $this->Hotel_Model->add_accommodation($val);
		redirect('hotel/add_hotel','refresh');
	}
	/*
	 * admin adding others accommodation
	 */
	public function add_other_acc()
	{
		$val=$this->input->post('add_other_acc');
		$data['new_val'] = $this->Hotel_Model->add_other_acc($val);
		redirect('hotel/add_hotel','refresh');
	}
	
	/*
	*  admin getting all hotels
	*/
	public function hotel_manager()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['result']=$this->Hotel_Model->getting_all_hotels();
		$this->load->view('hotel/hotel_list',$data);
	}
	/*
	*  admin going to add hotel page
	*/
	public function add_hotel()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$this->load->view('hotel/add_hotel');
	}
	/*
	*  admin going to check hotel is exit or not
	*/
	public function hotel_check()
	{
		$data['result']=$this->Hotel_Model->hotel_check($_POST['hotel_name']);
		echo $data['result'];exit;
	}
	/*
	*  admin adding the hotel details
	*/
	public function add_hotel_ad()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data=$this->input->post();
		$id=$this->Hotel_Model->add_hotel_details($data); 
		redirect('hotel/hotel_manager','refresh');
	}
	/*
	*  admin Active hotel
	*/
	public function Active_hotel($hotel_id) {
		$data['result']=$this->Hotel_Model->Active_hotel($hotel_id);
		redirect('hotel/hotel_manager','refresh');
	}
	/*
	*  admin delete hotel
	*/
	public function delete_hotel($hotel_id) {
		$data['result']=$this->Hotel_Model->delete_hotel($hotel_id);
		redirect('hotel/hotel_manager','refresh');
	}
	
	/*
	*  admin Inactive hotel
	*/
	public function Inactive_hotel($hotel_id) {
		$data['result']=$this->Hotel_Model->Inactive_hotel($hotel_id);
		redirect('hotel/hotel_manager','refresh');
	}
	/*
	*  admin getting the hotel details
	*/
	public function edit_hotel($hotel_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_details']=$this->Hotel_Model->getting_hotel_details($hotel_id); 
		$this->load->view('hotel/edit_hotel',$data);
	}
	/*
	*  admin update the hotel details
	*/
	public function edit_hotel_ad($hotel_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data=$this->input->post();
		$data['hotel_details']=$this->Hotel_Model->update_hotel($data,$hotel_id); 
		redirect('hotel/hotel_manager','refresh'); 
	}
	/*
	*  admin room category list
	*/
	function room_category()
	{
	 	if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
        $data['room_category']=$this->Hotel_Model->room_type_list();
        
        $this->load->view('hotel/roomcategory_list', $data);
	}
	function check_roomcategory()
	{
		$data['result']=$this->Hotel_Model->check_roomcategory($this->input->post('room_category'),$this->input->post('hotel_id'));
		echo $data['result'];exit;
		
	}
	function check_roomcategory1()
	{
		$data['result']=$this->Hotel_Model->check_roomcategory1($this->input->post('room_category'),$this->input->post('hotel_id'),$this->input->post('main_category'));
		echo $data['result'];exit;
		
	}
	/*
	*  admin adding room category 
	*/
	function add_category()
	{
	 	if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
        $data['services']=$this->Hotel_Model->get_global_amenities1();
        $data['hotels']=$this->Hotel_Model->getting_all_hotels();
        $this->load->view('hotel/add_roomcategory',$data);
	}
	function roomcategory_ad()
	{
	 	if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
		$data=$this->input->post();
        $data['room_type'] = $this->Hotel_Model->add_room_type_details($data);
        redirect('hotel/room_category','refresh'); 
	}
	/*
	*  admin editing room category 
	*/
	function edit_category($category_id)
	{
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
        $data['services']=$this->Hotel_Model->get_global_amenities1();
        $data['hotels']=$this->Hotel_Model->getting_all_hotels();
        $data['category']=$this->Hotel_Model->getting_room_category($category_id);
        $this->load->view('hotel/edit_roomcategory',$data);
	}
	function editroomcategory_ad($category_id)
	{
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
        $data=$this->input->post();
        $data['category'] = $this->Hotel_Model->edit_room_type_details($data,$category_id);
       redirect('hotel/room_category','refresh'); 
    }
	/*
	*  admin delete room category 
	*/
	function delete_category($category_id)
	{
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
        $data['category'] = $this->Hotel_Model->delete_room_category($category_id);
        redirect('hotel/room_category','refresh'); 
	}
	/*
	*  admin room type list 
	*/
	function roomtype_list()
	{
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
        $data['room_type'] = $this->Hotel_Model->roomtype_list();
		$this->load->view('hotel/roomtype_list',$data);
	}
	/*
	*  admin add room type  
	*/
	function add_roomtype()
	{
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
        $data['hotels']=$this->Hotel_Model->getting_all_hotels();
        $this->load->view('hotel/add_roomtype',$data);
    }
    function roomtype_ad()
	{
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
        $roomtype=$this->input->post();
        $data['roomtype'] = $this->Hotel_Model->roomtype_ad($roomtype);
        redirect('hotel/roomtype_list','refresh'); 
    }
    /*
	*  admin edit room type  
	*/
	function edit_roomtype($roomtype_id)
	{
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
         $data['hotels']=$this->Hotel_Model->getting_all_hotels();
         $data['roomtype'] = $this->Hotel_Model->edit_roomtype($roomtype_id);
         $this->load->view('hotel/edit_roomtype',$data);
	}
	function editroomtype_ad($roomtype_id)
	{
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
        $roomtype=$this->input->post();
        $data['roomtype'] = $this->Hotel_Model->editroomtype_ad($roomtype,$roomtype_id);
        redirect('hotel/roomtype_list','refresh'); 
	}
	/*
	*  admin delete room category 
	*/
	function delete_roomtype($roomtype_id)
	{
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
        $data['category'] = $this->Hotel_Model->delete_roomtype($roomtype_id);
        redirect('hotel/roomtype_list','refresh'); 
	}
	/*
	*  admin room count list 
	*/
	function roomcount_list()
	{
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
        $data['room_count'] = $this->Hotel_Model->roomcount_list();
        $this->load->view('hotel/roomcount_list',$data);
	}
	/*
	*  admin add room count  
	*/
	function add_room()
	{
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
        $data['hotels']=$this->Hotel_Model->getting_all_hotels();
        $this->load->view('hotel/add_room',$data);
	}
	//admin get room type
	function getRoomType($hotel_id)
	{
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
		$data['room_type'] = $this->Hotel_Model->getRoomType($hotel_id);
	}
	//admin get room type
	function roomcount_ad()
	{
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
        $post=$this->input->post();
        $data['room_count'] = $this->Hotel_Model->roomcount_ad($post);
		redirect('hotel/roomcount_list');
   }
   /*
	*  admin delete room category 
	*/
	function delete_roomcount($roomcount_id)
	{
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
        $data['room_count'] = $this->Hotel_Model->delete_roomcount($roomcount_id);
        redirect('hotel/roomcount_list','refresh'); 
	}
	/*
	*  admin edit room count  
	*/
	function edit_roomcount($roomcount_id)
	{
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
        $data['hotels']=$this->Hotel_Model->getting_all_hotels();
        $data['room_count'] = $this->Hotel_Model->edit_roomcount($roomcount_id);
		$this->load->view('hotel/edit_room',$data);
	}
	function edit_roomcount_ad($roomcount_id)
	{
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
        $post=$this->input->post();
        $data['room_count'] = $this->Hotel_Model->edit_roomcount_ad($post,$roomcount_id);
		redirect('hotel/roomcount_list');
	}
	//admin get roompolicy list
	function roompolicy_list()
    {
        if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
        $data['room_policy']=$this->Hotel_Model->roompolicy_list();
        $this->load->view('hotel/roompolicy_list',$data);
    }
    //admin add room policy
    function add_roompolicy()
    {
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
		$data['hotels']=$this->Hotel_Model->getting_all_hotels();
		$this->load->view('hotel/add_roompolicy',$data);
	}
	function roompolicy_ad()
    {
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
        $post=$this->input->post();
        $data['room_policy'] = $this->Hotel_Model->roompolicy_ad($post);
		redirect('hotel/roompolicy_list');
	}
	//admin edit room policy
	function edit_roomplicy($roomploicy_id)
    {
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
        $data['hotels']=$this->Hotel_Model->getting_all_hotels();
        $data['room_policy'] = $this->Hotel_Model->get_roompolicy($roomploicy_id);
        $this->load->view('hotel/edit_roompolicy',$data);
	}
	function edit_roompolicy_ad($roomploicy_id)
    {
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
		$post=$this->input->post();
        $data['room_policy'] = $this->Hotel_Model->edit_roompolicy_ad($post,$roomploicy_id);
		redirect('hotel/roompolicy_list');
	}
	 /*
	*  admin delete room policy 
	*/
	function delete_roomplicy($roomploicy_id)
	{
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
        $data['room_count'] = $this->Hotel_Model->delete_roomplicy($roomploicy_id);
        redirect('hotel/roompolicy_list');
	}
	//admin get roompolicy list
	function roomfacility_list()
    {
        if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
        $data['room_fac_list']=$this->Hotel_Model->roomfacility_list();
        $this->load->view('hotel/roomfacility_list',$data);
    }
    /*
	*  admin add room facilites 
	*/
	public function add_roomfacilites()
	{
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
		$date['Room_Facilities']=$this->input->post();
		$data['Room_Facilities']=$this->Hotel_Model->add_roomfacilites($date['Room_Facilities']);
		redirect('hotel/roomfacility_list', 'refresh');
	}	
    /*
	*  admin Inactive room facilites 
	*/
	public function InActive_room_fac($fac_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_details']=$this->Hotel_Model->InActive_room_fac($fac_id);
		redirect('hotel/roomfacility_list', 'refresh');
	}
	/*
	*  admin active room facilites 
	*/
	public function Active_room_fac($fac_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_details']=$this->Hotel_Model->Active_room_fac($fac_id);
		redirect('hotel/roomfacility_list', 'refresh');
	}
	/*
	*  admin Delete the room and hotel facilites
	*/
	public function delete_room_fac($fac_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_details']=$this->Hotel_Model->delete_Rfacilites($fac_id);
		redirect('hotel/roomfacility_list', 'refresh');
	}
	/*
	*  admin getting price manager 
	*/
	function price_manager()
	{
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
        $data['price_manager'] = $this->Hotel_Model->price_list();
        $this->load->view('hotel/pricemanager_list',$data);
	}
	function add_pricemanager()
	{
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
        $data['hotels']=$this->Hotel_Model->getting_all_hotels();
        $this->load->view('hotel/add_pricemanager',$data);
    }
    //admin create getdates
    function getDates()
    {
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
		$results = $this->Hotel_Model->getDates($_POST);
    }
    //add room rates
    function add_pricemanager_ad()
	{
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
        $fileimage='';$fileimage1='';$fileimage2='';$fileimage3='';
		if($_FILES){
			$target= ROOT_PATH;
			if(isset($_FILES['mainimage']['name'])){
				move_uploaded_file($_FILES['mainimage']['tmp_name'],$target.$_FILES['mainimage']['name']);
				$fileimage=$_FILES['mainimage']['name'];
			}
			if(isset($_FILES['image1']['name'])){
				move_uploaded_file($_FILES['image1']['tmp_name'],$target.$_FILES['image1']['name']);
				$fileimage1=$_FILES['image1']['name'];
			}
			if(isset($_FILES['image2']['name'])){
				move_uploaded_file($_FILES['image2']['tmp_name'],$target.$_FILES['image2']['name']);
				$fileimage2=$_FILES['image2']['name'];
			}
			if(isset($_FILES['image3']['name'])){
				move_uploaded_file($_FILES['image3']['tmp_name'],$target.$_FILES['image3']['name']);
				$fileimage3=$_FILES['image3']['name'];
			}
		}
		
		$market_id= $this->input->post('market_id');
		$hotel_id = $this->input->post('hotel_name');
		$board_type = $this->input->post('board_type');
		$room_cate = $this->input->post('room_type');
		$room_type = $this->input->post('capacity_type');
		$child_policy = $this->input->post('child_policy');
		
		$cancel_policy_nights = $this->input->post('nights');
		$cancel_policy_percent = $this->input->post('charge');
		$cancel_policy_charge = $this->input->post('currency');
		$cancel_policy_from = $this->input->post('cancel_policy_from');
		$cancel_policy_to = $this->input->post('cancel_policy_to');
		$cancel_policy_desc=$this->input->post('cancel_desc');
		
		if(is_array($this->input->post('sd'))) 
		{
		  $room_avail_date_from = $this->input->post('sd');
		}else{
			$room_avail_date_from = $this->input->post('sd'); 
		}
		if(is_array($this->input->post('ed'))) 
		{
			$room_avail_date_to = $this->input->post('ed');
		}else{
			$room_avail_date_to = $this->input->post('ed');
		}
		$dates = $this->input->post('dates'); 
		$weekday = $this->input->post('weekday'); 
		$price = $this->input->post('price'); 
		$extra_bed_price = $this->input->post('extra_bed_price'); 
		$avail = $this->input->post('avail'); 
		$aadult = $this->input->post('adult'); 
		$achild = $this->input->post('child');
		$child_price = $this->input->post('child_price');
		$infant = $this->input->post('infant');
		
		$this->Hotel_Model->add_pricemanager_ad($market_id,$cancel_policy_desc,$board_type,$hotel_id,$room_cate,$room_type,$child_policy,$cancel_policy_nights,$cancel_policy_percent,$cancel_policy_charge,$cancel_policy_from,$cancel_policy_to,$room_avail_date_from,$room_avail_date_to,$dates,$weekday,$price,$extra_bed_price,$avail,$aadult,$achild,$child_price,$infant,$fileimage,$fileimage1,$fileimage2,$fileimage3);
		redirect('hotel/price_manager','refresh');
   }
	function delete_pricemanager($tacktics_id)
	{
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
        $data['room_price'] = $this->Hotel_Model->delete_pricemanager($tacktics_id);
        redirect('hotel/price_manager');
	}
	
	function edit_pricemanager($tacktics_id)
	{
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
        $data['hotels']=$this->Hotel_Model->getting_all_hotels();
        $data['rat_tac_details'] = $this->Hotel_Model->get_rate_tactics_details($tacktics_id);
       
        $data['img_path']=IMG_PATH;
        $this->load->view('hotel/edit_pricemanager',$data);
	}
	 //admin get acvail dates
	function getAvailDates()
	{
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
		$results = $this->Hotel_Model->getAvailDates();
	}
	
	 //admin edit price manager
	function edit_pricemanager_ad($tacktics_id)
	{
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
		$fileimage='';$fileimage1='';$fileimage2='';$fileimage3='';
		if($_FILES){
			$target= ROOT_PATH;
			if(isset($_FILES['mainimage']['name'])){
				move_uploaded_file($_FILES['mainimage']['tmp_name'],$target.$_FILES['mainimage']['name']);
				$fileimage=$_FILES['mainimage']['name'];
			}
			if(isset($_FILES['image1']['name'])){
				move_uploaded_file($_FILES['image1']['tmp_name'],$target.$_FILES['image1']['name']);
				$fileimage1=$_FILES['image1']['name'];
			}
			if(isset($_FILES['image2']['name'])){
				move_uploaded_file($_FILES['image2']['tmp_name'],$target.$_FILES['image2']['name']);
				$fileimage2=$_FILES['image2']['name'];
			}
			if(isset($_FILES['image3']['name'])){
				move_uploaded_file($_FILES['image3']['tmp_name'],$target.$_FILES['image3']['name']);
				$fileimage3=$_FILES['image3']['name'];
			}
		}
		if($_POST){
				$market_id= $this->input->post('market_id');
				$hotel_id = $this->input->post('hotel_name');
				$board_type = $this->input->post('board_type');
				$room_cate = $this->input->post('room_type');
				$room_type = $this->input->post('capacity_type');
				$child_policy = $this->input->post('child_policy');
				
				$cancel_policy_nights = $this->input->post('nights');
				$cancel_policy_percent = $this->input->post('charge');
				$cancel_policy_charge = $this->input->post('currency');
				$cancel_policy_from = $this->input->post('cancel_policy_from');
				$cancel_policy_to = $this->input->post('cancel_policy_to');
				$cancel_policy_desc=$this->input->post('cancel_desc');
				
				if(is_array($this->input->post('sd'))) 
				{
				  $room_avail_date_from = $this->input->post('sd');
				}else{
					$room_avail_date_from = $this->input->post('sd'); 
				}
				if(is_array($this->input->post('ed'))) 
				{
					$room_avail_date_to = $this->input->post('ed');
				}else{
					$room_avail_date_to = $this->input->post('ed');
				}
				$dates = $this->input->post('dates'); 
				$weekday = $this->input->post('weekday'); 
				$price = $this->input->post('price'); 
				$extra_bed_price = $this->input->post('extra_bed_price'); 
				$avail = $this->input->post('avail'); 
				$aadult = $this->input->post('adult'); 
				$achild = $this->input->post('child');
				$child_price = $this->input->post('child_price');
				$infant = $this->input->post('infant');
			
			$this->Hotel_Model->edit_pricemanager_ad($tacktics_id,$market_id,$cancel_policy_desc,$board_type,$hotel_id,$room_cate,$room_type,$child_policy,$cancel_policy_nights,$cancel_policy_percent,$cancel_policy_charge,$cancel_policy_from,$cancel_policy_to,$room_avail_date_from,$room_avail_date_to,$dates,$weekday,$price,$extra_bed_price,$avail,$aadult,$achild,$child_price,$infant,$fileimage,$fileimage1,$fileimage2,$fileimage3);
			redirect('hotel/price_manager');
		}
	}
	//admin getting amenity list
	function amenity_list()
	{
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
        $data['amenity'] =$this->Hotel_Model->get_global_amenities();
        $this->load->view('hotel/amenity_list',$data);
	}
	//admin adding amenity
	function add_amenity()
	{
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
        $this->Hotel_Model->add_amenity($_POST['amenity']);
		redirect('hotel/amenity_list', 'refresh'); 
	}
	//admin deleting amenity
	function delete_amenity($amenity_id)
	{
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
        $this->Hotel_Model->delete_amenity($amenity_id);
		redirect('hotel/amenity_list', 'refresh'); 
	}
	//admin edit amenity
	
	function edit_amenity($amenity_id)
	{
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
       $data['amenity_name']=$this->Hotel_Model->get_amenity($amenity_id);
       $this->load->view('hotel/edit_amenity',$data);
	}
    function editamenity_ad($amenity_id)
    {
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
        $amenity_name=$this->input->post('amenity');
        $this->Hotel_Model->editamenity_ad($amenity_id,$amenity_name);
        redirect('hotel/amenity_list', 'refresh'); 
	}
	/*
	*  admin getting hotel booking_details
	*/
	function B2C_bookingReports()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['type']="Confirm";
		$data['booking_info'] = $this->Hotel_Model->B2C_bookingReports();
		$this->load->view('hotel/B2C_bookingReports',$data);
	}
	/*
	*  admin getting hotel booking_details
	*/
	function callcenter_bookingReports()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['type']="Confirm";
		$data['booking_info'] = $this->Hotel_Model->callcenter_bookingReports();
		$this->load->view('hotel/callcenter_bookingReports',$data);
	}
	
	/*
	*  admin  hotel booking_details download
	*/
	function download_b2c()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		
		header("Content-type: text/csv");
		header("Content-Disposition: attachment; filename=b2c_bookinginfo.csv");
		header("Pragma: no-cache");
		header("Expires: 0");
		$result = $this->Hotel_Model->B2C_bookingReports();
		$data=array();
		$data[]=array('Sno','Booking ID','Booking Date','CheckIn','CheckOut','First Name','Last Name','E-mail ID','TelePhone','City','Hotel Name','Status','Currency','Purchase Price');
		
		$i=1;$grand=0;$bookings=0;
		if(isset($result) && $result!=''){
			foreach($result as $info){
					$data[]=array($i,$info->booking_id,$info->created_date,$info->customer_checkin,$info->customer_checkout,$info->customer_fname,$info->customer_lname,$info->customer_email,$info->customer_phone,$info->customer_city,$info->hotel_name,$info->status,'$',$info->customer_finalcost);
					//$grand+=$city->total_amount;
					//$bookings+=$city->total_nights;
				$i++;}
			//$data[] = array('','','','','','');
			//$data[] = array('','','Total',round($grand,2),KARENCY,$bookings);
		}
		$output = fopen("php://output", "w");
		foreach ($data as $row) {
			fputcsv($output, $row);
		}
		fclose($output);
	}
	/*
	*  admin  hotel booking_details download
	*/
	function download_callcenter()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		
		header("Content-type: text/csv");
		header("Content-Disposition: attachment; filename=callcenter_bookinginfo.csv");
		header("Pragma: no-cache");
		header("Expires: 0");
		$result = $this->Hotel_Model->callcenter_bookingReports();
		$data=array();
		$data[]=array('Sno','Booking ID','Booking Date','CheckIn','CheckOut','First Name','Last Name','E-mail ID','TelePhone','City','Hotel Name','Status','Currency','Purchase Price');
		
		$i=1;$grand=0;$bookings=0;
		if(isset($result) && $result!=''){
			foreach($result as $info){
					$data[]=array($i,$info->booking_id,$info->created_date,$info->customer_checkin,$info->customer_checkout,$info->customer_fname,$info->customer_lname,$info->customer_email,$info->customer_phone,$info->customer_city,$info->hotel_name,$info->status,'$',$info->customer_finalcost);
					//$grand+=$city->total_amount;
					//$bookings+=$city->total_nights;
				$i++;}
			//$data[] = array('','','','','','');
			//$data[] = array('','','Total',round($grand,2),KARENCY,$bookings);
		}
		$output = fopen("php://output", "w");
		foreach ($data as $row) {
			fputcsv($output, $row);
		}
		fclose($output);
	}
	function print_cancelVoucher()
	{
		$hotel_id=$this->uri->segment(3);
		$sup_rate_id=$this->uri->segment(4);
		$booking_id=$this->uri->segment(5);
		$data['hotel_info']=$this->Hotel_Model->get_cancelVocher($hotel_id,$sup_rate_id,$booking_id);
		redirect('hotel/cancelVoucher/'.$hotel_id.'/'.$booking_id);
	}
	function callcenter_cancelVoucher()
	{
		$hotel_id=$this->uri->segment(3);
		$sup_rate_id=$this->uri->segment(4);
		$booking_id=$this->uri->segment(5);
		$data['hotel_info']=$this->Hotel_Model->get_cancelVocher($hotel_id,$sup_rate_id,$booking_id);
		redirect('hotel/call_cancelVoucher/'.$hotel_id.'/'.$booking_id);
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
		redirect('hotel/B2C_bookingReports');
	}
	function call_cancelVoucher()
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
		redirect('hotel/callcenter_bookingReports');
	}
	
	//----------------closing class-------------------//
}












