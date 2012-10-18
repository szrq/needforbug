<?php  /* DoYouHaoBaby Framework 模板缓存文件生成时间：2012-10-17 08:35:03  */ ?>
<?php $this->includeChildTemplate(Core_Extend::template('header'));?>

<script src="<?php echo(__ROOT__);?>/source/extension/socialization/static/js/socia.js"></script>
	
		<ul class="breadcrumb">
			<li><a href="<?php echo(__APP__);?>" title="<?php print Dyhb::L("主页",'__COMMON_LANG__@Template/Common',null);?>"><i class='icon-home'></i></a>&nbsp;<span class="divider">/</span>&nbsp;<?php print Dyhb::L("主页",'__COMMON_LANG__@Template/Common',null);?></li>
			<li style='width:auto;text-align:right;float:right;overflow:hidden;'>
				<?php print Dyhb::L("会员",'Template/Public',null);?>&nbsp;<?php echo($arrSite['user']);?><span class='divider'>/</span>&nbsp;
				<?php print Dyhb::L("应用",'Template/Public',null);?>&nbsp;<?php echo($arrSite['app']);?>&nbsp;<span class='divider'>/</span>&nbsp;
				<?php print Dyhb::L("新鲜事",'Template/Public',null);?>&nbsp;<?php echo($arrSite['homefresh']);?>&nbsp;<span class='divider'>/</span>&nbsp;
				<?php print Dyhb::L("评论",'Template/Public',null);?>&nbsp;<?php echo($arrSite['homefreshcomment']);?>
			</li>
		</ul>

		<div class="row">
			<div class="span12">
			<div class="hero-unit">
				<h1><?php print Dyhb::L("新社区",'Template/Public',null);?></h1>
				<p><?php echo($sHomeDescription);?></p>
				<blockquote>
					<small><?php echo($GLOBALS['_option_']['site_description']);?></small>
				</blockquote>
				<p><?php if($GLOBALS['___login___']===false):?>
					<a class="btn btn-success btn-large" href="<?php echo(Dyhb::U('home://public/register'));?>"><?php print Dyhb::L("加入我们",'Template/Public',null);?></a>
					<?php endif;?>
				</p>
			</div>
			</div>
		</div>

		<div class="row">
			<div class="span8">
				<div id="myCarousel" class="carousel slide">
					<div class="carousel-inner">
						<?php $i=1;?>
<?php if(is_array($arrSlides)):foreach($arrSlides as $key=>$arrSlide):?>

						<div class="item <?php if($key==0):?>active<?php endif;?>" style="350px">
							<img src="<?php echo($arrSlide['slide_img']);?>" style="height:300px;" width="100%">
							<div class="carousel-caption">
								<h4><a href="<?php echo($arrSlide['slide_url']);?>" title="<?php echo($arrSlide['slide_title']);?>"><?php echo($arrSlide['slide_title']);?></a></h4>
							</div>
						</div>
						
<?php $i++;?>
<?php endforeach;endif;?>
					</div>
					<a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
					<a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
				</div>
			</div>
			<div class="span4">
				<div class="well" style="height:260px;">
					<?php if($GLOBALS['___login___']===false):?>
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
					<?php else:?>
					<h3><a href="<?php echo(Dyhb::U('home://ucenter/index'));?>"><?php print Dyhb::L("返回个人中心",'Template/Public',null);?></a></h3>
					<table class="table">
						<tbody>
							<tr>
								<td rowspan="4" width="40%">
									<a href="<?php echo(Dyhb::U('home://spaceadmin/avatar'));?>">
									<img src="<?php echo(Core_Extend::avatar($GLOBALS['___login___']['user_id']));?>" width="120px" height="120px" class="thumbnail"/></a>
								</td>
								<td width="60%"><i class="icon-cog"></i>&nbsp;<a href="<?php echo(Dyhb::U('home://spaceadmin/index'));?>"><?php print Dyhb::L("修改资料",'Template/Public',null);?></a></td>
							</tr>
							<tr>
								<td><i class="icon-lock"></i>&nbsp;<a href="<?php echo(Dyhb::U('home://spaceadmin/password'));?>"><?php print Dyhb::L("修改密码",'Template/Public',null);?></a></td>
							</tr>
							<tr>
								<td><i class="icon-tags"></i>&nbsp;<a href="<?php echo(Dyhb::U('home://spaceadmin/tag'));?>"><?php print Dyhb::L("我的标签",'Template/Public',null);?></a></td>
							</tr>
							<tr>
								<td><i class="icon-off"></i>&nbsp;<a href="<?php echo(Dyhb::U('home://public/logout'));?>"><?php print Dyhb::L("注销",'Template/Public',null);?></a></td>
							</tr>
						</tbody>
					</table>
					<hr/>
					<a class="btn btn-success btn-large" href="<?php echo(Dyhb::U('home://ucenter/index'));?>"><i class="icon-info-sign icon-white"></i>&nbsp;<?php print Dyhb::L("个人中心",'Template/Public',null);?></a>
					<?php endif;?>
				</div>
			</div>
		</div>

		<?php if($arrLinkDatas['link_content'] || $arrLinkDatas['link_text'] || $arrLinkDatas['link_logo']):?>
		<div class="row">
			<div class="span12">
				<h3><?php print Dyhb::L("友情衔接",'Template/Public',null);?></h3>
				<hr/>
				<?php if($arrLinkDatas['link_content']):?>
				<div class="home-links">
					<ul class="clear">
						<?php echo($arrLinkDatas['link_content']);?>
					</ul>
				</div>
				<?php endif;?>
				<?php if($arrLinkDatas['link_logo']):?>
					<div class="home-img-link">
						<?php echo($arrLinkDatas['link_logo']);?>
					</div>
				<?php endif;?>
				<?php if($arrLinkDatas['link_text']):?>
				<hr/>
				<div class="home-txt-link">
					<ul class="clear">
						<?php echo($arrLinkDatas['link_text']);?>
					</ul>
				</div>
				<?php endif;?>
			</div>
		</div><!--/row-->
		<?php endif;?>

<?php $this->includeChildTemplate(Core_Extend::template('footer'));?>