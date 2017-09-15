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
﻿        
	<link rel="stylesheet" href="__PUBLIC__/kindeditor-4.1.1/themes/default/default.css" />
	<link rel="stylesheet" href="__PUBLIC__/kindeditor-4.1.1/plugins/code/prettify.css" />
	<script charset="utf-8" src="__PUBLIC__/kindeditor-4.1.1/kindeditor.js"></script>
	<script charset="utf-8" src="__PUBLIC__/kindeditor-4.1.1/lang/zh_CN.js"></script>
	<script charset="utf-8" src="__PUBLIC__/kindeditor-4.1.1/plugins/code/prettify.js"></script>
	<script>
		KindEditor.ready(function(K) {
			var editor1 = K.create('textarea[name="content"]', {
				cssPath : '__PUBLIC__/kindeditor-4.1.1/plugins/code/prettify.css',
				uploadJson : '__PUBLIC__/kindeditor-4.1.1/php/upload_json.php',
				fileManagerJson : '__PUBLIC__/kindeditor-4.1.1/php/file_manager_json.php',
				allowFileManager : true,
				afterCreate : function() {
					var self = this;
					K.ctrl(document, 13, function() {
						self.sync();
						K('form[name=example]')[0].submit();
					});
					K.ctrl(self.edit.doc, 13, function() {
						self.sync();
						K('form[name=example]')[0].submit();
					});
				}
			});
			prettyPrint();
		});
	</script>
<div id="contentBox">
<form action="<?php echo U('update');?>" method="post"  name="example" enctype="multipart/form-data">
<input name="id" type="hidden" value="<?php echo ($show['id']); ?>" />
<table width="100%" border="0" cellpadding="0" cellspacing="0" id="contentTable" class="table table-hover">
  <tr>
    <th>请选择类别</th>
    <td><select name="sortid" id="sortid">
      <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['id']); ?>" <?php if(($vo['id']) == $show['sortid']): ?>selected="selected"<?php endif; ?> ><?php echo ($vo['title']); ?></option>
          <?php if(is_array($vo['_child'])): $i = 0; $__LIST__ = $vo['_child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo2['id']); ?>" <?php if(($vo2['id']) == $show['sortid']): ?>selected="selected"<?php endif; ?> > &nbsp;&nbsp; <?php echo ($vo2['title']); ?></option>
              <?php if(is_array($vo2['_child'])): $i = 0; $__LIST__ = $vo2['_child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo3): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo3['id']); ?>" <?php if(($vo3['id']) == $show['sortid']): ?>selected="selected"<?php endif; ?> > &nbsp;&nbsp;&nbsp;&nbsp; <?php echo ($vo3['title']); ?></option><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
    </select></td>
    <td class="td3">&nbsp;</td>
  </tr>
  <tr>
    <th>标题<span class="red">*</span></th>
    <td><input name="title" type="text" id="title"  value="<?php echo ($show['title']); ?>" size="80" /></td>
    <td class="td3">&nbsp;</td>
  </tr>
  <tr>
    <th>标题图片</th>
    <td><input name="photo" type="file" id="photo"  size="80" /></td>
    <td class="td3">&nbsp;</td>
  </tr>

 <!--  <tr>
    <th>附件</th>
    <td><input type="file" name="filename2" /><br />
<a href="__UPLOADS__/news/<?php echo ($show['fujian']); ?>" target="_blank"><?php echo ($show['fujian']); ?></a></td>
    <td>&nbsp;</td>
  </tr> -->
  <tr>
    <th>内容<span class="red">*</span></th>
    <td>
    
		<textarea name="content" style="width:700px;height:200px;visibility:hidden;"><?php echo (stripslashes($show['content'])); ?></textarea></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th>简介</th>
    <td><label>
      <textarea name="description" cols="80" rows="6" id="description"><?php echo ($show['description']); ?></textarea>
    </label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th>排序</th>
    <td><label>
      <input name="orderby" id="orderby" value="<?php echo ($show['orderby']); ?>" />
    </label></td>
    <td>&nbsp;总左往右依次 1-6 </td>
  </tr>
   <tr>
    <th>是否首页</th>
    <td><label>
     <select name="is_first" id="is_first">
      <option value="0" <?php if(($show['is_first']) == "0"): ?>selected="selected"<?php endif; ?> >否</option>
      <option value="1" <?php if(($show['is_first']) == "1"): ?>selected="selected"<?php endif; ?> >是</option>
    </select>
    </label></td>
    <td>&nbsp;</td>
  </tr>
<!--     <tr>
    <th>是否热点</th>
    <td><label>
     <select name="is_hot" id="is_hot">
      <option value="0" <?php if(($show['is_hot']) == "0"): ?>selected="selected"<?php endif; ?> >否</option>
      <option value="1" <?php if(($show['is_hot']) == "1"): ?>selected="selected"<?php endif; ?> >是</option>
    </select>
    </label></td>
    <td>&nbsp;</td>
  </tr>
     <tr>
    <th>是否幻灯片</th>
    <td><label>
     <select name="is_huan" id="is_huan">
      <option value="0" <?php if(($show['is_huan']) == "0"): ?>selected="selected"<?php endif; ?> >否</option>
      <option value="1" <?php if(($show['is_huan']) == "1"): ?>selected="selected"<?php endif; ?> >是</option>
    </select>
    </label></td>
    <td>&nbsp;</td>
  </tr>-->
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="button" class="btn1" value="提 交" />(提交快捷键: Ctrl + Enter)</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>

</div>



	</td>
  </tr>
</table>
</body>
</html>