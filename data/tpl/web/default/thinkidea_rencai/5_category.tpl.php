<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li class="active"><a href="#">职位分类管理</a></li>
    <li><a href="<?php  echo $this->createWebUrl('Category', array('op' => 'edit'));?>">添加职位分类</a></li>
</ul>

<div class="main" style="font-size: 12px">
    <?php  if($op == 'display') { ?>
	<form class="form-horizontal form" id="form2" action="" method="post">
	    <table class="table table-hover">
	        <thead class="navbar-inner">
	            <tr>
	                <th>ID</th>
	                <th>排序</th>
	                <th>栏目名称</th>
	                <th>热门</th>
	                <th>显示</th>
	                <th>操作</th>
	            </tr>
	        </thead>
            <tbody>
            <?php  if(is_array($parents)) { foreach($parents as $key => $parent) { ?>
                <tr>
                	<td><?php  echo $parent['id'];?></td>
                    <td><?php  echo $parent['display'];?></td>
                    <td><?php  echo $parent['name'];?></td>
                    <td><?php  if($parent['ishot'] == 1) { ?><span class="label label-primary">是</span><?php  } else { ?><span class="label label-default">否</span><?php  } ?></td>
                    <td><?php  if($parent['isshow'] == 1) { ?><span class="label label-success">显示</span><?php  } else { ?><span class="label label-default">隐藏</span><?php  } ?></td>
                    <td>
                        <a href="<?php  echo $this->createWebUrl('Category', array('op' => 'edit', 'id' => $parent['id']));?>" class="btn btn-primary btn-sm">编辑</a>
                        <a href="javascript:void(0);" onclick="delete_category(<?php  echo $parent['id'];?>)" class="btn btn-danger btn-sm">删除</a>
                    </td>
                </tr>
                <?php  if(is_array($parent['sub'])) { foreach($parent['sub'] as $sub) { ?>
                <tr>
                	<td><?php  echo $sub['id'];?></td>
                    <td><?php  echo $sub['display'];?></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;|—<?php  echo $sub['name'];?></td>
                    
                    <td><?php  if($sub['ishot'] == 1) { ?><span class="label label-success">是</span><?php  } else { ?><span class="label label-default">否</span><?php  } ?></td>
                    <td><?php  if($sub['isshow'] == 1) { ?><span class="label label-success">显示</span><?php  } else { ?><span class="label label-default">隐藏</span><?php  } ?></td>
                    <td>
                        <a href="<?php  echo $this->createWebUrl('Category', array('op' => 'edit', 'id' => $sub['id']));?>" class="btn btn-primary btn-sm">编辑</a>
                        <a href="javascript:void(0);" onclick="delete_category(<?php  echo $sub['id'];?>)" class="btn btn-danger btn-sm">删除</a>
                    </td>
                </tr>
                <?php  } } ?>
            <?php  } } ?>
            </tbody>
	    </table>
	</form>
    <?php  } else { ?>
    <form class="form-horizontal" action="" role="form" method="post">
        <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
        <input type="hidden" name="cid" value="<?php  echo $row['id'];?>" />

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">栏目名称</label>
            <div class="col-sm-4">
              <input type="text" name="data[name]" value="<?php  echo $row['name'];?>" class="form-control">
            </div>
        </div>
        
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">父级栏目</label>
            <div class="col-sm-4">
                <select class="form-control" name="data[parent_id]">
                    <option value="0">请选择分类</option>
                    <?php  if(is_array($parents)) { foreach($parents as $key => $parent) { ?>
                        <option value="<?php  echo $parent['id'];?>" <?php  if($row['parent_id'] == $parent['id']) { ?> selected <?php  } ?>><?php  echo $parent['name'];?></option>
                        <?php  if(is_array($parent['sub'])) { foreach($parent['sub'] as $sub) { ?>
	                      <option value="<?php  echo $sub['id'];?>" <?php  if($row['parent_id'] == $sub['id']) { ?> selected <?php  } ?>>&nbsp;&nbsp;|—<?php  echo $sub['name'];?></option>
	                    <?php  } } ?>
                    <?php  } } ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">排序</label>
            <div class="col-sm-4"><input type="text" name="data[display]" value="<?php  if($row['display']) { ?> <?php  echo $row['display'];?> <?php  } else { ?> 0 <?php  } ?>" class="form-control"></div>
            <em>数字越小越靠前</em>
        </div>    
    
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">是否热门</label>
            <div class="col-sm-4">
              <select class="form-control" name="data[ishot]">
                <option value="1" <?php  if($row['ishot'] == 1) { ?>selected<?php  } ?>>是</option>
                <option value="0" <?php  if($row['ishot'] == 0) { ?>selected<?php  } ?>>否</option>
              </select>
            </div>
        </div>
        
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">是否显示</label>
            <div class="col-sm-4">
              <select class="form-control" name="data[isshow]">
              <?php  if($row['isshow']) { ?>
                <option value="1" <?php  if($row['isshow'] == 1) { ?>selected<?php  } ?>>是</option>
                <option value="0" <?php  if($row['isshow'] == 0) { ?>selected<?php  } ?>>否</option>
              <?php  } else { ?>
                <option value="1" selected>是</option>
              <?php  } ?>
              </select>
            </div>
        </div>
        
        <div class="form-group">
          <div class="col-sm-4"> </div>
        </div>
      
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-primary" name="save_category" value="提交">
            </div>
        </div>
    </form>
    <?php  } ?>
</div>
<script>
    /**
    *删除子类
    */
    function delete_category(cid){
        if(confirm('你确定删除该栏目?此操作不可恢复！')){
            $.get(
                    '<?php  echo $this->createWebUrl("DeleteCategoryAjax");?>',
                    {'cid' : cid},
                    function (data){
                    	if(data == '-2'){
                    		alert('存在子栏目，不可删除');
                    		return false;
                    	}else{
                    	    location.reload();
                    	}
                    }
                );          
        }           
    }
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>