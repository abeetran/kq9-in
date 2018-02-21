<!DOCTYPE html>
<html lang="en">
<base href="<?php echo base_url();?>">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title><?php echo $site_name;?></title>
	<!-- Bootstrap core CSS-->
	<link href="assets/plugin/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom fonts for this template-->
	<link href="assets/plugin/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<!-- Custom styles for this template-->
	<link href="assets/css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
	<div class="container">
		<div class="card card-login mx-auto mt-5">
			<div class="card-header">Đăng nhập</div>
			<div class="card-body">
				<form method="post" action="<?php echo site_url('auth');?>">
					<div class="form-group">
						<label for="exampleInputEmail1">Email đăng nhập</label>
						<input class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="email" name="email" required />
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">Mật khẩu</label>
						<input class="form-control" id="exampleInputPassword1" type="password" placeholder="Password" name="password" required />
					</div>
					<!-- <div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
								<input class="form-check-input" type="checkbox"> Remember Password</label>
						</div>
					</div> -->
					<!-- <a class="btn btn-primary btn-block" href="index.html">Login</a> -->
					<button type="submit" class="btn btn-primary btn-block">Login</button>
				</form>
				<!-- <div class="text-center">
					<a class="d-block small mt-3" href="register.html">Register an Account</a>
					<a class="d-block small" href="forgot-password.html">Forgot Password?</a>
				</div> -->
			</div>
		</div>
	</div>
	<!-- Bootstrap core JavaScript-->
	<script src="assets/plugin/jquery/jquery.min.js"></script>
	<script src="assets/plugin/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- Core plugin JavaScript-->
	<script src="assets/plugin/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
