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

    $sql = "SELECT customerNumber, paymentDate, amount, orderNumber 
            FROM payments 
            WHERE customerNumber LIKE '%$searchText%' 
            OR paymentDate LIKE '%$searchText%' 
            OR amount LIKE '%$searchText%' 
            OR orderNumber LIKE '%$searchText%'
            LIMIT $perRow, $rowsPerPage";
    $result1 = $conn->query($sql);

    $sqlTotal = "SELECT COUNT(*) AS totalRows 
                FROM payments 
                WHERE customerNumber LIKE '%$searchText%' 
                    OR paymentDate LIKE '%$searchText%' 
                    OR amount LIKE '%$searchText%' 
                    OR orderNumber LIKE '%$searchText%'";
    $resultTotal = $conn->query($sqlTotal);
    $totalRows = $resultTotal->fetch_assoc()['totalRows'];
    $totalPage = ceil($totalRows / $rowsPerPage);
?>

<link rel="stylesheet" type="text/css" href="css/payment.css" />

<h2>Tìm kiếm thanh toán</h2>

<div id="main">
    
    <div id="search-bar">
        <form method="get" name="sform" action="mainAdmin.php">
            <input type="hidden" name="page_layout" value="searchPayment">
            <input type="text" name="stext" value="<?php echo $searchText; ?>" placeholder="Nhập từ khóa tìm kiếm">
        </form>
    </div>

    <table id="payments" cellpadding="0" cellspacing="0" width="100%">
        <tr id="payment-bar">
            <td>Mã KH</td>
            <td>Ngày thanh toán</td>
            <td>Số tiền</td>
            <td>Mã đơn hàng</td>
        </tr>
        <?php
        if ($result1->num_rows > 0) {
            while ($row = $result1->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $row['customerNumber']; ?></td>
            <td><?php echo $row['paymentDate']; ?></td>
            <td><?php echo $row['amount']; ?></td>
            <td><?php echo $row['orderNumber']; ?></td>
        </tr>
        <?php
            }
        } else {
            echo '<tr><td colspan="4">Không tìm thấy kết quả nào!</td></tr>';
        }
        ?>
    </table>
    
    <p id="pagination">
        <?php
        for ($i = 1; $i <= $totalPage; $i++) {
            if ($i == $page) {
                echo "<span>$i</span> ";
            } else {
                echo '<a href="' . $_SERVER['PHP_SELF'] . '?page_layout=searchPayment&page=' . $i . '&stext=' . $searchText . '">' . $i . '</a> ';
            }
        }
        ?>
    </p>
</div>
