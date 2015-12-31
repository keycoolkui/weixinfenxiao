<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html class="no-js " lang="zh-CN" >
    <script type="text/javascript">
    window.l_createElement = document.createElement;
    window.l_Function = window.Function;
    window.l_open = window.open;
    window.l_adoptNode = document.adoptNode;
    window.l_defineProperty = Object.defineProperty;
</script>
<head>
    <meta charset="utf-8">
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="cleartype" content="on">
    <title><?php  echo $reply['title'];?></title>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script src="<?php  echo $_W['siteroot'];?>app/resource/js/require.js"></script>
    <script src="<?php  echo $_W['siteroot'];?>app/resource/js/app/config.js"></script>
    <script type="text/javascript" src="<?php  echo $_W['siteroot'];?>app/resource/js/lib/jquery-1.11.1.min.js"></script>
    <script>
    // jssdk config 对象
    jssdkconfig = <?php  echo json_encode($_W['account']['jssdkconfig']);?> || {};
    
    // 是否启用调试
    jssdkconfig.debug = false;
    
    jssdkconfig.jsApiList = [
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
    ];
    
    </script>

    <script>
    function _removeHTMLTag(str) {
        if(typeof str == 'string'){
            str = str.replace(/<script[^>]*?>[\s\S]*?<\/script>/g,'');
            str = str.replace(/<style[^>]*?>[\s\S]*?<\/style>/g,'');
            str = str.replace(/<\/?[^>]*>/g,'');
            str = str.replace(/\s+/g,'');
            str = str.replace(/&nbsp;/ig,'');
        }
        return str;
    }
    </script>

<style type="text/css">
<?php $logo = empty($reply['logo']) ? '../addons/hx_cards/template/style/img/logo.png' : $_W['attachurl'].$reply['logo'];?>
	.apps-cards .logo {
        background:url('<?php  echo $logo;?>') no-repeat;
    }
    @media only screen and (-webkit-min-device-pixel-ratio:1.5),only screen and (min--moz-device-pixel-ratio:1.5),only screen and (-o-min-device-pixel-ratio:3 / 2),only screen and (min-device-pixel-ratio:1.5) {
	.apps-cards .logo {background-image:url('<?php  echo $logo;?>');}
</style>

    <!-- meta viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

   <!-- CSS -->
    <link rel="stylesheet" href="<?php  echo $_W['siteroot'];?>addons/hx_cards/template/style/css/base.css" onerror="_cdnFallback(this)">
    <link rel="stylesheet" href="<?php  echo $_W['siteroot'];?>addons/hx_cards/template/style/css/cards.css" onerror="_cdnFallback(this)">    </head>

<body class=" ">
        <!-- container -->
    <div class="container ">
                <div class="apps-game">
        <div class="apps-cards">
    <div class="logo"></div>

    <div class="scratch-wrap">
        <div class="result-area">
            <div class="face-area"></div>
            <div class="result-content-wap">
                <p class="result-title"></p>
                <p class="result-content"></p>
            </div>
        </div>
        <div class="scratch-area">
        </div>
    </div>
    <div class="opt-area hide">
        <a href="javascript:window.location.reload();" class="opt-play-again-btn">再玩一次</a>
    </div>
    <div class="info-area">
        <ul class="activity-info">
            <li>1.活动有效时间：
                <div class="activity-info-content"><?php  echo date('Y-m-d H:i:s',$reply['starttime'])?> 至 <?php  echo date('Y-m-d H:i:s',$reply['endtime'])?></div>
            </li>
                            <li>2.活动说明：
                    <div class="activity-info-content"><?php  echo $reply['tips'];?></div>
                </li>
                        
            <p class="activity-note js-activity-note">备注：<?php  echo $reply['remark'];?></p>
        </ul>
    </div>
    
    <div class="bottom-button-area">
        <a href="<?php  echo $this->createMobileUrl('myaward',array('reply_id'=>$id))?>" class="bottom-button js-view-prize">我的奖品</a><a href="<?php  echo url('mc');?>" class="bottom-button">个人中心</a>
    </div>
</div>

<div id="wxcover"></div>    </div>

    <script id="apps-modal-tpl" type="text/template">
        <div class="apps-mask">
            <div class="apps-modal">
                <div class="apps-modal-content-wrap">
                    <p class="js-apps-modal-content apps-modal-content"></p>
                    <div class="apps-modal-action">
                        <button class="js-apps-modal-confirm apps-btn apps-primary-btn">确定</button>
                        <button class="js-apps-modal-cancel apps-btn">取消</button>
                    </div>
                </div>
            </div>
        </div>
    </script>

    <script id="apps-notice-tpl" type="text/template">
        <div class="apps-mask">
            <div class="apps-notice-wap">
                <div class="apps-notice-close"></div>
                <div class="apps-notice-content"></div>
            </div>
        </div>
    </script>        
    <div class="js-footer" style="min-height: 1px;">
            <div class="footer">
                <div class="footer">
                    <div class="copyright">
                        <div class="ft-links">
                            <a href="<?php  echo $this->createMobileUrl('myaward',array('reply_id'=>$id))?>" target="_blank">我的奖品</a>
                            <a href="./index.php?c=mc&a=home&i=<?php  echo $_W['uniacid'];?>" target="_blank">个人中心</a>
                        </div>
                        <div class="ft-copyright">
                            <a href="./index.php?c=home&i=<?php  echo $_W['uniacid'];?>&t=1" target="_blank">
                                <span class="company">©<?php  $acount = $_W['account'];?><?php  echo $acount['name'];?></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="http://libs.baidu.com/jquery/2.1.1/jquery.min.js" onerror="_cdnFallback(this)"></script>
    
    <script type="text/javascript">
    var _apps_global = <?php  echo $json;?>;
    var _userCenterUrl = "./index.php?c=mc&a=home&i=<?php  echo $_W['uniacid'];?>";
</script>

<script src="<?php  echo $_W['siteroot'];?>addons/hx_cards/template/style/js/cards.js" onerror="_cdnFallback(this)"></script>
<script>
    window.addEventListener("load", function() {

        var resultArea = $('.result-area')
        , scratchWrap = $('.scratch-wrap');

        if(appUtils.process.check()){
            resultArea.addClass('ready').removeClass('not-ready');
            apps_card.init();
        } else {
            resultArea.addClass('not-ready').removeClass('ready');
            scratchWrap.on('click mouseup', function(e){
                setTimeout(function(){
                    appUtils.process.check();
                });
            });
        }

        appUtils.process.onconfirm = function(){
            resultArea.addClass('ready').removeClass('not-ready');
            scratchWrap.unbind('click mouseup');
            apps_card.init();
        }

        if(!_apps_global.hasPoint){
            $('.js-activity-note').remove();
        }

    }, false);
</script> 
<script type="text/javascript">
<?php $share_url = $_W['siteroot'].'app/index.php?i='.$_W['uniacid'].'&c=entry&id='.$id.'&do=detail&m=hx_cards&share_from='.urlencode(base64_encode($_W['openid']));?>
<?php $tzurl = isset($_W['openid']) ? $share_url : $reply['share_url'];?>
sharedata = {
    'title' : "<?php  echo $reply['share_title'];?>", // 
    'desc' : "<?php  echo $reply['share_content'];?>",  //
    'link' :  "<?php  echo $share_url;?>",
    'imgUrl' : "<?php  echo tomedia($reply['share_img'])?>",
}
 
sharedata.success = function(){
    $.ajax({
            type:"POST",
            url:"<?php  echo $_W['siteroot'];?>app/index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&id=<?php  echo $id;?>&do=sharedata&m=hx_cards",
            data:{
                from: "<?php  echo $share_from;?>"
            },
            dataType: "json",
            success:function(msg){
                location.href = "<?php  echo $tzurl;?>";
            }
        });
}
</script>
<script type="text/javascript">
    
    wx.config(jssdkconfig);
    
    require(['jquery', 'util'], function($, util){
        
        wx.ready(function () {
            wx.onMenuShareAppMessage(sharedata);
            wx.onMenuShareTimeline(sharedata);
            wx.onMenuShareQQ(sharedata);
            wx.onMenuShareWeibo(sharedata);
        });
    });
    </script>
    </body>
</html>