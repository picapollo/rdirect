<?php $this->load->view('header/common', $header) ?>
<link href="<?=CSS_DIR?>/post_room.css" media="screen" rel="stylesheet" type="text/css" />
<?php if(CURRENT_LANGUAGE != 'en'): ?>
<script src="<?=JS_DIR?>/jquery.ui.datepicker/jquery.ui.datepicker-<?=CURRENT_LANGUAGE?>.min.js" type="text/javascript"></script>
<?php endif;?>
<script src="<?=JS_DIR?>/libphonenumber.compiled.js" type="text/javascript"></script>
<script src="<?=JS_DIR?>/jquery.validatedphone.js" type="text/javascript"></script>
<script src="<?=JS_DIR?>/post_room.js?<?=time()?>" type="text/javascript"></script>
<script src="<?=JS_DIR?>/tooltips_good.js" type="text/javascript"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?v=3.5&amp;sensor=false"></script>
<?php $this->load->view('top_menu', array('starred'=>$this->data['starred'])); ?>

<div class="narrow_page_bg rounded_most">
<form action="<?=site_url('rooms/update?sig='.$sig)?>" enctype="multipart/form-data" id="new_room_form" method="post">		<input id="redirect_params_sig" name="redirect_params[sig]" type="hidden" />
<input id="redirect_params_action" name="redirect_params[action]" type="hidden" value="set_user" />
<input id="redirect_params_new_hosting" name="redirect_params[new_hosting]" type="hidden" value="1" />
<input id="redirect_params_id" name="redirect_params[id]" type="hidden" />

		<input id="retry_params_sig" name="retry_params[sig]" type="hidden" />
<input id="retry_params_action" name="retry_params[action]" type="hidden" value="create" />
<input id="retry_params_id" name="retry_params[id]" type="hidden" />


		<div id="post_a_room" class="rounded_more drop_shadow_standard">
			<div id="post_a_room_header" class="rounded_top">
				<a id="how_it_works_vid_screenshot" target="_blank" href="/info/how_it_works">
					<img src="<?=IMG_DIR?>/post_a_room/watch_how_it_works_small.jpg" height="125" width="210" alt="Watch How it Works" />
				</a>
				<h1>회원님의 공간을 목록에 올리기.</h1>
				<h2>
					에어비앤비에서 방을 빌려줘서 돈을 벌 수 있습니다. 방만 있으면 돈이 생겨요!
					<a href="/info/why_host" class="learn_more" target="_blank">더 알아보기.</a>
				</h2>
			</div>
			<div class="narrow_page_section post_room_step1 rounded_more">
  <h2 class="rounded_top">
    주소를 찾으세요
    <span class="header-badge protected-badge"><span>보호되었습니다.</span><b></b></span>
  </h2>
  <p class="header_description">
      연락처와 주소는 승인한 게스트에게만 공개됩니다. 다른 사람들에게는 비공개입니다. 
  </p>
  <div id="" class="narrow_page_section_content rounded_bottom">
    <div id="address_section">
    <div id="address_step1">
        <label id="location_search_label" class="tall_label" for="location_search">
            주소:
        </label>
        <input type="text" class="location active" autocomplete="off" id="location_search" name="location_search" />
    </div>

    <div id="way_too_vague" class="vague_address_warning rounded" style="display:none">
        <p>어머나! 선택하신 주소가 구체적이지 않네요. 번지 수까지 포함해서 주소를 입력해 보세요. <br /><br />계속해서 문제가 생기면 저희에게 연락주세요.  <a href="mailto:support@airbnb.com">support@airbnb.com</a></p>
    </div>
	<div id="didyoumean" style="display:none">
		<p>Did you mean:</p>
		<ul id="didyoumean-addresses"></ul>
	</div>
    <div id="address_step2">
        <div id="map_container">
            <div id="map_canvas"></div>
            <div id="step1_extras" style="display:none;">
                <div id="selected_address">
                    <p id="your_address"><b class="header-badge protected-badge"><b></b></b>Your new listing's address:</p>
                    <ul id="address_container">
                        <li id="formatted_address"></li>
                        <li>
                            <label for="address_apt" style="display:none;" class="inner_text">아파트/다세대 등일 경우 호수</label>
                            <input class="medium" id="address_apt" name="address[apt]" size="30" style="margin-top: 14px; width: 254px;" type="text" />
                        </li>
						<li id="exact_address_prompt">
							<p>정확한 주소인가요?</p>
							<input type="radio" name="exact_address" id="exact_address_1" value="yes" checked="checked">
							<label for="exact_address_1"><b>네</b> &mdash; 정확한 주소입니다. </label><br />
							<input type="radio" name="exact_address" id="exact_address_2" value="no">
							<label for="exact_address_2"><b>No</b> &mdash; this is the closest I can get, I need to give directions</label>
						</li>
                    </ul>
                </div>
            </div>
			<div class="contact_info_section_field" style="padding-top:15px; display:none;">
				<label for="hosting_directions" class="tall_label"><b class="header-badge protected-badge"><b></b></b>찾아 오는 길 설명:</label>
				<textarea class="active" cols="40" disabled="disabled" id="hosting_directions" name="hosting[directions]" rows="8" style="height:auto; width: 380px;"></textarea>
			</div>
        </div>

        <ul id="location">
                <input id="address_formatted_address_native" name="address[formatted_address_native]" type="hidden" />
                <input id="address_lat" name="address[lat]" type="hidden" />
                <input id="address_lng" name="address[lng]" type="hidden" />
				<input disabled="disabled" id="address_user_defined_location" name="address[user_defined_location]" type="hidden" value="true" />
        </ul>
    </div>
</div>

    <div id="contact_info_section" class="get_started_subsection" style="display:none;">
    	<?php if( ! $this->tank_auth->is_logged_in()): ?>
		<div class="contact_info_section_field">
	        <label for="hosting_email"><b class="header-badge protected-badge"><b id=""></b></b>이메일 주소:</label>
	        <input class="large active" id="hosting_email" name="hosting[email]" size="30" type="text">
      	</div>
        <div class="contact_info_section_field">
        <label for="hosting_phone"><b class="header-badge protected-badge"><b></b></b>휴대폰번호:
          <a class="tooltip" title="주 연락처 (유선/무선)&lt;br /&gt;
주인장이 예약요청을 수락하신 후 여행객에게 전송됩니다."><img alt="Questionmark_hover" src="<?=IMG_DIR?>/icons/questionmark_hover.png" style="width:; height:;" /></a>
        </label>
        <select id="hosting_phone_country_selector" style="display:none;float:none;">
          <option value="">Unspecified</option>
<option value="AF">Afghanistan</option>
<option value="AL">Albania</option>
<option value="DZ">Algeria</option>
<option value="AS">American Samoa</option>
<option value="AD">Andorra</option>
<option value="AO">Angola</option>
<option value="AI">Anguilla</option>
<option value="AQ">Antarctica</option>
<option value="AG">Antigua and Barbuda</option>
<option value="AR">Argentina</option>
<option value="AM">Armenia</option>
<option value="AW">Aruba</option>
<option value="AU">Australia</option>
<option value="AT">Austria</option>
<option value="AZ">Azerbaijan</option>
<option value="BS">Bahamas</option>
<option value="BH">Bahrain</option>
<option value="BD">Bangladesh</option>
<option value="BB">Barbados</option>
<option value="BY">Belarus</option>
<option value="BE">Belgium</option>
<option value="BZ">Belize</option>
<option value="BJ">Benin</option>
<option value="BM">Bermuda</option>
<option value="BT">Bhutan</option>
<option value="BO">Bolivia</option>
<option value="BA">Bosnia</option>
<option value="BW">Botswana</option>
<option value="BV">Bouvet Island</option>
<option value="BR">Brazil</option>
<option value="IO">British Indian Ocean Territory</option>
<option value="BN">Brunei Darussalam</option>
<option value="BG">Bulgaria</option>
<option value="BF">Burkina Faso</option>
<option value="BI">Burundi</option>
<option value="KH">Cambodia</option>
<option value="CM">Cameroon</option>
<option value="CA">Canada</option>
<option value="CV">Cape Verde</option>
<option value="KY">Cayman Islands</option>
<option value="CF">Central African Republic</option>
<option value="TD">Chad</option>
<option value="CL">Chile</option>
<option value="CN">China</option>
<option value="CX">Christmas Island</option>
<option value="CC">Cocos (Keeling) Islands</option>
<option value="CO">Colombia</option>
<option value="KM">Comoros</option>
<option value="CG">Congo</option>
<option value="CK">Cook Islands</option>
<option value="CR">Costa Rica</option>
<option value="CI">Cote D'ivoire</option>
<option value="HR">Croatia</option>
<option value="CU">Cuba</option>
<option value="CY">Cyprus</option>
<option value="CZ">Czech Republic</option>
<option value="DK">Denmark</option>
<option value="DJ">Djibouti</option>
<option value="DM">Dominica</option>
<option value="DO">Dominican Republic</option>
<option value="EC">Ecuador</option>
<option value="EG">Egypt</option>
<option value="SV">El Salvador</option>
<option value="GQ">Equatorial Guinea</option>
<option value="R">Eritrea</option>
<option value="EE">Estonia</option>
<option value="ET">Ethiopia</option>
<option value="FK">Falkland Islands (Malvinas)</option>
<option value="FO">Faroe Islands</option>
<option value="FJ">Fiji</option>
<option value="FI">Finland</option>
<option value="FR">France</option>
<option value="GF">French Guiana</option>
<option value="PF">French Polynesia</option>
<option value="TF">French Southern Territories</option>
<option value="GA">Gabon</option>
<option value="GM">Gambia</option>
<option value="GE">Georgia</option>
<option value="DE">Germany</option>
<option value="GH">Ghana</option>
<option value="GI">Gibraltar</option>
<option value="GR">Greece</option>
<option value="GL">Greenland</option>
<option value="GD">Grenada</option>
<option value="GP">Guadeloupe</option>
<option value="GU">Guam</option>
<option value="GT">Guatemala</option>
<option value="GN">Guinea</option>
<option value="GW">Guinea-bissau</option>
<option value="GY">Guyana</option>
<option value="HT">Haiti</option>
<option value="HM">Heard and Mc Donald Islands</option>
<option value="HN">Honduras</option>
<option value="HK">Hong Kong</option>
<option value="HU">Hungary</option>
<option value="IS">Iceland</option>
<option value="IN">India</option>
<option value="ID">Indonesia</option>
<option value="IR">Iran</option>
<option value="IQ">Iraq</option>
<option value="IE">Ireland</option>
<option value="IL">Israel</option>
<option value="IT">Italy</option>
<option value="JM">Jamaica</option>
<option value="JP">Japan</option>
<option value="JO">Jordan</option>
<option value="KZ">Kazakhstan</option>
<option value="KE">Kenya</option>
<option value="KI">Kiribati</option>
<option value="KR">South Korea</option>
<option value="XK">Kosovo</option>
<option value="KW">Kuwait</option>
<option value="KG">Kyrgyzstan</option>
<option value="LA">Lao</option>
<option value="LV">Latvia</option>
<option value="LB">Lebanon</option>
<option value="LS">Lesotho</option>
<option value="LR">Liberia</option>
<option value="LY">Libya</option>
<option value="LI">Liechtenstein</option>
<option value="LT">Lithuania</option>
<option value="LU">Luxembourg</option>
<option value="ME">Montenegro</option>
<option value="MO">Macau</option>
<option value="MK">Macedonia</option>
<option value="MG">Madagascar</option>
<option value="MW">Malawi</option>
<option value="MY">Malaysia</option>
<option value="MV">Maldives</option>
<option value="ML">Mali</option>
<option value="MT">Malta</option>
<option value="MH">Marshall Islands</option>
<option value="MQ">Martinique</option>
<option value="MR">Mauritania</option>
<option value="MU">Mauritius</option>
<option value="YT">Mayotte</option>
<option value="MX">Mexico</option>
<option value="FM">Micronesia</option>
<option value="MD">Moldova</option>
<option value="MC">Monaco</option>
<option value="MN">Mongolia</option>
<option value="MS">Montserrat</option>
<option value="MA">Morocco</option>
<option value="MZ">Mozambique</option>
<option value="MM">Myanmar</option>
<option value="NA">Namibia</option>
<option value="NR">Nauru</option>
<option value="NP">Nepal</option>
<option value="NL">Netherlands</option>
<option value="AN">Netherlands Antilles</option>
<option value="NC">New Caledonia</option>
<option value="NZ">New Zealand</option>
<option value="NI">Nicaragua</option>
<option value="NE">Niger</option>
<option value="NG">Nigeria</option>
<option value="NU">Niue</option>
<option value="NF">Norfolk Island</option>
<option value="MP">Northern Mariana Islands</option>
<option value="NO">Norway</option>
<option value="OM">Oman</option>
<option value="PK">Pakistan</option>
<option value="PW">Palau</option>
<option value="PA">Panama</option>
<option value="PG">Papua New Guinea</option>
<option value="PY">Paraguay</option>
<option value="PE">Peru</option>
<option value="PH">Philippines</option>
<option value="PN">Pitcairn</option>
<option value="PL">Poland</option>
<option value="PT">Portugal</option>
<option value="PR">Puerto Rico</option>
<option value="QA">Qatar</option>
<option value="RE">Reunion</option>
<option value="RO">Romania</option>
<option value="RS">Serbia</option>
<option value="RU">Russian Federation</option>
<option value="RW">Rwanda</option>
<option value="KN">Saint Kitts and Nevis</option>
<option value="LC">Saint Lucia</option>
<option value="VC">Saint Vincent and The Grenadines</option>
<option value="WS">Samoa</option>
<option value="SM">San Marino</option>
<option value="ST">Sao Tome and Principe</option>
<option value="SA">Saudi Arabia</option>
<option value="SN">Senegal</option>
<option value="SC">Seychelles</option>
<option value="SL">Sierra Leone</option>
<option value="SG">Singapore</option>
<option value="SK">Slovakia</option>
<option value="SI">Slovenia</option>
<option value="SB">Solomon Islands</option>
<option value="SO">Somalia</option>
<option value="ZA">South Africa</option>
<option value="ES">Spain</option>
<option value="LK">Sri Lanka</option>
<option value="SH">St. Helena</option>
<option value="PM">St. Pierre and Miquelon</option>
<option value="SD">Sudan</option>
<option value="SR">Suriname</option>
<option value="SJ">Svalbard and Jan Mayen Islands</option>
<option value="SZ">Swaziland</option>
<option value="SE">Sweden</option>
<option value="CH">Switzerland</option>
<option value="SY">Syrian Arab Republic</option>
<option value="TW">Taiwan</option>
<option value="TJ">Tajikistan</option>
<option value="TZ">Tanzania</option>
<option value="TH">Thailand</option>
<option value="TG">Togo</option>
<option value="TK">Tokelau</option>
<option value="TO">Tonga</option>
<option value="TT">Trinidad and Tobago</option>
<option value="TN">Tunisia</option>
<option value="TR">Turkey</option>
<option value="TM">Turkmenistan</option>
<option value="TC">Turks and Caicos Islands</option>
<option value="TV">Tuvalu</option>
<option value="UG">Uganda</option>
<option value="UA">Ukraine</option>
<option value="AE">United Arab Emirates</option>
<option value="GB">United Kingdom</option>
<option value="US">United States</option>
<option value="UY">Uruguay</option>
<option value="UZ">Uzbekistan</option>
<option value="VU">Vanuatu</option>
<option value="VA">Vatican City State</option>
<option value="VE">Venezuela</option>
<option value="VN">Viet Nam</option>
<option value="VG">Virgin Islands (British)</option>
<option value="VI">Virgin Islands (U.S.)</option>
<option value="WF">Wallis and Futuna Islands</option>
<option value="EH">Western Sahara</option>
<option value="YE">Yemen</option>
<option value="ZM">Zambia</option>
<option value="ZW">Zimbabwe</option>
        </select>
        
        <input autocomplete="off" class="medium active" id="hosting_phone" name="hosting[phone]" size="30" type="text" />
        <input id="hosting_phone_country" name="hosting[phone_country]" type="hidden" />
      </div>
      <?php endif; ?>
    </div>
  </div>
</div>

			<div class="narrow_page_section post_room_step2 rounded_more">
	<h2 class="rounded_top">
		상세정보
		<span class="header-badge public-badge"><span>공공의</span><b></b></span>
	</h2>
	<p class="header_description">
			중요한 부분입니다! 에어비앤비 사용자 모두가 이 정보를 볼 수 있어요.
	</p>
	<ul id="details" class="narrow_page_section_content rounded_bottom">
		<li>
			<label for="hosting_property_type_id">객실 종류:</label>
			<select id="hosting_property_type_id" name="hosting[property_type_id]"><option value="1">아파트</option>
<option value="2">단독주택</option>
<option value="3">민박(조식포함)</option>
<option value="4">통나무집</option>
<option value="11">별장/타운하우스</option>
<option value="5">성</option>
<option value="9">다인실</option>
<option value="6">트리하우스</option>
<option value="8">선상객실</option>
<option value="7">캠핑카</option>
<option value="12">이글루</option>
<option value="10">등대</option></select>
		</li>
		<li>
			<label for="hosting_person_capacity">
				숙박가능인원:
			</label>
			<select id="hosting_person_capacity" name="hosting[person_capacity]"><option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16+</option></select>
		</li>
		<li>
			<label for="hosting_room_type">Privacy:</label>
			<select id="hosting_room_type" name="hosting[room_type]"><option value="Private room" selected="selected">프라이빗룸</option>
<option value="Shared room">쉐어드룸</option>
<option value="Entire home/apt">집/아파트 전체</option></select>
		</li>
		<li>
			<label for="hosting_bedrooms">침실 수:</label>
			<select id="hosting_bedrooms" name="hosting[bedrooms]"><option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option></select>
		</li>
		<li>
		  <div class="label_with_description">
		    <label for="hosting_name" class="tall_label">제목:</label>
		      <p class="detail_description">
		        모국어로 객실 포스팅의 제목을 입력하세요. 나중에 변경하거나 다른 언어를 추가 할 수 있습니다. 
		      </p>
		  </div>
			<input class="active tooltip" id="hosting_name" name="hosting[name]" size="30" style="margin-right:2px;" title="Use a descriptive headline to catch guests' attention. Don't worry, you can change this later." type="text" />
			<span id="letter_count">35</span>
			<span id="title_message"></span>
		</li>
		<li>
			<div class="label_with_description">
				<label for="hosting_description" style="vertical-align:top;">설명:</label>
				<p class="detail_description">
					Enter a description for your listing in your native language. You can change this or add more languages later.
				</p>
		  </div>
			<textarea class="active tooltip" cols="40" id="hosting_description" name="hosting[description]" rows="20" style="height: 200px; width: 380px;" title="Tell travelers about comforts and amenities, closeness to sites and attractions, and basics like internet, cable, parking. Are you a great host?  Tell them that too!"></textarea>
		</li>
		<li class="sublets">
			<div style="margin-bottom: 10px;">
				<label for="is_sublet">
					One time sublet? <a class="tooltip" title="당신의 집을 딱 한번, 정해진 기간동안 여행객에게 빌려줘 보세요."><img alt="Questionmark_hover" src="<?=IMG_DIR?>/icons/questionmark_hover.png" style="width:; height:;" /></a>
				</label>
				<input type="checkbox" id="is_sublet" name="is_sublet" />
			</div>
			<div id="sublet_dates" style="margin-left: 150px;">
				<div class="search_date" style="float: left; margin-right: 10px;">
					<label for="sublet_checkin" style="float: none;">
						Sublet start date
					</label>
					<div>
						<input type="text" id="sublet_checkin" class="checkin" name="sublet_checkin" value="yy/mm/dd" style="width: 150px;" />
					</div>
				</div>
				<div class="search_date" style="float: left;">
					<label for="sublet_checkout" style="float: none;">
						Sublet end date
					</label>
					<div>
						<input type="text" id="sublet_checkout" class="checkout" name="sublet_checkout" value="yy/mm/dd" style="width: 150px;" />
					</div>
				</div>
			</div>
		</li>
		<li>
			<label id="hosting_price_native_label" for="hosting_price_native">Price:</label>
			<select id="hosting_native_currency" name="hosting[native_currency]" style="margin:9px 10px 0 0; float:none;"><option value="AUD">AUD</option>
<option value="BRL">BRL</option>
<option value="CAD">CAD</option>
<option value="CHF">CHF</option>
<option value="CZK">CZK</option>
<option value="DKK">DKK</option>
<option value="EUR">EUR</option>
<option value="GBP">GBP</option>
<option value="HKD">HKD</option>
<option value="HUF">HUF</option>
<option value="ILS">ILS</option>
<option value="JPY">JPY</option>
<option value="NOK">NOK</option>
<option value="RUB">RUB</option>
<option value="SEK">SEK</option>
<option value="USD" selected="selected">USD</option>
<option value="ZAR">ZAR</option></select>
			<input class="active" id="hosting_price_native" name="hosting[price_native]" size="30" style="width:50px; float:none; margin-right:10px;" type="text" value="0" />
			<span id="per-night-span">1박당</span>
			<span id="sublet-rates" style="display: none;">
				<span id="per-month-span">달 마다</span>
				<span id="flat-rate-span" style="display: none;">flat rate</span>
			</span>
		</li>
	</ul>
</div>
			
			<div id="submit-wrapper">
				<a id="post_room_submit_button" class="v3_button">저장하고 계속하기</a>
			</div>
			<div id="error_summary" style="display:none;">
				<p>다음 오류를 고치세요:</p>
				<ul></ul>
			</div>
		</div>
</form></div>

<script type="text/javascript">
    var AirbnbCurrencyInitializer = (function() {
      
        var my = {};
        
        my.USD = 1;
        my.EUR = 0.696;
        my.DKK = 5.188;
        my.CAD = 0.9491;
        my.JPY = 78.44;
        my.GBP = 0.6132;
        my.AUD = 0.9208;
        my.ZAR = 6.768;
        
        return my;
    }());
    Airbnb.Currency.setCurrencyConversions(AirbnbCurrencyInitializer);

</script>

<script type="text/javascript">
    var Translations = {
        title : {
            great : "멋진 제목이네요!",
            pretty_good : "제목이 너무 짧네요!",
            please_enter : "제목을 입력해 주세요!"
        },

        address : "주소",
        email_address: "이메일 주소",
        title : "제목",
        description : "설명",
        price : "가격",
        phone_number : "집 전화번호",

        address_error : "객실 주소를 입력해 주세요. 세부 주소(동 이하)는 예약완료된 여행객에게만 공개됩니다.",
        email_address_error : "이메일 주소가 올바르지 않습니다.",
        phone_number_error : "유효한 전화번호를 입력해 주세요. 결제완료한 여행객 외에는 공개되지 않습니다. 해외에서 통화연결이 가능하도록 입력해 주세요. [(예) 한국 010-1234-5678인 경우 821012345678로 입력]",
        room_name_error : "주인장님의 객실에 어울리는 제목을 적어주세요. 검색결과에 보여지게 됩니다.",
        description_error : "객실 설명을 입력해 주세요.",
        price_error : "가격을 입력하세요",
		priceTooSmall_error: "가격은 최소 $10여야 합니다.",

        video_lightbox_title : "에어비앤비 이용방법",

        private_room_phrase : '프라이빗룸',
        shared_room_phrase : '쉐어드룸',
        entire_home_phrase : '집/아파트 전체',
        not_so_vague: "입력하신 주소가 명확하지 않습니다. <br /><br />지도를 확대해서 지도의 정확한 위치에 핀을 지정하세요. ",
		not_so_vague_2: "왼쪽에 나오는 주소가 실제 주소랑 가장 비슷할 때 까지 핀을 드래그 하세요. ",
		not_so_vague_3: "입력하신 주소가 명확하지 않습니다. 지도의 정확한 위치에 핀을 지정하세요. ",
		your_listing: "Your listing",
		sublet_real_end: "서블렛 기간 마지막 날짜를 확인해 주세요.",
		sublet_real_start: "서블렛 기간 처음 날짜를 확인해 주세요.",
		sublet_start_before: "서블렛 기간의 마지막 날짜는 처음 날짜 보다 최소 하루 뒤여야 합니다.",
		sublet_min_nights: "서블렛은 최소 14박 이어야 합니다."
    };
    
    var Urls = {
      ajax_worth : '/rooms/ajax_worth'
    }

    jQuery(document).ready(function() {
        PostRoom.mapZoomLevel = 1;
        PostRoom.hostingLat = 0.0;
        PostRoom.hostingLng = 0.0;
        PostRoom.localized_hiw_video_code = 'SaOFuW011G8';
		PostRoom.SUBLET_COUNTRIES = ["US","GB","DE","IT","NL","ES","FR"];
		PostRoom.MINIMUM_SUBLET_STAY_MS = 14 * 86400000;
		PostRoom.SUBLET_CROSSOVER_MS = 25 * 86400000;


        var opts = {};

        PostRoom.init(opts);

        $('#price_suggestion').hide();
		$('#hosting_phone').validatedPhone();
    });
</script>

<?php $this->load->view('footer'); ?>
