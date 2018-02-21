<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function inchuoi_config($tenchuoi){
	echo config_item($tenchuoi);
}

function hashpass($str) {
	return hash('sha1', $str . config_item('encryption_key'));
}

function rootfile($tenfile){
	echo base_url($tenfile);
}

function href_site($link){
	echo site_url($link);
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


function linkseo($str){
    //$str = convert_accented_characters($str);
    $str = stripUnicode($str);
    $str = str_replace("?","",$str);
    $str = str_replace("&","",$str);
    $str = str_replace(",","",$str);
    $str = str_replace(".","",$str);
    $str = str_replace("+","",$str);
    $str = str_replace(":","",$str);
    $str = str_replace("'","",$str);		
    $str = str_replace("  "," ",$str);
    $str = str_replace("'","",$str);
    $str = trim($str);
    $str = mb_convert_case($str,MB_CASE_TITLE,'utf-8');// MB_CASE_UPPER/MB_CASE_TITLE/MB_CASE_LOWER
    $str = str_replace(" ","-",$str);
    $str = strtolower($str);
    $str = str_replace( "ß", "ss", $str);
    $str = str_replace( "%", "", $str);
    $str = preg_replace("/[^_a-zA-Z0-9 -]/", "",$str);
    $str = str_replace(array('%20', ' '), '-', $str);
    $str = str_replace("----","-",$str);
    $str = str_replace("---","-",$str);
    $str = str_replace("--","-",$str);
    return strtolower($str);
}

function stripUnicode($str){
  if(!$str) return false;
   $unicode = array(
     'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
     'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
     'd'=>'đ',
     'D'=>'Đ',
     'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
      'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
      'i'=>'í|ì|ỉ|ĩ|ị',	  
      'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
     'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
      'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
     'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
      'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
     'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
     'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
   );
   foreach($unicode as $khongdau=>$codau) {
        $arr=explode("|",$codau);
      $str = str_replace($arr,$khongdau,$str);
   }
return strtolower($str);
}

function do_upload($dir,$file){
    
    $CI =& get_instance();//=$this
    
    $path = './assets/public/'.$dir;
    $path_thumb = './assets/public_thumbs/'.$dir;
    
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

    $config['upload_path']          = $path;
    $config['allowed_types']        = '*';
    $config['max_size']             = 102400;
   /* $config['max_width']            = 102400;
    $config['max_height']           = 76800;*/

    $CI->load->library('upload', $config);

    if ( ! $CI->upload->do_upload($file))
    {
        //return 'error';
        return '';
    }
    else
    {
        $dl_file = $CI->upload->data();

        $name = explode('.',$dl_file['orig_name']);
        $time=floatval(microtime(true));
        $savetime = intval($time*1000);
        if($savetime<1000000000000)
        {
            $savetime=round(microtime(true)*1000);
        }

        $filename = time()+date('ymd');
        //$filename .= date('ymd');
        $filename.='_'.linkseo($name[0]).'.'.$name[1];
        $path_new = $path.'/'.$filename;
        rename($path.'/'.$dl_file['orig_name'],$path_new);
        
        //Thumbnail Image Upload - Start
        $config['image_library'] = 'gd2';
        $config['source_image'] = $path.'/'.$filename;
        $config['new_image'] = $path_thumb.'/'.$filename;
        $config['width'] = 100;
        $config['height'] = 100;

        //load resize library
        $CI->load->library('image_lib', $config);
        $CI->image_lib->resize();

        return $filename;
    }
    
}