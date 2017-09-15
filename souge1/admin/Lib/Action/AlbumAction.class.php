<?php
class AlbumAction extends CommonAction{

	function index(){
		
		
		
		
		//相册列表
		$album=M('Album');
		$list=$album->order('orderby,id')->select();
		$this->assign('list',$list);
		
		
		
		
		$this->display();
		
	}
	
	function edit(){
		
		
		//相册列表
		$album=M('Album');
		$list=$album->order('orderby,id')->select();
		$this->assign('list',$list);
		
		//添加相册
		$tid=$_GET['tid'];
		$show=$album->where("id='".$tid."'")->find();
		$this->assign('show',$show);
		
		
		
		
		$this->display();
	
		
		
	}
	
	
	
	function update(){
	
		$data=$_POST;
		
		if ($data['title']==''){
			$this->error('标题不能为空');
		}else{
			$album=M('Album');
			
			if ($data['id']){
			
				if ($insertid=$album->data($data)->save()){
					
					$this->success('修改成功');
				}else{
					$this->error('修改失败');
				}
				
			}else{
				$data['addtime']=time();
				if ($insertid=$album->data($data)->add()){
					
					$this->success('新增成功');
				}else{
					$this->error('新增失败');
				}
			}
			
			
		}
		
	
	}
	
	
	function del(){
		$tid=$_GET['tid'];
		$album=M('Album');
		if ($album->where("id='".$tid."'")->delete()){
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		}
		
	}
	
	function addphoto(){
		
		
		//相册列表
		$album=M('Album');
		$list=$album->order('orderby,id')->select();
		$this->assign('list',$list);
		
		//上传相册
		
		
		
		
		
		
		
		
		
		$this->display();
	}
	
	function addphotoupdate(){

		
		import("@.ORG.Net.UploadFile");
		$upload = new UploadFile();// 实例化上传类
		$upload->maxSize  = 3145728 ;// 设置附件上传大小
		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->hashType	='md5_file';
		
		$upload->savePath =  './Uploads/album/';// 设置附件上传目录
		$upload->saveRule = "uniqid";  
		if(!$upload->upload()) {// 上传错误提示错误信息
			$this->error($upload->getErrorMsg());
		}else{// 上传成功 获取上传文件信息
			$info =  $upload->getUploadFileInfo();
		}
		
		
		
		
		$photo = M("AlbumPhoto"); // 实例化
		$photo->create();
		$photo->filename = $info[0]["savename"];
		$photo->profile = $info[1]["savename"];
		$photo->addtime = time();
		if ($photo->title==''){
			
			$photo->title=str_replace('.'.$info[0]["extension"],'',$info[0]["name"]);
		}
		$photo->add();
		$this->success("数据保存成功！");
	


		
	}
	
	
	function editphotoupdate(){
		$photo = M("AlbumPhoto"); // 实例化
		$photo->create();
		if ($_FILES['filename']['name']){
			import("@.ORG.Net.UploadFile");
			$upload = new UploadFile();// 实例化上传类
			$upload->maxSize  = 3145728 ;// 设置附件上传大小
			$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->hashType	='md5_file';
			
			$upload->savePath =  './Uploads/album/';// 设置附件上传目录
			$upload->saveRule = "uniqid"; 
			if(!$upload->upload()) {// 上传错误提示错误信息
				$this->error($upload->getErrorMsg());
			}else{// 上传成功 获取上传文件信息
				$info =  $upload->getUploadFileInfo();
			}
			$photo->filename = $info[0]["savename"];
			$photo->profile = $info[1]["savename"];
		}
		
		
		

		
		$photo->addtime = time();
		$photo->id=$_POST['tid'];
		$photo->albumid = $_POST['albumid'];
		$photo->title = $_POST['title'];
		$photo->url = $_POST['url'];
		//$photo->profile = $_POST['profile'];
		$photo->orderby = $_POST['orderby'];
		
		
		
		
		if ($photo->title==''){
			
			$photo->title=str_replace('.'.$info[0]["extension"],'',$info[0]["name"]);
		}
		$photo->save();
		$this->success("数据保存成功！");
	


		
	}
	
	
	
	function view(){
	

		//查看
		$tid=$_GET['tid'];
		$photo=M('AlbumPhoto');
		import('@.ORG.Util.Page');
		
		$totalRows=$photo->where("albumid='".$tid."'")->count();
		$page=new Page($totalRows,12);
		$page->setConfig('theme','%totalRow% %header% %upPage% %linkPage% %downPage%');
		$show=$page->show();
		$list=$photo->order('id desc')->where("albumid='".$tid."'")->limit($page->firstRow.','.$page->listRows)->select();
		
		//echo 'sql:'.$photo->getLastSql();
		$this->assign('list',$list);
		$this->assign('page',$show);
		//dump($list);
		$this->display();
	}
	
	function deletephoto(){
		//删除相册
		$tid=$_GET['tid'];
		$photo=M('AlbumPhoto');
		$photofile=$photo->where("id='".$tid."'")->getField('filename');
		//echo $photo;
		
		if ($photofile){
			
			//删除他的图片
			$this->delphoto($photofile,'album');

			
			$photo->delete($tid);
			
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		}
	}
	
	function editphoto(){
		//相册列表
		$album=M('Album');
		$list=$album->order('orderby,id')->select();
		$this->assign('list',$list);
		
		//获取相片信息
		$tid=$_GET['tid'];
		$photo=M('AlbumPhoto');
		$show=$photo->where("id='".$tid."'")->find();
		$this->assign('show',$show);
		
		$this->display();
	}

}