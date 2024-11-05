<?php
    ob_start();
    include_once('connection.php');
    $productId = $_GET['productId'];
    $sql = "SELECT * FROM product WHERE productId = $productId";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while($arr = $result->fetch_assoc()){
?>

    <link rel="stylesheet" type="text/css" href="css/fixProduct.css"/>
    <h2>Sửa sản phẩm</h2>

    <div id="main">
        <form method="post" enctype="multipart/form-data">
        <!-- Table -->
        <table id="fix-prd" cellpadding="0" cellspacing="0">
            <!-- Product Name -->
            <tr>
                <td>
                    <label>Tên sản phẩm</label><br/>
                    <input type="text" name="productName" value="<?php if(isset($_POST['productName'])){echo $_POST['productName'];}else{echo $arr['productName'];}?>" />
                </td>
                <?php if(isset($error_productName)){echo $error_productName;}?>
            </tr>
            <!-- Image -->
            <tr>
                <td>
                    <label>Ảnh minh họa</label><br/>
                    <input type="file" name="productImage1"/><br/><br/>
                    <input type="text" name="productImage2" value="<?php echo $arr['productImage'];?>"/>
                </td>
            </tr>
            <!-- Product Line -->
            <tr>
                <td><label>Phân loại</label><br/>
                    <select name="productLineId">
                        <?php
                            $sqlDm = "SELECT * FROM productLine";
                            $resultDm = $conn->query($sqlDm);
                            if($resultDm->num_rows > 0){
                                while($arrDm = $resultDm->fetch_assoc()){
                        ?>
                                    <option value="<?php echo $arrDm['productLineId']; ?>">
                                        <?php echo $arrDm['productLineName']; ?>
                                    </option>
                        <?php
                                }                            
                            }
                        ?>
                    </select>	
                </td>
            </tr>
            <!-- Price -->
            <tr>
                <td>
                    <label>Giá</label><br/>
                    <input type="text" name="productPrice" value="<?php if(isset($_POST['productPrice'])){echo $_POST['productPrice'];}else{echo $arr['productPrice'];}?>" /> VND
                    <?php if(isset($error_price)){echo $error_price;}?>
                </td>
            </tr>
            <!-- Guarantee -->
            <tr>
                <td><label>Bảo hành</label><br/>
                <input type="text" name="guarantee" value="<?php  if(isset($_POST['guarantee'])){echo $_POST['guarantee'];}else{echo $arr['guarantee'];}?>" />
                </td>
                <?php if(isset($error_guarantee)){echo $error_guarantee;}?>
            </tr>
            <!-- Accessory -->
            <tr>
                <td><label>Phụ kiện</label><br/>
                <input type="text" name="accessory" value="<?php if(isset($_POST['accessory'])){echo $_POST['accessory'];}else{echo $arr['accessory'];}?>" />
                </td>
                <?php if(isset($error_accessory)){echo $error_accessory;}?>
            </tr>
            <!-- Discount -->
            <tr>
                <td>
                    <label>Khuyến mãi</label><br/>
                    <input type="text" name="promotion" value="<?php if(isset($_POST['promotion'])){echo $_POST['promotion'];}else{echo $arr['promotion'];}?>" />
                </td>
                <?php if(isset($error_promotion)){echo $error_promotion;}?>
            </tr>
            <!-- In Stock -->
            <tr>
                <td>
                    <label>Còn hàng</label><br/>
                    Còn <input type="radio" name="inStock" value=1 <?php if($arr['inStock']==1){echo 'checked';} ?>/> 
                    Hết <input type="radio" name="inStock" value=0 <?php if($arr['inStock']==0){echo 'checked';} ?>/>
                </td>
            </tr>
            <!-- Special -->
            <tr>
                <td>
                    <label>Hàng đặc biệt</label><br/>
                    Có <input type="radio" name="special" value=1 <?php if($arr['special']==1){echo 'checked';} ?>/> 
                    Không <input type="radio" name="special" value=0 <?php if($arr['special']==0){echo 'checked';} ?>/>
                </td>
            </tr>
            <!-- Detail -->
            <tr>
                <td>
                    <label>Mô tả</label><br/>
                    <textarea cols="60" rows="12" name="detail"><?php if(isset($_POST['detail'])){echo $_POST['detail'];}else{echo $arr['detail'];}?>
                    </textarea>
                </td>
                <?php if(isset($error_detail)){echo $error_detail;}?>
            </tr>
            <!-- Submit and Reset Button -->
            <tr>
                <td>
                    <input type="submit" name="submit" value="Sửa"/> 
                    <input type="reset" name="reset" value="Refresh">
                </td>
            </tr>

        </table>
        </form>
    </div>
<?php
    }
}
?>


<?php
    // Hit submit button to confirm fixing
    if(isset($_POST['submit'])){

        //  Product Name error or take value
        if($_POST['productName'] == ''){
            $error_productName = '<span style="color:red;">(*)<span>';
        }else{
            $productName = $_POST['productName'];
        }

        //  productImage1 -> take from file
        //  productImage2 -> take from mysql
        if($_FILES['productImage1']['name'] == ''){
            $productImage = $_POST['productImage2'];
        }else{
            $productImage= $_FILES['productImage1']['name'];
            $tmp = $_FILES['productImage1']['tmp_name'];
        }

        //  Product Line Id take value
        $productLineId = $_POST['productLineId'];

        //  Product Price error or take value
        if($_POST['productPrice'] == ''){
            $error_price = '<span style="color:red;">(*)<span>';
        }else{
            $productPrice  = $_POST['productPrice'];
        }

        //  Product Guarantee error or take value
        if($_POST['guarantee'] == ''){
            $error_guarantee = '<span style="color:red;">(*)<span>';
        }else{
            $guarantee = $_POST['guarantee'];
        }

        //  Product Accessory error or take value
        if($_POST['accessory'] == ''){
            $error_accessory = '<span style="color:red;">(*)<span>';
        }else{
            $accessory = $_POST['accessory'];
        }

        //  Product Promotion error or take value
        if($_POST['promotion'] == ''){
            $error_promotion = '<span style="color:red;">(*)<span>';
        }else{
            $promotion = $_POST['promotion'];
        }

        //  Product Detail error or take value
        if($_POST['detail'] == ''){
            $error_detail = '<span style="color:red;">(*)<span>';
        }else{
            $detail = $_POST['detail'];
        }

        //  Product In Stock error or take value
        $inStock = $_POST['inStock'];

        //  Product Special take value
        $special = $_POST['special'];

        //  Check and Update MySQL
        if(isset($productName) && isset($productPrice) && isset($guarantee) && isset($accessory) && isset($promotion) && isset($inStock) && isset($detail)){
            if($_FILES['productImage1']['name'] != ""){
                move_uploaded_file($tmp, 'image/'.$productImage);
            }  
            $sqlUpdate = "UPDATE product SET productLineId = $productLineId,
                                            productName = '$productName',
                                            productImage ='$productImage',
                                            productPrice = '$productPrice',
                                            guarantee = '$guarantee',
                                            accessory = '$accessory',
                                            promotion = '$promotion',
                                            inStock = $inStock, 
                                            special = $special,
                                            detail = '$detail'
                                    WHERE   productId = $productId";
            if ($conn->query($sqlUpdate) === TRUE) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . $conn->error;
            }
            
            header('location:index.php?page_layout=product');            
        }
    }
    ob_end_flush();
?>