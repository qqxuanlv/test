<?php
class ProductAction extends CommonAction{

private $array;

	function index(){
	
		
		$keyword=$_GET['keyword'];
		if ($keyword){
			$sql1=" AND ((name like '%".$keyword."%') or size='$keyword')";
		}
		$language=$_GET['language'];
		if($language){
			$sql1.=" and language='".$language."'";
			}
		//获取产品数据
		$orderby=$_GET['order'];
		
		import('@.ORG.Util.Page');
		$products=M('Products');
		$totalRows=$products->where('1=1'.$sql1)->count();
		$page=new Page($totalRows,30);
		
		if(isset($orderby)){
			$list=$products->order('id asc')->field('id,sortid,name,photo,addtime,issales,iscomm,ishot,isassemble,ispromotion,orderby')->where('1=1'.$sql1)->limit($page->firstRow.','.$page->listRows)->order($orderby.' desc')->select();
		}else{
			$list=$products->order('id asc')->field('id,sortid,name,photo,addtime,issales,iscomm,ishot,isassemble,ispromotion,orderby')->where('1=1'.$sql1)->limit($page->firstRow.','.$page->listRows)->order('id desc')->select();
		}
		//echo $products->getLastSql();
		
		$page->setConfig('theme','%totalRow% %header% %upPage% %linkPage% %downPage%');
		$show=$page->show();
	
		for ($i=0;$i<count($list);$i++){
			$data[$i]=$list[$i];
			$data[$i][attphoto]=$this->attphoto($list[$i]['id']);
		}
		//dump($data);
		//echo $products->getLastSql();
		
		$this->assign('list',$data);
		$this->assign('page',$show);
		
		

		

		
		$this->display();
	}
	
	function view(){
		$tid=$_GET['tid'];
		header('Location:index.php?a=productsd&m=Products&id='.$tid);
	}
	
	function status(){
		$tid=$_GET['tid'];
		$field=$_GET['f'];
		$value=$_GET['v'];
		

		$products=M('Products');
		$products->data(array($field=>$value))->where(array('id'=>$tid))->save();

		$this->success('修改成功');
		//echo $products->getLastSql();
		

	}
	
	
	function sort_status(){
		$tid=$_GET['tid'];
		$field=$_GET['f'];
		$value=$_GET['v'];
		

		$products=M('product_sort');
		$products->data(array($field=>$value))->where(array('id'=>$tid))->save();

		$this->success('修改成功');
		//echo $products->getLastSql();
		

	}
	
	
	
	function attphoto($id,$num){
		$productsatt = M("ProductsAttphoto"); // 实例化
		if ($num){
			$data=$productsatt->limit($num)->where("productsid='".$id."'")->select();
		}else{
			$data=$productsatt->where("productsid='".$id."'")->select();
		}
		
		return $data;
	}
	
	
	function add(){
		$productsort=D('ProductSort');
		$list=$productsort->where("id<>2")->select();
		$list=$this->toTree($list);
		$this->assign('prosort',$list);
		

		
		//查询品牌分类
		$list=$productsort->where('countnum=0 AND typeid=2')->select();
		$this->assign('brandsort',$list);
		


		
		
		$this->display();
	}

	
	function edit(){
		$productsort=D('ProductSort');
		$list=$productsort->where("id<>2")->select();
		$list=$this->toTree($list);
		$this->assign('prosort',$list);

		//查询品牌分类
		$list=$productsort->where('countnum=0 AND typeid=2')->select();
		$this->assign('brandsort',$list);
		

		
		
		//查询产品信息
		$tid=$_GET['tid'];
		$products=M('Products');
		
		
		$data=$products->where("id='".$tid."'")->find();
		
		//dump($data);
		
		
		$data['otherid'] = explode(",",$data['otherid']);
		
		//dump($data);
		$this->assign('show',$data);
		
		
		
		
		$this->display();
	}



	function attedit(){
	
		
		
		$tid=$_GET['tid'];
		$products=M('products');
		$show=$products->where(array('id'=>$tid))->field('id,name,sortid')->find();
		$this->assign('page_show',$show);
		
		
		$productsatt = M("ProductsAttphoto"); // 实例化
		$list=$productsatt->where("productsid='".$tid."'")->select();
		$this->assign('list',$list);
		

		
		$this->display();
	
	}
	
	function attupdate(){
		
		$filename=$_FILES['filename'];
		//dump($filename);
		
		
		$productsid=$_POST['productsid'];
		//echo $productsid;
		import("@.ORG.Net.UploadFile");
		$upload = new UploadFile();// 实例化上传类
		$upload->maxSize  = 3145728 ;// 设置附件上传大小
		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->hashType	='md5_file';
		
		$upload->savePath =  './Uploads/pro/';// 设置附件上传目录
		$upload->saveRule = "uniqid";
		$upload->thumb = true;
		$upload->thumbPrefix = 'thumb_50_,thumb_100_,thumb_150_,thumb_300_,thumb_500_';
		$upload->thumbPath = './Uploads/pro/thumb/';
		$upload->thumbMaxWidth = '50,100,150,300,1000';
		$upload->thumbMaxHeight = '50,100,150,300,1000';
		
		if(!$upload->upload()) {// 上传错误提示错误信息
			$this->error($upload->getErrorMsg());
		}else{// 上传成功 获取上传文件信息
			$info =  $upload->getUploadFileInfo();
		}
		
		//dump($info);
		//echo count($info);
		$data['photo'] = $info[0]["savename"];
		$data['productsid']=$productsid;
		//dump($data).'<hr />';
		$productsatt = M("ProductsAttphoto"); // 实例化
		$productsatt->data($data)->add();
		

		
		$this->success('修改成功');
	
	}
	
	function attdel(){

		
		$tid=$_GET['tid'];
		$products=M('ProductsAttphoto');
		$photo=$products->where("id='".$tid."'")->getField('photo');
		//dump($data);
		if ($photo){
			
			//删除他的图片
			$this->delphoto($photo);

			
			$products->where("id='".$tid."'")->delete();
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		}
	}
	
	function del(){

		
		$tid=$_GET['tid'];
		$products=D('Products');
		$list=$products->relation(true)->find($tid);
		
		
		//删除图片
		$this->delphoto($list['photo']);
		
		for($i=0;$i<count($list['Attphoto']);$i++){
			$this->delphoto($list['Attphoto'][$i]['photo']);
		}
		
		
		
		$status=$products->relation(true)->delete($tid);

		if ($status){
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		}
	}

	

	function addupdate(){
		$data=$_POST;
		$data['search_id']=implode(",",$data['search']);
		$data['status']=1;
		if($data['endtime']){
		$data['endtime']=strtotime($_POST['endtime']);
		}

		if ($data['name']==''){
			$this->error('请输入产品名称');
		}
		
		if(!$_FILES['pdf']['name']){
			//$this->error('请上传产品pdf图');
			}
		if($_FILES['pdf']['type']!="application/pdf"){
			//$this->error('仅支持pdf的上传');
			}		
		if(!$_FILES['shouce']['name']){
			//$this->error('请上传产品手册');
			}
		//dump($_FILES);
		if(!$_FILES['filename']['name'][0]){
			$this->error('请上传产品主图');
			}
		$info=$this->return_upload_photo('/pro');

        if(!$_FILES['pdf']['name']){
			if(!$_FILES['shouce']['name']){
				$data['photo'] = $info[0]["savename"];
				$i=1;
				}else{
					$data['manuals'] = $info[0]["savename"];
					$data['photo'] = $info[1]["savename"];
					$i=2;
					}
		
		}else{
			if(!$_FILES['shouce']['name']){
				$data['pdf'] = $info[0]["savename"];
				$data['photo'] = $info[1]["savename"];
				$i=2;
				}else{
					$data['pdf'] = $info[0]["savename"];
					$data['manuals'] = $info[1]["savename"];
					$data['photo'] = $info[2]["savename"];
					$i=3;
					}
			}
		
		
		
		

		

		$products = M("Products"); // 实例化
		$data['addtime']= time();
		
		//获取PATH
		$sortid=$_POST['sortid'];
		$product_sort=M('product_sort');
		$pro_sort_show=$product_sort->where(array('id'=>$sortid))->find();
		$data['path']=str_replace('-',',',$pro_sort_show['path']).','.$pro_sort_show['id'];
		
		$insert= $products->data($data)->add();
		//echo $products->getlastsql();
		//die;
		
		for ($i;$i<count($info);$i++){
			//添加图片至附图
			$data['photo'] = $info[$i]["savename"];
			$data['productsid']=$insert;
			$productsatt = M("ProductsAttphoto"); // 实例化
			$productsatt->data($data)->add();
		}
		
		
		
		
		
		$this->success("数据保存成功，即将返回继续添加");
		
		
		
	}
	
	
	
	function update(){
		$data=$_POST;
		$data['search_id']=implode(",",$data['search']);
		$id=$_POST['id'];
		$products = M("Products"); // 实例化
		if($data['endtime']){
		$data['endtime']=strtotime($_POST['endtime']);
		}
		

		$info=$this->return_upload_photo('/pro');

        if(!$_FILES['pdf']['name']){
			if(!$_FILES['shouce']['name']){
				if($info[0]["savename"]){
				$data['photo'] = $info[0]["savename"];
				}
				$i=1;
				}else{
					if($info[0]["savename"]){
					//$products->manuals = $info[0]["savename"];
					$data['manuals']=$info[0]["savename"];
					}
					if($info[1]["savename"]){
					//$products->photo = $info[1]["savename"];
					$data['photo']=$info[1]["savename"];
					}
					$i=2;
					}
		
		}else{
			if(!$_FILES['shouce']['name']){
				if($info[0]["savename"]){
				//$products->pdf = $info[0]["savename"];
				$data['pdf']=$info[0]["savename"];
				}
				if($info[1]["savename"]){
				//$products->photo = $info[1]["savename"];
				$data['photo']=$info[1]["savename"];
				}
				$i=2;
				}else{
					if($info[0]["savename"]){
					//$products->pdf = $info[0]["savename"];
					$data['pdf']=$info[0]["savename"];
					}
					if($info[1]["savename"]){
					//$products->manuals = $info[1]["savename"];
					$data['manuals']=$info[1]["savename"];
					}
					if($info[2]["savename"]){
					//$products->photo = $info[2]["savename"];
					$data['photo']=$info[2]["savename"];
					}
					$i=3;
					}
			}
		//获取PATH
		$sortid=$_POST['sortid'];
		$product_sort=M('product_sort');
		$pro_sort_show=$product_sort->where(array('id'=>$sortid))->find();
		//$products->path=str_replace('-',',',$pro_sort_show['path']).','.$pro_sort_show['id'];
		$data['path']=str_replace('-',',',$pro_sort_show['path']).','.$pro_sort_show['id'];
		//dump($data);
		$products->where('id='.$id)->data($data)->save();
		
        //echo $products->getlastsql();
        //die;
		
		
		$this->success("数据保存成功，即将返回继续添加");
		
		
		
	}
	
	
	
	function sort(){
		
		
		
		
		//分类类型
		$typeid=$_GET['type'];
		$sorttype=M('ProductSortType');
		$title=$sorttype->where("id='".$typeid."'")->getField('title');
		$this->assign('typetitle',$title);
		
		$language=$_GET['language'];
		if($language){
			$where=" and language='".$language."'";
			}else{
				$where="";
				}
		//产品分类
		$productsort=D('ProductSort');
		$list=$productsort->where("typeid='".$typeid."'".$where)->order('orderby,title')->select();
		//dump($list);
		$newlist=$this->toTree($list);
		//dump($newlist);
		
//			$list=$productsort->where("typeid='".$typeid."'")->field("id,title,pid,path,concat(path,'-',id) as bpath")->order('bpath,orderby')->select();
//			//echo $productsort->getLastSql();
//			foreach($list as $key=>$value){
//				$list[$key]['count']=count(explode('-',$value['bpath']));
//			}
			$this->assign('alist',$newlist);
			
		
		
		
		$this->display();
	}
	
	function sortadd(){
		$language=$_GET['language'];
		if(!$language){
			$language="cn";
			}
		if($language){
			$where=" and language='".$language."'";
			}else{
				$where="";
				}
		//分类类型
		$typeid=$_GET['type'];
		$sorttype=M('ProductSortType');
		$title=$sorttype->where("id='".$typeid."'")->getField('title');
		$this->assign('typetitle',$title);
		

		$productsort=M('ProductSort');
		$list=$productsort->where('typeid='.$typeid.$where)->field("id,title,pid,path,orderby")->order('orderby, id')->select();
		$list=$this->toTree($list);
		$this->assign('alist',$list);
		

		
		$this->display();
	}
	
	
	function sortedit(){
		$language=$_GET['language'];
		if(!$language){
			$language="cn";
			}
		if($language){
			$where=" and language='".$language."'";
			}else{
				$where="";
				}
				
				
		//分类类型
		$typeid=$_GET['type'];
		$sorttype=M('ProductSortType');
		$title=$sorttype->where("id='".$typeid."'")->getField('title');
		$this->assign('typetitle',$title);
		
		
		
		//$productsort=D('ProductSort');
//			$list=$productsort->where("typeid='".$typeid."'".$where)->field("id,title,pid,path,concat(path,'-',id) as bpath")->order('bpath,orderby')->select();
//			
//			foreach($list as $key=>$value){
//				$list[$key]['count']=count(explode('-',$value['bpath']));
//			}
		$productsort=M('ProductSort');
		$list=$productsort->where('typeid='.$typeid.$where)->field("id,title,pid,path,orderby")->order('orderby, id')->select();
		$list=$this->toTree($list);
			$this->assign('alist',$list);
		
		
		//编辑		
		//$productsort=M('ProductSort');
		$show=$productsort->where("id='".$_GET['tid']."'")->find();
		$this->assign('show',$show);
		
		//echo $news->getLastSql();
		//dump($show);
		
		$this->display();
		
	}
	
	
	
	function sortaddupdate(){
				if(empty($_POST['title'])){
					$this->error('对不起，请填写名称后提交');
				}
				$productsort=D('ProductSort');
				if($vo=$productsort->create()){
					
				if($insertid=$productsort->add()){
						$this->srotlevelupdate($insertid);
						$this->sortnumupdate();
					
						$this->success('添加成功');
					}else{
						$this->error('添加失败');
					}
				
				}else{
					$this->error($productsort->getError());
				}
			
	}
	
	
	

	
	
	
	function sortupdate(){
		//编辑更新
		if(empty($_POST['title'])){
			$this->error('对不起，请填写名称后提交');
		}
		$pid=$_POST['pid'];
		
		if($_POST['id']==$pid){
			$this->error('上级目录不能选择自己');
		}
		
		
		
		$productsort=M('ProductSort');
		$count=$productsort->where(array('pid'=>$pid))->count();
		
		$pid_show=$productsort->where(array('id'=>$pid))->find();
		//echo $productsort->getLastSql();
		//dump($count);
		//exit;
//		if ($count>0){
//			$this->error('该类别下还有子目录，所以不能移动至其他类别，如需移动，请先删除或先移动该类别下的子目录');
//		}
		
		$productsort=M('ProductSort');
		$vo=$productsort->create();
		if($pid==0){
		  $path=0;	
			}else{
		  $path=$pid_show['path'].'-'.$pid_show['id'];		
				}
		$productsort->path=$path;
		if($vo){
			//$productsort->where(array('id'=>$_POST['id']))->save();
			//echo $productsort->getLastSql();
			//die;
			if($productsort->where(array('id'=>$_POST['id']))->save()){
				$this->srotlevelupdate($_POST['id']);
				$this->sortnumupdate();
				
				$this->success('修改成功');
				
			}else{
				$this->error('修改失败，可能你已修改成功，请刷新后查看');
			}

		}else{
			$this->error($productsort->getError());
		}
			

		
		
	}
	function brand(){
		$products_and_brand=M("products_and_brand");
		$list=$products_and_brand->select();
		$this->assign("list",$list);
		$this->display();
	}
	function edit_brand(){
		$productsort=D('ProductSort');
		$products_and_brand=M("products_and_brand");
		$list=$productsort->where("id<>2")->select();
		$list=$this->toTree($list);
		$this->assign('prosort',$list);
		$id=$_GET['id'];
		if($id){
		$info=$products_and_brand->where("id=$id")->find();
			$this->assign("show",$info);
		}
		$this->display();
	}
	function edit_brand_update(){
		$products_and_brand=M("products_and_brand");
		$data=$_POST;
		$data['sort']=implode(",",$data['sort']);
		$info=$this->return_upload_photo('/prosort');
		if($_FILES['filename']['name']){
			$data['img']=$info[0]["savename"];
		}
		if($data['id']>0){
			$products_and_brand->save($data);
			//echo $products_and_brand->getlastsql();
			$this->success("编辑成功");
		}else{
			$products_and_brand->add($data);
			$this->success("添加成功");
		}
	}
	function del_brand(){
		$tid=$_GET['tid'];
		$products_and_brand=M("products_and_brand");
		$products_and_brand->where("id=$tid")->delete();
		$this->success("删除成功");
	}
	function brand_jz(){
		$products_and_brand=M("products_and_brand_jz");
		$list=$products_and_brand->select();
		$this->assign("list",$list);
		$this->display();
	}
	function edit_brand_jz(){
		$productsort=D('ProductSort');
		$products_and_brand=M("products_and_brand_jz");
		$list=$productsort->where("id<>2")->select();
		$list=$this->toTree($list);
		$this->assign('prosort',$list);
		$id=$_GET['id'];
		if($id){
		$info=$products_and_brand->where("id=$id")->find();
			$this->assign("show",$info);
		}
		$this->display();
	}
	function edit_brand_jz_update(){
		$products_and_brand=M("products_and_brand_jz");
		$data=$_POST;
		if($data['id']>0){
			$products_and_brand->save($data);
			$this->success("编辑成功");
		}else{
			$products_and_brand->add($data);
			$this->success("添加成功");
		}
	}
	function del_brand_jz(){
		$tid=$_GET['tid'];
		$products_and_brand=M("products_and_brand_jz");
		$products_and_brand->where("id=$tid")->delete();
		$this->success("删除成功");
	}
	function sortdel(){
		$tid=$_GET['tid'];
		$productsort=M('ProductSort');
		$show=$productsort->where("id='".$tid."'")->find();
		$count=$productsort->where("path='".$show['path']."-".$show['id']."'")->count();
		//echo $productsort->getLastSql();
		//dump($count);
		//exit;
		if ($count>0){
			$this->error('请先删除该类别下的子类别');
		}else{
			if ($productsort->where("id='".$tid."'")->delete()){
				$this->sortnumupdate();
				$this->success('删除成功');
			}else{
				$this->error('删除失败');
			}
		}
		
	}
	
	
	
	

	
	function sortnumupdate($id=0){
		//更新类别下的子类数量
		$productsort=M('ProductSort');
		$data=$productsort->where("pid='".$id."'")->order('id')->select();
		//echo '1:'.$productsort->getLastSql().'<br />';
		//echo '查询数量：'.count($data).'<br />';
		if (count($data)>0){
		
			for($i = 0;$i < count($data);$i++) {
				
		        $count=$productsort->where("pid='".$data[$i]['pid']."'")->count();
				//echo '2:'.$count.'='.$productsort->getLastSql().'<br />';
				
				$productsort->where("id='".$data[$i]['pid']."'")->data("countnum=$count")->save();
				//echo '2:'.$productsort->getLastSql().'<br /><br /><br />';
		        
		        //echo $data[$i]['title'].'<br>';
		        $this->sortnumupdate($data[$i]['id']);
		    }	
		
		}else{
			$count=$productsort->where("pid='".$id."'")->count();
			$productsort->where("id='".$id."'")->data("countnum=$count")->save();
			
		//echo '跳过<br />';
		}

	    
	}
	
	function srotlevelupdate($id){
		//更新类别的levelupdate
		$productsort=M('ProductSort');
		$data=$productsort->where("id='".$id."'")->getField('path');
		//echo $data;
		if ($data){
			$level= count(explode('-',$data));
			//echo $level;
			
		}else{
			$level= 1;
		}
		$data=$productsort->data("level=$level")->where("id='".$id."'")->save();
		//echo $productsort->getLastSql();
		//exit;
	}
	
	
	
	function viewallsort($id=0,$type=1){
		
		$aaa=array();
		$productsort=M('ProductSort');
		$data=$productsort->where("pid='".$id."' AND typeid='".$type."'"  )->order('orderby,id')->select();
		if (count($data)>0){
			for($i = 0;$i < count($data);$i++) {

		        //echo $data[$i]['title'].'<br>';
		        $this->array[]['title']=$data[$i]['title'];
		        $this->viewallsort($data[$i]['id']);
		       
		    }	
			
			
			
		}
		//else{
			//$newdata[]=$productsort->where("pid='".$id."' AND typeid='".$type."'"  )->order('orderby,id')->select();
		//echo '跳过<br />';
		//}	   
	}
	
	function newviewsort(){
		$data=$this->viewallsort();
		//dump($this->array);
		return $this->array;
		
	}
	
	function sorttype(){
		
	
		//分类类型
		$sorttype=M('ProductSortType');
		$list=$sorttype->select();
		$this->assign('list',$list);
		
		$this->display();
	}
	



	
	function digui($id=0){
	$productsort=D('ProductSort');
	$data=$productsort->where("pid='".$id."'")->select();
	//echo '--------------------------------------------------'.'<br />';
		$count=0;
		//echo '&nbsp;';
		for($i = 0;$i < count($data);$i++) {
	        $count++;
	        
	        echo $data[$i]['title'].'<br>';
	        $this->digui($data[$i]['id']);
	    }
	}
	
	
	
	function jsontree(){
		//查询产品信息
		$tid=$_GET['tid'];
		$products=M('Products');
		
		
		
		$prootherid=$products->where("id='".$tid."'")->getField('otherid');
		
		//echo $prootherid;
		
		
		
		
		
		//产品分类
		$productsort=M('product_sort');
		$list=$productsort->where(array('typeid'=>2))->field('id,title,pid')->order('orderby,title')->select();
		$list=$this->toTree($list);
		//print_r($list);
		echo '[';
		$i=0;
		
		foreach ($list as $vo){
			echo '{';
			echo '"id": '.$vo['id'].',"text": "'.$vo['title'].'"';
			if(isset($vo['_child'])){
				echo ',"state": "closed","children":';
				echo '[';
					$j=0;
					foreach($vo['_child'] as $vo2){
						echo '{';
						echo '"id": '.$vo2['id'].',"text": "'.$vo2['title'].'"';
						
						if(isset($vo2['_child'])){
							echo ',"state": "closed","children":';
							echo '[';
							$k=0;
							foreach($vo2['_child'] as $vo3){
								echo '{';
								echo '"id": '.$vo3['id'].',"text": "'.$vo3['title'].'"';
								
								if(isset($vo3['_child'])){
									echo ',"state": "closed","children":';
									echo '[';
									$l=0;
									foreach($vo3['_child'] as $vo4){
										echo '{';
										echo '"id": '.$vo4['id'].',"text": "'.$vo4['title'].'"';
										echo '}';
										$l++;
										if($l<count($vo3['_child'])){echo ',';}
									}
									echo ']';
								}
								
								
								
								echo '}';
								$k++;
								if($k<count($vo2['_child'])){echo ',';}
							}
							echo ']';
						}
						
						
						
						echo '}';
						$j++;
						if($j<count($vo['_child'])){echo ',';}
					}
				echo ']';
			}
			
			echo '}';
			$i++;
			if($i<count($list)){echo ',';}
			
		}
		
		
		echo ']';

		
	
	}
	
	function jsontree3(){
		

	
		$productsort=M('ProductSort');
		echo '[';
		
		$list1=$productsort->where("typeid=2 AND level=0")->field('id,title,pid')->order('title')->select();
		//print_r($list1);
		$i=0;
		foreach ($list1 as $v1){
			echo '{';
			echo '"id": '.$v1['id'].',';
			echo '"text": "'.$v1['title'].'"';
			
			
			$list2=$productsort->field('id,title,pid')->where(array('typeid'=>2,'pid'=>$v1['id']))->order('title')->select();
			if($list2){
				echo ',';
				echo '"state":"closed",';
				echo '"children": [';
			
			
			
			$j=0;
			foreach ($list2 as $v2){
				echo '{';
				echo '"id":'.$v2['id'].',';
				echo '"text":"'.$v2['title'].'",';
				echo '"state":"closed",';
				echo '"children":[';
				
				$k=0;
				$list3=$productsort->field('id,title,pid')->where(array('typeid'=>2,'pid'=>$v2['id']))->order('title')->select();
				foreach ($list3 as $v3){
				
					echo '{';
					echo '"id":"'.$v3['id'].'",';
					echo '"text":"'.$v3['title'].'",';
					echo '"state":"closed",';
					echo '"children":[';
					
					$l=0;
					$list4=$productsort->field('id,title,pid')->where(array('typeid'=>2,'pid'=>$v3['id']))->order('title')->select();
					foreach ($list4 as $v4){
						
						echo '{';
						echo '"id":"'.$v4['id'].'",';
						echo '"text":"'.$v4['title'].'"';
						echo '}';
						$l++;
						if($l<count($list4)){
							echo ',';
						}
					}
					
					
					echo ']';	
					
					echo '}';
					$k++;
					if($k<count($list3)){
						echo ',';
					}
				}
				
				echo ']';
				echo '}';
				$j++;
				if($j<count($list2)){
					echo ',';
				}
			}
			
			
			echo ']';			
			}
			echo '}';
			$i++;
			if($i<count($list1)){
				echo ',';
			}
		}
		
		
		echo ']';
	
	}
	
	function jsontree2(){
	
		//产品分类
		$productsort=M('ProductSort');
		echo '['."\n";
			//1级
			$list1=$productsort->where("typeid=2 AND level=1")->order('orderby,title')->select();
			echo $productsort->getLastSql();
			for($i=0;$i<count($list1);$i++){
			echo '{';
			echo '"id":'.$list1[$i]['id'].','."\n";
			echo '"text":"'.$list1[$i]['title'].'",'."\n";
			//echo '"iconCls":"tree-folder-open",'."\n";
			echo '"state":"closed",';
			echo '"children":['."\n";
				$list2=$productsort->where("typeid=2 AND level=2 AND pid='".$list1[$i]['id']."'")->order('orderby,title')->select();
				for($j=0;$j<count($list2);$j++){
					echo '{';
					echo '"id":'.$list2[$j]['id'].','."\n";
					echo '"text":"'.$list2[$j]['title'].'",'."\n";
					//echo '"iconCls":"tree-folder-open",'."\n";
					echo '"state":"closed",';
					echo '"children":['."\n";
					
					$list3=$productsort->where("typeid=2 AND level=3 AND pid='".$list2[$j]['id']."'")->order('orderby,title')->select();
					for($k=0;$k<count($list3);$k++){
						echo '{';
						echo '"id":'.$list3[$k]['id'].','."\n";
						echo '"text":"'.$list3[$k]['title'].'"'."\n";
						echo '}';
						if ($k!=count($list3)-1){
							echo ',';
						}
						
					}
					
					
					echo ']'."\n";
					
					echo '}';
					if ($j!=count($list2)-1){
						echo ',';
					}
				}
			echo ']'."\n";
			//echo ']}';
			
			
				
				echo '}';
				if ($i!=count($list1)-1){
					echo ',';
				}
			}
			
		echo ']';
	
	}
	function jsontreeedit(){
		//查询产品信息
		$tid=$_GET['tid'];
		$products=M('Products');
		
		
		
		$prootherid=$products->where("id='".$tid."'")->getField('otherid');
		
		//echo $prootherid;
		
		
		
		
		
		//产品分类
		$productsort=M('product_sort');
		$list=$productsort->where(array('typeid'=>2))->field('id,title,pid')->order('orderby,title')->select();
		$list=$this->toTree($list);
		//print_r($list);
		echo '[';
		$i=0;
		
		foreach ($list as $vo){
			echo '{';
			echo '"id": '.$vo['id'].',"text": "'.$vo['title'].'"';
			if(isset($vo['_child'])){
				echo ',"state": "closed","children":';
				echo '[';
					$j=0;
					foreach($vo['_child'] as $vo2){
						echo '{';
						echo '"id": '.$vo2['id'].',"text": "'.$vo2['title'].'"';
						
						if(isset($vo2['_child'])){
							echo ',"state": "closed","children":';
							echo '[';
							$k=0;
							foreach($vo2['_child'] as $vo3){
								echo '{';
								echo '"id": '.$vo3['id'].',"text": "'.$vo3['title'].'"';
								
								if(isset($vo3['_child'])){
									echo ',"state": "closed","children":';
									echo '[';
									$l=0;
									foreach($vo3['_child'] as $vo4){
										echo '{';
										echo '"id": '.$vo4['id'].',"text": "'.$vo4['title'].'"';
										if (in_array($vo4['id'], explode(',', $prootherid))){
											echo ',"checked":true';
										}
										echo '}';
										$l++;
										if($l<count($vo3['_child'])){echo ',';}
									}
									echo ']';
								}
								
								
								
								echo '}';
								$k++;
								if($k<count($vo2['_child'])){echo ',';}
							}
							echo ']';
						}
						
						
						
						echo '}';
						$j++;
						if($j<count($vo['_child'])){echo ',';}
					}
				echo ']';
			}
			
			echo '}';
			$i++;
			if($i<count($list)){echo ',';}
			
		}
		
		
		echo ']';

		
	
	}
	
	function jsontreeedit_4ji(){
		//查询产品信息
		$tid=$_GET['tid'];
		$products=M('Products');
		
		
		$prootherid=$products->where("id='".$tid."'")->getField('otherid');
		
		//echo $prootherid;
		
		
		
		
		
		//产品分类
		$productsort=M('ProductSort');
		echo '['."\n";
			//1级
			$list1=$productsort->where("typeid=2 AND level=1")->order('orderby,title')->select();
			for($i=0;$i<count($list1);$i++){
			echo '{';
			echo '"id":'.$list1[$i]['id'].','."\n";
			echo '"text":"'.$list1[$i]['title'].'",'."\n";
			//echo '"iconCls":"tree-folder-open",'."\n";
			echo '"state":"closed",';
			echo '"children":['."\n";
				$list2=$productsort->where("typeid=2 AND level=2 AND pid='".$list1[$i]['id']."'")->order('orderby,title')->select();
				for($j=0;$j<count($list2);$j++){
					echo '{';
					echo '"id":'.$list2[$j]['id'].','."\n";
					echo '"text":"'.$list2[$j]['title'].'",'."\n";
					//echo '"iconCls":"tree-folder-open",'."\n";
					echo '"state":"closed",';
					echo '"children":['."\n";
					
					$list3=$productsort->where("typeid=2 AND level=3 AND pid='".$list2[$j]['id']."'")->order('orderby,title')->select();
					for($k=0;$k<count($list3);$k++){
						echo '{';
						echo '"id":'.$list3[$k]['id'].','."\n";
						echo '"text":"'.$list3[$k]['title'].'",'."\n";
						//echo '"iconCls":"tree-folder-open",'."\n";
						echo '"state":"closed",';
						echo '"children":['."\n";
							$list4=$productsort->where("typeid=2 AND level=4 AND pid='".$list3[$k]['id']."'")->order('orderby,title')->select();
							for($l=0;$l<count($list4);$l++){
								echo '{';
								echo '"id":'.$list4[$l]['id'].','."\n";
								//查询是否有该ID，如有则选中
								//echo 'dddd'.$otherid;
								if (in_array($list4[$l]['id'], explode(',', $prootherid))){
								echo '"checked":true,';
								}
								
								echo '"text":"'.$list4[$l]['title'].'"'."\n";
								
								echo '}';
								if ($l!=count($list4)-1){
									echo ',';
								}
								
							}
						echo ']'."\n";
						echo '}';
						if ($k!=count($list3)-1){
							echo ',';
						}
						
					}
					
					
					echo ']'."\n";
					
					echo '}';
					if ($j!=count($list2)-1){
						echo ',';
					}
				}
			echo ']'."\n";
			//echo ']}';
			
			
				
				echo '}';
				if ($i!=count($list1)-1){
					echo ',';
				}
			}
			
		echo ']';
	
	}
	
	function sortphotoadd(){
		$this->display();
	}
	function sortphotoaddaction(){

		
		import("@.ORG.Net.UploadFile");
		$upload = new UploadFile();// 实例化上传类
		$upload->maxSize  = 3145728 ;// 设置附件上传大小
		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->hashType	='md5_file';
		
		$upload->savePath =  './Uploads/prosort/';// 设置附件上传目录
		$upload->saveRule = "uniqid";

		
		if(!$upload->upload()) {// 上传错误提示错误信息
			$this->error($upload->getErrorMsg());
		}else{// 上传成功 获取上传文件信息
			$info =  $upload->getUploadFileInfo();
		}
		
		
		
		$data['photo'] = $info[0]["savename"];
		
		$product_sort=M('ProductSort');
		$vo=$product_sort->where("id='".$_POST['id']."'")->data($data)->save();
		if($vo){
			$this->success('上传成功',U('sort',array('type'=>$_POST['type'])));
		}else{
			$this->error('上传失败');
		}
		
	}
	
	function comment(){
		import('@.ORG.Util.Page');
		$table=M('products_comment');
		$products=M('products');
		$totalRows=$table->count();
		$page=new Page($totalRows,30);
		
		$list=$table->limit($page->firstRow.','.$page->listRows)->order('id desc')->select();
		
		$page->setConfig('theme','%totalRow% %header% %upPage% %linkPage% %downPage%');
		$show=$page->show();
		$this->assign('page',$show);
		
		


		
		foreach ($list as $k=>$v){
			$list[$k]['_products']=$products->where(array('id'=>$v['productsid']))->field('id,name')->find();
		}

		//print_r($list);
		$this->assign('list',$list);
		
		
		
		$this->display();
	}
	
	function comment_del(){
		$id=$_GET['tid'];
		$table=M('products_comment');
		$table->where(array('id'=>$id))->delete();
		$this->success('删除成功');
	}
	
	
	function del_duoyu_sort(){
		$productsort=M('ProductSort');
		$list=$productsort->field("id,title,pid")->order('orderby, id')->select();
		$list=$this->toTree($list);
		
		foreach($list as $k=>$v){
			echo $v['title'].'<br />';
			foreach ($v['_child'] as $k2=>$v2){
				echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$v2['title'].'<br />';
				foreach ($v2['_child'] as $k3=>$v3){
					echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$v3['title'].'<br />';
					
					foreach ($v3['_child'] as $k4=>$v4){
						echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$v4['title'].'<br />';
					
						foreach ($v4['_child'] as $k5=>$v5){
							echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;----------'.$v5['title'].'<br />';
							$this->_del_duoyu_sort($v5['id']);
							echo '[删除]';
						}
					
					
					}
					
				}
				
			}
		}
		
		
	}
	function modeledit(){
		$tid=$_GET['tid'];
		$products=M('products');
		$show=$products->where(array('id'=>$tid))->field('id,name,sortid')->find();
		$this->assign('page_show',$show);
		
		
		$table=M('products_model');
		$list=$table->where(array('productsid'=>$tid))->select();
		$this->assign('list',$list);
		
		$table=M('basic_package');
		$list=$table->select();
		$this->assign('package_list',$list);
		
		
		$this->display();
	}
	function modelupdate(){
		$id=$_POST['id'];
		$model=trim($_POST['model']);
		if(empty($model)){
			$this->error('对不起，规格为必填选项');
			exit();
		}
		
		$num=intval($_POST['num'],10);
		if($num==0){
			$this->error('对不起，包装内数量不能为0');
			exit();
		}
		$table=M('products_model');
		$table->create();
		
		if(!$id){
			$table->add();
			$this->success('添加成功');
		}else{
			$table->save();
			$this->success('修改成功');
		}
		
	}
	
	function modeldel(){
		$id=$_GET['id'];
		$table=M('products_model');
		$table->where(array('id'=>$id))->delete();
		$this->success('删除成功');
	}
	
	function property_edit(){
		$tid=$_GET['tid'];
		$products=M('products');
		$show=$products->where(array('id'=>$tid))->field('id,name,sortid')->find();
		$this->assign('page_show',$show);
		
		//获取属性
		$products_property_sort=M('products_property_sort');
		$list=$products_property_sort->where(array('product_sortid'=>$show['sortid']))->select();
		
		$products_property_value=M('products_property_value');
		foreach($list as $k=>$v){
			$list[$k]['_child']=$products_property_value->where(array('sortid'=>$v['id']))->select();
		}
		$this->assign('page_list',$list);
		
		$products_and_property=M('products_and_property');
		$list=$products_and_property->where(array('productsid'=>$tid))->select();
		
		$this->assign('guanlian_list',$list);
		
		
		//print_r($show);
		//print_r($list);
		
		$this->display();
	}
	
	function property_edit_update(){
		//echo '<pre>';
		//print_r($_POST);
		//echo '</pre>';
		$productsid=$_POST['productsid'];
		$propertyid=$_POST['id'];
		$valueid=$_POST['value'];
		$products_and_property=M('products_and_property');
		
		foreach($propertyid as $k=>$v){
			$count=$products_and_property->where(array('productsid'=>$productsid,'propertyid'=>$v))->count();
			//echo $count.'<br>'.$products_and_property->getLastSql().'<br>';
			if($count==0){
				$products_and_property->data(array('productsid'=>$productsid,'propertyid'=>$v,'valueid'=>$valueid[$k]))->add();
				
			}else{
				$products_and_property->where(array('productsid'=>$productsid,'propertyid'=>$v))->data(array('productsid'=>$productsid,'propertyid'=>$v,'valueid'=>$valueid[$k]))->save();
				//echo $count.'<br>'.$products_and_property->getLastSql().'<br>';
			}
			
		}
		
		$this->success('提交成功');
		//$products_and_property->data(array('productsid'=>$productsid))->add();
		
		
		
	}
	
	
	function property(){
		$table=M('product_sort');
		$list=$table->field('id,title,is_changyong')->order('id')->where(array('countnum'=>0,'typeid'=>1))->select();
		$this->assign('list',$list);
		//print_r($list);
		$this->display();
	}
	
	function property_view(){
		$tid=$_GET['tid'];
		$table=M('product_sort');
		$show=$table->where(array('id'=>$tid))->find();
		$this->assign('sortinfo',$show);
		$table=M('products_property_sort');
		$list=$table->where(array('product_sortid'=>$tid))->select();
		$table=M('products_property_value');
		foreach ($list as $k=>$v){
			$list[$k]['_child']=$table->where(array('sortid'=>$v['id']))->select();
		}
		
		$this->assign('list',$list);
		
		
		$this->display();
	}
	
	function property_value_update(){
		$table=M('products_property_value');
		if(empty($_POST['title'])){
			$this->error('对不起，请输入标题');
			exit();
		}
		$info=$this->return_upload_photo('/proproperty');
		//echo '<pre>';
		//print_r($_POST);
		//print_r($info);
		
		
		
		foreach ($info as $k=>$v){
			$new_info[$v['key']]=$v;
		}
		//print_r($new_info);
		//echo '</pre>';
		
		
		
		foreach ($_POST['title'] as $k=>$v){
			$table->data(array('sortid'=>$_POST['sortid'],'title'=>$v,'photo'=>$new_info[$k]['savename']))->add();
		
			//echo $table->getLastSql().'<br />';
		}
		
		//die;
		
		
		$this->success('新增成功');
	}
	
	function property_value_edit_update(){
		$id=$_POST['id'];
		$table=M('products_property_value');
		$info=$this->return_upload_photo('/proproperty');
		
		if($info[0]['savename']){
			$show=$table->where(array('id'=>$id))->find();
			$this->del_upload_photo('/proproperty',$show['photo']);
			$data['photo']=$info[0]['savename'];
		}
		$data['title']=$_POST['title'];
		$table->where(array('id'=>$id))->data($data)->save();
		$this->success('修改成功');
		
	}
	
	
	function property_value_del(){
		$id=$_GET['id'];
		$table=M('products_property_value');
		$show=$table->where(array('id'=>$id))->find();
		$this->del_upload_photo('/proproperty',$show['photo']);
		$show=$table->where(array('id'=>$id))->delete();
		
		$table=M('products_and_property');
		$table->where(array('valueid'=>$id))->delete();
		
		
		$this->success('删除成功');
	}
	
	function property_update(){
		$id=$_POST['id'];
		$table=M('products_property_sort');
		$table->create();
		if(empty($_POST['title'])){
			$this->error('对不起，请输入标题');
			exit();
		}
		
		if(!!$id){
			$table->save();
			$this->success('修改成功');
		}else{
			$table->add();
			$this->success('添加成功');
		}
		
		
	
	}
	
	function property_del(){
		$id=$_GET['id'];
		$table=M('products_property_value');
		$table->where(array('sortid'=>$id))->delete();
		$table=M('products_and_property');
		$table->where(array('propertyid'=>$id))->delete();
		$table=M('products_property_sort');
		$table->where(array('id'=>$id))->delete();
		
		
		
		
		$this->success('删除成功');
	}
	
	
	protected function _del_duoyu_sort($id){
		$productsort=M('ProductSort');
		$productsort->where(array('id'=>$id))->delete();
	}
	

	
	
	//包装方式
	function package(){
		
		$table=M('basic_package');
		$list=$table->select();
		$this->assign('list',$list);
		
		$this->display();
	}
	
	function package_update(){
		$id=$_POST['id'];
		$table=M('basic_package');		
		$table->create();
		
		if($id){
			$table->where(array('id'=>$id))->save();
			$this->success('修改成功');
		}else{			
			$table->add();
			$this->success('添加成功');
		}
		
		
	}
	
	
	function package_del(){
		$id=$_GET['id'];
		$table=M('basic_package');
		
		$table->where(array('id'=>$id))->delete();
		$this->success('删除成功');

	}


	function protype(){
		$prosort = M("product_type"); 
		$sortlist=$prosort->select(); 
        $this->assign('list',$sortlist);
		$this->display();
	}
	function edit_protype(){
		$productsort=D('ProductSort');
		$product_type=M("product_type");
		$list=$productsort->where("id<>2")->select();
		$list=$this->toTree($list);
		$this->assign('prosort',$list);
		$id=$_GET['id'];
		if($id){
		$info=$product_type->where("id=$id")->find();
			$this->assign("show",$info);
		}
		$this->display();
	}
	function protypeedit(){
       $id=$_POST['id'];
	   $data['sortid']=$_POST['sort'];
	   $data['name']=$_POST['name'];
	   $prosort = M("product_type"); 
	   if($id){
	   $prosort->where("id=$id")->save($data); 
	   $this->success("修改成功");
	   }else{
	   $prosort->add($data); 
	   $this->success("添加成功");
	   }
	   
	}
	function protypedel(){
		$id=$_GET['id'];
		$product_type=M("product_type");
		$product_type->where("id=$id")->delete();
		$this->success("删除成功");
	}
	function ajax_brand(){
		$sortid=$_POST['sortid'];;
		$products_and_brand_jz=M("products_and_brand_jz");
		$brand_jz_list=$products_and_brand_jz->where("sort =$sortid")->select();
		if(!$brand_jz_list){$brand_jz_list=0;}
		$product_sort=M("product_sort");
		$info=$product_sort->where("id=$sortid")->find();
		$product_type=M("product_type");
		$type_list=$product_type->where("sortid =".$info['pid'])->select();
		if(!$type_list){$type_list=0;}
		$products_and_brand=M("products_and_brand");
		$brand_list=$products_and_brand->select();
		foreach($brand_list as $key=>$data){
			if(in_array($info['pid'],explode(",",$data['sort']))){
				$brand_list_new[]=$data;
			}
		}
		if(!$brand_list_new){$brand_list_new=0;}
		
		$products_search_option=M("products_search_option");
		$s_o_list=$products_search_option->where("pid=0 and sortid=".$info['pid'])->select();
		foreach($s_o_list as $key=>$data){
			$s_o_list[$key]['child']=$products_search_option->where("pid=".$data['id'])->select();;
		}
		$list[0]=$brand_jz_list;
		$list[1]=$type_list;
		$list[2]=$brand_list_new;
		$list[3]=$s_o_list;
		echo json_encode($list);
	}
	function search_option(){
		$products_search_option=M("products_search_option");
		$product_sort=M("product_sort");
		$sortlist=$product_sort->where("pid=1")->select();
		foreach($sortlist as $key=>$data){
			$sortlist[$key]['_child']=$products_search_option->where("pid=0 and sortid=".$data['id'])->select();
			foreach($sortlist[$key]['_child'] as $k=>$d){
				$sortlist[$key]['_child'][$k]['_child']=$products_search_option->where("pid=".$d['id'])->select();
			}
		}
		$this->assign("list",$sortlist);
		$this->display();
	}
	function s_o_edit(){
		$product_sort=M("product_sort");
		$sortlist=$product_sort->where("pid=1")->select();
		$this->assign("sortlist",$sortlist);
		$products_search_option=M("products_search_option");
		$s_o_list=$products_search_option->where("pid=0")->select();
		$this->assign("s_o_list",$s_o_list);
		$id=$_GET['id'];
		$info=$products_search_option->where("id=$id")->find();
		$this->assign("show",$info);
		$this->display();
	}
	function s_o_update(){
		$products_search_option=M("products_search_option");
		$data=$_POST;
		$id=$_POST['id'];
		if($id==$data['pid']){
			$this->error("不能选择自己");
			die;
		}
		if($id){
			$products_search_option->where("id=$id")->save($data);
			$this->success("编辑成功");
		}else{
			$products_search_option->add($data);
			$this->success("添加成功");
		}
	}
	function s_o_del(){
		$id=$_GET['id'];
		$products_search_option=M("products_search_option");
		$products_search_option->where("id=$id")->delete();
		$this->success("删除成功");
	}
	function ajax_search(){
		$sortid=$_POST['sortid'];
		$products_search_option=M("products_search_option");
		$s_o_list=$products_search_option->where("sortid=$sortid")->select();
		echo json_encode($s_o_list);
	}
}