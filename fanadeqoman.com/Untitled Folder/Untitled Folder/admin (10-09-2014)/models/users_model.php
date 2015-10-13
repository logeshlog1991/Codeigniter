<?php
class Users_Model extends CI_Model {
	
	public function __construct()
    {
      parent::__construct();
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
	function getUsers()
	{		
		$select = "SELECT * FROM users";
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->result();
		} else {
			return '';	
		}
	}
	function Inactive_users($user_id)
	{
		$data = array('status' => 0);
		$this->db->where('prim_uid',$user_id);
		$this->db->update('users', $data);
	}
	function Active_users($user_id)
	{
		$data = array('status' => 1);
		$this->db->where('prim_uid',$user_id);
		$this->db->update('users', $data);
	}
	function delete_users($user_id)
    {
		$delete="DELETE FROM users where prim_uid='".$user_id."'";
		$query= $this->db->query($delete);
	}
	function add_users($user_details,$img_name)
    {	
		$data = array(
			'first_name' => $user_details['supplier_name'],
			'last_name' => $user_details['company_name'],
			'email' => $user_details['email'],
			'password' => $user_details['password'],
			'contact_number' => $user_details['mobile_number'],
			'address' => $user_details['adddress'],
			'city' => $user_details['city'],
			'state' => $user_details['state'],
			'country' => $user_details['country'],
			'postal_code' => $user_details['postal'],
			'image' => $img_name,
			'STATUS' => 1
			);
		$this->db->insert('users', $data);
		$id = $this->db->insert_id();
		
		$data1 = array('user_id' => 'FOU'.$id );
		$this->db->where('prim_uid',$id);
		$this->db->update('users', $data1);
		
		if(!empty($id)){		
			return true;
		} else {
			return false;
		}
	}
	function edit_users($user_id)
	{
		$select = "SELECT * FROM users where prim_uid='".$user_id."'";
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->row();
		} else {
			return false;	
		}
	}
	function edit_users_ad($sup_id,$user_details,$img_name)
	{
		$data = array(
			'first_name' => $user_details['supplier_name'],
			'last_name' => $user_details['company_name'],
			'email' => $user_details['email'],
			'password' => $user_details['password'],
			'contact_number' => $user_details['mobile_number'],
			'address' => $user_details['adddress'],
			'city' => $user_details['city'],
			'state' => $user_details['state'],
			'country' => $user_details['country'],
			'postal_code' => $user_details['postal'],
			'image' => $img_name,
			'status' => 1
			);
		$this->db->where('prim_uid',$sup_id);
		$this->db->update('users', $data);
	}	
  
}  
