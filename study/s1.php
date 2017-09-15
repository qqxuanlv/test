
<html>

<form action="" method="GET">

	<input type="text" name="txt" ><br/>
	<input type="pass" name ="pass"><br/>
	<input type="submit" value="发表" name="btn" />



</html>
<?php
	/*function end1(){
	
	echo '<script>location.href="s2.php";</script>';
	
}*/
 if(!empty($_GET['btn']))
 {
	 echo "en:".en($_GET['txt'])."<br/>";
	 echo "en2:".en($_GET['pass'])."<br/>";
	
 }
 else
 {
	 echo "<script>alert('没有提交过');</script>";
	 
 }

 function en($data){
	 $data=trim($data);
	 $data=htmlspecialchars(stripslashes($data));
	 return $data;
	 
	 
	 
	 
	 
	
	 
	 
	 
 }
?>