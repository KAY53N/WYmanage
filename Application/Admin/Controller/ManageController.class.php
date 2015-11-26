<?php
namespace Admin\Controller;
use Think\Controller;
class ManageController extends Controller
{
    public function index()
    {
    	//Cookie::set('referer', 'Manage'.date('DFt', time()), 60*3);
    	cookie('referer', 'Manage'.date('DFt', time()), 'expire=150&prefix=');
		$this->redirect('Admin/Login');
    }
}