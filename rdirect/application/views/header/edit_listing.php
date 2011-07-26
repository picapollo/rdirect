<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml"> 
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/> 
        <title><?=$title?></title> 
 
        <meta name="title" content="<?=$title?>" /> 
 
 
    <link rel="image_src" href="<?=IMG_DIR?>/airbnb_logo.png" /> 
    <link rel="search" type="application/opensearchdescription+xml" href="/opensearch.xml" title="Airbnb" /> 
 
    <!--[if (!IE)|(gte IE 8)]><!--> 
<link href="<?=CSS_DIR?>/common-datauri.css" media="screen" rel="stylesheet" type="text/css" /> 
<!--<![endif]--> 
<!--[if lte IE 7]>
<link href="<?=CSS_DIR?>/common.css" media="screen" rel="stylesheet" type="text/css" />
<![endif]--> 
    <!--[if (!IE)|(gte IE 8)]><!--> 
<link href="<?=CSS_DIR?>/edit_listing-datauri.css" media="screen" rel="stylesheet" type="text/css" /> 
<!--<![endif]--> 
<!--[if lte IE 7]>
<link href="<?=CSS_DIR?>/edit_listing.css" media="screen" rel="stylesheet" type="text/css" />
<![endif]--> 
 
		<link href="<?=CSS_DIR?>/korean_fonts.css" media="screen" rel="stylesheet" type="text/css" /> 
 
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script> 
			<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script> 
 
		<script src="<?=JS_DIR?>/jquery.ui.datepicker/jquery.ui.datepicker-ko.min.js" type="text/javascript"></script> 
 
		<script type="text/javascript"> 
			jQuery.noConflict();
		</script> 
 
			<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/prototype/1.6.0.3/prototype.js"></script> 
			<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/scriptaculous/1.8.2/scriptaculous.js"></script> 
		<script src="<?=JS_DIR?>/calendar_date_select/calendar_date_select.js" type="text/javascript"></script> 
<script src="<?=JS_DIR?>/calendar_date_select/format_american.js" type="text/javascript"></script> 
<link href="<?=CSS_DIR?>/calendar_date_select/silver.css" media="screen" rel="stylesheet" type="text/css" /> 
 
 
		<script src="<?=JS_DIR?>/common.js" type="text/javascript"></script> 
		  <script src="<?=JS_DIR?>/edit_listing.js" type="text/javascript"></script> 
 
  <script type="text/x-jqote-template" id="notification-item-template"> 
  <![CDATA[
  <div class="<*= this.type *>">
    <span class="close"/>
    <span class="label"><*= this.label *></span>
  </div>
  ]]>
  </script> 
  <script src="http://s0.muscache.com/1311666388/assets/widgets.js" type="text/javascript"></script> 
 
<script type="text/x-jqote-template" id="availability_button_template"> 
<![CDATA[
  <span class="clearfix current-availability icon <*= this.status *>">
    <span class="label"><*= this.label *></span>
    <span class="expand"></span>
  </span>
  <div class="toggle-info" style="display: none;">
    <div class="instructions"><*= this.instructions *></div>
    <div class="toggle-action-container">
      <a href="<*= this.url *>" class="toggle-action icon <*= this.next_status *>"><*= this.toggle_label *></a>
    </div>
  </div>
]]>
</script> 
 
			<script type="text/javascript"> 
			    //only allow 35 characters
    jQuery(document).ready(function(){
      jQuery('.hosting_name').charCounter({
        warningcount: 5,
        inputchanged: function(charsLeft){ jQuery(this).siblings('.countvalue:first').html(charsLeft); },
        warningenter: function(){ jQuery(this).siblings('.countvalue:first').addClass('warning'); },
        warningexit: function(){ jQuery(this).siblings('.countvalue:first').removeClass('warning'); },
        limitreached: function(){ jQuery(this).siblings('.countvalue:first').addClass('error'); }
      });
 
      jQuery("#hosting_name").blur(function () {
          if(jQuery("#hosting_name").val().length > 6){
              jQuery("#title_message").html('멋진 제목이네요!').show().delay(2000).fadeOut(1000);
              jQuery("#title_message").removeClass('bad');
              jQuery("#title_message").addClass('good');
          }
          else if (jQuery("#hosting_name").val().length > 0){
              jQuery("#title_message").html('제목이 너무 짧네요!').show().delay(2000).fadeOut(1000);
              jQuery("#title_message").removeClass('good');
              jQuery("#title_message").addClass('bad');
          }
          else {
              jQuery("#title_message").html('제목을 입력해 주세요!').show().delay(2000).fadeOut(1000);
              jQuery("#title_message").removeClass('good');
              jQuery("#title_message").addClass('bad');
          }
      });
 
      jQuery('#address_street, #address_apt, #hosting_phone, #hosting_person_capacity, #hosting_room_type, #hosting_beds').formTipHelper();
    });
 
    function check_min_price() {
      if(parseInt(jQuery("#hosting_price_native").val()) < 10){
        jQuery("#hosting_price_native").val('9');
        jQuery('#price').html('Price must be $10 or more');
        //alert('The minimum nightly price is $10');
      }
 
      return true;
    }
 
    function wait_for_upload() {
        $('spinner').style.display = 'block';
        $('current_photo').style.opacity = '.4';
        $('current_photo').style.filter = 'alpha(opacity=40)';
    }
 
    function upload_complete() {
        $('current_photo').style.opacity = '1';
        $('spinner').style.display = 'none';
        $('current_photo').style.filter = 'alpha(opacity=100)';
        document.ajax_upload_form.reset();
    }
 
    function select_picture_thumbnail(picture_id) {
        jQuery('li.photo').removeClass('selected');
        jQuery('#photo_' + picture_id).addClass('selected');
    }
 
    function change_guests_included() {
        $$('.guests_included').each(function(e) {e.innerHTML = $('hosting_guests_included').value; });
    }
    
    function fetch_progress_bar_data(hosting_id) {
      jQuery.getJSON('/rooms/ajax_update_progress_bar', { 'hosting_id' : hosting_id }, function(data) {
        AirbnbDashboard.updateProgressBar(data.progress.score, data.next_steps, data.prompt, data.available);
      });
    }
 
    function accommodates_changed() {
        if($('hosting_person_capacity').value < $('hosting_guests_included').value){
            $('hosting_guests_included').value = $('hosting_person_capacity').value;
            $$('.guests_included').each(function(e) {e.innerHTML = $('hosting_person_capacity').value; });
        }
    }
 
 
 
    function ajax_submit_form() {
      
      var the_form = jQuery('#hosting_edit_form');
      jQuery.ajax({
        url: "/rooms/update/181683",
        type: "POST",
        data: jQuery(the_form).serialize(),
        dataType: "json",
        success: function(data){
          if(data['result'] == 'success'){
            var successString = '숙소 등록이 성공적으로 저장 되었습니다!';
            
            if(data['availability_on'] === true) {
              successString += ' 활성화 되었습니다. ';
            }
            else if(data['available'] === false && data['old_availability'] === true) {
              successString += '  However, it has been deactivated. Please supply a little more information to reactivate it!';
            }
            
            AirbnbDashboard.createNotificationItem(successString, 'info', the_form);
            
            // update progress bar
            if(data.progress) {
              AirbnbDashboard.updateProgressBar(data.progress.score, data.next_steps, data.prompt, data.available);
            }
 
            // also update the name of the property in the banner
            jQuery('#listing_title_banner').text(jQuery('#hosting_name').val());
          }
          else if(data['result'] == 'error'){
            AirbnbDashboard.createNotificationItem(data['message'], 'error', the_form);
          }
 
          var _spinner = jQuery('div.form-submit span.spinner', the_form);
          var _submitButton = jQuery(":submit", the_form);
 
          _spinner.hide();
          _submitButton.removeAttr('disabled');
          jQuery('html, body').animate({scrollTop: 0}, 'slow');
        }
      });
      
    }
 
	jQuery(document).ready(function() {
		jQuery('.button').hover(function() {jQuery(this).addClass('drop_shadow_soft')
	}, function(){
			jQuery(this).removeClass('drop_shadow_soft')
		});
		jQuery('#user_phone').validatedPhone();
		jQuery('#user_phone2').validatedPhone();
    
    jQuery('form#hosting_edit_form').submit(function(){
      var _formRef = this;
 
      // turn on spinner
      var _spinner = jQuery('div.form-submit span.spinner', this);
      _spinner.show();
 
      // disable submit button
      var _submitButton = jQuery(":submit", this);
      _submitButton.attr('disabled', 'disabled');
 
      ajax_submit_form();
 
      return false;
    });
	});
 
  jQuery(document).ready(function(){
    AirbnbDashboard.init(); 
 
        AirbnbDashboard.createNotificationItem("객실 사진을 올리지 않아 현재 비활성화 되었습니다. <a href='/rooms/181683/edit?section=photos'>지금 사진을 올리세요!</a>", "error-general");
    
  });
 
  var buttonContent = {
    active: {
      label: "활성",
      instructions: "객실을 검색 결과에서 없앨려면 숨기기 기능을 이용하세요.",
      toggle_label: "숨기기"
    },
    inactive: {
      label: "숨김",
      instructions: "객실 등록을 활성화 시켜서 검생 결과에 나오게 하세요:",
      toggle_label: "활성화시키기"
    }
  };
 
  jQuery(document).ready(function(){
    jQuery('div.set-availability').availabilityWidget(buttonContent);
  });
 
			</script> 
		<link rel="shortcut icon" href="/airbnb_favicon.ico" /> 