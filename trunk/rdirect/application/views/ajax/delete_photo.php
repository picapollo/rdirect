<?php header("Content-Type: text/javascript");?>
jQuery('#photo_<?=$pid_old?>').fadeOut(2000);
setTimeout(function(){Element.remove('photo_<?=$pid_old?>')}, 1000)
<?php if($pid_new): ?>
wait_for_upload();
select_picture_thumbnail('<?=$pid_new?>');
new Ajax.Updater('current_photo', '/rooms/ajax_update_current_photo?hosting_id=<?=$rid?>&picture_id=<?=$pid_new?>', {asynchronous:true, evalScripts:true, onComplete:function(request){upload_complete();}});
jQuery('#sortable_photos_status_message').hide().html('<span class="good">Photo was deleted successfully!</span>').fadeIn(2000); setTimeout(function(){ jQuery('#sortable_photos_status_message').fadeOut(2000) }, 8000);
<?php else: ?>
Element.update("current_photo", "Your photo has been deleted. You may upload a new photo (directly above this box).");
<?php endif; ?>
fetch_progress_bar_data(<?=$rid?>);
