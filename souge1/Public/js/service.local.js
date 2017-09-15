$.fn.yijierji = function(settings){
	settings=$.extend({
		dyiji:"请选择",
		derji:"请选择",
		sanji:"请选择"
	},settings);
	var _self = this;
	_self.data("yiji",[settings.dyiji, settings.dyiji]);
	_self.data("erji1",[settings.derji,settings.derji]);
	_self.data("erji2",[settings.sanji,settings.sanji]);
	_self.append("<select id='yiji' name='yiji'></select>");
	_self.append("<select id='erji' name='erji'></select>");
	_self.append("<select id='sanji' name='sanji'></select>");
	var $sel1 = _self.find("select").eq(0);
	var $sel2 = _self.find("select").eq(1);
	var $sel3 = _self.find("select").eq(2);
	var proindex=jQuery.inArray(settings.dyiji,YJ);
	if(proindex!=-1){
		var derjiindex=jQuery.inArray(settings.derji,EJ[proindex]);
		if(derjiindex==-1) derjiindex=0;
		var sanjiindex=jQuery.inArray(settings.sanji,SJ[proindex][derjiindex]); 
		if(sanjiindex==-1) sanjiindex=0;
	}else{
		derjiindex=0;
		sanjiindex=0;
	}
	
	if(_self.data("yiji")){
		$sel1.append("<option value='"+_self.data("yiji")[1]+"'>"+_self.data("yiji")[0]+"</option>");
	}
	$.each(YJ, function(index,data){
		if(index==proindex){
			$sel1.append("<option value='"+data+"' selected='selected'>"+data+"</option>");
		}else{
			$sel1.append("<option value='"+data+"'>"+data+"</option>");
		}
	});
	if(_self.data("erji1")){
		$sel2.append("<option value='"+_self.data("erji1")[1]+"'>"+_self.data("erji1")[0]+"</option>");
	}
	if(_self.data("erji2")){
		$sel3.append("<option value='"+_self.data("erji2")[1]+"'>"+_self.data("erji2")[0]+"</option>");
	}
	var index1 = "" ;
	$sel1.change(function(){
		$sel2[0].options.length=0;
		$sel3[0].options.length=0;
		index1 = this.selectedIndex;
		if(index1==0){
			if(_self.data("erji1")){
				$sel2.append("<option value='"+_self.data("erji1")[1]+"'>"+_self.data("erji1")[0]+"</option>");
			}
			if(_self.data("erji2")){
				$sel3.append("<option value='"+_self.data("erji2")[1]+"'>"+_self.data("erji2")[0]+"</option>");
			}
		}else{
			$.each( EJ[index1-1] , function(index,data){
				if(derjiindex==index){
					$sel2.append("<option value='"+data+"' selected='selected'>"+data+"</option>");
				}else{
					$sel2.append("<option value='"+data+"'>"+data+"</option>");
				}
			});
			$.each( SJ[index1-1][derjiindex] , function(index,data){
				if(sanjiindex==index){
					$sel3.append("<option value='"+data+"' selected='selected'>"+data+"</option>");
				}else{
					$sel3.append("<option value='"+data+"'>"+data+"</option>");
				}
			})
		}
	}).change();
	var index2 = "" ;
	$sel2.change(function(){
		$sel3[0].options.length=0;
		index2 = this.selectedIndex;
		$.each( SJ[index1-1][index2] , function(index,data){
			$sel3.append("<option value='"+data+"'>"+data+"</option>")
		})
	});
	return _self;
};