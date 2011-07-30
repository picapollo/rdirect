<div id="dashboard_v2"> 
 
  <div class="row"> 
    <div class="col full heading"> 
      <div class="heading_content"> 

<div class="edit_listing_photo"><a href="<?=site_url('rooms/'.$room->id)?>"><img alt="<?=($room->photo_id)?'small':'Room_default_no_photos'?>" height="65" src="<?=insert_room_photo($room->photo_id, 'small')?>" /></a></div> 
 
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

<?php //TODO if(progress < 1): ?>
    <div id="listing_progress" style=""> 
        <span id="progress_text" class="pink_text">
          Your listing is 60% of the way to being active.
        </span> 
        <div id='progress_bar'><div id="creamy_bar_filling" class="filled_60"></div></div> 
        <ul id="next_steps"> 
               <li> 
                    <a class="step_link" href="/rooms/<?=$room->id?>/edit?fragment=multilingual_description_container" title="Write a description at least 200 letters long"> 
                        Write a description at least 200 letters long
                    </a> 
                    <span class="plus_percent">(+15%)</span> 
               </li> 
               <li> 
                    <a class="step_link" href="/rooms/<?=$room->id?>/edit?section=photos" title="Upload a photo"> 
                        Upload a photo
                    </a> 
                    <span class="plus_percent">(+25%)</span> 
               </li> 
        </ul> 
    </div> 
<?php //endif; ?>
 
<div class="clear"></div> 

      </div> 
    </div> 
  </div> 
  <div class="row"> 
    <div class="col one-fourth nav"> 
      <a href="/rooms" class="to-parent">등록된 모든 객실 보기</a> 
      <div class="nav-container"> 
        <ul class="edit_room_nav">
        	<li <?php if($selected=='details') echo 'class="selected"';?>>
        		<a class="details" href="/rooms/<?=$room->id?>/edit?section=details"><span class="icon"></span>설명:</a>
        	</li>
        	<li <?php if($selected=='photos') echo 'class="selected"';?>>
        		<a class="photos" href="/rooms/<?=$room->id?>/edit?section=photos"><span class="icon"></span>사진</a>
        	</li>
        	<li <?php if($selected=='calendar') echo 'class="selected"';?>>
        		<a class="calendar" href="/calendar/single/<?=$room->id?>"><span class="icon"></span>달력</a>
        	</li>
        	<li <?php if($selected=='pricing') echo 'class="selected"';?>>
        		<a class="pricing" href="/hosting/pricing?hosting_id=<?=$room->id?>"><span class="icon"></span>가격 및 조건</a>
        	</li>
        </ul> 
      </div> 
    </div> 