<?php defined('IN_IA') or exit('Access Denied');?>			</div>
		</div>
	</div>
	<script>
		require(['bootstrap'], function($){
			$.post("<?php  echo url('utility/subscribe');?>");
			$.post("<?php  echo url('utility/sync');?>");
		});
	</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer-base', TEMPLATE_INCLUDEPATH)) : (include template('common/footer-base', TEMPLATE_INCLUDEPATH));?>