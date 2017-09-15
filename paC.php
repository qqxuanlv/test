<?php

function pc(){


$html = file_get_contents('http://www.youku.com/');

$selectStr='<li><a href="http://news.youku.com/" ';
$selectStr1='<li><a href="http://game.youku.com/" ';
$indexStart= strpos($html,$selectStr);
$indexEnd= strpos($html,$selectStr1);

$text=substr($html,$indexStart,1350);
echo $text;

}

function pc1(){
	$html = file_get_contents("http://www.youku.com/v_olist/c_100_a_日本_s_1_d_1_r_2016.html");
	$selectStr='<!-- 筛选结果 -->';
	$selectStr1=' evt.keyCode;//获取按键值';
	$indexStart= strpos($html,$selectStr);
	$indexEnd= strpos($html,$selectStr1);
	$indexStart=$indexStart-1;
	$indexEnd-=100;

	$text=substr($html,$indexStart,$indexEnd-$indexStart-38);
	echo $text;
	
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
	
	
$myfile = fopen("v_olist/c_100_g__a_日本_sg__mt__lg__q__s_1_r_2016_u_0_pt_0_av_0_ag_0_sg__pr__h__d_1_p_2.html", "w") or die("Unable to open file!");
$txt = $text;
fwrite($myfile, $txt);


fclose($myfile);

	
	
	
}




 ?>




