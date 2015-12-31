<?php defined('IN_IA') or exit('Access Denied');?>﻿</div>			</div>
		</div>
	<script type="text/javascript">
			require(['bootstrap']);
			<?php  if($_W['isfounder'] && !defined('IN_MESSAGE')) { ?>
			function checkupgrade() {
				require(['util'], function(util) {
					if (util.cookie.get('checkupgrade_sys')) {
						return;
					}
					$.getJSON("<?php  echo url('utility/checkupgrade/system');?>", function(ret){
						if (ret && ret.message && ret.message.upgrade == '1') {
							$('body').prepend('<div id="upgrade-tips" class="upgrade-tips" style="display:none;"><a href="./index.php?c=cloud&a=upgrade&">系统检测到新版本 '+ret.message.version+' ('+ ret.message.release +') ，请尽快更新！</a><span class="tips-close" style="background:#d03e14;" onclick="checkupgrade_hide();"><i class="fa fa-times-circle"></i></span></div>');
							if ($('#upgrade-tips-module').size()) {
								$('#upgrade-tips').css('top', '25px');
							}
						}
					});
				});
			}

			function checkupgrade_hide() {
				require(['util'], function(util) {
					util.cookie.set('checkupgrade_sys', 1, 3600);
					$('#upgrade-tips').hide();
				});
			}
			$(function(){
				checkupgrade();
			});
			<?php  } ?>
		</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer-base', TEMPLATE_INCLUDEPATH)) : (include template('common/footer-base', TEMPLATE_INCLUDEPATH));?>