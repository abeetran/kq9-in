<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Controller extends CI_Controller {

	public $data = array();

	public function __construct() {
		parent::__construct();
		//var_dump(logged_in());exit;
		$this->data['site_name'] = 'Dashboard';
		$this->data['uri'] = $this->uri->segment(1);
		$exception_uris = array('auth/login','auth/logout');
		
		if (in_array(uri_string(), $exception_uris) == FALSE) {
			if (logged_in() == FALSE) {
				return redirect('auth/login');
			}
		}
		$this->data['segment_url'] = $this->uri->segment(1);
		$this->data['system'] = $_SESSION['system'];
        
	}

}