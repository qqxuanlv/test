<html>
<head>
<meta http-equiv="content-type" content="text/html";charset=utf-8>
</head>
<h1>管理员登录</h1>
<form action="loginProcess.php" method="post">
    <table>
        <tr>
            <td>用户id：</td>
            <td><input type="text" name="id"/></td>
        </tr>
        <tr>
            <td>密&nbsp;码：</td>
            <td><input type="password" name="password"/></td>
        </tr>
        <tr>
            <td><input type="submit" value="用户登录"/></td>
            <td><input type="reset" value="重新填写"></td>
        </tr>                     
    </table>
<?php 
   //接受错误信息
   if(!empty($_GET['errno'])){
       $error=$_GET['errno'];
       if($errno==1){
           echo "<br/><font color='red' size='3'>你的用户名或者密码错误！</font>";
       }
   }
?>
</form>
</html>