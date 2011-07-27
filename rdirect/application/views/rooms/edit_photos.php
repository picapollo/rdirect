<?php
	$this->load->view('header/edit_listing', $header);
	$this->load->view('top_menu', array('starred'=>$starred));
?>

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
 
                    <form target="upload_frame" action="<?=site_url('rooms/ajax_hosting_image_upload')?>" id="ajax_upload_form" name="ajax_upload_form" method="post" enctype="multipart/form-data"> 
                        <input id="hosting_id" name="hosting_id" type="hidden" value="<?=$room->id?>" /> 
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
        </div> 
                    <p>메인사진이 들어가는 위치. 사진을 클릭하고 드래그하여 순서를 바꾸세요.</p> 
                </div> 
                </div> 
            </div> 
            <div class="row top-border"> 
            <div id="left_side" class="col half rounded"> 
            <div class="photo-padding"> 
                <div id="current_photo_container" style="position:relative"> 
                    <img id="spinner" src="<?=IMG_DIR?>/blue_spinner.gif" height="16" width="16" style="position:absolute; top:25%; left:50%; margin-top:-8px; margin-left:-8px; display:none;" /> 
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
Sortable.create("sortable_photos", {constraint:false, onUpdate:function(){new Ajax.Request('<?=site_url('rooms/ajax_update_image_order?hosting_id='.$room->id)?>', {asynchronous:true, evalScripts:true, parameters:Sortable.serialize("sortable_photos")})}, overlap:'horizontal', scroll:false})
//]]>
</script> 
</div> 
 
      </div> 
    </div> 
  </div> 
  <div class="clear"></div> 
</div><!-- edit_room --> 
 
<?php $this->load->view('footer', array('no_closing')); ?>

 	<script type="text/javascript">
		jQuery(document).ready(function() {
			Airbnb.init({userLoggedIn: <?=$this->tank_auth->is_logged_in()?>});
		});
	</script>  
</html> 
 