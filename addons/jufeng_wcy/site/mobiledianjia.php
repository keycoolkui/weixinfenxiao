<?php
global $_GPC, $_W;
		require_once "jssdk.php";
$jssdk = new JSSDK($_W['account']['key'], $_W['account']['secret']);
$signPackage = $jssdk->GetSignPackage();
$jsapi_ticket = "sM4AOVdWfPE4DxkXGEs8VIr5IMvf0rzl49cmKpn1dP_JPLG3MbttyOU5ydYRKIfQiogdLbOgf6HbjAhwdiGyiQ&noncestr=fghssdtdgf&timestamp=1420774989&url=http://mp.weixin.qq.com?params=value";
$signature=sha1($jsapi_ticket);
		$pindex = max(1, intval($_GPC['page']));
		$psize = 15;
		$fansloc = pdo_fetch("SELECT * FROM ".tablename('jufeng_wcy_loc')." WHERE weid = '{$_W['uniacid']}' AND from_user = '{$_W['fans']['from_user']}'");
		if($_GPC['op'] == "locate"){
			if($fansloc['loc_x']){pdo_update('jufeng_wcy_loc', array('loc_x' => $_GPC['loc_x'], 'loc_y' => $_GPC['loc_y'], 'createtime' =>TIMESTAMP), array('from_user' => $_W['fans']['from_user'], 'weid' => $_W['uniacid']));}
			else{pdo_insert('jufeng_wcy_loc', array('loc_x' => $_GPC['loc_x'], 'loc_y' => $_GPC['loc_y'], 'createtime' =>TIMESTAMP,'from_user' => $_W['fans']['from_user'], 'weid' => $_W['uniacid']));}
			}
$typeid = intval($_GPC['typeid']);
		$shoptype = pdo_fetchall("SELECT * FROM ".tablename('jufeng_wcy_shoptype')." WHERE weid = '{$_W['uniacid']}' ");
		
		if(empty($typeid)){
if($_GPC['order'] == 0){
			$shop = pdo_fetchall("SELECT * FROM ".tablename('jufeng_wcy_category')." WHERE weid = '{$_W['uniacid']}' AND parentid = '0' ORDER BY displayorder DESC LIMIT ".($pindex - 1) * $psize.','.$psize);	
			}
			else if($_GPC['order'] == 1){
			$shop = pdo_fetchall("SELECT * FROM ".tablename('jufeng_wcy_category')." WHERE weid = '{$_W['uniacid']}' AND parentid = '0' ORDER BY total DESC LIMIT ".($pindex - 1) * $psize.','.$psize);	
			}
			else if($_GPC['order'] == 2){
			$shop = pdo_fetchall("SELECT * FROM ".tablename('jufeng_wcy_category')." WHERE weid = '{$_W['uniacid']}' AND parentid = '0' ORDER BY sendprice ASC LIMIT ".($pindex - 1) * $psize.','.$psize);	
			}
			else if($_GPC['order'] == 3){
			$shop = pdo_fetchall("SELECT * FROM ".tablename('jufeng_wcy_category')." WHERE weid = '{$_W['uniacid']}' AND parentid = '0' ORDER BY enabled DESC LIMIT ".($pindex - 1) * $psize.','.$psize);
			}		}
		else{
			if($_GPC['order'] == 0){
			$shop = pdo_fetchall("SELECT * FROM ".tablename('jufeng_wcy_category')." WHERE weid = '{$_W['uniacid']}' AND parentid = '0' AND typeid = '{$typeid}' ORDER BY displayorder DESC LIMIT ".($pindex - 1) * $psize.','.$psize);	
			}
			else if($_GPC['order'] == 1){
			$shop = pdo_fetchall("SELECT * FROM ".tablename('jufeng_wcy_category')." WHERE weid = '{$_W['uniacid']}' AND parentid = '0' AND typeid = '{$typeid}' ORDER BY total DESC LIMIT ".($pindex - 1) * $psize.','.$psize);	
			}
			else if($_GPC['order'] == 2){
			$shop = pdo_fetchall("SELECT * FROM ".tablename('jufeng_wcy_category')." WHERE weid = '{$_W['uniacid']}' AND parentid = '0' AND typeid = '{$typeid}' ORDER BY sendprice ASC LIMIT ".($pindex - 1) * $psize.','.$psize);
			}
			else if($_GPC['order'] == 3){
			$shop = pdo_fetchall("SELECT * FROM ".tablename('jufeng_wcy_category')." WHERE weid = '{$_W['uniacid']}' AND parentid = '0' AND typeid = '{$typeid}' ORDER BY enabled DESC LIMIT ".($pindex - 1) * $psize.','.$psize);
			}
			}
function rad($d)  
{  
       return $d * 3.1415926535898 / 180.0;  
}  
function GetDistance($lat1, $lng1, $lat2, $lng2)  
{  
    $EARTH_RADIUS = 6378.137;  
    $radLat1 = rad($lat1);  
    //echo $radLat1;  
   $radLat2 = rad($lat2);  
   $a = $radLat1 - $radLat2;  
   $b = rad($lng1) - rad($lng2);  
   $s = 2 * asin(sqrt(pow(sin($a/2),2) +  
    cos($radLat1)*cos($radLat2)*pow(sin($b/2),2)));  
   $s = $s *$EARTH_RADIUS;  
   $s = round($s * 10000) / 10000;  
   return $s;  
} 
foreach($shop as &$row){
	$dist = GetDistance($fansloc["loc_x"],$fansloc["loc_y"],$row['loc_x'],$row['loc_y']);
	if($dist >= 1){$dist1 = round($dist,1);$dist1 .= "千米";}
	else{$dist1 = round($dist*1000,-1);$dist1 .= "米";}
	$row['dist'] = $dist1;
	}
			if($typeid){
			$total = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename('jufeng_wcy_category')." WHERE weid = '{$_W['uniacid']}' AND parentid = '0' AND typeid = '{$typeid}' ORDER BY displayorder DESC");
			}
			else{
				$total = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename('jufeng_wcy_category')." WHERE weid = '{$_W['uniacid']}' AND parentid = '0' ORDER BY displayorder DESC");
				}
		$pager = pagination($total, $pindex, $psize, $url = '', $context = array('before' => 0, 'after' => 0, 'ajaxcallback' => ''));		
		include $this->template('dianjia');
					?>