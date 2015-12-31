<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header-gw', TEMPLATE_INCLUDEPATH)) : (include template('common/header-gw', TEMPLATE_INCLUDEPATH));?>
<div id="row" style="margin-top: 20px;">
	<div class="col-md-12">
		<div class="panel panel-default" >
			<div class="panel-body">

		<form action="./index.php" method="get" role="form" class="form-horizontal">
			<div class="form-group">
				<div class="col-md-4" style="margin-top: 10px; padding-left: 15px;">
					<a class="btn btn-success btn-block" href="<?php  echo url('account/post-step');?>"><i class="fa fa-plus"></i> 添加公众号</a>
				</div>
				<div class="col-md-8" style="margin-top: 10px; padding-right: 15px;">
					<div class="input-group">
						<div class="input-group-addon">
							<span class="fa fa-search"></span>
						</div>
			<input type="hidden" name="c" value="account">
			<input type="hidden" name="a" value="display">

					<input type="text" class="form-control <?php  if(empty($_GPC['keyword']) && !empty($_GPC['s_uniacid'])) { ?>hide<?php  } ?>" placeholder="请输入微信公众号名称" name="keyword" id="s_keyword" value="<?php  echo $_GPC['keyword'];?>">
					<input type="text" class="form-control <?php  if(empty($_GPC['s_uniacid'])) { ?>hide<?php  } ?>" placeholder="请输入微信公众号ID" name="s_uniacid" id="s_uniacid" value="<?php  echo $_GPC['s_uniacid'];?>">
					<div class="input-group-btn">
						<button class="btn btn-primary"><i class="fa fa-search"></i> 搜索</button>
						<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
						<ul class="dropdown-menu dropdown-menu-right" role="menu">
							<li><a href="javascript:;" onclick="$('#s_uniacid').addClass('hide').val('');$('#s_keyword').removeClass('hide');">根据公众号名称搜索</a></li>
							<li><a href="javascript:;" onclick="$('#s_uniacid').removeClass('hide');$('#s_keyword').addClass('hide').val('');">根据公众号ID搜索</a></li>
						</ul>
					</div>
					</div>
				</div>
			</div>
		</form>


		<ul class="list-unstyled account" style="margin-top:20px;">
			<?php  if(is_array($list)) { foreach($list as $uni) { ?>
			<li>
				<div class="panell panel-default" style="margin-bottom: 0px;">
					<div class="panel-heading ui-draggable-handle">
						<div class="row" style="font-size:12px; line-height:19px; color:#666; font-weight: bold;">
							<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">主公众号名称：<span><?php  echo $uni['name'];?></span></div>
							<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 edit-group">服务套餐：<span  id="<?php  echo $uni['group']['id'];?>"><?php  echo $uni['group']['name'];?></span> <i class="fa fa-pencil" id="<?php  echo $uni['uniacid'];?>" style="cursor:pointer"></i></div>
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 text-right" style="position:static;">
								<?php  if($uni['role'] == 'founder') { ?>
									<a href="<?php  echo url('account/post-acid', array('uniacid' => $uni['uniacid']))?>" data-toggle="tooltip" data-placement="bottom" title="添加子公众号" style="padding-right: 10px;"><i class="fa fa-plus"></i></a> 
									<a href="<?php  echo url('account/permission', array('uniacid' => $uni['uniacid']))?>" data-toggle="tooltip" data-placement="bottom" title="添加操作用户" style="padding-right: 10px;"><i class="fa fa-user"></i></a>
									<a href="<?php  echo url('account/post', array('uniacid' => $uni['uniacid']))?>" data-toggle="tooltip" data-placement="bottom" title="编辑帐号信息" style="padding-right: 10px;"><i class="fa fa-pencil"></i></a>
									<a href="<?php  echo url('account/delete', array('uniacid' => $uni['uniacid']))?>" onclick="return confirm('删除主公众号其所属的子公众号及其它数据会全部删除，确认吗？');return false;" data-toggle="tooltip" data-placement="bottom" title="删除"><i class="fa fa-times"></i></a>
									
								<?php  } else if($uni['role'] == 'manager') { ?>
									<a href="<?php  echo url('account/post-acid', array('uniacid' => $uni['uniacid']))?>" data-toggle="tooltip" data-placement="bottom" title="添加子公众号" style="padding-right: 10px;"><i class="fa fa-plus"></i></a> 
									<a href="<?php  echo url('account/post', array('uniacid' => $uni['uniacid']))?>" data-toggle="tooltip" data-placement="bottom" title="编辑帐号信息" style="padding-right: 10px;"><i class="fa fa-pencil"></i></a>
									<a href="<?php  echo url('account/delete', array('uniacid' => $uni['uniacid']))?>" onclick="return confirm('删除主公众号其所属的子公众号及其它数据会全部删除，确认吗？');return false;" data-toggle="tooltip" data-placement="bottom" title="删除" ><i class="fa fa-times"></i></a>
									
								<?php  } ?>
							</div>
						</div>
					</div>
					<ul class="panel-body list-group ">
						<?php  if(is_array($uni['details'])) { foreach($uni['details'] as $account) { ?>
						<li class=" row list-group-item" style="line-height:50px; border:none;padding: 0px 15px;">
						
							<div class="col-xs-12 col-sm-12 col-md-3 col-lg-4 item" style="width: 41.6%;">
							<img <?php  if(file_exists(IA_ROOT . '/attachment/headimg_'.$account['acid'].'.jpg')) { ?> src="<?php  echo $_W['attachurl'];?>headimg_<?php  echo $account['acid'];?>.jpg?acid=<?php  echo $account['acid'];?>"<?php  } else if($account['type'] == '1') { ?>src="<?php  echo $_W['attachurl'];?>headimg_weixin.jpg"<?php  } else { ?>src="<?php  echo $_W['attachurl'];?>headimg_yixin.jpg"<?php  } ?> class="" width="40" height="40" style="border-radius: 50%;
								margin-right: 31px;
								background-color: #f6f7fe;
								border-color: #fff;
								-webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.30);
								-moz-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.30);
								box-shadow: 0 1px 2px rgba(0, 0, 0, 0.30);
								border: 1px solid #ddd;"  onerror="this.src='resource/images/gw-wx.gif'" />
								<span class="label label-default"><?php  echo $types[$account['type']]['title'];?></span>&nbsp;<?php  echo $account['name'];?>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 item" style="width: 24.333333%;">
								接入状态 : <?php  if($account['isconnect'] == 1) { ?><span class="text-success"><i class="fa fa-check-circle"></i>成功接入<?php  echo $types[$account['type']]['title'];?></span><?php  } else { ?><span class="text-warning"><i class="fa fa-times-circle"></i>未接入<?php  echo $types[$account['type']]['title'];?></span><?php  } ?>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 text-right" style="padding-bottom:5px;">
								<?php  if($uni['role'] <> 'operator') { ?>
								
                                       <a href="<?php  echo url('account/switch', array('acid' => $account['acid'], 'uniacid' => $account['uniacid']))?>" class="btn btn-default btn-rounded" ><i class="fontello-icon-tools"></i> 功能管理</a>
									<a href="<?php  echo url('account/bind/details', array('acid' => $account['acid'], 'uniacid' => $account['uniacid']))?>" class="btn btn-default btn-rounded" data-toggle="tooltip" data-placement="top" title="查看详细信息"><i class="fa fa-bar-chart-o"></i></a>
									<a href="<?php  echo url('account/bind/post', array('acid' => $account['acid'], 'uniacid' => $account['uniacid']))?>" class="btn btn-default btn-rounded" data-toggle="tooltip" data-placement="top" title="编辑"><i class="fa fa-pencil"></i></a>
									<?php  if(count($uni['details']) > 1) { ?>
										<a href="<?php  echo url('account/bind/delete', array('acid' => $account['acid'], 'uniacid' => $account['uniacid']))?>" onclick="return confirm('确认删除吗？');return false;" class="btn btn-default btn-rounded" data-toggle="tooltip" data-placement="top" title="删除"><i class="fa fa-times"></i></a>
									<?php  } ?>
								<?php  } ?>
							</div>
						</li>
						<?php  } } ?>
					</ul>
				</div>
			</li>
			<?php  } } ?>
		</ul>
	<?php  echo $pager;?>
	</div></div></div>
<script>
	function toggleDetails(elm) {
		$(elm).parent().parent().parent().parent().nextAll().slideToggle();
	}

	require(['bootstrap'],function($){
		$('.account .panel-heading a, .btn, .fa-question-circle').hover(function(){
			$(this).tooltip('show');
		},function(){
			$(this).tooltip('hide');
		});
	});

	//处理套餐变更
	require(['jquery', 'util'], function($, u){
		$('.account').delegate(".edit-group i","click",function(){
			var content = $(this).parent('div').html();
			var uniacid = $(this).attr('id');
			var groupid = $(this).parent().find('span').attr('id');
			
			var html = '<div class="input-group input-group-sm" style="line-height:30px;">' +
			           		'<select class="form-control" id="groupid" title="' + uniacid + '">' + 
			           			'<option value="0">基础服务</option>';
								<?php  if(is_array($group_account)) { foreach($group_account as $list) { ?>
									html += '<option value="<?php  echo $list['id'];?>"><?php  echo $list['name'];?></option>';
								<?php  } } ?>
								<?php  if($_W['isfounder']) { ?>
									html += '<option value="-1">所有服务</option>';
								<?php  } ?>
			    html = html + 
			           		'</select>' +
			           		'<span class="input-group-btn"><button class="btn btn-primary btn-confirm" id="btn-confirm-' + uniacid + '">确定</button></span>' +
			           	'</div>';
			
			$(this).parent('div').html(html);
			$('select[title="' + uniacid + '"] option[value="' + groupid + '"]').attr('selected', true);	
			
			$('#btn-confirm-' + uniacid).click(function() {
				var groupid = $('select[title="' + uniacid + '"] option:selected').val();
				$.post(location.href, {'groupid' : groupid, 'uniacid' : uniacid}, function(data){
					if(data == 'illegal-uniacid') {
						$('#btn-confirm-' + uniacid).parent().parent().parent().html(content);
						u.message('您没有操作该公众号的权限');
					} else if (data == 'illegal-group') {
						$('#btn-confirm-' + uniacid).parent().parent().parent().html(content);
						u.message('您没有使用该服务套餐的权限');
					} else {
						 var content_edit = '服务套餐：<span id="' + groupid + '">' + data + '</span> <i class="fa fa-pencil" id="' + uniacid + '" style="cursor:pointer"></i>';
						 $('#btn-confirm-' + uniacid).parent().parent().parent().html(content_edit);
					}
				});
			});
		});
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer-gw', TEMPLATE_INCLUDEPATH)) : (include template('common/footer-gw', TEMPLATE_INCLUDEPATH));?>