<body>
<div id="header" class="clearfix">
	<a id="logo" href="<?=base_url();?>" title="Airbnb.com Home">
	<img alt="Airbnb - Travel like a human." border="0" height="45" src="http://s2.muscache.com/1309460642/images/logos/109x45.png" width="109">
	</a>
	<a href="<?=site_url('rooms/new');?>" class="rounded hide_when_printing" id="list-your-space"><?=lang('top_menu_new_room');?></a>
	<ul id="utilities">
<?php if($this->tank_auth->is_logged_in()): ?>
		<li class="first-child">
			<?=lang('top_menu_hello', $this->tank_auth->get_username())?>&nbsp;&nbsp;&nbsp;&nbsp;
			<?=anchor('home/dashboard', lang('top_menu_dashboard'));?>
		</li>
		<li style="border:none;">
			<ul class="notification_bar">
				<li id="star-indicator" <?php if(!$starred) echo 'style="display: none;"'?>>
					<a href="<?=site_url('search?starred=true')?>" class="notification_icon starred" title="<?=lang('top_menu_starred_items')?>"> <span style="width: 1px; margin-right: -5px;">&nbsp;</span> <span id="star_count" class="alert_count"><?=count($starred)?></span> </a>
				</li>
			</ul>
		</li>	
	
		<li>
			<?=anchor('auth/logout', lang('top_menu_logout'));?>
		</li>
<?php else: ?>
		<li class="first-child">
			<?=anchor('signup_login', lang('top_menu_sign_up'));?>
		</li>
		<li>
			<?=anchor('login', lang('top_menu_sign_in'));?>
		</li>
<?php endif; ?>
		<li style="border-right:1px solid #DDD;">
			<?=anchor('#', lang('top_menu_how_it_works'));?>
		</li>
		<li style="border-left:none;" class="last-child">
			<div id="language_currency">
				<div id="language_currency_display" class="rounded_top">
					<div id="language_currency_display_language" class="flag sprite-<?=CURRENT_LANGUAGE?>">
						&nbsp;
					</div>
					<div id="language_currency_display_currency">
						<?=CURRENT_CURRENCY_SYMBOL.' '.CURRENT_CURRENCY?>
					</div>
				</div>
				<div id="language_currency_selector_container" class="rounded" style="display:none;">
					<ul id="language_currency_selector">
						<li class="instruction">
							<?=lang('top_menu_choose_language')?>
						</li>
						<?php foreach($this->config->item('supported_languages') as $lang_code => $item):?>
						<li class="language option" id="language_selector_<?=$lang_code?>" name="<?=$lang_code?>">
							<div class="flag sprite-<?=$lang_code?>">
								&nbsp;
							</div>
							<div style="display:inline;padding-left:24px;">
								<?=$item['name']?>
							</div>
						</li>
						<?php endforeach; ?>
						<li class="dash">
							&nbsp;
						</li>
						<li class="instruction">
							<?=lang('top_menu_choose_currency')?>
						</li>
						<?php foreach($this->config->item('supported_currency') as $k => $i): ?>
						<li class="currency option" id="currency_selector_<?=$k?>" name="<?=$k?>">
							<?=$i['symbol'].' '.$k?>
						</li>
						<?php endforeach; ?>
					</ul><!-- LANGUAGE_CURRENCY_SELECTOR -->
				</div><!-- LANGUAGE_CURRENCY_SELECTOR_CONTAINER -->
			</div><!-- LANGUAGE_CURRENCY -->
		</li>
	</ul><!-- UTILITIES -->
</div><!-- HEADER -->
<?php
	$notice = $this->session->userdata('notice');
	
	if($notice){
		echo '<div id="notice">' . $notice . '</div>';
	}
	$this->session->unset_userdata('notice');

	/*if( count($notice) > 0 ){
		echo '<div id="notice">';
		foreach($notice as $i){
			echo $i.'<br>';
		}
		echo '</div>';
	}*/
?>