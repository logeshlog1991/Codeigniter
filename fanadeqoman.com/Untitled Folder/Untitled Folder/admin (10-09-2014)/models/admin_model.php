<?php
class Admin_model extends CI_Model {
	
	public function __construct()
    {
      parent::__construct();
    }
		
   public function verify_user($email, $password)
   {
   
		$this->db->select('user_id, usertype, firstname, lastname, email')
			->from('admin')
			->where('email', $email)
            ->where('password', $password)
			->where('usertype', 1)
			->where('status', 1)
			->limit(1);
		$query = $this->db->get();
	  if ( $query->num_rows > 0 ) {
        return $query->row();
      }
      return false;
   }
   public function get_admin_profile($user_id)
   {
	   $this->db->select('*')
				->from('admin')
				->where('user_id',$user_id);
	   $query = $this->db->get();
	   if ( $query->num_rows > 0 ) {
			return $query->row();
       }
      return false;
   }
   public function update_profile($admin_details,$img)
   {
	 $data = array(
				'email' => $admin_details['Email'],
				'firstname' => $admin_details['First_Name'],
				'lastname' =>$admin_details['Last_Name'],
				'address' => $admin_details['Address'],
				'contact_no' => $admin_details['Contact_No'],
				'city_id' => $admin_details['bank_country'],
				'postal_code' => $admin_details['postal'],
				'profile_pic' => $img
			);
		$this->db->where('user_id',$admin_details['user_id']);
		$this->db->update('admin', $data);
   } 
   public function get_profilepic()
   {
		$this->db->select('profile_pic,firstname');
		$this->db->from('admin');
		$this->db->where('user_id',$this->session->userdata('user_id'));
		$query = $this->db->get();
		if($query->num_rows>0){
			return $query->row();
		}else{
			return false;
		}
   }
   
   public function change_password($admin_details,$user_id)
   {
		$data = array('password' => $admin_details['npass']);
		$this->db->where('user_id',$user_id);
		$this->db->update('admin', $data);
   } 
   public function check_pass($admin_details,$user_id)
   {
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where('user_id',$user_id);
		$this->db->where('password',$admin_details['currentpass']);
		$query = $this->db->get();
		if($query->num_rows>0){
			return true;
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
  
    function getCurrencyData()
    {
		$select = "SELECT * FROM currency_converter";
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->result();
		} else {
			return '';	
		}
	} 
	function Inactive_currency($cur_id)
	{
		$data = array('status' => 0);
		$this->db->where('cur_id',$cur_id);
		$this->db->update('currency_converter',$data);
	} 
	function Active_currency($cur_id)
	{
		$data = array('status' => 1);
		$this->db->where('cur_id',$cur_id);
		$this->db->update('currency_converter',$data);
	} 
	function edit_currency($cur_id)
	{
		$this->db->select('*');
		$this->db->from('currency_converter');
		$this->db->where('cur_id',$cur_id);
		$query=$this->db->get();
		if($query->num_rows()=='')
		{
			return '';
		}else{
			return $query->row();
		}
	} 
	function update_currency($cur_id,$cur_value)
	{
		$data = array('value' => $cur_value);
		$this->db->where('cur_id',$cur_id);
		$this->db->update('currency_converter',$data);
	}
	function get_payment_charge()
	{		
		$this->db->select('charge');
		$this->db->from('payment_charge');
		$this->db->where('id',1);
		$query=$this->db->get();
		if($query->num_rows()=='')
		{
			return '';
		}else{
			$a = $query->row();
			return $a->charge;
		}
	}
	function update_payment_charge($cur_value)
	{
		$data = array('charge' => $cur_value);
		$this->db->where('id',1);
		$this->db->update('payment_charge',$data);
	}
	function get_admin_markup()
	{		
		$this->db->select('admin_markup');
		$this->db->from('admin');
		$this->db->where('usertype',1);
		$query=$this->db->get();
		if($query->num_rows()=='')
		{
			return '';
		}else{
			$a = $query->row();
			return $a->admin_markup;
		}
	}
	function update_admin_markup($cur_value)
	{
		$data = array('admin_markup' => $cur_value);
		$this->db->where('usertype',1);
		$this->db->update('admin',$data);
	}
	function country_markup()
	{
		$this->db->select('*');
		$this->db->from('country_markup');
		$query=$this->db->get();
		if($query->num_rows()=='')
		{
			return '';
		}else{
			return $query->result();
		}
	}
	function update_country_markup($cur_value)
	{
		$this->db->select('*');
		$this->db->from('country_markup');
		$this->db->where('country_name',$cur_value['country_name']);
		$this->db->where('country_id',$cur_value['country']);
		$query=$this->db->get();
		if($query->num_rows()=='')
		{
			$data = array(
						'country_name' => $cur_value['country_name'],
						'country_id' => $cur_value['country'],
						'country_markup' => $cur_value['currency_value'],
						'status' => 1
					);
			$this->db->insert('country_markup', $data);
		}else{
			$a = $query->row();
			$data = array(
						'country_name' => $cur_value['country_name'],
						'country_id' => $cur_value['country'],
						'country_markup' => $cur_value['currency_value'],
						'status' => 1
					);
			$this->db->where('country_markupid',$a->country_markupid);
			$this->db->update('country_markup',$data);
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
	function InActive_country_markup($cur_id)
	{
		$data = array('status' => 0);
		$this->db->where('country_markupid',$cur_id);
		$this->db->update('country_markup',$data);
	}
	function Active_country_markup($cur_id)
	{
		$data = array('status' => 1);
		$this->db->where('country_markupid',$cur_id);
		$this->db->update('country_markup',$data);
	}
	function delete_country_markup($cur_id)
	{
		$this->db->where('country_markupid',$cur_id);
		$this->db->delete('country_markup');
	}
	function callcenter_agents()
	{
		$this->db->select('*');
		$this->db->from('callcenter_agents');
		$query=$this->db->get();
		if($query->num_rows()=='')
		{
			return '';
		}else{
			return $query->result();
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
	function update_callcenter_markup($cur_value)
	{
		$this->db->select('*');
		$this->db->from('callcenter_agents');
		$this->db->where('name',$cur_value['country_name']);
		$this->db->where('callcenter_agent_id',$cur_value['country']);
		$query=$this->db->get();
		if($query->num_rows()=='')
		{
		}else{
			$a = $query->row();
			$data = array('callcenter_markup' => $cur_value['currency_value']);
			$this->db->where('callcenter_agent_id',$a->callcenter_agent_id);
			$this->db->update('callcenter_agents',$data);
		}
	}
	function InActive_callcenter_markup($cur_id)
	{
		$data = array('status' => 0);
		$this->db->where('callcenter_agent_id',$cur_id);
		$this->db->update('callcenter_agents',$data);
	}
	function Active_callcenter_markup($cur_id)
	{
		$data = array('status' => 1);
		$this->db->where('callcenter_agent_id',$cur_id);
		$this->db->update('callcenter_agents',$data);
	}
	
	function delete_callcenter_markup($cur_id)
	{
		$this->db->where('callcenter_agent_id',$cur_id);
		$this->db->delete('callcenter_agents');
	}
	function Active_ccagents_list()
	{		
		$this->db->select('*');
		$this->db->from('callcenter_agents');
		$this->db->where('status',1);
		$query=$this->db->get();
		if($query->num_rows()=='')
		{
			return '';
		}else{
			return $query->result();
		}
	}
	function InActive_ccagents_list()
	{		
		$this->db->select('*');
		$this->db->from('callcenter_agents');
		$this->db->where('status',0);
		$query=$this->db->get();
		if($query->num_rows()=='')
		{
			return '';
		}else{
			return $query->result();
		}
	}
	function callcenter_agents_ad($agents,$fileimage)
	{
		$data = array(
					'email_id' => $agents['email'],
					'password' => $agents['password'],
					'name' => $agents['name'],
					'company_name' => $agents['company_name'],
					'mobile' => $agents['contact_number'],
					'currency_type' => $agents['paymnet_currency'],
					'address' => $agents['address'],
					'country' => $agents['country'],
					'city' => $agents['city'],
					'state' => $agents['bank_state'],
					'postal_code' => $agents['postal'],
					'callcenter_agent_logo'=>$fileimage,
					'status' => 1
				);
		$this->db->insert('callcenter_agents', $data);
		$id = $this->db->insert_id();
		$data1 = array('callagent_id' => 'FOCC'.$id );
		$this->db->where('callcenter_agent_id',$id);
		$this->db->update('callcenter_agents', $data1);
	}
	function get_agent($agent_id)
	{
		$this->db->select('*');
		$this->db->from('callcenter_agents');
		$this->db->where('callcenter_agent_id',$agent_id);
		$query=$this->db->get();
		if($query->num_rows()=='')
		{
			return '';
		}else{
			return $query->row();
		}
	}
	function editcallcenter_agents_ad($agents,$fileimage,$agent_id)
	{
			$data = array(
					'email_id' => $agents['email'],
					'password' => $agents['password'],
					'name' => $agents['name'],
					'company_name' => $agents['company_name'],
					'mobile' => $agents['contact_number'],
					'currency_type' => $agents['paymnet_currency'],
					'address' => $agents['address'],
					'country' => $agents['country'],
					'city' => $agents['city'],
					'state' => $agents['bank_state'],
					'postal_code' => $agents['postal'],
					'status' => 1
				);
			$this->db->where('callcenter_agent_id',$agent_id);
			$this->db->update('callcenter_agents',$data);
			if($fileimage!=''){
				$data = array('callcenter_agent_logo'=>$fileimage);
				$this->db->where('callcenter_agent_id',$agent_id);
				$this->db->update('callcenter_agents',$data);
			}
	}
	function get_callcenter_credit($callcenter_id)
	{
		$this->db->select('*');
		$this->db->from('callcenter_credit');
		$this->db->where('callcenter_id',$callcenter_id);
		$query=$this->db->get();
		if($query->num_rows()=='')
		{
			return '';
		}else{
			return $query->row()->credit;
		}
	}
	function update_callcenter_credit($credit_details)
	{
		$this->db->select('*');
		$this->db->from('callcenter_credit');
		$this->db->where('callcenter_id',$credit_details['callcenter_id']);
		$query=$this->db->get();
		if($query->num_rows()=='')
		{
			$data = array(
				'callcenter_id' => $credit_details['callcenter_id'],
				'credit' => $credit_details['credit'],
				'status' => 1
			);
			$this->db->insert('callcenter_credit', $data);
		}else{
			$data = array('credit' => $credit_details['credit']);
			$this->db->where('callcenter_id',$credit_details['callcenter_id']);
			$this->db->update('callcenter_credit',$data);
		}
	}
	function callcenter_credits()
	{
		$select = "SELECT A.* , B.* FROM callcenter_credit A INNER JOIN callcenter_agents B ON B.callagent_id = A.callcenter_id"; 
		$query=$this->db->query($select);
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	
  
}  
