<?php  /* DoYouHaoBaby Framework 模板缓存文件生成时间：2012-09-20 01:24:44  */ ?>
<?php $this->includeChildTemplate(Core_Extend::template('header'));?>

		<ul class="breadcrumb">
			<li><a href="<?php echo(__APP__);?>" title="<?php print Dyhb::L("主页",'__COMMON_LANG__@Template/Common',null);?>"><i class='icon-home'></i></a>&nbsp;<span class="divider">/</span>&nbsp;</li>
			<li><a href="<?php echo(Dyhb::U('group://public/index'));?>">测试</a>&nbsp;<span class="divider">/</span>&nbsp;</li>
			<li>测试</li>
		</ul>

		<div class="hero-unit">
			<h1>Hello, world!</h1>
			<p>This is a template for a simple marketing or informational website. It includes a large callout called the hero unit and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
		 <p><a class="btn btn-primary btn-large">Learn more &raquo;</a></p>
		</div>

		<div class="row">
			<div class="span12">
				Hello word
			</div>
			<div class="span4">
          <h2>Heading</h2>
           <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn" href="#">View details &raquo;</a></p>
        </div>
        <div class="span4">
          <h2>Heading</h2>
           <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn" href="#">View details &raquo;</a></p>
       </div>
        <div class="span4">
          <h2>Heading</h2>
          <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
          <p><a class="btn" href="#">View details &raquo;</a></p>
        </div>
		<div class="span4">
		<div class="well" style="padding: 8px 0;">
        <ul class="nav nav-list">
          <li class="nav-header">List header</li>
          <li class="active"><a href="#"><i class="icon-white icon-home"></i> Home</a></li>
          <li><a href="#"><i class="icon-book"></i> Library</a></li>
          <li><a href="#"><i class="icon-pencil"></i> Applications</a></li>
          <li class="nav-header">Another list header</li>
          <li><a href="#"><i class="icon-user"></i> Profile</a></li>
          <li><a href="#"><i class="icon-cog"></i> Settings</a></li>
          <li class="divider"></li>
          <li><a href="#"><i class="icon-flag"></i> Help</a></li>
        </ul>
      </div>
		</div>
		<div class="span8">
		test
		</div>
		</div>

<?php $this->includeChildTemplate(Core_Extend::template('footer'));?>