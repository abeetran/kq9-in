<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Design extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('cms/M_design');
		$this->url = isset($_GET['act'])?$_GET['act']:false;
		$this->primary = isset($_GET['id'])?$_GET['id']:false;
		$this->order_id = isset($_GET['order'])?$_GET['order']:false;
		$this->token = isset($_GET['token'])?$_GET['token']:false;
		$this->get = false;

		if($this->primary){
			$this->get = $this->M_design->get_by_key($this->primary);
		}
	}

	public function index(){
		switch(true){
			case $this->url == 'upd':
				if($this->token != $this->data['system']->token){
					return redirect(site_url('design'));
				}
				if($this->get){
					if(isset($_POST['formsubmit'])){
						$this->save();
					}else{
						$this->view();
					}
				}else{
					return redirect(site_url('design'));
				}
				break;
			default:
				$this->home();
				break;
		}
	}

	private function home(){
		$this->data['obj'] = $this->M_design->set('trash',0)->set_pageof(200)->page(1)->getdata();
		$this->data['obiview'] = 'template/design/home';
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
				$this->data['obj'] = $design;
				$this->data['obiview'] = 'template/design/upd';
				$this->load->view('template/_main_page',$this->data);
			}else{
				return redirect(site_url('design'));
			}
		}else{
			return redirect(site_url('design'));
		}
	}

	private function save(){
		$files = $_FILES;
		if(empty($files)){
			$_SESSION['msg'] = 'Cần phải cập nhật file thiết kế';
			$url = site_url('design?act=upd&id='.$this->primary.'&order='.$this->order_id.'&token='.$this->token);
			return redirect($url);
		}else{
			$order = order_detail($this->order_id);
			if($order){
				$data = array();
				$folder = date('Ymd',strtotime($order->order_date));
				$image_upload = upload_multiple($files,'orders/'.$folder);

				$img_delete = json_decode($_POST['img_delete']);
				$images = json_decode($order->images);
				//$hinh = array_merge($images,$image_upload);
				
				$hinh = array();
				if(!empty($img_delete)){
					foreach($images as $i=>$img){
						if( in_array($img, $img_delete) ){
							$img = 'assets/public/orders/'.$folder.'/'.$img;
							@unlink($img);
							unset($images[$i]);
						}else{
							$hinh[] = $img;
						}
					}
				}else{
					$hinh = $images;
				}
					
				if(!empty($image_upload)){
					$hinh = array_merge($hinh,$image_upload);
				}
				$data['images'] = json_encode($hinh);
				$status = (int)$this->input->post('status');
				if($status > 0){
					$data['status'] = $status;
				}
				$this->M_orders->sets($data)->update(array('id'=>$this->order_id));

				return redirect(site_url('design'));
			}else{
				return redirect(site_url('design'));
			}
		}
	}
}