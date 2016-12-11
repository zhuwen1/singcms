<?php 
/**
 * 图片上传类
 */
namespace Common\Model;
use Think\Model;
class UploadImageModel extends Model{
	private $_uploadObj       = '';
	private $_uploadImageData = '';
	const   UPLOAD  		  = 'upload';

	public function __construct(){
		// echo "exit";exit;
		$this->_uploadObj = new \Think\Upload();

		$this->_uploadObj->rootPath = './'.self::UPLOAD.'/';
		$this->_uoloadObj->subName  = date(Y).'/'.date(m).'/.'.date(d);
	}
	public function upload(){
		$res = $this->_uploadObj->upload();
		// print_r($res);exit;
		if($res){
			return self::UPLOAD.'/'.$res['imgFile']['savepath'].$res['imgFile']['savename'];
		}else{
			return false;
		}

	
	}
		public function imageUpload(){
		// echo "test";
		$res = $this->_uploadObj->upload();
		// echo "test";exit;
		// var_dump($this->_uploadObj->getError());
		// print_r($res);
		// print_r($res);
		if($res){
			// var_dump($res['imgFile']);
			return self::UPLOAD.'/'.$res['file']['savepath'].$res['file']['savename'];
		}else{
			return false;
		}
	}
}  
?>