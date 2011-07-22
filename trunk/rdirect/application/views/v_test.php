<html>
	<head>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
		<script type="text/javascript">
		var base_url = '<?=base_url();?>';
		

		</script>
		<script type="text/javascript" src="http://localhost.com/temp.js"></script>
	</head>
	<body>
		<p id="res"><?=$this->config->item('base_url')?></p>
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
		</ul>
	</body>
</html>