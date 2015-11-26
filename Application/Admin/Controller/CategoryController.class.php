<?php
namespace Admin\Controller;
class CategoryController extends CommonController
{
    public function index()
    {
    	$count = M('Category')->count();
    	$page = new \Think\Page($count, 50);
    	$page->setConfig('theme', '<div class="col-xs-6"><div class="dataTables_info" id="sample-table-2_info" role="status" aria-live="polite">当前：%NOW_PAGE%/%TOTAL_PAGE%&nbsp;&nbsp;%HEADER%</div></div><div class="col-xs-6"><div class="dataTables_paginate paging_simple_numbers" id="sample-table-2_paginate"><ul class="pagination">%UP_PAGE% %LINK_PAGE% %DOWN_PAGE%</ul></div></div>');
    	$show = $page->show();
    	$result['list'] = M('Category')->field('id,name,pid,path,concat(path,"-",id) as bpath')->order('bpath')->limit($page->firstRow.','.$page->listRows)->select();
        foreach($result['list'] as $key=>$value)
    	{
    		$result['list'][$key]['count'] = count(explode('-', $value['bpath']))-2;
    	}
    	$this->assign('result', $result);
    	$this->assign('show', $show);
    	$this->display();
    }
    
    public function add_category()
    {
    	$result['list'] = M('Category')->field('id,name,pid,path,concat(path,"-",id) as bpath')->order('bpath')->select();
    	
    	foreach($result['list'] as $key=>$value)
    	{
    		$result['list'][$key]['count'] = count(explode('-', $value['bpath']))-2;
    	}
    	
    	$this->assign('data', $result);
    	$this->display();
    }

    public function edit_category()
    {
        if(IS_POST)
        {
            die();
        }
        $result['name'] = M('Category')->where('id='.intval($_GET['id']))->find();
        $result['active'] = M('Category')->where('id ='.$result['name']['pid'])->field('id,name')->find();
        $this->assign('result', $result);
        $this->display();
    }
}