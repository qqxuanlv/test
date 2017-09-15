<html>
<head>
<meta http-equiv="content-type" content="text/html";charset=utf-8 />
<title>雇员信息列表</title>
<script type="text/javascript">
<!--
	function confirmDele(val){
		return window.confirm("是否要删除id="+val+"的用户？");
	}
//-->
</script>
</head>
<?php 

    require_once 'EmpService.class.php';
    require_once 'FenyePage.php';
    
    $empService=new EmpService();
    
    //创建一个fenyePage对象实例
    $fenyePage=new FenyePage();
    
    //给pageNow指定必须的数据
    $fenyePage->pageNow=1;
    $fenyePage->pageSize=6;
    
   
    
    //需要根据用户的点击来修改当前页的值
    if (!empty($_GET['pageNow'])){                 //如果判断pageNow的值不为空  即不是用户第一次登录的话
        $fenyePage->pageNow=$_GET['pageNow'];      //就根据用户需求进行传值  
                                                   //如果pageNow为空  即用户第一次登录  当前页默认为1
    }
    
    $empService->getFenyaPage($fenyePage);
    
    echo "<table cellspacing=0 cellpadding=5 border='1px' bordercolor='blue' width='700px'>";
    echo "<tr>
            <th>id</th>
            <th>name</th>
            <th>grade</th>
            <th>email</th>
            <th>slary</th>
            <th>删除用户</th>
            <th>修改用户</th>
        </tr>";
   
    
    //现在通过数组取
    for ($i=0;$i<count($fenyePage->res_array);$i++){
        $row=$fenyePage->res_array[$i]; 
        echo "<tr style='text-align:center'>
             <td>{$row['id']}</td>
             <td>{$row['name']}</td>
             <td>{$row['grade']}</td>
             <td>{$row['email']}</td>
             <td>{$row['salary']}</td>
             <td><a onclick='return confirmDele({$row['id']})' href='empProcess.php?flag=del&id={$row['id']}'>删除用户</a></td>
             <td><a href='#'>修改用户</a></td>
             </tr>";
    }
    
    
    echo "<h1>雇员信息列表</h1>";
 
    echo "</table>";
    
     
 
    echo $fenyePage->navigate;
    
    
?>
<form action="empList.php">
    跳转到：<input type="text" name="pageNow" />
       <input type="submit" value="GO"> 
</form>

</html>