<div class="window">


		<div class="screen">
			<div class="s_body">
			<div id="dfmaxthonv5_wrap"><div id="dfmaxthonv5"></div></div>
			<div id="copyright_tips"></div>
			<script>
						
			(function(){
				var aoutds = Array("www.soku.com");
				var adr = document.referrer;
				var aoutds_ua = navigator.userAgent.toLowerCase();
				var aoutds_isFF = aoutds_ua.indexOf('firefox') >= 0;
				var aoutds_isIE = (aoutds_ua.indexOf('msie') >= 0 && aoutds_ua.indexOf('opera') < 0);
				var aoutds_isSFR = aoutds_ua.indexOf('safari') >= 0;
				if(parent&&((aoutds_isIE&&parent!=document&&parent!=window)||((aoutds_isFF||aoutds_isSFR)&&parent!=window))&&adr!=""&&adr!=self.location&&top.location!=self.location){
				  var isAOUTD = false;
				  if(adr.indexOf(".youku.com") !== -1){
					  isAOUTD = true;
				  }
				  var adrs = adr.match(/\:\/\/([\w\.\-\d]+)\//g); 
				  for(var ai=0;ai<aoutds.length;ai++){
					if((typeof adrs == "string" && adrs == "://"+aoutds[ai]+"/") || 
						((typeof adrs == "object" && adrs.length>0 && adrs[0] == "://"+aoutds[ai]+"/"))){
						isAOUTD = true;
						break;
					}
				  }
				  if(isAOUTD == false) goHome();
				}
				
				function goHome(){
					var tips = '<div style="height:32px;line-height:32px;background:#ffffe5;border:1px solid #ecdda8;color:#555;text-align:center;font-size:14px;font-family: &quot;Microsoft YaHei&quot;,&quot;微软雅黑&quot;,helvetica,arial,verdana,tahoma,sans-serif;">本网页发现未经许可被嵌套播放，为保护您的隐私不被第三方网站窃取，马上为您跳到正常网页</div>';
					document.getElementById('copyright_tips').innerHTML = tips;
					setTimeout(function(){top.location=self.location;},2000);
				};
			})();
			
			</script>	
						<link href="http://static.youku.com/v1.0.124/index/css/qheader.css" type="text/css" rel="stylesheet" />
<link href="http://static.youku.com/v1.0.124/index/css/user-grade-icon.css" type="text/css" rel="stylesheet" />

		


<script>
var udomain = 'u.youku.com'
,UC_DOMAIN = 'i.youku.com'
,nc_domain ='nc.youku.com'
,youku_index_domain = 'www.youku.com'
,notice_domain ='http://notice.youku.com'
,space_domain ='u.youku.com'
,comments_domain ='http://comments.youku.com'
,openLookingClick = '1'
,passport = '1'
,passport_url = 'http://passport.youku.com'
,callback = 'videoLogin'
,novamodule = ''
,youku_homeurl = 'www.youku.com'

,loginSwitchToNew = true
,loginDomainNew = 'login.youku.com'

,lottery_open_sidetool = "1"
,lottery_id_sidetool = ""
,lottery_sidetool = ""
//only for header
,qheaderjs = {
	relyon: [
		{
			src			: 'http://static.youku.com/v1.0.124/js/prototype.js',
			condition	: 'typeof($)=="function"',
			ready		: false
		},{
			src			: 'http://static.youku.com/v1.0.124/index/js/common.js',
			condition	: 'typeof(login)=="function"',
			ready		: false
		},{
			src			: 'http://static.youku.com/v1.0.124/index/js/qwindow.js',
			condition	: 'typeof(Qwindow)=="function"',
			ready		: false
		}
	],
	addons: [
	 	{
			src			: 'http://static.soku.com/v2.0.4/soku/giantstar/js/sk-box-open.js',
			condition	: 'typeof(XBox)=="object"',
			ready		: false
		}
	]
};
</script>
<script src="http://static.youku.com/lvip/js/chuda.js"></script>
<script src="http://static.youku.com/v1.0.124/index/js/qheader.js"></script>
<script src="http://static.youku.com/v1.0.124/index/js/qwindow.js"></script>
<script src="http://static.youku.com/v1.0.124/index/js/popup.js"></script>
			<script type="text/javascript">
	var lsidetooltype = "n";
</script>
<script src="http://static.youku.com/v1.0.124/index/js/lsidetoolresize.js"></script>
<link href="http://static.youku.com/v1.0.124/index/css/lsidetool.css" type="text/css" rel="stylesheet" />

<script type="text/javascript">
	var lsidetooltype = "n";
	
	var bodyWidth = window.innerWidth || (document.compatMode == "CSS1Compat") ? (document.documentElement.clientWidth):(document.body.clientWidth);
	if(bodyWidth <= 1075){
		document.getElementById('miniSidebar').style.display = "block";
		if(document.getElementById('ykSidebar_w970')){
			document.getElementById('ykSidebar_w970').style.display = "none";
		}
		if(document.getElementById('ykSidebar_w970_custom')){
			document.getElementById('ykSidebar_w970_custom').style.display = "none";
		}
		document.getElementById('ykSideBar').style.display = "none";
	}else{
		if(lsidetooltype == "w"){
			if(typeof bodyWidth != "number"){
				if(document.compatMode == "CSS1Compat"){
					bodyWidth = document.documentElement.clientWidth;
				}else{
				  bodyWidth = document.body.clientWidth;
				}
			}	
			if(bodyWidth <= 1400 && bodyWidth > 1075){
				document.getElementById('ykSidebar_w970').style.display = "block";
				document.getElementById('ykSideBar').style.display = "none";
				document.getElementById('miniSidebar').style.display = "none";
			}else{
				document.getElementById('ykSideBar').style.display = "block";
				document.getElementById('ykSidebar_w970').style.display = "none";
				document.getElementById('miniSidebar').style.display = "none";
			}
		}
	}
	
</script>
<script src="http://static.youku.com/v1.0.124/index/js/lsidetool.js"></script>
						

<script type="text/javascript">
var catId="100";
var cateStr = 'p_dh00_B';
var catName="%E5%8A%A8%E6%BC%AB";
var attrs="";
var video_gener="";
var video_area="日本|";
</script>

<script>
(function(){
	//原创标识hover处理
	var $ = jQuery;
	var timeOut = '';
	$("#oriLabelBox").hover(
		function(){
			clearTimeout(timeOut);
			$("#oriFrom").show();
		},
		function(){
			var flag = false;
			$("#oriFrom").mouseenter(function(){
				flag = true;
				$("#oriFrom").show();
			});
			if(!flag){
				timeOut = setTimeout(function(){
					$("#oriFrom").hide();
				},800);
			}
		}
	);
})();
</script>
</div></div>
                    																<div class="play_area" id="playBox">
		<div class="yk-player-curtain" id="yk-player-curtain"></div>
	<script>playerLeft.init();</script>
			   <div id="div_ad_crazy_v5" style="position:absolute;top:0;left:50%;z-index:10000;display:none"></div>
			<div class="playBox" id="playerBox">
				<div class="playArea">
								<div class="abs">
					<div id="preAd1" style="zoom:1;">
						<div style="position:absolute;top:0px;left:610px;width:320px;height:460px;text-align:right;display:none" id="preAdContent"></div>
					</div>
					<div id="ad_crazy" style="zoom:1;">
												<div id="ab_558"></div>
											</div>
				</div>
			
								<div class="player" id="player" err>
					<script type="text/javascript">
var playerUrl = 'http://static.youku.com/v1.0.0611/v/swf/player_yknpsv.swf';
var preId="";
var nextId="";
var plid="";
var type="";
</script>
<div id="player_title"></div>
<div id="player_html5" class="player_html5">
 <div class="picture" id="youku-html5-player-info">
  <video id="youku-html5-player-video" width="100%" height="458" x-webkit-airplay="allow" controls autoplay preload>
  </video>
 </div>
 <div class="controls">
  <div class="panel">
  	<div id="youku-html5-player-progressbar" class="processbar">
  	 <div id="youku-html5-player-progress-tp" class="timepoint" style="left:0%;display:none">00:00</div>
  	 <div id="youku-html5-player-progress-trk" class="track" style="width:0%;"></div>
  	 <div id="youku-html5-player-progress-hd" class="handle" style="left:0%"></div>
  	</div>
  	<div id="youku-html5-player-play" class="start_disabled"></div>
  	<div class="time">
  		<span id="youku-html5-player-currentTime" class="current">00:00</span>/<span id="youku-html5-player-totalTime" class="total">00:00</span>
  	</div>
    <div class="controls-fullscreen-button"></div>
    <div class="base-button controls-widescreen-button"> 标屏</div>
    <div class="controls-playmode"></div>
    <div class="controls-language"></div>
  	<div class="volume" id="youku-html5-player-volume">
  	 <div class="speaker" id="youku-html5-player-speaker">
  	 	<div class="mask">
  	 		<div class="lose" id="youku-html5-player-speaker-lose" style="width:100%"></div>
  	 	</div>
  	 </div>
  	 <div class="volumebar">
  	 	<div class="track" id="youku-html5-player-volumebar-trk"></div>
  	 	<div class="handle" id="youku-html5-player-volumebar-hd" style="left:0%"></div>
  	 </div>
  	</div>
  </div>
 </div>
</div>
<iframe id="universalPlayer" src="" width="100%" height="498" border="0" frameborder="0" style="display:none"></iframe>
<script>
play();
</script>
				</div>
				</div>
			</div>
						<!--播放列表-->
<!--节目播放列表-->
<!--123播放列表-->
<div class="listBox expandBox" id="player_sidebar">
<div class="listSkip">

</script>

