<link rel="stylesheet" href="css/productDetail.css" />
<div class="prd-block">

    <!-- Detail of product go here -->
    <div class="prd-only">
    <?php
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
                            $stock = $row['inStock'] ;
                            if($stock) echo "Còn hàng";
                            else echo "Hết hàng";
                        ?>
                    </td>
                </tr>
            </table>
            <p class="add-cart">
                <a href="mainCustomer.php?page_layout=buyProduct&productId=<?php echo $row['productId'] ?>">
                    <span>Đặt mua</span>
                </a>
            </p>
        </div>
        
        <div class="clear"></div>
        
        <div class="prd-details">
            <p><?php echo $row['detail'] ?></p>
        </div>
    </div>
    
    <!-- Type comment go here -->
    <div class="prd-comment">
        <h3>Bình luận sản phẩm</h3>
        <form method="post">
            <ul>
                <li class="required">Tên <br/><input required type="text" name="customerName"/></li>
                <li class="required">Số điện thoại <br/><input required type="text" name="phone"/></li>
                <li class="required">Nội dung <br/>
                    <textarea required name="comment"></textarea>
                </li>
                <li><input type="submit" name="submit" value="Bình luận"/></li>
            </ul>
        </form>
    </div>

    <!-- Add comment to MySQL -->
    <?php
        if (isset($_POST['submit'])) {
            // Lấy dữ liệu từ form
            $customerName = $_POST['customerName'];
            $phone = $_POST['phone'];
            $comment = $_POST['comment'];
            date_default_timezone_set('Asia/SaiGon');
            $commentDate = date('Y-m-d H:i:s');
        
            // Truy vấn kiểm tra thông tin khách hàng, đơn hàng và sản phẩm
            $sqlCheck = "
                SELECT c.customerName, c.phone, c.customerNumber, o.orderNumber, od.productId
                FROM orders o
                INNER JOIN orderDetail od on o.orderNumber = od.orderNumber 
                INNER JOIN customers c on c.customerNumber = o.customerNumber
                WHERE c.phone = '$phone' AND od.productId = $productId;
            ";
            $resultCheck = $conn->query($sqlCheck);
            if (!$resultCheck) {
                die("Lỗi SQL: " . $conn->error);
            }
        
            if ($resultCheck->num_rows > 0) {
                // Nếu thông tin hợp lệ, thêm bình luận
                $rowCheck = $resultCheck->fetch_assoc();
                $productId = $rowCheck['productId'];
                $customerNumber = $rowCheck['customerNumber'];

                $sqlAddComment = "
                    INSERT INTO comment (productId, customerNumber, comment, commentDate) 
                    VALUES ($productId, '$customerNumber', '$comment', '$commentDate');
                ";
                if ($conn->query($sqlAddComment)) {
                    echo '<p style="color: green;">Bình luận đã được thêm thành công!</p>';
                } else {
                    echo '<p style="color: red;">Đã xảy ra lỗi khi thêm bình luận. Vui lòng thử lại.</p>';
                }
            } else {
                // Nếu không tìm thấy thông tin phù hợp
                echo '<p style="color: red;">Bạn chưa mua sản phẩm này, nên không thể bình luận.</p>';
            }
        }
        
    ?>

    <!-- All comments is shown here -->
    <?php
        // Number of comments per page
        $commentsPerPage = 5;

        // Get the current page number from the URL, default is 1 if not set
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        // Calculate the starting point for the query
        $start = ($page - 1) * $commentsPerPage;

        // Query to fetch the comments with pagination
        $sql = "
            SELECT cmt.*, c.customerName
            FROM comment cmt
            INNER JOIN customers c ON c.customerNumber = cmt.customerNumber
            WHERE cmt.productId = $productId
            LIMIT $start, $commentsPerPage
        ";
        $cmtList = $conn->query($sql);

        while($row = $cmtList->fetch_assoc()){
    ?>
        <div class="comment-list">
            <ul>
                <li class="com-title"><?php echo $row['customerName'] ?><br />
                <span>
                    <?php
                        $oriDate = $row['commentDate'];
                        $newDate = date('d-m-Y H:i:s', strtotime($oriDate));
                        echo $newDate;
                    ?>
                </span></li>
                <li class="com-details"><?php echo $row['comment']; ?></li>
            </ul>
        </div>
            
    <?php
        }

        // Query to get the total number of comments for the product
        $sqlTotal = "SELECT COUNT(*) AS totalComments FROM comment WHERE productId = $productId";
        $resultTotal = $conn->query($sqlTotal);
        $totalComments = $resultTotal->fetch_assoc()['totalComments'];

        // Calculate the total number of pages
        $totalPages = ceil($totalComments / $commentsPerPage);
    ?>

    <!-- Pagination links -->
    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="mainCustomer.php?page_layout=productDetail&productId=<?php echo $productId; ?>&page=<?php echo $page - 1; ?>">Previous</a>
        <?php endif; ?>

        <?php
            for ($i = 1; $i <= $totalPages; $i++) {
                if ($i == $page) {
                    echo '<span class="current-page">' . $i . '</span>';
                } else {
                    echo '<a href="mainCustomer.php?page_layout=productDetail&productId=' . $productId . '&page=' . $i . '">' . $i . '</a>';
                }
            }
        ?>

        <?php if ($page < $totalPages): ?>
            <a href="mainCustomer.php?page_layout=productDetail&productId=<?php echo $productId; ?>&page=<?php echo $page + 1; ?>">Next</a>
        <?php endif; ?>
    </div>
</div>