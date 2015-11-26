<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller {
	/*
	 * 
		header("HTTP/1.0 404 Not Found");
    	$this->display('Public:404');
    	
    */
	
	 Public function _initialize()
 	 {
 	 	$userInfo = unserialize(cookie('WYmanage_Alogin')['userInfo']);
 	 	if(adminPwdEncryptVerify(C('ADMIN_AUTH_CODE'), cookie('WYmanage_Alogin')['auth']) === false)
 	 	{
 	 		if(cookie('referer') != 'Manage'.date('DFt', time()))
 	 		{
				header('HTTP/1.0 404 Not Found');
		    	$this->display('Public:404');
		    	die();
 	 		}
 	 		else
 	 		{
 	 			$this->redirect('Login/index');
 	 		}
 	 	}
 	 	
 	 	if(empty($_SESSION['menuData']))
 	 	{
 	 		if(!empty($userInfo))
 	 		{
 	 			$roleId = $userInfo['role_id'];
 	 			$nodeList = M('Node')->where('FIND_IN_SET('.$roleId.',role_id) AND status=1')->select();
 	 		}

 	 		$result = array();
 	 		if(!empty($nodeList))
 	 		{
	 	 		foreach($nodeList as $key=>$val)
	 	 		{
	 	 			if($val['pid'] == 0)
	 	 			{
	 	 				$result[$val['id']] = array(
	 	 						'title'=>$val['title'],
	 	 						'data'=>array()
	 	 				);
	 	 			}
	 	 		}
	 	 		
	 	 		foreach($nodeList as $key=>$val)
	 	 		{
	 	 			if($val['pid'] > 0 && isset($val['pid']))
	 	 			{
	 	 				$result[$val['pid']]['data'][$key]['title'] = $val['title'];
	 	 				$result[$val['pid']]['data'][$key]['module'] = '/Admin/'.$val['module'];
	 	 			}
	 	 		}
	
	 	 		$_SESSION['menuData'] = $result;
 	 		}
 	 	}

 	 	$accessResult = false;
 	 	if(!empty($_SESSION['menuData']))
 	 	{
	 	 	foreach($_SESSION['menuData'] as $k=>$v)
	 	 	{
	 	 		foreach($v['data'] as $key=>$val)
	 	 		{
	 	 			preg_match('#\/(\w+)\/(\w+)\/#iUs', $val['module'], $accessNode);	
	 	 			$pathInfo = explode('/', $_SERVER['REQUEST_URI']);
	 	 			$resultUri = explode('/', $_SERVER['REQUEST_URI']);
	 	 			$resultUri = strtolower('/'.$resultUri[1].'/'.$resultUri[2].'/'.$resultUri[3]);
	 	 			$publicAccessStatus = array_search($resultUri, C('ROLE_PUBLIC_NODE'));
	 	 			if((strtolower('/'.$pathInfo[1].'/'.$pathInfo[2].'/') == strtolower($accessNode[0])) || ($publicAccessStatus !== false))
	 	 			{
	 	 				$accessResult = true;
	 	 			}
	 	 		}
	 	 	}
 	 	}

 	 	if($accessResult === false)
 	 	{
 	 		$this->error('没有权限操作此模块!');
 	 		die();
 	 	}
 	 }
	
	 function pr($val, $die=false)
	 {
	 	if(is_string($val))
	 	{
	 		echo '<pre>';
	 		echo $val;
	 		echo '</pre>';
	 	}
	 	else if(is_array($val) || is_object($val))
	 	{
	 		echo '<pre>';
	 		print_r($val);
	 		echo '</pre>';
	 	}
	 	else if(is_null($val))
	 	{
	 		echo NULL;
	 	}
	 	$die == true ? die() : null;
	 }
	 
	 function pageNavgation($count, $pageSize = 10)
	 {
	 	import('@.ORG.Page');
	 	$page = new Page($count, $pageSize);
	 	$page->setConfig('header', '条记录');
	 	$page->setConfig('theme', '<span class="pagestyle" style="color:blue">共%totalRow%%header%</span> <span class="pagestyle">当前%nowPage%&nbsp;/&nbsp;%totalPage% 页</span> %first% %upPage% %linkPage% %downPage% %end%');
	 	return $page;
	 }
	 
	 function zaddslashes($string, $force = 0, $strip = FALSE)
	 {
	 	if (!defined('MAGIC_QUOTES_GPC'))
	 	{
	 		define('MAGIC_QUOTES_GPC', '');
	 	}
	 	if (!MAGIC_QUOTES_GPC || $force)
	 	{
	 		if (is_array($string)) {
	 			foreach ($string as $key => $val)
	 			{
	 				$string[$key] = $this->zaddslashes($val, $force, $strip);
	 			}
	 		}
	 		else
	 		{
	 			$string = ($strip ? stripslashes($string) : $string);
	 			$string = htmlspecialchars($string);
	 			
	 			//$sysKeyword = "value|group|alter|\$|substring|'|truncate|script|frame|group|having|like|modify|rename|join|outfile|database|embed|applet|cast|object|document|cookie|where|drop|insert|update|delete|confirm|alert| and |%20and%20| or |%20or%20|load_file|outfile|schema|passwd|cnf|shadow|shutdown";
	 			//$keywordArr = explode('|', $sysKeyword);
	 			//$badword = array_combine($keywordArr, array_fill(0, count($keywordArr), '?鶻'));
	 			//$string = strtr($string, $badword);
	 		}
	 	}
	 	return $string;
	 }
	 
	 public function exportExcel($headArr, $data, $fileName='info')
	 {
    		import('@.ORG.XmlExcel');
    		$xls=new XmlExcel();
    		$xls->setDefaultWidth(180);
    		$xls->setDefaultAlign("left");
    		$xls->setDefaultHeight(18);
    		$xls->addHead($headArr);
    		
    		foreach($data as $k=>$v)
    		{
    			$xls->addRow($v);
    		}
    		
    		$xls->export($fileName);
	 }
 }