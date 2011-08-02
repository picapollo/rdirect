<?php $this->load->view('header/calendar', $header); ?>
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
        prepareLightbox(<?=$room->id?>,"<?=$room->name?>",0,select_range_start,select_range_stop);
 
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
<?php
	$this->load->view('top_menu', array('starred'=>$starred));
	$this->load->view('rooms/edit_nav', array('selected'=>'calendar'));
?>
    <div class="col three-fourths content"> 
      
      <div id="notification-area"></div> 
      <div id="dashboard-content"> 
        <!--[if IE 6]>
  <style>
#calendar2 .tile_selected,
#calendar2 .tile_disabled,
#calendar2 .tile { margin-right: -20px; }
#calendar2 .line_reg { overflow: hidden; text-overflow: ellipsis;  }
  </style>
<![endif]--> 
 
 
    <script> 
 
var global_grid = null;
 
var columnInfo = ["Sun\u003Cbr /\u003EJul 17","Mon\u003Cbr /\u003EJul 18","Tue\u003Cbr /\u003EJul 19","Wed\u003Cbr /\u003EJul 20","Thu\u003Cbr /\u003EJul 21","Fri\u003Cbr /\u003EJul 22","Sat\u003Cbr /\u003EJul 23","Sun\u003Cbr /\u003EJul 24","Mon\u003Cbr /\u003EJul 25","Tue\u003Cbr /\u003EJul 26","Wed\u003Cbr /\u003EJul 27","Thu\u003Cbr /\u003EJul 28","Fri\u003Cbr /\u003EJul 29","Sat\u003Cbr /\u003EJul 30","Sun\u003Cbr /\u003EJul 31","Mon\u003Cbr /\u003EAug 01","Tue\u003Cbr /\u003EAug 02","Wed\u003Cbr /\u003EAug 03","Thu\u003Cbr /\u003EAug 04","Fri\u003Cbr /\u003EAug 05","Sat\u003Cbr /\u003EAug 06","Sun\u003Cbr /\u003EAug 07","Mon\u003Cbr /\u003EAug 08","Tue\u003Cbr /\u003EAug 09","Wed\u003Cbr /\u003EAug 10","Thu\u003Cbr /\u003EAug 11","Fri\u003Cbr /\u003EAug 12","Sat\u003Cbr /\u003EAug 13","Sun\u003Cbr /\u003EAug 14","Mon\u003Cbr /\u003EAug 15","Tue\u003Cbr /\u003EAug 16","Wed\u003Cbr /\u003EAug 17","Thu\u003Cbr /\u003EAug 18","Fri\u003Cbr /\u003EAug 19","Sat\u003Cbr /\u003EAug 20","Sun\u003Cbr /\u003EAug 21","Mon\u003Cbr /\u003EAug 22","Tue\u003Cbr /\u003EAug 23","Wed\u003Cbr /\u003EAug 24","Thu\u003Cbr /\u003EAug 25","Fri\u003Cbr /\u003EAug 26","Sat\u003Cbr /\u003EAug 27","Sun\u003Cbr /\u003EAug 28","Mon\u003Cbr /\u003EAug 29","Tue\u003Cbr /\u003EAug 30","Wed\u003Cbr /\u003EAug 31","Thu\u003Cbr /\u003ESep 01","Fri\u003Cbr /\u003ESep 02","Sat\u003Cbr /\u003ESep 03","Sun\u003Cbr /\u003ESep 04","Mon\u003Cbr /\u003ESep 05","Tue\u003Cbr /\u003ESep 06","Wed\u003Cbr /\u003ESep 07","Thu\u003Cbr /\u003ESep 08","Fri\u003Cbr /\u003ESep 09","Sat\u003Cbr /\u003ESep 10","Sun\u003Cbr /\u003ESep 11","Mon\u003Cbr /\u003ESep 12","Tue\u003Cbr /\u003ESep 13","Wed\u003Cbr /\u003ESep 14","Thu\u003Cbr /\u003ESep 15","Fri\u003Cbr /\u003ESep 16","Sat\u003Cbr /\u003ESep 17","Sun\u003Cbr /\u003ESep 18"];
var hostings = [{"price":345,"name":"nglish","available":0,"row":0,"id":<?=$room->id?>,"currency_symbol":"$","currency":"USD","lc_name":"nglish"}];
var schedules = [<?=json_encode($tiles)?>];
 
var reservationHash = new Hash({});
 
var g_start_date = date_parse_datestamp('<?=$start_date?>');
var g_stop_date = date_parse_datestamp('<?=$stop_date?>');
var g_today_index = 14;
 
var g_enable_change_dates = true;
 
 
/* Mouse tracking */
var g_mouse_x = 0;
var g_mouse_y = 0;
 
jQuery(document).ready(function(){
  jQuery(document).mousemove(function(e){
    g_mouse_x = e.pageX;
    g_mouse_y = e.pageY;
  });
});
 
function centerLightbox() {
    var boxWidth = jQuery('#lwlb_calendar2').width();
    var boxHeight= jQuery('#lwlb_calendar2').height();
    $('lwlb_calendar2').setStyle({ position:"absolute", left: (g_mouse_x - (boxWidth / 2))+"px", top: (g_mouse_y - boxHeight - 25)+"px"});
}
 
/***** SELECTION *****/
 
/* A span is selectable if it contains no atomic groups */
function is_selectable(gridRow,gridCol) {
    if (is_address_line(gridRow)) return false;
 
    var schedule = get_square(gridRow,gridCol);
    if (schedule.gid || schedule.confirmation) {
        return false;
    } else {
        return true;
    }
}
 
/* If atomic span / grouping, what are the bounds of the span? */
function getAtomicBounds(gridRow,gridCol) {
    var minCol = gridCol;
    var maxCol = gridCol;
 
    var grouping_uid = get_square(gridRow,gridCol).gid;
    while (get_square(gridRow,maxCol+1) && (get_square(gridRow,maxCol+1).gid==grouping_uid)) {
        maxCol+=1;
    }
    while (get_square(gridRow,minCol-1) && (get_square(gridRow,minCol-1).gid==grouping_uid)) {
        minCol-=1;
    }
    return [minCol,maxCol];
}
 
function getSpanBounds(gridRow,gridCol) {
    var minCol = gridCol;
    var maxCol = gridCol;
 
    if (get_square(gridRow,gridCol).sty=='single') return [minCol,maxCol];
    while (get_square(gridRow,maxCol+1) && (get_square(gridRow,maxCol+1).sty!='right')) {
        maxCol+=1;
    }
    return [minCol,maxCol+1];
}
 
 
/* rendering */
/*
function getHeaderText(colIndex) {
    if (0==colIndex) return '&nbsp;';
    var colDataIndex = colIndex-1;
 
    var starting_tag = "";
    var closing_tag = "";
 
    if (colDataIndex < g_today_index) {
        starting_tag = '<span class="past">';
        closing_tag = '</span>';
    } else if (colDataIndex == g_today_index) {
        starting_tag = '<span class="today">';
        closing_tag = '</span>';
    }
    return (starting_tag+columnInfo[colDataIndex]+closing_tag);
}
*/
 
 
function getSquareText(square,gridRow,gridCol) {
    var dataRow = gridRowToDataRow(gridRow);
    var dataCol = gridColToDataCol(gridCol);
 
    var hosting = hostings[dataRow];
    
    if (("left"==square.sty) || ("single"==square.sty)) {
        switch(square.st) {
        case 0:
            if (square.daily_price) {
                return hosting.currency_symbol + square.daily_price;
            } else {
                return hosting.currency_symbol + hosting.price;
            }
        case 2:
            if (square.notes) {
                return square.notes
            } else {
                return 'Not available';
            }
        case 5:
            if (square.notes) {
                return square.notes
            } else {
                return 'Not available';
            }
        case 3:
            if (square.notes) {
                return square.sst + ": " + square.notes
            } else {
                return square.sst + ': Not available';
            }
        case 4:
            return (square.reservation_value ? ""+hosting.currency_symbol+square.reservation_value+" " : '') + (square.square_subtype_other ?  square.square_subtype_other : (square.sst ? square.sst : "Other")) + (square.notes ? ": "+square.notes : '');
        case 1:
            var r = reservationHash.get(square.confirmation);
            if (!r) return '(error)';
            if (r.is_accepted) {
                return r.base_price + " Airbnb, " + r.guest_name +  (square.notes ? ": "+square.notes : '');
            } else {
                return r.base_price + " Airbnb, " + r.guest_name + " (PENDING)" + (square.notes ? ": "+square.notes : '');
            }
        default: return hosting.currency_symbol + hostings[dataRow].price;
        }
    } else if ((dataCol==0) && square.isa) {
        if (square.daily_price) {
            return hosting.currency_symbol + square.daily_price;
        } else {
            return hosting.currency_symbol + hosting.price;
        }
    } else {
        return "&nbsp;";
    }
}
 
 
function before_submit() {
	$('lightbox_submit').disabled = true;
	$('lightbox_spinner').show();
}
 
function after_submit() {
	$('lightbox_submit').disabled = false;
	$('lightbox_spinner').hide();
    lwlb_hide_special();
}
 
 
function prepareLightbox(hosting_id,hosting_name,gridRow,gridMinCol,gridMaxCol) {
    var firstSquare = get_square(gridRow,gridMinCol);
    var lastSquare = get_square(gridRow,gridMaxCol);
    var startDate = new Date(g_start_date.getTime()); //date_parse_datestamp(firstSquare.dt);
    var stopDate = new Date(g_start_date.getTime()); //date_parse_datestamp(lastSquare.dt);
 
    var dataRow = gridRowToDataRow(gridRow);
    var hosting = hostings[dataRow];
 
    $$("span.currency_symbol").each(function(x){ x.innerHTML=hosting.currency_symbol; });
    $('lwlb_currency').value = hosting.currency;
 
    startDate.setDate(startDate.getDate() + gridColToDataCol(gridMinCol));
    stopDate.setDate(stopDate.getDate() + gridColToDataCol(gridMaxCol));
 
    /* Applies to all lightbox styles */
 
    $('lightbox_submit').disabled = false;
	$('lightbox_spinner').hide();
 
    $('lwlb_hosting_id').value = hosting_id;
    $('lwlb_visible_row').value = gridRow;
 
    if (firstSquare.gid) {
        $('lwlb_grouping_uid').value = firstSquare.gid;
    } else {
        $('lwlb_grouping_uid').value = "";
    }
 
    $('lwlb_starting_date').value = $('lwlb_starting_date_original').value = date_print_usa_date(startDate);
    $('lwlb_stopping_date').value = $('lwlb_stopping_date_original').value = date_print_usa_date(stopDate);
    $('lwlb_data_start_date').value = date_print_usa_date(g_start_date);
    $('lwlb_confirmation').value = firstSquare.confirmation ? firstSquare.confirmation : '';
 
    /*if (firstSquare.notes) {
        if (firstSquare.notes) $('lwlb_notes').value = firstSquare.notes;
    } else {
        $('lwlb_notes').value = "Notes...";
    }*/
 
    $('lwlb_reservation_section').hide();
    $('lwlb_normal_section').hide();
 
    // Reservation Case
    if (firstSquare.st==1) {
        g_enable_change_dates = false;
        var r = reservationHash.get(firstSquare.confirmation);
 
        $('lwlb_availability').value = "Booked";
        $('lwlb_booking_service_other').value = "Airbnb";
 
        // Setup the date span
        $('lwlb_date_span_start').innerHTML = date_print_simplified(date_parse_datestamp(r.start_date));
        $('lwlb_date_span_stop').innerHTML = date_print_simplified(date_parse_datestamp(r.end_date));
        $('lwlb_date_single').hide();
        $('lwlb_date_span').show();
 
        $('lwlb_reservation_section').show();
        $('lwlb_reservation_guest_pic').src = r.guest_pic;
        $('lwlb_reservation_hosting_name').innerHTML = hosting_name;
 
        if (r.is_accepted) {
            $('lwlb_reservation_code').innerHTML = r.confirmation;
        } else {
            $('lwlb_reservation_code').innerHTML = "pending";
        }
        $('lwlb_reservation_guest_name').innerHTML = r.guest_name;
        $('lwlb_reservation_dates').innerHTML = date_print_simplified(date_parse_datestamp(r.start_date)) + " - " + date_print_simplified(date_parse_datestamp(r.end_date));
        $('lwlb_reservation_base_price').innerHTML = r.base_price;
        $('lwlb_reservation_guest_email').innerHTML = r.guest_email;
        $('lwlb_reservation_guest_email').href = "mailto:"+r.guest_email;
        $('lwlb_reservation_guest_phone').innerHTML = (""==r.guest_phone) ? "(unknown)" : r.guest_phone;
 
        if (r.is_accepted) {
            $('lwlb_reservation_contact').show();
            $('lwlb_reservation_itinerary').show();
            $('lwlb_reservation_accept').hide();
        } else {
            $('lwlb_reservation_contact').hide();
            $('lwlb_reservation_itinerary').hide();
            $('lwlb_reservation_accept').show();
        }
 
    } else {
        g_enable_change_dates = true;
        //if (minColIndex<g_today_index) return false; // disable click behavior if non-reservation
 
        $('lwlb_hosting_name').innerHTML = hosting_name;
 
        // Setup the date span
        if (gridMinCol==gridMaxCol) {
            $('lwlb_date_single').innerHTML = date_print_simplified(startDate);
            $('lwlb_date_single').show();
            $('lwlb_date_span').hide();
        } else {
            $('lwlb_date_span_start').innerHTML = date_print_simplified(startDate);
            $('lwlb_date_span_stop').innerHTML = date_print_simplified(stopDate);
            $('lwlb_date_single').hide();
            $('lwlb_date_span').show();
        }
 
        $('lwlb_normal_section').show();
 
        //$('price').value = ""; //schedules[i].daily_price;
        if ((0==firstSquare.st) || !firstSquare.st) {
            $('lwlb_availability').value = 'Available';
        } else if ((2==firstSquare.st) || (5==firstSquare.st)) {
            $('lwlb_availability').value = 'Not Available';
        } else {
            $('lwlb_availability').value = 'Booked';
        }
        lwlb_availability_changed();
 
        if (firstSquare.daily_price) {
            $('lwlb_daily_price').value = firstSquare.daily_price;
        } else {
            $('lwlb_daily_price').value = '';
        }
        /*if (firstSquare.st==4) {
            $('lwlb_booking_service').value = firstSquare.sst;
            if (firstSquare.sst=="Other") {
                $('lwlb_booking_service_other').value = firstSquare.square_subtype_other ? firstSquare.square_subtype_other : '';
                $('lwlb_booking_service_other').show();
                //$('lwlb_booking_service').value = 'Other';
            } else {
                $('lwlb_booking_service_other').value = '';
                $('lwlb_booking_service_other').hide();
 
            }
        } else {
            $('lwlb_booking_service').value = "";
            $('lwlb_booking_service_other').value = '';
            $('lwlb_booking_service_other').hide();
        }*/
        
        /*if (firstSquare.reservation_value) {
            $('lwlb_value').value = firstSquare.reservation_value;
        } else {
            $('lwlb_value').value = "";
        }*/
    }
 
    lwlb_show('lwlb_calendar2',{no_scroll: true});
 
    centerLightbox(); // specific to multi-calendar vs. singular calendar
}
 
 
/**** DATE HELPERS ****/
 
function get_month_abbrev(month) {
    return ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'][month];
}
 
function date_parse_datestamp(datestamp) {
    // yyyy-mm-dd
    var parts = datestamp.split("-");
    return new Date(parts[0],parts[1]-1,parts[2]);
    //return new Date(get_month_abbrev(parts[1]-1)+" "+parts[2]+", "+parts[0]+" 00:00:00 "); // parts[0],parts[1]-1,parts[2]
}
function date_parse_usa_date(datestamp) {
    // mm/dd/yyyy
    var parts = datestamp.split("/");
    return new Date(parts[2],parts[0]-1,parts[1]);
}
 
function date_print_usa_date(dt) {
    // 2010-03-11: KEEP IT IN THE LOCAL TIMEZONE; OTHERWISE DATE OFFSET PROBLEMS!
    return (dt.getMonth()+1) + "/" + dt.getDate() + "/" + dt.getFullYear();
}
 
function date_print_simplified(dt) {
    //return get_month_abbrev(dt.getUTCMonth()) + " " + dt.getUTCDate();
    // 2010-03-11: KEEP IT IN THE LOCAL TIMEZONE; OTHERWISE DATE OFFSET PROBLEMS!
    return get_month_abbrev(dt.getMonth()) + " " + dt.getDate();
}
 
</script> 
 
 
    <div id="lwlb_overlay" style="opacity:0.2;"></div> 
    <script> 
	
    function lwlb_force_stop_date_after_start() {
        var startDate = date_parse_usa_date($('lwlb_starting_date').value);
        var stopDate = date_parse_usa_date($('lwlb_stopping_date').value);
 
        if (startDate >= stopDate) {
            var newStopDate = new Date(startDate.getTime()+Date.one_day);
            $('lwlb_stopping_date').value = date_print_usa_date(newStopDate);
            $('lwlb_date_span_stop').innerHTML = date_print_simplified(newStopDate);
        }
    }
 
    function lwlb_start_date_calendar_popup() {
        if (!g_enable_change_dates) return false;
 
        new CalendarDateSelect($('lwlb_starting_date'), {
            popup_by:$('lwlb_date_span_start'),
            buttons:false,
            default_date_offset:0,
            year_range:[new Date().getFullYear(),new Date().getFullYear()+1],
            valid_date_check:function (dt){ return(dt >= calendar_helper_simple_today()); }
        } );
    }
 
    function lwlb_stop_date_calendar_popup() {
        if (!g_enable_change_dates) return false;
        
        var startDate = date_parse_usa_date($('lwlb_starting_date').value);
        var default_offset = Math.ceil((startDate - new Date())/Date.one_day) + 1;
 
        new CalendarDateSelect($('lwlb_stopping_date'), {
            popup_by:$('lwlb_date_span_stop'),
            buttons:false,
            default_date_offset:default_offset,
            year_range:[new Date().getFullYear(),new Date().getFullYear()+1],
            valid_date_check:function (dt){ return(dt > startDate); }
        } );
    }
 
    function lwlb_booking_service_changed() {
        if ($('lwlb_booking_service').value=="Other") {
            $('lwlb_booking_service_other').show();
        } else {
            $('lwlb_booking_service_other').hide();
        }
 
    }
 
    function lwlb_availability_changed() {
        //alert($('lwlb_availability').value);
        switch ($('lwlb_availability').value) {
        case 'Available':
            $('lwlb_row_per_night').show();
           // $('lwlb_row_service').hide();
            $('lwlb_row_value').hide();
            //$('lwlb_notes').hide();
            break;
        case 'Not Available':
            $('lwlb_row_per_night').hide();
            //$('lwlb_row_service').hide();
           //$('lwlb_row_value').hide();
            //$('lwlb_notes').show();
            break;
        /*case 'Booked':
            $('lwlb_row_per_night').hide();
            $('lwlb_row_service').show();
            $('lwlb_row_value').show();
            $('lwlb_notes').show();
            break;*/
        }
    }
 
 
    function lwlbOpenProfile() {
        var confirmation = $('lwlb_confirmation').value;
        var record = reservationHash.get(confirmation);
        window.open('http://www.airbnb.com/users/show/'+record.guest_id);
    }
 
    function lwlbOpenMessage() {
        var confirmation = $('lwlb_confirmation').value;
        var record = reservationHash.get(confirmation);
        window.open('http://www.airbnb.com/messaging/qt_with/'+record.guest_id);
    }
 
    function lwlbOpenItinerary() {
        var confirmation = $('lwlb_confirmation').value;
        var record = reservationHash.get(confirmation);
        window.open('http://www.airbnb.com/reservation/print_confirmation/?code='+confirmation);
    }
 
    function lwlbOpenAcceptDecline() {
        var confirmation = $('lwlb_confirmation').value;
        var record = reservationHash.get(confirmation);
        window.open('http://www.airbnb.com/reservation/approve?code='+confirmation);
    }
 
 
</script> 
 
<div id="lwlb_calendar2" class="lwlb_lightbox_calendar"><div class="container"><div class="inner"> 
 
<form action="/calendar/modify_calendar?month=8" method="post" onsubmit="before_submit();; new Ajax.Request('/calendar/modify_calendar?month=<?=$month?>', {asynchronous:true, evalScripts:true, parameters:Form.serialize(this)}); return false;"> 
        <input type="hidden" name="data_start_date" id="lwlb_data_start_date" value="" /> 
        <input type="hidden" name="confirmation" id="lwlb_confirmation" value="" /> 
 
 
        <input type="hidden" name="starting_date_original" id="lwlb_starting_date_original" value="" /> 
        <input type="hidden" name="stopping_date_original" id="lwlb_stopping_date_original" value="" /> 
 
        <input type="hidden" name="grouping_uid" id="lwlb_grouping_uid" value="" /> 
        <input type="hidden" name="currency" id="lwlb_currency" value="" /> 
 
        <input type="hidden" name="starting_date" id="lwlb_starting_date" value="" onchange="$('lwlb_date_span_start').innerHTML = date_print_simplified(date_parse_usa_date(this.value)); lwlb_force_stop_date_after_start();" /> 
        <input type="hidden" name="stopping_date" id="lwlb_stopping_date" value="" onchange="$('lwlb_date_span_stop').innerHTML = date_print_simplified(date_parse_usa_date(this.value)); lwlb_force_stop_date_after_start();" /> 
        <input type="hidden" name="hosting_id" id="lwlb_hosting_id" value=""> 
        <input type="hidden" name="visible_row" id="lwlb_visible_row" value=""> 
 
 
 
        <div id="lwlb_reservation_section" style="margin-bottom:10px;"> 
            <div class="header bottom_line"> 
                <div class="header_text" style="float:left;"> 
                    <span id="lwlb_reservation_guest_name">여행객 이름</span> 
                    (<span id="lwlb_reservation_code">코드</span>)
                </div> 
 
                <div class="close"><a href="#" onclick="lwlb_hide_special();return false;"><img src="/images/lightboxes/close_button.gif" /></a></div> 
                <div class="clear"></div> 
            </div> 
 
            <div class="bottom_line"> 
                <div style="float:left;width:60px;"> 
                  <img id="lwlb_reservation_guest_pic" src="" style="width:50px;height:50px;" /> 
                </div> 
                <div style="float:left;width:200px;"> 
                    <div><span class="label">날짜:</span> <span id="lwlb_reservation_dates">날짜</span></div> 
                    <div><span class="label">장소:</span> <span id="lwlb_reservation_hosting_name">날짜</span></div> 
                    <div><span class="label">가격:</span> <span id="lwlb_reservation_base_price">가격</span></div> 
                </div> 
                <div class="clear"></div> 
            </div> 
 
 
 
            <div style=""> 
                <span id="lwlb_reservation_contact"><a id="lwlb_reservation_contact_details_show_link" href="#" onclick="Element.hide('lwlb_reservation_contact_details_show_link');Element.show('lwlb_reservation_contact_details');Element.show('lwlb_reservation_contact_details_hide_link');return(false);" >Contact</a><a id="lwlb_reservation_contact_details_hide_link" href="#" onclick="Element.hide('lwlb_reservation_contact_details_hide_link');Element.show('lwlb_reservation_contact_details_show_link');Element.hide('lwlb_reservation_contact_details');return(false);" style="display:none;">Hide Contact</a> |</span> 
                <a href="#" onclick="lwlbOpenProfile();return false;">프로필</a> |
                <a href="#" onclick="lwlbOpenMessage();return false;">메세지함</a> 
                <span id="lwlb_reservation_itinerary">| <a href="#" onclick="lwlbOpenItinerary();return false;">여행내역</a></span> 
                <span id="lwlb_reservation_accept">| <a href="#" onclick="lwlbOpenAcceptDecline();return false;">수락하기/거절하기</a></span> 
            </div> 
 
            <div id="lwlb_reservation_contact_details" style="display:none;border-top: 1px solid #CBCACA; padding-top:5px; margin-top:5px;"> 
                <span class="label">이메일 주소:</span> <a id="lwlb_reservation_guest_email" href="#">여행객 이메일</a> 
                <span class="label">전화:</span> <span id="lwlb_reservation_guest_phone">여행객 모바일 번호</span> 
            </div> 
        </div> 
 
        <div id="lwlb_normal_section"> 
            <div class="header bottom_line"> 
                <div id="lwlb_hosting_name" class="header_text" style="float:left;">호스팅 이름</div> 
 
                <div class="close"><a href="#" onclick="lwlb_hide_special();return false;"><img src="/images/lightboxes/close_button.gif" /></a></div> 
                <div class="clear"></div> 
            </div> 
 
 
            <div id="lwlb_date_single">일박</div> 
 
            <div id="lwlb_date_span"> 
                <span id="lwlb_date_span_start" class="calendar_link" onclick="lwlb_start_date_calendar_popup();">체크인</span> -
                <span id="lwlb_date_span_stop" class="calendar_link" onclick="lwlb_stop_date_calendar_popup();">체크아웃</span> 
            </div> 
            <br /> 
 
 
            <div style="padding-bottom:5px;"> 
                <table> 
                    <tr> 
                        <td style="width:80px;">이용 가능성</td> 
                        <td><select id="lwlb_availability" name="availability" value="" onchange="lwlb_availability_changed();" ><option value="Available">Available</option> 
<option value="Not Available">Not Available</option></select></td> 
                    </tr> 
                    <tr id="lwlb_row_per_night"> 
                        <td style="width:80px;">Per night</td> 
                        <td><span class="currency_symbol">xxx</span><input type="text" style="width:35px;" id="lwlb_daily_price" name="daily_price_native" value="" onfocus="" onclick="" /></td> 
                    </tr> 
                    <tr id="lwlb_row_value"> 
                        <td style="width:80px;">Value</td> 
                        <td><span class="currency_symbol">xxx</span><input type="text" style="width:35px;" id="lwlb_value" name="value_native" value="" onfocus="" onclick="" /></td> 
                    </tr> 
                </table> 
            </div> 
        </div> 
 
        <div style="margin-top:5px;text-align:right;"> 
            <input id="lightbox_submit" name="commit" type="submit" value="Submit" /> 
            <img src="/images/spinner.gif" id="lightbox_spinner" style="display:none;"/> 
              <a href="#" onclick="lwlb_hide_special();return false;">취소</a> 
        </div> 
      
</form></div></div></div> 
 
 
 
 
<div> 
<div class="box"> 
<h2 class="step"><span class="edit_room_icon calendar"></span>Calendar</h2> 
<div id="calendar2" class="middle"> 
  <div id="backdrop">  
<div class="clear"></div> 
<div> 
<script> 
    var select_range_start = null;
    var select_range_stop = null;
    var select_range_click_count = 0;
</script> 
 
<div class="full_bubble"> 
	<div class="inner"> 
		<div> 
 
			<div class="calendar-header"> 
				<div class="prev-month"><a href="<?=site_url('calendar/single/'.$room->id.'?month='.($month==1?'12':$month-1).'&year='.($month==1?$year-1:$year))?>"><img alt="이전의" height="34" src="/images/scheduling/bttn_month_prev.gif" width="35" /></a></div> 
				<div class="next-month"><a href="<?=site_url('calendar/single/'.$room->id.'?month='.($month==12?'1':$month+1).'&year='.($month==12?$year+1:$year))?>"><img alt="다음" height="34" src="/images/scheduling/bttn_month_next.gif" width="35" /></a></div> 
				<div class="display-month"><?=$month?>월 <?=$year?></div> 
				<div class="clear"></div> 
			</div> 
 
			<div> 
				<div> 
					<div class="day_header">일</div> 
					<div class="day_header">월</div> 
					<div class="day_header">화</div> 
					<div class="day_header">수</div> 
					<div class="day_header">목</div> 
					<div class="day_header">금</div> 
					<div class="day_header">토</div> 
					<div class="clear"></div> 
				</div> 
 				<?php 
 					for($i=$start_idx, $c_idx=0; $i<=$stop_idx; $i++, $c_idx++):	
 						if( ! ($i%7)) echo '<div>';
 				?>
                                <div class="tile <?=$calendar[$c_idx]->disabled ? 'disabled':''?>" id="tile_<?=$i?>" <?php if( ! $calendar[$c_idx]->disabled):?> onmousedown="click_down(<?=$i?>);" onmouseup="click_up(<?=$i?>);" onmouseover="range_add(<?=$i?>);" onmouseout="range_remove(<?=$i?>);" <?php endif; ?>> 
                                  <div class="tile_container"> 
                                    <div class="day"><?=$calendar[$c_idx]->d?></div> 
                                    <div class="line_reg <?=$tiles[$i]->cl.' '.$tiles[$i]->sty?>" style="z-index:<?=$stop_idx - $i?>;" id="square_<?=$i?>"> 
                                      <span class="startcap"></span> 
                                      <span class="content"></span> 
                                      <span class="endcap"></span> 
                                    </div> 
                                  </div> 
                                </div> 
				<?php if( ! (($i+1) % 7)) echo '<div class="clear"></div> </div>'; endfor; ?>
			</div> 
		</div> 
	</div> 
</div> 
 
<script> 
function render_grid(start_idx, stop_idx) {
    var prev_square;
 
    // ignore the first and last week of data (since it is padding)
    for(var i = start_idx; i <= stop_idx; i++){
      var square = schedules[0][i];
      var e = jQuery('#square_' + i);
 
      if(e.length == 0 || square === undefined)
        continue;
 
      var text = getSquareText(square, 0);
 
      // append to the square text if we detect that it's blocked out because the host denied a reservation
      if(prev_square != null && ((prev_square.st != square.st && square.st == 2 && square.gid != null) ||
        (prev_square.st == square.st && square.st == 2 && prev_square.gid == null && square.gid != null)))
        text += " (denied booking)";
 
      var span = getSpanBounds(0, i);
 
      var width = span[1] - span[0] + 1;
 
      if(text.length > (width * 8)){
        e.attr('title', text);
        text = text.substr(0, (width * 16) - 4) + "...";
      }
 
      e.find('span.content').html(text);
      var baseClass = e.attr('class').split(' ')[0];
      e.attr('class', baseClass + " " + square.cl + " " + square.sty);
 
      prev_square = square;
    }
}
render_grid(<?=$start_idx.','.$stop_idx?>);
//render_grid(14, 49);
</script> 
 
</div> 
 
<div class="clear"></div> 
<div class="privacy"> 
  달력에 표시되는 개인정보는 다른 회원들에게는 표시되지 않으며, 숙박가능 상황만 표시됩니다.
</div> 
</div><!-- backdrop --> 
</div><!-- calendar2 --> 
</div> 
</div> 

      </div> 
    </div> 
  </div> 
  <div class="clear"></div> 
</div><!-- edit_room --> 


<?php $this->load->view('footer', array('no_closing', true)); ?> 
 
	<script type="text/javascript">
 
		jQuery(document).ready(function() {
			Airbnb.init({userLoggedIn: <?=$this->tank_auth->is_logged_in()?>});
		});
 
	</script> 
</html> 