-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 22, 2016 at 02:10 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=91 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `body`, `date_added`, `time_added`, `added_by`, `posted_to`, `tags`, `user_posted_to`, `commentsid`, `picture`, `video`, `youtubevideo`, `hidden`, `hidden_by`, `liked_by`, `post_group`) VALUES
(82, 'Hi', '', '1478585736', 'ssdf', '0', '', '', '', '', '', '', '0', '', 'ssdf', 0),
(83, 'hi', '', '1478585743', 'ssdf', '0', '', '', '', '', '', '', '0', '', '', 0),
(84, 'hey\r\n', '', '1478585752', 'ssdf', '0', '', '', '', '', '', '', '0', '', 'ssdf,test', 0),
(85, 'Einstein!!', '', '1478585752', 'ssdf', '0', '', '', '122,123,124,125,126', 'userdata/pictures/ssdf/einstein-genius-quote.jpg', '', '', '0', '', 'ssdf,test', 0),
(86, 'hi', '', '1478840421', 'test', '0', '', '', '120,121', '', '', '', '0', '', 'test,ssdf', 0),
(87, '#hello', '', '1478940284', 'ssdf', '0', '', '', '127', '', '', '', '0', '', 'ssdf,test', 0),
(88, 'Hello ', '', '1479009459', 'test', '0', '', '', '', '', '', '', '1', 'Ssdf', 'ssdf', 1),
(89, 'heyyyyy', '', '1479609205', 'test', '0', '', '', '', '', '', '', '1', 'Ssdf', '', 0),
(90, 'hihihi', '', '1479609282', 'test', '0', '', '', '', '', '', '', '1', 'ssdf', 'ssdf', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
