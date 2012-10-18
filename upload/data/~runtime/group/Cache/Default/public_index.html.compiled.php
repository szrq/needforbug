<?php  /* DoYouHaoBaby Framework 模板缓存文件生成时间：2012-10-17 09:07:54  */ ?>
<?php $this->includeChildTemplate(Core_Extend::template('header'));?>

		<ul class="breadcrumb">
			<li><a href="<?php echo(__APP__);?>" title="<?php print Dyhb::L("主页",'__COMMON_LANG__@Template/Common',null);?>"><i class='icon-home'></i></a>&nbsp;<span class="divider">/</span>&nbsp;</li>
			<li><a href="<?php echo(Dyhb::U('group://public/index'));?>">新帖</a></li>
		</ul>

		<div class="row">
			<div class="span8">
				<!--<div class="row">
					<div class="span4"> 
						<div id="myCarousel" class="carousel slide">
							<div class="carousel-inner">
								<div class="item active" style="210px">
									<img src="<?php echo(__PUBLIC__);?>/images/common/slidebox/1.jpg" style="height:210px;" width="100%">
									<div class="carousel-caption">
										<h4><a href="#" title="注册">注册</a></h4>
									</div>
								</div>
								<div class="item" style="210px">
									<img src="<?php echo(__PUBLIC__);?>/images/common/slidebox/2.jpg" style="height:210px;" width="100%">
									<div class="carousel-caption">
										<h4><a href="#" title="登录">登录</a></h4>
									</div>
								</div>
							</div>
							<a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
							<a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
						</div>
					</div>
					<div class="span4">
						<div style="margin-left:-30px;" class="publicmodule_list publicmodule_list_sort publicmodule_list_line">
							<ul>
								<li><a href="#">据日本共同社报道，针对中国在钓鱼</a></li>
								<li><a href="#">据日本共同社报道，针对中国在钓鱼</a></li>
								<li><a href="#">据日本共同社报道，针对中国在钓鱼</a></li>
								<li><a href="#">据日本共同社报道，针对中国在钓鱼</a></li>
								<li><a href="#">据日本共同社报道，针对中国在钓鱼</a></li>
								<li><a href="#">据日本共同社报道，针对中国在钓鱼</a></li>
								<li><a href="#">据日本共同社报道，针对中国在钓鱼</a></li>
								<li><a href="#">据日本共同社报道，针对中国在钓鱼</a></li>
							</ul>
						</div>
					</div>
				</div>
				<br/>-->
				<div id="topic_list_box" class="topic_list_box">
					<ul class="nav nav-tabs">
						<li class="active"><a href="<?php echo(Dyhb::U('group://public/index'));?>">新帖</a></li>
						<li ><a href="<?php echo(Dyhb::U('group://public/group'));?>">小组</a></li>
					</ul>
					<table width="100%" class="table">
						<thead>
							<tr>
								<th>发帖人</th>
								<th colspan="2" style="text-align:right;">
									<a href="<?php echo(Dyhb::U('group://public/index'));?>" style="<?php if($sType=='create_dateline'):?>color:gray;<?php endif;?>">最新</a>
									<span class="pipe">|</span>
									<a href="<?php echo(Dyhb::U('group://public/index?type='.view));?>" style="<?php if($sType=='grouptopic_views'):?>color:gray;<?php endif;?>">浏览</a>
									<span class="pipe">|</span>
									<a href="<?php echo(Dyhb::U('group://public/index?type='.com));?>" style="<?php if($sType=='grouptopic_comments'):?>color:gray;<?php endif;?>">回复</a>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1;?>
<?php if(is_array($arrGrouptopics)):foreach($arrGrouptopics as $key=>$oGrouptopic):?>

							<tr>
								<td class="author">
									<a href="<?php echo(Dyhb::U('home://space@?id='.$oGrouptopic->user_id));?>">
										<img class="thumbnail" src="<?php echo(Core_Extend::avatar($oGrouptopic['user_id'],'small'));?>" width="45px" height="45px" alt="<?php echo($oGrouptopic->grouptopic_username);?>" />
									</a>
								</td>
								<td class="subject">
									<p class="title">
										<?php if($oGrouptopic->grouptopiccategory_id>0):?>
										<a href="#">[<?php echo($oGrouptopic->grouptopiccategory->grouptopiccategory_name);?>]</a>
										<?php else:?>
										<a href="#">[默认分类]</a>
										<?php endif;?>
										<a href="<?php echo(Dyhb::U('group://topic@?id='.$oGrouptopic->grouptopic_id));?>" title="<?php echo($oGrouptopic->grouptopic_title);?>"><?php echo(G::subString($oGrouptopic->grouptopic_title,0,26));?></a>
									</p>
									<p class="info">
										楼主&nbsp;<a href="<?php echo(Dyhb::U('home://space@?id='.$oGrouptopic->user_id));?>"><?php echo($oGrouptopic->grouptopic_username);?></a>
										<span><?php echo(Core_Extend::timeFormat($oGrouptopic->create_dateline));?></span>
										<span class="pipe">|</span>
										<?php if($oGrouptopic->grouptopic_comments):?>
										<?php $arrLatestComment=$TheController->unserialize($oGrouptopic->grouptopic_latestcomment);?>
										最后回复&nbsp;<a href="<?php echo(Dyhb::U('home://space@?id='.$arrLatestComment['commentuserid']));?>"><?php echo(UserModel::getUsernameById($arrLatestComment['commentuserid']));?></a>
										<span><?php echo(Core_Extend::timeFormat($arrLatestComment['commenttime']));?></span>
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
										<a style="border-bottom: none;" href="javascript:void(0);" onclick="sociaWinopen('<?php echo(Dyhb::U('home://public/socia_login?vendor='.$arrBinded['sociatype_identifier']));?>');">
											<img style="margin:0px 3px 5px 3px; vertical-align: middle;" src="<?php echo($arrBinded['sociatype_logo']);?>" />
										</a>
										<?php if($i>=3 && $i==count($arrBindeds)):?>
										</div>
										<?php endif;?>
										
<?php $i++;?>
<?php endforeach;endif;?>
									</div>
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
									<h6><?php echo($GLOBALS['___login___']['user_name']);?></h6>
									<p>积分&nbsp;<a href="<?php echo(Dyhb::U('home://spaceadmin/rating'));?>"><?php echo($GLOBALS['___login___']['usercount']['usercount_extendcredit1']);?></a></p>
									<p>金币&nbsp;<a href="<?php echo(Dyhb::U('home://spaceadmin/rating'));?>"><?php echo($GLOBALS['___login___']['usercount']['usercount_extendcredit2']);?></a></p>
								</div>
								<div class="user_follow">
									<span><a href="<?php echo(Dyhb::U('home://space@?id='.$GLOBALS['___login___']['user_id'].'&type=friend'));?>"><strong><?php echo($GLOBALS['___login___']['usercount']['usercount_friends']);?></strong></a><br />关注</span>
									<span><a href="<?php echo(Dyhb::U('home://space@?id='.$GLOBALS['___login___']['user_id'].'&type=friend&fan=1'));?>"><strong><?php echo($GLOBALS['___login___']['usercount']['usercount_fans']);?></strong></a><br />粉丝</span>
									<span><a href="<?php echo(Dyhb::U('group://space/topic?uid='.$GLOBALS['___login___']['user_id']));?>"><strong><?php echo($GLOBALS['___login___']['usercount']['usercount_friends']);?></strong></a><br />主题</span>
									<span><a href="<?php echo(Dyhb::U('group://space/topiccomment?uid='.$GLOBALS['___login___']['user_id']));?>"><strong><?php echo($GLOBALS['___login___']['usercount']['usercount_fans']);?></strong></a><br />帖子</span>
								</div>
								<div class="user_profile">
									<?php $arrRatinginfo=UserModel::getUserrating($GLOBALS['___login___']['usercount']['usercount_extendcredit1'],false);?>
									<table class="table">
										<tbody>
											<tr>
												<td colspan="2"><i class="icon-info-sign"></i>&nbsp;性别 保密</td>
											</tr>
											<tr>
												<td colspan="2"><i class="icon-user"></i>&nbsp;2012-09-09注册</td>
											</tr>
											<tr>
												<td colspan="2"><i class="icon-heart"></i>&nbsp;等级&nbsp;<a href="<?php echo(Dyhb::U('home://space@?id='.$GLOBALS['___login___']['user_id'].'&type=rating'));?>" title="当前积分&nbsp;<?php echo($GLOBALS['___login___']['usercount']['usercount_extendcredit1']);?>,等级名字&nbsp;<?php echo($arrRatinginfo['rating_name']);?>,距离下一个等级&nbsp;<?php echo($arrRatinginfo['next_rating']['rating_name']);?>&nbsp;还差&nbsp;<?php echo($arrRatinginfo['next_needscore']);?>&nbsp;积分"><?php echo($arrRatinginfo['rating_name']);?></a></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="user_action">
									<a href="<?php echo(Dyhb::U('group://grouptopic/add'));?>" class="btn btn-success btn-large">发布帖子</a>
									<!--<span class="pipe">|</span>
									<a href="" class="btn btn-large">领取积分</a>-->
								</div>
							</div>
						</div>
						<?php endif;?>
					</div>
					<div class="group_sidebar_item">
						<h2 class="box_title">热门帖子</h2>
						<ul class="grouphottopic_titles">
							<?php $i=1;?>
<?php if(is_array($arrGrouptopic)):foreach($arrGrouptopic as $key=>$oGrouptopic):?>

							<li>
								<h3><a href="<?php echo(Dyhb::U('group://topic@?id='.$oGrouptopic->grouptopic_id));?>" target="_blank" ><?php echo(G::subString($oGrouptopic->grouptopic_title,0,20));?></a></h3>
								<span class="grouphottopic_commentnum"><?php echo($oGrouptopic->grouptopic_comments);?></span>
								<!--<p class="grouphottopic_userinfo">
									<span class="left">来自：<a title="<?php echo($oGrouptopic->grouptopic_username);?>" target="_blank" href="<?php echo(Dyhb::U('home://space@?id='.$oGrouptopic->user_id));?>"><?php echo($oGrouptopic->grouptopic_username);?></a>&nbsp;<?php echo($oGrouptopic->grouptopiccategory->grouptopiccategory_name);?>
									<!--</span>
								</p>-->
								<span style="width:100%;" class="grouphottopic_commentnum">来自：<a title="<?php echo($oGrouptopic->grouptopic_username);?>" target="_blank" href="<?php echo(Dyhb::U('home://space@?id='.$oGrouptopic->user_id));?>" style="color:#999999;"><?php echo($oGrouptopic->grouptopic_username);?></a>&nbsp;<?php echo($oGrouptopic->grouptopiccategory->grouptopiccategory_name);?>
								</span>
							</li>
							
<?php $i++;?>
<?php endforeach;endif;?>
						</ul>
					</div>
					<!--
					<div class="group_sidebar_item">
						<h2 class="box_title">热门标签</h2>
						<div class="tags_hot">
							<ul>
								<li><a href="#">测试</a></li>
								<li><a href="#">测试</a></li>
								<li><a href="#">测试</a></li>
								<li><a href="#">测试</a></li>
								<li><a href="#">测试</a></li>
								<li><a href="#">测试</a></li>
								<li><a href="#">测试</a></li>
								<li><a href="#">测试</a></li>
								<li><a href="#">测试一下话题</a></li>
								<li><a href="#">测试</a></li>
							</ul>
						</div>
					</div>
					-->
				</div>
			</div>
		</div>

<?php $this->includeChildTemplate(Core_Extend::template('footer'));?>