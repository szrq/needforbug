<?php  /* DoYouHaoBaby Framework 模板缓存文件生成时间：2012-09-21 10:03:56  */ ?>
<?php $this->includeChildTemplate(Core_Extend::template('header'));?>

		<ul class="breadcrumb">
			<li><a href="<?php echo(__APP__);?>" title="<?php print Dyhb::L("主页",'__COMMON_LANG__@Template/Common',null);?>"><i class='icon-home'></i></a>&nbsp;<span class="divider">/</span>&nbsp;</li>
			<li><a href="<?php echo(Dyhb::U('group://public/index'));?>">商城测试</a>&nbsp;<span class="divider">/</span>&nbsp;</li>
			<li>清单</li>
		</ul>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button"class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="./index.html">Bootstrap</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="">
                <a href="./index.html">Overview</a>
              </li>
              <li class="">
                <a href="./scaffolding.html">Scaffolding</a>
              </li>
              <li class="">
                <a href="./base-css.html">Base CSS</a>
              </li>
              <li class="">
                <a href="./components.html">Components</a>
              </li>
              <li class="">
                <a href="./javascript.html">Javascript plugins</a>
              </li>
              <li class="active">
                <a href="./less.html">Using LESS</a>
              </li>
              <li class="divider-vertical"></li>
              <li class="">
                <a href="./download.html">Customize</a>
              </li>
              <li class="">
                <a href="./examples.html">Examples</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="container">

<?php $this->includeChildTemplate(Core_Extend::template('footer'));?>