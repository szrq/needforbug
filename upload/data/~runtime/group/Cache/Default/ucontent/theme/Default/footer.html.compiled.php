<?php  /* DoYouHaoBaby Framework 模板缓存文件生成时间：2012-10-17 09:07:54  */ ?>
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

<?php $this->includeChildTemplate(Core_Extend::template('cfooter'));?>