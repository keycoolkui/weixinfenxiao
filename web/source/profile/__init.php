<?php
/**
 * [Weizan System] Copyright (c) 2014 wdlcms.com
 * Weizan is NOT a free software, it under the license terms, visited http://www.wdlcms.com/ for more details.
 */

if($controller == 'profile' && $action == 'notify') { 
	define('FRAME', 'mc');
} elseif(empty($_GPC['m']) && $action != 'module') {
	define('FRAME', 'setting');
} else {
	define('FRAME', 'ext');
}
$frames = buildframes(array(FRAME));
$frames = $frames[FRAME];

