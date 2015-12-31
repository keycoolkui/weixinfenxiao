<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li <?php  if($operation == 'display') { ?> class="active" <?php  } ?>><a href="<?php  echo $this->createWebUrl('adv',array('op' =>'display'))?>">幻灯片</a></li>
    <li<?php  if($operation == 'post') { ?> class="active" <?php  } ?>><a href="<?php  echo $this->createWebUrl('adv',array('op' =>'post'))?>">添加幻灯片</a></li>
    <!--    <li><a href="<?php  echo $this->createWebUrl('template',array('op' =>'display'))?>">模板管理</a></li>-->
</ul>
<?php  if($operation == 'display') { ?>
<div class="main">
    <div style="padding:15px;">
        <table class="table table-hover">
            <thead class="navbar-inner">
                <tr>
                    <th style="width:70px;">ID</th>
                    <th>显示顺序</th>					
                    <th>标题</th>
                    <th>连接</th>
                    <th style="width:90px;">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php  if(is_array($list)) { foreach($list as $adv) { ?>
                <tr>
                    <td><?php  echo $adv['id'];?></td>
                    <td><?php  echo $adv['displayorder'];?></td>
                    <td><?php  echo $adv['advname'];?></td>
                    <td><?php  echo $adv['link'];?></td>
                    <td><a href="<?php  echo $this->createWebUrl('adv', array('op' => 'post', 'id' => $adv['id']))?>">修改</a>
                        <a href="<?php  echo $this->createWebUrl('adv', array('op' => 'delete', 'id' => $adv['id']))?>">删除</a> </td>
                </tr>
                <?php  } } ?>
            </tbody>
        </table>
        <?php  echo $pager;?>
    </div>
</div>
<?php  } else if($operation == 'post') { ?>
<div class="main">
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" onsubmit='return formcheck()'>
        <input type="hidden" name="id" value="<?php  echo $adv['id'];?>" />
        <div class="panel panel-default">
            <div class="panel-heading">
                幻灯片设置
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">排序</label>
                    <div class="col-sm-9 col-xs-12">
                        <input type="text" name="displayorder" class="form-control" value="<?php  echo $adv['displayorder'];?>" />
                    </div>
                </div>
                <div class="form-group" style="display:none;">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">幻灯片标题</label>
                    <div class="col-sm-9 col-xs-12">
                        <input type="text" name="advname" id='advname' class="form-control" value="<?php  echo $adv['advname'];?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">幻灯片图片</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php  echo tpl_form_field_image('thumb',$adv['thumb']);?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">幻灯片链接</label>
                    <div class="col-sm-9 col-xs-12">
                        <input type="text" name="link" id='link' class="form-control" value="<?php  echo $adv['link'];?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否显示</label>
                    <div class="col-sm-9 col-xs-12">
                        <label class="radio-inline"><input type="radio" name="enabled" value="1" id="enabled1" <?php  if(empty($adv) || $adv['enabled'] == 1) { ?>checked="true"<?php  } ?> /> 是</label>
                        <label class="radio-inline"><input type="radio" name="enabled" value="0" id="enabled2"  <?php  if(!empty($adv) && $adv['enabled'] == 0) { ?>checked="true"<?php  } ?> /> 否</label>
                    </div>
                </div>
            </div>
        </div>
        <input name="submit" type="submit" value="提交" class="btn btn-primary span3">
        <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
    </form>
</div>
<!--
<script language='javascript'>
    function formcheck() {
        if ($("#advname").isEmpty()) {
            Tip.focus("advname", "请填写幻灯片名称!", "right");
            return false;
        }
       
        return true;
    }
    
</script>
-->
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>