<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
 	<li  class="active"><a href="<?php  echo $this->createWebUrl('zhifu', array('op' => 'list','name' => 'eso_sale','uniacid'=>$_W['uniacid']))?>">满足打款会员</a></li>	
 	
</ul>
    <div class="main">
		<div class="stat">
				<form >
				<input type="hidden" name="act" value="module" />
				<input type="hidden" name="name" value="eso_sale" />
				<input type="hidden" name="do" value="zhifu" />
				<input type="hidden" name="op" value="list" />
				

				<table class="table sub-search">
				<table class="table sub-search">
					<tbody>
						
							<th style="width:80px;text-align: right;">手机</th>
							<td>
								<input type="text"  name="mobile" /> <input type="submit" name="submit" value="搜索" class="btn btn-primary">
							</td>
						</tr>
					
						
					</tbody>
					</table>
						
		</form>
			<div class="stat-div">
				
				<div class="sub-item" id="table-list">
					<h4 class="sub-title" style="float:right;color:red;">总数：<?php  echo $total;?> <a href="">刷新</a> </h4>
					<h4 class="sub-title">会员列表</h4>

					<div class="sub-content">
						<table class="table table-hover">
							<thead class="navbar-inner">
								<tr>
									<th class="row-hover">姓名</th>
									<th class="row-hover">联系方式</th>
									<th class="row-hover"> 已打款</th>
									<th class="row-hover">未打款</th>
									<th class="row-hover">操作</th>
								</tr>
							</thead>
							<tbody>
							
								<?php  if(is_array($list)) { foreach($list as $v) { ?>
									
								<tr>
									<td style="text-align: center;">
										<?php  echo $v['realname'];?>
									</td>
									<td style="text-align: center;">
										<?php  echo $v['mobile'];?>
									</td>
									<td style="text-align: center;">
										<?php  echo $v['zhifu'];?>
									</td>
									<td style="text-align:center;">
									<?php  echo round($v['commission'] - $v['zhifu'],2)?>
									</td>
									<td style="text-align: center;">

										<a href="<?php  echo  $this->createWebUrl('zhifu', array('op' => 'post','name' => 'eso_sale','uniacid'=>$_W['uniacid'],'from_user'=>$v['from_user']))?>" class="btn btn-primary">打款</a>
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