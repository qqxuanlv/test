<?php 
    //����һ��������  ��������ɶ����ݿ�Ĳ���
  class SqlHelper{
      
      public $conn;
      public $dbname="test";
      public $username="root";
      public $password="root";
      public $host="localhost";
      
      public function __construct(){
          
          $this->conn=mysql_connect($this->host,$this->username,$this->password);
          if (!$this->conn){
              die("���ݿ�����ʧ�ܣ�".mysql_error());
          }
          mysql_select_db($this->dbname,$this->conn);
      }
      
      //ִ��dql����
      public function execute_dql($sql){
          $res=mysql_query($sql,$this->conn) or die(mysql_error());
          return $res;
      }
      
      //ִ��dql��� ���Ƿ��ص���һ������
      public function execute_dql2($sql){
          
          $arr=array();
          $res=mysql_query($sql,$this->conn) or die(mysql_error());
          $i=0;
          
          //��$res�еĶ���Ū��$arr��������
          while ($row=mysql_fetch_assoc($res)){
              $arr[$i++]=$row;
          }
          mysql_free_result($res);   
          return $arr;
          
      }
             //���Ƿ�ҳ����Ĳ�ѯ  ����һ��ͨ�õķ�ҳ���������������oop���˼��
             //sql1����ʽ�����ڡ�select * from ���� limit 0,3��
             //sql2����ʽ�����ڡ�select count��id�� from ������
      public function execute_dql_fenye($sql1,$sql2,&$fenyePage){
          
          $res=mysql_query($sql1,$this->conn) or die(mysql_error());           //��ѯҪ��ҳ��ʾ������ �����������$res
          $arr=array();
          while ($row=mysql_fetch_assoc($res)){
              $arr[]=$row;                                        //ͨ��whileѭ�����������������$arr
          }
          mysql_free_result($res);                          //��������������ͷ�
          
          $res2=mysql_query($sql2,$this->conn) or die(mysql_error());
          if($row=mysql_fetch_row($res2)){
              $fenyePage->rowCount=$row[0];
              $fenyePage->pageCount=ceil($row[0]/$fenyePage->pageSize);
          }
          mysql_free_result($res2);
          
          //�ѵ�����Ϣ��װ��fenyePage����
          //��һҳ
          $navigate="";
          if ($fenyePage->pageNow>=1){
              $prePage=$fenyePage->pageNow-1;
              $navigate="<a href='empList.php?pageNow=$prePage'>��һҳ</a>&nbsp;";
          }
          
            //ʵ�����巭ҳ
            $page_whole=10;   //���巭ҳ��ҳ��
            $start=floor(($pageNow-1)/$page_whole)*$page_whole+1;
            $index=$start;
            
            $navigate.="<a href='empList.php?pageNow=".($start-1)."'><<&nbsp;</a>";  //������ǰ��10ҳ
            $nu=0;
            for (;$start<$index+$page_whole;$start++){
                $nu++;
                $navigate.="<a href='empList.php?pageNow=$start'>[$nu]</a>&nbsp;"; 
                }
            
            $navigate.="<a href='empList.php?pageNow=$start'>>>&nbsp;</a>";     //�������10ҳ
  
          //��һҳ
          if ($fenyePage->pageNow < $fenyePage->pageCount){
              $nextPage=$fenyePage->pageNow+1;
              $navigate.="<a href='empList.php?pageNow=$nextPage'>��һҳ</a>&nbsp;";
          }
          
          $navigate.="��ǰҳ{$fenyePage->pageNow}/��{$fenyePage->pageCount}ҳ";
          $navigate.='<br/><br/>';
    
          $fenyePage->res_array=$arr;                      //��$arr����$fenyePage����
          $fenyePage->navigate=$navigate;
      }
   
      //ִ��dml����
      public function execute_dml($sql){
          
          $b=mysql_query($sql,$this->conn) or die(mysql_error());
          if (!$b){
              return 0;
          }else {
              if (mysql_affected_rows($this->conn)>0){
                  return 1; //��ʾִ�гɹ�
              }else {
                  return 2;  //��ʾû�������յ�Ӱ��
              }
          }
      }
      
      //�ر����ӵķ���
      public function close_connect(){
          if (!empty($this->conn)){
                mysql_close($this->conn);    
          }    
      }
  }  
?>