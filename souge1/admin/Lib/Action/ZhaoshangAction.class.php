<?php
class ZhaoshangAction extends CommonAction{

	
	function index(){
		import('@.ORG.Util.Page');
		$content=M('Content');
		$totalRows=$content->count();
		$page=new Page($totalRows,10);
		$page->setConfig('theme','%totalRow% %header% %upPage% %linkPage% %downPage%');
		$show=$page->show();
		$info=$content->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('info',$info);
		$this->assign('page',$show);
		$this->display();
	}
	function add(){
		$this->display();
		}
	function addupdate(){
		$table=M('Content');
		$data['content']=str_replace("./Uploads/kind/","__ROOT__/Uploads/kind/",$_POST['content1']);
		$data['language']=$_POST['language'];
		$data['title']=$_POST['title'];
		$data['jbid']=$_POST['jbid'];
		$data['addtime']=time();
		$add=$table->add($data);
		if($add){
			$this->success("添加成功");
			}else{
				$this->error("添加失败");
				}
		}
	function edit(){
		$id=$_GET['tid'];
		$content=M('Content');
		$info=$content->where('id='.$id)->find();
		$this->assign('info',$info);
		$this->display();
		}
	function editupdate(){
		$table=M('Content');
		$id=$_POST['id'];
		$data['content']=str_replace("./Uploads/kind/","__ROOT__/Uploads/kind/",$_POST['content1']);
		$data['language']=$_POST['language'];
		$data['jbid']=$_POST['jbid'];
		$data['title']=$_POST['title'];
		$edit=$table->where("id=".$id)->save($data);
		if($edit){
			$this->success("编辑成功");
			}else{
				$this->error("编辑失败");
				}
		}
	function del(){
		$id=$_GET['tid'];
		$content=M('Content');
		$del=$content->where("id=".$id)->delete();
		if($del){
			$this->success("删除成功");
			}else{
				$this->error("删除失败");
				}
		
		}
	
}