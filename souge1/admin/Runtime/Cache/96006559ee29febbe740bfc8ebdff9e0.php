<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($navinfo['title']); ?></title>
    <link href="__PUBLIC__/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="__PUBLIC__/bootstrap/css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
    <script language="javascript" src="__PUBLIC__/index/js/jquery-1.4.1.min.js"></script>
    <script language="javascript" src="__PUBLIC__/bootstrap/js/bootstrap.min.js"></script>
<link href="__PUBLIC__/admin/css/Main.css" rel="stylesheet" type="text/css" />
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="159" valign="top"><img src="__PUBLIC__/admin/images/a.cms_1.jpg" width="159" height="89" alt="" /></td>
    <td valign="top">

<div id="menu">
<div id="left">
<ul id="menuList">

<?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i; if(($navinfo['name']) == $item['name']): ?><li class="link1"><?php else: ?><li class="link2"><?php endif; ?>
	<a href="<?php echo U($item['name'].'/index');?>"><?php echo ($item['title']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>

</ul>
</div>	
<div id="right">您好, <strong><?php echo ($_SESSION['username']); ?></strong> [ <a href="<?php echo U('Public/logout');?>">登出</a> ]</div>	
</div>

<div id="clear"></div>

<div class="here" align="right">
&nbsp;
</div>


	</td>
  </tr>
  <tr>
    <td valign="top">
<div><IMG SRC="__PUBLIC__/admin/images/a.cms_8.jpg" WIDTH=159 HEIGHT=15 ALT=""></div>
<ul id="leftMenu">
<?php if(is_array($menu2)): foreach($menu2 as $key=>$item): ?><li class="li2 "><a href="<?php echo U($item['name']);?>"><?php echo ($item['title']); ?></a></li><?php endforeach; endif; ?>
</ul>



	</td>
    <td valign="top">
<div class="top1"><IMG SRC="__PUBLIC__/admin/images/a.cms_9.jpg" WIDTH=8 HEIGHT=15 ALT=""></div>
<div id="contentBox">
<div class="title1">搜索</div>
<form action="<?php echo U();?>" method="get">
<input type="hidden" value="<?php echo ACTION_NAME;?>" name="a" />
<input type="hidden" value="<?php echo MODULE_NAME;?>" name="m" />
<table border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td>模块标题</td>
    <td><label>
      <input name="keyword" type="text" id="keyword" value="<?php echo ($_GET['keyword']); ?>" />
    </label></td>
    <td><label>
      <input type="submit" value="提交" />
    </label></td>
  </tr>
</table>
</form>

 <div class="page">
<?php echo ($page); ?>
</div>
<table width="100%" border="0" cellpadding="0" cellspacing="0" id="contentTable" class="table table-hover">
  <tr>
    <th>ID</th>
    <th>类别</th>
    <th>标题</th>
    <th>添加时间</th>
    <th>排序</th>
    <th width="100">操作</th>
  </tr>
  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><tr>
    <td><?php echo ($item['id']); ?></td>
    <td><a href="<?php echo U('index',array('sortid'=>$item['sortid']));?>"><?php echo ($item['newssort']); ?></a>&nbsp;</td>
    <td><?php echo ($item['title']); ?></td>
    <td><?php echo (date('Y-m-d H:m:s',$item['addtime'])); ?></td>
    <td><?php echo ($item['orderby']); ?></td>
    <td width="100">
	<a href="<?php echo U('edit',array('tid'=>$item['id']));?>">编辑</a>
	|
	<a href="<?php echo U('del',array('tid'=>$item['id']));?>">删除</a>	</td>
  </tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
<div class="page">
<?php echo ($page); ?>
</div>
</div>


	</td>
  </tr>
</table>
</body>
</html>