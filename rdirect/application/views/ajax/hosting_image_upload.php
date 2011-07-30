<html><body><script type='text/javascript' charset='utf-8'>
var loc = document.location;
with(window.parent) { setTimeout(function() {
	<?php if(isset($error)): ?>
	window.eval('upload_complete()\nElement.update(\"upload_feedback\", \"<p class=\\\"bad\\\"><?=$error?></p>\");');
	<?php else: ?>
	window.eval('upload_complete()\nElement.update(\"current_photo\", \"<img alt=\\\"Small\\\" height=\\\"242\\\" src=\\\"<?=$picture_small?>\\\" width=\\\"340\\\" />\\n<a href=\\\"#\\\" onclick=\\\"new Ajax.Request(\'/rooms/ajax_delete_photo?hosting_id=<?=$rid?>&amp;picture_id=<?=$pid?>\', {asynchronous:true, evalScripts:true}); return false;\\\">Delete this Photo</a>\\n\");\nElement.insert(\"sortable_photos\", { bottom: \"<li class=\\\"photo\\\" id=\\\"photo_<?=$pid?>\\\">\\n    <img alt=\\\"Mini_square\\\" height=\\\"40\\\" src=\\\"<?=$picture_mini_square?>\\\" width=\\\"40\\\" />\\n    <br />\\n      <a href=\\\"#\\\" onclick=\\\"select_picture_thumbnail(\'<?=$pid?>\'); new Ajax.Updater(\'current_photo\', \'/rooms/ajax_update_current_photo?hosting_id=<?=$rid?>&amp;picture_id=<?=$pid?>\', {asynchronous:true, evalScripts:true}); return false;\\\">Edit</a>\\n</li>\\n<script type=\\\"text/javascript\\\">\\n    select_picture_thumbnail(\'<?=$pid?>\');\\n</scr"+"ipt>\\n\" });\nwait_for_upload();\nnew Ajax.Updater(\'current_photo\', \'/rooms/ajax_update_current_photo?hosting_id=<?=$rid?>&picture_id=<?=$pid?>\', {asynchronous:true, evalScripts:true, onComplete:function(request){upload_complete();}});\n                  \nSortable.create(\'sortable_photos\', {constraint:false, onUpdate:function(){new Ajax.Request(\'/rooms/ajax_update_image_order?hosting_id=<?=$rid?>\', {asynchronous:true, evalScripts:true, parameters:Sortable.serialize(\'sortable_photos\')})}, overlap:\'horizontal\', scroll:false})\nfetch_progress_bar_data(<?=$rid?>);\nElement.update(\"upload_feedback\", \"<p class=\\\"good\\\">Success! Why not upload another?</p>\");');
	<?php endif;?>
		/* loc.replace('about:blank'); */
	}, 1)
}
</script></body></html>