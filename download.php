<?php
if(isset($_GET["f"]) && isset($_GET['d'])){
	// Get parameters
	$file = $_GET["f"]; // Decode URL-encoded string
	$filepath = "assets/public/orders/".$_GET['d'].'/'.$file;
	// Process download
	if(file_exists($filepath)) {
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($filepath));
		flush(); // Flush system output buffer
		readfile($filepath);
		exit;
	}
}
?>