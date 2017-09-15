// JavaScript Document

	$(document).ready(function(){
		
		$('input[name=sub]').click(function(){
			var name = $('#name').val();
			var carnumb = $('#carnumb').val();
			var address = $('#address').val();
			var mobile = $('#mobile').val();
			var tel = $('#tel').val();
			var email = $('#email').val();				
			var zipcode = $('#zipcode').val();

			
			
		
	if (name==""){ 
		alert("姓名不能为空！"); 
		$('#name').focus(); 
		return false; 
	}
		
	if (carnumb==""){ 
		alert("车牌号不能为空！"); 
		$('#carnumb').focus(); 
		return false; 
	}
		
	if (address==""){ 
		alert("地址不能为空！"); 
		$('#address').focus(); 
		return false; 
	}
		
			
	if (mobile=="" && tel==""){ 
		alert("电话号码和手机号码至少选填一个！"); 
		$('#mobile').focus(); 
		return false; 
	}


	
	
	
	
	if (mobile != ""){
	
		if(!(/^0?(13[0-9]|15[012356789]|18[0236789]|14[57])[0-9]{8}$/g.test(mobile))){
			
			alert("不是完整的11位手机号或者正确的手机号前七位"); 
			$('#mobile').focus();
			return false; 
		}
	
	}
	
	
	
	
	if (tel != ""){     
		var p1 = /[\d]{0,4}-[\d]{0,8}/g;    
		var me = false;    
		if (p1.test(tel)) me=true;   
		if (!me){       
			alert('对不起，您输入的电话号码有错误。区号和电话号码之间请用-分割');      
			return false;    
		}
	}

});
});		
