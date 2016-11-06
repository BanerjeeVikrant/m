-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 06, 2016 at 06:02 PM
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
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `from` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=120 ;

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
(119, '&lt;h1&gt;hi&lt;/h1&gt;', 'test');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `crush`
--

INSERT INTO `crush` (`id`, `body`, `by`, `picture`, `time_added`, `date_added`) VALUES
(1, 'i am a really bad boy', 'ssdf', 'https://s-media-cache-ak0.pinimg.com/736x/d2/6c/51/d26c511a38b62ec9a2faf464b798e755.jpg', '6:24pm', '7/11/2016'),
(2, 'I am having a bad day...', 'ssdf', '', '10:38:24pm', '2016/07/30'),
(3, 'This is my life', 'ssdf', '', '07:01:35pm', '2016/08/09'),
(4, 'I love to code trust me\r\n', 'ssdf', '', '07:02:06pm', '2016/08/09'),
(5, 'Posting post to full the page ', 'ssdf', '', '07:02:35pm', '2016/08/09'),
(6, 'Xnjdbxj.  Dkenjx djdb djdns djdb djdjejjd djdjjs djdjjd', 'ssdf', '', '07:06:19pm', '2016/08/09'),
(7, 'So text works\r\n', 'ssdf', '', '09:45:04pm', '2016/08/22'),
(8, 'feeling happy', 'test', '', '07:24:29pm', '2016/10/01'),
(9, 'hola como estas que tal?', 'vik', '', '08:23:26pm', '2016/10/15'),
(10, 'hi', 'test', '', '10:23:10pm', '2016/11/05'),
(11, 'hi', 'test', '', '10:24:50pm', '2016/11/05'),
(12, 'tyessdfdsd', 'test', '', '10:26:07pm', '2016/11/05'),
(13, 'hi', 'test', '', '10:26:40pm', '2016/11/05'),
(14, 'dsadasdas', 'test', '', '10:26:58pm', '2016/11/05'),
(15, 'post id: 56473\r\n\r\nHello!', 'test', '', '10:29:24pm', '2016/11/05'),
(16, '@56473 hi!', 'test', '', '10:29:33pm', '2016/11/05'),
(17, '&lt;h1&gt;hi&lt;/h1&gt;', 'test', '', '11:15:20pm', '2016/11/05');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=122 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `fromUser`, `toUser`, `message`) VALUES
(1, '1', '2', 'This is for testing'),
(2, '2', '1', 'This is for stesting'),
(3, '2', '1', 'This is for third testing'),
(4, '1', '2', 'this is test to put in database'),
(5, '1', '2', 'hey'),
(6, '1', '2', 'Genius'),
(7, '2', '1', 'ok'),
(8, '1', '2', 'ok so it is working'),
(9, '1', '2', 'vikrant is lame'),
(10, '1', '2', 'y u annoyng?'),
(11, '1', '2', 'this was funny'),
(12, '1', '2', 'ok done!'),
(13, '1', '2', 'now lets see'),
(14, '1', '2', 'new'),
(15, '1', '2', 'hi'),
(16, '1', '2', 'right'),
(17, '1', '2', 'Helli'),
(18, '1', '2', 'Hi'),
(19, '1', '2', 'alright'),
(20, '1', '2', 'hi'),
(21, '1', '1', 'Hello!'),
(22, '2', '1', 'Hi'),
(23, '1', '2', 'But oh no'),
(24, '2', '1', 'Why'),
(25, '1', '2', 'Yolo'),
(26, '1', '2', 'U = lame'),
(27, '2', '1', 'OK'),
(28, '1', '2', 'U agree'),
(29, '2', '1', 'Ok'),
(30, '1', '2', 'Hi'),
(31, '1', '2', 'Hey'),
(32, '1', '3', 'Heyyy'),
(33, '1', '2', 'Hi'),
(34, '2', '1', 'Hry'),
(35, '2', '1', 'Hi'),
(36, '2', '1', 'Hey'),
(37, '2', '1', 'Fjfn'),
(38, '2', '1', 'Fjnfj'),
(39, '2', '1', 'Hi'),
(40, '2', '1', 'Ji'),
(41, '2', '1', 'Hc'),
(42, '2', '1', 'Bnn'),
(43, '2', '1', 'Hi'),
(44, '2', '1', 'Hv'),
(45, '1', '2', 'hi'),
(46, '1', '2', 'hello'),
(47, '1', '3', 'hi'),
(48, '1', '2', 'Hey'),
(49, '1', '2', 'Dude whats up?'),
(50, '1', '2', 'Hey'),
(51, '1', '2', 'hi'),
(52, '5', '1', 'hi'),
(53, '1', '5', 'hi'),
(54, '1', '2', 'hi'),
(55, '1', '1', 'Hi'),
(56, '1', '2', 'Hi'),
(57, '2', '1', 'try'),
(58, '1', '2', 'Hola como estas'),
(59, '2', '1', 'i am fine'),
(60, '1', '1', 'Hi'),
(61, '2', '1', 'Holla'),
(62, '1', '2', 'Hi'),
(63, '2', '1', 'Hola'),
(64, '1', '2', 'What'),
(65, '2', '1', 'What is this'),
(66, '1', '2', 'What do you want'),
(67, '2', '1', 'Hola is actually Ola'),
(68, '1', '2', 'Do what'),
(69, '2', '1', 'I can see everthing fine, so far.'),
(70, '1', '2', 'Ok'),
(71, '2', '1', 'What about you ?'),
(72, '1', '2', 'Ok'),
(73, '2', '1', 'Do you see any problem ?'),
(74, '1', '2', 'Not right'),
(75, '1', '2', 'Now'),
(76, '2', '1', 'No I am exausted..'),
(77, '1', '2', 'Keep on doing'),
(78, '2', '1', '5 times'),
(79, '2', '1', '4 more times'),
(80, '1', '2', 'Checking for double input'),
(81, '2', '1', '3 more times'),
(82, '1', '2', ''),
(83, '2', '1', '2 times'),
(84, '1', '2', ''),
(85, '1', '2', ''),
(86, '1', '2', ''),
(87, '2', '1', '1 time'),
(88, '2', '1', 'time up'),
(89, '1', '2', 'ðŸ˜­'),
(90, '1', '2', 'H'),
(91, '2', '1', 'h'),
(92, '2', '1', 'h'),
(93, '2', '1', 'h'),
(94, '1', '2', 'h'),
(95, '1', '2', 'h'),
(96, '1', '3', 'hi'),
(97, '2', '1', 'What?'),
(98, '1', '2', 'hi'),
(99, '2', '1', 'Ok bro'),
(100, '1', '2', 'hey'),
(101, '1', '3', 'ok'),
(102, '1', '3', 'hi'),
(103, '1', '2', 'test'),
(104, '1', '3', 'hi'),
(105, '1', '3', 'hi'),
(106, '1', '3', 'hi'),
(107, '1', '3', 'hey'),
(108, '1', '2', 'ok'),
(109, '2', '1', 'That s it'),
(110, '2', '3', 'Hi'),
(111, '1', '2', 'Ok bro'),
(112, '1', '2', 'Bro whats up'),
(113, '2', '1', 'Dustu'),
(114, '1', '2', 'U dustu'),
(115, '2', '1', 'U very dustu'),
(116, '1', '2', 'Ni i am good.'),
(117, '1', '2', 'U r extremely dustu'),
(118, '2', '1', 'Big boy '),
(119, '2', '1', 'Hekko'),
(120, '6', '1', 'hi'),
(121, '2', '3', 'What?');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=150 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `fromUser`, `toUser`, `comment_id`, `post_id`, `time_added`, `date_added`) VALUES
(13, '1', 'ssdf', 'test', 0, 0, '03:24:44pm', '2016/07/13'),
(14, '2', 'ssdf', 'test', 0, 18, '03:24:49pm', '2016/07/13'),
(15, '3', 'ssdf', 'test', 27, 18, '03:25:04pm', '2016/07/13'),
(16, '3', 'ssdf', 'test', 28, 25, '08:11:35pm', '2016/07/13'),
(17, '3', 'ssdf', 'test', 29, 25, '08:12:43pm', '2016/07/13'),
(18, '3', 'ssdf', 'test', 30, 25, '08:14:51pm', '2016/07/13'),
(19, '3', 'ssdf', 'test', 31, 25, '08:19:13pm', '2016/07/13'),
(20, '3', 'ssdf', 'test', 32, 25, '08:26:50pm', '2016/07/13'),
(21, '3', 'ssdf', 'test', 33, 25, '08:32:28pm', '2016/07/13'),
(22, '3', 'ssdf', 'test', 34, 25, '08:33:53pm', '2016/07/13'),
(23, '3', 'ssdf', 'test', 35, 18, '08:38:37pm', '2016/07/13'),
(24, '3', 'ssdf', 'test', 36, 25, '08:42:36pm', '2016/07/13'),
(25, '3', 'ssdf', 'test', 37, 25, '08:42:39pm', '2016/07/13'),
(26, '3', 'ssdf', 'test', 38, 18, '08:42:48pm', '2016/07/13'),
(27, '3', 'ssdf', 'test', 39, 25, '08:44:15pm', '2016/07/13'),
(28, '3', 'ssdf', 'test', 40, 25, '08:47:53pm', '2016/07/13'),
(29, '3', 'ssdf', 'test', 41, 18, '08:48:12pm', '2016/07/13'),
(30, '3', 'ssdf', 'test', 42, 14, '08:53:09pm', '2016/07/13'),
(31, '3', 'ssdf', 'test', 43, 25, '08:56:01pm', '2016/07/13'),
(32, '3', 'ssdf', 'test', 44, 25, '08:58:44pm', '2016/07/13'),
(33, '3', 'ssdf', 'test', 45, 25, '09:01:53pm', '2016/07/13'),
(34, '3', 'ssdf', 'test', 46, 25, '09:04:27pm', '2016/07/13'),
(35, '3', 'ssdf', 'test', 47, 25, '09:05:43pm', '2016/07/13'),
(36, '3', 'ssdf', 'test', 48, 25, '09:10:23pm', '2016/07/13'),
(37, '3', 'ssdf', 'test', 49, 25, '09:13:47pm', '2016/07/13'),
(38, '3', 'ssdf', 'test', 50, 25, '09:14:41pm', '2016/07/13'),
(39, '3', 'ssdf', 'test', 51, 25, '09:15:35pm', '2016/07/13'),
(40, '3', 'ssdf', 'test', 52, 25, '09:17:12pm', '2016/07/13'),
(41, '3', 'ssdf', 'test', 53, 25, '09:18:42pm', '2016/07/13'),
(42, '3', 'ssdf', 'test', 54, 25, '09:19:29pm', '2016/07/13'),
(43, '3', 'ssdf', 'test', 55, 25, '09:20:23pm', '2016/07/13'),
(44, '3', 'ssdf', 'test', 56, 18, '09:21:26pm', '2016/07/13'),
(45, '3', 'ssdf', 'test', 57, 18, '09:22:14pm', '2016/07/13'),
(46, '3', 'ssdf', 'test', 58, 25, '09:31:49pm', '2016/07/13'),
(47, '3', 'ssdf', 'test', 59, 25, '09:32:19pm', '2016/07/13'),
(48, '3', 'ssdf', 'test', 60, 18, '09:32:55pm', '2016/07/13'),
(49, '3', 'ssdf', 'test', 61, 25, '09:35:32pm', '2016/07/13'),
(50, '3', 'ssdf', 'test', 62, 25, '09:50:48pm', '2016/07/13'),
(51, '3', 'ssdf', 'test', 63, 18, '09:50:56pm', '2016/07/13'),
(52, '3', 'ssdf', 'test', 64, 25, '09:54:07pm', '2016/07/13'),
(53, '2', 'ssdf', 'test', 0, 14, '09:59:36pm', '2016/07/13'),
(54, '2', 'ssdf', 'test', 0, 25, '04:25:19pm', '2016/07/15'),
(55, '3', 'ssdf', 'ssdf', 65, 27, '09:37:15pm', '2016/07/22'),
(56, '2', 'ssdf', 'ssdf', 0, 27, '09:37:21pm', '2016/07/22'),
(57, '2', 'ssdf', 'ssdf', 0, 38, '04:21:45pm', '2016/07/25'),
(58, '3', 'ssdf', 'ssdf', 66, 32, '05:55:36pm', '2016/07/25'),
(59, '2', 'ssdf', 'ssdf', 0, 37, '09:45:14pm', '2016/07/25'),
(60, '3', 'ssdf', 'ssdf', 67, 36, '04:46:19pm', '2016/08/01'),
(61, '3', 'ssdf', 'ssdf', 68, 36, '04:46:40pm', '2016/08/01'),
(62, '3', 'ssdf', 'ssdf', 69, 36, '04:47:06pm', '2016/08/01'),
(63, '3', 'ssdf', 'ssdf', 70, 36, '04:47:07pm', '2016/08/01'),
(64, '3', 'ssdf', 'ssdf', 71, 36, '06:03:37pm', '2016/08/01'),
(65, '3', 'ssdf', 'ssdf', 72, 38, '06:06:34pm', '2016/08/01'),
(66, '3', 'ssdf', 'ssdf', 73, 38, '06:06:41pm', '2016/08/01'),
(67, '3', 'ssdf', 'ssdf', 74, 38, '06:10:27pm', '2016/08/01'),
(68, '3', 'ssdf', 'ssdf', 75, 38, '06:10:31pm', '2016/08/01'),
(69, '3', 'ssdf', 'ssdf', 76, 38, '06:10:32pm', '2016/08/01'),
(70, '3', 'ssdf', 'ssdf', 77, 38, '06:10:33pm', '2016/08/01'),
(71, '3', 'ssdf', 'ssdf', 78, 38, '06:10:34pm', '2016/08/01'),
(72, '3', 'ssdf', 'ssdf', 79, 38, '06:11:16pm', '2016/08/01'),
(73, '2', 'ssdf', 'ssdf', 0, 33, '06:12:06pm', '2016/08/01'),
(74, '2', 'ssdf', 'ssdf', 0, 24, '06:15:30pm', '2016/08/01'),
(75, '2', 'ssdf', 'ssdf', 0, 23, '06:15:42pm', '2016/08/01'),
(76, '3', 'ssdf', 'ssdf', 80, 26, '06:19:20pm', '2016/08/01'),
(77, '3', 'ssdf', 'ssdf', 81, 38, '09:18:18pm', '2016/08/02'),
(78, '3', 'ssdf', 'ssdf', 82, 38, '09:23:58pm', '2016/08/02'),
(79, '3', 'ssdf', 'ssdf', 83, 38, '09:24:46pm', '2016/08/02'),
(80, '3', 'ssdf', 'ssdf', 84, 38, '09:26:14pm', '2016/08/02'),
(81, '3', 'ssdf', 'ssdf', 85, 38, '09:33:02pm', '2016/08/02'),
(82, '3', 'ssdf', 'ssdf', 86, 38, '09:34:45pm', '2016/08/02'),
(83, '3', 'ssdf', 'ssdf', 87, 38, '09:35:59pm', '2016/08/02'),
(84, '3', 'ssdf', 'ssdf', 88, 38, '09:36:39pm', '2016/08/02'),
(85, '3', 'ssdf', 'ssdf', 89, 38, '09:36:42pm', '2016/08/02'),
(86, '3', 'ssdf', '', 90, 11, '06:47:04pm', '2016/08/03'),
(87, '3', 'ssdf', 'ssdf', 91, 26, '06:51:09pm', '2016/08/03'),
(88, '2', 'ssdf', 'ssdf', 0, 36, '06:57:36pm', '2016/08/03'),
(89, '3', 'ssdf', 'ssdf', 92, 7, '11:22:13pm', '2016/08/03'),
(90, '2', 'ssdf', '', 0, 11, '10:10:37pm', '2016/08/04'),
(91, '2', 'ssdf', 'ssdf', 0, 28, '12:00:58am', '2016/08/07'),
(92, '2', 'ssdf', 'ssdf', 0, 13, '12:01:12am', '2016/08/07'),
(93, '2', 'ssdf', 'ssdf', 0, 29, '12:01:17am', '2016/08/07'),
(94, '3', 'ssdf', 'ssdf', 93, 22, '12:04:40am', '2016/08/07'),
(95, '3', 'ssdf', 'ssdf', 94, 22, '12:04:40am', '2016/08/07'),
(96, '2', 'ssdf', 'ssdf', 0, 35, '12:06:55am', '2016/08/07'),
(97, '3', 'ssdf', 'ssdf', 95, 37, '10:45:34am', '2016/08/09'),
(98, '3', 'ssdf', 'ssdf', 96, 12, '07:12:19pm', '2016/08/09'),
(99, '2', 'ssdf', 'ssdf', 0, 12, '07:12:35pm', '2016/08/09'),
(100, '2', 'ssdf', 'ssdf', 0, 26, '07:12:55pm', '2016/08/09'),
(101, '2', 'ssdf', 'ssdf', 0, 39, '07:13:23pm', '2016/08/09'),
(102, '1', 'ssdf', 'test123', 0, 0, '06:54:02pm', '2016/08/10'),
(103, '1', 'ssdf', 'thissdf', 0, 0, '06:54:33pm', '2016/08/10'),
(104, '2', 'Ssdf', 'ssdf', 0, 31, '02:12:28pm', '2016/08/11'),
(105, '3', 'Ssdf', 'ssdf', 97, 35, '02:12:50pm', '2016/08/11'),
(106, '3', 'ssdf', 'ssdf', 98, 39, '08:07:06pm', '2016/08/14'),
(107, '3', 'test', 'ssdf', 99, 39, '08:08:49pm', '2016/08/14'),
(108, '2', 'ssdf', 'ssdf', 0, 4, '08:23:24pm', '2016/08/24'),
(109, '3', 'ssdf', 'test', 100, 25, '09:25:18pm', '2016/08/24'),
(110, '3', 'ssdf', 'ssdf', 101, 4, '06:56:56pm', '2016/09/10'),
(111, '1', 'Ssdf', 'saikat', 0, 0, '04:14:58pm', '2016/09/17'),
(112, '2', 'Ssdf', 'ssdf', 0, 46, '09:50:25pm', '2016/09/29'),
(113, '2', 'Ssdf', 'Ssdf', 0, 49, '09:50:52pm', '2016/09/29'),
(114, '2', 'Ssdf', 'test', 0, 50, '06:34:28pm', '2016/10/01'),
(115, '3', 'Ssdf', 'test', 102, 50, '06:37:20pm', '2016/10/01'),
(116, '3', 'test', 'test', 103, 50, '06:38:22pm', '2016/10/01'),
(117, '2', 'Ssdf', 'test', 0, 53, '06:40:49pm', '2016/10/01'),
(118, '2', 'ssdf', 'test', 0, 55, '06:42:54pm', '2016/10/01'),
(119, '2', 'test', 'ssdf', 0, 47, '06:44:55pm', '2016/10/01'),
(120, '2', 'ssdf', 'test', 0, 57, '06:51:13pm', '2016/10/01'),
(121, '2', 'ssdf', 'test', 0, 58, '06:53:47pm', '2016/10/01'),
(122, '2', 'Test', 'test', 0, 67, '11:33:42am', '2016/10/02'),
(123, '3', 'Test', 'ssdf', 104, 47, '11:34:36am', '2016/10/02'),
(124, '3', 'Test', 'ssdf', 105, 36, '12:05:08pm', '2016/10/02'),
(125, '3', 'ssdf', 'test', 106, 50, '09:47:49pm', '2016/10/04'),
(126, '1', 'vik', 'ssdf', 0, 0, '09:16:58pm', '2016/10/05'),
(127, '2', 'Test', 'test', 0, 64, '08:58:36pm', '2016/10/12'),
(128, '2', 'vik', 'vik', 0, 68, '08:24:20pm', '2016/10/15'),
(129, '3', 'test', 'test', 107, 67, '08:59:42pm', '2016/11/05'),
(130, '2', 'test', 'test', 0, 70, '09:00:14pm', '2016/11/05'),
(131, '3', 'test', 'test', 108, 72, '09:08:43pm', '2016/11/05'),
(132, '3', 'test', 'test', 109, 72, '09:08:44pm', '2016/11/05'),
(133, '3', 'test', 'test', 110, 72, '09:08:44pm', '2016/11/05'),
(134, '3', 'test', 'test', 111, 72, '09:08:45pm', '2016/11/05'),
(135, '3', 'test', 'test', 112, 72, '09:08:45pm', '2016/11/05'),
(136, '3', 'test', 'test', 113, 72, '09:08:45pm', '2016/11/05'),
(137, '3', 'test', 'test', 114, 72, '09:08:46pm', '2016/11/05'),
(138, '3', 'test', 'test', 115, 72, '09:08:46pm', '2016/11/05'),
(139, '3', 'test', 'test', 116, 72, '09:08:46pm', '2016/11/05'),
(140, '3', 'test', 'test', 117, 72, '09:08:47pm', '2016/11/05'),
(141, '2', 'test', 'test', 0, 75, '09:24:12pm', '2016/11/05'),
(142, '2', 'test', 'test', 0, 74, '09:30:29pm', '2016/11/05'),
(143, '2', 'ssdf', 'test', 0, 75, '09:33:25pm', '2016/11/05'),
(144, '3', 'test', 'test', 118, 75, '09:35:22pm', '2016/11/05'),
(145, '2', 'test', 'test', 0, 80, '10:30:25pm', '2016/11/05'),
(146, '2', 'test', 'test', 0, 79, '10:34:44pm', '2016/11/05'),
(147, '2', 'test', 'test', 0, 78, '10:34:52pm', '2016/11/05'),
(148, '2', 'test', 'test', 0, 77, '10:34:54pm', '2016/11/05'),
(149, '3', 'test', 'test', 119, 81, '11:14:10pm', '2016/11/05');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

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
(41, 'test', 'userdata/pictures/test/dace2.PNG', 80);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=82 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `body`, `date_added`, `time_added`, `added_by`, `posted_to`, `tags`, `user_posted_to`, `commentsid`, `picture`, `video`, `youtubevideo`, `hidden`, `hidden_by`, `liked_by`, `post_group`) VALUES
(1, 'This is how the world is today', '6/13/2016', '9:41pm', 'ssdf', '1', '', 'ssdf', '', 'http://c.tadst.com/gfx/750w/doomsday-rule.jpg?1', '', '', '0', '', '', 0),
(2, 'This is how the world is today', '6/13/2016', '9:41pm', 'ssdf', '0', '', 'ssdf', '', 'https://upload.wikimedia.org/wikipedia/commons/2/2a/Keyboard-anykey.jpg', '', '', '0', '', '', 0),
(3, 'This is how the world is today', '6/13/2016', '9:41pm', 'ssdf', '1', '', 'ssdf', '14,20', '', '', 'https://www.youtube.com/embed/3PoMeL1mCak', '0', '', '', 0),
(4, 'Whats up bros?', '2016/06/16', '09:52:04pm', 'ssdf', '1', '', 'ssdf', '101', '', '', '', '0', '', '', 0),
(5, 'Just checking!', '2016/06/16', '09:53:06pm', 'ssdf', '1', '', 'ssdf', '', '', '', '', '0', '', '', 0),
(6, 'hi', '2016/06/16', '11:32:09pm', 'ssdf', '1', '', 'ssdf', '', '/bkd/userdata/pictures/ssdf/bearpic.png', '', '', '0', '', '', 0),
(7, 'listen to einstein!', '2016/06/16', '11:38:09pm', 'ssdf', '1', '', 'ssdf', '92', '/bkd/userdata/pictures/ssdf/einstein-genius-quote.jpg', '', '', '0', '', '', 0),
(8, 'its not new year ... ', '2016/06/16', '11:40:55pm', 'ssdf', '1', '', 'ssdf', '', '/bkd/userdata/pictures/ssdf/newyear.jpg', '', '', '0', '', '', 0),
(9, '', '2016/06/16', '11:44:04pm', 'ssdf', '1', '', 'ssdf', '', '/bkd/userdata/pictures/ssdf/einstein-genius-quote.jpg', '', '', '0', '', '', 0),
(12, 'hi', '2016/06/17', '12:58:41pm', 'ssdf', '1', '', 'ssdf', '96', '', '/bkd/userdata/videos/ssdf/WIN_20160215_18_56_21_Pro.mp4', '', '0', '', 'ssdf,ssdf,ssdf,ssdf,ssdf', 0),
(13, 'hi', '2016/06/17', '06:57:04pm', 'ssdf', '0', '', 'ssdf', '', '', '/bkd/userdata/videos/ssdf/hello video.mp4', '', '0', '', 'ssdf,ssdf', 0),
(14, 'ok', '2016/06/18', '04:04:46pm', 'test', '0', '', 'ssdf', '42', '/bkd/userdata/pictures/ssdf/einstein-genius-quote.jpg', '', '', '0', '', 'ssdf', 0),
(15, 'sdfd', '2016/06/18', '04:06:46pm', 'ssdf', '0', '', 'ssdf', '8,9', '/bkd/userdata/pictures/ssdf/newyear.jpg', '', '', '0', '', '', 0),
(16, 'sdf', '2016/06/25', '04:00:52pm', 'ssdf', '1', '', 'ssdf', '7,10,18,21,23', '/bkd/userdata/pictures/ssdf/einstein-genius-quote.jpg', '', '', '0', '', '', 1),
(17, 'hello ', '2016/06/25', '04:29:58pm', 'ssdf', '1', '', 'ssdf', '', '/bkd/userdata/pictures/ssdf/newyear.jpg', '', '', '0', '', '', 0),
(18, 'Test welcome to the site!', '2016/06/27', '08:45:54pm', 'test', '0', '', 'test', '22,24,25,26,27,35,38,41,56,57,60,63', '', '', '', '0', '', 'ssdf', 0),
(19, 'hi', '2016/06/27', '08:48:21pm', 'ssdf', '1', '', 'ssdf', '', '', '', '', '0', '', '', 0),
(21, 'hi\r\n', '2016/06/28', '10:54:50pm', 'ssdf', '1', '', 'ssdf', '', '', '', '', '0', '', '', 0),
(22, 'Hello&apos;hi', '2016/06/28', '11:07:00pm', 'ssdf', '1', '', 'ssdf', '11,12,13,15,16,17,19,93,94', '', '', '', '0', '', '', 0),
(23, 'you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write ', '2016/06/30', '08:18:03pm', 'ssdf', '1', '', 'ssdf', '', '', '', '', '0', '', '', 0),
(24, 'you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you write you write you write you write you write you write ', '2016/06/30', '08:18:52pm', 'ssdf', '1', '', 'ssdf', '', '', '', '', '0', '', '', 0),
(25, 'this is my test pic', '2016/07/07', '12:31:42pm', 'test', '0', '', 'ssdf', '28,29,30,31,32,33,34,36,37,39,40,43,44,45,46,47,48,49,50,51,52,53,54,55,58,59,61,62,64,100', '/bkd/userdata/pictures/ssdf/WIN_20160404_14_43_19_Pro.jpg', '', '', '0', '', 'ssdf', 0),
(26, 'Is it alright...', '2016/07/16', '05:20:24pm', 'ssdf', '1', '', 'ssdf', '80,91', '', '', '', '0', '', '', 0),
(27, 'Hey', '2016/07/22', '09:27:45pm', 'ssdf', '0', '', '', '65', '', '', '', '0', '', 'ssdf', 0),
(28, 'testing text', '2016/07/22', '09:40:42pm', 'ssdf', '0', '', '', '', '', '', '', '0', '', 'ssdf', 0),
(29, 'hi\r\n', '2016/07/22', '09:42:00pm', 'ssdf', '0', '', '', '', '', '', '', '0', '', 'ssdf', 0),
(30, 'this photo check', '2016/07/22', '09:42:34pm', 'ssdf', '0', '', '', '', 'userdata/pictures/ssdf/WIN_20160211_23_31_24_Pro.jpg', '', '', '0', '', '', 0),
(31, 'pic test 2\r\n', '2016/07/22', '09:46:31pm', 'ssdf', '0', '', '', '', 'userdata/pictures/ssdf/WIN_20160404_14_43_19_Pro.jpg', '', '', '0', '', 'Ssdf', 0),
(32, 'hi', '2016/07/22', '09:48:08pm', 'ssdf', '0', '', '', '66', 'userdata/pictures/ssdf/WIN_20160129_20_40_22_Pro.jpg', '', '', '0', '', '', 0),
(33, 'Verifying photo upload', '2016/07/22', '09:50:18pm', 'ssdf', '0', '', '', '', 'userdata/pictures/ssdf/WIN_20151227_16_48_44_Pro.jpg', '', '', '0', '', '', 0),
(34, 'this is #me', '2016/07/23', '12:53:17pm', 'ssdf', '0', '', '', '', '', '', '', '0', '', '', 0),
(35, 'This is #me test.', '2016/07/23', '12:53:55pm', 'ssdf', '0', '', '', '97', '', '', '', '0', '', '', 0),
(36, 'THis is #me testing.', '2016/07/23', '01:03:42pm', 'ssdf', '0', '', '', '67,68,69,70,71,105', '', '', '', '0', '', '', 0),
(37, 'This is #me pic', '2016/07/23', '01:07:01pm', 'ssdf', '0', '', '', '95', 'userdata/pictures/ssdf/WIN_20160124_13_52_58_Pro.jpg', '', '', '0', '', 'ssdf', 0),
(38, 'This is #me again', '2016/07/23', '01:08:47pm', 'ssdf', '0', '', '', '72,73,74,75,76,77,78,79,81,82,83,84,85,86,87,88,89', 'userdata/pictures/ssdf/WIN_20151230_17_54_33_Pro.jpg', '', '', '0', '', 'ssdf,Ssdf', 0),
(39, 'Meghna #me', '2016/08/07', '01:09:57am', 'ssdf', '0', '', '', '98,99', 'userdata/pictures/ssdf/1470557361532-1197113215.jpg', '', '', '0', '', 'ssdf,Ssdf', 0),
(40, 'hi', '2016/09/24', '01:28:58pm', 'ssdf', '0', '', '', '', '', '', '', '0', '', '', 0),
(41, 'family', '2016/09/24', '01:29:29pm', 'ssdf', '0', '', '', '', 'userdata/pictures/ssdf/family.jpg', '', '', '0', '', '', 0),
(42, 'he', '2016/09/24', '01:34:35pm', 'ssdf', '0', '', '', '', 'userdata/pictures/ssdf/WIN_20151230_17_54_18_Pro.jpg', '', '', '0', '', '', 0),
(43, '', '2016/09/24', '06:13:33pm', 'ssdf', '0', '', '', '', 'userdata/pictures/ssdf/WIN_20151227_16_48_38_Pro.jpg', '', '', '0', '', '', 0),
(44, '', '2016/09/24', '06:16:40pm', 'ssdf', '0', '', '', '', 'userdata/pictures/ssdf/WIN_20160129_20_40_22_Pro.jpg', '', '', '0', '', '', 0),
(45, '', '2016/09/24', '06:17:19pm', 'ssdf', '0', '', '', '', 'userdata/pictures/ssdf/WIN_20151230_17_54_18_Pro.jpg', '', '', '0', '', '', 0),
(46, '', '2016/09/24', '06:23:21pm', 'ssdf', '0', '', '', '', 'userdata/pictures/ssdf/WIN_20151227_16_48_44_Pro.jpg', '', '', '0', '', 'Ssdf', 0),
(47, '', '2016/09/24', '06:24:09pm', 'ssdf', '0', '', '', '104', 'userdata/pictures/ssdf/family.jpg', '', '', '0', '', 'test,Test', 0),
(48, 'family', '2016/09/24', '06:24:44pm', 'ssdf', '1', '', 'ssdf', '', 'userdata/pictures/ssdf/family.jpg', '', '', '0', '', '', 0),
(49, '', '2016/09/25', '09:27:41pm', 'Ssdf', '0', '', '', '', 'userdata/pictures/Ssdf/823a486bd803684347de4d5ea9c1c2ed.jpg', '', '', '0', '', 'Ssdf,ssdf', 0),
(50, 'Moneray bay Jelly fish', '2016/10/01', '06:34:04pm', 'test', '0', '', '', '102,103,106', 'userdata/pictures/test/Jellyfish.jpg', '', '', '0', '', 'Ssdf', 0),
(61, 'lighthouse', '2016/10/01', '06:59:16pm', 'test', '0', '', '', '', 'userdata/pictures/test/Lighthouse.jpg', '', '', '0', '', '', 0),
(62, 'lighthouse', '2016/10/01', '07:00:34pm', 'test', '0', '', '', '', 'userdata/pictures/test/Lighthouse.jpg', '', '', '0', '', '', 0),
(63, 'Cat', '2016/10/01', '07:02:35pm', 'Ssdf', '0', '', '', '', 'userdata/pictures/Ssdf/w_11958646_3YSUMnQo.jpg', '', '', '0', '', '', 0),
(64, 'Penguines from antartica.', '2016/10/01', '07:16:31pm', 'test', '0', '', '', '', 'userdata/pictures/test/Penguins.jpg', '', '', '0', '', 'Test', 0),
(65, 'Penguines from antartica.', '2016/10/01', '07:16:46pm', 'test', '0', '', '', '', 'userdata/pictures/test/Penguins.jpg', '', '', '0', '', '', 0),
(66, 'Penguines from antartica.', '2016/10/01', '07:17:40pm', 'test', '0', '', '', '', 'userdata/pictures/test/Penguins.jpg', '', '', '0', '', '', 0),
(67, 'Penguines from antartica.', '2016/10/01', '07:20:26pm', 'test', '0', '', '', '107', 'userdata/pictures/test/Penguins.jpg', '', '', '0', '', 'Test', 0),
(68, 'hello colors', '2016/10/15', '08:24:11pm', 'vik', '0', '', '', '', 'userdata/pictures/vik/380-full-of-color-.gif', '', '', '0', '', 'vik', 0),
(69, 'dsfasdfads', '2016/11/05', '08:59:49pm', 'test', '0', '', '', '', '', '', '', '0', '', '', 0),
(70, 'dsfasdfads', '2016/11/05', '09:00:01pm', 'test', '0', '', '', '', '', '', '', '0', '', 'test', 0),
(71, 'dsfasdfads', '2016/11/05', '09:07:18pm', 'test', '0', '', '', '', '', '', '', '0', '', '', 0),
(72, 'dsfasdfads', '2016/11/05', '09:08:41pm', 'test', '0', '', '', '108,109,110,111,112,113,114,115,116,117', '', '', '', '0', '', '', 0),
(73, 'dsfasdfads', '2016/11/05', '09:08:48pm', 'test', '0', '', '', '', '', '', '', '0', '', '', 0),
(74, 'dsfasdfads', '2016/11/05', '09:08:53pm', 'test', '0', '', '', '', '', '', '', '0', '', 'test', 0),
(75, 'dsfasdfads', '2016/11/05', '09:08:59pm', 'test', '0', '', '', '118', '', '', '', '0', '', 'ssdf,dsf,fgdfh,sad,sad,asd,fd,sdf,dsf,dsf,dsf,sdf,test', 1),
(76, 'xxzcxzcxzc', '2016/11/05', '10:22:42pm', 'test', '0', '', '', '', '', '', '', '0', '', '', 2),
(77, 'xxzcxzcxzc', '2016/11/05', '10:22:44pm', 'test', '0', '', '', '', '', '', '', '0', '', 'test', 2),
(78, 'test', '2016/11/05', '10:24:58pm', 'test', '0', '', '', '', '', '', '', '0', '', 'test', 1),
(79, '<h1>Hi</h1>', '2016/11/05', '10:27:33pm', 'test', '0', '', '', '', '', '', '', '0', '', 'test', 0),
(80, ':D', '2016/11/05', '10:28:17pm', 'test', '0', '', '', '', 'userdata/pictures/test/dace2.PNG', '', '', '0', '', 'test', 1),
(81, '&lt;h1&gt;test&lt;/h1&gt;', '2016/11/05', '11:11:25pm', 'test', '0', '', '', '119', '', '', '', '0', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE IF NOT EXISTS `report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `flagger` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `post_id`, `flagger`) VALUES
(1, 38, 'ssdf'),
(2, 38, 'ssdf'),
(3, 26, 'ssdf'),
(4, 26, 'ssdf'),
(5, 26, 'ssdf'),
(6, 25, 'ssdf'),
(7, 26, 'ssdf'),
(8, 25, 'ssdf'),
(9, 38, 'ssdf'),
(10, 38, 'ssdf'),
(11, 38, 'Ssdf'),
(12, 26, 'ssdf'),
(13, 26, 'ssdf'),
(14, 38, 'ssdf'),
(15, 38, 'ssdf'),
(16, 39, 'Ssdf'),
(17, 39, 'Ssdf'),
(18, 39, 'Ssdf'),
(19, 39, 'Ssdf'),
(20, 39, 'Ssdf'),
(21, 39, 'ssdf'),
(22, 39, 'ssdf'),
(23, 25, 'ssdf'),
(24, 25, 'ssdf'),
(25, 25, 'ssdf'),
(26, 38, 'Ssdf'),
(27, 49, 'ssdf'),
(28, 49, 'ssdf'),
(29, 67, 'Ssdf'),
(30, 67, 'ssdf'),
(31, 65, 'Test'),
(32, 76, 'test'),
(33, 76, 'test'),
(34, 76, 'test'),
(35, 76, 'test'),
(36, 76, 'test'),
(37, 76, 'test'),
(38, 77, 'test'),
(39, 80, 'test');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `student_id`, `password`, `sign_up_date`, `bio`, `profile_pic`, `bannerimg`, `following`, `followers`, `sex`, `dob`, `interests`, `dmfriends`, `es`, `ms`, `grade`, `home_ip`, `last_ip`, `ips_array`, `online`, `last_online_date`, `last_online_time`, `admin`, `activated`, `account_closer`, `groups`) VALUES
(1, 'ssdf', 'Vikrant', 'Bandyopadhyay', 538881, '5d41402abc4b2a76b9719d911017c592', '6/8/2016', 'Hello, I am the president of the site please dm me if you need any help.\n', 'userdata/pictures/ssdf/380-full-of-color-.gif', 'userdata/pictures/Ssdf/IMG_20160816_162655.jpg', 'test123,thissdf,test', 'test,ssdf,vik', '0', '2/5/2002', 'coding,', 'vik,Test', 'Hariyana', 'Dartmouth', '9', '67.188.81.253', '67.188.81.253', '67.188.81.253', '1', '6/8/2016', '9:24pm', '1', '1', '', ''),
(2, 'test', 'Taste', 'Tasty', 394584, '5d41402abc4b2a76b9719d911017c592', '6/27/2016', 'This is a test account to test the functionality of the website pls dont mind me\r\n', 'https://pbs.twimg.com/profile_images/577783755605028864/IIojQn3V.jpeg', 'http://www.theresiliencyinstitute.net/wp-content/uploads/2013/09/TRI-Banner-background.jpg', 'ssdf', 'Ssdf', '0', '2/5/2002', '', 'thissdf,test123,ssdf', 'Something', 'Dartmouth', '9', '71.202.74.188', '71.202.74.188', '71.202.74.188', '0', '6/27/2016', '8:44pm', '0', '1', '', '1,2'),
(3, 'test123', 'test123', 'testpart', 2342931, '5d41402abc4b2a76b9719d911017c592', '7/20/2016', 'this is another test account to understand whats going on in the site.\r\n', 'https://expertbeacon.com/sites/default/files/advice_for_men_on_selecting_your_online_dating_profile_photo.jpg', '', '', 'ssdf', '1', '2/5/2002', NULL, 'vik,test', 'This', 'Dartmouth', '12', '71.202.74.188', '71.202.74.188', '71.202.74.188', '0', '7/20/2016', '7:45pm', '0', '1', '', ''),
(4, 'thissdf', 'dfjs', 'sdkf', 20498203, 'd41d8cd98f00b204e9800998ecf8427e', '07/28/16', '', '', '', '', 'ssdf', '', '2016-07-14', '', 'vik,Test', 'sdkjfs', 'sdfsdf', '9', '::1', '::1', '::1', '1', '07/28/16', '1469678763', '0', '1', '', ''),
(5, 'saikat', 'Saikat', 'Bandyopadhyay', 898423, '5d41402abc4b2a76b9719d911017c592', '09/02/16', '', '', '', '', 'Ssdf', '', '2015-06-12', '', '', 'KVI', 'KVI', '9', '::1', '::1', '::1', '1', '09/02/16', '1472789724', '0', '1', '', ''),
(6, 'Vik', 'Vikrant', 'Banerjee', 65356, '5d41402abc4b2a76b9719d911017c592', '09/29/16', '', '', '', 'ssdf', '', '1', '2016-09-15', '', 'thissdf,ssdf,test123', 'Jxh', 'Hch', '9', '192.168.0.104', '192.168.0.104', '192.168.0.104', '1', '09/29/16', '1475117084', '0', '1', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
