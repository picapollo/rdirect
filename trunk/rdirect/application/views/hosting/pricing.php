<?php	$this->load->view('header/edit_listing', $header); ?>

<?
	$this->load->view('top_menu', array('starred'=> $starred));
	$this->load->view('rooms/edit_nav', array('selected' => 'pricing', 'room' => $room, 'sig' => $sig));
?>

    <div class="col three-fourths content"> 
      <ul class="subnav" id="nav_pricing"> 
  <li class="selected">기본적인 
  <li>앞선
  <li>도구
</ul> 
 
      <div id="notification-area"></div> 
      <div id="dashboard-content"> 
        
<style> 
#transparent_bg_overlay{ display: none; position: fixed; top: 0%; left: 0%; width: 100%; height: 100%; background-color: black; z-index:999998; -moz-opacity: 0.5; opacity:.50; filter: alpha(opacity=50); }
  .super_lightbox { line-height:20px; display: none; position: fixed; top: 25%; left: 25%; width: 50%; padding: 16px; border: 2px solid #333333; background-color: white; z-index:999999; overflow: auto; color:#333333}
  .super_lightbox h3{font-size:21px; font-weight:bold; border-bottom:2px solid #333; margin-bottom:15px; }
  .super_lightbox a.hide_super_lightbox{font-size:15px; display:block; float:right; padding-bottom:10px; overflow:hidden; }
</style> 

<script type="text/javascript"> 
			jQuery(document).ready(function(){
  				jQuery('ul.subnav').tabberizer();

				jQuery('#hosting_native_currency').currencychanger(<?=json_encode($currency)?>);

			});
			
</script>
   
<div id="transparent_bg_overlay"></div> 
<!-- this is just here so that the RJS for the advanced pricing doesn't break --> 
<span id="default_daily_price" style="display: none;"></span> 
<ul class="panels" id="nav_pricing_panels"> 
  <li class="selected"> 
<form action="<?=site_url('rooms/update/'.$room->id)?>" enctype="multipart/form-data" id="hosting_edit_form" method="post" name="hosting_edit_form">    
    
    <div class="box"> 
      <h2><span class="edit_room_icon pricing"></span>기본 가격 책정</h2> 
      <div class="middle"> 
        <ul> 
          <li> 
            <label for="hosting_native_currency">통화</label> 
            <select id="hosting_native_currency" name="hosting[native_currency]">
            	<?php 
            		foreach($this->config->item('supported_currency') as $k => $i) 
					{
						echo '<option value="'.$k.'" ' . ($k==$room->native_currency?'selected="selected"':'') .">$k</option>\n";
					}
            	?>
			</select> 
          </li> 
          <li> 
            <label for="hosting_price_native">Nightly</label> 
            <span class="currency_symbol"><?=$room->currency_symbol?></span><input id="hosting_price_native" name="hosting[price_native]" size="30" type="text" value="<?=$room->price_native?>" /> 
          </li> 
          <li> 
            <label for="hosting_weekly_price_native">Weekly</label> 
            <span class="currency_symbol"><?=$room->currency_symbol?></span><input id="hosting_weekly_price_native" name="hosting[weekly_price_native]" size="30" type="text" <?=$room->weekly_price_native?'value="'.$room->weekly_price_native.'"':''?>/><!--<span class="protip">회원님의 야간 가격에 근거하여 <em>$78에서 $82</em> 정도를 추천합니다.</span>--> 
          </li> 
          <li> 
            <label for="hosting_monthly_price_native">Monthly</label> 
            <span class="currency_symbol"><?=$room->currency_symbol?></span><input id="hosting_monthly_price_native" name="hosting[monthly_price_native]" size="30" type="text" <?=$room->monthly_price_native?'value="'.$room->monthly_price_native.'"':''?>/><span class="protip"><!--회원님의 야간 가격에 근거하여 <em>$324에서 $342</em> 정도를 추천합니다.</span> -->
          </li> 
        </ul> 
      </div> 
    </div> 
    <div class="box"> 
      <h2><span class="edit_room_icon additional"></span>추가 비용</h2> 
      <div class="middle"> 
        <ul> 
          <li> 
            <label for="hosting_price_for_extra_person_native">추가인원</label> 
            <span class="currency_symbol">$</span><input id="hosting_price_for_extra_person_native" name="hosting[price_for_extra_person_native]" size="30" type="text" <?=$room->price_for_extra_person_native?"value=\"{$room->price_for_extra_person_native}\"":''?> /> 
            <span class="protip">이후에 각각의 여행객 1박 당
            <select id="hosting_guests_included" name="hosting[guests_included]" value="<?=$room->guests_included?>">
            	<?php 
            		for($i=1; $i<=16; $i++)
					{
						$selected = $room->guests_included == $i ? 'selected="selected"' : '';
						echo "<option value=\"$i\" $selected>$i</option>";
					}  
				?>
            </select></span> 
          </li> 
          <li> 
            <label for="hosting_extras_price_native">청소비</label> 
            <span class="currency_symbol">$</span><input id="hosting_extras_price_native" name="hosting[extras_price_native]" size="30" type="text" <?=$room->extras_price_native?"value=\"{$room->extras_price_native}\"":''?>/> 
          </li> 
          <li> 
            <label for="hosting_security_deposit_native">보증금</label> 
            <p class="protip right">보증금은 게스트가 체크아웃 한 후 48시간 내에 요청하지 않는 이상 여행객에게 돌려줍니다. </p> 
            <span class="currency_symbol">$</span><input id="hosting_security_deposit_native" name="hosting[security_deposit_native]" size="30" type="text" <?=$room->security_deposit_native?"value=\"{$room->security_deposit_native}\"":''?>/> 
          </li> 
        </ul> 
      </div> 
    </div> 
    <div class="box"> 
      <h2><span class="edit_room_icon details"></span>약관</h2> 
      <div class="middle"> 
        <ul> 
          <li> 
            <label for="hosting_cancel_policy">환불정책</label> 
            <select id="hosting_cancel_policy" name="hosting[cancel_policy]">
            <?php
          		for($i=3; $i<=5; $i++)	// TODO: 6번(매우 엄격한 편 처리)
				{
					$selected = $room->cancel_policy == $i ? 'selected="selected"' : '';
					echo "<option value=\"$i\" $selected>".lang('cancel_policy_'.$i)."}</option>\n";
				}            	
            ?>
			</select> <a href="/home/cancellation_policies" target="new">더 알아보기</a> 
          </li> 
          <li> 
              <label for="hosting_house_rules" style="vertical-align:top;">객실이용규칙
              <span class="helper"> 
                <br/> 
                객실이용규칙은 여행객이 예약하고 이용할 때 따라야 할 조건입니다.
              </span> 
              </label> 
              <textarea cols="40" id="hosting_house_rules" name="hosting[house_rules]" rows="20"><?=empty($room->house_rules)?'':$room->house_rules?></textarea> 
              <div id="form_helper_house_rules" class="form_helper" style="display:none;"> 
              </div> 
              <div class="clear"></div> 
          </li> 
          <li> 
            <label for="hosting_min_nights">최소숙박일수</label> 
            <select id="hosting_min_nights" name="hosting[min_nights]">
            	<?php 
            		for($i=1; $i<=30; $i++)
					{
						$selected = $room->min_nights == $i ? 'selected="selected"' : '';
						echo "<option value=\"$i\" $selected>$i</option>";
					}
				?>
            </select> 
          </li> 
          <li> 
            <label for="hosting_max_nights">최대숙박일수</label> 
            <select id="hosting_max_nights" name="hosting[max_nights]">
            	<option value="365" <?=$room->max_nights == 365 ? 'selected="selected"' : ''?>>No Maximum</option>
				<?php 
					for($i=1; $i<=60; $i++)
					{
						$selected = $room->max_nights == $i ? 'selected="selected"' : '';
						echo "<option value=\"$i\" $selected>$i</option>";
					}
				?>
			</select> 
          </li> 
          <li> 
            <label for="hosting_check_in_time">체크인 시간</label> 
            <select id="hosting_check_in_time" name="hosting[check_in_time]"><option value="-1" <?=$room->check_in_time == -1 ? 'selected="selected"' : ''?>>협의 가능</option>
            <?php
            	for($i=0; $i<24; $i++)
				{
					$selected = $room->check_in_time == $i ? 'selected="selected"' : '';
					$midnight_noon = $i==0 ? ' (midnight)' : ($i==12 ? ' (noon)' : '');
					echo "<option value=\"$i\" $selected>" . date('g:00a', strtotime("+$i hour", mktime(0,0,0,1,1,2011))) . $midnight_noon . "</option>\n";
				}
			?>
			</select> 
          </li> 
          <li> 
            <label for="hosting_check_out_time">체크아웃 시간</label> 
            <select id="hosting_check_out_time" name="hosting[check_out_time]"><option value="-1" <?=$room->check_out_time == -1 ? 'selected="selected"' : ''?>>협의 가능</option> 
            <?php
            	for($i=0; $i<24; $i++)
				{
					$selected = $room->check_out_time == $i ? 'selected="selected"' : '';
					$midnight_noon = $i==0 ? ' (midnight)' : ($i==12 ? ' (noon)' : '');
					echo "<option value=\"$i\" $selected>" . date('g:00a', strtotime("+$i hour", mktime(0,0,0,1,1,2011))) . $midnight_noon . "</option>\n";
				}
			?>
			</select> 
          </li> 
        </ul> 
      </div> 
    </div> 
    <div class="form-submit"> 
      <input id="update_progress" name="update_progress" type="hidden" value="1" /> 
      <input class="button-glossy green" id="hosting_submit" name="commit" type="submit" value="저장" /> 
      <span class="spinner"></span> 
      <div class="clear"></div> 
    </div> 
</form>  </li> 
  <li> 
    <div class="box" id="daily_section"> 
      <style> 
  td.delete { width:30px; }
  td.amount { font-weight:bold; width:50px; }
  span.day_names { font-size:9px; width:60px; }
  td.date_range { width:250px; line-height:20px; }
</style> 
<script> 
  var g_last_currency_code = "USD";
  function change_native_currency() {
        var symbols = $H({
        	<?php
        		$str = '';
        		foreach($currency as $k => $i) $str .= '"'.$k.'":"'.$i['symbol'].'",';
				echo substr($str, 0, -1);        	
        	?>
        });
        var symbol = symbols.get($('native_currency').value);
 
        var rates = $H({
        	<?php
        		$str = '';
        		foreach($currency as $k => $i) $str .= '"'.$k.'":'.$i['rate'].',';
				echo substr($str, 0, -1);        	
        	?>
		});
        var fx_rate = rates.get($('native_currency').value) / rates.get(g_last_currency_code);
 
        $$('.currency_symbol').each(function(e) { e.innerHTML = symbol; });
        $$('.price_field').each(function(e) { if (e.value) e.value = parseInt(Math.round(e.value*fx_rate)); });
        //$$('.additional_price_field').each(function(e) { if (e.innerHTML) e.innerHTML = parseInt(e.innerHTML*fx_rate); });
 
        g_last_currency_code = $('native_currency').value;
    }
</script> 
 
 
<h2>일일 요금</h2> 
<div class="padded-text"> 
<div id="daily_pricing_form"> 
<form action="<?=site_url('hosting/ajax_update_daily_pricing?hosting_id='.$room->id)?>" id="submit_daily_pricing_form" method="post">    로 표시합니다. <select id="operation" name="operation" onchange="if (this.value===&quot;Available&quot;) { jQuery(&quot;#daily_price_options&quot;).show(); } else { jQuery(&quot;#daily_price_options&quot;).hide(); };"><option value="Available" selected="selected">Available</option> 
<option value="Not Available">Not Available</option></select> 
 
    로부터 <input class="checkin" id="start_date" name="start_date" style="width:80px;" type="text" value="yy/mm/dd" /> 
    inclusively through
	<input class="checkout" id="end_date" name="end_date" style="width:80px;" type="text" value="yy/mm/dd" />.
 
    <span id="daily_price_options"> 
        가격은
        <span class="currency_symbol">$</span><input id="price_native" name="price_native" style="width:30px;" type="text" value="" />.
    </span> 
 
    <div> 
    <input class="submit" id="daily_range_submit" name="commit" type="submit" value="업데이트하기" /> 
    <img id="daily_range_spinner" class="spinner" src="/images/spinner.gif" style="display:none;"/> 
    <span id="submit-error" class="error-text"></span> 
    <span style="font-style: italic">수정사항 반영에 5분 정도 걸립니다.</span> 
</form></div> 
</div> 
</div> 
 
    </div> 
    <div class="box" id="weekly_section"> 
      
 
 
<style> 
  table.season { width:100%; }
  table.season td.label { font-weight:bold; }
 
  table.weekly input { width:25px; margin-right: 5px; }
  table.weekly .currency { font-size:9px; }
  td.dates { width: 75px; font-size: 0.85em; }
 
  table.season,
  table.weekly { line-height: 30px; }
</style> 
 
<h2>일주일 요금</h2> 
<div class="padded-text"> 
<form action="<?=site_url("hosting/ajax_save_pricing_subsection?hosting_id={$room->id}&amp;section=weekly")?>" method="post" onsubmit="$('weekly_submit').disabled=true;Element.show('weekly_spinner');; new Ajax.Request('/hosting/ajax_save_pricing_subsection?hosting_id=181683&amp;section=weekly', {asynchronous:true, evalScripts:true, parameters:Form.serialize(this)}); return false;"><div class="pricing-display"> 
    <p> 
      별도표시 없을 경우 일주일 요금 $<input id="weekly_price_native" name="weekly_price_native" style="width:35px;" type="text" /> 주 마다.<br/> 
      주의: 설정된 일주일 요금은 일일 요금보다 우선적으로 적용됩니다. 일일 요금에 변동이 있는 경우 일주일 요금도 그에 맞춰 설정하시기 바랍니다.
    </p> 
</div> 
    <p> 
      일주일 요금 설정 <select id="is_weekly_price_prorated" name="is_weekly_price_prorated"><option value="false">exactly 7-day periods</option> 
<option value="true" selected="selected">any stay of 7 or more days</option></select> 
    </p> 
 
    <table class="season"> 
      <tr> 
 
            <td class="label">Summer 2011</td> 
 
            <td class="label">Autumn 2011</td> 
 
            <td class="label">Winter 2012</td> 
 
            <td class="label">Spring 2012</td> 
 
            <td class="label">Summer 2012</td> 
      </tr> 
 
      <tr> 
            <td> 
                <table class="weekly"> 
 
                        <tr> 
                          <td class="dates" valign="middle">Jul 25-31</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2011-07-25" name="weekly_price[2011-07-25]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Aug 1-7</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2011-08-01" name="weekly_price[2011-08-01]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Aug 8-14</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2011-08-08" name="weekly_price[2011-08-08]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Aug 15-21</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2011-08-15" name="weekly_price[2011-08-15]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Aug 22-28</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2011-08-22" name="weekly_price[2011-08-22]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Aug 29 - Sep 4</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2011-08-29" name="weekly_price[2011-08-29]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Sep 5-11</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2011-09-05" name="weekly_price[2011-09-05]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Sep 12-18</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2011-09-12" name="weekly_price[2011-09-12]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
                </table> 
            </td> 
            <td> 
                <table class="weekly"> 
 
                        <tr> 
                          <td class="dates" valign="middle">Sep 19-25</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2011-09-19" name="weekly_price[2011-09-19]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Sep 26 - Oct 2</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2011-09-26" name="weekly_price[2011-09-26]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Oct 3-9</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2011-10-03" name="weekly_price[2011-10-03]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Oct 10-16</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2011-10-10" name="weekly_price[2011-10-10]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Oct 17-23</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2011-10-17" name="weekly_price[2011-10-17]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Oct 24-30</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2011-10-24" name="weekly_price[2011-10-24]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Oct 31 - Nov 6</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2011-10-31" name="weekly_price[2011-10-31]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Nov 7-13</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2011-11-07" name="weekly_price[2011-11-07]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Nov 14-20</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2011-11-14" name="weekly_price[2011-11-14]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Nov 21-27</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2011-11-21" name="weekly_price[2011-11-21]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Nov 28 - Dec 4</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2011-11-28" name="weekly_price[2011-11-28]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Dec 5-11</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2011-12-05" name="weekly_price[2011-12-05]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Dec 12-18</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2011-12-12" name="weekly_price[2011-12-12]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
                </table> 
            </td> 
            <td> 
                <table class="weekly"> 
 
                        <tr> 
                          <td class="dates" valign="middle">Dec 19-25</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2011-12-19" name="weekly_price[2011-12-19]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Dec 26 - Jan 1</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2011-12-26" name="weekly_price[2011-12-26]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Jan 2-8</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2012-01-02" name="weekly_price[2012-01-02]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Jan 9-15</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2012-01-09" name="weekly_price[2012-01-09]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Jan 16-22</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2012-01-16" name="weekly_price[2012-01-16]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Jan 23-29</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2012-01-23" name="weekly_price[2012-01-23]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Jan 30 - Feb 5</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2012-01-30" name="weekly_price[2012-01-30]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Feb 6-12</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2012-02-06" name="weekly_price[2012-02-06]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Feb 13-19</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2012-02-13" name="weekly_price[2012-02-13]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Feb 20-26</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2012-02-20" name="weekly_price[2012-02-20]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Feb 27 - Mar 4</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2012-02-27" name="weekly_price[2012-02-27]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Mar 5-11</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2012-03-05" name="weekly_price[2012-03-05]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Mar 12-18</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2012-03-12" name="weekly_price[2012-03-12]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
                </table> 
            </td> 
            <td> 
                <table class="weekly"> 
 
                        <tr> 
                          <td class="dates" valign="middle">Mar 19-25</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2012-03-19" name="weekly_price[2012-03-19]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Mar 26 - Apr 1</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2012-03-26" name="weekly_price[2012-03-26]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Apr 2-8</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2012-04-02" name="weekly_price[2012-04-02]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Apr 9-15</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2012-04-09" name="weekly_price[2012-04-09]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Apr 16-22</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2012-04-16" name="weekly_price[2012-04-16]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Apr 23-29</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2012-04-23" name="weekly_price[2012-04-23]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Apr 30 - May 6</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2012-04-30" name="weekly_price[2012-04-30]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">May 7-13</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2012-05-07" name="weekly_price[2012-05-07]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">May 14-20</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2012-05-14" name="weekly_price[2012-05-14]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">May 21-27</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2012-05-21" name="weekly_price[2012-05-21]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">May 28 - Jun 3</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2012-05-28" name="weekly_price[2012-05-28]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Jun 4-10</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2012-06-04" name="weekly_price[2012-06-04]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Jun 11-17</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2012-06-11" name="weekly_price[2012-06-11]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
                </table> 
            </td> 
            <td> 
                <table class="weekly"> 
 
                        <tr> 
                          <td class="dates" valign="middle">Jun 18-24</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2012-06-18" name="weekly_price[2012-06-18]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Jun 25 - Jul 1</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2012-06-25" name="weekly_price[2012-06-25]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Jul 2-8</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2012-07-02" name="weekly_price[2012-07-02]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Jul 9-15</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2012-07-09" name="weekly_price[2012-07-09]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Jul 16-22</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2012-07-16" name="weekly_price[2012-07-16]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Jul 23-29</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2012-07-23" name="weekly_price[2012-07-23]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Jul 30 - Aug 5</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2012-07-30" name="weekly_price[2012-07-30]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Aug 6-12</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2012-08-06" name="weekly_price[2012-08-06]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Aug 13-19</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2012-08-13" name="weekly_price[2012-08-13]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Aug 20-26</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2012-08-20" name="weekly_price[2012-08-20]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Aug 27 - Sep 2</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2012-08-27" name="weekly_price[2012-08-27]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Sep 3-9</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2012-09-03" name="weekly_price[2012-09-03]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates" valign="middle">Sep 10-16</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="weekly_price_2012-09-10" name="weekly_price[2012-09-10]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
                </table> 
            </td> 
      </tr> 
 
    </table> 
 
    <br /> 
    <input class="submit" id="weekly_submit" name="commit" type="submit" value="변경 사항 저장하기" /> 
    <img id="weekly_spinner" class="spinner" src="/images/spinner.gif" style="display:none;"/> 
 
</form></div> 
 
    </div> 
    <div class="box" id="monthly_section"> 
      
 
 
<style> 
  table.season { width:100%; }
  table.season td.label { font-weight:bold; }
 
  table.monthly td.dates { width:40px; text-align: right; padding-right: 5px; }
  table.monthly input { width:35px; margin-right: 20px; }
 
</style> 
 
<h2>일개월 요금 설정</h2> 
<div class="padded-text"> 
<form action="<?=site_url("hosting/ajax_save_pricing_subsection?hosting_id={$room->id}&amp;section=monthly")?>" method="post" onsubmit="$('monthly_submit').disabled=true;Element.show('monthly_spinner');; new Ajax.Request('/hosting/ajax_save_pricing_subsection?hosting_id=181683&amp;section=monthly', {asynchronous:true, evalScripts:true, parameters:Form.serialize(this)}); return false;"> 
<div class="pricing-display"> 
    <p> 
      별도표시 없을 경우 일개월 요금 $<input id="monthly_price_native" name="monthly_price_native" style="width:35px;" type="text" /> 달 마다.
    </p> 
</div> 
    <p> 
 
      일개월 요금 설정 
      <select id="is_monthly_price_prorated" name="is_monthly_price_prorated"><option value="false">exactly one-month periods</option> 
<option value="true" selected="selected">any stay of one month or more</option></select> 
    </p> 
 
    <table class="season"> 
      <tr> 
 
            <td class="label">Summer 2011</td> 
 
            <td class="label">Autumn 2011</td> 
 
            <td class="label">Winter 2012</td> 
 
            <td class="label">Spring 2012</td> 
 
            <td class="label">Summer 2012</td> 
      </tr> 
 
      <tr> 
            <td> 
                <table class="monthly"> 
 
                        <tr> 
                          <td class="dates">July</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="monthly_price_2011-07-01" name="monthly_price[2011-07-01]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates">August</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="monthly_price_2011-08-01" name="monthly_price[2011-08-01]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
                </table> 
            </td> 
            <td> 
                <table class="monthly"> 
 
                        <tr> 
                          <td class="dates">September</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="monthly_price_2011-09-01" name="monthly_price[2011-09-01]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates">October</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="monthly_price_2011-10-01" name="monthly_price[2011-10-01]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates">November</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="monthly_price_2011-11-01" name="monthly_price[2011-11-01]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
                </table> 
            </td> 
            <td> 
                <table class="monthly"> 
 
                        <tr> 
                          <td class="dates">December</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="monthly_price_2011-12-01" name="monthly_price[2011-12-01]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates">January</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="monthly_price_2012-01-01" name="monthly_price[2012-01-01]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates">February</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="monthly_price_2012-02-01" name="monthly_price[2012-02-01]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
                </table> 
            </td> 
            <td> 
                <table class="monthly"> 
 
                        <tr> 
                          <td class="dates">March</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="monthly_price_2012-03-01" name="monthly_price[2012-03-01]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates">April</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="monthly_price_2012-04-01" name="monthly_price[2012-04-01]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates">May</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="monthly_price_2012-05-01" name="monthly_price[2012-05-01]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
                </table> 
            </td> 
            <td> 
                <table class="monthly"> 
 
                        <tr> 
                          <td class="dates">June</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="monthly_price_2012-06-01" name="monthly_price[2012-06-01]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates">July</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="monthly_price_2012-07-01" name="monthly_price[2012-07-01]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
 
                        <tr> 
                          <td class="dates">August</td> 
                          <td> 
                            <span class="currency_symbol">$</span> 
                            <input id="monthly_price_2012-08-01" name="monthly_price[2012-08-01]" type="text" value="" /> 
                          </td> 
                        </tr> 
 
                </table> 
            </td> 
      </tr> 
 
    </table> 
 
    <br /> 
    <input class="submit" id="monthly_submit" name="commit" type="submit" value="변경 사항 저장하기" /> 
    <img id="monthly_spinner" class="spinner" src="/images/spinner.gif" style="display:none;"/> 
 
</form></div> 
 
    </div> 
  </li> 
  <li> 
    <div class="box" id="pricing_tools"> 
      
<form action="<?=site_url('hosting/ajax_price_check?hosting_id='.$room->id)?>" id="price-test-form" method="post"><div class="box" id="pricing_tools"> 
  <h2> 
    <span class="edit_room_icon craigslist"></span> 
    <div> 
      이 도구를 사용해서 객실 가격이 제대로 계산되고 있는지 시험해 보세요.<br/> 
      '시험 가격 책정' 버튼을 클릭하시면 가격 명세서가 나타납니다.
    </div> 
  </h2> 
  <div class="middle"> 
    <ul> 
      <li> 
        <label for="price_check_checkin_date">체크인 하기</label> 
        <input class="checkin" id="price_check_checkin_date" name="price_check_checkin_date" type="text" value="2011/07/26" /> 
      </li> 
      <li> 
        <label for="price_check_checkout_date">체크아웃 하기</label> 
        <input class="checkout" id="price_check_checkout_date" name="price_check_checkout_date" type="text" value="2011/07/27" /> 
      </li> 
      <li> 
        <label for="price_check_checkout_date">여행객</label> 
        <select id="price_check_guests" name="price_check_guests"><option value="1" selected="selected">1</option> 
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
<option value="13">13</option></select> 
      </li> 
    </ul> 
  </div> 
</div> 
<div class="form-submit"> 
  <input class="button-glossy green" name="commit" type="submit" value="시험 가격 책정" /> 
  <span class="spinner"></span> 
  <div class="clear"></div> 
</div> 
<div class="box"> 
  <div class="middle"> 
    <ul> 
      <li id="price_test_result_container" style="display: none"> 
        <label for="breakdown">가격 명세서</label> 
        <div id="price_test_result"> 
          <span class="pricing_error"></span> 
          <span class="pricing_breakdown"></span> 
        </div> 
      </li> 
    </ul> 
  </div> 
</div> 
</form> 
 
    </div> 
  </li> 
</ul> 
 
      </div> 
    </div> 
  </div> 
  <div class="clear"></div> 
</div><!-- edit_room --> 
 
<?php $this->load->view('footer', array('no_closing' => true)); ?> 
 
<script type="text/javascript"> 
		
jQuery(document).ready(function(){
  jQuery('#daily_pricing_form').airbnbInputDateSpan(); 
 
  jQuery('#submit_daily_pricing_form').live('submit', function(){
    var $this = jQuery(this);
    var $spinner = $this.find('.spinner').show(); 
    jQuery('#submit-error').html('');
 
    jQuery.getJSON($this.attr('action'), $this.serialize(), function(data){
      $spinner.hide();
 
      if(data.result == 'error'){
        jQuery('#submit-error').html(data.reason);    
      }
      else {
        jQuery('#daily_section').html(data.payload);
        after_save();
 
        jQuery('#daily_pricing_form').airbnbInputDateSpan();
      }
    });
 
    return false;
  });
 
  jQuery('.delete-range').live('click', function(){
    var $this = jQuery(this);
    var startDate = $this.data('start-date');
    var endDate = $this.data('end-date');
    var hostingID = $this.data('hosting-id');
 
    $this.html('<img src="/images/spinner.gif" alt="spinner"/>');
 
    jQuery.getJSON('/hosting/ajax_update_daily_pricing',
                  {start_date: startDate, end_date: endDate, hosting_id: hostingID},
                  function(data){
                  console.log(data);
                    if(data.result === 'error'){
                      jQuery('#submit-error').html(data.reason);
                    }
                    else {
                      jQuery('#daily_section').html(data.payload);
                      after_save();
 
                      jQuery('#daily_pricing_form').airbnbInputDateSpan();
                    }
                  });
 
    return false;
  });
});
 
jQuery(document).ready(function(){
  jQuery('#price-test-form').submit(function(){
    var $ref = jQuery(this);
    var $spinner = jQuery('.spinner', this).show();  
    var $result_container = jQuery('#price_test_result_container').css('opacity', 0.4);
    var $pricing_error = jQuery('.pricing_error', $result_container);
    var $pricing_breakdown = jQuery('.pricing_breakdown', $result_container);
    
    jQuery.getJSON($ref.attr('action'), $ref.serialize(), function(data){
      if(data['error'] !== null)
        $pricing_error.html(data['error']).show();
      else
        $pricing_error.hide();
 
      if(data['pricing'].length > 0){
        // if the first element is null, then get rid of it
        if(data['pricing'][0] == null)
          data['pricing'].shift();
 
        $pricing_breakdown.html(data['pricing'].join("<br/>")).show();
      }
      else
        $pricing_breakdown.hide();
 
      $spinner.hide();
      $result_container.css('opacity', 1.0).show();
    });
 
    return false;
  }).airbnbInputDateSpan();
});
 
		jQuery(document).ready(function() {
			Airbnb.init({userLoggedIn: <?=$this->tank_auth->is_logged_in()?'true':'false'?>});
		});
	</script> 
 
</html> 
 