<?php 
/**
 *推荐位内容管理 
 */
namespace Admin\Controller;
use Think\Controller;
use Think\Exception;

class PositioncontentController extends CommonController{
	public function index(){
		$position = D('Position')->getNormalPositions();
		$data['status'] = array('neq',-1);
		if($_GET['title']){
			$data['title']  = trim($_GET['title']);
			$this->assign('title',$data['title']);	
		}
		$data['position_id'] = $_GET['position_id']?intval($_GET['position_id']):$position[0]['id'];
		$content = D('PositionContent')->select($data);
		$this->assign("position",$position);
		$this->assign('content',$content);
		$this->assign('positionId',$data['position_id']);
		$this->display();
	}
	public function add(){
		$this->display();
	}
}
?>