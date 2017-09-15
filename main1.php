<!DOCTYPE HTML>
<?php
header("content-type:text/html; charset=utf-8");
//$mysqli=new MySQLi("localhost","root","ciph19728","lish2");
//得到分类的id号
//$classid=$_GET['c'];
//加载分页类
include ("./class/page.class.php");

$con=mysqli_connect("localhost","root","ciph19728","lish2");
mysqli_query($con,"set names utf8");


if(isset($_GET['c']) && $_GET['c']!=''){
	//创建分页类对象
	$to=mysqli_query($con,"select * from tieb  where classid={$_GET['c']}");
	$total=mysqli_num_rows($to);
	$page=new Page($total,2);
	$sql="select * from tieb  where classid={$_GET['c']} order by id desc {$page->limit}";
}elseif(isset($_GET['u']) && $_GET['u']!=''){
	//创建分页类对象
	$to=mysqli_query($con,"select * from tieb where uid={$_GET['u']}");
	$total=mysqli_num_rows($to);
	$page=new Page($total,2);
	$sql="select * from tieb where uid={$_GET['u']} order by id desc {$page->limit}";
}else{
	//创建分页类对象
	$to=mysqli_query($con,"select * from tieb");
	$total=mysqli_num_rows($to);
	$page=new Page($total,2);
	$sql="select * from tieb order by id desc {$page->limit}";
}
$result=mysqli_query($con,$sql);
//$result=$mysqli->query($sql);

?>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<title>琉璃神社</title>
		<link rel="stylesheet" type="text/css" href="Css/basic.css"/>
		<script>
		function toQzoneLogin()
            {
                childWindow = window.open("example/oauth/index.php","TencentLogin","width=450,height=320,menubar=0,scrollbars=1, resizable=1,status=1,titlebar=0,toolbar=0,location=1");
            } 
		</script>
	</head>
<?php
	include 'header.php';//加载头部文件
?>
		<div id="main" >
			<section id="primary">
				<div id="content">
					<header id="content_head"><h1>文章分类:<a href="" class="link">
<?php
	switch ($_GET['c']){
		case 1:
		    echo "文章";
		    break;
 		case 2:
		    echo "动画";
		    break;
		case 3:
		    echo "漫画";
		    break;
		case 4:
		    echo "游戏";
		    break;
		case 5:
		    echo "音乐";
		    break;
		default:
		    echo "推荐";
	}
?>
					</a></h1></header>
<?php
while($arr=mysqli_fetch_assoc($result)){
	//$arr为文章的结果集
	$sql1="select * from user where id={$arr['uid']}";
	$uresult=mysqli_query($con,$sql1);
	$user=mysqli_fetch_assoc($uresult);
	//得到评论表
	$sql2="select * from cmts where tid={$arr['id']}";
	$cresult=mysqli_query($con,$sql2);
	$cnum=mysqli_num_rows($cresult);//得到评论数
	$cmts=mysqli_fetch_assoc($cresult);
	//得到分类
	$sql3="select * from class where id={$arr['classid']}";
	$classre=mysqli_query($con,$sql3);
	$class=mysqli_fetch_assoc($classre);
	//var_dump($class);
?>
					<article class="article">
						<header class="arthead">
						<h1 class='arth1'><a href="./comments.php?t=<?php echo $arr['id']?>#main"><?php echo $arr['title1']?></a></h1>
							<div class="artmsg">
								<span>发表于<span>
								<a href='' class='link'><?php echo $arr['time1']?></a>
								<span class="by_author">
									由
									<span class="author" ><a href='' class="link" title="查看<?php echo $user['nickname']?>的文章" ><?php echo $user['nickname']?></a></span>
								</span>
							</div>
							<div class="comments">
								<a href="./comments.php?t=<?php echo $arr['id']?>#com"><?php echo $cnum?></a>
							</div>
								
						</header>
						<div class="artcontent">
							<p>
							<img alt="" src="./img/<?php echo $arr['src1']?>">
							</p>
							<p>
							<?php //显示文章内容
							if(strlen($arr['text1'])>60)
							{
								echo mb_substr($arr['text1'],0,120,"utf-8")."...";
							}else{
								echo $arr['text1'];
							}
							?>
							</p>
							
							<audio controls> 
								<source src="http://link.hhtjim.com/xiami/3341658.mp3" type="audio/mp3">
							</audio>
							<p>
							<a class="more link" href="./comments.php?t=<?php echo $arr['id']?>#main">继续阅读 →</a></p>

						</div>
						<footer class="artfoot">
						<span class="cat-links">发表在<a class='link' href="main.php?c=<?php echo $class['id']?>"><?php echo $class['classname']?></a></span> |<!--标签有<a class='link' href="">琉璃神社壁纸包</a> |--><a href="./comments.php?t=<?php echo $arr['id']?>#com" class='link'><b><?php echo $cnum?></b>条回复</a>
						
						</footer>
					</article>
<?php
if(!empty($uresult)){
	mysqli_free_result($uresult);
}
if(!empty($cresult)){
	mysqli_free_result($cresult);
}
//每次循环结束之前释放结果集
}
  //释放结果集
if(!empty($result)){
	mysqli_free_result($result);
}

//	mysqli_close($con);
?>                  <!--分页-->
					<div id="page_nmb"><?php echo $page->fpage(array(4,5,6));?></div>
					
				</div>	
			</section>
			<!--侧栏-->
			<section id="secondary">
			<!--登陆-->
<?php
session_start();
if(isset($_SESSION['username']) && $_SESSION['username']!=''){
	$sql4="select * from user where username='{$_SESSION['username']}'";
	$result4=$con->query($sql4);
	//var_dump($result4);
	$me=$result4->fetch_assoc();
?>
		<aside id="" class="">
			<div>欢迎<a href="main.php?u=<?php echo $me['id']?>" class='link'><?php echo $me['nickname']?></a></div>
			<br>
			<button onclick="javascript:window.location.href='layout.php'" value="">退出登陆</button>
		</aside>	
<?php
//释放结果集
	$result4->free();
}else{

?>
			<aside id="" class=""><h3 class="widget-title">Login</h3>
			<form name="loginform" id="loginform" action="login.php" method="post">
			
			<p class="login-username">
				<label for="user_login">Username</label>
				<input type="text" name="name" id="user_login" class="input" value="" size="20" />
			</p>
			<p class="login-password">
				<label for="user_pass">Password</label>
				<input type="password" name="pwd" id="user_pass" class="input" value="" size="20" />
			</p>
			
			<p class="login-remember"><label><input name="rememberme" type="checkbox" id="rememberme" value="forever" checked="checked" /> Remember Me</label></p>
			<p class="login-submit">
				<input type="submit" name="wp-submit" id="wp-submit" class="button-primary" value="Login &rarr;" />
			</p>
			
			</form><a class='link'  href="">Lost Password</a>
			<a href="#" onclick='toQzoneLogin()'><img src="imgback/qq_login.png"></a>
			</aside>
<?php
}
?>
			<!--登陆模块结束-->
			<aside id="text-4" class="widget widget_text">	
			<div class="textwidget"><p>用户数据遗失，请不要尝试登入。</p>
			<p>小撸怡情，大撸伤身，强撸灰飞烟灭.</p>
			</div>
			</aside>
			<!--侧栏-评论-->
			<aside id="wkc_recent_comments-3" class="widget widget_wkc_recent_comments">
			<h3 class="widget-title">最新评论</h3>
			<!--每条评论放在一个li中-->
			<ul>
<?php
$sql="select * from cmts order by id desc limit 0,4";
$result=mysqli_query($con,$sql);
while($arr=mysqli_fetch_assoc($result)){
	$sql1="select * from user where id={$arr['uid']}";
	$uresult=mysqli_query($con,$sql1);
	$user=mysqli_fetch_assoc($uresult);
	//tieb表
	$sql2="select * from tieb where id={$arr['tid']}";
	$tresult=mysqli_query($con,$sql2);
	$article=mysqli_fetch_assoc($tresult);
?>
<li><a class="alignright" href="http://www.hacg.li/wp/19699.html#comment-21401" title="琉璃神社壁纸包 2016年2月号" ><img alt='' src='./userimg/<?php echo $user['userimg']?>' class='avatar avatar-50 photo' height='50' width='50' /></a>
<a class="commentor link" href="main.php?u=<?php echo $user['id']?>" ><?php echo $user['nickname']?></a>:<a class="comment_content link link" href="./comments.php?t=<?php echo $article['id']?>#main" title="" ><?php echo $article['title1'];?></a>
<?php 
	if(strlen($arr['comments'])>40){
		echo mb_substr($arr['comments'],0,40,'utf-8')."...";
	}else{
		echo $arr['comments'];
	}

?><div style="clear:both;"></div></li>
<?php
//循环结束释放结果集
if(!empty($uresult)){
	mysqli_free_result($uresult);
}
if(!empty($tresult)){
	mysqli_free_result($tresult);
}


}//while结束
  //释放结果集
if(!empty($result)){
	mysqli_free_result($result);
}
?>
			</ul>
			<!--侧栏-评论结束-->
			</aside>
			<!--侧栏-推荐-->
			<aside id="text-11" class="widget widget_text">	
			<div class="textwidget"><img src="http://www.hacg.lol/wp/t/sora/sora.jpg" style="width:188px;height:148px;"alt="" /><a  class='link' href="" target="_blank"><span  class='link' style="font-size: 12pt;">超赞的春日野穹，不送一个给妹妹吗？</span></a>

</div>
			</aside>
			<!--侧栏-推荐结束-->
			<!--侧栏-游戏点赞-->
			<aside id="ratings-widget-3" class="widget widget_ratings-widget">
			<h3 class="widget-title">游戏点赞榜</h3>
			<ul>
			<li><a class='link' href="" title="[ALICESOFT] rance 03 兰斯03  -里萨斯陷落- 重制版 汉化硬盘版">[ALICESOFT] rance 03 兰斯03  -里萨斯陷落- 重制版 汉化硬盘版</a>  连续12人5星推荐</li>
			</ul>
			</aside>
			<!--侧栏-游戏点赞-结束-->
			<!--侧栏-动画点赞-->
			<aside id="ratings-widget-2" class="widget widget_ratings-widget"><h3 class="widget-title">动画点赞榜</h3><ul>
			<li><a  class='link' href="http://www.hacg.li/wp/819.html" title="2015年11月各组作品合集">2015年11月各组作品合集</a>  连续19人5星推荐</li>
			</ul>
			</aside>
			<!--侧栏-动画点赞结束-->
			<!--侧栏-漫画点赞-->
			<aside id="ratings-widget-4" class="widget widget_ratings-widget">
			<h3 class="widget-title">漫画点赞榜</h3>
			<ul>
			<li><a  class='link' href="http://www.hacg.li/wp/61626.html" title="[立花オミナ] ボクは皆の管理人 我是大家的管理人 [1-6完结]">[立花オミナ] ボクは皆の管理人 我是大家的管理人 [1-6完结]</a>  连续7人5星推荐</li>
			</ul>
			</aside>
			<!--侧栏-漫画点赞-结束-->
			<!--侧栏广告-->
			<aside id="text-8" class="widget widget_text">
			<a target="_blank" href="http://t.cn/R47m01H"><img width="188" height="188" border="0" alt="双叶" src="http://img.alicdn.com/bao/uploaded/i1/TB1fqCKJFXXXXaUXpXXXXXXXXXX_!!0-item_pic.jpg_200x200.jpg"></a>
			</aside>
			
			<!--侧栏-随机文章-->
			<aside id="wkc_random_posts" class="widget widget_wkc_random_posts">
			<h3 class="widget-title">随机文章</h3>
			<ul>
			<li>   <a  class='link' href="http://www.hacg.li/wp/17614.html" rel="bookmark" title="这个动画第1集是上个月出的，不过由于封面不好看我一直没有去看，不过，这个月那么快就出第2集也是蛮拼的。然后，看了一下监督居然是雷火剣，欣赏了一下之后发现画风和封面完全不一样。
 故事主要是说2个百合JK魔法少女大战怪兽的故事，决定就是你了，妙蛙种子！使用触手捆绑！大致就是成为魔法少女大战触手怪，结局我也不剧透了，大家可以自己购买欣赏！ 魔獣浄化少女ウテア soul.2 ミズキ......  2016.01.10">[EDGE] 魔獣浄化少女ウテア(1-2) soul.2 ミズキの鏡</a></li>
			</aside>
			<!--侧栏-随机文章结束-->
		
			</section>
			<!--侧栏结束-->
			<div style="clear:both;"></div>
		</div>
<?php
	//关闭数据库
	mysqli_close($con);
	include 'footer.php'; 
?>
