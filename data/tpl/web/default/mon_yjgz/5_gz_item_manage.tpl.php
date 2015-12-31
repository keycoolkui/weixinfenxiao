<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>

<div class="main">
    <ul class="nav nav-tabs">
        <li
         class="active"><a href="<?php  echo $this->createWebUrl('GZItem',array('yid'=>$yid));?>">关注项管理</a></li>
        <li> <a href="<?php  echo $this->createWebUrl('GZItemedit',array('yid'=>$yid));?>">添加关注关注项</a></li>

        <li><a href="<?php  echo $this->createWebUrl('GZ');?>">关注管理</a></li>
    </ul>

    <div style="padding:15px;">
        <table class="table table-hover">
            <thead class="navbar-inner">
            <tr>
                <th >名称</th>
                <th>排序</th>
                <th>图标</th>
                <th width="300px" style="text-align: center">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php  if(is_array($list)) { foreach($list as $row) { ?>
            <tr>


                <td><?php  echo $row['title'];?></td>
                <td><?php  echo $row['sort'];?></td>
                <td><img src="<?php  echo $_W['attachurl'];?><?php  echo $row['icon'];?>" width="50px" height="50px"></td>


                <td width="300px" style="text-align: center">




                    <a class="btn" rel="tooltip"
                       href="<?php  echo $this->createWebUrl('GZItemedit',array('id'=>$row['id'],'yid'=>$row['yid']))?>" title="编辑"><i class="glyphicon glyphicon-edit"></i>编辑</a>

                    <a href="<?php  echo $this->createWebUrl('GzItem', array( 'id' => $row['id'], 'op' => 'delete'))?>"
                       onclick="return confirm('此操作不可恢复，确认删除？');return false;" title="删除"
                       class="btn btn-small"><i class="glyphicon glyphicon-remove"></i>删除</a>
                </td>
            </tr>
            <?php  } } ?>

            </tbody>
        </table>
        <?php  echo $pager;?>
    </div>

</div>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
