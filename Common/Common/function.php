<?php
function pr($val, $die=false)
{
	if(is_string($val))
 	{
 		echo '<pre style="background: #ccc">';
 		echo $val;
 		echo '</pre>';
 	}
 	else if(is_array($val) || is_object($val))
 	{
 		echo '<pre style="background: #ccc">';
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
 	$page = new \Think\Page($count, $pageSize);
 	$page->setConfig('theme', '当前：%NOW_PAGE%/%TOTAL_ROW%&nbsp;&nbsp;%HEADER%&nbsp;&nbsp;<div class="dataTables_paginate paging_simple_numbers" id="sample-table-2_paginate"><ul class="pagination">%UP_PAGE% %LINK_PAGE% %DOWN_PAGE%</ul></div>');
	return $page;
}

function check_verify($code, $id = '')
{
	$verify = new \Think\Verify();
	return $verify->check($code, $id);
}

function zaddslashes($string, $force=0, $strip=false, $breakArr = array())
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
				if(!in_array($key, $breakArr))
				{
					$string[$key] = zaddslashes($val, $force, $strip, $breakArr);
				}
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
 
function homePwdEncrypt($password)
{
 	if(is_string($password) && !empty($password))
 	{
 		return password_hash($password.C('HOME_ENCRYPT'), PASSWORD_BCRYPT);
 	}
 	return $password;
}
	 
function homePwdEncryptVerify($newPassword, $password)
{
	if(is_string($newPassword) && !empty($newPassword))
	{
		return password_verify($newPassword.C('HOME_ENCRYPT'), $password);
	}
	return false;
}


function adminPwdEncrypt($password)
{
	if(is_string($password) && !empty($password))
	{
		return password_hash($password.C('ADMIN_ENCRYPT'), PASSWORD_BCRYPT);
	}
	return $password;
}

function adminPwdEncryptVerify($newPassword, $password)
{
	if(is_string($newPassword) && !empty($newPassword))
	{
		return password_verify($newPassword.C('ADMIN_ENCRYPT'), $password);
	}
	return false;
}
	 
function common_verify($name='verify')
{
 	import("@.ORG.Image");
 	Image::buildImageVerify(4, 2, 'gif', 90, 22, $name);
}

function arrayToObject($result)
{
	if(gettype($result) != 'array') return;
	foreach($result as $k=>$v){
		if( gettype($v)=='array' || getType($v)=='object' )
			$result[$k]=(object)arrayToObject($v);
	}
	return (object)$result;
}

function objectToArray($result)
{
	$result = (array) $result;
	foreach($result as $k=>$v)
	{
		if(gettype($v)=='resource') return;
		if(gettype($v)=='object' || gettype($v)=='array')
			$result[$k]=(array)objectToArray($v);
	}
	return $result;
}

//过滤空格回车
function delspace($pcon){
	$pcon = preg_replace("/ /", "", $pcon);
	$pcon = preg_replace("/ /", "", $pcon);
	$pcon = preg_replace("/　/", "", $pcon);
	$pcon = preg_replace("/rn/", "", $pcon);
	$pcon = str_replace(chr(13), "", $pcon);
	$pcon = str_replace(chr(10), "", $pcon);
	$pcon = str_replace(chr(9), "", $pcon);
	return $pcon;
}

function getPhoneNumberBelong($mobile=0){//财付通接口
	$doc = new DOMDocument();
	$xmlurl='http://life.tenpay.com/cgi-bin/mobile/MobileQueryAttribution.cgi?chgmobile='.$mobile.'&f.xml';
	$doc->load($xmlurl); //读取xml文件
	$xmls = $doc->getElementsByTagName("root"); //取得root标签的对象数组
	foreach( $xmls as $xml ) {
		$province = $xml->getElementsByTagName( "province" ); //省份
		$data['province'] = delspace($province->item(0)->nodeValue); //省份
		$city = $xml->getElementsByTagName( "city" );
		$data['city']= delspace($city->item(0)->nodeValue); //城市
		$supplier = $xml->getElementsByTagName( "supplier" );
		$data['supplier'] = delspace($supplier->item(0)->nodeValue); //联通 移动 电信
	}
	return $data;
}

function getClientIp()
{
	if($HTTP_SERVER_VARS["HTTP_X_FORWARDED_FOR"])
	{
		$ip = $HTTP_SERVER_VARS["HTTP_X_FORWARDED_FOR"];
	}
	elseif($HTTP_SERVER_VARS["HTTP_CLIENT_IP"])
	{
		$ip = $HTTP_SERVER_VARS["HTTP_CLIENT_IP"];
	}
	elseif ($HTTP_SERVER_VARS["REMOTE_ADDR"])
	{
		$ip = $HTTP_SERVER_VARS["REMOTE_ADDR"];
	}
	elseif (getenv("HTTP_X_FORWARDED_FOR"))
	{
		$ip = getenv("HTTP_X_FORWARDED_FOR");
	}
	elseif (getenv("HTTP_CLIENT_IP"))
	{
		$ip = getenv("HTTP_CLIENT_IP");
	}
	elseif (getenv("REMOTE_ADDR"))
	{
		$ip = getenv("REMOTE_ADDR");
	}
	else
	{
		$ip = "Unknown";
	}
	return $ip;
}

function verifyIp($ip)
{
	if(filter_var($ip, FILTER_VALIDATE_IP))
	{
		return true;
	}
	return false;
}
