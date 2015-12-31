<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head>
<title>佣金结算申请</title>
<meta charset="utf-8">
<link rel="stylesheet" href="../addons/eso_sale/style/css/oder.css?r=<?php  echo time()?>"/>
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
	margin-left:12px;
	background-color: #fa614b;
	display: inline-block;
	padding: 0 4%;
	border-radius: 5px;
}
.ranking-list .td.r{ filter:alpha(opacity=50); background:rgba(255, 255, 255, 0.2) none repeat scroll 0 0 !important; background-size:contain; max-width:200px; color:#FFF; font-size:14px;text-align:center;}
.ranking-list .td.td3{width:10%; filter:alpha(opacity=50); background:rgba(255, 255, 255, 0.2) none repeat scroll 0 0 !important;background-size:contain; max-width:170px; color:#FFF; font-size:14px;text-align:center;}
.ranking-list .td.td4{width:30%; filter:alpha(opacity=50); background:rgba(255, 255, 255, 0.2) none repeat scroll 0 0 !important; background-size:contain; max-width:170px; color:#FFF; font-size:14px;text-align:center;}
.ranking-list .td.td5{width:10%; filter:alpha(opacity=50); background:rgba(255, 255, 255, 0.2) none repeat scroll 0 0 !important; background-size:contain; max-width:170px; color:#FFF; font-size:14px;text-align:center;}
.ranking-list .td.td2{ width:40%;filter:alpha(opacity=50); background:rgba(255, 255, 255, 0.2) none repeat scroll 0 0 !important;color:#FFF; font-size:14px;text-align:center;}
.ranking-list .th.th1{ width:20%; min-width:90px; max-width:90px; color:#E9E900; filter:alpha(opacity=50); background:rgba(255, 255, 255, 0.4) none repeat scroll 0 0 !important;font-size:14px; text-align:center;}
.ranking-list .th.th2{ width:40%; color:#E9E900; filter:alpha(opacity=50); background:rgba(255, 255, 255, 0.4) none repeat scroll 0 0 !important;font-size:14px; text-align:center;}
.ranking-list .th.th3{ width:10%; color:#E9E900; filter:alpha(opacity=50); background:rgba(255, 255, 255, 0.4) none repeat scroll 0 0 !important; font-size:14px; text-align:center;}
.ranking-list .th.th4{ width:30%; color:#E9E900; filter:alpha(opacity=50); background:rgba(255, 255, 255, 0.4) none repeat scroll 0 0 !important; font-size:14px; text-align:center;}
.to-index-button{width:50px; height:45px; padding-top:4px; text-align:center; position:absolute; right:0px; top:0px; background-color:#7C0C0C; color:#E9E900; text-decoration:none; font-size:0.9em; line-height:1.2em;}
.ranking-list .th.th5{ width:10%; color:#E9E900; filter:alpha(opacity=50); background:rgba(255, 255, 255, 0.4) none repeat scroll 0 0 !important; font-size:14px; text-align:center;}
.to-index-button{width:50px; height:45px; padding-top:4px; text-align:center; position:absolute; right:0px; top:0px; background-color:#7C0C0C; color:#E9E900; text-decoration:none; font-size:0.9em; line-height:1.2em;}
.ranking-list .th{ display:table-cell; line-height:40px; position:relative;}
.ranking-list .td{ display:table-cell; line-height:60px; height:1px; filter:alpha(opacity=50); background:rgba(255, 255, 255, 0.4) none repeat scroll 0 0 !important;}
.ranking-list .td .user-head{ max-width:170px; color:#E9E900; font-size:1.6em;}
.ranking-list .th .arrow{ position:absolute; left:45%; bottom:-12px; border-top-color:#FF1313;}
.ranking-list .th.th2 .arrow{border-top-color:#FF1313;}
</style>

<body>
<div class="page-load-container" style="min-height: 771px; opacity: 1;">
<div class="page-load-page ranking-page"  style="min-height: 771px;">
	
	<div class="ranking-body" style="padding-top:0px;">
	
					<div class="ranking-list" >
		
				<?php  if(empty($list)) { ?>
				<p style="color:#fff; font-size:16px;">您还没有符合条件的佣金可以申请	<?php  if(!empty($commtime['commtime'])) { ?>，商家设置订单完成后满足<?php  echo $commtime['commtime'];?>天后才能申请佣金。	</p>	<?php  } ?>
				<?php  } else { ?>
			<div class="tr">
				<div class="th th1">时间<span class="arrow arrow-bottom"></span></div>
				<div class="th th2">订单号<span class="arrow arrow-bottom"></span></div>
				<!--<div class="th th3">数量<span class="arrow arrow-bottom"></span></div>-->
				<div class="th th4">佣金<span class="arrow arrow-bottom"></span></div>
						<div class="th th5"><input type="checkbox" onclick="getTop()" name="selected"/></div>
			</div>

			<?php  if(is_array($list)) { foreach($list as $v) { ?>
			<div class="tr">
			
				<div class="td r"><?php  echo date('Y-m-d', $v['createtime'])?></div>
				<div class="td td2"><a style="color:#FFF" href="#"><?php  echo $v['ordersn'];?></a></div>
				
				<!--<div class="td td3"><?php  echo $v['total'];?></div>-->
				
				<div class="td td4"><?php  echo $v['commission']*$v['total']?></div>
		<div class="td td5">
							<input type="checkbox" name="select" value="<?php  echo $v['id'];?>"/>
					</div>
			</div>
			<div class="tr">
				<div class="td"></div>
				<div class="td"></div>
				<div class="td"></div>
					<div class="td"></div>
								<div class="td"></div>
			</div>
			<?php  } } ?>
			
			<?php  } ?>
				<?php  echo $pager;?>
			<br/>
			<?php  if(!empty($list)) { ?>
				<input type="submit" onclick="back();" value="返回" class="btn btn-primary" style="width:48%;"/>
				<input type="submit" onclick="apply();" value="申请" class="btn btn-primary" style="width:48%;"/>
			<?php  } ?>
		</div>
	
	
	</div>
<footer class="foot"><a>&copy; <?php  echo $_W['account']['name'];?></a></footer>



</div>
</div>
<nav class="nav fn-clear">
	<a href="<?php  echo $this->mturl('fansindex')?>"><i class="icon-adult"></i>个人中心</a>
</nav>


<script src="http://libs.baidu.com/jquery/1.7.1/jquery.min.js"></script>
<script src="../addons/eso_sale/style/js/com.js"></script>
<script type="text/javascript">
function getTop(){
    var xed = document.getElementsByName("selected");
    var x = document.getElementsByName("select");

    if(xed[0].checked == true){
        for (var i=0; i<x.length; i++){
            x[i].checked = true;
        }
    }else{
        for (var i=0; i<x.length; i++){
            x[i].checked = false;
        }
    }
}

function apply(){
    if(<?php  echo $profile['flag'];?>==0){
        alert('您还不是推广人，无法申请佣金');
        return false;
    }
    var x = document.getElementsByName("select");
    var flag = false;
    var j = 0;

    var selected = new Array();
    for (var i=0; i<x.length; i++){
        if(x[i].checked == true){
            selected[j] = x[i].value;
            flag = true;
            j++;
        }
    }
    if(flag){

    }else{
        alert('您还未选择需要申请佣金的订单！');
        return false;
    }
    if(!confirm('确认申请吗？')){
        return false;
    }

    window.location.href = "<?php  echo $this->mturl('commission', array('op'=>'applyed'))?>&selected="+selected;
}

function back(){
    window.location.href = "<?php  echo $this->mturl('commission')?>";
}
</script>
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
        var mid=getCookie("mid");
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