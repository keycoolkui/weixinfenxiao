<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head id="Head1"><meta charset="utf-8" />
	<meta name="format-detection" content="telephone=no" />
	<meta name="viewport" content="width=device-width, initial-scale=0.5, minimum-scale=0.5, maximum-scale=0.5, user-scalable=0" />
	<meta name="description" content="" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-touch-fullscreen" content="yes" />
	<meta name="format-detection" content="telphone=no" />
	<title><?php  echo $month;?>月预收入排行榜</title>
	<link rel="stylesheet" href="../addons/eso_sale/style/css/newcore.css" />
	<style>
	    #add {
	    	font-size: 25px;
	    }
	    #allkehu {
	    	font-size: 22px;
	    }
	    #ycjkehu {
	    	font-size: 22px;
	    }
	    #xuanzhe td{
	    	font-size: 30px;
	    }
	</style>
  </head>
  <body style="background: #e7e7e7 url(../addons/eso_sale/style/images/bg5.jpg) repeat;">
    <div class="wrap">
	
         <table id="allkehu" align="center" cellpadding="0" cellspacing="0"  width="100%">
    		<tr height="50px">
    		    <td align="center" style="filter:alpha(opacity=50); background:rgba(255, 255, 255, 0.4) none repeat scroll 0 0 !important; color: #FFF;">名次</td>
    		    <td align="center" style="filter:alpha(opacity=50); background:rgba(255, 255, 255, 0.4) none repeat scroll 0 0 !important; color: #FFF;">姓名</td>
    			
    			<td align="center" style="filter:alpha(opacity=50); background:rgba(255, 255, 255, 0.4) none repeat scroll 0 0 !important; color: #FFF;">佣金</td>
    		</tr>
			<?php  $key=1?>
    		<?php  if(is_array($commission)) { foreach($commission as $c) { ?>
				<tr height="60px" style="font-size:16px;">
					<td align="center" style="color: red"><?php  if($key==1) { ?>首<img alt="皇冠" src="../addons/eso_sale/style/images/huangguan.png">富<?php  } else { ?>第<?php  echo $key;?>名<?php  } ?></td>
					<td align="center"><?php  echo $c['realname'];?></td>
					
					<td align="center" style="color: #ff3c00"><?php  echo $c['commission'];?> 元</td>
				</tr>
				<?php  $key++?>
			<?php  } } ?>
    	</table>    
    </div>

	<style>
	.f-mag {
		padding: 9px 9px;
		font-size: 14px;
	}
	.pagination li{
		margin-left:-3px;
		display: inline-block;
		padding: 0 5px;
		border-radius: 5px;
		width:22%;
		text-align:center;
	}
	.pagination li .pager-nav{
		color: #fff;
	}
	</style>
	<div class="foot f-mag">
		<p>  				
			<?php  echo $pager;?>
		</p>
	</div>
	<div style="position:relative; top:33px; text-align:center; font-size:14px;">
		@<?php  echo $_W['account']['name'];?>
	</div>
  </body>
</html>