<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller
{
	function emptyPage()
	{
		header("HTTP/1.0 404 Not Found");
		$this->display('Public:404');
	}
	
    public function index()
    {
    	$allowIpList = M('Admin')->field('bind_ip')->where('status=1')->select();
    	$allowIpList = array_filter(array_column($allowIpList, 'bind_ip'));
    	$currentIp = explode(',', get_client_ip());
    	$currentIp = empty($currentIp[0]) ? $currentIp : trim($currentIp[0]);
    	
    	if(!verifyIp($currentIp))
    	{
    		$currentIp = '';
    	}
    	
    	if(!$this->getAllowIpSearch($currentIp, $allowIpList))
    	{
    		$this->emptyPage();
    		die();
    	}
    	
    	if(cookie('referer') != 'Manage'.date('DFt', time()))
    	{
    		$this->emptyPage();
    		die();
    	}    	
    	
    	$userInfo = unserialize(cookie('WYmanage_Alogin')['userInfo']);
    	if($userInfo['status'] == 1)
    	{
    		//$this->redirect('Index/Index');
    		echo '<script>window.location.href="/Admin/Index/Index";</script>';
    	}
    	else
    	{
    		$this->display();
    	} 
    }
    
    private function getAllowIpSearch($currentIp, $allIpList)
    {
    	if(!is_array($allIpList) || empty($allIpList))
    	{
    		return false;
    	}
    
    	foreach($allIpList as $k=>$v)
    	{
    		if(is_numeric(strpos($v, ',')))
    		{
    			$value = explode(',', $v);
    			$res = $this->getAllowIpSearch($currentIp, $value);
    			if($res)
    			{
    				return true;
    			}
    		}
    		else if($currentIp == $v)
    		{
    			return true;
    		}
    		else if(substr($v, -1, 1) == '*')
    		{
    			$ipregexp = implode('|', str_replace( array('*','.'), array('\d+','\.') , array($v)));
    			$ipStatus = preg_match('/^('.$ipregexp.')$/', $currentIp) == 1;
    			if($ipStatus)
    			{
    				return true;
    			}
    		}
    	}
    	return false;
    }    
    
    
    function login_user()
    {
    	Load('extend');
    	$condition['account'] = array('eq', $_POST['username']);
    	$condition['status'] = array('eq', 1);
    	$condition['_logic'] = 'and';
    	$userInfo = M('Admin')->where($condition)->find();
    	$_SESSION['userInfo'] = $userInfo;
    
    	$status = adminPwdEncryptVerify($_POST['password'], $userInfo['password']);
    	if(!$status)
    	{
    		$this->ajaxReturn(array('status'=>0, 'msg'=>'密码错误'));
    	}
    	else
    	{
    		$ip		=	get_client_ip();
    		$time	=	time();
    		$data['last_login_time']	=	$time;
    		$data['login_count']	=	array('exp','login_count+1');
    		$data['last_login_ip']	=	$ip;
    		M('Admin')->where(array('id'=>$userInfo['id']))->save($data);
    		cookie('Alogin', array('auth'=>adminPwdEncrypt(C('ADMIN_AUTH_CODE')), 'userInfo'=>serialize($userInfo)), 'expire=3600&prefix=WYmanage_');
    		$this->ajaxReturn(array('status'=>1, 'msg'=>'密码正确'));
    	}
    }
    
    public function verify()
    {
    	$Verify = new \Think\Verify();
    	$Verify->fontSize = 16;
    	$Verify->length = 3;
    	$Verify->imageW = 120;
    	$Verify->imageH = 40;
    	$Verify->useNoise = false;
    	$Verify->useCurve = false;
    	$Verify->useNoise = false;
    	$Verify->entry();
    }
    
    public function check_verify()
    {
    	$verify = new \Think\Verify();
    	$status = $verify->check(trim($_GET['code']), '');
    	if($status === false)
    	{
    		$this->ajaxReturn(array('status'=>0, 'msg'=>'验证码错误'));
    	}
    	else
    	{
    		$this->ajaxReturn(array('status'=>1, 'msg'=>'验证码正确'));
    	}
    }
    
    public function logout()
    {
    	cookie('WYmanage_Alogin', null);
    	unset($_COOKIE['WYmanage_Alogin']);
    	unset($_SESSION['userInfo']);
    	unset($_SESSION['menuData']);
    	unset($_COOKIE['referer']);
    	$this->redirect('Login/index');
    }
}