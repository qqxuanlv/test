<?php
$array= array(
	//'配置项'=>'配置值'
	'URL_ROUTER_ON'=>true,						//开启路由规则
	'URL_ROUTE_RULES'=>include 'routes.php',
	
	//'COOKIE_DOMAIN'=>$_SERVER['HTTP_HOST'],        // Cookie有效域名
	//'COOKIE_DOMAIN'=>'127.0.0.1',        // Cookie有效域名
	'COOKIE_PATH'=>'/',							// Cookie路径
	'COOKIE_EXPIRE'=>'86400',				// Cookie有效期
	'COOKIE_PREFIX'=>'chuangti_',
	'TOKEN_ON'=>false,  // 是否开启令牌验证
	'URL_HTML_SUFFIX'=>'.html',
	//'TMPL_ACTION_ERROR'     => 'Public:error',
	'TMPL_ACTION_ERROR'		=>	'Public:_public_jump',			// 默认错误跳转对应的模板文件
	'TMPL_ACTION_SUCCESS'	=>	'Public:_public_jump',			// 默认成功跳转对应的模板文件
    'DEFAULT_THEME'=>'default',
	'TMPL_DETECT_THEME' => true, // 自动侦测模板主题
	   
	   
	    'LANG_SWITCH_ON' 	=> 	true,
        'DEFAULT_LANG' 		=> 	'zh-cn', // 默认语言
        'LANG_AUTO_DETECT' 	=> 	true, // 自动侦测语言
        'LANG_LIST'			=>	'en-us,zh-cn  '//必须写可允许的语言列表

	
);


$config=include './config.php';


return array_merge($config,$array);

?>