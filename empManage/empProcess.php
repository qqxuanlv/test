<?php 

    require_once 'EmpService.class.php';    

    //接受用户要删除的id
    //创建EmpService对象实例
    $empService=new EmpService();
    
    //先看看用户是要分业还是删除雇员
    if (!empty($_GET['flag'])){
        //这时即要删除用户
        $id=$_GET['id'];
        if( $empService->delEmpById($id)==1 ){
            //删除成功  跳转到
            header("Location:ok.php");
            exit;
        }else {
            //删除失败
            header("Location:error.php");
            exit;
        }
    }

?>