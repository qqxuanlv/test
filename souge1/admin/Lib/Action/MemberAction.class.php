<?php
class MemberAction extends CommonAction{
	
	public function index(){
		//所有会员
		
		$keyword=$_GET['keyword'];
		if ($keyword){
			$sql1=" AND (username like '%".$keyword."%' OR realname like '%".$keyword."%' OR car like '%".$keyword."%' OR company like '%".$keyword."%' OR mobile like '%".$keyword."%' OR tel like '%".$keyword."%')";
		}
		import('@.ORG.Util.Page');
		$member=D('Member');
		$totalRows=$member->where('1=1'.$sql1)->count();
		$page=new Page($totalRows,10);
		
		$page->setConfig('theme','%totalRow% %header% %upPage% %linkPage% %downPage%');
		$show=$page->show();
		
		$list=$member->relation(true)->order('id desc')->where('1=1'.$sql1)->limit($page->firstRow.','.$page->listRows)->select();
		//echo $member->getLastSql();
		
		$this->assign('list',$list);
		$this->assign('page',$show);
		
		
		$this->display();
	}
	

	
	public function add(){

		

		
		
		$this->display();
	}
	
	public function edit(){

		
		
		$tid=$_GET['tid'];
		$member=M('Member');
		$list=$member->where("id='".$tid."'")->find();
		$this->assign('list',$list);
		
		
		$this->display();
	}
	
	public function addupdate(){
		//添加更新
		
			if($_POST['password']==''){
				$this->error('密码不能为空');
			}elseif($_POST['password']!=$_POST['password2']){
				$this->error('2次输入的密码不一样');
			}else{
	
				
				$member=M('Member');
				$count=$member->where("username='".$_POST['username']."'")->count();
				//echo $member->getLastSql();
				//dump($count);
				
				//exit;
				if ($count==0){
					
					if($vo=$member->create()){
						$member->loginnum=0;
						$member->activetime=$member->addtime=time();
						$member->password=md5($member->password);
						if($member->add()){
							$this->success('用户添加成功');
						}else{
							$this->error('用户添加失败');
						}
						
					}else{
						$this->error($member->getError());
					}
					
					
				}else{
					$this->error('该用户名已存在，请更换');
				}
				
				
				
				
				
			}

		
		
		
	}
	
	public function editupdate(){
		//添加更新
		$tid=$_POST['tid'];
		
		if ($_POST['password']!=$_POST['password2']){
			$this->error('2次输入的密码不一致');
		}
		
		$member=M('Member');
		$count=$member->where("id='".$tid."'")->count();
		
		
		
		if ($count==0){
			$this->error('该用户不存在，不能进行修改');
		}else{
			
			$data=$_POST;
			if ($data['password']!=''){
			$data['password']=md5($data['password']);
			}

			//dump($data);
			//exit;
			if ($member->where("id='".$tid."'")->data($data)->save()){
				$this->success('更新成功');	
			}else{
				$this->error('更新失败');
			}
		}
		
		
		
		
	}
	
	public function del(){
		$tid=$_GET['tid'];
		$member=M('Member');
		$vo=$member->where("id='".$tid."'")->delete();
		//echo $member->getLastSql();
		if($vo){
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		}
	}
	
	
	public function audit(){
		//审核
	}
	//留言
	public function message(){
		$keyword=$_GET['keyword'];
		if ($keyword){
			$sql1=" AND (smart_message.add_uid =$keyword or smart_message.to_uid=$keyword or smart_message.title like '%".$keyword."%')";
		}
		import('@.ORG.Util.Page');
		$member=D('Message');
		
		$totalRows=$member->where('1=1'.$sql1)->count();
		$page=new Page($totalRows,10);
		
		$page->setConfig('theme','%totalRow% %header% %upPage% %linkPage% %downPage%');
		$show=$page->show();
		
		$list=$member->field("*,ifNull(smart_member.toname,'管理员') as toname,ifNull(smart_member2.adname,'管理员') as adname")->join('(select username as toname,id as toid from smart_member) smart_member on smart_member.toid = smart_message.to_uid')->join('(select username as adname,id as adid from smart_member) smart_member2 on smart_member2.adid = smart_message.add_uid')->where('1=1'.$sql1)->limit($page->firstRow.','.$page->listRows)->select();
		//echo $member->getLastSql();
		//print_r($list);
		$this->assign('list',$list);
		$this->assign('page',$show);
		$this->display();
	}
	
	public function messageedit(){
		$tid=$_GET['tid'];
		$member=M('Message');
		$list=$member->where("id='".$tid."'")->find(); 
		$member2=M('Member');
		$list2=$member2->where("id='".$list['add_uid']."'")->find(); 
		$list3=$member2->where("id='".$list['to_uid']."'")->find(); 
		//echo $member2->getLastSql();
		//die;
		$this->assign('list',$list);
		$this->assign('list2',$list2);
		$this->assign('list3',$list3);
		$this->display();
	}
	public function messageeditupdate(){
		//添加更新
		$tid=$_POST['tid'];
		
		
		$member=M('Message');
		$count=$member->where("id='".$tid."'")->count();
		
		
		
		if ($count==0){
			$this->error('该留言不存在，不能进行修改');
		}else{
			$adusername=$_POST['add_uid'];
			$tousername=$_POST['to_uid'];
			$member2=M('Member');
			$list2=$member2->where("username='".$adusername."'")->limit(1)->getField('id'); 
			$list3=$member2->where("username='".$tousername."'")->limit(1)->getField('id'); 
			if($adusername==0 or $adusername=="管理员"){
				
					$data['add_uid']=0;
					
			}else{
					if(empty($list2)){
						$this->error('发件人不存在，不能进行修改');
						}
						$data['add_uid']=$list2['id'];
				}
			if($tousername==0 or $tousername=="管理员"){
				
					$data['to_uid']=0;

			}else{
					if(empty($list3)){
						$this->error('收件人不存在，不能进行修改');
						}
						$data['to_uid']=$list3['id'];
				}
			
			
			$data['title']=$_POST['title'];
			$data['content']=$_POST['content'];
			$data['is_sys']=$_POST['is_sys'];
			$data['is_read']=$_POST['is_read'];
			if ($member->where("id='".$tid."'")->data($data)->save()){
				$this->success('更新成功');	
			}else{
				$this->error('更新失败');
			}
		}
	}
	public function messagedel(){
		$tid=$_GET['tid'];
		$member=M('Message');
		$vo=$member->where("id='".$tid."'")->delete();
		//echo $member->getLastSql();
		if($vo){
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		}
	}	
		public function messageadd(){
		$this->display();
	}
	//群体发送 群发
	public function messageqf(){
		$tid=$_GET['tid'];
		$message=D('Message');
		$list=$message->where("id='".$tid."'")->find(); 	
		$user = M("Member")->field("id")->select();
		foreach($user as $key=>$val){
			$vo=$message->add(array('add_uid'=>'0','to_uid'=>$val['id'],'title'=>$list['title'],'content'=>$list['content'],'addtime'=>time(),'is_sys'=>1,'is_read'=>0));
		}
		if($vo){
			$this->success('群发成功');
		}else{
			$this->error('群发失败');
		}
	}
	public function messageaddupdate(){
		//添加更新
				$member=M('Message');
					if($vo=$member->create()){
						$adusername=$_POST['add_uid'];
						$tousername=$_POST['to_uid'];
						$member2=M('Member');
						$list2=$member2->where("username='".$adusername."'")->limit(1)->getField('id'); 
						$list3=$member2->where("username='".$tousername."'")->limit(1)->getField('id'); 
						if($adusername==0 or $adusername=="管理员"){
							
								$member->add_uid==0;
								
						}else{
								if(empty($list2)){
									$this->error('发件人不存在，不能进行添加');
									}
									$member->add_uid=$list2['id'];
							}
						if($tousername==0 or $tousername=="管理员"){
							
								$member->to_uid=0;
			
						}else{
								if(empty($list3)){
									$this->error('收件人不存在，不能进行添加');
									}
									$member->to_uid=$list3['id'];
							}
						
						$member->title=$_POST['title'];
						$member->content=$_POST['content'];
						$member->addtime=time();
						$member->is_sys=$_POST['is_sys'];
						$member->is_read=$_POST['is_read'];
						if($member->add()){
							$this->success('留言添加成功');
						}else{
							$this->error('留言添加失败');
						}
						
					}else{
						$this->error($member->getError());
					}
					
	}
	public function role(){
		//角色管理
		import('@.ORG.Util.Page');
		$role=M('sys_role');
		$totalRows=$role->count();
		$page=new Page($totalRows,10);
		$page->setConfig('theme','%totalRow% %header% %upPage% %linkPage% %downPage%');
		$show=$page->show();
		$list = $role->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign('list',$list);
		$this->display();
		}
	public function roleadd(){
		//角色管理
        $this->display();
		}
	public function roleaddupdate(){
		//角色管理
		$post=$_POST;
		if($post['name']==""){
			$this->error('角色名不能为空');
			die;
			}
		$role=M('sys_role');
		$data['name'] = $post['name'];
		$data['remark'] = $post['remark'];
		$pd=$role->add($data);
			if($pd){
				$this->success('角色添加成功');
			}else{
				$this->error('角色添加失败');
			}
		}
	public function roleedit(){
		//角色管理
		$id=$_GET['tid'];
		$role=M('sys_role');
		$list = $role->where("id=$id")->find();
		$this->assign('list',$list);
		$this->display();
		}
	public function roleeditupdate(){
		//角色管理
		$post=$_POST;
		if($post['name']==""){
			$this->error('角色名不能为空');
			die;
			}
		$id=$post['tid'];
		$role=M('sys_role');
		$data['name'] = $post['name'];
		$data['remark'] = $post['remark'];
		$pd=$role->where("id=$id")->data($data)->save(); 
			if($pd){
				$this->success('角色编辑成功');
			}else{
				$this->error('角色编辑失败');
			}
		}
	public function roledel(){
		//角色管理
		$id=$_GET['tid'];
		if($id=='1'){
			$this->error('管理员不能删除');
			}
		$role=M('sys_role');
		$pd=$role->where("id=$id")->delete(); 
			if($pd){
				$this->success('角色删除成功');
			}else{
				$this->error('角色删除失败');
			}
		}
	public function power(){
		//角色权限
		$id=$_GET['tid'];
//			if($id==1){
//				$this->error('这是管理员，不给你设置权限');
//			}
		$role=M('sys_role');
		$list = $role->where("id=$id")->find();
		$this->assign('list',$list);
		$menu=M('sys_menu');
		$menulist = $menu->where("rolenumber<>''")->select();
		$this->assign('menulist',$menulist);
        $this->display();
		}
	public function sort(){
		$sort=D('MemberMenu');
		$list=$sort->select();
		$sortlist=$this->toTree($list);
		$this->assign('list',$sortlist);
		$tid=$_GET['tid'];
		$show=$sort->where("id='".$tid."'")->find();
		$this->assign('show',$show);
		$this->display();
		}
	function sortupdate(){
		$sort=M('MemberMenu');
		$data=$_POST;
		if ($data['id']){
			$sort->data($data)->save();
			$this->success('修改成功');
		}else{
			$sort->data($data)->add();
			$this->success('新增成功');
		}
	}
	function sortdel(){
	
		$tid=$_GET['tid'];
		$news=M('MemberMenu');
			if ($news->where("id='".$tid."'")->delete()){

				$this->success('删除成功');
			}else{
				$this->error('删除失败');
			}

	}
		
function hydc(){
	$rq=$_POST["rq"];
	$shijian=time();
	switch($rq){
		case 1:
		$where="";
		break;
		case 2:
		$where="($shijian-activetime)>=7*86400";
		break;
		case 3:
		$where="($shijian-activetime)>=15*86400";
		break;
		case 4:
		$where="($shijian-activetime)>=30*86400";
		break;
	}
	$member=M('Member');
	$list=$member->where($where)->select();
	$this->assign('hydc',$list);
    $this->display();
	
	}	
	function company_shenhe(){
		import('@.ORG.Util.Page');
		$member=M('MemberCompany');
		$totalRows=$member->count();
		$page=new Page($totalRows,10);
		$page->setConfig('theme','%totalRow% %header% %upPage% %linkPage% %downPage%');
		$show=$page->show();
		$list=$member->field("smart_member_company.*,smart_member.name,smart_member.username")->join("smart_member on smart_member.id=smart_member_company.uid")->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
		//echo $member->getLastSql();
		
		$this->assign('list',$list);
		$this->assign('page',$show);
		$this->display();
	}	
	function edit_shen_com(){
	$data['id']=$_GET['tid'];
	$data['isshenhe']=$_GET['status'];
	$products=M('MemberCompany');
	$products->save($data);
	$this->success("操作成功");
	}
	function del_com(){
		$tid=$_GET['tid'];
		$products=M('MemberCompany');
		$status=$products->where("uid=$tid")->delete();

		if ($status){
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		}	
	}
	
}