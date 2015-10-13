<?php
class Admin_model extends CI_Model {
	
	public function __construct()
    {
      parent::__construct();
    }
		
   public function verify_user($email, $password)
   {
   
		$this->db->select('agent_id,supplier_id,hotel_id, name, email_id')
			->from('supplier')
			->where('email_id', $email)
            ->where('password', $password)
			->where('agent_type', 1)
			->where('active', 1)
			->limit(1);
		$query = $this->db->get();
	  if ( $query->num_rows > 0 ) {
         // person has account with us
         return $query->row();
      }
      return false;
   }

   public function get_profilepic()
   {
		$this->db->select('hotel_logo,name');
		$this->db->from('supplier');
		$this->db->where('supplier_id',$this->session->userdata('supplier_id'));
		$query = $this->db->get();
		$this->db->last_query(); 
		if($query->num_rows>0){
			return $query->row();
		}else{
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
   
     public function get_admin_profile($user_id)
   {
	   $this->db->select('*')
				->from('supplier')
				->where('supplier_id',$user_id);
	   $query = $this->db->get();
	   if ( $query->num_rows > 0 ) {
			return $query->row();
       }
      return false;
   }
   
   //edit supplier account
   function updateSupplierInfo($data){ 
	 $user_id = $this->session->userdata('supplier_id');
	$update_data=array('name' => $data['name'], 'email_id' => $data['Email'], 'mobile' => $data['Contact_No'], 'address' => $data['Address'] ,'postal_code'=>$data['postal'] );
	$this->db->where('supplier_id',$user_id );
	$this->db->where('active', 1);
	$this->db->update('supplier',$update_data);

}

   //supplier module
	function getSupplierInfo($user_id)
	{	
		$select = "SELECT * FROM supplier WHERE supplier_id ='$user_id' and active=1 limit 1"; 
		$query=$this->db->query($select);
	
		if ($query->num_rows() > 0)
		{
			return $query->row();
		}
	}
	
		//supplier add logo his hotel
	function supplerHotelLogo($image,$supplier_id){
		if($image!=''){ $image;
			$sqldata = "update supplier set hotel_logo='".$image."' where supplier_id ='".$supplier_id."' and active=1";
			$query = $this->db->query($sqldata);
		}
	}
	
  function change_password($admin_details,$user_id)
   {
		$data = array('password' => $admin_details['npass']);
		$this->db->where('supplier_id',$user_id);
		$this->db->update('supplier', $data);
   } 
   
    public function check_pass($admin_details,$user_id)
   {
		$this->db->select('*');
		$this->db->from('supplier');
		$this->db->where('supplier_id',$user_id);
		$this->db->where('password',$admin_details['currentpass']);
		$query = $this->db->get();
		if($query->num_rows>0){
			return true;
		}else{
			return false;
		}
   }
   
   function country_markup_value($country)
	{
		$this->db->select('*');
		$this->db->from('country_markup');
		$this->db->where('country_id',$country['country']);
		$query=$this->db->get();
		if($query->num_rows()=='')
		{
			return '';
		}else{
			$a=$query->row();
			return $a->country_markup;
		}
	}
	
		function CCagents_markup_value($country)
	{
		$this->db->select('*');
		$this->db->from('callcenter_agents');
		$this->db->where('callcenter_agent_id',$country['country']);
		$query=$this->db->get();
		if($query->num_rows()=='')
		{
			return '';
		}else{
			$a=$query->row();
			return $a->callcenter_markup;
		}
	}
	
	function get_country($id) {
		
		$this->db->select('*')->from('country')->where('country_id',$id);
		$query=$this->db->get();
		if($query->num_rows > 0) {
			return $query->row();
		}
	}
//------------closing class----------// 
}  
