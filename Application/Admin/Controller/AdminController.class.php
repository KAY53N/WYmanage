<?php
namespace Admin\Controller;
class AdminController extends CommonController
{
    public function index()
    {
    	$count = M('Admin')->count();
    	$page = new \Think\Page($count, 10);
    	$page->setConfig('theme', '<div class="col-xs-6"><div class="dataTables_info" id="sample-table-2_info" role="status" aria-live="polite">当前：%NOW_PAGE%/%TOTAL_PAGE%&nbsp;&nbsp;%HEADER%</div></div><div class="col-xs-6"><div class="dataTables_paginate paging_simple_numbers" id="sample-table-2_paginate"><ul class="pagination">%UP_PAGE% %LINK_PAGE% %DOWN_PAGE%</ul></div></div>');
    	$show = $page->show();
    	$result['list'] = M('Admin')->order('id ASC')->limit($page->firstRow.','.$page->listRows)->select();
    	$roleList = M('Role')->select();
    	$roleList = array_combine(array_column($roleList, 'id'), array_column($roleList, 'name'));
    	
    	$this->assign('result', $result);
    	$this->assign('show', $show);
    	$this->assign('roleList', $roleList);
    	$this->display();
    }
    
    public function add_admin()
    {
    	if(IS_POST)
    	{
    		$_POST = zaddslashes($_POST);
    		
    		$status = false;
    		$adminModel = D('Admin');

    		if (!$adminModel->validate($adminModel->_addAdminValidate)->create())
    		{
				$this->error($adminModel->getError());
			}
			else
			{
				$inData['account'] = $_POST['account'];
				$inData['nickname'] = $_POST['nickname'];
				$inData['email'] = $_POST['email'];
				$inData['bind_ip'] = $_POST['bind_ip'];
				$inData['password'] = $_POST['password'];
				$inData['role_id'] = intval($_POST['role_id']);
				$inData['status'] = intval($_POST['status']);
				
				$status = $adminModel->add($inData);
			}
			
			if($status)
			{
				$this->success('添加成功');
			}
			else
			{
				$this->error('添加失败');
			}
			
			die();
    	}
    	
    	$roleList = M('Role')->select();
    	$roleList = array_combine(array_column($roleList, 'id'), array_column($roleList, 'name'));
    	$this->assign('roleList', $roleList);
    	$this->display();
    }
    
    public function edit_admin()
    {
    	if(IS_POST)
    	{
    		$_POST = zaddslashes($_POST);
    	
    		$status = false;
    		$adminModel = D('Admin');

    		if (!$adminModel->validate($adminModel->_addAdminValidate)->create())
    		{
    			$this->error($adminModel->getError());
    		}
    		else
    		{
    			$saveData['nickname'] = trim($_POST['nickname']);
    			$saveData['email'] = trim($_POST['email']);
    			$saveData['bind_ip'] = trim($_POST['bind_ip']);
    			$saveData['password'] = $_POST['password'];
    			$saveData['role_id'] = intval($_POST['role_id']);
    			$saveData['status'] = intval($_POST['status']);
    	
    			$status = $adminModel->where('id='.intval($_POST['id']))->save($saveData);
    		}
    			
    		if($status)
    		{
    			$this->success('修改成功');
    		}
    		else
    		{
    			$this->error('修改失败');
    		}
    			
    		die();
    	}
    	
    	$detail = M('Admin')->where('id='.intval($_GET['id']))->find();
    	$roleList = M('Role')->select();
    	$roleList = array_combine(array_column($roleList, 'id'), array_column($roleList, 'name'));
    	
    	$this->assign('roleList', $roleList);
    	$this->assign('detail', $detail);
    	$this->display();
    }
    
    public function del_admin()
    {
    	isset($_GET) ? $deleteId = implode(',', $_GET) : 0;
    	$userInfo = unserialize(cookie('WYmanage_Alogin')['userInfo']);

    	if($userInfo['role_id'] != 1)
    	{
    		$this->error('非法操作！只允许超级管理员操作！');
    	}
    	 
    	$deleteId = $this->zaddslashes($deleteId);
    	$status = M('Admin')->delete($deleteId);
    	if($status)
    	{
    		$this->success('删除成功');
    	}
    	else
    	{
    		$this->error('删除失败');
    	}
    }    

    public function node()
    {
    	$result['list'] = M('Node')->order('id DESC')->select();
    	$newResult = array();
    	foreach($result['list'] as $key=>$val)
    	{
    		if($val['pid'] == 0)
    		{
    			$newResult[$val['id']] = array(
                    'id'=>$val['id'],
                    'role_id'=>$val['role_id'],
                    'title'=>$val['title'],
                    'remark'=>$val['remark'],
                    'status'=>$val['status'] == 1 ? '<span class="label label-sm label-success">正常</span>' : '<span class="label label-sm label-warning">停用</span>',
                    'pid'=>$val['pid'],
                    'data'=>array()
    			);
    		}
    	}
    	 
    	foreach($result['list'] as $key=>$val)
    	{
    		if($val['pid'] > 0 && isset($val['pid']))
    		{
    			$newResult[$val['pid']]['data'][$key] = $val;
    			$newResult[$val['pid']]['data'][$key]['module'] = $val['module'];
    			$newResult[$val['pid']]['data'][$key]['status'] = $val['status'] == 1 ? '<span class="label label-sm label-success">正常</span>' : '<span class="label label-sm label-warning">停用</span>';
    		}
    	}
    	 
    	$roleList = M('Role')->select();
    	$roleList = array_combine(array_column($roleList, 'id'), array_column($roleList, 'name'));
    	
    	$this->assign('result', $newResult);
    	$this->assign('roleList', $roleList);
    	$this->display();
    }
    
    public function add_node()
    {
    	if(IS_POST)
    	{
    		$_POST = zaddslashes($_POST);
    		 
    		$status = false;
    		$nodeModel = D('Node');
    		if (!$nodeModel->validate($nodeModel->_addNodeValidate)->create())
    		{
    			$this->error($nodeModel->getError());
    		}
    		else
    		{
    			$addData['pid'] = intval($_POST['pid']);
    			$addData['title'] = $_POST['title'];
    			$addData['role_id'] = implode($_POST['role_id'], ',');
    			$addData['module'] = $_POST['module'];
    			$addData['status'] = $_POST['status'] == 'on' ? '1' : '0';
    			$status = $nodeModel->add($addData);
    		}
    		 
    		if($status)
    		{
    			$this->success('添加节点成功');
    		}
    		else
    		{
    			$this->error('添加节点失败');
    		}
    		 
    		die();
    	}
    	
    	$roleList = M('Role')->select();
    	$topNodeList = M('Node')->field('id,pid,title')->where('status=1 AND pid=0')->select();
    	
    	$this->assign('roleList', $roleList);
    	$this->assign('topNodeList', $topNodeList);
    	$this->display();
    }
    
    public function edit_node()
    {
    	if(IS_POST)
    	{
    		$_POST = zaddslashes($_POST);
    		 
    		$status = false;
    		$nodeModel = D('Node');
    		if (!$nodeModel->validate($nodeModel->_addNodeValidate)->create())
    		{
    			$this->error($nodeModel->getError());
    		}
    		else
    		{
    			$saveData['pid'] = intval($_POST['pid']);
    			$saveData['title'] = $_POST['title'];
    			$saveData['role_id'] = implode($_POST['role_id'], ',');
    			$saveData['module'] = $_POST['module'];
    			$saveData['status'] = intval($_POST['status']);
    			$status = $nodeModel->where('id='.intval($_POST['id']))->save($saveData);
    		}
    		 
    		if($status)
    		{
    			$this->success('修改节点成功');
    		}
    		else
    		{
    			$this->error('修改节点失败');
    		}
    		 
    		die();
    	}
    	
    	$roleList = M('Role')->select();
    	$nodeInfo = M('Node')->where(array('id'=>intval($_GET['id'])))->find();
    	$topNodeList = M('Node')->field('id,pid,title')->where('status=1 AND pid=0')->select();
    	
    	$this->assign('roleList', $roleList);
    	$this->assign('nodeInfo', $nodeInfo);
    	$this->assign('topNodeList', $topNodeList);
    	$this->display();
    }
    
    public function del_node()
    {
        isset($_GET) ? $deleteId = implode(',', $_GET) : 0;
    	$userInfo = unserialize(cookie('WYmanage_Alogin')['userInfo']);

    	if($userInfo['role_id'] != 1)
    	{
    		$this->error('非法操作！只允许超级管理员操作！');
    	}
    	 
    	$deleteId = $this->zaddslashes($deleteId);
    	$status = M('Node')->delete($deleteId);
    	if($status)
    	{
    		$this->success('删除节点成功');
    	}
    	else
    	{
    		$this->error('删除节点失败');
    	}
    }
    
    public function role()
    {
    	$result = M('Role')->order('id ASC')->select();
    	$this->assign('result', $result);
    	$this->display();
    }
    
    public function add_role()
    {
    	if(IS_POST)
    	{
    		$_POST = zaddslashes($_POST);
    		 
    		$status = M('Role')->add(array('name'=>trim($_POST['name'])));
    		 
    		if($status)
    		{
    			$this->success('添加角色成功');
    		}
    		else
    		{
    			$this->error('添加角色失败');
    		}
    		 
    		die();
    	}
    	$this->display();
    }
    
    public function edit_role()
    {
    	if(IS_POST)
    	{
    		$_POST = zaddslashes($_POST);
    		 
    		$status = M('Role')->where('id='.intval($_POST['id']))->save(array('name'=>trim($_POST['name'])));
    		 
    		if($status)
    		{
    			$this->success('修改角色成功');
    		}
    		else
    		{
    			$this->error('修改角色失败');
    		}
    		 
    		die();
    	}
		$roleInfo = M('Role')->where('id='.intval($_GET['id']))->find();
		$this->assign('roleInfo', $roleInfo);
		$this->display();
    }
}