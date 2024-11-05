<?php
    include_once('connection.php');
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = 1;
    }
    $rowsPerPage = 10;
    $perRow = $page * $rowsPerPage - $rowsPerPage;
    $sql = "SELECT * FROM product INNER JOIN productLine ON product.productLineId = productLine.productLineId LIMIT $perRow, $rowsPerPage";
    $result1 = $conn->query($sql);
?>

<link rel="stylesheet" type="text/css" href="css/product.css" />

<h2>Quản lí sản phẩm</h2>

<div id="main">

	<p id="add-prd">
        <a href="index.php?page_layout=addProduct">
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
                    <a href="index.php?page_layout=fixProduct&productId=<?php echo $row['productId'];?>">
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
                    <a href="index.php?page_layout=fixProduct&productId=<?php echo $row['productId'];?>">
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
        $query = "SELECT * FROM product";
        $result2 = $conn->query($query);
        $totalRows = mysqli_num_rows($result2);
        $totalPage = ceil($totalRows/$rowsPerPage);
        $listPage = '';
        for($i=1; $i<=$totalPage; $i++){
                if($i==$page){
                    $listPage .= " <span>".$i."</span> ";
                }else{
                    $listPage .= ' <a href="'.$_SERVER['PHP_SELF'].'?page_layout=product&page='.$i.'">'.$i.'</a> ';
                }
        }
    ?>
    <p id="pagination"><?php echo $listPage;?></p>
</div>