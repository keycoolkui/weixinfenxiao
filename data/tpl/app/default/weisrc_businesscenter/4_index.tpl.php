<?php defined('IN_IA') or exit('Access Denied');?>﻿<!DOCTYPE html>
<html>
	<head>
		<title><?php  echo $title;?></title>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
        <meta name="author" content="For Memory For Joel,Mailto:15595755@qq.com"/>
		<meta name="keywords" content=""/>
		<meta name="description" content=""/>
        <!--viewport 等比 不缩放-->
		<meta http-equiv="cleartype" content="on">
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <!--页面不缓存-->
        <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link rel="stylesheet" type="text/css" href="<?php echo RES;?>/themes/dist/css/font.css" />
        <!--Wap前端GMU样式-->
        <link rel="stylesheet" type="text/css" href="<?php echo RES;?>/themes/css/gmu.css" />
        <!--Wap前端GMU重置样式-->
        <link rel="stylesheet" type="text/css" href="<?php echo RES;?>/themes/css/Joel-basegmu.css" />
        <!--Wap前端Zepto函数库1.0-->
        <script type="text/javascript" charset="utf-8" src="<?php echo RES;?>/themes/js/zepto.min.js"></script>
        <!--Wap前端Joel公共封装函数库-针对ZEPTO-->
        <script type="text/javascript" charset="utf-8" src="<?php echo RES;?>/themes/js/Joel-baseapi.js"></script>
        <!--Wap前端Joel公共函数-->
        <script type="text/javascript" charset="utf-8" src="<?php echo RES;?>/themes/js/Joel-base.js"></script>
        <!--Wap前端Joel-Gmu公共函数库-->
        <script type="text/javascript" charset="utf-8" src="<?php echo RES;?>/themes/js/gmu.min.js"></script>
        <!--Wap前端Joel-Gmu公共函数库-针对Gmu-->
        <script type="text/javascript" charset="utf-8" src="<?php echo RES;?>/themes/js/Joel-basegmu.js"></script>
		<script type="text/javascript" charset="utf-8" src="<?php echo RES;?>/themes/js/iscroll.js"></script>
		<script type="text/javascript" src="<?php echo RES;?>/themes/js/imglazyload.js"></script>
        <style>
        html, body {
            font-family: Microsoft YaHei, Helvitica, Verdana, Tohoma, Arial, san-serif;
            font-size: 16px;
            margin: 0;
            padding: 0;
            text-decoration: none;
        }

        body, div, dl, dt, dd, ul, ol, li, h1, h2, h3, h4, h5, h6, pre, code, form, fieldset, legend, input, textarea, p, blockquote, th, td {
            margin: 0;
            padding: 0;
        }

        body {
            width: 100%;
            max-width: 720px;
            margin: 0 auto;
        }

        img {
            border: 0;
        }

        ol, ul, li {
            list-style: none outside none;
            margin: 0;
            padding: 0;
        }

        b, em, i {
            font-style: normal;
        }

            /*a {color:#000000;text-decoration: none;}*/
        a {
            color: #A39370;
            text-decoration: none;
        }

        .fl {
            float: left;
            display: inline;
        }

        .fr {
            float: right;
            display: inline;
        }

        .clr {
            clear: both;
        }

        @font-face {
            font-family: 'Glyphicons Halflings';
            src: url('<?php echo RES;?>/themes/images/img/glyphicons-halflings-regular.eot');
            src: url('<?php echo RES;?>/themes/images/img/glyphicons-halflings-regular01.eot') format('embedded-opentype'), url('<?php echo RES;?>/themes/images/img/glyphicons-halflings-regular.woff') format('woff'), url('<?php echo RES;?>/themes/images/img/glyphicons-halflings-regular.ttf') format('truetype'), url('<?php echo RES;?>/themes/images/img/glyphicons-halflings-regular.svg') format('svg');
        }

        @font-face {
            font-family: 'fontello';
            src: url('<?php echo RES;?>/themes/images/img/fontello.eot');
            src: url('<?php echo RES;?>/themes/images/img/fontello01.eot') format('embedded-opentype'), url('<?php echo RES;?>/themes/images/img/fontello.woff') format('woff'), url('<?php echo RES;?>/themes/images/img/fontello.ttf') format('truetype'), url('<?php echo RES;?>/themes/images/img/fontello.svg') format('svg');
            font-weight: normal;
            font-style: normal;
        }

            /*****字体图标样式******/
        @font-face {
            font-family: 'iconfont';
            src: url('<?php echo RES;?>/themes/images/img/iconfont.eot'); /* IE9*/src: url('<?php echo RES;?>/themes/images/img/iconfont01.eot') format('embedded-opentype'), /* IE6-IE8 */ url('<?php echo RES;?>/themes/images/img/iconfont.woff') format('woff'), /* chrome、firefox */ url('<?php echo RES;?>/themes/images/img/iconfont.ttf') format('truetype'), /* chrome、firefox、opera、Safari, Android, iOS 4.2+*/ url('<?php echo RES;?>/themes/images/img/iconfont.svg') format('svg'); /* iOS 4.1- */
        }

        .iconfont {
            font-family: "iconfont" !important;
            font-style: normal;
            -webkit-font-smoothing: antialiased;
            -webkit-text-stroke-width: 0.2px;
            -moz-osx-font-smoothing: grayscale;
        }

        .glyphicon {
            display: inline-block;
            font-family: 'Glyphicons Halflings';
            -webkit-font-smoothing: antialiased;
            font-style: normal;
            font-weight: normal;
            -moz-osx-font-smoothing: grayscale;
            color: #767676;
        }

        .glyphicon-pencil:before {
            content: "\270f";
        }

        .glyphicon-list-alt:before {
            content: "\e032";
        }

        .glyphicon-user:before {
            content: "\e008";
        }

        .glyphicon-credit-card:before {
            content: "\e177";
        }

        .glyphicon-map-marker:before {
            content: "\e062";
        }

        .glyphicon-chevron-right:before {
            content: "\e080";
            line-height: 40px;
        }

        .glyphicon-log-out:before {
            content: "\e163";
        }

        [class^="icon-"]:before, [class*=" icon-"]:before {
            font-family: "fontello";
            font-style: normal;
            font-weight: normal;
            speak: none;

            display: inline-block;
            text-decoration: inherit;
            width: 1em;
            margin-right: .2em;
            text-align: center;
            /* opacity: .8; */

            /* For safety - reset parent styles, that can break glyph codes*/
            font-variant: normal;
            text-transform: none;

            /* fix buttons height, for twitter bootstrap */
            line-height: 1em;

            /* Animation center compensation - margins should be symmetric */
            /* remove if not needed */
            margin-left: .2em;

            /* you can be more comfortable with increased icons size */
            /* font-size: 120%; */

            /* Uncomment for 3D effect */
            /* text-shadow: 1px 1px 1px rgba(127, 127, 127, 0.3); */
        }

        .icon-shop-1:before {
            content: '\ef84';
        }

            /* '' */

            /*J-album样式*/
        #J-album {
            margin: 0 auto;
            /*background-color: #FFFFFF;*/
            width: 100%;
            overflow: hidden;
        }

        #J-album-wp {
            width: 100%;
            margin: 0 auto;
            height: auto;

            overflow: hidden;
            z-index: 1;
        }

        .scroller {
            height: auto;
            overflow: hidden;
        }

        .scroller ul {
            display: block;

            overflow: hidden;
            height: auto;
            margin: auto;
            padding: 0;
            text-align: center;
        }

        .scroller li {
            width: auto;
            height: auto;
            display: block;
            float: left;
            text-align: center;
        }

        #J-album-nav {
            float: right;
            right: 3%;
            margin-top: -20px;
            padding: 0;
            position: relative;
            width: auto;
            z-index: 3;
        }

        #indicator > li {
            display: block;
            float: left;
            list-style: none;
        }

        #indicator {
            display: block;
            margin: 0 8px;
            padding: 0;
            width: auto;
        }

        #indicator > li {
            text-indent: -9999em;
            width: 8px;
            height: 8px;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            background: #888;
            overflow: hidden;
            margin-right: 4px;
        }

        #indicator > li.active {
            background: #DDDDDD;
        }

        #indicator > li:last-child {
            margin: 0;
        }

            /******微商圈首页*******/
        #wsq_index {
            /*background: #fcfbf9;*/
            background: #f9f9f9;

        }

        .tit {
            line-height: 40px;
            background: url(<?php echo RES;?>/themes/images/img/i_bg_2.png) repeat-x;
            padding: 0 10px;
            font-size: 1em;
            color: #6b4015;
            position: relative;
            height: 40px;
            overflow: hidden;
        }

        .tit a {
            display: block;
            color: #ffa625;
            font-weight: 300;
            padding-right: 5px;
        }

        .arrow {
            border-bottom: 8px solid #fcfbf9;
            border-left: 8px solid rgba(252, 251, 249, 0);
            border-right: 8px solid rgba(252, 251, 249, 0);
            bottom: 0;
            height: 0;
            left: 30px;
            position: absolute;
            width: 0;
            z-index: 10;
        }

        .wapper {
            margin-bottom: 10px;
        }

        .hot_list, .sj_list, .all_list {
            overflow: hidden;
            padding: 10px 5px 0 5px;
        }

        .hot_list li {
            float: left;
            width: 25%;
            text-align: center;
            margin-bottom: 5px;
        }

        .hot_list li img {
            width: 78%;
            max-width: 120px;
            border-radius: 5px;
            box-shadow: 1px 1px 2px #898383;
        }

        .hot_list li p, .all_list li p {
            font-size: 0.9em;
            color: #8b5c2d;
            line-height: 20px;
        }

        .hot_list1 {
            overflow: hidden;
            /*padding: 0px 5px 0 12px;*/
            width: 100%;
            display: -webkit-box;
            line-height: 36px;
        }

        .hot_list1 li {
            /*margin: 0;*/
            /*margin-right: 10px;*/
            /*padding: 0 10 0 10;*/
            width: 33.333%;
            text-align: center;
        }

        .hot_list1 li a {
            /*color: #A39370;*/
            color: #fff;
            font-size: 16px;
            text-align: center;
            margin: 0 auto;
            /*background: #B2F6FF;*/
            background: #F1C411;
            border-radius: 5px;
            box-shadow: 1px 1px 2px #968989;
            display: inline-block;
            height: 35px;
            line-height: 35px;
            width: 90%;
        }

        .hot_list1 li:first-of-type {
            /*padding-left: 10px;*/
        }

        .hot_list1 li:last-of-type {
            /*padding-right: 10px;*/
        }

        .sj_list li {
            float: left;
            width: 50%;
            text-align: center;
            margin-bottom: 10px;
            display: inline;
        }

        .sj_list li img {
            width: 93%;
            max-width: 300px;
            border-radius: 5px;
            box-shadow: 1px 1px 2px rgba(137, 131, 131, 1);
        }

        .all_list li {
            float: left;
            width: 25%;
            text-align: center;
            margin-bottom: 5px;
        }

        .all_list li img {
            max-width: 134px;
            width: 78%;
        }

        .foot {
            border-top: 1px solid #f0f0f0;
            line-height: 30px;
            font-size: 0.7em;
            text-align: center;
            /*color: #bbb;*/
            color: #f39f6c;
            background-color: #eee;
        }

        .foot a {
            color: #f39f6c;
        }

        .icon-box {
            position: fixed;
            color: #FFF;
        }

        .icon-box a {
            color: #FFF;
        }

        .icon-box a i {
            color: #FFF;
        }

        .icon-box-home {
            left: 10px;
            padding: 5px 10px;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 4px;
        }

        #speaker {
            top: 0;
            width: 100%;
            height: 40px;
            line-height: 40px;
            position: fixed;
            z-index: 980;
            /*background-color: #fffddf;*/
            background-color: #fff;
            opacity: 0.95;
            overflow: hidden;
            box-shadow: 0px 0px 2px #222;
            -webkit-box-shadow: 0px 0px 2px #222;
        }

        #s-icon {
            width: 20px;
            height: 20px;
            position: fixed;
            top: 10px;
            left: 10px;
            /*background-color: #fffddf;*/
            background-color: #fff;
            background-size: 20px;
            background-repeat: no-repeat;
            background-image: url(<?php echo RES;?>/themes/images/speaker.png);
        }

        #s-word {
            font-size: 16px;
            width: 82%;
            height: 40px;
            position: fixed;
            left: 40px;
        }

        #s-word a {
            color: #A39370;
            text-decoration: none;
        }

        #s-fork {
            width: 15px;
            height: 15px;
            position: fixed;
            top: 12px;
            right: 10px;
            background-color: #fffddf;
            background-size: 15px;
            background-repeat: no-repeat;
            background-image: url(<?php echo RES;?>/themes/images/yellowfork.png);
        }
        </style>
    </head>
    <body>
    <?php  if(!empty($setting)&&$setting['scroll_announce_enable'] == 1) { ?>
    <div id="speaker">
        <div id="s-icon"></div>
        <span id="s-word">
            <marquee behavior="scroll" scrollamount="<?php  if(empty($setting) || $setting['scroll_announce_speed']==0) { ?>6<?php  } else { ?><?php  echo $setting['scroll_announce_speed'];?><?php  } ?>" direction="left" width="100%">
                <a href="<?php  if(!empty($setting['scroll_announce_link'])) { ?><?php  echo $setting['scroll_announce_link'];?><?php  } else { ?>#<?php  } ?>">
                    <?php  echo $setting['scroll_announce'];?>
                </a>
            </marquee>
        </span>
        <div id="s-fork"></div>
    </div>
    <div id="div_margin" style="margin-top:40px;"></div>
    <?php  } ?>
    <div id="wsq_index">
        <?php  if($setting['settled'] == 1) { ?>
        <div class="navbar-fixed-top" >
            <span class="icon-box icon-box-home" style="z-index: 99999;<?php  if(!empty($setting)&&$setting['scroll_announce_enable'] == 1) { ?>top: 50px;<?php  } else { ?>top: 10px;<?php  } ?>" id="btnhome">
                <a href="<?php  echo $this->createMobileurl('settled', array(),true)?>"><i class="glyphicon glyphicon-user"></i></a>
            </span>
        </div>
        <?php  } ?>
        <!--封面图集-->
        <?php  if(!empty($slide)) { ?>
        <div id="J-album">
            <div id="J-album-wp">
                <!-- 轮播s -->
                <div class="scroller" id="scroller">
                    <ul id="thelist">
                        <?php  if(is_array($slide)) { foreach($slide as $item) { ?>
                        <li>
                            <a href="<?php  if(empty($item['url'])) { ?>#<?php  } else { ?><?php  echo $item['url'];?><?php  } ?>">
                                <img _src="<?php  echo $_W['attachurl'];?><?php  echo $item['attachment'];?>" src="<?php  echo $_W['attachurl'];?><?php  echo $item['attachment'];?>" onerror="this.src='<?php echo RES;?>/themes/images/nopic.jpeg'"/>
                            </a>
                        </li>
                        <?php  } } ?>
                    </ul>
                </div>
            </div>
            <div id="J-album-nav">
                <ul id="indicator">
                    <?php  $flag = false;?>
                    <?php  if(is_array($slide)) { foreach($slide as $item) { ?>
                    <?php  if(!$flag) { ?>
                    <li class="active">1</li><?php  $flag = true;?>
                    <?php  } else { ?>
                    <li>1</li>
                    <?php  } ?>
                    <?php  } } ?>
                </ul>
            </div>
            <div class="clr"></div>
        </div>
        <?php  } ?>
        <div style="clear: both; line-height: 4px; width: 100%">&nbsp;</div>
        <?php  if(!empty($category_first)) { ?>
        <div class="wapper">
            <h3 class="tit">推荐分类<em class="arrow"></em><a href="<?php  echo $this->createMobileurl('list', array(),true)?>" class="fr"><i class="iconfont">&#xf012c</i>快速搜索</a></h3>
            <ul class="hot_list">
                <!--这里上传的图标图片尺寸为120px*120px效果最佳-->
                <?php  if(is_array($category_first)) { foreach($category_first as $item) { ?>
                <li>
                    <a href="<?php  echo $this->createMobileurl('list', array('cid' => $item['id'], true))?>">
                    <div class="J-imglazyload" data-url="<?php  if(strstr($item['logo'], 'http') || strstr($item['logo'], '../addons/')) { ?><?php  echo $item['logo'];?><?php  } else { ?><?php  echo $_W['attachurl'];?><?php  echo $item['logo'];?><?php  } ?>"></div>
                    <p><?php  echo $item['name'];?></p></a>
                </li>
                <?php  } } ?>
            </ul>
        </div>
        <?php  } ?>
        <?php  if(!empty($hotstores)) { ?>
        <div class="wapper">
            <h3 class="tit">商家推荐<em class="arrow"></em><?php  if($setting['settled'] == 1) { ?><a href="<?php  echo $this->createMobileurl('settled', array(), true)?>" class="fr"><i class="iconfont">☞</i>商家入驻</a><?php  } ?></h3>
            <ul class="sj_list">
                <!--这里上传的图标图片尺寸为300px*150px效果最佳-->
                <?php  if(is_array($hotstores)) { foreach($hotstores as $item) { ?>
                <li style="width:50%;">
                    <a href="<?php  echo $this->createMobileurl('shop', array('id' => $item['id'], true))?>">
                        <div class="J-imglazyload" data-url="<?php  if(strstr($item['logo'], 'http') || strstr($item['logo'], '../addons/')) { ?><?php  echo $item['logo'];?><?php  } else { ?><?php  echo $_W['attachurl'];?><?php  echo $item['logo'];?><?php  } ?>"></div>
                    </a>
                </li>
                <?php  } } ?>
            </ul>
        </div>
        <?php  } ?>
        <div class="wapper">
            <h3 class="tit">全部分类<em class="arrow"></em></h3>
            <ul class="all_list">
                <!--这里上传的图标图片尺寸为134px*134px效果最佳-->
                <?php  if(is_array($category)) { foreach($category as $item) { ?>
                <li><a href="<?php  echo $this->createMobileurl('list', array('cid' => $item['id'], true))?>">
                    <div class="J-imglazyload" data-url="<?php  if(strstr($item['logo'], 'http') || strstr($item['logo'], '../addons/')) { ?><?php  echo $item['logo'];?><?php  } else { ?><?php  echo $_W['attachurl'];?><?php  echo $item['logo'];?><?php  } ?>"></div>
                    <p><?php  echo $item['name'];?></p></a></li>
                <?php  } } ?>
            </ul>
        </div>
        <div class="foot">
            <a href="<?php  if(!empty($setting['copyright_link'])) { ?><?php  echo $setting['copyright_link'];?><?php  } else { ?>#<?php  } ?>">
                <?php  if(empty($setting['copyright'])) { ?>
                &copy;<?php  echo $_W['account']['account'];?>微商圈
                <?php  } else { ?>
                <?php  echo $setting['copyright'];?>
                <?php  } ?>
            </a>
        </div>
    </div>
    <?php  include $this->template('_footer');?>
    <!-- footer e -->
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script>
        /*
         * 注意：
         * 1. 所有的JS接口只能在公众号绑定的域名下调用，公众号开发者需要先登录微信公众平台进入“公众号设置”的“功能设置”里填写“JS接口安全域名”。
         * 2. 如果发现在 Android 不能分享自定义内容，请到官网下载最新的包覆盖安装，Android 自定义分享接口需升级至 6.0.2.58 版本及以上。
         * 3. 完整 JS-SDK 文档地址：http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html
         *
         * 如有问题请通过以下渠道反馈：
         * 邮箱地址：weixin-open@qq.com
         * 邮件主题：【微信JS-SDK反馈】具体问题
         * 邮件内容说明：用简明的语言描述问题所在，并交代清楚遇到该问题的场景，可附上截屏图片，微信团队会尽快处理你的反馈。
         */
        var appid = '<?php  echo $_W['account']['jssdkconfig']['appId'];?>';
        var timestamp = '<?php  echo $_W['account']['jssdkconfig']['timestamp'];?>';
        var nonceStr = '<?php  echo $_W['account']['jssdkconfig']['nonceStr'];?>';
        var signature = '<?php  echo $_W['account']['jssdkconfig']['signature'];?>';

        wx.config({
            debug: false,
            appId: appid,
            timestamp: timestamp,
            nonceStr: nonceStr,
            signature: signature,
            jsApiList: [
                // 所有要调用的 API 都要加到这个列表中
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

        var shareData = {
            title: '<?php  echo $share_title;?>',
            desc: '<?php  echo $share_desc;?>',
            link: '<?php  echo $share_url;?>',
            imgUrl: '<?php  echo $share_image;?>'
        };

        wx.ready(function () {
            wx.onMenuShareAppMessage({
                title: shareData.title,
                desc: shareData.desc,
                link: shareData.link,
                imgUrl: shareData.imgUrl,
                trigger: function (res) {
                    //alert('用户点击发送给朋友');
                },
                success: function (res) {
                    alert('感谢您的分享...');
                },
                cancel: function (res) {
                    //alert('已取消');
                },
                fail: function (res) {
                    alert(JSON.stringify(res));
                }
            });

            wx.onMenuShareTimeline({
                title: shareData.title,
                link: shareData.link,
                imgUrl: shareData.imgUrl,
                success: function () {
                    // 用户确认分享后执行的回调函数
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                }
            });

            wx.onMenuShareQQ({
                title: shareData.title,
                desc: shareData.desc,
                link: shareData.link,
                imgUrl: shareData.imgUrl,
                success: function () {
                    // 用户确认分享后执行的回调函数
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                }
            });

            wx.onMenuShareWeibo({
                title: shareData.title,
                desc: shareData.desc,
                link: shareData.link,
                imgUrl: shareData.imgUrl,
                success: function () {
                    // 用户确认分享后执行的回调函数
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                }
            });
        });

        wx.error(function (res) {
            //alert(res.errMsg);
        });
    </script>
    </body>
	<!--页面JS部分-->

	<script type="text/javascript">
        $('#s-fork').click(function(){
            $('#speaker').hide();
            $('#l-nav').css({'top':0});
            $('#right').css({'top':0});
            $('#btnhome').css({'top':10});
            $('#div_margin').css({'margin-top':0});
        });


        Zepto(function($){
		//内滚动导航
		 $('#J-nav').navigator();
		 //图片懒加载
		$('.J-imglazyload').imglazyload();
		//返回顶部
		$('#gotop').gotop();
	});

	</script>
	<script type="text/javascript">
		var myScroll;
		function loaded() {
			myScroll = new iScroll('J-album-wp', {
				snap : true,
				momentum : false,
				hScrollbar : false,
				onScrollEnd : function() {
					document.querySelector('#indicator > li.active').className = '';
					document.querySelector('#indicator > li:nth-child(' + (this.currPageX + 1) + ')').className = 'active';
				}
			});
		}
		document.addEventListener('DOMContentLoaded', loaded, false);
	</script>
	<script type="text/javascript">
		var count = document.getElementById("thelist").getElementsByTagName("img").length;
		for ( i = 0; i < count; i++) {
			document.getElementById("thelist").getElementsByTagName("img").item(i).style.cssText = " width:" + document.body.clientWidth + "px";

		}
		document.getElementById("scroller").style.cssText = " width:" + document.body.clientWidth * count + "px";
		setInterval(function() {
			myScroll.scrollToPage('next', 0, 400, count);
		}, 6000);//3500

		window.onresize = function() {
			for ( i = 0; i < count; i++) {
				document.getElementById("thelist").getElementsByTagName("img").item(i).style.cssText = " width:" + document.body.clientWidth + "px";
			}
			document.getElementById("scroller").style.cssText = " width:" + document.body.clientWidth * count + "px";
		}
	</script>
</html>