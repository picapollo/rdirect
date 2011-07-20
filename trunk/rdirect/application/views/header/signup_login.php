<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<title><?=$title?></title>
		<meta name="title" content="<?=$title?>" />
		<link rel="image_src" href="<?=IMG_DIR?>/airbnb_logo.png" />
		<link rel="search" type="application/opensearchdescription+xml" href="<?=BASEURL?>/opensearch.xml" title="Airbnb" />
		<!--[if (!IE)|(gte IE 8)]><!-->
		<link media="screen" rel="stylesheet" type="text/css" href="<?=CSS_DIR?>/common-datauri.css" />
		<!--<![endif]-->
		<!--[if lte IE 7]>
		<link href="<?=CSS_DIR?>/common.css" media="screen" rel="stylesheet" type="text/css" />
		<![endif]-->
		<link href="<?=CSS_DIR?>/korean_fonts.css" media="screen" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
		<script type="text/javascript">var base_url = '<?=base_url()?>'</script>
		<script src="<?=JS_DIR?>/common.js" type="text/javascript"></script>
		<!--[if (!IE)|(gte IE 8)]><!-->
		<link href="<?=CSS_DIR?>/signinup-datauri.css" media="screen" rel="stylesheet" type="text/css" />
		<!--<![endif]-->
		<!--[if lte IE 7]>
		<link href="<?=CSS_DIR?>/signinup.css" media="screen" rel="stylesheet" type="text/css" />
		<![endif]-->
		<!--[if IE]>
		<link href="<?=CSS_DIR?>/signinup_ie.css" media="screen" rel="stylesheet" type="text/css" />
		<![endif]-->
		<script src="<?=JS_DIR?>/jquery.validate.min.js" type="text/javascript"></script>
		<script src="<?=JS_DIR?>/signinup.js" type="text/javascript"></script>
		<link rel="shortcut icon" href="<?=IMG_DIR?>/airbnb_favicon.ico" />
		<style type="text/css">
			.fb_hidden{position:absolute;top:-10000px;z-index:10001}
			.fb_reset{background:none;border-spacing:0;border:0;color:#000;cursor:auto;direction:ltr;font-family:"lucida grande", tahoma, verdana, arial, sans-serif;font-size: 11px;font-style:normal;font-variant:normal;font-weight:normal;letter-spacing:normal;line-height:1;margin:0;overflow:visible;padding:0;text-align:left;text-decoration:none;text-indent:0;text-shadow:none;text-transform:none;visibility:visible;white-space:normal;word-spacing:normal}
			.fb_link img{border:none}
			.fb_dialog{position:absolute;top:-10000px;z-index:10001}
			.fb_dialog_advanced{background:rgba(82, 82, 82, .7);padding:10px;-moz-border-radius:8px;-webkit-border-radius:8px}
			.fb_dialog_advanced.fb_mobile{background:rgba(82, 82, 82, .7);padding:3px;-moz-border-radius:2px;-webkit-border-radius:2px}
			.fb_dialog_content{background:#fff;color:#333}
			.fb_dialog_close_icon{background:url(https://s-static.ak.facebook.com/rsrc.php/v1/zq/r/IE9JII6Z1Ys.png) no-repeat scroll 0 0 transparent;_background-image:url(https://s-static.ak.facebook.com/rsrc.php/v1/zL/r/s816eWC-2sl.gif);cursor:pointer;display:block;height:15px;position:absolute;right:18px;top:17px;width:15px;top:8px\9;right:7px\9}
			.fb_mobile .fb_dialog_close_icon{top:5px;left:5px;right:auto}
			.fb_dialog_close_icon:hover{background:url(https://s-static.ak.facebook.com/rsrc.php/v1/zq/r/IE9JII6Z1Ys.png) no-repeat scroll 0 -15px transparent;_background-image:url(https://s-static.ak.facebook.com/rsrc.php/v1/zL/r/s816eWC-2sl.gif)}
			.fb_dialog_close_icon:active{background:url(https://s-static.ak.facebook.com/rsrc.php/v1/zq/r/IE9JII6Z1Ys.png) no-repeat scroll 0 -30px transparent;_background-image:url(https://s-static.ak.facebook.com/rsrc.php/v1/zL/r/s816eWC-2sl.gif)}
			.fb_dialog_loader{background-color:#f2f2f2;border:1px solid #606060;font-size: 24px;padding:20px}
			.fb_dialog_top_left,
			.fb_dialog_top_right,
			.fb_dialog_bottom_left,
			.fb_dialog_bottom_right{height:10px;width:10px;overflow:hidden;position:absolute}
			.fb_dialog_top_left{background:url(https://s-static.ak.facebook.com/rsrc.php/v1/ze/r/8YeTNIlTZjm.png) no-repeat 0 0;left:-10px;top:-10px}
			.fb_dialog_top_right{background:url(https://s-static.ak.facebook.com/rsrc.php/v1/ze/r/8YeTNIlTZjm.png) no-repeat 0 -10px;right:-10px;top:-10px}
			.fb_dialog_bottom_left{background:url(https://s-static.ak.facebook.com/rsrc.php/v1/ze/r/8YeTNIlTZjm.png) no-repeat 0 -20px;bottom:-10px;left:-10px}
			.fb_dialog_bottom_right{background:url(https://s-static.ak.facebook.com/rsrc.php/v1/ze/r/8YeTNIlTZjm.png) no-repeat 0 -30px;right:-10px;bottom:-10px}
			.fb_dialog_vert_left,
			.fb_dialog_vert_right,
			.fb_dialog_horiz_top,
			.fb_dialog_horiz_bottom{position:absolute;background:#525252;filter:alpha(opacity=70);opacity:.7}
			.fb_dialog_vert_left,
			.fb_dialog_vert_right{width:10px;height:100%}
			.fb_dialog_vert_left{margin-left:-10px}
			.fb_dialog_vert_right{right:0;margin-right:-10px}
			.fb_dialog_horiz_top,
			.fb_dialog_horiz_bottom{width:100%;height:10px}
			.fb_dialog_horiz_top{margin-top:-10px}
			.fb_dialog_horiz_bottom{bottom:0;margin-bottom:-10px}
			.fb_dialog_iframe{line-height:0}
			.fb_dialog.loading.fb_mobile .fb_dialog_iframe{background:url(https://s-static.ak.facebook.com/rsrc.php/v1/zQ/r/pQebR9nCkAT.gif) no-repeat 50% 50%}
			.fb_dialog.loading.fb_mobile iframe{visibility:hidden}
			.fb_dialog_content .dialog_title{background:#6d84b4;border:1px solid #3b5998;color:#fff;font-size: 14px;font-weight:bold;margin:0}
			.fb_dialog_content .dialog_title > span{background:url(https://s-static.ak.facebook.com/rsrc.php/v1/zd/r/Cou7n-nqK52.gif) no-repeat 5px 50%;float:left;padding:5px 0 7px 26px}
			.fb_dialog_content .dialog_content{background:url(https://s-static.ak.facebook.com/rsrc.php/v1/z9/r/jKEcVPZFk-2.gif) no-repeat 50% 50%;border:1px solid #555;border-bottom:0;border-top:0;height:150px}
			.fb_dialog_content .dialog_footer{background:#f2f2f2;border:1px solid #555;border-top-color:#ccc;height:40px}
			#fb_dialog_loader_close{float:right}
			.fb_dialog.fb_mobile .fb_dialog_close_icon{visibility:hidden}
			.fb_dialog.loading.fb_mobile .fb_dialog_close_icon{visibility:visible}
			.fb_iframe_widget{position:relative;display:-moz-inline-block;display:inline-block}
			.fb_iframe_widget iframe{position:relative;vertical-align:text-bottom}
			.fb_iframe_widget span{position:relative}
			.fb_hide_iframes iframe{position:relative;left:-10000px}
			.fb_iframe_widget_loader{position:relative;display:inline-block}
			.fb_iframe_widget_loader iframe{min-height:32px;z-index:2;zoom:1}
			.fb_iframe_widget_loader .FB_Loader{background:url(https://s-static.ak.facebook.com/rsrc.php/v1/z9/r/jKEcVPZFk-2.gif) no-repeat;height:32px;width:32px;margin-left:-16px;position:absolute;left:50%;z-index:4}
			.fb_button_simple,
			.fb_button_simple_rtl{background-image:url(https://s-static.ak.facebook.com/rsrc.php/v1/zH/r/eIpbnVKI9lR.png);background-repeat:no-repeat;cursor:pointer;outline:none;text-decoration:none}
			.fb_button_simple_rtl{background-position:right 0}
			.fb_button_simple .fb_button_text{margin:0 0 0 20px;padding-bottom:1px}
			.fb_button_simple_rtl .fb_button_text{margin:0 10px 0 0}
			a.fb_button_simple:hover .fb_button_text,
			a.fb_button_simple_rtl:hover .fb_button_text,
			.fb_button_simple:hover .fb_button_text,
			.fb_button_simple_rtl:hover .fb_button_text{text-decoration:underline}
			.fb_button,
			.fb_button_rtl{background:#29447e url(https://s-static.ak.facebook.com/rsrc.php/v1/zL/r/FGFbc80dUKj.png);background-repeat:no-repeat;cursor:pointer;display:inline-block;padding:0 0 0 1px;text-decoration:none;outline:none}
			.fb_button .fb_button_text,
			.fb_button_rtl .fb_button_text{background:#5f78ab url(https://s-static.ak.facebook.com/rsrc.php/v1/zL/r/FGFbc80dUKj.png);border-top:solid 1px #879ac0;border-bottom:solid 1px #1a356e;color:#fff;display:block;font-family:"lucida grande",tahoma,verdana,arial,sans-serif;font-weight:bold;padding:2px 6px 3px 6px;margin:1px 1px 0 21px;text-shadow:none}
			a.fb_button,
			a.fb_button_rtl,
			.fb_button,
			.fb_button_rtl{text-decoration:none}
			a.fb_button:active .fb_button_text,
			a.fb_button_rtl:active .fb_button_text,
			.fb_button:active .fb_button_text,
			.fb_button_rtl:active .fb_button_text{border-bottom:solid 1px #29447e;border-top:solid 1px #45619d;background:#4f6aa3;text-shadow:none}
			.fb_button_xlarge,
			.fb_button_xlarge_rtl{background-position:left -60px;font-size: 24px;line-height:30px}
			.fb_button_xlarge .fb_button_text{padding:3px 8px 3px 12px;margin-left:38px}
			a.fb_button_xlarge:active{background-position:left -99px}
			.fb_button_xlarge_rtl{background-position:right -268px}
			.fb_button_xlarge_rtl .fb_button_text{padding:3px 8px 3px 12px;margin-right:39px}
			a.fb_button_xlarge_rtl:active{background-position:right -307px}
			.fb_button_large,
			.fb_button_large_rtl{background-position:left -138px;font-size: 13px;line-height:16px}
			.fb_button_large .fb_button_text{margin-left:24px;padding:2px 6px 4px 6px}
			a.fb_button_large:active{background-position:left -163px}
			.fb_button_large_rtl{background-position:right -346px}
			.fb_button_large_rtl .fb_button_text{margin-right:25px}
			a.fb_button_large_rtl:active{background-position:right -371px}
			.fb_button_medium,
			.fb_button_medium_rtl{background-position:left -188px;font-size: 11px;line-height:14px}
			a.fb_button_medium:active{background-position:left -210px}
			.fb_button_medium_rtl{background-position:right -396px}
			.fb_button_text_rtl,
			.fb_button_medium_rtl .fb_button_text{padding:2px 6px 3px 6px;margin-right:22px}
			a.fb_button_medium_rtl:active{background-position:right -418px}
			.fb_button_small,
			.fb_button_small_rtl{background-position:left -232px;font-size: 10px;line-height:10px}
			.fb_button_small .fb_button_text{padding:2px 6px 3px;margin-left:17px}
			a.fb_button_small:active,
			.fb_button_small:active{background-position:left -250px}
			.fb_button_small_rtl{background-position:right -440px}
			.fb_button_small_rtl .fb_button_text{padding:2px 6px;margin-right:18px}
			a.fb_button_small_rtl:active{background-position:right -458px}
			.fb_share_count_wrapper{position:relative;float:left}
			.fb_share_count{background:#b0b9ec none repeat scroll 0 0;color:#333;font-family:"lucida grande", tahoma, verdana, arial, sans-serif;text-align:center}
			.fb_share_count_inner{background:#e8ebf2;display:block}
			.fb_share_count_right{margin-left:-1px;display:inline-block}
			.fb_share_count_right .fb_share_count_inner{border-top:solid 1px #e8ebf2;border-bottom:solid 1px #b0b9ec;margin:1px 1px 0 1px;font-size: 10px;line-height:10px;padding:2px 6px 3px;font-weight:bold}
			.fb_share_count_top{display:block;letter-spacing:-1px;line-height:34px;margin-bottom:7px;font-size: 22px;border:solid 1px #b0b9ec}
			.fb_share_count_nub_top{border:none;display:block;position:absolute;left:7px;top:35px;margin:0;padding:0;width:6px;height:7px;background-repeat:no-repeat;background-image:url(https://s-static.ak.facebook.com/rsrc.php/v1/zU/r/bSOHtKbCGYI.png)}
			.fb_share_count_nub_right{border:none;display:inline-block;padding:0;width:5px;height:10px;background-repeat:no-repeat;background-image:url(https://s-static.ak.facebook.com/rsrc.php/v1/zX/r/i_oIVTKMYsL.png);vertical-align:top;background-position:right 5px;z-index:10;left:2px;margin:0 2px 0 0;position:relative}
			.fb_share_no_count{display:none}
			.fb_share_size_Small .fb_share_count_right .fb_share_count_inner{font-size: 10px}
			.fb_share_size_Medium .fb_share_count_right .fb_share_count_inner{font-size: 11px;padding:2px 6px 3px;letter-spacing:-1px;line-height:14px}
			.fb_share_size_Large .fb_share_count_right .fb_share_count_inner{font-size: 13px;line-height:16px;padding:2px 6px 4px;font-weight:normal;letter-spacing:-1px}
			.fb_share_count_hidden .fb_share_count_nub_top,
			.fb_share_count_hidden .fb_share_count_top,
			.fb_share_count_hidden .fb_share_count_nub_right,
			.fb_share_count_hidden .fb_share_count_right{visibility:hidden}
			.fb_connect_bar_container div,
			.fb_connect_bar_container span,
			.fb_connect_bar_container a,
			.fb_connect_bar_container img,
			.fb_connect_bar_container strong{background:none;border-spacing:0;border:0;direction:ltr;font-style:normal;font-variant:normal;letter-spacing:normal;line-height:1;margin:0;overflow:visible;padding:0;text-align:left;text-decoration:none;text-indent:0;text-shadow:none;text-transform:none;visibility:visible;white-space:normal;word-spacing:normal;vertical-align:baseline}
			.fb_connect_bar_container{position:fixed;left:0 !important;right:0 !important;height:42px !important;padding:0 25px !important;margin:0 !important;vertical-align:middle !important;border-bottom:1px solid #333 !important;background:#3b5998 !important;z-index:99999999 !important;overflow:hidden !important}
			.fb_connect_bar_container_ie6{position:absolute;top:expression(document.compatMode=="CSS1Compat"? document.documentElement.scrollTop+"px":body.scrollTop+"px")}
			.fb_connect_bar{position:relative;margin:auto;height:100%;width:100%;padding:6px 0 0 0 !important;background:none;color:#fff !important;font-family:"lucida grande", tahoma, verdana, arial, sans-serif !important;font-size: 13px !important;font-style:normal !important;font-variant:normal !important;font-weight:normal !important;letter-spacing:normal !important;line-height:1 !important;text-decoration:none !important;text-indent:0 !important;text-shadow:none !important;text-transform:none !important;white-space:normal !important;word-spacing:normal !important}
			.fb_connect_bar a:hover{color:#fff}
			.fb_connect_bar .fb_profile img{height:30px;width:30px;vertical-align:middle;margin:0 6px 5px 0}
			.fb_connect_bar div a,
			.fb_connect_bar span,
			.fb_connect_bar span a{color:#bac6da;font-size: 11px;text-decoration:none}
			.fb_connect_bar .fb_buttons{float:right;margin-top:7px}
			.fb_edge_widget_with_comment{position:relative;*z-index:1000}
			.fb_edge_widget_with_comment span.fb_edge_comment_widget{position:absolute}
			.fb_edge_widget_with_comment span.fb_edge_comment_widget iframe.fb_ltr{left:-4px}
			.fb_edge_widget_with_comment span.fb_edge_comment_widget iframe.fb_rtl{left:2px}
			.fb_edge_widget_with_comment span.fb_send_button_form_widget{left:0;z-index:1}
			.fb_edge_widget_with_comment span.fb_send_button_form_widget .FB_Loader{left:0;top:1px;margin-top:6px;margin-left:0;background-position:50% 50%;background-color:#fff;height:150px;width:394px;border:1px #666 solid;border-bottom:2px solid #283e6c;z-index:1}
			.fb_edge_widget_with_comment span.fb_send_button_form_widget.dark .FB_Loader{background-color:#000;border-bottom:2px solid #ccc}
			.fb_edge_widget_with_comment span.fb_send_button_form_widget.siderender
			.FB_Loader{margin-top:0}
			#fb_social_bar_container{position:fixed;left:0;right:0;height:34px;padding:0 25px;z-index:999999999}
			.fb_social_bar_iframe{position:relative;float:right;opacity:0;-moz-opacity:0;filter:alpha(opacity=0)}
			.fb_social_bar_iframe_bottom_ie6{bottom:auto;top:expression(eval(document.documentElement.scrollTop+document.documentElement.clientHeight-this.offsetHeight-(parseInt(this.currentStyle.marginTop,10)||0)-(parseInt(this.currentStyle.marginBottom,10)||0)))}
			.fb_social_bar_iframe_top_ie6{bottom:auto;top:expression(eval(document.documentElement.scrollTop-this.offsetHeight-(parseInt(this.currentStyle.marginTop,10)||0)-(parseInt(this.currentStyle.marginBottom,10)||0)))}
		</style>
	</head>
	<body>
		<div id="fb-root" class=" fb_reset">
			<script src="https://connect.facebook.net/ko_KR/all.js" async=""></script><div style="position: absolute; top: -10000px; height: 0px; width: 0px; "></div>
		</div>
		<script type="text/javascript">
			window.fbAsyncInit = function() {
				FB.init({
					appId : '<?=$this->config->item('facebook_app_id');?>',
					status : true,   // check login status
					cookie : true,   // enable cookies to allow the server to access the session
					xfbml : true  // parse XFBML
				});

				FB.getLoginStatus(function(response) {
					if(response && (response.status !== "unknown")) {
						jQuery.cookie("fbs", response.status);
					} else {
						jQuery.cookie("fbs", null);
					}
				});
			};
			( function() {
				var e = document.createElement('script');
				e.src = document.location.protocol + '//connect.facebook.net/ko_KR/all.js';
				e.async = true;
				document.getElementById('fb-root').appendChild(e);
			}());

			Airbnb.SignInUp.setLocalizedMessages({
				"signup" : {
					"username" : {
						"required" : "\uc774\ub984\uc744 \uc785\ub825\ud558\uc138\uc694."
					},
					"password" : {
						"required" : "\ube44\ubc00\ubc88\ud638\ub97c \uc785\ub825\ud558\uc138\uc694.",
						"minlength" : "\ucd5c\uc18c 5 \uae00\uc790\uac00 \ud544\uc694\ud569\ub2c8\ub2e4."
					},
					"email" : {
						"email" : "\uc774\uba54\uc77c\uc744 \uc785\ub825\ud558\uc138\uc694.",
						"required" : "\uc774\uba54\uc77c\uc774 \ud544\uc694\ud569\ub2c8\ub2e4."
					},
					"password_confirmation" : {
						"equalTo" : "\ube44\ubc00\ubc88\ud638\uac00 \uc77c\uce58\ud558\uc9c0 \uc54a\uc2b5\ub2c8\ub2e4. ",
						"required" : "\ube44\ubc00\ubc88\ud638\ub97c \ud655\uc778\ud558\uc138\uc694.",
						"minlength" : "\ucd5c\uc18c 5 \uae00\uc790\uac00 \ud544\uc694\ud569\ub2c8\ub2e4."
					}
				},
				"signin" : {
					"password" : {
						"required" : "\ube44\ubc00\ubc88\ud638\ub97c \uc785\ub825\ud558\uc138\uc694.",
						"minlength" : "\ucd5c\uc18c 5 \uae00\uc790\uac00 \ud544\uc694\ud569\ub2c8\ub2e4."
					},
					"email" : {
						"email" : "\uc774\uba54\uc77c\uc744 \uc785\ub825\ud558\uc138\uc694.",
						"required" : "\uc774\uba54\uc77c\uc774 \ud544\uc694\ud569\ub2c8\ub2e4."
					}
				}
			});

			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-2725447-1']);
			_gaq.push(['_setDomainName', '.airbnb.com']);
			(function() {
				var m = /affiliate=([^;]*)/.exec(document.cookie);
				if(m) {_gaq.push(["_setCustomVar", 1, "affiliate", m[1]]);
				}
			})();

			_gaq.push(['_trackPageview']);
			(function() {
				var ga = document.createElement('script');
				ga.type = 'text/javascript';
				ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(ga, s);
			})();

			jQuery(document).ready(function() {
				Airbnb.init({
					userLoggedIn : false
				});
			});
			Airbnb.FACEBOOK_PERMS = "email,user_birthday,user_likes,user_education_history,user_hometown,user_interests,user_activities,user_location";

		</script>
