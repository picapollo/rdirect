
 
 
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml"> 
    <head><script>var NREUMQ=[];NREUMQ.push(["mark","firstbyte",new Date().getTime()]);(function(){var d=document;var e=d.createElement("script");e.type="text/javascript";e.async=true;e.src="https://d1ros97qkrwjf5.cloudfront.net/14/eum/rum.js	";var s=d.getElementsByTagName("script")[0];s.parentNode.insertBefore(e,s);})()</script> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/> 
        <title>Edit '12' on Airbnb.com</title> 
 
        <meta name="title" content="Edit '12' on Airbnb.com" /> 
 
 
    <link rel="image_src" href="/images/airbnb_logo.png" /> 
    <link rel="search" type="application/opensearchdescription+xml" href="/opensearch.xml" title="Airbnb" /> 
 
    <!--[if (!IE)|(gte IE 8)]><!--> 
<link href="http://s1.muscache.com/1311638523/assets/common-datauri.css" media="screen" rel="stylesheet" type="text/css" /> 
<!--<![endif]--> 
<!--[if lte IE 7]>
<link href="http://s3.muscache.com/1311638522/assets/common.css" media="screen" rel="stylesheet" type="text/css" />
<![endif]--> 
    <!--[if (!IE)|(gte IE 8)]><!--> 
<link href="http://s0.muscache.com/1311638520/assets/edit_listing-datauri.css" media="screen" rel="stylesheet" type="text/css" /> 
<!--<![endif]--> 
<!--[if lte IE 7]>
<link href="http://s3.muscache.com/1311638519/assets/edit_listing.css" media="screen" rel="stylesheet" type="text/css" />
<![endif]--> 
 
		<link href="http://s0.muscache.com/1300304856/stylesheets/korean_fonts.css" media="screen" rel="stylesheet" type="text/css" /> 
 
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script> 
			<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script> 
 
		<script src="http://s3.muscache.com/1310602728/javascripts/jquery.ui.datepicker/jquery.ui.datepicker-ko.min.js" type="text/javascript"></script> 
 
 
		<script src="http://s1.muscache.com/1311666386/assets/common.js" type="text/javascript"></script> 
		  <script src="http://s2.muscache.com/1311666385/assets/edit_listing.js" type="text/javascript"></script> 
 
  <script type="text/x-jqote-template" id="notification-item-template"> 
  <![CDATA[
  <div class="<*= this.type *>">
    <span class="close"/>
    <span class="label"><*= this.label *></span>
  </div>
  ]]>
  </script> 
  <script src="http://s3.muscache.com/1311666387/assets/widgets.js" type="text/javascript"></script> 
 
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
	</head> 
 
  <body> 
 
  
 
        <div id="header" class="clearfix"> 
			<a id="logo" href="http://www.airbnb.com" title="Airbnb.com Home"> 
				<img alt="Airbnb - Travel like a human." border="0" height="45" src="http://s1.muscache.com/1309460641/images/logos/109x45.png" width="109" /> 
			</a> 
					<a href="/rooms/new" class="rounded hide_when_printing" id="list-your-space">객실 등록하기</a> 
          <ul id="utilities"> 
							<li class="first-child"> 
								안녕하세요, ㅇᅟᅵᆫㅏ ᅟ!&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/home/dashboard">마이 대쉬보드</a> 
							</li> 
              <li style="border:none;"> 
              	<ul class="notification_bar"> 
<li id="star-indicator" style="display: none;"><a href="/search?starred=true" class="notification_icon starred" title="View your starred items">                                <span style="width: 1px; margin-right: -5px;">&nbsp;</span> 
																<span id="star_count" class="alert_count">0</span> 
</a></li>               	</ul> 
              </li> 
              <li><a href="/users/logout" onclick="var f = document.createElement('form'); f.style.display = 'none'; this.parentNode.appendChild(f); f.method = 'POST'; f.action = this.href;f.submit();return false;">로그아웃</a></li> 
            <li><a href="/jobs">채용정보</a></li> 
          	<li style="border-right:1px solid #DDD;"><a href="/info/how_it_works">에어비앤비 이용방법</a></li> 
						<li style="border-left:none;" class="last-child"> 
							<div id="language_currency"> 
								<div id="language_currency_display" class="rounded_top"> 
                   <div id="language_currency_display_language" class="flag sprite-ko">&nbsp;</div> 
                   <div id="language_currency_display_currency">$ USD</div> 
                </div> 
                <div id="language_currency_selector_container" class="rounded" style="display:none;"> 
          				<ul id="language_currency_selector"> 
										<li class='instruction'>언어 선택</li> 
												<li class="language option" id="language_selector_de" name="de"> 
													<div class="flag sprite-de">&nbsp;</div> 
													<div style="display:inline;padding-left:24px;">Deutsch</div> 
												</li> 
												<li class="language option" id="language_selector_en" name="en"> 
													<div class="flag sprite-en">&nbsp;</div> 
													<div style="display:inline;padding-left:24px;">English</div> 
												</li> 
												<li class="language option" id="language_selector_es" name="es"> 
													<div class="flag sprite-es">&nbsp;</div> 
													<div style="display:inline;padding-left:24px;">Español</div> 
												</li> 
												<li class="language option" id="language_selector_fr" name="fr"> 
													<div class="flag sprite-fr">&nbsp;</div> 
													<div style="display:inline;padding-left:24px;">Français</div> 
												</li> 
												<li class="language option" id="language_selector_it" name="it"> 
													<div class="flag sprite-it">&nbsp;</div> 
													<div style="display:inline;padding-left:24px;">Italiano</div> 
												</li> 
												<li class="language option" id="language_selector_pt" name="pt"> 
													<div class="flag sprite-pt">&nbsp;</div> 
													<div style="display:inline;padding-left:24px;">Português</div> 
												</li> 
												<li class="language option" id="language_selector_ru" name="ru"> 
													<div class="flag sprite-ru">&nbsp;</div> 
													<div style="display:inline;padding-left:24px;">Русский</div> 
												</li> 
												<li class="language option" id="language_selector_zh" name="zh"> 
													<div class="flag sprite-zh">&nbsp;</div> 
													<div style="display:inline;padding-left:24px;">中文(简体)</div> 
												</li> 
            				<li class='dash'>&nbsp;</li> 
              			<li class='instruction'>통화 선택</li> 
												<li class="currency option" id="currency_selector_AUD" name="AUD"> $ AUD </li> 
												<li class="currency option" id="currency_selector_BRL" name="BRL"> R$ BRL </li> 
												<li class="currency option" id="currency_selector_CAD" name="CAD"> $ CAD </li> 
												<li class="currency option" id="currency_selector_CHF" name="CHF"> CHF CHF </li> 
												<li class="currency option" id="currency_selector_CZK" name="CZK"> &#75;&#269; CZK </li> 
												<li class="currency option" id="currency_selector_DKK" name="DKK"> kr DKK </li> 
												<li class="currency option" id="currency_selector_EUR" name="EUR"> &euro; EUR </li> 
												<li class="currency option" id="currency_selector_GBP" name="GBP"> &pound; GBP </li> 
												<li class="currency option" id="currency_selector_HKD" name="HKD"> $ HKD </li> 
												<li class="currency option" id="currency_selector_HUF" name="HUF"> Ft HUF </li> 
												<li class="currency option" id="currency_selector_ILS" name="ILS"> &#8362; ILS </li> 
												<li class="currency option" id="currency_selector_JPY" name="JPY"> &yen; JPY </li> 
												<li class="currency option" id="currency_selector_NOK" name="NOK"> kr NOK </li> 
												<li class="currency option" id="currency_selector_RUB" name="RUB"> &#1088;&#1091;&#1073; RUB </li> 
												<li class="currency option" id="currency_selector_SEK" name="SEK"> kr SEK </li> 
												<li class="currency option" id="currency_selector_ZAR" name="ZAR"> R ZAR </li> 
              		</ul><!-- LANGUAGE_CURRENCY_SELECTOR --> 
            		</div><!-- LANGUAGE_CURRENCY_SELECTOR_CONTAINER --> 
              </div><!-- LANGUAGE_CURRENCY --> 
            </li> 
					</ul><!-- UTILITIES --> 
        </div> <!-- HEADER --> 
 
       
		<div id="dashboard_v2"> 
 
  <div class="row"> 
    <div class="col full heading"> 
      <div class="heading_content"> 
        
 
 
<div class="edit_listing_photo"><a href="/rooms/181683"><img alt="Room_default_no_photos" height="65" src="http://s1.muscache.com/1308680853/images/page3/v3/room_default_no_photos.png" /></a></div> 
 
<div class="listing_info"> 
  <h3><a href="/rooms/181683" id="listing_title_banner">12</a></h3> 
  <span class="actions"> 
    <div class="set-availability action_button" data-has-availability="false" data-available-url="/rooms/change_availability/181683?is_available=1&redirect=%2Frooms%2F181683%2Fedit%3Fsection%3Ddetails&sig=LS0tIAotICFiaW5hcnkgfAogICtyelJVc2dUWDY3VzRlNi9hQy9ZSzZVS0lZaz0KCi0gfAogIC0tLSAKICAtICIxODE2ODMiCiAgLSAiMSIKICAtIC9yb29tcy8xODE2ODMvZWRpdD9zZWN0aW9uPWRldGFpbHMKCi0gVHVlIEp1bCAyNiAxMzoxNDo1NyArMDAwMCAyMDExCg%3D%3D" data-unavailable-url="/rooms/change_availability/181683?is_available=0&redirect=%2Frooms%2F181683%2Fedit%3Fsection%3Ddetails&sig=LS0tIAotICFiaW5hcnkgfAogIEdPWm5WRnN4bTA2VkQ1V1Q4SlNKMHdqWjUvYz0KCi0gfAogIC0tLSAKICAtICIxODE2ODMiCiAgLSAiMCIKICAtIC9yb29tcy8xODE2ODMvZWRpdD9zZWN0aW9uPWRldGFpbHMKCi0gVHVlIEp1bCAyNiAxMzoxNDo1NyArMDAwMCAyMDExCg%3D%3D"> 
</div> 
 
    <span class="action_button"> 
      <a href="/rooms/181683" class="icon view" target="_NEW">등록된 객실 보기</a> 
    </span> 
    <div id="availability-error-message"></div> 
  </span> 
</div> 
 
<div class="clear"></div> 
 
      </div> 
    </div> 
  </div> 
  <div class="row"> 
    <div class="col one-fourth nav"> 
      <a href="/rooms" class="to-parent">등록된 모든 객실 보기</a> 
      <div class="nav-container"> 
        <ul class="edit_room_nav"><li class="selected"><a class="details" href="/rooms/181683/edit?section=details"><span class="icon"></span>설명:</a><li ><a class="photos" href="/rooms/181683/edit?section=photos"><span class="icon"></span>사진</a><li ><a class="calendar" href="/calendar/single/181683"><span class="icon"></span>달력</a><li ><a class="pricing" href="/hosting/pricing?hosting_id=181683"><span class="icon"></span>가격 및 조건</a></ul><ul class="edit_room_nav"><li ><a class="promote" href="/hosting/promote/181683"><span class="icon"></span>홍보하기</a></ul> 
      </div> 
    </div> 
    <div class="col three-fourths content"> 
      
      <div id="notification-area"></div> 
      <div id="dashboard-content"> 
        
 
 
 
<form action="/rooms/update/181683" enctype="multipart/form-data" id="hosting_edit_form" method="post" name="hosting_edit_form">    
    
    <div class="box" id="listing_type_container"> 
    <div class="top"> 
        <h2 class="step"><span class="edit_room_icon"></span>Listing Type</h2> 
    </div> 
    <div class="middle"> 
        <ul id="details"> 
            <li> 
                <label for="hosting_property_type_id">객실 종류</label> 
                <select class="fixed-width" id="hosting_property_type_id" name="hosting[property_type_id]"><option value="1" selected="selected">아파트</option> 
<option value="2">단독주택</option> 
<option value="3">민박(조식포함)</option> 
<option value="4">통나무집</option> 
<option value="11">별장/타운하우스</option> 
<option value="5">성</option> 
<option value="9">다인실</option> 
<option value="6">트리하우스</option> 
<option value="8">선상객실</option> 
<option value="7">캠핑카</option> 
<option value="12">이글루</option> 
<option value="10">등대</option></select> 
                <div id="form_helper_property_type_id" class="form_helper" style="display:none;"><p>객실 종류가 뭔가요?</p></div> 
                <div class="clear"></div> 
            </li> 
 
            <li> 
                <label for="hosting_room_type">객실 타입</label> 
                <select class="fixed-width" id="hosting_room_type" name="hosting[room_type]"><option value="Private room" selected="selected">프라이빗룸</option> 
<option value="Shared room">쉐어드룸</option> 
<option value="Entire home/apt">집/아파트 전체</option></select> 
                <div id="form_helper_room_type" class="form_helper" style="display:none;"><p>방 종류가 뭔가요?</p></div> 
                <div class="clear"></div> 
            </li> 
 
        </ul> 
 
        <div class="clear"></div> 
    </div><!-- middle --> 
    <div class="bottom">&nbsp;</div> 
</div><!-- box --> 
 
 
      <div id="multilingual_description_container"> 
 
  <div id="description_language_de" class="box" style="display: none;"> 
      <div class="top"> 
          <h2 class="step"> 
            <p class="close_section"><a href="" onclick="hideSection('de'); return false;"><img alt="Close_icon_blue" src="http://s1.muscache.com/1300304855/images/icons/close_icon_blue.png" /></a></p> 
            <span class="edit_room_icon details"></span>설명 <span class="language_hint">(Deutsch)</span> 
          </h2> 
      </div> 
      
      
      <div class="middle"> 
          <ul id="description"> 
 
              <li class="description_language_section_container"> 
                <ul class="description_language_section"> 
          
 
                  <li class="section_de"> 
                      <label for="hosting_name"> 
                      제목<br /> 
                      </label> 
                      <input class="large charcount hosting_name" id="hosting_descriptions_de_name" maxlength="35" name="hosting_descriptions[de][name]" type="text" /> 
                      <span id="hosting_name_char_count" class="countvalue">35</span> 
                      <span id="title_message"></span> 
                      <div class="clear"></div> 
                      
                      <input id="hosting_descriptions_de_delete" name="hosting_descriptions[de][delete]" type="hidden" value="false" /> 
                  </li> 
                  <li class="section_de"> 
                      <label for="hosting_description" style="vertical-align:top;">설명 <a class="tooltip" title="알림: 객실 설명에 있는 연락처 정보는 자동으로 필터되어 삭제됩니다. "><img alt="Questionmark_hover" src="http://s0.muscache.com/1300304855/images/icons/questionmark_hover.png" style="width:16px; height:16px;" /></a> 
                          <span class="helper"> 
                              <br /> 
                              <br /> 
                              <span style="font-size:13px; font-weight:bold;">설명 잘 하는 팁</span> 
                              <br /> 
                              객실이 특별한 점이 있나요?
                              <br /> 
                              이웃은 어떤가요?
                              <br /> 
                              방 상태가 어떤가요?
                              <br /> 
                          </span> 
                      </label> 
                      <textarea id="hosting_descriptions_de_description" name="hosting_descriptions[de][description]"></textarea> 
                      <div class="clear"></div> 
                  </li> 
              </ul> 
            </li> 
            
          </ul> 
        
          <div class="clear"></div> 
      </div><!-- middle --> 
      <div class="bottom">&nbsp;</div> 
  </div><!-- box --> 
 
  <div id="description_language_en" class="box" style="display: none;"> 
      <div class="top"> 
          <h2 class="step"> 
            <p class="close_section"><a href="" onclick="hideSection('en'); return false;"><img alt="Close_icon_blue" src="http://s1.muscache.com/1300304855/images/icons/close_icon_blue.png" /></a></p> 
            <span class="edit_room_icon details"></span>설명 <span class="language_hint">(English)</span> 
          </h2> 
      </div> 
      
      <div class="info host_tip"> 
        <span class="close" onclick="noEnglish(); return false;">전 영어를 못해요!</span> 
        
        <span class="label">회원의 95%가 영어를 사용하므로 영어로 객실 설명을 쓸 것을 권장합니다.</span> 
      </div> 
      
      <div class="middle"> 
          <ul id="description"> 
 
              <li class="description_language_section_container"> 
                <ul class="description_language_section"> 
          
 
                  <li class="section_en"> 
                      <label for="hosting_name"> 
                      제목<br /> 
                      </label> 
                      <input class="large charcount hosting_name" id="hosting_descriptions_en_name" maxlength="35" name="hosting_descriptions[en][name]" type="text" /> 
                      <span id="hosting_name_char_count" class="countvalue">35</span> 
                      <span id="title_message"></span> 
                      <div class="clear"></div> 
                      
                      <input id="hosting_descriptions_en_delete" name="hosting_descriptions[en][delete]" type="hidden" value="false" /> 
                  </li> 
                  <li class="section_en"> 
                      <label for="hosting_description" style="vertical-align:top;">설명 <a class="tooltip" title="알림: 객실 설명에 있는 연락처 정보는 자동으로 필터되어 삭제됩니다. "><img alt="Questionmark_hover" src="http://s0.muscache.com/1300304855/images/icons/questionmark_hover.png" style="width:16px; height:16px;" /></a> 
                          <span class="helper"> 
                              <br /> 
                              <br /> 
                              <span style="font-size:13px; font-weight:bold;">설명 잘 하는 팁</span> 
                              <br /> 
                              객실이 특별한 점이 있나요?
                              <br /> 
                              이웃은 어떤가요?
                              <br /> 
                              방 상태가 어떤가요?
                              <br /> 
                          </span> 
                      </label> 
                      <textarea id="hosting_descriptions_en_description" name="hosting_descriptions[en][description]"></textarea> 
                      <div class="clear"></div> 
                  </li> 
              </ul> 
            </li> 
            
          </ul> 
        
          <div class="clear"></div> 
      </div><!-- middle --> 
      <div class="bottom">&nbsp;</div> 
  </div><!-- box --> 
 
  <div id="description_language_es" class="box" style="display: none;"> 
      <div class="top"> 
          <h2 class="step"> 
            <p class="close_section"><a href="" onclick="hideSection('es'); return false;"><img alt="Close_icon_blue" src="http://s1.muscache.com/1300304855/images/icons/close_icon_blue.png" /></a></p> 
            <span class="edit_room_icon details"></span>설명 <span class="language_hint">(Español)</span> 
          </h2> 
      </div> 
      
      
      <div class="middle"> 
          <ul id="description"> 
 
              <li class="description_language_section_container"> 
                <ul class="description_language_section"> 
          
 
                  <li class="section_es"> 
                      <label for="hosting_name"> 
                      제목<br /> 
                      </label> 
                      <input class="large charcount hosting_name" id="hosting_descriptions_es_name" maxlength="35" name="hosting_descriptions[es][name]" type="text" /> 
                      <span id="hosting_name_char_count" class="countvalue">35</span> 
                      <span id="title_message"></span> 
                      <div class="clear"></div> 
                      
                      <input id="hosting_descriptions_es_delete" name="hosting_descriptions[es][delete]" type="hidden" value="false" /> 
                  </li> 
                  <li class="section_es"> 
                      <label for="hosting_description" style="vertical-align:top;">설명 <a class="tooltip" title="알림: 객실 설명에 있는 연락처 정보는 자동으로 필터되어 삭제됩니다. "><img alt="Questionmark_hover" src="http://s0.muscache.com/1300304855/images/icons/questionmark_hover.png" style="width:16px; height:16px;" /></a> 
                          <span class="helper"> 
                              <br /> 
                              <br /> 
                              <span style="font-size:13px; font-weight:bold;">설명 잘 하는 팁</span> 
                              <br /> 
                              객실이 특별한 점이 있나요?
                              <br /> 
                              이웃은 어떤가요?
                              <br /> 
                              방 상태가 어떤가요?
                              <br /> 
                          </span> 
                      </label> 
                      <textarea id="hosting_descriptions_es_description" name="hosting_descriptions[es][description]"></textarea> 
                      <div class="clear"></div> 
                  </li> 
              </ul> 
            </li> 
            
          </ul> 
        
          <div class="clear"></div> 
      </div><!-- middle --> 
      <div class="bottom">&nbsp;</div> 
  </div><!-- box --> 
 
  <div id="description_language_fr" class="box" style="display: none;"> 
      <div class="top"> 
          <h2 class="step"> 
            <p class="close_section"><a href="" onclick="hideSection('fr'); return false;"><img alt="Close_icon_blue" src="http://s1.muscache.com/1300304855/images/icons/close_icon_blue.png" /></a></p> 
            <span class="edit_room_icon details"></span>설명 <span class="language_hint">(Français)</span> 
          </h2> 
      </div> 
      
      
      <div class="middle"> 
          <ul id="description"> 
 
              <li class="description_language_section_container"> 
                <ul class="description_language_section"> 
          
 
                  <li class="section_fr"> 
                      <label for="hosting_name"> 
                      제목<br /> 
                      </label> 
                      <input class="large charcount hosting_name" id="hosting_descriptions_fr_name" maxlength="35" name="hosting_descriptions[fr][name]" type="text" /> 
                      <span id="hosting_name_char_count" class="countvalue">35</span> 
                      <span id="title_message"></span> 
                      <div class="clear"></div> 
                      
                      <input id="hosting_descriptions_fr_delete" name="hosting_descriptions[fr][delete]" type="hidden" value="false" /> 
                  </li> 
                  <li class="section_fr"> 
                      <label for="hosting_description" style="vertical-align:top;">설명 <a class="tooltip" title="알림: 객실 설명에 있는 연락처 정보는 자동으로 필터되어 삭제됩니다. "><img alt="Questionmark_hover" src="http://s0.muscache.com/1300304855/images/icons/questionmark_hover.png" style="width:16px; height:16px;" /></a> 
                          <span class="helper"> 
                              <br /> 
                              <br /> 
                              <span style="font-size:13px; font-weight:bold;">설명 잘 하는 팁</span> 
                              <br /> 
                              객실이 특별한 점이 있나요?
                              <br /> 
                              이웃은 어떤가요?
                              <br /> 
                              방 상태가 어떤가요?
                              <br /> 
                          </span> 
                      </label> 
                      <textarea id="hosting_descriptions_fr_description" name="hosting_descriptions[fr][description]"></textarea> 
                      <div class="clear"></div> 
                  </li> 
              </ul> 
            </li> 
            
          </ul> 
        
          <div class="clear"></div> 
      </div><!-- middle --> 
      <div class="bottom">&nbsp;</div> 
  </div><!-- box --> 
 
  <div id="description_language_it" class="box" style="display: none;"> 
      <div class="top"> 
          <h2 class="step"> 
            <p class="close_section"><a href="" onclick="hideSection('it'); return false;"><img alt="Close_icon_blue" src="http://s1.muscache.com/1300304855/images/icons/close_icon_blue.png" /></a></p> 
            <span class="edit_room_icon details"></span>설명 <span class="language_hint">(Italiano)</span> 
          </h2> 
      </div> 
      
      
      <div class="middle"> 
          <ul id="description"> 
 
              <li class="description_language_section_container"> 
                <ul class="description_language_section"> 
          
 
                  <li class="section_it"> 
                      <label for="hosting_name"> 
                      제목<br /> 
                      </label> 
                      <input class="large charcount hosting_name" id="hosting_descriptions_it_name" maxlength="35" name="hosting_descriptions[it][name]" type="text" /> 
                      <span id="hosting_name_char_count" class="countvalue">35</span> 
                      <span id="title_message"></span> 
                      <div class="clear"></div> 
                      
                      <input id="hosting_descriptions_it_delete" name="hosting_descriptions[it][delete]" type="hidden" value="false" /> 
                  </li> 
                  <li class="section_it"> 
                      <label for="hosting_description" style="vertical-align:top;">설명 <a class="tooltip" title="알림: 객실 설명에 있는 연락처 정보는 자동으로 필터되어 삭제됩니다. "><img alt="Questionmark_hover" src="http://s0.muscache.com/1300304855/images/icons/questionmark_hover.png" style="width:16px; height:16px;" /></a> 
                          <span class="helper"> 
                              <br /> 
                              <br /> 
                              <span style="font-size:13px; font-weight:bold;">설명 잘 하는 팁</span> 
                              <br /> 
                              객실이 특별한 점이 있나요?
                              <br /> 
                              이웃은 어떤가요?
                              <br /> 
                              방 상태가 어떤가요?
                              <br /> 
                          </span> 
                      </label> 
                      <textarea id="hosting_descriptions_it_description" name="hosting_descriptions[it][description]"></textarea> 
                      <div class="clear"></div> 
                  </li> 
              </ul> 
            </li> 
            
          </ul> 
        
          <div class="clear"></div> 
      </div><!-- middle --> 
      <div class="bottom">&nbsp;</div> 
  </div><!-- box --> 
 
  <div id="description_language_pt" class="box" style="display: none;"> 
      <div class="top"> 
          <h2 class="step"> 
            <p class="close_section"><a href="" onclick="hideSection('pt'); return false;"><img alt="Close_icon_blue" src="http://s1.muscache.com/1300304855/images/icons/close_icon_blue.png" /></a></p> 
            <span class="edit_room_icon details"></span>설명 <span class="language_hint">(Português)</span> 
          </h2> 
      </div> 
      
      
      <div class="middle"> 
          <ul id="description"> 
 
              <li class="description_language_section_container"> 
                <ul class="description_language_section"> 
          
 
                  <li class="section_pt"> 
                      <label for="hosting_name"> 
                      제목<br /> 
                      </label> 
                      <input class="large charcount hosting_name" id="hosting_descriptions_pt_name" maxlength="35" name="hosting_descriptions[pt][name]" type="text" /> 
                      <span id="hosting_name_char_count" class="countvalue">35</span> 
                      <span id="title_message"></span> 
                      <div class="clear"></div> 
                      
                      <input id="hosting_descriptions_pt_delete" name="hosting_descriptions[pt][delete]" type="hidden" value="false" /> 
                  </li> 
                  <li class="section_pt"> 
                      <label for="hosting_description" style="vertical-align:top;">설명 <a class="tooltip" title="알림: 객실 설명에 있는 연락처 정보는 자동으로 필터되어 삭제됩니다. "><img alt="Questionmark_hover" src="http://s0.muscache.com/1300304855/images/icons/questionmark_hover.png" style="width:16px; height:16px;" /></a> 
                          <span class="helper"> 
                              <br /> 
                              <br /> 
                              <span style="font-size:13px; font-weight:bold;">설명 잘 하는 팁</span> 
                              <br /> 
                              객실이 특별한 점이 있나요?
                              <br /> 
                              이웃은 어떤가요?
                              <br /> 
                              방 상태가 어떤가요?
                              <br /> 
                          </span> 
                      </label> 
                      <textarea id="hosting_descriptions_pt_description" name="hosting_descriptions[pt][description]"></textarea> 
                      <div class="clear"></div> 
                  </li> 
              </ul> 
            </li> 
            
          </ul> 
        
          <div class="clear"></div> 
      </div><!-- middle --> 
      <div class="bottom">&nbsp;</div> 
  </div><!-- box --> 
 
  <div id="description_language_ru" class="box" style="display: none;"> 
      <div class="top"> 
          <h2 class="step"> 
            <p class="close_section"><a href="" onclick="hideSection('ru'); return false;"><img alt="Close_icon_blue" src="http://s1.muscache.com/1300304855/images/icons/close_icon_blue.png" /></a></p> 
            <span class="edit_room_icon details"></span>설명 <span class="language_hint">(Русский)</span> 
          </h2> 
      </div> 
      
      
      <div class="middle"> 
          <ul id="description"> 
 
              <li class="description_language_section_container"> 
                <ul class="description_language_section"> 
          
 
                  <li class="section_ru"> 
                      <label for="hosting_name"> 
                      제목<br /> 
                      </label> 
                      <input class="large charcount hosting_name" id="hosting_descriptions_ru_name" maxlength="35" name="hosting_descriptions[ru][name]" type="text" /> 
                      <span id="hosting_name_char_count" class="countvalue">35</span> 
                      <span id="title_message"></span> 
                      <div class="clear"></div> 
                      
                      <input id="hosting_descriptions_ru_delete" name="hosting_descriptions[ru][delete]" type="hidden" value="false" /> 
                  </li> 
                  <li class="section_ru"> 
                      <label for="hosting_description" style="vertical-align:top;">설명 <a class="tooltip" title="알림: 객실 설명에 있는 연락처 정보는 자동으로 필터되어 삭제됩니다. "><img alt="Questionmark_hover" src="http://s0.muscache.com/1300304855/images/icons/questionmark_hover.png" style="width:16px; height:16px;" /></a> 
                          <span class="helper"> 
                              <br /> 
                              <br /> 
                              <span style="font-size:13px; font-weight:bold;">설명 잘 하는 팁</span> 
                              <br /> 
                              객실이 특별한 점이 있나요?
                              <br /> 
                              이웃은 어떤가요?
                              <br /> 
                              방 상태가 어떤가요?
                              <br /> 
                          </span> 
                      </label> 
                      <textarea id="hosting_descriptions_ru_description" name="hosting_descriptions[ru][description]"></textarea> 
                      <div class="clear"></div> 
                  </li> 
              </ul> 
            </li> 
            
          </ul> 
        
          <div class="clear"></div> 
      </div><!-- middle --> 
      <div class="bottom">&nbsp;</div> 
  </div><!-- box --> 
 
  <div id="description_language_zh" class="box" style="display: none;"> 
      <div class="top"> 
          <h2 class="step"> 
            <p class="close_section"><a href="" onclick="hideSection('zh'); return false;"><img alt="Close_icon_blue" src="http://s1.muscache.com/1300304855/images/icons/close_icon_blue.png" /></a></p> 
            <span class="edit_room_icon details"></span>설명 <span class="language_hint">(中文(简体))</span> 
          </h2> 
      </div> 
      
      
      <div class="middle"> 
          <ul id="description"> 
 
              <li class="description_language_section_container"> 
                <ul class="description_language_section"> 
          
 
                  <li class="section_zh"> 
                      <label for="hosting_name"> 
                      제목<br /> 
                      </label> 
                      <input class="large charcount hosting_name" id="hosting_descriptions_zh_name" maxlength="35" name="hosting_descriptions[zh][name]" type="text" /> 
                      <span id="hosting_name_char_count" class="countvalue">35</span> 
                      <span id="title_message"></span> 
                      <div class="clear"></div> 
                      
                      <input id="hosting_descriptions_zh_delete" name="hosting_descriptions[zh][delete]" type="hidden" value="false" /> 
                  </li> 
                  <li class="section_zh"> 
                      <label for="hosting_description" style="vertical-align:top;">설명 <a class="tooltip" title="알림: 객실 설명에 있는 연락처 정보는 자동으로 필터되어 삭제됩니다. "><img alt="Questionmark_hover" src="http://s0.muscache.com/1300304855/images/icons/questionmark_hover.png" style="width:16px; height:16px;" /></a> 
                          <span class="helper"> 
                              <br /> 
                              <br /> 
                              <span style="font-size:13px; font-weight:bold;">설명 잘 하는 팁</span> 
                              <br /> 
                              객실이 특별한 점이 있나요?
                              <br /> 
                              이웃은 어떤가요?
                              <br /> 
                              방 상태가 어떤가요?
                              <br /> 
                          </span> 
                      </label> 
                      <textarea id="hosting_descriptions_zh_description" name="hosting_descriptions[zh][description]"></textarea> 
                      <div class="clear"></div> 
                  </li> 
              </ul> 
            </li> 
            
          </ul> 
        
          <div class="clear"></div> 
      </div><!-- middle --> 
      <div class="bottom">&nbsp;</div> 
  </div><!-- box --> 
 
  <div id="description_language_ko" class="box" style=""> 
      <div class="top"> 
          <h2 class="step"> 
            <p class="close_section"><a href="" onclick="hideSection('ko'); return false;"><img alt="Close_icon_blue" src="http://s1.muscache.com/1300304855/images/icons/close_icon_blue.png" /></a></p> 
            <span class="edit_room_icon details"></span>설명 <span class="language_hint">(한국어)</span> 
          </h2> 
      </div> 
      
      
      <div class="middle"> 
          <ul id="description"> 
 
              <li class="description_language_section_container"> 
                <ul class="description_language_section"> 
          
 
                  <li class="section_ko"> 
                      <label for="hosting_name"> 
                      제목<br /> 
                      </label> 
                      <input class="large charcount hosting_name" id="hosting_descriptions_ko_name" maxlength="35" name="hosting_descriptions[ko][name]" type="text" value="12" /> 
                      <span id="hosting_name_char_count" class="countvalue">35</span> 
                      <span id="title_message"></span> 
                      <div class="clear"></div> 
                      
                      <input id="hosting_descriptions_ko_delete" name="hosting_descriptions[ko][delete]" type="hidden" value="false" /> 
                  </li> 
                  <li class="section_ko"> 
                      <label for="hosting_description" style="vertical-align:top;">설명 <a class="tooltip" title="알림: 객실 설명에 있는 연락처 정보는 자동으로 필터되어 삭제됩니다. "><img alt="Questionmark_hover" src="http://s0.muscache.com/1300304855/images/icons/questionmark_hover.png" style="width:16px; height:16px;" /></a> 
                          <span class="helper"> 
                              <br /> 
                              <br /> 
                              <span style="font-size:13px; font-weight:bold;">설명 잘 하는 팁</span> 
                              <br /> 
                              객실이 특별한 점이 있나요?
                              <br /> 
                              이웃은 어떤가요?
                              <br /> 
                              방 상태가 어떤가요?
                              <br /> 
                          </span> 
                      </label> 
                      <textarea id="hosting_descriptions_ko_description" name="hosting_descriptions[ko][description]">345</textarea> 
                      <div class="clear"></div> 
                  </li> 
              </ul> 
            </li> 
            
          </ul> 
        
          <div class="clear"></div> 
      </div><!-- middle --> 
      <div class="bottom">&nbsp;</div> 
  </div><!-- box --> 
</div> 
 
<div id="add_language_section"> 
  새로 설명 추가하기:
  <select id="add_description_language" name="add_description_language"><option value="xx">언어 선택</option> 
<option value="de">Deutsch</option> 
<option value="en">English</option> 
<option value="es">Español</option> 
<option value="fr">Français</option> 
<option value="it">Italiano</option> 
<option value="pt">Português</option> 
<option value="ru">Русский</option> 
<option value="zh">中文(简体)</option> 
<option value="ko">한국어</option></select> 
</div> 
 
 
 
 
<script> 
  var visibleSectionsCount = 1;
  
  jQuery(document).ready(function() {
    
    jQuery('#add_description_language').bind('change', function(e) {
      var section = jQuery('#description_language_' + e.target.value);
 
      // If section is already visible, return
      if(section.css('display') != 'none') {
        e.target.value = 'xx';
        return;
      }
      
      showSection(e.target.value);
      
      e.target.value = 'xx';
    });
    
    if(visibleSectionsCount < 2) {
      jQuery('.close_section').hide();
    }
    
    showOrHideEnglishHint();
    
    jQuery('#add_description_language option[value="ko"]').attr('disabled', 'disabled');
    
    showSection('en');
  });
  
  function showOrHideEnglishHint() {
    var section = jQuery('#description_language_en');
    
    if(visibleSectionsCount === 1 && section.css('display') != 'none') {
      jQuery('#description_language_en .language_hint').hide();
    }
    else {
      jQuery('#description_language_en .language_hint').show();
    }
  }
  
  function showSection(section_name) {
    var section = jQuery('#description_language_' + section_name);
 
    if(section_name != 'xx') {
      jQuery('#hosting_descriptions_' + section_name + '_delete').val(false);
      
      // Add it to the bottom of the form
      section.detach();
      section.appendTo('#multilingual_description_container');
      
      section.show();
      visibleSectionsCount++;
      jQuery('.close_section').show();
      
      jQuery('#add_description_language option[value="' + section_name + '"]').attr('disabled', 'disabled');
    }
    
    showOrHideEnglishHint();
  }
  
  function hideSection(section_name) {
    var section = jQuery('#description_language_' + section_name);
    section.hide();
    jQuery('#hosting_descriptions_' + section_name + '_delete').val(true);
    section.find('input[type="text"]').val('');
    section.find('textarea').val('');
    visibleSectionsCount--;
    
    if(visibleSectionsCount < 2) {
      jQuery('.close_section').hide();
    }
    
    jQuery('#add_description_language option[value="' + section_name + '"]').removeAttr('disabled');
    
    showOrHideEnglishHint();
    
  }
  
  function noEnglish() {
    hideSection('en');
    
    jQuery.post('/users/ajax_doesnt_speak_english');
  }
  
  
</script> 
 
    <div class="box" id="amenities"> 
    <div class="top"> 
        <h2 class="step"><span class="edit_room_icon amenities"></span>편의시설</h2> 
    </div> 
    <div class="middle"> 
        <input id="include_amenities" name="include_amenities" type="hidden" /> 
            <ul class="amenity_column"> 
                    <li> 
                        <input value="11" id="amenity_11" name="amenities[]" type="checkbox" /> 
                        <label for="amenity_11">흡연가능
                        </label> 
                    </li> 
                    <li> 
                        <input value="12" id="amenity_12" name="amenities[]" type="checkbox" /> 
                        <label for="amenity_12">애완동물 동반가능
                        </label> 
                    </li> 
                    <li> 
                        <input value="1" id="amenity_1" name="amenities[]" type="checkbox" /> 
                        <label for="amenity_1">TV
                        </label> 
                    </li> 
                    <li> 
                        <input value="2" id="amenity_2" name="amenities[]" type="checkbox" /> 
                        <label for="amenity_2">케이블 TV
                        </label> 
                    </li> 
                    <li> 
                        <input value="3" id="amenity_3" name="amenities[]" type="checkbox" /> 
                        <label for="amenity_3">인터넷
                                <a class="tooltip" title="인터넷(유/무선)"><img alt="Questionmark_hover" src="http://s0.muscache.com/1300304855/images/icons/questionmark_hover.png" style="width:16px; height:16px;" /></a> 
                        </label> 
                    </li> 
                    <li> 
                        <input value="4" id="amenity_4" name="amenities[]" type="checkbox" /> 
                        <label for="amenity_4">무선 인터넷
                                <a class="tooltip" title="24시간 접속가능한 무선인터넷 공유기"><img alt="Questionmark_hover" src="http://s0.muscache.com/1300304855/images/icons/questionmark_hover.png" style="width:16px; height:16px;" /></a> 
                        </label> 
                    </li> 
                    <li> 
                        <input value="5" id="amenity_5" name="amenities[]" type="checkbox" /> 
                        <label for="amenity_5">에어컨
                        </label> 
                    </li> 
                    <li> 
                        <input value="30" id="amenity_30" name="amenities[]" type="checkbox" /> 
                        <label for="amenity_30">난방
                        </label> 
                    </li> 
            </ul> 
            <ul class="amenity_column"> 
                    <li> 
                        <input value="21" id="amenity_21" name="amenities[]" type="checkbox" /> 
                        <label for="amenity_21">엘리베이터
                        </label> 
                    </li> 
                    <li> 
                        <input value="6" id="amenity_6" name="amenities[]" type="checkbox" /> 
                        <label for="amenity_6">장애인 이용 용이
                                <a class="tooltip" title="휠체어 접근이 용이한 객실입니다. 기타 개인적인 필요사항은 여행객과 주인장이 서로 협의해야 합니다."><img alt="Questionmark_hover" src="http://s0.muscache.com/1300304855/images/icons/questionmark_hover.png" style="width:16px; height:16px;" /></a> 
                        </label> 
                    </li> 
                    <li> 
                        <input value="7" id="amenity_7" name="amenities[]" type="checkbox" /> 
                        <label for="amenity_7">수영장
                                <a class="tooltip" title="전용 수영장"><img alt="Questionmark_hover" src="http://s0.muscache.com/1300304855/images/icons/questionmark_hover.png" style="width:16px; height:16px;" /></a> 
                        </label> 
                    </li> 
                    <li> 
                        <input value="8" id="amenity_8" name="amenities[]" type="checkbox" /> 
                        <label for="amenity_8">부엌
                                <a class="tooltip" title="손님 이용 가능한 부엌"><img alt="Questionmark_hover" src="http://s0.muscache.com/1300304855/images/icons/questionmark_hover.png" style="width:16px; height:16px;" /></a> 
                        </label> 
                    </li> 
                    <li> 
                        <input value="9" id="amenity_9" name="amenities[]" type="checkbox" /> 
                        <label for="amenity_9">주차 포함
                        </label> 
                    </li> 
                    <li> 
                        <input value="13" id="amenity_13" name="amenities[]" type="checkbox" /> 
                        <label for="amenity_13">세탁기/건조기
                                <a class="tooltip" title="건물 내 주차가능(유/무료)"><img alt="Questionmark_hover" src="http://s0.muscache.com/1300304855/images/icons/questionmark_hover.png" style="width:16px; height:16px;" /></a> 
                        </label> 
                    </li> 
                    <li> 
                        <input value="14" id="amenity_14" name="amenities[]" type="checkbox" /> 
                        <label for="amenity_14">도어맨
                        </label> 
                    </li> 
                    <li> 
                        <input value="15" id="amenity_15" name="amenities[]" type="checkbox" /> 
                        <label for="amenity_15">무료 헬스장
                                <a class="tooltip" title="헬스장 무료이용 가능"><img alt="Questionmark_hover" src="http://s0.muscache.com/1300304855/images/icons/questionmark_hover.png" style="width:16px; height:16px;" /></a> 
                        </label> 
                    </li> 
            </ul> 
            <ul class="amenity_column"> 
                    <li> 
                        <input value="25" id="amenity_25" name="amenities[]" type="checkbox" /> 
                        <label for="amenity_25">욕조
                        </label> 
                    </li> 
                    <li> 
                        <input value="27" id="amenity_27" name="amenities[]" type="checkbox" /> 
                        <label for="amenity_27">실내 벽난로
                        </label> 
                    </li> 
                    <li> 
                        <input value="28" id="amenity_28" name="amenities[]" type="checkbox" /> 
                        <label for="amenity_28">초인종/인터폰
                        </label> 
                    </li> 
                    <li> 
                        <input value="16" id="amenity_16" name="amenities[]" type="checkbox" /> 
                        <label for="amenity_16">아침식사
                                <a class="tooltip" title="아침식사 제공"><img alt="Questionmark_hover" src="http://s0.muscache.com/1300304855/images/icons/questionmark_hover.png" style="width:16px; height:16px;" /></a> 
                        </label> 
                    </li> 
                    <li> 
                        <input value="31" id="amenity_31" name="amenities[]" type="checkbox" /> 
                        <label for="amenity_31">가족/어린이 숙박가능
                                <a class="tooltip" title="어린이를 동반한 가족이 숙박하기에 적당합니다."><img alt="Questionmark_hover" src="http://s0.muscache.com/1300304855/images/icons/questionmark_hover.png" style="width:16px; height:16px;" /></a> 
                        </label> 
                    </li> 
                    <li> 
                        <input value="32" id="amenity_32" name="amenities[]" type="checkbox" /> 
                        <label for="amenity_32">이벤트행사용으로 적절
                                <a class="tooltip" title="25명 이상의 그룹을 수용할 수 있습니다."><img alt="Questionmark_hover" src="http://s0.muscache.com/1300304855/images/icons/questionmark_hover.png" style="width:16px; height:16px;" /></a> 
                        </label> 
                    </li> 
            </ul> 
 
        <div class="clear"></div> 
    </div> 
    <div class="bottom">&nbsp;</div> 
</div><!-- /box --> 
 
    <div class="box" id="details_container"> 
    <div class="top"> 
        <h2 class="step"><span class="edit_room_icon details"></span>상세정보</h2> 
    </div> 
    <div class="middle"> 
        <ul id="details"> 
            <li class="clearfix"> 
                <label for="hosting_person_capacity">숙박가능인원</label> 
                <select class="fixed-width" id="hosting_person_capacity" name="hosting[person_capacity]" onchange="accommodates_changed();"><option value="1" selected="selected">1 사람</option> 
<option value="2">2 사람들</option> 
<option value="3">3 사람들</option> 
<option value="4">4 사람들</option> 
<option value="5">5 사람들</option> 
<option value="6">6 사람들</option> 
<option value="7">7 사람들</option> 
<option value="8">8 사람들</option> 
<option value="9">9 사람들</option> 
<option value="10">10 사람들</option> 
<option value="11">11 사람들</option> 
<option value="12">12 사람들</option> 
<option value="13">13 사람들</option> 
<option value="14">14 사람들</option> 
<option value="15">15 사람들</option> 
<option value="16">16+ 사람들</option></select> 
                <div id="form_helper_person_capacity" class="form_helper" style="display:none;"><p>최대숙박가능인원수</p></div> 
            </li> 
            <li class="clearfix"> 
                <label for="hosting_bedrooms">침실 수</label> 
                <select class="fixed-width" id="hosting_bedrooms" name="hosting[bedrooms]"><option value=""></option> 
<option value="1" selected="selected">1 침실</option> 
<option value="2">2 침실</option> 
<option value="3">3 침실</option> 
<option value="4">4 침실</option> 
<option value="5">5 침실</option> 
<option value="6">6 침실</option> 
<option value="7">7 침실</option> 
<option value="8">8 침실</option> 
<option value="9">9 침실</option> 
<option value="10">10 침실</option></select> 
                <div id="form_helper_bedrooms" class="form_helper" style="display:none; width:320px;"><p>손님이 쓸 수 있는 침실이 총 몇 개인가요?</p></div> 
            </li> 
            <li class="clearfix"> 
                <label for="hosting_beds">침대</label> 
                <select class="fixed-width" id="hosting_beds" name="hosting[beds]"><option value="1">1 침대</option> 
<option value="2">2 침대</option> 
<option value="3">3 침대</option> 
<option value="4">4 침대</option> 
<option value="5">5 침대</option> 
<option value="6">6 침대</option> 
<option value="7">7 침대</option> 
<option value="8">8 침대</option> 
<option value="9">9 침대</option> 
<option value="10">10 침대</option> 
<option value="11">11 침대</option> 
<option value="12">12 침대</option> 
<option value="13">13 침대</option> 
<option value="14">14 침대</option> 
<option value="15">15 침대</option> 
<option value="16">16+ 침대</option></select> 
                <div id="form_helper_beds" class="form_helper" style="display:none; width:320px;"><p>손님용 침대, 소파, 두꺼운 요 등이 총 몇 개인가요?</p></div> 
            </li> 
            <li class="clearfix"> 
                <label for="hosting_bed_type">침대 타입</label> 
                <select class="fixed-width" id="hosting_bed_type" name="hosting[bed_type]"><option value="Airbed">Airbed</option> 
<option value="Futon">두꺼운 요</option> 
<option value="Pull-out Sofa">접이식소파</option> 
<option value="Couch">소파</option> 
<option value="Real Bed" selected="selected">매트리스 침대</option></select> 
            </li> 
            <li class="clearfix"> 
                <label for="hosting_bathrooms">화장실</label> 
                <select class="fixed-width" id="hosting_bathrooms" name="hosting[bathrooms]"><option value="" selected="selected"></option> 
<option value="0">0 화장실</option> 
<option value="0.5">0.5 화장실</option> 
<option value="1">1 화장실</option> 
<option value="1.5">1.5 화장실</option> 
<option value="2">2 화장실</option> 
<option value="2.5">2.5 화장실</option> 
<option value="3">3 화장실</option> 
<option value="3.5">3.5 화장실</option> 
<option value="4">4 화장실</option> 
<option value="4.5">4.5 화장실</option> 
<option value="5">5 화장실</option> 
<option value="5.5">5.5 화장실</option> 
<option value="6">6 화장실</option> 
<option value="6.5">6.5 화장실</option> 
<option value="7">7 화장실</option> 
<option value="7.5">7.5 화장실</option> 
<option value="8">8+ 화장실</option></select> 
            </li> 
            <li class="clearfix"> 
                <label for="hosting_square_feet">면적 <a class="tooltip" title="빌려주는 방의 크기.&lt;br /&gt;집/아파트 전체를 빌려주는 거면, 전체 사이즈도 입력하세요.&lt;br /&gt;개인 방만 빌려주는 거면, 방의 사이즈만 입력하세요."><img alt="Questionmark_hover" src="http://s0.muscache.com/1300304855/images/icons/questionmark_hover.png" style="width:; height:;" /></a></label> 
                <input id="hosting_square_feet" name="hosting[square_feet]" size="30" style="width: 100px;" type="text" /> 
                <select id="square_feet_in_feet" name="square_feet_in_feet"><option value="true">square feet</option> 
<option value="false">square meters</option></select> 
            </li> 
            <li class="clearfix"> 
                <label for="hosting_house_manual" style="vertical-align:top;">객실이용규칙
                <br/> 
                  <span class="helper"> 
                    예약요청이 수락되어 예약이 완료된 여행객에게만 이 정보가 전송됩니다.
(예, WIFI 비밀번호, lockbox code, 주차정보 등)
                  </span> 
                </label> 
                <textarea cols="40" id="hosting_house_manual" name="hosting[house_manual]" rows="20"></textarea> 
                <div id="form_helper_house_manual" class="form_helper" style="display:none;"></div> 
            </li> 
 
 
            <li class="clearfix"> 
                <label for="amenity_17">애완동물 있음</label> 
                <div class="grouped-options radio pets"> 
                    <input id="include_pets" name="include_pets" type="hidden" /> 
                    <label> 
                      <input type="radio" id="amenity_17" value="17" name="pets[]"  /> 
                      <strong>Yes</strong>, there are pets or animals here
                    </label> 
                    <label> 
                      <input type="radio" value="-1" name="pets[]" checked=&quot;checked&quot; /> 
                      <strong>No</strong>, there aren't any pets or animals here
                    </label> 
                </div> 
            <li id="pets-amenities" class="clearfix"> 
                <label for="amenity_17">애완동물 종류</label> 
                <div class="grouped-options checkbox"> 
                    <label for="amenity_18" class="amenity_label"> 
                      <input class="amenities_input" value="18" id="amenity_18" name="pets[]" type="checkbox"  /> 
                      개
                    </label> 
                    <label for="amenity_19" class="amenity_label"> 
                      <input class="amenities_input" value="19" id="amenity_19" name="pets[]" type="checkbox"  /> 
                      고양이
                    </label> 
                    <label for="amenity_20" class="amenity_label"> 
                      <input class="amenities_input" value="20" id="amenity_20" name="pets[]" type="checkbox"  /> 
                      기타 애완동물
                    </label> 
                </div> 
            </li> 
        </ul> 
    </div><!-- middle --> 
    <div class="bottom">&nbsp;</div> 
</div><!-- box --> 
 
    
 
 
 
<div class="box"> 
  <div class="top"> 
    <h2 class="step"> 
      <span class="edit_room_icon address"></span> 
      장소 정보
      <span id="edit_address_message" class="edit-address-message" style="display: none;"
          data-message-accuracy="<strong>주소가 정확하지 않습니다. 번지 수를 입력해 보세요. </strong><br />계속해서 문제가 생기면 <a href="/home/contact">고객 센터</a>로 문의하여 주소를 변경해 주세요, "
          data-message-find="<strong>드롭다운에서 옵션을 선택해야 주소를 찾을 수 있습니다.</strong><br />계속해서 문제가 생기면 <a href="/home/contact">고객 센터</a>로 문의하여 주소를 변경해 주세요, "
          data-message-good="<strong>다 되었습니다! 객실 정보를 저장하면 주소가 업데이트 됩니다. </strong><br />You may change your address until you have confirmed two reservations."
          data-message-contact="<strong>확인되지 않는 주소입니다.</strong><br />계속해서 문제가 생기면 <a href="/home/contact">고객 센터</a>로 문의하여 주소를 변경해 주세요, "></span> 
    </h2> 
  </div> 
  <div class="map-view"> 
    <h3 class="map-description exact"> 
      <span class="protip"> 
          <a href="#" id="edit-address">Edit address</a> 
          <a href="#" id="cancel-edit-address" style="display: none;">취소</a> 
      </span> 
      <span class="icon"></span> 
      상세 주소
      <span class="address">Gaj 1, City of Zagreb, City of Zagreb, Croatia</span> 
    </h3> 
    <div class="map-pane" id="private-map"></div> 
  </div> 
  <div class="map-view"> 
    <h3 class="map-description public"> 
      <span class="icon"></span>Public View
        <span class="address editing" style="display: none;"><em>편집중...</em></span> 
      <span class="address full" data-message-refresh="새로고침하여 업데이트 된 주소를 확인하세요. ">Gaj, City of Zagreb, City of Zagreb, Croatia</span> 
      <p><em>숙소 정보에 보여지게 될 주소입니다. </em></p> 
    </h3> 
    <div class="map-pane" id="public-map"> 
    </div> 
  </div> 
	<div class="middle"> 
		<ul id="location"> 
				<li> 
					<label for="address_street_view">스트리트뷰 <a class="tooltip" title="By Default we offset the location of your property to protect your privacy.&lt;br /&gt;You may show a more specific Street View location by choosing &quot;Closest to My Address&quot;.&lt;br /&gt;You may also choose to &quot;Hide Street View&quot;."><img alt="Questionmark_hover" src="http://s0.muscache.com/1300304855/images/icons/questionmark_hover.png" style="width:16px; height:16px;" /></a></label> 
					<select class="fixed-width" id="address_street_view" name="address[street_view]"><option value="0">Hide Street View</option> 
<option value="1" selected="selected">Nearby (within 2 blocks)</option> 
<option value="2">Closest to My Address</option></select> <a href="#" id="street-view-link" style="">View</a> 
					<div class="clear"></div> 
				</li> 
        <div style="display: none;"> 
          <div id="street-view-colorbox"></div> 
        </div> 
		</ul> 
		<div class="clear"></div> 
	</div> 
	<div class="bottom">&nbsp;</div> 
</div> 
 
    <div id="submit_new_room" class="form-submit"> 
      <input class="button-glossy" id="edit_room_submit_button" name="commit" style="width: auto;" type="submit" value="저장" /> 
      <span class="spinner"></span> 
      <div class="clear"></div> 
    </div> 
    <input id="update_progress" name="update_progress" type="hidden" value="1" /> 
</form> 
 
      </div> 
    </div> 
  </div> 
  <div class="clear"></div> 
</div><!-- edit_room --> 
 
 
		
 
	    <div id="footer"> 
	        <ul> 
                <li class="first-child"><a href="/collections">컬렉션</a></li> 
                <li><a href="/iphone">아이폰 앱</a></li> 
                <li><a href="http://tv.airbnb.com">에어비앤비 TV
</a></li> 
                <li><a href="/about">회사소개</a></li> 
                <li><a href="/jobs">채용</a></li> 
                <li><a href="http://blog.airbnb.com">블로그</a></li> 
                <li><a href="/help">FAQ</a></li> 
                <li><a href="/terms">이용약관</a></li> 
                <li>스페셜:&nbsp;&nbsp;<a href="/new-york-city">뉴욕</a></li> 
                <li><a href="/san-francisco">샌프란시스코</a></li> 
                <li><a href="/paris-france">파리</a></li> 
                <li><a href="/locations">인기도시</a></li> 
          </ul> 
		<ul style="padding-top:4px;"> 
			<li class="first-child"> 
				Join us on:&nbsp;&nbsp;<a href="http://www.twitter.com/airbnb" target="new">Twitter</a> 
			</li> 
			<li> 
				<a href="http://www.facebook.com/airbnb" target="new">Facebook</a> 
			</li> 
			<li> 
				<a href="http://www.youtube.com/airbnb" target="new">YouTube</a> 
			</li> 
		</ul> 
          <div id="copyright">&copy; Airbnb, Inc.</div> 
          <br/> 
	</div> 
 
 
		<div id="fb-root"></div> 
 
  
  
 
	<script type="text/javascript"> 
		/* <![CDATA[ */
		var google_conversion_id = 1049231994;
		var google_conversion_language = "en";
		var google_conversion_format = "3";
		var google_conversion_color = "666666";
		var google_conversion_label = "0W9CCND30wEQ-oSo9AM";
		var google_conversion_value = 0;
		/* ]]> */
	</script> 
	<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js"></script> 
	<noscript> 
		<div style="display:inline;">
		<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1049231994/?label=0W9CCND30wEQ-oSo9AM&amp;guid=ON&amp;script=0"/>
		</div>
	</noscript> 
 
 
			<script type="text/javascript" src="http://maps.google.com/maps/api/js?v=3.5&sensor=false&amp;libraries=places"></script> 
 
 
	<script type="text/javascript"> 
 
			window.fbAsyncInit = function() {
				FB.init({
					appId  : '02e3aebb07b4f37b41893ae7713c8fdc',
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
 
 
		jQuery(document).ready(function($) {
  $(".grouped-options.pets").delegate("input[type='radio']", "change", function(eventObj) {
    if(!$('#amenity_17').is(':checked')) {
      $('#pets-amenities').fadeOut(function() {
        $(this).find("input[type='checkbox']").removeAttr("checked");
      });
    } else {
      $('#pets-amenities').fadeIn();
    }
  }).find("input[type='radio']").first().change();
});
jQuery(document).ready(function() {
  AirbnbRoomEdit.init({
    exactCoords: new google.maps.LatLng(45.761349, 15.87763),
    fuzzyCoords: new google.maps.LatLng(45.7617792219112, 15.8764637217647),
    accuracy: 8,
    supportContent: "<p><strong>Gaj 1, City of Zagreb, City of Zagreb, Croatia</strong></p><p>Please contact <a href=\"/home/contact\">Airbnb support</a> to change this address.</p>"
  });
});
 
 
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-2725447-1']);
		_gaq.push(['_setDomainName', '.airbnb.com']);
 
		(function() {
			var m = /affiliate=([^;]*)/.exec(document.cookie);
			if (m) {_gaq.push(["_setCustomVar", 1, "affiliate", m[1]]);}
		})();
 
			_gaq.push(['_trackPageview']);
 
		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
 
		jQuery(document).ready(function() {
			Airbnb.init({userLoggedIn: true});
		});
 
		Airbnb.FACEBOOK_PERMS = "email,user_birthday,user_likes,user_education_history,user_hometown,user_interests,user_activities,user_location";
	</script> 
	<script type="text/javascript" charset="utf-8">NREUMQ.push(["nrf2","beacon-1.newrelic.com","fc09a36731",2237,"dlwMQktaWAgBEB1AXFpeERlcUV0Q",0,146])</script></body> 
</html> 
 