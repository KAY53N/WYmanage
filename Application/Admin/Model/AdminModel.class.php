<?php
namespace Admin\Model;
use Think\Model;
class AdminModel extends Model
{
	public $_addAdminValidate = array(
		array('account', 'require', '请填写用户名'),
		array('account', 'checkAccount', '用户名已经存在', 1, 'callback'),
		array('nickname', 'require', '请填写用户昵称'),
		array('email', 'email', '邮箱格式不符合要求。'),
		array('password', 'checkPasswordLength', '密码必须6-18位字符', 2, 'callback'),
	);
	
	public function checkAccount($account)
	{
		$model = new Model('Admin');
		$status = $model->where('account="'.trim($account).'"')->getField('id');
		if(intval($status) > 0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	public function checkPasswordLength($password)
	{
		if(strlen($password) < 6 || strlen($password) > 18)
		{
			return false;
		}else{
			return true;
		}
	}
} 