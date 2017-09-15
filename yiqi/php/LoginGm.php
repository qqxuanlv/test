<?php
if(!empty($_POST['username1']))
{
	$username=$_POST['username1'];
	$userpass=$_POST['userpass1'];
	echo "<script>alert('111')</script>";
	select($username,$userpass);
}
function select($username,$userpass){
	$con=mysqli_connect("localhost","root","","yqsj");
	$request=mysqli_query($con,"select * from yqsj where username = '".$username."' and password = '".$passoword."';");
	$row=mysqli_fetch_array($request);
	echo "<script>alert(".$row[4].")</script>";
	mysqli_close($con);
	
}










?>