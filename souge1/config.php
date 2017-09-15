<?php
// 示例的全局数据库配置文件
return array(
    
    'DB_TYPE'=>'mysql',
    'DB_HOST'=>'localhost',
    'DB_NAME'=>'wangyuanjing',
    'DB_USER'=>'root',
    'DB_PWD'=>'',
    'DB_PORT'=>'3306',
    'DB_PREFIX'=>'smart_',
	'USER_AUTH_KEY'=>'authId',	// 用户认证SESSION标记
	'URL_MODEL'=>0,

	
	//'URL_PATHINFO_DEPR'=>'-',
	//'URL_HTML_SUFFIX'=>'.html',
	
	'TMPL_PARSE_STRING'  =>array(
	
	     '__UPLOADS__' => __ROOT__.'/Uploads', 
	     '__INDEX__' => __ROOT__.'/Public/index', 
	     '__ICO__' => __ROOT__.'/Public/ico', 
	
	
	
	)
	
);
?>