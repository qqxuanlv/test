
$(document).ready(function() {
	jQuery.jqtab = function(tabtit,tabcon) {
		$(tabcon).hide();
		$(tabtit+" li:eq(1)").addClass("thistab").show(); 
		$(tabcon+":eq(1)").show();
	
		$(tabtit+" li").click(function() {
			$(tabtit+" li").removeClass("thistab");
			$(this).addClass("thistab"); 
			$(tabcon).hide(); 
			var activeTab = $(this).find("a").attr("tab"); 
			$("#"+activeTab).fadeIn(); 
			return false;
		});
		
	};
	/*调用方法如下：*/
	$.jqtab("#tabs",".tab_con");
	
});
//按品牌检索
$(".allsort").hoverForIE6({current:".about_listmainhover",delay:300});
$(".allsort .item").hoverForIE6({delay:150});
//按品牌检索（弹出层效果）








var TINY={};

function T$(i){return document.getElementById(i)}
function T$$(e,p){return p.getElementsByTagName(e)}

TINY.accordion=function(){
	function slider(n){this.n=n; this.a=[]}
	slider.prototype.init=function(t,e,m,o,k){
		var a=T$(t), i=s=0, n=a.childNodes, l=n.length; this.s=k||0; this.m=m||0;
		for(i;i<l;i++){
			var v=n[i];
			if(v.nodeType!=3){
				this.a[s]={}; this.a[s].h=h=T$$(e,v)[0]; this.a[s].c=c=T$$('div',v)[0]; h.onclick=new Function(this.n+'.pr(0,'+s+')');
				if(o==s){h.className=this.s; c.style.height='auto'; c.d=1}else{c.style.height=0; c.d=-1} s++
			}
		}
		this.l=s
	};
	slider.prototype.pr=function(f,d){
		for(var i=0;i<this.l;i++){
			var h=this.a[i].h, c=this.a[i].c, k=c.style.height; k=k=='auto'?1:parseInt(k); clearInterval(c.t);
			if((k!=1&&c.d==-1)&&(f==1||i==d)){
				c.style.height=''; c.m=c.offsetHeight; c.style.height=k+'px'; c.d=1; h.className=this.s; su(c,1)
			}else if(k>0&&(f==-1||this.m||i==d)){
				c.d=-1; h.className=''; su(c,-1)
			}
		}
	};
	function su(c){c.t=setInterval(function(){sl(c)},20)};
	function sl(c){
		var h=c.offsetHeight, d=c.d==1?c.m-h:h; c.style.height=h+(Math.ceil(d/5)*c.d)+'px';
		c.style.opacity=h/c.m; c.style.filter='alpha(opacity='+h*100/c.m+')';
		if((c.d==1&&h>=c.m)||(c.d!=1&&h==1)){if(c.d==1){c.style.height='auto'} clearInterval(c.t)}
	};
	return{slider:slider}
}();

var parentAccordion=new TINY.accordion.slider("parentAccordion");
parentAccordion.init("acc","h3",1,10,"acc-red-selected");
//按分类检索




	
	$(".gdimg").jCarouselLite({
			btnNext: ".left",
			btnPrev: ".right",
			auto: 2000,
			speed: 800,	
			visible:6,
			scroll:1
			});	
			
			$(".fdjimg").jCarouselLite({
			btnNext: ".fdj_right",
			btnPrev: ".fdj_left",
			auto: 0,
			speed: 800,	
			visible:5,
			scroll:1
			});	
			

		  //点击滚动代码	


function test_item(n){
		var menu = document.getElementById("xxk1");
		var menuli = menu.getElementsByTagName("li");
		for(var i = 0; i< menuli.length;i++){
			menuli[i].className= "";
			menuli[n].className="yes";
			document.getElementById("test"+ i).className = "no";
			document.getElementById("test"+ n).className = "content";
		}
	}
	
//产品列表页选项卡	

