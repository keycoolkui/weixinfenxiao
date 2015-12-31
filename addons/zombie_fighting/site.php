<?php
/**
 */
defined('IN_IA') or exit ('Access Denied');
class Zombie_fightingModuleSite extends WeModuleSite
{
    public $tablename = 'fighting_setting';

    //
    public function doMobileIndex()  {
        global $_GPC, $_W;
        //   $this->doCheckedMobile();
        // $this->doCheckedParam();
        $id = intval($_GPC['id']);
        $weid = $_W['uniacid'];
        $flight_setting = pdo_fetch("SELECT * FROM " . tablename('fighting_setting') . " WHERE rid = '$id' LIMIT 1");
        if (empty($flight_setting)) {
            message('非法访问，请重新发送消息进入一战到底页面！');
        }
        $uid = $_W['member']['uid'];
        $fromuser = $_W['fans']['from_user'];
        $openid = $_GPC['openid'];
        $member = fans_search($openid);
        if (empty($member)) {
            message('非法访问，请先关注！');
        }
        //$this->CheckCookie();
        $user = fans_search($openid, array('nickname', 'mobile'));
        if (empty($user['nickname']) || empty($user['mobile'])) { //注册
           // $depts = pdo_fetchall("SELECT * FROM " . tablename('fighting_dept') . " WHERE weid = '$weid' LIMIT 1");
            $userinfo = 0;
        }

        include $this->template('start');
    }

    //注册
    public function doMobileMregister()  {
        global $_GPC, $_W;
        $fid = intval($_GPC['fid']);
        $flight_setting = pdo_fetch("SELECT * FROM " . tablename('fighting_setting') . " WHERE rid = '$fid' LIMIT 1");
        if (empty($flight_setting)) {
            message('非法访问，请重新发送消息进入页面！');
        }
        $fromuser = $_W['fans']['from_user'];
        if (empty($fromuser)) {
            $fromuser = $_GPC['openid'];
        }

        $data = array(
            'nickname' => $_GPC['nickname'],
            'mobile' => $_GPC['mobile'],
             
        );

        if (empty($data['nickname'])) {
            return $this->fightJson(-1, '请填写您的昵称！');
            exit;
        }
        if (empty($data['mobile'])) {
            return $this->fightJson(-1, '请填写您的手机号码！');
            exit;
        }
        /*if (empty($data['deptid'])||$data['deptid']<=0) {
            return $this->fightJson(-1, '请填写您的手机号码！');
            exit;
        }*/
        fans_update($fromuser, array('nickname' => $_GPC['nickname'], 'mobile' => $_GPC['mobile']));
        $insert1 = array(
            'weid' => $_W['uniacid'],
            'fid' => $fid,
            'openid' => $fromuser,
            'nickname' =>$_GPC['nickname'],
            'mobile' => $_GPC['mobile'],
        );
        $add = pdo_insert('fighting_user', $insert1);

        return $this->fightJson(1, '');
        exit;
    }


    private function CheckCookie(){
        global $_W, $_GPC;
        $weid = $_W['uniacid'];
        $cfg = $this->module['config'];
        $oauth_openid = "zombieszy_fighting_1" . $weid;
        if (empty($_COOKIE[$oauth_openid])) {
            if (!empty($cfg) && $cfg['isoauth'] == 0) { // 判断是否是借用设置
                $appid = $cfg['appid'];
                $secret = $cfg['secret'];
            }
            $url = $_W['siteroot'] . "app/" . substr($this->createMobileUrl('userinfo', array(), true), 2);
            $oauth2_code = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $appid . "&redirect_uri=" . urlencode($url) . "&response_type=code&scope=snsapi_userinfo&state=0#wechat_redirect";
            header("location:$oauth2_code");
            exit;
        }
    }


    public function doMobileUserinfo() {
        global $_GPC, $_W;
        $weid = $_W['uniacid']; //当前公众号ID
        load()->func('communication');
        //用户不授权返回提示说明
        if ($_GPC['code'] == "authdeny") {
            $url = $this->createMobileUrl('index', array(), true);
            $url2 = $_W['siteroot'] . "app/" . substr($url, 2);
            header("location:$url2");
            exit('authdeny');
        }
        //高级接口取未关注用户Openid
        if (isset($_GPC['code'])) {
            //第二步：获得到了OpenID
            $serverapp = $_W['account']['level'];
            $cfg = $this->module['config'];
            if (!empty($cfg) && $cfg['isoauth'] == 0) { // 判断是否是借用设置
                $appid = $cfg['appid'];
                $secret = $cfg['secret'];
            }
            $state = $_GPC['state'];
            //1为关注用户, 0为未关注用户
            $rid = $_GPC['id'];
            //查询活动时间
            $code = $_GPC['code'];
            $oauth2_code = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=" . $appid . "&secret=" . $secret . "&code=" . $code . "&grant_type=authorization_code";
            $content = ihttp_get($oauth2_code);
            $token = @ json_decode($content['content'], true);
            if (empty($token) || !is_array($token)
                || empty($token['access_token']) || empty($token['openid'])
            ) {
                echo '<h1>获取微信公众号授权' . $code . '失败[无法取得token以及openid], 请稍后重试！ 公众平台返回原始数据为: <br />' . $content['meta'] . '<h1>';
                exit;
            }
            $from_user = $token['openid'];
            //未关注用户和关注用户取全局access_token值的方式不一样
            if ($state == 1) {
                $oauth2_url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . $appid . "&secret=" . $secret . "";
                $content = ihttp_get($oauth2_url);
                $token_all = @ json_decode($content['content'], true);
                if (empty($token_all) || !is_array($token_all) || empty($token_all['access_token'])) {
                    echo '<h1>获取微信公众号授权失败[无法取得access_token], 请稍后重试！ 公众平台返回原始数据为: <br />' . $content['meta'] . '<h1>';
                    exit;
                }
                $access_token = $token_all['access_token'];
                $oauth2_url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=" . $access_token . "&openid=" . $from_user . "&lang=zh_CN";
            } else {
                $access_token = $token['access_token'];
                $oauth2_url = "https://api.weixin.qq.com/sns/userinfo?access_token=" . $access_token . "&openid=" . $from_user . "&lang=zh_CN";
            }

            //使用全局ACCESS_TOKEN获取OpenID的详细信息
            $content = ihttp_get($oauth2_url);
            $info = @ json_decode($content['content'], true);
            if (empty($info) || !is_array($info) || empty($info['openid']) || empty($info['nickname'])) {
                echo '<h1>获取微信公众号授权失败[无法取得info], 请稍后重试！<h1>';
                exit;
            }

            $row = array('nickname' => $info["nickname"], 'realname' => $info["nickname"], 'gender' => $info['sex']);
            if (!empty($info["country"])) {
                $row['nationality'] = $info["country"];
            }
            if (!empty($info["province"])) {
                $row['resideprovince'] = $info["province"];
            }
            if (!empty($info["city"])) {
                $row['residecity'] = $info["city"];
            }
            if (!empty($info["headimgurl"])) {
                $row['avatar'] = $info["headimgurl"];
            }
            fans_update($info['openid'], $row);
            $oauth_openid = "zombieszy_fighting_1" . $_W['uniacid'];
            setcookie($oauth_openid, $info['openid'], time() + 3600 * 240);
            $url = $_W['siteroot'] . "app/" . substr($this->createMobileUrl('url', array()), 2);
            header("location:$url");
            exit;
        } else {
            echo '<h1>网页授权域名设置出错!</h1>';
            exit;
        }
    }

    //开始答题
    public function doMobileStart()
    {
        global $_GPC, $_W;
        //  $this->doCheckedMobile();
        // $this->doCheckedParam();
        $weid = $_W['uniacid'];
        $year = ((int)date('Y', time())); //取得年份
        $month = ((int)date('m', time())); //取得月份
        $day = ((int)date('d', time())); //取得几号
        $start = ((int)mktime(0, 0, 0, $month, $day, $year));
        $id = intval($_GPC['id']);
        $flight_setting = pdo_fetch("SELECT * FROM " . tablename('fighting_setting') . " WHERE rid = '$id' LIMIT 1");
        if (empty($flight_setting)) {
            message('非法访问，请重新发送消息进入一战到底页面！');
        }
        $fromuser = $_GPC['openid'];
        $member = fans_search($fromuser);
        if (empty($member)) {
            $shareurl = $flight_setting['shareurl']; //分享URL
            header("location:$shareurl");
        }
        $user = fans_search($fromuser, array('nickname', 'mobile'));
        if (empty($user['nickname']) || empty($user['mobile'])) {
            $userinfo = 0; //注册
            include $this->template('start');
            exit;
        }
        $fighting = pdo_fetch("SELECT * FROM " . tablename('fighting') . " WHERE `from_user`=:from_user AND `fid`=" . $flight_setting['id'] . " ORDER BY id DESC LIMIT 1", array(':from_user' => $fromuser));
        $answerNum  = intval($fighting['answerNum']) >0 ? intval($fighting['answerNum']):0;

        $sql_question = "SELECT *  FROM `ims_fighting_question_bank` AS t1 JOIN (SELECT ROUND(RAND() * ((SELECT MAX(id) FROM `ims_fighting_question_bank`)-(SELECT MIN(id) FROM `ims_fighting_question_bank`))+(SELECT MIN(id) FROM `ims_fighting_question_bank`)) AS id) AS t2 WHERE t1.id >= t2.id and weid='$weid'  ORDER BY t1.id LIMIT 0,1 ";
        $question = pdo_fetch($sql_question);

        $an_arr = $question['answer'];//正确答案
        //是否已经答题
        $ds = pdo_fetchall("SELECT B.nickname,B.from_user, B.lastcredit , ( SELECT COUNT( 1 ) +1 FROM " . tablename('fighting') . " A WHERE A.lastcredit > B.lastcredit )PM FROM" . tablename('fighting') . " B  WHERE  B.fid ='$flight_setting[id]'  ORDER BY PM ,B.nickname,B.from_user LIMIT 10");
        $sql_fighting = "SELECT  B.lastcredit , ( SELECT COUNT( 1 ) +1 FROM `ims_fighting` A WHERE A.lastcredit > B.lastcredit )PM FROM `ims_fighting` B WHERE  B.fid ='$flight_setting[id]'  AND B.from_user='{$fromuser}' ORDER BY PM ,B.lastcredit ";
        $theone = pdo_fetch($sql_fighting);
        $total = pdo_fetchcolumn('SELECT count(id) as total FROM ' . tablename('fighting') . ' WHERE fid= :fid group by `fid` desc ', array(':fid' => $flight_setting['id']));

        if ($theone['PM'] == 1 && $total == 1) {
            $percent = round((($theone['PM']) / $total) * 100, 2);
        } else {
            $percent = round((($total - $theone['PM']) / $total) * 100, 2);
        }

        if ((time() > $flight_setting['end']) || ($flight_setting['status'] == 2)) { //活动已结束时回复语
            include $this->template('ranking');
            exit;
        }
        if ($fighting['answerNum'] == $flight_setting['qnum']) {
            if ($flight_setting['is_shared'] == '1') { //是否开启分享 如果已经分享了 则直接到 排名页面
                include $this->template('shareing');
                exit;
            } else { //0 不需要直接到 排名
                include $this->template('ranking');
                exit;
            }
        }

        if ($fighting['lasttime'] >= $start) {
            if ($flight_setting['is_shared'] == '1') { //是否开启分享 如果已经分享了 则直接到 排名页面
                include $this->template('shareing');
                exit;
            } else { //0 不需要直接到 排名
                include $this->template('ranking');
                exit;
            }
        }
        include $this->template('exam');
        exit;
    }

    //获取
    public function doMobileGetAnswer(){
        global $_GPC, $_W;
        $fid = intval($_GPC['fid']);

        $flight_setting = pdo_fetch("SELECT * FROM " . tablename('fighting_setting') . " WHERE id = '$fid' LIMIT 1");
        if (empty($flight_setting)) {
            message('非法访问，请重新发送消息进入一战到底页面！');
        }

        load()->model('mc');
        load()->func('compat.biz');
        $fromuser = $_GPC['openid'];
        $uid = mc_openid2uid($fromuser);
        //  $fromuser = $_W['fans']['from_user'];
        $member = fans_search($fromuser);
        if (empty($member)) {
            $shareurl = $flight_setting['shareurl']; //分享URL
            header("location:$shareurl");
        }
        $fans = fans_search($uid, array("credit1"));
        if (!empty($fans)) {
            $credit = $fans['credit1'];
        }
        $qid = intval($_GPC['qestionid']);
        $answer = $_GPC['answer'];
        $sql = "SELECT * FROM " . tablename('fighting') . " WHERE `from_user`=:from_user AND `fid`=:fid ORDER BY id DESC LIMIT 1";
        $sql_fighting = pdo_fetch($sql, array(':from_user' => $fromuser, ':fid' => $fid));
        $question = pdo_fetch("SELECT * FROM " . tablename('fighting_question_bank')." WHERE id = '$qid' LIMIT 1");
        $answerNum =intval($_GPC['answerNum'])>0 ? intval($_GPC['answerNum']):1;
        $isupdate = pdo_fetch("SELECT * FROM ".tablename('fighting')." WHERE fid = ".$fid." and from_user='".$fromuser."'");

        if ($answer == $question[answer]) { //正确答案
            $figure = $question['figure'];
            //不存在false的情况，如果是false，则表明是非法
            if ($isupdate == false) {
                $insert1 = array(
                    'weid' => $_W['uniacid'],
                    'fid' => $fid,
                    'answerNum' => $answerNum,
                    'from_user' => $fromuser,
                    'nickname' => $member['nickname'],
                    'lastcredit' => $figure,
                );
                if ($answerNum+1==$flight_setting['qnum']) {
                    $updateData = array(
                        'lasttime' => time(),
                        'answerNum' => 0,
                    );
                    pdo_update('fighting', $updateData, array('id' => $flightid));
                    return $this->fightJson(3, '');
                    exit;
                }else{
                    $add = pdo_insert('fighting', $insert1);
                    return $this->fightJson(1, '');
                    exit;
                }
            } else {
                if ($isupdate['answerNum']+1==$flight_setting['qnum']) {
                    $updateData = array(
                        'lasttime' => time(),
                        'lastcredit' => $isupdate['lastcredit'] + $figure,
                        'answerNum' => 0,
                    );
                    pdo_update('fighting', $updateData, array('id' => $isupdate['id']));
                    return $this->fightJson(3,$answerNum);
                    exit;
                } else{
                    $updateData = array(
                        'answerNum' => $isupdate['answerNum'] + 1,
                        'lastcredit' => $isupdate['lastcredit'] + $figure,
                    );
                    pdo_update('fighting', $updateData, array('id' => $isupdate['id']));
                    return $this->fightJson(1,$answerNum);
                    exit;
                }
            }
            pdo_update('mc_members', array("credit1" => $credit + $figure), array('uid' => $uid));
            return $this->fightJson(1, '');
            exit;
        } else {
            if ($isupdate == false) {
                $insert1 = array(
                    'weid' => $_W['uniacid'],
                    'fid' => $fid,
                    'answerNum' => $answerNum,
                    'from_user' => $fromuser,
                    'nickname' => $member['nickname'],
                    'lastcredit' => 0,
                );
                $addworng = pdo_insert('fighting', $insert1);
                $flightid = pdo_insertid();

                if ($answerNum+1 == $flight_setting['qnum']) {
                    $updateData = array(
                        'lasttime' => time(),
                        'answerNum' => 0,
                    );
                    pdo_update('fighting', $updateData, array('id' => $flightid));
                    return $this->fightJson(2, $question[answer]);
                    exit;
                }else{
                    return $this->fightJson(2, $question[answer]);
                    exit;
                }
            } else {
                if ($isupdate['answerNum'] +1 == $flight_setting['qnum']) {
                    $updateData2 = array(
                        'lasttime' => time(),
                        'answerNum' => 0,
                    );
                    pdo_update('fighting', $updateData2, array('id'=>$isupdate['id']));
                    return $this->fightJson(3, '答题满了');
                    exit;
                }else{
                    $updateData = array('answerNum' => $isupdate['answerNum']+1);
                    pdo_update('fighting', $updateData, array('id'=>$isupdate['id']));
                    return $this->fightJson(2, $question[answer]);
                    exit;
                }
            }
            //错误答案 回看答错的题目 $answer fighting_question_worng
            $insertworng = array(
                'weid' => $_W['uniacid'],
                'fightingid' => $isupdate['id'],
                'wornganswer' => $answer ? $answer : '超时没选择答案',
                'qname' => $question['question'],
                'answer' => $question['answer'],
                'optionA' => $question['optionA'],
                'optionB' => $question['optionB'],
                'optionC' => $question['optionC'],
                'optionD' => $question['optionD'],
                'optionE' => $question['optionE'],
                'optionF' => $question['optionF'],
            );
            pdo_insert('fighting_question_worng', $insertworng);
            return $this->fightJson(2, '答案错误');
            exit;
        }
    }


    //排行页面
    public function doMobileRank(){
        global $_GPC, $_W;
        $id = intval($_GPC['id']);
        $year = ((int)date('Y', time())); //取得年份
        $month = ((int)date('m', time())); //取得月份
        $day = ((int)date('d', time())); //取得几号

        $start = ((int)mktime(0, 0, 0, $month, $day, $year));

        $flight_setting = pdo_fetch("SELECT * FROM " . tablename('fighting_setting') . " WHERE id = '$id' LIMIT 1");
        if (empty($flight_setting)) {
            message('非法访问，请重新发送消息进入一战到底页面！');
        }

        $fromuser = $_W['fans']['from_user'];
        $member = fans_search($fromuser);
        if (empty($member)) {
            $shareurl = $flight_setting['shareurl']; //分享URL
            header("location:$shareurl");
        }

        $fighting = pdo_fetch("SELECT * FROM " . tablename('fighting') . " WHERE `from_user`=:from_user AND `fid`=" . $flight_setting['id'] . " ORDER BY id DESC LIMIT 1", array(':from_user' => $fromuser));

        $ds = pdo_fetchall("SELECT B.nickname,B.from_user, B.lastcredit , ( SELECT COUNT( 1 ) +1 FROM " . tablename('fighting') . " A WHERE A.lastcredit > B.lastcredit )PM FROM" . tablename('fighting') . " B  WHERE  B.fid ='$flight_setting[id]'  ORDER BY PM ,B.nickname,B.from_user LIMIT 10");

        $sql_fighting = "SELECT  B.lastcredit , ( SELECT COUNT( 1 ) +1 FROM `ims_fighting` A WHERE A.lastcredit > B.lastcredit )PM FROM `ims_fighting` B WHERE  B.fid ='$flight_setting[id]'  AND B.from_user='{$fromuser}' ORDER BY PM ,B.lastcredit ";
        $theone = pdo_fetch($sql_fighting);

        $total = pdo_fetchcolumn('SELECT count(id) as total FROM ' . tablename('fighting') . ' WHERE fid= :fid group by `fid` desc ', array(':fid' => $flight_setting['id']));
        if ($theone['PM'] == 1 && $total == 1) {
            $percent = round((($theone['PM']) / $total) * 100, 2);
        } else {
            $percent = round((($total - $theone['PM']) / $total) * 100, 2);
        }

        if ((time() > $flight_setting['end']) || ($flight_setting['status'] == 2)) { //活动已结束时回复语
            include $this->template('ranking');
            exit;
        }

        if ($fighting['answerNum'] == $flight_setting['qnum']) {
            if ($flight_setting['is_shared'] == '1') { //是否开启分享 如果已经分享了 则直接到 排名页面
                include $this->template('shareing');
                exit;
            } else { //0 不需要直接到 排名
                include $this->template('ranking');
                exit;
            }
        }

        if ($fighting['lasttime'] >= $start) {
            if ($flight_setting['is_shared'] == '1') { //是否开启分享 如果已经分享了 则直接到 排名页面
                include $this->template('shareing');
                exit;
            } else { //0 不需要直接到 排名
                include $this->template('ranking');
                exit;
            }
        }
    }

    //错误答题
    public function doMobileWorng() {
        global $_GPC, $_W;
        $id = intval($_GPC['id']);
        $flight_setting = pdo_fetch("SELECT * FROM " . tablename('fighting_setting') . " WHERE rid = '$id' LIMIT 1");
        if (empty($flight_setting)) {
            message('非法访问，请重新发送消息进入一战到底页面！');
        }

        $fromuser = $_W['fans']['from_user'];
        $member = fans_search($fromuser);
        if (empty($member)) {
            $shareurl = $flight_setting['shareurl']; //分享URL
            header("location:$shareurl");
        }

        $sql = "SELECT  * FROM " . tablename('fighting_question_worng') . " AS a LEFT JOIN " . tablename('fighting') . " AS b ON b.id = a.fightingid ";
        $list = pdo_fetchAll($sql);
        include $this->template('worng');
        exit;
    }


    public function fightJson($resultCode, $resultMsg) {
        $jsonArray = array(
            'resultCode' => $resultCode,
            'resultMsg' => $resultMsg
        );
        $jsonStr = json_encode($jsonArray);
        return $jsonStr;
    }

    public function doCheckedMobile() {
        global $_GPC, $_W;
        $servername = $_SERVER['SERVER_NAME'];
        $useragent = addslashes($_SERVER['HTTP_USER_AGENT']);
        if (strpos($useragent, 'MicroMessenger') === false && strpos($useragent, 'Windows Phone') === false) {
            message('非法访问，请通过微信打开！');
        }
    }


    public function doCheckedParam()
    {
        global $_GPC, $_W;
        if (empty($_GPC['id'])) {
            message('非法访问，请重新发送消息进入页面！');
        }
    }


    //题库管理
    public function doWebQuestions()
    {
        global $_GPC, $_W;
        //checklogin();
        $op = $_GPC['op'] ? $_GPC['op'] : 'display';
        $weid = $_W['uniacid'];
        if ($op == 'display') {
            $pindex = max(1, intval($_GPC['page']));
            $psize = 15;
            $condition = "WHERE `weid` =$weid ";
            if (!empty($_GPC['keyword'])) {
                $condition .= " AND question LIKE '%" . $_GPC['keyword'] . "%'";
            }
            $list = pdo_fetchall('SELECT * FROM ' . tablename('fighting_question_bank') . " $condition ORDER BY id DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize); //分页
            $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fighting_question_bank') . $condition, array());

            $pager = pagination($total, $pindex, $psize);
        } elseif ($op == 'post') {
            $id = intval($_GPC['id']);
            if ($id > 0) {
                $item = pdo_fetch('SELECT * FROM ' . tablename('fighting_question_bank') . " WHERE weid=:weid AND id=:id", array(':weid' => $weid, ':id' => $id));
            }
            if (checksubmit('submit')) {
                $answer = strtoupper($_GPC['answer']);
                $insert = array(
                    'figure' => $_GPC['figure'],
                    'question' => $_GPC['question'],
                    'option_num' => 1,
                    'optionA' => $_GPC['optionA'],
                    'optionB' => $_GPC['optionB'],
                    'optionC' => $_GPC['optionC'],
                    'optionD' => $_GPC['optionD'],
                    'optionE' => $_GPC['optionE'],
                    'optionF' => $_GPC['optionF'],
                    'weid' => $weid,
                    'answer' => $answer,
                );

                if (empty($id)) {
                    pdo_insert('fighting_question_bank', $insert);
                } else {
                    if (pdo_update('fighting_question_bank', $insert, array('id' => $id)) === false) {
                        message('更新题目数据失败, 请稍后重试.', 'error');
                    }
                }
                message('更新题目数据成功！', $this->createWebUrl('questions', array('op' => 'display', 'name' => 'zombie_fighting')), 'success');
            }
        } elseif ($op == 'del') {
            //删除
            if (isset($_GPC['delete'])) {
                $ids = implode(",", $_GPC['delete']);
                $sqls = "delete from  " . tablename('fighting_question_bank') . "  where id in(" . $ids . ")";
                pdo_query($sqls);
                message('删除成功！', referer(), 'success');
            }
            $id = intval($_GPC['id']);
            $temp = pdo_delete("fighting_question_bank", array("weid" => $weid, 'id' => $id));
            if ($temp == false) {
                message('抱歉，删除数据失败！', '', 'error');
            } else {
                message('删除题目数据成功！', $this->createWebUrl('questions', array('op' => 'display', 'name' => 'zombie_fighting')), 'success');
            }
        } elseif ($op == 'list') { //活动列表
            $id = intval($_GPC['id']);
            if (checksubmit('delete') && !empty ($_GPC['select'])) {
                pdo_delete('fighting_setting', " id  IN  ('" . implode("','", $_GPC['select']) . "')");
                message('删除题目数据成功！', $this->createWebUrl('questions', array('op' => 'deleteSet', 'name' => 'zombie_fighting')), 'success');
            }

            $pindex = max(1, intval($_GPC['page']));
            $psize = 20;
            $list = pdo_fetchall("SELECT * FROM " . tablename('fighting_setting') . " WHERE weid = '{$_W['uniacid']}' ORDER BY id ASC LIMIT " . ($pindex - 1) * $psize . ",{$psize}");
            if (!empty ($list)) {
                $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fighting_setting') . " WHERE weid = '{$_W['uniacid']}' ");
                $pager = pagination($total, $pindex, $psize);
            }

        } elseif ($op == 'rankList') { //排名
            $rid = intval($_GPC['rid']);
            if (checksubmit('delete') && !empty ($_GPC['deletes'])) {
                pdo_delete('fighting', " id  IN  ('" . implode("','", $_GPC['deletes']) . "')");
                message('删除排名成功！', $this->createWebUrl('questions', array('op' => 'rankList', 'name' => 'zombie_fighting')), 'success');
            }
            $pindex = max(1, intval($_GPC['page']));
            $psize = 20;

            $sql= "SELECT a.id,a.fid,b.nickname,a.lasttime,a.lastcredit FROM ".tablename('fighting')." AS a LEFT JOIN ".tablename('fighting_user')." AS b ON a.from_user = b.openid WHERE a.fid = '$rid' ORDER BY a.id DESC LIMIT ".($pindex -1) * $psize.",{$psize}";
            $list= pdo_fetchall($sql);
            $series = pdo_fetchall("SELECT * FROM " . tablename('fighting_setting')." WHERE `id` = :id ", array(':id' => $rid));
            $seriesArr = array();
            foreach ($series as $v) {
                $seriesArr[$v['id']] = $v['title'];
            }

            if (!empty ($list)) {
                $total=pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename('fighting')." AS a LEFT JOIN ".tablename('fighting_user')." AS b ON a.from_user = b.openid WHERE a.fid = '$rid' ");
                $pager=pagination($total, $pindex, $psize);
            }
            $fs = array();
            foreach ($list as &$item) {
                $levelname = pdo_fetchcolumn("SELECT levelname FROM " . tablename('fighting_level') . " WHERE `weid` = :weid and :totalscore>=min and :totalscore<=max ORDER BY `min` limit 1", array(':weid' => $weid,':totalscore'=>$item['lastcredit']));
                /*$deptname= pdo_fetchcolumn('SELECT deptName FROM '.tablename('fighting_dept')." WHERE weid=:weid AND id=:id ORDER BY deptName DESC", array(':weid' => $weid, ':id' => $item['deptid']));*/
               // $item['$deptname'] =$deptname;
                $item['levelname'] =$levelname;
                $fs[] = $item;
            }
            unset($item);

        } elseif ($op == 'postRank') {
            $id = intval($_GPC['id']);
            $fid = intval($_GPC['fid']);
            if ($id > 0) {
                $rank = pdo_fetch('SELECT a.id,b.nickname,a.lastcredit,b.id as uid FROM ' . tablename('fighting') . "AS a
							LEFT JOIN ".tablename('fighting_user')." AS b ON a.from_user = b.openid WHERE a.weid=:weid AND a.id=:id", array(':weid' => $weid, ':id' => $id));
            }
            if (checksubmit('submit')) {
                $update = array(
                    'nickname' => $_GPC['nickname'],
                    'lastcredit' => $_GPC['lastcredit'],
                );
                pdo_update('fighting', $update, array('id' => $id));
                pdo_update('fighting_user', array('nickname'=> $_GPC['nickname']), array('id' => $_GPC['uid']));

                message('修改成功！', $this->createWebUrl('questions', array('op' => 'rankList', 'rid' => $fid, 'name' => 'zombie_fighting')), 'success');
            }
        } elseif ($op == 'delRank') { //删除排名信息
            //删除
            if (isset($_GPC['delete'])) {
                $ids = implode(",", $_GPC['delete']);
                $sqls = "delete from  " . tablename('fighting') . "  where id in(" . $ids . ")";
                pdo_query($sqls);
                message('删除成功！', referer(), 'success');
            }
            $id = intval($_GPC['rid']);
            $temp = pdo_delete("fighting", array("weid" => $weid, 'id' => $id));
            if ($temp == false) {
                message('抱歉，删除数据失败！', '', 'error');
            } else {
                message('删除数据成功！', $this->createWebUrl('questions', array('op' => 'rankList', 'name' => 'zombie_fighting')), 'success');
            }
        }

        include $this->template('question_list');
    }


    //部门管理
    public function doWebDepts() {
        global $_GPC, $_W;
        //checklogin();
        $op = $_GPC['op'] ? $_GPC['op'] : 'display';
        $weid = $_W['uniacid'];
        if ($op == 'display') { //活动列表
            $pindex = max(1, intval($_GPC['page']));
            $psize = 15;
            $condition = "WHERE `weid` =$weid ";
            if (!empty($_GPC['keyword'])) {
                $condition .= " AND deptName LIKE '%" . $_GPC['keyword'] . "%'";
            }
            $list = pdo_fetchall('SELECT * FROM ' . tablename('fighting_dept') . " $condition ORDER BY id DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize); //分页
            $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fighting_dept') . $condition, array());

            $pager = pagination($total, $pindex, $psize);

        }elseif ($op == 'post') {
            $id = intval($_GPC['id']);
            if ($id > 0) {
                $item = pdo_fetch('SELECT * FROM ' . tablename('fighting_dept') . " WHERE weid=:weid AND id=:id", array(':weid' => $weid, ':id' => $id));
            }
            if (checksubmit('submit')) {
                $insert = array(
                    'deptName' => $_GPC['deptName'],
                    'weid' => $weid,
                    'createtime'=>TIMESTAMP,
                );

                if (empty($id)) {
                    pdo_insert('fighting_dept', $insert);
                    !pdo_insertid() ? message('保存题目数据失败, 请稍后重试.', 'error') : '';
                } else {
                    if (pdo_update('fighting_dept', $insert, array('id' => $id)) === false) {
                        message('更新题目数据失败, 请稍后重试.', 'error');
                    }
                }
                message('更新部门数据成功！', $this->createWebUrl('depts', array('op' => 'display', 'name' => 'zombie_fighting')), 'success');
            }
        } elseif ($op == 'del') {
            //删除
            if (isset($_GPC['delete'])) {
                $ids = implode(",", $_GPC['delete']);
                $sqls = "delete from  " . tablename('fighting_dept') . "  where id in(" . $ids . ")";
                pdo_query($sqls);
                message('删除成功！', referer(), 'success');
            }
            $id = intval($_GPC['id']);
            $temp = pdo_delete("fighting_dept", array("weid" => $weid, 'id' => $id));
            if ($temp == false) {
                message('抱歉，删除数据失败！', '', 'error');
            } else {
                message('删除题目数据成功！', $this->createWebUrl('depts', array('op' => 'display', 'name' => 'zombie_fighting')), 'success');
            }
        }
        include $this->template('dept_list');
    }


    //题库管理
    public function doWebLists()
    {
        global $_GPC, $_W;
        //checklogin();
        $op = $_GPC['op'] ? $_GPC['op'] : 'list';
        $weid = $_W['uniacid'];
        if ($op == 'list') { //活动列表
            $id = intval($_GPC['id']);
            if (checksubmit('delete') && !empty ($_GPC['select'])) {
                pdo_delete('fighting_setting', " id  IN  ('" . implode("','", $_GPC['select']) . "')");
                message('删除题目数据成功！', $this->createWebUrl('questions', array('op' => 'deleteSet', 'name' => 'zombie_fighting')), 'success');
            }

            $pindex = max(1, intval($_GPC['page']));
            $psize = 20;
            $list = pdo_fetchall("SELECT * FROM " . tablename('fighting_setting') . " WHERE weid = '{$_W['uniacid']}' ORDER BY id ASC LIMIT " . ($pindex - 1) * $psize . ",{$psize}");
            if (!empty ($list)) {
                $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fighting_setting') . " WHERE weid = '{$_W['uniacid']}' ");
                $pager = pagination($total, $pindex, $psize);
            }

        }
        include $this->template('question_list');
    }



    //等级管理
    public function doWebLevel() {
        global $_GPC, $_W;
        //checklogin();
        $op = $_GPC['op'] ? $_GPC['op'] : 'display';
        $weid = $_W['uniacid'];
        if ($op == 'display') { //活动列表
            $pindex = max(1, intval($_GPC['page']));
            $psize = 15;
            $condition = "WHERE `weid` =$weid ";
            if (!empty($_GPC['keyword'])) {
                $condition .= " AND levelname LIKE '%" . $_GPC['keyword'] . "%'";
            }
            $list = pdo_fetchall('SELECT * FROM ' . tablename('fighting_level') . " $condition ORDER BY id DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize); //分页
            $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fighting_level') . $condition, array());

            $pager = pagination($total, $pindex, $psize);

        }elseif ($op == 'post') {
            $id = intval($_GPC['id']);
            if ($id > 0) {
                $item = pdo_fetch('SELECT * FROM ' . tablename('fighting_level') . " WHERE weid=:weid AND id=:id", array(':weid' => $weid, ':id' => $id));
            }
            $url=$this->createWebUrl('level', array('op' => 'post', 'name' => 'zombie_fighting')) ;
            if (checksubmit('submit')) {
                $levelname =  $_GPC['levelname'];
                $min = intval($_GPC['min']);
                $max = intval($_GPC['max']);
                if($max <= $min){
                    message($levelname.'积分范围有误，请重新输入.', $url, 'error');
                }
                if($max < 0 || $min < 0){
                    message('积分不允许负数，请重新输入.', $url, 'error');
                }
                $insert = array(
                    'levelname' => $_GPC['levelname'],
                    'weid' => $weid,
                    'min'=>$_GPC['min'],
                    'max'=>$_GPC['max'],
                    'dateline'=>TIMESTAMP,
                );

                if (empty($id)) {
                    pdo_insert('fighting_level', $insert);
                } else {
                    if (pdo_update('fighting_level', $insert, array('id' => $id)) === false) {
                        message('更新等级数据失败, 请稍后重试.', 'error');
                    }
                }
                message('更新等级数据成功！', $this->createWebUrl('level', array('op' => 'display', 'name' => 'zombie_fighting')) , 'success');
            }
        } elseif ($op == 'del') {
            //删除
            if (isset($_GPC['delete'])) {
                $ids = implode(",", $_GPC['delete']);
                $sqls = "delete from  " . tablename('fighting_level') . "  where id in(" . $ids . ")";
                pdo_query($sqls);
                message('删除成功！', referer(), 'success');
            }
            $id = intval($_GPC['id']);
            $temp = pdo_delete("fighting_level", array("weid" => $weid, 'id' => $id));
            if ($temp == false) {
                message('抱歉，删除数据失败！', '', 'error');
            } else {
                message('删除题目数据成功！', $this->createWebUrl('level', array('op' => 'display', 'name' => 'zombie_fighting')), 'success');
            }
        }
        include $this->template('level_list');
    }


    //错误题目
    public function doWebWorngquestion()
    {
        global $_GPC, $_W;
        if (checksubmit('delete') && !empty ($_GPC['select'])) {
            $fid = intval($_GPC['fid']);
            pdo_delete('fighting_question_worng', " id  IN  ('" . implode("','", $_GPC['select']) . "')");
            message('删除数据成功！', $this->createWebUrl('Worngquestion', array('name' => 'zombie_fighting', 'id' => $fid)), 'success');
        }
        $pindex = max(1, intval($_GPC['page']));
        $fightingid = $_GPC['id'];
        $psize = 20;
        $list = pdo_fetchall("SELECT * FROM " . tablename('fighting_question_worng') . " WHERE weid = '{$_W['uniacid']}' and fightingid= '{$_GPC['id']}' ORDER BY id ASC LIMIT " . ($pindex - 1) * $psize . ",{$psize}");
        $fid = pdo_fetchcolumn("SELECT fid FROM " . tablename('fighting') . " WHERE id = :id ORDER BY `id` DESC", array(
            ':id' => $fightingid));
        if (!empty ($list)) {
            $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fighting_question_worng') . " WHERE weid = '{$_W['uniacid']}' and fightingid= '{$_GPC['id']}' ");
            $pager = pagination($total, $pindex, $psize);
        }

        include $this->template('worngquestion');
    }

    public function doWebdelworngquestion()
    {
        global $_GPC, $_W;
        checklogin();
        $id = intval($_GPC['id']);
        $fid = intval($_GPC['fid']);
        pdo_delete('fighting_question_worng', " id=$id");
        message('删除数据成功！', $this->createWebUrl('Worngquestion', array('name' => 'zombie_fighting', 'id' => $fid)), 'success');
    }


}