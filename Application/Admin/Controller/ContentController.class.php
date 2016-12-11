<?php 
/**
 *文章管理 
 */
namespace Admin\Controller;
use Think\Controller;
use Think\Exception;

class ContentController extends CommonController{
	public function index(){
		$conds = array();
		$title = $_GET['title'];
		if($title){
			$conds['title'] = $title;
		}
		if($_GET['catid']){
			$conds['catid'] = $_GET['catid'];
		}

		$page 	         = $_REQUEST['p']?$_REQUEST['p']:1;
		$pageSize        = 2;
		$conds['status'] = array('neq',-1);
		$news            = D('News')->getNews($conds,$page,$pageSize);
		// print_r($news);exit;
		$count           = D('News')->getNewsCount($conds);
		//推荐位id获取
		$positions       = D('Position')->getNormalPositions();
		$res             = new \Think\Page($conut,$pageSize);
		$pageRes		 = $res->show();
		$this->assign('pageres',$pageRes);
		$this->assign('news',$news);
		$this->assign('webSiteMenu',D('Menu')->getBarMenus());
		// echo $positions;exit;
		$this->assign('position',$positions);
		$this->display();
	}
	public function add(){
		if($_POST){
			if(!isset($_POST['title']) || !$_POST['title']){
				return show(0,"标题不存在");
			}
			if(!isset($_POST['small_title']) || !$_POST['small_title']){
				return show(0,"标题不存在");
			}
			if(!isset($_POST['catid']) || !$_POST['catid']){
				return show(0,"文章栏目不存在");
			}
			if(!isset($_POST['content']) || !$_POST['content']){
				return show(0,"content不存在");
			}
			if($_POST['news_id']){
				return $this->save($_POST);
			}
			// var_dump(D('News'));
			$newId = D('News')->insert($_POST);
			// echo $newId;exit;
			if($newId){
				$newsContentData['content'] = $_POST['content'];
				$newsContentData['news_id'] = $newId;
				$cId  						= D('NewsContent')->insert($newsContentData);
				// echo $cId;exit;
				if($cId){
					return show(1,"新增成功");
				}else{
					return show(1,"主表插入成功,副表插入失败");
				}
			}else{
				return show(0,"插入失败");
			}
		}else{
			$websiteMenu     =  D('Menu')->getBarMenus();
			$titleFontColor  =  C('TITLE_FONT_COLOR');
			$copyFrom        =  C('COPY_FROM');
			$this->assign('websiteMenu',$websiteMenu);
			$this->assign('titleFontColor',$titleFontColor);
			$this->assign('copyFrom',$copyFrom);
			$this->display();
		}
	}
	public function edit(){
		$newId = $_GET['id'];
		if(!$newId){
			header('Location:admin.php?c=content');
		}
		$news = D('News')->find($newId);
		if(!$news){
			header('Location:admin.php?c=content');
		}
		$NewsContent = D('NewsContent')->find($newId);
		if($NewsContent){
			$news['content']=$NewsContent['content'];
		}
		$websiteMenu = D('Menu')->getBarMenus();
		$this->assign('websiteMenu',$websiteMenu);
		$this->assign('titleFontColor',C('TITLE_FONT_COLOR'));
		$this->assign('copyFrom',C('COPY_FROM'));
		$this->assign('news',$news);
		$this->display();
	}
	public function save($data=array()){
		$news_id = $data['news_id'];
		unset($data['news_id']);
		try{
			$id = D('News')->updateById($news_id,$data);
			// echo $id;exit;
			$newsContentData['content'] = $data['content'];
			$condId = D('NewsContent')->updateNewsById($news_id,$newsContentData);
			if($id === false || $condId === false){
				return show(0,"update fail");
			}
			return show(1,"update,success");
		}catch(Exception $e){
			return show(0,$e->getMessage());
		}
	}
	public function setStatus(){
		try{
			if($_POST){
			$id = $_POST['id'];
			$status = $_POST['status'];
			if(!$id){
				return show(0,"could not find id");
			}

			$res = D('News')->updateStatusById($id,$status);
			if($res){
				return show(1,"操作成功");
			}else{
				return show(0,"操作失败");
			}
		}
		return show(0,"没有提交内容");
	}catch(Exception $e){
		return show(0,$e->getMessage());
	}
	}
	public function listorder(){
		// print_r($_POST);
		$listorder = $_POST['listorder'];
		// var_dump($listorder);
		$jump_url  = $_SERVER['HTTP_REFERER'];
		$errors    = array();
		try{
		if($listorder){
			foreach ($listorder as $newsId => $value) {
					# code...
					$id  = D('News')->updateNewsListorderById($newsId,$value);
					if($id === false){
						$errors[] = $newsId;
					}
				}	
				if($erros){
					return show(0,"排序失败-".implode(',', $errors),array('jump_url'=>$jump_url));
					// return show(0,"排序失败-".implode(',',$errors),array('jump_url'=>$jump_url));
				}
				return show(1,"排序成功",array('jump_url'=>$jump_url));
		}
		}catch(Exception $e){
		return show(0,$e->getMessage());
		}
		return show(0,"排序数据失败",array('jump_url'=>$jump_url));
	}
	public function push(){
		$jump_url   = $_SERVER['HTTP_REFERER'];
		$positionId = intval($_POST['position_id']);
		$newsId      = $_POST['push'];

		if(!$newsId || !is_array($newsId)){
			return show(0,"选择推荐文章id进行推荐");
		}
		if(!$positionId){
			return show(0,"没有选择推荐位");
		} 
		try{
			$news = D('News')->getNewsByNewsIn($newsId);
			if(!$news){
				return show(0,"没有相关内容");
			}
			foreach ($news as $new ) {
				# code...
				$data  =array(
					'position_id'=>$positionId,
					'title'      =>$new['title'],
					'thumb'      =>$new['thumb'],
					'news_id'    =>$new['news_id'],
					'status'     =>1,
					'create_time'=>$new['create_time'],
					);
				// var_dump(D('PositionContent'));exit;
				$position = D('PositionContent')->insert($data);
			}
	}catch(Exception $e){
		return show(0,$e->getMessage());
	}
	return show(1,"推荐成功",array('jump_url'=>$jump_url));
}
}

?>