<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function logged_in(){
	$CI =& get_instance();//=$this
	$CI->load->model('cms/M_users');
	return $CI->M_users->loggedin();
}

function checkcontroller($cnt){
	if($_SESSION['system']->level==9999){
		return true;
	}
	$CI =& get_instance();
	$CI->load->model('cms/M_permission');
	$get = $CI->M_permission->set('groupid',$_SESSION['system']->level)->get();
	$controller = array();
	if(!$get){
		return false;
	}
	$data = json_decode($get->permission);
	foreach($data as $key=>$obj){
		array_push($controller,$obj->controller);
	}
	if(!in_array($cnt, $controller)){
		return false;
	}
	return true;
}

function checkfunction($cnt,$fnt){
	if($_SESSION['system']->level==9999){
		return true;
	}
	$CI =& get_instance();
	$CI->load->model('cms/M_permission');
	$get = $CI->M_permission->set('groupid',$_SESSION['system']->level)->get();
	$function = array();
	$data = json_decode($get->permission);
	foreach($data as $key=>$obj){
		if($cnt == $obj->controller){
			array_push($function,$obj->action);
		}
	}
	if(!in_array($fnt, $function)){
		return false;
	}
	return true;

}

function listcontroller(){
	$CI =& get_instance();
	$CI->load->helper('file');
	$controllers=array();
	$files = get_dir_file_info(APPPATH.'controllers/cms', FALSE);
	foreach (array_keys($files) as $file)
	{
		$a = explode('.php', $file);
		if(!in_array(strtolower($a[0]), array("auth","dashboard","trash","configs"))){
			$controllers[] = strtolower($a[0]);
		}
	}
	return $controllers;
}

function listposition(){
	return array("top","foot","left","right","navigation");
}

function listtype(){
	return array("Article","News","Products","Sevice");
}

function permission($level){
	$permission = false;
	$CI =& get_instance();
	$CI->load->model('cms/M_groups');
	$per = $CI->M_groups->set('id',$level)->get();
	if($per){
		$permission = strtolower($per->title);
	}
	if($level == 9999) $permission = "Superadmin";
	return $permission;
}

function ckadminsuper(){
	if($_SESSION['system']->level==9999){
		return true;
	}
	return false;
}