<?php 
namespace Admin\Controller;
use Think\Controller;
use Think\Upload;

class ImageController extends Controller{
	private $_uploadObj;
	public function __construct(){

	}
	public function ajaxuploadimage(){
		// echo "aa";exit;
		$upload = D('UploadImage');
		// echo "aa";exit;
		$res    = $upload->imageUpload();
		// echo $res."is ";
		// var_dump($res);	
		if($res == false){
			return show(0,"upload fail");
		}else{
			return show(1,"upload success",$res);
		}
	}
	public function kindupload(){
		// echo "hello.test";
		$upload = D('UploadImage');
		$res    = $upload->upload();
		if($res === false){
			return showKind(1,"上传失败");
		}
		return showKind(0,$res);
	}
}
?>