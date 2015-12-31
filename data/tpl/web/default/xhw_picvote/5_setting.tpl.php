<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="main">
    <ul class="nav nav-tabs">
        <li><a href="<?php  echo $this->createWebUrl('project');?>">项目管理</a></li>
        <li class="active"><a href="<?php  echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?>">高级设置</a></li>
    </ul>
<div class="clearfix">
<form class="form-horizontal form" action="" method="post" enctype="multipart/form-data">
    <div class="panel panel-default">
        <div class="panel-heading">高级设置</div>
	<input type="hidden" name="id" value="<?php  echo $_GPC['id'];?>">
 <button class="btn" disabled>注：获取openid功能启用必须是认证的服务号。</button>  
  <th></th>  
           <!--  <tr>
                <th>JSSDK上传图片</th>
            <td>
     <label class="radio inline">
             <input type="radio" name="jssdkpass" value="0" <?php  if($subject['jssdkpass'] == 0) { ?> checked="checked"<?php  } ?>/>不启用</label>
        <label class="radio inline">
             <input type="radio" name="jssdkpass" value="1" <?php  if($subject['jssdkpass'] == 1) { ?> checked="checked"<?php  } ?>/>启用</label>
               <span class="help-block">启用后将使用微信官方接口上传图片，兼容性稳定性更好。</span>
           </td>
             </tr> -->

<div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">高级获取openid</label>
            <div class="col-sm-9 col-xs-12">
              <label class="radio-inline">
          <input type="radio" name="openidpass" value="0"<?php  if($subject['openidpass']==0) { ?> checked="checked"<?php  } ?> onclick="$('#isSecret').hide();">不启用</label>
         <label class="radio-inline">
         <input type="radio" name="openidpass" value="1"<?php  if($subject['openidpass']==1) { ?> checked="checked"<?php  } ?> onclick="$('#isSecret').show();">启用</label>
               <div class="help-block">不启用则用户第一次关注需要回复关键词进入活动才能投票，启用后则无需回复关键词可直接点击链接投票。</div>
            </div>
        </div>

            <div id="isSecret" class="<?php  if($subject['openidpass']==0) { ?> hide<?php  } ?>">
<div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否强制关注</label>
            <div class="col-sm-9 col-xs-12">
              <label class="radio-inline">
         <input type="radio" name="followpass" value="0" <?php  if($subject['followpass'] == 0) { ?> checked="checked"<?php  } ?>/>必须关注</label>
         <label class="radio-inline">
         <input type="radio" name="followpass" value="1" <?php  if($subject['followpass'] == 1) { ?> checked="checked"<?php  } ?>/>无需关注</label>
               <div class="help-block">必须关注：关注才能投票、投稿。无需关注：只通过高级接口获取openid来判断用户是否已经投票，关注与否无关。</div>
            </div>
        </div>

            </div>

		  </div>
    </div>
    <div class="form-group">
        <div class="col-sm-12">
            <input name="submit" type="submit" value="提交" class="btn btn-primary col-lg-1">
            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
        </div>
    </div>
</form>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>