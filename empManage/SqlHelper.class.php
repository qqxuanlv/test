<?php 
    //这是一个工具类  作用是完成对数据库的操作
  class SqlHelper{
      
      public $conn;
      public $dbname="test";
      public $username="root";
      public $password="root";
      public $host="localhost";
      
      public function __construct(){
          
          $this->conn=mysql_connect($this->host,$this->username,$this->password);
          if (!$this->conn){
              die("数据库连接失败！".mysql_error());
          }
          mysql_select_db($this->dbname,$this->conn);
      }
      
      //执行dql语句的
      public function execute_dql($sql){
          $res=mysql_query($sql,$this->conn) or die(mysql_error());
          return $res;
      }
      
      //执行dql语句 但是返回的是一个数组
      public function execute_dql2($sql){
          
          $arr=array();
          $res=mysql_query($sql,$this->conn) or die(mysql_error());
          $i=0;
          
          //把$res中的东西弄到$arr数组里面
          while ($row=mysql_fetch_assoc($res)){
              $arr[$i++]=$row;
          }
          mysql_free_result($res);   
          return $arr;
          
      }
             //考虑分页情况的查询  这是一个通用的分页方法，充分体现了oop编程思想
             //sql1的形式类似于“select * from 表名 limit 0,3”
             //sql2的形式类似于“select count（id） from 表名”
      public function execute_dql_fenye($sql1,$sql2,&$fenyePage){
          
          $res=mysql_query($sql1,$this->conn) or die(mysql_error());           //查询要分页显示的数据 并赋给结果集$res
          $arr=array();
          while ($row=mysql_fetch_assoc($res)){
              $arr[]=$row;                                        //通过while循环将结果集赋给数组$arr
          }
          mysql_free_result($res);                          //结果集用完立即释放
          
          $res2=mysql_query($sql2,$this->conn) or die(mysql_error());
          if($row=mysql_fetch_row($res2)){
              $fenyePage->rowCount=$row[0];
              $fenyePage->pageCount=ceil($row[0]/$fenyePage->pageSize);
          }
          mysql_free_result($res2);
          
          //把导航信息封装到fenyePage里面
          //上一页
          $navigate="";
          if ($fenyePage->pageNow>=1){
              $prePage=$fenyePage->pageNow-1;
              $navigate="<a href='empList.php?pageNow=$prePage'>上一页</a>&nbsp;";
          }
          
            //实现整体翻页
            $page_whole=10;   //整体翻页的页数
            $start=floor(($pageNow-1)/$page_whole)*$page_whole+1;
            $index=$start;
            
            $navigate.="<a href='empList.php?pageNow=".($start-1)."'><<&nbsp;</a>";  //整体向前翻10页
            $nu=0;
            for (;$start<$index+$page_whole;$start++){
                $nu++;
                $navigate.="<a href='empList.php?pageNow=$start'>[$nu]</a>&nbsp;"; 
                }
            
            $navigate.="<a href='empList.php?pageNow=$start'>>>&nbsp;</a>";     //整体向后翻10页
  
          //下一页
          if ($fenyePage->pageNow < $fenyePage->pageCount){
              $nextPage=$fenyePage->pageNow+1;
              $navigate.="<a href='empList.php?pageNow=$nextPage'>下一页</a>&nbsp;";
          }
          
          $navigate.="当前页{$fenyePage->pageNow}/共{$fenyePage->pageCount}页";
          $navigate.='<br/><br/>';
    
          $fenyePage->res_array=$arr;                      //把$arr赋给$fenyePage对象
          $fenyePage->navigate=$navigate;
      }
   
      //执行dml语句的
      public function execute_dml($sql){
          
          $b=mysql_query($sql,$this->conn) or die(mysql_error());
          if (!$b){
              return 0;
          }else {
              if (mysql_affected_rows($this->conn)>0){
                  return 1; //表示执行成功
              }else {
                  return 2;  //表示没有行数收到影响
              }
          }
      }
      
      //关闭连接的方法
      public function close_connect(){
          if (!empty($this->conn)){
                mysql_close($this->conn);    
          }    
      }
  }  
?>