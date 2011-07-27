<?php $this->load->view('header/common', $header); ?>
 
    <link href="http://s1.muscache.com/1311619230/stylesheets/dashboard_v2.css" media="screen" rel="stylesheet" type="text/css" /> 
    <link href="http://s1.muscache.com/1311619229/stylesheets/dashboard.css" media="screen" rel="stylesheet" type="text/css" /> 
 
	<script src="<?=JS_DIR?>/jquery.ui.datepicker/jquery.ui.datepicker-ko.min.js" type="text/javascript"></script> 
 
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
			  //
  // We can probably toss all of this code into a plugin at some point
  //
 
  var spinnerImage = new Image(); 
  spinnerImage.src = "<?=IMG_DIR?>/spinner.gif";
  
  VisibilityFilter = function(el, options){
    if(el)
      this.init(el, options);
  }
 
  jQuery.extend(VisibilityFilter.prototype, {
    name: 'visibilityFilter',
 
    init: function(el, options){
      this.element = $(el);
      $.data(el, this.name, this);
 
      var $this = this.element;
      var _ref = this;
 
      jQuery('#listings-filter .display-filter').click(function(){
        _ref.togglePanel();
      });
 
      jQuery('#listings-filter .toggle-filter a').click(function(){
        var $link = jQuery(this);
 
        if($link.hasClass('active'))
          _ref.setPanelState('active');
        else if($link.hasClass('inactive'))
          _ref.setPanelState('inactive');
        else
          _ref.setPanelState();
 
        _ref.showSpinner();
        _ref.hidePanel();
      });
 
      var outsideClickHandler = function(eventObject){
        eventObject.data.hidePanel();
      };
 
      // attach and detach handlers to make it possible to close the widget by clicking
      // outside of the element
      this.element.hover(
        function(){ jQuery(document).unbind('click', outsideClickHandler); },
        function(){ jQuery(document).bind('click', _ref, outsideClickHandler); }
      );
    },
 
    hidePanel: function(){
      this.element.removeClass('expand');
    },
 
    togglePanel: function(){
      this.element.toggleClass('expand');
    },
 
    showPanel: function(){
      this.element.addClass('expand');
    },
 
    setPanelState: function(state, showSpinner){
      if(!!showSpinner)
        this.showSpinner(); 
 
      this.element.removeClass('none inactive active');
      this.element.addClass(state);
    },
 
    showSpinner: function(){
      this.element.find('.display-filter span.icon:visible').not('.always').addClass('widget-spinner');
    },
 
    hideSpinner: function(){
      this.element.find('.display-filter span.widget-spinner').not('.always').removeClass('widget-spinner');
    }
 
 
  });
 
  jQuery.fn.visibilityFilter = function(options){
    // get the arguments 
    var args = $.makeArray(arguments),
        after = args.slice(1);
 
    return this.each(function() {
      // see if we have an instance
      var instance = $.data(this, 'visibilityFilter');
 
      if (instance) {
        // call a method on the instance
        if (typeof options === "string") {
          instance[options].apply(instance, after);
        } 
        else if (instance.update) {
          // call update on the instance
          instance.update.apply(instance, args);
        }
      } 
      else {
        // create the plugin
        new VisibilityFilter(this, options);
      }
    });
  }
 
  jQuery(document).ready(function(){
    jQuery('#post-listing-new').click(function(){
      document.location = base_url+"rooms/new";
    });
 
    jQuery('#listings-filter').visibilityFilter();
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
<?php $this->load->view('top_menu', array('starred' => $starred)); ?>
 
<div id="command_center"> 
  
<link href="<?=CSS_DIR?>/print.css" media="print" rel="stylesheet" type="text/css" /> 
 
<ul id="nav"> 
	<li ><?=anchor('dashboard', lang('command_center_dashboard'));?></li> 
	<li ><?=anchor('inbox', lang('command_center_inbox'));?></li> 
	<li class="active"><?=anchor('rooms', lang('command_center_hosting'));?></li> 
	<li ><?=anchor('trips', lang('command_center_traveling'));?></li> 
	<li ><?=anchor('account', lang('command_center_account'));?></li> 
</ul> 

<ul class="subnav"> 
    <li class="active"><?=anchor('rooms', '객실정보관리')?></li> 
    <li><?=anchor('my_listings', '예약관리');?></li> 
    <li><?=anchor('hosting/pricing', '가격책정');?></li> 
    <li><?=anchor('hosting/policies', '환불정책');?></li> 
    <!--<li><a href="/travel_plans?p=upcoming">미래의 여행</a></li>--> 
</ul> 
 
<div class="box">
		<div class="top"></div>
		<div class="middle">
			<div class="sort-header clearfix">
				<span class="action_button " id="listings-filter">
					<div class="display-filter">
						<span class="icon none always">보이기:</span>
						<span class="icon none">등록된 전체 객실<span class="expand"></span></span>
						<span class="icon active">객실 활성화<span class="expand"></span></span>
						<span class="icon inactive">숨겨진 객실<span class="expand"></span></span>
					</div>
					<div class="toggle-filter">
						<div>
							<a href="<?=site_url('rooms?f=all')?>" class="icon none">등록된 객실 모두 보이기</a>
						</div>
						<div>
							<a href="<?=site_url('rooms?f=active')?>" class="icon active">활성화된 객실 보이기</a>
						</div>
						<div>
							<a href="<?=site_url('rooms?f=inactive')?>" class="icon inactive">숨겨진 객실 보이기</a>
						</div>
					</div> </span>
				<span class="action_button" id="view_cal"><a href="/calendar" class="icon none">예전 달력 보기</a></span>
			</div>
			<div id="listings-container">
				<ul class="listings">
					<?php foreach($rooms as $room): ?>
					<li class="listing">
						<div class="thumbnail">
							<a href="<?=site_url('rooms/'.$room->id)?>">
							<img alt="Room_default_no_photos" src="<?=insert_room_photo($room->photo_id, 'x_small')?>" />
							</a>
						</div>
						<div class="set-availability action_button" data-has-availability="<?php echo ($room->activated=='1')?'true':'false'?>" data-available-url="<?=site_url('rooms/change_availability/'.$room->id.'?is_available=1&redirect=%2Frooms&sig='.$sig)?>" data-unavailable-url="<?=site_url('rooms/change_availability/'.$room->id.'?is_available=0&redirect=%2Frooms&sig='.$sig)?>"></div>
						<div class="listing-info">
							<h3><?=anchor('rooms/'.$room->id, $room->name)?></h3>
							<span class="actions"> <span class="action_button"><a href="/rooms/<?=$room->id?>/edit" class="icon edit">객실정보 수정</a></span> <span class="action_button"><a href="/rooms/<?=$room->id?>" class="icon view">객실정보 보기</a></span> <span class="action_button"><a href="/calendar/single/<?=$room->id?>" class="icon calendar">달력 보기</a></span> </span>
						</div>
						<div class="clear"></div>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
		<div class="bottom"></div>
	</div>
	</div> 
 
<?php $this->load->view('footer', array('no_closing')); ?>
	<script type="text/javascript">
		jQuery(document).ready(function() {
			Airbnb.init({userLoggedIn: <?=$this->tank_auth->is_logged_in()?>})
		});
	</script> 
</html> 