<?php defined('IN_IA') or exit('Access Denied');?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta content="telephone=no" name="format-detection" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="viewport" content="width=320, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="apple-touch-icon-precomposed" href="../addons/eso_sale/recouse/images/apple-touch-icon.png"/>
    <title><?php  echo $goods['title'];?></title>
    <link rel='stylesheet' type='text/css' href='../addons/eso_sale/recouse/css/product-intro.css?ver=55e4' />
    <link href="../addons/eso_sale/recouse/css/reset.css" rel="stylesheet" type="text/css" />
    <link href="../addons/eso_sale/recouse/css/head.css" rel="stylesheet" type="text/css" />
    <link href="../addons/eso_sale/recouse/css/home.css" rel="stylesheet" type="text/css" />
    <link href="../addons/eso_sale/recouse/css/foot.css" rel="stylesheet" type="text/css" />
    <link href="../addons/eso_sale/recouse/css/style.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="../addons/eso_sale/recouse/css/xmapp.css"/>
    <link href="../addons/eso_sale/recouse/css/xin_v3.s.min.css" rel="stylesheet" type="text/css" />
    <script src="../addons/eso_sale/recouse/js/jquery-1.6.2.min.js" type="text/javascript"></script>
    <script src="../addons/eso_sale/recouse/js/jquery.json.js" type="text/javascript"></script>
    <script type="text/javascript" src="../addons/eso_sale/recouse/js/common.js"></script><script type="text/javascript" src="../addons/eso_sale/recouse/js/transport.js"></script><script type="text/javascript" src="../addons/eso_sale/recouse/js/utils.js"></script><script type="text/javascript" src="../addons/eso_sale/recouse/js/fbi.js"></script>
    <script type="text/javascript">
        var _hmt=_hmt||[];(function(){var e=document.createElement("script");
            var t=document.getElementsByTagName("script")[0];t.parentNode.insertBefore(e,t)})();
        document.write('<div id="global_loading" style="width: 100%;height: 100%;position: fixed;top: 0;left: 0;background-color: #eee;z-index:999"><div style="width: 100px;height: 75px;margin:auto;top:50%;position:relative"><span style="display:block;float:left;width:32px;height:32px;background:url(../addons/eso_sale/recouse/images/spacer.gif);margin-top:-5px;"></span>&nbsp;&nbsp;加载中...</div></div>');
    </script>

</head>
<body>
<style>
.focus .bd li img {
    width: 60%;}
</style>



<div class="main">
<style type='text/css'>
    #poptip { position: fixed; top:40%;left:50%;width:160px;margin-left:-80px;height: 27px;background:#000; opacity: 0.7;filter:alpha(opacity=0.7); color:#fff;z-index: 999;  border-radius:5px;
        -webkit-border-radius:5px;
        -moz-border-radius:5px;}
    #poptip_content { position: fixed; top:40%;left:50%;width:160px;margin-left:-80px; height: 27px; color:#fff;text-align:center;font-size:14px;z-index: 9909}
</style>

<section class="sp">
<div class="product-intro">

<div id="cont_show">
<script type="text/javascript" src="../addons/eso_sale/recouse/js/jquery.flexslider-min.js"></script>
<script type="text/javascript">
    $(function() {
        $('.flexslider').flexslider({
            animation: "slide",
            slideDirection: "horizontal"
        });
        $("#btn_continue").click(function(){
            $("#buy_lay").hide();
            $("#buy_lay_frm").hide();
        });
        $("#btn_check").click(function(){
            window.location='cart.php';
        });
        $(document).bind("click",function(){
            $("#buy_lay").hide();
            $("#buy_lay_frm").hide();
        });
    });
</script>
<script type="text/javascript">
    var $$ = function (obj) {
        if (obj != null && obj != undefined && obj.toString().length > 0) {
            if (obj[0] == '#') {
                return document.getElementById(obj.substr(1, obj.length - 1));
            }
        }
    }
    function chgNum(a) {
        var number = $$("#total");
        var p = parseInt(number.value);
        if (a == 1) {
            if (p < 1038) number.value = ++p;
        }
        else {
            if (p > 1) number.value = --p;
        }
    }
</script>
<link href="../addons/eso_sale/recouse/css/flexslider.css" rel="stylesheet" type="text/css" />
<div id="viewport" class="viewport">

    <div class="show">
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
                        <?php  if(is_array($piclist)) { foreach($piclist as $row) { ?>
                        <li style="text-align:center;list-style: none;">
                            <a href="<?php  echo $_W['attachurl'];?><?php  echo $row;?>" rel='<?php  echo $_W['attachurl'];?><?php  echo $row;?>'>
                            <img src="<?php  echo $_W['attachurl'];?><?php  echo $row;?>" alt="" height="200px" style=""/>
                            </a>
                        </li>
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
    </div>
</div>

<div class="pro-info">
    <p class="pro-name"><strong><?php  echo $goods['title'];?></strong></br></p>


    <div class="price clearfix">
        <p class="jx-price">价&nbsp;&nbsp;&nbsp;格<strong style=" padding-left:15px">￥<?php  echo $marketprice;?> </strong></p>

        <?php  if($member) { ?>
        <?php  if($member['flag']==1) { ?>
        <?php  if($commission !=0) { ?>
        <p style="float:right;"><a href="<?php  echo $this->mturl('tuiguang',array('gid'=>$goods['id'],'mid'=>$member['id']))?>" >
            <img src="../addons/eso_sale/style/images/tuiguang.png"  />
        </a></p>
        <?php  } ?>
        <?php  } ?>
        <?php  } ?>

    </div>
    <?php  if($marketprice < $productprice) { ?>
    <div class="price clearfix">
        <p class="jx-pricem">市场价<strong style=" padding-left:15px;color:#BEBEBE">￥<?php  echo $productprice;?></strong></p>
    </div>
    <?php  } ?>
    <?php  if($member) { ?>
    <?php  if($member['flag']==1) { ?>
    <?php  if($commission !=0) { ?>
    <div class="price clearfix">
        <p class="jx-price">佣&nbsp;&nbsp;&nbsp;金<strong style=" padding-left:15px"><?php  echo $commission;?>%</strong></p>

    </div>
    <?php  } ?>
    <?php  } ?>
    <?php  } ?>

    <form action="javascript:addToCart(6)" method="post" name="ECS_FORMBUY" id="ECS_FORMBUY" >
        <?php  if($from_user) { ?>
        <div class="goods_number clearfix">
            <p class="name">数&nbsp;&nbsp;&nbsp;量</p>
            <div class="addForm">
                <input type="button" value="-" class="btn" onClick="chgNum(-1);" />
                <input type="text" id="total" name="number"  value="1" class="text"/>
                <input type="button" value="+" class="btn" onClick="chgNum(1);" />
            </div>
            <!--  -->
        </div>
        <?php  } ?>

        <!--  -->
        <!--  -->
        <!--  -->

    </form>

    <?php  if(is_array($params)) { foreach($params as $p) { ?>
    <div class='goods_number clearfix'>
        <p class="name"><?php  echo $p['title'];?></p>
        <span color="black"><?php  echo $p['value'];?></span>
    </div>
    <?php  } } ?>





    <?php  if($from_user) { ?>
    <div class="div_but1 clearfix" id='btn1' style="display: ;">
        <div class="buybut" onclick='buy()'>
            <a class='ljgm' name="goods_buy" >
                <i></i>
                立即购买
            </a>
        </div>
        <div class="cartbut" onclick='addtocart()'>
            <a class='add' name="goods_cart" href="javascript:void()">
                <i></i>
                加入购物车
            </a>
        </div>
    </div>
    <div class="div_but1 clearfix" id='btn2'  style="display: none;">
        <div class="buy" onclick='buy()'>
            <a class='ljgm1' name="goods_buy" >
                <i></i>
                立即购买
            </a>
        </div>
        <div class="cart" onclick='addtocart()'>
            <a class='add1' name="goods_cart" href="javascript:void()">
                <i></i>
                加入购物车
            </a>
        </div>
    </div>
    <?php  } else { ?>
    <div class="div_but1 clearfix" id='btn1' style="display: ;">
        <div class="buybut" onclick="location.href='<?php  echo $this->mturl('check');?>'">
            <a class='ljgm' name="goods_buy" >
                <i></i>
                立即关注
            </a>
        </div>
    </div>
    <?php  } ?>


</div>


<div class="active">
    <p class="tip"></p>
</div>

<div class="card card-list">


    <div style="clear:both;"></div>


    <div class="pro-detial">
        <div class="pro-intro clearfix">
            <?php  echo $goods['content'];?>

        </div>
    </div>

    <!--  -->

    <!--  -->

    <div id="buy_lay"></div>
    <div id="buy_lay_frm">
        <div class="frm">
            <div class="tips">商品已添加到购物车！</div>
            <div class="btns">
                <input id="btn_continue" class="btn" type="button" value=" 再逛会 " />
                <input id="btn_check" class="btn" type="button" value=" 去结算 " />
            </div>
        </div>
    </div>


    <script type="text/javascript" src="../addons/eso_sale/recouse/js/iscroll.js"></script>
    <script type="text/javascript">
        var myScroll;
        $(document).ready(function(){
            var w = $('.item-list ul li').length*100+'px';
            $('.item-list').width(w);
            myScroll = new iScroll('item-container', {
                snap: true,
                hScrollbar: false,
                vScrollbar: false,
                momentum:false
            });
        });
    </script>
</div>
</div>
</section>


<script type="text/javascript">
    var global_loading=document.getElementById("global_loading");
    global_loading.parentNode.removeChild(global_loading);
</script>
<script type="text/javascript">
    var addto_cart_success = "该商品已添加到购物车。";
    var goods_id = 6;
    var goodsattr_style = 1;
    var goodsId = 6;
    var now_time = 1415650474;
    onload = function(){
        //changePrice();
        try {onload_leftTime();}
        catch (e) {}
    }

</script>
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
<a href="<?php  echo $this->mturl('fansindex')?>"  ptag="37080.1.4" class="nav_fav">会员中心</a>
</div>

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
<script language='javascript'>
    function tip(msg,autoClose){
        var div = $("#poptip");
        var content =$("#poptip_content");
        if(div.length<=0){
            div = $("<div id='poptip'></div>").appendTo(document.body);
            content =$("<div id='poptip_content'>" + msg + "</div>").appendTo(document.body);
        }
        else{
            content.html(msg);
            content.show(); div.show();
        }
        if(autoClose) {
            setTimeout(function(){
                content.fadeOut(500);
                div.fadeOut(500);

            },1000);
        }
    }
    function tip_close(){
        $("#poptip").fadeOut(500);
        $("#poptip_content").fadeOut(500);
    }
</script>

<script type="text/javascript">
    //立即购买
    var hasoption = <?php echo $goods['hasoption']=='1'?'true':'false'?>;
    function buy(){
        var ret = option_selected();
        if(ret.no!=''){
            tip("请选择" + ret.no + "!",true);
            return;
        }
        var total = $("#total").val();
        location.href = '<?php  echo $this->mturl('confirm',array('id'=>$goods['id']));?>'+"&optionid=" + $("#optionid").val() + "&total=" + total;
    }
    //添加到购物车
    function addtocart(){
        var ret = option_selected();
        if(ret.no!=''){
            tip("请选择" + ret.no + "!",true);
            return;
        }
        tip("正在处理数据...");
        var total = $("#total").val();
        var url = '<?php  echo $this->mturl('mycart',array('op'=>'add','id'=>$goods['id']));?>' +"&optionid=" + $("#optionid").val() + "&total=" + total;
        $.getJSON(url, function(s){
            if(s.result==0){
                tip("只能购买 " + s.maxbuy + " 件!");
            }else{
                tip_close();
                tip("已加入购物车!");
                //alert("已加入购物车!");
                $('#globalId').css({'width':'22px', 'height':'16px', 'line-height':'16px'}).html(s.total).animate({'width':'15px', 'height':'16px', 'line-height':'20px'}, 'slow');
                $('#carId').css({'width':'22px', 'height':'16px', 'line-height':'16px'}).html(s.total).animate({'width':'15px', 'height':'16px', 'line-height':'20px'}, 'slow');
            }
        });
    }



    function option_selected(){

        var ret= {
            no: "",
            all: []
        };
        if(!hasoption){
            return ret;
        }
        $(".optionid").each(function(){
            ret.all.push($(this).val());
            if($(this).val()==''){
                ret.no = $(this).attr("title");
                return false;
            }
        })
        return ret;
    }
</script>
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
</div>
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