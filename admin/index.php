<?php
    session_start();
    include_once('connection.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="css/index.css" />
</head>

<body>

    <div id="navbar">
        <ul>
            <li id="admin-home"><a href="index.php">Trang chủ</a></li>
            <li><a href="index.php?page_layout=customer ">Khách hàng</a></li>
            <li><a href="index.php?page_layout=productLine">Loại sản phẩm</a></li>
            <li><a href="index.php?page_layout=product">Sản phẩm</a></li>
        </ul>
    </div>

    <div id="wrapper">
        <div id="header">
            <!-- <form method="post" name="sform" action="index.php?page_layout=search">
                <input type="submit" name="sbutton" value="" />
                <input type="text" name="stext" placeholder="Tìm kiếm sản phẩm"/>
            </form> -->
        </div>

        <div id="body">
            <?php
            if(isset($_GET['page_layout'])){
                switch ($_GET['page_layout']){
                    case 'addProductLine': include_once('addProductLine.php'); break;
                    case 'fixProductLine': include_once('fixProductLine.php'); break;
                    case 'productLine': include_once('productLine.php'); break;
                    case 'addProduct': include_once('addProduct.php'); break;
                    case 'fixProduct': include_once('fixProduct.php'); break;
                    case 'product': include_once('product.php'); break;
                }
            }else{
                include_once('introduction.php');
            }
            ?>	
        </div>
    </div>

    <footer>
            <h4>Thành viên:</h4>
            <p>Trần Duy Thành - 23021720</p><br>
            <p>Dương Anh Tuấn - 23021704</p><br>
            <p>Nguyễn Duy Phong - 23021656</p><br>
    </footer>


</body>

</html>