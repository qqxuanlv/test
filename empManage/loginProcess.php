<?php 
    require_once 'AdminService.class.php';

    //接受用户的数据
    $id=$_POST['id'];             //接受用户id
    $password=$_POST['password'];    //接受密码
    
   
   //实例化一个adminService方法
   $adminService=new AdminService();
   $name=$adminService->checkAdmin($id, $password);
   if ($name!=""){
       
       //合法
       header("Location:empManage.php?name=$name");
       exit();
   }else {
       
       //非法
       header("Location:login.php?errno=1");
       exit();
   }
  
?>