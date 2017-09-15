<?php
class SysAction extends CommonAction{
	
	public function index(){		
		$this->display();
		
	}
	
	function node(){
		$this->_all_node();
		$this->display();
		
	}
	
	function node_action(){
		$id=$_POST['id'];
		$table=M('sys_node');
		$table->create();
		if($id){
			$table->save();
			
		}else{
			
			$pid=$_POST['pid'];
			if($pid==APP_ID){
				$table->level=2;				
			}else{
				$table->level=3;				
			}
			
			$table->add();
		}
		//echo $table->getLastSql();
		//print_r($table);
		$this->success('操作成功');
		
	}
	function nodedel(){
		$table=M('sys_node');
		$table->where(array('id'=>$_GET['id']))->delete();
		$table->where(array('pid'=>$_GET['id']))->delete();
		$this->success('操作成功');
	}
	
	
	function user(){
		
		$table=M('sys_user');
		$list=$table->select();
		$this->assign('list',$list);
		$this->display();
	}
	
	function reset(){
		$id=$_GET['tid'];
		$table=M('sys_user');
		$salt=$this->create_rand(5);
		
		$table->where(array('uid'=>$id))->data(array('password'=>md5('Aa123456')))->save();
		
		$sql="UPDATE __TABLE__ SET `salt`='$salt',`password`=md5(concat(md5('Aa123456'),'$salt')) WHERE `uid`=$id";
		$table->query($sql);
		//echo $table->getLastSql();
		
		
		
		$this->success('密码已成功恢复成Aa123456');
		
	}

	
	
	protected function _all_node(){
		$table=M('sys_node');
		$list=$table->where(array('pid'=>1))->order('orderby,id')->select();
		foreach ($list as $k=>$v){
			$list[$k]['_child']=$table->where(array('pid'=>$v['id']))->select();			
		}
		$this->assign('_all_node',$list);
		
		return $list;
	}
	
	
	
	
	//分配权限
	function competence(){
		$id=$_GET['tid'];
		$table=M('sys_node');
		$list=$table->where(array('pid'=>APP_ID))->order('orderby,id')->select();
		$table2=M('sys_user_access');
		foreach ($list as $k=>$v){			
			$list[$k]['_access']=$table2->where(array('user_id'=>$id,'node_id'=>$v['id']))->count();
			$list[$k]['_child']=$table->where(array('pid'=>$v['id']))->select();
			foreach ($list[$k]['_child'] as $k2=>$v2){
				
				$list[$k]['_child'][$k2]['_access']=$table2->where(array('user_id'=>$id,'node_id'=>$v2['id']))->count();
			}
		}
		$this->assign('_all_node',$list);
		
		//先给他分配项目权限
		$table=M('sys_user_access');
		$vo=$table->where(array('user_id'=>$id,'node_id'=>APP_ID))->count();
		if(empty($vo)){
			$table->data(array('user_id'=>$id,'node_id'=>APP_ID))->add();
		}
		
		//print_r($list);
		
		
		$this->display();
	
	}
	
	//分配权限AJAX操作
	function competence_user_ajax(){
		$user_id=$_POST['uid'];
		$node_id=$_POST['id'];
		$action=$_POST['action'];
		$table=M('sys_user_access');
		if($action=='add'){
			$table->data(array('user_id'=>$user_id,'node_id'=>$node_id))->add();
			 
		}else{
			$table->where(array('user_id'=>$user_id,'node_id'=>$node_id))->delete();
		}
		//print_r($_POST);
		//echo $table->getLastSql();
		
	}
	function gps(){
		$menu=M('SysMenu');
		$list=$menu->select();
		$this->assign('list',$list);
		$tid=$_GET['tid'];
		$show=$menu->where("id='".$tid."'")->find();
		$this->assign('show',$show);
		$this->display();
		}
	function gpsupdate(){
		$sort=M('SysMenu');
		$data=$_POST;
		if ($data['id']){
			$data['link']=stripslashes($data['link']);
			$sort->data($data)->save();
			$this->success('修改成功');
		}else{
			$data['link']=stripslashes($data['link']);
			$sort->data($data)->add();
			$this->success('新增成功');
		}
	}
	function gpsdel(){
	
		$tid=$_GET['tid'];
		$news=M('SysMenu');
			if ($news->where("id='".$tid."'")->delete()){

				$this->success('删除成功');
			}else{
				$this->error('删除失败');
			}

	}	

}
	



?>