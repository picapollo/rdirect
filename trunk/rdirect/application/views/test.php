<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script> 
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?=JS_DIR?>/common.js"></script>
</head>
<body>
	    <div id="search_area"> 
        <div id='callout'>멋진 숙소를 찾아보세요!</div> 
        
    <p><a href="/home/coverage" id="coverage_link">185개국 15,736개 도시 사람들의 방, 집, 별장, 배, 성 등에서 숙박할 수 있습니다.</a></p> 
 
    
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

<table>
	
</table> 

<script type="text/javascript">
if (navigator.userAgent.indexOf("iPhone") == -1 && navigator.userAgent.indexOf("iPod") == -1 && navigator.userAgent.indexOf("iPad") == -1) {
    jQuery(document).ready(function() {
        LazyLoad.js([ "<?=JS_DIR?>/jquery.autocomplete_custom.pack.js", "<?=JS_DIR?>/ko_autocomplete_data.js" ], function() {
            jQuery("#location").autocomplete(autocomplete_terms, {
                minChars: 1,
                width: 301,
                max: 20,
                matchContains: false,
                autoFill: true,
                formatItem: function(row, i, max) {
                    return Airbnb.Utils.decode(row.k);
                },
                formatMatch: function(row, i, max) {
                    return Airbnb.Utils.decode(row.k);
                },
                formatResult: function(row) {
                    return Airbnb.Utils.decode(row.k);
                }
            });
        });
    });
}
</script>
</body>
</html>