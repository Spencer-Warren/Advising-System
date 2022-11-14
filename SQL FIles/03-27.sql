-- MySQL dump 10.13  Distrib 8.0.28, for Linux (x86_64)
--
-- Host: database-1.csg4rlfrt84b.us-east-1.rds.amazonaws.com    Database: nodemysql
-- ------------------------------------------------------
-- Server version	8.0.23

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
SET @MYSQLDUMP_TEMP_LOG_BIN = @@SESSION.SQL_LOG_BIN;
SET @@SESSION.SQL_LOG_BIN= 0;

--
-- GTID state at the beginning of the backup 
--

SET @@GLOBAL.GTID_PURGED=/*!80000 '+'*/ '';

--
-- Table structure for table `advising_meeting`
--

DROP TABLE IF EXISTS `advising_meeting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `advising_meeting` (
  `ID` int NOT NULL,
  `Student_ID` varchar(11) DEFAULT NULL,
  `Advisor_ID` varchar(11) DEFAULT NULL,
  `DateTime` datetime DEFAULT NULL,
  `Location` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `Advisor_ID` (`Advisor_ID`),
  KEY `Student_ID` (`Student_ID`),
  CONSTRAINT `advising_meeting_ibfk_1` FOREIGN KEY (`Advisor_ID`) REFERENCES `advisor` (`Advisor_ID`),
  CONSTRAINT `advising_meeting_ibfk_2` FOREIGN KEY (`Student_ID`) REFERENCES `student` (`Student_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `advising_meeting`
--

LOCK TABLES `advising_meeting` WRITE;
/*!40000 ALTER TABLE `advising_meeting` DISABLE KEYS */;
INSERT INTO `advising_meeting` VALUES (0,'00981583','000','0000-00-00 00:00:00','ONL');
/*!40000 ALTER TABLE `advising_meeting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `advising_table`
--

DROP TABLE IF EXISTS `advising_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `advising_table` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Student_ID` varchar(11) DEFAULT NULL,
  `Advisor_ID` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `Student_ID` (`Student_ID`),
  KEY `Advisor_ID` (`Advisor_ID`),
  CONSTRAINT `advising_table_ibfk_1` FOREIGN KEY (`Student_ID`) REFERENCES `student` (`Student_ID`),
  CONSTRAINT `advising_table_ibfk_2` FOREIGN KEY (`Advisor_ID`) REFERENCES `advisor` (`Advisor_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `advising_table`
--

LOCK TABLES `advising_table` WRITE;
/*!40000 ALTER TABLE `advising_table` DISABLE KEYS */;
INSERT INTO `advising_table` VALUES (15,'00101010','0005'),(16,'00978362','000'),(17,'00978342','001'),(18,'00974722','0005'),(19,'00974722','0005'),(20,'00978360','0005'),(21,'0083481',NULL),(22,'00981583',NULL);
/*!40000 ALTER TABLE `advising_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `advisor`
--

DROP TABLE IF EXISTS `advisor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `advisor` (
  `Advisor_ID` varchar(11) NOT NULL,
  `Password` varchar(64) DEFAULT NULL,
  `First_Name` varchar(16) DEFAULT NULL,
  `Last_Name` varchar(16) DEFAULT NULL,
  `EmailAddress` varchar(32) DEFAULT NULL,
  `Role` varchar(32) DEFAULT 'unverifiedadvisor',
  `IsChair` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`Advisor_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `advisor`
--

LOCK TABLES `advisor` WRITE;
/*!40000 ALTER TABLE `advisor` DISABLE KEYS */;
INSERT INTO `advisor` VALUES ('000','$2y$10$wfGgcWFEORp3HuQO1BVjtuC0Xmzy1SCN12EL9GQdw9UA8c0w791Pe','Chair','Account','Chair.Account@cnu.edu','advisor',1),('0005','$2y$10$uQEHM6OsnQ3vMkw6v.ydm.veYvnC.8w8ANEgxyu.9acAgTYZfuOO2','Test','Unverified','Test.Unverified@cnu.edu','advisor',0),('001','$2y$10$nYcRYNVkSDJd9/i2brj2iOM.Tp4cHvYeWcX.6DA9f6yRj/tempkIW','Professor','Lapke','Advisor.Account@cnu.edu','advisor',0);
/*!40000 ALTER TABLE `advisor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `class`
--

DROP TABLE IF EXISTS `class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `class` (
  `CRN` varchar(4) NOT NULL,
  `Course` varchar(16) DEFAULT NULL,
  `Section` varchar(8) DEFAULT NULL,
  `Days` varchar(8) DEFAULT NULL,
  `Time` varchar(32) DEFAULT NULL,
  `Location` varchar(32) DEFAULT NULL,
  `Instructor` varchar(128) DEFAULT NULL,
  `Open_Seats` varchar(8) DEFAULT NULL,
  `Semester` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`CRN`),
  KEY `Course` (`Course`),
  CONSTRAINT `class_ibfk_1` FOREIGN KEY (`Course`) REFERENCES `course` (`Course`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class`
--

LOCK TABLES `class` WRITE;
/*!40000 ALTER TABLE `class` DISABLE KEYS */;
INSERT INTO `class` VALUES ('8159','CPEN 214','1','TR','1630-1745','LUTR 347','Keshtkar Vanashi, Hessam','29',NULL),('8160','CPEN 214','2','TR','0930-1045','LUTR 347','Keshtkar Vanashi, Hessam','28',NULL),('8161','CPEN 371','1','MW','1300-1350','LUTR 322','Staff, CNU','4',NULL),('8162','CPEN 371','2','MW','1600-1650','LUTR 322','Staff, CNU','15',NULL),('8163','CPEN 371','3','MW','1500-1550','LUTR 322','Staff, CNU','13',NULL),('8164','CPEN 371','4','MW','1400-1450','LUTR 322','Staff, CNU','10',NULL),('8165','CPEN 431','1','MW','1000-1115','LUTR 204','Wang, Dali','4',NULL),('8166','CPEN 498','1','MWF','1300-1350','LUTR 204','Riedl, Anton','5',NULL),('8167','CPSC 140','1','MWF','1100-1150','LUTR 236','Almalag, Mohammad','22',''),('8168','CPSC 110','1M','MWF','1500-1550','LUTR 258','Staff, CNU','11',''),('8169','CPSC 110','2M','MWF','1300-1350','LUTR 258','Staff, CNU','24',''),('8170','CPSC 110','3M','MWF','1400-1450','LUTR 258','Staff, CNU','25',''),('8171','CPSC 110','4M','MW','1800-1915','LUTR 258','Staff, CNU','24',''),('8172','CPSC 110','5M','MW','1930-2045','LUTR 258','Staff, CNU','25',''),('8173','CPSC 110','6M','MW','2100-2215','LUTR 258','Staff, CNU','25',''),('8174','CPSC 150','1M','MWF','0900-0950','LUTR 236','Deshpande, Priya','4',''),('8175','CPSC 150','2M','MWF','0800-0850','LUTR 236','Deshpande, Priya','4',''),('8176','CPSC 150','3M','TR','0930-1045','LUTR 236','Lambert, Lynn','4',''),('8177','CPSC 150','4','TR','1500-1615','LUTR 236','Siasi, Nazli','24',''),('8178','CPSC 150','5M','TR','1630-1745','LUTR 236','Staff, CNU','4',''),('8179','CPSC 150','6M','TR','1800-1915','LUTR 258','Staff, CNU','8',''),('8180','CPSC 150L','1R','W','1500-1645','LUTR 323','Siasi, Nazli','14',''),('8181','CPSC 150L','2M','M','1300-1445','LUTR 323','Siasi, Nazli','8',''),('8182','CPSC 150L','3R','M','1930-2115','LUTR 236','Siasi, Nazli','14',''),('8183','CPSC 150L','4','W','1200-1345','LUTR 323','Staff, CNU','24',''),('8184','CPSC 150L','5R','M','1500-1645','LUTR 323','Staff, CNU','14',''),('8185','CPSC 150L','6M','F','1200-1345','LUTR 323','Staff, CNU','4',''),('8186','CPSC 150L','7R','F','1400-1545','LUTR 323','Staff, CNU','14',''),('8187','CPSC 215','1','MWF','1500-1550','LUTR 109','Staff, CNU','28',''),('8188','CPSC 215','2','MW','1600-1715','MCM 110','Staff, CNU','28',''),('8189','CPSC 215','3','MWF','1400-1450','LUTR 109','Staff, CNU','28',''),('8190','CPSC 215','4','MW','1800-1915','LUTR 109','Staff, CNU','28',''),('8191','CPSC 215','5','MW','1930-2045','LUTR 109','Staff, CNU','28',''),('8192','CPSC 215','6','TR','1800-1915','LUTR 109','Staff, CNU','28',''),('8193','CPSC 215','7','MWF','1000-1050','LUTR 109','Staff, CNU','27',''),('8194','CPSC 215','8','MWF','0900-0950','LUTR 109','Staff, CNU','28',''),('8195','CPSC 216','1','MWF','1100-1150','LUTR 109','Staff, CNU','21',''),('8196','CPSC 250','1','TR','1800-1915','LUTR 236','Conner, David','23',''),('8197','CPSC 250','2','MW','1600-1715','LUTR 236','Henry, Samuel','24',''),('8198','CPSC 250','3','TR','1500-1615','LUTR 258','Phelps, William','23',''),('8199','CPSC 250L','1','T','1930-2115','LUTR 236','Conner, David','23',''),('8200','CPSC 250L','2','W','1930-2115','LUTR 236','Conner, David','23',''),('8201','CPSC 250L','3','W','0900-1045','LUTR 323','Conner, David','24',''),('8202','CPSC 255','1','TR','1330-1445','LUTR 258','McElfresh, Scott','22',''),('8203','CPSC 255','2','MW','1800-1915','LUTR 236','McElfresh, Scott','23',''),('8204','CPSC 255','3','TR','1100-1215','LUTR 236','Siochi, Antonio','21',''),('8205','CPSC 256','1','MWF','1000-1050','LUTR 236','Brash, Edward','24',''),('8206','CPSC 270','1','TR','1330-1445','LUTR 236','Siochi, Antonio','23',''),('8207','CPSC 270','2','TR','0800-0915','LUTR 236','Siochi, Antonio','23',''),('8208','CPSC 280','1','MWF','1100-1150','LUTR 258','Flores, Roberto','30',''),('8209','CPSC 327','1','MWF','1300-1350','FORBES 2014','Perkins, Keith','19',''),('8210','CPSC 327','2','MWF','1500-1550','LUTR 236','Perkins, Keith','19',''),('8213','CPSC 350','1','TR','1630-1745','LUTR 258','Lapke, Michael','23',''),('8214','CPSC 350','2','TR','1100-1215','LUTR 258','Lapke, Michael','21',''),('8222','CPSC 445','1','TR','1500-1615','LUTR 323','Kreider, Christopher','11',''),('8230','CYBR 198','1C','F','1000-1050','LUTR 323','Kreider, Christopher','0',NULL),('8231','CYBR 298','1','F','1000-1050','LUTR 323','Kreider, Christopher','6',NULL),('8232','CYBR 328','1','TR','0930-1045','LUTR 323','Lapke, Michael','17',NULL),('8233','CYBR 428','1','TR','0800-0915','LUTR 323','Kreider, Christopher','14',NULL),('8234','CYBR 498','1','TR','1500-1615','LUTR 323','Kreider, Christopher','4',NULL),('8235','DATA 201','1','TR','1630-1745','LUTR 323','Phelps, William','9',NULL),('8258','PHYS 151','1','TR','1100-1215','LUTR 121','Fisher, Ryan','45',NULL),('8259','PHYS 151','2','TR','1500-1615','FORBES 1022','Gerousis, Costa','72',NULL),('8260','PHYS 151','3','MW','1800-1915','LUTR 121','Gore, David','90',NULL),('8261','PHYS 151L','1','W','1800-2045','LUTR 306','Staff, CNU','16',NULL),('8262','PHYS 151L','2','R','1800-2045','LUTR 306','Staff, CNU','22',NULL),('8263','PHYS 151L','3','F','0800-1045','LUTR 306','Staff, CNU','30',NULL),('8264','PHYS 151L','4','R','1330-1615','LUTR 306','Staff, CNU','25',NULL),('8265','PHYS 151L','5','W','1430-1715','LUTR 306','Staff, CNU','22',NULL),('8266','PHYS 151L','6','W','1100-1345','LUTR 306','Staff, CNU','18',NULL),('8267','PHYS 151L','7','W','0800-1045','LUTR 306','Staff, CNU','27',NULL),('8268','PHYS 151L','8','R','0800-1045','LUTR 306','Staff, CNU','26',NULL),('8348','MATH 125','1M','MWF','0800-0850','LUTR 372','Fogarty, Neville','24',NULL),('8349','MATH 125','2M','MWF','1000-1050','LUTR 372','Tong, Zheng','18',NULL),('8350','MATH 125','3M','MWF','1100-1150','LUTR 347','Kelly, James','22',NULL),('8352','MATH 125','4M','MWF','1200-1250','LUTR 372','Tong, Zheng','17',NULL),('8353','MATH 125','5','MWF','1300-1350','LUTR 372','Fogarty, Neville','37',NULL),('8354','MATH 125','6M','MWF','1400-1450','LUTR 376','Samuels, Charles','24',NULL),('8355','MATH 125','7','MWF','1500-1550','LUTR 269','Dobrescu, Mihaela','44',NULL),('8356','MATH 125','8M','TR','0800-0915','LUTR 372','Kennedy, Christopher','23',NULL),('8357','MATH 125','9M','TR','1100-1215','LUTR 372','Delmage, Erin','18',NULL),('8358','MATH 125','10','TR','1330-1445','LUTR 372','Kennedy, Christopher','44',NULL),('8359','MATH 125','11M','TR','1500-1615','LUTR 372','McMorris, David','24',NULL),('8360','MATH 125','12M','TR','1630-1745','LUTR 372','McMorris, David','25',NULL),('8361','MATH 125','13','TR','1630-1745','LUTR 376','Clark, Mary Eunice Joy','44',NULL),('8376','MATH 140','1M','MWF',' TR','0900-0950',' 0930-1020','LUTR 376',NULL),('8377','MATH 140','2M','MTWRF','1100-1150','LUTR 376','Bradie, Brian','2',NULL),('8378','MATH 140','3M','MWF',' TR','1300-1350',' 1330-1420','LUTR 376',NULL),('8379','MATH 140','4M','MTWRF','1500-1550','LUTR 376','Samuels, Charles','6',NULL),('8381','MATH 235','1','MWF','1400-1450','LUTR 269','Kelly, Jessica','11',NULL),('8382','MATH 235','2','TR','1500-1615','LUTR 352','Martin, James','14',NULL),('8404','ECON 200','1','TR','1630-1745','LUTR 264','Chakraborti, Rik','17',NULL),('8405','ECON 200','2','TR','1800-1915','LUTR 264','Chakraborti, Rik','13',NULL),('8406','ECON 200','3','MW','1600-1715','LUTR 170','Jiang, Yixiao','17',NULL),('8407','ECON 200','4','MW','1800-1915','LUTR 142','Jiang, Yixiao','11',NULL),('8408','ECON 200','5','MWF','1300-1350','LUTR 264','Taghvatalab, Sara','15',NULL),('8409','ECON 200','6','MWF','1400-1450','LUTR 264','Taghvatalab, Sara','24',NULL),('8410','ECON 201','1','MWF','1000-1050','LUTR 121','Kotula, Gemma','95',NULL),('8411','ECON 201','2M','MWF','1100-1150','LUTR 137','Kotula, Gemma','1',NULL),('8412','ECON 201','3M','TR','1330-1445','LUTR 121','He, Zhaochen','54',NULL),('8413','ECON 201','4M','TR','1100-1215','FORBES 1022','Pradhan, Gyanendra','51',NULL),('8414','ECON 201','5C','M','1800-2100','LUTR 137','Harford, Joshua','0',NULL),('8415','ECON 201','6M','T','1800-2100','LUTR 269','Harford, Joshua','7',NULL),('8416','ECON 201','7','W','1800-2100','LUTR 347','Winder, Robert','26',NULL),('8417','ECON 201','8','R','1800-2100','LUTR 347','Hamed, Hazem','19',NULL),('8418','ECON 202','1M','TR','1500-1615','LUTR 121','Taylor, Travis','71',NULL),('8419','ECON 202','2M','M','1800-2100','FORBES 3012','Hamed, Hazem','0',NULL),('8420','ECON 202','3C','R','1800-2100','LUTR 269','Cann-Tamakloe, Ralph','0',NULL),('8421','ECON 202','4','T','1800-2100','LUTR 347','Hamed, Hazem','16',NULL),('8422','ECON 202','5','T','1800-2100','FORBES 2070C','Cann-Tamakloe, Ralph','19',NULL),('8423','ECON 202','6','W','1800-2100','LUTR 170','Hines, Sunita','19',NULL),('8424','ECON 203','1','TR','1100-1215','FORBES 3012','Chakraborti, Rik','14',NULL),('8425','ECON 300','1','MWF','0900-0950','LUTR 269','Taghvatalab, Sara','17',NULL),('8426','ECON 300','2','MWF','1000-1050','LUTR 269','Taghvatalab, Sara','11',NULL),('8427','ECON 304','1','TR','1330-1445','LUTR 264','Winder, Robert','12',NULL),('8428','ECON 304','2','TR','1500-1615','LUTR 264','Winder, Robert','11',NULL),('8532','SOCL 201','1M','TR','0930-1045','FORBES 2070A','Bennett, Devon','0',NULL),('8533','SOCL 201','2M','W','1800-2045','LUTR 167','Staff, CNU','0',NULL),('8584','FNAR 205','1','TR','1400-1620','TFAC 219','Skees, Kristin','0',NULL),('8681','MUSC 112','1','MWF','1600-1750','FERG R106','Lopez, John','173',NULL),('8809','PHIL 202','1C','TR','0800-0915','MCM 207','Davidson, James','0',NULL),('8810','PHIL 202','2R','TR','0930-1045','MCM 207','Davidson, James','0',NULL),('8811','PHIL 202','3C','TR','1330-1445','MCM 200B','Strehle, Stephen','0',NULL),('8886','PSYC 201','1M','Lec','MWF','1300-1350','FORBES 1022','Gibbons,',NULL),('8887','PSYC 201','2M','Lec','MWF','1100-1150','FORBES 1022','Greenlee',NULL),('8888','PSYC 201','3M','Lec','TR','0930-1045','FORBES 1022','Marshall',NULL),('8889','PSYC 202','1M','Lec','MWF','1400-1450','FORBES 1022','Antarami',NULL),('8890','PSYC 202','2M','Lec','TR','1100-1215','MCM 101','Cartwrig',NULL),('8954','ACCT 200','1','MWF','0800-0850','LUTR 264','Staff, CNU','26',NULL),('8957','ACCT 201','1','MWF','0900-0950','LUTR 264','Kugel, Jonathan','22',NULL),('8958','ACCT 201','2','MWF','1000-1050','LUTR 142','Staff, CNU','23',NULL),('8960','ACCT 201','4','MWF','1100-1150','FORBES 2070D','Kugel, Jonathan','37',NULL),('8961','ACCT 201','5','MWF','1200-1250','LUTR 170','Staff, CNU','33',NULL),('8962','ACCT 201','6','MWF','1300-1350','FORBES 2070D','Espahbodi, Reza','39',NULL),('8964','ACCT 201','8','MWF','1400-1450','FORBES 2070A','Espahbodi, Reza','39',NULL),('8965','ACCT 201','9','MW','1600-1715','LUTR 142','Staff, CNU','24',NULL),('8966','ACCT 201','10','TR','1630-1745','FORBES 2070C','Staff, CNU','24',NULL),('8967','ACCT 202','1','TR','1630-1745','LUTR 137','Chung, Keun Ho','14',NULL),('8968','ACCT 202','2','TR','1800-1915','LUTR 137','Chung, Keun Ho','17',NULL),('8969','ACCT 301','1','TR','1330-1445','LUTR 170','Frucot, Veronique','3',NULL),('8970','ACCT 401','1','TR','1800-1915','LUTR 142','Staff, CNU','8',NULL),('8971','ACCT 405','1','MWF','1300-1350','FERG 221','Kugel, Jonathan','6',NULL),('9105','ENGL 123','1C','TR','0930-1045','MCM 310','Apolloni, Jessica','0',NULL),('9106','ENGL 123','2C','MWF','0900-0950','MCM 357','Bunch, Imogene','0',NULL),('9107','ENGL 123','3C','MWF','1000-1050','MCM 357','Bunch, Imogene','0',NULL),('9108','ENGL 123','4','MWF','1100-1150','MCM 307','Davis, Cynthia','15',NULL),('9109','ENGL 123','5C','TR','0930-1045','MCM 362','Eleftheriou, Joanna','0',NULL),('9112','ENGL 123','8C','MWF','0900-0950','MCM 364','Rose, Andrew','0',NULL),('9113','ENGL 123','9C','MWF','1000-1050','MCM 364','Rose, Andrew','0',NULL),('9114','ENGL 123','10C','TR','1800-1915','MCM 207','Stewart, Nathan','0',NULL),('9121','ENGL 223','1','MWF','1300-1350','MCM 310','Bunch, Imogene','15',NULL),('9122','ENGL 223','2','MWF','1400-1450','MCM 310','Bunch, Imogene','19',NULL),('9123','ENGL 223','3','TR','0800-0915','MCM 314','Carney, Jason','18',NULL),('9124','ENGL 223','4','TR','0930-1045','MCM 314','Carney, Jason','17',NULL),('9125','ENGL 223','5','TR','1100-1215','MCM 314','Carney, Jason','8',NULL),('9126','ENGL 223','6','MWF','1200-1250','MCM 307','Davis, Cynthia','16',NULL),('9127','ENGL 223','7','MW','1600-1715','MCM 164','Eng, Julie','17',NULL),('9128','ENGL 223','8','MWF','0900-0950','MCM 216','Hopkins, Patricia','18',NULL),('9129','ENGL 223','9','MWF','1000-1050','MCM 216','Hopkins, Patricia','18',NULL),('9130','ENGL 223','10','MWF','1200-1250','MCM 216','Hopkins, Patricia','19',NULL),('9131','ENGL 223','11','TR','1500-1615','MCM 307','Lebron, Georgepierre','18',NULL),('9132','ENGL 223','12','TR','1630-1745','MCM 307','Lebron, Georgepierre','18',NULL),('9133','ENGL 223','13','TR','1800-1915','MCM 307','Lebron, Georgepierre','18',NULL),('9134','ENGL 223','14','TR','1330-1445','MCM 316','Rowley, Sharon','19',NULL),('9135','ENGL 223','15','TR','1100-1215','MCM 212','Shortsleeve, Kevin','19',NULL),('9136','ENGL 223','16','TR','1930-2045','MCM 207','Stewart, Nathan','19',NULL),('9137','ENGL 223','17','TR','0930-1045','MCM 262','Teekell, Anna','16',NULL),('9138','ENGL 223','18','TR','1100-1215','MCM 262','Teekell, Anna','19',NULL);
/*!40000 ALTER TABLE `class` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `class_record`
--

DROP TABLE IF EXISTS `class_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `class_record` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `CRN` varchar(4) DEFAULT NULL,
  `Student_ID` varchar(11) DEFAULT NULL,
  `Completed` tinyint(1) DEFAULT NULL,
  `Passed` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `Student_ID` (`Student_ID`),
  KEY `CRN` (`CRN`),
  CONSTRAINT `class_record_ibfk_1` FOREIGN KEY (`Student_ID`) REFERENCES `student` (`Student_ID`),
  CONSTRAINT `class_record_ibfk_2` FOREIGN KEY (`CRN`) REFERENCES `class` (`CRN`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class_record`
--

LOCK TABLES `class_record` WRITE;
/*!40000 ALTER TABLE `class_record` DISABLE KEYS */;
INSERT INTO `class_record` VALUES (1,'8174','00981583',1,1),(2,'8182','00981583',1,1),(4,'8376','00981583',1,1),(5,'9114','00981583',1,1),(6,'8681','00981583',1,1),(7,'8358','00981583',1,1),(8,'8261','00981583',1,1);
/*!40000 ALTER TABLE `class_record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course` (
  `Course` varchar(16) NOT NULL,
  `Name` varchar(64) DEFAULT NULL,
  `Description` text,
  `Credit_Hours` tinyint DEFAULT NULL,
  `Prerequisite` varchar(32) DEFAULT NULL,
  `Corequisite` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`Course`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course`
--

LOCK TABLES `course` WRITE;
/*!40000 ALTER TABLE `course` DISABLE KEYS */;
INSERT INTO `course` VALUES ('ACCT 200','Accounting Concepts','This course is designed for non-business majors and those desiring a Minor in Business Administration. It examines accounting concepts from the perspective of financial statement users, rather than statement preparers. Topics include: introduction to accounting, balance sheet, and statement of cash flows analysis, and the use of financial data to make decisions. This course does NOT replace ACCT 201 for BSBA students.',3,'',''),('ACCT 201','Prin of Account I: Financial','This course is designed for non-business majors and those desiring a Minor in Business Administration. It examines accounting concepts from the perspective of financial statement users, rather than statement preparers. Topics include: introduction to accounting, balance sheet, and statement of cash flows analysis, and the use of financial data to make decisions. This course does NOT replace ACCT 201 for BSBA students.',3,'',''),('ACCT 202','Prin of Account II: Managerial','Introduces cost and managerial accounting, focusing on product costing and the use of accounting information within the organization to provide direction and to judge performance.',3,'ACCT 201','CPSC 215'),('ACCT 301','Intermediate Accounting I','The study and application of generally accepted accounting principles for accumulating and reporting financial information about businesses. Emphasis is placed upon revenue recognition, accounting for cash, receivables, inventories, property, plant and equipment, and intangible assets.',3,'ACCT 201+ACCT 202+CPSC 215',''),('ACCT 401','Taxation','An introduction to the concepts and principles of income taxation as they apply to individuals and businesses.',3,'ACCT 201+ACCT 202',''),('ACCT 405','Auditing','Conceptual approach to auditing principles and procedures in the preparation of auditing reports. Professional standards and ethics are emphasized.',3,'ENGL 223+ACCT 302 ',''),('CPEN 214','Digital Logic Design','Introduction to logic circuits; combinatorial logic circuits; memory elements; sequential logic circuits; register transfer logic. Hands-on experience with devices emphasized.',3,'ENGR 121',''),('CPEN 371','WI: Computer Ethics','This course covers contemporary ethical issues in science and engineering. A framework for professional activity is developed, which involves considerations and decisions of social impact. Current examples will be studied, discussed, and reported: IEEE and ACM codes of ethics, software and hardware property law, privacy, social implications of computers, responsibility and liabilities, and computer crime. Partially satisfies the writing intensive requirement.',2,'ENGL 223',''),('CPEN 431','Computer Engineering Design','Engineering design course focuses on applications of computer engineering. Engineering skills developed through supervised design projects. Design projects incorporate techniques and concepts developed in previous courses. Topics include field programmable gate arrays (FPGA) implementation, micro-programmable controllers, and device interfacing. Development systems and Electronic Design Automation software are used throughout the course.',3,'CPEN 315+CPEN 315L','CPSC 270'),('CPEN 498','WI:Comput Engnrng Capstone','Capstone design project where senior student completes a practical computer engineering project, including probabilistic aspects of the design, by applying the engineering knowledge and judgment they have acquired during their college career. A formal oral presentation and a written report are required as well as the artifact that is the design. Partially satisfies the Writing Intensive requirement. May be taken as research intensive. This course is repeatable twice for a total of three (3) credits.',1,'ENGL 223','CPEN 371'),('CPSC 110','Introduction to Computing','Designed for persons majoring in other than the computer sciences. Introduction to computers, their capabilities, limitations, and implications. Applications such as spreadsheets, presentation, multimedia, and webpage development. Computer terminology, hardware and software organization.',3,'',''),('CPSC 140','Intro-Comp Prog w/ Multimedia','This course is a gentle introduction to computer programming via multimedia using a simple yet powerful language. Topics include programming language concepts, data types and operations, expressions, symbolic logic, conditionals, loops, functions, and basic data structures. Assignments will be multimedia-oriented, such as a simple Photoshop-like app, an animation generator, and a simplified iTunes-like app.',3,'',''),('CPSC 150','Introduction to Programming','This course is an introduction to problem solving and programming. Topics include using primitive and object types, defining Boolean and arithmetic expressions, using selection and iterative statements, defining and using methods, defining classes, creating objects and manipulating arrays. Emphasis is placed on designing, coding and testing programs using the above topics. Satisfies the logical reasoning foundation requirement.',3,'',''),('CPSC 150L','Intro to Programming Lab','Laboratory course supports the concepts in CPSC 150 lecture with hands-on programming activities and language specific implementation. Laboratory exercises stress sound design principles, programming style, documentation, and debugging techniques. Lab fees apply each term.',1,'','CPSC 150'),('CPSC 215','Software Pkgs-Busn Applcations','For students majoring in business or information science and those wanting a more in-depth understanding of and competence in the use of spreadsheets, databases, and database management. Covers creation of complex spreadsheets using Microsoft Excel, and database queries and management using Microsoft Access.',3,'BUSN 231','MATH 135'),('CPSC 216','Multimedia and Web Publishing','Basic multimedia concepts - graphics, audio, video; internet concepts; design, development, and publishing of web pages; interactive web pages; publishing tools, server management and tools. This course includes a hands-on component.',3,'','CPSC 150'),('CPSC 250','Progrmng for Data Manipulation','This course builds upon concepts taught in CPSC 150, and provides continuing study of data storage and manipulation, and introduces their application to scientific computing and visualization. Specific topics include object oriented design, programming style, debugging, and algorithm design. The course will incorporate the use of existing libraries for data processing and visualization.',3,'CPSC 150+CPSC 150L','CPSC 250L'),('CPSC 250L','Prog for Data Manipulation Lab','Laboratory course supports the concepts in CPSC 250 lecture with hands-on programming activities and language specific implementation. Laboratory exercises stress sound design principles, programming style, documentation, and debugging techniques. Lab fees apply each term.',1,'CPSC 150+CPSC 150L','CPSC 250'),('CPSC 255','Programming for Applications','This course provides a study of programming and problem solving using a scalable structured programming language. This course assumes competency with programing and problem solving using variables, conditional statements, loops, classes (objects) and arrays. This course begins with a brief introduction to these prior programming concepts, before moving on to more advanced concepts such as class inheritance and interfaces, generics, and beginning data structures such as linked lists, stacks, and queues. The course includes more advanced programming techniques such as exceptions, recursion, networking, and data structures.',3,'CPSC 250',''),('CPSC 256','C/C++ Prgm for Engr &amp; Scientis','Problem-solving techniques for problems primarily from fields of engineering and sciences; procedural and object-oriented program development, editing, compiling, linking, and debugging using the C/C++ programming language. Applications in hardware-oriented programming, embedded environment, and computer simulation.',3,'CPSC 250',''),('CPSC 270','Data and File Structures','Study of objects and data structures. Trees, graphs, heaps with performance analysis or related algorithms. Structure, search, sort/merge and retrieval of external files. Programming assignments will involve application of the topics covered.',3,'CPSC 255','ENGR 213'),('CPSC 280','Intro to Software Engineering','This course introduces the theory and practice of building reliable software systems. It covers the life-cycle of software development and its existing models, methods for modeling, designing, testing and debugging software, and techniques to choose appropriate models to build systems involving individuals or teams of developers.',3,'CPSC 255',''),('CPSC 327','C++ Programming','Designed for students who already know how to program, but do not know C++. This is a comprehensive introduction to C++ . The course will emphasize basic C++, in particular memory management, inheritance, and features needed for low level programming.',3,'CPSC 255+CPEN 214',''),('CPSC 350','Information Systems Analysis','Introduction to Information Systems profession. Tools and techniques for profiling organizations and analyzing their goals and needs to determine and specify information systems requirements. Practical experience in real-life information systems analysis.',3,'CPSC 250+CPSC 250L',''),('CPSC 351','Info Sys Design/Implementation','Lecture/project-based course for systematic design, implementation, and maintenance of computer information systems. From given requirements for a computer information system course guides student in methods, tools, and techniques for realizing the desired system.',3,'CPSC 250+CPSC 250L+CPSC 350',''),('CPSC 445','WI: Information Systems Lab','A major project that includes a study of the factors necessary for successful implementation and operation of information systems; the traditional life cycle approach to managing and controlling application development and alternative development approaches. Written and oral presentation of project. Partially satisfies the Writing Intensive requirement. May be taken as research intensive.',3,'ENGL 223+CPSC 350','CPSC 440'),('CYBR 198','First Yr Cybersecurity Seminar','This course will provide an overview of key concepts in cybersecurity and a guided exploration that requires connecting them to other disciplines, current events, and cybersecurity tools. First year students and students interested in exploring cybersecurity for the first time will work closely with faculty and more experienced students to prepare for each of the topics. Additionally, participation in a community-based cybersecurity activity or event will be required.',1,'',''),('CYBR 298','Second Yr Cybersecurity Seminr','This course will provide a continued overview of key concepts in cybersecurity and open exploration that requires connecting them to other disciplines, current events, and cybersecurity tools. Students with prior cybersecurity experience, or experience in CYBR 198 will work to guide less experienced students in their exploration of the topics. Additionally, participation in planning a community-based cybersecurity activity or event will be required.',1,'CYBR 198',''),('CYBR 328','Fndtns & Princ of Cybersecurty','Study of the foundational concepts and basic principles necessary for understanding and study of cybersecurity. Wide breadth of topics is explored to prepare students for future courses in the cybersecurity major.',3,'CPSC 250+CPSC 250L',''),('CYBR 428','Network Security & Cryptogrphy','Study of encryption algorithms and network security practices. Security issues, threats and attacks. Symmetric ciphers (\"secret-key encryption\"\"): classical and contemporary algorithms',0,' practical implementations',' key-management'),('CYBR 498','WI: Cyber Security Capstone','A major project that includes the study and exploration of an area of cybersecurity. Projects are expected to research and/or implement a cybersecurity related solution. Written and oral presentations are required. Partially satisfies the writing intensive requirement.',3,'CYBR 448',''),('DATA 201','Introduction to Data Science','This course provides an introduction to data science. Topics include data collection, processing, analysis and visualization. Additional topics include clustering algorithms and regression. Students will learn how to critically evaluate and produce their own quantitative results. This is a projects based course.',3,'CPSC 250+CPSC 250L+MATH 125','MATH 235'),('ECON 200','The Economic Way of Thinking','The economic way of thinking can help students better understand problems facing the world. Identifying benefits and costs of choices, both intended and unintended, is the essence of economic thinking. In this course, students will apply the economic way of thinking to a broad set of economic and public policy issues covering topics such as consumer safety and health, the environment, international trade, and labor markets.\n\nStudents may not receive credit for this course after receiving a grade of D- or higher in any economics course numbered ECON 201 or higher.',3,'',''),('ECON 201','Principles of Macroeconomics','An introduction to the analytical tools commonly employed by economists in determining the aggregate level of economic activity and the composition of output, prices, and the distribution of income. Problems related to these subjects are considered, and alternative courses of public policy are evaluated.',3,'',''),('ECON 202','Principles of Microeconomics','Microeconomics is the study of the analytical tools used by economists in the \'theory of the firm\'. Topics include the price mechanism, pricing policy, production theory, cost theory, profit maximization, and the various types of market structures. Problems related to these areas and policies for solutions are discussed.',3,'',''),('ECON 203','Environmental Economic Literac','This course provides students with an introduction to environmental issues through an economic lens. The rational, economic analytical approach is introduced and the basic principles of economics are applied to problems such as energy markets, air and water pollution, sustainability, population and environment, waste and recycling, and dealing with climate change.',3,'',''),('ECON 300','Quantitative Methods in ECON','Introduces students to a variety of quantitative skills commonly used in economic analysis. The primary aim is to prepare students for upper-level courses in the economics major. Topics include high order derivatives, exponential and logarithmic functions, probability differentiation, total differentiation, unconstrained and constrained optimization, matrices, probability distributions and the derivation of OLS estimators. Specific applications include maximizing utility and profit functions, minimizing cost functions, returns to scale, Cobb-Douglas functions, indifference and isoquant curves and marginal rates of substitution and transformation, Kuhn-Tucker conditions, Pearson\'s correlations, F-tests, and Z-tests.',3,'ECON 202+MATH 125+MATH 135','ECON 201'),('ECON 304','Interm Macroeconomic Analysis','Students may not receive credit for this course after receiving a grade of D- or higher in any economics course numbered ECON 301 or higher.',3,'ECON 201+ECON 202',''),('ENGL 123','First-Year Writing Seminar','This course introduces students to the conventions of reading and writing appropriate for liberal arts learning, in particular the ability to analyze and produce sophisticated arguments and other genres of writing such as reports, evaluations, textual analyses, proposals, profiles, and other academic genres in relationship to issues in the arts, humanities, social sciences, professional studies, business, economics, and sciences and technology. Beginning with an examination of the principles of critical thinking and how texts and forms are the result of specific situations and conventions, students will evaluate prose texts, conduct research, and craft polished writings of their own using multiple sources of evidence.',3,'',''),('ENGL 223','Second-Year Writing Seminar','Film Adaptation & Literature\nIs the (L)literature we stream still literature? Our course will study the adaptations of three major works of literature with an eye towards inquiring into and critically interrogating the forces surrounding the way these adaptations “have lives” apart from their sources. Texts include Beloved, The Handmaid\'s Tale, and Brave New World.',3,'ENGL 123 ',''),('FNAR 205','Digital Photography','This course provides students with a strong foundation in the latest digital workflow methods, from advanced digital capture and image editing to master digital printing. Concepts covered in the course include color management, working with RAW files, managing and archiving image files. A digital SLR camera with at least 5-megapixel resolution, histogram display and manual capability is required for this course (ability to capture in \"camera RAW\"\" preferred). A limited number of digital SLR cameras are available for student use on a rotating basis for students without cameras.\"',3,'',''),('MATH 125','Elementary Statistics','This course is a general survey of descriptive and inferential statistics. Topics include descriptive analysis of univariate and bivariate data, probability, standard distributions, sampling, estimation, hypothesis testing and linear regression. Students may not receive credit for this course after receiving a grade of C– or higher in MATH 435.',3,'',''),('MATH 140','Calculus and Analytic Geometry','An introduction to the calculus of elementary functions, continuity, derivatives, methods of differentiation, the Mean Value Theorem, curve sketching, applications of the derivative, the definite integral, the Fundamental Theorems of Calculus, indefinite integrals, and log and exponential functions. The software package Mathematica will be used.\n\nPrerequisite: MATH 130 with a grade of C- or higher, or an acceptable score on the Calculus Readiness Assessment. More information on the Calculus Readiness Exam can be found here: https://my.cnu.edu/math/placement/',4,'MATH 130',''),('MATH 235','Applied Matrix Techniques','Topics in applied linear algebra such as systems of linear equations, Gaussian elimination, matrix algebra, determinants, Cramer\'s rule, eigenvalues and vectors. Also applications in some of these areas: linear programming, game theory, Markov chains, input/output models, graph theory, and genetics. A computer project may be required.',3,'MATH 140',''),('MUSC 112','Marching Band','The Marching Captains is an auditioned ensemble that performs at all home football games and other campus and community events. Rehearsals focus on the individual preparation of assigned music and drill repertoires, group cohesiveness, and interpretations. Students may register each Fall semester, but no more than eight credits can be counted toward graduation.',1,'',''),('PHIL 202','Modern Philosophy','A study of the philosophical thought of the European, Middle Eastern, and Far Eastern cultures from 1500 A.D. to the late eighteenth century. Readings from original sources will include topics such as Descartes’ theory of mind and body, Hobbes’ social contract theory, Berkeley’s denial of the material world, Hume’s attack on miracles, Kant’s theory of the phenomenal and noumenal worlds, Neo-Confucian conceptions of the Tao, and Zen Buddhism’s view of knowledge and enlightenment.',3,'',''),('PHYS 151','College Physics I','A presentation of the major concepts of physics, using algebra and trigonometry. For science students (but not for engineering, physics, or mathematics students). Topics covered include mechanics, thermodynamics, waves, electromagnetism, optics, and modern physics.',3,'','PHYS 151'),('PHYS 151L','College Physics I Laboratory','Physics laboratory activities to accompany the lecture part of the course. The laboratories introduce fundamental physical principles, rudimentary data analysis, and computer-aided control and data acquisition. Lab fees apply each term.',1,'',''),('PSYC 201','Inv Biol Bases of Beh &amp; Cogn','This course covers basic principles of scientific psychology, including coverage of history and systems of psychology (the historical development and progression of scientific theories in psychology), the scientific method, and research methods. Additionally, this course includes coverage of biological bases of behavior (brain and nervous system structure, function, and effects on individual behavior and mental processes), sensation and perception (anatomy and function of sensory systems such as the visual system), learning and memory, intelligence, cognition, motivation, and emotion. Each of these topics will be discussed with respect to the application of the scientific method to the study of each topic and research findings relevant to contemporary understanding of human behavior and mental processes.',3,'',''),('PSYC 202','Inv Socl Contxt of Beh &amp; Cogn','This course provides an overview of the social science side of psychology, concentrating on the history and systems of psychology, research methods, human growth and behavior, emotions, stress & health, personality, psychological disorders, therapy, social psychology, and industrial/organizational psychology. These topics are discussed in the contexts of social, cultural and psychological influences on human behavior and mental processes. Such influences may include (but are not limited to) heredity, neurological influences, and institutions such as the family, workforce, society, and culture. You will develop a foundation for understanding psychology and will be introduced to a variety of disciplines within psychology.',3,'',''),('SOCL 201','Global Social Problems','This course addresses global social problems in the U.S. and the broader world. We will devote considerable attention to inequalities and tensions created by predominant forms of globalization, to critiques by non-Western thinkers, and to experiences of people living within and between Global Northern and Global Southern nations. Throughout, we examine: historical contexts and contemporary debates; processes of international development and associated inequality; the ways such problems are felt on the basis of power, privilege, and marginality; as well as barriers to positive social change and our moral obligations in responding to global social problems as reflexible global citizens.',3,'','');
/*!40000 ALTER TABLE `course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `note`
--

DROP TABLE IF EXISTS `note`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `note` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Student_ID` varchar(11) DEFAULT NULL,
  `Advisor_ID` varchar(11) DEFAULT NULL,
  `TimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Note` text,
  PRIMARY KEY (`ID`),
  KEY `Advisor_ID` (`Advisor_ID`),
  KEY `Student_ID` (`Student_ID`),
  CONSTRAINT `note_ibfk_1` FOREIGN KEY (`Advisor_ID`) REFERENCES `advisor` (`Advisor_ID`),
  CONSTRAINT `note_ibfk_2` FOREIGN KEY (`Student_ID`) REFERENCES `student` (`Student_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `note`
--

LOCK TABLES `note` WRITE;
/*!40000 ALTER TABLE `note` DISABLE KEYS */;
INSERT INTO `note` VALUES (1,'00978362','001','2022-02-09 19:59:12','This is an example'),(2,'00978362','001','2022-02-11 02:15:52','This is a second test. Please work. '),(3,'00978362','001','2022-02-10 06:17:52','Now does adding notes work? Yes it does. Yay.'),(22,'00978361','001','2022-02-11 02:16:30','Hi Dr. Lapke. How are you?'),(23,'00978360','001','2022-02-11 02:17:26','Hello there. This is a note for another student named Test Student. You can edit them too.'),(24,'00978361','001','2022-02-11 19:26:29','Test after code cleanup.'),(25,'00978362','000','2022-02-11 19:44:01','Test after code cleanup.'),(26,'00978362','000','2022-02-11 19:43:09','Second Test after code cleanup'),(27,'00978362','000','2022-02-11 19:48:58','Chair test notes after code cleanup.');
/*!40000 ALTER TABLE `note` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `semester_plan`
--

DROP TABLE IF EXISTS `semester_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `semester_plan` (
  `Plan_ID` int NOT NULL,
  `Student_ID` varchar(11) DEFAULT NULL,
  `TimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Semester` varchar(32) DEFAULT NULL,
  `Year` year DEFAULT NULL,
  PRIMARY KEY (`Plan_ID`),
  KEY `Student_ID` (`Student_ID`),
  CONSTRAINT `semester_plan_ibfk_1` FOREIGN KEY (`Student_ID`) REFERENCES `student` (`Student_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `semester_plan`
--

LOCK TABLES `semester_plan` WRITE;
/*!40000 ALTER TABLE `semester_plan` DISABLE KEYS */;
/*!40000 ALTER TABLE `semester_plan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `student` (
  `Student_ID` varchar(11) NOT NULL,
  `Password` varchar(64) DEFAULT NULL,
  `First_Name` varchar(16) DEFAULT NULL,
  `Last_Name` varchar(16) DEFAULT NULL,
  `EmailAddress` varchar(32) DEFAULT NULL,
  `Major` varchar(16) DEFAULT NULL,
  `Year` varchar(16) DEFAULT NULL,
  `Role` varchar(16) DEFAULT 'student',
  `Suggestions` varchar(2048) DEFAULT NULL,
  PRIMARY KEY (`Student_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES ('00101010','$2y$10$tprszsmPOfjA5rosTVmmDe40bqFI7BbrEbtiAZa1DuAWyKYWerDYq','Savannah','Fredrick','savy.fredrick@aol.com',NULL,'2012','student',NULL),('0083481','$2y$10$NtcSLoeEO66/LjPyAukUG.Tc3npc0aiS5.3AIdLjNzlkAM1OqRMMS','student','spencer','spcstudent@gmail.com',NULL,NULL,'student',NULL),('00974722','$2y$10$J5vVlipu4Y2cbgvJmNGcX./y6bt.zCoT51KdWajpTL3C6Dn87jnwu','Savannah','Fredrick','savannah.fredrick.19@cnu.edu',NULL,NULL,'student',NULL),('00978342','$2y$10$v.fLzWX6Nff.hnZ81tB8B.7NHTLEIfi2BKEHh3ytOkIAFaV/zhVPO','No','Advisor','No.Advisor@cnu.edu',NULL,NULL,'student',NULL),('00978350','$2y$10$n3NYvW2cnBhKkj3RmUU.Xe7CUfH8p4/.mLjIJwsj4oGO2HIIgxChK','Another','Student','Another.Student@cnu.edu',NULL,NULL,'student',NULL),('00978360','$2y$10$hRfGvKD5c.j/fljVI0hO4uSxFLsFAwNYnYgoCHPYc7e6mNqfO7lxC','Test','Student','Test.Student.19@cnu.edu',NULL,NULL,'student',NULL),('00978361','$2y$10$GMD/ZU5gPZSCl3g3ucOX1e3iX1MOSYigLsqvfcY4QRO85VBFxqEyu','Another','Student','Another.Student@cnu.edu',NULL,NULL,'student',NULL),('00978362','$2y$10$e/bArRyJyd3Mq5e4UnH.MOCpwYEhAvH2ibPgMwhKqc7YbEJ5RNIPO','Christian','Wagner','christian.wagner.19@cnu.edu',NULL,NULL,'student','\r\n2022-03-24 23:59:25ZUwU\r\n2022-03-24 23:59:43 Better this time'),('00981583','$2y$10$mSrCs66Rwdr04yoCVhteh.jEFDih2s4LWKjHvY8kY8Huf7t.ymcJ6','Spencer','Warren','00981583',NULL,NULL,'student',NULL);
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;
SET @@SESSION.SQL_LOG_BIN = @MYSQLDUMP_TEMP_LOG_BIN;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-03-27 16:22:18
