<ul id="nav"> 
	<li class="active"><?=anchor('dashboard', lang('command_center_dashboard'));?></li> 
	<li ><?=anchor('inbox', lang('command_center_inbox'));?></li> 
	<li ><?=anchor('rooms', lang('command_center_hosting'));?></li> 
	<li ><?=anchor('trips', lang('command_center_traveling'));?></li> 
	<li ><?=anchor('account', lang('command_center_account'));?></li> 
</ul> 
<?php 
if(isset($sub)):
	switch($sub): 
	case 'rooms': ?>
	<ul class="subnav"> 
	    <li class="active" ><a href="/rooms">객실정보관리</a></li> 
	    <li><a href="/my_listings">예약관리</a></li> 
	    <li><a href="/hosting/standbys">스탠바이 리스트</a></li> 
	    <li><a href="/hosting/promote">객실홍보</a></li> 
	    <li><a href="/hosting/pricing"></a></li> 
	    <li><a href="/hosting/policies">환불정책</a></li> 
	    <!--<li><a href="/travel_plans?p=upcoming">미래의 여행</a></li>--> 
	</ul> 
<?php break;
	endswitch; ?>