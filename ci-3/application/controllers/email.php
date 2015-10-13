<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email extends CI_Controller {

	public function index(){
		$config = array(
			'protcol' => 'SMTP',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => '',
			'smtp_pass' => ''
		);
		$this->load->library('email',$config);
	}
}