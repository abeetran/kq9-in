<div class="container-fluid">
	<!-- Breadcrumbs-->
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="#">Kinh doanh</a>
		</li>
		<li class="breadcrumb-item active">Đơn hàng</li>
	</ol>
	<!-- Example DataTables Card-->
	<div class="card mb-3">
		<div class="card-header">
			<i class="fa fa-table"></i> Danh sách đơn hàng
			<span style="float:right">
				<a href="<?php echo site_url('orders?act=upd&token='.$system->token);?>"><i class="fa fa-plus"></i> Đơn hàng mới</a>
			</span>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Hình</th>
							<th>Mã đơn hàng</th>
							<th>Khách hàng</th>
							<th>Số điện thoại</th>
							<th>Ngày tạo đơn hàng</th>
							<th>Ngày giao hàng</th>
							<th>Trạng thái</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
						<?php if($obj):
							foreach($obj as $key=>$row):
								$hinh = json_decode($row->images);
								$cus = $this->M_deliveries->set('order_id',$row->id)->get();
								$day = date('Ymd',strtotime($row->order_date));
								$img = !empty($hinh)?'assets/public/orders/'.$day.'/'.$hinh[0]:'assets/public/no-thumbnail.png';
						?>
						<tr <?php echo $row->uu_tien==1?'style="color:red"':'';?> >
							<td><img src="<?php echo base_url($img);?>" style="height:50px"></td>
							<td><?php echo $row->order_code;?></td>
							<td><?php echo $cus?$cus->fullname:'';?></td>
							<td><?php echo $cus?$cus->phone:'';?></td>
							<td><?php echo date('d/m/Y',strtotime($row->order_date));?></td>
							<td><?php echo $cus?date('d/m/Y',strtotime($cus->ngay_giao)):'';?></td>
							<td><?php echo $status[$row->status];?></td>
							<td>
								<!-- <a href="javascript:void(0)" class="btn btn-sm btn-primary">Xem</a> -->
								<a href="<?php echo site_url('orders?act=upd&id='.$row->id.'&token='.$system->token);?>" class="btn btn-sm btn-success">Sửa</a>
								<a href="<?php echo site_url('orders?act=del&id='.$row->id.'&token='.$system->token);?>" class="btn btn-sm btn-danger">Xóa</a>
							</td>
						</tr>
						<?php endforeach;?>
						<?php endif;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>