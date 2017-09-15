
<html>
<head>
<meta charset="UTF-8">
	<style type="text/css">
		div{width:300px;height:400px; border:1px  black solid;}
		hr{width:80%;}
		#file1{width:200px;}
	</style>
</head>
<body>

<div>
<center>
<br/>
<form method="POST" action="index_kz.php" enctype="multipart/form-data">
标题：<input type="text" name="title"><br/>
	<hr/>
	上传图片：<br/>
	<input type="file" id="file1" name="filed"/><br/>
	<br/>
	<textarea name="con" cols="28" rows="10"></textarea>
	<br/><hr/>
	<br/><br/>
	<input type="submit"  name="sub" value="提交"/>
	</form>
	<form method="GET" action="main.php?flage=1" >
	<input type="submit" name="sub1" value="刷新"/>
	</form>
	<form action="index_kz.php" method="GET" >
	<input type="text" name="src"/>
	<input type="submit" value='修改'/>
	</form>
	</center>
</div>


</body>
</html>