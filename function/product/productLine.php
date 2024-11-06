<div class="l-sidebar">
	<h2>Loại hàng</h2>
	<ul id="main-menu">
    <?php
        $sql = "SELECT * FROM productLine";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
    ?>
                <li>
                    <a href="index.php?page_layout=product&productLineId=<?php echo $row['productLineId'] ?>&productLineName=<?php echo $row['productLineName'] ?>">
                        <?php echo $row['productLineName'] ?>
                    </a>
                </li>
    <?php
            } 
        }  
    ?>
    </ul>
</div>