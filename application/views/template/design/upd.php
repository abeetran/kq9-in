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
			<div class="form-group" style="<?php echo $obj->uu_tien==1?'color:red':''?>">
				<label><strong>Đơn hàng: <?php echo $obj->order_code;?></strong></label>
			</div>
			<div class="form-group" style="<?php echo $obj->uu_tien==1?'color:red':''?>">
				<label><strong>Ngày giao: <?php echo $obj->ngay_giao;?></strong></label>
			</div>
			<div class="form-group">
				<label><strong>Nội dung thiết kế:</strong></label>
				<div class="clearfix"></div>
				<?php if($obj->bung !=''){?>
				<div class="col-md-4 left">
					<label><strong>Bụng:</strong> <?php echo $obj->bung?></label>
				</div>
				<?php }?>
				<?php if($obj->co !=''){?>
				<div class="col-md-4 left">
					<label><strong>Cổ:</strong> <?php echo $obj->co?></label>
				</div>
				<?php }?>
				<?php if($obj->tay !=''){?>
				<div class="col-md-4 left">
					<label><strong>Tay:</strong> <?php echo $obj->tay?></label>
				</div>
				<?php }?>
				<?php if($obj->hong !=''){?>
				<div class="col-md-4 left">
					<label><strong>Hông:</strong> <?php echo $obj->hong?></label>
				</div>
				<?php }?>
				<?php if($obj->lai_ao !=''){?>
				<div class="col-md-4 left">
					<label><strong>Lai áo:</strong> <?php echo $obj->lai_ao?></label>
				</div>
				<?php }?>
				<?php if($obj->quan !=''){?>
				<div class="col-md-4 left">
					<label><strong>Quần:</strong> <?php echo $obj->quan?></label>
				</div>
				<?php }?>
			</div>
			<div class="clearfix" style="min-height: 1rem"></div>
			<div class="form-group request" style="margin-top:1rem">
				<label><strong>Yêu cầu thiết kế:</strong></label>
				<div class="clearfix"></div>
				<?php if($obj->front == 1){?>
				<div class="col-md-4 left">
					<u>Thiết kế Mặt trước</u>
				</div>
				<?php }?>
				<?php if($obj->back == 1){?>
				<div class="col-md-4 left">
					<u>Thiết kế Mặt sau</u>
				</div>
				<?php }?>
				<?php if($obj->hand_left == 1){?>
				<div class="col-md-4 left">
					<u>Thiết kế Tay trái</u>
				</div>
				<?php }?>
				<?php if($obj->hand_right == 1){?>
				<div class="col-md-4 left">
					<u>Thiết kế Tay phải</u>
				</div>
				<?php }?>
				<?php if($obj->shorts_left == 1){?>
				<div class="col-md-4 left">
					<u>Thiết kế Ống quần bên trái</u>
				</div>
				<?php }?>
				<?php if($obj->shorts_right == 1){?>
				<div class="col-md-4 left">
					<u>Thiết kế Ống quần bên phải</u>
				</div>
				<?php }?>
			</div>
			<div class="clearfix" style="min-height: 1rem"></div>
			<div class="form-group" style="margin-top:1rem">
				<label><strong>Cập nhật thiết kế</strong></label>
				<div class="clearfix"></div>
				<form action="<?php echo site_url('design?act=upd&id='.$_GET['id'].'&order='.$_GET['order'].'&token='.$system->token)?>" method="post" id="form" enctype="multipart/form-data">
					<?php if(isset($_SESSION['msg'])){?>
					<div class="form-group">
						<strong><?php echo message('div','error',$_SESSION['msg']);unset($_SESSION['msg']);?></strong>
					</div>
					<?php }?>
					<div class="form-group">
						<ul id="media-list" class="clearfix">
							<?php $images = json_decode($obj?$obj->images:'[]'); if(!empty($images)){
								foreach ($images as $key => $img) {
							?>
							<li>
								<img src="<?php echo base_url('assets/public/orders/'.date('Ymd').'/'.$img)?>"/>
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
					</div>
					<div class="form-group">
						<label>
							<input type="checkbox" name="status" value="2" >&nbsp;Chuyển in
						</label>
					</div>
					<div class="form-group">
						<input type="submit" name="formsubmit" value="Cập nhật" class="btn btn-primary" />
						<?php echo anchor('design', 'Hủy',array('class'=>'btn btn-secondary'));?>
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