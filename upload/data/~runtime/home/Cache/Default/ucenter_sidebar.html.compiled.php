<?php  /* DoYouHaoBaby Framework 模板缓存文件生成时间：2012-09-20 01:06:41  */ ?>
<!--[if IE 6]> 
<style type="text/css">
html{overflow:hidden;}
body{height:100%;overflow:auto;}
</style>
<![endif]-->

			<div class="span3">
				<div class="well" style="padding: 8px 0;">
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
							<p><?php print Dyhb::L("积分",'Template/Ucenter',null);?>&nbsp;<a href="<?php echo(Dyhb::U('home://spaceadmin/rating'));?>"><?php echo($GLOBALS['___login___']['usercount']['usercount_extendcredit1']);?></a></p>
							<p><?php print Dyhb::L("金币",'Template/Ucenter',null);?>&nbsp;<a href="<?php echo(Dyhb::U('home://spaceadmin/rating'));?>"><?php echo($GLOBALS['___login___']['usercount']['usercount_extendcredit2']);?></a></p>
						</div>
						<div class="user_follow">
							<span><a href="#"><strong><?php echo($GLOBALS['___login___']['usercount']['usercount_friends']);?></strong></a><br />关注</span>
							<span><a href="#"><strong><?php echo($GLOBALS['___login___']['usercount']['usercount_fans']);?></strong></a><br />粉丝</span>
							<span><a href="#"><strong id="homefresh_count"><?php echo($nMyhomefreshnum);?></strong></a><br />新鲜事</span>
						</div>
					</div>

					<ul class="nav nav-list">
						<li class="nav-header"><?php print Dyhb::L("我的地盘",'Template/Ucenter',null);?></li>
						<li><a href="<?php echo(Dyhb::U('home://spaceadmin/index'));?>"><i class="icon-cog"></i>&nbsp;<?php print Dyhb::L("修改资料",'Template/Ucenter',null);?></a></li>
						<li><a href="<?php echo(Dyhb::U('home://attachment/index'));?>"><i class="icon-picture"></i>&nbsp;<?php print Dyhb::L("我的相册",'Template/Ucenter',null);?></a></li>
						<li><a href="<?php echo(Dyhb::U('home://spaceadmin/tag'));?>"><i class="icon-tags"></i>&nbsp;<?php print Dyhb::L("我的标签",'Template/Ucenter',null);?></a></li>
						<li class="nav-header"><?php print Dyhb::L("我的成长",'Template/Ucenter',null);?></li>
						<li><a href="<?php echo(Dyhb::U('home://friend/index'));?>"><i class="icon-user"></i>&nbsp;<?php print Dyhb::L("我的好友",'Template/Ucenter',null);?></a></li>
						<li class="nav-header"><?php print Dyhb::L("我的应用",'Template/Ucenter',null);?></li>
						<li><a href="<?php echo(Dyhb::U('group://public/index'));?>"><?php print Dyhb::L("群组",'Template/Ucenter',null);?></a></li>
						<li><a href="#"><?php print Dyhb::L("商城",'Template/Ucenter',null);?></a></li>
						<li class="divider"></li>
						<li><a href="<?php echo(Dyhb::U('home://homehelp/index'));?>"><i class="icon-flag"></i>&nbsp;<?php print Dyhb::L("帮助",'Template/Ucenter',null);?></a></li>
					</ul>
				</div>
			</div>