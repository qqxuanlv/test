<?php 
    require_once 'AdminService.class.php';

    //�����û�������
    $id=$_POST['id'];             //�����û�id
    $password=$_POST['password'];    //��������
    
   
   //ʵ����һ��adminService����
   $adminService=new AdminService();
   $name=$adminService->checkAdmin($id, $password);
   if ($name!=""){
       
       //�Ϸ�
       header("Location:empManage.php?name=$name");
       exit();
   }else {
       
       //�Ƿ�
       header("Location:login.php?errno=1");
       exit();
   }
  
?>