<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li <?php  if($operation == 'display') { ?>class="active"<?php  } ?>><a href="<?php  echo create_url('site/entry/credit', array('m' => 'eso_sale', 'op' => 'display'));?>">管理</a></li>
</ul>
<?php  if($operation == 'display') { ?>
<div class="main">
	<div style="padding:15px;">
		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>

					<th>时间</th>
					<th>奖品名称</th>
					<th>价格</th>
					<th>消耗积分</th>
					<th style="width:100px;">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td><?php  echo date('Y-m-d H:i:s', $item['createtime'])?></td>
					<td><?php  echo $item['title'];?></td>
					<td><?php  echo $item['price'];?></td>
					<td><?php  echo $item['credit_cost'];?></td>
					<td>
						<a href="<?php  echo create_url('site/entry/credit', array('m' => 'eso_sale', 'id' => $item['id'], 'op' => 'delete'))?>" onclick="return confirm('此操作不可恢复，确认删除？');return false;" title="删除" class="btn btn-default btn-sm"><i class="fa fa-remove"></i></a>
					</td>
				</tr>
				<?php  } } ?>
			</tbody>
			<!--tr>
				<td colspan="8">
					<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
					<input type="submit" class="btn btn-primary" name="submit" value="提交" />
				</td>
			</tr-->
		</table>
	</div>
</div>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
