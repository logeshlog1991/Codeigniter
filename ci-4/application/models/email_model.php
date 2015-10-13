<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_model extends CI_Model {

	public function add($data){

		$insert = $this->db->insert('database',$data);
		if($insert){
			return true;
		}else{
			return false;
		}
		
	}

}
