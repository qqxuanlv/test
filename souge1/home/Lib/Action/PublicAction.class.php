<?php
// 用户登录页面
class PublicAction extends CommonAction {
	


	function ajax_city(){
		$pid=$_GET['id'];
		$table=M('basic_city');
		$list=$table->where(array('pid'=>$pid))->select();
		foreach($list as $v){
			$str.='<option value="'.$v['id'].'">'.$v['title'].'</option>';
		}
		echo $str;
		
	}

  function verify(){
		$type	 =	 isset($_GET['type'])?$_GET['type']:'gif';
        import("@.ORG.Util.Image");
        Image::buildImageVerify(4,1,$type);
    }


}	