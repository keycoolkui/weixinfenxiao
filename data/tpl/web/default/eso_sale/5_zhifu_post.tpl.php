<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
 	<li ><a href="<?php  echo $this->createWebUrl('zhifu', array('do' => 'zhifu', 'op' => 'list','name' => 'eso_sale','uniacid'=>$_W['uniacid']))?>">满足打款会员</a></li>	
 	<?php  if($_GPC['from_user']) { ?><li class="active"><a >会员打款操作</a></li> <?php  } ?>
</ul>
    <div class="main">
	
	<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" onsubmit="return validate(this);">
			<h4>会员打款 </h4>
			<table class="tb">
				<tr>
					<th style="text-align: right;"><label>真实姓名:</label></th>
					<td >
						<?php  echo $profile['realname'];?>
					</td>
				</tr>
				<tr>
					<th style="text-align: right;"><label>联系方式:</label></th>
					<td >
						<?php  echo $profile['mobile'];?>
					</td>
				</tr>
				<tr>
					<th style="text-align: right;"><label>未打款金额:</label></th>
					<td style="color:#f00;">
						<?php  echo round($profile['commission'] - $profile['zhifu'],2)?>
					</td>
				</tr>
				<tr>
					<th style="text-align: right;"><label>打款金额:</label></th>
					<td>
						<input type="text" name="chargenum" class="span1" value="" /><input type="hidden"  name="from_user" value="<?php  echo $_GPC['from_user'];?>" />
						<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
						<input name="submit" type="submit" value="打 款" class="btn btn-primary span2">
					</td>
				</tr>
				
				
			</table>
		</form>
		<div class="stat">
		
			<div class="stat-div">
				
				<div class="sub-item" id="table-list">
					<h4 class="sub-title" style="float:right;color:red;">总数：<?php  echo $total;?> <a href="">刷新</a> </h4>
					<h4 class="sub-title">打款明细</h4>

					<div class="sub-content">
						<table class="table table-hover">
							<thead class="navbar-inner">
								<tr>
									<th class="row-hover">日期</th>
									<th class="row-hover">类型</th>
									<th class="row-hover">金额</th>
									<!--<th class="row-hover">模块</th>-->
									<th class="row-hover">说明</th>
								</tr>
							</thead>
							<tbody>
							
								<?php  if(is_array($list)) { foreach($list as $v) { ?>
									
								<tr>
									<td style="text-align: center;">
										<?php  echo $v['tid'];?>
									</td>
									<td style="text-align: center;">
										打款
										
									</td>
									<td style="text-align: center;">
										<?php  echo $v['fee'];?>	
									</td>
									<!--<td style="text-align:center;">
										<?php  echo $mtype[$v['module']];?>
									</td>-->
									<td style="text-align: center;">
										<?php  echo $v['tag'];?>								
									</td>
								</tr>
									
								<?php  } } ?>
							</tbody>
						</table>
					</div>
					
					<?php  echo $pager;?>
				</div>
			</div>
		</div>
    </div>


<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>