<?php  /* DoYouHaoBaby Framework 模板缓存文件生成时间：2012-09-20 01:02:51  */ ?>
		<hr/>
		</div><!--/container-->
	</div><!--/content-->

	<footer id="footer">
		<div class="container">
			<div class="row">
				<div class="span4">
					<p>Copyright &copy; <?php echo($GLOBALS['_option_']['site_year']);?> &nbsp;<?php echo($GLOBALS['_option_']['site_name']);?>.</p>
					<p>Powered by <strong><a href="<?php echo($GLOBALS['_option_']['needforbug_program_url']);?>" title="<?php echo($GLOBALS['_option_']['needforbug_program_year']);?>"><?php echo($GLOBALS['_option_']['needforbug_program_name']);?></a></strong> <em><?php echo($GLOBALS['_option_']['needforbug_program_version']);?></em>.</p>
				</div>
				<div class="span8">
					<p><?php $arrFooterNavs=$GLOBALS['_cache_']['nav']['footer'];?>
					<?php $i=1;?>
<?php if(is_array($arrFooterNavs)):foreach($arrFooterNavs as $key=>$arrFooterNav):?>

					<a <?php echo($arrFooterNav['style']);?> title="<?php echo($arrFooterNav['description']);?>" href="<?php echo($arrFooterNav['link']);?>" <?php echo($arrFooterNav['target']);?>>
						<?php echo($arrFooterNav['title']);?>
					</a>
					<span class="pipe">|</span>
					
<?php $i++;?>
<?php endforeach;endif;?>
					<a href="<?php echo($GLOBALS['_option_']['needforbug_company_url']);?>" title="<?php echo($GLOBALS['_option_']['needforbug_company_year']);?>"><?php echo($GLOBALS['_option_']['needforbug_company_name']);?></a>
					<?php echo($GLOBALS['_option_']['stat_code']);?>
					<?php if(!empty($GLOBALS['_option_']['icp'])):?>
						<span class="pipe">|</span>
						<a href="http://www.miitbeian.gov.cn/"><?php echo($GLOBALS['_option_']['icp']);?></a>
						<?php endif;?>
					</p>
					<p class="footer_debug">GMT <?php echo($GLOBALS['_commonConfig_']['TIME_ZONE']);?>, <?php echo(date('Y-m-d H:i'));?>. <span class="runtime_result" id="runtime_result"><?php print Dyhb::L("数据加载中",'__COMMON_LANG__@Template/Header',null);?></span>
					</p>
				</div>
			</div>
		</div>
	</footer>

</div><!--/wrapper-->

	<script src="<?php echo(__PUBLIC__);?>/extension/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo(__PUBLIC__);?>/js/common/global.js"></script>
	<script src="<?php echo(__PUBLIC__);?>/js/common/common.js"></script>
	<?php $sAppjsPath=APP_PATH.'/Static/Js/'.APP_NAME.'.js';?>
	<?php if(is_file($sAppjsPath)):?>
	<script src="<?php echo(__APPPUB__);?>/Js/<?php echo(APP_NAME);?>.js"></script>
	<?php endif;?>
	<script src="<?php echo(__PUBLIC__);?>/js/common/top.js"></script>

	<?php if($GLOBALS['___login___']!==false):?>
	<script src="<?php echo(__PUBLIC__);?>/js/pm/pm.js" type="text/javascript"></script>
	<?php $sSoundOuturl=$GLOBALS['_option_']['pm_sound_out_url']?
		$GLOBALS['_option_']['pm_sound_out_url']:
		__PUBLIC__."/images/common/sound/pm_".$GLOBALS['_option_']['pm_sound_type'].".mp3";?>
	<script type="text/javascript">
	getNewpms(<?php echo($GLOBALS['___login___']['user_id']);?>);
	var pm_sound_on=<?php echo($GLOBALS['_option_']['pm_sound_on']);?>;
	var sound_outurl='<?php echo($sSoundOuturl);?>';
	</script>
	<?php endif;?>

</body>
</html>