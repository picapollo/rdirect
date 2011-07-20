<html>
	<script>
		var loc = document.location;
		
		with(window.parent) 
		{ 
			setTimeout(
				function()
				{ 
					window.eval(
<?php if(isset($user_profile_image)): ?>
					'$(\'ajax_upload_container\').fade({duration:2.0});' + 
					'Element.update(\'user_pic\', \'<div id="edit_image_hover" style="display:none;" onclick="show_ajax_image_box();"><p>Change your Photo</p></div>\\n<img alt="<?=$username?>" height="209" src="<?=$user_profile_image?>" title="<?=$username?>" width="209" />\');' + 
<?php endif; ?>		
					'Element.update("<?=$feedback_type?>", "<p class=\\\"<?=$message_type?>\\\"><?php print_r($message_content)?></p>");' +
					'<?=$callback_function?>();');
					/* loc.replace('about:blank'); */
				}
				, 1
			)
		}
			</script></body>
</html>