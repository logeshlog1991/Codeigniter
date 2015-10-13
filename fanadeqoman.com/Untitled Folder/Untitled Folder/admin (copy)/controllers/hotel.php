<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
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
		$val1=$this->input->post('add_market_nameA');
		$data['new_val'] = $this->Hotel_Model->add_market($val,$val1);
		redirect('hotel/hotel_registration','refresh');
	}
	function add_country()
	{
		$data['new_val'] = $this->Hotel_Model->add_country($this->input->post());
		redirect('hotel/hotel_registration','refresh');
	}
	/*
	 * admin adding accommodation
	 */
	public function add_accommodation()
	{
		$val=$this->input->post('add_acc_name');
		$valA=$this->input->post('add_acc_nameA');
		$data['new_val'] = $this->Hotel_Model->add_accommodation($val,$valA);
		redirect('hotel/add_hotel','refresh');
	}
	/*
	 * admin adding others accommodation
	 */
	public function add_other_acc()
	{
		$val=$this->input->post('add_other_acc');
		$valA=$this->input->post('add_other_accA');
		$data['new_val'] = $this->Hotel_Model->add_other_acc($val,$valA);
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
	public function hotel_registration()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$this->load->view('hotel/hotel_registration');
	}
	public function check_country()
	{
		$data['result']=$this->Hotel_Model->check_country($this->input->post('country_name'));
		echo $data['result'];exit;
	}
	/*
	*  admin going to check hotel is exit or not
	*/
	public function hotel_check()
	{
		$data['result']=$this->Hotel_Model->hotel_check($_POST['hotel_name'],$_POST['old_hotel_name']);
		echo $data['result'];exit;
	}
	/*
	*  admin going to check hotel is exit or not
	*/
	public function hotel_check1()
	{
		$data['result']=$this->Hotel_Model->hotel_check1($_POST['hotel_name'],$_POST['old_hotel_name']);
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
		redirect('hotel/hotel_details','refresh');
	}
	public function hotel_details()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$this->load->view('hotel/hotel_details');
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
	public function view_hotel($hotel_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_details']=$this->Hotel_Model->getting_hotel_details($hotel_id); 
		$this->load->view('hotel/view_hotel',$data);
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
		redirect('hotel/edit_hotel_details/'.$hotel_id,'refresh'); 
	}
	/*
	*  admin update the hotel details
	*/
	public function edit_hotel_details($hotel_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_details']=$this->Hotel_Model->getting_hotel_details($hotel_id); 
		$this->load->view('hotel/edit_hotel_details',$data);
	}
	/*
	*  admin room category list
	*/
	function room_list()
	{
	 	if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
        $data['room_list']=$this->Hotel_Model->room_list();
        $this->load->view('hotel/room_list', $data);
	}
	function View_roomManager()
	{
		$sup_hotel_room_type_id=$this->uri->segment(3);
		$hotel_id=$this->uri->segment(4);
		$sup_inv_cate_type_id=$this->uri->segment(5);
		$sup_apart_houserules_id=$this->uri->segment(6);
		$room_type_id=$this->uri->segment(7);
		$data['hotel_details']=$this->Hotel_Model->get_hotel($hotel_id);
		$data['hotel_cat']=$this->Hotel_Model->getting_room_category($sup_hotel_room_type_id);
		$data['hotel_type']=$this->Hotel_Model->get_hotelTypes($sup_inv_cate_type_id);
		$data['hotel_policy']=$this->Hotel_Model->get_roompolicy($sup_apart_houserules_id);
		$data['room_type']=$this->Hotel_Model->get_roomType($room_type_id);
		$this->load->view('hotel/view_roomManager', $data);
	}
	function Active_roomManager()
	{
		$sup_hotel_room_type_id=$this->uri->segment(3);
		$hotel_id=$this->uri->segment(4);
		$sup_inv_cate_type_id=$this->uri->segment(5);
		$sup_apart_houserules_id=$this->uri->segment(6);
		$room_type_id=$this->uri->segment(7);
		
		//$this->Hotel_Model->getting_room_category($sup_hotel_room_type_id);
		$this->Hotel_Model->active_hotelTypes($sup_inv_cate_type_id);
		//$this->Hotel_Model->active_roompolicy($sup_apart_houserules_id);
		//$this->Hotel_Model->active_roomType($room_type_id);
		redirect('hotel/room_list','refresh'); 
	}
	function Inactive_roomManager()
	{
		$sup_hotel_room_type_id=$this->uri->segment(3);
		$hotel_id=$this->uri->segment(4);
		$sup_inv_cate_type_id=$this->uri->segment(5);
		$sup_apart_houserules_id=$this->uri->segment(6);
		$room_type_id=$this->uri->segment(7);
		
		//$this->Hotel_Model->getting_room_category($sup_hotel_room_type_id);
		$this->Hotel_Model->Inactive_hotelTypes($sup_inv_cate_type_id);
		//$this->Hotel_Model->Inactive_roompolicy($sup_apart_houserules_id);
		//$this->Hotel_Model->Inactive_roomType($room_type_id);
		redirect('hotel/room_list','refresh'); 
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
        redirect('hotel/add_roomtype','refresh'); 
       // redirect('hotel/room_category','refresh'); 
	}
	/*
	*  admin editing room category 
	*/
	function edit_category()
	{
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
        $category_id=$this->uri->segment(3);
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
	public function get_hotelCat()
	{
		$data['room_category']=$this->Hotel_Model->get_hotelCat($this->input->post('hotel_id'));
		$city='';
		if($data['room_category']!=''){
			$city.='<select name="category_id" id="category_id" class="form-control input-md">"
					<option value="">-Select Type-</option>';
					foreach($data['room_category'] as $val){
						$city.='<option value="'.$val->sup_hotel_room_type_id.'">'.$val->hotel_room_type.'</option>';
					}
			$city.='</select>';
		}
		echo $city;
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
        redirect('hotel/add_room','refresh'); 
        //redirect('hotel/roomtype_list','refresh'); 
    }
    /*
	*  admin edit room type  
	*/
	function edit_roomtype($hotel_id)
	{
	
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
         $data['hotels']=$this->Hotel_Model->getting_all_hotels();
         
        $data['room_cate']=$this->Hotel_Model->get_allroomCate($hotel_id);
        $category_id=$this->uri->segment(4);
        $capacity_id=$this->uri->segment(5);
        $data['roomtype'] = $this->Hotel_Model->edit_roomtype($category_id,$capacity_id);
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
        $data['room_count'] = $this->Hotel_Model->roomcount_ad1($post);
		redirect('hotel/add_roompolicy');
		//redirect('hotel/roomcount_list');
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
		redirect('hotel/room_list');
		//redirect('hotel/roompolicy_list');
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
        $data['mark']=$this->Hotel_Model->get_adminMarkup();
        $data['gate_markup']=$this->Hotel_Model->get_paymentGateway();
        $data['callcenter_markup']=$this->Hotel_Model->get_callMarkup();
        $this->load->view('hotel/pricemanager_list',$data);
	}
	function Inactive_price($price_id)
	{
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
        $data['price_manager'] = $this->Hotel_Model->Inactive_price($price_id);
        redirect('hotel/price_manager');
	}
	function Active_price($price_id)
	{
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
        $data['price_manager'] = $this->Hotel_Model->Active_price($price_id);
        redirect('hotel/price_manager');
	}
	function view_price($price_id)
	{
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
        $data['Board_Type']=$this->Hotel_Model->getting_all_Board_Type();
        $data['hotels']=$this->Hotel_Model->getting_all_hotels();
        $data['rat_tac_details'] = $this->Hotel_Model->get_rate_tactics_details1($price_id);
        $data['img_path']=IMG_PATH;
        
        //$data['mark']=$this->Hotel_Model->get_adminMarkup();
        //$data['gate_markup']=$this->Hotel_Model->get_paymentGateway();
        //$data['price_manager'] = $this->Hotel_Model->get_priceManager($price_id);
        //~ echo '<pre>';
        //~ print_r($data['price_manager']);die;
        
        $this->load->view('hotel/view_price',$data);
    }
	
	function add_pricemanager()
	{
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
        $data['Board_Type']=$this->Hotel_Model->getting_all_Board_Type();
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
		//echo '<pre>';
	//	print_r($_POST);die;
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
		$child_policyA = $this->input->post('child_policyA');
		
		$cancel_policy_nights = $this->input->post('nights');
		$cancel_policy_percent = $this->input->post('charge');
		$cancel_policy_charge = $this->input->post('currency');
		$cancel_policy_from = $this->input->post('cancel_policy_from');
		$cancel_policy_to = $this->input->post('cancel_policy_to');
		$cancel_policy_desc=$this->input->post('cancel_desc');
		$cancel_policy_descA=$this->input->post('cancel_descA');
		
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
		$rack_price = $this->input->post('rack_price'); 
		$sell_price = $this->input->post('sell_price'); 
		$extra_bed_price = $this->input->post('extra_bed_price'); 
		$avail = $this->input->post('avail'); 
		$aadult = $this->input->post('adult'); 
		$achild = $this->input->post('child');
		$child_price = $this->input->post('child_price');
		$infant = $this->input->post('infant');
		
		$this->Hotel_Model->add_pricemanager_ad($rack_price,$sell_price,$cancel_policy_descA,$child_policyA,$market_id,$cancel_policy_desc,$board_type,$hotel_id,$room_cate,$room_type,$child_policy,$cancel_policy_nights,$cancel_policy_percent,$cancel_policy_charge,$cancel_policy_from,$cancel_policy_to,$room_avail_date_from,$room_avail_date_to,$dates,$weekday,$price,$extra_bed_price,$avail,$aadult,$achild,$child_price,$infant,$fileimage,$fileimage1,$fileimage2,$fileimage3);
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
        $data['Board_Type']=$this->Hotel_Model->getting_all_Board_Type();
        $data['hotels']=$this->Hotel_Model->getting_all_hotels();
        $data['rat_tac_details'] = $this->Hotel_Model->get_rate_tactics_details1($tacktics_id);
        //~ echo '<pre>';
        //~ print_r($data['rat_tac_details']);die;
        
        
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
				$child_policyA = $this->input->post('child_policyA');
				
				$cancel_policy_nights = $this->input->post('nights');
				$cancel_policy_percent = $this->input->post('charge');
				$cancel_policy_charge = $this->input->post('currency');
				$cancel_policy_from = $this->input->post('cancel_policy_from');
				$cancel_policy_to = $this->input->post('cancel_policy_to');
				$cancel_policy_desc=$this->input->post('cancel_desc');
				$cancel_policy_descA=$this->input->post('cancel_descA');
				
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
				$rack_price = $this->input->post('rack_price'); 
				$sell_price = $this->input->post('sell_price'); 
				$extra_bed_price = $this->input->post('extra_bed_price'); 
				$avail = $this->input->post('avail'); 
				$aadult = $this->input->post('adult'); 
				$achild = $this->input->post('child');
				$child_price = $this->input->post('child_price');
				$infant = $this->input->post('infant');
			
			$this->Hotel_Model->edit_pricemanager_ad($rack_price,$sell_price,$child_policyA,$cancel_policy_descA,$tacktics_id,$market_id,$cancel_policy_desc,$board_type,$hotel_id,$room_cate,$room_type,$child_policy,$cancel_policy_nights,$cancel_policy_percent,$cancel_policy_charge,$cancel_policy_from,$cancel_policy_to,$room_avail_date_from,$room_avail_date_to,$dates,$weekday,$price,$extra_bed_price,$avail,$aadult,$achild,$child_price,$infant,$fileimage,$fileimage1,$fileimage2,$fileimage3);
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
        $this->Hotel_Model->add_amenity($_POST);
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
        $amenity_nameA=$this->input->post('amenityA');
        $this->Hotel_Model->editamenity_ad($amenity_id,$amenity_name,$amenity_nameA);
        redirect('hotel/amenity_list', 'refresh'); 
	}
	function star_list()
	{
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
        $data['star_list'] =$this->Hotel_Model->get_starList();
        $this->load->view('hotel/star_list',$data);
	}
	function edit_star($star_id)
	{
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
       $data['star_details']=$this->Hotel_Model->get_stars($star_id);
       $this->load->view('hotel/edit_star',$data);
	}
	function editstar_ad($star_id)
    {
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
        $this->Hotel_Model->editstar_ad($star_id,$this->input->post('star'));
        redirect('hotel/star_list', 'refresh'); 
	}
	function delete_star($star_id)
	{
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
        $this->Hotel_Model->delete_star($star_id);
		redirect('hotel/star_list', 'refresh'); 
		
	}
	function inactive_star($star_id)
	{
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
         $this->Hotel_Model->inactive_star($star_id);
        redirect('hotel/star_list', 'refresh'); 
	}
	function active_star($star_id)
	{
		if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('index/login');
        }
         $this->Hotel_Model->active_star($star_id);
        redirect('hotel/star_list', 'refresh'); 
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
	function booking_price()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['type']="Confirm";
		$data['booking_info'] = $this->Hotel_Model->B2C_bookingReports();
		$this->load->view('hotel/B2C_bookingprice.php',$data);
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
		$message = $this->load->view('callcancel_voucher',$data,TRUE);
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
	function hotel_markets()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_markets']=$this->Hotel_Model->hotel_markets();
		$this->load->view('hotel/hotel_markets',$data);
	}
	function inactive_market($market_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_markets']=$this->Hotel_Model->inactive_market($market_id);
		redirect('hotel/hotel_markets', 'refresh'); 
	}
	function active_market($market_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_markets']=$this->Hotel_Model->active_market($market_id);
		redirect('hotel/hotel_markets', 'refresh'); 
	}
	function edit_market($market_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_markets']=$this->Hotel_Model->edit_market($market_id);
		$this->load->view('hotel/edit_markets',$data);
	}
	function edit_market_ed($market_id)
	{
		if (!$this->session->userdata('admin_logged_in')){
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_markets']=$this->Hotel_Model->edit_market_ed($this->input->post(),$market_id);
		redirect('hotel/hotel_markets', 'refresh'); 
	}
	function delete_market($market_id)
	{
		if (!$this->session->userdata('admin_logged_in')){
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_markets']=$this->Hotel_Model->delete_market($market_id);
		redirect('hotel/hotel_markets', 'refresh'); 
	}
	
	
	function hotel_region()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_regions']=$this->Hotel_Model->hotel_regions();
		$this->load->view('hotel/hotel_regions',$data);
	}
	
	function inactive_region($region_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_region']=$this->Hotel_Model->inactive_region($region_id);
		redirect('hotel/hotel_region', 'refresh'); 
	}
	function active_region($region_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_region']=$this->Hotel_Model->active_region($region_id);
		redirect('hotel/hotel_region', 'refresh'); 
	}
	function edit_region($region_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_region']=$this->Hotel_Model->edit_region($region_id);
		$this->load->view('hotel/edit_region',$data);
	}
	function edit_region_ed($region_id)
	{
		if (!$this->session->userdata('admin_logged_in')){
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_region']=$this->Hotel_Model->edit_region_ed($this->input->post(),$region_id);
		redirect('hotel/hotel_region', 'refresh'); 
	}
	function delete_region($region_id)
	{
		if (!$this->session->userdata('admin_logged_in')){
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_markets']=$this->Hotel_Model->delete_region($region_id);
		redirect('hotel/hotel_region', 'refresh'); 
	}
	
	
	
	
	function hotel_payment()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_payment']=$this->Hotel_Model->hotel_payment();
		$this->load->view('hotel/hotel_payment',$data);
	}
	
	function inactive_paymentType($type_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_region']=$this->Hotel_Model->inactive_paymentType($type_id);
		redirect('hotel/hotel_payment', 'refresh'); 
	}
	function active_paymentType($type_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_region']=$this->Hotel_Model->active_paymentType($type_id);
		redirect('hotel/hotel_payment', 'refresh'); 
	}
	function edit_paymentType($type_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_paytype']=$this->Hotel_Model->edit_paymentType($type_id);
		$this->load->view('hotel/edit_paymentType',$data);
	}
	function edit_payment_ed($type_id)
	{
		if (!$this->session->userdata('admin_logged_in')){
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_region']=$this->Hotel_Model->edit_payment_ed($this->input->post(),$type_id);
		redirect('hotel/hotel_payment', 'refresh'); 
	}
	
	function delete_paymentType($type_id)
	{
		if (!$this->session->userdata('admin_logged_in')){
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_markets']=$this->Hotel_Model->delete_paymentType($type_id);
		redirect('hotel/hotel_payment', 'refresh'); 
	}
	
	
	function paymentCards_list()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_payment']=$this->Hotel_Model->paymentCards_list();
		$this->load->view('hotel/paymentCards_list',$data);
	}
	function inactive_cardType($type_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_region']=$this->Hotel_Model->inactive_cardType($type_id);
		redirect('hotel/paymentCards_list', 'refresh'); 
	}
	function active_cardType($type_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_region']=$this->Hotel_Model->active_cardType($type_id);
		redirect('hotel/paymentCards_list', 'refresh'); 
	}
	function edit_cardType($type_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_paytype']=$this->Hotel_Model->edit_cardType($type_id);
		$this->load->view('hotel/edit_cardType',$data);
	}
	function edit_cardType_ed($type_id)
	{
		if (!$this->session->userdata('admin_logged_in')){
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_region']=$this->Hotel_Model->edit_cardType_ed($this->input->post(),$type_id);
		redirect('hotel/paymentCards_list', 'refresh'); 
	}
	
	function delete_cardType($type_id)
	{
		if (!$this->session->userdata('admin_logged_in')){
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_markets']=$this->Hotel_Model->delete_cardType($type_id);
		redirect('hotel/paymentCards_list', 'refresh'); 
	}
	
	
	function bussines_list()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['bussines_list']=$this->Hotel_Model->bussines_list();
		$this->load->view('hotel/bussines_list',$data);
	}
	function inactive_fun($type_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_region']=$this->Hotel_Model->inactive_fun($type_id);
		redirect('hotel/bussines_list', 'refresh'); 
	}
	function active_fun($type_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_region']=$this->Hotel_Model->active_fun($type_id);
		redirect('hotel/bussines_list', 'refresh'); 
	}
	function edit_fun($type_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_paytype']=$this->Hotel_Model->edit_fun($type_id);
		$this->load->view('hotel/edit_fun',$data);
	}
	function edit_fun_ed($type_id)
	{
		if (!$this->session->userdata('admin_logged_in')){
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_region']=$this->Hotel_Model->edit_fun_ed($this->input->post(),$type_id);
		redirect('hotel/bussines_list', 'refresh'); 
	}
	
	function delete_fun($type_id)
	{
		if (!$this->session->userdata('admin_logged_in')){
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_markets']=$this->Hotel_Model->delete_fun($type_id);
		redirect('hotel/bussines_list', 'refresh'); 
	}
	
	
	function location_list()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['bussines_list']=$this->Hotel_Model->location_list();
		$this->load->view('hotel/location_list',$data);
	}
	function inactive_loc($type_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_region']=$this->Hotel_Model->inactive_loc($type_id);
		redirect('hotel/location_list', 'refresh'); 
	}
	function active_loc($type_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_region']=$this->Hotel_Model->active_loc($type_id);
		redirect('hotel/location_list', 'refresh'); 
	}
	function edit_loc($type_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_paytype']=$this->Hotel_Model->edit_loc($type_id);
		$this->load->view('hotel/edit_loc',$data);
	}
	
	function edit_loc_ed($type_id)
	{
		if (!$this->session->userdata('admin_logged_in')){
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_region']=$this->Hotel_Model->edit_loc_ed($this->input->post(),$type_id);
		redirect('hotel/location_list', 'refresh'); 
	}
	
	function delete_loc($type_id)
	{
		if (!$this->session->userdata('admin_logged_in')){
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_markets']=$this->Hotel_Model->delete_loc($type_id);
		redirect('hotel/location_list', 'refresh'); 
	}
	
	
	function country_list()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['country_list']=$this->Hotel_Model->country_list();
		$this->load->view('hotel/country_list',$data);
	}
	function edit_country($country_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_country']=$this->Hotel_Model->edit_country($country_id);
		$this->load->view('hotel/edit_country',$data);
	}
	function edit_country_ed($country_id)
	{
		if (!$this->session->userdata('admin_logged_in')){
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_region']=$this->Hotel_Model->edit_country_ed($this->input->post(),$country_id);
		redirect('hotel/country_list', 'refresh'); 
	}
	
	function delete_country($country_id)
	{
		if (!$this->session->userdata('admin_logged_in')){
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_markets']=$this->Hotel_Model->delete_country($country_id);
		redirect('hotel/country_list', 'refresh'); 
	}
	
	function city_list()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['city_list']=$this->Hotel_Model->city_list();
		$this->load->view('hotel/city_list',$data);
	}	
	function inactive_city($city_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_region']=$this->Hotel_Model->inactive_city($city_id);
		redirect('hotel/city_list', 'refresh'); 
	}
	function active_city($city_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_region']=$this->Hotel_Model->active_city($city_id);
		redirect('hotel/city_list', 'refresh'); 
	}
	function edit_city($city_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_city']=$this->Hotel_Model->edit_city($city_id);
		$this->load->view('hotel/edit_city',$data);
	}
	function edit_city_ed($city_id)
	{
		if (!$this->session->userdata('admin_logged_in')){
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_region']=$this->Hotel_Model->edit_city_ed($this->input->post(),$city_id);
		redirect('hotel/city_list', 'refresh'); 
	}
	function delete_city($city_id)
	{
		if (!$this->session->userdata('admin_logged_in')){
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_markets']=$this->Hotel_Model->delete_city($city_id);
		redirect('hotel/city_list', 'refresh'); 
	}
	function area_list()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['area_list']=$this->Hotel_Model->area_list();
		$this->load->view('hotel/area_list',$data);
	}
	function inactive_area($area_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_region']=$this->Hotel_Model->inactive_area($area_id);
		redirect('hotel/area_list', 'refresh'); 
	}
	function active_area($area_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_region']=$this->Hotel_Model->active_area($area_id);
		redirect('hotel/area_list', 'refresh'); 
	}
	
	function edit_area($area_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['edit_area']=$this->Hotel_Model->edit_area($area_id);
		$this->load->view('hotel/edit_area',$data);
	}
	function edit_area_ed($area_id)
	{
		if (!$this->session->userdata('admin_logged_in')){
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_area']=$this->Hotel_Model->edit_area_ed($this->input->post(),$area_id);
		redirect('hotel/area_list', 'refresh'); 
	}
	function delete_area($area_id)
	{
		if (!$this->session->userdata('admin_logged_in')){
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_markets']=$this->Hotel_Model->delete_area($area_id);
		redirect('hotel/area_list', 'refresh'); 
	}
	function hotelType_list()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['Type_list']=$this->Hotel_Model->hotelType_list();
		$this->load->view('hotel/Type_list',$data);
	}
	function inactive_type($type_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_region']=$this->Hotel_Model->inactive_type($type_id);
		redirect('hotel/hotelType_list', 'refresh'); 
	}
	function active_type($type_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_region']=$this->Hotel_Model->active_type($type_id);
		redirect('hotel/hotelType_list', 'refresh'); 
	}
	function edit_type($type_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['edit_type']=$this->Hotel_Model->edit_type($type_id);
		$this->load->view('hotel/edit_type',$data);
	}
	function edit_type_ed($type_id)
	{
		if (!$this->session->userdata('admin_logged_in')){
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_area']=$this->Hotel_Model->edit_type_ed($this->input->post(),$type_id);
		redirect('hotel/hotelType_list', 'refresh'); 
	}
	function delete_type($type_id)
	{
		if (!$this->session->userdata('admin_logged_in')){
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_markets']=$this->Hotel_Model->delete_type($type_id);
		redirect('hotel/hotelType_list', 'refresh'); 
	}
	
	
	
	
	
	public function check_resion(){
		$result = $this->Hotel_Model->check_resion($this->input->post('resign_name'));
		echo $result;
	}
	
	public function add_region(){
		$data['result']=$this->Hotel_Model->add_region($this->input->post());
		echo $data['result'];exit; 
	}
	public function regiobyID()
	{
			$city='';
			$city.='<select name="hotel_region" id="hotel_region" class="form-control input-md" onchange="citytownList(this.value)">"
						<option value="">-Select Region-</option>';
						$country_list=$this->Hotel_Model->region_list($this->input->post('country_id'));
							if(isset($country_list) && $country_list!=''){
								foreach($country_list as $country){
							$city.='<option value="'.$country->r_no.'">'.$country->region_name.'</option>';
							}
						}
			$city.='</select>';
			echo $city;
	}
	public function check_cityTown()
	{
		$data['result']=$this->Hotel_Model->check_cityTown($this->input->post());
		echo $data['result'];exit; 
	}
	public function add_cityTown(){
		$data['result']=$this->Hotel_Model->add_cityTown($this->input->post());
		echo $data['result'];exit; 
	}
	public function citytownList()
	{
		$city='';
		$city.='<select name="hotel_city" id="hotel_city" class="form-control input-md" onchange="areaList(this.value)">"
					<option value="">-Select City/Town-</option>';
					$citytownList=$this->Hotel_Model->cityTownlist($this->input->post());
						if(isset($citytownList) && $citytownList!=''){
							foreach($citytownList as $town){
							$city.='<option value="'.$town->c_no.'">'.$town->city_name.'</option>';
						}
					}
		$city.='</select>';
		echo $city;
	}
	public function check_area()
	{
		$data['result']=$this->Hotel_Model->check_area($this->input->post());
		echo $data['result'];exit; 
	}
	public function add_Area(){
		$data['result']=$this->Hotel_Model->add_Area($this->input->post());
		echo $data['result'];exit; 
	}
	public function areaList()
	{
		$city='';
		$city.='<select name="hotel_area" id="hotel_area" class="form-control input-md">"
					<option value="">-Select City/Town-</option>';
					$citytownList=$this->Hotel_Model->areaList($this->input->post());
						if(isset($citytownList) && $citytownList!=''){
							foreach($citytownList as $town){
							$city.='<option value="'.$town->a_no.'">'.$town->area_name.'</option>';
						}
					}
		$city.='</select>';
		echo $city;
	}
	public function check_hotelStar()
	{
		$data['result']=$this->Hotel_Model->check_hotelStar($this->input->post('star'));
		echo $data['result'];exit; 
	}
	public function add_Star(){
		$data['result']=$this->Hotel_Model->add_Star($this->input->post('star'));
		echo $data['result'];exit; 
	}
	
	public function check_hotelType()
	{
		$data['result']=$this->Hotel_Model->check_hotelType($this->input->post('typename'));
		echo $data['result'];exit; 
	}
	public function add_hotelType(){
		$data['result']=$this->Hotel_Model->add_hotelType($this->input->post());
		echo $data['result'];exit; 
	}
	public function check_location()
	{
		$data['result']=$this->Hotel_Model->check_location($this->input->post('location'));
		echo $data['result'];exit; 
	}
	public function add_location(){
		$data['result']=$this->Hotel_Model->add_location($this->input->post());
		echo $data['result'];exit; 
	}
	public function check_bussines()
	{
		$data['result']=$this->Hotel_Model->check_bussines($this->input->post('bussiness'));
		echo $data['result'];exit; 
	}
	public function add_Business(){
		$data['result']=$this->Hotel_Model->add_Business($this->input->post());
		echo $data['result'];exit; 
	}
	public function check_PaymentType()
	{
		$data['result']=$this->Hotel_Model->check_PaymentType($this->input->post('Payment_name'));
		echo $data['result'];exit; 
	}
	public function add_payType(){
		$data['result']=$this->Hotel_Model->add_payType($this->input->post());
		echo $data['result'];exit; 
	}
	public function check_cards()
	{
		$data['result']=$this->Hotel_Model->check_cards($this->input->post('cards'));
		echo $data['result'];exit; 
	}
	public function add_cards(){
		$data['result']=$this->Hotel_Model->add_cards($this->input->post());
		echo $data['result'];exit; 
	}
	public function add_hotel_details()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$image='';$target= ROOT_PATH;$i=0;$main_image='';
		if (isset($_FILES) && $_FILES!=''){
			move_uploaded_file($_FILES['main_image']['tmp_name'],$target.$_FILES['main_image']['name']);
			$main_image=$_FILES['main_image']['name'];
		}
		
		if (isset($_FILES) && $_FILES!=''){
			$image=serialize($_FILES['image']['name']);
			foreach($_FILES['image']['tmp_name'] as $tmp_name){
				move_uploaded_file($tmp_name,$target.$_FILES['image']['name'][$i]);
				$i++;
			}
		}
		
		$data['result']=$this->Hotel_Model->add_hotel_detailsl($this->input->post(),$image,$main_image);
		redirect('hotel/hotel_manager', 'refresh'); 
	}
	public function edit_hotelDetails_ad($hotel_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data=$this->input->post();
		
		
		$image='';$target= ROOT_PATH;$i=0;$main_image='';
		if (isset($_FILES['main_image']['name']) && $_FILES['main_image']['name']!=''){
			move_uploaded_file($_FILES['main_image']['tmp_name'],$target.$_FILES['main_image']['name']);
			$main_image=$_FILES['main_image']['name'];
		}else{
			$main_image=$this->input->post('main_image1');
		}
		
		if (isset($_FILES) && $_FILES!=''){
			$img_db=explode(",",$this->input->post('img_db'));
			$arr=array_merge($_FILES['image']['name'],$img_db);
			$image=serialize($arr);
			foreach($_FILES['image']['tmp_name'] as $tmp_name){
				move_uploaded_file($tmp_name,$target.$_FILES['image']['name'][$i]);
				$i++;
			}
		}
		$data['hotel_details']=$this->Hotel_Model->edit_hotelDetails_ad($data,$hotel_id,$image,$main_image); 
		redirect('hotel/hotel_manager','refresh'); 
	}
	public function markup_all()
	{
		$base_price=$this->input->post('price');
		$hotel_id=$this->input->post('hotel_id');
		$details=$this->Hotel_Model->get_hotelDetails($hotel_id);
		
		$admin_markup=$this->Hotel_Model->get_adminMarkup(); 
		$net_pri = $base_price+($base_price*$admin_markup/100);
		
		$star_markup=$this->Hotel_Model->get_starMarkup($details->star);
		$net_pri = $net_pri+($net_pri*$star_markup/100);
		
		$country_markup=$this->Hotel_Model->get_countryMarkup($details->country);
		$net_pri = $net_pri+($net_pri*$country_markup/100);
		
		echo $net_pri ; die;
		//echo $admin_markup;exit; 
		//echo $base_price;exit; 
	}
	public function delete_img()
	{
		$img_main=$this->input->post('img_id');
		$hotel_id=$this->input->post('hotel_id');
		$img_db=explode(",",$this->input->post('img_db'));
		$a=array();
		
		foreach($img_db as $img){
			if($img_main!=$img){
				array_push($a,$img);
			}
		}
		$data['delete_img']=$this->Hotel_Model->delete_img($a,$hotel_id); 
		exit;
		
	}
	public function boardtype_manager()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['Type_list']=$this->Hotel_Model->boardtype_manager();
		$this->load->view('hotel/boardtype',$data);
	}
	public function inactive_boardtype($type_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['Type_list']=$this->Hotel_Model->inactive_boardtype($type_id);
		redirect('hotel/boardtype_manager','refresh'); 
	}
	public function active_boardtype($type_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['Type_list']=$this->Hotel_Model->active_boardtype($type_id);
		redirect('hotel/boardtype_manager','refresh'); 
	}
	public function add_boardtype()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$this->load->view('hotel/add_boardtype');
	}
	public function check_Boardtype()
	{
		$data['result']=$this->Hotel_Model->check_Boardtype($this->input->post('type'));
		echo $data['result'];exit; 
	}
	public function boardtype_ad()
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['result']=$this->Hotel_Model->boardtype_ad($this->input->post());
		
		redirect('hotel/boardtype_manager','refresh'); 
	}
	public function edit_boardtype($type_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['result']=$this->Hotel_Model->edit_boardtype($type_id);
		$this->load->view('hotel/edit_boardtype',$data);
	}
	public function boardtype_edit($type_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['result']=$this->Hotel_Model->boardtype_edit($this->input->post(),$type_id);
		redirect('hotel/boardtype_manager','refresh'); 
	}
	public function delete_boardtype($type_id)
	{	
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['result']=$this->Hotel_Model->delete_boardtype($type_id);
		redirect('hotel/boardtype_manager','refresh'); 
	}
	//----------------closing class-------------------//
}












