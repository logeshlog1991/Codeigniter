<?php
class Callcenter_Model extends CI_Model {
	
	public function __construct()
    {
      parent::__construct();
    }
		
   public function verify_user($email, $password)
   {
   
		$this->db->select('*')
			->from('callcenter_agents')
			->where('email_id', $email)
            ->where('password', $password)
			->where('status', 1);
		$query = $this->db->get();
		
	//echo $this->db->last_query();exit;

      if ( $query->num_rows > 0 ) {
         // person has account with us
         return $query->row();
      }
      return false;
   }
 
//-----------closing class----------// 
}  
