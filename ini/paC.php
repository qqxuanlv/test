<?php
header("Content-type: text/html; charset=utf-8");
/*function pc(){


$html = file_get_contents('http://www.youku.com/');

$selectStr='<li><a href="http://news.youku.com/" ';
$selectStr1='<li><a href="http://game.youku.com/" ';
$indexStart= strpos($html,$selectStr);
$indexEnd= strpos($html,$selectStr1);

$text=substr($html,$indexStart,1350);


}*/
function s3(){echo "1111";}
function pc1(){
	$html = file_get_contents("http://www.youku.com/v_olist/c_100_a_日本_s_1_d_1_r_2016.html");
	$selectStr='<!-- 筛选结果 -->';
	$selectStr1=' evt.keyCode;//获取按键值';
	$indexStart= strpos($html,$selectStr);
	$indexEnd= strpos($html,$selectStr1);
	$indexStart=$indexStart-1;
	$indexEnd-=100;
	$text=substr($html,$indexStart,$indexEnd-$indexStart-38);
	$str="v_olist/c_100_g__a_日本_sg__mt__lg__q__s_1_r_2016_u_0_pt_0_av_0_ag_0_sg__pr__h__d_1_p_1.html";
	$str1=iconv("UTF-8","gbk",$str);
	$txt =iconv("UTF-8","gbk",$text);
	$myfile = fopen($str1, "w") or die("Unable to open file!");
	$strCS='<script type="text/javascript" src="js/jquery.min.js"></script>
			<link href="http://static.youku.com/v1.0.124/index/css/yk.css" type="text/css" rel="stylesheet" />
			<link href="http://static.youku.com/v1.0.124/v/css/filter.css" type="text/css" rel="stylesheet" />
			<style type="text/css" >
			ul{list-style:none;}
			li{float:left; margin-left:10px;}
			#head{width:60%; margin-left:auto; margin-right:auto;}
			</style>';
	fwrite($myfile,$strCS);
	fwrite($myfile, $txt);
	fclose($myfile);
}
function pc2(){
	
	$html = file_get_contents("http://www.youku.com/v_olist/c_100_g__a_日本_sg__mt__lg__q__s_1_r_2016_u_0_pt_0_av_0_ag_0_sg__pr__h__d_1_p_2.html");
	$selectStr='<!-- 筛选结果 -->';
	$selectStr1=' evt.keyCode;//获取按键值';
	$indexStart= strpos($html,$selectStr);
	$indexEnd= strpos($html,$selectStr1);
	$indexStart=$indexStart-1;
	$indexEnd-=100;
	$text=substr($html,$indexStart,$indexEnd-$indexStart-38);
	$str="v_olist/c_100_g__a_日本_sg__mt__lg__q__s_1_r_2016_u_0_pt_0_av_0_ag_0_sg__pr__h__d_1_p_2.html";
	$str1=iconv("UTF-8","gbk",$str);
	$txt =iconv("UTF-8","gbk",$text);
	$myfile = fopen($str1, "w") or die("Unable to open file!");
	$strCS='<script type="text/javascript" src="js/jquery.min.js"></script>
			<link href="http://static.youku.com/v1.0.124/index/css/yk.css" type="text/css" rel="stylesheet" />
			<link href="http://static.youku.com/v1.0.124/v/css/filter.css" type="text/css" rel="stylesheet" />
			<style type="text/css" >
			ul{list-style:none;}
			li{float:left; margin-left:10px;}
			#head{width:60%; margin-left:auto; margin-right:auto;}
			</style>';
	fwrite($myfile,$strCS);
	fwrite($myfile, $txt);
	fclose($myfile);
}
function pc3(){
	
	$html = file_get_contents("http://www.youku.com/v_olist/c_100_g__a_%E6%97%A5%E6%9C%AC_sg__mt__lg__q__s_1_r_2016_u_0_pt_0_av_0_ag_0_sg__pr__h__d_1_p_3.html");
	$selectStr='<!-- 筛选结果 -->';
	$selectStr1=' evt.keyCode;//获取按键值';
	$indexStart= strpos($html,$selectStr);
	$indexEnd= strpos($html,$selectStr1);
	$indexStart=$indexStart-1;
	$indexEnd-=100;
	$text=substr($html,$indexStart,$indexEnd-$indexStart-38);
	echo "<script>alert(3);</script>";
	$str="v_olist/c_100_g__a_日本_sg__mt__lg__q__s_1_r_2016_u_0_pt_0_av_0_ag_0_sg__pr__h__d_1_p_3.html";
	$str1=iconv("UTF-8","gbk",$str);
	$txt =iconv("UTF-8","gbk",$text);
	$myfile = fopen($str1, "w") or die("Unable to open file!");
	$strCS='<script type="text/javascript" src="js/jquery.min.js"></script>
			<link href="http://static.youku.com/v1.0.124/index/css/yk.css" type="text/css" rel="stylesheet" />
			<link href="http://static.youku.com/v1.0.124/v/css/filter.css" type="text/css" rel="stylesheet" />
			<style type="text/css" >
			ul{list-style:none;}
			li{float:left; margin-left:10px;}
			#head{width:60%; margin-left:auto; margin-right:auto;}
			</style>';
	fwrite($myfile,$strCS);
	fwrite($myfile, $txt);

	fclose($myfile);
}
pc1();
pc2();
pc3();


 ?>




