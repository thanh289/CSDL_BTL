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
    
    $error = NULL;
    if(isset($_POST['submit'])){

        //  Product Line Id error or take value
        if($_POST['productLineId'] == 'unselect'){
            $error_productLineId = '<span style="color:red;">(*)<span>';
        }else{
            $productLineId = $_POST['productLineId'];
        }

        //  Product Name error or take value
        if($_POST['productName'] == ''){
            $error_productName = '<span style="color:red;">(*)<span>';
        }else{
            $productName = $_POST['productName'];
        }

        //  Product Image error or take value
        if($_FILES['productImage']['name'] == ''){
            $error_image = '<span style="color:red;">(*)<span>';
        }else{
            $productImage = $_FILES['productImage']['name'];
            $tmp = $_FILES['productImage']['tmp_name'];
        }

        //  Product Price error or take value
        if($_POST['productPrice'] == ''){
            $error_price = '<span style="color:red;">(*)<span>';
        }else{
            $productPrice = $_POST['productPrice'];
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

        //  Product In Stock value
        $inStock = $_POST['inStock'];
        
        //  Product Special value
        $special = $_POST['special'];

        //  Product Detail error or take value
        if($_POST['detail'] == ''){
            $error_detail = '<span style="color:red;">(*)<span>';
        }else{
            $detail = $_POST['detail'];
        }

        
        
        //  Check and Insert into MySQL
        if(isset($productName) && is_numeric($productPrice) && isset($guarantee) && isset($accessory) && is_numeric($promotion) && is_numeric($inStock) && isset($detail) && isset($productImage) && is_numeric($productLineId) && is_numeric($special)){
            move_uploaded_file($tmp, 'image/'.$productImage);
            $sql = "INSERT INTO product (productName, productPrice, guarantee, accessory, promotion, detail, productImage, productLineId, inStock, special) 
                VALUES ('$productName', $productPrice, '$guarantee', '$accessory', $promotion, '$detail', '$productImage', $productLineId, $inStock, $special)";
            
            if ($conn->query($sql) == TRUE) {
                echo "Thêm thành công!";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        } else {
            echo "Thêm không thành công";
        }
    }
?>


<link rel="stylesheet" type="text/css" href="css/addProduct.css" />
<h2>Thêm sản phẩm</h2>
<div id="main">
	<form method="post" enctype="multipart/form-data">
    <!-- Table -->
	<table id="add-prd" cellpadding="0" cellspacing="0">
        <!-- Product Name -->
    	<tr>
        	<td>
                <label>Tên sản phẩm</label><br/>
                <input type="text" name="productName"/>
                <?php if(isset($error_productName)){echo $error_productName;}?>
            </td>
        </tr>
        <!-- Product Image -->
        <tr>
        	<td>
                <label>Ảnh minh họa</label><br/>
                <input type="file" name="productImage"/>
                <?php if(isset($error_image)){echo $error_image;}?>
            </td>
        </tr>
        <!-- Product Line -->
        <tr>
        	<td><label>Phân loại</label><br/>
            	<select name="productLineId">
                	<option value="unselect" selected="selected">Select Product Line</option>
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
                <?php if(isset($error_productLineId)){echo $error_productLineId;}?>
            </td>
        </tr>
        <!-- Price -->
        <tr>
        	<td>
                <label>Giá</label><br/><input type="text" name="productPrice"/> VNĐ 
                <?php if(isset($error_price)){echo $error_price;}?>
            </td>
        </tr>
        <!-- Guarantee -->
        <tr>
        	<td>
                <label>Bảo hành</label><br/>
                <input type="text" name="guarantee"/>
                <?php if(isset($error_guarantee)){echo $error_guarantee;}?>
            </td>
        </tr>
        <!-- Accessory -->
        <tr>
        	<td>
                <label>Phụ kiện</label><br/>
                <input type="text" name="accessory"/>
                <?php if(isset($error_accessory)){echo $error_accessory;}?>
            </td>
        </tr>
        <!-- Guarantee -->
        <tr>
        	<td>
                <label>Khuyến mãi</label><br/>
                <input type="text" name="promotion"/>
                <?php if(isset($error_guarantee)){echo $error_guarantee;}?>
            </td>
        </tr>
        <!-- In Stock -->
        <tr>
        	<td>
                <label>Còn hàng</label><br/>
                Còn <input checked="checked" type="radio" name="inStock" value=1> 
                Hết <input type="radio" name="inStock" value=0>
            </td>
        </tr>
        <!-- Special -->
        <tr>
        	<td>
                <label>Hàng đặc biệt</label><br/>
                Có <input type="radio" name="special" value=1> 
                Không <input checked="checked" type="radio" name="special" value=0>
            </td>
        </tr>
        <!-- Detail -->
        <tr>
        	<td>
                <label>Mô tả</label><br/>
                <textarea cols="60" rows="12" name="detail"></textarea>
                <?php if(isset($error_detail)){echo $error_detail;}?>
            </td>
        </tr>
        <!-- Submit and Reset Button -->
        <tr>
        	<td>
                <input type="submit" name="submit" value="Thêm"/> 
                <input type="reset" name="reset" value="Refresh" />
            </td>
        </tr>
    </table>
    </form>
</div>



