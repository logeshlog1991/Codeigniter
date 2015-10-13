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
	 if(empty($_SESSION['langA'])){
			$_SESSION['langA']='english';
	  }
	  $this->lang->load('fi',$_SESSION['langA']);
	}
	
	/*
	*  admin getting all hotels
	*/
	public function hotel_manager()
	{
		if (!$this->session->userdata('supplier_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$sup_id=$this->session->userdata('supplier_id');
		$hotel_id=$this->session->userdata('hotel_id');
		$data['result']=$this->Hotel_Model->getting_all_hotels($hotel_id);
		$this->load->view('hotel/hotel_list',$data);
	}
	function Active_roomManager()
	{
		$room_id=$this->uri->segment(3);
		$hotel_id=$this->uri->segment(4);
		$this->Hotel_Model->active_hotelTypes($room_id);
		redirect('hotel/room_list','refresh'); 
	}
	function Inactive_roomManager()
	{
		$room_id=$this->uri->segment(3);
		$hotel_id=$this->uri->segment(4);
		$this->Hotel_Model->Inactive_hotelTypes($room_id);
		redirect('hotel/room_list','refresh'); 
	}
		/*
	*  admin Inactive hotel
	*/
	public function Inactive_hotel($hotel_id) {
		$sup_id=$this->session->userdata('supplier_id');
		$data['result']=$this->Hotel_Model->Inactive_hotel($hotel_id,$sup_id);
		redirect('hotel/hotel_manager','refresh');
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
	*  admin going to add hotel page
	*/
	public function add_hotel()
	{
		if (!$this->session->userdata('supplier_logged_in')) {
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
		if (!$this->session->userdata('supplier_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data=$this->input->post();
		$sup_id=$this->session->userdata('supplier_id');
		$id=$this->Hotel_Model->add_hotel_details($data,$sup_id); 
		redirect('hotel/hotel_manager','refresh');
	}
	/*
	*  admin Active hotel
	*/
	public function Active_hotel($hotel_id) {
		
		$sup_id=$this->session->userdata('supplier_id');
		$data['result']=$this->Hotel_Model->Active_hotel($hotel_id,$sup_id);
		redirect('hotel/hotel_manager','refresh');
	}
	/*
	*  admin delete hotel
	*/
	public function delete_hotel($hotel_id) { 
		$sup_id=$this->session->userdata('supplier_id');
		$data['result']=$this->Hotel_Model->delete_hotel($hotel_id,$sup_id);
		redirect('hotel/hotel_manager','refresh');
	}
	
	/*
	*  admin getting the hotel details
	*/
	public function edit_hotel($hotel_id)
	{
		if (!$this->session->userdata('supplier_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$sup_id=$this->session->userdata('supplier_id');
		$data['hotel_details']=$this->Hotel_Model->getting_hotel_details($hotel_id,$sup_id); 
		$this->load->view('hotel/edit_hotel',$data);
	}
	/*
	*  admin update the hotel details
	*/
	public function edit_hotel_ad($hotel_id)
	{
		if (!$this->session->userdata('supplier_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data=$this->input->post();
		$sup_id=$this->session->userdata('supplier_id');
		$data['hotel_details']=$this->Hotel_Model->update_hotel($data,$hotel_id,$sup_id); 
		redirect('hotel/hotel_manager','refresh'); 
	}
	/*
	*  admin room category list
	*/
	function room_list()
	{
	 	if(!$this->session->userdata('supplier_logged_in'))
		{
            redirect('index/login');
        }
        $data['room_list']=$this->Hotel_Model->room_list();
        $this->load->view('hotel/room_list', $data);
	}
	function View_roomManager()
	{
		$room_id=$this->uri->segment(3);
		$hotel_id=$this->uri->segment(4);
		$data['hotel_details']=$this->Hotel_Model->get_hotel($hotel_id);
		$data['room_details']=$this->Hotel_Model->getting_room_category($room_id);
		if($_SESSION['langA']=='english')
		{
			$this->load->view('hotel/view_roomManager', $data);
		}else{
			$this->load->view('hotel/view_roomManagerA', $data);
		}
	}
	function edit_roomManager()
	{
		if(!$this->session->userdata('supplier_logged_in'))
		{
            redirect('index/login');
        }
		$room_id=$this->uri->segment(3);
		$hotel_id=$this->uri->segment(4);
		$data['room_category']=$this->Hotel_Model->room_cat_list();
        $data['room_type']=$this->Hotel_Model->room_type_list1();
		$data['services']=$this->Hotel_Model->get_global_amenities1();
		$data['room_details']=$this->Hotel_Model->getting_room_category($room_id);
        $data['hotels']=$this->Hotel_Model->get_hotel($hotel_id);
       $this->load->view('hotel/edit_roomManager',$data);
	}
	function add_roomMager()
	{
		if(!$this->session->userdata('supplier_logged_in'))
		{
            redirect('index/login');
        }
        $hotel_id=$this->session->userdata('hotel_id'); 
        $data['room_category']=$this->Hotel_Model->room_cat_list();
        $data['room_type']=$this->Hotel_Model->room_type_list1();
        $data['services']=$this->Hotel_Model->get_global_amenities1();
        $data['hotels']=$this->Hotel_Model->getting_all_hotels($hotel_id);
        $this->load->view('hotel/add_roomManager',$data);
    }
    function add_roomMager_ad()
	{
		if(!$this->session->userdata('supplier_logged_in'))
		{
            redirect('index/login');
        }
        $post=$this->input->post();
		$data['hotels']=$this->Hotel_Model->add_roomMager_ad($post);
		redirect('hotel/room_list','refresh'); 
	}
	function edit_roomMager_ad()
	{
		if(!$this->session->userdata('supplier_logged_in'))
		{
            redirect('index/login');
        }
        $room_id=$this->uri->segment(3);
		$hotel_id=$this->uri->segment(4);
		
        $post=$this->input->post();
		$data['hotels']=$this->Hotel_Model->edit_roomMager_ad($post,$room_id,$hotel_id);
		redirect('hotel/room_list','refresh'); 
	}
	/*
	*  admin room category list
	*/
	function room_category()
	{
		 if(!$this->session->userdata('supplier_logged_in'))
		 {
		   redirect('index/login','refresh');
		 }
		 $hotel_id=$this->session->userdata('hotel_id');
		 $data['room_category']=$this->Hotel_Model->room_type_list($hotel_id);
		 $this->load->view('hotel/roomcategory_list', $data);
	}
	/*
	*  admin adding room category 
	*/
	function add_category()
	{
	 	if(!$this->session->userdata('supplier_logged_in'))
		{
            redirect('index/login','refresh');
        }
		$hotel_id=$this->session->userdata('hotel_id'); 
        $data['services']=$this->Hotel_Model->roomfacility_list1();
        $data['hotels']=$this->Hotel_Model->getting_all_hotels($hotel_id);
        $this->load->view('hotel/add_roomcategory',$data);
	}
	function roomcategory_ad()
	{
	 	if(!$this->session->userdata('supplier_logged_in'))
		{
            redirect('index/login','refresh');
        }
        $sup_id=$this->session->userdata('supplier_id');
		$data=$this->input->post();
        $data['room_type'] = $this->Hotel_Model->add_room_type_details($data,$sup_id);
         redirect('hotel/add_roomtype','refresh'); 
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
	*  admin editing room category 
	*/
	function edit_category($category_id)
	{
		if(!$this->session->userdata('supplier_logged_in'))
		{
            redirect('index/login','refresh');
        }
        $sup_id=$this->session->userdata('supplier_id');
        $sup_hotel_id=$this->session->userdata('hotel_id');
        $category_id=$this->uri->segment(3);
        $data['services']=$this->Hotel_Model->get_global_amenities1();
        $data['hotels']=$this->Hotel_Model->getting_all_hotels($sup_hotel_id);
        $data['category']=$this->Hotel_Model->getting_room_category($category_id);
       // echo '<pre>';
        //print_r($data['category']);die;
        
        $this->load->view('hotel/edit_roomcategory',$data);
   }
	function editroomcategory_ad($category_id)
	{
		if(!$this->session->userdata('supplier_logged_in'))
		{
            redirect('index/login');
        }
		$data=$this->input->post();
        $data1=$this->input->post();
        $category_id=$data1['category_id12'];
        $data['category'] = $this->Hotel_Model->edit_room_type_details($data,$category_id);
		
		redirect('hotel/edit_category/'.$data1['category_id12'].'/'.$data1['hotel_id12'].'/'.$data1['roomtype_id12'].'/'.$data1['policy_id12'].'/'.$data1['capacity_id12'].'/-1','refresh'); 
    }
	/*
	*  admin delete room category 
	*/
	function delete_category($category_id)
	{
		if(!$this->session->userdata('supplier_logged_in'))
		{
            redirect('index/login','refresh');
        } 
        $data['category'] = $this->Hotel_Model->delete_room_category($category_id);
        redirect('hotel/room_category','refresh'); 
	}
	/*
	*  admin room type list 
	*/
	function roomtype_list()
	{
		if(!$this->session->userdata('supplier_logged_in'))
		{
            redirect('index/login','refresh');
        }
        $hotel_id=$this->session->userdata('hotel_id');
        $data['room_type'] = $this->Hotel_Model->roomtype_list($hotel_id);
		$this->load->view('hotel/roomtype_list',$data);
	}
	/*
	*  admin add room type  
	*/
	function add_roomtype()
	{
		if(!$this->session->userdata('supplier_logged_in'))
		{
            redirect('index/login','refresh');
        }
        $sup_id=$this->session->userdata('supplier_id');
        $hotel_id=$this->session->userdata('hotel_id');
        $data['hotels']=$this->Hotel_Model->getting_all_hotels($hotel_id);
        $this->load->view('hotel/add_roomtype',$data);
    }
    function roomtype_ad()
	{
		if(!$this->session->userdata('supplier_logged_in'))
		{
            redirect('index/login','refresh');
        }
        $sup_id=$this->session->userdata('supplier_id');
        $roomtype=$this->input->post();
        $data['roomtype'] = $this->Hotel_Model->roomtype_ad($roomtype,$sup_id);
       redirect('hotel/add_room','refresh'); 
    }
    /*
	*  admin edit room type  
	*/
	function edit_roomtype($roomtype_id)
	{
		if(!$this->session->userdata('supplier_logged_in'))
		{
           redirect('index/login','refresh');
        }
        $sup_hotel_room_type_id=$this->uri->segment(3);
		$hotel_id=$this->uri->segment(4);
		$sup_inv_cate_type_id=$this->uri->segment(5);
		$sup_apart_houserules_id=$this->uri->segment(6);
		$room_type_id=$this->uri->segment(7);
        
        $data['hotels']=$this->Hotel_Model->getting_all_hotels($hotel_id);
         
        $data['room_cate']=$this->Hotel_Model->get_allroomCate($hotel_id);
        $category_id=$this->uri->segment(4);
 
        $data['roomtype'] = $this->Hotel_Model->edit_roomtype($sup_hotel_room_type_id,$room_type_id);
        //~ echo '<pre>';
        //~ print_r($data['roomtype'] );die;
        
        
        $this->load->view('hotel/edit_roomtype',$data);
	}
	function editroomtype_ad($roomtype_id)
	{
		if(!$this->session->userdata('supplier_logged_in'))
		{
            redirect('index/login','refresh');
        }
        
        $roomtype=$this->input->post();
        $data1=$this->input->post();
        
        $data['roomtype'] = $this->Hotel_Model->editroomtype_ad($roomtype,$data1['roomtype_id12']);
        redirect('hotel/edit_roomtype/'.$data1['category_id12'].'/'.$data1['hotel_id12'].'/'.$data1['roomtype_id12'].'/'.$data1['policy_id12'].'/'.$data1['capacity_id12'].'/-1','refresh'); 
   }
	/*
	*  admin delete room category 
	*/
	function delete_roomtype($roomtype_id)
	{
		if(!$this->session->userdata('supplier_logged_in'))
		{
            redirect('index/login','refresh');
        }
         
        $data['category'] = $this->Hotel_Model->delete_roomtype($roomtype_id);
        redirect('hotel/roomtype_list','refresh'); 
	}
	/*
	*  admin room count list 
	*/
	function roomcount_list()
	{
		if(!$this->session->userdata('supplier_logged_in'))
		{
            redirect('index/login','refresh');
        }
        $hotel_id=$this->session->userdata('hotel_id');
        $data['room_count'] = $this->Hotel_Model->roomcount_list($hotel_id);
        $this->load->view('hotel/roomcount_list',$data);
	}
	/*
	*  admin add room count  
	*/
	function add_room()
	{
		if(!$this->session->userdata('supplier_logged_in'))
		{
            redirect('index/login','refresh');
        }
        $sup_id=$this->session->userdata('supplier_id');
        $hotel_id=$this->session->userdata('hotel_id');
        $data['hotels']=$this->Hotel_Model->getting_all_hotels($hotel_id);
        $this->load->view('hotel/add_room',$data);
	}
	//admin get room type
	function getRoomType($hotel_id)
	{
		if(!$this->session->userdata('supplier_logged_in'))
		{
            redirect('index/login','refresh');
        }
		$data['room_type'] = $this->Hotel_Model->getRoomType($hotel_id);
	}
	//admin get room type
	function roomcount_ad()
	{
		if(!$this->session->userdata('supplier_logged_in'))
		{
            redirect('index/login','refresh');
        }
        $sup_id=$this->session->userdata('supplier_id');
        $post=$this->input->post();
        $data['room_count'] = $this->Hotel_Model->roomcount_ad($post,$sup_id);
		redirect('hotel/add_roompolicy');
   }
   /*
	*  admin delete room category 
	*/
	function delete_roomcount($roomcount_id)
	{
		if(!$this->session->userdata('supplier_logged_in'))
		{
           redirect('index/login','refresh');
        }
        $data['room_count'] = $this->Hotel_Model->delete_roomcount($roomcount_id);
        redirect('hotel/roomcount_list','refresh'); 
	}
	/*
	*  admin edit room count  
	*/
	function edit_roomcount($roomcount_id)
	{
		if(!$this->session->userdata('supplier_logged_in'))
		{
            redirect('index/login','refresh');
        }
       
        $sup_hotel_room_type_id=$this->uri->segment(3);
		$hotel_id=$this->uri->segment(4);
		$sup_inv_cate_type_id=$this->uri->segment(5);
		$sup_apart_houserules_id=$this->uri->segment(6);
		$room_type_id=$this->uri->segment(7);
        
        $data['hotels']=$this->Hotel_Model->getting_all_hotels($hotel_id);
        $data['room_count'] = $this->Hotel_Model->edit_roomcount($sup_inv_cate_type_id);
		$this->load->view('hotel/edit_room',$data);
	}
	
	function edit_roomcount_ad($roomcount_id)
	{
		if(!$this->session->userdata('supplier_logged_in'))
		{
            redirect('index/login','refresh');
        }
        $post=$this->input->post();
        $data1=$this->input->post();
        $data['room_count'] = $this->Hotel_Model->edit_roomcount_ad($post,$data1['capacity_id12']);
        redirect('hotel/edit_roomcount/'.$data1['category_id12'].'/'.$data1['hotel_id12'].'/'.$data1['roomtype_id12'].'/'.$data1['policy_id12'].'/'.$data1['capacity_id12'].'/-1','refresh'); 	
	}
	//admin get roompolicy list
	function roompolicy_list()
    {
        if(!$this->session->userdata('supplier_logged_in'))
		{
            redirect('index/login','refresh');
        }
        $hotel_id=$this->session->userdata('hotel_id');
        $data['room_policy']=$this->Hotel_Model->roompolicy_list($hotel_id);
        $this->load->view('hotel/roompolicy_list',$data);
    }
    //admin add room policy
    function add_roompolicy()
    {
		if(!$this->session->userdata('supplier_logged_in'))
		{
            redirect('index/login','refresh');
        }
        $hotel_id=$this->session->userdata('hotel_id');
		$data['hotels']=$this->Hotel_Model->getting_all_hotels($hotel_id);
		$this->load->view('hotel/add_roompolicy',$data);
	}
	function roompolicy_ad()
    {
		if(!$this->session->userdata('supplier_logged_in'))
		{
            redirect('index/login','refresh');
        }
        $sup_id=$this->session->userdata('supplier_id');
        $post=$this->input->post();
        $data['room_policy'] = $this->Hotel_Model->roompolicy_ad($post,$sup_id);
		redirect('hotel/room_list');
	}
	//admin edit room policy
	function edit_roomplicy($roomploicy_id)
    {
		if(!$this->session->userdata('supplier_logged_in'))
		{
           redirect('index/login','refresh');
        }
        $sup_hotel_room_type_id=$this->uri->segment(3);
		$hotel_id=$this->uri->segment(4);
		$sup_inv_cate_type_id=$this->uri->segment(5);
		$sup_apart_houserules_id=$this->uri->segment(6);
		$room_type_id=$this->uri->segment(7);
        
        $data['hotels']=$this->Hotel_Model->getting_all_hotels($hotel_id);
        $data['room_policy'] = $this->Hotel_Model->get_roompolicy($sup_apart_houserules_id);
        $this->load->view('hotel/edit_roompolicy',$data);
	}
	function edit_roompolicy_ad($roomploicy_id)
    {
		if(!$this->session->userdata('supplier_logged_in'))
		{
            redirect('index/login','refresh');
        }
		$post=$this->input->post();
		$data1=$this->input->post();
        $data['room_policy'] = $this->Hotel_Model->edit_roompolicy_ad($post,$data1['policy_id12']);
        redirect('hotel/edit_roomplicy/'.$data1['category_id12'].'/'.$data1['hotel_id12'].'/'.$data1['roomtype_id12'].'/'.$data1['policy_id12'].'/'.$data1['capacity_id12'].'/-1','refresh'); 	
	}
	 /*
	*  admin delete room policy 
	*/
	function delete_roomplicy($roomploicy_id)
	{
		if(!$this->session->userdata('supplier_logged_in'))
		{
            redirect('index/login','refresh');
        }
       
        $data['room_count'] = $this->Hotel_Model->delete_roomplicy($roomploicy_id);
        redirect('hotel/roompolicy_list');
	}
	 /*
	*  admin getting price manager 
	*/
	function price_manager()
	{
		if(!$this->session->userdata('supplier_logged_in'))
		{
            redirect('index/login','refresh');
        }
        $hotel_id=$this->session->userdata('hotel_id');
        $data['price_manager'] = $this->Hotel_Model->price_list($hotel_id);
        $data['mark']=$this->Hotel_Model->get_adminMarkup();
        $data['gate_markup']=$this->Hotel_Model->get_paymentGateway();
        $data['callcenter_markup']=$this->Hotel_Model->get_callMarkup();
        $this->load->view('hotel/pricemanager_list',$data);
   }
	function add_pricemanager()
	{
		if(!$this->session->userdata('supplier_logged_in'))
		{
            redirect('index/login','refresh');
        }
		$sup_id=$this->session->userdata('supplier_id'); 
		$hotel_id=$this->session->userdata('hotel_id');
		$data['Board_Type']=$this->Hotel_Model->getting_all_Board_Type();
        $data['hotels']=$this->Hotel_Model->getting_all_hotels($hotel_id); 
        $this->load->view('hotel/add_pricemanager',$data);
    }
    //admin create getdates
    function getDates()
    {
		if(!$this->session->userdata('supplier_logged_in'))
		{
            redirect('index/login','refresh');
        }
		$results = $this->Hotel_Model->getDates($_POST);
    }
    //add room rates
    function add_pricemanager_ad()
	{
		if(!$this->session->userdata('supplier_logged_in'))
		{
            redirect('index/login','refresh');
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
	function view_price($price_id)
	{
		if(!$this->session->userdata('supplier_logged_in'))
		{
            redirect('index/login');
        }
        $data['Board_Type']=$this->Hotel_Model->getting_all_Board_Type();
        $hotel_id=$this->session->userdata('hotel_id');
        $data['hotels']=$this->Hotel_Model->getting_all_hotels($hotel_id);
       
        $data['rat_tac_details'] = $this->Hotel_Model->get_rate_tactics_details1($price_id);
        //~ echo '<pre>';
        //~ print_r($data['rat_tac_details']);die;
        $data['img_path']=IMG_PATH;
        
        //$data['mark']=$this->Hotel_Model->get_adminMarkup();
        //$data['gate_markup']=$this->Hotel_Model->get_paymentGateway();
        //$data['price_manager'] = $this->Hotel_Model->get_priceManager($price_id);
        //~ echo '<pre>';
        //~ print_r($data['price_manager']);die;
        
        $this->load->view('hotel/view_price',$data);
    }
	function delete_pricemanager($tacktics_id)
	{
		if(!$this->session->userdata('supplier_logged_in'))
		{
           redirect('index/login','refresh');
        }
        
        $data['room_price'] = $this->Hotel_Model->delete_pricemanager($tacktics_id);
        redirect('hotel/price_manager');
	}
	function edit_pricemanager($tacktics_id)
	{
		if(!$this->session->userdata('supplier_logged_in'))
		{
            redirect('index/login','refresh');
        }
        $data['Board_Type']=$this->Hotel_Model->getting_all_Board_Type();
        $hotel_id=$this->session->userdata('hotel_id');
        $data['hotels']=$this->Hotel_Model->getting_all_hotels($hotel_id);
        $data['rat_tac_details'] = $this->Hotel_Model->get_rate_tactics_details1($tacktics_id);
        
        $data['img_path']=IMG_PATH;
        $this->load->view('hotel/edit_pricemanager',$data);
	}
	 //admin get acvail dates
	function getAvailDates()
	{
		if(!$this->session->userdata('supplier_logged_in'))
		{
            redirect('index/login','refresh');
        }
		$results = $this->Hotel_Model->getAvailDates();
	}
	function Inactive_price($price_id)
	{
		if(!$this->session->userdata('supplier_logged_in'))
		{
            redirect('index/login');
        }
        $data['price_manager'] = $this->Hotel_Model->Inactive_price($price_id);
        redirect('hotel/price_manager');
	}
	function Active_price($price_id)
	{
		if(!$this->session->userdata('supplier_logged_in'))
		{
            redirect('index/login');
        }
        $data['price_manager'] = $this->Hotel_Model->Active_price($price_id);
        redirect('hotel/price_manager');
	}
	
	  //admin edit price manager
	function edit_pricemanager_ad($tacktics_id)
	{
		if(!$this->session->userdata('supplier_logged_in'))
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
				$achild = 0;
				$child_price = $this->input->post('child_price');
				$infant = 0;
			
			$this->Hotel_Model->edit_pricemanager_ad($rack_price,$sell_price,$child_policyA,$cancel_policy_descA,$tacktics_id,$market_id,$cancel_policy_desc,$board_type,$hotel_id,$room_cate,$room_type,$child_policy,$cancel_policy_nights,$cancel_policy_percent,$cancel_policy_charge,$cancel_policy_from,$cancel_policy_to,$room_avail_date_from,$room_avail_date_to,$dates,$weekday,$price,$extra_bed_price,$avail,$aadult,$achild,$child_price,$infant,$fileimage,$fileimage1,$fileimage2,$fileimage3);
			redirect('hotel/price_manager');
		}
	}
	/*
	*  admin getting hotel booking_details
	*/
	function booking_details()
	{
		if (!$this->session->userdata('supplier_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['type']="Confirm";
		  $hotel_id=$this->session->userdata('hotel_id');
		$data['booking_info'] = $this->Hotel_Model->B2C_bookingReports($hotel_id);
		$this->load->view('hotel/B2C_bookingReports',$data);
	}
	function B2C_bookingReports()
	{
		if (!$this->session->userdata('supplier_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['type']="Confirm";
		  $hotel_id=$this->session->userdata('hotel_id');
		$data['booking_info'] = $this->Hotel_Model->B2C_bookingReports($hotel_id);
		$this->load->view('hotel/B2C_bookingReports',$data);
	}
	
	/*
	*  admin getting hotel booking_details
	*/
	function booking_price()
	{
		if (!$this->session->userdata('supplier_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['type']="Confirm";
		 $hotel_id=$this->session->userdata('hotel_id');
		$data['booking_info'] = $this->Hotel_Model->B2C_bookingReports($hotel_id);
		$this->load->view('hotel/B2C_bookingprice',$data);
	}
	//admin getting amenity list
	function amenity_list()
	{
		if(!$this->session->userdata('supplier_logged_in'))
		{
           redirect('index/login','refresh');
        }
        $data['amenity'] =$this->Hotel_Model->get_global_amenities1();
        $this->load->view('hotel/amenity_list',$data);
	}
	//admin adding amenity
	function add_amenity()
	{
		if(!$this->session->userdata('supplier_logged_in'))
		{
            redirect('index/login','refresh');
        }
		$sup_id=$this->session->userdata('supplier_id'); 
        $this->Hotel_Model->add_amenity($_POST['amenity'],$sup_id);
		redirect('hotel/amenity_list', 'refresh'); 
	}
	//admin deleting amenity
	function delete_amenity($amenity_id)
	{
		if(!$this->session->userdata('supplier_logged_in'))
		{
            redirect('index/login','refresh');
        }
        $this->Hotel_Model->delete_amenity($amenity_id);
		redirect('hotel/amenity_list', 'refresh'); 
	}
	//admin edit amenity
	
	function edit_amenity($amenity_id)
	{
		if(!$this->session->userdata('supplier_logged_in'))
		{
            redirect('index/login','refresh');
        }
       $data['amenity_name']=$this->Hotel_Model->get_amenity($amenity_id);
       $this->load->view('hotel/edit_amenity',$data);
	}
    function editamenity_ad($amenity_id)
    {
		if(!$this->session->userdata('supplier_logged_in'))
		{
            redirect('index/login','refresh');
        }
        $amenity_name=$this->input->post('amenity');
        $this->Hotel_Model->editamenity_ad($amenity_id,$amenity_name);
        redirect('hotel/amenity_list', 'refresh'); 
	}
	/*
	*  admin getting hotel booking_details
	*/
function booking_details1()
	{
		if (!$this->session->userdata('supplier_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['type']="Confirm";
		$sup_id=$this->session->userdata('supplier_id'); 
		$data['supplier_hotels']=$this->Hotel_Model->get_supplier_hotel($sup_id); 
		$hotel_id=$this->session->userdata('hotel_id');
		
		$data['booking_info'] = $this->Hotel_Model->get_booking_info($hotel_id);//print_r($data['booking_info'] ); die;
		$this->load->view('hotel/booking_details',$data);
	}

	/*
	*  admin  hotel booking_details download
	*/
	function download()
	{
		if (!$this->session->userdata('supplier_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		
		header("Content-type: text/csv");
		header("Content-Disposition: attachment; filename=bookinginfo.csv");
		header("Pragma: no-cache");
		header("Expires: 0");
		$result = $this->Hotel_Model->get_booking_info();
		$data=array();
		$data[]=array('Sno','Booking ID','Booking Date','CheckIn','First Name','Last Name','E-mail ID','TelePhone','City','Hotel Name','TelePhone','City','No of Rms','Room Type','Basis','Status','Purchase Price','Currency','Selling Price','Profit','Payment Gateway Charge','Profit after Payment Gateway Charges');
		
		$i=1;$grand=0;$bookings=0;
		if(isset($result) && $result!=''){
			foreach($result as $info){
					$a = explode("-",$info->room_type);
					$data[]=array($i,$info->prn_no,$info->created_date,$info->check_in,$info->first_name,$info->last_name,$info->email,$info->phone,$info->city,$info->hotel_name,$info->phone,$info->city,$info->no_of_room,$a[0],$a[1],$info->status,round($info->amount-($info->markup+$info->gateway)),$info->req_currency,round($info->amount),round($info->markup),round($info->gateway),round($info->markup+$info->gateway));
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
	
		//admin get roompolicy list
	function roomfacility_list()
    {
        if(!$this->session->userdata('supplier_logged_in'))
		{
            redirect('index/login','refresh');
        }
        $data['room_fac_list']=$this->Hotel_Model->roomfacility_list1();
        $this->load->view('hotel/roomfacility_list',$data);
    }
    
       /*
	*  admin add room facilites 
	*/
	public function add_roomfacilites()
	{
		if(!$this->session->userdata('supplier_logged_in'))
		{
             redirect('index/login','refresh');
        }
        $sup_id=$this->session->userdata('supplier_id');
		$date['Room_Facilities']=$this->input->post();
		$data['Room_Facilities']=$this->Hotel_Model->add_roomfacilites($date['Room_Facilities'], $sup_id);
		redirect('hotel/roomfacility_list', 'refresh');
	}
	
	/*
	*  admin active room facilites 
	*/
	public function Active_room_fac($fac_id)
	{
		if (!$this->session->userdata('supplier_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_details']=$this->Hotel_Model->Active_room_fac($fac_id);
		redirect('hotel/roomfacility_list', 'refresh');
	}
	
	    /*
	*  admin Inactive room facilites 
	*/
	public function InActive_room_fac($fac_id)
	{
		if (!$this->session->userdata('supplier_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_details']=$this->Hotel_Model->InActive_room_fac($fac_id);
		redirect('hotel/roomfacility_list', 'refresh');
	}
	
		/*
	*  admin Delete the room and hotel facilites
	*/
	public function delete_room_fac($fac_id)
	{
		if (!$this->session->userdata('supplier_logged_in')) {
			redirect('index/login', 'refresh'); 
		}
		$data['hotel_details']=$this->Hotel_Model->delete_Rfacilites($fac_id);
		redirect('hotel/roomfacility_list', 'refresh');
	}
	function voucher()
	{
		$data['hotel_info']=$this->Hotel_Model->get_hotel($this->uri->segment(3));
		$data['book_info']=$this->Hotel_Model->get_bookhotel($this->uri->segment(4));
		$this->load->view('voucher',$data);
	}
	
//-----------closing class-----------//

}
