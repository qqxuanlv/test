<html>  
 <title>php+jquery+ajax+json��С����</title>  

<head>  
<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>  
<script type="text/javascript">  
$(function() {  
$("#subbtn").click(function() {  
 var params = $("input").serialize();  
 var url = "nn2.php";  
 $.ajax({  
 type: "post",  
 url: url,  
 dataType: "json",  
 data: params,  
 success: function(msg){  
 var backdata = "���ύ������Ϊ��" + msg.name +  
 "<br /> ���ύ������Ϊ��" + msg.password;  
 $("#backdata").html(backdata);  
 $("#backdata").css({color: "green"});  
 }  
 });  
 });  
   
 });  
   
 </script>  
 </head>  
 <body>  
 <p><label for="name">������</label>  
 <input id="name" name="name" type="text" />  
 </p>  
   
<p><label for="password">���룺</label>  
 <input id="password" name="password" type="password" />  
 </p>  
   
 <span id="backdata"></span>  
 <p><input id="subbtn" type="button" value="�ύ����" /></p>  
 </body>  
 </html>
