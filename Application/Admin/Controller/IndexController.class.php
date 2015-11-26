<?php
namespace Admin\Controller;
class IndexController extends CommonController
{
    public function index()
    {
		//redirect('Admin/Login/Index');
    	$this->display();
    }
    
    function topFrame()
    {
    	$this->display('Public/topFrame');
    }
    
    function menuFrame()
    {
		if(!isset($_SESSION['menu']) || empty($_SESSION['menu']))
		{
	    	$roleId = unserialize(cookie('WYmanage_Alogin')['userInfo'])['role_id'];
	    	
	    	$nodeList = M('Node')->where('FIND_IN_SET('.$roleId.', role_id) AND status=1')->select();
	
	    	$result = array();
	    	foreach($nodeList as $key=>$val)
	    	{
	    		if($val['pid'] == 0)
	    		{
	    			$result[$val['id']] = array(
	    					'title'=>$val['title'],
	    					'icon'=>$val['icon'],
	    					'data'=>array()
	    			);
	    		}
	    	}
	    
	    	foreach($nodeList as $key=>$val)
	    	{
	    		if($val['pid'] > 0 && isset($val['pid']))
	    		{
	    			$result[$val['pid']]['data'][$key]['title'] = $val['title'];
	    			$result[$val['pid']]['data'][$key]['module'] = $val['module'];
	    		}
	    	}
	    	$_SESSION['menu'] = $result;
		}
    	$this->assign('menu', $_SESSION['menu']);
    	$this->display('Public/menuFrame');
    }
    
    function mainFrame()
    {
    	$url = array_reverse(explode('/', trim($_COOKIE['menu'], '/')));
    	if(!empty($_COOKIE['menu']))
    	{
    		$this->redirect($url[1].'/'.$url[0]);
    	}
    	 
    	$mysqlVersion = M('Admin')->query('SELECT VERSION() AS version')[0]['version'];
    
    	$result['info'] = array(
    			'操作系统'=>PHP_OS,
    			'运行环境'=>$_SERVER["SERVER_SOFTWARE"],
    			'PHP运行方式'=>php_sapi_name(),
    			'Mysql版本'=>$mysqlVersion,
    			'Web端口'=>$_SERVER['SERVER_PORT'],
    			'上传附件限制'=>ini_get('upload_max_filesize'),
    			'执行时间限制'=>ini_get('max_execution_time').'秒',
    			'服务器时间'=>date("Y年n月j日 H:i:s"),
    			'北京时间'=>gmdate("Y年n月j日 H:i:s",time()+8*3600),
    			'服务器域名/IP'=>$_SERVER['SERVER_NAME'].' [ '.gethostbyname($_SERVER['SERVER_NAME']).' ]',
    			'剩余空间'=>round((@disk_free_space(".")/(1024*1024)),2).'M',
    			'register_globals'=>get_cfg_var("register_globals")=="1" ? "ON" : "OFF",
    			'magic_quotes_gpc'=>(1===get_magic_quotes_gpc())?'YES':'NO',
    			'magic_quotes_runtime'=>(1===get_magic_quotes_runtime())?'YES':'NO',
    	);
    	$this->assign('result', $result);
    	$this->display('Public/mainFrame');
    }
    
    function footFrame()
    {
    	$this->display('Public/footFrame');
    }    
}