<?php
$n;
$ss;
if(!empty($_GET['txt']))
{
	$ss=$_GET['txt'];
	$ss= "title1 like '%".$ss."%'";
}
else
{
	$ss=1;
}

if(!empty($_GET['name']))
{

	$n= intval($_GET['name'], 10);
	$n=$n*10;
}
else
{
	$n=10;
}
$con = mysqli_connect("localhost","root","","lish2") or die("连接失败".mysqli_error());
$sqlStr = "select * from tieb where ".$ss." order by id desc limit ".($n-10).",".$n.";";
mysqli_query($con,"set names utf8");
$req = mysqli_query($con,$sqlStr);



$sqlStr = "select count(*) from tieb ";

$request= mysqli_query($con,$sqlStr);
$count1=mysqli_fetch_array($request);
$count=$count1[0];


?>