

<script type="text/javascript">
  function isValidDate(d) {
    if(Object.prototype.toString.call(d) !== "[object Date]")
      return false;

    return !isNaN(d.getTime());
  }

    function lwlb_message_button_click () {
        var dateFormat = jQuery.datepicker._defaults.dateFormat;
        if (jQuery('#message_checkin').val() === dateFormat ||
                jQuery('#message_checkout').val() === dateFormat) {
            alert("Please enter your Checkin and Checkout dates before messaging the host.");
            return;
        }

        if (jQuery('#question').is(':disabled')) {
            alert("Sorry, you cannot message this host because the dates you have selected are unavailable.");
            return;
        }

        var checkin_date = jQuery.datepicker.parseDate(dateFormat, jQuery('#message_checkin').val());
        var yesterday = new Date('2011-07-27');
        if (!isValidDate(checkin_date) || (yesterday>checkin_date)) {
            alert('Please enter a valid start date.');
            return false;
        }

        var checkout_date = jQuery.datepicker.parseDate(dateFormat, jQuery('#message_checkout').val());

        // fix the case where the entered date range is way too large
        // if the delta time between the two is greater than a year, then error out!
        if((checkout_date.getTime() - checkin_date.getTime()) > 32000000000){
            alert("Please enter a valid date range.");
            return false;
        }

        if (jQuery('#question').val() == '') {
            alert("Please enter a message.");
            return;
        }

        if (!censor_validate_content(jQuery('#question').val(), false)) return;
        
            jQuery('#intended_action').val('message');
            jQuery('#lwlb_message_spinner').show();
            jQuery('#lwlb_message_button').hide();
            jQuery('#message_form').submit();
        
    }
    
    function lwlb_reset_messaging () {
        jQuery('#question').val("");
        jQuery('#already_messaged').hide();
        jQuery('#lwlb_contact_message').show();
        jQuery('#lwlb_contact_login, #lwlb_fb_signup, #lwlb_contact_signup, #lwlb_contact_done, #lwlb_contact_standby_option').hide();
        
        jQuery('#dates_other_error').html("");
        jQuery('#dates_other_error').hide();
        jQuery('#dates_not_available').hide();

            jQuery('#dates_available').hide();
        
        jQuery('#message_checkin').val("mm/dd/yy");
        jQuery('#message_checkout').val("mm/dd/yy");

    jQuery('#dates_not_entered').show();
    jQuery('#question_holder').css('opacity', '1.0');
    }

    
    function lwlb_standby_url() {
        var params = { standby_country: "ID", standby_state: "East Java", standby_city: "Malang", standby_checkin: jQuery('#message_checkin').val(), standby_checkout: jQuery('#message_checkout').val() };
        return "/messaging/standby?" + jQuery.param(params);
    }
        
        function check_availability_of_dates () {
            var dateFormat = jQuery.datepicker._defaults.dateFormat;
            //copy changes to book it box
            copy_message_fields_to_book_it();

            if((jQuery('#message_checkin').val() === dateFormat) ||
                    (jQuery('#message_checkout').val() === dateFormat)) {
                return false;
            }

            //refresh the book_it box
            refresh_subtotal();
            jQuery('#dates_not_entered').hide();
            jQuery.getJSON("/rooms/ajax_check_dates/184100", 
              {checkin: jQuery('#message_checkin').val(), checkout: jQuery('#message_checkout').val(), number_of_guests: jQuery('#message_number_of_guests').val()},
              function(data){
                availability_check_complete();
                eval(data['status'] + '();');
              }
            );
            
            jQuery('#message_check_in_checkout_label').html("<img src='/images/spinner.gif' />");
        }

        function availability_check_complete() {
            jQuery('#question').attr('disabled', 'disabled');
            jQuery('#question_holder').css('opacity', '0.5');
            jQuery('#message_check_in_checkout_label').html("Check in/out:");
        }
        
        function is_not_min_stay () {
            jQuery('#dates_not_available').hide();
            jQuery('#dates_available').hide();
            jQuery('#dates_other_error').html("Minimum stay is 1 night");
      jQuery('#dates_other_error').show();
        }
    
        function is_not_available_too_many_guests () {
            jQuery('#dates_not_available').hide();
            jQuery('#dates_available').hide();
            jQuery('#dates_other_error').html("Maximum guests is 1<br /><a href='#' onclick='re_search();return false;'>View available dates</a>");
      jQuery('#dates_other_error').show();
        }

    function is_not_variable_min_stay (length) {
            jQuery('#dates_not_available').hide();
            jQuery('#dates_available').hide();
            jQuery('#dates_other_error').html("The duration of your stay is too short");
      jQuery('#dates_other_error').show();
        }

    function is_not_max_stay () {
      jQuery('#dates_not_available').hide();
            jQuery('#dates_available').hide();
            jQuery('#dates_other_error').html("Maximum stay is 365 nights");
      jQuery('#dates_other_error').show();
        }
        
        function is_available () {
      jQuery('#question').removeAttr('disabled');

      /* This is a hack for certain builds of Webkit (Safari & Chrome) 
       * Without this hack, the empty textarea receives focus, but the user cannot enter any text into it.  */
      if (jQuery('#question').val().length == 0)
      {
          jQuery('#question').val(" ");
          jQuery('#question').val("");
      }
      /* end of the hack */

      jQuery('#question_holder').css('opacity', '1.0');
            jQuery('#dates_not_available').hide();
            jQuery('#dates_other_error').html("");
      jQuery('#dates_other_error').hide();
            jQuery('#dates_available').show();
        }
        
        function not_available () {
            jQuery('#dates_available').hide();
            jQuery('#dates_other_error').html("");
      jQuery('#dates_other_error').hide();
            jQuery('#dates_not_available').show();
            //alert('One or more of the selected days are not available. We suggest that you review the calendar for this property and change your dates. Otherwise re-do your search and include your desired dates. You may still message the host if you like.');
        }
        
        function show_calendar() {
            lwlb_hide_and_reset('lwlb_contact');
            select_tab('main', 'calendar', jQuery('#calendar_link'));
            load_initial_month();
        }
        
        function re_search() {
            var url = "http://www.airbnb.com/travel/malang/id";
            url += "?checkin=" + jQuery('#message_checkin').val() + "&checkout=" + jQuery('#message_checkout').val() + "&number_of_guests=" + jQuery('#message_number_of_guests').val();
            window.location = url;
        }
        
</script>

<div id="lwlb_contact" class="lwlb_lightbox2">

<script type="text/javascript">
jQuery(document).ready(function(){
  // generate the FB button asynchonously, since this partial is being loaded asynchronously as well
  window.fbAsyncInit();

    jQuery("#fb-connect-button").click(function(e) {
        var $button = jQuery(this);
        $button.addClass("loading");
        FB.login(function(response) {
            if (response.session) {
                lwlb_login_button_click();
                jQuery("#lwlb_fb_signup").hide();
            }
            $button.removeClass("loading");
        }, {perms: "email,user_birthday,user_likes,user_education_history,user_hometown,user_interests,user_activities,user_location"});
        e.preventDefault();
    });

  jQuery('#message_form').submit(function(){
    var action = jQuery(this).attr('action');
  
    jQuery.post(action,
      jQuery(this).serialize(),
      function(data){
        if(data['message'] == ''){
          if(data['show_standby'])
            jQuery('#lwlb_contact_standby_option').show();

          if(data['similar_properties_content'] != null)
            jQuery('#recommended').html(data['similar_properties_content']);

          if(data['adwords_tracking_content'] != null)
            jQuery('#adwords_tracking').html(data['adwords_tracking_content']);

          jQuery('#lwlb_contact_message, #lwlb_contact_login, #lwlb_contact_signup, #lwlb_fb_signup').hide();
          jQuery('#lwlb_contact_done').show();
        }
        else {
          alert(data["message"]);
        }

        var intended_action = jQuery('#intended_action').val();

        switch(intended_action){
          case "message":
            jQuery('#lwlb_message_spinner').hide();
            jQuery('#lwlb_message_button').show();
            break;
          case "login":
            jQuery('#lwlb_login_spinner').hide();
            jQuery('#lwlb_login_button').show();
            break;
          case "signup":
            jQuery('#lwlb_signup_spinner').hide();
            jQuery('#lwlb_signup_button').show();
            break;
        }
      },
      'json'
    );
    
    return false;
  });
});
</script>

<form action="/users/ask_question/184100" id="message_form" method="post">      <input id="intended_action" name="intended_action" type="hidden" />
        <input id="simplified_finish_page" name="simplified_finish_page" type="hidden" value="false" />
        <input type="hidden" name="signup_flow" value="page_3_message"/>

        <div id="lwlb_contact_message"><!-- MESSAGE SCREEN -->
            <div class="header clearfix">
                <div class="h1"><h1>Send Message</h1></div>
                <div class="close"><a href="#" onclick="lwlb_hide_and_reset('lwlb_contact');return false;"><img src="/images/lightboxes/close_button.gif" /></a></div>
            </div>
            
            <table style="width:510px;">
                <tr>
                  <td class="label">To:</td>
                  <td><input disabled="disabled" id="to" name="to" type="text" value="Choimyun" /></td>
                  <td>
                        <span class="messaging_alert bad" style="display:none;" id="already_messaged">You've messaged this person before. <a href="/messaging/qt_with/755884" onclick="window.open(this.href);return false;">View previous messages</a></span>  
                  </td>
                </tr>
                    <tr>
                        <td class="label" id="message_check_in_checkout_label">Check in/out:</td>
                        <td style="width:190px;">
                            <input type="text" style="width:80px;" id="message_checkin" class="checkin" name="message_checkin" value="mm/dd/yy" />
                            <input type="text" style="width:80px;" id="message_checkout" class="checkout" name="message_checkout" value="mm/dd/yy" />
                        </td>

                        <td>
                            <span id="dates_available" class="messaging_alert" style="display:none;">Dates appear to be available.</span>
                            <span id="dates_not_available" class="messaging_alert" style="display:none;"><span class="bad">These dates are unavailable.</span><br /><a href="#" onclick="show_calendar();return false;">View available dates</a>.</span>
                                <span id="dates_other_error" class="messaging_alert bad" style="display:none;"></span>
                            <span id="dates_not_entered" class="messaging_alert" style="display:block;">
                                <span id="dates_not_entered_inner">
                                    When are you traveling?
                                </span>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Guests</td>
                        <td style="width:190px;">
                            <select id="message_number_of_guests" name="message_number_of_guests" onchange="check_availability_of_dates();" style="margin-top:5px;"><option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16+</option></select>
                        </td>
                    </tr>
                <tr id="question_holder"><td class="label">Message:</td><td colspan="2"><textarea id="question" name="question" style="width:98%;height:135px;"></textarea></td></tr>
            </table>
            
            <table style="510px;margin-top:5px;">
                <tr>
                    <td class="label">&nbsp;</td>
                    <td style="width:100px;">
                        <input type="submit" class='v3_button v3_blue' id='lwlb_message_button' onclick="lwlb_message_button_click();return false;" value="Send Message" />
                        <img id="lwlb_message_spinner" src="/images/spinner.gif" style="display:none;" />
                    </td>
                    <td style="vertical-align:middle;">
                        &nbsp;or <a href="#" onclick="lwlb_hide_and_reset('lwlb_contact');return false;">Cancel</a>
                    </td>
                </tr>
            </table>
        </div>
        
        <div id="lwlb_contact_signup" style="display:none;"><!-- SIGNUP SCREEN -->
            <div class="header clearfix">
                <div class="h1">
                    <h1>Sign up to send your message</h1>
                    <a href="#" onclick="jQuery('#lwlb_contact_signup').hide();jQuery('#lwlb_contact_login').show();return false;">Already have an account?</a>
                </div>
                <img onclick="lwlb_hide_and_reset('lwlb_contact');" height="17" width="18" class="closeimg" src="/images/lightboxes/close_button.gif" />
            </div>
       <span class="login_prompt">Sign in using Facebook:</span><br/>
<div style="padding-top:5px; min-height:25px;"><fb:login-button id="fb_login" size="large" onlogin="jQuery('#fb_login').hide();jQuery('#login_spinner').show();lwlb_login_button_click();" perms="email,user_birthday,user_likes,user_education_history,user_hometown,user_interests,user_activities,user_location"></fb:login-button><span id="login_spinner" style="position:absolute;padding-top:2px;padding-left:5px;display:none"><img src="/images/spinner.gif"/></span></div>

            <hr class="login_separator_bar"/><br/>

            <span class="login_prompt">Or standard sign in:</span>
            <table>
                <tr><td class="label">First Name:</td><td><input id="first_name" name="first_name" type="text" /></td></tr>
                <tr><td class="label">Last Name:</td><td><input id="last_name" name="last_name" type="text" /></td></tr>
                <tr><td class="label">Email:</td><td><input id="email" name="email" type="text" /></td></tr>
                <tr><td class="label">Password:</td><td><input id="password" name="password" type="password" /></td></tr>
            </table>
            <table style="margin-top:5px;">
                <tr>
                    <td class="label">&nbsp;</td>
                    <td style="width:360px; vertical-align:bottom;">
                        <input type="submit" class='v3_button v3_blue' id='lwlb_signup_button' onclick="lwlb_signup_button_click();return false;" value="Create Account & Send Message" />
                        <img id="lwlb_signup_spinner" height="16" width="16" src="/images/spinner.gif" style="display:none;" alt="" />
                    </td>
                    <td style="vertical-align:middle;">
                        or <a href="#" onclick="jQuery('#lwlb_contact_signup').hide();jQuery('#lwlb_contact_message').show();return false;">go back</a>
                    </td>
                </tr>
            </table>
        </div>

        <div id="lwlb_fb_signup" style="text-align: center; display: none;"><!-- FB SIGNUP -->
            <div class="header clearfix" style="border-bottom: 1px solid #EAEAEA; padding-bottom: 13px; margin-bottom: 13px;">
                <div class="h1">
                    <h1>Sign up to send your message</h1>
                    <a href="#" onclick="jQuery('#lwlb_fb_signup').hide();jQuery('#lwlb_contact_login').show();return false;">Already have an account?</a>
                </div>
                <img onclick="lwlb_hide_and_reset('lwlb_contact');" height="17" width="18" class="closeimg" src="/images/lightboxes/close_button.gif" />
            </div>
            <iframe src="http://www.facebook.com/plugins/facepile.php?app_id=138566025676&amp;max_rows=2"
                scrolling="no" frameborder="0" allowTransparency="true"
                style="border:none; overflow:hidden; width:282px; height:120px;"></iframe>
            <div>
                <a id="fb-connect-button" class="fb-button" href="#">
                    <span class="fb-button-left"></span>
                    <span class="fb-button-center"><strong>Connect</strong> with <strong>Facebook</strong></span>
                    <span class="fb-button-right"></span>
                </a>
            </div>
            <div class="fb-or-separator signpainter">or</div>
            <p style="font-size: 14px; margin-top: 12px;"><a href="#" onclick="jQuery('#lwlb_fb_signup').hide();jQuery('#lwlb_contact_signup').show();return false;">Create an account with your email address</a></p>
            <div style="padding-top:10px; color:#5D5D5D; width:300px; margin:0 auto; font-size: 11px;">
                By clicking "Connect with Facebook" you confirm that you accept the 
                <a href="/terms" onclick="window.open(this.href);return false;">Terms of Service</a>.
            </div>
        </div>

        <div id="lwlb_contact_login" style="display:none;"><!-- LOGIN SCREEN -->
            <div class="header clearfix">
                <div class="h1">
                    <h1>Log in to send your message</h1>
                    <a href="#" onclick="jQuery('#lwlb_contact_login').hide();if(window.FB && jQuery.cookie('fbs')){jQuery('#lwlb_fb_signup').show();}else{jQuery('#lwlb_contact_signup').show();}return false;">Create an account?</a>
                </div>
                <div class="close"><a href="#" onclick="lwlb_hide_and_reset('lwlb_contact');return false;"><img src="/images/lightboxes/close_button.gif" /></a></div>
            </div>

           <span class="login_prompt">Sign in using Facebook:</span><br/>
          <div style="padding-top:5px;height:20px;"><fb:login-button id="fb_login2" size="large" onlogin="jQuery('#fb_login2').hide();jQuery('#login_spinner2').show();lwlb_login_button_click();" perms="email,user_birthday,user_likes,user_education_history,user_hometown,user_interests,user_activities,user_location"></fb:login-button><span id="login_spinner2" style="position:absolute;padding-top:2px;padding-left:5px;display:none"><img src="/images/spinner.gif"/></span></div>
          
              <br/><hr class="login_separator_bar"/><br/><br/>

                <span class="login_prompt">Or standard sign in:</span>

            <table style="width:510px;">
            <tr><td class="label">Email:</td><td><input id="login_email" name="login_email" type="text" /></td></tr>
            <tr><td class="label">Password:</td><td><input id="login_password" name="login_password" type="password" /></td></tr>
            </table>
        
            <table style="width:510px;margin-top:5px;">
                <tr>
                    <td class="label">&nbsp;</td>
                    <td style="width:290px;">
                        <input type="submit" class='v3_button v3_blue' id='lwlb_login_button' onclick="lwlb_login_button_click();return false;" value="Log in and Send Message" />
                        <img id="lwlb_login_spinner" src="/images/spinner.gif" style="display:none;" />
                    </td>
                    <td style="vertical-align:middle;">
                        <a href="https://www.airbnb.com/forgot_password" onclick="window.open(this.href);return false;">Forgot password?</a>
                    </td>
                </tr>
            </table>
        </div>
        
        <div id="lwlb_contact_done" style="display:none;"><!-- COMPLETION SCREEN -->
            <div class="header clearfix">
                <div class="h1">
                    <div style="height:50px;width:510px;background-color:#fffca8;border:#e5dd00 thin solid;text-align:center;font-size:22px;font-weight:bold;">
                        <div style="margin-top:10px;color:#3e3e3e;">
                            Your message has been sent!
                        </div>
                    </div>
                </div>
                <div class="close"><a href="#" onclick="lwlb_hide_and_reset('lwlb_contact');return false;"><img src="/images/lightboxes/close_button.gif" /></a></div>
            </div>
            
                <p>
                    The response will be e-mailed to you.
                    <a href="/users/edit" onclick="window.open(this.href);return false;">Please update your profile and add a picture</a>.
                </p>
                
                <p>We encourage you to message multiple hosts:</p>
                <ul>
                    <li id="lwlb_contact_standby_option" style="display:none;"><a href="#" onclick="window.open(lwlb_standby_url()); return false;">Need a place <i>pronto</i>? Join the standby list.</a></li>
                    <li><a href="/search" onclick="if(redo_search()){return false;}">Return to search results</a></li>
                    <li><a href="#" onclick="lwlb_hide_and_reset('lwlb_contact');return false;">Return to this listing</a></li>
                </ul>
                
                <div id="recommended" style="margin-top:20px;width:500px;">
                </div>
                
                <div id="adwords_tracking"></div>
        </div>

</form></div>
