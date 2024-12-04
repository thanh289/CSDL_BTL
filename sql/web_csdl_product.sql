-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: localhost    Database: web_csdl
-- ------------------------------------------------------
-- Server version	8.0.39

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `productId` int NOT NULL AUTO_INCREMENT,
  `productLineId` int NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productImage` varchar(255) NOT NULL,
  `productPrice` int NOT NULL,
  `guarantee` varchar(255) NOT NULL,
  `accessory` varchar(255) NOT NULL,
  `promotion` int NOT NULL,
  `inStock` int NOT NULL,
  `special` int NOT NULL,
  `detail` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`productId`),
  KEY `fk_product_productline1_idx` (`productLineId`),
  CONSTRAINT `fk_product_productline1` FOREIGN KEY (`productLineId`) REFERENCES `productline` (`productLineId`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,1,'Móc Khoá Momonga','Momonga.webp',115000,'15 ngày','Sticker',0,1,0,'Móc Khoá Momonga Hoạt Hình Chiikawa Đáng Yêu                    '),(2,1,'Móc Khoá Momonga x Kuromi','Momonga x Kuromi Sanrio.webp',175000,'48 giờ','Sticker',0,1,1,'Móc Khoá Momonga x Kuromi Sanrio Hoạt Hình Chiikawa Quà Tặng Đáng Yêu                    '),(4,1,'Móc Khoá Momonga Rakko Usagi','Momonga Rakko Usagi.webp',175000,'48 giờ','Cài Áo, Ghim Cài Túi',0,1,0,'Móc Khoá Momonga Rakko Usagi Kiêm Cài Áo Ghim Cài Túi Hoạt Hình Chiikawa Đáng Yêu                                                            '),(5,2,'Đèn Mèo Hoạt Hình','cat lamp.webp',255000,'48 giờ','Dây Sạc đầu Type C',0,1,0,'Đèn Ngủ Mèo Hoạt Hình Trang Trí Bàn Làm Việc Bàn Học Cực Dễ Thương\r\n• Chất liệu: Silicon + PC + ABS\r\n• Kích thước: 15*10.2*11cm\r\n• Bộ gồm: Đèn + Dây Sạc đầu Type C\r\n• 3 chế độ sáng vỗ để thay đổi, chế độ hẹn giờ 30 phút'),(6,2,'Đèn Khối Minecraft Diamond','minecraft lamp.webp',180000,'48 giờ','Dây sạc đầu USB',0,1,0,'Đèn Khối Minecraft Diamond Đèn Để Bàn Trang Trí Có Thể Sạc Lại\r\n\r\n• Chất liệu: Nhựa ABS\r\n• Kích thước: 7.5*7.5*7.5cm\r\n• 4 Màu: Xanh Dương, Đỏ, Vàng, Xanh Lục\r\n• Đèn tắt/bật cảm ứng, sạc lại bằng dây sạc đầu USB có đi kèm với đèn\r\n\r\n* Lưu ý: \r\n- Hướng Dẫn Sử Dụng: Đèn tắt/bật/thay đổi mức sáng đèn bằng cách gõ nhẹ ở trên đèn (đèn cảm ứng) gõ mà đèn không lên có thể do hết pin, hãy cắm sạc với dây sạc đi kèm trong hộp.'),(7,2,'Đèn Ngủ Capybara','cabybara lamp.webp',275000,'48 giờ','Dây Sạc đầu Type C',0,0,0,'Đèn Ngủ Capybara Chuột Lang Nước Đội Quả Cam Cực Dễ Thương\r\n\r\n• Chất liệu: Silicon + PC + ABS\r\n• Bộ gồm: Đèn Capybara + Quả Cam Đội Đầu + Dây Sạc đầu Type C\r\n• 3 chế độ sáng                    '),(8,2,'Đèn Ngủ Gấu Trúc Mr.PA ','panda lamp.webp',265000,'48 giờ','Dây Sạc đầu Type C',0,1,0,'Đèn Ngủ Gấu Trúc Mr.PA Dễ Thương Có Thể Sạc Lại\r\n\r\n• Chất liệu: Silicon + PC + ABS\r\n• Bộ gồm: Đèn Gấu Trúc + Dây Sạc đầu Type C\r\n• 3 chế độ sáng (Gõ nhẹ vào đèn để tắt/bật và thay đổi chế độ sáng)'),(9,3,'Đồ Chơi Lắp Ráp Wall E ','wall-e.webp',270000,'48 giờ','Không',0,1,0,'Đồ Chơi Lắp Ráp Wall E Nhân Vật Hoạt Hình Disney Wall E\r\n\r\n• Chất liệu: Nhựa ABS \r\n• Số mảnh: 687 mảnh\r\n• kích thước (sau khi lắp xong): 16*16*18cm\r\n\r\nSản phẩm nhiều công dụng như: \r\n- Đối với trẻ nhỏ: giúp phát triển trí não, tăng tính sáng tạo, rèn luyện tính kiên trì cũng như tư duy logic khi tìm ra cách lắp ráp \r\n- Đối với người lớn: dùng làm quà tặng, đồ chơi lắp ráp thư giãn, decor ,...'),(16,2,'Đèn Sứa Trang Trí','đèn sứa.webp',495000,'48 giờ','Dây Sạc đầu Type C + Đế đứng cho sứa + dây để treo sứa',0,0,0,'Đèn Sứa Trang Trí Chuyển Độc Cực Đẹp Thư Giãn Phòng Ngủ Bàn Làm Việc\r\n\r\n• Chất liệu: PC + ABS\r\n• Kích thước sứa: 16.9*8.5cm\r\n• Bộ gồm: Sứa + Dây Sạc đầu Type C + Đế đứng cho sứa + dây để treo sứa\r\n• có chế độ tiết kiệm pin tự tắt/bật khi cảm ứng âm thanh                    '),(17,2,'Đèn Ngủ Pacman','pacman lamp.webp',250000,'48 giờ','Pin và Dây Sạc',0,1,0,'Đèn Ngủ Pacman Nháy Theo Âm Thanh Trang Trí Phòng Ngủ, Phòng Game Cực Đẹp\r\n\r\n• Chất liệu: Nhựa ABS\r\n• Kích thước: 30*10*6cm\r\n• Hỗ trợ kép: Pin và Dây Sạc đi kèm với đèn\r\n• Đèn có 3 chế độ sáng, ấn nút ở trên đèn để tắt/bật và thay đổi chế độ sáng của đèn: 1 - Sáng cơ bản; 2 - Nháy sáng lần lượt; 3 - Nháy sáng theo âm thanh'),(18,2,'Đèn Ngủ Mario','mario lamp.webp',190000,'48 giờ','Dây sạc',0,1,0,'Đèn Ngủ Mario Tắt Bật Có Âm Thanh Vui Nhộn\r\n\r\n• Chất liệu: Nhựa ABS\r\n• Kích thước: 10*10*10cm\r\n• Dây Sạc đi kèm với đèn\r\n• Tắt Bật Có Âm Thanh vụ nhộn đi kèm, để tắt âm, chỉ cần ấn giữ là được'),(20,3,'Lego Xe Đua Lamboghini 1314','lamboghini lego.webp',115000,'15 ngày','Không',10,1,0,'THÔNG TIN SẢN PHẨM:\r\n- Số lượng chi tiết: 1314 PCS\r\n- Tỉ lệ: 1:14\r\n- Chất liệu: Nhựa ABS\r\n- Màu sắc: Màu Cyber Punk\r\n- Kích Thước Mô Hình : 35 cm\r\n- Tiêu chuẩn chất lượng: 3C, EN71, ASTM, HR4040\r\n- Độ tuổi phù hợp : 6 Tuổi Trở Lên'),(21,3,'Lego bó hoa trong chậu','lego-flower.webp',32000,'15 ngày','Không',24,1,1,'Hoa Khối Xây Dựng Nhiều Mở Này Bao Gồm Nhiều Hình Dạng Màu Sắc Và Hình Dạng Và Màu Sắc Khác Nhau, Thực Sự Siêu Đẹp!\r\n\r\nVà Hộp Quà Bao Bì Cũng Siêu Dễ Thương, Rất Thích Hợp Cho Trẻ Em Hoặc Bạn Gái'),(22,1,'Móc khóa Hoạt Hình Thỏ Cáo','rabbit fox keychain.webp',16000,'15 ngày','Không',36,1,0,'Chất liệu: Thỏ sang trọng\r\n\r\nBao bì: 1 chiếc cho 1 lần bán\r\n\r\nKích thước: 6 * 8cm\r\n\r\nMàu sắc: 1 Thỏ giận dữ, 1 Thỏ khóc                    '),(23,1,'Móc khóa hình thỏ nhồi bông','rabbit keychain.webp',32000,'15 ngày','Không',30,1,1,'Chất Liệu: cotton PP\r\n Gói hàng bao gồm: 1 sản phẩm\r\n Kích thước: Như trong hình\r\n Màu sắc: Trắng, Hồng, Cà phê\r\n Nhỏ và dễ thương, dễ mang theo, khả năng ứng dụng rộng rãi.'),(25,1,'Móc khóa heo con sang trọng đáng yêu','pig keychain.webp',30000,'15 ngày','Không',0,1,0,'1. Tính thiết thực: mặt dây chuyền chìa khóa đầu heo kêu không chỉ là một vật trang trí đáng yêu mà còn là một mặt dây chuyền chìa khóa thiết thực. Dễ dàng mang theo và bạn có thể dễ dàng tìm thấy chìa khóa của mình.\r\n\r\n2. Vui nhộn: Mặt dây chuyền chìa khóa này có chức năng phát ra tiếng kêu, không chỉ dễ thương và liên tục mà còn có thể được sử dụng như một món đồ chơi xả áp. Cả người lớn và trẻ em sẽ thích nó.\r\n\r\n3. Chất liệu chất lượng: Mặt dây chuyền Chìa khóa đầu heo Squeaky của chúng tôi được làm bằng vật liệu chất lượng cao thân thiện với môi trường, mềm, bền, tay nghề tinh tế và các chi tiết hoàn hảo.'),(26,9,'Truyện Tranh Thanh Gươm Diệt Quỷ','kimetsu.webp',504000,'Không','Sticker',0,1,1,'Tác giả: Koyoharu Gotouge\r\n\r\nĐối tượng: Tuổi mới lớn (15 – 18)\r\n\r\nKhuôn Khổ: 11.3x17.6 cm\r\n\r\nSố trang: 232\r\n\r\nĐịnh dạng: bìa mềm\r\n\r\nTrọng lượng: 125 gram\r\n\r\n'),(27,9,'Truyện Shin Cậu Bé Bút Chì 50 Tập','shin.webp',729000,'Không','Không',0,1,0,'Truyện Shin Cậu Bé Bút Chì - Trọn bộ 50 tập - NXB Kim Đồng\r\n\r\nTác giả: Yoshito Usui\r\n\r\nNăm phát hành: 2019\r\n\r\nSố trang: 196\r\n\r\nHình thức: Đọc ngược'),(28,9,'Horimiya Artbook','horimiya.webp',427000,'Không','Standee',5,1,1,'Công ty phát hành: IPM\r\n\r\nNhà xuất bản: Hồng Đức\r\n\r\nTác giả: HERO x Hagiwara Daisuke\r\n\r\nThể loại: Artbook, manga\r\n\r\nKhổ: 14,8 x 21 cm\r\n\r\nSố trang: 232 trang\r\n\r\nNăm xuất bản: 2024'),(29,9,'Truyện tranh màu - Tây Du Tuệ Kẻ','tây du tuệ kẻ.webp',157500,'24 giờ','Bookmark',10,1,1,'\" Tây Du Tuệ Kẻ \"\r\nQuà tặng: \r\n- Bản thường: 01 bookmark bế hình nhân vật (Quà kẹp trong sách)\r\n\r\n- Bản đặc biệt: \r\n01 bookmark bế hình nhân vật (Quà kẹp trong sách)\r\n01 postcard bồi cứng (Quà kẹp trong sách)\r\n07 card nhân vật cán nhũ (Quà kẹp trong sách)\r\n\r\nĐơn vị phát hành skybooks\r\n\r\nTác giả: Tống Tất Tuệ\r\n\r\nThể loại:  Truyện tranh, hài hước, hành động, giả tưởng, huyền ảo       \r\n\r\nKhổ: 14,5x20,5 cm\r\n\r\nSố trang: 192 trang'),(30,9,'Truyện tranh Nobita Và Bản Giao Hưởng','bản giao hưởng.webp',33250,'Không','Không',5,1,0,'\r\nDoraemon - Movie Story Màu - Nobita Và Bản Giao Hưởng Địa Cầu Chuẩn bị cho buổi hòa nhạc ở trường, Nobita đang tập thổi sáo Recorder - nhạc cụ mà cậu chơi dở nhất. Thích thú trước nốt \"No\" lạc quẻ của Nobita, Micca - một cô bé bí ẩn đã mời Doraemon, Nobita cùng nhóm bạn đến \"Farre\" - Cung điện âm nhạc tọa lạc trên một hành tinh nơi âm nhạc sẽ hóa thành năng lượng. Nhằm cứu cung điện này, Micca và Chapeck đang tìm kiếm 5 \"Virtouso\" - bậc thầy âm nhạc huyền thoại sẽ cùng mình biểu diễn!'),(31,9,'Truyện Tranh - Chainsaw Man ( từ Tập 1 đến Tập 11)','chainsawman.webp',250000,'Không','Không',0,1,0,'Câu chuyện của CHAINSAW MAN mô tả một thế giới nơi ma quỷ và con người cùng tồn tại, và trong đó con người có thể lập khế ước để đạt được sức mạnh của quỷ.\r\n\r\nVì số nợ khổng lồ của cha để lại, nhân vật chính Denji cùng con quỷ nhỏ Pochita làm tất cả mọi công việc để có thể hoàn nợ. Sau một tai nạn, Denji bị giết, Pochita đã hòa làm một với Denji, giúp cậu hồi sinh và hóa thành “Quỷ cưa” hùng mạnh. Sau đó, Denji được Makima nhận vào tổ chức săn quỷ và hành trình diệt quỷ của Denji bắt đầu từ đây.'),(32,3,'Lego DIY PIECECOOL mô hình vương miện','lego vương miện.webp',599000,'Không','Không',5,1,1,'[Dễ dàng lắp ráp] Các mảnh kim loại của set mô hình lắp ráp kim loại 3D được làm từ chất liệu thép không gỉ cao cấp và tất cả các bộ phận kim loại sẽ dễ dàng cắt ra, không cần keo dán hoặc chất hàn trong quá trình lắp ráp.\r\n\r\n[Thời gian tạo niềm vui] Giải phóng áp lực làm việc của bạn, tận hưởng những giờ vui chơi với gia đình và bạn bè của bạn từ quá trình lắp ráp mô hình kim loại 3D, cũng sẽ khuyến khích khả năng thực hành và tư duy logic của bạn.'),(33,3,' Zane LEGO NINJAGO 71816','lego zane.webp',256000,'Không','Không',17,1,0,'Đồ Chơi Lắp Ráp Siêu Xe Băng Tuyết Của Zane LEGO NINJAGO 71816 (84 chi tiết)\r\n\r\nBộ lắp ráp Siêu xe băng tuyết của Zane (71816) mang đến những trải nghiệm hành động lấy cám hứng từ mùa 2 của bộ phim hoạt hình NINJAGO Dragons Rising. Bộ lắp ráp này bao gồm một chiếc siêu xe máy NINJAGO với 2 bánh xe lớn, lưỡi dao vàng và hệ thống phuộc trên lốp sau. Khi ấn xuống lốp, các lưỡi băng sẽ chuyển từ chế độ tấn công sang gấp lại ở cả hai bên. Chiến xe đi kèm với một minifigure Zane. Zane được trang bị bộ giáp chưa từng xuất hiện trước đây và cầm 2 thanh kiếm katana.\r\n\r\nBộ lắp ráp gồm 84 mảnh LEGO');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-04 11:02:28
