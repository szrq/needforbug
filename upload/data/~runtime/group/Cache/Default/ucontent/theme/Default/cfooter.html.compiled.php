<?php  /* DoYouHaoBaby Framework 模板缓存文件生成时间：2012-10-17 09:07:54  */ ?>
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