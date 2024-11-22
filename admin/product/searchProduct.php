<?php
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

    
    if(isset($_GET['stext'])){
        $stext = $_GET['stext'];
    }else{
        $stext = '';
    }
    $newStext = str_replace(' ', '%', $stext);


    
    // Pagination go here
    $rowPerPage = 5;
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = 1;
    }

    $perRow = $page * $rowPerPage - $rowPerPage;
    $sql = "SELECT * FROM product INNER JOIN productLine ON product.productLineId = productLine.productLineId WHERE product.productName LIKE '%$newStext%' LIMIT $perRow, $rowPerPage";
    $result1 = $conn->query($sql);
?>

<link rel="stylesheet" type="text/css" href="css/product.css" />

<h2>Quản lí sản phẩm</h2>

<div id="main">

    <div id="search-bar">
            <form method="get" name="sform" action="mainAdmin.php">
                <input type="hidden" name="page_layout" value="searchProduct" >
                <input type="text" name="stext" placeholder="Tìm kiếm sản phẩm">
            </form>
    </div>

	<p id="add-prd">
        <a href="mainAdmin.php?page_layout=addProduct">
            <span>Thêm sản phẩm</span>
        </a>
    </p>

	<table id="prds" cellpadding="0" cellspacing="0" width="100%">
    	<tr id="prd-bar">
        	<td width="5%">ID</td>
            <td width="40%">Tên sản phẩm</td>
            <td width="15%">Giá</td>
            <td width="20%">Phân loại</td>
            <td width="10%">Ảnh</td>
            <td width="4%">Sửa</td>
            <td width="6%">Xóa</td>
        </tr>
        <?php
            if($result1->num_rows > 0){
                while($row = $result1->fetch_assoc()){
        ?>
        <tr>
                <td>
                    <span><?php echo $row['productId'];?></span>
                </td>
                <td class="l5">
                    <a href="mainAdmin.php?page_layout=fixProduct&productId=<?php echo $row['productId'];?>">
                        <?php echo $row['productName'];?>
                    </a>
                </td>
                <td class="l5">
                    <span class="price"><?php echo $row['productPrice'];?></span>
                </td>
                <td class="l5">
                    <?php echo $row['productLineName']?>
                </td>
                <td>
                    <span class="thumb">
                        <img width="60" src="image/<?php echo $row['productImage'];?>"/>
                    </span>
                </td>
                <td>
                    <a href="mainAdmin.php?page_layout=fixProduct&productId=<?php echo $row['productId'];?>">
                        <span>Fix</span>
                    </a>
                </td>
                <td>
                    <a href="deleteProduct.php?productId=<?php echo $row['productId'];?>">
                        <span>Delete</span>
                    </a>
                </td>
        </tr>
        <?php
                }
            }
        ?>
    </table>

    <?php
        $query = "SELECT * FROM product WHERE product.productName LIKE '%$newStext%'";
        $result2 = $conn->query($query);
        $totalRows = mysqli_num_rows($result2);
        $totalPage = ceil($totalRows/$rowPerPage);
        $listPage = '';
        for($i=1; $i<=$totalPage; $i++){
                if($i==$page){
                    $listPage .= " <span>".$i."</span> ";
                }else{
                    $listPage .= ' <a href="'.$_SERVER['PHP_SELF'].'?page_layout=searchProduct&stext=' . urlencode($stext) . '&page='.$i.'">'.$i.'</a> ';
                }
        }
    ?>
    <p id="pagination"><?php echo $listPage;?></p>
</div>