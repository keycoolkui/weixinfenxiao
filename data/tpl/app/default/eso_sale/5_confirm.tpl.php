<?php defined('IN_IA') or exit('Access Denied');?><?php  $bootstrap_type = 3;?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('header', TEMPLATE_INCLUDEPATH)) : (include template('header', TEMPLATE_INCLUDEPATH));?>
<link type="text/css" rel="stylesheet" href="../addons/eso_sale/images/style.css">

<div class="head">
    <a href="javascript:history.back();" class="bn pull-left"><i class="fa fa-angle-left"></i></a>
    <span class="title">结算</span>
</div>
<form class="form-horizontal" method="post" role="form" onsubmit='return check()'>
    <input type="hidden" name="goodstype" value="<?php  echo $goodstype;?>" />
    <input type="hidden" name="address" value="<?php  echo $row['id'];?>" />
    <div class="order-main">
        <h5>收货地址</h5>
        <div id="myaddress">
            <?php  if(!empty($row)) { ?>
            <div id='address_<?php  echo $row['id'];?>' class="shopcart-main img-rounded address_item" style='margin:0;padding:10px;margin-bottom:10px;cursor:pointer' onclick='changeAddress()'>
            <span><?php  echo $row['province'];?> <?php  echo $row['city'];?> <?php  echo $row['area'];?> <?php  echo $row['address'];?> <br/> <?php  echo $row['realname'];?>, <?php  echo $row['mobile'];?></span>
              <span style='float:right'>
                  &nbsp;&nbsp;<a href="<?php  echo $this->mturl('address',array('from'=>'confirm','returnurl'=>urlencode($returnurl)))?>">管理收货地址</a></span>
        </div>
        <?php  } else { ?>
        <div><button type="button" class="btn btn-danger" onclick="location.href='<?php  echo $this->mturl('address',array('from'=>'confirm','returnurl'=>urlencode($returnurl)))?>'"><i class="icon-plus"></i> 添加修改地址</button></div>
        <?php  } ?>
    </div>
    <h5>配送方式</h5>
    <select id='dispatch' name="dispatch" class="form-control">

        <?php  if(is_array($dispatch)) { foreach($dispatch as $d) { ?>
        <option value="<?php  echo $d['id'];?>" price='<?php  echo $d['price'];?>'><?php  echo $d['dispatchname'];?> (<?php  echo $d['price'];?>元)</option>
        <?php  } } ?>

    </select>
    <h5>订单详情</h5>
    <div class="order-detail">
        <table class="table">
            <thead>
            <tr>
                <th class="name">商品</th>
                <th class="num">数量</th>
                <th class="total">合计</th>
            </tr>
            </thead>
            <tbody>
            <?php  if(is_array($allgoods)) { foreach($allgoods as $item) { ?>
            <tr>
                <td class="name"><span  style="float:left;"><a href='<?php  echo $this->mturl('detail',array('id'=>$item['id']))?>'>
                                                                                   <?php  echo $item['title'];?>         </a>
                    <?php  if(!empty($item['optionname'])) { ?><br/><span style='font-size:12px;color:#666'> <?php  echo $item['optionname'];?></span><?php  } ?>
                               </span></td>
                <td class="num"><?php  echo $item['total'];?><?php  if(!empty($item['unit'])) { ?><?php  echo $item['unit'];?><?php  } ?></td>
                <td class="total"><span class='goodsprice'><?php  echo $item['totalprice'];?> 元</span></td>
            </tr>
            <?php  } } ?>
            </tbody>
        </table>
        <div class="order-detail-hd"> <span class="pull-right" style="color:#E74C3C;">
                    [合计：<span id='totalprice'><?php  echo $totalprice;?></span>]</span></div>
        <div style="clear:both;"></div>
    </div>
    <h5>留言</h5>
    <div class="message-box">
        <textarea class="form-control" rows="3" name="remark" placeholder="亲，还用什么能帮助到您吗？就写到这里吧！"></textarea>
    </div>
    <button type="submit" name="submit" value="yes" class="btn btn-success order-submit btn-lg" style="margin-bottom:20px;">提交订单</button>
    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
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

        function changeAddress(){
            location.href = '<?php  echo $this->mturl('address', array('from'=>'confirm','returnurl'=>urlencode($returnurl)))?>'
        }
        function check(){
            if((".address_item").length<=0){
                alert("请添加收货地址!");
                return false;
            }
            return true;
        }
        $("#dispatch").change(canculate);
        function canculate(){
            var price = 0;
            $(".goodsprice").each(function(){
                price+=parseFloat($(this).html());
            });
            var dispatchprice = parseFloat($("#dispatch").find("option:selected").attr("price"));
            if(dispatchprice>0){
                $("#totalprice").html(price + dispatchprice + " 元 (含运费"+dispatchprice + ")");
            }
            else{
                $("#totalprice").html(price + " 元");
            }

        }
        $(function(){
            canculate();
        })
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
</form>
</body>
<?php 
    require_once IA_ROOT."/addons/eso_sale/jssdk.class.php";
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