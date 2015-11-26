<?php
ini_set('display_errors', 'On');
ini_set('magic_quotes_gpc', 'NO');
date_default_timezone_set('PRC');

$configFile = dirname(__FILE__).'/Localhost/config.php';
/*
if($_SERVER['HTTP_HOST'] == 'dev.wymanage.com')
{
	$configFile = dirname(__FILE__).'/Preview/config.php';
}
else if($_SERVER['HTTP_HOST'] == 'xxx.xxx.com' || $_SERVER['HTTP_HOST'] == 'xxx.xxx.com')
{
	//线上
	$configFile = dirname(__FILE__).'/Formal/config.php';
}
*/

$sysConfig = include_once($configFile);
return $sysConfig;