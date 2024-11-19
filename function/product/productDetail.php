<!-- All product detail when you click the product -->
<link rel="stylesheet" href="css/productDetail.css" />
<div class="prd-block">

    <!-- Detail of product go here -->
    <div class="prd-only">
    <?php
        $productId = $_GET['productId'];
        $sql = "SELECT * FROM product WHERE productId = $productId";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    ?>
    	<div class="prd-img"><img width="50%" src="admin/image/<?php echo $row['productImage'] ?>" /></div>	
        <div class="prd-intro">
        	<h3><?php echo $row['productName'] ?></h3>
            <p>Giá sản phẩm: <span><?php echo $row['productPrice'] ?> VNĐ</span></p>
        	<table>
            	<tr>
                	<td width="30%"><span>Bảo hành:</span></td>
                    <td>• <?php echo $row['guarantee'] ?></td>
                </tr>
                <tr>
                	<td><span>Đi kèm:</span></td>
                    <td>• <?php echo $row['accessory'] ?></td>
                </tr>
                <tr>
                	<td><span>Khuyến Mại:</span></td>
                    <td>• <?php echo $row['promotion'] ?></td>
                </tr>
                <tr>
                	<td><span>Còn hàng:</span></td>
                    <td>• <?php echo $row['inStock'] ?></td>
                </tr>
            </table>
            <p class="add-cart">
                <a href="function/shoppingCart/addProduct.php?productId=<?php echo $row['productId'] ?>">
                    <span>Đặt mua</span>
                </a>
            </p>
        </div>
        
        <div class="clear"></div>
        
        <div class="prd-details">
            <p><?php echo $row['detail'] ?></p>
        </div>
    </div>
    
    <!-- Type comment go here -->
    <div class="prd-comment">
        <h3>Bình luận sản phẩm</h3>
        <form method="post">
            <ul>
                <li class="required">Tên <br/><input required type="text" name="customerName"/></li>
                <li class="required">Số điện thoại <br/><input required type="text" name="phone"/></li>
                <li class="required">Nội dung <br/>
                    <textarea required name="comment"></textarea>
                </li>
                <li><input type="submit" name="submit" value="Bình luận"/></li>
            </ul>
        </form>
    </div>

    <!-- Add comment to MySQL -->
    <?php
        if(isset($_POST['submit'])){
            $customerName = $_POST['customerName'];
            $phone = $_POST['phone'];
            $comment = $_POST['comment'];
            date_default_timezone_set('Asia/SaiGon');
            $commentDate = date('Y-m-d H:i:s');
            $sql = "INSERT INTO comment (productId,customerName,phone,comment,commentDate) 
                VALUES ($productId,'$customerName','$phone','$comment','$commentDate')";
            $updateCmt = $conn->query($sql);
        }
    ?>

    <!-- All comments is shown here -->
    <div class="comment-list">
    <?php
        $sql = "SELECT * FROM comment WHERE productId = $productId";
        $cmtList = $conn->query($sql);
        while($row = $cmtList->fetch_assoc()){
    ?>
            <ul>
                <li class="com-title"><?php echo $row['customerName'] ?><br />
                <span>
                    <?php
                        $oriDate = $row['commentDate'];
                        $newDate = date('d-m-Y H:i:s',strtotime($oriDate));
                        echo $newDate;
                    ?>
                </span></li>
                <li class="com-details"><?php
                    echo $row['comment'];
                ?></li>
            </ul>
    <?php
        }
    ?>
    </div>
    
   <!-- No pagination yet  -->
    
</div>               
