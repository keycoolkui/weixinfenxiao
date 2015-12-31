<?php
/**
 * 微信墙模块
 *
 * [WeEngine System] Copyright (c) 2013 wdlcms.com
 */
defined('IN_IA') or exit('Access Denied');
class We7_wxwallModuleSite extends WeModuleSite {
	/**
	 * 内容管理
	 */
	public function doWebManage() {
		global $_GPC, $_W;
		/**** 0.6 ****/
		checklogin();

		$id = intval($_GPC['id']);
		$isshow = isset($_GPC['isshow']) ? intval($_GPC['isshow']) : 0;

		if (checksubmit('verify') && !empty($_GPC['select'])) {
			foreach ($_GPC['select'] as &$row) {
				$row = intval($row);
			}
			$sql = 'UPDATE '.tablename('wxwall_message')." SET isshow=1 WHERE rid=:rid AND id  IN  ('".implode("','", $_GPC['select'])."')";
			pdo_query($sql, array(':rid' => $id));
			message('审核成功！', $this->createWebUrl('manage', array('id' => $id, 'isshow'=>$isshow, 'page' => $_GPC['page'])));
		}
		if (checksubmit('delete') && !empty($_GPC['select'])) {
			foreach ($_GPC['select'] as &$row) {
				$row = intval($row);
			}
			$sql = 'DELETE FROM'.tablename('wxwall_message')." WHERE rid=:rid AND id  IN  ('".implode("','", $_GPC['select'])."')";
			pdo_query($sql, array(':rid' => $id));
			message('删除成功！', $this->createWebUrl('manage', array('id' => $id, 'isshow'=>$isshow, 'page' => $_GPC['page'])));
		}

		$condition = '';
		if($isshow == 0) {
			$condition .= 'AND isshow = '.$isshow;
		} else {
			$condition .= 'AND isshow > 0';
		}
		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;
		$wall = pdo_fetch("SELECT id, isshow, rid FROM ".tablename('wxwall_reply')." WHERE rid = '{$id}' LIMIT 1");
		$list = pdo_fetchall("SELECT * FROM ".tablename('wxwall_message')." WHERE rid = '{$wall['rid']}' {$condition} ORDER BY createtime DESC LIMIT ".($pindex - 1) * $psize.",{$psize}");
		if (!empty($list)) {
			$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wxwall_message') . " WHERE rid = '{$wall['rid']}' {$condition}");
			$pager = pagination($total, $pindex, $psize);
			foreach ($list as &$row) {
				if ($row['type'] == 'link') {
					$row['content'] = iunserializer($row['content']);
					$row['content'] = '<a href="'.$row['content']['link'].'" target="_blank" title="'.$row['content']['description'].'">'.$row['content']['title'].'</a>';
				} elseif ($row['type'] == 'image') {
					$row['content'] = '<img src="'.$_W['attachurl'] . $row['content'].'" />';
				} else {
					$row['content'] = emotion($row['content']);
				}
				$userids[] = $row['from_user'];
			}
			unset($row);
			if (!empty($userids)) {
				$userids = array_unique($userids);

				/**** 0.6 ****/
				load()->model('mc');
				$member = mc_fetch($userids, array('nickname','avatar'));
				$blacklist = pdo_fetchall("SELECT from_user, isblacklist FROM ".tablename('wxwall_members')." WHERE rid=:rid AND from_user IN ('".implode("','", $userids)."')", array(':rid'=>$id), 'from_user');
				foreach ($member as $key => &$row) {
					$row['isblacklist'] = $blacklist[$key]['isblacklist'];
				}
				unset($row);
			}
		}
		include $this->template('manage');
	}

	/**
	 * 增量数据调用
	 */
	public function doWebIncoming() {
		global $_GPC, $_W;
		$id = intval($_GPC['id']);

		$lastmsgtime = intval($_GPC['lastmsgtime']);
		$sql = "SELECT id, content, from_user, type, createtime FROM ".tablename('wxwall_message')." WHERE rid = :rid ";
		$params = array(':rid'=>$id);
		$page = max(1, intval($_GPC['page']));
		if (!empty($lastmsgtime)) {
			$sql .= " AND createtime >= :createtime AND isshow > 0 ORDER BY id ASC LIMIT ".($page-1).", 1";
			$params[':createtime'] = $lastmsgtime;
		} else {
			$sql .= " AND isshow = '1' ORDER BY createtime ASC  LIMIT 1";
		}
		$list = pdo_fetchall($sql,$params);
		if (!empty($list)) {
			$this->formatMsg($list);
			$row = $list[0];
			pdo_update('wxwall_message', array('isshow' => '2'), array('id' => $row['id']));
			$row['content'] = emotion($row['content'], '48px');
			message($row, '', 'ajax');
		}
	}

	/**
	 * 黑名单
	 */
	public function doWebBlacklist() {
		global $_W, $_GPC;
		$id = intval($_GPC['id']);

		if (checksubmit('delete') && isset($_GPC['select']) && !empty($_GPC['select'])) {
			foreach ($_GPC['select'] as &$row) {
				$row = intval($row);
			}
			$sql = 'UPDATE ' . tablename('wxwall_members') . " SET isblacklist=0 WHERE rid=:rid AND id  IN ('".implode("','", $_GPC['select'])."')";
			pdo_query($sql, array(':rid'=>$id));
			message('黑名单解除成功！', $this->createWebUrl('blacklist', array('id' => $id, 'page' => $_GPC['page'])));
		}
		if (!empty($_GPC['from_user'])) {
			$isshow = isset($_GPC['isshow']) ? intval($_GPC['isshow']) : 0;
			pdo_update('wxwall_members', array('isblacklist' => intval($_GPC['switch'])), array('from_user' => $_GPC['from_user'], 'rid'=>$id));
			message('黑名单操作成功！', $this->createWebUrl('manage', array('id' => $id, 'isshow' => $isshow)));
		}

		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;
		$list = pdo_fetchall("SELECT id, from_user, lastupdate FROM ".tablename('wxwall_members')." WHERE isblacklist = '1' AND rid=:rid ORDER BY lastupdate DESC LIMIT ".($pindex - 1) * $psize.",{$psize}", array(':rid' => $id), 'from_user');
		$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wxwall_members') . " WHERE isblacklist = '1' AND rid=:rid ", array(':rid' => $id));
		$pager = pagination($total, $pindex, $psize);

		/**** 0.6 ****/
		load()->model('mc');
		$member = mc_fetch(array_keys($list), array('nickname', 'avatar'));

		include $this->template('blacklist');
	}

	/**
	 * 二维码
	 */
	public function doWebQrcode() {
		global $_GPC, $_W;
		$id = intval($_GPC['id']);
		$wall = $this->getWall($id);
		include $this->template('qrcode');
	}

	/**
	 * 抽奖
	 */
	public function doWebLottery() {
		global $_GPC, $_W;

		/**** 0.6 ****/
		checklogin();

		$id = intval($_GPC['id']);
		$type = intval($_GPC['type']);
		$wall = $this->getWall($id);
		if ($type == 1) {
			$list = pdo_fetchall("SELECT id, content, from_user, type, createtime FROM ".tablename('wxwall_message')." WHERE rid = '{$wall['rid']}' AND isshow = '2' AND from_user <> '' ORDER BY createtime DESC");
		} else {
			$list = pdo_fetchall("SELECT id, content, from_user, type, createtime FROM ".tablename('wxwall_message')." WHERE rid = '{$wall['rid']}' AND isshow = '2' AND from_user <> '' GROUP BY from_user ORDER BY createtime DESC LIMIT 10");
		}
		$this->formatMsg($list);
		include $this->template('lottery');
	}

	/**
	 * 抽奖
	 */
	public function doWebAward() {
		global $_GPC, $_W;

		/**** 0.6 ****/
		checklogin();

		$message = pdo_fetch("SELECT * FROM ".tablename('wxwall_message')." WHERE id = :id LIMIT 1", array(':id'=>intval($_GPC['mid'])));
		if (empty($message)) {
			message('抱歉，参数不正确！', '', 'error');
		}
		$data = array(
			'rid' => $message['rid'],
			'from_user' => $message['from_user'],
			'createtime' => TIMESTAMP,
			'status' => 0,
		);
		pdo_insert('wxwall_award', $data);
		message('', '', 'success');
	}

	/**
	 * 中奖列表
	 */
	public function doWebAwardlist() {
		global $_GPC, $_W;
		$id = intval($_GPC['id']);
		if (checksubmit('delete') && !empty($_GPC['select'])) {
			pdo_delete('wxwall_award', " id  IN  ('".implode("','", $_GPC['select'])."')");
			message('删除成功！', $this->createWebUrl('awardlist', array('id' => $id, 'page' => $_GPC['page'])));
		}
		if (!empty($_GPC['wid'])) {
			$wid = intval($_GPC['wid']);
			pdo_update('wxwall_award', array('status' => intval($_GPC['status'])), array('id' => $wid));
			message('标识领奖成功！', $this->createWebUrl('awardlist', array('id' => $id, 'page' => $_GPC['page'])));
		}

		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;
		$sql = "SELECT * FROM ".tablename('wxwall_award')." WHERE rid = :rid ORDER BY status, `createtime` DESC LIMIT ".($pindex - 1) * $psize.",{$psize}";
		$list = pdo_fetchall($sql, array(':rid'=>$id));
		if (!empty($list)) {
			$total = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename('wxwall_award')." WHERE rid = :rid", array(':rid'=>$id));
			$pager = pagination($total, $pindex, $psize);
			foreach ($list as $row) {
				$users[$row['from_user']] = $row['from_user'];
			}
			load()->model('mc');
			$users = mc_fetch($users, array('nickname', 'avatar'));
		}
		include $this->template('awardlist');
	}

	/**
	 * 获取微信墙附加字段信息
	 * @param int $id
	 * @return array
	 */
	public function getWall($id) {
		$wall = pdo_fetch("SELECT id, acid, isshow, rid, syncwall, logo, background FROM ".tablename('wxwall_reply')." WHERE rid = :rid LIMIT 1", array(':rid'=>$id));
		$wall['syncwall'] = unserialize($wall['syncwall']);
		$wall['rule'] = pdo_fetch("SELECT name, uniacid FROM ".tablename('rule')." WHERE id = :rid LIMIT 1", array(':rid'=>$id));
		load()->model('account');
		$accounts = uni_accounts();
		$wall['account'] = $accounts[$wall['acid']];
		$wall['keyword'] = pdo_fetchall("SELECT content FROM ".tablename('rule_keyword')." WHERE rid = :rid ", array(':rid'=>$id));
		return $wall;
	}

	/**
	 * 格式化输出微信墙信息
	 * @param array $list 消息集合
	 */
	public function formatMsg(&$list) {
		global $_W;
		if (empty($list)) {
			return false;
		}

		$uids = $members = array();
		foreach ($list as &$row) {
			$uids[$row['from_user']] = $row['from_user'];
			if ($row['type'] == 'link') {
				$row['content'] = iunserializer($row['content']);
				$row['content'] = '<a href="'.$row['content']['link'].'" target="_blank" title="'.$row['content']['description'].'">'.$row['content']['title'].'</a>';
			} elseif ($row['type'] == 'image') {
				$row['content'] = '<img src="'.$_W['attachurl'] . $row['content'].'" />';
			} elseif ($row['type'] == 'txwall') {
				$content = unserialize($row['content']);
				$row['content'] = $content['content'];
				$row['avatar'] = $content['avatar'];
				$row['nickname'] = $content['nickname'];
			}
			$row['content'] = emotion($row['content'], '48px');
		}
		unset($row);
		if (!empty($uids)) {
			load()->model('mc');
			$members = mc_fetch($uids, array('nickname', 'avatar'));
		}
		if (!empty($members)) {
			foreach ($list as $index => &$row) {
				if ($row['type'] == 'txwall') {
					continue;
				}
				$row['nickname'] = $members[$row['from_user']]['nickname'];
				$row['avatar'] = $members[$row['from_user']]['avatar'];
			}
			unset($row);
		}
	}

	/**
	 * 异步处理腾讯墙信息
	 */
	public function doWebIncomingTxWall() {
		global $_W, $_GPC;
		$id = intval($_GPC['id']);

		$result = array('status' => 0);
		$lastmsgtime = intval($_GPC['lastmsgtime']);
		$lastuser = '';
		$wall = pdo_fetchcolumn("SELECT syncwall FROM ".tablename('wxwall_reply')." WHERE rid = :rid LIMIT 1", array(':rid'=>$id));
		if (empty($wall)) {
			message($result, '', 'ajax');
		}
		$wall = unserialize($wall);
		if (empty($wall['tx']['status'])) {
			message($result, '', 'ajax');
		}
		$response = ihttp_request('http://wall.v.t.qq.com/index.php?c=wall&a=topic&ak=801424380&t='.$wall['tx']['subject'].'&fk=&fn=&rnd='.TIMESTAMP);
		if (empty($response['content'])) {
			$result['status'] = -1;
			message($result, '', 'ajax');
		}
		$last = pdo_fetch("SELECT createtime, from_user FROM ".tablename('wxwall_message')." WHERE createtime >= :createtime AND type = 'txwall' AND rid = :rid ORDER BY createtime DESC LIMIT 1", array(':createtime'=>$lastmsgtime, ':rid'=>$id));
		if (!empty($last)) {
			$lastmsgtime = $last['createtime'];
			$lastuser = $last['from_user'];
		}
		$list = json_decode($response['content'], true);
		if (!empty($list['data']['info'])) {
			foreach ($list['data']['info'] as $row) {
				if ($row['timestamp'] < $lastmsgtime || ($lastmsgtime == $row['timestamp'] && !empty($lastuser) && $lastuser == $row['name'])) {
					break;
				}
				$content = array('nickname' => $row['nick'], 'avatar' => !empty($row['head']) ? $row['head'] . '/120' : '', 'content' => $row['text']);
				$insert[] = array(
					'rid' => $id,
					'content' => serialize($content),
					'from_user' => $row['name'],
					'type' => 'txwall',
					'isshow' => 1,
					'createtime' => $row['timestamp'],
				);
			}
			unset($row);
			$insert = array_reverse($insert);
			foreach ($insert as $row) {
				pdo_insert('wxwall_message', $row);
			}
			$lastmsgtime = $row['timestamp'];
			$result = array(
				'status' => 1,
				'lastmsgtime' => $lastmsgtime,
			);
			message($result, '', 'ajax');
		} else {
			message($result, '', 'ajax');
		}
	}

	/**
	 * 腾讯墙信息登记
	 */
	public function doMobileRegister() {
		global $_GPC, $_W;
		$title = '微信墙登记';
		/**** 0.6 ****/
		load()->model('mc');
		load()->func('tpl');
		// 验证用户注册, 注册后方能进如活动
		checkauth();
		if (!empty($_GPC['submit'])) {
			$data = array(
				'nickname' => $_GPC['nickname'],
			);
			if (empty($data['nickname'])) {
				die('<script>alert("请填写您的昵称！");location.reload();</script>');
			}
			if (!empty($_FILES['avatar']['tmp_name'])) {
				/**** 0.6 ****/
				load()->func('file');
				$upload = file_upload($_FILES['avatar']);
				if (is_error($upload)) {
					die('<script>alert("登记失败！请重试！");location.reload();</script>');
				}
				$data['avatar'] = $upload['path'];
			} else {
				$data['avatar'] = $_GPC['avatar'];
			}
			if (empty($data['avatar'])) {
				$data['avatar'] = 'images/global/noavatar_middle.gif';
			}
			mc_update($_W['member']['uid'], $data);
			die('<script type="text/javascript">alert("登记成功，系统会自动跳转，如果未成功请手动退回微信界面。");require(["WeixinApi"], function(WeixinApi){WeixinApi.ready(function(Api){setTimeout(function(){Api.closeWindow();}, 2000)});});</script>');
		}

		/**** 0.6 ****/
		$member = mc_fetch($_W['member']['uid'], array('nickname', 'avatar'));
		if (empty($member['avatar'])) {
			//mc_oauth_userinfo();
			$member['avatar'] = 'images/global/noavatar_middle.gif';
			include $this->template('register');
		} else {
			message('个人信息已经自动获取到，系统会自动跳转，如果未成功请手动退回微信界面。<script type="text/javascript">require(["WeixinApi"], function(WeixinApi){WeixinApi.ready(function(Api){setTimeout(function(){Api.closeWindow();}, 2000)});});</script>', '', 'success');
		}
	}
}
