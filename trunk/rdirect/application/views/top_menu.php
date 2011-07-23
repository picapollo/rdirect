<body>
<div id="header" class="clearfix">
	<a id="logo" href="<?=base_url();?>" title="Airbnb.com Home">
	<img alt="Airbnb - Travel like a human." border="0" height="45" src="http://s2.muscache.com/1309460642/images/logos/109x45.png" width="109">
	</a>
	<a href="<?=site_url('room/new');?>" class="rounded hide_when_printing" id="list-your-space"><?=lang('top_menu_new_room');?></a>
	<ul id="utilities">
<?php if($this->tank_auth->is_logged_in()): ?>
		<li class="first-child">
			<?=anchor('home/dashboard', lang('top_menu_dashboard'));?>
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
					<div id="language_currency_display_language" class="flag sprite-<?=$locale?>">
						&nbsp;
					</div>
					<div id="language_currency_display_currency">
						$ USD
					</div>
				</div>
				<div id="language_currency_selector_container" class="rounded" style="display:none;">
					<ul id="language_currency_selector">
						<li class="instruction">
							<?=lang('top_menu_choose_language')?>
						</li>
						<?php foreach($this->config->item('supported_languages') as $lang_code => $item):?>
						<?php if($lang_code == $locale) continue; ?>
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
						<li class="currency option" id="currency_selector_AUD" name="AUD">
							$ AUD
						</li>
						<li class="currency option" id="currency_selector_BRL" name="BRL">
							R$ BRL
						</li>
						<li class="currency option" id="currency_selector_CAD" name="CAD">
							$ CAD
						</li>
						<li class="currency option" id="currency_selector_CHF" name="CHF">
							CHF CHF
						</li>
						<li class="currency option" id="currency_selector_CZK" name="CZK">
							Kč CZK
						</li>
						<li class="currency option" id="currency_selector_DKK" name="DKK">
							kr DKK
						</li>
						<li class="currency option" id="currency_selector_EUR" name="EUR">
							€ EUR
						</li>
						<li class="currency option" id="currency_selector_GBP" name="GBP">
							£ GBP
						</li>
						<li class="currency option" id="currency_selector_HKD" name="HKD">
							$ HKD
						</li>
						<li class="currency option" id="currency_selector_HUF" name="HUF">
							Ft HUF
						</li>
						<li class="currency option" id="currency_selector_ILS" name="ILS">
							₪ ILS
						</li>
						<li class="currency option" id="currency_selector_JPY" name="JPY">
							¥ JPY
						</li>
						<li class="currency option" id="currency_selector_NOK" name="NOK">
							kr NOK
						</li>
						<li class="currency option" id="currency_selector_RUB" name="RUB">
							руб RUB
						</li>
						<li class="currency option" id="currency_selector_SEK" name="SEK">
							kr SEK
						</li>
						<li class="currency option" id="currency_selector_ZAR" name="ZAR">
							R ZAR
						</li>
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