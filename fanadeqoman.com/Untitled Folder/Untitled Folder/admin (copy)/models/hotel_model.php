<?php
class Hotel_Model extends CI_Model {
	
	public function __construct()
    {
      parent::__construct();
    }
    public function RowsCount($result){
		return $result->num_rows();
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
    function add_country($country_details)
    {
		$data = array(
					'name'=>$country_details['add_country_name'],
					'nameA'=>$country_details['add_country_nameA']
				);
		$this->db->insert('country',$data);
	}
    function get_market_available()
	{
		$this->db->select('*');
		$this->db->from('sup_hotel_markets');
		$query = $this->db->get();
		if($query->num_rows()>0)
		{
			return $query->result();
		}else{
			return false;
		}
	}
	function add_market($val,$val1)
	{
		$data=array(
				'market_name'=>$val,
				'marketname_arab'=>$val1
			  );
		$this->db->insert('sup_hotel_markets',$data);
	}
	function get_hotelType($type_id)
	{
		$this->db->select('*');
		$this->db->from('hotel_type');
		$this->db->where('h_no',$type_id);
		$query = $this->db->get();
		if($query->num_rows()>0)
		{
			return $query->row()->hotel_type;
		}else{
			return false;
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
			return $query->row()->name;
		}else{
			return '';;
		}
	}
	
	function check_country($country_name)
	{
		$this->db->select('*');
		$this->db->from('country');
		$this->db->where('name',$country_name);
		$query = $this->db->get();
		if($query->num_rows()>0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function fetch_accommodation()
	{
		$this->db->select('*');
		$this->db->from('sup_hotel_accommodation');
		$query = $this->db->get();
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			return '';
		}
	}
	function fetch_other_accommodation()
	{
		$this->db->select('*');
		$this->db->from('sup_hotel_others');
		$query = $this->db->get();
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			return '';
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
     * admin getting all hotels
     */
    public function getting_all_hotels()
	{
		$select = "SELECT A.*,B.*, A.star as Amt FROM sup_hotels A LEFT JOIN star B ON B.s_no = A.star WHERE B.status = '1'"; 
		$query=$this->db->query($select);		
		
		if($query->num_rows > 0 ) 
		{      
         	return $query->result();
      	}else{
			return '';
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
	
	/*
	*  admin going to check hotel is exit or not
	*/
	public function hotel_check($hotel_name,$old_hotel_name='')
	{
		$sql="SELECT * FROM sup_hotels WHERE status=1 and hotel_name='".$hotel_name."'";
		$res=$this->db->query($sql);
		if($res->num_rows() ==''){
			return 0;
		}else if(isset($res->row()->hotel_name)){
			if($old_hotel_name== $res->row()->hotel_name){
				return 0;
			}
		}else{
			return 1;
		}
	}
	/*
	*  admin going to check hotel is exit or not
	*/
	public function hotel_check1($hotel_name,$old_hotel_name='')
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
			 'hotel_nameA' => $hotel['hotel_nameA'],	
			 'hotel_type' => $hotel['hotel_type'],	
			 'star' => $hotel['star'],	
			 'hotel_area' => $hotel['hotel_area'],
			 'city' => $hotel['hotel_city'],
			 'hotel_region' => $hotel['hotel_region'],
			 'country' => $hotel['hotel_country'],
			 'start_date' => $hotel['start_date'],
			 'end_date' => $hotel['end_date'],
			 'box' => $hotel['box'],
			 'postel' => $hotel['postel'],
			 'mobile_number' => $hotel['mobile_number'],
			 'fax' => $hotel['fax'],
			 'main_email' => $hotel['email'],
			 'contact_first_name' => $hotel['first_name'],
			 'contact_last_name' => $hotel['last_name'],
			 'contact_person_phone' => $hotel['CNumber'],
			 'contact_person_email' => $hotel['person_email'],
			 'rfax' => $hotel['rfax'],
			 'rphone' => $hotel['Telephone'],
			 'remail1' => $hotel['remail1'],
			 'remail2' => $hotel['remail2'],
			 'website' => $hotel['Website'],
			 'designation' => $hotel['Designation'],
			 'contact_person_phone' => $hotel['CNumber'],
			 'pname' => $hotel['Name'],
			 'ptitle' => $hotel['title'],
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
		
		$delqry1 = "DELETE FROM sup_apart_maintain_month WHERE hotel_id = '".$hotel_id."'"; 
		$query=$this->db->query($delqry1);
		
		$delqry2 = "DELETE FROM sup_hotel_capacity WHERE hotel_id = '".$hotel_id."'"; 
		$query=$this->db->query($delqry2);
		
		$delqry3 = "DELETE FROM sup_rate_tactics WHERE hotel_id = '".$hotel_id."'"; 
		$query=$this->db->query($delqry3);
		
		$delqry4 = "DELETE FROM sup_inv_cate_type WHERE hotel_id = '".$hotel_id."'"; 
		$query=$this->db->query($delqry4);
		
		$delqry5 = "DELETE FROM sup_hotel_room_type WHERE hotel_id = '".$hotel_id."'"; 
		$query=$this->db->query($delqry5);
	}
	 /*
     * admin getting all markets
     */
	public function fetch_markets()
	{
		if($_SESSION['lang']=='english')
		{
			$sql="SELECT * FROM sup_hotel_markets WHERE status=1";
		}else{
			$sql="SELECT * FROM sup_hotel_marketsA WHERE status=1";
		}
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
		$select = "SELECT A.*,B.*, A.star as Amt FROM sup_hotels A LEFT JOIN star B ON B.s_no = A.star WHERE B.status = '1' AND sup_hotel_id='".$hotel_id."'"; 
		$query=$this->db->query($select);		
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->row();
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
		if(isset($hotel['hotel_region']) && $hotel['hotel_region']!='')
		{}else{
			$hotel['hotel_region']=$hotel['hotel_region1'];	
		}
		
		if(isset($hotel['hotel_area']) && $hotel['hotel_area']!='')
		{}else{
			$hotel['hotel_area']=$hotel['hotel_area1'];	
		}
		
		if(isset($hotel['hotel_city']) && $hotel['hotel_city']!='')
		{}else{
			$hotel['hotel_city']=$hotel['hotel_city1'];	
		}
		
		$data = array(
			 'sup_id' => 'admin',
			 'market_name' =>$market_name ,
			 'hotel_name' => $hotel['hotel_name'],	
			 'hotel_nameA' => $hotel['hotel_nameA'],	
			 'hotel_type' => $hotel['hotel_type'],	
			 'star' => $hotel['star'],	
			 'hotel_area' => $hotel['hotel_area'],
			 'city' => $hotel['hotel_city'],
			 'hotel_region' => $hotel['hotel_region'],
			 'country' => $hotel['hotel_country'],
			 'start_date' => $hotel['start_date'],
			 'end_date' => $hotel['end_date'],
			 'box' => $hotel['box'],
			 'postel' => $hotel['postel'],
			 'mobile_number' => $hotel['mobile_number'],
			 'fax' => $hotel['fax'],
			 'main_email' => $hotel['email'],
			 'contact_first_name' => $hotel['first_name'],
			 'contact_last_name' => $hotel['last_name'],
			 'contact_person_phone' => $hotel['CNumber'],
			 'contact_person_email' => $hotel['person_email'],
			 'rfax' => $hotel['rfax'],
			 'rphone' => $hotel['Telephone'],
			 'remail1' => $hotel['remail1'],
			 'remail2' => $hotel['remail2'],
			 'website' => $hotel['Website'],
			 'designation' => $hotel['Designation'],
			 'contact_person_phone' => $hotel['CNumber'],
			 'pname' => $hotel['Name'],
			 'ptitle' => $hotel['title'],
			 );
			 
			$where = "sup_hotel_id = '".$hotel_id."'";
			if ($this->db->update('sup_hotels', $data, $where)) {
				return true;
			}else{
				return false;
			}
		}
	//to room type list
	 function room_list()
	 {
		$select = "SELECT A.*, B.*,C.*,D.*,B.star as smt,st.*,P.*,C.status as main_status FROM sup_hotel_room_type A LEFT JOIN sup_hotels B ON B.sup_hotel_id = A.hotel_id LEFT JOIN star st ON st.s_no = B.star LEFT JOIN sup_inv_cate_type C ON C.hotel_id=A.hotel_id LEFT JOIN sup_hotel_capacity D ON D.capacity_id=C.max_person LEFT JOIN sup_apart_houserules P ON P.hotel_id = A.hotel_id WHERE B.status = '1'";
		$query=$this->db->query($select);
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	 }
	 //to room type list
	 function room_type_list()
	 {
		$select = "SELECT A.sup_hotel_room_type_id, A.hotel_id, A.hotel_room_type, A.hotel_room_services, B.status, B.hotel_name, B.hotel_chain_name, B.city
					FROM sup_hotel_room_type A 
					INNER JOIN sup_hotels B ON B.sup_hotel_id = A.hotel_id 
					WHERE B.status = '1'"; 
		$query=$this->db->query($select);
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
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
       //to get global amenities
	 public function get_starList()
     {		
	 	$this->db->select('*');
	 	$this->db->from('star');
		$this->db->order_by("s_no", "desc");
		$query = $this->db->get();
		if($query->num_rows() ==''){
			return '';			
		}else{
			return $query->result();				
		}
     }
     public function get_stars($star_id)
     {		
	 	$this->db->select('*');
	 	$this->db->from('star');
		$this->db->where('s_no', $star_id);
		$query = $this->db->get();
		if($query->num_rows() ==''){
			return '';			
		}else{
			return $query->row();				
		}
     }
     function editstar_ad($star_id,$star_name)
     {
		$data=array('star' =>$star_name);
		$where = "s_no = '".$star_id."'";
		if ($this->db->update('star', $data, $where)) {
			return true;
		}else{
			return false;
		}
	 }
	 public function delete_star($star_id)
	{
		$where = "s_no = $star_id";
		if ($this->db->delete('star', $where)) {
			return true;
		} else {
			return false;
		}
	}
	  function inactive_star($star_id)
     {
		$data=array('status' =>0);
		$where = "s_no = '".$star_id."'";
		if ($this->db->update('star', $data, $where)) {
			return true;
		}else{
			return false;
		}
	 }
	  function active_star($star_id)
     {
		$data=array('status' =>1);
		$where = "s_no = '".$star_id."'";
		if ($this->db->update('star', $data, $where)) {
			return true;
		}else{
			return false;
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
     //adding room category
	function add_room_type_details($room_data)
	{
		if($room_data['room_categoryA']==''){
			$room_data['room_categoryA']=$room_data['room_category'];
		}
		if($room_data['room_descA']==''){
			$room_data['room_descA']=$room_data['room_desc'];
		}
		$sql="INSERT INTO `sup_hotel_room_type` (`hotel_id`,`sup_id`, `hotel_room_type`, `hotel_room_typeA`,`hotel_room_services`,`room_desc`,`room_descA`) VALUES ('".$room_data['hotel_name']."','admin', '".$room_data['room_category']."', '".$room_data['room_categoryA']."','".serialize($room_data['service'])."','".$room_data['room_desc']."','".$room_data['room_descA']."')";
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
			$where = "sup_hotel_room_type_id = '".$hotel_id."'";
			if ($this->db->update('sup_hotel_room_type', $data, $where)) {
				return true;
			}else{
				return false;
			}
	 }
	/*
	*  admin going to check room category is exit or not
	*/
	public function check_roomcategory($room_category,$hotel_id)
	{
		$sql="SELECT * FROM sup_hotel_room_type WHERE hotel_id='".$hotel_id."' and hotel_room_type='".$room_category."'";
		$res=$this->db->query($sql);
		if($res->num_rows() ==''){
			return 0;
		}else{
			return 1;
		}
	}
	/*
	*  admin going to check room category is exit or not
	*/
	public function category($room_category)
	{
		$sql="SELECT * FROM sup_hotel_room_facility WHERE sup_fac_id='".$room_category."'";
		$res=$this->db->query($sql);
		if($res->num_rows() ==''){
			return 0;
		}else{
			return $res->row()->facility_name;
		}
	}
	/*
	*  admin going to check room category is exit or not
	*/
	public function check_roomcategory1($room_category,$hotel_id,$main_category)
	{
		$sql="SELECT * FROM sup_hotel_room_type WHERE hotel_id='".$hotel_id."' and hotel_room_type='".$room_category."'";
		$res=$this->db->query($sql);
		if($res->num_rows() ==''){
			return 0;
		}else{
			if($main_category!=$res->row()->hotel_room_type){
				return 1;
			}
		}
	}
	 //to view room type
	function getting_room_category($sup_hotel_room_type_id)
	{
		$select = "SELECT * FROM sup_hotel_room_type WHERE sup_hotel_room_type_id = '".$sup_hotel_room_type_id."'"; 
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
		$select = "SELECT A.category_id,A.capacity_id, A.hotel_id, A.capacity_title, A.capacity, A.child_capacity, B.status, B.hotel_name, B.hotel_chain_name, B.city,C.hotel_room_type
				FROM sup_hotel_capacity A 
				INNER JOIN sup_hotels B ON B.sup_hotel_id = A.hotel_id INNER JOIN sup_hotel_room_type C ON C.sup_hotel_room_type_id=A.category_id
				WHERE B.status = '1'"; 
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
		$data = array(
					'hotel_id'=>$hotel['hotel_name'],
					'category_id'=>$hotel['category_id'],
					'capacity'=>$hotel['adult_capacity'],
					'child_capacity'=>$hotel['child_capacity'],
					'capacity_title'=>$hotel['room_type'],
					'capacity_titleA'=>$hotel['room_typeA']
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
	public function Inactive_roomType($capacity_id){
		$data = array('status'=>0);
		$where = "capacity_id = $capacity_id";
		$this->db->update('sup_hotel_capacity',$data,$where);
	}
	public function active_roomType($capacity_id){
		$data = array('status'=>1);
		$where = "capacity_id = $capacity_id";
		$this->db->update('sup_hotel_capacity',$data,$where);
	}
	
	//admin edit room type
	function edit_roomtype($category_id,$capacity_id)
	{
		$select = "SELECT r.*,c.* FROM sup_hotel_room_type r INNER JOIN sup_hotel_capacity c ON c.category_id=r.sup_hotel_room_type_id  WHERE r.sup_hotel_room_type_id = '".$category_id."'"; 
		$query=$this->db->query($select);
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->row();
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
	
	//admin edit room type
	function editroomtype_ad($capacity,$capacity_id)
	{
		$sql="UPDATE sup_hotel_capacity SET hotel_id='".$capacity['hotel_name']."',category_id='".$capacity['category_id']."',capacity_title='".$capacity['room_type']."',capacity_titleA='".$capacity['room_typeA']."',capacity='".$capacity['adult_capacity']."',child_capacity='".$capacity['child_capacity']."'";
		$sql.=" WHERE capacity_id='".$capacity_id."'";
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
		$select = "SELECT A.*, B.status, B.hotel_name, B.hotel_chain_name, B.city,C.*
                        FROM sup_inv_cate_type A 
                        INNER JOIN sup_hotels B ON B.sup_hotel_id = A.hotel_id 
                        INNER JOIN sup_hotel_room_type C ON C.sup_hotel_room_type_id=A.room_type
                        WHERE B.status = '1' order by sup_inv_cate_type_id desc"; 
		
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
						'arrival_time'=>$room_data['arrival_time'],
						'departure_time'=>$room_data['departure_time'],
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
	public function roomcount_ad1($room_data){
		$data = array(
						'sup_id'		=>	'admin',
						'hotel_id'		=>	$room_data['hotel_name'],
						'room_type'		=>	$room_data['room_type'],
						'no_of_rooms'	=>	$room_data['rooms'],
						'max_person'	=>	$room_data['capacity_type'],
						//'arrival_time'=>$room_data['arrival_time'],
						//'departure_time'=>$room_data['departure_time'],
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
	public function Inactive_hotelTypes($roomcount_id){
		$data = array('status' =>0);
		$where = "sup_inv_cate_type_id = $roomcount_id";
		$this->db->update('sup_inv_cate_type',$data,$where);
	}
	public function active_hotelTypes($roomcount_id){
		$data = array('status' =>1);
		$where = "sup_inv_cate_type_id = $roomcount_id";
		$this->db->update('sup_inv_cate_type',$data,$where);
	}
	
	//admin delete room
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
		$data = array(
					'no_of_rooms'=>$room_data['rooms']
					//'arrival_time'=>$room_data['arrival_time'],
					//'departure_time'=>$room_data['departure_time']
				);
		$where = "sup_inv_cate_type_id = $roomcount_id";
		$this->db->update('sup_inv_cate_type',$data,$where);
	}
	//admin get roompolicy list
	function roompolicy_list()
	{
		$select = "SELECT A.*, B.status, B.hotel_name, B.hotel_chain_name, B.city
                        FROM sup_apart_houserules A 
                        INNER JOIN sup_hotels B ON B.sup_hotel_id = A.hotel_id 
			WHERE B.status = '1'"; 
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
	public function Inactive_roompolicy($sup_apart_houserules_id){
		$data = array('status'=>0);
		$where = "sup_apart_houserules_id = $sup_apart_houserules_id";
		$this->db->update('sup_apart_houserules',$data,$where);
	}
	public function active_roompolicy($sup_apart_houserules_id){
		$data = array('status'=>1);
		$where = "sup_apart_houserules_id = $sup_apart_houserules_id";
		$this->db->update('sup_apart_houserules',$data,$where);
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
		$where = "sup_apart_houserules_id = $roomploicy_id";
		if ($this->db->delete('sup_apart_houserules', $where)) {
			return true;
		} else {
			return false;
		}
	}
	/*
	*  admin getting the room Facilities
	*/
	public function roomfacility_list()
	{
		$sql="SELECT * FROM  sup_hotel_room_facility";
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
	public function add_roomfacilites($Room_Facilities)
	{
		if($Room_Facilities['add_roomfac_nameA']=='')
		{
			$Room_Facilities['add_roomfac_nameA']=$Room_Facilities['add_roomfac_name'];
		}
		$data = array(
				'sup_id' => 1,
				'hotel_room' => 0,
				'facility_name' => $Room_Facilities['add_roomfac_name'],
				'facility_nameA' => $Room_Facilities['add_roomfac_nameA'],
				'status' => 1
			);
		$this->db->insert('sup_hotel_room_facility', $data);
		$id = $this->db->insert_id();
		return true;
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
	*  admin Active the room facilites
	*/
	public function Active_room_fac($fac_id)
	{
		$sql="UPDATE sup_hotel_room_facility SET status=1 WHERE sup_fac_id  = '".$fac_id."'";
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
	//to get price list
	function price_list()
	{		
		//~ $select = "SELECT A.*, B.status, B.hotel_name, B.hotel_chain_name, B.city,C.* FROM sup_rate_tactics A INNER JOIN sup_hotels B ON B.sup_hotel_id = A.hotel_id INNER JOIN sup_hotel_room_type C ON C.sup_hotel_room_type_id=A.category_type
				   //~ WHERE B.status = '1' GROUP BY A.sup_id, A.hotel_id, A.category_type, A.room_type,A.allocation_validity_from, A.allocation_validity_to"; 
		//~ 
		
		 $select ="SELECT MAX(smt.date) as mdate , MIN(smt.date)as mindate ,sh.*,cm.*,st.*,sm.*,rt.*,smt.*,rm.*,rc.* from sup_hotels sh LEFT JOIN country_markup cm ON cm.country_id=sh.country LEFT JOIN star st ON st.s_no=sh.star LEFT JOIN star_markup sm ON st.star=sm.star_name LEFT JOIN sup_hotel_room_type rt ON rt.hotel_id=sh.sup_hotel_id LEFT JOIN sup_apart_maintain_month smt ON smt.hotel_id=sh.sup_hotel_id LEFT JOIN sup_hotel_capacity rc ON rc.capacity_id=smt.capacity_type LEFT JOIN sup_rate_tactics rm ON rm.room_type=rc.capacity_id and smt.room_cate=rt.sup_hotel_room_type_id
					group BY `smt`.`sup_rate_tactics_id`";
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->result();
		} else {
			return '';	
		}
	}
	function get_priceManager($price_id)
	{
		$select ="SELECT MAX(smt.date) as mdate , MIN(smt.date)as mindate ,sh.*,cm.*,st.*,sm.*,rt.*,smt.* from sup_hotels sh LEFT JOIN country_markup cm ON cm.country_id=sh.country LEFT JOIN star st ON st.s_no=sh.star LEFT JOIN star_markup sm ON st.star=sm.star_name LEFT JOIN sup_hotel_room_type rt ON rt.hotel_id=sh.sup_hotel_id LEFT JOIN sup_apart_maintain_month smt ON smt.hotel_id=sh.sup_hotel_id and smt.room_cate=rt.sup_hotel_room_type_id
					where smt.sup_rate_tactics_id='".$price_id."' group BY `smt`.`room_cate`";
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->row();
		} else {
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
		$select = "SELECT a.*,b.* FROM sup_rate_tactics a join sup_rate_cancel_policy b ON a.sup_rate_tactics_id=b.rate_tactics_id where sup_rate_tactics_id = '$tacktics_id'";
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->row();
		} else {
			return false;	
		}
	}
	function get_rate_tactics_details1($tacktics_id)
	{		
		//echo $select = "SELECT a.*,b.*,c.*,MAX(smt.date) as Maxdate,MIN(smt.date) as Mindate FROM sup_rate_tactics a join sup_rate_cancel_policy b ON a.sup_rate_tactics_id=b.rate_tactics_id join sup_hotel_room_type c ON c.sup_hotel_room_type_id=a.category_type join sup_apart_maintain_month smt ON smt.sup_rate_tactics_id=b.rate_tactics_id  where a.sup_rate_tactics_id = '$tacktics_id' GROUP BY smt.room_cate";
		 $select = "SELECT a.*,b.*,c.*,d.*,MAX(smt.date) as Maxdate,MIN(smt.date) as Mindate FROM sup_rate_tactics a join sup_rate_cancel_policy b ON a.sup_rate_tactics_id=b.rate_tactics_id join sup_hotel_room_type c ON c.sup_hotel_room_type_id=a.category_type join sup_apart_maintain_month smt ON smt.sup_rate_tactics_id=b.rate_tactics_id join sup_hotel_capacity d ON d.capacity_id=smt.capacity_type where a.sup_rate_tactics_id = '$tacktics_id' GROUP BY smt.room_cate";
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
									`sup_id` ,`sup_rate_tactics_id` ,`hotel_id` ,`room_cate`,`capacity_type`,`date` ,`week_day` ,`day` ,`month` ,`year` ,`rate` ,`rack_price`,`sell_price`,`extra_bed_price` ,`available_rooms` ,`capacity` ,`adult` ,`child` ,`child_charge` ,`infant` ,`status`)
									VALUES ( 'admin', '".$tacktics_id."', '".$hotel_id."','".$room_cate."','".$room_type."','".$date."', '".$weekday[$i]."', '".$day1."', '".$mnth."', '".$year."', '".$price[$i]."', '".$rack_price[$i]."', '".$sell_price[$i]."', '".$extra_bed_price[$i]."','".$avail[$i]."', '', '".$adults[$i]."', '".$childs[$i]."', '".$avail_child_price[$i]."', '".$avail_infant[$i]."', '1')";
									$query=$this->db->query($qry);
								}else{
									$upd="UPDATE sup_apart_maintain_month SET sup_rate_tactics_id='".$tacktics_id."',week_day='".$weekday[$i]."',day='".$day1."',month='".$mnth."',year='".$year."',rate='".$price[$i]."',rack_price='".$rack_price[$i]."',sell_price='".$sell_price[$i]."',extra_bed_price='".$extra_bed_price[$i]."',available_rooms='".$avail[$i]."',adult='".$aadult[$i]."',child='".$achild[$i]."',child_charge='".$child_price[$i]."',infant='".$infant[$i]."' WHERE date='".$date."' AND hotel_id='".$hotel_id."' AND room_cate='".$room_cate."' AND capacity_type='".$room_type."'";
									//echo $upd;exit;die;
									$this->db->query($upd);
									//~ echo $this->db->last_query();
									//~ die;
								}
							}
						 }
						 
						 $select = "SELECT MAX(smt.date) as Maxdate,MIN(smt.date) as Mindate FROM sup_rate_tactics a join sup_rate_cancel_policy b ON a.sup_rate_tactics_id=b.rate_tactics_id join sup_hotel_room_type c ON c.sup_hotel_room_type_id=a.category_type join sup_apart_maintain_month smt ON smt.sup_rate_tactics_id=b.rate_tactics_id  where a.sup_rate_tactics_id = '$tacktics_id' GROUP BY smt.room_cate";
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
	//admin add amenity
	public function add_amenity($amenity_name)
	{
		$data =array(
					'amenity_name' 	=> $amenity_name['amenity'],
					'amenity_nameA' => $amenity_name['amenityA'],
					'status' => '1'
			   );
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
	function editamenity_ad($amenity_id,$amenity_name,$amenity_nameA)
	{
		$data = array(
					'amenity_name' => $amenity_name,
					'amenity_nameA' => $amenity_nameA
				);
		$where = "amenity_list_id = $amenity_id";
		$this->db->update('global_amenity_list',$data,$where);
	}
	function B2C_bookingReports()
	{
		//$select = "SELECT h.*, t.*, c.* FROM users c left join transaction_details t on c.user_id = t.customer_contact_details_id left join  hotel_booking_info h on c.user_id = h.customer_contact_details_id where t.customer_contact_details_id IS NOT NULL";
		$select = "SELECT b.status as STA,b.*,h.* FROM booking_info b left join sup_hotels h on b.hotel_id=h.sup_hotel_id ORDER BY sno";
	
		$query = $this->db->query($select);
		if ( $query->num_rows > 0 )
		{ 
			return $query->result();
		}else{
			return '';
		}
	}
	function callcenter_bookingReports()
	{
		//$select = "SELECT h.*, t.*, c.* FROM users c left join transaction_details t on c.user_id = t.customer_contact_details_id left join  hotel_booking_info h on c.user_id = h.customer_contact_details_id where t.customer_contact_details_id IS NOT NULL";
		$select = "SELECT b.status as STA,b.*,h.* FROM booking_info b left join sup_hotels h on b.hotel_id=h.sup_hotel_id where user_type=1 ORDER BY sno";
		$query = $this->db->query($select);
		if ( $query->num_rows > 0 )
		{ 
			return $query->result();
		}else{
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
	function hotel_locations()
	{
		$this->db->select('*')->from('hotel_locations')->where('status',1);
		$query=$this->db->get();
		if($query->num_rows()>0) {
			return $query->result();
		}else{
			return false;
		}	
	}
	function get_cancelVocher($hotel_id,$sup_rate_id,$booking_id)
	{
		$this->db->select('*')
				  ->from('booking_info')
				  ->where('booking_id',$booking_id)
				  ->where('hotel_id',$hotel_id)
				  ->where('sup_ratetacktics_id',$sup_rate_id);
		 $query=$this->db->get();
		 $book_name='';
		 if($query->num_rows()>0){
			$book_details=$query->row();
			 $book_name=$book_details->booking_name;
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
			$update_price=0;
			if($today_date < $startDatess){
				//update amount
				if(substr($book_name, 0, 4)=='FOCC'){
					$sql="SELECT * FROM callcenter_credit WHERE callcenter_id='$book_name'";
					$query2=$this->db->query($sql);
					$total=$query2->row()->credit+$book_details->customer_finalcost;
					$data = array('credit' => $total);
					$where = "callcenter_id = '".$book_name."'";
					$this->db->update('callcenter_credit', $data, $where);
					$update_price=$book_details->customer_finalcost-$book_details->callcenter_markup-$book_details->markup;
				}else{
					$update_price=$book_details->customer_finalcost-$book_details->gateway-$book_details->markup;
				}
			}
			$data = array('customer_canceltotal' => $update_price,'status'=>2,'cancel_bookdate'=>date("Y-m-d h:i:s"));
			$where = "booking_id = '".$booking_id."' && hotel_id= '".$hotel_id."'";
			$this->db->update('booking_info', $data, $where);
		 }else{
			return '';
		 }
	}
	function hotel_markets()
	{
		$this->db->select('*')->from('sup_hotel_markets');
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return '';
		}
	}
	function inactive_market($market_id)
	{
		$data = array('status' => 0);
		$where = "market_id = '".$market_id."'";
		$this->db->update('sup_hotel_markets', $data, $where);
	}
	function active_market($market_id)
	{
		$data = array('status' => 1);
		$where = "market_id = '".$market_id."'";
		$this->db->update('sup_hotel_markets', $data, $where);
	}
	function edit_market($market_id)
	{
		$this->db->select('*')->from('sup_hotel_markets')->where('market_id',$market_id);
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return '';
		}
	}
	function edit_market_ed($details,$market_id)
	{
		$data = array(
					'market_name' => $details['hotel_market'],
					'marketname_arab' => $details['hotel_marketA']
			    );
		$where = "market_id = '".$market_id."'";
		$this->db->update('sup_hotel_markets', $data, $where);
	}
	function delete_market($market_id)
	{
		$where = "market_id = $market_id";
		$this->db->delete('sup_hotel_markets', $where);
	}
	function get_market($market_id)
	{
		$this->db->select('*')->from('sup_hotel_markets')->where('market_id',$market_id);
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->row()->market_name;
		}else{
			return '';
		}
	}
	
	function hotel_regions()
	{
		$this->db->select('*')->from('country_region');
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return '';
		}
	}
	function inactive_region($region_id)
	{
		$data = array('status' => 0);
		$where = "r_no = '".$region_id."'";
		$this->db->update('country_region', $data, $where);
	}
	function active_region($region_id)
	{
		$data = array('status' => 1);
		$where = "r_no = '".$region_id."'";
		$this->db->update('country_region', $data, $where);
	}
	function edit_region($region_id)
	{
		$this->db->select('*')->from('country_region')->where('r_no',$region_id);
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return '';
		}
	}
	function edit_region_ed($details,$region_id)
	{
		$data = array(
					'region_name' => $details['hotel_region'],
					'region_nameA' => $details['hotel_regionA']
			    );
		$where = "r_no = '".$region_id."'";
		$this->db->update('country_region', $data, $where);
	}
	function delete_region($region_id)
	{
		$where = "r_no = $region_id";
		$this->db->delete('country_region', $where);
	}
	
	function hotel_payment()
	{
		$this->db->select('*')->from('payment_type');
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return '';
		}
	}
	function inactive_paymentType($type_id)
	{
		$data = array('status' => 0);
		$where = "p_no = '".$type_id."'";
		$this->db->update('payment_type', $data, $where);
	}
	function active_paymentType($type_id)
	{
		$data = array('status' => 1);
		$where = "p_no = '".$type_id."'";
		$this->db->update('payment_type', $data, $where);
	}
	function edit_paymentType($type_id)
	{
		$this->db->select('*')->from('payment_type')->where('p_no',$type_id);
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return '';
		}
	}
	function get_payType($type_id)
	{
		$this->db->select('*')->from('payment_type')->where('p_no',$type_id);
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->row()->payment_type;
		}else{
			return '';
		}
	}
	function edit_payment_ed($details,$type_id)
	{
		$data = array(
					'payment_type' => $details['hotel_paytype'],
					'payment_typeA' => $details['hotel_paytypeA']
			    );
		$where = "p_no = '".$type_id."'";
		$this->db->update('payment_type', $data, $where);
	}
	function delete_paymentType($type_id)
	{
		$where = "p_no = $type_id";
		$this->db->delete('payment_type', $where);
	}
	
	
	function paymentCards_list()
	{
		$this->db->select('*')->from('payment_card');
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return '';
		}
	}
	function inactive_cardType($type_id)
	{
		$data = array('status' => 0);
		$where = "c_no = '".$type_id."'";
		$this->db->update('payment_card', $data, $where);
	}
	function active_cardType($type_id)
	{
		$data = array('status' => 1);
		$where = "c_no = '".$type_id."'";
		$this->db->update('payment_card', $data, $where);
	}
	function edit_cardType($type_id)
	{
		$this->db->select('*')->from('payment_card')->where('c_no',$type_id);
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return '';
		}
	}
	function get_payCard($type_id)
	{
		$this->db->select('*')->from('payment_card')->where('c_no',$type_id);
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->row()->card_name;
		}else{
			return '';
		}
	}
	
	function edit_cardType_ed($details,$type_id)
	{
		$data = array(
					'card_name' => $details['hotel_paytype'],
					'card_nameA' => $details['hotel_paytypeA']
			    );
		$where = "c_no = '".$type_id."'";
		$this->db->update('payment_card', $data, $where);
	}
	function delete_cardType($type_id)
	{
		$where = "c_no = $type_id";
		$this->db->delete('payment_card', $where);
	}
	function bussines_list()
	{
		$this->db->select('*')->from('sup_hotel_others');
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return '';
		}
	}
	function inactive_fun($type_id)
	{
		$data = array('status' => 0);
		$where = "others_id = '".$type_id."'";
		$this->db->update('sup_hotel_others', $data, $where);
	}
	function active_fun($type_id)
	{
		$data = array('status' => 1);
		$where = "others_id = '".$type_id."'";
		$this->db->update('sup_hotel_others', $data, $where);
	}
	function edit_fun($type_id)
	{
		$this->db->select('*')->from('sup_hotel_others')->where('others_id',$type_id);
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return '';
		}
	}
	function edit_fun_ed($details,$type_id)
	{
		$data = array(
					'others_name' => $details['hotel_paytype'],
					'others_nameA' => $details['hotel_paytypeA']
			    );
		$where = "others_id = '".$type_id."'";
		$this->db->update('sup_hotel_others', $data, $where);
	}
	function delete_fun($type_id)
	{
		$where = "others_id = $type_id";
		$this->db->delete('sup_hotel_others', $where);
	}
	function location_list()
	{
		$this->db->select('*')->from('hotel_locations');
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return '';
		}
	}
	function inactive_loc($type_id)
	{
		$data = array('status' => 0);
		$where = "loc_sno = '".$type_id."'";
		$this->db->update('hotel_locations', $data, $where);
	}
	function active_loc($type_id)
	{
		$data = array('status' => 1);
		$where = "loc_sno = '".$type_id."'";
		$this->db->update('hotel_locations', $data, $where);
	}
	function edit_loc($type_id)
	{
		$this->db->select('*')->from('hotel_locations')->where('loc_sno',$type_id);
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return '';
		}
	}
	function edit_loc_ed($details,$type_id)
	{
		$data = array(
					'location_name' => $details['hotel_paytype'],
					'location_nameA' => $details['hotel_paytypeA']
			    );
		$where = "loc_sno = '".$type_id."'";
		$this->db->update('hotel_locations', $data, $where);
	}
	function delete_loc($type_id)
	{
		$where = "loc_sno = $type_id";
		$this->db->delete('hotel_locations', $where);
	}
	
	function edit_country($country_id)
	{
		$this->db->select('*')->from('country')->where('country_id',$country_id);
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return '';
		}
	}
	function edit_country_ed($details,$country_id)
	{
		$data = array(
					'name' => $details['hotel_country'],
					'nameA' => $details['hotel_countryA']
			    );
		$where = "country_id = '".$country_id."'";
		$this->db->update('country', $data, $where);
	}
	function delete_country($country_id)
	{
		$where = "country_id = $country_id";
		$this->db->delete('country', $where);
	}
	
	function city_list()
	{
		$this->db->select('*')->from('city_town');
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return '';
		}
	}	
	function inactive_city($city_id)
	{
		$data = array('status' => 0);
		$where = "c_no = '".$city_id."'";
		$this->db->update('city_town', $data, $where);
	}
	function active_city($city_id)
	{
		$data = array('status' => 1);
		$where = "c_no = '".$city_id."'";
		$this->db->update('city_town', $data, $where);
	}
	function edit_city($city_id)
	{
		$this->db->select('*')->from('city_town')->where('c_no',$city_id);
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return '';
		}
	}
	function edit_city_ed($details,$city_id)
	{
		$data = array(
					'city_name' => $details['hotel_city'],
					'city_nameA' => $details['hotel_cityA']
			    );
		$where = "c_no = '".$city_id."'";
		$this->db->update('city_town', $data, $where);
	}
	function delete_city($city_id)
	{
		$where = "c_no = $city_id";
		$this->db->delete('city_town', $where);
	}
	
	function area_list()
	{
		$this->db->select('*')->from('area');
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return '';
		}
	}
	function inactive_area($area_id)
	{
		$data = array('status' => 0);
		$where = "a_no = '".$area_id."'";
		$this->db->update('area', $data, $where);
	}
	function active_area($area_id)
	{
		$data = array('status' => 1);
		$where = "a_no = '".$area_id."'";
		$this->db->update('area', $data, $where);
	}
	function edit_area($area_id)
	{
		$this->db->select('*')->from('area')->where('a_no',$area_id);
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return '';
		}
	}
	function edit_area_ed($details,$area_id)
	{
		$data = array(
					'area_name' => $details['hotel_area'],
					'area_nameA' => $details['hotel_areaA']
			    );
		$where = "a_no = '".$area_id."'";
		$this->db->update('area', $data, $where);
	}
	function delete_area($area_id)
	{
		$where = "a_no = $area_id";
		$this->db->delete('area', $where);
	}
	
	function hotelType_list()
	{
		$this->db->select('*')->from('hotel_type');
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return '';
		}
	}
	function inactive_type($type_id)
	{
		$data = array('status' => 0);
		$where = "h_no = '".$type_id."'";
		$this->db->update('hotel_type', $data, $where);
	}
	function active_type($type_id)
	{
		$data = array('status' => 1);
		$where = "h_no = '".$type_id."'";
		$this->db->update('hotel_type', $data, $where);
	}
	function edit_type($type_id)
	{
		$this->db->select('*')->from('hotel_type')->where('h_no',$type_id);
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return '';
		}
	}
	function edit_type_ed($details,$type_id)
	{
		$data = array(
					'hotel_type' => $details['hotel_type'],
					'hotel_typeA' => $details['hotel_typeA']
			    );
		$where = "h_no = '".$type_id."'";
		$this->db->update('hotel_type', $data, $where);
	}
	function delete_type($type_id)
	{
		$where = "h_no = $type_id";
		$this->db->delete('hotel_type', $where);
	}
	
	
	
	
	
	public function check_resion($region){
		$query = $this->db->get_where('country_region',array('region_name'=>$region));
		if($query->num_rows()>0){
			return false;
		}else{
			return true;
		}
	}
	public function add_region($data){
		$arr = array('country_id'=>$data['country_id'],'region_name'=>$data['resign_name'],'region_nameA'=>$data['resign_nameA']);
		$this->db->insert('country_region',$arr);
	}
	
	public function region_list($CID){
		$query = $this->db->get_where('country_region',array('country_id'=>$CID));
		if($this->RowsCount($query)>0){
			return $query->result();
		}else{
			return '';
		}
	}
	
	public function check_cityTown($city_name){
		$query = $this->db->get_where('city_town',array('city_name'=>$city_name['add_cityTown_name']));
		if($query->num_rows()>0){
			return false;
		}else{
			return true;
		}
	}
	public function cityTownlist($CID){
		$query = $this->db->get_where('city_town',array('country_id' => $CID['country_id'],'region_id' => $CID['resign_id']));
		if($this->RowsCount($query)>0){
			return $query->result();
		}else{
			return '';
		}
	}
	public function add_cityTown($data){
		$arr = array('country_id'=>$data['country_id'],'region_id'=>$data['resign_id'],'city_name'=>$data['cityTown_name'],'city_nameA'=>$data['cityTown_nameA']);
		$this->db->insert('city_town',$arr);
	}
	public function check_area($city_name){
		$query = $this->db->get_where('area',array('area_name'=>$city_name['area_name']));
		if($query->num_rows()>0){
			return false;
		}else{
			return true;
		}
	}
	public function add_Area($data){
		$arr = array('country_id'=>$data['country_id'],'region_id'=>$data['resign_id'],'city_id'=>$data['city_id'],'area_name'=>$data['area_name'],'area_nameA'=>$data['area_nameA']);
		$this->db->insert('area',$arr);
	}
	public function areaList($CID){
		$query = $this->db->get_where('area',array('country_id' => $CID['country_id'],'region_id' => $CID['resign_id'],'city_id' =>$CID['city_id']));
		if($this->RowsCount($query)>0){
			return $query->result();
		}else{
			return '';
		}
	}
	public function add_Star($num){
		$arr = array('star'=>$num);
		$this->db->insert('star',$arr);
	}
	public function check_hotelStar($star){
		$query = $this->db->get_where('star',array('star'=>$star));
		if($query->num_rows()>0){
			return false;
		}else{
			return true;
		}
	}
	public function check_hotelType($type_name){
		$query = $this->db->get_where('hotel_type',array('hotel_type'=>$type_name));
		if($query->num_rows()>0){
			return false;
		}else{
			return true;
		}
	}
	public function add_hotelType($data){
		$arr = array('hotel_type'=>$data['type_name'],'hotel_typeA'=>$data['type_nameA']);
		$this->db->insert('hotel_type',$arr);
	}
	
	public function getTypeList(){
		$query = $this->db->get_where('hotel_type',array('status'=>1));
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return '';
		}
	}
	public function getStarList(){
		$query = $this->db->select('*')->from('star');
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return '';
		}
	}
	public function check_location($location_name){
		$query = $this->db->get_where('hotel_locations',array('location_name'=>$location_name));
		if($query->num_rows()>0){
			return false;
		}else{
			return true;
		}
	}
	public function add_location($data){
		$arr = array('location_name'=>$data['location'],'location_nameA'=>$data['locationA'],'status'=>1);
		$this->db->insert('hotel_locations',$arr);
	}
	public function check_bussines($busines_name){
		$query = $this->db->get_where('sup_hotel_others',array('others_name'=>$busines_name));
		if($query->num_rows()>0){
			return false;
		}else{
			return true;
		}
	}
	public function add_Business($data){
		$arr = array('others_name'=>$data['bussines'],'others_nameA'=>$data['bussinesA'],'status'=>1);
		$this->db->insert('sup_hotel_others',$arr);
	}
	public function check_PaymentType($payment_type){
		$query = $this->db->get_where('payment_type',array('payment_type'=>$payment_type));
		if($query->num_rows()>0){
			return false;
		}else{
			return true;
		}
	}
	public function add_payType($data){
		$arr = array('payment_type'=>$data['Type'],'payment_typeA'=>$data['TypeA']);
		$this->db->insert('payment_type',$arr);
	}
	public function check_cards($cards){
		$query = $this->db->get_where('payment_type',array('payment_type'=>$cards));
		if($query->num_rows()>0){
			return false;
		}else{
			return true;
		}
	}
	public function add_cards($data){
		$arr = array('card_name'=>$data['cards'],'card_nameA'=>$data['cardsA']);
		$this->db->insert('payment_card',$arr);
	}
	public function get_paymentType(){
		$query = $this->db->get_where('payment_type',array('status'=>1));
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return'';
		}
	}
	public function get_cardType(){
		$query = $this->db->get_where('payment_card',array('status'=>1));
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return'';
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
	
	public function add_hotel_detailsl($data,$image,$main_image){
			$arr = array(
					'hotel_loc'=>serialize($data['hotel_loc']),
					'hotel_amenity'=>serialize($data['hotel_amen']),
					'hotel_busines'=>serialize($data['hotel_busines']),
					'hotel_desc'=>$data['hotel_desc'],
					'hotel_descA'=>$data['hotel_descA'],
					'hotel_policy'=>$data['hotel_policy'],
					'hotel_policyA'=>$data['hotel_policyA'],
					'payment_method'=>serialize($data['payment_method']),
					'accepted_payment'=>serialize($data['accepted_payment']),
					'latitude'=>$data['latitude'],
					'longitude'=>$data['longitude'],
					'main_image'=>$main_image,
					'image'=>$image
				 );
		$where = "sup_hotel_id = '".$data['hotel_type']."'";
		$this->db->update('sup_hotels', $arr, $where);
	}
	public function edit_hotelDetails_ad($data,$hotel_id,$image,$main_image){
		if($image!=''){
			$arr = array(
					'hotel_loc'=>serialize($data['hotel_loc']),
					'hotel_amenity'=>serialize($data['hotel_amen']),
					'hotel_busines'=>serialize($data['hotel_busines']),
					'hotel_desc'=>$data['hotel_desc'],
					'hotel_descA'=>$data['hotel_descA'],
					'hotel_policy'=>$data['hotel_policy'],
					'hotel_policyA'=>$data['hotel_policyA'],
					'payment_method'=>serialize($data['payment_method']),
					'accepted_payment'=>serialize($data['accepted_payment']),
					'latitude'=>$data['latitude'],
					'longitude'=>$data['longitude'],
					'main_image'=>$main_image,
					'image'=>$image
				 );
			 }else{
				$arr = array(
					'hotel_loc'=>serialize($data['hotel_loc']),
					'hotel_amenity'=>serialize($data['hotel_amen']),
					'hotel_busines'=>serialize($data['hotel_busines']),
					'hotel_desc'=>$data['hotel_desc'],
					'hotel_descA'=>$data['hotel_descA'],
					'hotel_policy'=>$data['hotel_policy'],
					'hotel_policyA'=>$data['hotel_policyA'],
					'payment_method'=>serialize($data['payment_method']),
					'accepted_payment'=>serialize($data['accepted_payment']),
					'latitude'=>$data['latitude'],
					'longitude'=>$data['longitude'],
					'main_image'=>$main_image
				);
			 }
		$where = "sup_hotel_id = '".$hotel_id."'";
		$this->db->update('sup_hotels', $arr, $where);
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
	public function get_Type($type_id)
	{
		$query = $this->db->get_where('hotel_type',array('h_no'=>$type_id));
		if($query->num_rows()>0){
			return $query->row()->hotel_type;
		}else{
			return'';
		}
	}
	public function get_Region($region_id)
	{
		$query = $this->db->get_where('country_region',array('r_no'=>$region_id));
		if($query->num_rows()>0){
			return $query->row()->region_name;
		}else{
			return'';
		}
	}
	public function get_City($city_id)
	{
		$query = $this->db->get_where('city_town',array('c_no'=>$city_id));
		if($query->num_rows()>0){
			return $query->row()->city_name;
		}else{
			return'';
		}
	}
	public function get_Area($area_id)
	{
		$query = $this->db->get_where('area',array('a_no'=>$area_id));
		if($query->num_rows()>0){
			return $query->row()->area_name;
		}else{
			return'';
		}
	}
	public function get_Loc($location_id){
		$query = $this->db->get_where('hotel_locations',array('loc_sno'=>$location_id));
		if($query->num_rows()>0){
			return $query->row()->location_name;
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
	public function delete_img($arr,$hotel_id)
	{
		$where = "sup_hotel_id = '".$hotel_id."'";
		$data = array('image'=>serialize($arr));
		$this->db->update('sup_hotels', $data, $where);
	}
	public function boardtype_manager(){
		$this->db->select('*')->from('Board_Type');
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return '';
		}
		
	}
	public function inactive_boardtype($type_id)
	{
		$data = array('status' =>0);
		$where = "b_no = '".$type_id."'";
		$this->db->update('Board_Type', $data, $where);
	}
	public function active_boardtype($type_id)
	{
		$data = array('status' =>1);
		$where = "b_no = '".$type_id."'";
		$this->db->update('Board_Type', $data, $where);
	}
	public function check_Boardtype($board_name){
		$query = $this->db->get_where('Board_Type',array('board_name'=>$board_name));
		if($query->num_rows()>0){
			return false;
		}else{
			return true;
		}
	}
	public function boardtype_ad($details)
	{
		$data = array(
				'board_name'  => $details['boardtype'],
				'board_nameA' => $details['boardtypeA']
				);
		$this->db->insert('Board_Type', $data);
	}
	public function edit_boardtype($type_id){
		$query = $this->db->get_where('Board_Type',array('b_no'=>$type_id));
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return '';
		}
	}
	public function boardtype_edit($details,$type_id)
	{
		$data = array(
				'board_name'  => $details['boardtype'],
				'board_nameA' => $details['boardtypeA']
				);
		$where = "b_no = '".$type_id."'";
		$this->db->update('Board_Type', $data, $where);		
	}
	public function delete_boardtype($type_id)
	{
		$where = "b_no = '".$type_id."'";
		$this->db->delete('Board_Type', $where);
	}
	
	//----------------closing class------------------//
}  
