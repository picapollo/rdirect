
 
 
 
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
<link href="http://s2.muscache.com/1311638524/assets/common-datauri.css" media="screen" rel="stylesheet" type="text/css" /> 
<!--<![endif]--> 
<!--[if lte IE 7]>
<link href="http://s0.muscache.com/1311638523/assets/common.css" media="screen" rel="stylesheet" type="text/css" />
<![endif]--> 
    <!--[if (!IE)|(gte IE 8)]><!--> 
<link href="http://s2.muscache.com/1311638521/assets/edit_listing-datauri.css" media="screen" rel="stylesheet" type="text/css" /> 
<!--<![endif]--> 
<!--[if lte IE 7]>
<link href="http://s3.muscache.com/1311638520/assets/edit_listing.css" media="screen" rel="stylesheet" type="text/css" />
<![endif]--> 
 
		<link href="http://s0.muscache.com/1300304856/stylesheets/korean_fonts.css" media="screen" rel="stylesheet" type="text/css" /> 
 
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script> 
			<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script> 
 
		<script src="http://s3.muscache.com/1310602728/javascripts/jquery.ui.datepicker/jquery.ui.datepicker-ko.min.js" type="text/javascript"></script> 
 
		<script type="text/javascript"> 
			jQuery.noConflict();
		</script> 
 
			<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/prototype/1.6.0.3/prototype.js"></script> 
			<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/scriptaculous/1.8.2/scriptaculous.js"></script> 
		<script src="http://s2.muscache.com/1300304855/javascripts/calendar_date_select/calendar_date_select.js" type="text/javascript"></script> 
<script src="http://s3.muscache.com/1300304855/javascripts/calendar_date_select/format_american.js" type="text/javascript"></script> 
<link href="http://s1.muscache.com/1300304856/stylesheets/calendar_date_select/silver.css" media="screen" rel="stylesheet" type="text/css" /> 
 
 
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
	</head> 
 
  <body> 
 
  
 
        <div id="header" class="clearfix"> 
			<a id="logo" href="http://www.airbnb.com" title="Airbnb.com Home"> 
				<img alt="Airbnb - Travel like a human." border="0" height="45" src="http://s2.muscache.com/1309460642/images/logos/109x45.png" width="109" /> 
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
    <div class="set-availability action_button" data-has-availability="false" data-available-url="/rooms/change_availability/181683?is_available=1&redirect=%2Frooms%2F181683%2Fedit%3Fsection%3Dphotos&sig=LS0tIAotICFiaW5hcnkgfAogIG1vUEg4OTBjYnRiSWtyenVzMDZCYXg2bHVYcz0KCi0gfAogIC0tLSAKICAtICIxODE2ODMiCiAgLSAiMSIKICAtIC9yb29tcy8xODE2ODMvZWRpdD9zZWN0aW9uPXBob3RvcwoKLSBUdWUgSnVsIDI2IDE1OjQwOjAwICswMDAwIDIwMTEK" data-unavailable-url="/rooms/change_availability/181683?is_available=0&redirect=%2Frooms%2F181683%2Fedit%3Fsection%3Dphotos&sig=LS0tIAotICFiaW5hcnkgfAogIHBTN2s0dG1iUW1tYlUyYlVNT2VocWVyc3dPMD0KCi0gfAogIC0tLSAKICAtICIxODE2ODMiCiAgLSAiMCIKICAtIC9yb29tcy8xODE2ODMvZWRpdD9zZWN0aW9uPXBob3RvcwoKLSBUdWUgSnVsIDI2IDE1OjQwOjAwICswMDAwIDIwMTEK"> 
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
        <ul class="edit_room_nav"><li ><a class="details" href="/rooms/181683/edit?section=details"><span class="icon"></span>설명:</a><li class="selected"><a class="photos" href="/rooms/181683/edit?section=photos"><span class="icon"></span>사진</a><li ><a class="calendar" href="/calendar/single/181683"><span class="icon"></span>달력</a><li ><a class="pricing" href="/hosting/pricing?hosting_id=181683"><span class="icon"></span>가격 및 조건</a></ul><ul class="edit_room_nav"><li ><a class="promote" href="/hosting/promote/181683"><span class="icon"></span>홍보하기</a></ul> 
      </div> 
    </div> 
    <div class="col three-fourths content"> 
      
      <div id="notification-area"></div> 
      <div id="dashboard-content"> 
        
 
 
 
    <div> 
<div class="box" id="photos"> 
    <div class="top"> 
        <h2 class="step"><span class="edit_room_icon photo"></span>사진</h2> 
    </div> 
 
    <div class="middle"> 
        <div id="photo_gizmo"> 
 
    <div id="options_container"> 
 
    </div> 
 
            <div id="top_part" class="row"> 
                <div id="add_new_photo" class="col half"> 
                  <div class="padded-text"> 
 
                    <form target="upload_frame" action="/rooms/ajax_hosting_image_upload" id="ajax_upload_form" name="ajax_upload_form" method="post" enctype="multipart/form-data"> 
                        <input id="hosting_id" name="hosting_id" type="hidden" value="181683" /> 
                        <label id="upload_photo" for="new_photo">사진 업로드</label> 
                        <input id="new_photo_image" name="new_photo[image]" onchange="$('upload_feedback').innerHTML = '&lt;p class=&quot;good&quot;&gt;사진 업로드중...&lt;/p&gt;'; wait_for_upload(); $('ajax_upload_form').submit(); return false;" size="24" type="file" /> 
                    </form> 
 
                    <iframe id="upload_frame" name="upload_frame" style="display:none;"></iframe> 
 
                    <div id="upload_feedback"></div> 
        <p>객실사진은 최대 100장까지 업로드 할 수 있습니다.<br/> 
                    640x425 픽셀, 2MB 이하의 사진을 올리세요. <a href="http://blog.airbnb.com/top-5-photo-tips-for-a-stellar-listing">사진을 위한 팁</a></p> 
                    </div> 
                </div> 
 
                <div id="instructions" class="col half"> 
                <div class="padded-text"> 
        <div id="other_options"> 
          <span id="title">더 많은 옵션:</span> 
          <div id="iphone_button"> 
 
            <a href="http://itunes.apple.com/us/app/airbnb/id401626263" class="button rounded_more">아이폰 앱 다운로드 하기</a> 
            <span class="button_description">아이폰으로 사진찍기</span> 
          </div> 
            <div id="photog_button"> 
              <a href="/info/photography?room=181683" class="button rounded_more">무료 사진촬영 서비스 신청하기</a> 
              <span class="button_description">에어비앤비 사진사와 스케쥴 잡으세요.</span> 
            </div> 
        </div> 
                    <p>메인사진이 들어가는 위치. 사진을 클릭하고 드래그하여 순서를 바꾸세요.</p> 
                </div> 
                </div> 
            </div> 
            <div class="row top-border"> 
            <div id="left_side" class="col half rounded"> 
            <div class="photo-padding"> 
                <div id="current_photo_container" style="position:relative"> 
                    <img id="spinner" src="/images/blue_spinner.gif" height="16" width="16" style="position:absolute; top:25%; left:50%; margin-top:-8px; margin-left:-8px; display:none;" /> 
                    <div id="current_photo"> 
                            <p style="font-size:16px; padding:5px; color:#333333; font-weight:bold;">안녕? 아직 사진을 안올린것 같은데 위에 있는 업로더로 시작해봐!</p> 
                    </div> 
                </div> 
            </div> 
            </div> 
            <div id="right_side" class="col half rounded"> 
            <div class="photo-padding"> 
                <div id="all_photos"> 
                    <ul id="sortable_photos" style="float:left;"> 
                    </ul> 
                    <div style="float:left;text-align:center; float:left; padding:0 6px;"> 
                        <p id="sortable_photos_status_message" style="display:none;"></p> 
                    </div> 
                </div> 
            </div> 
            </div> 
        </div> 
        </div> 
        <div class="clear"></div> 
    </div><!-- middle --> 
 
 
    <div class="bottom">&nbsp;</div> 
</div><!-- box --> 
<script type="text/javascript"> 
//<![CDATA[
Sortable.create("sortable_photos", {constraint:false, onUpdate:function(){new Ajax.Request('/rooms/ajax_update_image_order?hosting_id=181683', {asynchronous:true, evalScripts:true, parameters:Sortable.serialize("sortable_photos")})}, overlap:'horizontal', scroll:false})
//]]>
</script> 
</div> 
 
 
 
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
	<script type="text/javascript" charset="utf-8">NREUMQ.push(["nrf2","beacon-1.newrelic.com","fc09a36731",2237,"dlwMQktaWAgBEB1AXFpeERlcUV0Q",0,175])</script></body> 
</html> 
 