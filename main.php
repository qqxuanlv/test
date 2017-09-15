<html>

	<head>
	<script type='text/javascript' src='js/jquery.min.js'></script>

		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<title>琉璃神社</title>
		<link rel="stylesheet" type="text/css" href="Css/basic.css"/>
	</head>
	<body>
	<div id='page'>
		<header id="header">
			<hgroup id="brand"><h1><span><a href=''>琉璃神社 ★ HACG</a></span></h1>
			<h4>最新的ACG资讯 分享同人动漫的快乐</h4>
			</hgroup>
			<a href="index.html" ><img  alt="" src="http://www.hacg.lol/wp/wp-content/uploads/2015/11/logo150831.jpg" /></a>
			<form  action="" method="GET">
				<input id='search'  name="txt" type='text' placeholder="搜索" />
			</form>
		
			
			<nav id="nav">
				<ul>
					<li id="li1"><a href="main.php">最新更新</a></li>
					<li><a href="">文章</a></li>
					<li><a href="">动画</a></li>
					<li><a href="">漫画</a></li>
					<li><a href="">游戏</a></li>
					<li><a href="">音乐</a></li>
				
				</ul>
			</nav>
		</header>
		<div id="main" >
			<section id="primary">
				<div id="content">
					<header id="content_head">
					<h1>文章分类</h1></header>
					<article class="article">
				<?php
					include("ini.php");
						
						
							$sum=0;	
							while($se=mysqli_fetch_array($req))
							{	
									$sum++;
				?>				
								<div class="div_1">
								<h1><?php echo $se[1] ?></h1><br/>
								<h4>发表于：<a href="#"><?php echo $se[2] ?></a> 由   <a href="#" ><?php echo "HACG" ?></a></h4>
								<img src="img/<?php echo $se[4] ?>"/>
					
								<p><b>
							<?php 
 
								if(mb_strlen($se[3],'utf-8')>40)
								{
									echo mb_substr($se[3],0,120,"utf-8")."<a href='' style='font-size:12px;position:relative;top:1px;'>阅读全部...</a>";
								}
								else
								{
									echo $se[3];
								}
							?>	<b/></p>
							
									<hr/>
								</div>
						<?php
								if($sum==10)
								{
									$sum=0;
									break;
								}
						
							
							}
							mysqli_close($con);
							
							
							if($ss==1)
							{
								if($count>10)
								{	
							
									$xb=$count/10+1;
							
									echo "<ul class='xb'>";
						
									for($x=1;$x<=$xb;++$x)
									{
						
										echo "<li><a href='main.php?name=".$x."'>[<span id='span".$x."'>".$x."</span>]</a></li>";
									}
									echo "</ul>";
							
						}
							}
							
							
						
						?>
						
				<script type="text/javascript">
				$(function(){
			
					
					var s=<?php echo $count; ?>;
				
					if(s<10)
					{
					
						$("#page").css("height",600*s+"px");
						
					}
					else
					{
						$("#page").css("height","6300px");
						
						
					}
					$('#search').css("width","50px");
					
					$('#search').focus(function(){$('#search').css("width","160px");});
					$('#search').blur(function(){$('#search').css("width","50px");});
			
				
					
				})
					
			
				
			
				
				</script>
					
				
						<div class="artcontent"></div>
						<footer class="artfoot"></footer>
					</article>
					
				</div>	
				<div id="right"> </div>
			</section>
			<section id="secondary">
				
			</section>
		</div>
		<aside id='aside'></aside>
		<footer></footer>
	</div>
	
	<body>

	</html>
