<?php
namespace Common\Model;
use Think\Model;

class NewsContentModel extends Model{
	private $_db = '';

	public function __construct(){
		$this->_db = M('news_content');
	}
	public function insert($data=array()){
		// print_r($data);exit;
		if(!$data || !is_array($data)){
			return 0;
		}
		$data['create_time'] = time();
		if(isset($data['content']) && $data['content']){
			$data['content'] = htmlspecialchars($data['content']);
		}
		return $this->_db->add($data);
	}
	public function find($id){
		// echo $id;exit;

		return $this->_db->where('news_id='.$id)->find();
	}
	public function updateNewsById($id,$data){
	    if(!$id || !is_numeric($id)){
 	 		throw_exception("id 不合法");	
 	 	}
 	 	if(!$data ||!is_array($data)){
 	 		throw_exception('更新数据不合法');
 	 	}
		if(isset($data['content']) && $data['content']){
			$data['content'] = htmlspecialchars($data['content']);
		}
 	 	return $this->_db->where('news_id='.$id)->save($data);
	}
	public function getNewsByNewsIn($newsId){
		// if(!is_array($newsId)){
		// 	throw_exception("参数不合法");
		// }
		// $data = array(
		// 	'news_id'  = array('in',implode(',',$newsId)),
		// 	);
		// return $this->_db->where($data)->select();
	}
}
 ?>