<?php 
    require_once 'SqlHelper.class.php';
    class EmpService{
        //һ������  ���Ի�ȡ���ж���ҳ
        function getPageCount($pageSize){
            
            //��Ҫ��ѯ$rowCount
            $sql="select count(id) from emp";
            $sqlHelper= new SqlHelper();
            $res=$sqlHelper->execute_dql($sql);
            //�����Ϳ��Լ���$pageCount
            if ($row=mysql_fetch_row($res)){
                $pageCount=ceil($row[0]/$pageSize);
            }
            //�ͷ���Դ �ر�����
            mysql_free_result($res);
            $sqlHelper->close_connect();
            return $pageCount;
        }
        
        //һ������  ���Ի�ȡӦ����ʾ�Ĺ�Ա��Ϣ
        function getEmpListByPage($pageNow,$pageSize){
            
            $sql="select * from emp limit ".($pageNow-1)*$pageSize.",$pageSize";
            
            $sqlHelper= new SqlHelper();
            $res=$sqlHelper->execute_dql2($sql);
            
            $sqlHelper->close_connect();
            return $res;
        }
        
        
        //���ǵڶ���ʹ�÷�װ�ķ�ʽ��ɵķ�ҳ
        function getFenyaPage($fenyePage){
            
            //����һ��SqlHelpe����ʵ��
            $sqlHelper=new SqlHelper();
            $sql1="select * from emp limit 
                    ".($fenyePage->pageNow-1)*$fenyePage->pageSize.", ".$fenyePage->pageSize."";
            $sql2="select count(id) from emp";
            $sqlHelper->execute_dql_fenye($sql1, $sql2, $fenyePage);
            
            $sqlHelper->close_connect();
        }
        
        //����idɾ��ĳ���û�
        function delEmpById($id){
            
            $sql="delete from emp where id=$id";
            //����һ��SqlHelper����
            $sqlHelper=new SqlHelper();
            return $sqlHelper->execute_dml($sql);
        }
        
    }
?>