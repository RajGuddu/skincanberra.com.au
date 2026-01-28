-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2025 at 11:45 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_skincanberra`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `privilege_id` int(11) NOT NULL,
  `address` varchar(400) NOT NULL,
  `added_by` int(5) NOT NULL,
  `update_by` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`user_id`, `name`, `email`, `password`, `ip_address`, `phone`, `image`, `privilege_id`, `address`, `added_by`, `update_by`, `status`, `created`, `updated`) VALUES
(1, 'laravel7825', 'admin@admin.com', '$2y$12$rfIb3rMql0VAUoF6e.JSoeb91VTN6GC5i6JGvfkK7HZT0JP86pXju', '::1', '2356896589', 'user_1759484555.jpg', 1, 'delhi', 1, 1, 1, '2021-09-06 10:23:19', '2025-10-10 05:59:00'),
(15, 'test1234', 'test@yopmail.com', '$2y$10$fqYWNLFqBT3yt7nCO4xsROQuDPi1Evl74/zTRkNkzlh2k4qVYQ4JG', '::1', '2356897485', 'u_1672132507.jpg', 3, 'delhi', 1, 1, 1, '2022-12-27 09:15:07', '2023-03-05 11:10:42'),
(16, 'test175', 'test175@yopmail.com', '$2y$10$n6uyNrkfB9SHBImdRrCsR.x5sgHFkCCwQtQLODH65CqOasEOrFLBO', '::1', '7865432343', 'u_1672145257.jpg', 3, 'delhi', 1, 1, 1, '2022-12-27 12:47:37', '2023-02-15 10:54:14'),
(17, 'abc', 'abc@yopmail.com', '$2y$10$TbeSFZ0.q5ZSJpfkgnHDiOfsJE0rn29o9L9DiV0PWuYy9SfGwagKi', '::1', '9162925142', 'u_1676480019.jpg', 3, 'ara', 1, 1, 1, '2023-02-14 17:07:38', '2023-02-15 10:53:39');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_banner`
--

CREATE TABLE `tbl_banner` (
  `id` int(11) NOT NULL,
  `main_title` varchar(100) DEFAULT NULL,
  `sub_title` varchar(150) NOT NULL,
  `page` int(11) DEFAULT NULL,
  `url` varchar(150) NOT NULL,
  `brochure` varchar(100) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_banner`
--

INSERT INTO `tbl_banner` (`id`, `main_title`, `sub_title`, `page`, `url`, `brochure`, `status`, `created_at`, `update_at`) VALUES
(1, 'test', 'test sub', 1, '', 'ban_1678509753.jpg', 0, '2021-07-22 22:51:10', '2023-03-10 22:43:15'),
(2, 'test2', 'sub test2', 1, '', 'ban_1694872437.jpg', 1, '2021-07-22 23:00:40', '2023-09-16 08:53:57'),
(4, 'test4', 'subtest4', 3, '', 'ban_1678509743.jpg', 1, '2021-07-22 23:22:03', '2023-03-10 22:42:23'),
(5, 'contact us', 'test 2', 3, '', 'ban_1678509622.jpg', 1, '2023-03-10 22:40:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_blog`
--

CREATE TABLE `tbl_blog` (
  `blg_id` int(11) NOT NULL,
  `blog_title` varchar(255) NOT NULL,
  `blog_details` text NOT NULL,
  `blog_image` varchar(255) NOT NULL,
  `blog_url` varchar(255) NOT NULL,
  `related_blogs` varchar(255) NOT NULL,
  `blog_added_by` varchar(255) NOT NULL,
  `blog_cat_id` int(11) NOT NULL,
  `post_date` date NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  `blog_status` enum('0','1') NOT NULL,
  `added_at` datetime NOT NULL,
  `modefied_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_blog`
--

INSERT INTO `tbl_blog` (`blg_id`, `blog_title`, `blog_details`, `blog_image`, `blog_url`, `related_blogs`, `blog_added_by`, `blog_cat_id`, `post_date`, `meta_title`, `meta_description`, `meta_keyword`, `blog_status`, `added_at`, `modefied_at`) VALUES
(1, 'The Most Inspiring Interior Design Of 201688', 'We went down the lane, by the body of the man in black, sodden now from the overnight hail,', 'b_1626281172.jpg', 'the-most-inspiring-interior-design-of-201688', '', 'Admin', 0, '2021-03-23', 'The Most Inspiring Interior Design Of 201685', 'The Most Inspiring Interior Design Of 201685', 'The Most Inspiring Interior Design Of 201685', '1', '2021-07-14 23:10:52', '2021-03-23 17:07:18'),
(2, 'daffodills', 'daffodils daffodils daffodils daffodils', '', 'daffodils ', 'the very much design', 'Admin', 0, '2021-03-23', 'The Most Inspiring Interior Design Of 201685', 'The Most Inspiring Interior Design Of 201685', 'The Most Inspiring Interior Design Of 201685', '1', '2024-03-03 16:46:02', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cms`
--

CREATE TABLE `tbl_cms` (
  `id` int(11) NOT NULL,
  `page` varchar(150) NOT NULL,
  `banner_title` varchar(255) NOT NULL,
  `banner_head` varchar(255) NOT NULL,
  `cms_banner` varchar(150) NOT NULL,
  `description1` text NOT NULL,
  `description2` text NOT NULL,
  `description3` text NOT NULL,
  `description4` text NOT NULL,
  `description5` text NOT NULL,
  `status` enum('1','0') NOT NULL COMMENT '1-Active, 0-Inactive',
  `added_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_cms`
--

INSERT INTO `tbl_cms` (`id`, `page`, `banner_title`, `banner_head`, `cms_banner`, `description1`, `description2`, `description3`, `description4`, `description5`, `status`, `added_at`, `updated_at`) VALUES
(1, 'test csms', 'tetstdfssa', 'tetst', 'ban_1678029194.jpg', 'testtesttesttesttesttesttesttesttesttesttesttesttesttesttest', '', '', '', '', '0', '2023-03-05 09:13:14', '2023-03-05 11:04:51'),
(2, 'test2', 'test', 'test', 'ban_1678030362.jpg', 'sdfsdfsdf', '', '', '', '', '0', '2023-03-05 09:32:42', '2023-03-05 11:03:53');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_countries`
--

CREATE TABLE `tbl_countries` (
  `countries_id` int(11) NOT NULL,
  `countries_name` varchar(64) NOT NULL DEFAULT '',
  `countries_iso_code` varchar(2) NOT NULL,
  `countries_isd_code` varchar(7) DEFAULT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_countries`
--

INSERT INTO `tbl_countries` (`countries_id`, `countries_name`, `countries_iso_code`, `countries_isd_code`, `status`) VALUES
(1, 'Afghanistan', 'AF', '93', 1),
(2, 'Albania', 'AL', '355', 1),
(3, 'Algeria', 'DZ', '213', 1),
(4, 'American Samoa', 'AS', '1-684', 1),
(5, 'Andorra', 'AD', '376', 1),
(6, 'Angola', 'AO', '244', 1),
(7, 'Anguilla', 'AI', '1-264', 1),
(8, 'Antarctica', 'AQ', '672', 1),
(9, 'Antigua and Barbuda', 'AG', '1-268', 1),
(10, 'Argentina', 'AR', '54', 1),
(11, 'Armenia', 'AM', '374', 1),
(12, 'Aruba', 'AW', '297', 1),
(13, 'Australia', 'AU', '61', 1),
(14, 'Austria', 'AT', '43', 1),
(15, 'Azerbaijan', 'AZ', '994', 1),
(16, 'Bahamas', 'BS', '1-242', 1),
(17, 'Bahrain', 'BH', '973', 1),
(18, 'Bangladesh', 'BD', '880', 1),
(19, 'Barbados', 'BB', '1-246', 1),
(20, 'Belarus', 'BY', '375', 1),
(21, 'Belgium', 'BE', '32', 1),
(22, 'Belize', 'BZ', '501', 1),
(23, 'Benin', 'BJ', '229', 1),
(24, 'Bermuda', 'BM', '1-441', 1),
(25, 'Bhutan', 'BT', '975', 1),
(26, 'Bolivia', 'BO', '591', 1),
(27, 'Bosnia and Herzegowina', 'BA', '387', 1),
(28, 'Botswana', 'BW', '267', 1),
(29, 'Bouvet Island', 'BV', '47', 1),
(30, 'Brazil', 'BR', '55', 1),
(31, 'British Indian Ocean Territory', 'IO', '246', 1),
(32, 'Brunei Darussalam', 'BN', '673', 1),
(33, 'Bulgaria', 'BG', '359', 1),
(34, 'Burkina Faso', 'BF', '226', 1),
(35, 'Burundi', 'BI', '257', 1),
(36, 'Cambodia', 'KH', '855', 1),
(37, 'Cameroon', 'CM', '237', 1),
(38, 'Canada', 'CA', '1', 1),
(39, 'Cape Verde', 'CV', '238', 1),
(40, 'Cayman Islands', 'KY', '1-345', 1),
(41, 'Central African Republic', 'CF', '236', 1),
(42, 'Chad', 'TD', '235', 1),
(43, 'Chile', 'CL', '56', 1),
(44, 'China', 'CN', '86', 1),
(45, 'Christmas Island', 'CX', '61', 1),
(46, 'Cocos (Keeling) Islands', 'CC', '61', 1),
(47, 'Colombia', 'CO', '57', 1),
(48, 'Comoros', 'KM', '269', 1),
(49, 'Congo Democratic Republic of', 'CG', '242', 1),
(50, 'Cook Islands', 'CK', '682', 1),
(51, 'Costa Rica', 'CR', '506', 1),
(52, 'Cote D\'Ivoire', 'CI', '225', 1),
(53, 'Croatia', 'HR', '385', 1),
(54, 'Cuba', 'CU', '53', 1),
(55, 'Cyprus', 'CY', '357', 1),
(56, 'Czech Republic', 'CZ', '420', 1),
(57, 'Denmark', 'DK', '45', 1),
(58, 'Djibouti', 'DJ', '253', 1),
(59, 'Dominica', 'DM', '1-767', 1),
(60, 'Dominican Republic', 'DO', '1-809', 1),
(61, 'Timor-Leste', 'TL', '670', 1),
(62, 'Ecuador', 'EC', '593', 1),
(63, 'Egypt', 'EG', '20', 1),
(64, 'El Salvador', 'SV', '503', 1),
(65, 'Equatorial Guinea', 'GQ', '240', 1),
(66, 'Eritrea', 'ER', '291', 1),
(67, 'Estonia', 'EE', '372', 1),
(68, 'Ethiopia', 'ET', '251', 1),
(69, 'Falkland Islands (Malvinas)', 'FK', '500', 1),
(70, 'Faroe Islands', 'FO', '298', 1),
(71, 'Fiji', 'FJ', '679', 1),
(72, 'Finland', 'FI', '358', 1),
(73, 'France', 'FR', '33', 1),
(75, 'French Guiana', 'GF', '594', 1),
(76, 'French Polynesia', 'PF', '689', 1),
(77, 'French Southern Territories', 'TF', NULL, 1),
(78, 'Gabon', 'GA', '241', 1),
(79, 'Gambia', 'GM', '220', 1),
(80, 'Georgia', 'GE', '995', 1),
(81, 'Germany', 'DE', '49', 1),
(82, 'Ghana', 'GH', '233', 1),
(83, 'Gibraltar', 'GI', '350', 1),
(84, 'Greece', 'GR', '30', 1),
(85, 'Greenland', 'GL', '299', 1),
(86, 'Grenada', 'GD', '1-473', 1),
(87, 'Guadeloupe', 'GP', '590', 1),
(88, 'Guam', 'GU', '1-671', 1),
(89, 'Guatemala', 'GT', '502', 1),
(90, 'Guinea', 'GN', '224', 1),
(91, 'Guinea-bissau', 'GW', '245', 1),
(92, 'Guyana', 'GY', '592', 1),
(93, 'Haiti', 'HT', '509', 1),
(94, 'Heard Island and McDonald Islands', 'HM', '011', 1),
(95, 'Honduras', 'HN', '504', 1),
(96, 'Hong Kong', 'HK', '852', 1),
(97, 'Hungary', 'HU', '36', 1),
(98, 'Iceland', 'IS', '354', 1),
(99, 'India', 'IN', '91', 1),
(100, 'Indonesia', 'ID', '62', 1),
(101, 'Iran (Islamic Republic of)', 'IR', '98', 1),
(102, 'Iraq', 'IQ', '964', 1),
(103, 'Ireland', 'IE', '353', 1),
(104, 'Israel', 'IL', '972', 1),
(105, 'Italy', 'IT', '39', 1),
(106, 'Jamaica', 'JM', '1-876', 1),
(107, 'Japan', 'JP', '81', 1),
(108, 'Jordan', 'JO', '962', 1),
(109, 'Kazakhstan', 'KZ', '7', 1),
(110, 'Kenya', 'KE', '254', 1),
(111, 'Kiribati', 'KI', '686', 1),
(112, 'Korea, Democratic People\'s Republic of', 'KP', '850', 1),
(113, 'South Korea', 'KR', '82', 1),
(114, 'Kuwait', 'KW', '965', 1),
(115, 'Kyrgyzstan', 'KG', '996', 1),
(116, 'Lao People\'s Democratic Republic', 'LA', '856', 1),
(117, 'Latvia', 'LV', '371', 1),
(118, 'Lebanon', 'LB', '961', 1),
(119, 'Lesotho', 'LS', '266', 1),
(120, 'Liberia', 'LR', '231', 1),
(121, 'Libya', 'LY', '218', 1),
(122, 'Liechtenstein', 'LI', '423', 1),
(123, 'Lithuania', 'LT', '370', 1),
(124, 'Luxembourg', 'LU', '352', 1),
(125, 'Macao', 'MO', '853', 1),
(126, 'Macedonia, The Former Yugoslav Republic of', 'MK', '389', 1),
(127, 'Madagascar', 'MG', '261', 1),
(128, 'Malawi', 'MW', '265', 1),
(129, 'Malaysia', 'MY', '60', 1),
(130, 'Maldives', 'MV', '960', 1),
(131, 'Mali', 'ML', '223', 1),
(132, 'Malta', 'MT', '356', 1),
(133, 'Marshall Islands', 'MH', '692', 1),
(134, 'Martinique', 'MQ', '596', 1),
(135, 'Mauritania', 'MR', '222', 1),
(136, 'Mauritius', 'MU', '230', 1),
(137, 'Mayotte', 'YT', '262', 1),
(138, 'Mexico', 'MX', '52', 1),
(139, 'Micronesia, Federated States of', 'FM', '691', 1),
(140, 'Moldova', 'MD', '373', 1),
(141, 'Monaco', 'MC', '377', 1),
(142, 'Mongolia', 'MN', '976', 1),
(143, 'Montserrat', 'MS', '1-664', 1),
(144, 'Morocco', 'MA', '212', 1),
(145, 'Mozambique', 'MZ', '258', 1),
(146, 'Myanmar', 'MM', '95', 1),
(147, 'Namibia', 'NA', '264', 1),
(148, 'Nauru', 'NR', '674', 1),
(149, 'Nepal', 'NP', '977', 1),
(150, 'Netherlands', 'NL', '31', 1),
(151, 'Netherlands Antilles', 'AN', '599', 1),
(152, 'New Caledonia', 'NC', '687	', 1),
(153, 'New Zealand', 'NZ', '64', 1),
(154, 'Nicaragua', 'NI', '505', 1),
(155, 'Niger', 'NE', '227', 1),
(156, 'Nigeria', 'NG', '234', 1),
(157, 'Niue', 'NU', '683', 1),
(158, 'Norfolk Island', 'NF', '672', 1),
(159, 'Northern Mariana Islands', 'MP', '1-670', 1),
(160, 'Norway', 'NO', '47', 1),
(161, 'Oman', 'OM', '968', 1),
(162, 'Pakistan', 'PK', '92', 1),
(163, 'Palau', 'PW', '680', 1),
(164, 'Panama', 'PA', '507', 1),
(165, 'Papua New Guinea', 'PG', '675', 1),
(166, 'Paraguay', 'PY', '595', 1),
(167, 'Peru', 'PE', '51', 1),
(168, 'Philippines', 'PH', '63', 1),
(169, 'Pitcairn', 'PN', '64', 1),
(170, 'Poland', 'PL', '48', 1),
(171, 'Portugal', 'PT', '351', 1),
(172, 'Puerto Rico', 'PR', '1-787', 1),
(173, 'Qatar', 'QA', '974', 1),
(174, 'Reunion', 'RE', '262', 1),
(175, 'Romania', 'RO', '40', 1),
(176, 'Russian Federation', 'RU', '7', 1),
(177, 'Rwanda', 'RW', '250', 1),
(178, 'Saint Kitts and Nevis', 'KN', '1-869', 1),
(179, 'Saint Lucia', 'LC', '1-758', 1),
(180, 'Saint Vincent and the Grenadines', 'VC', '1-784', 1),
(181, 'Samoa', 'WS', '685', 1),
(182, 'San Marino', 'SM', '378', 1),
(183, 'Sao Tome and Principe', 'ST', '239', 1),
(184, 'Saudi Arabia', 'SA', '966', 1),
(185, 'Senegal', 'SN', '221', 1),
(186, 'Seychelles', 'SC', '248', 1),
(187, 'Sierra Leone', 'SL', '232', 1),
(188, 'Singapore', 'SG', '65', 1),
(189, 'Slovakia (Slovak Republic)', 'SK', '421', 1),
(190, 'Slovenia', 'SI', '386', 1),
(191, 'Solomon Islands', 'SB', '677', 1),
(192, 'Somalia', 'SO', '252', 1),
(193, 'South Africa', 'ZA', '27', 1),
(194, 'South Georgia and the South Sandwich Islands', 'GS', '500', 1),
(195, 'Spain', 'ES', '34', 1),
(196, 'Sri Lanka', 'LK', '94', 1),
(197, 'Saint Helena, Ascension and Tristan da Cunha', 'SH', '290', 1),
(198, 'St. Pierre and Miquelon', 'PM', '508', 1),
(199, 'Sudan', 'SD', '249', 1),
(200, 'Suriname', 'SR', '597', 1),
(201, 'Svalbard and Jan Mayen Islands', 'SJ', '47', 1),
(202, 'Swaziland', 'SZ', '268', 1),
(203, 'Sweden', 'SE', '46', 1),
(204, 'Switzerland', 'CH', '41', 1),
(205, 'Syrian Arab Republic', 'SY', '963', 1),
(206, 'Taiwan', 'TW', '886', 1),
(207, 'Tajikistan', 'TJ', '992', 1),
(208, 'Tanzania, United Republic of', 'TZ', '255', 1),
(209, 'Thailand', 'TH', '66', 1),
(210, 'Togo', 'TG', '228', 1),
(211, 'Tokelau', 'TK', '690', 1),
(212, 'Tonga', 'TO', '676', 1),
(213, 'Trinidad and Tobago', 'TT', '1-868', 1),
(214, 'Tunisia', 'TN', '216', 1),
(215, 'Turkey', 'TR', '90', 1),
(216, 'Turkmenistan', 'TM', '993', 1),
(217, 'Turks and Caicos Islands', 'TC', '1-649', 1),
(218, 'Tuvalu', 'TV', '688', 1),
(219, 'Uganda', 'UG', '256', 1),
(220, 'Ukraine', 'UA', '380', 1),
(221, 'United Arab Emirates', 'AE', '971', 1),
(222, 'United Kingdom', 'GB', '44', 1),
(223, 'United States', 'US', '1', 1),
(224, 'United States Minor Outlying Islands', 'UM', '246', 1),
(225, 'Uruguay', 'UY', '598', 1),
(226, 'Uzbekistan', 'UZ', '998', 1),
(227, 'Vanuatu', 'VU', '678', 1),
(228, 'Vatican City State (Holy See)', 'VA', '379', 1),
(229, 'Venezuela', 'VE', '58', 1),
(230, 'Vietnam', 'VN', '84', 1),
(231, 'Virgin Islands (British)', 'VG', '1-284', 1),
(232, 'Virgin Islands (U.S.)', 'VI', '1-340', 1),
(233, 'Wallis and Futuna Islands', 'WF', '681', 1),
(234, 'Western Sahara', 'EH', '212', 1),
(235, 'Yemen', 'YE', '967', 1),
(236, 'Serbia', 'RS', '381', 1),
(238, 'Zambia', 'ZM', '260', 1),
(239, 'Zimbabwe', 'ZW', '263', 1),
(240, 'Aaland Islands', 'AX', '358', 1),
(241, 'Palestine', 'PS', '970', 1),
(242, 'Montenegro', 'ME', '382', 1),
(243, 'Guernsey', 'GG', '44-1481', 1),
(244, 'Isle of Man', 'IM', '44-1624', 1),
(245, 'Jersey', 'JE', '44-1534', 1),
(247, 'Curaçao', 'CW', '599', 1),
(248, 'Ivory Coast', 'CI', '225', 1),
(249, 'Kosovo', 'XK', '383', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_happy_client`
--

CREATE TABLE `tbl_happy_client` (
  `cl_id` int(5) NOT NULL,
  `client_name` varchar(150) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL COMMENT '1-Active, 0-Inactive',
  `added_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_happy_client`
--

INSERT INTO `tbl_happy_client` (`cl_id`, `client_name`, `logo`, `status`, `added_at`) VALUES
(1, 'a', 'h_1626713649.jpg', '1', '2021-07-19 16:54:09');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_newsletter`
--

CREATE TABLE `tbl_newsletter` (
  `id` int(5) NOT NULL,
  `email` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_newsletter`
--

INSERT INTO `tbl_newsletter` (`id`, `email`) VALUES
(4, 'rajgudduara18@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_page`
--

CREATE TABLE `tbl_page` (
  `id` int(11) NOT NULL,
  `page_name` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL COMMENT '0-Inactive 1-Active',
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_page`
--

INSERT INTO `tbl_page` (`id`, `page_name`, `status`, `added_on`, `updated_on`) VALUES
(1, 'home ', '1', '2021-07-22 16:51:33', '2021-07-22 12:20:22'),
(3, 'contact us', '1', '2021-07-22 17:51:01', '0000-00-00 00:00:00'),
(4, 'about us', '1', '2021-07-22 17:51:18', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_services`
--

CREATE TABLE `tbl_services` (
  `sv_id` int(2) NOT NULL,
  `service_name` varchar(255) DEFAULT NULL,
  `serv_title` varchar(255) DEFAULT NULL,
  `serv_url` varchar(255) DEFAULT NULL,
  `photo` varchar(150) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `added_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_services`
--

INSERT INTO `tbl_services` (`sv_id`, `service_name`, `serv_title`, `serv_url`, `photo`, `details`, `status`, `added_at`, `update_at`) VALUES
(1, 'Facials', 'Professional & Corrective Skin Therapy', 'facials', 'service-VZpqqGQ6.webp', '<p class=\"mb-4 line-height-36\">Our facial services blend calming spa rituals with corrective, medical-grade options. Treatments include hydrating facials, brightening protocols, acne programs, anti-ageing therapies and chemical peels &mdash; each preceded by a skin analysis and tailored homecare plan.</p>\r\n<h6 class=\"text-20\">Benefits:</h6>\r\n<ul class=\"text-18 line-height-36\">\r\n<li>Improves tone, texture and hydration.</li>\r\n<li>Targets acne, pigmentation and fine lines.</li>\r\n<li>Uses professional serums, exfoliation and LED/boosters where required.</li>\r\n<li>Clear aftercare and progress checks for lasting results.</li>\r\n</ul>', 1, '2025-10-11 07:31:35', NULL),
(2, 'Waxing', 'Smooth, Gentle & Professional Hair Removal', 'waxing', 'service-0PBPcWLd.webp', '<p class=\"mb-4 line-height-36\">Precision waxing performed with gentle formulas and strict hygiene to leave skin smooth with minimal irritation. We wax brows, upper lip, underarms, legs and full-body areas with quick, professional technique.</p>\r\n<h6 class=\"text-20\">Benefits:</h6>\r\n<ul class=\"text-18 line-height-36\">\r\n<li>Long-lasting smoothness vs shaving.</li>\r\n<li>Faster regrowth that&rsquo;s softer over time.</li>\r\n<li>Hygienic, professional application and aftercare.</li>\r\n</ul>', 1, '2025-10-11 07:32:48', NULL),
(3, 'Make Up', 'Bridal, Event & Everyday Glam', 'make-up', 'service-Hoji2izV.webp', '<p class=\"mb-4 line-height-36\">Our makeup artists create looks suited to your skin, features and the occasion. Services include natural day makeup, event/party looks, and bridal packages with trial sessions and day-of touch-ups.</p>\r\n<h6 class=\"text-20\">Benefits:</h6>\r\n<ul class=\"text-18 line-height-36\">\r\n<li>Photo-ready, long-wear finishes.</li>\r\n<li>Skin-first preparation for comfort and durability.</li>\r\n<li>Trial options and on-site bridal services available.</li>\r\n</ul>', 1, '2025-10-11 07:33:36', NULL),
(4, 'Haircut & Styling', 'Precision Cuts & Wearable Looks', 'haircut-styling', 'service-hzu6fjxM.webp', '<p class=\"mb-4 line-height-36\">Precision haircuts and styling tailored to your face shape, hair type and lifestyle. Includes consultation, cut, blow-dry and simple styling tips to maintain the look at home.</p>\r\n<h6 class=\"text-20\">Benefits:</h6>\r\n<ul class=\"text-18 line-height-36\">\r\n<li>Modern, flattering cuts and practical styling advice.</li>\r\n<li>Recommendations for home care and product use.</li>\r\n<li>Finish and styling included.</li>\r\n</ul>', 1, '2025-10-11 07:34:25', NULL),
(5, 'Threading', 'Precise Brow & Facial Hair Shaping', 'threading', 'service-v5rdacH3.webp', '<p class=\"mb-4 line-height-36\">Expert eyebrow and facial threading for defined, natural results. Gentle technique reduces irritation and creates a clean, long-lasting shape.</p>\r\n<h6 class=\"text-20\">Benefits:</h6>\r\n<ul class=\"text-18 line-height-36\">\r\n<li>Precision shaping for brows and delicate facial areas.</li>\r\n<li>Low irritation when performed by trained technicians.</li>\r\n<li>Fast and consistent results.</li>\r\n</ul>', 1, '2025-10-11 07:35:12', NULL),
(6, 'Cosmetic Tattoo', 'Brows, Lips & Liner', 'cosmetic-tattoo', 'service-76VpwnYT.webp', '<p class=\"mb-4 line-height-36\">Semi-permanent cosmetic tattoos for brows, lips and eyeliner. Our technicians follow strict hygiene protocols and offer consultation, patch tests and follow-up appointments to ensure natural, balanced results.</p>\r\n<h6 class=\"text-20\">Benefits:</h6>\r\n<ul class=\"text-18 line-height-36\">\r\n<li>Time saved on daily makeup routines.</li>\r\n<li>Natural enhancement for brows, lips or eyes.</li>\r\n<li>Long-lasting results with touch-ups as needed.</li>\r\n</ul>', 1, '2025-10-11 07:35:47', '2025-10-11 08:51:25'),
(7, 'Laser Treatments', 'Hair Reduction & Skin Rejuvenation', 'laser-treatments', 'service-5QOPbB1T.webp', '<p class=\"mb-4 line-height-36\">Advanced laser therapies for long-term hair reduction and targeted skin rejuvenation. Every laser treatment begins with a suitability assessment and patch test to ensure safety and optimal results.</p>\r\n<h6 class=\"text-20\">Benefits:</h6>\r\n<ul class=\"text-18 line-height-36\">\r\n<li>Significant hair reduction over a course of sessions.</li>\r\n<li>Targeted skin resurfacing for texture and pigment issues.</li>\r\n<li>Professional assessment and customised protocol.</li>\r\n</ul>', 1, '2025-10-11 07:36:40', NULL),
(8, 'Hair Foils & Colour Services', 'Dimension, Tone & Shine', 'hair-foils-colour-services', 'service-sw1uXw0J.webp', '<p class=\"mb-4 line-height-36\">Custom foiling and colouring to add depth, lowlights or highlights while prioritising hair health. We use professional colour techniques and post-colour care to maintain shine and minimise damage.</p>\r\n<h6 class=\"text-20\">Benefits:</h6>\r\n<ul class=\"text-18 line-height-36\">\r\n<li>Natural-looking dimension and blended tones.</li>\r\n<li>Custom colour matching and professional finishing.</li>\r\n<li>Expert aftercare advice to extend colour life.</li>\r\n</ul>', 1, '2025-10-11 07:37:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_services_variants`
--

CREATE TABLE `tbl_services_variants` (
  `vid` int(2) NOT NULL,
  `sv_id` int(2) DEFAULT NULL,
  `v_name` varchar(200) DEFAULT NULL,
  `v_url` varchar(200) DEFAULT NULL,
  `photo` varchar(150) DEFAULT NULL,
  `mrp` int(2) DEFAULT NULL,
  `sp` int(2) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `added_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_services_variants`
--

INSERT INTO `tbl_services_variants` (`vid`, `sv_id`, `v_name`, `v_url`, `photo`, `mrp`, `sp`, `details`, `status`, `added_at`, `update_at`) VALUES
(1, 1, 'Black / Charcoal Facial', 'black-charcoal-facial', 'svariant-pKtuCAgx.webp', 80, 69, 'Brighten and deeply hydrate your skin for a soft, radiant, lit-from-within glow.', 1, '2025-10-11 09:26:11', '2025-10-11 09:31:46'),
(2, 1, 'Brightening / Glow Facial', 'brightening-glow-facial', 'svariant-lJB16Zxa.webp', 90, 85, 'Gentle cleanse, balanced skin — daily refresh without stripping.', 1, '2025-10-11 09:31:34', NULL),
(3, 1, 'Anti-Aging Facial', 'anti-aging-facial', 'svariant-pkAE4bns.webp', 95, 85, 'Lightweight SPF with broad-spectrum protection and a dewy finish.', 1, '2025-10-11 09:32:29', NULL),
(4, 1, 'Lifting Lymphatic Drainage', 'lifting-lymphatic-drainage', 'svariant-PVII4D3p.webp', 100, 95, 'Intense nourishment for dry, damaged hair — salon-grade repair at home.', 1, '2025-10-11 09:33:08', NULL),
(5, 1, 'Pure Balance Face Wash', 'pure-balance-face-wash', 'svariant-CMnSfHlW.webp', 85, 69, 'Gentle cleanse, balanced skin — daily refresh without stripping.', 1, '2025-10-11 09:33:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setting`
--

CREATE TABLE `tbl_setting` (
  `id` int(11) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `website` varchar(200) DEFAULT NULL,
  `facebook_link` varchar(200) DEFAULT NULL,
  `twitter_link` varchar(200) DEFAULT NULL,
  `google_link` varchar(200) DEFAULT NULL,
  `linkedin_link` varchar(200) DEFAULT NULL,
  `youtube_link` varchar(200) DEFAULT NULL,
  `instagram_link` varchar(200) DEFAULT NULL,
  `pinterest_link` varchar(200) DEFAULT NULL,
  `address2` varchar(150) DEFAULT NULL,
  `mf_time` varchar(100) DEFAULT NULL,
  `sat_time` varchar(100) DEFAULT NULL,
  `sun` varchar(150) DEFAULT NULL,
  `marquee1` text DEFAULT NULL,
  `marquee2` text DEFAULT NULL,
  `marquee3` text DEFAULT NULL,
  `marquee4` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_setting`
--

INSERT INTO `tbl_setting` (`id`, `address`, `phone`, `email`, `name`, `website`, `facebook_link`, `twitter_link`, `google_link`, `linkedin_link`, `youtube_link`, `instagram_link`, `pinterest_link`, `address2`, `mf_time`, `sat_time`, `sun`, `marquee1`, `marquee2`, `marquee3`, `marquee4`) VALUES
(1, 'Noida, India', '1234567890', 'info@skin-canberra.com', 'SkinCanberra', 'www.website.com', 'https://www.facebook.com/', 'https://twitter.com/', 'sdf', 'dfgdfg', 'http://youtube.com/', 'https://www.instagram.com/', '', ' Street address, Canberra ACT', '9:00 AM - 6:00 PM', '9:00 AM - 4:00 PM', 'Closed / By appointment', 'Open 7 Days – Book Your Appointment Anytime', 'Glow Naturally With Expert Skin & Beauty Care', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_termcondition`
--

CREATE TABLE `tbl_termcondition` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` enum('1','0') NOT NULL COMMENT '1-Active, 0-Inactive',
  `added_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_termcondition`
--

INSERT INTO `tbl_termcondition` (`id`, `title`, `url`, `description`, `status`, `added_at`, `updated_at`) VALUES
(1, 'privacy policy', 'privacy-policy', 'about us', '0', '0000-00-00 00:00:00', '2021-07-20 21:15:04'),
(4, 'term condition 2', 'term-condition-2', 'term condition', '0', '2021-07-20 22:23:16', '2021-07-20 22:23:25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_testimonial`
--

CREATE TABLE `tbl_testimonial` (
  `id` int(5) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` varchar(500) NOT NULL,
  `post` varchar(150) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `status` enum('N','Y') NOT NULL COMMENT 'N-inactive, Y-active',
  `added_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_testimonial`
--

INSERT INTO `tbl_testimonial` (`id`, `name`, `description`, `post`, `logo`, `status`, `added_at`, `update_at`) VALUES
(19, 'testimonial', 'testi', 'abc', '', 'N', '2024-05-04 07:23:05', '2024-05-04 09:39:17'),
(20, 'test2', 'test2 desc', 'bcv', '', 'N', '2024-05-04 09:38:33', NULL),
(21, 'test3', 'test3', 'test3', '', 'Y', '2024-05-04 09:58:09', '2024-10-17 07:04:49'),
(22, 'test', 'test desc', 'test', 'logo_MTcyOTE0ODcwNA==.png', 'Y', '2024-10-17 05:18:02', '2024-10-17 09:37:49');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(5) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL DEFAULT 'King of Town',
  `description` text DEFAULT NULL,
  `status` enum('publish','pending','draft') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users_temp`
--

CREATE TABLE `tbl_users_temp` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `country` int(11) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `address` varchar(400) NOT NULL,
  `status` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_users_temp`
--

INSERT INTO `tbl_users_temp` (`user_id`, `fname`, `mname`, `lname`, `country`, `dob`, `gender`, `email`, `password`, `ip_address`, `phone`, `image`, `address`, `status`, `created`, `updated`) VALUES
(1, 'md', 'raj', 'guddu', 99, '1986-01-02', 'male', 'raj@yopmail.com', '123456', '::1', '9162925142', 'u_1672925916.jpg', 'delhi', 0, '2023-01-05 02:08:36', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_banner`
--
ALTER TABLE `tbl_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_blog`
--
ALTER TABLE `tbl_blog`
  ADD PRIMARY KEY (`blg_id`);

--
-- Indexes for table `tbl_cms`
--
ALTER TABLE `tbl_cms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_countries`
--
ALTER TABLE `tbl_countries`
  ADD PRIMARY KEY (`countries_id`);

--
-- Indexes for table `tbl_happy_client`
--
ALTER TABLE `tbl_happy_client`
  ADD PRIMARY KEY (`cl_id`);

--
-- Indexes for table `tbl_newsletter`
--
ALTER TABLE `tbl_newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_page`
--
ALTER TABLE `tbl_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_services`
--
ALTER TABLE `tbl_services`
  ADD PRIMARY KEY (`sv_id`),
  ADD KEY `serv_url` (`serv_url`,`status`),
  ADD KEY `service_name` (`service_name`);

--
-- Indexes for table `tbl_services_variants`
--
ALTER TABLE `tbl_services_variants`
  ADD PRIMARY KEY (`vid`);

--
-- Indexes for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `tbl_termcondition`
--
ALTER TABLE `tbl_termcondition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_testimonial`
--
ALTER TABLE `tbl_testimonial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `tbl_users_temp`
--
ALTER TABLE `tbl_users_temp`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_banner`
--
ALTER TABLE `tbl_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_blog`
--
ALTER TABLE `tbl_blog`
  MODIFY `blg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_cms`
--
ALTER TABLE `tbl_cms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_countries`
--
ALTER TABLE `tbl_countries`
  MODIFY `countries_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- AUTO_INCREMENT for table `tbl_happy_client`
--
ALTER TABLE `tbl_happy_client`
  MODIFY `cl_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_newsletter`
--
ALTER TABLE `tbl_newsletter`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_page`
--
ALTER TABLE `tbl_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_services`
--
ALTER TABLE `tbl_services`
  MODIFY `sv_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_services_variants`
--
ALTER TABLE `tbl_services_variants`
  MODIFY `vid` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_termcondition`
--
ALTER TABLE `tbl_termcondition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_testimonial`
--
ALTER TABLE `tbl_testimonial`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_users_temp`
--
ALTER TABLE `tbl_users_temp`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
