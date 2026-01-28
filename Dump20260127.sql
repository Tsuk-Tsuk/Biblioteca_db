CREATE DATABASE  IF NOT EXISTS `biblioteca` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `biblioteca`;
-- MySQL dump 10.13  Distrib 8.0.43, for Win64 (x86_64)
--
-- Host: localhost    Database: biblioteca
-- ------------------------------------------------------
-- Server version	8.0.44

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
-- Table structure for table `auditoria`
--

DROP TABLE IF EXISTS `auditoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auditoria` (
  `id_auditoria` int NOT NULL AUTO_INCREMENT,
  `tabla_afectada` varchar(50) DEFAULT NULL,
  `operacion` varchar(10) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_auditoria`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auditoria`
--

LOCK TABLES `auditoria` WRITE;
/*!40000 ALTER TABLE `auditoria` DISABLE KEYS */;
INSERT INTO `auditoria` VALUES (1,'categoria','INSERT','2026-01-28 02:55:37','admin'),(2,'autor','INSERT','2026-01-28 02:55:37','admin'),(3,'libro','INSERT','2026-01-28 02:55:37','admin'),(4,'prestamo','INSERT','2026-01-28 02:55:37','admin'),(5,'detalle_prestamo','INSERT','2026-01-28 02:55:37','admin'),(6,'libro','UPDATE','2026-01-28 02:55:37','bibliotecario'),(7,'prestamo','UPDATE','2026-01-28 02:55:37','bibliotecario'),(8,'categoria','UPDATE','2026-01-28 02:55:37','admin'),(9,'autor','UPDATE','2026-01-28 02:55:37','admin'),(10,'libro','DELETE','2026-01-28 02:55:37','admin');
/*!40000 ALTER TABLE `auditoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `autor`
--

DROP TABLE IF EXISTS `autor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `autor` (
  `id_autor` int NOT NULL AUTO_INCREMENT,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `nacionalidad` varchar(50) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `biografia` text,
  `estado` tinyint(1) DEFAULT '1',
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_autor`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `autor`
--

LOCK TABLES `autor` WRITE;
/*!40000 ALTER TABLE `autor` DISABLE KEYS */;
INSERT INTO `autor` VALUES (1,'Gabriel','García Márquez','Colombiana','1927-03-06',NULL,1,'2026-01-28 02:49:21'),(2,'Jorge Luis','Borges','Argentina','1899-08-24',NULL,1,'2026-01-28 02:49:21'),(3,'Isabel','Allende','Chilena','1942-08-02',NULL,1,'2026-01-28 02:49:21'),(4,'Julio','Cortazar','Argentina','1914-08-26','0',1,'2026-01-28 02:49:21'),(5,'Friedrich','Nietzsche','Alemana','1844-10-15',NULL,1,'2026-01-28 02:49:21'),(6,'Stephen','Hawking','Británica','1942-01-08',NULL,1,'2026-01-28 02:49:21'),(7,'Yuval Noah','Harari','Israelí','1976-02-24',NULL,1,'2026-01-28 02:49:21'),(8,'Paulo','Coelho','Brasileña','1947-08-24',NULL,1,'2026-01-28 02:49:21'),(9,'J. R. R.','Tolkien','Británica','1892-01-03',NULL,1,'2026-01-28 02:49:21'),(10,'Platón','','Griega','0427-01-01',NULL,1,'2026-01-28 02:49:21');
/*!40000 ALTER TABLE `autor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categoria` (
  `id_categoria` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text,
  `estado` tinyint(1) DEFAULT '1',
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_categoria`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'Romantico','Libros de romance',1,'2026-01-28 00:58:21'),(2,'Novela','Narrativa literaria',1,'2026-01-28 02:49:21'),(3,'Ciencia Ficción','Futuro y tecnología',1,'2026-01-28 02:49:21'),(4,'Fantasía','Mundos imaginarios',1,'2026-01-28 02:49:21'),(5,'Historia','Hechos históricos',1,'2026-01-28 02:49:21'),(6,'Filosofía','Pensamiento y reflexión',1,'2026-01-28 02:49:21'),(7,'Psicología','Comportamiento humano',1,'2026-01-28 02:49:21'),(8,'Ciencia','Conocimiento científico',1,'2026-01-28 02:49:21'),(9,'Educación','Aprendizaje y enseñanza',1,'2026-01-28 02:49:21'),(10,'Poesía','Expresión poética',1,'2026-01-28 02:49:21'),(11,'Drama','Narrativa dramática',1,'2026-01-28 02:49:21');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cliente` (
  `id_cliente` int NOT NULL AUTO_INCREMENT,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `cedula` varchar(15) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `cedula` (`cedula`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,'Jefferson','Cepeda','123456789','987654321','jeff@gmail.com',1);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_prestamo`
--

DROP TABLE IF EXISTS `detalle_prestamo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalle_prestamo` (
  `id_detalle` int NOT NULL AUTO_INCREMENT,
  `id_prestamo` int DEFAULT NULL,
  `id_libro` int DEFAULT NULL,
  `cantidad` int DEFAULT NULL,
  PRIMARY KEY (`id_detalle`),
  KEY `id_prestamo` (`id_prestamo`),
  KEY `id_libro` (`id_libro`),
  CONSTRAINT `detalle_prestamo_ibfk_1` FOREIGN KEY (`id_prestamo`) REFERENCES `prestamo` (`id_prestamo`),
  CONSTRAINT `detalle_prestamo_ibfk_2` FOREIGN KEY (`id_libro`) REFERENCES `libro` (`id_libro`),
  CONSTRAINT `detalle_prestamo_chk_1` CHECK ((`cantidad` > 0))
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_prestamo`
--

LOCK TABLES `detalle_prestamo` WRITE;
/*!40000 ALTER TABLE `detalle_prestamo` DISABLE KEYS */;
INSERT INTO `detalle_prestamo` VALUES (11,1,21,1),(12,2,22,1),(13,3,23,2),(14,4,24,1),(15,5,25,1),(16,6,26,1),(17,7,27,2),(18,8,28,1),(19,9,29,1),(20,10,30,1),(21,11,23,1);
/*!40000 ALTER TABLE `detalle_prestamo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `libro`
--

DROP TABLE IF EXISTS `libro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `libro` (
  `id_libro` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  `isbn` varchar(20) DEFAULT NULL,
  `editorial` varchar(100) DEFAULT NULL,
  `año_publicacion` int DEFAULT NULL,
  `id_categoria` int NOT NULL,
  `stock` int NOT NULL,
  `estado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_libro`),
  UNIQUE KEY `isbn` (`isbn`),
  KEY `id_categoria` (`id_categoria`),
  CONSTRAINT `libro_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`),
  CONSTRAINT `libro_chk_1` CHECK ((`stock` >= 0))
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `libro`
--

LOCK TABLES `libro` WRITE;
/*!40000 ALTER TABLE `libro` DISABLE KEYS */;
INSERT INTO `libro` VALUES (21,'Cien años de soledad','ISBN001','Sudamericana',1967,1,10,1),(22,'El Aleph','ISBN002','Emecé',1949,1,8,1),(23,'La casa de los espíritus','ISBN003','Plaza & Janés',1982,1,11,1),(24,'Rayuela','ISBN004','Sudamericana',1963,1,6,1),(25,'Así habló Zaratustra','ISBN005','Alianza',1883,5,5,1),(26,'Breve historia del tiempo','ISBN006','Bantam',1988,7,7,1),(27,'Sapiens','ISBN007','Debate',2011,4,9,1),(28,'El alquimista','ISBN008','HarperCollins',1988,1,11,1),(29,'El señor de los anillos','ISBN009','Allen & Unwin',1954,3,15,1),(30,'La República','ISBN010','Gredos',1950,5,4,1);
/*!40000 ALTER TABLE `libro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `libro_autor`
--

DROP TABLE IF EXISTS `libro_autor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `libro_autor` (
  `id_libro` int NOT NULL,
  `id_autor` int NOT NULL,
  PRIMARY KEY (`id_libro`,`id_autor`),
  KEY `id_autor` (`id_autor`),
  CONSTRAINT `libro_autor_ibfk_1` FOREIGN KEY (`id_libro`) REFERENCES `libro` (`id_libro`),
  CONSTRAINT `libro_autor_ibfk_2` FOREIGN KEY (`id_autor`) REFERENCES `autor` (`id_autor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `libro_autor`
--

LOCK TABLES `libro_autor` WRITE;
/*!40000 ALTER TABLE `libro_autor` DISABLE KEYS */;
INSERT INTO `libro_autor` VALUES (21,1),(22,2),(23,3),(24,4),(25,5),(26,6),(27,7),(28,8),(29,9),(30,10);
/*!40000 ALTER TABLE `libro_autor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prestamo`
--

DROP TABLE IF EXISTS `prestamo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prestamo` (
  `id_prestamo` int NOT NULL AUTO_INCREMENT,
  `id_cliente` int DEFAULT NULL,
  `fecha_prestamo` date NOT NULL,
  `fecha_devolucion` date DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_prestamo`),
  KEY `fk_prestamo_cliente` (`id_cliente`),
  CONSTRAINT `fk_prestamo_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prestamo`
--

LOCK TABLES `prestamo` WRITE;
/*!40000 ALTER TABLE `prestamo` DISABLE KEYS */;
INSERT INTO `prestamo` VALUES (1,NULL,'2024-01-10','2024-01-20','DEVUELTO'),(2,NULL,'2024-01-12','2026-01-27','DEVUELTO'),(3,NULL,'2024-01-15','2024-01-25','DEVUELTO'),(4,NULL,'2024-02-01',NULL,'ACTIVO'),(5,NULL,'2024-02-03','2024-02-13','DEVUELTO'),(6,NULL,'2024-02-10',NULL,'ACTIVO'),(7,NULL,'2024-02-12','2024-02-22','DEVUELTO'),(8,NULL,'2024-03-01',NULL,'ACTIVO'),(9,NULL,'2024-03-05','2024-03-15','DEVUELTO'),(10,NULL,'2024-03-10',NULL,'ACTIVO'),(11,1,'2026-01-27',NULL,'PRESTADO');
/*!40000 ALTER TABLE `prestamo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `vista_prestamos_activos`
--

DROP TABLE IF EXISTS `vista_prestamos_activos`;
/*!50001 DROP VIEW IF EXISTS `vista_prestamos_activos`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_prestamos_activos` AS SELECT 
 1 AS `id_prestamo`,
 1 AS `libro`,
 1 AS `cliente`,
 1 AS `fecha_prestamo`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `vista_prestamos_activos`
--

/*!50001 DROP VIEW IF EXISTS `vista_prestamos_activos`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_prestamos_activos` AS select `p`.`id_prestamo` AS `id_prestamo`,`l`.`titulo` AS `libro`,concat(`c`.`nombres`,' ',`c`.`apellidos`) AS `cliente`,`p`.`fecha_prestamo` AS `fecha_prestamo` from (((`prestamo` `p` join `cliente` `c` on((`p`.`id_cliente` = `c`.`id_cliente`))) join `detalle_prestamo` `d` on((`p`.`id_prestamo` = `d`.`id_prestamo`))) join `libro` `l` on((`d`.`id_libro` = `l`.`id_libro`))) where (`p`.`estado` = 'PRESTADO') */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-01-27 23:55:53
