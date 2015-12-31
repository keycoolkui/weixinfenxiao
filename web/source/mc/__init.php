<?php
/**
 * [Weizan System] Copyright (c) 2014 wdlcms.com
 * Weizan is NOT a free software, it under the license terms, visited http://www.wdlcms.com/ for more details.
 */
if ($do == 'oauth' || $action == 'credit' || $action == 'passport' || $action == 'uc') {
	define('FRAME', 'setting');
} else {
	define('FRAME', 'mc');
}
$frames = buildframes(array(FRAME));
$frames = $frames[FRAME];
