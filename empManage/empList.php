<html>
<head>
<meta http-equiv="content-type" content="text/html";charset=utf-8 />
<title>��Ա��Ϣ�б�</title>
<script type="text/javascript">
<!--
	function confirmDele(val){
		return window.confirm("�Ƿ�Ҫɾ��id="+val+"���û���");
	}
//-->
</script>
</head>
<?php 

    require_once 'EmpService.class.php';
    require_once 'FenyePage.php';
    
    $empService=new EmpService();
    
    //����һ��fenyePage����ʵ��
    $fenyePage=new FenyePage();
    
    //��pageNowָ�����������
    $fenyePage->pageNow=1;
    $fenyePage->pageSize=6;
    
   
    
    //��Ҫ�����û��ĵ�����޸ĵ�ǰҳ��ֵ
    if (!empty($_GET['pageNow'])){                 //����ж�pageNow��ֵ��Ϊ��  �������û���һ�ε�¼�Ļ�
        $fenyePage->pageNow=$_GET['pageNow'];      //�͸����û�������д�ֵ  
                                                   //���pageNowΪ��  ���û���һ�ε�¼  ��ǰҳĬ��Ϊ1
    }
    
    $empService->getFenyaPage($fenyePage);
    
    echo "<table cellspacing=0 cellpadding=5 border='1px' bordercolor='blue' width='700px'>";
    echo "<tr>
            <th>id</th>
            <th>name</th>
            <th>grade</th>
            <th>email</th>
            <th>slary</th>
            <th>ɾ���û�</th>
            <th>�޸��û�</th>
        </tr>";
   
    
    //����ͨ������ȡ
    for ($i=0;$i<count($fenyePage->res_array);$i++){
        $row=$fenyePage->res_array[$i]; 
        echo "<tr style='text-align:center'>
             <td>{$row['id']}</td>
             <td>{$row['name']}</td>
             <td>{$row['grade']}</td>
             <td>{$row['email']}</td>
             <td>{$row['salary']}</td>
             <td><a onclick='return confirmDele({$row['id']})' href='empProcess.php?flag=del&id={$row['id']}'>ɾ���û�</a></td>
             <td><a href='#'>�޸��û�</a></td>
             </tr>";
    }
    
    
    echo "<h1>��Ա��Ϣ�б�</h1>";
 
    echo "</table>";
    
     
 
    echo $fenyePage->navigate;
    
    
?>
<form action="empList.php">
    ��ת����<input type="text" name="pageNow" />
       <input type="submit" value="GO"> 
</form>

</html>