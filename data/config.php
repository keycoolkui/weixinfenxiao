<?php
defined('IN_IA') or exit('Access Denied');

$config = array();

$config['db']['host'] = '115.28.191.81';
$config['db']['username'] = 'weixinfenxiao';
$config['db']['password'] = '123456';
$config['db']['port'] = '3306';
$config['db']['database'] = 'weixin_nsyouxian';
$config['db']['charset'] = 'utf8';
$config['db']['pconnect'] = 0;
$config['db']['tablepre'] = 'ims_';

// --------------------------  CONFIG COOKIE  --------------------------- //
$config['cookie']['pre'] = 'd56a_';
$config['cookie']['domain'] = '';
$config['cookie']['path'] = '/';

// --------------------------  CONFIG SETTING  --------------------------- //
$config['setting']['charset'] = 'utf-8';
$config['setting']['cache'] = 'mysql';
$config['setting']['timezone'] = 'Asia/Shanghai';
$config['setting']['memory_limit'] = '256M';
$config['setting']['filemode'] = 0644;
$config['setting']['authkey'] = 'afe329bf';
$config['setting']['founder'] = '1';
$config['setting']['development'] = 1;
$config['setting']['referrer'] = 0;

// --------------------------  CONFIG UPLOAD  --------------------------- //
$config['upload']['image']['extentions'] = array('gif', 'jpg', 'jpeg', 'png');
$config['upload']['image']['limit'] = 5000;
$config['upload']['attachdir'] = 'attachment';
$config['upload']['audio']['extentions'] = array('mp3');
$config['upload']['audio']['limit'] = 5000;