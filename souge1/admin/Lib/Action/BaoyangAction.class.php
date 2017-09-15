<?php
class BaoyangAction extends CommonAction{

	function index(){
		
		$keyword=$_GET['keyword'];
		if($keyword){
			$where['title']=array('like','%'.$keyword.'%');
		}
		$sortid=$_GET['sortid'];
		if($sortid){
			$where['sortid']=$sortid;
		}
		
		import('@.ORG.Util.Page');
		
		//保养信息列表
		$baoyang=M('baoyang');
		$totalRows=$baoyang->where($where)->count();
		$page=new Page($totalRows,10);
		$page->setConfig('theme','%totalRow% %header% %upPage% %linkPage% %downPage%');
		$show=$page->show();
		
		$list=$baoyang->where($where)->field('id,sortid,title,shoubao,erbao,jiange')->limit($page->firstRow.','.$page->listRows)->order('id DESC')->select();
		//echo $baoyang->getLastSql();
		$table=M('products');
		$youhui_table=M('product_youhui');
		foreach($list as $k=>$v){
			$list[$k]['_youhui']=$table->where(array('baoyangid'=>$v['id']))->field('id,baoyangid,name,price,photo')->select();
			
			foreach($list[$k]['_youhui'] as $k2=>$v2){
				$list[$k]['_youhui'][$k2]['_products']=$youhui_table->where(array('baoyangid'=>$v['id'],'proid'=>$v2['id']))->field('id,t_proid,t_price,t_number,t_name,t_photo')->select();
				//echo $youhui_table->getLastSql();
			}
			
			
			
		}
		
		//print_r($list);
		
		$this->assign('list',$list);
		$this->assign('page',$show);
		
		
		
		$this->display();
	
	
	}
	
	function edit(){
		
		
		

		
		//保养信息
		$news=M('Baoyang');
		$show=$news->where("id='".$_GET['tid']."'")->find();
		$this->assign('show',$show);
		
		//获取保养类别
		$sort=M('ProductSort');
		$list=$sort->where('typeid=2')->order('title asc')->select();
		$newlist=$this->toTree($list);
		//dump($newlist);
		$this->assign('list',$newlist);
		
		
		$this->display();
	
	
	}
	
	function update(){
		//dump($_POST);
		if($_POST['title']==''){
			$this->error('标题不能为空');
		}
		$baoyang=M('Baoyang');
		$baoyang->create();
		if ($_POST['id']){
			//修改
			if ($baoyang->save()){
				$this->success('添加成功，正在返回继续添加！');
			}else{
				$this->error('添加失败，正在后退');
			}
	
		}else{
			//添加
			if ($baoyang->add()){
				$this->success('添加成功，正在返回继续添加！');
			}else{
				$this->error('添加失败，正在后退');
			}
			
		}
	}
	
	function del(){
	
		$tid=$_GET['tid'];
		$news=M('Baoyang');
		
	
			if ($news->delete($tid)){

				$this->success('删除成功');
			}else{
				$this->error('删除失败');
			}

	}
	
	//添加优惠套装
	function youhui(){
	
		$tid=$_GET['tid'];
		$baoyang=M('Baoyang');
		$show=$baoyang->field('id,sortid')->where("id='".$tid."'")->find();
		$this->assign('show',$show);
		
		$products=D('Products');
		$sql1=" AND otherid REGEXP '[[:<:]]".$show['sortid']."[[:>:]]'";
		$prolist=$products->relation('Property')->field('id,photo,name,model')->where('issales=1 AND isassemble=0'.$sql1)->select();
		
		$this->assign('prolist',$prolist);

		
		
		
		
		$this->display();
	}
	
	
	//更新优惠套装
	function youhuiupdate(){
	
		
		if(empty($_POST['name'])){
			$this->error('对不起，标题不能为空');
			exit;
		}
		if(empty($_POST['price'])){
			$this->error('对不起，套餐价格不能为空');
			exit;
		}
		
		
			$products=M('Products');
			$products->create();
			$products->addtime=time();
			$insertid=$products->add();
			//echo $products->getLastSql();
			//echo $insertid;
			if ($insertid){
					
		
					$youhui=M('ProductYouhui');
					$data['baoyangid']=$_POST['baoyangid'];
					$t_number=$_POST['t_number'];
					for($i=0;$i<count($t_number);$i++){
						
						if($t_number[$i]){
							
							//添加数据
							$data['proid']=$insertid;
							$data['t_proid']=$_POST['t_proid'][$i];
							$data['t_name']=$_POST['t_name'][$i];
							$data['t_price']=$_POST['t_price'][$i];
							$data['t_number']=$_POST['t_number'][$i];
							$data['t_name']=$_POST['t_name'][$i];
							$data['t_photo']=$_POST['t_photo'][$i];
							
							$youhui->data($data)->add();
							$key='on';
						} 
					}
		
				$this->success('添加成功',__URL__);
			}
	}
	
	function youhuiedit(){
		$tid=$_GET['tid'];
		$products=D('Products');
		
		$prolist=$products->relation('Youhua')->field('id,photo,name,model,price,otherid,baoyangid')->where("id='".$tid."'")->find();
		//dump($prolist);
		$this->assign('prolist',$prolist);
		
		$baoyang=M('Baoyang');
		$show=$baoyang->field('id,sortid')->where("id='".$tid."'")->find();
		$this->assign('show',$show);
		
		
		
		

		$sql1=" AND otherid REGEXP '[[:<:]]".$prolist['otherid']."[[:>:]]'";
		$prolist=$products->relation('Property')->field('id,photo,name,model')->where('issales=1 AND isassemble=0'.$sql1)->select();
		//echo $products->getLastSql();
		$this->assign('addprolist',$prolist);
		
		
		
		
		$this->display();
	}
	
	function youhuiproupdate(){
		
		$product_youhui=M('ProductYouhui');
		$product_youhui->create();
		if($product_youhui->save()){
			$this->success('修改成功');
		}else{
			//echo $product_youhui->getLastSql();
			$this->error('修改失败');
		}
		
		
		
	}
	
	function youhuiproaddupdate(){
			$t_number=$_POST['t_number'];

					if ($t_number=='0'){
						$this->error('对不起，数量不能为0');
						exit;
					}
					if(!is_numeric($t_number)){
						$this->error('数量必须为整数');
						exit;
					}
			
					$youhui=M('ProductYouhui');
					$youhui->create();
					if ($youhui->add()){
						$this->success('添加成功');
					}else{
						$this->error('添加失败');
					}
					


	}
	
	function youhuiprodel(){
		$tid=$_GET['tid'];
		$product_youhui=M('ProductYouhui');
		

		$vo=$product_youhui->where("id='".$tid."'")->delete();

		
		
		if($vo){
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		}
		
	}
	
	function youhuieditupdate(){
		
		$products=D('Products');
		$products->create();
		if($products->save()){
			$this->success('修改成功');
		}else{
			$this->error('修改失败');
		}
	}
	
	function youhuadel(){
	
		//删除
		$tid=$_GET['tid'];
		$product_youhui=M('ProductYouhui');
		$product_youhui->where("proid='".$tid."'")->delete();

		
		$products=M('Products');
		$vo=$products->where("id='".$tid."'")->delete();

		
		
		if($vo){
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		}
		
		
	}
	
	function proaddphoto(){
		$this->display();
	}
	
	function proaddphotoaction(){
	
	
		import("@.ORG.Net.UploadFile");
		$upload = new UploadFile();// 实例化上传类
		$upload->maxSize  = 3145728 ;// 设置附件上传大小
		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->hashType	='md5_file';
		
		$upload->savePath =  './Uploads/pro/';// 设置附件上传目录
		$upload->saveRule = "uniqid";
		$upload->thumb = true;
		$upload->thumbPrefix = 'thumb_50_,thumb_150_,thumb_300_';
		$upload->thumbPath = './Uploads/pro/thumb/';
		$upload->thumbMaxWidth = '50,150,300';
		$upload->thumbMaxHeight = '50,150,300';
		
		if(!$upload->upload()) {// 上传错误提示错误信息
			$this->error($upload->getErrorMsg());
		}else{// 上传成功 获取上传文件信息
			$info =  $upload->getUploadFileInfo();
		}
		
		
		
		$data['photo'] = $info[0]["savename"];
		
		
		//foreach($data['otherid'] as $v){
			//$otherid=$otherid.$v.',';
		//}
		//$otherid=trim($otherid,',');
		//$data['otherid']=$otherid;
		

		$products = M("Products"); // 实例化
		$data['addtime']= time();
		$insert= $products->data($data)->where("id='".$_POST['id']."'")->save();
		
		if($insert){
			$this->success('上传成功',__URL__);
			
		}else{
			$this->error('上传失败');
		}
		

	
	}
	
}