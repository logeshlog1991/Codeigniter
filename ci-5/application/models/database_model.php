<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Database_model extends CI_Model {

	public function view(){
		$this->db->select('name');
		$query = $this->db->get('database');
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return false;
		}
		
	}

}
