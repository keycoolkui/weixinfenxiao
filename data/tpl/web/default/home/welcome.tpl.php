<?php defined('IN_IA') or exit('Access Denied');?>
<div class="clearfix welcome-container">
	<?php  if($do == 'platform') { ?>
	<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('home/welcome-platform', TEMPLATE_INCLUDEPATH)) : (include template('home/welcome-platform', TEMPLATE_INCLUDEPATH));?>
	<?php  } ?>
	<?php  if($do == 'site') { ?>
	<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('home/welcome-site', TEMPLATE_INCLUDEPATH)) : (include template('home/welcome-site', TEMPLATE_INCLUDEPATH));?>
	<?php  } ?>
	<?php  if($do == 'mc') { ?>
	<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('home/welcome-mc', TEMPLATE_INCLUDEPATH)) : (include template('home/welcome-mc', TEMPLATE_INCLUDEPATH));?>
	<?php  } ?>
	<?php  if($do == 'setting') { ?>
	<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('home/welcome-setting', TEMPLATE_INCLUDEPATH)) : (include template('home/welcome-setting', TEMPLATE_INCLUDEPATH));?>
	<?php  } ?>
	<?php  if($do == 'extt') { ?>
	<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('home/welcome-extt', TEMPLATE_INCLUDEPATH)) : (include template('home/welcome-extt', TEMPLATE_INCLUDEPATH));?>
	<?php  } ?>
	<?php  if($do == 'ext') { ?>
	<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('home/welcome-ext', TEMPLATE_INCLUDEPATH)) : (include template('home/welcome-ext', TEMPLATE_INCLUDEPATH));?>
	<?php  } ?>
	<?php  if($do == 'solution') { ?>
	<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('home/welcome-solution', TEMPLATE_INCLUDEPATH)) : (include template('home/welcome-solution', TEMPLATE_INCLUDEPATH));?>
	<?php  } ?>
</div></div>

<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer-gw', TEMPLATE_INCLUDEPATH)) : (include template('common/footer-gw', TEMPLATE_INCLUDEPATH));?>