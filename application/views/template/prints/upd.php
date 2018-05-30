<div class="container-fluid">
	<!-- Breadcrumbs-->
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="#">Kinh doanh</a>
		</li>
		<li class="breadcrumb-item active">Thiết kế</li>
	</ol>
	<!-- Example DataTables Card-->
	<div class="card mb-3">
		<div class="card-header">
			<i class="fa fa-table"></i> Chi tiết thiết kế
		</div>
		<div class="card-body">
			<div class="col-md-6 left">
				<div class="form-group" style="<?php echo $obj->uu_tien==1?'color:red':''?>">
					<label><strong>Đơn hàng: <?php echo $obj->order_code;?></strong></label>
				</div>
				<div class="form-group" style="<?php echo $obj->uu_tien==1?'color:red':''?>">
					<label><strong>Ngày giao: <?php echo $obj->ngay_giao;?></strong></label>
				</div>
				<div class="form-group">
					<label><strong>Kiểu in:</strong></label>
					<div class="clearfix"></div>
					<?php if($obj->in_lua !=''){?>
					<div class="col-md-4">
						<label><strong>In lụa</strong></label>
					</div>
					<?php }?>
					<?php if($obj->in_nhiet !=''){?>
					<div class="col-md-4">
						<label><strong>In nhiệt</strong></label>
					</div>
					<?php }?>
					<?php if($obj->in_decal !=''){?>
					<div class="col-md-4">
						<label><strong>In decal</strong></label>
					</div>
					<?php }?>
				</div>
			</div>
			<div class="col-md-6 left">
				<div class="form-group request" style="margin-top:1rem">
					<label><strong>Nội dung in:</strong></label>
					<div class="clearfix"></div>
					<ul id="media-list" class="clearfix">
						<?php $images = json_decode($obj?$obj->images:'[]'); if(!empty($images)){
							foreach ($images as $key => $img) {
						?>
						<li>
							<a href="<?php echo site_url('download.php?f='.$img.'&d='.$obj->folder);?>">
								<img src="<?php echo base_url('assets/public/orders/'.date('Ymd').'/'.$img)?>"/>
							</a>
						</li>
						<?php
							}
						} ?>
					</ul>
					<?php
					echo '<div class="form-group">
							<a href="'.site_url('download.php?f='.$obj->files.'&d='.$obj->folder).'" class="download-files">
								<i class="fa fa-file"></i>
								<span style="font-size:1rem">'.catchuoi($obj->files,25).'</span>
							</a>
						</div>
					';
					?>
				</div>
			</div>
			<div class="clearfix" style="min-height: 1rem"></div>
			<div class="form-group" style="margin-top:1rem">
				<label><strong>Chuyển giao hàng </strong></label>
				<div class="clearfix"></div>
				<form action="<?php echo site_url('prints?act=upd&id='.$_GET['id'].'&order='.$_GET['order'].'&token='.$system->token)?>" method="post" id="form" enctype="multipart/form-data">
					<?php if(isset($_SESSION['msg'])){?>
					<div class="form-group">
						<strong><?php echo message('div','error',$_SESSION['msg']);unset($_SESSION['msg']);?></strong>
					</div>
					<?php }?>
					
					<div class="form-group">
						<label>
							<input type="checkbox" name="status" value="3" >&nbsp;Đã giao hàng
						</label>
					</div>
					<div class="form-group">
						<input type="submit" name="formsubmit" value="Cập nhật" class="btn btn-primary" />
						<?php echo anchor('prints', 'Hủy',array('class'=>'btn btn-secondary'));?>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugin/media-upload/css/media-upload.css')?>">
<script type="text/javascript" src="<?php echo base_url('assets/plugin/media-upload/js/media-upload.js')?>"></script>
<script type="text/javascript">
	var img_del = [];
	$(document).on('click','.img_delete',function(){
		pic = $(this).attr('data-id');
		img_del.push(pic);
		$('input#img_delete').val(JSON.stringify(img_del));
	});
</script>
<style type="text/css">
	.download-files{font-size: 80px;}
	.download-files:hover{text-decoration:none}
</style>