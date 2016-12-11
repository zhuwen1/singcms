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
		public function select($data = array()) {

		$conditions = $data;
		$list = $this->_db->where($conditions)->order('id')->select();
		return $list;
	}
	/**
	 * 通过id更新的状态
	 * @param $id
	 * @param $status
	 * @return bool
	 */
	public function updateStatusById($id, $status) {
		if(!is_numeric($status)) {
			throw_exception("status不能为非数字");
		}
		if(!$id || !is_numeric($id)) {
			throw_exception("ID不合法");
		}
		$data['status'] = $status;
		return  $this->_db->where('id='.$id)->save($data); // 根据条件更新记录

	}
	   public function insert($res=array()) {
    	if(!$res || !is_array($res)) {
    		return 0;
    	}
		$res['create_time'] = time();
    	return $this->_db->add($res);
    }
	}
?>