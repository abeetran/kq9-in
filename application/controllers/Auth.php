<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->data['site_name'] = 'LOGIN SYSTEM';
		$this->load->model('cms/M_users');
	}
	
	public function index(){
		$this->loggedin();
	}
	
	public function login(){
		$this->load->view('login',$this->data);
	}
	
	private function loggedin(){
		$login = $this->M_users->sets(array('email'=>$_POST['email'],'password'=>hashpass($_POST['password'])))->get();
		if($login){
			$session['sys_logged_in'] = true;
			$session['sys_id'] = $login->id;
			$session['username'] = $login->username;
			$session['level']  =   $login->level;
			$session['sys_obi'] = "uibc";
			$session['token'] = randomString(50);
			$_SESSION['system'] = (object)$session;
			return redirect(site_url('orders'));
		}else{
			$msg = "Wrong password or email";
			$_SESSION['sys_msg'] = message('div','error',$msg);
			return redirect(site_url('auth/login'));
		}
	}
	
	public function logout(){
		unset($_SESSION['system']);
		return redirect(site_url('auth/login'));
	}
}
