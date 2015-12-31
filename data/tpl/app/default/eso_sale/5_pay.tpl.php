<?php defined('IN_IA') or exit('Access Denied');?><?php  $this->pay($params);?>
<link type="text/css" rel="stylesheet" href="../addons/eso_sale/recouse/css/wx_nav.css">
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footerbar', TEMPLATE_INCLUDEPATH)) : (include template('footerbar', TEMPLATE_INCLUDEPATH));?>