<link rel="stylesheet" type="text/css" href="css/muahang.css" />

<div class="prd-block">
	<h2>Xác nhận hóa đơn thanh toán</h2>
    <div class="payment">
    	<table border="0px" cellpadding="0px" cellspacing="0px" width="100%">
        	<tr id="invoice-bar">
            	<td width="45%">Tên Sản phẩm</td>
                <td width="20%">Giá</td>
                <td width="15%">Số lượng</td>
                <td width="20%">Thành tiền</td>
            </tr>
            <?php
                $productIds = array();
                // Retrieve product IDs from session cart array
                foreach ($_SESSION['cart'] as $productId => $quantity) {
                    $productIds[] = $productId;
                }
                // Convert product ID array to a comma-separated string
                $productIdString = implode(',', $productIds);
                $sql = "SELECT * FROM sanpham WHERE id_sp IN ($productIdString)";
                $query = mysql_query($sql);
                $totalInvoiceAmount = 0;
                while ($row = mysql_fetch_array($query)) {
                    $totalPrice = $_SESSION['cart'][$row['id_sp']] * $row['gia_sp'];
            ?>
            <tr>
            	<td class="prd-name"><?php echo $row['ten_sp'] ?></td>
                <td class="prd-price"><?php echo $row['gia_sp'] ?> VNĐ</td>
                <td class="prd-number"><?php echo $_SESSION['cart'][$row['id_sp']] ?></td>
                <td class="prd-total"><?php echo $totalPrice ?> VNĐ</td>
            </tr>
             <?php
                    $totalInvoiceAmount += $totalPrice;
                }
            ?>
            <tr>
            	<td class="prd-name">Tổng giá trị hóa đơn là:</td>
                <td colspan="2"></td>
                <td class="prd-total"><span><?php echo $totalInvoiceAmount ?> VNĐ</span></td>
            </tr>
        </table>
    </div>
    
    <div class="form-payment">
    	<form method="post">
    	<ul>
        	<li class="info-cus"><label>Tên khách hàng</label><br /><input required type="text" name="customer_name" /></li>
            <li class="info-cus"><label>Địa chỉ Email</label><br /><input required type="text" name="email" /></li>
            <li class="info-cus"><label>Số Điện thoại</label><br /><input required type="text" name="phone" /></li>
            <li class="info-cus"><label>Địa chỉ nhận hàng</label><br /><input required type="text" name="address" /></li>
            <li><input type="submit" name="submit" value="Xác nhận mua hàng" /> <input type="reset" name="reset" value="Làm lại" /></li>
        </ul>
        </form>
    </div>
</div>
<?php
    if (isset($customer_name) && isset($email) && isset($phone) && isset($address)) {
        if (isset($_SESSION['cart'])) {
            $productIds = array();
            foreach ($_SESSION['cart'] as $productId => $quantity) {
                $productIds[] = $productId;
            }
            $productIdString = implode(', ', $productIds);
            $sql = "SELECT * FROM sanpham WHERE id_sp IN ($productIdString) ORDER BY id_sp DESC";
            $query = mysqli_query($sql);
        }
        $emailBody = '';
        // Customer information
        $emailBody = '<p>
        <b>Khách hàng:</b> ' . $customer_name . '<br />
        <b>Email:</b> ' . $email . '<br />
        <b>Điện thoại:</b> ' . $phone . '<br />
        <b>Địa chỉ:</b> ' . $address . '
        </p>';
        // List of purchased products
        $emailBody .= '<table border="1px" cellpadding="10px" cellspacing="1px" width="100%">
        <tr>
        <td align="center" bgcolor="#3F3F3F" colspan="4"><font color="white"><b>XÁC NHẬN HÓA ĐƠN THANH TOÁN</b></font></td>
        </tr>
        <tr id="invoice-bar">
        <td width="45%"><b>Tên Sản phẩm</b></td>
        <td width="20%"><b>Giá</b></td>
        <td width="15%"><b>Số lượng</b></td>
        <td width="20%"><b>Thành tiền</b></td>
        </tr>';
        $totalInvoiceAmount = 0;
        while ($row = mysql_fetch_array($query)) {
            $totalPrice = $row['gia_sp'] * $_SESSION['cart'][$row['id_sp']];
            $emailBody .= '<tr>
            <td class="prd-name">' . $row['ten_sp'] . '</td>
            <td class="prd-price"><font color="#C40000">' . $row['gia_sp'] . ' VNĐ</font></td>
            <td class="prd-number">' . $_SESSION['cart'][$row['id_sp']] . '</td>
            <td class="prd-total"><font color="#C40000">' . $totalPrice . ' VNĐ</font></td>
            </tr>';
            $totalInvoiceAmount += $totalPrice;
        }
        $emailBody .= '<tr>
        <td class="prd-name">Tổng giá trị hóa đơn là:</td>
        <td colspan="2"></td>
        <td class="prd-total"><b><font color="#C40000">' . $totalInvoiceAmount . ' VNĐ</font></b></td>
        </tr>
        </table>';
        $emailBody .= '<p align="justify">
        <b>Quý khách đã đặt hàng thành công!</b><br />
        • Sản phẩm của Quý khách sẽ được chuyển đến Địa chỉ có trong phần
        Thông tin Khách hàng sau thời gian 2 đến 3 ngày, tính từ thời điểm này.<br />
        • Nhân viên giao hàng sẽ liên hệ với Quý khách qua Số Điện thoại trước khi giao hàng 24 tiếng.<br />
        <b><br />Cám ơn Quý khách đã sử dụng Sản phẩm của Công ty chúng Tôi!</b>
        </p>';
        // Configure PHP Mailer to send email
        require("class.phpmailer.php"); // Load the library
        $mailer = new PHPMailer(); // Initialize the object
        $mailer->IsSMTP(); // Use SMTP
        $mailer->CharSet = "utf-8"; // Set character encoding
        // Gmail login
        $mailer->SMTPAuth = true;
        $mailer->SMTPSecure = "ssl";
        $mailer->Host = "smtp.gmail.com";
        $mailer->Port = 465;
        // Update these details
        $mailer->Username = "www.vietpro.edu.vn@gmail.com";
        $mailer->Password = "vietpro123";
        $mailer->AddAddress($email, $customer_name);
        $mailer->AddCC("sirtuanhoang@gmail.com", "Admin Vietpro Shop");
        // Prepare to send the email
        $mailer->FromName = 'Vietpro Shop';
        $mailer->From = 'www.vietpro.edu.vn5@gmail.com';
        $mailer->Subject = 'Hóa đơn xác nhận mua hàng từ Vietpro Shop';
        $mailer->IsHTML(true);
        $mailer->Body = $emailBody;
        // Send email
        if (!$mailer->Send()) {
            echo "Lỗi gửi Email: " . $mailer->ErrorInfo;
        } else {
            header('location:index.php?page_layout=hoanthanh');
        }
    }
?>
