<!--  -->
<link rel="stylesheet" type="text/css" href="css/cart.css" />
<div class="prd-block">
    <!-- Detail of product go here -->
	<h2>YOUR CART</h2>
    <div class="cart">
    <?php
    if(isset($_SESSION['cart'])){
        if(isset($_POST['sl'])){
            foreach ($_POST['sl'] as $id_sp => $sl) {
            //Nếu số lượng nhập vào là 0 thì unset sản phẩm đó
                if($sl==0){
                    unset($_SESSION['cart'][$id_sp]);
                }else{
            //Nếu số khác 0 thì gán ngược lại.
                    $_SESSION['cart'][$id_sp] = $sl;
                }
            }
        }
        
        $arrId = array();
        //Lấy ra id sản phẩm từ mảng session
        foreach ($_SESSION['cart'] as $id_sp => $sl) {
            $arrId[] = $id_sp;
        }
        //Tách mảng arrId thành 1 chuỗi và ngăn cách bởi dấu ,
        $strID = implode(',', $arrId);
        if(isset($sl)){
        $sql = "SELECT * FROM product WHERE id_sp IN ($strID)";
        $query = mysqli_query($conn, $sql);
        $totalPriceAll = 0;
       
    ?>
    <form method="post" id="cart">
     <?php
        while($row = mysqli_fetch_array($query)){
        $totalPrice = $_SESSION['cart'][$row['id_sp']]*$row['gia_sp'];
    ?>
    	<table width="100%">
        	<tr>
            	<td class="cart-item-img" width="25%" rowspan="4"><img width="80" height="144" src="quantri/anh/<?php echo $row['anh_sp'] ?>" /></td>
                <td width="25%">Sản phẩm:</td>
                <td class="cart-item-title" width="50%"><?php echo $row['ten_sp'] ?></td>
            </tr>
            <tr>
                <td>Giá:</td>
                <td><span><?php echo $row['gia_sp'] ?> VNĐ</span></td>
            </tr>
            <tr>
            	<td>Số lượng:</td>
                <td><input type="text" name="sl[<?php echo $row['id_sp'] ?>]" value="<?php echo $_SESSION['giohang'][$row['id_sp']]?>" /> (Bỏ mặt hàng này) <a href="chucnang/giohang/xoahang.php?id_sp=<?php echo $row['id_sp'] ?>">X</a></td>
            </tr>
            <tr>
            	<td>Tổng tiền:</td>
                <td><span><?php echo $totalPrice ?> VNĐ</span></td>
            </tr>
        </table>
    <?php
        $totalPriceAll+=$totalPrice;
        }
    ?>
    </form>
   
        <p>Tổng giá trị giỏ hàng là: <span><?php echo $totalPriceAll ?> VNĐ</span></p>
        <p class="update-cart"><a href="#" onclick="document.getElementById('giohang').submit();"><span>cập nhật giỏ hàng</span></a></p>
        <p><a href="index.php">Bổ sung sản phẩm</a> <span>•</span> <a href="chucnang/giohang/xoahang.php?id_sp=0">Xóa hết sản phẩm</a> <span>•</span> <a href="index.php?page_layout=muahang">Dừng mua và Thanh toán</a></p>
        <?php
        }else{
            echo 'Giỏ hàng rỗng';
        }
        }else{
            echo 'Giỏ hàng rỗng';
        }
    ?>
    </div>
    
</div>
