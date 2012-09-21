<?php  /* DoYouHaoBaby Framework 模板缓存文件生成时间：2012-09-20 01:05:13  */ ?>
<?php $this->includeChildTemplate(Core_Extend::template('header'));?>

		<ul class="breadcrumb">
			<li><a href="<?php echo(__APP__);?>" title="<?php print Dyhb::L("主页",'__COMMON_LANG__@Template/Common',null);?>"><i class='icon-home'></i></a>&nbsp;<span class="divider">/</span>&nbsp;</li>
			<li><?php print Dyhb::L("404 未找到",'__COMMON_LANG__@Template/Notfound404',null);?></li>
		</ul>
		
		<div class="row">
			<div class="span2">&nbsp;</div>
			<div class="span8" style="text-align:center;">
				<div style="margin-bottom:50px;">
					<img src="<?php echo(__UTHEMEPUB__);?>/Images/404.png"/>
				</div>
				<h1><?php print Dyhb::L("你访问的页面不存在",'__COMMON_LANG__@Template/Notfound404',null);?></h1>
				<div style="margin-top:10px;">
					<a href="<?php echo(Dyhb::U('home://public/index'));?>" class="btn"><i class="icon-share-alt"></i>&nbsp;<?php print Dyhb::L("返回首页",'__COMMON_LANG__@Template/Notfound404',null);?></a>
				</div>
			</div>
			<div class="span2">&nbsp;</div>
		</div>

<?php $this->includeChildTemplate(Core_Extend::template('footer'));?>