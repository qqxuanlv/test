<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站管理系统 - Website Control Panel</title>
<link rel="stylesheet" href="__PUBLIC__/admin/css/login.css" type="text/css" media="all" />
</head>
<body>


<div class="container">

	<form action="<?php echo U('checklogin');?>" method="post" id="loginform" target="_top">
		<table class="mainbox">
			<tr>
				<td class="loginbox">
					<h1>网站管理系统</h1>
					<p>定制型企业商城解决方案</p>
				</td>
				<td class="login">
										<p>&nbsp;</p>
					<p id="usernamediv">用户名:<input type="text" name="username" class="txt" id="username" value="" tabindex="1" /></p>
					<p>密　码:<input type="password" name="password" class="txt" id="password" value="" tabindex="1" /></p>
					<p align="left">验证码:<input type="text" name="verify" class="txt" tabindex="1" id="seccode" value="" style="margin-right:5px;width:85px;" /><img style="cursor:hand;cursor:pointer" id="verifyImg" SRC="<?php echo U('verify');?>" onclick="this.src='<?php echo U('verify');?>&'+Math.random()" ALT="点击刷新验证码" BORDER="0" /></p>
					<p class="loginbtn"><input type="submit" name="submit" value="登 录" class="btn" tabindex="1" /></p>
				</td>
			</tr>
		</table>
	</form>
</div>

<div class="footer">Version 2013.06.14 - Copyrigh &copy; 2012 - 2015 <?php echo ($_SERVER['SERVER_NAME']); ?> All rights reserved</div>

</body>
</html>