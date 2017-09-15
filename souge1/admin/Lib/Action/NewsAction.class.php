<?php
class NewsAction extends CommonAction{



	function index(){
		
		
		import('@.ORG.Util.Page');
		
		//新闻列表
		$getsortid=$_GET['sortid'];
		if($getsortid){
			$sql1=" AND sortid='".$getsortid."'";
		}
		$keyword=$_GET['keyword'];
		if ($keyword){
			$sql1=" AND (title like '%".$keyword."%')";
		}
		$news=D('News');
		
		$totalRows=$news->where('1=1'.$sql1)->count();
		$page=new Page($totalRows,30);
		$page->setConfig('theme','%totalRow% %header% %upPage% %linkPage% %downPage%');
		$show=$page->show();
		$list=$news->relation(true)->where('1=1'.$sql1)->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
		
		$this->assign('list',$list);
		$this->assign('page',$show);
		
		$this->display();
	}
	

//旧新闻分类	
//	function sort(){
//		
//		
//		//新闻列表
//		$sort=M('NewsSort');
//		$list=$sort->select();
//		$list=$this->toTree($list);
//		//print_r($list);
//		$this->assign('list',$list);
//		
//		
//		$tid=$_GET['tid'];
//		$show=$sort->where("id='".$tid."'")->find();
//		$this->assign('show',$show);
//		
//		$this->display();
//	}

//分类带子类
	function sort(){
		
		$productsort=D('NewsSort');
		$list=$productsort->select();
		//dump($list);
		$newlist=$this->toTree($list);
		//dump($newlist);
		
//			$list=$productsort->where("typeid='".$typeid."'")->field("id,title,pid,path,concat(path,'-',id) as bpath")->order('bpath,orderby')->select();
//			//echo $productsort->getLastSql();
//			foreach($list as $key=>$value){
//				$list[$key]['count']=count(explode('-',$value['bpath']));
//			}
		$this->assign('list',$newlist);
		
		$tid=$_GET['tid'];
		$show=$productsort->where("id='".$tid."'")->find();
		$this->assign('show',$show);
		$this->display();
	}
	
	function sortupdate(){
		$sort=M('NewsSort');
		$data=$_POST;
		if ($data['id']){
			$sort->data($data)->save();
			$this->success('修改成功');
		}else{
			$sort->data($data)->add();
			$this->success('新增成功');
		}
	}
	
	function edit(){
		
		
		//新闻类别列表
		$sort=D('NewsSort');
		$list=$sort->select();
		//dump($list);
		$list=$this->toTree($list);
		//dump($list);
		$this->assign('list',$list);
		
		$news=M('News');
		$show=$news->where("id='".$_GET['tid']."'")->find();
		$this->assign('show',$show);
		
		//echo $news->getLastSql();
		//dump($show);
		
		$this->display();
		
	}
	
	
	
	function update(){
		
		//print_r($_POST['content']);
		//exit;
		$data=$_POST;
		
		import("@.ORG.Net.UploadFile");
		$upload = new UploadFile();// 实例化上传类
		$upload->maxSize  = 314572800 ;// 设置附件上传大小
		$upload->allowExts  = array('png','jpg','gif','jpeg');// 设置附件上传类型
		$upload->hashType	='md5_file';
		
		$upload->savePath =  './Uploads/news/';// 设置附件上传目录
		$upload->saveRule = "uniqid";
		$upload->thumb = false;
		$upload->thumbPrefix = 'thumb_50_,thumb_150_,thumb_300_';
		$upload->thumbPath = './Uploads/news/thumb/';
		$upload->thumbMaxWidth = '50,150,300';
		$upload->thumbMaxHeight = '50,150,300';
		
		if(!$upload->upload()) {// 上传错误提示错误信息
			//$this->error($upload->getErrorMsg());
		}else{// 上传成功 获取上传文件信息
			$info =  $upload->getUploadFileInfo();
		}
		
		if($info[0]["savename"]){
			$data['photo'] = $info[0]["savename"];
		}


			

		
		
		if ($data['title']==''){
			$this->error('标题不能为空');
		}else{
			$news=M('News');
			
			if ($data['id']){
				$insertid=$news->data($data)->save();
				//echo $news->getLastSql();
				//dump($data);
				//echo '<br>'.$insertid;
				//exit;
				if ($insertid){
					
					$this->success('修改成功');
				}else{
					$this->error('修改失败');
				}
				
			}else{
				$data['addtime']=time();
				//print_r($data);
				//exit;
				if ($insertid=$news->data($data)->add()){
					
					$this->success('新增成功');
				}else{
					$this->error('新增失败');
				}
			}
			
			
		}
		
		
	}
	
	function del(){
	
		$tid=$_GET['tid'];
		$news=M('News');
		$photo=$news->where("id='".$tid."'")->getField('photo');
		$this->delphoto($photo,'news');
			if ($news->where("id='".$tid."'")->delete()){
				
				$this->success('删除成功');
			}else{
				$this->error('删除失败');
			}

	}
	
	function sortdel(){
	
		$tid=$_GET['tid'];
		$news=M('NewsSort');
			if ($news->where("id='".$tid."'")->delete()){

				$this->success('删除成功');
			}else{
				$this->error('删除失败');
			}

	}

}