<?php defined('IN_IA') or exit('Access Denied');?><?php  $bootstrap_type = 3;?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('header', TEMPLATE_INCLUDEPATH)) : (include template('header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<link type="text/css" rel="stylesheet" href="../addons/wdl_shopping/images/style.css?<?php echo TIMESTAMP;?>">
<div class="head">
	<a href="javascript:history.back();" class="bn pull-left"><i class="fa fa-angle-left"></i></a>
	<span class="title">品牌介绍</span>
	<a href="<?php  echo $this->createMobileUrl('list')?>" class="bn pull-right"><i class="fa fa-home"></i></a>
</div>
<div class="tabbable" style="padding-bottom:30px;">
	<div class="tab-content">
		<div class="tab-pane active" id="tab1">
			<div class="mobile-div img-rounded" style="text-align: center; padding:10px;font-weight:bold;overflow:hidden;word-break:break-all">
			<?php  if(!empty($cfg['logo'])) { ?>
				<img src="<?php  echo $_W['attachurl'];?><?php  echo $cfg['logo'];?>" width="100%" />
			<?php  } ?>
			<?php  if(!empty($cfg['shopname'])) { ?>
				<br/><br/><?php  echo $cfg['shopname'];?>
			<?php  } else { ?>
				<br/><br/>品牌介绍
			<?php  } ?>
			</div>
			<div class="mobile-div img-rounded" style="padding:0 15px;">
				<?php  if(!empty($cfg['phone'])) { ?>
					<a href="tel:<?php  echo $cfg['phone'];?>" class="mobile-li"><i class="fa fa-hand-up pull-right"></i>电话： <?php  echo $cfg['phone'];?></a><br>
				<?php  } ?>
				<?php  if(!empty($cfg['address'])) { ?>
				<a href="http://api.map.baidu.com/geocoder?address=<?php  echo $cfg['address'];?>&output=html" class="mobile-li"><i class="fa fa-hand-up pull-right"></i>地址：<?php  echo $cfg['address'];?></a>
				<?php  } ?>
			</div>
			<?php  if(!empty($cfg['description'])) { ?>
			<div class="mobile-div img-rounded " style='overflow:hidden;word-break:break-all;padding:15px;'>
				<?php  echo $cfg['description'];?>
			</div>
			<?php  } ?>
		</div>
	</div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footer', TEMPLATE_INCLUDEPATH)) : (include template('footer', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footerbar', TEMPLATE_INCLUDEPATH)) : (include template('footerbar', TEMPLATE_INCLUDEPATH));?>