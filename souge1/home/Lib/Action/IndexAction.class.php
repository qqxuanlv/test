<?php
class IndexAction extends CommonAction {
	function index(){
		echo 'i am a girl';
		$a='woshi xuanlv';
		$this->assign('a',$a);
		$this->display();
	}

}	