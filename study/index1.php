  <link rel="stylesheet" href="css.css" type="text/css" >
<form action="" method="get">
<input type="text" name='txt' /><input type="submit" value="搜索" name='sub'/> 
<?php
header("Content-type:text/html;charset=utf-8");

include("n1.php");

if(!empty($_GET['txt']))
{
	$w=" title1 like '%".$_GET['txt']."%'";
	
}
else
{
	$w=1;
}


$sql = "SELECT * FROM tb where $w ORDER  BY id DESC limit 10"; 
$query=mysql_query($sql,$con) or die('1111:'.mysql_error());

 while($rs = mysql_fetch_array($query))
 {
 ?>
 
 <html>
 
 <head>
 
	<title>222</title>

 </head>
	
	
	<h1><?php echo $rs['title']?></h1>
	<li><?php echo '日期:'.$rs['dates']?></li>
	<p><?php echo $rs['contents']?></p>
	<hr/>
	
	
</html>
	
<?php 
 }
 
?>
<a href="add.php">发表</a>
<hr/>