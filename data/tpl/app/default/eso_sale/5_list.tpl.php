<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>商城首页</title>
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="format-detection" content="telephone=no">
<link rel="apple-touch-icon-precomposed" href="../addons/eso_sale/recouse/images//apple-touch-icon.png">
<link href="../addons/eso_sale/recouse/css/home.css" rel="stylesheet" type="text/css" />
<link href="../addons/eso_sale/recouse/css/foot.css" rel="stylesheet" type="text/css" />
<link href="../addons/eso_sale/recouse/css/xin_v3.s.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../addons/eso_sale/recouse/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="../addons/eso_sale/recouse/js/jquery.lazyload.js"></script>
<script type="text/javascript" src="../addons/eso_sale/recouse/js/fbi.js"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
	$(".row_list img").lazyload({
		placeholder: "../addons/eso_sale/recouse/images//img_bg4.png",
		effect: "fadeIn"
	});
	$("#submit").click(function() {
		if($("#search_word").val()){
			$("#searchForm").submit();
		} else {
			alert("请输入关键词！");
			return false;
		}
	});
});
</script>


</head>
<body style="">
<style>
.rec_list_v2 .info {
    top: 60%;
    left: 0%;}
	.rec_list_v2 .buy {
    left: 70%;}
</style>

<div class="WX_search" id="mallHead">
    <div class="WX_bar_cate">
        <a href="<?php  echo $this->mturl('listCategory')?>" id="__cate"></a>
    </div>
	<form class="WX_search_frm"  id="searchForm" name="searchForm" >
        <input type="hidden" name="i" value="<?php  echo $uniacid;?>" />
        <input type="hidden" name="name" value="eso_sale" />
		<input type="hidden" name="do" value="Search" />
        <input type="hidden" name="c" value="entry" />
        <input type="hidden" name="m" value="eso_sale" >

        <input name="keyword" id="search_word" class="WX_search_txt hd_search_txt_null" placeholder="请输入商品名进行搜索！" ptag="37080.5.2" type="search"  AUTOCOMPLETE="off"/>
      
   
    <div class="WX_me">
        <a href="javascript:;" id="submit" class="WX_search_btn_blue" >搜索</a>
       
    </div>
	 </form>
</div>
<div class="WX_tab Top_tab" id="toolbarHead">
    <div class="WX_tab_wrap">
      
        <span class="WX_tab_inner">
            <a href="<?php  echo $this->mturl('list')?>">首页</a>
            <a href="<?php  echo $this->mturl('list2',array('isnew'=>1))?>">新品</a>
            <a href="<?php  echo $this->mturl('list2',array('isdiscount'=>1))?>">特价</a>
            <a href="<?php  echo $this->mturl('list2',array('istime'=>1))?>">限时</a>
        </span>
    </div>
</div>


<div id="viewport" class="viewport">
  <div class="slider card card-nomb" style="visibility: visible;">
    <!-- banner轮播Start -->
    <script type="text/javascript" src="../addons/eso_sale/recouse/js/TouchSlide.1.1.js"></script>
    <div id="focus" class="focus">
      <div class="hd">
        <ul>
        </ul>
      </div>
      <div class="bd">
        <ul>
       <?php  if(is_array($advs)) { foreach($advs as $adv) { ?>
        <li><a href="<?php  if(empty($adv['link'])) { ?>#<?php  } else { ?><?php  echo $adv['link'];?><?php  } ?>" target="_blank"><img src="<?php  echo $_W['attachurl'];?><?php  echo $adv['thumb'];?>" /></a></li>
		<?php  } } ?>
        </ul>
      </div>
    </div>
    <script type="text/javascript">
	TouchSlide({ 
		slideCell:"#focus",
		titCell:".hd ul", //开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
		mainCell:".bd ul",
		delayTime:600,
		interTime:4000,
		effect:"leftLoop", 
		autoPlay:true,//自动播放
		autoPage:true, //自动分页
		switchLoad:"_src" //切换加载，真实图片路径为"_src" 
	});
	</script>
    <!-- banner轮播End -->
  </div>

  
 
  

    <div class="rec_panel">
              <ul class="rec_list_v2" id="m1">
			  
			  <?php  if(is_array($islist)) { foreach($islist as $item) { ?>
			  
          <li status="1" title="<?php  echo $item['title'];?>" aid="" qnum="" ynum="" skuid="">
            <a href="<?php  echo $this->mturl('detail', array('id' => $item['id']))?>" class="item">
              <div class="item_tag tag_red" style="display:">限时抢购
                <span yuyueid="" style="display:none"></span>
              </div>
              <div class="img"><img class="photo" usesrc="1" src="<?php  echo $_W['attachurl'];?><?php  echo $item['xsthumb'];?>"></div>
              <div class="info">
               <div class="name"><?php  echo $item['title'];?></div>
               <div class="desc"><?php  echo $item['description'];?></div>
               <div class="price">￥<?php  echo $item['marketprice'];?></div>
              </div>
              <div class="buy"><span ptag="" class="btn">马上抢购</span></div>
            </a>
          </li>
		  
		  <?php  } } ?>
 
  </div>


  
   <div class="mod_space_gap"></div>
   <div class="os_panel">
        <div class="hd">
            <h3>首页推荐</h3>
        </div>
        <ul class="os_box_list" id="m2Con">
        <?php  if(is_array($rlist)) { foreach($rlist as $item) { ?>
              <li>
                  <a href="<?php  echo $this->mturl('detail', array('id' => $item['id']))?>" class="item">

                      <div class="img"><img src="<?php  echo $_W['attachurl'];?><?php  echo $item['thumb'];?>"  usesrc="1" alt=""></div>
                      <div class="txt"><?php  echo $item['title'];?></div>
                      <div class="desc"><?php  echo $item['description'];?></div>
                      <div class="buy">
                          <span class="price">￥<?php  echo $item['marketprice'];?></span>
                          <span class="btn">马上抢购</span>
                      </div>
                  </a>
              </li>
        <?php  } } ?>
       </ul>
       <div class="os_list_more" id="btnMore2"  pi="1">
        <a href="<?php  echo $this->mturl('listCategory')?>">
            <span  class="btn_more" ptag="37328.3.2" >查看更多&nbsp;&gt;&gt; </span>
        </a>
       </div>
   </div>
<!--页面底部-->
﻿<!--页面底部-->
    <div class="viewport">
        <div id="footer" class="footer">
        <div class="row g_2">
                <a href="javascript:window.scrollTo(0,0);"><?php  echo $_W['account']['name'];?></a>
            </div>
        </div>
    </div>

    <div class="wx_nav">
        <a href="<?php  echo $this->mturl('list')?>" data-href="###" ptag="37080.1.1" class="nav_index on">首页</a>
        <a href="<?php  echo $this->mturl('listCategory')?>"  ptag="37080.1.2" class="nav_search" style="display:">分类</a>
        <a href="<?php  echo $this->mturl('mycart')?>"  ptag="37080.1.3" class="nav_shopcart">购物车</a>
        <a href="<?php  echo $this->mturl('myorder')?>"  ptag="37080.1.4" class="nav_me">我的订单</a>
        <!--<a href="<?php  echo $ydyy;?>"  ptag="37080.1.4" class="nav_fav">一键关注</a> -->
		<a href="<?php  echo $this->mturl('fansindex')?>"  ptag="37080.1.4" class="nav_fav">会员中心</a>
    </div>
<script src="../addons/eso_sale/recouse/js/zepto.min.js" type="text/javascript"></script>

<script type="text/javascript">

function WeiXinAddContact(wxid, cb)   
{ 
 if (typeof WeixinJSBridge == 'undefined')  return false;  
 WeixinJSBridge.invoke('addContact', { webtype: '1', username: wxid  },  
 function(d) {   
 // 返回d.err_msg取值，d还有一个属性是err_desc //    add_contact:cancel 用户取消 //  add_contact:fail 关注失败   
// add_contact:ok 关注成功   // add_contact:added 已经关注   
WeixinJSBridge.log(d.err_msg);  cb && cb(d.err_msg); });
 }; 
//通过微信分享   
function WeiXinShareBtn() {   if (typeof WeixinJSBridge== "undefined")  
 { alert("请先通过微信xxxx"); }   else {   WeixinJSBridge.invoke('shareTimeline', 
 { "title": "微信资讯网", "link": "http://www.wechatstyle.com",   "desc": "欢迎关注微时代为您搜罗最新最尖端的微信资讯。
内容包括微信公众平台开发、微信营销方案策略、微信操作指南，   好玩有趣的微信公众账号导航、微信游戏攻略、微信最新版本，
 最新功能等更多更全面的微信资讯信息。",  "img_url": "http://www.wechatstyle.com" });  
 }
 }




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
</script><!--页面底部-->
<script type="text/javascript">
//获取指定cookes函数
function getCookie(name) {
    var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
    if(arr=document.cookie.match(reg))
        return unescape(arr[2]);
    else 
        return null; 
} 
</script>
</body>

<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
	// jssdk config 对象
	jssdkconfig = <?php  echo json_encode($_W['account']['jssdkconfig']);?> || { jsApiList:[] };
	
	// 是否启用调试
	// jssdkconfig.debug = true;
	
	// 已经注册了 jssdk 文档中所有的接口
	jssdkconfig.jsApiList = [
		'checkJsApi',
		'onMenuShareTimeline',
		'onMenuShareAppMessage',
		'onMenuShareQQ',
		'onMenuShareWeibo',
		'showOptionMenu',		
	];
	
	wx.config(jssdkconfig);
	
	window.shareData = {  
            "imgUrl": "<?php  echo $_W['attachurl'];?><?php  echo $logo;?>",
            "timeLineLink": "<?php  echo $shareurl;?>",
            "sendFriendLink": "<?php  echo $shareurl;?>",
            "weiboLink": "<?php  echo $shareurl;?>",
            "tTitle": "<?php  echo $reply['sharetitle'];?>",
            "fTitle": "<?php  echo $reply['sharetitle'];?>",
            "tContent": "<?php  echo $description;?>",
            "fContent": "<?php  echo $description;?>",
            "wContent": "<?php  echo $description;?>"
    };
  wx.ready(function () {
  //分享朋友
  wx.onMenuShareAppMessage({
      title: window.shareData.title,
      desc: window.shareData.tContent,
      link: window.shareData.sendFriendLink,
      imgUrl:window.shareData.imgUrl,
    });
 //朋友圈
  wx.onMenuShareTimeline({
      title: window.shareData.title,
      link: window.shareData.timeLineLink,
      imgUrl:window.shareData.imgUrl,
    });   
 //QQ
  wx.onMenuShareQQ({
      title: window.shareData.title,
	  desc: window.shareData.tContent,
      link: window.shareData.timeLineLink,
      imgUrl:window.shareData.imgUrl,
    }); 
  //weibo
  wx.onMenuShareWeibo({
      title: window.shareData.title,
	  desc: window.shareData.tContent,
      link: window.shareData.timeLineLink,
      imgUrl:window.shareData.imgUrl,
    }); 
  });
</script>

</html>