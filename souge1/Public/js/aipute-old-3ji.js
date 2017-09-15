window.onload = function() {
  hidTxt();
  showAndHid_sheng();
}

function hidTxt() {
  var txt1 = document.getElementById("txt1");
  txt1.onfocus = function() {
	this.value = "";
  }
  txt1.onblur = function() {
	this.value = "";
  }
  
  var mileage = document.getElementById("mileage");
  mileage.onfocus = function() {
	this.value = "";
  }
  mileage.onblur = function() {
	this.value = "";
  }
}//“搜索”失去和获得焦点

$(function() {
  $("#menu2 ol").hide();
  $("#menu2 > li span.tit2").toggle(function() {
	$(this).css({"background":"url(Public/images/leftBar2_3.png) no-repeat 0 7px"});
	$(this).siblings("ol").show();
	$(this).parent().siblings().find("ol").hide();
	$(this).parent().siblings().find("span.tit2").css({"background":"url(Public/images/leftBar2_2.jpg) no-repeat 0 7px"});
	$("#menu2 ol ul").hide();
  }, function() {
	$(this).css({"background":"url(Public/images/leftBar2_2.jpg) no-repeat 0 7px"});
	$(this).siblings("ol").hide();
  });
  
  $("#menu2 ol ul").hide();
  $("#menu2 ol h3").toggle(function() {
	$(this).parent().find("ul").show();
	$(this).parent().siblings("li").find("ul").hide();
  }, function() {
	$(this).parent().find("ul").hide();
  });
});//左边3级菜单

$(function() {
  $("#menu1 > li:eq(0) h3").css({"background" : "url(Public/images/menu_tit1.jpg) no-repeat", "color" : "#fff"});
  $("#menu1 > li:eq(0) dl").css({"display" : "block"});
  $("#menu1 > li h3").toggle(function() {
  if(!$(this).parents("li").find("dl").is(":animated")) {
    $(this).parents("li").find("dl").slideDown(100);
	  $(this).parents("li").siblings().find("dl").slideUp(100);
	  $(this).css({"background" : "url(Public/images/menu_tit1.jpg) no-repeat", "color" : "#fff"});
	  $(this).parents("li").siblings().find("h3").css({"background" : "url(Public/images/menu_tit2.jpg) no-repeat", "color" : "#333"});
	  $("#menu1 dd").hide();
	}
  }, function() {
  if(!$(this).parents("li").find("dl").is(":animated")) {
	  $(this).parents("li").find("dl").slideUp(100);
	  $(this).css({"background" : "url(Public/images/menu_tit2.jpg) no-repeat", "color" : "#333"});
  }
  });
  
  $("#menu1 dd").hide();
  $("#menu1 dt").toggle(function() {
	  var i = $("#menu1 dt").index(this);
	  $("#menu1 dd").eq(i).show();
	  $("#menu1 dd").eq(i).siblings("dd").hide();	  
	  $("#menu1 ol.siji").hide();
    }, function() {
	  var i = $("#menu1 dt").index(this);
	  $("#menu1 dd").eq(i).hide();
  }); 
   
  $("#menu1 ol.siji").hide();
  $("#menu1 span.tit2").toggle(function() {
  	var j = $("#menu1 span.tit2").index(this);
  	$("#menu1 ol.siji").eq(j).show();
  }, function() {
  	var j = $("#menu1 span.tit2").index(this);
  	$("#menu1 ol.siji").eq(j).hide();
  });
});//左边4级菜单

$(function() {
	$("ul.tuijian li:eq(0)").css({"background" : "url(Public/images/productsd_hover.jpg) no-repeat", "color" : "white"});
	$("ul.tuijian li:eq(2)").css({"background" : "url(Public/images/productsd_hover.jpg) no-repeat", "color" : "white"});
	$("ul.tuijian li:eq(6)").css({"background" : "url(Public/images/productsd_hover.jpg) no-repeat", "color" : "white"});
	$("ul.tuijian li").click(function() {
		$(this).css({"background" : "url(Public/images/productsd_hover.jpg) no-repeat", "color" : "white"})
		.siblings().css({"background" : "url(Public/images/productsd.jpg) no-repeat", "color" : "#333"});
		var index = $("ul.tuijian li").index(this);
		$("div.chanpin > div.show_hide").eq(index).show()
		.siblings().hide();
	});
});//productsd右边网页选项卡

function showAndHid_sheng() {
  var sheng = document.getElementById("sheng");
  var showDiv_sheng = document.getElementById("showDiv_sheng");
  var closeButtons = showDiv_sheng.getElementsByTagName("span");
  sheng.onclick = function() {
	this.style.cssText = "border:solid 2px #eed97c; padding: 3px 23px 10px 8px; background:url(Public/images/shengBg.jpg) no-repeat 50px 10px;";
	showDiv_sheng.style.display = "block";
	return false;
  }
  closeButtons[0].onclick = function() {
	sheng.style.cssText = "border:0";
	showDiv_sheng.style.display = "none";
	return false;
  }
}//productsd购买选择弹出层

$(function() {
	$(".click_changePinpai ul > li:eq(0) span").css({"background":"#a40101 url(Public/images/chacha.jpg) no-repeat right 0", "color":"white"});
	$(".click_changePinpai ul > li").click(function() {
		var i = $(".click_changePinpai ul > li").index(this);
		$(this).find("span").css({"background":"#a40101 url(Public/images/chacha.jpg) no-repeat right 0", "color":"white"});
		$(this).siblings().find("span").css({"background":"none", "color":"#333"});
		$(".car_pinpai > dl").eq(i).show();
		$(".car_pinpai > dl").eq(i).siblings().hide();
	});
});//productsList选择汽车品牌的选项卡

$(function() {  
	var len = $(".num > li").length;
	var i = 0;
	var adTimer;
	function showImg(i) {
	  var scrollWidth = $(".slider li img").width();
    $(".slider").stop(true,false).animate({"left": -scrollWidth * i + "px"}, 1000);
	  $(".num > li").removeClass("on").eq(i).addClass("on");
	  /*
	  var scrollWidth = $(".slider li img");
    scrollWidth.attr("src", "Public/images/bannerImg_" + i + ".jpg");
	  $(".num > li").removeClass("on").eq(i).addClass("on");
	  */
    }
	
	$(".num > li").click(function() {
		i = $(".num > li").index(this);
		showImg(i);
	}).eq(0).click();
	
	$("#ad").hover(function() {
		clearInterval(adTimer);
	},function() {
		adTimer = setInterval(function() {
			showImg(i);
			i++;
			if(i == len) {
				i = 0;
			}		
		}, 3000);
	}).trigger("click");
	
	adTimer = setInterval(function() {
		showImg(i);
		i++;
		if(i == len) {
			i = 0;
		}		
	}, 3000);
});//productsList上面滚动效果

$(function() {
  $("#proChange li.change3").eq(0).css({"background":"url(Public/images/proChange1.jpg) repeat-x", "color":"white"});
  /*
  $("#proList_con div.pro div.con > div").eq(1).hide();
  $("#proList_con div.pro div.con > div").eq(2).hide();
  $("#proList_con div.pro div.con > div").eq(3).hide();
  $("#proList_con div.pro div.con > div").eq(4).hide();
  $("#proChange li.change3").click(function() {
	var i = $("#proChange li.change3").index(this);
	$("#proList_con div.pro div.con > div").eq(i).show()
	.siblings().hide();
	$(this).css({"background":"url(Public/images/proChange1.jpg) repeat-x", "color":"white"})
	.siblings("li.change3").css({"background":"none", "color":"#666"});
  });
  */
});//productsList产品选项卡，注释部分现在已经废除

$(function () {
            var i = 0;
            $("#leftMove").click(function () {
                i--;
                if (i >= 0) {
                    $(".pr > div > table").eq(i).show().siblings("table").hide();
                }
                else {
                    i = 0;
                }
            });
            $("#rightMove").click(function () {
                i++;
                if (i <= 3) {
                    $(".pr > div > table").eq(i).show().siblings("table").hide();
                }
                else {
                    i = 3;
                }
            });
});//chexing右边保养信息表格翻页切换

