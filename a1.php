<?php
 if(!empty($_POST["txt"]))
 {	echo gettype($_POST("text"));
	$sHttp ="fanyi.youdao.com/openapi.do?keyfrom=ss-231s2&key=1120508286&type=data&doctype=text&version=1.0&q=".$_GET("text");
	$s=file_get_contents($sHttp);

 }


?>
<form action="" method="POST">
<input type="text"  name="txt"/><label><?php echo $s?></label>
<input type="submit" value="Ìá½»"/>
</form>