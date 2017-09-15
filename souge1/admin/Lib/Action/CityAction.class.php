<?php
class CityAction extends CommonAction{

	function index(){
		
		$city=M('City');
		$list_city=$city->order('pid,level,orderby asc')->select();
		
		$this->assign('list',$list_city);
		
		
		
		$this->display();
	}
	
	function add(){
		
		
		$city=M('City');
		$list=$city->where('id=pid')->select();
		$this->assign('list',$list);
		
		
		$this->display();
		
	}
	
	function edit(){
		
		
		//获取列表
		$city=M('City');
		$list=$city->where('id=pid')->select();
		$this->assign('list',$list);
		
		//获取当前记录
		$show=$city->where("id='".$_GET['tid']."'")->find();
		//dump($show);
		$this->assign('show',$show);
		
		
		$this->display();
		
	}
	
	
	function editupdate(){
		
		$data=$_POST;
		//dump($data);
		//exit;
		if ($data['title']==''){
			$this->error('城市/县市名不能为空');
		}else{
			$city=M('City');
			if ($insertid=$city->data($data)->save()){
				
				$this->success('编辑成功');
			}else{
				$this->error('编辑失败');
			}
			
			
		}
		
		
	}
	
	function del(){
		$tid=$_GET['tid'];
		$city=M('City');
		if ($city->where("id=$tid")->delete()){
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		}
		
	}
	
	function addupdate(){
		
		$data=$_POST;
		//dump($data);
		//exit;
		if ($data['title']==''){
			$this->error('城市/县市名不能为空');
		}else{
			$city=M('City');
			if ($insertid=$city->data($data)->add()){
				if ($data['pid']=='0'){
				$city->where("id=$insertid")->data(array('pid'=>$insertid,'level'=>1))->save();
				}else{
				$city->where("id=$insertid")->data(array('level'=>2))->save();
				}
				$this->success('新增成功');
			}else{
				$this->error('新增失败');
			}
			
			
		}
		
		
	}
	

	
	

}