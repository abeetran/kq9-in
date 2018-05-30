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
			<i class="fa fa-table"></i> Danh sách đơn hàng thiết kế
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Hình</th>
							<th>Mã đơn hàng</th>
							<th>Ngày giao hàng</th>
							<th>Trạng thái</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
						<?php if($obj):
							foreach($obj as $key=>$row):
								$hinh = ($row->images!='')?json_decode($row->images):'';
								$order = order_detail($row->order_id);
								$day = date('Ymd',strtotime($order->order_date));
								$img = !empty($hinh)?'assets/public/orders/'.$day.'/'.$hinh[0]:'assets/public/no-thumbnail.png';
						?>
						<tr <?php echo $row->uu_tien==1?'style="color:red"':'';?> >
							<td><img src="<?php echo base_url($img);?>" style="height:50px"></td>
							<td><?php echo $row->order_code;?></td>
							<td><?php echo $order?date('d/m/Y',strtotime($order->ngay_giao)):'';?></td>
							<td><?php echo $row->uu_tien==1?'Ưu tiên':''?></td>
							<td>
								<a href="<?php echo site_url('design?act=upd&id='.$row->id.'&order='.$row->order_id.'&token='.$system->token);?>" class="btn btn-sm btn-success">Xem</a>
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