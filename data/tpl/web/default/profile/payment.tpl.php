<?php defined('IN_IA') or exit('Access Denied');?><?php  $newUI = true;?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<script type="text/javascript">
	function tokenGen() {
		var letters = 'abcdefghijklmnopqrstuvwxyz0123456789';
		var token = '';
		for(var i = 0; i < 32; i++) {
			var j = parseInt(Math.random() * (31 + 1));
			token += letters[j];
		}
		$(':text[name="wechat[apikey]"]').val(token);
	}
	require(['angular'], function(angular){
		angular.module('app', []).controller('paySetting', function($scope){
			$scope.delivery = {
				switch: <?php  if($pay['delivery']['switch']) { ?>'true'<?php  } else { ?>'false'<?php  } ?>
			};
			$scope.credit = {
				switch: <?php  if($pay['credit']['switch']) { ?>'true'<?php  } else { ?>'false'<?php  } ?>
			};
			$scope.card = {
				switch: <?php  if(empty($pay['card']['switch'])) { ?>'1'<?php  } else { ?><?php  echo $pay['card']['switch'];?><?php  } ?>
			};
			$scope.alipay = {
				switch: <?php  if($pay['alipay']['switch']) { ?>'true'<?php  } else { ?>'false'<?php  } ?>
			};
			$scope.unionpay = {
				switch: <?php  if($pay['unionpay']['switch']) { ?>'true'<?php  } else { ?>'false'<?php  } ?>
			};
			$scope.baifubao = {
				switch: <?php  if($pay['baifubao']['switch']) { ?>'true'<?php  } else { ?>'false'<?php  } ?>
			};
			<?php  if(!empty($accounts)) { ?>
			$scope.wechat = {
				switch: <?php  if($pay['wechat']['switch']) { ?>'true'<?php  } else { ?>'false'<?php  } ?>,
				accounts: <?php  echo json_encode($accounts)?>
			};
			$scope.wechat.account = $scope.wechat.accounts['<?php  echo $pay['wechat']['account'];?>'];
			if(!$scope.wechat.account) {
				$.each($scope.wechat.accounts, function(){
					$scope.wechat.account = this;
					return false;
				});
			}
			<?php  } ?>
		});
		angular.bootstrap(document, ['app']);
		//支付宝和微信支付开启验证
		$("#payform").submit(function(){
			var $scope = angular.element('#payform').scope();
			if($scope.alipay.switch == 'true') {
				if($.trim($(':text[name="alipay[account]"]').val()) == '') {
					util.message('必须输入收款支付宝账号.', '', 'error');
					return false;
				}
				if($.trim($(':text[name="alipay[partner]"]').val()) == '') {
					util.message('必须输入合作者身份.', '', 'error');
					return false;
				}
				if($.trim($(':text[name="alipay[secret]"]').val()) == '') {
					util.message('必须输入收款支付宝校验密钥.', '', 'error');
					return false;
				}
			}
			$(':hidden[name="alipay[t]"]').val('');
			if($(':radio[name="wechat[switch]"]:checked').val() == 'true') {
				if($scope.wechat.account.key == '') {
					util.message('必须输入身份标识.', '', 'error');
					return false;
				}
				if($scope.wechat.account.token == '') {
					util.message('必须输入身份密钥.', '', 'error');
					return false;
				}
				if($(':radio[name="wechat[version]"]:checked').val() == '1' && $.trim($(':text[name="wechat[signkey]"]').val()) == '') {
					util.message('必须输入通信密钥.', '', 'error');
					return false;
				}
				if($(':radio[name="wechat[version]"]:checked').val() == '1' && $.trim($(':text[name="wechat[partner]"]').val()) == '') {
					util.message('必须输入商户身份.', '', 'error');
					return false;
				}
				if($(':radio[name="wechat[version]"]:checked').val() == '1' && $.trim($(':text[name="wechat[key]"]').val()) == '') {
					util.message('必须输入商户密钥.', '', 'error');
					return false;
				}

				if($(':radio[name="wechat[version]"]:checked').val() == '2' && $.trim($(':text[name="wechat[mchid]"]').val()) == '') {
					util.message('必须输入微信支付商户号.', '', 'error');
					return false;
				}
				if($(':radio[name="wechat[version]"]:checked').val() == '2' && $.trim($(':text[name="wechat[apikey]"]').val()) == '') {
					util.message('必须输入商户支付密钥.', '', 'error');
					return false;
				}
			}
		});
		
		//支付宝测试
		$("#tPost").click(function(){
			var $scope = angular.element('#payform').scope();
			if($scope.alipay.switch == 'true') {
				if($.trim($(':text[name="alipay[account]"]').val()) == '') {
					util.message('必须输入收款支付宝账号.', '', 'error');
					return false;
				}
				if($.trim($(':text[name="alipay[partner]"]').val()) == '') {
					util.message('必须输入合作者身份.', '', 'error');
					return false;
				}
				if($.trim($(':text[name="alipay[secret]"]').val()) == '') {
					util.message('必须输入收款支付宝账号.', '', 'error');
					return false;
				}
				if(confirm('你可能需要修改您的浏览器 User-Agent 来模拟手机浏览才能正常测试, 请确认已经修改好.')) {
					$(':hidden[name="alipay[t]"]').val('true');
					$('#payform')[0].submit();
				}
			}
		});
	});
</script>
<div class="main">
	<form id="payform" action="<?php  echo url('profile/payment')?>" enctype="multipart/form-data" method="post" class="form-horizontal form" onsubmit="return validate();" ng-controller="paySetting">
		<div class="panel panel-default">
			<div class="panel-heading">
				设置货到支付开关
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">货到支付</label>
					<div class="col-sm-8 col-xs-12">
						<label class="radio-inline">
							<input type="radio" name="delivery[switch]" ng-model="delivery.switch" value="true"/>
							开启
						</label>
						<label class="radio-inline">
							<input type="radio" name="delivery[switch]" ng-model="delivery.switch" value="false"/>
							关闭
						</label>
						<span class="help-block">是否支持货到付款</span>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				设置余额支付开关
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">余额支付</label>
					<div class="col-sm-8 col-xs-12">
						<label class="radio-inline">
							<input type="radio" name="credit[switch]" ng-model="credit.switch" value="true"/>
							开启
						</label>
						<label class="radio-inline">
							<input type="radio" name="credit[switch]" ng-model="credit.switch" value="false"/>
							关闭
						</label>
						<span class="help-block">是否使用粉丝中心的余额直接支付</span>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				设置卡券使用开关
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">卡券使用开关</label>
					<div class="col-sm-8 col-xs-12">
						<label class="radio-inline">
							<input type="radio" name="card[switch]" ng-model="card.switch" value="1"/>
							不开启卡券使用
						</label>
						<label class="radio-inline">
							<input type="radio" name="card[switch]" ng-model="card.switch" value="2"/>
							使用微信卡券
						</label>
						<label class="radio-inline">
							<input type="radio" name="card[switch]" ng-model="card.switch" value="3"/>
							使用系统卡券
						</label>
						<span class="help-block">设置支付时候是否可以使用卡券。微信卡券只能在微信浏览器中使用</span>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				设置支付宝支付开关
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">支付宝无线支付</label>
					<div class="col-sm-9 col-xs-12">
						<div class="alert alert-warning">
							您的支付宝账号必须支持手机网页即时到账接口, 才能使用手机支付功能, <a href="https://b.alipay.com/order/productDetail.htm?productId=2013080604609688" target="_blank">申请及详情请查看这里</a>.
						</div>
						<label class="radio-inline">
							<input type="radio" name="alipay[switch]" ng-model="alipay.switch" value="true"/>
							开启
						</label>
						<label class="radio-inline">
							<input type="radio" name="alipay[switch]" ng-model="alipay.switch" value="false"/>
							关闭
						</label>
						<span class="help-block">是否使用支付宝无线支付</span>
						<input type="hidden" name="alipay[t]" />
					</div>
				</div>
				<div ng-show="alipay.switch == 'true'">
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">收款支付宝账号</label>
						<div class="col-sm-9 col-xs-12">
							<input type="text" name="alipay[account]" class="form-control" value="<?php  echo $pay['alipay']['account'];?>" autocomplete="off">
							<span class="help-block">如果开启兑换或交易功能，请填写真实有效的支付宝账号，用于收取用户以现金兑换交易积分的相关款项。如账号无效或安全码有误，将导致用户支付后无法正确对其积分账户自动充值，或进行正常的交易对其积分账户自动充值，或进行正常的交易。 如您没有支付宝帐号，<a href="https://memberprod.alipay.com/account/reg/enterpriseIndex.htm" target="_blank">请点击这里注册</a></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">合作者身份</label>
						<div class="col-sm-9 col-xs-12">
							<input type="text" name="alipay[partner]" class="form-control" value="<?php  echo $pay['alipay']['partner'];?>" autocomplete="off"/>
							<span class="help-block">支付宝签约用户请在此处填写支付宝分配给您的合作者身份，签约用户的手续费按照您与支付宝官方的签约协议为准。<br>如果您还未签约，<a href="https://memberprod.alipay.com/account/reg/enterpriseIndex.htm" target="_blank">请点击这里签约</a>；如果已签约,<a href="https://b.alipay.com/order/pidKey.htm?pid=2088501719138773&amp;product=fastpay" target="_blank">请点击这里获取PID、Key</a>;如果在签约时出现合同模板冲突，请咨询0571-88158090</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">校验密钥</label>
						<div class="col-sm-9 col-xs-12">
							<input type="text" name="alipay[secret]" class="form-control" value="<?php  echo $pay['alipay']['secret'];?>" autocomplete="off"/>
							<span class="help-block">支付宝签约用户可以在此处填写支付宝分配给您的交易安全校验码，此校验码您可以到支付宝官方的商家服务功能处查看</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">模拟测试</label>
						<div class="col-sm-9 col-xs-12 form-control-static">
							<a href="javascript:;" id="tPost">交易模拟测试</a>
							<span class="help-block">本测试将模拟提交 0.01 元人民币的订单进行测试，如果提交后成功出现付款界面，说明您站点的支付宝功能可以正常使用</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				设置微信支付开关
			</div>
			<div class="panel-body">
				<?php  if(!empty($accounts)) { ?>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">微信支付</label>
					<div class="col-sm-9 col-xs-12">
						<div class="alert alert-danger">
							因微信公众平台对部分认证订阅号开放申请微信支付的能力,系统在设置支付公众号时,认证的订阅号会出现在下拉选择框,请您根据自己的公众号类型进行选择。 <a href="https://mp.weixin.qq.com/cgi-bin/announce?action=getannouncement&key=1430372687&version=4&lang=zh_CN" target="_blank">详情请查看这里（登陆公众号后可查看）</a>.
						</div>
						<div class="alert alert-warning">
							你必须向微信公众平台提交企业信息以及银行账户资料，审核通过并签约后才能使用微信支付功能 <a href="https://mp.weixin.qq.com/paymch/readtemplate?t=mp/business/faq_tmpl" target="_blank">申请及详情请查看这里</a>.
						</div>
						<div class="alert alert-warning">
							<p>微动力9.0支持微信支付接口，注意你的微动力访问地址一定不要写错了，这里我们用访问地址代替下面说明中出现的链接，申请微信支付的接口说明如下：</p>
							<br>
							<h4>JS API网页支付参数</h4>
							<p>支付授权目录: <?php  echo $_W['siteroot'];?>payment/wechat/</p>
							<p>支付请求实例: <?php  echo $_W['siteroot'];?>payment/wechat/pay.php</p>
							<p>共享收货地址: 选择"是"</p>
							<br>
							<h4>Native原生支付</h4>
							<p>支付回调URL: <?php  echo $_W['siteroot'];?>payment/wechat/native.php</p>
							<p>维权通知URL: <?php  echo $_W['siteroot'];?>payment/wechat/rights.php</p>
							<p>警告通知URL: <?php  echo $_W['siteroot'];?>payment/wechat/warning.php</p>
						</div>
						<label class="radio-inline">
							<input type="radio" name="wechat[switch]" ng-model="wechat.switch" value="true" onclick="$('.s').hide();$('#mchid').show();$('#apikey').show();" />
							开启
						</label>
						<label class="radio-inline">
							<input type="radio" name="wechat[switch]" ng-model="wechat.switch" value="false" />
							关闭
						</label>
						<span class="help-block">是否使用微信支付</span>
					</div>
				</div>
				<?php  if(empty($pay['wechat']['version']) && !empty($pay['wechat']['signkey'])) { ?>
					<?php  $pay['wechat']['version'] = 1;?>
				<?php  } ?>
				<div ng-show="wechat.switch == 'true'">
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">接口类型</label>
						<div class="col-sm-9 col-xs-12">
							<label class="radio-inline" onclick="$('.s').show();$('#mchid').hide();$('#apikey').hide();">
								<input type="radio" name="wechat[version]" value="1" <?php  if($pay['wechat']['version'] == 1) { ?> checked="checked"<?php  } ?> autocomplete="off" />
								旧版
							</label>
							<label class="radio-inline" onclick="$('.s').hide();$('#mchid').show();$('#apikey').show();">
								<input type="radio" name="wechat[version]" value="2" <?php  if($pay['wechat']['version'] == 2 || empty($pay['wechat']['version'])) { ?> checked="checked"<?php  } ?> autocomplete="off" />
								新版(2014年9月之后申请的)
							</label>
							<span class="help-block">由于微信支付接口调整，需要根据申请时间来区分支付接口</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">支付账号</label>
						<div class="col-sm-9 col-xs-12">
							<select ng-model="wechat.account" ng-options="acc.name for (acid, acc) in wechat.accounts" class="form-control">
							</select>
							<span class="help-block">您有多个微信公众账号, 请选择其中支持微信支付的账号并填写支付参数</span>
							<input type="hidden" name="wechat[account]" value="{{wechat.account.acid}}"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">身份标识<br />(appId)</label>
						<div class="col-sm-9 col-xs-12">
							<input type="text" class="form-control" ng-model="wechat.account.key" readonly="readonly" autocomplete="off">
							<span class="help-block">公众号身份标识 <a href="<?php  echo url('account/bind/post', array('uniacid' => $_W['uniacid']))?>&acid={{wechat.account.acid}}">请通过修改公众号信息来保存</a></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">身份密钥<br />(appSecret)</label>
						<div class="col-sm-9 col-xs-12">
							<input type="text" class="form-control" ng-model="wechat.account.secret" readonly="readonly" autocomplete="off"/>
							<span class="help-block">公众平台API(参考文档API 接口部分)的权限获取所需密钥Key <a href="<?php  echo url('account/bind/post', array('uniacid' => $_W['uniacid']))?>&acid={{wechat.account.acid}}">请通过修改公众号信息来保存</a></span>
						</div>
					</div>
					<div class="form-group s" <?php  if($pay['wechat']['version'] == 2) { ?> style="display:none;" <?php  } ?>>
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">商户身份<br />(partnerId)</label>
						<div class="col-sm-9 col-xs-12">
							<input type="text" name="wechat[partner]" class="form-control" value="<?php  echo $pay['wechat']['partner'];?>" autocomplete="off"/>
							<span class="help-block">财付通商户身份标识</span>
							<span class="help-block">公众号支付请求中用于加密的密钥Key</span>
						</div>
					</div>
					<div class="form-group s" <?php  if($pay['wechat']['version'] == 2) { ?> style="display:none;" <?php  } ?>>
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">商户密钥<br />(partnerKey)</label>
						<div class="col-sm-9 col-xs-12">
							<input type="text" name="wechat[key]" class="form-control" value="<?php  echo $pay['wechat']['key'];?>" autocomplete="off"/>
							<span class="help-block">财付通商户权限密钥Key</span>
						</div>
					</div>
					<div class="form-group" id="mchid" <?php  if($pay['wechat']['version'] == 1) { ?> style="display:none;" <?php  } ?>>
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">微信支付商户号(MchId)</label>
						<div class="col-sm-9 col-xs-12">
							<input type="text" name="wechat[mchid]" class="form-control" value="<?php  echo $pay['wechat']['mchid'];?>" autocomplete="off"/>
							<span class="help-block">公众号支付请求中用于加密的密钥Key</span>
						</div>
					</div>
					<div class="form-group s" id="signkey" <?php  if($pay['wechat']['version'] == 2) { ?> style="display:none;" <?php  } ?>>
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">通信密钥(paySignKey)</label>
						<div class="col-sm-9 col-xs-12">
							<input type="text" name="wechat[signkey]" class="form-control" value="<?php  echo $pay['wechat']['signkey'];?>" autocomplete="off"/>
							<span class="help-block">公众号支付请求中用于加密的密钥Key</span>
						</div>
					</div>
					<div class="form-group s" id="apikey" <?php  if($pay['wechat']['version'] == 1) { ?> style="display:none;" <?php  } ?>>
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">商户支付密钥(API密钥)</label>
						<div class="col-sm-9 col-xs-12">
							<div class="input-group">
								<input type="text" name="wechat[apikey]" id="apikey" class="form-control" maxlength="32" value="<?php  if(empty($pay['wechat']['signkey'])) { ?><?php  echo random(32);?><?php  } else { ?><?php  echo substr($pay['wechat']['signkey'], 0 , 32)?><?php  } ?>" autocomplete="off"/>
								<span onclick="tokenGen();" style="cursor:pointer" class="input-group-addon">生成新的</span>
							</div>
							<span class="help-block">此值需要手动在腾讯商户后台API密钥保持一致，<a href="http://bbs.wdlcms.com/wiki/" target="_blank">查看设置教程</a></span>
						</div>
					</div>
				</div>
				<?php  } else { ?>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">微信支付</label>
					<div class="col-sm-9 col-xs-12">
						<div class="alert alert-warning">
							你必须向微信公众平台提交企业信息以及银行账户资料，审核通过并签约后才能使用微信支付功能 <a href="http://bbs.wdlcms.com/wiki/" target="_blank">申请及详情请查看这里</a>.
						</div>
						<span class="help-block">你还没有支持微信支付的账号, <a href="<?php  echo url('account/post/list', array('uniacid' => $_W['uniacid']))?>">请添加或修改你的微信账号为认证服务号</a></span>
					</div>
				</div>
				<?php  } ?>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				设置银联支付开关
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">银联支付</label>
					<div class="col-sm-8 col-xs-12">
						<label class="radio-inline">
							<input type="radio" name="unionpay[switch]" ng-model="unionpay.switch" value="true"/>
							开启
						</label>
						<label class="radio-inline">
							<input type="radio" name="unionpay[switch]" ng-model="unionpay.switch" value="false"/>
							关闭
						</label>
						<span class="help-block">是否使用银联支付</span>
					</div>
				</div>
			</div>
			<div ng-show="unionpay.switch == 'true'">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">商户私钥证书（签名）</label>
					<div class="col-sm-9 col-xs-12 form-control-static">
						<?php  if($pay['unionpay']['signcertexists']) { ?>
						证书已上传&nbsp;&nbsp;&nbsp;&nbsp;<input type="file" name="unionpay[signcertpath]" id="amend" class="hidden"><input type="button" value="修改" onclick="amend.click()" class="btn btn-success btn-sm" style="padding: .2em .6em;">
						<?php  } else { ?>
						<input type="file" name="unionpay[signcertpath]" value="">
						<?php  } ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">商户私钥证书密码</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="unionpay[signcertpwd]" class="form-control" value="<?php  echo $pay['unionpay']['signcertpwd'];?>" autocomplete="off"/>
						<span class="help-block"></a></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">商户号</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="unionpay[merid]" class="form-control" value="<?php  echo $pay['unionpay']['merid'];?>" autocomplete="off"/>
						<span class="help-block"></a></span>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				设置百度钱包支付开关
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">百度钱包支付</label>
					<div class="col-sm-8 col-xs-12">
						<label class="radio-inline">
							<input type="radio" name="baifubao[switch]" ng-model="baifubao.switch" value="true"/>
							开启
						</label>
						<label class="radio-inline">
							<input type="radio" name="baifubao[switch]" ng-model="baifubao.switch" value="false"/>
							关闭
						</label>
						<span class="help-block">是否使用百度钱包支付</span>
					</div>
				</div>
			</div>
			<div ng-show="baifubao.switch == 'true'">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">商户号</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="baifubao[mchid]" class="form-control" value="<?php  echo $pay['baifubao']['mchid'];?>" autocomplete="off"/>
						<span class="help-block"></a></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">商户支付密钥</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="baifubao[signkey]" class="form-control" value="<?php  echo $pay['baifubao']['signkey'];?>" autocomplete="off"/>
						<span class="help-block"></a></span>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group col-sm-12">
			<input name="do-submit" type="submit" value="提交" class="btn btn-primary col-lg-1" />
			<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
		</div>
	</form>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
