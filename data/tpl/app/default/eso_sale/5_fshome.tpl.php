<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
<title>个人中心</title>
<style>
	*{margin:0; padding:0;}
	body{font-family:微软雅黑;}
	.kaishi{width:100%; overflow:hidden;}
	#beijing{ background:url(../addons/eso_sale/style/images/123.jpg); background-size:cover;
	filter : progid:DXImageTransform.Microsoft.AlphaImageLoader ( sizingMethod='scale' , src='../addons/eso_sale/style/images/123.jpg') ;}
	#toubu {width:100%; height:100px;　font-size:16px; color:#FFF;}
	#toubu img{width:60px; height:60px; margin:30px 20px;}
	#toubu li{list-style-type:none; line-height:25px; padding-top:20px; padding-left:80px;}
	#ziliao {width:100%; height:40px; clear:left;}
	#ziliao .gengai{width:49.8%; height:40px; float:left; font-size:18px; line-height:40px;
				     filter:alpha(opacity=50); background:rgba(255, 255, 255, 0.6) none repeat scroll 0 0 !important;}
	#ziliao a{text-decoration:none; color:#12A7D1;}
	#ziliao .gengai:active{background:rgba(200, 200, 200, 0.4) none repeat scroll 0 0 !important;}
	#ziliao .gengai1{width:49.8%; height:40px; float:left; font-size:18px; line-height:40px; background:rgba(255, 255, 255, 0.4) none repeat scroll 0 0 !important;}
	#ziliao .gengai1 a{text-decoration:none; color:#12A7D1;}
	#shenti {width:100%; height:100px; padding-top:20px;}
	#shenti #wode{width:98%; height:80px; list-style-type:none; margin:0 auto;}
	table {width:100%; height:80px;}
	td {background:rgba(255, 255, 255, 0.4) none repeat scroll 0 0 !important;}
	td:active{background:rgba(200, 200, 200, 0.4) none repeat scroll 0 0 !important;}
	td a{text-decoration:none; color:#2B2B2B;}
	table img{margin-bottom:-6px; margin-right:5px; height:25px;}
	.jifen {width:100%; height:35px; background-color:#F6F6F6; border-bottom:#E8E8E8 solid 1px; padding-top:15px; font-size:18px; padding-left:40px;}
	a{color:#2B2B2B; text-decoration:none;}
	.jifen img{margin-right:15%; margin-top:1px; height:20px;}
	.jifen span{
		margin-right:15%; 
		padding-top:3px;
		padding-bottom:3px; 	
		padding-left:10px;
		padding-right:10px;
		height:15px;
		width:auto;
		color:#fff;
		background:#fc0303;
		-moz-border-radius: 12px;
		-webkit-border-radius: 12px;
		border-radius:12px;
		font-size:13px;
		text-align:center;
		}
	.jifen:active{background-color:#D0D0D0;}
	
	.foot{width:100%;min-width:300px;margin-top:10px;margin-bottom:50px;padding:10px 0;color:#555;text-align:center;}
.foot a{color:#555;margin:0 3px;}
.nav{ position: fixed; left: 0; bottom:0;  width: 100%; }
.nav a{ float: left; display: block; width: 33%; text-align: center;background-color: RGB(0,180,181);color:#fff;padding: 5px 0 0;}
.nav a.active{background-color: rgba(243,241,241,.9); color: RGB(0,180,181);}
.nav a:nth-child(2){width: 34%;}
.nav i{ font-size: 20px; line-height: 1.2;display: block;}

.ewmform {
	position: fixed;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	z-index: 100;
	background: rgba(0, 0, 0, .8);
	display: none;
}

.ewmform .ewmform-box {
	position: absolute;
	top: 50%;
	left: 50%;
	width: 300px;
	height: 315px;
	margin-top: -180px;
	margin-left: -150px;
	background: #fff;
	border-radius: 3px;
	-webkit-border-radius: 3px;
	padding: 0 27px 27px;
	box-sizing: border-box;
	-webkit-box-sizing: border-box;
}

.ewmform-close {
	position: absolute;
	top: -15px;
	right: -5px;
	z-index: 10;
	width: 38px;
	height: 38px;
	display: block;
	background: url(../addons/eso_sale/style/images/ewmform-close.png) no-repeat;
	background-size: 38px;
}

.ewmform .ewmform-title {
	position: absolute;
	top: 4px;
	left: 0;
	z-index: 9;
	width: 100%;
	height: 24px;
	line-height: 24px;
	padding: 16px 0;
	text-align: center;
	color: #000;
	font-size: 20px;
	background: #fff;
}

.ewmform .ewmform-des{
	position: absolute;
	bottom: 23px;
	left: 0;
	z-index: 999;
	width: 100%;
	color: #2B3890;
	font-size:14px;
	text-align: center;
	background: #fff;
	line-height: 19px;
}

.ewmform .ewmform-summary {
	
	position: relative;
	width: 246px;
	height: 246px;
	box-sizing: border-box;
	-webkit-box-sizing: border-box;
	margin-top: 34px;
	background: #fff url(../addons/eso_sale/style/images/loading.gif) no-repeat center center;
}

.ewmform .ewmform-summary .ewm-thumbnail {
	width: 100%;
	display: block;
	
}

.ewmform .ewmform-summary .avatar-thumbnail {
	position: absolute;
	top: 50%;
	left: 50%;
	margin-left: -24px;
	margin-top: -24px;
	width: 48px;
	height: 48px;
	padding: 2px;
	display: block;
	background: #fff;
	border-radius: 3px;
	-webkit-border-radius: 3px;
}
.ewm-download{
	position: absolute;
	left: 0;
	top: 0;
	z-index: 998;
	width:232px;
	opacity: 0;
}

</style>
</head>

<body>
<div class="kaishi">
<div id="beijing">
	<div id="toubu">
		<img src="<?php  if(empty($myheadimg['avatar'])) { ?>../addons/eso_sale/style/images/yh.png<?php  } else { ?><?php  echo $myheadimg['avatar'];?><?php  } ?>" align="left"/>
    	<li>
        姓名：<?php  echo $profile['realname'];?><br/>
		积分：<span id="mygold"><?php  echo $myheadimg['credit1'];?></span><br/>
        身份：<?php  if($profile['agent'] == 0 ) { ?>业务员<?php  } else { ?><?php  if($profile['agent'] == 1) { ?>医生<?php  } else { ?>用户<?php  } ?><?php  } ?>
		</li>
	</div>
	<div id="ziliao">
		<a href="<?php  echo $this->mturl('register', array('id'=>$profile['id'], 'opp'=>'complate', agent=>$profile['agent'], mid=>$profile['shareid']))?>"><div class="gengai" align="center">完善资料</div></a>
		<a href="<?php  echo $this->mturl('list',array('mid'=>$id))?>"><div class="gengai" align="center">返回商城</div></a>
	</div>

</div><?php  if($profile['agent'] != 2) { ?>
	<a href="<?php  echo $this->mturl('myfans')?>"><div class="jifen"><?php  if($profile['agent'] == 0 ) { ?>我发展的医生<?php  } else { ?>我发展的会员<?php  } ?><img src="../addons/eso_sale/style/images/jiantou.png" align="right" /></div></a><?php  } ?>
	<a href="<?php  echo $this->mturl('fansorder')?>"><div class="jifen">订单明细<img src="../addons/eso_sale/style/images/jiantou.png" align="right" /></div></a>
    <a href="<?php  echo $this->mturl('commission')?>"><div class="jifen">佣金明细<span style="float:right"><?php  echo $profile['commission'];?>元</span></div></a>
	<?php  if($profile['agent'] == 0 ) { ?><a onclick="myQrcode();"><div class="jifen">绑定医生<img src="../addons/eso_sale/style/images/jiantou.png" align="right" /></div></a><?php  } ?>
	<a href="<?php  echo $this->mturl('award')?>"><div class="jifen">积分兑换<img src="../addons/eso_sale/style/images/jiantou.png" align="right" /></div></a>
	<?php  if($profile['agent'] != 2) { ?><a href="<?php  echo $this->mturl('zhifu')?>"><div class="jifen">打款记录<img src="../addons/eso_sale/style/images/jiantou.png" align="right" /></div></a><?php  } ?>
	<!--<a href="<?php  echo $this->mturl('phb')?>"><div class="jifen">代理排行榜<img src="../addons/eso_sale/style/images/jiantou.png" align="right" /></div></a>-->
	<a href="<?php  echo $this->mturl('rule')?>"><div class="jifen">帮助说明<img src="../addons/eso_sale/style/images/jiantou.png" align="right" /></div></a>
    
	
</div>
	<div id="qrcode" class="ewmform js-ewmform" onclick="this.style.display = 'none';window.document.getElementById('shade').style.display = 'none';" style="display:none; z-index:999; position:fixed;">
	<div class="ewmform-box">
	  	<code class="ewmform-close js-ewmClose"></code>
	  	<div class="ewmform-title" style="top:0;">扫描二维码绑定医生</div>
		<div class="ewmform-summary"><img class="ewm-thumbnail" id="ewmThumbnail" src="../addons/eso_sale/style/images/share/share<?php  echo $id;?>.png"></div>
	  	<div class="ewmform-des" style="bottom:10px;">拿起医生的手机<br>扫描上方二维码</div>
  </div>
</div>

<div id="shade" onclick="this.style.display = 'none';window.document.getElementById('qrcode').style.display = 'none';" style="display:none; z-index:998; position:fixed; top:0px; width:100%; height:100%; background-color:#000; opacity:0.3;">

</div>



<script type="text/javascript">
function myQrcode(){
	window.document.getElementById('shade').style.display = 'block';
	window.document.getElementById('qrcode').style.display = 'block';
	
}
//获取指定cookes函数
function getCookie(name) 
{
    var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
 
    if(arr=document.cookie.match(reg))
 
        return unescape(arr[2]); 
    else 
        return null; 
}
document.cookie = "mid="+<?php  echo $id;?>;
</script>
<footer class="foot"><a>&copy; <?php  echo $_W['account']['name'];?></a></footer>
</body>
<script src="../addons/eso_sale/style/js/zepto.min.js"></script>
<script>
function report(){
	if(<?php  echo $credit;?>!=-1){
		return;
	}
	$.ajax({
		type: "POST",
		url: "<?php  echo $this->createMobileurl('home',array('op'=>'report'))?>",
		dataType: "text",
		
		success: function (d) {
			if(d!=0){
				window.document.getElementById('wxqd').innerHTML = '获得'+d+'分';
				var credit = parseInt(window.document.getElementById('mygold').innerHTML);
				var credit1 = credit + parseInt(d);
				window.document.getElementById('mygold').innerHTML = credit1;
			}
		},
		
		error: function (xml, text, thrown){
			TopBox.alert("出错啦!");
		}
	});
}
</script>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js?v=20150120"></script>
<script type="text/javascript">
	     var wxData = {
            "appId": "<?php  echo $_W['account']['key'];?>",
            "imgUrl" : '<?php  echo $_W['siteroot'];?>/source/modules/eso_sale/style/images/icon.jpg',
            "link" : '<?php  echo $_W['siteroot']."app/".$this->mturl('fansindex',array('id'=>$id))?>',
            "desc" : "<?php  echo $signPackage['description'];?>",
            "title" : '<?php  echo $_W['account']['name'];?>'
        };
        // 分享的回调
        var wxCallbacks = {
            // 分享被用户自动取消
            cancel : function(resp) {
                TopBox.alert("分享后获得积分,还有可能得到佣金哦!不要错过发大财的机会!");
            },
            // 分享失败了
            fail : function(resp) {
                TopBox.alert("分享失败，可能是网络问题，一会儿再试试？");
            },
            // 分享成功
            confirm : function(resp) {
             TopBox.alert("分享后成功,等着收佣金吧!");
            },
        };
        Api.shareToFriend(wxData,wxCallbacks);
        Api.shareToTimeline(wxData,wxCallbacks);
        Api.shareToWeibo(wxData,wxCallbacks);
        Api.generalShare(wxData,wxCallbacks);
    });

</script>
</html>
