<html >
 <head>
  <meta name="Charset" content="UTF-8"> 


  <meta name="Generator" content="EditPlus?">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>旋律</title>
  <style type="text/css">
*{margin:0px; padding:0px;}
html{ overflow:hidden;}

a{ text-decoration:none;}
html,body{width:100%;height:100%;}
  body{background-color:black; text-align:center; width:auto; height:900px;background-size: cover; 
 width: 100%;}
  hr{ display:block;width:70%;position:relative; min-width:200px;margin-left:auto;margin-right:auto;}
  h1{color:white;  display:block;position:relative;left:0%}
 
	/* ul*/
	ul{ list-style:none;display:block; position:relative;margin-left:auto;margin-right:auto;width:200px; margin-top:20%； }
	ul li{ display:block;margin-top:15px; text-align:center; width:200px; color:white; min-width:100px; font-weight :800 ; cursor:pointer;}
	ul li:hover{ color:blue;background-color:white;}
	ul P{color:gray;width:200px;text-align:center; font-size:3px; min-width:100px; }
	/* img*/	

	#div2{ display:block;width:100%;height:100%;position:relative; margin-right:auto;margin-right:auto;}

	#img {display:block;position:relative;
	-moz-animation:mymove 10s linear 0s infinite; 
	-webkit-animation:mymove 10s linear 0s infinite; 
	-ms-animation:mymove 10s linear 0s infinite;
	 -o-animation:mymove 10s linear 0s infinite;
	margin-left:auto;margin-right:auto; margin-bottom:4%;margin-top:2%;}

	@keyframes mymove{
		
		from {-webkit-transform:rotate(0deg); -ms-transform:rotate(0deg);-o-transform:rotate(0deg); -moz-transform:rotate(0deg);  }
		to{-webkit-transform:rotate(360deg);-ms-transform:rotate(360deg);-o-transform:rotate(360deg);-moz-transform:rotate(360deg);}	
	
	}
@-webkit-keyframes mymove{
		
		from { -webkit-transform:rotate(0deg);}
		to{-webkit-transform:rotate(360deg);}	
	
	}
@-webkit-keyframes mymove{
		
		from { -webkit-transform:rotate(0deg);}
		to{-webkit-transform:rotate(360deg);}	
	
	}
	


  </style>
 <script type="text/javascript" src="js/jquery.min.js"></script>
</head>
 <body>
 

	<div id="div2">
	<img src="Qmgback/toplogo[1].png"  id="img" width="" height="" alt="" />
		<h1>琉璃神社</h1>
		<hr/>
	<ul>
	
		<a href="main.php"><li>NEWS</li></a>
		<a href="v_olist/c_100_g__a_日本_sg__mt__lg__q__s_1_r_2016_u_0_pt_0_av_0_ag_0_sg__pr__h__d_1_p_1.html"><li>ANIME</li></a>
		<li>COMIC</li>
		<li id="n1">GAMES</li>
		
		<li><h5>临时备胎启用，正在抢救！</h5></li>
	</ul>

	
	</div>
	<script type="text/javascript">

	window.setInterval("con();",1000);
	
	function con(){
	
		$.ajax({
			type:"POST",
			url:"index_kz.php",
			data:"name=1",
			success: function(data){
						
				var s=data;
				
			
				$("body").css("background","url("+s+") no-repeat 50% 0");
			
			}
		});

 

	
	}
	
	
	</script>

</body>
</html>
