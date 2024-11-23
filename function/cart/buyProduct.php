<link rel="stylesheet" href="css/buyProduct.css" />
<div class="prd-block">

    <!-- Chi tiết sản phẩm -->
    <div class="prd-only">
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
        $productId = $_GET['productId'];
        $sql = "SELECT * FROM product WHERE productId = $productId";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    ?>
    	<div class="prd-img">
            <img src="admin/image/<?php echo $row['productImage'] ?>" />
        </div>	
        <div class="prd-intro">
        	<h3><?php echo $row['productName'] ?></h3>
            <p>Giá sản phẩm: <span><?php echo $row['productPrice'] ?> VNĐ</span></p>
        	<table>
            	<tr>
                	<td width="30%"><span>Bảo hành:</span></td>
                    <td><?php echo $row['guarantee'] ?></td>
                </tr>
                <tr>
                	<td><span>Đi kèm:</span></td>
                    <td><?php echo $row['accessory'] ?></td>
                </tr>
                <tr>
                	<td><span>Khuyến Mại:</span></td>
                    <td><?php echo $row['promotion'] ?></td>
                </tr>
                <tr>
                	<td><span>Còn hàng:</span></td>
                    <td>
                        <?php 
                            $stock = $row['inStock'];
                            if ($stock) echo "Còn hàng";
                            else echo "Hết hàng";
                        ?>
                    </td>
                </tr>
            </table>
        </div>
        
        <div class="clear"></div>
        
        <!-- Xác nhận mua hàng -->
        <div class="prd-buy">
            <h3>Thông tin đặt hàng</h3>
            <form method="post">
                <ul>
                    <li class="required">Tên khách hàng <br /><input required type="text" name="customerName" /></li>
                    <li class="required">Số điện thoại <br /><input required type="text" name="phone" /></li>
                    <li class="required">Địa chỉ Email <br /><input required type="email" name="email" /></li>
                    <li class="required">Địa chỉ nhận hàng <br /><input required type="text" name="address" /></li>
                    <li class="required">Số lượng <br /><input required type="text" name="quantity" /></li>
                    <li><input type="submit" name="buyNow" value="Xác nhận mua hàng" /></li>
                </ul>
            </form>
        </div>
    </div>



    <?php
        if (isset($_POST['buyNow'])) {
      
            $customerName = $_POST['customerName'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $quantity = $_POST['quantity']; 
            $totalPrice = $row['productPrice'] * $quantity;
            

            //Kiểm tra xem đã có khách hàng này chưa
            //Nếu chưa thì add vào bảng customers
            $sqlCheckCustomer = "SELECT * FROM customers WHERE email = '$email' OR phone = '$phone'";
            $resultCheck = $conn->query($sqlCheckCustomer);

            if ($resultCheck->num_rows > 0) {
                $customer = $resultCheck->fetch_assoc();
                $customerNumber = $customer['customerNumber'];
            } else {
                $sqlCustomer = "INSERT INTO customers (customerName, phone, email, address) 
                                VALUES ('$customerName', '$phone', '$email', '$address')";
                if ($conn->query($sqlCustomer) === TRUE) {
                    $customerNumber = $conn->insert_id;
                }
            }

            //Lưu vào bảng orders
            $sqlOrder = "INSERT INTO orders (orderDate, customerNumber) 
                         VALUES (NOW(), $customerNumber)";

            if ($conn->query($sqlOrder) === TRUE) {
                $orderNumber = $conn->insert_id;

                // Thêm chi tiết đơn hàng
            $sqlOrderDetail = "INSERT INTO orderdetail (orderNumber, productId, quantityOrdered) 
                       VALUES ($orderNumber, $productId, $quantity)";
            if ($conn->query($sqlOrderDetail) === TRUE) {
                // ** Thêm vào bảng payments **
            $paymentDate = date('Y-m-d'); // Ngày thanh toán hiện tại
            $totalAmount = $row['productPrice'] * $quantity;

            $sqlPayment = "INSERT INTO payments (customerNumber, paymentDate, amount, orderNumber) 
                       VALUES ($customerNumber, '$paymentDate', $totalAmount, $orderNumber)";
            if ($conn->query($sqlPayment) === TRUE) {
                echo "<div class='order-success'>
                    <h3>Đặt hàng và thanh toán thành công!</h3>
                    <p>Cảm ơn bạn, $customerName. Thông tin đơn hàng:</p>
                    <ul>
                        <li><strong>Tên sản phẩm:</strong> {$row['productName']}</li>
                        <li><strong>Giá:</strong> {$row['productPrice']} VNĐ</li>
                        <li><strong>Số lượng:</strong> $quantity</li>
                        <li><strong>Tổng tiền:</strong> $totalAmount VNĐ</li>
                        <li><strong>Địa chỉ nhận hàng:</strong> $address</li>
                    </ul>
                  </div>";
            } else {
                echo "<h3>Thêm thanh toán thất bại. Vui lòng thử lại.</h3>";
            }
            } else {
            echo "<h3>Thêm chi tiết đơn hàng thất bại. Vui lòng thử lại.</h3>";
            }
        } else {
            echo "<h3>Đặt hàng thất bại. Vui lòng thử lại.</h3>";
        }
    }
    ?>
</div>