<?php 

    require_once 'SqlHelper.class.php';
    //������һ��ҵ���߼������࣬����Ҫ��ɶ�admin��Ĳ���
    
    class AdminService{
        
        //�ṩһ����֤�û��Ƿ�Ϸ��ķ���
        public function checkAdmin($id,$password){
           
            $sql="select password,name from admin where id=$id";
            //����һ��SqlHelper����
            $sqlHelper=new SqlHelper();
            $res=$sqlHelper->execute_dql($sql);
            if ($row=mysql_fetch_assoc($res)){
               //�ȶ�����
                if (md5($password)==$row['password']){
                    return $row['name'];
                }
            }
            //�ͷ���Դ
            mysql_free_result($res);
            //�ر�����
            $sqlHelper->close_connect();
            return false;
        }
    }

?>