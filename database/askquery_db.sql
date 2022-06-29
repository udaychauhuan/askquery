-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2021 at 06:30 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `askquery_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) NOT NULL,
  `type` varchar(10) NOT NULL,
  `content_id` bigint(20) NOT NULL,
  `likes` text NOT NULL,
  `following` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `type`, `content_id`, `likes`, `following`) VALUES
(1, 'user', 1600579510570681, '[{\"userid\":\"1600579510570681\",\"date\":\"21-07-19 07:42:16\"}]', '[{\"userid\":\"1600579510570681\",\"date\":\"21-07-19 07:42:16\"},{\"userid\":\"121549886567232\",\"date\":\"21-07-19 07:42:46\"}]'),
(2, 'user', 121549886567232, '[{\"userid\":\"1600579510570681\",\"date\":\"21-07-19 07:42:46\"}]', '');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(19) NOT NULL,
  `postid` bigint(19) NOT NULL,
  `userid` bigint(19) NOT NULL,
  `post` text NOT NULL,
  `image` varchar(500) NOT NULL,
  `comments` int(11) NOT NULL,
  `likes` bigint(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `has_image` tinyint(1) NOT NULL,
  `post_dis` varchar(50) NOT NULL,
  `post_title` varchar(19) NOT NULL,
  `parent` bigint(20) NOT NULL,
  `reply_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `postid`, `userid`, `post`, `image`, `comments`, `likes`, `date`, `has_image`, `post_dis`, `post_title`, `parent`, `reply_id`) VALUES
(2, 457034736226, 1600579510570681, 'Welcomes, all of you to my world of blog. Some text about this blog entry. Fashion fashion and mauris neque quam, fermentum ut nisl vitae, convallis maximus nisl. Sed mattis nunc id lorem euismod placerat. Vivamus porttitor magna enim, ac accumsan tortor cursus at. Phasellus sed ultricies mi non congue ullam corper. Praesent tincidunt sedtellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.\r\n\r\nSunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.', 'upload/1600579510570681/nrzrekmkcL0PZdo.jpg', 0, 0, '2021-07-16 13:42:44', 1, 'social based', 'social ', 0, 0),
(3, 262865, 1600579510570681, 'Welcomes, all of you to my world of blog. Some text about this blog entry. Fashion fashion and mauris neque quam, fermentum ut nisl vitae, convallis maximus nisl. Sed mattis nunc id lorem euismod placerat. Vivamus porttitor magna enim, ac accumsan tortor cursus at. Phasellus sed ultricies mi non congue ullam corper. Praesent tincidunt sedtellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.\r\n\r\nSunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.', 'upload/1600579510570681/ysHE0boEzFB0LAV.jpg', 0, 0, '2021-07-18 06:39:01', 1, 'its technical ', 'tehcnologuy', 0, 0),
(6, 573, 1600579510570681, 'Welcomes, all of you to my world of blog. Some text about this blog entry. Fashion fashion and mauris neque quam, fermentum ut nisl vitae, convallis maximus nisl. Sed mattis nunc id lorem euismod placerat. Vivamus porttitor magna enim, ac accumsan tortor cursus at. Phasellus sed ultricies mi non congue ullam corper. Praesent tincidunt sedtellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.\r\n\r\nSunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.', 'upload/1600579510570681/P7j1bW6vubCPCwL.jpg', 0, 0, '2021-07-16 14:49:18', 1, 'its natur', 'natural', 0, 0),
(8, 143016, 1600579510570681, 'Welcomes, all of you to my world of blog. Some text about this blog entry. Fashion fashion and mauris neque quam, fermentum ut nisl vitae, convallis maximus nisl. Sed mattis nunc id lorem euismod placerat. Vivamus porttitor magna enim, ac accumsan tortor cursus at. Phasellus sed ultricies mi non congue ullam corper. Praesent tincidunt sedtellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.\r\n\r\nSunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.', 'upload/1600579510570681/2SuMsOhMm1jkzE.jpg', 0, 0, '2021-07-16 14:51:29', 1, 'its my first photo post', 'social ', 0, 0),
(9, 2687694716839, 1600579510570681, 'Welcomes, all of you to my world of blog. Some text about this blog entry. Fashion fashion and mauris neque quam, fermentum ut nisl vitae, convallis maximus nisl. Sed mattis nunc id lorem euismod placerat. Vivamus porttitor magna enim, ac accumsan tortor cursus at. Phasellus sed ultricies mi non congue ullam corper. Praesent tincidunt sedtellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.\r\n\r\nSunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.', 'upload/1600579510570681/jpVRV0aJtC1L863.jpg', 0, 0, '2021-07-16 14:51:49', 1, '', 'tehcnologuy after e', 0, 0),
(11, 684050, 121549886567232, 'Welcomes, all of you to my world of blog. Some text about this blog entry. Fashion fashion and mauris neque quam, fermentum ut nisl vitae, convallis maximus nisl. Sed mattis nunc id lorem euismod placerat. Vivamus porttitor magna enim, ac accumsan tortor cursus at. Phasellus sed ultricies mi non congue ullam corper. Praesent tincidunt sedtellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.\r\n\r\nSunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.', 'upload/121549886567232/6t5AWZQHYFebBoy.jpg', 0, 0, '2021-07-18 15:22:13', 1, 'social based', 'social ', 0, 0),
(13, 7286745760, 1600579510570681, 'Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.', 'upload/1600579510570681/0yHbmqVzhANUn5B.jpg', 0, 0, '2021-07-19 10:03:15', 1, 'its technical ', 'Testing ', 0, 0),
(14, 508, 121549886567232, 'Welcomes, all of you to my world of blog. Some text about this blog entry. Fashion fashion and mauris neque quam, fermentum ut nisl vitae, convallis maximus nisl. Sed mattis nunc id lorem euismod placerat. Vivamus porttitor magna enim, ac accumsan tortor cursus at. Phasellus sed ultricies mi non congue ullam corper. Praesent tincidunt sedtellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.', 'upload/121549886567232/XR8T4s383r15Lqk.jpg', 0, 0, '2021-07-19 10:32:15', 1, 'its technical ', 'tehcnologuy', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(19) NOT NULL,
  `userid` bigint(19) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `password` varchar(100) NOT NULL,
  `url_address` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `gender` varchar(19) NOT NULL,
  `profile_image` varchar(1000) NOT NULL,
  `cover_image` varchar(1000) NOT NULL,
  `work` varchar(50) NOT NULL,
  `lives` varchar(50) NOT NULL,
  `study` varchar(19) NOT NULL,
  `user_bio` varchar(1000) NOT NULL,
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userid`, `first_name`, `last_name`, `email`, `dob`, `password`, `url_address`, `date`, `gender`, `profile_image`, `cover_image`, `work`, `lives`, `study`, `user_bio`, `likes`) VALUES
(1, 1600579510570681, 'uday', 'chauha', 'divyanshu007singh@gmail.com', '2001-02-18', '123456', 'uday.pratap', '2021-07-19 17:42:16', 'male', 'upload/1600579510570681/CjRZrSPR4MlcEpp.jpg', 'upload/1600579510570681/vZWoMAvM6fmezl.jpg', 'facebook', 'mathura', 'mca(int.)', 'I take a lot of pride in being myself. I’m comfortable with who I am.', 1),
(3, 121549886567232, 'Siddesh', 'Sharma', 'yash654@gmail.com', '1254-12-21', '654321', 'siddesh.sharma', '2021-07-19 17:42:46', 'male', 'upload/121549886567232/rxjl1TO8PY1xA9i.jpg', 'upload/121549886567232/t0MRQb1ykfCJxbj.jpg', 'facebook', 'agra', 'mca(int.)', 'Smiling has always been easier than explaining why you’re sad.', 1),
(5, 7729655505993, 'Divay', 'Chauhan', 'divya123@gmail.com', '3658-11-12', '12345', 'divay.chauhan', '2021-07-19 17:35:58', 'female', 'upload/7729655505993/GSGebRj5SOUwWi1.jpg', 'upload/7729655505993/Qq79HfitJ10BbFH.jpg', '', '', '', '', 0),
(6, 6028130, 'Meena', 'Singh', 'meenachauhan@gmail.com', '1996-10-02', '12345', 'meena.singh', '2021-07-19 17:35:58', 'female', 'upload/6028130/ZRIpj8rN8eKhPPL.jpg', 'upload/6028130/J3f1IjmOBdvNTL2.jpg', '', '', '', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `content_id` (`content_id`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `postid` (`postid`),
  ADD KEY `userid` (`userid`),
  ADD KEY `image` (`image`),
  ADD KEY `comments` (`comments`),
  ADD KEY `likes` (`likes`),
  ADD KEY `date` (`date`),
  ADD KEY `has_image` (`has_image`),
  ADD KEY `post_title` (`post_title`),
  ADD KEY `parent` (`parent`),
  ADD KEY `reply_id` (`reply_id`);
ALTER TABLE `posts` ADD FULLTEXT KEY `post` (`post`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `first_name` (`first_name`),
  ADD KEY `email` (`email`),
  ADD KEY `last_name` (`last_name`),
  ADD KEY `url_address` (`url_address`),
  ADD KEY `date` (`date`),
  ADD KEY `password` (`password`),
  ADD KEY `work` (`work`),
  ADD KEY `study` (`study`),
  ADD KEY `likes` (`likes`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(19) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(19) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
