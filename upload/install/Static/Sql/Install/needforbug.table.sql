-- NEEDFORBUG 数据库表
-- version 1.0
-- http://www.doyouhaobaby.net
--
-- 开发: DianniuTeam
-- 网站: http://dianniu.net

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- 数据库: `needforbug`
--

-- --------------------------------------------------------

--
-- 表的结构 `needforbug_access`
--

DROP TABLE IF EXISTS `#@__access`;
CREATE TABLE `#@__access` (
  `role_id` smallint(6) unsigned NOT NULL COMMENT '角色ID',
  `node_id` smallint(6) unsigned NOT NULL COMMENT '节点ID',
  `access_level` tinyint(1) NOT NULL COMMENT '级别，1（应用），2（模块），3（方法）',
  `access_parentid` smallint(6) NOT NULL COMMENT '父级ID',
  `access_status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  KEY `group_id` (`role_id`),
  KEY `node_id` (`node_id`),
  KEY `access_status` (`access_status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `needforbug_adminctrlmenu`
--

DROP TABLE IF EXISTS `#@__adminctrlmenu`;
CREATE TABLE `#@__adminctrlmenu` (
  `adminctrlmenu_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '后台菜单ID',
  `adminctrlmenu_internal` tinyint(1) NOT NULL DEFAULT '0' COMMENT '快捷菜单类型，0自定义，1内置',
  `adminctrlmenu_title` varchar(50) NOT NULL COMMENT '后台菜单标题',
  `adminctrlmenu_url` varchar(255) NOT NULL COMMENT '后台菜单网址',
  `adminctrlmenu_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '后台菜单状态',
  `adminctrlmenu_sort` tinyint(3) NOT NULL COMMENT '后台菜单排序',
  `adminctrlmenu_clicknum` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '后台菜单点击量',
  `user_id` int(10) unsigned NOT NULL COMMENT '后台菜单操作人',
  `adminctrlmenu_admin` varchar(50) NOT NULL COMMENT '操作人用户名',
  `create_dateline` int(10) unsigned NOT NULL COMMENT '后台菜单创建时间',
  PRIMARY KEY (`adminctrlmenu_id`),
  KEY `adminctrlmenu_status` (`adminctrlmenu_status`),
  KEY `adminctrlmenu_sort` (`adminctrlmenu_sort`),
  KEY `user_id` (`user_id`),
  KEY `create_dateline` (`create_dateline`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `needforbug_app`
--

DROP TABLE IF EXISTS `#@__app`;
CREATE TABLE `#@__app` (
  `app_id` mediumint(8) NOT NULL AUTO_INCREMENT COMMENT '应用ID',
  `app_identifier` varchar(32) NOT NULL COMMENT '应用唯一识别符',
  `app_name` varchar(32) NOT NULL COMMENT '应用名字',
  `app_version` varchar(20) NOT NULL COMMENT '应用版本',
  `app_description` varchar(255) NOT NULL COMMENT '应用描述',
  `app_url` varchar(255) NOT NULL COMMENT '应用官方网站',
  `app_email` varchar(255) NOT NULL COMMENT '应用邮件',
  `app_author` varchar(32) NOT NULL COMMENT '应用作者',
  `app_authorurl` varchar(255) NOT NULL COMMENT '应用作者主页',
  `app_isadmin` tinyint(1) NOT NULL DEFAULT '0' COMMENT '应用是否需要管理项',
  `app_isinstall` tinyint(1) NOT NULL DEFAULT '0' COMMENT '应用是否需要安装',
  `app_isuninstall` tinyint(1) NOT NULL DEFAULT '0' COMMENT '应用是否需要卸载',
  `app_issystem` tinyint(1) NOT NULL DEFAULT '0' COMMENT '应用是否为系统核心',
  `app_isappnav` tinyint(1) NOT NULL DEFAULT '0' COMMENT '应用是否需要写入前台菜单',
  `app_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否启用应用',
  PRIMARY KEY (`app_id`),
  UNIQUE KEY `app_identifier` (`app_identifier`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `needforbug_appeal`
--

DROP TABLE IF EXISTS `#@__appeal`;
CREATE TABLE `#@__appeal` (
  `appeal_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '申诉ID',
  `user_id` int(10) NOT NULL COMMENT '申诉用户ID',
  `appeal_realname` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT '申诉真实姓名',
  `appeal_address` varchar(300) CHARACTER SET utf8 NOT NULL COMMENT '申诉详细地址',
  `appeal_idnumber` varchar(32) CHARACTER SET utf8 NOT NULL COMMENT '申诉身份证号码',
  `appeal_email` varchar(150) CHARACTER SET utf8 NOT NULL COMMENT '申诉邮件地址',
  `appeal_receiptnumber` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT '申诉回执号码',
  `create_dateline` int(10) NOT NULL COMMENT '创建时间',
  `update_dateline` int(10) NOT NULL COMMENT '更新时间',
  `appeal_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '申诉状态',
  `appeal_progress` tinyint(1) NOT NULL DEFAULT '0' COMMENT '申诉进度',
  `appeal_reason` text CHARACTER SET utf8 NOT NULL COMMENT '驳回理由',
  PRIMARY KEY (`appeal_id`),
  KEY `user_id` (`user_id`),
  KEY `create_dateline` (`create_dateline`),
  KEY `update_dateline` (`update_dateline`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `needforbug_badword`
--

DROP TABLE IF EXISTS `#@__badword`;
CREATE TABLE `#@__badword` (
  `badword_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '词语替换ID',
  `badword_admin` varchar(50) NOT NULL DEFAULT '' COMMENT '添加词语过滤用户',
  `badword_find` varchar(300) NOT NULL DEFAULT '' COMMENT '待查找的过滤词语',
  `badword_replacement` varchar(300) NOT NULL DEFAULT '' COMMENT '待替换的过滤词语',
  `badword_findpattern` varchar(300) NOT NULL DEFAULT '' COMMENT '查找的正则表达式',
  `create_dateline` int(10) NOT NULL COMMENT '创建时间',
  `update_dateline` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`badword_id`),
  UNIQUE KEY `find` (`badword_find`),
  KEY `create_dateline` (`create_dateline`),
  KEY `update_dateline` (`update_dateline`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `needforbug_creditrule`
--

DROP TABLE IF EXISTS `#@__creditrule`;
CREATE TABLE `#@__creditrule` (
  `creditrule_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '积分规则ID',
  `creditrule_name` varchar(20) NOT NULL DEFAULT '' COMMENT '积分规则名字',
  `creditrule_action` varchar(20) NOT NULL DEFAULT '' COMMENT '规则action唯一KEY',
  `creditrule_cycletype` tinyint(1) NOT NULL DEFAULT '0' COMMENT '奖励周期0:一次;1:每天;2:整点;3:间隔分钟;4:不限',
  `creditrule_cycletime` int(10) NOT NULL DEFAULT '0' COMMENT '间隔时间',
  `creditrule_rewardnum` tinyint(2) NOT NULL DEFAULT '1' COMMENT '周期内最多奖励次数',
  `creditrule_extendcredit1` int(10) NOT NULL DEFAULT '0' COMMENT '第一种积分类型',
  `creditrule_extendcredit2` int(10) NOT NULL DEFAULT '0' COMMENT '第二种积分类型',
  `creditrule_extendcredit3` int(10) NOT NULL DEFAULT '0' COMMENT '第三种积分类型',
  `creditrule_extendcredit4` int(10) NOT NULL DEFAULT '0' COMMENT '第四种积分类型',
  `creditrule_extendcredit5` int(10) NOT NULL DEFAULT '0' COMMENT '第五种积分类型',
  `creditrule_extendcredit6` int(10) NOT NULL DEFAULT '0' COMMENT '第六种积分类型',
  `creditrule_extendcredit7` int(10) NOT NULL DEFAULT '0' COMMENT '第七种积分类型',
  `creditrule_extendcredit8` int(10) NOT NULL DEFAULT '0' COMMENT '第八种积分类型',
  PRIMARY KEY (`creditrule_id`),
  KEY `creditrule_action` (`creditrule_action`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `needforbug_creditrulelog`
--

DROP TABLE IF EXISTS `#@__creditrulelog`;
CREATE TABLE `#@__creditrulelog` (
  `creditrulelog_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '策略日志ID',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '策略日志所有者uid',
  `creditrule_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '策略ID',
  `creditrulelog_total` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '策略被执行总次数',
  `creditrulelog_cyclenum` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '周期被执行次数',
  `creditrulelog_extendcredit1` int(10) NOT NULL DEFAULT '0' COMMENT '第一种积分类型',
  `creditrulelog_extendcredit2` int(10) NOT NULL DEFAULT '0' COMMENT '第二种积分类型',
  `creditrulelog_extendcredit3` int(10) NOT NULL DEFAULT '0' COMMENT '第三种积分类型',
  `creditrulelog_extendcredit4` int(10) NOT NULL DEFAULT '0' COMMENT '第四种积分类型',
  `creditrulelog_extendcredit5` int(10) NOT NULL DEFAULT '0' COMMENT '第五种积分类型',
  `creditrulelog_extendcredit6` int(10) NOT NULL DEFAULT '0' COMMENT '第六种积分类型',
  `creditrulelog_extendcredit7` int(10) NOT NULL DEFAULT '0' COMMENT '第七种积分类型',
  `creditrulelog_extendcredit8` int(10) NOT NULL DEFAULT '0' COMMENT '第八种积分类型',
  `creditrulelog_starttime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '周期开始时间',
  `update_dateline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '策略最后执行时间',
  PRIMARY KEY (`creditrulelog_id`),
  KEY `user_id` (`user_id`),
  KEY `creditrule_id` (`creditrule_id`),
  KEY `update_dateline` (`update_dateline`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `needforbug_friend`
--

DROP TABLE IF EXISTS `#@__friend`;
CREATE TABLE `#@__friend` (
  `user_id` int(10) NOT NULL COMMENT '用户ID',
  `friend_friendid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '好友ID',
  `friend_direction` tinyint(1) NOT NULL DEFAULT '1' COMMENT '关系，1（A加B）,3（A与B彼此相加）',
  `friend_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `friend_comment` char(255) NOT NULL DEFAULT '' COMMENT '备注',
  `friend_fancomment` varchar(255) NOT NULL COMMENT '粉丝备注',
  `create_dateline` int(10) NOT NULL COMMENT '添加时间',
  `friend_username` varchar(50) NOT NULL COMMENT '用户名',
  `friend_friendusername` varchar(50) NOT NULL COMMENT '好友用户名',
  KEY `user_id` (`user_id`),
  KEY `friend_friendid` (`friend_friendid`),
  KEY `create_dateline` (`create_dateline`),
  KEY `friend_status` (`friend_status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `needforbug_homefresh`
--

DROP TABLE IF EXISTS `#@__homefresh`;
CREATE TABLE `#@__homefresh` (
  `homefresh_id` mediumint(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '新鲜事ID',
  `homefresh_title` varchar(300) NOT NULL COMMENT '新鲜事标题',
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '用户',
  `homefresh_username` varchar(15) NOT NULL DEFAULT '' COMMENT '用户名',
  `homefresh_from` varchar(20) NOT NULL DEFAULT '' COMMENT '来源',
  `create_dateline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `homefresh_message` text NOT NULL COMMENT '新鲜事内容',
  `homefresh_ip` varchar(20) NOT NULL DEFAULT '' COMMENT 'IP',
  `homefresh_commentnum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评论数量',
  `homefresh_goodnum` int(10) NOT NULL COMMENT '赞数量',
  `homefresh_viewnum` int(10) NOT NULL COMMENT '评论数量',
  `homefresh_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '新鲜事状态',
  PRIMARY KEY (`homefresh_id`),
  KEY `create_dateline` (`create_dateline`),
  KEY `homefresh_status` (`homefresh_status`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `needforbug_homefreshcomment`
--

DROP TABLE IF EXISTS `#@__homefreshcomment`;
CREATE TABLE `#@__homefreshcomment` (
  `homefreshcomment_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '评论ID',
  `create_dateline` int(10) NOT NULL COMMENT '创建时间',
  `update_dateline` int(10) NOT NULL COMMENT '更新时间',
  `user_id` mediumint(8) NOT NULL DEFAULT '0' COMMENT '用户ID，在线用户评论',
  `homefreshcomment_name` varchar(25) NOT NULL COMMENT '名字',
  `homefreshcomment_content` text NOT NULL COMMENT '内容',
  `homefreshcomment_email` varchar(300) NOT NULL COMMENT '邮件',
  `homefreshcomment_url` varchar(300) NOT NULL COMMENT 'URL',
  `homefreshcomment_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示',
  `homefreshcomment_ip` varchar(16) NOT NULL COMMENT 'IP',
  `homefreshcomment_parentid` mediumint(8) NOT NULL DEFAULT '0' COMMENT '父级ID',
  `homefreshcomment_isreplymail` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否邮件通知，通知给评论者',
  `homefreshcomment_ismobile` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否为手机评论',
  `homefreshcomment_auditpass` tinyint(1) NOT NULL DEFAULT '1' COMMENT '审核是否通过',
  `homefresh_id` char(10) NOT NULL COMMENT '新鲜事ID',
  PRIMARY KEY (`homefreshcomment_id`),
  KEY `user_id` (`user_id`),
  KEY `homefresh_id` (`homefresh_id`),
  KEY `create_dateline` (`create_dateline`),
  KEY `update_dateline` (`update_dateline`),
  KEY `homefreshcomment_status` (`homefreshcomment_status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- 表的结构 `needforbug_homehelp`
--

DROP TABLE IF EXISTS `#@__homehelp`;
CREATE TABLE `#@__homehelp` (
  `homehelp_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '帮组ID',
  `homehelp_title` varchar(250) NOT NULL COMMENT '帮组标题',
  `homehelp_content` text NOT NULL COMMENT '帮助正文',
  `homehelpcategory_id` int(10) NOT NULL DEFAULT '0' COMMENT '帮组信息分类',
  `homehelp_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '帮助状态',
  `create_dateline` int(10) NOT NULL COMMENT '创建时间',
  `update_dateline` int(10) NOT NULL COMMENT '更新时间',
  `user_id` int(10) NOT NULL DEFAULT '0' COMMENT '发布用户',
  `homehelp_username` varchar(50) NOT NULL COMMENT '文章发布用户',
  `homehelp_updateuserid` int(10) NOT NULL DEFAULT '0' COMMENT '最新更新帮助的用户',
  `homehelp_updateusername` varchar(50) NOT NULL COMMENT '文章最后更新用户',
  `homehelp_viewnum` int(10) NOT NULL DEFAULT '0' COMMENT '帮助浏览次数',
  PRIMARY KEY (`homehelp_id`),
  KEY `create_dateline` (`create_dateline`),
  KEY `update_dateline` (`update_dateline`),
  KEY `homehelp_status` (`homehelp_status`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `needforbug_homehelpcategory`
--

DROP TABLE IF EXISTS `#@__homehelpcategory`;
CREATE TABLE `#@__homehelpcategory` (
  `homehelpcategory_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '帮助分类ID',
  `homehelpcategory_name` char(32) NOT NULL DEFAULT '' COMMENT '帮助分类名字',
  `homehelpcategory_count` int(10) NOT NULL DEFAULT '0' COMMENT '帮助个数',
  `homehelpcategory_sort` smallint(6) NOT NULL DEFAULT '0' COMMENT '帮助分类排序名字',
  `update_dateline` int(10) NOT NULL DEFAULT '0' COMMENT '最后更新时间',
  `create_dateline` int(10) NOT NULL COMMENT '群组创建时间',
  PRIMARY KEY (`homehelpcategory_id`),
  KEY `create_dateline` (`create_dateline`),
  KEY `update_dateline` (`update_dateline`),
  KEY `homehelpcategory_sort` (`homehelpcategory_sort`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `needforbug_homeoption`
--

DROP TABLE IF EXISTS `#@__homeoption`;
CREATE TABLE `#@__homeoption` (
  `homeoption_name` varchar(32) NOT NULL DEFAULT '' COMMENT '名字',
  `homeoption_value` text NOT NULL COMMENT '值',
  PRIMARY KEY (`homeoption_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `needforbug_homesite`
--

DROP TABLE IF EXISTS `#@__homesite`;
CREATE TABLE `#@__homesite` (
  `homesite_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `homesite_name` char(32) NOT NULL DEFAULT '' COMMENT '键值',
  `homesite_nikename` char(32) NOT NULL COMMENT '站点信息别名',
  `homesite_content` text NOT NULL COMMENT '内容',
  PRIMARY KEY (`homesite_id`),
  UNIQUE KEY `homesite_name` (`homesite_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `needforbug_hometag`
--

DROP TABLE IF EXISTS `#@__hometag`;
CREATE TABLE `#@__hometag` (
  `hometag_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户标签',
  `hometag_name` char(32) NOT NULL DEFAULT '' COMMENT '标签名字',
  `hometag_count` int(10) NOT NULL DEFAULT '0' COMMENT '标签用户数量',
  `hometag_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否可用',
  `create_dateline` int(10) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`hometag_id`),
  KEY `hometag_name` (`hometag_name`),
  KEY `hometag_status` (`hometag_status`),
  KEY `create_dateline` (`create_dateline`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `needforbug_hometagindex`
--

DROP TABLE IF EXISTS `#@__hometagindex`;
CREATE TABLE `#@__hometagindex` (
  `user_id` int(10) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `hometag_id` int(10) NOT NULL DEFAULT '0' COMMENT '标签ID',
  PRIMARY KEY (`user_id`,`hometag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `needforbug_link`
--

DROP TABLE IF EXISTS `#@__link`;
CREATE TABLE `#@__link` (
  `link_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '衔接ID',
  `create_dateline` int(10) NOT NULL COMMENT '创建时间',
  `update_dateline` int(10) NOT NULL COMMENT '更新时间',
  `link_name` varchar(32) NOT NULL COMMENT '名字',
  `link_url` varchar(250) NOT NULL COMMENT 'URL',
  `link_description` varchar(300) NOT NULL COMMENT '描述',
  `link_logo` varchar(360) NOT NULL DEFAULT '0' COMMENT 'LOGO',
  `link_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示',
  `link_sort` smallint(6) NOT NULL COMMENT '排序',
  PRIMARY KEY (`link_id`),
  KEY `link_status` (`link_status`),
  KEY `link_sort` (`link_sort`),
  KEY `create_dateline` (`create_dateline`),
  KEY `update_dateline` (`update_dateline`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `needforbug_loginlog`
--

DROP TABLE IF EXISTS `#@__loginlog`;
CREATE TABLE `#@__loginlog` (
  `loginlog_id` mediumint(8) NOT NULL AUTO_INCREMENT COMMENT '登录ID',
  `user_id` mediumint(8) NOT NULL COMMENT '用户ID',
  `create_dateline` int(10) NOT NULL COMMENT '创建时间',
  `update_dateline` int(10) NOT NULL COMMENT '更新时间',
  `loginlog_user` varchar(50) NOT NULL COMMENT '登录用户',
  `loginlog_ip` varchar(40) NOT NULL COMMENT '登录IP',
  `loginlog_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '登录状态',
  `login_application` varchar(20) NOT NULL COMMENT '登录应用',
  PRIMARY KEY (`loginlog_id`),
  KEY `user_id` (`user_id`),
  KEY `create_dateline` (`create_dateline`),
  KEY `loginlog_status` (`loginlog_status`),
  KEY `update_dateline` (`update_dateline`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `needforbug_mail`
--

DROP TABLE IF EXISTS `#@__mail`;
CREATE TABLE `#@__mail` (
  `mail_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '邮件ID',
  `mail_touserid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '接受用户ID',
  `mail_fromuserid` mediumint(8) NOT NULL DEFAULT '0' COMMENT '发送用户ID',
  `mail_tomail` varchar(100) NOT NULL COMMENT '接收者邮件地址',
  `mail_frommail` varchar(100) NOT NULL COMMENT '发送者邮件地址',
  `mail_subject` varchar(300) NOT NULL COMMENT '主题',
  `mail_message` text NOT NULL COMMENT '内容',
  `mail_charset` varchar(15) NOT NULL COMMENT '编码',
  `mail_htmlon` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否开启html',
  `mail_level` tinyint(1) NOT NULL DEFAULT '1' COMMENT '紧急级别',
  `create_dateline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_dateline` int(10) NOT NULL COMMENT '更新时间',
  `mail_status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态，是否成功',
  `mail_application` varchar(20) NOT NULL COMMENT '来源应用',
  PRIMARY KEY (`mail_id`),
  KEY `create_dateline` (`create_dateline`),
  KEY `update_dateline` (`update_dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `needforbug_nav`
--

DROP TABLE IF EXISTS `#@__nav`;
CREATE TABLE `#@__nav` (
  `nav_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '导航ID',
  `nav_parentid` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '父级ID',
  `nav_name` varchar(32) NOT NULL COMMENT '菜单名字，如群组',
  `nav_identifier` varchar(255) NOT NULL COMMENT 'URL唯一标识符',
  `nav_title` varchar(255) NOT NULL COMMENT '菜单标题，如Group',
  `nav_url` varchar(255) NOT NULL COMMENT '菜单URL地址',
  `nav_target` tinyint(1) NOT NULL DEFAULT '0' COMMENT '菜单是否新窗口打开',
  `nav_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '菜单类型，0内置，1自定义',
  `nav_style` varchar(55) NOT NULL COMMENT '菜单的下划线，斜体，粗体修饰',
  `nav_location` tinyint(1) NOT NULL DEFAULT '0' COMMENT '导航位置，0主导航，1头部，2底部',
  `nav_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否显示',
  `nav_sort` tinyint(3) NOT NULL COMMENT '菜单排序',
  `nav_color` tinyint(1) NOT NULL DEFAULT '0' COMMENT '菜单高亮，对应一些颜色值',
  `nav_icon` varchar(255) NOT NULL COMMENT '菜单图标',
  PRIMARY KEY (`nav_id`),
  KEY `nav_status` (`nav_status`),
  KEY `nav_sort` (`nav_sort`),
  KEY `nav_identifier` (`nav_identifier`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `needforbug_node`
--

DROP TABLE IF EXISTS `#@__node`;
CREATE TABLE `#@__node` (
  `node_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '节点ID',
  `node_name` varchar(50) NOT NULL COMMENT '名字',
  `node_title` varchar(50) DEFAULT NULL COMMENT '别名',
  `node_status` tinyint(1) DEFAULT '0' COMMENT '状态',
  `node_remark` varchar(300) DEFAULT NULL COMMENT '备注',
  `node_sort` smallint(6) unsigned DEFAULT NULL COMMENT '排序',
  `node_parentid` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '父级ID',
  `node_level` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '级别，1（应用），2（模块），3（方法）',
  `nodegroup_id` tinyint(3) unsigned DEFAULT '0' COMMENT '分组ID',
  `create_dateline` int(10) NOT NULL COMMENT '创建时间',
  `update_dateline` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`node_id`),
  KEY `node_level` (`node_level`),
  KEY `node_name` (`node_name`),
  KEY `node_status` (`node_status`),
  KEY `node_parentid` (`node_parentid`),
  KEY `create_dateline` (`create_dateline`),
  KEY `nodegroup_id` (`nodegroup_id`),
  KEY `update_dateline` (`update_dateline`),
  KEY `node_sort` (`node_sort`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `needforbug_nodegroup`
--

DROP TABLE IF EXISTS `#@__nodegroup`;
CREATE TABLE `#@__nodegroup` (
  `nodegroup_id` smallint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT '节点分组ID',
  `nodegroup_name` varchar(50) NOT NULL COMMENT '名字，英文',
  `nodegroup_title` varchar(50) NOT NULL COMMENT '别名，中文等注解',
  `create_dateline` int(10) unsigned NOT NULL COMMENT '创建时间',
  `update_dateline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `nodegroup_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `nodegroup_sort` smallint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`nodegroup_id`),
  KEY `create_dateline` (`create_dateline`),
  KEY `update_dateline` (`update_dateline`),
  KEY `nodegroup_sort` (`nodegroup_sort`),
  KEY `nodegroup_status` (`nodegroup_status`),
  KEY `nodegroup_name` (`nodegroup_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `needforbug_option`
--

DROP TABLE IF EXISTS `#@__option`;
CREATE TABLE `#@__option` (
  `option_name` varchar(32) NOT NULL DEFAULT '' COMMENT '名字',
  `option_value` text NOT NULL COMMENT '值',
  PRIMARY KEY (`option_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `needforbug_pm`
--

DROP TABLE IF EXISTS `#@__pm`;
CREATE TABLE `#@__pm` (
  `pm_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '短消息ID',
  `pm_msgfrom` varchar(50) NOT NULL DEFAULT '' COMMENT '来源',
  `pm_msgfromid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '来源用户ID',
  `pm_msgtoid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '接收ID',
  `pm_isread` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否已经阅读',
  `pm_subject` varchar(75) NOT NULL DEFAULT '' COMMENT '主题',
  `create_dateline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `pm_message` text NOT NULL COMMENT '内容',
  `pm_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '删除状态',
  `pm_mystatus` tinyint(1) NOT NULL DEFAULT '1' COMMENT '我的发件箱短消息状态',
  `pm_fromapp` varchar(30) NOT NULL COMMENT '来源应用',
  `pm_type` enum('system','user') NOT NULL DEFAULT 'user' COMMENT '类型',
  PRIMARY KEY (`pm_id`),
  KEY `pm_msgfromid` (`pm_msgfromid`),
  KEY `pm_msgtoid` (`pm_msgtoid`),
  KEY `create_dateline` (`create_dateline`),
  KEY `pm_status` (`pm_status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `needforbug_pmsystemdelete`
--

DROP TABLE IF EXISTS `#@__pmsystemdelete`;
CREATE TABLE `#@__pmsystemdelete` (
  `user_id` int(10) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `pm_id` int(10) NOT NULL COMMENT '系统短消息删除状态',
  PRIMARY KEY (`user_id`,`pm_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `needforbug_pmsystemread`
--

DROP TABLE IF EXISTS `#@__pmsystemread`;
CREATE TABLE `#@__pmsystemread` (
  `user_id` int(10) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `pm_id` int(10) NOT NULL COMMENT '系统短消息阅读状态',
  PRIMARY KEY (`user_id`,`pm_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `needforbug_rating`
--

DROP TABLE IF EXISTS `#@__rating`;
CREATE TABLE `#@__rating` (
  `rating_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '等级ID',
  `rating_name` varchar(50) NOT NULL COMMENT '名字',
  `rating_remark` varchar(300) DEFAULT NULL COMMENT '备注',
  `rating_nikename` varchar(55) DEFAULT NULL COMMENT '等级别名',
  `create_dateline` int(10) unsigned NOT NULL COMMENT '创建时间',
  `update_dateline` int(10) unsigned NOT NULL COMMENT '更新时间',
  `rating_creditstart` int(10) NOT NULL COMMENT '等级开始积分',
  `rating_creditend` int(10) NOT NULL COMMENT '等级结束积分',
  `ratinggroup_id` tinyint(3) NOT NULL COMMENT '等级分组',
  PRIMARY KEY (`rating_id`),
  KEY `rating_name` (`rating_name`),
  KEY `rating_nikename` (`rating_nikename`),
  KEY `ratinggroup_id` (`ratinggroup_id`),
  KEY `create_dateline` (`create_dateline`),
  KEY `update_dateline` (`update_dateline`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `needforbug_ratinggroup`
--

DROP TABLE IF EXISTS `#@__ratinggroup`;
CREATE TABLE `#@__ratinggroup` (
  `ratinggroup_id` smallint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT '等级分组ID',
  `ratinggroup_name` varchar(25) NOT NULL COMMENT '名字，英文',
  `ratinggroup_title` varchar(50) NOT NULL COMMENT '别名，中文等注解',
  `create_dateline` int(10) unsigned NOT NULL COMMENT '创建时间',
  `update_dateline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `ratinggroup_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `ratinggroup_sort` smallint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`ratinggroup_id`),
  KEY `create_dateline` (`create_dateline`),
  KEY `ratinggroup_name` (`ratinggroup_name`),
  KEY `ratinggroup_status` (`ratinggroup_status`),
  KEY `ratinggroup_sort` (`ratinggroup_sort`),
  KEY `update_dateline` (`update_dateline`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `needforbug_role`
--

DROP TABLE IF EXISTS `#@__role`;
CREATE TABLE `#@__role` (
  `role_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色ID',
  `role_name` varchar(50) NOT NULL COMMENT '名字',
  `role_parentid` smallint(6) DEFAULT NULL COMMENT '父级ID',
  `role_status` tinyint(1) unsigned DEFAULT NULL COMMENT '状态',
  `role_remark` varchar(300) DEFAULT NULL COMMENT '备注',
  `role_nikename` varchar(55) DEFAULT NULL COMMENT '角色别名',
  `create_dateline` int(10) unsigned NOT NULL COMMENT '创建时间',
  `update_dateline` int(10) unsigned NOT NULL COMMENT '更新时间',
  `rolegroup_id` tinyint(3) NOT NULL DEFAULT '0' COMMENT '角色分组ID',
  PRIMARY KEY (`role_id`),
  KEY `role_parentid` (`role_parentid`),
  KEY `role_status` (`role_status`),
  KEY `role_name` (`role_name`),
  KEY `create_dateline` (`create_dateline`),
  KEY `rolegroup_id` (`rolegroup_id`),
  KEY `role_nikename` (`role_nikename`),
  KEY `update_dateline` (`update_dateline`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `needforbug_rolegroup`
--

DROP TABLE IF EXISTS `#@__rolegroup`;
CREATE TABLE `#@__rolegroup` (
  `rolegroup_id` smallint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色分组ID',
  `rolegroup_name` varchar(50) NOT NULL COMMENT '名字，英文',
  `rolegroup_title` varchar(50) NOT NULL COMMENT '别名，中文等注解',
  `create_dateline` int(10) unsigned NOT NULL COMMENT '创建时间',
  `update_dateline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `rolegroup_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `rolegroup_sort` smallint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`rolegroup_id`),
  KEY `create_dateline` (`create_dateline`),
  KEY `update_dateline` (`update_dateline`),
  KEY `rolegroup_name` (`rolegroup_name`),
  KEY `rolegroup_status` (`rolegroup_status`),
  KEY `rolegroup_sort` (`rolegroup_sort`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `needforbug_session`
--

DROP TABLE IF EXISTS `#@__session`;
CREATE TABLE `#@__session` (
  `session_hash` varchar(6) NOT NULL COMMENT 'HASH',
  `session_auth_key` varchar(32) NOT NULL COMMENT 'AUTH_KEY',
  `user_id` mediumint(8) NOT NULL COMMENT '用户ID',
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `needforbug_slide`
--

DROP TABLE IF EXISTS `#@__slide`;
CREATE TABLE `#@__slide` (
  `slide_id` smallint(6) NOT NULL AUTO_INCREMENT COMMENT '滑动幻灯片状态ID',
  `slide_sort` smallint(6) NOT NULL DEFAULT '0' COMMENT '排序',
  `slide_title` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT '标题',
  `slide_url` varchar(325) CHARACTER SET utf8 NOT NULL COMMENT 'URL地址',
  `slide_img` varchar(325) CHARACTER SET utf8 NOT NULL COMMENT '图片地址',
  `slide_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_dateline` int(10) NOT NULL COMMENT '创建时间',
  `update_dateline` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`slide_id`),
  KEY `slide_status` (`slide_status`),
  KEY `create_dateline` (`create_dateline`),
  KEY `update_dateline` (`update_dateline`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `needforbug_style`
--

DROP TABLE IF EXISTS `#@__style`;
CREATE TABLE `#@__style` (
  `style_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '主题样式ID',
  `style_name` varchar(32) NOT NULL DEFAULT '' COMMENT '主题样式名字',
  `style_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '主题样式状态',
  `theme_id` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '模板ID',
  `style_extend` varchar(320) NOT NULL DEFAULT '' COMMENT '主题样式扩展',
  PRIMARY KEY (`style_id`),
  KEY `theme_id` (`theme_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `needforbug_stylevar`
--

DROP TABLE IF EXISTS `#@__stylevar`;
CREATE TABLE `#@__stylevar` (
  `stylevar_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '变量ID',
  `style_id` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '主题ID',
  `stylevar_variable` text NOT NULL COMMENT '变量名',
  `stylevar_substitute` text NOT NULL COMMENT '变量替换值',
  PRIMARY KEY (`stylevar_id`),
  KEY `style_id` (`style_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `needforbug_syscache`
--

DROP TABLE IF EXISTS `#@__syscache`;
CREATE TABLE `#@__syscache` (
  `syscache_name` varchar(32) NOT NULL COMMENT '缓存名字',
  `syscache_type` tinyint(3) unsigned NOT NULL COMMENT '缓存类型',
  `create_dateline` int(10) unsigned NOT NULL COMMENT '创建时间',
  `update_dateline` int(10) NOT NULL COMMENT '更新时间',
  `syscache_data` mediumblob NOT NULL COMMENT '缓存数据',
  PRIMARY KEY (`syscache_name`),
  KEY `create_dateline` (`create_dateline`),
  KEY `update_dateline` (`update_dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `needforbug_theme`
--

DROP TABLE IF EXISTS `#@__theme`;
CREATE TABLE `#@__theme` (
  `theme_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '主题ID',
  `theme_name` varchar(32) NOT NULL DEFAULT '' COMMENT '主题名字',
  `theme_dirname` varchar(32) NOT NULL COMMENT '主题英文目录名字',
  `theme_copyright` varchar(250) NOT NULL DEFAULT '' COMMENT '主题版权',
  PRIMARY KEY (`theme_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `needforbug_user`
--

DROP TABLE IF EXISTS `#@__user`;
CREATE TABLE `#@__user` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `user_name` varchar(50) CHARACTER SET ucs2 NOT NULL COMMENT '用户名',
  `user_nikename` varchar(50) DEFAULT NULL COMMENT '用户别名',
  `user_password` char(32) NOT NULL COMMENT '用户密码',
  `user_registerip` varchar(40) NOT NULL COMMENT '注册IP',
  `user_lastlogintime` int(11) DEFAULT NULL COMMENT '用户最后登录时间',
  `user_lastloginip` varchar(40) DEFAULT NULL COMMENT '用户登录IP',
  `user_logincount` int(10) DEFAULT '0' COMMENT '用户登录次数',
  `user_email` varchar(150) DEFAULT NULL COMMENT '用户Email',
  `user_remark` varchar(255) DEFAULT NULL COMMENT '用户备注',
  `user_sign` varchar(1000) NOT NULL COMMENT '用户签名',
  `create_dateline` int(10) DEFAULT NULL COMMENT '创建时间',
  `update_dateline` int(10) DEFAULT NULL COMMENT '更新时间',
  `user_status` tinyint(1) DEFAULT '0' COMMENT '用户状态',
  `user_random` char(6) NOT NULL COMMENT '用户随机码',
  `user_temppassword` varchar(255) NOT NULL COMMENT '密码重置临时密码',
  `user_extendstyle` varchar(35) NOT NULL COMMENT '用户扩展样式',
  PRIMARY KEY (`user_id`),
  KEY `user_status` (`user_status`),
  KEY `create_dateline` (`create_dateline`),
  KEY `user_email` (`user_email`),
  KEY `update_dateline` (`update_dateline`),
  KEY `user_password` (`user_password`),
  KEY `user_name` (`user_name`),
  KEY `user_nikename` (`user_nikename`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `needforbug_usercount`
--

DROP TABLE IF EXISTS `#@__usercount`;
CREATE TABLE `#@__usercount` (
  `user_id` mediumint(8) unsigned NOT NULL COMMENT '用户ID',
  `usercount_extendcredit1` int(10) NOT NULL DEFAULT '0' COMMENT '第一种积分类型',
  `usercount_extendcredit2` int(10) NOT NULL DEFAULT '0' COMMENT '第二种积分类型',
  `usercount_extendcredit3` int(10) NOT NULL DEFAULT '0' COMMENT '第三种积分类型',
  `usercount_extendcredit4` int(10) NOT NULL DEFAULT '0' COMMENT '第四种积分类型',
  `usercount_extendcredit5` int(10) NOT NULL DEFAULT '0' COMMENT '第五种积分类型',
  `usercount_extendcredit6` int(10) NOT NULL DEFAULT '0' COMMENT '第六种积分类型',
  `usercount_extendcredit7` int(10) NOT NULL DEFAULT '0' COMMENT '第七种积分类型',
  `usercount_extendcredit8` int(10) NOT NULL DEFAULT '0' COMMENT '第八种积分类型',
  `usercount_friends` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '用户好友数量',
  `usercount_oltime` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '用户在线时间',
  `usercount_fans` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户粉丝数量',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `needforbug_userprofile`
--

DROP TABLE IF EXISTS `#@__userprofile`;
CREATE TABLE `#@__userprofile` (
  `user_id` mediumint(8) unsigned NOT NULL COMMENT '用户ID',
  `userprofile_realname` varchar(255) NOT NULL DEFAULT '' COMMENT '真实姓名',
  `userprofile_gender` tinyint(1) NOT NULL DEFAULT '0' COMMENT '性别',
  `userprofile_birthyear` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '出生年份',
  `userprofile_birthmonth` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '出生月份',
  `userprofile_birthday` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '生日',
  `userprofile_constellation` varchar(255) NOT NULL DEFAULT '' COMMENT '星座',
  `userprofile_zodiac` varchar(255) NOT NULL DEFAULT '' COMMENT '生肖',
  `userprofile_telephone` varchar(255) NOT NULL DEFAULT '' COMMENT '固定电话',
  `userprofile_mobile` varchar(255) NOT NULL DEFAULT '' COMMENT '手机',
  `userprofile_idcardtype` varchar(255) NOT NULL DEFAULT '' COMMENT '证件类型',
  `userprofile_idcard` varchar(255) NOT NULL DEFAULT '' COMMENT '证件号',
  `userprofile_address` varchar(255) NOT NULL DEFAULT '' COMMENT '邮寄地址',
  `userprofile_zipcode` varchar(255) NOT NULL DEFAULT '' COMMENT '邮编',
  `userprofile_nationality` varchar(255) NOT NULL DEFAULT '' COMMENT '国籍',
  `userprofile_birthprovince` varchar(255) NOT NULL DEFAULT '' COMMENT '出生省份',
  `userprofile_birthcity` varchar(255) NOT NULL DEFAULT '' COMMENT '出生地',
  `userprofile_birthdist` varchar(20) NOT NULL DEFAULT '' COMMENT '出生县',
  `userprofile_birthcommunity` varchar(255) NOT NULL DEFAULT '' COMMENT '出生小区',
  `userprofile_resideprovince` varchar(255) NOT NULL DEFAULT '' COMMENT '居住省份',
  `userprofile_residecity` varchar(255) NOT NULL DEFAULT '' COMMENT '居住地',
  `userprofile_residedist` varchar(20) NOT NULL DEFAULT '' COMMENT '居住县',
  `userprofile_residecommunity` varchar(255) NOT NULL DEFAULT '' COMMENT '居住小区',
  `userprofile_residesuite` varchar(255) NOT NULL DEFAULT '' COMMENT '房间',
  `userprofile_graduateschool` varchar(255) NOT NULL DEFAULT '' COMMENT '毕业学校',
  `userprofile_company` varchar(255) NOT NULL DEFAULT '' COMMENT '学历',
  `userprofile_education` varchar(255) NOT NULL DEFAULT '' COMMENT '公司',
  `userprofile_occupation` varchar(255) NOT NULL DEFAULT '' COMMENT '职业',
  `userprofile_position` varchar(255) NOT NULL DEFAULT '' COMMENT '职位',
  `userprofile_revenue` varchar(255) NOT NULL DEFAULT '' COMMENT '年收入',
  `userprofile_affectivestatus` varchar(255) NOT NULL DEFAULT '' COMMENT '情感状态',
  `userprofile_lookingfor` varchar(255) NOT NULL DEFAULT '' COMMENT '交友目的',
  `userprofile_bloodtype` varchar(255) NOT NULL DEFAULT '' COMMENT '血型',
  `userprofile_height` varchar(255) NOT NULL DEFAULT '' COMMENT '身高',
  `userprofile_weight` varchar(255) NOT NULL DEFAULT '' COMMENT '体重',
  `userprofile_alipay` varchar(255) NOT NULL DEFAULT '' COMMENT '支付宝',
  `userprofile_icq` varchar(255) NOT NULL DEFAULT '' COMMENT 'ICQ',
  `userprofile_qq` varchar(255) NOT NULL DEFAULT '' COMMENT 'QQ',
  `userprofile_yahoo` varchar(255) NOT NULL DEFAULT '' COMMENT 'YAHOO帐号',
  `userprofile_msn` varchar(255) NOT NULL DEFAULT '' COMMENT 'MSN',
  `userprofile_taobao` varchar(255) NOT NULL DEFAULT '' COMMENT '阿里旺旺',
  `userprofile_site` varchar(255) NOT NULL DEFAULT '' COMMENT '个人主页',
  `userprofile_bio` text NOT NULL COMMENT '自我介绍',
  `userprofile_interest` text NOT NULL COMMENT '兴趣爱好',
  `userprofile_google` varchar(255) NOT NULL COMMENT 'Google帐号',
  `userprofile_baidu` varchar(255) NOT NULL COMMENT '百度帐号',
  `userprofile_renren` varchar(255) NOT NULL COMMENT '人人帐号',
  `userprofile_douban` varchar(255) NOT NULL COMMENT '豆瓣帐号',
  `userprofile_facebook` varchar(255) NOT NULL COMMENT 'Facebook',
  `userprofile_twriter` varchar(255) NOT NULL COMMENT 'TWriter',
  `userprofile_dianniu` varchar(255) NOT NULL COMMENT '点牛帐号',
  `userprofile_skype` varchar(255) NOT NULL COMMENT 'Skype',
  `userprofile_weibocom` varchar(255) NOT NULL COMMENT '新浪微博',
  `userprofile_tqqcom` varchar(255) NOT NULL COMMENT '腾讯微博',
  `userprofile_diandian` varchar(255) NOT NULL COMMENT '点点网',
  `userprofile_kindergarten` varchar(255) NOT NULL COMMENT '幼儿班',
  `userprofile_primary` varchar(255) NOT NULL COMMENT '小学',
  `userprofile_juniorhighschool` varchar(255) NOT NULL COMMENT '初中',
  `userprofile_highschool` varchar(255) NOT NULL COMMENT '高中',
  `userprofile_university` varchar(255) NOT NULL COMMENT '大学',
  `userprofile_master` varchar(255) NOT NULL COMMENT '硕士',
  `userprofile_dr` varchar(255) NOT NULL COMMENT '博士',
  `userprofile_nowschool` varchar(255) NOT NULL COMMENT '当前学校',
  `userprofile_field1` text NOT NULL COMMENT '自定义字段1',
  `userprofile_field2` text NOT NULL COMMENT '自定义字段2',
  `userprofile_field3` text NOT NULL COMMENT '自定义字段3',
  `userprofile_field4` text NOT NULL COMMENT '自定义字段4',
  `userprofile_field5` text NOT NULL COMMENT '自定义字段5',
  `userprofile_field6` text NOT NULL COMMENT '自定义字段6',
  `userprofile_field7` text NOT NULL COMMENT '自定义字段7',
  `userprofile_field8` text NOT NULL COMMENT '自定义字段8',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `needforbug_userprofilesetting`
--

DROP TABLE IF EXISTS `#@__userprofilesetting`;
CREATE TABLE `#@__userprofilesetting` (
  `userprofilesetting_id` varchar(255) NOT NULL DEFAULT '' COMMENT '个人信息字段名字',
  `userprofilesetting_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否启用属性字段',
  `userprofilesetting_title` varchar(255) NOT NULL DEFAULT '' COMMENT '个人信息标题',
  `userprofilesetting_description` varchar(255) NOT NULL DEFAULT '' COMMENT '个人信息描述',
  `userprofilesetting_sort` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '个人信息排序',
  `userprofilesetting_showinfo` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否显示在个人信息中',
  `userprofilesetting_allowsearch` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否允许搜索',
  `userprofilesetting_privacy` tinyint(1) NOT NULL DEFAULT '0' COMMENT '属性隐私 0公开，1好友可见，3保密',
  PRIMARY KEY (`userprofilesetting_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `needforbug_userrole`
--

DROP TABLE IF EXISTS `#@__userrole`;
CREATE TABLE `#@__userrole` (
  `role_id` mediumint(9) unsigned NOT NULL DEFAULT '0' COMMENT '角色ID',
  `user_id` char(32) NOT NULL DEFAULT '' COMMENT '用户ID',
  PRIMARY KEY (`role_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `needforbug_district`
--

DROP TABLE IF EXISTS `#@__district`;
CREATE TABLE `#@__district` (
  `district_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '地区ID',
  `district_name` varchar(255) NOT NULL DEFAULT '' COMMENT '地区名字',
  `district_level` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '地区级别，省份/城市/州县/乡镇',
  `district_upid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '上级地址ID值',
  `district_sort` smallint(6) NOT NULL DEFAULT '0' COMMENT '地区排序',
  PRIMARY KEY (`district_id`),
  KEY `district_upid` (`district_upid`),
  KEY `district_sort` (`district_sort`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
