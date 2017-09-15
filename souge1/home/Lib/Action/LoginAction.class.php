<?php
// 用户登录页面
class LoginAction extends CommonAction {
	function verify(){
		$type	 =	 isset($_GET['type'])?$_GET['type']:'gif';
        import("@.ORG.Util.Image");
        Image::buildImageVerify(4,1,$type);
    }
	function checklogin(){
		$username = $_POST['username'];
		$password = $_POST['password'];
		if($_POST['rp']==1){
			$password=$_COOKIE["shufeige_p"];
		}else{
			$password=md5($password);
		}
		$user=M('Member');
		$userdata=$user->where("username='".$username."' AND password='".$password."'")->find();
		if ($userdata){
			//更新登陆信息
			cookie('activetime',$userdata['activetime']);
			$user->data(array('activetime'=>time()))->where("id='".$userdata['id']."'")->save();
			$user->where("id='".$userdata['id']."'")->setInc('loginnum',1); 			
			cookie('uid',$userdata['id']);
			cookie('username',$userdata['username']);
			session('istt',1);
			//$this->success('登陆成功',U('Member/index'));
			$this->redirect('User/index');
		}else{
			$this->error('对不起，您的账户或密码出错');
		}
    }
	function logout(){
		$this->clearcookie();
		//$this->success('您已成功退出');
		$this->redirect("Index/index");
	}
	//密码找回
//	function passf(){
//	  $username = $_POST['username'];
//      $eamil = $_POST['eamil'];
//	  $member=M('Member');
//	  $count=$member->where("username='$username' AND eamil='$eamil'")->count();
//	  //echo $count;
//	  if($count>0){
//		$password=rand(100000,999999);
//		$pass=md5($password);
//		$data['password']=$pass;
//		$member->where('username='.'"'.$username.'"')->data($data)->save();
//	    $vo=$this->think_send_mail($_POST['eamil'], $_POST['eamil'], $subject = '裘皮城密码找回', $body = "新密码为：$password");
//		$this->redirect("Login/password_four");
//		}
//		else{
//			$this->error('未注册用户');
//			
//			} 
//		
//		
//	
//	}
	
	function add_user(){
		$data=$_POST;
		if($data['password']!=$data['repassword']){
		  $this->error("两次密码输入不一致");
		}
		if(md5($data['ver'])!=$_SESSION['verify']){
			$this->error("验证码有误");
		}
		$data['password']=md5($data['password']);
		$member=M("Member");
		$count=$member->where("username='".$data['username']."'")->count();
		if($count>0){
		  $this->error("用户名已存在");
		}
		$data['addtime']=time();
		$id=$member->data($data)->add();
		//更新登陆信息
			$member->data(array('activetime'=>time()))->where("id='".$id."'")->save();
			$member->where("id='".$id."'")->setInc('loginnum',1); 			
			cookie('uid',$id);
			cookie('username',$data['username']);
			session('istt',1);
		$this->success("注册成功",U('Vip/welcome'));
	}
}