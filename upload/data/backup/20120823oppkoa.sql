-- DoYouHaoBaby Database Backup Program
-- E:/php/xampp/htdocs/needforbug/upload/source/include/DoYouHaoBaby
-- 
-- OS : WINNT
-- DATE : 2012-08-23 16:37:21
-- DATABASE SERVER VERSION : 5.5.22
-- PHP VERSION : 5.4.0
-- Vol : 1
DROP TABLE IF EXISTS `needforbug_access`;
CREATE TABLE `needforbug_access` (
  `role_id` smallint(6) unsigned NOT NULL COMMENT '角色ID',
  `node_id` smallint(6) unsigned NOT NULL COMMENT '节点ID',
  `access_level` tinyint(1) NOT NULL COMMENT '级别，1（应用），2（模块），3（方法）',
  `access_parentid` smallint(6) NOT NULL COMMENT '父级ID',
  `access_status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  KEY `group_id` (`role_id`),
  KEY `node_id` (`node_id`),
  KEY `access_status` (`access_status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `needforbug_access` (`role_id`,`node_id`,`access_level`,`access_parentid`,`access_status`) VALUES ('3','1','1','0','1');
INSERT INTO `needforbug_access` (`role_id`,`node_id`,`access_level`,`access_parentid`,`access_status`) VALUES ('3','4','2','1','1');
INSERT INTO `needforbug_access` (`role_id`,`node_id`,`access_level`,`access_parentid`,`access_status`) VALUES ('3','2','2','1','1');
INSERT INTO `needforbug_access` (`role_id`,`node_id`,`access_level`,`access_parentid`,`access_status`) VALUES ('3','3','2','1','1');
INSERT INTO `needforbug_access` (`role_id`,`node_id`,`access_level`,`access_parentid`,`access_status`) VALUES ('3','11','3','3','1');
INSERT INTO `needforbug_access` (`role_id`,`node_id`,`access_level`,`access_parentid`,`access_status`) VALUES ('1','1','1','0','1');
INSERT INTO `needforbug_access` (`role_id`,`node_id`,`access_level`,`access_parentid`,`access_status`) VALUES ('1','4','2','1','1');
DROP TABLE IF EXISTS `needforbug_adminctrlmenu`;
CREATE TABLE `needforbug_adminctrlmenu` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `needforbug_app`;
CREATE TABLE `needforbug_app` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `needforbug_app` (`app_id`,`app_identifier`,`app_name`,`app_version`,`app_description`,`app_url`,`app_email`,`app_author`,`app_authorurl`,`app_isadmin`,`app_isinstall`,`app_isuninstall`,`app_issystem`,`app_isappnav`,`app_status`) VALUES ('43','group','小组','','群组应用','http://doyouhaobaby.net','admin@doyouhaobaby.net','小牛哥Dyhb','http://doyouhaobaby.net','1','1','1','1','1','1');
INSERT INTO `needforbug_app` (`app_id`,`app_identifier`,`app_name`,`app_version`,`app_description`,`app_url`,`app_email`,`app_author`,`app_authorurl`,`app_isadmin`,`app_isinstall`,`app_isuninstall`,`app_issystem`,`app_isappnav`,`app_status`) VALUES ('42','home','个人中心','1.0','个人中心应用','http://doyouhaobaby.net','admin@doyouhaobaby.net','小牛哥Dyhb','http://doyouhaobaby.net','1','1','1','1','0','1');
DROP TABLE IF EXISTS `needforbug_appeal`;
CREATE TABLE `needforbug_appeal` (
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
  `appeal_reason` text CHARACTER SET utf8mb4 NOT NULL COMMENT '驳回理由',
  PRIMARY KEY (`appeal_id`),
  KEY `user_id` (`user_id`),
  KEY `create_dateline` (`create_dateline`),
  KEY `update_dateline` (`update_dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `needforbug_appeal` (`appeal_id`,`user_id`,`appeal_realname`,`appeal_address`,`appeal_idnumber`,`appeal_email`,`appeal_receiptnumber`,`create_dateline`,`update_dateline`,`appeal_status`,`appeal_progress`,`appeal_reason`) VALUES ('1','1','小牛哥','','','xiaoniuge@dianniu.net','0000001544447865','1345653039','0','1','0','');
INSERT INTO `needforbug_appeal` (`appeal_id`,`user_id`,`appeal_realname`,`appeal_address`,`appeal_idnumber`,`appeal_email`,`appeal_receiptnumber`,`create_dateline`,`update_dateline`,`appeal_status`,`appeal_progress`,`appeal_reason`) VALUES ('2','1','小牛哥','','','xiaoniuge@dianniu.net','F5Da8e44D4D5840Cac4a0CE707b40c1E','1345653080','0','1','0','');
INSERT INTO `needforbug_appeal` (`appeal_id`,`user_id`,`appeal_realname`,`appeal_address`,`appeal_idnumber`,`appeal_email`,`appeal_receiptnumber`,`create_dateline`,`update_dateline`,`appeal_status`,`appeal_progress`,`appeal_reason`) VALUES ('3','1','小牛哥','','','xiaoniuge@dianniu.net','9A82AAAA16B96e136D691642AD34dfd1','1345653087','0','1','0','');
INSERT INTO `needforbug_appeal` (`appeal_id`,`user_id`,`appeal_realname`,`appeal_address`,`appeal_idnumber`,`appeal_email`,`appeal_receiptnumber`,`create_dateline`,`update_dateline`,`appeal_status`,`appeal_progress`,`appeal_reason`) VALUES ('4','1','小牛哥','','','xiaoniuge@dianniu.net','eDf0eD0BA1F68721fE8BE60fe93F5e7A','1345653942','0','1','0','');
INSERT INTO `needforbug_appeal` (`appeal_id`,`user_id`,`appeal_realname`,`appeal_address`,`appeal_idnumber`,`appeal_email`,`appeal_receiptnumber`,`create_dateline`,`update_dateline`,`appeal_status`,`appeal_progress`,`appeal_reason`) VALUES ('5','1','小牛哥','','','xiaoniuge@dianniu.net','20aEb9bCBE0121A224009A49170EAA42','1345653956','0','1','0','');
INSERT INTO `needforbug_appeal` (`appeal_id`,`user_id`,`appeal_realname`,`appeal_address`,`appeal_idnumber`,`appeal_email`,`appeal_receiptnumber`,`create_dateline`,`update_dateline`,`appeal_status`,`appeal_progress`,`appeal_reason`) VALUES ('6','1','小牛哥','','','xiaoniuge@dianniu.net','99fB9C362D33178d1B0600CAbaAcA232','1345654015','0','1','0','');
INSERT INTO `needforbug_appeal` (`appeal_id`,`user_id`,`appeal_realname`,`appeal_address`,`appeal_idnumber`,`appeal_email`,`appeal_receiptnumber`,`create_dateline`,`update_dateline`,`appeal_status`,`appeal_progress`,`appeal_reason`) VALUES ('7','1','小牛哥','','','xiaoniuge@dianniu.net','7FBC32747Fa63bD731766fcb3d5EBf9F','1345654044','0','1','0','');
INSERT INTO `needforbug_appeal` (`appeal_id`,`user_id`,`appeal_realname`,`appeal_address`,`appeal_idnumber`,`appeal_email`,`appeal_receiptnumber`,`create_dateline`,`update_dateline`,`appeal_status`,`appeal_progress`,`appeal_reason`) VALUES ('8','1','小牛哥','','','xiaoniuge@dianniu.net','625A87C50D874D61D0cD4D4D426aF204','1345654065','0','1','0','');
INSERT INTO `needforbug_appeal` (`appeal_id`,`user_id`,`appeal_realname`,`appeal_address`,`appeal_idnumber`,`appeal_email`,`appeal_receiptnumber`,`create_dateline`,`update_dateline`,`appeal_status`,`appeal_progress`,`appeal_reason`) VALUES ('9','1','小牛哥','','','xiaoniuge@dianniu.net','55f5B55BA7E4522d5FD099c096552A50','1345654081','0','1','0','');
INSERT INTO `needforbug_appeal` (`appeal_id`,`user_id`,`appeal_realname`,`appeal_address`,`appeal_idnumber`,`appeal_email`,`appeal_receiptnumber`,`create_dateline`,`update_dateline`,`appeal_status`,`appeal_progress`,`appeal_reason`) VALUES ('10','1','小牛哥','','','xiaoniuge@dianniu.net','74b2A209432E1E916e60cb997DcabBeF','1345654098','0','1','0','');
INSERT INTO `needforbug_appeal` (`appeal_id`,`user_id`,`appeal_realname`,`appeal_address`,`appeal_idnumber`,`appeal_email`,`appeal_receiptnumber`,`create_dateline`,`update_dateline`,`appeal_status`,`appeal_progress`,`appeal_reason`) VALUES ('11','1','小牛哥','','','xiaoniuge@dianniu.net','615976E760c30050760Bd63A56903C2c','1345654136','0','1','0','');
INSERT INTO `needforbug_appeal` (`appeal_id`,`user_id`,`appeal_realname`,`appeal_address`,`appeal_idnumber`,`appeal_email`,`appeal_receiptnumber`,`create_dateline`,`update_dateline`,`appeal_status`,`appeal_progress`,`appeal_reason`) VALUES ('12','1','小牛哥','','','xiaoniuge@dianniu.net','56f3abf272dd77fE27365fcAE7EC65Ee','1345654217','0','1','0','');
INSERT INTO `needforbug_appeal` (`appeal_id`,`user_id`,`appeal_realname`,`appeal_address`,`appeal_idnumber`,`appeal_email`,`appeal_receiptnumber`,`create_dateline`,`update_dateline`,`appeal_status`,`appeal_progress`,`appeal_reason`) VALUES ('13','1','小牛哥','','','xiaoniuge@dianniu.net','54885CcDcFb3823FefeAaeaa967a51dE','1345654251','0','1','0','');
INSERT INTO `needforbug_appeal` (`appeal_id`,`user_id`,`appeal_realname`,`appeal_address`,`appeal_idnumber`,`appeal_email`,`appeal_receiptnumber`,`create_dateline`,`update_dateline`,`appeal_status`,`appeal_progress`,`appeal_reason`) VALUES ('14','1','小牛哥','','','xiaoniuge@dianniu.net','b888E04845597E4E954EE8a4AdF50997','1345654409','0','1','0','');
INSERT INTO `needforbug_appeal` (`appeal_id`,`user_id`,`appeal_realname`,`appeal_address`,`appeal_idnumber`,`appeal_email`,`appeal_receiptnumber`,`create_dateline`,`update_dateline`,`appeal_status`,`appeal_progress`,`appeal_reason`) VALUES ('15','1','小牛哥','','','xiaoniuge@dianniu.net','45B082bC48DcC808A6DF6b67fbDFca62','1345654412','0','1','0','');
INSERT INTO `needforbug_appeal` (`appeal_id`,`user_id`,`appeal_realname`,`appeal_address`,`appeal_idnumber`,`appeal_email`,`appeal_receiptnumber`,`create_dateline`,`update_dateline`,`appeal_status`,`appeal_progress`,`appeal_reason`) VALUES ('16','17','韦永明','','','kevin@dianniu.net','c59E75658f9fad6C6c90A9552EB261a6','1345687426','0','1','0','');
INSERT INTO `needforbug_appeal` (`appeal_id`,`user_id`,`appeal_realname`,`appeal_address`,`appeal_idnumber`,`appeal_email`,`appeal_receiptnumber`,`create_dateline`,`update_dateline`,`appeal_status`,`appeal_progress`,`appeal_reason`) VALUES ('17','17','韦永明','','','kevin@dianniu.net','E6Ed3971e673d43CC859Bb68B467BfF2','1345688437','0','1','0','');
INSERT INTO `needforbug_appeal` (`appeal_id`,`user_id`,`appeal_realname`,`appeal_address`,`appeal_idnumber`,`appeal_email`,`appeal_receiptnumber`,`create_dateline`,`update_dateline`,`appeal_status`,`appeal_progress`,`appeal_reason`) VALUES ('18','17','韦永明','','','kevin@dianniu.net','467a88eDf9fCC796C7dd32C412b93CB0','1345690274','0','1','0','');
INSERT INTO `needforbug_appeal` (`appeal_id`,`user_id`,`appeal_realname`,`appeal_address`,`appeal_idnumber`,`appeal_email`,`appeal_receiptnumber`,`create_dateline`,`update_dateline`,`appeal_status`,`appeal_progress`,`appeal_reason`) VALUES ('19','17','韦永明','','','kevin@dianniu.net','3e53E836c23bE6c6A48e20E3c17D05fb','1345690954','0','1','0','');
INSERT INTO `needforbug_appeal` (`appeal_id`,`user_id`,`appeal_realname`,`appeal_address`,`appeal_idnumber`,`appeal_email`,`appeal_receiptnumber`,`create_dateline`,`update_dateline`,`appeal_status`,`appeal_progress`,`appeal_reason`) VALUES ('20','17','韦永明','','','kevin@dianniu.net','D80C6F3225C8BDfe088108DdDC798444','1345691013','0','1','0','');
INSERT INTO `needforbug_appeal` (`appeal_id`,`user_id`,`appeal_realname`,`appeal_address`,`appeal_idnumber`,`appeal_email`,`appeal_receiptnumber`,`create_dateline`,`update_dateline`,`appeal_status`,`appeal_progress`,`appeal_reason`) VALUES ('21','17','韦永明','','','kevin@dianniu.net','Fc93df2341551d2BcfB07E5Bf0f3EE79','1345691140','0','1','0','');
INSERT INTO `needforbug_appeal` (`appeal_id`,`user_id`,`appeal_realname`,`appeal_address`,`appeal_idnumber`,`appeal_email`,`appeal_receiptnumber`,`create_dateline`,`update_dateline`,`appeal_status`,`appeal_progress`,`appeal_reason`) VALUES ('22','17','韦永明','','','kevin@dianniu.net','c3d3597848dEbEcFd0BB2EB2687821eA','1345691339','0','1','0','');
INSERT INTO `needforbug_appeal` (`appeal_id`,`user_id`,`appeal_realname`,`appeal_address`,`appeal_idnumber`,`appeal_email`,`appeal_receiptnumber`,`create_dateline`,`update_dateline`,`appeal_status`,`appeal_progress`,`appeal_reason`) VALUES ('23','17','韦永明','','','kevin@dianniu.net','c88CFf93Cb3Ef7e7cf72AEDF3872CEE6','1345692375','0','1','0','');
INSERT INTO `needforbug_appeal` (`appeal_id`,`user_id`,`appeal_realname`,`appeal_address`,`appeal_idnumber`,`appeal_email`,`appeal_receiptnumber`,`create_dateline`,`update_dateline`,`appeal_status`,`appeal_progress`,`appeal_reason`) VALUES ('24','17','韦永明','','','kevin@dianniu.net','B7b80DBb376334C98b51B5a4DD280DCe','1345692429','0','1','0','');
INSERT INTO `needforbug_appeal` (`appeal_id`,`user_id`,`appeal_realname`,`appeal_address`,`appeal_idnumber`,`appeal_email`,`appeal_receiptnumber`,`create_dateline`,`update_dateline`,`appeal_status`,`appeal_progress`,`appeal_reason`) VALUES ('25','17','韦永明','','','kevin@dianniu.net','83334515eBEdE8fbBbAf9C3a0B8Dd7c2','1345692455','0','1','0','');
INSERT INTO `needforbug_appeal` (`appeal_id`,`user_id`,`appeal_realname`,`appeal_address`,`appeal_idnumber`,`appeal_email`,`appeal_receiptnumber`,`create_dateline`,`update_dateline`,`appeal_status`,`appeal_progress`,`appeal_reason`) VALUES ('26','17','韦永明','','','kevin@dianniu.net','86F867618490f8Bd83c989a5cEaF81c1','1345692549','0','1','3','最近有媒体报道，受传统产业出口不振、房地产宏观调控等因素影响，以前在春节前后才出现的农民工“返乡潮”，目前在多地出现；而上一次“返乡潮”是在受国际金融危机影响的2008年。\r\n\r\n 今年出现农民工“返乡潮”了吗？8月上旬，人民日报“求证”栏目记者在劳务输出大省河南、四川进行了调查。');
INSERT INTO `needforbug_appeal` (`appeal_id`,`user_id`,`appeal_realname`,`appeal_address`,`appeal_idnumber`,`appeal_email`,`appeal_receiptnumber`,`create_dateline`,`update_dateline`,`appeal_status`,`appeal_progress`,`appeal_reason`) VALUES ('27','17','韦永明','','','kevin@dianniu.net','cA940dE98AdCa89194a8A03815d3626A','1345692963','0','1','0','');
INSERT INTO `needforbug_appeal` (`appeal_id`,`user_id`,`appeal_realname`,`appeal_address`,`appeal_idnumber`,`appeal_email`,`appeal_receiptnumber`,`create_dateline`,`update_dateline`,`appeal_status`,`appeal_progress`,`appeal_reason`) VALUES ('28','17','韦永明','','','kevin@dianniu.net','e44EC2108E01AE924CB3f0F06cC146B8','1345693038','0','1','0','');
DROP TABLE IF EXISTS `needforbug_badword`;
CREATE TABLE `needforbug_badword` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `needforbug_badword` (`badword_id`,`badword_admin`,`badword_find`,`badword_replacement`,`badword_findpattern`,`create_dateline`,`update_dateline`) VALUES ('1','admin','toobad','*rt','/toobad/is','0','0');
DROP TABLE IF EXISTS `needforbug_creditrule`;
CREATE TABLE `needforbug_creditrule` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `needforbug_creditrule` (`creditrule_id`,`creditrule_name`,`creditrule_action`,`creditrule_cycletype`,`creditrule_cycletime`,`creditrule_rewardnum`,`creditrule_extendcredit1`,`creditrule_extendcredit2`,`creditrule_extendcredit3`,`creditrule_extendcredit4`,`creditrule_extendcredit5`,`creditrule_extendcredit6`,`creditrule_extendcredit7`,`creditrule_extendcredit8`) VALUES ('1','发短消息','sendpm','1','0','0','0','0','0','0','0','0','0','0');
INSERT INTO `needforbug_creditrule` (`creditrule_id`,`creditrule_name`,`creditrule_action`,`creditrule_cycletype`,`creditrule_cycletime`,`creditrule_rewardnum`,`creditrule_extendcredit1`,`creditrule_extendcredit2`,`creditrule_extendcredit3`,`creditrule_extendcredit4`,`creditrule_extendcredit5`,`creditrule_extendcredit6`,`creditrule_extendcredit7`,`creditrule_extendcredit8`) VALUES ('2','访问推广','promotion_visit','1','0','0','0','1','0','0','0','0','0','0');
INSERT INTO `needforbug_creditrule` (`creditrule_id`,`creditrule_name`,`creditrule_action`,`creditrule_cycletype`,`creditrule_cycletime`,`creditrule_rewardnum`,`creditrule_extendcredit1`,`creditrule_extendcredit2`,`creditrule_extendcredit3`,`creditrule_extendcredit4`,`creditrule_extendcredit5`,`creditrule_extendcredit6`,`creditrule_extendcredit7`,`creditrule_extendcredit8`) VALUES ('3','注册推广','promotion_register','0','0','0','0','2','0','0','0','0','0','0');
INSERT INTO `needforbug_creditrule` (`creditrule_id`,`creditrule_name`,`creditrule_action`,`creditrule_cycletype`,`creditrule_cycletime`,`creditrule_rewardnum`,`creditrule_extendcredit1`,`creditrule_extendcredit2`,`creditrule_extendcredit3`,`creditrule_extendcredit4`,`creditrule_extendcredit5`,`creditrule_extendcredit6`,`creditrule_extendcredit7`,`creditrule_extendcredit8`) VALUES ('4','设置头像','setavatar','0','0','1','0','5','0','0','0','0','0','0');
INSERT INTO `needforbug_creditrule` (`creditrule_id`,`creditrule_name`,`creditrule_action`,`creditrule_cycletype`,`creditrule_cycletime`,`creditrule_rewardnum`,`creditrule_extendcredit1`,`creditrule_extendcredit2`,`creditrule_extendcredit3`,`creditrule_extendcredit4`,`creditrule_extendcredit5`,`creditrule_extendcredit6`,`creditrule_extendcredit7`,`creditrule_extendcredit8`) VALUES ('5','每天登录','daylogin','1','0','1','0','2','0','0','0','0','0','0');
DROP TABLE IF EXISTS `needforbug_creditrulelog`;
CREATE TABLE `needforbug_creditrulelog` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `needforbug_creditrulelog` (`creditrulelog_id`,`user_id`,`creditrule_id`,`creditrulelog_total`,`creditrulelog_cyclenum`,`creditrulelog_extendcredit1`,`creditrulelog_extendcredit2`,`creditrulelog_extendcredit3`,`creditrulelog_extendcredit4`,`creditrulelog_extendcredit5`,`creditrulelog_extendcredit6`,`creditrulelog_extendcredit7`,`creditrulelog_extendcredit8`,`creditrulelog_starttime`,`update_dateline`) VALUES ('38','6','5','4','1','0','2','0','0','0','0','0','0','0','1345511931');
INSERT INTO `needforbug_creditrulelog` (`creditrulelog_id`,`user_id`,`creditrule_id`,`creditrulelog_total`,`creditrulelog_cyclenum`,`creditrulelog_extendcredit1`,`creditrulelog_extendcredit2`,`creditrulelog_extendcredit3`,`creditrulelog_extendcredit4`,`creditrulelog_extendcredit5`,`creditrulelog_extendcredit6`,`creditrulelog_extendcredit7`,`creditrulelog_extendcredit8`,`creditrulelog_starttime`,`update_dateline`) VALUES ('37','1','5','230','1','0','2','0','0','0','0','0','0','0','1345710814');
INSERT INTO `needforbug_creditrulelog` (`creditrulelog_id`,`user_id`,`creditrule_id`,`creditrulelog_total`,`creditrulelog_cyclenum`,`creditrulelog_extendcredit1`,`creditrulelog_extendcredit2`,`creditrulelog_extendcredit3`,`creditrulelog_extendcredit4`,`creditrulelog_extendcredit5`,`creditrulelog_extendcredit6`,`creditrulelog_extendcredit7`,`creditrulelog_extendcredit8`,`creditrulelog_starttime`,`update_dateline`) VALUES ('39','17','5','1','1','0','2','0','0','0','0','0','0','0','1345623288');
DROP TABLE IF EXISTS `needforbug_district`;
CREATE TABLE `needforbug_district` (
  `district_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '地区ID',
  `district_name` varchar(255) NOT NULL DEFAULT '' COMMENT '地区名字',
  `district_level` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '地区级别，省份/城市/州县/乡镇',
  `district_upid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '上级地址ID值',
  `district_sort` smallint(6) NOT NULL DEFAULT '0' COMMENT '地区排序',
  PRIMARY KEY (`district_id`),
  KEY `district_upid` (`district_upid`),
  KEY `district_sort` (`district_sort`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('1','北京市','1','0','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('2','天津市','1','0','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('3','河北省','1','0','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('4','山西省','1','0','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('5','内蒙古自治区','1','0','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('6','辽宁省','1','0','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('7','吉林省','1','0','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('8','黑龙江省','1','0','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('9','上海市','1','0','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('10','江苏省','1','0','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('11','浙江省','1','0','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('12','安徽省','1','0','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('13','福建省','1','0','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('14','江西省','1','0','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('15','山东省','1','0','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('16','河南省','1','0','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('17','湖北省','1','0','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('18','湖南省','1','0','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('19','广东省','1','0','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('20','广西壮族自治区','1','0','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('21','海南省','1','0','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('22','重庆市','1','0','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('23','四川省','1','0','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('24','贵州省','1','0','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('25','云南省','1','0','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('26','西藏自治区','1','0','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('27','陕西省','1','0','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('28','甘肃省','1','0','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('29','青海省','1','0','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('30','宁夏回族自治区','1','0','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('31','新疆维吾尔自治区','1','0','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('32','台湾省','1','0','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('33','香港特别行政区','1','0','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('34','澳门特别行政区','1','0','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('35','海外','1','0','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('36','其他','1','0','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('37','东城区','2','1','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('38','西城区','2','1','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('39','崇文区','2','1','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('40','宣武区','2','1','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('41','朝阳区','2','1','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('42','丰台区','2','1','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('43','石景山区','2','1','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('44','海淀区','2','1','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('45','门头沟区','2','1','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('46','房山区','2','1','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('47','通州区','2','1','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('48','顺义区','2','1','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('49','昌平区','2','1','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('50','大兴区','2','1','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('51','怀柔区','2','1','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('52','平谷区','2','1','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('53','密云县','2','1','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('54','延庆县','2','1','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('55','和平区','2','2','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('56','河东区','2','2','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('57','河西区','2','2','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('58','南开区','2','2','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('59','河北区','2','2','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('60','红桥区','2','2','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('61','塘沽区','2','2','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('62','汉沽区','2','2','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('63','大港区','2','2','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('64','东丽区','2','2','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('65','西青区','2','2','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('66','津南区','2','2','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('67','北辰区','2','2','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('68','武清区','2','2','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('69','宝坻区','2','2','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('70','宁河县','2','2','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('71','静海县','2','2','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('72','蓟县','2','2','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('73','石家庄市','2','3','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('74','唐山市','2','3','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('75','秦皇岛市','2','3','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('76','邯郸市','2','3','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('77','邢台市','2','3','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('78','保定市','2','3','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('79','张家口市','2','3','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('80','承德市','2','3','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('81','衡水市','2','3','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('82','廊坊市','2','3','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('83','沧州市','2','3','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('84','太原市','2','4','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('85','大同市','2','4','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('86','阳泉市','2','4','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('87','长治市','2','4','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('88','晋城市','2','4','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('89','朔州市','2','4','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('90','晋中市','2','4','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('91','运城市','2','4','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('92','忻州市','2','4','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('93','临汾市','2','4','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('94','吕梁市','2','4','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('95','呼和浩特市','2','5','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('96','包头市','2','5','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('97','乌海市','2','5','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('98','赤峰市','2','5','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('99','通辽市','2','5','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('100','鄂尔多斯市','2','5','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('101','呼伦贝尔市','2','5','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('102','巴彦淖尔市','2','5','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('103','乌兰察布市','2','5','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('104','兴安盟','2','5','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('105','锡林郭勒盟','2','5','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('106','阿拉善盟','2','5','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('107','沈阳市','2','6','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('108','大连市','2','6','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('109','鞍山市','2','6','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('110','抚顺市','2','6','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('111','本溪市','2','6','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('112','丹东市','2','6','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('113','锦州市','2','6','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('114','营口市','2','6','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('115','阜新市','2','6','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('116','辽阳市','2','6','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('117','盘锦市','2','6','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('118','铁岭市','2','6','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('119','朝阳市','2','6','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('120','葫芦岛市','2','6','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('121','长春市','2','7','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('122','吉林市','2','7','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('123','四平市','2','7','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('124','辽源市','2','7','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('125','通化市','2','7','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('126','白山市','2','7','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('127','松原市','2','7','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('128','白城市','2','7','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('129','延边朝鲜族自治州','2','7','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('130','哈尔滨市','2','8','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('131','齐齐哈尔市','2','8','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('132','鸡西市','2','8','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('133','鹤岗市','2','8','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('134','双鸭山市','2','8','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('135','大庆市','2','8','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('136','伊春市','2','8','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('137','佳木斯市','2','8','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('138','七台河市','2','8','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('139','牡丹江市','2','8','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('140','黑河市','2','8','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('141','绥化市','2','8','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('142','大兴安岭地区','2','8','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('143','黄浦区','2','9','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('144','卢湾区','2','9','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('145','徐汇区','2','9','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('146','长宁区','2','9','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('147','静安区','2','9','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('148','普陀区','2','9','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('149','闸北区','2','9','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('150','虹口区','2','9','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('151','杨浦区','2','9','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('152','闵行区','2','9','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('153','宝山区','2','9','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('154','嘉定区','2','9','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('155','浦东新区','2','9','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('156','金山区','2','9','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('157','松江区','2','9','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('158','青浦区','2','9','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('159','南汇区','2','9','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('160','奉贤区','2','9','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('161','崇明县','2','9','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('162','南京市','2','10','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('163','无锡市','2','10','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('164','徐州市','2','10','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('165','常州市','2','10','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('166','苏州市','2','10','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('167','南通市','2','10','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('168','连云港市','2','10','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('169','淮安市','2','10','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('170','盐城市','2','10','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('171','扬州市','2','10','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('172','镇江市','2','10','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('173','泰州市','2','10','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('174','宿迁市','2','10','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('175','杭州市','2','11','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('176','宁波市','2','11','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('177','温州市','2','11','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('178','嘉兴市','2','11','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('179','湖州市','2','11','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('180','绍兴市','2','11','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('181','舟山市','2','11','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('182','衢州市','2','11','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('183','金华市','2','11','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('184','台州市','2','11','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('185','丽水市','2','11','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('186','合肥市','2','12','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('187','芜湖市','2','12','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('188','蚌埠市','2','12','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('189','淮南市','2','12','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('190','马鞍山市','2','12','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('191','淮北市','2','12','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('192','铜陵市','2','12','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('193','安庆市','2','12','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('194','黄山市','2','12','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('195','滁州市','2','12','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('196','阜阳市','2','12','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('197','宿州市','2','12','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('198','巢湖市','2','12','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('199','六安市','2','12','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('200','亳州市','2','12','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('201','池州市','2','12','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('202','宣城市','2','12','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('203','福州市','2','13','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('204','厦门市','2','13','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('205','莆田市','2','13','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('206','三明市','2','13','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('207','泉州市','2','13','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('208','漳州市','2','13','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('209','南平市','2','13','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('210','龙岩市','2','13','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('211','宁德市','2','13','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('212','南昌市','2','14','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('213','景德镇市','2','14','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('214','萍乡市','2','14','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('215','九江市','2','14','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('216','新余市','2','14','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('217','鹰潭市','2','14','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('218','赣州市','2','14','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('219','吉安市','2','14','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('220','宜春市','2','14','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('221','抚州市','2','14','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('222','上饶市','2','14','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('223','济南市','2','15','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('224','青岛市','2','15','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('225','淄博市','2','15','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('226','枣庄市','2','15','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('227','东营市','2','15','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('228','烟台市','2','15','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('229','潍坊市','2','15','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('230','济宁市','2','15','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('231','泰安市','2','15','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('232','威海市','2','15','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('233','日照市','2','15','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('234','莱芜市','2','15','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('235','临沂市','2','15','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('236','德州市','2','15','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('237','聊城市','2','15','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('238','滨州市','2','15','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('239','菏泽市','2','15','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('240','郑州市','2','16','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('241','开封市','2','16','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('242','洛阳市','2','16','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('243','平顶山市','2','16','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('244','安阳市','2','16','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('245','鹤壁市','2','16','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('246','新乡市','2','16','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('247','焦作市','2','16','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('248','濮阳市','2','16','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('249','许昌市','2','16','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('250','漯河市','2','16','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('251','三门峡市','2','16','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('252','南阳市','2','16','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('253','商丘市','2','16','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('254','信阳市','2','16','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('255','周口市','2','16','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('256','驻马店市','2','16','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('257','济源市','2','16','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('258','武汉市','2','17','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('259','黄石市','2','17','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('260','十堰市','2','17','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('261','宜昌市','2','17','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('262','襄樊市','2','17','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('263','鄂州市','2','17','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('264','荆门市','2','17','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('265','孝感市','2','17','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('266','荆州市','2','17','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('267','黄冈市','2','17','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('268','咸宁市','2','17','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('269','随州市','2','17','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('270','恩施土家族苗族自治州','2','17','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('271','仙桃市','2','17','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('272','潜江市','2','17','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('273','天门市','2','17','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('274','神农架林区','2','17','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('275','长沙市','2','18','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('276','株洲市','2','18','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('277','湘潭市','2','18','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('278','衡阳市','2','18','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('279','邵阳市','2','18','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('280','岳阳市','2','18','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('281','常德市','2','18','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('282','张家界市','2','18','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('283','益阳市','2','18','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('284','郴州市','2','18','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('285','永州市','2','18','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('286','怀化市','2','18','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('287','娄底市','2','18','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('288','湘西土家族苗族自治州','2','18','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('289','广州市','2','19','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('290','韶关市','2','19','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('291','深圳市','2','19','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('292','珠海市','2','19','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('293','汕头市','2','19','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('294','佛山市','2','19','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('295','江门市','2','19','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('296','湛江市','2','19','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('297','茂名市','2','19','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('298','肇庆市','2','19','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('299','惠州市','2','19','0');
INSERT INTO `needforbug_district` (`district_id`,`district_name`,`district_level`,`district_upid`,`district_sort`) VALUES ('300','梅州市','2','19','0');
DROP TABLE IF EXISTS `needforbug_friend`;
CREATE TABLE `needforbug_friend` (
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
INSERT INTO `needforbug_friend` (`user_id`,`friend_friendid`,`friend_direction`,`friend_status`,`friend_comment`,`friend_fancomment`,`create_dateline`,`friend_username`,`friend_friendusername`) VALUES ('6','7','1','1','','','1345511948','xiaomage','test');
INSERT INTO `needforbug_friend` (`user_id`,`friend_friendid`,`friend_direction`,`friend_status`,`friend_comment`,`friend_fancomment`,`create_dateline`,`friend_username`,`friend_friendusername`) VALUES ('6','1','1','0','','','1345511945','xiaomage','admin');
INSERT INTO `needforbug_friend` (`user_id`,`friend_friendid`,`friend_direction`,`friend_status`,`friend_comment`,`friend_fancomment`,`create_dateline`,`friend_username`,`friend_friendusername`) VALUES ('1','13','1','1','','','1345511770','admin','sdfsdfsdfsdfs');
INSERT INTO `needforbug_friend` (`user_id`,`friend_friendid`,`friend_direction`,`friend_status`,`friend_comment`,`friend_fancomment`,`create_dateline`,`friend_username`,`friend_friendusername`) VALUES ('1','16','1','1','','','1345511759','admin','woshihapi');
INSERT INTO `needforbug_friend` (`user_id`,`friend_friendid`,`friend_direction`,`friend_status`,`friend_comment`,`friend_fancomment`,`create_dateline`,`friend_username`,`friend_friendusername`) VALUES ('1','15','1','1','','','1345511757','admin','my');
INSERT INTO `needforbug_friend` (`user_id`,`friend_friendid`,`friend_direction`,`friend_status`,`friend_comment`,`friend_fancomment`,`create_dateline`,`friend_username`,`friend_friendusername`) VALUES ('1','18','1','1','','','1345511755','admin','weiyong2000');
INSERT INTO `needforbug_friend` (`user_id`,`friend_friendid`,`friend_direction`,`friend_status`,`friend_comment`,`friend_fancomment`,`create_dateline`,`friend_username`,`friend_friendusername`) VALUES ('1','17','1','1','','','1345511754','admin','weiyong1999');
INSERT INTO `needforbug_friend` (`user_id`,`friend_friendid`,`friend_direction`,`friend_status`,`friend_comment`,`friend_fancomment`,`create_dateline`,`friend_username`,`friend_friendusername`) VALUES ('1','20','1','1','','','1345511752','admin','xiaoxiaoxiao2');
INSERT INTO `needforbug_friend` (`user_id`,`friend_friendid`,`friend_direction`,`friend_status`,`friend_comment`,`friend_fancomment`,`create_dateline`,`friend_username`,`friend_friendusername`) VALUES ('1','19','1','1','','','1345511750','admin','xiaoxiaoxiao');
INSERT INTO `needforbug_friend` (`user_id`,`friend_friendid`,`friend_direction`,`friend_status`,`friend_comment`,`friend_fancomment`,`create_dateline`,`friend_username`,`friend_friendusername`) VALUES ('1','21','1','1','','','1345511749','admin','sdfffffff');
INSERT INTO `needforbug_friend` (`user_id`,`friend_friendid`,`friend_direction`,`friend_status`,`friend_comment`,`friend_fancomment`,`create_dateline`,`friend_username`,`friend_friendusername`) VALUES ('1','22','1','1','','','1345511747','admin','sfdddddddddddd');
INSERT INTO `needforbug_friend` (`user_id`,`friend_friendid`,`friend_direction`,`friend_status`,`friend_comment`,`friend_fancomment`,`create_dateline`,`friend_username`,`friend_friendusername`) VALUES ('1','23','1','1','','','1345511746','admin','dsfsfsfsdf');
INSERT INTO `needforbug_friend` (`user_id`,`friend_friendid`,`friend_direction`,`friend_status`,`friend_comment`,`friend_fancomment`,`create_dateline`,`friend_username`,`friend_friendusername`) VALUES ('1','6','1','0','','','1345511653','admin','xiaomage');
DROP TABLE IF EXISTS `needforbug_group`;
CREATE TABLE `needforbug_group` (
  `group_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '小组ID',
  `user_id` int(10) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `group_name` char(32) NOT NULL DEFAULT '' COMMENT '群组名字',
  `group_nikename` char(32) NOT NULL DEFAULT '' COMMENT '小组英文名称',
  `group_sort` smallint(6) NOT NULL DEFAULT '0' COMMENT '群组排序',
  `group_description` text NOT NULL COMMENT '小组介绍',
  `group_path` char(32) NOT NULL DEFAULT '' COMMENT '图标路径',
  `group_icon` char(32) DEFAULT NULL COMMENT '小组图标',
  `group_topicnum` int(10) NOT NULL DEFAULT '0' COMMENT '帖子统计',
  `group_topictodaynum` int(10) NOT NULL DEFAULT '0' COMMENT '统计今天发帖',
  `group_usernum` int(10) NOT NULL DEFAULT '0' COMMENT '小组成员数',
  `group_joinway` tinyint(1) NOT NULL DEFAULT '0' COMMENT '加入方式',
  `group_roleleader` char(32) NOT NULL DEFAULT '组长' COMMENT '组长角色名称',
  `group_roleadmin` char(32) NOT NULL DEFAULT '管理员' COMMENT '管理员角色名称',
  `group_roleuser` char(32) NOT NULL DEFAULT '成员' COMMENT '成员角色名称',
  `create_dateline` int(10) DEFAULT '0' COMMENT '创建时间',
  `group_isrecommend` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否推荐',
  `group_isopen` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否公开或者私密',
  `group_isaudit` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否审核',
  `group_ispost` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否允许会员发帖',
  `group_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否显示,状态',
  `update_dateline` int(10) NOT NULL DEFAULT '0' COMMENT '最后更新时间',
  PRIMARY KEY (`group_id`),
  KEY `user_id` (`user_id`),
  KEY `group_name` (`group_name`),
  KEY `group_sort` (`group_sort`),
  KEY `group_status` (`group_status`),
  KEY `create_dateline` (`create_dateline`),
  KEY `update_dateline` (`update_dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `needforbug_group` (`group_id`,`user_id`,`group_name`,`group_nikename`,`group_sort`,`group_description`,`group_path`,`group_icon`,`group_topicnum`,`group_topictodaynum`,`group_usernum`,`group_joinway`,`group_roleleader`,`group_roleadmin`,`group_roleuser`,`create_dateline`,`group_isrecommend`,`group_isopen`,`group_isaudit`,`group_ispost`,`group_status`,`update_dateline`) VALUES ('5','1','hello3','我是小组','8','&lt;span style=&quot;background-color:#00D5FF;&quot;&gt;&lt;/span&gt;&lt;span style=&quot;background-color:#00D5FF;&quot;&gt;哈哈，你好哈212&lt;/span&gt;dssssssssssss&lt;br /&gt;','','','0','0','3','0','组长','管理员','成员','1334585898','1','0','0','0','0','1342750884');
INSERT INTO `needforbug_group` (`group_id`,`user_id`,`group_name`,`group_nikename`,`group_sort`,`group_description`,`group_path`,`group_icon`,`group_topicnum`,`group_topictodaynum`,`group_usernum`,`group_joinway`,`group_roleleader`,`group_roleadmin`,`group_roleuser`,`create_dateline`,`group_isrecommend`,`group_isopen`,`group_isaudit`,`group_ispost`,`group_status`,`update_dateline`) VALUES ('4','1','hello','小组','0','&lt;span style=&quot;background-color:#009900;&quot;&gt;&lt;span style=&quot;background-color:#E56600;&quot;&gt;&lt;/span&gt;群组阶级色SSSSSSSSSSSSSSSSSSSSS&lt;/span&gt;&lt;br /&gt;','',NULL,'0','0','0','0','组长','管理员','成员','1334585399','1','0','0','0','0','1335718167');
DROP TABLE IF EXISTS `needforbug_groupcategory`;
CREATE TABLE `needforbug_groupcategory` (
  `groupcategory_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '群组分类ID',
  `groupcategory_name` char(32) NOT NULL DEFAULT '' COMMENT '群组分类名字',
  `groupcategory_parentid` int(10) NOT NULL DEFAULT '0' COMMENT '群组上级分类ID',
  `groupcategory_count` int(10) NOT NULL DEFAULT '0' COMMENT '群组个数',
  `groupcategory_sort` smallint(6) NOT NULL DEFAULT '0' COMMENT '群组分类排序名字',
  `update_dateline` int(10) NOT NULL DEFAULT '0' COMMENT '最后更新时间',
  `create_dateline` int(10) NOT NULL COMMENT '群组创建时间',
  PRIMARY KEY (`groupcategory_id`),
  KEY `create_dateline` (`create_dateline`),
  KEY `groupcategory_parentid` (`groupcategory_parentid`),
  KEY `groupcategory_sort` (`groupcategory_sort`),
  KEY `update_dateline` (`update_dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `needforbug_groupcategory` (`groupcategory_id`,`groupcategory_name`,`groupcategory_parentid`,`groupcategory_count`,`groupcategory_sort`,`update_dateline`,`create_dateline`) VALUES ('9','特色同时a','0','2','0','1339251874','1338212014');
INSERT INTO `needforbug_groupcategory` (`groupcategory_id`,`groupcategory_name`,`groupcategory_parentid`,`groupcategory_count`,`groupcategory_sort`,`update_dateline`,`create_dateline`) VALUES ('10','我的日志','9','0','3','1344684344','1338212067');
DROP TABLE IF EXISTS `needforbug_groupcategoryindex`;
CREATE TABLE `needforbug_groupcategoryindex` (
  `group_id` int(10) NOT NULL COMMENT '群组ID',
  `groupcategory_id` int(10) NOT NULL COMMENT '群组分类ID',
  PRIMARY KEY (`group_id`,`groupcategory_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `needforbug_groupcategoryindex` (`group_id`,`groupcategory_id`) VALUES ('5','8');
INSERT INTO `needforbug_groupcategoryindex` (`group_id`,`groupcategory_id`) VALUES ('5','9');
INSERT INTO `needforbug_groupcategoryindex` (`group_id`,`groupcategory_id`) VALUES ('9','7');
INSERT INTO `needforbug_groupcategoryindex` (`group_id`,`groupcategory_id`) VALUES ('9','8');
INSERT INTO `needforbug_groupcategoryindex` (`group_id`,`groupcategory_id`) VALUES ('11','9');
DROP TABLE IF EXISTS `needforbug_groupoption`;
CREATE TABLE `needforbug_groupoption` (
  `groupoption_name` varchar(32) NOT NULL DEFAULT '' COMMENT '名字',
  `groupoption_value` text NOT NULL COMMENT '值',
  PRIMARY KEY (`groupoption_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `needforbug_groupoption` (`groupoption_name`,`groupoption_value`) VALUES ('group_isaudit','0');
INSERT INTO `needforbug_groupoption` (`groupoption_name`,`groupoption_value`) VALUES ('group_icon_uploadfile_maxsize','204800');
DROP TABLE IF EXISTS `needforbug_grouptopiccategory`;
CREATE TABLE `needforbug_grouptopiccategory` (
  `grouptopiccategory_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '帖子分类ID',
  `group_id` int(10) NOT NULL DEFAULT '0' COMMENT '小组ID',
  `grouptopiccategory_name` char(32) NOT NULL DEFAULT '' COMMENT '帖子分类名称',
  `grouptopiccategory_topicnum` int(10) NOT NULL DEFAULT '0' COMMENT '统计帖子',
  `grouptopiccategory_sort` smallint(6) NOT NULL COMMENT '帖子分类排序',
  PRIMARY KEY (`grouptopiccategory_id`),
  KEY `group_id` (`group_id`),
  KEY `grouptopiccategory_sort` (`grouptopiccategory_sort`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `needforbug_grouptopiccategory` (`grouptopiccategory_id`,`group_id`,`grouptopiccategory_name`,`grouptopiccategory_topicnum`,`grouptopiccategory_sort`) VALUES ('11','5','测试一下哈22','0','0');
DROP TABLE IF EXISTS `needforbug_groupuser`;
CREATE TABLE `needforbug_groupuser` (
  `user_id` int(10) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `group_id` int(10) NOT NULL DEFAULT '0' COMMENT '群组ID',
  `groupuser_isadmin` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否管理员',
  `create_dateline` int(10) NOT NULL DEFAULT '0' COMMENT '加入时间',
  KEY `user_id` (`user_id`),
  KEY `create_dateline` (`create_dateline`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `needforbug_groupuser` (`user_id`,`group_id`,`groupuser_isadmin`,`create_dateline`) VALUES ('3','5','0','1334738916');
INSERT INTO `needforbug_groupuser` (`user_id`,`group_id`,`groupuser_isadmin`,`create_dateline`) VALUES ('2','5','0','1334738916');
INSERT INTO `needforbug_groupuser` (`user_id`,`group_id`,`groupuser_isadmin`,`create_dateline`) VALUES ('1','5','0','1334738916');
INSERT INTO `needforbug_groupuser` (`user_id`,`group_id`,`groupuser_isadmin`,`create_dateline`) VALUES ('5','9','0','1338183302');
INSERT INTO `needforbug_groupuser` (`user_id`,`group_id`,`groupuser_isadmin`,`create_dateline`) VALUES ('4','9','0','1338183302');
INSERT INTO `needforbug_groupuser` (`user_id`,`group_id`,`groupuser_isadmin`,`create_dateline`) VALUES ('3','9','0','1338183302');
INSERT INTO `needforbug_groupuser` (`user_id`,`group_id`,`groupuser_isadmin`,`create_dateline`) VALUES ('2','9','0','1338183302');
INSERT INTO `needforbug_groupuser` (`user_id`,`group_id`,`groupuser_isadmin`,`create_dateline`) VALUES ('1','9','0','1338183302');
DROP TABLE IF EXISTS `needforbug_homefresh`;
CREATE TABLE `needforbug_homefresh` (
  `homefresh_id` mediumint(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '新鲜事ID',
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '用户',
  `homefresh_username` varchar(15) NOT NULL DEFAULT '' COMMENT '用户名',
  `homefresh_from` varchar(20) NOT NULL DEFAULT '' COMMENT '来源',
  `create_dateline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `homefresh_message` text NOT NULL COMMENT '新鲜事内容',
  `homefresh_ip` varchar(20) NOT NULL DEFAULT '' COMMENT 'IP',
  `homefresh_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评论数量',
  `homefresh_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '新鲜事状态',
  PRIMARY KEY (`homefresh_id`),
  KEY `create_dateline` (`create_dateline`),
  KEY `homefresh_status` (`homefresh_status`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('1','1','','','1341132710','<span style=\"font-family:normal;font-size:14px;line-height:20px;text-indent:28px;white-space:normal;\">香港第四任特别行政区长官梁振英在就职大会上发言：香港社会整体富裕，所有市民都应享有基本的生活保障，也应享有经济发展的得益。香港将尽快设立“扶贫委员会”，全面检视、研究和系统地处理老年、在职、跨代、新移民、少数族裔和区域性贫穷等问题；同时也会积极推动公私营医疗的双轨发展，让香港人不论贫富，都病有所医。七百万香港人是一家，他会将香港建设成宜居的城市，推动市民节能减排，加强绿色和保育意识，同时保护香港的自然美景。在非物质生活方面，政府将一如以往尊重宗教自由，进一步提升文化素质，鼓励创意。梁振英同时表示承诺继续维护公义，保障市民权益；维护法治、廉洁、自由、民主等香港核心价值，包容各种立场和意见；</span>','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('2','1','','','1341133099','<span style=\"font-family:normal;font-size:14px;line-height:20px;text-indent:28px;white-space:normal;\">中国保监会副主席陈文辉30日在上海表示，在整个养老保障体系建<span style=\"background-color:#E53333;\">设过程之中，应通过运用市场机制来提高整个基本养老保险的运行效率。</span></span>','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('3','1','','','1341133120','谢谢哈，你很好，我很爱你哈','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('4','1','','','1341196065','我是一只猪，哈哈','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('5','1','','','1341196079','谢谢你','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('6','1','','','1341196159','是否顶顶顶顶顶顶顶顶','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('7','1','','','1341196163','说得反反复复方法','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('8','1','','','1341196192','的说法','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('9','1','','','1341196195','是地方','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('10','1','','','1341196351','是地方的说法','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('11','1','','','1341196394','的方式使得反反复复','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('12','1','','','1341196505','的方式是','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('13','1','','','1341196533','否多算胜少算水水水水水水水','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('14','1','','','1341197091','<img src=\"http://www.baidu.com/img/baidu_jgylogo3.gif\" alt=\"\" />热门的生活很好哈','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('15','1','','','1341197116','欢迎大家光临祖国<span style=\"background-color:#FF9900;\">的锅底哈。。谢谢。</span>','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('16','1','','','1341197725','<strong><em><u>说得反反复复方法反反复复发</u></em></strong>','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('17','1','','','1341202032','<span style=\"background-color:#E56600;\"><strong>&nbsp;ffffffffffffffffff</strong></span><span style=\"background-color:#E56600;\"><strong>f</strong></span><span style=\"background-color:#E56600;\"><strong>f &nbsp; sdfffffffffffffffffffff</strong></span>','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('18','1','','','1341202063','<p style=\"font-family:Simsun, Verdana, sans-serif;font-size:14px;line-height:23px;text-align:left;white-space:normal;\">\n	6月30日21时，广州市政府召开新闻发布会通报，7月1日零时起，对全市中小客车试行总量适度调控管理，一个月内广州全市暂停办理中小客车的注册及转移登记。\n</p>\n<p style=\"font-family:Simsun, Verdana, sans-serif;font-size:14px;line-height:23px;text-align:left;white-space:normal;\">\n	突如其来的“限牌令”，引发当地汽车市场震动，也引起市民强烈关注。\n</p>\n<p style=\"font-family:Simsun, Verdana, sans-serif;font-size:14px;line-height:23px;text-align:left;white-space:normal;\">\n	6月30日晚，广州市政协副主席、交委主任冼伟雄在发布会上宣布，在为期一年的试行期内，全市中小客车增量配额为12万辆；为做好各项工作衔接，7月1日零时起的一个月内，广州全市暂停办理中小客车的注册及转移登记，后续各个月度平均分配增量配额；配置指标的具体办法和相关程序将于7月底前发布。\n</p>\n<p style=\"font-family:Simsun, Verdana, sans-serif;font-size:14px;line-height:23px;text-align:left;white-space:normal;\">\n	<strong>“限牌令”当晚，车行交款柜台前排起长队</strong>\n</p>\n<p style=\"font-family:Simsun, Verdana, sans-serif;font-size:14px;line-height:23px;text-align:left;white-space:normal;\">\n	“我们晚上9点才知道这个消息，之前一点苗头也没有。”广东广悦汽车贸易有限公司市场经理吴思科说。\n</p>\n<p style=\"font-family:Simsun, Verdana, sans-serif;font-size:14px;line-height:23px;text-align:left;white-space:normal;\">\n	6月30日16时，广州市500多家汽车经销商受邀参加公安交警支队、工商局、经贸局三方联合召开的会议，会上通告了限牌政策。傍晚时分开始，众多汽车经销商陆续接到厂家通知，开始采取电话、短信方式通知提醒订单车主与意向顾客；广汽丰田等广州本地知名汽车制造商及销售商等连夜召开紧急会议，商讨下半年在广州市场的销售政策。\n</p>\n<p style=\"font-family:Simsun, Verdana, sans-serif;font-size:14px;line-height:23px;text-align:left;white-space:normal;\">\n	突如其来的“限牌令”引起市场轩然大波。当晚，记者来到位于黄埔大道的丰田4S店，平时晚上黑灯瞎火的销售大厅灯火通明。在广州赛马场汽车城，几乎所有的车行都取消了先前的优惠、折扣和促销活动，工作人员争分夺秒通知之前有买车意向的消费者赶快来交钱，刷卡柜台前排起长队。有些店铺更是简化手续，挑车后先刷卡开发票再完善购车合同……但这一切只持续到晚上12时——12时以后开具的发票一律无效。\n</p>\n<p style=\"font-family:Simsun, Verdana, sans-serif;font-size:14px;line-height:23px;text-align:left;white-space:normal;\">\n	<strong>市民直呼太突然，“限牌令”为何搞突袭？</strong>\n</p>\n<p style=\"font-family:Simsun, Verdana, sans-serif;font-size:14px;line-height:23px;text-align:left;white-space:normal;\">\n	对于出台“限牌令”的原因，在新闻发布会上，冼伟雄表示，广州目前中小客车保有量和出行量持续快速增长，城市交通拥堵日趋明显，机动车排放对大气环境质量的影响日趋增大，为此广州需要实施中小客车总量调控政策。\n</p>\n<p style=\"font-family:Simsun, Verdana, sans-serif;font-size:14px;line-height:23px;text-align:left;white-space:normal;\">\n	“限牌”并非广州独创。近年来，汽车进入家庭呈加速度增长，导致各大城市不堪重负。以车牌拍卖为治堵手段的上海，一块“沪”字头小铁皮就相当于一辆微型轿车的价钱；北京的摇号政策也导致车牌奇货可居。在广州市交通主管部门看来，出台“限牌令”似乎有足够的理由。\n</p>','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('19','1','','','1341202110','sdffffffffffffffffffffffffffff','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('20','1','','','1341202112','dfsssss','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('21','1','','','1341202114','dfssssssssss','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('22','1','','','1341202162','<em><u><span style=\"color:#99BB00;\"><strong>fwhifeeifghighihg</strong></span></u></em><span style=\"background-color:#FF9900;\"><em><u><span style=\"color:#99BB00;\"><strong></strong></span></u></em><em><u><span style=\"color:#99BB00;\"><strong><a href=\"http://baidu.com\">http://baidu.com</a></strong></span></u></em></span>','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('23','15','','','1341471675','dfssssssssssssss','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('24','15','','','1341471678','sdffffffffffffffffff','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('25','15','','','1341471737','<strong><span style=\"color:#FF9900;\">他是一个好人啦，我哈哈</span></strong>','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('26','15','','','1341471756','是非颠倒点点滴滴','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('27','15','','','1341471759','浮点数收拾收拾收拾收拾','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('28','15','','','1341471761','打扫反反复复反反复复方法','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('29','15','','','1341471763','说得反反复复方法发','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('30','15','','','1341471765','达省份反反复复方法','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('31','15','','','1341471767','都是反反复复方法','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('32','15','','','1341471769','是地方','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('33','16','','','1342237208','sdfsdf','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('34','16','','','1342237216','你是一个happ','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('35','6','','','1342237837','dfg','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('36','6','','','1342237843','dgf','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('37','6','','','1342237899','gfddfgfg','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('38','6','','','1342237903','gfd','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('39','6','','','1342237908','fd','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('40','6','','','1342237916','zni hso&nbsp;','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('41','1','','','1343005157','你好特哦那个徐','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('42','1','','','1343005165','粉丝顶顶顶顶顶顶顶顶顶','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('43','1','','','1343360086','sdfsf','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('44','1','','','1343700704','dsfdsf','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('45','1','','','1343700708','dfssssssssssssssssssssssssssssss','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('46','1','','','1343700716','sdffffffffffffffff','','0','1');
INSERT INTO `needforbug_homefresh` (`homefresh_id`,`user_id`,`homefresh_username`,`homefresh_from`,`create_dateline`,`homefresh_message`,`homefresh_ip`,`homefresh_count`,`homefresh_status`) VALUES ('47','1','','','1345173322','&nbsp;tyyyyyyyyyyy','','0','1');
DROP TABLE IF EXISTS `needforbug_homehelp`;
CREATE TABLE `needforbug_homehelp` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `needforbug_homehelp` (`homehelp_id`,`homehelp_title`,`homehelp_content`,`homehelpcategory_id`,`homehelp_status`,`create_dateline`,`update_dateline`,`user_id`,`homehelp_username`,`homehelp_updateuserid`,`homehelp_updateusername`,`homehelp_viewnum`) VALUES ('1','欢迎来到我们的帮助宝库！','{site_name} 欢迎你的到来，希望这里能够帮助到你！','1','1','1340045081','1340213370','1','admin','1','admin','0');
INSERT INTO `needforbug_homehelp` (`homehelp_id`,`homehelp_title`,`homehelp_content`,`homehelpcategory_id`,`homehelp_status`,`create_dateline`,`update_dateline`,`user_id`,`homehelp_username`,`homehelp_updateuserid`,`homehelp_updateusername`,`homehelp_viewnum`) VALUES ('2','我必须要注册吗？','<span style=\"color:#444444;font-family:Verdana, Helvetica, Arial, sans-serif;font-size:14px;line-height:19px;text-align:left;white-space:normal;background-color:#FFFFFF;\">这取决于管理员如何设置 {site_name} 的用户组权限选项，您甚至有可能必须在注册成正式用户后后才能浏览网站。当然，在通常情况下，您至少应该是正式用户才能发新帖和回复已有帖子。请先</span><span style=\"color:#444444;font-family:Verdana, Helvetica, Arial, sans-serif;font-size:14px;line-height:19px;text-align:left;white-space:normal;background-color:#FFFFFF;\">免费注册成为我们的新用户！&nbsp;</span><br style=\"word-wrap:break-word;color:#444444;font-family:Verdana, Helvetica, Arial, sans-serif;font-size:14px;line-height:19px;text-align:left;white-space:normal;background-color:#FFFFFF;\" />\n<br style=\"word-wrap:break-word;color:#444444;font-family:Verdana, Helvetica, Arial, sans-serif;font-size:14px;line-height:19px;text-align:left;white-space:normal;background-color:#FFFFFF;\" />\n<span style=\"color:#444444;font-family:Verdana, Helvetica, Arial, sans-serif;font-size:14px;line-height:19px;text-align:left;white-space:normal;background-color:#FFFFFF;\">强烈建议您注册，这样会得到很多以游客身份无法实现的功能。</span>','1','1','1340163725','1340213377','1','admin','1','admin','2');
INSERT INTO `needforbug_homehelp` (`homehelp_id`,`homehelp_title`,`homehelp_content`,`homehelpcategory_id`,`homehelp_status`,`create_dateline`,`update_dateline`,`user_id`,`homehelp_username`,`homehelp_updateuserid`,`homehelp_updateusername`,`homehelp_viewnum`) VALUES ('3','我如何登录网站？','<span style=\"color:#444444;font-family:Verdana, Helvetica, Arial, sans-serif;font-size:14px;line-height:19px;text-align:left;white-space:normal;background-color:#FFFFFF;\">如果您已经注册成为该论坛的会员，哪么您只要通过访问页面右上的</span><a href=\"http://bbs.emlog.net/logging.php?action=login\" target=\"_blank\" style=\"word-wrap:break-word;text-decoration:none;color:#000000;font-family:Verdana, Helvetica, Arial, sans-serif;font-size:14px;line-height:19px;text-align:left;white-space:normal;background-color:#FFFFFF;\">登录</a><span style=\"color:#444444;font-family:Verdana, Helvetica, Arial, sans-serif;font-size:14px;line-height:19px;text-align:left;white-space:normal;background-color:#FFFFFF;\">，进入登陆界面填写正确的用户名和密码，点击“登录”即可完成登陆如果您还未注册请点击这里。</span><br style=\"word-wrap:break-word;color:#444444;font-family:Verdana, Helvetica, Arial, sans-serif;font-size:14px;line-height:19px;text-align:left;white-space:normal;background-color:#FFFFFF;\" />\n<br style=\"word-wrap:break-word;color:#444444;font-family:Verdana, Helvetica, Arial, sans-serif;font-size:14px;line-height:19px;text-align:left;white-space:normal;background-color:#FFFFFF;\" />\n<span style=\"color:#444444;font-family:Verdana, Helvetica, Arial, sans-serif;font-size:14px;line-height:19px;text-align:left;white-space:normal;background-color:#FFFFFF;\">如果需要保持登录，请选择相应的 Cookie 时间，在此时间范围内您可以不必输入密码而保持上次的登录状态。</span>','1','1','1340164011','1340213385','1','admin','1','admin','1');
INSERT INTO `needforbug_homehelp` (`homehelp_id`,`homehelp_title`,`homehelp_content`,`homehelpcategory_id`,`homehelp_status`,`create_dateline`,`update_dateline`,`user_id`,`homehelp_username`,`homehelp_updateuserid`,`homehelp_updateusername`,`homehelp_viewnum`) VALUES ('4','忘记我的登录密码，怎么办？','','1','1','1340164050','1340213393','1','admin','1','admin','8');
INSERT INTO `needforbug_homehelp` (`homehelp_id`,`homehelp_title`,`homehelp_content`,`homehelpcategory_id`,`homehelp_status`,`create_dateline`,`update_dateline`,`user_id`,`homehelp_username`,`homehelp_updateuserid`,`homehelp_updateusername`,`homehelp_viewnum`) VALUES ('5','我如何使用个性化头像','<span style=\"color:#444444;font-family:Verdana, Helvetica, Arial, sans-serif;font-size:14px;line-height:19px;text-align:left;white-space:normal;background-color:#FFFFFF;\">在</span><span style=\"font-family:Verdana, Helvetica, Arial, sans-serif;font-size:14px;line-height:19px;text-align:left;white-space:normal;background-color:#FFFFFF;\">头部</span><span style=\"color:#444444;font-family:Verdana, Helvetica, Arial, sans-serif;font-size:14px;line-height:19px;text-align:left;white-space:normal;background-color:#FFFFFF;\">有一个“修改头像”的选项，可以使用自定义的头像。</span>','1','1','1340164159','1340213404','1','admin','1','admin','4');
INSERT INTO `needforbug_homehelp` (`homehelp_id`,`homehelp_title`,`homehelp_content`,`homehelpcategory_id`,`homehelp_status`,`create_dateline`,`update_dateline`,`user_id`,`homehelp_username`,`homehelp_updateuserid`,`homehelp_updateusername`,`homehelp_viewnum`) VALUES ('6','我如何修改登录密码','<span style=\"color:#444444;font-family:Verdana, Helvetica, Arial, sans-serif;font-size:14px;line-height:19px;text-align:left;white-space:normal;background-color:#FFFFFF;\">在</span><span style=\"font-family:Verdana, Helvetica, Arial, sans-serif;font-size:14px;line-height:19px;text-align:left;white-space:normal;background-color:#FFFFFF;\">基本信息中</span><span style=\"color:#444444;font-family:Verdana, Helvetica, Arial, sans-serif;font-size:14px;line-height:19px;text-align:left;white-space:normal;background-color:#FFFFFF;\">，填写“旧密码”，“新密码”，“确认新密码”。点击“提交”，即可修改。</span>','1','1','1340164237','1343443978','1','admin','1','admin','13');
INSERT INTO `needforbug_homehelp` (`homehelp_id`,`homehelp_title`,`homehelp_content`,`homehelpcategory_id`,`homehelp_status`,`create_dateline`,`update_dateline`,`user_id`,`homehelp_username`,`homehelp_updateuserid`,`homehelp_updateusername`,`homehelp_viewnum`) VALUES ('7','我如何使用个性化签名和昵称','<span style=\"color:#444444;font-family:Verdana, Helvetica, Arial, sans-serif;font-size:14px;line-height:19px;text-align:left;white-space:normal;background-color:#FFFFFF;\">在</span><span style=\"font-family:Verdana, Helvetica, Arial, sans-serif;font-size:14px;line-height:19px;text-align:left;white-space:normal;background-color:#FFFFFF;\">个人资料中</span><span style=\"color:#444444;font-family:Verdana, Helvetica, Arial, sans-serif;font-size:14px;line-height:19px;text-align:left;white-space:normal;background-color:#FFFFFF;\">，有一个“昵称”和“个人签名”的选项，可以在此设置。</span>','1','1','1340164280','1343444041','1','admin','1','admin','24');
INSERT INTO `needforbug_homehelp` (`homehelp_id`,`homehelp_title`,`homehelp_content`,`homehelpcategory_id`,`homehelp_status`,`create_dateline`,`update_dateline`,`user_id`,`homehelp_username`,`homehelp_updateuserid`,`homehelp_updateusername`,`homehelp_viewnum`) VALUES ('8','我如何使用“会员”功能','<ul>\n	<li>\n		<span style=\"white-space:nowrap;\">须首先登录，没有用户名的请先注册；</span> \n	</li>\n	<li>\n		<span style=\"white-space:nowrap;\">登录之后在论坛的左上方会出现一个“个人中心”的超级链接，点击这个链接之后就可进入到有关于您的信息。</span> \n	</li>\n</ul>','2','1','1340164420','1343444036','1','admin','1','admin','43');
INSERT INTO `needforbug_homehelp` (`homehelp_id`,`homehelp_title`,`homehelp_content`,`homehelpcategory_id`,`homehelp_status`,`create_dateline`,`update_dateline`,`user_id`,`homehelp_username`,`homehelp_updateuserid`,`homehelp_updateusername`,`homehelp_viewnum`) VALUES ('20','test','{site_name}的方式硕鼠硕鼠搜索的说法','1','1','1343295512','1345171983','1','admin','1','admin','32');
DROP TABLE IF EXISTS `needforbug_homehelpcategory`;
CREATE TABLE `needforbug_homehelpcategory` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `needforbug_homehelpcategory` (`homehelpcategory_id`,`homehelpcategory_name`,`homehelpcategory_count`,`homehelpcategory_sort`,`update_dateline`,`create_dateline`) VALUES ('1','用户须知','7','0','1340187070','1340171834');
INSERT INTO `needforbug_homehelpcategory` (`homehelpcategory_id`,`homehelpcategory_name`,`homehelpcategory_count`,`homehelpcategory_sort`,`update_dateline`,`create_dateline`) VALUES ('2','基本功能操作','1','0','1340187040','1340162722');
INSERT INTO `needforbug_homehelpcategory` (`homehelpcategory_id`,`homehelpcategory_name`,`homehelpcategory_count`,`homehelpcategory_sort`,`update_dateline`,`create_dateline`) VALUES ('3','其他相关问题','0','0','1340524577','1340162735');
DROP TABLE IF EXISTS `needforbug_homeoption`;
CREATE TABLE `needforbug_homeoption` (
  `homeoption_name` varchar(32) NOT NULL DEFAULT '' COMMENT '名字',
  `homeoption_value` text NOT NULL COMMENT '值',
  PRIMARY KEY (`homeoption_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `needforbug_homeoption` (`homeoption_name`,`homeoption_value`) VALUES ('homehelp_list_num','10');
INSERT INTO `needforbug_homeoption` (`homeoption_name`,`homeoption_value`) VALUES ('homefresh_list_num','15');
INSERT INTO `needforbug_homeoption` (`homeoption_name`,`homeoption_value`) VALUES ('homefresh_list_substring_num','500');
INSERT INTO `needforbug_homeoption` (`homeoption_name`,`homeoption_value`) VALUES ('user_list_num','10');
INSERT INTO `needforbug_homeoption` (`homeoption_name`,`homeoption_value`) VALUES ('friend_list_num','10');
INSERT INTO `needforbug_homeoption` (`homeoption_name`,`homeoption_value`) VALUES ('my_friend_limit_num','6');
INSERT INTO `needforbug_homeoption` (`homeoption_name`,`homeoption_value`) VALUES ('pm_list_num','5');
INSERT INTO `needforbug_homeoption` (`homeoption_name`,`homeoption_value`) VALUES ('pm_list_substring_num','200');
INSERT INTO `needforbug_homeoption` (`homeoption_name`,`homeoption_value`) VALUES ('pm_single_list_num','10');
DROP TABLE IF EXISTS `needforbug_homesite`;
CREATE TABLE `needforbug_homesite` (
  `homesite_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `homesite_name` char(32) NOT NULL DEFAULT '' COMMENT '键值',
  `homesite_nikename` char(32) NOT NULL COMMENT '站点信息别名',
  `homesite_content` text NOT NULL COMMENT '内容',
  PRIMARY KEY (`homesite_id`),
  UNIQUE KEY `homesite_name` (`homesite_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `needforbug_homesite` (`homesite_id`,`homesite_name`,`homesite_nikename`,`homesite_content`) VALUES ('1','aboutus','关于我们','<h3>\n	社区化电子商务\n</h3>\n{site_name} 致力于打造以社区为基础的电子商务平台。<br />\n<span style=\"white-space:nowrap;\"></span><br />\n<h3>\n	我们的目标\n</h3>\n我们的理念：{site_description}');
INSERT INTO `needforbug_homesite` (`homesite_id`,`homesite_name`,`homesite_nikename`,`homesite_content`) VALUES ('2','contactus','联系我们','<h3>\n	联系我们\n</h3>\n<p>\n	如果您对本站有任何疑问或建议，请通过以下方式联系我们：{admin_email}\n</p>');
INSERT INTO `needforbug_homesite` (`homesite_id`,`homesite_name`,`homesite_nikename`,`homesite_content`) VALUES ('3','agreement','用户协议','<div class=\"hero-unit\">\n	<h4>\n		用户内容知识共享\n	</h4>\n	<ul>\n		<li>\n			自由复制、发行、展览、表演、放映、广播或通过信息网络传播本作品\n		</li>\n		<li>\n			自由创作演绎作品\n		</li>\n		<li>\n			自由对本作品进行商业性使用\n		</li>\n	</ul>\n	<h4>\n		惟须遵守下列条件\n	</h4>\n	<ul>\n		<li>\n			署名－您必须按照作者或者许可人指定的方式对作品进行署名。\n		</li>\n		<li>\n			相同方式共享－如果您改变、转换本作品或者以本作品为基础进行创作，您只能采用与本协议相同的许可协议发布基于本作品的演绎作品。\n		</li>\n	</ul>\n</div>\n<h3>\n	服务条款确认与接纳\n</h3>\n<p>\n	{site_name} 拥有 {site_url}&nbsp;及其涉及到的产品、相关软件的所有权和运作权， {site_name} 享有对 {site_url} 上一切活动的监督、提示、检查、纠正及处罚等权利。用户通过注册程序阅读本服务条款并点击\"同意\"按钮完成注册，即表示用户与 {site_name} 已达成协议，自愿接受本服务条款的所有内容。如果用户不同意服务条款的条件，则不能获得使用 {site_name} 服务以及注册成为用户的权利。\n</p>\n<h3>\n	使用规则\n</h3>\n<ol>\n	<li>\n		用户注册成功后，{site_name} 将给予每个用户一个用户帐号及相应的密码，该用户帐号和密码由用户负<span style=\"white-space:nowrap;\">责保管；用户应当对以其用户帐号进行的所有活动和事件负法律责任。</span> \n	</li>\n	<li>\n		用户须对在 {site_name} 的注册信息的真实性、合法性、有效性承担全部责任，用户不得冒充他人；不得利用他人的名义发布任何信息；不得恶意使用注册帐户导致其他用户误认；否则 {site_name} 有权立即停止提供服务，收回其帐号并由用户独自承担由此而产生的一切法律责任。\n	</li>\n	<li>\n		用户不得使用 {site_name} 服务发送或传播敏感信息和违反国家法律制度的信息，包括但不限于下列信息:\n		<ul>\n			<li>\n				反对宪法所确定的基本原则的；\n			</li>\n			<li>\n				危害国家安全，泄露国家秘密，颠覆国家政权，破坏国家统一的；\n			</li>\n			<li>\n				损害国家荣誉和利益的；\n			</li>\n			<li>\n				煽动民族仇恨、民族歧视，破坏民族团结的；\n			</li>\n			<li>\n				破坏国家宗教政策，宣扬邪教和封建迷信的；\n			</li>\n			<li>\n				散布谣言，扰乱社会秩序，破坏社会稳定的；\n			</li>\n			<li>\n				散布淫秽、色情、赌博、暴力、凶杀、恐怖或者教唆犯罪的；\n			</li>\n			<li>\n				侮辱或者诽谤他人，侵害他人合法权益的\n			</li>\n			<li>\n				含有法律、行政法规禁止的其他内容的。\n			</li>\n		</ul>\n	</li>\n	<li>\n		{site_name} 有权对用户使用 {site_name}&nbsp;的情况进行审查和监督，如用户在使用 {site_name} 时违反任何上述规定，{site_name} 或其授权的人有权要求用户改正或直接采取一切必要的措施（包括但不限于删除用户张贴的内容、暂停或终止用户使用 {site_name}&nbsp;的权利）以减轻用户不当行为造成的影响。\n	</li>\n	<li>\n		盗取他人用户帐号或利用网络通讯骚扰他人，均属于非法行为。用户不得采用测试、欺骗等任何非法手段，盗取其他用户的帐号和对他人进行骚扰。\n	</li>\n</ol>\n<h3>\n	知识产权\n</h3>\n<ol>\n	<li>\n		用户保证和声明对其所提供的作品拥有完整的合法的著作权或完整的合法的授权可以用于其在 {site_name} 上从事&gt;的活动，保证 {site_name} 使用该作品不违反国家的法律法规，也不侵犯第三方的合法权益或承担任何义务。用户应对其所提供作品因形式、内容及授权的不完善、不合法所造成的一切后果承担完全责任。\n	</li>\n	<li>\n		对于经用户本人创作并上传到 {site_name} 的文本、图片、图形等， {site_name} 保留对其网站所有内容进行实时监控的权利，并有权依其独立判断对任何违反本协议约定的作品实施删除。{site_name} 对于删除用户作品引起的任何后果或导致用户的任何损失不负任何责任。\n	</li>\n	<li>\n		因用户作品的违法或侵害第三人的合法权益而导致 {site_name} 或其关联公司对第三方承担任何性质的赔偿、补偿或罚款而遭受损失（直接的、间接的、偶然的、惩罚性的和继发的损失），用户对于 {site_name} 或其关联公司蒙受的上述损失承担全面的赔偿责任。\n	</li>\n	<li>\n		任何第三方，都可以在遵循 《<a href=\"http://creativecommons.org/licenses/by-sa/2.5/cn/\" target=\"_blank\" style=\"white-space:nowrap;\">知识共享署名-相同方式共享 2.5 中国大陆许可协议</a>》 的情况下分享本站用户创造的内容。\n	</li>\n</ol>\n<h3>\n	免责声明\n</h3>\n<p>\n	<br />\n</p>\n<ul>\n	<li>\n		{site_name} 不能对用户在本社区回答问题的答案或评论的准确性及合理性进行保证。\n	</li>\n	<li>\n		若{site_name} 已经明示其网络服务提供方式发生变更并提醒用户应当注意事项，用户未按要求操作所产生的一切后果由用户自行承担。\n	</li>\n	<li>\n		用户明确同意其使用 {site_name} 网络服务所存在的风险将完全由其自己承担；因其使用 {site_name} 服务而产生的一切后果也由其自己承担，{site_name} 对用户不承担任何责任。\n	</li>\n	<li>\n		{site_name} 不保证网络服务一定能满足用户的要求，也不保证网络服务不会中断，对网络服务的及时性、安全性、准确性也都不作保证。\n	</li>\n	<li>\n		对于因不可抗力或 {site_name} 不能控制的原因造成的网络服务中断或其它缺陷，{site_name} 不承担任何责任，但将尽力减少因此而给用户造成的损失和影响。\n	</li>\n	<li>\n		用户同意保障和维护 {site_name} 及其他用户的利益，用户在 {site_name} 发表的内容仅表明其个人的立场和观点，并不代表 {site_name} 的立场或观点。由于用户发表内容违法、不真实、不正当、侵犯第三方合法权益，或用户违反本协议项下的任何条款而给 {site_name} 或任何其他第三人造成损失，用户同意承担由此造成的损害赔偿责任。\n	</li>\n</ul>\n<p>\n	<br />\n</p>\n<h3>\n	服务条款的修改\n</h3>\n<p>\n	{site_name} 会在必要时修改服务条款，服务条款一旦发生变动，{site_name} 将会在用户进入下一步使用前的页面提示修改内容。如果您同意改动，则再一次激活\"我同意\"按钮。如果您不接受，则及时取消您的用户使用服务资格。 用户要继续使用 {site_name} 各项服务需要两方面的确认:\n</p>\n<ol>\n	<li>\n		首先确认 {site_name} 服务条款及其变动。\n	</li>\n	<li>\n		同意接受所有的服务条款限制。\n	</li>\n</ol>\n<h3>\n	联系我们\n</h3>\n<p>\n	如果您对此服务条款有任何疑问或建议，请通过以下方式联系我们：{admin_email}\n</p>');
INSERT INTO `needforbug_homesite` (`homesite_id`,`homesite_name`,`homesite_nikename`,`homesite_content`) VALUES ('4','privacy','隐私政策','<h3>\n	隐私政策\n</h3>\n<p>\n{site_name}（{site_url}）以此声明对本站用户隐私保护的许诺。{site_name} 的隐私声明正在不断改进中，随着 {site_name} 服务范围的扩大，会随时更新隐私声明，欢迎您随时查看隐私声明。<br />\n</p>\n<h3>\n	隐私政策\n</h3>\n<p>{site_name} 非常重视对用户隐私权的保护，承诺不会在未获得用户许可的情况下擅自将用户的个人资料信息出租或出售给任何第三方，但以下情况除外:<br />\n您同意让第三方共享资料；<br />\n<ul>\n	<li>\n		您同意公开你的个人资料，享受为您提供的产品和服务；\n	</li>\n	<li>\n		本站需要听从法庭传票、法律命令或遵循法律程序；\n	</li>\n	<li>\n		本站发现您违反了本站服务条款或本站其它使用规定。\n	</li>\n</ul>\n</p>');
DROP TABLE IF EXISTS `needforbug_hometag`;
CREATE TABLE `needforbug_hometag` (
  `hometag_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户标签',
  `hometag_name` char(32) NOT NULL DEFAULT '' COMMENT '标签名字',
  `hometag_count` int(10) NOT NULL DEFAULT '0' COMMENT '标签用户数量',
  `hometag_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否可用',
  `create_dateline` int(10) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`hometag_id`),
  KEY `hometag_name` (`hometag_name`),
  KEY `hometag_status` (`hometag_status`),
  KEY `create_dateline` (`create_dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `needforbug_hometag` (`hometag_id`,`hometag_name`,`hometag_count`,`hometag_status`,`create_dateline`) VALUES ('9','90后','1','0','1339432495');
INSERT INTO `needforbug_hometag` (`hometag_id`,`hometag_name`,`hometag_count`,`hometag_status`,`create_dateline`) VALUES ('11','dsf','1','1','1339688768');
INSERT INTO `needforbug_hometag` (`hometag_id`,`hometag_name`,`hometag_count`,`hometag_status`,`create_dateline`) VALUES ('12','sdf','1','1','1339688771');
INSERT INTO `needforbug_hometag` (`hometag_id`,`hometag_name`,`hometag_count`,`hometag_status`,`create_dateline`) VALUES ('10','IT','1','1','1339432495');
DROP TABLE IF EXISTS `needforbug_hometagindex`;
CREATE TABLE `needforbug_hometagindex` (
  `user_id` int(10) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `hometag_id` int(10) NOT NULL DEFAULT '0' COMMENT '标签ID',
  PRIMARY KEY (`user_id`,`hometag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `needforbug_hometagindex` (`user_id`,`hometag_id`) VALUES ('1','9');
INSERT INTO `needforbug_hometagindex` (`user_id`,`hometag_id`) VALUES ('1','10');
INSERT INTO `needforbug_hometagindex` (`user_id`,`hometag_id`) VALUES ('1','11');
DROP TABLE IF EXISTS `needforbug_link`;
CREATE TABLE `needforbug_link` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `needforbug_link` (`link_id`,`create_dateline`,`update_dateline`,`link_name`,`link_url`,`link_description`,`link_logo`,`link_status`,`link_sort`) VALUES ('5','1340369066','1343901367','水军','探索网络水军','探索网络水军','','1','0');
INSERT INTO `needforbug_link` (`link_id`,`create_dateline`,`update_dateline`,`link_name`,`link_url`,`link_description`,`link_logo`,`link_status`,`link_sort`) VALUES ('4','1340369020','1343812340','vps主机','vps主机','Linux主机提供商','','1','0');
INSERT INTO `needforbug_link` (`link_id`,`create_dateline`,`update_dateline`,`link_name`,`link_url`,`link_description`,`link_logo`,`link_status`,`link_sort`) VALUES ('6','1340369108','1343901624','A5源码','http://admin5.com','下载最新源码','','1','0');
INSERT INTO `needforbug_link` (`link_id`,`create_dateline`,`update_dateline`,`link_name`,`link_url`,`link_description`,`link_logo`,`link_status`,`link_sort`) VALUES ('8','1340369511','1343901407','Canphp框架','\\/canphp.com','Canphp管网','','1','0');
INSERT INTO `needforbug_link` (`link_id`,`create_dateline`,`update_dateline`,`link_name`,`link_url`,`link_description`,`link_logo`,`link_status`,`link_sort`) VALUES ('10','1340369589','0','听我网','http://www.tvery.com/','','','1','0');
INSERT INTO `needforbug_link` (`link_id`,`create_dateline`,`update_dateline`,`link_name`,`link_url`,`link_description`,`link_logo`,`link_status`,`link_sort`) VALUES ('11','1340369604','1343815858','百度','http://baidu.com','','','1','0');
DROP TABLE IF EXISTS `needforbug_loginlog`;
CREATE TABLE `needforbug_loginlog` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('1','1','1343569273','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('2','1','1343576039','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('3','1','1343610414','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('4','1','1343617888','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('5','1','1343619071','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('6','1','1343636185','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('7','1','1343636470','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('8','1','1343636973','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('9','1','1343642687','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('10','1','1343644099','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('11','1','1343697317','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('12','0','1343700295','0','adminsdf','0.0.0.0','0','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('13','1','1343700309','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('14','1','1343700649','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('15','1','1343700668','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('16','0','1343700692','0','admin','0.0.0.0','0','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('17','1','1343700696','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('18','1','1343700999','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('19','1','1343701011','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('20','1','1343701123','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('21','1','1343701155','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('22','1','1343701223','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('23','1','1343701373','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('24','1','1343701419','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('25','1','1343701466','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('26','1','1343701808','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('27','1','1343701937','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('28','1','1343701991','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('29','1','1343702077','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('30','0','1343702164','0','admin','0.0.0.0','0','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('31','1','1343702169','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('32','0','1343702419','0','admin','0.0.0.0','0','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('33','0','1343702423','0','admin','0.0.0.0','0','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('34','1','1343702428','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('35','1','1343702497','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('36','1','1343703026','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('37','1','1343703265','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('38','0','1343703402','0','admin','0.0.0.0','0','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('39','0','1343703406','0','admin','0.0.0.0','0','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('40','1','1343703427','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('41','1','1343703451','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('42','1','1343703514','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('43','1','1343703657','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('44','0','1343703683','0','ad,om','0.0.0.0','0','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('45','1','1343703689','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('46','1','1343703753','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('47','1','1343703819','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('48','1','1343703921','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('49','1','1343704851','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('50','1','1343705400','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('51','1','1343705427','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('52','1','1343705448','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('53','1','1343705767','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('54','1','1343705959','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('55','1','1343706001','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('56','1','1343706026','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('57','1','1343706139','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('58','1','1343706179','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('59','1','1343706613','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('60','1','1343706762','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('61','1','1343706870','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('62','1','1343706989','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('63','1','1343707364','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('64','1','1343707582','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('65','1','1343707834','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('66','1','1343720310','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('67','1','1343720334','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('68','1','1343720471','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('69','1','1343720602','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('70','1','1343720738','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('71','1','1343720998','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('72','1','1343721086','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('73','1','1343721177','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('74','1','1343721217','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('75','1','1343722344','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('76','1','1343722598','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('77','1','1343723200','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('78','1','1343723325','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('79','1','1343723503','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('80','1','1343723727','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('81','1','1343723772','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('82','1','1343723798','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('83','1','1343723944','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('84','1','1343723964','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('85','1','1343723985','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('86','1','1343724008','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('87','1','1343724022','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('88','1','1343724057','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('89','1','1343724091','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('90','1','1343724114','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('91','1','1343724137','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('92','1','1343724211','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('93','1','1343724228','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('94','0','1343724262','0','admin','0.0.0.0','0','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('95','0','1343724267','0','admin','0.0.0.0','0','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('96','1','1343724273','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('97','1','1343724291','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('98','0','1343724313','0','admin','0.0.0.0','0','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('99','1','1343724319','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('100','1','1343724351','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('101','1','1343724384','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('102','1','1343724759','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('103','1','1343726458','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('104','1','1343726694','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('105','1','1343727132','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('106','1','1343727501','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('107','1','1343727541','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('108','1','1343728328','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('109','1','1343728343','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('110','1','1343728391','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('111','1','1343728473','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('112','1','1343728675','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('113','1','1343728808','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('114','1','1343729758','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('115','1','1343730347','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('116','1','1343792771','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('117','1','1343792779','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('118','1','1343792931','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('119','1','1343792949','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('120','1','1343793388','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('121','1','1343793401','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('122','1','1343793419','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('123','1','1343802674','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('124','1','1343804402','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('125','1','1343805167','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('126','1','1343807970','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('127','1','1343808095','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('128','1','1343808633','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('129','1','1343817750','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('130','1','1343817769','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('131','1','1343867889','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('132','1','1343870071','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('133','1','1343870128','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('134','1','1343901102','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('135','1','1343901339','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('136','1','1343901387','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('137','1','1343901835','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('138','1','1343901855','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('139','1','1343901877','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('140','1','1343955767','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('141','1','1343974411','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('142','1','1343982618','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('143','1','1344126844','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('144','1','1344212684','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('145','1','1344221886','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('146','1','1344225223','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('147','1','1344232592','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('148','1','1344234370','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('149','1','1344299619','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('150','1','1344312652','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('151','1','1344321505','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('152','1','1344348548','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('153','1','1344385863','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('154','1','1344397303','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('155','1','1344423832','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('156','0','1344472652','0','log1990@126.com','0.0.0.0','0','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('157','1','1344472664','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('158','1','1344472717','0','admin@admin.com','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('159','1','1344473354','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('160','1','1344477798','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('161','1','1344478938','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('162','1','1344479136','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('163','1','1344479546','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('164','1','1344498542','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('165','1','1344526220','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('166','1','1344593014','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('167','1','1344654402','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('168','1','1344673160','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('169','1','1344688941','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('170','1','1344706550','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('171','1','1344749632','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('172','1','1344779257','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('173','1','1344812102','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('174','1','1344818565','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('175','0','1344818917','0','admin','0.0.0.0','0','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('176','1','1344818925','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('177','1','1344819234','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('178','1','1344826033','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('179','1','1344828321','0','admin@admin.com','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('180','1','1344828330','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('181','1','1344828592','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('182','1','1344838579','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('183','1','1344866606','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('184','1','1344878947','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('185','1','1344905222','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('186','0','1344911037','0','sdfsdfsdf','0.0.0.0','0','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('187','0','1344911049','0','admin','0.0.0.0','0','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('188','1','1344912954','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('189','1','1344926659','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('206','1','1345105352','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('205','1','1345102043','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('207','1','1345124749','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('208','1','1345158992','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('209','1','1345164531','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('210','1','1345169802','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('211','1','1345171231','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('212','1','1345174929','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('213','1','1345213716','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('214','1','1345218188','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('215','1','1345251240','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('216','1','1345252866','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('217','1','1345253115','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('218','1','1345256800','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('219','1','1345263621','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('220','1','1345264085','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('221','6','1345265282','0','xiaomage','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('222','1','1345265311','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('223','1','1345295573','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('224','1','1345297037','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('225','1','1345297091','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('226','1','1345297737','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('227','1','1345304362','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('228','1','1345305663','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('229','1','1345306845','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('230','1','1345306937','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('231','1','1345308553','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('232','1','1345337183','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('233','1','1345341986','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('234','1','1345343479','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('235','1','1345380904','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('236','1','1345385063','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('237','1','1345387447','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('238','1','1345424207','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('239','1','1345429848','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('240','1','1345432067','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('241','1','1345443866','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('242','1','1345447629','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('243','1','1345448495','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('244','1','1345509423','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('245','0','1345511327','0','xiaoniuge','0.0.0.0','0','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('246','6','1345511347','0','xiaomage','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('247','1','1345511430','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('248','6','1345511931','0','xiaomage','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('249','1','1345511978','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('250','1','1345528904','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('251','1','1345530346','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('252','1','1345538881','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('253','1','1345540778','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('254','1','1345596211','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('255','1','1345598613','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('256','1','1345601780','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('257','1','1345603434','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('258','17','1345623288','0','weiyong1999','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('259','0','1345635963','0','admin','0.0.0.0','0','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('260','1','1345635971','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('261','1','1345637155','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('262','1','1345637191','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('263','1','1345644712','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('264','1','1345707361','0','admin','0.0.0.0','1','admin');
INSERT INTO `needforbug_loginlog` (`loginlog_id`,`user_id`,`create_dateline`,`update_dateline`,`loginlog_user`,`loginlog_ip`,`loginlog_status`,`login_application`) VALUES ('265','1','1345710814','0','admin','0.0.0.0','1','admin');
DROP TABLE IF EXISTS `needforbug_mail`;
CREATE TABLE `needforbug_mail` (
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
DROP TABLE IF EXISTS `needforbug_nav`;
CREATE TABLE `needforbug_nav` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `needforbug_nav` (`nav_id`,`nav_parentid`,`nav_name`,`nav_identifier`,`nav_title`,`nav_url`,`nav_target`,`nav_type`,`nav_style`,`nav_location`,`nav_status`,`nav_sort`,`nav_color`,`nav_icon`) VALUES ('14','0','小组','app_group','group','group://public/index','0','0','a:3:{i:0;i:0;i:1;i:0;i:2;i:0;}','0','1','0','0','');
INSERT INTO `needforbug_nav` (`nav_id`,`nav_parentid`,`nav_name`,`nav_identifier`,`nav_title`,`nav_url`,`nav_target`,`nav_type`,`nav_style`,`nav_location`,`nav_status`,`nav_sort`,`nav_color`,`nav_icon`) VALUES ('2','0','设为首页','sethomepage','','#','0','0','a:3:{i:0;i:0;i:1;i:0;i:2;i:0;}','1','1','0','0','');
INSERT INTO `needforbug_nav` (`nav_id`,`nav_parentid`,`nav_name`,`nav_identifier`,`nav_title`,`nav_url`,`nav_target`,`nav_type`,`nav_style`,`nav_location`,`nav_status`,`nav_sort`,`nav_color`,`nav_icon`) VALUES ('3','0','加入收藏','setfavorite','','#','0','0','a:3:{i:0;i:0;i:1;i:0;i:2;i:0;}','1','1','0','0','');
INSERT INTO `needforbug_nav` (`nav_id`,`nav_parentid`,`nav_name`,`nav_identifier`,`nav_title`,`nav_url`,`nav_target`,`nav_type`,`nav_style`,`nav_location`,`nav_status`,`nav_sort`,`nav_color`,`nav_icon`) VALUES ('4','0','关于我们','aboutus','','home://public/aboutus','0','0','','2','1','0','0','');
INSERT INTO `needforbug_nav` (`nav_id`,`nav_parentid`,`nav_name`,`nav_identifier`,`nav_title`,`nav_url`,`nav_target`,`nav_type`,`nav_style`,`nav_location`,`nav_status`,`nav_sort`,`nav_color`,`nav_icon`) VALUES ('5','0','联系我们','contactus','','home://public/contactus','0','0','','2','1','0','0','');
INSERT INTO `needforbug_nav` (`nav_id`,`nav_parentid`,`nav_name`,`nav_identifier`,`nav_title`,`nav_url`,`nav_target`,`nav_type`,`nav_style`,`nav_location`,`nav_status`,`nav_sort`,`nav_color`,`nav_icon`) VALUES ('6','0','用户协议','agreement','','home://public/agreement','0','0','','2','1','0','0','');
INSERT INTO `needforbug_nav` (`nav_id`,`nav_parentid`,`nav_name`,`nav_identifier`,`nav_title`,`nav_url`,`nav_target`,`nav_type`,`nav_style`,`nav_location`,`nav_status`,`nav_sort`,`nav_color`,`nav_icon`) VALUES ('7','0','隐私声明','privacy','','home://public/privacy','0','0','','2','1','0','0','');
INSERT INTO `needforbug_nav` (`nav_id`,`nav_parentid`,`nav_name`,`nav_identifier`,`nav_title`,`nav_url`,`nav_target`,`nav_type`,`nav_style`,`nav_location`,`nav_status`,`nav_sort`,`nav_color`,`nav_icon`) VALUES ('1','0','帮助','help','','home://public/help','0','0','','2','1','0','0','');
INSERT INTO `needforbug_nav` (`nav_id`,`nav_parentid`,`nav_name`,`nav_identifier`,`nav_title`,`nav_url`,`nav_target`,`nav_type`,`nav_style`,`nav_location`,`nav_status`,`nav_sort`,`nav_color`,`nav_icon`) VALUES ('19','0','sdfs','custom_f0138F','','','0','1','a:3:{i:0;i:0;i:1;i:0;i:2;i:0;}','0','0','0','0','');
INSERT INTO `needforbug_nav` (`nav_id`,`nav_parentid`,`nav_name`,`nav_identifier`,`nav_title`,`nav_url`,`nav_target`,`nav_type`,`nav_style`,`nav_location`,`nav_status`,`nav_sort`,`nav_color`,`nav_icon`) VALUES ('21','0','测试','custom_fc8Ff2','','{Dyhb::U(\'home://public/login\')}','0','1','','0','1','0','0','');
DROP TABLE IF EXISTS `needforbug_node`;
CREATE TABLE `needforbug_node` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `needforbug_node` (`node_id`,`node_name`,`node_title`,`node_status`,`node_remark`,`node_sort`,`node_parentid`,`node_level`,`nodegroup_id`,`create_dateline`,`update_dateline`) VALUES ('1','admin','admin后台管理','1','','1','0','1','0','0','1338558614');
INSERT INTO `needforbug_node` (`node_id`,`node_name`,`node_title`,`node_status`,`node_remark`,`node_sort`,`node_parentid`,`node_level`,`nodegroup_id`,`create_dateline`,`update_dateline`) VALUES ('14','admin@rating','角色等级','1','','5','1','2','1','1338612283','1341116051');
INSERT INTO `needforbug_node` (`node_id`,`node_name`,`node_title`,`node_status`,`node_remark`,`node_sort`,`node_parentid`,`node_level`,`nodegroup_id`,`create_dateline`,`update_dateline`) VALUES ('2','admin@role','角色管理','1','','3','1','2','1','0','1341116051');
INSERT INTO `needforbug_node` (`node_id`,`node_name`,`node_title`,`node_status`,`node_remark`,`node_sort`,`node_parentid`,`node_level`,`nodegroup_id`,`create_dateline`,`update_dateline`) VALUES ('3','admin@user','用户管理','1','','7','1','2','1','0','1341116051');
INSERT INTO `needforbug_node` (`node_id`,`node_name`,`node_title`,`node_status`,`node_remark`,`node_sort`,`node_parentid`,`node_level`,`nodegroup_id`,`create_dateline`,`update_dateline`) VALUES ('4','admin@nodegroup','节点分组','1','','2','1','2','1','0','1341116051');
INSERT INTO `needforbug_node` (`node_id`,`node_name`,`node_title`,`node_status`,`node_remark`,`node_sort`,`node_parentid`,`node_level`,`nodegroup_id`,`create_dateline`,`update_dateline`) VALUES ('5','admin@node','节点管理','1','','1','1','2','1','0','1341116051');
INSERT INTO `needforbug_node` (`node_id`,`node_name`,`node_title`,`node_status`,`node_remark`,`node_sort`,`node_parentid`,`node_level`,`nodegroup_id`,`create_dateline`,`update_dateline`) VALUES ('6','admin@option','基本设置','1','','1','1','2','2','1334071697','1345532824');
INSERT INTO `needforbug_node` (`node_id`,`node_name`,`node_title`,`node_status`,`node_remark`,`node_sort`,`node_parentid`,`node_level`,`nodegroup_id`,`create_dateline`,`update_dateline`) VALUES ('7','admin@database','数据库','1','','1','1','2','3','1334394862','1342567736');
INSERT INTO `needforbug_node` (`node_id`,`node_name`,`node_title`,`node_status`,`node_remark`,`node_sort`,`node_parentid`,`node_level`,`nodegroup_id`,`create_dateline`,`update_dateline`) VALUES ('10','admin@app','应用管理','1','','1','1','2','4','1338021590','1338045970');
INSERT INTO `needforbug_node` (`node_id`,`node_name`,`node_title`,`node_status`,`node_remark`,`node_sort`,`node_parentid`,`node_level`,`nodegroup_id`,`create_dateline`,`update_dateline`) VALUES ('8','admin@registeroption','注册与访问控制','1','','2','1','2','2','1337885123','1345532824');
INSERT INTO `needforbug_node` (`node_id`,`node_name`,`node_title`,`node_status`,`node_remark`,`node_sort`,`node_parentid`,`node_level`,`nodegroup_id`,`create_dateline`,`update_dateline`) VALUES ('9','admin@uploadoption','上传设置','1','','3','1','2','2','1337887882','1345532824');
INSERT INTO `needforbug_node` (`node_id`,`node_name`,`node_title`,`node_status`,`node_remark`,`node_sort`,`node_parentid`,`node_level`,`nodegroup_id`,`create_dateline`,`update_dateline`) VALUES ('11','admin@installapp','安装新应用','1','','2','1','2','4','1338045957','1338045970');
INSERT INTO `needforbug_node` (`node_id`,`node_name`,`node_title`,`node_status`,`node_remark`,`node_sort`,`node_parentid`,`node_level`,`nodegroup_id`,`create_dateline`,`update_dateline`) VALUES ('12','admin@nav','导航设置','1','','1','1','2','5','1338271653','1344813625');
INSERT INTO `needforbug_node` (`node_id`,`node_name`,`node_title`,`node_status`,`node_remark`,`node_sort`,`node_parentid`,`node_level`,`nodegroup_id`,`create_dateline`,`update_dateline`) VALUES ('13','admin@rolegroup','角色分组','1','','4','1','2','1','1338449972','1341116051');
INSERT INTO `needforbug_node` (`node_id`,`node_name`,`node_title`,`node_status`,`node_remark`,`node_sort`,`node_parentid`,`node_level`,`nodegroup_id`,`create_dateline`,`update_dateline`) VALUES ('15','admin@ratinggroup','等级分组','1','','6','1','2','1','1338614127','1341116051');
INSERT INTO `needforbug_node` (`node_id`,`node_name`,`node_title`,`node_status`,`node_remark`,`node_sort`,`node_parentid`,`node_level`,`nodegroup_id`,`create_dateline`,`update_dateline`) VALUES ('16','admin@secoption','防灌水设置','1','','4','1','2','2','1339690018','1345532824');
INSERT INTO `needforbug_node` (`node_id`,`node_name`,`node_title`,`node_status`,`node_remark`,`node_sort`,`node_parentid`,`node_level`,`nodegroup_id`,`create_dateline`,`update_dateline`) VALUES ('17','admin@link','友情链接','1','','1','1','2','6','1340357076','1345362771');
INSERT INTO `needforbug_node` (`node_id`,`node_name`,`node_title`,`node_status`,`node_remark`,`node_sort`,`node_parentid`,`node_level`,`nodegroup_id`,`create_dateline`,`update_dateline`) VALUES ('18','admin@programoption','系统版权','1','','10','1','2','2','1340376127','1345532824');
INSERT INTO `needforbug_node` (`node_id`,`node_name`,`node_title`,`node_status`,`node_remark`,`node_sort`,`node_parentid`,`node_level`,`nodegroup_id`,`create_dateline`,`update_dateline`) VALUES ('19','admin@district','地区设置','1','','8','1','2','2','1340471147','1345532824');
INSERT INTO `needforbug_node` (`node_id`,`node_name`,`node_title`,`node_status`,`node_remark`,`node_sort`,`node_parentid`,`node_level`,`nodegroup_id`,`create_dateline`,`update_dateline`) VALUES ('20','admin@badword','词语过滤','1','','0','1','2','7','1340648216','1340648479');
INSERT INTO `needforbug_node` (`node_id`,`node_name`,`node_title`,`node_status`,`node_remark`,`node_sort`,`node_parentid`,`node_level`,`nodegroup_id`,`create_dateline`,`update_dateline`) VALUES ('21','admin@userprofilesetting','用户栏目','1','','8','1','2','1','1341116036','1341116051');
INSERT INTO `needforbug_node` (`node_id`,`node_name`,`node_title`,`node_status`,`node_remark`,`node_sort`,`node_parentid`,`node_level`,`nodegroup_id`,`create_dateline`,`update_dateline`) VALUES ('22','admin@pmoption','短消息','1','','5','1','2','2','1342407121','1345532824');
INSERT INTO `needforbug_node` (`node_id`,`node_name`,`node_title`,`node_status`,`node_remark`,`node_sort`,`node_parentid`,`node_level`,`nodegroup_id`,`create_dateline`,`update_dateline`) VALUES ('23','admin@loginlog','登录记录','1','','2','1','2','3','1342567716','1342567736');
INSERT INTO `needforbug_node` (`node_id`,`node_name`,`node_title`,`node_status`,`node_remark`,`node_sort`,`node_parentid`,`node_level`,`nodegroup_id`,`create_dateline`,`update_dateline`) VALUES ('24','admin@pm','短消息','1','','2','1','2','6','1342567990','1345362771');
INSERT INTO `needforbug_node` (`node_id`,`node_name`,`node_title`,`node_status`,`node_remark`,`node_sort`,`node_parentid`,`node_level`,`nodegroup_id`,`create_dateline`,`update_dateline`) VALUES ('25','admin@creditoption','积分设置','1','','7','1','2','2','1343028013','1345532824');
INSERT INTO `needforbug_node` (`node_id`,`node_name`,`node_title`,`node_status`,`node_remark`,`node_sort`,`node_parentid`,`node_level`,`nodegroup_id`,`create_dateline`,`update_dateline`) VALUES ('26','admin@dateoption','时间设置','1','','9','1','2','2','1343285683','1345532824');
INSERT INTO `needforbug_node` (`node_id`,`node_name`,`node_title`,`node_status`,`node_remark`,`node_sort`,`node_parentid`,`node_level`,`nodegroup_id`,`create_dateline`,`update_dateline`) VALUES ('27','admin@styleoption','界面设置','1','','2','1','2','5','1343320477','1344813625');
INSERT INTO `needforbug_node` (`node_id`,`node_name`,`node_title`,`node_status`,`node_remark`,`node_sort`,`node_parentid`,`node_level`,`nodegroup_id`,`create_dateline`,`update_dateline`) VALUES ('28','admin@appconfigtool','应用配置','1','','0','1','2','8','1343902350','0');
INSERT INTO `needforbug_node` (`node_id`,`node_name`,`node_title`,`node_status`,`node_remark`,`node_sort`,`node_parentid`,`node_level`,`nodegroup_id`,`create_dateline`,`update_dateline`) VALUES ('29','admin@style','风格管理','1','','3','1','2','5','1344225253','1344813625');
INSERT INTO `needforbug_node` (`node_id`,`node_name`,`node_title`,`node_status`,`node_remark`,`node_sort`,`node_parentid`,`node_level`,`nodegroup_id`,`create_dateline`,`update_dateline`) VALUES ('30','admin@theme','模板管理','1','','4','1','2','5','1344813607','1344813625');
INSERT INTO `needforbug_node` (`node_id`,`node_name`,`node_title`,`node_status`,`node_remark`,`node_sort`,`node_parentid`,`node_level`,`nodegroup_id`,`create_dateline`,`update_dateline`) VALUES ('31','admin@slide','幻灯片','1','','3','1','2','6','1345362756','1345362771');
INSERT INTO `needforbug_node` (`node_id`,`node_name`,`node_title`,`node_status`,`node_remark`,`node_sort`,`node_parentid`,`node_level`,`nodegroup_id`,`create_dateline`,`update_dateline`) VALUES ('32','admin@mailoption','邮件设置','1','','6','1','2','2','1345532803','1345532824');
DROP TABLE IF EXISTS `needforbug_nodegroup`;
CREATE TABLE `needforbug_nodegroup` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `needforbug_nodegroup` (`nodegroup_id`,`nodegroup_name`,`nodegroup_title`,`create_dateline`,`update_dateline`,`nodegroup_status`,`nodegroup_sort`) VALUES ('1','rbac','权限','1296454621','1343878985','1','5');
INSERT INTO `needforbug_nodegroup` (`nodegroup_id`,`nodegroup_name`,`nodegroup_title`,`create_dateline`,`update_dateline`,`nodegroup_status`,`nodegroup_sort`) VALUES ('2','option','设置','1334071384','1343878985','1','1');
INSERT INTO `needforbug_nodegroup` (`nodegroup_id`,`nodegroup_name`,`nodegroup_title`,`create_dateline`,`update_dateline`,`nodegroup_status`,`nodegroup_sort`) VALUES ('3','admin','站长','1334394747','1343878985','1','8');
INSERT INTO `needforbug_nodegroup` (`nodegroup_id`,`nodegroup_name`,`nodegroup_title`,`create_dateline`,`update_dateline`,`nodegroup_status`,`nodegroup_sort`) VALUES ('4','app','应用','1334471579','1343878985','1','4');
INSERT INTO `needforbug_nodegroup` (`nodegroup_id`,`nodegroup_name`,`nodegroup_title`,`create_dateline`,`update_dateline`,`nodegroup_status`,`nodegroup_sort`) VALUES ('5','ui','界面','1338271539','1343878985','1','2');
INSERT INTO `needforbug_nodegroup` (`nodegroup_id`,`nodegroup_name`,`nodegroup_title`,`create_dateline`,`update_dateline`,`nodegroup_status`,`nodegroup_sort`) VALUES ('6','announce','运营','1340356739','1343878985','1','6');
INSERT INTO `needforbug_nodegroup` (`nodegroup_id`,`nodegroup_name`,`nodegroup_title`,`create_dateline`,`update_dateline`,`nodegroup_status`,`nodegroup_sort`) VALUES ('7','moderate','内容','1340648268','1343878985','1','3');
INSERT INTO `needforbug_nodegroup` (`nodegroup_id`,`nodegroup_name`,`nodegroup_title`,`create_dateline`,`update_dateline`,`nodegroup_status`,`nodegroup_sort`) VALUES ('8','tool','工具','1343878970','1343878985','1','7');
DROP TABLE IF EXISTS `needforbug_option`;
CREATE TABLE `needforbug_option` (
  `option_name` varchar(32) NOT NULL DEFAULT '' COMMENT '名字',
  `option_value` text NOT NULL COMMENT '值',
  PRIMARY KEY (`option_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('admin_list_num','15');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('site_name','NeedForBug');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('site_description','Enjoy Online Shopping.独属于我的社区购物');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('site_url','http://localhost/needforbug/upload');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('close_site','0');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('close_site_reason','update...');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('start_gzip','0');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('timeoffset','Asia/Shanghai');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('uploadfile_maxsize','-1');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('upload_store_type','day');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('disallowed_register_user','');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('disallowed_register_email','');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('allowed_register_email','');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('audit_register','0');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('disallowed_register','0');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('icp','蜀ICP备123456号');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('home_description','{site_name}是一个以电子商务和社区为核心的社区化电子商务（B2C）平台。在这里你可以向网友分享你的购物体验、你喜欢的商品以及心情等等，同时也可以从社区获取来自其它网友的超值的信息，我们崇尚的是理念：<span class=\"label label-success\">简单与分享</span>。');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('admin_email','admin@admin.com');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('seccode_image_width_size','160');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('seccode_image_height_size','60');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('seccode_adulterate','0');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('seccode_ttf','1');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('seccode_tilt','0');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('seccode_color','1');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('seccode_size','0');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('seccode_shadow','1');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('seccode_animator','0');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('seccode_background','1');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('seccode_image_background','1');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('seccode_norise','0');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('seccode_curve','1');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('seccode_type','1');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('needforbug_program_name','NeedForBug');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('needforbug_program_version','1.0');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('needforbug_company_name','Dianniu Inc.');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('needforbug_company_url','http://dianniu.net');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('needforbug_program_url','http://needforbug.doyouhaobaby.net');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('needforbug_program_year','2012');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('needforbug_company_year','2010-2012');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('site_year','2012');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('stat_code','');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('badword_on','0');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('pmsend_regdays','5');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('pmlimit_oneday','100');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('pmflood_ctrl','10');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('pm_status','1');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('pmsend_seccode','0');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('pm_sound_on','1');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('pm_sound_type','1');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('pm_sound_out_url','');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('avatar_uploadfile_maxsize','512000');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('extend_credit','a:8:{i:1;a:8:{s:9:\"available\";i:1;s:5:\"title\";s:6:\"经验\";s:4:\"unit\";i:0;s:11:\"initcredits\";i:0;s:10:\"lowerlimit\";i:0;s:15:\"allowexchangein\";i:0;s:16:\"allowexchangeout\";i:0;s:5:\"ratio\";i:0;}i:2;a:8:{s:9:\"available\";i:1;s:5:\"title\";s:6:\"金币\";s:4:\"unit\";i:0;s:11:\"initcredits\";i:0;s:10:\"lowerlimit\";i:0;s:15:\"allowexchangein\";i:0;s:16:\"allowexchangeout\";i:0;s:5:\"ratio\";i:0;}i:3;a:8:{s:9:\"available\";i:1;s:5:\"title\";s:6:\"贡献\";s:4:\"unit\";i:0;s:11:\"initcredits\";i:0;s:10:\"lowerlimit\";i:0;s:15:\"allowexchangein\";i:0;s:16:\"allowexchangeout\";i:0;s:5:\"ratio\";i:0;}i:4;a:8:{s:5:\"title\";s:0:\"\";s:4:\"unit\";i:0;s:11:\"initcredits\";i:0;s:10:\"lowerlimit\";i:0;s:5:\"ratio\";i:0;s:9:\"available\";i:0;s:15:\"allowexchangein\";i:0;s:16:\"allowexchangeout\";i:0;}i:5;a:8:{s:5:\"title\";s:0:\"\";s:4:\"unit\";i:0;s:11:\"initcredits\";i:0;s:10:\"lowerlimit\";i:0;s:5:\"ratio\";i:0;s:9:\"available\";i:0;s:15:\"allowexchangein\";i:0;s:16:\"allowexchangeout\";i:0;}i:6;a:8:{s:5:\"title\";s:0:\"\";s:4:\"unit\";i:0;s:11:\"initcredits\";i:0;s:10:\"lowerlimit\";i:0;s:5:\"ratio\";i:0;s:9:\"available\";i:0;s:15:\"allowexchangein\";i:0;s:16:\"allowexchangeout\";i:0;}i:7;a:8:{s:5:\"title\";s:0:\"\";s:4:\"unit\";i:0;s:11:\"initcredits\";i:0;s:10:\"lowerlimit\";i:0;s:5:\"ratio\";i:0;s:9:\"available\";i:0;s:15:\"allowexchangein\";i:0;s:16:\"allowexchangeout\";i:0;}i:8;a:8:{s:5:\"title\";s:0:\"\";s:4:\"unit\";i:0;s:11:\"initcredits\";i:0;s:10:\"lowerlimit\";i:0;s:5:\"ratio\";i:0;s:9:\"available\";i:0;s:15:\"allowexchangein\";i:0;s:16:\"allowexchangeout\";i:0;}}');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('credit_stax','0.2');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('exchange_mincredits','100');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('transfermin_credits','1000');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('time_format','Y-m-d');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('date_convert','1');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('site_logo','');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('seccode_register_status','0');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('seccode_login_status','0');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('seccode_changepassword_status','0');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('seccode_changeinformation_status','0');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('seccode_publish_status','0');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('flood_ctrl','15');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('need_email','0');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('need_avatar','0');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('need_friendnum','');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('remember_time','604800');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('front_style_id','1');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('admin_theme_name','Default');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('admin_theme_list_num','6');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('needforbug_program_company','点牛(成都)');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('image_max_width','800');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('slide_duration','0.3');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('slide_delay','5');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('mail_default','635750556@qq.com');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('mail_sendtype','2');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('mail_server','smtp.qq.com');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('mail_port','25');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('mail_auth','1');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('mail_from','635750556@qq.com');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('mail_auth_username','635750556');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('mail_auth_password','microlog1990');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('mail_delimiter','1');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('programeupdate_on','1');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('mail_testmessage_backup','这是系统发出的一封用于测试邮件是否设置成功的测试邮件。\r\n{time}\r\n\r\n-----------------------------------------------------\r\n消息来源：{site_name}\r\n站点网址：{site_url}');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('mail_testsubject_backup','尊敬的{user_name}：{site_name}系统测试邮件发送成功');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('mail_testmessage','这是系统发出的一封用于测试邮件是否设置成功的测试邮件。\r\n{time}\r\n\r\n-----------------------------------------------------\r\n消息来源：{site_name}\r\n站点网址：{site_url}');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('mail_testsubject','尊敬的{user_name}：{site_name}系统测试邮件发送成功');
INSERT INTO `needforbug_option` (`option_name`,`option_value`) VALUES ('getpassword_expired','36000');
DROP TABLE IF EXISTS `needforbug_pm`;
CREATE TABLE `needforbug_pm` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('1','admin','1','16','1','','1342430694','sdfffffffffffffffffffffffffffffffffff','1','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('2','admin','1','16','1','','1342430841','sdfffffffffffffffffffffffffffffffffff说的方法','1','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('3','admin','1','16','1','','1342430858','的方式硕鼠硕鼠','1','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('24','xiaomage','6','1','1','哈哈，欢迎来打酱油哈哈','1342680012','你今天有空咩有啊，我特别想见见你啊','1','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('50','admin','1','6','1','','1342688234','哈哈，我又来了哈','0','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('22','xiaomage','6','1','1','','1342669438','小马哥，哈哈哦啊哈哈','1','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('11','admin','1','6','1','我是小牛个','1342583612','小马哥最近可好','0','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('12','xiaomage','6','1','1','一般般','1342584005','现在都是马马虎虎，希望你过得可以啊哈','1','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('13','xiaomage','6','1','1','一般般','1342584023','现在都是马马虎虎，希望你过得可以啊哈','1','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('14','xiaomage','6','1','1','fds','1342584087','ssssssssss','1','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('15','xiaomage','6','1','1','那可以嘛','1342584180','好久回家来呢？','1','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('16','xiaomage','6','1','1','','1342594530','我是小马哥','1','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('17','admin','1','6','1','','1342595794','发件人:xiaomage\n收件人:admin\n日期:2012-07-18 14:55:30\n\n[quote]我是小马哥[/quote]\n\nfsdf','0','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('18','admin','1','6','1','','1342598672','呵呵','0','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('23','admin','1','6','1','1234','1342670691','小马哥，我是来打酱油的','0','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('21','admin','1','0','1','关于日本进攻的故事','1342659275','欢迎大家今天晚上准时收听哈。','1','1','admin','system');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('20','admin','1','0','1','是地方','1342603333','反反复复反反复复反反复复反反复复反反复复反反复复飞飞飞','1','1','admin','system');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('25','xiaomage','6','1','1','','1342680144','谢谢关心','1','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('26','xiaomage','6','1','1','','1342680199','今天，我们在火车北站见面，不见不散啊。','1','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('27','xiaomage','6','1','1','','1342680277','运气好','1','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('28','xiaomage','6','1','1','','1342681305','fdsssss','1','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('29','xiaomage','6','1','1','','1342681358','sdfffffff','1','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('30','admin','1','6','1','我是小牛哥','1342681646','发件人:xiaomage\n收件人:admin\n日期:2012-07-19 15:02:38\n\n[quote]sdfffffff[/quote]','0','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('31','xiaomage','6','1','1','','1342681942','dfssssssss','1','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('32','xiaomage','6','1','1','','1342682043','fdssssss','1','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('33','xiaomage','6','1','1','','1342682129','fds','1','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('34','xiaomage','6','1','1','','1342682269','fdsssssssss','1','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('35','xiaomage','6','1','1','','1342682476','dsfsf','1','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('36','xiaomage','6','1','1','','1342682536','fdsssssssssss','1','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('37','xiaomage','6','1','1','','1342682633','fdssssss','1','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('38','xiaomage','6','1','1','','1342682658','dfsssssssssssssssss','1','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('39','xiaomage','6','1','1','','1342682876','fsddddddd','1','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('40','xiaomage','6','1','1','','1342682917','测试一下爱','1','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('41','xiaomage','6','1','1','','1342682933','哈哈','1','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('42','xiaomage','6','1','1','','1342683027','你个瓜','1','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('43','xiaomage','6','1','1','','1342683092','的方式硕鼠硕鼠搜索','1','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('44','xiaomage','6','1','1','','1342683109','dfssssssss','1','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('45','xiaomage','6','1','1','','1342683153','谢谢你的爱','1','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('46','xiaomage','6','1','1','','1342683236','fdsssssssss','1','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('47','xiaomage','6','1','1','','1342683288','fsddddddd','1','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('48','xiaomage','6','1','1','','1342683324','fdsssssssssssssssssssssssssssssssssssssssssssssssssss','1','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('49','xiaomage','6','1','1','','1342683371','不错哈，哈哈哈','1','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('51','woshihapi','16','6','1','','1342689220','小马哥，别来无恙啊','0','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('52','xiaomage','6','1','1','','1342689641','小牛哥，欢迎光临哈，哈哈','1','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('53','admin','1','0','1','','1342691166','发送系统短消息测试一下','1','1','admin','system');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('54','admin','1','0','1','','1342691185','分身乏术','1','1','admin','system');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('55','admin','1','6','1','','1342833602','[pm]发件人:xiaomage\n收件人:admin\n日期:2012-07-19 17:20\n\n[quote]小牛哥，欢迎光临哈，哈哈[/quote][/pm]','0','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('56','admin','1','6','1','','1342833723','[pm]\n发件人:xiaomage\n收件人:admin\n日期:2012-07-19 17:20\n\n[quote]小牛哥，欢迎光临哈，哈哈[/quote]\n[/pm]\n你是一个很特别的人，我非常喜欢','0','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('57','admin','1','6','1','','1342841012','[pm]发件人:xiaomage\n收件人:admin\n日期:2012-07-19 17:20\n\n[quote]小牛哥，欢迎光临哈，哈哈[/quote][/pm]\n你好可爱啊','0','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('58','admin','1','6','1','','1342841897','[pm]发件人:xiaomage\n收件人:admin\n日期:2012-07-19 17:20\n\n[quote]小牛哥，欢迎光临哈，哈哈[/quote][/pm]\n\n你好是地方','0','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('59','admin','1','6','1','','1342842451','[pm]153[/pm]\n\n是地方第三方杀毒','0','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('60','admin','1','6','1','','1342842486','[pmhe]1223[/pmhe]','0','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('65','xiaomage','6','1','1','兄弟，我是来测是的','1342853436','哈哈，是不是啊','1','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('61','admin','1','6','0','','1342843015','不错哈，我和好的','0','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('62','admin','1','6','0','','1342843164','dfssssssss','0','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('63','admin','1','6','1','','1342853043','[pm]发件人:xiaomage\n收件人:admin\n日期:2012-07-19 17:20\n\n[quote]小牛哥，欢迎光临哈，哈哈[/quote][/pm]\n你很好啊','0','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('64','xiaomage','6','1','0','','1342853072','[pm]发件人:admin\n收件人:xiaomage\n日期:2012-07-21 14:44\n\n[quote][pm]发件人:xiaomage\n收件人:admin\n日期:2012-07-19 17:20\n\n[quote]小牛哥，欢迎光临哈，哈哈[/quote][/pm]\n你很好啊[/quote][/pm]\ndsfffffffffffffffffff','0','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('66','admin','1','6','1','','1342854038','[pm]65[/pm]\n你好留住','0','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('76','admin','1','6','1','','1342856107','你真的很瓜也，哈哈 \n[hr][pm]65[/pm]\n哈哈，是不是啊','1','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('67','xiaomage','6','1','0','','1342854177','[pm]65[/pm]\n你好留住\n[pm]66[/pm]\n呵呵，你们还不错啊。。过得这么好。呵呵','0','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('68','xiaomage','6','1','0','','1342854705','[pm]65[/pm]\n你好留住\n[pm]66[/pm]\n呵呵，你们还不错啊。。过得这么好。呵呵\n[pm]67[/pm]\n我差啊。。。还不赖哦。。。。。','0','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('69','xiaomage','6','1','0','','1342854844','[pm]65[/pm]\n你好留住\n[pm]66[/pm]\n呵呵，你们还不错啊。。过得这么好。呵呵\n[pm]67[/pm][br]\n\n可以，谢谢大家的光临','0','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('70','xiaomage','6','1','0','','1342854913','[pm]65[/pm]\n你好留住\n[pm]66[/pm]\n呵呵，你们还不错啊。。过得这么好。呵呵\n[pm]67[/pm][br]\n\n可以，谢谢大家的光临\n[pm]69[/pm]\n[hr]\n\n哈哈，可以恩，来吧','0','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('71','xiaomage','6','1','0','','1342855000','[pm]65[/pm]\n你好留住\n[pm]66[/pm]\n呵呵，你们还不错啊。。过得这么好。呵呵\n[pm]67[/pm][br]\n\n可以，谢谢大家的光临\n[pm]69[/pm]\n[hr]\n\n哈哈，可以恩，来吧\n[pm]70[/pm]\n[hr],设不了了','0','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('72','xiaomage','6','1','0','','1342855069','[pm]65[/pm]\n你好留住\n[pm]66[/pm][hr]\n你好斯蒂芬斯蒂芬','0','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('73','xiaomage','6','1','0','','1342855096','[pm]65[/pm]\n你好留住\n[pm]66[/pm][hr]\n你好斯蒂芬斯蒂芬\n[pm]72[/pm][hr]\n你可以啊。。。','0','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('74','xiaomage','6','1','0','','1342855564','哈哈，路过啊。。。\n[pm]73[/pm][hr]\n[pm]65[/pm]\n你好留住\n[pm]66[/pm][hr]\n你好斯蒂芬斯蒂芬\n[pm]72[/pm][hr]\n你可以啊。。。','0','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('75','xiaomage','6','1','0','','1342855941','sadasd\n[hr][pm]74[/pm][hr]\n哈哈，路过啊。。。\n[pm]73[/pm][hr]\n[pm]65[/pm]\n你好留住\n[pm]66[/pm][hr]\n你好斯蒂芬斯蒂芬\n[pm]72[/pm]\n你可以啊。。。','0','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('77','admin','1','6','1','','1342856159','我X，也是一般瓜嘛，你要不要来这里看看嘛，我了歌曲。\n[hr][pm]76[/pm]\n你真的很瓜也，哈哈 \n[hr][pm]65[/pm]\n哈哈，是不是啊','1','0','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('78','admin','1','0','1','','1342856499','不错啊','1','0','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('79','admin','1','6','1','','1342859436','共同短消息，哈哈\n[hr][pm]54[/pm]\n哈哈，是不是啊','1','0','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('80','admin','1','0','1','','1342864887','哈哈，路过','1','1','admin','system');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('81','admin','1','0','1','','1342865422','的风是地方','1','1','admin','system');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('82','admin','1','0','1','','1342884531','fdssssss','1','1','admin','system');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('83','admin','1','0','1','','1342886227','fsdsdsdsdsdsdsd','1','1','admin','system');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('84','admin','1','0','1','','1342888615','阿斯达','1','1','admin','system');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('85','xiaomage','6','1','1','小牛哥有什么事啊','1342888878','哈哈，欢迎您来到我们的地方 \n[hr][pm]79[/pm]\n共同短消息，哈哈\n[hr][pm]54[/pm]\n哈哈，是不是啊','1','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('86','xiaomage','6','1','1','','1342888946','也没有什么的事，只是想起了老朋友了哈 \n[hr][pm]77[/pm]\n我X，也是一般瓜嘛，你要不要来这里看看嘛，我了歌曲。\n[hr][pm]76[/pm]\n你真的很瓜也，哈哈 \n[hr][pm]65[/pm]\n哈哈，是不是啊','1','1','home','user');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('87','admin','1','0','1','','1342970310','df','1','1','admin','system');
INSERT INTO `needforbug_pm` (`pm_id`,`pm_msgfrom`,`pm_msgfromid`,`pm_msgtoid`,`pm_isread`,`pm_subject`,`create_dateline`,`pm_message`,`pm_status`,`pm_mystatus`,`pm_fromapp`,`pm_type`) VALUES ('89','xiaomage','6','1','1','','1345265300','dfssssssss','0','1','home','user');
DROP TABLE IF EXISTS `needforbug_pmsystemdelete`;
CREATE TABLE `needforbug_pmsystemdelete` (
  `user_id` int(10) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `pm_id` int(10) NOT NULL COMMENT '系统短消息删除状态',
  PRIMARY KEY (`user_id`,`pm_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `needforbug_pmsystemdelete` (`user_id`,`pm_id`) VALUES ('1','82');
INSERT INTO `needforbug_pmsystemdelete` (`user_id`,`pm_id`) VALUES ('1','87');
DROP TABLE IF EXISTS `needforbug_pmsystemread`;
CREATE TABLE `needforbug_pmsystemread` (
  `user_id` int(10) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `pm_id` int(10) NOT NULL COMMENT '系统短消息阅读状态',
  PRIMARY KEY (`user_id`,`pm_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `needforbug_pmsystemread` (`user_id`,`pm_id`) VALUES ('1','20');
INSERT INTO `needforbug_pmsystemread` (`user_id`,`pm_id`) VALUES ('1','21');
INSERT INTO `needforbug_pmsystemread` (`user_id`,`pm_id`) VALUES ('1','53');
INSERT INTO `needforbug_pmsystemread` (`user_id`,`pm_id`) VALUES ('1','54');
INSERT INTO `needforbug_pmsystemread` (`user_id`,`pm_id`) VALUES ('1','80');
INSERT INTO `needforbug_pmsystemread` (`user_id`,`pm_id`) VALUES ('1','81');
INSERT INTO `needforbug_pmsystemread` (`user_id`,`pm_id`) VALUES ('1','83');
INSERT INTO `needforbug_pmsystemread` (`user_id`,`pm_id`) VALUES ('1','84');
INSERT INTO `needforbug_pmsystemread` (`user_id`,`pm_id`) VALUES ('1','87');
DROP TABLE IF EXISTS `needforbug_rating`;
CREATE TABLE `needforbug_rating` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('1','列兵1','','','1295530584','1343975315','0','456','1');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('2','列兵2','',NULL,'1295530598','1338883899','457','912','1');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('3','三等兵','',NULL,'1338403516','1338883899','913','1824','1');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('4','二等兵','',NULL,'1338403530','1338883899','1825','3192','1');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('5','一等兵','',NULL,'1338403560','1338883899','3193','5016','1');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('6','上等兵1','','','1338403581','1343585557','5017','7296','1');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('7','上等兵2','',NULL,'1338403594','1338883899','7297','10032','1');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('8','上等兵3','',NULL,'1338403607','1338883899','10033','13224','1');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('9','上等兵4','',NULL,'1338403619','1338883899','13225','17784','1');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('10','下士1','',NULL,'1338403651','1338883914','17785','23940','2');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('11','下士2','',NULL,'1338403666','1338883914','23941','33060','2');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('12','下士3','',NULL,'1338403687','1338883914','33061','43092','2');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('13','下士4','',NULL,'1338403899','1338883914','43093','54036','2');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('14','下士5','',NULL,'1338403918','1338883914','54037','65892','2');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('15','下士6','',NULL,'1338403930','1338883914','65893','78660','2');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('16','中士1','',NULL,'1338403954','1338883933','78661','92340','2');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('17','中士2','',NULL,'1338403968','1338883933','92341','106932','2');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('18','中士3','',NULL,'1338403981','1338883933','106933','122436','2');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('19','中士4','',NULL,'1338403990','1338883933','122437','138852','2');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('20','中士5','',NULL,'1338404001','1338883933','138853','156180','2');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('21','中士6','',NULL,'1338404013','1338883933','156181','174420','2');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('22','上士1','',NULL,'1338404041','1338883933','174421','193572','2');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('23','上士2','',NULL,'1338404058','1338883933','193573','213636','2');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('24','上士3','',NULL,'1338404071','1338883933','213637','234612','2');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('25','上士4','',NULL,'1338404082','1338883933','234613','256500','2');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('26','上士5','',NULL,'1338404097','1338883933','256501','279300','2');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('27','上士6','',NULL,'1338404108','1338883933','279301','326724','2');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('28','少尉1','',NULL,'1338404133','1338883941','326725','375972','3');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('29','少尉2','',NULL,'1338404143','1338883941','375973','427044','3');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('30','少尉3','',NULL,'1338404220','1338883941','427045','479940','3');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('31','少尉4','',NULL,'1338404235','1338883951','479941','534660','3');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('32','少尉5','',NULL,'1338404246','1338883951','534661','591204','3');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('33','少尉6','',NULL,'1338404257','1338883951','591205','649572','3');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('34','少尉7','',NULL,'1338404267','1338883951','649573','709764','3');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('35','少尉8','',NULL,'1338404277','1338883951','709765','771780','3');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('36','中尉1','',NULL,'1338404291','1338883951','771781','835620','3');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('37','中尉2','',NULL,'1338404309','1338883951','835621','901284','3');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('38','中尉3','',NULL,'1338404319','1338883951','901285','968772','3');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('39','中尉4','',NULL,'1338404330','1338883951','968773','1038084','3');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('40','中尉5','',NULL,'1338404341','1338883951','103885','1109220','3');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('41','中尉6','',NULL,'1338404353','1338883951','1109221','1182180','3');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('42','中尉7','',NULL,'1338404367','1338883951','1182181','1256964','3');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('43','中尉8','',NULL,'1338404376','1338883951','1256965','1333572','3');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('44','上尉1','',NULL,'1338404398','1338883951','1333573','1412004','3');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('45','上尉2','',NULL,'1338404409','1338883951','1412005','1492260','3');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('46','上尉3','',NULL,'1338404419','1338883974','1492261','1574340','3');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('47','上尉4','',NULL,'1338404430','1338883974','1574341','1658244','3');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('48','上尉5','',NULL,'1338404445','1338883974','1658245','1743927','3');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('49','上尉6','',NULL,'1338404456','1338883974','1743973','1831524','3');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('50','上尉7','',NULL,'1338404465','1338883974','1831525','1920900','3');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('51','上尉8','',NULL,'1338404474','1338883974','1920901','2057700','3');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('52','少校1','',NULL,'1338404505','1338883988','2057701','2197236','4');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('53','少校2','',NULL,'1338404519','1338883988','2197237','2339508','4');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('54','少校3','',NULL,'1338404526','1338883988','2338509','2484516','4');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('55','少校4','',NULL,'1338404531','1338883988','2484517','2632260','4');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('56','少校5','',NULL,'1338404539','1338883988','2632261','2782740','4');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('57','少校6','',NULL,'1338404547','1338883988','2782741','2935956','4');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('58','少校7','',NULL,'1338404554','1338883988','2935957','3091908','4');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('59','少校8','',NULL,'1338404569','1338883988','3091909','3277044','4');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('60','中校1','',NULL,'1338404584','1338883988','3277045','3465372','4');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('61','中校2','',NULL,'1338404590','1338883996','3465373','3673536','4');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('62','中校3','',NULL,'1338404596','1338883996','3673573','3885177','4');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('63','中校4','',NULL,'1338404604','1338883996','3885178','4100295','4');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('64','中校5','',NULL,'1338404616','1338883996','4100296','4318890','4');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('65','中校6','',NULL,'1338404625','1338883996','4318891','4540962','4');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('66','中校7','',NULL,'1338404639','1338883996','4540963','4766511','4');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('67','中校8','',NULL,'1338404657','1338883996','4766512','5028198','4');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('68','上校1','',NULL,'1338404747','1338883996','5028199','5319183','4');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('69','上校2','',NULL,'1338404756','1338883996','5139184','5614500','4');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('70','上校3','',NULL,'1338404764','1338883996','5614501','5914149','4');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('71','上校4','',NULL,'1338404773','1338883996','5914150','6218130','4');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('72','上校5','',NULL,'1338404782','1338883996','6218131','6526500','4');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('73','上校6','',NULL,'1338404792','1338883996','6526501','6839202','4');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('74','上校7','',NULL,'1338404801','1338883996','6839203','7156236','4');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('75','上校8','',NULL,'1338404809','1338883996','7156237','7578036','4');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('76','大校1','',NULL,'1338404887','1338884031','7578037','8026911','4');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('77','大校2','',NULL,'1338404897','1338884031','8026912','8481771','4');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('78','大校3','',NULL,'1338404907','1338884031','8481772','8964561','4');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('79','大校4','',NULL,'1338404944','1338884031','8964562','9475851','4');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('80','大校5','',NULL,'1338404953','1338884031','9475852','10016211','4');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('81','大校6','',NULL,'1338404963','1338884031','10016212','10586211','4');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('82','少将1','',NULL,'1338404977','1338884047','10586212','11186421','5');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('83','少将2','',NULL,'1338404986','1338884047','11186422','11817411','5');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('84','少将3','',NULL,'1338404993','1338884047','11817412','12479751','5');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('85','少将4','',NULL,'1338405001','1338884047','12479752','13174011','5');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('86','少将5','',NULL,'1338405009','1338884047','13174012','13900761','5');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('87','少将6','',NULL,'1338405017','1338884047','13900762','14460571','5');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('88','中将1','',NULL,'1338405031','1338884047','14460572','15454011','5');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('89','中将2','',NULL,'1338405040','1338884047','15454012','16281651','5');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('90','中将3','',NULL,'1338405055','1338884047','16281652','17144061','5');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('91','中将4','',NULL,'1338405065','1338884056','17144062','18041811','5');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('92','中将5','',NULL,'1338405075','1338884056','18041812','18975471','5');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('93','中将6','',NULL,'1338405086','1338884056','18975472','19945611','5');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('94','上将1','',NULL,'1338405099','1338884056','19945612','20952801','5');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('95','上将2','',NULL,'1338405108','1338884056','20952802','21997611','5');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('96','上将3','',NULL,'1338405117','1338884056','21997612','23080611','5');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('97','上将4','',NULL,'1338405131','1338884056','23080612','24202371','5');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('98','上将5','',NULL,'1338405140','1338884056','24202372','25363461','5');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('99','上将6','',NULL,'1338405149','1338884056','25363462','26564451','5');
INSERT INTO `needforbug_rating` (`rating_id`,`rating_name`,`rating_remark`,`rating_nikename`,`create_dateline`,`update_dateline`,`rating_creditstart`,`rating_creditend`,`ratinggroup_id`) VALUES ('100','元帅','',NULL,'1338405163','1338884056','26564452','26564452','5');
DROP TABLE IF EXISTS `needforbug_ratinggroup`;
CREATE TABLE `needforbug_ratinggroup` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `needforbug_ratinggroup` (`ratinggroup_id`,`ratinggroup_name`,`ratinggroup_title`,`create_dateline`,`update_dateline`,`ratinggroup_status`,`ratinggroup_sort`) VALUES ('1','soldiers','士兵','1338469985','0','1','0');
INSERT INTO `needforbug_ratinggroup` (`ratinggroup_id`,`ratinggroup_name`,`ratinggroup_title`,`create_dateline`,`update_dateline`,`ratinggroup_status`,`ratinggroup_sort`) VALUES ('2','nco','士官','1338470021','0','1','0');
INSERT INTO `needforbug_ratinggroup` (`ratinggroup_id`,`ratinggroup_name`,`ratinggroup_title`,`create_dateline`,`update_dateline`,`ratinggroup_status`,`ratinggroup_sort`) VALUES ('3','lieutenant','尉官','1338470314','1343585867','1','0');
INSERT INTO `needforbug_ratinggroup` (`ratinggroup_id`,`ratinggroup_name`,`ratinggroup_title`,`create_dateline`,`update_dateline`,`ratinggroup_status`,`ratinggroup_sort`) VALUES ('4','colonel','校官','1338470412','0','1','0');
INSERT INTO `needforbug_ratinggroup` (`ratinggroup_id`,`ratinggroup_name`,`ratinggroup_title`,`create_dateline`,`update_dateline`,`ratinggroup_status`,`ratinggroup_sort`) VALUES ('5','generals','将帅','1338470428','1338914433','1','0');
DROP TABLE IF EXISTS `needforbug_role`;
CREATE TABLE `needforbug_role` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `needforbug_role` (`role_id`,`role_name`,`role_parentid`,`role_status`,`role_remark`,`role_nikename`,`create_dateline`,`update_dateline`,`rolegroup_id`) VALUES ('1','管理员','0','1','','管理员','1295530584','1338614986','2');
INSERT INTO `needforbug_role` (`role_id`,`role_name`,`role_parentid`,`role_status`,`role_remark`,`role_nikename`,`create_dateline`,`update_dateline`,`rolegroup_id`) VALUES ('2','超级群主','0','1','','超级群主','1295530598','1338615068','2');
INSERT INTO `needforbug_role` (`role_id`,`role_name`,`role_parentid`,`role_status`,`role_remark`,`role_nikename`,`create_dateline`,`update_dateline`,`rolegroup_id`) VALUES ('3','群主','0','1','','群主','1338403516','1338615084','2');
INSERT INTO `needforbug_role` (`role_id`,`role_name`,`role_parentid`,`role_status`,`role_remark`,`role_nikename`,`create_dateline`,`update_dateline`,`rolegroup_id`) VALUES ('4','禁止发言','0','1','','禁止发言','1338403530','1338615129','3');
INSERT INTO `needforbug_role` (`role_id`,`role_name`,`role_parentid`,`role_status`,`role_remark`,`role_nikename`,`create_dateline`,`update_dateline`,`rolegroup_id`) VALUES ('5','禁止访问','0','1','','禁止访问','1338403560','1338615291','3');
INSERT INTO `needforbug_role` (`role_id`,`role_name`,`role_parentid`,`role_status`,`role_remark`,`role_nikename`,`create_dateline`,`update_dateline`,`rolegroup_id`) VALUES ('6','禁止IP','0','1','','禁止IP','1338403581','1338615314','3');
INSERT INTO `needforbug_role` (`role_id`,`role_name`,`role_parentid`,`role_status`,`role_remark`,`role_nikename`,`create_dateline`,`update_dateline`,`rolegroup_id`) VALUES ('7','游客','0','1','','游客','1338403594','1338615517','3');
INSERT INTO `needforbug_role` (`role_id`,`role_name`,`role_parentid`,`role_status`,`role_remark`,`role_nikename`,`create_dateline`,`update_dateline`,`rolegroup_id`) VALUES ('8','等待验证会员','0','1','','等待验证会员','1338403607','1338615543','3');
INSERT INTO `needforbug_role` (`role_id`,`role_name`,`role_parentid`,`role_status`,`role_remark`,`role_nikename`,`create_dateline`,`update_dateline`,`rolegroup_id`) VALUES ('9','限制会员','0','1','','限制会员','1338403619','1338615581','1');
INSERT INTO `needforbug_role` (`role_id`,`role_name`,`role_parentid`,`role_status`,`role_remark`,`role_nikename`,`create_dateline`,`update_dateline`,`rolegroup_id`) VALUES ('10','新手上路','0','1','','新手上路','1338403651','1338615675','1');
INSERT INTO `needforbug_role` (`role_id`,`role_name`,`role_parentid`,`role_status`,`role_remark`,`role_nikename`,`create_dateline`,`update_dateline`,`rolegroup_id`) VALUES ('11','注册会员','0','1','','注册会员','1338403666','1338615675','1');
INSERT INTO `needforbug_role` (`role_id`,`role_name`,`role_parentid`,`role_status`,`role_remark`,`role_nikename`,`create_dateline`,`update_dateline`,`rolegroup_id`) VALUES ('12','中级会员','0','1','','中级会员','1338403687','1338615658','1');
INSERT INTO `needforbug_role` (`role_id`,`role_name`,`role_parentid`,`role_status`,`role_remark`,`role_nikename`,`create_dateline`,`update_dateline`,`rolegroup_id`) VALUES ('13','高级会员','0','1','','高级会员','1338403899','1339179947','1');
INSERT INTO `needforbug_role` (`role_id`,`role_name`,`role_parentid`,`role_status`,`role_remark`,`role_nikename`,`create_dateline`,`update_dateline`,`rolegroup_id`) VALUES ('14','金牌会员','0','1','','金牌会员','1338403918','1338615739','1');
INSERT INTO `needforbug_role` (`role_id`,`role_name`,`role_parentid`,`role_status`,`role_remark`,`role_nikename`,`create_dateline`,`update_dateline`,`rolegroup_id`) VALUES ('15','社区元老','0','1','','社区元老','1338403930','1338615780','1');
INSERT INTO `needforbug_role` (`role_id`,`role_name`,`role_parentid`,`role_status`,`role_remark`,`role_nikename`,`create_dateline`,`update_dateline`,`rolegroup_id`) VALUES ('16','信息监察员','0','1','','信息监察员','1338403954','1338615905','2');
INSERT INTO `needforbug_role` (`role_id`,`role_name`,`role_parentid`,`role_status`,`role_remark`,`role_nikename`,`create_dateline`,`update_dateline`,`rolegroup_id`) VALUES ('17','网站编辑','0','1','','网站编辑','1338403968','1338615931','2');
INSERT INTO `needforbug_role` (`role_id`,`role_name`,`role_parentid`,`role_status`,`role_remark`,`role_nikename`,`create_dateline`,`update_dateline`,`rolegroup_id`) VALUES ('18','审核员','0','1','','审核员','1338403981','1338615954','2');
INSERT INTO `needforbug_role` (`role_id`,`role_name`,`role_parentid`,`role_status`,`role_remark`,`role_nikename`,`create_dateline`,`update_dateline`,`rolegroup_id`) VALUES ('19','实习群主','0','1','','实习群主','1338403990','1339403991','2');
DROP TABLE IF EXISTS `needforbug_rolegroup`;
CREATE TABLE `needforbug_rolegroup` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `needforbug_rolegroup` (`rolegroup_id`,`rolegroup_name`,`rolegroup_title`,`create_dateline`,`update_dateline`,`rolegroup_status`,`rolegroup_sort`) VALUES ('1','usergroup','用户组','1338469985','1338614736','1','0');
INSERT INTO `needforbug_rolegroup` (`rolegroup_id`,`rolegroup_name`,`rolegroup_title`,`create_dateline`,`update_dateline`,`rolegroup_status`,`rolegroup_sort`) VALUES ('2','admingroup','管理组','1338470021','1338614767','1','0');
INSERT INTO `needforbug_rolegroup` (`rolegroup_id`,`rolegroup_name`,`rolegroup_title`,`create_dateline`,`update_dateline`,`rolegroup_status`,`rolegroup_sort`) VALUES ('3','specialgroup','特殊分组','1338470314','1338615164','1','0');
INSERT INTO `needforbug_rolegroup` (`rolegroup_id`,`rolegroup_name`,`rolegroup_title`,`create_dateline`,`update_dateline`,`rolegroup_status`,`rolegroup_sort`) VALUES ('4','customgroup','自定义','1338616034','0','1','0');
DROP TABLE IF EXISTS `needforbug_session`;
CREATE TABLE `needforbug_session` (
  `session_hash` varchar(6) NOT NULL COMMENT 'HASH',
  `session_auth_key` varchar(32) NOT NULL COMMENT 'AUTH_KEY',
  `user_id` mediumint(8) NOT NULL COMMENT '用户ID',
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `needforbug_session` (`session_hash`,`session_auth_key`,`user_id`) VALUES ('4f6b64','376ed7d51614767e76ba22d7637b1ece','1');
DROP TABLE IF EXISTS `needforbug_slide`;
CREATE TABLE `needforbug_slide` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `needforbug_slide` (`slide_id`,`slide_sort`,`slide_title`,`slide_url`,`slide_img`,`slide_status`,`create_dateline`,`update_dateline`) VALUES ('1','0','欢迎加入','{Dyhb::U(\'home://public/register\')}','{__PUBLIC__.\'/images/common/slidebox/1.jpg\'}','1','1345357086','1345364471');
INSERT INTO `needforbug_slide` (`slide_id`,`slide_sort`,`slide_title`,`slide_url`,`slide_img`,`slide_status`,`create_dateline`,`update_dateline`) VALUES ('2','0','立刻登录','{Dyhb::U(\'home://public/login\')}','{__PUBLIC__.\'/images/common/slidebox/2.jpg\'}','1','1345357086','0');
INSERT INTO `needforbug_slide` (`slide_id`,`slide_sort`,`slide_title`,`slide_url`,`slide_img`,`slide_status`,`create_dateline`,`update_dateline`) VALUES ('3','0','关于我们','{Dyhb::U(\'home://public/aboutus\')}','{__PUBLIC__.\'/images/common/slidebox/3.jpg\'}','1','1345357086','0');
DROP TABLE IF EXISTS `needforbug_style`;
CREATE TABLE `needforbug_style` (
  `style_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '主题样式ID',
  `style_name` varchar(32) NOT NULL DEFAULT '' COMMENT '主题样式名字',
  `style_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '主题样式状态',
  `theme_id` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '模板ID',
  `style_extend` varchar(320) NOT NULL DEFAULT '' COMMENT '主题样式扩展',
  PRIMARY KEY (`style_id`),
  KEY `theme_id` (`theme_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `needforbug_style` (`style_id`,`style_name`,`style_status`,`theme_id`,`style_extend`) VALUES ('1','默认主题','1','1','t1	t2	t3	t4	t5|t3');
INSERT INTO `needforbug_style` (`style_id`,`style_name`,`style_status`,`theme_id`,`style_extend`) VALUES ('32','默认主题_70FEa9','0','1','t1	t2	t3	t4	t5|t1');
DROP TABLE IF EXISTS `needforbug_stylevar`;
CREATE TABLE `needforbug_stylevar` (
  `stylevar_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '变量ID',
  `style_id` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '主题ID',
  `stylevar_variable` text NOT NULL COMMENT '变量名',
  `stylevar_substitute` text NOT NULL COMMENT '变量替换值',
  PRIMARY KEY (`stylevar_id`),
  KEY `style_id` (`style_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1','1','img_dir','');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('2','1','style_img_dir','');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('3','1','logo','logo.png');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('4','1','header_border_width','1px');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('5','1','header_border_color','#ebebeb');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('6','1','header_text_color','#333333');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('7','1','footer_text_color','#7B7B7B');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('8','1','normal_font','Verdana,Lucida Grande, Lucida Sans Unicode, Lucida Sans, Helvetica, Arial, sans-serif');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('9','1','normal_fontsize','13px/18px');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('10','1','small_font','Verdana,Lucida Grande, Lucida Sans Unicode, Lucida Sans, Helvetica, Arial, sans-serif');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('11','1','small_fontsize','0.83em');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('12','1','big_font','Verdana,Lucida Grande, Lucida Sans Unicode, Lucida Sans, Helvetica, Arial, sans-serif');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('13','1','big_fontsize','20px');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('14','1','normal_color','#333333');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('15','1','medium_textcolor','#333333');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('16','1','light_textcolor','#999999');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('17','1','link_color','#037c1d');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('18','1','highlightlink_color','#037c1d');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('19','1','wrap_table_width','960px');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('20','1','wrap_table_bg','#FFFFFF');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('21','1','wrap_border_width','1px');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('22','1','wrap_border_color','#FFFFFF');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('23','1','content_fontsize','14px');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('24','1','content_big_size','16px');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('25','1','content_width','600px');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('26','1','content_separate_color','#FFFFFF');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('27','1','menu_border_color','#eee');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('28','1','menu_text_color','#FFFFFF');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('29','1','menu_hover_bg_color','#378C32');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('30','1','menu_hover_text_color','#000000');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('31','1','input_border','#999999');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('32','1','input_border_dark_color','#61c361');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('33','1','input_bg','#FFFFFF');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('34','1','drop_menu_border','#1ABDE6');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('35','1','interval_line_color','#E6E7E1');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('36','1','common_background_color','#f1f1f1');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('37','1','special_border','#DEDEDE');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('38','1','special_bg','#2B91D5');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('39','1','interleave_color','#DEDEDE');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('40','1','noticetext_color','#FF3300');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('41','1','noticetext_border_color','');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('42','1','menu_bg_color','#52a452');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('43','1','menu_bg_img','');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('44','1','menu_bg_extra','');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('45','1','header_bg_color','#FFFFFF');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('46','1','header_bg_img','header_bg.png');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('47','1','header_bg_extra','repeat-x');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('48','1','side_bg_color','#FFFFFF');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('49','1','side_bg_img','');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('50','1','side_bg_extra','');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('51','1','bg_color','#FFFFFF');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('52','1','bg_img','bg.png');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('53','1','bg_extra','repeat');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('54','1','drop_menu_bg_color','#CCCCCC');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('55','1','drop_menu_bg_img','');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('56','1','drop_menu_bg_extra','repeat-x');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('57','1','footer_bg_color','');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('58','1','footer_bg_img','footer_bg.png');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('59','1','footer_bg_extra','repeat-x');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('60','1','float_bg_color','#FFFFFF');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('61','1','float_bg_img','');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('62','1','float_bg_extra','');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('63','1','float_mask_bg_color','#1ABDE6');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('64','1','float_mask_bg_img','');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('65','1','float_mask_bg_extra','');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1705','32','img_dir','');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1706','32','style_img_dir','');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1707','32','logo','logo.png');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1708','32','header_border_width','1px');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1709','32','header_border_color','#ebebeb');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1710','32','header_text_color','#333333');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1711','32','footer_text_color','#7B7B7B');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1712','32','normal_font','Verdana,Lucida Grande, Lucida Sans Unicode, Lucida Sans, Helvetica, Arial, sans-serif');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1713','32','normal_fontsize','13px/18px');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1714','32','small_font','Verdana,Lucida Grande, Lucida Sans Unicode, Lucida Sans, Helvetica, Arial, sans-serif');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1715','32','small_fontsize','0.83em');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1716','32','big_font','Verdana,Lucida Grande, Lucida Sans Unicode, Lucida Sans, Helvetica, Arial, sans-serif');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1717','32','big_fontsize','20px');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1718','32','normal_color','#333333');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1719','32','medium_textcolor','#333333');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1720','32','light_textcolor','#999999');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1721','32','link_color','#CC0081');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1722','32','highlightlink_color','#FFFF00');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1723','32','wrap_table_width','960px');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1724','32','wrap_table_bg','#FFFFFF');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1725','32','wrap_border_width','1px');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1726','32','wrap_border_color','#FFFFFF');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1727','32','content_fontsize','14px');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1728','32','content_big_size','16px');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1729','32','content_width','600px');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1730','32','content_separate_color','#FFFFFF');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1731','32','menu_border_color','#eee');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1732','32','menu_text_color','#FFFFFF');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1733','32','menu_hover_bg_color','#00FF81');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1734','32','menu_hover_text_color','#000000');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1735','32','input_border','#999999');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1736','32','input_border_dark_color','#61c361');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1737','32','input_bg','#FFFFFF');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1738','32','drop_menu_border','#1ABDE6');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1739','32','interval_line_color','#E6E7E1');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1740','32','common_background_color','#f1f1f1');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1741','32','special_border','#DEDEDE');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1742','32','special_bg','#2B91D5');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1743','32','interleave_color','#DEDEDE');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1744','32','noticetext_color','#FF3300');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1745','32','noticetext_border_color','');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1746','32','menu_bg_color','#00ACFF');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1747','32','menu_bg_img','');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1748','32','menu_bg_extra','');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1749','32','header_bg_color','#CC0081');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1750','32','header_bg_img','');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1751','32','header_bg_extra','');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1752','32','side_bg_color','#FFFFFF');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1753','32','side_bg_img','');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1754','32','side_bg_extra','');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1755','32','bg_color','#FFFFFF');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1756','32','bg_img','bg.png');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1757','32','bg_extra','repeat');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1758','32','drop_menu_bg_color','#CCCCCC');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1759','32','drop_menu_bg_img','');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1760','32','drop_menu_bg_extra','repeat-x');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1761','32','footer_bg_color','');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1762','32','footer_bg_img','footer_bg.png');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1763','32','footer_bg_extra','repeat-x');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1764','32','float_bg_color','#FFFFFF');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1765','32','float_bg_img','');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1766','32','float_bg_extra','');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1767','32','float_mask_bg_color','#1ABDE6');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1768','32','float_mask_bg_img','');
INSERT INTO `needforbug_stylevar` (`stylevar_id`,`style_id`,`stylevar_variable`,`stylevar_substitute`) VALUES ('1769','32','float_mask_bg_extra','');
DROP TABLE IF EXISTS `needforbug_syscache`;
CREATE TABLE `needforbug_syscache` (
  `syscache_name` varchar(32) NOT NULL COMMENT '缓存名字',
  `syscache_type` tinyint(3) unsigned NOT NULL COMMENT '缓存类型',
  `create_dateline` int(10) unsigned NOT NULL COMMENT '创建时间',
  `update_dateline` int(10) NOT NULL COMMENT '更新时间',
  `syscache_data` mediumblob NOT NULL COMMENT '缓存数据',
  PRIMARY KEY (`syscache_name`),
  KEY `create_dateline` (`create_dateline`),
  KEY `update_dateline` (`update_dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `needforbug_syscache` (`syscache_name`,`syscache_type`,`create_dateline`,`update_dateline`,`syscache_data`) VALUES ('nav','1','1345596184','1345709752','a:3:{s:4:\"main\";a:2:{i:0;a:6:{s:5:\"title\";s:6:\"小组\";s:11:\"description\";s:5:\"group\";s:4:\"link\";s:67:\"http://localhost/needforbug/upload/index.php/public/index/app/group\";s:5:\"style\";s:0:\"\";s:6:\"target\";s:0:\"\";s:3:\"sub\";a:0:{}}i:1;a:6:{s:5:\"title\";s:6:\"测试\";s:11:\"description\";s:6:\"测试\";s:4:\"link\";s:57:\"http://localhost/needforbug/upload/index.php/public/login\";s:5:\"style\";s:0:\"\";s:6:\"target\";s:0:\"\";s:3:\"sub\";a:0:{}}}s:6:\"header\";a:2:{i:0;a:6:{s:5:\"title\";s:12:\"设为首页\";s:11:\"description\";s:12:\"设为首页\";s:4:\"link\";s:18:\"javascript:void(0)\";s:5:\"style\";s:61:\" onclick=\"setHomepage(\'http://localhost/needforbug/upload\');\"\";s:6:\"target\";s:0:\"\";s:3:\"sub\";a:0:{}}i:1;a:6:{s:5:\"title\";s:12:\"加入收藏\";s:11:\"description\";s:12:\"加入收藏\";s:4:\"link\";s:34:\"http://localhost/needforbug/upload\";s:5:\"style\";s:60:\" onclick=\"addFavorite(this.href,\'NeedForBug\');return false;\"\";s:6:\"target\";s:0:\"\";s:3:\"sub\";a:0:{}}}s:6:\"footer\";a:5:{i:0;a:6:{s:5:\"title\";s:12:\"关于我们\";s:11:\"description\";s:12:\"关于我们\";s:4:\"link\";s:59:\"http://localhost/needforbug/upload/index.php/public/aboutus\";s:5:\"style\";s:0:\"\";s:6:\"target\";s:0:\"\";s:3:\"sub\";a:0:{}}i:1;a:6:{s:5:\"title\";s:12:\"联系我们\";s:11:\"description\";s:12:\"联系我们\";s:4:\"link\";s:61:\"http://localhost/needforbug/upload/index.php/public/contactus\";s:5:\"style\";s:0:\"\";s:6:\"target\";s:0:\"\";s:3:\"sub\";a:0:{}}i:2;a:6:{s:5:\"title\";s:12:\"用户协议\";s:11:\"description\";s:12:\"用户协议\";s:4:\"link\";s:61:\"http://localhost/needforbug/upload/index.php/public/agreement\";s:5:\"style\";s:0:\"\";s:6:\"target\";s:0:\"\";s:3:\"sub\";a:0:{}}i:3;a:6:{s:5:\"title\";s:12:\"隐私声明\";s:11:\"description\";s:12:\"隐私声明\";s:4:\"link\";s:59:\"http://localhost/needforbug/upload/index.php/public/privacy\";s:5:\"style\";s:0:\"\";s:6:\"target\";s:0:\"\";s:3:\"sub\";a:0:{}}i:4;a:6:{s:5:\"title\";s:6:\"帮助\";s:11:\"description\";s:6:\"帮助\";s:4:\"link\";s:56:\"http://localhost/needforbug/upload/index.php/public/help\";s:5:\"style\";s:0:\"\";s:6:\"target\";s:0:\"\";s:3:\"sub\";a:0:{}}}}');
INSERT INTO `needforbug_syscache` (`syscache_name`,`syscache_type`,`create_dateline`,`update_dateline`,`syscache_data`) VALUES ('home_option','1','1345596184','1345709752','a:9:{s:17:\"homehelp_list_num\";s:2:\"10\";s:18:\"homefresh_list_num\";s:2:\"15\";s:28:\"homefresh_list_substring_num\";s:3:\"500\";s:13:\"user_list_num\";s:2:\"10\";s:15:\"friend_list_num\";s:2:\"10\";s:19:\"my_friend_limit_num\";s:1:\"6\";s:11:\"pm_list_num\";s:1:\"5\";s:21:\"pm_list_substring_num\";s:3:\"200\";s:18:\"pm_single_list_num\";s:2:\"10\";}');
INSERT INTO `needforbug_syscache` (`syscache_name`,`syscache_type`,`create_dateline`,`update_dateline`,`syscache_data`) VALUES ('slide','1','1345596184','1345710729','a:3:{i:0;a:3:{s:11:\"slide_title\";s:12:\"欢迎加入\";s:9:\"slide_img\";s:70:\"http://localhost/needforbug/upload/Public/images/common/slidebox/1.jpg\";s:9:\"slide_url\";s:60:\"http://localhost/needforbug/upload/index.php/public/register\";}i:1;a:3:{s:11:\"slide_title\";s:12:\"立刻登录\";s:9:\"slide_img\";s:70:\"http://localhost/needforbug/upload/Public/images/common/slidebox/2.jpg\";s:9:\"slide_url\";s:57:\"http://localhost/needforbug/upload/index.php/public/login\";}i:2;a:3:{s:11:\"slide_title\";s:12:\"关于我们\";s:9:\"slide_img\";s:70:\"http://localhost/needforbug/upload/Public/images/common/slidebox/3.jpg\";s:9:\"slide_url\";s:59:\"http://localhost/needforbug/upload/index.php/public/aboutus\";}}');
INSERT INTO `needforbug_syscache` (`syscache_name`,`syscache_type`,`create_dateline`,`update_dateline`,`syscache_data`) VALUES ('link','1','1345596184','1345710729','a:3:{s:12:\"link_content\";s:511:\"<li><div class=\"home-content\"><h5><a href=\"探索网络水军\" target=\"_blank\">水军</a></h5><p>探索网络水军</p></div></li><li><div class=\"home-content\"><h5><a href=\"vps主机\" target=\"_blank\">vps主机</a></h5><p>Linux主机提供商</p></div></li><li><div class=\"home-content\"><h5><a href=\"http://admin5.com\" target=\"_blank\">A5源码</a></h5><p>下载最新源码</p></div></li><li><div class=\"home-content\"><h5><a href=\"\\/canphp.com\" target=\"_blank\">Canphp框架</a></h5><p>Canphp管网</p></div></li>\";s:9:\"link_text\";s:165:\"<li><a href=\"http://www.tvery.com/\" target=\"_blank\" title=\"听我网\">听我网</a></li><li><a href=\"http://baidu.com\" target=\"_blank\" title=\"百度\">百度</a></li>\";s:9:\"link_logo\";s:0:\"\";}');
INSERT INTO `needforbug_syscache` (`syscache_name`,`syscache_type`,`create_dateline`,`update_dateline`,`syscache_data`) VALUES ('site','1','1345596214','1345710822','a:4:{s:3:\"app\";s:1:\"2\";s:4:\"user\";s:2:\"19\";s:9:\"adminuser\";s:1:\"1\";s:7:\"newuser\";s:1:\"1\";}');
INSERT INTO `needforbug_syscache` (`syscache_name`,`syscache_type`,`create_dateline`,`update_dateline`,`syscache_data`) VALUES ('option','1','1345596237','1345709752','a:90:{s:14:\"admin_list_num\";s:2:\"15\";s:9:\"site_name\";s:10:\"NeedForBug\";s:16:\"site_description\";s:49:\"Enjoy Online Shopping.独属于我的社区购物\";s:8:\"site_url\";s:34:\"http://localhost/needforbug/upload\";s:10:\"close_site\";s:1:\"0\";s:17:\"close_site_reason\";s:9:\"update...\";s:10:\"start_gzip\";s:1:\"0\";s:10:\"timeoffset\";s:13:\"Asia/Shanghai\";s:18:\"uploadfile_maxsize\";s:2:\"-1\";s:17:\"upload_store_type\";s:3:\"day\";s:24:\"disallowed_register_user\";s:0:\"\";s:25:\"disallowed_register_email\";s:0:\"\";s:22:\"allowed_register_email\";s:0:\"\";s:14:\"audit_register\";s:1:\"0\";s:19:\"disallowed_register\";s:1:\"0\";s:3:\"icp\";s:18:\"蜀ICP备123456号\";s:16:\"home_description\";s:343:\"{site_name}是一个以电子商务和社区为核心的社区化电子商务（B2C）平台。在这里你可以向网友分享你的购物体验、你喜欢的商品以及心情等等，同时也可以从社区获取来自其它网友的超值的信息，我们崇尚的是理念：<span class=\"label label-success\">简单与分享</span>。\";s:11:\"admin_email\";s:15:\"admin@admin.com\";s:24:\"seccode_image_width_size\";s:3:\"160\";s:25:\"seccode_image_height_size\";s:2:\"60\";s:18:\"seccode_adulterate\";s:1:\"0\";s:11:\"seccode_ttf\";s:1:\"1\";s:12:\"seccode_tilt\";s:1:\"0\";s:13:\"seccode_color\";s:1:\"1\";s:12:\"seccode_size\";s:1:\"0\";s:14:\"seccode_shadow\";s:1:\"1\";s:16:\"seccode_animator\";s:1:\"0\";s:18:\"seccode_background\";s:1:\"1\";s:24:\"seccode_image_background\";s:1:\"1\";s:14:\"seccode_norise\";s:1:\"0\";s:13:\"seccode_curve\";s:1:\"1\";s:12:\"seccode_type\";s:1:\"1\";s:23:\"needforbug_program_name\";s:10:\"NeedForBug\";s:26:\"needforbug_program_version\";s:3:\"1.0\";s:23:\"needforbug_company_name\";s:12:\"Dianniu Inc.\";s:22:\"needforbug_company_url\";s:18:\"http://dianniu.net\";s:22:\"needforbug_program_url\";s:34:\"http://needforbug.doyouhaobaby.net\";s:23:\"needforbug_program_year\";s:4:\"2012\";s:23:\"needforbug_company_year\";s:9:\"2010-2012\";s:9:\"site_year\";s:4:\"2012\";s:9:\"stat_code\";s:0:\"\";s:10:\"badword_on\";s:1:\"0\";s:14:\"pmsend_regdays\";s:1:\"5\";s:14:\"pmlimit_oneday\";s:3:\"100\";s:12:\"pmflood_ctrl\";s:2:\"10\";s:9:\"pm_status\";s:1:\"1\";s:14:\"pmsend_seccode\";s:1:\"0\";s:11:\"pm_sound_on\";s:1:\"1\";s:13:\"pm_sound_type\";s:1:\"1\";s:16:\"pm_sound_out_url\";s:0:\"\";s:25:\"avatar_uploadfile_maxsize\";s:6:\"512000\";s:13:\"extend_credit\";s:1464:\"a:8:{i:1;a:8:{s:9:\"available\";i:1;s:5:\"title\";s:6:\"经验\";s:4:\"unit\";i:0;s:11:\"initcredits\";i:0;s:10:\"lowerlimit\";i:0;s:15:\"allowexchangein\";i:0;s:16:\"allowexchangeout\";i:0;s:5:\"ratio\";i:0;}i:2;a:8:{s:9:\"available\";i:1;s:5:\"title\";s:6:\"金币\";s:4:\"unit\";i:0;s:11:\"initcredits\";i:0;s:10:\"lowerlimit\";i:0;s:15:\"allowexchangein\";i:0;s:16:\"allowexchangeout\";i:0;s:5:\"ratio\";i:0;}i:3;a:8:{s:9:\"available\";i:1;s:5:\"title\";s:6:\"贡献\";s:4:\"unit\";i:0;s:11:\"initcredits\";i:0;s:10:\"lowerlimit\";i:0;s:15:\"allowexchangein\";i:0;s:16:\"allowexchangeout\";i:0;s:5:\"ratio\";i:0;}i:4;a:8:{s:5:\"title\";s:0:\"\";s:4:\"unit\";i:0;s:11:\"initcredits\";i:0;s:10:\"lowerlimit\";i:0;s:5:\"ratio\";i:0;s:9:\"available\";i:0;s:15:\"allowexchangein\";i:0;s:16:\"allowexchangeout\";i:0;}i:5;a:8:{s:5:\"title\";s:0:\"\";s:4:\"unit\";i:0;s:11:\"initcredits\";i:0;s:10:\"lowerlimit\";i:0;s:5:\"ratio\";i:0;s:9:\"available\";i:0;s:15:\"allowexchangein\";i:0;s:16:\"allowexchangeout\";i:0;}i:6;a:8:{s:5:\"title\";s:0:\"\";s:4:\"unit\";i:0;s:11:\"initcredits\";i:0;s:10:\"lowerlimit\";i:0;s:5:\"ratio\";i:0;s:9:\"available\";i:0;s:15:\"allowexchangein\";i:0;s:16:\"allowexchangeout\";i:0;}i:7;a:8:{s:5:\"title\";s:0:\"\";s:4:\"unit\";i:0;s:11:\"initcredits\";i:0;s:10:\"lowerlimit\";i:0;s:5:\"ratio\";i:0;s:9:\"available\";i:0;s:15:\"allowexchangein\";i:0;s:16:\"allowexchangeout\";i:0;}i:8;a:8:{s:5:\"title\";s:0:\"\";s:4:\"unit\";i:0;s:11:\"initcredits\";i:0;s:10:\"lowerlimit\";i:0;s:5:\"ratio\";i:0;s:9:\"available\";i:0;s:15:\"allowexchangein\";i:0;s:16:\"allowexchangeout\";i:0;}}\";s:11:\"credit_stax\";s:3:\"0.2\";s:19:\"exchange_mincredits\";s:3:\"100\";s:19:\"transfermin_credits\";s:4:\"1000\";s:11:\"time_format\";s:5:\"Y-m-d\";s:12:\"date_convert\";s:1:\"1\";s:9:\"site_logo\";s:0:\"\";s:23:\"seccode_register_status\";s:1:\"0\";s:20:\"seccode_login_status\";s:1:\"0\";s:29:\"seccode_changepassword_status\";s:1:\"0\";s:32:\"seccode_changeinformation_status\";s:1:\"0\";s:22:\"seccode_publish_status\";s:1:\"0\";s:10:\"flood_ctrl\";s:2:\"15\";s:10:\"need_email\";s:1:\"0\";s:11:\"need_avatar\";s:1:\"0\";s:14:\"need_friendnum\";s:0:\"\";s:13:\"remember_time\";s:6:\"604800\";s:14:\"front_style_id\";s:1:\"1\";s:16:\"admin_theme_name\";s:7:\"Default\";s:20:\"admin_theme_list_num\";s:1:\"6\";s:26:\"needforbug_program_company\";s:14:\"点牛(成都)\";s:15:\"image_max_width\";s:3:\"800\";s:14:\"slide_duration\";s:3:\"0.3\";s:11:\"slide_delay\";s:1:\"5\";s:12:\"mail_default\";s:16:\"635750556@qq.com\";s:13:\"mail_sendtype\";s:1:\"2\";s:11:\"mail_server\";s:11:\"smtp.qq.com\";s:9:\"mail_port\";s:2:\"25\";s:9:\"mail_auth\";s:1:\"1\";s:9:\"mail_from\";s:16:\"635750556@qq.com\";s:18:\"mail_auth_username\";s:9:\"635750556\";s:18:\"mail_auth_password\";s:12:\"microlog1990\";s:14:\"mail_delimiter\";s:1:\"1\";s:17:\"programeupdate_on\";s:1:\"1\";s:23:\"mail_testmessage_backup\";s:201:\"这是系统发出的一封用于测试邮件是否设置成功的测试邮件。\r\n{time}\r\n\r\n-----------------------------------------------------\r\n消息来源：{site_name}\r\n站点网址：{site_url}\";s:23:\"mail_testsubject_backup\";s:64:\"尊敬的{user_name}：{site_name}系统测试邮件发送成功\";s:16:\"mail_testmessage\";s:201:\"这是系统发出的一封用于测试邮件是否设置成功的测试邮件。\r\n{time}\r\n\r\n-----------------------------------------------------\r\n消息来源：{site_name}\r\n站点网址：{site_url}\";s:16:\"mail_testsubject\";s:64:\"尊敬的{user_name}：{site_name}系统测试邮件发送成功\";s:19:\"getpassword_expired\";s:5:\"36000\";}');
INSERT INTO `needforbug_syscache` (`syscache_name`,`syscache_type`,`create_dateline`,`update_dateline`,`syscache_data`) VALUES ('adminctrlmenu','1','1345596238','1345710822','a:0:{}');
INSERT INTO `needforbug_syscache` (`syscache_name`,`syscache_type`,`create_dateline`,`update_dateline`,`syscache_data`) VALUES ('creditrule','1','1345603434','1345710814','a:5:{s:6:\"sendpm\";a:15:{s:13:\"creditrule_id\";s:1:\"1\";s:15:\"creditrule_name\";s:12:\"发短消息\";s:17:\"creditrule_action\";s:6:\"sendpm\";s:20:\"creditrule_cycletype\";s:1:\"1\";s:20:\"creditrule_cycletime\";s:1:\"0\";s:20:\"creditrule_rewardnum\";s:1:\"0\";s:24:\"creditrule_extendcredit1\";s:1:\"0\";s:24:\"creditrule_extendcredit2\";s:1:\"0\";s:24:\"creditrule_extendcredit3\";s:1:\"0\";s:24:\"creditrule_extendcredit4\";s:1:\"0\";s:24:\"creditrule_extendcredit5\";s:1:\"0\";s:24:\"creditrule_extendcredit6\";s:1:\"0\";s:24:\"creditrule_extendcredit7\";s:1:\"0\";s:24:\"creditrule_extendcredit8\";s:1:\"0\";s:22:\"creditrule_rulenameuni\";s:36:\"%E5%8F%91%E7%9F%AD%E6%B6%88%E6%81%AF\";}s:15:\"promotion_visit\";a:15:{s:13:\"creditrule_id\";s:1:\"2\";s:15:\"creditrule_name\";s:12:\"访问推广\";s:17:\"creditrule_action\";s:15:\"promotion_visit\";s:20:\"creditrule_cycletype\";s:1:\"1\";s:20:\"creditrule_cycletime\";s:1:\"0\";s:20:\"creditrule_rewardnum\";s:1:\"0\";s:24:\"creditrule_extendcredit1\";s:1:\"0\";s:24:\"creditrule_extendcredit2\";s:1:\"1\";s:24:\"creditrule_extendcredit3\";s:1:\"0\";s:24:\"creditrule_extendcredit4\";s:1:\"0\";s:24:\"creditrule_extendcredit5\";s:1:\"0\";s:24:\"creditrule_extendcredit6\";s:1:\"0\";s:24:\"creditrule_extendcredit7\";s:1:\"0\";s:24:\"creditrule_extendcredit8\";s:1:\"0\";s:22:\"creditrule_rulenameuni\";s:36:\"%E8%AE%BF%E9%97%AE%E6%8E%A8%E5%B9%BF\";}s:18:\"promotion_register\";a:15:{s:13:\"creditrule_id\";s:1:\"3\";s:15:\"creditrule_name\";s:12:\"注册推广\";s:17:\"creditrule_action\";s:18:\"promotion_register\";s:20:\"creditrule_cycletype\";s:1:\"0\";s:20:\"creditrule_cycletime\";s:1:\"0\";s:20:\"creditrule_rewardnum\";s:1:\"0\";s:24:\"creditrule_extendcredit1\";s:1:\"0\";s:24:\"creditrule_extendcredit2\";s:1:\"2\";s:24:\"creditrule_extendcredit3\";s:1:\"0\";s:24:\"creditrule_extendcredit4\";s:1:\"0\";s:24:\"creditrule_extendcredit5\";s:1:\"0\";s:24:\"creditrule_extendcredit6\";s:1:\"0\";s:24:\"creditrule_extendcredit7\";s:1:\"0\";s:24:\"creditrule_extendcredit8\";s:1:\"0\";s:22:\"creditrule_rulenameuni\";s:36:\"%E6%B3%A8%E5%86%8C%E6%8E%A8%E5%B9%BF\";}s:9:\"setavatar\";a:15:{s:13:\"creditrule_id\";s:1:\"4\";s:15:\"creditrule_name\";s:12:\"设置头像\";s:17:\"creditrule_action\";s:9:\"setavatar\";s:20:\"creditrule_cycletype\";s:1:\"0\";s:20:\"creditrule_cycletime\";s:1:\"0\";s:20:\"creditrule_rewardnum\";s:1:\"1\";s:24:\"creditrule_extendcredit1\";s:1:\"0\";s:24:\"creditrule_extendcredit2\";s:1:\"5\";s:24:\"creditrule_extendcredit3\";s:1:\"0\";s:24:\"creditrule_extendcredit4\";s:1:\"0\";s:24:\"creditrule_extendcredit5\";s:1:\"0\";s:24:\"creditrule_extendcredit6\";s:1:\"0\";s:24:\"creditrule_extendcredit7\";s:1:\"0\";s:24:\"creditrule_extendcredit8\";s:1:\"0\";s:22:\"creditrule_rulenameuni\";s:36:\"%E8%AE%BE%E7%BD%AE%E5%A4%B4%E5%83%8F\";}s:8:\"daylogin\";a:15:{s:13:\"creditrule_id\";s:1:\"5\";s:15:\"creditrule_name\";s:12:\"每天登录\";s:17:\"creditrule_action\";s:8:\"daylogin\";s:20:\"creditrule_cycletype\";s:1:\"1\";s:20:\"creditrule_cycletime\";s:1:\"0\";s:20:\"creditrule_rewardnum\";s:1:\"1\";s:24:\"creditrule_extendcredit1\";s:1:\"0\";s:24:\"creditrule_extendcredit2\";s:1:\"2\";s:24:\"creditrule_extendcredit3\";s:1:\"0\";s:24:\"creditrule_extendcredit4\";s:1:\"0\";s:24:\"creditrule_extendcredit5\";s:1:\"0\";s:24:\"creditrule_extendcredit6\";s:1:\"0\";s:24:\"creditrule_extendcredit7\";s:1:\"0\";s:24:\"creditrule_extendcredit8\";s:1:\"0\";s:22:\"creditrule_rulenameuni\";s:36:\"%E6%AF%8F%E5%A4%A9%E7%99%BB%E5%BD%95\";}}');
INSERT INTO `needforbug_syscache` (`syscache_name`,`syscache_type`,`create_dateline`,`update_dateline`,`syscache_data`) VALUES ('userprofilesetting','1','1345603442','1345707379','a:62:{s:20:\"userprofile_realname\";a:8:{s:21:\"userprofilesetting_id\";s:20:\"userprofile_realname\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:12:\"真实姓名\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"1\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:18:\"userprofile_gender\";a:8:{s:21:\"userprofilesetting_id\";s:18:\"userprofile_gender\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:6:\"性别\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"1\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:21:\"userprofile_birthyear\";a:8:{s:21:\"userprofilesetting_id\";s:21:\"userprofile_birthyear\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:12:\"出生年份\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"1\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:22:\"userprofile_birthmonth\";a:8:{s:21:\"userprofilesetting_id\";s:22:\"userprofile_birthmonth\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:12:\"出生月份\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:20:\"userprofile_birthday\";a:8:{s:21:\"userprofilesetting_id\";s:20:\"userprofile_birthday\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:6:\"生日\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:25:\"userprofile_constellation\";a:8:{s:21:\"userprofilesetting_id\";s:25:\"userprofile_constellation\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:6:\"星座\";s:30:\"userprofilesetting_description\";s:32:\"星座(根据生日自动计算)\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:18:\"userprofile_zodiac\";a:8:{s:21:\"userprofilesetting_id\";s:18:\"userprofile_zodiac\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:6:\"生肖\";s:30:\"userprofilesetting_description\";s:32:\"生肖(根据生日自动计算)\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:21:\"userprofile_telephone\";a:8:{s:21:\"userprofilesetting_id\";s:21:\"userprofile_telephone\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:12:\"固定电话\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:18:\"userprofile_mobile\";a:8:{s:21:\"userprofilesetting_id\";s:18:\"userprofile_mobile\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:6:\"手机\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:22:\"userprofile_idcardtype\";a:8:{s:21:\"userprofilesetting_id\";s:22:\"userprofile_idcardtype\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:12:\"证件类型\";s:30:\"userprofilesetting_description\";s:29:\"身份证 护照 驾驶证等\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:18:\"userprofile_idcard\";a:8:{s:21:\"userprofilesetting_id\";s:18:\"userprofile_idcard\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:9:\"证件号\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:19:\"userprofile_address\";a:8:{s:21:\"userprofilesetting_id\";s:19:\"userprofile_address\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:12:\"邮寄地址\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:19:\"userprofile_zipcode\";a:8:{s:21:\"userprofilesetting_id\";s:19:\"userprofile_zipcode\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:6:\"邮编\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:23:\"userprofile_nationality\";a:8:{s:21:\"userprofilesetting_id\";s:23:\"userprofile_nationality\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:6:\"国籍\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:25:\"userprofile_birthprovince\";a:8:{s:21:\"userprofilesetting_id\";s:25:\"userprofile_birthprovince\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:12:\"出生省份\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:21:\"userprofile_birthcity\";a:8:{s:21:\"userprofilesetting_id\";s:21:\"userprofile_birthcity\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:9:\"出生地\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:21:\"userprofile_birthdist\";a:8:{s:21:\"userprofilesetting_id\";s:21:\"userprofile_birthdist\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:9:\"出生县\";s:30:\"userprofilesetting_description\";s:19:\"出生行政区/县\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:26:\"userprofile_birthcommunity\";a:8:{s:21:\"userprofilesetting_id\";s:26:\"userprofile_birthcommunity\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:12:\"出生小区\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:26:\"userprofile_resideprovince\";a:8:{s:21:\"userprofilesetting_id\";s:26:\"userprofile_resideprovince\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:12:\"居住省份\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:22:\"userprofile_residecity\";a:8:{s:21:\"userprofilesetting_id\";s:22:\"userprofile_residecity\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:9:\"居住地\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:22:\"userprofile_residedist\";a:8:{s:21:\"userprofilesetting_id\";s:22:\"userprofile_residedist\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:9:\"居住县\";s:30:\"userprofilesetting_description\";s:19:\"居住行政区/县\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:27:\"userprofile_residecommunity\";a:8:{s:21:\"userprofilesetting_id\";s:27:\"userprofile_residecommunity\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:12:\"居住小区\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:23:\"userprofile_residesuite\";a:8:{s:21:\"userprofilesetting_id\";s:23:\"userprofile_residesuite\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:6:\"房间\";s:30:\"userprofilesetting_description\";s:27:\"小区、写字楼门牌号\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:26:\"userprofile_graduateschool\";a:8:{s:21:\"userprofilesetting_id\";s:26:\"userprofile_graduateschool\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:12:\"毕业学校\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:21:\"userprofile_education\";a:8:{s:21:\"userprofilesetting_id\";s:21:\"userprofile_education\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:6:\"学历\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:19:\"userprofile_company\";a:8:{s:21:\"userprofilesetting_id\";s:19:\"userprofile_company\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:6:\"公司\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:22:\"userprofile_occupation\";a:8:{s:21:\"userprofilesetting_id\";s:22:\"userprofile_occupation\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:6:\"职业\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:20:\"userprofile_position\";a:8:{s:21:\"userprofilesetting_id\";s:20:\"userprofile_position\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:6:\"职位\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:19:\"userprofile_revenue\";a:8:{s:21:\"userprofilesetting_id\";s:19:\"userprofile_revenue\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:9:\"年收入\";s:30:\"userprofilesetting_description\";s:10:\"单位 元\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:27:\"userprofile_affectivestatus\";a:8:{s:21:\"userprofilesetting_id\";s:27:\"userprofile_affectivestatus\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:12:\"情感状态\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:22:\"userprofile_lookingfor\";a:8:{s:21:\"userprofilesetting_id\";s:22:\"userprofile_lookingfor\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:12:\"交友目的\";s:30:\"userprofilesetting_description\";s:39:\"希望在网站找到什么样的朋友\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:21:\"userprofile_bloodtype\";a:8:{s:21:\"userprofilesetting_id\";s:21:\"userprofile_bloodtype\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:6:\"血型\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:18:\"userprofile_height\";a:8:{s:21:\"userprofilesetting_id\";s:18:\"userprofile_height\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:6:\"身高\";s:30:\"userprofilesetting_description\";s:9:\"单位 cm\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:18:\"userprofile_weight\";a:8:{s:21:\"userprofilesetting_id\";s:18:\"userprofile_weight\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:6:\"体重\";s:30:\"userprofilesetting_description\";s:9:\"单位 kg\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:18:\"userprofile_alipay\";a:8:{s:21:\"userprofilesetting_id\";s:18:\"userprofile_alipay\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:9:\"支付宝\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:15:\"userprofile_icq\";a:8:{s:21:\"userprofilesetting_id\";s:15:\"userprofile_icq\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:3:\"ICQ\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:14:\"userprofile_qq\";a:8:{s:21:\"userprofilesetting_id\";s:14:\"userprofile_qq\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:2:\"QQ\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:17:\"userprofile_yahoo\";a:8:{s:21:\"userprofilesetting_id\";s:17:\"userprofile_yahoo\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:11:\"YAHOO帐号\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:15:\"userprofile_msn\";a:8:{s:21:\"userprofilesetting_id\";s:15:\"userprofile_msn\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:3:\"MSN\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:18:\"userprofile_taobao\";a:8:{s:21:\"userprofilesetting_id\";s:18:\"userprofile_taobao\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:12:\"阿里旺旺\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:16:\"userprofile_site\";a:8:{s:21:\"userprofilesetting_id\";s:16:\"userprofile_site\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:12:\"个人主页\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:15:\"userprofile_bio\";a:8:{s:21:\"userprofilesetting_id\";s:15:\"userprofile_bio\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:12:\"自我介绍\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:20:\"userprofile_interest\";a:8:{s:21:\"userprofilesetting_id\";s:20:\"userprofile_interest\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:12:\"兴趣爱好\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:18:\"userprofile_google\";a:8:{s:21:\"userprofilesetting_id\";s:18:\"userprofile_google\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:6:\"Google\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:17:\"userprofile_baidu\";a:8:{s:21:\"userprofilesetting_id\";s:17:\"userprofile_baidu\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:6:\"百度\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:18:\"userprofile_renren\";a:8:{s:21:\"userprofilesetting_id\";s:18:\"userprofile_renren\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:6:\"人人\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:18:\"userprofile_douban\";a:8:{s:21:\"userprofilesetting_id\";s:18:\"userprofile_douban\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:6:\"豆瓣\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:20:\"userprofile_facebook\";a:8:{s:21:\"userprofilesetting_id\";s:20:\"userprofile_facebook\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:8:\"Facebook\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:19:\"userprofile_twriter\";a:8:{s:21:\"userprofilesetting_id\";s:19:\"userprofile_twriter\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:7:\"TWriter\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:19:\"userprofile_dianniu\";a:8:{s:21:\"userprofilesetting_id\";s:19:\"userprofile_dianniu\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:6:\"点牛\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:17:\"userprofile_skype\";a:8:{s:21:\"userprofilesetting_id\";s:17:\"userprofile_skype\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:5:\"Skype\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:20:\"userprofile_weibocom\";a:8:{s:21:\"userprofilesetting_id\";s:20:\"userprofile_weibocom\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:12:\"新浪微博\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:18:\"userprofile_tqqcom\";a:8:{s:21:\"userprofilesetting_id\";s:18:\"userprofile_tqqcom\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:12:\"腾讯微博\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:20:\"userprofile_diandian\";a:8:{s:21:\"userprofilesetting_id\";s:20:\"userprofile_diandian\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:9:\"点点网\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:24:\"userprofile_kindergarten\";a:8:{s:21:\"userprofilesetting_id\";s:24:\"userprofile_kindergarten\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:9:\"幼儿园\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:19:\"userprofile_primary\";a:8:{s:21:\"userprofilesetting_id\";s:19:\"userprofile_primary\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:6:\"小学\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:28:\"userprofile_juniorhighschool\";a:8:{s:21:\"userprofilesetting_id\";s:28:\"userprofile_juniorhighschool\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:6:\"初中\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:22:\"userprofile_highschool\";a:8:{s:21:\"userprofilesetting_id\";s:22:\"userprofile_highschool\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:6:\"高中\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:22:\"userprofile_university\";a:8:{s:21:\"userprofilesetting_id\";s:22:\"userprofile_university\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:6:\"大学\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:18:\"userprofile_master\";a:8:{s:21:\"userprofilesetting_id\";s:18:\"userprofile_master\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:6:\"硕士\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:14:\"userprofile_dr\";a:8:{s:21:\"userprofilesetting_id\";s:14:\"userprofile_dr\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:6:\"博士\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}s:21:\"userprofile_nowschool\";a:8:{s:21:\"userprofilesetting_id\";s:21:\"userprofile_nowschool\";s:25:\"userprofilesetting_status\";s:1:\"1\";s:24:\"userprofilesetting_title\";s:12:\"当前学校\";s:30:\"userprofilesetting_description\";s:0:\"\";s:23:\"userprofilesetting_sort\";s:1:\"0\";s:27:\"userprofilesetting_showinfo\";s:1:\"0\";s:30:\"userprofilesetting_allowsearch\";s:1:\"0\";s:26:\"userprofilesetting_privacy\";s:1:\"0\";}}');
DROP TABLE IF EXISTS `needforbug_theme`;
CREATE TABLE `needforbug_theme` (
  `theme_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '主题ID',
  `theme_name` varchar(32) NOT NULL DEFAULT '' COMMENT '主题名字',
  `theme_dirname` varchar(32) NOT NULL COMMENT '主题英文目录名字',
  `theme_copyright` varchar(250) NOT NULL DEFAULT '' COMMENT '主题版权',
  PRIMARY KEY (`theme_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `needforbug_theme` (`theme_id`,`theme_name`,`theme_dirname`,`theme_copyright`) VALUES ('1','默认模板套系','Default','点牛（成都）');
INSERT INTO `needforbug_theme` (`theme_id`,`theme_name`,`theme_dirname`,`theme_copyright`) VALUES ('33','默认模板套系','Default','点牛（成都）');
INSERT INTO `needforbug_theme` (`theme_id`,`theme_name`,`theme_dirname`,`theme_copyright`) VALUES ('34','默认模板套系','Default','点牛（成都）');
DROP TABLE IF EXISTS `needforbug_user`;
CREATE TABLE `needforbug_user` (
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
  PRIMARY KEY (`user_id`),
  KEY `user_status` (`user_status`),
  KEY `create_dateline` (`create_dateline`),
  KEY `user_email` (`user_email`),
  KEY `update_dateline` (`update_dateline`),
  KEY `user_password` (`user_password`),
  KEY `user_name` (`user_name`),
  KEY `user_nikename` (`user_nikename`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `needforbug_user` (`user_id`,`user_name`,`user_nikename`,`user_password`,`user_registerip`,`user_lastlogintime`,`user_lastloginip`,`user_logincount`,`user_email`,`user_remark`,`user_sign`,`create_dateline`,`update_dateline`,`user_status`,`user_random`,`user_temppassword`) VALUES ('1','admin','','58a1a314bc72468e982231b55d916feb','127.0.0.1','1345710814','::1','558','admin@admin.com','','欢迎大家光临祖国<span style=\"background-color:#FF9900;\">的锅底哈。。谢谢。</span>','1333281705','1345710814','1','d7B6D0','');
INSERT INTO `needforbug_user` (`user_id`,`user_name`,`user_nikename`,`user_password`,`user_registerip`,`user_lastlogintime`,`user_lastloginip`,`user_logincount`,`user_email`,`user_remark`,`user_sign`,`create_dateline`,`update_dateline`,`user_status`,`user_random`,`user_temppassword`) VALUES ('6','xiaomage','小马哥','4b01004478df08eaee871f36c398a82d','::1','1345265282','::1','15','635750556@qqqq.com','','','1338557883','1345265282','1','03025d','');
INSERT INTO `needforbug_user` (`user_id`,`user_name`,`user_nikename`,`user_password`,`user_registerip`,`user_lastlogintime`,`user_lastloginip`,`user_logincount`,`user_email`,`user_remark`,`user_sign`,`create_dateline`,`update_dateline`,`user_status`,`user_random`,`user_temppassword`) VALUES ('7','test','123456','3e50575fc4fd27791d9fd242961a4f3d','::1',NULL,NULL,'0','log1990@1262.com',NULL,'','1340625011','1340625011','1','845f16','');
INSERT INTO `needforbug_user` (`user_id`,`user_name`,`user_nikename`,`user_password`,`user_registerip`,`user_lastlogintime`,`user_lastloginip`,`user_logincount`,`user_email`,`user_remark`,`user_sign`,`create_dateline`,`update_dateline`,`user_status`,`user_random`,`user_temppassword`) VALUES ('8','test2','dsfsdf','150160def89ecc78ba8bcbdf1426c534','::1',NULL,NULL,'0','lgo11@ss.com',NULL,'','1340625061','1340625061','1','020Be2','');
INSERT INTO `needforbug_user` (`user_id`,`user_name`,`user_nikename`,`user_password`,`user_registerip`,`user_lastlogintime`,`user_lastloginip`,`user_logincount`,`user_email`,`user_remark`,`user_sign`,`create_dateline`,`update_dateline`,`user_status`,`user_random`,`user_temppassword`) VALUES ('9','testssdfdsdf','12','ff1e6cccb1deeafcb23595bcd055cbc3','::1','1340625140','::1','1','lgoxx@x.com',NULL,'','1340625112','1340625180','1','703c59','');
INSERT INTO `needforbug_user` (`user_id`,`user_name`,`user_nikename`,`user_password`,`user_registerip`,`user_lastlogintime`,`user_lastloginip`,`user_logincount`,`user_email`,`user_remark`,`user_sign`,`create_dateline`,`update_dateline`,`user_status`,`user_random`,`user_temppassword`) VALUES ('10','xiaoxiaoxiao','小小','8752aa796dd63a7bc6f8f45477da00ef','::1',NULL,NULL,'0','xx@x.com','','','1340625360',NULL,'1','BAc0F6','');
INSERT INTO `needforbug_user` (`user_id`,`user_name`,`user_nikename`,`user_password`,`user_registerip`,`user_lastlogintime`,`user_lastloginip`,`user_logincount`,`user_email`,`user_remark`,`user_sign`,`create_dateline`,`update_dateline`,`user_status`,`user_random`,`user_temppassword`) VALUES ('11','sdfsdfsdfsdfs','dsfsd','ed6725f7ea9f058f0f8d6e79e68c3fbb','::1',NULL,NULL,'0','63575055dsfsdf6@qq.com','','','1340625424',NULL,'1','76a47E','');
INSERT INTO `needforbug_user` (`user_id`,`user_name`,`user_nikename`,`user_password`,`user_registerip`,`user_lastlogintime`,`user_lastloginip`,`user_logincount`,`user_email`,`user_remark`,`user_sign`,`create_dateline`,`update_dateline`,`user_status`,`user_random`,`user_temppassword`) VALUES ('12','sdfsdfsdfsdfs','dsfsd','123456','',NULL,NULL,'0','63575055dsfsdf6@qq.com','','','1340625692',NULL,'1','','');
INSERT INTO `needforbug_user` (`user_id`,`user_name`,`user_nikename`,`user_password`,`user_registerip`,`user_lastlogintime`,`user_lastloginip`,`user_logincount`,`user_email`,`user_remark`,`user_sign`,`create_dateline`,`update_dateline`,`user_status`,`user_random`,`user_temppassword`) VALUES ('13','sdfsdfsdfsdfs','dsfsd','066a7a72a3a87e39d910decd0b7b407b','',NULL,NULL,'0','63575055dsfsdf6@qq.com','','','1340625774','1340625774','1','DC70e6','');
INSERT INTO `needforbug_user` (`user_id`,`user_name`,`user_nikename`,`user_password`,`user_registerip`,`user_lastlogintime`,`user_lastloginip`,`user_logincount`,`user_email`,`user_remark`,`user_sign`,`create_dateline`,`update_dateline`,`user_status`,`user_random`,`user_temppassword`) VALUES ('15','my','西瓜','1a69f983f3fa51ed592dea270ae2b0a7','::1','1341476459','::1','2','xxx@00.com',NULL,'<strong><span style=\"color:#FF9900;\">他是一个好人啦，我哈哈</span></strong>','1341471659','1341476459','1','1ddc7a','');
INSERT INTO `needforbug_user` (`user_id`,`user_name`,`user_nikename`,`user_password`,`user_registerip`,`user_lastlogintime`,`user_lastloginip`,`user_logincount`,`user_email`,`user_remark`,`user_sign`,`create_dateline`,`update_dateline`,`user_status`,`user_random`,`user_temppassword`) VALUES ('16','woshihapi','哈啤','c7a559dd18033f1038895a552969842a','::1','1342689181','::1','4','xxx@ss.com',NULL,'','1342230126','1342689181','1','81778f','');
INSERT INTO `needforbug_user` (`user_id`,`user_name`,`user_nikename`,`user_password`,`user_registerip`,`user_lastlogintime`,`user_lastloginip`,`user_logincount`,`user_email`,`user_remark`,`user_sign`,`create_dateline`,`update_dateline`,`user_status`,`user_random`,`user_temppassword`) VALUES ('17','weiyong1999','1999','a742708e7dda03388bbf08b00440b41d','::1','1345623288','::1','1','394578420@qq.com',NULL,'','1342745610','1345623462','1','15D1c1','');
INSERT INTO `needforbug_user` (`user_id`,`user_name`,`user_nikename`,`user_password`,`user_registerip`,`user_lastlogintime`,`user_lastloginip`,`user_logincount`,`user_email`,`user_remark`,`user_sign`,`create_dateline`,`update_dateline`,`user_status`,`user_random`,`user_temppassword`) VALUES ('18','weiyong2000','2000','b4c41023836b58d3fb7e9e6829b9f2d1','::1',NULL,NULL,'0','495223424@qq.com',NULL,'','1342745637','1342745637','1','2ad2cB','');
INSERT INTO `needforbug_user` (`user_id`,`user_name`,`user_nikename`,`user_password`,`user_registerip`,`user_lastlogintime`,`user_lastloginip`,`user_logincount`,`user_email`,`user_remark`,`user_sign`,`create_dateline`,`update_dateline`,`user_status`,`user_random`,`user_temppassword`) VALUES ('19','xiaoxiaoxiao','小马哥','5b2364ee7b25a846c6102cb7c5d20667','',NULL,NULL,'0','xx@qq.com','','','1342961158','1342961158','1','d3C180','');
INSERT INTO `needforbug_user` (`user_id`,`user_name`,`user_nikename`,`user_password`,`user_registerip`,`user_lastlogintime`,`user_lastloginip`,`user_logincount`,`user_email`,`user_remark`,`user_sign`,`create_dateline`,`update_dateline`,`user_status`,`user_random`,`user_temppassword`) VALUES ('20','xiaoxiaoxiao2','123456','b114077d5fba485236f845346ef6dd0e','::1',NULL,NULL,'0','dsf@ss.com','','','1342961274','1342961274','1','ceEB7F','');
INSERT INTO `needforbug_user` (`user_id`,`user_name`,`user_nikename`,`user_password`,`user_registerip`,`user_lastlogintime`,`user_lastloginip`,`user_logincount`,`user_email`,`user_remark`,`user_sign`,`create_dateline`,`update_dateline`,`user_status`,`user_random`,`user_temppassword`) VALUES ('21','sdfffffff','','6af0c89160f6de542f25c35eeb0ba5dc','::1',NULL,NULL,'0','sxxxxxxxxxxxxx@qq.com',NULL,'','1343357688','1343357688','1','625a46','');
INSERT INTO `needforbug_user` (`user_id`,`user_name`,`user_nikename`,`user_password`,`user_registerip`,`user_lastlogintime`,`user_lastloginip`,`user_logincount`,`user_email`,`user_remark`,`user_sign`,`create_dateline`,`update_dateline`,`user_status`,`user_random`,`user_temppassword`) VALUES ('22','sfdddddddddddd','','ccb8148229d02a7f369d32d339adce44','::1',NULL,NULL,'0','xiaomage2ss@xx.com','','','1343357776','1343589078','1','C6fbAF','');
INSERT INTO `needforbug_user` (`user_id`,`user_name`,`user_nikename`,`user_password`,`user_registerip`,`user_lastlogintime`,`user_lastloginip`,`user_logincount`,`user_email`,`user_remark`,`user_sign`,`create_dateline`,`update_dateline`,`user_status`,`user_random`,`user_temppassword`) VALUES ('23','dsfsfsfsdf','','e36af24812a4ca0244a5a5c9247175ec','::1',NULL,NULL,'0','sdfsf2q@xx.com',NULL,'','1343357862','1343357862','1','e98877','');
INSERT INTO `needforbug_user` (`user_id`,`user_name`,`user_nikename`,`user_password`,`user_registerip`,`user_lastlogintime`,`user_lastloginip`,`user_logincount`,`user_email`,`user_remark`,`user_sign`,`create_dateline`,`update_dateline`,`user_status`,`user_random`,`user_temppassword`) VALUES ('24','andyma','andyma','a10a87b6d31460921e7ea633d82f006a','::1',NULL,NULL,'0','andy871201529@qq.com',NULL,'','1345637021','1345638698','1','c4cE10','97365858680b900955d97348d9d38c79');
DROP TABLE IF EXISTS `needforbug_usercount`;
CREATE TABLE `needforbug_usercount` (
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
INSERT INTO `needforbug_usercount` (`user_id`,`usercount_extendcredit1`,`usercount_extendcredit2`,`usercount_extendcredit3`,`usercount_extendcredit4`,`usercount_extendcredit5`,`usercount_extendcredit6`,`usercount_extendcredit7`,`usercount_extendcredit8`,`usercount_friends`,`usercount_oltime`,`usercount_fans`) VALUES ('1','0','460','0','0','0','0','0','0','10','0','0');
INSERT INTO `needforbug_usercount` (`user_id`,`usercount_extendcredit1`,`usercount_extendcredit2`,`usercount_extendcredit3`,`usercount_extendcredit4`,`usercount_extendcredit5`,`usercount_extendcredit6`,`usercount_extendcredit7`,`usercount_extendcredit8`,`usercount_friends`,`usercount_oltime`,`usercount_fans`) VALUES ('6','0','8','0','0','0','0','0','0','1','0','0');
INSERT INTO `needforbug_usercount` (`user_id`,`usercount_extendcredit1`,`usercount_extendcredit2`,`usercount_extendcredit3`,`usercount_extendcredit4`,`usercount_extendcredit5`,`usercount_extendcredit6`,`usercount_extendcredit7`,`usercount_extendcredit8`,`usercount_friends`,`usercount_oltime`,`usercount_fans`) VALUES ('7','0','0','0','0','0','0','0','0','0','0','1');
INSERT INTO `needforbug_usercount` (`user_id`,`usercount_extendcredit1`,`usercount_extendcredit2`,`usercount_extendcredit3`,`usercount_extendcredit4`,`usercount_extendcredit5`,`usercount_extendcredit6`,`usercount_extendcredit7`,`usercount_extendcredit8`,`usercount_friends`,`usercount_oltime`,`usercount_fans`) VALUES ('8','0','0','0','0','0','0','0','0','0','0','2');
INSERT INTO `needforbug_usercount` (`user_id`,`usercount_extendcredit1`,`usercount_extendcredit2`,`usercount_extendcredit3`,`usercount_extendcredit4`,`usercount_extendcredit5`,`usercount_extendcredit6`,`usercount_extendcredit7`,`usercount_extendcredit8`,`usercount_friends`,`usercount_oltime`,`usercount_fans`) VALUES ('9','0','0','0','0','0','0','0','0','0','0','0');
INSERT INTO `needforbug_usercount` (`user_id`,`usercount_extendcredit1`,`usercount_extendcredit2`,`usercount_extendcredit3`,`usercount_extendcredit4`,`usercount_extendcredit5`,`usercount_extendcredit6`,`usercount_extendcredit7`,`usercount_extendcredit8`,`usercount_friends`,`usercount_oltime`,`usercount_fans`) VALUES ('10','0','0','0','0','0','0','0','0','0','0','2');
INSERT INTO `needforbug_usercount` (`user_id`,`usercount_extendcredit1`,`usercount_extendcredit2`,`usercount_extendcredit3`,`usercount_extendcredit4`,`usercount_extendcredit5`,`usercount_extendcredit6`,`usercount_extendcredit7`,`usercount_extendcredit8`,`usercount_friends`,`usercount_oltime`,`usercount_fans`) VALUES ('11','0','0','0','0','0','0','0','0','0','0','0');
INSERT INTO `needforbug_usercount` (`user_id`,`usercount_extendcredit1`,`usercount_extendcredit2`,`usercount_extendcredit3`,`usercount_extendcredit4`,`usercount_extendcredit5`,`usercount_extendcredit6`,`usercount_extendcredit7`,`usercount_extendcredit8`,`usercount_friends`,`usercount_oltime`,`usercount_fans`) VALUES ('12','0','0','0','0','0','0','0','0','0','0','0');
INSERT INTO `needforbug_usercount` (`user_id`,`usercount_extendcredit1`,`usercount_extendcredit2`,`usercount_extendcredit3`,`usercount_extendcredit4`,`usercount_extendcredit5`,`usercount_extendcredit6`,`usercount_extendcredit7`,`usercount_extendcredit8`,`usercount_friends`,`usercount_oltime`,`usercount_fans`) VALUES ('13','0','0','0','0','0','0','0','0','0','0','1');
INSERT INTO `needforbug_usercount` (`user_id`,`usercount_extendcredit1`,`usercount_extendcredit2`,`usercount_extendcredit3`,`usercount_extendcredit4`,`usercount_extendcredit5`,`usercount_extendcredit6`,`usercount_extendcredit7`,`usercount_extendcredit8`,`usercount_friends`,`usercount_oltime`,`usercount_fans`) VALUES ('16','0','0','0','0','0','0','0','0','0','0','1');
INSERT INTO `needforbug_usercount` (`user_id`,`usercount_extendcredit1`,`usercount_extendcredit2`,`usercount_extendcredit3`,`usercount_extendcredit4`,`usercount_extendcredit5`,`usercount_extendcredit6`,`usercount_extendcredit7`,`usercount_extendcredit8`,`usercount_friends`,`usercount_oltime`,`usercount_fans`) VALUES ('15','0','0','0','0','0','0','0','0','0','0','1');
INSERT INTO `needforbug_usercount` (`user_id`,`usercount_extendcredit1`,`usercount_extendcredit2`,`usercount_extendcredit3`,`usercount_extendcredit4`,`usercount_extendcredit5`,`usercount_extendcredit6`,`usercount_extendcredit7`,`usercount_extendcredit8`,`usercount_friends`,`usercount_oltime`,`usercount_fans`) VALUES ('17','0','2','0','0','0','0','0','0','0','0','1');
INSERT INTO `needforbug_usercount` (`user_id`,`usercount_extendcredit1`,`usercount_extendcredit2`,`usercount_extendcredit3`,`usercount_extendcredit4`,`usercount_extendcredit5`,`usercount_extendcredit6`,`usercount_extendcredit7`,`usercount_extendcredit8`,`usercount_friends`,`usercount_oltime`,`usercount_fans`) VALUES ('18','0','0','0','0','0','0','0','0','0','0','1');
INSERT INTO `needforbug_usercount` (`user_id`,`usercount_extendcredit1`,`usercount_extendcredit2`,`usercount_extendcredit3`,`usercount_extendcredit4`,`usercount_extendcredit5`,`usercount_extendcredit6`,`usercount_extendcredit7`,`usercount_extendcredit8`,`usercount_friends`,`usercount_oltime`,`usercount_fans`) VALUES ('19','0','0','0','0','0','0','0','0','0','0','1');
INSERT INTO `needforbug_usercount` (`user_id`,`usercount_extendcredit1`,`usercount_extendcredit2`,`usercount_extendcredit3`,`usercount_extendcredit4`,`usercount_extendcredit5`,`usercount_extendcredit6`,`usercount_extendcredit7`,`usercount_extendcredit8`,`usercount_friends`,`usercount_oltime`,`usercount_fans`) VALUES ('20','0','0','0','0','0','0','0','0','0','0','1');
INSERT INTO `needforbug_usercount` (`user_id`,`usercount_extendcredit1`,`usercount_extendcredit2`,`usercount_extendcredit3`,`usercount_extendcredit4`,`usercount_extendcredit5`,`usercount_extendcredit6`,`usercount_extendcredit7`,`usercount_extendcredit8`,`usercount_friends`,`usercount_oltime`,`usercount_fans`) VALUES ('21','0','0','0','0','0','0','0','0','0','0','1');
INSERT INTO `needforbug_usercount` (`user_id`,`usercount_extendcredit1`,`usercount_extendcredit2`,`usercount_extendcredit3`,`usercount_extendcredit4`,`usercount_extendcredit5`,`usercount_extendcredit6`,`usercount_extendcredit7`,`usercount_extendcredit8`,`usercount_friends`,`usercount_oltime`,`usercount_fans`) VALUES ('22','0','0','0','0','0','0','0','0','0','0','1');
INSERT INTO `needforbug_usercount` (`user_id`,`usercount_extendcredit1`,`usercount_extendcredit2`,`usercount_extendcredit3`,`usercount_extendcredit4`,`usercount_extendcredit5`,`usercount_extendcredit6`,`usercount_extendcredit7`,`usercount_extendcredit8`,`usercount_friends`,`usercount_oltime`,`usercount_fans`) VALUES ('23','0','0','0','0','0','0','0','0','0','0','1');
INSERT INTO `needforbug_usercount` (`user_id`,`usercount_extendcredit1`,`usercount_extendcredit2`,`usercount_extendcredit3`,`usercount_extendcredit4`,`usercount_extendcredit5`,`usercount_extendcredit6`,`usercount_extendcredit7`,`usercount_extendcredit8`,`usercount_friends`,`usercount_oltime`,`usercount_fans`) VALUES ('24','0','0','0','0','0','0','0','0','0','0','0');
DROP TABLE IF EXISTS `needforbug_userprofile`;
CREATE TABLE `needforbug_userprofile` (
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
INSERT INTO `needforbug_userprofile` (`user_id`,`userprofile_realname`,`userprofile_gender`,`userprofile_birthyear`,`userprofile_birthmonth`,`userprofile_birthday`,`userprofile_constellation`,`userprofile_zodiac`,`userprofile_telephone`,`userprofile_mobile`,`userprofile_idcardtype`,`userprofile_idcard`,`userprofile_address`,`userprofile_zipcode`,`userprofile_nationality`,`userprofile_birthprovince`,`userprofile_birthcity`,`userprofile_birthdist`,`userprofile_birthcommunity`,`userprofile_resideprovince`,`userprofile_residecity`,`userprofile_residedist`,`userprofile_residecommunity`,`userprofile_residesuite`,`userprofile_graduateschool`,`userprofile_company`,`userprofile_education`,`userprofile_occupation`,`userprofile_position`,`userprofile_revenue`,`userprofile_affectivestatus`,`userprofile_lookingfor`,`userprofile_bloodtype`,`userprofile_height`,`userprofile_weight`,`userprofile_alipay`,`userprofile_icq`,`userprofile_qq`,`userprofile_yahoo`,`userprofile_msn`,`userprofile_taobao`,`userprofile_site`,`userprofile_bio`,`userprofile_interest`,`userprofile_google`,`userprofile_baidu`,`userprofile_renren`,`userprofile_douban`,`userprofile_facebook`,`userprofile_twriter`,`userprofile_dianniu`,`userprofile_skype`,`userprofile_weibocom`,`userprofile_tqqcom`,`userprofile_diandian`,`userprofile_kindergarten`,`userprofile_primary`,`userprofile_juniorhighschool`,`userprofile_highschool`,`userprofile_university`,`userprofile_master`,`userprofile_dr`,`userprofile_nowschool`,`userprofile_field1`,`userprofile_field2`,`userprofile_field3`,`userprofile_field4`,`userprofile_field5`,`userprofile_field6`,`userprofile_field7`,`userprofile_field8`) VALUES ('1','第三方杀毒发','1','2011','6','14','','','08188301355','','身份证','','','','','四川省','凉山彝族自治州','金阳县','丝窝乡','广西壮族自治区','崇左市','扶绥县','','','dfs','','本科','秘书','','','已婚','找老婆','B','','','','','','','','','','<span style=\"background-color:#E56600;\">我来自于四川地区，我是个happydsffffffffffff</span>','<span style=\"color:#006600;background-color:#60D978;\"><strong>机会多的哈</strong></span>','','','','','','','','','','','','FDSF','','','','','','','博士','df','我查','','','','','','');
INSERT INTO `needforbug_userprofile` (`user_id`,`userprofile_realname`,`userprofile_gender`,`userprofile_birthyear`,`userprofile_birthmonth`,`userprofile_birthday`,`userprofile_constellation`,`userprofile_zodiac`,`userprofile_telephone`,`userprofile_mobile`,`userprofile_idcardtype`,`userprofile_idcard`,`userprofile_address`,`userprofile_zipcode`,`userprofile_nationality`,`userprofile_birthprovince`,`userprofile_birthcity`,`userprofile_birthdist`,`userprofile_birthcommunity`,`userprofile_resideprovince`,`userprofile_residecity`,`userprofile_residedist`,`userprofile_residecommunity`,`userprofile_residesuite`,`userprofile_graduateschool`,`userprofile_company`,`userprofile_education`,`userprofile_occupation`,`userprofile_position`,`userprofile_revenue`,`userprofile_affectivestatus`,`userprofile_lookingfor`,`userprofile_bloodtype`,`userprofile_height`,`userprofile_weight`,`userprofile_alipay`,`userprofile_icq`,`userprofile_qq`,`userprofile_yahoo`,`userprofile_msn`,`userprofile_taobao`,`userprofile_site`,`userprofile_bio`,`userprofile_interest`,`userprofile_google`,`userprofile_baidu`,`userprofile_renren`,`userprofile_douban`,`userprofile_facebook`,`userprofile_twriter`,`userprofile_dianniu`,`userprofile_skype`,`userprofile_weibocom`,`userprofile_tqqcom`,`userprofile_diandian`,`userprofile_kindergarten`,`userprofile_primary`,`userprofile_juniorhighschool`,`userprofile_highschool`,`userprofile_university`,`userprofile_master`,`userprofile_dr`,`userprofile_nowschool`,`userprofile_field1`,`userprofile_field2`,`userprofile_field3`,`userprofile_field4`,`userprofile_field5`,`userprofile_field6`,`userprofile_field7`,`userprofile_field8`) VALUES ('6','dfdsf','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','A','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','');
INSERT INTO `needforbug_userprofile` (`user_id`,`userprofile_realname`,`userprofile_gender`,`userprofile_birthyear`,`userprofile_birthmonth`,`userprofile_birthday`,`userprofile_constellation`,`userprofile_zodiac`,`userprofile_telephone`,`userprofile_mobile`,`userprofile_idcardtype`,`userprofile_idcard`,`userprofile_address`,`userprofile_zipcode`,`userprofile_nationality`,`userprofile_birthprovince`,`userprofile_birthcity`,`userprofile_birthdist`,`userprofile_birthcommunity`,`userprofile_resideprovince`,`userprofile_residecity`,`userprofile_residedist`,`userprofile_residecommunity`,`userprofile_residesuite`,`userprofile_graduateschool`,`userprofile_company`,`userprofile_education`,`userprofile_occupation`,`userprofile_position`,`userprofile_revenue`,`userprofile_affectivestatus`,`userprofile_lookingfor`,`userprofile_bloodtype`,`userprofile_height`,`userprofile_weight`,`userprofile_alipay`,`userprofile_icq`,`userprofile_qq`,`userprofile_yahoo`,`userprofile_msn`,`userprofile_taobao`,`userprofile_site`,`userprofile_bio`,`userprofile_interest`,`userprofile_google`,`userprofile_baidu`,`userprofile_renren`,`userprofile_douban`,`userprofile_facebook`,`userprofile_twriter`,`userprofile_dianniu`,`userprofile_skype`,`userprofile_weibocom`,`userprofile_tqqcom`,`userprofile_diandian`,`userprofile_kindergarten`,`userprofile_primary`,`userprofile_juniorhighschool`,`userprofile_highschool`,`userprofile_university`,`userprofile_master`,`userprofile_dr`,`userprofile_nowschool`,`userprofile_field1`,`userprofile_field2`,`userprofile_field3`,`userprofile_field4`,`userprofile_field5`,`userprofile_field6`,`userprofile_field7`,`userprofile_field8`) VALUES ('7','','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','');
INSERT INTO `needforbug_userprofile` (`user_id`,`userprofile_realname`,`userprofile_gender`,`userprofile_birthyear`,`userprofile_birthmonth`,`userprofile_birthday`,`userprofile_constellation`,`userprofile_zodiac`,`userprofile_telephone`,`userprofile_mobile`,`userprofile_idcardtype`,`userprofile_idcard`,`userprofile_address`,`userprofile_zipcode`,`userprofile_nationality`,`userprofile_birthprovince`,`userprofile_birthcity`,`userprofile_birthdist`,`userprofile_birthcommunity`,`userprofile_resideprovince`,`userprofile_residecity`,`userprofile_residedist`,`userprofile_residecommunity`,`userprofile_residesuite`,`userprofile_graduateschool`,`userprofile_company`,`userprofile_education`,`userprofile_occupation`,`userprofile_position`,`userprofile_revenue`,`userprofile_affectivestatus`,`userprofile_lookingfor`,`userprofile_bloodtype`,`userprofile_height`,`userprofile_weight`,`userprofile_alipay`,`userprofile_icq`,`userprofile_qq`,`userprofile_yahoo`,`userprofile_msn`,`userprofile_taobao`,`userprofile_site`,`userprofile_bio`,`userprofile_interest`,`userprofile_google`,`userprofile_baidu`,`userprofile_renren`,`userprofile_douban`,`userprofile_facebook`,`userprofile_twriter`,`userprofile_dianniu`,`userprofile_skype`,`userprofile_weibocom`,`userprofile_tqqcom`,`userprofile_diandian`,`userprofile_kindergarten`,`userprofile_primary`,`userprofile_juniorhighschool`,`userprofile_highschool`,`userprofile_university`,`userprofile_master`,`userprofile_dr`,`userprofile_nowschool`,`userprofile_field1`,`userprofile_field2`,`userprofile_field3`,`userprofile_field4`,`userprofile_field5`,`userprofile_field6`,`userprofile_field7`,`userprofile_field8`) VALUES ('8','','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','');
INSERT INTO `needforbug_userprofile` (`user_id`,`userprofile_realname`,`userprofile_gender`,`userprofile_birthyear`,`userprofile_birthmonth`,`userprofile_birthday`,`userprofile_constellation`,`userprofile_zodiac`,`userprofile_telephone`,`userprofile_mobile`,`userprofile_idcardtype`,`userprofile_idcard`,`userprofile_address`,`userprofile_zipcode`,`userprofile_nationality`,`userprofile_birthprovince`,`userprofile_birthcity`,`userprofile_birthdist`,`userprofile_birthcommunity`,`userprofile_resideprovince`,`userprofile_residecity`,`userprofile_residedist`,`userprofile_residecommunity`,`userprofile_residesuite`,`userprofile_graduateschool`,`userprofile_company`,`userprofile_education`,`userprofile_occupation`,`userprofile_position`,`userprofile_revenue`,`userprofile_affectivestatus`,`userprofile_lookingfor`,`userprofile_bloodtype`,`userprofile_height`,`userprofile_weight`,`userprofile_alipay`,`userprofile_icq`,`userprofile_qq`,`userprofile_yahoo`,`userprofile_msn`,`userprofile_taobao`,`userprofile_site`,`userprofile_bio`,`userprofile_interest`,`userprofile_google`,`userprofile_baidu`,`userprofile_renren`,`userprofile_douban`,`userprofile_facebook`,`userprofile_twriter`,`userprofile_dianniu`,`userprofile_skype`,`userprofile_weibocom`,`userprofile_tqqcom`,`userprofile_diandian`,`userprofile_kindergarten`,`userprofile_primary`,`userprofile_juniorhighschool`,`userprofile_highschool`,`userprofile_university`,`userprofile_master`,`userprofile_dr`,`userprofile_nowschool`,`userprofile_field1`,`userprofile_field2`,`userprofile_field3`,`userprofile_field4`,`userprofile_field5`,`userprofile_field6`,`userprofile_field7`,`userprofile_field8`) VALUES ('9','dsfsdf','0','2012','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','A','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','');
INSERT INTO `needforbug_userprofile` (`user_id`,`userprofile_realname`,`userprofile_gender`,`userprofile_birthyear`,`userprofile_birthmonth`,`userprofile_birthday`,`userprofile_constellation`,`userprofile_zodiac`,`userprofile_telephone`,`userprofile_mobile`,`userprofile_idcardtype`,`userprofile_idcard`,`userprofile_address`,`userprofile_zipcode`,`userprofile_nationality`,`userprofile_birthprovince`,`userprofile_birthcity`,`userprofile_birthdist`,`userprofile_birthcommunity`,`userprofile_resideprovince`,`userprofile_residecity`,`userprofile_residedist`,`userprofile_residecommunity`,`userprofile_residesuite`,`userprofile_graduateschool`,`userprofile_company`,`userprofile_education`,`userprofile_occupation`,`userprofile_position`,`userprofile_revenue`,`userprofile_affectivestatus`,`userprofile_lookingfor`,`userprofile_bloodtype`,`userprofile_height`,`userprofile_weight`,`userprofile_alipay`,`userprofile_icq`,`userprofile_qq`,`userprofile_yahoo`,`userprofile_msn`,`userprofile_taobao`,`userprofile_site`,`userprofile_bio`,`userprofile_interest`,`userprofile_google`,`userprofile_baidu`,`userprofile_renren`,`userprofile_douban`,`userprofile_facebook`,`userprofile_twriter`,`userprofile_dianniu`,`userprofile_skype`,`userprofile_weibocom`,`userprofile_tqqcom`,`userprofile_diandian`,`userprofile_kindergarten`,`userprofile_primary`,`userprofile_juniorhighschool`,`userprofile_highschool`,`userprofile_university`,`userprofile_master`,`userprofile_dr`,`userprofile_nowschool`,`userprofile_field1`,`userprofile_field2`,`userprofile_field3`,`userprofile_field4`,`userprofile_field5`,`userprofile_field6`,`userprofile_field7`,`userprofile_field8`) VALUES ('13','','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','');
INSERT INTO `needforbug_userprofile` (`user_id`,`userprofile_realname`,`userprofile_gender`,`userprofile_birthyear`,`userprofile_birthmonth`,`userprofile_birthday`,`userprofile_constellation`,`userprofile_zodiac`,`userprofile_telephone`,`userprofile_mobile`,`userprofile_idcardtype`,`userprofile_idcard`,`userprofile_address`,`userprofile_zipcode`,`userprofile_nationality`,`userprofile_birthprovince`,`userprofile_birthcity`,`userprofile_birthdist`,`userprofile_birthcommunity`,`userprofile_resideprovince`,`userprofile_residecity`,`userprofile_residedist`,`userprofile_residecommunity`,`userprofile_residesuite`,`userprofile_graduateschool`,`userprofile_company`,`userprofile_education`,`userprofile_occupation`,`userprofile_position`,`userprofile_revenue`,`userprofile_affectivestatus`,`userprofile_lookingfor`,`userprofile_bloodtype`,`userprofile_height`,`userprofile_weight`,`userprofile_alipay`,`userprofile_icq`,`userprofile_qq`,`userprofile_yahoo`,`userprofile_msn`,`userprofile_taobao`,`userprofile_site`,`userprofile_bio`,`userprofile_interest`,`userprofile_google`,`userprofile_baidu`,`userprofile_renren`,`userprofile_douban`,`userprofile_facebook`,`userprofile_twriter`,`userprofile_dianniu`,`userprofile_skype`,`userprofile_weibocom`,`userprofile_tqqcom`,`userprofile_diandian`,`userprofile_kindergarten`,`userprofile_primary`,`userprofile_juniorhighschool`,`userprofile_highschool`,`userprofile_university`,`userprofile_master`,`userprofile_dr`,`userprofile_nowschool`,`userprofile_field1`,`userprofile_field2`,`userprofile_field3`,`userprofile_field4`,`userprofile_field5`,`userprofile_field6`,`userprofile_field7`,`userprofile_field8`) VALUES ('15','','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','');
INSERT INTO `needforbug_userprofile` (`user_id`,`userprofile_realname`,`userprofile_gender`,`userprofile_birthyear`,`userprofile_birthmonth`,`userprofile_birthday`,`userprofile_constellation`,`userprofile_zodiac`,`userprofile_telephone`,`userprofile_mobile`,`userprofile_idcardtype`,`userprofile_idcard`,`userprofile_address`,`userprofile_zipcode`,`userprofile_nationality`,`userprofile_birthprovince`,`userprofile_birthcity`,`userprofile_birthdist`,`userprofile_birthcommunity`,`userprofile_resideprovince`,`userprofile_residecity`,`userprofile_residedist`,`userprofile_residecommunity`,`userprofile_residesuite`,`userprofile_graduateschool`,`userprofile_company`,`userprofile_education`,`userprofile_occupation`,`userprofile_position`,`userprofile_revenue`,`userprofile_affectivestatus`,`userprofile_lookingfor`,`userprofile_bloodtype`,`userprofile_height`,`userprofile_weight`,`userprofile_alipay`,`userprofile_icq`,`userprofile_qq`,`userprofile_yahoo`,`userprofile_msn`,`userprofile_taobao`,`userprofile_site`,`userprofile_bio`,`userprofile_interest`,`userprofile_google`,`userprofile_baidu`,`userprofile_renren`,`userprofile_douban`,`userprofile_facebook`,`userprofile_twriter`,`userprofile_dianniu`,`userprofile_skype`,`userprofile_weibocom`,`userprofile_tqqcom`,`userprofile_diandian`,`userprofile_kindergarten`,`userprofile_primary`,`userprofile_juniorhighschool`,`userprofile_highschool`,`userprofile_university`,`userprofile_master`,`userprofile_dr`,`userprofile_nowschool`,`userprofile_field1`,`userprofile_field2`,`userprofile_field3`,`userprofile_field4`,`userprofile_field5`,`userprofile_field6`,`userprofile_field7`,`userprofile_field8`) VALUES ('16','','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','');
INSERT INTO `needforbug_userprofile` (`user_id`,`userprofile_realname`,`userprofile_gender`,`userprofile_birthyear`,`userprofile_birthmonth`,`userprofile_birthday`,`userprofile_constellation`,`userprofile_zodiac`,`userprofile_telephone`,`userprofile_mobile`,`userprofile_idcardtype`,`userprofile_idcard`,`userprofile_address`,`userprofile_zipcode`,`userprofile_nationality`,`userprofile_birthprovince`,`userprofile_birthcity`,`userprofile_birthdist`,`userprofile_birthcommunity`,`userprofile_resideprovince`,`userprofile_residecity`,`userprofile_residedist`,`userprofile_residecommunity`,`userprofile_residesuite`,`userprofile_graduateschool`,`userprofile_company`,`userprofile_education`,`userprofile_occupation`,`userprofile_position`,`userprofile_revenue`,`userprofile_affectivestatus`,`userprofile_lookingfor`,`userprofile_bloodtype`,`userprofile_height`,`userprofile_weight`,`userprofile_alipay`,`userprofile_icq`,`userprofile_qq`,`userprofile_yahoo`,`userprofile_msn`,`userprofile_taobao`,`userprofile_site`,`userprofile_bio`,`userprofile_interest`,`userprofile_google`,`userprofile_baidu`,`userprofile_renren`,`userprofile_douban`,`userprofile_facebook`,`userprofile_twriter`,`userprofile_dianniu`,`userprofile_skype`,`userprofile_weibocom`,`userprofile_tqqcom`,`userprofile_diandian`,`userprofile_kindergarten`,`userprofile_primary`,`userprofile_juniorhighschool`,`userprofile_highschool`,`userprofile_university`,`userprofile_master`,`userprofile_dr`,`userprofile_nowschool`,`userprofile_field1`,`userprofile_field2`,`userprofile_field3`,`userprofile_field4`,`userprofile_field5`,`userprofile_field6`,`userprofile_field7`,`userprofile_field8`) VALUES ('17','','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','');
INSERT INTO `needforbug_userprofile` (`user_id`,`userprofile_realname`,`userprofile_gender`,`userprofile_birthyear`,`userprofile_birthmonth`,`userprofile_birthday`,`userprofile_constellation`,`userprofile_zodiac`,`userprofile_telephone`,`userprofile_mobile`,`userprofile_idcardtype`,`userprofile_idcard`,`userprofile_address`,`userprofile_zipcode`,`userprofile_nationality`,`userprofile_birthprovince`,`userprofile_birthcity`,`userprofile_birthdist`,`userprofile_birthcommunity`,`userprofile_resideprovince`,`userprofile_residecity`,`userprofile_residedist`,`userprofile_residecommunity`,`userprofile_residesuite`,`userprofile_graduateschool`,`userprofile_company`,`userprofile_education`,`userprofile_occupation`,`userprofile_position`,`userprofile_revenue`,`userprofile_affectivestatus`,`userprofile_lookingfor`,`userprofile_bloodtype`,`userprofile_height`,`userprofile_weight`,`userprofile_alipay`,`userprofile_icq`,`userprofile_qq`,`userprofile_yahoo`,`userprofile_msn`,`userprofile_taobao`,`userprofile_site`,`userprofile_bio`,`userprofile_interest`,`userprofile_google`,`userprofile_baidu`,`userprofile_renren`,`userprofile_douban`,`userprofile_facebook`,`userprofile_twriter`,`userprofile_dianniu`,`userprofile_skype`,`userprofile_weibocom`,`userprofile_tqqcom`,`userprofile_diandian`,`userprofile_kindergarten`,`userprofile_primary`,`userprofile_juniorhighschool`,`userprofile_highschool`,`userprofile_university`,`userprofile_master`,`userprofile_dr`,`userprofile_nowschool`,`userprofile_field1`,`userprofile_field2`,`userprofile_field3`,`userprofile_field4`,`userprofile_field5`,`userprofile_field6`,`userprofile_field7`,`userprofile_field8`) VALUES ('18','','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','');
INSERT INTO `needforbug_userprofile` (`user_id`,`userprofile_realname`,`userprofile_gender`,`userprofile_birthyear`,`userprofile_birthmonth`,`userprofile_birthday`,`userprofile_constellation`,`userprofile_zodiac`,`userprofile_telephone`,`userprofile_mobile`,`userprofile_idcardtype`,`userprofile_idcard`,`userprofile_address`,`userprofile_zipcode`,`userprofile_nationality`,`userprofile_birthprovince`,`userprofile_birthcity`,`userprofile_birthdist`,`userprofile_birthcommunity`,`userprofile_resideprovince`,`userprofile_residecity`,`userprofile_residedist`,`userprofile_residecommunity`,`userprofile_residesuite`,`userprofile_graduateschool`,`userprofile_company`,`userprofile_education`,`userprofile_occupation`,`userprofile_position`,`userprofile_revenue`,`userprofile_affectivestatus`,`userprofile_lookingfor`,`userprofile_bloodtype`,`userprofile_height`,`userprofile_weight`,`userprofile_alipay`,`userprofile_icq`,`userprofile_qq`,`userprofile_yahoo`,`userprofile_msn`,`userprofile_taobao`,`userprofile_site`,`userprofile_bio`,`userprofile_interest`,`userprofile_google`,`userprofile_baidu`,`userprofile_renren`,`userprofile_douban`,`userprofile_facebook`,`userprofile_twriter`,`userprofile_dianniu`,`userprofile_skype`,`userprofile_weibocom`,`userprofile_tqqcom`,`userprofile_diandian`,`userprofile_kindergarten`,`userprofile_primary`,`userprofile_juniorhighschool`,`userprofile_highschool`,`userprofile_university`,`userprofile_master`,`userprofile_dr`,`userprofile_nowschool`,`userprofile_field1`,`userprofile_field2`,`userprofile_field3`,`userprofile_field4`,`userprofile_field5`,`userprofile_field6`,`userprofile_field7`,`userprofile_field8`) VALUES ('19','','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','');
INSERT INTO `needforbug_userprofile` (`user_id`,`userprofile_realname`,`userprofile_gender`,`userprofile_birthyear`,`userprofile_birthmonth`,`userprofile_birthday`,`userprofile_constellation`,`userprofile_zodiac`,`userprofile_telephone`,`userprofile_mobile`,`userprofile_idcardtype`,`userprofile_idcard`,`userprofile_address`,`userprofile_zipcode`,`userprofile_nationality`,`userprofile_birthprovince`,`userprofile_birthcity`,`userprofile_birthdist`,`userprofile_birthcommunity`,`userprofile_resideprovince`,`userprofile_residecity`,`userprofile_residedist`,`userprofile_residecommunity`,`userprofile_residesuite`,`userprofile_graduateschool`,`userprofile_company`,`userprofile_education`,`userprofile_occupation`,`userprofile_position`,`userprofile_revenue`,`userprofile_affectivestatus`,`userprofile_lookingfor`,`userprofile_bloodtype`,`userprofile_height`,`userprofile_weight`,`userprofile_alipay`,`userprofile_icq`,`userprofile_qq`,`userprofile_yahoo`,`userprofile_msn`,`userprofile_taobao`,`userprofile_site`,`userprofile_bio`,`userprofile_interest`,`userprofile_google`,`userprofile_baidu`,`userprofile_renren`,`userprofile_douban`,`userprofile_facebook`,`userprofile_twriter`,`userprofile_dianniu`,`userprofile_skype`,`userprofile_weibocom`,`userprofile_tqqcom`,`userprofile_diandian`,`userprofile_kindergarten`,`userprofile_primary`,`userprofile_juniorhighschool`,`userprofile_highschool`,`userprofile_university`,`userprofile_master`,`userprofile_dr`,`userprofile_nowschool`,`userprofile_field1`,`userprofile_field2`,`userprofile_field3`,`userprofile_field4`,`userprofile_field5`,`userprofile_field6`,`userprofile_field7`,`userprofile_field8`) VALUES ('20','','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','');
INSERT INTO `needforbug_userprofile` (`user_id`,`userprofile_realname`,`userprofile_gender`,`userprofile_birthyear`,`userprofile_birthmonth`,`userprofile_birthday`,`userprofile_constellation`,`userprofile_zodiac`,`userprofile_telephone`,`userprofile_mobile`,`userprofile_idcardtype`,`userprofile_idcard`,`userprofile_address`,`userprofile_zipcode`,`userprofile_nationality`,`userprofile_birthprovince`,`userprofile_birthcity`,`userprofile_birthdist`,`userprofile_birthcommunity`,`userprofile_resideprovince`,`userprofile_residecity`,`userprofile_residedist`,`userprofile_residecommunity`,`userprofile_residesuite`,`userprofile_graduateschool`,`userprofile_company`,`userprofile_education`,`userprofile_occupation`,`userprofile_position`,`userprofile_revenue`,`userprofile_affectivestatus`,`userprofile_lookingfor`,`userprofile_bloodtype`,`userprofile_height`,`userprofile_weight`,`userprofile_alipay`,`userprofile_icq`,`userprofile_qq`,`userprofile_yahoo`,`userprofile_msn`,`userprofile_taobao`,`userprofile_site`,`userprofile_bio`,`userprofile_interest`,`userprofile_google`,`userprofile_baidu`,`userprofile_renren`,`userprofile_douban`,`userprofile_facebook`,`userprofile_twriter`,`userprofile_dianniu`,`userprofile_skype`,`userprofile_weibocom`,`userprofile_tqqcom`,`userprofile_diandian`,`userprofile_kindergarten`,`userprofile_primary`,`userprofile_juniorhighschool`,`userprofile_highschool`,`userprofile_university`,`userprofile_master`,`userprofile_dr`,`userprofile_nowschool`,`userprofile_field1`,`userprofile_field2`,`userprofile_field3`,`userprofile_field4`,`userprofile_field5`,`userprofile_field6`,`userprofile_field7`,`userprofile_field8`) VALUES ('21','','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','');
INSERT INTO `needforbug_userprofile` (`user_id`,`userprofile_realname`,`userprofile_gender`,`userprofile_birthyear`,`userprofile_birthmonth`,`userprofile_birthday`,`userprofile_constellation`,`userprofile_zodiac`,`userprofile_telephone`,`userprofile_mobile`,`userprofile_idcardtype`,`userprofile_idcard`,`userprofile_address`,`userprofile_zipcode`,`userprofile_nationality`,`userprofile_birthprovince`,`userprofile_birthcity`,`userprofile_birthdist`,`userprofile_birthcommunity`,`userprofile_resideprovince`,`userprofile_residecity`,`userprofile_residedist`,`userprofile_residecommunity`,`userprofile_residesuite`,`userprofile_graduateschool`,`userprofile_company`,`userprofile_education`,`userprofile_occupation`,`userprofile_position`,`userprofile_revenue`,`userprofile_affectivestatus`,`userprofile_lookingfor`,`userprofile_bloodtype`,`userprofile_height`,`userprofile_weight`,`userprofile_alipay`,`userprofile_icq`,`userprofile_qq`,`userprofile_yahoo`,`userprofile_msn`,`userprofile_taobao`,`userprofile_site`,`userprofile_bio`,`userprofile_interest`,`userprofile_google`,`userprofile_baidu`,`userprofile_renren`,`userprofile_douban`,`userprofile_facebook`,`userprofile_twriter`,`userprofile_dianniu`,`userprofile_skype`,`userprofile_weibocom`,`userprofile_tqqcom`,`userprofile_diandian`,`userprofile_kindergarten`,`userprofile_primary`,`userprofile_juniorhighschool`,`userprofile_highschool`,`userprofile_university`,`userprofile_master`,`userprofile_dr`,`userprofile_nowschool`,`userprofile_field1`,`userprofile_field2`,`userprofile_field3`,`userprofile_field4`,`userprofile_field5`,`userprofile_field6`,`userprofile_field7`,`userprofile_field8`) VALUES ('22','','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','');
INSERT INTO `needforbug_userprofile` (`user_id`,`userprofile_realname`,`userprofile_gender`,`userprofile_birthyear`,`userprofile_birthmonth`,`userprofile_birthday`,`userprofile_constellation`,`userprofile_zodiac`,`userprofile_telephone`,`userprofile_mobile`,`userprofile_idcardtype`,`userprofile_idcard`,`userprofile_address`,`userprofile_zipcode`,`userprofile_nationality`,`userprofile_birthprovince`,`userprofile_birthcity`,`userprofile_birthdist`,`userprofile_birthcommunity`,`userprofile_resideprovince`,`userprofile_residecity`,`userprofile_residedist`,`userprofile_residecommunity`,`userprofile_residesuite`,`userprofile_graduateschool`,`userprofile_company`,`userprofile_education`,`userprofile_occupation`,`userprofile_position`,`userprofile_revenue`,`userprofile_affectivestatus`,`userprofile_lookingfor`,`userprofile_bloodtype`,`userprofile_height`,`userprofile_weight`,`userprofile_alipay`,`userprofile_icq`,`userprofile_qq`,`userprofile_yahoo`,`userprofile_msn`,`userprofile_taobao`,`userprofile_site`,`userprofile_bio`,`userprofile_interest`,`userprofile_google`,`userprofile_baidu`,`userprofile_renren`,`userprofile_douban`,`userprofile_facebook`,`userprofile_twriter`,`userprofile_dianniu`,`userprofile_skype`,`userprofile_weibocom`,`userprofile_tqqcom`,`userprofile_diandian`,`userprofile_kindergarten`,`userprofile_primary`,`userprofile_juniorhighschool`,`userprofile_highschool`,`userprofile_university`,`userprofile_master`,`userprofile_dr`,`userprofile_nowschool`,`userprofile_field1`,`userprofile_field2`,`userprofile_field3`,`userprofile_field4`,`userprofile_field5`,`userprofile_field6`,`userprofile_field7`,`userprofile_field8`) VALUES ('23','','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','');
INSERT INTO `needforbug_userprofile` (`user_id`,`userprofile_realname`,`userprofile_gender`,`userprofile_birthyear`,`userprofile_birthmonth`,`userprofile_birthday`,`userprofile_constellation`,`userprofile_zodiac`,`userprofile_telephone`,`userprofile_mobile`,`userprofile_idcardtype`,`userprofile_idcard`,`userprofile_address`,`userprofile_zipcode`,`userprofile_nationality`,`userprofile_birthprovince`,`userprofile_birthcity`,`userprofile_birthdist`,`userprofile_birthcommunity`,`userprofile_resideprovince`,`userprofile_residecity`,`userprofile_residedist`,`userprofile_residecommunity`,`userprofile_residesuite`,`userprofile_graduateschool`,`userprofile_company`,`userprofile_education`,`userprofile_occupation`,`userprofile_position`,`userprofile_revenue`,`userprofile_affectivestatus`,`userprofile_lookingfor`,`userprofile_bloodtype`,`userprofile_height`,`userprofile_weight`,`userprofile_alipay`,`userprofile_icq`,`userprofile_qq`,`userprofile_yahoo`,`userprofile_msn`,`userprofile_taobao`,`userprofile_site`,`userprofile_bio`,`userprofile_interest`,`userprofile_google`,`userprofile_baidu`,`userprofile_renren`,`userprofile_douban`,`userprofile_facebook`,`userprofile_twriter`,`userprofile_dianniu`,`userprofile_skype`,`userprofile_weibocom`,`userprofile_tqqcom`,`userprofile_diandian`,`userprofile_kindergarten`,`userprofile_primary`,`userprofile_juniorhighschool`,`userprofile_highschool`,`userprofile_university`,`userprofile_master`,`userprofile_dr`,`userprofile_nowschool`,`userprofile_field1`,`userprofile_field2`,`userprofile_field3`,`userprofile_field4`,`userprofile_field5`,`userprofile_field6`,`userprofile_field7`,`userprofile_field8`) VALUES ('24','','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','');
DROP TABLE IF EXISTS `needforbug_userprofilesetting`;
CREATE TABLE `needforbug_userprofilesetting` (
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
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_realname','1','真实姓名','','0','0','1','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_gender','1','性别','','0','0','1','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_birthyear','1','出生年份','','0','0','1','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_birthmonth','1','出生月份','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_birthday','1','生日','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_constellation','1','星座','星座(根据生日自动计算)','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_zodiac','1','生肖','生肖(根据生日自动计算)','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_telephone','1','固定电话','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_mobile','1','手机','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_idcardtype','1','证件类型','身份证 护照 驾驶证等','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_idcard','1','证件号','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_address','1','邮寄地址','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_zipcode','1','邮编','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_nationality','1','国籍','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_birthprovince','1','出生省份','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_birthcity','1','出生地','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_birthdist','1','出生县','出生行政区/县','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_birthcommunity','1','出生小区','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_resideprovince','1','居住省份','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_residecity','1','居住地','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_residedist','1','居住县','居住行政区/县','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_residecommunity','1','居住小区','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_residesuite','1','房间','小区、写字楼门牌号','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_graduateschool','1','毕业学校','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_education','1','学历','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_company','1','公司','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_occupation','1','职业','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_position','1','职位','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_revenue','1','年收入','单位 元','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_affectivestatus','1','情感状态','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_lookingfor','1','交友目的','希望在网站找到什么样的朋友','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_bloodtype','1','血型','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_height','1','身高','单位 cm','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_weight','1','体重','单位 kg','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_alipay','1','支付宝','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_icq','1','ICQ','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_qq','1','QQ','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_yahoo','1','YAHOO帐号','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_msn','1','MSN','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_taobao','1','阿里旺旺','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_site','1','个人主页','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_bio','1','自我介绍','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_interest','1','兴趣爱好','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_field1','0','自定义字段1','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_field2','0','自定义字段2','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_field3','0','自定义字段3','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_field4','0','自定义字段4','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_field5','0','自定义字段5','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_field6','0','自定义字段6','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_field7','0','自定义字段7','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_field8','0','自定义字段8','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_google','1','Google','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_baidu','1','百度','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_renren','1','人人','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_douban','1','豆瓣','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_facebook','1','Facebook','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_twriter','1','TWriter','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_dianniu','1','点牛','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_skype','1','Skype','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_weibocom','1','新浪微博','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_tqqcom','1','腾讯微博','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_diandian','1','点点网','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_kindergarten','1','幼儿园','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_primary','1','小学','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_juniorhighschool','1','初中','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_highschool','1','高中','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_university','1','大学','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_master','1','硕士','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_dr','1','博士','','0','0','0','0');
INSERT INTO `needforbug_userprofilesetting` (`userprofilesetting_id`,`userprofilesetting_status`,`userprofilesetting_title`,`userprofilesetting_description`,`userprofilesetting_sort`,`userprofilesetting_showinfo`,`userprofilesetting_allowsearch`,`userprofilesetting_privacy`) VALUES ('userprofile_nowschool','1','当前学校','','0','0','0','0');
DROP TABLE IF EXISTS `needforbug_userrole`;
CREATE TABLE `needforbug_userrole` (
  `role_id` mediumint(9) unsigned NOT NULL DEFAULT '0' COMMENT '角色ID',
  `user_id` char(32) NOT NULL DEFAULT '' COMMENT '用户ID',
  PRIMARY KEY (`role_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- DoYouHaoBaby Database Backup Program