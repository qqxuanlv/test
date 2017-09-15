<?php
// 用户登录页面
class OrderAction extends CommonAction {
	
	function _initialize(){
		//获取浏览商品
		$products=M('Products');
		$cook_pro_list=$products->where("id in (0".cookie("pro_id").")")->order("addtime desc")->limit(8)->select();
		$this->assign("cook_pro_list",$cook_pro_list);
		$this->assign("module_name",MODULE_NAME);
		$this->$userinfo=$userinfo=$this->getcookie();
		$this->assign('userinfo',$userinfo);
		if(MODULE_NAME=="Order"){
		  $this->checkuser();	
		}
	}
    function orderjs()
	{
	  $userinfo=$this->userinfo;
	  $cart=M("Cart");
	  $count=$cart->where("uid=".$userinfo['uid'])->count();
	  if($count<=0){
		  $this->error("购物车为空");
		  die;
	  }
	  $cartlist=$cart->where("uid=".$userinfo['uid'])->select();
	  $this->assign("cart_list",$cartlist);
	  $this->cart_sum_function($cartlist);
	  $this->display();
    }

	function ajax_num(){
	  	$userinfo=$this->userinfo;
		$table=M('Cart');
		$data['id']=$_POST['id'];
		$data['productsnum']=$_POST['num'];
		$cinfo=$table->where('id='.$data['id']." and uid=".$userinfo['uid'])->find();
		$product=M("Products");
		$pinfo=$product->where("id=".$cinfo['productsid'])->find();
		
		$a=$table->where('id='.$data['id']." and uid=".$userinfo['uid'])->save($data);
		if($a>=0){
			echo 1;
			die;
		}else{
			echo 2;
			die;
			}
	}
	//统计购物车总价和总数  传入购物车数组
	function cart_sum_function($array){
	 //统计总价 和 总数
	  $sumprice=0;
	  $sumnum=0;
	  foreach($array as $key=>$data){
		  //dump($data);
		  $cartprice=$data['price']*$data['productsnum'];
		  $sumnum=$data['productsnum']+$sumnum;
		  $sumprice=$cartprice+$sumprice;
	  }
	  $this->assign("cart_sumnum",$sumnum);
	  $this->assign("cart_sumprice",$sumprice);
	}
	function delcart(){
		$userinfo=$this->userinfo;
		$table=M('Cart');
		$aid=$_POST['aid'];
		$a=count($aid);
		if($a>=1){
		  foreach($aid as $key=>$data){
			  $table->where('id='.$data." and uid=".$userinfo['uid'])->delete();
		  }
		}else{
		  echo 1;	
		}
		//if($id){
		 //$table->where('id='.$id." and uid=".$userinfo['uid'])->delete();	
		//}
		//$this->success('删除成功');
		//$this->redirect('index');
		
		echo 2;
		}



	function pay_two(){
		$userinfo=$this->userinfo;
		$address=D("MemberAddress");
		$addresslist=$address->relation(true)->where("uid=".$userinfo['uid'])->select();
		$moren_city_id=$address->where(array('uid'=>$myuserinfo['uid'],'ismoren'=>1))->getField('city_id');
		$this->assign("address_list",$addresslist);
		$cart=M("Cart");
		$cartinfo=$cart->where("uid=".$userinfo['uid'])->select();
		if(!$cartinfo){
			$this->error("购物车为空");
		}
		$this->assign("cart_list",$cartinfo);
		$prozongshu=0;
		$zongjine=0;
		$total_weight=0;
		for ($i=0;$i<count($cartinfo);$i++){
			
			$prozongshu=$prozongshu+$cartinfo[$i]['productsnum'];			
			$zongjine=$zongjine+$cartinfo[$i]['productsnum']*$cartinfo[$i]['price'];
			$total_weight+=$cartinfo[$i]['productsnum']*$cartinfo[$i]['weight'];
			
		}
		$this->assign('prozongshu',$prozongshu);
		$this->assign('zongjine',$zongjine);
		$this->assign('total_weight',$total_weight);
		$peisonglist=$this->kdmoneyli($moren_city_id,$total_weight);
		$this->assign("freight_list",$peisonglist);
		$basicprovince = M('BasicProvince');
	    $provincelist = $basicprovince->where("language='cn'")->select();
	    $this->assign("provincelist",$provincelist);
		$this->display();
	}
	function create_order(){
				//生成订单
		$myuserinfo=$this->userinfo;
		
		$addresss_id=$_POST['address'];
		$freight_id=$_POST['freight'];
		$table=M('member_address');
		$address_show=$table->where(array('id'=>$addresss_id,'uid'=>$myuserinfo['uid']))->find();
					if(empty($address_show)){
						$this->error('请选择正确的收货地址');
						exit();
					}
		
		
		
		
		//创建订单
		$cart=M('Cart');
		$order=M('Order');
		$oldcartdata=$cart->where(array('uid'=>$myuserinfo['uid'],'isdone'=>0))->select();
		
		
		$prozongshu=0;
		$zongjine=0;
		
		//$total_weight=0;
		foreach ($oldcartdata as $k=>$v){
			$prozongshu=$prozongshu+$v['productsnum'];
			$zongjine=$zongjine+$v['productsnum']*$v['price'];			
			$total_weight+=$v['productsnum']*$v['weight'];		
		}
		
		$fremolist = $this->kdmoneyli($address_show['city_id'],$total_weight);
		
		foreach($fremolist as $key=>$val){
			if($freight_id==$val['id']){
				$data['freight']=$val['title'];
				$data['freightprice']=$cartdata['freightprice']=$val['sumprice'];
			}
		}
		$data['weight'] = $total_weight;	
		$data['proprice']=$zongjine;
		if ($oldcartdata){
			$verify=$this->create_rand(10);
			$data['verify']=$verify;
			
			$data['uid']=$myuserinfo['uid'];
			//$data['shouhuotime']=$_POST['shouhuotime'];
			$data['name']=$address_show['name'];
			$data['province_id']=$address_show['province_id'];
			$data['city_id']=$address_show['city_id'];
			$data['address']=$address_show['address'];
			$data['mobile']=$address_show['mobile'];
			$data['tel']=$address_show['tel'];
			//$data['email']=$address_show['email'];
			$data['zipcode']=$address_show['zipcode'];
			//$data['language']=$skin;
			
			//$data['payment']=$payment_show['api'];
			
			$data['addtime']=time();
			
			
			
			$insertid=$order->data($data)->add();
			//把老的购物车记录，拷贝至新表
			$order_cart=M('OrderCart');
			
			
			foreach($oldcartdata as $k=>$v){
				$data=$v;
				$data['orderid']=$insertid;
				$data['addtime']=time();
				$order_cart->data($data)->add();
				
			}
			//echo $order_cart->getlastsql();
			
			$cart->where(array('uid'=>$myuserinfo['uid'],'isdone'=>0))->delete();

		}else{
			$this->error('订单已经提交成功或您还未选择商品，正在跳转首页',U('Index/index'));
		}
		//生成订单结束
		$this->redirect("Cart/syt",array("id"=>$insertid));
		
		}
	function syt(){
		$id=$_GET['id'];
		$order=M("Order");
		$info=$order->where("id=".$id)->find();
		$this->assign("info",$info);
		$this->display();
	}
	
	
	function kdmoneyli($cityid=0,$weight=0){
		$freight=M('BasicFreight');
		$frelist=$freight->join("(select freight_id,moren_price as mprice,moren_weight as mweight,xuzhong_price as xprice,xuzhong_weight as xweight from smart_freight_rule_city where smart_freight_rule_city.city_id='".$cityid."') smart_freight_rule_city on smart_freight_rule_city.freight_id = smart_basic_freight.id")->where("")->select();

		$frelist2 = array();
		foreach($frelist as $key=>$val){
			$frelist2[$key]['id'] = $val['id'];
			$frelist2[$key]['title'] = $val['title'];
										
			if($val['mprice'] != ''){
				$frelist2[$key]['moren_price'] = $val['mprice'];
				$frelist2[$key]['moren_weight'] = $val['mweight'];
				$frelist2[$key]['xuzhong_price'] = $val['xprice'];
				$frelist2[$key]['xuzhong_weight'] = $val['xweight'];
			}else{
				$frelist2[$key]['moren_price'] = $val['moren_price'];
				$frelist2[$key]['moren_weight'] = $val['moren_weight'];
				$frelist2[$key]['xuzhong_price'] = $val['xuzhong_price'];
				$frelist2[$key]['xuzhong_weight'] = $val['xuzhong_weight'];	
			}
			
			if($weight<=$frelist2[$key]['moren_weight']){
				$frelist2[$key]['sumprice']= $frelist2[$key]['moren_price'];
			}else{
				$frelist2[$key]['sumprice']= $frelist2[$key]['moren_price'] + ceil(($weight-$frelist2[$key]['moren_weight'])/$frelist2[$key]['xuzhong_weight']) * $frelist2[$key]['xuzhong_price'];
			}
		}
		 //$this->assign('frelist',$frelist2);	
		return $frelist2;
	}
	
	function kdmoney(){
		$cityid = $_POST['cityid'];
		$weight = $_POST['weight'];
		
		$frelist2 =$this->kdmoneyli($cityid,$weight);
		 echo json_encode($frelist2);
	}
	function save_address(){
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
	  $data['tel']=$data['tel1']."-".$data['tel2'];
		$c=strpos($data['tel'],"-");
		$str=substr_replace($data['tel'],"",$c,1); 
	  if(!$data['mobile'] and !$str){
		  //$this->error("手机和电话必须填一种！");
		  echo 7;
		  die;
	  }
	  if(!$data['mobile'] and (!$data['tel1'] or !$data['tel2'])){
		  //$this->error("请将电话输入完整！");
		  echo 6;
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

		  if($data['ismoren']==1){
			$data2['ismoren']=0;
			$address->where("uid=".$userinfo['uid'])->data($data2)->save();
		  }
	  $data['uid']=$userinfo['uid'];
	  $address->data($data)->add();
	  
	  echo 1;
	  die;

	}

	function pay(){
		$myuserinfo=$this->userinfo;
		$oid=$_REQUEST["orderid"];
		$bank_id=$_REQUEST["bank_id"];
		if(!$bank_id){
			$this->error("请选择银行");
		}
		$payment=$_POST["payment"];
		$order=M("Order");
		$orderinfo=$order->where("id=$oid and uid=".$myuserinfo['uid'])->find();
		if($orderinfo){
			$this->assign("orderinfo",$orderinfo);
			$this->assign("bank_id",$bank_id);
			$this->display();
		}else{
			$this->error("该订单已支付");
		}
	}




}	