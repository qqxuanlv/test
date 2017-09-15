<?php
	

	$text=$_POST["title"];	
	$con=mysqli_connect("localhost","root","","hj");
	$str_sql = "insert into `jh` (`title`) values ('".$text."');";
	mysqli_query($con,"SET NAMES utf8");
	$result =mysqli_query($con, $str_sql);
	if($result)
	{
				echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
				echo "<script type='text/javascript'>alert('添加成功');location.href='index.php';</script>";
	}
	else
	{
				echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
				echo "<script type='text/javascript'>alert('添加失败');location.href='index.php';</script>";
	}
		
	
?>