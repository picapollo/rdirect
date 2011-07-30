<?php $this->load->view('header/edit_listing', $header); ?>
<script type="text/javascript">jQuery.noConflict();</script> 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/prototype/1.6.0.3/prototype.js"></script> 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/scriptaculous/1.8.2/scriptaculous.js"></script>

<?php	
	$this->load->view('top_menu', array('starred'=>$starred));
	$this->load->view('rooms/edit_nav', array('selected' => 'photos', 'room' => $room, 'sig' => $sig));
?>

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
                        <input id="new_photo_image" name="userfile" onchange="$('upload_feedback').innerHTML = '&lt;p class=&quot;good&quot;&gt;사진 업로드중...&lt;/p&gt;'; wait_for_upload(); $('ajax_upload_form').submit(); return false;" size="24" type="file" /> 
                    </form> 
 
                    <iframe id="upload_frame" name="upload_frame" style="display:none;"></iframe> 
 
                    <div id="upload_feedback"></div> 
        <p>객실사진은 최대 100장까지 업로드 할 수 있습니다.<br/> 
                    640x425 픽셀, 2MB 이하의 사진을 권장합니다. </p> 
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
                    		<?php if(empty($photos)): ?>
                            <p style="font-size:16px; padding:5px; color:#333333; font-weight:bold;">안녕? 아직 사진을 안올린것 같은데 위에 있는 업로더로 시작해봐!</p>
                            <?php endif; ?> 
                    </div> 
                </div> 
            </div> 
            </div> 
            <div id="right_side" class="col half rounded"> 
            <div class="photo-padding"> 
                <div id="all_photos"> 
                    <ul id="sortable_photos" style="float:left;">
                    	<?php foreach($photos as $photo):?> 
						<li class="photo" id="photo_<?=$photo->id?>" style="position: relative; ">
						    <img alt="Mini_square" height="40" src="<?=insert_room_photo($photo->id, 'mini_square')?>" width="40">
						    <br>
						      <a href="#" onclick="select_picture_thumbnail('<?=$photo->id?>'); new Ajax.Updater('current_photo', '/rooms/ajax_update_current_photo?hosting_id=<?=$room->id?>&amp;picture_id=<?=$photo->id?>', {asynchronous:true, evalScripts:true}); return false;">Edit</a>
						</li>                    	
						<?php endforeach; ?>
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
            <?php 
            if( ! empty($photos))
            {
            	echo "wait_for_upload();";
	            echo "new Ajax.Updater('current_photo', '/rooms/ajax_update_current_photo?hosting_id={$room->id}&picture_id={$photos[0]->id}', {asynchronous:true, evalScripts:true, onComplete:function(request){upload_complete();}});";
			}
            ?>
		});
	</script>  
</html> 
 