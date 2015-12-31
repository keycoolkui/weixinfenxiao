<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="main">
    <div class="panel panel-default">

        <div class="panel-heading">代理详细信息</div>
        <div class="panel-body">
            <form action="./index.php" method="get" class="form-horizontal" role="form">

                <input type="hidden" name="c" value="site" />
                <input type="hidden" name="a" value="entry" />
                <input type="hidden" name="id" value="<?php  echo $user['id'];?>">
                <input type="hidden" name="op" value="status">
                <input type="hidden" name="m" value="eso_sale" />
                <input type="hidden" name="do" value="fansmanager" />

                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">设置权限</label>
                    <div class="col-xs-12 col-sm-8 col-lg-9">
                        <label class="radio-inline"><input type="radio" name="status" value="1" <?php  if($user['status']==1) { ?>checked<?php  } ?>>可用</label>
                        <label class="radio-inline" ><input type="radio" name="status" value="0" <?php  if($user['status']==0) { ?>checked<?php  } ?>>禁用</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">是否为代理</label>
                    <div class="col-xs-12 col-sm-8 col-lg-9">
                        <label class="radio-inline"><input type="radio" name="flag" value="1" <?php  if($user['flag']==1) { ?>checked<?php  } ?>>是</label>
                        <label class="radio-inline" ><input type="radio" name="flag" value="0" <?php  if($user['flag']==0) { ?>checked<?php  } ?>>否</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">真实姓名</label>
                    <div class="col-xs-12 col-sm-8 col-lg-9">
                        <?php  if($user['realname']!="") { ?> <?php  echo $user['realname'];?><?php  } else { ?>--<?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">手机号码</label>
                    <div class="col-xs-12 col-sm-8 col-lg-9">
                        <?php  if($user['mobile']!="") { ?> <?php  echo $user['mobile'];?><?php  } else { ?>--<?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">注册时间</label>
                    <div class="col-xs-12 col-sm-8 col-lg-9">
                        <?php  echo date('Y-m-d H:i:s', $user['createtime']);?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">银行卡号</label>
                    <div class="col-xs-12 col-sm-8 col-lg-9">
                        <?php  if($user['banktype']!="") { ?> <?php  echo $user['banktype'];?>－<span id="bankcard"><?php  echo $user['bankcard'];?></span> <?php  } else { ?>--<?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">支付宝号</label>
                    <div class="col-xs-12 col-sm-8 col-lg-9">
                        <?php  if($user['alipay']!="") { ?> <?php  echo $user['alipay'];?><?php  } else { ?>--<?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">微信号码</label>
                    <div class="col-xs-12 col-sm-8 col-lg-9">
                        <?php  if($user['wxhao']!="") { ?> <?php  echo $user['wxhao'];?><?php  } else { ?>--<?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">备注</label>
                    <div class="col-xs-12 col-sm-8 col-lg-9">
                        <textarea name="content" class="form-control"><?php  echo $user['content'];?></textarea>
                    </div>
                </div>
                <input type="button" class="btn btn-primary span3" name="submit" onclick="history.go(-1)" value="返回" />
                <input type="submit" class="btn btn-primary span3" name="submit"  value="提交" />
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    window.onload = function(){
        var bankcard = "<?php  echo $user['bankcard'];?>";
        //var bankcard = bankcard.toString();
        if(bankcard != ''){
            var card = '';
            for(var i=0; i<5; i++){
                card = card + bankcard.substr(4*i,4) + ' ';
            }
            window.document.getElementById('bankcard').innerHTML = card;
        }
    }

</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
