<?php 

    require_once 'EmpService.class.php';    

    //�����û�Ҫɾ����id
    //����EmpService����ʵ��
    $empService=new EmpService();
    
    //�ȿ����û���Ҫ��ҵ����ɾ����Ա
    if (!empty($_GET['flag'])){
        //��ʱ��Ҫɾ���û�
        $id=$_GET['id'];
        if( $empService->delEmpById($id)==1 ){
            //ɾ���ɹ�  ��ת��
            header("Location:ok.php");
            exit;
        }else {
            //ɾ��ʧ��
            header("Location:error.php");
            exit;
        }
    }

?>