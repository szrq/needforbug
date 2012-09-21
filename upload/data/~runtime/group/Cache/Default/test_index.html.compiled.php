<?php  /* DoYouHaoBaby Framework 模板缓存文件生成时间：2012-09-21 02:24:54  */ ?>
<?php $this->includeChildTemplate(Core_Extend::template('header'));?>
		<ul class="breadcrumb">
			<li><a href="<?php echo(__APP__);?>" title="<?php print Dyhb::L("主页",'__COMMON_LANG__@Template/Common',null);?>"><i class='icon-home'></i></a>&nbsp;<span class="divider">/</span>&nbsp;</li>
			<li><a href="<?php echo(Dyhb::U('group://public/index'));?>">商城</a>&nbsp;<span class="divider">/</span>&nbsp;</li>
			<li>首页</li>
		</ul>

<div class="row">

  <!-- Navbar================================================== -->
    <div class="span12">
      
      <ul class="nav nav-pills">
        <li class="active"><a href="#">书画院首页</a></li>
        <li><a href="#">共育蓓蕾</a></li>
        <li><a href="#">讨论茶馆</a></li>
		<li><a href="#">书院名家画廊</a></li>
		<li><a href="#">阿文画廊</a></li>
		<li><a href="#">中文画廊</a></li>
		<li><a href="#">书画画廊</a></li>
		<li><a href="#">字画画廊</a></li>
		<li><a href="#">名人画廊</a></li>
      </ul>
    </div>

    <div class="span12">
    <p>
    <h5>阅览你喜欢的原创书画作品</h5>
    </p>
    </div>

    <div class="span3">
      <div class="hero-unit" style="height:250px">
        <h2>最佳好评的作品</h2>
      </div>
      <a class="btn" href="">去瞧瞧</a>
    </div>

    <div class="span3">
      <div class="hero-unit" style="height:250px">
        <h2>新鲜出炉的创作</h2>
      </div>
          <a class="btn" href="">去瞧瞧</a>
    </div>

  
    <div class="span3">
      <div class="hero-unit"style="height:250px">
        <h2>更多热销的作品</h2>
      </div>
          <a class="btn" href="">去瞧瞧</a>
    </div>

    <div class="span3">
      <div class="hero-unit"style="height:250px">
        <h2>30%折扣专区作品</h2>
      </div>
          <a class="btn" href="">去瞧瞧</a>
    </div>

 <div class="span12">
 <hr/>
          <a class="btn.btn-small" href="<?php echo(Dyhb::U('group://test/index2'));?>">下一页</a>
    </div>

</div>


	
<?php $this->includeChildTemplate(Core_Extend::template('footer'));?>