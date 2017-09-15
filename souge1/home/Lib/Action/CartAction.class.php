<?php
class CartAction extends CommonAction {

	function index(){
		$new_list=$this->get_cookie();
		foreach($new_list as $k=>$d){
			$price=$price+$d['vipprice']*$d['cart_num'];
		}
		$this->assign("list",$new_list);
		$this->assign("price",$price);
		$this->display();
	}
	function addtocart(){
		$pid=$_REQUEST["pid"];
		$num=$_REQUEST["num"];
		if(!$num){$num=1;}
		$this->add_cookie($pid,$num);
		$this->display();
	}
	function ajax_delcart(){
		$pid=$_REQUEST["pid"];
		$this->del_cart($pid);
		echo 1;
	}
	function ajax_num(){
		$pid=$_REQUEST["pid"];
		$num=$_REQUEST["num"];
		if(!$num){$num=1;}
		$re=$this->add_cookie($pid,$num);
		if($re==1){
			echo 1;
			die;
		}else{
			echo 2;
			die;
		}
	}
	function get_cookie(){
		$c_pro_list=json_decode(str_replace('\"','"',cookie('pro')),true);
		$product=M("products");
		foreach($c_pro_list as $k=>$d){
			$new_list[$k]=$product->where("id=$k")->find();
			$cart_num=$this->get_cart_num($new_list[$k]['id']);
			$new_list[$k]['cart_num']=$cart_num;
		}
		return $new_list;
	}
	function add_cookie($pid,$num){//添加购物车 更新数量
		//$pid=$_REQUEST["pid"];
		//$num=$_REQUEST["num"];
		$pro[$pid]=$num;
		if(cookie('pro')){
			$cookie=json_decode(str_replace('\"','"',cookie('pro')),true);
			foreach($cookie as $key=>$data){
				if($pid==$key){
					unset($cookie[$key]); 
					$cookie[$key]=$num;
					$new_pro=json_encode($cookie);
				}else{
					$cookie[$pid]=$num;
					$new_pro=json_encode($cookie);
				}
			}
		}else{
			$new_pro=json_encode($pro);
		}
		cookie('pro',$new_pro);
		if( is_array( json_decode(str_replace('\"','"',cookie('pro')),true) ) ){
			return 1;
		}else{
			$this->add_cookie($pid,$num);
		}
	}
	function get_cart_num($pid){
		$cookie=json_decode(str_replace('\"','"',cookie('pro')),true);
		foreach($cookie as $key=>$data){
			if($pid==$key){
				$num=$data;
			}else{
				$num=0;
			}
		}
		return $num;
	}
	function del_cart($pid){
		$cookie=json_decode(str_replace('\"','"',cookie('pro')),true);
		foreach($cookie as $key=>$data){
			if($pid==$key){
				unset($cookie[$key]); 
			}
		}
		$new_pro=json_encode($cookie);
		cookie('pro',$new_pro);
	}
	function ordersettlement(){
		$this->checkuser();	
		$userinfo=$this->userinfo;
		$new_list=$this->get_cookie();
		foreach($new_list as $k=>$d){
			if($d['cart_num']>$d['stock']){
				$this->error($d['name']."超出库存");
			}
			$price=$price+$d['vipprice']*$d['cart_num'];
		}
		$this->assign("price",$price);
		$this->assign("list",$new_list);
		$address=D("MemberAddress");
		$addresslist=$address->relation(true)->where("uid=".$userinfo['uid'])->select();
		$moren_city_id=$address->where(array('uid'=>$myuserinfo['uid'],'ismoren'=>1))->getField('city_id');
		$this->assign("address_list",$addresslist);
		$basicprovince = M('BasicProvince');
	    $provincelist = $basicprovince->where("language='cn'")->select();
	    $this->assign("provincelist",$provincelist);
		$this->display();
	}
	function save_address(){
	  $this->checkuser();	
	  $userinfo=$this->userinfo;
	  $data=$_POST;
	  if(!$data['address']){
		  //$this->error("地址不能为空");
		  echo 9;
		  die;
	  }
	  if(!$data['name']){
		  //$this->error("收货人不能为空");
		  echo 8;
		  die;
	  }
	  if(!$data['mobile'] and !$data['tel']){
		  //$this->error("手机和电话必须填一种！");
		  echo 7;
		  die;
	  }
	  if(!$data['province_id']){
	  	   //$this->error("请选择省份");
		   echo 5;
		   die;
	  }
	  if(!$data['city_id']){
	  	   //$this->error("请选择城市");
		   echo 4;
		   die;
	  }
	  $address=M("MemberAddress");
	  $data['uid']=$userinfo['uid'];
	  $address->data($data)->add();
	  
	  echo 1;
	  die;

	}
	function create_order(){
		$this->checkuser();	
				//生成订单
		$myuserinfo=$this->userinfo;
		$addresss_id=$_POST['address'];
		$table=M('member_address');
		$address_show=$table->where(array('id'=>$addresss_id,'uid'=>$myuserinfo['uid']))->find();
					if(empty($address_show)){
						$this->error('请选择正确的收货地址');
						exit();
					}
		//创建订单
		$order=M('Order');
		$new_list=$this->get_cookie();
		$zongjine=0;
		foreach($new_list as $k=>$d){
			$zongjine=$zongjine+$d['vipprice']*$d['cart_num'];
		}
		$data['freight']=0;
		$data['freightprice']=0;
		$data['weight'] = 0;	
		$data['proprice']=$zongjine;
		if ($new_list){
			$verify=$this->create_rand(10);
			$data['verify']=$verify;
			$data['uid']=$myuserinfo['uid'];
			$data['name']=$address_show['name'];
			$data['province_id']=$address_show['province_id'];
			$data['city_id']=$address_show['city_id'];
			$data['address']=$address_show['address'];
			$data['mobile']=$address_show['mobile'];
			$data['tel']=$address_show['tel'];
			$data['zipcode']=$address_show['zipcode'];
			$data['addtime']=time();
			$insertid=$order->data($data)->add();
			//把老的购物车记录，拷贝至新表
			$order_cart=M('OrderCart');
			foreach($new_list as $k=>$v){
				$data['productsid']=$v['id'];
				$data['photo']=$v['photo'];
				$data['price']=$v['vipprice'];
				$data['productsnum']=$v['cart_num'];
				$data['productsname']=$v['name'];
				$data['orderid']=$insertid;
				//dump($data);
				$order_cart->data($data)->add();
				//echo $order_cart->getlastsql();
				//die;
			}
			cookie('pro',' ');

		}else{
			$this->error('订单已经提交成功或您还未选择商品，正在跳转首页',U('Index/index'));
		}
		//生成订单结束
		$this->redirect("Cart/bank",array("id"=>$insertid));
		
		}
	function bank(){
		$id=$_GET['id'];
		$order=M("Order");
		$info=$order->where("id=".$id)->find();
		$this->assign("info",$info);
		$this->display();
	}
	
}	