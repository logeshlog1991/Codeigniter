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
		$this->db->where('supplier_id',$sup_id);
		$this->db->update('supplier', $data);
		$this->db->update('supplierA', $data);
	}
	function Active_supplier($sup_id)
	{
		$data = array('active' => 1 );
		$this->db->where('supplier_id',$sup_id);
		$this->db->update('supplier', $data);
		$this->db->update('supplierA', $data);
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
		if($_SESSION['lang']=='english')
		{
			$sql="SELECT * FROM currency_converter";
		}else{
			$sql="SELECT * FROM currency_converterA";
		}
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
		if($_SESSION['lang']=='english')
		{
			$que="select * from  country";
		}else{
			$que="select * from  countryA";
		}
		$query= $this->db->query($que);
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
    }
    function add_supplier($sup_details)
    {	
		$id='';
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
			'register_date' =>date("Y-m-d H:i:s"),
			'active' => 1
			);
		$this->db->insert('supplier', $data);
		$id = $this->db->insert_id();
		
		$data1 = array('supplier_id' => 'FOS'.$id );
		$this->db->where('agent_id',$id);
		$this->db->update('supplier', $data1);
		
		$dataA = array(
			'hotel_id'=> $sup_details['hotel'],
			'supplier_id'=>'FOS'.$id,
			'email_id' => $sup_details['emailA'],
			'password' => $sup_details['passwordA'],
			'name' => $sup_details['supplier_nameA'],
			'company_name' => $sup_details['company_nameA'],
			'address' => $sup_details['adddressA'],
			'country' => $sup_details['country'],
			'city' => $sup_details['cityA'],
			'postal_code' => $sup_details['postal'],
			'office_phone' => $sup_details['office_phone_number'],
			'mobile' => $sup_details['mobile_number'],
			'currency_type' => $sup_details['paymnet_currency'],
			'register_date' =>date("Y-m-d H:i:s"),
			'active' => 1
			);
		$this->db->insert('supplierA', $dataA);
		if(!empty($id)){		
			return true;
		} else {
			return false;
		}
	}
	function edit_supplier($sup_id)
	{
		$select = "SELECT * FROM supplier where supplier_id='".$sup_id."'";
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->row();
		} else {
			return false;	
		}
	}
	function edit_supplierA($sup_id)
	{
		$select = "SELECT * FROM supplier where supplier_id='".$sup_id."'";
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
		$this->db->where('supplier_id',$sup_id);
		$this->db->update('supplier', $data);
		
		$dataA = array(
			'hotel_id'=> $sup_details['hotel'],
			'email_id' => $sup_details['emailA'],
			'password' => $sup_details['passwordA'],
			'name' => $sup_details['supplier_nameA'],
			'company_name' => $sup_details['company_nameA'],
			'address' => $sup_details['adddressA'],
			'country' => $sup_details['country'],
			'city' => $sup_details['cityA'],
			'postal_code' => $sup_details['postal'],
			'office_phone' => $sup_details['office_phone_number'],
			'mobile' => $sup_details['mobile_number'],
			'currency_type' => $sup_details['paymnet_currency'],
			'active' => 1
			);
		$this->db->where('supplier_id',$sup_id);
		$this->db->update('supplierA', $dataA);
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
		if($_SESSION['lang']=='english')
		{
			$query = $this->db->select('*')->from('sup_hotels')->get();
		}else{
			$query = $this->db->select('*')->from('sup_hotelsA')->get();
		}
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
    function supplier_details($hotel_id)
    {
		$select = "SELECT * FROM sup_hotels where sup_hotel_id='".$hotel_id."'";
		$query=$this->db->query($select);
		
		if ($query->num_rows() > 0)
		{
			return $query->row();
		} else {
			return '';	
		}
	}
	 function supplier_detailsA($hotel_id)
    {
		$select = "SELECT * FROM sup_hotelsA where sup_hotel_id='".$hotel_id."'";
		$query=$this->db->query($select);
		
		if ($query->num_rows() > 0)
		{
			return $query->row();
		} else {
			return '';	
		}
	}
	 //~ function editsupplier_details($hotel)
    //~ {
		//~ $select = "SELECT * FROM supplier where hotel_id='".$hotel."'";
		//~ $query=$this->db->query($select);
		//~ 
		//~ if ($query->num_rows() > 0)
		//~ {
			//~ return $query->row();
		//~ } else {
			//~ return '';	
		//~ }
	//~ }
	 //~ function editsupplier_detailsA($hotel)
    //~ {
		//~ $select = "SELECT * FROM supplierA where hotel_id='".$hotel."'";
		//~ $query=$this->db->query($select);
		//~ 
		//~ if ($query->num_rows() > 0)
		//~ {
			//~ return $query->row();
		//~ } else {
			//~ return '';	
		//~ }
	//~ }
	//~ 
}  
