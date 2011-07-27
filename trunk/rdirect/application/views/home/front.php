<?php
	$this->load->view('header/page1', $header);
	$this->load->view('top_menu', array('starred', $starred));
?>

<div id="home"> 
    <div id="search_area"> 
        <div id='callout'>멋진 숙소를 찾아보세요!</div> 
        
    <p><a href="/home/coverage" id="coverage_link">186개국 16,737개 도시 사람들의 방, 집, 별장, 배, 성 등에서 숙박할 수 있습니다.</a></p> 
 
    
<form action="/search" id="search_form" method="post">            <div id="search_bar"> 
                <label for="location" class="inner_text" id="location_label" style="display:none;">어디로 여행가세요?</label> 
                <input type="text" class="location rounded_left" autocomplete="off" id="location" name="location" /> 
 
                <input class="v3_button v3_fixed_width" type="submit" id="submit_location" name="submit_location" value="검색"/> 
                <p id="enter_location_error_message" class="bad" style="display:none;">찾으려는 마을/도시/나라를 입력해 주세요</p> 
                <div class="clear"></div> 
            </div> 
 
            <div id="search_options"> 
                <div class="search_date"><div>체크인</div><div><input type="text" id="checkin" class="checkin" name="checkin" value="yy/mm/dd" /></div></div> 
                <div class="search_date"><div>체크아웃</div><div><input type="text" id="checkout" class="checkout" name="checkout" value="yy/mm/dd" /></div></div> 
                <div class="search_guests"><div>숙박인원</div><div><select id="number_of_guests" name="number_of_guests"><option value="1" selected="selected">1</option> 
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
<option value="16">16+</option></select></div></div> 
                <div class="clear"></div> 
            </div> 
</form>    </div><!-- search_area --> 
 
    <div id="slideshow"> 
        
    <div id="slideshow_container"> 
        <div class="slideshow_item"> 
            <a href="/rooms/68674" class="image_link rounded_top"> 
                <img src="http://i2.muscache.com/pictures/431687/large.jpg" width="476" height="316" alt="" /> 
            </a> 
            <div class="slideshow_item_details rounded_bottom"> 
                <img src="http://i3.muscache.com/users/297033/profile_pic/1300812224/medium.jpg" width="68" height="68" alt="" /> 
                <div class="slideshow_item_details_text rounded_more"> 
                    <div class="ss_details_top"> 
                        <a class="ss_name" href="/rooms/68674">Villa Boubouki, amazing sea view</a> - <span class="ss_location">Apollonioi, Greece</span> 
                    </div> 
                    <div class="ss_details_bottom"> 
                        <span class="ss_price">$144 / 1박</span> 
                    </div> 
                </div> 
            </div><!-- slideshow_item_details --> 
        </div><!-- slideshow_item --> 
        <div class="slideshow_item"> 
            <a href="/rooms/14098" class="image_link rounded_top"> 
                <img src="http://i0.muscache.com/pictures/107645/large.jpg" width="476" height="316" alt="" /> 
            </a> 
            <div class="slideshow_item_details rounded_bottom"> 
                <img src="http://i3.muscache.com/users/55411/profile_pic/1305605494/medium.jpg" width="68" height="68" alt="" /> 
                <div class="slideshow_item_details_text rounded_more"> 
                    <div class="ss_details_top"> 
                        <a class="ss_name" href="/rooms/14098">Modern Architectural Zen. Rated #1</a> - <span class="ss_location">Los Angeles, CA</span> 
                    </div> 
                    <div class="ss_details_bottom"> 
                        <span class="ss_price">$325 / 1박</span> 
                          <span class="ss_review">18 후기s</span> 
                    </div> 
                </div> 
            </div><!-- slideshow_item_details --> 
        </div><!-- slideshow_item --> 
    </div><!-- slideshow_container --> 
 
    <script type="text/javascript"> 
        var loadImmediately = [{"userPicUrl":"http://i3.muscache.com/users/183772/profile_pic/1280353458/medium.jpg","url":"/rooms/42032","smartLocation":"Cape Town, South Africa","reviews":0,"price":"$428","name":"Luxury apartment on Clifton Beach","picUrl":"http://i3.muscache.com/pictures/236142/large.jpg","id":42032},{"userPicUrl":"/images/user_pic-68x68.png","url":"/rooms/21522","smartLocation":"Redlands, CA","reviews":0,"price":"$170","name":"Cress Grove Manor, 5 Acres, Pool","picUrl":"http://i0.muscache.com/pictures/112128/large.jpg","id":21522},{"userPicUrl":"http://i0.muscache.com/users/45398/profile_pic/1259124734/medium.jpg","url":"/rooms/12047","smartLocation":"Tiburon, CA","reviews":2,"price":"$250","name":"Amazing BAY VIEWS ~ Tiburon Landing","picUrl":"http://i2.muscache.com/pictures/485084/large.jpg","id":12047},{"userPicUrl":"http://i1.muscache.com/users/741356/profile_pic/1310109547/medium.jpg","url":"/rooms/162000","smartLocation":"St George, ME","reviews":0,"price":"$688","name":"McGee Island - a step back in time","picUrl":"http://i3.muscache.com/pictures/1057671/large.jpg","id":162000},{"userPicUrl":"http://i2.muscache.com/users/15552/profile_pic/1279049506/medium.jpg","url":"/rooms/7643","smartLocation":"Paris, France","reviews":110,"price":"$115","name":"Studio Bastille - Marais","picUrl":"http://i1.muscache.com/pictures/52613/large.jpg","id":7643},{"userPicUrl":"http://i1.muscache.com/users/136853/profile_pic/1275471018/medium.jpg","url":"/rooms/31817","smartLocation":"Barcelona, Spain","reviews":44,"price":"$159","name":"Sant Joan 1","picUrl":"http://i0.muscache.com/pictures/178771/large.jpg","id":31817},{"userPicUrl":"http://i0.muscache.com/users/7903/profile_pic/1280002723/medium.jpg","url":"/rooms/5396","smartLocation":"Paris, France","reviews":16,"price":"$109","name":"Bask in the heart of old Paris","picUrl":"http://i3.muscache.com/pictures/52413/large.jpg","id":5396},{"userPicUrl":"http://i0.muscache.com/users/247975/profile_pic/1304998427/medium.jpg","url":"/rooms/53279","smartLocation":"Seattle, WA","reviews":30,"price":"$64","name":"Sweet North Seattle Studio","picUrl":"http://i0.muscache.com/pictures/491724/large.jpg","id":53279},{"userPicUrl":"http://i0.muscache.com/users/480317/profile_pic/1301824712/medium.jpg","url":"/rooms/87729","smartLocation":"Bonnieux, France","reviews":5,"price":"$259","name":"The Silk Farm","picUrl":"http://i3.muscache.com/pictures/604193/large.jpg","id":87729},{"userPicUrl":"http://i1.muscache.com/users/74305/profile_pic/1264620605/medium.jpg","url":"/rooms/19619","smartLocation":"Seattle, WA","reviews":24,"price":"$155","name":"Amazing View \u0026 Location!","picUrl":"http://i0.muscache.com/pictures/288786/large.jpg","id":19619},{"userPicUrl":"/images/user_pic-68x68.png","url":"/rooms/49567","smartLocation":"Barnet, United Kingdom","reviews":0,"price":"$1598","name":"7 bedroom in London","picUrl":"http://i1.muscache.com/pictures/284288/large.jpg","id":49567},{"userPicUrl":"http://i1.muscache.com/users/45208/profile_pic/1259124637/medium.jpg","url":"/rooms/11917","smartLocation":"Paris, France","reviews":52,"price":"$149","name":"Central Paris Rambuteau","picUrl":"http://i3.muscache.com/pictures/288516/large.jpg","id":11917},{"userPicUrl":"http://i2.muscache.com/users/237920/profile_pic/1285398865/medium.jpg","url":"/rooms/51674","smartLocation":"Le Kremlin Bic\u00eatre, France","reviews":45,"price":"$70","name":"Ideal Group/ Family Travel!! 70m2","picUrl":"http://i3.muscache.com/pictures/297286/large.jpg","id":51674},{"userPicUrl":"http://i0.muscache.com/users/306739/profile_pic/1301007508/medium.jpg","url":"/rooms/62925","smartLocation":"Brooklyn, NY","reviews":13,"price":"$185","name":"Beautiful Landmarked Duplex","picUrl":"http://i2.muscache.com/pictures/385764/large.jpg","id":62925},{"userPicUrl":"http://i1.muscache.com/users/116168/profile_pic/1272658340/medium.jpg","url":"/rooms/27121","smartLocation":"Puerto Viejo, Costa Rica","reviews":0,"price":"$130","name":"Luxury junglehouses with jacuzzi!","picUrl":"http://i1.muscache.com/pictures/151324/large.jpg","id":27121},{"userPicUrl":"http://i1.muscache.com/users/17175/profile_pic/1271961559/medium.jpg","url":"/rooms/7061","smartLocation":"San Francisco, CA","reviews":66,"price":"$95","name":"Nest on Nob Hill","picUrl":"http://i1.muscache.com/pictures/24874/large.jpg","id":7061},{"userPicUrl":"http://i3.muscache.com/users/131448/profile_pic/1275340161/medium.jpg","url":"/rooms/34655","smartLocation":"Pula, Croatia","reviews":1,"price":"$101","name":"Neven 2","picUrl":"http://i1.muscache.com/pictures/195306/large.jpg","id":34655},{"userPicUrl":"http://i3.muscache.com/users/92895/profile_pic/1268610552/medium.jpg","url":"/rooms/23595","smartLocation":"Cabo San Lucas, Mexico","reviews":0,"price":"$1425","name":"Beachfront Castillo Escondido","picUrl":"http://i3.muscache.com/pictures/124357/large.jpg","id":23595},{"userPicUrl":"http://i0.muscache.com/users/161362/profile_pic/1299541787/medium.jpg","url":"/rooms/37363","smartLocation":"Parks, AZ","reviews":45,"price":"$99","name":"Grand Canyon, Flagstaff, and Sedona","picUrl":"http://i0.muscache.com/pictures/211317/large.jpg","id":37363},{"userPicUrl":"http://i2.muscache.com/users/50121/profile_pic/1299412856/medium.jpg","url":"/rooms/12936","smartLocation":"St Kilda, Australia","reviews":3,"price":"$162","name":"Designer Apartment Central St Kilda","picUrl":"http://i3.muscache.com/pictures/745316/large.jpg","id":12936},{"userPicUrl":"http://i0.muscache.com/users/61500/profile_pic/1280250822/medium.jpg","url":"/rooms/15714","smartLocation":"Brooklyn, NY","reviews":7,"price":"$155","name":"modern minimal loft","picUrl":"http://i2.muscache.com/pictures/88743/large.jpg","id":15714},{"userPicUrl":"http://i2.muscache.com/users/51770/profile_pic/1270505480/medium.jpg","url":"/rooms/13337","smartLocation":"Puntarenas, Costa Rica","reviews":1,"price":"$300","name":"Costa Rica Villa","picUrl":"http://i1.muscache.com/pictures/62153/large.jpg","id":13337},{"userPicUrl":"http://i3.muscache.com/users/189692/profile_pic/1289837321/medium.jpg","url":"/rooms/45652","smartLocation":"Paris, France","reviews":17,"price":"$243","name":"Luxury flat in the heart of Paris","picUrl":"http://i0.muscache.com/pictures/259186/large.jpg","id":45652},{"userPicUrl":"http://i1.muscache.com/users/122553/profile_pic/1298587709/medium.jpg","url":"/rooms/28478","smartLocation":"Montespertoli, Italy","reviews":1,"price":"$136","name":"Romantic hideaway in hilltop Castle","picUrl":"http://i1.muscache.com/pictures/849658/large.jpg","id":28478},{"userPicUrl":"http://i1.muscache.com/users/36843/profile_pic/1259119443/medium.jpg","url":"/rooms/10554","smartLocation":"Seattle, WA","reviews":7,"price":"$90","name":"Furnished MIL: Eames.Art","picUrl":"http://i3.muscache.com/pictures/133397/large.jpg","id":10554},{"userPicUrl":"http://i2.muscache.com/users/179020/profile_pic/1290556159/medium.jpg","url":"/rooms/44145","smartLocation":"New York, NY","reviews":36,"price":"$139","name":"Cozy Private Room in Hell's Kitchen","picUrl":"http://i1.muscache.com/pictures/608136/large.jpg","id":44145},{"userPicUrl":"http://i1.muscache.com/users/152569/profile_pic/1291834104/medium.jpg","url":"/rooms/35456","smartLocation":"Brooklyn, NY","reviews":65,"price":"$79","name":"Parlor Floor Pad","picUrl":"http://i3.muscache.com/pictures/443465/large.jpg","id":35456},{"userPicUrl":"http://i0.muscache.com/users/43423/profile_pic/1259123340/medium.jpg","url":"/rooms/11596","smartLocation":"Brooklyn, NY","reviews":15,"price":"$100","name":"Prospect Hts-Clean 1 BR","picUrl":"http://i3.muscache.com/pictures/72712/large.jpg","id":11596},{"userPicUrl":"http://i2.muscache.com/users/38641/profile_pic/1297349128/medium.jpg","url":"/rooms/10766","smartLocation":"Washington, DC","reviews":25,"price":"$80","name":"Hospitality@HillEast","picUrl":"http://i0.muscache.com/pictures/73293/large.jpg","id":10766},{"userPicUrl":"http://i3.muscache.com/users/123426/profile_pic/1273691682/medium.jpg","url":"/rooms/28668","smartLocation":"Porto Seguro, Brazil","reviews":0,"price":"$352","name":"Casa do Dean","picUrl":"http://i1.muscache.com/pictures/159935/large.jpg","id":28668},{"userPicUrl":"http://i3.muscache.com/users/662175/profile_pic/1307162522/medium.jpg","url":"/rooms/135011","smartLocation":"Island Bay, New Zealand","reviews":0,"price":"$120","name":"Lighthouse, Island Bay, Wellington","picUrl":"http://i1.muscache.com/pictures/856359/large.jpg","id":135011},{"userPicUrl":"http://i0.muscache.com/users/102446/profile_pic/1270996539/medium.jpg","url":"/rooms/24965","smartLocation":"Ibiza, Spain","reviews":1,"price":"$287","name":"Summer Holidays in Ibiza","picUrl":"http://i1.muscache.com/pictures/134794/large.jpg","id":24965},{"userPicUrl":"http://i3.muscache.com/users/132127/profile_pic/1274832561/medium.jpg","url":"/rooms/30701","smartLocation":"Pretty Beach, Australia","reviews":0,"price":"$1772","name":"Pretty Beach House","picUrl":"http://i0.muscache.com/pictures/171967/large.jpg","id":30701},{"userPicUrl":"http://i0.muscache.com/users/35630/profile_pic/1303902322/medium.jpg","url":"/rooms/40249","smartLocation":"New York, NY","reviews":95,"price":"$184","name":"Beautiful Times Square Studio","picUrl":"http://i2.muscache.com/pictures/271120/large.jpg","id":40249},{"userPicUrl":"http://i3.muscache.com/users/124610/profile_pic/1285566152/medium.jpg","url":"/rooms/53019","smartLocation":"Kamala, Thailand","reviews":0,"price":"$350","name":"Private 4 Bedroom Villa, Kamala","picUrl":"http://i2.muscache.com/pictures/307698/large.jpg","id":53019},{"userPicUrl":"http://i3.muscache.com/users/318729/profile_pic/1292360666/medium.jpg","url":"/rooms/65200","smartLocation":"Brooklyn, NY","reviews":14,"price":"$80","name":"10 min from Manhattan! (Room 1)","picUrl":"http://i0.muscache.com/pictures/581616/large.jpg","id":65200},{"userPicUrl":"/images/user_pic-68x68.png","url":"/rooms/19785","smartLocation":"Miami, FL","reviews":0,"price":"$115","name":"Fortuna House Apartments","picUrl":"http://i1.muscache.com/pictures/495541/large.jpg","id":19785},{"userPicUrl":"http://i0.muscache.com/users/625642/profile_pic/1306565589/medium.jpg","url":"/rooms/153903","smartLocation":"Corralitos, CA","reviews":5,"price":"$125","name":"Redwood Treehouse Santa Cruz Mtns.","picUrl":"http://i0.muscache.com/pictures/973879/large.jpg","id":153903},{"userPicUrl":"http://i0.muscache.com/users/224568/profile_pic/1283817201/medium.jpg","url":"/rooms/49254","smartLocation":"Barcelona, Spain","reviews":26,"price":"$72","name":"Double Bedroom in Barcelona Centre","picUrl":"http://i0.muscache.com/pictures/282371/large.jpg","id":49254},{"userPicUrl":"/images/user_pic-68x68.png","url":"/rooms/118807","smartLocation":"New York, NY","reviews":2,"price":"$500","name":"Terraced Luxury Apartment ","picUrl":"http://i1.muscache.com/pictures/817001/large.jpg","id":118807},{"userPicUrl":"http://i0.muscache.com/users/158512/profile_pic/1279752382/medium.jpg","url":"/rooms/36749","smartLocation":"Amsterdam, Netherlands","reviews":5,"price":"$122","name":"Beautiful 2 bed apt in leafy suburb","picUrl":"http://i3.muscache.com/pictures/227807/large.jpg","id":36749},{"userPicUrl":"http://i2.muscache.com/users/50056/profile_pic/1268298543/medium.jpg","url":"/rooms/13038","smartLocation":" Stirling Adelaide, Australia","reviews":0,"price":"$856","name":"Tower Loft Room","picUrl":"http://i0.muscache.com/pictures/122761/large.jpg","id":13038},{"userPicUrl":"http://i0.muscache.com/users/202748/profile_pic/1297376622/medium.jpg","url":"/rooms/45618","smartLocation":"Amsterdam, Netherlands","reviews":21,"price":"$158","name":"Quietness in the centre","picUrl":"http://i3.muscache.com/pictures/399553/large.jpg","id":45618},{"userPicUrl":"http://i2.muscache.com/users/34580/profile_pic/1292928506/medium.jpg","url":"/rooms/10132","smartLocation":"Barcelona, Spain","reviews":61,"price":"$59","name":"Super-apartment in trendy Born","picUrl":"http://i3.muscache.com/pictures/289555/large.jpg","id":10132},{"userPicUrl":"http://i1.muscache.com/users/122482/profile_pic/1276009001/medium.jpg","url":"/rooms/29873","smartLocation":"Rome, Italy","reviews":6,"price":"$108","name":"COZY APT\u0026SUNNY TERRACE womn/couples","picUrl":"http://i0.muscache.com/pictures/300727/large.jpg","id":29873},{"userPicUrl":"http://i0.muscache.com/users/595850/profile_pic/1306045901/medium.jpg","url":"/rooms/121227","smartLocation":"Santa Cruz, Costa Rica","reviews":1,"price":"$125","name":"Beautiful Potrero Beach Apts 4pax","picUrl":"http://i0.muscache.com/pictures/833449/large.jpg","id":121227},{"userPicUrl":"http://i2.muscache.com/users/16638/profile_pic/1259105256/medium.jpg","url":"/rooms/6973","smartLocation":"Takoma Park, MD","reviews":124,"price":"$75","name":"Garden House ","picUrl":"http://i2.muscache.com/pictures/498404/large.jpg","id":6973},{"userPicUrl":"http://i3.muscache.com/users/90255/profile_pic/1294859877/medium.jpg","url":"/rooms/23164","smartLocation":"London, United Kingdom","reviews":32,"price":"$228","name":"2 Bed City Penthouse,Views,Terraces","picUrl":"http://i0.muscache.com/pictures/247374/large.jpg","id":23164},{"userPicUrl":"http://i1.muscache.com/users/137490/profile_pic/1280339236/medium.jpg","url":"/rooms/31939","smartLocation":"Los Angeles, CA","reviews":81,"price":"$54","name":"Downtown Deluxe 1","picUrl":"http://i3.muscache.com/pictures/226587/large.jpg","id":31939},{"userPicUrl":"http://i2.muscache.com/users/61299/profile_pic/1297371452/medium.jpg","url":"/rooms/15656","smartLocation":"Brooklyn, NY","reviews":6,"price":"$280","name":"SUMMER SPECIAL JUN23 WILLIAMSBURG","picUrl":"http://i3.muscache.com/pictures/650298/large.jpg","id":15656},{"userPicUrl":"http://i0.muscache.com/users/409040/profile_pic/1298609876/medium.jpg","url":"/rooms/76581","smartLocation":"Merida, Mexico","reviews":0,"price":"$100","name":"Sac Nicte - mayan village rental","picUrl":"http://i0.muscache.com/pictures/514539/large.jpg","id":76581},{"userPicUrl":"http://i3.muscache.com/users/68745/profile_pic/1262923329/medium.jpg","url":"/rooms/17781","smartLocation":"Buenos Aires, Argentina","reviews":22,"price":"$80","name":"Luxury 1Bd, Amazing View ","picUrl":"http://i1.muscache.com/pictures/89866/large.jpg","id":17781},{"userPicUrl":"http://i1.muscache.com/users/192475/profile_pic/1291614517/medium.jpg","url":"/rooms/48089","smartLocation":"Buenos Aires, Argentina","reviews":10,"price":"$65","name":"Recoleta Classic French-Style 2BDR","picUrl":"http://i3.muscache.com/pictures/568672/large.jpg","id":48089},{"userPicUrl":"http://i1.muscache.com/users/592616/profile_pic/1306400198/medium.jpg","url":"/rooms/117318","smartLocation":"Athens, Greece","reviews":1,"price":"$80","name":"A relaxing house overlooking Athens","picUrl":"http://i1.muscache.com/pictures/799627/large.jpg","id":117318},{"userPicUrl":"http://i1.muscache.com/users/329213/profile_pic/1293581832/medium.jpg","url":"/rooms/66950","smartLocation":"Playa Del Carmen, Mexico","reviews":0,"price":"$300","name":"Luxury Condo in Playa del Carmen","picUrl":"http://i1.muscache.com/pictures/418128/large.jpg","id":66950},{"userPicUrl":"http://i3.muscache.com/users/538171/profile_pic/1303873527/medium.jpg","url":"/rooms/103138","smartLocation":"Nong Lu, Thailand","reviews":0,"price":"$790","name":"Lake House Adventure","picUrl":"http://i3.muscache.com/pictures/688121/large.jpg","id":103138},{"userPicUrl":"http://i3.muscache.com/users/670172/profile_pic/1307392808/medium.jpg","url":"/rooms/137002","smartLocation":"Rio de Janeiro, Brazil","reviews":0,"price":"$390","name":"Very new and beautiful Leblon","picUrl":"http://i1.muscache.com/pictures/926654/large.jpg","id":137002},{"userPicUrl":"http://i3.muscache.com/users/68805/profile_pic/1262946277/medium.jpg","url":"/rooms/17805","smartLocation":"New York, NY","reviews":45,"price":"$155","name":"SmartStudio","picUrl":"http://i0.muscache.com/pictures/233241/large.jpg","id":17805}];
    </script> 
 
        <div id="slideshow_controls" class="rounded_top" style="display:none;"> 
            <a class="ss_button_icon" href="javascript:void(0);" id="ss_button_prev"></a> 
            <a class="ss_button_icon ss_button_pause" href="javascript:void(0);" id="ss_button_pause_play"></a> 
            <a class="ss_button_icon" href="javascript:void(0);" id="ss_button_next"></a> 
        </div> 
    </div> 
 
    
 
<ul id="homepage_badges" class="rounded"> 
  <li class="rounded"> 
    <a href="/info/how_it_works" class="how_it_works ko" alt="How it Works"> 
      <div class="badge-content-container"> 
        <div class="badge-content">이용방법</div> 
      </div> 
    </a> 
  </li> 
  <li class="rounded"> 
    <a href="/social" class="social_connections ko" alt="Social Connections"> 
      <div class="badge-content-container"> 
        <div class="badge-content"><p>소개하기 Airbnb <strong>소셜커넥션</strong></p><span class='counter'>20070683</span><p class='small'>Over 20 million connections and counting</p></div> 
      </div> 
    </a> 
  </li> 
  <li class="rounded"> 
    <a href="/referrals" class="referral ko" alt="Referral"> 
      <div class="badge-content-container"> 
        <div class="badge-content"><span class="button-glossy">지금 초대하기</span></div> 
      </div> 
    </a> 
  </li> 
  <li class="rounded"> 
    <a href="http://destinationhoneymoon.airbnb.com/entries" class="honeymoon ko" alt="Honeymoon Contest"> 
      <div class="badge-content-container"> 
        <div class="badge-content"><p>DESTINATION: <strong>HONEYMOON</strong><em>CONTEST</em></p><span class="view-button">VIEW ENTRIES &raquo;</span></div> 
      </div> 
    </a> 
  </li> 
</ul><!-- homepage_badges --> 

<style type="text/css"> 
    body{width:980px;}
    .ac_results{border:2px solid #c1bfa2; border-width:0 2px 2px 2px; margin-left:5px;}
</style>

<?php $this->load->view('footer', array('no_closing')); ?>

<script type="text/javascript"> 
 
jQuery(window).load(function() {
	AirbnbHomePage.initSlideshow();
});
 
if ((navigator.userAgent.indexOf('iPhone') == -1) && (navigator.userAgent.indexOf('iPod') == -1) && (navigator.userAgent.indexOf('iPad') == -1)) {
    jQuery(window).load(function() {
        LazyLoad.js([
			"<?=JS_DIR?>/jquery.autocomplete_custom.pack.js",
			"<?=JS_DIR?>/ko_autocomplete_data.js"],
			function() {
            	jQuery("#location").autocomplete(autocomplete_terms, {
	                minChars: 1, width: 301, max:20, matchContains: false, autoFill: true,
	                formatItem: function(row, i, max) {
	                    //to show counts, uncomment
	                    //return row.k + " <span class='autocomplete_extra_info'>(" + row.c + ")</span>";
	                    return Airbnb.Utils.decode(row.k);
	                },
	                formatMatch: function(row, i, max) {
	                    return Airbnb.Utils.decode(row.k);
	                },
	                formatResult: function(row) {
	                    return Airbnb.Utils.decode(row.k);
	                }
	            });
	        }
		);
    });
}

		jQuery(document).ready(function() {
			Airbnb.init({userLoggedIn: false});
		});
 	</script> 
