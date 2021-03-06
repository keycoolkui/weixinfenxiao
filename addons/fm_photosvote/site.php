<?php
/**
 * 女神来了模块定义
 *
 */
defined('IN_IA') or exit('Access Denied');

class fm_photosvoteModuleSite extends WeModuleSite {	
	public $title 			 = '女神来了！';
	public $table_reply  	 = 'fm_photosvote_reply';//规则 相关设置
	public $table_users  	 = 'fm_photosvote_provevote';	//报名参加活动的人
	public $table_users_voice  	 = 'fm_photosvote_provevote_voice';	//
	public $table_users_name  	 = 'fm_photosvote_provevote_name';	//
	public $table_log        = 'fm_photosvote_votelog';//投票记录
	public $table_bbsreply   = 'fm_photosvote_bbsreply';//投票记录
	public $table_banners    = 'fm_photosvote_banners';//幻灯片
	public $table_advs  	 = 'fm_photosvote_advs';//广告
	public $table_gift  	 = 'fm_photosvote_gift';
	public $table_data  	 = 'fm_photosvote_data';
	public $table_iplist 	 = 'fm_photosvote_iplist';//禁止ip段
	public $table_iplistlog  = 'fm_photosvote_iplistlog';//禁止ip段
	public $table_announce   = 'fm_photosvote_announce';//公告

	public function __web($f_name){
		global $_GPC, $_W;
		checklogin();
		$uniacid = !empty($_W['uniacid']) ? $_W['uniacid'] : $_W['acid'];		
		$rid = intval($_GPC['rid']);
		include_once  'fmweb/'.strtolower(substr($f_name,5)).'.php';
	}
	
	public function __mobile($f_name){
		//关健词触发页面显示。
		global $_GPC,$_W;
		if ($_GPC['uniacid']) {
			$uniacid = $_GPC['uniacid'];
		}else {			
			$uniacid = !empty($_W['uniacid']) ? $_W['uniacid'] : $_W['acid'];
		}
		
		$rid = $_GPC['rid'];
		$tfrom_user = !empty($_GPC['tfrom_user']) ? $_GPC['tfrom_user'] : $_COOKIE["user_tfrom_user_openid"];
		$fromuser = $_GPC["fromuser"];//分享人
		if (empty($fromuser)){
			$fromuser = $_COOKIE["user_fromuser_openid"];
		}
		$cfg = $this->module['config'];
		if ($_GPC['do'] == 'photosvoteview') {
			
			//print_r($sjmid);
			//exit;
			//setcookie("fm_miaoxian", -10000);	
			if ($cfg['ismiaoxian'] && $cfg['mxnexttime'] != 0) {

				if (!isset($_COOKIE["fm_miaoxian"])) {
					setcookie("fm_miaoxian", 'startmiaoxian', time()+$cfg['mxnexttime']);
					$mxurl = $_W['siteroot'] .'app/'.$this->createMobileUrl('miaoxian', array('rid' => $rid));
					header("location:$mxurl");
					exit;
				}
			}
				
		}

		
		if ($cfg['oauthtype'] == 1) {
			if ($_GPC['do'] != 'shareuserview'  && $_GPC['do'] != 'shareuserdata'  && $_GPC['do'] != 'treg'  && $_GPC['do'] != 'tregs'  && $_GPC['do'] != 'tvotestart'  && $_GPC['do'] != 'tbbs'  && $_GPC['do'] != 'tbbsreply'  && $_GPC['do'] != 'saverecord'  && $_GPC['do'] != 'saverecord1'  && $_GPC['do'] != 'subscribeshare'  && $_GPC['do'] != 'pagedata'  && $_GPC['do'] != 'listentry'  && $_GPC['do'] != 'code' && $_GPC['do'] != 'reguser') {
				$oauthuser = $this->FM_checkoauth();	
			}			
			$from_user = empty($oauthuser['from_user']) ? $_GPC['from_user'] : $oauthuser['from_user'];
			$avatar = $oauthuser['avatar'];
			$nickname = $oauthuser['nickname'];
			$follow = $oauthuser['follow'];
		}else {
			$from_user = !empty($_W['openid']) ? $_W['openid'] : $_W['fans']['from_user'];
			if (empty($from_user)) {
				$from_user = empty($_COOKIE["user_oauth2_openid"]) ? $_GPC['from_user'] : $_COOKIE["user_oauth2_openid"];
			}			
			$from_user_putonghao = $_COOKIE["user_putonghao_openid"];
			$avatar = $_COOKIE["user_oauth2_avatar"];
			$nickname = $_COOKIE["user_oauth2_nickname"];
			$sex = $_COOKIE["user_oauth2_sex"];
			$follow = $_W['fans']['follow'];
			if ($from_user) {
				if (empty($avatar) || empty($nickname) || empty($follow)) {
					$fan = mc_fansinfo($from_user);//有openid 有follow 有avatar 有nickname
					if (!empty($fan)) {
						$avatar = $fan['avatar'];
						$nickname = $fan['nickname'];
						$follow = $fan['follow'];
					}
				}
			}
			
			if ($_GPC['do'] != 'shareuserview'  && $_GPC['do'] != 'shareuserdata'  && $_GPC['do'] != 'treg'  && $_GPC['do'] != 'tregs'  && $_GPC['do'] != 'tvotestart'  && $_GPC['do'] != 'tbbs'  && $_GPC['do'] != 'tbbsreply'  && $_GPC['do'] != 'saverecord'  && $_GPC['do'] != 'saverecord1'  && $_GPC['do'] != 'subscribeshare'  && $_GPC['do'] != 'pagedata'  && $_GPC['do'] != 'listentry'  && $_GPC['do'] != 'code' && $_GPC['do'] != 'reguser') {
				$this->checkoauth2($rid,$_COOKIE["user_oauth2_openid"]);//查询是否有cookie信息
			}
		}
		
        //活动规则
      	if (!empty($rid)) {
			$reply = pdo_fetch("SELECT * FROM ".tablename($this->table_reply)." WHERE rid = :rid ORDER BY `id` DESC", array(':rid' => $rid));
			$bgarr = iunserializer($reply['bgarr']);
			$qiniu = iunserializer($reply['qiniu']);	
			$picture = toimage($reply['picture']);			
			$bgcolor = $reply['bgcolor'];
			$sharephoto = toimage($reply['sharephoto']);		
			
			$now = time();
			if($now-$reply['xuninum_time']>$reply['xuninumtime']){
				pdo_update($this->table_reply, array('xuninum_time' => $now,'xuninum' => $reply['xuninum']+mt_rand($reply['xuninuminitial'],$reply['xuninumending'])), array('rid' => $rid));
			}
			
			if(!empty($tfrom_user)) {
				$user = pdo_fetch("SELECT * FROM ".tablename($this->table_users)." WHERE uniacid = :uniacid and from_user = :from_user and rid = :rid", array(':uniacid' => $uniacid,':from_user' => $tfrom_user,':rid' => $rid));
				if ($user) {
					$yuedu = $tfrom_user.$from_user.$rid.$uniacid;
					//setcookie("user_yuedu", -10000);	
				   if ($_COOKIE["user_yuedu"] != $yuedu) {
						 pdo_update($this->table_users, array('hits' => $user['hits']+1,), array('rid' => $rid, 'from_user' => $tfrom_user));
						 setcookie("user_yuedu", $yuedu, time()+3600*24);
					}
				}
			}else {
				pdo_update($this->table_reply, array('hits' => $reply['hits']+1), array('rid' => $rid));
			}
			if ($_GPC['do'] != 'treg'  && $_GPC['do'] != 'tregs'  && $_GPC['do'] != 'tvotestart'  && $_GPC['do'] != 'tbbs'  && $_GPC['do'] != 'tbbsreply'  && $_GPC['do'] != 'saverecord'  && $_GPC['do'] != 'saverecord1'  && $_GPC['do'] != 'subscribeshare'  && $_GPC['do'] != 'pagedata'  && $_GPC['do'] != 'listentry'  && $_GPC['do'] != 'code'  && $_GPC['do'] != 'stop' && $_GPC['do'] != 'paihang') {
				
				if ($reply['status']==0) {
					$statpraisetitle = '<h1>活动暂停！请稍候再试！</h1>';
					$stopurl = $_W['siteroot'] .'app/'.$this->createMobileUrl('stop', array('status' => '0', 'rid' => $rid));
					header("location:$stopurl");
					exit;
				}
				if (time()<$reply['start_time']) {//判断活动是否已经开始
					$statpraisetitle = '<h1>活动未开始！</h1>';
					
					$stopurl = $_W['siteroot'] .'app/'.$this->createMobileUrl('stop', array('status' => '-1', 'rid' => $rid));
					header("location:$stopurl");
					exit;
				}elseif (time()>$reply['end_time'] && $_GPC['do'] <> 'paihang') {//判断活动是否已经结束
					$statpraisetitle = '<h1>活动已结束！</h1>';
					
					$stopurl = $_W['siteroot'] .'app/'.$this->createMobileUrl('stop', array('status' => '1', 'rid' => $rid));
					header("location:$stopurl");
					exit;
				}
			}
			
			if ($reply['isipv']==1 && $_GPC['do'] != 'treg'  && $_GPC['do'] != 'tregs'  && $_GPC['do'] != 'tvotestart'  && $_GPC['do'] != 'tbbs'  && $_GPC['do'] != 'tbbsreply'  && $_GPC['do'] != 'saverecord'  && $_GPC['do'] != 'saverecord1'  && $_GPC['do'] != 'subscribeshare'  && $_GPC['do'] != 'pagedata'  && $_GPC['do'] != 'listentry'  && $_GPC['do'] != 'code'  && $_GPC['do'] != 'stopip') {
				$this->stopip($rid, $uniacid, $from_user,getip(), $_GPC['do'], $reply['ipturl'], $reply['limitip']);				
			}
 		}
		include_once  'fmmobile/'.strtolower(substr($f_name,8)).'.php';
	}
	
	
	public function doMobilelisthome() {
		//这个操作被定义用来呈现 微站首页导航图标
		$this->doMobilelistentry();	
	}
	
	public function gettiles($keyword = '') {
		global $_GPC,$_W;
		$uniacid = !empty($_W['uniacid']) ? $_W['uniacid'] : $_W['acid'];
		$urls = array();
		$list = pdo_fetchall("SELECT id FROM ".tablename('rule')." WHERE uniacid = ".$uniacid." and module = 'fm_photosvote'".(!empty($keyword) ? " AND name LIKE '%{$keyword}%'" : ''));
		if (!empty($list)) {
			foreach ($list as $row) {
			    $reply = pdo_fetch("SELECT title FROM ".tablename($this->table_reply)." WHERE rid = :rid ORDER BY `id` DESC", array(':rid' => $row['id']));
				$urls[] = array('title'=>$reply['title'], 'url'=> $_W['siteroot'] .'app/'.$this->createMobileUrl('photosvoteview', array('rid' => $row['id'])));
			}
		}
		return $urls;
	}
	
	function fmqnimages($nfilename, $qiniu, $mid, $username) {
		$fmurl = 'http://demo.wdlcms.com/api/qiniu/api.php?';
		$hosts = isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '');
		$host = base64_encode($hosts);
		
		$visitorsip = base64_encode(getip());	
		
		$fmimages = array(
			'nfilename' => $nfilename,
			'qiniu' => $qiniu,
			'mid' => $mid,
			'username' => $username,
		);
		
		$fmimages =  base64_encode(base64_encode(iserializer($fmimages)));
		
		$fmpost = $fmurl.'host='.$host."&visitorsip=" . $visitorsip."&webname=" . $webname."&fmimages=".$fmimages;		
		
		load()->func('communication');
		$content = ihttp_get($fmpost);		
		$fmmv = @json_decode($content['content'], true);
		
		if ($mid == 0) {
			
			$fmdata = array(
				"success" => $fmmv['success'],
				"msg" =>$fmmv['msg'],
			);
			$fmdata['mid'] == 0;
			$fmdata['imgurl'] = $fmmv['imgurl'];
				
			return $fmdata;
			exit;
			
		}else{
			$fmdata = array(
				"success" => $fmmv['success'],
				"msg" => $fmmv['msg'],
			);
			$fmdata['picarr_'.$mid] = $fmmv['picarr_'.$mid];
			return $fmdata;
			exit;
		}
		//return $fmmv;
	}
	
	function fmqnaudios($nfilename, $qiniu, $upmediatmp, $audiotype, $username) {		
		$fmurl = 'http://demo.wdlcms.com/api/qiniu/api.php?';
		$host = isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '');
		$host = base64_encode($host);
		$clientip = base64_encode($_W['clientip']);
		//$upmediatmp = $upmediatmp;
		//$audiotype = base64_encode($audiotype);
		//$username = base64_encode(iserializer($username));
		//$qiniu = base64_encode(iserializer($qiniu));
		//$nfilename = base64_encode(iserializer($nfilename));
		
		
		$fmaudios = array(
			'nfilename' => $nfilename,
			'qiniu' => $qiniu,
			'upmediatmp' => $upmediatmp,
			'audiotype' => $audiotype,
			'username' => $username,
		);
		$fmaudios =  base64_encode(base64_encode(iserializer($fmaudios)));
				
		$fmpost = $fmurl.'host='.$host."&visitorsip=" . $clientip."&fmaudios=".$fmaudios;	

		load()->func('communication');		
		$content = ihttp_get($fmpost);
		$fmmv = @json_decode($content['content'], true);
			
		$fmdata = array(		
			"msg" => $fmmv['msg'],
			"success" => $fmmv['success'],
			"nfilenamefop" => $fmmv['nfilenamefop'],	
		);
		$fmdata[$audiotype] = $fmmv[$audiotype];
			
		return $fmdata;
		exit();	
		
	}
	
    //入口列表
	public function doMobilelistentry() {
		$this->__mobile(__FUNCTION__);
	}
	public function doMobileStop() {
		$this->__mobile(__FUNCTION__);
	}
	
	public function doMobileStopip() {		
		$this->__mobile(__FUNCTION__);
	}
	public function doMobileStopllq() {
		$this->__mobile(__FUNCTION__);		
	}
	public function doMobilePhotosvoteview() {
		$this->__mobile(__FUNCTION__);
	}		
	public function doMobilePagedata() {
		$this->__mobile(__FUNCTION__);
	}		
	public function doMobilePhdata() {
		$this->__mobile(__FUNCTION__);
	}		
	public function doMobileTuser() {		
		$this->__mobile(__FUNCTION__);
	}
	
	public function doMobileSubscribe() {
		$this->__mobile(__FUNCTION__);
	}
	
	public function doMobileSubscribeshare() {
		$this->__mobile(__FUNCTION__);
	}
	
	public function doMobileTvote() {
		$this->__mobile(__FUNCTION__);
	}
	
	public function doMobileTvotestart() {
		$this->__mobile(__FUNCTION__);
	}
	
	public function doMobileTbbs() {
		$this->__mobile(__FUNCTION__);
	}
	
	public function doMobileTbbsreply() {
		$this->__mobile(__FUNCTION__);
	}
	
	public function doMobileTuserphotos() {
		$this->__mobile(__FUNCTION__);
	}
	public function doMobilereg() {
		$this->__mobile(__FUNCTION__);
	}
	public function doMobileSaverecord() {
		$this->__mobile(__FUNCTION__);
	}
	public function doMobileSaverecord1() {
		$this->__mobile(__FUNCTION__);
	}
	public function doMobileTregs() {
		$this->__mobile(__FUNCTION__);
	}	
 
	public function doMobileTreg() {
		$this->__mobile(__FUNCTION__);
	}
	public function doMobilereguser() {
		$this->__mobile(__FUNCTION__);
	}
	
	public function doMobilePaihang() {
		$this->__mobile(__FUNCTION__);
	}
	
	public function doMobileDes() {
		$this->__mobile(__FUNCTION__);
	}
	public function doMobileshareuserview() {
		$this->__mobile(__FUNCTION__);
	}
	
	public function doMobileshareuserdata() {
		$this->__mobile(__FUNCTION__);
	}
	public function doMobileMiaoxian() {
		$this->__mobile(__FUNCTION__);
	}
	
	public function doMobileQrcode() {
		global $_GPC,$_W;
		//$rid = $_GPC['rid'];
		$id = $_GPC['tid'];
		//$tfrom_user = $_GPC['tfrom_user'];
		//$uniacid = !empty($_W['uniacid']) ? $_W['uniacid'] : $_W['acid'];		
		
		$users = pdo_fetch("SELECT * FROM ".tablename($this->table_users)." WHERE id = :id", array(':id' => $id));
		
		if ($users['ewm'] && file_exists($users['ewm'])) {
			$fmdata = array(
				"success" => 1,
				"linkurl" => $users['ewm'],
				"msg" => '生成成功',
			);
		}else {
			load()->func('file');
			file_delete($users['ewm']);
			
			$ewmurl = $this->fm_qrcode($_GPC['url'], $users['tfrom_user'], $id, $users['avatar']);
			if ($ewmurl) {
				pdo_update($this->table_users, array('ewm' => $ewmurl), array('id'=>$id));
				$fmdata = array(
					"success" => 1,
					"linkurl" => $ewmurl,
					"msg" => '生成成功',
				);
			}else {
				$fmdata = array(
					"success" => -1,
					"msg" => '生成失败',
				);
			}
		}
		echo json_encode($fmdata);
		exit;
	}
	function dwz($url) {
		load()->func('communication');
		$dc = ihttp_post('http://dwz.cn/create.php', array('url'=> $url));
		$t = @json_decode($dc['content'], true);	
		return $t['tinyurl'];
	}
	function get_share($uniacid,$rid,$from_user,$title) {
		
		
		if (!empty($rid)) {
			$reply = pdo_fetch("SELECT xuninum,hits FROM ".tablename($this->table_reply)." WHERE rid = :rid ORDER BY `id` DESC", array(':rid' => $rid));
			
			$csrs = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename($this->table_users)." WHERE rid= ".$rid."");
			
			
		   			
			$listtotal = $csrs + $reply['hits'] + pdo_fetchcolumn("SELECT sum(hits) FROM ".tablename($this->table_users)." WHERE rid= ".$rid."") + pdo_fetchcolumn("SELECT sum(xnhits) FROM ".tablename($this->table_users)." WHERE rid= ".$rid."") + $reply['xuninum'];//总参与人数
			
			
			$ljtp = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename($this->table_log)." WHERE rid= ".$rid."") + pdo_fetchcolumn("SELECT sum(xnphotosnum) FROM ".tablename($this->table_users)." WHERE rid= ".$rid."");//累计投票
			
        }		
		if (!empty($from_user)) {
		    $userinfo = pdo_fetch("SELECT id, nickname,realname FROM ".tablename($this->table_users)." WHERE uniacid= :uniacid AND rid= :rid AND from_user= :from_user", array(':uniacid' => $uniacid,':rid' => $rid,':from_user' => $from_user));
			$nickname = empty($userinfo['realname']) ? $userinfo['nickname'] : $userinfo['realname'];
			$userid = $userinfo['id'];
		}
		$str = array('#编号#'=>$userid,'#参赛人数#'=>$csrs,'#参与人数#'=>$listtotal,'#参与人名#'=>$nickname,'#累计票数#'=>$ljtp);
		$result = strtr($title,$str);
        return $result;
    }
	
	
	
	public function stopip($rid, $uniacid, $from_user,$mineip, $do, $ipturl = '0', $limitip = '2') {	
		$starttime=mktime(0,0,0);//当天：00：00：00
		$endtime = mktime(23,59,59);//当天：23：59：59
		$times = '';
		$times .= ' AND createtime >=' .$starttime;
		$times .= ' AND createtime <=' .$endtime;		
		$iplist = pdo_fetchall('SELECT * FROM '.tablename($this->table_iplist).' WHERE uniacid= :uniacid  AND  rid= :rid order by `createtime` desc ', array(':uniacid' => $uniacid, ':rid' => $rid));
		$totalip = pdo_fetchcolumn('SELECT COUNT(*) FROM '.tablename($this->table_log).' WHERE uniacid= :uniacid  AND rid= :rid AND ip = :ip '.$times.'  order by `ip` desc ', array(':uniacid' => $uniacid, ':rid' => $rid, ':ip' => $mineip));
		if ($totalip > $limitip && $ipturl == 1) {
			$ipurl = $_W['siteroot'] . $this->createMobileUrl('stopip', array('from_user' => $from_user, 'rid' => $rid));
			header("location:$ipurl");
			exit();
		}
		$totalip = pdo_fetchcolumn('SELECT COUNT(*) FROM '.tablename($this->table_log).' WHERE uniacid= :uniacid  AND rid= :rid AND ip = :ip  '.$times.' order by `ip` desc ', array(':uniacid' => $uniacid, ':rid' => $rid, ':ip' => $mineip));
			
		$mineipz = sprintf("%u",ip2long($mineip));
		
		
		foreach ($iplist as $i) {
			$iparrs = iunserializer($i['iparr']);
			$ipstart = sprintf("%u",ip2long($iparrs['ipstart']));
			$ipend = sprintf("%u",ip2long($iparrs['ipend']));
			
			
			if ($mineipz >= $ipstart && $mineipz <= $ipend) {						
				$ipdate = array(
					'rid' => $rid,
					'uniacid' => $uniacid,
					'avatar' => $avatar,
					'nickname' => $nickname,
					'from_user' => $from_user,
					'ip' => $mineip,
					'hitym' => $do,
					'createtime' => time(),
				);
				$ipdate['iparr'] = getiparr($ipdate['ip']);
				pdo_insert($this->table_iplistlog, $ipdate);
				
				if ($ipturl == 1) {
					$ipurl = $_W['siteroot'] . $this->createMobileUrl('stopip', array('from_user' => $from_user, 'rid' => $rid));
					header("location:$ipurl");
					exit();
				}
				break;
			}
		}
	}
	
	private function _stopllq($turl) {
		global $_GPC,$_W;
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		if (strpos($user_agent, 'MicroMessenger') === false) {
			$turl = 'stopllq';
			return $turl;			
		} else { 
			return $turl;;
		}
		
	}
	
	
	private function FM_checkoauth() {
		global $_GPC,$_W;
		$uniacid = !empty($_W['uniacid']) ? $_W['uniacid'] : $_W['acid'];		
		load()->model('mc');		
		$openid = '';
		$nickname = '';
		$avatar = '';
		$follow = '';
		if (!empty($_W['member']['uid'])) {
			$member = mc_fetch(intval($_W['member']['uid']), array('avatar','nickname'));//无openid 无follow 有avatar 有nickname
			if (!empty($member)) {
				$avatar = $member['avatar'];
				$nickname = $member['nickname'];
			}
		}
		
		if (empty($avatar) || empty($nickname)) {
			$fan = mc_fansinfo($_W['openid']);//有openid 有follow 有avatar 有nickname
			if (!empty($fan)) {
				$avatar = $fan['avatar'];
				$nickname = $fan['nickname'];
				$openid = $fan['openid'];
				$follow = $fan['follow'];
			}
		}
		
		if (empty($avatar) || empty($nickname) || empty($openid) || empty($follow)) {
			$userinfo = mc_oauth_userinfo();//有openid 有follow 有avatar 有nickname
			if (!is_error($userinfo) && !empty($userinfo) && is_array($userinfo) && !empty($userinfo['avatar'])) {
				$avatar = $userinfo['avatar'];
			}
			if (!is_error($userinfo) && !empty($userinfo) && is_array($userinfo) && !empty($userinfo['nickname'])) {
				$nickname = $userinfo['nickname'];
			}
			if (!is_error($userinfo) && !empty($userinfo) && is_array($userinfo) && !empty($userinfo['openid'])) {
				$openid = $userinfo['openid'];
			}
			if (!is_error($userinfo) && !empty($userinfo) && is_array($userinfo) && !empty($userinfo['follow'])) {
				$follow = $userinfo['follow'];
			}
		}
		if ((empty($avatar) || empty($nickname)) && !empty($_W['member']['uid'])) {
			//$avatar = mc_require($_W['member']['uid'], array('avatar'));//无openid 无follow 有avatar 有nickname
			//$nickname = mc_require($_W['member']['uid'], array('nickname'));
		}
		
		$oauthuser = array();
		$oauthuser['avatar'] = $avatar; 
		$oauthuser['nickname'] = $nickname; 
		$oauthuser['from_user'] = $openid; 
		$oauthuser['follow'] = !empty($follow) ? $follow : $_W['fans']['follow']; 	
		
		return $oauthuser;		
	}
	
	function downloadImage($mediaid, $filename) {
		//下载图片	
		global $_W;
		$uniacid = !empty($_W['uniacid']) ? $_W['uniacid'] : $_W['acid'];		
		load()->func('file');
		$access_token = $_W['account']['access_token']['token'];
		$url = "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=$access_token&media_id=$mediaid";
		$fileInfo = $this->downloadWeixinFile($url);
		$updir = '../attachment/images/'.$uniacid.'/'.date("Y").'/'.date("m").'/';		
		if(!is_dir($updir)){ 
			mkdirs($updir);	
		}  
		$filename = $updir.$filename.".jpg"; 
		$this->saveWeixinFile($filename, $fileInfo["body"]);
		return $filename;
	}
	function downloadVoice($mediaid, $filename, $savetype = 0) {
		//下载语音		
		global $_W;
		load()->func('file');
		$uniacid = !empty($_W['uniacid']) ? $_W['uniacid'] : $_W['acid'];		
		$access_token = $_W['account']['access_token']['token'];
		$url = "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=$access_token&media_id=$mediaid";
		$fileInfo = $this->downloadWeixinFile($url);	
				
		$updir = '../attachment/audios/'.$uniacid.'/'.date("Y").'/'.date("m").'/';		
		if(!is_dir($updir)){ 
			mkdirs($updir);	
		}  
		//$key = $filename.".mp3";
		$filename = $updir.$filename.".amr";
		
		$this->saveWeixinFile($filename, $fileInfo["body"]);
		//$localfilename = $_W['siteroot'].'attachment/audios/'.$uniacid.'/'.date("Y").'/'.date("m").'/'.$key;
		//$qimedia = $this->qiniusaveWeixinFile($key , $localfilename, $fileInfo["body"], $rid);
		if ($savetype == 1) {
			return $qimedia;
		} else {
			return $filename;
		}
		
		
	}
	function downloadThumb($mediaid, $filename) {
		//下载缩略图
		global $_W;
		load()->func('file');
		$uniacid = !empty($_W['uniacid']) ? $_W['uniacid'] : $_W['acid'];		
		$access_token = $_W['account']['access_token']['token'];
		$url = "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=$access_token&media_id=$mediaid";
		$fileInfo = $this->downloadWeixinFile($url);
		$updir = '../attachment/images/'.$uniacid.'/'.date("Y").'/'.date("m").'/';		
		if(!is_dir($updir)){ 
			mkdirs($updir);	
		}  
		$filename = $updir.$filename.".jpg"; 
		$this->saveWeixinFile($filename, $fileInfo["body"]);
		return $filename;
	}
 
	function downloadWeixinFile($url) {
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HEADER, 0);    
		curl_setopt($ch, CURLOPT_NOBODY, 0);    //只取body头
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$package = curl_exec($ch);
		$httpinfo = curl_getinfo($ch);
		curl_close($ch);
		$imageAll = array_merge(array('header' => $httpinfo), array('body' => $package)); 
		return $imageAll;
	}
	 	
	function saveWeixinFile($filename, $filecontent) {		
		$local_file = fopen($filename, 'w');
		if (false !== $local_file){
			if (false !== fwrite($local_file, $filecontent)) {
				fclose($local_file);
			}
		}
	}
		
	function getpicarr($uniacid,$limit,$from_user,$rid) {
		global $_GPC,$_W;
		
		$userinfo = pdo_fetch("SELECT * FROM ".tablename($this->table_users)." WHERE uniacid = :uniacid and from_user = :from_user and rid = :rid", array(':uniacid' => $uniacid,':from_user' => $from_user,':rid' => $rid));
		$picarrs = iunserializer($userinfo['picarr']);
		
		for ($i = 1; $i <= $limit; $i++) {
			$n = $i - 1;
			$picarrout[$n] = $picarrs[$i];
		}		
		if ($picarrout['0'] || $picarrout['1'] || $picarrout['2'] || $picarrout['3'] || $picarrout['4'] || $picarrout['5'] || $picarrout['6'] || $picarrout['7']) {
			$picarrout = iunserializer($userinfo['picarr']);
		}else {
			$picarrout = array();
			for ($i = 1; $i <= $limit; $i++) {
				$n = $i - 1;
				$picarrout[$n] .= $userinfo['picarr_'.$i];				
			}
		}
		return $picarrout;
		
	}
	/**
	*	功能 二维码创建函数；
	* @param string $value 内容（可以是：链接、文字等）
	* @param string $filename 文件名字
	* @param string $pathname 路径名字
	* @param string $errorCorrectionLevel 容错率 L M Q H
	* @return $fileurllogo 中间带logo的二维码；
	* @Author Fmoons
	* @Time 2015.06.04 01:27
	**/
	
	public function fm_qrcode($value='http://www.wdlcms.com', $filename='',$pathname='', $logo, $scqrcode = array('errorCorrectionLevel' => 'H', 'matrixPointSize' => '4', 'margin' => '5')) {	
		global $_W;
		$uniacid = !empty($_W['uniacid']) ? $_W['uniacid'] : $_W['acid'];
		require_once '../framework/library/qrcode/phpqrcode.php';
		load()->func('file');
		
		
		$filename = empty($filename) ? date("YmdHis") . '' . random(10) : date("YmdHis") . '' . random(istrlen($filename));
		
		if (!empty($pathname)) {
			$dfileurl = 'attachment/images/'.$uniacid.'/qrcode/cache/'.date("Ymd").'/'.$pathname;
			$fileurl = '../'.$dfileurl;			
		}else {
			$dfileurl = 'attachment/images/'.$uniacid.'/qrcode/cache/'.date("Ymd");
			$fileurl = '../'.$dfileurl;
		}
		mkdirs($fileurl); 
		
		$fileurl = empty($pathname) ? $fileurl . '/' . $filename.'.png' : $fileurl.'/'.$filename.'.png';
		
		QRcode::png($value, $fileurl, $scqrcode['errorCorrectionLevel'], $scqrcode['matrixPointSize'], $scqrcode['margin']);
		
		$dlogo = $_W['attachurl'].'headimg_'.$uniacid.'.jpg?uniacid='.$uniacid;
		if (!$logo) {
			$logo = toimage($dlogo);
		}
		$QR = $_W['siteroot'].$dfileurl . '/'  . $filename.'.png';
		if($logo !== FALSE)	{
			$QR = imagecreatefromstring(file_get_contents($QR));						
			$logo = imagecreatefromstring(file_get_contents($logo));
			$QR_width = imagesx($QR);
			$QR_height = imagesy($QR);
			$logo_width = imagesx($logo);
			$logo_height = imagesy($logo);
			$logo_qr_width = $QR_width / 5;
			$scale = $logo_width / $logo_qr_width;
			$logo_qr_height = $logo_height / $scale;
			$from_width = ($QR_width - $logo_qr_width) / 2;
			imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
		}
		if (!empty($pathname)) {
			$dfileurllogo = 'attachment/images/'.$uniacid.'/qrcode/fm_qrcode/'.date("Ymd").'/'.$pathname;	
			$fileurllogo = '../'.$dfileurllogo;
		}else {
			$dfileurllogo = 'attachment/images/'.$uniacid.'/qrcode/fm_qrcode';
			$fileurllogo ='../'.$dfileurllogo;
		}
		mkdirs($fileurllogo); 
		$fileurllogo = empty($pathname) ? $fileurllogo.'/'.$filename.'_logo.png' : $fileurllogo.'/'.$filename.'_logo.png';;
		
		imagepng($QR,$fileurllogo);
		return $fileurllogo;
	}
	
	
	private function sendMobileRegMsg($from_user, $rid, $uniacid) {
		global $_GPC,$_W;
		$reply = pdo_fetch("SELECT * FROM ".tablename($this->table_reply)." WHERE rid = :rid ORDER BY `id` DESC", array(':rid' => $rid));$bgarr = iunserializer($reply['bgarr']);
		
		
		$userinfo = pdo_fetch("SELECT * FROM ".tablename($this->table_users)." WHERE uniacid = :uniacid and from_user = :from_user and rid = :rid", array(':uniacid' => $uniacid,':from_user' => $from_user,':rid' => $rid));	
		include 'mtemplate/regvote.php';
		$url =  $_W['siteroot'] .'app/'.$this->createMobileUrl('tuser', array('rid' => $rid,'from_user' => $from_user,'tfrom_user' => $from_user));
		if (!empty($template_id)) {
			$this->sendtempmsg($template_id, $url, $data, '#FF0000', $from_user);
		}
	}
	
	private function sendMobileVoteMsg($tuservote,$tousers, $rid, $uniacid) {
		global $_GPC,$_W;
		$reply = pdo_fetch("SELECT * FROM ".tablename($this->table_reply)." WHERE rid = :rid ORDER BY `id` DESC", array(':rid' => $rid));$bgarr = iunserializer($reply['bgarr']);
		$u = pdo_fetch("SELECT * FROM ".tablename($this->table_users)." WHERE uniacid = :uniacid  AND from_user = :from_user AND rid = :rid", array(':uniacid' => $uniacid,':from_user' => $tuservote['tfrom_user'],':rid' => $rid));
		include 'mtemplate/vote.php';
		$url = $_W['siteroot'] .'app/'.$this->createMobileUrl('tuser', array('rid' => $rid,'from_user' => $tousers,'tfrom_user' => $tuservote['tfrom_user']));
		if (!empty($template_id)) {
			$this->sendtempmsg($template_id, $url, $data, '#FF0000', $tousers);
		}
	}
	private function sendMobileHsMsg($from_user, $rid, $uniacid) {
		global $_GPC,$_W;
		$reply = pdo_fetch("SELECT * FROM ".tablename($this->table_reply)." WHERE rid = :rid ORDER BY `id` DESC", array(':rid' => $rid));		
		$userinfo = pdo_fetch("SELECT * FROM ".tablename($this->table_users)." WHERE uniacid = :uniacid and from_user = :from_user and rid = :rid", array(':uniacid' => $uniacid,':from_user' => $from_user,':rid' => $rid));	
		include 'mtemplate/shenhe.php';
		$url =  $_W['siteroot'] .'app/'.$this->createMobileUrl('tuser', array('rid' => $rid,'from_user' => $from_user,'tfrom_user' => $from_user));
		if (!empty($template_id)) {
			$this->sendtempmsg($template_id, $url, $data, '#FF0000', $from_user);
		}
	}
	
	public function sendtempmsg($template_id, $url, $data, $topcolor, $tousers = '') {
		load()->func('communication');		
		load()->classs('weixin.account');
		$access_token = WeAccount::token();
		if(empty($access_token)) {
			return;
		}
		$postarr = '{"touser":"'.$tousers.'","template_id":"'.$template_id.'","url":"'.$url.'","topcolor":"'.$topcolor.'","data":'.$data.'}';
		$res = ihttp_post('https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$access_token,$postarr);
		return true;
	}
	
	public function doMobileoauth2() {
		global $_GPC,$_W;
		$uniacid = !empty($_W['uniacid']) ? $_W['uniacid'] : $_W['acid'];		
		$rid = $_GPC['rid'];
		load()->func('communication');
		$fromuser = $_GPC['fromuser'];
		$putonghao = $_GPC['putonghao'];
		
		$serverapp = $_W['account']['level'];	//是否为高级号
		
		//借用还是本身为认证号
		if ($serverapp==4) {
		    $appid = $_W['account']['key'];
		    $secret = $_W['account']['secret'];
		}else{
		    $cfg = $this->module['config'];
			$appid = $cfg['appid'];
			$secret = $cfg['secret'];
		}		
		
		//用户不授权返回提示说明
		if ($_GPC['code']=="authdeny"){
		    $url = $_W['siteroot'] .'app/'.$this->createMobileUrl('oauth2shouquan', array('rid' => $rid));
			header("location:$url");
			exit;
		}		
		
		//或取未关注用户Openid
		if (isset($_GPC['code'])){
		    //第一步：获取OpenID		 			
		    $code = $_GPC['code'];			
		    $oauth2_code = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$appid."&secret=".$secret."&code=".$code."&grant_type=authorization_code";
		    $content = ihttp_get($oauth2_code);
			//print_r($content);
			//exit;
		    $token = @json_decode($content['content'], true);
			if(empty($token) || !is_array($token) || empty($token['access_token']) || empty($token['openid'])) {
				echo '<h1>获取微信公众号授权'.$code.'失败[无法取得token以及openid], 请稍后重试！ 公众平台返回原始数据为: <br />' . $content['meta'].'<h1>';
				exit;
			}
		    $openid = $token['openid'];
			$access_token = $token['access_token'];
			//第二步，使用全局ACCESS_TOKEN获取OpenID的详细信息		
			$oauth2_url = "https://api.weixin.qq.com/sns/userinfo?access_token=".$access_token."&openid=".$openid."&lang=zh_CN";
			$content = ihttp_get($oauth2_url);
			$info = @json_decode($content['content'], true);
			if(empty($info) || !is_array($info) || empty($info['openid'])  || empty($info['nickname']) ) {
				echo '<h1>获取微信公众号授权失败[无法取得info], 请稍后重试！ 公众平台返回原始数据为: <br />' . $content['meta'].'<h1>';
				exit;
			}
		    $avatar = $info['headimgurl'];
		    $nickname = $info['nickname'];
		    $sex = $info['sex'];
			//$from_user = $openid;
		   
		   //设置cookie信息
		    setcookie("user_oauth2_avatar", $avatar, time()+3600*24*7);
		    setcookie("user_oauth2_nickname", $nickname, time()+3600*24*7);
		    setcookie("user_oauth2_sex", $sex, time()+3600*24*7);
			setcookie("user_oauth2_openid", $openid, time()+3600*24*7);
			if(!empty($fromuser) && !isset($_COOKIE["user_fromuser_openid"])){
			    setcookie("user_fromuser_openid", $fromuser, time()+3600*24*7*30);
			}
			
			if(!empty($putonghao)  && !isset($_COOKIE["user_putonghao_openid"])){
			    setcookie("user_putonghao_openid", $putonghao, time()+3600*24*7);
			}
			
			if ($fromuser && $_GPC['duli']) {
			    $photosvoteviewurl = $_W['siteroot'] .'app/'.$this->createMobileUrl('shareuserdata', array('rid' => $rid,'fromuser' => $fromuser,'duli' => $_GPC['duli'],'tfrom_user' => $_GPC['tfrom_user']));
			}else{
			    $photosvoteviewurl = $_W['siteroot'] .'app/'.$this->createMobileUrl('photosvoteview', array('rid' => $rid,'from_user' => $openid));
			}		    
		    header("location:$photosvoteviewurl");
			exit;
		}else{
			echo '<h1>不是高级认证号或网页授权域名设置出错!</h1>';
			exit;		
		}
	}
	
	public function doMobileoauth2shouquan() {
	    global $_GPC,$_W;
		$uniacid = !empty($_W['uniacid']) ? $_W['uniacid'] : $_W['acid'];		
		$rid = $_GPC['rid'];
		//活动规则
		if (!empty($rid)) {
			$reply = pdo_fetch("SELECT shareurl FROM ".tablename($this->table_reply)." WHERE rid = :rid ORDER BY `id` DESC", array(':rid' => $rid));
			$url = $reply['shareurl'];
	        header("location:$url");
			exit;
 		}
		
	}
	private function checkoauth2($rid,$oauthopenid, $fromuser = '') {//如果没有取得cookie信息	重新授权
        global $_W;
		load()->model('account');
		$uniacid = !empty($_W['uniacid']) ? $_W['uniacid'] : $_W['acid'];
		$serverapp = $_W['account']['level'];	//判断公众号类型
		
		$cfg = $this->module['config'];
	    $appid = $cfg['appid'];
		$secret = $cfg['secret'];		
		
		if (!$oauthopenid) {
		    if ($serverapp == 4) {//认证服务号
			    $appid = $_W['account']['key'];
			    $url = $_W['siteroot'] .'app/'.$this->createMobileUrl('oauth2', array('rid' => $rid,'fromuser' => $fromuser));
			    $oauth2_code = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$appid."&redirect_uri=".urlencode($url)."&response_type=code&scope=snsapi_userinfo&state=0#wechat_redirect";				
			    header("location:$oauth2_code");
				exit;
			}else{
			    if(!empty($appid)){//有借用跳转授权页没有则跳转普通注册页
				    $url = $_W['siteroot'] .'app/'.$this->createMobileUrl('oauth2', array('rid' => $rid,'fromuser' => $fromuser));
				    $oauth2_code = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$appid."&redirect_uri=".urlencode($url)."&response_type=code&scope=snsapi_userinfo&state=0#wechat_redirect";				
				    header("location:$oauth2_code");
					exit;
				}else{
				    $reguser = $_W['siteroot'] .'app/'.$this->createMobileUrl('reguser', array('rid' => $rid));
				    header("location:$reguser");
					exit;
				}
			}
		}
	}
	
	
	public function doWebIndex() {	
		$this->__web(__FUNCTION__);
	}
	
	 public function doWebDeleteAll() {
		$this->__web(__FUNCTION__);
    }
	
	public function doWebDelete() {
		$this->__web(__FUNCTION__);
    }
	
	public function doWebMembers() {
		$this->__web(__FUNCTION__);
	}
	public function doWebDeletefans() {
		$this->__web(__FUNCTION__);
	}
	
	public function doWebDeletemsg() {
		$this->__web(__FUNCTION__);
	}
	public function doWebDeletevote() {
		$this->__web(__FUNCTION__);
	}
	public function doWebProvevote() {
		$this->__web(__FUNCTION__);
	}
	public function doWebupaudios() {
		$this->__web(__FUNCTION__);
	}
	
	public function doWebupimages() {
		$this->__web(__FUNCTION__);
	}
	
	public function doWebAddProvevote() {
		$this->__web(__FUNCTION__);
	}
	
	public function doWebVotelog() {
		$this->__web(__FUNCTION__);		
	}
	
	public function doWebMessage() {
		$this->__web(__FUNCTION__);
	}
	
	public function doWebAnnounce() {
		$this->__web(__FUNCTION__);
	}
	public function doWebAddMessage() {
		$this->__web(__FUNCTION__);
	}
	
	public function doWebIplist() {
		$this->__web(__FUNCTION__);
	}	
	
	public function doWebdeletealllog() {
		$this->__web(__FUNCTION__);
	}
	public function doWebdeleteallmessage() {
		$this->__web(__FUNCTION__);
	}
	public function doWebRankinglist() {	
		$this->__web(__FUNCTION__);
	}
	
	public function doWebstatus() {
		$this->__web(__FUNCTION__);
	}
	
	public function doWebBanner() {
		$this->__web(__FUNCTION__);
	}

	public function doWebAdv() {
		$this->__web(__FUNCTION__);
	}
	public function _getip($rid, $ip, $uniacid = '') {
		global $_GPC, $_W;
		if (empty($uniacid)) {
			$uniacid = !empty($_W['uniacid']) ? $_W['uniacid'] : $_W['acid'];
		}
		$iparrs = pdo_fetch("SELECT iparr FROM ".tablename($this->table_log)." WHERE uniacid = :uniacid and  rid = :rid and ip = :ip ", array(':uniacid' => $uniacid, ':rid' => $rid, ':ip' => $ip));
		$iparr = iunserializer($iparrs['iparr']);
		return $iparr;
	}
	public function _getuser($rid, $tfrom_user, $uniacid = '') {
		global $_GPC, $_W;
		if (empty($uniacid)) {
			$uniacid = !empty($_W['uniacid']) ? $_W['uniacid'] : $_W['acid'];
		}
		return pdo_fetch("SELECT avatar, nickname FROM ".tablename($this->table_users)." WHERE uniacid = :uniacid and  rid = :rid and from_user = :tfrom_user ", array(':uniacid' => $uniacid, ':rid' => $rid, ':tfrom_user' => $tfrom_user));
	}
	public function _auser($rid, $afrom_user, $uniacid = '') {
		global $_GPC, $_W;
		load()->model('mc');
		if (empty($uniacid)) {
			$uniacid = !empty($_W['uniacid']) ? $_W['uniacid'] : $_W['acid'];
		}
		$auser = pdo_fetch("SELECT avatar, nickname FROM ".tablename($this->table_users)." WHERE uniacid = :uniacid and  rid = :rid and from_user = :afrom_user ", array(':uniacid' => $uniacid, ':rid' => $rid, ':afrom_user' => $afrom_user));
		if (empty($auser)) {
			$auser = pdo_fetch("SELECT avatar, nickname FROM ".tablename($this->table_data)." WHERE uniacid = :uniacid and  rid = :rid and from_user = :afrom_user ", array(':uniacid' => $uniacid, ':rid' => $rid, ':afrom_user' => $afrom_user));
			if (empty($auser)) {
				$auser = mc_fansinfo($row['afrom_user']);
			}
		}	
		return $auser;
	}
	public function getsharenum($uniacid, $tfrom_user, $rid, $sharenum) {
			global $_W, $_GPC;
			return pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename($this->table_data)." WHERE uniacid = :uniacid and tfrom_user = :tfrom_user and rid = :rid", array(':uniacid' => $uniacid,':tfrom_user' => $tfrom_user,':rid' => $rid)) + pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename($this->table_data)." WHERE uniacid = :uniacid and fromuser = :fromuser and rid = :rid", array(':uniacid' => $uniacid,':fromuser' => $tfrom_user,':rid' => $rid)) + $sharenum;
		}
	
	//导出数据
	public function doWebdownload(){
		require_once 'download.php';
	}
	public function doWebtpdownload(){
		require_once 'tpdownload.php';
	}
	####################################
		
	public function webmessage($error, $url = '', $errno = -1) {
        $data = array();
        $data['errno'] = $errno;
        if (!empty($url)) {
            $data['url'] = $url;
        }
        $data['error'] = $error;
        echo json_encode($data);
        exit;
    }
	
	####################################
	
	public function doWebFmoth() {
		$this->__web(__FUNCTION__);
	}
}

if(!function_exists('paginationm')) {
	/**
	 * 生成分页数据
	 * @param int $currentPage 当前页码
	 * @param int $totalCount 总记录数
	 * @param string $url 要生成的 url 格式，页码占位符请使用 *，如果未写占位符，系统将自动生成
	 * @param int $pageSize 分页大小
	 * @return string 分页HTML
	 */
	function paginationm($tcount, $pindex, $psize = 15, $url = '', $context = array('before' => 5, 'after' => 4, 'ajaxcallback' => '')) {
		global $_W;
		$pdata = array(
			'tcount' => 0,
			'tpage' => 0,
			'cindex' => 0,
			'findex' => 0,
			'pindex' => 0,
			'nindex' => 0,
			'lindex' => 0,
			'options' => ''
		);
		if($context['ajaxcallback']) {
			$context['isajax'] = true;
		}

		$pdata['tcount'] = $tcount;
		$pdata['tpage'] = ceil($tcount / $psize);
		if($pdata['tpage'] <= 1) {
			return '';
		}
		$cindex = $pindex;
		$cindex = min($cindex, $pdata['tpage']);
		$cindex = max($cindex, 1);
		$pdata['cindex'] = $cindex;
		$pdata['findex'] = 1;
		$pdata['pindex'] = $cindex > 1 ? $cindex - 1 : 1;
		$pdata['nindex'] = $cindex < $pdata['tpage'] ? $cindex + 1 : $pdata['tpage'];
		$pdata['lindex'] = $pdata['tpage'];

		if($context['isajax']) {
			if(!$url) {
				$url = $_W['script_name'] . '?' . http_build_query($_GET);
			}
			$pdata['faa'] = 'href="javascript:;" onclick="p(\'' . $_W['script_name'] . $url . '\', \'' . $pdata['findex'] . '\', ' . $context['ajaxcallback'] . ')"';
			$pdata['paa'] = 'href="javascript:;" onclick="p(\'' . $_W['script_name'] . $url . '\', \'' . $pdata['pindex'] . '\', ' . $context['ajaxcallback'] . ')"';
			$pdata['naa'] = 'href="javascript:;" onclick="p(\'' . $_W['script_name'] . $url . '\', \'' . $pdata['nindex'] . '\', ' . $context['ajaxcallback'] . ')"';
			$pdata['laa'] = 'href="javascript:;" onclick="p(\'' . $_W['script_name'] . $url . '\', \'' . $pdata['lindex'] . '\', ' . $context['ajaxcallback'] . ')"';
		} else {
			if($url) {
				$pdata['faa'] = 'href="?' . str_replace('*', $pdata['findex'], $url) . '"';
				$pdata['paa'] = 'href="?' . str_replace('*', $pdata['pindex'], $url) . '"';
				$pdata['naa'] = 'href="?' . str_replace('*', $pdata['nindex'], $url) . '"';
				$pdata['laa'] = 'href="?' . str_replace('*', $pdata['lindex'], $url) . '"';
			} else {
				$_GET['page'] = $pdata['findex'];
				$pdata['faa'] = 'href="' . $_W['script_name'] . '?' . http_build_query($_GET) . '"';
				$_GET['page'] = $pdata['pindex'];
				$pdata['paa'] = 'href="' . $_W['script_name'] . '?' . http_build_query($_GET) . '"';
				$_GET['page'] = $pdata['nindex'];
				$pdata['naa'] = 'href="' . $_W['script_name'] . '?' . http_build_query($_GET) . '"';
				$_GET['page'] = $pdata['lindex'];
				$pdata['laa'] = 'href="' . $_W['script_name'] . '?' . http_build_query($_GET) . '"';
			}
		}

		$html = '<div class="pagination pagination-centered"><ul class="pagination pagination-centered">';
		if($pdata['cindex'] > 1) {
			$html .= "<li><a {$pdata['faa']} class=\"pager-nav\">首页</a></li>";
			$html .= "<li><a {$pdata['paa']} class=\"pager-nav\">&laquo;上一页</a></li>";
		}
		//页码算法：前5后4，不足10位补齐
		if(!$context['before'] && $context['before'] != 0) {
			$context['before'] = 5;
		}
		if(!$context['after'] && $context['after'] != 0) {
			$context['after'] = 4;
		}

		if($context['after'] != 0 && $context['before'] != 0) {
			$range = array();
			$range['start'] = max(1, $pdata['cindex'] - $context['before']);
			$range['end'] = min($pdata['tpage'], $pdata['cindex'] + $context['after']);
			if ($range['end'] - $range['start'] < $context['before'] + $context['after']) {
				$range['end'] = min($pdata['tpage'], $range['start'] + $context['before'] + $context['after']);
				$range['start'] = max(1, $range['end'] - $context['before'] - $context['after']);
			}
			for ($i = $range['start']; $i <= $range['end']; $i++) {
				if($context['isajax']) {
					$aa = 'href="javascript:;" onclick="p(\'' . $_W['script_name'] . $url . '\', \'' . $i . '\', ' . $context['ajaxcallback'] . ')"';
				} else {
					if($url) {
						$aa = 'href="?' . str_replace('*', $i, $url) . '"';
					} else {
						$_GET['page'] = $i;
						$aa = 'href="?' . http_build_query($_GET) . '"';
					}
				}
				$html .= ($i == $pdata['cindex'] ? '<li class="active"><a href="javascript:;">' . $i . '</a></li>' : "<li><a {$aa}>" . $i . '</a></li>');
			}
		}

		if($pdata['cindex'] < $pdata['tpage']) {
			$html .= "<li><a {$pdata['naa']} class=\"pager-nav\">下一页&raquo;</a></li>";
			$html .= "<li><a {$pdata['laa']} class=\"pager-nav\">尾页</a></li>";
		}
		$html .= '</ul></div>';
		return $html;
	}
}


/**
*求两个已知经纬度之间的距离,单位为米
*@param lng1,lng2 经度
*@param lat1,lat2 纬度
*@return float 距离，单位千米
*@author www.wdlcms.com
**/
if(!function_exists('getDistance')) {
	function getDistance($lng1,$lat1,$lng2,$lat2){
		//将角度转为狐度
		$radLat1=deg2rad($lat1);//deg2rad()函数将角度转换为弧度
		$radLat2=deg2rad($lat2);
		$radLng1=deg2rad($lng1);
		$radLng2=deg2rad($lng2);
		$a=$radLat1-$radLat2;
		$b=$radLng1-$radLng2;
		$s=2*asin(sqrt(pow(sin($a/2),2)+cos($radLat1)*cos($radLat2)*pow(sin($b/2),2)))*6378.137*1000;
		return sprintf("%.2f", $s/1000);
	}
}
if(!function_exists('mobilelimit')) {
	function mobilelimit($mobile){
		$phone = $mobile;
		$mphone = substr($phone,3,4);
		$lphone = str_replace($mphone,"****",$phone);
		return $lphone;
	}
}
if(!function_exists('getrealip')) {
	function getrealip(){
		
   $unknown = 'unknown'; 
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] && strcasecmp($_SERVER['HTTP_X_FORWARDED_FOR'], $unknown)) { 
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR']; 
            } 
            elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], $unknown)) { 
                $ip = $_SERVER['REMOTE_ADDR']; 
            } 
            /*  
        处理多层代理的情况  
        或者使用正则方式：$ip = preg_match("/[\d\.]{7,15}/", $ip, $matches) ? $matches[0] : $unknown;  
        */ 
            if (false !== strpos($ip, ',')) $ip = reset(explode(',', $ip)); 
            return $ip; 
	}
}

if(!function_exists('GetIpLookup')) {
	function GetIpLookup($ip = ''){  
		if(empty($ip)){  
			$ip = getip();  
		}  
		$res = @file_get_contents('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip=' . $ip);  
		if(empty($res)){ return false; }  
		$jsonMatches = array();  
		preg_match('#\{.+?\}#', $res, $jsonMatches);  
		if(!isset($jsonMatches[0])){ return false; }  
		$json = json_decode($jsonMatches[0], true);  
		if(isset($json['ret']) && $json['ret'] == 1){  
			$json['ip'] = $ip;  
			unset($json['ret']);  
		}else{  
			return false;  
		}  
		return $json;  
	}  
}  
if(!function_exists('getiparr')) {	
	function getiparr($ip) {
		$ip = GetIpLookup($row['ip']);
		$iparr = array();
		$iparr['country'] .= $ip['country'];
		$iparr['province'] .= $ip['province'];
		$iparr['city'] .= $ip['city'];
		$iparr['district'] .= $ip['district'];
		$iparr['ist'] .= $ip['ist'];
		$iparr = iserializer($iparr);
		return $iparr;
	}
}