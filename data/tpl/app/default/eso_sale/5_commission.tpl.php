<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head>
<title>佣金明细</title>
<meta charset="utf-8">
<link rel="stylesheet" href="../addons/eso_sale/style/css/oder.css"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no" />

<meta name="mobileOptimized" content="width" />
<meta name="handheldFriendly" content="true" />
<meta http-equiv="Cache-Control" content="max-age=0" />
<meta name="apple-touch-fullscreen" content="yes" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
</head>
<style>
.pagination li{
	margin-left:15px;
	background-color: #fa614b;
	display: inline-block;
	padding: 0 4%;
	border-radius: 5px;
}
.cnss-detail p span.cnss-time{ width: 32%; text-align: center;}
.cnss-detail p span.cnss-event{ width: 34%; text-align: center;}
.cnss-detail p span.cnss-money{ width: 15%; text-align: center;}

.nav a {
	float: left;
	display: block;
	width: 100%;
	text-align: center;
	background-color: RGB(0,180,181);
	color: #fff;
	padding: 5px 0 0;
}

#ziliao {width:100%; height:40px; clear:left;}
	#ziliao .gengai{width:49.8%; height:40px; float:left; font-size:18px; line-height:40px;
				     filter:alpha(opacity=50); background:rgba(255, 255, 255, 0.4) none repeat scroll 0 0 !important;}
	#ziliao a{text-decoration:none; color:#FFF;}
	#ziliao .gengai:active{background:rgba(200, 200, 200, 0.4) none repeat scroll 0 0 !important;}
	#ziliao .gengai1{width:49.8%; height:40px; float:left; font-size:18px; line-height:40px; background:rgba(255, 255, 255, 0.4) none repeat scroll 0 0 !important;}
	#ziliao .gengai1 a{text-decoration:none; color:#12A7D1;}
	
	.ranking-list .td.r{ filter:alpha(opacity=50); background:rgba(255, 255, 255, 0.2) none repeat scroll 0 0 !important; background-size:contain; max-width:200px; color:#FFF; font-size:14px;text-align:center;}
.ranking-list .td.td3{width:20%; filter:alpha(opacity=50); background:rgba(255, 255, 255, 0.2) none repeat scroll 0 0 !important;background-size:contain; max-width:170px; color:#FFF; font-size:14px;text-align:center;}
.ranking-list .td.td4{width:20%; filter:alpha(opacity=50); background:rgba(255, 255, 255, 0.2) none repeat scroll 0 0 !important; background-size:contain; max-width:170px; color:#FFF; font-size:14px;text-align:center;}
.ranking-list .td.td2{ width:40%;filter:alpha(opacity=50); background:rgba(255, 255, 255, 0.2) none repeat scroll 0 0 !important;color:#FFF; font-size:14px;text-align:center;}
.ranking-list .th.th1{ width:40%; min-width:90px; max-width:90px; color:#E9E900; filter:alpha(opacity=50); background:rgba(255, 255, 255, 0.4) none repeat scroll 0 0 !important;font-size:14px; text-align:center;}
.ranking-list .th.th2{ width:40%; color:#E9E900; filter:alpha(opacity=50); background:rgba(255, 255, 255, 0.4) none repeat scroll 0 0 !important;font-size:14px; text-align:center;}
.ranking-list .th.th3{ width:20%; color:#E9E900; filter:alpha(opacity=50); background:rgba(255, 255, 255, 0.4) none repeat scroll 0 0 !important; font-size:14px; text-align:center;}
.ranking-list .th.th4{ width:20%; color:#E9E900; filter:alpha(opacity=50); background:rgba(255, 255, 255, 0.4) none repeat scroll 0 0 !important; font-size:14px; text-align:center;}
.to-index-button{width:50px; height:45px; padding-top:4px; text-align:center; position:absolute; right:0px; top:0px; background-color:#7C0C0C; color:#E9E900; text-decoration:none; font-size:0.9em; line-height:1.2em;}
.ranking-list .th{ display:table-cell; line-height:40px; position:relative;}
.ranking-list .td{ display:table-cell; line-height:60px; height:1px; filter:alpha(opacity=50); background:rgba(255, 255, 255, 0.4) none repeat scroll 0 0 !important;}
.ranking-list .td .user-head{ max-width:170px; color:#E9E900; font-size:1.6em;}
.ranking-list .th .arrow{ position:absolute; left:45%; bottom:-12px; border-top-color:#FF1313;}
.ranking-list .th.th2 .arrow{border-top-color:#FF1313;}

<?php  if($opp=='more') { ?>
.cnss-detail {
	margin-top: 0;
	opacity: 0.7;
}
<?php  } ?>
</style>
<body>
		<div class="page-load-container" style="min-height: 771px; opacity: 1;">
<div class="page-load-page ranking-page"  style="min-height: 771px;">
	
	<div class="ranking-body" style="padding-top:0px;">
				<?php  if($opp!='more') { ?>
				<div id="ziliao">
		<div class="gengai" align="center"><a href="#">可结：<?php  echo $commissioningpe;?>元</a></div>
		<div class="gengai" align="center"><a href="#">已结：<?php  echo $commissioned;?>元</a></div>
	</div>
					
		<div style="padding-bottom:10px;">
			</div>
				<?php  } ?>
				
			
				<div class="ranking-list" >
			
					<?php  if(empty($list)) { ?>
					<p style="color:#fff; font-size:1.6em;">暂无佣金记录！如果上方的可结佣金大于0，请点击最下方的佣金结算申请，通过审核后，就会显示一条佣金记录！</p><p style="color:#fff; font-size:1.6em;">如果可结之前大于0，申请结算佣金后变成0，但是已结佣金还是没有增加的情况是因为您的佣金申请已经通过，但是商家还未给您进行佣金结算操作的原因，请联系商家给您进行佣金结算操作！</p>
					<?php  } else { ?>
			<div class="tr">
				<div class="th th1">时间<span class="arrow arrow-bottom"></span></div>
				<div class="th th2">订单编号<span class="arrow arrow-bottom"></span></div>
				<!--<div class="th th3">数量<span class="arrow arrow-bottom"></span></div>-->
				<div class="th th4">佣金<span class="arrow arrow-bottom"></span></div>
			</div>

			<?php  if(is_array($list)) { foreach($list as $v) { ?>
			<div class="tr">
			
				<div class="td r"><?php  echo date('Y-m-d', $v['createtime'])?><?php  if($v['isshare']==1) { ?>(下级)<?php  } ?></div>
				<div class="td td2"><?php  if(empty($v['ordersn'])) { ?>已被删除<?php  } else { ?><a style="color:#FFF" href="#"><?php  echo $v['ordersn'];?></a><?php  } ?></div>
				
				<!--<div class="td td3"><?php  echo $v['total'];?></div>-->
				
				<div class="td td4"><?php  echo $v['commission'];?></div>
			
			</div>
			<div class="tr">
				<div class="td"></div>
				<div class="td"></div>
				<!--<div class="td"></div>-->
					<div class="td"></div>
			</div>
			<?php  } } ?>
			
		
			
			<?php  } ?>
		</div>
		
			<div style="padding-top:10px;color:#FFF;font-size:1.6em;">名词说明：<br>1、【可结】指的是您推荐的订单已经完成，您可以获得的预估佣金！<br>2、【已结】指通过佣金结算审核后的佣金记录，此记录是您获得的所有佣金总和（包括已打款和未打款）！<br>3、【出现已结为0，但是已结却没有增加的原因是，当前申请的那部分佣金已经通过审核，但是商家还未进行佣金结算操作的原因，请联系商家进行佣金结算操作即可！】</div>
		
		<?php  if($opp != 'more') { ?>
					<?php  if($total > 10) { ?>
						<a href="<?php  echo $this->mturl('commission', array('opp'=>'more', 'op'=>'display'));?>"><span style="position:absolute; right:10%;">查看更多...</span></a>
					<?php  } ?>
				<?php  } ?>
				<?php  if($opp == 'more') { ?>
					<?php  echo $pager;?>
					<br/>
					<a href="<?php  echo $this->mturl('commission');?>"><input type="submit" value="返回" class="btn btn-primary" style="width:97%;"/></a>
				<?php  } ?>
	
	</div>
<footer class="foot"><a>&copy; <?php  echo $_W['account']['name'];?></a></footer>



</div>
</div>
<nav class="nav fn-clear">
	<a href="<?php  echo $this->mturl('commission', array('op'=>'commapply'))?>"><i class="icon-adult"></i>佣金结算申请</a>
	
</nav>

<script src="http://libs.baidu.com/jquery/1.7.1/jquery.min.js"></script>
<script src="../addons/eso_sale/style/js/com.js"></script>
</body>
<?php 
    require_once IA_ROOT."/jssdk.class.php";
    $appid = $this->module['config']['appid'];
$secret = $this->module['config']['secret'];
$weixin = new jssdk($appid,$secret);
$wx = $weixin->get_sign();
?>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript">
    wx.config({
        appId: "<?php  echo $wx['appId'];?>",
        timestamp: <?php  echo $wx['timestamp'];?>,
        nonceStr: "<?php  echo $wx['nonceStr'];?>",
        signature: "<?php  echo $wx['signature'];?>",
        jsApiList: [
            'checkJsApi',
            'onMenuShareTimeline',
            'onMenuShareAppMessage',
            'onMenuShareQQ',
            'onMenuShareWeibo',
            'hideMenuItems',
            'showMenuItems',
            'hideAllNonBaseMenuItem',
            'showAllNonBaseMenuItem',
            'translateVoice',
            'startRecord',
            'stopRecord',
            'onRecordEnd',
            'playVoice',
            'pauseVoice',
            'stopVoice',
            'uploadVoice',
            'downloadVoice',
            'chooseImage',
            'previewImage',
            'uploadImage',
            'downloadImage',
            'getNetworkType',
            'openLocation',
            'getLocation',
            'hideOptionMenu',
            'showOptionMenu',
            'closeWindow',
            'scanQRCode',
            'chooseWXPay',
            'openProductSpecificView',
            'addCard',
            'chooseCard',
            'openCard'
        ]
    });
    wx.ready(function () {
        var shareData = {
            title: '全民销客-赶快来邀请好友赚佣金！',
            desc: '全民销客-赶快来邀请好友赚佣金！',
            link: "<?php  echo $wx['url'];?>",
            imgUrl: '<?php  echo $_W['siteroot'];?>/addons/eso_sale/style/images/icon.jpg',
        };
        //分享朋友
        wx.onMenuShareAppMessage({
            title: shareData.title,
            desc: shareData.desc,
            link: shareData.link,
            imgUrl:shareData.imgUrl,
            trigger: function (res) {
            },
            success: function (res) {
                window.location.href ='<?php  echo $_W['siteroot']."app/".$this->mturl('fansindex',array('id'=>$id))?>';
                TopBox.alert("分享后成功,等着收佣金吧!");
            },
            cancel: function (res) {
                TopBox.alert("分享后获得积分,还有可能得到佣金哦!不要错过发大财的机会!");
            },
            fail: function (res) {
                alert(JSON.stringify(res));
            }
        });
        //朋友圈
        wx.onMenuShareTimeline({
            title: shareData.title+"---"+shareData.desc,
            link: shareData.link,
            imgUrl:shareData.imgUrl,
            trigger: function (res) {
            },
            success: function (res) {
                window.location.href ='<?php  echo $_W['siteroot']."app/".$this->mturl('fansindex',array('id'=>$id))?>';
            },
            cancel: function (res) {
            },
            fail: function (res) {
                alert(JSON.stringify(res));
            }
        });

        //显示分享
        wx.showOptionMenu();
    });
</script>
</html>