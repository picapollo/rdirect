<div id="signup2">
	<div id="content">
		<?php if(!empty($redirect_params) && $redirect_params['prompt']):?>
		<div id="prompt">
			<?php 
			if($redirect_params['prompt'] == 'new_listing')
			{ echo '"'.$redirect_params['name'].'"의 예약요청을 받으려면 회원가입이 필요합니다.'; }
			?>
		</div>
		<?php endif;?>
		<div id="section_signup" style="<?php if( ! $signup_flag) echo 'display:none;'; ?>">
			<h1>에어비앤비 회원가입하기</h1>
			<div id="signUpBox">
				<h2>페이스북으로 회원가입</h2>
				<a class="fb-button" href="<?=$this->facebook->getLoginUrl(array('redirect_uri' => site_url('auth_other/fb_signin'), 'scope' => $this->config->item('facebook_scope')))?>"> <span class="fb-button-left"></span> <span class="fb-button-center"><strong>페이스북 커넥트</strong></span> <span class="fb-button-right"></span> </a>
				<h3 class="or-separator signpainter"></h3>
				<?=form_open('auth/signup_login');?>
				<?php if(!empty($redirect_params)): ?>
				<input id="redirect_params_name" name="redirect_params[name]" type="hidden" value="<?=$redirect_params['name']?>" /> 
				<input id="redirect_params_action" name="redirect_params[action]" type="hidden" value="<?=$redirect_params['action']?>" /> 
				<input id="redirect_params_new_hosting" name="redirect_params[new_hosting]" type="hidden" value="<?=$redirect_params['new_hosting']?>" /> 
				<input id="redirect_params_id" name="redirect_params[id]" type="hidden" value="<?=$redirect_params['id']?>" /> 
				<input id="redirect_params_sig" name="redirect_params[sig]" type="hidden" value="<?=$redirect_params['sig']?>" /> 
				<input id="redirect_params_prompt" name="redirect_params[prompt]" type="hidden" value="<?=$redirect_params['prompt']?>" /> 
				<input id="redirect_params_controller" name="redirect_params[controller]" type="hidden" value="<?=$redirect_params['controller']?>" />
				<?php endif; ?> 
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
						<input id="user_email" name="email" size="30" type="text" value="<?=$this->input->get('email')?>" />
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
					<h2>이미 에어비앤비 멤버인가요? <a rel="toggle-sign-up" href="<?=site_url('login')?>">로그인 하세요..</a></h2>
				</div>
			</div>
		</div>
		<div id="section_signin" style="<?php if($signup_flag) echo 'display:none;';?>">
			<h1>에어비앤비 계정으로 로그인 하세요.</h1>
			<div id="signInBox">
				<h2>페이스북으로 로그인하기</h2>
				<a class="fb-button" href="<?=$this->facebook->getLoginUrl(array('redirect_uri' => site_url('auth_other/fb_signin')))?>"> <span class="fb-button-left"></span> <span class="fb-button-center"><strong>페이스북</strong>으로 <strong>로그인</strong></span> <span class="fb-button-right"></span> </a>
				<h3 class="or-separator signpainter"></h3>
				<?=form_open('auth/login');?>
				<?php if(!empty($redirect_params)): ?>
				<input id="redirect_params_name" name="redirect_params[name]" type="hidden" value="<?=$redirect_params['name']?>" /> 
				<input id="redirect_params_action" name="redirect_params[action]" type="hidden" value="<?=$redirect_params['action']?>" /> 
				<input id="redirect_params_new_hosting" name="redirect_params[new_hosting]" type="hidden" value="<?=$redirect_params['new_hosting']?>" /> 
				<input id="redirect_params_id" name="redirect_params[id]" type="hidden" value="<?=$redirect_params['id']?>" /> 
				<input id="redirect_params_sig" name="redirect_params[sig]" type="hidden" value="<?=$redirect_params['sig']?>" /> 
				<input id="redirect_params_prompt" name="redirect_params[prompt]" type="hidden" value="<?=$redirect_params['prompt']?>" /> 
				<input id="redirect_params_controller" name="redirect_params[controller]" type="hidden" value="<?=$redirect_params['controller']?>" />
				<?php endif; ?> 
					<div class="textInput" id="inputEmail">
						<label for="signin_email" class="labelBlur">
							이메일 주소
						</label>
						<input type="text" name="email" tabindex="1" id="signin_email" value="<?=$this->input->get('email')?>" />
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
					<h2>새로운 계정이 필요하세요? <a rel="toggle-sign-up" href="<?site_url('signup_login?rf=true');?>">지금 회원가입 하세요.</a></h2>
				</div>
			</div>
		</div>
	</div>
</div>