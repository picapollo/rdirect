<?php 
	$this->load->view('header/home', $header); 
	$this->load->view('top_menu', $user);
	$this->load->helper('form');
?>

<script type="text/javascript"> 
    function wait_for_upload() {
        jQuery('#upload_image_submit_button').attr('disabled', 'disabled');
        jQuery('#upload_feedback').html("<img src='/images/blue_spinner.gif' />");
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
	<li class="active"><?=anchor('dashboard', 'Dashboard');?></li> 
	<li ><?=anchor('inbox', 'Inbox');?></li> 
	<li ><?=anchor('rooms', 'Hosting');?></li> 
	<li ><?=anchor('trips', 'Traveling');?></li> 
	<li ><?=anchor('account', 'Account');?></li> 
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
                        <input id="user_profile_pic" name="user[profile_pic]" size="20" type="file" /><br /> 
                        <!-- <input type="file" name="uploaded_file" /><br /> --> 
 
                        <br /> 
                        <input id="upload_image_submit_button" type="submit" value="Upload Photo" onclick="jQuery('#ajax_upload_form').submit(); wait_for_upload();" /> 
                    <?=form_close();?> 
                    <div id="upload_feedback"></div> 
 
                    <a href="javascript:void(0);" onclick="jQuery('#ajax_upload_container').fadeOut(400);">Close this window</a> 
                    <iframe id="upload_frame" name="upload_frame" style="display:none;"></iframe> 
                </div> 
 
                <div class="top">&nbsp;</div> 
                <div class="middle"> 
 
                    <div id="user_pic" onclick="show_ajax_image_box();"> 
                        <div id="edit_image_hover" style="display:none;" onclick="show_ajax_image_box();"><p>Change your Photo</p></div> 
                            <img alt="Jisoo P" height="209" src="http://i0.muscache.com/users/832778/profile_pic/1310968654/square_225.jpg" title="Jisoo P" width="209" /> 
 
                    </div> 
                    <h1>Jisoo P<br /><span style="font-size:.55em; font-weight:bold; margin-left:2px;"><a href="/users/edit">Edit Profile</a></span></h1> 
             
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
                                <li class="recommend_review"> 
                                        <a href="/account">Build instant reputation by having your friends vouch for you. 
                                            <img src="<?=IMG_DIR?>/command_center/alert_right_arrow.png" /> 
                                        </a> 
                                </li> 
                    </ul> 
                </div> 
                <div class="bottom">&nbsp;</div> 
            </div> 
 
            <div id="messages" class="box"> 
 
                <div class="top">&nbsp;</div> 
                <div class="middle"> 
                    <h2>Messages (0 new)</h2> 
                    <p class="notice inbox_empty">Nothing to show you.</p> 
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

<?php $this->load->view('footer'); ?> 