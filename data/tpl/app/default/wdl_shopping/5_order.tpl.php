<?php defined('IN_IA') or exit('Access Denied');?><?php  $bootstrap_type = 3;?>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('header', TEMPLATE_INCLUDEPATH)) : (include template('header', TEMPLATE_INCLUDEPATH));?>

<style type='text/css'>
	.sel { background:#e9342a; color:#fff;}
	.nosel { background:#fff;color:#000}
</style>

<link type="text/css" rel="stylesheet" href="../addons/wdl_shopping/images/style.css?<?php echo TIMESTAMP;?>">
<div class="head">
	<a href="javascript:history.back();" class="bn pull-left"><i class="fa fa-angle-left"></i></a>
	<span class="title">我的订单</span>
	<a href="<?php  echo $this->createMobileUrl('mycart')?>" class="bn pull-right"><i class="fa fa-shopping-cart"></i></a>
</div>
 <div class="myoder img-rounded" style='text-align:center;color:#aaa;padding:5px;'>
	 <div style='float:left;height:23px;margin:auto;width:60%;'>
		<div <?php  if($status == 0) { ?>class='sel'<?php  } else { ?>class="nosel"<?php  } ?> style='border-top-left-radius: 5px;border-bottom-left-radius:5px;border:1px solid #e9342a;text-align: center;float:left;width:30%' onclick="location.href='<?php  echo $this->createMobileUrl('myorder',array('status'=>0))?>'">
			待支付
		</div>
		<div <?php  if($status == 1 || $status == 2) { ?>class='sel'<?php  } else { ?>class="nosel"<?php  } ?> style='border:1px solid #e9342a;margin-left:-1px;float:left;width:30%;text-align: center;' onclick="location.href='<?php  echo $this->createMobileUrl('myorder',array('status'=>2))?>'">
			待收货
		</div>
		<div <?php  if($status ==3 ) { ?>class='sel'<?php  } else { ?>class="nosel"<?php  } ?> style='border-top-right-radius: 5px;margin-left:-1px;border-bottom-right-radius:5px;text-align: center;border:1px solid #e9342a;float:left;width:30%' onclick="location.href='<?php  echo $this->createMobileUrl('myorder',array('status'=>3))?>'">
			已完成
		</div>
	</div>
	 <a style='float:right; display:inline-block; height:23px; line-height:23px;' href="<?php  echo $this->createMobileUrl('address',array('from'=>'confirm'))?>">管理收货地址</a>
</div>

<?php  if(count($list)<=0) { ?>
<div class="myoder img-rounded" style='text-align:center;color:#aaa;padding:30px;'>
	您暂时没有任何订单!
</div>
<?php  } ?>

<div style='margin-bottom:40px;'>
<?php  if(is_array($list)) { foreach($list as $item) { ?>
<div class="myoder img-rounded">
	<div class="myoder-hd">
		<span class="pull-left">订单编号：<?php  echo $item['ordersn'];?></span>
		<span class="pull-right">
		<?php  echo date('Y-m-d H:i', $item['createtime'])?>
		<?php  if($item['paytype'] == 3) { ?>
			<?php  if($item['status'] == -1) { ?>
			<span class="text-muted">订单取消</span>
			<?php  } else if($item['status'] < 3) { ?>
			<span class="text-danger">货到付款 / 未付款</span>
			<?php  } else { ?>
			<span class="text-success">已完成</span>
			<?php  } ?>
		<?php  } else { ?>
			<?php  if($item['status'] == -1) { ?>
			<span class="text-muted">订单取消</span>
			<?php  } else if($item['status'] == 0) { ?>
			<span class="text-danger">未付款</span>
			<?php  } else if($item['status'] == 1) { ?>
			<span class="text-warning">已付款</span>
			<?php  } else if($item['status'] == 2) { ?>
			<span class="text-warning">已发货</span>
			<?php  } else { ?>
			<span class="text-success">已完成</span>
			<?php  } ?>
		<?php  } ?>
		</span>
	</div>
	<?php  if(count($item['goods']) == 1) { ?>
	<?php  if(is_array($item['goods'])) { foreach($item['goods'] as $goods) { ?>
	<div class="myoder-detail">
		<a href="<?php  echo $this->createMobileUrl('detail', array('id' => $goods['id']))?>">
			<img src="<?php  echo tomedia($goods['thumb']);?>" width="160" />
		</a>
		<div class="pull-left">
			<div class="name"><a href="<?php  echo $this->createMobileUrl('detail', array('id' => $goods['id']))?>"><?php  echo $goods['title'];?></a></div>
			<div class="price">
				<span class="pull-left"><?php  echo $goods['marketprice'];?> 元<?php  if($goods['unit']) { ?> / <?php  echo $goods['unit'];?><?php  } ?></span>
				<span class="num pull-right"><?php  echo $item['total'][$goods['id']]['total'];?><?php  if($goods['unit']) { ?> <?php  echo $goods['unit'];?><?php  } ?></span>
			</div>
		</div>
	</div>
	<?php  } } ?>
	<?php  } else { ?>
	<div class="myoder-detail">
		<?php  if(is_array($item['goods'])) { foreach($item['goods'] as $goods) { ?>
		<a href="<?php  echo $this->createMobileUrl('detail', array('id' => $goods['id']))?>">
			<img src="<?php  echo tomedia($goods['thumb']);?>" width="160" />
		</a>
		<?php  } } ?>
	</div>
	<?php  } ?>
	<div class="myoder-total">
		<span>
			共计：
			<span class="false">
			<?php  if($item['dispatchprice'] <= 0) { ?>
			<?php  echo $item['price'];?> 元
			<?php  } else { ?>
			<?php  echo $item['price'];?> 元 (运费 <?php  echo $item['dispatchprice'];?> 元)
			<?php  } ?>
			</span>
		</span>
		<div style="height: 15px;margin-top: 15px;">
			<?php  if(!empty($item['status']) && $item['status'] < 1) { ?>
			<a href="<?php  echo $this->createMobileUrl('order', array('orderid' => $item['id'], 'op' => 'delete', 'curtstatus' => $status))?>" class="btn btn-danger pull-right btn-sm" style="margin-left: 10px;">删除订单</a>
			<?php  } ?>
			<?php  if($item['status'] < 1) { ?>
			<a href="<?php  echo $this->createMobileUrl('order', array('orderid' => $item['id'], 'status' => '-1', 'curtstatus' => $status))?>" class="btn btn-warning pull-right btn-sm" style="margin-left: 10px;">取消订单</a>
			<?php  } ?>
			<a href="<?php  echo $this->createMobileUrl('myorder', array('orderid' => $item['id'], 'op' => 'detail'))?>" class="btn btn-success pull-right btn-sm" >订单详情</a>
		</div>
	</div>
</div>
<?php  } } ?>
</div>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footer', TEMPLATE_INCLUDEPATH)) : (include template('footer', TEMPLATE_INCLUDEPATH));?>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footerbar', TEMPLATE_INCLUDEPATH)) : (include template('footerbar', TEMPLATE_INCLUDEPATH));?>