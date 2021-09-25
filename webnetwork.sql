-- MariaDB dump 10.19  Distrib 10.6.4-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: webnetwork
-- ------------------------------------------------------
-- Server version	10.6.4-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `postid` int(11) NOT NULL,
  `authorid` int(11) DEFAULT NULL,
  `userid` int(11) NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `datepub` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,7,8,8,'Hello World','2021-09-20 20:04:56'),(2,3,8,7,'Hello World2','2024-09-20 20:04:56'),(3,3,8,8,'test','2021-09-25 17:49:08'),(4,1,8,8,'test2','2021-09-25 17:49:17'),(5,1,8,8,'test','2021-09-25 17:49:57'),(6,1,8,8,'My name is\r\nterminator','2021-09-25 17:51:08'),(7,2,8,8,'JEST','2021-09-25 17:59:59'),(8,8,9,9,'первый комментарий','2021-09-25 18:04:13'),(9,1,8,9,'TEST','2021-09-25 18:06:51');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `friends`
--

DROP TABLE IF EXISTS `friends`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `friends` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `friends`
--

LOCK TABLES `friends` WRITE;
/*!40000 ALTER TABLE `friends` DISABLE KEYS */;
/*!40000 ALTER TABLE `friends` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL DEFAULT '/gallery/default.jpg',
  PRIMARY KEY (`id`,`login`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (7,'admin','$2y$13$jerufufx.gKH0FrJi8X0eucQHEms5HEBX50sBf6DkzPoWkhTMv9vq','Van','Darkholme','/gallery/default.jpg'),(8,'tester','$2y$13$qWWBgW0RpS62LesadUNibe6cDqIVnYm6cL03M1lefr5eldWFpfs/C','qwer','qwer','/gallery/default.jpg'),(9,'alex','$2y$13$T.R.ZSgIesmvJ.q/slpRd.Z00BYqDxuBT9lxkO0lhe671LbD6BYUq','Alex','Flitcher','/gallery/default.jpg');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userdata`
--

DROP TABLE IF EXISTS `userdata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userdata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `aboutself` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `statustext` varchar(512) DEFAULT NULL,
  `married_id` int(11) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `regdate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userdata`
--

LOCK TABLES `userdata` WRITE;
/*!40000 ALTER TABLE `userdata` DISABLE KEYS */;
INSERT INTO `userdata` VALUES (5,7,NULL,NULL,NULL,NULL,NULL,'2021-07-16 06:18:29'),(6,8,'My name is Van, I\'m an artist, I\'m a performance artist. I\'m hired to people to fulfill their fantasies, their deep dark fantasies. I was gonna be a movie star y\'know, modeling and acting. After a hundred and two additions and small parts I decided y\'know I had enough, Then I got in to Escort world. The client requests contain a lot of fetishes, so I just decided to go y\'know... full Master and change my entire house into a dungeon... Dungeon Master now with a full dungeon in my house and It\'s going really well. Fisting is 300 bucks and usually the guy is pretty much hard on pop to get really relaxed y\'know and I have this long latex glove that goes all the way up to my armpit and then I put on a surgical latex glove up to my wrist and just lube it up and it\'s a long process y\'know to get your whole arm up there but it\'s an intense feeling for the other person I think for myself too, you go in places that even though it\'s physical with your hand but for some reason it\'s also more emotional it\'s more psychological too and we both get you know to the same place it\'s really strange at the same time and I find sessions like that really exhausting. I don\'t know I feel kinda naked because I am looking at myself for the first time, well not myself but this aspect of my life for the first time and it\'s been harsh... three to five years already? I never thought about it... Kinda sad I feel kinda sad right now, I don\'t know why',NULL,'Life likes coffee, first your drinking it then it is drinking you',NULL,'1999-02-02','2021-09-19 20:13:37'),(7,9,NULL,NULL,NULL,NULL,NULL,'2021-09-25 18:01:01');
/*!40000 ALTER TABLE `userdata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usernotices`
--

DROP TABLE IF EXISTS `usernotices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usernotices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `datepost` datetime NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usernotices`
--

LOCK TABLES `usernotices` WRITE;
/*!40000 ALTER TABLE `usernotices` DISABLE KEYS */;
INSERT INTO `usernotices` VALUES (1,8,'2021-09-20 20:03:25',NULL),(2,8,'2021-09-20 20:04:29','test2'),(3,8,'2021-09-20 20:04:49','trtr'),(4,8,'2021-09-20 20:15:11','asdgfasdfgasdfasdgfasdfgasdfasdgfasdfgasdfasdgfasdfgasdfasdgfasdfgasdfasdgfasdfgasdfasdgfasdfgasdfasdgfasdfgasdfasdgfasdfgasdfasdgfasdfgasdf'),(5,8,'2021-09-20 20:21:33','text'),(6,8,'2021-09-20 20:24:02','My life is empty'),(7,8,'2021-09-20 20:54:44','asdga\r\nasdhgadfh\r\nadfhadfh'),(8,9,'2021-09-25 18:04:02','Мой первый пост');
/*!40000 ALTER TABLE `usernotices` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-09-25 18:27:11
