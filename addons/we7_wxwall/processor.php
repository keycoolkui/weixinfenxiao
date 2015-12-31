<?php
/**
 * 图文回复处理类
 *
 * [WeEngine System] Copyright (c) 2013 wdlcms.com
 */
defined('IN_IA') or exit('Access Denied');

class we7_wxwallModuleProcessor extends WeModuleProcessor {
	public $name = 'WxwallChatRobotModuleProcessor';
	
	public function respond() {
		global $_W;
		checkauth();
		if ($this->inContext) {
			return $this->post();
		} else {
			return $this->register();
		}
	}
	
	private function register() {
		global $_W;
		$rid = $this->rule;
		$wall = pdo_fetch("SELECT * FROM ".tablename('wxwall_reply')." WHERE rid = :rid LIMIT 1", array(':rid'=>$rid));
		if (empty($wall)) {
			return array();
		}
		$member = $this->getMember();
		if (empty($member['nickname']) || empty($member['avatar'])) {
			$message = '发表话题前请完善您的基本信息，<a target="_blank" href="'.$this->createMobileUrl('register').'">点击完善</a>。';
		} else {
			$message = $wall['enter_tips'];
		}
		
		$this->beginContext();
		return $this->respText($message);
	}
	
	private function post() {
		global $_W, $engine;
		if (!in_array($this->message['msgtype'], array('text', 'image'))) {
			return false;
		}
		
		$member = $this->getMember();
		$wall = pdo_fetch("SELECT * FROM ".tablename('wxwall_reply')." WHERE rid = :rid LIMIT 1", array(':rid'=>$member['rid']));
		
		if ((!empty($wall['timeout']) && $wall['timeout'] > 0 && TIMESTAMP - $member['lastupdate'] >= $wall['timeout'])) {
			$this->endContext();
			return $this->respText('由于您长时间未操作，请重新进入微信墙！');
		}
		$this->refreshContext();
		if ((empty($wall['quit_command']) && $this->message['content'] == '退出') ||
			(!empty($wall['quit_command']) && $this->message['content'] == $wall['quit_command'])) {
			$this->endContext();
			return $this->respText($wall['quit_tips']);
		}
		if (empty($member['nickname']) || empty($member['avatar'])) {
			return $this->respText('发表话题前请完善您的基本信息，<a target="_blank" href="'.$this->createMobileUrl('register').'">点击完善</a>。');
		}
		
		$data = array(
			'rid' => $member['rid'],
			'from_user' => $_W['member']['uid'],
			'type' => $this->message['type'],
			'createtime' => TIMESTAMP,
		);
		if (empty($wall['isshow']) && empty($member['isblacklist'])) {
			$data['isshow'] = 1;
		} else {
			$data['isshow'] = 0;
		}
		
		if ($this->message['type'] == 'text') {
			$data['content'] = $this->message['content'];
		}
		if ($this->message['type'] == 'image') {
			load()->func('communication');
			$image = ihttp_request($this->message['picurl']);
			$partPath = IA_ROOT. '/'.$_W['config']['upload']['attachdir'].'/';
			
			do {
				$filename = "images/{$_W['uniacid']}/".date('Y/m/').random(30).'.jpg';
			} while(file_exists($partPath . $filename));
			
			file_write($filename, $image['content']);
			$data['content'] = $filename;
		}
		if ($this->message['type'] == 'link') {
			$data['content'] = iserializer(array('title' => $this->message['title'], 'description' => $this->message['description'], 'link' => $this->message['link']));
		}
		
		pdo_insert('wxwall_message', $data);
		
		if (!empty($member['isblacklist'])) {
			$content .= '你已被列入黑名单，发送的消息需要管理员审核！';
		} elseif (!empty($wall['isshow'])) {
			$content = '发送消息成功，请等待管理员审核';
		} elseif(!empty($wall['send_tips'])) {
			$content = $wall['send_tips'];
		} else {
			$content = '发送消息成功。';
		}
		
		return $this->respText($content);
	}
	
	private function getMember() {
		global $_W;
		$rid = $this->rule;
		
		$sql = "SELECT lastupdate, isblacklist, rid FROM ".tablename('wxwall_members')." WHERE from_user = :uid AND rid = :rid LIMIT 1";
		$param = array(
			':uid' => $_W['member']['uid'], 
			':rid' => $this->rule
		);
		$member = pdo_fetch($sql, $param);
		if (empty($member)) {
			$member = array(
				'from_user' => $_W['member']['uid'],
				'rid' => $this->rule,
				'isjoin' => 1,
				'lastupdate' => TIMESTAMP,
				'isblacklist' => 0,
			);
			pdo_insert('wxwall_members', $member);
		} else {
			$member ['lastupdate'] = TIMESTAMP;
			$data = array('lastupdate' => TIMESTAMP);
			$parm = array('from_user' => $_W['member']['uid'],'rid' => $this->rule);
			pdo_update('wxwall_members', $data, $parm);
		}
		load()->model('mc');
		$profile = mc_fetch($_W['member']['uid'], array('nickname', 'avatar'));
		if (!empty($profile)) {
			$member = array_merge($member, $profile);
		}
		return $member;
	}
	
	public function hookBefore() {
		global $_W, $engine;
	}
}
