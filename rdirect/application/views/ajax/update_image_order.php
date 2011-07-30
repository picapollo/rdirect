<?php header("Content-type: text/javascript");?>
jQuery('#sortable_photos_status_message').hide().html('<span class="good">Saved</span>').fadeIn(1000);
setTimeout(function() { jQuery('#sortable_photos_status_message').fadeOut(2000)
}, 2000)