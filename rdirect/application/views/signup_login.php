<?php

$this->load->helper('form'); 

$this -> load -> view('header/signup_login', $header) ; 
$this -> load -> view('top_menu', array('starred' => $starred));

echo form_open('auth_other/fb_signin', array('id'=>'facebook_form'));
echo form_close();

if($fb)
{
	$this->load->view('auth/signup');	
}
else
{
	$this->load->view('auth/signup2', array('signup_flag' => $signup_flag, 'redirect_params', $redirect_params));
}

?>
	<div id="fb-root"></div>
	<script type="text/javascript">

		window.fbAsyncInit = function() {
				FB.init({
					appId  : '<?=$this->config->item('facebook_app_id');?>',
					status : true, // check login status
					cookie : true, // enable cookies to allow the server to access the session
					xfbml  : true  // parse XFBML
				});

				FB.getLoginStatus(function(response) {
					if (response && (response.status !== "unknown")) {
						jQuery.cookie("fbs", response.status);
					} else {
						jQuery.cookie("fbs", null);
					}
				});
			};

			(function() {
				var e = document.createElement('script');
				e.src = document.location.protocol + '//connect.facebook.net/ko_KR/all.js';
				e.async = true;
				document.getElementById('fb-root').appendChild(e);
			}());

		Airbnb.SignInUp.setLocalizedMessages({"signin":{"password":{"required":"\ube44\ubc00\ubc88\ud638\ub97c \uc785\ub825\ud558\uc138\uc694.","minlength":"\ucd5c\uc18c 5 \uae00\uc790\uac00 \ud544\uc694\ud569\ub2c8\ub2e4."},"email":{"email":"\uc774\uba54\uc77c\uc744 \uc785\ub825\ud558\uc138\uc694.","required":"\uc774\uba54\uc77c\uc774 \ud544\uc694\ud569\ub2c8\ub2e4."}},"signup":{"confirm_password":{"required":"\ube44\ubc00\ubc88\ud638\ub97c \ud655\uc778\ud558\uc138\uc694.","minlength":"\ucd5c\uc18c 5 \uae00\uc790\uac00 \ud544\uc694\ud569\ub2c8\ub2e4.","equalTo":"\ube44\ubc00\ubc88\ud638\uac00 \uc77c\uce58\ud558\uc9c0 \uc54a\uc2b5\ub2c8\ub2e4. "},"password":{"required":"\ube44\ubc00\ubc88\ud638\ub97c \uc785\ub825\ud558\uc138\uc694.","minlength":"\ucd5c\uc18c 5 \uae00\uc790\uac00 \ud544\uc694\ud569\ub2c8\ub2e4."},"email":{"email":"\uc774\uba54\uc77c\uc744 \uc785\ub825\ud558\uc138\uc694.","required":"\uc774\uba54\uc77c\uc774 \ud544\uc694\ud569\ub2c8\ub2e4."},"username":{"required":"\uc774\ub984\uc744 \uc785\ub825\ud558\uc138\uc694."},}});
	
		jQuery(document).ready(function() {
			Airbnb.init({userLoggedIn: <?=$this->tank_auth->is_logged_in()?'true':'false'?>});
		});
	
		Airbnb.FACEBOOK_PERMS = '<?=$this->config->item('facebook_scope')?>';
	</script>
	
<?php $this->load->view('footer'); ?>