<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site_model extends CI_Model {

	public function get_data(){
		$query = $this->db->get('users');
		return $query->result();
	}

}
