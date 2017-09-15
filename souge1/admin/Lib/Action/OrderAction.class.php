<?php
class OrderAction extends CommonAction{

	function index(){
	


		$keyword=$_GET['keyword'];
		if($keyword){
			$where['id']=array('like','%'.$keyword.'%');
		}
		
		
		//获取订单
		

		import('@.ORG.Util.Page');
		$order=D('Order');
		$totalRows=$order->where($where)->count();
		$page=new Page($totalRows,10);
		
		$page->setConfig('theme','%totalRow% %header% %upPage% %linkPage% %downPage%');
		$show=$page->show();
		
		$list=$order->relation(true)->field('id,uid,isfahuo,isfukuan,isshouhuo,addtime,proprice,freight,payment,freightprice')->order('id desc')->where($where)->limit($page->firstRow.','.$page->listRows)->select();
		//echo $order->getLastSql();
		
		//dump($list);
		
		$this->assign('list',$list);
		$this->assign('page',$show);
		
		

		

		
		
		
		$this->display();
	}
	
	
	function order_price_update(){
		$id=$_POST['id'];
		$p=$_POST['p'];
		$order=M('Order');
		$order->create();
		$order->where(array('id'=>$id))->save();
		$this->success('修改成功',U('index',array('p'=>$p)));
	}
	
	function fahuo(){
		
		
		
		//添加发货记录
		$tid=$_GET['tid'];
		if($tid){
			//查询是否有发货记录
			$fahuo=M('FahuoInfo');
			$count=$fahuo->where("orderid='".$tid."'")->select();
			if ($count>0){
				$this->error('已添加过发货记录，请勿重复添加',U('Order/index',array('id'=>$_GET['id'])));
				
			}
			
		}else{
			$this->error('请选择订单');
		}
		$basic_freight=M('basic_freight');
		$list=$basic_freight->select();
		$this->assign('list',$list);
		$this->display();
	}
	
	function fahuoinfo(){
		
		
		$tid=$_GET['tid'];
		//获取发货记录
		$fahuo=M('FahuoInfo');
		$show=$fahuo->where("id='".$tid."'")->find();
		if (count($show)>0){
			$this->assign('show',$show);
		}else{
			$this->error('找不到该发货记录');
		}
		
		
		$this->display();
	}
	
	function fahuoupdate(){
		//更新发货信息
		$tid=$_POST['id'];
		$fahuo=M('FahuoInfo');
		$count=$fahuo->where("id='".$tid."'")->count();		//查询是否有记录
		if ($count){
			//开始更新
			$fahuo->create();
			if($fahuo->save()){
				$this->success('更新成功');
			}else{
				$this->eroor('更新失败');
			}
			
		}else{
			$this->error('找不到该发货记录');
		}
	}
	
	
	
	function fahuoadd(){
	
		//提交发货记录
		$tid=$_POST['orderid'];
		$fahuo=M('FahuoInfo');
		$fahuo->create();
		$count=$fahuo->where("orderid='".$tid."'")->select();
		if ($count>0){
			$this->redirect('Order/index',array('id'=>$_GET['id']),3,'已添加过发货记录，请勿重复添加，3秒后返回');
		}else{
			$fahuo->addtime=time();
			if ($fahuo->add()){
				//更新订单状态
				$order=M('Order');
				$order->data(array('isfahuo'=>1))->where("id='".$tid."'")->save();
				//echo $order->getLastSql();
				//exit;
				$this->redirect('Order/index',array('id'=>$_GET['id']),3,'添加成功，3秒后返回');
				
			}else{
				$this->error('添加失败');
			}
		}
		
		
	}
	
	
	function orderview(){
		
		$getid=$_GET['tid'];

		if ($getid){
			$order=D('Order');
			$show=$order->relation(true)->where("id='".$getid."'")->find();
			//echo $order->getLastSql();
			//dump($show);
			$this->assign('show',$show);
			
			$basic_payment=M('basic_payment');
			$payment=$basic_payment->where(array('id'=>$show['payment']))->getField('title');
			$this->assign('payment',$payment);
			

			$this->display();
		}else{
			$this->error('缺少参数',U('Order/index'));
			
		}
		
		
	}
	
	function audit(){
		$getid=$_GET['tid'];
		$pass=$_GET['pass'];
		if ($getid){
			$order=M('Order');
			$rs=$order->data(array('isaudit'=>$pass,'audittime'=>time()))->where("id='".$getid."'")->save();
			if($rs){
				$this->success('审核成功');
			}else{
				$this->error('审核失败');
			}

		}else{
			$this->redirect('Order/index',array('id'=>$_GET['id']),3,'缺少参数，3秒后返回订单列表');
		}
	}
	
	

	
	function del(){
	
		$tid=$_GET['tid'];
		$order=D('Order');
		$rs=$order->relation(true)->delete($tid);
		//echo $order->getLastSql();
		//exit;
			if ($rs){

				$this->success('删除成功');
			}else{
				$this->error('删除失败');
			}

	}
	
	
	function tuihuanlist(){
		import('@.ORG.Util.Page');
		//退换订单记录列表
		$tuihuo=D('Tuihuo');
		
		import('@.ORG.Util.Page');
		
		$totalRows=$tuihuo->count();
		$page=new Page($totalRows,12);
		$page->setConfig('theme','%totalRow% %header% %upPage% %linkPage% %downPage%');
		$show=$page->show();
		$list=$tuihuo->relation(true)->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
		
		
		$this->assign('list',$list);
		$this->assign('page',$show);
		//dump($list);
		
		$this->display();
	}
	
	
	function feedbacklist(){
		//反馈列表

		$feedback=M('Feedback');
		$list=$feedback->select();
		$this->assign('list',$list);
		
		
		$this->display();
	}
	
	
	//受理反馈
	function feed_shouli(){
		$id=$_GET['tid'];
		$feedback=M('Feedback');
		$feedback->where(array('id'=>$id))->data(array('isshouli'=>1))->save();
		$this->success('状态已处理为受理');
	}
	
	
	
	
	
	function deltuihuo(){
		$tuihuoid=$_GET['tid'];
		$tuihuo=D('Tuihuo');
		$result =  $tuihuo->relation(true)->delete($tuihuoid);
		//echo $tuihuo->getLastSql();
		if ($result){
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		}
	}
	
	function tuihuoshouli(){
		//退货受理
		$tuihuoid=$_GET['tid'];
		$tuihuo=M('Tuihuo');
		$result =  $tuihuo->data(array('isshouli'=>1))->where("id='".$tuihuoid."'")->save();
		$this->success('受理成功');
	}
	
	


}