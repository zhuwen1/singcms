<?php
namespace Admin\Controller;
use Think\Controller;
class BasicController extends Controller{
	public function index(){
		$result = D('Basic')->select();
		// echo json_encode($result);exit;
		$this->assign('vo',$result);
		$this->display();
	}
	public function add(){
		if($_POST){
			if(!$_POST['title']){
				return show(0,"站点信息不能为空");
			}
			if(!$_POST['keywords']){
				return show(0,"站点关键词不能为空");
			}
			$id = D("Basic")->save($_POST);
			return show(1,"配置成功");
		}else{
			return show(0,"没有提交的数据");
		}
	}

}