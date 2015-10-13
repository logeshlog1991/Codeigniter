<?php
class Supplier_Model extends CI_Model {
	
	public function __construct()
    {
      parent::__construct();
    }
	function getSuppliers($status='')
	{		
		$where = '';
		if ($status == 'active') {
			$where = 'and active = 1';	
		} elseif ($status == 'inactive') { 
			$where = 'and active = 0';	
		}
		$select = "SELECT * FROM supplier $where";
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->result();
		} else {
			return false;	
		}
	}
	function Inactive_supplier($sup_id)
	{
		$data = array('active' => 0);
		$this->db->where('agent_id',$sup_id);
		$this->db->update('supplier', $data);
	}
	function Active_supplier($sup_id)
	{
		$data = array('active' => 1 );
		$this->db->where('agent_id',$sup_id);
		$this->db->update('supplier', $data);
	}
	function inactive_suppliers()
	{
		$select = "SELECT * FROM supplier where active=0";
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->result();
		} else {
			return false;	
		}
	}
	function active_suppliers()
	{
		$select = "SELECT * FROM supplier where active=1";
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->result();
		} else {
			return false;	
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
    function add_supplier($sup_details)
    {	$data = array(
			'hotel_id'=> $sup_details['hotel'],
			'email_id' => $sup_details['email'],
			'password' => $sup_details['password'],
			'name' => $sup_details['supplier_name'],
			'company_name' => $sup_details['company_name'],
			'address' => $sup_details['adddress'],
			'country' => $sup_details['country'],
			'city' => $sup_details['city'],
			'postal_code' => $sup_details['postal'],
			'office_phone' => $sup_details['office_phone_number'],
			'mobile' => $sup_details['mobile_number'],
			'currency_type' => $sup_details['paymnet_currency'],
			'active' => 1
			);
		$this->db->insert('supplier', $data);
		$id = $this->db->insert_id();
		
		$data1 = array('supplier_id' => 'FOS'.$id );
		$this->db->where('agent_id',$id);
		$this->db->update('supplier', $data1);
		
		if(!empty($id)){		
			return true;
		} else {
			return false;
		}
	}
	function edit_supplier($sup_id)
	{
		$select = "SELECT * FROM supplier where agent_id='".$sup_id."'";
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->row();
		} else {
			return false;	
		}
	}
	function edit_supplier_ad($sup_id,$sup_details)
	{
		$data = array(
			'hotel_id'=> $sup_details['hotel'],
			'email_id' => $sup_details['email'],
			'password' => $sup_details['password'],
			'name' => $sup_details['supplier_name'],
			'company_name' => $sup_details['company_name'],
			'address' => $sup_details['adddress'],
			'country' => $sup_details['country'],
			'city' => $sup_details['city'],
			'postal_code' => $sup_details['postal'],
			'office_phone' => $sup_details['office_phone_number'],
			'mobile' => $sup_details['mobile_number'],
			'currency_type' => $sup_details['paymnet_currency'],
			'active' => 1
			);
		$this->db->where('agent_id',$sup_id);
		$this->db->update('supplier', $data);
	}
	function Delete_supplier($sup_id)
    {
		$delete="DELETE FROM supplier where agent_id='".$sup_id."'";
		$query= $this->db->query($delete);
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
	function check_Supplier($email)
	{
		$select = "SELECT * FROM supplier where email_id='".$email."'";
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return 1;
		} else {
			return '';	
		}
	}
	function check_Supplier_ed($email,$main_email)
	{
		$select = "SELECT * FROM supplier where email_id='".$email."'";
		$query=$this->db->query($select);
		
		if ($query->num_rows() > 0)
		{
			if($main_email!=$query->row()->email_id){
				return 1;
			}else{
				return '';	
			}
		} else {
			return '';	
		}
	}
  
}  
