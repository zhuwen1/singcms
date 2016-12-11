<?php 
namespace Common\Model;
use Think\Model;

class AdminModel extends Model{
	private $_db = '';
	public function __construct(){
		$this->_db = M("admin");
		// echo $this->_db;
	}
	//根据用户名查找信息
	public function getInfomationByUsername($username){
		// $ret = $this->_db->where("1")->find();
		// print($ret);
		$ret = $this->_db->where('username="'.$username.'"')->find();
		// var_dump($ret);
		return $ret;
	}

}
?>
