-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 23 Eki 2020, 18:37:31
-- Sunucu sürümü: 10.3.24-MariaDB-cll-lve
-- PHP Sürümü: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `u9414702_kursmerkezi`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_activity`
--

CREATE TABLE `pm_activity` (
  `id` int(11) NOT NULL,
  `lang` int(11) NOT NULL,
  `hotels` varchar(250) DEFAULT NULL,
  `users` text DEFAULT NULL,
  `max_children` int(11) DEFAULT 1,
  `max_adults` int(11) DEFAULT 1,
  `max_people` int(11) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `subtitle` varchar(250) DEFAULT NULL,
  `alias` varchar(100) DEFAULT NULL,
  `descr` longtext DEFAULT NULL,
  `duration` float DEFAULT 0,
  `duration_unit` varchar(50) DEFAULT NULL,
  `price` double DEFAULT 0,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `home` int(11) DEFAULT 0,
  `checked` int(11) DEFAULT 0,
  `rank` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_activity_file`
--

CREATE TABLE `pm_activity_file` (
  `id` int(11) NOT NULL,
  `lang` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `home` int(11) DEFAULT 0,
  `checked` int(11) DEFAULT 1,
  `rank` int(11) DEFAULT 0,
  `file` varchar(250) DEFAULT NULL,
  `label` varchar(250) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_activity_session`
--

CREATE TABLE `pm_activity_session` (
  `id` int(11) NOT NULL,
  `id_activity` int(11) NOT NULL,
  `days` varchar(20) DEFAULT NULL,
  `start_date` int(11) DEFAULT NULL,
  `end_date` int(11) DEFAULT NULL,
  `users` text DEFAULT NULL,
  `price` double DEFAULT 0,
  `price_child` double DEFAULT 0,
  `discount` double DEFAULT 0,
  `discount_type` varchar(10) DEFAULT NULL,
  `id_tax` int(11) DEFAULT NULL,
  `taxes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_activity_session_hour`
--

CREATE TABLE `pm_activity_session_hour` (
  `id` int(11) NOT NULL,
  `id_activity_session` int(11) NOT NULL,
  `start_h` int(11) DEFAULT NULL,
  `start_m` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_article`
--

CREATE TABLE `pm_article` (
  `id` int(11) NOT NULL,
  `lang` int(11) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `subtitle` varchar(250) DEFAULT NULL,
  `alias` varchar(100) DEFAULT NULL,
  `text` longtext DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL,
  `tags` varchar(250) DEFAULT NULL,
  `id_page` int(11) DEFAULT NULL,
  `users` text DEFAULT NULL,
  `home` int(11) DEFAULT 0,
  `checked` int(11) DEFAULT 0,
  `rank` int(11) DEFAULT 0,
  `add_date` int(11) DEFAULT NULL,
  `edit_date` int(11) DEFAULT NULL,
  `publish_date` int(11) DEFAULT NULL,
  `unpublish_date` int(11) DEFAULT NULL,
  `comment` int(11) DEFAULT 0,
  `rating` int(11) DEFAULT 0,
  `show_langs` text DEFAULT NULL,
  `hide_langs` text DEFAULT NULL,
  `hit` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `pm_article`
--

INSERT INTO `pm_article` (`id`, `lang`, `title`, `subtitle`, `alias`, `text`, `url`, `tags`, `id_page`, `users`, `home`, `checked`, `rank`, `add_date`, `edit_date`, `publish_date`, `unpublish_date`, `comment`, `rating`, `show_langs`, `hide_langs`, `hit`) VALUES
(5, 2, '', '', '', '', '', '', 17, '1', 1, 1, 1, 1599801738, 1600082869, 1599801540, NULL, 1, NULL, '4', '', 27),
(5, 4, 'Blog 1', 'Blog 1', 'blog1', '<p>Bu bir Denemedir.</p>\r\n', '', '', 17, '1', 1, 1, 1, 1599801738, 1600082869, 1599801540, NULL, 1, NULL, '4', '', 27),
(6, 2, '', '', '', '', '', '', 17, '1', 1, 1, 2, 1599801801, 1600082875, 1599801720, NULL, 1, NULL, '4', '', 11),
(6, 4, 'Blog 2', 'Blog 2', 'blog2', '<p>bu bir denemdir</p>\r\n', '', '', 17, '1', 1, 1, 2, 1599801801, 1600082875, 1599801720, NULL, 1, NULL, '4', '', 11),
(7, 2, '', '', '', '', '', '', 17, '1', 1, 1, 3, 1599823188, 1600084891, 1599823080, NULL, 1, NULL, '4', '', 12),
(7, 4, 'Blog 3', 'Blog 3', 'blog3', '<p>Bu bir Denemdir.</p>\r\n', '', '', 17, '1', 1, 1, 3, 1599823188, 1600084891, 1599823080, NULL, 1, NULL, '4', '', 12);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_article_file`
--

CREATE TABLE `pm_article_file` (
  `id` int(11) NOT NULL,
  `lang` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `home` int(11) DEFAULT 0,
  `checked` int(11) DEFAULT 1,
  `rank` int(11) DEFAULT 0,
  `file` varchar(250) DEFAULT NULL,
  `label` varchar(250) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `pm_article_file`
--

INSERT INTO `pm_article_file` (`id`, `lang`, `id_item`, `home`, `checked`, `rank`, `file`, `label`, `type`) VALUES
(9, 2, 6, NULL, 1, 2, 'kurumsal-blog-yonetimi.jpg', '', 'image'),
(9, 4, 6, NULL, 1, 2, 'kurumsal-blog-yonetimi.jpg', '', 'image'),
(10, 2, 5, NULL, 1, 3, 'blog3.png', '', 'image'),
(10, 4, 5, NULL, 1, 3, 'blog3.png', '', 'image'),
(11, 2, 7, NULL, 1, 1, 'blog3.jpg', '', 'image'),
(11, 4, 7, NULL, 1, 1, 'blog3.jpg', '', 'image');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_booking`
--

CREATE TABLE `pm_booking` (
  `id` int(11) NOT NULL,
  `id_hotel` int(11) DEFAULT NULL,
  `add_date` int(11) DEFAULT NULL,
  `edit_date` int(11) DEFAULT NULL,
  `from_date` int(11) DEFAULT NULL,
  `to_date` int(11) DEFAULT NULL,
  `nights` int(11) DEFAULT 0,
  `adults` int(11) DEFAULT 1,
  `children` int(11) DEFAULT 1,
  `amount` float DEFAULT NULL,
  `tourist_tax` float DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `ex_tax` float DEFAULT NULL,
  `tax_amount` float DEFAULT NULL,
  `total` float DEFAULT NULL,
  `down_payment` float DEFAULT NULL,
  `paid` float DEFAULT NULL,
  `balance` float DEFAULT NULL,
  `extra_services` text DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `company` varchar(50) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `postcode` varchar(10) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `country` varchar(100) NOT NULL,
  `comments` text DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `trans` varchar(50) DEFAULT NULL,
  `payment_date` int(11) DEFAULT NULL,
  `payment_option` varchar(250) DEFAULT NULL,
  `users` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `pm_booking`
--

INSERT INTO `pm_booking` (`id`, `id_hotel`, `add_date`, `edit_date`, `from_date`, `to_date`, `nights`, `adults`, `children`, `amount`, `tourist_tax`, `discount`, `ex_tax`, `tax_amount`, `total`, `down_payment`, `paid`, `balance`, `extra_services`, `id_user`, `firstname`, `lastname`, `email`, `company`, `address`, `postcode`, `city`, `phone`, `mobile`, `country`, `comments`, `status`, `trans`, `payment_date`, `payment_option`, `users`) VALUES
(1, 1, 1599820637, NULL, 1599782400, 1599868800, 1, 1, NULL, 14950, NULL, 0, 13818.2, 1381.82, 15200, NULL, NULL, NULL, NULL, 1, 'aa', 'aa', 'info@onlineozeldersler.com', 'sdsd', 'Yıldız Teknik Üniversitesi Teknopark A1 Blok 1B50', '34250', 'İstanbul', '02124837480', '02124837480', 'Turkey', '', 1, NULL, NULL, 'arrival', '1'),
(2, 2, 1600436068, NULL, 1600387200, 1600473600, 1, 1, NULL, 10000, NULL, 0, 10000, 0, 10000, NULL, NULL, NULL, NULL, 1, 'Mariam', 'Klein', 'holuve@mailinator.net', '', 'Et ullam commodo ut ', 'Deserunt m', 'Nulla aut et in exce', '+1 (974) 119-5647', '', 'Afghanistan', '', 1, NULL, NULL, 'arrival', '1'),
(3, 2, 1600752620, NULL, 1600732800, 1600819200, 1, 1, NULL, 10000, NULL, 0, 10000, 0, 10000, NULL, NULL, NULL, NULL, NULL, 'Jonah', 'Rhodes', 'lawunoqi@mailinator.com', '', 'Nemo ut ex vel vitae', 'Fugiat nat', 'Aliquip et nulla ame', '+1 (258) 587-7131', '', 'Albania', 'Laboriosam quaerat ', 1, NULL, NULL, 'arrival', '1'),
(4, 2, 1601963788, NULL, 1601942400, 1602028800, 1, 1, NULL, 10000, NULL, 0, 10000, 0, 10000, NULL, NULL, NULL, NULL, 1, 'Jason', 'Page', 'qezaz@mailinator.net', '', 'Irure proident veli', 'Deserunt p', 'Voluptatem exercita', '+1 (942) 594-3753', '', 'Åland', '', 1, NULL, NULL, 'arrival', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_booking_activity`
--

CREATE TABLE `pm_booking_activity` (
  `id` int(11) NOT NULL,
  `id_booking` int(11) NOT NULL,
  `id_activity` int(11) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `children` int(11) DEFAULT 0,
  `adults` int(11) DEFAULT 0,
  `duration` varchar(50) DEFAULT NULL,
  `amount` double DEFAULT 0,
  `ex_tax` double DEFAULT 0,
  `tax_rate` double DEFAULT 0,
  `date` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_booking_payment`
--

CREATE TABLE `pm_booking_payment` (
  `id` int(11) NOT NULL,
  `id_booking` int(11) NOT NULL,
  `descr` varchar(100) DEFAULT NULL,
  `method` varchar(100) DEFAULT NULL,
  `amount` double DEFAULT 0,
  `trans` varchar(100) DEFAULT NULL,
  `date` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_booking_room`
--

CREATE TABLE `pm_booking_room` (
  `id` int(11) NOT NULL,
  `id_booking` int(11) NOT NULL,
  `id_room` int(11) DEFAULT NULL,
  `id_hotel` int(11) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `num` varchar(10) DEFAULT NULL,
  `children` int(11) DEFAULT 0,
  `adults` int(11) DEFAULT 0,
  `amount` double DEFAULT 0,
  `ex_tax` double DEFAULT 0,
  `tax_rate` double DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `pm_booking_room`
--

INSERT INTO `pm_booking_room` (`id`, `id_booking`, `id_room`, `id_hotel`, `title`, `num`, `children`, `adults`, `amount`, `ex_tax`, `tax_rate`) VALUES
(1, 1, 1, 1, 'Nişantaşı Fen ve Teknoloji Kolejleri - Ortaokul', NULL, 0, 1, 14950, 13590.91, NULL),
(2, 2, 2, 2, 'Başakşehir Yenidoğu Okulları Lisesi - Lise', NULL, 0, 1, 10000, 10000, NULL),
(3, 3, 2, 2, 'Başakşehir Yenidoğu Okulları Lisesi - Lise', NULL, 0, 1, 10000, 10000, NULL),
(4, 4, 2, 2, 'Başakşehir Yenidoğu Okulları Lisesi - Lise', NULL, 0, 1, 10000, 10000, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_booking_service`
--

CREATE TABLE `pm_booking_service` (
  `id` int(11) NOT NULL,
  `id_booking` int(11) NOT NULL,
  `id_service` int(11) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `qty` int(11) DEFAULT 0,
  `amount` double DEFAULT 0,
  `ex_tax` double DEFAULT 0,
  `tax_rate` double DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `pm_booking_service`
--

INSERT INTO `pm_booking_service` (`id`, `id_booking`, `id_service`, `title`, `qty`, `amount`, `ex_tax`, `tax_rate`) VALUES
(1, 1, 1, 'Araç Servisi (kit)', 1, 250, 227.27, 10);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_booking_tax`
--

CREATE TABLE `pm_booking_tax` (
  `id` int(11) NOT NULL,
  `id_booking` int(11) NOT NULL,
  `id_tax` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `amount` double DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `pm_booking_tax`
--

INSERT INTO `pm_booking_tax` (`id`, `id_booking`, `id_tax`, `name`, `amount`) VALUES
(1, 1, 1, 'Vergi', 1381.82);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_comment`
--

CREATE TABLE `pm_comment` (
  `id` int(11) NOT NULL,
  `item_type` varchar(30) DEFAULT NULL,
  `id_item` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `checked` int(11) DEFAULT 0,
  `add_date` int(11) DEFAULT NULL,
  `edit_date` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `msg` longtext DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `pm_comment`
--

INSERT INTO `pm_comment` (`id`, `item_type`, `id_item`, `rating`, `checked`, `add_date`, `edit_date`, `name`, `email`, `msg`, `ip`) VALUES
(1, 'hotel', 7, 5, 1, 1594837876, 1599833971, 'tuncay sevindik', 'tsevindik@gmail.com', 'dfgdfg', '217.131.81.245'),
(3, 'article', 1, 5, 1, 1599822778, 1599822778, 'Veysel Kaya', 'kayaveysel@gmail.com', 'Okulumu buradan buldum çok mutluyum', NULL),
(4, 'article', 1, 5, 1, 1599822817, 1599822817, 'Hilal Korkmaz', 'korkmazhilal@gmail.com', 'Bu bir denemedir.', NULL),
(5, 'article', 1, 5, 1, 1599822853, 1599822853, 'Damla Yılmaz', 'yilmazdamla@gmail.com', 'Bu bir denemdir.', NULL),
(6, 'hotel', 5, 4, 1, 1599822744, 1599834032, 'Ahmet Demir', 'ahmet123@gmail.com', 'Bu çok güzel bir uygulama.', NULL),
(7, 'hotel', 6, 3, 1, 1599822744, 1599834032, 'Ahmet Demir', 'ahmet123@gmail.com', 'Bu çok güzel bir uygulama.', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_country`
--

CREATE TABLE `pm_country` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `code` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `pm_country`
--

INSERT INTO `pm_country` (`id`, `name`, `code`) VALUES
(1, 'Afghanistan', 'AF'),
(2, 'Åland', 'AX'),
(3, 'Albania', 'AL'),
(4, 'Algeria', 'DZ'),
(5, 'American Samoa', 'AS'),
(6, 'Andorra', 'AD'),
(7, 'Angola', 'AO'),
(8, 'Anguilla', 'AI'),
(9, 'Antarctica', 'AQ'),
(10, 'Antigua and Barbuda', 'AG'),
(11, 'Argentina', 'AR'),
(12, 'Armenia', 'AM'),
(13, 'Aruba', 'AW'),
(14, 'Australia', 'AU'),
(15, 'Austria', 'AT'),
(16, 'Azerbaijan', 'AZ'),
(17, 'Bahamas', 'BS'),
(18, 'Bahrain', 'BH'),
(19, 'Bangladesh', 'BD'),
(20, 'Barbados', 'BB'),
(21, 'Belarus', 'BY'),
(22, 'Belgium', 'BE'),
(23, 'Belize', 'BZ'),
(24, 'Benin', 'BJ'),
(25, 'Bermuda', 'BM'),
(26, 'Bhutan', 'BT'),
(27, 'Bolivia', 'BO'),
(28, 'Bonaire', 'BQ'),
(29, 'Bosnia and Herzegovina', 'BA'),
(30, 'Botswana', 'BW'),
(31, 'Bouvet Island', 'BV'),
(32, 'Brazil', 'BR'),
(33, 'British Indian Ocean Territory', 'IO'),
(34, 'British Virgin Islands', 'VG'),
(35, 'Brunei', 'BN'),
(36, 'Bulgaria', 'BG'),
(37, 'Burkina Faso', 'BF'),
(38, 'Burundi', 'BI'),
(39, 'Cambodia', 'KH'),
(40, 'Cameroon', 'CM'),
(41, 'Canada', 'CA'),
(42, 'Cape Verde', 'CV'),
(43, 'Cayman Islands', 'KY'),
(44, 'Central African Republic', 'CF'),
(45, 'Chad', 'TD'),
(46, 'Chile', 'CL'),
(47, 'China', 'CN'),
(48, 'Christmas Island', 'CX'),
(49, 'Cocos [Keeling] Islands', 'CC'),
(50, 'Colombia', 'CO'),
(51, 'Comoros', 'KM'),
(52, 'Cook Islands', 'CK'),
(53, 'Costa Rica', 'CR'),
(54, 'Croatia', 'HR'),
(55, 'Cuba', 'CU'),
(56, 'Curacao', 'CW'),
(57, 'Cyprus', 'CY'),
(58, 'Czech Republic', 'CZ'),
(59, 'Democratic Republic of the Congo', 'CD'),
(60, 'Denmark', 'DK'),
(61, 'Djibouti', 'DJ'),
(62, 'Dominica', 'DM'),
(63, 'Dominican Republic', 'DO'),
(64, 'East Timor', 'TL'),
(65, 'Ecuador', 'EC'),
(66, 'Egypt', 'EG'),
(67, 'El Salvador', 'SV'),
(68, 'Equatorial Guinea', 'GQ'),
(69, 'Eritrea', 'ER'),
(70, 'Estonia', 'EE'),
(71, 'Ethiopia', 'ET'),
(72, 'Falkland Islands', 'FK'),
(73, 'Faroe Islands', 'FO'),
(74, 'Fiji', 'FJ'),
(75, 'Finland', 'FI'),
(76, 'France', 'FR'),
(77, 'French Guiana', 'GF'),
(78, 'French Polynesia', 'PF'),
(79, 'French Southern Territories', 'TF'),
(80, 'Gabon', 'GA'),
(81, 'Gambia', 'GM'),
(82, 'Georgia', 'GE'),
(83, 'Germany', 'DE'),
(84, 'Ghana', 'GH'),
(85, 'Gibraltar', 'GI'),
(86, 'Greece', 'GR'),
(87, 'Greenland', 'GL'),
(88, 'Grenada', 'GD'),
(89, 'Guadeloupe', 'GP'),
(90, 'Guam', 'GU'),
(91, 'Guatemala', 'GT'),
(92, 'Guernsey', 'GG'),
(93, 'Guinea', 'GN'),
(94, 'Guinea-Bissau', 'GW'),
(95, 'Guyana', 'GY'),
(96, 'Haiti', 'HT'),
(97, 'Heard Island and McDonald Islands', 'HM'),
(98, 'Honduras', 'HN'),
(99, 'Hong Kong', 'HK'),
(100, 'Hungary', 'HU'),
(101, 'Iceland', 'IS'),
(102, 'India', 'IN'),
(103, 'Indonesia', 'ID'),
(104, 'Iran', 'IR'),
(105, 'Iraq', 'IQ'),
(106, 'Ireland', 'IE'),
(107, 'Isle of Man', 'IM'),
(108, 'Israel', 'IL'),
(109, 'Italy', 'IT'),
(110, 'Ivory Coast', 'CI'),
(111, 'Jamaica', 'JM'),
(112, 'Japan', 'JP'),
(113, 'Jersey', 'JE'),
(114, 'Jordan', 'JO'),
(115, 'Kazakhstan', 'KZ'),
(116, 'Kenya', 'KE'),
(117, 'Kiribati', 'KI'),
(118, 'Kosovo', 'XK'),
(119, 'Kuwait', 'KW'),
(120, 'Kyrgyzstan', 'KG'),
(121, 'Laos', 'LA'),
(122, 'Latvia', 'LV'),
(123, 'Lebanon', 'LB'),
(124, 'Lesotho', 'LS'),
(125, 'Liberia', 'LR'),
(126, 'Libya', 'LY'),
(127, 'Liechtenstein', 'LI'),
(128, 'Lithuania', 'LT'),
(129, 'Luxembourg', 'LU'),
(130, 'Macao', 'MO'),
(131, 'Macedonia', 'MK'),
(132, 'Madagascar', 'MG'),
(133, 'Malawi', 'MW'),
(134, 'Malaysia', 'MY'),
(135, 'Maldives', 'MV'),
(136, 'Mali', 'ML'),
(137, 'Malta', 'MT'),
(138, 'Marshall Islands', 'MH'),
(139, 'Martinique', 'MQ'),
(140, 'Mauritania', 'MR'),
(141, 'Mauritius', 'MU'),
(142, 'Mayotte', 'YT'),
(143, 'Mexico', 'MX'),
(144, 'Micronesia', 'FM'),
(145, 'Moldova', 'MD'),
(146, 'Monaco', 'MC'),
(147, 'Mongolia', 'MN'),
(148, 'Montenegro', 'ME'),
(149, 'Montserrat', 'MS'),
(150, 'Morocco', 'MA'),
(151, 'Mozambique', 'MZ'),
(152, 'Myanmar [Burma]', 'MM'),
(153, 'Namibia', 'NA'),
(154, 'Nauru', 'NR'),
(155, 'Nepal', 'NP'),
(156, 'Netherlands', 'NL'),
(157, 'New Caledonia', 'NC'),
(158, 'New Zealand', 'NZ'),
(159, 'Nicaragua', 'NI'),
(160, 'Niger', 'NE'),
(161, 'Nigeria', 'NG'),
(162, 'Niue', 'NU'),
(163, 'Norfolk Island', 'NF'),
(164, 'North Korea', 'KP'),
(165, 'Northern Mariana Islands', 'MP'),
(166, 'Norway', 'NO'),
(167, 'Oman', 'OM'),
(168, 'Pakistan', 'PK'),
(169, 'Palau', 'PW'),
(170, 'Palestine', 'PS'),
(171, 'Panama', 'PA'),
(172, 'Papua New Guinea', 'PG'),
(173, 'Paraguay', 'PY'),
(174, 'Peru', 'PE'),
(175, 'Philippines', 'PH'),
(176, 'Pitcairn Islands', 'PN'),
(177, 'Poland', 'PL'),
(178, 'Portugal', 'PT'),
(179, 'Puerto Rico', 'PR'),
(180, 'Qatar', 'QA'),
(181, 'Republic of the Congo', 'CG'),
(182, 'Réunion', 'RE'),
(183, 'Romania', 'RO'),
(184, 'Russia', 'RU'),
(185, 'Rwanda', 'RW'),
(186, 'Saint Barthélemy', 'BL'),
(187, 'Saint Helena', 'SH'),
(188, 'Saint Kitts and Nevis', 'KN'),
(189, 'Saint Lucia', 'LC'),
(190, 'Saint Martin', 'MF'),
(191, 'Saint Pierre and Miquelon', 'PM'),
(192, 'Saint Vincent and the Grenadines', 'VC'),
(193, 'Samoa', 'WS'),
(194, 'San Marino', 'SM'),
(195, 'São Tomé and Príncipe', 'ST'),
(196, 'Saudi Arabia', 'SA'),
(197, 'Senegal', 'SN'),
(198, 'Serbia', 'RS'),
(199, 'Seychelles', 'SC'),
(200, 'Sierra Leone', 'SL'),
(201, 'Singapore', 'SG'),
(202, 'Sint Maarten', 'SX'),
(203, 'Slovakia', 'SK'),
(204, 'Slovenia', 'SI'),
(205, 'Solomon Islands', 'SB'),
(206, 'Somalia', 'SO'),
(207, 'South Africa', 'ZA'),
(208, 'South Georgia and the South Sandwich Islands', 'GS'),
(209, 'South Korea', 'KR'),
(210, 'South Sudan', 'SS'),
(211, 'Spain', 'ES'),
(212, 'Sri Lanka', 'LK'),
(213, 'Sudan', 'SD'),
(214, 'Suriname', 'SR'),
(215, 'Svalbard and Jan Mayen', 'SJ'),
(216, 'Swaziland', 'SZ'),
(217, 'Sweden', 'SE'),
(218, 'Switzerland', 'CH'),
(219, 'Syria', 'SY'),
(220, 'Taiwan', 'TW'),
(221, 'Tajikistan', 'TJ'),
(222, 'Tanzania', 'TZ'),
(223, 'Thailand', 'TH'),
(224, 'Togo', 'TG'),
(225, 'Tokelau', 'TK'),
(226, 'Tonga', 'TO'),
(227, 'Trinidad and Tobago', 'TT'),
(228, 'Tunisia', 'TN'),
(229, 'Turkey', 'TR'),
(230, 'Turkmenistan', 'TM'),
(231, 'Turks and Caicos Islands', 'TC'),
(232, 'Tuvalu', 'TV'),
(233, 'U.S. Minor Outlying Islands', 'UM'),
(234, 'U.S. Virgin Islands', 'VI'),
(235, 'Uganda', 'UG'),
(236, 'Ukraine', 'UA'),
(237, 'United Arab Emirates', 'AE'),
(238, 'United Kingdom', 'GB'),
(239, 'United States', 'US'),
(240, 'Uruguay', 'UY'),
(241, 'Uzbekistan', 'UZ'),
(242, 'Vanuatu', 'VU'),
(243, 'Vatican City', 'VA'),
(244, 'Venezuela', 'VE'),
(245, 'Vietnam', 'VN'),
(246, 'Wallis and Futuna', 'WF'),
(247, 'Western Sahara', 'EH'),
(248, 'Yemen', 'YE'),
(249, 'Zambia', 'ZM'),
(250, 'Zimbabwe', 'ZW');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_coupon`
--

CREATE TABLE `pm_coupon` (
  `id` int(11) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `discount` double DEFAULT 0,
  `discount_type` varchar(10) DEFAULT NULL,
  `rooms` text DEFAULT NULL,
  `once` int(11) DEFAULT NULL,
  `checked` int(11) DEFAULT 0,
  `publish_date` int(11) DEFAULT NULL,
  `unpublish_date` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_coupon_user`
--

CREATE TABLE `pm_coupon_user` (
  `id` int(11) NOT NULL,
  `id_coupon` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_currency`
--

CREATE TABLE `pm_currency` (
  `id` int(11) NOT NULL,
  `code` varchar(5) DEFAULT NULL,
  `sign` varchar(5) DEFAULT NULL,
  `main` int(11) DEFAULT 0,
  `rank` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `pm_currency`
--

INSERT INTO `pm_currency` (`id`, `code`, `sign`, `main`, `rank`) VALUES
(1, 'USD', '$', 0, 1),
(2, 'EUR', '€', 0, 2),
(3, 'GBP', '£', 0, 3),
(4, 'INR', '₹', 0, 4),
(5, 'AUD', 'A$', 0, 5),
(6, 'CAD', 'C$', 0, 6),
(7, 'CNY', '¥', 0, 7),
(8, 'TRY', '₺', 1, 8);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_destination`
--

CREATE TABLE `pm_destination` (
  `id` int(11) NOT NULL,
  `lang` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `subtitle` varchar(250) DEFAULT NULL,
  `title_tag` varchar(250) DEFAULT NULL,
  `alias` varchar(100) DEFAULT NULL,
  `descr` text DEFAULT NULL,
  `text` longtext DEFAULT NULL,
  `video` text DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `home` int(11) DEFAULT 0,
  `checked` int(11) DEFAULT 0,
  `rank` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `pm_destination`
--

INSERT INTO `pm_destination` (`id`, `lang`, `name`, `title`, `subtitle`, `title_tag`, `alias`, `descr`, `text`, `video`, `lat`, `lng`, `home`, `checked`, `rank`) VALUES
(1, 1, '', '', '', '', '', '', '', '', 41.1212, 41.45454, 0, 1, 1),
(1, 2, 'İstanbul', 'İstanbul', '', 'İstanbul', '', '', '', '', 41.1212, 41.45454, 1, 1, 1),
(1, 3, '', '', '', '', '', '', '', '', 41.1212, 41.45454, 0, 1, 1),
(1, 4, 'İstanbul', 'İstanbul', '', 'İstanbul', 'istanbul', '', '', '', 41.1212, 41.45454, 1, 1, 1),
(2, 2, '', '', '', '', '', '', '', '', 123, 123, 1, 1, 2),
(2, 4, 'Ankara', 'Ankara', 'Ankara', 'ankara', 'ankara', 'bu bir denmedir', '', '', 123, 123, 1, 1, 2),
(3, 2, '', '', '', '', '', '', '', '', 123, 123, 1, 1, 3),
(3, 4, 'İzmir', 'İzmir', 'İzmir', 'izmir', 'izmir', '', '<p>bu bir denemdir</p>\r\n', '', 123, 123, 1, 1, 3),
(4, 2, '', '', '', '', '', '', '', '', 123, 123, 1, 1, 4),
(4, 4, 'Bursa', 'Bursa', 'Bursa', 'bursa', 'bursa', '', '', '', 123, 123, 1, 1, 4),
(5, 2, '', '', '', '', '', '', '', '', 123, 123, 1, 1, 5),
(5, 4, 'Gaziantep', 'Gaziantep', 'Gaziantep', 'gaziantep', 'gaziantep', '', '', '', 123, 123, 1, 1, 5);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_destination_file`
--

CREATE TABLE `pm_destination_file` (
  `id` int(11) NOT NULL,
  `lang` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `home` int(11) DEFAULT 0,
  `checked` int(11) DEFAULT 1,
  `rank` int(11) DEFAULT 0,
  `file` varchar(250) DEFAULT NULL,
  `label` varchar(250) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `pm_destination_file`
--

INSERT INTO `pm_destination_file` (`id`, `lang`, `id_item`, `home`, `checked`, `rank`, `file`, `label`, `type`) VALUES
(1, 2, 1, NULL, 1, 1, 'indir.jpg', '', 'image'),
(1, 4, 1, NULL, 1, 1, 'indir.jpg', '', 'image'),
(2, 2, 2, NULL, 1, 2, 'ankara.jpg', NULL, 'image'),
(2, 4, 2, NULL, 1, 2, 'ankara.jpg', NULL, 'image'),
(5, 2, 4, NULL, 1, 4, 'bursa.jpg', NULL, 'image'),
(5, 4, 4, NULL, 1, 4, 'bursa.jpg', NULL, 'image'),
(6, 2, 5, NULL, 1, 5, 'gaziantep.jpg', '', 'image'),
(6, 4, 5, NULL, 1, 5, 'gaziantep.jpg', '', 'image'),
(7, 2, 3, NULL, 1, 6, 'izmir.jpg', NULL, 'image'),
(7, 4, 3, NULL, 1, 6, 'izmir.jpg', NULL, 'image');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_email_content`
--

CREATE TABLE `pm_email_content` (
  `id` int(11) NOT NULL,
  `lang` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `subject` varchar(250) DEFAULT NULL,
  `content` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `pm_email_content`
--

INSERT INTO `pm_email_content` (`id`, `lang`, `name`, `subject`, `content`) VALUES
(1, 1, 'CONTACT', 'Contact', '<b>Nom:</b> {name}<b>Adresse:</b> {address}<b>Téléphone:</b> {phone}<b>E-mail:</b> {email}<b>Message:</b>{msg}'),
(1, 2, 'CONTACT', 'Contact', '<b>Name:</b> {name}<br><b>Address:</b> {address}<br><b>Phone:</b> {phone}<br><b>E-mail:</b> {email}<br><b>Message:</b><br>{msg}'),
(1, 3, 'CONTACT', 'Contact', '<b>Name:</b> {name}<b>Address:</b> {address}<b>Phone:</b> {phone}<b>E-mail:</b> {email}<b>Message:</b>{msg}'),
(1, 4, 'CONTACT', 'Contact', '<b>Name:</b> {name}<br><b>Address:</b> {address}<br><b>Phone:</b> {phone}<br><b>E-mail:</b> {email}<br><b>Message:</b><br>{msg}'),
(2, 1, 'BOOKING_REQUEST', 'Demande de réservation', '<p><b>Adresse de facturation</b><br />\r\n{firstname} {lastname}<br />\r\n{address}<br />\r\n{postcode} {city}<br />\r\nSociété : {company}<br />\r\nTéléphone : {phone}<br />\r\nMobile : {mobile}<br />\r\nEmail : {email}</p>\r\n\r\n<p><strong>Détails de la réservation</strong><br />\r\nArrivée : <b>{Check_in}</b><br />\r\nDépart : <b>{Check_out}</b><br />\r\n<b>{num_nights}</b> nuit(s)<br />\r\n<b>{num_guests}</b> personne(s) - Adulte(s) : <b>{num_adults}</b> / Enfant(s) : <b>{num_children}</b></p>\r\n\r\n<p><b>Chambres</b></p>\r\n\r\n<p>{rooms}</p>\r\n\r\n<p><b>Services supplémentaires</b></p>\r\n\r\n<p>{extra_services}</p>\r\n\r\n<p><b>Activités</b></p>\r\n\r\n<p>{activities}</p>\r\n\r\n<p><b>Commentaires</b><br />\r\n{comments}</p>\r\n'),
(2, 2, 'BOOKING_REQUEST', 'Booking request', '<p><b>Billing address</b><br />\r\n{firstname} {lastname}<br />\r\n{address}<br />\r\n{postcode} {city}<br />\r\nCompany: {company}<br />\r\nPhone: {phone}<br />\r\nMobile: {mobile}<br />\r\nEmail: {email}</p>\r\n\r\n<p><strong>Booking details</strong><br />\r\nCheck in <b>{Check_in}</b><br />\r\nCheck out <b>{Check_out}</b><br />\r\n<b>{num_nights}</b> nights<br />\r\n<b>{num_guests}</b> persons - Adults: <b>{num_adults}</b> / Children: <b>{num_children}</b></p>\r\n\r\n<p><strong>Rooms</strong></p>\r\n\r\n<p>{rooms}</p>\r\n\r\n<p><b>Extra services</b></p>\r\n\r\n<p>{extra_services}</p>\r\n\r\n<p><b>Activities</b></p>\r\n\r\n<p>{activities}</p>\r\n\r\n<p><b>Comments</b><br />\r\n{comments}</p>\r\n'),
(2, 3, 'BOOKING_REQUEST', 'Booking request', '<p><b>Billing address</b><br />\r\n{firstname} {lastname}<br />\r\n{address}<br />\r\n{postcode} {city}<br />\r\nCompany: {company}<br />\r\nPhone: {phone}<br />\r\nMobile: {mobile}<br />\r\nEmail: {email}</p>\r\n\r\n<p><strong>Booking details</strong><br />\r\nCheck in <b>{Check_in}</b><br />\r\nCheck out <b>{Check_out}</b><br />\r\n<b>{num_nights}</b> nights<br />\r\n<b>{num_guests}</b> persons - Adults: <b>{num_adults}</b> / Children: <b>{num_children}</b></p>\r\n\r\n<p><strong>Rooms</strong></p>\r\n\r\n<p>{rooms}</p>\r\n\r\n<p><b>Extra services</b></p>\r\n\r\n<p>{extra_services}</p>\r\n\r\n<p><b>Activities</b></p>\r\n\r\n<p>{activities}</p>\r\n\r\n<p><b>Comments</b><br />\r\n{comments}</p>\r\n'),
(2, 4, 'BOOKING_REQUEST', 'Booking request', '<p><b>Billing address</b><br />\r\n{firstname} {lastname}<br />\r\n{address}<br />\r\n{postcode} {city}<br />\r\nCompany: {company}<br />\r\nPhone: {phone}<br />\r\nMobile: {mobile}<br />\r\nEmail: {email}</p>\r\n\r\n<p><strong>Booking details</strong><br />\r\nCheck in <b>{Check_in}</b><br />\r\nCheck out <b>{Check_out}</b><br />\r\n<b>{num_nights}</b> nights<br />\r\n<b>{num_guests}</b> persons - Adults: <b>{num_adults}</b> / Children: <b>{num_children}</b></p>\r\n\r\n<p><strong>Rooms</strong></p>\r\n\r\n<p>{rooms}</p>\r\n\r\n<p><b>Extra services</b></p>\r\n\r\n<p>{extra_services}</p>\r\n\r\n<p><b>Activities</b></p>\r\n\r\n<p>{activities}</p>\r\n\r\n<p><b>Comments</b><br />\r\n{comments}</p>\r\n'),
(3, 1, 'BOOKING_CONFIRMATION', 'Confirmation de réservation', '<p><b>Adresse de facturation</b><br />\r\n{firstname} {lastname}<br />\r\n{address}<br />\r\n{postcode} {city}<br />\r\nSociété : {company}<br />\r\nTéléphone : {phone}<br />\r\nMobile : {mobile}<br />\r\nEmail : {email}</p>\r\n\r\n<p><strong>Détails de la réservation</strong><br />\r\nArrivée : <b>{Check_in}</b><br />\r\nDépart : <b>{Check_out}</b><br />\r\n<b>{num_nights}</b> nuit(s)<br />\r\n<b>{num_guests}</b> personne(s) - Adulte(s) : <b>{num_adults}</b> / Enfant(s) : <b>{num_children}</b></p>\r\n\r\n<p><b>Chambres</b></p>\r\n\r\n<p>{rooms}</p>\r\n\r\n<p><b>Services supplémentaires</b></p>\r\n\r\n<p>{extra_services}</p>\r\n\r\n<p><b>Activités</b></p>\r\n\r\n<p>{activities}</p>\r\n\r\n<p>Taxe de séjour : {tourist_tax}<br />\r\nRéduction: {discount}<br />\r\n{taxes}<br />\r\nTotal : <strong>{total} TTC</strong></p>\r\n\r\n<p>Acompte : <strong>{down_payment} TTC</strong></p>\r\n\r\n<p><b>Commentaires</b><br />\r\n{comments}</p>\r\n\r\n<p>{payment_notice}</p>\r\n'),
(3, 2, 'BOOKING_CONFIRMATION', 'Booking confirmation', '<p><b>Billing address</b><br />\r\n{firstname} {lastname}<br />\r\n{address}<br />\r\n{postcode} {city}<br />\r\nCompany: {company}<br />\r\nPhone: {phone}<br />\r\nMobile: {mobile}<br />\r\nEmail: {email}</p>\r\n\r\n<p><strong>Booking details</strong><br />\r\nCheck in <b>{Check_in}</b><br />\r\nCheck out <b>{Check_out}</b><br />\r\n<b>{num_nights}</b> nights<br />\r\n<b>{num_guests}</b> persons - Adults: <b>{num_adults}</b> / Children: <b>{num_children}</b></p>\r\n\r\n<p><strong>Rooms</strong></p>\r\n\r\n<p>{rooms}</p>\r\n\r\n<p><b>Extra services</b></p>\r\n\r\n<p>{extra_services}</p>\r\n\r\n<p><b>Activities</b></p>\r\n\r\n<p>{activities}</p>\r\n\r\n<p>Tourist tax: {tourist_tax}<br />\r\nDiscount: {discount}<br />\r\n{taxes}<br />\r\nTotal: <strong>{total} incl. VAT</strong></p>\r\n\r\n<p>Down payment: <strong>{down_payment} incl. VAT</strong></p>\r\n\r\n<p><b>Comments</b><br />\r\n{comments}</p>\r\n\r\n<p>{payment_notice}</p>\r\n'),
(3, 3, 'BOOKING_CONFIRMATION', 'Booking confirmation', '<p><b>Billing address</b><br />\r\n{firstname} {lastname}<br />\r\n{address}<br />\r\n{postcode} {city}<br />\r\nCompany: {company}<br />\r\nPhone: {phone}<br />\r\nMobile: {mobile}<br />\r\nEmail: {email}</p>\r\n\r\n<p><strong>Booking details</strong><br />\r\nCheck in <b>{Check_in}</b><br />\r\nCheck out <b>{Check_out}</b><br />\r\n<b>{num_nights}</b> nights<br />\r\n<b>{num_guests}</b> persons - Adults: <b>{num_adults}</b> / Children: <b>{num_children}</b></p>\r\n\r\n<p><strong>Rooms</strong></p>\r\n\r\n<p>{rooms}</p>\r\n\r\n<p><b>Extra services</b></p>\r\n\r\n<p>{extra_services}</p>\r\n\r\n<p><b>Activities</b></p>\r\n\r\n<p>{activities}</p>\r\n\r\n<p>Tourist tax: {tourist_tax}<br />\r\nDiscount: {discount}<br />\r\n{taxes}<br />\r\nTotal: <strong>{total} incl. VAT</strong></p>\r\n\r\n<p>Down payment: <strong>{down_payment} incl. VAT</strong></p>\r\n\r\n<p><b>Comments</b><br />\r\n{comments}</p>\r\n\r\n<p>{payment_notice}</p>\r\n'),
(3, 4, 'BOOKING_CONFIRMATION', 'Booking confirmation', '<p><b>Billing address</b><br />\r\n{firstname} {lastname}<br />\r\n{address}<br />\r\n{postcode} {city}<br />\r\nCompany: {company}<br />\r\nPhone: {phone}<br />\r\nMobile: {mobile}<br />\r\nEmail: {email}</p>\r\n\r\n<p><strong>Booking details</strong><br />\r\nCheck in <b>{Check_in}</b><br />\r\nCheck out <b>{Check_out}</b><br />\r\n<b>{num_nights}</b> nights<br />\r\n<b>{num_guests}</b> persons - Adults: <b>{num_adults}</b> / Children: <b>{num_children}</b></p>\r\n\r\n<p><strong>Rooms</strong></p>\r\n\r\n<p>{rooms}</p>\r\n\r\n<p><b>Extra services</b></p>\r\n\r\n<p>{extra_services}</p>\r\n\r\n<p><b>Activities</b></p>\r\n\r\n<p>{activities}</p>\r\n\r\n<p>Tourist tax: {tourist_tax}<br />\r\nDiscount: {discount}<br />\r\n{taxes}<br />\r\nTotal: <strong>{total} incl. VAT</strong></p>\r\n\r\n<p>Down payment: <strong>{down_payment} incl. VAT</strong></p>\r\n\r\n<p><b>Comments</b><br />\r\n{comments}</p>\r\n\r\n<p>{payment_notice}</p>\r\n'),
(4, 1, 'ACCOUNT_CONFIRMATION', 'Confirmation du compte', '<p>Bonjour,<br />\r\nVous avez cr&eacute;&eacute; un nouveau compte.<br />\r\nCliquez sur le lien ci-dessous pour valider votre compte:<br />\r\n<a href=\"{link}\">Valider mon compte</a></p>\r\n'),
(4, 2, 'ACCOUNT_CONFIRMATION', 'Validate your account', '<p>Hi,<br />\r\nYou created a new account.<br />\r\nClick on the link bellow to validate your account:<br />\r\n<a href=\"{link}\">Validate my new account</a></p>\r\n'),
(4, 3, 'ACCOUNT_CONFIRMATION', 'Validate your account', '<p>Hi,<br />\r\nYou created a new account.<br />\r\nClick on the link bellow to validate your account:<br />\r\n<a href=\"{link}\">Validate my new account</a></p>\r\n'),
(4, 4, 'ACCOUNT_CONFIRMATION', 'Validate your account', '<p>Hi,<br />\r\nYou created a new account.<br />\r\nClick on the link bellow to validate your account:<br />\r\n<a href=\"{link}\">Validate my new account</a></p>\r\n');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_facility`
--

CREATE TABLE `pm_facility` (
  `id` int(11) NOT NULL,
  `lang` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `category` varchar(200) NOT NULL,
  `rank` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `pm_facility`
--

INSERT INTO `pm_facility` (`id`, `lang`, `name`, `category`, `rank`) VALUES
(1, 1, 'Climatisation', 'Fiziksel İmkanlar', NULL),
(1, 2, 'Klima ve Aircondition', 'fiziksel', NULL),
(1, 3, '', 'Fiziksel İmkanlar', NULL),
(1, 4, 'Klima', 'fiziksel', NULL),
(3, 1, 'Balcon', 'Fiziksel İmkanlar', 3),
(3, 2, 'Balcony', 'fiziksel', NULL),
(3, 4, 'Bahçe', 'fiziksel', NULL),
(6, 1, 'Cafetière', 'Fiziksel İmkanlar', 6),
(6, 2, 'Coffeemaker', 'fiziksel', NULL),
(6, 4, 'Kafeterya', 'fiziksel', NULL),
(7, 1, 'Plaque de cuisson', 'Fiziksel İmkanlar', 7),
(7, 2, 'Cooktop', 'fiziksel', NULL),
(7, 4, 'Yemekhane', 'fiziksel', NULL),
(8, 1, 'Bureau', 'Fiziksel İmkanlar', 8),
(8, 2, 'Desk', 'fiziksel', NULL),
(8, 4, 'Laboratuvar', 'fiziksel', NULL),
(9, 1, 'Lave vaisselle', 'Fiziksel İmkanlar', 9),
(9, 2, 'Dishwasher', 'fiziksel', NULL),
(9, 4, ' Sanat Atölyesi', 'fiziksel', NULL),
(10, 1, 'Ventilateur', 'Fiziksel İmkanlar', 10),
(10, 2, 'Fan', 'fiziksel', NULL),
(10, 4, 'Oyun Alanı', 'fiziksel', NULL),
(11, 1, 'Parking gratuit', 'Fiziksel İmkanlar', 11),
(11, 2, 'Free parking', 'sanatsal', NULL),
(11, 4, 'Drama', 'sanatsal', NULL),
(12, 1, 'Réfrigérateur', 'Fiziksel İmkanlar', 12),
(12, 2, 'Fridge', 'fiziksel', NULL),
(12, 4, 'Müzik Odası', 'fiziksel', NULL),
(14, 1, 'Internet', 'Fiziksel İmkanlar', 14),
(14, 2, 'Internet', 'hizmetler', NULL),
(14, 4, 'Internet', 'hizmetler', NULL),
(16, 1, 'Micro-ondes', 'Fiziksel İmkanlar', 16),
(16, 2, 'Microwave', 'fiziksel', NULL),
(16, 4, 'Konferans Salonu', 'fiziksel', NULL),
(18, 1, 'Non-fumeurs', 'Fiziksel İmkanlar', 18),
(18, 2, 'Non-smoking', 'fiziksel', NULL),
(18, 4, 'Revir', 'fiziksel', NULL),
(19, 1, 'Parking payant', 'Fiziksel İmkanlar', 19),
(19, 2, 'Paid parking', 'sanatsal', NULL),
(19, 4, 'Piyano', 'sanatsal', NULL),
(20, 1, 'Animaux acceptés', 'Fiziksel İmkanlar', 20),
(20, 2, 'Pets allowed', 'sanatsal', NULL),
(20, 4, 'Görsel Sanatlar', 'sanatsal', NULL),
(21, 1, 'Animaux interdits', 'Fiziksel İmkanlar', 21),
(21, 2, 'Pets not allowed', 'sportif', NULL),
(21, 4, 'Basketbol', 'sportif', NULL),
(22, 1, 'Radio', 'Fiziksel İmkanlar', 22),
(22, 2, 'Radio', 'sanatsal', NULL),
(22, 4, 'Ebru', 'sanatsal', NULL),
(23, 1, 'Coffre-fort', 'Fiziksel İmkanlar', 23),
(23, 2, 'Safe', 'sportif', NULL),
(23, 4, 'Voleybol', 'sportif', NULL),
(24, 1, 'Chaines satellite', 'Fiziksel İmkanlar', 24),
(24, 2, 'Satellite chanels', 'sanatsal', NULL),
(24, 4, 'Futbol', 'sanatsal', NULL),
(25, 1, 'Salle d\'eau', 'Fiziksel İmkanlar', 25),
(25, 2, 'Shower-room', 'sportif', NULL),
(25, 4, 'Hentbol', 'sportif', NULL),
(26, 1, 'Coin salon', 'Fiziksel İmkanlar', 26),
(26, 2, 'Small lounge', 'kulupler', NULL),
(26, 4, 'Müzik Kulübü', 'kulupler', NULL),
(27, 1, 'Telephone', 'Fiziksel İmkanlar', 27),
(27, 2, 'Telephone', 'kulupler', NULL),
(27, 4, 'Gezi Kulübü', 'kulupler', NULL),
(28, 1, 'Téléviseur', 'Fiziksel İmkanlar', 28),
(28, 2, 'Television', 'kulupler', NULL),
(28, 4, 'Bilişim Teknolojileri Kulübü', 'kulupler', NULL),
(29, 1, 'Terrasse', 'Fiziksel İmkanlar', 29),
(29, 2, 'Terrasse', 'hizmetler', NULL),
(29, 4, 'Servis', 'hizmetler', NULL),
(30, 1, 'Machine à laver', 'Fiziksel İmkanlar', 30),
(30, 2, 'Washing machine', 'hizmetler', NULL),
(30, 4, 'Kantin', 'hizmetler', NULL),
(31, 1, 'Accès handicapés', 'Fiziksel İmkanlar', 31),
(31, 2, 'Wheelchair accessible', 'hizmetler', NULL),
(31, 4, 'Güvenlik', 'hizmetler', NULL),
(32, 1, 'Wi-Fi', 'Fiziksel İmkanlar', 31),
(32, 2, 'WiFi', 'hizmetler', NULL),
(32, 4, 'WiFi', 'hizmetler', NULL),
(33, 1, 'Chaine hifi', 'Fiziksel İmkanlar', 32),
(33, 2, 'Hi-fi system', 'fiziksel', NULL),
(33, 4, 'Kütüphane', 'fiziksel', NULL),
(34, 1, 'Lecteur DVD', 'Fiziksel İmkanlar', 33),
(34, 2, 'DVD player', 'fiziksel', NULL),
(34, 4, 'Akıllı Tahta', 'fiziksel', NULL),
(35, 1, 'Ascenceur', 'Fiziksel İmkanlar', 34),
(35, 2, 'Elevator', 'fiziksel', NULL),
(35, 4, 'Asansör', 'fiziksel', NULL),
(37, 1, 'Restaurant', 'Fiziksel İmkanlar', 36),
(37, 2, 'Restaurant', 'fiziksel', NULL),
(37, 4, 'Restaurant', 'fiziksel', NULL),
(38, 1, 'Service de chambre', 'Fiziksel İmkanlar', 37),
(38, 2, 'Room service', 'sanatsal', NULL),
(38, 4, 'El Sanatları', 'sanatsal', NULL),
(40, 2, '', 'fiziksel', NULL),
(40, 4, 'Bilgisayar Laboratuvarı', 'fiziksel', NULL),
(41, 2, '', 'dil', NULL),
(41, 4, 'İngilizce', 'dil', NULL),
(42, 2, '', 'kulupler', NULL),
(42, 4, 'Robotik Kulübü', 'kulupler', NULL),
(43, 2, '', 'hizmetler', NULL),
(43, 4, 'Rehberlik', 'hizmetler', NULL),
(44, 2, '', 'sanatsal', NULL),
(44, 4, 'Fotoğrafçılık', 'sanatsal', NULL),
(45, 2, '', 'sanatsal', NULL),
(45, 4, 'Gitar', 'sanatsal', NULL),
(46, 2, '', 'kulupler', NULL),
(46, 4, 'Proje Kulübü', 'kulupler', NULL),
(47, 2, '', 'kulupler', NULL),
(47, 4, 'Yabancı Dil Kulübü', 'kulupler', NULL),
(48, 2, '', 'kulupler', NULL),
(48, 4, 'Akıl ve Zeka Oyunları', 'kulupler', NULL),
(49, 2, '', 'kulupler', NULL),
(49, 4, 'Gazetecilik', 'kulupler', NULL),
(50, 2, '', 'sportif', NULL),
(50, 4, 'Badminton', 'sportif', NULL),
(51, 2, '', 'dil', NULL),
(51, 4, 'Almanca', 'dil', NULL),
(52, 2, '', 'dil', NULL),
(52, 4, 'Fransızca', 'dil', NULL),
(53, 2, '', 'dil', NULL),
(53, 4, 'İspanyolca', 'dil', NULL),
(54, 2, '', 'dil', NULL),
(54, 4, 'Japonca', 'dil', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_facility_file`
--

CREATE TABLE `pm_facility_file` (
  `id` int(11) NOT NULL,
  `lang` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `home` int(11) DEFAULT 0,
  `checked` int(11) DEFAULT 1,
  `rank` int(11) DEFAULT 0,
  `file` varchar(250) DEFAULT NULL,
  `label` varchar(250) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `pm_facility_file`
--

INSERT INTO `pm_facility_file` (`id`, `lang`, `id_item`, `home`, `checked`, `rank`, `file`, `label`, `type`) VALUES
(32, 2, 32, 0, 1, 32, 'wifi.png', '', 'image'),
(32, 4, 32, 0, 1, 32, '', '', 'image'),
(33, 2, 33, 0, 1, 1, '', '', 'image'),
(33, 4, 33, 0, 1, 1, '', '', 'image'),
(34, 2, 34, 0, 1, 34, '', '', 'image'),
(34, 4, 34, 0, 1, 34, '', '', 'image'),
(40, 2, 41, NULL, 1, 35, '', NULL, 'image'),
(40, 4, 41, NULL, 1, 35, '', NULL, 'image'),
(42, 2, 40, NULL, 1, 36, '', NULL, 'image'),
(42, 4, 40, NULL, 1, 36, '', NULL, 'image'),
(44, 2, 51, NULL, 1, 37, '', NULL, 'image'),
(44, 4, 51, NULL, 1, 37, '', NULL, 'image'),
(45, 2, 35, NULL, 1, 38, '', NULL, 'image'),
(45, 4, 35, NULL, 1, 38, '', NULL, 'image'),
(92, 2, 9, NULL, 1, 85, 'sanat-atolyesi.png', NULL, 'image'),
(92, 4, 9, NULL, 1, 85, 'sanat-atolyesi.png', NULL, 'image'),
(93, 2, 48, NULL, 1, 86, 'ak-lvezeka.png', NULL, 'image'),
(93, 4, 48, NULL, 1, 86, 'ak-lvezeka.png', NULL, 'image'),
(94, 2, 34, NULL, 1, 87, 'ak-ll-tahta.png', NULL, 'image'),
(94, 4, 34, NULL, 1, 87, 'ak-ll-tahta.png', NULL, 'image'),
(96, 2, 35, NULL, 1, 89, 'asansor.png', NULL, 'image'),
(96, 4, 35, NULL, 1, 89, 'asansor.png', NULL, 'image'),
(97, 2, 50, NULL, 1, 90, 'badminton.png', NULL, 'image'),
(97, 4, 50, NULL, 1, 90, 'badminton.png', NULL, 'image'),
(98, 2, 3, NULL, 1, 1, 'bahce.png', NULL, 'image'),
(98, 4, 3, NULL, 1, 1, 'bahce.png', NULL, 'image'),
(99, 2, 21, NULL, 1, 91, 'basketball-ball.png', NULL, 'image'),
(99, 4, 21, NULL, 1, 91, 'basketball-ball.png', NULL, 'image'),
(100, 2, 40, NULL, 1, 92, 'bilgi-laboratuvar.png', NULL, 'image'),
(100, 4, 40, NULL, 1, 92, 'bilgi-laboratuvar.png', NULL, 'image'),
(101, 2, 28, NULL, 1, 93, 'bili-im-teknolojiler.png', NULL, 'image'),
(101, 4, 28, NULL, 1, 93, 'bili-im-teknolojiler.png', NULL, 'image'),
(102, 2, 11, NULL, 1, 94, 'drama.png', NULL, 'image'),
(102, 4, 11, NULL, 1, 94, 'drama.png', NULL, 'image'),
(103, 2, 22, NULL, 1, 95, 'ebru-sanat.png', NULL, 'image'),
(103, 4, 22, NULL, 1, 95, 'ebru-sanat.png', NULL, 'image'),
(104, 2, 24, NULL, 1, 96, 'football.png', NULL, 'image'),
(104, 4, 24, NULL, 1, 96, 'football.png', NULL, 'image'),
(105, 2, 49, NULL, 1, 97, 'gazetecilik.png', NULL, 'image'),
(105, 4, 49, NULL, 1, 97, 'gazetecilik.png', NULL, 'image'),
(106, 2, 27, NULL, 1, 98, 'gezi-kulubu.png', NULL, 'image'),
(106, 4, 27, NULL, 1, 98, 'gezi-kulubu.png', NULL, 'image'),
(107, 2, 45, NULL, 1, 99, 'gitar.png', NULL, 'image'),
(107, 4, 45, NULL, 1, 99, 'gitar.png', NULL, 'image'),
(108, 2, 20, NULL, 1, 100, 'gorsel-sanatlar.png', NULL, 'image'),
(108, 4, 20, NULL, 1, 100, 'gorsel-sanatlar.png', NULL, 'image'),
(109, 2, 31, NULL, 1, 101, 'guvenlik.png', NULL, 'image'),
(109, 4, 31, NULL, 1, 101, 'guvenlik.png', NULL, 'image'),
(110, 2, 25, NULL, 1, 102, 'hentbol.png', NULL, 'image'),
(110, 4, 25, NULL, 1, 102, 'hentbol.png', NULL, 'image'),
(111, 2, 14, NULL, 1, 103, 'internet.png', NULL, 'image'),
(111, 4, 14, NULL, 1, 103, 'internet.png', NULL, 'image'),
(112, 2, 6, NULL, 1, 104, 'kafetarya.png', NULL, 'image'),
(112, 4, 6, NULL, 1, 104, 'kafetarya.png', NULL, 'image'),
(113, 2, 30, NULL, 1, 105, 'kantin.png', NULL, 'image'),
(113, 4, 30, NULL, 1, 105, 'kantin.png', NULL, 'image'),
(114, 2, 1, NULL, 1, 106, 'klima.png', NULL, 'image'),
(114, 4, 1, NULL, 1, 106, 'klima.png', NULL, 'image'),
(115, 2, 16, NULL, 1, 107, 'konferans-salonu.png', NULL, 'image'),
(115, 4, 16, NULL, 1, 107, 'konferans-salonu.png', NULL, 'image'),
(116, 2, 33, NULL, 1, 108, 'kutuphane.png', NULL, 'image'),
(116, 4, 33, NULL, 1, 108, 'kutuphane.png', NULL, 'image'),
(117, 2, 8, NULL, 1, 109, 'laboratuvar.png', NULL, 'image'),
(117, 4, 8, NULL, 1, 109, 'laboratuvar.png', NULL, 'image'),
(118, 2, 26, NULL, 1, 110, 'muzik-kulubu.png', NULL, 'image'),
(118, 4, 26, NULL, 1, 110, 'muzik-kulubu.png', NULL, 'image'),
(119, 2, 12, NULL, 1, 111, 'muzik-kulubu.png', NULL, 'image'),
(119, 4, 12, NULL, 1, 111, 'muzik-kulubu.png', NULL, 'image'),
(120, 2, 10, NULL, 1, 112, 'oyun-alan.png', NULL, 'image'),
(120, 4, 10, NULL, 1, 112, 'oyun-alan.png', NULL, 'image'),
(122, 2, 19, NULL, 1, 113, 'piyano.png', NULL, 'image'),
(122, 4, 19, NULL, 1, 113, 'piyano.png', NULL, 'image'),
(123, 2, 46, NULL, 1, 114, 'proje-kulubu.png', NULL, 'image'),
(123, 4, 46, NULL, 1, 114, 'proje-kulubu.png', NULL, 'image'),
(124, 2, 43, NULL, 1, 115, 'rehberlik.png', NULL, 'image'),
(124, 4, 43, NULL, 1, 115, 'rehberlik.png', NULL, 'image'),
(125, 2, 37, NULL, 1, 116, 'restaurant.png', NULL, 'image'),
(125, 4, 37, NULL, 1, 116, 'restaurant.png', NULL, 'image'),
(126, 2, 18, NULL, 1, 117, 'revir.png', NULL, 'image'),
(126, 4, 18, NULL, 1, 117, 'revir.png', NULL, 'image'),
(127, 2, 42, NULL, 1, 118, 'robotik.png', NULL, 'image'),
(127, 4, 42, NULL, 1, 118, 'robotik.png', NULL, 'image'),
(128, 2, 29, NULL, 1, 119, 'servis.png', NULL, 'image'),
(128, 4, 29, NULL, 1, 119, 'servis.png', NULL, 'image'),
(129, 2, 23, NULL, 1, 120, 'voleyball.png', NULL, 'image'),
(129, 4, 23, NULL, 1, 120, 'voleyball.png', NULL, 'image'),
(130, 2, 32, NULL, 1, 121, 'wifi.png', NULL, 'image'),
(130, 4, 32, NULL, 1, 121, 'wifi.png', NULL, 'image'),
(131, 2, 47, NULL, 1, 122, 'yabanc-dil.png', NULL, 'image'),
(131, 4, 47, NULL, 1, 122, 'yabanc-dil.png', NULL, 'image'),
(132, 2, 7, NULL, 1, 123, 'yemekhane.png', NULL, 'image'),
(132, 4, 7, NULL, 1, 123, 'yemekhane.png', NULL, 'image'),
(133, 2, 52, NULL, 1, 124, 'frans-zca.png', NULL, 'image'),
(133, 4, 52, NULL, 1, 124, 'frans-zca.png', NULL, 'image'),
(134, 2, 53, NULL, 1, 125, 'ispanyolca.png', NULL, 'image'),
(134, 4, 53, NULL, 1, 125, 'ispanyolca.png', NULL, 'image'),
(135, 2, 54, NULL, 1, 126, 'japonca.png', NULL, 'image'),
(135, 4, 54, NULL, 1, 126, 'japonca.png', NULL, 'image'),
(136, 2, 51, NULL, 1, 127, 'almanca.png', NULL, 'image'),
(136, 4, 51, NULL, 1, 127, 'almanca.png', NULL, 'image'),
(137, 2, 41, NULL, 1, 128, 'english.png', NULL, 'image'),
(137, 4, 41, NULL, 1, 128, 'english.png', NULL, 'image');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_hotel`
--

CREATE TABLE `pm_hotel` (
  `id` int(11) NOT NULL,
  `lang` int(11) NOT NULL,
  `users` text DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `subtitle` varchar(250) DEFAULT NULL,
  `id_schoollevel` int(20) NOT NULL,
  `alias` varchar(100) DEFAULT NULL,
  `class` int(11) DEFAULT 0,
  `address` varchar(250) DEFAULT NULL,
  `state` varchar(200) NOT NULL,
  `city` varchar(200) NOT NULL,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `web` varchar(250) DEFAULT NULL,
  `descr` longtext DEFAULT NULL,
  `sss1` varchar(100) NOT NULL,
  `sss2` varchar(100) NOT NULL,
  `sss3` varchar(100) NOT NULL,
  `populer` int(11) DEFAULT 0,
  `facilities` varchar(250) DEFAULT NULL,
  `tags` text DEFAULT NULL,
  `id_destination` int(11) DEFAULT NULL,
  `paypal_email` varchar(250) DEFAULT NULL,
  `home` int(11) DEFAULT 0,
  `checked` int(11) DEFAULT 0,
  `rank` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `pm_hotel`
--

INSERT INTO `pm_hotel` (`id`, `lang`, `users`, `title`, `subtitle`, `id_schoollevel`, `alias`, `class`, `address`, `state`, `city`, `lat`, `lng`, `email`, `phone`, `web`, `descr`, `sss1`, `sss2`, `sss3`, `populer`, `facilities`, `tags`, `id_destination`, `paypal_email`, `home`, `checked`, `rank`) VALUES
(2, 1, '1', '', '', 0, '', 5, 'Fatih Mahallesi, Çanakkale Şehitleri Caddesi, No:33, Büyükçekmece/istanbul', '', '', 41.002, 41.002, '', '0 212 963 2075', '', '', '', '', '', 0, '8,14,37', '', 1, '', 1, 1, 1),
(2, 2, '1', 'Başakşehir Yenidoğu Okulları Lisesi', 'Başakşehir Yenidoğu Okulları Lisesi', 4, 'yenidogu-okullari', 5, 'Fatih Mahallesi, Çanakkale Şehitleri Caddesi, No:33, Büyükçekmece/istanbul', '', 'İstanbul', 41.002, 41.002, '', '0 212 963 2075', '', '<p><strong>Özel Başakşehir Yenidoğu Okulları Lisesi </strong>içindeki fiziksel özelliklerin Kapalı Spor Salonu, sanat atölyesi, bahçe, laboratuvar, oyun alanı, konferans salonu, müzik odası, kütüphane, 3d odası, yemekhane, akıllı tahta olduğunu görüyoruz. İngilizce eğitimi tek verilen dil eğitimdir. Dini Eğitim, servis, rehberlik, kantin hizmetleri kurumun faydaları arasındadır. Okuldaki iki kulüp arasında Akıl ve Zeka Oyunları ve yabancı dil kulübü bulunmaktadır.</p>\r\n', 'Cevap 1', 'Cevap 2', 'Cevap 3', 1, '40,41,14,8,37', '', 1, '', 1, 1, 1),
(2, 3, '1', '', '', 0, '', 5, 'Fatih Mahallesi, Çanakkale Şehitleri Caddesi, No:33, Büyükçekmece/istanbul', '', '', 41.002, 41.002, '', '0 212 963 2075', '', '', '', '', '', 0, '8,14,37', '', 1, '', 1, 1, 1),
(2, 4, '1', 'Başakşehir Yenidoğu Okulları Lisesi', 'Başakşehir Yenidoğu Okulları Lisesi', 4, 'yenidogu-okullari', 5, 'Fatih Mahallesi, Çanakkale Şehitleri Caddesi, No:33, Büyükçekmece/istanbul', 'Esenler', 'İstanbul', 41.002, 41.002, '', '0 212 963 2075', '', '<p><strong>Özel Başakşehir Yenidoğu Okulları Lisesi </strong>içindeki fiziksel özelliklerin Kapalı Spor Salonu, sanat atölyesi, bahçe, laboratuvar, oyun alanı, konferans salonu, müzik odası, kütüphane, 3d odası, yemekhane, akıllı tahta olduğunu görüyoruz. İngilizce eğitimi tek verilen dil eğitimdir. Dini Eğitim, servis, rehberlik, kantin hizmetleri kurumun faydaları arasındadır. Okuldaki iki kulüp arasında Akıl ve Zeka Oyunları ve yabancı dil kulübü bulunmaktadır.</p>\r\n', 'Cevap 1', 'Cevap 2', 'Cevap 3', 1, '40,41,14,8,37', '', 1, '', 1, 1, 1),
(3, 1, '1', '', '', 0, '', 4, 'Çiftehavuzlar Mah. Eski Lonfra Asfaltı Cd.', '', '', 54, 789, 'vhmb@gşna.com', '6587989*8079867', 'rgthyjguh', '', '', '', '', 0, '2,3,4,5,39,6,7,8,9,34,35,10,11,12,13,33,14,15,1,36,16,17,18,19,20,21,22,37,38,23,24,25,26,27,28,29,30,31,32', '', 1, 'tsevindik@gmail.com', 0, 1, 2),
(3, 2, '1', 'tuncay', 'dfgdfg', 3, 'dfgdfgdfg', 4, 'Çiftehavuzlar Mah. Eski Lonfra Asfaltı Cd.', '', 'İstanbul', 54, 789, 'deneme@gmail.com', '6587989*8079867', 'rgthyjguh', '<p>dfhjkljşk</p>\r\n', '', '', '', 0, '9,34,35,3,21,28,11,22,38,24,27,20,31,25,14,6,30,1,16,33,8,26,12,10,19,37,18,29,23,32,7', '', 1, '', 1, 1, 2),
(3, 3, '1', '', '', 0, '', 4, 'Çiftehavuzlar Mah. Eski Lonfra Asfaltı Cd.', '', '', 54, 789, 'vhmb@gşna.com', '6587989*8079867', 'rgthyjguh', '', '', '', '', 0, '2,3,4,5,39,6,7,8,9,34,35,10,11,12,13,33,14,15,1,36,16,17,18,19,20,21,22,37,38,23,24,25,26,27,28,29,30,31,32', '', 1, 'tsevindik@gmail.com', 0, 1, 2),
(3, 4, '1', 'Özel Altınay Koleji Ortaokulu', 'Özel Altınay Koleji Ortaokulu', 3, 'altunaykoleji', 4, 'Çiftehavuzlar Mah. Eski Lonfra Asfaltı Cd.', 'Sultanbeyli', 'İstanbul', 54, 789, 'deneme@gmail.com', '6587989*8079867', 'rgthyjguh', '<p><strong>Özel Altınay Koleji Ortaokulu </strong>içindeki fiziksel özelliklerin Kapalı Spor Salonu, sanat atölyesi, bahçe, laboratuvar, oyun alanı, konferans salonu, müzik odası, kütüphane, 3d odası, yemekhane, akıllı tahta olduğunu görüyoruz. İngilizce eğitimi tek verilen dil eğitimdir. Dini Eğitim, servis, rehberlik, kantin hizmetleri kurumun faydaları arasındadır. Okuldaki iki kulüp arasında Akıl ve Zeka Oyunları ve yabancı dil kulübü bulunmaktadır.</p>\r\n', '', '', '', 0, '9,34,35,3,21,28,11,22,38,24,27,20,31,25,14,6,30,1,16,33,8,26,12,10,19,37,18,29,23,32,7', '', 1, '', 1, 1, 2),
(4, 2, '1', '', '', 4, '', 0, 'Hürriyet Mah. Mahmutbey Yolu Cad', '', 'İstanbul', 41.04732, 29.177099, '', '', '', '', '', '', '', 1, '9,48,34,51,35,50,3,21,40,28,11,22,38,44,52,24,49,27,45,20,31,25,41,14,53,54,6,42,29,23,32,47,7', '', 1, '', 1, 1, 3),
(4, 4, '1', 'Özel Bağcılar Yeniay Okulları Anadolu Lisesi', 'Özel Bağcılar Yeniay Okulları Anadolu Lisesi', 4, 'yeniay-okullari', 0, 'Hürriyet Mah. Mahmutbey Yolu Cad', 'Bağcılar', 'İstanbul', 41.04732, 29.177099, '', '', '', '<p><strong>Özel Bağcılar Yeniay Okulları Anadolu Lisesi </strong>içindeki fiziksel özelliklerin Kapalı Spor Salonu, sanat atölyesi, bahçe, laboratuvar, oyun alanı, konferans salonu, müzik odası, kütüphane, 3d odası, yemekhane, akıllı tahta olduğunu görüyoruz. İngilizce eğitimi tek verilen dil eğitimdir. Dini Eğitim, servis, rehberlik, kantin hizmetleri kurumun faydaları arasındadır. Okuldaki iki kulüp arasında Akıl ve Zeka Oyunları ve yabancı dil kulübü bulunmaktadır.</p>\r\n', '', '', '', 1, '9,48,34,51,35,50,3,21,40,28,11,22,38,44,52,24,49,27,45,20,31,25,41,14,53,54,6,42,29,23,32,47,7', '', 1, '', 1, 1, 3),
(5, 2, '1', '', '', 1, '', 0, 'Soğukkuyu Mah. 12.güneş Sk. No:12, Osmangazi/bursa', '', 'Bursa', 41.04732, 29.177099, '', '', '', '', '', '', '', 0, '9,48,34,51,35,50,3,21,40,28,11,22,38,44,52,24,49,27,45,20,31,25,41,14,53,54,6,30,1,16,33,8,26,12,10,19,46,43,37,18,42,29,23', '', 4, '', 1, 1, 4),
(5, 4, '1', 'Özel Bursa Neşeli Günler Anaokulu', 'Özel Bursa Neşeli Günler Anaokulu', 1, 'neseli-gunler-anaokulu', 0, 'Soğukkuyu Mah. 12.güneş Sk. No:12, Osmangazi/bursa', 'Osmangazi', 'Bursa', 41.04732, 29.177099, '', '', '', '<p><strong>Özel Bursa Neşeli Günler Anaokulu </strong>içindeki fiziksel özelliklerin Kapalı Spor Salonu, sanat atölyesi, bahçe, laboratuvar, oyun alanı, konferans salonu, müzik odası, kütüphane, 3d odası, yemekhane, akıllı tahta olduğunu görüyoruz. İngilizce eğitimi tek verilen dil eğitimdir. Dini Eğitim, servis, rehberlik, kantin hizmetleri kurumun faydaları arasındadır. Okuldaki iki kulüp arasında Akıl ve Zeka Oyunları ve yabancı dil kulübü bulunmaktadır.</p>\r\n', '', '', '', 0, '9,48,34,51,35,50,3,21,40,28,11,22,38,44,52,24,49,27,45,20,31,25,41,14,53,54,6,30,1,16,33,8,26,12,10,19,46,43,37,18,42,29,23', '', 4, '', 1, 1, 4),
(6, 2, '1', '', '', 1, '', 0, 'Gazi Mahallesi Kemal Reis Caddesi No:34/a Gaziemir/izmir', '', 'İzmir', 41.04732, 29.177099, '', '', '', '', '', '', '', 0, '48,34,51,35,50,3,21,40,28,11,22,38,44,52,24,49,27,45,20,31,25,41,14,53,54,6,30', '', 3, '', 1, 1, 5),
(6, 4, '1', 'Özel Gaziemir Ataışığı Anaokulu', 'Özel Gaziemir Ataışığı Anaokulu', 1, 'gaziemir-anaokulu', 0, 'Gazi Mahallesi Kemal Reis Caddesi No:34/a Gaziemir/izmir', 'Gaziemir', 'İzmir', 41.04732, 29.177099, '', '', '', '<p><strong>Özel Gaziemir Ataışığı Anaokulu </strong>içindeki fiziksel özelliklerin Kapalı Spor Salonu, sanat atölyesi, bahçe, laboratuvar, oyun alanı, konferans salonu, müzik odası, kütüphane, 3d odası, yemekhane, akıllı tahta olduğunu görüyoruz. İngilizce eğitimi tek verilen dil eğitimdir. Dini Eğitim, servis, rehberlik, kantin hizmetleri kurumun faydaları arasındadır. Okuldaki iki kulüp arasında Akıl ve Zeka Oyunları ve yabancı dil kulübü bulunmaktadır.</p>\r\n', '', '', '', 0, '48,34,51,35,50,3,21,40,28,11,22,38,44,52,24,49,27,45,20,31,25,41,14,53,54,6,30', '', 3, '', 1, 1, 5),
(7, 2, '1', '', '', 4, '', 2, 'Çekmeköy/İstanbul', '', 'İstanbul', 41.04732, 29.177099, 'info@nisantasikoleji.com', '02124837480', 'nisantasikoleji.com', '', '', '', '', 1, '9,48,34,51,35,50,3,21,40,28,11,22,38,44,52,24,49,27,45,20,31,25,41,14,53,54,6,30,1,16,33,8,26,12,10,19,46,43,37,18,42,29,23,32,47', '', 1, '', 1, 1, 6),
(7, 4, '1', 'Nişantaşı Fen ve Teknoloji Kolejleri', 'Nişantaşı Fen ve Teknoloji Kolejleri', 4, 'nisantasi-koleji', 2, 'Çekmeköy/İstanbul', 'Çekmeköy', 'İstanbul', 41.04732, 29.177099, 'info@nisantasikoleji.com', '02124837480', 'nisantasikoleji.com', '<p><strong>Özel Nişantaşı Fen ve Teknoloji Kolejleri Anadolu Lisesi</strong>, Çekmeköy\'deki adresi ile geleceğe daha sağlıklı, bilinçli ve duyarlı bireyler yetiştirmeyi hedeflemektedir. Bu hedefleri doğrultusunda branşında uzman eğitmenlerden alınan destekler, zengin eğitim programları ve teknolojik eğitim alanları ile öğrencilere çağın gereksinimlerini en yüksek yeterlilikle paylaşmaktadır. Eğitim alanındaki yenilikçi anlayışı ile değişen ve gelişen dünyanın gerekliliklerini öğrencilere aktarmayı planlayan kurum, hazırladığı eğitim çalışmaları ile öğrencilerin her açıdan gelişimini destekleyerek hayata doğrudan katkı sağlayabilecek, nitelikli bireyler yetiştirmektedir.</p>\r\n', '', '', '', 1, '9,48,34,51,35,50,3,21,40,28,11,22,38,44,52,24,49,27,45,20,31,25,41,14,53,54,6,30,1,16,33,8,26,12,10,19,46,43,37,18,42,29,23,32,47', '', 1, '', 1, 1, 6),
(8, 2, '2', '', '', 2, '', 0, 'deneme', '', 'Ankara', 123, 123, '', '', '', '', 'Deneme', 'Deneme', 'Deneme', 1, '9,48,34,51,35,50,3,21,40,28,11,22,38,44,52,24,49,27,45,20,31,25,41,14,53,54,6,30,1,16,33,8,26,12,10,19,46,43,37,18,42', '', 4, '', 0, 0, 7),
(8, 4, '2', 'Kamer Koleji Ortaokul', 'Kamer Koleji Ortaokul', 2, 'kamerkolej', 0, 'deneme', 'Gölbaşı', 'Ankara', 123, 123, '', '', '', '<p>ssd</p>\r\n', 'Deneme', 'Deneme', 'Deneme', 1, '9,48,34,51,35,50,3,21,40,28,11,22,38,44,52,24,49,27,45,20,31,25,41,14,53,54,6,30,1,16,33,8,26,12,10,19,46,43,37,18,42', '', 4, '', 0, 0, 7),
(9, 2, '2', '', '', 1, '', 0, 'deneme', '', 'Gaziantep', 123, 123, '', '', '', '', '', '', '', 1, '51,35,50,3,21', '', 5, '', NULL, NULL, 8),
(9, 4, '2', 'Özel Üsküdar Üçpınar Anaokulu', 'Özel Üsküdar Üçpınar Anaokulu', 1, 'sssss', 0, 'deneme', 'Beylikdüzü', 'Gaziantep', 123, 123, '', '', '', '<p>ssssss</p>\r\n', '', '', '', 1, '51,35,50,3,21', '', 5, '', NULL, NULL, 8);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_hotel_file`
--

CREATE TABLE `pm_hotel_file` (
  `id` int(11) NOT NULL,
  `lang` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `home` int(11) DEFAULT 0,
  `checked` int(11) DEFAULT 1,
  `rank` int(11) DEFAULT 0,
  `file` varchar(250) DEFAULT NULL,
  `label` varchar(250) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `pm_hotel_file`
--

INSERT INTO `pm_hotel_file` (`id`, `lang`, `id_item`, `home`, `checked`, `rank`, `file`, `label`, `type`) VALUES
(3, 1, 2, NULL, 1, 2, 'img-8413.jpg', '', 'image'),
(3, 2, 2, NULL, 1, 2, 'img-8413.jpg', '', 'image'),
(3, 3, 2, NULL, 1, 2, 'img-8413.jpg', '', 'image'),
(3, 4, 2, NULL, 1, 2, 'img-8413.jpg', '', 'image'),
(4, 1, 2, NULL, 1, 3, 'img-8415.jpg', '', 'image'),
(4, 2, 2, NULL, 1, 3, 'img-8415.jpg', '', 'image'),
(4, 3, 2, NULL, 1, 3, 'img-8415.jpg', '', 'image'),
(4, 4, 2, NULL, 1, 3, 'img-8415.jpg', '', 'image'),
(5, 1, 3, NULL, 1, 4, 'indir.jpg', '', 'image'),
(5, 2, 3, NULL, 1, 4, 'indir.jpg', '', 'image'),
(5, 3, 3, NULL, 1, 4, 'indir.jpg', '', 'image'),
(5, 4, 3, NULL, 1, 4, 'indir.jpg', '', 'image'),
(6, 2, 4, NULL, 1, 5, 'ozel-edu-istanbul-kolejleri17.jpg', '', 'image'),
(6, 4, 4, NULL, 1, 5, 'ozel-edu-istanbul-kolejleri17.jpg', '', 'image'),
(7, 2, 5, NULL, 1, 6, 'ozel-neseli-gunler-anaokulu-02.jpg', '', 'image'),
(7, 4, 5, NULL, 1, 6, 'ozel-neseli-gunler-anaokulu-02.jpg', '', 'image'),
(8, 2, 6, NULL, 1, 7, 'ozel-ata-isigi-anaokulu-1.jpg', '', 'image'),
(8, 4, 6, NULL, 1, 7, 'ozel-ata-isigi-anaokulu-1.jpg', '', 'image'),
(15, 2, 2, NULL, 1, 14, 'blog3.png', '', 'image'),
(15, 4, 2, NULL, 1, 14, 'blog3.png', '', 'image'),
(16, 2, 2, NULL, 1, 15, 'blog3.jpg', '', 'image'),
(16, 4, 2, NULL, 1, 15, 'blog3.jpg', '', 'image'),
(17, 2, 2, NULL, 1, 16, 'nisantasi-1.jpg', '', 'image'),
(17, 4, 2, NULL, 1, 16, 'nisantasi-1.jpg', '', 'image'),
(18, 2, 2, NULL, 1, 17, 'bursa.jpg', '', 'image'),
(18, 4, 2, NULL, 1, 17, 'bursa.jpg', '', 'image'),
(19, 2, 2, NULL, 1, 18, 'page-header4.jpg', '', 'image'),
(19, 4, 2, NULL, 1, 18, 'page-header4.jpg', '', 'image'),
(20, 2, 3, NULL, 1, 19, 'header.png', '', 'image'),
(20, 4, 3, NULL, 1, 19, 'header.png', '', 'image'),
(21, 2, 3, NULL, 1, 20, 'bursa.jpg', '', 'image'),
(21, 4, 3, NULL, 1, 20, 'bursa.jpg', '', 'image'),
(22, 2, 3, NULL, 1, 21, 'bilim-akademi-koleji-1.jpg', '', 'image'),
(22, 4, 3, NULL, 1, 21, 'bilim-akademi-koleji-1.jpg', '', 'image'),
(23, 2, 3, NULL, 1, 22, 'blog3.jpg', '', 'image'),
(23, 4, 3, NULL, 1, 22, 'blog3.jpg', '', 'image'),
(24, 2, 3, NULL, 1, 23, 'blog3.png', '', 'image'),
(24, 4, 3, NULL, 1, 23, 'blog3.png', '', 'image'),
(25, 2, 3, NULL, 1, 24, 'kurumsal-blog-yonetimi.jpg', '', 'image'),
(25, 4, 3, NULL, 1, 24, 'kurumsal-blog-yonetimi.jpg', '', 'image'),
(26, 2, 7, NULL, 1, 3, '1500x400-school-header.png', '', 'image'),
(26, 4, 7, NULL, 1, 3, '1500x400-school-header.png', '', 'image'),
(27, 2, 7, NULL, 1, 4, 'blog3.png', '', 'image'),
(27, 4, 7, NULL, 1, 4, 'blog3.png', '', 'image'),
(28, 2, 7, NULL, 1, 5, 'blog3.jpg', '', 'image'),
(28, 4, 7, NULL, 1, 5, 'blog3.jpg', '', 'image'),
(29, 2, 7, NULL, 1, 6, 'indir.jpg', '', 'image'),
(29, 4, 7, NULL, 1, 6, 'indir.jpg', '', 'image'),
(30, 2, 7, NULL, 1, 7, 'bilim-akademi-koleji-1.jpg', '', 'image'),
(30, 4, 7, NULL, 1, 7, 'bilim-akademi-koleji-1.jpg', '', 'image'),
(31, 2, 7, NULL, 1, 8, 'bursa.jpg', '', 'image'),
(31, 4, 7, NULL, 1, 8, 'bursa.jpg', '', 'image'),
(32, 2, 7, NULL, 1, 2, 'nisantasi-1.jpg', '', 'image'),
(32, 4, 7, NULL, 1, 2, 'nisantasi-1.jpg', '', 'image'),
(33, 2, 7, NULL, 1, 1, 'ozel-nisantasi-fen-ve-teknoloji-anadolu-lisesi-1.jpg', '', 'image'),
(33, 4, 7, NULL, 1, 1, 'ozel-nisantasi-fen-ve-teknoloji-anadolu-lisesi-1.jpg', '', 'image'),
(34, 2, 8, NULL, 1, 25, '0x44b311i-1.jpg', '', 'image'),
(34, 4, 8, NULL, 1, 25, '0x44b311i-1.jpg', '', 'image'),
(35, 2, 8, NULL, 1, 26, 'education2.jpg', '', 'image'),
(35, 4, 8, NULL, 1, 26, 'education2.jpg', '', 'image'),
(36, 2, 8, NULL, 1, 27, 'education5.jpeg', '', 'image'),
(36, 4, 8, NULL, 1, 27, 'education5.jpeg', '', 'image'),
(37, 2, 8, NULL, 1, 28, 'education4.jpg', '', 'image'),
(37, 4, 8, NULL, 1, 28, 'education4.jpg', '', 'image'),
(38, 2, 8, NULL, 1, 29, 'education.jpeg', '', 'image'),
(38, 4, 8, NULL, 1, 29, 'education.jpeg', '', 'image'),
(39, 2, 8, NULL, 1, 30, 'education3.jpeg', '', 'image'),
(39, 4, 8, NULL, 1, 30, 'education3.jpeg', '', 'image'),
(40, 2, 4, NULL, 1, 31, 'education5.jpeg', NULL, 'image'),
(40, 4, 4, NULL, 1, 31, 'education5.jpeg', NULL, 'image'),
(41, 2, 4, NULL, 1, 32, 'education4.jpg', NULL, 'image'),
(41, 4, 4, NULL, 1, 32, 'education4.jpg', NULL, 'image'),
(42, 2, 4, NULL, 1, 33, 'education2.jpg', NULL, 'image'),
(42, 4, 4, NULL, 1, 33, 'education2.jpg', NULL, 'image'),
(43, 2, 4, NULL, 1, 34, 'education3.jpeg', NULL, 'image'),
(43, 4, 4, NULL, 1, 34, 'education3.jpeg', NULL, 'image'),
(44, 2, 5, NULL, 1, 35, 'education3.jpeg', '', 'image'),
(44, 4, 5, NULL, 1, 35, 'education3.jpeg', '', 'image'),
(45, 2, 5, NULL, 1, 36, 'education4.jpg', '', 'image'),
(45, 4, 5, NULL, 1, 36, 'education4.jpg', '', 'image'),
(46, 2, 5, NULL, 1, 37, 'education2.jpg', '', 'image'),
(46, 4, 5, NULL, 1, 37, 'education2.jpg', '', 'image'),
(47, 2, 5, NULL, 1, 38, 'education5.jpeg', '', 'image'),
(47, 4, 5, NULL, 1, 38, 'education5.jpeg', '', 'image'),
(48, 2, 6, NULL, 1, 39, 'education5.jpeg', '', 'image'),
(48, 4, 6, NULL, 1, 39, 'education5.jpeg', '', 'image'),
(49, 2, 6, NULL, 1, 40, 'education4.jpg', '', 'image'),
(49, 4, 6, NULL, 1, 40, 'education4.jpg', '', 'image'),
(50, 2, 6, NULL, 1, 41, 'education3.jpeg', '', 'image'),
(50, 4, 6, NULL, 1, 41, 'education3.jpeg', '', 'image'),
(51, 2, 6, NULL, 1, 42, 'education2.jpg', '', 'image'),
(51, 4, 6, NULL, 1, 42, 'education2.jpg', '', 'image'),
(52, 2, 5, NULL, 1, 43, 'igame14-1.jpg', '', 'image'),
(52, 4, 5, NULL, 1, 43, 'igame14-1.jpg', '', 'image'),
(53, 2, 6, NULL, 1, 44, 'igame14-1.jpg', '', 'image'),
(53, 4, 6, NULL, 1, 44, 'igame14-1.jpg', '', 'image');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_ical_event`
--

CREATE TABLE `pm_ical_event` (
  `id` int(11) NOT NULL,
  `id_room` int(11) NOT NULL,
  `title` varchar(150) DEFAULT NULL,
  `sync_date` int(11) DEFAULT NULL,
  `from_date` int(11) DEFAULT NULL,
  `to_date` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_lang`
--

CREATE TABLE `pm_lang` (
  `id` int(11) NOT NULL,
  `title` varchar(20) DEFAULT NULL,
  `locale` varchar(20) DEFAULT NULL,
  `main` int(11) DEFAULT 0,
  `checked` int(11) DEFAULT 0,
  `rank` int(11) DEFAULT 0,
  `tag` varchar(20) DEFAULT NULL,
  `rtl` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `pm_lang`
--

INSERT INTO `pm_lang` (`id`, `title`, `locale`, `main`, `checked`, `rank`, `tag`, `rtl`) VALUES
(1, 'Français', 'fr_FR', 0, 0, 2, 'fr', 0),
(2, 'English', 'en_GB', 0, 2, 1, 'en', 0),
(3, 'عربي', 'ar_MA', 0, 0, 3, 'ar', 1),
(4, 'Türkçe', 'tr_TR', 1, 1, 4, 'tr', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_lang_file`
--

CREATE TABLE `pm_lang_file` (
  `id` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `home` int(11) DEFAULT 0,
  `checked` int(11) DEFAULT 1,
  `rank` int(11) DEFAULT 0,
  `file` varchar(250) DEFAULT NULL,
  `label` varchar(250) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `pm_lang_file`
--

INSERT INTO `pm_lang_file` (`id`, `id_item`, `home`, `checked`, `rank`, `file`, `label`, `type`) VALUES
(1, 1, 0, 1, 2, 'fr.png', '', 'image'),
(2, 2, 0, 1, 1, 'gb.png', '', 'image'),
(3, 3, 0, 1, 3, 'ar.png', '', 'image'),
(4, 4, NULL, 1, 4, 'turk-bayraklari.png', '', 'image');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_location`
--

CREATE TABLE `pm_location` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `checked` int(11) DEFAULT 0,
  `pages` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `pm_location`
--

INSERT INTO `pm_location` (`id`, `name`, `address`, `lat`, `lng`, `checked`, `pages`) VALUES
(1, 'Panda Multi Resorts', 'Maldives Mint, Neeloafaru Magu 20014, Maldives', 4.174411, 73.517851, 1, '2');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_media`
--

CREATE TABLE `pm_media` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_media_file`
--

CREATE TABLE `pm_media_file` (
  `id` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `home` int(11) DEFAULT 0,
  `checked` int(11) DEFAULT 1,
  `rank` int(11) DEFAULT 0,
  `file` varchar(250) DEFAULT NULL,
  `label` varchar(250) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_menu`
--

CREATE TABLE `pm_menu` (
  `id` int(11) NOT NULL,
  `lang` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `id_parent` int(11) DEFAULT NULL,
  `item_type` varchar(30) DEFAULT NULL,
  `id_item` int(11) DEFAULT NULL,
  `url` text DEFAULT NULL,
  `main` int(11) DEFAULT 1,
  `footer` int(11) DEFAULT 0,
  `checked` int(11) DEFAULT 0,
  `rank` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `pm_menu`
--

INSERT INTO `pm_menu` (`id`, `lang`, `name`, `title`, `id_parent`, `item_type`, `id_item`, `url`, `main`, `footer`, `checked`, `rank`) VALUES
(1, 1, 'Accueil', 'Lorem ipsum dolor sit amet', NULL, 'page', 1, '', 1, 0, 1, 1),
(1, 2, 'Anasayfa', 'Okul Rezervasyon', NULL, 'page', 1, '', 1, 0, 1, 1),
(1, 3, 'ترحيب', 'هو سقطت الساحلية ذات, أن.', NULL, 'page', 1, '', 1, 0, 1, 1),
(1, 4, 'Anasayfa', 'Okul Rezervasyon', NULL, 'page', 1, '', 1, 0, 1, 1),
(2, 1, 'Contact', 'Contact', NULL, 'page', 2, '', 1, 1, 1, 9),
(2, 2, 'İletişim', 'İletişim', NULL, 'page', 2, '', 1, 1, 1, 9),
(2, 3, 'جهة الاتصال', 'جهة الاتصال', NULL, 'page', 2, '', 1, 1, 1, 9),
(2, 4, 'İletişim', 'İletişim', NULL, 'page', 2, '', 1, 1, 1, 9),
(3, 1, 'Mentions légales', 'Mentions légales', NULL, 'page', 3, '', 0, 0, 1, 10),
(3, 2, 'Yasal Uyarılar', 'Yasal Uyarılar', NULL, 'page', 3, '', 0, 0, 1, 10),
(3, 3, 'يذكر القانونية', 'يذكر القانونية', NULL, 'page', 3, '', 0, 0, 1, 10),
(3, 4, 'Yasal Uyarılar', 'Yasal Uyarılar', NULL, 'page', 3, '', 0, 0, 1, 10),
(4, 1, 'Plan du site', 'Plan du site', NULL, 'page', 4, '', 0, 0, 1, 11),
(4, 2, 'Sitemap', 'Sitemap', NULL, 'page', 4, '', 0, 0, 1, 11),
(4, 3, 'خريطة الموقع', 'خريطة الموقع', NULL, 'page', 4, '', 0, 0, 1, 11),
(4, 4, 'Sitemap', 'Sitemap', NULL, 'page', 4, '', 0, 0, 1, 11),
(5, 1, 'Qui sommes-nous ?', 'Qui sommes-nous ?', NULL, 'page', 5, '', 1, 0, 1, 2),
(5, 2, 'Hakkımızda', 'Hakkımızda', NULL, 'page', 5, '', 1, 1, 1, 2),
(5, 3, 'معلومات عنا', 'معلومات عنا', NULL, 'page', 5, '', 1, 0, 1, 2),
(5, 4, 'Hakkımızda', 'Hakkımızda', NULL, 'page', 5, '', 1, 1, 1, 2),
(6, 1, 'Galerie', 'Galerie', NULL, 'page', 7, '', 0, 0, 1, 4),
(6, 2, 'Gallery', 'Gallery', NULL, 'page', 7, '', 0, 0, 1, 4),
(6, 3, 'صور معرض', 'صور معرض', NULL, 'page', 7, '', 0, 0, 1, 4),
(6, 4, 'Galeri', 'Galeri', NULL, 'page', 7, '', 0, 0, 1, 4),
(7, 1, 'Hôtels', 'Hôtels', NULL, 'page', 9, '', 1, 0, 1, 3),
(7, 2, 'Okullar', 'Okullar', NULL, 'page', 9, '', 1, 1, 1, 3),
(7, 3, 'الفنادق', 'الفنادق', NULL, 'page', 9, '', 1, 0, 1, 3),
(7, 4, 'Kurs Merkezleri', 'Kurs Merkezleri', NULL, 'page', 9, '', 1, 1, 1, 3),
(8, 1, 'Réserver', 'Réserver', NULL, 'page', 10, '', 1, 0, 1, 5),
(8, 2, 'Rezervasyon', 'Rezervasyon', NULL, 'page', 10, '', 1, 0, 1, 5),
(8, 3, 'الحجز', 'الحجز', NULL, 'page', 10, '', 1, 0, 1, 5),
(8, 4, 'Rezervasyon', 'Rezervasyon', NULL, 'page', 10, '', 1, 0, 1, 5),
(9, 1, 'Activités', 'Activités', NULL, 'page', 16, '', 0, 0, 1, 4),
(9, 2, 'Activities', 'Activities', NULL, 'page', 16, '', 0, 0, 1, 4),
(9, 3, 'Activities', 'Activities', NULL, 'page', 16, '', 0, 0, 1, 4),
(9, 4, 'Aktiviteler', 'Aktiviteler', NULL, 'page', 16, '', 0, 0, 1, 4),
(10, 1, 'Destinations', '', NULL, 'page', 18, '', 1, 0, 1, 4),
(10, 2, 'Şehirler', 'Şehirler', NULL, 'page', 18, '', 1, 0, 1, 4),
(10, 3, 'وجهات', '', NULL, 'page', 18, '', 1, 0, 1, 4),
(10, 4, 'Şehirler', 'Şehirler', NULL, 'page', 18, '', 1, 0, 1, 4);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_message`
--

CREATE TABLE `pm_message` (
  `id` int(11) NOT NULL,
  `add_date` int(11) DEFAULT NULL,
  `edit_date` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `subject` varchar(250) DEFAULT NULL,
  `msg` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `pm_message`
--

INSERT INTO `pm_message` (`id`, `add_date`, `edit_date`, `name`, `email`, `address`, `phone`, `subject`, `msg`) VALUES
(1, 1594914825, NULL, 'Eric', 'eric@talkwithwebvisitor.com', 'Hey, this is Eric and I ran across teknolojiatolyeleri.xyz a few minutes ago.\r\n\r\nLooks great… but now what?\r\n\r\nBy that I mean, when someone like me finds your website – either through Search or just bouncing around – what happens next?  Do you get a lot of leads from your site, or at least enough to make you happy?\r\n\r\nHonestly, most business websites fall a bit short when it comes to generating paying customers. Studies show that 70% of a site’s visitors disappear and are gone forever after just a moment.\r\n\r\nHere’s an idea…\r\n \r\nHow about making it really EASY for every visitor who shows up to get a personal phone call you as soon as they hit your site…\r\n \r\nYou can –\r\n  \r\nTalk With Web Visitor is a software widget that’s works on your site, ready to capture any visitor’s Name, Email address and Phone Number.  It signals you the moment they let you know they’re interested – so that you can talk to that lead while they’re literally looking over your site.\r\n\r\nCLICK HERE http://www.talkwithwebvisitor.com to try out a Live Demo with Talk With Web Visitor now to see exactly how it works.\r\n\r\nYou’ll be amazed - the difference between contacting someone within 5 minutes versus a half-hour or more later could increase your results 100-fold.\r\n\r\nIt gets even better… once you’ve captured their phone number, with our new SMS Text With Lead feature, you can automatically start a text (SMS) conversation.\r\n  \r\nThat way, even if you don’t close a deal right away, you can follow up with text messages for new offers, content links, even just “how you doing?” notes to build a relationship.\r\n\r\nPretty sweet – AND effective.\r\n\r\nCLICK HERE http://www.talkwithwebvisitor.com to discover what Talk With Web Visitor can do for your business.\r\n\r\nYou could be converting up to 100X more leads today!\r\n\r\nEric\r\nPS: Talk With Web Visitor offers a FREE 14 days trial – and it even includes International Long Distance Calling. \r\nYou have customers waiting to talk with you right now… don’t keep them waiting. \r\nCLICK HERE http://www.talkwithwebvisitor.com to try Talk With Web Visitor now.\r\n\r\nIf you\'d like to unsubscribe click here http://talkwithwebvisitor.com/unsubscribe.aspx?d=teknolojiatolyeleri.xyz\r\n', '416-385-3200', 'Your site – more leads?', 'Hey, this is Eric and I ran across teknolojiatolyeleri.xyz a few minutes ago.\r\n\r\nLooks great… but now what?\r\n\r\nBy that I mean, when someone like me finds your website – either through Search or just bouncing around – what happens next?  Do you get a lot of leads from your site, or at least enough to make you happy?\r\n\r\nHonestly, most business websites fall a bit short when it comes to generating paying customers. Studies show that 70% of a site’s visitors disappear and are gone forever after just a moment.\r\n\r\nHere’s an idea…\r\n \r\nHow about making it really EASY for every visitor who shows up to get a personal phone call you as soon as they hit your site…\r\n \r\nYou can –\r\n  \r\nTalk With Web Visitor is a software widget that’s works on your site, ready to capture any visitor’s Name, Email address and Phone Number.  It signals you the moment they let you know they’re interested – so that you can talk to that lead while they’re literally looking over your site.\r\n\r\nCLICK HERE http://www.talkwithwebvisitor.com to try out a Live Demo with Talk With Web Visitor now to see exactly how it works.\r\n\r\nYou’ll be amazed - the difference between contacting someone within 5 minutes versus a half-hour or more later could increase your results 100-fold.\r\n\r\nIt gets even better… once you’ve captured their phone number, with our new SMS Text With Lead feature, you can automatically start a text (SMS) conversation.\r\n  \r\nThat way, even if you don’t close a deal right away, you can follow up with text messages for new offers, content links, even just “how you doing?” notes to build a relationship.\r\n\r\nPretty sweet – AND effective.\r\n\r\nCLICK HERE http://www.talkwithwebvisitor.com to discover what Talk With Web Visitor can do for your business.\r\n\r\nYou could be converting up to 100X more leads today!\r\n\r\nEric\r\nPS: Talk With Web Visitor offers a FREE 14 days trial – and it even includes International Long Distance Calling. \r\nYou have customers waiting to talk with you right now… don’t keep them waiting. \r\nCLICK HERE http://www.talkwithwebvisitor.com to try Talk With Web Visitor now.\r\n\r\nIf you\'d like to unsubscribe click here http://talkwithwebvisitor.com/unsubscribe.aspx?d=teknolojiatolyeleri.xyz\r\n'),
(2, 1595202574, NULL, 'Eric', 'eric@talkwithwebvisitor.com', 'Cool website!\r\n\r\nMy name’s Eric, and I just found your site - teknolojiatolyeleri.xyz - while surfing the net. You showed up at the top of the search results, so I checked you out. Looks like what you’re doing is pretty cool.\r\n \r\nBut if you don’t mind me asking – after someone like me stumbles across teknolojiatolyeleri.xyz, what usually happens?\r\n\r\nIs your site generating leads for your business? \r\n \r\nI’m guessing some, but I also bet you’d like more… studies show that 7 out 10 who land on a site wind up leaving without a trace.\r\n\r\nNot good.\r\n\r\nHere’s a thought – what if there was an easy way for every visitor to “raise their hand” to get a phone call from you INSTANTLY… the second they hit your site and said, “call me now.”\r\n\r\nYou can –\r\n  \r\nTalk With Web Visitor is a software widget that’s works on your site, ready to capture any visitor’s Name, Email address and Phone Number.  It lets you know IMMEDIATELY – so that you can talk to that lead while they’re literally looking over your site.\r\n\r\nCLICK HERE http://www.talkwithwebvisitor.com to try out a Live Demo with Talk With Web Visitor now to see exactly how it works.\r\n\r\nTime is money when it comes to connecting with leads – the difference between contacting someone within 5 minutes versus 30 minutes later can be huge – like 100 times better!\r\n\r\nThat’s why we built out our new SMS Text With Lead feature… because once you’ve captured the visitor’s phone number, you can automatically start a text message (SMS) conversation.\r\n  \r\nThink about the possibilities – even if you don’t close a deal then and there, you can follow up with text messages for new offers, content links, even just “how you doing?” notes to build a relationship.\r\n\r\nWouldn’t that be cool?\r\n\r\nCLICK HERE http://www.talkwithwebvisitor.com to discover what Talk With Web Visitor can do for your business.\r\n\r\nYou could be converting up to 100X more leads today!\r\nEric\r\n\r\nPS: Talk With Web Visitor offers a FREE 14 days trial – and it even includes International Long Distance Calling. \r\nYou have customers waiting to talk with you right now… don’t keep them waiting. \r\nCLICK HERE http://www.talkwithwebvisitor.com to try Talk With Web Visitor now.\r\n\r\nIf you\'d like to unsubscribe click here http://talkwithwebvisitor.com/unsubscribe.aspx?d=teknolojiatolyeleri.xyz\r\n', '416-385-3200', 'Cool website!', 'Cool website!\r\n\r\nMy name’s Eric, and I just found your site - teknolojiatolyeleri.xyz - while surfing the net. You showed up at the top of the search results, so I checked you out. Looks like what you’re doing is pretty cool.\r\n \r\nBut if you don’t mind me asking – after someone like me stumbles across teknolojiatolyeleri.xyz, what usually happens?\r\n\r\nIs your site generating leads for your business? \r\n \r\nI’m guessing some, but I also bet you’d like more… studies show that 7 out 10 who land on a site wind up leaving without a trace.\r\n\r\nNot good.\r\n\r\nHere’s a thought – what if there was an easy way for every visitor to “raise their hand” to get a phone call from you INSTANTLY… the second they hit your site and said, “call me now.”\r\n\r\nYou can –\r\n  \r\nTalk With Web Visitor is a software widget that’s works on your site, ready to capture any visitor’s Name, Email address and Phone Number.  It lets you know IMMEDIATELY – so that you can talk to that lead while they’re literally looking over your site.\r\n\r\nCLICK HERE http://www.talkwithwebvisitor.com to try out a Live Demo with Talk With Web Visitor now to see exactly how it works.\r\n\r\nTime is money when it comes to connecting with leads – the difference between contacting someone within 5 minutes versus 30 minutes later can be huge – like 100 times better!\r\n\r\nThat’s why we built out our new SMS Text With Lead feature… because once you’ve captured the visitor’s phone number, you can automatically start a text message (SMS) conversation.\r\n  \r\nThink about the possibilities – even if you don’t close a deal then and there, you can follow up with text messages for new offers, content links, even just “how you doing?” notes to build a relationship.\r\n\r\nWouldn’t that be cool?\r\n\r\nCLICK HERE http://www.talkwithwebvisitor.com to discover what Talk With Web Visitor can do for your business.\r\n\r\nYou could be converting up to 100X more leads today!\r\nEric\r\n\r\nPS: Talk With Web Visitor offers a FREE 14 days trial – and it even includes International Long Distance Calling. \r\nYou have customers waiting to talk with you right now… don’t keep them waiting. \r\nCLICK HERE http://www.talkwithwebvisitor.com to try Talk With Web Visitor now.\r\n\r\nIf you\'d like to unsubscribe click here http://talkwithwebvisitor.com/unsubscribe.aspx?d=teknolojiatolyeleri.xyz\r\n'),
(6, 1600417869, NULL, 'Ian Lewis', 'kuxoxyk@mailinator.com', NULL, NULL, 'Facere et odio volup', 'Vel odio Nam impedit'),
(7, 1600418342, NULL, 'Kareem Holder', 'wabylodaco@mailinator.net', NULL, NULL, 'Officia dolore illo ', 'Amet dolor ut verit'),
(8, 1600419259, NULL, 'Hu Larson', 'notuzy@mailinator.com', NULL, NULL, 'Quam incididunt quas', 'Magna pariatur In d'),
(9, 1600419622, NULL, 'Benedict Gallegos', 'micy@mailinator.net', NULL, NULL, 'Velit et distinctio', 'Aut soluta velit a q');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_package`
--

CREATE TABLE `pm_package` (
  `id` int(11) NOT NULL,
  `users` text DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `days` text DEFAULT NULL,
  `min_nights` int(11) DEFAULT NULL,
  `max_nights` int(11) DEFAULT NULL,
  `day_start` int(11) DEFAULT NULL,
  `day_end` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `pm_package`
--

INSERT INTO `pm_package` (`id`, `users`, `name`, `days`, `min_nights`, `max_nights`, `day_start`, `day_end`) VALUES
(1, '1', 'Week-end', '5,6,7', 0, 0, NULL, NULL),
(2, '1', 'Night', '1,2,3,4,5,6,7', 1, 0, NULL, NULL),
(3, '1', 'Mid-week', '1,2,3,4,5', 3, 4, NULL, NULL),
(4, '1', '2 nights', '1,2,3,4', 2, 2, NULL, NULL),
(6, '1', 'Week', '1,2,3,4,5,6,7', 7, 0, NULL, NULL),
(7, '1', 'Yıllık', '1,2,3,4,5,6,7', 1, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_page`
--

CREATE TABLE `pm_page` (
  `id` int(11) NOT NULL,
  `lang` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `subtitle` varchar(250) DEFAULT NULL,
  `title_tag` varchar(250) DEFAULT NULL,
  `alias` varchar(100) DEFAULT NULL,
  `descr` longtext DEFAULT NULL,
  `robots` varchar(20) DEFAULT NULL,
  `keywords` varchar(250) DEFAULT NULL,
  `intro` longtext DEFAULT NULL,
  `text` longtext DEFAULT NULL,
  `id_parent` int(11) DEFAULT NULL,
  `page_model` varchar(50) DEFAULT NULL,
  `article_model` varchar(50) DEFAULT NULL,
  `home` int(11) DEFAULT 0,
  `checked` int(11) DEFAULT 0,
  `rank` int(11) DEFAULT 0,
  `add_date` int(11) DEFAULT NULL,
  `edit_date` int(11) DEFAULT NULL,
  `comment` int(11) DEFAULT 0,
  `rating` int(11) DEFAULT 0,
  `system` int(11) DEFAULT 0,
  `show_langs` text DEFAULT NULL,
  `hide_langs` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `pm_page`
--

INSERT INTO `pm_page` (`id`, `lang`, `name`, `title`, `subtitle`, `title_tag`, `alias`, `descr`, `robots`, `keywords`, `intro`, `text`, `id_parent`, `page_model`, `article_model`, `home`, `checked`, `rank`, `add_date`, `edit_date`, `comment`, `rating`, `system`, `show_langs`, `hide_langs`) VALUES
(1, 1, 'Accueil', 'Lorem ipsum dolor sit amet', 'Consectetur adipiscing elit', 'Accueil', '', '', 'index,follow', '', '', '', NULL, 'home', '', 1, 1, 1, 1594811112, 1594900862, 0, 0, 0, '', ''),
(1, 2, 'Anasayfa', 'Okul Rezervasyon', '', 'Türkiye\'deki bütün okulların fiyatlarını sizler için listeledik', '', '', 'index,follow', '', '', '<blockquote class=\"text-center\">\r\n<p>Binlerce okulun özelliklerini karşılaştırabilir, fiyatlarını inceleyebilirsiniz. Okuluna karar vermeden önce mutlaka bakmalısınız.</p>\r\n</blockquote>\r\n\r\n<p class=\"text-muted\" style=\"text-align: center;\"> </p>\r\n', NULL, 'home', '', 1, 1, 1, 1594811112, 1594900862, 0, 0, 0, '', ''),
(1, 3, 'ترحيب', 'هو سقطت الساحلية ذات, أن.', 'غير بمعارضة وهولندا، الإقتصادية قد, فقد الفرنسي المعاهدات قد من.', 'ترحيب', '', '', 'index,follow', '', '', '', NULL, 'home', '', 1, 1, 1, 1594811112, 1594900862, 0, 0, 0, '', ''),
(1, 4, 'Anasayfa', 'Okul Rezervasyon', '', 'Türkiye\'deki bütün kurs merkezlerinin fiyatlarını sizler için listeledik', '', '', 'index,follow', '', '', '<blockquote class=\"text-center\">\r\n<p>Binlerce okulun özelliklerini karşılaştırabilir, fiyatlarını inceleyebilirsiniz. Okuluna karar vermeden önce mutlaka bakmalısınız.</p>\r\n</blockquote>\r\n', NULL, 'home', '', 1, 1, 1, 1594811112, 1602145610, 0, 0, 0, '', ''),
(2, 1, 'Contact', 'Contact', '', 'Contact', 'contact', '', 'index,follow', '', '', '', NULL, 'contact', '', 0, 1, 11, 0, 0, 0, 0, 0, NULL, NULL),
(2, 2, 'Contact', 'Contact', '', 'Contact', 'contact', '', 'index,follow', '', '', '', NULL, 'contact', '', 0, 1, 11, 1594990960, 1594990960, 0, 0, 0, '', ''),
(2, 3, 'جهة الاتصال', 'جهة الاتصال', '', 'جهة الاتصال', 'contact', '', 'index,follow', '', '', '', NULL, 'contact', '', 0, 1, 11, 0, 0, 0, 0, 0, NULL, NULL),
(2, 4, 'İletişim', 'İletişim', '', 'İletişim', 'iletisim', '', 'index,follow', '', '', '', NULL, 'contact', '', 0, 1, 11, 1594990960, 1594990960, 0, 0, 0, '', ''),
(3, 1, 'Mentions légales', 'Mentions légales', '', 'Mentions légales', 'mentions-legales', '', 'index,follow', '', '', '', NULL, 'page', '', 0, 1, 12, 0, 0, 0, 0, 0, NULL, NULL),
(3, 2, 'Legal notices', 'Legal notices', '', 'Legal notices', 'legal-notices', '', 'index,follow', '', '', '', NULL, 'page', '', 0, 1, 12, 0, 0, 0, 0, 0, NULL, NULL),
(3, 3, 'يذكر القانونية', 'يذكر القانونية', '', 'يذكر القانونية', 'legal-notices', '', 'index,follow', '', '', '', NULL, 'page', '', 0, 1, 12, 0, 0, 0, 0, 0, NULL, NULL),
(3, 4, 'Legal notices', 'Legal notices', '', 'Legal notices', 'legal-notices', '', 'index,follow', '', '', '', NULL, 'page', '', 0, 1, 12, 0, 0, 0, 0, 0, NULL, NULL),
(4, 1, 'Plan du site', 'Plan du site', '', 'Plan du site', 'plan-site', '', 'index,follow', '', '', '', NULL, 'sitemap', '', 0, 1, 13, 0, 0, 0, 0, 0, NULL, NULL),
(4, 2, 'Sitemap', 'Sitemap', '', 'Sitemap', 'sitemap', '', 'index,follow', '', '', '', NULL, 'sitemap', '', 0, 1, 13, 0, 0, 0, 0, 0, NULL, NULL),
(4, 3, 'خريطة الموقع', 'خريطة الموقع', '', 'خريطة الموقع', 'sitemap', '', 'index,follow', '', '', '', NULL, 'sitemap', '', 0, 1, 13, 0, 0, 0, 0, 0, NULL, NULL),
(4, 4, 'Sitemap', 'Sitemap', '', 'Sitemap', 'sitemap', '', 'index,follow', '', '', '', NULL, 'sitemap', '', 0, 1, 13, 0, 0, 0, 0, 0, NULL, NULL),
(5, 1, 'Qui sommes-nous ?', 'Qui sommes-nous ?', '', 'Qui sommes-nous ?', 'qui-sommes-nous', '', 'index,follow', '', '', '', NULL, 'page', 'article', 0, 1, 2, 0, 0, 0, 0, 0, NULL, NULL),
(5, 2, 'About us', 'About us', '', 'About us', 'about-us', '', 'index,follow', '', '', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque fringilla vel est at rhoncus. Cras porttitor ligula vel magna vehicula accumsan. Mauris eget elit et sem commodo interdum. Aenean dolor sem, tincidunt ac neque tempus, hendrerit blandit lacus. Vivamus placerat nulla in mi tristique, fringilla fermentum nisl vehicula. Nullam quis eros non magna tincidunt interdum ac eu eros. Morbi malesuada pulvinar ultrices. Etiam bibendum efficitur risus, sit amet venenatis urna ullamcorper non. Proin fermentum malesuada tortor, vitae mattis sem scelerisque in. Curabitur rutrum leo at mi efficitur suscipit. Vivamus tristique lorem eros, sit amet malesuada augue sodales sed.</p>\r\n', NULL, 'page', 'article', 0, 1, 2, 1594991006, 1600350530, 0, 0, 0, '', ''),
(5, 3, 'معلومات عنا', 'معلومات عنا', '', 'معلومات عنا', 'about us', '', 'index,follow', '', '', '', NULL, 'page', 'article', 0, 1, 2, 0, 0, 0, 0, 0, NULL, NULL),
(5, 4, 'Hakkımızda', 'Hakkımızda', '', 'Hakkımızda', 'hakkimizda', '', 'index,follow', '', '', '<div id=\"wrapper\"><!-- content-->\r\n<div class=\"content\"><!--  section  -->\r\n<div class=\"container\"><!--about-wrap -->\r\n<div class=\"about-wrap\">\r\n<div class=\"row\">\r\n<div class=\"col-md-6\">\r\n<div class=\"video-box fl-wrap\"><img alt=\"\" class=\"respimg\" src=\"/templates/default/images/educaiton.png\" /> <span class=\"video-box-title\"></span></div>\r\n</div>\r\n\r\n<div class=\"col-md-6\">\r\n<div class=\"list-single-main-item-title fl-wrap\">\r\n<h3>Hakkımızda</h3>\r\n\r\n<h3><span style=\"font-size: 13px;\"></h3>\r\n\r\n<p>Türkiye\'de  yer alan tüm eğitim seviyelerine ait kurs merkezlerini, öğrencilerin kaliteli bir eğitim alması amacıyla sizin için tarafsız şekilde listeleme hizmeti sunan bir eğitim platformuyuz.</p>\r\n\r\n<p>Sistemimiz, kendi tanıtımlarını yapan kurs merkezlerinin, kriterlerinize uygun olup olmadığını, merkezlere dair detaylı bilgiyi, kurs merkezlerinin imkanları ve eğitim kalitesi hakkında veli ya da öğrenci yorumlarını size sunmayı amaçlar. Sizin için hazırladığımız listelerimiz ile kriterlerinize en uygun okulu en kısa zamanda seçmeniz için size kurs merkezlerine kayıt olanların yorumlarını sunar.</p>\r\n\r\n<p>Kendi kurs merkezinize dair deneyimlerinizi paylaşarak siz de bu eğitim hareketinde yer alabilir, bilinçli bireylerin yetişmesine katkıda bulunabilirsiniz. Yapılan yorumlar, kurs merkezlerinin eğitim öğretim kalitesini arttırması adına veli ve öğrenci istekleriyle aynı doğrultuya gelmesinde önemli bir rol oynayacaktır.</p>\r\n</div>\r\n\r\n<p></span></p>\r\n</div>\r\n</div>\r\n</div>\r\n<!-- about-wrap end  -->\r\n\r\n<div class=\"single-facts fl-wrap\"><!-- inline-facts -->\r\n<div class=\"inline-facts-wrap\">\r\n<div class=\"inline-facts\">\r\n<div class=\"milestone-counter\">\r\n<div class=\"stats animaper\">\r\n<div class=\"num\" data-content=\"0\" data-num=\"254\">154</div>\r\n</div>\r\n</div>\r\n\r\n<h6>Kurs Merkezi</h6>\r\n</div>\r\n</div>\r\n<!-- inline-facts end --><!-- inline-facts  -->\r\n\r\n<div class=\"inline-facts-wrap\">\r\n<div class=\"inline-facts\">\r\n<div class=\"milestone-counter\">\r\n<div class=\"stats animaper\">\r\n<div class=\"num\" data-content=\"0\" data-num=\"12168\">12168</div>\r\n</div>\r\n</div>\r\n\r\n<h6>Öğrenci</h6>\r\n</div>\r\n</div>\r\n<!-- inline-facts end --><!-- inline-facts  -->\r\n\r\n<div class=\"inline-facts-wrap\">\r\n<div class=\"inline-facts\">\r\n<div class=\"milestone-counter\">\r\n<div class=\"stats animaper\">\r\n<div class=\"num\" data-content=\"0\" data-num=\"172\">172</div>\r\n</div>\r\n</div>\r\n\r\n<h6>Günlük Ziyaretçi</h6>\r\n</div>\r\n</div>\r\n<!-- inline-facts end --><!-- inline-facts  -->\r\n\r\n<div class=\"inline-facts-wrap\">\r\n<div class=\"inline-facts\">\r\n<div class=\"milestone-counter\">\r\n<div class=\"stats animaper\">\r\n<div class=\"num\" data-content=\"0\" data-num=\"732\">732</div>\r\n</div>\r\n</div>\r\n\r\n<h6>Yorum Sayısı</h6>\r\n</div>\r\n</div>\r\n<!-- inline-facts end --></div>\r\n</div>\r\n</div>\r\n<!--slider-carousel-wrap end-->\r\n\r\n<div class=\"section-decor\"> </div>\r\n</div>\r\n<!-- content end-->', NULL, 'page', 'article', 0, 1, 2, 1594991006, 1602145687, 0, 0, 0, '', ''),
(6, 1, 'Recherche', 'Recherche', '', 'Recherche', 'search', '', 'noindex,nofollow', '', '', '', NULL, 'search', '', 0, 1, 14, 0, 0, 0, 0, 1, NULL, NULL),
(6, 2, 'Search', 'Search', '', 'Search', 'search', '', 'noindex,nofollow', '', '', '', NULL, 'search', '', 0, 1, 14, 0, 0, 0, 0, 1, NULL, NULL),
(6, 3, 'بحث', 'بحث', '', 'بحث', 'search', '', 'noindex,nofollow', '', '', '', NULL, 'search', '', 0, 1, 14, 0, 0, 0, 0, 1, NULL, NULL),
(6, 4, 'Search', 'Search', '', 'Search', 'search', '', 'noindex,nofollow', '', '', '', NULL, 'search', '', 0, 1, 14, 0, 0, 0, 0, 1, NULL, NULL),
(7, 1, 'Galerie', 'Galerie', '', 'Galerie', 'galerie', '', 'index,follow', '', '', '', NULL, 'page', 'gallery', 0, 1, 5, 0, 0, 0, 0, 0, NULL, NULL),
(7, 2, 'Gallery', 'Gallery', '', 'Gallery', 'gallery', '', 'index,follow', '', '', '', NULL, 'page', 'gallery', 0, 1, 5, 0, 0, 0, 0, 0, NULL, NULL),
(7, 3, 'صور معرض', 'صور معرض', '', 'صور معرض', 'gallery', '', 'index,follow', '', '', '', NULL, 'page', 'gallery', 0, 1, 5, 0, 0, 0, 0, 0, NULL, NULL),
(7, 4, 'Gallery', 'Gallery', '', 'Gallery', 'gallery', '', 'index,follow', '', '', '', NULL, 'page', 'gallery', 0, 1, 5, 0, 0, 0, 0, 0, NULL, NULL),
(8, 1, '404', 'Erreur 404 : Page introuvable !', '', '404 Page introuvable', '404', '', 'noindex,nofollow', '', '', '<p>L\'URL demandée n\'a pas été trouvée sur ce serveur.<br />\r\nLa page que vous voulez afficher n\'existe pas, ou est temporairement indisponible.</p>\r\n\r\n<p>Merci d\'essayer les actions suivantes :</p>\r\n\r\n<ul>\r\n    <li>Assurez-vous que l\'URL dans la barre d\'adresse de votre navigateur est correctement orthographiée et formatée.</li>\r\n    <li>Si vous avez atteint cette page en cliquant sur un lien ou si vous pensez que cela concerne une erreur du serveur, contactez l\'administrateur pour l\'alerter.</li>\r\n</ul>\r\n', NULL, '404', '', 0, 1, 15, 0, 0, 0, 0, 1, NULL, NULL),
(8, 2, '404', '404 Error: Page not found!', '', '404 Not Found', '404', '', 'noindex,nofollow', '', '', '<p>The wanted URL was not found on this server.<br />\r\nThe page you wish to display does not exist, or is temporarily unavailable.</p>\r\n\r\n<p>Thank you for trying the following actions :</p>\r\n\r\n<ul>\r\n    <li>Be sure the URL in the address bar of your browser is correctly spelt and formated.</li>\r\n    <li>If you reached this page by clicking a link or if you think that it is about an error of the server, contact the administrator to alert him.</li>\r\n</ul>\r\n', NULL, '404', '', 0, 1, 15, 0, 0, 0, 0, 1, NULL, NULL),
(8, 3, '404', '404 Error: Page not found!', '', '404 Not Found', '404', '', 'noindex,nofollow', '', '', '', NULL, '404', '', 0, 1, 15, 0, 0, 0, 0, 1, NULL, NULL),
(8, 4, '404', '404 Error: Page not found!', '', '404 Not Found', '404', '', 'noindex,nofollow', '', '', '<p>The wanted URL was not found on this server.<br />\r\nThe page you wish to display does not exist, or is temporarily unavailable.</p>\r\n\r\n<p>Thank you for trying the following actions :</p>\r\n\r\n<ul>\r\n    <li>Be sure the URL in the address bar of your browser is correctly spelt and formated.</li>\r\n    <li>If you reached this page by clicking a link or if you think that it is about an error of the server, contact the administrator to alert him.</li>\r\n</ul>\r\n', NULL, '404', '', 0, 1, 15, 0, 0, 0, 0, 1, NULL, NULL),
(9, 1, 'Hôtels', 'Hôtels', '', 'Hôtels', 'hotels', '', 'index,follow', '', '', '', NULL, 'hotels', 'hotel', 0, 1, 3, 0, 0, 0, 0, 1, NULL, NULL),
(9, 2, 'Kurs Merkezleri', 'Kurs Merkezleri', '', 'Kurs Merkezleri', 'kurs-merkezleri', '', 'index,follow', '', '', '', NULL, 'hotels', 'hotel', 0, 1, 3, 1594990286, 1600690493, 0, 0, 1, '', ''),
(9, 3, 'الفنادق', 'الفنادق', '', 'الفنادق', 'hotels', '', 'index,follow', '', '', '', NULL, 'hotels', 'hotel', 0, 1, 3, 0, 0, 0, 0, 1, NULL, NULL),
(9, 4, 'Kurs Merkezleri', 'Kurs Merkezleri', '', 'Kurs Merkezleri', 'kurs-merkezleri', '', 'index,follow', '', '', '', NULL, 'hotels', 'hotel', 0, 1, 3, 1594990286, 1600690493, 0, 0, 1, '', ''),
(10, 1, 'Réserver', 'Réserver', '', 'Réserver', 'reserver', '', 'index,nofollow', '', '', '', NULL, 'booking', 'booking', 0, 1, 6, 0, 0, 0, 0, 1, NULL, NULL),
(10, 2, 'Booking', 'Booking', '', 'Booking', 'booking', '', 'index,nofollow', '', '', '', NULL, 'booking', 'booking', 0, 1, 6, 1594990874, 1600690085, 0, 0, 1, '', ''),
(10, 3, 'الحجز', 'الحجز', '', 'الحجز', 'booking', '', 'index,nofollow', '', '', '', NULL, 'booking', 'booking', 0, 1, 6, 0, 0, 0, 0, 1, NULL, NULL),
(10, 4, 'Kurs Merkezi Ara', 'Kurs Merkezi Ara', '', 'Kurs Merkezi Ara', 'kurs-merkezi-ara', '', 'index,nofollow', '', '', '', NULL, 'booking', 'booking', 0, 1, 6, 1594990874, 1600690085, 0, 0, 1, '', ''),
(11, 1, 'Coordonnées', 'Coordonnées', '', 'Coordonnées', 'coordonnees', '', 'noindex,nofollow', '', '', '', 10, 'details', '', 0, 1, 8, 0, 0, 0, 0, 1, NULL, NULL),
(11, 2, 'Details', 'Booking details', '', 'Booking details', 'booking-details', '', 'noindex,nofollow', '', '', '', 10, 'details', '', 0, 1, 8, 1600435987, 1600435987, 0, 0, 1, '', ''),
(11, 3, 'تفاصيل الحجز', 'تفاصيل الحجز', '', 'تفاصيل الحجز', 'booking-details', '', 'noindex,nofollow', '', '', '', 10, 'details', '', 0, 1, 8, 0, 0, 0, 0, 1, NULL, NULL),
(11, 4, 'Detaylar', 'Detaylar', '', 'Detaylar', 'detaylar', '', 'noindex,nofollow', '', '', '', 10, 'details', '', 0, 1, 8, 1600435987, 1600435987, 0, 0, 1, '', ''),
(12, 1, 'Paiement', 'Paiement', '', 'Paiement', 'paiement', '', 'noindex,nofollow', '', '', '', 13, 'payment', '', 0, 1, 10, 0, 0, 0, 0, 1, NULL, NULL),
(12, 2, 'Payment', 'Payment', '', 'Payment', 'payment', '', 'noindex,nofollow', '', '', '', 13, 'payment', '', 0, 1, 10, 0, 0, 0, 0, 1, NULL, NULL),
(12, 3, 'دفع', 'دفع', '', 'دفع', 'payment', '', 'noindex,nofollow', '', '', '', 13, 'payment', '', 0, 1, 10, 0, 0, 0, 0, 1, NULL, NULL),
(12, 4, 'Ödeme', 'Ödeme', '', 'Ödeme', 'odeme', '', 'noindex,nofollow', '', '', '', 13, 'payment', '', 0, 1, 10, 1601453195, 1601453195, 0, 0, 1, '', ''),
(13, 1, 'Résumé de la réservation', 'Résumé de la réservation', '', 'Résumé de la réservation', 'resume-reservation', '', 'noindex,nofollow', '', '', '', 11, 'summary', '', 0, 1, 9, 0, 0, 0, 0, 1, NULL, NULL),
(13, 2, 'Summary', 'Booking summary', '', 'Booking summary', 'booking-summary', '', 'noindex,nofollow', '', '', '', 11, 'summary', '', 0, 1, 9, 1600435966, 1600435966, 0, 0, 1, '', ''),
(13, 3, 'ملخص الحجز', 'ملخص الحجز', '', 'ملخص الحجز', 'booking-summary', '', 'noindex,nofollow', '', '', '', 11, 'summary', '', 0, 1, 9, 0, 0, 0, 0, 1, NULL, NULL),
(13, 4, 'Özet', 'Özet', '', 'Özet', 'ozet', '', 'noindex,nofollow', '', '', '', 11, 'summary', '', 0, 1, 9, 1600435966, 1600435966, 0, 0, 1, '', ''),
(14, 1, 'Espace client', 'Espace client', '', 'Espace client', 'espace-client', '', 'noindex,nofollow', '', '', '', NULL, 'account', '', 0, 1, 16, 0, 0, 0, 0, 1, NULL, NULL),
(14, 2, 'Account', 'Account', '', 'Account', 'account', '', 'noindex,nofollow', '', '', '', NULL, 'account', '', 0, 1, 16, 0, 0, 0, 0, 1, NULL, NULL),
(14, 3, 'Account', 'Account', '', 'Account', 'account', '', 'noindex,nofollow', '', '', '', NULL, 'account', '', 0, 1, 16, 0, 0, 0, 0, 1, NULL, NULL),
(14, 4, 'Account', 'Account', '', 'Account', 'account', '', 'noindex,nofollow', '', '', '', NULL, 'account', '', 0, 1, 16, 0, 0, 0, 0, 1, NULL, NULL),
(15, 1, 'Activités', 'Activités', '', 'Activités', 'reservation-activitees', '', 'noindex,nofollow', '', '', '', 10, 'booking-activities', '', 0, 1, 7, 0, 0, 0, 0, 1, NULL, NULL),
(15, 2, 'Activities', 'Activities', '', 'Activities', 'booking-activities', '', 'noindex,nofollow', '', '', '', 10, 'booking-activities', '', 0, 1, 7, 0, 0, 0, 0, 1, NULL, NULL),
(15, 3, 'Activities', 'Activities', '', 'Activities', 'booking-activities', '', 'noindex,nofollow', '', '', '', 10, 'booking-activities', '', 0, 1, 7, 0, 0, 0, 0, 1, NULL, NULL),
(15, 4, 'Activities', 'Activities', '', 'Activities', 'booking-activities', '', 'noindex,nofollow', '', '', '', 10, 'booking-activities', '', 0, 1, 7, 0, 0, 0, 0, 1, NULL, NULL),
(16, 1, 'Activités', 'Activités', '', 'Activités', 'activitees', '', 'index,follow', '', '', '', NULL, 'activities', 'activity', 0, 1, 4, 0, 0, 0, 0, 1, NULL, NULL),
(16, 2, 'Activities', 'Activities', '', 'Activities', 'activities', '', 'index,follow', '', '', '', NULL, 'activities', 'activity', 0, 1, 4, 0, 0, 0, 0, 1, NULL, NULL),
(16, 3, 'Activities', 'Activities', '', 'Activities', 'activities', '', 'index,follow', '', '', '', NULL, 'activities', 'activity', 0, 1, 4, 0, 0, 0, 0, 1, NULL, NULL),
(16, 4, 'Activities', 'Activities', '', 'Activities', 'activities', '', 'index,follow', '', '', '', NULL, 'activities', 'activity', 0, 1, 4, 0, 0, 0, 0, 1, NULL, NULL),
(17, 1, 'Blog', 'Blog', '', 'Blog', 'blog', '', 'index,follow', '', '', '', NULL, 'blog', 'article-blog', 0, 1, 12, 0, 0, 0, 0, 0, NULL, NULL),
(17, 2, 'Blog', 'Blog', '', 'Blog', 'blog', '', 'index,follow', '', '', '', NULL, 'blog', 'article-blog', 0, 1, 12, 0, 0, 0, 0, 0, NULL, NULL),
(17, 3, 'مدونة', 'مدونة', '', 'مدونة', 'blog', '', 'index,follow', '', '', '', NULL, 'blog', 'article-blog', 0, 1, 12, 0, 0, 0, 0, 0, NULL, NULL),
(17, 4, 'Blog', 'Blog', '', 'Blog', 'blog', '', 'index,follow', '', '', '', NULL, 'blog', 'article-blog', 0, 1, 12, 0, 0, 0, 0, 0, NULL, NULL),
(18, 1, 'Destinations', 'Destinations', '', 'Destinations', 'destinations', '', 'index,follow', '', '', '', NULL, 'destinations', '', 0, 1, 7, 0, 0, 0, 0, 1, NULL, NULL),
(18, 2, 'Destinations', 'Destinations', '', 'Destinations', 'destinations', '', 'index,follow', '', '', '', NULL, 'destinations', '', 0, 1, 7, 1594990728, 1594990727, 0, 0, 1, '', ''),
(18, 3, 'وجهات', 'وجهات', '', 'وجهات', 'destinations', '', 'index,follow', '', '', '', NULL, 'destinations', '', 0, 1, 7, 0, 0, 0, 0, 1, NULL, NULL),
(18, 4, 'Şehirler', 'Şehirler', '', 'Şehirler', 'sehirler', '', 'index,follow', '', '', '', NULL, 'destinations', '', 0, 1, 7, 1594990728, 1594990727, 0, 0, 1, '', ''),
(19, 2, '', '', '', '', '', '', '', NULL, '', '', 9, 'hotels-map', 'hotels-map', 0, 1, 17, 1600341829, 1600341829, 0, NULL, NULL, '', ''),
(19, 4, 'Harita', 'Harita', '', 'harita', 'merkez-harita', '', '', NULL, '', '', 9, 'hotels-map', 'hotels-map', 0, 1, 17, 1600341829, 1600341829, 0, NULL, NULL, '', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_page_file`
--

CREATE TABLE `pm_page_file` (
  `id` int(11) NOT NULL,
  `lang` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `home` int(11) DEFAULT 0,
  `checked` int(11) DEFAULT 1,
  `rank` int(11) DEFAULT 0,
  `file` varchar(250) DEFAULT NULL,
  `label` varchar(250) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `pm_page_file`
--

INSERT INTO `pm_page_file` (`id`, `lang`, `id_item`, `home`, `checked`, `rank`, `file`, `label`, `type`) VALUES
(1, 2, 5, NULL, 1, 1, 'college-of-education.jpeg', '', 'image'),
(1, 4, 5, NULL, 1, 1, 'college-of-education.jpeg', '', 'image');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_popup`
--

CREATE TABLE `pm_popup` (
  `id` int(11) NOT NULL,
  `lang` int(11) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `allpages` text DEFAULT NULL,
  `pages` text DEFAULT NULL,
  `background` varchar(20) DEFAULT NULL,
  `checked` int(11) DEFAULT 0,
  `publish_date` int(11) DEFAULT NULL,
  `unpublish_date` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_rate`
--

CREATE TABLE `pm_rate` (
  `id` int(11) NOT NULL,
  `id_room` int(11) NOT NULL,
  `id_hotel` int(11) DEFAULT NULL,
  `id_package` int(11) NOT NULL,
  `users` text DEFAULT NULL,
  `start_date` int(11) DEFAULT NULL,
  `end_date` int(11) DEFAULT NULL,
  `price` double DEFAULT 0,
  `child_price` double DEFAULT 0,
  `discount` double DEFAULT 0,
  `discount_type` varchar(10) DEFAULT 'rate',
  `people` int(11) DEFAULT NULL,
  `price_sup` double DEFAULT NULL,
  `fixed_sup` double DEFAULT NULL,
  `id_tax` int(11) DEFAULT NULL,
  `taxes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `pm_rate`
--

INSERT INTO `pm_rate` (`id`, `id_room`, `id_hotel`, `id_package`, `users`, `start_date`, `end_date`, `price`, `child_price`, `discount`, `discount_type`, `people`, `price_sup`, `fixed_sup`, `id_tax`, `taxes`) VALUES
(2, 2, 2, 7, '1', 1594771200, 1627689600, 10000, 0, 0, '', 2, 60, 0, NULL, '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_rate_child`
--

CREATE TABLE `pm_rate_child` (
  `id` int(11) NOT NULL,
  `id_rate` int(11) NOT NULL,
  `min_age` int(11) DEFAULT NULL,
  `max_age` int(11) DEFAULT NULL,
  `price` double DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_room`
--

CREATE TABLE `pm_room` (
  `id` int(11) NOT NULL,
  `lang` int(11) NOT NULL,
  `id_hotel` int(11) NOT NULL,
  `users` text DEFAULT NULL,
  `max_children` int(11) DEFAULT 0,
  `max_adults` int(11) DEFAULT 1,
  `max_people` int(11) DEFAULT NULL,
  `min_people` int(11) DEFAULT 1,
  `title` varchar(250) DEFAULT NULL,
  `subtitle` varchar(250) DEFAULT NULL,
  `alias` varchar(100) DEFAULT NULL,
  `descr` longtext DEFAULT NULL,
  `facilities` text DEFAULT NULL,
  `stock` int(11) DEFAULT 1,
  `price` double DEFAULT 0,
  `home` int(11) DEFAULT 0,
  `checked` int(11) DEFAULT 0,
  `rank` int(11) DEFAULT 0,
  `start_lock` int(11) DEFAULT NULL,
  `end_lock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `pm_room`
--

INSERT INTO `pm_room` (`id`, `lang`, `id_hotel`, `users`, `max_children`, `max_adults`, `max_people`, `min_people`, `title`, `subtitle`, `alias`, `descr`, `facilities`, `stock`, `price`, `home`, `checked`, `rank`, `start_lock`, `end_lock`) VALUES
(2, 1, 2, '1', 2, 2, 2, 1, '', '', '', '', '', 1, 10000, 1, 1, 2, NULL, NULL),
(2, 2, 2, '1', 0, 1, 12, 1, 'Okula Kayıt Ol', 'Okula Kayıt Ol', 'yeniogan-kayit', '', '9,48,34,51,35,50,3,21,40,28,11,22,38,44,52,24,49,27,45,20,31,25,41,14,53,54,6,30,1,16,33,8,26,12', 1, 10000, 1, 1, 2, NULL, NULL),
(2, 3, 2, '1', 2, 2, 2, 1, '', '', '', '', '', 1, 10000, 1, 1, 2, NULL, NULL),
(2, 4, 2, '1', 0, 1, 12, 1, 'Lise', 'Lise', 'yenidogan-kayit', '', '9,48,34,51,35,50,3,21,40,28,11,22,38,44,52,24,49,27,45,20,31,25,41,14,53,54,6,30,1,16,33,8,26,12', 1, 10000, 1, 1, 2, NULL, NULL),
(5, 4, 7, '1', 0, 1, 1, 1, 'Lise', 'Lise', 'nisantasikoleji-lise', '', '9,48,34,51,35,50,3,21,40,28', 3, 20000, 1, 1, 3, NULL, NULL),
(6, 4, 3, '1', 0, 1, 15, 1, 'Ortaokul', 'Ortaokul', 'kamer-lise', '<p><strong>Özel Altunay Koleji Lisesi </strong>içindeki fiziksel özelliklerin Kapalı Spor Salonu, sanat atölyesi, bahçe, laboratuvar, oyun alanı, konferans salonu, müzik odası, kütüphane, 3d odası, yemekhane, akıllı tahta olduğunu görüyoruz. İngilizce eğitimi tek verilen dil eğitimdir. Dini Eğitim, servis, rehberlik, kantin hizmetleri kurumun faydaları arasındadır. Okuldaki iki kulüp arasında Akıl ve Zeka Oyunları ve yabancı dil kulübü bulunmaktadır.</p>\r\n', '9,48,34,51,35,50,3,21,40', 3, 10000, 1, 1, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_room_calendar`
--

CREATE TABLE `pm_room_calendar` (
  `id` int(11) NOT NULL,
  `id_room` int(11) NOT NULL,
  `title` varchar(150) DEFAULT NULL,
  `latest_sync` int(11) DEFAULT NULL,
  `url` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_room_closing`
--

CREATE TABLE `pm_room_closing` (
  `id` int(11) NOT NULL,
  `id_room` int(11) NOT NULL,
  `from_date` int(11) DEFAULT NULL,
  `to_date` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_room_file`
--

CREATE TABLE `pm_room_file` (
  `id` int(11) NOT NULL,
  `lang` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `home` int(11) DEFAULT 0,
  `checked` int(11) DEFAULT 1,
  `rank` int(11) DEFAULT 0,
  `file` varchar(250) DEFAULT NULL,
  `label` varchar(250) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `pm_room_file`
--

INSERT INTO `pm_room_file` (`id`, `lang`, `id_item`, `home`, `checked`, `rank`, `file`, `label`, `type`) VALUES
(3, 1, 2, NULL, 1, 2, 'img-8415.jpg', '', 'image'),
(3, 2, 2, NULL, 1, 2, 'img-8415.jpg', '', 'image'),
(3, 3, 2, NULL, 1, 2, 'img-8415.jpg', '', 'image'),
(3, 4, 2, NULL, 1, 2, 'img-8415.jpg', '', 'image'),
(6, 4, 5, NULL, 1, 3, 'yeni-dogu-okullari-555f239ab8f8aba6ba9b276bff2.jpg', NULL, 'image'),
(7, 4, 6, NULL, 1, 4, 'yeni-dogu-okullari-555f239ab8f8aba6ba9b276bff2.jpg', '', 'image');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_room_lock`
--

CREATE TABLE `pm_room_lock` (
  `id` int(11) NOT NULL,
  `id_room` int(11) DEFAULT NULL,
  `from_date` int(11) DEFAULT NULL,
  `to_date` int(11) DEFAULT NULL,
  `add_date` int(11) DEFAULT NULL,
  `sessid` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `pm_room_lock`
--

INSERT INTO `pm_room_lock` (`id`, `id_room`, `from_date`, `to_date`, `add_date`, `sessid`) VALUES
(5, 2, 1599782400, 1599868800, 1599837013, '5f5b9355be3af'),
(6, 2, 1600300800, 1600387200, 1600330614, '5f631b766af7f'),
(7, 2, 1600387200, 1600473600, 1600413767, '5f646047474ab'),
(8, 2, 1600387200, 1600473600, 1600413836, '5f64608c2160c'),
(9, 2, 1600387200, 1600473600, 1600435744, '5f64b62077ea7'),
(12, 2, 1601424000, 1601510400, 1601453072, '5f743c10d57b3'),
(13, 2, 1601596800, 1601683200, 1601649869, '5f773ccd6abe4'),
(15, 2, 1602028800, 1602115200, 1602067775, '5f7d9d3f6bdaa'),
(16, 2, 1602028800, 1602115200, 1602070538, '5f7da80a347fc'),
(17, 2, 1602115200, 1602201600, 1602142294, '5f7ec0562feaa');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_schoollevel`
--

CREATE TABLE `pm_schoollevel` (
  `id` int(11) NOT NULL,
  `lang` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `alias` varchar(100) NOT NULL,
  `checked` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `pm_schoollevel`
--

INSERT INTO `pm_schoollevel` (`id`, `lang`, `name`, `title`, `alias`, `checked`) VALUES
(1, 4, 'TYT Hazırlık', 'TYT Hazırlık', 'tyt-hazirlik', 1),
(2, 4, 'AYT Hazırlık', 'AYT Hazırlık', 'ilkokul', 1),
(3, 4, 'YGS Hazırlık', 'YGS Hazırlık', 'ygs-hazirlik', 1),
(4, 4, 'YDS Hazırlık', 'YDS Hazırlık', 'yds-hazirlik', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_service`
--

CREATE TABLE `pm_service` (
  `id` int(11) NOT NULL,
  `lang` int(11) NOT NULL,
  `users` text DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `descr` text DEFAULT NULL,
  `long_descr` text DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `rooms` varchar(250) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `id_tax` int(11) DEFAULT NULL,
  `taxes` text DEFAULT NULL,
  `mandatory` int(11) DEFAULT 0,
  `start_date` int(11) DEFAULT NULL,
  `end_date` int(11) DEFAULT NULL,
  `checked` int(11) DEFAULT 0,
  `rank` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_slide`
--

CREATE TABLE `pm_slide` (
  `id` int(11) NOT NULL,
  `lang` int(11) NOT NULL,
  `legend` text DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL,
  `id_page` int(11) DEFAULT NULL,
  `checked` int(11) DEFAULT 0,
  `rank` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `pm_slide`
--

INSERT INTO `pm_slide` (`id`, `lang`, `legend`, `url`, `id_page`, `checked`, `rank`) VALUES
(1, 1, '', '', 1, 2, 2),
(1, 2, '<h1> </h1>\r\n\r\n<h2> </h2>\r\n', '', 1, 2, 2),
(1, 3, '', '', 1, 2, 2),
(1, 4, '<h1> </h1>\r\n\r\n<h2> </h2>\r\n', '', 1, 2, 2),
(2, 1, '', '', 1, 1, 3),
(2, 2, '<h1> </h1>\r\n\r\n<h2> </h2>\r\n', '', 1, 1, 3),
(2, 3, '', '', 1, 1, 3),
(2, 4, '<h1> </h1>\r\n\r\n<h2> </h2>\r\n', '', 1, 1, 3),
(3, 1, '', '', 1, 2, 1),
(3, 2, '', '', 1, 2, 1),
(3, 3, '', '', 1, 2, 1),
(3, 4, '<h1> </h1>\r\n\r\n<h2> </h2>\r\n', '', 1, 2, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_slide_file`
--

CREATE TABLE `pm_slide_file` (
  `id` int(11) NOT NULL,
  `lang` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `home` int(11) DEFAULT 0,
  `checked` int(11) DEFAULT 1,
  `rank` int(11) DEFAULT 0,
  `file` varchar(250) DEFAULT NULL,
  `label` varchar(250) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `pm_slide_file`
--

INSERT INTO `pm_slide_file` (`id`, `lang`, `id_item`, `home`, `checked`, `rank`, `file`, `label`, `type`) VALUES
(7, 2, 3, NULL, 1, 4, 'res1.jpg', NULL, 'image'),
(7, 4, 3, NULL, 1, 4, 'res1.jpg', NULL, 'image'),
(8, 2, 2, NULL, 1, 5, 'res2.jpg', NULL, 'image'),
(8, 4, 2, NULL, 1, 5, 'res2.jpg', NULL, 'image'),
(9, 2, 1, NULL, 1, 6, 'college-of-education.jpeg', NULL, 'image'),
(9, 4, 1, NULL, 1, 6, 'college-of-education.jpeg', NULL, 'image');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_social`
--

CREATE TABLE `pm_social` (
  `id` int(11) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `url` text DEFAULT NULL,
  `checked` int(11) DEFAULT 1,
  `rank` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `pm_social`
--

INSERT INTO `pm_social` (`id`, `type`, `url`, `checked`, `rank`) VALUES
(1, 'facebook', 'https://www.facebook.com/', 1, 1),
(2, 'twitter', 'https://www.twitter.com', 1, 2),
(3, 'instagram', 'https://www.instagram.com', 1, 3),
(4, 'youtube', 'https://www.youtube.com', 1, 4);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_tag`
--

CREATE TABLE `pm_tag` (
  `id` int(11) NOT NULL,
  `lang` int(11) NOT NULL,
  `value` varchar(250) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `pages` varchar(250) DEFAULT NULL,
  `checked` int(11) DEFAULT 0,
  `rank` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_tax`
--

CREATE TABLE `pm_tax` (
  `id` int(11) NOT NULL,
  `lang` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `value` double DEFAULT 0,
  `checked` int(11) DEFAULT 0,
  `rank` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `pm_tax`
--

INSERT INTO `pm_tax` (`id`, `lang`, `name`, `value`, `checked`, `rank`) VALUES
(1, 1, 'TVA', 10, 1, 1),
(1, 2, 'Vergi', 10, 1, 1),
(1, 3, 'VAT', 10, 1, 1),
(1, 4, 'Vergi', 10, 1, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_text`
--

CREATE TABLE `pm_text` (
  `id` int(11) NOT NULL,
  `lang` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `pm_text`
--

INSERT INTO `pm_text` (`id`, `lang`, `name`, `value`) VALUES
(1, 1, 'CREATION', 'Création'),
(1, 2, 'CREATION', 'Creation'),
(1, 3, 'CREATION', 'إنشاء'),
(1, 4, 'CREATION', 'Creation'),
(2, 1, 'MESSAGE', 'Message'),
(2, 2, 'MESSAGE', 'Message'),
(2, 3, 'MESSAGE', 'رسالة'),
(2, 4, 'MESSAGE', 'Mesaj'),
(3, 1, 'EMAIL', 'E-mail'),
(3, 2, 'EMAIL', 'E-mail'),
(3, 3, 'EMAIL', 'بَرِيدٌ إلِكْترونيّ'),
(3, 4, 'EMAIL', 'E-mail'),
(4, 1, 'PHONE', 'Tél.'),
(4, 2, 'PHONE', 'Phone'),
(4, 3, 'PHONE', 'رقم هاتف'),
(4, 4, 'PHONE', 'Telefon'),
(5, 1, 'FAX', 'Fax'),
(5, 2, 'FAX', 'Fax'),
(5, 3, 'FAX', 'فاكس'),
(5, 4, 'FAX', 'Fax'),
(6, 1, 'COMPANY', 'Société'),
(6, 2, 'COMPANY', 'Company'),
(6, 3, 'COMPANY', 'مشروع'),
(6, 4, 'COMPANY', 'Şirket'),
(7, 1, 'COPY_CODE', 'Recopiez le code'),
(7, 2, 'COPY_CODE', 'Copy the code'),
(7, 3, 'COPY_CODE', 'رمز الأمان'),
(7, 4, 'COPY_CODE', 'Copy the code'),
(8, 1, 'SUBJECT', 'Sujet'),
(8, 2, 'SUBJECT', 'Subject'),
(8, 3, 'SUBJECT', 'موضوع'),
(8, 4, 'SUBJECT', 'Konu'),
(9, 1, 'REQUIRED_FIELD', 'Champ requis'),
(9, 2, 'REQUIRED_FIELD', 'Required field'),
(9, 3, 'REQUIRED_FIELD', 'الحقل المطلوب'),
(9, 4, 'REQUIRED_FIELD', 'Zorunlu Alan'),
(10, 1, 'INVALID_CAPTCHA_CODE', 'Le code de sécurité saisi est incorrect'),
(10, 2, 'INVALID_CAPTCHA_CODE', 'Invalid security code'),
(10, 3, 'INVALID_CAPTCHA_CODE', 'رمز الحماية أدخلته غير صحيح'),
(10, 4, 'INVALID_CAPTCHA_CODE', 'Invalid security code'),
(11, 1, 'INVALID_EMAIL', 'Adresse e-mail invalide'),
(11, 2, 'INVALID_EMAIL', 'Invalid email address'),
(11, 3, 'INVALID_EMAIL', 'بريد إلكتروني خاطئ'),
(11, 4, 'INVALID_EMAIL', 'Invalid email address'),
(12, 1, 'FIRSTNAME', 'Prénom'),
(12, 2, 'FIRSTNAME', 'Firstname'),
(12, 3, 'FIRSTNAME', 'الاسم الأول'),
(12, 4, 'FIRSTNAME', 'Adınız'),
(13, 1, 'LASTNAME', 'Nom'),
(13, 2, 'LASTNAME', 'Lastname'),
(13, 3, 'LASTNAME', 'اسم العائلة'),
(13, 4, 'LASTNAME', 'Soyadınız'),
(14, 1, 'ADDRESS', 'Adresse'),
(14, 2, 'ADDRESS', 'Address'),
(14, 3, 'ADDRESS', 'عنوان الشارع'),
(14, 4, 'ADDRESS', 'Adres'),
(15, 1, 'POSTCODE', 'Code postal'),
(15, 2, 'POSTCODE', 'Post code'),
(15, 3, 'POSTCODE', 'الرمز البريدي'),
(15, 4, 'POSTCODE', 'Posta Kodu'),
(16, 1, 'CITY', 'Ville'),
(16, 2, 'CITY', 'City'),
(16, 3, 'CITY', 'مدينة'),
(16, 4, 'CITY', 'Şehir'),
(17, 1, 'MOBILE', 'Portable'),
(17, 2, 'MOBILE', 'Mobile'),
(17, 3, 'MOBILE', 'هاتف'),
(17, 4, 'MOBILE', 'Cep Telefonu'),
(18, 1, 'ADD', 'Ajouter'),
(18, 2, 'ADD', 'Add'),
(18, 3, 'ADD', 'إضافة على'),
(18, 4, 'ADD', 'Add'),
(19, 1, 'EDIT', 'Modifier'),
(19, 2, 'EDIT', 'Edit'),
(19, 3, 'EDIT', 'تغيير'),
(19, 4, 'EDIT', 'Edit'),
(20, 1, 'INVALID_INPUT', 'Saisie invalide'),
(20, 2, 'INVALID_INPUT', 'Invalid input'),
(20, 3, 'INVALID_INPUT', 'إدخال غير صالح'),
(20, 4, 'INVALID_INPUT', 'Invalid input'),
(21, 1, 'MAIL_DELIVERY_FAILURE', 'Echec lors de l\'envoi du message.'),
(21, 2, 'MAIL_DELIVERY_FAILURE', 'A failure occurred during the delivery of this message.'),
(21, 3, 'MAIL_DELIVERY_FAILURE', 'حدث فشل أثناء تسليم هذه الرسالة.'),
(21, 4, 'MAIL_DELIVERY_FAILURE', 'A failure occurred during the delivery of this message.'),
(22, 1, 'MAIL_DELIVERY_SUCCESS', 'Merci de votre intérêt, votre message a bien été envoyé.\nNous vous contacterons dans les plus brefs délais.'),
(22, 2, 'MAIL_DELIVERY_SUCCESS', 'Thank you for your interest, your message has been sent.\nWe will contact you as soon as possible.'),
(22, 3, 'MAIL_DELIVERY_SUCCESS', 'خزان لاهتمامك ، تم إرسال رسالتك . سوف نتصل بك في أقرب وقت ممكن .'),
(22, 4, 'MAIL_DELIVERY_SUCCESS', 'Thank you for your interest, your message has been sent.\nWe will contact you as soon as possible.'),
(23, 1, 'SEND', 'Envoyer'),
(23, 2, 'SEND', 'Send'),
(23, 3, 'SEND', 'ارسل انت'),
(23, 4, 'SEND', 'Send'),
(24, 1, 'FORM_ERRORS', 'Le formulaire comporte des erreurs.'),
(24, 2, 'FORM_ERRORS', 'The following form contains some errors.'),
(24, 3, 'FORM_ERRORS', 'النموذج التالي يحتوي على بعض الأخطاء.'),
(24, 4, 'FORM_ERRORS', 'The following form contains some errors.'),
(25, 1, 'FROM_DATE', 'Du'),
(25, 2, 'FROM_DATE', 'From'),
(25, 3, 'FROM_DATE', 'من'),
(25, 4, 'FROM_DATE', 'Başlangıç'),
(26, 1, 'TO_DATE', 'au'),
(26, 2, 'TO_DATE', 'till'),
(26, 3, 'TO_DATE', 'حتى'),
(26, 4, 'TO_DATE', 'Bitiş'),
(27, 1, 'FROM', 'De'),
(27, 2, 'FROM', 'From'),
(27, 3, 'FROM', 'من'),
(27, 4, 'FROM', 'From'),
(28, 1, 'TO', 'à'),
(28, 2, 'TO', 'to'),
(28, 3, 'TO', 'إلى'),
(28, 4, 'TO', 'to'),
(29, 1, 'BOOK', 'Réserver'),
(29, 2, 'BOOK', 'Book'),
(29, 3, 'BOOK', 'للحجز'),
(29, 4, 'BOOK', 'Kurs Merkezine Kayıt Ol'),
(30, 1, 'READMORE', 'Lire la suite'),
(30, 2, 'READMORE', 'Read more'),
(30, 3, 'READMORE', 'اقرأ المزيد'),
(30, 4, 'READMORE', 'Daha Fazlası'),
(31, 1, 'BACK', 'Retour'),
(31, 2, 'BACK', 'Back'),
(31, 3, 'BACK', 'عودة'),
(31, 4, 'BACK', 'Back'),
(32, 1, 'DISCOVER', 'Découvrir'),
(32, 2, 'DISCOVER', 'Discover'),
(32, 3, 'DISCOVER', 'اكتشف'),
(32, 4, 'DISCOVER', 'Discover'),
(33, 1, 'ALL', 'Tous'),
(33, 2, 'ALL', 'All'),
(33, 3, 'ALL', 'كل'),
(33, 4, 'ALL', 'All'),
(34, 1, 'ALL_RIGHTS_RESERVED', 'Tous droits réservés'),
(34, 2, 'ALL_RIGHTS_RESERVED', 'All rights reserved'),
(34, 3, 'ALL_RIGHTS_RESERVED', 'جميع الحقوق محفوظه'),
(34, 4, 'ALL_RIGHTS_RESERVED', 'All rights reserved'),
(35, 1, 'FORGOTTEN_PASSWORD', 'Mot de passe oublié ?'),
(35, 2, 'FORGOTTEN_PASSWORD', 'Forgotten password?'),
(35, 3, 'FORGOTTEN_PASSWORD', 'هل نسيت كلمة المرور؟'),
(35, 4, 'FORGOTTEN_PASSWORD', 'Forgotten password?'),
(36, 1, 'LOG_IN', 'Connexion'),
(36, 2, 'LOG_IN', 'Log in'),
(36, 3, 'LOG_IN', 'تسجيل الدخول'),
(36, 4, 'LOG_IN', 'Giriş Yap'),
(37, 1, 'SIGN_UP', 'Inscription'),
(37, 2, 'SIGN_UP', 'Sign up'),
(37, 3, 'SIGN_UP', 'تسجيل'),
(37, 4, 'SIGN_UP', 'Kayıt Ol'),
(38, 1, 'LOG_OUT', 'Déconnexion'),
(38, 2, 'LOG_OUT', 'Log out'),
(38, 3, 'LOG_OUT', 'تسجيل الخروج'),
(38, 4, 'LOG_OUT', 'Log out'),
(39, 1, 'SEARCH', 'Rechercher'),
(39, 2, 'SEARCH', 'Search'),
(39, 3, 'SEARCH', 'ابحث عن'),
(39, 4, 'SEARCH', 'Search'),
(40, 1, 'RESET_PASS_SUCCESS', 'Votre nouveau mot de passe vous a été envoyé sur votre adresse e-mail.'),
(40, 2, 'RESET_PASS_SUCCESS', 'Your new password was sent to you on your e-mail.'),
(40, 3, 'RESET_PASS_SUCCESS', 'تم إرسال كلمة المرور الجديدة إلى عنوان البريد الإلكتروني الخاص بك'),
(40, 4, 'RESET_PASS_SUCCESS', 'Your new password was sent to you on your e-mail.'),
(41, 1, 'PASS_TOO_SHORT', 'Le mot de passe doit contenir 6 caractères au minimum'),
(41, 2, 'PASS_TOO_SHORT', 'The password must contain 6 characters at least'),
(41, 3, 'PASS_TOO_SHORT', 'يجب أن يحتوي على كلمة المرور ستة أحرف على الأقل'),
(41, 4, 'PASS_TOO_SHORT', 'The password must contain 6 characters at least'),
(42, 1, 'PASS_DONT_MATCH', 'Les mots de passe doivent correspondre'),
(42, 2, 'PASS_DONT_MATCH', 'The passwords don\'t match'),
(42, 3, 'PASS_DONT_MATCH', 'يجب أن تتطابق كلمات المرور'),
(42, 4, 'PASS_DONT_MATCH', 'The passwords don\'t match'),
(43, 1, 'ACCOUNT_EXISTS', 'Un compte existe déjà avec cette adresse e-mail'),
(43, 2, 'ACCOUNT_EXISTS', 'An account already exists with this e-mail'),
(43, 3, 'ACCOUNT_EXISTS', 'حساب موجود بالفعل مع هذا عنوان البريد الإلكتروني'),
(43, 4, 'ACCOUNT_EXISTS', 'An account already exists with this e-mail'),
(44, 1, 'ACCOUNT_CREATED', 'Votre compte a bien été créé. Vous allez recevoir un email de confirmation. Cliquez sur le lien de cet e-mail pour confirmer votre compte avant de continuer.'),
(44, 2, 'ACCOUNT_CREATED', 'Your account has been created. You will receive a confirmation email. Click on the link in this email to confirm your account before continuing.'),
(44, 3, 'ACCOUNT_CREATED', 'Your account has been created. You will receive a confirmation email. Click on the link in this email to confirm your account before continuing.'),
(44, 4, 'ACCOUNT_CREATED', 'Your account has been created. You will receive a confirmation email. Click on the link in this email to confirm your account before continuing.'),
(45, 1, 'INCORRECT_LOGIN', 'Les informations de connexion sont incorrectes.'),
(45, 2, 'INCORRECT_LOGIN', 'Incorrect login information.'),
(45, 3, 'INCORRECT_LOGIN', 'معلومات تسجيل الدخول غير صحيحة.'),
(45, 4, 'INCORRECT_LOGIN', 'Incorrect login information.'),
(46, 1, 'I_SIGN_UP', 'Je m\'inscris'),
(46, 2, 'I_SIGN_UP', 'I sign up'),
(46, 3, 'I_SIGN_UP', 'يمكنني الاشتراك'),
(46, 4, 'I_SIGN_UP', 'I sign up'),
(47, 1, 'ALREADY_HAVE_ACCOUNT', 'J\'ai déjà un compte'),
(47, 2, 'ALREADY_HAVE_ACCOUNT', 'I already have an account'),
(47, 3, 'ALREADY_HAVE_ACCOUNT', 'لدي بالفعل حساب'),
(47, 4, 'ALREADY_HAVE_ACCOUNT', 'Üyeyim'),
(48, 1, 'MY_ACCOUNT', 'Mon compte'),
(48, 2, 'MY_ACCOUNT', 'My account'),
(48, 3, 'MY_ACCOUNT', 'حسابي'),
(48, 4, 'MY_ACCOUNT', 'Kişisel Bilgiler'),
(49, 1, 'COMMENTS', 'Commentaires'),
(49, 2, 'COMMENTS', 'Comments'),
(49, 3, 'COMMENTS', 'تعليقات'),
(49, 4, 'COMMENTS', 'Yorumlar'),
(50, 1, 'LET_US_KNOW', 'Faîtes-nous savoir ce que vous pensez'),
(50, 2, 'LET_US_KNOW', 'Let us know what you think'),
(50, 3, 'LET_US_KNOW', 'ماذا عن رايك؟'),
(50, 4, 'LET_US_KNOW', 'Let us know what you think'),
(51, 1, 'COMMENT_SUCCESS', 'Merci de votre intérêt, votre commentaire va être soumis à validation.'),
(51, 2, 'COMMENT_SUCCESS', 'Thank you for your interest, your comment will be checked.'),
(51, 3, 'COMMENT_SUCCESS', 'شكرا ل اهتمامك، و سيتم التحقق من صحة للتعليق.'),
(51, 4, 'COMMENT_SUCCESS', 'Thank you for your interest, your comment will be checked.'),
(52, 1, 'NO_SEARCH_RESULT', 'Aucun résultat. Vérifiez l\'orthographe des termes de recherche (> 3 caractères) ou essayez d\'autres mots.'),
(52, 2, 'NO_SEARCH_RESULT', 'No result. Check the spelling terms of search (> 3 characters) or try other words.'),
(52, 3, 'NO_SEARCH_RESULT', 'لا نتيجة. التدقيق الإملائي للكلمات (أكثر من ثلاثة أحرف ) أو محاولة بعبارة أخرى .'),
(52, 4, 'NO_SEARCH_RESULT', 'No result. Check the spelling terms of search (> 3 characters) or try other words.'),
(53, 1, 'SEARCH_EXCEEDED', 'Nombre de recherches dépassé.'),
(53, 2, 'SEARCH_EXCEEDED', 'Number of researches exceeded.'),
(53, 3, 'SEARCH_EXCEEDED', 'عدد من الأبحاث السابقة .'),
(53, 4, 'SEARCH_EXCEEDED', 'Number of researches exceeded.'),
(54, 1, 'SECONDS', 'secondes'),
(54, 2, 'SECONDS', 'seconds'),
(54, 3, 'SECONDS', 'ثواني'),
(54, 4, 'SECONDS', 'seconds'),
(55, 1, 'FOR_A_TOTAL_OF', 'sur un total de'),
(55, 2, 'FOR_A_TOTAL_OF', 'for a total of'),
(55, 3, 'FOR_A_TOTAL_OF', 'من الكل'),
(55, 4, 'FOR_A_TOTAL_OF', 'for a total of'),
(56, 1, 'COMMENT', 'Commentaire'),
(56, 2, 'COMMENT', 'Comment'),
(56, 3, 'COMMENT', 'تعقيب'),
(56, 4, 'COMMENT', 'Comment'),
(57, 1, 'VIEW', 'Visionner'),
(57, 2, 'VIEW', 'View'),
(57, 3, 'VIEW', 'ل عرض'),
(57, 4, 'VIEW', 'View'),
(58, 1, 'RECENT_ARTICLES', 'Articles récents'),
(58, 2, 'RECENT_ARTICLES', 'Recent articles'),
(58, 3, 'RECENT_ARTICLES', 'المقالات الأخيرة'),
(58, 4, 'RECENT_ARTICLES', 'Recent articles'),
(59, 1, 'RSS_FEED', 'Flux RSS'),
(59, 2, 'RSS_FEED', 'RSS feed'),
(59, 3, 'RSS_FEED', 'تغذية RSS'),
(59, 4, 'RSS_FEED', 'RSS feed'),
(60, 1, 'COUNTRY', 'Pays'),
(60, 2, 'COUNTRY', 'Country'),
(60, 3, 'COUNTRY', 'Country'),
(60, 4, 'COUNTRY', 'Ülke'),
(61, 1, 'ROOM', 'Chambre'),
(61, 2, 'ROOM', 'Room'),
(61, 3, 'ROOM', 'Room'),
(61, 4, 'ROOM', 'Sınıf'),
(62, 1, 'INCL_VAT', 'TTC'),
(62, 2, 'INCL_VAT', 'incl. VAT'),
(62, 3, 'INCL_VAT', 'incl. VAT'),
(62, 4, 'INCL_VAT', 'incl. VAT'),
(63, 1, 'NIGHTS', 'nuits'),
(63, 2, 'NIGHTS', 'nights'),
(63, 3, 'NIGHTS', 'nights'),
(63, 4, 'NIGHTS', 'Yıllık'),
(64, 1, 'ADULTS', 'Adultes'),
(64, 2, 'ADULTS', 'Adults'),
(64, 3, 'ADULTS', 'Adults'),
(64, 4, 'ADULTS', 'Öğrenci'),
(65, 1, 'CHILDREN', 'Enfants'),
(65, 2, 'CHILDREN', 'Children'),
(65, 3, 'CHILDREN', 'Children'),
(65, 4, 'CHILDREN', 'Veli'),
(66, 1, 'PERSONS', 'personnes'),
(66, 2, 'PERSONS', 'persons'),
(66, 3, 'PERSONS', 'persons'),
(66, 4, 'PERSONS', 'Kişiler'),
(67, 1, 'CONTACT_DETAILS', 'Coordonnées'),
(67, 2, 'CONTACT_DETAILS', 'Contact details'),
(67, 3, 'CONTACT_DETAILS', 'Contact details'),
(67, 4, 'CONTACT_DETAILS', 'Contact details'),
(68, 1, 'NO_AVAILABILITY', 'Aucune disponibilité'),
(68, 2, 'NO_AVAILABILITY', 'No availability'),
(68, 3, 'NO_AVAILABILITY', 'No availability'),
(68, 4, 'NO_AVAILABILITY', 'No availability'),
(69, 1, 'AVAILABILITIES', 'Disponibilités'),
(69, 2, 'AVAILABILITIES', 'Availabilities'),
(69, 3, 'AVAILABILITIES', 'Availabilities'),
(69, 4, 'AVAILABILITIES', 'Availabilities'),
(70, 1, 'CHECK', 'Vérifier'),
(70, 2, 'CHECK', 'Check'),
(70, 3, 'CHECK', 'Check'),
(70, 4, 'CHECK', 'Check'),
(71, 1, 'BOOKING_DETAILS', 'Détails de la réservation'),
(71, 2, 'BOOKING_DETAILS', 'Booking details'),
(71, 3, 'BOOKING_DETAILS', 'Booking details'),
(71, 4, 'BOOKING_DETAILS', 'Kayıt .Detayları'),
(72, 1, 'SPECIAL_REQUESTS', 'Demandes spéciales'),
(72, 2, 'SPECIAL_REQUESTS', 'Special requests'),
(72, 3, 'SPECIAL_REQUESTS', 'Special requests'),
(72, 4, 'SPECIAL_REQUESTS', 'Notunuz ( Varsa )'),
(73, 1, 'PREVIOUS_STEP', 'Étape précédente'),
(73, 2, 'PREVIOUS_STEP', 'Previous step'),
(73, 3, 'PREVIOUS_STEP', 'Previous step'),
(73, 4, 'PREVIOUS_STEP', 'Previous step'),
(74, 1, 'CONFIRM_BOOKING', 'Confirmer la réservation'),
(74, 2, 'CONFIRM_BOOKING', 'Confirm the booking'),
(74, 3, 'CONFIRM_BOOKING', 'Confirm the booking'),
(74, 4, 'CONFIRM_BOOKING', 'Confirm the booking'),
(75, 1, 'ALSO_DISCOVER', 'Découvrez aussi'),
(75, 2, 'ALSO_DISCOVER', 'Also discover'),
(75, 3, 'ALSO_DISCOVER', 'Also discover'),
(75, 4, 'ALSO_DISCOVER', 'Also discover'),
(76, 1, 'CHECK_PEOPLE', 'Merci de vérifier le nombre de personnes pour l\'hébergement choisi.'),
(76, 2, 'CHECK_PEOPLE', 'Please verify the number of people for the chosen accommodation'),
(76, 3, 'CHECK_PEOPLE', 'Please verify the number of people for the chosen accommodation'),
(76, 4, 'CHECK_PEOPLE', 'Please verify the number of people for the chosen accommodation'),
(77, 1, 'BOOKING', 'Réservation'),
(77, 2, 'BOOKING', 'Booking'),
(77, 3, 'BOOKING', 'Booking'),
(77, 4, 'BOOKING', 'Booking'),
(78, 1, 'NIGHT', 'nuit'),
(78, 2, 'NIGHT', 'night'),
(78, 3, 'NIGHT', 'night'),
(78, 4, 'NIGHT', 'Yıllık'),
(79, 1, 'WEEK', 'semaine'),
(79, 2, 'WEEK', 'week'),
(79, 3, 'WEEK', 'week'),
(79, 4, 'WEEK', 'week'),
(80, 1, 'EXTRA_SERVICES', 'Services supplémentaires'),
(80, 2, 'EXTRA_SERVICES', 'Extra services'),
(80, 3, 'EXTRA_SERVICES', 'Extra services'),
(80, 4, 'EXTRA_SERVICES', 'Extra services'),
(81, 1, 'BOOKING_TERMS', ''),
(81, 2, 'BOOKING_TERMS', ''),
(81, 3, 'BOOKING_TERMS', ''),
(81, 4, 'BOOKING_TERMS', ''),
(82, 1, 'NEXT_STEP', 'Étape suivante'),
(82, 2, 'NEXT_STEP', 'Next step'),
(82, 3, 'NEXT_STEP', 'Next step'),
(82, 4, 'NEXT_STEP', 'İleri'),
(83, 1, 'TOURIST_TAX', 'Taxe de séjour'),
(83, 2, 'TOURIST_TAX', 'Tourist tax'),
(83, 3, 'TOURIST_TAX', 'Tourist tax'),
(83, 4, 'TOURIST_TAX', 'Tourist tax'),
(84, 1, 'CHECK_IN', 'Arrivée'),
(84, 2, 'CHECK_IN', 'Check in'),
(84, 3, 'CHECK_IN', 'Check in'),
(84, 4, 'CHECK_IN', 'Başlangıç'),
(85, 1, 'CHECK_OUT', 'Départ'),
(85, 2, 'CHECK_OUT', 'Check out'),
(85, 3, 'CHECK_OUT', 'Check out'),
(85, 4, 'CHECK_OUT', 'Check out'),
(86, 1, 'TOTAL', 'Total'),
(86, 2, 'TOTAL', 'Total'),
(86, 3, 'TOTAL', 'Total'),
(86, 4, 'TOTAL', 'Toplam'),
(87, 1, 'CAPACITY', 'Capacité'),
(87, 2, 'CAPACITY', 'Capacity'),
(87, 3, 'CAPACITY', 'Capacity'),
(87, 4, 'CAPACITY', 'Kontenjan'),
(88, 1, 'FACILITIES', 'Équipements'),
(88, 2, 'FACILITIES', 'Facilities'),
(88, 3, 'FACILITIES', 'Facilities'),
(88, 4, 'FACILITIES', 'Facilities'),
(89, 1, 'PRICE', 'Prix'),
(89, 2, 'PRICE', 'Price'),
(89, 3, 'PRICE', 'Price'),
(89, 4, 'PRICE', 'Fiyat'),
(90, 1, 'MORE_DETAILS', 'Plus d\'infos'),
(90, 2, 'MORE_DETAILS', 'More details'),
(90, 3, 'MORE_DETAILS', 'More details'),
(90, 4, 'MORE_DETAILS', 'More details'),
(91, 1, 'FROM_PRICE', 'À partir de'),
(91, 2, 'FROM_PRICE', 'From'),
(91, 3, 'FROM_PRICE', 'From'),
(91, 4, 'FROM_PRICE', 'From'),
(92, 1, 'AMOUNT', 'Montant'),
(92, 2, 'AMOUNT', 'Amount'),
(92, 3, 'AMOUNT', 'Amount'),
(92, 4, 'AMOUNT', 'Amount'),
(93, 1, 'PAY', 'Payer'),
(93, 2, 'PAY', 'Check out'),
(93, 3, 'PAY', 'Check out'),
(93, 4, 'PAY', 'Check out'),
(94, 1, 'PAYMENT_PAYPAL_NOTICE', 'Cliquez sur \"Payer\" ci-dessous, vous allez être redirigé vers le site sécurisé de PayPal'),
(94, 2, 'PAYMENT_PAYPAL_NOTICE', 'Click on \"Check Out\" below, you will be redirected towards the secure site of PayPal'),
(94, 3, 'PAYMENT_PAYPAL_NOTICE', 'Click on \"Check Out\" below, you will be redirected towards the secure site of PayPal'),
(94, 4, 'PAYMENT_PAYPAL_NOTICE', 'Click on \"Check Out\" below, you will be redirected towards the secure site of PayPal'),
(95, 1, 'PAYMENT_CANCEL_NOTICE', 'Le paiement a été annulé.<br>Merci de votre visite et à bientôt.'),
(95, 2, 'PAYMENT_CANCEL_NOTICE', 'The payment has been cancelled.<br>Thank you for your visit and see you soon.'),
(95, 3, 'PAYMENT_CANCEL_NOTICE', 'The payment has been cancelled.<br>Thank you for your visit and see you soon.'),
(95, 4, 'PAYMENT_CANCEL_NOTICE', 'The payment has been cancelled.<br>Thank you for your visit and see you soon.'),
(96, 1, 'PAYMENT_SUCCESS_NOTICE', 'Le paiement a été réalisé avec succès.<br>Merci de votre visite et à bientôt !'),
(96, 2, 'PAYMENT_SUCCESS_NOTICE', 'Your payment has been successfully processed.<br>Thank you for your visit and see you soon!'),
(96, 3, 'PAYMENT_SUCCESS_NOTICE', 'Your payment has been successfully processed.<br>Thank you for your visit and see you soon!'),
(96, 4, 'PAYMENT_SUCCESS_NOTICE', 'Ödemeniz başarıyla gerçekleşti. <br> Ziyaretiniz için teşekkür ederiz !'),
(97, 1, 'BILLING_ADDRESS', 'Adresse de facturation'),
(97, 2, 'BILLING_ADDRESS', 'Billing address'),
(97, 3, 'BILLING_ADDRESS', 'Billing address'),
(97, 4, 'BILLING_ADDRESS', 'Fatura Adresi'),
(98, 1, 'DOWN_PAYMENT', 'Acompte'),
(98, 2, 'DOWN_PAYMENT', 'Down payment'),
(98, 3, 'DOWN_PAYMENT', 'Down payment'),
(98, 4, 'DOWN_PAYMENT', 'Down payment'),
(99, 1, 'PAYMENT_CHECK_NOTICE', 'Merci d\'envoyer un chèque à \"Panda Multi Resorts, Neeloafaru Magu, Maldives\" d\'un montant de {amount}.<br>Votre réservation sera validée à réception du paiement.<br>Merci de votre visite et à bientôt !'),
(99, 2, 'PAYMENT_CHECK_NOTICE', 'Thank you for sending a check of {amount} to \"Panda Multi Resorts, Neeloafaru Magu, Maldives\".<br>Your reservation will be confirmed upon receipt of the payment.<br>Thank you for your visit and see you soon!'),
(99, 3, 'PAYMENT_CHECK_NOTICE', 'Thank you for sending a check of {amount} to \"Panda Multi Resorts, Neeloafaru Magu, Maldives\".<br>Your reservation will be confirmed upon receipt of the payment.<br>Thank you for your visit and see you soon!'),
(99, 4, 'PAYMENT_CHECK_NOTICE', '\"KURSARABUL\" a {amount} tutarında bir ödeme gönderdiğiniz için teşekkür ederiz. <br> Rezervasyonunuz ödeme alındıktan sonra onaylanacaktır. <br> Ziyaretiniz için teşekkür ederiz !'),
(100, 1, 'PAYMENT_ARRIVAL_NOTICE', 'Veuillez régler le solde de votre réservation d\'un montant de {amount} à votre arrivée.<br>Merci de votre visite et à bientôt !'),
(100, 2, 'PAYMENT_ARRIVAL_NOTICE', 'Thank you for paying the balance of {amount} for your booking on your arrival.<br>Thank you for your visit and see you soon!'),
(100, 3, 'PAYMENT_ARRIVAL_NOTICE', 'Thank you for paying the balance of {amount} for your booking on your arrival.<br>Thank you for your visit and see you soon!'),
(100, 4, 'PAYMENT_ARRIVAL_NOTICE', 'Kurs Merkezi rezervasyonunuz için {amount} tutarındaki bakiyeyi ödediğiniz için teşekkür ederiz. <br> Ziyaretiniz için teşekkür ederiz!'),
(101, 1, 'MAX_PEOPLE', 'Pers. max'),
(101, 2, 'MAX_PEOPLE', 'Max people'),
(101, 3, 'MAX_PEOPLE', 'Max people'),
(101, 4, 'MAX_PEOPLE', 'Max people'),
(102, 1, 'VAT_AMOUNT', 'Dont TVA'),
(102, 2, 'VAT_AMOUNT', 'VAT amount'),
(102, 3, 'VAT_AMOUNT', 'VAT amount'),
(102, 4, 'VAT_AMOUNT', 'VAT amount'),
(103, 1, 'MIN_NIGHTS', 'Nuits min'),
(103, 2, 'MIN_NIGHTS', 'Min nights'),
(103, 3, 'MIN_NIGHTS', 'Min nights'),
(103, 4, 'MIN_NIGHTS', 'Min nights'),
(104, 1, 'ROOMS', 'Chambres'),
(104, 2, 'ROOMS', 'Rooms'),
(104, 3, 'ROOMS', 'Rooms'),
(104, 4, 'ROOMS', 'Sınıflar'),
(105, 1, 'RATINGS', 'Note(s)'),
(105, 2, 'RATINGS', 'Rating(s)'),
(105, 3, 'RATINGS', 'Rating(s)'),
(105, 4, 'RATINGS', 'Rating(s)'),
(106, 1, 'MIN_PEOPLE', 'Pers. min'),
(106, 2, 'MIN_PEOPLE', 'Min people'),
(106, 3, 'MIN_PEOPLE', 'Min people'),
(106, 4, 'MIN_PEOPLE', 'Min people'),
(107, 1, 'HOTEL', 'Hôtel'),
(107, 2, 'HOTEL', 'Okul'),
(107, 3, 'HOTEL', 'Hotel'),
(107, 4, 'HOTEL', 'Kurs Merkezi'),
(108, 1, 'MAKE_A_REQUEST', 'Faire une demande'),
(108, 2, 'MAKE_A_REQUEST', 'Make a request'),
(108, 3, 'MAKE_A_REQUEST', 'Make a request'),
(108, 4, 'MAKE_A_REQUEST', 'Make a request'),
(109, 1, 'FULLNAME', 'Nom complet'),
(109, 2, 'FULLNAME', 'Full Name'),
(109, 3, 'FULLNAME', 'Full Name'),
(109, 4, 'FULLNAME', 'Full Name'),
(110, 1, 'PASSWORD', 'Mot de passe'),
(110, 2, 'PASSWORD', 'Password'),
(110, 3, 'PASSWORD', 'Password'),
(110, 4, 'PASSWORD', 'Password'),
(111, 1, 'LOG_IN_WITH_FACEBOOK', 'Enregistrez-vous avec Facebook'),
(111, 2, 'LOG_IN_WITH_FACEBOOK', 'Log in with Facebook'),
(111, 3, 'LOG_IN_WITH_FACEBOOK', 'Log in with Facebook'),
(111, 4, 'LOG_IN_WITH_FACEBOOK', 'Log in with Facebook'),
(112, 1, 'OR', 'Ou'),
(112, 2, 'OR', 'Or'),
(112, 3, 'OR', 'Or'),
(112, 4, 'OR', 'Or'),
(113, 1, 'NEW_PASSWORD', 'Nouveau mot de passe'),
(113, 2, 'NEW_PASSWORD', 'New password'),
(113, 3, 'NEW_PASSWORD', 'New password'),
(113, 4, 'NEW_PASSWORD', 'New password'),
(114, 1, 'NEW_PASSWORD_NOTICE', 'Merci d\'entrer l\'adresse e-mail correspondant à votre compte. Un nouveau mot de passe vous sera envoyé par e-mail.'),
(114, 2, 'NEW_PASSWORD_NOTICE', 'Please enter your e-mail address corresponding to your account. A new password will be sent to you by e-mail.'),
(114, 3, 'NEW_PASSWORD_NOTICE', 'Please enter your e-mail address corresponding to your account. A new password will be sent to you by e-mail.'),
(114, 4, 'NEW_PASSWORD_NOTICE', 'Please enter your e-mail address corresponding to your account. A new password will be sent to you by e-mail.'),
(115, 1, 'USERNAME', 'Utilisateur'),
(115, 2, 'USERNAME', 'Username'),
(115, 3, 'USERNAME', 'Username'),
(115, 4, 'USERNAME', 'Kullanıcı Adı'),
(116, 1, 'PASSWORD_CONFIRM', 'Confirmer mot de passe'),
(116, 2, 'PASSWORD_CONFIRM', 'Confirm password'),
(116, 3, 'PASSWORD_CONFIRM', 'Confirm password'),
(116, 4, 'PASSWORD_CONFIRM', 'Confirm password'),
(117, 1, 'USERNAME_EXISTS', 'Un compte existe déjà avec ce nom d\'utilisateur'),
(117, 2, 'USERNAME_EXISTS', 'An account already exists with this username'),
(117, 3, 'USERNAME_EXISTS', 'An account already exists with this username'),
(117, 4, 'USERNAME_EXISTS', 'Bu kullanıcı adı daha önce kayıt edilmiş.'),
(118, 1, 'ACCOUNT_EDIT_SUCCESS', 'Les informations de votre compte ont bien été modifiées.'),
(118, 2, 'ACCOUNT_EDIT_SUCCESS', 'Your account information have been changed.'),
(118, 3, 'ACCOUNT_EDIT_SUCCESS', 'Your account information have been changed.'),
(118, 4, 'ACCOUNT_EDIT_SUCCESS', 'Your account information have been changed.'),
(119, 1, 'ACCOUNT_EDIT_FAILURE', 'Echec de la modification des informations de compte.'),
(119, 2, 'ACCOUNT_EDIT_FAILURE', 'An error occured during the modification of the account information.'),
(119, 3, 'ACCOUNT_EDIT_FAILURE', 'An error occured during the modification of the account information.'),
(119, 4, 'ACCOUNT_EDIT_FAILURE', 'An error occured during the modification of the account information.'),
(120, 1, 'ACCOUNT_CREATE_FAILURE', 'Echec de la création du compte.'),
(120, 2, 'ACCOUNT_CREATE_FAILURE', 'Failed to create account.'),
(120, 3, 'ACCOUNT_CREATE_FAILURE', 'Failed to create account.'),
(120, 4, 'ACCOUNT_CREATE_FAILURE', 'Failed to create account.'),
(121, 1, 'PAYMENT_CHECK', 'Par chèque'),
(121, 2, 'PAYMENT_CHECK', 'By check'),
(121, 3, 'PAYMENT_CHECK', 'By check'),
(121, 4, 'PAYMENT_CHECK', 'By check'),
(122, 1, 'PAYMENT_ARRIVAL', 'A l\'arrivée'),
(122, 2, 'PAYMENT_ARRIVAL', 'On arrival'),
(122, 3, 'PAYMENT_ARRIVAL', 'On arrival'),
(122, 4, 'PAYMENT_ARRIVAL', 'Kapıda Ödeme'),
(123, 1, 'CHOOSE_PAYMENT', 'Choisissez un moyen de paiement'),
(123, 2, 'CHOOSE_PAYMENT', 'Choose a method of payment'),
(123, 3, 'CHOOSE_PAYMENT', 'Choose a method of payment'),
(123, 4, 'CHOOSE_PAYMENT', 'Choose a method of payment'),
(124, 1, 'PAYMENT_CREDIT_CARDS', 'Cartes de credit'),
(124, 2, 'PAYMENT_CREDIT_CARDS', 'Credit cards'),
(124, 3, 'PAYMENT_CREDIT_CARDS', 'Credit cards'),
(124, 4, 'PAYMENT_CREDIT_CARDS', 'Credit cards'),
(125, 1, 'MAX_ADULTS', 'Adultes max'),
(125, 2, 'MAX_ADULTS', 'Max adults'),
(125, 3, 'MAX_ADULTS', 'Max adults'),
(125, 4, 'MAX_ADULTS', 'Max Öğrenci'),
(126, 1, 'MAX_CHILDREN', 'Enfants max'),
(126, 2, 'MAX_CHILDREN', 'Max children'),
(126, 3, 'MAX_CHILDREN', 'Max children'),
(126, 4, 'MAX_CHILDREN', 'Max children'),
(127, 1, 'PAYMENT_2CHECKOUT_NOTICE', 'Cliquez sur \"Payer\" ci-dessous, vous allez être redirigé vers le site sécurisé de 2Checkout.com'),
(127, 2, 'PAYMENT_2CHECKOUT_NOTICE', 'Click on \"Check Out\" below, you will be redirected towards the secure site of 2Checkout.com'),
(127, 3, 'PAYMENT_2CHECKOUT_NOTICE', 'Click on \"Check Out\" below, you will be redirected towards the secure site of 2Checkout.com'),
(127, 4, 'PAYMENT_2CHECKOUT_NOTICE', 'Click on \"Check Out\" below, you will be redirected towards the secure site of 2Checkout.com'),
(128, 1, 'COOKIES_NOTICE', 'Les cookies nous aident à fournir une meilleure expérience utilisateur. En utilisant notre site, vous acceptez l\'utilisation de cookies.'),
(128, 2, 'COOKIES_NOTICE', 'Cookies help us provide better user experience. By using our website, you agree to the use of cookies.'),
(128, 3, 'COOKIES_NOTICE', 'Cookies help us provide better user experience. By using our website, you agree to the use of cookies.'),
(128, 4, 'COOKIES_NOTICE', 'Cookies help us provide better user experience. By using our website, you agree to the use of cookies.'),
(129, 1, 'DURATION', 'Durée'),
(129, 2, 'DURATION', 'Duration'),
(129, 3, 'DURATION', 'Duration'),
(129, 4, 'DURATION', 'Duration'),
(130, 1, 'PERSON', 'Personne'),
(130, 2, 'PERSON', 'Person'),
(130, 3, 'PERSON', 'Person'),
(130, 4, 'PERSON', 'Kişi'),
(131, 1, 'CHOOSE_A_DATE', 'Choisissez une date'),
(131, 2, 'CHOOSE_A_DATE', 'Choose a date'),
(131, 3, 'CHOOSE_A_DATE', 'Choose a date'),
(131, 4, 'CHOOSE_A_DATE', 'Choose a date'),
(132, 1, 'TIMESLOT', 'Horaire'),
(132, 2, 'TIMESLOT', 'Time slot'),
(132, 3, 'TIMESLOT', 'Time slot'),
(132, 4, 'TIMESLOT', 'Time slot'),
(133, 1, 'ACTIVITIES', 'Activités'),
(133, 2, 'ACTIVITIES', 'Activities'),
(133, 3, 'ACTIVITIES', 'Activities'),
(133, 4, 'ACTIVITIES', 'Activities'),
(134, 1, 'DESTINATION', 'Destination'),
(134, 2, 'DESTINATION', 'Destination'),
(134, 3, 'DESTINATION', 'Destination'),
(134, 4, 'DESTINATION', 'Destination'),
(135, 1, 'NO_HOTEL_FOUND', 'Aucun hotel trouvé'),
(135, 2, 'NO_HOTEL_FOUND', 'No hotel found'),
(135, 3, 'NO_HOTEL_FOUND', 'No hotel found'),
(135, 4, 'NO_HOTEL_FOUND', 'Kurs Merkezi Bulunamadı'),
(136, 1, 'FOR', 'pour'),
(136, 2, 'FOR', 'for'),
(136, 3, 'FOR', 'for'),
(136, 4, 'FOR', 'for'),
(137, 1, 'FIND_ACTIVITIES_AND_TOURS', 'Découvrez nos activités et excursions'),
(137, 2, 'FIND_ACTIVITIES_AND_TOURS', 'Find out our activities and tours'),
(137, 3, 'FIND_ACTIVITIES_AND_TOURS', 'Find out our activities and tours'),
(137, 4, 'FIND_ACTIVITIES_AND_TOURS', 'Find out our activities and tours'),
(138, 1, 'MINUTES', 'minute(s)'),
(138, 2, 'MINUTES', 'minute(s)'),
(138, 3, 'MINUTES', 'minute(s)'),
(138, 4, 'MINUTES', 'minute(s)'),
(139, 1, 'HOURS', 'heure(s)'),
(139, 2, 'HOURS', 'hour(s)'),
(139, 3, 'HOURS', 'hour(s)'),
(139, 4, 'HOURS', 'hour(s)'),
(140, 1, 'DAYS', 'jour(s)'),
(140, 2, 'DAYS', 'day(s)'),
(140, 3, 'DAYS', 'day(s)'),
(140, 4, 'DAYS', 'day(s)'),
(141, 1, 'WEEKS', 'semaine(s)'),
(141, 2, 'WEEKS', 'week(s)'),
(141, 3, 'WEEKS', 'week(s)'),
(141, 4, 'WEEKS', 'week(s)'),
(142, 1, 'RESULTS', 'Résultats'),
(142, 2, 'RESULTS', 'Results'),
(142, 3, 'RESULTS', 'Results'),
(142, 4, 'RESULTS', 'Results'),
(143, 1, 'BOOKING_HISTORY', 'Historique des réservations'),
(143, 2, 'BOOKING_HISTORY', 'Booking history'),
(143, 3, 'BOOKING_HISTORY', 'Booking history'),
(143, 4, 'BOOKING_HISTORY', 'Rezervasyon Geçmişi'),
(144, 1, 'BOOKING_SUMMARY', 'Résumé de la réservation'),
(144, 2, 'BOOKING_SUMMARY', 'Booking summary'),
(144, 3, 'BOOKING_SUMMARY', 'Booking summary'),
(144, 4, 'BOOKING_SUMMARY', 'Özet'),
(145, 1, 'BOOKING_DATE', 'Date de la réservations'),
(145, 2, 'BOOKING_DATE', 'Booking date'),
(145, 3, 'BOOKING_DATE', 'Booking date'),
(145, 4, 'BOOKING_DATE', 'Rezervasyon Tarihi'),
(146, 1, 'NO_BOOKING_YET', 'Pas encore de réservation...'),
(146, 2, 'NO_BOOKING_YET', 'No booking yet...'),
(146, 3, 'NO_BOOKING_YET', 'No booking yet...'),
(146, 4, 'NO_BOOKING_YET', 'Rezervasyon Yok'),
(147, 1, 'PAYMENT', 'Paiement'),
(147, 2, 'PAYMENT', 'Payment'),
(147, 3, 'PAYMENT', 'Payment'),
(147, 4, 'PAYMENT', 'Ödeme'),
(148, 1, 'PAYMENT_DATE', 'Date du paiement'),
(148, 2, 'PAYMENT_DATE', 'Payment date'),
(148, 3, 'PAYMENT_DATE', 'Payment date'),
(148, 4, 'PAYMENT_DATE', 'Payment date'),
(149, 1, 'PAYMENT_METHOD', 'Méthode de paiement'),
(149, 2, 'PAYMENT_METHOD', 'Payment method'),
(149, 3, 'PAYMENT_METHOD', 'Payment method'),
(149, 4, 'PAYMENT_METHOD', 'Ödeme Metodu'),
(150, 1, 'NUM_TRANSACTION', 'N°transaction'),
(150, 2, 'NUM_TRANSACTION', 'Num. transaction'),
(150, 3, 'NUM_TRANSACTION', 'Num. transaction'),
(150, 4, 'NUM_TRANSACTION', 'Num. transaction'),
(151, 1, 'STATUS', 'Statut'),
(151, 2, 'STATUS', 'Status'),
(151, 3, 'STATUS', 'Status'),
(151, 4, 'STATUS', 'Durum'),
(152, 1, 'AWAITING', 'En attente'),
(152, 2, 'AWAITING', 'Awaiting'),
(152, 3, 'AWAITING', 'Awaiting'),
(152, 4, 'AWAITING', 'Bekleniyor'),
(153, 1, 'CANCELLED', 'Annulé'),
(153, 2, 'CANCELLED', 'Cancelled'),
(153, 3, 'CANCELLED', 'Cancelled'),
(153, 4, 'CANCELLED', 'İptal'),
(154, 1, 'REJECTED_PAYMENT', 'Paiement rejeté'),
(154, 2, 'REJECTED_PAYMENT', 'Rejected payment'),
(154, 3, 'REJECTED_PAYMENT', 'Rejected payment'),
(154, 4, 'REJECTED_PAYMENT', 'Ödeme Reddedildi.'),
(155, 1, 'PAYED', 'Payé'),
(155, 2, 'PAYED', 'Payed'),
(155, 3, 'PAYED', 'Payed'),
(155, 4, 'PAYED', 'Ödendi'),
(156, 1, 'INCL_TAX', 'TTC'),
(156, 2, 'INCL_TAX', 'incl. tax'),
(156, 3, 'INCL_TAX', 'incl. tax'),
(156, 4, 'INCL_TAX', 'incl. tax'),
(157, 1, 'TAGS', 'Tags'),
(157, 2, 'TAGS', 'Tags'),
(157, 3, 'TAGS', 'Tags'),
(157, 4, 'TAGS', 'Tags'),
(158, 1, 'ARCHIVES', 'Archives'),
(158, 2, 'ARCHIVES', 'Archives'),
(158, 3, 'ARCHIVES', 'Archives'),
(158, 4, 'ARCHIVES', 'Archives'),
(159, 1, 'STARS', 'Étoiles'),
(159, 2, 'STARS', 'Stars'),
(159, 3, 'STARS', 'Stars'),
(159, 4, 'STARS', 'Stars'),
(160, 1, 'HOTEL_CLASS', 'Catégorie d\'Hôtel'),
(160, 2, 'HOTEL_CLASS', 'Hotel Class'),
(160, 3, 'HOTEL_CLASS', 'Hotel Class'),
(160, 4, 'HOTEL_CLASS', 'Hotel Class'),
(161, 1, 'YOUR_BUDGET', 'Votre Budget'),
(161, 2, 'YOUR_BUDGET', 'Your Budget'),
(161, 3, 'YOUR_BUDGET', 'Your Budget'),
(161, 4, 'YOUR_BUDGET', 'Your Budget'),
(162, 1, 'LOAD_MORE', 'Voir plus'),
(162, 2, 'LOAD_MORE', 'Load more'),
(162, 3, 'LOAD_MORE', 'Load more'),
(162, 4, 'LOAD_MORE', 'Load more'),
(163, 1, 'DO_YOU_HAVE_A_COUPON', 'Avez-vous un code promo ?'),
(163, 2, 'DO_YOU_HAVE_A_COUPON', 'Do you have a coupon?'),
(163, 3, 'DO_YOU_HAVE_A_COUPON', 'Do you have a coupon?'),
(163, 4, 'DO_YOU_HAVE_A_COUPON', 'Kupona Sahip misiniz?'),
(164, 1, 'DISCOUNT', 'Réduction'),
(164, 2, 'DISCOUNT', 'Discount'),
(164, 3, 'DISCOUNT', 'Discount'),
(164, 4, 'DISCOUNT', 'Discount'),
(165, 1, 'COUPON_CODE_SUCCESS', 'Félicitations ! Le code promo a été ajouté avec succès.'),
(165, 2, 'COUPON_CODE_SUCCESS', 'Congratulations! The coupon code has been successfully added.'),
(165, 3, 'COUPON_CODE_SUCCESS', 'Congratulations! The coupon code has been successfully added.'),
(165, 4, 'COUPON_CODE_SUCCESS', 'Congratulations! The coupon code has been successfully added.'),
(166, 1, 'ROOMS', 'chambres'),
(166, 2, 'ROOMS', 'rooms'),
(166, 3, 'ROOMS', 'rooms'),
(166, 4, 'ROOMS', 'sınıflar'),
(167, 1, 'ADULT', 'adulte'),
(167, 2, 'ADULT', 'adult'),
(167, 3, 'ADULT', 'adult'),
(167, 4, 'ADULT', 'öğrenci'),
(168, 1, 'CHILD', 'enfant'),
(168, 2, 'CHILD', 'child'),
(168, 3, 'CHILD', 'child'),
(168, 4, 'CHILD', 'child'),
(169, 1, 'ACTIVITY', 'Activité'),
(169, 2, 'ACTIVITY', 'Activity'),
(169, 3, 'ACTIVITY', 'Activity'),
(169, 4, 'ACTIVITY', 'Activity'),
(170, 1, 'DATE', 'Date'),
(170, 2, 'DATE', 'Date'),
(170, 3, 'DATE', 'Date'),
(170, 4, 'DATE', 'Date'),
(171, 1, 'QUANTITY', 'Quantité'),
(171, 2, 'QUANTITY', 'Quantity'),
(171, 3, 'QUANTITY', 'Quantity'),
(171, 4, 'QUANTITY', 'Quantity'),
(172, 1, 'SERVICE', 'Service'),
(172, 2, 'SERVICE', 'Service'),
(172, 3, 'SERVICE', 'Service'),
(172, 4, 'SERVICE', 'Service'),
(173, 1, 'BOOKING_NOTICE', '<h2>Réservez sur notre site</h2><p class=\"lead mb0\">Dépêchez-vous ! Sélectionnez vos chambres, complétez votre réservation et profitez de nos packages et offres spéciales ! <br><b>Meilleur prix garanti !</b></p>'),
(173, 2, 'BOOKING_NOTICE', '<h2>Book on our website</h2><p class=\"lead mb0\">Hurry up! Select the your rooms, complete your booking and take advantage of our special offers and packages!<br><b>Best price guarantee!</b></p>'),
(173, 3, 'BOOKING_NOTICE', '<h2>Book on our website</h2><p class=\"lead mb0\">Hurry up! Select the your rooms, complete your booking and take advantage of our special offers and packages!<br><b>Best price guarantee!</b></p>'),
(173, 4, 'BOOKING_NOTICE', '<h2>Book on our website</h2><p class=\"lead mb0\">Hurry up! Select the your rooms, complete your booking and take advantage of our special offers and packages!<br><b>Best price guarantee!</b></p>'),
(174, 1, 'NUM_ROOMS', 'Nb chambres'),
(174, 2, 'NUM_ROOMS', 'Num rooms'),
(174, 3, 'NUM_ROOMS', 'Num rooms'),
(174, 4, 'NUM_ROOMS', 'Sınıf Sayısı'),
(175, 1, 'TOP_DESTINATIONS', 'Top Destinations'),
(175, 2, 'TOP_DESTINATIONS', 'Top Destinations'),
(175, 3, 'TOP_DESTINATIONS', 'Top Destinations'),
(175, 4, 'TOP_DESTINATIONS', 'Top Destinations'),
(176, 1, 'BEST_RATES_SUBTITLE', 'Meilleurs tarifs à partir de seulement {min_price}'),
(176, 2, 'BEST_RATES_SUBTITLE', 'Best rates starting at just {min_price}'),
(176, 3, 'BEST_RATES_SUBTITLE', 'Best rates starting at just {min_price}'),
(176, 4, 'BEST_RATES_SUBTITLE', 'Best rates starting at just {min_price}'),
(177, 1, 'CONTINUE_AS_GUEST', 'Continuer sans m\'enregistrer'),
(177, 2, 'CONTINUE_AS_GUEST', 'Continue as guest'),
(177, 3, 'CONTINUE_AS_GUEST', 'Continue as guest'),
(177, 4, 'CONTINUE_AS_GUEST', 'Continue as guest'),
(178, 1, 'PRIVACY_POLICY_AGREEMENT', '<small>J\'accepte que les informations recueillies par ce formulaire soient stockées dans un fichier informatisé afin de traiter ma demande.<br>Conformément au \"Réglement Général sur la Protection des Données\", vous pouvez exercer votre droit d\'accès aux données vous concernant et les faire rectifier via le formulaire de contact.</small>'),
(178, 2, 'PRIVACY_POLICY_AGREEMENT', '<small>I agree that the information collected by this form will be stored in a database in order to process my request.<br>In accordance with the \"General Data Protection Regulation\", you can exercise your right to access to your data and make them rectified via the contact form.</small>'),
(178, 3, 'PRIVACY_POLICY_AGREEMENT', '<small>I agree that the information collected by this form will be stored in a database in order to process my request.<br>In accordance with the \"General Data Protection Regulation\", you can exercise your right to access to your data and make them rectified via the contact form.</small>'),
(178, 4, 'PRIVACY_POLICY_AGREEMENT', '<small>Bu formla toplanan bilgilerin talebimi işleme koymak için bir veri tabanında saklanacağını kabul ediyorum..<br>\"Genel Veri Koruma Yönetmeliği\" uyarınca, verilerinize erişim hakkınızı kullanabilir ve iletişim formu aracılığıyla düzeltilmesini sağlayabilirsiniz..</small>'),
(179, 1, 'COMPLETE_YOUR_BOOKING', 'Terminez votre réservation !'),
(179, 2, 'COMPLETE_YOUR_BOOKING', 'Complete your booking!'),
(179, 3, 'COMPLETE_YOUR_BOOKING', 'Complete your booking!'),
(179, 4, 'COMPLETE_YOUR_BOOKING', 'Complete your booking!'),
(180, 1, 'CHILDREN_AGE', 'Age des enfants'),
(180, 2, 'CHILDREN_AGE', 'Age of children'),
(180, 3, 'CHILDREN_AGE', 'Age of children'),
(180, 4, 'CHILDREN_AGE', '-'),
(181, 1, 'I_AM_HOTEL_OWNER', 'Je suis propriétaire'),
(181, 2, 'I_AM_HOTEL_OWNER', 'I am a hotel owner'),
(181, 3, 'I_AM_HOTEL_OWNER', 'I am a hotel owner'),
(181, 4, 'I_AM_HOTEL_OWNER', 'Kurs Merkezi Yöneticisi'),
(182, 1, 'I_AM_TRAVELER', 'Je suis vacancier'),
(182, 2, 'I_AM_TRAVELER', 'I am a traveler'),
(182, 3, 'I_AM_TRAVELER', 'I am a traveler'),
(182, 4, 'I_AM_TRAVELER', 'I am a traveler'),
(183, 1, 'BOOK_NOW', 'Réserver maintenant'),
(183, 2, 'BOOK_NOW', 'Book now'),
(183, 3, 'BOOK_NOW', 'Book now'),
(183, 4, 'BOOK_NOW', 'Book now'),
(184, 1, 'LOCATION', 'Emplacement'),
(184, 2, 'LOCATION', 'Location'),
(184, 3, 'LOCATION', 'Location'),
(184, 4, 'LOCATION', 'Location'),
(185, 1, 'DISCOVER_ALSO', 'Découvrez aussi'),
(185, 2, 'DISCOVER_ALSO', 'Discover also'),
(185, 3, 'DISCOVER_ALSO', 'Discover also'),
(185, 4, 'DISCOVER_ALSO', 'Discover also'),
(186, 1, 'PAYMENT_BRAINTREE_NOTICE', 'Remplissez le formulaire ci-dessous avec les informations de votre carte de crédit, puis cliquez sur \"Payer\".'),
(186, 2, 'PAYMENT_BRAINTREE_NOTICE', 'Fill in the form bellow with your credit card information, then click on \"Check Out\".'),
(186, 3, 'PAYMENT_BRAINTREE_NOTICE', 'Fill in the form bellow with your credit card information, then click on \"Check Out\".'),
(186, 4, 'PAYMENT_BRAINTREE_NOTICE', 'Fill in the form bellow with your credit card information, then click on \"Check Out\".'),
(187, 1, 'COUPON_CODE_FAILURE', 'Erreur : ce code est invalide ou a déjà été utilisé'),
(187, 2, 'COUPON_CODE_FAILURE', 'Error: this code is invalid or already used'),
(187, 3, 'COUPON_CODE_FAILURE', 'Error: this code is invalid or already used'),
(187, 4, 'COUPON_CODE_FAILURE', 'Error: this code is invalid or already used'),
(188, 1, 'PAYMENT_RAZORPAY_NOTICE', 'Cliquez sur \"Payer\", puis remplissez le formulaire avec les informations de votre carte de crédit.'),
(188, 2, 'PAYMENT_RAZORPAY_NOTICE', 'Click on \"Check Out\", then fill in the form with your credit card information.'),
(188, 3, 'PAYMENT_RAZORPAY_NOTICE', 'Click on \"Check Out\", then fill in the form with your credit card information.'),
(188, 4, 'PAYMENT_RAZORPAY_NOTICE', 'Click on \"Check Out\", then fill in the form with your credit card information.'),
(189, 1, 'YO', 'y.o.'),
(189, 2, 'YO', 'ans'),
(189, 3, 'YO', 'y.o.'),
(189, 4, 'YO', 'ans'),
(190, 2, 'FACİLİTY_CATEGORY', ''),
(190, 4, 'FACİLİTY_CATEGORY', 'Kategori');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_user`
--

CREATE TABLE `pm_user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `add_date` int(11) DEFAULT NULL,
  `edit_date` int(11) DEFAULT NULL,
  `checked` int(11) DEFAULT 0,
  `fb_id` varchar(50) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `postcode` varchar(10) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `token` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `pm_user`
--

INSERT INTO `pm_user` (`id`, `firstname`, `lastname`, `email`, `login`, `pass`, `type`, `add_date`, `edit_date`, `checked`, `fb_id`, `address`, `postcode`, `city`, `company`, `country`, `mobile`, `phone`, `token`) VALUES
(1, 'Admin', 'Sistem', 'info@edugineer.com', 'admin', '25f9e794323b453885f5181f1b624d0b', 'administrator', 1600670231, 1602052805, 1, '', 'Irure proident veli', 'Deserunt p', 'Voluptatem exercita', '', 'Åland', '', '+1 (942) 594-3753', ''),
(2, 'ahmet', 'Kaya', 'yonetici@gmail.com', 'yonetici', '25f9e794323b453885f5181f1b624d0b', 'hotel', 1600082049, 1600082049, 1, NULL, '', '', '', '', '', '', '', NULL),
(3, 'aaaaa', '', 'abc@gmail.com', 'ilker123', '25f9e794323b453885f5181f1b624d0b', 'registered', 1601649509, 1602051149, 1, NULL, '', '', '', '', '', '', '', '6476c907a27a3eef95f217a144298cfc'),
(4, '', '', 'ilkerrakk52@gmail.com', 'deneme123', '25f9e794323b453885f5181f1b624d0b', 'registered', 1601652394, NULL, NULL, NULL, '', '', '', '', '', '', '', '112291f333d622a2f824d4c77c8c95ca');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pm_widget`
--

CREATE TABLE `pm_widget` (
  `id` int(11) NOT NULL,
  `lang` int(11) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `showtitle` int(11) DEFAULT NULL,
  `pos` varchar(20) DEFAULT NULL,
  `allpages` int(11) DEFAULT NULL,
  `pages` varchar(250) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `class` varchar(200) DEFAULT NULL,
  `checked` int(11) DEFAULT 0,
  `rank` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `pm_widget`
--

INSERT INTO `pm_widget` (`id`, `lang`, `title`, `showtitle`, `pos`, `allpages`, `pages`, `type`, `content`, `class`, `checked`, `rank`) VALUES
(1, 1, 'Qui sommes-nous ?', 1, 'footer_col_1', 1, '', '', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum eget auctor ipsum. Mauris pharetra neque a mauris commodo, at aliquam leo malesuada. Maecenas eget elit eu ligula rhoncus dapibus at non erat. In sed velit eget eros gravida consectetur varius imperdiet lectus.</p>\r\n', NULL, 1, 1),
(1, 2, 'About us', 1, 'footer_col_1', 1, '', '', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum eget auctor ipsum. Mauris pharetra neque a mauris commodo, at aliquam leo malesuada. Maecenas eget elit eu ligula rhoncus dapibus at non erat. In sed velit eget eros gravida consectetur varius imperdiet lectus.</p>\r\n', '', 1, 1),
(1, 3, 'عنا', 1, 'footer_col_1', 1, '', '', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum eget auctor ipsum. Mauris pharetra neque a mauris commodo, at aliquam leo malesuada. Maecenas eget elit eu ligula rhoncus dapibus at non erat. In sed velit eget eros gravida consectetur varius imperdiet lectus.</p>\r\n', NULL, 1, 1),
(1, 4, 'Hakkımızda', 1, 'footer_col_1', 1, '', '', '<p>Özel okul fiyatlarını listeleyerek size en uygun özel okulu bulmanıza yardımcı olmak için hazırlanmıştır. Herhangi bir konuda öneriniz varsa lütfen iletişim bölümünden iletin.</p>\r\n', '', 1, 1),
(3, 1, 'Derniers articles', 1, 'footer_col_2', 1, '', 'latest_articles', '', '', 2, 2),
(3, 2, 'Latest articles', 1, 'footer_col_2', 1, '', 'footer_menu', '', '', 2, 2),
(3, 3, 'المقالات الأخيرة', 1, 'footer_col_2', 1, '', 'latest_articles', '', '', 2, 2),
(3, 4, 'Sizin İçin', 1, 'footer_col_2', 1, '', 'footer_menu', '', '', 2, 2),
(4, 1, 'Contactez-nous', 0, 'footer_col_3', 1, '', 'contact_informations', '', '', 2, 3),
(4, 2, 'Contact us', 0, 'footer_col_3', 1, '', 'contact_informations', '', '', 2, 3),
(4, 3, 'اتصل بنا', 0, 'footer_col_3', 1, '', 'contact_informations', '', '', 2, 3),
(4, 4, 'Contact us', 0, 'footer_col_3', 1, '', 'contact_informations', '', '', 2, 3),
(5, 1, 'Footer form', 0, 'footer_col_3', 1, '', 'footer_form', '', 'footer-form mt10', 2, 4),
(5, 2, 'Footer form', 0, 'footer_col_3', 1, '', 'footer_form', '', 'footer-form mt10', 2, 4),
(5, 3, 'Footer form', 0, 'footer_col_3', 1, '', 'footer_form', '', 'footer-form mt10', 2, 4),
(5, 4, 'Footer form', 0, 'footer_col_3', 1, '', 'footer_form', '', 'footer-form mt10', 2, 4),
(6, 1, 'Blog side', 0, 'right', 0, '17', 'blog_side', '', '', 1, 5),
(6, 2, 'Blog side', 0, 'right', 0, '17', 'blog_side', '', '', 1, 5),
(6, 3, 'Blog side', 0, 'right', 0, '17', 'blog_side', '', '', 1, 5),
(6, 4, 'Blog side', 0, 'right', 0, '17', 'blog_side', '', '', 1, 5);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `pm_activity`
--
ALTER TABLE `pm_activity`
  ADD PRIMARY KEY (`id`,`lang`),
  ADD KEY `activity_lang_fkey` (`lang`);

--
-- Tablo için indeksler `pm_activity_file`
--
ALTER TABLE `pm_activity_file`
  ADD PRIMARY KEY (`id`,`lang`),
  ADD KEY `activity_file_fkey` (`id_item`,`lang`),
  ADD KEY `activity_file_lang_fkey` (`lang`);

--
-- Tablo için indeksler `pm_activity_session`
--
ALTER TABLE `pm_activity_session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_session_fkey` (`id_activity`);

--
-- Tablo için indeksler `pm_activity_session_hour`
--
ALTER TABLE `pm_activity_session_hour`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_session_hour_fkey` (`id_activity_session`);

--
-- Tablo için indeksler `pm_article`
--
ALTER TABLE `pm_article`
  ADD PRIMARY KEY (`id`,`lang`),
  ADD KEY `article_lang_fkey` (`lang`),
  ADD KEY `article_page_fkey` (`id_page`,`lang`);

--
-- Tablo için indeksler `pm_article_file`
--
ALTER TABLE `pm_article_file`
  ADD PRIMARY KEY (`id`,`lang`),
  ADD KEY `article_file_fkey` (`id_item`,`lang`),
  ADD KEY `article_file_lang_fkey` (`lang`);

--
-- Tablo için indeksler `pm_booking`
--
ALTER TABLE `pm_booking`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `pm_booking_activity`
--
ALTER TABLE `pm_booking_activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_activity_fkey` (`id_booking`);

--
-- Tablo için indeksler `pm_booking_payment`
--
ALTER TABLE `pm_booking_payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_payment_fkey` (`id_booking`);

--
-- Tablo için indeksler `pm_booking_room`
--
ALTER TABLE `pm_booking_room`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_room_fkey` (`id_booking`);

--
-- Tablo için indeksler `pm_booking_service`
--
ALTER TABLE `pm_booking_service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_service_fkey` (`id_booking`);

--
-- Tablo için indeksler `pm_booking_tax`
--
ALTER TABLE `pm_booking_tax`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_tax_fkey` (`id_booking`);

--
-- Tablo için indeksler `pm_comment`
--
ALTER TABLE `pm_comment`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `pm_country`
--
ALTER TABLE `pm_country`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `pm_coupon`
--
ALTER TABLE `pm_coupon`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `pm_coupon_user`
--
ALTER TABLE `pm_coupon_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupon_user_fkey` (`id_coupon`);

--
-- Tablo için indeksler `pm_currency`
--
ALTER TABLE `pm_currency`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `pm_destination`
--
ALTER TABLE `pm_destination`
  ADD PRIMARY KEY (`id`,`lang`);

--
-- Tablo için indeksler `pm_destination_file`
--
ALTER TABLE `pm_destination_file`
  ADD PRIMARY KEY (`id`,`lang`),
  ADD KEY `destination_file_fkey` (`id_item`,`lang`),
  ADD KEY `destination_file_lang_fkey` (`lang`);

--
-- Tablo için indeksler `pm_email_content`
--
ALTER TABLE `pm_email_content`
  ADD PRIMARY KEY (`id`,`lang`),
  ADD KEY `email_content_lang_fkey` (`lang`);

--
-- Tablo için indeksler `pm_facility`
--
ALTER TABLE `pm_facility`
  ADD PRIMARY KEY (`id`,`lang`),
  ADD KEY `facility_lang_fkey` (`lang`);

--
-- Tablo için indeksler `pm_facility_file`
--
ALTER TABLE `pm_facility_file`
  ADD PRIMARY KEY (`id`,`lang`),
  ADD KEY `facility_file_fkey` (`id_item`,`lang`),
  ADD KEY `facility_file_lang_fkey` (`lang`);

--
-- Tablo için indeksler `pm_hotel`
--
ALTER TABLE `pm_hotel`
  ADD PRIMARY KEY (`id`,`lang`),
  ADD KEY `hotel_lang_fkey` (`lang`);

--
-- Tablo için indeksler `pm_hotel_file`
--
ALTER TABLE `pm_hotel_file`
  ADD PRIMARY KEY (`id`,`lang`),
  ADD KEY `hotel_file_fkey` (`id_item`,`lang`),
  ADD KEY `hotel_file_lang_fkey` (`lang`);

--
-- Tablo için indeksler `pm_ical_event`
--
ALTER TABLE `pm_ical_event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ical_event_fkey` (`id_room`);

--
-- Tablo için indeksler `pm_lang`
--
ALTER TABLE `pm_lang`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `pm_lang_file`
--
ALTER TABLE `pm_lang_file`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang_file_fkey` (`id_item`);

--
-- Tablo için indeksler `pm_location`
--
ALTER TABLE `pm_location`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `pm_media`
--
ALTER TABLE `pm_media`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `pm_media_file`
--
ALTER TABLE `pm_media_file`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_file_fkey` (`id_item`);

--
-- Tablo için indeksler `pm_menu`
--
ALTER TABLE `pm_menu`
  ADD PRIMARY KEY (`id`,`lang`),
  ADD KEY `menu_lang_fkey` (`lang`);

--
-- Tablo için indeksler `pm_message`
--
ALTER TABLE `pm_message`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `pm_package`
--
ALTER TABLE `pm_package`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `pm_page`
--
ALTER TABLE `pm_page`
  ADD PRIMARY KEY (`id`,`lang`),
  ADD KEY `page_lang_fkey` (`lang`);

--
-- Tablo için indeksler `pm_page_file`
--
ALTER TABLE `pm_page_file`
  ADD PRIMARY KEY (`id`,`lang`),
  ADD KEY `page_file_fkey` (`id_item`,`lang`),
  ADD KEY `page_file_lang_fkey` (`lang`);

--
-- Tablo için indeksler `pm_popup`
--
ALTER TABLE `pm_popup`
  ADD PRIMARY KEY (`id`,`lang`),
  ADD KEY `popup_lang_fkey` (`lang`);

--
-- Tablo için indeksler `pm_rate`
--
ALTER TABLE `pm_rate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rate_room_fkey` (`id_room`);

--
-- Tablo için indeksler `pm_rate_child`
--
ALTER TABLE `pm_rate_child`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rate_child_fkey` (`id_rate`);

--
-- Tablo için indeksler `pm_room`
--
ALTER TABLE `pm_room`
  ADD PRIMARY KEY (`id`,`lang`),
  ADD KEY `room_lang_fkey` (`lang`),
  ADD KEY `room_hotel_fkey` (`id_hotel`,`lang`);

--
-- Tablo için indeksler `pm_room_calendar`
--
ALTER TABLE `pm_room_calendar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_calendar_fkey` (`id_room`);

--
-- Tablo için indeksler `pm_room_closing`
--
ALTER TABLE `pm_room_closing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_closing_fkey` (`id_room`);

--
-- Tablo için indeksler `pm_room_file`
--
ALTER TABLE `pm_room_file`
  ADD PRIMARY KEY (`id`,`lang`),
  ADD KEY `room_file_fkey` (`id_item`,`lang`),
  ADD KEY `room_file_lang_fkey` (`lang`);

--
-- Tablo için indeksler `pm_room_lock`
--
ALTER TABLE `pm_room_lock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_lock_fkey` (`id_room`);

--
-- Tablo için indeksler `pm_schoollevel`
--
ALTER TABLE `pm_schoollevel`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `pm_service`
--
ALTER TABLE `pm_service`
  ADD PRIMARY KEY (`id`,`lang`),
  ADD KEY `service_lang_fkey` (`lang`);

--
-- Tablo için indeksler `pm_slide`
--
ALTER TABLE `pm_slide`
  ADD PRIMARY KEY (`id`,`lang`),
  ADD KEY `slide_lang_fkey` (`lang`),
  ADD KEY `slide_page_fkey` (`id_page`,`lang`);

--
-- Tablo için indeksler `pm_slide_file`
--
ALTER TABLE `pm_slide_file`
  ADD PRIMARY KEY (`id`,`lang`),
  ADD KEY `slide_file_fkey` (`id_item`,`lang`),
  ADD KEY `slide_file_lang_fkey` (`lang`);

--
-- Tablo için indeksler `pm_social`
--
ALTER TABLE `pm_social`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `pm_tag`
--
ALTER TABLE `pm_tag`
  ADD PRIMARY KEY (`id`,`lang`),
  ADD KEY `tag_lang_fkey` (`lang`);

--
-- Tablo için indeksler `pm_tax`
--
ALTER TABLE `pm_tax`
  ADD PRIMARY KEY (`id`,`lang`),
  ADD KEY `tax_lang_fkey` (`lang`);

--
-- Tablo için indeksler `pm_text`
--
ALTER TABLE `pm_text`
  ADD PRIMARY KEY (`id`,`lang`),
  ADD KEY `text_lang_fkey` (`lang`);

--
-- Tablo için indeksler `pm_user`
--
ALTER TABLE `pm_user`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `pm_widget`
--
ALTER TABLE `pm_widget`
  ADD PRIMARY KEY (`id`,`lang`),
  ADD KEY `widget_lang_fkey` (`lang`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `pm_activity`
--
ALTER TABLE `pm_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `pm_activity_file`
--
ALTER TABLE `pm_activity_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `pm_activity_session`
--
ALTER TABLE `pm_activity_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `pm_activity_session_hour`
--
ALTER TABLE `pm_activity_session_hour`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `pm_article`
--
ALTER TABLE `pm_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `pm_article_file`
--
ALTER TABLE `pm_article_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Tablo için AUTO_INCREMENT değeri `pm_booking`
--
ALTER TABLE `pm_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `pm_booking_activity`
--
ALTER TABLE `pm_booking_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `pm_booking_payment`
--
ALTER TABLE `pm_booking_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `pm_booking_room`
--
ALTER TABLE `pm_booking_room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `pm_booking_service`
--
ALTER TABLE `pm_booking_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `pm_booking_tax`
--
ALTER TABLE `pm_booking_tax`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `pm_comment`
--
ALTER TABLE `pm_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `pm_country`
--
ALTER TABLE `pm_country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;

--
-- Tablo için AUTO_INCREMENT değeri `pm_coupon`
--
ALTER TABLE `pm_coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `pm_coupon_user`
--
ALTER TABLE `pm_coupon_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `pm_currency`
--
ALTER TABLE `pm_currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `pm_destination`
--
ALTER TABLE `pm_destination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `pm_destination_file`
--
ALTER TABLE `pm_destination_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `pm_email_content`
--
ALTER TABLE `pm_email_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `pm_facility`
--
ALTER TABLE `pm_facility`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Tablo için AUTO_INCREMENT değeri `pm_facility_file`
--
ALTER TABLE `pm_facility_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- Tablo için AUTO_INCREMENT değeri `pm_hotel`
--
ALTER TABLE `pm_hotel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `pm_hotel_file`
--
ALTER TABLE `pm_hotel_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Tablo için AUTO_INCREMENT değeri `pm_ical_event`
--
ALTER TABLE `pm_ical_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `pm_lang`
--
ALTER TABLE `pm_lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `pm_lang_file`
--
ALTER TABLE `pm_lang_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `pm_location`
--
ALTER TABLE `pm_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `pm_media`
--
ALTER TABLE `pm_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `pm_media_file`
--
ALTER TABLE `pm_media_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `pm_menu`
--
ALTER TABLE `pm_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tablo için AUTO_INCREMENT değeri `pm_message`
--
ALTER TABLE `pm_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `pm_package`
--
ALTER TABLE `pm_package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `pm_page`
--
ALTER TABLE `pm_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Tablo için AUTO_INCREMENT değeri `pm_page_file`
--
ALTER TABLE `pm_page_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `pm_popup`
--
ALTER TABLE `pm_popup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `pm_rate`
--
ALTER TABLE `pm_rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `pm_rate_child`
--
ALTER TABLE `pm_rate_child`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `pm_room`
--
ALTER TABLE `pm_room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `pm_room_calendar`
--
ALTER TABLE `pm_room_calendar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `pm_room_closing`
--
ALTER TABLE `pm_room_closing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `pm_room_file`
--
ALTER TABLE `pm_room_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `pm_room_lock`
--
ALTER TABLE `pm_room_lock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Tablo için AUTO_INCREMENT değeri `pm_schoollevel`
--
ALTER TABLE `pm_schoollevel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `pm_service`
--
ALTER TABLE `pm_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `pm_slide`
--
ALTER TABLE `pm_slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `pm_slide_file`
--
ALTER TABLE `pm_slide_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `pm_social`
--
ALTER TABLE `pm_social`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `pm_tag`
--
ALTER TABLE `pm_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `pm_tax`
--
ALTER TABLE `pm_tax`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `pm_text`
--
ALTER TABLE `pm_text`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

--
-- Tablo için AUTO_INCREMENT değeri `pm_user`
--
ALTER TABLE `pm_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `pm_widget`
--
ALTER TABLE `pm_widget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `pm_activity`
--
ALTER TABLE `pm_activity`
  ADD CONSTRAINT `activity_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `pm_activity_file`
--
ALTER TABLE `pm_activity_file`
  ADD CONSTRAINT `activity_file_fkey` FOREIGN KEY (`id_item`,`lang`) REFERENCES `pm_activity` (`id`, `lang`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `activity_file_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `pm_activity_session`
--
ALTER TABLE `pm_activity_session`
  ADD CONSTRAINT `activity_session_fkey` FOREIGN KEY (`id_activity`) REFERENCES `pm_activity` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `pm_activity_session_hour`
--
ALTER TABLE `pm_activity_session_hour`
  ADD CONSTRAINT `activity_session_hour_fkey` FOREIGN KEY (`id_activity_session`) REFERENCES `pm_activity_session` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `pm_article`
--
ALTER TABLE `pm_article`
  ADD CONSTRAINT `article_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `article_page_fkey` FOREIGN KEY (`id_page`,`lang`) REFERENCES `pm_page` (`id`, `lang`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `pm_article_file`
--
ALTER TABLE `pm_article_file`
  ADD CONSTRAINT `article_file_fkey` FOREIGN KEY (`id_item`,`lang`) REFERENCES `pm_article` (`id`, `lang`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `article_file_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `pm_booking_activity`
--
ALTER TABLE `pm_booking_activity`
  ADD CONSTRAINT `booking_activity_fkey` FOREIGN KEY (`id_booking`) REFERENCES `pm_booking` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `pm_booking_payment`
--
ALTER TABLE `pm_booking_payment`
  ADD CONSTRAINT `booking_payment_fkey` FOREIGN KEY (`id_booking`) REFERENCES `pm_booking` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `pm_booking_room`
--
ALTER TABLE `pm_booking_room`
  ADD CONSTRAINT `booking_room_fkey` FOREIGN KEY (`id_booking`) REFERENCES `pm_booking` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `pm_booking_service`
--
ALTER TABLE `pm_booking_service`
  ADD CONSTRAINT `booking_service_fkey` FOREIGN KEY (`id_booking`) REFERENCES `pm_booking` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `pm_booking_tax`
--
ALTER TABLE `pm_booking_tax`
  ADD CONSTRAINT `booking_tax_fkey` FOREIGN KEY (`id_booking`) REFERENCES `pm_booking` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `pm_coupon_user`
--
ALTER TABLE `pm_coupon_user`
  ADD CONSTRAINT `coupon_user_fkey` FOREIGN KEY (`id_coupon`) REFERENCES `pm_coupon` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `pm_destination_file`
--
ALTER TABLE `pm_destination_file`
  ADD CONSTRAINT `destination_file_fkey` FOREIGN KEY (`id_item`,`lang`) REFERENCES `pm_destination` (`id`, `lang`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `destination_file_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `pm_email_content`
--
ALTER TABLE `pm_email_content`
  ADD CONSTRAINT `email_content_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `pm_facility`
--
ALTER TABLE `pm_facility`
  ADD CONSTRAINT `facility_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `pm_facility_file`
--
ALTER TABLE `pm_facility_file`
  ADD CONSTRAINT `facility_file_fkey` FOREIGN KEY (`id_item`,`lang`) REFERENCES `pm_facility` (`id`, `lang`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `facility_file_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `pm_hotel`
--
ALTER TABLE `pm_hotel`
  ADD CONSTRAINT `hotel_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `pm_hotel_file`
--
ALTER TABLE `pm_hotel_file`
  ADD CONSTRAINT `hotel_file_fkey` FOREIGN KEY (`id_item`,`lang`) REFERENCES `pm_hotel` (`id`, `lang`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `hotel_file_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `pm_ical_event`
--
ALTER TABLE `pm_ical_event`
  ADD CONSTRAINT `ical_event_fkey` FOREIGN KEY (`id_room`) REFERENCES `pm_room` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `pm_lang_file`
--
ALTER TABLE `pm_lang_file`
  ADD CONSTRAINT `lang_file_fkey` FOREIGN KEY (`id_item`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `pm_media_file`
--
ALTER TABLE `pm_media_file`
  ADD CONSTRAINT `media_file_fkey` FOREIGN KEY (`id_item`) REFERENCES `pm_media` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `pm_menu`
--
ALTER TABLE `pm_menu`
  ADD CONSTRAINT `menu_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `pm_page`
--
ALTER TABLE `pm_page`
  ADD CONSTRAINT `page_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `pm_page_file`
--
ALTER TABLE `pm_page_file`
  ADD CONSTRAINT `page_file_fkey` FOREIGN KEY (`id_item`,`lang`) REFERENCES `pm_page` (`id`, `lang`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `page_file_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `pm_popup`
--
ALTER TABLE `pm_popup`
  ADD CONSTRAINT `popup_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `pm_rate`
--
ALTER TABLE `pm_rate`
  ADD CONSTRAINT `rate_room_fkey` FOREIGN KEY (`id_room`) REFERENCES `pm_room` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `pm_rate_child`
--
ALTER TABLE `pm_rate_child`
  ADD CONSTRAINT `rate_child_fkey` FOREIGN KEY (`id_rate`) REFERENCES `pm_rate` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `pm_room`
--
ALTER TABLE `pm_room`
  ADD CONSTRAINT `room_hotel_fkey` FOREIGN KEY (`id_hotel`,`lang`) REFERENCES `pm_hotel` (`id`, `lang`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `room_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `pm_room_calendar`
--
ALTER TABLE `pm_room_calendar`
  ADD CONSTRAINT `room_calendar_fkey` FOREIGN KEY (`id_room`) REFERENCES `pm_room` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `pm_room_closing`
--
ALTER TABLE `pm_room_closing`
  ADD CONSTRAINT `room_closing_fkey` FOREIGN KEY (`id_room`) REFERENCES `pm_room` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `pm_room_file`
--
ALTER TABLE `pm_room_file`
  ADD CONSTRAINT `room_file_fkey` FOREIGN KEY (`id_item`,`lang`) REFERENCES `pm_room` (`id`, `lang`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `room_file_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `pm_room_lock`
--
ALTER TABLE `pm_room_lock`
  ADD CONSTRAINT `room_lock_fkey` FOREIGN KEY (`id_room`) REFERENCES `pm_room` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `pm_service`
--
ALTER TABLE `pm_service`
  ADD CONSTRAINT `service_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `pm_slide`
--
ALTER TABLE `pm_slide`
  ADD CONSTRAINT `slide_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `slide_page_fkey` FOREIGN KEY (`id_page`,`lang`) REFERENCES `pm_page` (`id`, `lang`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `pm_slide_file`
--
ALTER TABLE `pm_slide_file`
  ADD CONSTRAINT `slide_file_fkey` FOREIGN KEY (`id_item`,`lang`) REFERENCES `pm_slide` (`id`, `lang`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `slide_file_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `pm_tag`
--
ALTER TABLE `pm_tag`
  ADD CONSTRAINT `tag_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `pm_tax`
--
ALTER TABLE `pm_tax`
  ADD CONSTRAINT `tax_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `pm_text`
--
ALTER TABLE `pm_text`
  ADD CONSTRAINT `text_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `pm_widget`
--
ALTER TABLE `pm_widget`
  ADD CONSTRAINT `widget_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
