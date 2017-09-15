<?php
header("Content-type:text/html;charset=utf-8");
	include("n1.php");
	
	if(!empty($_POST['sub'])){
		$url = "http://localhost/index1.php";  
	
		 $title=$_POST['title'];
		 $con=$_POST['con'];
		 $sql="INSERT INTO `tb`(`id`, `title`, `dates`, `contents`) VALUES (null,'$title',now(),'$con')";
		
		 $result = mysql_query($sql);
		echo "<script language='javascript'>"; 
		echo " location='http://localhost/index1.php ';"; 
		echo "</script>"; 
	if (!$result) {
    die('Invalid query: ' . mysql_error());
}
	
	}

?>
<style>
	form{margin-left:auto;margin-right:auto; width:400px;top:300px;}
</style>
<center><h1>发表</h1></center>
<form action="add.php" method="post">

内容<input type="text" name="title"/><br/>
标题<textarea rows="5" cols="50" name="con"></textarea><br/>
<input type="submit" name="sub" value="发表"/>
</form> 




