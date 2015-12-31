<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
	<div class="main">
		<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" onsubmit="return validate(this);">
            <div class="panel panel-default">
                <div class="panel-heading">
                    活动细规设置（佣金设置项请到左侧下方参数设置去设置）
                </div>
                <div class="panel-body">
                    <div class="form-group" style="display:none">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">申请佣金周期</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="text" id="commtime" name="commtime" class="form-control" cols="60" value="<?php  echo $theone['commtime'];?>" />天
                            <div class="help-block">申请佣金所需要的周期，如果为0则马上能申请！</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">成为代理条件</label>
                        <div class="col-sm-9 col-xs-12">
                            <label class="radio-inline"><input type="radio"  name="promotertimes" value="1" <?php  if($theone['promotertimes'] == 1) { ?> checked="checked"<?php  } ?> /> 无条件</label>
                            <label class="radio-inline"><input type="radio"  name="promotertimes" value="0" <?php  if($theone['promotertimes'] == 0) { ?> checked="checked"<?php  } ?> /> 购买一单</label>
                            <div class="help-block">选择成为代理的条件，默认注册账号后无条件成为代理！</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">点击新增积分</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="text" id="clickcredit" name="clickcredit" class="form-control" cols="60" value="<?php  echo $theone['clickcredit'];?>" />
                            <div class="help-block">通过该粉丝分布到朋友圈或是直接分享到朋友的链接，点击一次增加多少积分</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">帮助说明</label>
                        <div class="col-sm-9 col-xs-12">
                            <textarea id="rule" style="height:150px;" name="rule" class="form-control" cols="60"><?php  echo $theone['rule'];?></textarea>
                            <div class="help-block">个人中心帮助说明和我要分销链接底部的相关说明</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">帮助说明引用链接</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="text" id="clickcredit1" name="clickcredit1" class="form-control" cols="60" value="<?php  echo $_W['siteroot']."app/".$this->mturl('rule')?>" />
                            <div class="help-block">在微信公众号自定义菜单上面直接引用该链接</div>
                        </div>
                    </div>
                    <div class="form-group" style="display:none">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">注册条款</label>
                        <div class="col-sm-9 col-xs-12">
                            <textarea id="terms" style="height:150px;" name="terms" class="form-control" cols="60"><?php  echo $theone['terms'];?></textarea>
                            <div class="help-block">注册条款相关说明</div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden"  name="id" value="<?php  echo $theone['id'];?>" />
            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
            <input name="submit" type="submit" value="提交" class="btn btn-primary span3">
		</form>
    </div>
<script>
    require(['jquery', 'util'], function($, u){
        $(function(){
            u.editor($('#rule')[0]);
            u.editor($('#terms')[0]);
        });
    });
</script>
	
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>

