<img alt="Large" height="242" src="<?=insert_room_photo($pid, 'large')?>" width="340" />
<form action="<?=site_url('pictures/ajax_update_picture')?>" method="post" onsubmit="new Ajax.Request('<?=site_url('pictures/ajax_update_picture')?>', {asynchronous:true, evalScripts:true, parameters:Form.serialize(this)}); return false;">    <input id="hosting_id" name="hosting_id" type="hidden" value="<?=$rid?>" />
    <input id="picture_id" name="picture_id" type="hidden" value="<?=$pid?>" />
    <input type="text" size="20" name="picture[caption]" id="picture_caption" value="<?=($caption==null)?'Add a caption..':$caption?>" onfocus="if($('picture_caption').value == 'Add a caption...'){$('picture_caption').value = '';}" />
    <input id="update_caption_submit_button" name="commit" onclick="if($('picture_caption').value =='Add a caption...'){alert('You only need to click Save if you are adding or editing a caption. Please enter your own caption before clicking save.'); return false;}" type="submit" value="Save" />
</form><a href="#" onclick="if (confirm('Are you sure you want to delete this photo from your listing?')) { new Ajax.Request('/rooms/ajax_delete_photo?hosting_id=180203&amp;picture_id=1165252', {asynchronous:true, evalScripts:true}); }; return false;"><img alt="Delete_minus" src="http://s0.muscache.com/1300304855/images/icons/delete_minus.png" /> Delete Photo And Caption</a>
