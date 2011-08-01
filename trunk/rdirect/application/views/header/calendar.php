
 
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml"> 
    <head><script>var NREUMQ=[];NREUMQ.push(["mark","firstbyte",new Date().getTime()]);(function(){var d=document;var e=d.createElement("script");e.type="text/javascript";e.async=true;e.src="https://d1ros97qkrwjf5.cloudfront.net/14/eum/rum.js	";var s=d.getElementsByTagName("script")[0];s.parentNode.insertBefore(e,s);})()</script> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/> 
        <title>휴가기간 임대, 전용 객실, 서블렛 - 에어비앤비에서의 숙박</title> 
 
        <meta name="title" content="휴가기간 임대, 전용 객실, 서블렛 - 에어비앤비에서의 숙박" /> 
 
    <link rel="image_src" href="/images/airbnb_logo.png" /> 
    <link rel="search" type="application/opensearchdescription+xml" href="/opensearch.xml" title="Airbnb" /> 
 
    <!--[if (!IE)|(gte IE 8)]><!--> 
<link href="<?=CSS_DIR?>/common-datauri.css" media="screen" rel="stylesheet" type="text/css" /> 
<!--<![endif]--> 
<!--[if lte IE 7]>
<link href="<?=CSS_DIR?>/common.css" media="screen" rel="stylesheet" type="text/css" />
<![endif]--> 
    <!--[if (!IE)|(gte IE 8)]><!--> 
<link href="<?=CSS_DIR?>/edit_listing-datauri.css" media="screen" rel="stylesheet" type="text/css" /> 
<!--<![endif]--> 
<!--[if lte IE 7]>
<link href="<?=CSS_DIR?>/edit_listing.css" media="screen" rel="stylesheet" type="text/css" />
<![endif]-->
    <link href="<?=CSS_DIR?>/calendar_single.css" media="screen" rel="stylesheet" type="text/css" /> 
 	<?php if(CURRENT_LANGUAGE=='ko'): ?>
      <link href="<?=CSS_DIR?>/korean_fonts.css" media="screen" rel="stylesheet" type="text/css" />
    <?php endif; ?> 
 
		<script src="<?=JS_DIR?>/common.js" type="text/javascript"></script> 
 
      <script src="<?=JS_DIR?>/jquery-ui-1.8.14.custom.min.js" type="text/javascript"></script> 
 
        <script src="<?=JS_DIR?>/jquery.ui.datepicker/jquery.ui.datepicker-ko.min.js" type="text/javascript"></script> 
 
      <script type="text/javascript"> 
        jQuery.noConflict();
      </script> 
 
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/prototype/1.6.0.3/prototype.js"></script> 
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/scriptaculous/1.8.2/scriptaculous.js"></script> 
      <script src="<?=JS_DIR?>/calendar_date_select/calendar_date_select.js" type="text/javascript"></script>
<?php if(CURRENT_LANGUAGE=='en'): ?> 
<script src="<?=JS_DIR?>/calendar_date_select/format_american.js" type="text/javascript"></script>
<?php endif; ?>
<link href="<?=CSS_DIR?>/calendar_date_select/silver.css" media="screen" rel="stylesheet" type="text/css" /> 
 
 
		    <style> 
      .past { color: gray; }
    </style> 
  <script src="<?=JS_DIR?>/edit_listing.js" type="text/javascript"></script> 
 
  <script type="text/x-jqote-template" id="notification-item-template"> 
  <![CDATA[
  <div class="<*= this.type *>">
    <span class="close"/>
    <span class="label"><*= this.label *></span>
  </div>
  ]]>
  </script> 
  <script src="<?=JS_DIR?>/widgets.js" type="text/javascript"></script> 
 
<script type="text/x-jqote-template" id="availability_button_template"> 
<![CDATA[
  <span class="clearfix current-availability icon <*= this.status *>">
    <span class="label"><*= this.label *></span>
    <span class="expand"></span>
  </span>
  <div class="toggle-info" style="display: none;">
    <div class="instructions"><*= this.instructions *></div>
    <div class="toggle-action-container">
      <a href="<*= this.url *>" class="toggle-action icon <*= this.next_status *>"><*= this.toggle_label *></a>
    </div>
  </div>
]]>
</script> 
 
<script type="text/javascript"> 
	function get_square(rowIndex,colIndex) {
        return schedules[rowIndex][colIndex];
    }
    function gridColToDataCol(gridCol) {
        return (gridCol);
    }
 
    function gridRowToDataRow(gridRow) {
        return (gridRow);
    }
 
    function update_calendar_data(visible_row,hosting_id,json) {
        //if (hosting_id!=hostings[data_row].id) alert('DEBUG1: ids do not match');
        schedules[0] = json[0];
        render_grid(14, 48);
    }
 
    // ---------------------------------------------------
    function is_address_line(row) {
        return false;
    }
 
    function lwlb_hide_special() {
        lwlb_hide('lwlb_calendar2');
        range_remove_all();
    }
 
    function range_add(i){
        //alert('range_add start: i='+i+', select_start='+select_range_start+', select_stop='+select_range_stop);
        if (select_range_stop == null) return;
        if (i < select_range_start) return;
 
        if (i < select_range_stop) range_remove(i+1);
        //alert('range_add start2: i='+i+', select_start='+select_range_start+', select_stop='+select_range_stop);
        //alert("i="+i+",stop="+select_range_stop);
 
        for (var tmp=select_range_stop; tmp <= i; tmp++) {
            if (!is_selectable(0,tmp)) return;
            
            rollover('tile_' + tmp, 'tile', 'tile_selected');
        }
        //alert('add');
        select_range_stop = i;
    }
 
    function range_remove(i) {
        //alert('range_remove start: i='+i+', select_start='+select_range_start+', select_stop='+select_range_stop);
 
        if (select_range_stop == null) return;
        if (i <= select_range_start) return;
        //if (i <= select_range_start) {
        //    select_range_start = i;
        //    range_add(i);
        //}
        
        if (select_range_click_count>=2) return;
        if (i>select_range_stop) return;
 
        for (; select_range_stop >= i; select_range_stop--) {
            //if (!is_selectable(0,select_range_stop)) return;
            
            rollover('tile_' + select_range_stop, 'tile_selected', 'tile');
        }
 
        //if (i<select_range_stop)
        select_range_stop = i;
    }
 
 
    function range_remove_all() {
        for (var i=select_range_start; i <= select_range_stop; i++) {
            rollover('tile_' + i, 'tile_selected', 'tile');
        }
 
        select_range_click_count = 0;
        select_range_start = null;
        select_range_stop = null;
    }
 
    function click_down(i) {
        select_range_click_count++;
 
        if (select_range_click_count > 2) {
            range_remove_all();
            return;
        }
 
        if (select_range_stop != null) return; // abort on second click
 
        if (!is_selectable(0, i)) {
            var matches = getAtomicBounds(0,i);
            select_range_start = matches[0];
            select_range_stop = matches[1];
            show_calendar();
            return;
        }
 
        select_range_start = i;
        select_range_stop = i;
        //alert("start="+select_range_start+",stop="+select_range_stop);
        rollover('tile_'+i,'tile','tile_selected');
    }
 
    function click_up(i) {
        if (select_range_click_count>=2) {
 
            show_calendar();
 
            //row = Math.floor(select_range_start / 7);
            //col = select_range_start % 7;
            //Element.setStyle($('lwlb_calendar2'), 'left:'+(130+col*106)+'px;');
            //Element.setStyle($('lwlb_calendar2'), 'top:'+(100+row*80)+'px;');
        }
    }
 
    function show_calendar() {
        prepareLightbox(179452,"\ud55c\uad6d\uc5b4",0,select_range_start,select_range_stop);
 
    }
 
  jQuery(document).ready(function(){
    AirbnbDashboard.init(); 
 
    
  });
 
  var buttonContent = {
    active: {
      label: "활성",
      instructions: "객실을 검색 결과에서 없앨려면 숨기기 기능을 이용하세요.",
      toggle_label: "숨기기"
    },
    inactive: {
      label: "숨김",
      instructions: "객실 등록을 활성화 시켜서 검생 결과에 나오게 하세요:",
      toggle_label: "활성화시키기"
    }
  };
 
  jQuery(document).ready(function(){
    jQuery('div.set-availability').availabilityWidget(buttonContent);
  });
 
			</script> 
		<link rel="shortcut icon" href="/airbnb_favicon.ico" /> 