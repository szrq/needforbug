-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2012 年 12 月 02 日 08:57
-- 服务器版本: 5.5.22
-- PHP 版本: 5.4.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `needforbug`
--

--
-- 转存表中的数据 `needforbug_shoparticlecategory`
--

INSERT INTO `needforbug_shoparticlecategory` (`shoparticlecategory_id`, `shoparticlecategory_name`, `shoparticlecategory_keywords`, `shoparticlecategory_description`, `shoparticlecategory_sort`, `shoparticlecategory_type`, `shoparticlecategory_status`, `shoparticlecategory_parentid`, `create_dateline`) VALUES
(1, '如何购买', '', '', 0, 9, 1, 0, 1353805312),
(2, '站点地图', '', '', 0, 9, 1, 0, 1353805364),
(3, '商城特色', '', '', 0, 9, 1, 0, 1353805377),
(4, '关于我们', '', '', 0, 9, 1, 0, 1353805393),
(5, '商城公告', '', '公告分类', 0, 1, 1, 0, 1354419136),
(6, '意见反馈', '', '用户反馈信息分类', 0, 1, 1, 0, 1354419163);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
