<?php
    $dbHost = 'localhost';
    $dbUsername = 'TFT';
    $dbPassword = 'Fongngu123';
    $dbName = 'web_csdl';

    $conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $rowsPerPage = 10;
    $perRow = ($page - 1) * $rowsPerPage;

    // Cập nhật SQL với JOIN để lấy thông tin từ bảng customers
    $sql = "SELECT payments.paymentDate, payments.amount, payments.orderNumber, 
                   customers.customerName, customers.phone, customers.address
            FROM payments
            JOIN customers ON payments.customerNumber = customers.customerNumber
            LIMIT $perRow, $rowsPerPage";
    $result1 = $conn->query($sql);

    $query = "SELECT COUNT(*) AS totalRows FROM payments";
    $result2 = $conn->query($query);
    $totalRows = $result2->fetch_assoc()['totalRows'];
    $totalPage = ceil($totalRows / $rowsPerPage);
?>

<link rel="stylesheet" type="text/css" href="css/payment.css" />

<h2>Quản lý thanh toán</h2>

<div id="main">
    <div id="search-bar">
        <form method="get" name="sform" action="mainAdmin.php">
            <input type="hidden" name="page_layout" value="searchPayment">
            <input type="text" name="stext" placeholder="Tìm kiếm thanh toán">
        </form>
    </div>

    <table id="payments" cellpadding="0" cellspacing="0" width="100%">
        <tr id="payment-bar">
            <td>Họ và tên KH</td>
            <td>Điện thoại</td>
            <td>Địa chỉ</td>
            <td>Ngày thanh toán</td>
            <td>Số tiền</td>
            <td>Mã đơn hàng</td>
        </tr>
        <?php
        if ($result1->num_rows > 0) {
            while ($row = $result1->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $row['customerName']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['paymentDate']; ?></td>
            <td><?php echo $row['amount']; ?></td>
            <td><?php echo $row['orderNumber']; ?></td>
        </tr>
        <?php
            }
        }
        ?>
    </table>
    
    <p id="pagination">
        <?php
        for ($i = 1; $i <= $totalPage; $i++) {
            if ($i == $page) {
                echo "<span>$i</span> ";
            } else {    
                echo '<a href="' . $_SERVER['PHP_SELF'] . '?page_layout=payment&page=' . $i . '">' . $i . '</a> ';
            }
        }
        ?>
    </p>
</div>
