<link rel="stylesheet" href="css/buyProduct.css" />
<div class="prd-block">
    <?php
    // Kết nối database
    $dbHost = 'localhost';
    $dbUsername = 'TFT';
    $dbPassword = 'Fongngu123';
    $dbName = 'web_csdl';

    $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Nhận productId từ query string và kiểm tra
    $productId = isset($_GET['productId']) ? intval($_GET['productId']) : 0;

    if ($productId <= 0) {
        die("<h3>Sản phẩm không tồn tại!</h3>");
    }

    // Truy vấn chi tiết sản phẩm bằng prepared statement
    $stmt = $conn->prepare("SELECT * FROM product WHERE productId = ?");
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        die("<h3>Sản phẩm không tồn tại!</h3>");
    }
    ?>

    <!-- Chi tiết sản phẩm -->
    <div class="prd-only">
        <div class="prd-img">
            <img src="admin/image/<?php echo htmlspecialchars($row['productImage']); ?>" />
        </div>
        <div class="prd-intro">
            <h3><?php echo htmlspecialchars($row['productName']); ?></h3>
            <p>Giá sản phẩm: <span><?php echo number_format($row['productPrice'] * (100 - (int)$row['promotion']) / 100, 0, ',', '.'); ?> VNĐ</span></p>
            <table>
                <tr>
                    <td width="30%"><span>Bảo hành:</span></td>
                    <td><?php echo htmlspecialchars($row['guarantee']); ?></td>
                </tr>
                <tr>
                    <td><span>Đi kèm:</span></td>
                    <td><?php echo htmlspecialchars($row['accessory']); ?></td>
                </tr>
                <tr>
                    <td><span>Khuyến Mại:</span></td>
                    <td><?php echo htmlspecialchars($row['promotion']); ?>%</td>
                </tr>
                <tr>
                    <td><span>Còn hàng:</span></td>
                    <td><?php echo $row['inStock'] ? "Còn hàng" : "Hết hàng"; ?></td>
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
                    <li class="required">Số lượng <br /><input required type="number" name="quantity" min="1" /></li>
                    <li><input type="submit" name="buyNow" value="Xác nhận mua hàng" /></li>
                </ul>
            </form>
        </div>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buyNow'])) {
        // Lấy dữ liệu từ form
        $customerName = trim($_POST['customerName']);
        $phone = trim($_POST['phone']);
        $email = trim($_POST['email']);
        $address = trim($_POST['address']);
        $quantity = intval($_POST['quantity']);

        if ($quantity <= 0) {
            die("<h3>Số lượng sản phẩm không hợp lệ!</h3>");
        }

        $productPrice = $row['productPrice'] * (100 - (int)$row['promotion']) / 100;
        $totalPrice = $productPrice * $quantity;

        // Kiểm tra khách hàng
        $stmt = $conn->prepare("SELECT * FROM customers WHERE email = ? OR phone = ?");
        $stmt->bind_param("ss", $email, $phone);
        $stmt->execute();
        $customerResult = $stmt->get_result();

        if ($customerResult->num_rows > 0) {
            $customer = $customerResult->fetch_assoc();
            $customerNumber = $customer['customerNumber'];
        } else {
            $stmt = $conn->prepare("INSERT INTO customers (customerName, phone, email, address) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $customerName, $phone, $email, $address);
            $stmt->execute();
            $customerNumber = $stmt->insert_id;
        }

        // Tạo đơn hàng
        $stmt = $conn->prepare("INSERT INTO orders (orderDate, customerNumber) VALUES (NOW(), ?)");
        $stmt->bind_param("i", $customerNumber);
        $stmt->execute();
        $orderNumber = $stmt->insert_id;

        // Thêm chi tiết đơn hàng
        $stmt = $conn->prepare("INSERT INTO orderdetail (orderNumber, productId, quantityOrdered) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $orderNumber, $productId, $quantity);
        $stmt->execute();

        // Thêm thanh toán
        $stmt = $conn->prepare("INSERT INTO payments (customerNumber, paymentDate, amount, orderNumber) VALUES (?, NOW(), ?, ?)");
        $stmt->bind_param("idi", $customerNumber, $totalPrice, $orderNumber);
        $stmt->execute();

        echo "<div class='order-success'>
                <h3>Đặt hàng thành công!</h3>
                <p>Cảm ơn bạn, $customerName. Thông tin đơn hàng:</p>
                <ul>
                    <li><strong>Tên sản phẩm:</strong> " . htmlspecialchars($row['productName']) . "</li>
                    <li><strong>Giá:</strong> " . number_format($productPrice, 0, ',', '.') . " VNĐ</li>
                    <li><strong>Số lượng:</strong> $quantity</li>
                    <li><strong>Tổng tiền:</strong> " . number_format($totalPrice, 0, ',', '.') . " VNĐ</li>
                    <li><strong>Địa chỉ nhận hàng:</strong> " . htmlspecialchars($address) . "</li>
                </ul>
              </div>";
    }
    ?>
    <div class="divider"></div> 
    <?php
    // Truy vấn sản phẩm liên quan dựa trên orderDetail và product
    $relatedProductsSql = "
    SELECT p.*
    FROM product p
    WHERE p.productLineId = (SELECT productLineId FROM product WHERE productId = ?)
    AND p.productId != ?
    LIMIT 3";

    $stmt = $conn->prepare($relatedProductsSql);
    $stmt->bind_param("ii", $productId, $productId);
    $stmt->execute();
    $relatedProducts = $stmt->get_result();

    if ($relatedProducts->num_rows > 0) {
        echo "<div class='related-products'>
            <h3>Sản phẩm liên quan:</h3>
            <ul>";
        while ($row = $relatedProducts->fetch_assoc()) {
            ?>
            <div class="prd-item">
                <a href="mainCustomer.php?page_layout=productDetail&productId=<?php echo $row['productId'] ?>">
                    <img src="admin/image/<?php echo $row['productImage'] ?>">
                </a>
                <h3>
                    <a href="mainCustomer.php?page_layout=productDetail&productId=<?php echo $row['productId'] ?>">
                        <?php echo $row['productName'] ?>
                    </a>
                </h3>
                <p>Bảo hành: <?php echo $row['guarantee'] ?></p>
                <p class="price">
                    <span>Giá: <?php echo $row['productPrice'] ?> VNĐ</span>
                </p>
            </div>
    <?php
        }
        echo "</ul></div>";
    } else {
        echo "<p>Không có sản phẩm liên quan.</p>";
    }
    ?>

</div>