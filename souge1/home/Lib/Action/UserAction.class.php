<?php
// 用户登录页面
class UserAction extends CommonAction {
	function _initialize(){
		//获取浏览商品
		$this->$userinfo=$userinfo=$this->getcookie();
		$this->assign('userinfo',$userinfo);
		if(MODULE_NAME=="User"){
		  //$this->checkuser();	
		}
	}
	function index(){
		$userinfo=$this->userinfo;
		$member=M("Member");
	    $info=$member->where("id=".$userinfo['uid'])->find();
	    $this->assign("uinfo",$info);
		//获取最近订单产品
		$order=D('Order');
		$orderlist=$order->relation(true)->where("uid=".$userinfo['uid']." and isquxiao=0"." and addtime<=".time()." and addtime >=".time()-3600*24*7)->join("(select title,url from smart_basic_freight)smart_basic_freight on smart_order.freight=smart_basic_freight.title")->order("addtime desc")->select();
		$this->assign("orderlist",$orderlist);
		//dump($orderlist);
		//统计
		$time=time();
		$count1=$order->where("uid=".$userinfo['uid']." and isshouhuo=1 and addtime<=$time and addtime >=($time-3600*24*7)")->count();
		$count2=$order->where("uid=".$userinfo['uid']." and isfahuo=0 and isshouhuo=0 and addtime<=$time and addtime >=($time-3600*24*7)")->count();
		$count3=$order->where("uid=".$userinfo['uid']." and isfukuan=0 and isshouhuo=0 and addtime<=$time and addtime >=($time-3600*24*7)")->count();
		$count4=$order->where("uid=".$userinfo['uid']." and isfahuo=1 and isshouhuo=0 and addtime<=$time and addtime >=($time-3600*24*7)")->count();
		//echo $order->getlastsql();
		$this->assign("count1",$count1);
		$this->assign("count2",$count2);
		$this->assign("count3",$count3);
		$this->assign("count4",$count4);
		$this->display();	
	}
	function user_info(){
	  $userinfo=$this->userinfo;
	  $basicprovince = M('BasicProvince');
	  $provincelist = $basicprovince->where("language='cn'")->select();
	  $this->assign("provincelist",$provincelist);
	  $member=M("Member");
	  $uinfo=$member->where("id=".$userinfo['uid'])->find();
	  $this->assign("uinfo",$uinfo);
	  $this->display();
	}
	function user_edit(){
	  $userinfo=$this->userinfo;
	  $member=M("Member");
	  $data=$_POST;
	  $re=$member->where("id=".$userinfo['uid'])->save($data);
	  if($re>=0){
		  $this->success("信息更新成功");
	  }else{
		  $this->redirect("Vip/grxx");
		  }
	}
	function update_password(){
	  $userinfo=$this->userinfo;
	  $member=M("Member");
	  $oldpassword=$_POST["oldpassword"];
	  $newpassword=$_POST["newpassword"];
	  $repassword=$_POST["repassword"];
	  
	  if($newpassword and $repassword){
		  if($newpassword!=$repassword){
			  $this->error("两次密码输入不一致！");
		  }
		  $data['password']=md5($newpassword);
	  }else{
		 $this->error("密码不能为空！"); 
	  }
	  $pd_pas=$member->where("id=".$userinfo['uid'])->getfield("password");
	  if($pd_pas!=md5($oldpassword)){
		  $this->error("旧密码输入有误！"); 
	  }
	  $re=$member->where("id=".$userinfo['uid'])->save($data);
	  if($re>=0){
		  $this->success("信息更新成功");
	  }else{
		  $this->redirect("Vip/grxx");
	  }
	}
	function index4(){
	  $userinfo=$this->userinfo;
	  $basicprovince = M('BasicProvince');
	  $provincelist = $basicprovince->where("language='cn'")->select();
	  $this->assign("provincelist",$provincelist);
	  $id=$_GET["id"];
	  $address=D("MemberAddress");
	  if($id){
		  
		  $info=$address->where("uid=".$userinfo['uid']." and id=$id")->find();
		  if($info['province_id']){
			   $citylist = M('basic_city')->where("language='cn' and pid=".$info['province_id'])->select();
			   $this->assign("citylist",$citylist);
		  }
		  $tel=explode("-",$info['tel']);
		  $info['tel1']=$tel[0];
		  $info['tel2']=$tel[1];
		  
	  }else{
	    $info['ismoren']=0;
	  }
	  $this->assign("address_info",$info);
	  //dump($info);
	  $address_list=$address->where("uid=".$userinfo['uid'])->join('(select title as province,id as rid from smart_basic_province)  smart_basic_province on smart_member_address.province_id=rid')->join('(select title as city,id as rid2 from smart_basic_city)  smart_basic_city on smart_member_address.city_id=rid2')->select();
	  foreach($address_list as $key=>$data){
		  if($data['tel']=='-'){
			  $data['tel']="";
		  }
		  if($data['mobile'] and $data['tel']){
			  $address_list[$key]['dianhua']=$data['mobile']."/".$data['tel'];
		  }else{
			  $address_list[$key]['dianhua']=$data['mobile'].$data['tel'];
			  }
	  }
	  
	  $this->assign("address_list",$address_list);
	  //dump($address_list);
	  $this->display();	
	}
	function edit_address(){
	  $userinfo=$this->userinfo;
	  $id=$_POST["aid"];
	  $data=$_POST;
	  if(!$data['address']){
		  $this->error("地址不能为空");
	  }
	  if(!$data['name']){
		  $this->error("收货人不能为空");
	  }
	  if(!$data['zipcode']){
		  $this->error("邮政编码不能为空");
	  }
	  if(!$data['province_id']){
	  	   $this->error("请选择省份");
	  }
	  if(!$data['city_id']){
	  	   $this->error("请选择城市");
	  }
	  if(!$data['mobile'] and  $data['tel']){
		  $this->error("手机和电话必须填一种！");
	  }
	  if(!$data['mobile'] and (!$data['tel1'] or !$data['tel2'])){
		  $this->error("请将电话输入完整！");
	  }
	  $address=M("MemberAddress");
		  if($data['ismoren']==1){
			$data2['ismoren']=0;
			$address->where("uid=".$userinfo['uid'])->data($data2)->save();
		  }
	  if($id){
		  $address->where("uid=".$userinfo['uid']." and id=$id")->save($data);
		  $msg="编辑新地址成功!";
	  }else{
		  $data['uid']=$userinfo['uid'];
		  $address->data($data)->add();
		  $msg="添加新地址成功!";
	  }
	  $this->success($msg);
	}
	function del_address(){
		$userinfo=$this->userinfo;
		$id=$_GET['id'];
		$memaddress=M('MemberAddress');
		$memaddress->where('id='.$id." and uid=".$userinfo['uid'])->delete();
		$this->success('地址删除成功',U('Vip/shdz'));
		}
	function moren(){
		$userinfo=$this->userinfo;
		$id=$_GET['id'];
		$memaddress=M('MemberAddress');
		$data2['ismoren']=0;
		$memaddress->where("uid=".$userinfo['uid'])->data($data2)->save();
		
		$data['ismoren']=1;
		$memaddress->where("id=$id and uid=".$userinfo['uid'])->data($data)->save();

		$this->success('设置默认成功');
		}
	function fav(){
		  $userinfo=$this->userinfo;
		  $table=M('Favorites');
		  import('@.ORG.Util.Page');
		  $totalRows=$table->where('uid='.$userinfo['uid'])->count();
		  $page=new Page($totalRows,7);
		  $favlist=$table->where('uid='.$userinfo['uid'])->join("(select id as pid,photo,name from smart_products) smart_products on smart_products.pid=smart_favorites.productsid")->limit($page->firstRow.','.$page->listRows)->select();
		  $show=$page->show();
		  $this->assign('favlist',$favlist);
		  $this->assign('page',$show);
		  $this->assign('count',$totalRows);
		  $this->display();
	}
	function delfav(){
		$userinfo=$this->userinfo;
		$id=$_GET['id'];
		$table=M('Favorites');
		$table->where("id=$id and uid=".$userinfo['uid'])->delete();
		$this->success('删除收藏成功',U('Vip/wdsc'));
		//$this->redirect('tuijian');
	}
	//订单开始
	function orderlist(){
		$userinfo=$this->userinfo;
	    $order=D("Order");
	    $orderlist=$order->relation(true)->where("uid=".$userinfo['uid']." and isquxiao=0")->join("(select title,url from smart_basic_freight)smart_basic_freight on smart_order.freight=smart_basic_freight.title")->order("addtime desc")->select();
		$count=$order->where("uid=".$userinfo['uid']." and isquxiao=0")->count();
		$orderlist2=$order->relation(true)->where("uid=".$userinfo['uid']." and isshouhuo=0 and isquxiao=0")->join("(select title,url from smart_basic_freight)smart_basic_freight on smart_order.freight=smart_basic_freight.title")->order("addtime desc")->select();
		$count2=$order->where("uid=".$userinfo['uid']." and isshouhuo=0 and isquxiao=0")->count();
		$orderlist3=$order->relation(true)->where("uid=".$userinfo['uid']." and isshouhuo=1 and isquxiao=0")->join("(select title,url from smart_basic_freight)smart_basic_freight on smart_order.freight=smart_basic_freight.title")->order("addtime desc")->select();
		$count3=$order->where("uid=".$userinfo['uid']." and isshouhuo=1 and isquxiao=0")->count();
		$this->assign("count",$count);
		$this->assign("count2",$count2);
		$this->assign("count3",$count3);
		$this->assign("orderlist",$orderlist);
		//dump($orderlist);
		$this->assign("orderlist2",$orderlist2);
		$this->assign("orderlist3",$orderlist3);
		$this->display();
	}
	function orderinfo(){
		$userinfo=$this->userinfo;
		$id=$_GET['id'];
		$order=D('Order');
		$orderinfo=$order->relation(true)->where("id=$id")->find();
		$this->assign("orderinfo",$orderinfo);
		$this->display();	
	}
	function del_order(){
		$userinfo=$this->userinfo;
		$id=$_GET['id'];
		$order=M('Order');
		$data['isquxiao']=1;
		$order->where("id=$id and uid=".$userinfo['uid'])->save($data);
		$pd_fk=$order->where("id=$id and uid=".$userinfo['uid'])->getfield("isfukuan");
		if($pd_fk==0){
			$order_cart=M('OrderCart');
			$list=$order_cart->where("orderid=$id")->select();
			foreach($list as $data_p){
				M("Products")->where("id=".$data_p['productsid'])->setInc('stock',$data_p['productsnum']);
			}
		}
		$this->success("订单删除成功");
	}
	function shouhuo(){
		$userinfo=$this->userinfo;
		$id=$_GET['id'];
		$fahuo=M('fahuo_info');
		$table=M('Order');
		$data['id']=$id;
		$data['uid']=$userinfo['uid'];
		$data['isshouhuo']=1;
		$table->save($data);
		$this->success('确认收货成功');
	}
	function sqtk(){
		$id=$_GET["id"];
		$order=M("Order");
		$info=$order->where("id=".$id)->find();
		$this->assign("info",$info);
		$tuihuo=M('Tuihuo');
		$pd=$tuihuo->where("orderid=$id")->find();
		if($pd){
			$this->error("该订单已申请退款");
		}
		$this->display();
	}
	function tuikuan(){
		$userinfo=$this->userinfo;
		//获取数据
		$data['uid']=$userinfo['uid'];
		$data['orderid']=$_POST['orderid'];
		$data['content']=$_POST['content'];
		$data['typeid']=1;
		$data['title']="申请退款";
		$data['addtime']=time();
		
		//插入退货信息
		$tuihuo=M('Tuihuo');
		$tuihuoinsertid=$tuihuo->add($data);
		$cart=M('order_cart');
		$tuihuo_prolist=M("tuihuo_prolist");
		$cartdata=$cart->where(array('uid'=>$userinfo['uid'],'isdone'=>0,'orderid'=>$data['orderid']))->select();
		//echo $cart->getlastsql();
		//dump($cartdata);
		$newdate=array();
		foreach($cartdata as $key=>$cdata){
			//echo $key;
			$newdata['uid']=$data['uid'];
			$newdata['tuihuoid']=$tuihuoinsertid;
			$newdata['productsid']=$cdata['productsid'];
			$newdata['tuinum']=$cdata['productsnum'];
			$newdata['goumaijia']=$cdata['price'];
			$newdata['photo']=$cdata['photo'];
			$newdata['productsname']=$cdata['productsname'];
			$tuihuo_prolist->add($newdata);
		}
		$this->success('提交申请成功',U('Vip/wddd'));
	}
	//订单结束
}	