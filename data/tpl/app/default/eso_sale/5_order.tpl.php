<?php defined('IN_IA') or exit('Access Denied');?><?php  $bootstrap_type = 3;?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('header', TEMPLATE_INCLUDEPATH)) : (include template('header', TEMPLATE_INCLUDEPATH));?>
<style type='text/css'>
    .sel { background:#e9342a; color:#fff;}
    .nosel { background:#fff;color:#000}
</style>
<link type="text/css" rel="stylesheet" href="../addons/eso_sale/images/style.css">
<div class="head">
    <a href="javascript:history.back();" class="bn pull-left"><i class="fa fa-angle-left"></i></a>
	<span class="title">我的订单</span>
    <a href="<?php  echo $this->createMobileUrl('mycart')?>" class="bn pull-right"><i class="fa fa-shopping-cart"></i></a>
</div>
<div style='margin-top: 50px;'>
</div>
 <div class="myoder img-rounded" style='color:#aaa;padding:5px;'>
<div>姓名：<?php  echo $fans['realname'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 电话：<?php  echo $fans['mobile'];?></div>
<div>余额：<?php  echo $fans['credit2'];?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 积分：<?php  echo $fans['credit1'];?></div>
</div>
 <div class="myoder img-rounded" style='text-align:center;color:#aaa;padding:5px;'>
     <div style='float:left;height:30px;margin:auto;width:60%;'>
    <div <?php  if($status==0) { ?>class='sel'<?php  } else { ?>class="nosel"<?php  } ?> style='border-top-left-radius: 5px;border-bottom-left-radius:5px;border:1px solid #e9342a;text-align: center;float:left;width:30%' onclick="location.href='<?php  echo $this->mturl('myorder',array('status'=>0))?>'">
        待支付
    </div>
    <div <?php  if($status==1 || $status==2) { ?>class='sel'<?php  } else { ?>class="nosel"<?php  } ?> style='border:1px solid #e9342a;margin-left:-1px;float:left;width:30%;text-align: center;' onclick="location.href='<?php  echo $this->mturl('myorder',array('status'=>2))?>'">
        待收货
    </div>
    <div <?php  if($status==3) { ?>class='sel'<?php  } else { ?>class="nosel"<?php  } ?> style='border-top-right-radius: 5px;margin-left:-1px;border-bottom-right-radius:5px;text-align: center;border:1px solid #e9342a;float:left;width:30%' onclick="location.href='<?php  echo $this->mturl('myorder',array('status'=>3))?>'">
        已完成
    </div>
</div>
     <a style='float:right;' href="<?php  echo $this->mturl('address', array('from'=>'confirm'))?>">管理收货地址</a>
</div>



<?php  if(count($list)<=0) { ?>
<div class="myoder img-rounded" style='text-align:center;color:#aaa;padding:30px;'>
    您暂时没有任何订单!
</div>
<?php  } ?>
<div style='margin-bottom:40px;'>
<?php  if(is_array($list)) { foreach($list as $item) { ?>
<div class="myoder img-rounded">
	<div class="myoder-hd">
		<span class="pull-left">订单编号：<?php  echo $item['ordersn'];?></span>
		<span class="pull-right"><?php  echo date('Y-m-d H:i', $item['createtime'])?>
        <?php  if($item['paytype'] == 3) { ?>
			<?php  if($item['status'] == -1) { ?>
			<span class="text-muted">订单取消</span>
			<?php  } else if($item['status'] < 3) { ?>
			<span class="text-danger">货到付款 / 未付款</span>
			<?php  } else { ?>
			<span class="text-success">已完成</span>
			<?php  } ?>
		<?php  } else { ?>
			<?php  if($item['status'] == -1) { ?>
			<span class="text-muted">订单取消</span>
			<?php  } else if($item['status'] == 0) { ?>
			<span class="text-danger">未付款</span>
			<?php  } else if($item['status'] == 1) { ?>
			<span class="text-warning">已付款</span>
			<?php  } else if($item['status'] == 2) { ?>
			<span class="text-warning">已发货</span>
			<?php  } else { ?>
			<span class="text-success">已完成</span>
			<?php  } ?>
		<?php  } ?>
                </span>
	</div>
                  <?php  if(count($item['goods'])==1) { ?>
	<?php  if(is_array($item['goods'])) { foreach($item['goods'] as $goods) { ?>
	<div class="myoder-detail">
		<a href="<?php  echo $this->mturl('detail', array('id' => $goods['id']))?>"><img src="<?php  echo $_W['attachurl'];?><?php  echo $goods['thumb'];?>" width="160"></a>
		<div class="pull-left">
			<div class="name"><a href="<?php  echo $this->mturl('detail', array('id' => $goods['id']))?>"><?php  echo $goods['title'];?></a></div>
			<div class="price">
				<span><?php  echo $goods['marketprice'];?> 元<?php  if($goods['unit']) { ?> / <?php  echo $goods['unit'];?><?php  } ?></span>
				<span class="num"><?php  echo $item['total'][$goods['id']]['total'];?><?php  if($goods['unit']) { ?> <?php  echo $goods['unit'];?><?php  } ?></span>
			</div>
		</div>
	</div>
	<?php  } } ?>
        <?php  } else { ?>
       
	<div class="myoder-detail">
             <?php  if(is_array($item['goods'])) { foreach($item['goods'] as $goods) { ?>
		<a href="<?php  echo $this->mturl('detail', array('id' => $goods['id']))?>"><img src="<?php  echo $_W['attachurl'];?><?php  echo $goods['thumb'];?>" width="160"></a>
                <?php  } } ?>
	</div>
	
        <?php  } ?>
	 
	<div class="myoder-total">
		<span>共计：<span class="false"> <?php  if($item['dispatchprice']<=0) { ?>
                        <?php  echo $item['price'];?> 元
                        <?php  } else { ?>
                        <?php  echo $item['price'];?> 元 (运费 <?php  echo $item['dispatchprice'];?> 元) 
                        <?php  } ?></span></span>
	 	<a href="<?php  echo $this->mturl('myorder', array('orderid' => $item['id'], 'op' => 'detail'))?>" class="btn btn-success pull-right btn-sm" >订单详情</a>
		 
	</div>
</div>
<?php  } } ?></div>

 <div class="wx_nav">
        <a href="<?php  echo $this->mturl('list')?>" data-href="###" ptag="37080.1.1" class="nav_index">首页</a>
        <a href="<?php  echo $this->mturl('listCategory')?>"  ptag="37080.1.2" class="nav_search" style="display:">分类</a>
        <a href="<?php  echo $this->mturl('tuiguang',array('gid'=>$goods['id'],'mid'=>$member['id']))?>"  ptag="37080.1.3" class="nav_shopcart">我要分销</a>
        <a href="<?php  echo $this->mturl('myorder')?>"  ptag="37080.1.4" class="nav_me on">我的订单</a>
		<a href="<?php  echo $this->mturl('fansindex')?>"  ptag="37080.1.4" class="nav_fav">会员中心</a>
    </div>
	<link href="../addons/eso_sale/recouse/css/xin_v3.s.min.css" rel="stylesheet" type="text/css" />
<script src="../addons/eso_sale/recouse/js/zepto.min.js" type="text/javascript"></script>
<script type="text/javascript">
Zepto(function($){
   var $nav = $('.global-nav'), $btnLogo = $('.global-nav__operate-wrap');
   //点击箭头，显示隐藏导航
   $btnLogo.on('click',function(){
     if($btnLogo.parent().hasClass('global-nav--current')){
       navHide();
     }else{
       navShow();
     }
   });
   var navShow = function(){
     $nav.addClass('global-nav--current');
   }
   var navHide = function(){
     $nav.removeClass('global-nav--current');
   }
   
   $(window).on("scroll", function() {
		if($nav.hasClass('global-nav--current')){
			navHide();
		}
	});
})
function get_search_box(){
	try{
		document.getElementById('get_search_box').click();
	}catch(err){
		document.getElementById('keywordfoot').focus();
 	}
}
</script>
 <script src="../addons/eso_sale/style/js/wx.js"></script>
<script type="text/javascript">

//获取指定cookes函数
function getCookie(name) 
{ 
    var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
 
    if(arr=document.cookie.match(reg))
 
        return unescape(arr[2]); 
    else 
        return null; 
}
</script>

<?php 
    require_once MODULE_ROOT."/jssdk.class.php";
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
            title: '赶快来邀请好友赚佣金！',
            desc: '赶快来邀请好友赚佣金！',
            link: "<?php  echo $wx['url'];?>",
            imgUrl: '<?php  echo $_W['siteroot'];?>addons/eso_sale/style/images/icon.jpg',
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
                window.location.href ='<?php  echo $_W['siteroot']."app/".$this->mturl('list',array('id'=>$id))?>&mid='+mid;
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
                window.location.href ='<?php  echo $_W['siteroot']."app/".$this->mturl('list',array('id'=>$id))?>&mid='+mid;
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
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footerbar', TEMPLATE_INCLUDEPATH)) : (include template('footerbar', TEMPLATE_INCLUDEPATH));?>