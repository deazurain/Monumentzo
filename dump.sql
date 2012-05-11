-- MySQL dump 10.13  Distrib 5.1.61, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: monumentzo
-- ------------------------------------------------------
-- Server version	5.1.61-0ubuntu0.11.10.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Category`
--

DROP TABLE IF EXISTS `Category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Category` (
  `CategoryID` int(10) unsigned NOT NULL,
  `Category` varchar(45) NOT NULL,
  PRIMARY KEY (`CategoryID`),
  UNIQUE KEY `Category_UNIQUE` (`Category`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Category`
--

LOCK TABLES `Category` WRITE;
/*!40000 ALTER TABLE `Category` DISABLE KEYS */;
/*!40000 ALTER TABLE `Category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Comment`
--

DROP TABLE IF EXISTS `Comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Comment` (
  `CommentID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL,
  `MonumentID` int(10) unsigned NOT NULL,
  `PlaceDate` date DEFAULT NULL,
  `Comment` text,
  PRIMARY KEY (`CommentID`),
  UNIQUE KEY `CommentID_UNIQUE` (`CommentID`),
  KEY `Monumentzo.Comment.UserID` (`UserID`),
  KEY `Monumentzo.Comment.MonumentID` (`MonumentID`),
  CONSTRAINT `Monumentzo.Comment.UserID` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Monumentzo.Comment.MonumentID` FOREIGN KEY (`MonumentID`) REFERENCES `Monument` (`MonumentID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Comment`
--

LOCK TABLES `Comment` WRITE;
/*!40000 ALTER TABLE `Comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `Comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `FavoriteList`
--

DROP TABLE IF EXISTS `FavoriteList`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FavoriteList` (
  `UserID` int(10) unsigned NOT NULL,
  `MonumentID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`UserID`,`MonumentID`),
  KEY `Monumentzo.FavoriteList.UserID` (`UserID`),
  KEY `Monumentzo.FavoriteList.MonumentID` (`MonumentID`),
  CONSTRAINT `Monumentzo.FavoriteList.UserID` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Monumentzo.FavoriteList.MonumentID` FOREIGN KEY (`MonumentID`) REFERENCES `Monument` (`MonumentID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `FavoriteList`
--

LOCK TABLES `FavoriteList` WRITE;
/*!40000 ALTER TABLE `FavoriteList` DISABLE KEYS */;
/*!40000 ALTER TABLE `FavoriteList` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Image`
--

DROP TABLE IF EXISTS `Image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Image` (
  `ImageID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `MonumentID` int(10) unsigned NOT NULL,
  `Path` varchar(255) NOT NULL,
  PRIMARY KEY (`ImageID`),
  UNIQUE KEY `ImageID_UNIQUE` (`ImageID`),
  UNIQUE KEY `Path_UNIQUE` (`Path`),
  KEY `Monumentzo.Image.MonumentID` (`MonumentID`),
  CONSTRAINT `Monumentzo.Image.MonumentID` FOREIGN KEY (`MonumentID`) REFERENCES `Monument` (`MonumentID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Image`
--

LOCK TABLES `Image` WRITE;
/*!40000 ALTER TABLE `Image` DISABLE KEYS */;
INSERT INTO `Image` VALUES (1,6880,'assets/img/monuments/6880.jpg'),(2,332550,'assets/img/monuments/332550.jpg'),(3,4430,'assets/img/monuments/4430.jpg'),(4,437,'assets/img/monuments/437.jpg'),(5,5989,'assets/img/monuments/5989.jpg'),(6,2249,'assets/img/monuments/2249.jpg'),(7,5941,'assets/img/monuments/5941.jpg'),(8,4158,'assets/img/monuments/4158.jpg'),(9,5499,'assets/img/monuments/5499.jpg'),(10,2975,'assets/img/monuments/2975.jpg'),(11,6107,'assets/img/monuments/6107.jpg'),(12,5680,'assets/img/monuments/5680.jpg'),(13,3991,'assets/img/monuments/3991.jpg'),(15,8165,'assets/img/monuments/8165.jpg'),(16,8247,'assets/img/monuments/8247.jpg'),(17,9015,'assets/img/monuments/9015.jpg'),(18,9244,'assets/img/monuments/9244.jpg'),(19,10305,'assets/img/monuments/10305.jpg'),(20,10235,'assets/img/monuments/10235.jpg'),(21,36653,'assets/img/monuments/36653.jpg'),(22,11872,'assets/img/monuments/11872.jpg'),(23,12029,'assets/img/monuments/12029.jpg'),(24,46887,'assets/img/monuments/46887.jpg'),(25,12572,'assets/img/monuments/12572.jpg'),(26,12556,'assets/img/monuments/12556.jpg'),(27,13417,'assets/img/monuments/13417.jpg'),(28,15211,'assets/img/monuments/15211.jpg'),(29,14985,'assets/img/monuments/14985.jpg'),(30,15669,'assets/img/monuments/15669.jpg'),(31,15724,'assets/img/monuments/15724.jpg'),(32,16083,'assets/img/monuments/16083.jpg'),(33,16722,'assets/img/monuments/16722.jpg'),(34,16868,'assets/img/monuments/16868.jpg'),(35,17220,'assets/img/monuments/17220.jpg'),(36,17490,'assets/img/monuments/17490.jpg'),(37,46627,'assets/img/monuments/46627.jpg'),(38,17517,'assets/img/monuments/17517.jpg'),(39,18113,'assets/img/monuments/18113.jpg'),(40,17998,'assets/img/monuments/17998.jpg'),(41,17604,'assets/img/monuments/17604.jpg'),(42,17651,'assets/img/monuments/17651.jpg'),(43,17733,'assets/img/monuments/17733.jpg'),(44,46628,'assets/img/monuments/46628.jpg'),(45,17650,'assets/img/monuments/17650.jpg'),(46,18415,'assets/img/monuments/18415.jpg'),(47,9292,'assets/img/monuments/9292.jpg'),(48,19043,'assets/img/monuments/19043.jpg'),(49,19918,'assets/img/monuments/19918.jpg'),(50,19938,'assets/img/monuments/19938.jpg'),(51,21229,'assets/img/monuments/21229.jpg'),(52,21879,'assets/img/monuments/21879.jpg'),(53,36806,'assets/img/monuments/36806.jpg'),(54,40410,'assets/img/monuments/40410.jpg'),(55,20129,'assets/img/monuments/20129.jpg'),(56,23110,'assets/img/monuments/23110.jpg'),(57,23601,'assets/img/monuments/23601.jpg'),(58,25131,'assets/img/monuments/25131.jpg'),(59,25653,'assets/img/monuments/25653.jpg'),(60,25479,'assets/img/monuments/25479.jpg'),(61,25759,'assets/img/monuments/25759.jpg'),(62,33753,'assets/img/monuments/33753.jpg'),(63,26265,'assets/img/monuments/26265.jpg'),(64,27700,'assets/img/monuments/27700.jpg'),(65,27997,'assets/img/monuments/27997.jpg'),(66,27454,'assets/img/monuments/27454.jpg'),(67,27168,'assets/img/monuments/27168.jpg'),(68,27382,'assets/img/monuments/27382.jpg'),(69,29376,'assets/img/monuments/29376.jpg'),(70,8826,'assets/img/monuments/8826.jpg'),(71,29949,'assets/img/monuments/29949.jpg'),(72,31938,'assets/img/monuments/31938.jpg'),(73,47014,'assets/img/monuments/47014.jpg'),(74,37847,'assets/img/monuments/37847.jpg'),(75,32582,'assets/img/monuments/32582.jpg'),(76,46869,'assets/img/monuments/46869.jpg'),(77,334003,'assets/img/monuments/334003.jpg'),(78,37113,'assets/img/monuments/37113.jpg'),(79,8564,'assets/img/monuments/8564.jpg'),(80,34571,'assets/img/monuments/34571.jpg'),(81,37457,'assets/img/monuments/37457.jpg'),(82,35490,'assets/img/monuments/35490.jpg'),(83,36075,'assets/img/monuments/36075.jpg'),(84,18329,'assets/img/monuments/18329.jpg'),(85,35973,'assets/img/monuments/35973.jpg'),(86,36784,'assets/img/monuments/36784.jpg'),(87,36786,'assets/img/monuments/36786.jpg'),(88,36769,'assets/img/monuments/36769.jpg'),(89,36934,'assets/img/monuments/36934.jpg'),(90,38446,'assets/img/monuments/38446.jpg'),(91,40726,'assets/img/monuments/40726.jpg'),(92,40849,'assets/img/monuments/40849.jpg'),(93,40750,'assets/img/monuments/40750.jpg'),(94,41195,'assets/img/monuments/41195.jpg'),(95,41788,'assets/img/monuments/41788.jpg');
/*!40000 ALTER TABLE `Image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Monument`
--

DROP TABLE IF EXISTS `Monument`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Monument` (
  `MonumentID` int(10) unsigned NOT NULL,
  `ImageID` int(10) unsigned DEFAULT NULL,
  `Name` text NOT NULL,
  `Description` text,
  `Latitude` float DEFAULT NULL,
  `Longitude` float DEFAULT NULL,
  `City` varchar(45) DEFAULT NULL,
  `Province` varchar(45) DEFAULT NULL,
  `Street` varchar(45) DEFAULT NULL,
  `StreetNumberText` varchar(45) DEFAULT NULL,
  `FoundationDateText` varchar(45) DEFAULT NULL,
  `FoundationYear` int(11) DEFAULT NULL,
  `WikiArticle` text,
  `Vector` text,
  PRIMARY KEY (`MonumentID`),
  UNIQUE KEY `MonumentID_UNIQUE` (`MonumentID`),
  KEY `Monumentzo.Monument.ImageID` (`ImageID`),
  CONSTRAINT `Monumentzo.Monument.ImageID` FOREIGN KEY (`ImageID`) REFERENCES `Image` (`ImageID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Monument`
--

LOCK TABLES `Monument` WRITE;
/*!40000 ALTER TABLE `Monument` DISABLE KEYS */;
INSERT INTO `Monument` VALUES (437,4,'Beurs van Berlage','De Beurs (Beursplein 1-3) kwam in 1898-1903 na een prijsvraag tot stand naar een rationalistisch ontwerp van H.P. Berlage ter plaatse van een daartoe in 1883 gedempt gedeelte van het Damrak en ter vervanging van beursgebouwen uit 1608-\'11 en 1840-\'45. Een hiertoe in 1883 uitgeschreven prijsvraag werd door L.M. Cordonnier gewonnen, maar vanwege een beschuldinging van plagiaat kwam het niet tot uitvoering. Ook pogingen tot renovatie van de oude beurs mislukten, waarna Berlage vanaf 1896 aan een nieuwbouwplan ging werken. Het imposante, langgerekte gebouw wordt geaccentueerd door in hoogte verspringende torenvormige volumes (trappenhuizen). De strakke bakstenen gevels hebben grote vensterreeksen. Zowel uitals inwendig ligt de nadruk op het eerlijk tonen van het bouwmateriaal en de constructie.',52.3746,4.89575,'Amsterdam','Noord-Holland','Beursplein','1-387','1898-1902',1902,'Beurs van Berlage',NULL),(2249,6,'Huis met de Hoofden',NULL,52.3764,4.88736,'Amsterdam','Noord-Holland','Keizersgracht','123',NULL,NULL,'Huis met de Hoofden',NULL),(2975,10,'Trippenhuis','Het classicistische herenhuis Kloveniersburgwal 95 kwam in 1642 tot stand voor Joan Poppen naar plannen van Philips Vingboons. Boven het met hardsteen beklede souterrain hebben de twee bouwlagen een gevelbekleding in zandsteen met kolossale corinthische pilasters. Het middenrisaliet wordt bekroond door een driehoekig fronton. De hoofdingang heeft men in 1904 verplaatst van de bel-etage (met stoep) naar het souterrain. Eveneens ontworpen door Philips Vingboons zijn de classicistische herenhuizen De Star (Kloveniersburgwal 77; 1650), gebouwd voor wolhandelaar Nicolaas Bambeeck, en De Ladder Jacobs (OZ Voorburgwal 316; 1655), gebouwd voor Pieter de Mayer bij diens suikerraffinaderij. Beide huizen worden bekroond door een fronton en hebben dorische pilasters bij de bel-etage en kolossale ionische pilasters bij de verdiepingen. Het vier travee&euml;n brede huis &lsquo;De Star&rsquo; is het resultaat van de samenvoeging van twee even brede bestaande panden. Hierdoor is de ingang uit het midden geplaatst en heeft de gevel tegen de regels in een pilaster in het midden (net als het huis Bartolotti). Tot de latere Vingboons-ontwerpen van herenhuizen met pilastergevels behoren Herengracht 386 (1663-\'65) en Herengracht 412 (1664-\'67). Bij het laatste is de zandstenen voorgevel uitgevoerd door steenhouwer Pieter Pietersz van Kuijck. Het huidige attiek met zoldervensters is begin 19de eeuw toegevoegd. Amsterdam, Herenhuis Kloveniersburgwal 95 Achter dit huis staat een groot tuinhuis in Lodewijk XIV-stijl (circa 1740). Het imposante Trippenhuis (Kloveniersburgwal 29) verrees in 1660-\'62 naar ontwerp van Justus Vingboons als dubbelhuis voor de broers Louis en Hendrick Trip, die in Zweden fortuin hadden gemaakt met ijzer- en kopermijnen, smederijen en geschutsgieterijen. De classicistische pilastergevel heeft boven het hoge en vlakke hardstenen basement (met ingangen) twee met zandsteen beklede verdiepingen en een mezzanino voorzien van gecanneleerde kolossale pilasters met corinthische kapitelen. De gevel is rijk gedecoreerd met ranken, bloemen, festoenen en putti. Het bekronend fronton van het middenrisaliet toont het wapenschild van de familie (drie trippen), omringd door kanonskogels en kanonslopen. De hoekschoorstenen hebben de vorm van mortieren (gereconstrueerd 1890). Het beeldhouwwerk is van Jan Gijseling sr. en Hendrick de Keyser de Jonge. Sinds 1814 huisvest het gebouw het Koninklijk Instituut van Wetenschappen, Letteren en Kunst (nu N.W.O.). Na een verbouwing door stadsbouwmeester Abraham van der Hart (1815-\'17) was een deel van het gebouw geschikt als Rijksmuseum van Schilderijen (collectie in 1885 naar Rijksmuseum). De toen ontstane samenvoeging van de voor- en achterzalen van beide huizen heeft men ongedaan gemaakt bij een restauratie in 1988-\'91. Vanwege de symmetrie van de gevel loopt de scheidingsmuur van de twee huisdelen in afgeschuinde vorm recht op Amsterdam, Trippenhuis het middelste venster aan. Er resteren nog veel originele interieuronderdelen, waaronder in de grote zaal van het linker deel een cassetteplafond met schilderingen van Nicolaas van Helt Stockade. Ook elders in het gebouw zijn plafondschilderingen van hem behouden. In de gangen van de beide delen bevinden zich bovendeurstukken van Allard van Everdingen. Het rechterhuis werd in 1730 in Lodewijk XIV-stijl verbouwd voor Elisabeth van Loon.',52.3712,4.89939,'Amsterdam','Noord-Holland','Kloveniersburgwal','29','1660-1662',1662,NULL,NULL),(3403,NULL,'American hotel','Het American Hotel (Leidseplein 28) werd in 1898-1902 naar ontwerp van W. Kromhout en W.G. Jansen gebouwd in opdracht van A. Volmer ter plaatse van een hotel uit 1879-\'82. Naast een hotel bevat het gebouw ook caf&eacute;-restaurant &lsquo;Americain&rsquo; en op de verdieping een feestzaal. Het in gele baksteen opgetrokken gebouw vertoont rationalistische elementen, jugendstil-details en verwijzingen naar Moorse en Venetiaanse architectuur. De tegeltableaus met voorstellingen van flora en fauna zijn vervaardigd door aardewerkfabriek &lsquo;De Distel&rsquo; naar ontwerp van L. Nienhuis. Kromhout ontwierp ook een deel van de inrichting, zoals de stoelen en de lampen. De gebrandschilderde ramen in de grote caf&eacute;zaal zijn uit de bouwtijd. In 1927-\'28 voegde G.J. Rutgers de vleugel aan de Leidsekade toe (beeldhouwwerk Th. Vos) en kreeg het caf&eacute; een inrichting in art d&eacute;co-stijl (lichtornamenten, J. Eisenloeffel) en zijn er wandschilderingen aangebracht. Er volgden nog een uitbreiding (1954) en een renovatie (1985-\'88). In opdracht van F. Schiller verrees het Hotel Schiller (Rembrandtplein 26-36; 1914-\'15, M.J.E. Lippits en N.H.W. Scholte) in Nieuw Historiserende stijl met neorenaissance- en rationalistische elementen. Op de begane grond bevindt zich het &lsquo;Caf&eacute; Schiller&rsquo;, trefpunt van artistiek Amsterdam. In 1950 heeft men het hotel gemoderniseerd, maar bij een restauratie (1977) is het toen verwijderde jugendstil-interieur van de Schillerbar hersteld. Het forse complex van het Carlton Hotel (Vijzelstraat 2-18; 1925-\'29, G.J. Rutgers) , tegenwoordig &lsquo;Jolly Hotel&rsquo;, vertoont een combinatie van expressionistische en rationalistische vormen. Karakteristiek is de galerij met betonnen pijlers bij de begane grond; de bakstenen gevels erboven zijn versierd met natuurstenen beeldhouwwerk (Th.A. Vos). Hotel IBIS (Stationsplein 49; 1988-\'92, J. Benthem en M. Crouwel) heeft een golvende gevel bestaande uit prefab-elementen met glazen bouwstenen. Uit dezelfde tijd en ontworpen door dezelfde architecten is de naastgelegen ronde kantoortoren.',52.3639,4.88116,'Amsterdam','Noord-Holland','Leidseplein','28-97',NULL,NULL,NULL,NULL),(3991,13,'Oude Kerk: Toren',NULL,52.3744,4.89756,'Amsterdam','Noord-Holland','Oudekerksplein','15','14e eeuw (bouw)',1400,'Oude Kerk (Amsterdam)',NULL),(4158,8,'Scheepvaarthuis','Het Scheepvaarthuis (Prins Hendrikkade 108-114) werd in 1913-\'16 gebouwd als gemeenschappelijk kantoor voor zes Amsterdamse rederijen. De plannen voor de indeling en de betonconstructie van het gebouw waren van J.G. en A.D.N. van Gendt. In samenwerking met M. de Klerk en P.L. Kramer leverde J.M. van der Mey het esthetisch ontwerp, dat met zijn expressionistische vormen een vroeg voorbeeld is van de Amsterdamse School. Op een driehoekig perceel verrees een vierlaags gebouw, met in de scherpe hoek de hoofdingang. Het betonskelet met afwisselend zware en lichte kolommen is bekleed met plastisch vorm gegeven bakstenen gevels. Het Scheepvaarthuis is rijk voorzien van bouwornamenten in smeedijzer, graniet en terracotta, verzorgd door H.A. van den Eijnde, H. Krop en W.C. Brouwer. Verder waren glazenier W. Bogtman en binnenhuisarchitect Th.W. Nieuwenhuis bij het project betrokken. Een uitbreiding kwam tot stand in 1926-\'28 (J.G. en A.D.N. van Gendt en J.M. van der Mey). Vanaf 1983 heeft het gebouw gediend als kantoor van het gemeentevervoerbedrijf, nu zijn er plannen voor de vestiging van een hotel.',52.3745,4.90424,'Amsterdam','Noord-Holland','Prins Hendrikkade','2-114','1911-1916',1916,'Scheepvaarthuis',NULL),(4430,3,'Dubbel huis behorend bij het complex van het deutzenhofje',NULL,52.3627,4.88993,'Amsterdam','Noord-Holland','Prinsengracht','855',NULL,NULL,NULL,NULL),(5499,9,'Huizenblok','De in 1906 erkende co&ouml;peratieve woningbouwvereniging &lsquo;Rochdale&rsquo; was de eerste die woningwetwoningen (zonder alkoven en bedsteden) liet bouwen, zoals de met rationalistische details uitgevoerde woningen Van Beuningenstraat 97-109 (1909, J.E. van der Pek). Andere verenigingen volgden, waaronder de Alg. Woningbouw Vereniging (1910), &lsquo;Eigen Haard&rsquo; (1910), &lsquo;Het Westen&rsquo; (1911) en &lsquo;Het Oosten&rsquo; (1912). Verder waren er de verenigingen &lsquo;Dr. Schaepman&rsquo; (1909; katholiek), &lsquo;Patrimonium&rsquo; (1911; protestant) en &lsquo;De Dageraad&rsquo; (1916; socialistisch). Voor de toenmalige &lsquo;Arbeidersco&ouml;peratie De Dageraad&rsquo; ontwierp J.W.F. Hartkamp samen met H.P. Berlage het woningblok Toldwarsstraat 107 (1907-\'08). Naar plannen van K.P.C. de Bazel kwamen de gesloten woningblokken De Kempenaerstraat e.o. (1914-\'18) en Zaandammerplein e.o. (1918-\'23) tot stand. Deze vallen op door het terugspringen van de hoeken. Kenmerkend is ook de Zaanhof (Zaanstraat 1-134; 1918, H.J.M. Walenkamp) met poortwoningen en gepleisterde gevelzones. Op initiatief van de wethouder voor volkshuisvesting F.M. Wibaut werd in 1915 de Gemeentelijke Woningdienst opgericht met A. Keppler als eerste directeur. Samen met de woningbouwverenigingen probeerde Keppler een programma voor woningwetwoningen van de grond te krijgen in een periode van sterk stijgende bouwkosten (die pas na 1920 weer afnamen). De rijkste uitingen van deze sociale woningbouw zijn uitgevoerd in een plastische expressionistische stijl, die vaak wordt aangeduid als de Amsterdamse School. Het exterieur van het bouwblok werd als &eacute;&eacute;n plastisch geheel gezien in plaats van een voortdurende herhaling van basisvormen. In zijn meest uitbundige vorm is dit zichtbaar bij het zogeheten Derde Blok aan het Spaarndammerplantsoen (1917-\'20), ook wel het &lsquo;Schip&rsquo; genoemd. Dit door M. de Klerk voor &lsquo;Eigen Haard&rsquo;  Amsterdam, Derde Blok Spaarndammerplantsoen ontworpen &lsquo;burchtachtige&rsquo; complex heeft aan de zijde van de Hembrugstraat (nrs. 257-305) een terugspringend gedeelte met plastisch siermetselwerk, tonvormige hoekerkers en als stedenbouwkundig accent een met dakpannen en daktegels beklede toren (gerenoveerd circa 1980). In opdracht van bouwondernemer K. Hille had De Klerk al het Eerste Blok (Spaarndammerplantsoen 68-138; 1913-\'15) getekend, wel gesloten maar nog iets rustiger van karakter. Aan de zuidzijde van het plantsoen verrees in 1915-\'16 voor &lsquo;Eigen Haard&rsquo; het Tweede Blok (Spaarndammerplantsoen 33-103) met opmerkelijk plastische ingangspartijen. Een bijzondere stedenbouwkundige samenhang heeft het in Plan-Zuid voor de &lsquo;De Dageraad&rsquo; in 1919-\'21 gebouwde complex met de P.L. Takstraat als centraal element en aan weerszijden woonblokken aan het Th. Schwartzeplein en het H. Ronnerplein (gerenoveerd 1983). Het ontwerp van M. de Klerk en P.L. Kramer voor dit project heeft als meest opvallende plastische elementen de blokvormig gelede wanden aan de beide pleinen - met schoorstenen en laddervensters als accenten - en de hoekoplossingen met naar boven toe terugwijkende golvende gevelvlakken op de hoeken van de P.L. Takstraat en de Burg. Tellegenstraat. Het beeldhouwwerk is van H. Krop. Aan de noordzijde wordt het complex afgesloten door het Co&ouml;peratiehof (1925-\'28, P.L. Kramer), gebouwd voor &lsquo;Onze Woning&rsquo;. Diverse andere volkswoningbouwprojecten kwamen tot stand naar expressionistische ontwerpen van J.C. van Epen; alle met kenmerkende erkervormige geledingen in de gevel. Zo ontwierp hij voor &lsquo;Rochdale&rsquo; het complex C. Krusemanstraat e.o. (1916-\'26), voor de &lsquo;Algemene Woningbouw Vereniging&rsquo; de blokken Willaertstraat 1-17 (1916-\'22) en Smaragdstraat e.o. (1922-\'24), en voor de &lsquo;Amsterdamse Co&ouml;peratieve Woningbouwvereniging Samenwerking&rsquo; de Harmoniehof e.o. (1919-\'22; in 1920-\'23 aangevuld met enkele dubbele villa\'s). Voor de laatstgenoemde woningbouwvereniging tekende Amsterdam, Tweede Blok Spaarndammerplantsoen J.F. Staal in plastische expressionistische stijl het blok J.M. Coenenstraat e.o. (1922-\'24). Veel traditioneler van vorm zijn ten slotte de huizen Kraaipanstraat e.o. (1920-\'24, J. Gratama en G. Versteeg) met hun kenmerkende &lsquo;open&rsquo; hoekoplossingen met trapgevels.',52.3896,4.87622,'Amsterdam','Noord-Holland','Spaarndammerplantsoen','17-204','1914',1914,NULL,NULL),(5680,12,'Rijksmuseum','Rijksmuseum (Stadhouderskade 42) . Aan de basis van dit gebouw staat de oprichting van een Commissie tot Stichting van een Museum Koning Willem I (1862). De eerste uitgeschreven prijsvraag (1863) leverde geen winnaar op, maar P.J.H. Cuypers werd tweede. Nadat de gemeente Amsterdam in 1873 had toegezegd haar schilderijenverzameling in bruikleen te geven, was er een uitgebreider ontwerp nodig. De daaropvolgende tweede prijsvraag (1875) werd wel gewonnen door Cuypers, die vervolgens &eacute;&eacute;n van zijn twee ingediende plannen uitwerkte tot het huidige gebouw. Dit tussen 1876 en 1885 verwezenlijkte museum kreeg een middenvleugel met onderdoorgang en aan weerszijden twee door vleugels omgeven binnenplaatsen. Aan de zuidwestkant bouwde men een bibliotheekuitbouw met ijzeren galerijen. De binnenplaatsen - voorzien van glazen kappen met vakwerkconstructies (sikkelspanten en trekstaven) - boden onderdak aan gipsafgietsels (westzijde) en de afdeling geschiedenis (oostzijde). Naast de overwelfde zalen van de begane grond werden kopie&euml;n gebouwd van onder meer de crypten van de kerken te Deventer en Maastricht. Op de verdieping richtte men een kopie in van de Aduardkapel. De bel-etage bevat een voorhal, een eregalerij en een Rembrandtzaal. De om de binnenplaatsen lopende enfiladen van zalen zijn aan de voorzijde voorzien van kabinetten.',52.36,4.88505,'Amsterdam','Noord-Holland','Stadhouderskade','1-42','1885',1885,'Rijksmuseum Amsterdam',NULL),(5941,7,'Paleis op de Dam','Het voorm. stadhuis, nu Koninklijk Paleis op de Dam (NZ Voorburgwal 147) werd in 1648-\'65 in classicistische stijl gebouwd naar ontwerp van Jacob van Campen, ter vervanging van het middeleeuwse stadhuis (afgebrand 1652). Dit imposante blokvormige gebouw met twee symmetrisch gesitueerde binnenplaatsen werd in de tijd zelf wel het achtste wereldwonder genoemd. De met zandsteen beklede gevels hebben voor en achter ondiepe hoekrisalieten en een middenrisaliet met rijk versierd fronton. Boven de sokkelvormige begane grond worden de gevels geleed door twee gestapelde kolossale pilasterordes volgens het ordeboek van Scamozzi: romana (composiet) en corinthisch.',52.3732,4.89104,'Amsterdam','Noord-Holland','Nieuwezijds Voorburgwal','147','1648-1665',1665,'Paleis op de Dam',NULL),(5989,5,'Hoofdpostkantoor','Postkantoren. In 1893-\'99 verrees naar ontwerp van rijksbouwmeester C.H. Peters het voorm. hoofdpostkantoor (NZ Voorburgwal 182) in de voor zijn werk zo kenmerkende, op de neogotiek ge&euml;nte, vormen. Dit rijk geornamenteerde, forse drielaagse gebouw is voorzien van een reeks dakerkers en vier torens met peervormige spitsen. Twee torens met opengewerkte spitsen flankeren het ingangsrisaliet. Het gebouw is als warenhuis &lsquo;Magna Plaza&rsquo; in gebruik sinds een verbouwing in 1991-\'92 (H. Ruijssenaars). De centrale hal met galerijen ontvangt licht door een (vernieuwde) lichtkap. Een sober expressionistisch ontwerp is het telefoongebouw (Singel 340; 1917-\'19, G.J. Rutgers en P.L. Marnette) . Dit blokvormig pand heeft een gesloten, met natuursteen beklede, onderbouw en is versierd met beeld-houwwerk (H. Krop) en uitgebreid in 1955 (C. van der Wilk). Het voorm. rijkskantoor voor Geld- en Telefoonbedrijf (NZ Voorburgwal 226; 1924-\'27, J. Crouwel) , nu kantoor van K.P.N. en winkelcentrum, is een zakelijk-expressionistisch gebouw met stalen kozijnen, plat dak, doorlopende overstekken en balkons. Het voorm. stationspostkantoor (Oosterdokskade 5; 1960-\'68, P.J. Elling en B. Merkelbach) is opgetrokken met een betonskelet en bekleed met kalkzandsteen. Het bestaat uit een hoog rechthoekig bouwdeel (pakketpost en administratie) en een in 2004 gesloopt haaks ingestoken laag bouwdeel met betonnen schaaldaken (briefpost). Een deel van het gebouw dient momenteel als tijdelijke huisvesting van het Stedelijk Museum.',52.3739,4.89022,'Amsterdam','Noord-Holland','Nieuwezijds Voorburgwal','137-182','1895-1888',1888,NULL,NULL),(6107,11,'Ons\' Lieve Heer op Solder','De voorm. R.K. schuilkerk Ons\' Lieve Heer op Solder (OZ Voorburgwal 40) , gewijd aan St. Nicolaas, is een van de weinige nog resterende katholieke huiskerken in Amsterdam. Een in oorsprong 16de-eeuws pand ter plaatse werd in 1655 gekocht door metselaar Willem Jacobsz van der Gaffel en timmerman-houtkoper Gijsbert Cruijf en vervolgens vermoedelijk geheel vernieuwd tot een voorhuis met twee achterhuizen. Jan Hartman kocht dit pand in 1661 en liet het in 1661-\'63 verbouwen tot een winkel met kantoor. In het achtergedeelte werd een representatieve zaal in classicistische stijl ingericht met een marmeren schouw en een beschilderd cassetteplafond. Op de tweede en derde verdieping liet hij de kerkzaal met omlopende dubbele galerij inrichten. In 1737 werden de zaal en de kerkruimte ingrijpend verbouwd door priester Ludovicus Reiniers. Begin 19de eeuw heeft men de halsgevel aan de voorzijde veranderd in een puntgevel. De parochie is in 1887 verhuisd naar de St.-Nicolaaskerk en sinds 1888 bevat het pand het Museum Amstelkring (gerestaureerd 1919, 1939 en 1965). Tot de oude kerkinventaris behoren een barok hoofdaltaar, een preekstoel (eerste helft 18de eeuw), vier altaarstukken (1670-1750) en een door Hendrik Meijer gebouwd orgel (1794).',52.3751,4.89935,'Amsterdam','Noord-Holland','Oudezijds Voorburgwal','40',NULL,NULL,'Museum Ons\' Lieve Heer op Solder',NULL),(6880,1,'Sint-Bavokerk',NULL,51.2729,3.44851,'Aardenburg','Zeeland','Sint Bavostraat','5','ca. 1220',1220,'Sint-Bavokerk (Aardenburg)',NULL),(8165,15,'Paleis Het Loo','Het Honinklijk paleis Het Loo of het Nieuwe Loo (Koninklijk Park 1) werd in 1685-\'86 in opdracht van stadhouder Willem III gebouwd in classicistische vormen naar plannen van Jacob Roman. In die tijd kwam het centrale, vierkante corps de logis tot stand, waarvan het middenrisaliet is voorzien van een fronton en een klok (Gerhard Schimmel, 1686). Aan weerszijden van de voorhof verrezen langgerekte zijvleugels, die oorspronkelijk met kwartronde colonnades waren verbonden met het corps de logis. Haaks op de zijvleugels werden dienstvleugels met hoekpaviljoens gebouwd. Nadat Willem III in 1689 ook koning van Engeland was geworden, liet hij in 1691-\'94 vier nieuwe paviljoens optrekken tussen het corps de logis en de zijvleugels. Daarin werden onder meer een nieuwe eetzaal, een schilderijengalerij en een kapel ondergebracht. De colonnades werden verplaatst om te dienen als afsluiting van de boventuin. Toen het paleis in 1807-\'09 als zomerverblijf werd ingericht voor Lodewijk Napoleon heeft men het geheel gepleisterd. Koning Willem III liet in 1875 aan de oostzijde een aanbouw met kunstzaal optrekken. Bij een verbouwing in 1911-\'14, naar plannen van rijksbouwmeester C.H. Peters, verhoogde men het hoofdgebouw en de paviljoens met een lage verdieping. In 1977-\'84 werd naar plannen van J.B. baron van Asbeck een ingrijpende reconstructie uitgevoerd van de toestand rond 1700, waarbij het gebouw werd ontpleisterd. Het paleis kreeg een museale functie.',52.2338,5.94547,'Apeldoorn','Gelderland','Koninklijk Park','1','1685-\'86',1686,'Paleis Het Loo',NULL),(8247,16,'Nicolaïkerk','De Herv. kerk (Wijkstraat 32) , oorspronkelijk gewijd aan St.-Nicolaas, is een driebeukige hallenkerk met vijfzijdig gesloten koor en vrijstaande toren. In het begin van de 13de eeuw werd een eenbeukige kerk met westtoren gebouwd ter plaatse van een aan Maria gewijde voorganger. Kort na het midden van die eeuw volgden de bouw van een dwarsschip en een recht gesloten koor, waardoor een romano-gotische kruiskerk ontstond. De topgevels zijn in de 17de eeuw verdwenen. In het begin van de 14de eeuw verlengde men het koor met een vijfzijdig gesloten, gotisch deel. In het derde kwart van de 15de eeuw kwam de huidige hallenkerk tot stand door de bouw van een noord- en een zuidbeuk. Kort daarna werd bij het koor de zuidkapel (Jozefkapel) gebouwd. De noordkapel (Mariakapel), met de aangebouwde  Appingedam, Herv. kerk en stadhuis, plattegrond sacristie en op de verdieping mogelijk een librije, kwam in het begin van de 16de eeuw tot stand. Rond dezelfde tijd sloopte men de oude westtoren. De kerk werd volgens een gevelsteen in 1561 hersteld, in 1594 van binnen wit gekalkt en in 1686 opnieuw hersteld na stormschade. Bij een restauratie in 1948-\'54 naar plannen van A.R. Wittop Koning, R. Offringa en G. Bosma is onder meer de kapconstructie vernieuwd.',53.3199,6.85766,'Appingedam','Groningen','Wijkstraat','32','begin 13e eeuw',1300,'Nicolaïkerk (Appingedam)',NULL),(8564,79,'Paleis Soestdijk','Paleis Soestdijk (Amsterdamsestraatweg 1), een breed, wit gepleisterd gebouw met gebogen vleugels, diende verschillende stadhouders, prinsen en vorsten van het huis van Oranje tot (zomer)residentie. Omstreeks 1650 liet de Amsterdammer Cornelis de Graeff een huis met hofstede bouwen. Na diens dood kocht stadhouder Willem III het landhuis, waarna hij het in de jaren 1674-\'78 liet verbouwen tot jachtslot. Het ontwerp werd geleverd door stadhouderlijk architect Maurits Post. Het oude gebouw werd aan de achterzijde met een grote zaal en aan weerszijden met een vleugel vergroot. In de Franse tijd werd het door Lodewijk Napoleon geconfisceerd. Hij gaf J.Th. Thibault opdracht tot uitbreiding. In 1815 schonk de Staat het pand aan kroonprins Willem, de latere koning Willem II, wegens zijn verdiensten tijdens de slag bij Quatre Bras. In de periode 1816 tot 1822 werd het paleis op \'s lands kosten verbouwd en vergroot in neoclassicistische stijl, naar ontwerp van Jan de Greef en Zeger Reijers. Het bestaande gebouw werd wit gepleisterd en voorzien van een rond bordes en een hardstenen ingangspartij met balkon. Ook de vensters werden gemoderniseerd. De in het midden naar binnen buigende attiek, die oorspronkelijk alleen het middendeel bekroonde, werd nu over het gehele gebouw doorgetrokken. Op het dak werd met gebruikmaking van de oude schoorstenen een rechthoekig belv&eacute;d&egrave;re geconstrueerd. Aan weerszijden ontstonden nieuwe vertrekken met daarop aansluitend kwart-ronde vleugels tussen paviljoens. De vleugels met dorische zuilen waren oorspronkelijk open maar zijn later met glas gesloten. Inwendig verbouwde men onder meer de grote zaal tot een lagere zaal in empire-stijl met rijk gestucte lijsten en cassettentongewelf. Twee kamers in het oude gedeelte rechts van de hoofdingang werden samengetrokken en in 1819 door J.W. Pieneman voorzien van een schildering voorstellende &lsquo;De prins van Oranje bij Quatre Bras 16 juni 1815&rsquo;. In 1937 is het paleis onder leiding van J. de Bie Leuveling Tjeenk en A.J. van der Steur inwendig gemoderniseerd.',52.1961,5.27702,'Soestdijk','Utrecht','Amsterdamsestraatweg','1','1650',1650,'Paleis Soestdijk',NULL),(8826,70,'Boerderij De Eenhoorn','Boerderijen. De boerderijen in de Beemster, in de regel stolpboerderijen, zijn veelal gebouwd in baksteen of baksteen en hout. Enkele boerderijen zijn geheel in hout opgetrokken. Het rijkste voorbeeld is boerderij De Eenhoorn (Middenweg 196), waarvan het deels onderkelderde bakstenen woongedeelte een hoger opgetrokken middenpartij met classicistische halsgevel heeft. Deze wordt bekroond door een segmentvormig fronton met daarop het beeld van een eenhoorn; een cartouche vermeldt als bouwjaar 1682. In de melkkelder bevindt zich een betegelde schouw. Bij de boerderij Lepelaar (Middenweg 194) heeft de middenpartij van het bakstenen woongedeelte een schoudergevel met vazen en bekronend fronton. Gevelstenen tonen een lepelaar en het jaartal 1683. De opkamer bevat een betegelde wand en op het houtwerk geschilderde voorstellingen van engeltjes en ploegende boeren. In oorsprong 17de-eeuws is ook de boerderij Tijdverdrijf (Middenweg 50) bij Noordbeemster met darsdeuren aan de voorzijde. De in de 19de eeuw gepleisterde gevel is in de top gedateerd 1667.',52.5333,4.90299,'Middenbeemster','Noord-Holland','Middenweg','196','1682 (cartouche)',1682,'De Eenhoorn (boerderij)',NULL),(9015,17,'Tusschenlanen',NULL,51.9381,4.78866,'Bergambacht','Zuid-Holland','Tussenlanen','11-13','1661',1661,'Tusschenlanen',NULL),(9244,18,'Markiezenhof','Het Markiezenhof (Steenbergsestraat 6-8) is een van de belangrijkste voorbeelden van laat-middeleeuwse stedelijke wooncultuur in Nederland. De basis voor dit stadspaleis zal in het midden van de 14de eeuw zijn gelegd. Het eerste complex bestond uit een zaalgebouw met dwarsvleugel, traptoren en keuken ten noorden van de Grebbe. Door de aankoop van een perceel ten zuiden van die waterloop werd verdere uitbreiding van het complex in de eerste helft van de 15de eeuw mogelijk, waarbij de Grebbe werd overkluisd.',51.4958,4.28471,'Bergen op Zoom','Noord-Brabant','Steenbergsestraat','6-8',NULL,NULL,'Markiezenhof',NULL),(9292,47,'De Volharding',NULL,51.9016,6.26256,'Zeddam','Gelderland','Vinkwijkseweg','13','1891',1891,'De Volharding (Zeddam)',NULL),(10235,20,'Het Kasteel','De Trip van Zoudtlandtkazerne (De la Reystraat 95/Lovensedijkstraat 10) uit 1910-\'14, is opgezet voor de cavalerie. In de oorspronkelijke opzet had het twaalf eenlaags paviljoens. Opmerkelijk zijn de twee hoofdgebouwen (A en B) aan de app&egrave;lplaats en de voorm. paardenstallen, alle uit 1913. In 1922-\'24 werd het complex uitgebreid met vijf paviljoens in aangepaste stijl. Scholen. De voorm. Hogere Burger School (Kasteelplein 10) heeft de vorm van een monumentaal eclectisch blokvormig herenhuis uit 1867. Sinds 1901 is het onderdeel van de Koninklijke Militaire Academie. Het R.K. Onze-Lieve-Vrouw-Lyceum (Paul Windhausenweg 11) uit 1918-\'19 is gebouwd in de stijl van het kubistisch expressionisme. Het heeft een zeer markante, op de hoek gelegen ingang. De entreehal en het trappenhuis hebben art deco-elementen. Het geheel staat onder sterke invloed van de vormentaal van K.P.C. de Bazel. In 1952-\'53 voegde men naar ontwerp van J. Bunnik de tweede verdieping toe. De Beeldenaar (Keizerstraat 1), een schoolgebouw voor Lager Onderwijs, verrees in 1920 in de stijl van het kubistisch expressionisme, naar ontwerp van de dienst Openbare Werken. Lagere School De Kastanjeboom (Boeimeersingel 14-14A) uit 1934 toont invloeden van Dudok. Het werd ontworpen door F. Verwoerd en J. Temme. Het Prins Willem I-paviljoen is een onderwijsgebouw van de K.M.A. Breda, Hofhuizen aan de Catharinastraat (nrs. 18-28), situatie circa 1550 en circa 1950 (Kasteelplein 10) uit 1938-\'42, gebouwd in de trant van de Delftse School.',51.5914,4.7746,'Breda','Noord-Brabant','Kasteelplein','10',NULL,NULL,'Kasteel van Breda',NULL),(10305,19,'Grote of Onze-Lieve-Vrouwekerk',NULL,51.5889,4.77547,'Breda','Noord-Brabant','Kerkplein','2',NULL,NULL,'Grote of Onze-Lieve-Vrouwekerk',NULL),(11872,22,'Nieuwe Kerk','De (Herv.) Nieuwe of St.-Ursulakerk (Markt 80) is een driebeukige basilicale kruiskerk met kooromgang, doopkapel en een zeer rijzige toren. Op de plaats van een miraculeuze verschijning van de H. Maagd werd in 1381 een kleine houten kerk gesticht. In baksteen verrezen in 1383-\'90 ten oosten daarvan een dwarsschip en koor, waarvan alleen het dwarsschip over is met inwendig aanzetten voor - waarschijnlijk nooit uitgevoerde - stenen gewelven. In 1412 begon de bouw van een basilicaal schip met schijntriforium en op de zijbeuken aansluitende reeksen zijkapellen. Nadat in 1420 de houten noodkerk was weggebroken, kwam dit gotische schip in 1435 gereed. Onder leiding van Utrechtse Dombouwmeester Jacob van der Borch begon men in 1453 met de bouw van een gotische kooromgang met sacristie (en daarboven een librije). De sloop van het oude koor volgde in 1465. Op de fundamenten plaatste men natuurstenen zuilen met koolbladkapitelen om de door speklagen versierde koorlantaarn te dragen (inwendig met vensterbanktriforium). De kap en het houten tongewelf waren in 1471 gereed en nadat de stenen gewelven in de kooromgang waren geslagen, volgde in 1476 de wijding van het nieuwe koor. De lage kluis (met tralieramen) aan de zuidzijde is laat-15de-eeuws en in die tijd werd ook de vloer van het dwarsschip opgehoogd, waardoor de basementen van de vieringpijlers uit het zicht verdwenen. Rond 1485 trok men de zuiderzijbeuk langs de toren westwaarts door en aansluitend verrees daar een driezijdig gesloten doopkapel. Het noordtransept werd in 1510 uitgebreid met een Mariakapel. Anthonis Keldermans was ook betrokken bij de in navolging van de Oude Kerk geplande verlenging van het zuidtransept; maar dat werk kwam in 1512 niet verder dan de fundering. Na de kerkbrand van 1536 heeft men in 1540-\'49 de stenen gewelven en de scheidingen tussen de kapellen weggebroken en zijn de huidige zeer brede zijbeuken met houten tongewelven ontstaan. De portalen aan zuid- en noordzijde werden in 1546 en 1549 hersteld of vernieuwd; het torenportaal volgde in 1556. Herstellingen aan de kerk vonden verder plaats in 1655 (na de buskruitramp) en in 1837-\'41.',52.0123,4.3608,'Delft','Zuid-Holland','Markt','80','1396-1496 (toren)',1496,'Nieuwe Kerk (Delft)',NULL),(12029,23,'Prinsenhof',NULL,52.0126,4.35494,'Delft','Zuid-Holland','Oude Delft','1-185','ca. 1400 (gesticht)',1400,'Prinsenhof (Delft)',NULL),(12556,26,'Stadhuis',NULL,52.2514,6.15578,'Deventer','Overijssel','Grote Kerkhof','4',NULL,NULL,NULL,NULL),(12572,25,'Grote of St. Lebuïnuskerk','De (Herv.) Grote of St.-Lebu&iuml;nuskerk (Grote Kerkhof 42) is een ruime laatgotische hallenkerk met kooromgang en een romaanse crypte; de forse toren heeft twee geledingen en een achtkantige lantaarn. Noch van het kerkje dat omstreeks 770 door Lebu&iuml;nus werd gesticht, noch van de beide kerkjes van kort na 775 en na 881 zijn sporen teruggevonden. De kern van het huidige gebouw is een zeer grote vroegromaanse kapittelkerk die kort na 1046 door de Utrechtse bisschop Bernold werd gesticht. Deze niet-overwelfde basiliek - geheel gebouwd in tufsteen - kwam in &eacute;&eacute;n bouwfase tot stand. Ze bestond uit een oostelijk dwarsschip en koor met een gedeeltelijk verzonken crypte, waarboven een hoogkoor was, aan beide zijden geflankeerd door een zijkoor. Aan de westzijde bevond zich eveneens een dwarsschip met daartegen aangebouwd een westwerk bestaande uit twee romaanse westtorens, aan beide zijden geflankeerd door lagere traptorens. Tussen beide torens zal zich een lage ingangshal hebben bevonden, waarboven een ruimte was met uitzicht op het schip. Tijdens opgravingen in 1961-\'62 zijn hiervan de funderingen blootgelegd. Over de juiste reconstructie van dit westwerk verschillen de meningen en dat geldt ook voor de interpretatie van de functie, waarbij vergelijkingen zijn gemaakt met zowel de Dom van Verdun als de St.-Gertrudiskerk te Nijvel. Het basilicale schip zou naar de huidige inzichten oorspronkelijk een indeling hebben gekend met zes scheibogen ondersteund door vijf rode zandstenen zuilen, zoals die nu nog te vinden zijn in de eveneens door Bernold gestichte kleinere, maar verder zeer vergelijkbare, St.-Pieterskerk te Utrecht. Meer is bekend over de lichtbeuk, waarvan resten boven de huidige gewelven bewaard zijn gebleven en op grond waarvan aan beide zijden acht rondboogvensters gereconstrueerd kunnen worden. Ook de noordwand van het westelijke dwarsschip, waarin zich een toegang naar het bisschopshof bevond, de bijbehorende oostelijke kruispijlers, evenals de noordwand van het oostelijke dwarsschip en de vier kruispijlers zijn bewaard gebleven. Het veruit belangrijkste 11de-eeuwse restant is evenwel de crypte. De ribloze kruisgewelven van de crypte worden gedragen door twee rijen van elk drie zuilen. De zuilen hebben teerlingkapitelen en spiraalvormig gegroefde of geschubde schachten uit Nivelsteiner zandsteen. De absis van de crypte, waarin een 11de-eeuws venster zit, is inwendig halfrond en uitwendig driezijdig gesloten. Toegang tot de crypte had men vanuit de lage zijkoren, waarvan de vloerhoogte ongeveer overeenkomt met het bordes van de huidige toegangstrap. In de crypte bevindt zich nog een put die in verbinding staat met de IJssel, enkele nissen en een later altaar. De muurschilderingen in de crypte, met een voorstelling van de vier aartsengelen die de Arma Christi dragen, stammen uit de 15de eeuw en mogelijk van kort na 1468.',52.252,6.15522,'Deventer','Overijssel','Grote Kerkhof','42',NULL,NULL,'Grote of Lebuïnuskerk',NULL),(13417,27,'Grote Kerk','De (Herv.) Grote of O.L.-Vrouwekerk (Grotekerksplein 8) is een forse driebeukige basilicale kruiskerk met kapellen langs schip en koor (zuidzijde), een kooromgang met vijf straalkapellen, een Mariakoor (noordzijde) en een westtoren. Van de koorsluiting van een tufstenen voorganger zijn restanten 12de-eeuws muurwerk aangetroffen in het huidige koor. Bij deze eerste parochiekerk werd een Mariakoor (gewijd 1285) opgetrokken, mogelijk kleiner van omvang dan het huidige. Vanaf de 14de eeuw werd de kerk in fasen herbouwd en uitgebreid. Na de verheffing tot kapittelkerk in 1366 begon men met de bouw van een groter koor en de vernieuwing van het Mariakoor, dat siermotieven in gesinterde baksteen kreeg. Begin 15de werd er gewerkt aan transept en schip.',51.8142,4.66062,'Dordrecht','Zuid-Holland','Grotekerksplein','8','middeleeuwen',NULL,'Grote of Onze-Lieve-Vrouwekerk (Dordrecht)',NULL),(14985,29,'Stadhuis','Het stadhuis (Breedstraat 53) is een imposant tweelaags gebouw met mezzanino, bekronend attiekstuk en een omlopend schilddak met hoekschoorstenen en een achtzijdige houten koepeltoren. De voorgevel met balkon en hoekrisalieten is in Bentheimer zandsteen uitgevoerd. Dit in de strakke stijl van het classicisme uitgevoerde stadhuis kwam in 1686-\'94 tot stand naar plannen van Steven Vennecool ter vervanging van een voorganger uit 1460. De beelden op de attiek (Wijs Beleid en Eendrachtig Bestuur) en de stedenmaagden aan weerszijden van het balkon zijn gemaakt door Pieter van der Plasse. Een cartouche boven het balkon meldt het devies van Enkhuizen: &lsquo;Candide et Constanter&rsquo; (oprecht en standvastig). Het v&oacute;&oacute;r de voorgevel opgestelde kanon (1551) werd in 1622 buitgemaakt op Duinkerker kapers; het verhaal daarvan staat op een gevelbord met gesneden omlijsting (1661; gedicht Joost van den Vondel). Binnen leidt de lage Blauwe Zaal (hardstenen vloer) via een trap naar de ruime en hoge Witte Zaal of Burgerzaal (met marmeren vloer), die in spaarvelden is voorzien van grisailles (Dirck Ferreris). Verder heeft deze ruimte zes armvormige houten luchters. De toegang tot de Burgemeesterskamer is een houten dorisch poortje met bovendeurstuk &lsquo;Triomf van de Vrede&rsquo; (Ferreris). Een geschilderd behangsel toont een allegorie op het Romeinse bestuur (1707, gerestaureerd 1903), ontworpen door Romeyn de Hooghe en uitgevoerd door diens leerlingen. Verder zijn hier een plafondschildering voorstellend &lsquo;Kracht en Liefde&rsquo; (Ferreris) en een schouw met een kort na 1801 aangebracht 17de-eeuws schoorsteenstuk met als thema Charitas (Theodoor van Tulden). De Vroedschapskamer heeft een wandbekleding van rode velours d\'Utrecht. De drie plafondschilderingen (paalkistrecht, Gerechtigheid en visvangst) zijn evenals het schoorsteenstuk (Wijsheid) gemaakt door Ferreris. Ook de Schepenkamer (nu trouwzaal) heeft een (groene) velours d\'Utrecht-bekleding (gerestaureerd 1902). Wederom van Ferreris zijn de plafondschildering (Rede en Waarheid) en het schoorsteenstuk (Justitia). De Weeskamer bevat een marmeren schoorsteenmantel in Lodewijk XV-vormen (Asmus Frauen), een schoorsteenstuk uit 1692 (Barmhartigheid; Johan van Neck) en wandtapijten met arcadische landschappen en allegorische verwijzingen naar de verzorging van wezen (1710, Alexander Baert). Twee andere vertrekken hebben elk nog een schoorsteenstuk van Johan van Neck. De voorm. stadsgevangenis (Zwaanstraat ong.) , gelegen op korte afstand achter het stadhuis, is een rijzig diep pand met drie bouwlagen en per laag twee ruime houten cellen. De onderste cellen dateren uit 1592. Een ophoging volgde in 1610 en er zijn verbouwingen uitgevoerd 1908, 1955 en 1988-\'91.',52.7041,5.29479,'Enkhuizen','Noord-Holland','Breedstraat','53','1688',1688,'Stadhuis van Enkhuizen',NULL),(15211,28,'Nederlands Hervormde Gomarus- of Westerkerk','De (Herv.) St.-Gomarus- of Westerkerk (Westerstraat 138) is een op een omheind kerkhof gelegen driebeukige hallenkerk. De drie beuken hebben samen &eacute;&eacute;n enkele driezijdige sluiting met op de knikken kleine traptorens. De bouw van de laat-gotische zuidbeuk begon in 1470, waarna de twee andere beuken volgden in 1471 en 1480. In het oostelijke deel rusten de scheibogen op zuilen van afwisselend Bentheimersteen en Ledesteen. De in een topgevel gevatte oostelijke eindvensters van de zijbeuken steken door de daklijst heen. In 1488-\'92 kwam een - uitwendig niet als zodanig herkenbaar - dwarsschip tot stand met zuilen van Ledesteen. In een derde fase verrezen in 1512-\'19 de vier westelijke schiptravee&euml;n met zuilen van Bentheimer steen. De zijbeuken kregen bij de westgevel geveltoppen met een hoog middenvenster geflankeerd door gotische blindnissen. De doopkapel bij de zuidwesthoek is korte tijd later toegevoegd.',52.7034,5.2871,'Enkhuizen','Noord-Holland','Westerstraat','138',NULL,NULL,'Westerkerk (Enkhuizen)',NULL),(15669,30,'Planetarium Eise Eisinga, planetarium','Het planetarium (Eise Eisingastraat 3) is gehuisvest in een eenlaagspand met klokgevel uit 1768. In 1774-\'81 bracht de sterrenkundige Eise Eisinga hier in de woonkamer een schaalmodel van het zonnestelsel aan tegen een blauw geschilderd houten plafond. De mechanische aandrijving van het model bevindt zich op zolder. Het huis is nu een museum.',53.1875,5.54379,'Franeker','Friesland','Eise Eisingastraat','3','1774-1781',1781,'Planetarium Eise Eisinga',NULL),(15724,31,'Raadhuis',NULL,53.1871,5.54334,'Franeker','Friesland','Raadhuisplein','1-5','1591-\'94 (voorbouw)',1594,'Stadhuis van Franeker',NULL),(16083,32,'Stoomgemaal Mastenbroek',NULL,52.6009,6.01949,'Genemuiden','Overijssel','Kamperzeedijk','7','1855-1856',1856,'Stoomgemaal Mastenbroek',NULL),(16722,33,'Grote of Sint-Janskerk',NULL,52.0108,4.71157,'Gouda','Zuid-Holland','Achter de Kerk','1','1622',1622,'Grote of Sint-Janskerk (Gouda)',NULL),(16868,34,'De vier gekroonden',NULL,52.0115,4.70885,'Gouda','Zuid-Holland','Naaierstraat','6','eerste kwart 16e eeuw',1600,'De vier gekroonden',NULL),(17220,35,'Hampoort',NULL,51.7575,5.73875,'Grave','Noord-Brabant','St.Elisabethstraat','10','1688',1688,'Hampoort',NULL),(17490,36,'Fors pand gebouwd voor de Graaf de Nogelles, met zandstenen middenrisaliet, waar',NULL,52.0792,4.31041,'\'s-Gravenhage','Zuid-Holland','Buitenhof','37','derde kwart 17e eeuw',1700,NULL,NULL),(17517,38,'Huis ten Bosch',NULL,52.0931,4.3432,'\'s-Gravenhage','Zuid-Holland','\'s-Gravenhaagse Bos','10','1645 en volgende jaren; verbouwd 1734-1737',1734,'Paleis Huis ten Bosch',NULL),(17604,41,'Oud-Kath. Kerk v.d. H. Augustinus','De (Oud Kath.) H.H. Jacobus en Augustinuskerk (Juffrouw Idastraat 7a) werd in 1720-\'22 gebouwd als schuilkerk. Het als sobere herenhuisgevel opgebouwde front heeft een omlijste ingang met een portret van Augustinus. Het vermoedelijk door Dani&euml;l Marot ontworpen interieur is uitgevoerd onder leiding van Nicolaas \'s-Gravenhage, Portugees-Isr. synagoge Kruysselbergen en heeft rijk stucwerk in Lodewijk XIV-vormen bij het koofplafond en de wanden met corinthische pilasters. Tot de oorspronkelijke inventaris, grotendeels vervaardigd door Jan Baptist Xavery, behoren een communiebank, een preekstoel (1729) en een wit marmeren doopvont. Verder bevat de kerk een rijk gesneden hoogaltaar met een altaarstuk van Matheus Terwesten (1733) en een door Rudolf Garrels gebouwd orgel (1726; gerestaureerd 1994-\'95). De bijbehorende voorm. pastorie (Juffrouw Idastraat 13), met 17de-eeuwse kern en zolderkerk, is grotendeels vernieuwd in 1949-\'50.',52.0794,4.30618,'\'s-Gravenhage','Zuid-Holland','Juffrouw Idastraat','7','1722 (interieur)',1722,NULL,NULL),(17650,45,'Mauritshuis','Het Mauritshuis (Korte Vijverberg 8) kwam tussen 1633 en 1644 tot stand voor Johan Maurits van Nassau-Siegen, die in 1636-\'44 gouverneur was in Brazili&euml; voor de West-Indische Compagnie. Het door natuurstenen kolossale ionische pilasters gelede blokvormige gebouw is een vroeg ontwerp in classicistische stijl van Jacob van Campen. Bij de uitwerking assisteerde Pieter Post. De timpanen van frontons bij de geheel met natuursteen beklede middentravee&euml;n aan voor- en achterzijde tonen respectievelijk het wapen van de bouwheer en een door beeldhouwer Pieter Adriaensz \'t Hooft in reli&euml;f vervaardigd strijdtafereel. Het gebouw brandde in 1704 geheel uit. Bij het herstel in 1708-\'16, onder leiding van Gijsbert Blotelingh (tot zijn dood in 1713), werden de kruisvensters verwijderd en de borstweringen bij de vensters van de bel-etage verlaagd.',52.0804,4.3143,'\'s-Gravenhage','Zuid-Holland','Korte Vijverberg','8','1636',1636,'Mauritshuis',NULL),(17651,42,'Teresia van Avilakerk',NULL,52.0753,4.3058,'\'s-Gravenhage','Zuid-Holland','Westeinde','12-245','1839-1841',1841,NULL,NULL),(17733,43,'Huis Schuylenburch',NULL,52.0809,4.31135,'\'s-Gravenhage','Zuid-Holland','Lange Vijverberg','8','1715',1715,NULL,NULL),(17998,40,'Nieuwe Kerk','De voorm. (Herv.) Nieuwe Kerk (Spui 175) is een compact gebouw met driezijdig gesloten korte zijden en twee driezijdig gesloten apsiden bij de lange zijden. Deze fraaie classicistische kerk met opengewerkte daktoren, zandstenen hoekpilasters en grote vazen met draperie&euml;n op de hoeken kwam in 1649-\'56 tot stand naar plannen van Pieter Arentsz Noorwits en Bartholomeus van Bassen. Het ingangsportaal aan de oostzijde is voorzien van wapens en het jaartal 1658. In de daktoren hangen twee door Coenraet Anthonisz gegoten klokken (1656). De kerk is hersteld in 1881-\'85 en 1950-\'53 (daktoren). Bij een ingrijpende restauratie in 1970-\'77, onder leiding van Ph.J.W.C. Bolt en E.A. Canneman, heeft men de kerk ten behoeve van het gebruik voor algemene culturele doeleinden onderkelderd met een nieuwe foyer. De aanbouwen in het midden van de lange zijden, oorspronkelijk dienend als consistorie en hofloge, zijn in de loop van de tijd naar buiten uitgebouwd en weer herbouwd in de oude vorm met hergebruik van frontons en klauwstukken.',52.0764,4.31596,'\'s-Gravenhage','Zuid-Holland','Spui','175','1649-1656',1656,'Nieuwe Kerk (Den Haag)',NULL),(18113,39,'Panorama Mesdag','Het Panorama Mesdag (Zeestraat 65b-c) werd in 1880-\'81 ingericht voor het tonen van een op rondlopend doek geschilderd panorama van het dorp Scheveningen, vervaardigd door H.W. Mesdag in samenwerking met zijn vrouw S. Mesdag-van Houten, G.H. Breitner, Th. de Bock, B.J. Blommers en de Belgische architectuurschilder A. Nijberck. De tentoonstellingsruimte is een veertienzijdige centraalbouw, die men van onderaf bereikt. De ingangspartij aan de Zeestraat werd ontworpen door G. Klomp. De tussenliggende lange gang heeft men in 1910-\'11 vervangen door een zalengalerij voor schilderijen van de Haagse School. Voor zijn eigen schilderijencollectie liet Mesdag in 1886-\'87 het Museum Mesdag (Laan van Meerdervoort 7) bouwen naar een eclectisch ontwerp van aannemer-architect H. van Jaarsveld (gerestaureerd 1990-\'96). Van het naastgelegen - al in 1869-\'70 voor hem gebouwde - dubbele herenhuis Laan van Meerdervoort 9-11 bewoonde Mesdag zelf het rechterdeel (verhoogd 1919).',52.0847,4.30328,'\'s-Gravenhage','Zuid-Holland','Zeestraat','65','1881',1881,'Panorama Mesdag',NULL),(18329,84,'Rietveld Schröderhuis',NULL,52.0853,5.14753,'Utrecht','Utrecht','Prins Hendriklaan','50','1924',1924,'Rietveld Schröderhuis',NULL),(18415,46,'Korenbeurs','De voorm. Korenbeurs (Akerkhof 1) , gebouwd in 1863-\'65 naar ontwerp van stadsbouwmeester J.G. van Beusekom, is in feite de derde korenbeurs ter plaatse. De eerste (houten) beurs verrees in 1774, de tweede in 1826. Het voorgebouw, met zuilenportiek, is uitgevoerd in neoclassicistische stijl. Beelden aan weerszijden van de ingang en op het fronton symboliseren de pijlers van de Groninger welvaart: scheepvaart (Neptunus), landbouw (Ceres) en handel (Mercurius). De zinken beelden zijn vervaardigd door de firma L.J. Enthoven &amp; Co. uit Den Haag. De erachter gelegen, halfrond gesloten beurshal heeft een driebeukige opzet en een bijzondere gietijzeren draagconstructie met veel glas, voor de bij het keuren noodzakelijke lichtinval. Het ijzerwerk werd geleverd door de Groninger IJzer- en Metaalgieterij. Het in 1990-\'91 naar plannen van architectenbureau C. Kalfsbeek gerenoveerde beursgebouw heeft tegenwoordig voornamelijk een horeca-functie.',53.2168,6.56359,'Groningen','Groningen','Akerkhof','1','1862-\'65',1865,'Korenbeurs (Groningen)',NULL),(19043,48,'Paviljoen Welgelegen','Paviljoen Welgelegen (Dreef 3) . De uit Schotland afkomstige koopman-bankier Henry Hope liet dit L-vormige neoclassicistische buitenhuis in 1786-\'89 bouwen ter plaatse van de door hem in 1769 gekochte hofstede Welgelegen. Het ontwerp is waarschijnlijk van Michel Triquetti, marineconsul van Sardini&euml;, en de bouw werd geleid door Jean Baptiste Dubois. Dit buiten werd in 1808 door koning Lodewijk Napoleon in gebruik genomen (tot 1810) en later door koning Willem I ter beschikking gesteld van zijn moeder, de prinses douairi&egrave;re Frederika Sophia Wilhelmina. Vanaf 1838 herbergde het enkele musea, waaronder vanaf 1871 de koloniale collectie van de Nederlandse Maatschappij tot bevordering van Nijverheid (in 1926 naar Amsterdam overgebracht). Sinds 1930 is hier het provinciehuis van Noord-Holland gevestigd (gerestaureerd circa 1989).',52.372,4.63039,'Haarlem','Noord-Holland','Dreef','3','1785/8',1785,'Paviljoen Welgelegen',NULL),(19918,49,'Gemaal De Cruquius',NULL,52.3382,4.63813,'Cruquius','Noord-Holland','Cruquiusdijk','27','1849',1849,'Gemaal De Cruquius',NULL),(19938,50,'Bisdom van Vliet','Huis Bisdom van Vliet (Hoogstraat 166). Dit zeer forse tweelaags pand in eclectische vormen werd in 1874-\'77 gebouwd in opdracht van Marcellus Bisdom van Vliet (&dagger; 1877) ter plaatse van een 18de-eeuwse voorganger. De rijk uitgevoerde gevel risaleert asymmetrisch maar heeft in het midden een ingangspartij met segmentvormig fronton. Een mezzanino en kroonlijst met gesneden koppen als consoles dragen de attiek. De weelderige stucwerkdecoraties in het interieur zijn naar ontwerp van F.P.C Schild en uitgevoerd door Th. Hooft en C. Straver. De dochter P.M. Lef&egrave;vre de Montigny-Bisdom van Vliet legateerde het huis bij haar overlijden in 1923 als museum aan de Stichting Bisdom van Vliet.',52.0012,4.77125,'Haastrecht','Zuid-Holland','Hoogstraat','166','derde kwart 19e eeuw',1900,'Museum Bisdom van Vliet',NULL),(20129,55,'Hervormde Kerk IJsselstein','De Herv. kerk (Kronenburgplantsoen 2), oorspronkelijk St.-Nicolaaskerk, is in 1309 door Gijsbrecht van IJsselstein gesticht als parochiekerk en werd in 1397 kapittelkerk. Het is een ruime, laat-gotische kruiskerk met pseudo-basilicaal schip, een koor met omgang en een westtoren in vroege renaissance-stijl, voorzien van een bekroning in de stijl van de Amsterdamse School. Waarschijnlijk vanwege de verwoesting van de stad in 1466 heeft men de kerk volledig herbouwd; ze dateert in hoofdzaak uit het einde van de 15de eeuw. Waarschijnlijk kort na 1500 is de kooromgang nog veranderd. In het begin van de jaren dertig van de 16de eeuw verrees de toren. In 1911 brandden toren en kerk geheel uit. Het herstel van de kerk, onder leiding van J.F.L. Frowein, voltooide men in 1916; de toren werd pas in 1925-\'28 hersteld.',52.021,5.04528,'IJsselstein','Utrecht','Kronenburgplantsoen','2','1310-1923',1923,'Hervormde Kerk IJsselstein',NULL),(21229,51,'Schachtgebouw Oranje Nassau I',NULL,50.8921,5.97262,'Heerlen','Limburg','Kloosterweg','1','ca. 1897',1897,NULL,NULL),(21879,52,'Sint-Janskathedraal',NULL,51.6881,5.30844,'\'s-Hertogenbosch','Noord-Brabant','Torenstraat','6',NULL,NULL,'Sint-Janskathedraal (\'s-Hertogenbosch)',NULL),(23110,56,'Stadhuis van Kampen','Van het stadhuis (Oudestraat 133) bestaat het oudste deel uit een rijzig laat-gotisch bouwdeel met zadeldak tussen rijk versierde puntgevels met nissengeleding, pinakels en arkeltorentjes met ingesnoerde spits. Beide topgevels hebben een gedraaide toppinakel, die tevens als schoorsteenkanaal dient. De topgevel aan de zuidzijde is door een latere aanbouw grotendeels uit het zicht geraakt; hier bevindt zich nog wel een zonnewijzer uit 1615. Aan de oostzijde staat de Schepentoren, met een vierkante onderbouw, een omgang met kantelen en een achtzijdige bovenbouw bekroond met een zandstenen balustrade en een opengewerkte uivormige spits. Het gebouw gaat terug tot het midden van de 14de eeuw, maar na een felle brand in 1543 heeft men bij het herstel renaissance-elementen aan het gebouw toegevoegd. Van dit herstel dateren onder meer de overkragende, opengewerkte balustrade langs de dakranden en de balustrade van de Schepentoren. Twee verdiepingsvensters, het ene aan de voorzijde en het andere aan de achterzijde, hebben gesmede vensterkorven. Het gebouw heeft een souterrain met kruisgewelven. De bel-etage was vroeger toegankelijk via een bordestrap en deur in het midden van de voorgevel, maar deze zijn weggehaald bij de laat-19de-eeuwse restauratie. Naar plannen van P.J.H. Cuypers werden in 1894-1901 de noord- en de westgevel en in 1913-\'15 de oostgevel en de Schepentoren aangepakt. De 15de-eeuwse beelden van de voorgevel verving men in 1933-\'38 door nieuwe exemplaren van J. Polet. Net als de voorgangers stellen zij voor: Karel de Grote, Alexander de Grote, de Matigheid, de Trouw, de Gerechtigheid en de Barmhartigheid. De baldakijnen boven de beelden dateren van de restauratie. Boven het houten gewelf van de Schepenzaal werd in 1940 ter versterking een betonkap aangebracht. Aan dat gewelf en de kapconstructie daarboven, alsmede aan de balustrade van de voorgevel Kampen, Stadhuis, Schepenzaal en de spits van de Schepentoren zijn omstreeks 1979 nog restauratiewerkzaamheden uitgevoerd. In de toren hangt een klok uit 1499.',52.5588,5.91664,'Kampen','Overijssel','Oudestraat','133','1345-1350',1350,'Stadhuis van Kampen',NULL),(23601,57,'Abdijkerk Rolduc',NULL,50.8683,6.08173,'Kerkrade','Limburg','Heyendallaan','82','12e eeuw (bouw)',1200,NULL,NULL),(25131,58,'St. Annahof. St. Anna Aalmoeshuis',NULL,52.1569,4.4962,'Leiden','Zuid-Holland','Middelstegracht','1-13','1509 (gewijd)',1509,'Sint Annahofje',NULL),(25479,60,'Bibliotheca Thysiana','De Bibliotheca Thysiana (Rapenburg 25) , gebouwd in 1655 naar ontwerp van Arent van \'s-Gravesande, heeft een classicistische gevel met zandstenen ingangspoortje en op de verdieping een zandstenen ionische pilasterstelling en houten kruisvensters. Bij de bouw waren ook Willem van der Helm, Jan Jansz Pety en Willem Wijmoth betrokken. Deze &lsquo;tot publycke dienst der studie&rsquo; bestemde bibliotheek werd verwezenlijkt met een legaat van de geleerde Johannes Thysius (&dagger; 1653). De via een dubbele bordestrap en steektrap vanuit het voorhuis bereikbare bibliotheekzaal op de verdieping bevat nog de inrichting uit de bouwtijd met boekenkasten, een archiefkast, een leestafel en een boekenmolen.',52.1588,4.48479,'Leiden','Zuid-Holland','Rapenburg','25','1654-1655',1655,'Bibliotheca Thysiana',NULL),(25653,59,'d\'Heesterboom','Pakhuizen. In de 17de eeuw hadden veel huizen tevens een opslag- of pakhuisfunctie, zoals te zien is bij Hooigracht 5-7 en Herengracht 82. Rond 1650 geheel als pakhuis gebouwd is Oude Rijn 90 (met trapgevel). Het Graanmagazijn der Armen (Oude Rijn 44-46) werd in 1754 (gevelsteen) gebouwd als een dubbel pakhuis ter plaatse van het 15de-eeuwse Huiszittenhuis. Het links aangrenzende pand Oude Rijn 42 diende tot 1870 als broodbakkerij. In 1988 heeft men het complex verbouwd tot studentenhuisvesting. Een vergelijkbare brede afgeknotte topgevel als Oude Rijn 44 bezit het tot woonhuis verbouwde pakhuis Nieuwstraat 31a (circa 1700). Uit het midden van de 19de eeuw dateren de in sobere neoclassicistische vormen gebouwde pakhuizen Oude Rijn 36, met in de kroonlijst een olifantje op een console, en Lange Mare 60. Het pakhuis Nieuwstraat 43 uit 1863 heeft drie pakhuisdeuren boven elkaar. Het voorm. pakhuis Nieuwe Rijn 71 (circa 1870) kreeg gepleisterde lisenen en daklijst in de stijl van J.W. Schaap en het voorm. graanpakhuis Nieuwstraat 32 (circa 1875) is uitgevoerd in eclectische stijl. Iets jonger is het pakhuis Oude Rijn 89 uit 1904. Windmolens. In 1743 verrees op het Grote of Rijnsburgerbolwerk - ter plaatse van een voorganger uit 1667 - de korenmolen De Valk (2de Binnenvest-gracht 1) , een hoge ronde stellingmolen met een met dakleer beklede kap (gerestaureerd 1996). Als houtzaagmolen ingericht zijn de molens De Heesterboom (Haagweg 57) uit 1804 (gerestaureerd 1994) en De Herder (Haarlemmerweg 80), die in 1884 vanuit Amsterdam naar hier is overgebracht. Beide zijn stellingmolens met een houten onderbouw, een met riet gedekte achtzijdige romp en twee lage houten zijvleugels. Windmolen De Put (1ste Binnenvestgracht 11) is een replica uit 1987 van een gesloten houten standerdmolen uit 1640 van Jan Jansz de Put.',52.1567,4.47253,'Leiden','Zuid-Holland','Haagweg','57','1856 / 1981 ',1981,'d\'Heesterboom',NULL),(25759,61,'Lemsterschutsluis',NULL,52.8423,5.71039,'Lemmer','Friesland','Binnenhaven','4','1887-\'88',1888,'Lemstersluis',NULL),(26265,63,'Petrus en Pauluskerk','De Herv. kerk (Kerkpad 1), oorspronkelijk gewijd aan St. Petrus en St. Paulus, is een grote kruiskerk met vijfzijdig gesloten koor, zijkapellen en een forse toren van drie geledingen met zadeldak. Nadat een brand in 1217 de eerste kerk had verwoest, verrees een eenbeukige romaanse tufstenen kerk met recht gesloten koor. Van de oudste kerk zijn nog enkele muurdelen bewaard gebleven, waaronder een laag venster. In het derde kwart van de 13de eeuw verhoogde men het schip en verving men het bestaande koor door een dwarsschip met nieuw koor; van deze bouwfase resteren de beide dwarsarmen met hun meloenvormige koepelgewelven. De noordelijke topgevel is in later tijd verdwenen, de zuidelijke topgevel is aan het eind van de 15de eeuw vernieuwd. In de tweede helft van de 14de eeuw verrees de forse toren, die even breed is als het schip en onderaan bijna drie meter dikke muren heeft. De toren werd in 1610 hersteld. In de toren hangen twee klokken, uit 1397 en uit 1548; de laatste is gegoten door Geert van Wou (II).',53.332,6.74793,'Loppersum','Groningen','Kerkpad','8','na 1217',1217,'Petrus en Pauluskerk (Loppersum)',NULL),(27168,67,'Sint-Servaasbasiliek','De R.K. St.-Servaasbasiliek (Keizer Karelplein 6) is een imposante, grotendeels in kolenzandsteen opgetrokken, driebeukige kruisbasiliek voorzien van een rond gesloten koorpartij met twee slanke koortorens van vijf geledingen met tentdak. Verder heeft de kerk kapellenreeksen aan de noord- en de zuidzijde van het schip, een groot portaal met voorhal aan de zuidwestzijde en een zeer fors westwerk met twee torens voorzien van een bekroning met houten lantaarn en spits met frontalen.',50.8493,5.68668,'Maastricht','Limburg','Keizer Karelplein','6','Vanaf 11e eeuw',1100,'Sint-Servaasbasiliek (Maastricht)',NULL),(27382,68,'Stadhuis van Maastricht','Het stadhuis (Markt 78) is een groot vrijstaand, vierkant bouwwerk met hoog souterrain en hardstenen gevels, gebouwd in 1659-\'64 voor de huisvesting van het Luikse en Brabantse Hooggerecht en het Laaggerecht. In de tweelaags onderbouw werden de vet-, mouten korenwaag, de wijnkelder, de gevangenis, de stadstimmerwerf en enkele wachtlokalen ondergebracht. Het oorspronkelijke classicistische ontwerp van Pieter Post is bij de uitvoering onder leiding van stadsbouwmeester Cornelis Pesser deels gewijzigd. De achter- en zijgevels hebben pilasters bij de middenpartijen, de voorgevel heeft pilasterstellingen met dorische pilasters bij de beletage en ionische pilasters bij de verdieping. De entree bestaat uit een monumentale trappartij met groot portiek en bordes. De verhoogde middengevel wordt bekroond door een fronton met stadsengel en stadswapen en geflankeerd door beelden van Mars en Minerva. De midden op het dak geplaatste klokkentoren werd in 1684 voltooid onder leiding van Adam Wijnandts. Hierin hangt een carillon met 17 klokken van Francois Hemony (1663-\'64), waaraan bij de restauratie in 1962 nog 11 klokken van Van den Gheijn (1767-\'69) en 15 nieuwe klokken zijn toegevoegd. In 1839 zijn de vensterkruizen vervangen door empireramen. Bij een verbouwing in 1861 heeft men de forse hoekschoorstenen verwijderd en het binnendakschild van het omlopend schilddak opgetrokken tot de torenvoet, waardoor de ronde vensters in de onderliggende koepel geen licht meer ontvangen.',50.8507,5.69045,'Maastricht','Limburg','Markt','78','1659/1664 - 1684',1664,'Stadhuis van Maastricht',NULL),(27454,66,'Onze-Lieve-Vrouwebasiliek','De R.K.O.L.-Vrouwebasiliek (O.L.-Vrouweplein 9) is een grotendeels in kolenzandsteen opgetrokken driebeukige, basilicale kruiskerk voorzien van een rond gesloten kooromgang met galerij. Het koor wordt geflankeerd door twee gedrongen torens voorzien van een stenen spits met frontalen en twee rond gesloten zijkapellen van het transept. Verder heeft de kerk twee pseudotransepten en een zeer hoog en massief westwerk tussen twee ronde traptorens met spits.',50.8473,5.69371,'Maastricht','Limburg','Onze Lieve Vrouweplein','9','Vanaf 11e eeuw',1100,'Basiliek van Onze-Lieve-Vrouw-Tenhemelopneming (Maastricht)',NULL),(27700,64,'Spaans Gouvernement nu Museum aan het Vrijthof','Het voorm. Spaans Gouvernement (Vrijthof 18) , nu Museum Spaans Gouvernement, kwam voort uit het huis van Johannes Fraybart, kanunnik van het St.-Servaaskapittel. Hij schonk het pand in 1333 aan de Brabantse hertog Jan III. Hertogin Johanna stond het in 1397 af aan het Servaaskapittel als behuizing voor de proost onder beding dat haar opvolgers hier bij hun bezoeken aan de stad konden verblijven. Ter gelegenheid van het verblijf van keizer Karel V in 1520 werd het rechter deel van de oorspronkelijk in vakwerk uitgevoerde verdieping in mergelsteen herbouwd en voorzien van drie laat-gotische vensters. De boogvelden zijn versierd met de keizerskroon, gekroonde Herculeszuilen en een banderol met de keizerlijke spreuk &lsquo;Plus Oultre&rsquo; (Nog Verder); het middenvenster is gedecoreerd met de Habsburgse adelaar met op de borst het gedeelde wapen van Habsburg en Castili&euml;. Tekststenen tussen de vensters verwijzen naar Philips de Schone, de vader van Karel V. Voor het bezoek van de keizer en zijn zuster, landvoogdes Maria van Hongarije, in 1545-\'46, kreeg de gevel aan de binnenplaats een arcade in vroege renaissance-stijl met vijf rondbogen op balusterzuilen, voorzien van kapitelen met gestileerde maskers en monsterdieren. Bij de doorgang werd een triomfboogversiering aangebracht met medaillonportretten van Karel V en Maria van Hongarije. Het kleine, beschadigde medaillon in het midden stelt vermoedelijk Philips II voor, die in 1550 enige tijd in het gebouw verbleef.',50.8484,5.68877,'Maastricht','Limburg','Vrijthof','18','eerste helft 16e eeuw e.v.',1600,'Spaans Gouvernement',NULL),(27997,65,'Helpoort',NULL,50.8456,5.69452,'Maastricht','Limburg','N.v.t.',NULL,'1229',1229,'Helpoort (Maastricht)',NULL),(29376,69,'Oostkerk',NULL,51.5027,3.62063,'Middelburg','Zeeland','Oostkerkplein','1',NULL,NULL,NULL,NULL),(29949,71,'Boerderij aan de Zandstraat 5',NULL,51.5532,5.21266,'Moergestel','Noord-Brabant','Zandstraat','5','vroeg 19e eeuw',1900,'Zandstraat 5',NULL),(31938,72,'Basiliek van de H.H. Agatha en Barbara',NULL,51.5895,4.5289,'Oudenbosch','Noord-Brabant','Markt','57',NULL,NULL,'Basiliek van de H.H. Agatha en Barbara',NULL),(32582,75,'Munsterkerk',NULL,51.1933,5.98925,'Roermond','Limburg','Abdijhof','1',NULL,NULL,'Munsterkerk',NULL),(33753,62,'Voormalige parochiekerk','De oude R.K. St.-Salviuskerk (Platz 2) is een tweebeukige kerk met vijfzijdig gesloten koor en een toren van drie geledingen met ingesnoerde spits. Het oudste gedeelte is de deels in maaskeien opgetrokken 11de-eeuwse noordmuur met een (dichtgemetseld) romaans poortje. Ook het koor heeft enkele 11de-eeuwse muurdelen van maaskeien maar is rond 1250 grotendeels in mergelsteen opgetrokken in laat-romaanse stijl, met boogfriezen en driepasbogen bij de vensters. De bijbehorende sporenkap is bewaard gebleven. De mergelstenen toren verrees rond 1450. In het eerste kwart van de 16de eeuw werd de grotendeels in mergel uitgevoerde zuidbeuk toegevoegd en werd de westgevel vernieuwd. Nicolaas van Breyll liet in 1651 beide beuken verhogen en de bakstenen trapgevels aan de koorzijde optrekken. De twee mergelstenen cartouches in de zuidelijke trapgevel tonen de wapens van Nicolaas van Breyll en pastoor Nicolaus Nagel. Bij het koor zijn restanten te zien van twee ingekraste middeleeuwse zonnewijzers. Tijdens de exterieurrestauratie in 1953-\'54, onder leiding van F.P.J. Peutz, zijn enkele aanbouwen verwijderd, zoals de sacristie uit 1817 tegen het koor.',51.0157,5.83884,'Limbricht','Limburg','Platz','2','13e eeuw (koor)',1300,NULL,NULL),(34571,80,'Rams Woerthe',NULL,52.7854,6.11236,'Steenwijk','Overijssel','Gasthuislaan','2','1898-\'99',1899,'Rams Woerthe',NULL),(35490,82,'Abdijkerk',NULL,51.1606,5.84198,'Thorn','Limburg','Hoogstraat','5','14e eeuw (krocht) ',1400,'Abdijkerk (Thorn)',NULL),(35973,85,'Domkerk, sacristie en librie',NULL,52.0908,5.12243,'Utrecht','Utrecht','Achter de Dom','1','1254-1517',1517,'Dom van Utrecht',NULL),(36075,83,'Domtoren',NULL,52.0906,5.12141,'Utrecht','Utrecht','Domplein','21','1321-1382',1382,'Dom van Utrecht',NULL),(36653,21,'Vakwerkhoeve bestaande uit een woonhuis met verdieping en tentdak, opgetrokken m',NULL,50.7611,5.94535,'Cottessen','Limburg','Cottessen','5','1500',1500,'Cottessen 5',NULL),(36769,88,'Kasteel Valkenburg op de Heunsberg','Kasteel Valkenburg (Grendelplein 13) is een indrukwekkende burchtru&iuml;ne op driehoekige plattegrond, gelegen op de Heunsberg. Thibalt van Voeren liet hier rond 1087 een eerste versterking aanleggen in de vorm van een rechthoekige donjon, waarvan de bouw rond 1115 werd voortgezet door zijn opvolger Gosewijn I van Heinsberg. Deze donjon werd al in 1122 verwoest en vervolgens rond 1170 herbouwd in een zestienhoekige vorm. Na de verwoesting van dit bouwwerk in 1214 volgde de bouw van een kleinere tienhoekige don-jon. Toen verrees ook een oostvleugel ter plaatse van de huidige onderbouw van de ridderzaal. De derde donjon maakte in de tweede helft van de 13de eeuw plaats voor een zuidvleugel in opdracht van Diederik II van Kleef of zijn zoon Walram. Gelijktijdig begon men met het uithakken van de dwingel (Van Meijlandstraat) - een verdedigbare toegangsweg - waardoor men de Heunsberg van het plateau van Margraten scheidde wat de hoogteburcht beter verdedigbaar maakte. Toch werd de burcht in 1329 opnieuw verwoest. Deze werd door Diederik IV in gotische stijl herbouwd tot een fors L-vormig complex met een kleine traptoren in de binnenhoek, een ridderzaal (oostzijde) en een kapel (noordzijde). Verdere uitbreidingen en versterkingen volgden in de 15de eeuw; zo werd de dwingel in 1464-\'65 verder uitgediept. Mogelijk ontstonden toen ook de - in 1937 ontdekte - onderaardse gangen die in de Fluwelen Grot uitkomen.',50.8619,5.8319,'Valkenburg','Limburg','Grendelplein','13','14e-15e eeuw (muurgedeelten)',1500,'Kasteel Valkenburg',NULL),(36784,86,'Kruitmolen / De Leeuw (brouwerij)',NULL,50.8658,5.82243,'Valkenburg','Limburg','Plenkertstraat','88-90','1819',1819,'Kruitmolen (Valkenburg)',NULL),(36786,87,'Station',NULL,50.8692,5.83269,'Valkenburg','Limburg','Stationsstraat','10','1853',1853,'Station Valkenburg',NULL),(36806,53,'Sint-Martinuskerk, nu kapel verzorgingshuis Vroenhof',NULL,50.8753,5.7823,'Houthem','Limburg','Vroenhof','87','1785 (koor)',1785,NULL,NULL),(36934,89,'Stadhuis',NULL,51.549,3.66765,'Veere','Zeeland','Markt','5','1474',1474,'Stadhuis van Veere',NULL),(37113,78,'Vinkenbaan 14: Woonhuis op L-vormige grondslag met verdieping en plat afgedekt o',NULL,52.4194,4.62882,'Santpoort-Zuid','Noord-Holland','Vinkenbaan','14','1911',1911,'Vinkenbaan 14',NULL),(37457,81,'Klooster Ter Apel',NULL,52.876,7.07516,'Ter Apel','Groningen','Boslaan','3','1464 (stichting)',1464,'Klooster Ter Apel',NULL),(37847,74,'Fort Rammekens',NULL,51.4529,3.65353,'Ritthem','Zeeland','N.v.t.',NULL,'1547-1556',1556,'Fort Rammekens',NULL),(38446,90,'Sint-Martinuskerk',NULL,51.2536,5.70679,'Weert','Limburg','Markt','8','1456 ',1456,'Sint-Martinuskerk (Weert)',NULL),(40410,54,'Villa Henny',NULL,52.1095,5.24077,'Huis ter Heide','Utrecht','Amersfoortseweg','11','1914-1916',1916,'Villa Henny',NULL),(40726,91,'Huizen onder een zadeldak; langsgevel aan de straat, met gezamenlijke 18e-eeuwse',NULL,51.6502,3.91903,'Zierikzee','Zeeland','Meelstraat','1-3','17e-18e eeuw',1800,'Huis De Haan',NULL),(40750,93,'Raadhuis',NULL,51.6503,3.91888,'Zierikzee','Zeeland','Meelstraat','8','16e eeuw',1600,'Stadhuis (Zierikzee)',NULL),(40849,92,'Noordhavenpoort',NULL,51.6479,3.92626,'Zierikzee','Zeeland','Noordhavenpoort','2','14e eeuw (oorsprong)',1400,'Noordhavenpoort',NULL),(41195,94,'Walburgiskerk',NULL,52.1396,6.19572,'Zutphen','Gelderland','\'s Gravenhof','3',NULL,NULL,'Walburgiskerk (Zutphen)',NULL),(41788,95,'Sassenpoort',NULL,52.5099,6.09554,'Zwolle','Overijssel','Sassenstraat','51','verm. 1409',1409,'Sassenpoort',NULL),(46627,37,'Winkelpassage',NULL,52.0784,4.31029,'\'s-Gravenhage','Zuid-Holland','Achterom','4-82','1882-1885 (bouw)',1885,NULL,NULL),(46628,44,'Nirwana-flat',NULL,52.0923,4.32956,'\'s-Gravenhage','Zuid-Holland','Benoordenhoutseweg','227','1927-1929',1929,'Nirwana-flat',NULL),(46869,76,'Van Nellefabriek','De voorm. Van Nellefabriek (Van Nelleweg 1) , het bekendste Nederlandse voorbeeld van een functionalistisch fabrieksgebouw, kwam in 1925-\'30 tot stand naar ontwerp van L.C. van der Vlugt (en J.A. Brinkman) in opdracht van directeur C.H. van der Leeuw. Op basis van het toenmalige fabricageproces ontstond een complex met fabrieksdelen voor tabak (achtlaags), koffie (vijflaags) en thee (drielaags) en aan de voorzijde een concaaf kantoorgebouw met haakse vleugel. Luchtbruggen verbinden het kantoorgebouw en het pakhuis aan de Schie-zijde met de tabaksfabriek, die wordt bekroond door een rond uitzichtspaviljoen. De gebouwen hebben betonvloeren op betonnen paddestoelkolommen en vliesgevels met stroken van smalle stalen ramen. Voor de constructie was J.G. Wiebenga verantwoordelijk en bij de tuinaanleg was M. Ruys betrokken. Uitbreidingen volgden in 1942-\'43 en 1967. Na de verkoop in 1998 is de fabriek verbouwd tot bedrijfsverzamelgebouw.',51.9229,4.4347,'Rotterdam','Zuid-Holland','Van Nelleweg','1','1925-1930',1930,'Van Nellefabriek',NULL),(46887,24,'Agnetapark, arbeiderskolonie met in kleine blokjes gegroepeerde woningen, elk vo',NULL,52.0156,4.34654,'Delft','Zuid-Holland','Frederik Matthesstraat','1-50','1890',1890,'Agnetapark',NULL),(47014,73,'De Meesterkok',NULL,51.9813,6.79396,'Winterswijk','Gelderland','Moezebrinkweg','2','laat 16e eeuw',1600,'De Meesterkok E 96',NULL),(47067,NULL,'Zeeuwse hoeve aan de Binnendijk 3',NULL,51.4709,3.66836,'Middelburg','Zeeland','Binnendijk','3','1676',1676,'Binnendijk 3',NULL),(332550,2,'Kasteel Amerongen','Kasteel Amerongen (Drostestraat 20) is een vrijwel vierkant bouwwerk uit 1674-\'80. Gelegen in de uiterwaarden van de Nederrijn wordt het terrein afgesloten door een kade. Binnen die kade wordt het huis omringd door een binnen- en een buitengracht. Het staat op de plaats van een in 1286 door Borre en Diederic van Amerongen gesticht kasteel, dat door de Fransen in 1673 werd verwoest. Godard van Reede en zijn vrouw Margaretha Turnor lieten in 1673 het huidige huis bouwen op de oude fundamenten en een deel van het muurwerk van de zuidwesttoren. De architect is niet bekend. Meester-timmerman Hendrick Geurtsz. Schut moet als uitvoerend bouwmeester worden beschouwd.',51.9954,5.45853,'Amerongen','Utrecht','Drostestraat','20','1674-1679',1679,'Kasteel Amerongen',NULL),(334003,77,'Witte Huis',NULL,51.9188,4.49181,'Rotterdam','Zuid-Holland','Wijnhaven','1-3','1897-1898',1898,'Witte Huis (Rotterdam)',NULL);
/*!40000 ALTER TABLE `Monument` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Monument_Category`
--

DROP TABLE IF EXISTS `Monument_Category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Monument_Category` (
  `MonumentID` int(10) unsigned NOT NULL,
  `CategoryID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`MonumentID`,`CategoryID`),
  KEY `Monumentzo.Monument_Category.MonumentID` (`MonumentID`),
  KEY `Monumentzo.Monument_Category.CategoryID` (`CategoryID`),
  CONSTRAINT `Monumentzo.Monument_Category.MonumentID` FOREIGN KEY (`MonumentID`) REFERENCES `Monument` (`MonumentID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Monumentzo.Monument_Category.CategoryID` FOREIGN KEY (`CategoryID`) REFERENCES `Category` (`CategoryID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Monument_Category`
--

LOCK TABLES `Monument_Category` WRITE;
/*!40000 ALTER TABLE `Monument_Category` DISABLE KEYS */;
/*!40000 ALTER TABLE `Monument_Category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Monument_TextTag`
--

DROP TABLE IF EXISTS `Monument_TextTag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Monument_TextTag` (
  `MonumentID` int(10) unsigned NOT NULL,
  `TextTagID` int(10) unsigned NOT NULL,
  `TermFrequencyInverseDocumentFrequency` double DEFAULT NULL,
  `TermFrequency` double DEFAULT NULL,
  PRIMARY KEY (`MonumentID`,`TextTagID`),
  KEY `Monumentzo.Monument_TextTag.MonumentID` (`MonumentID`),
  KEY `Monumentzo.Monument_TextTag.TextTag` (`TextTagID`),
  CONSTRAINT `Monumentzo.Monument_TextTag.MonumentID` FOREIGN KEY (`MonumentID`) REFERENCES `Monument` (`MonumentID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Monumentzo.Monument_TextTag.TextTag` FOREIGN KEY (`TextTagID`) REFERENCES `TextTag` (`TextTagID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Monument_TextTag`
--

LOCK TABLES `Monument_TextTag` WRITE;
/*!40000 ALTER TABLE `Monument_TextTag` DISABLE KEYS */;
/*!40000 ALTER TABLE `Monument_TextTag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ReadList`
--

DROP TABLE IF EXISTS `ReadList`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ReadList` (
  `UserID` int(10) unsigned NOT NULL,
  `Book` text NOT NULL,
  PRIMARY KEY (`UserID`),
  KEY `Monumentzo.ReadList.UserID` (`UserID`),
  CONSTRAINT `Monumentzo.ReadList.UserID` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ReadList`
--

LOCK TABLES `ReadList` WRITE;
/*!40000 ALTER TABLE `ReadList` DISABLE KEYS */;
/*!40000 ALTER TABLE `ReadList` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Role`
--

DROP TABLE IF EXISTS `Role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Role` (
  `RoleID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) NOT NULL,
  `Description` varchar(255) NOT NULL,
  PRIMARY KEY (`RoleID`),
  UNIQUE KEY `Name_UNIQUE` (`Name`),
  UNIQUE KEY `RoleID_UNIQUE` (`RoleID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Role`
--

LOCK TABLES `Role` WRITE;
/*!40000 ALTER TABLE `Role` DISABLE KEYS */;
INSERT INTO `Role` VALUES (1,'login','This is required to log the fuck in :D');
/*!40000 ALTER TABLE `Role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SimilarImage`
--

DROP TABLE IF EXISTS `SimilarImage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SimilarImage` (
  `ImageID` int(10) unsigned NOT NULL,
  `SimilarImageID` int(10) unsigned NOT NULL,
  `Similarity` float DEFAULT NULL,
  KEY `Monumentzo.Image_Image.ImageID` (`ImageID`),
  KEY `Monumentzo.Image_Image.SimilarImageID` (`SimilarImageID`),
  CONSTRAINT `Monumentzo.Image_Image.ImageID` FOREIGN KEY (`ImageID`) REFERENCES `Image` (`ImageID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Monumentzo.Image_Image.SimilarImageID` FOREIGN KEY (`SimilarImageID`) REFERENCES `Image` (`ImageID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SimilarImage`
--

LOCK TABLES `SimilarImage` WRITE;
/*!40000 ALTER TABLE `SimilarImage` DISABLE KEYS */;
INSERT INTO `SimilarImage` VALUES (1,93,0.13119),(1,52,0.126871),(1,57,0.117933),(1,51,0.115346),(2,49,0.171003),(2,15,0.16249),(4,7,0.103176),(7,46,0.231228),(7,72,0.183719),(7,57,0.133652),(8,77,0.226277),(8,66,0.165966),(8,67,0.119799),(9,3,0.171991),(9,19,0.125467),(9,27,0.120054),(10,80,0.248378),(10,24,0.153241),(10,17,0.146154),(12,15,0.270019),(12,40,0.152022),(12,49,0.143747),(12,68,0.122061),(12,44,0.119567),(13,68,0.142551),(13,57,0.103975),(15,12,0.254603),(15,49,0.1849),(15,40,0.157192),(16,12,0.204368),(16,15,0.193884),(16,44,0.161682),(17,92,0.308085),(17,36,0.166894),(17,10,0.15818),(18,83,0.302696),(18,72,0.132382),(19,9,0.176992),(19,58,0.152011),(19,23,0.114086),(19,27,0.109158),(20,76,0.214498),(20,35,0.102128),(22,89,0.415021),(22,68,0.186403),(22,47,0.138819),(22,94,0.126238),(23,95,0.150239),(23,36,0.145624),(23,80,0.117539),(24,73,0.201415),(24,67,0.107651),(25,88,0.155465),(25,13,0.127329),(25,56,0.11315),(26,45,0.137989),(27,10,0.126141),(27,9,0.108912),(28,35,0.127805),(28,50,0.115391),(28,88,0.114539),(30,55,0.136789),(31,57,0.293217),(31,72,0.138359),(31,75,0.111017),(32,89,0.258974),(32,22,0.22418),(32,40,0.155669),(32,15,0.107483),(32,68,0.100962),(34,2,0.157102),(34,24,0.1055),(35,15,0.175502),(35,12,0.14158),(35,76,0.126951),(35,46,0.109092),(35,40,0.102278),(36,81,0.18283),(36,17,0.151031),(37,91,0.279735),(37,11,0.138959),(38,48,0.189305),(38,87,0.165543),(38,78,0.130687),(39,26,0.102024),(40,15,0.19021),(40,12,0.168036),(40,68,0.143083),(41,63,0.174668),(41,82,0.167988),(41,73,0.131695),(42,44,0.112788),(43,95,0.158391),(43,36,0.153817),(43,71,0.151079),(43,81,0.131871),(43,23,0.106011),(43,80,0.100174),(44,76,0.289842),(44,12,0.195574),(44,15,0.191267),(45,26,0.150437),(46,68,0.125108),(46,49,0.114701),(46,72,0.106997),(47,49,0.142393),(48,38,0.195375),(48,3,0.120243),(48,20,0.115325),(49,15,0.154845),(50,67,0.109423),(51,68,0.119398),(51,57,0.110878),(52,75,0.244557),(52,93,0.238852),(52,72,0.116876),(52,47,0.10033),(54,20,0.16192),(54,76,0.154999),(54,2,0.137232),(54,49,0.112474),(55,73,0.141846),(56,67,0.140402),(57,68,0.289332),(57,31,0.22259),(57,94,0.149365),(59,68,0.162177),(60,95,0.218647),(60,3,0.14992),(62,8,0.170245),(62,70,0.106619),(62,66,0.105478),(63,85,0.154847),(63,41,0.1034),(64,26,0.155751),(64,92,0.125946),(65,67,0.195582),(65,24,0.124426),(65,75,0.111382),(66,8,0.235166),(66,70,0.117641),(67,8,0.122332),(68,57,0.257495),(68,94,0.101055),(69,2,0.133757),(69,24,0.107291),(70,31,0.171469),(70,66,0.126584),(70,82,0.10286),(71,17,0.163096),(71,43,0.151968),(71,80,0.116993),(72,57,0.117197),(73,24,0.293312),(73,55,0.14274),(74,49,0.227537),(74,76,0.127603),(74,15,0.121217),(74,44,0.116919),(74,46,0.103299),(75,52,0.198879),(75,31,0.167881),(75,67,0.125098),(75,57,0.106959),(76,44,0.32392),(76,20,0.146293),(76,35,0.143486),(76,49,0.100114),(77,8,0.278975),(78,38,0.150775),(78,20,0.132335),(78,34,0.121767),(79,74,0.136197),(80,10,0.250118),(81,36,0.194883),(83,18,0.323636),(83,89,0.29388),(84,6,0.150496),(86,17,0.15915),(86,10,0.107688),(87,38,0.181133),(87,76,0.107647),(88,25,0.140808),(88,67,0.135277),(88,28,0.124133),(88,24,0.119028),(89,22,0.451096),(89,83,0.321562),(89,59,0.171271),(89,47,0.149296),(89,68,0.136309),(89,94,0.122487),(91,37,0.240539),(91,18,0.144611),(92,17,0.302285),(92,24,0.110176),(92,10,0.102539),(93,52,0.157253),(93,72,0.156761),(94,57,0.272479),(94,68,0.264126),(94,22,0.125641),(94,40,0.11261),(95,60,0.166641),(95,23,0.108894),(95,43,0.1078);
/*!40000 ALTER TABLE `SimilarImage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TextTag`
--

DROP TABLE IF EXISTS `TextTag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TextTag` (
  `TextTagID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `TextTag` varchar(45) NOT NULL,
  `InverseDocumentFrequency` double unsigned DEFAULT NULL,
  PRIMARY KEY (`TextTagID`),
  UNIQUE KEY `TextTag_UNIQUE` (`TextTag`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TextTag`
--

LOCK TABLES `TextTag` WRITE;
/*!40000 ALTER TABLE `TextTag` DISABLE KEYS */;
/*!40000 ALTER TABLE `TextTag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User` (
  `UserID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) NOT NULL,
  `HashedPassword` varchar(64) NOT NULL,
  `EmailAddress` varchar(255) NOT NULL,
  `LoginAttempts` int(10) unsigned NOT NULL DEFAULT '0',
  `LastLoginAttempt` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `UserID_UNIQUE` (`UserID`),
  UNIQUE KEY `Name_UNIQUE` (`Name`),
  UNIQUE KEY `EmailAddress_UNIQUE` (`EmailAddress`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UserToken`
--

DROP TABLE IF EXISTS `UserToken`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `UserToken` (
  `UserTokenID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `UserID` int(10) unsigned NOT NULL,
  `Agent` varchar(64) NOT NULL,
  `Token` varchar(45) NOT NULL,
  `Type` varchar(45) NOT NULL,
  `Created` int(10) unsigned NOT NULL,
  `Expires` int(10) unsigned NOT NULL,
  PRIMARY KEY (`UserTokenID`),
  UNIQUE KEY `UserTokenID_UNIQUE` (`UserTokenID`),
  UNIQUE KEY `Token_UNIQUE` (`Token`),
  KEY `fk_UserToken_UserID` (`UserID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UserToken`
--

LOCK TABLES `UserToken` WRITE;
/*!40000 ALTER TABLE `UserToken` DISABLE KEYS */;
/*!40000 ALTER TABLE `UserToken` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User_Role`
--

DROP TABLE IF EXISTS `User_Role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User_Role` (
  `UserID` int(10) unsigned NOT NULL,
  `RoleID` int(10) unsigned NOT NULL,
  KEY `fk_User_Role_UserID` (`UserID`),
  KEY `fk_User_Role_RoleID` (`RoleID`),
  CONSTRAINT `fk_User_Role_UserID` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_Role_RoleID` FOREIGN KEY (`RoleID`) REFERENCES `Role` (`RoleID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User_Role`
--

LOCK TABLES `User_Role` WRITE;
/*!40000 ALTER TABLE `User_Role` DISABLE KEYS */;
/*!40000 ALTER TABLE `User_Role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `VisitedList`
--

DROP TABLE IF EXISTS `VisitedList`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `VisitedList` (
  `UserID` int(10) unsigned NOT NULL,
  `MonumentID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`UserID`,`MonumentID`),
  KEY `Monumentzo.VisitedList.UserID` (`UserID`),
  KEY `Monumentzo.VisitedList.MonumentID` (`MonumentID`),
  CONSTRAINT `Monumentzo.VisitedList.UserID` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Monumentzo.VisitedList.MonumentID` FOREIGN KEY (`MonumentID`) REFERENCES `Monument` (`MonumentID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `VisitedList`
--

LOCK TABLES `VisitedList` WRITE;
/*!40000 ALTER TABLE `VisitedList` DISABLE KEYS */;
/*!40000 ALTER TABLE `VisitedList` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `WishList`
--

DROP TABLE IF EXISTS `WishList`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `WishList` (
  `UserID` int(10) unsigned NOT NULL,
  `MonumentID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`UserID`,`MonumentID`),
  KEY `Monumentzo.WishList.MonumentID` (`MonumentID`),
  KEY `Monumentzo.WishList.UserID` (`UserID`),
  CONSTRAINT `Monumentzo.WishList.MonumentID` FOREIGN KEY (`MonumentID`) REFERENCES `Monument` (`MonumentID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Monumentzo.WishList.UserID` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `WishList`
--

LOCK TABLES `WishList` WRITE;
/*!40000 ALTER TABLE `WishList` DISABLE KEYS */;
/*!40000 ALTER TABLE `WishList` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-05-11 18:02:30
