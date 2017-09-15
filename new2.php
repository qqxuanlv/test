<?php

$s=scandir("C:/Users/Administrator/Desktop/SQLyog_Enterprise+8.14");
$array1 = array();
foreach($s as $s1)
{
	if($s1!="."&&$s1!="..")
	{
		array_push($array1,$s1);
	}
	
}
$sqlStr ="update  ecs_goods set is_on_sale=0 where  goods_sn in ('.implode(',',$array1).');"
function cl($sqlStr){
	$con=mysqli_connect("localhost","","","");
	$request=mysqli_query($con,$sqlStr);
	mysqli_close($con);
	
}







?>