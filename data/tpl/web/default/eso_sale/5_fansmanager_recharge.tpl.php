<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="main">
	<div class="form form-horizontal">
        <div class="panel panel-default">

            <div class="panel-heading">代理充值信息</div>
            <div class="panel-body">
                <form action="./index.php" method="get" class="form-horizontal" role="form">

                    <input type="hidden" name="c" value="site" />
                    <input type="hidden" name="a" value="entry" />

                    <input type="hidden" name="id" value="<?php  echo $user['id'];?>">
                    <input type="hidden" name="op" value="recharge">
                    <input type="hidden" name="opp" value="recharged">
                    <input type="hidden" name="m" value="eso_sale" />
                    <input type="hidden" name="do" value="fansmanager" />

                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">真实姓名</label>
                        <div class="col-xs-12 col-sm-8 col-lg-9">
                            <?php  if($user['realname']!="") { ?> <?php  echo $user['realname'];?><?php  } else { ?>未完善<?php  } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">手机号码</label>
                        <div class="col-xs-12 col-sm-8 col-lg-9">
                            <?php  if($user['mobile']!="") { ?> <?php  echo $user['mobile'];?><?php  } else { ?>未完善<?php  } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">已结佣金</label>
                        <div class="col-xs-12 col-sm-8 col-lg-9">
                            <?php  echo $user['commission'];?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">可结佣金</label>
                        <div class="col-xs-12 col-sm-8 col-lg-9">
                            <input type="text" placeholder="还需充值：<?php  echo $commission;?>元" name="commission" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">备注</label>
                        <div class="col-xs-12 col-sm-8 col-lg-9">
                            <textarea name="content" class="form-control"><?php  echo $user['content'];?></textarea>
                        </div>
                    </div>
                    <input type="button" class="btn btn-primary span3" name="submit" onclick="history.go(-1)" value="返回" />
                    <input type="submit" class="btn btn-primary span3" name="submit"  value="充值" onclick="return check();"/>
                </form>
            </div>
        </div>
		<?php  if(!empty($commissions)) { ?>
		<table class="table table-hover">
				<thead class="navbar-inner">
					<tr>
						<th class="row-hover" style="text-align: center;">支付佣金</th>
						<th class="row-hover" style="text-align: center;">支付时间</th>
						<th class="row-hover" style="text-align: center;">备注</th>
						
					</tr>
				</thead>
				<tbody>
					<?php  if(is_array($commissions)) { foreach($commissions as $comm) { ?>
						<tr>
							<td style="text-align: center;">
								<?php  echo $comm['commission'];?>
							</td>
							<td style="text-align: center;">
								<?php  echo date('Y-m-d H:i:s',$comm['createtime'])?>
							</td>
							<td style="text-align: center;">
								<?php  if(empty($comm['content'])) { ?>无<?php  } else { ?><?php  echo $comm['content'];?><?php  } ?>
							</td>
						</tr>
					<?php  } } ?>
				</tbody>
			</table>
		<?php  } ?>
	</div>
</div>

<script type="text/javascript">
function check(){
	var flag = false;
	if(confirm('确认要充值吗？')){
		flag = true;
	}

	if(<?php  echo $commission;?> <= 0){
		if(confirm('充值已符合条件，确认充值吗？')){
			flag = true;
		}else{
			flag = false;
		}
	}
	
	return flag;
}

</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
