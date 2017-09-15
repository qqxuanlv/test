<?php
	
	if(!empty($_POST['name']))
	{
		$sum=0;
		$con=mysqli_connect('localhost','root','','jyxt') or die ("´íÎó".mysqli_error());
		$request=mysqli_query($con,"select count(*) from user where username='".$_POST['name']."' and password='".$_POST['pass']."'");
		$count1=mysqli_fetch_array($request);
		$sum=$count1[0];
		$request=mysqli_query($con,"select * from user where username='".$_POST['name']."' and password='".$_POST['pass']."'");
		$count1=mysqli_fetch_array($request);
	
		
		if($sum==1)
		{
			echo "<script>alert(".$count1[2].")</script>";
			echo "<script>location.href='login.html'</script>";
		}
		else
		{
			echo "<script>alert(".$sum.")</script>";
			echo "<script>location.href='login.html'</script>";
		}
	}
?>