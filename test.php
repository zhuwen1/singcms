<?php 
	echo $pwd = md5('hellocms_');
	$sql = "insert into cms_admin(username,password) value('zhuwen',$pwd) ";
	echo "<br/>".$sql; exit;
	$sql = "use imooc_singcms";
	var_dump(mysql_connect("localhost","root","12345678"));
exit;
	mysql_query($sql);
	$sql = "insert into cms_admin(username,password) value('zhuwen',$pwd)";	
	mysql_query($sql);
?>