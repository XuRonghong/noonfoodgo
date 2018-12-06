<?php
/*<!--************************************************************-->
<!--*******Start Bootstrap Free Bootstrap Themes & Templates******-->
<!--********參考程式至http://startbootstrap.com/******************-->
<!--************./template-overviews/blog-post/*****************-->
<!--*****************2015/7/17******************************-->
<!--**********************************************************-->*/



require("models/dbModel.php");
	
	if(isset($_POST['comment'])&&isset($_POST['aid'])&&isset($_POST['mid'])){
		$comment=$_POST['comment'];
		$comment=strip_tags($comment);
		$comment=trim($comment);
		
		$aid=$_POST['aid'];
		$aid=strip_tags($aid);
		$aid=trim($aid);
		
		$mid=$_POST['mid'];
		$mid=strip_tags($mid);
		$mid=trim($mid);
		
		$db=new DB();
		$result=$db->query("INSERT INTO comment(cContent,carticleId,cmemberId) VALUES('".$comment."','".$aid."','".$mid."')");
	}
?>