<?php
class ProductSortModel extends Model{
	
		protected $_auto=array(
			array('path','tclm',3,'callback'),
		);
		
		
		function tclm(){
			//查询方法要记住不用  $this->where
			//$pid=isset($_POST['pid'])?(int)$_POST['pid']:0;
			$pid=$_POST['pid'];
			//echo $pid.'fdafdafds';
			//exit;
			//echo 'tclm';
			if($pid){
				
			}else{
				return 0;
				
			}
			//echo $pid;
			//select 是一个二级数组,请大家切记，如果你是二维数组的话，请查看数组结构再往下做
			
			
			//echo $this->getLastSql();
			//exit;
			$list=$this->where("id=$pid")->find();
			
			$data=$list['path'].'-'.$list['id'];
			//dump($data);
			return $data;
		}
		
		

	
}