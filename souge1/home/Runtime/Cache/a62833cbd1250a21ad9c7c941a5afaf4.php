<?php if (!defined('THINK_PATH')) exit(); echo ($a); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>望远镜商城</title>
<link href="__INDEX__/css/wyj.css" rel="stylesheet">
<script src="__INDEX__/js/jquery-1.4.2.min.js"></script>
<script src="__INDEX__js/jquery.libs-1.2.6pack.js" type="text/javascript"></script>
<script src="__INDEX__js/effect_commonv1.1.js" type="text/javascript"></script>
<script type="text/javascript">
    function DY_scroll(wraper,prev,next,img,speed,or)
    {
    var wraper = $(wraper);
    var prev = $(prev);
    var next = $(next);
    var img = $(img).children('ul');
    var w = img.children('li').outerWidth(true);
    var s = speed;
    next.click(function()
    {
    img.animate({'margin-left':-w},function()
    {
    img.children('li').eq(0).appendTo(img);
    img."__INDEX__/"__INDEX__/css//({'margin-left':0});
    });
    });
    prev.click(function()
    {
    img.children('li:last').prependTo(img);
    img."__INDEX__/"__INDEX__/css//({'margin-left':-w});
    img.animate({'margin-left':0});
    });
    if (or == true)
    {
    ad = setInterval(function() { next.click();},s*1000);
    wraper.hover(function(){clearInterval(ad);},function(){ad = setInterval(function() { next.click();},s*1000);});
    }
    }

    </script>
	
	<script>
<!--
$(function(){
	$(".menu li#zixun").mouseenter(function(){
		$(this).find(".sub_menu").show();
		$(".bg").show();
	});
	$(".menu li#zixun").mouseleave(function(){
		$(this).find(".sub_menu").hide();
		$(".bg").hide();
	});
});

//-->
</script>
</head>
<body>
<div class="ding">
   <div class="dingx">
      <div class="ding-zuo">HI,欢迎来到GO 望远镜商城!   请登录   免费注册</div>
      <div class="ding-you">帮助中心  |  礼品兑换  |  收藏本站  |  加关注   |  客服电话：400-884-1868</div>
   </div>
</div>

<div class="zt">
   <div class="logo"><img src="__INDEX__/images/logo.png" border="0" /></div>
   <div class="sousuo">
   	       <div class="search">
			<form action="Products.php" method="get" name="form1">
				<input name="keyword" class="textIn" value="" onFocus="if (this.value ==''){this.value='';}" onBlur="if(this.value==''){this.value='';}" type="text">
                <input name="f" id="f" value="search" type="hidden">
                <input name="catid" id="catid" value="3" type="hidden">
				<input name="submit" class="submitIn" value="" type="submit">
			 </form>
		    </div>　
   </div>
   
   <div class="youzi">
      <li><span class="jtu"><img src="__INDEX__/images/bb1.png" class="tbxx" border="0" /></span> <span class="jz">个人中心</span></li>
	  <li><span class="jtu"><img src="__INDEX__/images/bb2.png" class="tbxx" border="0" /></span> <span class="jz">购物车<span class="hong">（0）</span></span></li>
	  <li class="dingzhi"><a href="#">预约定制 ></a></li>
	  
   </div>
</div>

<div class="daohang">
   <div class="zt menu">
      <div class="dh-left">
	  <li id="zixun">
	  <span class="dh-kk">
	  <a href="#">全部分类</a>
	  </span>
	  <ul class="sub_menu">
	    <li>
	     <div class="ddh">
		    <h2>折射款</h2>
			<a href="#">星特朗 CELESTORM</a>     <a href="#">经典 80QE</a><br />
<a href="#">星达 sky-watcher</a>     <a href="#">莫得made</a>
		 </div>
		 
		 <div class="ddh">
		    <h2>折射款</h2>
			<a href="#">星特朗 CELESTORM</a>     <a href="#">经典 80QE</a><br />
<a href="#">星达 sky-watcher</a>     <a href="#">莫得made</a>
		 </div>
		 
		 <div class="ddh">
		    <h2>折射款</h2>
			<a href="#">星特朗 CELESTORM</a>     <a href="#">经典 80QE</a><br />
<a href="#">星达 sky-watcher</a>     <a href="#">莫得made</a>
		 </div>
		 
		 <div class="ddh">
		    <h2>折射款</h2>
			<a href="#">星特朗 CELESTORM</a>     <a href="#">经典 80QE</a><br />
<a href="#">星达 sky-watcher</a>    <a href="#">莫得made</a>
		 </div>
		 </li>
	  </ul>
	  </li>
	  </div>
	  <div class="dh-right">
	     <li class="hover"><a href="#">首页</a></li>
		 <li><a href="#">用户分享</a></li>
		 <li><a href="#">天文发展史</a></li>
	  </div>
   </div>
</div>
<div class="banner"></div>
<div class="sbbj">
   <div class="sbk">
      <li><img src="__INDEX__/images/biao1.jpg" width="148" border="0" class="bd" /></li>
	  <li><img src="__INDEX__/images/biao2.jpg" width="148" border="0" class="bd" /></li>
	  <li><img src="__INDEX__/images/biao3.jpg" width="148" border="0" class="bd" /></li>
	  <li><img src="__INDEX__/images/biao4.jpg" width="148" border="0" class="bd" /></li>
	  <li><img src="__INDEX__/images/biao1.jpg" width="148" border="0" class="bd" /></li>
	  <li><img src="__INDEX__/images/biao2.jpg" width="148" border="0" class="bd" /></li>
	  <li><img src="__INDEX__/images/biao3.jpg" width="148" border="0" class="bd" /></li>
	  <li><img src="__INDEX__/images/biao4.jpg" width="148" border="0" class="bd" /></li>
   </div>
</div>


<div class="zt">
   <div class="kuai">
      <div class="row">
      <li><a href="#"><img src="__INDEX__/images/fen1.jpg" border="0" /></a></li>
	  <li><a href="#"><img src="__INDEX__/images/fen2.jpg" border="0" /></a></li>
	  <li><a href="#"><img src="__INDEX__/images/fen3.jpg" border="0" /></a></li>
	  </div>
   </div>
   
   <div class="kuai">
      <div class="cptt-lan">
	     <div class="cptt-lan-t"><img src="__INDEX__/images/rr1.png" /> 天文入门</div>
	  </div>
	  
	   <div class="img-scroll" id="gunpic"> <span class="prev" id="prev" style="cursor:pointer"></span> <span class="next" id="next" style="cursor:pointer"></span>
            <div class="img-list" id="img-list">
			  <ul>
	           <li>
               <div class="cptu">
                 <div class="cptu-tu"><img src="__INDEX__/images/cp1.jpg" border="0" /></div>
				 <div class="cptu-zi">
				 星达60700AZ2入门天文望远镜<br />
				 口径：60mm  焦距：700mm  焦比：FLL.7
				 </div>
				 <div class="price">
				    <div class="discount">
                         6<span>.5折</span>
                    </div>
					<div class="act_price">
                        <del>12999</del>
                       <br>
                       <span class="shuzi"><i>￥</i>8999</span>
                    </div>
				 </div>
			   </div>
		       </li>
			   
	           <li>
               <div class="cptu">
                 <div class="cptu-tu"><img src="__INDEX__/images/cp1.jpg" border="0" /></div>
				 <div class="cptu-zi">
				 星达60700AZ2入门天文望远镜<br />
				 口径：60mm  焦距：700mm  焦比：FLL.7
				 </div>
				 <div class="price">
				    <div class="discount">
                         6<span>.5折</span>
                    </div>
					<div class="act_price">
                        <del>12999</del>
                       <br>
                       <span class="shuzi"><i>￥</i>8999</span>
                    </div>
				 </div>
			   </div>
		       </li>
			   
	           <li>
               <div class="cptu">
                 <div class="cptu-tu"><img src="__INDEX__/images/cp1.jpg" border="0" /></div>
				 <div class="cptu-zi">
				 星达60700AZ2入门天文望远镜<br />
				 口径：60mm  焦距：700mm  焦比：FLL.7
				 </div>
				 				 <div class="price">
				    <div class="discount">
                         6<span>.5折</span>
                    </div>
					<div class="act_price">
                        <del>12999</del>
                       <br>
                       <span class="shuzi"><i>￥</i>8999</span>
                    </div>
				 </div>
			   </div>
		       </li>
			   
	           <li>
               <div class="cptu">
                 <div class="cptu-tu"><img src="__INDEX__/images/cp1.jpg" border="0" /></div>
				 <div class="cptu-zi">
				 星达60700AZ2入门天文望远镜<br />
				 口径：60mm  焦距：700mm  焦比：FLL.7
				 </div>
				 				 <div class="price">
				    <div class="discount">
                         6<span>.5折</span>
                    </div>
					<div class="act_price">
                        <del>12999</del>
                       <br>
                       <span class="shuzi"><i>￥</i>8999</span>
                    </div>
				 </div>
			   </div>
		       </li>
		
		     </ul>
		   </div>
     </div>
        <script type="text/javascript">
     DY_scroll('#gunpic','#prev','#next','#img-list',3,true);// true为自动播放，不加此参数或false就默认不自动
    </script>
   </div>
   
   
   <div class="kuai">
      <div class="kuai-tu"><img src="__INDEX__/images/tw1.jpg" border="0" /></div>
	  
	  
	  <div class="kuai-nei">
	     <div class="kuai-nei-lie">
		    <div class="kuai-nei-lie-tu"><img src="__INDEX__/images/cpb1.jpg" /></div>
			<div class="kuai-nei-lie-xx">
			   星特朗 CELESTORM<br /> 
			   星达 sky-watcher<br /> 
			   莫得made<br />  
			   经典 80QE<br />
			</div>
		 </div>
		 
		 <div class="kuai-nei-cp">
		    <div class="rowt">
		    <li><img src="__INDEX__/images/tt1.jpg" width="247" class="tudi" border="0" /><div class="guzi">星达入门天文望远镜<br /><del>专柜价1000</del>      <span class="dahong">商城价：800</span></div></li>
			<li><img src="__INDEX__/images/tt1.jpg" width="247" class="tudi" border="0" /><div class="guzi">星达入门天文望远镜<br /><del>专柜价1000</del>      <span class="dahong">商城价：800</span></div></li>
			<li><img src="__INDEX__/images/tt1.jpg" width="247" class="tudi" border="0" /><div class="guzi">星达入门天文望远镜<br /><del>专柜价1000</del>      <span class="dahong">商城价：800</span></div></li>
			<li><img src="__INDEX__/images/tt1.jpg" width="247" class="tudi" border="0" /><div class="guzi">星达入门天文望远镜<br /><del>专柜价1000</del>      <span class="dahong">商城价：800</span></div></li>
			</div>
		 </div>		 
	  </div>
	  
	  
	  	  <div class="kuai-nei">
	     <div class="kuai-nei-lie">
		    <div class="kuai-nei-lie-tu"><img src="__INDEX__/images/cpb2.jpg" /></div>
			<div class="kuai-nei-lie-xx">
			   星特朗 CELESTORM<br /> 
			   星达 sky-watcher<br /> 
			   莫得made<br />  
			   经典 80QE<br />
			</div>
		 </div>
		 
		 <div class="kuai-nei-cp">
		    <div class="rowt">
		    <li><img src="__INDEX__/images/tt1.jpg" width="247" class="tudi" border="0" /><div class="guzi">星达入门天文望远镜<br /><del>专柜价1000</del>      <span class="dahong">商城价：800</span></div></li>
			<li><img src="__INDEX__/images/tt1.jpg" width="247" class="tudi" border="0" /><div class="guzi">星达入门天文望远镜<br /><del>专柜价1000</del>      <span class="dahong">商城价：800</span></div></li>
			<li><img src="__INDEX__/images/tt1.jpg" width="247" class="tudi" border="0" /><div class="guzi">星达入门天文望远镜<br /><del>专柜价1000</del>      <span class="dahong">商城价：800</span></div></li>
			<li><img src="__INDEX__/images/tt1.jpg" width="247" class="tudi" border="0" /><div class="guzi">星达入门天文望远镜<br /><del>专柜价1000</del>      <span class="dahong">商城价：800</span></div></li>
			</div>
		 </div>		 
	  </div>
	  
	  
	  	  <div class="kuai-nei">
	     <div class="kuai-nei-lie">
		    <div class="kuai-nei-lie-tu"><img src="__INDEX__/images/cpb3.jpg" /></div>
			<div class="kuai-nei-lie-xx">
			   星特朗 CELESTORM<br /> 
			   星达 sky-watcher<br /> 
			   莫得made<br />  
			   经典 80QE<br />
			</div>
		 </div>
		 
		 <div class="kuai-nei-cp">
		    <div class="rowt">
		    <li><img src="__INDEX__/images/tt1.jpg" width="247" class="tudi" border="0" /><div class="guzi">星达入门天文望远镜<br /><del>专柜价1000</del>      <span class="dahong">商城价：800</span></div></li>
			<li><img src="__INDEX__/images/tt1.jpg" width="247" class="tudi" border="0" /><div class="guzi">星达入门天文望远镜<br /><del>专柜价1000</del>      <span class="dahong">商城价：800</span></div></li>
			<li><img src="__INDEX__/images/tt1.jpg" width="247" class="tudi" border="0" /><div class="guzi">星达入门天文望远镜<br /><del>专柜价1000</del>      <span class="dahong">商城价：800</span></div></li>
			<li><img src="__INDEX__/images/tt1.jpg" width="247" class="tudi" border="0" /><div class="guzi">星达入门天文望远镜<br /><del>专柜价1000</del>      <span class="dahong">商城价：800</span></div></li>
			</div>
		 </div>		 
	  </div>
	  
	  
	  	  	  <div class="kuai-nei">
	     <div class="kuai-nei-lie">
		    <div class="kuai-nei-lie-tu"><img src="__INDEX__/images/cpb4.jpg" /></div>
			<div class="kuai-nei-lie-xx">
			   星特朗 CELESTORM<br /> 
			   星达 sky-watcher<br /> 
			   莫得made<br />  
			   经典 80QE<br />
			</div>
		 </div>
		 
		 <div class="kuai-nei-cp">
		    <div class="rowt">
		    <li><img src="__INDEX__/images/tt1.jpg" width="247" class="tudi" border="0" /><div class="guzi">星达入门天文望远镜<br /><del>专柜价1000</del>      <span class="dahong">商城价：800</span></div></li>
			<li><img src="__INDEX__/images/tt1.jpg" width="247" class="tudi" border="0" /><div class="guzi">星达入门天文望远镜<br /><del>专柜价1000</del>      <span class="dahong">商城价：800</span></div></li>
			<li><img src="__INDEX__/images/tt1.jpg" width="247" class="tudi" border="0" /><div class="guzi">星达入门天文望远镜<br /><del>专柜价1000</del>      <span class="dahong">商城价：800</span></div></li>
			<li><img src="__INDEX__/images/tt1.jpg" width="247" class="tudi" border="0" /><div class="guzi">星达入门天文望远镜<br /><del>专柜价1000</del>      <span class="dahong">商城价：800</span></div></li>
			</div>
		 </div>		 
	  </div>
	  
	  
	  	  	  <div class="kuai-nei">
	     <div class="kuai-nei-lie">
		    <div class="kuai-nei-lie-tu"><img src="__INDEX__/images/cpb5.jpg" /></div>
			<div class="kuai-nei-lie-xx">
			   星特朗 CELESTORM<br /> 
			   星达 sky-watcher<br /> 
			   莫得made<br />  
			   经典 80QE<br />
			</div>
		 </div>
		 
		 <div class="kuai-nei-cp">
		    <div class="rowt">
		    <li><img src="__INDEX__/images/tt1.jpg" width="247" class="tudi" border="0" /><div class="guzi">星达入门天文望远镜<br /><del>专柜价1000</del>      <span class="dahong">商城价：800</span></div></li>
			<li><img src="__INDEX__/images/tt1.jpg" width="247" class="tudi" border="0" /><div class="guzi">星达入门天文望远镜<br /><del>专柜价1000</del>      <span class="dahong">商城价：800</span></div></li>
			<li><img src="__INDEX__/images/tt1.jpg" width="247" class="tudi" border="0" /><div class="guzi">星达入门天文望远镜<br /><del>专柜价1000</del>      <span class="dahong">商城价：800</span></div></li>
			<li><img src="__INDEX__/images/tt1.jpg" width="247" class="tudi" border="0" /><div class="guzi">星达入门天文望远镜<br /><del>专柜价1000</del>      <span class="dahong">商城价：800</span></div></li>
			</div>
		 </div>		 
	  </div>
	  

	  
   </div>
   
   
   
   <div class="kuai">
      <div class="kuai-tu"><img src="__INDEX__/images/tw2.jpg" border="0" /></div>
   
      	  <div class="kuai-nei">
	     <div class="kuai-nei-lie">
		    <div class="kuai-nei-lie-tu"><img src="__INDEX__/images/cpc1.jpg" /></div>
			<div class="kuai-nei-lie-xx">
			   星特朗 CELESTORM<br /> 
			   星达 sky-watcher<br /> 
			   莫得made<br />  
			   经典 80QE<br />
			</div>
		 </div>
		 
		 <div class="kuai-nei-cp">
		    <div class="rowt">
		    <li><img src="__INDEX__/images/tt1.jpg" width="247" class="tudi" border="0" /><div class="guzi">星达入门天文望远镜<br /><del>专柜价1000</del>      <span class="dahong">商城价：800</span></div></li>
			<li><img src="__INDEX__/images/tt1.jpg" width="247" class="tudi" border="0" /><div class="guzi">星达入门天文望远镜<br /><del>专柜价1000</del>      <span class="dahong">商城价：800</span></div></li>
			<li><img src="__INDEX__/images/tt1.jpg" width="247" class="tudi" border="0" /><div class="guzi">星达入门天文望远镜<br /><del>专柜价1000</del>      <span class="dahong">商城价：800</span></div></li>
			<li><img src="__INDEX__/images/tt1.jpg" width="247" class="tudi" border="0" /><div class="guzi">星达入门天文望远镜<br /><del>专柜价1000</del>      <span class="dahong">商城价：800</span></div></li>
			</div>
		 </div>		 
	  </div>
	  
	  
	  	  <div class="kuai-nei">
	     <div class="kuai-nei-lie">
		    <div class="kuai-nei-lie-tu"><img src="__INDEX__/images/cpc2.jpg" /></div>
			<div class="kuai-nei-lie-xx">
			   星特朗 CELESTORM<br /> 
			   星达 sky-watcher<br /> 
			   莫得made<br />  
			   经典 80QE<br />
			</div>
		 </div>
		 
		 <div class="kuai-nei-cp">
		    <div class="rowt">
		    <li><img src="__INDEX__/images/tt1.jpg" width="247" class="tudi" border="0" /><div class="guzi">星达入门天文望远镜<br /><del>专柜价1000</del>      <span class="dahong">商城价：800</span></div></li>
			<li><img src="__INDEX__/images/tt1.jpg" width="247" class="tudi" border="0" /><div class="guzi">星达入门天文望远镜<br /><del>专柜价1000</del>      <span class="dahong">商城价：800</span></div></li>
			<li><img src="__INDEX__/images/tt1.jpg" width="247" class="tudi" border="0" /><div class="guzi">星达入门天文望远镜<br /><del>专柜价1000</del>      <span class="dahong">商城价：800</span></div></li>
			<li><img src="__INDEX__/images/tt1.jpg" width="247" class="tudi" border="0" /><div class="guzi">星达入门天文望远镜<br /><del>专柜价1000</del>      <span class="dahong">商城价：800</span></div></li>
			</div>
		 </div>		 
	  </div>
   
   </div>
   
   
   
   <div class="kuai">
      <div class="kuai-tu"><img src="__INDEX__/images/tw3.jpg" border="0" /></div>
	  
	  <div class="kuai-nei">
	     <div class="kuai-nei-lie">
		    <div class="kuai-nei-lie-tu"><img src="__INDEX__/images/cpd1.jpg" /></div>
			<div class="kuai-nei-lie-xx">
			   星特朗 CELESTORM<br /> 
			   星达 sky-watcher<br /> 
			   莫得made<br />  
			   经典 80QE<br />
			</div>
		 </div>
		 
		 <div class="kuai-nei-cp">
		    <div class="rowt">
		    <li><img src="__INDEX__/images/tt1.jpg" width="247" class="tudi" border="0" /><div class="guzi">星达入门天文望远镜<br /><del>专柜价1000</del>      <span class="dahong">商城价：800</span></div></li>
			<li><img src="__INDEX__/images/tt1.jpg" width="247" class="tudi" border="0" /><div class="guzi">星达入门天文望远镜<br /><del>专柜价1000</del>      <span class="dahong">商城价：800</span></div></li>
			<li><img src="__INDEX__/images/tt1.jpg" width="247" class="tudi" border="0" /><div class="guzi">星达入门天文望远镜<br /><del>专柜价1000</del>      <span class="dahong">商城价：800</span></div></li>
			<li><img src="__INDEX__/images/tt1.jpg" width="247" class="tudi" border="0" /><div class="guzi">星达入门天文望远镜<br /><del>专柜价1000</del>      <span class="dahong">商城价：800</span></div></li>
			</div>
		 </div>		 
	  </div>
   </div>
   
   
   <div class="kuai2">
      <div class="kuai2-zuo">
	     <div class="kuai2-zuo-lan">买家分享</div>
		 <div class="kuai2-zuo-nei">
		    <div class="kk-left"><img src="__INDEX__/images/wyj1.jpg" class="tudix" border="0" /><div class="guzix">如何在天气不理想的情况下看到星云</div></div>
			<div class="kk-right">
			<img src="__INDEX__/images/wyj2.jpg" border="0" /><img src="__INDEX__/images/wyj3.jpg" class="ttp" border="0" />
			</div>
		 </div>
	  </div>
	  <div class="kuai2-news">
	     <div class="kuai2-zuo-lan">观星攻略</div>
		 <div class="kuai2-zuo-nei">
		    <img src="__INDEX__/images/newstu1.jpg" border="0" />
			
			<div class="xw-nn">
			   <li>1.怎么拍出星空的照片?</li>
			   <li>1.怎么拍出星空的照片?</li>
			   <li>1.怎么拍出星空的照片?</li>
			   <li>1.怎么拍出星空的照片?</li>
			   <li>1.怎么拍出星空的照片?</li>
			   <li>1.怎么拍出星空的照片?</li>
			</div>
		 </div>
	  </div>
	  <div class="kuai2-news">
	     <div class="kuai2-zuo-lan">新手指导</div>
		 <div class="kuai2-zuo-nei">
		    <img src="__INDEX__/images/newstu2.jpg" border="0" />
			<div class="xw-nn">
			   <li>1.怎么拍出星空的照片?</li>
			   <li>1.怎么拍出星空的照片?</li>
			   <li>1.怎么拍出星空的照片?</li>
			   <li>1.怎么拍出星空的照片?</li>
			   <li>1.怎么拍出星空的照片?</li>
			   <li>1.怎么拍出星空的照片?</li>
			</div>
		 </div>
	  </div>
   </div>
   
</div>


<div class="bottom">
   <div class="zt">
      <div class="di-lie">
	  <h2>关于我们</h2>
	  公司简介<br />
企业文化<br />
企业荣誉<br />
品牌实力<br />
假冒产品举报<br />
	  </div>
	  <div class="di-lie">
	  <h2>新手指南</h2>
常见问题<br />
隐私声明<br />
用户协议<br />
购物须知<br />
购物流程<br />
注册新用户<br />	  
	  </div>
	  <div class="di-lie">
	  	  <h2>联系我们</h2>
在线咨询预约<br />
电话咨询<br />
填写表单预约<br />
	  </div>
	  <div class="di-lie">
	  <h2>配送安装</h2>
	  收货指南<br />
物流配送<br />
	  </div>
	  <div class="di-lie">
	  <h2>售后保障</h2>
	  退货政策<br />
免责声明<br />
	  </div>
	  <div class="di-gz">
	  <h2>关注</h2>

<div class="dk1">
   <div class="dk1-left"></div>
   <div class="dk1-zi">关注我们</div>
</div>	

<div class="dk2">
   <div class="dk1-left"></div>
   <div class="dk1-zi">关注我们</div>
</div>	

<div class="dk3">
   <div class="dk1-left"></div>
   <div class="dk1-zi">关注我们</div>
</div>		 
		 
	  </div>
   </div>
</div>

<div class="footer">
COPYRIGHT 2015 @ GO望远镜<br />
《中华人民共和国电信与信息服务业务经营许可证》编号:浙ICP备16943267号         荣胜网络提供技术支持
</div>

</body>
</html>