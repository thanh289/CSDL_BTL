<?php
	session_start();
	include_once('connection.php');

	$productId = $_GET['productId'];
	$sql = "DELETE FROM product WHERE productId = $productId";
	try {
		$query = mysqli_query($conn, $sql);
	} catch (mysqli_sql_exception) {
		echo "Could not remove product!";
	}
	header('location:index.php?page_layout=product');
?>