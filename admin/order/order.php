<?php
    $dbHost = 'localhost';
    $dbUsername = 'TFT';
    $dbPassword = 'Fongngu123';
    $dbName = 'web_csdl';
    $conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $rowsPerPage = 10;
    $perRow = $page * $rowsPerPage - $rowsPerPage;

    $sql = "SELECT o.orderNumber, o.orderDate, od.productId, od.quantityOrdered, 
                   c.customerName, c.phone, c.address
            FROM orders o
            INNER JOIN orderDetail od ON o.orderNumber = od.orderNumber
            INNER JOIN customers c ON o.customerNumber = c.customerNumber
            LIMIT $perRow, $rowsPerPage";

    $result1 = $conn->query($sql);
?>

<link rel="stylesheet" type="text/css" href="css/order.css" />

<h2>Quản lí đơn hàng</h2>

<div id="main">
    <div id="search-bar">
        <form method="get" name="sform" action="mainAdmin.php">
            <input type="hidden" name="page_layout" value="searchOrder">
            <input type="text" name="stext" placeholder="Tìm kiếm đơn hàng">
        </form>
    </div>

    <table id="orders" cellpadding="0" cellspacing="0" width="100%">
        <tr id="order-bar">
            <td width="10%">Mã đơn hàng</td>
            <td width="15%">Tên khách hàng</td>
            <td width="15%">Số điện thoại</td>
            <td width="20%">Địa chỉ</td>
            <td width="20%">Ngày đặt hàng</td>
            <td width="10%">Mã sản phẩm</td>
            <td width="10%">Số lượng</td>
        </tr>
        <?php
            if ($result1->num_rows > 0) {
                while ($row = $result1->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $row['orderNumber']; ?></td>
            <td><?php echo $row['customerName']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['orderDate']; ?></td>
            <td><?php echo $row['productId']; ?></td>
            <td><?php echo $row['quantityOrdered']; ?></td>
        </tr>
        <?php
                }
            }
        ?>
    </table>

    <?php
        $query = "SELECT * FROM orders";
        $result2 = $conn->query($query);
        $totalRows = mysqli_num_rows($result2);
        $totalPage = ceil($totalRows / $rowsPerPage);
        $listPage = '';
        for ($i = 1; $i <= $totalPage; $i++) {
            if ($i == $page) {
                $listPage .= " <span>" . $i . "</span> ";
            } else {
                $listPage .= ' <a href="' . $_SERVER['PHP_SELF'] . '?page_layout=order&page=' . $i . '">' . $i . '</a> ';
            }
        }
    ?>
    <p id="pagination"><?php echo $listPage; ?></p>
</div>
