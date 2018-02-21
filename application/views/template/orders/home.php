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
				<a href="<?php echo site_url('orders?act=upd');?>"><i class="fa fa-plus"></i> Đơn hàng mới</a>
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
						<tr>
							<td>Hình đơn hàng</td>
							<td>Tiger Nixon</td>
							<td>System Architect</td>
							<td>Edinburgh</td>
							<td>61</td>
							<td>2011/04/25</td>
							<td>$320,800</td>
							<td>$320,800</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>