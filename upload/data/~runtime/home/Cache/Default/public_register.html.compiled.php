<?php  /* DoYouHaoBaby Framework 模板缓存文件 生成时间：2012-08-21 00:31:07  */ ?>
<?php $this->includeChildTemplate(Core_Extend::template('header'));?><script src="<?php echo(__PUBLIC__);?>/js/jquery/validate/jquery.validate.min.js"></script><link rel="stylesheet" type="text/css" href="<?php echo(__PUBLIC__);?>/js/jquery/validate/images/validate.css"/><script src="<?php echo(__APPPUB__);?>/Js/register.js"></script><ul class="breadcrumb"><li><a href="<?php echo(__APP__);?>" title="<?php print Dyhb::L("主页",'__COMMON_LANG__@Template/Common',null);?>"><i class='icon-home'></i></a>&nbsp;<span class="divider">/</span>&nbsp;</li><li><?php print Dyhb::L("用户注册",'Template/Public',null);?></li></ul><div class="row"><div class="span7"><form class="form-horizontal" method='post' name="register_form" id="register_form"><fieldset><div class="control-group"><div class="controls"><div id="result" class="none"></div></div></div><div class="control-group"><label class="control-label" for="user_name"><?php print Dyhb::L("用户名",'Template/Public',null);?><em class="red">*</em></label><div class="controls"><input class="input-xlarge" id="user_name" name="user_name" type="text" value=""><span></span></div></div><div class="control-group"><label class="control-label" for="user_nikename"><?php print Dyhb::L("用户昵称",'Template/Public',null);?></label><div class="controls"><input class="input-xlarge" id="user_nikename" name="user_nikename" type="text" value=""><span></span></div></div><div class="control-group"><label class="control-label" for="user_name"><?php print Dyhb::L("密码",'Template/Public',null);?><em class="red">*</em></label><div class="controls"><input class="input-xlarge" type="password" id="user_password" name="user_password" type="text" value=""><span></span></div></div><div class="control-group"><label class="control-label" for="user_name_confirm"><?php print Dyhb::L("确认密码",'Template/Public',null);?><em class="red">*</em></label><div class="controls"><input class="input-xlarge" type="password" id="user_password_confirm" name="user_password_confirm" type="text" value=""><span></span></div></div><div class="control-group"><label class="control-label" for="user_email">Email<em class="red">*</em></label><div class="controls"><input class="input-xlarge" id="user_email" name="user_email" type="text" value=""><span></span></div></div><?php if($nDisplaySeccode==1):?><div class="control-group"><label class="control-label" for="seccode"><?php print Dyhb::L("验证码",'__COMMON_LANG__@Template/Common',null);?><em class="red">*</em></label><div class="controls"><input class="input-small" name="seccode" id="seccode" type="text" value=""><p class="help-block"><span id="seccodeImage"><img style="cursor:pointer" onclick="updateSeccode()" src="<?php echo(Dyhb::U('home://public/seccode'));?>" /></span></p></div></div><?php endif;?><div class="form-actions"><input type="hidden" name="ajax" value="1"><button type="submit" class="btn btn-success" id="register_submit"><?php print Dyhb::L("注册",'__COMMON_LANG__@Template/Common',null);?></button><a href="<?php echo(__APP__);?>" class="btn"><?php print Dyhb::L("取消",'__COMMON_LANG__@Template/Common',null);?></a></div></fieldset></form></div><div class="span5"><h3><?php print Dyhb::L("已有帐号？请直接注册",'Template/Public',null);?></h3><p><a href="<?php echo(Dyhb::U('home://public/login'));?>" class="btn btn-success"><?php print Dyhb::L("用户登录",'Template/Public',null);?></a></p></div></div><!--/row--><?php $this->includeChildTemplate(Core_Extend::template('footer'));?>