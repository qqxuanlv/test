<?php


class PublicAction extends Action {
	// 检查用户是否登录


	// 用户登录页面
	public function login() {
		
		if(!isset($_SESSION[C('USER_AUTH_KEY')])) {
			$this->display();
		}else{
			$this->redirect('Index-index');
		}
	}

	public function index()
	{
		//如果通过认证跳转到首页
		$this->main();
		redirect(__APP__);
	}

	// 用户登出
    public function logout()
    {
        if(isset($_SESSION[C('USER_AUTH_KEY')])) {
			unset($_SESSION[C('USER_AUTH_KEY')]);
			unset($_SESSION);
			session_destroy();
            $this->assign("jumpUrl",U('Public/login'));
            $this->success('登出成功！');
        }else {
            $this->error('已经登出！');
        }
    }

	// 登录检测
	public function checklogin() {
		
		if(empty($_POST['username'])) {
			$this->error('帐号错误！');
		}elseif (empty($_POST['password'])){
			$this->error('密码必须！');
		}elseif (empty($_POST['verify'])){
			$this->error('验证码必须！');
		}
        //生成认证条件
        $map            =   array();
		// 支持使用绑定帐号登录
		$map['username']	= $_POST['username'];
        //$map["status"]	=	array('gt',0);
		if($_SESSION['verify'] != md5($_POST['verify'])) {
			$this->error('验证码错误！');
		}
		import ( '@.ORG.Util.RBAC' );
		
        $authInfo = RBAC::authenticate($map);
        
        //dump($map);
        //dump($authInfo);
        //exit;
        
        //使用用户名、密码和状态的方式进行认证
        if(false === $authInfo) {
            $this->error('帐号不存在或已禁用！');
        }else {
        	
            if($authInfo['password'] != md5($_POST['password'])) {
            	$this->error('密码错误！');
            }
            $_SESSION[C('USER_AUTH_KEY')]	=	$authInfo['uid'];
            $_SESSION['email']	=	$authInfo['email'];
            $_SESSION['lastlogintime']		=	$authInfo['lastlogintime'];
			$_SESSION['username']		=	$authInfo['username'];
            if($authInfo['username']=='admin') {
            	$_SESSION['administrator']		=	true;
            }
            //保存登录信息
			$User	=	M('Members');
			
			$ip		=	get_client_ip();
			$time	=	time();
            $data = array();
			$data['uid']	=	$authInfo['uid'];
			$data['username']	=	$authInfo['username'];
			$data['lastlogintime']	=	$time;

			$User->save($data);

			// 缓存访问权限
            RBAC::saveAccessList();
			$this->success('登录成功！',U('Index/index'));

		}
	}
    // 更换密码
    public function changePwd()
    {
		$this->checkUser();
        //对表单提交处理进行处理或者增加非表单数据
		if(md5($_POST['verify'])	!= $_SESSION['verify']) {
			$this->error('验证码错误！');
		}
		$map	=	array();
        $map['password']= pwdHash($_POST['oldpassword']);
        if(isset($_POST['account'])) {
            $map['account']	 =	 $_POST['account'];
        }elseif(isset($_SESSION[C('USER_AUTH_KEY')])) {
            $map['id']		=	$_SESSION[C('USER_AUTH_KEY')];
        }
        //检查用户
        $User    =   M("User");
        if(!$User->where($map)->field('id')->find()) {
            $this->error('旧密码不符或者用户名错误！');
        }else {
			$User->password	=	pwdHash($_POST['password']);
			$User->save();
			$this->success('密码修改成功！');
         }
    }
	public function profile() {
		
		$User	 =	 M("User");
		$vo	=	$User->getById($_SESSION[C('USER_AUTH_KEY')]);
		$this->assign('vo',$vo);
		$this->display();
	}
	public function verify(){
		$type	 =	 isset($_GET['type'])?$_GET['type']:'gif';
        import("@.ORG.Util.Image");
        Image::buildImageVerify(4,1,$type);
    }

    
    // 修改资料
	public function change() {
		
		$User	 =	 D("User");
		if(!$User->create()) {
			$this->error($User->getError());
		}
		$result	=	$User->save();
		if(false !== $result) {
			$this->success('资料修改成功！');
		}else{
			$this->error('资料修改失败!');
		}
	}
	
	
	public function clear(){
		unset($menu,$_SESSION['menu'.$_SESSION[C('USER_AUTH_KEY')]]);
		unset($menu2,$_SESSION['menu2'.$_SESSION[C('USER_AUTH_KEY')]]);
		echo '成功清理缓存';
		
	}
	


	
	
	public function city(){
		$city=M('City');
		$list=$city->where('id=pid')->order('pid,level,orderby asc')->select();
		return $list;
		
	}
	public function area($pid){
		$city=M('City');
		$list=$city->where("pid!=id AND pid='".$pid."'")->order('pid,level,orderby asc')->select();
		return $list;
	}
	
	public function cityjs(){
		//输出2级级联菜单
		//注意，表单name一定要=queryActionForm
		$js="<SCRIPT language=javascript >
cateIDList = new Array();
var provIndex = -1;
var cateIDIndex;
function newProv(){
  provIndex++;
  cateIDList[provIndex] = new Array();
  cateIDIndex = 0;
}

function addCateID( cateID, value ) {
  cateIDList[provIndex][cateIDIndex] = new aCateID(cateID, value);
  cateIDIndex++;
}

function aCateID( text, value ) {
  this.text = text;
  this.value = value;
}

function updatecateIDs( ar, topic, classIDvalue ) {
  //initcateIDs ( );
  with (ar) {
    newProvs = cateIDList[topic].length;
    oldTopics = options.length;

    // add new cateIDs to the menu
    for ( i=0; i<newProvs; i++ ) {
      options[i] = new Option( cateIDList[topic][i].text,cateIDList[topic][i].value );
     //options[i].selected = cateIDList[topic][i].value.substring ( 0, 7 ).toLowerCase ( ) == classIDvalue.substring ( 0, 7 ).toLowerCase ( );
        
                if ( cateIDList[topic][i].value == classIDvalue )
                {
                        options[i].selected = true;        
                }
    }

   // remove any left from previous menu
    for ( i=oldTopics-1; i>=newProvs; i-- ) {
     options[i] = null;
   }

    if ( classIDvalue == '' )
        {
                options[0].selected = true;
        }
  }
}

function initcateIDs ( )
{
		";
		$city=$this->city();
		for($i=0;$i<count($city);$i++){
			
			$txt=$txt. 'newProv();'."\n";
			$area=$this->area($city[$i]['id']);
			for($j=0;$j<count($area);$j++){
				$txt=$txt. 'addCateID("'.$area[$j]['title'].'", "'.$area[$j]['id'].'");'."\n";
			}
		}
		$js2="}


</SCRIPT>";
		$js3="<SCRIPT >
        document.writeln ('<select size = '1' name = 'CateID' onchange = 'updatecateIDs ( ClassID, this.selectedIndex, \'\' )'>',17 );";
		for($i=0;$i<count($city);$i++){
			$txt2=$txt2."document.writeln('<option value = '1'>苏州</option>');";
		}

        //document.writeln('<option value = "2" selected>昆山</option>');
        $js4="document.writeln ('</select>');
        document.writeln('<select name = 'ClassID'></select>');
        initcateIDs();
        updatecateIDs(document.queryActionForm.ClassID, document.queryActionForm.CateID.selectedIndex,'17');
</SCRIPT> ";
        echo '<form action=""  name="queryActionForm" id="queryActionForm" method=get >';
		echo $js.$txt.$js2.$js3.$txt2.$js4;
		echo '</form>';
		
	}
}
?>