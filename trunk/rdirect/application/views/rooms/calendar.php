
 
 
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml"> 
    <head><script>var NREUMQ=[];NREUMQ.push(["mark","firstbyte",new Date().getTime()]);(function(){var d=document;var e=d.createElement("script");e.type="text/javascript";e.async=true;e.src="https://d1ros97qkrwjf5.cloudfront.net/14/eum/rum.js	";var s=d.getElementsByTagName("script")[0];s.parentNode.insertBefore(e,s);})()</script> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/> 
        <title>휴가기간 임대, 전용 객실, 서블렛 - 에어비앤비에서의 숙박</title> 
 
        <meta name="title" content="휴가기간 임대, 전용 객실, 서블렛 - 에어비앤비에서의 숙박" /> 
 
 
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
    <link href="http://s2.muscache.com/1311619232/stylesheets/calendar_single.css" media="screen" rel="stylesheet" type="text/css" /> 
 
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
		    <style> 
      .past { color: gray; }
    </style> 
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
			    function get_square(rowIndex,colIndex) {
        return schedules[rowIndex][colIndex];
    }
    function gridColToDataCol(gridCol) {
        return (gridCol);
    }
 
    function gridRowToDataRow(gridRow) {
        return (gridRow);
    }
 
    function update_calendar_data(visible_row,hosting_id,json) {
        //if (hosting_id!=hostings[data_row].id) alert('DEBUG1: ids do not match');
        schedules[0] = json[0];
        render_grid(14, 48);
    }
 
    // ---------------------------------------------------
    function is_address_line(row) {
        return false;
    }
 
    function lwlb_hide_special() {
        lwlb_hide('lwlb_calendar2');
        range_remove_all();
    }
 
    function range_add(i){
        //alert('range_add start: i='+i+', select_start='+select_range_start+', select_stop='+select_range_stop);
        if (select_range_stop == null) return;
        if (i < select_range_start) return;
 
        if (i < select_range_stop) range_remove(i+1);
        //alert('range_add start2: i='+i+', select_start='+select_range_start+', select_stop='+select_range_stop);
        //alert("i="+i+",stop="+select_range_stop);
 
        for (var tmp=select_range_stop; tmp <= i; tmp++) {
            if (!is_selectable(0,tmp)) return;
            
            rollover('tile_' + tmp, 'tile', 'tile_selected');
        }
        //alert('add');
        select_range_stop = i;
    }
 
    function range_remove(i) {
        //alert('range_remove start: i='+i+', select_start='+select_range_start+', select_stop='+select_range_stop);
 
        if (select_range_stop == null) return;
        if (i <= select_range_start) return;
        //if (i <= select_range_start) {
        //    select_range_start = i;
        //    range_add(i);
        //}
        
        if (select_range_click_count>=2) return;
        if (i>select_range_stop) return;
 
        for (; select_range_stop >= i; select_range_stop--) {
            //if (!is_selectable(0,select_range_stop)) return;
            
            rollover('tile_' + select_range_stop, 'tile_selected', 'tile');
        }
 
        //if (i<select_range_stop)
        select_range_stop = i;
    }
 
 
    function range_remove_all() {
        for (var i=select_range_start; i <= select_range_stop; i++) {
            rollover('tile_' + i, 'tile_selected', 'tile');
        }
 
        select_range_click_count = 0;
        select_range_start = null;
        select_range_stop = null;
    }
 
    function click_down(i) {
        select_range_click_count++;
 
        if (select_range_click_count > 2) {
            range_remove_all();
            return;
        }
 
        if (select_range_stop != null) return; // abort on second click
 
        if (!is_selectable(0, i)) {
            var matches = getAtomicBounds(0,i);
            select_range_start = matches[0];
            select_range_stop = matches[1];
            show_calendar();
            return;
        }
 
        select_range_start = i;
        select_range_stop = i;
        //alert("start="+select_range_start+",stop="+select_range_stop);
        rollover('tile_'+i,'tile','tile_selected');
    }
 
    function click_up(i) {
        if (select_range_click_count>=2) {
 
            show_calendar();
 
            //row = Math.floor(select_range_start / 7);
            //col = select_range_start % 7;
            //Element.setStyle($('lwlb_calendar2'), 'left:'+(130+col*106)+'px;');
            //Element.setStyle($('lwlb_calendar2'), 'top:'+(100+row*80)+'px;');
        }
    }
 
    function show_calendar() {
        prepareLightbox(181683,"12",0,select_range_start,select_range_stop);
 
    }
 
    jQuery(document).ready(function(){
      Airbnb.Utils.initVideoLightbox('#open_help_video_link', 'How to use the Calendar as a Host', '<object width="460" height="290"><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="http://player.vidcaster.com/media/player/v1.swf" /><param name="flashvars" value="config=http://www.vidcaster.com/embed/8BQ/v1/" /><embed src="http://player.vidcaster.com/media/player/v1.swf" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" flashvars="config=http://www.vidcaster.com/embed/8BQ/v1/" width="460" height="290"></embed></object>')
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
    <div class="set-availability action_button" data-has-availability="false" data-available-url="/rooms/change_availability/181683?is_available=1&redirect=%2Fcalendar%2Fsingle%2F181683&sig=LS0tIAotICFiaW5hcnkgfAogIGlwaG8wa0kzNEloZm43aWJXcEdqWjUxSk5sUT0KCi0gfAogIC0tLSAKICAtICIxODE2ODMiCiAgLSAiMSIKICAtIC9jYWxlbmRhci9zaW5nbGUvMTgxNjgzCgotIFR1ZSBKdWwgMjYgMTM6MTU6MzIgKzAwMDAgMjAxMQo%3D" data-unavailable-url="/rooms/change_availability/181683?is_available=0&redirect=%2Fcalendar%2Fsingle%2F181683&sig=LS0tIAotICFiaW5hcnkgfAogIGxqSkNuREc5ZnYrL2c2K3NYeGdEQ0FQQmtIaz0KCi0gfAogIC0tLSAKICAtICIxODE2ODMiCiAgLSAiMCIKICAtIC9jYWxlbmRhci9zaW5nbGUvMTgxNjgzCgotIFR1ZSBKdWwgMjYgMTM6MTU6MzIgKzAwMDAgMjAxMQo%3D"> 
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
        <ul class="edit_room_nav"><li ><a class="details" href="/rooms/181683/edit?section=details"><span class="icon"></span>설명:</a><li ><a class="photos" href="/rooms/181683/edit?section=photos"><span class="icon"></span>사진</a><li class="selected"><a class="calendar" href="/calendar/single/181683"><span class="icon"></span>달력</a><li ><a class="pricing" href="/hosting/pricing?hosting_id=181683"><span class="icon"></span>가격 및 조건</a></ul><ul class="edit_room_nav"><li ><a class="promote" href="/hosting/promote/181683"><span class="icon"></span>홍보하기</a></ul> 
      </div> 
    </div> 
    <div class="col three-fourths content"> 
      
      <div id="notification-area"></div> 
      <div id="dashboard-content"> 
        <!--[if IE 6]>
  <style>
#calendar2 .tile_selected,
#calendar2 .tile_disabled,
#calendar2 .tile { margin-right: -20px; }
#calendar2 .line_reg { overflow: hidden; text-overflow: ellipsis;  }
  </style>
<![endif]--> 
 
 
    <script> 
 
var global_grid = null;
 
var columnInfo = ["Sun\u003Cbr /\u003EJun 12","Mon\u003Cbr /\u003EJun 13","Tue\u003Cbr /\u003EJun 14","Wed\u003Cbr /\u003EJun 15","Thu\u003Cbr /\u003EJun 16","Fri\u003Cbr /\u003EJun 17","Sat\u003Cbr /\u003EJun 18","Sun\u003Cbr /\u003EJun 19","Mon\u003Cbr /\u003EJun 20","Tue\u003Cbr /\u003EJun 21","Wed\u003Cbr /\u003EJun 22","Thu\u003Cbr /\u003EJun 23","Fri\u003Cbr /\u003EJun 24","Sat\u003Cbr /\u003EJun 25","Sun\u003Cbr /\u003EJun 26","Mon\u003Cbr /\u003EJun 27","Tue\u003Cbr /\u003EJun 28","Wed\u003Cbr /\u003EJun 29","Thu\u003Cbr /\u003EJun 30","Fri\u003Cbr /\u003EJul 01","Sat\u003Cbr /\u003EJul 02","Sun\u003Cbr /\u003EJul 03","Mon\u003Cbr /\u003EJul 04","Tue\u003Cbr /\u003EJul 05","Wed\u003Cbr /\u003EJul 06","Thu\u003Cbr /\u003EJul 07","Fri\u003Cbr /\u003EJul 08","Sat\u003Cbr /\u003EJul 09","Sun\u003Cbr /\u003EJul 10","Mon\u003Cbr /\u003EJul 11","Tue\u003Cbr /\u003EJul 12","Wed\u003Cbr /\u003EJul 13","Thu\u003Cbr /\u003EJul 14","Fri\u003Cbr /\u003EJul 15","Sat\u003Cbr /\u003EJul 16","Sun\u003Cbr /\u003EJul 17","Mon\u003Cbr /\u003EJul 18","Tue\u003Cbr /\u003EJul 19","Wed\u003Cbr /\u003EJul 20","Thu\u003Cbr /\u003EJul 21","Fri\u003Cbr /\u003EJul 22","Sat\u003Cbr /\u003EJul 23","Sun\u003Cbr /\u003EJul 24","Mon\u003Cbr /\u003EJul 25","Tue\u003Cbr /\u003EJul 26","Wed\u003Cbr /\u003EJul 27","Thu\u003Cbr /\u003EJul 28","Fri\u003Cbr /\u003EJul 29","Sat\u003Cbr /\u003EJul 30","Sun\u003Cbr /\u003EJul 31","Mon\u003Cbr /\u003EAug 01","Tue\u003Cbr /\u003EAug 02","Wed\u003Cbr /\u003EAug 03","Thu\u003Cbr /\u003EAug 04","Fri\u003Cbr /\u003EAug 05","Sat\u003Cbr /\u003EAug 06","Sun\u003Cbr /\u003EAug 07","Mon\u003Cbr /\u003EAug 08","Tue\u003Cbr /\u003EAug 09","Wed\u003Cbr /\u003EAug 10","Thu\u003Cbr /\u003EAug 11","Fri\u003Cbr /\u003EAug 12","Sat\u003Cbr /\u003EAug 13","Sun\u003Cbr /\u003EAug 14","Mon\u003Cbr /\u003EAug 15","Tue\u003Cbr /\u003EAug 16","Wed\u003Cbr /\u003EAug 17","Thu\u003Cbr /\u003EAug 18","Fri\u003Cbr /\u003EAug 19","Sat\u003Cbr /\u003EAug 20","Sun\u003Cbr /\u003EAug 21"];
var hostings = [{"price":12,"name":"12","available":0,"row":0,"id":181683,"currency_symbol":"$","currency":"USD","lc_name":"12"}];
var schedules = [[{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1},{cl: "av", sty: "both", isa: 1}]];
 
var reservationHash = new Hash({});
 
var g_start_date = date_parse_datestamp('2011-06-12');
var g_stop_date = date_parse_datestamp('2011-08-20');
var g_today_index = 44;
 
var g_enable_change_dates = true;
 
 
/* Mouse tracking */
var g_mouse_x = 0;
var g_mouse_y = 0;
 
jQuery(document).ready(function(){
  jQuery(document).mousemove(function(e){
    g_mouse_x = e.pageX;
    g_mouse_y = e.pageY;
  });
});
 
function centerLightbox() {
    var boxWidth = jQuery('#lwlb_calendar2').width();
    var boxHeight= jQuery('#lwlb_calendar2').height();
    $('lwlb_calendar2').setStyle({ position:"absolute", left: (g_mouse_x - (boxWidth / 2))+"px", top: (g_mouse_y - boxHeight - 25)+"px"});
}
 
/***** SELECTION *****/
 
/* A span is selectable if it contains no atomic groups */
function is_selectable(gridRow,gridCol) {
    if (is_address_line(gridRow)) return false;
 
    var schedule = get_square(gridRow,gridCol);
    if (schedule.gid || schedule.confirmation) {
        return false;
    } else {
        return true;
    }
}
 
/* If atomic span / grouping, what are the bounds of the span? */
function getAtomicBounds(gridRow,gridCol) {
    var minCol = gridCol;
    var maxCol = gridCol;
 
    var grouping_uid = get_square(gridRow,gridCol).gid;
    while (get_square(gridRow,maxCol+1) && (get_square(gridRow,maxCol+1).gid==grouping_uid)) {
        maxCol+=1;
    }
    while (get_square(gridRow,minCol-1) && (get_square(gridRow,minCol-1).gid==grouping_uid)) {
        minCol-=1;
    }
    return [minCol,maxCol];
}
 
function getSpanBounds(gridRow,gridCol) {
    var minCol = gridCol;
    var maxCol = gridCol;
 
    if (get_square(gridRow,gridCol).sty=='single') return [minCol,maxCol];
    while (get_square(gridRow,maxCol+1) && (get_square(gridRow,maxCol+1).sty!='right')) {
        maxCol+=1;
    }
    return [minCol,maxCol+1];
}
 
 
/* rendering */
/*
function getHeaderText(colIndex) {
    if (0==colIndex) return '&nbsp;';
    var colDataIndex = colIndex-1;
 
    var starting_tag = "";
    var closing_tag = "";
 
    if (colDataIndex < g_today_index) {
        starting_tag = '<span class="past">';
        closing_tag = '</span>';
    } else if (colDataIndex == g_today_index) {
        starting_tag = '<span class="today">';
        closing_tag = '</span>';
    }
    return (starting_tag+columnInfo[colDataIndex]+closing_tag);
}
*/
 
 
function getSquareText(square,gridRow,gridCol) {
    var dataRow = gridRowToDataRow(gridRow);
    var dataCol = gridColToDataCol(gridCol);
 
    var hosting = hostings[dataRow];
    
    if (("left"==square.sty) || ("single"==square.sty)) {
        switch(square.st) {
        case 0:
            if (square.daily_price) {
                return hosting.currency_symbol + square.daily_price;
            } else {
                return hosting.currency_symbol + hosting.price;
            }
        case 2:
            if (square.notes) {
                return square.notes
            } else {
                return 'Not available';
            }
        case 5:
            if (square.notes) {
                return square.notes
            } else {
                return 'Not available';
            }
        case 3:
            if (square.notes) {
                return square.sst + ": " + square.notes
            } else {
                return square.sst + ': Not available';
            }
        case 4:
            return (square.reservation_value ? ""+hosting.currency_symbol+square.reservation_value+" " : '') + (square.square_subtype_other ?  square.square_subtype_other : (square.sst ? square.sst : "Other")) + (square.notes ? ": "+square.notes : '');
        case 1:
            var r = reservationHash.get(square.confirmation);
            if (!r) return '(error)';
            if (r.is_accepted) {
                return r.base_price + " Airbnb, " + r.guest_name +  (square.notes ? ": "+square.notes : '');
            } else {
                return r.base_price + " Airbnb, " + r.guest_name + " (PENDING)" + (square.notes ? ": "+square.notes : '');
            }
        default: return hosting.currency_symbol + hostings[dataRow].price;
        }
    } else if ((dataCol==0) && square.isa) {
        if (square.daily_price) {
            return hosting.currency_symbol + square.daily_price;
        } else {
            return hosting.currency_symbol + hosting.price;
        }
    } else {
        return "&nbsp;";
    }
}
 
 
function before_submit() {
	$('lightbox_submit').disabled = true;
	$('lightbox_spinner').show();
}
 
function after_submit() {
	$('lightbox_submit').disabled = false;
	$('lightbox_spinner').hide();
    lwlb_hide_special();
}
 
 
function prepareLightbox(hosting_id,hosting_name,gridRow,gridMinCol,gridMaxCol) {
    var firstSquare = get_square(gridRow,gridMinCol);
    var lastSquare = get_square(gridRow,gridMaxCol);
    var startDate = new Date(g_start_date.getTime()); //date_parse_datestamp(firstSquare.dt);
    var stopDate = new Date(g_start_date.getTime()); //date_parse_datestamp(lastSquare.dt);
 
    var dataRow = gridRowToDataRow(gridRow);
    var hosting = hostings[dataRow];
 
    $$("span.currency_symbol").each(function(x){ x.innerHTML=hosting.currency_symbol; });
    $('lwlb_currency').value = hosting.currency;
 
    startDate.setDate(startDate.getDate() + gridColToDataCol(gridMinCol));
    stopDate.setDate(stopDate.getDate() + gridColToDataCol(gridMaxCol));
 
    /* Applies to all lightbox styles */
 
    $('lightbox_submit').disabled = false;
	$('lightbox_spinner').hide();
 
    $('lwlb_hosting_id').value = hosting_id;
    $('lwlb_visible_row').value = gridRow;
 
    if (firstSquare.gid) {
        $('lwlb_grouping_uid').value = firstSquare.gid;
    } else {
        $('lwlb_grouping_uid').value = "";
    }
 
    $('lwlb_starting_date').value = $('lwlb_starting_date_original').value = date_print_usa_date(startDate);
    $('lwlb_stopping_date').value = $('lwlb_stopping_date_original').value = date_print_usa_date(stopDate);
    $('lwlb_data_start_date').value = date_print_usa_date(g_start_date);
    $('lwlb_confirmation').value = firstSquare.confirmation ? firstSquare.confirmation : '';
 
    if (firstSquare.notes) {
        if (firstSquare.notes) $('lwlb_notes').value = firstSquare.notes;
    } else {
        $('lwlb_notes').value = "Notes...";
    }
 
    $('lwlb_reservation_section').hide();
    $('lwlb_normal_section').hide();
 
    // Reservation Case
    if (firstSquare.st==1) {
        g_enable_change_dates = false;
        var r = reservationHash.get(firstSquare.confirmation);
 
        $('lwlb_availability').value = "Booked";
        $('lwlb_booking_service_other').value = "Airbnb";
 
        // Setup the date span
        $('lwlb_date_span_start').innerHTML = date_print_simplified(date_parse_datestamp(r.start_date));
        $('lwlb_date_span_stop').innerHTML = date_print_simplified(date_parse_datestamp(r.end_date));
        $('lwlb_date_single').hide();
        $('lwlb_date_span').show();
 
        $('lwlb_reservation_section').show();
        $('lwlb_reservation_guest_pic').src = r.guest_pic;
        $('lwlb_reservation_hosting_name').innerHTML = hosting_name;
 
        if (r.is_accepted) {
            $('lwlb_reservation_code').innerHTML = r.confirmation;
        } else {
            $('lwlb_reservation_code').innerHTML = "pending";
        }
        $('lwlb_reservation_guest_name').innerHTML = r.guest_name;
        $('lwlb_reservation_dates').innerHTML = date_print_simplified(date_parse_datestamp(r.start_date)) + " - " + date_print_simplified(date_parse_datestamp(r.end_date));
        $('lwlb_reservation_base_price').innerHTML = r.base_price;
        $('lwlb_reservation_guest_email').innerHTML = r.guest_email;
        $('lwlb_reservation_guest_email').href = "mailto:"+r.guest_email;
        $('lwlb_reservation_guest_phone').innerHTML = (""==r.guest_phone) ? "(unknown)" : r.guest_phone;
 
        if (r.is_accepted) {
            $('lwlb_reservation_contact').show();
            $('lwlb_reservation_itinerary').show();
            $('lwlb_reservation_accept').hide();
        } else {
            $('lwlb_reservation_contact').hide();
            $('lwlb_reservation_itinerary').hide();
            $('lwlb_reservation_accept').show();
        }
 
    } else {
        g_enable_change_dates = true;
        //if (minColIndex<g_today_index) return false; // disable click behavior if non-reservation
 
        $('lwlb_hosting_name').innerHTML = hosting_name;
 
        // Setup the date span
        if (gridMinCol==gridMaxCol) {
            $('lwlb_date_single').innerHTML = date_print_simplified(startDate);
            $('lwlb_date_single').show();
            $('lwlb_date_span').hide();
        } else {
            $('lwlb_date_span_start').innerHTML = date_print_simplified(startDate);
            $('lwlb_date_span_stop').innerHTML = date_print_simplified(stopDate);
            $('lwlb_date_single').hide();
            $('lwlb_date_span').show();
        }
 
        $('lwlb_normal_section').show();
 
        //$('price').value = ""; //schedules[i].daily_price;
        if ((0==firstSquare.st) || !firstSquare.st) {
            $('lwlb_availability').value = 'Available';
        } else if ((2==firstSquare.st) || (5==firstSquare.st)) {
            $('lwlb_availability').value = 'Not Available';
        } else {
            $('lwlb_availability').value = 'Booked';
        }
        lwlb_availability_changed();
 
        if (firstSquare.daily_price) {
            $('lwlb_daily_price').value = firstSquare.daily_price;
        } else {
            $('lwlb_daily_price').value = '';
        }
        if (firstSquare.st==4) {
            $('lwlb_booking_service').value = firstSquare.sst;
            if (firstSquare.sst=="Other") {
                $('lwlb_booking_service_other').value = firstSquare.square_subtype_other ? firstSquare.square_subtype_other : '';
                $('lwlb_booking_service_other').show();
                //$('lwlb_booking_service').value = 'Other';
            } else {
                $('lwlb_booking_service_other').value = '';
                $('lwlb_booking_service_other').hide();
 
            }
        } else {
            $('lwlb_booking_service').value = "";
            $('lwlb_booking_service_other').value = '';
            $('lwlb_booking_service_other').hide();
        }
        
        if (firstSquare.reservation_value) {
            $('lwlb_value').value = firstSquare.reservation_value;
        } else {
            $('lwlb_value').value = "";
        }
    }
 
    lwlb_show('lwlb_calendar2',{no_scroll: true});
 
    centerLightbox(); // specific to multi-calendar vs. singular calendar
}
 
 
/**** DATE HELPERS ****/
 
function get_month_abbrev(month) {
    return ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'][month];
}
 
function date_parse_datestamp(datestamp) {
    // yyyy-mm-dd
    var parts = datestamp.split("-");
    return new Date(parts[0],parts[1]-1,parts[2]);
    //return new Date(get_month_abbrev(parts[1]-1)+" "+parts[2]+", "+parts[0]+" 00:00:00 "); // parts[0],parts[1]-1,parts[2]
}
function date_parse_usa_date(datestamp) {
    // mm/dd/yyyy
    var parts = datestamp.split("/");
    return new Date(parts[2],parts[0]-1,parts[1]);
}
 
function date_print_usa_date(dt) {
    // 2010-03-11: KEEP IT IN THE LOCAL TIMEZONE; OTHERWISE DATE OFFSET PROBLEMS!
    return (dt.getMonth()+1) + "/" + dt.getDate() + "/" + dt.getFullYear();
}
 
function date_print_simplified(dt) {
    //return get_month_abbrev(dt.getUTCMonth()) + " " + dt.getUTCDate();
    // 2010-03-11: KEEP IT IN THE LOCAL TIMEZONE; OTHERWISE DATE OFFSET PROBLEMS!
    return get_month_abbrev(dt.getMonth()) + " " + dt.getDate();
}
 
</script> 
 
 
    <div id="lwlb_overlay" style="opacity:0.2;"></div> 
    <script> 
	
    function lwlb_force_stop_date_after_start() {
        var startDate = date_parse_usa_date($('lwlb_starting_date').value);
        var stopDate = date_parse_usa_date($('lwlb_stopping_date').value);
 
        if (startDate >= stopDate) {
            var newStopDate = new Date(startDate.getTime()+Date.one_day);
            $('lwlb_stopping_date').value = date_print_usa_date(newStopDate);
            $('lwlb_date_span_stop').innerHTML = date_print_simplified(newStopDate);
        }
    }
 
    function lwlb_start_date_calendar_popup() {
        if (!g_enable_change_dates) return false;
 
        new CalendarDateSelect($('lwlb_starting_date'), {
            popup_by:$('lwlb_date_span_start'),
            buttons:false,
            default_date_offset:0,
            year_range:[new Date().getFullYear(),new Date().getFullYear()+1],
            valid_date_check:function (dt){ return(dt >= calendar_helper_simple_today()); }
        } );
    }
 
    function lwlb_stop_date_calendar_popup() {
        if (!g_enable_change_dates) return false;
        
        var startDate = date_parse_usa_date($('lwlb_starting_date').value);
        var default_offset = Math.ceil((startDate - new Date())/Date.one_day) + 1;
 
        new CalendarDateSelect($('lwlb_stopping_date'), {
            popup_by:$('lwlb_date_span_stop'),
            buttons:false,
            default_date_offset:default_offset,
            year_range:[new Date().getFullYear(),new Date().getFullYear()+1],
            valid_date_check:function (dt){ return(dt > startDate); }
        } );
    }
 
    function lwlb_booking_service_changed() {
        if ($('lwlb_booking_service').value=="Other") {
            $('lwlb_booking_service_other').show();
        } else {
            $('lwlb_booking_service_other').hide();
        }
 
    }
 
    function lwlb_availability_changed() {
        //alert($('lwlb_availability').value);
        switch ($('lwlb_availability').value) {
        case 'Available':
            $('lwlb_row_per_night').show();
            $('lwlb_row_service').hide();
            $('lwlb_row_value').hide();
            $('lwlb_notes').hide();
            break;
        case 'Not Available':
            $('lwlb_row_per_night').hide();
            $('lwlb_row_service').hide();
            $('lwlb_row_value').hide();
            $('lwlb_notes').show();
            break;
        case 'Booked':
            $('lwlb_row_per_night').hide();
            $('lwlb_row_service').show();
            $('lwlb_row_value').show();
            $('lwlb_notes').show();
            break;
        }
    }
 
 
    function lwlbOpenProfile() {
        var confirmation = $('lwlb_confirmation').value;
        var record = reservationHash.get(confirmation);
        window.open('http://www.airbnb.com/users/show/'+record.guest_id);
    }
 
    function lwlbOpenMessage() {
        var confirmation = $('lwlb_confirmation').value;
        var record = reservationHash.get(confirmation);
        window.open('http://www.airbnb.com/messaging/qt_with/'+record.guest_id);
    }
 
    function lwlbOpenItinerary() {
        var confirmation = $('lwlb_confirmation').value;
        var record = reservationHash.get(confirmation);
        window.open('http://www.airbnb.com/reservation/print_confirmation/?code='+confirmation);
    }
 
    function lwlbOpenAcceptDecline() {
        var confirmation = $('lwlb_confirmation').value;
        var record = reservationHash.get(confirmation);
        window.open('http://www.airbnb.com/reservation/approve?code='+confirmation);
    }
 
 
</script> 
 
<div id="lwlb_calendar2" class="lwlb_lightbox_calendar"><div class="container"><div class="inner"> 
 
<form action="/calendar/modify_calendar?month=7" method="post" onsubmit="before_submit();; new Ajax.Request('/calendar/modify_calendar?month=7', {asynchronous:true, evalScripts:true, parameters:Form.serialize(this)}); return false;"> 
        <input type="hidden" name="data_start_date" id="lwlb_data_start_date" value="" /> 
        <input type="hidden" name="confirmation" id="lwlb_confirmation" value="" /> 
 
 
        <input type="hidden" name="starting_date_original" id="lwlb_starting_date_original" value="" /> 
        <input type="hidden" name="stopping_date_original" id="lwlb_stopping_date_original" value="" /> 
 
        <input type="hidden" name="grouping_uid" id="lwlb_grouping_uid" value="" /> 
        <input type="hidden" name="currency" id="lwlb_currency" value="" /> 
 
        <input type="hidden" name="starting_date" id="lwlb_starting_date" value="" onchange="$('lwlb_date_span_start').innerHTML = date_print_simplified(date_parse_usa_date(this.value)); lwlb_force_stop_date_after_start();" /> 
        <input type="hidden" name="stopping_date" id="lwlb_stopping_date" value="" onchange="$('lwlb_date_span_stop').innerHTML = date_print_simplified(date_parse_usa_date(this.value)); lwlb_force_stop_date_after_start();" /> 
        <input type="hidden" name="hosting_id" id="lwlb_hosting_id" value=""> 
        <input type="hidden" name="visible_row" id="lwlb_visible_row" value=""> 
 
 
 
        <div id="lwlb_reservation_section" style="margin-bottom:10px;"> 
            <div class="header bottom_line"> 
                <div class="header_text" style="float:left;"> 
                    <span id="lwlb_reservation_guest_name">여행객 이름</span> 
                    (<span id="lwlb_reservation_code">코드</span>)
                </div> 
 
                <div class="close"><a href="#" onclick="lwlb_hide_special();return false;"><img src="/images/lightboxes/close_button.gif" /></a></div> 
                <div class="clear"></div> 
            </div> 
 
            <div class="bottom_line"> 
                <div style="float:left;width:60px;"> 
                  <img id="lwlb_reservation_guest_pic" src="" style="width:50px;height:50px;" /> 
                </div> 
                <div style="float:left;width:200px;"> 
                    <div><span class="label">날짜:</span> <span id="lwlb_reservation_dates">날짜</span></div> 
                    <div><span class="label">장소:</span> <span id="lwlb_reservation_hosting_name">날짜</span></div> 
                    <div><span class="label">가격:</span> <span id="lwlb_reservation_base_price">가격</span></div> 
                </div> 
                <div class="clear"></div> 
            </div> 
 
 
 
            <div style=""> 
                <span id="lwlb_reservation_contact"><a id="lwlb_reservation_contact_details_show_link" href="#" onclick="Element.hide('lwlb_reservation_contact_details_show_link');Element.show('lwlb_reservation_contact_details');Element.show('lwlb_reservation_contact_details_hide_link');return(false);" >Contact</a><a id="lwlb_reservation_contact_details_hide_link" href="#" onclick="Element.hide('lwlb_reservation_contact_details_hide_link');Element.show('lwlb_reservation_contact_details_show_link');Element.hide('lwlb_reservation_contact_details');return(false);" style="display:none;">Hide Contact</a> |</span> 
                <a href="#" onclick="lwlbOpenProfile();return false;">프로필</a> |
                <a href="#" onclick="lwlbOpenMessage();return false;">메세지함</a> 
                <span id="lwlb_reservation_itinerary">| <a href="#" onclick="lwlbOpenItinerary();return false;">여행내역</a></span> 
                <span id="lwlb_reservation_accept">| <a href="#" onclick="lwlbOpenAcceptDecline();return false;">수락하기/거절하기</a></span> 
            </div> 
 
            <div id="lwlb_reservation_contact_details" style="display:none;border-top: 1px solid #CBCACA; padding-top:5px; margin-top:5px;"> 
                <span class="label">이메일 주소:</span> <a id="lwlb_reservation_guest_email" href="#">여행객 이메일</a> 
                <span class="label">전화:</span> <span id="lwlb_reservation_guest_phone">여행객 모바일 번호</span> 
            </div> 
        </div> 
 
        <div id="lwlb_normal_section"> 
            <div class="header bottom_line"> 
                <div id="lwlb_hosting_name" class="header_text" style="float:left;">호스팅 이름</div> 
 
                <div class="close"><a href="#" onclick="lwlb_hide_special();return false;"><img src="/images/lightboxes/close_button.gif" /></a></div> 
                <div class="clear"></div> 
            </div> 
 
 
            <div id="lwlb_date_single">일박</div> 
 
            <div id="lwlb_date_span"> 
                <span id="lwlb_date_span_start" class="calendar_link" onclick="lwlb_start_date_calendar_popup();">체크인</span> -
                <span id="lwlb_date_span_stop" class="calendar_link" onclick="lwlb_stop_date_calendar_popup();">체크아웃</span> 
            </div> 
            <br /> 
 
 
            <div style="padding-bottom:5px;"> 
                <table> 
                    <tr> 
                        <td style="width:80px;">이용 가능성</td> 
                        <td><select id="lwlb_availability" name="availability" value="" onchange="lwlb_availability_changed();" ><option value="Available">Available</option> 
<option value="Booked">Booked</option> 
<option value="Not Available">Not Available</option></select></td> 
                    </tr> 
                    <tr id="lwlb_row_per_night"> 
                        <td style="width:80px;">Per night</td> 
                        <td><span class="currency_symbol">xxx</span><input type="text" style="width:35px;" id="lwlb_daily_price" name="daily_price_native" value="" onfocus="" onclick="" /></td> 
                    </tr> 
                    <tr id="lwlb_row_service"> 
                        <td style="width:80px;">Booked Using</td> 
                        <td> 
                            <select id="lwlb_booking_service" name="booking_service" value="" onchange="lwlb_booking_service_changed();" ><option value=""></option> 
<option value="A1 Vacations">A1 Vacations</option> 
<option value="Craigslist">Craigslist</option> 
<option value="Cyber Rentals">Cyber Rentals</option> 
<option value="Great Rentals">Great Rentals</option> 
<option value="Home Away">Home Away</option> 
<option value="Home Away Connect">Home Away Connect</option> 
<option value="Homepage (direct)">Homepage (direct)</option> 
<option value="Offline Source">Offline Source</option> 
<option value="VRBO">VRBO</option> 
<option value="Other">Other</option></select> 
                            <input type="text" style="width:65px;display:none;" id="lwlb_booking_service_other" name="booking_service_other" value="" onfocus="" onclick="" /> 
                        </td> 
                    </tr> 
                    <tr id="lwlb_row_value"> 
                        <td style="width:80px;">Value</td> 
                        <td><span class="currency_symbol">xxx</span><input type="text" style="width:35px;" id="lwlb_value" name="value_native" value="" onfocus="" onclick="" /></td> 
                    </tr> 
                </table> 
            </div> 
        </div> 
 
        <textarea id="lwlb_notes" name="notes" style="width:100%;height:30px;" onclick="if (this.value=='Notes...') { this.value=''; };">참고...</textarea> 
 
        <div style="margin-top:5px;text-align:right;"> 
            <input id="lightbox_submit" name="commit" type="submit" value="Submit" /> 
            <img src="/images/spinner.gif" id="lightbox_spinner" style="display:none;"/> 
              <a href="#" onclick="lwlb_hide_special();return false;">취소</a> 
        </div> 
      
</form></div></div></div> 
 
 
 
 
<div> 
<div class="box"> 
<h2 class="step"><span class="edit_room_icon calendar"></span>Calendar</h2> 
<div id="calendar2" class="middle"> 
  <div id="backdrop"> 
    <a class="colorbox_link rounded" id="open_help_video_link">동영상 길라잡이에서 이용방법을 참고하세요!</a> 
<div class="clear"></div> 
<div> 
<script> 
    var select_range_start = null;
    var select_range_stop = null;
    var select_range_click_count = 0;
</script> 
 
<div class="full_bubble"> 
	<div class="inner"> 
		<div> 
 
			<div class="calendar-header"> 
				<div class="prev-month"><a href="/calendar/single/181683?month=6&amp;year=2011"><img alt="이전의" height="34" src="http://s1.muscache.com/1300304855/images/scheduling/bttn_month_prev.gif" width="35" /></a></div> 
				<div class="next-month"><a href="/calendar/single/181683?month=8&amp;year=2011"><img alt="다음" height="34" src="http://s2.muscache.com/1300304855/images/scheduling/bttn_month_next.gif" width="35" /></a></div> 
				<div class="display-month">7월 2011</div> 
				<div class="clear"></div> 
			</div> 
 
			<div> 
				<div> 
					<div class="day_header">일</div> 
					<div class="day_header">월</div> 
					<div class="day_header">화</div> 
					<div class="day_header">수</div> 
					<div class="day_header">목</div> 
					<div class="day_header">금</div> 
					<div class="day_header">토</div> 
					<div class="clear"></div> 
				</div> 
 
					<div> 
                              <div class="tile disabled" id="tile_14"> 
                                <div class="tile_container"> 
                                  <div class="day">26</div> 
                                  <div class="line_reg" id="square_14"> 
                                      <span class="startcap"></span> 
                                      <span class="content"></span> 
                                      <span class="endcap"></span> 
                                  </div> 
                                </div> 
                              </div> 
                              <div class="tile disabled" id="tile_15"> 
                                <div class="tile_container"> 
                                  <div class="day">27</div> 
                                  <div class="line_reg" id="square_15"> 
                                      <span class="startcap"></span> 
                                      <span class="content"></span> 
                                      <span class="endcap"></span> 
                                  </div> 
                                </div> 
                              </div> 
                              <div class="tile disabled" id="tile_16"> 
                                <div class="tile_container"> 
                                  <div class="day">28</div> 
                                  <div class="line_reg" id="square_16"> 
                                      <span class="startcap"></span> 
                                      <span class="content"></span> 
                                      <span class="endcap"></span> 
                                  </div> 
                                </div> 
                              </div> 
                              <div class="tile disabled" id="tile_17"> 
                                <div class="tile_container"> 
                                  <div class="day">29</div> 
                                  <div class="line_reg" id="square_17"> 
                                      <span class="startcap"></span> 
                                      <span class="content"></span> 
                                      <span class="endcap"></span> 
                                  </div> 
                                </div> 
                              </div> 
                              <div class="tile disabled" id="tile_18"> 
                                <div class="tile_container"> 
                                  <div class="day">30</div> 
                                  <div class="line_reg" id="square_18"> 
                                      <span class="startcap"></span> 
                                      <span class="content"></span> 
                                      <span class="endcap"></span> 
                                  </div> 
                                </div> 
                              </div> 
                              <div class="tile disabled" id="tile_19"> 
                                <div class="tile_container"> 
                                  <div class="day">1</div> 
                                  <div class="line_reg" id="square_19"> 
                                      <span class="startcap"></span> 
                                      <span class="content"></span> 
                                      <span class="endcap"></span> 
                                  </div> 
                                </div> 
                              </div> 
                              <div class="tile disabled" id="tile_20"> 
                                <div class="tile_container"> 
                                  <div class="day">2</div> 
                                  <div class="line_eow" id="square_20"> 
                                      <span class="startcap"></span> 
                                      <span class="content"></span> 
                                      <span class="endcap"></span> 
                                  </div> 
                                </div> 
                              </div> 
						<div class="clear"></div> 
					</div> 
					<div> 
                              <div class="tile disabled" id="tile_21"> 
                                <div class="tile_container"> 
                                  <div class="day">3</div> 
                                  <div class="line_reg" id="square_21"> 
                                      <span class="startcap"></span> 
                                      <span class="content"></span> 
                                      <span class="endcap"></span> 
                                  </div> 
                                </div> 
                              </div> 
                              <div class="tile disabled" id="tile_22"> 
                                <div class="tile_container"> 
                                  <div class="day">4</div> 
                                  <div class="line_reg" id="square_22"> 
                                      <span class="startcap"></span> 
                                      <span class="content"></span> 
                                      <span class="endcap"></span> 
                                  </div> 
                                </div> 
                              </div> 
                              <div class="tile disabled" id="tile_23"> 
                                <div class="tile_container"> 
                                  <div class="day">5</div> 
                                  <div class="line_reg" id="square_23"> 
                                      <span class="startcap"></span> 
                                      <span class="content"></span> 
                                      <span class="endcap"></span> 
                                  </div> 
                                </div> 
                              </div> 
                              <div class="tile disabled" id="tile_24"> 
                                <div class="tile_container"> 
                                  <div class="day">6</div> 
                                  <div class="line_reg" id="square_24"> 
                                      <span class="startcap"></span> 
                                      <span class="content"></span> 
                                      <span class="endcap"></span> 
                                  </div> 
                                </div> 
                              </div> 
                              <div class="tile disabled" id="tile_25"> 
                                <div class="tile_container"> 
                                  <div class="day">7</div> 
                                  <div class="line_reg" id="square_25"> 
                                      <span class="startcap"></span> 
                                      <span class="content"></span> 
                                      <span class="endcap"></span> 
                                  </div> 
                                </div> 
                              </div> 
                              <div class="tile disabled" id="tile_26"> 
                                <div class="tile_container"> 
                                  <div class="day">8</div> 
                                  <div class="line_reg" id="square_26"> 
                                      <span class="startcap"></span> 
                                      <span class="content"></span> 
                                      <span class="endcap"></span> 
                                  </div> 
                                </div> 
                              </div> 
                              <div class="tile disabled" id="tile_27"> 
                                <div class="tile_container"> 
                                  <div class="day">9</div> 
                                  <div class="line_eow" id="square_27"> 
                                      <span class="startcap"></span> 
                                      <span class="content"></span> 
                                      <span class="endcap"></span> 
                                  </div> 
                                </div> 
                              </div> 
						<div class="clear"></div> 
					</div> 
					<div> 
                              <div class="tile disabled" id="tile_28"> 
                                <div class="tile_container"> 
                                  <div class="day">10</div> 
                                  <div class="line_reg" id="square_28"> 
                                      <span class="startcap"></span> 
                                      <span class="content"></span> 
                                      <span class="endcap"></span> 
                                  </div> 
                                </div> 
                              </div> 
                              <div class="tile disabled" id="tile_29"> 
                                <div class="tile_container"> 
                                  <div class="day">11</div> 
                                  <div class="line_reg" id="square_29"> 
                                      <span class="startcap"></span> 
                                      <span class="content"></span> 
                                      <span class="endcap"></span> 
                                  </div> 
                                </div> 
                              </div> 
                              <div class="tile disabled" id="tile_30"> 
                                <div class="tile_container"> 
                                  <div class="day">12</div> 
                                  <div class="line_reg" id="square_30"> 
                                      <span class="startcap"></span> 
                                      <span class="content"></span> 
                                      <span class="endcap"></span> 
                                  </div> 
                                </div> 
                              </div> 
                              <div class="tile disabled" id="tile_31"> 
                                <div class="tile_container"> 
                                  <div class="day">13</div> 
                                  <div class="line_reg" id="square_31"> 
                                      <span class="startcap"></span> 
                                      <span class="content"></span> 
                                      <span class="endcap"></span> 
                                  </div> 
                                </div> 
                              </div> 
                              <div class="tile disabled" id="tile_32"> 
                                <div class="tile_container"> 
                                  <div class="day">14</div> 
                                  <div class="line_reg" id="square_32"> 
                                      <span class="startcap"></span> 
                                      <span class="content"></span> 
                                      <span class="endcap"></span> 
                                  </div> 
                                </div> 
                              </div> 
                              <div class="tile disabled" id="tile_33"> 
                                <div class="tile_container"> 
                                  <div class="day">15</div> 
                                  <div class="line_reg" id="square_33"> 
                                      <span class="startcap"></span> 
                                      <span class="content"></span> 
                                      <span class="endcap"></span> 
                                  </div> 
                                </div> 
                              </div> 
                              <div class="tile disabled" id="tile_34"> 
                                <div class="tile_container"> 
                                  <div class="day">16</div> 
                                  <div class="line_eow" id="square_34"> 
                                      <span class="startcap"></span> 
                                      <span class="content"></span> 
                                      <span class="endcap"></span> 
                                  </div> 
                                </div> 
                              </div> 
						<div class="clear"></div> 
					</div> 
					<div> 
                              <div class="tile disabled" id="tile_35"> 
                                <div class="tile_container"> 
                                  <div class="day">17</div> 
                                  <div class="line_reg" id="square_35"> 
                                      <span class="startcap"></span> 
                                      <span class="content"></span> 
                                      <span class="endcap"></span> 
                                  </div> 
                                </div> 
                              </div> 
                              <div class="tile disabled" id="tile_36"> 
                                <div class="tile_container"> 
                                  <div class="day">18</div> 
                                  <div class="line_reg" id="square_36"> 
                                      <span class="startcap"></span> 
                                      <span class="content"></span> 
                                      <span class="endcap"></span> 
                                  </div> 
                                </div> 
                              </div> 
                              <div class="tile disabled" id="tile_37"> 
                                <div class="tile_container"> 
                                  <div class="day">19</div> 
                                  <div class="line_reg" id="square_37"> 
                                      <span class="startcap"></span> 
                                      <span class="content"></span> 
                                      <span class="endcap"></span> 
                                  </div> 
                                </div> 
                              </div> 
                              <div class="tile disabled" id="tile_38"> 
                                <div class="tile_container"> 
                                  <div class="day">20</div> 
                                  <div class="line_reg" id="square_38"> 
                                      <span class="startcap"></span> 
                                      <span class="content"></span> 
                                      <span class="endcap"></span> 
                                  </div> 
                                </div> 
                              </div> 
                              <div class="tile disabled" id="tile_39"> 
                                <div class="tile_container"> 
                                  <div class="day">21</div> 
                                  <div class="line_reg" id="square_39"> 
                                      <span class="startcap"></span> 
                                      <span class="content"></span> 
                                      <span class="endcap"></span> 
                                  </div> 
                                </div> 
                              </div> 
                              <div class="tile disabled" id="tile_40"> 
                                <div class="tile_container"> 
                                  <div class="day">22</div> 
                                  <div class="line_reg" id="square_40"> 
                                      <span class="startcap"></span> 
                                      <span class="content"></span> 
                                      <span class="endcap"></span> 
                                  </div> 
                                </div> 
                              </div> 
                              <div class="tile disabled" id="tile_41"> 
                                <div class="tile_container"> 
                                  <div class="day">23</div> 
                                  <div class="line_eow" id="square_41"> 
                                      <span class="startcap"></span> 
                                      <span class="content"></span> 
                                      <span class="endcap"></span> 
                                  </div> 
                                </div> 
                              </div> 
						<div class="clear"></div> 
					</div> 
					<div> 
                              <div class="tile disabled" id="tile_42"> 
                                <div class="tile_container"> 
                                  <div class="day">24</div> 
                                  <div class="line_reg" id="square_42"> 
                                      <span class="startcap"></span> 
                                      <span class="content"></span> 
                                      <span class="endcap"></span> 
                                  </div> 
                                </div> 
                              </div> 
                              <div class="tile disabled" id="tile_43"> 
                                <div class="tile_container"> 
                                  <div class="day">25</div> 
                                  <div class="line_reg" id="square_43"> 
                                      <span class="startcap"></span> 
                                      <span class="content"></span> 
                                      <span class="endcap"></span> 
                                  </div> 
                                </div> 
                              </div> 
                                <div class="tile" id="tile_44" onmousedown="click_down(44);" onmouseup="click_up(44);" onmouseover="range_add(44);" onmouseout="range_remove(44);"> 
                                  <div class="tile_container"> 
                                    <div class="day">26</div> 
                                    <div class="line_reg" style="z-index:25;" id="square_44"> 
                                      <span class="startcap"></span> 
                                      <span class="content"></span> 
                                      <span class="endcap"></span> 
                                    </div> 
                                  </div> 
                                </div> 
                                <div class="tile" id="tile_45" onmousedown="click_down(45);" onmouseup="click_up(45);" onmouseover="range_add(45);" onmouseout="range_remove(45);"> 
                                  <div class="tile_container"> 
                                    <div class="day">27</div> 
                                    <div class="line_reg" style="z-index:24;" id="square_45"> 
                                      <span class="startcap"></span> 
                                      <span class="content"></span> 
                                      <span class="endcap"></span> 
                                    </div> 
                                  </div> 
                                </div> 
                                <div class="tile" id="tile_46" onmousedown="click_down(46);" onmouseup="click_up(46);" onmouseover="range_add(46);" onmouseout="range_remove(46);"> 
                                  <div class="tile_container"> 
                                    <div class="day">28</div> 
                                    <div class="line_reg" style="z-index:23;" id="square_46"> 
                                      <span class="startcap"></span> 
                                      <span class="content"></span> 
                                      <span class="endcap"></span> 
                                    </div> 
                                  </div> 
                                </div> 
                                <div class="tile" id="tile_47" onmousedown="click_down(47);" onmouseup="click_up(47);" onmouseover="range_add(47);" onmouseout="range_remove(47);"> 
                                  <div class="tile_container"> 
                                    <div class="day">29</div> 
                                    <div class="line_reg" style="z-index:22;" id="square_47"> 
                                      <span class="startcap"></span> 
                                      <span class="content"></span> 
                                      <span class="endcap"></span> 
                                    </div> 
                                  </div> 
                                </div> 
                                <div class="tile" id="tile_48" onmousedown="click_down(48);" onmouseup="click_up(48);" onmouseover="range_add(48);" onmouseout="range_remove(48);"> 
                                  <div class="tile_container"> 
                                    <div class="day">30</div> 
                                    <div class="line_eow" style="z-index:21;" id="square_48"> 
                                      <span class="startcap"></span> 
                                      <span class="content"></span> 
                                      <span class="endcap"></span> 
                                    </div> 
                                  </div> 
                                </div> 
						<div class="clear"></div> 
					</div> 
					<div> 
                                <div class="tile" id="tile_49" onmousedown="click_down(49);" onmouseup="click_up(49);" onmouseover="range_add(49);" onmouseout="range_remove(49);"> 
                                  <div class="tile_container"> 
                                    <div class="day">31</div> 
                                    <div class="line_reg" style="z-index:20;" id="square_49"> 
                                      <span class="startcap"></span> 
                                      <span class="content"></span> 
                                      <span class="endcap"></span> 
                                    </div> 
                                  </div> 
                                </div> 
                                <div class="tile" id="tile_50" onmousedown="click_down(50);" onmouseup="click_up(50);" onmouseover="range_add(50);" onmouseout="range_remove(50);"> 
                                  <div class="tile_container"> 
                                    <div class="day">1</div> 
                                    <div class="line_reg" style="z-index:19;" id="square_50"> 
                                      <span class="startcap"></span> 
                                      <span class="content"></span> 
                                      <span class="endcap"></span> 
                                    </div> 
                                  </div> 
                                </div> 
                                <div class="tile" id="tile_51" onmousedown="click_down(51);" onmouseup="click_up(51);" onmouseover="range_add(51);" onmouseout="range_remove(51);"> 
                                  <div class="tile_container"> 
                                    <div class="day">2</div> 
                                    <div class="line_reg" style="z-index:18;" id="square_51"> 
                                      <span class="startcap"></span> 
                                      <span class="content"></span> 
                                      <span class="endcap"></span> 
                                    </div> 
                                  </div> 
                                </div> 
                                <div class="tile" id="tile_52" onmousedown="click_down(52);" onmouseup="click_up(52);" onmouseover="range_add(52);" onmouseout="range_remove(52);"> 
                                  <div class="tile_container"> 
                                    <div class="day">3</div> 
                                    <div class="line_reg" style="z-index:17;" id="square_52"> 
                                      <span class="startcap"></span> 
                                      <span class="content"></span> 
                                      <span class="endcap"></span> 
                                    </div> 
                                  </div> 
                                </div> 
                                <div class="tile" id="tile_53" onmousedown="click_down(53);" onmouseup="click_up(53);" onmouseover="range_add(53);" onmouseout="range_remove(53);"> 
                                  <div class="tile_container"> 
                                    <div class="day">4</div> 
                                    <div class="line_reg" style="z-index:16;" id="square_53"> 
                                      <span class="startcap"></span> 
                                      <span class="content"></span> 
                                      <span class="endcap"></span> 
                                    </div> 
                                  </div> 
                                </div> 
                                <div class="tile" id="tile_54" onmousedown="click_down(54);" onmouseup="click_up(54);" onmouseover="range_add(54);" onmouseout="range_remove(54);"> 
                                  <div class="tile_container"> 
                                    <div class="day">5</div> 
                                    <div class="line_reg" style="z-index:15;" id="square_54"> 
                                      <span class="startcap"></span> 
                                      <span class="content"></span> 
                                      <span class="endcap"></span> 
                                    </div> 
                                  </div> 
                                </div> 
                                <div class="tile" id="tile_55" onmousedown="click_down(55);" onmouseup="click_up(55);" onmouseover="range_add(55);" onmouseout="range_remove(55);"> 
                                  <div class="tile_container"> 
                                    <div class="day">6</div> 
                                    <div class="line_eow" style="z-index:14;" id="square_55"> 
                                      <span class="startcap"></span> 
                                      <span class="content"></span> 
                                      <span class="endcap"></span> 
                                    </div> 
                                  </div> 
                                </div> 
						<div class="clear"></div> 
					</div> 
			</div> 
 
		</div> 
	</div> 
</div> 
 
<script> 
function render_grid(start_idx, stop_idx) {
    var prev_square;
 
    // ignore the first and last week of data (since it is padding)
    for(var i = start_idx; i <= stop_idx; i++){
      var square = schedules[0][i];
      var e = jQuery('#square_' + i);
 
      if(e.length == 0 || square === undefined)
        continue;
 
      var text = getSquareText(square, 0);
 
      // append to the square text if we detect that it's blocked out because the host denied a reservation
      if(prev_square != null && ((prev_square.st != square.st && square.st == 2 && square.gid != null) ||
        (prev_square.st == square.st && square.st == 2 && prev_square.gid == null && square.gid != null)))
        text += " (denied booking)";
 
      var span = getSpanBounds(0, i);
 
      var width = span[1] - span[0] + 1;
 
      if(text.length > (width * 8)){
        e.attr('title', text);
        text = text.substr(0, (width * 16) - 4) + "...";
      }
 
      e.find('span.content').html(text);
      var baseClass = e.attr('class').split(' ')[0];
      e.attr('class', baseClass + " " + square.cl + " " + square.sty);
 
      prev_square = square;
    }
}
render_grid(14, 56);
</script> 
 
</div> 
 
<div class="clear"></div> 
<div class="privacy"> 
  달력에 표시되는 개인정보는 다른 회원들에게는 표시되지 않으며, 숙박가능 상황만 표시됩니다.
</div> 
</div><!-- backdrop --> 
</div><!-- calendar2 --> 
</div> 
</div> 
 
<div class="calsync box"> 
<h2><span class="edit_room_icon calsync"></span>달력 동기화하기</h2> 
<div class="padded-text"> 
  <!-- sync status --> 
    <div class="banner"> 
      <span class="new">Use our <strong><a href="/calendar_mappings">calendar import tool</a></strong> to import calendar data from <strong>VRBO</strong>, <strong>Google Calendar</strong>, <strong>Yahoo! Calendar</strong>, and others.</span> 
    </div> 
</div> 
</div> 
<!-- export instructions --> 
<div class="box"> 
<h2><span class="edit_room_icon calexport"></span>Export Calendar</h2> 
  <div class="padded-text"> 
    You can also <strong>export the Airbnb calendar data</strong> into calendars that support the <img alt="iCal" src="/images/icons/ical_icon.png"> format. Copy and paste this link into your calendar: 
  <div class="ical_link"> 
    <a href="http://www.airbnb.com/calendar/ical/181683.ics?s=46260947875f7497f6d5ea3866653e87">http://www.airbnb.com/calendar/ical/181683.ics?s=46260947875f7497f6d5ea3866653e87</a> 
  </div> 
 
  If you can't figure out where to paste the iCal link, calendar-specific instructions can be found here: <a href="http://www.google.com/support/calendar/bin/answer.py?hl=en&answer=37118">Google Calendar</a> or <a href="http://help.yahoo.com/l/us/yahoo/calendar/yahoocalendar/importexport/importexport-01.html">Yahoo! Calendar</a> 
</div> 
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
	<script type="text/javascript" charset="utf-8">NREUMQ.push(["nrf2","beacon-1.newrelic.com","fc09a36731",2237,"dlwMQktaWAgBEB1RUllWDFJYRxsXDQxVXlY=",0,87])</script></body> 
</html> 
 