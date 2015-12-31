<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li <?php  if($operation == 'post') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('category', array('op' => 'post'))?>">添加分类</a></li>
	<li <?php  if($operation == 'display') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('category', array('op' => 'display'))?>">管理分类</a></li>
</ul>
<?php  if($operation == 'post') { ?>
<div class="main">
	<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
	<input type="hidden" name="parentid" value="<?php  echo $parent['id'];?>" />

        <div class="panel panel-default">
            <div class="panel-heading">
                分类详细设置
            </div>
            <div class="panel-body">
                <?php  if(!empty($parentid)) { ?>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">上级分类</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php  echo $parent['name'];?>
                    </div>
                </div>
                <?php  } ?>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">排序</label>
                    <div class="col-sm-9 col-xs-12">
                        <input type="text" name="displayorder" class="form-control" value="<?php  echo $category['displayorder'];?>" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">分类名称</label>
                    <div class="col-sm-9 col-xs-12">
                        <input type="text" name="catename" class="form-control" value="<?php  echo $category['name'];?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">分类图片</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php  echo tpl_form_field_image('thumb', $category['thumb']);?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">分类描述</label>
                    <div class="col-sm-9 col-xs-12">
                        <textarea name="description" class="form-control"><?php  echo $category['description'];?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">首页推荐</label>
                    <div class="col-sm-9 col-xs-12">
                        <label class="radio-inline">
                            <input type='radio' name='isrecommand' class="check" value=1' <?php  if($category['isrecommand']==1) { ?>checked<?php  } ?> /> 是
                        </label>
                        <label class="radio-inline">
                            <input type='radio' name='isrecommand' class="check" value=0' <?php  if($category['isrecommand']==0) { ?>checked<?php  } ?> /> 否
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否显示</label>
                    <div class="col-sm-9 col-xs-12">
                        <label class="radio-inline">
                            <input type='radio' name='enabled' class="check" value=1' <?php  if($category['enabled']==1) { ?>checked<?php  } ?> /> 是
                        </label>
                        <label class="radio-inline">
                            <input type='radio' name='enabled' class="check" value=0' <?php  if($category['enabled']==0) { ?>checked<?php  } ?> /> 否
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <input name="submit" type="submit" value="提交" class="btn btn-primary span3">
        <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />


		<table class="tb">
			<!--
			
			<?php  if($_GPC['parentid']) { ?>
			<tr>
				<th><label for="">佣金比例</label></th>
				<td>
					<input type="text" name="commission" class="span1" value="<?php  echo $category['commission'];?>" />%
				</td>
			</tr>
              <?php  } ?>
			  
			  -->
		</table>
	</form>
</div>


<script type="text/javascript" src="./resource/script/colorpicker/spectrum.js"></script>
<link type="text/css" rel="stylesheet" href="./resource/script/colorpicker/spectrum.css" />
<script type="text/javascript">
<!--
	$(function(){
		colorpicker();
	});
//-->
</script>
<?php  } else if($operation == 'display') { ?>
<div class="main">
	<div class="category">
		<form action="" method="post" onsubmit="return formcheck(this)">
		<table class="table table-hover">
			<thead>
				<tr>
					<th style="width:10px;"></th>
					<th style="width:120px;">显示顺序</th>
					<th>分类名称</th>
					<th style="width:80px;">操作</th>
				</tr>
			</thead>
			<tbody>
			<?php  if(is_array($category)) { foreach($category as $row) { ?>
				<tr>
					<td><?php  if(count($children[$row['id']]) > 0) { ?><a href="javascript:;"><i class="icon-chevron-down"></i></a><?php  } ?></td>
					<td><input type="text" class="form-control" name="displayorder[<?php  echo $row['id'];?>]" value="<?php  echo $row['displayorder'];?>"></td>
                    <td><img src="./resource/attachment/<?php  echo $row['thumb'];?>" width='50' height="50" onerror="$(this).remove()" style='padding:1px;border: 1px solid #ccc;float:left;' />
                        <div class="type-parent"><?php  echo $row['name'];?>&nbsp;&nbsp;
                            <?php  if($row['enabled']==1) { ?>
                            <span class='label label-success'>显示</span>
                            <?php  } else { ?>
                            <span class='label label-danger'>隐藏</span>
                            <?php  } ?><?php  if(empty($row['parentid'])) { ?>
                            <a href="<?php  echo $this->createWebUrl('category', array('parentid' => $row['id'], 'op' => 'post'))?>"><i class="icon-plus-sign-alt"></i> 添加子分类</a><?php  } ?></div></td>
					<td><a href="<?php  echo $this->createWebUrl('category', array('op' => 'post', 'id' => $row['id']))?>">编辑</a>&nbsp;&nbsp;<a href="<?php  echo $this->createWebUrl('category', array('op' => 'delete', 'id' => $row['id']))?>" onclick="return confirm('确认删除此分类吗？');return false;">删除</a></td>
				</tr>
				<?php  if(is_array($children[$row['id']])) { foreach($children[$row['id']] as $row) { ?>
				<tr>
					<td></td>
					<td><input type="text" class="span1" name="displayorder[<?php  echo $row['id'];?>]" value="<?php  echo $row['displayorder'];?>"></td>
					<td><img src="./resource/attachment/<?php  echo $row['thumb'];?>" width='50' height="50" onerror="$(this).remove()" style='padding:1px;border: 1px solid #ccc;float:left;' /><div class="type-child"><?php  echo $row['name'];?>&nbsp;&nbsp;   <?php  if($row['enabled']==1) { ?>
                                                <span class='label label-success'>显示</span>
                                                <?php  } else { ?>
                                                <span class='label label-danger'>隐藏</span>
                                                <?php  } ?></div></td>
					<td><a href="<?php  echo $this->createWebUrl('category', array('op' => 'post', 'id' => $row['id'], 'parentid'=>$row['parentid']))?>">编辑</a>&nbsp;&nbsp;<a href="<?php  echo $this->createWebUrl('category', array('op' => 'delete', 'id' => $row['id']))?>" onclick="return confirm('确认删除此分类吗？');return false;">删除</a></td>
				</tr>
				<?php  } } ?>
			<?php  } } ?>
				<tr>
					<td colspan="4">
						<a href="<?php  echo $this->createWebUrl('category', array('op' => 'post'))?>"><i class="icon-plus-sign-alt"></i> 添加新分类</a>
					</td>
				</tr>
				<tr>
					<td colspan="4">
						<input name="submit" type="submit" class="btn btn-primary" value="提交">
						<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
					</td>
				</tr>
			</tbody>
		</table>
		</form>
	</div>
</div>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
