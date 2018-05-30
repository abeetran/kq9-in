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
	<link href="<?php echo base_url();?>assets/plugin/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom fonts for this template-->
	<link href="<?php echo base_url();?>assets/plugin/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<!-- Page level plugin CSS-->
	<link href="<?php echo base_url();?>assets/plugin/datatables/dataTables.bootstrap4.css" rel="stylesheet">
	<!-- Custom styles for this template-->
	<link href="<?php echo base_url();?>assets/css/sb-admin.css" rel="stylesheet">
	<!-- <script src="<?php echo base_url();?>assets/js/jquery-3.1.1.slim.min.js"></script> -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.js"></script>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
	<?php $this->load->view('template/_layout/navigation');?>
	<div class="content-wrapper">