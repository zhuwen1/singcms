<?php 
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller{
	public function index(){
		if(!session("adminUser")){
			header("Location:admin.php?c=login");
		}
		$this->display();
	}
	public function main(){
		$this->display();
	}
	
}

?>