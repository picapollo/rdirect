

<link href="http://s0.muscache.com/1312793566/stylesheets/dashboard_v2.css" media="screen" rel="stylesheet" type="text/css" />

<script type="text/javascript">
  // determine whether to show the phone verification container or not
  jQuery('input[name="guest_preferences[host_can_call]"]').change(function(){
    if(jQuery(this).val() === "yes"){
      jQuery('#lwlb_contact_phone_set').fadeIn();
    }
    else {
      jQuery('#lwlb_contact_phone_set').fadeOut();
    }
  });

  jQuery('#take-profile-pic').click(function(){
    jQuery('#lwlb_contact_requirements').hide();    
    jQuery('#lwlb_contact_photo').show();
  });

  jQuery('#return-to-message').click(function(){
    jQuery('#lwlb_contact_requirements').show();    
    jQuery('#lwlb_contact_photo').hide();
  });

  jQuery('#wrong-timezone').click(function(){
    jQuery(this).parent().addClass('change');
  });

  if(jQuery.browser.webkit)
    jQuery('body').addClass('webkit');

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
        var yesterday = new Date('2011-08-07');
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
        
                jQuery('#lwlb_contact_message').hide();
                jQuery('#lwlb_contact_requirements').show();


                    jQuery('#lwlb_contact_profile').show();
        
    }

  function lwlb_submit_verification(){
    if(jQuery.trim(jQuery('#user_profile_info_about').val()) == ''){
      alert('You need to enter a profile description!');
      return false;
    }



    jQuery('#intended_action').val('message');
    jQuery('#lwlb_message_spinner_req').show();
    jQuery('#lwlb_message_button_req').hide();
    jQuery('#message_form').submit();
  }
    
    function lwlb_reset_messaging () {
        jQuery('#question').val("");
    jQuery('#messaging-errors').removeClass('other not-available contacted-before');

        jQuery('#message_checkin').val("08/18/2011");
        jQuery('#message_checkout').val("08/19/2011");

    jQuery('#dates_not_entered').show();
    jQuery('#question_holder').css('opacity', '1.0');

        clearInterval(jQuery('#verify_instructions').data('checkInterval'));
    }

    
    function lwlb_standby_url() {
        var params = { standby_country: "KR", standby_state: null, standby_city: "Seoul", standby_checkin: jQuery('#message_checkin').val(), standby_checkout: jQuery('#message_checkout').val() };
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
            jQuery.getJSON("/rooms/ajax_check_dates/193448", 
              {checkin: jQuery('#message_checkin').val(), checkout: jQuery('#message_checkout').val(), number_of_guests: jQuery('#message_number_of_guests').val()},
              function(data){
                availability_check_complete();
                eval(data['status'] + '();');
              }
            );
            
            jQuery('#message_check_in_checkout_label').html("<img src='/images/spinner.gif' />");
        }

        function availability_check_complete() {
            jQuery('#question, #lwlb_message_button').attr('disabled', 'disabled');
            jQuery('#question_holder').css('opacity', '0.5');
            jQuery('#message_check_in_checkout_label').html("Check in/out:");
        }
        
        function is_not_min_stay () {
            jQuery('#dates_other_error').html("<strong>Minimum stay is 1 night(s).</strong>");
      jQuery('#messaging-errors').removeClass('not-available').addClass('other');
        }
    
        function is_not_available_too_many_guests () {
            jQuery('#dates_other_error').html("<strong>Maximum guests is 2 guest(s).</strong> <a href='#' onclick='re_search();return false;'>View available dates</a>");
      jQuery('#messaging-errors').removeClass('not-available').addClass('other');
        }

    function is_not_variable_min_stay (length) {
            jQuery('#dates_other_error').html("<strong>The duration of your stay is too short</strong>");
      jQuery('#messaging-errors').removeClass('not-available').addClass('other');
        }

    function is_not_max_stay () {
            jQuery('#dates_other_error').html("<strong>Maximum stay is 365 nights.</strong>");
      jQuery('#messaging-errors').removeClass('not-available').addClass('other');
        }
        
        function is_available () {
      jQuery('#question, #lwlb_message_button').removeAttr('disabled');

      /* This is a hack for certain builds of Webkit (Safari & Chrome) 
       * Without this hack, the empty textarea receives focus, but the user cannot enter any text into it.  */
      if (jQuery('#question').val().length == 0)
      {
          jQuery('#question').val(" ");
          jQuery('#question').val("");
      }
      /* end of the hack */

      jQuery('#question_holder').css('opacity', '1.0');
      jQuery('#messaging-errors').removeClass('not-available').removeClass('other');
        }
        
        function not_available () {
      jQuery('#messaging-errors').removeClass('other').addClass('not-available');
        }
        
        function show_calendar() {
            lwlb_hide_and_reset('lwlb_contact');
            select_tab('main', 'calendar', jQuery('#calendar_link'));
            load_initial_month();
        }
        
        function re_search() {
            var url = "http://www.airbnb.com/travel/seoul/kr";
            url += "?checkin=" + jQuery('#message_checkin').val() + "&checkout=" + jQuery('#message_checkout').val() + "&number_of_guests=" + jQuery('#message_number_of_guests').val();
            window.location = url;
        }
</script>


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

    jQuery('#phone_set_submit_sms').click(function(e) {
        e.preventDefault();
        phoneVerificationSpinner(true);
        phoneSetSubmit('sms');
    });
    
    jQuery('#phone_set_submit_call').click(function(e) {
        e.preventDefault();
        phoneVerificationSpinner(true);
        phoneSetSubmit('call');
    });
    
    function phoneVerificationSpinner(mode) {
      if(mode) {
      jQuery('#phone_verify_submit').hide();
      jQuery('#phone_set_submit_sms').hide();
      jQuery('#phone_set_submit_call').hide();
      jQuery('#verification-error').hide();
      jQuery('.phone_verification_spinner').show();
      }
      else {
      jQuery('#phone_verify_submit').show();
      jQuery('#phone_set_submit_sms').show();
      jQuery('#phone_set_submit_call').show();
      jQuery('#verification-error').show();
      jQuery('.phone_verification_spinner').hide();
      }
    }
    
    function phoneSetSubmit(phone_type) {
        if (jQuery('#phone_number') && typeof jQuery('#phone_number').validatedPhone != 'undefined' && jQuery('#phone_number').validatePhone()) {
            jQuery('#phone_type').val(phone_type);
            jQuery.getJSON("/rooms/ajax_phone_set", {phone_number: jQuery('#phone_number').val(), phone_number_country: jQuery('#phone_number_country').val(), phone_type: phone_type}, function(data){
                if(data['result'] == 'success') {
                    jQuery('#lwlb_contact_phone_set').hide();
                    jQuery('#lwlb_contact_phone_verify').show();
                    jQuery('#lwlb_contact_phone_verify_call, #lwlb_contact_phone_verify_sms').hide();
                    jQuery('#lwlb_contact_phone_verify_'+phone_type).show();
                    jQuery('#lwlb_contact_phone_verify_number').text(jQuery('#phone_number').val());
                    
                    if (phone_type == 'call') {
                        jQuery('#verify_instructions').data('checkInterval', setInterval(function() {
                            jQuery.getJSON("/rooms/ajax_phone_status", function(data) { 
                                if (data['status']) {
                                    jQuery('#verify_instructions div').hide();
                                    jQuery('#verify_instructions div.'+data['status']).show();
                                }
                            });
                        }, 1000));
                    }
          phoneVerificationSpinner(false);
                } else {
          phoneVerificationSpinner(false);
                    alert(data['error']);
                }

            });
        }
    }
    
    jQuery('#phone_verify_submit').click(function(e) {
        phoneVerificationSpinner(true);
        e.preventDefault();
        jQuery.getJSON("/rooms/ajax_phone_verify", {verification_code: jQuery('#phone_verification_code').val(), phone_type: jQuery('#phone_type').val()}, function(data) {
            if(data['result'] == 'success') {
        jQuery('.phone_verification_fields').addClass('success'); 
        jQuery('#lwlb_contact_phone_verify').hide();
        jQuery('#lwlb_contact_phone_set').show();
        jQuery('#phone_number').attr('disabled', 'disabled').data('verified-phone', true); 
        jQuery('label[for="phone_number"]').html('Your phone number is verified!');
        phoneVerificationSpinner(false);
        jQuery('#phone_set_submit_sms').hide();
        jQuery('#phone_set_submit_call').hide();
            } else {
        phoneVerificationSpinner(false);
                alert(data['error']);
            }
        });
    });
    
    jQuery('.phone_wrong_number').click(function(e) {
        e.preventDefault();
        jQuery('#lwlb_contact_phone_verify').hide();
        jQuery('#verify_instructions div').hide();
        jQuery('#lwlb_contact_phone_set').show();
        clearInterval(jQuery('#verify_instructions').data('checkInterval'));
    });
    
    
  jQuery('#message_form').submit(function(){
    var action = jQuery(this).attr('action');
    var questionContent = jQuery('#question').val();
  
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

          jQuery('.submit-or-cancel').addClass('sent');

          setTimeout(function(){
            lwlb_hide_and_reset('lwlb_contact');
          }, 2000);
        }
        else {
          if(!data["require_more_info"]){
            alert(data["message"]);
          }
        }

        if(!data["require_more_info"]){
          if(data['message'] !== ''){
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
          }
        }
        // reload the lwlb in the DOM, and then switch over to the 'more info' pane
        else {
          var dateFormat = jQuery.datepicker._defaults.dateFormat;

          jQuery('#lwlb_contact_container').load(ajax_lwlb_contact_url, null, function() {
            jQuery('#message_checkin').val(dateFormat);
            jQuery('#message_checkout').val(dateFormat);

            setup_lwlb_contact();

            jQuery('#message_form').airbnbInputDateSpan({
              onCheckinClose: check_availability_of_dates,
              onCheckoutClose: check_availability_of_dates
            });

            jQuery('#question').val(questionContent);

            lwlb_message_button_click();
          });
        }
      },
      'json'
    );
    
    return false;
  });
});
</script>

<div id="lwlb_contact" class="lwlb_lightbox2">
  <div id="dashboard_v2">
        
<form action="/users/ask_question/193448?nights=1&amp;number_of_guests=1" id="message_form" method="post">      <input id="intended_action" name="intended_action" type="hidden" />
        <input id="simplified_finish_page" name="simplified_finish_page" type="hidden" value="false" />
    <input type="hidden" name="signup_flow" value="page_3_message"/>

        <div id="lwlb_contact_message"><!-- MESSAGE SCREEN -->
      <img onclick="lwlb_hide_and_reset('lwlb_contact');" class="closeimg" src="/images/colorbox/fancy_colorbox_close.png" />
      <div class="content-row">
        <h2>Send Message to Choimyun 김</h2>
      </div>
      <div class="reservation-parameters content-row">
        <div id="messaging-errors" class="error-block">
          <span class="contacted-before"><strong>You've contacted this guest before.</strong> <a href="/messaging/qt_with/738217" onclick="window.open(this.href);return false;">View previous messages</a></span>
          <span class="not-available"><strong>These dates aren't available.</strong> You need to select available ones first.</span>
          <span id="dates_other_error" class="other"></span>
        </div>
        <div class="parameter-block">
          <label for="message_checkin">Check in</label>
          <input class="checkin date" id="message_checkin" name="message_checkin" type="text" value="08/18/2011" />
        </div>
        <div class="parameter-block">
          <label for="message_checkout">Check out</label>
          <input class="checkout date" id="message_checkout" name="message_checkout" type="text" value="08/19/2011" />
        </div>
        <div class="parameter-block">
          <label for="message_number_of_guests">Guests</label>
          <select id="message_number_of_guests" name="message_number_of_guests" onchange="check_availability_of_dates();"><option value="1" selected="selected">1</option>
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
        </div>
      </div>
      <div class="content-row">
        <div class="full-field-block">
          <span class="suggestion">Tell Choimyun 김 what you like about their place, what matters most about your accommodations, or ask them a question.</span>
          <textarea id="question" name="question"></textarea>
        </div>
      </div>
      <div class="content-row">
        <div class="full-field-block submit-or-cancel">
          <input class="button-glossy blue" id="lwlb_message_button" name="commit" onclick="lwlb_message_button_click(); return false;" type="submit" value="Continue" />
          <span><img id="lwlb_message_spinner" src="/images/spinner.gif" style="display:none;" /></span>
        </div>
      </div>
        </div>

        <div id="lwlb_contact_requirements" class="contact_requirements" style="display:none;">
      <img onclick="lwlb_hide_and_reset('lwlb_contact');" class="closeimg" src="/images/colorbox/fancy_colorbox_close.png" />
      <div class="content-row">
        <h2>We need to know a bit more...</h2>
      </div>
      <div class="content-row">
        <div class="full-field-block">
          <span class="addendum">This will update your profile</span>
          <h3>Short description about yourself</h3>
          <span class="suggestion">Where you're from, what you like to do, what your job is &mdash; anything that gives a sense of who you are and what you're like.</span>
          <textarea id="user_profile_info_about" name="user_profile_info[about]"></textarea>
        </div>
      </div>
      <div class="content-row">
        <div class="full-field-block submit-or-cancel">
          <input class="button-glossy blue" id="lwlb_message_button_req" name="commit" onclick="lwlb_submit_verification(); return false;" type="submit" value="Send Message" />
          <span><img id="lwlb_message_spinner_req" src="/images/spinner.gif" style="display:none;" /></span>
        </div>
      </div>
        </div>

        <div id="lwlb_contact_signup" style="display:none;"><!-- SIGNUP SCREEN -->
      <img onclick="lwlb_hide_and_reset('lwlb_contact');" class="closeimg" src="/images/colorbox/fancy_colorbox_close.png" />
      <div class="content-row"> 
        <h2>Sign up to send your message</h2>
      </div>
      <div class="content-row">
        <div class="full-field-block centered">
          <span class="login_prompt">Sign up using Facebook</span>
          <div>
            <fb:login-button id="fb_login" size="large" onlogin="jQuery('#fb_login').hide();jQuery('#login_spinner').show();lwlb_login_button_click();" perms="email,user_birthday,user_likes,user_education_history,user_hometown,user_interests,user_activities,user_location"></fb:login-button>
            <span id="login_spinner" style="position:absolute;padding-top:2px;padding-left:5px;display:none"><img src="/images/spinner.gif"/></span>
          </div>
        </div>
      </div>
      <div class="content-row">
        <div class="full-field-block centered">
          <span class="login_prompt">or standard sign up</span>
          <table>
            <tr><th>First Name</th><td><input id="first_name" name="first_name" type="text" /></td></tr>
            <tr><th>Last Name</th><td><input id="last_name" name="last_name" type="text" /></td></tr>
            <tr><th>Email</th><td><input id="email" name="email" type="text" /></td></tr>
            <tr><th>Password</th><td><input id="password" name="password" type="password" /></td></tr>
          </table>
          <div class="submit-or-cancel">
            <input class="button-glossy blue" id="lwlb_signup_button" name="commit" onclick="lwlb_signup_button_click(); return false;" type="submit" value="Create Account &amp; Send Message" />
            <span><img id="lwlb_signup_spinner" height="16" width="16" src="/images/spinner.gif" style="display:none;" alt="" /></span>
          </div>
          <div>
          </div>
        </div>
      </div>
      <div class="content-row">
        <div class="full-field-block">
          Already an Airbnb member? <a href="#" onclick="jQuery('#lwlb_contact_signup').hide();jQuery('#lwlb_contact_login').show();return false;">Sign in</a>
        </div>
      </div>
        </div>

        <div id="lwlb_fb_signup" style="text-align: center; display: none;"><!-- FB SIGNUP -->
            <div class="header clearfix" style="border-bottom: 1px solid #EAEAEA; padding-bottom: 13px; margin-bottom: 13px;">
                <div class="h1">
                    <h1>Sign up to send your message</h1>
                    <a href="#" onclick="jQuery('#lwlb_fb_signup').hide();jQuery('#lwlb_contact_login').show();return false;">Already have an account?</a>
                </div>
                <img onclick="lwlb_hide_and_reset('lwlb_contact');" class="closeimg" src="/images/colorbox/fancy_colorbox_close.png" />
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
      <img onclick="lwlb_hide_and_reset('lwlb_contact');" class="closeimg" src="/images/colorbox/fancy_colorbox_close.png" />
      <div class="content-row"> 
        <h2>Log in to send your message</h2>
      </div>
      <div class="content-row">
        <div class="full-field-block centered">
          <span class="login_prompt">Sign in using Facebook</span>
          <div>
            <fb:login-button id="fb_login2" size="large" onlogin="jQuery('#fb_login2').hide();jQuery('#login_spinner2').show();lwlb_login_button_click();" perms="email,user_birthday,user_likes,user_education_history,user_hometown,user_interests,user_activities,user_location"></fb:login-button>
            <span id="login_spinner2" style="position:absolute;padding-top:2px;padding-left:5px;display:none"><img src="/images/spinner.gif"/></span>
          </div>
        </div>
      </div>
      <div class="content-row">
        <div class="full-field-block centered">
          <span class="login_prompt">Or standard sign in:</span>
          <table>
            <tr><th>Email</th><td><input id="login_email" name="login_email" type="text" /></td></tr>
            <tr><th>Password</th><td><input id="login_password" name="login_password" type="password" /></td></tr>
          </table>
          <div class="submit-or-cancel">
            <input class="button-glossy blue" id="lwlb_login_button" name="commit" onclick="lwlb_login_button_click(); return false;" type="submit" value="Log in and Send Message" />
                        <span><img id="lwlb_login_spinner" src="/images/spinner.gif" style="display:none;" /></span>
          </div>
          <div>
          </div>
        </div>
      </div>
      <div class="content-row">
        <div class="full-field-block">
          <a href="https://www.airbnb.com/forgot_password" onclick="window.open(this.href);return false;" style="float: right;">Forgot password?</a>
          <span>No account? <a href="#" onclick="jQuery('#lwlb_contact_login').hide();if(window.FB && jQuery.cookie('fbs')){jQuery('#lwlb_fb_signup').show();}else{jQuery('#lwlb_contact_signup').show();}return false;">Create an account</a></span>
        </div>
      </div>
        </div>

</form>  </div>
</div>
