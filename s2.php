<?php

 if(!empty($_GET['btn']))
 {
	 
	 echo "ID=".$_GET['txt']."<br/>";
	 echo "Password=".$_GET['pass']."";
	 
 }
 else
 {
	 echo "<script>alert('没有提交过');</script>";
	 
 }





?>