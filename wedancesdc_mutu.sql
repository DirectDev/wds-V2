-- phpMyAdmin SQL Dump
-- version 4.1.9
-- http://www.phpmyadmin.net
--
-- Client :  wedancesdc_mutu.mysql.db
-- Généré le :  Jeu 12 Février 2015 à 18:00
-- Version du serveur :  5.1.73-2+squeeze+build1+1-log
-- Version de PHP :  5.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `wedancesdc_mutu`
--

-- --------------------------------------------------------

--
-- Structure de la table `address`
--

CREATE TABLE IF NOT EXISTS `address` (
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
  KEY `IDX_C2F3561DF92F3E70` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=38 ;

--
-- Contenu de la table `address`
--

INSERT INTO `address` (`id`, `name`, `country_id`, `street`, `street_complement`, `city`, `postcode`, `latitude`, `longitude`) VALUES
(1, NULL, 74, NULL, NULL, 'Lille', '59000', NULL, NULL),
(3, 'Macumba', 74, 'Centre Commercial', NULL, 'Englos', '59320', 50.6313056, 2.965497),
(4, 'Padel Sensation', 74, '9 rue Chappe', NULL, 'Villeneuve-d''Ascq', '59650', 50.6430735, 3.1244158),
(5, NULL, 74, NULL, NULL, 'Orange', NULL, 44.1380989, 4.807511),
(6, 'LA REGIE', 74, 'Terrasse du Grand Stade Lille Métropole', '261, Boulevard de Tournai', 'Villeneuve d''Ascq', '59656', 50.6144803, 3.1366071),
(7, 'Dansschool Dursin', 21, 'Sint-Denijsestraat 101', NULL, 'Kortrijk', '8500', 50.821487, 3.2732927),
(8, 'B-Floor', 74, '13 rue Geoffroy Saint-Hilaire', NULL, 'Lille', '59000', 50.623261, 3.0628945),
(9, 'Zenith Lille', 74, NULL, NULL, 'Lille', '59000', 50.6138111, 3.0423599),
(10, 'L''intervalle Bar', 74, '23, RUE LEONARD DANEL', NULL, 'Lille', '59000', 50.6398564, 3.0565618),
(11, 'LATIN DANCE', 74, '124b rue de l''épidème', NULL, 'Tourcoing', '59200', 50.7162807, 3.1724896),
(12, 'Le Palmarium', 74, '435 rue Gambetta', NULL, 'Lille', '59000', 50.6253189, 3.0454351),
(13, NULL, 74, NULL, NULL, 'paris', NULL, 48.856614, 2.3522219),
(14, 'LATIN DANCE', 74, '124 rue de l''épideme', NULL, 'tourcoing', NULL, 50.7164163, 3.1728666),
(15, 'B-Floor', 74, '13 rue Geoffroy Saint-Hilaire', NULL, 'Lille', '59000', 50.623261, 3.0628945),
(16, 'L''Hacienda des Saveurs', 74, NULL, NULL, 'Malo-Les-Bains', '59240', 51.048679, 2.401069),
(17, 'Zango', 74, '36 rue de Gand', NULL, 'Lille', '59000', 50.6419755, 3.0662087),
(18, 'L''intervalle bar', 74, '23 rue Léonard Danel', NULL, 'Lille', NULL, 50.6398564, 3.0565618),
(19, 'Macondo', 74, '37 Rue des Postes', NULL, 'Lille', '59000', 50.6270665, 3.0572914),
(20, 'Paris', 74, '18 rue de la Croix Nivert,', NULL, 'Paris', NULL, 48.8471743, 2.2998984),
(21, NULL, 74, NULL, NULL, 'Lille', NULL, 50.62925, 3.057256),
(22, 'cubana bar', 74, '13 rue de la paix', NULL, 'lens', '62300', 50.4284649, 2.8287913),
(23, 'MILONGA TANGO KORTRIJK', 21, 'Balletzaal Schouwburg via ingang in de Hazelaarstraat 7', NULL, 'COURTRAI', NULL, 50.8258507, 3.2650555),
(24, 'EL DIABLITO LATINO', 74, '45 RUE ST SEBASTIEN', NULL, 'PARIS', '75011', 48.8618409, 2.3716823),
(25, 'L''intervalle bar', 74, '23, RUE LEONARD DANEL', NULL, 'Lille', '59000', 50.6398564, 3.0565618),
(26, NULL, 74, '3 rue du chêne de cambrie', NULL, 'mesnil-Saint-Laurent', '02720', 49.8277886, 3.3560148),
(27, 'Dansschool Dursin', 21, 'Sint-Denijsestraat 101, 8500 Kortrijk', NULL, 'Kortrijk', '8500', 50.821487, 3.2732927),
(28, 'ZANGO', 74, '36, Rue de Gand', NULL, 'Lille', '59000', 50.6419755, 3.0662087),
(29, 'El Diablito latino', 74, '45 Rue Saint-Sébastien', NULL, 'Paris', '75011', 48.8618409, 2.3716823),
(30, 'Salle de la Délivrance', 74, '43 Avenue Roger Salengro', NULL, 'LOMME', '59160', 50.6401714, 2.9903331),
(31, 'École Jean Heyman', 74, '10 rue Pasteur', NULL, 'Arras', NULL, 50.2889826, 2.7800695),
(32, 'Casino de Dunkerque', 74, '40 place du casino', NULL, 'Malo-Les-Bains', '59240', 51.048198, 2.3876334),
(33, 'Dansschool Dursin', 21, 'Sint-Denijsestraat 101', NULL, 'Kortrijk', '8500', 50.821487, 3.2732927),
(34, 'b-floor', 74, '13 rue Geoffroy Saint-Hilaire', NULL, 'Lille', '59000', 50.623261, 3.0628945),
(35, 'Hôtel Casino Barrière', 74, '777, Pont de Flandres', NULL, 'lille', '59777', 50.6365474, 3.0699389),
(36, 'Espace Easy Salsa', 74, '8 rue Courtois,', NULL, 'Lille', '59000', 50.6146785, 3.0426344),
(37, 'SALLE DU HAINAUT', 74, 'Rue Des Glacis', NULL, 'Valenciennes', '59300', 50.3606095, 3.5369395);

-- --------------------------------------------------------

--
-- Structure de la table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `searchcity` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Contenu de la table `city`
--

INSERT INTO `city` (`id`, `searchcity`, `latitude`, `longitude`) VALUES
(1, 'nice', 43.7101728, 7.2619532),
(2, 'paris', 48.856614, 2.3522219),
(3, 'lille', 50.62925, 3.057256),
(4, 'marseille', 43.296482, 5.36978),
(5, 'lyon', 45.764043, 4.835659),
(6, 'singapore', 1.352083, 103.819836),
(7, 'radinghem-en-weppes', 50.621728, 2.906789),
(8, 'lille france', 50.62925, 3.057256),
(9, 'saint-paul-trois-châteaux', 44.348678, 4.768295),
(10, 'metz', 49.1193089, 6.1757156),
(11, 'mouscron', 50.7459126, 3.2192907),
(12, 'henin', 51.2027845, 22.0746604),
(13, 'hénin-beaumont', 50.420087, 2.94728),
(14, 'villeneuve', 45.7025599, 7.2073384),
(15, 'lecce', 40.3515155, 18.1750161),
(16, 'dunkerque', 51.0343684, 2.3767763),
(17, 'malo-les-bains', 51.048679, 2.401069),
(18, '24 rue saint gabriel lille', 50.638296, 3.0865954),
(19, '24, rue saint-gabriel, lille', 50.638296, 3.0865954),
(20, 'ville', 46.2016149, 6.2471439),
(21, 'pékin', 39.904211, 116.407395),
(22, 'lille, france', 50.62925, 3.057256),
(23, 'valenciennes', 50.357113, 3.518332);

-- --------------------------------------------------------

--
-- Structure de la table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `iso2` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=242 ;

--
-- Contenu de la table `country`
--

INSERT INTO `country` (`id`, `name`, `iso2`) VALUES
(1, 'Afghanistan', 'af'),
(2, 'Albania', 'al'),
(3, 'Algeria', 'dz'),
(4, 'American Samoa', 'as'),
(5, 'Andorra', 'ad'),
(6, 'Angola', 'ao'),
(7, 'Anguilla', 'ai'),
(8, 'Antarctica', 'aq'),
(9, 'Antigua And Barbuda', 'ag'),
(10, 'Argentina', 'ar'),
(11, 'Armenia', 'am'),
(12, 'Aruba', 'aw'),
(13, 'Australia', 'au'),
(14, 'Austria', 'at'),
(15, 'Azerbaijan', 'az'),
(16, 'Bahamas', 'bs'),
(17, 'Bahrain', 'bh'),
(18, 'Bangladesh', 'bd'),
(19, 'Barbados', 'bb'),
(20, 'Belarus', 'by'),
(21, 'Belgium', 'be'),
(22, 'Belize', 'bz'),
(23, 'Benin', 'bj'),
(24, 'Bermuda', 'bm'),
(25, 'Bhutan', 'bt'),
(26, 'Bolivia', 'bo'),
(27, 'Bosnia And Herzegovina', 'ba'),
(28, 'Botswana', 'bw'),
(29, 'Bouvet Island', 'bv'),
(30, 'Brazil', 'br'),
(31, 'British Indian Ocean Territory', 'io'),
(32, 'Brunei Darussalam', 'bn'),
(33, 'Bulgaria', 'bg'),
(34, 'Burkina Faso', 'bf'),
(35, 'Burundi', 'bi'),
(36, 'Cambodia', 'kh'),
(37, 'Cameroon', 'cm'),
(38, 'Canada', 'ca'),
(39, 'Cape Verde', 'cv'),
(40, 'Cayman Islands', 'ky'),
(41, 'Central African Republic', 'cf'),
(42, 'Chad', 'td'),
(43, 'Chile', 'cl'),
(44, 'China', 'cn'),
(45, 'Christmas Island', 'cx'),
(46, 'Cocos (keeling) Islands', 'cc'),
(47, 'Colombia', 'co'),
(48, 'Comoros', 'km'),
(49, 'Congo', 'cg'),
(50, 'Congo, The Democratic Republic Of The', 'cd'),
(51, 'Cook Islands', 'ck'),
(52, 'Costa Rica', 'cr'),
(53, 'Cote D''ivoire', 'ci'),
(54, 'Croatia', 'hr'),
(55, 'Cuba', 'cu'),
(56, 'Cyprus', 'cy'),
(57, 'Czech Republic', 'cz'),
(58, 'Denmark', 'dk'),
(59, 'Djibouti', 'dj'),
(60, 'Dominica', 'dm'),
(61, 'Dominican Republic', 'do'),
(62, 'East Timor', 'tp'),
(63, 'Ecuador', 'ec'),
(64, 'Egypt', 'eg'),
(65, 'El Salvador', 'sv'),
(66, 'Equatorial Guinea', 'gq'),
(67, 'Eritrea', 'er'),
(68, 'Estonia', 'ee'),
(69, 'Ethiopia', 'et'),
(70, 'Falkland Islands (malvinas)', 'fk'),
(71, 'Faroe Islands', 'fo'),
(72, 'Fiji', 'fj'),
(73, 'Finland', 'fi'),
(74, 'France', 'fr'),
(75, 'French Guiana', 'gf'),
(76, 'French Polynesia', 'pf'),
(77, 'French Southern Territories', 'tf'),
(78, 'Gabon', 'ga'),
(79, 'Gambia', 'gm'),
(80, 'Georgia', 'ge'),
(81, 'Germany', 'de'),
(82, 'Ghana', 'gh'),
(83, 'Gibraltar', 'gi'),
(84, 'Greece', 'gr'),
(85, 'Greenland', 'gl'),
(86, 'Grenada', 'gd'),
(87, 'Guadeloupe', 'gp'),
(88, 'Guam', 'gu'),
(89, 'Guatemala', 'gt'),
(90, 'Guinea', 'gn'),
(91, 'Guinea-bissau', 'gw'),
(92, 'Guyana', 'gy'),
(93, 'Haiti', 'ht'),
(94, 'Heard Island And Mcdonald Islands', 'hm'),
(95, 'Holy See (vatican City State)', 'va'),
(96, 'Honduras', 'hn'),
(97, 'Hong Kong', 'hk'),
(98, 'Hungary', 'hu'),
(99, 'Iceland', 'is'),
(100, 'India', 'in'),
(101, 'Indonesia', 'id'),
(102, 'Iran, Islamic Republic Of', 'ir'),
(103, 'Iraq', 'iq'),
(104, 'Ireland', 'ie'),
(105, 'Israel', 'il'),
(106, 'Italy', 'it'),
(107, 'Jamaica', 'jm'),
(108, 'Japan', 'jp'),
(109, 'Jordan', 'jo'),
(110, 'Kazakstan', 'kz'),
(111, 'Kenya', 'ke'),
(112, 'Kiribati', 'ki'),
(113, 'Korea, Democratic People''s Republic Of', 'kp'),
(114, 'Korea, Republic Of', 'kr'),
(115, 'Kosovo', 'kv'),
(116, 'Kuwait', 'kw'),
(117, 'Kyrgyzstan', 'kg'),
(118, 'Lao People''s Democratic Republic', 'la'),
(119, 'Latvia', 'lv'),
(120, 'Lebanon', 'lb'),
(121, 'Lesotho', 'ls'),
(122, 'Liberia', 'lr'),
(123, 'Libyan Arab Jamahiriya', 'ly'),
(124, 'Liechtenstein', 'li'),
(125, 'Lithuania', 'lt'),
(126, 'Luxembourg', 'lu'),
(127, 'Macau', 'mo'),
(128, 'Macedonia, The Former Yugoslav Republic Of', 'mk'),
(129, 'Madagascar', 'mg'),
(130, 'Malawi', 'mw'),
(131, 'Malaysia', 'my'),
(132, 'Maldives', 'mv'),
(133, 'Mali', 'ml'),
(134, 'Malta', 'mt'),
(135, 'Marshall Islands', 'mh'),
(136, 'Martinique', 'mq'),
(137, 'Mauritania', 'mr'),
(138, 'Mauritius', 'mu'),
(139, 'Mayotte', 'yt'),
(140, 'Mexico', 'mx'),
(141, 'Micronesia, Federated States Of', 'fm'),
(142, 'Moldova, Republic Of', 'md'),
(143, 'Monaco', 'mc'),
(144, 'Mongolia', 'mn'),
(145, 'Montserrat', 'ms'),
(146, 'Montenegro', 'me'),
(147, 'Morocco', 'ma'),
(148, 'Mozambique', 'mz'),
(149, 'Myanmar', 'mm'),
(150, 'Namibia', 'na'),
(151, 'Nauru', 'nr'),
(152, 'Nepal', 'np'),
(153, 'Netherlands', 'nl'),
(154, 'Netherlands Antilles', 'an'),
(155, 'New Caledonia', 'nc'),
(156, 'New Zealand', 'nz'),
(157, 'Nicaragua', 'ni'),
(158, 'Niger', 'ne'),
(159, 'Nigeria', 'ng'),
(160, 'Niue', 'nu'),
(161, 'Norfolk Island', 'nf'),
(162, 'Northern Mariana Islands', 'mp'),
(163, 'Norway', 'no'),
(164, 'Oman', 'om'),
(165, 'Pakistan', 'pk'),
(166, 'Palau', 'pw'),
(167, 'Palestinian Territory, Occupied', 'ps'),
(168, 'Panama', 'pa'),
(169, 'Papua New Guinea', 'pg'),
(170, 'Paraguay', 'py'),
(171, 'Peru', 'pe'),
(172, 'Philippines', 'ph'),
(173, 'Pitcairn', 'pn'),
(174, 'Poland', 'pl'),
(175, 'Portugal', 'pt'),
(176, 'Puerto Rico', 'pr'),
(177, 'Qatar', 'qa'),
(178, 'Reunion', 're'),
(179, 'Romania', 'ro'),
(180, 'Russian Federation', 'ru'),
(181, 'Rwanda', 'rw'),
(182, 'Saint Helena', 'sh'),
(183, 'Saint Kitts And Nevis', 'kn'),
(184, 'Saint Lucia', 'lc'),
(185, 'Saint Pierre And Miquelon', 'pm'),
(186, 'Saint Vincent And The Grenadines', 'vc'),
(187, 'Samoa', 'ws'),
(188, 'San Marino', 'sm'),
(189, 'Sao Tome And Principe', 'st'),
(190, 'Saudi Arabia', 'sa'),
(191, 'Senegal', 'sn'),
(192, 'Serbia', 'rs'),
(193, 'Seychelles', 'sc'),
(194, 'Sierra Leone', 'sl'),
(195, 'Singapore', 'sg'),
(196, 'Slovakia', 'sk'),
(197, 'Slovenia', 'si'),
(198, 'Solomon Islands', 'sb'),
(199, 'Somalia', 'so'),
(200, 'South Africa', 'za'),
(201, 'South Georgia And The South Sandwich Islands', 'gs'),
(202, 'Spain', 'es'),
(203, 'Sri Lanka', 'lk'),
(204, 'Sudan', 'sd'),
(205, 'Suriname', 'sr'),
(206, 'Svalbard And Jan Mayen', 'sj'),
(207, 'Swaziland', 'sz'),
(208, 'Sweden', 'se'),
(209, 'Switzerland', 'ch'),
(210, 'Syrian Arab Republic', 'sy'),
(211, 'Taiwan, Province Of China', 'tw'),
(212, 'Tajikistan', 'tj'),
(213, 'Tanzania, United Republic Of', 'tz'),
(214, 'Thailand', 'th'),
(215, 'Togo', 'tg'),
(216, 'Tokelau', 'tk'),
(217, 'Tonga', 'to'),
(218, 'Trinidad And Tobago', 'tt'),
(219, 'Tunisia', 'tn'),
(220, 'Turkey', 'tr'),
(221, 'Turkmenistan', 'tm'),
(222, 'Turks And Caicos Islands', 'tc'),
(223, 'Tuvalu', 'tv'),
(224, 'Uganda', 'ug'),
(225, 'Ukraine', 'ua'),
(226, 'United Arab Emirates', 'ae'),
(227, 'United Kingdom', 'gb'),
(228, 'United States', 'us'),
(229, 'United States Minor Outlying Islands', 'um'),
(230, 'Uruguay', 'uy'),
(231, 'Uzbekistan', 'uz'),
(232, 'Vanuatu', 'vu'),
(233, 'Venezuela', 've'),
(234, 'Viet Nam', 'vn'),
(235, 'Virgin Islands, British', 'vg'),
(236, 'Virgin Islands, U.s.', 'vi'),
(237, 'Wallis And Futuna', 'wf'),
(238, 'Western Sahara', 'eh'),
(239, 'Yemen', 'ye'),
(240, 'Zambia', 'zm'),
(241, 'Zimbabwe', 'zw');

-- --------------------------------------------------------

--
-- Structure de la table `countrytranslation`
--

CREATE TABLE IF NOT EXISTS `countrytranslation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_41FF00AD2C2AC5D34180C698` (`translatable_id`,`locale`),
  KEY `IDX_41FF00AD2C2AC5D3` (`translatable_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=483 ;

--
-- Contenu de la table `countrytranslation`
--

INSERT INTO `countrytranslation` (`id`, `translatable_id`, `title`, `locale`) VALUES
(1, 1, 'Afghanistan', 'fr'),
(2, 1, 'Afghanistan', 'en'),
(3, 2, 'Albania', 'fr'),
(4, 2, 'Albania', 'en'),
(5, 3, 'Algeria', 'fr'),
(6, 3, 'Algeria', 'en'),
(7, 4, 'American Samoa', 'fr'),
(8, 4, 'American Samoa', 'en'),
(9, 5, 'Andorra', 'fr'),
(10, 5, 'Andorra', 'en'),
(11, 6, 'Angola', 'fr'),
(12, 6, 'Angola', 'en'),
(13, 7, 'Anguilla', 'fr'),
(14, 7, 'Anguilla', 'en'),
(15, 8, 'Antarctica', 'fr'),
(16, 8, 'Antarctica', 'en'),
(17, 9, 'Antigua And Barbuda', 'fr'),
(18, 9, 'Antigua And Barbuda', 'en'),
(19, 10, 'Argentina', 'fr'),
(20, 10, 'Argentina', 'en'),
(21, 11, 'Armenia', 'fr'),
(22, 11, 'Armenia', 'en'),
(23, 12, 'Aruba', 'fr'),
(24, 12, 'Aruba', 'en'),
(25, 13, 'Australia', 'fr'),
(26, 13, 'Australia', 'en'),
(27, 14, 'Austria', 'fr'),
(28, 14, 'Austria', 'en'),
(29, 15, 'Azerbaijan', 'fr'),
(30, 15, 'Azerbaijan', 'en'),
(31, 16, 'Bahamas', 'fr'),
(32, 16, 'Bahamas', 'en'),
(33, 17, 'Bahrain', 'fr'),
(34, 17, 'Bahrain', 'en'),
(35, 18, 'Bangladesh', 'fr'),
(36, 18, 'Bangladesh', 'en'),
(37, 19, 'Barbados', 'fr'),
(38, 19, 'Barbados', 'en'),
(39, 20, 'Belarus', 'fr'),
(40, 20, 'Belarus', 'en'),
(41, 21, 'Belgium', 'fr'),
(42, 21, 'Belgium', 'en'),
(43, 22, 'Belize', 'fr'),
(44, 22, 'Belize', 'en'),
(45, 23, 'Benin', 'fr'),
(46, 23, 'Benin', 'en'),
(47, 24, 'Bermuda', 'fr'),
(48, 24, 'Bermuda', 'en'),
(49, 25, 'Bhutan', 'fr'),
(50, 25, 'Bhutan', 'en'),
(51, 26, 'Bolivia', 'fr'),
(52, 26, 'Bolivia', 'en'),
(53, 27, 'Bosnia And Herzegovina', 'fr'),
(54, 27, 'Bosnia And Herzegovina', 'en'),
(55, 28, 'Botswana', 'fr'),
(56, 28, 'Botswana', 'en'),
(57, 29, 'Bouvet Island', 'fr'),
(58, 29, 'Bouvet Island', 'en'),
(59, 30, 'Brazil', 'fr'),
(60, 30, 'Brazil', 'en'),
(61, 31, 'British Indian Ocean Territory', 'fr'),
(62, 31, 'British Indian Ocean Territory', 'en'),
(63, 32, 'Brunei Darussalam', 'fr'),
(64, 32, 'Brunei Darussalam', 'en'),
(65, 33, 'Bulgaria', 'fr'),
(66, 33, 'Bulgaria', 'en'),
(67, 34, 'Burkina Faso', 'fr'),
(68, 34, 'Burkina Faso', 'en'),
(69, 35, 'Burundi', 'fr'),
(70, 35, 'Burundi', 'en'),
(71, 36, 'Cambodia', 'fr'),
(72, 36, 'Cambodia', 'en'),
(73, 37, 'Cameroon', 'fr'),
(74, 37, 'Cameroon', 'en'),
(75, 38, 'Canada', 'fr'),
(76, 38, 'Canada', 'en'),
(77, 39, 'Cape Verde', 'fr'),
(78, 39, 'Cape Verde', 'en'),
(79, 40, 'Cayman Islands', 'fr'),
(80, 40, 'Cayman Islands', 'en'),
(81, 41, 'Central African Republic', 'fr'),
(82, 41, 'Central African Republic', 'en'),
(83, 42, 'Chad', 'fr'),
(84, 42, 'Chad', 'en'),
(85, 43, 'Chile', 'fr'),
(86, 43, 'Chile', 'en'),
(87, 44, 'China', 'fr'),
(88, 44, 'China', 'en'),
(89, 45, 'Christmas Island', 'fr'),
(90, 45, 'Christmas Island', 'en'),
(91, 46, 'Cocos (keeling) Islands', 'fr'),
(92, 46, 'Cocos (keeling) Islands', 'en'),
(93, 47, 'Colombia', 'fr'),
(94, 47, 'Colombia', 'en'),
(95, 48, 'Comoros', 'fr'),
(96, 48, 'Comoros', 'en'),
(97, 49, 'Congo', 'fr'),
(98, 49, 'Congo', 'en'),
(99, 50, 'Congo, The Democratic Republic Of The', 'fr'),
(100, 50, 'Congo, The Democratic Republic Of The', 'en'),
(101, 51, 'Cook Islands', 'fr'),
(102, 51, 'Cook Islands', 'en'),
(103, 52, 'Costa Rica', 'fr'),
(104, 52, 'Costa Rica', 'en'),
(105, 53, 'Cote D''ivoire', 'fr'),
(106, 53, 'Cote D''ivoire', 'en'),
(107, 54, 'Croatia', 'fr'),
(108, 54, 'Croatia', 'en'),
(109, 55, 'Cuba', 'fr'),
(110, 55, 'Cuba', 'en'),
(111, 56, 'Cyprus', 'fr'),
(112, 56, 'Cyprus', 'en'),
(113, 57, 'Czech Republic', 'fr'),
(114, 57, 'Czech Republic', 'en'),
(115, 58, 'Denmark', 'fr'),
(116, 58, 'Denmark', 'en'),
(117, 59, 'Djibouti', 'fr'),
(118, 59, 'Djibouti', 'en'),
(119, 60, 'Dominica', 'fr'),
(120, 60, 'Dominica', 'en'),
(121, 61, 'Dominican Republic', 'fr'),
(122, 61, 'Dominican Republic', 'en'),
(123, 62, 'East Timor', 'fr'),
(124, 62, 'East Timor', 'en'),
(125, 63, 'Ecuador', 'fr'),
(126, 63, 'Ecuador', 'en'),
(127, 64, 'Egypt', 'fr'),
(128, 64, 'Egypt', 'en'),
(129, 65, 'El Salvador', 'fr'),
(130, 65, 'El Salvador', 'en'),
(131, 66, 'Equatorial Guinea', 'fr'),
(132, 66, 'Equatorial Guinea', 'en'),
(133, 67, 'Eritrea', 'fr'),
(134, 67, 'Eritrea', 'en'),
(135, 68, 'Estonia', 'fr'),
(136, 68, 'Estonia', 'en'),
(137, 69, 'Ethiopia', 'fr'),
(138, 69, 'Ethiopia', 'en'),
(139, 70, 'Falkland Islands (malvinas)', 'fr'),
(140, 70, 'Falkland Islands (malvinas)', 'en'),
(141, 71, 'Faroe Islands', 'fr'),
(142, 71, 'Faroe Islands', 'en'),
(143, 72, 'Fiji', 'fr'),
(144, 72, 'Fiji', 'en'),
(145, 73, 'Finland', 'fr'),
(146, 73, 'Finland', 'en'),
(147, 74, 'France', 'fr'),
(148, 74, 'France', 'en'),
(149, 75, 'French Guiana', 'fr'),
(150, 75, 'French Guiana', 'en'),
(151, 76, 'French Polynesia', 'fr'),
(152, 76, 'French Polynesia', 'en'),
(153, 77, 'French Southern Territories', 'fr'),
(154, 77, 'French Southern Territories', 'en'),
(155, 78, 'Gabon', 'fr'),
(156, 78, 'Gabon', 'en'),
(157, 79, 'Gambia', 'fr'),
(158, 79, 'Gambia', 'en'),
(159, 80, 'Georgia', 'fr'),
(160, 80, 'Georgia', 'en'),
(161, 81, 'Germany', 'fr'),
(162, 81, 'Germany', 'en'),
(163, 82, 'Ghana', 'fr'),
(164, 82, 'Ghana', 'en'),
(165, 83, 'Gibraltar', 'fr'),
(166, 83, 'Gibraltar', 'en'),
(167, 84, 'Greece', 'fr'),
(168, 84, 'Greece', 'en'),
(169, 85, 'Greenland', 'fr'),
(170, 85, 'Greenland', 'en'),
(171, 86, 'Grenada', 'fr'),
(172, 86, 'Grenada', 'en'),
(173, 87, 'Guadeloupe', 'fr'),
(174, 87, 'Guadeloupe', 'en'),
(175, 88, 'Guam', 'fr'),
(176, 88, 'Guam', 'en'),
(177, 89, 'Guatemala', 'fr'),
(178, 89, 'Guatemala', 'en'),
(179, 90, 'Guinea', 'fr'),
(180, 90, 'Guinea', 'en'),
(181, 91, 'Guinea-bissau', 'fr'),
(182, 91, 'Guinea-bissau', 'en'),
(183, 92, 'Guyana', 'fr'),
(184, 92, 'Guyana', 'en'),
(185, 93, 'Haiti', 'fr'),
(186, 93, 'Haiti', 'en'),
(187, 94, 'Heard Island And Mcdonald Islands', 'fr'),
(188, 94, 'Heard Island And Mcdonald Islands', 'en'),
(189, 95, 'Holy See (vatican City State)', 'fr'),
(190, 95, 'Holy See (vatican City State)', 'en'),
(191, 96, 'Honduras', 'fr'),
(192, 96, 'Honduras', 'en'),
(193, 97, 'Hong Kong', 'fr'),
(194, 97, 'Hong Kong', 'en'),
(195, 98, 'Hungary', 'fr'),
(196, 98, 'Hungary', 'en'),
(197, 99, 'Iceland', 'fr'),
(198, 99, 'Iceland', 'en'),
(199, 100, 'India', 'fr'),
(200, 100, 'India', 'en'),
(201, 101, 'Indonesia', 'fr'),
(202, 101, 'Indonesia', 'en'),
(203, 102, 'Iran, Islamic Republic Of', 'fr'),
(204, 102, 'Iran, Islamic Republic Of', 'en'),
(205, 103, 'Iraq', 'fr'),
(206, 103, 'Iraq', 'en'),
(207, 104, 'Ireland', 'fr'),
(208, 104, 'Ireland', 'en'),
(209, 105, 'Israel', 'fr'),
(210, 105, 'Israel', 'en'),
(211, 106, 'Italy', 'fr'),
(212, 106, 'Italy', 'en'),
(213, 107, 'Jamaica', 'fr'),
(214, 107, 'Jamaica', 'en'),
(215, 108, 'Japan', 'fr'),
(216, 108, 'Japan', 'en'),
(217, 109, 'Jordan', 'fr'),
(218, 109, 'Jordan', 'en'),
(219, 110, 'Kazakstan', 'fr'),
(220, 110, 'Kazakstan', 'en'),
(221, 111, 'Kenya', 'fr'),
(222, 111, 'Kenya', 'en'),
(223, 112, 'Kiribati', 'fr'),
(224, 112, 'Kiribati', 'en'),
(225, 113, 'Korea, Democratic People''s Republic Of', 'fr'),
(226, 113, 'Korea, Democratic People''s Republic Of', 'en'),
(227, 114, 'Korea, Republic Of', 'fr'),
(228, 114, 'Korea, Republic Of', 'en'),
(229, 115, 'Kosovo', 'fr'),
(230, 115, 'Kosovo', 'en'),
(231, 116, 'Kuwait', 'fr'),
(232, 116, 'Kuwait', 'en'),
(233, 117, 'Kyrgyzstan', 'fr'),
(234, 117, 'Kyrgyzstan', 'en'),
(235, 118, 'Lao People''s Democratic Republic', 'fr'),
(236, 118, 'Lao People''s Democratic Republic', 'en'),
(237, 119, 'Latvia', 'fr'),
(238, 119, 'Latvia', 'en'),
(239, 120, 'Lebanon', 'fr'),
(240, 120, 'Lebanon', 'en'),
(241, 121, 'Lesotho', 'fr'),
(242, 121, 'Lesotho', 'en'),
(243, 122, 'Liberia', 'fr'),
(244, 122, 'Liberia', 'en'),
(245, 123, 'Libyan Arab Jamahiriya', 'fr'),
(246, 123, 'Libyan Arab Jamahiriya', 'en'),
(247, 124, 'Liechtenstein', 'fr'),
(248, 124, 'Liechtenstein', 'en'),
(249, 125, 'Lithuania', 'fr'),
(250, 125, 'Lithuania', 'en'),
(251, 126, 'Luxembourg', 'fr'),
(252, 126, 'Luxembourg', 'en'),
(253, 127, 'Macau', 'fr'),
(254, 127, 'Macau', 'en'),
(255, 128, 'Macedonia, The Former Yugoslav Republic Of', 'fr'),
(256, 128, 'Macedonia, The Former Yugoslav Republic Of', 'en'),
(257, 129, 'Madagascar', 'fr'),
(258, 129, 'Madagascar', 'en'),
(259, 130, 'Malawi', 'fr'),
(260, 130, 'Malawi', 'en'),
(261, 131, 'Malaysia', 'fr'),
(262, 131, 'Malaysia', 'en'),
(263, 132, 'Maldives', 'fr'),
(264, 132, 'Maldives', 'en'),
(265, 133, 'Mali', 'fr'),
(266, 133, 'Mali', 'en'),
(267, 134, 'Malta', 'fr'),
(268, 134, 'Malta', 'en'),
(269, 135, 'Marshall Islands', 'fr'),
(270, 135, 'Marshall Islands', 'en'),
(271, 136, 'Martinique', 'fr'),
(272, 136, 'Martinique', 'en'),
(273, 137, 'Mauritania', 'fr'),
(274, 137, 'Mauritania', 'en'),
(275, 138, 'Mauritius', 'fr'),
(276, 138, 'Mauritius', 'en'),
(277, 139, 'Mayotte', 'fr'),
(278, 139, 'Mayotte', 'en'),
(279, 140, 'Mexico', 'fr'),
(280, 140, 'Mexico', 'en'),
(281, 141, 'Micronesia, Federated States Of', 'fr'),
(282, 141, 'Micronesia, Federated States Of', 'en'),
(283, 142, 'Moldova, Republic Of', 'fr'),
(284, 142, 'Moldova, Republic Of', 'en'),
(285, 143, 'Monaco', 'fr'),
(286, 143, 'Monaco', 'en'),
(287, 144, 'Mongolia', 'fr'),
(288, 144, 'Mongolia', 'en'),
(289, 145, 'Montserrat', 'fr'),
(290, 145, 'Montserrat', 'en'),
(291, 146, 'Montenegro', 'fr'),
(292, 146, 'Montenegro', 'en'),
(293, 147, 'Morocco', 'fr'),
(294, 147, 'Morocco', 'en'),
(295, 148, 'Mozambique', 'fr'),
(296, 148, 'Mozambique', 'en'),
(297, 149, 'Myanmar', 'fr'),
(298, 149, 'Myanmar', 'en'),
(299, 150, 'Namibia', 'fr'),
(300, 150, 'Namibia', 'en'),
(301, 151, 'Nauru', 'fr'),
(302, 151, 'Nauru', 'en'),
(303, 152, 'Nepal', 'fr'),
(304, 152, 'Nepal', 'en'),
(305, 153, 'Netherlands', 'fr'),
(306, 153, 'Netherlands', 'en'),
(307, 154, 'Netherlands Antilles', 'fr'),
(308, 154, 'Netherlands Antilles', 'en'),
(309, 155, 'New Caledonia', 'fr'),
(310, 155, 'New Caledonia', 'en'),
(311, 156, 'New Zealand', 'fr'),
(312, 156, 'New Zealand', 'en'),
(313, 157, 'Nicaragua', 'fr'),
(314, 157, 'Nicaragua', 'en'),
(315, 158, 'Niger', 'fr'),
(316, 158, 'Niger', 'en'),
(317, 159, 'Nigeria', 'fr'),
(318, 159, 'Nigeria', 'en'),
(319, 160, 'Niue', 'fr'),
(320, 160, 'Niue', 'en'),
(321, 161, 'Norfolk Island', 'fr'),
(322, 161, 'Norfolk Island', 'en'),
(323, 162, 'Northern Mariana Islands', 'fr'),
(324, 162, 'Northern Mariana Islands', 'en'),
(325, 163, 'Norway', 'fr'),
(326, 163, 'Norway', 'en'),
(327, 164, 'Oman', 'fr'),
(328, 164, 'Oman', 'en'),
(329, 165, 'Pakistan', 'fr'),
(330, 165, 'Pakistan', 'en'),
(331, 166, 'Palau', 'fr'),
(332, 166, 'Palau', 'en'),
(333, 167, 'Palestinian Territory, Occupied', 'fr'),
(334, 167, 'Palestinian Territory, Occupied', 'en'),
(335, 168, 'Panama', 'fr'),
(336, 168, 'Panama', 'en'),
(337, 169, 'Papua New Guinea', 'fr'),
(338, 169, 'Papua New Guinea', 'en'),
(339, 170, 'Paraguay', 'fr'),
(340, 170, 'Paraguay', 'en'),
(341, 171, 'Peru', 'fr'),
(342, 171, 'Peru', 'en'),
(343, 172, 'Philippines', 'fr'),
(344, 172, 'Philippines', 'en'),
(345, 173, 'Pitcairn', 'fr'),
(346, 173, 'Pitcairn', 'en'),
(347, 174, 'Poland', 'fr'),
(348, 174, 'Poland', 'en'),
(349, 175, 'Portugal', 'fr'),
(350, 175, 'Portugal', 'en'),
(351, 176, 'Puerto Rico', 'fr'),
(352, 176, 'Puerto Rico', 'en'),
(353, 177, 'Qatar', 'fr'),
(354, 177, 'Qatar', 'en'),
(355, 178, 'Reunion', 'fr'),
(356, 178, 'Reunion', 'en'),
(357, 179, 'Romania', 'fr'),
(358, 179, 'Romania', 'en'),
(359, 180, 'Russian Federation', 'fr'),
(360, 180, 'Russian Federation', 'en'),
(361, 181, 'Rwanda', 'fr'),
(362, 181, 'Rwanda', 'en'),
(363, 182, 'Saint Helena', 'fr'),
(364, 182, 'Saint Helena', 'en'),
(365, 183, 'Saint Kitts And Nevis', 'fr'),
(366, 183, 'Saint Kitts And Nevis', 'en'),
(367, 184, 'Saint Lucia', 'fr'),
(368, 184, 'Saint Lucia', 'en'),
(369, 185, 'Saint Pierre And Miquelon', 'fr'),
(370, 185, 'Saint Pierre And Miquelon', 'en'),
(371, 186, 'Saint Vincent And The Grenadines', 'fr'),
(372, 186, 'Saint Vincent And The Grenadines', 'en'),
(373, 187, 'Samoa', 'fr'),
(374, 187, 'Samoa', 'en'),
(375, 188, 'San Marino', 'fr'),
(376, 188, 'San Marino', 'en'),
(377, 189, 'Sao Tome And Principe', 'fr'),
(378, 189, 'Sao Tome And Principe', 'en'),
(379, 190, 'Saudi Arabia', 'fr'),
(380, 190, 'Saudi Arabia', 'en'),
(381, 191, 'Senegal', 'fr'),
(382, 191, 'Senegal', 'en'),
(383, 192, 'Serbia', 'fr'),
(384, 192, 'Serbia', 'en'),
(385, 193, 'Seychelles', 'fr'),
(386, 193, 'Seychelles', 'en'),
(387, 194, 'Sierra Leone', 'fr'),
(388, 194, 'Sierra Leone', 'en'),
(389, 195, 'Singapore', 'fr'),
(390, 195, 'Singapore', 'en'),
(391, 196, 'Slovakia', 'fr'),
(392, 196, 'Slovakia', 'en'),
(393, 197, 'Slovenia', 'fr'),
(394, 197, 'Slovenia', 'en'),
(395, 198, 'Solomon Islands', 'fr'),
(396, 198, 'Solomon Islands', 'en'),
(397, 199, 'Somalia', 'fr'),
(398, 199, 'Somalia', 'en'),
(399, 200, 'South Africa', 'fr'),
(400, 200, 'South Africa', 'en'),
(401, 201, 'South Georgia And The South Sandwich Islands', 'fr'),
(402, 201, 'South Georgia And The South Sandwich Islands', 'en'),
(403, 202, 'Spain', 'fr'),
(404, 202, 'Spain', 'en'),
(405, 203, 'Sri Lanka', 'fr'),
(406, 203, 'Sri Lanka', 'en'),
(407, 204, 'Sudan', 'fr'),
(408, 204, 'Sudan', 'en'),
(409, 205, 'Suriname', 'fr'),
(410, 205, 'Suriname', 'en'),
(411, 206, 'Svalbard And Jan Mayen', 'fr'),
(412, 206, 'Svalbard And Jan Mayen', 'en'),
(413, 207, 'Swaziland', 'fr'),
(414, 207, 'Swaziland', 'en'),
(415, 208, 'Sweden', 'fr'),
(416, 208, 'Sweden', 'en'),
(417, 209, 'Switzerland', 'fr'),
(418, 209, 'Switzerland', 'en'),
(419, 210, 'Syrian Arab Republic', 'fr'),
(420, 210, 'Syrian Arab Republic', 'en'),
(421, 211, 'Taiwan, Province Of China', 'fr'),
(422, 211, 'Taiwan, Province Of China', 'en'),
(423, 212, 'Tajikistan', 'fr'),
(424, 212, 'Tajikistan', 'en'),
(425, 213, 'Tanzania, United Republic Of', 'fr'),
(426, 213, 'Tanzania, United Republic Of', 'en'),
(427, 214, 'Thailand', 'fr'),
(428, 214, 'Thailand', 'en'),
(429, 215, 'Togo', 'fr'),
(430, 215, 'Togo', 'en'),
(431, 216, 'Tokelau', 'fr'),
(432, 216, 'Tokelau', 'en'),
(433, 217, 'Tonga', 'fr'),
(434, 217, 'Tonga', 'en'),
(435, 218, 'Trinidad And Tobago', 'fr'),
(436, 218, 'Trinidad And Tobago', 'en'),
(437, 219, 'Tunisia', 'fr'),
(438, 219, 'Tunisia', 'en'),
(439, 220, 'Turkey', 'fr'),
(440, 220, 'Turkey', 'en'),
(441, 221, 'Turkmenistan', 'fr'),
(442, 221, 'Turkmenistan', 'en'),
(443, 222, 'Turks And Caicos Islands', 'fr'),
(444, 222, 'Turks And Caicos Islands', 'en'),
(445, 223, 'Tuvalu', 'fr'),
(446, 223, 'Tuvalu', 'en'),
(447, 224, 'Uganda', 'fr'),
(448, 224, 'Uganda', 'en'),
(449, 225, 'Ukraine', 'fr'),
(450, 225, 'Ukraine', 'en'),
(451, 226, 'United Arab Emirates', 'fr'),
(452, 226, 'United Arab Emirates', 'en'),
(453, 227, 'United Kingdom', 'fr'),
(454, 227, 'United Kingdom', 'en'),
(455, 228, 'United States', 'fr'),
(456, 228, 'United States', 'en'),
(457, 229, 'United States Minor Outlying Islands', 'fr'),
(458, 229, 'United States Minor Outlying Islands', 'en'),
(459, 230, 'Uruguay', 'fr'),
(460, 230, 'Uruguay', 'en'),
(461, 231, 'Uzbekistan', 'fr'),
(462, 231, 'Uzbekistan', 'en'),
(463, 232, 'Vanuatu', 'fr'),
(464, 232, 'Vanuatu', 'en'),
(465, 233, 'Venezuela', 'fr'),
(466, 233, 'Venezuela', 'en'),
(467, 234, 'Viet Nam', 'fr'),
(468, 234, 'Viet Nam', 'en'),
(469, 235, 'Virgin Islands, British', 'fr'),
(470, 235, 'Virgin Islands, British', 'en'),
(471, 236, 'Virgin Islands, U.s.', 'fr'),
(472, 236, 'Virgin Islands, U.s.', 'en'),
(473, 237, 'Wallis And Futuna', 'fr'),
(474, 237, 'Wallis And Futuna', 'en'),
(475, 238, 'Western Sahara', 'fr'),
(476, 238, 'Western Sahara', 'en'),
(477, 239, 'Yemen', 'fr'),
(478, 239, 'Yemen', 'en'),
(479, 240, 'Zambia', 'fr'),
(480, 240, 'Zambia', 'en'),
(481, 241, 'Zimbabwe', 'fr'),
(482, 241, 'Zimbabwe', 'en');

-- --------------------------------------------------------

--
-- Structure de la table `enquiry`
--

CREATE TABLE IF NOT EXISTS `enquiry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Contenu de la table `enquiry`
--

INSERT INTO `enquiry` (`id`, `name`, `email`, `message`, `subject`) VALUES
(1, 'jerome', 'test@test.com', 'test', 'test wds'),
(2, 'jerome', 'test@test.com', 'fdgdsf', 'test wds'),
(3, 'jerome', 'test@test.com', 'dsfg', 'test wds'),
(4, 'jerome', 'test@test.com', 'test', 'test wds'),
(5, 'jerome', 'test@test.com', 'test', 'test wds'),
(6, 'jerome', 'test@test.com', 'wds', 'test wds'),
(7, 'jerome', 'test@test.com', 'test', 'test wds'),
(8, 'jerome', 'jeje@yopmail.com', 'tes wds dev', 'test wds'),
(9, 'jerome', 'jeje@yopmail.com', 'test wds prod', 'test wds'),
(10, 'GRZELAK Guewndoline', 'guewndoline@msn.com', 'Hello,\r\nJ''essaie juste l''envoi de mails ;-)\r\nBisous !', 'essai'),
(11, 'tchamitane', 'pluie@yop.com', 'COUCOU!', 'pleut-il demain?'),
(12, 'Beate', 'b_k83@hotmail.com', 'Hello Jérôme,\r\nhere are some of my comments on your new website. Btw, I like the design.\r\nJe consulte Welovesalsa sur mon petit ordinateur portable à la maison :\r\n- page d''accueil: la date qui s''affiche est 201 et non 2014\r\n- dans le texte en anglais il manque un article (this/the) et, dans la même phrase, \r\n- je mettrais "website" à la place de "page" (you can help by sharing __this website__)\r\n- dancers'' skills prend un apostrophe, c''est un génitif\r\n- l''onglet "sitemap" ne mène nullepart, ni dans la version anglaise, ni dans la version française. \r\n\r\nJ''ai lu les titres de la "Privacy Policy", deux suggestions :\r\n-  3. Products avec P majuscule; \r\n6. Privacy, respect your privacy : Privacy, respect __of__ your privacy\r\n- Le lien de contact donné dans ce paragraphe 6 WeDanceSalsa.com/contact ne fonctionne pas, voici ce qu''il s''affiche :  No route found for "GET /contact"\r\n404 Not Found - NotFoundHttpException\r\n1 linked Exception: ResourceNotFoundException »\r\n\r\nVersion française du site :\r\n- l''encadré s''affiche mal, la mention "Contactez Nous" se superpose partiellement au texte.\r\n\r\nA propos de "Contactez Nous" : \r\n1/ nous en minuscules\r\n2/ En bas de la page, tu marques "CONTACTES NOUS" attention pas de S à l''impératif! Si tu veux tutoyer les gens, "contacte nous", ou alors, si tu les vouvoies ou t''adresses à plusieurs personnes, "contactez nous".\r\n\r\nLa version française dit "Publier votre événement!"\r\nSi tu veux donner juste l''info, il ne faut pas mettre le point d''exclamation. Parce que avec le point d''exclamation ça devient un impératif et il faudra alors mettre "Publiez votre événement"\r\n\r\nje regarde le reste après. Bon courage, bisous !', 'this is a test message');

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `eventType_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FA6F25A3C15B25DE` (`eventType_id`),
  KEY `IDX_FA6F25A3A76ED395` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=38 ;

--
-- Contenu de la table `event`
--

INSERT INTO `event` (`id`, `user_id`, `name`, `eventType_id`) VALUES
(1, 1, 'macumba-salsa-club-dj-all-stars', 1),
(2, 1, 'latin-sensation', 1),
(3, 1, 'festival-international-cubano-2014', 2),
(4, 1, 'latin-cocktail-la-regie-v-ascq', 1),
(5, 1, 'dursin-salsa-bachata-kiz-party', 1),
(6, 1, 'cuban-exclusive', 1),
(7, 1, 'lille-festival-kizomba-connection-2014', 2),
(8, 1, 'soiree-tango', 1),
(9, 1, 'sunday-dance-cours-de-kizomba-salsa-gratuit', 1),
(10, 1, 'soiree-salsa-cuba-si', 1),
(11, 1, 'les-danseurs-du-nord-au-paris-bachata-festival-ave', 2),
(12, 1, 'concert-live-salsa-pata-negra-dj-diaf-mix-live-kiz', 1),
(13, 1, 'l-afro-latin-social-dance-continent-lille', 1),
(14, 1, 'soiree-afrolatin-st-catherine-hacienda-des-saveurs', 1),
(15, 1, 'soiree-kizomba-cours-de-semba-de-roda', 1),
(16, 1, 'cours-de-bachata', 4),
(17, 1, 'cours-de-danses-latinas-au-macondo', 4),
(18, 21, 'timba-con-funk-8', 1),
(19, 22, 'cubana-bar-lens', 4),
(20, 25, 'milonga-tango-kortrijk', 1),
(21, 26, 'vendredi-5-12-diablito-latino-le-retour-soiree-de-', 7),
(22, 26, 'vendredi-5-12-diablito-latino-le-retour-soiree-de-', 7),
(23, 26, 'vendredi-diablito-latino-le-retour-soiree-de-re-ou', 7),
(24, 1, 'cours-de-salsa-gratuit', 7),
(25, 1, 'salsa-party-n-2-st-quentin', 1),
(26, 1, 'dursin-salsa-bachata-kiz-party', 1),
(27, 1, 'soire-a-lo-cubano', 7),
(28, 1, 'les-vendredis-latinos-calientes-au-diablito-latino', 7),
(29, 1, 'stage-de-rueda', 3),
(30, 1, 'stages-de-salsa-et-salsa-con-rumba-avec-cafe-con-l', 3),
(31, 1, 'afro-latin-party-spcial-galette-des-rois-et-reines', 7),
(32, 1, 'dursin-new-years-party-2015-salsa-bachata-kiz', 1),
(33, 1, 'salsa-hits-b-floor-lille', 7),
(34, 1, 'salsa-chic', 7),
(35, 1, 'kizomba-niveau-avanc-jeremy-et-allyson-by-l-a-paix', 4),
(36, 27, 'havana-en-belgrado-stage-salsa', 7),
(37, 27, 'havana-en-belgrado-stage-salsa', 7);

-- --------------------------------------------------------

--
-- Structure de la table `eventdate`
--

CREATE TABLE IF NOT EXISTS `eventdate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startdate` date NOT NULL,
  `stopdate` date DEFAULT NULL,
  `starttime` time DEFAULT NULL,
  `stoptime` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=117 ;

--
-- Contenu de la table `eventdate`
--

INSERT INTO `eventdate` (`id`, `startdate`, `stopdate`, `starttime`, `stoptime`) VALUES
(1, '2014-10-12', '2014-10-13', '21:30:00', '00:00:00'),
(2, '2014-11-15', '2014-11-16', '09:30:00', '09:30:00'),
(3, '2014-10-31', '2014-11-03', '07:00:00', '03:00:00'),
(4, '2014-11-01', '2014-11-02', '21:00:00', '03:00:00'),
(5, '2014-10-24', '2014-10-25', '21:00:00', '09:00:00'),
(6, '2014-10-17', '2014-10-19', '22:00:00', '02:00:00'),
(7, '2014-10-25', '2014-10-26', '20:00:00', '00:00:00'),
(8, '2014-10-25', '2014-10-26', '21:30:00', '02:00:00'),
(9, '2014-10-26', '2014-10-26', '17:00:00', '20:00:00'),
(10, '2014-11-16', NULL, '16:30:00', NULL),
(11, '2014-11-23', NULL, '16:30:00', NULL),
(12, '2014-11-30', NULL, '16:30:00', NULL),
(13, '2014-12-07', NULL, '16:30:00', NULL),
(14, '2014-12-14', NULL, '16:30:00', NULL),
(15, '2014-12-21', NULL, '16:30:00', NULL),
(16, '2014-12-28', NULL, '16:30:00', NULL),
(17, '2014-11-16', NULL, '19:30:00', NULL),
(18, '2014-12-21', NULL, '19:30:00', NULL),
(19, '2014-11-21', NULL, '00:00:00', NULL),
(20, '2014-11-21', NULL, '20:30:00', NULL),
(21, '2014-11-21', NULL, '21:00:00', NULL),
(22, '2014-12-19', NULL, '21:00:00', NULL),
(23, '2015-01-16', NULL, '21:00:00', NULL),
(24, '2014-11-22', NULL, '21:00:00', NULL),
(25, '2014-11-26', NULL, '20:00:00', NULL),
(26, '2014-11-17', NULL, '20:30:00', NULL),
(27, '2014-11-24', NULL, '20:30:00', NULL),
(28, '2014-12-01', NULL, '20:30:00', NULL),
(29, '2014-12-08', NULL, '20:30:00', NULL),
(30, '2014-12-15', NULL, '20:30:00', NULL),
(31, '2014-12-22', NULL, '20:30:00', NULL),
(32, '2014-12-29', NULL, '20:30:00', NULL),
(33, '2014-11-17', NULL, '20:30:00', NULL),
(34, '2014-11-24', NULL, '20:30:00', NULL),
(35, '2014-12-01', NULL, '20:30:00', NULL),
(36, '2014-12-08', NULL, '20:30:00', NULL),
(37, '2014-12-15', NULL, '20:30:00', NULL),
(38, '2014-12-22', NULL, '20:30:00', NULL),
(39, '2014-12-29', NULL, '20:30:00', NULL),
(40, '2014-11-25', NULL, '20:00:00', NULL),
(41, '2014-11-29', NULL, '20:00:00', NULL),
(42, '2014-11-26', NULL, '20:00:00', NULL),
(43, '2014-12-03', NULL, '20:00:00', NULL),
(44, '2014-12-10', NULL, '20:00:00', NULL),
(45, '2014-12-17', NULL, '20:00:00', NULL),
(46, '2014-12-24', NULL, '20:00:00', NULL),
(47, '2014-12-31', NULL, '20:00:00', NULL),
(48, '2014-11-26', NULL, '20:00:00', NULL),
(49, '2014-12-03', NULL, '20:00:00', NULL),
(50, '2014-12-10', NULL, '20:00:00', NULL),
(51, '2014-12-17', NULL, '20:00:00', NULL),
(52, '2014-12-24', NULL, '20:00:00', NULL),
(53, '2014-12-31', NULL, '20:00:00', NULL),
(55, '2014-12-04', NULL, '20:00:00', NULL),
(56, '2014-12-11', NULL, '20:00:00', NULL),
(57, '2014-12-18', NULL, '20:00:00', NULL),
(58, '2014-12-04', NULL, '20:00:00', NULL),
(59, '2014-12-11', NULL, '20:00:00', NULL),
(60, '2014-12-18', NULL, '20:00:00', NULL),
(61, '2014-12-05', NULL, '20:00:00', NULL),
(62, '2014-12-05', NULL, '20:00:00', NULL),
(63, '2014-12-06', '2014-12-07', '21:00:00', '02:00:00'),
(64, '2014-12-06', '2014-12-07', '21:00:00', '03:00:00'),
(65, '2014-12-10', NULL, '20:00:00', NULL),
(66, '2015-01-02', NULL, '20:00:00', NULL),
(67, '2015-01-09', NULL, '20:00:00', NULL),
(68, '2015-01-16', NULL, '20:00:00', NULL),
(69, '2015-01-23', NULL, '20:00:00', NULL),
(70, '2015-01-30', NULL, '20:00:00', NULL),
(71, '2015-02-06', NULL, '20:00:00', NULL),
(72, '2015-02-13', NULL, '20:00:00', NULL),
(73, '2015-02-20', NULL, '20:00:00', NULL),
(74, '2015-02-27', NULL, '20:00:00', NULL),
(75, '2015-01-02', NULL, '20:00:00', NULL),
(76, '2015-01-09', NULL, '20:00:00', NULL),
(77, '2015-01-16', NULL, '20:00:00', NULL),
(78, '2015-01-23', NULL, '20:00:00', NULL),
(79, '2015-01-30', NULL, '20:00:00', NULL),
(80, '2015-02-06', NULL, '20:00:00', NULL),
(81, '2015-02-13', NULL, '20:00:00', NULL),
(82, '2015-02-20', NULL, '20:00:00', NULL),
(83, '2015-02-27', NULL, '20:00:00', NULL),
(84, '2015-01-03', NULL, '08:00:00', NULL),
(85, '2015-01-03', NULL, '16:30:00', NULL),
(86, '2015-01-03', NULL, '21:00:00', NULL),
(87, '2015-01-03', NULL, '21:00:00', NULL),
(88, '2015-01-09', NULL, '21:00:00', NULL),
(89, '2015-01-10', NULL, '21:00:00', NULL),
(90, '2015-01-11', NULL, '13:30:00', '17:30:00'),
(91, '2015-02-07', NULL, '21:00:00', NULL),
(92, '2015-01-21', NULL, '21:00:00', NULL),
(93, '2015-01-28', NULL, '21:00:00', NULL),
(94, '2015-01-21', NULL, '21:00:00', NULL),
(95, '2015-01-28', NULL, '21:00:00', NULL),
(96, '2015-01-17', '2015-01-18', '09:30:00', '22:00:00'),
(97, '2015-02-02', NULL, '20:30:00', NULL),
(98, '2015-02-09', NULL, '20:30:00', NULL),
(99, '2015-02-16', NULL, '20:30:00', NULL),
(100, '2015-02-23', NULL, '20:30:00', NULL),
(101, '2015-03-02', NULL, '20:30:00', NULL),
(102, '2015-03-09', NULL, '20:30:00', NULL),
(103, '2015-03-16', NULL, '20:30:00', NULL),
(104, '2015-03-23', NULL, '20:30:00', NULL),
(105, '2015-03-30', NULL, '20:30:00', NULL),
(106, '2015-02-02', NULL, '20:30:00', NULL),
(107, '2015-02-09', NULL, '20:30:00', NULL),
(108, '2015-02-16', NULL, '20:30:00', NULL),
(109, '2015-02-23', NULL, '20:30:00', NULL),
(110, '2015-03-02', NULL, '20:30:00', NULL),
(111, '2015-03-09', NULL, '20:30:00', NULL),
(112, '2015-03-16', NULL, '20:30:00', NULL),
(113, '2015-03-23', NULL, '20:30:00', NULL),
(114, '2015-03-30', NULL, '20:30:00', NULL),
(115, '2015-01-31', NULL, '21:30:00', NULL),
(116, '2015-02-13', NULL, '21:00:00', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `eventtranslation`
--

CREATE TABLE IF NOT EXISTS `eventtranslation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1E6F98922C2AC5D34180C698` (`translatable_id`,`locale`),
  KEY `IDX_1E6F98922C2AC5D3` (`translatable_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=48 ;

--
-- Contenu de la table `eventtranslation`
--

INSERT INTO `eventtranslation` (`id`, `translatable_id`, `title`, `description`, `locale`) VALUES
(1, 1, 'MACUMBA SALSA CLUB "Dj All stars"', '<p>---------------------2 Salles, 2 ambiances------------------<br />\r\n-SALSA/BACHATA/KIZOMBA<br />\r\n-MUSIQUE GENERALISTE<br />\r\n<br />\r\nENTREE GRATUITE avec l&rsquo;INFO PASS macumba (d&eacute;pliants d&rsquo;information) pour les filles d&egrave;s 22h.<br />\r\n<br />\r\nO&ugrave; se procurer l&rsquo;INFO PASS MACUMBA ?<br />\r\n-dans de nombreux commerces de Lille<br />\r\n-aupr&egrave;s de SALSA PICANTE<br />\r\n-ou t&eacute;l&eacute;chargez le ici : <a href="http://l.facebook.com/l.php?u=http%3A%2F%2Fwww.salsa-picante.fr%2F1-news-macumba-salsa-club&amp;h=FAQGznogt&amp;enc=AZMaTjWgWh6e6OnYdQ7L7uS0ZJQDprwXRqaNTozlfcyEb7V_bXJYvCUuu_ya9e-r_qc&amp;s=1" target="_blank">http://www.salsa-picante.fr/1-news-macumba-salsa-club</a><br />\r\n<br />\r\n<br />\r\n*21h30-22h initiation bachata avec J&eacute;r&eacute;my et Melissa ADDICT&rsquo;BACHATA<br />\r\n<br />\r\n*22h Dj All Stars, plus de 5 Dj r&eacute;gionaux aux platines pour un maximum de vari&eacute;t&eacute; musicale<br />\r\n<br />\r\nDj El Brujo, Dj Del Pueblo, Dj El Cantante, Dj El Morro, Dj <a href="https://www.facebook.com/haemerlin.blaise">Haemerlin Blaise</a>, Dj <a href="https://www.facebook.com/deejay.lemzo">DeeJay Lemzo</a><br />\r\n<br />\r\nSALSA cubaine, SALSA Hits, SALSA romantique, SALSA portoricaine<br />\r\nBACHATA moderne, BACHATA dominicaine,Kizomba/Semba<br />\r\n<br />\r\n<br />\r\n-Maxi dance floor<br />\r\n-Canap&eacute;s confort<br />\r\n-Easy parking GRATUIT<br />\r\n<br />\r\n--------------------------------------------------------------------------<br />\r\nMacumba- Centre Commercial, 59320 Englos-<br />\r\nPaf 5&euro; (gratuit pour les filles avec &laquo; info pass macumba &raquo;<br />\r\nVestiaire obligatoire<br />\r\n-------------------------------------------------------------------------</p>', 'en'),
(2, 1, 'MACUMBA SALSA CLUB "Dj All stars"', '<p>Dans la boite la plus mythique de la r&eacute;gion de Lille<br />\r\n-----------Dansez la Salsa/Bachata/Kizomba----------<br />\r\n<br />\r\nD&eacute;couvrez ou red&eacute;couvrez ce lieu &agrave; l&rsquo;occasion de soir&eacute;es salsa/bachata<br />\r\n<br />\r\n---------------------2 Salles, 2 ambiances------------------<br />\r\n-SALSA/BACHATA/KIZOMBA<br />\r\n-MUSIQUE GENERALISTE<br />\r\n<br />\r\nENTREE GRATUITE avec l&rsquo;INFO PASS macumba (d&eacute;pliants d&rsquo;information) pour les filles d&egrave;s 22h.<br />\r\n<br />\r\nO&ugrave; se procurer l&rsquo;INFO PASS MACUMBA ?<br />\r\n-dans de nombreux commerces de Lille<br />\r\n-aupr&egrave;s de SALSA PICANTE<br />\r\n-ou t&eacute;l&eacute;chargez le ici : <a href="http://l.facebook.com/l.php?u=http%3A%2F%2Fwww.salsa-picante.fr%2F1-news-macumba-salsa-club&amp;h=FAQGznogt&amp;enc=AZMaTjWgWh6e6OnYdQ7L7uS0ZJQDprwXRqaNTozlfcyEb7V_bXJYvCUuu_ya9e-r_qc&amp;s=1" target="_blank">http://www.salsa-picante.fr/1-news-macumba-salsa-club</a><br />\r\n<br />\r\n<br />\r\n*21h30-22h initiation bachata avec J&eacute;r&eacute;my et Melissa ADDICT&rsquo;BACHATA<br />\r\n<br />\r\n*22h Dj All Stars, plus de 5 Dj r&eacute;gionaux aux platines pour un maximum de vari&eacute;t&eacute; musicale<br />\r\n<br />\r\nDj El Brujo, Dj Del Pueblo, Dj El Cantante, Dj El Morro, Dj <a href="https://www.facebook.com/haemerlin.blaise">Haemerlin Blaise</a>, Dj <a href="https://www.facebook.com/deejay.lemzo">DeeJay Lemzo</a><br />\r\n<br />\r\nSALSA cubaine, SALSA Hits, SALSA romantique, SALSA portoricaine<br />\r\nBACHATA moderne, BACHATA dominicaine,Kizomba/Semba<br />\r\n<br />\r\n<br />\r\n-Maxi dance floor<br />\r\n-Canap&eacute;s confort<br />\r\n-Easy parking GRATUIT<br />\r\n<br />\r\n--------------------------------------------------------------------------<br />\r\nMacumba- Centre Commercial, 59320 Englos-<br />\r\nPaf 5&euro; (gratuit pour les filles avec &laquo; info pass macumba &raquo;<br />\r\nVestiaire obligatoire<br />\r\n-------------------------------------------------------------------------</p>', 'fr'),
(3, 2, 'LATIN SENSATION', '<p>LATIN SENSATION 20 septembre 21h30<br />\r\nNouveau lieu, nouvelle sensation pour de soir&eacute;es<br />\r\n<br />\r\nSalsa/Bachata/Kizomba r&eacute;guli&egrave;res chaque mois<br />\r\n<br />\r\nVoir les photos de l&#39;inauguration<br />\r\n<a href="http://www.salsa-picante.fr/photos-videos" target="_blank">http://www.salsa-picante.fr/photos-videos</a><br />\r\n<br />\r\nAdresse: PADEL SENSATION 9 rue Chappe Villeneuve d&#39;Ascq<br />\r\n<br />\r\n--------------------------------------------------------------------------<br />\r\nPOUR EN SAVOIR PLUS, ET EN VOIR PLUS<br />\r\n<br />\r\nVisitez leur site : <a href="http://l.facebook.com/l.php?u=http%3A%2F%2Fwww.padel-sensation.com%2F&amp;h=NAQF76wPF&amp;enc=AZPTZOyKMrphTahAixsPe0LG4XC3qaENDtHBpPBz_yeqaBADxYrXnBMfIN0r1HFNdgk&amp;s=1" target="_blank">www.padel-sensation.com</a><br />\r\n<br />\r\nLe Lieu en vid&eacute;o : <a href="https://www.facebook.com/l.php?u=https%3A%2F%2Fwww.youtube.com%2Fwatch%3Fv%3DXPtxp0CtS4o%26feature%3Dyoutu.be&amp;h=BAQE6jwTr&amp;enc=AZOJKTCOJGCxNqaRfVLK3NnnJZIiqN1faxlKPILdKQ0T6qRuSmiV8ldZjMBff5g_HVA&amp;s=1" target="_blank">https://www.youtube.com/watch?v=XPtxp0CtS4o&amp;feature=youtu.be</a><br />\r\n--------------------------------------------------------------------------<br />\r\nD&Eacute;COUVERTE DU LIEU<br />\r\n<br />\r\nPadel Sensation et Salsa Picante Lille cr&eacute;ateur de soir&eacute;e salsa, bachata, kizomba pr&eacute;sente votre nouvel espace de danse, pour des soir&eacute;es salsa &agrave; Lille et m&eacute;tropole.<br />\r\n<br />\r\nDanser la salsa &agrave; Lille dans un lieu spacieux, lumineux<br />\r\n<br />\r\nEspace ext&eacute;rieur, espace int&eacute;rieur, petite restauration sur place avec Honey Pie, d&eacute;gustez le mythique Mojito la star des cocktails des soir&eacute;es salsa &agrave; Lille.<br />\r\n<br />\r\n-patio d&eacute;tente ext&eacute;rieur<br />\r\n-espace int&eacute;rieur confortable<br />\r\n-b&eacute;ton cir&eacute; pour danser la salsa facilement<br />\r\n-espace bar et conso petit prix<br />\r\n-&eacute;cran g&eacute;ant<br />\r\n-petite restauration sur place (HONEY PIE)<br />\r\n-Conso tr&egrave;s petit prix<br />\r\n-Easy Parking<br />\r\n<br />\r\n21h30 initiation bachata<br />\r\n22h soir&eacute;e mix&eacute;e par Dj Del pueblo, Del el cantante, et Dj Latin Affair.<br />\r\n<br />\r\nSALSA BACHATA KIZOMBA, il y en aura pour tout le monde<br />\r\n<br />\r\nENTRE GRATUITE<br />\r\nVestiaire obligatoire<br />\r\nConsommation de courtoisie<br />\r\nSortie payante 3&euro; sans consommation<br />\r\n(un jeton vert vous sera remis au bar avec chaque consommation)<br />\r\n<br />\r\nPadel Sensation 9 rue Chappe Villeneuve d&#39;Ascq<br />\r\n<a href="http://www.padel-sensation.com/" target="_blank">www.padel-sensation.com</a><br />\r\n<br />\r\nSalsa Picante Lille<br />\r\n<a href="http://www.salsa-picante.fr/" target="_blank">www.salsa-picante.fr</a><br />\r\n<br />\r\nVIDEO DU LIEU : <a href="https://www.youtube.com/watch?v=XPtxp0CtS4o&amp;feature=youtu.be" target="_blank">https://www.youtube.com/watch?v=XPtxp0CtS4o&amp;feature=youtu.be</a></p>', 'en'),
(4, 2, 'LATIN SENSATION', NULL, 'fr'),
(5, 3, 'FESTIVAL INTERNATIONAL CUBANO 2014', '<p>Passion timba est heureux de vous pr&eacute;senter son Festival International Cubano 2014!!!!<br />\r\n<br />\r\nLes nouveaut&eacute;s du festival:<br />\r\n<br />\r\n- cette ann&eacute;e, nous d&eacute;pla&ccedil;ons le festival &agrave; Orange dans une salle de 1000m2 &agrave; proximit&eacute; de nombreux h&ocirc;tels , autoroutes, gares SNCF....<br />\r\n<br />\r\n- Les cours d&#39;afro-cubains et de rumba seront accompagn&eacute; par les musiciens du groupe OKILAKUA<br />\r\n<br />\r\n<br />\r\n***************************************************************<br />\r\n<br />\r\nLe festival en quelques mots:<br />\r\n<br />\r\n- 3 jours intensifs sur la cultures cubaine, avec des cours sur 3 niveaux, de la d&eacute;couverte au master class!<br />\r\navec la cr&egrave;me des professeurs internationaux!!!!<br />\r\n<br />\r\n- 3 soir&eacute;es avec les meilleurs DJs du moment<br />\r\n<br />\r\n- 1 concert exceptionnel<br />\r\n<br />\r\n***************************************************************<br />\r\n<br />\r\nles artistes:<br />\r\n<br />\r\n- Yanet Fuentes<br />\r\n- Wilmer Y Maria<br />\r\n- Pedrito y su CUBACHE<br />\r\n- Sergio Larrinaga<br />\r\n- Hector Oviedo<br />\r\n- Ismaray Chacon<br />\r\n- Yoannis Tamayo<br />\r\n- Barbara Jiminez<br />\r\n- Alain Morales<br />\r\n- Claudine Giral<br />\r\n<br />\r\nLes DJs<br />\r\n<br />\r\n- DJ Jack Elcalvo<br />\r\n- DJ Diablito<br />\r\n- DJ Mab&ecirc; Yubana DiJi<br />\r\n- DJ Ali Gato<br />\r\n<br />\r\n***************************************************************<br />\r\n<br />\r\n_____________LE PROGRAMME_______________<br />\r\n<br />\r\n****************VENDREDI 31 OCTOBRE ****************<br />\r\n<br />\r\n<br />\r\n-&agrave; partir de 17H30 r&eacute;cup&eacute;rations des Pass.<br />\r\n<br />\r\n-19H00 20H00 cours avec Yanet Fuentes et cours avec <a href="https://www.facebook.com/yoannis.tamayo">Yoannis Tamayo</a><br />\r\n<br />\r\nSoir&eacute;e &laquo;Sals&rsquo;Halloween &raquo;<br />\r\n20H00 &ndash; 23H00 D&icirc;ner spectacle<br />\r\n- Ambiance musicale avec DJ.<br />\r\n- 21h30 Spectacle : A la rencontre des danses Cubaines &amp; Urbaines.<br />\r\n<br />\r\nTARIFS<br />\r\n- en place VIP : 28&euro; (diner devant la sc&egrave;ne + spectacle + soir&eacute;e Sals&rsquo;Halloween)<br />\r\n- Avec full pass: D&icirc;ner &agrave; 15&euro; en suppl&eacute;ment<br />\r\n- Spectacle Gratuit avec le Full Pass<br />\r\n- Entr&eacute;e soir&eacute;e + Spectacle &agrave; partir de 21H00: 18&euro;<br />\r\n- Entr&eacute;e Soir&eacute;e &agrave; partir de 23H00 :12&euro;<br />\r\n<br />\r\nR&eacute;servations pour les repas en place VIP au : 06 95 55 45 40 (au plus tard le mardi 28 Octobre)<br />\r\n<br />\r\n____________________________________________<br />\r\n<br />\r\n23H00-04H00 Soir&eacute;e Sals&rsquo;Halloween<br />\r\nAvec sp&eacute;cialement pour vous faire danser toute la nuit....<br />\r\nDJ JACK EL CALVO (Paris) &amp; DJ MABE (Toulouse)<br />\r\n(dress code : Halloween)<br />\r\n<br />\r\n<br />\r\n*****************SAMEDI 1ER Novembre ****************<br />\r\n<br />\r\n10H00-18H00 cours de danses sur 3 niveaux, du d&eacute;butant au plus avanc&eacute;, accompagn&eacute;s par les musiciens d&rsquo;OKILAKUA<br />\r\n<br />\r\n(Inclus dans le full pass et le pass &laquo; samedi &raquo;)<br />\r\n*voir le planning des cours<br />\r\n<br />\r\n____________Soir&eacute;e HAVANA STRASS___________<br />\r\n<br />\r\n20H00- repas sur place<br />\r\nAmbiance musicale avec DJ<br />\r\n<br />\r\n21H00- S&eacute;ance photo avec les artistes<br />\r\nDress code : Strass pour les femmes et Chic pour les hommes<br />\r\n(Inclus dans le full pass/pass samedi/pass soir&eacute;es)<br />\r\n<br />\r\n<br />\r\n22H00 (surprise)<br />\r\n<br />\r\nSuivi d&#39;une soir&eacute;e dansante avec :<br />\r\n<br />\r\n22H00 - &eacute;puisement<br />\r\nDJ JACK EL CALVO (paris) &amp; DJ DIABLITO (Marseille)<br />\r\n<br />\r\n<br />\r\n************************ DIMANCHE **********************<br />\r\n<br />\r\n10H30-18H00 cours de danses sur 3 niveaux, du d&eacute;butant au plus avanc&eacute;, accompagn&eacute;s par les musiciens d&rsquo;OKILAKUA<br />\r\n(Inclus dans le full pass et le pass &laquo; la ultima noche &raquo;)<br />\r\n*voir le planning des cours<br />\r\n<br />\r\n12H00 Conf&eacute;rence sur l&rsquo;art th&eacute;rapie et les danses Yoruba, avec Claudine Giral.<br />\r\n<br />\r\n18H00 CONCOURS de RUMBA amateur (2 cat&eacute;gories GUAGUANCO &amp; COLUMBIA)<br />\r\nAccompagn&eacute; par le groupe OKILAKUA<br />\r\n(Nombreux lots &agrave; gagner, dont un Ipad)<br />\r\n<br />\r\n__________Soir&eacute;e LA ULTIMA NOCHE____________<br />\r\n<br />\r\n20H00 &ndash; 21H30 D&icirc;ner de Cl&ocirc;ture avec les artistes aupr&egrave;s du traiteur<br />\r\n<br />\r\nS&eacute;ance photo avec les artistes<br />\r\nDress code : fluo<br />\r\nAmbiance musicale avec DJ<br />\r\n<br />\r\n22H00 &ndash; 00H00 concert exceptionnel de PUPPY Y LOS QUE SON SON<br />\r\n25&euro; sur place ou 20&euro; en pr&eacute;vente sur le site (quantit&eacute; limit&eacute;e) :<br />\r\n<br />\r\nwww-festival-international-cubano.com<br />\r\n<br />\r\nSoir&eacute;e dansante 00H00-4H00<br />\r\nDJ Ali Gato ( Strasbourg )<br />\r\n<br />\r\n===================TARIFS=================<br />\r\n<br />\r\nLES PASS<br />\r\n<br />\r\n- FULL PASS : 130&euro; comprend :<br />\r\n&bull; Spectacle &agrave; la rencontre des danses Cubaines et Urbaines<br />\r\n&bull; Soir&eacute;e Sals&rsquo;Halloween<br />\r\n&bull; Tous les cours du vendredi, samedi et du Dimanche<br />\r\n&bull; soir&eacute;e HAVANA STRASS<br />\r\n&bull; Conf&eacute;rence de Claudine GIRAL<br />\r\n&bull; Concert PUPY Y LOS QUE SON SON avec LA ULTIMA NOCHE<br />\r\n&bull; (Seul les repas sont en suppl&eacute;ment)<br />\r\n<br />\r\n*Possibilit&eacute; de payer en 3 fois sans frais sous conditions:<br />\r\n1er acompte de 40&euro; le 15 aout<br />\r\n2eme acompte de 50&euro; le 15 septembre<br />\r\n3eme acompte de 50&euro; le 15 Octobre)<br />\r\n<br />\r\n- PASS HAVANA STRASS (samedi) : 70&euro; comprend :<br />\r\nLes cours de la journ&eacute;e de samedi<br />\r\nSurprise<br />\r\nLa soir&eacute;e HAVANA STRASS<br />\r\n<br />\r\n- PASS LA ULTIMA NOCHE (dimanche) : 80&euro; comprend :<br />\r\nLes cours de la journ&eacute;e du dimanche<br />\r\nConf&eacute;rence sur l&rsquo;art th&eacute;rapie et la danse du YORUBA<br />\r\nLe concert de Pupy<br />\r\nLa soir&eacute;e LA ULTIMA NOCHE<br />\r\n<br />\r\n- PASS SOIREES 50&euro; comprend :<br />\r\n- le spectacle &laquo; &agrave; la rencontre des danses Cubaines et Urbaines &raquo;<br />\r\n- La soir&eacute;e Sals&rsquo;Halloween<br />\r\n- Soir&eacute;e Havana STRASS<br />\r\n- Le concert du Dimanche<br />\r\n- Le concours de Rumba<br />\r\n- La Conf&eacute;rence<br />\r\n- Soir&eacute;e Ultima Noche<br />\r\n____________________________________________<br />\r\n<br />\r\nLES SOIREES SEULES<br />\r\n<br />\r\n__________________Vendredi__________________<br />\r\n<br />\r\n-soir&eacute;e D&icirc;ner + Spectacle + Soir&eacute;e Sals&rsquo;Haloween &agrave; 20H00 (sur r&eacute;servation) : 28&euro;<br />\r\n-Soir&eacute;e Spectacle + Soir&eacute;e Sals&rsquo;Haloween &agrave; partir de 21H30 : 18&euro;<br />\r\n- Soir&eacute;e Sals&#39;Halloween &agrave; partir de 23H00 : 12&euro;<br />\r\n<br />\r\n___________________Samedi___________________<br />\r\n<br />\r\nSoir&eacute;e Havana Strass (&agrave; partir de 21H30): 12&euro; sur place<br />\r\n<br />\r\n<br />\r\n___________________Dimanche_________________<br />\r\n<br />\r\nConcours de Rumba + Concert + Soir&eacute;e du Dimanche (&agrave; partir de 18H00) : 20&euro; en pr&eacute;vente et 25&euro; sur place<br />\r\nSoir&eacute;e sans concert &agrave; partir de Minuit : 8&euro; sur place<br />\r\n<br />\r\n<br />\r\n<br />\r\n<br />\r\n<br />\r\ninfos et inscriptions : Yoann 06 95 55 45 40<br />\r\nPassion Timba 24 rue Magenta res. Debussy 84100 ORANGE<br />\r\n_____________________________________________________<br />\r\n<br />\r\n<br />\r\nPossibilit&eacute; de payer en 2, 3 ou 4 fois si vous r&eacute;server par ch&egrave;ques &agrave; l&#39;ordre de PASSION TIMBA au tarif normal de 140&euro;.<br />\r\n<br />\r\n&agrave; envoyer &agrave;:<br />\r\n<br />\r\nPASSION TIMBA<br />\r\n24 rue Magenta<br />\r\nR&eacute;sidence de BUSSY<br />\r\n84100 Orange<br />\r\n<br />\r\n<br />\r\n____________________________________________<br />\r\n<br />\r\n<br />\r\nPassion Timba is proud to present the new edition of the Festival Cubano for 2014!!!!<br />\r\n<br />\r\nNews concerning this year&#39;s edition:<br />\r\n<br />\r\nthis year the festival will take place in the city of Orange in a 1000m2 room with easy access to many hotels, highway, train station...<br />\r\n<br />\r\nAfro-Cuban and rumba classes will take place with live music with the famous Okilakua music band.<br />\r\n<br />\r\nFriday night you will witness a breathtaking show performed by artists coming for the first time in France...<br />\r\n<br />\r\nOne amazing concerts! (Surprise!)<br />\r\n<br />\r\nSunday at 6 pm, rumba competition for anyone willing to participate, with many nice presents for the winners<br />\r\nConference on &quot;art therapy and orisha dances&quot; by Claudine Giral<br />\r\n<br />\r\nOn-site catering<br />\r\nMany many more surprises...<br />\r\n<br />\r\n<br />\r\n******************************************************<br />\r\n<br />\r\nArtists:<br />\r\n<br />\r\nYanet Fuentes<br />\r\nWilmer and Maria<br />\r\nPedrito and CUBACHE<br />\r\nSergio Larrinaga<br />\r\nHector Oviedo<br />\r\nIsmaray Chacon<br />\r\nYoannis Tamayo<br />\r\nBarbara Jimenez<br />\r\nAlain Morales<br />\r\nClaudine Giral<br />\r\n<br />\r\nDJs:<br />\r\n<br />\r\nDJ Jack El Calvo<br />\r\nDJ Diablito<br />\r\nDJ Mabe Yubana<br />\r\nDJ Ali Gato<br />\r\nDJ Yoyo<br />\r\n<br />\r\n<br />\r\n******************************************************<br />\r\n<br />\r\nStay tuned as this year registrations start July 1st and the twenty first of you booking your full price will benefit an exceptional price!!!<br />\r\n<br />\r\nFrom July 1st 2014 as follows :<br />\r\n<br />\r\nFirst 20 full pass : 60&euro;<br />\r\nNext 20 full pass : 80&euro;<br />\r\nNext 20 full pass : 100&euro;<br />\r\nNext 20 full pass : 110&euro;<br />\r\nNext full pass : 130&euro;<br />\r\n<br />\r\nAnd then for all of you that come after a final price of 130&euro;<br />\r\n<br />\r\nRegistration possible on : <a href="http://l.facebook.com/l.php?u=http%3A%2F%2Fwww.festival-international-cubano.com%2F&amp;h=aAQHI2phX&amp;enc=AZOfj6HR8nGD8mM-e351xY2p8tSCjV6Fl3k9xagLJs0yk-ZhDvofwPlRfmM6IgSXHG8&amp;s=1" target="_blank">http://www.festival-international-cubano.com/</a><br />\r\n<br />\r\nWe make it possible for you to pay in 2, 3 or 4 times if you pay by check to PASSION TIMBA to be sent at this address:<br />\r\n<br />\r\nPASSION TIMBA<br />\r\n24, Rue de Magenta<br />\r\nResidence de BUSSY<br />\r\n84100 Orange<br />\r\nFRANC</p>', 'en'),
(6, 3, 'FESTIVAL INTERNATIONAL CUBANO 2014', '<p>Passion timba est heureux de vous pr&eacute;senter son Festival International Cubano 2014!!!!<br />\r\n<br />\r\nLes nouveaut&eacute;s du festival:<br />\r\n<br />\r\n- cette ann&eacute;e, nous d&eacute;pla&ccedil;ons le festival &agrave; Orange dans une salle de 1000m2 &agrave; proximit&eacute; de nombreux h&ocirc;tels , autoroutes, gares SNCF....<br />\r\n<br />\r\n- Les cours d&#39;afro-cubains et de rumba seront accompagn&eacute; par les musiciens du groupe OKILAKUA<br />\r\n<br />\r\n<br />\r\n***************************************************************<br />\r\n<br />\r\nLe festival en quelques mots:<br />\r\n<br />\r\n- 3 jours intensifs sur la cultures cubaine, avec des cours sur 3 niveaux, de la d&eacute;couverte au master class!<br />\r\navec la cr&egrave;me des professeurs internationaux!!!!<br />\r\n<br />\r\n- 3 soir&eacute;es avec les meilleurs DJs du moment<br />\r\n<br />\r\n- 1 concert exceptionnel<br />\r\n<br />\r\n***************************************************************<br />\r\n<br />\r\nles artistes:<br />\r\n<br />\r\n- Yanet Fuentes<br />\r\n- Wilmer Y Maria<br />\r\n- Pedrito y su CUBACHE<br />\r\n- Sergio Larrinaga<br />\r\n- Hector Oviedo<br />\r\n- Ismaray Chacon<br />\r\n- Yoannis Tamayo<br />\r\n- Barbara Jiminez<br />\r\n- Alain Morales<br />\r\n- Claudine Giral<br />\r\n<br />\r\nLes DJs<br />\r\n<br />\r\n- DJ Jack Elcalvo<br />\r\n- DJ Diablito<br />\r\n- DJ Mab&ecirc; Yubana DiJi<br />\r\n- DJ Ali Gato<br />\r\n<br />\r\n***************************************************************<br />\r\n<br />\r\n_____________LE PROGRAMME_______________<br />\r\n<br />\r\n****************VENDREDI 31 OCTOBRE ****************<br />\r\n<br />\r\n<br />\r\n-&agrave; partir de 17H30 r&eacute;cup&eacute;rations des Pass.<br />\r\n<br />\r\n-19H00 20H00 cours avec Yanet Fuentes et cours avec <a href="https://www.facebook.com/yoannis.tamayo">Yoannis Tamayo</a><br />\r\n<br />\r\nSoir&eacute;e &laquo;Sals&rsquo;Halloween &raquo;<br />\r\n20H00 &ndash; 23H00 D&icirc;ner spectacle<br />\r\n- Ambiance musicale avec DJ.<br />\r\n- 21h30 Spectacle : A la rencontre des danses Cubaines &amp; Urbaines.<br />\r\n<br />\r\nTARIFS<br />\r\n- en place VIP : 28&euro; (diner devant la sc&egrave;ne + spectacle + soir&eacute;e Sals&rsquo;Halloween)<br />\r\n- Avec full pass: D&icirc;ner &agrave; 15&euro; en suppl&eacute;ment<br />\r\n- Spectacle Gratuit avec le Full Pass<br />\r\n- Entr&eacute;e soir&eacute;e + Spectacle &agrave; partir de 21H00: 18&euro;<br />\r\n- Entr&eacute;e Soir&eacute;e &agrave; partir de 23H00 :12&euro;<br />\r\n<br />\r\nR&eacute;servations pour les repas en place VIP au : 06 95 55 45 40 (au plus tard le mardi 28 Octobre)<br />\r\n<br />\r\n____________________________________________<br />\r\n<br />\r\n23H00-04H00 Soir&eacute;e Sals&rsquo;Halloween<br />\r\nAvec sp&eacute;cialement pour vous faire danser toute la nuit....<br />\r\nDJ JACK EL CALVO (Paris) &amp; DJ MABE (Toulouse)<br />\r\n(dress code : Halloween)<br />\r\n<br />\r\n<br />\r\n*****************SAMEDI 1ER Novembre ****************<br />\r\n<br />\r\n10H00-18H00 cours de danses sur 3 niveaux, du d&eacute;butant au plus avanc&eacute;, accompagn&eacute;s par les musiciens d&rsquo;OKILAKUA<br />\r\n<br />\r\n(Inclus dans le full pass et le pass &laquo; samedi &raquo;)<br />\r\n*voir le planning des cours<br />\r\n<br />\r\n____________Soir&eacute;e HAVANA STRASS___________<br />\r\n<br />\r\n20H00- repas sur place<br />\r\nAmbiance musicale avec DJ<br />\r\n<br />\r\n21H00- S&eacute;ance photo avec les artistes<br />\r\nDress code : Strass pour les femmes et Chic pour les hommes<br />\r\n(Inclus dans le full pass/pass samedi/pass soir&eacute;es)<br />\r\n<br />\r\n<br />\r\n22H00 (surprise)<br />\r\n<br />\r\nSuivi d&#39;une soir&eacute;e dansante avec :<br />\r\n<br />\r\n22H00 - &eacute;puisement<br />\r\nDJ JACK EL CALVO (paris) &amp; DJ DIABLITO (Marseille)<br />\r\n<br />\r\n<br />\r\n************************ DIMANCHE **********************<br />\r\n<br />\r\n10H30-18H00 cours de danses sur 3 niveaux, du d&eacute;butant au plus avanc&eacute;, accompagn&eacute;s par les musiciens d&rsquo;OKILAKUA<br />\r\n(Inclus dans le full pass et le pass &laquo; la ultima noche &raquo;)<br />\r\n*voir le planning des cours<br />\r\n<br />\r\n12H00 Conf&eacute;rence sur l&rsquo;art th&eacute;rapie et les danses Yoruba, avec Claudine Giral.<br />\r\n<br />\r\n18H00 CONCOURS de RUMBA amateur (2 cat&eacute;gories GUAGUANCO &amp; COLUMBIA)<br />\r\nAccompagn&eacute; par le groupe OKILAKUA<br />\r\n(Nombreux lots &agrave; gagner, dont un Ipad)<br />\r\n<br />\r\n__________Soir&eacute;e LA ULTIMA NOCHE____________<br />\r\n<br />\r\n20H00 &ndash; 21H30 D&icirc;ner de Cl&ocirc;ture avec les artistes aupr&egrave;s du traiteur<br />\r\n<br />\r\nS&eacute;ance photo avec les artistes<br />\r\nDress code : fluo<br />\r\nAmbiance musicale avec DJ<br />\r\n<br />\r\n22H00 &ndash; 00H00 concert exceptionnel de PUPPY Y LOS QUE SON SON<br />\r\n25&euro; sur place ou 20&euro; en pr&eacute;vente sur le site (quantit&eacute; limit&eacute;e) :<br />\r\n<br />\r\nwww-festival-international-cubano.com<br />\r\n<br />\r\nSoir&eacute;e dansante 00H00-4H00<br />\r\nDJ Ali Gato ( Strasbourg )<br />\r\n<br />\r\n===================TARIFS=================<br />\r\n<br />\r\nLES PASS<br />\r\n<br />\r\n- FULL PASS : 130&euro; comprend :<br />\r\n&bull; Spectacle &agrave; la rencontre des danses Cubaines et Urbaines<br />\r\n&bull; Soir&eacute;e Sals&rsquo;Halloween<br />\r\n&bull; Tous les cours du vendredi, samedi et du Dimanche<br />\r\n&bull; soir&eacute;e HAVANA STRASS<br />\r\n&bull; Conf&eacute;rence de Claudine GIRAL<br />\r\n&bull; Concert PUPY Y LOS QUE SON SON avec LA ULTIMA NOCHE<br />\r\n&bull; (Seul les repas sont en suppl&eacute;ment)<br />\r\n<br />\r\n*Possibilit&eacute; de payer en 3 fois sans frais sous conditions:<br />\r\n1er acompte de 40&euro; le 15 aout<br />\r\n2eme acompte de 50&euro; le 15 septembre<br />\r\n3eme acompte de 50&euro; le 15 Octobre)<br />\r\n<br />\r\n- PASS HAVANA STRASS (samedi) : 70&euro; comprend :<br />\r\nLes cours de la journ&eacute;e de samedi<br />\r\nSurprise<br />\r\nLa soir&eacute;e HAVANA STRASS<br />\r\n<br />\r\n- PASS LA ULTIMA NOCHE (dimanche) : 80&euro; comprend :<br />\r\nLes cours de la journ&eacute;e du dimanche<br />\r\nConf&eacute;rence sur l&rsquo;art th&eacute;rapie et la danse du YORUBA<br />\r\nLe concert de Pupy<br />\r\nLa soir&eacute;e LA ULTIMA NOCHE<br />\r\n<br />\r\n- PASS SOIREES 50&euro; comprend :<br />\r\n- le spectacle &laquo; &agrave; la rencontre des danses Cubaines et Urbaines &raquo;<br />\r\n- La soir&eacute;e Sals&rsquo;Halloween<br />\r\n- Soir&eacute;e Havana STRASS<br />\r\n- Le concert du Dimanche<br />\r\n- Le concours de Rumba<br />\r\n- La Conf&eacute;rence<br />\r\n- Soir&eacute;e Ultima Noche<br />\r\n____________________________________________<br />\r\n<br />\r\nLES SOIREES SEULES<br />\r\n<br />\r\n__________________Vendredi__________________<br />\r\n<br />\r\n-soir&eacute;e D&icirc;ner + Spectacle + Soir&eacute;e Sals&rsquo;Haloween &agrave; 20H00 (sur r&eacute;servation) : 28&euro;<br />\r\n-Soir&eacute;e Spectacle + Soir&eacute;e Sals&rsquo;Haloween &agrave; partir de 21H30 : 18&euro;<br />\r\n- Soir&eacute;e Sals&#39;Halloween &agrave; partir de 23H00 : 12&euro;<br />\r\n<br />\r\n___________________Samedi___________________<br />\r\n<br />\r\nSoir&eacute;e Havana Strass (&agrave; partir de 21H30): 12&euro; sur place<br />\r\n<br />\r\n<br />\r\n___________________Dimanche_________________<br />\r\n<br />\r\nConcours de Rumba + Concert + Soir&eacute;e du Dimanche (&agrave; partir de 18H00) : 20&euro; en pr&eacute;vente et 25&euro; sur place<br />\r\nSoir&eacute;e sans concert &agrave; partir de Minuit : 8&euro; sur place<br />\r\n<br />\r\n<br />\r\n<br />\r\n<br />\r\n<br />\r\ninfos et inscriptions : Yoann 06 95 55 45 40<br />\r\nPassion Timba 24 rue Magenta res. Debussy 84100 ORANGE<br />\r\n_____________________________________________________<br />\r\n<br />\r\n<br />\r\nPossibilit&eacute; de payer en 2, 3 ou 4 fois si vous r&eacute;server par ch&egrave;ques &agrave; l&#39;ordre de PASSION TIMBA au tarif normal de 140&euro;.<br />\r\n<br />\r\n&agrave; envoyer &agrave;:<br />\r\n<br />\r\nPASSION TIMBA<br />\r\n24 rue Magenta<br />\r\nR&eacute;sidence de BUSSY<br />\r\n84100 Orange<br />\r\n<br />\r\n<br />\r\n____________________________________________<br />\r\n<br />\r\n<br />\r\nPassion Timba is proud to present the new edition of the Festival Cubano for 2014!!!!<br />\r\n<br />\r\nNews concerning this year&#39;s edition:<br />\r\n<br />\r\nthis year the festival will take place in the city of Orange in a 1000m2 room with easy access to many hotels, highway, train station...<br />\r\n<br />\r\nAfro-Cuban and rumba classes will take place with live music with the famous Okilakua music band.<br />\r\n<br />\r\nFriday night you will witness a breathtaking show performed by artists coming for the first time in France...<br />\r\n<br />\r\nOne amazing concerts! (Surprise!)<br />\r\n<br />\r\nSunday at 6 pm, rumba competition for anyone willing to participate, with many nice presents for the winners<br />\r\nConference on &quot;art therapy and orisha dances&quot; by Claudine Giral<br />\r\n<br />\r\nOn-site catering<br />\r\nMany many more surprises...<br />\r\n<br />\r\n<br />\r\n******************************************************<br />\r\n<br />\r\nArtists:<br />\r\n<br />\r\nYanet Fuentes<br />\r\nWilmer and Maria<br />\r\nPedrito and CUBACHE<br />\r\nSergio Larrinaga<br />\r\nHector Oviedo<br />\r\nIsmaray Chacon<br />\r\nYoannis Tamayo<br />\r\nBarbara Jimenez<br />\r\nAlain Morales<br />\r\nClaudine Giral<br />\r\n<br />\r\nDJs:<br />\r\n<br />\r\nDJ Jack El Calvo<br />\r\nDJ Diablito<br />\r\nDJ Mabe Yubana<br />\r\nDJ Ali Gato<br />\r\nDJ Yoyo<br />\r\n<br />\r\n<br />\r\n******************************************************<br />\r\n<br />\r\nStay tuned as this year registrations start July 1st and the twenty first of you booking your full price will benefit an exceptional price!!!<br />\r\n<br />\r\nFrom July 1st 2014 as follows :<br />\r\n<br />\r\nFirst 20 full pass : 60&euro;<br />\r\nNext 20 full pass : 80&euro;<br />\r\nNext 20 full pass : 100&euro;<br />\r\nNext 20 full pass : 110&euro;<br />\r\nNext full pass : 130&euro;<br />\r\n<br />\r\nAnd then for all of you that come after a final price of 130&euro;<br />\r\n<br />\r\nRegistration possible on : <a href="http://l.facebook.com/l.php?u=http%3A%2F%2Fwww.festival-international-cubano.com%2F&amp;h=aAQHI2phX&amp;enc=AZOfj6HR8nGD8mM-e351xY2p8tSCjV6Fl3k9xagLJs0yk-ZhDvofwPlRfmM6IgSXHG8&amp;s=1" target="_blank">http://www.festival-international-cubano.com/</a><br />\r\n<br />\r\nWe make it possible for you to pay in 2, 3 or 4 times if you pay by check to PASSION TIMBA to be sent at this address:<br />\r\n<br />\r\nPASSION TIMBA<br />\r\n24, Rue de Magenta<br />\r\nResidence de BUSSY<br />\r\n84100 Orange<br />\r\nFRANC</p>', 'fr'),
(7, 4, 'LATIN COCKTAIL La Régie V''Ascq', '<p>Bar &quot;La r&eacute;gie&quot; Grand Stade Villeneuve d&#39;Ascq<br />\r\nSAMEDI 30 AOUT 2014<br />\r\nC&rsquo;est : de la salsa, de la bachata, de la kizomba et des cocktails !<br />\r\nEt c&rsquo;est gratuit<br />\r\n<br />\r\nLe bar &laquo; LA REGIE &raquo;<br />\r\n<a href="http://www.la-regie-lille-grand-stade.com/" target="_blank">www.la-regie-lille-grand-stade.com</a><br />\r\n<br />\r\nTerrasse du Grand Stade Lille M&eacute;tropole<br />\r\n261, Boulevard de Tournai<br />\r\n59656 Villeneuve d&#39;Ascq<br />\r\n<br />\r\nD&eacute;co, parquet,m&eacute;ga bar convivial , barmen jongleurs<br />\r\n<br />\r\nTout au long de la soir&eacute;e les mojitos &agrave; 6&euro;<br />\r\n<br />\r\n21h initiation bachata avec <a href="https://www.facebook.com/jeremy.roelandt">J&eacute;r&eacute;my M&eacute;lissa Bachateros</a><br />\r\n<br />\r\n21h30 Dj El Cantante, Dj Latin Affair, Dj El Pueblo, Dj El Brujo<br />\r\n<br />\r\nO&ugrave; se garer ?<br />\r\n-Devant le Bar LA REGIE&hellip;arrivez tr&egrave;s t&ocirc;t pour avoir de la place<br />\r\n-Parking gratuit NORAUTO V2<br />\r\n-Parking A3 du grand Stade (2h gratuites ou 3h gratuite si vous d&icirc;ner au restaurant puis 1&euro;40/1h)<br />\r\n<br />\r\nN&rsquo;oubliez pas demander votre ticket r&eacute;duction au Bar avant de repartir.<br />\r\n<br />\r\nENTREE DE LA SOIREE GRATUITE<br />\r\n<br />\r\nSALSA PICANTE<br />\r\n<br />\r\nNe plus manquer nos soir&eacute;es! recevez nos alertes SMS en envoyant &quot;salsa&quot; au 0616593738<br />\r\n<br />\r\n<br />\r\n.......................<a href="http://l.facebook.com/l.php?u=http%3A%2F%2Fwww.salsa-picante.fr%2F&amp;h=RAQG1Cpzc&amp;enc=AZM_Ft1JME6NQyY3hNJzsVaQLzr0pxmYtgMdwU9S94pCpBrsKyDcYAnam--l7IaV1c8&amp;s=1" target="_blank">www.salsa-picante.fr.</a>.............................</p>', 'en'),
(8, 4, 'LATIN COCKTAIL La Régie V''Ascq', '<p>Bar &quot;La r&eacute;gie&quot; Grand Stade Villeneuve d&#39;Ascq<br />\r\nSAMEDI 30 AOUT 2014<br />\r\nC&rsquo;est : de la salsa, de la bachata, de la kizomba et des cocktails !<br />\r\nEt c&rsquo;est gratuit<br />\r\n<br />\r\nLe bar &laquo; LA REGIE &raquo;<br />\r\n<a href="http://www.la-regie-lille-grand-stade.com/" target="_blank">www.la-regie-lille-grand-stade.com</a><br />\r\n<br />\r\nTerrasse du Grand Stade Lille M&eacute;tropole<br />\r\n261, Boulevard de Tournai<br />\r\n59656 Villeneuve d&#39;Ascq<br />\r\n<br />\r\nD&eacute;co, parquet,m&eacute;ga bar convivial , barmen jongleurs<br />\r\n<br />\r\nTout au long de la soir&eacute;e les mojitos &agrave; 6&euro;<br />\r\n<br />\r\n21h initiation bachata avec <a href="https://www.facebook.com/jeremy.roelandt">J&eacute;r&eacute;my M&eacute;lissa Bachateros</a><br />\r\n<br />\r\n21h30 Dj El Cantante, Dj Latin Affair, Dj El Pueblo, Dj El Brujo<br />\r\n<br />\r\nO&ugrave; se garer ?<br />\r\n-Devant le Bar LA REGIE&hellip;arrivez tr&egrave;s t&ocirc;t pour avoir de la place<br />\r\n-Parking gratuit NORAUTO V2<br />\r\n-Parking A3 du grand Stade (2h gratuites ou 3h gratuite si vous d&icirc;ner au restaurant puis 1&euro;40/1h)<br />\r\n<br />\r\nN&rsquo;oubliez pas demander votre ticket r&eacute;duction au Bar avant de repartir.<br />\r\n<br />\r\nENTREE DE LA SOIREE GRATUITE<br />\r\n<br />\r\nSALSA PICANTE<br />\r\n<br />\r\nNe plus manquer nos soir&eacute;es! recevez nos alertes SMS en envoyant &quot;salsa&quot; au 0616593738<br />\r\n<br />\r\n<br />\r\n.......................<a href="http://l.facebook.com/l.php?u=http%3A%2F%2Fwww.salsa-picante.fr%2F&amp;h=RAQG1Cpzc&amp;enc=AZM_Ft1JME6NQyY3hNJzsVaQLzr0pxmYtgMdwU9S94pCpBrsKyDcYAnam--l7IaV1c8&amp;s=1" target="_blank">www.salsa-picante.fr.</a>.............................</p>', 'fr'),
(9, 5, 'DURSIN SALSA, BACHATA & KIZ PARTY', '<p>1 des Soir&eacute;es Salsa les plus populaires de Flandres avec salle KIZOMBA<br />\r\n1 vd populairste maandelijkse Salsa Parties uit Vlaanderen met KIZOMBA-zaal<br />\r\n* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *<br />\r\nExceptionally on Saturday 25 OCTOBER<br />\r\n(1st November Dursin =closed)<br />\r\n<br />\r\nROOM 1 Salsa-bachata: 21h &ndash;3h<br />\r\n- resident dj MARCO (salsa cubana, portorican salsa, bachata)<br />\r\n<br />\r\nROOM 2 Kizomba:<br />\r\n&ndash; 21h workshop kizomba for beginners by Daniel Howett (Dursin)<br />\r\n&ndash; 22h -&gt; 3h guest dj JULIEN PARKER (Kiz Army, F)<br />\r\n<br />\r\nEntree 5 euro party<br />\r\n8 euro party + workshop kizomba</p>', 'en'),
(10, 5, 'DURSIN SALSA, BACHATA & KIZ PARTY', '<p>1 des Soir&eacute;es Salsa les plus populaires de Flandres avec salle KIZOMBA<br />\r\n1 vd populairste maandelijkse Salsa Parties uit Vlaanderen met KIZOMBA-zaal<br />\r\n* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *<br />\r\nExceptionally on Saturday 25 OCTOBER<br />\r\n(1st November Dursin =closed)<br />\r\n<br />\r\nROOM 1 Salsa-bachata: 21h &ndash;3h<br />\r\n- resident dj MARCO (salsa cubana, portorican salsa, bachata)<br />\r\n<br />\r\nROOM 2 Kizomba:<br />\r\n&ndash; 21h workshop kizomba for beginners by Daniel Howett (Dursin)<br />\r\n&ndash; 22h -&gt; 3h guest dj JULIEN PARKER (Kiz Army, F)<br />\r\n<br />\r\nEntree 5 euro party<br />\r\n8 euro party + workshop kizomba</p>', 'fr'),
(11, 6, 'CUBAN EXCLUSIVE', '<p>CUBAN EXCLUSIVE CE SOIR AU B-FLOOR<br />\r\n13 rue Geoffroy de St Hilaire Lille<br />\r\n<br />\r\nTOUS LES 4&egrave;me VENDREDI d&egrave;s 21h15<br />\r\nC&rsquo;est salsa cubaine exclusivement !<br />\r\n<br />\r\n<br />\r\n21h15 initiation salsa par SALSA PICANTE<br />\r\n<br />\r\n22h-3h Dj El Brujo Latino<br />\r\n100% salsa cubaine et bachata (Son,charanga,timba,salsaton, timba dura, timbaton...)<br />\r\n<br />\r\n(Paf 5&euro;+1conso)<br />\r\n<br />\r\n---------------------------------------------------------<br />\r\nNe plus manquer nos soir&eacute;es! recevez nos alertes SMS en envoyant &quot;salsa&quot; au 0616593738<br />\r\n-----------------<a href="http://l.facebook.com/l.php?u=http%3A%2F%2Fwww.salsa%2F&amp;h=fAQFtEVdt&amp;enc=AZOWysRll-xHL7b06arbAsq0U_oK0Kv96Pl9tatPNX_VZlPj-dRtMIuvY1iy9zMrOvg&amp;s=1" target="_blank">www.salsa</a>-picante.fr--------------</p>', 'en'),
(12, 6, 'CUBAN EXCLUSIVE', '<p>CUBAN EXCLUSIVE CE SOIR AU B-FLOOR<br />\r\n13 rue Geoffroy de St Hilaire Lille<br />\r\n<br />\r\nTOUS LES 4&egrave;me VENDREDI d&egrave;s 21h15<br />\r\nC&rsquo;est salsa cubaine exclusivement !<br />\r\n<br />\r\n<br />\r\n21h15 initiation salsa par SALSA PICANTE<br />\r\n<br />\r\n22h-3h Dj El Brujo Latino<br />\r\n100% salsa cubaine et bachata (Son,charanga,timba,salsaton, timba dura, timbaton...)<br />\r\n<br />\r\n(Paf 5&euro;+1conso)<br />\r\n<br />\r\n---------------------------------------------------------<br />\r\nNe plus manquer nos soir&eacute;es! recevez nos alertes SMS en envoyant &quot;salsa&quot; au 0616593738<br />\r\n-----------------<a href="http://l.facebook.com/l.php?u=http%3A%2F%2Fwww.salsa%2F&amp;h=fAQFtEVdt&amp;enc=AZOWysRll-xHL7b06arbAsq0U_oK0Kv96Pl9tatPNX_VZlPj-dRtMIuvY1iy9zMrOvg&amp;s=1" target="_blank">www.salsa</a>-picante.fr--------------</p>', 'fr'),
(13, 7, 'LILLE FESTIVAL KIZOMBA CONNECTION 2014', '<p>/// ENGLISH VERSION BELOW ///<br />\r\n<br />\r\nKIZOMBA CONNECTION LILLE 6ed<br />\r\n<br />\r\nWebsite : http: // <a href="http://www.salsa-picante.fr/kizomba-connection" target="_blank">www.salsa-picante.fr/kizomba-connection</a><br />\r\nGroup : <a href="https://www.facebook.com/groups/kizombaconnection/?fref=ts">https://www.facebook.com/groups/kizombaconnection/?fref=ts</a><br />\r\nProfil : Kizomba Lille<br />\r\n<br />\r\n<br />\r\n✦✦✦ BIENVENUE ✦✦✦<br />\r\nLa 6&egrave;me &eacute;dition du festival KIZOMBA CONNECTION de Lille vous accueillera du 17 au19 Octobre 2014 &agrave; Lille (France).<br />\r\n<br />\r\nCe festival est 100% Afro- Kizomba-Semba-Afro House-Kuduro<br />\r\nUn week end de folie au top de la qualit&eacute; au top de l&rsquo;acceuil.<br />\r\n<br />\r\n✦✦✦ LIEUX D&rsquo;EXCEPTION ✦✦✦<br />\r\n:<br />\r\nWorkshop location<br />\r\n-Palais des sports de Lille<br />\r\n78 Avenue Kennedy Lille<br />\r\n3 grandes salles et une salle d&rsquo;entrainement avec DJ.<br />\r\n<br />\r\nParty location<br />\r\n-Zenith de Lille Grand Palais Boulevard Dubuisson 59800 Lille<br />\r\nUn lieu exceptionnel, en plein centre ville de Lille.<br />\r\n<br />\r\nTous les lieux sont &agrave; 10 min &agrave; pied les uns des autres et des gares<br />\r\n<br />\r\n<br />\r\n✦✦✦ ARTISTES ✦✦✦<br />\r\n<br />\r\n<br />\r\n✦KIZOMBA✦<br />\r\n&bull; Morenasso and Anais (Paris)<br />\r\n&bull; Afro Latin Connection (Ricardo, Paula, Bruno, Patricia) (Portugal)<br />\r\n&bull; Mandela and Lisa (Portugal)<br />\r\n&bull; Sara LOPEZ (Madrid)<br />\r\n&bull; Joao and Giedre (Portugal)<br />\r\n&bull; Nat NKM and Dany (Paris)<br />\r\n&bull; Georges and Laura (Paris)<br />\r\n&bull; Victor and Coralie (Paris)<br />\r\n&bull; Sa&rsquo;id and Tania (Londres)<br />\r\n&bull; Mam&rsquo;s ( Paris)<br />\r\n&bull;Sara and Frans (Bruxelles)<br />\r\n&bull; Paterne (Lille)<br />\r\n&bull; Afro Kuilombo (Lille)<br />\r\n<br />\r\nAvec la participation exceptionnelle de l&rsquo;&eacute;quipe de Social Dance Paris, nos partenaires.<br />\r\n<br />\r\n<br />\r\n✦DJ&#39;S✦<br />\r\n&bull; DJ Gass (Paris)<br />\r\n&bull; DJ Babacar Londres)<br />\r\n&bull; DJ Leda (Paris)<br />\r\n&bull; DJ adon (Madrid)<br />\r\n&bull;DJ Parker (Lille)<br />\r\n&bull;Dj Lycia (France)<br />\r\n<br />\r\n<br />\r\n✦✦✦ TARIFS ✦✦✦<br />\r\n<br />\r\nValable jusqu&rsquo;au 30 septembre 2014<br />\r\n<br />\r\n-FULL PASS : 100&euro;<br />\r\n-COMBO PASS 2 nuits pour 2 Pers : 2 FULL PASS+ 2 Nuits Chambre double<br />\r\nPetit d&eacute;jeuner compris : 167,5&euro;/pers<br />\r\nHotel B&amp;B Lille grand palais, rue Berthe Morissot Lille<br />\r\n10 minutes &agrave; pied de l&#39;&eacute;v&egrave;nement<br />\r\n-COMBO PASS 3 nuits pour 2 Pers : 2 FULL PASS+ 3 Nuits Chambre double<br />\r\nPetit d&eacute;jeuner compris : 200&euro;/pers<br />\r\nHotel B&amp;B Lille grand palais, rue Berthe Morissot Lille<br />\r\n10 minutes &agrave; pied de l&#39;&eacute;v&egrave;nement<br />\r\n<br />\r\nTous les autres tarifs (pass journ&eacute;e, party pass)<br />\r\nhttp: // <a href="http://l.facebook.com/l.php?u=http%3A%2F%2Fwww.salsa-picante.fr%2Fkizomba-connection&amp;h=LAQFZCWTv&amp;enc=AZMa4VwscgjKldvYSSbKgzXLvv5fzEJLnBW1xqqHwMcZS47mHN7Tw_g9WR4t8kD_Kfw&amp;s=1" target="_blank">www.salsa-picante.fr/kizomba-connection</a><br />\r\n<br />\r\n<br />\r\n---&gt; Vous souhaitez devenir partenaire de l&#39;&eacute;v&eacute;nement ou venir en groupe (8 personnes et plus) pour b&eacute;n&eacute;ficier de tarifs pr&eacute;f&eacute;rentiels, n&#39;h&eacute;sitez pas &agrave; nous contacter : kizomba.connection.lille@gmail.com<br />\r\n<br />\r\n✦✦✦HEBERGEMENT✦✦✦<br />\r\n<br />\r\nKizomab Connection Lille vous recommande l&rsquo;h&ocirc;tel des artistes<br />\r\nHotel B&amp;B Lille grand palais, rue Berthe Morissot Lille<br />\r\n10 minutes &agrave; pied de l&#39;&eacute;v&egrave;nement<br />\r\n<br />\r\n<br />\r\n✦✦✦PLUS D&rsquo;INFO✦✦✦<br />\r\nRetrouvez toutes les informations relatives &agrave; l&rsquo;&eacute;v&egrave;nement et toutes les photos des lieux et des pr&eacute;c&eacute;dentes &eacute;ditions via le lien suivant :<br />\r\n<br />\r\n<a href="http://l.facebook.com/l.php?u=http%3A%2F%2Fwww.salsa-picante.fr%2Fkizomba-connection&amp;h=jAQEGZUUA&amp;enc=AZMb8CR1NM1dR9FdqqK1mcNEMOUQcc6zxjLSkQCmvOGM401EDGGWJW9xR_KRpkrGoRM&amp;s=1" target="_blank">http://www.salsa-picante.fr/kizomba-connection</a><br />\r\n<br />\r\n<br />\r\n✦✦✦ R&Eacute;SERVATION ✦✦✦<br />\r\n<br />\r\n<a href="http://l.facebook.com/l.php?u=http%3A%2F%2Fwww.salsa-picante.fr%2Fkizomba-connection&amp;h=XAQGwtGhs&amp;enc=AZMwNnAcUX6pDUDeu5Ec0HpazaHrbuzjf4hB4S-vh1Zd1H5S4drblzY9qLSkuJrXCZY&amp;s=1" target="_blank">http://www.salsa-picante.fr/kizomba-connection</a><br />\r\n<br />\r\n<br />\r\n✦✦✦PETIT PLUS✦✦✦<br />\r\n<br />\r\nR&eacute;servez d&egrave;s maintenant par mail ou MP facebook (Kizomba Lille), votre T-shirt Kizomba Connection avec votre pr&eacute;nom, le m&ecirc;me que celui des artistes.<br />\r\n<br />\r\n<br />\r\n✦✦✦ CONTACT ✦✦✦<br />\r\nPour toute demande d&#39;informations, veuillez contacter Claire, organisateur et directeur artistique.<br />\r\nT&eacute;l : 06 77 56 96 84<br />\r\nMail : kizomba.connection.lille@gmail.com<br />\r\nWebsite : http: // <a href="http://l.facebook.com/l.php?u=http%3A%2F%2Fwww.salsa-picante.fr%2Fkizomba-connection&amp;h=lAQEYxTJn&amp;enc=AZOe39BDYokNndJdbfqfv9QQGg3HowWjEe26LPKkgsdpKFaJd7rvkoq1B5eyuNITZ-E&amp;s=1" target="_blank">www.salsa-picante.fr/kizomba-connection</a><br />\r\nGroup : <a href="https://www.facebook.com/groups/kizombaconnection/?fref=ts">https://www.facebook.com/groups/kizombaconnection/?fref=ts</a><br />\r\nProfil : Kizomba Lille<br />\r\n<br />\r\n<br />\r\n----------------------------------------------<br />\r\n<br />\r\nKIZOMBA CONNECTION LILLE 6ed<br />\r\n<br />\r\nWebsite : http: // <a href="http://l.facebook.com/l.php?u=http%3A%2F%2Fwww.salsa-picante.fr%2Fkizomba-connection&amp;h=NAQF76wPF&amp;enc=AZMjead6gHH66RMPtnsCiTOg0LAFlBsinfwygpWiPV_vbtBxtn-qSwSMIKJYkfVsr78&amp;s=1" target="_blank">www.salsa-picante.fr/kizomba-connection</a><br />\r\nGroup : <a href="https://www.facebook.com/groups/kizombaconnection/?fref=ts">https://www.facebook.com/groups/kizombaconnection/?fref=ts</a><br />\r\nProfil : Kizomba Lille<br />\r\n<br />\r\n<br />\r\n✦✦✦ WELCOME ✦✦✦<br />\r\n<br />\r\nThe 6th KIZOMBA CONNECTION Lille festival will welcome 17 AU19 October 2014 in Lille (France).<br />\r\nThis festival is 100% Afro- Kizomba-Semba-Afro House-Kuduro<br />\r\nA weekend of madness at the top of the quality at the top of the homepage.<br />\r\n<br />\r\n<br />\r\n✦✦✦ LOCATIONS✦✦✦<br />\r\n<br />\r\n-Evenings: Zenith of Lille<br />\r\n1 Boulevard des Cit&eacute;s Unies, 59800 Lille<br />\r\nOne of the spaces of the prestigious, also in the heart of the city.<br />\r\n<br />\r\n<br />\r\n-Workshop location<br />\r\nPalais des sports de Lille<br />\r\n78 Avenue Kennedy Lille<br />\r\nIn the heart of the city, composed of 3 spacious rooms with wooden floor, ideal for the classes+ A Training room with DJ.<br />\r\n<br />\r\nall locations are less than 15 minutes away from each other by foot and 10 minutes away from the train station<br />\r\n<br />\r\n<br />\r\n✦✦✦ ARTISTES ✦✦✦<br />\r\n<br />\r\n<br />\r\n✦KIZOMBA✦<br />\r\n&bull; Morenasso and Anais (Paris)<br />\r\n&bull; Afro Latin Connection (Ricardo, Paula, Bruno, Patricia) (Portugal)<br />\r\n&bull; Mandela and Lisa (Portugal)<br />\r\n&bull; Sara LOPEZ (Madrid)<br />\r\n&bull; Joao and Giedre (Portugal)<br />\r\n&bull; Nat NKM and Dany (Paris)<br />\r\n&bull; Georges and Laura (Paris)<br />\r\n&bull; Victor and Coralie (Paris)<br />\r\n&bull; Sa&rsquo;id and Tania (Londres)<br />\r\n&bull; Mam&rsquo;s ( Paris)<br />\r\n&bull;Sara and Frans (Bruxelles)<br />\r\n&bull; Paterne (Lille)<br />\r\n&bull; Afro Kuilombo (Lille)<br />\r\n<br />\r\nWith the special participation of the team Social Dance Paris, our partners.<br />\r\n<br />\r\n<br />\r\n✦DJ&#39;S✦<br />\r\n&bull; DJ Gass (Paris)<br />\r\n&bull; DJ Babacar Londres)<br />\r\n&bull; DJ Leda (Paris)<br />\r\n&bull; DJ adon (Madrid)<br />\r\n&bull;DJ Parker (Lille)<br />\r\n&bull;Dj Lycia (France)<br />\r\n<br />\r\n<br />\r\n✦✦✦ PRICES ✦✦✦<br />\r\n<br />\r\nValid until September 30, 2014<br />\r\n<br />\r\n-FULL PASS : 100&euro;<br />\r\n<br />\r\n-COMBO PASS 2 nights for 2 Pers : 2 FULL PASS+ 2 nights in double room<br />\r\nBreakfast included : 167,5&euro;/pers<br />\r\nHotel B&amp;B Lille grand palais, rue Berthe Morissot Lille<br />\r\n10 minutes away by foot from the festival&rsquo;s locations<br />\r\n<br />\r\n-COMBO PASS 3 night for 2 Pers : 2 FULL PASS+ 3 nights in double room<br />\r\nBreakfast included : 200&euro;/pers<br />\r\nHotel B&amp;B Lille grand palais, rue Berthe Morissot Lille<br />\r\n10 minutes away by foot from the festival&rsquo;s locations<br />\r\n<br />\r\nAll other tariffs (Day pass, party pass&hellip;)<br />\r\nhttp: // <a href="http://l.facebook.com/l.php?u=http%3A%2F%2Fwww.salsa-picante.fr%2Fkizomba-connection&amp;h=cAQG-uohU&amp;enc=AZMfT88_XjiTUIvouJunAsdqvjSCJl-RrH5hDAn20tHAWTfSp9XPiYnb0ZR_0tEMoX0&amp;s=1" target="_blank">www.salsa-picante.fr/kizomba-connection</a><br />\r\n<br />\r\n<br />\r\n---&gt; You want to become a partner or come as a group to benefit from preferential prices! Contact us : kizomba.connection.lille@gmail.com<br />\r\n<br />\r\n<br />\r\n✦✦✦ ONLINE BOOKING ✦✦✦<br />\r\n<a href="http://l.facebook.com/l.php?u=http%3A%2F%2Fwww.salsa-picante.fr%2Fkizomba-connection&amp;h=sAQEw4FFB&amp;enc=AZPkZQpYs9i4luCDCsMs25db3zITkpW1RKYXyjQ8zK8cBg7sFsFreeBrMLcYV25PID0&amp;s=1" target="_blank">http://www.salsa-picante.fr/kizomba-connection</a><br />\r\n<br />\r\n<br />\r\n✦✦✦ACCOMMODATIONS✦✦✦<br />\r\n<br />\r\nKizomba Connection Lille recommend the hotel artists<br />\r\nHotel B&amp;B Lille grand palais, rue Berthe Morissot Lille<br />\r\n10 minutes away by foot from the festival&rsquo;s locations<br />\r\n<br />\r\n✦✦✦ EXTRA✦✦✦<br />\r\nreserve from now on by e-mail or Facebook (Kizomab Lille), your T-shirt Kizomba connection with your first name, the same that the artists.<br />\r\n<br />\r\n✦✦✦MORE INFO✦✦✦<br />\r\n<br />\r\nFind all the information about the event and the pictures of places and previous editions via the following link :<br />\r\n<br />\r\n<a href="http://l.facebook.com/l.php?u=http%3A%2F%2Fwww.salsa-picante.fr%2Fkizomba-connection&amp;h=YAQGv83eb&amp;enc=AZMqLzg619_yfAQNkSd37YajjhJiJolAPJOoysiTsTfpYQ8x8gkEpxC75ikVOikjmvk&amp;s=1" target="_blank">http://www.salsa-picante.fr/kizomba-connection</a><br />\r\n<br />\r\n<br />\r\n✦✦✦CONTACT ✦✦✦<br />\r\nFor more informations, please contact Claire, Organizer and Artistic Director.<br />\r\nT&eacute;l : 06 77 56 96 84<br />\r\nMail : kizomba.connection.lille@gmail.com<br />\r\nWebsite : http: // <a href="http://l.facebook.com/l.php?u=http%3A%2F%2Fwww.salsa-picante.fr%2Fkizomba-connection&amp;h=4AQENq_Q8&amp;enc=AZOLY_DYUSUoGUCRbbGsCrRYnG1CWq9fKNB1AYYNuwQr9buiBka86KXtDSl4ka-PPA0&amp;s=1" target="_blank">www.salsa-picante.fr/kizomba-connection</a><br />\r\nGroup : <a href="https://www.facebook.com/groups/kizombaconnection/?fref=ts">https://www.facebook.com/groups/kizombaconnection/?fref=ts</a><br />\r\nProfil : Kizomba Lille</p>', 'en');
INSERT INTO `eventtranslation` (`id`, `translatable_id`, `title`, `description`, `locale`) VALUES
(14, 7, 'LILLE FESTIVAL KIZOMBA CONNECTION 2014', '<p>/// ENGLISH VERSION BELOW ///<br />\r\n<br />\r\nKIZOMBA CONNECTION LILLE 6ed<br />\r\n<br />\r\nWebsite : http: // <a href="http://www.salsa-picante.fr/kizomba-connection" target="_blank">www.salsa-picante.fr/kizomba-connection</a><br />\r\nGroup : <a href="https://www.facebook.com/groups/kizombaconnection/?fref=ts">https://www.facebook.com/groups/kizombaconnection/?fref=ts</a><br />\r\nProfil : Kizomba Lille<br />\r\n<br />\r\n<br />\r\n✦✦✦ BIENVENUE ✦✦✦<br />\r\nLa 6&egrave;me &eacute;dition du festival KIZOMBA CONNECTION de Lille vous accueillera du 17 au19 Octobre 2014 &agrave; Lille (France).<br />\r\n<br />\r\nCe festival est 100% Afro- Kizomba-Semba-Afro House-Kuduro<br />\r\nUn week end de folie au top de la qualit&eacute; au top de l&rsquo;acceuil.<br />\r\n<br />\r\n✦✦✦ LIEUX D&rsquo;EXCEPTION ✦✦✦<br />\r\n:<br />\r\nWorkshop location<br />\r\n-Palais des sports de Lille<br />\r\n78 Avenue Kennedy Lille<br />\r\n3 grandes salles et une salle d&rsquo;entrainement avec DJ.<br />\r\n<br />\r\nParty location<br />\r\n-Zenith de Lille Grand Palais Boulevard Dubuisson 59800 Lille<br />\r\nUn lieu exceptionnel, en plein centre ville de Lille.<br />\r\n<br />\r\nTous les lieux sont &agrave; 10 min &agrave; pied les uns des autres et des gares<br />\r\n<br />\r\n<br />\r\n✦✦✦ ARTISTES ✦✦✦<br />\r\n<br />\r\n<br />\r\n✦KIZOMBA✦<br />\r\n&bull; Morenasso and Anais (Paris)<br />\r\n&bull; Afro Latin Connection (Ricardo, Paula, Bruno, Patricia) (Portugal)<br />\r\n&bull; Mandela and Lisa (Portugal)<br />\r\n&bull; Sara LOPEZ (Madrid)<br />\r\n&bull; Joao and Giedre (Portugal)<br />\r\n&bull; Nat NKM and Dany (Paris)<br />\r\n&bull; Georges and Laura (Paris)<br />\r\n&bull; Victor and Coralie (Paris)<br />\r\n&bull; Sa&rsquo;id and Tania (Londres)<br />\r\n&bull; Mam&rsquo;s ( Paris)<br />\r\n&bull;Sara and Frans (Bruxelles)<br />\r\n&bull; Paterne (Lille)<br />\r\n&bull; Afro Kuilombo (Lille)<br />\r\n<br />\r\nAvec la participation exceptionnelle de l&rsquo;&eacute;quipe de Social Dance Paris, nos partenaires.<br />\r\n<br />\r\n<br />\r\n✦DJ&#39;S✦<br />\r\n&bull; DJ Gass (Paris)<br />\r\n&bull; DJ Babacar Londres)<br />\r\n&bull; DJ Leda (Paris)<br />\r\n&bull; DJ adon (Madrid)<br />\r\n&bull;DJ Parker (Lille)<br />\r\n&bull;Dj Lycia (France)<br />\r\n<br />\r\n<br />\r\n✦✦✦ TARIFS ✦✦✦<br />\r\n<br />\r\nValable jusqu&rsquo;au 30 septembre 2014<br />\r\n<br />\r\n-FULL PASS : 100&euro;<br />\r\n-COMBO PASS 2 nuits pour 2 Pers : 2 FULL PASS+ 2 Nuits Chambre double<br />\r\nPetit d&eacute;jeuner compris : 167,5&euro;/pers<br />\r\nHotel B&amp;B Lille grand palais, rue Berthe Morissot Lille<br />\r\n10 minutes &agrave; pied de l&#39;&eacute;v&egrave;nement<br />\r\n-COMBO PASS 3 nuits pour 2 Pers : 2 FULL PASS+ 3 Nuits Chambre double<br />\r\nPetit d&eacute;jeuner compris : 200&euro;/pers<br />\r\nHotel B&amp;B Lille grand palais, rue Berthe Morissot Lille<br />\r\n10 minutes &agrave; pied de l&#39;&eacute;v&egrave;nement<br />\r\n<br />\r\nTous les autres tarifs (pass journ&eacute;e, party pass)<br />\r\nhttp: // <a href="http://l.facebook.com/l.php?u=http%3A%2F%2Fwww.salsa-picante.fr%2Fkizomba-connection&amp;h=LAQFZCWTv&amp;enc=AZMa4VwscgjKldvYSSbKgzXLvv5fzEJLnBW1xqqHwMcZS47mHN7Tw_g9WR4t8kD_Kfw&amp;s=1" target="_blank">www.salsa-picante.fr/kizomba-connection</a><br />\r\n<br />\r\n<br />\r\n---&gt; Vous souhaitez devenir partenaire de l&#39;&eacute;v&eacute;nement ou venir en groupe (8 personnes et plus) pour b&eacute;n&eacute;ficier de tarifs pr&eacute;f&eacute;rentiels, n&#39;h&eacute;sitez pas &agrave; nous contacter : kizomba.connection.lille@gmail.com<br />\r\n<br />\r\n✦✦✦HEBERGEMENT✦✦✦<br />\r\n<br />\r\nKizomab Connection Lille vous recommande l&rsquo;h&ocirc;tel des artistes<br />\r\nHotel B&amp;B Lille grand palais, rue Berthe Morissot Lille<br />\r\n10 minutes &agrave; pied de l&#39;&eacute;v&egrave;nement<br />\r\n<br />\r\n<br />\r\n✦✦✦PLUS D&rsquo;INFO✦✦✦<br />\r\nRetrouvez toutes les informations relatives &agrave; l&rsquo;&eacute;v&egrave;nement et toutes les photos des lieux et des pr&eacute;c&eacute;dentes &eacute;ditions via le lien suivant :<br />\r\n<br />\r\n<a href="http://l.facebook.com/l.php?u=http%3A%2F%2Fwww.salsa-picante.fr%2Fkizomba-connection&amp;h=jAQEGZUUA&amp;enc=AZMb8CR1NM1dR9FdqqK1mcNEMOUQcc6zxjLSkQCmvOGM401EDGGWJW9xR_KRpkrGoRM&amp;s=1" target="_blank">http://www.salsa-picante.fr/kizomba-connection</a><br />\r\n<br />\r\n<br />\r\n✦✦✦ R&Eacute;SERVATION ✦✦✦<br />\r\n<br />\r\n<a href="http://l.facebook.com/l.php?u=http%3A%2F%2Fwww.salsa-picante.fr%2Fkizomba-connection&amp;h=XAQGwtGhs&amp;enc=AZMwNnAcUX6pDUDeu5Ec0HpazaHrbuzjf4hB4S-vh1Zd1H5S4drblzY9qLSkuJrXCZY&amp;s=1" target="_blank">http://www.salsa-picante.fr/kizomba-connection</a><br />\r\n<br />\r\n<br />\r\n✦✦✦PETIT PLUS✦✦✦<br />\r\n<br />\r\nR&eacute;servez d&egrave;s maintenant par mail ou MP facebook (Kizomba Lille), votre T-shirt Kizomba Connection avec votre pr&eacute;nom, le m&ecirc;me que celui des artistes.<br />\r\n<br />\r\n<br />\r\n✦✦✦ CONTACT ✦✦✦<br />\r\nPour toute demande d&#39;informations, veuillez contacter Claire, organisateur et directeur artistique.<br />\r\nT&eacute;l : 06 77 56 96 84<br />\r\nMail : kizomba.connection.lille@gmail.com<br />\r\nWebsite : http: // <a href="http://l.facebook.com/l.php?u=http%3A%2F%2Fwww.salsa-picante.fr%2Fkizomba-connection&amp;h=lAQEYxTJn&amp;enc=AZOe39BDYokNndJdbfqfv9QQGg3HowWjEe26LPKkgsdpKFaJd7rvkoq1B5eyuNITZ-E&amp;s=1" target="_blank">www.salsa-picante.fr/kizomba-connection</a><br />\r\nGroup : <a href="https://www.facebook.com/groups/kizombaconnection/?fref=ts">https://www.facebook.com/groups/kizombaconnection/?fref=ts</a><br />\r\nProfil : Kizomba Lille<br />\r\n<br />\r\n<br />\r\n----------------------------------------------<br />\r\n<br />\r\nKIZOMBA CONNECTION LILLE 6ed<br />\r\n<br />\r\nWebsite : http: // <a href="http://l.facebook.com/l.php?u=http%3A%2F%2Fwww.salsa-picante.fr%2Fkizomba-connection&amp;h=NAQF76wPF&amp;enc=AZMjead6gHH66RMPtnsCiTOg0LAFlBsinfwygpWiPV_vbtBxtn-qSwSMIKJYkfVsr78&amp;s=1" target="_blank">www.salsa-picante.fr/kizomba-connection</a><br />\r\nGroup : <a href="https://www.facebook.com/groups/kizombaconnection/?fref=ts">https://www.facebook.com/groups/kizombaconnection/?fref=ts</a><br />\r\nProfil : Kizomba Lille<br />\r\n<br />\r\n<br />\r\n✦✦✦ WELCOME ✦✦✦<br />\r\n<br />\r\nThe 6th KIZOMBA CONNECTION Lille festival will welcome 17 AU19 October 2014 in Lille (France).<br />\r\nThis festival is 100% Afro- Kizomba-Semba-Afro House-Kuduro<br />\r\nA weekend of madness at the top of the quality at the top of the homepage.<br />\r\n<br />\r\n<br />\r\n✦✦✦ LOCATIONS✦✦✦<br />\r\n<br />\r\n-Evenings: Zenith of Lille<br />\r\n1 Boulevard des Cit&eacute;s Unies, 59800 Lille<br />\r\nOne of the spaces of the prestigious, also in the heart of the city.<br />\r\n<br />\r\n<br />\r\n-Workshop location<br />\r\nPalais des sports de Lille<br />\r\n78 Avenue Kennedy Lille<br />\r\nIn the heart of the city, composed of 3 spacious rooms with wooden floor, ideal for the classes+ A Training room with DJ.<br />\r\n<br />\r\nall locations are less than 15 minutes away from each other by foot and 10 minutes away from the train station<br />\r\n<br />\r\n<br />\r\n✦✦✦ ARTISTES ✦✦✦<br />\r\n<br />\r\n<br />\r\n✦KIZOMBA✦<br />\r\n&bull; Morenasso and Anais (Paris)<br />\r\n&bull; Afro Latin Connection (Ricardo, Paula, Bruno, Patricia) (Portugal)<br />\r\n&bull; Mandela and Lisa (Portugal)<br />\r\n&bull; Sara LOPEZ (Madrid)<br />\r\n&bull; Joao and Giedre (Portugal)<br />\r\n&bull; Nat NKM and Dany (Paris)<br />\r\n&bull; Georges and Laura (Paris)<br />\r\n&bull; Victor and Coralie (Paris)<br />\r\n&bull; Sa&rsquo;id and Tania (Londres)<br />\r\n&bull; Mam&rsquo;s ( Paris)<br />\r\n&bull;Sara and Frans (Bruxelles)<br />\r\n&bull; Paterne (Lille)<br />\r\n&bull; Afro Kuilombo (Lille)<br />\r\n<br />\r\nWith the special participation of the team Social Dance Paris, our partners.<br />\r\n<br />\r\n<br />\r\n✦DJ&#39;S✦<br />\r\n&bull; DJ Gass (Paris)<br />\r\n&bull; DJ Babacar Londres)<br />\r\n&bull; DJ Leda (Paris)<br />\r\n&bull; DJ adon (Madrid)<br />\r\n&bull;DJ Parker (Lille)<br />\r\n&bull;Dj Lycia (France)<br />\r\n<br />\r\n<br />\r\n✦✦✦ PRICES ✦✦✦<br />\r\n<br />\r\nValid until September 30, 2014<br />\r\n<br />\r\n-FULL PASS : 100&euro;<br />\r\n<br />\r\n-COMBO PASS 2 nights for 2 Pers : 2 FULL PASS+ 2 nights in double room<br />\r\nBreakfast included : 167,5&euro;/pers<br />\r\nHotel B&amp;B Lille grand palais, rue Berthe Morissot Lille<br />\r\n10 minutes away by foot from the festival&rsquo;s locations<br />\r\n<br />\r\n-COMBO PASS 3 night for 2 Pers : 2 FULL PASS+ 3 nights in double room<br />\r\nBreakfast included : 200&euro;/pers<br />\r\nHotel B&amp;B Lille grand palais, rue Berthe Morissot Lille<br />\r\n10 minutes away by foot from the festival&rsquo;s locations<br />\r\n<br />\r\nAll other tariffs (Day pass, party pass&hellip;)<br />\r\nhttp: // <a href="http://l.facebook.com/l.php?u=http%3A%2F%2Fwww.salsa-picante.fr%2Fkizomba-connection&amp;h=cAQG-uohU&amp;enc=AZMfT88_XjiTUIvouJunAsdqvjSCJl-RrH5hDAn20tHAWTfSp9XPiYnb0ZR_0tEMoX0&amp;s=1" target="_blank">www.salsa-picante.fr/kizomba-connection</a><br />\r\n<br />\r\n<br />\r\n---&gt; You want to become a partner or come as a group to benefit from preferential prices! Contact us : kizomba.connection.lille@gmail.com<br />\r\n<br />\r\n<br />\r\n✦✦✦ ONLINE BOOKING ✦✦✦<br />\r\n<a href="http://l.facebook.com/l.php?u=http%3A%2F%2Fwww.salsa-picante.fr%2Fkizomba-connection&amp;h=sAQEw4FFB&amp;enc=AZPkZQpYs9i4luCDCsMs25db3zITkpW1RKYXyjQ8zK8cBg7sFsFreeBrMLcYV25PID0&amp;s=1" target="_blank">http://www.salsa-picante.fr/kizomba-connection</a><br />\r\n<br />\r\n<br />\r\n✦✦✦ACCOMMODATIONS✦✦✦<br />\r\n<br />\r\nKizomba Connection Lille recommend the hotel artists<br />\r\nHotel B&amp;B Lille grand palais, rue Berthe Morissot Lille<br />\r\n10 minutes away by foot from the festival&rsquo;s locations<br />\r\n<br />\r\n✦✦✦ EXTRA✦✦✦<br />\r\nreserve from now on by e-mail or Facebook (Kizomab Lille), your T-shirt Kizomba connection with your first name, the same that the artists.<br />\r\n<br />\r\n✦✦✦MORE INFO✦✦✦<br />\r\n<br />\r\nFind all the information about the event and the pictures of places and previous editions via the following link :<br />\r\n<br />\r\n<a href="http://l.facebook.com/l.php?u=http%3A%2F%2Fwww.salsa-picante.fr%2Fkizomba-connection&amp;h=YAQGv83eb&amp;enc=AZMqLzg619_yfAQNkSd37YajjhJiJolAPJOoysiTsTfpYQ8x8gkEpxC75ikVOikjmvk&amp;s=1" target="_blank">http://www.salsa-picante.fr/kizomba-connection</a><br />\r\n<br />\r\n<br />\r\n✦✦✦CONTACT ✦✦✦<br />\r\nFor more informations, please contact Claire, Organizer and Artistic Director.<br />\r\nT&eacute;l : 06 77 56 96 84<br />\r\nMail : kizomba.connection.lille@gmail.com<br />\r\nWebsite : http: // <a href="http://l.facebook.com/l.php?u=http%3A%2F%2Fwww.salsa-picante.fr%2Fkizomba-connection&amp;h=4AQENq_Q8&amp;enc=AZOLY_DYUSUoGUCRbbGsCrRYnG1CWq9fKNB1AYYNuwQr9buiBka86KXtDSl4ka-PPA0&amp;s=1" target="_blank">www.salsa-picante.fr/kizomba-connection</a><br />\r\nGroup : <a href="https://www.facebook.com/groups/kizombaconnection/?fref=ts">https://www.facebook.com/groups/kizombaconnection/?fref=ts</a><br />\r\nProfil : Kizomba Lille</p>', 'fr'),
(15, 8, 'SOIRÉE TANGO', '<p>Pour les amateurs de tango ou pour les personnes voulant essay&eacute; le tango voici la premi&egrave;re soir&eacute;e <a href="https://www.facebook.com/lintervalle.bar">L&#39;intervalle Bar</a>.<br />\r\nIl y aura de tr&egrave;s bons danseurs professionnels qui seront de la partie.<br />\r\nDonc venez nombreux pour cette premi&egrave;re :)</p>', 'en'),
(16, 8, 'SOIRÉE TANGO', '<p>Pour les amateurs de tango ou pour les personnes voulant essay&eacute; le tango voici la premi&egrave;re soir&eacute;e <a href="https://www.facebook.com/lintervalle.bar">L&#39;intervalle Bar</a>.<br />\r\nIl y aura de tr&egrave;s bons danseurs professionnels qui seront de la partie.<br />\r\nDonc venez nombreux pour cette premi&egrave;re :)</p>', 'fr'),
(17, 9, 'SUNDAY DANCE "cours de kizomba salsa GRATUIT"', NULL, 'en'),
(18, 9, 'SUNDAY DANCE "cours de kizomba salsa GRATUIT"', '<p>Sunday dance est un concept unique dans la r&eacute;gion lilloise!<br />\r\n<br />\r\nTous les dimanches apr&egrave;s-midi venez apprendre &agrave; danser la Kizomba et la salsa cours d&eacute;butants &eacute;volutifs.<br />\r\n<br />\r\n16h30 : Ouverture des portes<br />\r\n<br />\r\n17h 18h: Cours de Kizomba (Davy et San&euml;lise)<br />\r\n<br />\r\n18h 19h: Cours de Salsa (Rom&eacute;o et San&euml;lise)<br />\r\n<br />\r\n19h 20h: after-work &quot;danse libre&quot;<br />\r\n<br />\r\nTarif Kizomba :<br />\r\n<br />\r\n26 novembre gratuit<br />\r\n6&euro; le cours &agrave; l&#39;unit&eacute;<br />\r\n5&euro; abonnement 8 cours<br />\r\n<br />\r\nTarif Salsa :<br />\r\n<br />\r\n26 novembre :<br />\r\n1 cours pris en kizomba = 1 cours gratuit en salsa<br />\r\n4&euro; le cours<br />\r\n3&euro; abonnement 8 cours<br />\r\n<br />\r\n(limitation 15 hommes et 15 femmes pour chaque cours)<br />\r\n<br />\r\nPlus d&#39;infos<br />\r\n<br />\r\nTEL: 06 45 81 47 45<br />\r\n124, bis rue de l&#39;&eacute;pid&egrave;me Tourcoing<br />\r\nProche du m&eacute;tro S&eacute;bastopol : <a href="https://goo.gl/maps/Ujopn" target="_blank">https://goo.gl/maps/Ujopn</a></p>', 'fr'),
(19, 10, 'SOIREE SALSA ♦♦♦CUBA SI♦♦♦', '<p>Soir&eacute;e Salsa &laquo; CUBA SI &raquo; avec ACHE CUBANO<br />\r\n<br />\r\nLe retour des soir&eacute;es cubaines &agrave; Lille &agrave; ne pas manquer sur la piste.<br />\r\nUn parquet de plus de 150m&sup2; sera post&eacute; pour vous lors de la soir&eacute;e.<br />\r\nEn plein centre de ville (INITIATION + D&Eacute;MONSTRATION + SOIR&Eacute;E DJs).<br />\r\nTous les 3eme dimanches du mois on aura un Nouveau Spectacle avec des invit&eacute;s de Lille et de la r&eacute;gion (Djs, danseurs pro, troupes de danses, etc...).<br />\r\nUn Cours de Salsa sera donner pour l&rsquo;&eacute;cole ACHE CUBANO, des D&eacute;butants aux Confirm&eacute;.<br />\r\n<br />\r\nDJ Guest - (Salsa, Bachata, Kizomba, Reggaeton...)<br />\r\n<br />\r\nAu programme :<br />\r\n19h30 : Ouverture des Portes<br />\r\n20h00 : Initiation Salsa (offert)<br />\r\n22h30 : D&eacute;monstration Rueda de Casino<br />\r\n22h45 : Rueda g&eacute;ante avec tous les participant<br />\r\nSoir&eacute;e Salsa jusqu&rsquo;au bout de la nuit<br />\r\n<br />\r\nPaf : 2 euros<br />\r\nLieu : Le Bar Palmarium - 435, rue Gambetta - 59000 Lille<br />\r\nInfos : 06 61 04 26 53<br />\r\n<a href="http://www.achecubano.com/" target="_blank">http://www.achecubano.com/</a></p>', 'fr'),
(20, 11, 'Les Danseurs du Nord au Paris Bachata Festival avec Jérémy et Mélissa', '<p>J&eacute;r&eacute;my et M&eacute;lissa ( Addict&#39;Bachata ) en collaboration avec <a href="https://www.facebook.com/salsapicante.lille">Salsa Picante Lille</a> vous invitent a partager un week end riche en Bachata du 21 au 23 Novembre 2014 !<br />\r\n<br />\r\nEn effet nous organisons le week-end ainsi que le logement et d&eacute;placement pour le plus grand Festival de France avec les Artistes Internationaux les plus grands en Bachata le PARIS FESTIVAL BACHATA 2014. On s&#39;occupe de tout !<br />\r\n<br />\r\n3 jours de danse et de formation intensifs pour pousser l apprentissage de la Bachata au maximum &agrave; nos cot&eacute;s !<br />\r\n<br />\r\nInfos pratiques et Tarifs promotionnels aupr&egrave;s de J&eacute;r&eacute;my M&eacute;lissa Bachateros<br />\r\n<br />\r\nInfos du Festival sur<br />\r\n<br />\r\n<a href="http://www.parisbachatafestival/" target="_blank">http://www.parisbachatafestival/</a></p>', 'en'),
(21, 12, 'CONCERT LIVE SALSA "PATA NEGRA"+DJ DIAF MIX LIVE KIZOMBA SALSA avec VIOLON+I', '<p><br />\r\nCONCERT LIVE SALSA &quot;PATA NEGRA&quot; + DJ TONTON DIAF &quot;KIZOMBA SALSA&quot;accompagn&eacute; VIOLON LIVE+initiation kizomba et salsa<br />\r\n<br />\r\npassion, f&ecirc;te, convivialit&eacute; garantie!! un rayon de soleil par la musique au latin dance!<br />\r\n<br />\r\n20H30 - 22H30 INITIATION KIZOMBA SALSA gratuit<br />\r\n<br />\r\n20h30 - 21h30 initiation &agrave; la kizomba par davy et san&euml;lise (gratuit)<br />\r\n<br />\r\n21h30 - 22h30 initiation &agrave; la salsa par rom&eacute;o et san&euml;lise (gratuit)<br />\r\n<br />\r\n22h30 - 3h00 MIX LIVE KIZOMBA SALSA + VIOLON<br />\r\n<br />\r\nPour la premi&egrave;re fois dans la r&eacute;gion!!! Tonton diaf mixera kizombachata accompagn&eacute; par une violoniste talentueuse<br />\r\nqui donnera de la virtuosit&eacute; dans cette soir&eacute;e!<br />\r\n<br />\r\n23h00-00h00 CONCERT LIVE PATA NEGRA<br />\r\n<br />\r\ngroupe de salsa r&eacute;uni autour du chanteur ANTONIO SANCHEZ arrivant de colombie va enflammer le latin dance! leur r&eacute;pertoire est compos&eacute; de standard afro cubain diffusera de la chaleur et &eacute;nergie! avis aux amateurs de musique latines, danser sur du live, de quoi d&eacute;cupler le plaisir des danseurs!!<br />\r\n<br />\r\nl&#39;orchestre rassemble des artistes provenant des formations reconnues vetex swinging partout djamel laroussi, groovy nations!<br />\r\n<br />\r\n<br />\r\n<br />\r\nHORAIRES : 20h30 3h00<br />\r\npaf : 3&euro;<br />\r\n&quot;&quot;&quot;&quot; des coupes offertes a ceux qui repondent correctement aux rom s questions!<br />\r\nLATIN DANCE : 124 b rue de l&#39;&eacute;pid&egrave;me tourcoing<br />\r\ninfo : 06 45 81 47 45<br />\r\n<br />\r\ndress code : costard cravate pour le hommes!<br />\r\nrobe de princesse pour les filles!<br />\r\n<br />\r\ntout ceux qui jouent le jeu auront le droit &agrave; un chocolat et une photo souvenir bisoux!!</p>', 'en'),
(22, 13, 'L''AFRO LATIN-Social Dance Continent-Lille', '<p>✦✦✦✦L&rsquo;AFRO/LATIN &laquo; Le nouveau continent &raquo; ✦✦✦<br />\r\n-------1 salle salsa/bachata+1 salle kizomba ------------<br />\r\n<br />\r\n-------------------2 SALLES / 2 AMBIENCES------------------<br />\r\n-----------------------de 20h30 &agrave; 4h------------------------------<br />\r\n<br />\r\n<br />\r\nExclusivit&eacute; Salsa Picante et Afro Kuilombo Lotus Salsa et le B-Floor Lille<br />\r\n<br />\r\nNouveau et unique concept &agrave; Lille, changez d&rsquo;ambiance &agrave; votre gr&eacute;<br />\r\n<br />\r\n<br />\r\n☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎<br />\r\nROOM AFRO----Kizomba/semba /funana/afro beats<br />\r\n☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎<br />\r\n<br />\r\nAfro Kuilombo/Lotus Salsa<br />\r\n<br />\r\n-20h30- 22h: COURS KIZOMBA<br />\r\n<br />\r\ncouple de danseur afro parisien connu et reconnu(invit&eacute;s &agrave; Lille festival kizomba connection)<br />\r\n<br />\r\n<br />\r\n-22h-1h: Soir&eacute;e 100% Afro<br />\r\n-1h-2h : Soir&eacute;e mixte dans 1 salle<br />\r\n<br />\r\n-2h- 4h: Soir&eacute;e 100% Afro<br />\r\nDJ Parker-style kiz hit, kiz traditionnel, semba-<br />\r\nDJ Sparrow - style kiz, semba-<br />\r\n<br />\r\n<br />\r\nPAF soir&eacute;e: 5 euros+1 conso<br />\r\nPAF cours: 8 euros (soir&eacute;e incluse sans conso)<br />\r\n<br />\r\n<br />\r\n<br />\r\n☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎<br />\r\nLATIN ROOM----Salsa/bachata<br />\r\n☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎☀︎<br />\r\nSalsa Picante<br />\r\n<br />\r\n20h-21h Cours Bachata D&eacute;butant avec Addic&rsquo;t Bachata J&eacute;r&eacute;my et M&eacute;lissa (d&egrave;s le 3 octobre)<br />\r\n<br />\r\n-21h15 Initiation Animation salsa<br />\r\n-22h -2h DJ Afro Latin mix 100% SALSA/BACHATA<br />\r\n-2h-4h Soir&eacute;e 100%afro<br />\r\nDJ Parker, DJ Sparrow<br />\r\n<br />\r\nPAF soir&eacute;e: 5 euros+1 conso<br />\r\n<br />\r\n<br />\r\n<br />\r\nB-FLOOR Lille<br />\r\n13 rue Goeffroy de Saint Hillaire Lille<br />\r\n..............................................................................................<br />\r\nNe plus manquer nos soir&eacute;es! Recevez nos alertes SMS en envoyant &quot;salsa&quot; au 0616593738<br />\r\n..............................<a href="http://l.facebook.com/l.php?u=http%3A%2F%2Fwww.salsa-picante.fr%2F&amp;h=RAQG-OaIb&amp;enc=AZNkl2kMETWhlpxrGfXzbZZ1svwFI9a09xZy0C4cedbbGDaZA6hAx2iRpT8YHFkwjWE&amp;s=1" target="_blank">www.salsa-picante.fr.</a>..........................</p>', 'en'),
(23, 14, 'Soirée AfroLatin St Catherine Hacienda des Saveurs Dunkerque Plage', '<p>Rythm&#39;n Style et L&#39;Hacienda des Saveurs ont le plaisir de vous faire part de leur soir&eacute;e AfroLatin Party sp&eacute;cial St Catherine le Samedi 22 Novembre 2014 avec cours de danse latine(Salsa, Bachata, kizomba,...) offert d&egrave;s 21h00 dans un cadre exceptionnel, au restaurant l&#39;Hacienda des Saveurs Dunkerque Plage (terrasse et vue sur la mer).<br />\r\nUne rose sera offerte &agrave; toutes les filles par le fleuriste Gypsophile<br />\r\n<br />\r\nSoir&eacute;e Latino Salsa<br />\r\nSamedi 22 Novembre 2014 de 21h00 &agrave; 02H00<br />\r\n<br />\r\n21h00 : Cours d&#39;initiation (Salsa, Bachata, Kizomba...) offert<br />\r\n22h00 : Soir&eacute;e Latino (Bachata-Salsa-Merengue-Zouk-Kuduro-Kizomba-Reggaeton)<br />\r\n<br />\r\nLieu : Restaurant l&#39;hacienda des Saveurs - 6/7 digue des alli&eacute;s - 59140 Dunkerque Plage sur la digue de mer.<br />\r\n<br />\r\nPossibilit&eacute; de restauration r&eacute;servation Hacienda T&eacute;l : 03.28.60.18.66<br />\r\n<br />\r\nEntr&eacute;e 6&euro;/8&euro; (Soir&eacute;e Latino + cours)<br />\r\n<br />\r\nInfoline : 06.09.36.30.68 <a href="http://www.rythmnstyle.com/" target="_blank">www.rythmnstyle.com</a></p>', 'en'),
(24, 15, 'Soirée KIZOMBA+Cours de Semba De Roda', '<p>Soir&eacute;e KIZOMBA+ Cours de Semba de Roda.<br />\r\n<br />\r\nSoir&eacute;e S&eacute;ciale Kizomba-Semba-Afro Beat. Ce mercredi 26 Novembre, au ZANGO, la Kizomba, Semba et Afro beat seront &agrave; l&#39;honneur.<br />\r\n<br />\r\nINFO<br />\r\nEntr&eacute;e 5&euro; Avec 1 Conso.<br />\r\n<br />\r\nD&egrave;s 20h00 ouverture des portes.<br />\r\n<br />\r\n- 20h00 &agrave; 21h00 Cours de salsa d&eacute;butant (Avec Salsa Siglo Veinte)<br />\r\n<br />\r\n- 21h00 &agrave; 22h00 Cours de Semba de Roda avec Alex et Josh de Studio Afro Latino LILLE.<br />\r\n<br />\r\nTarif cours : 6&euro; de l&#39;heure ( une boisson &agrave; 3&euro; comprise)<br />\r\n<br />\r\n- 22h00 - 00h30 : soir&eacute;e DJ KIZOMBA semba,afrobeat ,avec Dj Invit&eacute;.<br />\r\n<br />\r\nRestauration possible<br />\r\n<br />\r\nZANGO<br />\r\n36, Rue de Gand, 59000 Lille<br />\r\n<br />\r\nMetro:<br />\r\nRihour (Ligne 1)<br />\r\nGare Lille Flandres (Ligne 2)<br />\r\n<br />\r\nPARKING:<br />\r\nAvenue du Peuple Belge.</p>', 'en'),
(25, 16, 'Cours de bachata', '<p>Avec Allan<br />\r\n&nbsp;</p>', 'en'),
(26, 17, 'Cours de danses latinas au MACONDO', '<p>&Ccedil;a y est !!! Nous demarrons les cours des danses latinas ce mardi 24 de novembre dans la cave du Macondo L&#39;id&eacute;e c&#39;est de vous donner la possibilit&eacute; d&#39;apprendre &agrave; danser la Salsa, mais aussi la Bachata et le Reggeaton, grace &agrave; un cours d&#39;1h30. Pour participer inscrivez-vous &agrave; cet &eacute;v&egrave;nement ou venez directement demain au Macondo... Pour cette premi&egrave;re seance il y aura des petites surprises..<br />\r\n<br />\r\nPrix des cours:<br />\r\n- 7 euros la s&eacute;ance.<br />\r\n- 50 euros le forfait de 10 cours.<br />\r\n<br />\r\nApr&egrave;s les cours vous pouvez rester pour mettre en pratique vos talents acquis !!!</p>', 'fr'),
(27, 18, 'Timba Con Funk 8', '<p>avec n</p>', 'fr'),
(28, 19, 'CUBANA BAR LENS', '<p>Cours de salsa avec Sonia (d&eacute;butants 20h/interm&eacute;diaires 21h15)+soir&eacute;e</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>', 'en'),
(29, 20, 'MILONGA TANGO KORTRIJK', '<p>&nbsp;</p>\r\n\r\n<p>Pratique de tango tous les jeudis &agrave; COURTRAI :</p>\r\n\r\n<p>Balletzaal Schouwburg via ingang in de Hazelaarstraat 7 - KORTRIJK</p>\r\n\r\n<p>De 20H00 &agrave; 23H30.</p>\r\n\r\n<p><a href="https://www.facebook.com/events/727839307288112/?ref_dashboard_filter=upcoming">https://www.facebook.com/events/727839307288112/?ref_dashboard_filter=upcoming</a></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>', 'fr'),
(30, 21, '★ ☆ VENDREDI 5/12 - DIABLITO LATINO : LE RETOUR ! ☆ SOIREE de RE-OUVERTURE avec DJ ROBERTO BURGOS et', '<p>★ ☆ DIABLITO LATINO : LE RETOUR ! ☆ ★<br />\r\n<br />\r\n★ ☆ SOIREE de RE-OUVERTURE du DIABLITO LATINO, l&#39;endroit le plus latino de Paris ! ☆ ★<br />\r\n<br />\r\n★ VENDREDI 5 DECEMBRE ! ★<br />\r\n<br />\r\nLes RDV incontournables des salseras et salseros: tous les vendredis &agrave; partir de 20h au DIABLITO LATINO!!!<br />\r\n<br />\r\n☆ Cours de Salsa cubaine avec HERMINIO &amp; CAROLE<br />\r\n20h: niveau d&eacute;butant<br />\r\n21h: niveau interm&eacute;diaire-avanc&eacute;<br />\r\n<br />\r\n- Cours + Soir&eacute;e: 10 Euros<br />\r\n- Soir&eacute;e + Buffet + boisson Soft : 15 Euros<br />\r\n<br />\r\n♬♪♬ Soir&eacute;e anim&eacute;e par notre c&eacute;l&egrave;bre DJ ROBERTO BURGOS de Radio Latina ! ♬♪♬&nbsp;<br />\r\n<br />\r\nNous comptons sur votre pr&eacute;sence &agrave; partir de 20h pour faire revivre et tous se retrouver dans l&#39;endroit le plus latino de Paris pour faire la Fiesta de Cuba avec nous!<br />\r\nOn compte sur vous!&nbsp;<br />\r\nBONNE HUMEUR et AMBIANCE CHALEUREUSE GARANTIES !!!<br />\r\n<br />\r\nSALSA Y FIESTA!!! Aqui, el que baila, gana!!! Venez vibrer sur les rythmes latinos!!!<br />\r\n<br />\r\nLe DIABLITO LATINO: 45 rue St S&eacute;bastien 75011 PARIS - M&deg; St-Ambroise ou Richard Lenoir ou Oberkamf<br />\r\nSalle climatis&eacute;e<br />\r\n<br />\r\nINFOLINE : 06.30.63.54.36<br />\r\n<a href="http://l.facebook.com/l.php?u=http%3A%2F%2Fwww.salsanuestra.com%2F&amp;h=UAQEwv2Y-&amp;enc=AZM73jGwpv3I1sxpCW8m29sRSIYjrCciYToIgwcW1IcE8so1q1Z0ucf9qBpjUka6xyk&amp;s=1" target="_blank">www.salsanuestra.com</a></p>', 'fr'),
(31, 22, 'VENDREDI 5/12 - DIABLITO LATINO : LE RETOUR ! SOIREE de RE-OUVERTURE avec DJ ROBERTO BURGOS', '<p>★ ☆ DIABLITO LATINO : LE RETOUR ! ☆ ★<br />\r\n<br />\r\n★ ☆ SOIREE de RE-OUVERTURE du DIABLITO LATINO, l&#39;endroit le plus latino de Paris ! ☆ ★<br />\r\n<br />\r\n★ VENDREDI 5 DECEMBRE ! ★<br />\r\n<br />\r\nLes RDV incontournables des salseras et salseros: tous les vendredis &agrave; partir de 20h au DIABLITO LATINO!!!<br />\r\n<br />\r\n☆ Cours de Salsa cubaine avec HERMINIO &amp; CAROLE<br />\r\n20h: niveau d&eacute;butant<br />\r\n21h: niveau interm&eacute;diaire-avanc&eacute;<br />\r\n<br />\r\n- Cours + Soir&eacute;e: 10 Euros<br />\r\n- Soir&eacute;e + Buffet + boisson Soft : 15 Euros<br />\r\n<br />\r\n♬♪♬ Soir&eacute;e anim&eacute;e par notre c&eacute;l&egrave;bre DJ ROBERTO BURGOS de Radio Latina ! ♬♪♬&nbsp;<br />\r\n<br />\r\nNous comptons sur votre pr&eacute;sence &agrave; partir de 20h pour faire revivre et tous se retrouver dans l&#39;endroit le plus latino de Paris pour faire la Fiesta de Cuba avec nous!<br />\r\nOn compte sur vous!&nbsp;<br />\r\nBONNE HUMEUR et AMBIANCE CHALEUREUSE GARANTIES !!!<br />\r\n<br />\r\nSALSA Y FIESTA!!! Aqui, el que baila, gana!!! Venez vibrer sur les rythmes latinos!!!<br />\r\n<br />\r\nLe DIABLITO LATINO: 45 rue St S&eacute;bastien 75011 PARIS - M&deg; St-Ambroise ou Richard Lenoir ou Oberkamf<br />\r\nSalle climatis&eacute;e<br />\r\n<br />\r\nINFOLINE : 06.30.63.54.36<br />\r\n<a href="http://l.facebook.com/l.php?u=http%3A%2F%2Fwww.salsanuestra.com%2F&amp;h=UAQEwv2Y-&amp;enc=AZM73jGwpv3I1sxpCW8m29sRSIYjrCciYToIgwcW1IcE8so1q1Z0ucf9qBpjUka6xyk&amp;s=1" target="_blank">www.salsanuestra.com</a></p>', 'fr'),
(32, 23, 'VENDREDI - DIABLITO LATINO : LE RETOUR      SOIREE de RE-OUVERTURE avec DJ ROBERTO BURGOS', '<p>★ ☆ DIABLITO LATINO : LE RETOUR ! ☆ ★<br />\r\n<br />\r\n★ ☆ SOIREE de RE-OUVERTURE du DIABLITO LATINO, l&#39;endroit le plus latino de Paris ! ☆ ★<br />\r\n<br />\r\n★ VENDREDI 5 DECEMBRE ! ★<br />\r\n<br />\r\nLes RDV incontournables des salseras et salseros: tous les vendredis &agrave; partir de 20h au DIABLITO LATINO!!!<br />\r\n<br />\r\n☆ Cours de Salsa cubaine avec HERMINIO &amp; CAROLE<br />\r\n20h: niveau d&eacute;butant<br />\r\n21h: niveau interm&eacute;diaire-avanc&eacute;<br />\r\n<br />\r\n- Cours + Soir&eacute;e: 10 Euros<br />\r\n- Soir&eacute;e + Buffet + boisson Soft : 15 Euros<br />\r\n<br />\r\n♬♪♬ Soir&eacute;e anim&eacute;e par notre c&eacute;l&egrave;bre DJ ROBERTO BURGOS de Radio Latina ! ♬♪♬&nbsp;<br />\r\n<br />\r\nNous comptons sur votre pr&eacute;sence &agrave; partir de 20h pour faire revivre et tous se retrouver dans l&#39;endroit le plus latino de Paris pour faire la Fiesta de Cuba avec nous!<br />\r\nOn compte sur vous!&nbsp;<br />\r\nBONNE HUMEUR et AMBIANCE CHALEUREUSE GARANTIES !!!<br />\r\n<br />\r\nSALSA Y FIESTA!!! Aqui, el que baila, gana!!! Venez vibrer sur les rythmes latinos!!!<br />\r\n<br />\r\nLe DIABLITO LATINO: 45 rue St S&eacute;bastien 75011 PARIS - M&deg; St-Ambroise ou Richard Lenoir ou Oberkamf<br />\r\nSalle climatis&eacute;e<br />\r\n<br />\r\nINFOLINE : 06.30.63.54.36<br />\r\n<a href="http://l.facebook.com/l.php?u=http%3A%2F%2Fwww.salsanuestra.com%2F&amp;h=UAQEwv2Y-&amp;enc=AZM73jGwpv3I1sxpCW8m29sRSIYjrCciYToIgwcW1IcE8so1q1Z0ucf9qBpjUka6xyk&amp;s=1" target="_blank">www.salsanuestra.com</a></p>', 'fr'),
(33, 24, 'COURS DE SALSA(gratuit)', '<p>Cours de Salsa suivi de soir&eacute;e 100% latino<br />\r\nVenez nombreux!!</p>', 'en'),
(34, 25, 'Salsa Party n°2 @ St Quentin !!!', '<p>Bonjour &agrave; tous !!!<br />\r\n<br />\r\nIl est temps d&#39;annoncer toutes les infos concernant la Salsa Party n&deg;2 @ St Quentin !<br />\r\n<br />\r\nVoici le programme !<br />\r\n<br />\r\n☺ Workshop Funky Cuban Salsa avec Slimane &amp; Marie ! Si vous ne les connaissez pas encore, il est temps d&#39;y rem&eacute;dier ! Un duo d&#39;enfer avec un pass&eacute; de hip hop, vous allez aimer leur Cool Attitude en Salsa c&#39;est s&ucirc;r !!!<br />\r\n<br />\r\n<br />\r\n☺ Vente de chaussures de danse, ne ratez pas &ccedil;a ! Nous accueillons de nouveaux vendeurs : sponsors de Danse avec les Stars, rien que &ccedil;a !!!!<br />\r\nChaussures sur mesure : couleur, hauteur, forme, strass, pas strass, gar&ccedil;ons, filles, c&#39;est VOUS qui choisissez pour des chaussures 100% personnalis&eacute;es !!!!!!<br />\r\n<br />\r\n☺ Comme toujours, Snacks &amp; Softs &agrave; volont&eacute; !<br />\r\n<br />\r\n☺ St Quentin, c&#39;est des soir&eacute;es avec des danseurs de tous horizons : St Quentin, P&eacute;ronne, Cambrai, Arras, Lille, Reims, Amiens,Compi&egrave;gne, Beauvais, Soissons, Laon et j&#39;en passe, ne soyez pas en reste !<br />\r\n<br />\r\nAvec un programme pareil, impossible de rater cette soir&eacute;e !!<br />\r\n<br />\r\n~Salsa Cubaine &amp; Porto, Bachata, Kizomba, ChaCha...~<br />\r\n<br />\r\nEntr&eacute;e 10 euros, 21h @ 3 rue du Chene de Cambrie<br />\r\n02720 Mesnil-Saint-Laurent.<br />\r\n<br />\r\nGrande salle avec parquet, possibilit&eacute; de commander des boissons alcoolis&eacute;es &agrave; prix minis au bar !<br />\r\n<br />\r\nOn vous attend nombreux pour f&ecirc;ter la derni&egrave;re soir&eacute;e de 2014 avec Salsa Addict ! :D<br />\r\n<br />\r\n☼☼☼</p>', 'fr'),
(35, 25, 'Salsa Party n°2 @ St Quentin !!!', NULL, 'en'),
(36, 26, 'DURSIN SALSA, BACHATA & KIZ PARTY', '<p>1 des Soir&eacute;es Salsa les plus populaires de Flandres avec salle KIZOMBA<br />\r\n1 vd populairste maandelijkse Salsa Parties uit Vlaanderen met KIZOMBA-zaal<br />\r\n* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *<br />\r\nROOM 1 Salsa-bachata 21h &ndash;3h<br />\r\n<br />\r\n&ndash; guest dj BARTOLOMEO (B) salsa cubana, bachata<br />\r\n&ndash; guest dj LATIN AFFAIR (F) salsa portoricaine, bachata<br />\r\n<br />\r\nROOM 2 Kizomba 23h&ndash;3h<br />\r\n<br />\r\n&ndash; guest dj TONTON DIAF (F)<br />\r\n<br />\r\nEntree 5 euro</p>', 'fr'),
(37, 27, 'SOIRÉE "A LO CUBANO"', '<p>Soir&eacute;e DJ Avec le meilleur de la timba et de la musica cubana<br />\r\n<br />\r\n<br />\r\n**********************************************************<br />\r\n# LES COURS DE SALSA #<br />\r\nD&egrave;s 20h00 ouverture des portes.<br />\r\n<br />\r\n- 20h00 &agrave; 21h00 Cours de salsa D&eacute;butant<br />\r\n<br />\r\n- 21h00 &agrave; 22h00 Cours de salsa interm&eacute;diaire<br />\r\n<br />\r\n(Cours avec Kevin, Gauthier, Elodie.)<br />\r\n<br />\r\nMerci d&#39;arriver 10minutes avant le cours pour qu&#39;il puisse commencer &agrave; l&#39;heure.<br />\r\n<br />\r\nTarif cours : 6&euro; de l&#39;heure ( une boisson &agrave; 3&euro; comprise)<br />\r\n<br />\r\n**********************************************************<br />\r\n# LA SOIR&Eacute;E #<br />\r\n<br />\r\n- 22h00 - 00h30 : soir&eacute;e DJ<br />\r\nDJ GOT / DJ KEV / DJ ELMORRO<br />\r\n<br />\r\nPAF : 5&euro; (avec une boisson)<br />\r\nRestauration possible<br />\r\n<br />\r\n**********************************************************<br />\r\n<br />\r\nZANGO<br />\r\n36, Rue de Gand, 59000 Lille<br />\r\n<br />\r\nMetro:<br />\r\nRihour (Ligne 1)<br />\r\nGare Lille Flandres (Ligne 2)<br />\r\n<br />\r\nPARKING:<br />\r\nAvenue du Peuple Belge</p>', 'fr'),
(38, 28, 'LES VENDREDIS LATINOS CALIENTES au DIABLITO LATINO ! ☆ avec DJ JULIAN et HERMINIO & CAROLE !', '<p>Les RDV incontournables des salseras et salseros: tous les vendredis &agrave; partir de 20h au DIABLITO LATINO!!!<br />\r\n<br />\r\n☆ Cours de Salsa cubaine avec HERMINIO &amp; CAROLE :<br />\r\n- 20h: niveau d&eacute;butant<br />\r\n- 21h: niveau interm&eacute;diaire-avanc&eacute;<br />\r\n<br />\r\nTARIFS:<br />\r\n- Cours + Soir&eacute;e: 10 Euros (arrivez avant 22h)<br />\r\n- Soir&eacute;e + Buffet + boisson Soft : 15 Euros<br />\r\nVestiaire: 2 Euros par personne<br />\r\n<br />\r\n♬♪♬ Soir&eacute;e anim&eacute;e par JULIAN ! ♬♪♬<br />\r\n<br />\r\nNous comptons sur votre pr&eacute;sence &agrave; partir de 20h pour faire revivre et tous se retrouver dans l&#39;endroit le plus latino de Paris pour faire la Fiesta de Cuba avec nous!<br />\r\nOn compte sur vous!<br />\r\nBONNE HUMEUR et AMBIANCE CHALEUREUSE GARANTIES !!!<br />\r\n<br />\r\nSALSA Y FIESTA!!! Aqui, el que baila, gana!!! Venez vibrer sur les rythmes latinos!!!<br />\r\n<br />\r\nLe DIABLITO LATINO: 45 rue St S&eacute;bastien 75011 PARIS - M&deg; St-Ambroise ou Richard Lenoir ou Oberkamf<br />\r\nSalle climatis&eacute;e<br />\r\n<br />\r\nINFOLINE : 06.30.63.54.36<br />\r\n<a href="http://l.facebook.com/l.php?u=http%3A%2F%2Fwww.salsanuestra.com%2F&amp;h=CAQFlDM64&amp;enc=AZON_LyXcWh5fR7xMdkdSpUdoOIWwkCJlJRunNQIjWVgNL5hvXhl3HvarGlpAUmw2yU&amp;s=1" target="_blank">www.salsanuestra.com</a></p>', 'en'),
(39, 29, 'Stage de Rueda', '<p>Pour d&eacute;buter l&rsquo;ann&eacute;e dans la bonne humeur, l&rsquo;association Los Salsitos vous propose un stage de rueda de casino.<br />\r\nNiveau d&eacute;butant requis en salsa cubaine.<br />\r\n<br />\r\n9h-10h30 : D&eacute;butants<br />\r\n10h45-12h15 : Interm&eacute;diaires<br />\r\n<br />\r\n5&euro; le stage<br />\r\n<br />\r\nR&eacute;servation obligatoire - Merci d&#39;envoyer un mail de confirmation &agrave; los.salsitos@live.fr<br />\r\n<br />\r\nPour tout renseignements, n&rsquo;h&eacute;sitez pas &agrave; nous contacter<br />\r\nau 06.60.11.70.03 ou &agrave; l&#39;adresse los.salsitos@live.fr</p>', 'en'),
(40, 30, 'Stages de salsa et salsa con rumba avec cafe con leche', '<p>Venez partager un moment festif avec cafe con leche. Formule intensive : 3h de stage pour une progression rapide en petit groupe (attention, places limit&eacute;es)<br />\r\n16h30 : salsa con rumba avec <a href="https://www.facebook.com/kevin.lapaixao">Kev Cafeconleche</a> : d&eacute;veloppe ton style !<br />\r\n17h30 : salsa cubaine avec Mel et Herv&eacute;, pr&eacute;cision et &eacute;nergie !<br />\r\n18h30 : rueda, moment festif<br />\r\n2 niveaux : d&eacute;butants et interm&eacute;diaires<br />\r\n20&euro; pour 3h, 15&euro; pour 2h, 8 pour 1h</p>', 'en'),
(41, 31, 'Afro Latin Party Spécial Galette des Rois et Reines au Casino de Dunkerque', '<p>Rythm&#39;n Style et le Casino de Dunkerque vous pr&eacute;sentent la soir&eacute;e Afro Latin Party Sp&eacute;cial Galette des Rois et Reines le Samedi 3 janvier 2015 d&egrave;s 21h, dans un cadre exceptionnel, &agrave; Salle de Gala le LE RUBY&#39;S au Casino de Dunkerque avec parquet de danse et cours d&#39;initiation aux danses afrolatines offerts.<br />\r\n<br />\r\nGalette des Rois offert pour tous et nombreux cadeaux aux Rois et Reines de la soir&eacute;e. Boissons soft et punch &agrave; volont&eacute;.<br />\r\n<br />\r\nSoir&eacute;e Afro Latin Party Sp&eacute;cial Galette des Rois et Reines<br />\r\nSamedi 3 janvier 2015 de 21h &agrave; 02h<br />\r\n<br />\r\n19h30 : Restauration sur place &agrave; la Cascade. Menu avec soir&eacute;e, cours, Galette des Rois Soft, Punch &agrave; la soir&eacute;e &agrave; partir de 22.50&euro; r&eacute;servation au Casino de Dunkerque 03.28.28.27.77<br />\r\n21h00 : Cours d&#39;initiation aux danses latines offert par Rythm&#39;n Style ( Salsa, Bachata, Kizomba).<br />\r\n22h00 : Soir&eacute;e Afro Latin Party (Bachata-Salsa-Merengue-Kizomba)<br />\r\n<br />\r\nP.A.F. : 8&euro;(adh&eacute;rent) / 10&euro;(ext&eacute;rieur)<br />\r\n(Soir&eacute;e AfroLatino + Cours + Soft, Punch, Galette des Rois &agrave; volont&eacute;)<br />\r\n<br />\r\nLieu : Le Casino de Dunkerque - 40 place du Casino - 59240 Dunkerque <a href="http://l.facebook.com/l.php?u=http%3A%2F%2Fwww.groupetranchant.com%2F&amp;h=zAQHYWnUC&amp;enc=AZMlDhfixRBPBRwOvI00rtpqSllA5AAzll6yyjZ8ITI_qa6kNhZySXZL9iev3Dkq68c&amp;s=1" target="_blank">www.groupetranchant.com</a><br />\r\n<a href="http://l.facebook.com/l.php?u=http%3A%2F%2Fyoutu.be%2Ffw_TwLmDdpY&amp;h=fAQEhwt8b&amp;enc=AZPHp6JoFUG0PTbhbx0xfml0h04rJ_87_82K8VJ8TED-gypl6bBqu11AxuMKb0hFyJI&amp;s=1" target="_blank">http://youtu.be/fw_TwLmDdpY</a></p>', 'en'),
(42, 32, 'DURSIN NEW YEARS PARTY 2015 (salsa, bachata, kiz)', '<p>1 des Soir&eacute;es Salsa les plus populaires de Flandres avec salle KIZOMBA<br />\r\n1 vd populairste maandelijkse Salsa Parties uit Vlaanderen met KIZOMBA-zaal<br />\r\n* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *<br />\r\nROOM 1 Salsa-bachata 21h &ndash;3h<br />\r\n<br />\r\n- resident dj MARCO (salsa portorique&ntilde;a, bachata)<br />\r\n- guest dj EL BRUJO LATINO (salsa cubana, bachata)<br />\r\n<br />\r\nROOM 2 Kizomba 23h&ndash;3h<br />\r\n<br />\r\n- guest dj TONTON DIAF (F)<br />\r\n- guest dj JULIEN PARKER (F)<br />\r\n<br />\r\nEntree 5 euro</p>', 'en'),
(43, 33, 'SALSA HITS B-FLOOR LILLE', '<p>SALSA HITS La fiesta Del Pueblo<br />\r\n<br />\r\nB-Floor 13 rue Geoffroy de St Hilaire Lille<br />\r\nTous les 2&egrave;mes vendredi du mois<br />\r\n<br />\r\nDansez sur les grands classiques salsa les plus populaires&hellip;cubaines, classiques, commerciales&hellip;vari&eacute;t&eacute;s salsa &hellip;le fun d&rsquo;abord<br />\r\n<br />\r\nMarc Anthony, Los Van Van, Gilberto Santa Rosa, El Gran Combo, Africando&hellip;Grupo Niche, Maiymbe y mucho mas<br />\r\n<br />\r\n-20h-21 cours bachata d&eacute;butant avec <a href="https://www.facebook.com/jeremy.roelandt">J&eacute;r&eacute;my M&eacute;lissa Bachata</a><br />\r\n<br />\r\n-21h15 initiation salsa<br />\r\n<br />\r\n22h-3h Dj El Pueblo salsa populaires, salsa vari&eacute;t&eacute;s<br />\r\n<br />\r\nB-Floor chaque Vendredi<br />\r\n13 rue Geoffroy de St Hilaire Lille<br />\r\n(Paf 5&euro;+1conso)<br />\r\n<br />\r\n<br />\r\nNe plus manquer nos soir&eacute;es! Recevez nos alertes SMS en envoyant &quot;salsa&quot; au 0616593738<br />\r\n------------------<a href="http://l.facebook.com/l.php?u=http%3A%2F%2Fwww.salsa%2F&amp;h=XAQGY1wxw&amp;enc=AZOXdebIltnSEYYT2kuY6OiP9rbPuYq0nRqrUtbtYXQpEeroFMMRf1jQ4rW8E8W6aiM&amp;s=1" target="_blank">www.salsa</a>-picante.fr------------------</p>', 'en'),
(44, 34, 'SALSA CHIC', '<p>De la salsa dans un lieu chic! &quot;Le retour&quot;<br />\r\n<br />\r\nLieu exception, soir&eacute;e d&rsquo;exception<br />\r\n<br />\r\nDress code CHIC<br />\r\nTenue correcte c&#39;est mieux et plus Chic!!<br />\r\n(jogging/baskets interdit)<br />\r\n<br />\r\nSANS R&Eacute;SERVER, venez sur place directement &agrave; l&#39;entr&eacute;e du Bor&eacute;al le bar du casino<br />\r\n<br />\r\n<br />\r\n21h initiation SALSA ou BACHATA CHIC<br />\r\n<br />\r\n21h30 Dj SALSA CHIC SALSA/BACHATA/KIZOMBA MIXTE<br />\r\n<br />\r\nPAF 5&euro;<br />\r\nLe mojito &agrave; 5&euro;<br />\r\nParking Gratuit avec le casinopass<br />\r\n<br />\r\nComment obtenir un &quot;casino pass&quot;<br />\r\nA l&rsquo;accueil du casino pr&eacute;senter un pi&egrave;ce d&#39;identit&eacute; et demander le &quot;casino pass&quot;<br />\r\n<br />\r\nCasino Barri&egrave;re<br />\r\n777 Pont de Flandre Lille<br />\r\n<a href="http://www.casinolille.fr/" target="_blank">www.casinolille.fr</a><br />\r\n<br />\r\n<a href="http://l.facebook.com/l.php?u=http%3A%2F%2Fwww.salsa-picante.fr%2F&amp;h=cAQHcvsQR&amp;enc=AZNuyg5M_kVXMolZvp8QqvDXKspCmdYbhkNKsHiJhovP7LMUuau1T6nc4NOkjZcfjqo&amp;s=1" target="_blank">www.salsa-picante.fr</a><br />\r\ninfos directes 06.16.59.37.38</p>', 'en'),
(45, 35, 'KIZOMBA niveau Avancé/ JEREMY et ALLYSON/ by L ''A PAIXAO', '<p>L&#39;A PAIXAO Family &agrave; l&#39;honneur de vous convier &agrave; un 3 RDV immanquables !!!<br />\r\nNous organisons, d&egrave;s la rentr&eacute;e 2015 une session de cours niveau AVANCE !!<br />\r\nSi vous avez pratiqu&eacute; les deux sessions de cours d&eacute;butant et interm&eacute;diaire chez L&#39;A PAIXAO ou que vous avez suivi des cours interm&eacute;diaires ailleurs mais que vous commencez &agrave; avoir envie de nouvelles choses, cette session est faite pour vous !! Ayez confiance en vous et testez!!<br />\r\nCette session sera instruite par deux danseurs d&#39;exceptions au talent incontestable : Jeremy et Allyson (Paris).<br />\r\n<br />\r\nJeremy et Allyson sont des professeurs qui ont eu l&#39;occasion de transmettre leur savoir dans des lieux mythiques et prestigieux : Nixnox, Libertalia, United, Palacio, les soir&eacute;es &#39;we love toubana &raquo; et les soir&eacute;es de prestige &agrave; Paris, &eacute;cole de danse Piratattitude et d&#39;intervenir &agrave; Bordeaux, Nantes et Lille.<br />\r\nVous avez pu pour certains d&#39;entre vous gouter &agrave; leur cours et p&eacute;dagogie lors d&#39;un KIZ DAY by L&#39;A PAIXAO.<br />\r\n<br />\r\nPour participer nous vous proposons deux formules :<br />\r\n<br />\r\nSoit la session de 10h r&eacute;partie sur les 3 dates ci-dessous au tarif de 100&euro;<br />\r\n<br />\r\nSoit des stages &agrave; la carte, en choisissant de vous inscrire aux dates qui vous conviennent le mieux.<br />\r\n<br />\r\nLe 11 janvier de 14h &agrave; 17h (3h de cours) : 35&euro; le stage &agrave; l&#39;unit&eacute;<br />\r\n<br />\r\nLe 8 f&eacute;vrier de 14h &agrave; 17h (3h de cours) : 35&euro; le stage &agrave; l&#39;unit&eacute;<br />\r\n<br />\r\nLe 1 mars de 14H &agrave; 18H15 (4h de cours) : 45&euro; le stage &agrave; l&#39;unit&eacute;.<br />\r\nou par tranche de 2h : de 14h &agrave; 16h : 25&euro;<br />\r\nde 16h15 &agrave; 18h15 : 25&euro;<br />\r\n<br />\r\nl&#39;accueil des &eacute;l&egrave;ves se fera &agrave; chaque date &agrave; 13h45<br />\r\nLes portes se ferment entre 17h15 et 18h30 selon la fin des cours.<br />\r\n<br />\r\n<br />\r\nLe r&egrave;glement se fait en esp&egrave;ce uniquement pour cause de ch&egrave;ques non approvisionn&eacute;s par le pass&eacute;, merci de votre compr&eacute;hension. En cas de difficult&eacute;s de paiement, merci de contacter Marina L&#39;A PAIXAO qui se chargera de trouver une solution adapt&eacute;e.<br />\r\n<br />\r\nLieu des stages : salle EASY SALSA, 8 rue courtois &agrave; Lille. Parking privatis&eacute;, salle de danse adapt&eacute; et spacieuse avec miroir.<br />\r\n<br />\r\nN&#39;h&eacute;sitez pas &agrave; r&eacute;server vos cours aupr&egrave;s de Jordane L&#39;A PAIXAO via facebook<br />\r\n<br />\r\nPositivement, L&#39;A PAIXAO family<br />\r\npeace and danse<br />\r\n<br />\r\njeremy et allyson<br />\r\n<a href="https://www.facebook.com/jeremy.serin?fref=ts">https://www.facebook.com/jeremy.serin?fref=ts</a><br />\r\n<br />\r\nasso L&#39;A PAIXAO LILLE<br />\r\n<a href="https://www.facebook.com/assolapaixao.lille?fref=ts">https://www.facebook.com/assolapaixao.lille?fref=ts</a><br />\r\n<br />\r\nJordane L&#39;A PAIXAO (vice pr&eacute;sident asso L&#39;a PAIXAO<br />\r\n<a href="https://www.facebook.com/jordane.lapaixao?fref=ts">https://www.facebook.com/jordane.lapaixao?fref=ts</a><br />\r\n<br />\r\nMarina L&#39;A PAIXAO (pr&eacute;sidente asso L&#39;A PAIXAO)<br />\r\n<a href="https://www.facebook.com/marina.manno">https://www.facebook.com/marina.manno</a></p>', 'en'),
(46, 36, 'Havana en Belgrado - Stage Salsa', '<h3>Soir&eacute;e dansante au Tandem avec DJ Lemzo de 21h &agrave; 2h avec d&eacute;monstration des danseurs d&#39;Havana &agrave; 22h30 - Repas sur r&eacute;servation aupr&egrave;s de Marie.</h3>', 'fr'),
(47, 37, 'Havana en Belgrado - Stage Salsa', '<h3>Soir&eacute;e dansante au Tandem avec DJ Lemzo de 21h &agrave; 2h avec d&eacute;monstration des danseurs d&#39;Havana &agrave; 22h30 - Repas sur r&eacute;servation aupr&egrave;s de Marie.<br />\r\n<br />\r\nInscriptions et r&eacute;servations sur&nbsp;http://www.valdanse.com/stage-havana-belgrado/</h3>\r\n\r\n<p>&nbsp;</p>', 'fr');

-- --------------------------------------------------------

--
-- Structure de la table `eventtype`
--

CREATE TABLE IF NOT EXISTS `eventtype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Contenu de la table `eventtype`
--

INSERT INTO `eventtype` (`id`, `name`) VALUES
(1, 'party'),
(2, 'Festival'),
(3, 'workshop'),
(4, 'lessons'),
(5, 'Shows'),
(6, 'Concert'),
(7, 'Workshop_Party');

-- --------------------------------------------------------

--
-- Structure de la table `eventtypetranslation`
--

CREATE TABLE IF NOT EXISTS `eventtypetranslation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_DDB9698C2C2AC5D34180C698` (`translatable_id`,`locale`),
  KEY `IDX_DDB9698C2C2AC5D3` (`translatable_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Contenu de la table `eventtypetranslation`
--

INSERT INTO `eventtypetranslation` (`id`, `translatable_id`, `title`, `locale`) VALUES
(1, 1, 'Party', 'en'),
(2, 1, 'Soirée', 'fr'),
(3, 2, 'Festival', 'en'),
(4, 2, 'Festival', 'fr'),
(5, 3, 'Workshop', 'en'),
(6, 3, 'Workshop', 'fr'),
(7, 4, 'Lessons', 'en'),
(8, 4, 'Cours', 'fr'),
(9, 5, 'Shows', 'en'),
(10, 5, 'Shows', 'fr'),
(11, 6, 'Concert', 'en'),
(12, 6, 'Concert', 'fr'),
(13, 7, 'Workshop & Party', 'en'),
(14, 7, 'Cours & Soirée', 'fr');

-- --------------------------------------------------------

--
-- Structure de la table `event_address`
--

CREATE TABLE IF NOT EXISTS `event_address` (
  `address_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  PRIMARY KEY (`address_id`,`event_id`),
  KEY `IDX_8819C62EF5B7AF75` (`address_id`),
  KEY `IDX_8819C62E71F7E88B` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `event_address`
--

INSERT INTO `event_address` (`address_id`, `event_id`) VALUES
(3, 1),
(4, 2),
(5, 3),
(6, 4),
(7, 5),
(8, 6),
(9, 7),
(10, 8),
(11, 9),
(12, 10),
(13, 11),
(14, 12),
(15, 13),
(16, 14),
(17, 15),
(18, 16),
(19, 17),
(20, 18),
(22, 19),
(23, 20),
(24, 23),
(25, 24),
(26, 25),
(27, 26),
(28, 27),
(29, 28),
(30, 29),
(31, 30),
(32, 31),
(33, 32),
(34, 33),
(35, 34),
(36, 35),
(37, 37);

-- --------------------------------------------------------

--
-- Structure de la table `event_eventdates`
--

CREATE TABLE IF NOT EXISTS `event_eventdates` (
  `event_id` int(11) NOT NULL,
  `eEventDate_id` int(11) NOT NULL,
  PRIMARY KEY (`eEventDate_id`,`event_id`),
  KEY `IDX_70B50385C3CCAD7E` (`eEventDate_id`),
  KEY `IDX_70B5038571F7E88B` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `event_eventdates`
--

INSERT INTO `event_eventdates` (`event_id`, `eEventDate_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(5, 4),
(6, 5),
(7, 6),
(8, 7),
(4, 8),
(9, 9),
(9, 10),
(9, 11),
(9, 12),
(9, 13),
(9, 14),
(9, 15),
(9, 16),
(10, 17),
(10, 18),
(11, 19),
(12, 20),
(13, 21),
(13, 22),
(13, 23),
(14, 24),
(15, 25),
(16, 26),
(16, 27),
(16, 28),
(16, 29),
(16, 30),
(16, 31),
(16, 32),
(16, 33),
(16, 34),
(16, 35),
(16, 36),
(16, 37),
(16, 38),
(16, 39),
(17, 40),
(18, 41),
(19, 42),
(19, 43),
(19, 44),
(19, 45),
(19, 46),
(19, 47),
(19, 48),
(19, 49),
(19, 50),
(19, 51),
(19, 52),
(19, 53),
(20, 55),
(20, 56),
(20, 57),
(20, 58),
(20, 59),
(20, 60),
(23, 61),
(24, 62),
(25, 63),
(26, 64),
(27, 65),
(28, 66),
(28, 67),
(28, 68),
(28, 69),
(28, 70),
(28, 71),
(28, 72),
(28, 73),
(28, 74),
(28, 75),
(28, 76),
(28, 77),
(28, 78),
(28, 79),
(28, 80),
(28, 81),
(28, 82),
(28, 83),
(29, 84),
(30, 85),
(31, 86),
(32, 87),
(33, 88),
(34, 89),
(35, 90),
(5, 91),
(27, 92),
(27, 93),
(27, 94),
(27, 95),
(37, 96),
(16, 97),
(16, 98),
(16, 99),
(16, 100),
(16, 101),
(16, 102),
(16, 103),
(16, 104),
(16, 105),
(16, 106),
(16, 107),
(16, 108),
(16, 109),
(16, 110),
(16, 111),
(16, 112),
(16, 113),
(16, 114),
(4, 115),
(33, 116);

-- --------------------------------------------------------

--
-- Structure de la table `event_file`
--

CREATE TABLE IF NOT EXISTS `event_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7009450771F7E88B` (`event_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=45 ;

--
-- Contenu de la table `event_file`
--

INSERT INTO `event_file` (`id`, `event_id`, `name`) VALUES
(13, 7, 'festival_kizomba.jpg'),
(14, 1, 'macumba_allstar.jpg'),
(15, 2, 'latin_sensation.jpg'),
(16, 3, 'festival_cubano_orange.jpg'),
(17, 4, 'latin_cocktail.jpg'),
(18, 5, 'dursin.jpg'),
(19, 6, 'cuban_exclisve.jpg'),
(20, 8, 'interval.jpg'),
(21, 9, 'latin_dance_trcg.jpg'),
(22, 10, 'cubano_si_palmarium.jpg'),
(23, 11, 'paris_bachata_festival.jpg'),
(24, 13, 'afro_latin_bfloor.jpg'),
(25, 14, 'hacienda_des_saveurs_afro_latin.jpg'),
(26, 15, 'kizango.jpg'),
(27, 16, 'bachata_lundi_intervalle.jpg'),
(28, 17, 'macondo.jpg'),
(29, 19, 'cubana bar.jpg'),
(30, 20, 'COURTRAI TANGO.jpg'),
(31, 23, '10431495_10204539909491246_1816815981336588980_n-2.jpg'),
(32, 24, 'cours_intervalle.jpg'),
(33, 25, 'salsa_st_quentin.jpg'),
(34, 26, 'dursin.jpg'),
(35, 27, 'zango_salsa_cubana.jpg'),
(36, 28, 'vendredi_diablito.jpg'),
(37, 29, 'stage_rueda.jpg'),
(38, 30, 'stage_rumba.jpg'),
(39, 31, 'afro_latin_malo.jpg'),
(40, 32, 'dursin.jpg'),
(41, 33, 'salsa_hits.jpg'),
(42, 34, 'salsa_chic.jpg'),
(43, 35, 'kiz_jermy_allyson.jpg'),
(44, 37, 'HAVANA-BELGRADO-ET-VALDANDE-2015.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `event_musictype`
--

CREATE TABLE IF NOT EXISTS `event_musictype` (
  `event_id` int(11) NOT NULL,
  `musicType_id` int(11) NOT NULL,
  PRIMARY KEY (`event_id`,`musicType_id`),
  KEY `IDX_8416D26661A9175` (`musicType_id`),
  KEY `IDX_8416D2671F7E88B` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `event_musictype`
--

INSERT INTO `event_musictype` (`event_id`, `musicType_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(9, 1),
(10, 1),
(12, 1),
(14, 1),
(17, 1),
(18, 1),
(19, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(36, 1),
(37, 1),
(1, 2),
(2, 2),
(5, 2),
(9, 2),
(10, 2),
(11, 2),
(14, 2),
(16, 2),
(17, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(26, 2),
(27, 2),
(28, 2),
(31, 2),
(32, 2),
(34, 2),
(1, 3),
(2, 3),
(4, 3),
(5, 3),
(7, 3),
(9, 3),
(13, 3),
(14, 3),
(15, 3),
(26, 3),
(31, 3),
(32, 3),
(33, 3),
(34, 3),
(35, 3),
(8, 4),
(20, 4),
(31, 5),
(32, 5),
(33, 5),
(34, 5),
(31, 6);

-- --------------------------------------------------------

--
-- Structure de la table `musictype`
--

CREATE TABLE IF NOT EXISTS `musictype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Contenu de la table `musictype`
--

INSERT INTO `musictype` (`id`, `name`) VALUES
(1, 'Salsa'),
(2, 'Bachata'),
(3, 'Kizomba'),
(4, 'Tango'),
(5, 'merengue'),
(6, 'zouk');

-- --------------------------------------------------------

--
-- Structure de la table `musictypetranslation`
--

CREATE TABLE IF NOT EXISTS `musictypetranslation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_F8A763AA2C2AC5D34180C698` (`translatable_id`,`locale`),
  KEY `IDX_F8A763AA2C2AC5D3` (`translatable_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Contenu de la table `musictypetranslation`
--

INSERT INTO `musictypetranslation` (`id`, `translatable_id`, `title`, `locale`) VALUES
(1, 1, 'Salsa', 'en'),
(2, 1, 'Salsa', 'fr'),
(3, 2, 'Bachata', 'en'),
(4, 2, 'Bachata', 'fr'),
(5, 3, 'Kizomba', 'en'),
(6, 3, 'Kizomba', 'fr'),
(7, 4, 'Tango', 'en'),
(8, 4, 'Tango', 'fr'),
(9, 5, 'Merengue', 'en'),
(10, 5, 'Merengue', 'fr'),
(11, 6, 'Zouk', 'en'),
(12, 6, 'Zouk', 'fr');

-- --------------------------------------------------------

--
-- Structure de la table `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Contenu de la table `page`
--

INSERT INTO `page` (`id`, `name`) VALUES
(5, 'home'),
(6, 'city'),
(7, 'policy');

-- --------------------------------------------------------

--
-- Structure de la table `pagetranslation`
--

CREATE TABLE IF NOT EXISTS `pagetranslation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_D29B35C02C2AC5D34180C698` (`translatable_id`,`locale`),
  KEY `IDX_D29B35C02C2AC5D3` (`translatable_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Contenu de la table `pagetranslation`
--

INSERT INTO `pagetranslation` (`id`, `translatable_id`, `title`, `content`, `description`, `locale`) VALUES
(1, 5, 'WeDanceSalsa', NULL, 'Find all Salsa/Bachata/Kizomba/Tango events everywhere, anytime !', 'en'),
(2, 5, 'WeDanceSalsa', NULL, 'Trouvez tous les évenements Salsa/Bachata/Kizomba/Tango près de chez  vous !', 'fr'),
(3, 6, 'Find all salsa/Bachata/Kizomba/Tango events close to', NULL, 'Find all salsa/Bachata/Kizomba/Tango events close to', 'en'),
(4, 6, 'Trouvez tous les événements Salsa/Bachanta/Kizomba/Tango proches de', NULL, 'Trouvez tous les événements Salsa/Bachanta/Kizomba/Tango close to', 'fr'),
(5, 7, 'Privacy policy', '<h1>Terms of Use</h1>\r\n\r\n<h2>1. Introducing our website</h2>\r\n\r\n<p>According to Law No. 2004-2005 of 21 June 2004 on confidence in the digital economy, our web site created by <a href="http://directdev.fr">DirectDev.fr</a>, site owner <a href="http://directdev.fr">DirectDev</a>, provides public information about our company.<br />\r\nPossibly flexible we invite you to consult our disclaimer as often as possible in order to read it frequently<br />\r\n<br />\r\nThe site belongs to <a href="http://directdev.fr">DirectDev</a>, whose headquarters are located at the following address: Lille, France.<br />\r\n<br />\r\n<a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a>, The site is hosted by OVH, whose head office is located at the following address:<br />\r\n2 rue Kellermann - 59100 Roubaix - France.</p>\r\n\r\n<h2>2. Terms of Use and the services offered.</h2>\r\n\r\n<p>Using <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a>, you fully and completely accept the terms and conditions set out in our privacy policy. Accessible to all types of visitors, it is important to note, however, that an interruption for maintenance of the website may be decided by the owner.</p>\r\n\r\n<h2>3. Products or services offered by WeDanceSalsa.com</h2>\r\n\r\n<p>In keeping with its policy of communication, <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a> site aims to inform users about Salsa / Bachata / Kizomba / Tango events. However, inaccuracies or omissions may exist: the company shall in no circumstances be held liable for any error in the <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a> site.</p>\r\n\r\n<h2>4. Contractual Limitations</h2>\r\n\r\n<p>The information input on our website <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a> subject to qualitative approaches in order to ensure their reliability. However, we will not incur any responsibility for any technical inaccuracies in our explanations.<br />\r\nIf you find an error in the information we have been omitted, please notify us by email at <a href="http://WeDanceSalsa.com/contact">WeDanceSalsa.com/contact</a>.<br />\r\n<br />\r\nThe links directly or indirectly linked to our website <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a> are not under the control of our company. Therefore, we can not assure us of the correctness of the information on those other websites.<br />\r\n<br />\r\nUsing JavaScript technology, <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a> site can not be held liable for any damage arising from its use. Furthermore, any other type of consequences resulting from use of the site <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a>, whether direct or indirect (bug, incompatibility, viruses, lost sales, etc.).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>5. IP and website content</h2>\r\n\r\n<p>The editorial content of the web site is owned exclusively <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a> to its owner. Any infringement of copyright is punishable under Article 335-2 of the Code of Intellectual Property, with a penalty of two years imprisonment and a fine of &euro; 150,000<br />\r\n<br />\r\n<a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a> the site may be affected in the event of offensive, racist, defamatory or pornographic traded in interactive areas. The company also reserves the right to remove any content contrary to the values ​​of the company or the laws applicable in France.<br />\r\n<br />\r\nBy browsing <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a> site, the user also agrees to install any cookies on their computer.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>6. Privacy, respect of your privacy and your freedoms</h2>\r\n\r\n<p>Any information collected on the website <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a> are within the requirements related to the use of our platform, such as the user profile form or the form of Events Suscribe.<br />\r\n<br />\r\nAccordance with the &quot;Data Protection&quot; Act of 6 January 1978 amended in 2004, the user has a right to access and correct information about him, right can be exercised at any time by sending an email via contact page: <a href="http://WeDanceSalsa.com/contact/en">WeDanceSalsa.com/contact</a><br />\r\n<br />\r\nThe databases are protected by the provisions of the Law of 1 July 1998 transposing Directive 96/9 of 11 March 1996 on the legal protection of databases.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>7. Law and relevant laws</h2>\r\n\r\n<p>Subject to French law, the web site is <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a> regulated by law No. 2004-2005 of 21 June 2004 on confidence in the digital economy, Article 335-2 of the Code of Intellectual Property and law &quot;and Freedoms&quot; of January 6, 1978 amended in 2004.</p>', 'Privacy policy', 'en'),
(6, 7, 'Mentions Légales', '<h1>Mentions L&eacute;gales</h1>\r\n\r\n<h2>1. Pr&eacute;sentation de notre site web</h2>\r\n\r\n<p>Conform&eacute;ment &agrave; la loi n&deg; 2004-2005 du 21 juin 2004 pour la confiance dans l&#39;&eacute;conomie num&eacute;rique, notre site web cr&eacute;&eacute; par <a href="http://directdev.fr">DirectDev.fr</a>, propri&eacute;taire du site <a href="http://directdev.fr">DirectDev</a>, met &agrave; disposition du public les informations concernant notre entreprise.<br />\r\nEventuellement modifiables, nous vous invitons donc &agrave; consulter nos mentions l&eacute;gales le plus souvent possible, de mani&egrave;re &agrave; en prendre connaissance fr&eacute;quemment</p>\r\n\r\n<p>Le site <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a> appartient &agrave; DirecDev, dont le si&egrave;ge social est situ&eacute; &agrave; l&#39;adresse suivante : Lille, France.</p>\r\n\r\n<p><br />\r\nLe site <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a> est h&eacute;berg&eacute; par ovh, dont le si&egrave;ge social est localis&eacute; &agrave; l&#39;adresse suivante :<br />\r\n2 rue Kellermann - 59100 Roubaix - France.</p>\r\n\r\n<h2>2. Conditions g&eacute;n&eacute;rales d&rsquo;utilisation du site et des services propos&eacute;s.</h2>\r\n\r\n<p>En utilisant notre site web <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a>, vous acceptez pleinement et enti&egrave;rement les conditions g&eacute;n&eacute;rales d&#39;utilisation pr&eacute;cis&eacute;es dans nos mentions l&eacute;gales. Accessible &agrave; tout type de visiteurs, il est important de pr&eacute;ciser toutefois qu&#39;une interruption pour maintenance du site web peut-&ecirc;tre d&eacute;cid&eacute;e par son propri&eacute;taire.</p>\r\n\r\n<h2>3. Les produits ou services propos&eacute;s par <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a></h2>\r\n\r\n<p>En accord avec sa politique de communication, le site <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a> a pour vocation d&#39;informer les utilisateurs sur les &eacute;venements Salsa/Bachata/Kizomba/Tango. Cependant, des inexactitudes ou des omissions peuvent exister : la soci&eacute;t&eacute; ne pourra en aucun cas &ecirc;tre tenue pour responsable pour toute erreur pr&eacute;sente sur le site <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a>.</p>\r\n\r\n<h2>4. Limitations contractuelles</h2>\r\n\r\n<p>Les informations retranscrites sur notre site web <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a> font l&rsquo;objet de d&eacute;marches qualitatives, en vue de nous assurer de leur fiabilit&eacute;. Cependant, nous ne pourrons encourir de responsabilit&eacute;s en cas d&rsquo;inexactitudes techniques lors de nos explications.<br />\r\nSi vous constatez une erreur concernant des informations que nous auront pu omettre, n&rsquo;h&eacute;sitez pas &agrave; nous le signaler par mail &agrave; <a href="http://WeDanceSalsa.com/contact">WeDanceSalsa.com/contact</a>.</p>\r\n\r\n<p>Les liens reli&eacute;s directement ou indirectement &agrave; notre site web <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a> ne sont pas sous le contr&ocirc;le de notre soci&eacute;t&eacute;. Par cons&eacute;quent, nous ne pouvons nous assurer de l&rsquo;exactitude des informations pr&eacute;sentes sur ces autres sites Internet.</p>\r\n\r\n<p>Utilisant la technologie JavaScript, le site <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a> ne pourra &ecirc;tre tenu pour responsable en cas de dommages mat&eacute;riels li&eacute;s &agrave; son utilisation. Par ailleurs, toute autre type de cons&eacute;quence li&eacute;e &agrave; l&#39;exploitation du site <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a>, qu&#39;elle soit direct ou indirect (bug, incompatibilit&eacute;, virus, perte de march&eacute;, etc.).</p>\r\n\r\n<h2>5. Propri&eacute;t&eacute; intellectuelle et contenu du site Internet</h2>\r\n\r\n<p>Le contenu r&eacute;dactionnel du site web <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a> appartient exclusivement &agrave; son propri&eacute;taire. Toute violation des droits d&rsquo;auteur est sanctionn&eacute;e par l&rsquo;article L.335-2 du Code de la Propri&eacute;t&eacute; Intellectuelle, avec une peine encourue de 2 ans d&rsquo;emprisonnement et de 150 000&euro; d&rsquo;amende</p>\r\n\r\n<p>Le site <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a> ne pourra &ecirc;tre mis en cause en cas de propos injurieux, &agrave; caract&egrave;re raciste, diffamant ou pornographique, &eacute;chang&eacute;s sur les espaces interactifs. La soci&eacute;t&eacute; se r&eacute;serve &eacute;galement le droit de supprimer tout contenu contraire aux valeurs de l&#39;entreprise ou &agrave; la l&eacute;gislation applicable en France.</p>\r\n\r\n<p>En naviguant sur le site <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a>, l&#39;utilisateur accepte &eacute;galement l&#39;installation de cookies &eacute;ventuelle sur son ordinateur.</p>\r\n\r\n<h2>6. Donn&eacute;es personnelles, respect de votre vie priv&eacute;e et de vos libert&eacute;s</h2>\r\n\r\n<p>Toute informations recueillie sur le site web <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a> se font dans le cadre des besoins li&eacute;s &agrave; l&#39;utilisation de notre plateforme, tels que le formulaire de profil utilisateur ou le formulaire d&#39;incription d&#39;&eacute;venements.</p>\r\n\r\n<p>Conform&eacute;ment &agrave; la loi &laquo; informatique et libert&eacute;s &raquo; du 6 janvier 1978 modifi&eacute;e en 2004, l&rsquo;utilisateur b&eacute;n&eacute;ficie d&rsquo;un droit d&rsquo;acc&egrave;s et de rectification aux informations le concernant, droit qu&rsquo;il peut exercer &agrave; tout moment en adressant un mail via la page de contact : <a href="http://WeDanceSalsa.com/contact/fr">WeDanceSalsa.com/contact</a><br />\r\n<br />\r\nLes bases de donn&eacute;es sont prot&eacute;g&eacute;es par les dispositions de la loi du 1er juillet 1998 transposant la directive 96/9 du 11 mars 1996 relative &agrave; la protection juridique des bases de donn&eacute;es.</p>\r\n\r\n<h2>7. Droit applicable et lois concern&eacute;es</h2>\r\n\r\n<p>Soumis au droit fran&ccedil;ais, le site web <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a> est encadr&eacute; par la loi n&deg; 2004-2005 du 21 juin 2004 pour la confiance dans l&#39;&eacute;conomie num&eacute;rique, l&rsquo;article L.335-2 du Code de la Propri&eacute;t&eacute; Intellectuelle et la loi &laquo; informatique et libert&eacute;s &raquo; du 6 janvier 1978 modifi&eacute;e en 2004.</p>', 'Mentions Légales', 'fr');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=28 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `facebook_id`, `facebook_access_token`, `google_id`, `google_access_token`, `facebook_link`, `google_link`, `twitter_link`, `linkedin_link`, `flickr_link`, `tumblr_link`, `instagram_link`, `vimeo_link`, `youtube_link`) VALUES
(1, 'Jerome', 'jerome', 'serviceclient@directdev.fr', 'serviceclient@directdev.fr', 1, 'i50g10to3z4g0skkc8ckog4g4og4g0o', '+Uz9ySVmva85Z5CR67xdYLfl2LTdC2SWKimEvLgbuv1Vm9WeC2z8ngAb0unUShbtS7PWjkGxx2QPY0k8qrer8Q==', '2015-02-12 10:45:32', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'caroline', 'caroline', 'calila@msn.com', 'calila@msn.com', 1, 'pguisyri5a844k44w0g0c4c8ccww4gk', 'fEyci88e7egVdBGy0Xv/nEaxAozouh5ge1i7nISh5tZJLefRU/Yv4rThx9jr9ieXRnhexS3lzxbpLZTv5FILjQ==', '2014-11-25 20:34:31', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'Nathalie Szweda', 'nathalie szweda', 'nathalieszweda@yahoo.fr', 'nathalieszweda@yahoo.fr', 1, '8qn50abv2skk0o4w08gkko80ksc04sw', 'IMo9Js91Bp3HsKdCv59gMmoVsWDymTL78dctR+r2TMhpfzdWXLZ61J7MrHKPXGuOYvZjIRQhmEGiO4UWwySRZw==', '2014-11-26 16:26:04', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, '10152769844957626', 'CAAVEck5eyY4BAIwlC5rUYtj2zDbZCbXRf6SQeeImK1Ol9l4RXfpatIQLddsZBP90fvVdM8thh9pDTYRVijkPJBvo5ZBQnKtj9pAaibZB5ImKRyUZAQPFWheLZCWHLDIHBJcILsocVOgfnBZBRGQVFU76uNECbJoSDO5o6OO65v5aLBWbyEsEohULK61OtBYMHnZBgU5ZBZA7yLuMavRpAja79l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'Jerome Barea (DirectDev)', 'jerome barea (directdev)', 'directdev.sc@gmail.com', 'directdev.sc@gmail.com', 1, '8rmd9bcrab0ok8c4kosko4k08kwcskk', 'hpCe7/DTm/r0DK6DLME3lE2PDJI81o/cximjHleXnn26hI1j177vG1HRlAf8HYfrBJbDR7iVdzZAoUoevrljtQ==', '2014-11-28 11:26:09', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, NULL, NULL, '106438664310894718362', 'ya29.zADCGRlZo7Suus4ygfNexKtQATyNvMUde1MgWFanTbqeqkcbsVVZITmU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 'Jeje Ai Ni', 'jeje ai ni', 'jeromebarea@yahoo.fr', 'jeromebarea@yahoo.fr', 1, 'dshi0dd67qgo8sk448c0oc488s8cwwk', 'mqD/PEFElptrzk9GH9ZQEUjHOzO9nMktx3lHtSMay0XjNhce4G40cnR8tpvXbylZz7fUMKIY4AVcPcPckC3Pig==', '2014-11-30 13:00:13', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, '10152702700870519', 'CAAVEck5eyY4BALgx9e2MmoCRbYXA2hbTVjjYsjgZBT55ZAIpyD1ke8DbDg6eb7PaFx2DhgIpync6HSM6rPStEBkLB63BxJ8FDFtXKWrzaek7UdVFgbXqP3thOeYYjilDaHNccK6cha4phXMLJ7Umv1ZCraQAHrnQHK3uCLMnBUSJPM9hzjMFJdqLlHcblF0LYa8imZCWS6K8yv8sPDkn', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 'Ahen Do', 'ahen do', 'guewn.salsa@hotmail.fr', 'guewn.salsa@hotmail.fr', 1, 'bg9l3nngoxkwsw48ck8g8koscg40skk', '6hQXhPzSCqqhh4aXzaOE+8OK3WMKrGMP7jO1DTRKlQUjUsPwJwp/YyKM7byZn8ip2nkOtD+9iP0dU6KLx4OSwg==', '2014-11-30 13:08:01', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, '695419983906608', 'CAAVEck5eyY4BAC5Br3MmvP8rjn6XGEiINjHif3FppyxYPqzIIaOtb2Qpnvbh7c0Nh1ZAyGMKKxo5vSQEwLrYEdT7JrRP9BdwzTmZCoGeMFpvflZBQ94bB565PG21Hr7CWbmatqic8nJLMeanf5l6toWowKMVxsA8j4O9ikH0A1cbN5C3DSHV3RcfFXws4R9r89vZAqZBlDkeLs4b3T6IK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 'Sonia Fuchez', 'sonia fuchez', 'fuchezsonia@gmail.com', 'fuchezsonia@gmail.com', 1, 'lfhpmbj5foggo0g00ocss00gwokg4w4', 'Qq2b1JdG4j+mC6MsefF3ZPzJEF+Y3bjNT40ye1QhgZu1Uo7ioC95E8mlQ4NHsYhZpDSzxgyy/WYwCz1FQcCDig==', '2014-12-02 17:11:20', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, NULL, NULL, '116425847057328665857', 'ya29.0AA8_eGwchyDG9FhgVkewlv3PPEVchU6-J_Z1WvnxnWv_loyaqo1a34RxU8fozndlNfWqt05iHx8Zw', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 'Salsero', 'salsero', 'mykihype@gmail.com', 'mykihype@gmail.com', 1, '26h43zzoquisksc40s8g48o4koosgw4', '58hSUDjYlB4Kd9e5NTam08js0DrX23gpOcenCWgTtjzLctDt2PxFyDAJEHss9+NM/lUhc5qv9fC/cpHLdaELJQ==', '2015-01-17 10:49:00', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `usertranslation`
--

CREATE TABLE IF NOT EXISTS `usertranslation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `translatable_id` int(11) DEFAULT NULL,
  `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `baseline` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `description_short` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_7E1CC2B22C2AC5D34180C698` (`translatable_id`,`locale`),
  KEY `IDX_7E1CC2B22C2AC5D3` (`translatable_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `usertranslation`
--

INSERT INTO `usertranslation` (`id`, `translatable_id`, `locale`, `baseline`, `description`, `description_short`) VALUES
(1, 21, 'fr', 'salseradesamara', NULL, NULL),
(2, 25, 'fr', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `usertype`
--

CREATE TABLE IF NOT EXISTS `usertype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `usertype`
--

INSERT INTO `usertype` (`id`, `name`) VALUES
(1, 'dancer'),
(2, 'teacher'),
(3, 'artist'),
(4, 'bar');

-- --------------------------------------------------------

--
-- Structure de la table `usertypetranslation`
--

CREATE TABLE IF NOT EXISTS `usertypetranslation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `translatable_id` int(11) DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_550026B92C2AC5D34180C698` (`translatable_id`,`locale`),
  KEY `IDX_550026B92C2AC5D3` (`translatable_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Contenu de la table `usertypetranslation`
--

INSERT INTO `usertypetranslation` (`id`, `translatable_id`, `name`, `locale`) VALUES
(1, 1, 'Dancer', 'en'),
(2, 1, 'Danseur/Danseuse', 'fr'),
(3, 2, 'Teacher', 'en'),
(4, 2, 'Professeur', 'fr'),
(5, 3, 'Artist', 'en'),
(6, 3, 'Artiste', 'fr'),
(7, 4, 'Bar/Club', 'en'),
(8, 4, 'Bar/Club', 'fr');

-- --------------------------------------------------------

--
-- Structure de la table `user_address`
--

CREATE TABLE IF NOT EXISTS `user_address` (
  `user_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  PRIMARY KEY (`address_id`,`user_id`),
  KEY `IDX_5543718BF5B7AF75` (`address_id`),
  KEY `IDX_5543718BA76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `user_address`
--

INSERT INTO `user_address` (`user_id`, `address_id`) VALUES
(1, 1),
(21, 21);

-- --------------------------------------------------------

--
-- Structure de la table `user_file`
--

CREATE TABLE IF NOT EXISTS `user_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F61E7AD9A76ED395` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=27 ;

--
-- Contenu de la table `user_file`
--

INSERT INTO `user_file` (`id`, `user_id`, `name`) VALUES
(22, 1, 'jeje_ny_carre.jpg'),
(24, 21, '1377554_10204262033245145_627331310830420658_n.jpg'),
(25, 25, 'Jellyfish.jpg'),
(26, 25, 'Penguins.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `user_musictype`
--

CREATE TABLE IF NOT EXISTS `user_musictype` (
  `user_id` int(11) NOT NULL,
  `musicType_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`musicType_id`),
  KEY `IDX_8E34DEFFA76ED395` (`user_id`),
  KEY `IDX_8E34DEFF661A9175` (`musicType_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `user_musictype`
--

INSERT INTO `user_musictype` (`user_id`, `musicType_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(21, 1),
(21, 2),
(25, 1),
(25, 2),
(25, 3),
(25, 4);

-- --------------------------------------------------------

--
-- Structure de la table `user_usertype`
--

CREATE TABLE IF NOT EXISTS `user_usertype` (
  `user_id` int(11) NOT NULL,
  `userType_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`userType_id`),
  KEY `IDX_6A1C6466A76ED395` (`user_id`),
  KEY `IDX_6A1C6466969049B1` (`userType_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `user_usertype`
--

INSERT INTO `user_usertype` (`user_id`, `userType_id`) VALUES
(1, 1),
(21, 1),
(25, 1);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `FK_C2F3561DF92F3E70` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`);

--
-- Contraintes pour la table `countrytranslation`
--
ALTER TABLE `countrytranslation`
  ADD CONSTRAINT `FK_41FF00AD2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `country` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `FK_FA6F25A3A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_FA6F25A3C15B25DE` FOREIGN KEY (`eventType_id`) REFERENCES `eventtype` (`id`);

--
-- Contraintes pour la table `eventtranslation`
--
ALTER TABLE `eventtranslation`
  ADD CONSTRAINT `FK_1E6F98922C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `event` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `eventtypetranslation`
--
ALTER TABLE `eventtypetranslation`
  ADD CONSTRAINT `FK_DDB9698C2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `eventtype` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `event_address`
--
ALTER TABLE `event_address`
  ADD CONSTRAINT `FK_8819C62E71F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
  ADD CONSTRAINT `FK_8819C62EF5B7AF75` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`);

--
-- Contraintes pour la table `event_eventdates`
--
ALTER TABLE `event_eventdates`
  ADD CONSTRAINT `FK_70B5038571F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
  ADD CONSTRAINT `FK_70B50385C3CCAD7E` FOREIGN KEY (`eEventDate_id`) REFERENCES `eventdate` (`id`);

--
-- Contraintes pour la table `event_file`
--
ALTER TABLE `event_file`
  ADD CONSTRAINT `FK_7009450771F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`);

--
-- Contraintes pour la table `event_musictype`
--
ALTER TABLE `event_musictype`
  ADD CONSTRAINT `FK_8416D26661A9175` FOREIGN KEY (`musicType_id`) REFERENCES `musictype` (`id`),
  ADD CONSTRAINT `FK_8416D2671F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`);

--
-- Contraintes pour la table `musictypetranslation`
--
ALTER TABLE `musictypetranslation`
  ADD CONSTRAINT `FK_F8A763AA2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `musictype` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `pagetranslation`
--
ALTER TABLE `pagetranslation`
  ADD CONSTRAINT `FK_D29B35C02C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `page` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `usertranslation`
--
ALTER TABLE `usertranslation`
  ADD CONSTRAINT `FK_7E1CC2B22C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `usertypetranslation`
--
ALTER TABLE `usertypetranslation`
  ADD CONSTRAINT `FK_550026B92C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `usertype` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `user_address`
--
ALTER TABLE `user_address`
  ADD CONSTRAINT `FK_5543718BA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_5543718BF5B7AF75` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`);

--
-- Contraintes pour la table `user_file`
--
ALTER TABLE `user_file`
  ADD CONSTRAINT `FK_F61E7AD9A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `user_musictype`
--
ALTER TABLE `user_musictype`
  ADD CONSTRAINT `FK_8E34DEFF661A9175` FOREIGN KEY (`musicType_id`) REFERENCES `musictype` (`id`),
  ADD CONSTRAINT `FK_8E34DEFFA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `user_usertype`
--
ALTER TABLE `user_usertype`
  ADD CONSTRAINT `FK_6A1C6466969049B1` FOREIGN KEY (`userType_id`) REFERENCES `usertype` (`id`),
  ADD CONSTRAINT `FK_6A1C6466A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
