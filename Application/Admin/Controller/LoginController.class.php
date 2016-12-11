<?php 
namespace Admin\Controller;
use Think\Controller;

class LoginController extends Controller{
	public function index(){
		if(session("adminUser")){
        // $this->redirect("/singcms/admin.php?c=index");
			header("Location:admin.php");
    	}
    // echo session('adminUser');exit;
	return $this->display();
	}
	public function check(){
		$username = $_POST['username'];
		$password = $_POST['password'];
		if(!trim($username)){
			echo $username;
			return show(0,'username could not null');
		}
		if(!trim($password)){
			return show(0,'password could not null');
		}
		$ret = D("Admin")->getInfomationByUsername($username);		
		// print_r($ret);
		if(!$ret){
			return show(0,"could find username");
		}
		if($ret['password'] != getMd5Password($password)){
			// echo $ret['password'];
			return show(0,"password invalid");
			// rerun show(0,'invlid password');
		}
		session('adminUser',$ret);
		return show(1,'login success');
	}
	public function loginout(){
		// echo "hello,test";exit;
		session('adminUser',null);
		header("Location:admin.php?c=login");
        // $this->redirect("admin.php?c=login");
	}
}