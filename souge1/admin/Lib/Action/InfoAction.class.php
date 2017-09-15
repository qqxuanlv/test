<?php
class InfoAction extends CommonAction{


	function index(){
		
		
		$info=M('Info');
		import('@.ORG.Util.Page');
		$totalRows=$info->count();
		$page=new Page($totalRows,10);
		$page->setConfig('theme','%totalRow% %header% %upPage% %linkPage% %downPage%');
		$show=$page->show();
		$list=$info->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign('list',$list);
		$this->assign('page',$show);
		$this->display();
	}
	function edit(){
		
		
		
		$tid=$_GET['tid'];
		$info=M('Info');
		$show=$info->where("id='".$_GET['tid']."'")->find();
		$this->assign('show',$show);
		
		
		
		
		
		
		
		$this->display();
	
	
	}
	
	
	function update(){
		import("ORG.Net.UploadFile");
		
		$upload = new UploadFile();// 实例化上传类
		
		$upload->maxSize  = 31457280 ;// 设置附件上传大小
		
		$upload->allowExts  = array('xls', 'doc', 'txt', 'docx','xlsx','pdf');// 设置附件上传类型
		
		//$upload->hashType	='md5_file';
		
		$upload->savePath =  './Uploads/download/';// 设置附件上传目录
		
		$upload->saveRule = "uniqid";
		
		if(!$upload->upload()) {// 上传错误提示错误信息
		
		//$this->error($upload->getErrorMsg());
		
		}else{// 上传成功 获取上传文件信息
		
		$info =  $upload->getUploadFileInfo();
		
		 }
		if($info[0]["savename"]){
			$data['fujian'] = $info[0]["savename"];
		}
		$info=M('Info');
		$dai=$_POST;
		$data['id']=$dai['id'];
		$data['title']=$dai['title'];
		$data['content']=$dai['content'];
		$data['addtime']=time();
		if ($data['title']==''){
			$this->error('标题不能为空');
		}else{
			if ($data['id']==''){
				if($data['fujian']==""){
					//$this->error('附件出现错误');
					}
			$info->data($data)->add();
			$this->success('添加成功');
			}else{
			$info->where("id='".$data['id']."'")->data($data)->save();
			//echo $info->getLastSql();
			$this->success('修改成功');
			}
		}
	}
	
	function del(){
	
		$tid=$_GET['tid'];
		$info=M('Info');
		
	
			if ($info->where("id='".$tid."'")->delete()){

				$this->success('删除成功');
			}else{
				$this->error('删除失败');
			}

	}








}