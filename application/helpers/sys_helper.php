<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function logged_in(){
	return (bool) isset($_SESSION['system']->sys_logged_in);
}
function hashpass($str) {
	return hash('sha1', $str . config_item('encryption_key'));
}
function randomString($length) {
	$str = "";
	$characters = array_merge(range('A','Z'), range('0','9'),range('a','z'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
}

function message($tag = 'span', $type = 'normal', $msg = NULL) {
	switch ($type) {
		case 'normal':
			$class = 'text-info';
			break;
		case 'error':
			$class = 'text-danger';
			break;
		case 'warning':
			$class = 'text-warning';
			break;
		case 'success':
			$class = 'text-success';
			break;
		default:
			$class = 'text-info';
			break;
	}
	return "<$tag class=\"$class\">$msg</$tag>";
}
