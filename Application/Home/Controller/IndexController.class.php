<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller
{
    public function index()
    {
    	$this->display();
    }
    
    public function verify()
    {
    	$Verify = new \Think\Verify();
    	$Verify->fontSize = 30;
    	$Verify->length = 4;
    	$Verify->useNoise = false;
    	$Verify->entry();
    }
}