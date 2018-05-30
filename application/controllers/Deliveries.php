<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deliveries extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('cms/M_deliveries');
		$this->url = isset($_GET['act'])?$_GET['act']:false;
		$this->primary = isset($_GET['id'])?$_GET['id']:false;
		$this->order_id = isset($_GET['order'])?$_GET['order']:false;
		$this->token = isset($_GET['token'])?$_GET['token']:false;
		$this->status = isset($_GET['t'])?$_GET['t']:false;
		$this->get = false;

		if($this->primary){
			$this->get = $this->M_deliveries->get_by_key($this->primary);
		}
	}

	public function index(){
		switch(true){
			case $this->url == 'upd':
				if($this->token != $this->data['system']->token){
					return redirect(site_url('deliveries'));
				}
				if($this->get){
					$this->save();
				}else{
					return redirect(site_url('deliveries'));
				}
				break;
			default:
				$this->home();
				break;
		}
	}

	private function home(){
		$this->data['obj'] = $this->M_deliveries->set_pageof(200)->page(1)->getdata();
		$this->data['obiview'] = 'template/delivery/home';
		$this->load->view('template/_main_page',$this->data);
	}

	private function save(){
		$order = order_detail($this->order_id);
		if($this->status > 0 && $this->status == 4 && $order && $order->status == 3){
			$data['status'] = $this->status;
			$this->M_orders->sets($data)->update(array('id'=>$this->order_id));
			return redirect(site_url('deliveries'));
		}else{
			return redirect(site_url('deliveries'));
		}
	}

}