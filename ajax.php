<?php

$name1=$_POST["name"];
$name2=intval($name1); 
$con=mysqli_connect("localhost","root","");
if(!$con)
{
	die("error:".mysql_error());
	
}
else
{
	mysqli_select_db($con,"first");
	$sqlStr="SELECT * FROM tb WHERE id='".$name2."'";
	$result=mysqli_query($con,$sqlStr);
	$text=mysqli_fetch_array($result);
	echo $text;
}

?>