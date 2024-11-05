<?php
	session_start();
	include_once('connection.php');

	$productLineId = $_GET['productLineId'];
	$sql = "DELETE FROM productLine WHERE productLineId = $productLineId";
	try {
		$query = mysqli_query($conn, $sql);
	} catch (mysqli_sql_exception) {
		echo "Could not remove product!";
	}
	header('location:index.php?page_layout=productLine');
?>