<div class="sPrd-block">
    <h2>Sản phẩm bán chạy</h2>
    <div class="pr-list">
        <?php
            $sql = "SELECT p.* FROM orderDetail od
			JOIN orders o on od.orderNumber = o.orderNumber
            JOIN product p on od.productId = p.productId
            group by p.productId
            ORDER BY sum(od.quantityOrdered) DESC LIMIT 6";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()){
        ?>
                <div class="prd-item">
                    <a href="mainCustomer.php?page_layout=productDetail&productId=<?php echo $row['productId'] ?>">
                        <img width="208" height="200" src="admin/image/<?php echo $row['productImage'] ?>" />
                    </a>
                    <h3>
                        <a href="mainCustomer.php?page_layout=productDetail&productId=<?php echo $row['productId'] ?>">
                            <?php echo $row['productName'] ?>
                        </a>
                    </h3>
                    <p>Bảo hành: <?php echo $row['guarantee'] ?></p>
                    <p class="price"><span>Giá: <?php echo $row['productPrice']*(100 -(int)$row['promotion']) / 100 ?> VNĐ</span></p>
                </div>
        <?php
        }
    ?>
        <div class="clear"></div>
    </div>
</div>