<?php
// 用户登录页面
class NewsAction extends CommonAction {
	function index(){
		$new=M("News");
		$this->display();
	}
	function show(){
		$new=M("News");
		$id=$_GET['id'];
		$info=$new->where("id=$id")->find();
		$this->assign("info",$info);
		$this->display();
	}


}	