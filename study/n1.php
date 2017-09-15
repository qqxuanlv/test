<?php
	header("Content-Type: text/html; charset=utf-8");
	$con = @mysql_connect("localhost","root","") or die("mysqlÁ¬½ÓÊ§°Ü");

	@mysql_select_db("lish2") or die ("é”™å’¯");
	mysql_query("set names utf8;"); 
	//mysql_query("set name 'gbk'");
if(!$con)
{
	die('error'.mysql_error());
}
	mysql_select_db("lish2", $con);
	
?>