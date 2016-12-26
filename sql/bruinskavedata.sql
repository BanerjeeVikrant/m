-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 03, 2016 at 01:31 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bruinskavedata`
--
CREATE DATABASE IF NOT EXISTS `bruinskavedata` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `bruinskavedata`;

-- --------------------------------------------------------

--
-- Table structure for table `anoncomments`
--

CREATE TABLE IF NOT EXISTS `anoncomments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `from` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `anoncomments`
--

INSERT INTO `anoncomments` (`id`, `comment`, `from`) VALUES
(1, 'hi', 'ssdf'),
(2, 'hola', 'ssdf'),
(3, 'hi', 'ssdf'),
(4, 'hi', 'ssdf'),
(5, 'hijkj', 'ssdf'),
(6, 'hi', 'ssdf'),
(7, 'hi', 'ssdf'),
(8, 'hey', 'ssdf'),
(9, 'hi', 'ssdf'),
(10, 'Ggh', 'Ssdf');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `from` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=154 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `from`) VALUES
(7, 'This is the first comment', 'ssdf'),
(8, 'Second Comment', 'ssdf'),
(9, 'Hello', 'ssdf'),
(10, 'Second comment', 'ssdf'),
(11, 'This is a comment test', 'ssdf'),
(12, 'This is a comment sdlfksldkfj ksjdflksd fklsjdlfk  lf fslkdjfl sd flksd f s jdlklf lskdjf dlkjfl dkf ldkfjl dkfjlkdj fld  lf ldkfj', 'ssdf'),
(13, 'Hi', 'ssdf'),
(14, 'Third comment', 'ssdf'),
(15, 'bye', 'ssdf'),
(16, 'try', 'ssdf'),
(17, 'hi', 'ssdf'),
(18, 'New Third comment', 'ssdf'),
(19, 'SSSSSS', 'ssdf'),
(20, 'Fourth comment', 'ssdf'),
(21, 'New fourth comment', 'ssdf'),
(22, 'Comment', 'ssdf'),
(23, 'working', 'ssdf'),
(24, 'what is this all about?', 'ssdf'),
(25, 'what is this', 'ssdf'),
(26, 'this is a different notification test', 'ssdf'),
(27, 'this is slow', 'ssdf'),
(28, 'hey', 'ssdf'),
(29, 'now a days', 'ssdf'),
(30, 'deal', 'ssdf'),
(31, 'lkj', 'ssdf'),
(32, 'I am serious', 'ssdf'),
(33, 'ok', 'ssdf'),
(34, 'thid', 'ssdf'),
(35, 'hi', 'ssdf'),
(36, 'thats it', 'ssdf'),
(37, 'right', 'ssdf'),
(38, 'ok', 'ssdf'),
(39, 'ok', 'ssdf'),
(40, 'hi', 'ssdf'),
(41, 'hello', 'ssdf'),
(42, 'hi', 'ssdf'),
(43, 'hi', 'ssdf'),
(44, 'j', 'ssdf'),
(45, 'hi', 'ssdf'),
(46, 'hil', 'ssdf'),
(47, 'hi', 'ssdf'),
(48, 'hi', 'ssdf'),
(49, 'hereer', 'ssdf'),
(50, 'hi', 'ssdf'),
(51, 'hi', 'ssdf'),
(52, 'hi', 'ssdf'),
(53, 'hi', 'ssdf'),
(54, 'hi', 'ssdf'),
(55, 'hi', 'ssdf'),
(56, 'hi', 'ssdf'),
(57, 'hey', 'ssdf'),
(58, 'hey', 'ssdf'),
(59, 'ok', 'ssdf'),
(60, 'fine', 'ssdf'),
(61, 'hi', 'ssdf'),
(62, 'hi', 'ssdf'),
(63, 'hey', 'ssdf'),
(64, 'doesnt understand', 'ssdf'),
(65, 'hi', 'ssdf'),
(66, 'biscuit ', 'ssdf'),
(67, 'hi', 'ssdf'),
(68, 'this is not right but i will still try to do what is nessary', 'ssdf'),
(69, 'hi', 'ssdf'),
(70, 'hi', 'ssdf'),
(71, 'hola', 'ssdf'),
(72, 'hi', 'ssdf'),
(73, 'hi', 'ssdf'),
(74, 'hi', 'ssdf'),
(75, 'hi', 'ssdf'),
(76, 'hi', 'ssdf'),
(77, 'hi', 'ssdf'),
(78, 'hi', 'ssdf'),
(79, 'hey', 'ssdf'),
(80, 'ok', 'ssdf'),
(81, 'hi', 'ssdf'),
(82, 'hello', 'ssdf'),
(83, 'xyz', 'ssdf'),
(84, 'yzd', 'ssdf'),
(85, 'weed?', 'ssdf'),
(86, 'no then', 'ssdf'),
(87, 'hi', 'ssdf'),
(88, 'alright', 'ssdf'),
(89, 'this is it', 'ssdf'),
(90, 'lie', 'ssdf'),
(91, 'dont care', 'ssdf'),
(92, 'hi', 'ssdf'),
(93, 'Hi', 'ssdf'),
(94, 'Hi', 'ssdf'),
(95, 'hi', 'ssdf'),
(96, 'Hey meg', 'ssdf'),
(97, 'Ok i get you', 'Ssdf'),
(98, 'Who is this i dont know why i am asking it i should know who this person is just tring to check how long comments work with the notifications section', 'ssdf'),
(99, '   Who is this i dont know why i am asking it i should know who this person is just tring to check how long comments work with the notifications section                                             ', 'test'),
(100, 'hi', 'ssdf'),
(101, 'hi', 'ssdf'),
(102, 'Hi', 'Ssdf'),
(103, 'did u like the picture ?', 'test'),
(104, 'Nice', 'Test'),
(105, 'Up', 'Test'),
(106, 'htuyu', 'ssdf'),
(107, 'hi', 'test'),
(108, 'asdsad', 'test'),
(109, 'sad', 'test'),
(110, 'asd', 'test'),
(111, 'asd', 'test'),
(112, 'asd', 'test'),
(113, 'sad', 'test'),
(114, 'asd', 'test'),
(115, 'asd', 'test'),
(116, 'sad', 'test'),
(117, 'sad', 'test'),
(118, 'hi', 'test'),
(119, '&lt;h1&gt;hi&lt;/h1&gt;', 'test'),
(120, 'hi', 'ssdf'),
(121, 'hi', 'test'),
(122, 'hi', 'test'),
(123, 'hi', 'test'),
(124, 'hi', 'test'),
(125, 'hola', 'test'),
(126, 'ihihhih', 'ssdf'),
(127, 'hi', 'ssdf'),
(128, 'hi', 'ssdf'),
(129, 'sadfjalskdjfalskdfj', 'ssdf'),
(130, 'hi', 'ssdf'),
(131, 'hi', 'ssdf'),
(132, 'hi', 'ssdf'),
(133, 'hjlkjlk', 'ssdf'),
(134, 'hkj', 'ssdf'),
(135, 'hi', 'ssdf'),
(136, 'kjlkj', 'ssdf'),
(137, 'hi', 'ssdf'),
(138, 'hi', 'ssdf'),
(139, 'hi', 'ssdf'),
(140, 'hi', 'ssdf'),
(141, 'hi', 'ssdf'),
(142, 'sdfas', 'ssdf'),
(143, 'skdfl', 'ssdf'),
(144, 'sdkjf', 'ssdf'),
(145, 'hey', 'ssdf'),
(146, 'hi', 'ssdf'),
(147, '', 'ssdf'),
(148, 'i', 'ssdf'),
(149, 'hi', 'ssdf'),
(150, 'hi', 'ssdf'),
(151, 'hi', 'ssdf'),
(152, 'hi', 'ssdf'),
(153, 'hi', 'ssdf');

-- --------------------------------------------------------

--
-- Table structure for table `crush`
--

CREATE TABLE IF NOT EXISTS `crush` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `body` text NOT NULL,
  `by` text NOT NULL,
  `picture` text NOT NULL,
  `time_added` text NOT NULL,
  `date_added` text NOT NULL,
  `commentsid` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `crush`
--

INSERT INTO `crush` (`id`, `body`, `by`, `picture`, `time_added`, `date_added`, `commentsid`) VALUES
(18, 'Hello', 'ssdf', '', '1478585766', '', ''),
(19, 'hey', 'test', '', '1478934937', '', ''),
(20, 'again', 'test', '', '1478936822', '', ''),
(21, 'hi', 'ssdf', '', '1478937031', '', ''),
(22, 'hey\r\n', 'ssdf', '', '1478937056', '', '10'),
(23, 'hi\r\n', 'ssdf', '', '1478937255', '', ''),
(24, 'jfalsdkfj', 'test', '', '1478937279', '', ''),
(25, 'hey', 'test', '', '1479009695', '', ''),
(26, 'this post', 'test', '', '1479009732', '', ''),
(27, 'heyyyyyy.....', 'test', '', '1479010296', '', ''),
(28, 'sfasdlf', 'test', '', '1479010360', '', ''),
(29, 'hola', 'test', '', '1479010445', '', '1,2,1,2,1,3,4,5,6,7,8,9');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `name` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `creator` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`name`, `id`, `creator`, `description`) VALUES
('test group', 1, 'test', 'a test'),
('another', 2, 'test', 'another test');

-- --------------------------------------------------------

--
-- Table structure for table `hashtags`
--

CREATE TABLE IF NOT EXISTS `hashtags` (
  `word` varchar(255) NOT NULL,
  `post_ids` text NOT NULL,
  PRIMARY KEY (`word`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hashtags`
--

INSERT INTO `hashtags` (`word`, `post_ids`) VALUES
('#hello', '87'),
('#hi', '94,95'),
('#me', '34,36,38,39');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fromUser` text NOT NULL,
  `toUser` text NOT NULL,
  `message` text NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=131 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `fromUser`, `toUser`, `message`, `time`) VALUES
(1, '1', '2', 'This is for testing', 1478887824),
(2, '2', '1', 'This is for stesting', 1478887824),
(3, '2', '1', 'This is for third testing', 1478887824),
(4, '1', '2', 'this is test to put in database', 1478887824),
(5, '1', '2', 'hey', 1478887824),
(6, '1', '2', 'Genius', 1478887824),
(7, '2', '1', 'ok', 1478887824),
(8, '1', '2', 'ok so it is working', 1478887824),
(9, '1', '2', 'vikrant is lame', 1478887824),
(10, '1', '2', 'y u annoyng?', 1478887824),
(11, '1', '2', 'this was funny', 1478887824),
(12, '1', '2', 'ok done!', 1478887824),
(13, '1', '2', 'now lets see', 1478887824),
(14, '1', '2', 'new', 1478887824),
(15, '1', '2', 'hi', 1478887824),
(16, '1', '2', 'right', 1478887824),
(17, '1', '2', 'Helli', 1478887824),
(18, '1', '2', 'Hi', 1478887824),
(19, '1', '2', 'alright', 1478887824),
(20, '1', '2', 'hi', 1478887824),
(21, '1', '1', 'Hello!', 1478887824),
(22, '2', '1', 'Hi', 1478887824),
(23, '1', '2', 'But oh no', 1478887824),
(24, '2', '1', 'Why', 1478887824),
(25, '1', '2', 'Yolo', 1478887824),
(26, '1', '2', 'U = lame', 1478887824),
(27, '2', '1', 'OK', 1478887824),
(28, '1', '2', 'U agree', 1478887824),
(29, '2', '1', 'Ok', 1478887824),
(30, '1', '2', 'Hi', 1478887824),
(31, '1', '2', 'Hey', 1478887824),
(32, '1', '3', 'Heyyy', 1478887824),
(33, '1', '2', 'Hi', 1478887824),
(34, '2', '1', 'Hry', 1478887824),
(35, '2', '1', 'Hi', 1478887824),
(36, '2', '1', 'Hey', 1478887824),
(37, '2', '1', 'Fjfn', 1478887824),
(38, '2', '1', 'Fjnfj', 1478887824),
(39, '2', '1', 'Hi', 1478887824),
(40, '2', '1', 'Ji', 1478887824),
(41, '2', '1', 'Hc', 1478887824),
(42, '2', '1', 'Bnn', 1478887824),
(43, '2', '1', 'Hi', 1478887824),
(44, '2', '1', 'Hv', 1478887824),
(45, '1', '2', 'hi', 1478887824),
(46, '1', '2', 'hello', 1478887824),
(47, '1', '3', 'hi', 1478887824),
(48, '1', '2', 'Hey', 1478887824),
(49, '1', '2', 'Dude whats up?', 1478887824),
(50, '1', '2', 'Hey', 1478887824),
(51, '1', '2', 'hi', 1478887824),
(52, '5', '1', 'hi', 1478887824),
(53, '1', '5', 'hi', 1478887824),
(54, '1', '2', 'hi', 1478887824),
(55, '1', '1', 'Hi', 1478887824),
(56, '1', '2', 'Hi', 1478887824),
(57, '2', '1', 'try', 1478887824),
(58, '1', '2', 'Hola como estas', 1478887824),
(59, '2', '1', 'i am fine', 1478887824),
(60, '1', '1', 'Hi', 1478887824),
(61, '2', '1', 'Holla', 1478887824),
(62, '1', '2', 'Hi', 1478887824),
(63, '2', '1', 'Hola', 1478887824),
(64, '1', '2', 'What', 1478887824),
(65, '2', '1', 'What is this', 1478887824),
(66, '1', '2', 'What do you want', 1478887824),
(67, '2', '1', 'Hola is actually Ola', 1478887824),
(68, '1', '2', 'Do what', 1478887824),
(69, '2', '1', 'I can see everthing fine, so far.', 1478887824),
(70, '1', '2', 'Ok', 1478887824),
(71, '2', '1', 'What about you ?', 1478887824),
(72, '1', '2', 'Ok', 1478887824),
(73, '2', '1', 'Do you see any problem ?', 1478887824),
(74, '1', '2', 'Not right', 1478887824),
(75, '1', '2', 'Now', 1478887824),
(76, '2', '1', 'No I am exausted..', 1478887824),
(77, '1', '2', 'Keep on doing', 1478887824),
(78, '2', '1', '5 times', 1478887824),
(79, '2', '1', '4 more times', 1478887824),
(80, '1', '2', 'Checking for double input', 1478887824),
(81, '2', '1', '3 more times', 1478887824),
(82, '1', '2', '', 1478887824),
(83, '2', '1', '2 times', 1478887824),
(84, '1', '2', '', 1478887824),
(85, '1', '2', '', 1478887824),
(86, '1', '2', '', 1478887824),
(87, '2', '1', '1 time', 1478887824),
(88, '2', '1', 'time up', 1478887824),
(89, '1', '2', 'ðŸ˜­', 1478887824),
(90, '1', '2', 'H', 1478887824),
(91, '2', '1', 'h', 1478887824),
(92, '2', '1', 'h', 1478887824),
(93, '2', '1', 'h', 1478887824),
(94, '1', '2', 'h', 1478887824),
(95, '1', '2', 'h', 1478887824),
(96, '1', '3', 'hi', 1478887824),
(97, '2', '1', 'What?', 1478887824),
(98, '1', '2', 'hi', 1478887824),
(99, '2', '1', 'Ok bro', 1478887824),
(100, '1', '2', 'hey', 1478887824),
(101, '1', '3', 'ok', 1478887824),
(102, '1', '3', 'hi', 1478887824),
(103, '1', '2', 'test', 1478887824),
(104, '1', '3', 'hi', 1478887824),
(105, '1', '3', 'hi', 1478887824),
(106, '1', '3', 'hi', 1478887824),
(107, '1', '3', 'hey', 1478887824),
(108, '1', '2', 'ok', 1478887824),
(109, '2', '1', 'That s it', 1478887824),
(110, '2', '3', 'Hi', 1478887824),
(111, '1', '2', 'Ok bro', 1478887824),
(112, '1', '2', 'Bro whats up', 1478887824),
(113, '2', '1', 'Dustu', 1478887824),
(114, '1', '2', 'U dustu', 1478887824),
(115, '2', '1', 'U very dustu', 1478887824),
(116, '1', '2', 'Ni i am good.', 1478887824),
(117, '1', '2', 'U r extremely dustu', 1478887824),
(118, '2', '1', 'Big boy ', 1478887824),
(119, '2', '1', 'Hekko', 1478887824),
(120, '6', '1', 'hi', 1478887824),
(121, '2', '3', 'What?', 1478887824),
(122, '1', '6', 'ehy', 1478887824),
(123, '2', '1', 'hiii', 1478930810),
(124, '2', '1', 'heyyyyy', 1478931000),
(125, '2', '1', 'heie', 1478931020),
(126, '2', '1', 'hia', 1478932080),
(127, '2', '1', 'helloooooo', 1479010547),
(128, '1', '2', 'Hello ! ssdf', 1479010611),
(129, '2', '1', 'Heieie', 1479010778),
(130, '1', '2', 'rwe', 1479518517);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` set('1','2','3') NOT NULL COMMENT '1 is the follow, 2 is the like, 3 is the comment',
  `fromUser` text NOT NULL,
  `toUser` text NOT NULL,
  `comment_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `time_added` text NOT NULL,
  `date_added` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=201 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `fromUser`, `toUser`, `comment_id`, `post_id`, `time_added`, `date_added`) VALUES
(161, '2', 'ssdf', 'test', 0, 86, '1478887168', '2016/11/11'),
(162, '2', 'test', 'ssdf', 0, 85, '1478887221', '2016/11/11'),
(163, '2', 'ssdf', 'ssdf', 0, 87, '1479004629', '2016/11/12'),
(164, '2', 'test', 'ssdf', 0, 87, '1479004659', '2016/11/12'),
(165, '3', 'ssdf', 'ssdf', 126, 85, '1479516922', '2016/11/18'),
(166, '2', 'ssdf', 'test', 0, 88, '1479518675', '2016/11/18'),
(167, '3', 'ssdf', 'ssdf', 127, 87, '1479596638', '2016/11/19'),
(168, '2', 'ssdf', 'test', 0, 90, '1479609331', '2016/11/19'),
(169, '2', 'test', 'ssdf', 0, 84, '1479609347', '2016/11/19'),
(170, '3', 'ssdf', '', 128, 29, '1479861549', '2016/11/22'),
(171, '3', 'ssdf', '', 129, 29, '1479861556', '2016/11/22'),
(172, '3', 'ssdf', '', 130, 29, '1479861697', '2016/11/22'),
(173, '3', 'ssdf', '', 131, 29, '1479861734', '2016/11/22'),
(174, '3', 'ssdf', '', 132, 29, '1479861755', '2016/11/22'),
(175, '3', 'ssdf', '', 133, 29, '1479861756', '2016/11/22'),
(176, '3', 'ssdf', '', 134, 29, '1479861757', '2016/11/22'),
(177, '3', 'ssdf', '', 135, 29, '1479861813', '2016/11/22'),
(178, '3', 'ssdf', '', 136, 29, '1479861815', '2016/11/22'),
(179, '3', 'ssdf', '', 137, 29, '1479861871', '2016/11/22'),
(180, '3', 'ssdf', '', 138, 29, '1479861874', '2016/11/22'),
(181, '3', 'ssdf', 'ssdf', 139, 84, '1479868755', '2016/11/22'),
(182, '3', 'ssdf', 'ssdf', 140, 84, '1479868936', '2016/11/22'),
(183, '3', 'ssdf', 'ssdf', 141, 84, '1479868936', '2016/11/22'),
(184, '3', 'ssdf', 'ssdf', 142, 84, '1479868938', '2016/11/22'),
(185, '3', 'ssdf', 'ssdf', 143, 84, '1479868939', '2016/11/22'),
(186, '3', 'ssdf', 'ssdf', 144, 84, '1479868940', '2016/11/22'),
(187, '2', 'ssdf', 'ssdf', 0, 84, '1479870005', '2016/11/22'),
(188, '3', 'ssdf', 'ssdf', 145, 84, '1479870359', '2016/11/22'),
(189, '3', 'ssdf', 'ssdf', 146, 84, '1479870589', '2016/11/22'),
(190, '3', 'ssdf', 'ssdf', 147, 96, '1479958131', '2016/11/23'),
(191, '3', 'ssdf', '', 148, 43, '1480397919', '2016/11/28'),
(192, '2', 'ssdf', '', 0, 43, '1480397923', '2016/11/28'),
(193, '3', 'ssdf', '', 149, 43, '1480398087', '2016/11/28'),
(194, '3', 'ssdf', '', 150, 44, '1480398099', '2016/11/28'),
(195, '2', 'ssdf', 'ssdf', 0, 93, '1480398111', '2016/11/28'),
(196, '3', 'ssdf', 'ssdf', 151, 93, '1480398116', '2016/11/28'),
(197, '3', 'ssdf', 'ssdf', 152, 95, '1480398130', '2016/11/28'),
(198, '2', 'ssdf', 'ssdf', 0, 95, '1480398131', '2016/11/28'),
(199, '2', 'ssdf', '', 0, 44, '1480399572', '2016/11/28'),
(200, '3', 'ssdf', '', 153, 44, '1480399585', '2016/11/28');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `photo_link` text NOT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `username`, `photo_link`, `post_id`) VALUES
(2, 'ssdf', 'userdata/pictures/ssdf/newyear.jpg', 15),
(3, 'ssdf', 'userdata/pictures/ssdf/einstein-genius-quote.jpg', 16),
(4, 'ssdf', 'userdata/pictures/ssdf/newyear.jpg', 17),
(5, 'ssdf', 'userdata/pictures/ssdf/WIN_20160404_14_43_19_Pro.jpg', 25),
(6, 'ssdf', 'userdata/pictures/ssdf/WIN_20160211_23_31_24_Pro.jpg', 30),
(7, 'ssdf', 'userdata/pictures/ssdf/WIN_20160404_14_43_19_Pro.jpg', 31),
(8, 'ssdf', 'userdata/pictures/ssdf/WIN_20160129_20_40_22_Pro.jpg', 32),
(9, 'ssdf', 'userdata/pictures/ssdf/WIN_20151227_16_48_44_Pro.jpg', 33),
(10, 'ssdf', 'userdata/pictures/ssdf/WIN_20160124_13_52_58_Pro.jpg', 37),
(11, 'ssdf', 'userdata/pictures/ssdf/WIN_20151230_17_54_33_Pro.jpg', 38),
(12, 'ssdf', 'userdata/pictures/ssdf/1470557361532-1197113215.jpg', 39),
(13, 'ssdf', 'userdata/pictures/ssdf/family.jpg', 41),
(14, 'ssdf', 'userdata/pictures/ssdf/WIN_20151230_17_54_18_Pro.jpg', 42),
(15, 'ssdf', 'userdata/pictures/ssdf/WIN_20151227_16_48_38_Pro.jpg', 43),
(16, 'ssdf', 'userdata/pictures/ssdf/WIN_20160129_20_40_22_Pro.jpg', 44),
(17, 'ssdf', 'userdata/pictures/ssdf/WIN_20151230_17_54_18_Pro.jpg', 45),
(18, 'ssdf', 'userdata/pictures/ssdf/WIN_20151227_16_48_44_Pro.jpg', 46),
(19, 'ssdf', 'userdata/pictures/ssdf/family.jpg', 47),
(20, 'ssdf', 'userdata/pictures/ssdf/family.jpg', 48),
(21, 'Ssdf', 'userdata/pictures/Ssdf/823a486bd803684347de4d5ea9c1c2ed.jpg', 49),
(22, 'test', 'userdata/pictures/test/Jellyfish.jpg', 50),
(23, 'test', 'userdata/pictures/test/Jellyfish.jpg', 51),
(24, 'test', 'userdata/pictures/test/Jellyfish.jpg', 52),
(25, 'test', 'userdata/pictures/test/Jellyfish.jpg', 53),
(26, 'test', 'userdata/pictures/test/Jellyfish.jpg', 54),
(27, 'test', 'userdata/pictures/test/Jellyfish.jpg', 55),
(28, 'test', 'userdata/pictures/test/Jellyfish.jpg', 56),
(29, 'test', 'userdata/pictures/test/Jellyfish.jpg', 57),
(30, 'test', 'userdata/pictures/test/Jellyfish.jpg', 58),
(31, 'test', 'userdata/pictures/test/Jellyfish.jpg', 59),
(32, 'test', 'userdata/pictures/test/Jellyfish.jpg', 60),
(33, 'test', 'userdata/pictures/test/Lighthouse.jpg', 51),
(34, 'test', 'userdata/pictures/test/Lighthouse.jpg', 62),
(35, 'Ssdf', 'userdata/pictures/Ssdf/w_11958646_3YSUMnQo.jpg', 63),
(36, 'test', 'userdata/pictures/test/Penguins.jpg', 64),
(37, 'test', 'userdata/pictures/test/Penguins.jpg', 65),
(38, 'test', 'userdata/pictures/test/Penguins.jpg', 66),
(39, 'test', 'userdata/pictures/test/Penguins.jpg', 67),
(40, 'vik', 'userdata/pictures/vik/380-full-of-color-.gif', 68),
(41, 'test', 'userdata/pictures/test/dace2.PNG', 80),
(42, 'ssdf', 'userdata/pictures/ssdf/einstein-genius-quote.jpg', 85),
(43, 'ssdf', 'userdata/pictures/ssdf/einstein-genius-quote.jpg', 92),
(44, 'ssdf', 'userdata/pictures/ssdf/einstein-genius-quote.jpg', 93);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `body` text NOT NULL,
  `date_added` text NOT NULL,
  `time_added` text NOT NULL,
  `added_by` text NOT NULL,
  `posted_to` enum('0','1') NOT NULL COMMENT '0 is the timeline 1 is any profile',
  `tags` text NOT NULL,
  `user_posted_to` text NOT NULL,
  `commentsid` text NOT NULL,
  `picture` text NOT NULL,
  `video` text NOT NULL,
  `youtubevideo` text NOT NULL,
  `hidden` enum('0','1') NOT NULL,
  `hidden_by` text NOT NULL,
  `liked_by` text NOT NULL,
  `post_group` int(11) NOT NULL COMMENT 'if zero, no group',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=98 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `body`, `date_added`, `time_added`, `added_by`, `posted_to`, `tags`, `user_posted_to`, `commentsid`, `picture`, `video`, `youtubevideo`, `hidden`, `hidden_by`, `liked_by`, `post_group`) VALUES
(82, 'Hi', '', '1478585736', 'ssdf', '0', '', '', '', '', '', '', '0', '', 'ssdf', 0),
(83, 'hi', '', '1478585743', 'ssdf', '0', '', '', '', '', '', '', '0', '', '', 0),
(84, 'hey\r\n', '', '1478585752', 'ssdf', '0', '', '', '139,140,141,142,143,144,145,146', '', '', '', '0', '', 'ssdf,test,ssdf,test,ssdf,test,ssdf,test,ssdf,test', 0),
(85, 'Einstein!!', '', '1478585752', 'ssdf', '0', '', '', '122,123,124,125,126', 'userdata/pictures/ssdf/einstein-genius-quote.jpg', '', '', '0', 'ssdf', 'ssdf,test', 0),
(86, 'hi', '', '1478840421', 'test', '0', '', '', '120,121', '', '', '', '1', 'ssdf', 'test,ssdf', 0),
(87, '#hello', '', '1478940284', 'ssdf', '0', '', '', '127', '', '', '', '1', 'ssdf', 'ssdf,test', 0),
(88, 'Hello ', '', '1479009459', 'test', '0', '', '', '', '', '', '', '1', 'Ssdf', 'ssdf', 1),
(89, 'heyyyyy', '', '1479609205', 'test', '0', '', '', '', '', '', '', '1', 'ssdf', '', 0),
(90, 'hihihi', '', '1479609282', 'test', '0', '', '', '', '', '', '', '1', 'ssdf', 'ssdf', 0),
(91, 'Hey', '', '1479609282', 'ssdf', '1', '', 'ssdf', '', '', '', '', '0', '', '', 0),
(92, 'Heyyyyy', '2016/11/23', '1479609282', 'ssdf', '1', '', 'ssdf', '', 'userdata/pictures/ssdf/einstein-genius-quote.jpg', '', '', '0', '', '', 0),
(93, 'Hey sadfj dskfj l lksdsjdf  sdlkdfj sdjflsd f kldjf  lsdkjfflsdd flddj ljf sdlfjds ffk dlkdj flks dflksd jfl ksddjf  lsdkdjflsk flskf lskd f lksdflsk dlsk dfflks ddlf slk flskd flskd f lskdf sldflsd  lk dflksjd flkds flkjsd flks dflk sdlfk dslf  lsdkf j lsk d flsk flksdjf lksdf lkdf lflkasjdf lasdkjflk f lasdjf lkasjdf lskdj flsd fls dfl sdfflksdfj sdflksaldf lsakd flks dflkas dlffklskdflksadf jlk dfls dfls dflka dflkasdlfk asdlfa ldkfj alsdkfalkdf lakds flkasdjf laksdjf lkasjdf lkasdf jalksdjfalksf alskdfjaslkdf laksdjfka sdflkajsdflkasjdfl kasd flaskjdf laksdj flkasjdf lka sjsad flsjdf skdjf sdkjdf lksjddf lksdjd flksdd l dj flsdj flsd  flsd d flsd flsd flskddj  flks  dflksd flsdkd  flsdkj f ls  dflksjdf ls dfld flsdkdf lsddkf  jjsldf lsdf dkj kdfj kdls', '2016/11/23', '1479956241', 'ssdf', '1', '', 'ssdf', '151', 'userdata/pictures/ssdf/einstein-genius-quote.jpg', '', '', '0', '', 'ssdf', 0),
(94, '#hi', '', '1479957018', 'ssdf', '0', '', '', '', '', '', '', '0', '', '', 0),
(95, '#hi', '', '1479957062', 'ssdf', '0', '', '', '152', '', '', '', '0', '', 'ssdf', 0),
(96, '@ssdf\r\n', '', '1479957172', 'ssdf', '0', '', '', '147', '', '', '', '1', 'Ssdf', '', 0),
(97, 'Hi', '2016/11/23', '1479960880', 'Ssdf', '1', '', 'ssdf', '', '', '', '', '1', 'ssdf', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE IF NOT EXISTS `report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `flagger` text NOT NULL,
  `about` set('1','2','3','4','5','6','7','8','9','10') NOT NULL COMMENT '1 = sexual, 2 = drugs, 3 = inappropriate, 4 = harrasment, 5 = threatning, 6 = rude, 7 = bully,  8 = not interesting, 9 = embarrassing, 10 = id like',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `post_id`, `flagger`, `about`) VALUES
(1, 38, 'ssdf', '10'),
(2, 38, 'ssdf', ''),
(3, 26, 'ssdf', ''),
(4, 26, 'ssdf', ''),
(5, 26, 'ssdf', ''),
(6, 25, 'ssdf', ''),
(7, 26, 'ssdf', ''),
(8, 25, 'ssdf', ''),
(9, 38, 'ssdf', ''),
(10, 38, 'ssdf', ''),
(11, 38, 'Ssdf', ''),
(12, 26, 'ssdf', ''),
(13, 26, 'ssdf', ''),
(14, 38, 'ssdf', ''),
(15, 38, 'ssdf', ''),
(16, 39, 'Ssdf', ''),
(17, 39, 'Ssdf', ''),
(18, 39, 'Ssdf', ''),
(19, 39, 'Ssdf', ''),
(20, 39, 'Ssdf', ''),
(21, 39, 'ssdf', ''),
(22, 39, 'ssdf', ''),
(23, 25, 'ssdf', ''),
(24, 25, 'ssdf', ''),
(25, 25, 'ssdf', ''),
(26, 38, 'Ssdf', ''),
(27, 49, 'ssdf', ''),
(28, 49, 'ssdf', ''),
(29, 67, 'Ssdf', ''),
(30, 67, 'ssdf', ''),
(31, 65, 'Test', ''),
(32, 76, 'test', ''),
(33, 76, 'test', ''),
(34, 76, 'test', ''),
(35, 76, 'test', ''),
(36, 76, 'test', ''),
(37, 76, 'test', ''),
(38, 77, 'test', ''),
(39, 80, 'test', ''),
(40, 82, 'ssdf', ''),
(41, 82, 'ssdf', ''),
(42, 88, 'ssdf', ''),
(43, 88, 'ssdf', ''),
(44, 85, 'ssdf', ''),
(45, 85, 'ssdf', ''),
(46, 84, 'ssdf', ''),
(47, 84, 'ssdf', '2'),
(48, 84, 'Ssdf', '8'),
(49, 84, 'ssdf', '1'),
(50, 97, 'ssdf', '5');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `student_id` int(11) NOT NULL,
  `password` text NOT NULL,
  `sign_up_date` text NOT NULL,
  `bio` text,
  `profile_pic` text NOT NULL,
  `bannerimg` text NOT NULL,
  `following` text NOT NULL,
  `followers` text NOT NULL,
  `sex` set('0','1','2') NOT NULL,
  `dob` text COMMENT 'date of birth',
  `interests` text,
  `dmfriends` text NOT NULL,
  `es` text,
  `ms` text,
  `grade` text,
  `home_ip` text NOT NULL COMMENT 'ip used for sign up.',
  `last_ip` text NOT NULL COMMENT 'last login ip',
  `ips_array` text NOT NULL COMMENT 'list of ips used to login; ',
  `online` enum('0','1') NOT NULL,
  `last_online_date` text NOT NULL,
  `last_online_time` text NOT NULL,
  `admin` enum('0','1') NOT NULL,
  `activated` enum('0','1') NOT NULL,
  `account_closer` text NOT NULL,
  `groups` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `student_id`, `password`, `sign_up_date`, `bio`, `profile_pic`, `bannerimg`, `following`, `followers`, `sex`, `dob`, `interests`, `dmfriends`, `es`, `ms`, `grade`, `home_ip`, `last_ip`, `ips_array`, `online`, `last_online_date`, `last_online_time`, `admin`, `activated`, `account_closer`, `groups`) VALUES
(1, 'ssdf', 'Vikrant', 'Bandyopadhyay', 538881, '5d41402abc4b2a76b9719d911017c592', '6/8/2016', 'Hello, I am the president of the site please dm me if you need any help.\n', 'userdata/pictures/Ssdf/IMG_20161127_151641.jpg', 'userdata/pictures/Ssdf/14802893913501265276773.jpg', 'test123,thissdf,test', 'test,ssdf,vik', '0', '2/5/2002', 'coding,', 'thissdf,test123,test,Vik', 'Hariyana', 'Dartmouth', '9', '67.188.81.253', '67.188.81.253', '67.188.81.253', '0', '6/8/2016', '1480398133', '1', '1', '', ''),
(2, 'test', 'Taste', 'Tasty', 394584, '5d41402abc4b2a76b9719d911017c592', '6/27/2016', 'This is a test account to test the functionality of the website pls dont mind me\r\n', 'https://pbs.twimg.com/profile_images/577783755605028864/IIojQn3V.jpeg', 'http://www.theresiliencyinstitute.net/wp-content/uploads/2013/09/TRI-Banner-background.jpg', 'ssdf', 'Ssdf', '0', '2/5/2002', '', 'ssdf,thissdf,test123', 'Something', 'Dartmouth', '9', '71.202.74.188', '71.202.74.188', '71.202.74.188', '0', '6/27/2016', '1479609282', '0', '1', '', '1,2'),
(3, 'test123', 'test123', 'testpart', 2342931, '5d41402abc4b2a76b9719d911017c592', '7/20/2016', 'this is another test account to understand whats going on in the site.\r\n', 'https://expertbeacon.com/sites/default/files/advice_for_men_on_selecting_your_online_dating_profile_photo.jpg', '', '', 'ssdf', '1', '2/5/2002', NULL, 'Ssdf,vik,test', 'This', 'Dartmouth', '12', '71.202.74.188', '71.202.74.188', '71.202.74.188', '0', '7/20/2016', '7:45pm', '0', '1', '', ''),
(4, 'thissdf', 'dfjs', 'sdkf', 20498203, 'd41d8cd98f00b204e9800998ecf8427e', '07/28/16', '', '', '', '', 'ssdf', '', '2016-07-14', '', 'Ssdf,vik,Test', 'sdkjfs', 'sdfsdf', '9', '::1', '::1', '::1', '1', '07/28/16', '1469678763', '0', '1', '', ''),
(5, 'saikat', 'Saikat', 'Bandyopadhyay', 898423, '5d41402abc4b2a76b9719d911017c592', '09/02/16', '', '', '', '', 'Ssdf', '', '2015-06-12', '', '', 'KVI', 'KVI', '9', '::1', '::1', '::1', '1', '09/02/16', '1472789724', '0', '1', '', ''),
(6, 'Vik', 'Vikrant', 'Banerjee', 65356, '5d41402abc4b2a76b9719d911017c592', '09/29/16', '', '', '', 'ssdf', '', '1', '2016-09-15', '', 'ssdf,thissdf,test123', 'Jxh', 'Hch', '9', '192.168.0.104', '192.168.0.104', '192.168.0.104', '1', '09/29/16', '1475117084', '0', '1', '', ''),
(7, 'asdf', 'asdf', 'asdf', 1234, '5d41402abc4b2a76b9719d911017c592', '11/16/16', '', '', '', '', '', '', '2016-11-17', '', '', '', '', '9', '', '', '', '1', '11/16/16', '1479281963', '0', '1', '', ''),
(8, 'asdfg', 'asdf', 'asdf', 1234, '5d41402abc4b2a76b9719d911017c592', '11/16/16', '', '', '', '', '', '', '2016-11-17', '', '', '', '', '9', '::1', '::1', '::1', '1', '11/16/16', '1479282106', '0', '1', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
