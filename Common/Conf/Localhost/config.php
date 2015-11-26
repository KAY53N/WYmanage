<?php
$sysArr = array(
		'APP_STATUS'           => 'debug',
		'APP_DEBUG'            => false,
		'SHOW_PAGE_TRACE'      => false,
		'DB_FIELDS_CACHE'      => false,
		'APP_FILE_CASE'        => true,
		'TMPL_STRIP_SPACE'     => false,
		
		/* 允许访问列表和默认模块 */
		//'BIND_MODULE'          =>  'Home',
		'DEFAULT_MODULE'        =>  'Home',
		'MODULE_ALLOW_LIST'     =>  array('Home', 'Admin'),
		
		/* 是否开启session */
		'SESSION_AUTO_START'    =>  true,
		
		/* 多模块访问 */
		'MULTI_MODULE'          =>  true,
		
		/* 操作方法后缀 */
		'DEFAULT_C_LAYER'       =>  'Controller',
		'DEFAULT_THEME'         =>  'WYmanage',
		
		/* 缓存 */
		'DATA_CACHE_TIME'       =>  -100,
		'DATA_CACHE_COMPRESS'   =>  false,
		'DATA_CACHE_CHECK'      =>  false,
		'DATA_CACHE_PREFIX'     =>  '',
		'DATA_CACHE_TYPE'       =>  'File',
		//'DATA_CACHE_PATH'     =>  TEMP_PATH,
		'DATA_CACHE_KEY'        =>  '',
		'DATA_CACHE_SUBDIR'     =>  false,
		'DATA_PATH_LEVEL'       =>  1,
		
		/* 错误 */
		'ERROR_PAGE'            =>  '',
		'SHOW_ERROR_MSG'        =>  true,
		'TRACE_MAX_RECORD'      =>  100,

		/* 日志设置 */
		'LOG_RECORD'            =>  true,
		'LOG_TYPE'              =>  'File',
		'LOG_LEVEL'             =>  'EMERG,ALERT,CRIT,ERR',
		'LOG_FILE_SIZE'         =>  2097152,
		'LOG_EXCEPTION_RECORD'  =>  false,
		
		/* 模板引擎设置 */
		'TMPL_CONTENT_TYPE'     =>  'text/html',
		'TMPL_ACTION_ERROR'     =>  THINK_PATH.'Tpl/dispatch_jump.tpl',
		'TMPL_ACTION_SUCCESS'   =>  THINK_PATH.'Tpl/dispatch_jump.tpl',
		'TMPL_EXCEPTION_FILE'   =>  THINK_PATH.'Tpl/think_exception.tpl',
		'TMPL_DETECT_THEME'     =>  false,
		'TMPL_TEMPLATE_SUFFIX'  =>  '.html',
		'TMPL_FILE_DEPR'        =>  '/',
		
		// 布局设置
		'TMPL_ENGINE_TYPE'      =>  'Think',
		'TMPL_CACHFILE_SUFFIX'  =>  '.php',
		//'TMPL_DENY_FUNC_LIST'   =>  'echo,exit',
		'TMPL_DENY_PHP'         =>  false,
		'TMPL_L_DELIM'          =>  '<{',
		'TMPL_R_DELIM'          =>  '}>',
		'TMPL_VAR_IDENTIFY'     =>  'array',
		'TMPL_STRIP_SPACE'      =>  true,
		'TMPL_CACHE_ON'         =>  false,
		'TMPL_CACHE_PREFIX'     =>  '',
		'TMPL_CACHE_TIME'       =>  -100,
		'TMPL_LAYOUT_ITEM'      =>  '{__CONTENT__}',
		'LAYOUT_ON'             =>  false,
		'LAYOUT_NAME'           =>  'layout',

		/* URL设置 */
		'URL_CASE_INSENSITIVE'  =>  true,
		'URL_MODEL'             =>  2,
		'URL_PATHINFO_DEPR'     =>  '/',
		'URL_PATHINFO_FETCH'    =>  'ORIG_PATH_INFO,REDIRECT_PATH_INFO,REDIRECT_URL',
		'URL_REQUEST_URI'       =>  'REQUEST_URI',
		'URL_HTML_SUFFIX'       =>  'html',
		//'URL_DENY_SUFFIX'       =>  'ico|png|gif|jpg',
		'URL_PARAMS_BIND'       =>  true,
		'URL_PARAMS_BIND_TYPE'  =>  0,
		'URL_PARAMS_FILTER'     =>  false,
		'URL_PARAMS_FILTER_TYPE'=>  '',
		'URL_ROUTER_ON'         =>  false,
		'URL_ROUTE_RULES'       =>  array(),
		'URL_MAP_RULES'         =>  array(),
		
		'TOKEN_ON'              =>  true,
		'TOKEN_NAME'            =>  '__hash__',
		'TOKEN_TYPE'            =>  'md5',
		'TOKEN_RESET'           =>  true,
);

$databaseArr = array(
		'DB_TYPE'=>'mysql',
		'DB_HOST'=>'localhost',
		'DB_NAME'=>'WYmanage',
		'DB_USER'=>'root',
		'DB_PWD'=>'',
		'DB_PORT'=>'3306',
		'DB_PREFIX'=>'wy_',
);

$websiteConf = array(
		'WEB_TITLE'=>'标题111111111111',
		'WEB_KEYWORDS'=>'关键字1111111111111111111111',
		'WEB_DESCRIPTION'=>'描述11111111111111111111111111',
		'HOME_ENCRYPT'=>'bfe2eaeb62bb18850fd65adc0c2059c9',
		'ADMIN_ENCRYPT'=>'09d50e5ee23bda81b15a807a85968130',
		'HOME_AUTH_CODE'=>date('&@#Ymd#D#F#tz', time()),
		'ADMIN_AUTH_CODE'=>date('!#@Yzt#F#D#dm', time()),
		//Value 小写
		'ROLE_PUBLIC_NODE'=>array(
				'/admin/index/index',
				'/admin/index/menuframe',
				'/admin/index/topframe',
				'/admin/index/mainframe',
				'/admin/index/hideframe',
		),
);

return array_merge($sysArr, $databaseArr, $websiteConf);