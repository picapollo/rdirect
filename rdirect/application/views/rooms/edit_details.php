<?php
	$this->load->view('header/edit_listing', $header);
	$this->load->view('top_menu', array('starred'=> $starred));
	$this->load->view('rooms/edit_nav', array('selected' => 'details', 'room' => $room, 'sig' => $sig));
?>

    <div class="col three-fourths content"> 
      
      <div id="notification-area"></div> 
      <div id="dashboard-content"> 
        
 
 
 
<form action="<?=site_url('rooms/update/'.$room->id)?>" enctype="multipart/form-data" id="hosting_edit_form" method="post" name="hosting_edit_form">    
    
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
 
  <div id="description_language_en" class="box" style="display: none;"> 
      <div class="top"> 
          <h2 class="step"> 
            <p class="close_section"><a href="" onclick="hideSection('en'); return false;"><img alt="Close_icon_blue" src="<?=IMG_DIR?>/icons/close_icon_blue.png" /></a></p> 
            <span class="edit_room_icon details"></span>설명 <span class="language_hint">(English)</span> 
          </h2> 
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
                      <label for="hosting_description" style="vertical-align:top;">설명 <a class="tooltip" title="알림: 객실 설명에 있는 연락처 정보는 자동으로 필터되어 삭제됩니다. "><img alt="Questionmark_hover" src="<?=IMG_DIR?>/icons/questionmark_hover.png" style="width:16px; height:16px;" /></a> 
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
 
  <div id="description_language_zh" class="box" style="display: none;"> 
      <div class="top"> 
          <h2 class="step"> 
            <p class="close_section"><a href="" onclick="hideSection('zh'); return false;"><img alt="Close_icon_blue" src="<?=IMG_DIR?>/icons/close_icon_blue.png" /></a></p> 
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
                      <label for="hosting_description" style="vertical-align:top;">설명 <a class="tooltip" title="알림: 객실 설명에 있는 연락처 정보는 자동으로 필터되어 삭제됩니다. "><img alt="Questionmark_hover" src="<?=IMG_DIR?>/icons/questionmark_hover.png" style="width:16px; height:16px;" /></a> 
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
            <p class="close_section"><a href="" onclick="hideSection('ko'); return false;"><img alt="Close_icon_blue" src="<?=IMG_DIR?>/icons/close_icon_blue.png" /></a></p> 
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
                      <label for="hosting_description" style="vertical-align:top;">설명 <a class="tooltip" title="알림: 객실 설명에 있는 연락처 정보는 자동으로 필터되어 삭제됩니다. "><img alt="Questionmark_hover" src="<?=IMG_DIR?>/icons/questionmark_hover.png" style="width:16px; height:16px;" /></a> 
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
<option value="en">English</option> 
<option value="zh">中文(简体)</option> 
<option value="ko">한국어</option></select> 
</div> 
 
 
 
 
<script> 
  var visibleSectionsCount = 1; <?php //TODO: 현재 표시된 Description 수 ?>
  
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
    
    <?php if(true): //TODO 이미 표시된 언어 추가 불가 ?>
    jQuery('#add_description_language option[value="ko"]').attr('disabled', 'disabled');
    <?php endif; ?>
    
    //showSection('en');
  });
  
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
                                <a class="tooltip" title="인터넷(유/무선)"><img alt="Questionmark_hover" src="<?=IMG_DIR?>/icons/questionmark_hover.png" style="width:16px; height:16px;" /></a> 
                        </label> 
                    </li> 
                    <li> 
                        <input value="4" id="amenity_4" name="amenities[]" type="checkbox" /> 
                        <label for="amenity_4">무선 인터넷
                                <a class="tooltip" title="24시간 접속가능한 무선인터넷 공유기"><img alt="Questionmark_hover" src="<?=IMG_DIR?>/icons/questionmark_hover.png" style="width:16px; height:16px;" /></a> 
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
                                <a class="tooltip" title="휠체어 접근이 용이한 객실입니다. 기타 개인적인 필요사항은 여행객과 주인장이 서로 협의해야 합니다."><img alt="Questionmark_hover" src="<?=IMG_DIR?>/icons/questionmark_hover.png" style="width:16px; height:16px;" /></a> 
                        </label> 
                    </li> 
                    <li> 
                        <input value="7" id="amenity_7" name="amenities[]" type="checkbox" /> 
                        <label for="amenity_7">수영장
                                <a class="tooltip" title="전용 수영장"><img alt="Questionmark_hover" src="<?=IMG_DIR?>/icons/questionmark_hover.png" style="width:16px; height:16px;" /></a> 
                        </label> 
                    </li> 
                    <li> 
                        <input value="8" id="amenity_8" name="amenities[]" type="checkbox" /> 
                        <label for="amenity_8">부엌
                                <a class="tooltip" title="손님 이용 가능한 부엌"><img alt="Questionmark_hover" src="<?=IMG_DIR?>/icons/questionmark_hover.png" style="width:16px; height:16px;" /></a> 
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
                                <a class="tooltip" title="건물 내 주차가능(유/무료)"><img alt="Questionmark_hover" src="<?=IMG_DIR?>/icons/questionmark_hover.png" style="width:16px; height:16px;" /></a> 
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
                                <a class="tooltip" title="헬스장 무료이용 가능"><img alt="Questionmark_hover" src="<?=IMG_DIR?>/icons/questionmark_hover.png" style="width:16px; height:16px;" /></a> 
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
                                <a class="tooltip" title="아침식사 제공"><img alt="Questionmark_hover" src="<?=IMG_DIR?>/icons/questionmark_hover.png" style="width:16px; height:16px;" /></a> 
                        </label> 
                    </li> 
                    <li> 
                        <input value="31" id="amenity_31" name="amenities[]" type="checkbox" /> 
                        <label for="amenity_31">가족/어린이 숙박가능
                                <a class="tooltip" title="어린이를 동반한 가족이 숙박하기에 적당합니다."><img alt="Questionmark_hover" src="<?=IMG_DIR?>/icons/questionmark_hover.png" style="width:16px; height:16px;" /></a> 
                        </label> 
                    </li> 
                    <li> 
                        <input value="32" id="amenity_32" name="amenities[]" type="checkbox" /> 
                        <label for="amenity_32">이벤트행사용으로 적절
                                <a class="tooltip" title="25명 이상의 그룹을 수용할 수 있습니다."><img alt="Questionmark_hover" src="<?=IMG_DIR?>/icons/questionmark_hover.png" style="width:16px; height:16px;" /></a> 
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
                <label for="hosting_square_meter">면적 <a class="tooltip" title="빌려주는 방의 크기.&lt;br /&gt;집/아파트 전체를 빌려주는 거면, 전체 사이즈도 입력하세요.&lt;br /&gt;개인 방만 빌려주는 거면, 방의 사이즈만 입력하세요."><img alt="Questionmark_hover" src="<?=IMG_DIR?>/icons/questionmark_hover.png" style="width:; height:;" /></a></label> 
                <input id="hosting_square_meter" name="hosting[square_feet]" size="30" style="width: 100px;" type="text" /> 
                square meter 
<option value="false">square meters</option></select> 
            </li> 
            <li class="clearfix"> 
                <label for="hosting_house_manual" style="vertical-align:top;">객실이용정보
                <a class="tooltip" title="예약요청이 수락되어 예약이 완료된 여행객에게만 이 정보가 전송됩니다. (예: WIFI 비밀번호, lockbox code, 주차정보 등)"><img alt="Questionmark_hover" src="<?=IMG_DIR?>/icons/questionmark_hover.png" style="width:; height:;" /></a>
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
					<label for="address_street_view">스트리트뷰 <a class="tooltip" title="By Default we offset the location of your property to protect your privacy.&lt;br /&gt;You may show a more specific Street View location by choosing &quot;Closest to My Address&quot;.&lt;br /&gt;You may also choose to &quot;Hide Street View&quot;."><img alt="Questionmark_hover" src="<?=IMG_DIR?>/icons/questionmark_hover.png" style="width:16px; height:16px;" /></a></label> 
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
 
<?php $this->load->view('footer', array('no_closing')); ?>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?v=3.5&sensor=false&amp;libraries=places"></script> 
 
<script type="text/javascript">
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
		    exactCoords: new google.maps.LatLng(<?php echo $room->lat.', '.$room->lng?>),
		    fuzzyCoords: new google.maps.LatLng(<?php echo $room->lat.', '.$room->lng?>),
		    accuracy: 8,
		    supportContent: "<p><strong><?php echo $room->address?></strong></p><p>Please contact <a href=\"<?=site_url('home/contact')?>\">Airbnb support</a> to change this address.</p>"
		  });
		});
 
 		jQuery(document).ready(function() {
			Airbnb.init({userLoggedIn: <?=$this->tank_auth->is_logged_in()?>});
		});
	</script> 
</html> 
 