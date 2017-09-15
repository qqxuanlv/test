<?php
class BasicAction extends CommonAction{

	function index(){
		
		
		
		
		//网站基本资料
		$basic=M('Basic');
		$show=$basic->where('id=1')->find();
		$this->assign('show',$show);
		
		
		
		
		$this->display();
		
	
	}
	
	function update(){
	
		
		$basic=M('Basic');
		$basic->create();
		
		$basic->where(array('id'=>1))->save();
		//echo $basic->getLastSql();
		//exit();
		$this->success('修改成功');
	
	}
	
	function password(){
		//账户信息

		
		
		
		
		$this->display();
	}
	
	function editpwd(){
		$pwd1=$_POST['pwd1'];
		$pwd2=$_POST['pwd2'];
		
		if($pwd1==''){
			$this->error('密码不能为空');
		}
		if(strlen($pwd1)<6){
			$this->error('密码不能小于6位');
		}

		if ($pwd1==$pwd2){
			$account=M('SysUser');
			$uid=$_SESSION['authId'];
			$data['uid']=$uid;
			$data['password']=md5($pwd1);
			$vo=$account->data($data)->save();
			if($vo){
				$this->success('密码修改成功');
			}else{
				$this->error('密码未修改');
			}
			
		
		}else{
			$this->error('2次输入的密码不一致');
		}
		

	}
	
	function api(){
		$table=M('api');
		$list=$table->select();
		$this->assign('list',$list);
		$this->display();
	}
	
	function api_update(){
		$table=M('api');
		$table->create();
		$table->save();
		$this->success('修改成功',U('api'));
	}
	
	
	function freight(){
		$table=M('basic_freight');
		$list=$table->select();
		$this->assign('list',$list);
		//print_r($list);
		$this->display();
	}
	
	function freight_update(){
		$table=M('basic_freight');
		if($_POST['id']){
			$table->create();
			$table->save();
			$this->success('修改成功',U('freight'));
		}else{
			$table->create();
			$table->add();
			$this->success('添加成功',U('freight'));
		}
		
		
	}
	
	function freight_del(){
		$id=$_GET['tid'];
		$table=M('basic_freight');
		$table->where(array('id'=>$id))->delete();
		
		
		$table=M('freight_rule');
		$table->where(array('freight_id'=>$id))->delete();
		
		
		$table=M('freight_rule_city');
		$table->where(array('freight_id'=>$id))->delete();
		
		$this->success('删除成功',U('freight'));
	}
	
	function freight_add(){
		$this->display();
	}
	
	function freight_city(){
		
		
		
		
		//获取所有城市
		$table=M('basic_province');
		$list=$table->order('id')->select();
		$table=M('basic_city');
		foreach($list as $k=>$v){
			$list[$k]['_child']=$table->field('id,title')->order('orderby')->where(array('pid'=>$v['id']))->select();
		}
		$this->assign('page_list',$list);
		
		
		
		
		
		$freight_id=$_GET['tid'];
		$rule_id=$_GET['id'];
		
		$table=M('freight_rule_city');
		
		//获取该规则已经选择的城市
		if($rule_id){
			
			
			
			
			
			$where=array('freight_id'=>$freight_id,$rule_id=>$rule_id);
			$where2=array('freight_id'=>$freight_id,'rule_id'=>array('neq',$rule_id));
			$list=$table->where(array('rule_id'=>$rule_id))->field('city_id')->select();
			$this->assign('selected_list',$list);
			//echo $table->getLastSql();
			
			
			
			$freight_rule=M('freight_rule');
			$rule_show=$freight_rule->where(array('id'=>$rule_id))->find();
			$this->assign('rule_show',$rule_show);
			
			
		}else{
			$where2=array('freight_id'=>$freight_id);
		}
		//获取不能选的城市
		
		
		$list=$table->where($where2)->field('city_id')->select();
		//echo $table->getLastSql().'<br />';
		$this->assign('disabled_list',$list);
		
		$this->display();
		
	}
	
	function freight_city_rule(){
		$tid=$_GET['tid'];
		//获取快递方式
		$table=M('basic_freight');
		$show=$table->where(array('id'=>$tid))->find();
		$this->assign('show',$show);
		//获取规则
		
		$table=M('freight_rule');
		$list=$table->where(array('freight_id'=>$tid))->select();
		$this->assign('list',$list);
		
		//echo $table->getLastSql();
		//dump($list);
		$this->display();
	}
	
	function freight_city_rule_update(){
		
		$rule_id=$_POST['rule_id'];
		$city_id=$_POST['city_id'];
		
		$freight_id=$_POST['freight_id'];
		$moren_price=$_POST['moren_price'];
		$moren_weight=$_POST['moren_weight'];
		$xuzhong_price=$_POST['xuzhong_price'];
		$xuzhong_weight=$_POST['xuzhong_weight'];
		
		
		$table=M('freight_rule');
		$table->create();
		if(empty($table->title)){
			$this->error('对不起，标题不能为空');
			exit();
		}
		if(empty($table->moren_weight)){
			$this->error('对不起，默认运费不能为空');
			exit();
		}
		if(empty($table->moren_price)){
			$this->error('对不起，默认运费不能为空');
			exit();
		}
		if(empty($table->xuzhong_weight)){
			$this->error('对不起，续重不能为空');
			exit();
		}
		if(empty($table->xuzhong_price)){
			$this->error('对不起，续重不能为空');
			exit();
		}
		if(empty($city_id)){
			$this->error('至少选择一个城市');
			exit();
		}
		
		$freight_rule_city=M('freight_rule_city');
		if($rule_id){
			$table->where(array('id'=>$rule_id))->save();
			$freight_rule_city->where(array('rule_id'=>$rule_id))->delete();
			
		}else{
			$rule_id=$table->add();
			
			
		}
		
		foreach($city_id as $v){
				$freight_rule_city->data(array(
					'rule_id'=>$rule_id,
					'freight_id'=>$freight_id,
					'city_id'=>$v,
					'moren_price'=>$moren_price,
					'moren_weight'=>$moren_weight,
					'xuzhong_price'=>$xuzhong_price,
					'xuzhong_weight'=>$xuzhong_weight		
				))->add();
		}
		$this->success('操作成功');
		
		
	}
	
	
	function email_config(){
	
		$table=M('email_config');
		$show=$table->where(array('id'=>1))->find();
		$this->assign('show',$show);
		$this->display();
		
	}
	
	function email_config_update(){
		$table=M('email_config');
		$table->create();
		$table->save();
		
		if($_POST['test_on']=='yes'){
		
			$show=$table->where(array('id'=>1))->find();
			
			$vo=$this->think_send_mail($_POST['test_email'], $_POST['test_email'], $subject = '测试标题', $body = '测试内容');
		
			($vo	==1)? $this->success('测试邮件发送成功')	:	$this->error($vo);
		}else{
			$this->success('修改成功');
		}
		
		
		
		
	}
	
	function price(){
		$table=M('basic_price');
		$list=$table->select();
		$this->assign('list',$list);
		
		$this->display();
	
	}
	function price_update(){
		$table=M('basic_price');
		if($_POST['id']){
			$table->create();
			$table->save();
			$this->success('修改成功');
		}else{
			$table->create();
			$table->add();
			$this->success('添加成功');
		}
		
		
	}
	
	function bank(){
		
		$table=M('basic_bank');
		$list=$table->select();
		$this->assign('list',$list);
		
		
		
		$this->display();
	
	}
	
	function bank_update(){
	
		
		$id=$_POST['id'];
		$table=M('basic_bank');
		$table->create();
		if($id){
			$table->where(array('id'=>$id))->save();
			$this->success('修改成功');
		}else{
			$table->add();
			$this->success('添加成功');
		}
	
	}
	
	function bank_del(){
	
		$id=$_GET['tid'];
		$table=M('basic_bank');
		$table->where(array('id'=>$id))->delete();
		$this->success('删除成功');
		
	}
	function flink(){
		$table=M('Flink');
		$list=$table->select();
		$this->assign('list',$list);
		//print_r($list);
		$this->display();
	}
	
	function flink_update(){
		$table=M('Flink');
		if($_POST['id']){
			$table->create();
			$table->save();
			$this->success('修改成功',U('flink'));
		}else{
			$table->create();
			$table->add();
			$this->success('添加成功',U('flink'));
		}
		
		
	}
	
	function flink_del(){
		$id=$_GET['tid'];
		$table=M('Flink');
		$table->where(array('id'=>$id))->delete();
		$this->success('删除成功',U('flink'));
	}
	
	function flink_add(){
		$this->display();
	}
	

}