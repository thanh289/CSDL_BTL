<?php
    include_once('connection.php');
    $error = NULL;
    if(isset($_POST['submit'])){

        if($_POST['productName'] == ''){
            $error_productName = '<span style="color:red;">(*)<span>';
        }else{
            $productName = $_POST['productName'];
        }

        if($_POST['productPrice'] == ''){
            $error_price = '<span style="color:red;">(*)<span>';
        }else{
            $productPrice = $_POST['productPrice'];
        }

        if($_POST['guarantee'] == ''){
            $error_guarantee = '<span style="color:red;">(*)<span>';
        }else{
            $guarantee = $_POST['guarantee'];
        }

        if($_POST['accessory'] == ''){
            $error_accessory = '<span style="color:red;">(*)<span>';
        }else{
            $accessory = $_POST['accessory'];
        }

        if($_POST['status1'] == ''){
            $error_status1 = '<span style="color:red;">(*)<span>';
        }else{
            $status1 = $_POST['status1'];
        }

        if($_POST['promotion'] == ''){
            $error_promotion = '<span style="color:red;">(*)<span>';
        }else{
            $promotion = $_POST['promotion'];
        }

        if($_POST['status2'] == ''){
            $error_status2 = '<span style="color:red;">(*)<span>';
        }else{
            $status2 = $_POST['status2'];
        }

        if($_POST['detail'] == ''){
            $error_detail = '<span style="color:red;">(*)<span>';
        }else{
            $detail = $_POST['detail'];
        }

        if($_FILES['productImage']['name'] == ''){
            $error_image = '<span style="color:red;">(*)<span>';
        }else{
            $productImage = $_FILES['productImage']['name'];
            $tmp = $_FILES['productImage']['tmp_name'];
        }

        if($_POST['productLineId'] == 'unselect'){
            $error_productLineId = '<span style="color:red;">(*)<span>';
        }else{
            $productLineId = $_POST['productLineId'];
        }

        $special = $_POST['special'];

        

        if(isset($productName) && isset($productPrice) && isset($guarantee) && isset($accessory) && isset($status1) && isset($promotion) && isset($status2) && isset($detail) && isset($productImage) && isset($productLineId) && isset($special)){
            move_uploaded_file($tmp, 'image/'.$productImage);
            $sql = "INSERT INTO product (productName, productPrice, guarantee, accessory, status1, promotion, status2, detail, productImage, productLineId, special) 
                    VALUES ('$productName', '$productPrice', '$guarantee', '$accessory', '$status1', '$promotion', '$status2', '$detail', '$productImage', $productLineId, $special)";
            if ($conn->query($sql) === TRUE) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }
    }
?>


<link rel="stylesheet" type="text/css" href="css/addProduct.css" />
<h2>Add Product</h2>
<div id="main">
	<form method="post" enctype="multipart/form-data">
	<table id="add-prd" cellpadding="0" cellspacing="0">
    	<tr>
        	<td>
                <label>Name Of Product</label><br/>
                <input type="text" name="productName"/>
                <?php if(isset($error_productName)){echo $error_productName;}?>
            </td>
        </tr>
        <tr>
        	<td>
                <label>Image</label><br/>
                <input type="file" name="productImage"/>
                <?php if(isset($error_image)){echo $error_image;}?>
            </td>
        </tr>
        <tr>
        	<td><label>Product Line</label><br/>
            	<select name="productLineId">
                	<option value="unselect" selected="selected">Select Product Line</option>
                    <option value=1>keychain</option>
                    <option value=2>lamp</option>
                    <option value=3>lego</option>
                    <option value=4>katana</option>
                </select>
                <?php if(isset($error_productLineId)){echo $error_productLineId;}?>
            </td>
        </tr>
        <tr>
        	<td>
                <label>Price</label><br/><input type="text" name="productPrice"/> VNĐ 
                <?php if(isset($error_price)){echo $error_price;}?>
            </td>
        </tr>
        <tr>
        	<td>
                <label>Guarantee</label><br/>
                <input type="text" name="guarantee" value="12 Tháng"/>
                <?php if(isset($error_guarantee)){echo $error_guarantee;}?>
            </td>
        </tr>
        <tr>
        	<td>
                <label>Accessory</label><br/>
                <input type="text" name="accessory" value="Hộp, sách, sạc, cáp, tai nghe" />
                <?php if(isset($error_accessory)){echo $error_accessory;}?>
            </td>
        </tr>
        <tr>
        	<td>
                <label>Status</label><br/>
                <input type="text" name="status1" value="Máy Mới 100%"/>
                <?php if(isset($error_status1)){echo $error_status1;}?>
            </td>
        </tr>
        <tr>
        	<td>
                <label>Guarantee</label><br/>
                <input type="text" name="promotion" value="Dán Màn Hình 3 lớp"/>
                <?php if(isset($error_guarantee)){echo $error_guarantee;}?>
            </td>
        </tr>
        <tr>
        	<td>
                <label>In Stock</label><br/>
                <input type="text" name="status2" value="Còn hàng"/>
                <?php if(isset($error_status2)){echo $error_status2;}?>
            </td>
        </tr>
        <tr>
        	<td>
                <label>Special</label><br/>
                Yes <input type="radio" name="special" value=1 /> 
                No <input checked="checked" type="radio" name="special" value=0 />
            </td>
        </tr>
        <tr>
        	<td>
                <label>Detail</label><br/>
                <textarea cols="60" rows="12" name="detail"></textarea>
                <?php if(isset($error_detail)){echo $error_detail;}?>
            </td>
        </tr>
        <tr>
        	<td>
                <input type="submit" name="submit" value="Add"/> 
                <input type="reset" name="reset" value="Refresh" />
            </td>
        </tr>
    </table>
    </form>
</div>



