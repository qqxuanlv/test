<?php
	$con;
	$user;
	$pass;
	//关闭错误
	error_reporting(E_ERROR); 
	ini_set("display_errors","Off");
	
	//接收
	if(!empty($_POST['txt']))
	{
		$user=$_POST['txt'];
		$pass=$_POST['pass'];
		$con=mysqli_connect("localhost","root1","","jyxt") or die("数据库连接失败".mysqli_error());
		$request=mysqli_query($con,"select * from user where username='".$user."' and password='".$pass."' ");
		$row=mysqli_fetch_array($request);
		if(!empty($row))
		{
			echo "<script>alert('".$row[2]."');</script>";
		}
		else
		{
			echo "<script>alert('账号或密码错误'); location.href='login.html'</script>";
			
		}
		mysqli_close($con);
	}
	
	
	//sql
	
	
	
	
	
	
	
	
	
	
	
	







?>