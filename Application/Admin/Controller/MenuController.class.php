<?php
namespace Admin\Controller;
use Think\Controller;

class MenuController extends Controller{
	public function add(){
		// print_r($_POST);
	    if($_POST){
			if(!isset($_POST['name']) || !$_POST['name']){
				return show(0,'the name could not null');
			}
			if(!isset($_POST['m']) || !$_POST['m']){
				return show(0,'the model could not null');
			}
			if(!isset($_POST['c']) || !$_POST['c']){
				return show(0,'the controller could not null');
			}
			if(!isset($_POST['f']) || !$_POST['f']){
				return show(0,'the function could not null');
			}
			// print_r($_POST);exit;
			if($_POST['menu_id']){
				// return show(0,'could not have saveid');
				return $this->save($_POST);
			}
			$menuId = D('Menu')->insert($_POST);
			// return $menuId;exit;
			if($menuId){
				return show(1,'add success',$menuId);
			}
			return show(0,'add error');
			// print_r($_POST);
		  }
		  else{
		  	$this->display();
			}
	}
	public function index(){
		$data       = array();
		if(isset($_REQUEST['type']) && in_array($_REQUEST['type'],array(0,1))){
			$data['type']   = intval($_REQUEST['type']);
			$this->assign('type',$data['type']);
		}else{
			$this->assign('type',-1);
		}
		/**/
		
		$page       = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
		$pageSize   = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 3;
		$menus      = D('Menu')->getMenus($data,$page,$pageSize);
		$menusCount = D('Menu')->getMenuscount($data);

		$res        = new \Think\Page($menusCount,$pageSize);
		$pageRes        = $res->show();
		$this->assign('pageRes',$pageRes);
		$this->assign('menus',$menus);
		
		$this->display();
	}
	public function edit(){
		$menuId = $_GET['id'];
		$menu   = D('Menu')->find($menuId);
		// print_r( $menu);exit;
		$this->assign('menu',$menu);
		$this->display();
	}
	public function save($data){
		$menuId = $data['menu_id'];
		unset($data['menu_id']);
		try{
			$id = D('Menu')->updateMenuById($menuId,$data);
		if($id === false){
			return show(0,"更新失败");
		}
		// return $id;exit;
		return show(1,"更新成功");
	}catch(Exception $e){
		return show(0,$e->getMessage());
	}	
}
	public function setStatus(){
		try{	
			// print_r("post")
			if($_POST){
				$id     = $_POST['id'];
				$status = $_POST['status'];
				$res = D('Menu')->updateStatusById($id,$status);
				if($res){
					return show(1,"操作成功");
				}else{
					return show(0,"操作失败");
				}
			}
		}catch(Exception $e){
				return show(0,$e->getMessage());
			}
		return show(0,"没有提交的数据");
	}
	public function listorder(){		// echo "hello,test";
		// print_r($_POST);
		$listorder = $_POST['listorder'];
		$jumpurl   = $_SERVER['HTTP_REFERER'];
		// print_r($listorder);
		if($listorder){
			foreach ($listorder as $menuId => $value) {
				# code...update
				// echo $value;
				// print_r($menu_id);exit;
				$id = D('Menu')->updateMenuListorderById($menuId,$value);
				if($id === false){
					$errors[] = $menuId;
				}
			}
		if($errors){
			return show(0,"排序失败-".implode(',',$errors),array('jump_url' =>$jumpurl));
			}
		return show(1,'排序成功',array('jump_url'=>$jumpurl));
		}
	return show(0,'排序数据失败',array('jump_url'=>$jumpurl));
	}
}

 ?>