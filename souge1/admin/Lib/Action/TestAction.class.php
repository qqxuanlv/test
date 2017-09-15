<?php
class TestAction extends Action{

	
	function product_sort(){
		$table=M('product_sort');
		$list=$table->select();
		print_r($list);
	}
	
}