<?php
    include_once('connection.php');
    if(isset($_GET['stext'])){
        $stext = $_GET['stext'];
    }else{
        $stext = '';
    }
    $newStext = str_replace(' ', '%', $stext);

    // Pagination
    $rowPerPage = 5;
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = 1;
    }

    $perRow = $page * $rowPerPage - $rowPerPage;
    $sql = "SELECT * FROM productline WHERE productLineName LIKE '%$newStext%' LIMIT $perRow, $rowPerPage";
    $result1 = $conn->query($sql);
?>

<link rel="stylesheet" type="text/css" href="css/product.css" />

<h2>Quản lí Phân Loại Sản Phẩm</h2>

<div id="main">
    <div id="search-bar">
        <form method="get" name="sform" action="mainAdmin.php">
            <input type="hidden" name="page_layout" value="searchProductLine">
            <input type="text" name="stext" placeholder="Tìm kiếm phân loại">
        </form>
    </div>

    <p id="add-prd">
        <a href="mainAdmin.php?page_layout=addProductLine">
            <span>Thêm loại hàng</span>
        </a>
    </p>

    <table id="prds" cellpadding="0" cellspacing="0" width="100%">
        <tr id="prd-bar">
            <td width="10%">ID</td>
            <td width="70%">Tên Loại Hàng</td>
            <td width="10%">Sửa</td>
            <td width="10%">Xóa</td>
        </tr>
        <?php
            if($result1->num_rows > 0){
                while($row = $result1->fetch_assoc()){
        ?>
        <tr>
            <td>
                <span><?php echo $row['productLineId']; ?></span>
            </td>
            <td class="l5">
                <a href="mainAdmin.php?page_layout=fixProductLine&productLineId=<?php echo $row['productLineId']; ?>">
                    <?php echo $row['productLineName']; ?>
                </a>
            </td>
            <td>
                <a href="mainAdmin.php?page_layout=fixProductLine&productLineId=<?php echo $row['productLineId']; ?>">
                    <span>Fix</span>
                </a>
            </td>
            <td>
                <a href="deleteProductLine.php?productLineId=<?php echo $row['productLineId']; ?>">
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
        $query = "SELECT * FROM productline WHERE productLineName LIKE '%$newStext%'";
        $result2 = $conn->query($query);
        $totalRows = mysqli_num_rows($result2);
        $totalPage = ceil($totalRows / $rowPerPage);
        $listPage = '';
        for($i = 1; $i <= $totalPage; $i++){
            if($i == $page){
                $listPage .= " <span>" . $i . "</span> ";
            }else{
                $listPage .= ' <a href="'.$_SERVER['PHP_SELF'].'?page_layout=searchProductLine&stext=' . urlencode($stext) . '&page=' . $i . '">' . $i . '</a> ';
            }
        }
    ?>
    <p id="pagination"><?php echo $listPage; ?></p>
</div>
