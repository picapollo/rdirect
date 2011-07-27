<?php $this->load->view('header/common', $header); ?>
<script type="text/javascript">
	jQuery.noConflict();
</script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/prototype/1.6.0.3/prototype.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/scriptaculous/1.8.2/scriptaculous.js"></script>
<script src="<?=JS_DIR?>/calendar_date_select/calendar_date_select.js" type="text/javascript"></script>
<script src="<?=JS_DIR?>/calendar_date_select/format_american.js" type="text/javascript"></script>
<link href="<?=CSS_DIR?>/calendar_date_select/silver.css" media="screen" rel="stylesheet" type="text/css" />
<link rel="canonical" href="<?=current_url()?>" />

<?php $this->load->view('top_menu', array('starred'=>$this->data['starred'])); ?>

<div id="profile2">
	<div class="backdrop">
		<div id="header_box">
			<div class="inner">
				<div class="title">
					<h1><?=$user->username?></h1>
					<div class="member_since">
						Member Since <?=date('Y m월', strtotime($user->created))?>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div>
			<div id="left_side">
				<div id="listing2">
					<div id="user">
						<div class="inner">
							<img alt="<?=$user->username?>" height="170" src="<?=$user->picture_path?>/large.png" title="<?=$user->username?>" width="170" />
							<div style="margin-bottom:15px;">
								<div class="page_link page_link_selected">
									<?=anchor('users/show/'.$user->id, $user->username)?>
								</div>
								<div class="page_link ">
									<?php //TODO if(listings->number == 1): ?>
									<?=anchor('rooms/'.$user->id, 'My Listing')?>
									<?php //TODO else: ?>
									<?=anchor('search?host_id='.$user->id, 'All Listings'); echo ' ('.'5'.')'?>
									<?php //endif; ?>
								</div>
							</div>
							<div class="row">
								<span class="property">School:</span> <?=$user->university?>
							</div>
							<div class="row">
								<span class="property">Work:</span> <?=$user->employer?>
							</div>
							<div class="row">
								<span class="property">Groups:</span><a href="/groups/uclabruins">UCLA</a>, <a href="/groups/John-Burroughs-High-School">John Burroughs High School</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="right_side">
				<!-- end comment section -->
				<br />
				<!-- MY LISTINGS -->
				<div class="white_box" style="margin-top:0px;">
					<div class="white_box_inner">
						<div class="h2">
						<?php //TODO if(listings->number == 1): ?>
							My Listing
						<?php // else: ?>
							Listings (<a href="http://www.airbnb.com/search?host_id=<?=$user->id?>">5 total</a>)
						<?php //endif; ?>
						</div>
						<table id="user_result_list">
							<!-- onclick="window.location='http://www.airbnb.com/rooms/109916';" onmouseout="rollover(this,'hover','');" onmouseover="rollover(this,'','hover');" -->
							<tr id="room_109916" class="even" >
								<td class="place_image"><a href="http://www.airbnb.com/rooms/109916" class="thumbnail">
								<img alt="COZY 2 BEDROOM-WALK TO TIMES SQ!" height="50" src="http://i1.muscache.com/pictures/816354/small.jpg" title="COZY 2 BEDROOM-WALK TO TIMES SQ!" width="75" />
								<span>
									<img alt="COZY 2 BEDROOM-WALK TO TIMES SQ!" height="144" src="http://i1.muscache.com/pictures/816354/small.jpg" title="COZY 2 BEDROOM-WALK TO TIMES SQ!" width="216" />
								</span></a></td>
								<td class="main">
								<div class="first-line title">
									<a href="http://www.airbnb.com/rooms/109916">COZY 2 BEDROOM-WALK TO TIMES SQ!</a>
								</div>
								<div>
									W 48th St, New York
								</div></td>
								<td class="space">
								<div class="first-line">
									&nbsp;
								</div> Entire home/apt </td>
								<td class="accommodates">
								<div class="first-line">
									&nbsp;
								</div> 5 </td>
								<td class="reviews">
								<div class="first-line">
									&nbsp;
								</div>
								<div>
									<img alt="Review" src="<?=IMG_DIR?>/icons/review.png" />
									10 reviews
								</div>
								<div>
									<img alt="Recommendation" src="<?=IMG_DIR?>/icons/recommendation.png" />
									1 friend
								</div></td>
								<td class="price">$210</td>
							</tr>
						</table>
						<?php //TODO if(listings->number > 1): ?>
						<div style="text-align:right;margin-top:5px;">
							<a href="http://www.airbnb.com/search?host_id=<?=$user->id?>">View All</a>
						</div>
						<?php //endif; ?>
					</div>
				</div>
				<!-- PROFILE INFO -->
				<div class="white_box">
					<div class="white_box_inner">
						<div class="h2">
							About <?=$user->username?>
						</div>
						<?=$user->about?>
					</div>
				</div>
				<!-- REVIEWS -->
				<div id="reviews" class="white_box" style="margin-top:10px;display:none;">
					<div class="white_box_inner">
						<div>
							<div class="h2">
								Reviews
							</div>
							<div style="margin-bottom:15px;padding-top:5px;border-top:thin dotted #BCB8B8;">
								<div style="float:left;margin-right:20px;  ">
									<a id="guest_reviews_link" onclick="switch_reviews('guest');return false;" href="#">Guest Reviews</a>
									<span id="guest_reviews_label" style="font-weight:bold;">Guest Reviews</span>
									(10)
								</div>
								<div style="float:left; display:none; ">
									<a id="host_reviews_link" onclick="switch_reviews('host');return false;" href="#">Host Reviews</a>
									<span id="host_reviews_label" style="font-weight:bold;">Host Reviews</span>
									(0)
								</div>
								<div class="clear"></div>
							</div>
							<div id="guest_reviews" style="" >
								<table class="quotes" style="width:100%;">
									<tr>
										<td width="80">
										<div>
											<a href="http://www.airbnb.com/users/show/747370" onclick="window.open(this.href);return false;">
											<img alt="Elizabeth O" height="50" src="http://s3.muscache.com/1308680853/images/user_pic-50x50.png" title="Elizabeth O" width="50" />
											</a>
										</div>
										<div>
											<a href="http://www.airbnb.com/users/show/747370" target="blank">Elizabeth</a>
										</div></td>
										<td>
										<div class="bubble">
											<div class="inner">
												<div class="content trans">
													We loved staying here because it is in a perfect location for tourists.  We walked to Broadway, the MOMA and got easily to Times Square.  The accommodations are wonderful and Julie is extremely helpful.  The restaurants around Julie’s are wonderful and suit multiple different tastes.  I highly recommend that others stay here.
												</div>
											</div>
										</div></td>
									</tr>
									<tr>
										<td width="80">
										<div>
											<a href="http://www.airbnb.com/users/show/279098" onclick="window.open(this.href);return false;">
											<img alt="Valerie B" height="50" src="http://i2.muscache.com/users/279098/profile_pic/1288971331/small.jpg" title="Valerie B" width="50" />
											</a>
										</div>
										<div>
											<a href="http://www.airbnb.com/users/show/279098" target="blank">Valerie</a>
										</div></td>
										<td>
										<div class="bubble">
											<div class="inner">
												<div class="content trans">
													I had a great experience staying in Julie's apt.  It was clean, cute and a perfect location for grandma and I to hop over to Lincoln Center.  It's pretty spacious for an ny apt and looks like it can hold at least 6 (1 bathroom).  Pros:  great location, safe neighborhood, super sweet/caring host - helped us to coordinate where to leave our bags after check out...helped me and my grandma up the stairs with our luggage.  Cons:  no real cons, just remember you've gotta go up 3 flights of stairs...and ladies, if there's a bunch of ya'll, bring an extra mirror - there's only one outside the bathroom - which is plenty for most.
													I'd really recommend this apt to anyone and would return there myself.  Thanks Julie!
												</div>
											</div>
										</div></td>
									</tr>
								</table>
							</div>
							<div id="host_reviews" style="display:none;" >
								<table class="quotes" style="width:100%;"></table>
							</div>
						</div>
					</div>
				</div>
				<script>function switch_reviews(type_to_show) {
						var type_to_hide = (type_to_show == 'host') ? 'guest' : 'host';

						$(type_to_show+"_reviews_link").hide();
						$(type_to_show+"_reviews_label").show();

						$(type_to_hide+"_reviews_link").show();
						$(type_to_hide+"_reviews_label").hide();

						$(type_to_show+"_reviews").show();
						$(type_to_hide+"_reviews").hide();
					}

					switch_reviews('guest');

					$('reviews').show();
</script>
				<div id="recommendations" class="white_box" style="margin-top:10px;">
					<div class="white_box_inner">
						<div>
							<div class="h2">
								Recommendations
							</div>
							<div style="margin-bottom:15px;padding-top:5px;border-top:thin dotted #BCB8B8;">
								<div style="float:left;margin-right:20px;">
									<span id="host_reviews_label" style="font-weight:bold;">Friend Recommendations (1)</span>
								</div>
								<div class="clear"></div>
							</div>
							<div id="recommendations">
								<table class="quotes" style="width:100%;">
									<tr>
										<td width="80">
										<div>
											<a href="http://www.airbnb.com/users/show/142519" onclick="window.open(this.href);return false;">
											<img alt="Amyn G" height="50" src="http://i0.muscache.com/users/142519/profile_pic/1298481864/small.jpg" title="Amyn G" width="50" />
											</a>
										</div>
										<div>
											<a href="http://www.airbnb.com/users/show/142519" target="blank">Amyn</a>
										</div></td>
										<td>
										<div class="bubble">
											<div class="inner">
												<div class="content trans">
													Julie is the perfect person to rent an apartment from.   She has impecable taste and her apartment is always designed well.   She also provides great advice on what to do, what to eat and where to go in Manhattan.   Plus she is always available to answer questions and give advice when staying with her.   I have rented may times over (website hidden) and airbnb and I would always go to her first when coming to manhattan.
												</div>
											</div>
										</div></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END RIGHT -->
		</div>
		<div class="clear"></div>
	</div>
</div>

<?php $this->load->view('footer'); ?>
