-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2017 �?07 �?07 �?09:37
-- 服务器版本: 5.5.53
-- PHP 版本: 5.6.27

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `hxkj`
--

-- --------------------------------------------------------

--
-- 表的结构 `addfriend`
--

CREATE TABLE IF NOT EXISTS `addfriend` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fromId` int(10) unsigned NOT NULL,
  `toId` int(10) unsigned NOT NULL,
  `content` varchar(200) DEFAULT NULL,
  `sendtime` datetime NOT NULL,
  `state` int(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `addfriend`
--

INSERT INTO `addfriend` (`id`, `fromId`, `toId`, `content`, `sendtime`, `state`) VALUES
(3, 2, 3, '你好，我是root', '2016-09-26 11:36:06', 2),
(4, 6, 2, '你好，我是麻六', '2016-09-26 14:25:07', 2),
(5, 5, 2, '你好，我是王五', '2016-09-26 14:58:40', 2),
(6, 2, 4, '你好，我是root', '2016-09-29 10:40:45', 2);

-- --------------------------------------------------------

--
-- 表的结构 `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `num` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(10) unsigned NOT NULL,
  `friendid` int(10) unsigned NOT NULL,
  `friendname` varchar(20) NOT NULL,
  `face` varchar(20) NOT NULL,
  PRIMARY KEY (`num`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=56 ;

--
-- 转存表中的数据 `friends`
--

INSERT INTO `friends` (`num`, `userid`, `friendid`, `friendname`, `face`) VALUES
(1, 2, 1, '幻想小子', 'face_01.jpg'),
(2, 3, 1, '幻想小子', 'face_01.jpg'),
(3, 4, 1, '幻想小子', 'face_01.jpg'),
(4, 5, 1, '幻想小子', 'face_01.jpg'),
(5, 6, 1, '幻想小子', 'face_01.jpg'),
(46, 6, 2, 'root', 'face_01.jpg'),
(47, 2, 6, '麻六', 'face_01.jpg'),
(48, 5, 2, 'root', 'face_01.jpg'),
(49, 2, 5, '王五', 'face_01.jpg'),
(50, 2, 3, '张三', 'face_01.jpg'),
(51, 3, 2, 'root', 'face_01.jpg'),
(52, 2, 4, '李四', 'face_01.jpg'),
(53, 4, 2, 'root', 'face_01.jpg'),
(54, 13, 1, '幻想小子', 'face_01.jpg'),
(55, 7, 1, '幻想小子', 'face_01.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `users` varchar(21) NOT NULL,
  `fromId` int(10) unsigned NOT NULL,
  `toId` int(10) unsigned NOT NULL,
  `content` varchar(200) NOT NULL,
  `sendtime` datetime NOT NULL,
  `state` int(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `message`
--

INSERT INTO `message` (`id`, `users`, `fromId`, `toId`, `content`, `sendtime`, `state`) VALUES
(1, '2-3', 3, 2, '你好！', '2016-09-29 13:57:31', 2),
(2, '2-3', 3, 2, '我是张三，很高兴认识你！', '2016-09-29 13:57:45', 2),
(3, '2-3', 3, 2, '交个朋友吧', '2016-09-29 13:58:15', 2),
(4, '2-6', 6, 2, '你好，我是麻6', '2016-09-29 13:58:52', 2),
(5, '2-6', 6, 2, '很高兴认识你', '2016-09-29 13:59:00', 2),
(6, '2-4', 4, 2, 'hello', '2016-09-29 13:59:32', 2),
(7, '2-3', 2, 3, '123456', '2016-09-29 17:53:59', 1),
(8, '2-3', 2, 3, '123456', '2016-10-17 15:50:19', 1);

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniqid` varchar(32) DEFAULT NULL,
  `activecode` varchar(32) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `sex` int(1) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `email` varchar(40) DEFAULT NULL,
  `face` varchar(100) NOT NULL,
  `birthday` date DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `destr` varchar(100) DEFAULT NULL,
  `regist_time` datetime DEFAULT NULL,
  `login_time` datetime DEFAULT NULL,
  `login_ip` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`userid`, `uniqid`, `activecode`, `name`, `password`, `sex`, `mobile`, `email`, `face`, `birthday`, `address`, `destr`, `regist_time`, `login_time`, `login_ip`) VALUES
(1, NULL, '', '幻想小子', '', 1, '', 'qjl_0805@126.com', 'face_01.jpg', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'c06640dd3ca2a3b693a7a1c290a687bf', '', 'root', '16e6e9ec546a543fed78ac678f25ceb8', 1, '13221052885', 'qjl_0805@163.com', 'face_01.jpg', '2017-07-10', NULL, NULL, '2016-09-24 10:46:00', '2017-07-05 11:25:40', NULL),
(3, 'e033cb542161a1bf2d874d68862613fa', '', '张三', '16e6e9ec546a543fed78ac678f25ceb8', 1, '13678455548', NULL, 'face_01.jpg', NULL, NULL, NULL, '2016-09-24 10:55:18', '2016-10-18 14:28:16', NULL),
(4, '266f718d26b31dcdc386d2a80f050410', '', '李四', '16e6e9ec546a543fed78ac678f25ceb8', 1, '13248789441', NULL, 'face_01.jpg', NULL, NULL, NULL, '2016-09-24 10:57:21', '2016-09-29 13:59:23', NULL),
(5, 'e838b6748ee9c6b9f03b4cb5de31e36f', '', '王五', '16e6e9ec546a543fed78ac678f25ceb8', 1, '13548421845', NULL, 'face_01.jpg', NULL, NULL, NULL, '2016-09-24 10:58:10', '2016-09-26 14:57:54', NULL),
(6, 'bb99e1265a8319dbd62fc7faf15fbe86', '', '麻六', '16e6e9ec546a543fed78ac678f25ceb8', 1, '13245489151', 'ml@126.com', 'face_01.jpg', '2016-09-14', 'asegasg', 'drhsdrhsdrh', '2016-09-24 11:32:26', '2016-09-29 13:58:32', NULL),
(7, NULL, '', 'abc', '16e6e9ec546a543fed78ac678f25ceb8', 1, '13221052885', NULL, 'face_01.jpg', NULL, NULL, NULL, '2017-07-05 11:25:15', NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
