<?php
	$con;
	$user;
	$pass;
	//�رմ���
	error_reporting(E_ERROR); 
	ini_set("display_errors","Off");
	
	//����
	if(!empty($_POST['txt']))
	{
		$user=$_POST['txt'];
		$pass=$_POST['pass'];
		$con=mysqli_connect("localhost","root1","","jyxt") or die("���ݿ�����ʧ��".mysqli_error());
		$request=mysqli_query($con,"select * from user where username='".$user."' and password='".$pass."' ");
		$row=mysqli_fetch_array($request);
		if(!empty($row))
		{
			echo "<script>alert('".$row[2]."');</script>";
		}
		else
		{
			echo "<script>alert('�˺Ż��������'); location.href='login.html'</script>";
			
		}
		mysqli_close($con);
	}
	
	
	//sql
	
	
	
	
	
	
	
	
	
	
	
	







?>