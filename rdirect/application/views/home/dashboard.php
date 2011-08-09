<?php 
	$this->load->helper('form');
	$this->load->view('header/home', $header);
	$this->load->view('top_menu', array('starred'=>$this->data['starred']));
?>

<?php if(true): // TODO: if countdown?>
<link rel="stylesheet" type="text/css" href="<?=CSS_DIR?>/jquery.countdown.css" /> 
<script type="text/javascript" src="<?=JS_DIR?>/jquery.countdown.js"></script>
<?php endif; ?> 

<script type="text/javascript"> 
    function wait_for_upload() {
        jQuery('#upload_image_submit_button').attr('disabled', 'disabled');
        jQuery('#upload_feedback').html("<img src='<?=IMG_DIR?>/blue_spinner.gif' />");
        jQuery('#user_pic').css({'opacity': 0.4, 'filter': 'alpha(opacity=40)'});
    }
    
    function upload_complete() {
        jQuery('#upload_image_submit_button').removeAttr('disabled');
        jQuery('#user_pic').css({'opacity': 1.0, 'filter': 'alpha(opacity=100)'});
        document.ajax_upload_form.reset();
    }
 
    function show_ajax_image_box() {
        jQuery('#ajax_upload_container').show();
    }
</script> 
 
 
 
<div id="command_center"> 
 
    
<link href="<?=CSS_DIR?>/print.css" media="print" rel="stylesheet" type="text/css" /> 
 
<ul id="nav"> 
	<li class="active"><?=anchor('dashboard', lang('command_center_dashboard'));?></li> 
	<li ><?=anchor('inbox', lang('command_center_inbox'));?></li> 
	<li ><?=anchor('rooms', lang('command_center_hosting'));?></li> 
	<li ><?=anchor('trips', lang('command_center_traveling'));?></li> 
	<li ><?=anchor('account', lang('command_center_account'));?></li> 
</ul> 
 
    <div id="dashboard"> 
        <div id="left"> 
            <div id="user_box" class="box"> 
                <div id="ajax_upload_container" style="display:none;"> 
                    <h3>Change your Photo</h3> 
                    <p class="about_photos"> 
                            Hello! You may upload new images as often as you like.
                    </p> 
 
 					<?=form_open('users/ajax_image_upload', array('target' => 'upload_frame', 'id' => 'ajax_upload_form', 'name' => 'ajax_upload_form', 'enctype' => 'multipart/form-data'));?>
                        <input id="user_profile_pic" name="userfile" size="20" type="file" /><br /> 
                        <!-- <input type="file" name="uploaded_file" /><br /> --> 
 
                        <br /> 
                        <input id="upload_image_submit_button" type="submit" value="Upload Photo" onclick="jQuery('#ajax_upload_form').submit(); wait_for_upload();" /> 
                    <?=form_close();?> 
                    <div id="upload_feedback"></div> 
 
                    <a href="javascript:void(0);" onclick="jQuery('#ajax_upload_container').fadeOut(400);">Close this window</a> 
                    <iframe id="upload_frame" name="upload_frame" style="display:none;"></iframe> 
                </div> 
 
                <div class="top"></div> 
                <div class="middle"> 
                    <div id="user_pic" onclick="show_ajax_image_box();"> 
                        <div id="edit_image_hover" style="display:none;" onclick="show_ajax_image_box();"><p>Change your Photo</p></div> 
                            <img alt="<?=$user->username?>" height="209" src="<?=$user->picture_path.'/large.png?'.time()?>" title="<?=$user->username?>" width="209" /> 
 
                    </div> 
                    <h1>Jisoo P<br /><span style="font-size:.55em; font-weight:bold; margin-left:2px;"><?=anchor('users/edit_profile', 'Edit Profile')?></span></h1> 
             
                </div><!-- middle --> 
                <div class="bottom">&nbsp;</div> 
            </div><!-- /user --> 
 
                <div id="quick_links" class="box"> 
                    <div class="top">&nbsp;</div> 
                    <div class="middle"> 
                        <h2>Quick Links</h2> 
                        <ul> 
                                <li><a href="/account">Get Recommendations</a></li> 
                                <li><a href="/rooms/new">Post a Room</a></li> 
                                <li><a href="/trips/upcoming">Upcoming Trips</a></li> 
                            
 
                        </ul> 
                    </div> 
                    <div class="bottom">&nbsp;</div> 
                </div><!-- /snapshot --> 
 
 
        </div><!-- /left --> 
 
        <div id="main"> 
 
                <div id="system_alert" class="box"> 
                    <div class="top">&nbsp;</div> 
                    <div class="middle"> 
                        <span style="font-weight:bold">Welcome to Airbnb!</span><br /> 
                        <span style="font-size:14px; padding-top:8px;"> 
                            <span style="line-height:16px; padding:6px 0 10px 0; display:block;">This is your Dashboard, the place to check your Inbox, respond to Reservation Requests, view upcoming Trip Information, and much more.</span> 
 
                            <ul class="welcome_alert"> 
                                    <li><a href="/info/how_it_works">Learn How It Works</a> &mdash; Watch a short video that shows you how Airbnb works.
                                    <li><a href="/rooms/new">Post A Room</a> &mdash; Make money by renting out your extra space.
                                    <li><a href="/groups">Join a group!</a> &mdash; Groups let you travel within interest groups or college networks.
                                    <li><a href="/users/friends">Build Your Reputation</a> &mdash; Ask friends to recommend you.
                                    <li><a href="http://www.twitter.com/airbnb">Follow @airbnb on Twitter</a> &mdash; Say Hi to us and we'll get back!
                                    <li><a href="/help">Get Help!</a> &mdash; View our help section and FAQs to get started on Airbnb.
                            </ul> 
 
                            <br /> 
                        </span> 
 
                    </div> 
                    <div class="bottom">&nbsp;</div> 
                </div> 
 
              <style> 
  #share {width:670px;margin:6px auto 15px; padding: 10px; font-size: 20px; font-weight: 600; text-align: center; font-shadow: 0 1px 1px white;}
  #share a {font-size:22px; margin-left: 10px;}
 
  .silver_box {border: 1px solid #d5d5d5; margin: 15px 0; width:980px; overflow:hidden;
    -moz-box-shadow: 0 3px 3px rgba(0, 0, 0, 0.07);
         box-shadow: 0 3px 3px rgba(0, 0, 0, 0.07);
    background: #ffffff; /* old browsers */
    background: -moz-linear-gradient(top, #ffffff 30%, #F0F0F0 100%); /* firefox */
    background: -webkit-gradient(linear, left top, left bottom, color-stop(30%,#ffffff), color-stop(100%,#F0F0F0)); /* webkit */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#F0F0F0',GradientType=0 ); /* ie */
    background: -o-linear-gradient(top, #ffffff 30%,#F0F0F0 100%); /* opera */}
</style> 
 
<div id="share" class="rounded_more silver_box"> 
  Invite your friends, earn $100 travel credit!
  <a href="/referrals" class="button-glossy green"> 
    Invite Now
  </a> 
</div> 
 
 
            <div id="alerts" class="box"> 
                <div class="top">&nbsp;</div> 
                <div class="middle"> 
                    <h2>Alerts</h2> 
                    
                    <ul> 
                    	      <li class="reservation_request"> 
                                        <a href="/z/a/5ETBAF">축하합니다! $19 예약 요청 
                                            <img src="/images/command_center/alert_right_arrow.png" width="12" height="11" alt="" /> 
                                        </a> 
                                        <p id="countdown_3798752" class="countdown"></p> 
 
                                        <script type="text/javascript"> 
                                            jQuery('#countdown_3798752').countdown({until: jQuery.countdown.UTCDate(0, 2011, 7, 9, 8, 54, 30), format:'HMS', compact:true});
                                        </script> 
                              </li> 
                    	<li class="default">
                            <a href="/users/payout_preferences">돈은 어떻게 드릴까요. 
                                <img src="<?=IMG_DIR?>/command_center/alert_right_arrow.png">
                            </a>
            	        </li>
                        <li class="recommend_review"> 
                                <a href="/account">Build instant reputation by having your friends vouch for you. 
                                    <img src="<?=IMG_DIR?>/command_center/alert_right_arrow.png" /> 
                                </a> 
						</li> 
						<li class=" alt">
								<div style="height:20px;">
									<fb:login-button id="fb_login2" size="large" onlogin="jQuery('#fb_login2').hide();jQuery('#login_spinner2').show();location.href='<?=site_url('users/populate_from_facebook')?>';" perms="<?=$this->config->item('facebook_scope')?>"></fb:login-button><span id="login_spinner2" style="padding-top:2px;padding-left:5px;display:none;">
										<img src="<?=IMG_DIR?>/spinner.gif"/>
									</span><span>Connecting to Facebook completes your profile and makes it easy to log in.</span>
								</div>
                        </li>                                
                    </ul> 
                </div> 
                <div class="bottom">&nbsp;</div> 
            </div> 
 
            <div id="messages" class="box"> 
 
                <div class="top">&nbsp;</div> 

<div class="middle">
	                    <h2>Messages (0 new)</h2>
					<?php if(true): ?>
	                    <ul>
	                        <li class="unread" id="thread_2052807"> 
	                            <div class="user"> 
	                                <a href="/users/show/778613" onclick="window.open(this.href);return false;"><img alt="Hojoon L" height="50" src="http://s0.muscache.com/1308680854/images/user_pic-50x50.png" title="Hojoon L" width="50" /></a> 
	                                <p> 
	                                    <a href="/users/show/778613" class="name" onclick="window.open(this.href);return false;">Hojoon</a> 
	                                    <br /> 
	                                    33분
	                                </p> 
	                            </div> 
	                            <div class="message_details"> 
	                                <p> 
	                                    <a href="/z/q/2052807">안녕하세요 안녕하세요 </a> 
	                                    <br /> 
	                                    <span class=locality>Seoul</span> 
	                                        (Aug 9 - 11, 2011)
	                                </p> 
	                            </div> 
	                            <div class="status"> 
	                                <div class="offer"> 
	                                    <p> 
	                                        
	                                            <span class="reservation_pending rounded_less">진행 중</span> 
	                                            <br /> 
	                                            <span class="value">$19</span> 
	                                    </p> 
	                                </div> 
	                            </div> 
	                        </li> 	                    	
	                        <li id="thread_2052807">
	                            <div class="user">
	                                <a href="/users/show/738217" onclick="window.open(this.href);return false;"><img alt="Choimyun 김" height="50" src="http://i0.muscache.com/users/738217/profile_pic/1311484343/small.jpg" title="Choimyun 김" width="50"></a>
	                                <p>
	                                    <a href="/users/show/738217" class="name" onclick="window.open(this.href);return false;">Choimyun</a>
	                                    <br>
	                                    29 minutes
	                                </p>
	                            </div>
	                            <div class="message_details">
	                                <p>
	                                    <a href="/z/q/2052807">안녕하세요 안녕하세요 </a>
	                                    <br>
	                                    <span class="locality">Seoul</span>
	                                        (Aug 9 - 11, 2011)
	                                </p>
	                            </div>
	                            <div class="status">
	                                <div class="offer">
	                                    <p>
	                                        
	                                            <span class="reservation_pending rounded_less">Pending</span>
	                                            <br>
	                                            <span class="value">$22</span>
	                                    </p>
	                                </div>
	                            </div>
	                        </li>
	                        <li id="thread_1750596">
	                            <div class="user">
	                                <a href="/users/show/755884" onclick="window.open(this.href);return false;"><img alt="Choimyun K" height="50" src="http://i3.muscache.com/users/755884/profile_pic/1311186351/small.jpg" title="Choimyun K" width="50"></a>
	                                <p>
	                                    <a href="/users/show/755884" class="name" onclick="window.open(this.href);return false;">Choimyun</a>
	                                    <br>
	                                    about 1 month
	                                </p>
	                            </div>
	                            <div class="message_details">
	                                <p>
	                                    <a href="/z/q/1750596">test after being expired</a>
	                                    <br>
	                                    <span class="locality">Seoul</span>
	                                        (Jul 5 - 6, 2011)
	                                </p>
	                            </div>
	                            <div class="status">
	                                <div class="offer">
	                                    <p>
	                                        
	                                            <span class="reservation_bad rounded_less">Expired</span>
	                                            <br>
	                                            <span class="value">$11</span>
	                                    </p>
	                                </div>
	                            </div>
	                        </li>
	                    </ul>
					<div id="more_messages">
						<a href="<?=site_url('inbox')?>" class="button-glossy">Go to all messages</a>
					</div>
					<div class="clear"></div>
				<?php else: ?>
				<p class="notice inbox_empty">Nothing to show you.</p>
				<?php endif; ?> 
			</div><!-- /middle --> 
			<div class="bottom">&nbsp;</div> 
		</div><!-- /messages --> 
 
        </div><!-- /main --> 
            <div class="clear"></div> 
    </div><!-- /dashboard --> 
</div><!-- /command_center --> 
 
<script type="text/javascript"> 
jQuery("#user_pic").hover(
    function(){jQuery('#edit_image_hover').fadeIn(100);},
    function(){jQuery('#edit_image_hover').fadeOut(100);}
); 
</script>

<?php //TODO: if(facebook connect required):  ?>
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
			e.src = document.location.protocol + '//connect.facebook.net/<?=CURRENT_LANGUAGE_CODE?>/all.js';
			e.async = true;
			document.getElementById('fb-root').appendChild(e);
		}());

	jQuery(document).ready(function() {
		Airbnb.init({userLoggedIn: <?=$this->tank_auth->is_logged_in()?'true':'false'?>});
	});

	Airbnb.FACEBOOK_PERMS = '<?=$this->config->item('facebook_scope')?>';
</script>
<?php //endif; ?>

<?php $this->load->view('footer'); ?> 