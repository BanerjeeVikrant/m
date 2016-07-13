-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2016 at 04:55 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

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
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `from` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

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
(23, 'working', 'ssdf');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `crush`
--

INSERT INTO `crush` (`id`, `body`, `by`, `picture`, `time_added`, `date_added`) VALUES
(1, 'i am a really bad boy', 'ssdf', 'https://s-media-cache-ak0.pinimg.com/736x/d2/6c/51/d26c511a38b62ec9a2faf464b798e755.jpg', '6:24pm', '7/11/2016');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

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
(16, '1', '2', 'right');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `username`, `photo_link`, `post_id`) VALUES
(2, 'ssdf', '/bkd/userdata/pictures/ssdf/newyear.jpg', 15),
(3, 'ssdf', '/bkd/userdata/pictures/ssdf/einstein-genius-quote.jpg', 16),
(4, 'ssdf', '/bkd/userdata/pictures/ssdf/newyear.jpg', 17),
(5, 'ssdf', '/bkd/userdata/pictures/ssdf/WIN_20160404_14_43_19_Pro.jpg', 25);

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `body`, `date_added`, `time_added`, `added_by`, `posted_to`, `tags`, `user_posted_to`, `commentsid`, `picture`, `video`, `youtubevideo`, `hidden`, `hidden_by`, `liked_by`) VALUES
(1, 'This is how the world is today', '6/13/2016', '9:41pm', 'ssdf', '1', '', 'ssdf', '', 'http://c.tadst.com/gfx/750w/doomsday-rule.jpg?1', '', '', '0', '', ''),
(2, 'This is how the world is today', '6/13/2016', '9:41pm', 'ssdf', '0', '', 'ssdf', '', 'https://upload.wikimedia.org/wikipedia/commons/2/2a/Keyboard-anykey.jpg', '', '', '0', '', ''),
(3, 'This is how the world is today', '6/13/2016', '9:41pm', 'ssdf', '1', '', 'ssdf', '14,20', '', '', 'https://www.youtube.com/embed/3PoMeL1mCak', '0', '', ''),
(4, 'Whats up bros?', '2016/06/16', '09:52:04pm', 'ssdf', '1', '', 'ssdf', '', '', '', '', '0', '', ''),
(5, 'Just checking!', '2016/06/16', '09:53:06pm', 'ssdf', '1', '', 'ssdf', '', '', '', '', '0', '', ''),
(6, 'hi', '2016/06/16', '11:32:09pm', 'ssdf', '1', '', 'ssdf', '', '/bkd/userdata/pictures/ssdf/bearpic.png', '', '', '0', '', ''),
(7, 'listen to einstein!', '2016/06/16', '11:38:09pm', 'ssdf', '1', '', 'ssdf', '', '/bkd/userdata/pictures/ssdf/einstein-genius-quote.jpg', '', '', '0', '', ''),
(8, 'its not new year ... ', '2016/06/16', '11:40:55pm', 'ssdf', '1', '', 'ssdf', '', '/bkd/userdata/pictures/ssdf/newyear.jpg', '', '', '0', '', ''),
(9, '', '2016/06/16', '11:44:04pm', 'ssdf', '1', '', 'ssdf', '', '/bkd/userdata/pictures/ssdf/einstein-genius-quote.jpg', '', '', '0', '', ''),
(12, 'hi', '2016/06/17', '12:58:41pm', 'ssdf', '1', '', 'ssdf', '', '', '/bkd/userdata/videos/ssdf/WIN_20160215_18_56_21_Pro.mp4', '', '0', '', ''),
(13, 'hi', '2016/06/17', '06:57:04pm', 'ssdf', '0', '', 'ssdf', '', '', '/bkd/userdata/videos/ssdf/hello video.mp4', '', '0', '', ''),
(14, 'ok', '2016/06/18', '04:04:46pm', 'test', '0', '', 'ssdf', '', '/bkd/userdata/pictures/ssdf/einstein-genius-quote.jpg', '', '', '0', '', ''),
(15, 'sdfd', '2016/06/18', '04:06:46pm', 'ssdf', '0', '', 'ssdf', '8,9', '/bkd/userdata/pictures/ssdf/newyear.jpg', '', '', '0', '', ''),
(16, 'sdf', '2016/06/25', '04:00:52pm', 'ssdf', '1', '', 'ssdf', '7,10,18,21,23', '/bkd/userdata/pictures/ssdf/einstein-genius-quote.jpg', '', '', '0', '', ''),
(17, 'hello ', '2016/06/25', '04:29:58pm', 'ssdf', '1', '', 'ssdf', '', '/bkd/userdata/pictures/ssdf/newyear.jpg', '', '', '0', '', ''),
(18, 'Test welcome to the site!', '2016/06/27', '08:45:54pm', 'test', '0', '', 'test', '22', '', '', '', '0', '', ''),
(19, 'hi', '2016/06/27', '08:48:21pm', 'ssdf', '1', '', 'ssdf', '', '', '', '', '0', '', ''),
(21, 'hi\r\n', '2016/06/28', '10:54:50pm', 'ssdf', '1', '', 'ssdf', '', '', '', '', '0', '', ''),
(22, 'Hello&apos;hi', '2016/06/28', '11:07:00pm', 'ssdf', '1', '', 'ssdf', '11,12,13,15,16,17,19', '', '', '', '0', '', ''),
(23, 'you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write ', '2016/06/30', '08:18:03pm', 'ssdf', '1', '', 'ssdf', '', '', '', '', '0', '', ''),
(24, 'you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you writ you write you write you write you write you write you write you write ', '2016/06/30', '08:18:52pm', 'ssdf', '1', '', 'ssdf', '', '', '', '', '0', '', ''),
(25, 'this is my test pic', '2016/07/07', '12:31:42pm', 'test', '0', '', 'ssdf', '', '/bkd/userdata/pictures/ssdf/WIN_20160404_14_43_19_Pro.jpg', '', '', '0', '', '');

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
  `relationship` enum('0','1') NOT NULL,
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `student_id`, `password`, `sign_up_date`, `bio`, `profile_pic`, `bannerimg`, `following`, `followers`, `sex`, `dob`, `interests`, `relationship`, `es`, `ms`, `grade`, `home_ip`, `last_ip`, `ips_array`, `online`, `last_online_date`, `last_online_time`, `admin`, `activated`, `account_closer`) VALUES
(1, 'ssdf', 'Vikrant', 'Bandyopadhyay', 538881, '5d41402abc4b2a76b9719d911017c592', '6/8/2016', 'Hello, I am the president of the site please dm me if you need any help.\n', 'https://pbs.twimg.com/media/CFEmt0IUEAAUVyG.jpg', '', 'ssdf,test', '', '0', '2/5/2002', 'coding,', '0', 'Hariyana', 'Dartmouth', '9', '67.188.81.253', '67.188.81.253', '67.188.81.253', '1', '6/8/2016', '9:24pm', '1', '1', ''),
(2, 'test', 'Taste', 'Tasty', 394584, '5d41402abc4b2a76b9719d911017c592', '6/27/2016', 'This is a test account to test the functionality of the website pls dont mind me\r\n', 'https://pbs.twimg.com/media/CFEmt0IUEAAUVyG.jpg', 'http://www.theresiliencyinstitute.net/wp-content/uploads/2013/09/TRI-Banner-background.jpg', '', 'ssdf', '0', '2/5/2002', '', '0', 'Something', 'Dartmouth', '9', '71.202.74.188', '71.202.74.188', '71.202.74.188', '0', '6/27/2016', '8:44pm', '0', '1', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
