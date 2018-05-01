-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2018 年 04 月 30 日 07:12
-- 服务器版本: 5.5.20
-- PHP 版本: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `cms`
--

-- ##* admin|new|tab_nav ##* --

-- ------------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `a_admin` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `a_pass` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `a_admin`, `a_pass`) VALUES
(9, 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(21, 'a', '0cc175b9c0f1b6a831c399e269772661'),
(22, 'b', '92eb5ffee6ae2fec3ad71c777531578f');

-- ------------------------------------------------------------

--
-- 表的结构 `new`
--

CREATE TABLE IF NOT EXISTS `new` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `new_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `new_content` text COLLATE utf8_unicode_ci NOT NULL,
  `new_time` date NOT NULL,
  `new_seo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `new_click` int(11) NOT NULL,
  `nav_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

--
-- 转存表中的数据 `new`
--

INSERT INTO `new` (`id`, `new_title`, `new_content`, `new_time`, `new_seo`, `new_click`, `nav_id`) VALUES
(19, 'wer', '<img src="/cms/kindeditor-4.1.10/attached/image/20151022/20151022025047_38721.jpg" alt="" />1', '2015-10-21', '12', 1, 19),
(20, '22', '2', '2015-10-21', '2', 2, 20),
(22, '2323', '4', '2015-10-22', '4', 4, 22),
(25, 'dfdf', 'df', '2015-10-22', 'df', 3, 20),
(27, '添加', '对方答复', '2015-10-22', '对方的', 1, 20),
(29, 'tererw', 'dsfdf', '2015-10-22', 'dfsdf', 0, 22),
(30, '8888', 'dfd', '2015-10-22', 'dfdf', 0, 19),
(31, 'dsfdsf', 'dsf', '2015-10-22', 'dfdff', 1, 19),
(32, '7687', '78', '2015-10-23', '78', 7, 20);

-- ------------------------------------------------------------

--
-- 表的结构 `tab_nav`
--

CREATE TABLE IF NOT EXISTS `tab_nav` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nav` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nav_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nav_order` int(11) NOT NULL DEFAULT '0',
  `nav_fater` int(11) NOT NULL DEFAULT '0',
  `url` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `seo_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `seo_content` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- 转存表中的数据 `tab_nav`
--

INSERT INTO `tab_nav` (`id`, `nav`, `nav_type`, `nav_order`, `nav_fater`, `url`, `seo_title`, `seo_content`) VALUES
(19, '企业文化', '图片类型', 0, 20, '', '22', '2'),
(20, '公司简介', '文章类型', 1, 0, '1.php', '1111111111111', '111'),
(22, '1111', '图片类型', 2, 0, '', '', '1212的');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
