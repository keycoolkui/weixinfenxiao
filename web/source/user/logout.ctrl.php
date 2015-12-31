<?php
/**
 * [Weizan System] Copyright (c) 2014 wdlcms.com
 * Weizan is NOT a free software, it under the license terms, visited http://www.wdlcms.com/ for more details.
 */
defined('IN_IA') or exit('Access Denied');
isetcookie('__session', '', -10000);
$forward = $_GPC['forward'];
if(empty($forward)) {
	$forward = './?refersh';
}
header('Location:' . url('account/welcome'));
