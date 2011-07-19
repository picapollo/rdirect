<div id="header" class="clearfix">
	<a id="logo" href="<?=base_url();?>" title="Airbnb.com Home">
	<img alt="Airbnb - Travel like a human." border="0" height="45" src="http://s2.muscache.com/1309460642/images/logos/109x45.png" width="109">
	</a>
	<a href="<?=site_url('room/new');?>" class="rounded hide_when_printing" id="list-your-space">List your space</a>
	<ul id="utilities">
<?php if($this->tank_auth->is_logged_in()): ?>
		<li class="first-child">
			<?=anchor('home/dashboard', 'Dashboard');?>
		</li>
		<li>
			<?=anchor('auth/logout', 'Log Out');?>
		</li>
<?php else: ?>
		<li class="first-child">
			<?=anchor('signup_login', 'Sign Up');?>
		</li>
		<li>
			<?=anchor('login', 'Sign In');?>
		</li>
<?php endif; ?>
		<li>
			<?=anchor('jobs', 'We\'re Hiring!');?>
		</li>
		<li style="border-right:1px solid #DDD;">
			<?=anchor('#', 'How it works');?>
		</li>
		<li style="border-left:none;" class="last-child">
			<div id="language_currency">
				<div id="language_currency_display" class="rounded_top">
					<div id="language_currency_display_language" class="flag sprite-en">
						&nbsp;
					</div>
					<div id="language_currency_display_currency">
						$ USD
					</div>
				</div>
				<div id="language_currency_selector_container" class="rounded" style="display:none;">
					<ul id="language_currency_selector">
						<li class="instruction">
							Choose language...
						</li>
						<li class="language option" id="language_selector_de" name="de">
							<div class="flag sprite-de">
								&nbsp;
							</div>
							<div style="display:inline;padding-left:24px;">
								Deutsch
							</div>
						</li>
						<li class="language option" id="language_selector_es" name="es">
							<div class="flag sprite-es">
								&nbsp;
							</div>
							<div style="display:inline;padding-left:24px;">
								Español
							</div>
						</li>
						<li class="language option" id="language_selector_fr" name="fr">
							<div class="flag sprite-fr">
								&nbsp;
							</div>
							<div style="display:inline;padding-left:24px;">
								Français
							</div>
						</li>
						<li class="language option" id="language_selector_it" name="it">
							<div class="flag sprite-it">
								&nbsp;
							</div>
							<div style="display:inline;padding-left:24px;">
								Italiano
							</div>
						</li>
						<li class="language option" id="language_selector_pt" name="pt">
							<div class="flag sprite-pt">
								&nbsp;
							</div>
							<div style="display:inline;padding-left:24px;">
								Português
							</div>
						</li>
						<li class="language option" id="language_selector_ru" name="ru">
							<div class="flag sprite-ru">
								&nbsp;
							</div>
							<div style="display:inline;padding-left:24px;">
								Русский
							</div>
						</li>
						<li class="language option" id="language_selector_zh" name="zh">
							<div class="flag sprite-zh">
								&nbsp;
							</div>
							<div style="display:inline;padding-left:24px;">
								中文(简体)
							</div>
						</li>
						<li class="language option" id="language_selector_ko" name="ko">
							<div class="flag sprite-ko">
								&nbsp;
							</div>
							<div style="display:inline;padding-left:24px;">
								한국어
							</div>
						</li>
						<li class="dash">
							&nbsp;
						</li>
						<li class="instruction">
							Choose currency...
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