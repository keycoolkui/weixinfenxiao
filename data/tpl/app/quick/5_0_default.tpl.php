<?php defined('IN_IA') or exit('Access Denied');?><style>
	.quick.quick-quick {position:fixed; bottom:0; left:0; z-index:900; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); -moz-tap-highlight-color: rgba(0, 0, 0, 0); height:60px;}
	.quick.quick-quick .quick-menu{background-color: black; -webkit-appearance:none;outline:none;display:inline-block; width:36px !important; height:36px !important; line-height:38px !important; text-align:center !important; position:absolute; bottom:17px; left:17px; z-index:999; -moz-box-shadow:0 0 0 4px #FFFFFF, 0 2px 5px 4px rgba(0, 0, 0, 0.25); -webkit-box-shadow:0 0 0 4px #FFFFFF, 0 2px 5px 4px rgba(0, 0, 0, 0.25); box-shadow:0 0 0 4px #FFFFFF, 0 2px 5px 4px rgba(0, 0, 0, 0.25); -webkit-transition: -webkit-transform 200ms; -webkit-transform:rotate(1deg);-moz-transition: -webkit-transform 200ms; -moz-transform:rotate(1deg); color:#FFF;}
	.quick.quick-quick .quick-menu:before{font-size:20px;}
	.quick.quick-quick .quick-menu:checked{-webkit-transform:rotate(135deg);-moz-transform:rotate(135deg);}
	.quick.quick-quick>div {width:32px; height:32px; border-radius:32px; -moz-box-shadow:0 0 0 3px #FFFFFF, 0 2px 5px 3px rgba(0, 0, 0, 0.25); -webkit-box-shadow:0 0 0 3px #FFFFFF, 0 2px 5px 3px rgba(0, 0, 0, 0.25); box-shadow:0 0 0 3px #FFFFFF, 0 2px 5px 3px rgba(0, 0, 0, 0.25); background:black; position:absolute; bottom:0; left:0; margin-bottom:20px; margin-left:20px; z-index:900; -webkit-transition: -webkit-transform 200ms;-moz-transition: -webkit-transform 200ms;}
	.quick.quick-quick>div a{color:#fff; font-size:20px; display: block; height: 100%; line-height: 33px; text-decoration:none; text-align: center;}
	.quick.quick-quick>div a i{ display:inline-block; width:20px; height:20px;}
	.quick.quick-quick>div.on:nth-of-type(1) {-webkit-transform: translate(0, -100px) rotate(720deg);-moz-transform: translate(0, -100px) rotate(720deg);}
	.quick.quick-quick>div.on:nth-of-type(2) {-webkit-transform: translate(47px, -81px) rotate(720deg);-moz-transform: translate(47px, -81px) rotate(720deg);}
	.quick.quick-quick>div.on:nth-of-type(3) {-webkit-transform: translate(81px, -45px) rotate(720deg);-moz-transform: translate(81px, -45px) rotate(720deg);}
	.quick.quick-quick>div.on:nth-of-type(4) {-webkit-transform: translate(100px, 0) rotate(720deg);-moz-transform: translate(100px, 0) rotate(720deg);}
</style>
<div class="quick quick-quick" id="quick-quick">
	<span class="quick-menu img-circle" style="background-color:blcak;"><i class="fa fa-plus"></i></span>
	<input type="checkbox" id="quick-btn" class="quick-menu img-circle" style="opacity:0;" />
	<?php  $i = 1;?>
	<?php  if(is_array($_W['quickmenu']['menus'])) { foreach($_W['quickmenu']['menus'] as $nav) { ?>
	<div style="background-color:black;<?php  echo $nav['css']['icon']['style'];?>">
		<a href="<?php  echo $nav['url'];?>" title="<?php  echo $nav['name'];?>">
			<?php  if(!empty($nav['icon'])) { ?>
			<i style="background:url(<?php  echo $_W['attachurl'];?><?php  echo $nav['icon'];?>) no-repeat;background-size:cover;width:18px;height:18px;<?php  echo $nav['css']['icon']['style'];?>"></i>
			<?php  } else { ?>
			<i class="fa fa-fw <?php  echo $nav['css']['icon']['icon'];?>" style="<?php  echo $nav['css']['icon']['style'];?>"></i>
			<?php  } ?>
		</a>
	</div>
	<?php  if($i>4) break;?>
	<?php  $i++;?>
	<?php  } } ?>
</div>
<script>
window.addEventListener("DOMContentLoaded", function(){
	var btn = document.getElementById("quick-btn");
	btn.onclick = function(){
		var divs = document.getElementById("quick-quick").querySelectorAll("div");
		var className = className=this.checked?"on":"";
		for(var i = 0;i<divs.length; i++){
			divs[i].className = className;
		}
	}
}, false);
</script>
