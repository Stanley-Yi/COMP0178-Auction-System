-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2022-12-11 04:33:14
-- 服务器版本： 10.4.24-MariaDB
-- PHP 版本： 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `auction_system`
--

-- --------------------------------------------------------

--
-- 表的结构 `auction`
--

CREATE TABLE `auction` (
  `auction_id` int(11) NOT NULL,
  `end_date` datetime NOT NULL,
  `seller_id` int(11) NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `start_price` double NOT NULL,
  `reserve_price` double NOT NULL,
  `picture` varchar(100) CHARACTER SET utf8 NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `status` int(11) NOT NULL,
  `category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `auction`
--

INSERT INTO `auction` (`auction_id`, `end_date`, `seller_id`, `description`, `start_price`, `reserve_price`, `picture`, `name`, `status`, `category`) VALUES
(30, '2022-12-09 18:20:00', 3, '2018 Precious Australian Beauties -Kookaburra 1 Oz\r\nCountry/Province: Australia\r\nDenomination: 1 Dollar\r\nPrecious metal: Silver\r\nStatus: Uncirculated (Uncirculated Circulation)', 10, 150, '/auction/img/1670350790.jpg', '2018 Precious Australian Beauties', 2, 1),
(31, '2022-12-08 19:12:00', 7, '1995 Château de Fargues - Excellent Cru de Sauternes - Lot 2 bouteilles\r\n\r\nEnvoi sécurisé et assurance comprise\r\n\r\nSecure delivery and insurance included\r\n\r\nVeilige levering en verzekering inbegrepen\r\n\r\nPlease not that it is forbidden to send alcohol to the USA and Canada except merchant with alcohol licence.\r\n\r\nl envoi de vins et d alcool est interdit pour le Canada et les USA sauf pour les marchands avec licence de vente d alcool.\r\n\r\nBottle Capacity: Bottles (0.75L), Bordeaux bottle type, neck fill level.', 30, 150, '/auction/img/1670351256.jpg', '1995 Château de Fargues', 2, 2),
(32, '2022-12-17 15:30:00', 7, 'Tecnotempo is an Italian brand, each model is produced in a limited and numbered edition so that every single watch is unique, in this auction we offer a Tecnotempo masterpiece:\r\n\r\nREAL Forged Carbon Automatic Diver s 250M/8250FT WR Swiss Automatic Sellita Movement - LIMITED EDITION 100PCS -\r\nThe Forged Carbon case measures 47mm in diameter (excluding crown) and 14,5mm in thickness and about 100gr. of weight.\r\nNew, with tag, box and 2 year official warranty\r\nThe Tecnotempo watch was made using first choice components :\r\nFull and Real Carbon case and fixed titanium bezel with luminous indexes closed with 4 Allen screws\r\nSwiss Automatic Sellita SW200 (26 jewels, 38 hours Power Reserve , 28,800 BPH )\r\nCarbon Dial\r\n250 meters / 825 FT Water Resistant\r\nSapphire Crystal\r\nDate\r\nBlack rubber strap (24mm/22mm) with titanium buckle\r\nLIMITED EDITION OF 100 PIECES.\r\nScrew-down titanium crown\r\nScrew-down titanium caseback\r\nCase diameter: 47mm (excluding crown)\r\nCase thickness: 14,5mm\r\nBand width: 22mm-20mm\r\nWater resistant: 250 meters / 825 feet\r\nThe circumference of the watch is about 21cm\r\nWeight: about 100gr.\r\n2 year official warranty , special box and manual\r\nThe goods will be carefully packed and shipped from Italy by courier (tracked and insured)', 100, 300, '/auction/img/1670351516.jpg', 'Tecnotempo Watch', 0, 3),
(33, '2022-12-08 09:30:00', 8, 'Vintage Montblanc meisterstück solitaire doue sterling 164 burgundy ballpoint. Pen in excellent condition, still has the original label on the stem. Used only for special occasion writing test. Accompanied by original Montblanc box.\r\n\r\nPeriod: 1990-1999.\r\nDimensions:13×1×1 cm', 20, 65, '/auction/img/1670351698.jpg', 'Montblanc Pen', 0, 3),
(34, '2022-12-10 00:10:00', 12, 'Collana con pendente in oro 18kt con diamanti.\r\nGioiello di produzione artigianale\r\n\r\nPietra principale: 20 diamanti taglio brillante per un peso stimato di circa 0.24 ct. F - G Color VS/SI ( 20 x 0.012 ct. = 0.24 ct. )\r\n\r\nPeso dell oggetto: 1.85gr\r\nDimensione pendente 1.5cm x 0.3cm\r\nLunghezza collana 41cm\r\nTestato AU oro 18kt (pendente)\r\nStampi dell oro 18kt / 750 (collana)\r\nCondizioni: nuovo\r\nViene fornito con scatola e garanzia di gioielleria\r\n\r\nOgni gioiello prima della spedizione viene sottoposto ad un controllo qualità\r\n\r\nEffettua il tuo acquisto in tutta sicurezza\r\n\r\nSpedizione: Tracciata e assicurata con DHL\r\n\r\nEventuali dazi doganali sono a carico del compratore', 30, 320, '/auction/img/1670351935.jpg', 'No Reserve Price - Necklace with pendant', 2, 3),
(35, '2022-12-08 15:00:00', 12, 'An authentic CHANEL Classic Double Flap 10\" Chain Shoulder Bag Black made of black Lambskin. The color is Black. The outside material is Leather. The pattern is Solid. This item is Vintage / Classic. The year of manufacture would be 1994-1996.\r\nConditions & Ratings\r\nOutside material: Lambskin\r\nColor: Black\r\nClosure: Turn Lock\r\nHardware and chain: Gold-Tone\r\nMade in France\r\nSerial sticker: Attached\r\nSerial #: HIDDEN FOR SECURITY REASON\r\nComes with: Full set; Authenticity card, Dust bag, Box, Care booklet\r\nOverall: 8 of 10 - The outside is in excellent condition with minimal signs of use only. Tiny scratches on the back. The inside is also excellent and very clean with slight scratches. No stickiness or peeling. All chains and hardware are shiny and excellent. The dust bag and box are also great. Highly recommended!\r\n\r\n\r\nApprox. size: H6.1\" x W10\" x D2.5\" (H15.5 x W25.4 x D6.5 cm)\r\nApprox. strap drop when double chain: 9\" (23 cm)\r\nApprox. strap drop when single chain: 16.1\" (41 cm)\r\n\r\nAbout Smell: Mold: NO / Perfume: NO / Cigarette: NO\r\n(The smell is judged by us and it may differ depending on the individual. Please refrain from the purchase if you are sensitive to smell.)\r\n\r\nThe mannequin may be smaller than you. She is wearing clothes in size US 6. The clothes, mannequin, and iPhone are not included.\r\nWe put a security tag on the item to ensure that the item is not worn after shipped, or is not changed to a different bag. We will not accept the return if you remove our tag from the item.\r\n100 % Authentic guaranteed or money back.\r\n\r\nWe may cancel the order from the customer lived in Japan because of JCT.', 150, 280, '/auction/img/1670352225.jpg', 'CHANEL Classic Double Flap Shoulder Bag', 2, 5),
(36, '2022-12-13 20:40:00', 12, 'Condition: These shoes have been used and the white covering has already been removed . They have some very small dirt spots but they are in great condition. They come with the original box. Please see the photos carefully for more details.\r\n\r\nSize: (WMNS) EU 42, CM 27, UK 7.5, US 10\r\n\r\nWomen s Air Max 98 LX Reveal\r\nBeneath a thin veil of white textile, the mysterious Air Max 98 hides its colorful internals. Followed by a small text graphic above the toe box that says \"Tear Here,\" the shoe s protective film is removed to reveal a variety of premium leather underneath. Also included in the playful packaging is a list of practical tips for getting creative and having fun peeling off another layer of textile. The upper inherits the characteristic original design line inspired by the flow of water. The insole features a novel question mark graphic.\r\n\r\nShipping: 35 Euro Worldwide Shipping with FedEx will include tracking number\r\nNOTICE: Extra charges such as taxes or service fees may be added in the receiving country, the buyer will be responsible to pay those additional fees. Please check your import and custom fees before bidding.', 50, 120, '/auction/img/1670352350.jpg', 'Nike - NIKE Women Air Max 98 LX', 0, 5),
(37, '2023-01-13 00:59:00', 15, 'Chinese gemberpot. Gaaf en compleet met deksel. Porselein met blauw glazuur dat het handgeschilderde Prunus-ontwerp uitbeeldt.\r\nGemarkeerd met dubbele ring op de bodem.\r\nAfmetingen: diameter 14 cm, doorsnede bovenkant 5 cm en bodem 9 cm, hoogte met deksel 14,5 cm. Gewicht 450 gr.\r\nConditie: in goede staat met gebruikelijke bakfoutjes\r\nZie fotos voor uw eigen indruk, ze maken deel uit van de beschrijving.', 150, 2000, '/auction/img/1670352748.jpg', 'Chinese gemberpot', 0, 6),
(38, '2022-12-11 00:00:00', 15, 'A very beautiful Chinese famille rose porcelain lantern-shaped vase, the upper part of the vase body is composed of a separate cylindrical shaft, which can be disassembled. The appearance is painted with gossip patterns surrounded by flowers, hollow windows on the four walls, and the sculpture of the Chinese lucky symbol \"RUYI\". It is ingenious in conception, noble and elegant in shape, and of high quality. It was made in the 20th century in China, with a height of 29cm and a width of about 16cm.\r\n\r\nThe main body of the vase is well preserved, the inner shaft of the vase is broken with the upper half, and has been repaired and glued.\r\nBut absolutely does not affect the beauty of the object itself.\r\nThere are slight oxidation marks on the enamel surface, and there are signs of melting of the colored glaze.\r\nThe item will be carefully packaged and entrusted with a trusted courier to deliver the package.', 50, 500, '/auction/img/1670364664.jpg', 'Chinese famille rose porcelain lantern-shaped vase', 0, 6),
(39, '2022-12-08 19:15:00', 17, 'Iconic Chanel Boutique Paris Luxurious Wool & Silk Wrap Coat Reversible (Quilted Silk & Wol - blend )Large Shawl Collar / Long Oversized Model\r\nStyle Bohemian / Vintage 1990-2000s\r\nModel très rare\r\nDimensions:\r\nLength: 110 cm\r\nShoulder: 68 cm\r\nBust: 140 cm\r\nSleeves : 53 cm + 10 cm', 70, 110, '/auction/img/1670364837.jpg', 'Chanel - Boutique Wrap Coat', 0, 5),
(40, '2022-12-21 02:20:00', 17, 'Brand new. Exactly as you buy at the Bvlgari store in Italy.\r\n\r\nThe sunglasses are made in Italy and made from very high quality material. Well known designer brand.\r\n\r\nUnique design with an 18K gold plated metal frame, and a special shape on the hexagon lenses. Smooth colors.\r\n\r\nIncluding Bulgari protection cloth and protection box, as well as all documentation, all new.\r\n\r\nThe highest quality optical standards, with great viewing from all angles.\r\n\r\nBridge: 17 mm\r\nTemples: 140 mm\r\nLens width: 57 mm\r\n\r\nAuthenticity guaranteed.\r\n\r\nAll new.\r\n\r\nShipment with insurance and Track & Trace code.', 20, 75, '/auction/img/1670364934.jpg', 'Bulgari - Special Lenses - Gold Hexagon', 0, 5),
(41, '2022-12-11 00:20:00', 17, 'J. Selosse ~ Initial ~ degorge 2019 , Champagne top, bottiglia in perfetto stato, capsula perfetta, livello alto, etichetta perfetta, mantenuta nella nostra cantina a temperatura e umidità controllata, spedizione veloce con Fedex o Dhl in box polistirolo termico a protezione da urti e sbalzi termici, bottiglia garantita se non soddisfatti possibile restituzione, la bottiglia e quella della foto', 50, 273, '/auction/img/1670365057.jpg', 'Jacques Selosse \"Initial\" Brut Blanc de Blancs, dégorgé 2019', 2, 2),
(42, '2023-02-01 00:20:00', 17, 'DESCRIPTION\r\n\r\nLa cuvée Cristal de la maison de Champagne Louis Roederer est l’un des champagnes les plus réputés au monde. C’est une cuvée élaborée uniquement lors des plus grands millésimes, et l’année 2008 est, de l’avis des spécialistes, sans aucun doute la plus grande des 15 dernières années.\r\n\r\nL’année 2008 fût sèche mais fraîche, permettant à la vigne d’offrir des raisins d’une exceptionnelle densité, et d’une grande expressivité aromatique. Ce millésime 2008 se distingue également par sa grande fraîcheur.\r\n\r\nLa cuvée Cristal 2008 est un mariage de Grands Crus de la Montagne de Reims, de la Vallée de la Marne et de la Côte des Blancs. Le Pinot Noir domine l’assemblage (60%), complété par le Chardonnay (40%).\r\n\r\nElle a vieilli patiemment 10 ans dans les cas de la maison Roederer avant de révéler son éclat et sa pureté.\r\n\r\nAu nez, le Cristal 2008 Roederer se dévoile sur des notes intenses d’agrumes confits, qui après quelques instants laissent place à des notes généreuses de poire et d’amande. On découvre enfin une pointe élégante de torréfaction.\r\n\r\nEn bouche, le Cristal 2008 s’affirme totalement, avec une attaque splendide, puissante, tout en conservant la signature du terroir, une belle touche crayeuse. Le toucher de bouche est unique, soyeux, presque suave. Soutenue par une belle tension, la bouche est pure, pleine, et s’étire de longues secondes avec en point de mire une touche saline.\r\n\r\nAvec Cristal 2008, Louis Roederer signe l’un de ses plus grands chefs-d’œuvre.\r\n\r\nPoints: 19.5 / 20 Jancis Robinson\r\n19 / 20 Bettane & Desseauve\r\n20 / 20 Revue du Vin de France\r\n18 / 20 Le Point\r\n99 / 100 Tyson Stelzer\r\n98 / 100 Decanter\r\n\r\nJamais enlever de son film UV.', 60, 340, '/auction/img/1670365140.jpg', '2008 Louis Roederer, Cristal', 0, 2),
(43, '2022-12-08 03:59:00', 17, 'Kings of Macedonia. AR Tetradrachm, circa 324/3-320 BC. In name and types of Alexander III. Arados mint. Struck under Menes or Laomedon.\r\nObv: Head of Herakles right, wearing lion skin.\r\nRev: Zeus Aëtophoros seated left; kerykeion in left field, AP (civic) monogram below throne.\r\nRef: Price 3332\r\nWith Certification of authenticity and ownership\r\n\r\n16.79 gr\r\n26 mm\r\n\r\nThe coin comes with a nice case and certificate.', 30, 95, '/auction/img/1670365270.jpg', 'Kings of Macedonia Coin', 1, 1),
(44, '2022-12-09 00:25:00', 20, 'Claude Gaveau\r\nStill Life with Violin and Piano\r\n\r\nOriginal oil on canvas\r\nSigned in the lower left corner\r\nSigned again on the back\r\nOn canvas 73 x 60 cm (c. 29 x 24 in)\r\n\r\nVery good condition\r\n\r\n#EvelienReich', 70, 330, '/auction/img/1670365368.jpg', 'Claude Gaveau (1940) - Still life with violin and piano', 0, 4);

-- --------------------------------------------------------

--
-- 表的结构 `bid`
--

CREATE TABLE `bid` (
  `bid_id` int(11) NOT NULL,
  `auction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bid_time` datetime NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `bid`
--

INSERT INTO `bid` (`bid_id`, `auction_id`, `user_id`, `bid_time`, `price`) VALUES
(15, 33, 1, '2022-12-07 00:25:22', 20),
(16, 33, 2, '2022-12-07 00:26:29', 25),
(17, 33, 1, '2022-12-07 00:29:27', 30),
(18, 33, 4, '2022-12-07 00:30:00', 50),
(19, 33, 1, '2022-12-07 00:30:39', 62),
(20, 33, 30, '2022-12-07 00:31:02', 70),
(21, 33, 29, '2022-12-07 00:31:37', 101),
(22, 33, 4, '2022-12-07 00:32:53', 105),
(23, 43, 4, '2022-12-07 00:44:38', 30),
(24, 43, 5, '2022-12-07 00:45:05', 31),
(27, 43, 6, '2022-12-07 00:55:08', 35),
(28, 43, 5, '2022-12-07 00:55:35', 51),
(29, 43, 9, '2022-12-07 00:56:09', 53),
(30, 43, 10, '2022-12-07 00:56:40', 60),
(31, 43, 6, '2022-12-07 00:57:11', 70),
(32, 43, 11, '2022-12-07 00:57:42', 71),
(33, 43, 10, '2022-12-07 00:58:11', 100),
(34, 43, 18, '2022-12-07 00:58:39', 102),
(35, 43, 16, '2022-12-07 00:59:25', 111),
(36, 35, 21, '2022-12-07 02:03:40', 155),
(37, 35, 22, '2022-12-07 02:04:07', 200),
(38, 35, 26, '2022-12-07 02:04:40', 210),
(39, 34, 29, '2022-12-07 02:05:02', 35),
(40, 40, 29, '2022-12-07 02:05:16', 20),
(41, 30, 27, '2022-12-07 02:05:42', 10),
(42, 31, 27, '2022-12-07 02:05:54', 31),
(43, 30, 24, '2022-12-07 02:06:19', 15),
(44, 36, 24, '2022-12-07 02:06:27', 50),
(45, 32, 24, '2022-12-07 02:06:35', 110),
(46, 42, 13, '2022-12-07 02:07:00', 65),
(47, 36, 13, '2022-12-07 02:07:11', 60),
(48, 40, 13, '2022-12-07 02:07:25', 40),
(49, 37, 23, '2022-12-07 02:07:47', 150),
(50, 41, 23, '2022-12-07 02:07:55', 51),
(51, 35, 23, '2022-12-07 02:08:08', 215),
(52, 36, 23, '2022-12-07 02:08:21', 75),
(53, 44, 25, '2022-12-07 02:08:43', 70),
(54, 38, 25, '2022-12-07 02:08:50', 55),
(55, 42, 25, '2022-12-07 02:09:00', 80),
(56, 43, 25, '2022-12-07 02:09:11', 112),
(57, 39, 25, '2022-12-07 02:09:21', 70),
(58, 31, 22, '2022-12-07 02:09:48', 35),
(59, 38, 22, '2022-12-07 02:09:56', 80),
(60, 32, 22, '2022-12-07 02:10:10', 137),
(61, 30, 2, '2022-12-07 02:10:29', 20),
(62, 41, 2, '2022-12-07 02:10:38', 60),
(63, 38, 2, '2022-12-07 02:10:45', 81),
(64, 34, 10, '2022-12-07 02:11:26', 41),
(65, 42, 10, '2022-12-07 02:11:38', 83),
(66, 32, 10, '2022-12-07 02:11:51', 146),
(67, 31, 16, '2022-12-07 02:12:25', 47),
(68, 44, 16, '2022-12-07 02:12:37', 89),
(69, 39, 16, '2022-12-07 02:12:51', 99),
(70, 39, 25, '2022-12-07 02:13:22', 105),
(71, 40, 25, '2022-12-07 02:13:32', 42),
(72, 37, 25, '2022-12-07 02:13:43', 152),
(73, 42, 26, '2022-12-07 02:14:07', 91),
(74, 40, 26, '2022-12-07 02:14:16', 44),
(75, 30, 26, '2022-12-07 02:14:34', 21),
(76, 42, 30, '2022-12-07 02:14:58', 98),
(77, 37, 30, '2022-12-07 02:15:13', 160),
(78, 41, 28, '2022-12-07 02:15:45', 72),
(79, 42, 28, '2022-12-07 02:15:54', 101),
(80, 32, 28, '2022-12-07 02:16:05', 180),
(81, 30, 18, '2022-12-07 02:16:32', 30),
(82, 38, 18, '2022-12-07 02:16:46', 90),
(83, 37, 18, '2022-12-07 02:16:56', 165),
(84, 30, 14, '2022-12-07 02:17:27', 31),
(85, 36, 14, '2022-12-07 02:17:39', 90),
(86, 43, 14, '2022-12-07 02:17:51', 140),
(87, 41, 5, '2022-12-07 02:18:47', 81),
(88, 33, 5, '2022-12-07 02:19:02', 132),
(89, 35, 5, '2022-12-07 02:19:14', 236),
(90, 30, 25, '2022-12-07 16:56:58', 33),
(91, 30, 24, '2022-12-07 17:10:51', 35),
(92, 38, 11, '2022-12-07 17:13:43', 105),
(93, 34, 11, '2022-12-07 17:19:45', 43),
(94, 34, 11, '2022-12-07 17:20:19', 45),
(95, 34, 14, '2022-12-07 17:27:42', 50),
(96, 34, 14, '2022-12-07 17:33:24', 51),
(97, 34, 14, '2022-12-07 17:34:09', 52),
(98, 34, 14, '2022-12-07 17:37:52', 55),
(99, 40, 14, '2022-12-07 17:44:00', 56),
(100, 42, 14, '2022-12-07 17:47:23', 125),
(101, 30, 22, '2022-12-07 17:49:31', 45),
(102, 39, 3, '2022-12-07 19:13:55', 110),
(103, 43, 18, '2022-12-08 01:45:24', 145),
(104, 34, 6, '2022-12-08 01:45:55', 60),
(105, 42, 6, '2022-12-08 01:46:13', 150);

-- --------------------------------------------------------

--
-- 表的结构 `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Coin & Stamp'),
(2, 'Wine & Whiskey'),
(3, 'Jewellery & Watch'),
(4, 'Contemporary art'),
(5, 'Luxury Fashion'),
(6, 'Antique');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(30) CHARACTER SET utf8 NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `password` varchar(50) CHARACTER SET utf8 NOT NULL,
  `is_seller` bit(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `email`, `password`, `is_seller`) VALUES
(1, 'Abigail', 'hengbaimi48867@163.com', '111', b'0000000000'),
(2, 'Humphry', 'yuyecheng9175504@163.com', '15973', b'0000000000'),
(3, 'Agnes', 'juyanzi2139@163.com', '222', b'0000000001'),
(4, 'Brenda', 'qiurekong71156@163.com', '12132', b'0000000000'),
(5, 'Constance', 'ruimeiyi2954648@163.com', '0123', b'0000000000'),
(6, 'Cynthia', 'jiaotuo450605@163.com', '0031', b'0000000000'),
(7, 'Ellen', 'angchimaozhi0250@163.com', '4897', b'0000000001'),
(8, 'Frances', 'buqiang94001@163.com', '549', b'0000000001'),
(9, 'Hedwig', 'pixie087578@163.com', '666', b'0000000000'),
(10, 'Jackie', 'yonggubizhan7618@163.com', '555', b'0000000000'),
(11, 'Lilian', 'ganpang64181663@163.com', '6719', b'0000000000'),
(12, 'Lorna', 'yinweicai2249152@163.com', '3497', b'0000000001'),
(13, 'Minnie', 'oukongyun1310@163.com', '648', b'0000000000'),
(14, 'Olivia', 'yuhe6254746@163.com', '6719', b'0000000000'),
(15, 'Renee', 'yetangweiye01484@163.com', '3569', b'0000000001'),
(16, 'Sibyl', 'baigulang2918@163.com', '0644', b'0000000000'),
(17, 'Vicky', 'fushike8141049@163.com', '07884', b'0000000001'),
(18, 'Adolf', 'cenzi382768070@163.com', '18945', b'0000000000'),
(19, 'Billy', 'cuzhuopu156797@163.com', '0462', b'0000000001'),
(20, 'Adolf', 'zhipanpai7155@163.com', '0987454', b'0000000001'),
(21, 'Cedric', 'lezhanglu458125@163.com', '76484', b'0000000000'),
(22, 'Gary', 'xiexie17967@163.com', '58741', b'0000000000'),
(23, 'Earl', 'fufang02098754@163.com', '12347', b'0000000000'),
(24, 'Cyril', 'jingzhong98023@163.com', '11123', b'0000000000'),
(25, 'Dan', 'quanxin4245176@163.com', '55896', b'0000000000'),
(26, 'Isaac', 'houfei64488970@163.com', '21785', b'0000000000'),
(27, 'Jacob', 'kanbi06255723@163.com', '0249', b'0000000000'),
(28, 'Kenneth', 'lanchuihuan7662@163.com', '8462', b'0000000000'),
(29, 'Lincoln', 'ganpoqian332643@163.com', '0984', b'0000000000'),
(30, 'Norman', 'wupin373292503@163.com', '18612', b'0000000000');

-- --------------------------------------------------------

--
-- 表的结构 `watchlist`
--

CREATE TABLE `watchlist` (
  `watchlist_id` int(11) NOT NULL,
  `auction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `watchlist`
--

INSERT INTO `watchlist` (`watchlist_id`, `auction_id`, `user_id`) VALUES
(106, 42, 1),
(107, 36, 1),
(108, 37, 18),
(109, 40, 18),
(110, 36, 18);

--
-- 转储表的索引
--

--
-- 表的索引 `auction`
--
ALTER TABLE `auction`
  ADD PRIMARY KEY (`auction_id`),
  ADD KEY `fk_seller_id` (`seller_id`),
  ADD KEY `fk_category_id` (`category`);

--
-- 表的索引 `bid`
--
ALTER TABLE `bid`
  ADD PRIMARY KEY (`bid_id`),
  ADD KEY `fk_auction_id` (`auction_id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- 表的索引 `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- 表的索引 `watchlist`
--
ALTER TABLE `watchlist`
  ADD PRIMARY KEY (`watchlist_id`),
  ADD KEY `wl_auction_id` (`auction_id`),
  ADD KEY `wl_user_id` (`user_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `auction`
--
ALTER TABLE `auction`
  MODIFY `auction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- 使用表AUTO_INCREMENT `bid`
--
ALTER TABLE `bid`
  MODIFY `bid_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- 使用表AUTO_INCREMENT `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- 使用表AUTO_INCREMENT `watchlist`
--
ALTER TABLE `watchlist`
  MODIFY `watchlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- 限制导出的表
--

--
-- 限制表 `auction`
--
ALTER TABLE `auction`
  ADD CONSTRAINT `fk_category_id` FOREIGN KEY (`category`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `fk_seller_id` FOREIGN KEY (`seller_id`) REFERENCES `user` (`user_id`);

--
-- 限制表 `bid`
--
ALTER TABLE `bid`
  ADD CONSTRAINT `fk_auction_id` FOREIGN KEY (`auction_id`) REFERENCES `auction` (`auction_id`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- 限制表 `watchlist`
--
ALTER TABLE `watchlist`
  ADD CONSTRAINT `wl_auction_id` FOREIGN KEY (`auction_id`) REFERENCES `auction` (`auction_id`),
  ADD CONSTRAINT `wl_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
