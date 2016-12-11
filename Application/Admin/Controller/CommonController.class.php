<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller{
    public function __construct(){
        parent::__construct();
        $this->init();
    }
    /**
     * init
     * @return 
     */
     public function init(){
		$isLogin = $this->isLogin();
		if(!$isLogin){
			//
			$this->redirect('admin.php?c=login');
		}
	}
	public function isLogin(){
		$user    = $this->getLoginUser();
		if($user && is_array($user) ){
			return true;
		}
		return false;
	}
	public function getLoginUser(){
		return session('adminUser');
	}
	
	// public function error($message){
	// 	$message = $message ? $message:'系统发生错误';
	// 	echo $message;exit;
	// 	// $this->assign('message',$message);
	// 	// $this->display("Index/error");
	// }       
}

?>