<?$this->facebook->getLoginUrl(array('redirect_uri' => site_url('auth_other/fb_signin'), 'scope' => $this->config->item('facebook_scope')))?>
<div id="signup">
	<h1>회원가입</h1>
	<div id="fb-plugin">
		<div id="fb-button-container">
			<a class="fb-button" href="#"> <span class="fb-button-left"></span> <span class="fb-button-center"><strong>페이스북 커넥트</strong></span> <span class="fb-button-right"></span> </a>
		</div>
		<iframe src="https://www.facebook.com/plugins/facepile.php?app_id=<?=$this->config->item('facebook_app_id');?>&max_rows=2"
		scrolling="no" frameborder="0" allowTransparency="true"
		style="border:none;overflow:hidden; width:282px; height:120px;"></iframe>
	</div>
	<div class="or-separator signpainter"></div>
	<p id="account-message">
		<a href="?hf=true">이메일 주소로 계정을 만들 수 있습니다.</a>
	</p>
	<div style="padding-top:10px;color:#5D5D5D;">
		"페이스북 커넥트"를 클릭하면 다음에 동의하는 것으로 간주됩니다. <a href="http://www.airbnb.com/terms" onclick="window.open(this.href);return false;">서비스 약관</a>.
	</div>
</div>