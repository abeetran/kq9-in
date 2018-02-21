<div class="container-fluid">
	<!-- Breadcrumbs-->
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="#">Danh mục</a>
		</li>
		<li class="breadcrumb-item active">Vải</li>
	</ol>
	<!-- Example DataTables Card-->
	<div class="card mb-3">
		<div class="card-header">
			<i class="fa fa-table"></i> Danh mục Vải
			<span style="float:right">
				<a href="<?php echo site_url('cottons?act=upd');?>"><i class="fa fa-plus"></i> Thêm mới</a>
			</span>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Tên loại vải</th>
							<th>Ngày tạo</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<!-- <tfoot>
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
					</tfoot> -->
					<tbody>
						<?php if($obj): foreach($obj as $key=>$row):?>
						<tr>
							<td><?php echo $row->cottons;?></td>
							<td><?php echo $row->createddate;?></td>
							<td>
								<a href="<?php echo site_url('cottons?act=upd&id='.$row->id);?>"><i class="fa fa-edit"></i></a>
								<a href="<?php echo site_url('cottons?act=del&id='.$row->id);?>"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
					<?php endforeach; endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>