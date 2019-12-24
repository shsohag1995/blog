-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2019 at 08:50 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `copyright`
--

CREATE TABLE `copyright` (
  `id` int(11) NOT NULL,
  `copyright` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `copyright`
--

INSERT INTO `copyright` (`id`, `copyright`) VALUES
(1, 'Copyright Khalid');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `name`) VALUES
(4, 'CSS'),
(5, 'Programming');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_msg`
--

CREATE TABLE `tbl_msg` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `msg` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_msg`
--

INSERT INTO `tbl_msg` (`id`, `firstname`, `lastname`, `email`, `msg`, `date`, `status`) VALUES
(1, 'Khalid Hossain', 'Akash', 'khalid@gmail.com', 'Hi. this msg is for testing', '2019-06-12 01:47:25', 1),
(2, 'Khalid Hossain', 'Akash', 'akash@gmail.com', 'ADFASDFA', '2019-06-12 01:48:15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_page`
--

CREATE TABLE `tbl_page` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_page`
--

INSERT INTO `tbl_page` (`id`, `name`, `content`) VALUES
(1, 'About Us', '<p>This is the about Us page.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />tempor incididunt ut labore et dolore magna aliqua. Ut enim <span style=\"background-color: #00ff00;\">ad minim veniam,</span><br />quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br />consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat <a name=\"NO_name\"></a>non<img title=\"Cool\" src=\"js/tiny-mce/plugins/emotions/img/smiley-cool.gif\" alt=\"Cool\" border=\"0\" /><br />proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br />ipsum Lorem ipsum dolor sit amet, consectetur adipisicing eli</p>\r\n<hr />\r\n<p>&nbsp;<br />quis nostrud exercitation ullamco <ins id=\"601078379966926\" title=\"ki dibo re vi \" cite=\"NO cite\" datetime=\"2019-06-11T20:15:59\">laboris nisi ut aliquip ex ea commodo<br />consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br />proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</ins></p>\r\n<div style=\"position: absolute; left: 8px; top: 20px; width: 100px; height: 100px;\">New layer...</div>\r\n<div style=\"position: absolute; left: 8px; top: 20px; width: 100px; height: 100px;\">New layer...</div>'),
(4, 'Portfolio ', '<p>Portfolio site.</p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"background-color: #00ff00;\">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</span><br /><span style=\"background-color: #00ff00;\">tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</span><br /><span style=\"background-color: #00ff00;\">quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</span><br />consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br />proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br />consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br />proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_post`
--

CREATE TABLE `tbl_post` (
  `id` int(11) NOT NULL,
  `cat` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `author` varchar(50) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_post`
--

INSERT INTO `tbl_post` (`id`, `cat`, `title`, `body`, `image`, `author`, `tags`, `date`, `userid`) VALUES
(25, 1, 'Java Post One From Admin panel', '<p>asdasd</p>', '1e0cdd1d13.png', 'Khalid', 'pgoramming', '2019-06-10 11:37:32', 1),
(28, 1, 'Java Post One From Admin panel', '<p>ASDFASFDasdfasdf</p>', '1ef16220b8.png', 'Akash', 'java , pgoramming', '2019-06-10 11:42:02', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slider`
--

CREATE TABLE `tbl_slider` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_slider`
--

INSERT INTO `tbl_slider` (`id`, `title`, `image`) VALUES
(4, 'First Slide', 'f07dfbb148.jpg'),
(5, 'Second Slide', 'a97d0cef1f.jpg'),
(6, 'Third Slide', '51f29e0891.jpg'),
(7, 'Fourth Slide Title', '03b7effb34.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_socialmedia`
--

CREATE TABLE `tbl_socialmedia` (
  `id` int(11) NOT NULL,
  `fb` varchar(255) NOT NULL,
  `tw` varchar(255) NOT NULL,
  `ln` varchar(255) NOT NULL,
  `gp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_socialmedia`
--

INSERT INTO `tbl_socialmedia` (`id`, `fb`, `tw`, `ln`, `gp`) VALUES
(1, 'https://facebook.com/khalid.hossain.akash', 'http://twitter.com', 'http://linkedin.com', 'http://google-plus.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_title_slogan`
--

CREATE TABLE `tbl_title_slogan` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slogan` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_title_slogan`
--

INSERT INTO `tbl_title_slogan` (`id`, `title`, `slogan`, `logo`) VALUES
(1, 'This is our website title', 'This is our site\'s slogan', 'logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `name`, `username`, `password`, `email`, `details`, `role`) VALUES
(1, 'Khalid Hossain', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'khalid@gmail.com', '&lt;p&gt;Hello I am Khalid hossain akash administrator of this Blog.&lt;/p&gt;', 0),
(2, 'Akash', 'author', '02bd92faa38aaa6cc0ea75e59937a1ef', 'akash@gmail.com', 'hello this is akash and author of this blog.', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `copyright`
--
ALTER TABLE `copyright`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_msg`
--
ALTER TABLE `tbl_msg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_page`
--
ALTER TABLE `tbl_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_post`
--
ALTER TABLE `tbl_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_socialmedia`
--
ALTER TABLE `tbl_socialmedia`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_title_slogan`
--
ALTER TABLE `tbl_title_slogan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `copyright`
--
ALTER TABLE `copyright`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_msg`
--
ALTER TABLE `tbl_msg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_page`
--
ALTER TABLE `tbl_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_post`
--
ALTER TABLE `tbl_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_socialmedia`
--
ALTER TABLE `tbl_socialmedia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_title_slogan`
--
ALTER TABLE `tbl_title_slogan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
