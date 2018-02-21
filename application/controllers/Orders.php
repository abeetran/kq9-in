<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->data['obj'] = false;
		$this->uri = isset($_GET['act'])?$_GET['act']:false;
		$this->primary = isset($_GET['id'])?$_GET['id']:false;
		if($this->primary){
			$this->get = $this->M_sys->set_table('orders')->get_by_key($this->primary);
		}
		$this->data['sl_err'] = false;
	}
	public function index(){
		switch (true) {
			case $this->uri=='upd':
				if(isset($_POST['formsubmit'])){
					$this->validationFrom();
					if($this->form_validation->run() == false){
						$this->edit();
					}else{
						$soluong = 0;
						foreach ($_POST['size'] as $key=>$size){
							$soluong += (int)$size;
						}
						if($soluong == 0){
							$this->data['sl_err'] = "Đơn hàng chưa có số lượng";
							$this->edit();
						}else{
							unset($this->data['sl_err']);
							$this->save();
						}
					}
				}else{
					$this->edit();
				}
				break;
			
			default:
				$this->home();
				break;
		}
	}
	private function home(){
		$this->data['obiview'] = 'template/orders/home';
		$this->load->view('template/_main_page',$this->data);
	}
	private function edit(){
		$size=$this->M_sys->set_table('size')->set('trash',0)->set_orderby('sort')->gets();
		$color=$this->M_sys->set_table('color')->set('trash',0)->gets();
		$cottons=$this->M_sys->set_table('cottons')->set('trash',0)->gets();
		foreach($size as $key=>$rs){
			$this->data['size'][$rs->size]=strtoupper($rs->size);
		}
		foreach($color as $key=>$rc){
			$this->data['color'][$rc->color] = $rc->color;
		}
		foreach($cottons as $key=>$rv){
			$this->data['cottons'][$rv->cottons] = $rv->cottons;
		}
		if($this->primary){
			$this->data['obj'] = $this->get->data();
		}
		if(isset($_POST['formsubmit'])){
			$this->data['obj'] = (object)$_POST;
		}
		$this->data['obiview'] = 'template/orders/edit';
		$this->load->view('template/_main_page',$this->data);
	}

	private function save(){
		echo '<pre>';
		var_dump($_POST);
		echo '</pre>';
		exit;
	}


	private function validationFrom(){
		$this->form_validation->set_rules(
			'code',
			'Mã đơn hàng','required|xss_clean',array("required"=>"Nhập mã đơn hàng")
		);
	}
}
