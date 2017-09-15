<?php

header ( "Content-Type: text/html; charset=utf8" );
$con=mysqli_connect("localhost","root","","hj");
$str_sql="select * from jh";
mysqli_query($con,"SET NAMES utf8");
$rs=mysqli_query($con, $str_sql);


	
	
	
	
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title></title>
		<style><!--
        	作者：834337625@qq.com
        	时间：2016-06-07
        	描述：
        -->
        
        .form-group div{
        	
        	margin-bottom: 40px;
        	
        }
        </style>
		<link rel="stylesheet" href="css/bootstrap.min.css" />
	</head>
	<body>
		<div class="container">
			<form action="cl.php" method="POST">
		<div class="form-group">
			
				<div><label>题目：</label>
				<input type="text" class="form-control" name="title"/>
				</div>
					<div>
			
				<button class="btn btn-default" type="submit">提交</button>
			</div>
		</div>	
			
			</form>
		
			<table class="table table-bordered table-striped">
				<?php 
					
					while($row = mysqli_fetch_row($rs))
					{
				?>
						<tr><td><?php  echo $row[0]?></td></tr>
				<?php
					}?>
				
			</table>
		</div>
		
	
			
		
	</body>
</html>
