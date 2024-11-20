<?php
    include_once('connection.php');
    $error = NULL;
    if(isset($_POST['submit'])){

        //  Product Line Name error or take value
        if($_POST['productLineName'] == ''){
            $error_productLineName = '<span style="color:red;">(*)<span>';
        }else{
            $productLineName = $_POST['productLineName'];
        }
        
        
        //  Check and Insert into MySQL
        if(isset($productLineName)){
            $sql = "INSERT INTO productLine (productLineName) 
                    VALUES ('$productLineName')";
            if ($conn->query($sql) === TRUE) {
                echo "Thêm thành công!";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }
    }
?>


<link rel="stylesheet" type="text/css" href="css/addProductLine.css" />
<h2>Thêm loại hàng</h2>
<div id="main">
	<form method="post" enctype="multipart/form-data">
    <!-- Table -->
	<table id="add-prdline" cellpadding="0" cellspacing="0">
        <!-- Product Line Name -->
    	<tr>
        	<td>
                <label>Tên loại hàng</label><br/>
                <input type="text" name="productLineName"/>
                <?php if(isset($error_productLineName)){echo $error_productLineName;}?>
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



