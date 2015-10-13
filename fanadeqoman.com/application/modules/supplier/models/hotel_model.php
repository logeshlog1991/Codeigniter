<?php
class Hotel_Model extends CI_Model {
	
	public function __construct()
    {
      parent::__construct();
    }
    public function get_adminMarkup()
	{
		$sql="SELECT * FROM admin";
		$rs=$this->db->query($sql);
		
		if($rs->num_rows() ==''){
			return 0;
		}else{
			return $rs->row()->admin_markup;
		}
	}
	public function get_starMarkup($star)
	{
		$select = "SELECT B.star_markup FROM star A LEFT JOIN star_markup B ON B.star_name = A.star WHERE A.s_no = '".$star."'"; 
		$rs=$this->db->query($select);
		if($rs->num_rows() ==''){
			return 0;
		}else{
			return $rs->row()->star_markup;
		}
	}
	public function get_countryMarkup($country_id)
	{
		$sql="SELECT country_markup FROM country_markup where country_id='".$country_id."'";
		$rs=$this->db->query($sql);
		
		if($rs->num_rows() ==''){
			return 0;
		}else{
			return $rs->row()->country_markup;
		}
	}
	public function get_paymentGateway(){
		$query = $this->db->get_where('payment_charge',array('status'=>1));
		if($query->num_rows()>0){
			return $query->row()->charge;
		}else{
			return'';
		}
	}
	public function get_callMarkup(){
		$query = $this->db->get_where('callcenter_agents',array('status'=>1));
		if($query->num_rows()>0){
			return $query->row()->callcenter_markup;
		}else{
			return'';
		}
	}
    function get_Region($region_id)
	{
		$query = $this->db->get_where('country_region',array('r_no'=>$region_id));
		if($query->num_rows()>0){
			if($_SESSION['langA']=='english')
			{
				return $query->row()->region_name;
			}else{
				return $query->row()->region_nameA;
			}
		}else{
			return'';
		}
	}
	public function get_City($city_id)
	{
		$query = $this->db->get_where('city_town',array('c_no'=>$city_id));
		if($query->num_rows()>0){
			if($_SESSION['langA']=='english')
			{
				return $query->row()->city_name;
			}else{
				return $query->row()->city_nameA;
			}
		}else{
			return'';
		}
	}
	public function get_Area($area_id)
	{
		$query = $this->db->get_where('area',array('a_no'=>$area_id));
		if($query->num_rows()>0){
			if($_SESSION['langA']=='english')
			{
				return $query->row()->area_name;
			}else{
				return $query->row()->area_nameA;
			}
		}else{
			return'';
		}
	}
	public function get_Loc($location_id){
		$query = $this->db->get_where('hotel_locations',array('loc_sno'=>$location_id));
		if($query->num_rows()>0){
			if($_SESSION['langA']=='english')
			{
				return $query->row()->location_name;
			}else{
				return $query->row()->location_nameA;
			}
		}else{
			return '';
		}
	}
	public function get_Amen($amen_id){
		$query = $this->db->get_where('global_amenity_list',array('amenity_list_id'=>$amen_id));
		if($query->num_rows()>0){
			return $query->row()->amenity_name;
		}else{
			return '';
		}
	}
	public function get_bussines($amen_id){
		$query = $this->db->get_where('sup_hotel_others',array('others_id'=>$amen_id));
		if($query->num_rows()>0){
			return $query->row()->others_name;
		}else{
			return '';
		}
	}
  	 /*
	  *  admin getting all time zones
	 */
	public function fetch_time_zone()
	{
		$sql="SELECT * FROM sup_apart_timezone_list";
		$rs=$this->db->query($sql);
		
		if($rs->num_rows() ==''){
			return '';
		}else{
			return $rs->result();
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
	 /*
	  *  admin getting all Curency values
	 */
	public function fetch_currency_val()
	{
		$sql="SELECT * FROM currency_converter";
		$rs=$this->db->query($sql);
		
		if($rs->num_rows() ==''){
			return '';
		}
		else
		{
			return $rs->result();
		}
	}
     /*
     * admin adding hotel market
     */
    public function add_market($value)
	{
		$sql="INSERT INTO sup_hotel_markets(market_id, market_name, status) VALUES('', '$value' ,'1')";
		$rs=$this->db->query($sql);
		
	}
	/*
	*  admin going to check hotel is exit or not
	*/
	public function hotel_check($hotel_name)
	{
		$sql="SELECT * FROM sup_hotels WHERE status=1 and hotel_name='".$hotel_name."'";
		$res=$this->db->query($sql);
		if($res->num_rows() ==''){
			return 0;
		}else{
			return 1;
		}
	}
	 //admin edit room type
	function get_allroomCate($hotel_id)
	{
		$select = "SELECT r.*,c.* FROM sup_hotel_room_type r INNER JOIN sup_hotel_capacity c ON c.hotel_id=r.hotel_id  WHERE r.hotel_id = '".$hotel_id."' group by r.hotel_room_type"; 
		$query=$this->db->query($select);
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	 /*
     * adding hotel details
     */
    public function add_hotel_details($hotel,$sup_id)
	{
		$market_name='';
		if(isset($hotel['market_name'])){
			$market_name=serialize($hotel['market_name']);
		}
		$data = array(
			 'sup_id' => $sup_id,
			 'market_name' =>$market_name ,
			 'hotel_name' => $hotel['hotel_name'],	   				 
			 'city_country_name' => $hotel['city_name'],
			 'main_last_name' => $hotel['last_name'],
			 'main_first_name' => $hotel['first_name'],
			 'main_email' => $hotel['email'],
			 'address' => $hotel['hotel_address'],
			'res_phone' => $hotel['mobile_number'],
			 'res_fax' => $hotel['fax'],
			 'descrip' => $hotel['hotel_description'],
			 'nearby_airport' => $hotel['nearby_airport'],
			 'latitude' => $hotel['latitude'],	   				 
			 'longitude' => $hotel['longitude'],
			 'status' => 1
			 );
			 
	   if($this->db->insert('sup_hotels', $data)) 
	   {
		  return true;
	   }else{
		  return false;
	   }
	}
	/*
     * admin Active hotel
     */
    public function Active_hotel($hotel_id,$sup_id)
	{
		$data = array('status' => '1');
		$this->db->where('sup_hotel_id',$hotel_id);
		$this->db->where('sup_id',$sup_id);
		if ($this->db->update('sup_hotels', $data)) {
			return true;
		}else{
			return false;
		}
	}
	/*
     * admin Inactive hotel
     */
    public function Inactive_hotel($hotel_id,$sup_id)
	{
		$data = array('status' => '0');
		$this->db->where('sup_hotel_id',$hotel_id);
		$this->db->where('sup_id',$sup_id);
		if ($this->db->update('sup_hotels', $data)) {
			return true;
		}else{
			return false;
		}
	}
	/*
     * admin Inactive hotel
     */
    public function delete_hotel($hotel_id,$sup_id)
	{
		$delqry = "DELETE FROM sup_hotels WHERE sup_hotel_id = '".$hotel_id."' AND sup_id='".$sup_id."'"; 
		$query=$this->db->query($delqry);
	}
	 /*
     * admin getting all markets
     */
	public function fetch_markets()
	{
		$sql="SELECT * FROM sup_hotel_markets WHERE status=1";
		$res=$this->db->query($sql);
		if($res->num_rows() ==''){
			return '';
		}else{
			return $res->result();
		}
	}
	
	/*
	*  admin getting the hotel details
	*/
	public function getting_hotel_details($hotel_id, $sup_id)
	{
		$sql="SELECT * FROM sup_hotels WHERE sup_hotel_id='".$hotel_id."' AND sup_id='".$sup_id."'"; 
		$res=$this->db->query($sql);
		if($res->num_rows() ==''){
			return '';
		}else{
			return $res->row();
		}
	}
	/*
	*  admin going to check edit hotel is exit or not
	*/
	public function hotel_check_edit($hotel_name,$hotel_id)
	{
		$sql1="SELECT * FROM sup_hotels WHERE sup_hotel_id='".$hotel_id."'";
		$res1=$this->db->query($sql1);
		$result=$res1->row();
		if($hotel_name==$result->hotel_name){
			return 0;
		}else{
			$sql="SELECT * FROM sup_hotels WHERE hotel_name='".$hotel_name."'";
			$res=$this->db->query($sql);
			$result1=$res1->row();
			if($hotel_name==$result1->hotel_name){
				return 0;
			}else if($res->num_rows() ==''){
				return 0;
			}else{
				return 1;
			}
		}
	} 
	/*
	*  admin update the hotel details
	*/
	public function update_hotel($hotel,$hotel_id,$sup_id)
	{
			$market_name='';
			if(isset($hotel['market_name'])){
				$market_name=serialize($hotel['market_name']);
			}
			$data = array(
					 'market_name' =>$market_name ,
					 'hotel_name' => $hotel['hotel_name'],	   				 
					 'city_country_name' => $hotel['city_name'],
					 'main_last_name' => $hotel['last_name'],
					 'main_first_name' => $hotel['first_name'],
					 'main_email' => $hotel['email'],
					 'address' => $hotel['hotel_address'],	   				 
					 'res_phone' => $hotel['mobile_number'],
					 'res_fax' => $hotel['fax'],
					 'descrip' => $hotel['hotel_description'],
					 'nearby_airport' => $hotel['nearby_airport'],
					 'latitude' => $hotel['latitude'],	   				 
					 'longitude' => $hotel['longitude'],
					 'status' => 1
				 );
			$where = "sup_hotel_id = '".$hotel_id."'";
	
			if ($this->db->update('sup_hotels', $data, $where)) {
				return true;
			}else{
				return false;
			}
		}
	
	 function room_type_list($hotel_id)
	 {
		$select = "SELECT A.sup_hotel_room_type_id, A.hotel_id, A.hotel_room_type, A.hotel_room_services, B.status, B.hotel_name, B.hotel_chain_name, B.city
                        FROM sup_hotel_room_type A 
                        INNER JOIN sup_hotels B ON B.sup_hotel_id = A.hotel_id 
                        WHERE A.hotel_id='$hotel_id' AND B.status = '1'";
        
		$query=$this->db->query($select);
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	 }
	  //to get global amenities
	 public function get_global_amenities()
     {		
	 	$this->db->select('*');
		$this->db->from('sup_hotel_room_facility');
		$this->db->order_by("sup_fac_id", "desc");
		$query = $this->db->get();
		if($query->num_rows() ==''){
			return '';			
		}else{
			return $query->result();				
		}
     }
     
     //to get global amenities
	 public function get_global_amenities1()
     {		
	 	$this->db->select('*');
		$this->db->from('sup_hotel_room_facility');
		$this->db->order_by("sup_fac_id", "desc");
		$query = $this->db->get();
		if($query->num_rows() ==''){
			return '';			
		}else{
			return $query->result();				
		}
	}
	function get_country($country_id)
	{
		$this->db->select('*');
		$this->db->from('country');
		$this->db->where('country_id',$country_id);
		$query = $this->db->get();
		if($query->num_rows()>0)
		{
			if($_SESSION['langA']=='english')
			{
				return $query->row()->name;
			}else{
				return $query->row()->nameA;
			}
		}else{
			return '';;
		}
	}
	  //to room type list
	 function get_hotelCat($hotel_id)
	 {
		$select = "SELECT A.sup_hotel_room_type_id, A.hotel_room_type FROM sup_hotel_room_type A INNER JOIN sup_hotels B ON B.sup_hotel_id = A.hotel_id 
					WHERE A.hotel_id = '".$hotel_id."'"; 
		$query=$this->db->query($select);
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	 }	
     
     //adding room category
	function add_room_type_details($room_data,$sup_id)
	{   
		$sql="INSERT INTO `sup_hotel_room_type` (`hotel_id`,`sup_id`, `hotel_room_type`, `hotel_room_typeA`,`hotel_room_services`,`room_desc`,`room_descA`) VALUES ('".$room_data['hotel_name']."','".$sup_id."', '".$room_data['room_category']."','".$room_data['room_categoryA']."','".serialize($room_data['service'])."','".$room_data['room_desc']."','".$room_data['room_descA']."')";
		$res=$this->db->query($sql);
		if ($res) {
			return true;
		} else {
			return false;
		}
	}
	/*
	*  admin update the room category
	*/
	public function edit_room_type_details($category,$category_id)
	{ 
			if($category['room_categoryA']==''){
				$category['room_categoryA']=$category['room_category'];
			}
			if($category['room_descA']){
				 $category['room_descA']= $category['room_desc'];
			}
			$data = array(
					 'hotel_id' => $category['hotel_name'],
					 'hotel_room_type' => $category['room_category'],	   				 
					 'hotel_room_services' => serialize($category['service']),
					 'hotel_room_typeA' => $category['room_categoryA'],	   				 
					 'hotel_room_services' => serialize($category['service']),
					 'room_desc' => $category['room_desc'],
					 'room_descA' => $category['room_descA']
					);
			$where = "sup_hotel_room_type_id = '".$category_id."'";
			if ($this->db->update('sup_hotel_room_type', $data, $where)) {
				return true;
			}else{
				return false;
			}
	 }
	//to room type list
	 function room_list()
	 {
		$hotel_id=$this->session->userdata('hotel_id');
		$select = "SELECT A.*, B.*,A.status as main_status FROM sup_roomManager A LEFT JOIN sup_hotels B ON B.sup_hotel_id = A.hotel_id where A.hotel_id='".$hotel_id."'";
		$query=$this->db->query($select);
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	 }
	 public function get_Star($star)
	{
		$query = $this->db->get_where('star',array('star'=>$star));
		if($query->num_rows()>0){
			return $query->row()->star;
		}else{
			return'';
		}
	}
	 //to view room type
	function getting_room_category($room_id)
	{
		$select = "SELECT * FROM sup_roomManager WHERE room_id = '".$room_id."'"; 
		$query=$this->db->query($select);
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->row();
		}
	}
	//admin delete room
	function get_hotelTypes($sup_inv_cate_type_id)
	{
		$select = "SELECT * FROM sup_inv_cate_type WHERE sup_inv_cate_type_id='".$sup_inv_cate_type_id."'"; 
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->row();
		} else {
			return '';	
		}
	}
	 //to room type list
	 function room_cat_list()
	 {
		$select = "SELECT * FROM sup_roomCategory"; 
		$query=$this->db->query($select);
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	 }
	   function room_type_list1()
	 {
		$select = "SELECT * FROM sup_roomType"; 
		$query=$this->db->query($select);
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	 }
	 function add_roomMager_ad($room_details)
	{
		$data=array(
				'sup_id'				=>	'sup',
				'hotel_id'				=>	$room_details['hotel_name'],
				'hotel_room_type'		=>	$room_details['room_category'],
				'hotel_room_typeA'		=>	$room_details['room_categoryA'],
				'capacity_title'		=>	$room_details['room_type'],
				'capacity_titleA'		=>	$room_details['room_typeA'],
				'capacity'				=>	$room_details['adult_capacity'],
				'child_capacity'		=>	$room_details['child_capacity'],
				'no_of_rooms'			=>	$room_details['rooms'],
				'room_desc'				=>	$room_details['room_desc'],
				'room_descA'			=>	$room_details['room_descA'],
				'hotel_room_services'	=>	serialize($room_details['service']),
				'arrivaltime_from'	   	=>	$room_details['arrival_time'],
				'departtime_before'	   	=>	$room_details['departure_time'],
				'checkin_time1'	    	=>	$room_details['checkinextra_time'],
				'checkout_time1'	    =>	$room_details['checkoutextra_time'],
				'checkin_extracost1'    =>	$room_details['check_in_extra_cost'],
				'checkout_extracost1'	=>	$room_details['check_out_extra_cost'],
				'sp_policies'			=>	$room_details['sproom_policies'],
				'sp_policiesA'			=>	$room_details['sproom_policiesA']
				);
				
		$this->db->select('*');
	 	$this->db->from('sup_roomManager');
	 	$this->db->where('hotel_id',$room_details['hotel_name']);
	 	$this->db->where('hotel_room_type',$room_details['room_category']);
	 	$this->db->where('capacity_title',$room_details['room_type']);
		$query = $this->db->get();
		
		if($query->num_rows() ==''){
			$this->db->insert('sup_roomManager',$data);	
		}else{
			$room_id=$query->row()->room_id;
			$where = "room_id =$room_id";
			$this->db->update('sup_roomManager',$data,$where);	
		}
			
		$this->db->last_query();
		$id = $this->db->insert_id();
		if (!empty($id)) {
			return true;
		} else {
			return false;
		}
	}
	function get_category($cat_id)
	{
		$sql="SELECT * FROM sup_roomManager WHERE room_id='".$cat_id."'";
		$res=$this->db->query($sql);
		if($res->num_rows() ==''){
			return 0;
		}else{
			return $res->row();
		}
		
	}
	function edit_roomMager_ad($room_details,$room_id,$hotel_id)
	{
			$data=array(
						'sup_id'				=>	'sup',
						'hotel_room_type'		=>	$room_details['room_category'],
						'hotel_room_typeA'		=>	$room_details['room_categoryA'],
						'capacity_title'		=>	$room_details['room_type'],
						'capacity_titleA'		=>	$room_details['room_typeA'],
						'capacity'				=>	$room_details['adult_capacity'],
						'child_capacity'		=>	$room_details['child_capacity'],
						'no_of_rooms'			=>	$room_details['rooms'],
						'room_desc'				=>	$room_details['room_desc'],
						'room_descA'			=>	$room_details['room_descA'],
						'hotel_room_services'	=>	serialize($room_details['service']),
						'arrivaltime_from'	   	=>	$room_details['arrival_time'],
						'departtime_before'	   	=>	$room_details['departure_time'],
						'checkin_time1'	    	=>	$room_details['checkinextra_time'],
						'checkout_time1'	    =>	$room_details['checkoutextra_time'],
						'checkin_extracost1'    =>	$room_details['check_in_extra_cost'],
						'checkout_extracost1'	=>	$room_details['check_out_extra_cost'],
						'sp_policies'			=>	$room_details['sproom_policies'],
						'sp_policiesA'			=>	$room_details['sproom_policiesA']
				);
		$where = "room_id = $room_id";
		$this->db->update('sup_roomManager',$data,$where);
	}
	/*
	*  admin g57oing to check room category is exit or not
	*/
	public function category($room_category)
	{
		$sql="SELECT * FROM sup_hotel_room_facility WHERE sup_fac_id='".$room_category."'";
		
		$res=$this->db->query($sql);
		if($res->num_rows() ==''){
			return 0;
		}else{
			if($_SESSION['langA']=='english')
			{
				return $res->row()->facility_name;
			}else{
				return $res->row()->facility_nameA;
			}
		}
	}
	public function Inactive_hotelTypes($room_id){
		$data = array('status' =>0);
		$where = "room_id = $room_id";
		$this->db->update('sup_roomManager',$data,$where);
	}
	public function active_hotelTypes($room_id){
		$data = array('status' =>1);
		$where = "room_id = $room_id";
		$this->db->update('sup_roomManager',$data,$where);
	}
	
	 //to view room type
	function getting_room_categoryA($sup_hotel_room_type_id)
	{
		$select = "SELECT sup_hotel_room_type_id, hotel_id, hotel_room_type, hotel_room_services,room_desc
                        FROM sup_hotel_room_typeA 
                        WHERE sup_hotel_room_type_id = '".$sup_hotel_room_type_id."'"; 
		$query=$this->db->query($select);
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->row();
		}
	}
	//delete room category
	function delete_room_category($id){
		$sql="Delete from sup_hotel_room_type where sup_hotel_room_type_id='".$id."'";
		$res=$this->db->query($sql);
		if ($res) {
			return true;
		}else{
			return false;
		}
	}
	//for roomtype list
	function roomtype_list($hotel_id)
	{
		$select = "SELECT A.capacity_id, A.hotel_id, A.capacity_title, A.capacity, A.child_capacity, B.status, B.hotel_name, B.hotel_chain_name, B.city
                        FROM sup_hotel_capacity A 
                        INNER JOIN sup_hotels B ON B.sup_hotel_id = A.hotel_id 
                        WHERE A.hotel_id = '$hotel_id' AND B.status = '1'";
		$query=$this->db->query($select);
		if($query->num_rows() ==''){
			return '';
		}
		else{
			return $query->result();
		}
	}
	/*
     * admin adding the roomtype
     */
    public function roomtype_ad($hotel,$sup_id)
	{
		$data = array(
					'sup_id'=>$sup_id,
					'hotel_id'=>$hotel['hotel_name'],
					'capacity_title'=>$hotel['room_type'],
					'capacity_titleA'=>$hotel['room_typeA'],
					'capacity'=>$hotel['adult_capacity'],
					'child_capacity'=>$hotel['child_capacity']
				);
		$this->db->insert('sup_hotel_capacity',$data);
		$this->db->last_query();
		$id = $this->db->insert_id();
		if (!empty($id)) {
			return true;
		} else {
			return false;
		}
	}
	//admin edit room type
	function edit_roomtype($category_id,$capacity_id)
	{
		$select = "SELECT r.*,c.* FROM sup_hotel_room_type r INNER JOIN sup_hotel_capacity c ON c.capacity_id=r.sup_hotel_room_type_id  WHERE c.capacity_id = '".$capacity_id."'";
		$query=$this->db->query($select);
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->row();
		}
	}
	//admin edit room type
	function edit_roomtypeA($capacity_id)
	{
		$select = "SELECT capacity_id, hotel_id, capacity_title, capacity, child_capacity  FROM sup_hotel_capacityA WHERE capacity_id = '".$capacity_id."'"; 
		$query=$this->db->query($select);
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->row();
		}
	}
	//admin edit room type
	function editroomtype_ad($capacity,$roomtype_id)
	{
		//~ echo '<pre>';
		//~ print_r($capacity);die;
		
		
		$sql="UPDATE sup_hotel_capacity SET hotel_id='".$capacity['hotel_name']."',capacity_title='".$capacity['room_type']."',capacity_titleA='".$capacity['room_typeA']."',capacity='".$capacity['adult_capacity']."',child_capacity='".$capacity['child_capacity']."'";
		$sql.=" WHERE capacity_id='".$roomtype_id."'";
		$res=$this->db->query($sql);
		if ($res) {
			return true;
		} else {
			return false;
		}
	}
    //admin delete room type
	function delete_roomtype($capacity_id)
	{
		$sqlA=$this->db->delete('sup_hotel_capacityA', array('capacity_id'=>$capacity_id));
		$sql=$this->db->delete('sup_hotel_capacity', array('capacity_id'=>$capacity_id));
		if ($sql) {
			return true;
		} else {
			return false;
		}
	}
	//to all hotel room list
	function roomcount_list($hotel_id)
	{	
		$select = "SELECT A.*, B.status, B.hotel_name, B.hotel_chain_name, B.city
                        FROM sup_inv_cate_type A 
                        INNER JOIN sup_hotels B ON B.sup_hotel_id = A.hotel_id 
                        WHERE B.status = '1'  and A.hotel_id = '$hotel_id' order by sup_inv_cate_type_id desc"; 
		
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->result();
		} else {
			return false;	
		}
	}
	//to get room type
	function getRoomType($hotel_id)
	{
		$select = "SELECT sup_hotel_room_type_id, hotel_id, hotel_room_type FROM sup_hotel_room_type where hotel_id = '".$hotel_id."' order by sup_hotel_room_type_id desc";
		$query=$this->db->query($select);
		
		$select1 = "SELECT capacity_id, hotel_id, capacity_title, capacity, child_capacity FROM sup_hotel_capacity where hotel_id = '".$hotel_id."' order by capacity_id desc";
		$query1=$this->db->query($select1);
		if($query->result()){
			$roomTypes 		= $query->result();
			$roomTypesCapacity 		= $query1->result();
			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode(array('roomTypes'=>$roomTypes,'roomTypesCapacity'=>$roomTypesCapacity)));
		}
		else{
			return array();
		}
	}	
	//admin adding  hotel room
	public function roomcount_ad($room_data,$sup_id){
		$data = array(
						'sup_id'=>$sup_id,
						'hotel_id'=>$room_data['hotel_name'],
						'room_type'=>$room_data['room_type'],
						'no_of_rooms'=>$room_data['rooms'],
						'max_person'=>$room_data['capacity_type'],
						'status'=>'1'
				);
		$this->db->insert('sup_inv_cate_type',$data);
		$id = $this->db->insert_id();
		if (!empty($id)) {
			return true;
		} else {
			return false;
		}
	}
	//admin delete room
	function delete_roomcount($sup_inv_cate_type_id)
	{
		if ($this->db->delete('sup_inv_cate_type', array('sup_inv_cate_type_id'=>$sup_inv_cate_type_id))) {
			return true;
		} else {
			return false;
		}
	}
	//admin  room
	function edit_roomcount($sup_inv_cate_type_id)
	{
		$select = "SELECT s.*,r.* FROM sup_inv_cate_type s LEFT JOIN sup_hotel_room_type r ON r.sup_hotel_room_type_id=s.room_type WHERE sup_inv_cate_type_id='".$sup_inv_cate_type_id."'"; 
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->row();
		} else {
			return '';	
		}
	}
	//admin updating  hotel room
	public function edit_roomcount_ad($room_data,$roomcount_id){
		$data = array('no_of_rooms'=>$room_data['rooms']);
		$where = "sup_inv_cate_type_id = $roomcount_id";
		$this->db->update('sup_inv_cate_type',$data,$where);
	}
	//admin get roompolicy list
	function roompolicy_list($hotel_id)
	{
		$select = "SELECT A.*, B.status, B.hotel_name, B.hotel_chain_name, B.city
                        FROM sup_apart_houserules A 
                        INNER JOIN sup_hotels B ON B.sup_hotel_id = A.hotel_id 
			WHERE A.hotel_id = '$hotel_id' AND B.status = '1'"; 
		$query=$this->db->query($select);
		if($query->num_rows() ==''){
			return '';
		}
		else{
			return $query->result();
		}
	}
	//admin adding roompolicy 
	function roompolicy_ad($hotel_policy,$sup_id)
	{
		$data = array(
			'sup_id' => $sup_id,
			'hotel_id' => $hotel_policy['hotel_name'],
			'arrivaltime_from' => $hotel_policy['arrival_time'],
			'departtime_before' => $hotel_policy['departure_time'],
			'checkin_time1' => $hotel_policy['checkinextra_time'],
			'checkout_time1' => $hotel_policy['checkoutextra_time'],
			'checkin_extracost1' => $hotel_policy['check_in_extra_cost'],
			'checkout_extracost1' => $hotel_policy['check_out_extra_cost'],
			'sp_policies' => $hotel_policy['sproom_policies'],
			'sp_policiesA' => $hotel_policy['sproom_policiesA']
			);
			
		$select = "SELECT * FROM sup_apart_houserules where hotel_id = '".$hotel_policy['hotel_name']."'";
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			$where = "hotel_id = '".$hotel_policy['hotel_name']."'";
			$this->db->update('sup_apart_houserules',$data,$where);
		}else{
			$this->db->insert('sup_apart_houserules', $data);
		}
		$id = $this->db->insert_id();
		if(!empty($id)) {
			return true;
		} else {
			return false;
		}
		
		
	}
	//admin getting roompolicy 
	function get_roompolicy($roomploicy_id)
	{	
		$select = "SELECT * FROM sup_apart_houserules where sup_apart_houserules_id = '".$roomploicy_id."'";
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->row();
		}else{
			return '';	
		}
	}
	//admin edit room type
	function get_roomType($capacity_id)
	{
		$select = "SELECT * FROM sup_hotel_capacity WHERE capacity_id = '".$capacity_id."'"; 
		$query=$this->db->query($select);
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->row();
		}
	}
	//admin update room policy
	function edit_roompolicy_ad($hotel_policy,$roomploicy_id)
	{
		$data = array(
			'hotel_id' => $hotel_policy['hotel_name'],
			'arrivaltime_from' => $hotel_policy['arrival_time'],
			'departtime_before' => $hotel_policy['departure_time'],
			'checkin_time1' => $hotel_policy['checkinextra_time'],
			'checkout_time1' => $hotel_policy['checkoutextra_time'],
			'checkin_extracost1' => $hotel_policy['check_in_extra_cost'],
			'checkout_extracost1' => $hotel_policy['check_out_extra_cost'],
			'sp_policies' => $hotel_policy['sproom_policies'],
			'sp_policiesA' => $hotel_policy['sproom_policiesA']
			);
		$where = "sup_apart_houserules_id = $roomploicy_id";
		$this->db->update('sup_apart_houserules',$data,$where);
	}
	//admin delete roompolicy
	function delete_roomplicy($roomploicy_id)
	{
		if ($this->db->delete('sup_apart_houserules', array('sup_apart_houserules_id'=>$roomploicy_id))) {
			return true;
		} else {
			return false;
		}
	}
	//to get price list
	function price_list($hotel_id)
	{		
		//~ $select = "SELECT A.*, B.status, B.hotel_name, B.hotel_chain_name, B.city FROM sup_rate_tactics A INNER JOIN sup_hotels B ON B.sup_hotel_id = A.hotel_id 
				   //~ WHERE B.status = '1'  AND A.hotel_id='$hotel_id' GROUP BY A.sup_id, A.hotel_id, A.category_type, A.room_type,A.allocation_validity_from, A.allocation_validity_to"; 
		//~ 
		
		$select ="SELECT MAX(smt.date) as mdate ,smt.status as main_status,MIN(smt.date)as mindate ,sh.*,cm.*,st.*,sm.*,smt.*,rm.*,smt.capacity_type as main_capacity_type from sup_hotels sh LEFT JOIN country_markup cm ON cm.country_id=sh.country LEFT JOIN star st ON st.s_no=sh.star LEFT JOIN star_markup sm ON st.star=sm.star_name LEFT JOIN sup_apart_maintain_month smt ON smt.hotel_id=sh.sup_hotel_id LEFT JOIN sup_rate_tactics rm ON rm.sup_rate_tactics_id=smt.sup_rate_tactics_id WHERE sh.sup_hotel_id='".$hotel_id."' group BY `smt`.`sup_rate_tactics_id`";
		
		 //~ $select ="SELECT MAX(smt.date) as mdate , MIN(smt.date)as mindate ,sh.*,cm.*,st.*,sm.*,rt.*,smt.*,rm.*,rc.*,smt.sup_rate_tactics_id as sup_rate_tactics_id1 from sup_hotels sh LEFT JOIN country_markup cm ON cm.country_id=sh.country LEFT JOIN star st ON st.s_no=sh.star LEFT JOIN star_markup sm ON st.star=sm.star_name LEFT JOIN sup_hotel_room_type rt ON rt.hotel_id=sh.sup_hotel_id LEFT JOIN sup_apart_maintain_month smt ON smt.hotel_id=sh.sup_hotel_id LEFT JOIN sup_hotel_capacity rc ON rc.capacity_id=smt.capacity_type LEFT JOIN sup_rate_tactics rm ON rm.sup_rate_tactics_id=smt.sup_rate_tactics_id and smt.room_cate=rt.sup_hotel_room_type_id
					//~ WHERE sh.sup_hotel_id='".$hotel_id."' GROUP BY `smt`.`sup_rate_tactics_id`";
		$query=$this->db->query($select);
		
		if ($query->num_rows() > 0)
		{
			return $query->result();
		} else {
			return '';	
		}
	}
	function get_rate_tactics_details1($tacktics_id)
	{		
		//echo $select = "SELECT a.*,b.*,c.*,MAX(smt.date) as Maxdate,MIN(smt.date) as Mindate FROM sup_rate_tactics a join sup_rate_cancel_policy b ON a.sup_rate_tactics_id=b.rate_tactics_id join sup_hotel_room_type c ON c.sup_hotel_room_type_id=a.category_type join sup_apart_maintain_month smt ON smt.sup_rate_tactics_id=b.rate_tactics_id  where a.sup_rate_tactics_id = '$tacktics_id' GROUP BY smt.room_cate";
		$select = "SELECT a.*,MAX(smt.date) as Maxdate,MIN(smt.date) as Mindate,smt.*,smt.capacity_type as main_capacity_type FROM sup_rate_tactics a join sup_apart_maintain_month smt ON smt.sup_rate_tactics_id=a.sup_rate_tactics_id where a.sup_rate_tactics_id = '$tacktics_id' GROUP BY smt.room_cate";
		
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->row();
		} else {
			return false;	
		}
	}
	 /*
     * admin getting all hotels
     */
    public function getting_all_hotels($hotel_id)
	{
		$select = "SELECT A.*,B.*, A.star as Amt FROM sup_hotels A LEFT JOIN star B ON B.s_no = A.star WHERE A.sup_hotel_id='".$hotel_id."'"; 
		$query=$this->db->query($select);		
		
		if($query->num_rows > 0 ) 
		{      
         	return $query->result();
      	}else{
			return '';
		}
	}
	function get_sell_price($hotel_id)
	{
		$select ="SELECT * from sup_apart_maintain_month where hotel_id='".$hotel_id."' and date='".date('Y-m-d')."'";
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->row()->sell_price;
		} else {
			return '';	
		}
	}
	public function get_hotelDetails($hotel_id)
	{
		$sql="SELECT star,country FROM sup_hotels where sup_hotel_id='".$hotel_id."'";
		$rs=$this->db->query($sql);
		
		if($rs->num_rows() ==''){
			return 0;
		}else{
			return $rs->row();
		}
	}
	 public function getting_all_Board_Type()
	{
		$query = $this->db->select('*')->from('Board_Type')->get();
		if($query->num_rows > 0 ) 
		{      
         	return $query->result();
      	}else{
			return '';
		}
	}
    //get all dates
	function getDates()
	{
		$sds = $_REQUEST['mmsd'];
		$eds = $_REQUEST['mmed'];
		if(is_array($sds)) 
		{
			$k=0;
			for($i=0;$i<count($sds);$i++)
			{
				$sdate = explode("-",$sds[$i]);
				$fromDate[$i] = $sdate[2].'/'.$sdate[1].'/'.$sdate[0];
				$edate = explode("-",$eds[$i]);
				$toDate[$i] = $edate[1].'/'.$edate[0].'/'.$edate[2];
				$dateMonthYearArr = array();
				$fromDateTS = strtotime($fromDate[$i]);
				$toDateTS = strtotime($toDate[$i]);
				for ($currentDateTS = $fromDateTS; $currentDateTS <= $toDateTS; $currentDateTS += (60 * 60 * 24)) 
				{
					if($_REQUEST['selectedDays'] != 'All'){
						$checkDays = date("D",$currentDateTS);
						if(in_array($checkDays, $_REQUEST['selectedDays'])) {
							$currentDateStr = date("d-m-Y D",$currentDateTS);
							$dateMonthYearArr[] = $currentDateStr;
						}
					}else{
						$currentDateStr = date("d-m-Y D",$currentDateTS);
						$dateMonthYearArr[] = $currentDateStr;
					}
				}
				$result[] = $dateMonthYearArr;
			}
			$counter = count($result);
			if($counter==1)  
			{
				$dates = array_merge($result[0]);
			}
			if($counter==2)  
			{
				$dates = array_merge($result[0], $result[1]);
			}
			if($counter==3)  
			{
				$dates = array_merge($result[0], $result[1], $result[2]);
			}
			if($counter==4)  
			{
				$dates = array_merge($result[0], $result[1], $result[2], $result[3]);
			}
			if($counter==5)  
			{
				$dates = array_merge($result[0], $result[1], $result[2], $result[3], $result[4]);
			}
			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode(array('dates'=>$dates)));
		}else{
				$sds = explode("-",$_REQUEST['mmsd']);
				$fromDate = $sds[2].'/'.$sds[1].'/'.$sds[0];
				$eds = explode("-",$_REQUEST['mmed']);
				$toDate = $eds[1].'/'.$eds[0].'/'.$eds[2];
				$dateMonthYearArr = array();
				$fromDateTS = strtotime($fromDate);
				$toDateTS = strtotime($toDate);
				for ($currentDateTS = $fromDateTS; $currentDateTS <= $toDateTS; $currentDateTS += (60 * 60 * 24))           {
					if($_REQUEST['selectedDays'] != 'All'){
						$checkDays = date("D",$currentDateTS);
						if(in_array($checkDays, $_REQUEST['selectedDays'])) {
							$currentDateStr = date("d-m-Y D",$currentDateTS);
							$dateMonthYearArr[] = $currentDateStr;
						}
					}else{
						$currentDateStr = date("d-m-Y D",$currentDateTS);
						$dateMonthYearArr[] = $currentDateStr;
					}
				}
				$this->output->set_content_type('application/json');
				$this->output->set_output(json_encode(array('dates'=>$dateMonthYearArr)));
			}
	}
	function add_pricemanager_ad($rack_price,$sell_price,$cancel_policy_descA,$child_policyA,$market_id,$cancel_policy_desc,$board_type,$hotel_id,$room_cate,$room_type,$child_policy,$cancel_policy_nights,$cancel_policy_percent,$cancel_policy_charge,$cancel_policy_from,$cancel_policy_to,$room_avail_date_from,$room_avail_date_to,$dates,$weekday,$price,$extra_bed_price,$avail,$aadult,$achild,$child_price,$infant,$fileimage,$fileimage1,$fileimage2,$fileimage3)
	{
		$counter = count($room_avail_date_from);
		for($k=0;$k < $counter;$k++)
		{
			if(is_array($room_avail_date_from))
			{
				$sdate = $room_avail_date_from[$k];
				$fromda = explode("-",$sdate);
				$avail_date_from = $fromda[2].'-'.$fromda[1].'-'.$fromda[0];
			}else{
				$sdate = $room_avail_date_from;
				$fromda = explode("-",$sdate);
				$avail_date_from = $fromda[2].'-'.$fromda[1].'-'.$fromda[0];
			}
			
			if(is_array($room_avail_date_to))
			{
				$edate = $room_avail_date_to[$k];
				$toda = explode("-",$edate);
				$avail_date_to = $toda[2].'-'.$toda[1].'-'.$toda[0];
			}else{
				$edate = $room_avail_date_to;
				$toda = explode("-",$edate);
				$avail_date_to = $toda[2].'-'.$toda[1].'-'.$toda[0];
			}
			if($market_id[0]==''){
				$market_id[0]='';
			}
			
			$data = array(
				'sup_id' => 'admin',
				'hotel_id' => $hotel_id,
				'market_id'=>$market_id[0],
				'category_type' => $room_cate,
				'room_type' => $room_type,
				'main_image'=>$fileimage,
				'image1'=>$fileimage1,
				'image2'=>$fileimage2,
				'image3'=>$fileimage3,
				'infant' => $infant[0],
				'child_policy' => $child_policy,
				'child_policyA'=>$child_policyA, 
				'cancel_policy_nights' => $cancel_policy_nights[0],
				'cancel_policy_percent' => $cancel_policy_percent[0],
				'cancel_policy_charge' => $cancel_policy_charge[0],
				'cancel_policy_desc'=>$cancel_policy_desc,
				'cancel_policy_descA'=>$cancel_policy_descA,
				'room_avail_date_from' => $avail_date_from,
				'room_avail_date_to' => $avail_date_to,
				'InclBoardTypeDesc' => $board_type,
				'status' => 1
			);
			
			$this->db->select('*');
			$this->db->from('sup_rate_tactics');
			$this->db->where("hotel_id", $hotel_id);
			$this->db->where("room_type", $room_type);
			$query = $this->db->get();
			
			if($query->num_rows() ==''){
				$this->db->set('created_date', 'NOW()', FALSE); 
				$this->db->insert('sup_rate_tactics', $data);
				$id = $this->db->insert_id();
			}else{
				$this->db->where('hotel_id', $hotel_id);
				$this->db->where('room_type', $room_type);
				$this->db->update('sup_rate_tactics', $data);
				$id = $query->row()->sup_rate_tactics_id;
			}
			
				
			if(isset($cancel_policy_percent) && $cancel_policy_percent != "")
			{
				$ins = "INSERT INTO `sup_rate_cancel_policy` (`rate_tactics_id` ,`cancel_policy_nights` ,`cancel_policy_percent` ,`cancel_policy_charge` ,`cancel_policy_from` ,`cancel_policy_to`)
				VALUES ('".$id."', '".$cancel_policy_nights[0]."', '".$cancel_policy_percent[0]."', '".$cancel_policy_charge[0]."', '".$cancel_policy_from."', '".$cancel_policy_to."')";
				$exe = $this->db->query($ins);
			}
			
			if(isset($price) && $price != "")
			{
				for($i=0; $i<count($dates); $i++)
				{
					if(strtotime($dates[$i]) >= strtotime($sdate) && strtotime($dates[$i]) <= strtotime($edate))
					{
						$day  = explode("-",$dates[$i]);
						$date = $day[2].'-'.$day[1].'-'.$day[0]; 
						
						$this->db->select('*');
						$this->db->from('sup_apart_maintain_month');
						$this->db->where("hotel_id", $hotel_id);
						$this->db->where("capacity_type", $room_type);
						$this->db->where("date", $date);
						$query = $this->db->get();
						if($query->num_rows() ==''){
							$qry = "INSERT INTO `sup_apart_maintain_month` ( 
							`sup_id` ,`sup_rate_tactics_id` ,`hotel_id` ,`room_cate`,`capacity_type`,`date` ,`week_day` ,`day` ,`month` ,`year` ,`rate` ,`rack_price`,`sell_price`,`extra_bed_price` ,`available_rooms` ,`capacity` ,`adult` ,`child` ,`child_charge` ,`infant` ,`status`)
							VALUES ( 'admin', '".$id."', '".$hotel_id."','".$room_cate."','".$room_type."', '".$date."', '".$weekday[$i]."', '".$day[0]."', '".$day[1]."', '".$day[2]."','".$price[$i]."', '".$sell_price[$i]."', '".$rack_price[$i]."','".$extra_bed_price[$i]."','".$avail[$i]."', '', '".$aadult[$i]."', '".$achild[$i]."', '".$child_price[$i]."', '".$infant[$i]."', '1')";
							$query=$this->db->query($qry);
						}else{
							$upd="UPDATE sup_apart_maintain_month SET sup_rate_tactics_id='".$id."',week_day='".$weekday[$i]."',day='".$day[0]."',month='".$day[1]."',year='".$day[2]."',rate='".$price[$i]."',rack_price='".$sell_price[$i]."',sell_price='".$rack_price[$i]."',extra_bed_price='".$extra_bed_price[$i]."',available_rooms='".$avail[$i]."',adult='".$aadult[$i]."',child='".$achild[$i]."',child_charge='".$child_price[$i]."',infant='".$infant[$i]."' WHERE date='".$date."' AND hotel_id='".$hotel_id."' AND room_cate='".$room_cate."'";
							$this->db->query($upd);
						}
					}
				}
			}
			
		}
		$select = "SELECT MAX(smt.date) as Maxdate,MIN(smt.date) as Mindate FROM sup_rate_tactics a join sup_rate_cancel_policy b ON a.sup_rate_tactics_id=b.rate_tactics_id join sup_hotel_room_type c ON c.sup_hotel_room_type_id=a.category_type join sup_apart_maintain_month smt ON smt.sup_rate_tactics_id=b.rate_tactics_id  where a.sup_rate_tactics_id = '$id' GROUP BY smt.room_cate";
		$query=$this->db->query($select);
		 
		$upd="UPDATE sup_rate_tactics SET room_avail_date_from='".$query->row()->Mindate."',room_avail_date_to='".$query->row()->Maxdate."' WHERE hotel_id='".$hotel_id."' AND sup_rate_tactics_id='".$id."'";
		$this->db->query($upd);
		if(!empty($id)) 
		{
			return true;
		}else{
			return false;
		}
	}
	 
	function delete_pricemanager($tacktics_id)
	{
		if ($this->db->delete('sup_rate_tactics', array('sup_rate_tactics_id'=>$tacktics_id))) {
			$this->db->delete('sup_apart_maintain_month', array('sup_rate_tactics_id'=>$tacktics_id));
			$this->db->delete('sup_rate_cancel_policy', array('rate_tactics_id'=>$tacktics_id));
			return true;
		} else {
			return false;
		}
	}
	//home get hotel price
	function get_rate_tactics_details($tacktics_id)
	{		
		$select = "SELECT a.*,b.* FROM sup_rate_tactics a join sup_rate_cancel_policy b ON a.sup_rate_tactics_id=b.rate_tactics_id where a.sup_rate_tactics_id = '$tacktics_id' ";
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->row();
		} else {
			return false;	
		}
	}
	//for get avail dates
	function getAvailDates()
	{
		$select = "SELECT * FROM sup_apart_maintain_month where sup_rate_tactics_id = ".$_REQUEST['rate_id']." ORDER BY date ASC"; 
		$query	= $this->db->query($select); 
		if ($query->num_rows() > 0){
			$avail_dates = $query->result();
			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode(array('avail_dates'=>$avail_dates)));
		}
	}
	function Inactive_price($price_id)
	{
		$sql="UPDATE sup_apart_maintain_month SET status=0 WHERE sup_rate_tactics_id  = '".$price_id."'";
		$rs=$this->db->query($sql);
	}
	function Active_price($price_id)
	{
		$sql="UPDATE sup_apart_maintain_month SET status=1 WHERE sup_rate_tactics_id  = '".$price_id."'";
		$rs=$this->db->query($sql);
	}
	function edit_pricemanager_ad($rack_price,$sell_price,$child_policyA,$cancel_policy_descA,$tacktics_id,$market_id,$cancel_policy_desc,$board_type,$hotel_id,$room_cate,$room_type,$child_policy,$cancel_policy_nights,$cancel_policy_percent,$cancel_policy_charge,$cancel_policy_from,$cancel_policy_to,$room_avail_date_from,$room_avail_date_to,$dates,$weekday,$price,$extra_bed_price,$avail,$aadult,$achild,$child_price,$infant,$fileimage,$fileimage1,$fileimage2,$fileimage3)
	{
		$counter = count($room_avail_date_from);
		for($k=0;$k < $counter;$k++)
		{
			if(is_array($room_avail_date_from))
			{
				$sdate = $room_avail_date_from[$k];
				$fromda = explode("-",$sdate);
			    $avail_date_from = $fromda[2].'-'.$fromda[1].'-'.$fromda[0];
			}else{
				$sdate = $room_avail_date_from;
				$fromda = explode("-",$sdate);
			    $avail_date_from = $fromda[2].'-'.$fromda[1].'-'.$fromda[0];
			}
			
			if(is_array($room_avail_date_to))
			{
				$edate = $room_avail_date_to[$k];
				$toda = explode("-",$edate);
				$avail_date_to = $toda[2].'-'.$toda[1].'-'.$toda[0];
			}else{
				$edate = $room_avail_date_to;
				$toda = explode("-",$edate);
				$avail_date_to = $toda[2].'-'.$toda[1].'-'.$toda[0];
			}
			$child_policy = addslashes($child_policy);
			if($k==0) 
			{
					$select="UPDATE sup_rate_tactics 
							SET category_type='$room_cate',
							room_type='$room_type',
							market_id='".$market_id[0]."',
							child_policy='$child_policy', 
							child_policyA='$child_policyA', 
							cancel_policy_desc='$cancel_policy_desc',
							cancel_policy_descA='$cancel_policy_descA',
							InclBoardTypeDesc='$board_type',
							cancel_policy_nights='$cancel_policy_nights',
							cancel_policy_percent='$cancel_policy_percent',
							cancel_policy_charge='$cancel_policy_charge', 
							room_avail_date_from='$avail_date_from', 
							room_avail_date_to='$avail_date_to'";
									
					if($fileimage!='' && $fileimage1!='' && $fileimage2!='' && $fileimage3!='')
					{
						$select.=", main_image='".$fileimage."',image1='".$fileimage1."',image2='".$fileimage2."',image3='".$fileimage3."'";
					}
					$select.=" WHERE sup_rate_tactics_id='$tacktics_id'";
					$this->db->query($select);
					
					if(isset($dates) && $dates != "")
					{
						$dates = $dates;
						$weekday = $weekday;
						$price = $price;
						$extra_bed_price = $extra_bed_price;
						$avail = $avail;
						$adults = $aadult;
						$childs = $achild;
						$avail_child_price = $child_price;
						$avail_infant = $infant;
						for($i=0; $i<sizeof($dates); $i++)
						{
							
							if(strtotime($dates[$i]) >= strtotime($sdate) && strtotime($dates[$i]) <= strtotime($edate))
							{
								$day  = explode("-",$dates[$i]);
								$day1='';$mnth='';$year='';
								if(strlen($day[0])!=4){
									$day1=$day[0];
									$mnth=$day[1];
									$year=$day[2];
									
									$date = $day[2].'-'.$day[1].'-'.$day[0];
								}else{
									$day1=$day[2];
									$mnth=$day[1];
									$year=$day[0];
									$date =$dates[$i];
								}
								$this->db->select('*');
								$this->db->from('sup_apart_maintain_month');
								$this->db->where("hotel_id", $hotel_id);
								$this->db->where("capacity_type", $room_type);
								$this->db->where("date", $date);
								$query = $this->db->get();
								if($query->num_rows() ==''){
									$qry = "INSERT INTO `sup_apart_maintain_month` ( 
									`sup_id` ,`sup_rate_tactics_id` ,`hotel_id` ,`room_cate`,`capacity_type`,`date` ,`week_day` ,`day` ,`month` ,`year` ,`rate` ,`rack_price`,`sell_price`,`extra_bed_price` ,`available_rooms` ,`num_mainrooms`,`capacity` ,`adult` ,`child` ,`child_charge` ,`infant` ,`status`)
									VALUES ( 'admin', '".$tacktics_id."', '".$hotel_id."','".$room_cate."','".$room_type."','".$date."', '".$weekday[$i]."', '".$day1."', '".$mnth."', '".$year."', '".$price[$i]."', '".$rack_price[$i]."', '".$sell_price[$i]."', '".$extra_bed_price[$i]."','".$avail[$i]."','".$aadult[$i]."', '', '0', '0', '".$avail_child_price[$i]."', '0', '1')";
									$query=$this->db->query($qry);
								}else{
									$upd="UPDATE sup_apart_maintain_month SET sup_rate_tactics_id='".$tacktics_id."',week_day='".$weekday[$i]."',day='".$day1."',month='".$mnth."',year='".$year."',rate='".$price[$i]."',rack_price='".$rack_price[$i]."',sell_price='".$sell_price[$i]."',extra_bed_price='".$extra_bed_price[$i]."',available_rooms='".$avail[$i]."',num_mainrooms='".$aadult[$i]."',adult='0',child='0',child_charge='".$child_price[$i]."',infant='0' WHERE date='".$date."' AND hotel_id='".$hotel_id."' AND room_cate='".$room_cate."' AND capacity_type='".$room_type."'";
									$this->db->query($upd);
									//~ echo $this->db->last_query();
									//~ die;
								}
							}
						 }
						 
						 $select = "SELECT MAX(smt.date) as Maxdate,MIN(smt.date) as Mindate FROM sup_rate_tactics a join sup_apart_maintain_month smt ON smt.sup_rate_tactics_id=a.sup_rate_tactics_id  where a.sup_rate_tactics_id = '$tacktics_id' GROUP BY smt.room_cate";
						 $query=$this->db->query($select);
						 
						 $upd="UPDATE sup_rate_tactics SET room_avail_date_from='".$query->row()->Mindate."',room_avail_date_to='".$query->row()->Maxdate."' WHERE hotel_id='".$hotel_id."' AND sup_rate_tactics_id='".$tacktics_id."'";
						 $this->db->query($upd);
					 }
			}
			if(!empty($id)) 
			{
				return true;
			} 
			else 
			{
				return false;
			}
		}
	}
	function B2C_bookingReports($hotel_id)
	{
		//$select = "SELECT h.*, t.*, c.* FROM users c left join transaction_details t on c.user_id = t.customer_contact_details_id left join  hotel_booking_info h on c.user_id = h.customer_contact_details_id where t.customer_contact_details_id IS NOT NULL";
		$select = "SELECT b.status as STA,b.*,h.* FROM booking_info b left join sup_hotels h on b.hotel_id=h.sup_hotel_id where sup_hotel_id ='".$hotel_id."'ORDER BY sno";
	
		$query = $this->db->query($select);
		if ( $query->num_rows > 0 )
		{ 
			return $query->result();
		}else{
			return '';
		}
	}
	//admin add amenity
	public function add_amenity($amenity_name,$sup_id)
	{
		$data =array('amenity_name' 	=> $amenity_name,'user_id'=>$sup_id,'status' => '1');
		$this->db->insert('global_amenity_list',$data);
		//echo $this->db->last_query(); die;
		$id=$this->db->insert_id();
		if(!empty($id))
		{
			return true;
		}else{
			return false;
		}
	}
	public function delete_amenity($amenity_id)
	{
		$where = "amenity_list_id = $amenity_id";
		if ($this->db->delete('global_amenity_list', $where)) {
			return true;
		} else {
			return false;
		}
	}
		
	function get_amenity($amenity_id)
	{		
		$select = "SELECT * from global_amenity_list WHERE amenity_list_id='".$amenity_id."'"; 
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->row();
		} else {
			return '';	
		}
	}
	function editamenity_ad($amenity_id,$amenity_name)
	{
		$data = array('amenity_name' => $amenity_name);
		$where = "amenity_list_id = $amenity_id";
		$this->db->update('global_amenity_list',$data,$where);
	}
	
	function get_booking_info($hotel_id)
	{
		$sql="SELECT * FROM booking_info WHERE hotel_id='$hotel_id' order by sno desc";
		$query=$this->db->query($sql);
		if($query->num_rows()>0) {
			return $query->result();
		} else {
			return '';
		}
	}
	
	  //supplier getting his hotels
     public function get_supplier_hotel($sup_id) 
	 {
		$select="select s.*,a.* FROM sup_hotels s JOIN supplier a ON s.sup_hotel_id=a.hotel_id where a.supplier_id='".$sup_id."' and a.active=1"; 
		$query=$this->db->query($select);
		if ( $query->num_rows > 0 )
		{ 
			return $query->result();
		}else{
			return '';
		}
	 }
	 
	 	/*
	*  admin getting the room Facilities
	*/
	public function roomfacility_list()
	{
		$sql="SELECT * FROM  sup_hotel_room_facility WHERE status='1'";
		$res=$this->db->query($sql);
		
		if($res->num_rows() ==''){
			return '';
		}else{
			return $res->result();
		}
	}
	
	 	/*
	*  admin getting the room Facilities
	*/
	public function roomfacility_list1()
	{
		if($_SESSION['langA']=='english')
		{
			$sql="SELECT * FROM  sup_hotel_room_facility";
		}else{
			$sql="SELECT * FROM  sup_hotel_room_facilityA";
		}
		$res=$this->db->query($sql);
		
		if($res->num_rows() ==''){
			return '';
		}else{
			return $res->result();
		}
	}
		/*
	*  admin add_roomfacilites 
	*/
	public function add_roomfacilites($Room_Facilities, $sup_id)
	{
		$data = array(
				'sup_id' =>  $sup_id,
				'hotel_room' => 0,
				'facility_name' => $Room_Facilities['add_roomfac_name'],
				'status' => 1
			);
		$this->db->insert('sup_hotel_room_facility', $data);
		$id = $this->db->insert_id();
		return true;
	}
	
		/*
	*  admin Active the room facilites
	*/
	public function Active_room_fac($fac_id)
	{
		$sql="UPDATE sup_hotel_room_facility SET status=1 WHERE sup_fac_id  = '".$fac_id."'";
		$rs=$this->db->query($sql);
	}
	
		/*
	*  admin InActive the room facilites
	*/
	public function InActive_room_fac($fac_id)
	{
		$sql="UPDATE sup_hotel_room_facility SET status=0 WHERE sup_fac_id  = '".$fac_id."'";
		$rs=$this->db->query($sql);
	}
	
		/*
	*  admin Delete the room facilites
	*/
	public function delete_Rfacilites($fac_id)
	{
		$delqry = "DELETE FROM sup_hotel_room_facility WHERE sup_fac_id='".$fac_id."'"; 
		$query=$this->db->query($delqry);
	}	
	function get_hotel($hotel_id) {
			
			$this->db->select('*')->from('sup_hotels')->where('sup_hotel_id',$hotel_id);
			$query=$this->db->get();
			if($query->num_rows()>0) {
				return $query->row();
			}		
	}
	function get_bookhotel($booking_id)
	{
		$this->db->select('*')
				  ->from('booking_info')
				  ->where('booking_id',$booking_id);
		 $query=$this->db->get();
		 if($query->num_rows()>0){
			return $query->row();
		}else{
			return '';
		}
	}  
 //--------------closing class-----------//   

}
