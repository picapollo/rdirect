<?php
	$this->load->view('header/page2', $header);
	$this->load->view('top_menu', array('starred'=>$starred));
?>
 
    <div id="v3_search" class="list_view rounded_more condensed_header_view"> 
      <div id="search_header" class="rounded_top"></div> 
    <div id="search_params"> 
        <form id="search_form" onsubmit="clean_up_and_submit_search_request(); return false;"> 
        <label for="location" class="inner_text" id="location_label" style="display:none;">도시, 주소, zip code</label> 
        <input type="text" class="location rounded_left" autocomplete="off" id="location" name="location" /> 
        <div id="search_inputs"> 
            <div class="dates_section"> 
                <div class="heading">체크인</div> 
 
                <input id="checkin" class="checkin date active" name="checkin" autocomplete="off" /> 
            </div> 
 
            <div class="dates_section"> 
                <div class="heading">체크아웃</div> 
 
                <input id="checkout" class="checkout date active" name="checkout" autocomplete="off" /> 
            </div> 
 
            <div class="guests_section"> 
                <div class="heading">숙박인원</div> 
                <select id="number_of_guests" name="number_of_guests"><option value="1">1</option> 
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
        <input class="v3_button v3_fixed_width search_v3_submit_location" type="submit" id="submit_location" name="submit_location" value="검색"/> 
        <div id="search_magnifying_glass"></div> 
        <input type="hidden" name="page" id="page" value="1" /> 
        </form> 
        <div id="search_type_toggle"> 
            <div class="search_type_option rounded_left search_type_option_active" id="search_type_list">객실리스트</div> 
            <div class="search_type_option" id="search_type_photo">사진</div> 
            <div class="search_type_option rounded_right" id="search_type_map">지도</div> 
        </div> 
    </div> 
 
    <div id="standby_action_area" style="display:none;"> 
        <div> 
            <b><a id="standby_link" href="/messaging/standby" target="_blank">급하게 객실을 찾고 계신가요? 스탠바이 리스트에 등록하세요! <i>pronto</i>? 스탠바이 리스트에 등록하기 !</a></b> 
        </div> 
    </div> 
 
    <div id="search_body"> 
        <div id="results_header"> 
            <div id="results_sort"> 
                <label for="sort" style="font-weight:bold;">로 분류하기:</label> 
                <select id="sort" name="sort"><option value="0">추천</option> 
<option value="2">거리</option> 
<option value="4">낮은가격 - 높은가격</option> 
<option value="5">높은가격 - 낮은가격</option> 
<option value="7">최신의</option></select> 
                <span id="results_count_top"></span> 
            </div> 
            <div id="results_save"><a id="share_results_link">결과 공유하기</a></div> 
            <div style="display: none;"> 
              <div id="share_lightbox"> 
                  <h4 id="share_lightbox_header">결과 공유하기</h4> 
                  <div id="share_lightbox_share_url_area"> 
                      <span id="link_icon"></span> 
                      <input type="text" id="share_url" name="share_url" /> 
                  </div> 
              </div> 
            </div> 
        </div> 
 
        <div id="results_filters"> 
            <div id="filters_text">검색조건:</div> 
            <ul id="applied_filters"></ul> 
        </div> 
 
        <ul id="results"> 
        </ul> <!-- results --> 
        <div id="results_footer" style="display:none;"> 
            <div class="results_count"></div> 
            <div id="results_pagination"></div> 
        </div> <!-- results_footer --> 
 
			<div id="list_view_loading" class="rounded_more" style="display:none;"> 
				<img src="/images/page2/v3/page2_spinner.gif" style="padding-right: 12px; vertical-align: middle;" height="42" width="42" alt="" /> 
				로딩중...
			</div> 
		</div> <!-- search_body --> 
 
	<div id="search_filters_wrapper" class="rounded_bottom_right"> 
		<div id="search_filters"> 
			<!-- this partial is wrapped in a div class='search_filters' --> 
<div id="map_options"><input type="checkbox" name="redo_search_in_map" id="redo_search_in_map" /><label for="redo_search_in_map">지도 이동시 재검색하기</label></div> 
 
<div id="map_wrapper"> 
    <div id="search_map"></div> 
    <div id="map_view_loading" class="rounded_more" style="display:none;"><img src="/images/page2/v3/page2_spinner.gif" style="display:block; float:left; padding:0 12px 0 0;"/>Loading...</div> 
    <div id="map_message" style="display:none;"></div> 
    <div id="first_time_map_question" style="display:none;"> 
        <div id="first_time_map_question_content" class="rounded"> 
            <div id="first_time_map_question_arrow"></div> 
            <p>이 박스를 체크하면 지도 이동에 따라 검색결과가 업데이트됩니다.</p> 
            <a id="redo_search_in_map_link_on" href="javascript:void(0);">네 감사합니다.</a> 
            <a id="redo_search_in_map_link_off" href="javascript:void(0);">아니에요 괜찮습니다.</a> 
        </div> 
    </div> 
</div> 
<ul class="collapsable_filters"> 
    <li class="search_filter" id="room_type_container"> 
        <a class="filter_toggle"></a> 
        <a class="filter_header" href="javascript:void(0);">객실 타입</a> 
        <ul class="search_filter_content"></ul> 
    </li> 
    
    <li class="search_filter" id="price_container"> 
        <a class="filter_toggle"></a> 
        <a class="filter_header" href="javascript:void(0);">가격</a> 
        <div class="search_filter_content"> 
            <ul id="slider_values"> 
                <li id="slider_user_min"></li> 
                <li id="slider_user_max"></li> 
            </ul> 
            <div id="slider-range"></div> 
        </div> 
    </li> 
 
	<li class="search_filter" id="social_connections_container"> 
		<a class="filter_toggle"></a> 
		<a class="filter_header" href="javascript:void(0);"> 
			커넥션
		</a> 
		<ul class="search_filter_content"></ul> 
	</li> 
 
    <li class="search_filter" id="neighborhood_container"> 
        <a class="filter_toggle"></a> 
        <a class="filter_header" href="javascript:void(0);">주변지역</a> 
        <ul class="search_filter_content"></ul> 
    </li> 
 
    
    <li class="search_filter closed" id="amenities_container"> 
        <a class="filter_toggle"></a> 
        <a class="filter_header" href="javascript:void(0);">편의시설</a> 
        <ul class="search_filter_content"></ul> 
    </li> 
    
    <li class="search_filter closed" id="keywords_container"> 
        <a class="filter_toggle"></a> 
        <a class="filter_header" href="javascript:void(0);">키워드로 검색</a> 
        <ul class="search_filter_content"> 
            <li> 
                <label for="keywords" class="inner_text" id="keywords_label" style="display:none;">키워드 입력</label> 
                <input type="text" name="keywords" id="keywords" /> 
 
                <a id="submit_keyword" onclick="clean_up_and_submit_search_request(); return false;" href="#"></a> 
            </li> 
        </ul> 
    </li> 
    
</ul> 
 
<div id="small_map_loading" class="opacity_80 rounded" style="display:none; border:2px solid #989898; -moz-box-shadow:0 0 2px #A8A8A8; -webkit-box-shadow:0 0 2px #A8A8A8;"><img src="/images/page2/v3/page2_spinner.gif" style="width:16px; height:16px; display:block; float:left; padding:0 4px 0 0;"/>로딩중...</div> 
 
<div id="search_filters_toggle" class="search_filters_toggle_on rounded_left"></div> 
 
		</div> 
	</div> 
</div> <!-- v3_search --> 
 
<a id="cc_attribution_link" style="display:none;" target="_blank" rel="nofollow"></a> 
 
<a id="page2_inline_slideshow" href="#" style="display:none;"> 
    <img id="page2_inline_slideshow_img" src="/images/uiwidgets/transparent1x1.gif" /> 
</a> 
 
<img id="page2_v3_tp" src="" width=1 height=1 /> 
 
<ul id="blank_state_content" style="display:none;"> 
    <li id="blank_state"> 
        <div id="blank_state_molecule"></div> 
        <div id="blank_state_text"> 
          <h3>검색조건에 맞는 결과를 찾을 수 없습니다.</h3> 
          <p>검색조건 한두개를 삭제하거나 다른 도시를 검색해 보시기 바랍니다.</p> 
        </div> 
    </li> 
</ul> 
 
<style type="text/css"> 
.ac_results { border-color:#a8a8a8; border-style:solid; border-width:1px 2px 2px; margin-left:1px; }
</style> 
 
<script type="text/x-jqote-template" id="badge_template"> 
    <![CDATA[
        <li class="badge badge_type_<*= this.badge_type *>">
            <span class="badge_image">
                <span class="badge_text"><*= this.badge_text *></span>
            </span>
            <span class="badge_name"><*= this.badge_name *></span>
        </li>
    ]]>
</script> 
 
<script type="text/x-jqote-template" id="list_view_item_template"> 
    <![CDATA[
        <li id="room_<*= this.hosting_id *>" class="search_result">
            <div class="pop_image_small">
                <div class="map_number"><*= this.result_number *></div>
                <a href="/rooms/<*= this.hosting_id *>" class="image_link" title="<*= this.hosting_name *>">
                    <* if (this.hasVideo) { *><div class="has_video"></div><* } *>
                    <img alt="<*= this.hosting_name *>" class="search_thumbnail" width="<*= this.hosting_thumbnail_width *>" height="<*= this.hosting_thumbnail_height *>" src="<*= this.hosting_thumbnail_url *>" title="<*= this.hosting_name *>" />
                </a>
            </div>
 
            <div class="user_thumb">
                <a href="/users/show/<*= this.user_id *>" class="has-mini-profile" data-user_id="<*= this.user_id *>"><img alt="<*= this.user_name *>" height="36" src="<*= this.user_thumbnail_url *>" width="36" /></a>
            </div>
 
            <div class="room_details">
                <h2 class="room_title">
                  <a class="name" href="/rooms/<*= this.hosting_id *>"><*= this.hosting_name *></a>
                  <a href="#" id="star_<*= this.hosting_id *>" title="Add this listing as a 'favorite'" class="star_icon_container"><div class="star_icon"></div></a>
                  <* if (this.isNewHosting) { *>
	                <span class="new_icon"></span><span class="new_icon new_icon_bg"></span>
	              <* } *>
                </h2>
                <* if (this.distance) { *>
                    <p class="address_max_width"><*= this.address *></p>
                    <p class="distance"><*= this.distance *> <*= Translations.distance_away *></p>
                <* } else { *>
                    <p class="address"><*= this.address *></p>
                <* } *>
				<ul class="reputation"></ul>
            </div>
            <* if (this.staggered) { *>
              <div class="price monthly">
            <* } else { *>
              <div class="price">
            <* } *>
                <div class="price_data">
                    <sup class="currency_if_required"><*= AirbnbSearch.currencySymbolRight *></sup>
                    <div class='currency_with_sup'><sup><*= AirbnbSearch.currencySymbolLeft *></sup><*= this.price *></div>
                </div>
                <div class="price_modifier">
	                <* if (this.staggered) { *>
						1개월당
	                <* } else { *>
	                    1박당
	                <* } *>
                </div>
            </div>
 
			<* if (this.hasInstantBook) { *>
				<a class="instant_book_icon_p2" href="/rooms/<*= this.hosting_id *>"><*= Translations.instant_book *><span class="sm_instant_book_arrow"></span></a>
			<* } *>
 
			<* if (this.connections.length > 0) { *>
			<div class="room-connections-wrapper">
				<span class="room-connections-arrow"></span>
				<div class="room-connections">
					<ul>
						<* for (var k = 0; k < Math.min(this.connections.length, 3); k++) { *>
						<li>
							<img height="28" width="28" alt="" src="<*= this.connections[k].pic_url_small *>" />
							<div class="room-connections-title">
								<div class="room-connections-title-outer">
									<div class="room-connections-title-inner">
										<*= this.connections[k].caption *>
									</div>
								</div>
							</div>
						</li>
						<* } *>
					</ul>
				</div>
			</div>
			<* } *>
        </li>
    ]]>
</script> 
 
<script type="text/x-jqote-template" id="applied_filters_template"> 
    <![CDATA[
        <li id="applied_filter_<*= this.filter_id *>"><span class="af_text"><*= this.filter_display_name *></span><a class="filter_x_container"><span class="filter_x"></span></a></li>
    ]]>
</script> 
 
<script type="text/x-jqote-template" id="list_view_airtv_template"> 
    <![CDATA[
        <div id="airtv_promo">
            <img src="/images/page2/v3/airtv_promo_pic.jpg" />
            <h2><*= this.airtv_headline *></h2>
            <h3><*= this.airtv_description *> <b>지금 보기!</b></h3>
        </div>
    ]]>
</script> 
 
 
 
<div style="display: none"> 
  <div id="filters_lightbox"> 
      <ul id="filters_lightbox_nav"> 
          <li class="filters_lightbox_nav_element" id="lightbox_nav_room_type"><a href="javascript:void(0);">객실</a></li> 
          <li class="filters_lightbox_nav_element" id="lightbox_nav_neighborhood"><a href="javascript:void(0);">주변지역</a></li> 
          <li class="filters_lightbox_nav_element" id="lightbox_nav_amenities"><a href="javascript:void(0);">편의시설</a></li> 
          <li class="filters_lightbox_nav_element" id="lightbox_nav_host"><a href="javascript:void(0);">주인장</a></li> 
      </ul> 
 
      <ul id="lightbox_filters"> 
          <li class="lightbox_filter_container" id="lightbox_container_room_type" style="display:none;"> 
              <div class="lightbox_filters_left_column"> 
                  <h3>객실 종류</h3> 
                  <ul id="lightbox_filter_content_room_type" class="search_filter_content"></ul> 
 
                  <h3>규모</h3> 
                  <ul id="lightbox_filter_content_size" class="search_filter_content"> 
                      <li> 
                          <label for="min_bedrooms">최소 침실 수</label> 
                          <select class="dropdown" id="min_bedrooms" name="min_bedrooms"><option value=""></option> 
<option value="1">1</option> 
<option value="2">2</option> 
<option value="3">3</option> 
<option value="4">4</option> 
<option value="5">5</option> 
<option value="6">6</option> 
<option value="7">7</option> 
<option value="8">8</option> 
<option value="9">9</option> 
<option value="10">10</option></select> 
                      </li> 
                      <li> 
                          <label for="min_bathrooms">최소 화장실 수</label> 
                          <select class="dropdown" id="min_bathrooms" name="min_bathrooms"><option value=""></option> 
<option value="1">1</option> 
<option value="2">2</option> 
<option value="3">3</option> 
<option value="4">4</option> 
<option value="5">5</option> 
<option value="6">6</option> 
<option value="7">7</option> 
<option value="8">8</option> 
<option value="9">9</option> 
<option value="10">10</option></select> 
                      </li> 
                      <li> 
                          <label for="min_beds">최소 침대 수</label> 
                          <select class="dropdown" id="min_beds" name="min_beds"><option value=""></option> 
<option value="1">1</option> 
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
                      </li> 
                  </ul> 
              </div> 
              <div class="lightbox_filters_right_column"> 
                  <h3>객실 종류</h3> 
                  <ul id="lightbox_filter_content_property_type_id" class="search_filter_content"></ul> 
              </div> 
          </li> 
 
          <li class="lightbox_filter_container" id="lightbox_container_neighborhood" style="display:none;"> 
              <ul class="search_filter_content"></ul> 
          </li> 
 
          <li class="lightbox_filter_container" id="lightbox_container_amenities" style="display:none;"> 
              <ul class="search_filter_content"></ul> 
          </li> 
 
          <li class="lightbox_filter_container" id="lightbox_container_host" style="display:none;"> 
              <div class="lightbox_filters_left_column"> 
                  <!--
                  <h3>프로필 작성완료</h3>
                  <ul id="lightbox_filter_content_profile_completion" class="search_filter_content"></ul>
                  --> 
 
                  <h3>의사소통 가능한 언어</h3> 
                  <ul id="lightbox_filter_content_languages" class="search_filter_content"></ul> 
              </div> 
              <div class="lightbox_filters_right_column"> 
                  <!--
                  <h3>나의 그룹</h3>
                  <ul id="lightbox_filter_content_group_ids" class="search_filter_content"></ul>
                  --> 
              </div> 
 
              <ul class="search_filter_content"></ul> 
          </li> 
 
 
      </ul><!-- lightbox_filters --> 
 
      <div id="lightbox_filter_action_area" class="rounded_bottom"> 
          <a href="javascript:void(0);" onclick="SearchFilters.closeFiltersLightbox();">취소</a> 
 
          <input id="lightbox_search_button" class="v3_button v3_fixed_width search_v3_submit_location search_v3_submit_alternative" type="submit" value="검색"/> 
      </div> 
  </div><!-- filters_lightbox --> 
</div> 
 
 
 
 
 
<!--[if lt IE 8]> 
<style type="text/css">
    .badge{width:36px;}
</style>
<![endif]--> 
 
<!--[if lt IE 9]> 
<style type="text/css">
    .map_view #results_filters{border-bottom:1px solid #a8a8a8;}
</style>
<![endif]--> 
 
 
<?php $this->load->view('footer', array('no_closing', true));?>
 
 
	<div id="fb-root"></div> 

	<script type="text/javascript" src="http://maps.google.com/maps/api/js?v=3.5&sensor=false"></script> 
 
 
	<script type="text/javascript"> 
 
			window.fbAsyncInit = function() {
				FB.init({
					appId  : '<?=$this->config->item('facebook_app_id')?>',
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
				
				jQuery(document).trigger('fbInit');
			};
 
			(function() {
				var e = document.createElement('script');
				e.src = document.location.protocol + '//connect.facebook.net/<?=CURRENT_LANGUAGE_CODE?>/all.js';
				e.async = true;
				document.getElementById('fb-root').appendChild(e);
			}());
 
 
		
if ((navigator.userAgent.indexOf('iPhone') == -1) && (navigator.userAgent.indexOf('iPod') == -1) && (navigator.userAgent.indexOf('iPad') == -1)) {
    jQuery(window).load(function() {
        LazyLoad.js([
			"<?=JS_DIR?>/jquery.autocomplete_custom.pack.js",
			"<?=JS_DIR?>/ko_autocomplete_data.js"],
			function() {
            	jQuery("#location").autocomplete(autocomplete_terms, {
	                minChars: 1, width: 322, max:20, matchContains: false, autoFill: true,
	                formatItem: function(row, i, max) {
	                    //to show counts, uncomment
	                    //return row.k + " <span class='autocomplete_extra_info'>(" + row.c + ")</span>";
	                    return Airbnb.Utils.decode(row.k);
	                },
	                formatMatch: function(row, i, max) {
	                    return Airbnb.Utils.decode(row.k);
	                },
	                formatResult: function(row) {
	                    return Airbnb.Utils.decode(row.k);
	                }
	            });
	        }
		);
    });
}
    jQuery(document).ready(function(){
        Airbnb.Bookmarks.starredIds = [157375,16457];
 
        AirbnbSearch.$.bind('finishedrendering', function(){ 
          Airbnb.Bookmarks.initializeStarIcons(function(e, isStarred){ 
            // hide the listing result from the set of search results when the result is unstarred
            if(!isStarred && AirbnbSearch.isViewingStarred){
              if(AirbnbSearch.currentViewType == 'list')
                $('#room_' + $(e).data('hosting_id')).slideUp(500);
              else if(AirbnbSearch.currentViewType == 'photo')
                $('#room_' + $(e).data('hosting_id')).fadeOut(500);
            }
          }) 
        });
 
            SearchFilters.amenities.a_11 = ["Smoking Allowed", true];
            SearchFilters.amenities.a_12 = ["Pets Allowed", false];
            SearchFilters.amenities.a_1 = ["TV", false];
            SearchFilters.amenities.a_2 = ["Cable TV", false];
            SearchFilters.amenities.a_3 = ["Internet", false];
            SearchFilters.amenities.a_4 = ["Wireless Internet", true];
            SearchFilters.amenities.a_5 = ["Air Conditioning", false];
            SearchFilters.amenities.a_30 = ["Heating", false];
            SearchFilters.amenities.a_21 = ["Elevator in Building", false];
            SearchFilters.amenities.a_6 = ["Handicap Accessible", false];
            SearchFilters.amenities.a_7 = ["Pool", false];
            SearchFilters.amenities.a_8 = ["Kitchen", false];
            SearchFilters.amenities.a_9 = ["Parking Included", false];
            SearchFilters.amenities.a_13 = ["Washer / Dryer", false];
            SearchFilters.amenities.a_14 = ["Doorman", false];
            SearchFilters.amenities.a_15 = ["Gym", false];
            SearchFilters.amenities.a_25 = ["Hot Tub", false];
            SearchFilters.amenities.a_27 = ["Indoor Fireplace", false];
            SearchFilters.amenities.a_28 = ["Buzzer/Wireless Intercom", false];
            SearchFilters.amenities.a_16 = ["Breakfast", false];
            SearchFilters.amenities.a_31 = ["Family/Kid Friendly", false];
            SearchFilters.amenities.a_32 = ["Suitable for Events", false];
 
        AirbnbSearch.currencySymbolLeft = '$';
        AirbnbSearch.currencySymbolRight = "";
        SearchFilters.minPrice = 10;
        SearchFilters.maxPrice = 300;
        SearchFilters.minPriceMonthly = 150;
        SearchFilters.maxPriceMonthly = 5000;
 
        var options = {};
 
        //Some More Testing needs to be done with this logic - there are still edge cases
        //here, we add ability to hit the back button when the user goes from (page2 saved search)->page3->(browser back button)
        if (AirbnbSearch.searchHasBeenModified()){
            options = {"location":"\uc11c\uc6b8, \ud55c\uad6d","number_of_guests":"1","action":"index","checkin":"yy/mm/dd","guests":"1","checkout":"yy/mm/dd","submit_location":"\uac80\uc0c9","controller":"search"};
        } else {
            options = {"location":"\uc11c\uc6b8, \ud55c\uad6d","number_of_guests":"1","action":"index","checkin":"yy/mm/dd","guests":"1","checkout":"yy/mm/dd","submit_location":"\uac80\uc0c9","controller":"search"};
        }
 
 
 
          AirbnbSearch.isViewingStarred = false;
       
 
        if(options.search_view) {
            AirbnbSearch.forcedViewType = options.search_view;
        }
 
 
 
 
 
 
        //keep translations first
        Translations.clear_dates = "\ub0a0\uc9dc \uc120\ud0dd \uc9c0\uc6b0\uae30";
        Translations.entire_place = "\uc9d1 \uc804\uccb4";
        Translations.friend = "\uce5c\uad6c";
        Translations.friends = "\uce5c\uad6c";
        Translations.loading = "\ub85c\ub529\uc911";
        Translations.neighborhoods = "\ub3d9\ub124";
        Translations.private_room = "\ud504\ub77c\uc774\ube57\ub8f8";
        Translations.review = "\ud6c4\uae30";
        Translations.reviews = "\ud6c4\uae30";
        Translations.superhost = "\uc288\ud37c\uc8fc\uc778\uc7a5";
        Translations.shared_room = "\uc250\uc5b4\ub4dc\ub8f8";
        Translations.today = "\uc624\ub298";
        Translations.you_are_here = "\ud604\uc7ac \uc704\uce58";
        Translations.a_friend = "\uce5c\uad6c";
        Translations.distance_away = "\ub5a8\uc5b4\uc9d0";
        Translations.instant_book = "\uc989\uc2dc \uc608\uc57d";
        Translations.show_more = "\ub354 \ubcf4\uae30...";
        Translations.learn_more = "\ub354 \uc54c\uc544\ubcf4\uae30";
        Translations.social_connections = "\uc18c\uc15c\ucee4\ub125\uc158";
 
        //these are generally for applied filter labels
        Translations.amenities = "\ud3b8\uc758\uc2dc\uc124";
        Translations.room_type = "\uac1d\uc2e4 \uc885\ub958";
        Translations.price = "\uac00\uaca9";
        Translations.keywords = "\ud0a4\uc6cc\ub4dc\ub85c \uac80\uc0c9";
        Translations.property_type = "\uac1d\uc2e4 \uc885\ub958";
        Translations.bedrooms = "\uce68\uc2e4 \uc218";
        Translations.bathrooms = "\ud654\uc7a5\uc2e4";
        Translations.beds = "\uce68\ub300";
        Translations.languages = "\uc5b8\uc5b4";
        Translations.collection = "\ud14c\ub9c8\ubcc4 \ubaa8\uc74c";
 
        //zoom in to see more properties message in map view
        Translations.redo_search_in_map_tip = "\"\uc9c0\ub3c4 \uc774\ub3d9\uc2dc \uc7ac\uac80\uc0c9\ud558\uae30\" \ubc15\uc2a4\ub97c \uccb4\ud06c\ud558\uc154\uc57c \uc9c0\ub3c4 \uc774\ub3d9 \uc2dc \uac80\uc0c9\uacb0\uacfc\uac00 \uc5c5\ub370\uc774\ud2b8\ub429\ub2c8\ub2e4.";
        Translations.zoom_in_to_see_more_properties = "\ub354 \ub9ce\uc740 \uac1d\uc2e4\uc744 \ubcf4\ub824\uba74 \uc9c0\ub3c4\ub97c \ud655\ub300\ud558\uc138\uc694.";
 
        //when map is zoomed in too far
        Translations.your_search_was_too_specific = "\uac80\uc0c9\uc870\uac74\uc5d0 \ub9de\ub294 \uacb0\uacfc\ub97c \ucc3e\uc744 \uc218 \uc5c6\uc2b5\ub2c8\ub2e4.";
        Translations.we_suggest_unchecking_a_couple_filters = "\uac80\uc0c9\uc870\uac74 \ud55c\ub450\uac1c \uc0ad\uc81c, \uc9c0\ub3c4\ub97c \ud655\ub300, \ub2e4\ub978 \ub3c4\uc2dc\ub97c \uac80\uc0c9\uc744 \uc2dc\ub3c4\ud574 \ubcf4\uc2dc\uae30 \ubc14\ub78d\ub2c8\ub2e4.";
 
        //Tracking Pixel
        //run after localization
        TrackingPixel.params.uuid = "5knh7fchub";
        TrackingPixel.params.user = 738217;
        TrackingPixel.params.af = "";
        TrackingPixel.params.c = "";
        TrackingPixel.params.pg = '2';
 
        AirbnbSearch.init(options);
 
    });
 
		jQuery(document).ready(function() {
			Airbnb.init({userLoggedIn: <?=$this->tank_auth->is_logged_in()?'true':'false'?>});
		});
 
		Airbnb.FACEBOOK_PERMS = "<?=$this->config->item('facebook_scope')?>";
	</script>  
</html> 