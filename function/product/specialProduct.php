<div class="prd-block">
    <h2>Sản phẩm đặc biệt</h2>
    <div class="pr-list">
        <!-- Show the first 6 special product -->
        <?php
            $sql = "SELECT * FROM product WHERE special = 1 ORDER BY productId DESC LIMIT 6";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()){
        ?>
                <div class="prd-item">
                    <a href="index.php?page_layout=productDetail&productId=<?php echo $row['productId'] ?>">
                        <img width="80" height="144" src="admin/image/<?php echo $row['productImage'] ?>" />
                    </a>
                    <h3>
                        <a href="index.php?page_layout=productDetail&productId=<?php echo $row['productId'] ?>">
                            <?php echo $row['productName'] ?>
                        </a>
                    </h3>
                    <p>Bảo hành: <?php echo $row['guarantee'] ?></p>
                    <p class="price"><span>Giá: <?php echo $row['productPrice'] ?> VNĐ</span></p>
                </div>
        <?php
        }
    ?>
        <div class="clear"></div>
    </div>
</div>