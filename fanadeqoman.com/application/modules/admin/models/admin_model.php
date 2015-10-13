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
		
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where('user_id',$user_id);
		$query = $this->db->get();
		if($query->num_rows>0){
			return $query->row();
		}else{
			return false;
		}
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
	function get_banners()
    {
		$select = "SELECT * FROM banners";
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->result();
		} else {
			return '';	
		}
	}
	function update_banners($id,$image)
	{
		$data = array('banner_name' => $image);
		$this->db->where('s_no',$id);
		$this->db->update('banners',$data);
	} 
	function delete_img($a,$id)
	{
		$data = array('banner_name' => serialize($a));
		$this->db->where('s_no',$id);
		$this->db->update('banners',$data);
	} 
	function get_popular_banners()
    {
		$select = "SELECT * FROM papular_banners";
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->result();
		} else {
			return '';	
		}
	}
	function update_popularBanners($id,$image)
	{
		$data = array('banner_name' => $image);
		$this->db->where('s_no',$id);
		$this->db->update('papular_banners',$data);
	} 
	function delete_popularImg($a,$id)
	{
		$data = array('banner_name' => serialize($a));
		$this->db->where('s_no',$id);
		$this->db->update('papular_banners',$data);
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
		$base_price=0;$net_pri=0;$startsDate=0;
		$data = array('admin_markup' => $cur_value);
		$this->db->where('usertype',1);
		$this->db->update('admin',$data);
		
		$select ="SELECT MAX(date) as Maxdate , MIN(date)as Mindate  FROM sup_apart_maintain_month WHERE block_status=0";
		$res=$this->db->query($select);
	
		$startDate = strtotime(date("Y-m-d"));
		$endDate = strtotime($res->row()->Maxdate);
			
		while ($startDate <= $endDate) {
			
			$startsDate = date("Y-m-d",strtotime('+0 day', $startDate));
			$startDate  = strtotime('+1 day', $startDate);
	
			$select ="SELECT * FROM sup_apart_maintain_month WHERE date='".$startsDate."'";
			$res1=$this->db->query($select);
			$result=$res1->result_array();
			
			
			if(isset($result) && count($result)>0)
			{
				foreach($res1->result_array() as $details)
				{
					$base_price=$details['rate'];
					
					$sql="SELECT star,country FROM sup_hotels where sup_hotel_id='".$details['hotel_id']."'";
					$rs=$this->db->query($sql);
					$star=$rs->row()->star;
					$country_id=$rs->row()->country;
					
					$sql="SELECT * FROM admin";
					$rs1=$this->db->query($sql);
					
					$admin_markup=$rs1->row()->admin_markup; 
					$net_pri = $base_price+($base_price*$admin_markup/100);
					
					$select = "SELECT B.star_markup FROM star A LEFT JOIN star_markup B ON B.star_name = A.star WHERE A.s_no = '".$star."'"; 
					$rs2=$this->db->query($select);
					
					$star_markup=$rs2->row()->star_markup;
					$net_pri = $net_pri+($net_pri*$star_markup/100);
		
					$sql="SELECT country_markup FROM country_markup where country_id='".$country_id."'";
					$rs3=$this->db->query($sql);
					
					$country_markup=$rs3->row()->country_markup;
					$net_pri = $net_pri+($net_pri*$country_markup/100);
			
					$data = array('sell_price' => $net_pri,'admin_markups' =>$admin_markup,'country_markups' =>$country_markup,'star_markups' => $star_markup);
					$this->db->where('sup_apart_maintain_month_id',$details['sup_apart_maintain_month_id']);
					$this->db->update('sup_apart_maintain_month',$data);
				}
			}
		}
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
		$base_price=0;$net_pri=0;$startsDate=0;$country_result=0;
		
		$this->db->select('*')->from('country_markup');
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
		
		$this->db->select('*')->from('country_markup');
		$this->db->where('country_name',$cur_value['country_name']);
		$this->db->where('country_id',$cur_value['country']);
		$query=$this->db->get();
		$country_result=$query->row();
		
		
		$select ="SELECT MAX(date) as Maxdate , MIN(date)as Mindate  FROM sup_apart_maintain_month WHERE block_status=0";
		$res=$this->db->query($select);
	
		$startDate = strtotime(date("Y-m-d"));
		$endDate = strtotime($res->row()->Maxdate);
			
		while ($startDate <= $endDate) {
			
			$startsDate = date("Y-m-d",strtotime('+0 day', $startDate));
			$startDate  = strtotime('+1 day', $startDate);
	
			$select ="SELECT s.*,h.* FROM sup_apart_maintain_month s LEFT JOIN sup_hotels h ON h.sup_hotel_id=s.hotel_id WHERE s.date='".$startsDate."'";
			$res1=$this->db->query($select);
			$result=$res1->result_array();
			
			if(isset($result) && count($result)>0)
			{
				foreach($result as $details)
				{
					$base_price=$details['rate'];
					$star=$details['star'];
					$country_id=$details['country'];
					
					$sql="SELECT * FROM admin";
					$rs1=$this->db->query($sql);
					
					$admin_markup=$rs1->row()->admin_markup; 
					$net_pri = $base_price+($base_price*$admin_markup/100);
					
					$select = "SELECT B.star_markup FROM star A LEFT JOIN star_markup B ON B.star_name = A.star WHERE A.s_no = '".$star."'"; 
					$rs2=$this->db->query($select);
					
					$star_markup=$rs2->row()->star_markup;
					$net_pri = $net_pri+($net_pri*$star_markup/100);
		
					$sql="SELECT country_markup FROM country_markup where country_id='".$country_id."'";
					$rs3=$this->db->query($sql);
					
					$country_markup=$rs3->row()->country_markup;
					$net_pri = $net_pri+($net_pri*$country_markup/100);
			
					$data = array('sell_price' => $net_pri,'admin_markups' =>$admin_markup,'country_markups' =>$country_markup,'star_markups' => $star_markup);
					$this->db->where('sup_apart_maintain_month_id',$details['sup_apart_maintain_month_id']);
					$this->db->update('sup_apart_maintain_month',$data);
				}
			}
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
	public function get_starMarkup($star_markup=''){
		$query = $this->db->get('star_markup');
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return '';
		}
	}
	public function update_star_markup($unrated)
	{
		$i=0;
		foreach($unrated['unrated'] as $key=>$val)
		{
			$data = array('star_markup' => $val);
			if($i==0){
				$this->db->where('star_name','unrated');
			}else{
				$this->db->where('star_name',$i);
			}
			$this->db->update('star_markup',$data);
			$i++;
		}
		
		$base_price=0;$net_pri=0;$startsDate=0;$country_result=0;
		$select ="SELECT s.*,sm.* FROM star s LEFT JOIN star_markup sm ON sm.star_name=s.star";
		$query=$this->db->query($select);
		$result=$query->result_array($select);
		
		foreach($result as $val)
		{
				$select ="SELECT MAX(date) as Maxdate , MIN(date)as Mindate  FROM sup_apart_maintain_month WHERE block_status=0";
				$res=$this->db->query($select);
	
				$startDate = strtotime(date("Y-m-d"));
				$endDate = strtotime($res->row()->Maxdate);
			
				while ($startDate <= $endDate) {
			
					$startsDate = date("Y-m-d",strtotime('+0 day', $startDate));
					$startDate  = strtotime('+1 day', $startDate);
	
					$select ="SELECT s.*,h.* FROM sup_apart_maintain_month s LEFT JOIN sup_hotels h ON h.sup_hotel_id=s.hotel_id WHERE h.star='".$val['s_no']."' AND s.date='".$startsDate."'";
					$res1=$this->db->query($select);
					$result1=$res1->result_array();
					if(isset($result1) && count($result1)>0)
						{
							foreach($result1 as $details)
							{
								$base_price=$details['rate'];
								$star=$details['star'];
								$country_id=$details['country'];
								
								$sql="SELECT * FROM admin";
								$rs1=$this->db->query($sql);
								
								$admin_markup=$rs1->row()->admin_markup; 
								$net_pri = $base_price+($base_price*$admin_markup/100);
								
								$select = "SELECT B.star_markup FROM star A LEFT JOIN star_markup B ON B.star_name = A.star WHERE A.s_no = '".$star."'"; 
								$rs2=$this->db->query($select);
								
								$star_markup=$rs2->row()->star_markup;
								$net_pri = $net_pri+($net_pri*$star_markup/100);
					
								$sql="SELECT country_markup FROM country_markup where country_id='".$country_id."'";
								$rs3=$this->db->query($sql);
								
								$country_markup=$rs3->row()->country_markup;
								$net_pri = $net_pri+($net_pri*$country_markup/100);
						
								$data = array('sell_price' => $net_pri,'admin_markups' =>$admin_markup,'country_markups' =>$country_markup,'star_markups' => $star_markup);
								$this->db->where('sup_apart_maintain_month_id',$details['sup_apart_maintain_month_id']);
								$this->db->update('sup_apart_maintain_month',$data);
							}
						}
					
				}
		}
	}
	public function get_pages()
	{
		$this->db->select('*')->from('static_pages');
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return false;
		}
	}
	public function add_page($details)
	{
		  $data=array(
			'page_name'  		=>$details['page_name'],
			'page_nameA' 		=>$details['page_nameA'],
			'page_content' 		=>$details['page_content'],
			'page_contentA'  	=>$details['page_contentA']
		  );
		  $this->db->insert('static_pages',$data);
		  return true;
	}
	public function Inactive_page($page_id)
	{
		$data = array('status' => 0);
		$this->db->where('p_no',$page_id);
		$this->db->update('static_pages',$data);
	}
	public function Active_page($page_id)
	{
		$data = array('status' => 1);
		$this->db->where('p_no',$page_id);
		$this->db->update('static_pages',$data);
	}
	public function delete_page($page_id)
	{
		$sql="Delete from static_pages where p_no='".$page_id."'";
		$res=$this->db->query($sql);
		if ($res) {
			return true;
		}else{
			return false;
		}
	}
	public function get_page($page_id)
	{
		$this->db->select('*')->from('static_pages')->where('p_no',$page_id);
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return false;
		}
	}
	public function update_page_ad($details,$page_id)
	{
		$data=array(
			'page_name'  		=>$details['page_name'],
			'page_nameA' 		=>$details['page_nameA'],
			'page_content' 		=>$details['page_content'],
			'page_contentA'  	=>$details['page_contentA']
		  );
		$this->db->where('p_no',$page_id);
		$this->db->update('static_pages',$data);
		return true;
	}
	public function get_emailManager()
	{
		$this->db->select('*')->from('email_manager');
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return false;
		}
	}
	public function add_emailPage_ad($details)
	{
		 $data=array(
			'email_name'  		=>$details['page_name'],
			'email_nameA' 		=>$details['page_nameA'],
			'email_content' 	=>$details['editor1'],
			'email_contentA'  	=>$details['editor2']
		  );
		  $this->db->insert('email_manager',$data);
		  return true;
	}
	public function delete_emailpage($page_id)
	{
		$sql="Delete from email_manager where m_no='".$page_id."'";
		$res=$this->db->query($sql);
		if ($res) {
			return true;
		}else{
			return false;
		}
	}
	public function Inactive_emailpage($page_id)
	{
		$data = array('status' => 0);
		$this->db->where('m_no',$page_id);
		$this->db->update('email_manager',$data);
	}
	public function Active_emailpage($page_id)
	{
		$data = array('status' => 1);
		$this->db->where('m_no',$page_id);
		$this->db->update('email_manager',$data);
	}
	public function edit_emailpage($page_id)
	{
		$this->db->select('*')->from('email_manager')->where('m_no',$page_id);
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return false;
		}
	}
	public function edit_emailPage_ad($details,$page_id)
	{
		 $data=array(
			'email_name'  		=>$details['page_name'],
			'email_nameA' 		=>$details['page_nameA'],
			'email_content' 	=>$details['editor1'],
			'email_contentA'  	=>$details['editor2']
		  );
		$this->db->where('m_no',$page_id);
		$this->db->update('email_manager',$data);
		return true;
	}
	
	
}  
