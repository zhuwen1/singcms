<?php 
/**common function */

function show($status,$message,$data){
	$result = array(
		'status'=>$status,
		'message'=>$message,
		'data'=>$data,		);
	exit(json_encode($result));
}
function getMd5Password($password){	
	// return $password.C('MD5_PRE');
	return md5($password.C('MD5_PRE'));
}
function getMenutype($type){
	return $type == 1 ? '后端导航' : '前端导航';
}
function status($type){
	return $type == 1 ? "正常" : ($type == 0 ? "关闭" :"删除");
}

function getAdminMenuUrl($nav){
	$url = 'admin.php?c='.$nav['c'].'&a='.$nav['a'];
	if($nav['f'] === 'index'){
		$url = 'admin.php?c='.$nav['c'];
	}
	return $url;
}

function getActive($navc){
	$c =substr(strtolower(CONTROLLER_NAME),0,1);
	// return $navc['c'].$c;
	if(strtolower($navc['c'])==$c){
		return 'class="active"';
	}
	return '';
}

function showkind($status,$data){
	header('Content-type:application/json;charset=UTF-8');
	if($status == 0){
		exit(json_encode(array('error'=>0,'url'=>$data)));
	}
	exit(json_encode(array('error'=>1,'message'=>'上传失败')));
}
function getLoginSessionUsername() {
	return $_SESSION['adminUser']['username'] ? $_SESSION['adminUser']['username']:'';
}
function  getCatName($navs,$id){
	foreach($navs as $nav){
		$navList[$nav['menu_id']] = $nav['name'];
	}
	return isset($navList[$id]) ? $navList[$id] : '';
}
function getCopyFromById($id){
	$copyFrom = C("COPY_FROM");
	return $copyFrom[$id] ? $copyFrom[$id]:"";
}
function isThumb($Thumb){
	if($Thumb){
		return '<span style="color:red">有</span>';
	}
	return "无";
}