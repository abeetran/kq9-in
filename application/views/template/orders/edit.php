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
				if(isset($_GET['id']) && $_GET['id'] > 0){
					$link = $obj?site_url('orders?act=upd&id='.$obj->id):site_url('orders?act=upd');
				}else{
					$link = site_url('orders?act=upd');
				}
				
			}else{
				$link = $obj?site_url('orders?act=upd&id='.$obj->id):site_url('orders?act=upd');
			}

			$err_op = '<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert" aria-label="Close">&times;</a>';
			$err_cl = '</div>';
			$form = array('id'=>'orders','name'=>'orders');
			echo form_open_multipart($link,$form);
			$col3 = array('class'=>'col-md-3 left');
			$col4 = array('class'=>'col-md-4 left');
			$col8 = array('class'=>'col-md-8 left');
			echo '<div class="col-md-12">';

			echo form_fieldset('',$col8);

			$opt = array('id'=>'code','name'=>'code','class'=>'form-control','value'=>$obj?$obj->code:'');
			echo '<div class="form-group">'
				.form_label('Mã đơn hàng','code')
				.form_input($opt,set_value('code'))
				.form_error('code',$err_op,$err_cl)
				.'</div>';

			$opt = array('id'=>'cotton','name'=>'cotton','class'=>'form-control');
			echo '<div class="form-group">'
				.form_label('Loại vải','cottons')
				.form_dropdown($opt,$cottons,set_value('cotton'),$obj?$obj->cotton:'')
				.'</div>';

			$opt = array('id'=>'color','name'=>'color','class'=>'form-control');
			echo '<div class="form-group">'
				.form_label('Màu sắc','color')
				.form_dropdown($opt,$color,set_value('color'),$obj?$obj->color:'')
				.'</div>';

			echo form_fieldset_close();

			echo '</div>';
			echo '<div class="col-md-12">';
			echo form_fieldset('',$col4);
			$opt = array('id'=>'image','name'=>'image','class'=>'form-control','type'=>'file');
			echo '<div class="form-group">'
				.form_label('Hình đại diện','image')
				.form_input($opt,set_value('image'))
				.form_error('image',$err_op,$err_cl)
				.'</div>';

			$opt = array('id'=>'imgfront','name'=>'imgfront','class'=>'form-control','type'=>'file');
			echo '<div class="form-group">'
				.form_label('Mặt trước','imgfront')
				.form_input($opt,set_value('imgfront'))
				.form_error('imgfront',$err_op,$err_cl)
				.'</div>';

			$opt = array('id'=>'imgback','name'=>'imgback','class'=>'form-control','type'=>'file');
			echo '<div class="form-group">'
				.form_label('Mặt sau','imgback')
				.form_input($opt,set_value('imgback'))
				.form_error('imgback',$err_op,$err_cl)
				.'</div>';

			echo form_fieldset_close();

			echo '</div>';

			echo form_fieldset('',array('class'=>'col-md-12'));
			echo '<div class="form-group"><div>'
				.form_label('Kích thước')
				.'<div class="clear"></div>';
			foreach($size as $key=>$rz){
				$opt = array("name"=>"size[$rz]",'style'=>'width:75px;float:left;margin:0 15px 15px 0;padding:0.375rem 0.75rem;','placeholder'=>strtoupper($rz));
				echo form_input($opt);
			}
			echo '</div><div style="clear:both"></div>';
			echo $sl_err?$err_op.$sl_err.$err_cl:'';
			echo '</div>';

			echo form_fieldset_close();

			echo form_fieldset('',$col4);
			echo '<div class="form-group">'
				.form_label('Bụng','bung')
				.form_input('bung',set_value('bung'),array('class'=>'form-control','value'=>$obj?$obj->bung:''))
				.'</div>';
			echo form_fieldset_close();

			echo form_fieldset('',$col4);
			echo '<div class="form-group">'
				.form_label('Cổ','co')
				.form_input('co',set_value('co'),array('class'=>'form-control','value'=>$obj?$obj->co:''))
				.'</div>';
			echo form_fieldset_close();

			echo form_fieldset('',$col4);
			echo '<div class="form-group">'
				.form_label('Tay','tay')
				.form_input('tay',set_value('tay'),array('class'=>'form-control','value'=>$obj?$obj->tay:''))
				.'</div>';
			echo form_fieldset_close();

			echo form_fieldset('',$col4);
			echo '<div class="form-group">'
				.form_label('Hông','hong')
				.form_input('hong',set_value('hong'),array('class'=>'form-control','value'=>$obj?$obj->hong:''))
				.'</div>';
			echo form_fieldset_close();

			echo form_fieldset('',$col4);
			echo '<div class="form-group">'
				.form_label('Lai áo','lai_ao')
				.form_input('lai_ao',set_value('lai_ao'),array('class'=>'form-control','value'=>$obj?$obj->lai_ao:''))
				.'</div>';
			echo form_fieldset_close();

			echo form_fieldset('',$col4);
			echo '<div class="form-group">'
				.form_label('Quần','quan')
				.form_input('quan',set_value('quan'),array('class'=>'form-control','value'=>$obj?$obj->quan:''))
				.'</div>';
			echo form_fieldset_close();
			echo '</div>';

			echo form_fieldset('',$col4);
			echo '<div class="form-group">'
				.form_label('Tổng tiền','sum_money')
				.form_input('sum_money',set_value('sum_money'),array('class'=>'form-control','value'=>$obj?$obj->sum_money:''))
				.'</div>';
			echo form_fieldset_close();

			echo form_fieldset('',$col4);
			echo '<div class="form-group">'
				.form_label('Tổng tiền in thân','sum_in_than')
				.form_input('sum_in_than',set_value('sum_in_than'),array('class'=>'form-control','value'=>$obj?$obj->sum_in_than:''))
				.'</div>';
			echo form_fieldset_close();

			echo '<div class="col-md-12">';

			echo form_fieldset('',$col3);
			$data = array(
				'name'		=> 'design_front',
				'id'		=> 'design_front',
				'value'		=> 1,
				'style'		=> 'margin:10px 10px 10px 0',
				'checked'	=> $obj&&isset($obj->design_front)?$obj->design_front:0
			);
			echo '<div class="form-group">'
				.form_checkbox($data)
				.form_label('Thiết kế mặt trước','design_front')
				.'</div>';
			echo form_fieldset_close();

			echo form_fieldset('',$col3);
			$data = array(
				'name'		=> 'design_back',
				'id'		=> 'design_back',
				'value'		=> 1,
				'style'		=> 'margin:10px 10px 10px 0',
				'checked'	=> $obj&&isset($obj->design_back)?$obj->design_back:0
			);
			echo '<div class="form-group">'
				.form_checkbox($data)
				.form_label('Thiết kế mặt sau','design_back')
				.'</div>';
			echo form_fieldset_close();

			echo form_fieldset('',$col3);
			$data = array(
				'name'		=> 'design_left',
				'id'		=> 'design_left',
				'value'		=> 1,
				'style'		=> 'margin:10px 10px 10px 0',
				'checked'	=> $obj&&isset($obj->design_left)?$obj->design_left:0
			);
			echo '<div class="form-group">'
				.form_checkbox($data)
				.form_label('Thiết kế tay trái','design_tleft')
				.'</div>';
			echo form_fieldset_close();

			echo form_fieldset('',$col3);
			$data = array(
				'name'		=> 'design_right',
				'id'		=> 'design_right',
				'value'		=> 1,
				'style'		=> 'margin:10px 10px 10px 0',
				'checked'	=> $obj&&isset($obj->design_right)?$obj->design_right:0
			);
			echo '<div class="form-group">'
				.form_checkbox($data)
				.form_label('Thiết kế tay phải','design_tright')
				.'</div>';
			echo form_fieldset_close();

			echo form_fieldset('',$col3);
			$data = array(
				'name'		=> 'design_qleft',
				'id'		=> 'design_qleft',
				'value'		=> 1,
				'style'		=> 'margin:10px 10px 10px 0',
				'checked'	=> $obj&&isset($obj->design_qleft)?$obj->design_qleft:0
			);
			echo '<div class="form-group">'
				.form_checkbox($data)
				.form_label('Thiết kế quần bên trái','design_qleft')
				.'</div>';
			echo form_fieldset_close();

			echo form_fieldset('',$col3);
			$data = array(
				'name'		=> 'design_qright',
				'id'		=> 'design_qright',
				'value'		=> 1,
				'style'		=> 'margin:10px 10px 10px 0',
				'checked'	=> $obj&&isset($obj->design_qright)?$obj->design_qright:0
			);
			echo '<div class="form-group">'
				.form_checkbox($data)
				.form_label('Thiết kế quần bên phải','design_qright')
				.'</div>';
			echo form_fieldset_close();

			echo form_fieldset('',$col3);
			$data = array(
				'name'		=> 'in_lua',
				'id'		=> 'in_lua',
				'value'		=> 1,
				'style'		=> 'margin:10px 10px 10px 0',
				'checked'	=> $obj&&isset($obj->in_lua)?$obj->in_lua:0
			);
			echo '<div class="form-group">'
				.form_checkbox($data)
				.form_label('In lụa','in_lua')
				.'</div>';
			echo form_fieldset_close();

			echo form_fieldset('',$col3);
			$data = array(
				'name'		=> 'in_nhiet',
				'id'		=> 'in_nhiet',
				'value'		=> 1,
				'style'		=> 'margin:10px 10px 10px 0',
				'checked'	=> $obj&&isset($obj->in_nhiet)?$obj->in_nhiet:0
			);
			echo '<div class="form-group">'
				.form_checkbox($data)
				.form_label('In nhiệt','in_nhiet')
				.'</div>';
			echo form_fieldset_close();

			echo form_fieldset('',$col3);
			$data = array(
				'name'		=> 'in_decal',
				'id'		=> 'in_decal',
				'value'		=> 1,
				'style'		=> 'margin:10px 10px 10px 0',
				'checked'	=> $obj&&isset($obj->in_decal)?$obj->in_decal:0
			);
			echo '<div class="form-group">'
				.form_checkbox($data)
				.form_label('In decal','in_decal')
				.'</div>';
			echo form_fieldset_close();

			echo '</div>';

			echo form_fieldset('',$col4);
			echo '<div class="form-group">'
				.form_label('Tổng tiền in (thêm)','tien_in_them')
				.form_input('tien_in_them',set_value('tien_in_them'),array('class'=>'form-control','value'=>$obj?$obj->tien_in_them:''))
				.'</div>';
			echo form_fieldset_close();

			echo '<div class="col-md-12">';

			echo form_fieldset('',$col3);
			echo '<div class="form-group">'
				.form_label('Tên khách hàng','customer_name')
				.form_input('customer_name',set_value('customer_name'),array('class'=>'form-control','value'=>$obj?$obj->customer_name:''))
				.'</div>';
			echo form_fieldset_close();

			echo form_fieldset('',$col3);
			echo '<div class="form-group">'
				.form_label('Số điện thoại','customer_phone')
				.form_input('customer_phone',set_value('customer_phone'),array('class'=>'form-control','value'=>$obj?$obj->customer_phone:''))
				.'</div>';
			echo form_fieldset_close();

			echo form_fieldset('',$col3);
			echo '<div class="form-group">'
				.form_label('Địa chỉ','customer_add')
				.form_textarea(array('class'=>'form-control','rows'=>'4','name'=>'customer_add','value'=>$obj?$obj->customer_add:''))
				.'</div>';
			echo form_fieldset_close();

			echo form_fieldset('',$col3);
			echo '<div class="form-group">'
				.form_label('Chành xe','customer_gui_xe')
				.form_textarea(array('class'=>'form-control','rows'=>'4','name'=>'customer_gui_xe','value'=>$obj?$obj->customer_gui_xe:''))
				.'</div>';
			echo form_fieldset_close();

			echo '</div>';
			echo form_fieldset('',array('class'=>'col-md-12'));
			echo '<div class="form-group">'
				.form_submit('formsubmit', 'Lưu',array('class'=>'btn btn-primary'))
				.anchor('size', 'Hủy',array('class'=>'btn btn-secondary'))
				.'</div>';
			echo form_fieldset_close();
			echo form_close();
		?>
		</div>
	</div>
</div>