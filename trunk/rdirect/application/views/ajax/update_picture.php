<?php header("Content-type: text/javascript");?>
jQuery('#update_caption_submit_button').attr('value', 'Saved!').animate({
	color : '#65b300'
}, 'fast');
setTimeout(function() { jQuery('#update_caption_submit_button').attr('value', 'Save').animate({
		color : '#000000'
	}, 'slow');
}, 2000)