<?php
	if(!empty($_POST['pass'])){
		$pass=$_POST['pass'];
	$con = mysqli_connect('localhost','root','','n');
	$request=mysqli_query($con,"select count(*) from p where pass='".$pass."'    ");
	
	$count1=mysqli_fetch_array($request);
	$count=$count1[0];
	if($count>=1)
	{
		echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
				echo "<script type='text/javascript'>alert('key=123');location.href='success.html';</script>";
	}else
		{
			echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
				echo "<script type='text/javascript'>alert('密码不对');location.href='index.html';</script>";
		}
	
	
	}
	
	
	?>