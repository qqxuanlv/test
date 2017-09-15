<?php
/******************************************************************
* PHP截取UTF-8字符串，解决半字符问题。
* 英文、数字（半角）为1字节（8位），中文（全角）为3字节
* @return 取出的字符串, 当$len小于等于0时, 会返回整个字符串
* @param $str 源字符串
* $len 左边的子串的长度
****************************************************************/
function utf_substr($str,$len){
	for($i=0;$i<$len;$i++)
	{
	$temp_str=substr($str,0,1);
	if(ord($temp_str) > 127){
	$i++;
	if($i<$len)	{
	$new_str[]=substr($str,0,3);
	$str=substr($str,3);	}
	}else{
	$new_str[]=substr($str,0,1);
	$str=substr($str,1);
	}
	}
}


/***********************得到真实IP地址*************************/
function get_real_ip(){
	$ip=false;
	if(!empty($_SERVER["HTTP_CLIENT_IP"])){
	$ip = $_SERVER["HTTP_CLIENT_IP"];
	}
	if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	$ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
	if ($ip) { array_unshift($ips, $ip); $ip = FALSE; }
		for ($i = 0; $i < count($ips); $i++) {
			if (!eregi ("^(10|172\.16|192\.168)\.", $ips[$i])) {
			$ip = $ips[$i];
			break;
			}
		}
	}
	return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
}
//过滤
function pregstring( $str ){  
		$strtemp = trim($str); 
		$search = array( 
		 "|'|Uis",  
		 "|<script[^>]*?>.*?</script>|Uis", // 去掉 javascript  
		 "|<[\/\!]*?[^<>]*?>|Uis", // 去掉 HTML 标记  
		 "'>(quot|#34);'i", // 替换 HTML 实体  
		 "'>(amp|#38);'i", 
		 "|,|Uis",  
		 "|[\s]{2,}|is",  
		 "[>nbsp;]isu", 
		 "|[$]|Uis",  
		 );  
		 $replace = array( 
		 "`",  
		 "", 
		 "", 
		 "", 
		 "", 
		 "", 
		" ",  
		" ", 
		 " dollar ",  
		 ); 
		$text = preg_replace($search, $replace, $strtemp); 
		 return $text; 
 } 
 //字符串截取
//$string:字符 ;$length:截取的长度;$dot:后面所加的字符

function utf8substr($string, $length, $dot = '...') 
{ $charset='utf-8'; 
if(strlen($string) <=$length) 
{ 
$dot =""; 
return $string;
} 
$string = str_replace(array('&amp;', '&quot;', '&lt;', '&gt;'), array('&', '"', '<', '>'), $string); 
$strcut = '';
if(strtolower($charset) == 'utf-8') 
{ $n = $tn = $noc = 0;
while($n < strlen($string))
{
	$t = ord($string[$n]); 
if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) 
{ 
	$tn = 1; $n++; $noc++; 
	} 
elseif(194 <= $t && $t <= 223) 
   { 
	$tn = 2; $n += 2; $noc += 2;
	}
elseif(224 <= $t && $t < 239)
	{ 
	$tn = 3; $n += 3; $noc += 2;
	} 
elseif(240 <= $t && $t <= 247)
	{ 
	$tn = 4; $n += 4; $noc += 2; 
	} 
elseif(248 <= $t && $t <= 251)
	{ 
	$tn = 5; $n += 5; $noc += 2;
	} 
elseif($t == 252 || $t == 253) 
	{ 
	$tn = 6; $n += 6; $noc += 2;
	} 
else 
	{
	$n++;
	} 
if($noc >= $length)
	{ 
	break;
	}
} 
if($noc > $length) 
	{ 
	$n -= $tn;
	} 
$strcut = substr($string, 0, $n);
}
else { 
	for($i = 0; $i < $length; $i++) 
	   { 
		$strcut .= ord($string[$i]) > 127 ? $string[$i].$string[++$i] : $string[$i];
		}
	} 
	$strcut = str_replace(array('&', '"', '< ', '>'), array('&amp;', '&quot;', '&lt;', '&gt;'), $strcut); 
	return $strcut.$dot;
	} 
