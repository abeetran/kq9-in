<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prints extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('cms/M_prints');
		$this->url = isset($_GET['act'])?$_GET['act']:false;
		$this->primary = isset($_GET['id'])?$_GET['id']:false;
		$this->order_id = isset($_GET['order'])?$_GET['order']:false;
		$this->token = isset($_GET['token'])?$_GET['token']:false;
		$this->get = false;

		if($this->primary){
			$this->get = $this->M_prints->get_by_key($this->primary);
		}
	}

	public function index(){
		switch(true){
			case $this->url == 'upd':
				if($this->token != $this->data['system']->token){
					return redirect(site_url('prints'));
				}
				if($this->get){
					if(isset($_POST['formsubmit'])){
						$this->save();
					}else{
						$this->view();
					}
				}else{
					return redirect(site_url('prints'));
				}
				break;
			default:
				$this->home();
				break;
		}
	}

	private function home(){
		$this->data['obj'] = $this->M_prints->set('trash',0)->set_pageof(200)->page(1)->getdata();
		$this->data['obiview'] = 'template/prints/home';
		$this->load->view('template/_main_page',$this->data);
	}

	private function view(){
		if($this->get){
			$design = $this->get->data();
			$order = order_detail($design->order_id);
			if($order){
				$design->order_code = $order?$order->order_code:'';
				$design->uu_tien	= $order?$order->uu_tien:0;
				$design->ngay_giao	= $order?date('d/m/Y',strtotime($order->ngay_giao)):date('d/m/Y');
				$design->images 	= $order?$order->images:'[]';
				$design->folder 	= $order?date('Ymd',strtotime($order->order_date)):'';
				$this->data['obj'] = $design;
				$this->data['obiview'] = 'template/prints/upd';
				$this->load->view('template/_main_page',$this->data);
			}else{
				return redirect(site_url('design'));
			}
		}else{
			return redirect(site_url('design'));
		}
	}

	private function save(){
		$order = order_detail($this->order_id);
		$status = (int)$this->input->post('status');
		if($order && $order->status == 2){
			if($this->status > 0){
				$data['status'] = $status;
				$this->M_orders->sets($data)->update(array('id'=>$this->order_id));
				return redirect(site_url('prints'));
			}else{
				$_SESSION['msg'] = 'Cần xác nhận đã giao hàng trước khi lưu';
				$url = site_url('prints?act=upd&id='.$this->primary.'&order='.$this->order_id.'&token='.$this->token);
				return redirect($url);
			}
		}else{
			return redirect(site_url('design'));
		}
		
	}

}