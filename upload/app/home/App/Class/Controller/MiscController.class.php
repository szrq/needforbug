<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   主页杂项控制器($)*/

!defined('DYHB_PATH') && exit;

class MiscController extends InitController{

	public function district(){
		Core_Extend::doControllerAction('Misc@District','index');
	}

	public function newpmnum(){
		Core_Extend::doControllerAction('Misc@Newpmnum','index');
	}

	public function style(){
		Core_Extend::doControllerAction('Misc@Style','index');
	}

	public function extendstyle(){
		Core_Extend::doControllerAction('Misc@Extendstyle','index');
	}

	public function init_system(){
		Core_Extend::doControllerAction('Misc@Initsystem','index');
	}

	public function avatar(){
		echo <<<n
<div class="bm_hover_card_content udline">
<div class="bm_hover_card_avator"><a href="http://weibo.com/samnous"><img src="images/my_avatar.jpg" height="50" width="50" /></a></div>
<div class="bm_hover_card_name"><a href="http://weibo.com/samnous">Jamin-IT</a><img src="images/transparent.gif" class="male" height="14" width="14" /></div>
<div class="bm_hover_card_from"><span>北京</span><span>朝阳区</span></div>
<div class="bm_hover_card_signaure">俄罗斯方块告诉我们，犯了错误会...</div>
<div class="clear"></div>
<div class="bm_hover_card_info">
	<p><a href="http://meego123.net">关注</a><a href="http://meego123.net">粉丝</a><a href="http://meego123.net">分享</a></p>
    <p><span>1</span><span>12</span><span>1234</span></p>
</div>
</div>
<div class="bm_hover_card_bar"><a href="http://meego123.net" class="add_follow"></a></div>
n;
	}

}
