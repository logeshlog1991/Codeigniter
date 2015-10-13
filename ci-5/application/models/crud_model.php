<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crud_model extends CI_Model {

	public function insert(){
		$data = array(
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email')
				);
		$check = $this->db->insert('database',$data);
		if($check){
			return true;
		}else{
			return false;
		}
	}

	public function select(){
		$data = $this->db->get('database');
		if($data->num_rows()>0){
			return $data->result();
		}
	}

	public function delete(){
		$this->db->where('id', $this->uri->segment(3));
		$data = $this->db->delete('database');
		if($data){
			return true;
		}else{
			return false;
		}
	}

	public function update(){

	}

	public function login_check(){
		$this->db->where('name',$this->input->post('name'));
		$this->db->where('email',$this->input->post('email'));
		$check = $this->db->get('database');
		if($check->num_rows()>0){
			//echo "eo";die();
			return true;
		}else{
			//echo "o";die();
			return false;
		}
	}

	

}