<div class="container-fluid">
	<!-- Breadcrumbs-->
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="<?php echo site_url('size');?>">Kích thước</a>
		</li>
		<li class="breadcrumb-item active">Chi tiết Kích thước</li>
	</ol>
	<div class="card mb-3">
		<div class="card-header">
			<i class="fa fa-table"></i> Chi tiết Kích thước
		</div>
		<div class="card-body">
		<?php
			$err_op = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><a class="close" data-dismiss="alert" aria-label="Close">&times;</a>';
			$err_cl = '</div>';

			if(isset($_POST['formsubmit'])){
				if(isset($_GET['id'])){
					$link = $obj?site_url('size?act=upd&id='.$obj->id):site_url('size?act=upd');
				}else{
					$link = site_url('size?act=upd');
				}
				
			}else{
				$link = $obj?site_url('size?act=upd&id='.$obj->id):site_url('size?act=upd');
			}

			$form = array('id'=>'vai');
			echo form_open($link,$form);

			echo form_fieldset('',array('class'=>'col-md-6'));
			$opt = array('class'=>'form-control text-uppercase','value'=>$obj?$obj->size:'','name'=>'size');
			echo '<div class="form-group">'
				.form_label('Kích thước','size')
				.form_input($opt,set_value('size'))
				.form_error('size',$err_op,$err_cl)
				.'</div>';

			$opt = array('id'=>'content','name'=>'content','class'=>'form-control','value'=>$obj?$obj->content:'');
			echo '<div class="form-group">'
				.form_label('Mô tả','content')
				.form_textarea($opt)
				.'</div>';

			$opt = array('id'=>'sort','name'=>'sort','class'=>'form-control','value'=>$obj?$obj->sort:($tong->sort+1),'type'=>'number');
			echo '<div class="form-group">'
				.form_label('Sắp xếp','sort')
				.form_input($opt)
				.'</div>';

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