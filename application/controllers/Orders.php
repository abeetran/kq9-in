<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->data['obj'] = false;
		$this->url = isset($_GET['act'])?$_GET['act']:false;
		$this->primary = isset($_GET['id'])?$_GET['id']:false;
		$this->token = isset($_GET['token'])?$_GET['token']:false;
		
		if($this->primary){
			if($this->token==false || $this->token != $_SESSION['system']->token){
				return redirect(site_url($this->data['segment_url']));
			}
			$this->get = $this->M_orders->get_by_key($this->primary);
		}
	}
	public function index(){
		switch (true) {
			case $this->url=='upd':
				
				if(isset($_POST['formsubmit'])){
					validationFrom();
					if($this->form_validation->run() == false){
						$this->edit();
					}else{
						$this->save();
					}
				}else{
					$this->edit();
				}
				break;
			case $this->url == 'del':
				$this->delete();
				break;
			default:
				$this->home();
				break;
		}
	}

	private function home(){
		$this->load->model('cms/M_deliveries');
		$this->data['obj'] = $this->M_orders->set('trash',0)->set_pageof(200)->page(1)->set_orderby('uu_tien','desc')->set_orderby('id','desc')->gets();
		$this->data['status'] = order_status();
		$this->data['obiview'] = 'template/orders/home';
		$this->load->view('template/_main_page',$this->data);
	}

	private function edit(){
		$this->load->model('cms/M_sizes');
		$this->load->model('cms/M_cottons');
		$this->load->model('cms/M_design');
		$this->load->model('cms/M_prints');
		$this->load->model('cms/M_deliveries');
		$size=$this->M_sizes->set('trash',0)->set_orderby('sort')->gets();
		$cottons=$this->M_cottons->set('trash',0)->gets();
		foreach($size as $key=>$rs){
			$this->data['size'][$rs->id]=strtoupper($rs->size);
		}
		foreach($cottons as $key=>$rv){
			$this->data['cottons'][$rv->id] = $rv->cottons;
		}
		$status = order_status();
		unset($status[4]);
		$this->data['status'] = $status;
		if($this->primary){
			$order = $this->get->data();
			if($order->trash == 1){
				return redirect(site_url('orders'));
			}
			$print = $this->M_prints->set('order_id',$this->primary)->get();
			$design = $this->M_design->set('order_id',$this->primary)->get();
			$deliveries = $this->M_deliveries->set('order_id',$this->primary)->get();
			$data = array_merge((array)$order,(array)$print,(array)$design,(array)$deliveries);
			$this->data['obj'] = (object)$data;
		}
		if(isset($_POST['formsubmit'])){
			$this->data['obj'] = (object)$_POST;
		}
		$this->data['obiview'] = 'template/orders/edit';
		$this->load->view('template/_main_page',$this->data);
	}

	private function save(){
		$this->load->model('cms/M_design');
		$this->load->model('cms/M_prints');
		$this->load->model('cms/M_deliveries');
		//var_dump($_POST);
		$files = $_FILES;
		$date = date('Y-m-d');
		$folder = 'orders/'.date('Ymd');
		$file_print = do_upload($folder,'file_print');
		unset($files['file_print']);
		//$images = multiple_upload($files);
		$image_upload = array();
		if(isset($files['files']['name'][0]) && $files['files']['name'][0]!='') {
            $filesCount = count($files["files"]["name"]);
            for ($i = 0; $i < $filesCount; $i++):
                $files['userFile']['name'] = $files['files']['name'][$i];
                $files['userFile']['type'] = $files['files']['type'][$i];
                $files['userFile']['tmp_name'] = $files['files']['tmp_name'][$i];
                $files['userFile']['size'] = $files['files']['size'][$i];
                $size[$i] = $files['userFile']['size'];
                $name = explode('.',$files["userFile"]["name"]);
                $time=floatval(microtime(true));
                $savetime = intval($time*1000);
                if($savetime<1000000000000)
                {
                    $savetime=round(microtime(true)*1000);
                }
                $filename = time().'-';
                $filename.=linkseo($name[0]).'.'.$name[1];
                $path = 'assets/public/'.$folder;
                $path_thumb = 'assets/public_thumbs/'.$folder;
                if(! is_dir($path)){
					if(mkdir($path,0777,true)){
						chmod($path,0777);
					}
				}
				if(! is_dir($path_thumb)){
					if(mkdir($path_thumb,0777,true)){
						chmod($path_thumb,0777);
					}
				}
                
                move_uploaded_file($files["userFile"]["tmp_name"], $path.'/'.$filename);
                $image_upload[] = $filename;
                //create_thumb($path.'/'.$filename,$path_thumb.'/'.$filename,100,100,50);
            endfor;
        }
		$post = $this->input->post();
		$uu_tien = isset($_POST['uu_tien'])?$_POST['uu_tien']:0;
		$co_coc = isset($_POST['co_coc'])?$_POST['co_coc']:0;
		$pay_online = isset($_POST['pay_online'])?$_POST['pay_online']:0;
		$cong_no = isset($_POST['cong_no'])?$_POST['cong_no']:0;

		$orders = array(
			'size'		=> json_encode($post['size']),
			'color'		=> $post['color'],
			'cotton'	=> $post['cotton'],
			'images'	=> json_encode($image_upload),
			'status'	=> $post['status'],
			'uu_tien'	=> $uu_tien,
			'cc_coc'	=> $co_coc,
			'sum_order'	=> $post['sum_order'],
			'order_date'=> $date,
			'pay_online'=> $pay_online,
			'cong_no'	=> $cong_no,
			'tiensx'	=> $post['tiensx'],
			'created_date'=> date('Y-m-d H:i:s'),
			'created_by'=>$_SESSION['system']->sys_id,
		);
		if($co_coc == 1){
			$orders['tiencoc'] = $post['tiencoc'];
		}else{
			$orders['tiencoc'] = NULL;
		}
		if($this->primary) $order_id = $this->primary;
		$design = array(
			'order_id'		=> $order_id,
			'bung'			=> $post['bung'],
			'co'			=> $post['co'],
			'tay'			=> $post['tay'],
			'hong'			=> $post['hong'],
			'lai_ao'		=> $post['lai_ao'],
			'quan'			=> $post['quan'],
			'front'			=> (int)$this->input->post('design_front'),
			'back'			=> (int)$this->input->post('design_back'),
			'hand_left'		=> (int)$this->input->post('design_tleft'),
			'hand_right'	=> (int)$this->input->post('design_tright'),
			'shorts_left'	=> (int)$this->input->post('design_qleft'),
			'shorts_right'	=> (int)$this->input->post('design_qright'),
			'sum_desgin'	=> 0,
		);

		$print = array(
			'order_id'		=> $order_id,
			'in_lua'		=> (int)$this->input->post('in_lua'),
			'in_nhiet'		=> (int)$this->input->post('in_nhiet'),
			'in_decal'		=> (int)$this->input->post('in_decal'),
			'files'			=> $file_print,
			'sum_print'		=> $post['tien_in_them']
		);

		$deliveries = array(
			'order_id'		=> $order_id,
			'fullname'		=> $post['customer_name'],
			'phone'			=> $post['customer_phone'],
			'ngay_giao'		=> date('Y-m-d', strtotime($post['customer_date'])),
			'address'		=> $post['customer_add'],
			'truck'			=> $post['customer_gui_xe']
		);

		if($this->primary){
			$data = $this->get->data();
			$img_delete = json_decode($post['img_delete']);
			$images = json_decode($data->images);
			$hinh = array();
			if(!empty($img_delete)){
				foreach($images as $i=>$img){
					if( in_array($img, $img_delete) ){
						$img = 'assets/public/orders/'.date('Ymd',strtotime($data->order_date)).'/'.$img;
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

			$orders['images'] = json_encode($hinh);
			//var_dump($img_delete);echo '<br/>';
			//var_dump($images);echo '<br/>';
			//var_dump($orders['images']);exit;
			unset($orders['created_by'],$orders['created_date'],$orders['order_date']);
			$updated_info = array();
			if(empty($data->updated_info)){
				$updated_info = array(
					'userid'	=> $this->data['system']->sys_id,
					'date'		=> date('Y-m-d H:i:s'),
					'content'	=> 'change content'
				);
			}else{
				$updated_info = (array)json_decode($data->updated_info);
				$updated_info[] = array(
					'userid'	=> $this->data['system']->sys_id,
					'date'		=> date('Y-m-d H:i:s'),
					'content'	=> 'change content'
				);
			}
			$orders['updated_info'] = json_encode($updated_info);
			$this->M_orders->sets($orders)->update(array('id'=>$this->primary));
			$gprint = $this->M_prints->set('order_id',$this->primary)->get();
			//var_dump($file_print);exit;
			if($file_print != ''){
				@unlink('assets/public/orders/'.date('Ymd',strtotime($data->order_date)).'/'.$gprint->flies);
			}else{
				unset($print['files']);
			}
			unset($print['order_id'],$design['order_id'],$deliveries['order_id']);

			$this->M_prints->sets($print)->update(array('order_id'=>$this->primary,'id'=>$gprint->id));

			$this->M_design->sets($design)->update(array('order_id'=>$this->primary));
			$this->M_deliveries->sets($deliveries)->update(array('order_id'=>$this->primary));

		}else{
			$order_id = $this->M_orders->add_id($orders);
			$order_code = $this->order_code($order_id);
			$this->M_orders->sets(array('order_code'=>$order_code))->set('id',$order_id)->save();
			$design_id = $this->M_design->add_id($design);
			$print_id = $this->M_prints->add_id($print);
			$deliveries_id = $this->M_deliveries->add_id($deliveries);
		}
		return redirect(site_url('orders'));
	}

	private function order_code($id){
		$date = date('ymd');
		switch(strlen($id)){
			case 1:
				$code=$date.'000'.$id;
				break;
			case 2:
				$code=$date.'00'.$id;
				break;
			case 3:
				$code=$date.'0'.$id;
				break;
			default:
				$code=$date.$id;
				break;
		}
		return $code;
	}

	private function delete(){
		if($this->get){
			$this->get->set('trash',1)->save();
		}
		return redirect(site_url('orders'));
	}
}
