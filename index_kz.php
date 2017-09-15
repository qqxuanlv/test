
<?php
header("content-type:text/html; charset=utf-8");

	if(!empty($_POST['name']))
	{
		$con=mysqli_connect("localhost","root","","lish2");
		$request=mysqli_query($con,"select * from index1 where id = 1");
		$row=mysqli_fetch_array($request);
		//print_r($row[1]);
		echo $row[1];
		mysqli_close($con);
	}
	
	if(!empty($_GET['src']))
	{
		$es=@"Qmgback/".$_GET['src'];
		$con=mysqli_connect("localhost","root","","lish2");
		$request=mysqli_query($con,"update index1 set src='".$es."' where id = 1");
		if($request)
		{
			echo "<script>alert('修改成功');</script>";
			echo "<script>location.href='tieba.php';</script>";
		
		}
		mysqli_close($con);
	}
	

	




$src1;
if(!empty($_FILES['filed']))
{		
	if($_FILES['filed']['error']==0)
	{
		$_FILES['filed']['name']=iconv("UTF-8","gb2312", $_FILES['filed']['name']);
		move_uploaded_file($_FILES['filed']['tmp_name'],'img/'.$_FILES['filed']['name']);
		$_FILES['filed']['name']=iconv("gb2312","UTF-8", $_FILES['filed']['name']);
		$src1=$_FILES['filed']['name'];
		
		echo "<script>alert('成功')</script>";
		echo "<script> location.href='tieba.php'</script>";
	}
	else{
		
		
		echo "error";
}



}
	
	
	if(!empty($_POST['sub'])){
		$con=mysqli_connect("localhost","root","","lish2");
	
		$title=$_POST['title'];
		 $con1=$_POST['con'];
		mysqli_query($con,"SET NAMES utf8");
		$result = mysqli_query($con,"INSERT INTO `tieb`(`id`, `title1`, `time1`, `text1`, `src1`) VALUES(null,'".$title."',now(),'".$con1."','".$src1."')");
		
	if (!$result) {
    die('Invalid query: ' . mysql_error());

	}
	}
	


	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

?>
