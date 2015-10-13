<?php
class Hotel_Model extends CI_Model {
	
	public function __construct()
    {
      parent::__construct();
    }
    
	/*
	 *  admin getting search_data
	*/
	public function search_data()
	{
		$sql="SELECT * FROM sup_hotels where city LIKE '%".$_GET['term']."%' GROUP BY city LIMIT 50";
		//$sql="SELECT * FROM sup_hotels where hotel_name LIKE '%".$_GET['term']."%' || address LIKE '%".$_GET['term']."%' || city_country_name LIKE '%".$_GET['term']."%' LIMIT 50";
		$rs=$this->db->query($sql);
		if($rs->num_rows() ==''){
			return '';
		}else{
			return $rs->result();
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
     * admin getting all hotels
     */
    public function getting_all_hotels()
	{
		$query = $this->db->select('*')
				->from('sup_hotels')
		        ->get();
		if($query->num_rows > 0 ) 
		{      
         	return $query->result();
      	}else{
			return '';
		}
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
	 /*
     * adding hotel details
     */
    public function add_hotel_details($hotel)
	{
		$market_name='';
		if(isset($hotel['market_name'])){
			$market_name=serialize($hotel['market_name']);
		}
				$data = array(
					 'sup_id' => 'admin',
					 'market_name' =>$market_name ,
					 'hotel_name' => $hotel['hotel_name'],	   				 
					 'city_country_name' => $hotel['city_name'],
					 'main_last_name' => $hotel['last_name'],
					 'main_first_name' => $hotel['first_name'],
					 'user_type '    =>1,
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
    public function Active_hotel($hotel_id)
	{
		$data = array('status' => '1');
		$where = "sup_hotel_id = '".$hotel_id."'";
		if ($this->db->update('sup_hotels', $data, $where)) {
			return true;
		}else{
			return false;
		}
	}
	/*
     * admin Inactive hotel
     */
    public function Inactive_hotel($hotel_id)
	{
		$data = array('status' => '0');
		$where = "sup_hotel_id = '".$hotel_id."'";
		if ($this->db->update('sup_hotels', $data, $where)) {
			return true;
		}else{
			return false;
		}
	}
	/*
     * admin Inactive hotel
     */
    public function delete_hotel($hotel_id)
	{
		$delqry = "DELETE FROM sup_hotels WHERE sup_hotel_id = '".$hotel_id."'"; 
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
	public function getting_hotel_details($hotel_id)
	{
		$sql="SELECT * FROM sup_hotels WHERE sup_hotel_id='".$hotel_id."'";
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
	public function update_hotel($hotel,$hotel_id)
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
	 //to room type list
	 function room_type_list()
	 {
		$select = "SELECT A.sup_hotel_room_type_id, A.hotel_id, A.hotel_room_type, A.hotel_room_services, B.status, B.hotel_name, B.hotel_chain_name, B.city
                        FROM sup_hotel_room_type A 
                        INNER JOIN sup_hotels B ON B.sup_hotel_id = A.hotel_id 
                        WHERE B.sup_id = 'admin' AND B.status = '1'"; 
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
		$this->db->from('global_amenity_list');
		$this->db->order_by("amenity_list_id", "desc");
		$query = $this->db->get();
		if($query->num_rows() ==''){
			return '';			
		}else{
			return $query->result();				
		}
     }
     //adding room category
	function add_room_type_details($room_data)
	{
		$sql="INSERT INTO `sup_hotel_room_type` (`hotel_id`,`sup_id`, `hotel_room_type`, `hotel_room_services`,`room_desc`) VALUES ('".$room_data['hotel_name']."','admin', '".$room_data['room_category']."','".serialize($room_data['service'])."','".$room_data['room_desc']."')";
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
	public function edit_room_type_details($category,$hotel_id)
	{
			$data = array(
					 'hotel_id' => $category['hotel_name'],
					 'hotel_room_type' => $category['room_category'],	   				 
					 'hotel_room_services' => serialize($category['service']),
					 'room_desc' => $category['room_desc']
					);
			$where = "sup_hotel_room_type_id = '".$hotel_id."'";
			if ($this->db->update('sup_hotel_room_type', $data, $where)) {
				return true;
			}else{
				return false;
			}
	 }
	
	 //to view room type
	function getting_room_category($sup_hotel_room_type_id)
	{
		$select = "SELECT sup_hotel_room_type_id, hotel_id, hotel_room_type, hotel_room_services,room_desc
                        FROM sup_hotel_room_type 
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
	function roomtype_list()
	{
		$select = "SELECT A.capacity_id, A.hotel_id, A.capacity_title, A.capacity, A.child_capacity, B.status, B.hotel_name, B.hotel_chain_name, B.city
                        FROM sup_hotel_capacity A 
                        INNER JOIN sup_hotels B ON B.sup_hotel_id = A.hotel_id 
                        WHERE B.sup_id = 'admin' AND B.status = '1'"; 
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
    public function roomtype_ad($hotel)
	{
		$data = array('hotel_id'=>$hotel['hotel_name'],'capacity_title'=>$hotel['room_type'],'capacity'=>$hotel['adult_capacity'],'child_capacity'=>$hotel['child_capacity']);
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
	function edit_roomtype($capacity_id)
	{
		$select = "SELECT capacity_id, hotel_id, capacity_title, capacity, child_capacity  FROM sup_hotel_capacity WHERE capacity_id = '".$capacity_id."'"; 
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
		$sql="UPDATE sup_hotel_capacity SET hotel_id='".$capacity['hotel_name']."',capacity_title='".$capacity['room_type']."',capacity='".$capacity['adult_capacity']."',child_capacity='".$capacity['child_capacity']."'";
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
		$where = "capacity_id = $capacity_id";
		if ($this->db->delete('sup_hotel_capacity', $where)) {
			return true;
		} else {
			return false;
		}
	}
	//to all hotel room list
	function roomcount_list()
	{		
		$select = "SELECT A.*, B.status, B.hotel_name, B.hotel_chain_name, B.city
                        FROM sup_inv_cate_type A 
                        INNER JOIN sup_hotels B ON B.sup_hotel_id = A.hotel_id 
                        WHERE B.status = '1' and B.sup_id = 'admin' and A.sup_id = 'admin' order by sup_inv_cate_type_id desc"; 
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
	public function roomcount_ad($room_data){
		$data = array(
						'sup_id'=>'admin',
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
		$where = "sup_inv_cate_type_id = $sup_inv_cate_type_id";
		if ($this->db->delete('sup_inv_cate_type', $where)) {
			return true;
		} else {
			return false;
		}
	}
	//admin delete room
	function edit_roomcount($sup_inv_cate_type_id)
	{
		$select = "SELECT * FROM sup_inv_cate_type WHERE sup_id = 'admin' and sup_inv_cate_type_id='".$sup_inv_cate_type_id."'"; 
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
	function roompolicy_list()
	{
		$select = "SELECT A.*, B.status, B.hotel_name, B.hotel_chain_name, B.city
                        FROM sup_apart_houserules A 
                        INNER JOIN sup_hotels B ON B.sup_hotel_id = A.hotel_id 
			WHERE B.sup_id = 'admin' AND B.status = '1'"; 
		$query=$this->db->query($select);
		if($query->num_rows() ==''){
			return '';
		}
		else{
			return $query->result();
		}
	}
	//admin adding roompolicy 
	function roompolicy_ad($hotel_policy)
	{
		$data = array(
			'sup_id' => 'admin',
			'hotel_id' => $hotel_policy['hotel_name'],
			'arrivaltime_from' => $hotel_policy['arrival_time'],
			'departtime_before' => $hotel_policy['departure_time'],
			'checkin_time1' => $hotel_policy['checkinextra_time'],
			'checkout_time1' => $hotel_policy['checkoutextra_time'],
			'checkin_extracost1' => $hotel_policy['check_in_extra_cost'],
			'checkout_extracost1' => $hotel_policy['check_out_extra_cost']
			);
		$this->db->insert('sup_apart_houserules', $data);
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
			'checkout_extracost1' => $hotel_policy['check_out_extra_cost']
			);
		$where = "sup_apart_houserules_id = $roomploicy_id";
		$this->db->update('sup_apart_houserules',$data,$where);
	}
	//admin delete roompolicy
	function delete_roomplicy($roomploicy_id)
	{
		$where = "sup_apart_houserules_id = $roomploicy_id";
		if ($this->db->delete('sup_apart_houserules', $where)) {
			return true;
		} else {
			return false;
		}
	}
	//to get price list
	function price_list()
	{		
		$select = "SELECT A.*, B.status, B.hotel_name, B.hotel_chain_name, B.city FROM sup_rate_tactics A INNER JOIN sup_hotels B ON B.sup_hotel_id = A.hotel_id 
				   WHERE B.status = '1' GROUP BY A.sup_id, A.hotel_id, A.category_type, A.room_type,A.allocation_validity_from, A.allocation_validity_to"; 
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->result();
		} else {
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
	function add_pricemanager_ad($market_id,$cancel_policy_desc,$board_type,$hotel_id,$room_cate,$room_type,$child_policy,$cancel_policy_nights,$cancel_policy_percent,$cancel_policy_charge,$cancel_policy_from,$cancel_policy_to,$room_avail_date_from,$room_avail_date_to,$dates,$weekday,$price,$extra_bed_price,$avail,$aadult,$achild,$child_price,$infant,$fileimage,$fileimage1,$fileimage2,$fileimage3)
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
				'cancel_policy_nights' => $cancel_policy_nights[0],
				'cancel_policy_percent' => $cancel_policy_percent[0],
				'cancel_policy_charge' => $cancel_policy_charge[0],
				'cancel_policy_desc'=>$cancel_policy_desc,
				'room_avail_date_from' => $avail_date_from,
				'room_avail_date_to' => $avail_date_to,
				'InclBoardTypeDesc' => $board_type,
				'status' => 1
			);
			
			$this->db->set('created_date', 'NOW()', FALSE); 
			$this->db->insert('sup_rate_tactics', $data);
			$id = $this->db->insert_id();
			
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
						$qry = "INSERT INTO `sup_apart_maintain_month` ( 
						`sup_id` ,`sup_rate_tactics_id` ,`hotel_id` ,`date` ,`week_day` ,`day` ,`month` ,`year` ,`rate` ,`extra_bed_price` ,`available_rooms` ,`capacity` ,`adult` ,`child` ,`child_charge` ,`infant` ,`status`)
						VALUES ( 'admin', '".$id."', '".$hotel_id."', '".$date."', '".$weekday[$i]."', '".$day[0]."', '".$day[1]."', '".$day[2]."', '".$price[$i]."', '".$extra_bed_price[$i]."','".$avail[$i]."', '', '".$aadult[$i]."', '".$achild[$i]."', '".$child_price[$i]."', '".$infant[$i]."', '1')";
							$query=$this->db->query($qry);
					}
				}
			}
			
		}
		$sql="SELECT no_of_rooms FROM sup_inv_cate_type 
				WHERE room_type='".$room_cate."' 
				AND max_person='".$room_type."'";
		$res=mysql_query($sql);
		$val=mysql_fetch_array($res);
		$count=$val['no_of_rooms']-$avail[0];

		$upd="UPDATE sup_inv_cate_type SET no_of_rooms='".$count."'
				WHERE room_type='".$room_cate."' 
				AND max_person='".$room_type."'";
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
		$where = "sup_rate_tactics_id = $tacktics_id";
		if ($this->db->delete('sup_rate_tactics', $where)) {
			return true;
		} else {
			return false;
		}
	}
	//home get hotel price
	function get_rate_tactics_details($tacktics_id)
	{		
		$select = "SELECT a.*,b.* FROM sup_rate_tactics a join sup_rate_cancel_policy b ON a.sup_rate_tactics_id=b.rate_tactics_id where sup_rate_tactics_id = '$tacktics_id'";
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
	//for edit rate plan
	function edit_pricemanager_ad($tacktics_id,$market_id,$cancel_policy_desc,$board_type,$hotel_id,$room_cate,$room_type,$child_policy,$cancel_policy_nights,$cancel_policy_percent,$cancel_policy_charge,$cancel_policy_from,$cancel_policy_to,$room_avail_date_from,$room_avail_date_to,$dates,$weekday,$price,$extra_bed_price,$avail,$aadult,$achild,$child_price,$infant,$fileimage,$fileimage1,$fileimage2,$fileimage3)
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
							cancel_policy_desc='$cancel_policy_desc',
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
					//$delqrys = "DELETE FROM sup_rate_cancel_policy WHERE rate_tactics_id = ".$tacktics_id.""; 
					//$exequery= $this->db->query($delqrys);	
				
					if($k==0) 
					{
						$select="UPDATE sup_rate_cancel_policy 
									SET cancel_policy_nights='$cancel_policy_nights',
										cancel_policy_percent='$cancel_policy_percent',
										cancel_policy_charge='$cancel_policy_charge', 
										cancel_policy_from='$cancel_policy_from',
										cancel_policy_to='$cancel_policy_to'";
						$select.=" WHERE rate_tactics_id='$tacktics_id'";
						$this->db->query($select); 
					}
				
					$delqry = "DELETE FROM sup_apart_maintain_month WHERE sup_rate_tactics_id = ".$tacktics_id.""; 
					$query=$this->db->query($delqry);
				
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
								if(strlen($day[2]) ==4){
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
								//echo $date;exit;
								$qry = "INSERT INTO `sup_apart_maintain_month` ( 
								`sup_id` ,`sup_rate_tactics_id` ,`hotel_id` ,`date` ,`week_day` ,`day` ,`month` ,`year` ,`rate` ,`extra_bed_price` ,`available_rooms` ,`capacity` ,`adult` ,`child` ,`child_charge` ,`infant` ,`status`)
								VALUES ( 'admin', '".$tacktics_id."', '".$hotel_id."', '".$date."', '".$weekday[$i]."', '".$day1."', '".$mnth."', '".$year."', '".$price[$i]."', '".$extra_bed_price[$i]."','".$avail[$i]."', '', '".$adults[$i]."', '".$childs[$i]."', '".$avail_child_price[$i]."', '".$avail_infant[$i]."', '1')";
								$query=$this->db->query($qry);
							}
						 }
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
	//admin add amenity
	public function add_amenity($amenity_name)
	{
		$data =array('amenity_name' 	=> $amenity_name,'status' => '1');
		$this->db->insert('global_amenity_list',$data);
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
	
	//hotel available data
	function hotels_data($hotel_search_data)
	{
		$data = array('session_id'=>$hotel_search_data['hotel_search_data']['sess_id'],'city_name' => $hotel_search_data['hotel_search_data']['cityname']);
		$this->db->set('checked_date', 'NOW()', FALSE); 
		$this->db->insert('session', $data);
		$id = $this->db->insert_id();
		if(!empty($id)) 
		{
			return true;
		}else{
			return false;
		}
	
	}
	
	
	function fetchingresult($cityname1='',$cin='',$cout='',$rooms1='',$adults='',$childs='',$val) {  $val = ($val!='')?$val:0;
		 $d1=explode("-",$cin);
		 $d2=explode("-",$cout);
		$datefrom=$d1[2]."-".$d1[1]."-".$d1[0];
		$dateto=$d2[2]."-".$d2[1]."-".$d2[0];
		$select = "SELECT SQL_CALC_FOUND_ROWS t.*,m.*,r.*,c.*,h.* FROM sup_hotels h,sup_rate_tactics t, sup_apart_maintain_month m, sup_rate_cancel_policy c, sup_hotel_room_type r 
			WHERE h.city='".$cityname1."' AND h.status=1  AND t.hotel_id=h.sup_hotel_id AND  '".$datefrom."' >= t.room_avail_date_from  
			AND  '".$dateto."' < t.room_avail_date_to  AND m.date BETWEEN '".$datefrom."' AND '".$dateto."' 
			 AND t.sup_rate_tactics_id = m.sup_rate_tactics_id AND m.hotel_id = t.hotel_id AND c.rate_tactics_id = t.sup_rate_tactics_id
			 AND r.hotel_room_type = t.category_type AND .m.adult='".$adults."' AND m.child='".$childs."' AND h.status = 1 AND m.available_rooms > 0 GROUP BY t.hotel_id order by m.rate asc limit $val,10";
			
			 $ss = "SELECT FOUND_ROWS() as ffff";
			 $query=$this->db->query($select);
			if ($query->num_rows() > 0){	
				$qq=$this->db->query($ss);
				return array($query->result(),$qq->result());
			} else {
				return '';
			}
	}
			
	
	function get_hotel($hotel_id) {
			
			$this->db->select('*')->from('sup_hotels')->where('sup_hotel_id',$hotel_id);
			$query=$this->db->get();
			if($query->num_rows()>0) {
				return $query->row();
			}		
	}
	
	function get_sup_rate_tactics($sup_rate_id) {
			
			$this->db->select('*')->from('sup_rate_tactics')->where('sup_rate_tactics_id',$sup_rate_id);
			$query=$this->db->get();
			if($query->num_rows()>0) {
				return $query->row();
			}		
	}
	
	function get_category($hotel_id) {
		
		$this->db->select('category_type,sup_rate_tactics_id,main_image')->from('sup_rate_tactics')->where('hotel_id',$hotel_id);
		$query=$this->db->get();
		if($query->num_rows()>0) {
			     return $query->result();
			} else {
				return '';
			}
	}
	
	function get_catedetails($cate_name) {
		
		$this->db->select('*')->from('sup_hotel_room_type')->where('hotel_room_type',$cate_name);
			$query=$this->db->get();
			if($query->num_rows()>0) {
			     return $query->row();
			} else {
				return '';
			}
	}
	
	function get_rate($sup_rate_id) {
		
		$this->db->select('rate,supplementary_charge_rate')->from('sup_apart_maintain_month')->where('sup_rate_tactics_id',$sup_rate_id)->group_by('sup_rate_tactics_id');
		$query=$this->db->get();
		if($query->num_rows()>0) {
			     return $query->row();
			}
	}
	
	function similar_hotel($cityname1) {
		
		$select= "SELECT h.*,m.rate,m.supplementary_charge_rate,r.main_image,r.sup_rate_tactics_id FROM sup_hotels h,sup_apart_maintain_month m,sup_rate_tactics r WHERE h.status=1 AND h.city='".$cityname1."' AND r.hotel_id=h.sup_hotel_id	AND m.sup_rate_tactics_id=r.sup_rate_tactics_id GROUP BY h.sup_hotel_id order by h.star desc LIMIT 4";
		$query=$this->db->query($select);
		if($query->num_rows()>0) {
			return $query->result();
		}
		else {
			return '';
		} 
	}
	
	function get_tax($country) {
		
		$this->db->select('country_markup')->from('country_markup')->where('country_name',$country);
		$query=$this->db->get();
		if($query->num_rows()>0) {
			return $query->row();
		}
		else {
			return '';
		} 
		
		}
		
	function get_latest_hotels($value='') {
			$value = ($value!='')?$value:0;
			$sql="SELECT s.*,r.sup_rate_tactics_id,r.main_image,r.room_avail_date_from,r.room_avail_date_to from sup_hotels s INNER JOIN sup_rate_tactics r ON r.hotel_id=s.sup_hotel_id  group by s.sup_hotel_id order by sup_hotel_id desc LIMIT $value,4 ";
			$query=$this->db->query($sql); 
		if($query->num_rows()>0) {
			return $query->result();
		}
		else {
			return '';
		}
		
		}
	function get_accType()
	{
		$this->db->select('*')
				 ->from('sup_hotel_accommodation')
				 ->where('status',1);
		$query=$this->db->get();
		if($query->num_rows()>0) {
			return $query->result();
		}else{
			return '';
		} 
	}
	function get_hotelAmenites()
	{
		$this->db->select('*')
				 ->from('global_amenity_list')
				 ->where('status',1);
		$query=$this->db->get();
		if($query->num_rows()>0) {
			return $query->result();
		}else{
			return '';
		} 
	}
	function get_roomAmenites()
	{
		$this->db->select('*')
				 ->from('sup_hotel_room_facility')
				 ->group_by('facility_name');
		$query=$this->db->get();
		if($query->num_rows()>0) {
			return $query->result();
		}else{
			return '';
		} 
	}
	function get_otherAmenites()
	{
		$this->db->select('*')
				 ->from('sup_hotel_others')
				 ->group_by('others_name');
		$query=$this->db->get();
		if($query->num_rows()>0) {
			return $query->result();
		}else{
			return '';
		} 
	}
	function get_Location()
	{
		$this->db->select('detail_location')
				 ->from('sup_hotels')
				 ->group_by('detail_location');
		$query=$this->db->get();
		if($query->num_rows()>0) {
			return $query->result();
		}else{
			return '';
		} 
	}
	function check_availabilty($details)
	{
		$startDate = strtotime($details['check_in']);
		$endDate = strtotime($details['check_out']);
		$i=0;$j=0;
		while ($startDate < $endDate) {
		$startsDate = date("Y-m-d",strtotime('+1 day', $startDate));
		$startDate  = strtotime('+1 day', $startDate);
		$this->db->select('*')
					 ->from('sup_apart_maintain_month')
					 ->where('date',$startsDate)
					 ->where('hotel_id',$details['hotel_id']);
			$query=$this->db->get();
			if($details['rooms']<=$query->row()->available_rooms){
				$j++;
			}
			$i++;
		}
		if($i==$j){
			return 1;
		}else{
			return 0;
		}
    }
	function book_hotel($details,$user_id)
	{
		//~ echo '<pre>';
		//~ print_r($details);exit;
		$startDate = DateTime::createFromFormat("d-m-Y",$details['check_in'],new DateTimeZone("Europe/London"));
		$endDate = DateTime::createFromFormat("d-m-Y",$details['check_out'],new DateTimeZone("Europe/London"));

		$periodInterval = new DateInterval( "P1D" ); // 1-day, though can be more sophisticated rule
		$period = new DatePeriod( $startDate, $periodInterval, $endDate );
		$i=0;$j=0;
		foreach($period as $date){
			$this->db->select('*')
					 ->from('sup_apart_maintain_month')
					 ->where('date',$date->format("Y-m-d"))
					 ->where('hotel_id',$details['hotel_id']);
			$query=$this->db->get();
			if($details['room']<=$query->row()->available_rooms){
				$j++;
			}
			$i++;
		}
		if($i==$j){
			$startDate = DateTime::createFromFormat("d-m-Y",$details['check_in'],new DateTimeZone("Europe/London"));
			$endDate = DateTime::createFromFormat("d-m-Y",$details['check_out'],new DateTimeZone("Europe/London"));

			$periodInterval = new DateInterval( "P1D" ); // 1-day, though can be more sophisticated rule
			$period = new DatePeriod( $startDate, $periodInterval, $endDate );
			$i=0;$j=0;
			foreach($period as $date){
				$this->db->select('*')
						 ->from('sup_apart_maintain_month')
						 ->where('date',$date->format("Y-m-d"))
						 ->where('hotel_id',$details['hotel_id']);
				$query=$this->db->get();
				
				$rooms=$query->row()->available_rooms-$details['room'];
				
				$data = array('available_rooms' => $rooms);
				$where = "date = '".$date->format("Y-m-d")."' && hotel_id= '".$details['hotel_id']."'";
				$this->db->update('sup_apart_maintain_month', $data, $where);
			}
			$booking_id='FOB'.rand();$user_type=0;
			if(isset($_SESSION['email']) && $_SESSION['email']!=''){
				$user=$_SESSION['email'];
				$user_type=1;
			}
			$data = array(
				'booking_id'         => $booking_id,
				'hotel_id'			 => $details['hotel_id'],
				'booking_name' 		 => $user_id,
				'user_type'          => '1',
				'sup_ratetacktics_id'=> $details['sup_rate_id'],
				'hotel_name'         => $details['hotel_name'],
				'customer_fname'	 => $details['fname'],
				'customer_lname'	 => $details['lname'],
				'customer_email'	 => $details['email'],
				'customer_address1'	 => $details['address1'],
				'customer_address2'	 => $details['address2'],
				'customer_city'	     => $details['city'],
				'customer_phone'	 => $details['phone'],
				'customer_country'	 => $details['country'],
				'customer_checkin'	 => $details['check_in'],
				'customer_checkout'	 => $details['check_out'],
				'coustomer_room'	 => $details['room'],
				'customer_finalcost' => $details['final_cost'],
				'created_date'		 => date("Y-m-d"),
				'status' => 1
			);
			$this->db->insert('booking_info', $data);
			
			$this->db->select('*')
					 ->from('booking_info')
					 ->where('booking_id',$booking_id);
		    $query=$this->db->get();
		    if($query->num_rows()>0){
				return $query->row();
			}else{
				return 'fail';
			}
		}else{
			echo 'fail';exit;
		}
	}
	
	function detect_cost($post,$balance,$user_id,$agent_tax) {
			$tax=$agent_tax/100*$post['final_cost'];
			$final_amt=$post['final_cost']-$tax;
			if($balance >$final_amt) {
			  $balance_amt=$balance-$final_amt;
			  $this->db->update('callcenter_credit', array('credit'=>$balance_amt), array('callcenter_id' => $user_id));
			  return true;
			} else {
				return false;
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
	
		function get_admininfo() {
		
		$this->db->select('*')->from('admin');
		$query=$this->db->get();
		if($query->num_rows()>0) {
			return $query->row();
		} else {
			return '';
		}
	}
	
	function get_agentinfo($agent_id) {
		
		$this->db->select('*')->from('callcenter_agents')->where('callagent_id',$agent_id);
		$query=$this->db->get();
		if($query->num_rows()>0) {
			return $query->row();
		} else {
			return '';
		}
	}
	function get_popular_hotels() {
		$sql="SELECT s.*,r.sup_rate_tactics_id,r.main_image,r.room_avail_date_from,r.room_avail_date_to from sup_hotels s INNER JOIN sup_rate_tactics r ON r.hotel_id=s.sup_hotel_id  group by s.sup_hotel_id order by sup_hotel_id desc LIMIT 0,10 ";
		$query=$this->db->query($sql); 
		if($query->num_rows()>0) {
			return $query->result();
		}
		else {
			return '';
		}
	}
//--------------closing class--------------//
	
}  
