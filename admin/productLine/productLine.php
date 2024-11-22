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
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = 1;
    }
    $rowsPerPage = 10;
    $perRow = $page * $rowsPerPage - $rowsPerPage;
    $sql = "SELECT * FROM productLine LIMIT $perRow, $rowsPerPage";
    $result1 = $conn->query($sql);
?>

<link rel="stylesheet" type="text/css" href="css/productLine.css" />

<h2>Quản lí phân loại sản phẩm</h2>

<div id="main">
    
    <div id="search-bar">
            <form method="get" name="sform" action="mainAdmin.php">
                <input type="hidden" name="page_layout" value="searchProductLine" >
                <input type="text" name="stext" placeholder="Tìm kiếm sản phẩm">
            </form>
    </div>

	<p id="add-prdline">
        <a href="/admin/mainAdmin.php?page_layout=addProductLine">
            <span>Thêm loại hàng</span>
        </a>
    </p>
    
	<table id="prdline" cellpadding="0" cellspacing="0" width="100%">
    	<tr id="prdline-bar">
        	<td width="10%">ID</td>
            <td width="70%">Tên loại hàng</td>
            <td width="10%">Sửa</td>
            <td width="10%">Xóa</td>
        </tr>
        <?php
            if($result1->num_rows > 0){
                while($row = $result1->fetch_assoc()){
        ?>
        <tr>
                <td>
                    <span><?php echo $row['productLineId'];?></span>
                </td>
                <td id="name">
                    <a href="/admin/mainAdmin.php?page_layout=fixProductLine&productLineId=<?php echo $row['productLineId'];?>">
                        <?php echo $row['productLineName'];?>
                    </a>
                </td>
                <td>
                    <a href="/admin/mainAdmin.php?page_layout=fixProductLine&productLineId=<?php echo $row['productLineId'];?>">
                        <span>Fix</span>
                    </a>
                </td>
                <td>
                    <a href="productLine/deleteProductLine.php?productLineId=<?php echo $row['productLineId'];?>">
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
        $query = "SELECT * FROM productLine";
        $result2 = $conn->query($query);
        $totalRows = mysqli_num_rows($result2);
        $totalPage = ceil($totalRows/$rowsPerPage);
        $listPage = '';
        for($i=1; $i<=$totalPage; $i++){
                if($i==$page){
                    $listPage .= " <span>".$i."</span> ";
                }else{
                    $listPage .= ' <a href="'.$_SERVER['PHP_SELF'].'?page_layout=productLine&page='.$i.'">'.$i.'</a> ';
                }
        }
    ?>
    <p id="pagination"><?php echo $listPage;?></p>
</div>