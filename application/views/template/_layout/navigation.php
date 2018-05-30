<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
	<a class="navbar-brand" href="index.html"><?php echo $site_name;?></a>
	<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarResponsive">
		<ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
			<!-- <li class="nav-item <?php //echo $uri == 'xuong'?'active':'';?>" data-toggle="tooltip" data-placement="right" title="Dashboard">
				<a class="nav-link" href="<?php //echo site_url('xuong');?>">
				<i class="fa fa-fw fa-dashboard"></i>
				<span class="nav-link-text">Bảng điều khiển</span>
				</a>
			</li> -->
			<li class="nav-item <?php echo $uri == 'orders'?'active':'';?>" data-toggle="tooltip" data-placement="right" title="Components">
				<a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
				<i class="fa fa-fw fa-shopping-cart"></i>
				<span class="nav-link-text">Kinh doanh</span>
				</a>
				<ul class="sidenav-second-level collapse" id="collapseComponents">
					<li>
						<a href="orders">Đơn hàng</a>
					</li>
					<li>
						<a href="orders?act=upd">Thêm đơn hàng mới</a>
					</li>
				</ul>
			</li>
			<li class="nav-item <?php echo $uri == 'design'?'active':'';?>" data-toggle="tooltip" data-placement="right" title="Link">
				<a class="nav-link" href="<?php echo site_url('design')?>">
				<i class="fa fa-fw fa-pencil"></i>
				<span class="nav-link-text">Thiết kế</span>
				</a>
			</li>
			<li class="nav-item <?php echo $uri == 'prints'?'active':'';?>" data-toggle="tooltip" data-placement="right" title="Link">
				<a class="nav-link" href="<?php echo site_url('prints')?>">
				<i class="fa fa-fw fa-print"></i>
				<span class="nav-link-text">Xưởng in</span>
				</a>
			</li>
			<li class="nav-item <?php echo $uri == 'deliveries'?'active':'';?>" data-toggle="tooltip" data-placement="right" title="Link">
				<a class="nav-link" href="<?php echo site_url('deliveries');?>">
				<i class="fa fa-fw fa-truck"></i>
				<span class="nav-link-text">Vận chuyển</span>
				</a>
			</li>
		</ul>
		<ul class="navbar-nav sidenav-toggler">
			<li class="nav-item">
				<a class="nav-link text-center" id="sidenavToggler">
				<i class="fa fa-fw fa-angle-left"></i>
				</a>
			</li>
		</ul>
		<ul class="navbar-nav">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fa fa-fw fa-table"></i> Danh mục
				</a>
				<div class="dropdown-menu" aria-labelledby="messagesDropdown">
					<a class="dropdown-item" href="<?php echo site_url('cottons');?>">Vải</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="<?php echo site_url('color');?>">Màu sắc</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="<?php echo site_url('size');?>">Kích thước</a>
				</div>
			</li>
		</ul>
		<ul class="navbar-nav ml-auto">
			<li class="nav-item">
				<a class="nav-link" data-toggle="modal" data-target="#exampleModal">
				<i class="fa fa-fw fa-sign-out"></i>Logout</a>
			</li>
		</ul>
	</div>
	</nav>