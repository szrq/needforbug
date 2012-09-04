<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   用户新鲜事控制器($)*/

!defined('DYHB_PATH') && exit;

class HomefreshController extends InitController{

	public function index(){
		$arrWhere=array();
		
		$sType=trim(G::getGpc('type','G'));
		if(empty($sType)){
			$sType='';
		}
		$this->assign('sType',$sType);
		
		switch($sType){
			case 'myself':
				$arrWhere['user_id']=$GLOBALS['___login___']['user_id'];
				break;
			case 'friend':
				// 仅好友
				$arrUserIds=FriendModel::getFriendById($GLOBALS['___login___']['user_id']);
			
				if(!empty($arrUserIds)){
					$arrWhere['user_id']=array('in',$arrUserIds);
				}else{
					$arrWhere['user_id']='';
				}
				break;
			case 'all':
				// 这里可以设置用户隐私，比如用户不愿意将动态放出
				break;
			default:
				// 我和好友
				$arrUserIds=FriendModel::getFriendById($GLOBALS['___login___']['user_id']);
				$arrUserIds[]=$GLOBALS['___login___']['user_id'];

				if(!empty($arrUserIds)){
					$arrWhere['user_id']=array('in',$arrUserIds);
				}else{
					$arrWhere['user_id']='';
				}
				break;
		}
		
		$arrOptionData=$GLOBALS['_cache_']['home_option'];

		$sGoodCookie=Dyhb::cookie('homefresh_goodnum');
		$arrGoodCookie=explode(',',$sGoodCookie);
		$this->assign('arrGoodCookie',$arrGoodCookie);

		// 新鲜事
		$arrWhere['homefresh_status']=1;
		$nTotalRecord=HomefreshModel::F()->where($arrWhere)->all()->getCounts();

		$oPage=Page::RUN($nTotalRecord,$arrOptionData['homefresh_list_num'],G::getGpc('page','G'));

		$arrHomefreshs=HomefreshModel::F()->where($arrWhere)->order('create_dateline DESC')->limit($oPage->returnPageStart(),$arrOptionData['homefresh_list_num'])->getAll();
		$this->assign('arrHomefreshs',$arrHomefreshs);
		$this->assign('sPageNavbar',$oPage->P('pagination','li','active'));
		$this->assign('nDisplaySeccode',$GLOBALS['_option_']['seccode_publish_status']);
		
		$this->display('homefresh+index');
	}

	public function get_newcomment($nId){
		return HomefreshcommentModel::F(
				'homefresh_id=? AND homefreshcomment_status=1 AND
				homefreshcomment_auditpass=1 AND homefreshcomment_parentid=0',$nId
			)->limit(0,4)->order('homefreshcomment_id DESC')->getAll();
	}

	public function get_newchildcomment($nId,$nCommentid){
		return HomefreshcommentModel::F(
				'homefresh_id=? AND homefreshcomment_status=1 AND
				homefreshcomment_auditpass=1 AND homefreshcomment_parentid=?',$nId,$nCommentid
			)->limit(0,4)->order('homefreshcomment_id DESC')->getAll();
	}

	public function add(){
		if($GLOBALS['_option_']['seccode_publish_status']==1){
			$this->check_seccode(true);
		}

		$sMessage=trim(G::cleanJs(G::getGpc('homefresh_message','P')));
		if(empty($sMessage)){
			$this->E(Dyhb::L('新鲜事内容不能为空','Controller/Homefresh'));
		}
		
		$oHomefresh=new HomefreshModel();
		$oHomefresh->safeInput();
		$oHomefresh->homefresh_status=1;
		$oHomefresh->save(0,'save');

		if($oHomefresh->isError()){
			$this->E($oHomefresh->getErrorMessage());
		}else{
			// 判断是否将新鲜事更新到签名
			if(G::getGpc('synchronized-to-sign','P')==1){
				if(strlen($sMessage)>1000){
					$sMessage=Core_Extend::htmlSubstring($sMessage,1000);
				}
				
				// 更新到前用户的签名信息
				$oUser=UserModel::F('user_id=?',$GLOBALS['___login___']['user_id'])->getOne();
				$oUser->user_sign=$sMessage;
				$oUser->save(0,'update');
		
				if($oUser->isError()){
					$this->E($oUser->getErrorMessage());
				}
			}

			$arrHomefreshData=$oHomefresh->toArray();
			$arrHomefreshData['space']=Dyhb::U('home://space@?id='.$oHomefresh['user_id']);
			$arrHomefreshData['avatar']=Core_Extend::avatar($oHomefresh['user_id'],'small');
			$arrHomefreshData['user_name']=$oHomefresh->user->user_name;
			$arrHomefreshData['create_dateline']=Core_Extend::timeFormat($oHomefresh['create_dateline']);
			$arrHomefreshData['homefresh_message']=G::subString(strip_tags($oHomefresh['homefresh_message']),0,$GLOBALS['_cache_']['home_option']['homefresh_list_substring_num']);
			$arrHomefreshData['url']=Dyhb::U('home://fresh@?id='.$oHomefresh['homefresh_id']);

			$this->A($arrHomefreshData,Dyhb::L('添加新鲜事成功','Controller/Homefresh'),1);
		}
	}

	public function view(){
		$nId=intval(G::getGpc('id','G'));

		if(empty($nId)){
			$this->E(Dyhb::L('你没有指定要阅读的新鲜事','Controller/Homefresh'));
		}

		$oHomefresh=HomefreshModel::F('homefresh_id=? AND homefresh_status=1',$nId)->getOne();
		if(empty($oHomefresh['homefresh_id'])){
			$this->E(Dyhb::L('新鲜事不存在或者被屏蔽了','Controller/Homefresh'));
		}

		$oHomefresh->homefresh_viewnum=$oHomefresh->homefresh_viewnum+1;
		$oHomefresh->save(0,'update');

		if($oHomefresh->isError()){
			$this->E($oHomefresh->getErrorMessage());
		}

		$sHomefreshtitle=$oHomefresh->homefresh_title?$oHomefresh->homefresh_title:G::subString(strip_tags($oHomefresh['homefresh_message']),0,30);

		// 读取评论列表
		$arrOptionData=$GLOBALS['_cache_']['home_option'];

		$arrWhere=array();
		$arrWhere['homefreshcomment_status']=1;
		$arrWhere['homefresh_id']=$nId;
		
		if($GLOBALS['___login___']['user_id']!=$oHomefresh['user_id']){
			$arrWhere['homefreshcomment_auditpass']=1;
		}

		$nTotalRecord=HomefreshcommentModel::F()->where($arrWhere)->all()->getCounts();
		$oPage=Page::RUN($nTotalRecord,$arrOptionData['homefreshcomment_list_num'],G::getGpc('page','G'));

		$arrHomefreshcommentLists=HomefreshcommentModel::F()->where($arrWhere)->all()->order('`create_dateline` DESC')->limit($oPage->returnPageStart(),$arrOptionData['homefreshcomment_list_num'])->getAll();

		// 取得个人主页
		$oUserprofile=UserprofileModel::F('user_id=?',$GLOBALS['___login___']['user_id'])->getOne();

		$this->assign('oHomefresh',$oHomefresh);
		$this->assign('sHomefreshtitle',$sHomefreshtitle);
		$this->assign('nTotalHomefreshcomment',$nTotalRecord);
		$this->assign('sPageNavbar',$oPage->P('pagination','li','active'));
		$this->assign('arrHomefreshcommentLists',$arrHomefreshcommentLists);
		$this->assign('sUsersite',$oUserprofile['userprofile_site']);
		$this->assign('nDisplaySeccode',$GLOBALS['_cache_']['home_option']['seccode_comment_status']);

		$this->display('homefresh+view');
	}

	public function add_comment(){
		$arrOptions=$GLOBALS['_cache_']['home_option'];
		
		if($arrOptions['close_comment_feature']==1){
			$this->E(Dyhb::L('系统关闭了评论功能','Controller/Homefresh'));
		}

		if($arrOptions['seccode_comment_status']==1){
			$this->check_seccode(true);
		}

		// IP禁止功能
		$sCommentBanIp=trim($arrOptions['comment_ban_ip']);
		$sOnlineip=G::getIp();
		if($arrOptions['comment_banip_enable']==1 && $sCommentBanIp){
			$sCommentBanIp=str_replace('，',',',$sCommentBanIp);
			$arrCommentBanIp=Dyhb::normalize(explode(',', $sCommentBanIp));
			if(is_array($arrCommentBanIp) && count($arrCommentBanIp)){
				foreach($arrCommentBanIp as $sValueCommentBanIp){
					$sValueCommentBanIp=str_replace('\*','.*',preg_quote($sValueCommentBanIp,"/"));
					if(preg_match("/^{$sValueCommentBanIp}/",$sOnlineip)){
						$this->E(Dyhb::L('您的IP %s 已经被系统禁止发表评论','Controller/Homefresh',null,$sOnlineip));
					}
				}
			}
		}

		// 评论名字检测
		$sCommentName=trim(G::getGpc('homefreshcomment_name'));
		if(empty($sCommentName)){
			$this->E(Dyhb::L('评论名字不能为空','Controller/Homefresh'));
		}
		$arrNamekeys=array("\\",'&',' ',"'",'"','/','*',',','<','>',"\r","\t","\n",'#','$','(',')','%','@','+','?',';','^');
		foreach($arrNamekeys as $sNamekeys){
			if(strpos($sCommentName,$sNamekeys)!==false){
				$this->E(Dyhb::L('此评论名字包含不可接受字符或被管理员屏蔽,请选择其它名字','Controller/Homefresh'));
			}
		}

		// 评论内容长度检测
		$sCommentContent=trim(G::getGpc('homefreshcomment_content'));
		$nCommentMinLen=intval($arrOptions['comment_min_len']);
		if($nCommentMinLen && strlen($sCommentContent)<$nCommentMinLen){
			$this->E(Dyhb::L('评论内容最少的字节数为 %d','Controller/Homefresh',null,$nCommentMinLen));
		}

		$nCommentMaxLen=intval($arrOptions['comment_max_len']);
		if($nCommentMaxLen && strlen($sCommentContent)>$nCommentMaxLen){
			$this->E(Dyhb::L('评论内容最大的字节数为 %d','Controller/Homefresh',null,$nCommentMaxLen));
		}

		// 创建评论模型
		$oHomefreshcomment=new HomefreshcommentModel();

		// SPAM 垃圾信息阻止
		$bDisallowedSpamWordToDatabase=$arrOptions['disallowed_spam_word_to_database']?true:false;
		if($arrOptions['comment_spam_enable']){
			$nCommentSpamUrlNum=intval($arrOptions['comment_spam_url_num']);
			if($nCommentSpamUrlNum){
				if(substr_count($sCommentContent,'http://')>=$nCommentSpamUrlNum){
					if($bDisallowedSpamWordToDatabase){
						$this->E(Dyhb::L('评论内容中出现的衔接数量超过了系统的限制 %d 条','Controller/Homefresh',null,$nCommentSpamUrlNum));
					}else{
						$oHomefreshcomment->homefreshcomment_status=0;
					}
				}
			}

			$sSpamWords=trim($arrOptions['comment_spam_words']);
			if($sSpamWords){
				$sSpamWords=str_replace('，',',',$sSpamWords);
				$arrSpamWords=Dyhb::normalize(explode(',',$sSpamWords));
				if(is_array($arrSpamWords) && count($arrSpamWords)){
					foreach($arrSpamWords as $sValueSpamWords){
						if($sValueSpamWords){
							if(preg_match("/".preg_quote($sValueSpamWords,'/')."/i",$sCommentContent)){
								if($bDisallowedSpamWordToDatabase){
									$this->E(Dyhb::L("你的评论内容包含系统屏蔽的词语%s",'Controller/Homefresh',null,$sValueSpamWords));
								}else{
									$oHomefreshcomment->homefreshcomment_status=0;
								}
								break;
							}
						}
					}
				}
			}

			$nCommentSpamContentSize=intval($arrOptions['comment_spam_content_size']);
			if($nCommentSpamContentSize){
				if(strlen($sCommentContent)>=$nCommentSpamContentSize){
					if($bDisallowedSpamWordToDatabase){
						$this->E(Dyhb::L('评论内容最大的字节数为%d','Controller/Homefresh',null,$nCommentSpamContentSize));
					}else{
						$oHomefreshcomment->homefreshcomment_status=0;
					}
				}
			}
		}

		// 发表评论间隔时间
		$nCommentPostSpace=intval($arrOptions['comment_post_space']);
		if($nCommentPostSpace){
			$oUserLasthomefreshcomment=HomefreshcommentModel::F('user_id=?',$GLOBALS['___login___']['user_id'])->order('homefreshcomment_id DESC')->getOne();
			if(!empty($oUserLasthomefreshcomment['homefreshcomment_id'])){
				$nLastPostTime=$oUserLasthomefreshcomment['create_dateline'];
				if(CURRENT_TIMESTAMP-$nLastPostTime <=$nCommentPostSpace){
					$this->E(Dyhb::L('为防止灌水,发表评论时间间隔为 %d 秒','Controller/Homefresh',null,$nCommentPostSpace));
				}
			}
		}

		// 评论重复检测
		if($arrOptions['comment_repeat_check']){
			$nCurrentTimeStamp=CURRENT_TIMESTAMP;
			$oTryComment=HomefreshcommentModel::F("homefreshcomment_name=? AND homefreshcomment_content=? AND {$nCurrentTimeStamp}-create_dateline<86400 AND homefreshcomment_ip=?",$sCommentName,$sCommentContent,$sOnlineip)->order('homefreshcomment_id DESC')->query();
			if(!empty($oTryComment['homefreshcomment_id'])){
				$this->E(Dyhb::L('你提交的评论已经存在,24小时之内不允许出现相同的评论','Controller/Homefresh'));
			}
		}

		// 纯英文评论阻止
		if($arrOptions['disallowed_all_english_word']){
			$sPattern='/[一-龥]/u';
			if(!preg_match_all($sPattern,$sCommentContent, $arrMatch)){
				if($bDisallowedSpamWordToDatabase){
					$this->E('You should type some Chinese word(like 你好)in your comment to pass the spam-check, thanks for your patience! '.Dyhb::L('您的评论中必须包含汉字','Controller/Homefresh'));
				}else{
					$oHomefreshcomment->homefreshcomment_status=0;
				}
			}
		}

		// 评论审核
		if($arrOptions['audit_comment']==1){
			$oHomefreshcomment->homefreshcomment_auditpass=0;
		}

		// 保存评论数据
		$_POST=array_merge($_POST,$_GET);
		$oHomefreshcomment->safeInput();
		$oHomefreshcomment->save(0);

		if($oHomefreshcomment->isError()){
			$oHomefreshcomment->getErrorMessage();
		}else{
			// 发送COOKIE
			$this->send_cookie($oHomefreshcomment);

			// 更新评论数量
			$oHomefresh=HomefreshModel::F('homefresh_id=?',intval(G::getGpc('homefresh_id')))->getOne();
			if(!empty($oHomefresh['homefresh_id'])){
				$nHomefreshcommentnum=HomefreshcommentModel::F('homefreshcomment_status=1 AND homefreshcomment_auditpass=1 AND homefresh_id=?',intval(G::getGpc('homefresh_id')))->all()->getCounts();

				$oHomefresh->homefresh_commentnum=$nHomefreshcommentnum;
				$oHomefresh->save(0,'update');

				if($oHomefresh->isError()){
					$oHomefresh->getErrorMessage();
				}
			}

			// 邮件通知
			$this->comment_sendmail($oHomefreshcomment);
		}

		$arrCommentData=$oHomefreshcomment->toArray();

		$nQuick=intval(G::getGpc('quick','G'));
		if($nQuick==1){
			$arrCommentData['homefreshcomment_content']=G::subString(strip_tags($arrCommentData['homefreshcomment_content']),0,80);
			$arrCommentData['comment_name']=UserModel::getUsernameById($oHomefreshcomment->user_id);
			$arrCommentData['create_dateline']=Core_Extend::timeFormat($arrCommentData['create_dateline']);
			$arrCommentData['avatar']=Core_Extend::avatar($arrCommentData['user_id'],'small');
			$arrCommentData['url']=Dyhb::U('home://space@?id='.$arrCommentData['user_id']);
			$arrCommentData['num']=$oHomefresh->homefresh_commentnum;
		}else{
			$arrCommentData['jumpurl']=Dyhb::U('home://fresh@?id='.$oHomefreshcomment->homefresh_id.'&extra=new'.$oHomefreshcomment['homefreshcomment_id']).
				'#comment-'.$oHomefreshcomment['homefreshcomment_id'];
		}
			
		$this->A($arrCommentData,Dyhb::L('添加新鲜事评论成功','Controller/Homefresh'),1);
	}

	public function send_cookie($oCommentModel){
		Dyhb::cookie('the_comment_name',$oCommentModel->homefreshcomment_name,86400);
		Dyhb::cookie('the_comment_url',$oCommentModel->homefreshcomment_url,86400);
		Dyhb::cookie('the_comment_email',$oCommentModel->homefreshcomment_email,86400);
	}

	public function comment_sendmail($oCommentModel){
		$bSendMail=$bSendMailAdmin=$bSendMailAuthor=false;

		// 是否发送邮件
		$sAdminEmail=$GLOBALS['_option_']['admin_email'];
		if($GLOBALS['_cache_']['home_option']['comment_mail_to_admin']==1 && !empty($sAdminEmail)){
			$bSendMailAdmin=true;
		}

		if($GLOBALS['_cache_']['home_option']['comment_mail_to_author']==1 && !empty($oCommentModel->homefreshcomment_parentid)){
			$bSendMailAuthor=true;
		}

		if($bSendMailAdmin || $bSendMailAuthor){
			$bSendMail=true;
		}

		if($bSendMail===false){
			return;
		}

		// 开始发送邮件
		$oMail=Dyhb::instance('MailModel');
		$oMailConnect=$oMail->getMailConnect();
		if($bSendMailAdmin===true){
			$sEmailSubject=$this->get_email_to_admin_subject($oCommentModel);
			$sEmailMessage=$this->get_email_to_admin_message($oCommentModel,$oMailConnect);
			$this->send_a_email($oMailConnect,$sAdminEmail,$sEmailSubject,$sEmailMessage);
		}

		if($bSendMailAuthor===true){
			$oCommentParent=HomefreshcommentModel::F('homefreshcomment_id=?',$oCommentModel->homefreshcomment_parentid)->query();
			if($oCommentParent->homefreshcomment_isreplymail==1 && !empty($oCommentParent->homefreshcomment_email)){
				$sEmailSubject=$this->get_email_to_author_subject($oCommentParent);
				$sEmailMessage=$this->get_email_to_author_message($oCommentParent,$oCommentModel,$oMailConnect);
				$this->send_a_email($oMailConnect,$oCommentParent->homefreshcomment_email,$sEmailSubject,$sEmailMessage);
			}
		}

		return;
	}

	public function send_a_email($oMailConnect,$sEmailTo,$sEmailSubject,$sEmailMessage){
		$oMail=Dyhb::instance('MailModel');
		$oMail->sendAEmail($oMailConnect,$sEmailTo,$sEmailSubject,$sEmailMessage,'home');
		if($oMail->isError()){
			$this->E($oMail->getErrorMessage());
		}
	}

	public function get_email_to_admin_subject($oCommentModel){
		return Dyhb::L('你的朋友【%s】在您的网站（%s）留言了！','Controller/Homefresh',null,$oCommentModel->homefreshcomment_name,$GLOBALS['_option_']['site_name']);
	}

	public function get_email_to_admin_message($oCommentModel,$oMailConnect){
		$sLine=$this->get_mail_line($oMailConnect);

		$sMessage=$this->get_email_to_admin_subject($oCommentModel)."{$sLine}";
		$sMessage.="-----------------------------------------------------{$sLine}";
		$sMessage.=$oCommentModel->homefreshcomment_content."{$sLine}{$sLine}";
		$sMessage.=Dyhb::L('请进入下面链接查看留言','Controller/Homefresh').":{$sLine}";
		$sMessage.=$GLOBALS['_option_']['site_url'].'/index.php?app=home&c=ucenter&a=view&id='.$oCommentModel->homefresh_id."{$sLine}";
		$sMessage.="-----------------------------------------------------{$sLine}";
		$sMessage.=Dyhb::L('名字','Controller/Homefresh').':'.$oCommentModel->homefreshcomment_name."{$sLine}";
		
		if(!empty($oCommentModel->homefreshcomment_email)){
			$sMessage.='E-mail:'.$oCommentModel->homefreshcomment_email."{$sLine}";
		}

		if(!empty($oCommentModel->homefreshcomment_url)){
			$sMessage.=Dyhb::L('主页','Controller/Homefresh').':'.$oCommentModel->homefreshcomment_url."{$sLine}";
		}

		$sMessage.="-----------------------------------------------------{$sLine}";
		$sMessage.=Dyhb::L('消息来源','Controller/Homefresh').':'.$GLOBALS['_option_']['site_name']."{$sLine}";
		$sMessage.=Dyhb::L('站点网址','Controller/Homefresh').':'.$GLOBALS['_option_']['site_url']."{$sLine}";
		$sMessage.="-----------------------------------------------------{$sLine}";
		$sMessage.=Dyhb::L('程序支持','Controller/Homefresh').':'.$GLOBALS['_option_']['needforbug_program_name']." " .NEEDFORBUG_SERVER_VERSION. " Release " .NEEDFORBUG_SERVER_RELEASE."{$sLine}";
		$sMessage.=Dyhb::L('产品官网','Controller/Homefresh').':'.$GLOBALS['_option_']['needforbug_program_url']."{$sLine}";

		return $sMessage;
	}

	public function get_email_to_author_subject($oCommentModel){
		return Dyhb::L("我的朋友：【%s】您在博客（%s）发表的评论被回复了！",'Controller/Homefresh',null,$oCommentModel->homefreshcomment_name,$GLOBALS['_option_']['site_name']);
	}

	public function get_email_to_author_message($oCommentModel,$oCommentNew,$oMailSend){
		$sLine=$this->get_mail_line($oMailSend);

		$sMessage=$this->get_email_to_author_subject($oCommentModel).$sLine;
		$sMessage.="-----------------------------------------------------{$sLine}";
		$sMessage.=Dyhb::L('您的评论','Controller/Homefresh').":{$sLine}";
		$sMessage.=$oCommentModel->homefreshcomment_content."{$sLine}";
		$sMessage.="-----------------------------------------------------{$sLine}";
		$sMessage.="【".$oCommentModel->homefreshcomment_name."】".Dyhb::L('回复说','Controller/Homefresh').":{$sLine}";
		$sMessage.=$oCommentNew->homefreshcomment_content."{$sLine}{$sLine}";
		$sMessage.=Dyhb::L('请进入下面链接查看留言','Controller/Homefresh').":{$sLine}";
		$sMessage.=$GLOBALS['_option_']['site_url'].'/index.php?app=home&c=ucenter&a=view&id='.$oCommentModel->homefresh_id."{$sLine}";
		$sMessage.="-----------------------------------------------------{$sLine}";
		$sMessage.=Dyhb::L('名字','Controller/Homefresh').':'.$oCommentModel->homefreshcomment_name."{$sLine}";
		
		if(!empty($oCommentModel->homefreshcomment_email)){
			$sMessage.='E-mail:'.$oCommentModel->homefreshcomment_email."{$sLine}";
		}

		if(!empty($oCommentModel->homefreshcomment_url)){
			$sMessage.=Dyhb::L('主页','Controller/Homefresh').':'.$oCommentModel->homecomment_url."{$sLine}";
		}

		$sMessage.="-----------------------------------------------------{$sLine}";
		$sMessage.=Dyhb::L('消息来源','Controller/Homefresh').':'.$GLOBALS['_option_']['blog_name']."{$sLine}";
		$sMessage.=Dyhb::L('站点网址','Controller/Homefresh').':'.$GLOBALS['_option_']['blog_url']."{$sLine}";
		$sMessage.="-----------------------------------------------------{$sLine}";
		$sMessage.=Dyhb::L('程序支持','Controller/Homefresh').':'.$GLOBALS['_option_']['needforbug_program_name']." " .NEEDFORBUG_SERVER_VERSION. " Release " .NEEDFORBUG_SERVER_RELEASE."{$sLine}";
		$sMessage.=Dyhb::L('产品官网','Controller/Homefresh').':'.$GLOBALS['_option_']['needforbug_program_url']."{$sLine}";

		return $sMessage;
	}

	public function get_mail_line($oMailConnect){
		return $oMailConnect->getIsHtml()===true?'<br/>':"\r\n";
	}

	public function update_goodnum(){
		$nId=intval(G::getGpc('id','G'));

		// 判断是否已经存在
		$cookieValue=Dyhb::cookie('homefresh_goodnum');
		$cookieValue=explode(',',$cookieValue);
		if(in_array($nId,$cookieValue)){
			$this->E(Dyhb::L('你已经赞了','Controller/Homefresh'),1);
		}

		// 更新赞
		$oHomefresh=HomefreshModel::F('homefresh_id=?',$nId)->getOne();
		if(empty($oHomefresh->homefresh_id)){
			$this->E(Dyhb::L('你赞成的新鲜事不存在','Controller/Homefresh'));
		}

		$oHomefresh->homefresh_goodnum=$oHomefresh->homefresh_goodnum+1;
		$oHomefresh->save(0,'update');
		if($oHomefresh->isError()){
			$this->E($oHomefresh->getErrorMessage());
		}

		// 发送新的COOKIE
		$cookieValue[]=$nId;
		$cookieValue=implode(',',$cookieValue);
		Dyhb::cookie('homefresh_goodnum',$cookieValue);
		
		$arrData['num']=$oHomefresh->homefresh_goodnum;

		$this->A($arrData,Dyhb::L('赞','Controller/Homefresh').'+1',1,1);
	}

}
