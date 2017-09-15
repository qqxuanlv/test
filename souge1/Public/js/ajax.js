function AjaxGetCHTML(url,data,processFunction)
{
	$.ajax({
			type : 'post',
			url : url,
			data : data,
			dataType : 'text',
			success : processFunction,
			error : function()
			{
				alert("连接超时，请重新登录");
			}
		});
}
function showDetail(id) {
	AjaxGetCHTML("pro.php",$.param({tid:id,action:1}),function(data)
	{
		$("#two_li").html(data);									 
	});
}


function showpro(id) {
	AjaxGetCHTML("pro_list.php",$.param({tid:id,action:1}),function(data)
	{
		$("#three_li").html(data);									 
	});
}


function showprosd(id) {
	AjaxGetCHTML("prosd.php",$.param({pid:id,action:1}),function(data)
	{
		$(".prosd").html(data);									 
	});
}