<style type="text/css">
	.download-files{font-size: 55px;}
	.download-files:hover{text-decoration:none}
	.pay_online{display:none}
	.pay_online span{font-size:30px;margin-top:0.5rem;}
	.tiencoc{margin-top:0.5rem;}
</style>
<div class="container-fluid">
	<!-- Breadcrumbs-->
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="<?php echo site_url('orders');?>">Kinh doanh</a>
		</li>
		<li class="breadcrumb-item">
			<a href="<?php echo site_url('orders');?>">Đơn hàng</a>
		</li>
		<li class="breadcrumb-item active">Đơn hàng mới</li>
	</ol>
	<div class="card mb-3">
		<div class="card-header">
			<i class="fa fa-table"></i> Chi tiết đơn hàng
		</div>
		<div class="card-body">
		<?php
			if(isset($_POST['formsubmit'])){
				$link = site_url('orders?act=upd');
			}else{
				$link = $obj?site_url('orders?act=upd&id='.$_GET['id'].'&token='.$system->token):site_url('orders?act=upd');
			}

			$err_op = '<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert" aria-label="Close">&times;</a>';
			$err_cl = '</div>';
			$form = array('id'=>'orders','name'=>'orders');
			echo form_open_multipart($link,$form);

			$col3 = array('class'=>'col-md-3 left');
			$col4 = array('class'=>'col-md-4 left');
			$col7 = array('class'=>'col-md-7 left');
			$col5 = array('class'=>'col-md-5 left');

			echo form_fieldset('',$col7);

			$opt = array('id'=>'code','name'=>'code','class'=>'form-control','readonly'=>true,'value'=>$obj?$obj->order_code:'');
			echo '<div class="form-group">'
				.form_label('Mã đơn hàng','code')
				//.form_input($opt)
				.form_input($opt,set_value('code'))
				.form_error('code',$err_op,$err_cl)
				.'</div>';

			$opt = array('id'=>'cotton','name'=>'cotton','class'=>'form-control');
			echo '<div class="form-group">'
				.form_label('Loại vải','cotton')
				.form_dropdown($opt,$cottons,set_value('cotton',($obj?$obj->cotton:0)))
				.form_error('cotton',$err_op,$err_cl)
				.'</div>';

			$opt = array('id'=>'color','name'=>'color','class'=>'form-control','value'=>$obj?$obj->color:'');
			echo '<div class="form-group">'
				.form_label('Màu sắc','color')
				//.form_dropdown($opt,$color,set_value('color'))
				.form_input($opt,set_value('color'))
				.form_error('color',$err_op,$err_cl)
				.'</div>';

			echo form_fieldset_close();

			echo form_fieldset('',$col5);
			echo '<div class="form-group">'
				.form_label('Hình','image');
			$images = json_decode($obj?$obj->images:'[]');
			?>
			<ul id="media-list" class="clearfix">
				<?php if(!empty($images)){
					foreach ($images as $key => $img) {
				?>
				<li>
					<img src="<?php echo base_url('assets/public/orders/'.date('Ymd',strtotime($obj->order_date)).'/'.$img)?>"/>
					<div class="post-thumb"><div class="inner-post-thumb"><a href="javascript:void(0);" data-id="<?php echo $img;?>" class="remove-pic img_delete"><i class="fa fa-times" aria-hidden="true"></i></a><div></div></div></div>
				</li>
				<?php
					}
				} ?>
				<input type="hidden" name="img_delete" value="" id="img_delete"/>
				<li class="myupload">
					<span>
						<i class="fa fa-plus" aria-hidden="true"></i>
						<input click-type="type2" id="picupload" class="picupload" name="files[]" accept="image/*" type="file" multiple style="width:102px;cursor: pointer;">
					</span>
				</li>
			</ul>
			<?php
			echo '</div>';
			
			echo form_fieldset_close();

			//echo '</div>';

			echo form_fieldset('',array('class'=>'col-md-12'));
			echo '<div class="form-group">'
				.form_label('Kích thước')
				.'<div class="clear"></div>';
			$gszie = json_decode($obj?$obj->size:'[]');
			foreach($size as $key=>$rz){
				$opt = array("name"=>"size[$rz]",'style'=>'width:75px;float:left;margin:0 15px 15px 0;padding:0.375rem 0.75rem;','placeholder'=>strtoupper($rz),'value'=>$obj?$gszie->$rz:'' );
				echo form_input($opt);
			}
			echo '</div>';

			echo form_fieldset_close();

			echo form_fieldset('',$col4);
			echo '<div class="form-group">'
				.form_label('Bụng','bung')
				.form_input('bung',set_value('bung',$obj?$obj->bung:''),array('class'=>'form-control'))
				.'</div>';
			echo form_fieldset_close();

			echo form_fieldset('',$col4);
			echo '<div class="form-group">'
				.form_label('Cổ','co')
				.form_input('co',set_value('co',$obj?$obj->co:''),array('class'=>'form-control'))
				.'</div>';
			echo form_fieldset_close();

			echo form_fieldset('',$col4);
			echo '<div class="form-group">'
				.form_label('Tay','tay')
				.form_input('tay',set_value('tay',$obj?$obj->tay:''),array('class'=>'form-control'))
				.'</div>';
			echo form_fieldset_close();

			echo form_fieldset('',$col4);
			echo '<div class="form-group">'
				.form_label('Hông','hong')
				.form_input('hong',set_value('hong',$obj?$obj->hong:''),array('class'=>'form-control'))
				.'</div>';
			echo form_fieldset_close();

			echo form_fieldset('',$col4);
			echo '<div class="form-group">'
				.form_label('Lai áo','lai_ao')
				.form_input('lai_ao',set_value('lai_ao',$obj?$obj->lai_ao:''),array('class'=>'form-control'))
				.'</div>';
			echo form_fieldset_close();

			echo form_fieldset('',$col4);
			echo '<div class="form-group">'
				.form_label('Quần','quan')
				.form_input('quan',set_value('quan',$obj?$obj->quan:''),array('class'=>'form-control'))
				.'</div>';
			echo form_fieldset_close();

			echo '<div class="clearfix"></div>';

			echo form_fieldset('',$col4);
			$data = array(
				'name'		=> 'design_front',
				'id'		=> 'design_front',
				'style'		=> 'margin:10px 10px 10px 0',
			);
			echo '<div class="form-group">'
				.form_checkbox($data,1,$obj?$obj->front:0)
				.form_label('Thiết kế mặt trước','design_front')
				.'</div>';
			echo form_fieldset_close();

			echo form_fieldset('',$col4);
			$data = array(
				'name'		=> 'design_back',
				'id'		=> 'design_back',
				'style'		=> 'margin:10px 10px 10px 0'
			);
			echo '<div class="form-group">'
				.form_checkbox($data,1,$obj?$obj->back:0)
				.form_label('Thiết kế mặt sau','design_back')
				.'</div>';
			echo form_fieldset_close();

			echo form_fieldset('',$col4);
			$data = array(
				'name'		=> 'design_tleft',
				'id'		=> 'design_tleft',
				'style'		=> 'margin:10px 10px 10px 0'
			);
			echo '<div class="form-group">'
				.form_checkbox($data,1,$obj?$obj->hand_left:0)
				.form_label('Thiết kế tay trái','design_tleft')
				.'</div>';
			echo form_fieldset_close();

			echo form_fieldset('',$col4);
			$data = array(
				'name'		=> 'design_tright',
				'id'		=> 'design_tright',
				'style'		=> 'margin:10px 10px 10px 0'
			);
			echo '<div class="form-group">'
				.form_checkbox($data,1,$obj?$obj->hand_right:0)
				.form_label('Thiết kế tay phải','design_tright')
				.'</div>';
			echo form_fieldset_close();

			echo form_fieldset('',$col4);
			$data = array(
				'name'		=> 'design_qleft',
				'id'		=> 'design_qleft',
				'style'		=> 'margin:10px 10px 10px 0'
			);
			echo '<div class="form-group">'
				.form_checkbox($data,1,$obj?$obj->shorts_left:0)
				.form_label('Thiết kế quần bên trái','design_qleft')
				.'</div>';
			echo form_fieldset_close();

			echo form_fieldset('',$col4);
			$data = array(
				'name'		=> 'design_qright',
				'id'		=> 'design_qright',
				'style'		=> 'margin:10px 10px 10px 0'
			);
			echo '<div class="form-group">'
				.form_checkbox($data,1,$obj?$obj->shorts_right:0)
				.form_label('Thiết kế quần bên phải','design_qright')
				.'</div>';
			echo form_fieldset_close();

			echo '<div class="clearfix"></div>';

			echo form_fieldset('',$col4);
			$data = array(
				'name'		=> 'in_lua',
				'id'		=> 'in_lua',
				'style'		=> 'margin:10px 10px 10px 0'
			);
			echo '<div class="form-group">'
				.form_checkbox($data,1,$obj?$obj->in_lua:0)
				.form_label('In lụa','in_lua')
				.'</div>';
			echo form_fieldset_close();

			echo form_fieldset('',$col4);
			$data = array(
				'name'		=> 'in_nhiet',
				'id'		=> 'in_nhiet',
				'style'		=> 'margin:10px 10px 10px 0'
			);
			echo '<div class="form-group">'
				.form_checkbox($data,1,($obj?$obj->in_nhiet:0))
				.form_label('In nhiệt','in_nhiet')
				.'</div>';
			echo form_fieldset_close();

			echo form_fieldset('',$col4);
			$data = array(
				'name'		=> 'in_decal',
				'id'		=> 'in_decal',
				'style'		=> 'margin:10px 10px 10px 0'
			);
			echo '<div class="form-group">'
				.form_checkbox($data,1,$obj?$obj->in_decal:0)
				.form_label('In decal','in_decal')
				.'</div>';
			echo form_fieldset_close();

			echo '<div class="clearfix"></div>';

			echo form_fieldset('',$col4);
			/*$opt = array('id'=>'file_print','name'=>'file_print','class'=>'form-control','type'=>'file','accept'=>'.csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel,');*/
			$opt = array('id'=>'file_print','name'=>'file_print','class'=>'form-control','type'=>'file');
			echo '<div class="form-group">'
				.form_label('File in','file_print')
				.form_input($opt,set_value('file_print'))
				.form_error('file_print',$err_op,$err_cl)
				.'</div>';
			echo form_fieldset_close();

			if($obj && !empty($obj->files)){
				//var_dump($obj->files);
				echo form_fieldset('',$col4);
				echo '<div class="form-group">
						<a href="'.site_url('download.php?f='.$obj->files.'&d='.date('Ymd',strtotime($obj->order_date))).'" class="download-files">
							<i class="fa fa-file"></i>
							<span style="font-size:1rem">'.catchuoi($obj->files,25).'</span>
						</a>
					</div>
				';
				echo form_fieldset_close();
			}
			echo '<div class="clearfix"></div>';
			echo form_fieldset('',$col4);
			echo '<div class="form-group">'
				.form_label('Tổng tiền in (thêm)','tien_in_them')
				.form_input('tien_in_them',set_value('tien_in_them',$obj?$obj->sum_print:''),array('class'=>'form-control'))
				.'</div>';
			echo form_fieldset_close();

			echo '<div class="clearfix"></div>';
			//echo '<div class="col-md-12">';

			echo form_fieldset('',$col3);
			echo '<div class="form-group">'
				.form_label('Tên khách hàng','customer_name')
				.form_input('customer_name',set_value('customer_name',$obj?$obj->fullname:''),array('class'=>'form-control'))
				.'</div>';
			echo form_fieldset_close();

			echo form_fieldset('',$col3);
			echo '<div class="form-group">'
				.form_label('Số điện thoại','customer_phone')
				.form_input('customer_phone',set_value('customer_phone',$obj?$obj->phone:''),array('class'=>'form-control'))
				.'</div>';
			echo form_fieldset_close();

			echo form_fieldset('',$col3);

			$cus_date = array('name'=>'customer_date','type'=>'date');
			echo '<div class="form-group">'
				.form_label('Ngày giao hàng','customer_date')
				.form_input($cus_date,set_value('customer_date',($obj?$obj->ngay_giao:date('Y-m-d'))),array('class'=>'form-control'))
				.'</div>';
			echo form_fieldset_close();
			echo '<div class="clearfix"></div>';
			echo form_fieldset('',$col3);
			echo '<div class="form-group">'
				.form_label('Địa chỉ','customer_add')
				.form_textarea(array('class'=>'form-control','rows'=>'4','name'=>'customer_add','value'=>$obj?$obj->address:''))
				.'</div>';
			echo form_fieldset_close();

			echo form_fieldset('',$col3);
			echo '<div class="form-group">'
				.form_label('Chành xe','customer_gui_xe')
				.form_textarea(array('class'=>'form-control','rows'=>'4','name'=>'customer_gui_xe','value'=>$obj?$obj->truck:''))
				.'</div>';
			echo form_fieldset_close();

			echo '<div class="clearfix"></div>';

			echo form_fieldset('',$col4);
			$opt = array('id'=>'status','name'=>'status','class'=>'form-control');
			echo '<div class="form-group">'
				.form_label('Trạng thái đơn hàng','cotton')
				.form_dropdown($opt,$status,set_value('cotton',($obj?$obj->status:0)))
				.form_error('cotton',$err_op,$err_cl)
				.'</div>';

			$data = array(
				'name'		=> 'uu_tien',
				'id'		=> 'uu_tien',
				'style'		=> 'margin:10px 10px 10px 0;color:red'
			);
			echo '<div class="form-group">'
				.form_checkbox($data,1,$obj?$obj->uu_tien:0)
				.form_label('Đơn hàng ưu tiên','uu_tien',array('style'=>'color:red;font-weight:bolder;cursor:pointer'))
				.'</div>';
			echo form_fieldset_close();
			echo '<div class="clearfix"></div>';

			echo form_fieldset('',$col3);
			echo '<div class="form-group">'
				.form_label('Tổng tiền SX','tiensx')
				.form_input('tiensx',set_value('tiensx',$obj?$obj->tiensx:''),array('class'=>'form-control'))
				.'</div>';
			echo form_fieldset_close();

			echo form_fieldset('',$col3);
			echo '<div class="form-group">'
				.form_label('Tổng tiền bán','sum_order')
				.form_input('sum_order',set_value('sum_order',$obj?$obj->sum_order:''),array('class'=>'form-control'))
				.'</div>';
			echo form_fieldset_close();

			echo form_fieldset('',$col3);
			$cbx = array(
				'name'	=>	'co_coc',
				'id'	=>	'co_coc'
			);
			echo '<div class="form-group">'
				.'<label style="cursor:pointer;color:blue">'
				.form_checkbox($cbx,1,$obj?$obj->tiencoc:'')
				.'Tiền cọc'
				.'</lable>'
				.'<div class="tiencoc">'
				.form_input('tiencoc',set_value('tiencoc',$obj?$obj->tiencoc:''),array('class'=>'form-control','disabled'=>'true','id'=>'mcoc'))
				.'</div>'
				.'</div>';
			echo form_fieldset_close();

			echo '<div class="clearfix"></div>';

			echo form_fieldset('',$col3);
			$cbx = array(
				'name'	=>	'pay_online',
				'id'	=>	'pay_online'
			);
			echo '<div class="form-group">'
				.'<label style="cursor:pointer;color:blue">'
				.form_checkbox($cbx,1,$obj?$obj->pay_online:0)
				.'Chuyển khoản'
				.'</lable>'
				.'</div>';
			echo form_fieldset_close();

			echo form_fieldset('',$col3);
			$cbx = array(
				'name'	=>	'cong_no',
				'id'	=>	'cong_no'
			);
			echo '<div class="form-group">'
				.'<label style="cursor:pointer;color:blue">'
				.form_checkbox($cbx,1,$obj?$obj->cong_no:0)
				.'Công nợ'
				.'</lable>'
				.'</div>';
			echo form_fieldset_close();

			echo form_fieldset('',array('class'=>'col-md-12'));
			echo '<div class="form-group">'
				.form_submit('formsubmit', 'Lưu',array('class'=>'btn btn-primary'))
				.anchor('orders', 'Hủy',array('class'=>'btn btn-secondary'))
				.'</div>';
			echo form_fieldset_close();
			
			echo form_close();
		?>
		</div>
	</div>
</div>
<script type="text/javascript">
	var coc = <?php echo $obj?$obj->cc_coc:0?>;
	if(coc==1){
		$('.tiencoc #mcoc').removeAttr('disabled');
	}
	var img_del = [];
	$(document).on('click','.img_delete',function(){
		pic = $(this).attr('data-id');
		img_del.push(pic);
		$('input#img_delete').val(JSON.stringify(img_del));
	});

	$("#co_coc").change(function() {
		if($(this).is( ":checked" )){
			$('.tiencoc #mcoc').removeAttr('disabled');
		}else{
			$('.tiencoc #mcoc').attr('disabled','true');
		}
	}).change();

	$("#pay_online").change(function() {
		if($(this).is( ":checked" )){
			$('input#cong_no').prop('checked', false);
		}
	}).change();

	$("#cong_no").change(function() {
		if($(this).is( ":checked" )){
			$('input#pay_online').prop('checked', false);
		}
	}).change();
</script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugin/media-upload/css/media-upload.css')?>">
<script type="text/javascript" src="<?php echo base_url('assets/plugin/media-upload/js/media-upload.js')?>"></script>