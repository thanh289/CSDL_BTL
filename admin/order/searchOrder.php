<?php
    $dbHost = 'localhost';
    $dbUsername = 'TFT';
    $dbPassword = 'Fongngu123';
    $dbName = 'web_csdl';

    $conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $searchText = isset($_GET['stext']) ? $_GET['stext'] : '';
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $rowsPerPage = 10;
    $perRow = ($page - 1) * $rowsPerPage;

    $sql = "SELECT o.orderNumber, o.customerNumber, o.orderDate, 
                od.productId, od.quantityOrdered
            FROM orders AS o
            JOIN orderDetail AS od ON o.orderNumber = od.orderNumber
            WHERE o.customerNumber LIKE '%$searchText%'
            OR od.productId LIKE '%$searchText%'
            OR o.orderDate LIKE '%$searchText%'
            LIMIT $perRow, $rowsPerPage";

    $result1 = $conn->query($sql);

    $sqlTotal = "SELECT COUNT(*) AS totalRows 
                FROM orders AS o
                JOIN orderDetail AS od ON o.orderNumber = od.orderNumber
                WHERE o.customerNumber LIKE '%$searchText%'
                    OR od.productId LIKE '%$searchText%'
                    OR o.orderDate LIKE '%$searchText%'";
    $resultTotal = $conn->query($sqlTotal);
    $totalRows = $resultTotal->fetch_assoc()['totalRows'];
    $totalPage = ceil($totalRows / $rowsPerPage);
?>

<link rel="stylesheet" type="text/css" href="css/order.css" />

<h2>Tìm kiếm đơn hàng</h2>

<div id="main">
    
    <div id="search-bar">
        <form method="get" name="sform" action="mainAdmin.php">
            <input type="hidden" name="page_layout" value="searchOrder">
            <input type="text" name="stext" value="<?php echo $searchText; ?>" placeholder="Nhập từ khóa tìm kiếm">
        </form>
    </div>

    <table id="orders" cellpadding="0" cellspacing="0" width="100%">
        <tr id="order-bar">
            <td width="20%">Mã đơn hàng</td>
            <td width="20%">Mã khách hàng</td>
            <td width="20%">Ngày đặt hàng</td>
            <td width="20%">Mã sản phẩm</td>
            <td width="20%">Số lượng</td>
        </tr>
        <?php
            if ($result1->num_rows > 0) {
                while ($row = $result1->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $row['orderNumber']; ?></td>
            <td><?php echo $row['customerNumber']; ?></td>
            <td><?php echo $row['orderDate']; ?></td>
            <td><?php echo $row['productId']; ?></td>
            <td><?php echo $row['quantityOrdered']; ?></td>
        </tr>
        <?php
                }
            } else {
                echo '<tr><td colspan="5">Không tìm thấy kết quả nào!</td></tr>';
            }
        ?>
    </table>

    <p id="pagination">
        <?php
        for ($i = 1; $i <= $totalPage; $i++) {
            if ($i == $page) {
                echo "<span>$i</span> ";
            } else {
                echo '<a href="' . $_SERVER['PHP_SELF'] . '?page_layout=searchOrder&page=' . $i . '&stext=' . $searchText . '">' . $i . '</a> ';
            }
        }
        ?>
    </p>
</div>
