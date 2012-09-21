<?php  /* DoYouHaoBaby Framework 模板缓存文件生成时间：2012-09-20 01:02:51  */ ?>
<?php $this->includeChildTemplate(Core_Extend::template('header'));?>

<link rel="stylesheet" href="/themes/site/default/css/dev/core.css2?v=0.3.6" />
<link rel="stylesheet" href="/themes/site/default/css/dev/common.css2?v=0.3.6" />

		<ul class="breadcrumb">
			<li><a href="<?php echo(__APP__);?>" title="<?php print Dyhb::L("主页",'__COMMON_LANG__@Template/Common',null);?>"><i class='icon-home'></i></a>&nbsp;<span class="divider">/</span>&nbsp;</li>
			<li><a href="<?php echo(Dyhb::U('group://public/index'));?>">群组</a></li>
		</ul>

		<div class="row">
			<div class="span8">
				<div class="row">
					<div class="span4"> 
						<script src="<?php echo(__PUBLIC__);?>/js/jquery/kinslideshow/js/jquery.kinslideshow-1.1.js" type="text/javascript"></script>
						<script type="text/javascript">
						$(function(){
							$("#group_slide_show").KinSlideshow({
								mouseEvent:"mouseover"	,
								moveStyle:"right",
								titleBar:{titleBar_height:30,titleBar_bgColor:"#08355c",titleBar_alpha:0.5},
								titleFont:{TitleFont_size:12,TitleFont_color:"#FFFFFF",TitleFont_weight:"normal"},
								btn:{btn_bgColor:"#FFFFFF",btn_bgHoverColor:"#1072aa",btn_fontColor:"#000000",
									btn_fontHoverColor:"#FFFFFF",btn_borderColor:"#cccccc",
									btn_borderHoverColor:"#1188c0",btn_borderWidth:1}
							});
						})
						</script>
						<div id="group_slide_show" style="visibility:hidden;">
							<a href="#" target="_blank"><img src="<?php echo(__PUBLIC__);?>/js/jquery/kinslideshow/images/1.jpg" alt="这是标题一" style="width:100%;height:210px;"/></a>
							<a href="#" target="_blank"><img src="<?php echo(__PUBLIC__);?>/js/jquery/kinslideshow/images/2.jpg" alt="这是标题二" style="width:100%;height:210px;"/></a>
							<a href="#" target="_blank"><img src="<?php echo(__PUBLIC__);?>/js/jquery/kinslideshow/images/3.jpg" alt="这是标题三" style="width:100%;height:210px;"/></a>
						</div>
					</div>
					<style type="text/css">

.tmode_list li{
	line-height:26px;
	height:26px;
	overflow:hidden;
}

.tmode_list_sort ul{
	background:url(<?php echo(__TMPLPUB__);?>/Images/sort.png) 0 7px no-repeat;
}
.tmode_list_sort ul li{
	padding-left:20px;
}

.tmode_list_line li{
	border-bottom:1px dotted #ccc;
	line-height:25px;
	height:25px;
}

.num {
    color: #999999;
    line-height: 18px;
    text-align: center;
    width: 140px;text-align:center;
}
.num span {
    background: none repeat scroll 0 0 #fbf6f6;
	-webkit-border-radius:3px 3px 3px 3px;
	-moz-border-radius:3px 3px 3px 3px;
    border-radius: 3px 3px 3px 3px;
    display: block;
    float: right;
    height: 36px;
    margin: 0 0 0 10px;
    overflow: hidden;
    padding: 4px 0;
    width: 54px;
}
.num em {
    display: block;
    font-weight: 700;
}
.info,.info a {
    color: #999999;
}
 .info span {
    margin-right: 10px;
}
.title {
    padding-bottom: 5px;
}
 .subject {
    padding: 10px 0 !important;
}
 .subject em {
    font-size: 14px;
    margin-right: 5px;
}

 .author {
    width: 55px;
}
 .author a {
    display: block;
    height: 45px;
    overflow: hidden;
    width: 45px;
}
				</style>
					<div class="span4">
						<div style="margin-left:-30px;" class="tmode_list tmode_list_sort tmode_list_line">
							<ul>
								<li><a href="/read.php?tid=23&amp;fid=10">意见、建议、问题请到相应版块提交</a></li>
								<li><a href="/read.php?tid=24&amp;fid=10">我是刚来体验PW9的</a></li>
								<li><a href="/read.php?tid=25&amp;fid=10">视频</a></li>
								<li><a href="/read.php?tid=26&amp;fid=10">我发个梯子来看看</a></li>
								<li><a href="/read.php?tid=27&amp;fid=12">发现目前体验站的功能还有很多没有完成</a></li>
								<li><a href="/read.php?tid=26&amp;fid=10">我发个梯子来看看</a></li>
								<li><a href="/read.php?tid=27&amp;fid=12">发现目前体验站的功能还有很多没有完成</a></li>
								<li><a href="/read.php?tid=27&amp;fid=12">发现目前体验站的功能还有很多没有完成</a></li>
							</ul>
						</div>
					</div>
				</div>
				<br/>
								
						
						
						<div id="topic_list_box">

<ul class="nav nav-tabs"><li class="active"><a href="<?php echo(Dyhb::U('group://public/index'));?>">新帖</a></li><li ><a href="<?php echo(Dyhb::U('group://public/group'));?>">小组</a></li></ul>
							<table width="100%" class="table" summary="帖子列表">
								<thead>
									<tr>
										<th>发帖人</th>
										<th colspan="2" style="text-align:right;"><a href="">浏览</a><span class="pipe">|</span> <a href="">回复</a></th>
									</tr>
								</thead>
								<tbody>
								<?php $i=1;?>
<?php if(is_array($arrGrouptopics)):foreach($arrGrouptopics as $key=>$oGrouptopic):?>

								<tr>
									<td class="author"><a class="J_user_card_show" data-uid="292" href="<?php echo(Dyhb::U('home://space@?id='.$oGrouptopic->user_id));?>"><img src="<?php echo(Core_Extend::avatar($oGrouptopic['user_id'],'small'));?>" width="45px" height="45px" class="thumbnail2" alt="<?php echo($oGrouptopic->grouptopic_username);?>" /></a></td>
									<td class="subject">
										<p class="title">
											<?php if($oGrouptopic->grouptopiccategory_id>0):?>
											<a href="#" class="st">[<?php echo($oGrouptopic->grouptopiccategory->grouptopiccategory_name);?>]</a>
											<?php else:?>
											<a href="#" class="st">[默认分类]</a>
											<?php endif;?>
											<a href="<?php echo(Dyhb::U('group://topic@?id='.$oGrouptopic->grouptopic_id));?>" class="st" style="color:#C00000" title="<?php echo($oGrouptopic->grouptopic_title);?>"><?php echo(G::subString($oGrouptopic->grouptopic_title,0,26));?></a>
										</p>
										<p class="info">
											楼主：<a class="J_user_card_show" data-uid="292" href="<?php echo(Dyhb::U('home://space@?id='.$oGrouptopic->user_id));?>"><?php echo($oGrouptopic->grouptopic_username);?></a><span>
<?php echo(Core_Extend::timeFormat($oGrouptopic->create_dateline));?></span>
											<span class="pipe">|</span>
											<?php if($oGrouptopic->grouptopic_comments>0):?>
											最后回复：<a class="J_user_card_show" data-uid="2383" href="#">扶摇侠客</a><span><a href="#" aria-label="最后回复时间">
09-11 09:50</a></span>
											<?php else:?>
											<span>暂无回复</span>
											<?php endif;?>
										</p>
									</td>
									<td class="num" style="text-align:center;">
										<span>回复<em><?php echo($oGrouptopic->grouptopic_comments);?></em></span>
										<span>浏览<em><?php echo($oGrouptopic->grouptopic_views);?></em></span>
									</td>
								</tr>
								
<?php $i++;?>
<?php endforeach;endif;?>
								</tbody>
							</table>
						</div>

			<?php echo($sPageNavbar);?>
			</div>
			<div class="span4">
<style type="text/css">



.group_sidebar_item .box_title{
	padding:7px 15px;
	border-bottom:1px solid #e8e8e8;
	font-size:12px;
	color:#666;
}


.tags_hot{
	padding:15px 0;
}
.tags_hot h2{
	font-size:14px;
	margin-bottom:15px;
}
.tags_hot li{
	float:left;
	margin:0 5px 5px 0;
}
.tags_hot li a{
	float:left;
	line-height:24px;
	height:24px;
	display:block;
	background:#f6f6f6;
	padding:0 8px;
	color:#333333;
	text-decoration:none;
	border-radius: 3px;
	white-space:nowrap;
}
.tags_hot li a:hover{
	background:#999999;
	color:#fff;
}
li {
    list-style: none outside none;
}

/*甯栧瓙鍒楄〃*/
.titles {
    word-wrap: break-word;
}
.titles li {
    border-bottom: 1px dashed #CCCCCC;
    color: #999999;
    overflow: hidden;
    padding: 6px 0;
}
.titles h3 {
    color: #666666;
    float: left;
	font-size:12px;
	margin:0;
}
.titles-r-grey {
    color: #999999;
    float: right;
}
.titles-b {
    color: #999999;
    overflow: hidden;
    width: 100%;
	margin:0;
}
.titles-b-l {
    float: left;
}
.titles-b a {
    color: #999999;
}

.group_sidebar_userinfo{
	padding:15px 0 0;
}
.group_sidebar_userinfo dl{
	overflow:hidden;
	margin-bottom:10px;
	padding:0 15px;
}
.group_sidebar_userinfo dt{
	float:left;
	width:72px;
	margin-right:18px;
	position:relative;
}

.group_sidebar_userinfo dt img{
	vertical-align:top;
}
.group_sidebar_userinfo dt a span,
.group_sidebar_userinfo dt a b{
	display:none;
	height:20px;
	width:100%;
	position:absolute;
	left:0;
	bottom:0;
}
.group_sidebar_userinfo dt a b{
	filter:alpha(opacity=60);-moz-opacity:0.6;opacity:0.6;
	background:#000;
}
.group_sidebar_userinfo dt a span{
	text-align:center;
	color:#fff;
}
.group_sidebar_userinfo dt a:hover span,
.group_sidebar_userinfo dt a:hover b{
	display:block;
}

.group_sidebar_userinfo dd{
	overflow:hidden;
}

.group_sidebar_userinfo .name{
	margin-bottom:10px;
	line-height:normal;
}
.group_sidebar_userinfo .name a{
	font-size:14px;
	font-weight:700;
	color:#333;
}

.group_sidebar_userinfo .level{
	color:#666;
	margin-bottom:10px;
}
.group_sidebar_userinfo .level a{
	color:#666;
}


.group_sidebar_userinfo .num{
	padding:0 0 15px 5px;
	height:40px;
}
.group_sidebar_userinfo .num ul{
	float:left;
}
.group_sidebar_userinfo .num li{
	width:50px;
	height:45px;
	padding-left:10px;
	float:left;
	border-right:1px solid #dde9f0;
}
.group_sidebar_userinfo .num li.tail{
	border:0 none;
}
.group_sidebar_userinfo .num em{
	display:block;
	color:#666;
}
.group_sidebar_userinfo .num span{
	font-size:18px;
	line-height:25px;
	font-weight:700;
}
.group_sidebar_userinfo .num a:hover{
	text-decoration:none;
}
.cc{
	zoom:1;
}
.cc:after{
	content:'\20';
	display:block;
	height:0;
	clear:both;
	visibility: hidden;
}

</style>

			<div id="group_sidebar">
			<div class="group_sidebar_item <?php if($GLOBALS['___login___']===FALSE):?>group_sidebar_login<?php else:?>group_sidebar_userinfo<?php endif;?>">
				<?php if($GLOBALS['___login___']===FALSE):?>
				<div class="well" style="height:260px;">
					<h3><?php print Dyhb::L("用户登录",'Template/Public',null);?></h3>
					<form class="form-horizontal" method='post' name="login_form" id="login_form">
						<label><div id="result" class="none"></div></label>
						<p><label for="user_name"><?php print Dyhb::L("用户名/E-mail",'Template/Public',null);?></label>
							<input class="span3" id="user_name" name="user_name" type="text" value="">
						</p>
						<p><label for="user_name"><?php print Dyhb::L("密码",'Template/Public',null);?></label>
							<input class="span3" id="user_password" name="user_password" type="password" value="">
						</p>
						<p><label class="checkbox">
								<input id="remember_me" type="checkbox" name="remember_me" value="1" onclick="rememberme();"/><?php print Dyhb::L("记住我",'__COMMON_LANG__@Template/Common',null);?>
								<span class="pipe">|</span>
								<a href="<?php echo(Dyhb::U('home://getpassword/index'));?>" class="resetpassword-link"><?php print Dyhb::L("忘记密码?",'__COMMON_LANG__@Template/Common',null);?></a>
								<span class="pipe">|</span>
								<a href="<?php echo(Dyhb::U('home://public/clear'));?>"><?php print Dyhb::L("清除痕迹",'__COMMON_LANG__@Template/Common',null);?></a>
							</label>
						</p>
						<div id="remember_time" class="none">
							<label for="remember_time"><?php print Dyhb::L("COOKIE有效期",'__COMMON_LANG__@Template/Common',null);?> <span class="pipe">|</span> <a href="javascript:void(0);" onclick="rememberme(1);"><i class="icon-remove"></i>&nbsp;<?php print Dyhb::L("关闭",'__COMMON_LANG__@Template/Common',null);?></a></label>
							<select name="remember_time">
								<option value="0" <?php if($nRememberTime==0):?>selected<?php endif;?>><?php print Dyhb::L("及时",'__COMMON_LANG__@Common',null);?></option>
								<option value="3600" <?php if($nRememberTime==3600):?>selected<?php endif;?>><?php print Dyhb::L("一小时",'__COMMON_LANG__@Common',null);?></option>
								<option value="86400" <?php if($nRememberTime==86400):?>selected<?php endif;?>><?php print Dyhb::L("一天",'__COMMON_LANG__@Common',null);?></option>
								<option value="604800" <?php if($nRememberTime==604800):?>selected<?php endif;?>><?php print Dyhb::L("一星期",'__COMMON_LANG__@Common',null);?></option>
								<option value="2592000" <?php if($nRememberTime==2592000):?>selected<?php endif;?>><?php print Dyhb::L("一月",'__COMMON_LANG__@Common',null);?></option>
								<option value="31536000" <?php if($nRememberTime==31536000):?>selected<?php endif;?>><?php print Dyhb::L("一年",'__COMMON_LANG__@Common',null);?></option>
							</select>
							<p class="help-block">
								<i class=" icon-info-sign"></i>&nbsp;<?php print Dyhb::L("注意在网吧等共同场所请不要记住我",'__COMMON_LANG__@Template/Common',null);?>
							</p>
						</div>
						<?php if($nDisplaySeccode==1):?>
						<label for="user_name"><?php print Dyhb::L("验证码",'__COMMON_LANG__@Template/Common',null);?></label>
							<input class="input-small" name="seccode" id="seccode" type="text" value="">
							<p class="help-block">
								<span id="seccodeImage"><img style="cursor:pointer" onclick="updateSeccode()" src="<?php echo(Dyhb::U('home://public/seccode'));?>" /></span>
							</p>
						<?php endif;?>
						<div class="space"></div>
						<p><input type="hidden" name="ajax" value="1">
							<button type="button" class="btn btn-success" onClick="Dyhb.AjaxSubmit('login_form','<?php echo(Dyhb::U('home://public/check_login'));?>','result',login_handle);"><?php print Dyhb::L("登录",'__COMMON_LANG__@Template/Common',null);?></button>&nbsp;
							<a href="<?php echo(Dyhb::U('home://public/register'));?>"><?php print Dyhb::L("新用户注册",'__COMMON_LANG__@Template/Common',null);?></a>
							<?php if(count($arrBindeds)>=3):?>
							<span class="pipe">|</span>
							<a href="javascript:void(0);" onclick="showSocialogin();"><?php print Dyhb::L("社交帐号",'__COMMON_LANG__@Template/Common',null);?></a>
							<?php endif;?>
						</p>
					</form>
					<hr/>
					<div class="socialogin_box">
						<div class="socialogin_content" style="margin-left:-20px;">
							<?php $i=1;?>
<?php if(is_array($arrBindeds)):foreach($arrBindeds as $key=>$arrBinded):?>

							<?php if($i==3):?>
							<div id="socailogin_more" class="none">
							<?php endif;?>
							<a style="border-bottom: none;" href="javascript:void(0);" onclick="sociaWinopen('<?php echo(Dyhb::U('home://public/socia_login?vendor='.$arrBinded['sociatype_identifier']));?>');"><img style="margin:0px 3px 5px 3px; vertical-align: middle;" src="<?php echo($arrBinded['sociatype_logo']);?>" /></a>
							<?php if($i>=3 && $i==count($arrBindeds)):?>
							</div>
							<?php endif;?>
							
<?php $i++;?>
<?php endforeach;endif;?>
						</div>
					</div>
				</div>
				<?php else:?>
				<div class="well" style="padding: 8px 0;margin-top:-15px;">
					<div class="userinfo">
						<div class="userpic">
							<span id="my-face">
								<a href='<?php echo(Dyhb::U('home://spaceadmin/avatar'));?>' target='_self'>
									<img src='<?php echo(Core_Extend::avatar( $GLOBALS['___login___']['user_id'],'small' ));?>' width="48px" height="48px" class="thumbnail">
								</a>
							</span>
						</div>
						<div class="user_name">
							<h6><?php if(!empty($GLOBALS['___login___']['user_nikename'])):?>
									<?php echo($GLOBALS['___login___']['user_nikename']);?>
								<?php else:?>
									<?php echo($GLOBALS['___login___']['user_name']);?>
								<?php endif;?></h6>
							<p>积分&nbsp;<a href="<?php echo(Dyhb::U('home://spaceadmin/rating'));?>"><?php echo($GLOBALS['___login___']['usercount']['usercount_extendcredit1']);?></a></p>
							<p>金币&nbsp;<a href="<?php echo(Dyhb::U('home://spaceadmin/rating'));?>"><?php echo($GLOBALS['___login___']['usercount']['usercount_extendcredit2']);?></a></p>
						</div>
						<div class="user_follow">
							<span><a href="#"><strong><?php echo($GLOBALS['___login___']['usercount']['usercount_friends']);?></strong></a><br />关注</span>
							<span><a href="#"><strong><?php echo($GLOBALS['___login___']['usercount']['usercount_fans']);?></strong></a><br />粉丝</span>
							<span><a href="#"><strong><?php echo($GLOBALS['___login___']['usercount']['usercount_friends']);?></strong></a><br />主题</span>
							<span><a href="#"><strong><?php echo($GLOBALS['___login___']['usercount']['usercount_fans']);?></strong></a><br />帖子</span>
						</div>
						<div class="user_profile">
							<table class="table">
								<tbody>
									<tr>
										<td colspan="2"><i class="icon-info-sign"></i>&nbsp;性别 保密</td>
									</tr>
									<tr>
										<td colspan="2"><i class="icon-user"></i>&nbsp;2012-09-09注册</td>
									</tr>
									<tr>
										<td colspan="2"><i class="icon-heart"></i>&nbsp;等级&nbsp;<a href="/needforbug/upload/index.php/space/rating">下士</a></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="user_action">
							<a href="" class="btn btn-success btn-large">发布帖子</a>
							<span class="pipe">|</span>
							<a href="" class="btn btn-large">领取积分</a>
						</div>
					</div>
				</div>
				<?php endif;?>
			</div>
	<div class="group_sidebar_item">
			<h2 class="box_title">热门帖子</h2>
			<ul class="titles">
<li>
<h3><a href="#" target="_blank">sdfsdfds意见反馈集中贴</a></h3>
<span class="titles-r-grey">290</span>
<p class="titles-b">
<span class="titles-b-l">来自：<a title="dfsfdsf" target="_blank" href="#">dfsfsdf</a>&nbsp;小组</span>
</p>
</li>
<li>
<h3><a href="#" target="_blank">sdfsdf意见反馈集中贴</a></h3>
<span class="titles-r-grey">290</span>
<p class="titles-b">
<span class="titles-b-l">来自：<a title="sdfsdfsdf" target="_blank" href="#">fsdfsdf</a>&nbsp;小组</span>
</p>
</li>
</ul>

		</div>
<div class="group_sidebar_item">
	<h2 class="box_title">热门标签</h2>
	<div class="tags_hot">
	<ul class="cc">
		<li><a href="/index.php?m=tag&a=view&id=32" class="title">测试</a></li>
		<li><a href="/index.php?m=tag&a=view&id=237" class="title">演示话题1</a></li>
		<li><a href="/index.php?m=tag&a=view&id=238" class="title">演示话题2</a></li>
		<li><a href="/index.php?m=tag&a=view&id=254" class="title">PHPWInd 9.0</a></li>
		<li><a href="/index.php?m=tag&a=view&id=263" class="title">苹果iphone4s</a></li>
		<li><a href="/index.php?m=tag&a=view&id=268" class="title">减肥，我坚持每天记录自己的体重</a></li>
		<li><a href="/index.php?m=tag&a=view&id=289" class="title">解放思想</a></li>
		<li><a href="/index.php?m=tag&a=view&id=295" class="title">8.7升级包会有吗</a></li>
		<li><a href="/index.php?m=tag&a=view&id=297" class="title">测试一下话题</a></li>
		<li><a href="/index.php?m=tag&a=view&id=298" class="title">灌水</a></li>
	</ul>
	</div>
</div>
			</div>
			</div>
		</div>

<?php $this->includeChildTemplate(Core_Extend::template('footer'));?>