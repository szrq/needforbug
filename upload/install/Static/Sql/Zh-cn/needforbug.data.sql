-- NEEDFORBUG 数据库数据
-- version 1.0
-- http://www.doyouhaobaby.net
--
-- 开发: DianniuTeam
-- 网站: http://dianniu.net

--
-- 数据库: 初始化数据
--

-- --------------------------------------------------------

--
-- 转存表中的数据 `needforbug_app`
--

INSERT INTO `needforbug_app` (`app_id`, `app_identifier`, `app_name`, `app_version`, `app_description`, `app_url`, `app_email`, `app_author`, `app_authorurl`, `app_isadmin`, `app_isinstall`, `app_isuninstall`, `app_issystem`, `app_isappnav`, `app_status`) VALUES
(1, 'home', '个人中心', '1.0', '个人中心应用', 'http://doyouhaobaby.net', 'admin@dianniu.net', 'DianniuTeam', 'http://doyouhaobaby.net', 1, 1, 1, 1, 0, 1);

-- --------------------------------------------------------

--
-- 转存表中的数据 `needforbug_creditrule`
--

INSERT INTO `needforbug_creditrule` (`creditrule_id`, `creditrule_name`, `creditrule_action`, `creditrule_cycletype`, `creditrule_cycletime`, `creditrule_rewardnum`, `creditrule_extendcredit1`, `creditrule_extendcredit2`, `creditrule_extendcredit3`, `creditrule_extendcredit4`, `creditrule_extendcredit5`, `creditrule_extendcredit6`, `creditrule_extendcredit7`, `creditrule_extendcredit8`) VALUES
(1, '发短消息', 'sendpm', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, '访问推广', 'promotion_visit', 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0),
(3, '注册推广', 'promotion_register', 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0),
(4, '设置头像', 'setavatar', 0, 0, 1, 0, 5, 0, 0, 0, 0, 0, 0),
(5, '每天登录', 'daylogin', 1, 0, 1, 0, 2, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 转存表中的数据 `needforbug_homehelp`
--

INSERT INTO `needforbug_homehelp` (`homehelp_id`, `homehelp_title`, `homehelp_content`, `homehelpcategory_id`, `homehelp_status`, `create_dateline`, `update_dateline`, `user_id`, `homehelp_username`, `homehelp_updateuserid`, `homehelp_updateusername`, `homehelp_viewnum`) VALUES
(1, '欢迎来到我们的帮助宝库！', '{site_name} 欢迎你的到来，希望这里能够帮助到你！', 1, 1, 1340045081, 1340213370, 1, 'admin', 1, 'admin', 0),
(2, '我必须要注册吗？', '<span style="color:#444444;font-family:Verdana, Helvetica, Arial, sans-serif;font-size:14px;line-height:19px;text-align:left;white-space:normal;background-color:#FFFFFF;">这取决于管理员如何设置 {site_name} 的用户组权限选项，您甚至有可能必须在注册成正式用户后后才能浏览网站。当然，在通常情况下，您至少应该是正式用户才能发新帖和回复已有帖子。请先</span><span style="color:#444444;font-family:Verdana, Helvetica, Arial, sans-serif;font-size:14px;line-height:19px;text-align:left;white-space:normal;background-color:#FFFFFF;">免费注册成为我们的新用户！&nbsp;</span><br style="word-wrap:break-word;color:#444444;font-family:Verdana, Helvetica, Arial, sans-serif;font-size:14px;line-height:19px;text-align:left;white-space:normal;background-color:#FFFFFF;" />\n<br style="word-wrap:break-word;color:#444444;font-family:Verdana, Helvetica, Arial, sans-serif;font-size:14px;line-height:19px;text-align:left;white-space:normal;background-color:#FFFFFF;" />\n<span style="color:#444444;font-family:Verdana, Helvetica, Arial, sans-serif;font-size:14px;line-height:19px;text-align:left;white-space:normal;background-color:#FFFFFF;">强烈建议您注册，这样会得到很多以游客身份无法实现的功能。</span>', 1, 1, 1340163725, 1340213377, 1, 'admin', 1, 'admin', 2),
(3, '我如何登录网站？', '<span style="color:#444444;font-family:Verdana, Helvetica, Arial, sans-serif;font-size:14px;line-height:19px;text-align:left;white-space:normal;background-color:#FFFFFF;">如果您已经注册成为该论坛的会员，哪么您只要通过访问页面右上的</span><a href="http://bbs.emlog.net/logging.php?action=login" target="_blank" style="word-wrap:break-word;text-decoration:none;color:#000000;font-family:Verdana, Helvetica, Arial, sans-serif;font-size:14px;line-height:19px;text-align:left;white-space:normal;background-color:#FFFFFF;">登录</a><span style="color:#444444;font-family:Verdana, Helvetica, Arial, sans-serif;font-size:14px;line-height:19px;text-align:left;white-space:normal;background-color:#FFFFFF;">，进入登陆界面填写正确的用户名和密码，点击“登录”即可完成登陆如果您还未注册请点击这里。</span><br style="word-wrap:break-word;color:#444444;font-family:Verdana, Helvetica, Arial, sans-serif;font-size:14px;line-height:19px;text-align:left;white-space:normal;background-color:#FFFFFF;" />\n<br style="word-wrap:break-word;color:#444444;font-family:Verdana, Helvetica, Arial, sans-serif;font-size:14px;line-height:19px;text-align:left;white-space:normal;background-color:#FFFFFF;" />\n<span style="color:#444444;font-family:Verdana, Helvetica, Arial, sans-serif;font-size:14px;line-height:19px;text-align:left;white-space:normal;background-color:#FFFFFF;">如果需要保持登录，请选择相应的 Cookie 时间，在此时间范围内您可以不必输入密码而保持上次的登录状态。</span>', 1, 1, 1340164011, 1340213385, 1, 'admin', 1, 'admin', 1),
(4, '忘记我的登录密码，怎么办？', '', 1, 1, 1340164050, 1340213393, 1, 'admin', 1, 'admin', 9),
(5, '我如何使用个性化头像', '<span style="color:#444444;font-family:Verdana, Helvetica, Arial, sans-serif;font-size:14px;line-height:19px;text-align:left;white-space:normal;background-color:#FFFFFF;">在</span><span style="font-family:Verdana, Helvetica, Arial, sans-serif;font-size:14px;line-height:19px;text-align:left;white-space:normal;background-color:#FFFFFF;">头部</span><span style="color:#444444;font-family:Verdana, Helvetica, Arial, sans-serif;font-size:14px;line-height:19px;text-align:left;white-space:normal;background-color:#FFFFFF;">有一个“修改头像”的选项，可以使用自定义的头像。</span>', 1, 1, 1340164159, 1340213404, 1, 'admin', 1, 'admin', 4),
(6, '我如何修改登录密码', '<span style="color:#444444;font-family:Verdana, Helvetica, Arial, sans-serif;font-size:14px;line-height:19px;text-align:left;white-space:normal;background-color:#FFFFFF;">在</span><span style="font-family:Verdana, Helvetica, Arial, sans-serif;font-size:14px;line-height:19px;text-align:left;white-space:normal;background-color:#FFFFFF;">基本信息中</span><span style="color:#444444;font-family:Verdana, Helvetica, Arial, sans-serif;font-size:14px;line-height:19px;text-align:left;white-space:normal;background-color:#FFFFFF;">，填写“旧密码”，“新密码”，“确认新密码”。点击“提交”，即可修改。</span>', 1, 1, 1340164237, 1343443978, 1, 'admin', 1, 'admin', 22),
(7, '我如何使用个性化签名和昵称', '<span style="color:#444444;font-family:Verdana, Helvetica, Arial, sans-serif;font-size:14px;line-height:19px;text-align:left;white-space:normal;background-color:#FFFFFF;">在</span><span style="font-family:Verdana, Helvetica, Arial, sans-serif;font-size:14px;line-height:19px;text-align:left;white-space:normal;background-color:#FFFFFF;">个人资料中</span><span style="color:#444444;font-family:Verdana, Helvetica, Arial, sans-serif;font-size:14px;line-height:19px;text-align:left;white-space:normal;background-color:#FFFFFF;">，有一个“昵称”和“个人签名”的选项，可以在此设置。</span>', 1, 1, 1340164280, 1343444041, 1, 'admin', 1, 'admin', 25),
(8, '我如何使用“会员”功能', '<ul>\n	<li>\n		<span style="white-space:nowrap;">须首先登录，没有用户名的请先注册；</span> \n	</li>\n	<li>\n		<span style="white-space:nowrap;">登录之后在论坛的左上方会出现一个“个人中心”的超级链接，点击这个链接之后就可进入到有关于您的信息。</span> \n	</li>\n</ul>', 2, 1, 1340164420, 1343444036, 1, 'admin', 1, 'admin', 44);

-- --------------------------------------------------------

--
-- 转存表中的数据 `needforbug_homehelpcategory`
--

INSERT INTO `needforbug_homehelpcategory` (`homehelpcategory_id`, `homehelpcategory_name`, `homehelpcategory_count`, `homehelpcategory_sort`, `update_dateline`, `create_dateline`) VALUES
(1, '用户须知', 7, 0, 1340187070, 1340171834),
(2, '基本功能操作', 1, 0, 1340187040, 1340162722),
(3, '其他相关问题', 0, 0, 1340524577, 1340162735);

-- --------------------------------------------------------

-- 转存表中的数据 `needforbug_homeoption`
--

INSERT INTO `needforbug_homeoption` (`homeoption_name`, `homeoption_value`) VALUES
('homehelp_list_num', '10'),
('homefresh_list_num', '15'),
('homefresh_list_substring_num', '500'),
('user_list_num', '10'),
('friend_list_num', '10'),
('my_friend_limit_num', '6'),
('pm_list_num', '5'),
('pm_list_substring_num', '200'),
('pm_single_list_num', '10');

-- --------------------------------------------------------

-- 转存表中的数据 `needforbug_homesite`
--

INSERT INTO `needforbug_homesite` (`homesite_id`, `homesite_name`, `homesite_nikename`, `homesite_content`) VALUES
(1, 'aboutus', '关于我们', '<h3>\n	社区化电子商务\n</h3>\n{site_name} 致力于打造以社区为基础的电子商务平台。<br />\n<span style="white-space:nowrap;"></span><br />\n<h3>\n	我们的目标\n</h3>\n我们的理念：{site_description}'),
(2, 'contactus', '联系我们', '<h3>\n	联系我们\n</h3>\n<p>\n	如果您对本站有任何疑问或建议，请通过以下方式联系我们：{admin_email}\n</p>'),
(3, 'agreement', '用户协议', '<div class="hero-unit">\n	<h4>\n		用户内容知识共享\n	</h4>\n	<ul>\n		<li>\n			自由复制、发行、展览、表演、放映、广播或通过信息网络传播本作品\n		</li>\n		<li>\n			自由创作演绎作品\n		</li>\n		<li>\n			自由对本作品进行商业性使用\n		</li>\n	</ul>\n	<h4>\n		惟须遵守下列条件\n	</h4>\n	<ul>\n		<li>\n			署名－您必须按照作者或者许可人指定的方式对作品进行署名。\n		</li>\n		<li>\n			相同方式共享－如果您改变、转换本作品或者以本作品为基础进行创作，您只能采用与本协议相同的许可协议发布基于本作品的演绎作品。\n		</li>\n	</ul>\n</div>\n<h3>\n	服务条款确认与接纳\n</h3>\n<p>\n	{site_name} 拥有 {site_url}&nbsp;及其涉及到的产品、相关软件的所有权和运作权， {site_name} 享有对 {site_url} 上一切活动的监督、提示、检查、纠正及处罚等权利。用户通过注册程序阅读本服务条款并点击"同意"按钮完成注册，即表示用户与 {site_name} 已达成协议，自愿接受本服务条款的所有内容。如果用户不同意服务条款的条件，则不能获得使用 {site_name} 服务以及注册成为用户的权利。\n</p>\n<h3>\n	使用规则\n</h3>\n<ol>\n	<li>\n		用户注册成功后，{site_name} 将给予每个用户一个用户帐号及相应的密码，该用户帐号和密码由用户负<span style="white-space:nowrap;">责保管；用户应当对以其用户帐号进行的所有活动和事件负法律责任。</span> \n	</li>\n	<li>\n		用户须对在 {site_name} 的注册信息的真实性、合法性、有效性承担全部责任，用户不得冒充他人；不得利用他人的名义发布任何信息；不得恶意使用注册帐户导致其他用户误认；否则 {site_name} 有权立即停止提供服务，收回其帐号并由用户独自承担由此而产生的一切法律责任。\n	</li>\n	<li>\n		用户不得使用 {site_name} 服务发送或传播敏感信息和违反国家法律制度的信息，包括但不限于下列信息:\n		<ul>\n			<li>\n				反对宪法所确定的基本原则的；\n			</li>\n			<li>\n				危害国家安全，泄露国家秘密，颠覆国家政权，破坏国家统一的；\n			</li>\n			<li>\n				损害国家荣誉和利益的；\n			</li>\n			<li>\n				煽动民族仇恨、民族歧视，破坏民族团结的；\n			</li>\n			<li>\n				破坏国家宗教政策，宣扬邪教和封建迷信的；\n			</li>\n			<li>\n				散布谣言，扰乱社会秩序，破坏社会稳定的；\n			</li>\n			<li>\n				散布淫秽、色情、赌博、暴力、凶杀、恐怖或者教唆犯罪的；\n			</li>\n			<li>\n				侮辱或者诽谤他人，侵害他人合法权益的\n			</li>\n			<li>\n				含有法律、行政法规禁止的其他内容的。\n			</li>\n		</ul>\n	</li>\n	<li>\n		{site_name} 有权对用户使用 {site_name}&nbsp;的情况进行审查和监督，如用户在使用 {site_name} 时违反任何上述规定，{site_name} 或其授权的人有权要求用户改正或直接采取一切必要的措施（包括但不限于删除用户张贴的内容、暂停或终止用户使用 {site_name}&nbsp;的权利）以减轻用户不当行为造成的影响。\n	</li>\n	<li>\n		盗取他人用户帐号或利用网络通讯骚扰他人，均属于非法行为。用户不得采用测试、欺骗等任何非法手段，盗取其他用户的帐号和对他人进行骚扰。\n	</li>\n</ol>\n<h3>\n	知识产权\n</h3>\n<ol>\n	<li>\n		用户保证和声明对其所提供的作品拥有完整的合法的著作权或完整的合法的授权可以用于其在 {site_name} 上从事&gt;的活动，保证 {site_name} 使用该作品不违反国家的法律法规，也不侵犯第三方的合法权益或承担任何义务。用户应对其所提供作品因形式、内容及授权的不完善、不合法所造成的一切后果承担完全责任。\n	</li>\n	<li>\n		对于经用户本人创作并上传到 {site_name} 的文本、图片、图形等， {site_name} 保留对其网站所有内容进行实时监控的权利，并有权依其独立判断对任何违反本协议约定的作品实施删除。{site_name} 对于删除用户作品引起的任何后果或导致用户的任何损失不负任何责任。\n	</li>\n	<li>\n		因用户作品的违法或侵害第三人的合法权益而导致 {site_name} 或其关联公司对第三方承担任何性质的赔偿、补偿或罚款而遭受损失（直接的、间接的、偶然的、惩罚性的和继发的损失），用户对于 {site_name} 或其关联公司蒙受的上述损失承担全面的赔偿责任。\n	</li>\n	<li>\n		任何第三方，都可以在遵循 《<a href="http://creativecommons.org/licenses/by-sa/2.5/cn/" target="_blank" style="white-space:nowrap;">知识共享署名-相同方式共享 2.5 中国大陆许可协议</a>》 的情况下分享本站用户创造的内容。\n	</li>\n</ol>\n<h3>\n	免责声明\n</h3>\n<p>\n	<br />\n</p>\n<ul>\n	<li>\n		{site_name} 不能对用户在本社区回答问题的答案或评论的准确性及合理性进行保证。\n	</li>\n	<li>\n		若{site_name} 已经明示其网络服务提供方式发生变更并提醒用户应当注意事项，用户未按要求操作所产生的一切后果由用户自行承担。\n	</li>\n	<li>\n		用户明确同意其使用 {site_name} 网络服务所存在的风险将完全由其自己承担；因其使用 {site_name} 服务而产生的一切后果也由其自己承担，{site_name} 对用户不承担任何责任。\n	</li>\n	<li>\n		{site_name} 不保证网络服务一定能满足用户的要求，也不保证网络服务不会中断，对网络服务的及时性、安全性、准确性也都不作保证。\n	</li>\n	<li>\n		对于因不可抗力或 {site_name} 不能控制的原因造成的网络服务中断或其它缺陷，{site_name} 不承担任何责任，但将尽力减少因此而给用户造成的损失和影响。\n	</li>\n	<li>\n		用户同意保障和维护 {site_name} 及其他用户的利益，用户在 {site_name} 发表的内容仅表明其个人的立场和观点，并不代表 {site_name} 的立场或观点。由于用户发表内容违法、不真实、不正当、侵犯第三方合法权益，或用户违反本协议项下的任何条款而给 {site_name} 或任何其他第三人造成损失，用户同意承担由此造成的损害赔偿责任。\n	</li>\n</ul>\n<p>\n	<br />\n</p>\n<h3>\n	服务条款的修改\n</h3>\n<p>\n	{site_name} 会在必要时修改服务条款，服务条款一旦发生变动，{site_name} 将会在用户进入下一步使用前的页面提示修改内容。如果您同意改动，则再一次激活"我同意"按钮。如果您不接受，则及时取消您的用户使用服务资格。 用户要继续使用 {site_name} 各项服务需要两方面的确认:\n</p>\n<ol>\n	<li>\n		首先确认 {site_name} 服务条款及其变动。\n	</li>\n	<li>\n		同意接受所有的服务条款限制。\n	</li>\n</ol>\n<h3>\n	联系我们\n</h3>\n<p>\n	如果您对此服务条款有任何疑问或建议，请通过以下方式联系我们：{admin_email}\n</p>'),
(4, 'privacy', '隐私政策', '<h3>\n	隐私政策\n</h3>\n<p>\n{site_name}（{site_url}）以此声明对本站用户隐私保护的许诺。{site_name} 的隐私声明正在不断改进中，随着 {site_name} 服务范围的扩大，会随时更新隐私声明，欢迎您随时查看隐私声明。<br />\n</p>\n<h3>\n	隐私政策\n</h3>\n<p>{site_name} 非常重视对用户隐私权的保护，承诺不会在未获得用户许可的情况下擅自将用户的个人资料信息出租或出售给任何第三方，但以下情况除外:<br />\n您同意让第三方共享资料；<br />\n<ul>\n	<li>\n		您同意公开你的个人资料，享受为您提供的产品和服务；\n	</li>\n	<li>\n		本站需要听从法庭传票、法律命令或遵循法律程序；\n	</li>\n	<li>\n		本站发现您违反了本站服务条款或本站其它使用规定。\n	</li>\n</ul>\n</p>');

-- --------------------------------------------------------

--
-- 转存表中的数据 `needforbug_link`
--

INSERT INTO `needforbug_link` (`link_id`, `create_dateline`, `update_dateline`, `link_name`, `link_url`, `link_description`, `link_logo`, `link_status`, `link_sort`) VALUES
(1, 1340369066, 1343901367, 'DoYouHaoBaby', 'http://doyouhaobaby.net', 'The DoYouHaoBaby Framework', '', 1, 0),
(2, 1340369020, 1343812340, '点牛', 'http://dianniu.net', '社区化电子商务软件提供商', '', 1, 0),
(3, 1340369020, 1343812340, 'NeedForBug', 'http://needforbug.doyouhaobaby.net', 'NeedForBug官方网站', '', 1, 0);

-- --------------------------------------------------------

--
-- 转存表中的数据 `needforbug_nav`
--

INSERT INTO `needforbug_nav` (`nav_id`, `nav_parentid`, `nav_name`, `nav_identifier`, `nav_title`, `nav_url`, `nav_target`, `nav_type`, `nav_style`, `nav_location`, `nav_status`, `nav_sort`, `nav_color`, `nav_icon`) VALUES
(2, 0, '设为首页', 'sethomepage', '', '#', 0, 0, 'a:3:{i:0;i:0;i:1;i:0;i:2;i:0;}', 1, 1, 0, 0, ''),
(3, 0, '加入收藏', 'setfavorite', '', '#', 0, 0, 'a:3:{i:0;i:0;i:1;i:0;i:2;i:0;}', 1, 1, 0, 0, ''),
(4, 0, '关于我们', 'aboutus', '', 'home://homesite/aboutus', 0, 0, '', 2, 1, 0, 0, ''),
(5, 0, '联系我们', 'contactus', '', 'home://homesite/contactus', 0, 0, '', 2, 1, 0, 0, ''),
(6, 0, '用户协议', 'agreement', '', 'home://homesite/agreement', 0, 0, '', 2, 1, 0, 0, ''),
(7, 0, '隐私声明', 'privacy', '', 'home://homesite/privacy', 0, 0, '', 2, 1, 0, 0, ''),
(1, 0, '帮助', 'help', '', 'home://homehelp/index', 0, 0, '', 2, 1, 0, 0, '');

-- --------------------------------------------------------

--
-- 转存表中的数据 `needforbug_node`
--

INSERT INTO `needforbug_node` (`node_id`, `node_name`, `node_title`, `node_status`, `node_remark`, `node_sort`, `node_parentid`, `node_level`, `nodegroup_id`, `create_dateline`, `update_dateline`) VALUES
(1, 'admin', 'admin后台管理', 1, '', 1, 0, 1, 0, 0, 1338558614),
(14, 'admin@rating', '角色等级', 1, '', 5, 1, 2, 1, 1338612283, 1341116051),
(2, 'admin@role', '角色管理', 1, '', 3, 1, 2, 1, 0, 1341116051),
(3, 'admin@user', '用户管理', 1, '', 7, 1, 2, 1, 0, 1341116051),
(4, 'admin@nodegroup', '节点分组', 1, '', 2, 1, 2, 1, 0, 1341116051),
(5, 'admin@node', '节点管理', 1, '', 1, 1, 2, 1, 0, 1341116051),
(6, 'admin@option', '基本设置', 1, '', 1, 1, 2, 2, 1334071697, 1345532824),
(7, 'admin@database', '数据库', 1, '', 1, 1, 2, 3, 1334394862, 1342567736),
(10, 'admin@app', '应用管理', 1, '', 1, 1, 2, 4, 1338021590, 1338045970),
(8, 'admin@registeroption', '注册与访问控制', 1, '', 2, 1, 2, 2, 1337885123, 1345532824),
(9, 'admin@uploadoption', '上传设置', 1, '', 3, 1, 2, 2, 1337887882, 1345532824),
(11, 'admin@installapp', '安装新应用', 1, '', 2, 1, 2, 4, 1338045957, 1338045970),
(12, 'admin@nav', '导航设置', 1, '', 1, 1, 2, 5, 1338271653, 1344813625),
(13, 'admin@rolegroup', '角色分组', 1, '', 4, 1, 2, 1, 1338449972, 1341116051),
(15, 'admin@ratinggroup', '等级分组', 1, '', 6, 1, 2, 1, 1338614127, 1341116051),
(16, 'admin@secoption', '防灌水设置', 1, '', 4, 1, 2, 2, 1339690018, 1345532824),
(17, 'admin@link', '友情链接', 1, '', 1, 1, 2, 6, 1340357076, 1345362771),
(18, 'admin@programoption', '系统版权', 1, '', 10, 1, 2, 2, 1340376127, 1345532824),
(19, 'admin@district', '地区设置', 1, '', 8, 1, 2, 2, 1340471147, 1345532824),
(20, 'admin@badword', '词语过滤', 1, '', 0, 1, 2, 7, 1340648216, 1340648479),
(21, 'admin@userprofilesetting', '用户栏目', 1, '', 8, 1, 2, 1, 1341116036, 1341116051),
(22, 'admin@pmoption', '短消息', 1, '', 5, 1, 2, 2, 1342407121, 1345532824),
(23, 'admin@loginlog', '登录记录', 1, '', 2, 1, 2, 3, 1342567716, 1342567736),
(24, 'admin@pm', '短消息', 1, '', 2, 1, 2, 6, 1342567990, 1345362771),
(25, 'admin@creditoption', '积分设置', 1, '', 7, 1, 2, 2, 1343028013, 1345532824),
(26, 'admin@dateoption', '时间设置', 1, '', 9, 1, 2, 2, 1343285683, 1345532824),
(27, 'admin@styleoption', '界面设置', 1, '', 2, 1, 2, 5, 1343320477, 1344813625),
(28, 'admin@appconfigtool', '应用配置', 1, '', 0, 1, 2, 8, 1343902350, 0),
(29, 'admin@style', '风格管理', 1, '', 3, 1, 2, 5, 1344225253, 1344813625),
(30, 'admin@theme', '模板管理', 1, '', 4, 1, 2, 5, 1344813607, 1344813625),
(31, 'admin@slide', '幻灯片', 1, '', 3, 1, 2, 6, 1345362756, 1345362771),
(32, 'admin@mailoption', '邮件设置', 1, '', 6, 1, 2, 2, 1345532803, 1345532824);

-- --------------------------------------------------------

--
-- 转存表中的数据 `needforbug_nodegroup`
--

INSERT INTO `needforbug_nodegroup` (`nodegroup_id`, `nodegroup_name`, `nodegroup_title`, `create_dateline`, `update_dateline`, `nodegroup_status`, `nodegroup_sort`) VALUES
(1, 'rbac', '权限', 1296454621, 1343878985, 1, 5),
(2, 'option', '设置', 1334071384, 1343878985, 1, 1),
(3, 'admin', '站长', 1334394747, 1343878985, 1, 8),
(4, 'app', '应用', 1334471579, 1343878985, 1, 4),
(5, 'ui', '界面', 1338271539, 1343878985, 1, 2),
(6, 'announce', '运营', 1340356739, 1343878985, 1, 6),
(7, 'moderate', '内容', 1340648268, 1343878985, 1, 3),
(8, 'tool', '工具', 1343878970, 1343878985, 1, 7);

-- --------------------------------------------------------

--
-- 转存表中的数据 `needforbug_option`
--

INSERT INTO `needforbug_option` (`option_name`, `option_value`) VALUES
('admin_list_num', '15'),
('site_name', 'NeedForBug'),
('site_description', 'Enjoy Online Shopping.独属于我的社区购物'),
('site_url', ''),
('close_site', '0'),
('close_site_reason', 'update...'),
('start_gzip', '0'),
('timeoffset', 'Asia/Shanghai'),
('uploadfile_maxsize', '-1'),
('upload_store_type', 'day'),
('disallowed_register_user', ''),
('disallowed_register_email', ''),
('allowed_register_email', ''),
('audit_register', '0'),
('disallowed_register', '0'),
('icp', ''),
('home_description', '{site_name}是一个以电子商务和社区为核心的社区化电子商务（B2C）平台。在这里你可以向网友分享你的购物体验、你喜欢的商品以及心情等等，同时也可以从社区获取来自其它网友的超值的信息，我们崇尚的是理念：<span class="label label-success">简单与分享</span>。'),
('admin_email', 'admin@admin.com'),
('seccode_image_width_size', '160'),
('seccode_image_height_size', '60'),
('seccode_adulterate', '0'),
('seccode_ttf', '1'),
('seccode_tilt', '0'),
('seccode_color', '1'),
('seccode_size', '0'),
('seccode_shadow', '1'),
('seccode_animator', '0'),
('seccode_background', '1'),
('seccode_image_background', '1'),
('seccode_norise', '0'),
('seccode_curve', '1'),
('seccode_type', '1'),
('needforbug_program_name', 'NeedForBug'),
('needforbug_program_version', '1.0'),
('needforbug_company_name', 'Dianniu Inc.'),
('needforbug_company_url', 'http://dianniu.net'),
('needforbug_program_url', 'http://needforbug.doyouhaobaby.net'),
('needforbug_program_year', '2012'),
('needforbug_company_year', '2010-2012'),
('site_year', '2012'),
('stat_code', ''),
('badword_on', '0'),
('pmsend_regdays', '5'),
('pmlimit_oneday', '100'),
('pmflood_ctrl', '10'),
('pm_status', '1'),
('pmsend_seccode', '0'),
('pm_sound_on', '1'),
('pm_sound_type', '1'),
('pm_sound_out_url', ''),
('avatar_uploadfile_maxsize', '512000'),
('extend_credit', 'a:8:{i:1;a:8:{s:9:"available";i:1;s:5:"title";s:6:"经验";s:4:"unit";i:0;s:11:"initcredits";i:0;s:10:"lowerlimit";i:0;s:15:"allowexchangein";i:0;s:16:"allowexchangeout";i:0;s:5:"ratio";i:0;}i:2;a:8:{s:9:"available";i:1;s:5:"title";s:6:"金币";s:4:"unit";i:0;s:11:"initcredits";i:0;s:10:"lowerlimit";i:0;s:15:"allowexchangein";i:0;s:16:"allowexchangeout";i:0;s:5:"ratio";i:0;}i:3;a:8:{s:9:"available";i:1;s:5:"title";s:6:"贡献";s:4:"unit";i:0;s:11:"initcredits";i:0;s:10:"lowerlimit";i:0;s:15:"allowexchangein";i:0;s:16:"allowexchangeout";i:0;s:5:"ratio";i:0;}i:4;a:8:{s:5:"title";s:0:"";s:4:"unit";i:0;s:11:"initcredits";i:0;s:10:"lowerlimit";i:0;s:5:"ratio";i:0;s:9:"available";i:0;s:15:"allowexchangein";i:0;s:16:"allowexchangeout";i:0;}i:5;a:8:{s:5:"title";s:0:"";s:4:"unit";i:0;s:11:"initcredits";i:0;s:10:"lowerlimit";i:0;s:5:"ratio";i:0;s:9:"available";i:0;s:15:"allowexchangein";i:0;s:16:"allowexchangeout";i:0;}i:6;a:8:{s:5:"title";s:0:"";s:4:"unit";i:0;s:11:"initcredits";i:0;s:10:"lowerlimit";i:0;s:5:"ratio";i:0;s:9:"available";i:0;s:15:"allowexchangein";i:0;s:16:"allowexchangeout";i:0;}i:7;a:8:{s:5:"title";s:0:"";s:4:"unit";i:0;s:11:"initcredits";i:0;s:10:"lowerlimit";i:0;s:5:"ratio";i:0;s:9:"available";i:0;s:15:"allowexchangein";i:0;s:16:"allowexchangeout";i:0;}i:8;a:8:{s:5:"title";s:0:"";s:4:"unit";i:0;s:11:"initcredits";i:0;s:10:"lowerlimit";i:0;s:5:"ratio";i:0;s:9:"available";i:0;s:15:"allowexchangein";i:0;s:16:"allowexchangeout";i:0;}}'),
('credit_stax', '0.2'),
('exchange_mincredits', '100'),
('transfermin_credits', '1000'),
('time_format', 'Y-m-d'),
('date_convert', '1'),
('site_logo', ''),
('seccode_register_status', '0'),
('seccode_login_status', '0'),
('seccode_changepassword_status', '0'),
('seccode_changeinformation_status', '0'),
('seccode_publish_status', '0'),
('flood_ctrl', '15'),
('need_email', '0'),
('need_avatar', '0'),
('need_friendnum', ''),
('remember_time', '604800'),
('front_style_id', '1'),
('admin_theme_name', 'Default'),
('admin_theme_list_num', '6'),
('needforbug_program_company', '点牛(成都)'),
('image_max_width', '800'),
('slide_duration', '0.3'),
('slide_delay', '5'),
('mail_default', '635750556@qq.com'),
('mail_sendtype', '2'),
('mail_server', 'smtp.qq.com'),
('mail_port', '25'),
('mail_auth', '1'),
('mail_from', '635750556@qq.com'),
('mail_auth_username', '635750556'),
('mail_auth_password', ''),
('mail_delimiter', '1'),
('programeupdate_on', '1'),
('mail_testmessage_backup', '这是系统发出的一封用于测试邮件是否设置成功的测试邮件。\r\n{time}\r\n\r\n-----------------------------------------------------\r\n消息来源：{site_name}\r\n站点网址：{site_url}'),
('mail_testsubject_backup', '尊敬的{user_name}：{site_name}系统测试邮件发送成功'),
('mail_testmessage', '这是系统发出的一封用于测试邮件是否设置成功的测试邮件。\r\n{time}\r\n\r\n-----------------------------------------------------\r\n消息来源：{site_name}\r\n站点网址：{site_url}'),
('mail_testsubject', '尊敬的{user_name}：{site_name}系统测试邮件发送成功'),
('getpassword_expired', '36000'),
('style_switch_on', '1'),
('extendstyle_switch_on', '1');

-- --------------------------------------------------------

--
-- 转存表中的数据 `needforbug_rating`
--

INSERT INTO `needforbug_rating` (`rating_id`, `rating_name`, `rating_remark`, `rating_nikename`, `create_dateline`, `update_dateline`, `rating_creditstart`, `rating_creditend`, `ratinggroup_id`) VALUES
(1, '列兵1', '', '', 1295530584, 1343975315, 0, 456, 1),
(2, '列兵2', '', NULL, 1295530598, 1338883899, 457, 912, 1),
(3, '三等兵', '', NULL, 1338403516, 1338883899, 913, 1824, 1),
(4, '二等兵', '', NULL, 1338403530, 1338883899, 1825, 3192, 1),
(5, '一等兵', '', NULL, 1338403560, 1338883899, 3193, 5016, 1),
(6, '上等兵1', '', '', 1338403581, 1343585557, 5017, 7296, 1),
(7, '上等兵2', '', NULL, 1338403594, 1338883899, 7297, 10032, 1),
(8, '上等兵3', '', NULL, 1338403607, 1338883899, 10033, 13224, 1),
(9, '上等兵4', '', NULL, 1338403619, 1338883899, 13225, 17784, 1),
(10, '下士1', '', NULL, 1338403651, 1338883914, 17785, 23940, 2),
(11, '下士2', '', NULL, 1338403666, 1338883914, 23941, 33060, 2),
(12, '下士3', '', NULL, 1338403687, 1338883914, 33061, 43092, 2),
(13, '下士4', '', NULL, 1338403899, 1338883914, 43093, 54036, 2),
(14, '下士5', '', NULL, 1338403918, 1338883914, 54037, 65892, 2),
(15, '下士6', '', NULL, 1338403930, 1338883914, 65893, 78660, 2),
(16, '中士1', '', NULL, 1338403954, 1338883933, 78661, 92340, 2),
(17, '中士2', '', NULL, 1338403968, 1338883933, 92341, 106932, 2),
(18, '中士3', '', NULL, 1338403981, 1338883933, 106933, 122436, 2),
(19, '中士4', '', NULL, 1338403990, 1338883933, 122437, 138852, 2),
(20, '中士5', '', NULL, 1338404001, 1338883933, 138853, 156180, 2),
(21, '中士6', '', NULL, 1338404013, 1338883933, 156181, 174420, 2),
(22, '上士1', '', NULL, 1338404041, 1338883933, 174421, 193572, 2),
(23, '上士2', '', NULL, 1338404058, 1338883933, 193573, 213636, 2),
(24, '上士3', '', NULL, 1338404071, 1338883933, 213637, 234612, 2),
(25, '上士4', '', NULL, 1338404082, 1338883933, 234613, 256500, 2),
(26, '上士5', '', NULL, 1338404097, 1338883933, 256501, 279300, 2),
(27, '上士6', '', NULL, 1338404108, 1338883933, 279301, 326724, 2),
(28, '少尉1', '', NULL, 1338404133, 1338883941, 326725, 375972, 3),
(29, '少尉2', '', NULL, 1338404143, 1338883941, 375973, 427044, 3),
(30, '少尉3', '', NULL, 1338404220, 1338883941, 427045, 479940, 3),
(31, '少尉4', '', NULL, 1338404235, 1338883951, 479941, 534660, 3),
(32, '少尉5', '', NULL, 1338404246, 1338883951, 534661, 591204, 3),
(33, '少尉6', '', NULL, 1338404257, 1338883951, 591205, 649572, 3),
(34, '少尉7', '', NULL, 1338404267, 1338883951, 649573, 709764, 3),
(35, '少尉8', '', NULL, 1338404277, 1338883951, 709765, 771780, 3),
(36, '中尉1', '', NULL, 1338404291, 1338883951, 771781, 835620, 3),
(37, '中尉2', '', NULL, 1338404309, 1338883951, 835621, 901284, 3),
(38, '中尉3', '', NULL, 1338404319, 1338883951, 901285, 968772, 3),
(39, '中尉4', '', NULL, 1338404330, 1338883951, 968773, 1038084, 3),
(40, '中尉5', '', NULL, 1338404341, 1338883951, 103885, 1109220, 3),
(41, '中尉6', '', NULL, 1338404353, 1338883951, 1109221, 1182180, 3),
(42, '中尉7', '', NULL, 1338404367, 1338883951, 1182181, 1256964, 3),
(43, '中尉8', '', NULL, 1338404376, 1338883951, 1256965, 1333572, 3),
(44, '上尉1', '', NULL, 1338404398, 1338883951, 1333573, 1412004, 3),
(45, '上尉2', '', NULL, 1338404409, 1338883951, 1412005, 1492260, 3),
(46, '上尉3', '', NULL, 1338404419, 1338883974, 1492261, 1574340, 3),
(47, '上尉4', '', NULL, 1338404430, 1338883974, 1574341, 1658244, 3),
(48, '上尉5', '', NULL, 1338404445, 1338883974, 1658245, 1743927, 3),
(49, '上尉6', '', NULL, 1338404456, 1338883974, 1743973, 1831524, 3),
(50, '上尉7', '', NULL, 1338404465, 1338883974, 1831525, 1920900, 3),
(51, '上尉8', '', NULL, 1338404474, 1338883974, 1920901, 2057700, 3),
(52, '少校1', '', NULL, 1338404505, 1338883988, 2057701, 2197236, 4),
(53, '少校2', '', NULL, 1338404519, 1338883988, 2197237, 2339508, 4),
(54, '少校3', '', NULL, 1338404526, 1338883988, 2338509, 2484516, 4),
(55, '少校4', '', NULL, 1338404531, 1338883988, 2484517, 2632260, 4),
(56, '少校5', '', NULL, 1338404539, 1338883988, 2632261, 2782740, 4),
(57, '少校6', '', NULL, 1338404547, 1338883988, 2782741, 2935956, 4),
(58, '少校7', '', NULL, 1338404554, 1338883988, 2935957, 3091908, 4),
(59, '少校8', '', NULL, 1338404569, 1338883988, 3091909, 3277044, 4),
(60, '中校1', '', NULL, 1338404584, 1338883988, 3277045, 3465372, 4),
(61, '中校2', '', NULL, 1338404590, 1338883996, 3465373, 3673536, 4),
(62, '中校3', '', NULL, 1338404596, 1338883996, 3673573, 3885177, 4),
(63, '中校4', '', NULL, 1338404604, 1338883996, 3885178, 4100295, 4),
(64, '中校5', '', NULL, 1338404616, 1338883996, 4100296, 4318890, 4),
(65, '中校6', '', NULL, 1338404625, 1338883996, 4318891, 4540962, 4),
(66, '中校7', '', NULL, 1338404639, 1338883996, 4540963, 4766511, 4),
(67, '中校8', '', NULL, 1338404657, 1338883996, 4766512, 5028198, 4),
(68, '上校1', '', NULL, 1338404747, 1338883996, 5028199, 5319183, 4),
(69, '上校2', '', NULL, 1338404756, 1338883996, 5139184, 5614500, 4),
(70, '上校3', '', NULL, 1338404764, 1338883996, 5614501, 5914149, 4),
(71, '上校4', '', NULL, 1338404773, 1338883996, 5914150, 6218130, 4),
(72, '上校5', '', NULL, 1338404782, 1338883996, 6218131, 6526500, 4),
(73, '上校6', '', NULL, 1338404792, 1338883996, 6526501, 6839202, 4),
(74, '上校7', '', NULL, 1338404801, 1338883996, 6839203, 7156236, 4),
(75, '上校8', '', NULL, 1338404809, 1338883996, 7156237, 7578036, 4),
(76, '大校1', '', NULL, 1338404887, 1338884031, 7578037, 8026911, 4),
(77, '大校2', '', NULL, 1338404897, 1338884031, 8026912, 8481771, 4),
(78, '大校3', '', NULL, 1338404907, 1338884031, 8481772, 8964561, 4),
(79, '大校4', '', NULL, 1338404944, 1338884031, 8964562, 9475851, 4),
(80, '大校5', '', NULL, 1338404953, 1338884031, 9475852, 10016211, 4),
(81, '大校6', '', NULL, 1338404963, 1338884031, 10016212, 10586211, 4),
(82, '少将1', '', NULL, 1338404977, 1338884047, 10586212, 11186421, 5),
(83, '少将2', '', NULL, 1338404986, 1338884047, 11186422, 11817411, 5),
(84, '少将3', '', NULL, 1338404993, 1338884047, 11817412, 12479751, 5),
(85, '少将4', '', NULL, 1338405001, 1338884047, 12479752, 13174011, 5),
(86, '少将5', '', NULL, 1338405009, 1338884047, 13174012, 13900761, 5),
(87, '少将6', '', NULL, 1338405017, 1338884047, 13900762, 14460571, 5),
(88, '中将1', '', NULL, 1338405031, 1338884047, 14460572, 15454011, 5),
(89, '中将2', '', NULL, 1338405040, 1338884047, 15454012, 16281651, 5),
(90, '中将3', '', NULL, 1338405055, 1338884047, 16281652, 17144061, 5),
(91, '中将4', '', NULL, 1338405065, 1338884056, 17144062, 18041811, 5),
(92, '中将5', '', NULL, 1338405075, 1338884056, 18041812, 18975471, 5),
(93, '中将6', '', NULL, 1338405086, 1338884056, 18975472, 19945611, 5),
(94, '上将1', '', NULL, 1338405099, 1338884056, 19945612, 20952801, 5),
(95, '上将2', '', NULL, 1338405108, 1338884056, 20952802, 21997611, 5),
(96, '上将3', '', NULL, 1338405117, 1338884056, 21997612, 23080611, 5),
(97, '上将4', '', NULL, 1338405131, 1338884056, 23080612, 24202371, 5),
(98, '上将5', '', NULL, 1338405140, 1338884056, 24202372, 25363461, 5),
(99, '上将6', '', NULL, 1338405149, 1338884056, 25363462, 26564451, 5),
(100, '元帅', '', NULL, 1338405163, 1338884056, 26564452, 26564452, 5);

-- --------------------------------------------------------

--
-- 转存表中的数据 `needforbug_ratinggroup`
--

INSERT INTO `needforbug_ratinggroup` (`ratinggroup_id`, `ratinggroup_name`, `ratinggroup_title`, `create_dateline`, `update_dateline`, `ratinggroup_status`, `ratinggroup_sort`) VALUES
(1, 'soldiers', '士兵', 1338469985, 0, 1, 0),
(2, 'nco', '士官', 1338470021, 0, 1, 0),
(3, 'lieutenant', '尉官', 1338470314, 1343585867, 1, 0),
(4, 'colonel', '校官', 1338470412, 0, 1, 0),
(5, 'generals', '将帅', 1338470428, 1338914433, 1, 0);

-- --------------------------------------------------------

--
-- 转存表中的数据 `needforbug_role`
--

INSERT INTO `needforbug_role` (`role_id`, `role_name`, `role_parentid`, `role_status`, `role_remark`, `role_nikename`, `create_dateline`, `update_dateline`, `rolegroup_id`) VALUES
(1, '管理员', 0, 1, '', '管理员', 1295530584, 1338614986, 2),
(2, '超级群主', 0, 1, '', '超级群主', 1295530598, 1338615068, 2),
(3, '群主', 0, 1, '', '群主', 1338403516, 1338615084, 2),
(4, '禁止发言', 0, 1, '', '禁止发言', 1338403530, 1338615129, 3),
(5, '禁止访问', 0, 1, '', '禁止访问', 1338403560, 1338615291, 3),
(6, '禁止IP', 0, 1, '', '禁止IP', 1338403581, 1338615314, 3),
(7, '游客', 0, 1, '', '游客', 1338403594, 1338615517, 3),
(8, '等待验证会员', 0, 1, '', '等待验证会员', 1338403607, 1338615543, 3),
(9, '限制会员', 0, 1, '', '限制会员', 1338403619, 1338615581, 1),
(10, '新手上路', 0, 1, '', '新手上路', 1338403651, 1338615675, 1),
(11, '注册会员', 0, 1, '', '注册会员', 1338403666, 1338615675, 1),
(12, '中级会员', 0, 1, '', '中级会员', 1338403687, 1338615658, 1),
(13, '高级会员', 0, 1, '', '高级会员', 1338403899, 1339179947, 1),
(14, '金牌会员', 0, 1, '', '金牌会员', 1338403918, 1338615739, 1),
(15, '社区元老', 0, 1, '', '社区元老', 1338403930, 1338615780, 1),
(16, '信息监察员', 0, 1, '', '信息监察员', 1338403954, 1338615905, 2),
(17, '网站编辑', 0, 1, '', '网站编辑', 1338403968, 1338615931, 2),
(18, '审核员', 0, 1, '', '审核员', 1338403981, 1338615954, 2),
(19, '实习群主', 0, 1, '', '实习群主', 1338403990, 1339403991, 2);

-- --------------------------------------------------------

--
-- 转存表中的数据 `needforbug_rolegroup`
--

INSERT INTO `needforbug_rolegroup` (`rolegroup_id`, `rolegroup_name`, `rolegroup_title`, `create_dateline`, `update_dateline`, `rolegroup_status`, `rolegroup_sort`) VALUES
(1, 'usergroup', '用户组', 1338469985, 1338614736, 1, 0),
(2, 'admingroup', '管理组', 1338470021, 1338614767, 1, 0),
(3, 'specialgroup', '特殊分组', 1338470314, 1338615164, 1, 0),
(4, 'customgroup', '自定义', 1338616034, 0, 1, 0);

-- --------------------------------------------------------

--
-- 转存表中的数据 `needforbug_slide`
--

INSERT INTO `needforbug_slide` (`slide_id`, `slide_sort`, `slide_title`, `slide_url`, `slide_img`, `slide_status`, `create_dateline`, `update_dateline`) VALUES
(1, 0, '欢迎加入', '{Dyhb::U(''home://public/register'')}', '{__PUBLIC__.''/images/common/slidebox/1.jpg''}', 1, 1345357086, 1345364471),
(2, 0, '立刻登录', '{Dyhb::U(''home://public/login'')}', '{__PUBLIC__.''/images/common/slidebox/2.jpg''}', 1, 1345357086, 0),
(3, 0, '关于我们', '{Dyhb::U(''home://homesite/aboutus'')}', '{__PUBLIC__.''/images/common/slidebox/3.jpg''}', 1, 1345357086, 0);

-- --------------------------------------------------------

--
-- 转存表中的数据 `needforbug_style`
--

INSERT INTO `needforbug_style` (`style_id`, `style_name`, `style_status`, `theme_id`, `style_extend`) VALUES
(1, '默认主题', 1, 1, 't1	t2	t3	t4	t5|t4');

-- --------------------------------------------------------

--
-- 转存表中的数据 `needforbug_stylevar`
--

INSERT INTO `needforbug_stylevar` (`stylevar_id`, `style_id`, `stylevar_variable`, `stylevar_substitute`) VALUES
(1, 1, 'img_dir', ''),
(2, 1, 'style_img_dir', ''),
(3, 1, 'logo', 'logo.png'),
(4, 1, 'header_border_width', '1px'),
(5, 1, 'header_border_color', '#ebebeb'),
(6, 1, 'header_text_color', '#333333'),
(7, 1, 'footer_text_color', '#7B7B7B'),
(8, 1, 'normal_font', 'Verdana,Lucida Grande, Lucida Sans Unicode, Lucida Sans, Helvetica, Arial, sans-serif'),
(9, 1, 'normal_fontsize', '13px/18px'),
(10, 1, 'small_font', 'Verdana,Lucida Grande, Lucida Sans Unicode, Lucida Sans, Helvetica, Arial, sans-serif'),
(11, 1, 'small_fontsize', '0.83em'),
(12, 1, 'big_font', 'Verdana,Lucida Grande, Lucida Sans Unicode, Lucida Sans, Helvetica, Arial, sans-serif'),
(13, 1, 'big_fontsize', '20px'),
(14, 1, 'normal_color', '#333333'),
(15, 1, 'medium_textcolor', '#333333'),
(16, 1, 'light_textcolor', '#999999'),
(17, 1, 'link_color', '#037c1d'),
(18, 1, 'highlightlink_color', '#037c1d'),
(19, 1, 'wrap_table_width', '960px'),
(20, 1, 'wrap_table_bg', '#FFFFFF'),
(21, 1, 'wrap_border_width', '1px'),
(22, 1, 'wrap_border_color', '#FFFFFF'),
(23, 1, 'content_fontsize', '14px'),
(24, 1, 'content_big_size', '16px'),
(25, 1, 'content_width', '600px'),
(26, 1, 'content_separate_color', '#FFFFFF'),
(27, 1, 'menu_border_color', '#eee'),
(28, 1, 'menu_text_color', '#FFFFFF'),
(29, 1, 'menu_hover_bg_color', '#378C32'),
(30, 1, 'menu_hover_text_color', '#000000'),
(31, 1, 'input_border', '#999999'),
(32, 1, 'input_border_dark_color', '#61c361'),
(33, 1, 'input_bg', '#FFFFFF'),
(34, 1, 'drop_menu_border', '#1ABDE6'),
(35, 1, 'interval_line_color', '#E6E7E1'),
(36, 1, 'common_background_color', '#f1f1f1'),
(37, 1, 'special_border', '#DEDEDE'),
(38, 1, 'special_bg', '#2B91D5'),
(39, 1, 'interleave_color', '#DEDEDE'),
(40, 1, 'noticetext_color', '#FF3300'),
(41, 1, 'noticetext_border_color', ''),
(42, 1, 'menu_bg_color', '#52a452'),
(43, 1, 'menu_bg_img', ''),
(44, 1, 'menu_bg_extra', ''),
(45, 1, 'header_bg_color', '#FFFFFF'),
(46, 1, 'header_bg_img', 'header_bg.png'),
(47, 1, 'header_bg_extra', 'repeat-x'),
(48, 1, 'side_bg_color', '#FFFFFF'),
(49, 1, 'side_bg_img', ''),
(50, 1, 'side_bg_extra', ''),
(51, 1, 'bg_color', '#FFFFFF'),
(52, 1, 'bg_img', 'bg.png'),
(53, 1, 'bg_extra', 'repeat'),
(54, 1, 'drop_menu_bg_color', '#CCCCCC'),
(55, 1, 'drop_menu_bg_img', ''),
(56, 1, 'drop_menu_bg_extra', 'repeat-x'),
(57, 1, 'footer_bg_color', ''),
(58, 1, 'footer_bg_img', 'footer_bg.png'),
(59, 1, 'footer_bg_extra', 'repeat-x'),
(60, 1, 'float_bg_color', '#FFFFFF'),
(61, 1, 'float_bg_img', ''),
(62, 1, 'float_bg_extra', ''),
(63, 1, 'float_mask_bg_color', '#1ABDE6'),
(64, 1, 'float_mask_bg_img', ''),
(65, 1, 'float_mask_bg_extra', '');

-- --------------------------------------------------------

--
-- 转存表中的数据 `needforbug_theme`
--

INSERT INTO `needforbug_theme` (`theme_id`, `theme_name`, `theme_dirname`, `theme_copyright`) VALUES
(1, '默认模板套系', 'Default', '点牛（成都）');

-- --------------------------------------------------------

--
-- 转存表中的数据 `needforbug_user`
--

INSERT INTO `needforbug_user` (`user_id`, `user_name`, `user_nikename`, `user_password`, `user_registerip`, `user_lastlogintime`, `user_lastloginip`, `user_logincount`, `user_email`, `user_remark`, `user_sign`, `create_dateline`, `update_dateline`, `user_status`, `user_random`, `user_temppassword`, `user_extendstyle`) VALUES
(1, 'admin', '', '67231717f41a20687eab5b20a63d8b68', '127.0.0.1', 1345888640, '::1', 0, 'admin@admin.com', '', '', 1333281705, 1345896636, 1, 'D75628', '', '');

-- --------------------------------------------------------

--
-- 转存表中的数据 `needforbug_usercount`
--

INSERT INTO `needforbug_usercount` (`user_id`, `usercount_extendcredit1`, `usercount_extendcredit2`, `usercount_extendcredit3`, `usercount_extendcredit4`, `usercount_extendcredit5`, `usercount_extendcredit6`, `usercount_extendcredit7`, `usercount_extendcredit8`, `usercount_friends`, `usercount_oltime`, `usercount_fans`) VALUES
(1, 0, 0, 0, 0, 0, 0, 0, 0, 10, 0, 0);

-- --------------------------------------------------------

--
-- 转存表中的数据 `needforbug_userprofile`
--

INSERT INTO `needforbug_userprofile` (`user_id`, `userprofile_realname`, `userprofile_gender`, `userprofile_birthyear`, `userprofile_birthmonth`, `userprofile_birthday`, `userprofile_constellation`, `userprofile_zodiac`, `userprofile_telephone`, `userprofile_mobile`, `userprofile_idcardtype`, `userprofile_idcard`, `userprofile_address`, `userprofile_zipcode`, `userprofile_nationality`, `userprofile_birthprovince`, `userprofile_birthcity`, `userprofile_birthdist`, `userprofile_birthcommunity`, `userprofile_resideprovince`, `userprofile_residecity`, `userprofile_residedist`, `userprofile_residecommunity`, `userprofile_residesuite`, `userprofile_graduateschool`, `userprofile_company`, `userprofile_education`, `userprofile_occupation`, `userprofile_position`, `userprofile_revenue`, `userprofile_affectivestatus`, `userprofile_lookingfor`, `userprofile_bloodtype`, `userprofile_height`, `userprofile_weight`, `userprofile_alipay`, `userprofile_icq`, `userprofile_qq`, `userprofile_yahoo`, `userprofile_msn`, `userprofile_taobao`, `userprofile_site`, `userprofile_bio`, `userprofile_interest`, `userprofile_google`, `userprofile_baidu`, `userprofile_renren`, `userprofile_douban`, `userprofile_facebook`, `userprofile_twriter`, `userprofile_dianniu`, `userprofile_skype`, `userprofile_weibocom`, `userprofile_tqqcom`, `userprofile_diandian`, `userprofile_kindergarten`, `userprofile_primary`, `userprofile_juniorhighschool`, `userprofile_highschool`, `userprofile_university`, `userprofile_master`, `userprofile_dr`, `userprofile_nowschool`, `userprofile_field1`, `userprofile_field2`, `userprofile_field3`, `userprofile_field4`, `userprofile_field5`, `userprofile_field6`, `userprofile_field7`, `userprofile_field8`) VALUES
(1, '', 1, 2012, 6, 14, '', '', '', '', '身份证', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '本科', '', '', '', '已婚', '', 'B', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '博士', '', '', '', '', '', '', '', '');
