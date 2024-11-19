<?php
    session_start();
    include_once('connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <link rel="stylesheet" href="css/mainCustomer.css"/>
</head>

<body>
    <!-- Nav Bar -->
    <div id="navbar">
        <ul>
            <li id="menu-home"><a href="mainCustomer.php">trang chủ</a></li>
        </ul>
        <div id="search-bar">
            <form method="get" name="sform" action="mainCustomer.php">
                <input type="hidden" name="page_layout" value="search" >
                <input type="submit" name="sbutton" value="" >
                <input type="text" name="stext" placeholder="Tìm kiếm sản phẩm">
            </form>
        </div>
    </div>

    <!-- Wrapper -->
    <div id="wrapper">
        <!-- Body -->
        <div id="body">
            <!-- Left Column -->
            <div id="l-col">
                <?php include_once('function/product/productLine.php');?>
            </div>
            
            <!-- Right Column -->
            <div id="r-col">
                <div id="main">
                    <?php
                    if(isset($_GET['page_layout'])){
                        switch($_GET['page_layout']){
                            case 'productDetail':   include_once('function/product/productDetail.php');break;
                            case 'product':         include_once('function/product/product.php');break;
                            case 'search':          include_once('search.php');break;
                            case 'shoppingCart':    include_once('function/shoppingCart/shoppingCart.php');break;
                            case 'buyProduct':      include_once('function/shoppingCart/buyProduct.php');break;
                            default:
                                include_once('function/product/specialProduct.php');
                                include_once('function/product/newProduct.php');
                        }
                    } else {
                        include_once('function/product/specialProduct.php');
                        include_once('function/product/newProduct.php');
                    }
                    ?>
                </div>
            </div>
        </div>

    </div>

    <!-- Footer -->
    <footer>
        <h4>Thành viên:</h4>
            <p>Trần Duy Thành - 23021720</p><br>
            <p>Dương Anh Tuấn - 23021704</p><br>
            <p>Nguyễn Duy Phong - 23021656</p><br>
    </footer>

</body>
</html>
