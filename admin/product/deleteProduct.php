<?php
	session_start();
	$dbHost = 'localhost';
	$dbUsername = 'TFT';
	$dbPassword = 'Fongngu123';
	$dbName = 'web_csdl';
	$conn = mysqli_connect($dbHost,
						$dbUsername,
						$dbPassword,
						$dbName);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$productId = $_GET['productId'];
	$sql = "DELETE FROM product WHERE productId = $productId";
	try {
		$query = mysqli_query($conn, $sql);
	} catch (mysqli_sql_exception) {
		echo "Could not remove product!";
	}
	header('location:mainAdmin.php?page_layout=product');
?>