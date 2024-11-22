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

    $sql = "SELECT customerNumber, customerName, phone, email, address
            FROM customers
            WHERE customerName LIKE '%$searchText%' 
            OR phone LIKE '%$searchText%' 
            OR email LIKE '%$searchText%' 
            OR address LIKE '%$searchText%'
            LIMIT $perRow, $rowsPerPage";
    $result1 = $conn->query($sql);

    $sqlTotal = "SELECT COUNT(*) AS totalRows
                FROM customers
                WHERE customerName LIKE '%$searchText%' 
                    OR phone LIKE '%$searchText%' 
                    OR email LIKE '%$searchText%' 
                    OR address LIKE '%$searchText%'";
    $resultTotal = $conn->query($sqlTotal);
    $totalRows = $resultTotal->fetch_assoc()['totalRows'];
    $totalPage = ceil($totalRows / $rowsPerPage);
?>

<link rel="stylesheet" type="text/css" href="css/customer.css" />

<div id="main">

    <h2>Tìm kiếm khách hàng</h2>

    <div id="search-bar">
        <form method="get" name="sform" action="mainAdmin.php">
            <input type="hidden" name="page_layout" value="searchCustomer">
            <input type="text" name="stext" value="<?php echo $searchText; ?>" placeholder="Nhập từ khóa tìm kiếm">
        </form>
    </div>

    <table id="customers" cellpadding="0" cellspacing="0" width="100%">
        <tr id="customer-bar">
            <td>Mã KH</td>
            <td>Tên khách hàng</td>
            <td>Số điện thoại</td>
            <td>Email</td>
            <td>Địa chỉ</td>
        </tr>
        <?php
        if ($result1->num_rows > 0) {
            while ($row = $result1->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $row['customerNumber']; ?></td>
            <td><?php echo $row['customerName']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['address']; ?></td>
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
                echo '<a href="' . $_SERVER['PHP_SELF'] . '?page_layout=searchCustomer&page=' . $i . '&stext=' . $searchText . '">' . $i . '</a> ';
            }
        }
        ?>
    </p>
</div>
