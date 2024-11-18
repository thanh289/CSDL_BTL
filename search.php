<link rel="stylesheet" type="text/css" href="css/search.css" />
<div class="prd-block">
<?php
    if(isset($_POST['stext'])){
        $stext = $_POST['stext'];
    }else{
        $stext = '';
    }
    $newStext = str_replace(' ', '%', $stext);
    $sql = "SELECT * FROM product WHERE productName LIKE '%$newStext%'";
    $result = $conn->query($sql);
?>
	<h2>Kết quả tìm được với từ khóa <span class="skeyword">"<?php echo $stext ?>"</span></h2>
    <div class="pr-list">
    <?php
        $i=0;
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
                <p class="price">
                    <span>Giá: <?php echo $row['productPrice'] ?> VNĐ</span>
                </p>
            </div>
    <?php
            $i++;
            if($i%3==0){
                echo ' <div class="clear"></div>';
            }
        }
    ?>
       
    </div>
</div>
