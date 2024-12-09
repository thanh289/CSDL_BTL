-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: web_csdl
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
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comment` (
  `commentId` int NOT NULL AUTO_INCREMENT,
  `productId` int NOT NULL,
  `customerNumber` int NOT NULL,
  `comment` text NOT NULL,
  `commentDate` datetime NOT NULL,
  PRIMARY KEY (`commentId`),
  KEY `fk_comment_product_idx` (`productId`),
  KEY `fk_comment_customer_idx` (`customerNumber`),
  CONSTRAINT `fk_comment_customer` FOREIGN KEY (`customerNumber`) REFERENCES `customers` (`customerNumber`),
  CONSTRAINT `fk_comment_product` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (14,32,7,'rat de hong, k nen mua','2024-12-09 13:57:43'),(15,32,7,'hang loi','2024-12-09 13:58:35'),(16,29,7,'Đạo nhái tây du ký trắng trợn','2024-12-09 13:59:29'),(17,9,8,'Robot dỏm vcl','2024-12-09 14:02:06'),(18,9,8,'Moi dung dc 2 hom đã hư rồi, bảo sao bảo hành 48 giờ','2024-12-09 14:02:28'),(19,1,8,'Đặt 2 móc khoá đôi tặng ny sao shop lại gửi 3 cái, làm ny e giận','2024-12-09 14:03:58');
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-09 14:26:42
