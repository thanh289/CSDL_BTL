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
    <h2>Fix Product</h2>

    <div id="main">
        <form method="post" enctype="multipart/form-data">
        <table id="add-prd" cellpadding="0" cellspacing="0">
            <tr>
                <td>
                    <label>Name Of Product</label><br/>
                    <input type="text" name="productName" value="<?php if(isset($_POST['productName'])){echo $_POST['productName'];}else{echo $arr['productName'];}?>" />
                </td>
                <?php if(isset($error_productName)){echo $error_productName;}?>
            </tr>

            <tr>
                <td>
                    <label>Image</label><br/>
                    <input type="file" name="productImage1"/><br/>
                    <input type="text" name="productImage2" value="<?php echo $arr['productImage'];?>"/>
                </td>
            </tr>

            <tr>
                <td><label>Product Line</label><br/>
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

            <tr>
                <td>
                    <label>Price</label><br/>
                    <input type="text" name="productPrice" value="<?php if(isset($_POST['productPrice'])){echo $_POST['productPrice'];}else{echo $arr['productPrice'];}?>" /> VND
                    <?php if(isset($error_price)){echo $error_price;}?>
                </td>
            </tr>

            <tr>
                <td><label>Guarantee</label><br/>
                <input type="text" name="guarantee" value="<?php  if(isset($_POST['guarantee'])){echo $_POST['guarantee'];}else{echo $arr['guarantee'];}?>" />
                </td>
                <?php if(isset($error_guarantee)){echo $error_guarantee;}?>
            </tr>

            <tr>
                <td><label>Accessory</label><br/>
                <input type="text" name="accessory" value="<?php if(isset($_POST['accessory'])){echo $_POST['accessory'];}else{echo $arr['accessory'];}?>" />
                </td>
                <?php if(isset($error_accessory)){echo $error_accessory;}?>
            </tr>

            <tr>
                <td>
                    <label>Status</label><br/>
                    <input type="text" name="status1" value="<?php if(isset($_POST['status1'])){echo $_POST['status1'];}else{echo $arr['status1'];}?>" />
                </td>
                <?php if(isset($error_status1)){echo $error_status1;}?>
            </tr>

            <tr>
                <td>
                    <label>Discount</label><br/>
                    <input type="text" name="promotion" value="<?php if(isset($_POST['promotion'])){echo $_POST['promotion'];}else{echo $arr['promotion'];}?>" />
                </td>
                <?php if(isset($error_promotion)){echo $error_promotion;}?>
            </tr>

            <tr>
                <td>
                    <label>In stock</label><br/>
                    <input type="text" name="status2" value="<?php if(isset($_POST['status2'])){echo $_POST['status2'];}else{echo $arr['status2'];}?>" />
                </td>
                <?php if(isset($error_status2)){echo $error_status2;}?>
            </tr>

            <tr>
                <td><label>Special</label><br/>
                Yes <input type="radio" name="special" value=1 <?php if($arr['special']==1){echo 'checked';} ?>/> 
                No <input type="radio" name="special" value=0 <?php if($arr['special']==0){echo 'checked';} ?>/>
                </td>
            </tr>

            <tr>
                <td>
                    <label>Detail</label><br/>
                    <textarea cols="60" rows="12" name="detail">
                        <?php if(isset($_POST['detail'])){echo $_POST['detail'];}else{echo $arr['detail'];}?>
                    </textarea>
                </td>
                <?php if(isset($error_detail)){echo $error_detail;}?>
            </tr>

            <tr>
                <td>
                    <input type="submit" name="submit" value="Update"/> 
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

        //  Error go here
        //  If not then take the information
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

        $productLineId = $_POST['productLineId'];

        if($_POST['productPrice'] == ''){
            $error_price = '<span style="color:red;">(*)<span>';
        }else{
            $productPrice  = $_POST['productPrice'];
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

        $special = $_POST['special'];

        // echo $productName . "<br>";
        // echo $productImage . "<br>";
        // echo $productLineId . "<br>";
        // echo $productPrice . "<br>";
        // echo $guarantee . "<br>";
        // echo $accessory . "<br>";
        // echo $status1 . "<br>";
        // echo $promotion . "<br>";
        // echo $status2 . "<br>";
        // echo $detail . "<br>";
        // echo $special . "<br>";

        //  update in mysql go here
        if(isset($productName) && isset($productPrice) && isset($guarantee) && isset($accessory) && isset($status1) && isset($promotion) && isset($status2) && isset($detail)){
            if($_FILES['productImage1']['name'] != ""){
                move_uploaded_file($tmp, 'image/'.$productImage);
            }  
            $sqlUpdate = "UPDATE product SET productLineId = $productLineId,
                                            productName = '$productName',
                                            productImage ='$productImage',
                                            productPrice = '$productPrice',
                                            guarantee = '$guarantee',
                                            accessory = '$accessory',
                                            status1 = '$status1',
                                            promotion = '$promotion',
                                            status2 = '$status2', 
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