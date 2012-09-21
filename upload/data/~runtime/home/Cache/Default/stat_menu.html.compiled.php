<?php  /* DoYouHaoBaby Framework 模板缓存文件生成时间：2012-09-20 01:05:19  */ ?>
		<div class="row">
			<div class="span12">
				<ul class="nav nav-tabs">
					<li <?php if(ACTION_NAME==='index'):?>class="active"<?php endif;?>><a href="<?php echo(Dyhb::U('home://stat/index'));?>"><?php print Dyhb::L("基本概况",'Template/Stat',null);?></a></li>
					<li <?php if(ACTION_NAME==='userlist'):?>class="active"<?php endif;?>><a href="<?php echo(Dyhb::U('home://stat/userlist'));?>"><?php print Dyhb::L("会员列表",'Template/Stat',null);?></a></li>
				</ul>
			</div>
		</div>