-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2017 at 05:29 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `equalizer_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tbl`
--

CREATE TABLE `admin_tbl` (
  `admin_id` int(10) NOT NULL,
  `admin_username` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `admin_email` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `admin_password` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `secret_question` text NOT NULL,
  `answer` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`admin_id`, `admin_username`, `admin_email`, `admin_password`, `secret_question`, `answer`) VALUES
(1, 'admin', 'admin@yahoo.com', '25d55ad283aa400af464c76d713c07ad', 'What is your favorite food?', 'pakbet');

-- --------------------------------------------------------

--
-- Table structure for table `announcement_tbl`
--

CREATE TABLE `announcement_tbl` (
  `announce_id` int(10) NOT NULL,
  `announce_name` varchar(100) NOT NULL,
  `announce_photo` varchar(255) NOT NULL,
  `announce_story` longtext NOT NULL,
  `announce_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `announcement_tbl`
--

INSERT INTO `announcement_tbl` (`announce_id`, `announce_name`, `announce_photo`, `announce_story`, `announce_date`) VALUES
(1, 'Student Journalist Exam', 'mem2.jpg', 'Be a member of our great team!\r\nExamination date is on April 15 @ the Equalizer Office', '2017-04-01'),
(2, 'sfsdfsdf', 'mem2.jpg', 'We will be having a meeting on December 12 (Monday), 11:30 AM. We will discuss the details about the press conference. Please be on time.See you  TEs Office. God bless.', '0000-00-00'),
(4, 'nghjjghjg''', 'news_thumbnail3.png', 'gfdgdfgf''', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `articles_tbl`
--

CREATE TABLE `articles_tbl` (
  `article_id` int(10) NOT NULL,
  `category_id` int(10) NOT NULL,
  `article_title` varchar(100) NOT NULL,
  `article_writer` varchar(100) NOT NULL,
  `article_photo` varchar(255) NOT NULL,
  `article_headline` text NOT NULL,
  `article_story` text NOT NULL,
  `article_date` date NOT NULL,
  `article_views` int(9) NOT NULL,
  `article_featured` varchar(15) NOT NULL DEFAULT 'no',
  `year` year(4) NOT NULL DEFAULT '2017'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `articles_tbl`
--

INSERT INTO `articles_tbl` (`article_id`, `category_id`, `article_title`, `article_writer`, `article_photo`, `article_headline`, `article_story`, `article_date`, `article_views`, `article_featured`, `year`) VALUES
(7, 2, 'Sample Title', 'Sample Writer', '12417795_10153646616614300_6056490163123349950_n.jpg', 'This Is A Headline', 'This Is A Story', '2017-04-22', 27, 'yes', 2017),
(8, 3, 'Second Title', 'Second Writer', 'IMG_20170203_091405.jpg', 'Head 2', 'Story 2', '2017-04-29', 47, 'yes', 2017),
(9, 1, 'Op', 'russel', 'P_20160307_172704.jpg', 'Asdas', 'Asdasd', '2017-04-07', 38, 'yes', 2017),
(10, 1, 'Asdasd', 'chonna', 'P_20160106_132436.jpg', 'Asdasd', 'Asdasd', '2017-04-15', 79, 'yes', 2017),
(11, 10, 'As2', 'Asdasd', '16114008_10154028209956059_3368224433459662596_n.jpg', 'Asdas Asd', ' Asd Asd', '2017-04-23', 15, 'no', 2017),
(12, 11, 'Sdasd', 'D Asd', '15977336_10208138843051901_940078783610412896_n.jpg', ' Asd', 'As D', '2017-04-15', 2, 'yes', 2017),
(13, 1, 'Asdasd', 'Da Sd', 'P_20160302_103947.jpg', ' Asd ', 'A Sd', '2017-04-22', 13, 'yes', 2017),
(14, 12, 'Jump', 'GG', '12366457_10206843012612843_3690908417498674900_n.jpg', 'Healine', 'Story', '2017-04-30', 2, 'no', 2017),
(15, 12, 'Gdfhgfhfg', 'Ghfghfgh', '12079317_10153362979379398_3599158818059657398_n.jpg', 'Fgvfdgfgdfgdfg', 'Fdsgdfgdfghdfghdfgsd Dfgvbfdgfg', '0000-00-00', 3, 'no', 2017),
(22, 9, 'Fsfs', 'Sfsdfs', '12115725_10153089702587371_8572598480330226584_n.jpg', 'Dsfdfsdfds', 'Dfsfsdfs', '2001-12-13', 0, 'no', 2017),
(23, 3, 'Sdasd', 'Asdadsa', '12189145_899813586723128_6818942689188602945_n.jpg', 'Dsadas', 'Sdsadsad', '2001-12-13', 1, 'no', 2017),
(24, 10, 'Fgsdfdf', 'Dsfsdfsdf', 'P_20160106_132436.jpg', 'Dfsdfsdf', 'Dsfsdfsdf', '2017-04-25', 0, 'no', 2017);

-- --------------------------------------------------------

--
-- Table structure for table `category_tbl`
--

CREATE TABLE `category_tbl` (
  `category_id` int(5) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_navi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category_tbl`
--

INSERT INTO `category_tbl` (`category_id`, `category_name`, `category_navi`) VALUES
(1, 'News', 1),
(2, 'Editorial', 2),
(3, 'Opinion', 2),
(4, 'Feature', 3),
(6, 'Poems', 4),
(7, 'Essay', 4),
(8, 'Short Stories', 4),
(9, 'Artworks', 4),
(10, 'Photography', 4),
(11, 'Entertainment', 5),
(12, 'Sports', 6);

-- --------------------------------------------------------

--
-- Table structure for table `comment_tbl`
--

CREATE TABLE `comment_tbl` (
  `comment_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `comment` longtext NOT NULL,
  `date` datetime NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `article_id` int(10) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'waiting',
  `link` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment_tbl`
--

INSERT INTO `comment_tbl` (`comment_id`, `user_id`, `comment`, `date`, `username`, `email`, `article_id`, `status`, `link`) VALUES
(1, 2, 'ajsdugbf', '2017-04-08 09:58:34', 'asd', 'admin@yahoo.com', 10, 'seen', 'article_item.php?arn=10&artname=News&artnum=1&id=10'),
(2, 2, 'csfdsdfsdfsadfsdf', '2017-04-10 16:06:18', 'gffgsdf', 'sdfsdfsd@y.com', 13, 'seen', 'article_item.php?arn=13&artname=News&artnum=1&id=13');

-- --------------------------------------------------------

--
-- Table structure for table `contact_tbl`
--

CREATE TABLE `contact_tbl` (
  `contact_id` int(11) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `address` varchar(200) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `facebook` varchar(75) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_tbl`
--

INSERT INTO `contact_tbl` (`contact_id`, `message`, `address`, `contact_number`, `facebook`, `email`) VALUES
(1, 'Don''t hesitate to contact us', 'Mabalacat City College: Rizal St. MacArthur Highway, Dolores, Mabalacat', '09394739793', 'Official The Equalizer - www.facebook.com/officialtheequalizer/', 'equalizermcc2017@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `daily_view_tbl`
--

CREATE TABLE `daily_view_tbl` (
  `view_id` int(8) NOT NULL,
  `date` date DEFAULT NULL,
  `article_views` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daily_view_tbl`
--

INSERT INTO `daily_view_tbl` (`view_id`, `date`, `article_views`) VALUES
(1, '2017-04-05', 4),
(3, '2017-04-03', 8),
(6, '2017-04-04', 1),
(7, '2017-04-02', 26),
(8, '2017-04-06', 1),
(9, '2017-04-07', 13),
(10, '2017-04-08', 1),
(11, '2017-04-09', 12),
(12, '2017-04-10', 14),
(13, '2017-04-18', 16),
(14, '2017-04-19', 3),
(15, '2017-04-26', 24);

-- --------------------------------------------------------

--
-- Table structure for table `issue_tbl`
--

CREATE TABLE `issue_tbl` (
  `issue_id` int(10) NOT NULL,
  `issue_type_id` int(11) NOT NULL,
  `issue_name` varchar(100) NOT NULL,
  `issue_date` date NOT NULL,
  `issue_photo` varchar(255) NOT NULL,
  `issue_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issue_tbl`
--

INSERT INTO `issue_tbl` (`issue_id`, `issue_type_id`, `issue_name`, `issue_date`, `issue_photo`, `issue_file`) VALUES
(10, 1, 'asdasd', '2017-03-31', '14456901_120300000280787546_586211752_o.jpg', '00272017051100324.pdf'),
(11, 1, 'Asdasdss', '2017-04-21', 'sabulum1.jpg', '002720170511003241.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `issue_type_tbl`
--

CREATE TABLE `issue_type_tbl` (
  `issue_type_id` int(5) NOT NULL,
  `issue_type_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issue_type_tbl`
--

INSERT INTO `issue_type_tbl` (`issue_type_id`, `issue_type_name`) VALUES
(1, 'Newsletter'),
(2, 'Tabloid'),
(3, 'Broadsheet'),
(4, 'Balas'),
(5, 'Sabulum');

-- --------------------------------------------------------

--
-- Table structure for table `links_tbl`
--

CREATE TABLE `links_tbl` (
  `link_id` int(11) NOT NULL,
  `link_name` varchar(100) NOT NULL,
  `link_address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `links_tbl`
--

INSERT INTO `links_tbl` (`link_id`, `link_name`, `link_address`) VALUES
(1, 'facebook', 'https://www.facebook.com/equalizer'),
(2, 'twitter', 'https://www.twitter.com/equalizer'),
(3, 'googleplus', 'https://googleplus.com/equalizer'),
(4, 'youtube', 'https://youtube.com/equalizer'),
(5, 'mail', 'mailto:equalizermcc2016@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `message_tbl`
--

CREATE TABLE `message_tbl` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `number` varchar(14) NOT NULL,
  `subject` varchar(500) NOT NULL,
  `message` varchar(3000) NOT NULL,
  `date` datetime NOT NULL,
  `notify` varchar(20) NOT NULL DEFAULT 'waiting',
  `status` varchar(30) NOT NULL DEFAULT 'unread'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message_tbl`
--

INSERT INTO `message_tbl` (`id`, `name`, `email`, `number`, `subject`, `message`, `date`, `notify`, `status`) VALUES
(25, 'Adrian Fronda Quitalig', 'adrian@yahoo.com', '09351111244', 'kamusta', 'Hello po kamusta po kau jan.', '0000-00-00 00:00:00', 'seen', 'unread'),
(26, 'Adrian Fronda Quitalig', 'adrian@yahoo.com', '09351111244', 'kamusta', 'Hello po kamusta po kau jan.', '0000-00-00 00:00:00', 'seen', 'unread'),
(27, 'Adrian Fronda Quitalig', 'adrian@yahoo.com', '09351111244', 'kamusta', 'Hello po kamusta po kau jan.', '0000-00-00 00:00:00', 'seen', 'unread'),
(28, 'Adrian Fronda Quitalig', 'adrian@yahoo.com', '09351111244', 'kamusta', 'Hello po kamusta po kau jan.', '0000-00-00 00:00:00', 'seen', 'unread'),
(31, 'Adrian Fronda Quitalig', 'adrian@yahoo.com', '09351111244', 'kamusta', 'Hello po kamusta po kau jan.', '0000-00-00 00:00:00', 'seen', 'unread'),
(32, 'Kevin', 'kevin@yahoo.com', '09197845612', 'Exam date', 'Good evening po ask ko lang po kung kailan po ung exam ngaung finals. Salamat po', '0000-00-00 00:00:00', 'seen', 'unread'),
(33, 'Kevin', 'kevin@yahoo.com', '09197845612', 'Exam date', 'Good evening po ask ko lang po kung kailan po ung exam ngaung finals. Salamat po', '0000-00-00 00:00:00', 'seen', 'unread'),
(34, 'Kevin', 'kevin@yahoo.com', '09197845612', 'Exam date', 'Good evening po ask ko lang po kung kailan po ung exam ngaung finals. Salamat po', '0000-00-00 00:00:00', 'seen', 'unread'),
(35, 'Kevin', 'kevin@yahoo.com', '09197845612', 'Exam date', 'Good evening po ask ko lang po kung kailan po ung exam ngaung finals. Salamat po', '0000-00-00 00:00:00', 'seen', 'unread'),
(36, 'Kevin', 'kevin@yahoo.com', '09197845612', 'Exam date', 'Good evening po ask ko lang po kung kailan po ung exam ngaung finals. Salamat po', '0000-00-00 00:00:00', 'seen', 'unread'),
(37, 'Kevin', 'kevin@yahoo.com', '09197845612', 'Exam date', 'Good evening po ask ko lang po kung kailan po ung exam ngaung finals. Salamat po', '0000-00-00 00:00:00', 'seen', 'unread'),
(38, 'Kevin', 'kevin@yahoo.com', '09197845612', 'Exam date', 'Good evening po ask ko lang po kung kailan po ung exam ngaung finals. Salamat po', '0000-00-00 00:00:00', 'seen', 'unread'),
(39, 'Ruvs Marin', 'ruvs@yahoo.com', '0935400124', 'Questioin lang po', 'Nakapulot po kasi ako ng relo. balak ko po sanang isauli sa may ari. Patulong naman po kung ano gagawin ko', '0000-00-00 00:00:00', 'seen', 'read'),
(40, 'Ruvs Marin', 'ruvs@yahoo.com', '0935400124', 'Questioin lang po', 'Nakapulot po kasi ako ng relo. balak ko po sanang isauli sa may ari. Patulong naman po kung ano gagawin ko', '0000-00-00 00:00:00', 'seen', 'unread'),
(41, 'Ruvs Marin', 'ruvs@yahoo.com', '0935400124', 'Questioin lang po', 'Nakapulot po kasi ako ng relo. balak ko po sanang isauli sa may ari. Patulong naman po kung ano gagawin ko', '0000-00-00 00:00:00', 'seen', 'read'),
(42, 'Ruvs Marin', 'ruvs@yahoo.com', '0935400124', 'Questioin lang po', 'Nakapulot po kasi ako ng relo. balak ko po sanang isauli sa may ari. Patulong naman po kung ano gagawin ko', '0000-00-00 00:00:00', 'seen', 'unread'),
(43, 'Ruvs Marin', 'ruvs@yahoo.com', '0935400124', 'Questioin lang po', 'Nakapulot po kasi ako ng relo. balak ko po sanang isauli sa may ari. Patulong naman po kung ano gagawin ko', '0000-00-00 00:00:00', 'seen', 'unread'),
(46, 'asdasd', 'asda@asdasd.asd', '12312312323', 'asdasdfasdf', 'asdfasdf asd asdf', '2017-04-12 13:11:13', 'seen', 'unread'),
(47, 'asd', 'admin@yahoo.com', '1212121212', 'qwe', 'as sdfa sdf', '2017-04-02 03:26:32', 'seen', 'unread'),
(48, 'aaaaaaaaaaaaa', 'admin@yahoo.com', '11111122222222', 'aaaaaaaaaaaaaaaaaaaaaaa', 'sssssssssssssssssssssssssss', '2017-04-02 03:27:47', 'seen', 'unread'),
(49, 'asdasd', 'admin@yahoo.com', '1331123', 'asdd', 'asdasd', '2017-04-02 03:28:18', 'seen', 'unread'),
(50, 'Adrian Quitalig', 'admin@yahoo.com', '11111111111111', 'sssssssssssssssssssssaa', 'ssssssssssssssssssssssaa', '0000-00-00 00:00:00', 'seen', 'unread'),
(51, 'Adrian Quitalig', 'admin@yahoo.com', '11111111111111', 'sssssssssssssssssssssaa', 'ssssssssssssssssssssssaa', '0000-00-00 00:00:00', 'seen', 'unread'),
(53, 'ggness', 'asdas@232', '123123123', 'aaaaaaaaaaaaaaaaaaaaaaassa', 'asdasdasd asd as d', '0000-00-00 00:00:00', 'seen', 'unread'),
(57, 'asdas', 'asdasdasd@yahoo.com', '123123123', ' asd asd asd', 'a sdasdas da', '2017-04-02 22:43:01', 'seen', 'read'),
(58, 'Adrian Quitaligs', 'admina@yahoo.com', '11122222222222', 'aaaaaaaaaaaaaaaaaaaaaaa', 'sssssssssssssssssssss', '2017-04-02 22:45:10', 'seen', 'read'),
(59, 'Adrian Quitalig', '232@g', '123123123', 'asdasd', 'bbbbbbbbbbbbbbbbbbbbbbbb', '2017-04-02 22:45:40', 'seen', 'read'),
(60, 'Adrian Quitalig', 'sss@yahoo.com', '11111111111111', 'ssssssssaaaaaaaaa', 'sssssssssssssssssa', '2017-04-02 23:16:57', 'seen', 'read');

-- --------------------------------------------------------

--
-- Table structure for table `notification_tbl`
--

CREATE TABLE `notification_tbl` (
  `notification_id` int(10) NOT NULL,
  `notification` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `sender` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `security_question_tbl`
--

CREATE TABLE `security_question_tbl` (
  `sec_id` int(5) NOT NULL,
  `question` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `security_question_tbl`
--

INSERT INTO `security_question_tbl` (`sec_id`, `question`) VALUES
(1, 'What is your favorite food?'),
(2, 'What is your grandmother''s middle name?'),
(4, 'Who is your first grade teacher'),
(3, 'Who is your worst teacher in elementary?');

-- --------------------------------------------------------

--
-- Table structure for table `staff_tbl`
--

CREATE TABLE `staff_tbl` (
  `staff_id` int(5) NOT NULL,
  `staff_name` varchar(35) NOT NULL,
  `staff_position` varchar(100) NOT NULL,
  `staff_group` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_tbl`
--

INSERT INTO `staff_tbl` (`staff_id`, `staff_name`, `staff_position`, `staff_group`) VALUES
(1, 'LOVELY P. BARAZON', 'Editor-in-Chief', 1),
(2, 'OLIVER Z. MANARANG', 'Associate Editor', 1),
(3, 'JERICO MAGSINO', 'News Editor', 1),
(4, 'IRENE L. GUNNING', 'Feature Editor', 1),
(5, 'JEFFREY Q. GABATIN', 'Layout Artist', 2),
(6, 'AEROLL C. TIOSEN', 'Editorial Artist', 2),
(7, 'JERRYMAY B. LAYSON', 'Head Photojournalist', 2),
(8, 'IRA FAYE S. NIDUAZA', 'Managing Editor', 1),
(9, 'KEVIN L. MAGLAQUI', 'Sports Editor', 1),
(10, 'KENN M. SANTOS', 'Circulation Manager', 1),
(11, 'Duarnold Arceo', 'Writer', 3),
(12, 'Alissandra Isabelle Bayani', 'Writer', 3),
(13, 'Giselle Dela Cruz', 'Writer', 3),
(14, 'Jerald G. Galvan', 'Writer', 3),
(15, 'Jay-r C. Guinto', 'Writer', 3),
(16, 'Sherlen Rose Liwanag', 'Writer', 3),
(17, 'Regielyn W. Ocampo', 'Writer', 3),
(18, 'Renz H. Pineda', 'Writer', 3),
(19, 'Krisel Bolante', 'Cartoonist', 4),
(20, 'Lourraine Cabatuan', 'Cartoonist', 4),
(21, 'Bryan Divina', 'Cartoonist', 4),
(22, 'Samantha Linsangan', 'Cartoonist', 4),
(23, 'Angelica Malquisto', 'Cartoonist', 4),
(24, 'Agnes Miranda', 'Cartoonist', 4),
(25, 'Twilah Felis S. De Ocampo', 'Photojournalist', 5),
(26, 'Joseph Mistades', 'Photojournalist', 5),
(27, 'Harvey Rodriguez', 'Photojournalist', 5),
(28, 'Robert Chattlyn Tuazon', 'Photojournalist', 5),
(29, 'Mikko Journey S. Velilla', 'Photojournalist', 5),
(30, 'MS. ANNE CHRISTINE C. DUARTE', 'Technical Adviser', 6);

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `user_id` int(10) NOT NULL,
  `username` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `user_email` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `user_pass` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `secret_question` text NOT NULL,
  `answer` varchar(100) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `birthdate` date NOT NULL,
  `contact` mediumint(15) NOT NULL,
  `address` varchar(200) NOT NULL,
  `course` varchar(50) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `civil_status` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`user_id`, `username`, `user_email`, `user_pass`, `secret_question`, `answer`, `fname`, `mname`, `lname`, `birthdate`, `contact`, `address`, `course`, `gender`, `photo`, `civil_status`, `date`) VALUES
(1, 'chins', 'chonna@yahoo.com', '25d55ad283aa400af464c76d713c07ad', 'What is your favorite food?', 'paksiw', 'Chonna', 'De Guzman', 'Nicdao', '0000-00-00', 8388607, 'address', '', 'female', 'chonna@yahoo.com', 'Single', '2017-04-08 16:36:51'),
(2, 'adrian', 'adrian@yahoo.com', '25d55ad283aa400af464c76d713c07ad', 'What is your favorite food?', 'paksiw', 'adrian', 'fronda', 'quitalig', '0000-00-00', 8388607, 'rizal street', '', 'male', 'adrian@yahoo.com', 'Single', '2017-04-08 16:36:51'),
(3, 'russel', 'russel@yahoo.com', '25d55ad283aa400af464c76d713c07ad', 'What is your favorite food?', 'paksiw', 'russel', 'zafe', 'laroga', '0000-00-00', 8388607, 'erewrwerw', '', 'male', 'russel@yahoo.com', 'Single', '2017-04-08 16:36:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_username` (`admin_username`),
  ADD UNIQUE KEY `admin_email` (`admin_email`);

--
-- Indexes for table `announcement_tbl`
--
ALTER TABLE `announcement_tbl`
  ADD PRIMARY KEY (`announce_id`);

--
-- Indexes for table `articles_tbl`
--
ALTER TABLE `articles_tbl`
  ADD PRIMARY KEY (`article_id`);

--
-- Indexes for table `category_tbl`
--
ALTER TABLE `category_tbl`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `comment_tbl`
--
ALTER TABLE `comment_tbl`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `contact_tbl`
--
ALTER TABLE `contact_tbl`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `daily_view_tbl`
--
ALTER TABLE `daily_view_tbl`
  ADD PRIMARY KEY (`view_id`);

--
-- Indexes for table `issue_tbl`
--
ALTER TABLE `issue_tbl`
  ADD PRIMARY KEY (`issue_id`);

--
-- Indexes for table `issue_type_tbl`
--
ALTER TABLE `issue_type_tbl`
  ADD PRIMARY KEY (`issue_type_id`);

--
-- Indexes for table `links_tbl`
--
ALTER TABLE `links_tbl`
  ADD PRIMARY KEY (`link_id`);

--
-- Indexes for table `message_tbl`
--
ALTER TABLE `message_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_tbl`
--
ALTER TABLE `notification_tbl`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `security_question_tbl`
--
ALTER TABLE `security_question_tbl`
  ADD PRIMARY KEY (`sec_id`),
  ADD UNIQUE KEY `question` (`question`);

--
-- Indexes for table `staff_tbl`
--
ALTER TABLE `staff_tbl`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `announcement_tbl`
--
ALTER TABLE `announcement_tbl`
  MODIFY `announce_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `articles_tbl`
--
ALTER TABLE `articles_tbl`
  MODIFY `article_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `category_tbl`
--
ALTER TABLE `category_tbl`
  MODIFY `category_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `comment_tbl`
--
ALTER TABLE `comment_tbl`
  MODIFY `comment_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `contact_tbl`
--
ALTER TABLE `contact_tbl`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `daily_view_tbl`
--
ALTER TABLE `daily_view_tbl`
  MODIFY `view_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `issue_tbl`
--
ALTER TABLE `issue_tbl`
  MODIFY `issue_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `issue_type_tbl`
--
ALTER TABLE `issue_type_tbl`
  MODIFY `issue_type_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `links_tbl`
--
ALTER TABLE `links_tbl`
  MODIFY `link_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `message_tbl`
--
ALTER TABLE `message_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `notification_tbl`
--
ALTER TABLE `notification_tbl`
  MODIFY `notification_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `security_question_tbl`
--
ALTER TABLE `security_question_tbl`
  MODIFY `sec_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `staff_tbl`
--
ALTER TABLE `staff_tbl`
  MODIFY `staff_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
