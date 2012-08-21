<?php  /* DoYouHaoBaby Framework 模板缓存文件 生成时间：2012-08-21 00:10:28  */ ?>
<!DOCTYPE html><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title><?php echo($GLOBALS['_option_']['needforbug_program_name']);?>! <?php print Dyhb::L("管理平台",'Template/Default/Common',null);?></title><link rel="stylesheet" type="text/css" href="<?php echo(__TMPLPUB__);?>/Css/style.css"/><script type="text/javascript">	var __DYHB_JS_ENTER__='<?php echo(__APP__);?>';
	<?php echo(App::U());?></script><script type="text/javascript" src="<?php echo __LIBCOM__;?>/Js/Vendor/Jquery.js"></script><script type="text/javascript" src="<?php echo __LIBCOM__;?>/Js/Dyhb.package.js"></script><!--[if IE 6]><style type="text/css">	html{overflow-y:scroll;}
	</style><![endif]--><style type="text/css">	html{overflow-x:hidden;}
	</style><link rel="shortcut icon" href="<?php echo(__PUBLIC__);?>/images/common/favicon.png"><base target="main" /></head><body class="fmenu-body"><section class="sidemenu_div"><div class="sidemenu_title"><p><?php if(G::getGpc('title')):?><?php echo($_GET['title']);?><?php else:?><?php print Dyhb::L("首页",'Template/Default/Common',null);?><?php endif;?></p></div></section><script type="text/javascript">function menuClicknum(nMenuId){
	Dyhb.Ajax.Get(D.U('adminctrlmenu/clicknum?id='+nMenuId));
}
</script><aside id="sidebar" class="column"><div id="sidemenu"><!--[if IE 7]><!--><!--<![endif]--><!--[if lte IE 6]><table cellspacing="0"><tr><td><![endif]--><ul><li style="display:none;">&nbsp;</li><?php if(!G::getGpc('title') || G::getGpc('title') == Dyhb::L('首页','Template/Default/Common')):?><li class=''><a onClick="refreshmainframe('<?php echo(Dyhb::U('public/fmain'));?>');currentClass(0);return false;" href="<?php echo(Dyhb::U('public/fmain'));?>"><?php print Dyhb::L("管理中心主页",'Template/Default/Common',null);?></a></li><li class=''><a onClick="refreshmainframe('<?php echo(Dyhb::U('public/program_update'));?>');currentClass(1);return false;" href="<?php echo(Dyhb::U('public/program_update'));?>"><?php print Dyhb::L("程序升级",'Template/Default/Common',null);?></a></li><li class=''><a onClick="refreshmainframe('<?php echo(Dyhb::U('public/profile'));?>');currentClass(2);return false;" href="<?php echo(Dyhb::U('public/profile'));?>"><?php print Dyhb::L("个人中心",'Template/Default/Common',null);?></a></li><li class=''><a onClick="refreshmainframe('<?php echo(Dyhb::U('adminctrlmenu/index'));?>');currentClass(3);return false;" href="<?php echo(Dyhb::U('adminctrlmenu/index'));?>"><?php print Dyhb::L("常用操作管理",'Template/Default/Common',null);?></a></li><?php $i=1;?><?php if(is_array($arrAdminctrlmenus)):foreach($arrAdminctrlmenus as $nAdminctrlmenu=>$arrAdminctrlmenu):?><li class=''><a onClick="refreshmainframe('<?php echo(__APP__);?>?<?php echo($arrAdminctrlmenu['adminctrlmenu_url']);?>');currentClass(<?php echo($nAdminctrlmenu+4);?>);menuClicknum(<?php echo($arrAdminctrlmenu['adminctrlmenu_id']);?>);return false;" href="<?php echo(__APP__);?>?<?php echo($arrAdminctrlmenu['adminctrlmenu_url']);?>"><?php echo($arrAdminctrlmenu['adminctrlmenu_title']);?></a></li><?php $i++;?><?php endforeach;endif;?><?php endif;?><?php $nIndex='0'; ?><?php $i=1;?><?php if(is_array($arrMenuList)):foreach($arrMenuList as $key=>$value):?><?php 
					$arrNode=explode('@',$value['node_name']);
					$sNodeName=$arrNode[1];
				 ?><?php if($value['nodegroup_id'] == $sMenuTag
						and strtolower( $sNodeName ) != 'public'
						and strtolower( $sNodeName ) != 'index'
						and $value['node_access']==1):?><li class=''><a onClick="refreshmainframe('<?php echo(Dyhb::U($sNodeName.'/index'));?>');currentClass(<?php echo($nIndex);?>);return false;" href="<?php echo(Dyhb::U($sNodeName.'/index'));?>"><?php echo($value['node_title']);?></a></li><?php $nIndex++;?><?php endif;?><?php $i++;?><?php endforeach;endif;?></ul><!--[if lte IE 6]></td></tr></table><![endif]--></div><script type="text/javascript">		function refreshmainframe(url){
			parent.main.document.location=url;
		}

		var oAnchor=document.anchors.length;
		if(oAnchor.length>0 && document.anchors(0)){
			refreshmainframe(document.anchors(0).href);
		}

		function getFirstLink(){
			oLinks=document.getElementsByTagName('a');
			nTotal=oLinks.length;
			if(nTotal){
				return oLinks[0];
			}else{
				return '';
			}
		}

		function currentClass(n,bTopFirst){
			if(bTopFirst===true){
				var sFirstLink=getFirstLink();
				if(sFirstLink){
					refreshmainframe(sFirstLink);
				}
			}

			var lis=document.getElementsByTagName('li');
			for(var i=0;i< lis.length;i++){
				lis[i].className='';
			}

			if(typeof lis[n+1]!="undefined"){
				lis[n+1].className='active';
			}
		}

		<?php if(G::getGpc('currentid','G')>0):?>		currentClass(<?php echo(G::getGpc('currentid','G'));?>,<?php if(G::getGpc('notrefershmain','G')>0):?>false<?php else:?>true<?php endif;?>);
		<?php else:?>		currentClass(0,<?php if(G::getGpc('notrefershmain','G')>0):?>false<?php else:?>true<?php endif;?>);
		<?php endif;?></script></aside><?php $this->includeChildTemplate(TEMPLATE_PATH.'/Public/fffooter.html');?>