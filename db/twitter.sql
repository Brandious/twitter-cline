
DROP TABLE IF EXISTS `isFollowing`;

CREATE TABLE `isFollowing` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `follower` int(11) DEFAULT NULL,
  `isFollowing` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

LOCK TABLES `isFollowing` WRITE;

INSERT INTO `isFollowing` VALUES (33,59,58),(37,58,58),(38,58,59),(41,62,59);

UNLOCK TABLES;


DROP TABLE IF EXISTS `tweets`;

CREATE TABLE `tweets` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `tweet` tinytext,
  `userid` int(11) NOT NULL,
  `datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table `tweets`
--



--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `email` tinytext,
  `password` tinytext,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--
