<footer class="sticky-footer">
	  <div class="container">
		<div class="text-center">
		  <small>©2018 <?php echo $this->config->item('meta_dev');?></small>
		</div>
	  </div>
	</footer>
	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
	  <i class="fa fa-angle-up"></i>
	</a>
	<!-- Logout Modal-->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Đăng xuất?</h5>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">×</span>
			</button>
		  </div>
		  <div class="modal-body">Bạn có muốn đăng xuất khỏi hệ thống</div>
		  <div class="modal-footer">
			<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
			<a class="btn btn-primary" href="<?php echo site_url('auth/logout')?>">Logout</a>
		  </div>
		</div>
	  </div>
	</div>
	<!-- Bootstrap core JavaScript-->
	<script src="assets/plugin/jquery/jquery.min.js"></script>
	<script src="assets/plugin/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- Core plugin JavaScript-->
	<script src="assets/plugin/jquery-easing/jquery.easing.min.js"></script>
	<!-- Page level plugin JavaScript-->
	<script src="assets/plugin/datatables/jquery.dataTables.js"></script>
	<script src="assets/plugin/datatables/dataTables.bootstrap4.js"></script>
	<!-- Custom scripts for all pages-->
	<script src="assets/js/sb-admin.min.js"></script>
	<!-- Custom scripts for this page-->
	<script src="assets/js/sb-admin-datatables.js"></script>
	</div>
</body>

</html>