<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cottons extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('cms/M_cottons');
		$this->data['obj'] = false;
		$this->uri = isset($_GET['act'])?$_GET['act']:false;
		$this->primary = isset($_GET['id'])?$_GET['id']:false;
		if($this->primary){
			$this->get = $this->M_cottons->get_by_key($this->primary);
		}
	}
	public function index(){
		switch (true) {
			case $this->uri=='upd':
				if(isset($_POST['formsubmit'])){
					if($_POST["cottons"]!==''){
						$this->save();
					}else{
						validationFrom();
						if($this->form_validation->run()==false)
							$this->edit();
					}
				}else{
					$this->edit();
				}
				break;
			case $this->uri=='del':
				$this->get->set('trash',1)->save();
				return redirect('cottons');
				break;
			default:
				$this->home();
				break;
		}
	}
	private function home(){
		$this->data['obj'] = $this->M_cottons->set('trash',0)->set_orderby('id','DESC')->gets();
		$this->data['obiview'] = 'template/cottons/home';
		$this->load->view('template/_main_page',$this->data);
	}
	private function edit(){
		if(isset($_POST['formsubmit'])){
			$this->data['obj'] = (object)$_POST;
		}
		if($this->primary){
			$this->data['obj'] = $this->get->data();
		}
		$this->data['obiview'] = 'template/cottons/edit';
		$this->load->view('template/_main_page',$this->data);
	}

	private function save(){
		$data = $_POST;
		unset($data['formsubmit']);
		
		if($this->primary){
			$this->get->sets($data)->save();
		}else{
			$data['createddate'] = date('Y-m-d H:i:s');
			$data['created_by'] = $_SESSION['system']->sys_id;
			$this->M_sys->set_table('cottons')->add_id($data);	
		}
		
		return redirect('cottons');
	}
}
