<?php

class CommonAction extends Action {
	


    function _initialize() {
        import('@.ORG.Util.Cookie');
        // 用户权限检查
        if (C('USER_AUTH_ON') && !in_array(MODULE_NAME, explode(',', C('NOT_AUTH_MODULE')))) {
            import('@.ORG.Util.RBAC');
            if (!RBAC::AccessDecision()) {
                //检查认证识别号
                if (!$_SESSION [C('USER_AUTH_KEY')]) {
                    //跳转到认证网关
                    redirect(PHP_FILE . C('USER_AUTH_GATEWAY'));
                }
                // 没有权限 抛出错误
                if (C('RBAC_ERROR_PAGE')) {
                    // 定义权限错误页面
                    redirect(C('RBAC_ERROR_PAGE'));
                } else {
                    if (C('GUEST_AUTH_ON')) {
                        $this->assign('jumpUrl', PHP_FILE . C('USER_AUTH_GATEWAY'));
                    }
                    // 提示错误信息
                    $this->error(L('_VALID_ACCESS_'));
                }
            }
        }
        //获取公共部分
		//设置一些输出模板的通用配置

		$this->menu();
		$this->menu2();

		


		

        
    }
    
    
	// 菜单页面
	public function menu() {
        
        
        if(isset($_SESSION[C('USER_AUTH_KEY')])) {
            //显示菜单项
            
            $menu  = array();
            if(isset($_SESSION['menu'.$_SESSION[C('USER_AUTH_KEY')]])) {
			
                //如果已经缓存，直接读取缓存
                $menu   =   $_SESSION['menu'.$_SESSION[C('USER_AUTH_KEY')]];
                
            }else {
                //读取数据库模块列表生成菜单项
                $node    =   M("SysNode");
				$id	=	$node->getField("id");
				$where['level']=2;
				$where['status']=1;
				$where['pid']=$id;
                $list	=	$node->where($where)->field('id,pid,name,title')->order('orderby asc,id')->select();
                //echo $node->getLastSql();
                
                $accessList = $_SESSION['_ACCESS_LIST'];
                foreach($list as $key=>$module) {
                     if(isset($accessList[strtoupper(APP_NAME)][strtoupper($module['name'])]) || $_SESSION['administrator']) {
                        //设置模块访问权限
                        $module['access'] =   1;
                        $menu[$key]  = $module;
                    }
                }
                //缓存菜单访问
                $_SESSION['menu'.$_SESSION[C('USER_AUTH_KEY')]]	=	$menu;
            }
            if(!empty($_GET['tag'])){
                $this->assign('menuTag',$_GET['tag']);
            }
       
			
            $this->assign('menu',$menu);
		}
		
		
	}
    

	//2级菜单
	public function menu2() {
		
		$node    =   M("SysNode");
		$navinfo=$node->where(array('pid'=>1,'name'=>$this->getActionName()))->field('id,name,title')->find();

		$this->assign('navinfo',$navinfo);
        


        if(isset($_SESSION[C('USER_AUTH_KEY')])) {
            //显示菜单项
            
            $menu2  = array();
        //读取数据库模块列表生成菜单项
                $node    =   M("SysNode");
				
				
				
				$where['level']=3;
				$where['status']=1;
				$where['pid']=$navinfo['id'];

                $menu2	=	$node->where($where)->field('id,name,title')->order('orderby asc')->select();
                //echo $node->getLastSql();
                
                $accessList = $_SESSION['_ACCESS_LIST'];
                foreach($list as $key=>$module) {
                     if(isset($accessList[strtoupper(APP_NAME)][strtoupper($module['name'])]) || $_SESSION['administrator']) {
                        //设置模块访问权限
                        $module['access'] =   1;
                        $menu2[$key]  = $module;
                    }
                }
            
       		
		
			
            $this->assign('menu2',$menu2);
		}
		
		
	}


	
	
    public function index() {
        //列表过滤器，生成查询Map对象
        $map = $this->_search();
        if (method_exists($this, '_filter')) {
            $this->_filter($map);
        }
        $name = $this->getActionName();
        $model = D($name);
        if (!empty($model)) {
            $this->_list($model, $map);
        }
        $this->display();
        return;
    }

    /**
      +----------------------------------------------------------
     * 取得操作成功后要返回的URL地址
     * 默认返回当前模块的默认操作
     * 可以在action控制器中重载
      +----------------------------------------------------------
     * @access public
      +----------------------------------------------------------
     * @return string
      +----------------------------------------------------------
     * @throws ThinkExecption
      +----------------------------------------------------------
     */
    function getReturnUrl() {
        return __URL__ . '?' . C('VAR_MODULE') . '=' . MODULE_NAME . '&' . C('VAR_ACTION') . '=' . C('DEFAULT_ACTION');
    }

    /**
      +----------------------------------------------------------
     * 根据表单生成查询条件
     * 进行列表过滤
      +----------------------------------------------------------
     * @access protected
      +----------------------------------------------------------
     * @param string $name 数据对象名称
      +----------------------------------------------------------
     * @return HashMap
      +----------------------------------------------------------
     * @throws ThinkExecption
      +----------------------------------------------------------
     */
    protected function _search($name = '') {
        //生成查询条件
        if (empty($name)) {
            $name = $this->getActionName();
        }
        $name = $this->getActionName();
        $model = D($name);
        $map = array();
        foreach ($model->getDbFields() as $key => $val) {
            if (isset($_REQUEST [$val]) && $_REQUEST [$val] != '') {
                $map [$val] = $_REQUEST [$val];
            }
        }
        return $map;
    }

    /**
      +----------------------------------------------------------
     * 根据表单生成查询条件
     * 进行列表过滤
      +----------------------------------------------------------
     * @access protected
      +----------------------------------------------------------
     * @param Model $model 数据对象
     * @param HashMap $map 过滤条件
     * @param string $sortBy 排序
     * @param boolean $asc 是否正序
      +----------------------------------------------------------
     * @return void
      +----------------------------------------------------------
     * @throws ThinkExecption
      +----------------------------------------------------------
     */
    protected function _list($model, $map, $sortBy = '', $asc = false) {
        //排序字段 默认为主键名
        if (isset($_REQUEST ['_order'])) {
            $order = $_REQUEST ['_order'];
        } else {
            $order = !empty($sortBy) ? $sortBy : $model->getPk();
        }
        //排序方式默认按照倒序排列
        //接受 sost参数 0 表示倒序 非0都 表示正序
        if (isset($_REQUEST ['_sort'])) {
            $sort = $_REQUEST ['_sort'] ? 'asc' : 'desc';
        } else {
            $sort = $asc ? 'asc' : 'desc';
        }
        //取得满足条件的记录数
        $count = $model->where($map)->count('id');
        if ($count > 0) {
            import("@.ORG.Util.Page");
            //创建分页对象
            if (!empty($_REQUEST ['listRows'])) {
                $listRows = $_REQUEST ['listRows'];
            } else {
                $listRows = '';
            }
            $p = new Page($count, $listRows);
            //分页查询数据

            $voList = $model->where($map)->order("`" . $order . "` " . $sort)->limit($p->firstRow . ',' . $p->listRows)->select();
            //echo $model->getlastsql();
            //分页跳转的时候保证查询条件
            foreach ($map as $key => $val) {
                if (!is_array($val)) {
                    $p->parameter .= "$key=" . urlencode($val) . "&";
                }
            }
            //分页显示
            $page = $p->show();
            //列表排序显示
            $sortImg = $sort; //排序图标
            $sortAlt = $sort == 'desc' ? '升序排列' : '倒序排列'; //排序提示
            $sort = $sort == 'desc' ? 1 : 0; //排序方式
            //模板赋值显示
            $this->assign('list', $voList);
            $this->assign('sort', $sort);
            $this->assign('order', $order);
            $this->assign('sortImg', $sortImg);
            $this->assign('sortType', $sortAlt);
            $this->assign("page", $page);
        }
        Cookie::set('_currentUrl_', __SELF__);
        return;
    }

    function insert() {
        //B('FilterString');
        $name = $this->getActionName();
        $model = D($name);
        if (false === $model->create()) {
            $this->error($model->getError());
        }
        //保存当前数据对象
        $list = $model->add();
        if ($list !== false) { //保存成功
            $this->assign('jumpUrl', Cookie::get('_currentUrl_'));
            $this->success('新增成功!');
        } else {
            //失败提示
            $this->error('新增失败!');
        }
    }

    public function add() {
        $this->display();
    }

    function read() {
        $this->edit();
    }

    function edit() {
        $name = $this->getActionName();
        $model = M($name);
        $id = $_REQUEST [$model->getPk()];
        $vo = $model->getById($id);
        $this->assign('vo', $vo);
        $this->display();
    }

    function update() {
        //B('FilterString');
        $name = $this->getActionName();
        $model = D($name);
        if (false === $model->create()) {
            $this->error($model->getError());
        }
        // 更新数据
        $list = $model->save();
        if (false !== $list) {
            //成功提示
            $this->assign('jumpUrl', Cookie::get('_currentUrl_'));
            $this->success('编辑成功!');
        } else {
            //错误提示
            $this->error('编辑失败!');
        }
    }

    /**
      +----------------------------------------------------------
     * 默认删除操作
      +----------------------------------------------------------
     * @access public
      +----------------------------------------------------------
     * @return string
      +----------------------------------------------------------
     * @throws ThinkExecption
      +----------------------------------------------------------
     */
    public function delete() {
        //删除指定记录
        $name = $this->getActionName();
        $model = M($name);
        if (!empty($model)) {
            $pk = $model->getPk();
            $id = $_REQUEST [$pk];
            if (isset($id)) {
                $condition = array($pk => array('in', explode(',', $id)));
                $list = $model->where($condition)->setField('status', - 1);
                if ($list !== false) {
                    $this->success('删除成功！');
                } else {
                    $this->error('删除失败！');
                }
            } else {
                $this->error('非法操作');
            }
        }
    }

    public function foreverdelete() {
        //删除指定记录
        $name = $this->getActionName();
        $model = D($name);
        if (!empty($model)) {
            $pk = $model->getPk();
            $id = $_REQUEST [$pk];
            if (isset($id)) {
                $condition = array($pk => array('in', explode(',', $id)));
                if (false !== $model->where($condition)->delete()) {
                    //echo $model->getlastsql();
                    $this->success('删除成功！');
                } else {
                    $this->error('删除失败！');
                }
            } else {
                $this->error('非法操作');
            }
        }
        $this->forward();
    }

    public function clear() {
        //删除指定记录
        $name = $this->getActionName();
        $model = D($name);
        if (!empty($model)) {
            if (false !== $model->where('status=1')->delete()) {
                $this->assign("jumpUrl", $this->getReturnUrl());
                $this->success(L('_DELETE_SUCCESS_'));
            } else {
                $this->error(L('_DELETE_FAIL_'));
            }
        }
        $this->forward();
    }

    /**
      +----------------------------------------------------------
     * 默认禁用操作
     *
      +----------------------------------------------------------
     * @access public
      +----------------------------------------------------------
     * @return string
      +----------------------------------------------------------
     * @throws FcsException
      +----------------------------------------------------------
     */
    public function forbid() {
        $name = $this->getActionName();
        $model = D($name);
        $pk = $model->getPk();
        $id = $_REQUEST [$pk];
        $condition = array($pk => array('in', $id));
        $list = $model->forbid($condition);
        if ($list !== false) {
            $this->assign("jumpUrl", $this->getReturnUrl());
            $this->success('状态禁用成功');
        } else {
            $this->error('状态禁用失败！');
        }
    }

    public function checkPass() {
        $name = $this->getActionName();
        $model = D($name);
        $pk = $model->getPk();
        $id = $_GET [$pk];
        $condition = array($pk => array('in', $id));
        if (false !== $model->checkPass($condition)) {
            $this->assign("jumpUrl", $this->getReturnUrl());
            $this->success('状态批准成功！');
        } else {
            $this->error('状态批准失败！');
        }
    }

    public function recycle() {
        $name = $this->getActionName();
        $model = D($name);
        $pk = $model->getPk();
        $id = $_GET [$pk];
        $condition = array($pk => array('in', $id));
        if (false !== $model->recycle($condition)) {

            $this->assign("jumpUrl", $this->getReturnUrl());
            $this->success('状态还原成功！');
        } else {
            $this->error('状态还原失败！');
        }
    }

    public function recycleBin() {
        $map = $this->_search();
        $map ['status'] = - 1;
        $name = $this->getActionName();
        $model = D($name);
        if (!empty($model)) {
            $this->_list($model, $map);
        }
        $this->display();
    }

    /**
      +----------------------------------------------------------
     * 默认恢复操作
     *
      +----------------------------------------------------------
     * @access public
      +----------------------------------------------------------
     * @return string
      +----------------------------------------------------------
     * @throws FcsException
      +----------------------------------------------------------
     */
    function resume() {
        //恢复指定记录
        $name = $this->getActionName();
        $model = D($name);
        $pk = $model->getPk();
        $id = $_GET [$pk];
        $condition = array($pk => array('in', $id));
        if (false !== $model->resume($condition)) {
            $this->assign("jumpUrl", $this->getReturnUrl());
            $this->success('状态恢复成功！');
        } else {
            $this->error('状态恢复失败！');
        }
    }

    function saveSort() {
        $seqNoList = $_POST ['seqNoList'];
        if (!empty($seqNoList)) {
            //更新数据对象
            $name = $this->getActionName();
            $model = D($name);
            $col = explode(',', $seqNoList);
            //启动事务
            $model->startTrans();
            foreach ($col as $val) {
                $val = explode(':', $val);
                $model->id = $val [0];
                $model->sort = $val [1];
                $result = $model->save();
                if (!$result) {
                    break;
                }
            }
            //提交事务
            $model->commit();
            if ($result !== false) {
                //采用普通方式跳转刷新页面
                $this->success('更新成功');
            } else {
                $this->error($model->getError());
            }
        }
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
	
	function delphoto($delpicurl,$type='pro'){
		
			$savepath='..'.__ROOT__.'/Uploads/'.$type;
			unlink($savepath.'/'.$delpicurl);
			unlink($savepath.'/thumb/thumb_50_'.$delpicurl);
			unlink($savepath.'/thumb/thumb_150_'.$delpicurl);
			unlink($savepath.'/thumb/thumb_300_'.$delpicurl);
		
		
		
		
	}
	
	//上传图片
	protected function return_upload_photo($savePath='/pro'){
		import("ORG.Net.UploadFile");
		$upload = new UploadFile();// 实例化上传类
		$upload->maxSize  = 314572800 ;// 设置附件上传大小
		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg','pdf','chm');		// 设置附件上传类型
		$upload->hashType	='md5_file';
		
		$upload->savePath =  './Uploads'.$savePath.'/';					// 设置附件上传目录
		$upload->saveRule = "uniqid";
		$upload->thumb = true;
		$upload->thumbPrefix = 'thumb_100_,thumb_250_,thumb_500_';
		$upload->thumbPath = './Uploads'.$savePath.'/thumb/';
		$upload->thumbMaxWidth = '100,250,1000';
		$upload->thumbMaxHeight = '100,250,1000';
		$upload->upload();
		$info =  $upload->getUploadFileInfo();
		
//		if(!$upload->upload()) {// 上传错误提示错误信息
//			$this->error($upload->getErrorMsg());
//		}else{// 上传成功 获取上传文件信息
//			$info =  $upload->getUploadFileInfo();
//		}
		return $info;
		
	}
	
	
	//删除图片
	protected function del_upload_photo($mypath='/pro',$filename){
		$savepath='..'.__ROOT__.'/Uploads'.$mypath;
		unlink($savepath.'/thumb/thumb_500_'.$filename);
		unlink($savepath.'/thumb/thumb_250_'.$filename);
		unlink($savepath.'/thumb/thumb_100_'.$filename);
		unlink($savepath.'/'.$filename);
	}
	/**
	 * 系统邮件发送函数
	 * @param string $to    接收邮件者邮箱
	 * @param string $name  接收邮件者名称
	 * @param string $subject 邮件主题 
	 * @param string $body    邮件内容
	 * @param string $attachment 附件列表
	 * @return boolean 
	 */
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
	
	
	

}

?>