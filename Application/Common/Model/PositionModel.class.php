<?php 
	namespace Common\Model;
	use Think\Model;

	class PositionModel extends Model{
		public function __construct(){
			$this->_db = M('position');
		}
		public function getNormalPositions(){
			$conditions  = array('status'=>1);
			return $list = $this->_db->where($conditions)->order('id')->select();
		}

	}
?>