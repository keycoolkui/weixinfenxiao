<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li><a href="<?php  echo $this->createWebUrl('fansmanager');?>">代理</a></li>
    <li><a href="<?php  echo $this->createWebUrl('fansmanager', array('op'=>'nocheck'));?>">非代理</a></li>
    <li class="active"><a href="<?php  echo $this->createWebUrl('fansmanager', array('op'=>'addbusiness'));?>">添加业务员</a></li>
</ul>
<div class="main" style="margin-top: 20px;">
    <div class="panel panel-default">
        <div class="panel-heading">绑定业务员操作</div>
        <div class="panel-body">
            <h2>方式一</h2>
            <img class="ewm-thumbnail" id="ewmThumbnail" src="../addons/eso_sale/style/images/share/business<?php  echo $_W['uniacid'];?>.png">
            <br><span style="color: #f60;">请用业务员的微信扫上方二维码,进行添加业务员操作!</span>
            <br> <br>
            <h2>方式二</h2>
            <?php  echo $value;?> <br>
            <span style="color: #f60;">或者将上方网址发送到业务员手机内</span>
        </div>
    </div>
</div>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>