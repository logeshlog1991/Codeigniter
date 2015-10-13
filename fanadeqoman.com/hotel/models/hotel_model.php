<?php
class Hotel_Model extends CI_Model {
	
	public function __construct()
    {
      parent::__construct();
    }
    public function get_aboutUs($about_us)
    {
		$query = $this->db->select('*')->from('static_pages')->where('page_name',$about_us)->get();
		if($query->num_rows > 0 ) 
		{     
			if($_SESSION['langH']=='english')
			{ 
				return $query->row()->page_content;
			}else{
				return $query->row()->page_contentA;
			}
      	}else{
			return '';
		}
	}
	 public function get_contactUs($about_us)
    {
		$query = $this->db->select('*')->from('static_pages')->where('page_name',$about_us)->get();
		if($query->num_rows > 0 ) 
		{   
			if($_SESSION['langH']=='english')
			{    
				return $query->row()->page_content;
			}else{
				return $query->row()->page_contentA;
			}
      	}else{
			return '';
		}
	}
	
    public function get_terms($terms)
    {
		$query = $this->db->select('*')->from('static_pages')->where('page_name',$terms)->get();
		if($query->num_rows > 0 ) 
		{      
         	if($_SESSION['langH']=='english')
			{
				return $query->row()->page_content;
			}else{
				return $query->row()->page_contentA;
			}
      	}else{
			return '';
		}
	}
	public function get_faq($faq)
    {
		$query = $this->db->select('*')->from('static_pages')->where('page_name',$faq)->get();
		if($query->num_rows > 0 ) 
		{      
         	if($_SESSION['langH']=='english')
			{
				return $query->row()->page_content;
			}else{
				return $query->row()->page_contentA;
			}
      	}else{
			return '';
		}
	}
	
    public function get_banners()
    {
		$query = $this->db->select('*')->from('banners')->get();
		if($query->num_rows > 0 ) 
		{      
         	return $query->row();
      	}else{
			return '';
		}
	}
	public function get_popularBanners()
	{
		$query=$this->db->select('*')->from('papular_banners')->get();
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return '';
		}
	}
	/*
	 *  admin getting search_data
	*/
	public function search_data()
	{
		//~ $select = "SELECT A.*, B.status, B.hotel_name, B.hotel_chain_name, B.city
                        //~ FROM sup_apart_houserules A 
                        //~ INNER JOIN sup_hotels B ON B.sup_hotel_id = A.hotel_id 
			//~ WHERE B.status = '1'"; 
		if($_SESSION['langH']=='english')
		{	
			$sql="SELECT C.* FROM city_town C LEFT JOIN sup_hotels S ON S.city=C.c_no where C.city_name LIKE '%".$_GET['term']."%' GROUP BY C.city_name LIMIT 50";
		}else{
			$sql="SELECT C.* FROM city_town C LEFT JOIN sup_hotels S ON S.city=C.c_no where C.city_nameA LIKE '%".$_GET['term']."%' GROUP BY C.city_nameA LIMIT 50";
		}
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
		    $select = "SELECT SQL_CALC_FOUND_ROWS t.*,m.*,r.*,h.*,A.*,B.*,st.*,h.star as smt FROM sup_hotels h,sup_rate_tactics t,city_town A,country B,
						sup_apart_maintain_month m,sup_roomManager r,star st WHERE h.city='".$cityname1."' 
						AND h.status=1  AND t.hotel_id=h.sup_hotel_id AND st.s_no=h.star AND A.c_no=h.city AND B.country_id=h.country AND 
						'".$datefrom."' >= t.room_avail_date_from AND  '".$dateto."' < t.room_avail_date_to  AND m.date BETWEEN 
						'".$datefrom."' AND '".$dateto."' AND t.sup_rate_tactics_id = m.sup_rate_tactics_id AND m.hotel_id = t.hotel_id 
						AND r.hotel_id = t.hotel_id AND h.status = 1 
						AND m.available_rooms > 0 GROUP BY t.hotel_id order by m.rate asc limit $val,10";
			//echo $select;die;
			//~ $select = "SELECT SQL_CALC_FOUND_ROWS t.*,m.*,r.*,c.*,h.* FROM sup_hotels h,sup_rate_tactics t, sup_apart_maintain_month m, sup_rate_cancel_policy c, sup_hotel_room_type r 
			//~ WHERE h.city='".$cityname1."' AND h.status=1  AND t.hotel_id=h.sup_hotel_id AND  '".$datefrom."' >= t.room_avail_date_from  
			//~ AND  '".$dateto."' < t.room_avail_date_to  AND m.date BETWEEN '".$datefrom."' AND '".$dateto."' 
			//~ AND t.sup_rate_tactics_id = m.sup_rate_tactics_id AND m.hotel_id = t.hotel_id AND c.rate_tactics_id = t.sup_rate_tactics_id
			//~ AND r.hotel_room_type = t.category_type AND .m.adult='".$adults."' AND m.child='".$childs."' AND h.status = 1 AND m.available_rooms > 0 GROUP BY t.hotel_id order by m.rate asc limit $val,10";
			//~ //echo $select; die;
			$ss = "SELECT FOUND_ROWS() as ffff";
			$query=$this->db->query($select);
			if ($query->num_rows() > 0){	
				$qq=$this->db->query($ss);
				return array($query->result(),$qq->result());
			} else {
				return '';
			}
	}
	function get_category1($cat_id)
	{
		$sql="SELECT * FROM sup_roomManager WHERE room_id='".$cat_id."'";
		$res=$this->db->query($sql);
		if($res->num_rows() ==''){
			return 0;
		}else{
			return $res->row();
		}
		
	}
	function get_type1($cat_id)
	{
		$sql="SELECT * FROM sup_roomType WHERE type_id='".$cat_id."'";
		$res=$this->db->query($sql);
		if($res->num_rows() ==''){
			return 0;
		}else{
			return $res->row();
		}
		
	}		
	
	function get_hotel($hotel_id) {
			$select= "SELECT h.*,st.*,h.star as smt FROM sup_hotels h INNER JOIN star st ON st.s_no=h.star WHERE h.sup_hotel_id='".$hotel_id."'";
			$query=$this->db->query($select);
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
		
		$this->db->select('category_type,sup_rate_tactics_id,main_image,room_type')->from('sup_rate_tactics')->where('hotel_id',$hotel_id);
		$query=$this->db->get();
		if($query->num_rows()>0) {
			     return $query->result();
			} else {
				return '';
			}
	}
	
	function get_category2($hotel_id) {
		//~ $this->db->select('category_type,sup_rate_tactics_id,main_image,room_type')->from('sup_rate_tactics')->where('hotel_id',$hotel_id);
		//~ $query=$this->db->get();
		//~ if($query->num_rows()>0) {
			     //~ return $query->result();
			//~ } else {
				//~ return '';
			//~ }
			
		$select= "SELECT a.sup_rate_tactics_id,b.* FROM sup_rate_tactics a,sup_roomManager b WHERE a.status=1 AND b.room_id=a.room_type AND a.hotel_id='".$hotel_id."'";
		$query=$this->db->query($select);
		if($query->num_rows()>0) {
			return $query->result();
		}
		else {
			return '';
		} 
	}
	function get_roomServices($capacity_id)
	{
		$this->db->select('*')->from('sup_roomManager')->where('capacity_title',$capacity_id);
		$query=$this->db->get();
		if($query->num_rows()>0) {
			 return $query->row()->hotel_room_services;
		} else {
			return '';
		}
	}
	function get_room_type($capacity_id) {
		
		$this->db->select('*')->from('sup_hotel_capacity')->where('capacity_id',$capacity_id);
		$query=$this->db->get();
		if($query->num_rows()>0) {
			     return $query->row();
			} else {
				return '';
			}
	}
	
	function get_catedetails($cate_id) {
		
		$this->db->select('*')->from('sup_hotel_room_type')->where('`sup_hotel_room_type_id',$cate_id);
			$query=$this->db->get();
			if($query->num_rows()>0) {
			     return $query->row();
			} else {
				return '';
			}
	}
	
	function get_rate($sup_rate_id) {
		
		$this->db->select_max('sell_price')
					->from('sup_apart_maintain_month')
					->where('date',date("Y-m-d"))
					->where('sup_rate_tactics_id',$sup_rate_id)
					->group_by('sup_rate_tactics_id');
		$query=$this->db->get();
		if($query->num_rows()>0) {
			     return $query->row()->sell_price;
			}
	}
	
	function similar_hotel($cityname1) {
		$select= "SELECT h.*,m.sell_price,m.supplementary_charge_rate,h.main_image,r.sup_rate_tactics_id,st.*,h.star as smt FROM sup_hotels h,sup_apart_maintain_month m,sup_rate_tactics r,star st WHERE m.date='".date("Y-m-d")."' AND h.status=1 AND st.s_no=h.star AND h.city='".$cityname1."' AND r.hotel_id=h.sup_hotel_id	AND m.sup_rate_tactics_id=r.sup_rate_tactics_id GROUP BY h.sup_hotel_id order by h.star desc LIMIT 4";
		$query=$this->db->query($select);
		if($query->num_rows()>0) {
			return $query->result();
		}
		else {
			return '';
		} 
	}
	
	function get_tax($country) {
		$this->db->select('country_markup')->from('country_markup')->where('country_id',$country);
		$query=$this->db->get();
		if($query->num_rows()>0) {
			return $query->row();
		}
		else {
			return '';
		} 
	}
	
	function get_City($city_id) {
		$this->db->select('*')->from('city_town')->where('c_no',$city_id);
		$query=$this->db->get();
		if($query->num_rows()>0) {
			if($_SESSION['langH']=='english')
			{
				return $query->row()->city_name;
			}else{
				return $query->row()->city_nameA;
			}
		}
		else {
			return '';
		} 
	}
	function get_Area($area_id) {
		$this->db->select('*')->from('area')->where('a_no',$area_id);
		$query=$this->db->get();
		if($query->num_rows()>0) {
			if($_SESSION['langH']=='english')
			{
				return $query->row()->area_name;
			}else{
				return $query->row()->area_nameA;
			}
		}
		else {
			return '';
		} 
	}
	
	function city_country_name($country) {
		$this->db->select('*')->from('country')->where('country_id',$country);
		$query=$this->db->get();
		if($query->num_rows()>0) {
			if($_SESSION['langH']=='english')
			{
				return $query->row()->name;
			}else{
				return $query->row()->nameA;
			}
		}
		else {
			return '';
		} 
	}
	function detail_location($loc_sno) {
		$this->db->select('*')->from('hotel_locations')->where('loc_sno',$loc_sno);
		$query=$this->db->get();
		if($query->num_rows()>0) {
			if($_SESSION['langH']=='english')
			{
				return $query->row()->location_name;
			}else{
				return $query->row()->location_nameA;
			}
		}
		else {
			return '';
		} 
	}
	
	function get_roomCategory($cate_id) {
		$this->db->select('*')->from('sup_hotel_room_type')->where('sup_hotel_room_type_id',$cate_id);
		$query=$this->db->get();
		if($query->num_rows()>0) {
			if($_SESSION['langH']=='english')
			{
				return $query->row()->hotel_room_type;
			}else{
				return $query->row()->hotel_room_typeA;
			}
		} else {
			return '';
		}
	}
	function hotel_room_services($ser_sno) {
		$this->db->select('*')->from('sup_hotel_room_facility')->where('sup_fac_id',$ser_sno);
		$query=$this->db->get();
		if($query->num_rows()>0) {
			if($_SESSION['langH']=='english')
			{
				return $query->row()->facility_name;
			}else{
				return $query->row()->facility_nameA;
			}
		}
		else {
			return '';
		} 
	}
	
	function get_latest_hotels($value='') {
		$value = ($value!='')?$value:0;
		$sql="SELECT s.*,s.star as smt,r.sup_rate_tactics_id,r.room_avail_date_from,r.room_avail_date_to,c.name as country_name,s.main_image,st.* from sup_hotels s INNER JOIN sup_rate_tactics r ON r.hotel_id=s.sup_hotel_id INNER JOIN star st ON st.s_no=s.star INNER JOIN country c ON c.country_id=s.country group by s.sup_hotel_id order by sup_hotel_id desc LIMIT $value,4 ";
		$query=$this->db->query($sql); 
		if($query->num_rows()>0) {
			return $query->result();
		}
		else {
			return '';
		}
	}
	function get_popular_hotels() {
		$sql="SELECT s.*,r.sup_rate_tactics_id,r.room_avail_date_from,r.room_avail_date_to,s.main_image from sup_hotels s INNER JOIN sup_rate_tactics r ON r.hotel_id=s.sup_hotel_id  group by s.sup_hotel_id order by sup_hotel_id desc LIMIT 0,10 ";
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
		$this->db->select('*')->from('hotel_type')->where('status',1);
		$query=$this->db->get();
		if($query->num_rows()>0) {
			return $query->result();
		}else{
			return '';
		} 
	}
	function get_hotelAmenites()
	{
		$this->db->select('*')->from('global_amenity_list')->where('status',1);
		$query=$this->db->get();
		if($query->num_rows()>0) {
			return $query->result();
		}else{
			return '';
		} 
	}
	function get_roomAmenites()
	{
		$this->db->select('*')->from('sup_hotel_room_facility')->group_by('facility_name');
		$query=$this->db->get();
		if($query->num_rows()>0) {
			return $query->result();
		}else{
			return '';
		} 
	}
	function get_otherAmenites()
	{
		$this->db->select('*')->from('sup_hotel_others')->group_by('others_name');
		$query=$this->db->get();
		if($query->num_rows()>0) {
			return $query->result();
		}else{
			return '';
		} 
	}
	function get_Location()
	{
		//~ $this->db->select('hotel_locations.location_name')
				 //~ ->from('sup_hotels')
				 //~ ->join('hotel_locations','hotel_locations.loc_sno=sup_hotels.detail_location')
				 //~ ->group_by('sup_hotels.detail_location');
		//~ 
		$select="SELECT *  FROM  hotel_locations";
		
		$query=$this->db->query($select);
		if($query->num_rows()>0) {
			return $query->result();
		}else{
			return '';
		} 
	}
	function check_availabilty($details)
	{
		//~ echo '<pre>';
		//~ print_r($details);die;
		
		$startDate = strtotime($details['check_in']);
		$endDate = strtotime($details['check_out']);
		$i=0;$j=0;
		while ($startDate < $endDate) {
			
		$startsDate = date("Y-m-d",strtotime('+0 day', $startDate));
		
		$startDate  = strtotime('+1 day', $startDate);
		$this->db->select('*')
					 ->from('sup_apart_maintain_month')
					 ->where('date',$startsDate)
					 ->where('sup_rate_tactics_id',$details['sup_rate_id'])
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
	function book_hotel($details)
	{
		
		$this->db->select('*')->from('admin');
		$query=$this->db->get();
		$admarkup=$query->row()->admin_markup;
		 
		$this->db->select('*')->from('payment_charge');
		$query=$this->db->get();
		$rateAftergateway=$query->row()->charge;
		
		$country_star="select s.star,cm.country_markup,sm.star_markup FROM sup_hotels s LEFT JOIN country_markup cm ON cm.country_id=s.country LEFT JOIN star st ON st.s_no=s.star LEFT JOIN star_markup sm ON sm.star_name=st.star WHERE s.sup_hotel_id='".$details['hotel_id']."'";
		$query=$this->db->query($country_star); 
		
		$country_markup=$query->row()->country_markup;
		
		$star_markup=$query->row()->star_markup;
		
		$hotel_star=$query->row()->star;
		
		$startDate = strtotime($details['check_in']);
		$endDate = strtotime($details['check_out']);
		
		$i=0;$j=0;$base_price='';
		while ($startDate < $endDate) {
		$startsDate = date("Y-m-d",strtotime('+0 day', $startDate));
		
		$startDate  = strtotime('+1 day', $startDate);
			$this->db->select('*')
					 ->from('sup_apart_maintain_month')
					 ->where('date',$startsDate)
					 ->where('hotel_id',$details['hotel_id']);
			$query=$this->db->get();
			$base_price=$query->row()->rate;
			if($details['room']<=$query->row()->available_rooms){
				$j++;
			}
			$i++;
		}

		if($i==$j){
			$startDate = strtotime($details['check_in']);
			$endDate = strtotime($details['check_out']);
		
			$i=0;$j=0;$k=0;
			while ($startDate < $endDate) {
				
				$startsDate = date("Y-m-d",strtotime('+0 day', $startDate));
				$startDate  = strtotime('+1 day', $startDate);
		
				$this->db->select('*')
						 ->from('sup_apart_maintain_month')
						 ->where('date',$startsDate)
						 ->where('hotel_id',$details['hotel_id']);
				$query=$this->db->get();
				$rooms=$query->row()->available_rooms-$details['room'];
				$sup_apart_maintain_month_id=$query->row()->sup_apart_maintain_month_id;
				$data = array('available_rooms' => $rooms);
				$where = "date = '".$startsDate."' && hotel_id= '".$details['hotel_id']."' && sup_apart_maintain_month_id= '".$sup_apart_maintain_month_id."'";
				$this->db->update('sup_apart_maintain_month', $data, $where);
				$k++;
			}
			$booking_id='FOB'.rand();
			$user=$details['fname'].' '.$details['lname'];$user_type=0;$agent_id='User';
			if(isset($_SESSION['email']) && $_SESSION['email']!=''){
				$user=$_SESSION['username'];
				$user_type=2;
				$agent_id=$_SESSION['user_id'];
			}
		$data = array(
				'booking_id'         => $booking_id,
				'agent_id'       	 => $agent_id,
				'hotel_id'			 => $details['hotel_id'],
				'sup_ratetacktics_id'=> $details['sup_rate_id'],
				'booking_name' 		 => $user,
				'user_type'          => $user_type,
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
				'no_days'			 => $details['nights'],
				'no_adults'			 => $details['adults'],
				'no_childs'			 => $details['childs'],
				'customer_finalcost' => $details['final_cost'],
				'star_markup'  		 => $star_markup,
				'markup'  			 => $admarkup,
				'gateway'  			 => $rateAftergateway,
				'country_markup' 	 => $country_markup,
				'star' 				 => $hotel_star,
				'room_baseprice'	 =>	$base_price,
				'created_date'		 => date("Y-m-d h:i:s"),
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
			return 'fail';exit;
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
	
	function payment_gateway() {
		$this->db->select('charge')->from('payment_charge');
		$query=$this->db->get();
		if($query->num_rows()>0) {
			return $query->row()->charge;
		} else {
			return '';
		}
	}
	function hotel_amenity($amen_id) {
		$this->db->select('*')->from('global_amenity_list')->where('amenity_list_id',$amen_id);
		$query=$this->db->get();
		if($query->num_rows()>0) {
			if($_SESSION['langH']=='english')
			{
				return $query->row()->amenity_name;
			}else{
				return $query->row()->amenity_nameA;
			}
		} else {
			return '';
		}
	}
	function other_accommodation($acc_id) {
		$this->db->select('*')->from('sup_hotel_others')->where('others_id',$acc_id);
		$query=$this->db->get();
		if($query->num_rows()>0) {
			if($_SESSION['langH']=='english')
			{
				return $query->row()->others_name;
			}else{
				return $query->row()->others_nameA;
			}
		} else {
			return '';
		}
	}
	function get_hotelArea($area_id) {
		$this->db->select('*')->from('area')->where('a_no',$area_id);
		$query=$this->db->get();
		if($query->num_rows()>0) {
			if($_SESSION['langH']=='english')
			{
				return $query->row()->area_name;
			}else{
				return $query->row()->area_nameA;
			}
		} else {
			return '';
		}
	}
	function get_hotelCity($city_id) {
		$this->db->select('*')->from('city_town')->where('c_no',$city_id);
		$query=$this->db->get();
		if($query->num_rows()>0) {
			if($_SESSION['langH']=='english')
			{
				return $query->row()->city_name;
			}else{
				return $query->row()->city_nameA;
			}
		} else {
			return '';
		}
	}
	function get_Country($country_id) {
		$this->db->select('*')->from('country')->where('country_id',$country_id);
		$query=$this->db->get();
		if($query->num_rows()>0) {
			if($_SESSION['langH']=='english')
			{
				return $query->row()->name;
			}else{
				return $query->row()->nameA;
			}
		} else {
			return '';
		}
	}
	
	
//--------------closing class--------------//
	
}  
