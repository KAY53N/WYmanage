<?php
header('Content-type:text/html; charset=utf-8');

if(version_compare(PHP_VERSION,'5.5.0','<'))  die('require PHP > 5.5.0 !');

define('BUILD_DIR_SECURE', false);

define('COMMON_PATH', './Common/');

define('RUNTIME_PATH', './C55F0AE23AA/');

define('APP_PATH', './Application/');

require './ThinkPHP/ThinkPHP.php';