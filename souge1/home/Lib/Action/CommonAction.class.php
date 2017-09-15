<?php
header('Content-Type:text/html;charset=utf-8');
class CommonAction extends Action{
static $userinfo;
	public function _initialize(){
		//获取网站基本配置
		//生成网站cookie
		$guestid=cookie('guestid');
		if(empty($guestid)){
			cookie('guestid',uniqid());
		}
		$this->$userinfo=$userinfo=$this->getcookie();
		$this->assign('userinfo',$userinfo);
		//dump($userinfo);
		if(MODULE_NAME=="Vip"){
		  $this->checkuser();	
		}
		$this->assign("module_name",MODULE_NAME);
		$this->assign("menu_sort",$this->get_menu_sort());
		$this->menu();	
	}

	function seo(){
		$table=M("Basic");
		$info=$table->field("title,keyword,description")->where("id=1")->find();
		//dump($info);
		$title=$info['title'];
		$keywords=$info['keyword'];
		$description=$info['description'];
		$this->assign("title",$title);
		$this->assign("keywords",$keywords);
		$this->assign("description",$description);
	}
	function get_menu_sort(){
		//构建导航
		$products_and_brand=M("products_and_brand_jz");
		$product_sort=M("ProductSort");
		$menu_list=$product_sort->where("pid=1")->select();
		foreach($menu_list as $key=>$data){
			$menu_list[$key]['child']=$product_sort->order("orderby desc")->where("pid=".$data['id'])->select();
			foreach($menu_list[$key]['child'] as $k=>$d){
				$menu_list[$key]['child'][$k]['brand']=$products_and_brand->where("sort=".$d['id'])->limit(8)->select();
			}
		}
		//$this->assign("menu_list",$menu_list);
		return $menu_list;
	}
	function get_sortid($tid){
		$product_sort=M("ProductSort");
		$sortlist=$product_sort->select();
		$sort=$tid;
		foreach($sortlist as $data){
			$path_arr=explode("-",$data['path']);
			if(in_array($tid,$path_arr)>0){
			$sort.=",".$data['id'];
			}
		}
		return $sort;
	}
	function menu(){
		$table=M("ProductSort");
		$list1=$table->where("pid=1")->select();
		$this->assign('menu_sort_list',$list1);
		$probrand=M("products_and_brand");
		$brand_list=$probrand->where('pid=0')->select();
		$this->assign('menu_brand_list',$brand_list);
		$this->banner();
	}
	function banner(){
		$table=M("album_photo");
		$banner=$table->where("albumid=1")->select();
		$zx_banner=$table->where("albumid=2")->select();
		$zz_banner=$table->where("albumid=3")->select();
		$cp_banner=$table->where("albumid=4")->find();
		//$xl_banner=$table->where("albumid=5")->select();
		$sy_banner=$table->where("albumid=6")->order('orderby asc')->limit(7)->select();
		$tj_banner=$table->where("albumid=7")->order('addtime desc')->select();
		$this->assign("sys_banner",$banner);
		$this->assign("sys_zx_banner",$zx_banner);
		$this->assign("sys_zz_banner",$zz_banner);
		$this->assign("sys_cp_banner",$cp_banner);
		//$this->assign("sys_xl_banner",$xl_banner);
		$this->assign("sys_sy_banner",$sy_banner);
		$this->assign("sys_tj_banner",$tj_banner);
	}
	public function citylist(){
		//$skin=THEME_NAME;
		//if($skin=='en'){
			//$language="language='en' and ";
			//}else{
				$language="language='cn' and ";
				//}
		$basicprovince = M('BasicCity');
		$citylist = $basicprovince->where($language."pid='".$_POST['id']."'")->select();
		$returnstr = "";
		foreach($citylist as $key=>$val){
			$returnstr .= "<option value='".$val['id']."'>".$val['title']."</option>";
		}
		
		echo $returnstr;
	}



	public function checkuser($url1){
		$myuserinfo=$this->userinfo;
		//print_r($myuserinfo);
		//die;
		if ($myuserinfo['uid']==''||$myuserinfo['username']==''||$myuserinfo['istt']!=1){
			
			//echo $url1;
			echo "<? header('Content-Type:text/html;charset=utf-8'); ?>";
			echo '<script language="javascript" type="text/javascript">';
			echo 'alert("正在跳转登陆");';
           	//echo 'window.location.href="'.U('User/login',array('lasturl'=>urlencode(__SELF__))).'"';
			echo 'window.location.href="'.U('Login/login').'"';
    		echo '</script>';

		}
		
		
		
	}
	
	
	public function setcookie($uid,$username){
            cookie('uid',222);
			cookie('username',3333);
    }
	public function clearcookie(){
			cookie('uid',null);
			cookie('username',null);
			session('istt',null);
			cookie('activetime',null);
    }
    
	public function getcookie(){
		$userinfo = array();
			$userinfo['guestid']=cookie('guestid');
			$userinfo['uid']=cookie('uid');
			$userinfo['username']=cookie('username');
			$userinfo['istt']=session('istt');
			$userinfo['activetime']=cookie('activetime');
		return $userinfo;

    }

    
	function toTree($list=null, $pk='id', $pid = 'pid', $child = '_child', $root=0)
	{
	    $tree = array();
	    if (is_array($list))
	    {
	        $refer = array();
	        foreach ($list as $key => $data)
	        {
	            $refer[$data[$pk]] = & $list[$key];
	        }
	        foreach ($list as $key => $data)
	        {
	            // 判断是否存在parent
	            $parentId = $data[$pid];
	            if ($root == $parentId)
	            {
	                $tree[] = & $list[$key];
	            }
	            else
	            {
	                if (isset($refer[$parentId]))
	                {
	                    $parent = & $refer[$parentId];
	                    $parent[$child][] = & $list[$key];
	                }
	            }
	        }
	    }
	    return $tree;
	}    
	function think_send_mail($to, $name, $subject = '', $body = '', $attachment = null){
	    
	    $table=M('email_config');
	    $config=$table->where(array('id'=>1))->find();
	    
	    require_once EXTEND_PATH.'Vendor/phpmailer/class.phpmailer.php';



		$mail=new PHPMailer();

	    $mail->CharSet    = 'UTF-8'; //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
	    $mail->IsSMTP();  // 设定使用SMTP服务
	    $mail->SMTPDebug  = 0;                     // 关闭SMTP调试功能
	                                               // 1 = errors and messages
	                                               // 2 = messages only
	    $mail->SMTPAuth   = $config['smtp_auth'];                  // 启用 SMTP 验证功能
	    $mail->SMTPSecure = $config['smtp_secure'];                 // 使用安全协议
	    $mail->Host       = $config['smtp_host'];  // SMTP 服务器
	    $mail->Port       = $config['smtp_port'];  // SMTP服务器的端口号
	    $mail->Username   = $config['smtp_user'];  // SMTP服务器用户名
	    $mail->Password   = $config['smtp_pass'];  // SMTP服务器密码
	    $mail->SetFrom($config['from_email'], $config['from_name']);
	    $replyEmail       = $config['reply_email']?$config['reply_email']:$config['from_email'];
	    $replyName        = $config['reply_name']?$config['reply_name']:$config['from_name'];
	    $mail->AddReplyTo($replyEmail, $replyName);
	    $mail->Subject    = $subject;
	    $mail->MsgHTML($body);
	    $mail->AddAddress($to, $name);
	    if(is_array($attachment)){ // 添加附件
	        foreach ($attachment as $file){
	            is_file($file) && $mail->AddAttachment($file);
	        }
	    }
	    //return $mail->Send() ? true : $mail->ErrorInfo;
	    return $mail->Send() ? 1 : 2;

	}
	protected function create_rand($len){ 
	    $chars = array( 
	        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k',  
	        'l', 'm', 'n', 'p', 'q', 'r', 's', 't', 'u', 'v',  
	        'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G',  
	        'H', 'I', 'J', 'K', 'L', 'M', 'N', 'P', 'Q', 'R',  
	        'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '1', '2',  
	        '3', '4', '5', '6', '7', '8', '9'
	    ); 
	    $charsLen = count($chars) - 1; 
	    shuffle($chars);
	    $output = ""; 
	    for ($i=0;$i<$len;$i++){ 
	        $output .= $chars[mt_rand(0,$charsLen)]; 
	    } 
	    return $output;  
	} 

	
}