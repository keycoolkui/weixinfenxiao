<?php defined('IN_IA') or exit('Access Denied');?><link type="text/css" rel="stylesheet" href="./themes/style70/css/vweisiteV01.css"/>    <link type="text/css" rel="stylesheet" href="./themes/style70/css/font-awesome.css"/>    <link href="./themes/style70/css/index81.css" media="screen" rel="stylesheet" type="text/css" /><script src=".	/themes/style70/js/vweisiteV01-63578aafc76546d753caab81d632976e.js" type="text/javascript"></script>	<script type="text/javascript" src="./resource/script/jquery-1.7.2.min.js"></script>   <script type="text/javascript" src="./themes/default/script/swipe.js"></script><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?><style>	.fa-arrow-up:before {		content: "\f062";		color:#7a7a7a;	}	.btn-up-1 {		background:#7a7a7a;	}	</style><style type="text/css">body { margin-bottom:60px !important; }a, button, input { -webkit-tap-highlight-color:rgba(255, 0, 0, 0); }ul, li { list-style:none; margin:0; padding:0 }.top_bar { position: fixed; z-index: 900; bottom: 0; left: 0; right: 0; margin: auto; font-family: Helvetica, Tahoma, Arial, Microsoft YaHei, sans-serif; }.top_menu { display:-webkit-box; border-top: 1px solid #3D3D46; display: block; width: 100%; background: rgba(255, 255, 255, 0.7); height: 48px; display: -webkit-box; display: box; margin:0; padding:0; -webkit-box-orient: horizontal; background: -webkit-gradient(linear, 0 0, 0 100%, from(#524945), to(#48403c), color-stop(60%, #524945)); box-shadow: 0 1px 0 0 rgba(255, 255, 255, 0.1) inset; }.top_bar .top_menu>li { -webkit-box-flex:1; position:relative; text-align:center; }.top_menu li:first-child { background:none; }.top_bar .top_menu>li>a { height:48px; margin-right: 1px; display:block; text-align:center; color:#FFF; text-decoration:none; text-shadow: 0 1px rgba(0, 0, 0, 0.3); -webkit-box-flex:1; background: #444752;}.top_bar .top_menu>li.home { max-width:70px ;  background: #444752;}.top_bar .top_menu>li.home a { height: 60px; width: 60px; margin: auto; border-radius: 60px; position: relative; top: -14px; left: 5px; background: url('themes/style70/images/home.png') no-repeat center center; background-size: 100% 100%; }.top_bar .top_menu>li>a label { overflow:hidden; margin: 0 0 0 0; font-size: 12px; display: block !important; line-height: 18px; text-align: center; }.top_bar .top_menu>li>a img { padding: 3px 0 0 0; height: 24px; width: 24px; color: #fff; line-height: 48px; vertical-align:middle; }.top_bar li:first-child a { display: block; }.menu_font { text-align:left; position:absolute; right:10px; z-index:500; background: -webkit-gradient(linear, 0 0, 0 100%, from(#524945), to(#48403c), color-stop(60%, #524945)); border-radius: 5px; width: 120px; margin-top: 10px; padding: 0; box-shadow: 0 1px 5px rgba(0, 0, 0, 0.3); }.menu_font.hidden { display:none; }.menu_font { top:inherit !important; bottom:60px; }.menu_font li a { height:40px; margin-right: 1px; display:block; text-align:center; color:#FFF; text-decoration:none; text-shadow: 0 1px rgba(0, 0, 0, 0.3); -webkit-box-flex:1; }.menu_font li a { text-align: left !important; }.top_menu li:last-of-type a { background: none;  background: #444752; }.menu_font:after { top: inherit!important; bottom: -6px; border-color: #48403c rgba(0, 0, 0, 0) rgba(0, 0, 0, 0); border-width: 6px 6px 0; position: absolute; content: ""; display: inline-block; width: 0; height: 0; border-style: solid; left: 80%; }.menu_font li { border-top: 1px solid rgba(255, 255, 255, 0.1); border-bottom: 1px solid rgba(0, 0, 0, 0.2); }.menu_font li:first-of-type { border-top: 0; }.menu_font li:last-of-type { border-bottom: 0; }.menu_font li a { height: 40px; line-height: 40px !important; position: relative; color: #fff; display: block; width: 100%; text-indent: 10px; white-space: nowrap; text-overflow: ellipsis; overflow: hidden; }.menu_font li a img { width: 20px; height:20px; display: inline-block; margin-top:-2px; color: #fff; line-height: 40px; vertical-align:middle; }.menu_font>li>a label { padding:3px 0 0 3px; font-size:14px; overflow:hidden; margin: 0; }#sharemcover { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.7); display: none; z-index: 20000; }#sharemcover img { position: fixed; right: 18px; top: 5px; width: 260px; height: 180px; z-index: 20001; border:0; }.top_bar .top_menu>li>a:hover, .top_bar .top_menu>li>a:active { background-color:#333; }.menu_font li a:hover, .menu_font li a:active{ background-color:#333; }.menu_font li:first-of-type a { border-radius:5px 5px 0 0; }.menu_font li:last-of-type a { border-radius:0 0 5px 5px; }#plug-wrap { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0); z-index:800; }#cate18 .device {bottom: 49px;}#cate18 #indicator {bottom: 240px;}#cate19 .device {bottom: 49px;}#cate19 #indicator {bottom: 330px;}#cate19 .pagination {bottom: 60px;}		</style>
<style>
body{background:#e4e4e4;}
.category{display:block; overflow:hidden; background:#fbe9b3; border-top:1px #DDD solid;border-bottom:1px #DDD solid;}
.category a{display:inline-block; overflow:hidden; height:30px; width:33.33%; text-align:center; color:#666; font-size:14px; float:left; padding:5px;}
.list li{padding: 5px 5px 0 5px;}
.list li a{display:block; height:71px; padding:5px;background:#FFF; border:1px #DDD solid; border-radius:3px;color:#333; overflow:hidden; text-decoration:none !important; position:relative;}
.list li a .thumb{width:80px; height:60px;}
.list li a .title{font-size:14px; padding-right:90px;}
.list li a .createtime{font-size:12px; color:#999; position:absolute; bottom:5px;}
.head{height:40px; line-height:40px; background:rgba(17, 5, 26, 0.88); padding:0 5px; color:#FFF;}
.head .bn{display:inline-block; height:30px; line-height:30px; padding:0 10px; margin-top:4px; font-size:20px; background:transparent; color:#FFF; text-decoration:none;}
.head .bn.pull-left{border-right:1px solid #fbe9b3;}
.head .bn.pull-right{position:absolute; right:5px; top:0; border-left:1px solid #fbe9b3;}
.head .title{font-size:14pt;display:block;padding-left:10px;font-weight:bolder;margin-right:49px;text-align:center;height:40px;line-height:40px;text-overflow:ellipsis;white-space:nowrap;overflow: hidden;}
.head .order{background:rgba(17, 5, 26, 0.88); position:absolute; z-index:9999; right:0;}
.head .order li > a{display:block; padding:0 10px; min-width:100px; height:35px; line-height:35px; font-size:16px; color:#FFF; text-decoration:none; border-top:1px #EEE solid;}
.head .order li.fa-caret-up{font-size:20px;color:#8e543d;position:absolute;top:-11px;right:16px;}
.pager-position{width:100%;margin:0 auto;text-align:center;}#sharemcover { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.7); display: none; z-index: 20000; }#sharemcover img { position: fixed; right: 18px; top: 5px; width: 260px; height: 180px; z-index: 20001; border:0; }#mcover{position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0, 0, 0, 0.7);display:none;z-index:20000;}#mcover img{position:fixed;right: 18px;top:5px;width:260px;height:180px;z-index:20001;}.list li a .title {  font-size: 18px; }.desc{  font-size:14px;  color:#7a7a7a;  width: 200px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;}
</style>
<!--<div class="head">
	<a href="javascript:history.go(-1);" class="bn pull-left"><i class="fa fa-reply"></i></a>
	<span class="title"><?php  echo $title;?></span>
	<a href="http://univalsoftfwj.oicp.net/index.php?i=3&c=home&" id="category_show" class="bn pull-right"><i class="fa fa-reorder"></i></a>
	<ul class="list-unstyled order hide">
		<li class="fa fa-caret-up"></li>
		<?php  $site_category = modulefunc('site', 'site_category', array (
  'func' => 'site_category',
  'limit' => 10,
  'index' => 'iteration',
  'multiid' => 0,
  'uniacid' => 3,
  'acid' => 0,
)); if(is_array($site_category)) { $i=0; foreach($site_category as $i => $row) { $i++; $row['iteration'] = $i; ?>
			<li>
				<a href="<?php  echo $row['linkurl'];?>">
					<?php  echo $row['name'];?>
				</a>
			</li>
		<?php  } } ?>
	</ul>
</div>--><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('slide', TEMPLATE_INCLUDEPATH)) : (include template('slide', TEMPLATE_INCLUDEPATH));?>
<div class="category">
	<?php  $site_category = modulefunc('site', 'site_category', array (
  'func' => 'site_category',
  'parentid' => $cid,
  'limit' => 10,
  'index' => 'iteration',
  'multiid' => 0,
  'uniacid' => 3,
  'acid' => 0,
)); if(is_array($site_category)) { $i=0; foreach($site_category as $i => $row) { $i++; $row['iteration'] = $i; ?>
	<a href="<?php  echo $row['linkurl'];?>"><?php  echo $row['name'];?></a>
	<?php  } } ?>
</div>
<ul class="list list-unstyled">
	<?php  $result = modulefunc('site', 'site_article', array (
  'func' => 'site_article',
  'cid' => $cid,
  'assign' => 'result',
  'return' => 'true',
  'limit' => 10,
  'index' => 'iteration',
  'multiid' => 0,
  'uniacid' => 3,
  'acid' => 0,
)); ?>
	<?php  if(is_array($result['list'])) { foreach($result['list'] as $row) { ?>
	<li>
		<a href="<?php  echo $row['linkurl'];?>">
			<?php  if($row['thumb']) { ?><img src="<?php  echo $row['thumb'];?>" class="pull-right thumb" onerror="this.parentNode.removeChild(this)" /><?php  } ?>
			<div class="title"><?php  echo $row['title'];?></div>			<div class="desc"><?php  echo $row['description'];?></div>
			<div class="createtime"><?php  echo date('Y-m-d H:i:s', $row['createtime'])?></div>
		</a>
	</li>
	<?php  } } ?>
</ul><div style="height:60px;width:100%"></div>
<script>
	require(['jquery'], function($){
		$(function(){
			$('#category_show').click(function(){
				$('.head .order').toggleClass('hide');
				return false;
			});
		});
	});
</script>
<div class="pager-position"><?php  echo $result['pager'];?></div><div id="mcover" onclick="$(this).hide()"><img src="./resource/images/guide.png"></div><a href="javascript:scroll(0,0)" class="btn-up btn-up-1"><i class="fa fa-arrow-up"></i></a>    <div class="loading fixed-top"></div>    <div class="mod-pop" id="pop-share" onClick="hidePop('#pop-share')"><span class="text-share"></span></div>    <script type="text/javascript">      $(document).ready(function(){                indexSwipe("index", ["微动力引领微营销", "微动力引领微营销", "微动力引领微营销", "微动力引领微营销", "微动力引领微营销"]);        showBtnUp(100);        $("a.dev-prev").click(function(){            history.back();        });        $("a.dev-next").click(function(){          history.go(1);        });        $("a.dev-index").click(function(){          //window.open("http://m.vcooline.com/10039?id=39&amp;wxmuid=10039&amp;wxuid=490869#mp.weixin.qq.com");          location.href = "http://m.vcooline.com/10039?id=39&amp;wxmuid=10039&amp;wxuid=490869#mp.weixin.qq.com";        });        $("a.dev-refresh").click(function(){          location.reload();        });        $("a.dev-tel").attr("href", "tel:15338923307");        $("a.dev-member").click(function(){          $(this).attr("href", "http://m.vcooline.com/app/vips?wxmuid=10039&amp;wxuid=490869#mp.weixin.qq.com")        });        $("a.dev-location").click(function(){          $(this).attr("href", "http://m.vcooline.com/10039/map?id=39")        });      });    </script>	<!-- 导航栏 -->		<div class="top_bar" style="-webkit-transform:translate3d(0,0,0)">  <nav><br><br><script>function displayit(n){	for(i=0;i<4;i++){		if(i==n){			var id='menu_list'+n;			if(document.getElementById(id).style.display=='none'){				document.getElementById(id).style.display='';				document.getElementById("plug-wrap").style.display='';			}else{				document.getElementById(id).style.display='none';				document.getElementById("plug-wrap").style.display='none';			}		}else{			if($('#menu_list'+i)){				$('#menu_list'+i).css('display','none');			}		}	}}function closeall(){	var count = document.getElementById("top_menu").getElementsByTagName("ul").length;	for(i=0;i<count;i++){		document.getElementById("top_menu").getElementsByTagName("ul").item(i).style.display='none';	}	document.getElementById("plug-wrap").style.display='none';}document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {	WeixinJSBridge.call('hideToolbar');});</script> <div class="top_bar" style="-webkit-transform:translate3d(0,0,0)">  <nav>    <ul id="top_menu" class="top_menu"><li class="home"><a href="index.php?i=3&j=6&c=home"></a></li>    <li> <a href="tel:123456789"><img src="themes/style70/images/plugmenu1.png"><label>一键拨号</label></a>                </li><li> <a href="http://j.map.baidu.com/4zAO4"><img src="themes/style70/images/plugmenu3.png"><label>一键导航</label></a>                </li><li> <a onclick="$('#mcover').show();"><img src="themes/style70/images/plugmenu5.png"><label>一键分享</label></a>                </li><li> <a href="index.php?i=3&j=6&c=home"><img src="themes/style70/images/plugmenu6.png"><label>微官网</label></a>                    <!--<ul id="menu_list3" class="menu_font" style=" display:none">            <li> <a href="http://localhost:8080/jeewx/cmsController.do?goPage&page=photoAlbum"><img src="template/cms/default/images/plugmenu7.png"><label>微相册</label></a></li>            <li> <a href="javascript:void(0)"><img src="template/cms/default/images/plugmenu9.png"><label>微商城</label></a></li>            <li> <a href="javascript:void(0)"><img src="template/cms/default/images/plugmenu17.png"><label>微电影</label></a></li>                    </ul>-->                     </li>     </ul>  </nav></div><div id="plug-wrap" onclick="closeall()" style="display: none;"></div> <!-- 导航栏结束  -->