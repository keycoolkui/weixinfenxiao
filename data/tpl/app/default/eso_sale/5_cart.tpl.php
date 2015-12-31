<?php defined('IN_IA') or exit('Access Denied');?><?php  $bootstrap_type = 3;?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('header', TEMPLATE_INCLUDEPATH)) : (include template('header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<script type="text/javascript" src="../addons/eso_sale/images/jquery.gcjs.js"></script>
<link type="text/css" rel="stylesheet" href="../addons/eso_sale/images/style.css">
<link href="../addons/eso_sale/recouse/css/xin_v3.s.min.css" rel="stylesheet" type="text/css" />

<style>
    .shopcart-footer{margin-bottom:30px;}
</style>
<div class="head">
    <a href="javascript:history.back();" class="bn pull-left"><i class="fa fa-angle-left"></i></a>
    <span class="title">购物车</span>
    <a href="javascript:void(0)" onclick="clearCart()" class="bn pull-right" style="font-size:18px;"><i class="fa fa-trash"></i> 清空</a>
</div>
<div class="shopcart-main img-rounded" style="margin-top:50px">
    <!--	<div class="shopcart-hd">
            <span class="pull-left"><?php  if(empty($_W['account']['name'])) { ?>微赞团队<?php  } else { ?><?php  echo $_W['account']['name'];?><?php  } ?>»</span>
            <a class="pull-right icon-remove-sign" href="<?php  echo $this->mturl('clear');?>" onclick="return confirm('此操作不可恢复，确认？'); return false;"></a>
        </div>-->
    <div style='text-align:center;padding:50px 0 50px 0; <?php  if(count($list)>0) { ?>display:none<?php  } ?>' id='cartempty'>
        <img src='../addons/eso_sale/images/icon_cart_empty.png' /><br/><br/>
        <span style='color:#adadad'>您的购物车空空如也，赶紧去选购吧~~</span>
    </div>

    <?php  if(is_array($list)) { foreach($list as $item) { ?>
    <?php  $price += $item['totalprice'];?>

    <?php  $goods = $item['goods']?>
    <span id="stock_<?php  echo $item['id'];?>" style='display:none'><?php  echo $goods['total'];?></span>
    <div class="shopcart-item clearfix" id='item_<?php  echo $item['id'];?>' style='height:<?php  if(!empty($goods['optionname'])) { ?>140px;<?php  } else { ?>120px<?php  } ?>'>
        <img src="<?php  echo $_W['attachurl'];?><?php  echo $goods['thumb'];?>">
        <div class="shopcart-item-detail">
            <div class="name"><?php  echo $goods['title'];?><?php  if($goods['unit']) { ?><?php  } ?></div>
            <?php  if(!empty($goods['optionname'])) { ?><div class="price">规格：<span><?php  echo $goods['optionname'];?></span></div><?php  } ?>

            <div class="price">单价：<span id="singleprice_<?php  echo $item['id'];?>"><?php  echo $goods['marketprice'];?></span> 元<?php  if(!empty($goods['unit'])) { ?> / <?php  echo $goods['unit'];?><?php  } ?></div>
            <div class="price">小计：<span class='singletotalprice' id="goodsprice_<?php  echo $item['id'];?>"><?php  echo $item['totalprice'];?></span> 元</div>
            <div class="input-group">
                    <span class="input-group-btn">
                        <button class="btn btn-default btn-sm" type="button" onclick="reduceNum(<?php  echo $item['id'];?>)"><i class="fa fa-minus"></i></button>
                    </span>
                <input type="tel" class="form-control input-sm pricetotal goodsnum" value="<?php  echo $item['total'];?>" price="<?php  echo $goods['marketprice'];?>" pricetotal="<?php  echo $item['totalprice'];?>" id="goodsnum_<?php  echo $item['id'];?>" cartid='<?php  echo $item['id'];?>' maxbuy="<?php  echo $goods['maxbuy'];?>" />
                    <span class="input-group-btn">
                        <button class="btn btn-default btn-sm" type="button" onclick="addNum(<?php  echo $item['id'];?>,<?php  echo $goods['maxbuy'];?>)"><i class="fa fa-plus"></i></button>
                    </span>
            </div>
        </div>
        <a href="javascript:;" onclick="removeCart(<?php  echo $item['id'];?>)" class="shopcart-item-remove"><i class="icon-remove"></i> 删除</a>
    </div>

<?php  $n++;?>
<?php  } } ?>
</div>
<div id='cartfooter' class="shopcart-footer" <?php  if(count($list)<=0) { ?>style='display:none'<?php  } else { ?> style='margin-bottom: 12px;'  <?php  } ?>'>
<span class="pull-left">合计：<span id="pricetotal"><?php  echo $price;?></span> 元</span>
<a href="<?php  echo $this->mturl('confirm')?>" class="btn btn-success pull-right">立即结算</a>
</div>
</div>


<script type="text/javascript">
    $(function(){
        $(".goodsnum").blur(function(){
            var id = $(this).attr("cartid");
            if($(this).isInt()){
                var num = parseInt( $("#goodsnum_" + id).val() );
                var maxbuy = parseInt( $(this).attr("maxbuy") );
                var mb = maxbuy;
                var stock =$("#stock_" + id).html()==''?-1:parseInt($("#stock_" + id).html());
                if(mb>stock && stock!=-1){
                    mb = stock;
                }

                if(num>mb && mb>0){
                    tip("最多只能购买 " + mb + " 件!",true);
                    $("#goodsnum_" + id).val(mb);
                    return;
                }
                updateCart(id,num);
            }
            else{
                $(this).val("1");
                updateCart(id,1);
            }

        })

    })
    function clearCart(){
        if (confirm('确定要清空购物车吗？')) {
            tip("正在处理数据...");
            $.getJSON('<?php  echo $this->mturl('mycart',array('op'=>'clear'));?>', function(s){
                $(".shopcart-item").remove();
                $("#cartempty").show();
                $("#cartfooter").hide();
                tip_close();
            });
        }
    }
    function removeCart(id){
        if (confirm('您确定要删除此商品吗？')) {
            tip("正在处理数据...");
            var url  = '<?php  echo $this->mturl('mycart', array('op'=>'remove'))?>' + "&id=" + id;
            $.getJSON(url, function(s){
                $("#item_" + s.cartid).remove();
                if($(".shopcart-item").length<=0){
                    $("#cartempty").show();
                    $("#cartfooter").hide();
                }
                tip_close();
                canculate();
            });
        }
    }
    function updateCart(id,num){

        var url  = '<?php  echo $this->mturl('mycart', array('op'=>'update'))?>' + "&id=" + id+"&num=" + num;
        $.getJSON(url, function(s){

        });
    }
    function checkMaxBuy(id, maxbuy){


    }
    function addNum(id,maxbuy){
        var mb = maxbuy;
        var stock =$("#stock_" + id).html()==''?-1:parseInt($("#stock_" + id).html());
        if(mb>stock && stock!=-1){
            mb = stock;
        }

        var num = parseInt( $("#goodsnum_" + id).val() ) + 1;
        if(num>mb && mb>0){
            tip("最多只能购买 " + mb + " 件!",true);
            return;
        }
        $("#goodsnum_" + id).val(num);
        var price = parseFloat( $("#singleprice_"+id).html() ) * num;
        $("#goodsprice_" + id).html(price);
        canculate();
        updateCart(id,num);
    }
    function reduceNum(id){
        var num = parseInt( $("#goodsnum_" + id).val() );
        if(num-1<=0){
            return;
        }
        num--;
        $("#goodsnum_" + id).val(num);
        var price = parseFloat( $("#singleprice_"+id).html() ) * num;
        $("#goodsprice_" + id).html(price);
        canculate();
        updateCart(id,num);
    }
    function canculate(){
        var total = 0;
        $(".singletotalprice").each(function(){

            total+=parseFloat( $(this).html() );
        });

        $("#pricetotal").html(total);
    }
</script>


<div class="wx_nav"><a href="<?php  echo $this->mturl('list')?>" data-href="###" ptag="37080.1.1" class="nav_index">首页</a><a href="<?php  echo $this->mturl('listCategory')?>"  ptag="37080.1.2" class="nav_search" style="display:">分类</a><a href="<?php  echo $this->mturl('mycart')?>"  ptag="37080.1.3" class="nav_shopcart on">购物车</a><a href="<?php  echo $this->mturl('myorder')?>"  ptag="37080.1.4" class="nav_me">我的订单</a>
<!--<a href="<?php  echo $ydyy;?>"  ptag="37080.1.4" class="nav_fav">一键关注</a>-->
<a href="<?php  echo $this->mturl('fansindex')?>"  ptag="37080.1.4" class="nav_fav">会员中心</a>
</div>

<script src="../addons/eso_sale/recouse/js/zepto.min.js" type="text/javascript"></script>
<script type="text/javascript">
    //获取指定cookes函数
    function getCookie(name) {
        var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
        if (arr = document.cookie.match(reg))
            return unescape(arr[2]);
        else
            return null;
    }
</script>
</body>
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
</html>