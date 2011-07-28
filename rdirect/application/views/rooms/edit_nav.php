<div id="dashboard_v2"> 
 
  <div class="row"> 
    <div class="col full heading"> 
      <div class="heading_content"> 

<div class="edit_listing_photo"><a href="<?=site_url('rooms/'.$room->id)?>"><img alt="<?php //TODO ?>Room_default_no_photos" height="65" src="http://s1.muscache.com/1308680853/images/page3/v3/room_default_no_photos.png" /></a></div> 
 
<div class="listing_info"> 
  <h3><?=anchor('rooms/'.$room->id, $room->name, array('id'=>'listing_title_banner'))?></h3> 
  <span class="actions"> 
    <div class="set-availability action_button" data-has-availability="<?php echo ($room->active=='1')?'true':'false'?>" data-available-url="<?=site_url('rooms/change_availability/'.$room->id.'?is_available=1&redirect=%2Frooms&sig='.$sig)?>" data-unavailable-url="<?=site_url('rooms/change_availability/'.$room->id.'?is_available=0&redirect=%2Frooms&sig='.$sig)?>"></div> 
 
    <span class="action_button"> 
      <a href="<?=site_url('rooms/'.$room->id)?>" class="icon view" target="_NEW">등록된 객실 보기</a> 
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
        <ul class="edit_room_nav"><li class="selected"><a class="details" href="/rooms/181683/edit?section=details"><span class="icon"></span>설명:</a><li ><a class="photos" href="/rooms/181683/edit?section=photos"><span class="icon"></span>사진</a><li ><a class="calendar" href="/calendar/single/181683"><span class="icon"></span>달력</a><li ><a class="pricing" href="/hosting/pricing?hosting_id=181683"><span class="icon"></span>가격 및 조건</a></ul> 
      </div> 
    </div> 