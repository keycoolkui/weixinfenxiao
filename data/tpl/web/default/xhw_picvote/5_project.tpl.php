<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>

<div class="main">
    <ul class="nav nav-tabs">
        <li class="active"><a href="<?php  echo $this->createWebUrl('project');?>">项目管理</a></li>
        <li><a href="<?php  echo $this->createWebUrl('addproject');?>">添加项目</a></li>
    </ul>
 <div class="panel panel-info">
    <div class="panel-heading">筛选</div>
    <div class="panel-body">
        <form action="./index.php" method="get" class="form-horizontal" role="form">
            <input type="hidden" name="c" value="site" />
            <input type="hidden" name="a" value="entry" />
            <input type="hidden" name="m" value="xhw_picvote" />
            <input type="hidden" name="do" value="project" />
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">编号</label>
                <div class="col-sm-8 col-lg-9">
                    <input class="form-control" name="keywords" id="" type="text" value="<?php  echo $_GPC['keywords'];?>">
                </div>
                                <div class=" col-xs-12 col-sm-2 col-lg-2">
                    <button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
                </div>
            </div>
            <div class="form-group">
            </div>
        </form>
    </div>
 
    </div>
 
  <div class="panel panel-default">
        <div class="panel-body table-responsive">
            <table class="table table-hover">
                <thead class="navbar-inner">
                    <tr>
                        <th style="width:40px;">编号</th>
                        <th style="width:100px;">项目名称</th>
                        <th style="width:60px;">已审核投稿</th>
                        <th style="width:60px;">未审核投稿</th>
                        <th style="width:60px;">投票人次</th>
                        <th style="width:60px;">分享次数</th>
                        <th style="width:400px;">管理</th>
                        <th style="width:120px; text-align:right;">操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  if(is_array($list)) { foreach($list as $row) { ?>
                  <tr> 
                    <td><?php  echo $row['id'];?></td>
                    <td><?php  echo $row['title'];?></td>
                    <td><?php  $num=$row['id'];echo pdo_fetchcolumn("SELECT count(*) FROM ".tablename(xhw_picvote_reg)." WHERE rid='$num' AND pass='1'");?></td>
                    <td><?php  $num=$row['id'];echo pdo_fetchcolumn("SELECT count(*) FROM ".tablename(xhw_picvote_reg)." WHERE rid='$num' AND pass!='1'");?></td>
                    <td><?php  $num=$row['id'];echo pdo_fetchcolumn("SELECT count(*) FROM ".tablename(xhw_picvote_log)." WHERE rid='$num'");?></td>
                    <td><?php  echo $row['sharenum'];?></td>
                    <td>
                    <a href="<?php  echo $this->createWebUrl('vote', array('id' => $row['id']))?>" class="btn btn-primary">管理投票</a>
                    <a href="<?php  echo $this->createWebUrl('voice', array('id' => $row['id']))?>" class="btn btn-success">审核投稿</a>
                    <a href="<?php  echo $this->createWebUrl('ad', array('id' => $row['id']))?>" class="btn btn-primary">广告管理</a>
                    <a href="<?php  echo $this->createWebUrl('adimg', array('id' => $row['id']))?>" class="btn btn-success">幻灯片管理</a>
                    <a href="<?php  echo $this->createWebUrl('log', array('id' => $row['id']))?>" class="btn btn-primary">投票记录</a>
                    </td>
                  <td style="text-align:right;">
                  <a class="btn btn-success btn-sm" href="<?php  echo $this->createWebUrl('addproject', array('id' => $row['id']))?>" title="编辑"><i class="icon-edit"></i>编辑</a>
                  <a class="btn btn-default btn-sm" href="#" onclick="drop_confirm('您确定要删除吗?', '<?php  echo $this->createWebUrl('addproject',array('op'=>'delete', 'id'=>$row['id']))?>');" title="删除"><i class="icon-remove"></i>删除</a>
                    </td>
                </tr>
                <?php  } } ?>
            </tbody>
            </table>
        </div>
        <?php  echo $pager;?>
    </div>
    </div>

<script type="text/javascript">
    function drop_confirm(msg, url){
        if(confirm(msg)){
            window.location = url;
        }
    }
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>