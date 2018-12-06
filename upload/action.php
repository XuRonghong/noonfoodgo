<?php
session_start();
require_once("../models/dbModel.php");


$action = $_GET['act'];
$iarticleId=$_GET['aid'];

if($action=='delimg'){
	$filename = $_POST['imagename'];
	if(!empty($filename)){
		unlink('../img/'.$filename);
		echo '1';
				
		$db=new DB();
		$result=$db->query("DELETE FROM image WHERE iName LIKE '".$filename."'");
	}else{
		echo '删除失败.';
	}
}else{
	$picname = $_FILES['mypic']['name'];
	$picsize = $_FILES['mypic']['size'];
	if ($picname != "") {
		if ($picsize > 1024000) {
			echo '图片大小不能超过1M';
			exit;
		}
		$type = strstr($picname, '.');
		if ($type != ".gif" && $type != ".jpg" && $type != ".png") {
			echo '图片格式不对！';
			exit;
		}
		$rand = rand(100, 999);
		$pics = date("YmdHis") . $rand . $type;
		//上传路径
		$pic_path = "../img/". $pics;
		move_uploaded_file($_FILES['mypic']['tmp_name'], $pic_path);
		
		
		$db=new DB();
		$result=$db->query("INSERT INTO image(iName,iType,iSize,iarticleId,imemberId) 
						VALUES('".$pics."','".$type."','".$size."','".$iarticleId."','".$_SESSION['member']['mid']."')");
	
		$size = round($picsize/1024,2);
		$arr = array(
			'name'=>$picname,
			'pic'=>$pics,
			'size'=>$size
		);
		
		
		echo json_encode($arr);
	}
	
}
?>