<link rel="stylesheet" type="text/css" href="css/product.css" />
<div class="prd-block">
	<h2>
        <?php
            $productLineName = $_GET['productLineName'];
            echo $productLineName;
        ?>
    </h2>

    <!-- List of product go here -->
    <div class="pr-list">
    <?php
        $productLineId = $_GET['productLineId'];

        // Pagination go here
        $rowPerPage = 4;
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }else{
            $page = 1;
        }

        $perRow = $page * $rowPerPage - $rowPerPage;
        $sql = "SELECT * FROM product WHERE productLineId = $productLineId LIMIT $perRow, $rowPerPage";
        $result = $conn->query($sql);
        $totalRow = mysqli_num_rows($conn->query("SELECT * FROM product WHERE productLineId = $productLineId"));
        $totalPage = Ceil($totalRow/$rowPerPage);
        $listPage = '';

        
        if($page>1){
            // Return to first page
            $listPage .= '<a href="index.php?page_layout=product&productLineId='.$productLineId
                        .'&productLineName='.$productLineName.'&page=1"> << </a>';
            // Return to previous page
            $prev = $page-1;
            $listPage .= '<a href="index.php?page_layout=product&productLineId='.$productLineId
                        .'&productLineName='.$productLineName.'&page='.$prev.'"> < </a>';
        }

        for($i=1;$i<=$totalPage;$i++){
            if($i==$page){
                $listPage .=  '<span> '.$i.' </span>';
            }else{
                $listPage .= '<a href="index.php?page_layout=product&productLineId='.$productLineId
                        .'&productLineName='.$productLineName.'&page='.$i.'"> '.$i.' </a>';
            }
        }

        if($page<$totalPage){
            // Go to next page
            $next = $page+1;
            $listPage .= '<a href="index.php?page_layout=product&productLineId='.$productLineId
                        .'&productLineName='.$productLineName.'&page='.$next.'"> > </a>';
            // Go to last page
            $listPage .= '<a href="index.php?page_layout=product&productLineId='.$productLineId
                        .'&productLineName='.$productLineName.'&page='.$totalPage.'"> >> </a>';
           
        }
        $i=0;

        //  Product detail go here
        while($row = $result->fetch_assoc()){
    ?>
            <div class="prd-item">
                <a href="index.php?page_layout=productDetail&productId=<?php echo $row['productId'] ?>">
                    <img width="208" height="200" src="admin/image/<?php echo $row['productImage'] ?>">
                </a>
                <h3>
                    <a href="index.php?page_layout=productDetail&productId=<?php echo $row['productId'] ?>">
                        <?php echo $row['productName'] ?>
                    </a>
                </h3>
                <p>Bảo hành: <?php echo $row['guarantee'] ?></p>
                <p class="price">
                    <span>Giá: <?php echo $row['productPrice'] ?> VNĐ</span>
                </p>
            </div>
    <?php
            $i++;
            if($i%4==0){
                echo '<div class="clear"></div>';
            }
        }
    ?>
        <div class="clear"></div>
    </div>
</div>

<div id="pagination"><?php echo $listPage ?></div>
