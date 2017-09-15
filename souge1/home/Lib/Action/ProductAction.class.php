<?php
class ProductAction extends CommonAction {
	function pro_list(){
		$tid=$_GET['tid'];
		$products_and_brand=M("products_and_brand");
		$product_sort=M("product_sort");
		$products=M("Products");
		$sort=$this->get_sortid($tid);
		$brand_list=$products_and_brand->where("sort in (".$sort.")")->select();
		$this->assign("brand_list",$brand_list);
		$hot_pro_list=$products->where("ishot=1 and sort in ($sort)")->order("addtime desc")->limit(5)->select();
		$product_type=M("product_type");
		$type_list=$product_type->where("sortid=$tid")->select();
		//跑步机 按摩椅
		foreach($type_list as $key=>$data){
			$type_list[$key]['pro']=$products->where("sortid_two=".$data['id'])->limit(4)->select();
		}
		$this->assign("new_pro_list",$type_list);
		//商用器材
		if($tid==13){
		$sort=$this->get_sortid(13);
		$syyy_pro_list=$products->where("sort in ($sort)")->order("addtime desc")->limit(4)->select();
		$this->assign("syyy_pro_list",$syyy_pro_list);
		$sort2=$this->get_sortid(114);
		$syll_pro_list=$products->where("sort in ($sort2)")->order("addtime desc")->limit(4)->select();
		$this->assign("syll_pro_list",$syll_pro_list);
		$hot_pro_list=$products->where("ishot=1 and sort in (".$sort.",".$sort2.")")->order("addtime desc")->limit(5)->select();
		}
		//游乐设施
		if($tid==124){
		$sort_list=$product_sort->where("pid=124")->select();
			foreach($sort_list as $k=>$d){
				$sort_list[$k]['pro']=$products->where("sortid=".$d['id'])->select();
			}
		$this->assign("sort_list",$sort_list);
		}
		//商用跑步机
		if($tid==3){
		$sy_pro_list=$products->where("sortid=87")->order("addtime desc")->limit(4)->select();
		$this->assign("sy_pro_list",$sy_pro_list);
		}
		
		$this->assign("hot_pro_list",$hot_pro_list);
		switch($tid){
			case 13:
			$this->display("pro_list_sy");
				break;
			case 124:
			$this->display("pro_list_yl");
				break;
			default:
			$this->display();
				break;
		}
		
	}
	function category(){
		$products=M("Products");
		$list=$products->select();
		$this->assign("list",$list);
		$this->display();
	}
	function product(){
		$id=$_GET['id'];
		$products=M("Products");
		$info=$products->where("id=$id")->find();
		$this->assign("info",$info);
		$attphoto=M("products_attphoto");
		$attlist=$attphoto->where("productsid=$id")->select();
		$this->assign("attlist",$attlist);
		$this->display();
	}



}	