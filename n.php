<?php

if(!empty($_POST['btn']))
{
	$string ="http://". $_POST['txt'];

$s =file_get_contents("$string");
$file=fopen("C:/Users/Administrator/Desktop/i.txt","w");
fwrite($file,$s);

fclose($file);
echo "<script>alert('爬取成功');</script>"; 

}
else
{
	echo "<script> alert('当前未提交');</script>";

}



?>