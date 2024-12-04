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
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customers` (
  `customerNumber` int NOT NULL AUTO_INCREMENT,
  `customerName` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(225) NOT NULL,
  PRIMARY KEY (`customerNumber`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'tuandepzai','09123456789','tuan@123','hk'),(2,'Tran Duy Thanh','0962640750','tranduythanh2809@gmail.com','Hà Đông'),(3,'sdfsdg','13425678765','2@2','hà nội'),(4,'phong','0912658723','phong@gmail.com','thanh xuân, hà nội'),(5,'phong','0934651788','2@2gmail.com','khương trung, hà nội'),(6,'Tuan','012345678','dtun@gmail.com','Đại học quốc gia Hà Nội'),(7,'phong','0532187423','p@gmail.com','Viet Nam'),(8,'Nguyen Anh','0123456789','nguyen.anh@example.com','Hanoi, Vietnam'),(9,'Tran Minh','0987654321','tran.minh@example.com','Ho Chi Minh City, Vietnam'),(10,'Le Bich','0912345678','le.bich@example.com','Da Nang, Vietnam'),(11,'Pham Quang','0922334455','pham.quang@example.com','Can Tho, Vietnam'),(12,'Nguyen Mai','0933445566','nguyen.mai@example.com','Hue, Vietnam'),(13,'Trinh Thi','0977665544','trinh.thi@example.com','Ha Long, Vietnam'),(14,'Duong Thi','0988776655','duong.thi@example.com','Nha Trang, Vietnam'),(15,'Hoang Thanh','0900123456','hoang.thanh@example.com','Vinh, Vietnam'),(16,'Mai Lan','0911888777','mai.lan@example.com','Sapa, Vietnam'),(17,'Vu Minh','0903445566','vu.minh@example.com','Quang Ninh, Vietnam');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-04 18:17:34
