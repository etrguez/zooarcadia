-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: arcadia
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

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
-- Table structure for table `animaux`
--

DROP TABLE IF EXISTS `animaux`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `animaux` (
  `animal_id` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(50) NOT NULL,
  `etat` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `habitat_id` int(11) NOT NULL,
  `race_id` int(11) NOT NULL,
  PRIMARY KEY (`animal_id`),
  KEY `habitat_id` (`habitat_id`),
  KEY `race_id` (`race_id`),
  CONSTRAINT `animaux_ibfk_1` FOREIGN KEY (`habitat_id`) REFERENCES `habitats` (`habitat_id`),
  CONSTRAINT `animaux_ibfk_2` FOREIGN KEY (`race_id`) REFERENCES `races` (`race_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `animaux`
--

LOCK TABLES `animaux` WRITE;
/*!40000 ALTER TABLE `animaux` DISABLE KEYS */;
INSERT INTO `animaux` VALUES (6,'Dumbo','Il se porte très bien.','Description: Dumbo, un éléphant d\'Asie, vivait autrefois dans une jungle dense avec sa famille. Un jour, capturé par des braconniers, il fut sauvé par une organisation de protection des animaux. Après des soins, il fut transféré dans un zoo moderne,Arcadia où il vit aujourd\'hui. Ses jours sont désormais rythmés par les soins des soigneurs et les visites des enfants émerveillés. Bien que la liberté de la jungle lui manque parfois, Dumbo est en sécurité et participe à des programmes de sensibilisation pour protéger les éléphants sauvages, aidant à éduquer les visiteurs sur la conservation.',6,1),(7,'Sundara','Elle va très bien.','Sundara est née dans une petite réserve en Inde, mais après une période de sécheresse, elle fut déplacée dans à Arcadia pour sa survie. Elle s’adapta bien à sa nouvelle vie, recevant des soins réguliers et participant à des programmes de sensibilisation pour les visiteurs. Sundara est devenue un symbole de la protection des éléphants en captivité.',6,1),(8,'Ravi','Bien','Ravi, autrefois éléphant de travail en Asie, était utilisé pour transporter du bois dans les forêts. Après des années de dur labeur, il fut secouru par une organisation de protection animale. Aujourd’hui, Ravi vit à Arcadia, où il reçoit des soins adaptés à son âge avancé. Même s’il n’est plus en liberté, il profite de la tranquillité après des années de travail pénible.',6,1),(9,'Temba','Bien','Temba est né dans une vaste réserve en Afrique, mais une sécheresse a gravement réduit les ressources en eau et en nourriture pour son troupeau. Pour sa sécurité et sa survie, il fut transféré à Arcadia, conçu pour recréer au mieux son habitat naturel. Ici, Temba découvre un nouvel environnement avec de grands espaces ouverts, des étangs artificiels et des arbres pour se nourrir. Grâce aux efforts de l’équipe, il vit en paix et continue d’apprendre à interagir avec les autres éléphants du groupe. Temba participe également à des projets de conservation qui sensibilisent les visiteurs à la protection des habitats africains menacés.',6,1),(10,'Amani','Bien','Amani, une jeune gazelle, est née dans une réserve en Afrique, mais après une blessure causée par un prédateur, elle fut transférée à l\'écozoo Arcadia pour être soignée. Aujourd\'hui, elle vit dans un grand enclos qui recrée les plaines africaines, où elle peut courir librement. Grâce aux soins attentifs de l’équipe, Amani a récupéré et aide à sensibiliser les visiteurs à la protection des espèces vulnérables.',6,4),(11,'Zahara','Elle va très bien.','Zahara a été recueillie par Arcadia après avoir été sauvée d\'un trafic illégal d\'animaux. Au zoo, elle vit en sécurité avec d\'autres gazelles, dans un habitat spécialement conçu pour leurs besoins. Chaque jour, Zahara profite des grandes prairies artificielles, où elle peut bondir gracieusement sous l’œil attentif des visiteurs, tout en contribuant à des projets de conservation.',6,4),(12,'Kesi','Bien','Kesi, une gazelle au tempérament curieux, a été amenée à Arcadia après qu\'une sécheresse prolongée ait rendu son ancien habitat invivable. À Arcadia, elle s’est adaptée à son nouvel environnement, explorant chaque recoin de son enclos verdoyant. Kesi adore observer les enfants qui viennent la voir et continue d’être un symbole de résilience face aux défis climatiques qui menacent les espèces sauvages.',6,4),(13,'Mara','Bien','Mara est née dans une petite réserve africaine, mais après plusieurs années de sécheresse, les ressources en nourriture sont devenues insuffisantes pour le troupeau. Elle fut transférée à l\'écozoo Arcadia, où elle vit désormais dans un enclos spacieux, entouré d’arbres adaptés à son régime alimentaire. Mara est une girafe calme et curieuse, fascinant les visiteurs avec sa démarche élégante et sa taille imposante.',6,11),(14,'Tafari','Bien','Tafari, autrefois menacé par le braconnage, a été sauvé par une organisation de protection animale et transporté à Arcadia pour une vie plus sûre. Dans ce zoo écologique, il passe ses journées à se nourrir des branches des arbres spécialement plantés pour les girafes. Sociable et joueur, Tafari adore interagir avec les soigneurs, qui l’aident à sensibiliser les visiteurs aux dangers qui pèsent sur les girafes dans la nature.',6,11),(15,'Suki','Bien','Suki est née en captivité dans un autre zoo, mais a été transférée à Arcadia pour rejoindre un groupe social plus adapté à son comportement. Dans cet écozoo, elle est devenue l’une des leaders du groupe de macaques, toujours à surveiller son entourage. Suki est fascinante à observer, avec son énergie débordante et sa capacité à s’adapter à son nouvel environnement plus naturel.',5,5),(16,'Taro','Bien','Taro, autrefois utilisé dans un laboratoire pour des expériences médicales, a été libéré et amené à Arcadia pour une seconde chance. Aujourd\'hui, il vit paisiblement dans un enclos vaste et arboré. Bien qu’il ait mis du temps à s’habituer à la vie en communauté, Taro profite désormais des interactions avec ses congénères et explore son environnement en toute liberté. Il symbolise la réhabilitation des animaux et l’espoir d’une vie meilleure.',5,5),(17,'Kiko','Bien','Kiko a été recueilli après avoir été trouvé seul et blessé dans une forêt dégradée par la déforestation. À Arcadia, il a trouvé un nouveau foyer, où il vit dans un enclos recréant les forêts tropicales. Curieux et joueur, Kiko passe ses journées à explorer, grimper aux arbres et interagir avec les autres macaques, tout en aidant les visiteurs à comprendre l’importance de protéger les habitats naturels.',5,5),(18,'Lana','Bien','Lana a été capturée par des braconniers dans une forêt d\'Indonésie, alors qu\'elle était encore jeune. Elle a été sauvée par une organisation de protection des animaux et transférée à l\'écozoo Arcadia. Là-bas, elle a trouvé un environnement calme et sécurisant pour vivre. Forte et protectrice, Lana est devenue mère et veille toujours sur son fils Bumi, tout en sensibilisant les visiteurs à la destruction des forêts tropicales et au sort des orangs-outans en danger d\'extinction.',5,12),(19,'Bumi','Bien','Bumi est né à Arcadia, loin des dangers de la jungle menacée. Curieux et espiègle, il passe ses journées à jouer, grimper aux arbres artificiels et découvrir son environnement sous l\'œil attentif de sa mère, Lana. Bien qu’il n’ait jamais connu la vie sauvage, Bumi représente l’avenir des orangs-outans et participe à des programmes de sensibilisation, montrant aux visiteurs l’importance de protéger les forêts, pour que les générations futures puissent prospérer.',5,12),(20,'Rio','Bien','Rio est un perroquet aux couleurs vives, originaire d’une forêt tropicale brésilienne. Il a été confisqué à des trafiquants d’animaux et transféré à l\'écozoo Arcadia. Intelligent et bavard, Rio aime imiter les sons qu’il entend, surtout les rires des visiteurs. Sa présence rappelle à tous l’importance de lutter contre le trafic d’animaux exotiques.',5,7),(21,'Paco','Bien','Paco a grandi en captivité, dans une petite volière avant d’être transféré à Arcadia pour bénéficier d\'un espace plus grand et enrichi. Avec ses plumes rouges éclatantes, il passe ses journées à voler librement dans un grand enclos, recréant la canopée des forêts. Paco adore interagir avec les soigneurs et a appris à jouer à des jeux d’intelligence pour s’occuper.',5,7),(22,'Lola','Bien','Lola, un vieux perroquet, a été recueillie après avoir vécu des années dans un cirque. Ses ailes abîmées l’empêchent de voler loin, mais elle a trouvé à Arcadia un lieu où elle peut grimper, explorer, et se reposer en toute tranquillité. Maintenant, elle aide à sensibiliser les visiteurs sur les dangers de l’exploitation des animaux dans les spectacles.',5,7),(23,'Wanda','Bien','Wanda, une loutre plus âgée, a été sauvée d’un braconnage illégal. À Arcadia, elle vit dans un environnement sécurisé et paisible, où elle enseigne aux plus jeunes l\'importance de la coopération et du travail en équipe. Elle aime se prélasser au soleil et observer les visiteurs curieux.',7,8),(24,'Wanda','Bien','Bubbles est une loutre espiègle, connue pour son amour du jeu. Rescapée d’un habitat menacé par la pollution, elle a été transférée à l\'écozoo Arcadia. Dans son enclos aquatique, elle passe ses journées à plonger, jongler avec des pierres et jouer avec ses camarades, tout en sensibilisant les visiteurs à la protection des rivières.',7,8),(25,'Finn','Bien','Finn est le frère de Bubbles et adore chasser des poissons. Il a été élevé dans un sanctuaire avant d\'arriver à Arcadia. Agile et rapide, il montre aux visiteurs comment les loutres pêchent en utilisant des techniques qu\'il a apprises de sa mère. Finn est un ambassadeur de la vie aquatique et de son écosystème fragile.',7,8),(26,'Luna','Bien','Luna, la plus jeune des loutres, a été recueillie après avoir été trouvée seule sur une plage. À Arcadia, elle a trouvé une nouvelle famille et s\'amuse beaucoup avec les autres loutres. Curieuse, elle explore son habitat et adore interagir avec les enfants qui viennent la voir, leur enseignant l\'importance de la conservation des espèces aquatiques.',7,8),(27,'Shelly','Bien','Shelly est une tortue des mers qui a été recueillie après avoir été blessée par un filet de pêche. À Arcadia, elle vit dans un grand bassin recréant son habitat naturel. Elle aime se prélasser au soleil et interagir avec les visiteurs, partageant l\'importance de la protection des océans et des tortues marines en danger.',7,9),(28,'Toto','Bien','Toto est une tortue d\'eau douce, transférée à Arcadia après que son habitat ait été détruit par la pollution. Dans son enclos aquatique, il explore les plantes et se cache sous les rochers. Toto participe à des programmes éducatifs pour sensibiliser les enfants sur la préservation des rivières et des lacs, devenant un ambassadeur pour son espèce.',7,9),(29,'Cobalt','Bien','Cobalt est un héron pourpre majestueux, recueilli après avoir été blessé par un pêcheur. À Arcadia, il vit dans un grand enclos aquatique, où il peut chasser des poissons et se percher sur des branches. Grâce à son élégance et à ses couleurs vibrantes, Cobalt attire de nombreux visiteurs, sensibilisant ainsi à la préservation des zones humides.',7,10),(30,'Sienna','Bien','Sienna, une héronne plus jeune, a été sauvée d\'une zone marécageuse menacée par la pollution. À Arcadia, elle s\'épanouit en apprenant à pêcher et à interagir avec les autres oiseaux. Sienna participe à des programmes éducatifs, montrant aux enfants l\'importance de protéger les habitats naturels et la biodiversité.',7,10);
/*!40000 ALTER TABLE `animaux` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `avis`
--

DROP TABLE IF EXISTS `avis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `avis` (
  `avis_id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(50) NOT NULL,
  `commentaire` text NOT NULL,
  `isVisible` tinyint(1) NOT NULL,
  PRIMARY KEY (`avis_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avis`
--

LOCK TABLES `avis` WRITE;
/*!40000 ALTER TABLE `avis` DISABLE KEYS */;
INSERT INTO `avis` VALUES (1,'Sophie L.','Un endroit magnifique pour passer la journée en famille ! Les animaux sont bien soignés, et les habitats sont vraiment impressionnants. Mes enfants ont adoré la visite en petit train, et la visite guidée était super instructive. On reviendra sûrement !',1),(2,'Thomas M.','Le zoo Arcadia est un véritable havre de paix. J\'ai été impressionné par l\'engagement écologique du parc et la manière dont ils recréent les habitats naturels des animaux. Le restaurant végétarien est une excellente surprise avec des plats délicieux !',1),(3,'Claire D.','Une expérience incroyable ! La diversité des animaux et la qualité des installations sont remarquables. J\'ai particulièrement apprécié la visite guidée, qui était très enrichissante. Un bel exemple de conservation et de sensibilisation.',1);
/*!40000 ALTER TABLE `avis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `habitats`
--

DROP TABLE IF EXISTS `habitats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `habitats` (
  `habitat_id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `commentaire_habitat` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`habitat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `habitats`
--

LOCK TABLES `habitats` WRITE;
/*!40000 ALTER TABLE `habitats` DISABLE KEYS */;
INSERT INTO `habitats` VALUES (5,'La Jungle','Un espace verdoyant avec des arbres denses et des plantes exotiques, abritant des singes, des perroquets, et d\'autres animaux tropicaux. Une cascade artificielle ajoute une touche de fraîcheur à ce cadre inspiré des jungles.',' '),(6,'La Savane ','Un habitat spacieux imitant les plaines africaines, où éléphants, girafes, et gazelles vivent ensemble. Des rochers et quelques acacias décoratifs complètent ce paysage aride',' '),(7,'Le Marais','Un marécage recréé avec des étangs peu profonds et des roseaux. Loutres, tortues, et oiseaux aquatiques s’épanouissent dans cet environnement humide, conçu pour rappeler les zones marécageuses naturelles.',' ');
/*!40000 ALTER TABLE `habitats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `horaires_ouverture`
--

DROP TABLE IF EXISTS `horaires_ouverture`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `horaires_ouverture` (
  `horaire_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_jour` varchar(50) NOT NULL,
  `heure_ouverture` varchar(5) NOT NULL,
  `heure_fermeture` varchar(5) NOT NULL,
  PRIMARY KEY (`horaire_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horaires_ouverture`
--

LOCK TABLES `horaires_ouverture` WRITE;
/*!40000 ALTER TABLE `horaires_ouverture` DISABLE KEYS */;
INSERT INTO `horaires_ouverture` VALUES (1,'L à V','10:00','16:00'),(2,'Week-end et feriés','09:00','17:00');
/*!40000 ALTER TABLE `horaires_ouverture` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `races`
--

DROP TABLE IF EXISTS `races`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `races` (
  `race_id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(50) NOT NULL,
  PRIMARY KEY (`race_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `races`
--

LOCK TABLES `races` WRITE;
/*!40000 ALTER TABLE `races` DISABLE KEYS */;
INSERT INTO `races` VALUES (1,'Elephant'),(2,'éléphant'),(3,'girafe'),(4,'gazelle'),(5,'macaque'),(6,'orangoutan'),(7,'perroquet'),(8,'loutre'),(9,'tortue'),(10,'heron pourpre'),(11,'Giraffe'),(12,'Orangutan');
/*!40000 ALTER TABLE `races` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rapports_veterinaires`
--

DROP TABLE IF EXISTS `rapports_veterinaires`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rapports_veterinaires` (
  `rapport_veterinaire_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `animal_id` int(11) NOT NULL,
  `etat_animal` varchar(50) NOT NULL,
  `nourriture_proposee` varchar(50) NOT NULL,
  `grammage_nourriture` int(11) NOT NULL,
  `date_passage` date NOT NULL,
  `detail_etat_animal` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`rapport_veterinaire_id`),
  KEY `username` (`username`),
  KEY `animal_id` (`animal_id`),
  CONSTRAINT `rapports_veterinaires_ibfk_1` FOREIGN KEY (`username`) REFERENCES `utilisateurs` (`username`) ON DELETE CASCADE,
  CONSTRAINT `rapports_veterinaires_ibfk_2` FOREIGN KEY (`animal_id`) REFERENCES `animaux` (`animal_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rapports_veterinaires`
--

LOCK TABLES `rapports_veterinaires` WRITE;
/*!40000 ALTER TABLE `rapports_veterinaires` DISABLE KEYS */;
INSERT INTO `rapports_veterinaires` VALUES (2,'camille@perez.fr',6,'Bien','Fruits tropicaux,herbes et feuilles.',12000,'2024-09-21',NULL),(5,'camille@perez.fr',7,'Bien','Fruits tropicaux,herbes et feuilles.',120000,'2024-09-21',NULL),(6,'camille@perez.fr',8,'Bien','Fruits tropicaux,herbes et feuilles.',12000,'2024-09-21',NULL);
/*!40000 ALTER TABLE `rapports_veterinaires` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(30) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin'),(2,'employe'),(3,'veterinaire');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'Arcadia Resturant','Le restaurant végétarien d\'Arcadia propose une cuisine saine et savoureuse, inspirée par la nature. Situé au cœur du zoo, il offre un menu 100% végétal, composé d\'ingrédients locaux et de saison. Avec ses plats créatifs et équilibrés, c’est l’endroit idéal pour savourer un repas tout en respectant l\'environnement. Venez profiter d\'une pause gourmande dans un cadre apaisant, en harmonie avec la philosophie écologique du zoo.'),(2,'Visite en petit train.','Le petit train du zoo Arcadia vous invite à une visite confortable et ludique à travers les différents habitats du parc. En famille ou entre amis, découvrez de près les animaux tout en écoutant des anecdotes fascinantes sur leur mode de vie. Ce parcours paisible vous permet de profiter pleinement du zoo tout en vous déplaçant facilement entre les espaces, pour une expérience enrichissante et relaxante.'),(3,'Visite guidée des habitats.','La visite guidée des habitats du zoo Arcadia vous offre une immersion unique au cœur des espaces recréés pour chaque espèce. Accompagnés par un guide expert, vous découvrirez les secrets des animaux et les efforts de conservation déployés pour protéger leur environnement. Une occasion idéale pour en apprendre davantage sur la faune et les écosystèmes, tout en vivant une expérience captivante et éducative.');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utilisateurs` (
  `username` varchar(50) NOT NULL,
  `role_id` int(11) NOT NULL,
  `password` varchar(60) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  PRIMARY KEY (`username`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `utilisateurs_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilisateurs`
--

LOCK TABLES `utilisateurs` WRITE;
/*!40000 ALTER TABLE `utilisateurs` DISABLE KEYS */;
INSERT INTO `utilisateurs` VALUES ('bruno@silva.fr',3,'$2y$10$6iSfXRdcOqsz32pQcqCLHORj770T6AFCp1p.vNBPA3bd/ySNz6STG','Silva','Bruno'),('camille@perez.fr',3,'$2y$10$LhHVSUnE0rFs/MpH/iwofu0uSeWMI.C/6v9wPhvSclIwTIfX6E5vy','Perez','Camille'),('john@doe.fr',2,'$2y$10$jidjU78GV6cl4sbenXTRre.P5g7uhK9jxkFGrMWTLb04Kre9uvjYK','Doe','John'),('jose@arcadia.fr',1,'$2y$10$EnYfxMZGqZVRekXxxA9CGOGAtgXdFk3dIr0uVcENcG9tusnK8bQEm','Arcadia','Jose'),('marie@dupont.fr',2,'$2y$10$4D4yGCsPtJtyqlXyF.DYEOF24MPqlcg8IdgtTzqC7A8gd2P4lT4qG','Dupont','Marie');
/*!40000 ALTER TABLE `utilisateurs` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-14 22:06:51
-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: arcadia
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

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
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `image_data` longblob DEFAULT NULL,
  `habitat_id` int(11) DEFAULT NULL,
  `animal_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`image_id`),
  KEY `habitat_id` (`habitat_id`),
  KEY `animal_id` (`animal_id`),
  KEY `service_id` (`service_id`),
  CONSTRAINT `images_ibfk_1` FOREIGN KEY (`habitat_id`) REFERENCES `habitats` (`habitat_id`) ON DELETE CASCADE,
  CONSTRAINT `images_ibfk_2` FOREIGN KEY (`animal_id`) REFERENCES `animaux` (`animal_id`) ON DELETE CASCADE,
  CONSTRAINT `images_ibfk_3` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-14 22:05:17
