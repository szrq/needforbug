<?php  /* DoYouHaoBaby Framework 模板缓存文件生成时间：2012-09-20 01:04:34  */ ?>
		<div class="row">
			<div class="span12">
				<ul class="nav nav-tabs">
					<li <?php if($sType=='new'):?>class="active"<?php endif;?>><a href="<?php echo(Dyhb::U('home://pm/index?type=new'));?>"><?php print Dyhb::L("未读消息",'Template/Pm',null);?><span id="usernew-pm-num">&nbsp;</span></a></li>
					<li <?php if($sType=='user'):?>class="active"<?php endif;?>><a href="<?php echo(Dyhb::U('home://pm/index?type=user'));?>"><?php print Dyhb::L("私人消息",'Template/Pm',null);?></a></li>
					<li <?php if($sType=='my'):?>class="active"<?php endif;?>><a href="<?php echo(Dyhb::U('home://pm/index?type=my'));?>"><?php print Dyhb::L("已发消息",'Template/Pm',null);?></a></li>
					<li <?php if($sType=='systemnew'):?>class="active"<?php endif;?>><a href="<?php echo(Dyhb::U('home://pm/index?type=systemnew'));?>"><?php print Dyhb::L("未读公共消息",'Template/Pm',null);?><span id="systemnew-pm-num">&nbsp;</span></a></li>
					<li <?php if($sType=='system'):?>class="active"<?php endif;?>><a href="<?php echo(Dyhb::U('home://pm/index?type=system'));?>"><?php print Dyhb::L("公共消息",'Template/Pm',null);?></a></li>
					<li <?php if($sType=='pmnew' && ACTION_NAME==='pmnew'):?>class="active"<?php endif;?>><a href="<?php echo(Dyhb::U('home://pm/pmnew'));?>">+<?php print Dyhb::L("发送短消息",'Template/Pm',null);?></a></li>
				</ul>
			</div>
		</div>