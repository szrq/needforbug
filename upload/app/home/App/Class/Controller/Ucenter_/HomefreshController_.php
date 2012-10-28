<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   鐢ㄦ埛鏂伴矞浜嬫帶鍒跺櫒($)*/

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
				// 浠呭ソ鍙�
				$arrUserIds=FriendModel::getFriendById($GLOBALS['___login___']['user_id']);
			
				if(!empty($arrUserIds)){
					$arrWhere['user_id']=array('in',$arrUserIds);
				}else{
					$arrWhere['user_id']='';
				}
				break;
			case 'all':
				// 杩欓噷鍙互璁剧疆鐢ㄦ埛闅愮锛屾瘮濡傜敤鎴蜂笉鎰挎剰灏嗗姩鎬佹斁鍑�
				break;
			default:
				// 鎴戝拰濂藉弸
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

		// 鏂伴矞浜�
		$arrWhere['homefresh_status']=1;
		$nTotalRecord=HomefreshModel::F()->where($arrWhere)->all()->getCounts();
		$oPage=Page::RUN($nTotalRecord,$arrOptionData['homefresh_list_num'],G::getGpc('page','G'));
		$arrHomefreshs=HomefreshModel::F()->where($arrWhere)->order('create_dateline DESC')->limit($oPage->returnPageStart(),$arrOptionData['homefresh_list_num'])->getAll();

		// 鎴戠殑鏂伴矞浜嬫暟閲�
		$nMyhomefreshnum=$this->get_myhomefreshnum();

		$this->assign('arrHomefreshs',$arrHomefreshs);
		$this->assign('sPageNavbar',$oPage->P('pagination','li','active'));
		$this->assign('nDisplaySeccode',$GLOBALS['_option_']['seccode_publish_status']);
		$this->assign('nDisplayCommentSeccode',$GLOBALS['_cache_']['home_option']['seccode_comment_status']);
		$this->assign('nMyhomefreshnum',$nMyhomefreshnum);
		
		$this->display('homefresh+index');
	}

	public function index_title_(){
		return '鐢ㄦ埛涓績';
	}

	public function index_keywords_(){
		return $this->index_title_();
	}

	public function index_description_(){
		return $this->index_title_();
	}

	public function topic(){
		$this->display('homefresh+topic');
	}

	public function get_myhomefreshnum(){
		$oHomefresh=Dyhb::instance('HomefreshModel');
		return $oHomefresh->getHomefreshnumByUserid($GLOBALS['___login___']['user_id']);
	}

	public function get_newcomment($nId,$nUserid){
		if($GLOBALS['___login___']['user_id']!=$nUserid){
			$sHomefreshcommentAuditpass=' AND homefreshcomment_auditpass=1 ';
		}else{
			$sHomefreshcommentAuditpass='';
		}
		
		return HomefreshcommentModel::F(
				'homefresh_id=? AND homefreshcomment_status=1 '.$sHomefreshcommentAuditpass.' AND homefreshcomment_parentid=0',$nId
			)->limit(0,$GLOBALS['_cache_']['home_option']['homefreshcomment_limit_num'])->order('homefreshcomment_id DESC')->getAll();
	}

	public function get_newchildcomment($nId,$nCommentid,$nUserid,$bAll=false,$nCommentpage=1){
		if($GLOBALS['___login___']['user_id']!=$nUserid){
			$sHomefreshcommentAuditpass=' AND homefreshcomment_auditpass=1 ';
		}else{
			$sHomefreshcommentAuditpass='';
		}
		
		$oHomefreshcommentSelect=HomefreshcommentModel::F(
				'homefresh_id=? AND homefreshcomment_status=1 '.$sHomefreshcommentAuditpass.' AND homefreshcomment_parentid=?',$nId,$nCommentid
			)->order('homefreshcomment_id DESC');

		if($bAll===true){
			if($nCommentpage<1){
				$nCommentpage=1;
			}

			$nTotalHomefreshcommentNum=$oHomefreshcommentSelect->All()->getCounts();

			$oPage=Page::RUN($nTotalHomefreshcommentNum,$GLOBALS['_cache_']['home_option']['homefreshchildcomment_list_num'],$nCommentpage,false);

			$arrHomefreshcomments=HomefreshcommentModel::F(
				'homefresh_id=? AND homefreshcomment_status=1 '.$sHomefreshcommentAuditpass.' AND homefreshcomment_parentid=?',$nId,$nCommentid
				)->order('homefreshcomment_id DESC')->limit($oPage->returnPageStart(),$GLOBALS['_cache_']['home_option']['homefreshchildcomment_list_num'])->getAll();

			return array($arrHomefreshcomments,$oPage->P('pagination_'.$nCommentid.'@pagenav','span','current','disabled','commentpage_'.$nCommentid),$nTotalHomefreshcommentNum<$GLOBALS['_cache_']['home_option']['homefreshchildcomment_list_num']?false:true);
		}else{
			return $oHomefreshcommentSelect->limit(0,$GLOBALS['_cache_']['home_option']['homefreshchildcomment_limit_num'])->getAll();
		}
	}

	public function add(){
		if($GLOBALS['_option_']['seccode_publish_status']==1){
			$this->check_seccode(true);
		}

		$sMessage=trim(G::cleanJs(G::getGpc('homefresh_message','P')));
		if(empty($sMessage)){
			$this->E(Dyhb::L('鏂伴矞浜嬪唴瀹逛笉鑳戒负绌�,'Controller/Homefresh'));
		}
		
		$oHomefresh=new HomefreshModel();
		$oHomefresh->safeInput();
		$oHomefresh->homefresh_status=1;
		$oHomefresh->save(0,'save');

		if($oHomefresh->isError()){
			$this->E($oHomefresh->getErrorMessage());
		}else{
			// 鍒ゆ柇鏄惁灏嗘柊椴滀簨鏇存柊鍒扮鍚�
			if(G::getGpc('synchronized-to-sign','P')==1){
				$sMessage=trim(strip_tags($sMessage));
				$sMessage=preg_replace('/\s(?=\s)/','',$sMessage);// 鎺ョ潃鍘绘帀涓や釜绌烘牸浠ヤ笂鐨�
				$sMessage=preg_replace('/[\n\r\t]/','',$sMessage);// 鏈�悗灏嗛潪绌烘牸鏇挎崲涓轰竴涓┖鏍�
				$sMessage=G::subString($sMessage,0,500);
				
				// 鏇存柊鍒板墠鐢ㄦ埛鐨勭鍚嶄俊鎭�
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

			$this->cache_site_();

			$arrHomefreshData['homefresh_count']=$this->get_myhomefreshnum();
			
			$this->A($arrHomefreshData,Dyhb::L('娣诲姞鏂伴矞浜嬫垚鍔�,'Controller/Homefresh'),1);
		}
	}

	public function view(){
		$nId=intval(G::getGpc('id','G'));

		if(empty($nId)){
			$this->E(Dyhb::L('浣犳病鏈夋寚瀹氳闃呰鐨勬柊椴滀簨','Controller/Homefresh'));
		}

		$oHomefresh=HomefreshModel::F('homefresh_id=? AND homefresh_status=1',$nId)->getOne();
		if(empty($oHomefresh['homefresh_id'])){
			$this->E(Dyhb::L('鏂伴矞浜嬩笉瀛樺湪鎴栬�琚睆钄戒簡','Controller/Homefresh'));
		}

		$arrOptionData=$GLOBALS['_cache_']['home_option'];

		// 鍒ゆ柇閭欢绛夊閮ㄥ湴鍧�繃鏉ョ殑鏌ユ壘璇勮鍦板潃
		$nIsolationCommentid=intval(G::getGpc('isolation_commentid','G'));
		if($nIsolationCommentid){
			$result=HomefreshcommentModel::getCommenturlByid($nIsolationCommentid);
			if($result===false){
				$this->E('璇ユ潯璇勮宸茶鍒犻櫎銆佸睆钄芥垨鑰呭皻鏈�杩囧鏍�);
			}

			G::urlGoTo($result);
			exit();
		}

		$oHomefresh->homefresh_viewnum=$oHomefresh->homefresh_viewnum+1;
		$oHomefresh->save(0,'update');

		if($oHomefresh->isError()){
			$this->E($oHomefresh->getErrorMessage());
		}

		$sHomefreshtitle=$oHomefresh->homefresh_title?$oHomefresh->homefresh_title:G::subString(strip_tags($oHomefresh['homefresh_message']),0,$arrOptionData['homefreshtitle_substring_num']);

		// 璇诲彇璇勮鍒楄〃
		$arrWhere=array();
		$arrWhere['homefreshcomment_parentid']=0;
		$arrWhere['homefreshcomment_status']=1;
		$arrWhere['homefresh_id']=$nId;
		
		if($GLOBALS['___login___']['user_id']!=$oHomefresh['user_id']){
			$arrWhere['homefreshcomment_auditpass']=1;
			$this->assign('bAuditpass',false);
		}else{
			$this->assign('bAuditpass',true);
		}

		$this->_oHomefresh=$oHomefresh;

		$nTotalRecord=HomefreshcommentModel::F()->where($arrWhere)->all()->getCounts();
		$oPage=Page::RUN($nTotalRecord,$arrOptionData['homefreshcomment_list_num'],G::getGpc('page','G'));
		$arrHomefreshcommentLists=HomefreshcommentModel::F()->where($arrWhere)->all()->order('`create_dateline` DESC')->limit($oPage->returnPageStart(),$arrOptionData['homefreshcomment_list_num'])->getAll();

		// 鐢ㄦ埛鍜岀Н鍒�
		$oUserInfo=$oHomefresh->user;
		$nUserscore=$oUserInfo->usercount->usercount_extendcredit1;
		$arrRatinginfo=UserModel::getUserrating($nUserscore,false);
		$this->assign('oUserInfo',$oUserInfo);
		$this->assign('arrRatinginfo',$arrRatinginfo);
		$this->assign('nUserscore',$nUserscore);

		// 鍙栧緱涓汉涓婚〉
		$oUserprofile=UserprofileModel::F('user_id=?',$GLOBALS['___login___']['user_id'])->getOne();
		$this->_sHomefreshtitle=$sHomefreshtitle;

		// 鎴戠殑鏂伴矞浜嬫暟閲�
		$nMyhomefreshnum=$this->get_myhomefreshnum();
		
		$this->assign('oHomefresh',$oHomefresh);
		$this->assign('sHomefreshtitle',$sHomefreshtitle);
		$this->assign('nTotalHomefreshcomment',$nTotalRecord);
		$this->assign('sPageNavbar',$oPage->P('pagination','li','active'));
		$this->assign('arrHomefreshcommentLists',$arrHomefreshcommentLists);
		$this->assign('sUsersite',$oUserprofile['userprofile_site']);
		$this->assign('nDisplaySeccode',$GLOBALS['_cache_']['home_option']['seccode_comment_status']);
		$this->assign('nMyhomefreshnum',$nMyhomefreshnum);

		$this->display('homefresh+view');
	}

	public $_oHomefresh=null;

	public function view_title_(){
		return $this->_sHomefreshtitle;
	}

	public function view_keywords_(){
		return $this->view_title_();
	}

	public function view_description_(){
		if(G::getGpc('page','G')>1){
			return $this->view_title_();
		}else{
			return $this->_oHomefresh['homefresh_message'];
		}
	}

	public function add_comment(){
		$arrOptions=$GLOBALS['_cache_']['home_option'];
		
		if($arrOptions['close_comment_feature']==1){
			$this->E(Dyhb::L('绯荤粺鍏抽棴浜嗚瘎璁哄姛鑳�,'Controller/Homefresh'));
		}

		if($arrOptions['seccode_comment_status']==1){
			$this->check_seccode(true);
		}

		// IP绂佹鍔熻兘
		$sCommentBanIp=trim($arrOptions['comment_ban_ip']);
		$sOnlineip=G::getIp();
		if($arrOptions['comment_banip_enable']==1 && $sCommentBanIp){
			$sCommentBanIp=str_replace('锛�,',',$sCommentBanIp);
			$arrCommentBanIp=Dyhb::normalize(explode(',', $sCommentBanIp));
			if(is_array($arrCommentBanIp) && count($arrCommentBanIp)){
				foreach($arrCommentBanIp as $sValueCommentBanIp){
					$sValueCommentBanIp=str_replace('\*','.*',preg_quote($sValueCommentBanIp,"/"));
					if(preg_match("/^{$sValueCommentBanIp}/",$sOnlineip)){
						$this->E(Dyhb::L('鎮ㄧ殑IP %s 宸茬粡琚郴缁熺姝㈠彂琛ㄨ瘎璁�,'Controller/Homefresh',null,$sOnlineip));
					}
				}
			}
		}

		// 璇勮鍚嶅瓧妫�祴
		$sCommentName=trim(G::getGpc('homefreshcomment_name'));
		if(empty($sCommentName)){
			$this->E(Dyhb::L('璇勮鍚嶅瓧涓嶈兘涓虹┖','Controller/Homefresh'));
		}
		$arrNamekeys=array("\\",'&',' ',"'",'"','/','*',',','<','>',"\r","\t","\n",'#','$','(',')','%','@','+','?',';','^');
		foreach($arrNamekeys as $sNamekeys){
			if(strpos($sCommentName,$sNamekeys)!==false){
				$this->E(Dyhb::L('姝よ瘎璁哄悕瀛楀寘鍚笉鍙帴鍙楀瓧绗︽垨琚鐞嗗憳灞忚斀,璇烽�鎷╁叾瀹冨悕瀛�,'Controller/Homefresh'));
			}
		}

		// 璇勮鍐呭闀垮害妫�祴
		$sCommentContent=trim(G::getGpc('homefreshcomment_content'));
		$nCommentMinLen=intval($arrOptions['comment_min_len']);
		if($nCommentMinLen && strlen($sCommentContent)<$nCommentMinLen){
			$this->E(Dyhb::L('璇勮鍐呭鏈�皯鐨勫瓧鑺傛暟涓�%d','Controller/Homefresh',null,$nCommentMinLen));
		}

		$nCommentMaxLen=intval($arrOptions['comment_max_len']);
		if($nCommentMaxLen && strlen($sCommentContent)>$nCommentMaxLen){
			$this->E(Dyhb::L('璇勮鍐呭鏈�ぇ鐨勫瓧鑺傛暟涓�%d','Controller/Homefresh',null,$nCommentMaxLen));
		}

		// 鍒涘缓璇勮妯″瀷
		$oHomefreshcomment=new HomefreshcommentModel();

		// SPAM 鍨冨溇淇℃伅闃绘
		$bDisallowedSpamWordToDatabase=$arrOptions['disallowed_spam_word_to_database']?true:false;
		if($arrOptions['comment_spam_enable']){
			$nCommentSpamUrlNum=intval($arrOptions['comment_spam_url_num']);
			if($nCommentSpamUrlNum){
				if(substr_count($sCommentContent,'http://')>=$nCommentSpamUrlNum){
					if($bDisallowedSpamWordToDatabase){
						$this->E(Dyhb::L('璇勮鍐呭涓嚭鐜扮殑琛旀帴鏁伴噺瓒呰繃浜嗙郴缁熺殑闄愬埗 %d 鏉�,'Controller/Homefresh',null,$nCommentSpamUrlNum));
					}else{
						$oHomefreshcomment->homefreshcomment_status=0;
					}
				}
			}

			$sSpamWords=trim($arrOptions['comment_spam_words']);
			if($sSpamWords){
				$sSpamWords=str_replace('锛�,',',$sSpamWords);
				$arrSpamWords=Dyhb::normalize(explode(',',$sSpamWords));
				if(is_array($arrSpamWords) && count($arrSpamWords)){
					foreach($arrSpamWords as $sValueSpamWords){
						if($sValueSpamWords){
							if(preg_match("/".preg_quote($sValueSpamWords,'/')."/i",$sCommentContent)){
								if($bDisallowedSpamWordToDatabase){
									$this->E(Dyhb::L("浣犵殑璇勮鍐呭鍖呭惈绯荤粺灞忚斀鐨勮瘝璇�s",'Controller/Homefresh',null,$sValueSpamWords));
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
						$this->E(Dyhb::L('璇勮鍐呭鏈�ぇ鐨勫瓧鑺傛暟涓�d','Controller/Homefresh',null,$nCommentSpamContentSize));
					}else{
						$oHomefreshcomment->homefreshcomment_status=0;
					}
				}
			}
		}

		// 鍙戣〃璇勮闂撮殧鏃堕棿
		$nCommentPostSpace=intval($arrOptions['comment_post_space']);
		if($nCommentPostSpace){
			$oUserLasthomefreshcomment=HomefreshcommentModel::F('user_id=?',$GLOBALS['___login___']['user_id'])->order('homefreshcomment_id DESC')->getOne();
			if(!empty($oUserLasthomefreshcomment['homefreshcomment_id'])){
				$nLastPostTime=$oUserLasthomefreshcomment['create_dateline'];
				if(CURRENT_TIMESTAMP-$nLastPostTime<=$nCommentPostSpace){
					$this->E(Dyhb::L('涓洪槻姝㈢亴姘�鍙戣〃璇勮鏃堕棿闂撮殧涓�%d 绉�,'Controller/Homefresh',null,$nCommentPostSpace));
				}
			}
		}

		// 璇勮閲嶅妫�祴
		if($arrOptions['comment_repeat_check']){
			$nCurrentTimeStamp=CURRENT_TIMESTAMP;
			$oTryComment=HomefreshcommentModel::F("homefreshcomment_name=? AND homefreshcomment_content=? AND {$nCurrentTimeStamp}-create_dateline<86400 AND homefreshcomment_ip=?",$sCommentName,$sCommentContent,$sOnlineip)->order('homefreshcomment_id DESC')->query();
			if(!empty($oTryComment['homefreshcomment_id'])){
				$this->E(Dyhb::L('浣犳彁浜ょ殑璇勮宸茬粡瀛樺湪,24灏忔椂涔嬪唴涓嶅厑璁稿嚭鐜扮浉鍚岀殑璇勮','Controller/Homefresh'));
			}
		}

		// 绾嫳鏂囪瘎璁洪樆姝�
		if($arrOptions['disallowed_all_english_word']){
			$sPattern='/[涓�榫/u';
			if(!preg_match_all($sPattern,$sCommentContent, $arrMatch)){
				if($bDisallowedSpamWordToDatabase){
					$this->E('You should type some Chinese word(like 浣犲ソ)in your comment to pass the spam-check, thanks for your patience! '.Dyhb::L('鎮ㄧ殑璇勮涓繀椤诲寘鍚眽瀛�,'Controller/Homefresh'));
				}else{
					$oHomefreshcomment->homefreshcomment_status=0;
				}
			}
		}

		// 璇勮瀹℃牳
		if($arrOptions['audit_comment']==1){
			$oHomefreshcomment->homefreshcomment_auditpass=0;
		}

		// 淇濆瓨璇勮鏁版嵁
		$_POST=array_merge($_POST,$_GET);
		$oHomefreshcomment->safeInput();
		$oHomefreshcomment->save(0);

		if($oHomefreshcomment->isError()){
			$oHomefreshcomment->getErrorMessage();
		}else{
			// 鍙戦�COOKIE
			$this->send_cookie($oHomefreshcomment);

			// 鏇存柊璇勮鏁伴噺
			$oHomefresh=Dyhb::instance('HomefreshModel');
			$oHomefresh->updateHomefreshcommentnum(intval(G::getGpc('homefresh_id')));

			if($oHomefresh->isError()){
				$oHomefresh->getErrorMessage();
			}

			// 閭欢閫氱煡
			$this->comment_sendmail($oHomefreshcomment);
		}

		$arrCommentData=$oHomefreshcomment->toArray();

		$nQuick=intval(G::getGpc('quick','G'));
		if($nQuick==1){
			$arrCommentData['homefreshcomment_content']=G::subString(strip_tags($arrCommentData['homefreshcomment_content']),0,$GLOBALS['_cache_']['home_option']['homefreshcomment_substring_num']);
			$arrCommentData['comment_name']=UserModel::getUsernameById($oHomefreshcomment->user_id);
			$arrCommentData['create_dateline']=Core_Extend::timeFormat($arrCommentData['create_dateline']);
			$arrCommentData['avatar']=Core_Extend::avatar($arrCommentData['user_id'],'small');
			$arrCommentData['url']=Dyhb::U('home://space@?id='.$arrCommentData['user_id']);
			$arrCommentData['num']=$oHomefresh->homefresh_commentnum;
			$arrCommentData['viewurl']=Dyhb::U('home://fresh@?id='.$arrCommentData['homefresh_id'].'&isolation_commentid='.$arrCommentData['homefreshcomment_id']);
		}else{
			$nPage=intval(G::getGpc('page'));

			$arrCommentData['jumpurl']=Dyhb::U('home://fresh@?id='.$oHomefreshcomment->homefresh_id.($nPage>=2?'&page='.$nPage:'').'&extra=new'.$oHomefreshcomment['homefreshcomment_id']).
				'#comment-'.$oHomefreshcomment['homefreshcomment_id'];
		}
			
		$this->cache_site_();
		
		$this->A($arrCommentData,Dyhb::L('娣诲姞鏂伴矞浜嬭瘎璁烘垚鍔�,'Controller/Homefresh'),1);
	}

	public function audit(){
		$nId=intval(G::getGpc('id','G'));
		$nStatus=intval(G::getGpc('status','G'));

		$oHomefreshcomment=HomefreshcommentModel::F('homefreshcomment_id=? AND homefreshcomment_status=1',$nId)->getOne();
		if(empty($oHomefreshcomment['homefreshcomment_id'])){
			$this->E(Dyhb::L('寰呮搷浣滅殑璇勮涓嶅瓨鍦ㄦ垨鑰呭凡琚郴缁熷睆钄�,'Controller/Homefresh'));
		}

		$oHomefreshcomment->homefreshcomment_auditpass=$nStatus;
		$oHomefreshcomment->save(0,'update');

		if($oHomefreshcomment->isError()){
			$this->E($oHomefreshcomment->getErrorMessage());
		}

		// 鏇存柊璇勮鏁伴噺
		$oHomefresh=Dyhb::instance('HomefreshModel');
		$oHomefresh->updateHomefreshcommentnum($oHomefreshcomment['homefresh_id']);

		if($oHomefresh->isError()){
			$oHomefresh->getErrorMessage();
		}

		$this->S(Dyhb::L('璇勮鎿嶄綔鎴愬姛','Controller/Homefresh'));
	}

	public function send_cookie($oCommentModel){
		Dyhb::cookie('the_comment_name',$oCommentModel->homefreshcomment_name,86400);
		Dyhb::cookie('the_comment_url',$oCommentModel->homefreshcomment_url,86400);
		Dyhb::cookie('the_comment_email',$oCommentModel->homefreshcomment_email,86400);
	}

	public function comment_sendmail($oCommentModel){
		$bSendMail=$bSendMailAdmin=$bSendMailAuthor=false;

		// 鏄惁鍙戦�閭欢
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

		// 寮�鍙戦�閭欢
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
		return Dyhb::L('浣犵殑鏈嬪弸銆�s銆戝湪鎮ㄧ殑缃戠珯锛�s锛夌暀瑷�簡锛�,'Controller/Homefresh',null,$oCommentModel->homefreshcomment_name,$GLOBALS['_option_']['site_name']);
	}

	public function get_email_to_admin_message($oCommentModel,$oMailConnect){
		$sLine=$this->get_mail_line($oMailConnect);

		$sMessage=$this->get_email_to_admin_subject($oCommentModel)."{$sLine}";
		$sMessage.="-----------------------------------------------------{$sLine}";
		$sMessage.=$oCommentModel->homefreshcomment_content."{$sLine}{$sLine}";
		$sMessage.=Dyhb::L('璇疯繘鍏ヤ笅闈㈤摼鎺ユ煡鐪嬬暀瑷�,'Controller/Homefresh').":{$sLine}";
		$sMessage.=$GLOBALS['_option_']['site_url'].'/index.php?app=home&c=ucenter&a=view&id='.$oCommentModel->homefresh_id.'&isolation_commentid='.$oCommentModel['homefreshcomment_id']."{$sLine}";
		$sMessage.="-----------------------------------------------------{$sLine}";
		$sMessage.=Dyhb::L('鍚嶅瓧','Controller/Homefresh').':'.$oCommentModel->homefreshcomment_name."{$sLine}";
		
		if(!empty($oCommentModel->homefreshcomment_email)){
			$sMessage.='E-mail:'.$oCommentModel->homefreshcomment_email."{$sLine}";
		}

		if(!empty($oCommentModel->homefreshcomment_url)){
			$sMessage.=Dyhb::L('涓婚〉','Controller/Homefresh').':'.$oCommentModel->homefreshcomment_url."{$sLine}";
		}

		$sMessage.="-----------------------------------------------------{$sLine}";
		$sMessage.=Dyhb::L('娑堟伅鏉ユ簮','Controller/Homefresh').':'.$GLOBALS['_option_']['site_name']."{$sLine}";
		$sMessage.=Dyhb::L('绔欑偣缃戝潃','Controller/Homefresh').':'.$GLOBALS['_option_']['site_url']."{$sLine}";
		$sMessage.="-----------------------------------------------------{$sLine}";
		$sMessage.=Dyhb::L('绋嬪簭鏀寔','Controller/Homefresh').':'.$GLOBALS['_option_']['needforbug_program_name']." " .NEEDFORBUG_SERVER_VERSION. " Release " .NEEDFORBUG_SERVER_RELEASE."{$sLine}";
		$sMessage.=Dyhb::L('浜у搧瀹樼綉','Controller/Homefresh').':'.$GLOBALS['_option_']['needforbug_program_url']."{$sLine}";

		return $sMessage;
	}

	public function get_email_to_author_subject($oCommentModel){
		return Dyhb::L("鎴戠殑鏈嬪弸锛氥�%s銆戞偍鍦ㄥ崥瀹紙%s锛夊彂琛ㄧ殑璇勮琚洖澶嶄簡锛�,'Controller/Homefresh',null,$oCommentModel->homefreshcomment_name,$GLOBALS['_option_']['site_name']);
	}

	public function get_email_to_author_message($oCommentModel,$oCommentNew,$oMailSend){
		$sLine=$this->get_mail_line($oMailSend);

		$sMessage=$this->get_email_to_author_subject($oCommentModel).$sLine;
		$sMessage.="-----------------------------------------------------{$sLine}";
		$sMessage.=Dyhb::L('鎮ㄧ殑璇勮','Controller/Homefresh').":{$sLine}";
		$sMessage.=$oCommentModel->homefreshcomment_content."{$sLine}";
		$sMessage.="-----------------------------------------------------{$sLine}";
		$sMessage.="銆�.$oCommentModel->homefreshcomment_name."銆�.Dyhb::L('鍥炲璇�,'Controller/Homefresh').":{$sLine}";
		$sMessage.=$oCommentNew->homefreshcomment_content."{$sLine}{$sLine}";
		$sMessage.=Dyhb::L('璇疯繘鍏ヤ笅闈㈤摼鎺ユ煡鐪嬬暀瑷�,'Controller/Homefresh').":{$sLine}";
		$sMessage.=$GLOBALS['_option_']['site_url'].'/index.php?app=home&c=ucenter&a=view&id='.$oCommentModel->homefresh_id.'&isolation_commentid='.$oCommentModel['homefreshcomment_id']."{$sLine}";
		$sMessage.="-----------------------------------------------------{$sLine}";
		$sMessage.=Dyhb::L('鍚嶅瓧','Controller/Homefresh').':'.$oCommentModel->homefreshcomment_name."{$sLine}";
		
		if(!empty($oCommentModel->homefreshcomment_email)){
			$sMessage.='E-mail:'.$oCommentModel->homefreshcomment_email."{$sLine}";
		}

		if(!empty($oCommentModel->homefreshcomment_url)){
			$sMessage.=Dyhb::L('涓婚〉','Controller/Homefresh').':'.$oCommentModel->homefreshcomment_url."{$sLine}";
		}

		$sMessage.="-----------------------------------------------------{$sLine}";
		$sMessage.=Dyhb::L('娑堟伅鏉ユ簮','Controller/Homefresh').':'.$GLOBALS['_option_']['site_name']."{$sLine}";
		$sMessage.=Dyhb::L('绔欑偣缃戝潃','Controller/Homefresh').':'.$GLOBALS['_option_']['site_url']."{$sLine}";
		$sMessage.="-----------------------------------------------------{$sLine}";
		$sMessage.=Dyhb::L('绋嬪簭鏀寔','Controller/Homefresh').':'.$GLOBALS['_option_']['needforbug_program_name']." " .NEEDFORBUG_SERVER_VERSION. " Release " .NEEDFORBUG_SERVER_RELEASE."{$sLine}";
		$sMessage.=Dyhb::L('浜у搧瀹樼綉','Controller/Homefresh').':'.$GLOBALS['_option_']['needforbug_program_url']."{$sLine}";

		return $sMessage;
	}

	public function get_mail_line($oMailConnect){
		return $oMailConnect->getIsHtml()===true?'<br/>':"\r\n";
	}

	public function update_goodnum(){
		$nId=intval(G::getGpc('id','G'));

		// 鍒ゆ柇鏄惁宸茬粡瀛樺湪
		$cookieValue=Dyhb::cookie('homefresh_goodnum');
		$cookieValue=explode(',',$cookieValue);
		if(in_array($nId,$cookieValue)){
			$this->E(Dyhb::L('浣犲凡缁忚禐浜�,'Controller/Homefresh'),1);
		}

		// 鏇存柊璧�
		$oHomefresh=HomefreshModel::F('homefresh_id=?',$nId)->getOne();
		if(empty($oHomefresh->homefresh_id)){
			$this->E(Dyhb::L('浣犺禐鎴愮殑鏂伴矞浜嬩笉瀛樺湪','Controller/Homefresh'));
		}

		$oHomefresh->homefresh_goodnum=$oHomefresh->homefresh_goodnum+1;
		$oHomefresh->save(0,'update');
		if($oHomefresh->isError()){
			$this->E($oHomefresh->getErrorMessage());
		}

		// 鍙戦�鏂扮殑COOKIE
		$cookieValue[]=$nId;
		$cookieValue=implode(',',$cookieValue);
		Dyhb::cookie('homefresh_goodnum',$cookieValue);
		
		$arrData['num']=$oHomefresh->homefresh_goodnum;

		$this->A($arrData,Dyhb::L('璧�,'Controller/Homefresh').'+1',1,1);
	}

	protected function cache_site_(){
		if(!Dyhb::classExists('Cache_Extend')){
			require_once(Core_Extend::includeFile('function/Cache_Extend'));
		}
		Cache_Extend::updateCache("site");
	}

}
