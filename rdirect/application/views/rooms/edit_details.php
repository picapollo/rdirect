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
                <select class="fixed-width" id="hosting_property_type_id" name="hosting[property_type_id]">
                <?php 
                	foreach($property_type_list as $k => $i)
					{
						echo "<option value='{$k}'";
						if($k == $room->property_type_id)
							echo 'selected="selected"';
						echo ">{$i}</option>";
					}
				?>
				</select> 
                <div id="form_helper_property_type_id" class="form_helper" style="display:none;"><p>객실 종류가 뭔가요?</p></div> 
                <div class="clear"></div> 
            </li> 
 
            <li> 
                <label for="hosting_room_type">객실 타입</label> 
                <select class="fixed-width" id="hosting_room_type" name="hosting[room_type]">
                <option value="Private room" <?='Private room'==$room->room_type?'selected="selected"':''?>>프라이빗룸</option> 
				<option value="Shared room" <?='Shared room'==$room->room_type?'selected="selected"':''?>>쉐어드룸</option> 
				<option value="Entire home/apt" <?='Entire home/apt'==$room->room_type?'selected="selected"':''?>>집/아파트 전체</option></select> 
                <div id="form_helper_room_type" class="form_helper" style="display:none;"><p>방 종류가 뭔가요?</p></div> 
                <div class="clear"></div> 
            </li> 
 
        </ul> 
 
        <div class="clear"></div> 
    </div><!-- middle --> 
    <div class="bottom">&nbsp;</div> 
</div><!-- box --> 
 
 
<div id="multilingual_description_container"> 
<?php 
foreach($this->config->item('supported_languages') as $lang => $i):
	$desc = null;
	foreach($descriptions as $j){
		if($j->language == $lang){
			$desc = $j;
			break;
		}
	}
?>
  <div id="description_language_<?=$lang?>" class="box" style="display: <?=$desc?'block':'none'?>;'"> 
      <div class="top"> 
          <h2 class="step"> 
            <p class="close_section"><a href="" onclick="hideSection('<?=$lang?>'); return false;"><img alt="Close_icon_blue" src="<?=IMG_DIR?>/icons/close_icon_blue.png" /></a></p> 
            <span class="edit_room_icon details"></span>설명 <span class="language_hint">(<?=$i['name']?>)</span> 
          </h2> 
      </div> 

      <div class="middle"> 
          <ul id="description"> 
 
              <li class="description_language_section_container"> 
                <ul class="description_language_section"> 
 
                  <li class="section_<?=$lang?>"> 
                      <label for="hosting_name"> 
                      제목<br /> 
                      </label> 
                      <input class="large charcount hosting_name" id="hosting_descriptions_<?=$lang?>_name" maxlength="35" name="hosting_descriptions[<?=$lang?>][name]" type="text" value="<?=$desc?$desc->name:''?>"/> 
                      <span id="hosting_name_char_count" class="countvalue"></span> 
                      <span id="title_message"></span> 
                      <div class="clear"></div> 
                      
                      <input id="hosting_descriptions_<?=$lang?>_delete" name="hosting_descriptions[<?=$lang?>][delete]" type="hidden" value="<?=$desc?'false':'true'?>" /> 
                  </li> 
                  <li class="section_<?=$lang?>"> 
                      <label for="hosting_description" style="vertical-align:top;">설명 
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
                      <textarea id="hosting_descriptions_<?=$lang?>_description" name="hosting_descriptions[<?=$lang?>][description]"><?=$desc?$desc->description:''?></textarea> 
                      <div class="clear"></div> 
                  </li> 
              </ul> 
            </li> 
            
          </ul> 
        
          <div class="clear"></div> 
      </div><!-- middle --> 
      <div class="bottom">&nbsp;</div> 
  </div><!-- box --> 
<?php endforeach; ?>
  
</div> 
 
<div id="add_language_section"> 
  새로 설명 추가하기:
  <select id="add_description_language" name="add_description_language"><option value="xx">언어 선택</option>
<?php 
	foreach($this->config->item('supported_languages') as $k=>$i)
	{
		echo "<option value='$k'>{$i['name']}</option>";
	} 
?> 
</select>
</div> 
 
 
 
 
<script> 
  var visibleSectionsCount = <?=count($descriptions)?>;
  
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
    
    <?php foreach($descriptions as $i): ?>
    jQuery('#add_description_language option[value="<?=$i->language?>"]').attr('disabled', 'disabled');
    <?php endforeach; ?>
    
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
        <?php 
        	$amenities = explode(',', $room->amenities);
			//print_r($amenity_list);
        	foreach($amenity_list as $k => $i)
			{
				$checked = in_array($k, $amenities)?'checked':'';
				if( ! (($k-1) % 8)) echo '<ul class="amenity_column">';
				echo "<li><input value='$k' id='amenity_$k' name='amenities[]' type='checkbox' $checked/>";
				echo "<label for='amenity_$k'> ".lang('amenities_'.$i->name);
				if(isset($i->tooltip)) 
				{
					echo ' <a class="tooltip" title="'.lang('amenities_'.$i->name.'_tooltip').'"><img alt="Questionmark_hover"'
					.' src="'.IMG_DIR.'/icons/questionmark_hover.png" style="width:16px; height:16px;" /></a>';
				}
				echo"</label></li>";		
				if( ! ($k % 8))	echo '</ul>';
			}
			echo '</ul>';
		?>  
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
                <select class="fixed-width" id="hosting_person_capacity" name="hosting[person_capacity]" onchange="accommodates_changed();">
<?php 
for($i=1; $i<16; $i++)
{
	echo '<option value='.$i.(($i==$room->person_capacity)?' selected="selected"':'').'>'.$i.(($i==1)?' person':' people').'</option>';
}
echo '<option value='.$i.(($i==$room->person_capacity)?' selected':'').'>'. $i . '+ people</option>';	                	
?> 
                <div id="form_helper_person_capacity" class="form_helper" style="display:none;"><p>최대숙박가능인원수</p></div> 
            </li> 
            <li class="clearfix"> 
                <label for="hosting_bedrooms">침실 수</label> 
                <select class="fixed-width" id="hosting_bedrooms" name="hosting[bedrooms]"><option value="0" <?=( ! $room->bedrooms)?'selected="selected"':''?>></option>
<?php 
for($i=1; $i<10; $i++)
{
	echo '<option value='.$i.' '.(($i==$room->bedrooms)?'selected="selected"':'').'>'.$i.(($i==1)?' bedroom':' bedrooms') .'</option>';
}	                	
?>                  
				</select> 
                <div id="form_helper_bedrooms" class="form_helper" style="display:none; width:320px;"><p>손님이 쓸 수 있는 침실이 총 몇 개인가요?</p></div> 
            </li> 
            <li class="clearfix"> 
                <label for="hosting_beds">침대</label> 
                <select class="fixed-width" id="hosting_beds" name="hosting[beds]">
<?php 
for($i=1; $i<16; $i++)
{
	echo '<option value='.$i.' '.(($i==$room->beds)?'selected="selected"':'').'>'.$i.(($i==1)?' bed':' beds').'</option>';
}
echo '<option value='.$i.(($i==$room->beds)?' selected="selected"':'').'>'. $i . '+ beds</option>';	                	
?>            
				</select> 
                <div id="form_helper_beds" class="form_helper" style="display:none; width:320px;"><p>손님용 침대, 소파, 두꺼운 요 등이 총 몇 개인가요?</p></div> 
            </li> 
            <li class="clearfix"> 
                <label for="hosting_bed_type_id">침대 타입</label> 
                <select class="fixed-width" id="hosting_bed_type_id" name="hosting[bed_type_id]">
                <?php 
                	foreach($bed_type_list as $k => $i)
					{
						echo "<option value='{$k}'";
						if($k == $room->bed_type_id)
							echo 'selected="selected"';
						echo ">{$i}</option>";
					}
				?>
				</select> 
            </li> 
            <li class="clearfix"> 
                <label for="hosting_bathrooms">화장실</label> 
                <select class="fixed-width" id="hosting_bathrooms" name="hosting[bathrooms]"><option value="" selected="selected"></option> 
<?php 
for($i=1; $i<8; $i++)
{
	echo '<option value='.$i.(($i==$room->bathrooms)?' selected=" selected"':'').'>'.$i.(($i==1)?' bathroom':' bathrooms').'</option>';
}
echo '<option value='.$i.' '.(($i==$room->bathrooms)?' selected':'').'>'.$i.'+ beds</option>';	                	
?>            
			</select> 
            </li> 
            <li class="clearfix"> 
                <label for="hosting_square_meter">면적 <a class="tooltip" title="빌려주는 방의 크기.&lt;br /&gt;집/아파트 전체를 빌려주는 거면, 전체 사이즈도 입력하세요.&lt;br /&gt;개인 방만 빌려주는 거면, 방의 사이즈만 입력하세요."><img alt="Questionmark_hover" src="<?=IMG_DIR?>/icons/questionmark_hover.png" style="width:; height:;" /></a></label> 
                <input id="hosting_square_meter" name="hosting[square_meter]" size="30" style="width: 100px;" type="text" value="<?=$room->square_meter?>"/> 
                square meter 
<option value="false">square meters</option></select> 
            </li> 
            <li class="clearfix"> 
                <label for="hosting_house_manual" style="vertical-align:top;">객실이용정보
                <a class="tooltip" title="예약요청이 수락되어 예약이 완료된 여행객에게만 이 정보가 전송됩니다. (예: WIFI 비밀번호, lockbox code, 주차정보 등)"><img alt="Questionmark_hover" src="<?=IMG_DIR?>/icons/questionmark_hover.png" style="width:; height:;" /></a>
                </label> 
                <textarea cols="40" id="hosting_house_manual" name="hosting[house_manual]" rows="20"><?=$room->house_manual?></textarea> 
                <div id="form_helper_house_manual" class="form_helper" style="display:none;"></div> 
            </li> 
 
            <li class="clearfix"> 
            	<?php $pets = explode(',', $room->pets); ?>
                <label for="pets_1">애완동물 있음</label> 
                <div class="grouped-options radio pets"> 
                    <input id="include_pets" name="include_pets" type="hidden" /> 
                    <label> 
                      <input type="radio" id="pets_1" value="1" name="pets[]" <?=in_array('1', $pets)?'checked':''?>/> 
                      <strong>Yes</strong>, there are pets or animals here
                    </label> 
                    <label> 
                      <input type="radio" value="-1" name="pets[]" <?=in_array('-1', $pets)?'checked':''?>/> 
                      <strong>No</strong>, there aren't any pets or animals here
                    </label> 
                </div> 
            <li id="pets-amenities" class="clearfix"> 
                <label for="pets_1">애완동물 종류</label> 
                <div class="grouped-options checkbox"> 
                    <label for="pets_2" class="amenity_label"> 
                      <input class="amenities_input" value="2" id="pets_2" name="pets[]" type="checkbox" <?=in_array('2', $pets)?'checked':''?> /> 
                      개
                    </label> 
                    <label for="pets_3" class="amenity_label"> 
                      <input class="amenities_input" value="3" id="pets_3" name="pets[]" type="checkbox" <?=in_array('3', $pets)?'checked':''?> /> 
                      고양이
                    </label> 
                    <label for="pets_4" class="amenity_label"> 
                      <input class="amenities_input" value="4" id="pets_4" name="pets[]" type="checkbox" <?=in_array('4', $pets)?'checked':''?>/> 
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
      <span class="address"><?=$room->address?></span> 
    </h3> 
    <div class="map-pane" id="private-map"></div> 
  </div> 
  <div class="map-view"> 
    <h3 class="map-description public"> 
      <span class="icon"></span>Public View
        <span class="address editing" style="display: none;"><em>편집중...</em></span> 
      <span class="address full" data-message-refresh="새로고침하여 업데이트 된 주소를 확인하세요. "><?=$room->address?></span>
         <p><em>This is how your address appears on your public listing</em></p> 
    </h3> 
    <div class="map-pane" id="public-map"></div> 
  </div>  
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
		    if(!$('#pets_1').is(':checked')) {
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
		    fuzzyCoords: new google.maps.LatLng(<?php echo $room->lat_fuzzy.', '.$room->lng_fuzzy?>),
		    accuracy: 8,
		    supportContent: "<p><strong><?php echo $room->address?></strong></p><p>Please contact <a href=\"<?=site_url('home/contact')?>\">Airbnb support</a> to change this address.</p>"
		  });
		});
 
 		jQuery(document).ready(function() {
			Airbnb.init({userLoggedIn: <?=$this->tank_auth->is_logged_in()?>});
		});
	</script> 
</html> 
 