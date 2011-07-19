<?php
$this -> load -> view('header/signup_login', $header);
$this -> load -> view('top_menu');
if($fb):
?>
<div id="signup">
	<h1>회원가입</h1>
	<div id="fb-plugin">
		<div id="fb-button-container">
			<a class="fb-button" href="javascript:void(0);"> <span class="fb-button-left"></span> <span class="fb-button-center"><strong>페이스북 커넥트</strong></span> <span class="fb-button-right"></span> </a>
		</div>
		<iframe src="https://www.facebook.com/plugins/facepile.php?app_id=<?=$this->config->item('facebook_app_id');?>&amp;max_rows=2"
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
<?php else: ?>
<div id="signup2">
	<div id="content">
		<div id="section_signup" style="">
			<h1>에어비앤비 회원가입하기</h1>
			<div id="signUpBox">
				<h2>페이스북으로 회원가입</h2>
				<a class="fb-button" href="javascript:void(0);"> <span class="fb-button-left"></span> <span class="fb-button-center"><strong>페이스북 커넥트</strong></span> <span class="fb-button-right"></span> </a>
				<h3 class="or-separator signpainter"></h3>
				<?=form_open('auth/signup_login');?>
					<div class="textInput" id="inputFirst">
						<label for="user_first_name" class="labelBlur">
							이름
						</label>
						<input id="user_first_name" name="username" size="30" type="text" />
					</div>
					<div class="textInput" id="inputEmail">
						<label for="user_email" class="labelBlur">
							이메일 주소
						</label>
						<input id="user_email" name="email" size="30" type="text" />
					</div>
					<div class="textInput" id="inputPassword">
						<label for="user_password" class="labelBlur">
							비밀번호
						</label>
						<input id="user_password" name="password" size="30" type="password" />
					</div>
					<div class="textInput" id="inputConfirmPassword">
						<div class="hidden">
							<label for="user_password_confirmation" class="labelBlur">
								비밀번호 확인
							</label>
							<input id="user_password_confirmation" name="confirm_password" size="30" type="password" />
						</div>
					</div>
					<div class="formActions">
						<div class="pad">
							<input type="submit" tabindex="4" id="bCreateAccount" class="button-glossy green" value="계정 만들기" />
							<label for="remember_me1">
								<input id="remember_me1" name="remember_me" tabindex="3" type="checkbox" value="true" />
								<span>다음 로그인할 때 기억해 주세요</span>
							</label>
							<p>
								"페이스북 커넥트"를 클릭하면 다음에 동의하는 것으로 간주됩니다. <a href="http://www.airbnb.com/terms" onclick="window.open(this.href);return false;">서비스 약관</a>.
							</p>
						</div>
					</div>
				<?=form_close();?>
			</div>
			<div class="smallBox">
				<div class="pad">
					<h2>이미 에어비앤비 멤버인가요? <a rel="toggle-sign-up" href="https://www.airbnb.com/login">로그인 하세요..</a></h2>
				</div>
			</div>
		</div>
		<div id="section_signin" style="display:none;">
			<h1>에어비앤비 계정으로 로그인 하세요.</h1>
			<div id="signInBox">
				<h2>페이스북으로 로그인하기</h2>
				<a class="fb-button" href="javascript:void(0);"> <span class="fb-button-left"></span> <span class="fb-button-center"><strong>페이스북</strong>으로 <strong>로그인</strong></span> <span class="fb-button-right"></span> </a>
				<h3 class="or-separator signpainter"></h3>
				<?=form_open('auth/login');?>
					<div class="textInput" id="inputEmail">
						<label for="signin_email" class="labelBlur">
							이메일 주소
						</label>
						<input type="text" name="email" tabindex="1" id="signin_email" value="" />
					</div>
					<div class="textInput" id="inputPassword">
						<label for="signin_password" class="labelBlur">
							비밀번호
						</label>
						<input type="password" name="password" id="signin_password" tabindex="2" />
						<a href="https://www.airbnb.com/forgot_password" class="forgotPassword" tabindex="5">비밀번호를 잃어버렸나요?</a>
					</div>
					<div class="formActions">
						<input type="submit" id="bSignIn" class="button-glossy" value="로그인" tabindex="4" />
						<label for="remember_me2">
							<input type="checkbox" name="remember_me" id="remember_me2" value="true" tabindex="3" />
							<span>다음 로그인할 때 기억해 주세요</span>
						</label>
					</div>
				<?=form_close();?>
			</div>
			<div class="smallBox">
				<div class="pad">
					<h2>새로운 계정이 필요하세요? <a rel="toggle-sign-up" href="<?site_url('/auth/signup_login?rf=true');?>">지금 회원가입 하세요.</a></h2>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
<form action="<?=site_url('auth_other/fb_signin');?>" id="facebook_form" method="post"></form>
<?php $this->load->view('footer'); ?>