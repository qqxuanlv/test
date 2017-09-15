<?php
class OnlineAction extends CommonAction{
	function index(){
		$online=M('Online');
		import('@.ORG.Util.Page');
		$totalRows=$online->count();
		$page=new Page($totalRows,10);
		$page->setConfig('theme','%totalRow% %header% %upPage% %linkPage% %downPage%');
		$show=$page->show();
		$list=$online->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign('list',$list);
		$this->assign('page',$show);
		$this->display();
	}
	function edit(){
		$online=M('Online');
		$id=$_GET['tid'];
		$list=$online->where('id='.$id)->find();
		$this->assign('show',$list);
		$this->display();
		}
	function update(){
		$online=M('Online');
	    $data['id']=$_POST['id'];
		$data['replay']=$_POST['content'];
		$data['reptime']=time();
		$data['is_show']=$_POST['is_show'];
		$online->data($data)->save();
		$this->success('修改成功');
	}
	function del(){
	
		$tid=$_GET['tid'];
		$online=M('Online');
			if ($online->where("id='".$tid."'")->delete()){
				$this->success('删除成功');
			}else{
				$this->error('删除失败');
			}

	}

}