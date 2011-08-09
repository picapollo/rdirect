<?php
	$this->load->view('header/page3', $header);
	$this->load->view('top_menu', array('starred'=>$this->data['starred']));
?>

<!-- assets -->
	
<?php if($is_owner): ?>
	<?php if($this->input->get('new_hosting')): ?>
	<div id="new_hosting_actions" class="rounded_most">
		<h2>
		거의 다 되었어요! <?=anchor('rooms/'.$room->id.'/edit', '객실정보 입력 완료하기');?><br><span class="smaller">다음 페이지로 가시면 사진 업로드, 숙박요금 조정, 시설 표시, 객실 설명 수정 등을 하실 수 있습니다.</span>
		</h2>
    </div>
    <?php elseif (false): ?>
    <div id="new_hosting_actions" class="rounded_most">
		<div style="overflow: hidden; display: block; width: 960px; text-align:center;">
			<h2>거의 다 되었어요! <?=anchor('rooms/'.$room->id.'/edit?section=photos', '객실 등록하기까지 얼마 안남았습니다.');?></h2>
			<br />
			<div style="width: 360px; margin: 0 auto; display:block; overflow:hidden;">
				<?=anchor('rooms/'.$room->id.'/edit?section=photos', '객실 활성화하기', array('class'=>'v3_button', 'style'=>'width:300px;'))?>
			</div>
		</div>
	</div>
    <?php else: ?>
    <div id="new_hosting_actions" class="rounded_most">
			<h2>
				<?=anchor('rooms/'.$room->id.'/edit', '객실정보 수정');?> <span class="smaller">사진 올리기, 가격 바꾸기, 상세정보 수정하기</span>
			</h2>
			<hr class="toolbar_separator" />
			<h2>
				<?=anchor('calendar/single/'.$room->id, '달력')?>
				<span class="smaller">
                숙박가능여부 바꾸기 "<?=$room->name?>"
                </span>
			</h2>
			<hr class="toolbar_separator" />
			<h2 style="font-size:24px;">
				<?php //TODO if( ! has_photo): ?>
				<img alt="Pink_star_on" src="<?=IMG_DIR?>/icons/pink_star_on.png" /> <?=anchor('users/edit/'.$this->tank_auth->get_user_id(), '본인의 프로필 사진을 등록해 주세요')?> <span class="smaller"> 더 많은 예약을 받을 수 있을 것입니다.</span>
				<?php //endif; ?>
			</h2>
    </div>
	<?php endif;?>
<?php endif; ?>
          

    <div id="rooms" class="rounded_top">
        <div id="room">
            <script>
			function translate(target_lang) {
				jQuery(".trans").each(function(i, c) {
					jQuery.getJSON(
						"https://ajax.googleapis.com/ajax/services/language/translate?key=ABQIAAAAa2Xs-T5zUjU89HwI6ooVuxTkVixRUD-Hiz0ASbLT_MA6wjuv0xROWzG0QuXewGYauEy-p8sBjnSOIw&callback=?&v=1.0&langpair=%7C" +
							target_lang +
							"&q=" +
							c.innerHTML,
						function(data) {
							if (data && data.responseData && data.responseData.translatedText) {
								c.innerHTML = data.responseData.translatedText;
							}
						}
					);
				});
			}
			</script>

<div id="the_roof">
    <div id="room_snapshot">
        <h1><?=$room->name?> <a href="#" id="star_<?=$room->id?>" title="Add this listing as a 'favorite'" class="star_icon_container"><div class="star_icon"></div></a>
</h1>
        <h3>
            <?=$room->property_type // TODO: lang($room->property_type)?>
            - <?=$room->room_type?>
            <span class="middot">&middot;</span>
            <span id="display_address" class="no_float"><?=$room->address?></span>
        </h3>
    </div>
	<div id="action_buttons">
		<ul class="button">
            <li class="review_count">
              <a class="icon" onclick="jQuery('#reputation_sub_nav').effect('highlight', {}, 1000);" href="#reputation-mark">0</a>
              <p>후기</p>
            </li>
          <li id="translate" class="translate">
            <a class="icon" onclick="translate('<?=CURRENT_LANGUAGE?>');return false;" href="javascript:void(0);"><img alt="<?=ucfirst(CURRENT_LANGUAGE)?>" src="<?php echo IMG_DIR.'/icons/language/'.CURRENT_LANGUAGE.'.gif';?>" /> </a>
            <p>
              <a onclick="translate('<?=CURRENT_LANGUAGE?>');return false;" href="javascript:void(0);">번역</a>
            </p>
          </li>
        </ul>
    </div>
    <div class="clear"></div>
</div>


            <div id="left_column">
                <div id="main_content" class="box">
    <div class="top">&nbsp;</div>
    <div class="middle">

        <ul id="main_content_sub_nav" class="rooms_sub_nav">
            <li onclick="select_tab('main', 'photos_div', jQuery(this)); initPhotoGallery();" class="main_link selected"><a href="#photos">사진</a></li>
            <li onclick="select_tab('main', 'maps_div', jQuery(this)); load_map_wrapper('load_google_map');" class="main_link"><a href="#maps">지도</a><a href="#guidebook" style="display:none;"></a></li>
            <li onclick="select_tab('main', 'calendar_div', jQuery(this)); load_initial_month();" class="main_link"><a href="#calendar">달력</a></li>

            <li id="content_flag">
              
<form action="<?=site_url('user_flags')?>" class="new_user_flag" id="new_user_flag" method="post"><div class="flag-container" style="display: none;">
  <div class="click-target clearfix">
    <span class="expand"></span><h3>Report this message privately</h3><span class="status"></span>
  </div>
  <ul>
      <li><a href="#" data-reason-id="Inappropriate/offensive content">Inappropriate/offensive content</a>
      <li><a href="#" data-reason-id="Misleading/suspicious information">의심스러운/잘못된 정보</a>
      <li><a href="#" data-reason-id="Spam">Spam</a>
      <li><a href="#" data-reason-id="Other">기타</a>
  </ul>
  <input id="user_flag_flaggable_type" name="user_flag[flaggable_type]" type="hidden" value="listing" />
  <input id="user_flag_flaggable_id" name="user_flag[flaggable_id]" type="hidden" value="<?=$room->id?>" />
  <input id="user_flag_name" name="user_flag[name]" type="hidden" />
</div>
</form>
            </li>

              <li id="fb_link">
              <fb:like width="90" layout="button_count"></fb:like>
              </li>
        </ul>

        <div id="photos_div" class="main_content">
            <div class="galleria_wrapper">
  <div class="image-placeholder">
  	<?php if(empty($room->photos)): ?>
  	<img alt="Room_default_no_photos" height="426" src="<?=IMG_DIR?>/page3/v3/room_default_no_photos.jpg" width="639" /></div>
  	<?php else:?>
  	<img alt="Large" height="426" src="<?=insert_room_photo($room->photos[0]->id, 'large')?>" width="639" /></div>	
  	<?php endif;?>
	<div id="galleria_container">
		<?php if(empty($room->photos)): ?>
		<img alt="" src="<?=IMG_DIR?>/page3/v3/room_default_no_photos.jpg" />
		<?php else: foreach($room->photos as $k=>$photo): ?>
		<a href="<?=insert_room_photo($photo->id, 'large')?>" title="" > 
            <img alt="<?=$photo->caption?>" height="40" src="<?=insert_room_photo($photo->id, 'mini_square')?>" title="" width="40" /> 
        </a> 		
		<?php endforeach; endif; ?>
	</div>
  <div class="share-button-container">
    <img src="<?=IMG_DIR?>/transparent-pixel.gif" width="639" height="426" />
    <ul id="share_buttons" style="display: none">
      <li class="rounded_more" onclick="action_facebook();"><div class="facebook"></div>페이스북</li>
      <li class="rounded_more" onclick="action_twitter();"><div class="twitter"></div>트위터</li>
      <li class="rounded_more" onclick="action_link();"><div class="link"></div>링크</li>
      <li class="rounded_more" onclick="action_email();"><div class="email"></div>이메일</li>
    </ul>
  </div>
</div>

        </div>
        <div id="maps_div" class="main_content" style="display:none;">
            <div id="map" data-lat="<?=$room->lat?>" data-lng="<?=$room->lng?>">
</div>
<ul id="guidebook-recommendations" style="display: none;">
</ul>

        </div>
        <div id="calendar_div" class="main_content" style="display:none;">
            <div id="calendar_tab_container" ><div id="calendar_tab">
	<div style="float:left;width:400px;">

        <div id="calendar2">
            <div style="margin-bottom:5px;">
                <div style="float:left;">
                    월 선택하기 : 
                    <select id="cal_month" name="cal_month" onchange="change_month2();">
                    <?php
                    	$m = date('m');
                    	$y = date('Y');
						echo '<option value="'.$m.'" selected="selected">',$m.'월 '.$y.'</option>';
                    	for($i=0; $i<12; $i++){
                    		$m++;
	                    	if($m==12)
							{
								$y++;
								$m=1;
							}
							echo '<option value="'.$m.'">'.$m.'월 '.$y.'</option>';
						}
					?>
					</select>
                </div>
                <img id="calendar_loading_spinner" style="float:left; margin-left:10px; display:none;" src="<?=IMG_DIR?>/spinner.gif" />

                <div class="clear"></div>
            </div>
            <div id="calendar_tab_variable_content"></div>
            <div id="legend">
                <div class="available key">&nbsp;</div><div class="key-text">숙박가능</div>
                <div class="unavailable key">&nbsp;</div><div class="key-text">숙박불가</div>
                <div class="in_the_past key">&nbsp;</div><div class="key-text">지난 날짜</div>
                <div class="clear"></div>
            </div>
        </div>
	</div>
	
	<div style="float:left;margin-top:25px;width:235px;">
		달력은 5분마다 업데이트되며 개략적인 객실상황만을 알려주므로 주인장에게 직접 연락하여 숙박가능여부를 확인하는 것이 좋습니다.
        <br /><br />
		모든 요금은 객실당 1박 기준입니다.
	</div>
	<div class="clear"></div>
</div></div>

        </div>
        <div class="clear"></div>
    </div>
    <div class="bottom">&nbsp;</div>
</div>

                

<div id="details" class="box">
    <div class="top">&nbsp;</div>
    <div class="middle">

        <ul id="details_sub_nav" class="rooms_sub_nav">
            <li onclick="select_tab('details', 'description', jQuery(this));" class="details_link selected" id="description_link"><a href="javascript:void(0);">설명</a></li>
            <li onclick="select_tab('details', 'amenities', jQuery(this));" class="details_link"><a href="javascript:void(0);" id="amenities_link">편의시설</a></li>
        </ul>

        <div id="description" class="details_content">
            <div id="description_text" class="rounded_less">
                <div id="new_translate_button_wrapper" style="display: none;">
                  <div id="new_translate_button">
                    <span class="label">이 설명을 한국어로 번역하기</span>
                  </div>
                </div>
                <div id="description_text_wrapper" class="trans">
                  <p><?=$room->description?></p>
                </div> 
            </div>

            <ul id="description_details" class="rounded_less">
                <li style="padding:0 0 8px 10px; font-size:14px;">상세정보</li>
                  <li class="alt">
                    <span class="property">객실 타입 :</span><span class="value">프라이빗룸</span>
                  </li>
                  <li >
                    <span class="property">침대 타입:</span><span class="value">매트리스 침대</span>
                  </li>
                  <li class="alt">
                    <span class="property">숙박가능인원:</span><span class="value">1</span>
                  </li>
                  <li >
                    <span class="property">침실 수:</span><span class="value">1</span>
                  </li>
                  <li class="alt">
                    <span class="property">환불정책 :</span><span class="value"><a href="<?=site_url('home/cancellation_policies')?>" onclick="window.open(this.href);return false;">매우 유연한 편</a></span>
                  </li>
            </ul>
        </div>

        <div id="amenities" style="display:none" class="details_content">
        <?php  foreach($amenity_list as $k => $i)
			{
				$has = in_array($k, $room->amenities)?'has':'has_not';
				if( ! (($k-1) % 8)) echo '<ul>';
				echo "<li><div class='$has'></div><p>".lang('amenities_'.$i->name);
				if(isset($i->tooltip)) 
				{
					echo ' <a class="tooltip" title="'.lang('amenities_'.$i->name.'_tooltip').'"><img alt="Questionmark_hover"'
					.' src="'.IMG_DIR.'/icons/questionmark_hover.png" style="width:12px; height:12px;" /></a>';
				}
				echo"</p></li>";		
				if( ! ($k % 8))	echo '</ul>';
			}
		?>
            <div class="clear"></div>
        </div>

        <div id="house_rules" style="display:none" class="details_content">
                <p>이 주인장은 객실이용규칙을 정하지 않았습니다.</p>
        </div>
        <div class="clear"></div>
    </div>
    <div class="bottom">&nbsp;</div>
</div>

                
<div id="reputation" class="box" data-review-type="no_reviews" data-hosting-id="<?=$room->id?>">
    <a name="reputation-mark"></a>
    <div class="top"></div>
    <div id="reputation_middle" class="middle">


        <ul id="reputation_sub_nav" class="rooms_sub_nav">
            <li onclick="select_tab('rep', 'this_hosting_reviews', jQuery(this));" class="rep_link" id="this_hosting_reviews_link"><a href="javascript:void(0);">후기 (0)</a></li>
            <li onclick="select_tab('rep', 'other_hosting_reviews', jQuery(this));" class="rep_link" id="other_hosting_reviews_link" style="display:none;"><a href="javascript:void(0);">다른 객실 후기 (0)</a></li>
            <!--TODO: facebook friends <li onclick="select_tab('rep', 'friends', jQuery(this));" class="rep_link" id="friends_link"><a href="javascript:void(0);">친구 (0)</a></li>-->
        </ul>

        <div id="this_hosting_reviews" class="rep_content" style="display:none;">
            <!--[if lt IE 7]>
    <style>
        #room #left_column #review_stats #stats_left {margin: 0 40px 0 78px;}
     </style>
<![endif]-->



	    <p>이 사용자는 피드백이 없습니다.</p>





        </div>
        <div id="friends" class="rep_content" style="display:none;">
            


	    <p>이 사용자는 피드백이 없습니다.</p>





<ul class="grid_reputation">
</ul class="grid_reputation">
        </div>

        <div class="clear"></div>
    </div><!-- middle -->

    <div class="bottom">&nbsp;</div>
</div>

            </div><!-- /left_column -->

            <div id="right_column">
                <div id="book_it" class="box">
    <div class="top">&nbsp;</div>
    <div class="middle">
        <div id="book_it_default" class="rounded">
            <div id="pricing" class="book_it_section">
                <p style="width:253px; float:left;">From</p>
                <h2 id="price_amount"><?=$room->price_native?></h2>
                  <span id="per_month">1개월당</span>
                  <select id="payment_period" name="payment_period" >
                    <option value="per_night">1박당</option>
                    <option value="per_week">1주일당</option>
                    <option value="per_month">1개월당</option>
                  </select>
                <div class="clear"></div>
                <div id="includesFees">Includes all fees</div>
            </div>

            <div id="dates" class="book_it_section clearfix">
<form action="<?=site_url('payments/book?hosting_id='.$room->id)?>" class="info" id="book_it_form" method="post" name="book_it_form">                    <input id="hosting_id" name="hosting_id" type="hidden" value="<?=$room->id?>" />
                    <div class="date_section">
                        <label for="checkin">체크인</label>
                        <input class="checkin" id="checkin" name="checkin" type="text" />
                    </div>
                    <div class="date_section">
                        <label for="checkout">체크아웃</label>
                        <input class="checkout" id="checkout" name="checkout" type="text" />
                    </div>
                    <div class="num_guests_section">
                        <label for="number_of_guests">숙박인원</label>
                        <select id="number_of_guests" name="number_of_guests" onchange="refresh_subtotal();"><option value="1">1</option>
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
</form>            </div>

            <div id="book_it_status" class="book_it_section">
                <div id="book_it_enabled" class="clearfix">
                    <div id="subtotal_area">
                        <p>소계</p>
                        <h2 id="subtotal"></h2>
                    </div>
                    <div id="book_it_wrapper">
                        <input type="submit" id="book_it_button" class="v3_button v3_fixed_width" onclick="if(needs_to_message){lwlb_show('lwlb_needs_to_message');} else {if(check_inputs()){this.disabled='disabled'; this.style.cursor ='progress'; jQuery('#instant_book_arrow').addClass('gray_arrow'); jQuery('#book_it_form').submit();}}" value="예약하기!"/>
                        <input type='submit' id="instant_book_it_button" class='v3_button v3_fixed_width instant_book force_hide' onclick="if(needs_to_message){lwlb_show('lwlb_needs_to_message');} else {if(check_inputs()){this.disabled='disabled'; this.style.cursor ='progress'; jQuery('#instant_book_arrow').addClass('gray_arrow'); jQuery('#book_it_form').submit();}}" value="즉시 예약"/>
                        <span id="instant_book_arrow" class="force_hide" onclick="jQuery('#instant_book_it_button').attr('disabled', true); this.style.cursor ='progress'; jQuery('#instant_book_arrow').addClass('gray_arrow'); jQuery('#book_it_form').submit();"></span>
                    </div>
                </div>

                <div id="book_it_disabled" style="display:none;">
                    <p id="book_it_disabled_message" class="bad">이 소유물은 이용이 불가능합니다.</p>
                    <a class='v3_button v3_orange v3_fixed_width' id='view_other_listings_button' onclick="if(check_inputs()){redo_search();}; return false;" href="">
                        다른 객실 보기
                    </a>
                    <br />
                </div>

                <div id="show_more_subtotal_info" style="display:none;">
                  <a href="javascript:void(0);" onclick="jQuery('#more_subtotal_info_text, #less_subtotal_info_text').toggle(); jQuery('#more_subtotal_info_arrow, #less_subtotal_info_arrow').toggle(); jQuery('#subtotal_info').toggle();"><span id="more_subtotal_info_arrow" class="expand-arrow expand"></span><span id="less_subtotal_info_arrow" class="expand-arrow contract" style="display:none;"></span><span id="more_subtotal_info_text">더보기</span><span id="less_subtotal_info_text" style="display:none;">less info</span></a>
                  <div id="subtotal_info" style="display:none;">
                        에어비앤비 서비스수수료는 제외 (<span id="service_fee"></span>)
                  </div>
                </div>
            </div>
        </div>

        <div class="clear"></div>
    </div><!-- middle -->

    <div class="bottom">&nbsp;</div>
</div>


                <div id="user" class="box">
    <div class="top">&nbsp;</div>
    <div class="middle">
        <a id="show_more_user_info" href="javascript:void(0);">
					<span id="more_info_arrow" class="expand-arrow"></span>
					<span id="more_info_text">더보기</span>
					<span id="less_info_text" style="display:none;">less info</span>
				</a>
				
        <div id="user_info_small" class="user_info gray_gradient_fade rounded_less">    
		    	  <h3>Ff D</h3>
			    
          
          <div id="user_actions">
              <b>응답율: <a class="tooltip" title="최근 3개월간 주인장이 메시지에 응답한 확률"><img alt="Questionmark_hover" src="<?=IMG_DIR?>/icons/questionmark_hover.png" style="width:12px; height:12px;" /></a></b>
              <br />
              &nbsp;N/A
            <input type='submit' id="user_contact_link" class='v3_button v3_blue v3_fixed_width' value="연락하기"/>
            <br />
          </div>
          <div class="clear"></div>
        </div>

        <div id="user_info_big" class="user_info gray_gradient_fade rounded_less" style="display:none">
          
		    	  <h3>Ff D</h3>
			    

            <ul>







            </ul>

            <div style="margin-top:8px; padding:8px 0; border-top:1px dotted #c4c4c4; float:left;">
              <div style="width:100px; float:left;">
              </div>
              <input type='submit' id="user_contact_link" class='v3_button v3_blue v3_fixed_width' value="연락하기"/><br />
              <div class="clear"></div>
            </div>

            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div><!-- middle -->

    <div class="bottom">&nbsp;</div>
</div>


<div id="social_connections" class="box" style="display:none">
	<div class="top">&nbsp;</div>
	<div class="middle">
		<div class="connections_info gray_gradient_fade rounded_less">
			<h3 style="margin-bottom:0">You and Ff D</h3>
			<p style="margin: 0 0 10px 0; display: block; height: auto;">
				<a target="_blank" href="/social/">더 알아보기!</a>
			</p>
			<ul id="social_connections_list"></ul>
			<a href="#" id="more-connections" style="display:none;">
				<span id="more-count"></span> more friend connections
			</a>
		</div>
	</div>
	<div class="bottom">&nbsp;</div>
</div>

<script type="text/x-jqote-template" id="social_connection_template">
	<![CDATA[
		<li>
			<div class="contact-img">
				<img height="38" width="38" alt="" src="<*= this.pic_url_large *>" />
			</div>
			<p><*= this.caption *></p>
		</li>
	]]>
</script>

                  
<div class="related_listings box" id="my_other_listings"> 
    <div class="top">&nbsp;</div> 
    <div class="middle"> 
        <div class="related_listings_content gray_gradient_fade rounded_less clearfix"> 
                <h3>나의 다른 객실</h3> 
                    <h4>1 room </h4> 
 
                <ul> 
 
                    <li> 
                        <div class="related_listing_left"> 
                        <a href="http://www.airbnb.com/rooms/180203" id="related_listing_photo"><img alt="1231" height="62" src="http://s1.muscache.com/1308680853/images/page3/v3/room_default_no_photos.png" title="1231" width="93" /></a> 
                        </div> 
 
                        <div class="related_listing_right"> 
                                <span class="same_address"><a href="/rooms/180203">같은 장소</a></span> 
 
                            <div class="subtitle">$123/night <br />프라이빗룸</div> 
                        </div> 
                        <div class="clear"></div> 
                    </li> 
                </ul> 
        </div><!-- /related_listings_content --> 
    </div><!-- middle --> 
    <div class="bottom">&nbsp;</div> 
</div> 

<div id="similar_listings" class="related_listings box"> 
    <div class="top">&nbsp;</div> 
    <div class="middle"> 
        <div class="related_listings_content gray_gradient_fade rounded_less"> 
 
                <h3>비슷한 객실</h3> 
 
          불러오는 중...
        </div><!-- /related_listings_content --> 
 
        <div class="clear"></div> 
    </div><!-- middle --> 
    <div class="bottom">&nbsp;</div> 
</div> 


            </div><!-- /right_column -->


        <div id="lwlb_overlay"></div>
        <div id="lwlb_link" class="lwlb_lightbox">
    <h5>Share <?=$room->name?></h5>
    <p>사랑을 전달하세요! URL 공유하기 :</p>
    <input name="share_room_url" value="<?=site_url('rooms/'.$room->id)?>" style="width:360px; font-size:13px; padding:2px 1px; background:#eff7fb;" id="share_room_url" onclick="jQuery('#share_room_url').focus(); jQuery('#share_room_url').select();"/>
    <br />
    <br />
    <a href="#" onclick="lwlb_hide('lwlb_link');return false;">close</a>
</div>



        <div id="lwlb_needs_to_message" class="lwlb_lightbox2" style="display:none;">
          <div class="header">
            <div class="h1"><h1>객실사용가능현황을 확인해 주세요</h1></div>
            <div class="close"><a href="#" onclick="lwlb_hide_and_reset('lwlb_needs_to_message');return false;"><img src="<?=IMG_DIR?>/lightboxes/close_button.gif" /></a></div>
            <div class="clear"></div>
          </div>
          <br/>
          <br/>
          <p>이 주인장은 예약요청을 하기 전에 객실이 사용 가능한지 확인해 볼 것을 요청합니다. 예약하기 전 주인장에게 메시지를 보낸 후 답장이 올 때까지 기다려 주세요.</p>
          <br/>
          <br/>
          <p><span class='v3_button v3_blue' onclick="jQuery('#lwlb_needs_to_message').hide();jQuery('#user_contact_link').click();">주인장 연락하기</span></p>
        </div>

        <div id="lwlb_contact_container"></div>
        <!-- set up a dummy link that we click later with js -->
        <a style="display:none;" id="fb_share_dummy_link" name="fb_share" type="icon_link" href="http://www.facebook.com/sharer.php">Share</a>

          <div id="lwlb_email" class="lwlb_lightbox">
    <h1 style="font-size:18px;">객실 공유하기</h1><br />
<form action="<?=site_url('rooms/lb_share'.$room->id)?>" method="post">        <div>받는 사람: <input id="send_to" name="send_to" type="text" value="" /> (이메일을 입력하세요.)</div>
        <br />
        <div>개인 메시지:</div>
        <div><textarea name="message" style="width:100%;height:50px;">에어비앤비에서 관심을 갖을 만한 곳입니다.</textarea></div>
        <br />
        
        <div>미리보기:</div>
        <div style="font-style:italic;">
            Ff Dd 회원님과 다음의 숙박을 공유하기로 했습니다:
            "<?=anchor('rooms/'.$room->id,$room->name)?>".<br /><br />
            
            개인 메시지:<br />
            (메시지는 여기에 쓰세요.)
        </div><br />
        
        <div><input name="commit" type="submit" value="Send E-mail" />   <a href="#" onclick="lwlb_hide('lwlb_email');return false;">취소</a></div>
</form></div>


        <div class="clear"></div>
    </div><!-- /rooms -->
</div><!-- /rooms -->






<!--[if lt IE 7]> 
<style type="text/css">
    #book_it_status #subtotal_area p{font-size:12px; color:#666666; margin-bottom:0;}
    #room #right_column #user div.user_info{padding-top:10px;}
    #room #right_column #user .top{height:20px;}
    #room #left_column #main_content #photos{float:none;}
    #room #left_column #main_content #maps{float:none;}
    #book_it_button{margin-top:8px;}
    #room #the_roof #action_buttons ul li a.icon {margin-left:0;}
    ul#share_buttons{height:220px;}
    #room #right_column #user #user_actions{padding:4px 0 0 1px; overflow:hidden;}
    #room #right_column #user{position:static;}
</style>
<![endif]-->

<?php $this->load->view('footer', array('no_closing' => TRUE)); ?>


	<div id="fb-root"></div>

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
				
				jQuery(document).trigger('fbInit');
			};
 
			(function() {
				var e = document.createElement('script');
				e.src = document.location.protocol + '//connect.facebook.net/<?=CURRENT_LANGUAGE_CODE?>/all.js';
				e.async = true;
				document.getElementById('fb-root').appendChild(e);
			}());
 
 
		    var needs_to_message = false;
    var ajax_already_messaged_url = "<?=site_url('messaging/ajax_already_messaged'.$room->user_id)?>";
    var ajax_lwlb_contact_url = "<?=site_url('rooms/ajax_lwlb_contact/'.$room->id)?>";
 
    function action_email() {
            lwlb_show('lwlb_email');
    }
 
    function action_twitter() {
    	// TODO: 트위터 메시지 변경
        popup('http://twitter.com/home/?status=Stay+at+%2212%22%20in%20Malang,%20Indonesia%20-+http://www.airbnb.com%2Frooms%2F184100%20via%20@airbnb%20%23Travel', 'console', 650, 1024);
    }
 
    function redo_search(opts) {
        opts = (opts === undefined ? {} : opts);
 
        opts.useAddressAsLocation = (opts.useAddressAsLocation === undefined ? true : opts.useAddressAsLocation);
 
        var urlParts = ["/search?"];
 
        if(opts.useAddressAsLocation === true){
            //need to make this backwards compatible with cached versions
            var locationParam = '';
 
            if(jQuery('#display_address')){
                locationParam += jQuery('#display_address').html();
            } else if(jQuery('.current_crumb .locality')){ //we can remove this else if block after Oct 12, 2010 -Chris
                locationParam += jQuery('.current_crumb .locality').html();
                if(jQuery('.current_crumb .region')){
                    locationParam += ', ';
                    locationParam += jQuery('.current_crumb .region').html();
                }
            }
 
            if(locationParam && locationParam != 'null' && locationParam != ''){
                urlParts = urlParts.concat(["location=", locationParam, '&sort_by=2&']);
            }
        }
 
        var checkinValue = jQuery('#checkin').val();
        var checkoutValue = jQuery('#checkout').val();
 
        if(checkinValue !== 'mm/dd/yyyy' && checkoutValue !== 'mm/dd/yyyy'){
            urlParts = urlParts.concat(["checkin=", checkinValue, "&checkout=", checkoutValue, '&']);
        }
 
        urlParts = urlParts.concat(["number_of_guests=", jQuery('#number_of_guests').val()]);
 
        url = urlParts.join('');
 
        window.location = url;
 
        return true;
    }
 
	function change_month2() {
        var $spin = jQuery('#calendar_loading_spinner').show();
 
        // dim out the current calendar
        var $table = jQuery('#calendar_table')
          .css('opacity', .5)
          .css('filter', 'alpha(enabled=true)');
        
        // now load the calendar content
        jQuery('#calendar_tab_variable_content').load("<?=site_url('calendar/tab_inner/'.$room->id)?>", 
          {cal_month: jQuery('#cal_month').val()},
          function(response) {
            $table.css('opacity', 1.0)
              .css('filter', 'alpha(enabled=false)');
            $spin.hide();
        });
	}
 
  var initial_month_loaded = false;
	function load_initial_month() {
	  var $spin;
    if (initial_month_loaded === false) {
      var $spin = jQuery('#calendar_loading_spinner').show();
      jQuery('#calendar_tab_variable_content').load("<?=site_url('calendar/tab_inner/'.$room->id)?>",
        {cal_month: jQuery('#cal_month').val()},
        function() {
          $spin.hide();
          initial_month_loaded = true;
        }
      );
    }
  }
 
  var Translations = {
    translate_button: {
      
      show_original_description : 'Show original description',
      translate_this_description : 'Translate this description to English'
    },
    per_month: "per month",
    long_term: "Long Term Policy"
  }
 
    /* after pageload */
    jQuery(document).ready(function() {
        // initialize star state
        Airbnb.Bookmarks.starredIds = [];
        Airbnb.Bookmarks.initializeStarIcons();
 
 
        page3Slideshow.enableKeypressListener();
 
        //Code for back to page2
            var backToSearchHtml = ['<div id="back_to_search_container"><a rel="nofollow" onclick="if(redo_search({useAddressAsLocation : true})){return false;}" href="/search" id="back_to_search_link">', "View Nearby Properties", '</a></div>'].join('');
 
        jQuery('#the_roof').prepend(backToSearchHtml);
 
        /* target specifically a#view_other_listings_button so no conflict with input#view_other_listings_button in cached pages */
        if(jQuery('a#view_other_listings_button')){
            jQuery('a#view_other_listings_button').attr('href', jQuery('#back_to_search_link').attr('href'));
        }
        /* end code for back to page2 */
 
        $('#new_hosting_actions a').click(function(e) {
          ajax_log('signup_funnel', 'click_new_hosting_action');
        });
        // init the flag widget handler too
        jQuery('#content_flag').hide();
 
        AirbnbRooms.init({inIsrael: false, 
                          hostingId: <?=$room->id?>,
                          isMonthly: false,
                          staggeredPrice: '$409',
                          stayOffered: 2,
                          nightlyPrice: "$12",
                          weeklyPrice: "$84",
                          monthlyPrice: "$336"});


        refresh_subtotal();

<?php //TODO: 이거 php로 생성해야?>
        jQuery('#extra_people_pricing').html("추가요금 없음");

		jQuery('#extra_people_pricing').html("No Charge");

        jQuery('#cleaning_fee_string').html("$60");

        jQuery('#weekly_price_string').html("$950");

        jQuery('#monthly_price_string').html("$3300");


        add_data_to_cookie('viewed_page3_ids', <?=$room->id?>);
        
        
          var originalDescriptionText = jQuery('#description_text_wrapper').html(),
            descriptionTranslated = false;
          jQuery('#new_translate_button_wrapper').click(function() {
            var descriptionTextWrapper = jQuery('#description_text_wrapper');
            var label = jQuery(this).find('.label');
            if(descriptionTranslated) {
              descriptionTranslated = false;
              label.html(Translations.translate_button.translate_this_description);
              descriptionTextWrapper.html(originalDescriptionText);
            }
            else {
              label.html(Translations.translate_button.show_original_description);
              descriptionTranslated = true;
              translate('<?=CURRENT_LANGUAGE?>');
            }
          });
        
          jQuery('#new_translate_button_wrapper').show();
        
        jQuery.ajax({
            url: '/rooms/<?=$room->id?>/ajax_increment_impressions',
            type: 'post',
            data: {
                param: ''
            }
        });

        //jQuery.get("/rooms/sublet_available/<?=$room->id?>?checkin=&checkout=", function(data) {
        //  jQuery("#right_column").prepend(data);
        //});
        jQuery("#similar_listings").load("/rooms/similar_listings/<?=$room->id?>?checkin=&checkout=&guests=");
		//jQuery.getJSON("/rooms/social_connections/<?=$room->id?>", function(data) {
		/*	var INITIAL_CONNECTIONS = 5;
			var i, len, list, $moreConnections, $moreCount, template;
			var relationships = data.relationships;

			if (relationships && relationships.length > 0) {
				len = relationships.length;
				list = jQuery("#social_connections_list");
				template = jQuery("#social_connection_template");

				for (i = 0; i < Math.min(INITIAL_CONNECTIONS, len); i++) {
					list.append(template.jqote(relationships[i], '*'));
				}

				if (len > INITIAL_CONNECTIONS) {
					$moreConnections = $("#more-connections").show();
					$moreCount = $("#more-count")
						.html(len - INITIAL_CONNECTIONS);

					$moreConnections.one("click", function() {
						for (i = INITIAL_CONNECTIONS; i < len; i++) {
							list.append(template.jqote(relationships[i], '*'));
						}
						$moreConnections.hide();
						$moreConnections = $moreCount = null;
						return false;
					});
				}
				jQuery("#social_connections").show();
			}
		});*/

    });

		jQuery(document).ready(function() {
			Airbnb.init({userLoggedIn: <?=$this->tank_auth->is_logged_in() ? 'true':'false'?>});
		});

		Airbnb.FACEBOOK_PERMS = "<?=$this->config->item('facebook_scope')?>";
	</script>
</html>
