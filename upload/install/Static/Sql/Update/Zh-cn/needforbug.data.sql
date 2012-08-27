-- NEEDFORBUG 数据库升级数据
-- version 1.0
-- http://www.doyouhaobaby.net
--
-- 开发: DianniuTeam
-- 网站: http://dianniu.net

--
-- 数据库: 升级数据
--

-- --------------------------------------------------------

--
-- 转存表中的数据 `needforbug_app`
--

INSERT INTO `needforbug_app` (`app_id`, `app_identifier`, `app_name`, `app_version`, `app_description`, `app_url`, `app_email`, `app_author`, `app_authorurl`, `app_isadmin`, `app_isinstall`, `app_isuninstall`, `app_issystem`, `app_isappnav`, `app_status`) VALUES
(1, 'home', '个人中心', '1.0', '个人中心应用', 'http://doyouhaobaby.net', 'admin@dianniu.net', 'DianniuTeam', 'http://doyouhaobaby.net', 1, 1, 1, 1, 0, 1);
