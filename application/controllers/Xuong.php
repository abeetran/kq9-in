<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Xuong extends MY_Controller {
	public function index(){
		$this->data['obiview'] = 'template/main/home';
		$this->load->view('template/_main_page',$this->data);
	}
}
