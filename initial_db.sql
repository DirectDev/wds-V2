/*
SQLyog Community Edition- MySQL GUI v6.52
MySQL - 5.6.16 : Database - project-salsa
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `address` */

DROP TABLE IF EXISTS `address`;

CREATE TABLE `address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `street_complement` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `postcode` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C2F3561DF92F3E70` (`country_id`),
  CONSTRAINT `FK_C2F3561DF92F3E70` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `address` */

/*Table structure for table `city` */

DROP TABLE IF EXISTS `city`;

CREATE TABLE `city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `searchcity` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `city` */

insert  into `city`(`id`,`searchcity`,`latitude`,`longitude`) values (1,'nice',43.7101728,7.2619532),(2,'paris',48.856614,2.3522219),(3,'lille',50.62925,3.057256),(4,'marseille',43.296482,5.36978),(5,'lyon',45.764043,4.835659),(6,'singapore',1.352083,103.819836);

/*Table structure for table `country` */

DROP TABLE IF EXISTS `country`;

CREATE TABLE `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `iso2` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=242 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `country` */

insert  into `country`(`id`,`name`,`iso2`) values (1,'Afghanistan','af'),(2,'Albania','al'),(3,'Algeria','dz'),(4,'American Samoa','as'),(5,'Andorra','ad'),(6,'Angola','ao'),(7,'Anguilla','ai'),(8,'Antarctica','aq'),(9,'Antigua And Barbuda','ag'),(10,'Argentina','ar'),(11,'Armenia','am'),(12,'Aruba','aw'),(13,'Australia','au'),(14,'Austria','at'),(15,'Azerbaijan','az'),(16,'Bahamas','bs'),(17,'Bahrain','bh'),(18,'Bangladesh','bd'),(19,'Barbados','bb'),(20,'Belarus','by'),(21,'Belgium','be'),(22,'Belize','bz'),(23,'Benin','bj'),(24,'Bermuda','bm'),(25,'Bhutan','bt'),(26,'Bolivia','bo'),(27,'Bosnia And Herzegovina','ba'),(28,'Botswana','bw'),(29,'Bouvet Island','bv'),(30,'Brazil','br'),(31,'British Indian Ocean Territory','io'),(32,'Brunei Darussalam','bn'),(33,'Bulgaria','bg'),(34,'Burkina Faso','bf'),(35,'Burundi','bi'),(36,'Cambodia','kh'),(37,'Cameroon','cm'),(38,'Canada','ca'),(39,'Cape Verde','cv'),(40,'Cayman Islands','ky'),(41,'Central African Republic','cf'),(42,'Chad','td'),(43,'Chile','cl'),(44,'China','cn'),(45,'Christmas Island','cx'),(46,'Cocos (keeling) Islands','cc'),(47,'Colombia','co'),(48,'Comoros','km'),(49,'Congo','cg'),(50,'Congo, The Democratic Republic Of The','cd'),(51,'Cook Islands','ck'),(52,'Costa Rica','cr'),(53,'Cote D\'ivoire','ci'),(54,'Croatia','hr'),(55,'Cuba','cu'),(56,'Cyprus','cy'),(57,'Czech Republic','cz'),(58,'Denmark','dk'),(59,'Djibouti','dj'),(60,'Dominica','dm'),(61,'Dominican Republic','do'),(62,'East Timor','tp'),(63,'Ecuador','ec'),(64,'Egypt','eg'),(65,'El Salvador','sv'),(66,'Equatorial Guinea','gq'),(67,'Eritrea','er'),(68,'Estonia','ee'),(69,'Ethiopia','et'),(70,'Falkland Islands (malvinas)','fk'),(71,'Faroe Islands','fo'),(72,'Fiji','fj'),(73,'Finland','fi'),(74,'France','fr'),(75,'French Guiana','gf'),(76,'French Polynesia','pf'),(77,'French Southern Territories','tf'),(78,'Gabon','ga'),(79,'Gambia','gm'),(80,'Georgia','ge'),(81,'Germany','de'),(82,'Ghana','gh'),(83,'Gibraltar','gi'),(84,'Greece','gr'),(85,'Greenland','gl'),(86,'Grenada','gd'),(87,'Guadeloupe','gp'),(88,'Guam','gu'),(89,'Guatemala','gt'),(90,'Guinea','gn'),(91,'Guinea-bissau','gw'),(92,'Guyana','gy'),(93,'Haiti','ht'),(94,'Heard Island And Mcdonald Islands','hm'),(95,'Holy See (vatican City State)','va'),(96,'Honduras','hn'),(97,'Hong Kong','hk'),(98,'Hungary','hu'),(99,'Iceland','is'),(100,'India','in'),(101,'Indonesia','id'),(102,'Iran, Islamic Republic Of','ir'),(103,'Iraq','iq'),(104,'Ireland','ie'),(105,'Israel','il'),(106,'Italy','it'),(107,'Jamaica','jm'),(108,'Japan','jp'),(109,'Jordan','jo'),(110,'Kazakstan','kz'),(111,'Kenya','ke'),(112,'Kiribati','ki'),(113,'Korea, Democratic People\'s Republic Of','kp'),(114,'Korea, Republic Of','kr'),(115,'Kosovo','kv'),(116,'Kuwait','kw'),(117,'Kyrgyzstan','kg'),(118,'Lao People\'s Democratic Republic','la'),(119,'Latvia','lv'),(120,'Lebanon','lb'),(121,'Lesotho','ls'),(122,'Liberia','lr'),(123,'Libyan Arab Jamahiriya','ly'),(124,'Liechtenstein','li'),(125,'Lithuania','lt'),(126,'Luxembourg','lu'),(127,'Macau','mo'),(128,'Macedonia, The Former Yugoslav Republic Of','mk'),(129,'Madagascar','mg'),(130,'Malawi','mw'),(131,'Malaysia','my'),(132,'Maldives','mv'),(133,'Mali','ml'),(134,'Malta','mt'),(135,'Marshall Islands','mh'),(136,'Martinique','mq'),(137,'Mauritania','mr'),(138,'Mauritius','mu'),(139,'Mayotte','yt'),(140,'Mexico','mx'),(141,'Micronesia, Federated States Of','fm'),(142,'Moldova, Republic Of','md'),(143,'Monaco','mc'),(144,'Mongolia','mn'),(145,'Montserrat','ms'),(146,'Montenegro','me'),(147,'Morocco','ma'),(148,'Mozambique','mz'),(149,'Myanmar','mm'),(150,'Namibia','na'),(151,'Nauru','nr'),(152,'Nepal','np'),(153,'Netherlands','nl'),(154,'Netherlands Antilles','an'),(155,'New Caledonia','nc'),(156,'New Zealand','nz'),(157,'Nicaragua','ni'),(158,'Niger','ne'),(159,'Nigeria','ng'),(160,'Niue','nu'),(161,'Norfolk Island','nf'),(162,'Northern Mariana Islands','mp'),(163,'Norway','no'),(164,'Oman','om'),(165,'Pakistan','pk'),(166,'Palau','pw'),(167,'Palestinian Territory, Occupied','ps'),(168,'Panama','pa'),(169,'Papua New Guinea','pg'),(170,'Paraguay','py'),(171,'Peru','pe'),(172,'Philippines','ph'),(173,'Pitcairn','pn'),(174,'Poland','pl'),(175,'Portugal','pt'),(176,'Puerto Rico','pr'),(177,'Qatar','qa'),(178,'Reunion','re'),(179,'Romania','ro'),(180,'Russian Federation','ru'),(181,'Rwanda','rw'),(182,'Saint Helena','sh'),(183,'Saint Kitts And Nevis','kn'),(184,'Saint Lucia','lc'),(185,'Saint Pierre And Miquelon','pm'),(186,'Saint Vincent And The Grenadines','vc'),(187,'Samoa','ws'),(188,'San Marino','sm'),(189,'Sao Tome And Principe','st'),(190,'Saudi Arabia','sa'),(191,'Senegal','sn'),(192,'Serbia','rs'),(193,'Seychelles','sc'),(194,'Sierra Leone','sl'),(195,'Singapore','sg'),(196,'Slovakia','sk'),(197,'Slovenia','si'),(198,'Solomon Islands','sb'),(199,'Somalia','so'),(200,'South Africa','za'),(201,'South Georgia And The South Sandwich Islands','gs'),(202,'Spain','es'),(203,'Sri Lanka','lk'),(204,'Sudan','sd'),(205,'Suriname','sr'),(206,'Svalbard And Jan Mayen','sj'),(207,'Swaziland','sz'),(208,'Sweden','se'),(209,'Switzerland','ch'),(210,'Syrian Arab Republic','sy'),(211,'Taiwan, Province Of China','tw'),(212,'Tajikistan','tj'),(213,'Tanzania, United Republic Of','tz'),(214,'Thailand','th'),(215,'Togo','tg'),(216,'Tokelau','tk'),(217,'Tonga','to'),(218,'Trinidad And Tobago','tt'),(219,'Tunisia','tn'),(220,'Turkey','tr'),(221,'Turkmenistan','tm'),(222,'Turks And Caicos Islands','tc'),(223,'Tuvalu','tv'),(224,'Uganda','ug'),(225,'Ukraine','ua'),(226,'United Arab Emirates','ae'),(227,'United Kingdom','gb'),(228,'United States','us'),(229,'United States Minor Outlying Islands','um'),(230,'Uruguay','uy'),(231,'Uzbekistan','uz'),(232,'Vanuatu','vu'),(233,'Venezuela','ve'),(234,'Viet Nam','vn'),(235,'Virgin Islands, British','vg'),(236,'Virgin Islands, U.s.','vi'),(237,'Wallis And Futuna','wf'),(238,'Western Sahara','eh'),(239,'Yemen','ye'),(240,'Zambia','zm'),(241,'Zimbabwe','zw');

/*Table structure for table `countrytranslation` */

DROP TABLE IF EXISTS `countrytranslation`;

CREATE TABLE `countrytranslation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_41FF00AD2C2AC5D34180C698` (`translatable_id`,`locale`),
  KEY `IDX_41FF00AD2C2AC5D3` (`translatable_id`),
  CONSTRAINT `FK_41FF00AD2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `country` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=483 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `countrytranslation` */

insert  into `countrytranslation`(`id`,`translatable_id`,`title`,`locale`) values (1,1,'Afghanistan','fr'),(2,1,'Afghanistan','en'),(3,2,'Albania','fr'),(4,2,'Albania','en'),(5,3,'Algeria','fr'),(6,3,'Algeria','en'),(7,4,'American Samoa','fr'),(8,4,'American Samoa','en'),(9,5,'Andorra','fr'),(10,5,'Andorra','en'),(11,6,'Angola','fr'),(12,6,'Angola','en'),(13,7,'Anguilla','fr'),(14,7,'Anguilla','en'),(15,8,'Antarctica','fr'),(16,8,'Antarctica','en'),(17,9,'Antigua And Barbuda','fr'),(18,9,'Antigua And Barbuda','en'),(19,10,'Argentina','fr'),(20,10,'Argentina','en'),(21,11,'Armenia','fr'),(22,11,'Armenia','en'),(23,12,'Aruba','fr'),(24,12,'Aruba','en'),(25,13,'Australia','fr'),(26,13,'Australia','en'),(27,14,'Austria','fr'),(28,14,'Austria','en'),(29,15,'Azerbaijan','fr'),(30,15,'Azerbaijan','en'),(31,16,'Bahamas','fr'),(32,16,'Bahamas','en'),(33,17,'Bahrain','fr'),(34,17,'Bahrain','en'),(35,18,'Bangladesh','fr'),(36,18,'Bangladesh','en'),(37,19,'Barbados','fr'),(38,19,'Barbados','en'),(39,20,'Belarus','fr'),(40,20,'Belarus','en'),(41,21,'Belgium','fr'),(42,21,'Belgium','en'),(43,22,'Belize','fr'),(44,22,'Belize','en'),(45,23,'Benin','fr'),(46,23,'Benin','en'),(47,24,'Bermuda','fr'),(48,24,'Bermuda','en'),(49,25,'Bhutan','fr'),(50,25,'Bhutan','en'),(51,26,'Bolivia','fr'),(52,26,'Bolivia','en'),(53,27,'Bosnia And Herzegovina','fr'),(54,27,'Bosnia And Herzegovina','en'),(55,28,'Botswana','fr'),(56,28,'Botswana','en'),(57,29,'Bouvet Island','fr'),(58,29,'Bouvet Island','en'),(59,30,'Brazil','fr'),(60,30,'Brazil','en'),(61,31,'British Indian Ocean Territory','fr'),(62,31,'British Indian Ocean Territory','en'),(63,32,'Brunei Darussalam','fr'),(64,32,'Brunei Darussalam','en'),(65,33,'Bulgaria','fr'),(66,33,'Bulgaria','en'),(67,34,'Burkina Faso','fr'),(68,34,'Burkina Faso','en'),(69,35,'Burundi','fr'),(70,35,'Burundi','en'),(71,36,'Cambodia','fr'),(72,36,'Cambodia','en'),(73,37,'Cameroon','fr'),(74,37,'Cameroon','en'),(75,38,'Canada','fr'),(76,38,'Canada','en'),(77,39,'Cape Verde','fr'),(78,39,'Cape Verde','en'),(79,40,'Cayman Islands','fr'),(80,40,'Cayman Islands','en'),(81,41,'Central African Republic','fr'),(82,41,'Central African Republic','en'),(83,42,'Chad','fr'),(84,42,'Chad','en'),(85,43,'Chile','fr'),(86,43,'Chile','en'),(87,44,'China','fr'),(88,44,'China','en'),(89,45,'Christmas Island','fr'),(90,45,'Christmas Island','en'),(91,46,'Cocos (keeling) Islands','fr'),(92,46,'Cocos (keeling) Islands','en'),(93,47,'Colombia','fr'),(94,47,'Colombia','en'),(95,48,'Comoros','fr'),(96,48,'Comoros','en'),(97,49,'Congo','fr'),(98,49,'Congo','en'),(99,50,'Congo, The Democratic Republic Of The','fr'),(100,50,'Congo, The Democratic Republic Of The','en'),(101,51,'Cook Islands','fr'),(102,51,'Cook Islands','en'),(103,52,'Costa Rica','fr'),(104,52,'Costa Rica','en'),(105,53,'Cote D\'ivoire','fr'),(106,53,'Cote D\'ivoire','en'),(107,54,'Croatia','fr'),(108,54,'Croatia','en'),(109,55,'Cuba','fr'),(110,55,'Cuba','en'),(111,56,'Cyprus','fr'),(112,56,'Cyprus','en'),(113,57,'Czech Republic','fr'),(114,57,'Czech Republic','en'),(115,58,'Denmark','fr'),(116,58,'Denmark','en'),(117,59,'Djibouti','fr'),(118,59,'Djibouti','en'),(119,60,'Dominica','fr'),(120,60,'Dominica','en'),(121,61,'Dominican Republic','fr'),(122,61,'Dominican Republic','en'),(123,62,'East Timor','fr'),(124,62,'East Timor','en'),(125,63,'Ecuador','fr'),(126,63,'Ecuador','en'),(127,64,'Egypt','fr'),(128,64,'Egypt','en'),(129,65,'El Salvador','fr'),(130,65,'El Salvador','en'),(131,66,'Equatorial Guinea','fr'),(132,66,'Equatorial Guinea','en'),(133,67,'Eritrea','fr'),(134,67,'Eritrea','en'),(135,68,'Estonia','fr'),(136,68,'Estonia','en'),(137,69,'Ethiopia','fr'),(138,69,'Ethiopia','en'),(139,70,'Falkland Islands (malvinas)','fr'),(140,70,'Falkland Islands (malvinas)','en'),(141,71,'Faroe Islands','fr'),(142,71,'Faroe Islands','en'),(143,72,'Fiji','fr'),(144,72,'Fiji','en'),(145,73,'Finland','fr'),(146,73,'Finland','en'),(147,74,'France','fr'),(148,74,'France','en'),(149,75,'French Guiana','fr'),(150,75,'French Guiana','en'),(151,76,'French Polynesia','fr'),(152,76,'French Polynesia','en'),(153,77,'French Southern Territories','fr'),(154,77,'French Southern Territories','en'),(155,78,'Gabon','fr'),(156,78,'Gabon','en'),(157,79,'Gambia','fr'),(158,79,'Gambia','en'),(159,80,'Georgia','fr'),(160,80,'Georgia','en'),(161,81,'Germany','fr'),(162,81,'Germany','en'),(163,82,'Ghana','fr'),(164,82,'Ghana','en'),(165,83,'Gibraltar','fr'),(166,83,'Gibraltar','en'),(167,84,'Greece','fr'),(168,84,'Greece','en'),(169,85,'Greenland','fr'),(170,85,'Greenland','en'),(171,86,'Grenada','fr'),(172,86,'Grenada','en'),(173,87,'Guadeloupe','fr'),(174,87,'Guadeloupe','en'),(175,88,'Guam','fr'),(176,88,'Guam','en'),(177,89,'Guatemala','fr'),(178,89,'Guatemala','en'),(179,90,'Guinea','fr'),(180,90,'Guinea','en'),(181,91,'Guinea-bissau','fr'),(182,91,'Guinea-bissau','en'),(183,92,'Guyana','fr'),(184,92,'Guyana','en'),(185,93,'Haiti','fr'),(186,93,'Haiti','en'),(187,94,'Heard Island And Mcdonald Islands','fr'),(188,94,'Heard Island And Mcdonald Islands','en'),(189,95,'Holy See (vatican City State)','fr'),(190,95,'Holy See (vatican City State)','en'),(191,96,'Honduras','fr'),(192,96,'Honduras','en'),(193,97,'Hong Kong','fr'),(194,97,'Hong Kong','en'),(195,98,'Hungary','fr'),(196,98,'Hungary','en'),(197,99,'Iceland','fr'),(198,99,'Iceland','en'),(199,100,'India','fr'),(200,100,'India','en'),(201,101,'Indonesia','fr'),(202,101,'Indonesia','en'),(203,102,'Iran, Islamic Republic Of','fr'),(204,102,'Iran, Islamic Republic Of','en'),(205,103,'Iraq','fr'),(206,103,'Iraq','en'),(207,104,'Ireland','fr'),(208,104,'Ireland','en'),(209,105,'Israel','fr'),(210,105,'Israel','en'),(211,106,'Italy','fr'),(212,106,'Italy','en'),(213,107,'Jamaica','fr'),(214,107,'Jamaica','en'),(215,108,'Japan','fr'),(216,108,'Japan','en'),(217,109,'Jordan','fr'),(218,109,'Jordan','en'),(219,110,'Kazakstan','fr'),(220,110,'Kazakstan','en'),(221,111,'Kenya','fr'),(222,111,'Kenya','en'),(223,112,'Kiribati','fr'),(224,112,'Kiribati','en'),(225,113,'Korea, Democratic People\'s Republic Of','fr'),(226,113,'Korea, Democratic People\'s Republic Of','en'),(227,114,'Korea, Republic Of','fr'),(228,114,'Korea, Republic Of','en'),(229,115,'Kosovo','fr'),(230,115,'Kosovo','en'),(231,116,'Kuwait','fr'),(232,116,'Kuwait','en'),(233,117,'Kyrgyzstan','fr'),(234,117,'Kyrgyzstan','en'),(235,118,'Lao People\'s Democratic Republic','fr'),(236,118,'Lao People\'s Democratic Republic','en'),(237,119,'Latvia','fr'),(238,119,'Latvia','en'),(239,120,'Lebanon','fr'),(240,120,'Lebanon','en'),(241,121,'Lesotho','fr'),(242,121,'Lesotho','en'),(243,122,'Liberia','fr'),(244,122,'Liberia','en'),(245,123,'Libyan Arab Jamahiriya','fr'),(246,123,'Libyan Arab Jamahiriya','en'),(247,124,'Liechtenstein','fr'),(248,124,'Liechtenstein','en'),(249,125,'Lithuania','fr'),(250,125,'Lithuania','en'),(251,126,'Luxembourg','fr'),(252,126,'Luxembourg','en'),(253,127,'Macau','fr'),(254,127,'Macau','en'),(255,128,'Macedonia, The Former Yugoslav Republic Of','fr'),(256,128,'Macedonia, The Former Yugoslav Republic Of','en'),(257,129,'Madagascar','fr'),(258,129,'Madagascar','en'),(259,130,'Malawi','fr'),(260,130,'Malawi','en'),(261,131,'Malaysia','fr'),(262,131,'Malaysia','en'),(263,132,'Maldives','fr'),(264,132,'Maldives','en'),(265,133,'Mali','fr'),(266,133,'Mali','en'),(267,134,'Malta','fr'),(268,134,'Malta','en'),(269,135,'Marshall Islands','fr'),(270,135,'Marshall Islands','en'),(271,136,'Martinique','fr'),(272,136,'Martinique','en'),(273,137,'Mauritania','fr'),(274,137,'Mauritania','en'),(275,138,'Mauritius','fr'),(276,138,'Mauritius','en'),(277,139,'Mayotte','fr'),(278,139,'Mayotte','en'),(279,140,'Mexico','fr'),(280,140,'Mexico','en'),(281,141,'Micronesia, Federated States Of','fr'),(282,141,'Micronesia, Federated States Of','en'),(283,142,'Moldova, Republic Of','fr'),(284,142,'Moldova, Republic Of','en'),(285,143,'Monaco','fr'),(286,143,'Monaco','en'),(287,144,'Mongolia','fr'),(288,144,'Mongolia','en'),(289,145,'Montserrat','fr'),(290,145,'Montserrat','en'),(291,146,'Montenegro','fr'),(292,146,'Montenegro','en'),(293,147,'Morocco','fr'),(294,147,'Morocco','en'),(295,148,'Mozambique','fr'),(296,148,'Mozambique','en'),(297,149,'Myanmar','fr'),(298,149,'Myanmar','en'),(299,150,'Namibia','fr'),(300,150,'Namibia','en'),(301,151,'Nauru','fr'),(302,151,'Nauru','en'),(303,152,'Nepal','fr'),(304,152,'Nepal','en'),(305,153,'Netherlands','fr'),(306,153,'Netherlands','en'),(307,154,'Netherlands Antilles','fr'),(308,154,'Netherlands Antilles','en'),(309,155,'New Caledonia','fr'),(310,155,'New Caledonia','en'),(311,156,'New Zealand','fr'),(312,156,'New Zealand','en'),(313,157,'Nicaragua','fr'),(314,157,'Nicaragua','en'),(315,158,'Niger','fr'),(316,158,'Niger','en'),(317,159,'Nigeria','fr'),(318,159,'Nigeria','en'),(319,160,'Niue','fr'),(320,160,'Niue','en'),(321,161,'Norfolk Island','fr'),(322,161,'Norfolk Island','en'),(323,162,'Northern Mariana Islands','fr'),(324,162,'Northern Mariana Islands','en'),(325,163,'Norway','fr'),(326,163,'Norway','en'),(327,164,'Oman','fr'),(328,164,'Oman','en'),(329,165,'Pakistan','fr'),(330,165,'Pakistan','en'),(331,166,'Palau','fr'),(332,166,'Palau','en'),(333,167,'Palestinian Territory, Occupied','fr'),(334,167,'Palestinian Territory, Occupied','en'),(335,168,'Panama','fr'),(336,168,'Panama','en'),(337,169,'Papua New Guinea','fr'),(338,169,'Papua New Guinea','en'),(339,170,'Paraguay','fr'),(340,170,'Paraguay','en'),(341,171,'Peru','fr'),(342,171,'Peru','en'),(343,172,'Philippines','fr'),(344,172,'Philippines','en'),(345,173,'Pitcairn','fr'),(346,173,'Pitcairn','en'),(347,174,'Poland','fr'),(348,174,'Poland','en'),(349,175,'Portugal','fr'),(350,175,'Portugal','en'),(351,176,'Puerto Rico','fr'),(352,176,'Puerto Rico','en'),(353,177,'Qatar','fr'),(354,177,'Qatar','en'),(355,178,'Reunion','fr'),(356,178,'Reunion','en'),(357,179,'Romania','fr'),(358,179,'Romania','en'),(359,180,'Russian Federation','fr'),(360,180,'Russian Federation','en'),(361,181,'Rwanda','fr'),(362,181,'Rwanda','en'),(363,182,'Saint Helena','fr'),(364,182,'Saint Helena','en'),(365,183,'Saint Kitts And Nevis','fr'),(366,183,'Saint Kitts And Nevis','en'),(367,184,'Saint Lucia','fr'),(368,184,'Saint Lucia','en'),(369,185,'Saint Pierre And Miquelon','fr'),(370,185,'Saint Pierre And Miquelon','en'),(371,186,'Saint Vincent And The Grenadines','fr'),(372,186,'Saint Vincent And The Grenadines','en'),(373,187,'Samoa','fr'),(374,187,'Samoa','en'),(375,188,'San Marino','fr'),(376,188,'San Marino','en'),(377,189,'Sao Tome And Principe','fr'),(378,189,'Sao Tome And Principe','en'),(379,190,'Saudi Arabia','fr'),(380,190,'Saudi Arabia','en'),(381,191,'Senegal','fr'),(382,191,'Senegal','en'),(383,192,'Serbia','fr'),(384,192,'Serbia','en'),(385,193,'Seychelles','fr'),(386,193,'Seychelles','en'),(387,194,'Sierra Leone','fr'),(388,194,'Sierra Leone','en'),(389,195,'Singapore','fr'),(390,195,'Singapore','en'),(391,196,'Slovakia','fr'),(392,196,'Slovakia','en'),(393,197,'Slovenia','fr'),(394,197,'Slovenia','en'),(395,198,'Solomon Islands','fr'),(396,198,'Solomon Islands','en'),(397,199,'Somalia','fr'),(398,199,'Somalia','en'),(399,200,'South Africa','fr'),(400,200,'South Africa','en'),(401,201,'South Georgia And The South Sandwich Islands','fr'),(402,201,'South Georgia And The South Sandwich Islands','en'),(403,202,'Spain','fr'),(404,202,'Spain','en'),(405,203,'Sri Lanka','fr'),(406,203,'Sri Lanka','en'),(407,204,'Sudan','fr'),(408,204,'Sudan','en'),(409,205,'Suriname','fr'),(410,205,'Suriname','en'),(411,206,'Svalbard And Jan Mayen','fr'),(412,206,'Svalbard And Jan Mayen','en'),(413,207,'Swaziland','fr'),(414,207,'Swaziland','en'),(415,208,'Sweden','fr'),(416,208,'Sweden','en'),(417,209,'Switzerland','fr'),(418,209,'Switzerland','en'),(419,210,'Syrian Arab Republic','fr'),(420,210,'Syrian Arab Republic','en'),(421,211,'Taiwan, Province Of China','fr'),(422,211,'Taiwan, Province Of China','en'),(423,212,'Tajikistan','fr'),(424,212,'Tajikistan','en'),(425,213,'Tanzania, United Republic Of','fr'),(426,213,'Tanzania, United Republic Of','en'),(427,214,'Thailand','fr'),(428,214,'Thailand','en'),(429,215,'Togo','fr'),(430,215,'Togo','en'),(431,216,'Tokelau','fr'),(432,216,'Tokelau','en'),(433,217,'Tonga','fr'),(434,217,'Tonga','en'),(435,218,'Trinidad And Tobago','fr'),(436,218,'Trinidad And Tobago','en'),(437,219,'Tunisia','fr'),(438,219,'Tunisia','en'),(439,220,'Turkey','fr'),(440,220,'Turkey','en'),(441,221,'Turkmenistan','fr'),(442,221,'Turkmenistan','en'),(443,222,'Turks And Caicos Islands','fr'),(444,222,'Turks And Caicos Islands','en'),(445,223,'Tuvalu','fr'),(446,223,'Tuvalu','en'),(447,224,'Uganda','fr'),(448,224,'Uganda','en'),(449,225,'Ukraine','fr'),(450,225,'Ukraine','en'),(451,226,'United Arab Emirates','fr'),(452,226,'United Arab Emirates','en'),(453,227,'United Kingdom','fr'),(454,227,'United Kingdom','en'),(455,228,'United States','fr'),(456,228,'United States','en'),(457,229,'United States Minor Outlying Islands','fr'),(458,229,'United States Minor Outlying Islands','en'),(459,230,'Uruguay','fr'),(460,230,'Uruguay','en'),(461,231,'Uzbekistan','fr'),(462,231,'Uzbekistan','en'),(463,232,'Vanuatu','fr'),(464,232,'Vanuatu','en'),(465,233,'Venezuela','fr'),(466,233,'Venezuela','en'),(467,234,'Viet Nam','fr'),(468,234,'Viet Nam','en'),(469,235,'Virgin Islands, British','fr'),(470,235,'Virgin Islands, British','en'),(471,236,'Virgin Islands, U.s.','fr'),(472,236,'Virgin Islands, U.s.','en'),(473,237,'Wallis And Futuna','fr'),(474,237,'Wallis And Futuna','en'),(475,238,'Western Sahara','fr'),(476,238,'Western Sahara','en'),(477,239,'Yemen','fr'),(478,239,'Yemen','en'),(479,240,'Zambia','fr'),(480,240,'Zambia','en'),(481,241,'Zimbabwe','fr'),(482,241,'Zimbabwe','en');

/*Table structure for table `enquiry` */

DROP TABLE IF EXISTS `enquiry`;

CREATE TABLE `enquiry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `enquiry` */

/*Table structure for table `event` */

DROP TABLE IF EXISTS `event`;

CREATE TABLE `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `eventType_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FA6F25A3C15B25DE` (`eventType_id`),
  KEY `IDX_FA6F25A3A76ED395` (`user_id`),
  CONSTRAINT `FK_FA6F25A3A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_FA6F25A3C15B25DE` FOREIGN KEY (`eventType_id`) REFERENCES `eventtype` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `event` */

/*Table structure for table `event_address` */

DROP TABLE IF EXISTS `event_address`;

CREATE TABLE `event_address` (
  `address_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  PRIMARY KEY (`address_id`,`event_id`),
  KEY `IDX_8819C62EF5B7AF75` (`address_id`),
  KEY `IDX_8819C62E71F7E88B` (`event_id`),
  CONSTRAINT `FK_8819C62E71F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
  CONSTRAINT `FK_8819C62EF5B7AF75` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `event_address` */

/*Table structure for table `event_eventdates` */

DROP TABLE IF EXISTS `event_eventdates`;

CREATE TABLE `event_eventdates` (
  `event_id` int(11) NOT NULL,
  `eEventDate_id` int(11) NOT NULL,
  PRIMARY KEY (`eEventDate_id`,`event_id`),
  KEY `IDX_70B50385C3CCAD7E` (`eEventDate_id`),
  KEY `IDX_70B5038571F7E88B` (`event_id`),
  CONSTRAINT `FK_70B5038571F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
  CONSTRAINT `FK_70B50385C3CCAD7E` FOREIGN KEY (`eEventDate_id`) REFERENCES `eventdate` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `event_eventdates` */

/*Table structure for table `event_file` */

DROP TABLE IF EXISTS `event_file`;

CREATE TABLE `event_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7009450771F7E88B` (`event_id`),
  CONSTRAINT `FK_7009450771F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `event_file` */

/*Table structure for table `event_musictype` */

DROP TABLE IF EXISTS `event_musictype`;

CREATE TABLE `event_musictype` (
  `event_id` int(11) NOT NULL,
  `musicType_id` int(11) NOT NULL,
  PRIMARY KEY (`event_id`,`musicType_id`),
  KEY `IDX_8416D26661A9175` (`musicType_id`),
  KEY `IDX_8416D2671F7E88B` (`event_id`),
  CONSTRAINT `FK_8416D26661A9175` FOREIGN KEY (`musicType_id`) REFERENCES `musictype` (`id`),
  CONSTRAINT `FK_8416D2671F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `event_musictype` */

/*Table structure for table `eventdate` */

DROP TABLE IF EXISTS `eventdate`;

CREATE TABLE `eventdate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startdate` date NOT NULL,
  `stopdate` date DEFAULT NULL,
  `starttime` time DEFAULT NULL,
  `stoptime` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `eventdate` */

/*Table structure for table `eventtranslation` */

DROP TABLE IF EXISTS `eventtranslation`;

CREATE TABLE `eventtranslation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1E6F98922C2AC5D34180C698` (`translatable_id`,`locale`),
  KEY `IDX_1E6F98922C2AC5D3` (`translatable_id`),
  CONSTRAINT `FK_1E6F98922C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `event` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `eventtranslation` */

/*Table structure for table `eventtype` */

DROP TABLE IF EXISTS `eventtype`;

CREATE TABLE `eventtype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `eventtype` */

insert  into `eventtype`(`id`,`name`) values (1,'party'),(2,'Festival'),(3,'workshop'),(4,'lessons'),(5,'Shows');

/*Table structure for table `eventtypetranslation` */

DROP TABLE IF EXISTS `eventtypetranslation`;

CREATE TABLE `eventtypetranslation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_DDB9698C2C2AC5D34180C698` (`translatable_id`,`locale`),
  KEY `IDX_DDB9698C2C2AC5D3` (`translatable_id`),
  CONSTRAINT `FK_DDB9698C2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `eventtype` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `eventtypetranslation` */

insert  into `eventtypetranslation`(`id`,`translatable_id`,`title`,`locale`) values (1,1,'Party','en'),(2,1,'Soirée','fr'),(3,2,'Festival','en'),(4,2,'Festival','fr'),(5,3,'Workshop','en'),(6,3,'Workshop','fr'),(7,4,'Lessons','en'),(8,4,'Cours','fr'),(9,5,'Shows','en'),(10,5,'Shows','fr');

/*Table structure for table `musictype` */

DROP TABLE IF EXISTS `musictype`;

CREATE TABLE `musictype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `musictype` */

insert  into `musictype`(`id`,`name`) values (1,'Salsa'),(2,'Bachata'),(3,'Kizomba'),(4,'Tango');

/*Table structure for table `musictypetranslation` */

DROP TABLE IF EXISTS `musictypetranslation`;

CREATE TABLE `musictypetranslation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_F8A763AA2C2AC5D34180C698` (`translatable_id`,`locale`),
  KEY `IDX_F8A763AA2C2AC5D3` (`translatable_id`),
  CONSTRAINT `FK_F8A763AA2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `musictype` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `musictypetranslation` */

insert  into `musictypetranslation`(`id`,`translatable_id`,`title`,`locale`) values (1,1,'Salsa','en'),(2,1,'Salsa','fr'),(3,2,'Bachata','en'),(4,2,'Bachata','fr'),(5,3,'Kizomba','en'),(6,3,'Kizomba','fr'),(7,4,'Tango','en'),(8,4,'Tango','fr');

/*Table structure for table `page` */

DROP TABLE IF EXISTS `page`;

CREATE TABLE `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `page` */

insert  into `page`(`id`,`name`) values (5,'home'),(6,'city');

/*Table structure for table `pagetranslation` */

DROP TABLE IF EXISTS `pagetranslation`;

CREATE TABLE `pagetranslation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_D29B35C02C2AC5D34180C698` (`translatable_id`,`locale`),
  KEY `IDX_D29B35C02C2AC5D3` (`translatable_id`),
  CONSTRAINT `FK_D29B35C02C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `page` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `pagetranslation` */

insert  into `pagetranslation`(`id`,`translatable_id`,`title`,`content`,`description`,`locale`) values (1,5,'home',NULL,'home','en'),(2,5,'accueil',NULL,'accueil','fr');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `facebook_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_access_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `google_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `google_access_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `google_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `linkedin_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `flickr_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tumblr_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instagram_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vimeo_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `youtube_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_8D93D649A0D96FBF` (`email_canonical`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`username_canonical`,`email`,`email_canonical`,`enabled`,`salt`,`password`,`last_login`,`locked`,`expired`,`expires_at`,`confirmation_token`,`password_requested_at`,`roles`,`credentials_expired`,`credentials_expire_at`,`facebook_id`,`facebook_access_token`,`google_id`,`google_access_token`,`facebook_link`,`google_link`,`twitter_link`,`linkedin_link`,`flickr_link`,`tumblr_link`,`instagram_link`,`vimeo_link`,`youtube_link`) values (1,'adminuser','adminuser','jeromebarea@yahoo.fr','jeromebarea@yahoo.fr',1,'3fbeaqd4h3aco80048ggkws0ww8c04s','1234{3fbeaqd4h3aco80048ggkws0ww8c04s}','2014-09-25 17:38:47',0,0,NULL,NULL,NULL,'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}',0,NULL,NULL,NULL,NULL,NULL,'http://facebook/jeje',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `user_address` */

DROP TABLE IF EXISTS `user_address`;

CREATE TABLE `user_address` (
  `user_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  PRIMARY KEY (`address_id`,`user_id`),
  KEY `IDX_5543718BF5B7AF75` (`address_id`),
  KEY `IDX_5543718BA76ED395` (`user_id`),
  CONSTRAINT `FK_5543718BA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_5543718BF5B7AF75` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `user_address` */

/*Table structure for table `user_file` */

DROP TABLE IF EXISTS `user_file`;

CREATE TABLE `user_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F61E7AD9A76ED395` (`user_id`),
  CONSTRAINT `FK_F61E7AD9A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `user_file` */

/*Table structure for table `user_musictype` */

DROP TABLE IF EXISTS `user_musictype`;

CREATE TABLE `user_musictype` (
  `user_id` int(11) NOT NULL,
  `musicType_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`musicType_id`),
  KEY `IDX_8E34DEFFA76ED395` (`user_id`),
  KEY `IDX_8E34DEFF661A9175` (`musicType_id`),
  CONSTRAINT `FK_8E34DEFF661A9175` FOREIGN KEY (`musicType_id`) REFERENCES `musictype` (`id`),
  CONSTRAINT `FK_8E34DEFFA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `user_musictype` */

/*Table structure for table `user_usertype` */

DROP TABLE IF EXISTS `user_usertype`;

CREATE TABLE `user_usertype` (
  `user_id` int(11) NOT NULL,
  `userType_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`userType_id`),
  KEY `IDX_6A1C6466A76ED395` (`user_id`),
  KEY `IDX_6A1C6466969049B1` (`userType_id`),
  CONSTRAINT `FK_6A1C6466969049B1` FOREIGN KEY (`userType_id`) REFERENCES `usertype` (`id`),
  CONSTRAINT `FK_6A1C6466A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `user_usertype` */

/*Table structure for table `usertranslation` */

DROP TABLE IF EXISTS `usertranslation`;

CREATE TABLE `usertranslation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `translatable_id` int(11) DEFAULT NULL,
  `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `baseline` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `description_short` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_7E1CC2B22C2AC5D34180C698` (`translatable_id`,`locale`),
  KEY `IDX_7E1CC2B22C2AC5D3` (`translatable_id`),
  CONSTRAINT `FK_7E1CC2B22C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `usertranslation` */

/*Table structure for table `usertype` */

DROP TABLE IF EXISTS `usertype`;

CREATE TABLE `usertype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `usertype` */

insert  into `usertype`(`id`,`name`) values (1,'dancer'),(2,'teacher'),(3,'artist'),(4,'bar');

/*Table structure for table `usertypetranslation` */

DROP TABLE IF EXISTS `usertypetranslation`;

CREATE TABLE `usertypetranslation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `translatable_id` int(11) DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_550026B92C2AC5D34180C698` (`translatable_id`,`locale`),
  KEY `IDX_550026B92C2AC5D3` (`translatable_id`),
  CONSTRAINT `FK_550026B92C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `usertype` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `usertypetranslation` */

insert  into `usertypetranslation`(`id`,`translatable_id`,`name`,`locale`) values (1,1,'Dancer','en'),(2,1,'Danseur','fr'),(3,2,'Teacher','en'),(4,2,'Professeur','fr'),(5,3,'Artist','en'),(6,3,'Artiste','fr'),(7,4,'Bar/Club','en'),(8,4,'Bar/Club','fr');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
