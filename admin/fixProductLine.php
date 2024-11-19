<?php
    ob_start();
    include_once('connection.php');
    $productLineId = $_GET['productLineId'];
    $sql = "SELECT * FROM productLine WHERE productLineId = $productLineId";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while($arr = $result->fetch_assoc()){
?>

    <link rel="stylesheet" type="text/css" href="css/fixProductLine.css"/>
    <h2>Sửa loại hàng</h2>

    <div id="main">
        <form method="post" enctype="multipart/form-data">
        <!-- Table -->
        <table id="fix-prdline" cellpadding="0" cellspacing="0">
            <!-- Product Line Name -->
            <tr>
                <td>
                    <label>Tên loại hàng</label><br/>
                    <input type="text" name="productLineName" value="<?php if(isset($_POST['productLineName'])){echo $_POST['productLineName'];}else{echo $arr['productLineName'];}?>" />
                </td>
                <?php if(isset($error_productLineName)){echo $error_productLineName;}?>
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

        //  Product Line Name error or take value
        if($_POST['productLineName'] == ''){
            $error_productLineName = '<span style="color:red;">(*)<span>';
        }else{
            $productLineName = $_POST['productLineName'];
        }

        //  Check and Update MySQL
        if(isset($productLineName)){
            $sqlUpdate = "UPDATE productLine SET productLineName = '$productLineName'
                                    WHERE   productLineId = $productLineId";
            if ($conn->query($sqlUpdate) === TRUE) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . $conn->error;
            }
            
            header('location:mainAdmin.php?page_layout=productLine');            
        }
    }
    ob_end_flush();
?>