<html>
<head>
<meta http-equiv="content-type" content="text/html";charset=utf-8>
</head>
<h1>����Ա��¼</h1>
<form action="loginProcess.php" method="post">
    <table>
        <tr>
            <td>�û�id��</td>
            <td><input type="text" name="id"/></td>
        </tr>
        <tr>
            <td>��&nbsp;�룺</td>
            <td><input type="password" name="password"/></td>
        </tr>
        <tr>
            <td><input type="submit" value="�û���¼"/></td>
            <td><input type="reset" value="������д"></td>
        </tr>                     
    </table>
<?php 
   //���ܴ�����Ϣ
   if(!empty($_GET['errno'])){
       $error=$_GET['errno'];
       if($errno==1){
           echo "<br/><font color='red' size='3'>����û��������������</font>";
       }
   }
?>
</form>
</html>