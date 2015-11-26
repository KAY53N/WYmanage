<?php
namespace Admin\Model;
use Think\Model;
class AdminModel extends Model
{
	public $_addNodeValidate = array(
		array('title', 'require', '请填写节点'),
		array('module', 'require', '请填写Module'),
	);
} 