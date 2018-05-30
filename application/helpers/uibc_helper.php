<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function inchuoi_config($tenchuoi){
	echo config_item($tenchuoi);
}

function rootfile($tenfile){
	echo base_url($tenfile);
}

function href_site($link){
	echo site_url($link);
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
function create_thumb($name, $newname, $new_w, $new_h, $by_small=true, $border=false, $transparency=true, $base64=false) {

		$thumb_width		= $new_w;
		$thumb_height		= $new_h;

		if(file_exists($newname))
				@unlink($newname);
		if(!is_file($name))
				return false;
		$arr = explode("\.",$name);
		$ext = $arr[count($arr)-1];
		if(preg_match('/jpeg/i', $ext)){
				$img = @imagecreatefromjpeg($name);
		}elseif (preg_match('/jpg/i', $ext)){
				$img = @imagecreatefromjpeg($name);
		} elseif(preg_match('/png/i', $ext)){
				$img = @imagecreatefrompng($name);
		} elseif(preg_match('/gif/i', $ext)) {
				$img = @imagecreatefromgif($name);
		} elseif(preg_match('/bmp/i', $ext)) {
				$img = @imagecreatefrombmp($name);
		}
		/*if(!$img)
				return false;*/
		// Get needed data about source image
		list( $original_width, $original_height, $type, $attr ) = getimagesize( $name );

		// Calculate final thumbnail resolution
		$thumb_ratio 		= $thumb_width / $thumb_height;
		$original_ratio 	= $original_width / $original_height;

		if( $thumb_ratio > $original_ratio )
		{

				$thumb_w  = round( ( $thumb_height * $original_width) / $original_height );
				$thumb_h = $thumb_height;

		}
		elseif( $thumb_ratio < $original_ratio )
		{

				$thumb_w  = $thumb_width;
				$thumb_h = round( ( $thumb_width * $original_height ) / $original_width );

		}
		else
		{

				$thumb_w  = $thumb_width;
				$thumb_h  = $thumb_height;

		}

		//echo $thumb_w."-".$thumb_h;
		$new_img = ImageCreateTrueColor($thumb_w, $thumb_h);
		if($transparency) {
				if(preg_match('/png/i', $ext)) {
						imagealphablending($new_img, false);
						$colorTransparent = imagecolorallocatealpha($new_img, 0, 0, 0, 127);
						imagefill($new_img, 0, 0, $colorTransparent);
						imagesavealpha($new_img, true);
				} elseif(preg_match('/gif/i', $ext)) {
						$trnprt_indx = imagecolortransparent($img);
						if ($trnprt_indx >= 0) {
								//its transparent
								$trnprt_color = imagecolorsforindex($img, $trnprt_indx);
								$trnprt_indx = imagecolorallocate($new_img, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
								imagefill($new_img, 0, 0, $trnprt_indx);
								imagecolortransparent($new_img, $trnprt_indx);
						}
				}
		} else {
				Imagefill($new_img, 0, 0, imagecolorallocate($new_img, 255, 255, 255));
		}
		//imagecopyresampled($new_img, $img, 0,0,0,0, $thumb_w, $thumb_h, $old_x, $old_y);
		@imagecopyresampled($new_img, $img, 0,0,0,0, $thumb_w, $thumb_h, $original_width, $original_height);
		if($border) {
				$black = imagecolorallocate($new_img, 0, 0, 0);
				imagerectangle($new_img,0,0, $thumb_w, $thumb_h, $black);
		}
		if($base64) {
				ob_start();
				imagepng($new_img);
				$img = ob_get_contents();
				ob_end_clean();
				$return = base64_encode($img);
		} else {
				if(preg_match('/jpeg/i', $ext)) {
						imagejpeg($new_img, $newname);
						$return = true;
				} elseif( preg_match('/jpg/i', $ext)){
						imagejpeg($new_img, $newname);
						$return = true;
				} elseif(preg_match('/png/i', $ext)){
						imagepng($new_img, $newname);
						$return = true;
				} elseif(preg_match('/gif/i', $ext)) {
						imagegif($new_img, $newname);
						$return = true;
				}
				elseif(preg_match('/bmp/i', $ext)) {
						imagejpeg($new_img, $newname);
						$return = true;
				}
		}
		imagedestroy($new_img);
		imagedestroy($img);
		//@watermark($newname);
		return $return;
}
function order_status(){
	$status = array(
		'1'	=> 'Đơn hàng chờ thiết kế',
		'2'	=> 'Đơn hàng chờ in',
		'3'	=> 'Đang vận chuyển',
		'4'	=> 'Hoàn thành'
	);
	return $status;
}


function catchuoi($chuoi,$gioihan){

	// nếu độ dài chuỗi nhỏ hơn hay bằng vị trí cắt
	// thì không thay đổi chuỗi ban đầu
	if(strlen($chuoi)<=$gioihan){
		return $chuoi;
	}else{
		/* 
			so sánh vị trí cắt 
			với kí tự khoảng trắng đầu tiên trong chuỗi ban đầu tính từ vị trí cắt
			nếu vị trí khoảng trắng lớn hơn
			thì cắt chuỗi tại vị trí khoảng trắng đó
			*/
		if(strpos($chuoi," ",$gioihan) > $gioihan){
				$new_gioihan=strpos($chuoi," ",$gioihan);
				$new_chuoi = substr($chuoi,0,$new_gioihan)."...";
				return $new_chuoi;
		}
			// trường hợp còn lại không ảnh hưởng tới kết quả
			$new_chuoi = substr($chuoi,0,$gioihan)."...";
			return $new_chuoi;
	}
}

function order_detail($id){
	$CI =& get_instance();
	$CI->load->model('cms/M_orders');
	$CI->load->model('cms/M_deliveries');
	$get = $CI->M_orders->set('id',$id)->set('trash',0)->get();
	if($get){
		$delivery = $CI->M_deliveries->set('order_id',$id)->get();
		$get->ngay_giao = $delivery?$delivery->ngay_giao:date('d/m/Y');
	}
	return $get;
}

function upload_multiple($files,$folder){
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
	return $image_upload;
}
