(function(j,o,r) {
	var q="hashchange",l=document,n,m=j.event.special,k=l.documentMode,p="on"+q in o&&(k===r||k>7);
	function s(a) {
		a=a||location.href;
		return"#"+a.replace(/^[^#]*#?(.*)$/,"$1")
	}

	j.fn[q]= function(a) {
		return a?this.bind(q,a):this.trigger(q)
	};
	j.fn[q].delay=50;
	m[q]=j.extend(m[q], {
		setup: function() {
			if(p) {
				return false
			}
			j(n.start)
		},
		teardown: function() {
			if(p) {
				return false
			}
			j(n.stop)
		}
	});
	n=(function() {
		var d= {},e,a=s(),c= function(h) {
			return h
		},b=c,f=c;
		d.start= function() {
			e||g()
		};
		d.stop= function() {
			e&&clearTimeout(e);
			e=r
		};
		function g() {
			var h=s(),i=f(a);
			if(h!==a) {
				b(a=h,i);
				j(o).trigger(q)
			} else {
				if(i!==a) {
					location.href=location.href.replace(/#.*/,"")+i
				}
			}
			e=setTimeout(g,j.fn[q].delay)
		}

		j.browser.msie&&!p&&(function() {
			var i,h;
			d.start= function() {
				if(!i) {
					h=j.fn[q].src;
					h=h&&h+s();
					i=j('<iframe tabindex="-1" title="empty"/>').hide().one("load", function() {
						h||b(s());
						g()
					}).attr("src",h||"javascript:0").insertAfter("body")[0].contentWindow;
					l.onpropertychange= function() {
						try {
							if(event.propertyName==="title") {
								i.document.title=l.title
							}
						} catch(t) {
						}
					}
				}
			};
			d.stop=c;
			f= function() {
				return s(i.location.href)
			};
			b= function(w,z) {
				var x=i.document,y=j.fn[q].domain;
				if(w!==z) {
					x.title=l.title;
					x.open();
					y&&x.write('<script>document.domain="'+y+'"<\/script>');
					x.close();
					i.location.hash=w
				}
			}
		})();
		return d
	})()
})(jQuery,this);
(function(l,i,k) {
	var h=l.FBConnect= {},a="#fbconnect_",d="/users/fbconnect_",c="login",j="fbconnect_",g=i(document),b=i(k),f= {
		onComplete: function() {
			k.location.reload()
		}
	},e=false;
	h.documentReady= function() {
		h._resetHash()
	};
	h.startLoginFlow= function(m) {
		if(typeof FB==="undefined") {
			return
		}
		m=i.extend(m,f);
		FB.login( function(n) {
			if(n.session) {
				h.trigger("connect_success");
				i.post(d+c, function(o) {
					h._colorbox(o);
					k.location.hash=i(".fbconnect_dialog").attr("id");
					setTimeout( function() {
						h._bindEvents(m)
					},400)
				})
			} else {
				h.trigger("connect_cancel")
			}
		}, {
			perms:l.FACEBOOK_PERMS
		})
	};
	h._loadDialog= function(m) {
		h._beginLoad();
		i.get(d+m, function(n) {
			h._finishLoad(n)
		})
	};
	h._loadDialogPost= function(m) {
		h._beginLoad();
		i.post(m.attr("action"),m.serialize(), function(n) {
			h._finishLoad(n)
		})
	};
	h._beginLoad= function() {
		i.colorbox.loading();
		h.trigger("load_begin")
	};
	h._finishLoad= function(m) {
		h._colorbox(m);
		h.trigger("load_complete");
		i.labelBlur();
		h._initAjaxForm();
		if(h._isEndOfTheLine()) {
			i.colorbox.noClose()
		}
	};
	h._colorbox= function(m) {
		i.colorbox({
			html:m,
			overlayClose:false
		})
	};
	h._initAjaxForm= function() {
		i("#colorbox form").submit( function() {
			h._loadDialogPost(i(this));
			return false
		})
	};
	h._bindEvents= function(m) {
		if(!e) {
			g.bind("cbox_cleanup", function() {
				if(h._isEndOfTheLine()) {
					m.onComplete();
					h.trigger("complete")
				} else {
					h.trigger("bail");
					h._resetHash()
				}
				b.unbind("hashchange.fbconnect")
			});
			i("#cboxContent a[rel]").live("click", function() {
				var o=i(this),n=o.attr("href").split(a)[1];
				if(o.attr("rel")==="back") {
					history.go(-1);
					return false
				}
			})
		}
		e=true;
		b.bind("hashchange.fbconnect", function() {
			var n=k.location.hash.split(a)[1];
			if(n&&n.length) {
				h._loadDialog(n)
			}
		})
	};
	h._isEndOfTheLine= function() {
		return i(".fbconnect_dialog.end_of_the_line").length>0
	};
	h.getUid= function() {
		return FB.getSession().uid
	};
	h.trigger= function(m) {
		g.trigger(j+m)
	};
	h.bind= function() {
		var m=Array.prototype.slice.call(arguments,0);
		m[0]=j+m[0];
		i.fn.bind.apply(g,m)
	};
	h.one= function() {
		var m=Array.prototype.slice.call(arguments,0);
		m[0]=j+m[0];
		i.fn.one.apply(g,m)
	};
	h._resetHash= function() {
		if(k.location.hash.indexOf("fbconnect_")!==-1) {
			k.location.hash=""
		}
	};
	i(document).ready(h.documentReady)
})(Airbnb,jQuery,window);
var Translations= {
	clear_dates:"Clear Dates",
	entire_place:"Entire Place",
	friend:"friend",
	friends:"friends",
	loading:"Loading",
	neighborhoods:"Neighborhoods",
	private_room:"Private Room",
	review:"review",
	reviews:"reviews",
	superhost:"superhost",
	shared_room:"Shared Room",
	today:"Today",
	you_are_here:"You are Here",
	a_friend:"a friend",
	distance_away:"away",
	instant_book:"Instant Book",
	social_connections:"Social Connections",
	show_more:"Show More...",
	learn_more:"Learn More",
	amenities:"Amenities",
	room_type:"Room Type",
	price:"Price",
	keywords:"Keywords",
	property_type:"Property Type",
	bedrooms:"Bedrooms",
	bathrooms:"Bathrooms",
	beds:"Beds",
	languages:"Languages",
	collection:"Collection",
	host:"Host",
	group:"Group",
	connections:"Connections",
	redo_search_in_map_tip:'"Redo search in map" must be checked to see new results as you move the map',
	zoom_in_to_see_more_properties:"Zoom in to see more properties",
	your_search_was_too_specific:"Your search was a little too specific.",
	we_suggest_unchecking_a_couple_filters:"We suggest unchecking a couple filters, zooming out, or searching for a different city."
};
function clean_up_and_submit_search_request() {
	AirbnbSearch.loadNewResults();
	return false
}

function select_search_type_button(a) {
	$(".search_type_option").removeClass("search_type_option_active");
	a.addClass("search_type_option_active");
	a.removeClass("search_type_option_hover")
}

function display_search_type(b,e) {
	var f,d;
	$("#map_message").hide();
	e=(typeof(e)=="undefined")?true:e;
	var g=AirbnbSearch.currentViewType;
	if(g===b.replace("search_type_","")) {
		return false
	}
	select_search_type_button($("#"+b));
	AirbnbSearch.changing_display_type=true;
	if(b==="search_type_photo") {
		SS.initOnce();
		AirbnbSearch.currentViewType="photo";
		$("#v3_search").removeClass("list_view map_view").addClass("photo_view");
		d="small"
	} else {
		if(b==="search_type_list") {
			AirbnbSearch.currentViewType="list";
			$("#v3_search").removeClass("map_view photo_view").addClass("list_view");
			d="x_small"
		} else {
			if(b==="search_type_map") {
				SS.initOnce();
				AirbnbSearch.currentViewType="map";
				AirbnbSearch.hideBannerForRemainderOfSession=true;
				var c=AMM.map.getCenter();
				var h=AMM.map.getZoom();
				if(h<13) {
					h=h+2
				}
				if(e===false&&render_results(AirbnbSearch.resultsJson)) {
					render_results_oncomplete(AirbnbSearch.resultsJson)
				}
				$("#cc_attribution_link").addClass("force_hide");
				$("#v3_search").removeClass("list_view photo_view").addClass("map_view condensed_header_view");
				google.maps.event.addListenerOnce(AMM.map,"resize", function() {
					AMM.map.setCenter(c);
					AMM.map.setZoom(h)
				});
				google.maps.event.trigger(AMM.map,"resize");
				jQuery("#results_filters").insertAfter("#standby_action_area");
				jQuery("#results_save").insertAfter("#applied_filters");
				jQuery("#map_wrapper").appendTo("#v3_search");
				jQuery("#map_options").prependTo("#search_filters");
				append_to_map_div(jQuery("#search_filters_wrapper"));
				append_to_map_div(jQuery("#search_filters_toggle"));
				AMM.clearOverlays();
				jQuery.each(AirbnbSearch.resultsJson.properties, function(k,j) {
					AMM.queue.push(j.id)
				});
				AMM.showOverlays()
			}
		}
	}
	if(b==="search_type_list"||b==="search_type_photo") {
		if(e) {
			AMM.closeInfoWindow();
			f=AirbnbSearch.thumbnailStyles[d];
			$(".search_thumbnail").each( function(k,j) {
				j.src=j.src.replace(AirbnbSearch.thumbnailRegex,"/"+d+".jpg");
				j.height=f[0];
				j.width=f[1]
			})
		}
		var i=AMM.map.getCenter();
		var a=AMM.map.getZoom();
		if(a>10) {
			a=a-2
		}
		google.maps.event.addListenerOnce(AMM.map,"resize", function() {
			AMM.map.setCenter(i);
			AMM.map.setZoom(a)
		});
		if(g==="map") {
			google.maps.event.trigger(AMM.map,"resize");
			$("#results_filters").insertAfter("#results_header");
			$("#results_save").appendTo("#results_header");
			if(e&&!redoSearchInMapIsChecked()) {
				AirbnbSearch.loadNewResults()
			}
		}
		$("#search_filters_wrapper").appendTo("#v3_search");
		$("#map_wrapper").prependTo("#search_filters");
		$("#map_options").prependTo("#search_filters")
	}
	if(g==="map"&&(b==="list"||b==="photo")||(g!=="map"&&b!=="map")) {
		AirbnbSearch.loadNewResultsWithNoResponse()
	}
	if(g==="map") {
		$("#map_message").width(507);
		$("#search_filters_toggle").addClass("search_filters_toggle_off").removeClass("search_filters_toggle_on");
		$("#search_filters").show()
	} else {
		if($("#search_filters").is(":visible")) {
			$("#search_filters_toggle").addClass("search_filters_toggle_on").removeClass("search_filters_toggle_off")
		} else {
			$("#search_filters_toggle").addClass("search_filters_toggle_off").removeClass("search_filters_toggle_on")
		}
	}
	AirbnbSearch.$.trigger("finishedrendering");
	AirbnbSearch.changing_display_type=false;
	return false
}

function append_to_map_div(a) {
	a.appendTo("#map_wrapper");
	return false
}

function reset_params_to_defaults() {
	AirbnbSearch.newSearch=true;
	AirbnbSearch.locationHasChanged=false;
	AirbnbSearch.results_changed_by_map_action=false;
	jQuery("#page").val("1")
}

function redoSearchInMapIsChecked() {
	return jQuery("#redo_search_in_map").is(":checked")
}

function showLoadingOverlays() {
	clearTimeout(AirbnbSearch.loadingMessageTimeout);
	AirbnbSearch.loadingMessageTimeout=setTimeout( function() {
		if(window.google&&window.google.maps) {
			$("#small_map_loading").show()
		}
		jQuery("#list_view_loading, #map_view_loading").show()
	},250)
}

function hideLoadingOverlays() {
	clearTimeout(AirbnbSearch.loadingMessageTimeout);
	jQuery("#results_header, #results_filters, #results, #results_footer").removeClass("search_grayed");
	jQuery("#small_map_loading, #list_view_loading, #map_view_loading").hide()
}

function clearResultsList() {
	jQuery("#results").empty()
}

function setBannerImage(b) {
	if(b.url===undefined) {
		jQuery("#v3_search").addClass("condensed_header_view")
	} else {
		var a=new Image();
		a.src=b.url;
		if(a.complete) {
			bannerImageLoadComplete(b);
			a.onload= function() {
			}
		} else {
			a.onload= function() {
				bannerImageLoadComplete(b);
				a.onload= function() {
				}
			}
		}
	}
	setAirtvVideo(b)
}

function setAirtvVideo(b) {
	if(jQuery("#airtv_promo").length!==0) {
		jQuery("#airtv_promo").remove()
	}
	if(b.airtv_url!==undefined&&AirbnbSearch.resultsJson.show_airtv_in_search_results&&AirbnbSearch.resultsJson.show_airtv_in_search_results==="true") {
		var a= {};
		a.airtv_url=b.airtv_url;
		a.airtv_headline=b.airtv_headline||"Check Out AirTV!";
		a.airtv_description=b.airtv_description||"A video from nearby!";
		jQuery("#results").before(jQuery("#list_view_airtv_template").jqote(a,"*"));
		initAirtvSearchVideoLightBox("#airtv_promo",b.airtv_url,b.airtv_headline)
	}
}

function initAirtvSearchVideoLightBox(b,c,a) {
	if(jQuery("#video_lightbox_content").length===0) {
		jQuery("body").append('<div id="video_lightbox_content"></div>')
	}
	jQuery(b).colorbox({
		inline:true,
		href:"#video_lightbox_content",
		onLoad: function() {
			var d=['<object id="video" width="764" height="458"><param name="movie" value="',c,'"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="',c,'" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="764" height="458"></embed></object>'].join("");
			jQuery("#video_lightbox_content").html(d)
		},
		onComplete: function() {
			jQuery("#cboxTitle").html(a)
		},
		onCleanup: function() {
			jQuery("#video_lightbox_content").html("");
			jQuery("#cboxTitle").html("")
		}
	})
}

function bannerImageLoadComplete(b) {
	jQuery("#search_header").css("background-image",["url(",b.url,")"].join(""));
	if(b.height) {
		jQuery("#search_header").css("height",b.height)
	} else {
		jQuery("#search_header").css("height",150)
	}
	jQuery("#v3_search").removeClass("condensed_header_view");
	var a=b.attribution_text||"CC licensed photo from Flickr";
	var c=b.attribution_url||"http://www.flickr.com";
	jQuery("#cc_attribution_link").html(a).attr("href",c).show();
	AirbnbSearch.$.trigger("finishedrendering")
}

function render_results_oncomplete(a) {
	var b;
	if(a.banner_info&&AirbnbSearch.hideBannerForRemainderOfSession===false) {
		setBannerImage(a.banner_info)
	} else {
		jQuery("#cc_attribution_link").hide()
	}
	if(!(a.banner_info&&a.banner_info.airtv_url)) {
		Connections.init()
	}
	jQuery("div.user_thumb a img").each( function(c,d) {
		b=jQuery(d);
		if(b.attr("src")==AirbnbSearch.BLANK_USER_PHOTO_URL) {
			b.remove()
		}
	});
	AMM.centerLat=false;
	AMM.centerLng=false;
	AMM.geocodePrecision=false;
	if(a.center_lat&&a.center_lng) {
		AMM.centerLat=a.center_lat;
		AMM.centerLng=a.center_lng;
		if(a.geocode_precision) {
			AMM.geocodePrecision=a.geocode_precision
		}
	}
	AMM.drawCenterMarker();
	reset_params_to_defaults();
	setTimeout( function() {
		AMM.turnMapListenersOn()
	},1000);
	AirbnbSearch.markViewedPageLinks();
	AirbnbSearch.trackSearch();
	AirbnbSearch.activeAjaxRequest=null;
	AirbnbSearch.initialLoadComplete=true;
	AirbnbSearch.$.trigger("finishedrendering")
}

function render_results(j,d) {
	var a,g,k,f,c;
	var h,e,b;
	function i(n,m,l) {
		return e.jqote({
			badge_type:n,
			badge_text:m,
			badge_name:l
		},"*")
	}

	AMM.turnMapListenersOff();
	clearResultsList();
	if(window.google&&window.google.maps&&(arguments.length==1||d.ea===undefined)) {
		a=new google.maps.LatLngBounds()
	} else {
		a=d
	}
	$(".results_count").html(j.results_count_html);
	$("#results_count_top").html(j.results_count_top_html);
	$("#results_pagination").html(j.results_pagination_html);
	$("#sort").val(j.sort);
	AMM.clearQueue();
	k=false;
	if(AirbnbSearch.forcedViewType!==false&&(AirbnbSearch.initialLoadComplete===false||AirbnbSearch.searchHasBeenModified()===false)) {
		k=AirbnbSearch.forcedViewType
	} else {
		if(j.view_type) {
			k=j.view_type
		}
	}
	if(k!==false) {
		display_search_type("search_type_"+AirbnbSearch.viewTypes[k],false);
		AirbnbSearch.currentViewType=AirbnbSearch.viewTypes[k];
		AirbnbSearch.params.search_view=k
	}
	if(j.present_standby_option&&j.present_standby_option===true&&j.standby_url) {
		$("#standby_link").attr("href",j.standby_url);
		AirbnbSearch.presentStandbyOption()
	} else {
		$("#standby_link").attr("href","/messaging/standby");
		AirbnbSearch.hideStandbyOption()
	}
	g=document.createDocumentFragment();
	e=$("#badge_template");
	b=$("#list_view_item_template");
	if(AirbnbSearch.currentViewType==="list") {
		c="x_small"
	} else {
		c="small"
	}
	f=AirbnbSearch.thumbnailStyles[c];
	$.each(j.properties, function(o,n) {
		var m,l,p;
		var q;
		if(window.google&&window.google.maps) {
			p=new google.maps.LatLng(n.lat,n.lng);
			AMM.add(p,n);
			if(a!==d) {
				a.extend(p)
			}
		}
		if(SS) {
			if(n.picture_ids) {
				SS.addHostingAndIds(n.id,n.picture_ids);
				if(SS.pictureArrays&&SS.pictureArrays[n.id][0]!==undefined) {
					n.smallThumbnail=SS.fullImageUrl(SS.pictureArrays[n.id][0])
				} else {
					SS.pictureArrays[n.id]=[]
				}
			}
		}
		if(AirbnbSearch.currentViewType==="list"||AirbnbSearch.currentViewType==="photo") {
			l= {
				hosting_name:n.name,
				user_name:n.user_name,
				hosting_id:n.id,
				result_number:(o+1),
				address:n.address,
				usd_price:n.usd_price,
				price:n.price,
				hosting_thumbnail_url:n.hosting_thumbnail_url.replace(AirbnbSearch.thumbnailRegex,"/"+c+".jpg"),
				hosting_thumbnail_width:f[1],
				hosting_thumbnail_height:f[0],
				user_thumbnail_url:n.user_thumbnail_url,
				connections:n.relationships||[],
				isNewHosting:(n.is_new_hosting&&n.is_new_hosting===true),
				hasInstantBook:(n.instant_book&&n.instant_book===true),
				distance:n.distance
			};
			q=$(b.jqote(l,"*"));
			m="";
			if(n.review_count>0) {
				m+=i("reviews",n.review_count,(n.review_count==1?Translations.review:Translations.reviews))
			}
			if(n.recommendation_count>0) {
				m+=i("friends",n.recommendation_count,(n.recommendation_count==1?Translations.friend:Translations.friends))
			}
			if(n.user_is_superhost>0) {
				m+=i("superhost","",Translations.superhost)
			}
			if(m) {
				q.find("ul.reputation").append(m)
			}
			g.appendChild(q[0])
		}
	});
	$("#results").append(g.cloneNode(true));
	h=$("#map_message");
	if(AirbnbSearch.currentViewType==="map") {
		if((j.properties&&j.properties.length==AirbnbSearch.params.per_page)||!redoSearchInMapIsChecked()) {
			if(redoSearchInMapIsChecked()) {
				h.html(['<span class="zoom_in_to_see_more_properties">',Translations.zoom_in_to_see_more_properties,"</span>"].join(""))
			} else {
				h.html(["<h3>",Translations.zoom_in_to_see_more_properties,"</h3>",'<span id="redo_search_in_map_tip">',Translations.redo_search_in_map_tip,"</span>"].join(""))
			}
			h.removeClass("tall_message").addClass("short_message").show()
		} else {
			if(!(j.properties)||j.properties.length===0) {
				h.html(["<h3>",Translations.your_search_was_too_specific,"</h3>","<p>",Translations.we_suggest_unchecking_a_couple_filters,"</p>"].join(""));
				h.removeClass("short_message").addClass("tall_message").show()
			} else {
				h.hide()
			}
		}
	} else {
		h.hide()
	}
	AMM.currentBounds=a;
	AMM.clearOverlays(true);
	AMM.showOverlays();
	if((j.properties&&j.properties.length>0)&&(AirbnbSearch.results_changed_by_map_action===false||AirbnbSearch.changing_display_type===true)&&(!redoSearchInMapIsChecked()||AirbnbSearch.locationHasChanged)) {
		AMM.fitBounds(a)
	}
	if(j.properties&&j.properties.length>0) {
		$("#results_footer").show()
	} else {
		$("#results_footer").hide();
		AirbnbSearch.showBlankState()
	}
	hideLoadingOverlays();
	return true
}

function killActiveAjaxRequest() {
	if(AirbnbSearch.activeAjaxRequest) {
		AirbnbSearch.activeAjaxRequest.abort();
		AirbnbSearch.activeAjaxRequest=null;
		hideLoadingOverlays()
	}
}

var MapIcons= {
	centerPoint:false,
	numbered:[],
	numberedHover:[],
	numberedStarred:[],
	numberedStarredHover:[],
	numberedVisited:[],
	numberedVisitedHover:[],
	numberedVisitedStarred:[],
	numberedVisitedStarredHover:[],
	small:false,
	smallHover:false,
	smallStarred:false,
	smallStarredHover:false,
	smallVisited:false,
	smallVisitedHover:false,
	smallVisitedStarred:false,
	smallVisitedStarredHover:false,
	shadowStandard:false,
	shadowSmall:false,
	shadowCenterPoint:false,
	init: function() {
		MapIcons.centerPoint=new google.maps.MarkerImage("/images/page2/v3/map_icons/icon_center_point.png",new google.maps.Size(15,36),new google.maps.Point(0,0));
		MapIcons.small=new google.maps.MarkerImage("/images/page2/v3/map_icons/small_pins.png",new google.maps.Size(9,9),new google.maps.Point(0,0));
		MapIcons.smallHover=new google.maps.MarkerImage("/images/page2/v3/map_icons/small_pins.png",new google.maps.Size(9,9),new google.maps.Point(9,0));
		MapIcons.smallStarred=new google.maps.MarkerImage("/images/page2/v3/map_icons/small_pins.png",new google.maps.Size(9,9),new google.maps.Point(0,9));
		MapIcons.smallStarredHover=new google.maps.MarkerImage("/images/page2/v3/map_icons/small_pins.png",new google.maps.Size(9,9),new google.maps.Point(9,9));
		MapIcons.smallVisited=new google.maps.MarkerImage("/images/page2/v3/map_icons/small_pins.png",new google.maps.Size(9,9),new google.maps.Point(18,0));
		MapIcons.smallVisitedHover=new google.maps.MarkerImage("/images/page2/v3/map_icons/small_pins.png",new google.maps.Size(9,9),new google.maps.Point(27,0));
		MapIcons.smallVisitedStarred=new google.maps.MarkerImage("/images/page2/v3/map_icons/small_pins.png",new google.maps.Size(9,9),new google.maps.Point(18,9));
		MapIcons.smallVisitedStarredHover=new google.maps.MarkerImage("/images/page2/v3/map_icons/small_pins.png",new google.maps.Size(9,9),new google.maps.Point(27,9));
		for(var a=0;a<21;a++) {
			MapIcons.numbered[a+1]=new google.maps.MarkerImage("/images/page2/v3/map_icons/map_pins_sprite_001.png",new google.maps.Size(22,34),new google.maps.Point(0,(a*34)));
			MapIcons.numberedHover[a+1]=new google.maps.MarkerImage("/images/page2/v3/map_icons/map_pins_sprite_001.png",new google.maps.Size(22,34),new google.maps.Point(44,(a*34)));
			MapIcons.numberedStarred[a+1]=new google.maps.MarkerImage("/images/page2/v3/map_icons/map_pins_sprite_001.png",new google.maps.Size(22,34),new google.maps.Point(22,(a*34)));
			MapIcons.numberedStarredHover[a+1]=new google.maps.MarkerImage("/images/page2/v3/map_icons/map_pins_sprite_001.png",new google.maps.Size(22,34),new google.maps.Point(66,(a*34)));
			MapIcons.numberedVisited[a+1]=new google.maps.MarkerImage("/images/page2/v3/map_icons/map_pins_sprite_001.png",new google.maps.Size(22,34),new google.maps.Point(88,(a*34)));
			MapIcons.numberedVisitedHover[a+1]=new google.maps.MarkerImage("/images/page2/v3/map_icons/map_pins_sprite_001.png",new google.maps.Size(22,34),new google.maps.Point(132,(a*34)));
			MapIcons.numberedVisitedStarred[a+1]=new google.maps.MarkerImage("/images/page2/v3/map_icons/map_pins_sprite_001.png",new google.maps.Size(22,34),new google.maps.Point(110,(a*34)));
			MapIcons.numberedVisitedStarredHover[a+1]=new google.maps.MarkerImage("/images/page2/v3/map_icons/map_pins_sprite_001.png",new google.maps.Size(22,34),new google.maps.Point(154,(a*34)))
		}
		MapIcons.shadowCenterPoint=new google.maps.MarkerImage("/images/page2/v3/map_icons/icon_center_point_shadow.png",new google.maps.Size(35,27),new google.maps.Point(0,0),new google.maps.Point(4,27));
		MapIcons.shadowSmall=new google.maps.MarkerImage("/images/page2/v3/map_icons/icon_small_dot_shadow.png",new google.maps.Size(11,11),new google.maps.Point(0,0),new google.maps.Point(5,9));
		MapIcons.shadowStandard=new google.maps.MarkerImage("/images/page2/v3/map_icons/default_shadow.png",new google.maps.Size(33,26),new google.maps.Point(0,0),new google.maps.Point(5,23))
	}
};
var AirbnbSearch= {
	thumbnailRegex:/\/[^\/]*\.jpg$/,
	thumbnailStyles: {
		x_small:[74,114],
		small:[144,216]
	},
	hideBannerForRemainderOfSession:false,
	forcedViewType:false,
	code:false,
	eventId:false,
	hostId:false,
	hostName:"",
	forceHideHost:false,
	groupId:false,
	groupName:"",
	forceHideGroup:false,
	isViewingStarred:false,
	collectionId:false,
	collectionName:"",
	forceHideCollection:false,
	viewTypes: {
		"1":"list",
		"2":"photo",
		"3":"map"
	},
	activeAjaxRequest:null,
	loadingMessageTimeout:false,
	newSearch:false,
	currentViewType:"list",
	results_changed_by_map_action:false,
	changing_display_type:false,
	shareLightbox:false,
	params: {},
	currencySymbolLeft:"$",
	currencySymbolRight:"",
	initialLoadComplete:false,
	resultsJson:false,
	locationHasChanged:false,
	BLANK_USER_PHOTO_URL:"http://www.airbnb.com/images/user_pic.gif",
	DEFAULT_BANNER_IMAGE_URL:"/images/landing_pages/backgrounds/default_landing_page_background.jpg",
	viewedIds:[],
	openShareLightbox: function() {
		if(AirbnbSearch.params.location) {
			jQuery("#share_email_city_name").html(AirbnbSearch.params.location)
		} else {
			jQuery("#share_email_city_name").html(Translations.a_friend)
		}
		AirbnbSearch.shareLightbox=AirbnbSearch.shareLightbox||jQuery("#share_lightbox").dialog({
			autoOpen:false,
			height:200,
			width:600
		});
		AirbnbSearch.shareLightbox.dialog("open")
	},
	closeShareLightbox: function() {
		jQuery("#share_email_address").val("");
		if(AirbnbSearch.shareLightbox) {
			AirbnbSearch.shareLightbox.dialog("close")
		}
	},
	updateFacebookBannerText: function() {
		if(AirbnbSearch.params.location) {
			jQuery("#connect_banner .general").hide();
			jQuery("#connect_banner .specific").find("span.place").text(AirbnbSearch.params.location).end().show()
		}
	},
	initFacebookBannerTooltip: function() {
		var a=jQuery("#what_does_this_do_tooltip");
		if(!a.length) {
			return
		}
		var c=jQuery("#connect_banner a.what_does_this_do"),b=a.css("width").split("px")[0];
		a.appendTo("body");
		c.hover( function() {
			var d=c.width(),f=c.offset(),e=f.left+d/2-b/2;
			a.css({
				left:e+"px",
				top:(f.top+23)+"px"
			}).fadeIn("fast")
		}, function() {
			a.fadeOut("fast")
		})
	},
	init: function(a) {
		AirbnbSearch.viewedIds=AirbnbSearch.getViewedPage3Ids();
		a=a|| {};
		if(a.min_bathrooms) {
			jQuery("#min_bathrooms").val(a.min_bathrooms)
		}
		if(a.min_bedrooms) {
			jQuery("#min_bedrooms").val(a.min_bedrooms)
		}
		if(a.min_beds) {
			jQuery("#min_beds").val(a.min_beds)
		}
		if(a.page) {
			AirbnbSearch.params.page=a.page
		}
		if(a.sort) {
			jQuery("#sort").val(a.sort);
			AirbnbSearch.params.sort=a.sort
		}
		if(a.neighborhoods) {
			AirbnbSearch.params.neighborhoods=a.neighborhoods
		}
		if(a.hosting_amenities) {
			AirbnbSearch.params.hosting_amenities=a.hosting_amenities
		}
		if(a.room_types) {
			AirbnbSearch.params.room_types=a.room_types
		}
		if(a.property_type_id) {
			AirbnbSearch.params.property_type_id=a.property_type_id
		}
		if(a.connected) {
			AirbnbSearch.params.connected="true"
		}
		if(a.number_of_guests) {
			jQuery("#number_of_guests").val(a.number_of_guests);
			AirbnbSearch.params.guests=a.number_of_guests
		}
		if(a.guests) {
			jQuery("#number_of_guests").val(a.guests);
			AirbnbSearch.params.guests=a.guests
		}
		if(a.price_min) {
			AirbnbSearch.params.price_min=a.price_min
		}
		if(a.price_max) {
			AirbnbSearch.params.price_max=a.price_max
		}
		jQuery(".search_type_option").hover( function() {
			if(!jQuery(this).hasClass("search_type_option_active")) {
				jQuery(this).addClass("search_type_option_hover")
			}
		}, function() {
			jQuery(this).removeClass("search_type_option_hover")
		});
		jQuery(".search_type_option").click( function() {
			display_search_type(this.id)
		});
		jQuery("#reinstate_collections").live("click", function() {
			SearchFilters.reinstateCollections();
			jQuery(this).remove()
		});
		jQuery("#reinstate_user").live("click", function() {
			SearchFilters.reinstateHost();
			jQuery(this).remove()
		});
		jQuery("#reinstate_group").live("click", function() {
			SearchFilters.reinstateGroup();
			jQuery(this).remove()
		});
		jQuery("#share_results_link").click( function() {
			jQuery("#share_url").val([Translations.loading,"..."].join(""));
			AirbnbSearch.openShareLightbox();
			AirbnbSearch.setParamsFromDom();
			AirbnbSearch.activeAjaxRequest=jQuery.getJSON("/search/create",AirbnbSearch.params, function(r) {
				jQuery("#share_url").val(["http://www.airbnb.com/search?code=",r.search.code].join(""));
				jQuery("#share_url").select()
			})
		});
		jQuery("#keywords").live("keyup", function(t) {
			var s=(t.keyCode?t.keyCode:t.which);
			if(s==13) {
				var r=jQuery("#keywords");
				if(r.attr("defaultValue")!==r.val()) {
					AirbnbSearch.loadNewResults()
				}
			}
		});
		jQuery("#redo_search_in_map_link_on").live("click", function(r) {
			jQuery("#redo_search_in_map").attr("checked",true);
			if(AMM.redoSearchPromptTimeout) {
				clearTimeout(AMM.redoSearchPromptTimeout);
				AMM.redoSearchPromptTimeout=false
			}
			jQuery("#first_time_map_question").fadeOut(500);
			AMM.closeInfoWindow();
			AirbnbSearch.results_changed_by_map_action=true;
			AirbnbSearch.loadNewResults();
			return false
		});
		jQuery("#redo_search_in_map_link_off").live("click", function(r) {
			if(AMM.redoSearchPromptTimeout) {
				clearTimeout(AMM.redoSearchPromptTimeout);
				AMM.redoSearchPromptTimeout=false
			}
			jQuery("#first_time_map_question").fadeOut(500);
			return false
		});
		jQuery("#share_url").live("focus", function() {
			jQuery(this).select()
		});
		jQuery(".pagination a").live("click", function() {
			var s=jQuery(this);
			var r=s.html();
			if(s.attr("rel")=="next") {
				r=parseInt(jQuery("div.pagination span.current").html(),10)+1
			} else {
				if(s.attr("rel")=="prev") {
					r=parseInt(jQuery("div.pagination span.current").html(),10)-1
				} else {
					r=parseInt(r,10)
				}
			}
			if(isNaN(r)||r<1) {
				r=1
			}
			jQuery("#page").val(r);
			AirbnbSearch.loadNewResults();
			return false
		});
		var m,j;
		var l=jQuery("#search_filters");
		var c=jQuery("#search_body");
		var p=l.position().top;
		var k=l.height();
		function n() {
			var s=jQuery(window).scrollTop();
			var r=l.position().top;
			if((s>=p)&&(k<j)) {
				if(!l.hasClass("fixed")) {
					l.addClass("fixed")
				}
				if(((k+r)>=m)&&s>=r) {
					l.css({
						position:"absolute",
						top:m-k+1+"px"
					})
				} else {
					if(l.css("position")==="absolute") {
						l.css({
							position:"",
							top:"0"
						})
					}
				}
			} else {
				d()
			}
		}

		function d() {
			if(l.hasClass("fixed")) {
				l.removeClass("fixed")
			}
			if(l.css("position")==="absolute") {
				l.css({
					position:"",
					top:"0"
				})
			}
		}

		function f() {
			k=l.height();
			n();
			n()
		}

		AirbnbSearch.$.bind("finishedrendering", function() {
			p=c.position().top;
			k=l.height();
			j=c.height();
			m=p+j;
			if((j>k)&&AirbnbSearch.currentViewType!=="map") {
				jQuery(window).scroll(n).scroll();
				AirbnbSearch.$.bind("filtertoggle",f)
			} else {
				jQuery(window).unbind("scroll",n);
				AirbnbSearch.$.unbind("filtertoggle",f);
				d()
			}
		});
		jQuery("#search_filters_toggle").live("click", function() {
			var r=jQuery(this);
			if(r.hasClass("search_filters_toggle_off")) {
				jQuery("#map_message").width(507);
				jQuery("#search_map").width(729)
			} else {
				jQuery("#search_map").width(980);
				jQuery("#map_message").width(752)
			}
			r.toggleClass("search_filters_toggle_on search_filters_toggle_off");
			jQuery("#search_filters").toggle();
			google.maps.event.trigger(AMM.map,"resize")
		});
		jQuery(".filter_x_container").live("click", function() {
			SearchFilters.appliedFilterXCallback(this)
		});
		$.each($(".inner_text"), function(t,u) {
			var r=$(u).next("input");
			var s=r.val();
			r.attr("defaultValue",u.innerHTML);
			r.val(u.innerHTML);
			if(s.length>0) {
				r.val(s);
				r.addClass("active")
			}
			r.bind("focus", function() {
				if($(r).val()==r.attr("defaultValue")) {
					$(r).val("");
					$(r).addClass("active")
				}
				$(r).removeClass("error");
				return true
			});
			r.bind("blur", function() {
				if($(r).val()==="") {
					$(r).removeClass("active");
					$(r).val(r.attr("defaultValue"))
				} else {
					$(r).removeClass("error")
				}
			});
			$(u).remove()
		});
		if(jQuery("#location_label")) {
			jQuery("#location_label").show()
		}
		if(a.location!==undefined) {
			jQuery("#location").val(a.location);
			jQuery("#location").addClass("active")
		}
		if(AirbnbSearch.initialLoadComplete===false) {
			var b=$.datepicker._defaults.dateFormat;
			var i= {
				minDate:0,
				maxDate:"+2Y",
				nextText:"",
				prevText:"",
				numberOfMonths:1,
				closeText:Translations.clear_dates,
				currentText:Translations.today,
				showButtonPanel:true
			};
			var q=jQuery.extend(true, {},i);
			var e=jQuery.extend(true, {},i);
			if(typeof a.checkin!=="undefined"&&typeof a.checkout!=="undefined"&&a.checkin!==b&&a.checkout!==b) {
				jQuery("#checkin").val(a.checkin);
				jQuery("#checkout").val(a.checkout);
				q=jQuery.extend(q, {
					defaultDate:a.checkin
				});
				e=jQuery.extend(e, {
					defaultdate:a.checkout
				})
			} else {
				jQuery("#checkin").val(b);
				jQuery("#checkout").val(b);
				jQuery("#search_inputs").css("background-color","#ffe75f")
			}
			jQuery("#search_form").airbnbInputDateSpan({
				defaultsCheckin:q,
				defaultsCheckout:e,
				onSuccess: function() {
					AirbnbSearch.loadNewResults()
				}
			});
			jQuery("#search_form").airbnbInputDateSpan("enableClearDatesButton");
			jQuery("ul.collapsable_filters li input:checkbox, ul#lightbox_filters input:checkbox").live("click", function() {
				var t=false;
				var u=jQuery(this).attr("id");
				var r=jQuery(this).attr("name");
				var s=jQuery(this).attr("value");
				if(u.indexOf("lightbox")===-1) {
					u=["#lightbox_",u].join("");
					t=true
				} else {
					u=["#",u.replace("lightbox_","")].join("")
				}
				if(jQuery(u)) {
					if(jQuery(this).is(":checked")) {
						jQuery(["input:checkbox[name=",r,"][value=",s,"]"].join("")).attr("checked",true)
					} else {
						jQuery(["input:checkbox[name=",r,"][value=",s,"]"].join("")).attr("checked",false)
					}
				}
				if(t===true) {
					AirbnbSearch.loadNewResults()
				}
			});
			jQuery("a.show_more_link").live("click", function(r) {
				SearchFilters.openFiltersLightbox();
				var s=jQuery(this).closest(".search_filter").attr("id").replace("_container","");
				SearchFilters.selectLightboxTab(s)
			});
			jQuery("#lightbox_search_button").live("click", function() {
				AirbnbSearch.loadNewResults()
			});
			jQuery(".filters_lightbox_nav_element").live("click", function() {
				var r=jQuery(this).attr("id").replace("lightbox_nav_","");
				SearchFilters.selectLightboxTab(r)
			});
			jQuery("#sort").change( function() {
				AirbnbSearch.loadNewResults()
			});
			jQuery("#number_of_guests").change( function() {
				AirbnbSearch.loadNewResults()
			});
			jQuery("a.filter_header, a.filter_toggle").live("click", function() {
				jQuery(this).closest(".search_filter").toggleClass("closed open");
				AirbnbSearch.$.trigger("filtertoggle")
			});
			jQuery(".search_result").live("mouseenter", function(r) {
				AirbnbSearch.hoverListResult((r.currentTarget.id).split("_")[1])
			});
			jQuery(".search_result").live("mouseleave", function(r) {
				AirbnbSearch.unHoverListResult((r.currentTarget.id).split("_")[1])
			});
			jQuery("#slider-range").slider({
				range:true,
				min:SearchFilters.minPrice,
				max:SearchFilters.maxPrice,
				step:5,
				values:[(a.price_min?parseInt(a.price_min,10):SearchFilters.minPrice),(a.price_max?parseInt(a.price_max,10):SearchFilters.maxPrice)],
				slide: function(r,s) {
					SearchFilters.applyPriceSliderChanges(s)
				},
				change: function() {
					AirbnbSearch.loadNewResults()
				}
			});
			jQuery("#slider_min").html([AirbnbSearch.currencySymbolLeft,SearchFilters.minPrice,AirbnbSearch.currencySymbolRight].join(""));
			jQuery("#slider_max").html([AirbnbSearch.currencySymbolLeft,SearchFilters.maxPrice,AirbnbSearch.currencySymbolRight].join(""));
			SearchFilters.applyPriceSliderChanges();
			if(window.google&&window.google.maps&&a.search_by_map&&a.ne_lng&&a.ne_lat&&a.sw_lng&&a.sw_lat) {
				AMM.initMapOnce("search_map");
				var h= {
					sw_lat:a.sw_lat,
					sw_lng:a.sw_lng,
					ne_lat:a.ne_lat,
					ne_lng:a.ne_lng
				};
				AirbnbSearch.params.forceBounds=h;
				var o=new google.maps.LatLng(h.sw_lat,h.sw_lng);
				var g=new google.maps.LatLng(h.ne_lat,h.ne_lng);
				AMM.fitBounds(new google.maps.LatLngBounds(o,g));
				jQuery("#redo_search_in_map").attr("checked",true);
				AirbnbSearch.params=a
			}
			AirbnbSearch.loadNewResults(true);
			AirbnbSearch.params=a;
			jQuery("#redo_search_in_map").bind("change", function() {
				if(AMM.redoSearchPromptTimeout) {
					clearTimeout(AMM.redoSearchPromptTimeout);
					AMM.redoSearchPromptTimeout=false;
					jQuery("#first_time_map_question").fadeOut(250)
				}
				if(redoSearchInMapIsChecked()) {
					AMM.closeInfoWindow();
					AirbnbSearch.results_changed_by_map_action=true;
					AirbnbSearch.loadNewResults()
				} else {
					AMM.turnMapListenersOff()
				}
			})
		}
		AirbnbSearch.initFacebookBannerTooltip()
	},
	performNewSearch: function() {
		return(AirbnbSearch.newSearch||AirbnbSearch.initialLoadComplete)
	},
	searchHasBeenModified: function() {
		try {
			var c=window.location.hash;
			if(c) {
				var a=(((c).split("#")[1]).split("&")[0]).split("modified=")[1];
				if(a=="true") {
					return true
				}
			}
			return false
		} catch(b) {
			return false
		}
	},
	setParamsFromDom: function() {
		var i;
		var d=AirbnbSearch.params;
		AirbnbSearch.params= {};
		if(AirbnbSearch.initialLoadComplete===false&&AirbnbSearch.code&&(AirbnbSearch.searchHasBeenModified()===false)) {
			AirbnbSearch.params.code=AirbnbSearch.code
		}
		if(AirbnbSearch.eventId&&(AirbnbSearch.searchHasBeenModified()===false)) {
			AirbnbSearch.params.event_id=AirbnbSearch.eventId
		}
		if(AirbnbSearch.performNewSearch()) {
			AirbnbSearch.params.new_search=true
		}
		AMM.new_bounds=AMM.mapLoaded?(AMM.map.getBounds()||false):false;
		switch(AirbnbSearch.currentViewType) {
			case"list":
				AirbnbSearch.params.search_view=1;
				break;
			case"photo":
				AirbnbSearch.params.search_view=2;
				break;
			case"map":
				AirbnbSearch.params.search_view=3;
				break;
			default:
				AirbnbSearch.params.search_view=1
		}
		AirbnbSearch.params.min_bedrooms=jQuery("#min_bedrooms").val()||"0";
		AirbnbSearch.params.min_bathrooms=jQuery("#min_bathrooms").val()||"0";
		AirbnbSearch.params.min_beds=jQuery("#min_beds").val()||"0";
		AirbnbSearch.params.page=jQuery("#page").val()||"1";
		var k=jQuery("#location").val();
		if(k!==jQuery("#location").attr("defaultValue")) {
			AirbnbSearch.params.location=k||""
		}
		if(!d||!(d.location)||(d.location!=AirbnbSearch.params.location)) {
			AirbnbSearch.locationHasChanged=true;
			AirbnbSearch.hideBannerForRemainderOfSession=false
		}
		if(AirbnbSearch.includeCollectionParam()===true) {
			AirbnbSearch.params.collection_id=AirbnbSearch.collectionId
		} else {
			SearchFilters.clearCollections(false)
		}
		if(AirbnbSearch.includeHostParam()) {
			AirbnbSearch.params.host_id=AirbnbSearch.hostId
		} else {
			SearchFilters.clearHost()
		}
		if(AirbnbSearch.includeGroupParam()) {
			AirbnbSearch.params.group_id=AirbnbSearch.groupId
		} else {
			SearchFilters.clearGroup()
		}
		var e=jQuery("#checkin").val();
		var h=jQuery("#checkout").val();
		if(e!="mm/dd/yyyy") {
			AirbnbSearch.params.checkin=jQuery("#checkin").val()||""
		}
		if(h!="mm/dd/yyyy") {
			AirbnbSearch.params.checkout=jQuery("#checkout").val()||""
		}
		AirbnbSearch.params.guests=jQuery("#number_of_guests").val()||"1";
		AirbnbSearch.params.room_types=[];
		jQuery("input[name=room_types]").each( function(m,n) {
			if(jQuery(n).is(":checked")) {
				AirbnbSearch.params.room_types.push(jQuery(n).val())
			}
		});
		AirbnbSearch.params.property_type_id=[];
		jQuery("input[name=property_type_id]").each( function(m,n) {
			if(jQuery(n).is(":checked")) {
				AirbnbSearch.params.property_type_id.push(jQuery(n).val())
			}
		});
		AirbnbSearch.params.hosting_amenities=[];
		jQuery("input[name=amenities]").each( function(m,n) {
			if(jQuery(n).is(":checked")) {
				AirbnbSearch.params.hosting_amenities.push(jQuery(n).val())
			}
		});
		if(AirbnbSearch.isViewingStarred) {
			AirbnbSearch.params.starred=true
		}
		if(jQuery("input[name=connected]").is(":checked")) {
			AirbnbSearch.params.connected=true
		}
		AirbnbSearch.params.languages=[];
		jQuery("input[name=languages]").each( function(m,n) {
			if(jQuery(n).is(":checked")) {
				AirbnbSearch.params.languages.push(jQuery(n).val())
			}
		});
		AirbnbSearch.params.neighborhoods=[];
		if(AirbnbSearch.initialLoadComplete===false) {
			i=["neighborhoods","room_types","min_bedrooms","price_min","price_max","guests","property_type_id","connected"];
			jQuery(i).each( function(m,n) {
				if(d[n]) {
					AirbnbSearch.params[n]=d[n]
				}
			})
		}
		if(!AirbnbSearch.locationHasChanged) {
			AirbnbSearch.params.sort=jQuery("#sort").val();
			jQuery("input[name=neighborhoods]").each( function(m,n) {
				if(jQuery(n).is(":checked")) {
					AirbnbSearch.params.neighborhoods.push(jQuery(n).val())
				}
			})
		}
		AirbnbSearch.params.hosting_amenities=AirbnbSearch.params.hosting_amenities.unique();
		AirbnbSearch.params.neighborhoods=AirbnbSearch.params.neighborhoods.unique();
		AirbnbSearch.params.room_types=AirbnbSearch.params.room_types.unique();
		var g=jQuery("#keywords");
		if(g.attr("defaultValue")!==g.val()) {
			AirbnbSearch.params.keywords=g.val()
		}
		var l=jQuery("#slider-range").slider("option","min");
		var b=jQuery("#slider-range").slider("option","max");
		var a=jQuery("#slider-range").slider("values",0);
		var f=jQuery("#slider-range").slider("values",1);
		if(b!=f||l!=a) {
			AirbnbSearch.params.price_min=a.toString();
			AirbnbSearch.params.price_max=f.toString()
		}
		if(redoSearchInMapIsChecked()) {
			if(AMM.new_bounds&&(!(AirbnbSearch.locationHasChanged)||AirbnbSearch.results_changed_by_map_action)) {
				AirbnbSearch.params.sw_lat=AMM.new_bounds.getSouthWest().lat();
				AirbnbSearch.params.sw_lng=AMM.new_bounds.getSouthWest().lng();
				AirbnbSearch.params.ne_lat=AMM.new_bounds.getNorthEast().lat();
				AirbnbSearch.params.ne_lng=AMM.new_bounds.getNorthEast().lng();
				AirbnbSearch.params.search_by_map=true
			} else {
				if(d&&d.forceBounds) {
					AirbnbSearch.params.sw_lat=d.forceBounds.sw_lat;
					AirbnbSearch.params.sw_lng=d.forceBounds.sw_lng;
					AirbnbSearch.params.ne_lat=d.forceBounds.ne_lat;
					AirbnbSearch.params.ne_lng=d.forceBounds.ne_lng;
					var j=new google.maps.LatLng(d.forceBounds.sw_lat,d.forceBounds.sw_lng);
					var c=new google.maps.LatLng(d.forceBounds.ne_lat,d.forceBounds.ne_lng);
					AMM.new_bounds=new google.maps.LatLngBounds(j,c);
					AMM.fitBounds(AMM.new_bounds);
					AirbnbSearch.params.search_by_map=true
				}
			}
		}
		if(AirbnbSearch.currentViewType=="photo") {
			AirbnbSearch.params.per_page=21
		} else {
			if(AirbnbSearch.currentViewType=="list") {
				AirbnbSearch.params.per_page=21
			} else {
				if(AirbnbSearch.currentViewType=="map") {
					AirbnbSearch.params.per_page=40
				}
			}
		}
		return AirbnbSearch.params
	},
	markUrlAsModified: function() {
		try {
			window.location.hash="modified=true"
		} catch(a) {
		}
	},
	loadNewResultsWithNoResponse: function() {
		AirbnbSearch.setParamsFromDom();
		AirbnbSearch.params.suppress_response=true;
		AirbnbSearch.markUrlAsModified();
		AirbnbSearch.activeAjaxRequest=jQuery.getJSON("/search/ajax_get_results",AirbnbSearch.params, function(a) {
			AirbnbSearch.params.suppress_response=false
		})
	},
	loadNewResultsCallback: function(a) {
		if(!a) {
			AirbnbSearch.resultsJson=false;
			hideLoadingOverlays();
			AirbnbSearch.trackSearch();
			return false
		}
		AirbnbSearch.resultsJson=a;
		if(render_results(a,AMM.new_bounds)) {
			if(a.params) {
				SearchFilters.update(a.params)
			} else {
				if(a.facets) {
					SearchFilters.update(a.facets)
				}
			}
			render_results_oncomplete(a)
		}
	},
	loadNewResults: function(d) {
		if(AirbnbSearch.initialLoadComplete===true) {
			AirbnbSearch.markUrlAsModified()
		}
		var c=d||false;
		AMM.initMapOnce("search_map");
		if(AirbnbSearch.results_changed_by_map_action===true&&!redoSearchInMapIsChecked()&&c===false) {
			reset_params_to_defaults();
			setTimeout( function() {
				AMM.turnMapListenersOn()
			},1000);
			return true
		}
		killActiveAjaxRequest();
		SearchFilters.closeFiltersLightbox();
		var a=jQuery("#search_header").is(":visible");
		var b=jQuery(window).scrollTop();
		if((a===true&&b>275)||(a===false&&b>129)) {
			jQuery("html, body").animate({
				scrollTop:jQuery("#search_params").offset().top
			},"fast")
		}
		showLoadingOverlays();
		AirbnbSearch.setParamsFromDom();
		AirbnbSearch.activeAjaxRequest=jQuery.getJSON("/search/ajax_get_results",AirbnbSearch.params,AirbnbSearch.loadNewResultsCallback);
		if(AirbnbSearch.isViewingStarred) {
			jQuery("#share_results_link").hide()
		} else {
			jQuery("#share_results_link").show()
		}
		return true
	},
	hoverListResult: function(c) {
		var b;
		var d=["#room_",c].join("");
		var a=AMM.markers[c];
		jQuery(d).addClass("hover");
		if(SS.initialized===true) {
			SS.show(d,c)
		}
		if(a) {
			if(a.numbered_pin!==false) {
				if(jQuery.inArray(c.toString(),AirbnbSearch.viewedIds)!==-1) {
					b=MapIcons.numberedVisitedHover[a.numbered_pin+1]
				} else {
					b=MapIcons.numberedHover[a.numbered_pin+1]
				}
				a.marker.setIcon(b)
			}
		}
	},
	unHoverListResult: function(c) {
		var b;
		var a=AMM.markers[c];
		jQuery(["#room_",c].join("")).removeClass("hover");
		if(SS.initialized===true) {
			SS.reset()
		}
		if(a) {
			if(a.numbered_pin!==false) {
				if(jQuery.inArray(c.toString(),AirbnbSearch.viewedIds)!==-1) {
					b=MapIcons.numberedVisited[a.numbered_pin+1]
				} else {
					b=MapIcons.numbered[a.numbered_pin+1]
				}
				a.marker.setIcon(b)
			}
		}
	},
	is_map_search: function() {
		return AirbnbSearch.results_changed_by_map_action&&!(AirbnbSearch.changing_display_type)
	},
	showBlankState: function() {
		jQuery("#results").html(jQuery("#blank_state_content").html())
	},
	markViewedPageLinks: function() {
		if(AirbnbSearch.viewedIds===false||AirbnbSearch.viewedIds.size===0) {
			return false
		}
		jQuery("#results .search_result").each( function(a,b) {
			b=jQuery(b);
			var c=b.attr("id").replace("room_","");
			if(jQuery.inArray(c,AirbnbSearch.viewedIds)!==-1) {
				b.addClass("visited")
			}
		})
	},
	getViewedPage3Ids: function() {
		var b=jQuery.cookie("viewed_page3_ids");
		if(b!==null) {
			var a=b.split(",");
			a=a.unique();
			return a
		}
		return[]
	},
	trackSearch: function() {
		TrackingPixel.track()
	},
	presentStandbyOption: function() {
		$("#standby_action_area").show()
	},
	hideStandbyOption: function() {
		$("#standby_action_area").hide()
	},
	includeCollectionParam: function() {
		return(AirbnbSearch.collectionId!==false)&&(AirbnbSearch.forceHideCollection===false)&&(AirbnbSearch.searchHasBeenModified()===false||(!(AirbnbSearch.params.location)||AirbnbSearch.params.location===""))
	},
	includeHostParam: function() {
		return(AirbnbSearch.hostId!==false)&&(AirbnbSearch.forceHideHost===false)&&(AirbnbSearch.searchHasBeenModified()===false||(!(AirbnbSearch.params.location)||AirbnbSearch.params.location===""))
	},
	includeGroupParam: function() {
		return(AirbnbSearch.groupId!==false)&&(AirbnbSearch.forceHideGroup===false)&&(AirbnbSearch.searchHasBeenModified()===false||(!(AirbnbSearch.params.location)||AirbnbSearch.params.location===""))
	},
	$:jQuery(this)
};
var TrackingPixel= {
	params: {
		uuid:"",
		user:"",
		af:"",
		c:"",
		pg:"",
		checkin:"",
		ngt:"",
		gc:"1",
		bc:"",
		lat:"",
		lng:""
	},
	imgId:"#page2_v3_tp",
	BASE_URL:"http://pluto.airbnb.com/t/t.php?",
	updateParamsFromDom: function() {
		if(AMM.map) {
			var g=AMM.map.getCenter();
			TrackingPixel.params.lat=g.lat();
			TrackingPixel.params.lng=g.lng()
		}
		var e=jQuery("#checkin").val();
		var d=jQuery("#checkout").val();
		if(e=="mm/dd/yyyy"||d=="mm/dd/yyyy") {
			TrackingPixel.params.checkin="";
			TrackingPixel.params.checkout=""
		} else {
			TrackingPixel.params.checkin=e;
			var c=new Date(e);
			var f=new Date(d);
			var b=86400000;
			var a=Math.abs(c.getTime()-f.getTime());
			var h=Math.round(a/b);
			TrackingPixel.params.ngt=h||""
		}
		TrackingPixel.params.gc=jQuery("#number_of_guests").val()||"1"
	},
	serializedParams: function() {
		return jQuery.param(TrackingPixel.params)
	},
	updateImgSrc: function() {
		var b=jQuery(TrackingPixel.imgId);
		if(b) {
			var a=[TrackingPixel.BASE_URL,TrackingPixel.serializedParams()].join("");
			b.attr("src",a)
		}
	},
	track: function() {
		TrackingPixel.updateParamsFromDom();
		TrackingPixel.updateImgSrc()
	}
};
var AMM= {
	map:"",
	isFirstMapInteraction:true,
	redoSearchPromptTimeout:false,
	overlay:false,
	mapLoaded:false,
	new_bounds:false,
	currentBounds:false,
	currentHighestZIndex:0,
	activeInfoWindow:null,
	activeInfoWindowMarker:false,
	queue:[],
	activeHostingIds:[],
	markers: {},
	defaultMapOptions: {},
	centerLat:false,
	centerLng:false,
	centerMarker:false,
	geocodePrecision:false,
	initMapOnce: function(a,b) {
		if(AMM.mapLoaded===false) {
			if(window.google&&window.google.maps) {
				$("#map_options").show();
				$("#map_wrapper").show();
				AMM.defaultMapOptions= {
					zoom:6,
					center:new google.maps.LatLng(40.7442,-73.9861),
					mapTypeId:google.maps.MapTypeId.ROADMAP,
					disableDefaultUI:true,
					navigationControl:true,
					navigationControlOptions: {
						position:google.maps.ControlPosition.LEFT
					},
					scaleControl:false,
					scrollwheel:false
				};
				AMM.map=new google.maps.Map(document.getElementById(a),AMM.defaultMapOptions);
				AMM.overlay=new google.maps.OverlayView();
				AMM.overlay.draw= function() {
				};
				AMM.overlay.setMap(AMM.map);
				MapIcons.init();
				AMM.mapLoaded=true
			} else {
				$("#map_options").hide();
				$("#map_wrapper").hide()
			}
		}
	},
	add: function(a,b) {
		if(!AMM.markers[b.id]) {
			AMM.markers[b.id]= {
				location:a,
				details:b,
				active:false
			}
		}
		AMM.queue.push(b.id)
	},
	drawCenterMarker: function() {
		AMM.clearCenterMarker();
		if(AMM.mapLoaded&&AMM.centerLat&&AMM.centerLng) {
			var b=1;
			if(AMM.geocodePrecision) {
				if(AMM.geocodePrecision=="address") {
					b=100
				}
			}
			var d=new google.maps.LatLng(AMM.centerLat,AMM.centerLng);
			var a=new google.maps.Marker({
				position:d,
				map:AMM.map,
				icon:MapIcons.centerPoint,
				shadow:MapIcons.shadowCenterPoint,
				title:Translations.you_are_here,
				zIndex:b
			});
			AMM.centerMarker=a;
			var c=AMM.currentBounds;
			if(c===false) {
				c=new google.maps.LatLngBounds()
			}
			c.extend(d)
		}
	},
	clearCenterMarker: function() {
		if(AMM.centerMarker!==false) {
			AMM.centerMarker.setMap(null);
			AMM.centerMarker=false
		}
	},
	clearOverlays: function(a) {
		if(AMM.markers) {
			jQuery.each(AMM.markers, function(b,c) {
				if(jQuery.inArray(parseInt(b,10),AMM.queue)===-1||a===true) {
					AMM.removeOverlay(b)
				}
			})
		}
	},
	openInfoWindow: function(b,a,d) {
		var c=AMM.activeInfoWindow;
		AMM.activeInfoWindowMarker=a;
		if(c) {
			c.setContent(b);
			c.open(AMM.map,a)
		} else {
			c=AMM.activeInfoWindow=new google.maps.InfoWindow({
				content:b,
				maxWidth:241
			});
			google.maps.event.addListenerOnce(c,"closeclick", function() {
				c=AMM.activeInfoWindow=AMM.activeInfoWindowMarker=null
			});
			c.open(AMM.map,a)
		}
		if(SS.initialized===true) {
			SS.reset();
			google.maps.event.addListenerOnce(c,"domready", function() {
				if(typeof SS.pictureArrays[d]!=="undefined") {
					jQuery(".map_info_window").find("img").attr("src",SS.fullImageUrl(SS.pictureArrays[d][0]))
				}
				SS.show(".map_info_window",d)
			})
		}
	},
	closeInfoWindow: function() {
		if(AMM.activeInfoWindow) {
			google.maps.event.clearInstanceListeners(AMM.activeInfoWindow);
			AMM.activeInfoWindow.close();
			AMM.activeInfoWindow=AMM.activeInfoWindowMarker=null;
			if(SS.initialized===true) {
				SS.hide()
			}
			return true
		} else {
			return false
		}
	},
	removeOverlay: function(b) {
		var a=AMM.markers[b];
		if(a.active===true) {
			if(a.infoWindow) {
				google.maps.event.clearInstanceListeners(a.infoWindow);
				a.infoWindow=null
			}
			google.maps.event.clearInstanceListeners(a.marker);
			a.marker.setMap(null);
			a.marker=null;
			a.active=false
		}
	},
	showOverlays: function() {
		var a=21;
		var b=AMM.queue.length;
		jQuery.each(AMM.queue, function(e,h) {
			var c,l,f,k;
			var j=AMM.markers[h];
			if(j.active===false) {
				c=j.details;
				k=jQuery.inArray(h.toString(),AirbnbSearch.viewedIds)!==-1;
				if(e<a) {
					if(k) {
						l=MapIcons.numberedVisited[e+1]
					} else {
						l=MapIcons.numbered[e+1]
					}
					j.numbered_pin=e;
					f=new google.maps.Marker({
						position:j.location,
						map:AMM.map,
						icon:l,
						shadow:MapIcons.shadowStandard,
						title:[(e+1),". ",c.name].join(""),
						zIndex:(b-e)
					})
				} else {
					if(k) {
						l=MapIcons.smallVisited
					} else {
						l=MapIcons.small
					}
					j.numbered_pin=false;
					f=new google.maps.Marker({
						position:j.location,
						map:AMM.map,
						icon:l,
						shadow:MapIcons.shadowSmall,
						title:c.name,
						zIndex:(b-e)
					})
				}
				if(AirbnbSearch.currentViewType==="map") {
					var g=(c.review_count===1?Translations.review:Translations.reviews);
					var d=['<div class="map_info_window">','<a class="map_info_window_link_image" href="/rooms/',h,'" />','<img width="210" height="140" class="map_info_window_thumbnail" src="',c.smallThumbnail,'" />',"</a>",'<p class="map_info_window_details">','<a class="map_info_window_link" href="/rooms/',h,'" />',c.name,"</a>",'<span class="map_info_window_review_count">',c.review_count," ",g,"</span>",'<span class="map_info_window_price">',AirbnbSearch.currencySymbolLeft,c.price,AirbnbSearch.currencySymbolRight,"</span>","</p>","</div>"].join("");
					google.maps.event.addListener(f,"click", function(i) {
						AMM.openInfoWindow(d,f,h)
					})
				} else {
					google.maps.event.addListener(f,"mouseover", function() {
						AirbnbSearch.hoverListResult(h)
					});
					google.maps.event.addListener(f,"mouseout", function() {
						AirbnbSearch.unHoverListResult(h)
					});
					google.maps.event.addListener(f,"click", function() {
						AirbnbSearch.viewedIds.push(h.toString());
						var i=MapIcons.numberedVisitedHover[j.numbered_pin+1];
						j.marker.setIcon(i);
						window.location=["/rooms/",h].join("")
					})
				}
				j.marker=f;
				j.active=true
			}
		});
		AMM.clearQueue()
	},
	clearQueue: function() {
		AMM.queue=[]
	},
	turnMapListenersOn: function() {
		AMM.listenForMapChanges()
	},
	turnMapListenersOff: function() {
		if(AMM.mapLoaded) {
			google.maps.event.clearListeners(AMM.map,"idle")
		}
	},
	listenForMapChanges: function() {
		if(AMM.mapLoaded) {
			google.maps.event.addListener(AMM.map,"idle", function() {
				AMM.mapListenerCallback()
			})
		}
	},
	fitBounds: function(a) {
		if(AMM.mapLoaded) {
			AMM.map.fitBounds(a)
		}
	},
	mapListenerCallback: function() {
		if(AMM.isFirstMapInteraction===true) {
			AMM.isFirstMapInteraction=false;
			var a=jQuery("#first_time_map_question");
			if(!redoSearchInMapIsChecked()) {
				AMM.redoSearchPromptTimeout=setTimeout( function() {
					a.fadeOut(2000)
				},14000);
				a.show();
				return false
			}
		}
		if(AMM.activeInfoWindow&&AMM.activeInfoWindowMarker) {
			var i=AMM.overlay.getProjection().fromLatLngToContainerPixel(AMM.activeInfoWindowMarker.getPosition());
			var j=i.x;
			var g=i.y;
			var c=82;
			var l=jQuery("#search_map");
			var e=l.width();
			var d=l.height();
			var k=260;
			var h=250;
			var b=k/2;
			var f=h/2;
			if(redoSearchInMapIsChecked()) {
				if((j<f)||(g<b)||(j>(e-(f)+(c/2)))||(g>(d+(b*1.33)))) {
					AMM.closeInfoWindow()
				}
			} else {
				if(j<0||g<0||(j>(e+c))||g>(d+k)) {
					AMM.closeInfoWindow()
				}
			}
		}
		if(!AMM.activeInfoWindow) {
			AirbnbSearch.results_changed_by_map_action=true;
			AirbnbSearch.loadNewResults()
		}
	}
};
var Connections= {
	COOKIE_NAME:"airbnb_connect_banner",
	COOKIE_HIDE_VALUE:"hide",
	init: function() {
		var b=$("#connect_banner");
		var c=$("#airtv_promo");
		var a=jQuery.cookie(Connections.COOKIE_NAME);
		if(c.length<1&&b.length>0&&a!==Connections.COOKIE_HIDE_VALUE) {
			$("#connect_banner_close").click(Connections.closeClickHandler);
			$("#fb-connect-banner-button").click(Connections.connectButtonClickHandler);
			b.show()
		}
	},
	closeClickHandler: function(a) {
		$.cookie(Connections.COOKIE_NAME,Connections.COOKIE_HIDE_VALUE, {
			expires:90,
			path:"/"
		});
		$b.remove();
		$b=null;
		Connections.trackEvent("hidePage2Banner");
		a.preventDefault()
	},
	connectButtonClickHandler: function() {
		var b="loading";
		var a=$(this).addClass(b);
		Airbnb.FBConnect.startLoginFlow();
		Airbnb.FBConnect.one("connect_success", function() {
			Connections.trackEvent("page2FbConnect")
		});
		Airbnb.FBConnect.one("connect_cancel", function() {
			Connections.trackEvent("page2FbCancel");
			a.removeClass(b)
		});
		Airbnb.FBConnect.one("bail", function() {
			Connections.trackEvent("page2FbBail");
			a.removeClass(b)
		});
		Airbnb.FBConnect.one("complete", function() {
			Connections.trackEvent("page2FbComplete")
		});
		return false
	},
	trackEvent: function(a) {
		_gaq.push(["_trackEvent","SocialConnections",a])
	}
};
var SearchFilters= {
	defaults: {
		callbackFunction:"AirbnbSearch.loadNewResults",
		maxFilters:4
	},
	has_photo:[],
	host_has_photo:[],
	languages:[],
	property_type_id:[],
	top_neighborhoods:[],
	neighborhoods:[],
	top_amenities:[],
	amenities:[],
	min_bedrooms:[],
	min_beds:[],
	min_bathrooms:[],
	group_ids:[],
	room_types:[[0,[Translations.private_room,0]],[1,[Translations.shared_room,0]],[2,[Translations.entire_place,0]]],
	minPrice:10,
	maxPrice:300,
	filtersLightbox:false,
	applyPriceSliderChanges: function(a) {
		if(a!==undefined) {
			jQuery("#slider_user_min").html([AirbnbSearch.currencySymbolLeft,a.values[0],AirbnbSearch.currencySymbolRight].join(""));
			jQuery("#slider_user_max").html([AirbnbSearch.currencySymbolLeft,a.values[1],(a.values[1]==SearchFilters.maxPrice?"+ ":""),AirbnbSearch.currencySymbolRight].join(""))
		} else {
			jQuery("#slider_user_min").html([AirbnbSearch.currencySymbolLeft,jQuery("#slider-range").slider("values")[0],AirbnbSearch.currencySymbolRight].join(""));
			jQuery("#slider_user_max").html([AirbnbSearch.currencySymbolLeft,jQuery("#slider-range").slider("values")[1],(jQuery("#slider-range").slider("values")[1]==SearchFilters.maxPrice?"+ ":""),AirbnbSearch.currencySymbolRight].join(""))
		}
	},
	update: function(a) {
		SearchFilters.setFacets(a);
		SearchFilters.render()
	},
	setFacets: function(a) {
		SearchFilters.connected=a.connected||[];
		SearchFilters.room_types=a.room_type||[];
		SearchFilters.top_neighborhoods=a.top_neighborhoods||[];
		SearchFilters.neighborhoods=a.neighborhood_facet||[];
		SearchFilters.top_amenities=a.top_amenities||[];
		SearchFilters.amenities=a.hosting_amenity_ids||[];
		SearchFilters.has_photo=a.has_photo||[];
		SearchFilters.host_has_photo=a.host_has_photo||[];
		SearchFilters.languages=a.languages||[];
		SearchFilters.property_type_id=a.property_type_id||[];
		SearchFilters.group_ids=a.group_ids||[]
	},
	render: function(a) {
		SearchFilters.renderSocialConnections();
		SearchFilters.renderRoomTypes();
		SearchFilters.renderAmenities();
		SearchFilters.renderNeighborhoods();
		SearchFilters.renderGenericLightboxFacet("property_type_id");
		SearchFilters.renderGenericLightboxFacet("languages");
		SearchFilters.renderGenericLightboxFacet("group_ids");
		SearchFilters.renderAppliedFilters();
		return true
	},
	APPLIED_FILTER_NAMES: {
		neighborhoods:Translations.neighborhoods,
		hosting_amenities:Translations.amenities,
		room_types:Translations.room_type,
		price:Translations.price,
		keywords:Translations.keywords,
		property_type_id:Translations.property_type,
		min_bedrooms:Translations.bedrooms,
		min_bathrooms:Translations.bathrooms,
		min_beds:Translations.beds,
		languages:Translations.languages,
		collection:Translations.collection,
		starred:"Starred Items",
		host:Translations.host,
		group:Translations.group,
		connections:Translations.connections
	},
	renderAppliedFilters: function() {
		var a;
		jQuery("#applied_filters").empty();
		if(AirbnbSearch.params.neighborhoods&&AirbnbSearch.params.neighborhoods.length>0) {
			SearchFilters.renderOneAppliedFilter("neighborhoods",SearchFilters.APPLIED_FILTER_NAMES.neighborhoods)
		}
		if(AirbnbSearch.params.price_max||AirbnbSearch.params.price_min) {
			SearchFilters.renderOneAppliedFilter("price",SearchFilters.APPLIED_FILTER_NAMES.price)
		}
		if(AirbnbSearch.params.hosting_amenities&&AirbnbSearch.params.hosting_amenities.length>0) {
			SearchFilters.renderOneAppliedFilter("hosting_amenities",SearchFilters.APPLIED_FILTER_NAMES.hosting_amenities)
		}
		if(AirbnbSearch.params.room_types&&AirbnbSearch.params.room_types.length>0) {
			SearchFilters.renderOneAppliedFilter("room_types",SearchFilters.APPLIED_FILTER_NAMES.room_types)
		}
		if(AirbnbSearch.params.keywords&&AirbnbSearch.params.keywords.length>0) {
			SearchFilters.renderOneAppliedFilter("keywords",SearchFilters.APPLIED_FILTER_NAMES.keywords)
		}
		if(AirbnbSearch.params.property_type_id&&AirbnbSearch.params.property_type_id.length>0) {
			SearchFilters.renderOneAppliedFilter("property_type_id",SearchFilters.APPLIED_FILTER_NAMES.property_type_id)
		}
		if(AirbnbSearch.params.min_bedrooms&&AirbnbSearch.params.min_bedrooms>0) {
			SearchFilters.renderOneAppliedFilter("min_bedrooms",SearchFilters.APPLIED_FILTER_NAMES.min_bedrooms)
		}
		if(AirbnbSearch.params.min_beds&&AirbnbSearch.params.min_beds>0) {
			SearchFilters.renderOneAppliedFilter("min_beds",SearchFilters.APPLIED_FILTER_NAMES.min_beds)
		}
		if(AirbnbSearch.params.min_bathrooms&&AirbnbSearch.params.min_bathrooms>0) {
			SearchFilters.renderOneAppliedFilter("min_bathrooms",SearchFilters.APPLIED_FILTER_NAMES.min_bathrooms)
		}
		if(AirbnbSearch.params.languages&&AirbnbSearch.params.languages.length>0) {
			SearchFilters.renderOneAppliedFilter("languages",SearchFilters.APPLIED_FILTER_NAMES.languages)
		}
		if(AirbnbSearch.params.connected) {
			SearchFilters.renderOneAppliedFilter("connections",SearchFilters.APPLIED_FILTER_NAMES.connections)
		}
		if(AirbnbSearch.includeCollectionParam()===true) {
			a=AirbnbSearch.isViewingStarred?SearchFilters.APPLIED_FILTER_NAMES.starred:SearchFilters.APPLIED_FILTER_NAMES.collection;
			if(AirbnbSearch.collectionName&&AirbnbSearch.collectionName!=="") {
				a=[a,AirbnbSearch.collectionName].join(": ")
			}
			SearchFilters.renderOneAppliedFilter("collections",a)
		}
		if(AirbnbSearch.isViewingStarred) {
			a=SearchFilters.APPLIED_FILTER_NAMES.starred;
			SearchFilters.renderOneAppliedFilter("starred",a)
		}
		if(AirbnbSearch.includeHostParam()) {
			var c=SearchFilters.APPLIED_FILTER_NAMES.host;
			if(AirbnbSearch.hostName&&AirbnbSearch.hostName!=="") {
				c=[c,AirbnbSearch.hostName].join(": ")
			}
			SearchFilters.renderOneAppliedFilter("host",c)
		}
		if(AirbnbSearch.includeGroupParam()) {
			var b=SearchFilters.APPLIED_FILTER_NAMES.group;
			if(AirbnbSearch.groupName&&AirbnbSearch.groupName!=="") {
				b=[b,AirbnbSearch.groupName].join(": ")
			}
			SearchFilters.renderOneAppliedFilter("group",b)
		}
		if(jQuery("#applied_filters").html()==="") {
			jQuery("#results_filters").hide()
		} else {
			jQuery("#results_filters").show()
		}
	},
	appliedFilterXCallback: function(a) {
		var c=true;
		var d=jQuery(a).closest("li");
		var b=jQuery(d).attr("id").replace("applied_filter_","");
		switch(b) {
			case"neighborhoods":
				SearchFilters.clearNeighborhoods();
				break;
			case"price":
				c=false;
				SearchFilters.clearPrice();
				break;
			case"hosting_amenities":
				SearchFilters.clearAmenities();
				break;
			case"room_types":
				SearchFilters.clearRoomTypes();
				break;
			case"keywords":
				SearchFilters.clearKeywords();
				break;
			case"property_type_id":
				SearchFilters.clearPropertyTypes();
				break;
			case"min_bedrooms":
				SearchFilters.clearMinBedrooms();
				break;
			case"min_bathrooms":
				SearchFilters.clearMinBathrooms();
				break;
			case"min_beds":
				SearchFilters.clearMinBeds();
				break;
			case"languages":
				SearchFilters.clearLanguages();
				break;
			case"collections":
				SearchFilters.clearCollections();
				break;
			case"starred":
				SearchFilters.clearStarred();
			case"host":
				SearchFilters.clearHost();
				break;
			case"group":
				SearchFilters.clearGroup();
				break;
			case"connections":
				SearchFilters.clearConnections();
				break;
			default:
		}
		d.remove();
		if(c===true) {
			AirbnbSearch.loadNewResults()
		}
	},
	clearStarred: function() {
		AirbnbSearch.isViewingStarred=false
	},
	clearCollections: function(a) {
		a=a||true;
		if(AirbnbSearch.collectionId!==false&&jQuery.trim(AirbnbSearch.collectionName).length!==0) {
			setTimeout( function() {
				if(jQuery("#reinstate_collections").length===0) {
					jQuery(["<a class='rounded_more reinstate_button' id='reinstate_collections'>Back to the  \"",AirbnbSearch.collectionName,'" Collection</a>'].join("")).insertBefore("#v3_search")
				}
			},1000)
		}
		AirbnbSearch.forceHideCollection=a
	},
	reinstateCollections: function() {
		AirbnbSearch.forceHideCollection=false;
		jQuery("#location").val("");
		AirbnbSearch.loadNewResults()
	},
	clearHost: function() {
		if(AirbnbSearch.hostId!==false&&AirbnbSearch.hostName!=="") {
			setTimeout( function() {
				if(jQuery("#reinstate_user").length===0) {
					jQuery(["<a class='rounded_more reinstate_button' id='reinstate_user'>Back to properties from ",AirbnbSearch.hostName,"</a>"].join("")).insertBefore("#v3_search")
				}
			},1000)
		}
		AirbnbSearch.forceHideHost=true
	},
	reinstateHost: function() {
		AirbnbSearch.forceHideHost=false;
		jQuery("#location").val("");
		AirbnbSearch.loadNewResults()
	},
	clearGroup: function() {
		if(AirbnbSearch.groupId!==false&&AirbnbSearch.groupName!=="") {
			setTimeout( function() {
				if(jQuery("#reinstate_group").length===0) {
					jQuery(["<a class='rounded_more reinstate_button' id='reinstate_group'>Back to properties from ",AirbnbSearch.groupName,"</a>"].join("")).insertBefore("#v3_search")
				}
			},1000)
		}
		AirbnbSearch.forceHideGroup=true
	},
	reinstateGroup: function() {
		AirbnbSearch.forceHideGroup=false;
		jQuery("#location").val("");
		AirbnbSearch.loadNewResults()
	},
	clearNeighborhoods: function() {
		jQuery("input[name=neighborhoods]").each( function(a,b) {
			jQuery(b).attr("checked",false)
		})
	},
	clearAmenities: function() {
		jQuery("input[name=amenities]").each( function(a,b) {
			jQuery(b).attr("checked",false)
		})
	},
	clearLanguages: function() {
		jQuery("input[name=languages]").each( function(a,b) {
			jQuery(b).attr("checked",false)
		})
	},
	clearConnections: function() {
		$("input[name=connected]").attr("checked",false)
	},
	clearKeywords: function() {
		var a=jQuery("#keywords");
		if(AirbnbSearch.params.keywords!==undefined) {
			delete AirbnbSearch.params.keywords
		}
		a.val(a.attr("defaultValue"))
	},
	clearRoomTypes: function() {
		jQuery("input[name=room_types]").each( function(a,b) {
			jQuery(b).attr("checked",false)
		})
	},
	clearPropertyTypes: function() {
		jQuery("input[name=property_type_id]").each( function(a,b) {
			jQuery(b).attr("checked",false)
		})
	},
	clearMinBedrooms: function() {
		jQuery("#min_bedrooms").val("")
	},
	clearMinBathrooms: function() {
		jQuery("#min_bathrooms").val("")
	},
	clearMinBeds: function() {
		jQuery("#min_beds").val("")
	},
	clearPrice: function() {
		jQuery("#slider-range").slider("values",[jQuery("#slider-range").slider("option","min"),jQuery("#slider-range").slider("option","max")]);
		SearchFilters.applyPriceSliderChanges()
	},
	renderOneAppliedFilter: function(a,b) {
		jQuery("#applied_filters").append(jQuery("#applied_filters_template").jqote({
			filter_id:a,
			filter_display_name:b
		},"*"))
	},
	renderSocialConnections: function() {
		var b=SearchFilters.connected&&SearchFilters.connected[0];
		var a="#social_connections_container .search_filter_content";
		$(a).empty();
		if(b) {
			SearchFilters.buildCheckbox({
				elementId:"connected",
				elementName:"connected",
				htmlValue:"connected",
				label:Translations.social_connections,
				facetCount:b[1],
				forceActive:true,
				appendToElementSelector:a,
				checked:AirbnbSearch.params.connected
			})
		}
		$(a).append('<li><a href="/social/" target="_blank">'+Translations.learn_more+"!</a></li>")
	},
	renderRoomTypes: function() {
		jQuery("#room_type_container ul.search_filter_content").empty();
		jQuery("#lightbox_filter_content_room_type").empty();
		jQuery.each(SearchFilters.room_types, function(a,c) {
			var b;
			if(AirbnbSearch.params.room_types&&jQuery.inArray(c[0],AirbnbSearch.params.room_types)>-1) {
				b=true
			} else {
				b=false
			}
			SearchFilters.buildCheckbox({
				elementId:["room_type_",a].join(""),
				elementName:"room_types",
				htmlValue:c[0],
				label:c[1][0],
				facetCount:c[1][1],
				forceActive:true,
				appendToElementSelector:"#room_type_container ul.search_filter_content",
				checked:b
			});
			SearchFilters.buildCheckbox({
				elementId:["lightbox_room_type_",a].join(""),
				elementName:"room_types",
				htmlValue:c[0],
				label:c[1][0],
				forceActive:true,
				facetCount:c[1][1],
				appendToElementSelector:"#lightbox_filter_content_room_type",
				checked:b
			})
		});
		SearchFilters.appendShowMoreLink("#room_type_container ul.search_filter_content")
	},
	renderAmenities: function() {
		var a=0;
		var b;
		jQuery("#amenities_container ul.search_filter_content").empty();
		jQuery("#lightbox_container_amenities ul.search_filter_content").empty();
		if(parseInt(SearchFilters.top_amenities.length,10)>0) {
			jQuery.each(SearchFilters.top_amenities, function(c,d) {
				if(AirbnbSearch.params&&AirbnbSearch.params.hosting_amenities&&jQuery.inArray(d[0].toString(),AirbnbSearch.params.hosting_amenities)>-1) {
					b=true
				} else {
					b=false
				}
				if(c<SearchFilters.defaults.maxFilters) {
					SearchFilters.buildCheckbox({
						elementId:"amenity_"+c,
						elementName:"amenities",
						htmlValue:d[0],
						label:d[1][0],
						facetCount:d[1][1],
						checked:b,
						appendToElementSelector:"#amenities_container ul.search_filter_content"
					})
				}
				a++
			})
		}
		if(parseInt(SearchFilters.amenities.length,10)>0&&parseInt(SearchFilters.amenities.length,10)>a) {
			jQuery.each(SearchFilters.amenities, function(c,d) {
				if(AirbnbSearch.params&&AirbnbSearch.params.hosting_amenities&&jQuery.inArray(d[0].toString(),AirbnbSearch.params.hosting_amenities)>-1) {
					b=true
				} else {
					b=false
				}
				if(a===0) {
					SearchFilters.buildCheckbox({
						elementId:"amenity_"+a,
						elementName:"amenities",
						htmlValue:d[0],
						label:d[1][0],
						facetCount:d[1][1],
						checked:b,
						appendToElementSelector:"#amenities_container ul.search_filter_content"
					})
				}
				SearchFilters.buildCheckbox({
					elementId:"lightbox_amenity_"+a,
					elementName:"amenities",
					htmlValue:d[0],
					label:d[1][0],
					facetCount:d[1][1],
					checked:b,
					appendToElementSelector:"#lightbox_container_amenities ul.search_filter_content"
				});
				a++
			});
			if(SearchFilters.amenities.length>SearchFilters.defaults.maxFilters) {
				SearchFilters.appendShowMoreLink("#amenities_container ul.search_filter_content")
			}
		} else {
			jQuery("#amenities_container").hide()
		}
		if(a>0) {
			jQuery("#amenities_container").show()
		}
		return true
	},
	renderNeighborhoods: function() {
		var a=0;
		var b;
		var c=true;
		jQuery("#neighborhood_container ul.search_filter_content").empty();
		jQuery("#lightbox_container_neighborhood ul.search_filter_content").empty();
		if(SearchFilters.top_neighborhoods&&parseInt(SearchFilters.top_neighborhoods.length,10)>0) {
			jQuery.each(SearchFilters.top_neighborhoods, function(d,e) {
				c=true;
				if(e[0].indexOf("'")>-1) {
					c=false
				}
				if(AirbnbSearch.params&&AirbnbSearch.params.neighborhoods&&jQuery.inArray(e[0],AirbnbSearch.params.neighborhoods)>-1) {
					b=true
				} else {
					b=false
				}
				if(d<SearchFilters.defaults.maxFilters&&c) {
					SearchFilters.buildCheckbox({
						elementId:"neighborhood_"+d,
						elementName:"neighborhoods",
						htmlValue:e[0],
						label:e[1][0],
						facetCount:e[1][1],
						checked:b,
						appendToElementSelector:"#neighborhood_container ul.search_filter_content"
					})
				}
				a++
			})
		}
		if(SearchFilters.neighborhoods&&parseInt(SearchFilters.neighborhoods.length,10)>0&&parseInt(SearchFilters.neighborhoods.length,10)>a) {
			jQuery.each(SearchFilters.neighborhoods, function(d,e) {
				c=true;
				if(e[0].indexOf("'")>-1) {
					c=false
				}
				if(AirbnbSearch.params&&AirbnbSearch.params.neighborhoods&&jQuery.inArray(e[0],AirbnbSearch.params.neighborhoods)>-1) {
					b=true
				} else {
					b=false
				}
				if(a===0&&c) {
					SearchFilters.buildCheckbox({
						elementId:"neighborhood_"+a,
						elementName:"neighborhoods",
						htmlValue:e[0],
						label:e[1][0],
						facetCount:e[1][1],
						checked:b,
						appendToElementSelector:"#neighborhood_container ul.search_filter_content"
					})
				}
				if(c) {
					SearchFilters.buildCheckbox({
						elementId:"lightbox_neighborhood_"+a,
						elementName:"neighborhoods",
						htmlValue:e[0],
						label:e[1][0],
						facetCount:e[1][1],
						checked:b,
						appendToElementSelector:"#lightbox_container_neighborhood ul.search_filter_content"
					})
				}
				a++
			});
			if(SearchFilters.neighborhoods.length>SearchFilters.defaults.maxFilters) {
				SearchFilters.appendShowMoreLink("#neighborhood_container ul.search_filter_content")
			}
		} else {
			jQuery("#neighborhood_container").hide()
		}
		if(a>0) {
			jQuery("#neighborhood_container").show()
		}
		return true
	},
	renderGenericLightboxFacet: function(a) {
		var b;
		jQuery(["#lightbox_filter_content_",a].join("")).empty();
		jQuery.each(SearchFilters[a], function(c,d) {
			if(AirbnbSearch.params&&AirbnbSearch.params[a]&&AirbnbSearch.params[a]!==undefined&&(jQuery.inArray(d[0].toString(),AirbnbSearch.params[a])>-1)) {
				b=true
			} else {
				b=false
			}
			SearchFilters.buildCheckbox({
				elementId:["lightbox_",a,"_",c].join(""),
				elementName:a,
				htmlValue:d[0],
				label:d[1][0],
				forceActive:true,
				facetCount:d[1][1],
				appendToElementSelector:["#lightbox_filter_content_",a].join(""),
				checked:b
			})
		})
	},
	buildCheckbox: function(j) {
		j=j|| {};
		var i=typeof(j.checked)=="undefined"?false:j.checked;
		var k=j.elementName||j.elementName||"";
		var c=j.elementId||"";
		var b=j.appendToElementSelector||"";
		var g=j.label||"";
		var a=j.htmlValue.toString()||"";
		var f=j.facetCount||false;
		var e=j.forceActive||false;
		var h=j.onChangecallbackFunction||SearchFilters.defaults.callbackFunction;
		var d=["<li class='clearfix'>",(f>0?["<span class='facet_count'>",f,"</span>"].join(""):""),"<input type='checkbox' id='",c,"' name='",k,"' value='",a,"'",((f>0||i===true||e===true)?"":" disabled='disabled'"),(i===false?"":" checked='checked'")," /> <label ",((f>0||i===true||e===true)?"":' class="disabled" '),"for='",c,"'>",g,"</label>","</li>"].join("");
		if(b!=="") {
			jQuery(b).append(d)
		}
		return false
	},
	appendShowMoreLink: function(a) {
		if(a===undefined) {
			return false
		}
		jQuery(a).append("<li><a href='javascript:void(0);' class='show_more_link'>"+Translations.show_more+"</a></li>");
		return true
	},
	openFiltersLightbox: function() {
		SearchFilters.filtersLightbox=SearchFilters.filtersLightbox||jQuery("#filters_lightbox").dialog({
			autoOpen:false,
			height:500,
			width:600
		});
		SearchFilters.filtersLightbox.dialog("open")
	},
	closeFiltersLightbox: function() {
		if(SearchFilters.filtersLightbox) {
			SearchFilters.filtersLightbox.dialog("close")
		}
	},
	selectLightboxTab: function(a) {
		var b=a||"room_type";
		jQuery(".filters_lightbox_nav_element").removeClass("active");
		jQuery(".lightbox_filter_container").hide();
		jQuery("#lightbox_nav_"+b).addClass("active");
		jQuery("#lightbox_container_"+b).show()
	}
};
var SS= {
	initialized:false,
	SHORT_TIMEOUT:50,
	LONG_TIMEOUT:675,
	FADE_DURATION:250,
	containerEl:jQuery("#page2_inline_slideshow"),
	imgEl:jQuery("#page2_inline_slideshow_img"),
	isFirstHover:true,
	cloudFrontUrl:"http://i0.muscache.com/pictures/",
	hoverTimeout:false,
	pictureArrays: {},
	currentUrls:[],
	currentParentDivId:undefined,
	currentHostingId:undefined,
	currentPosition:0,
	addHostingAndIds: function(b,a) {
		if(SS.pictureArrays[b]===undefined) {
			SS.pictureArrays[b]=a
		}
	},
	fullImageUrl: function(b) {
		var a=[SS.cloudFrontUrl,b,"/small.jpg"].join("");
		return a
	},
	initOnce: function() {
		if(SS.initialized===false) {
			SS.init()
		}
	},
	init: function() {
		jQuery("#page2_inline_slideshow, .map_info_window_link_image").live("hover", function() {
			if(SS.hoverTimeout) {
				clearTimeout(SS.hoverTimeout)
			}
			if(SS.isFirstHover===true) {
				SS.hoverTimeout=setTimeout( function() {
					SS.next()
				},SS.SHORT_TIMEOUT);
				SS.isFirstHover=false
			} else {
				SS.hoverTimeout=setTimeout( function() {
					SS.next()
				},SS.LONG_TIMEOUT)
			}
		}, function() {
			SS.reset()
		});
		SS.initialized=true
	},
	next: function() {
		var b,a;
		if(SS.totalPicturesSize()<=1) {
			return
		}
		b=SS.fullImageUrl(SS.pictureArrays[SS.currentHostingId][0]);
		SS.pictureArrays[SS.currentHostingId].push(SS.pictureArrays[SS.currentHostingId].shift());
		a=SS.fullImageUrl(SS.pictureArrays[SS.currentHostingId][0]);
		SS.imgEl.attr("src",b);
		SS.imgEl.show();
		SS.preloadImage(a,(function(c) {
			return function() {
				if(c===SS.currentHostingId) {
					if(AirbnbSearch.currentViewType==="map") {
						jQuery(".map_info_window").find("img").attr("src",a)
					} else {
						jQuery(SS.currentParentDivId).find(".search_thumbnail").attr("src",a)
					}
					SS.imgEl.fadeOut(SS.FADE_DURATION, function() {
						if(SS.hoverTimeout===null) {
							SS.imgEl.attr("src","/images/uiwidgets/transparent1x1.gif");
							SS.hoverTimeout=setTimeout( function() {
								SS.next()
							},SS.LONG_TIMEOUT)
						}
					})
				}
			}
		})(SS.currentHostingId));
		SS.hoverTimeout=null
	},
	show: function(a,b) {
		SS.currentParentDivId=a;
		SS.currentHostingId=b;
		SS.attachToParent();
		SS.containerEl.show()
	},
	hide: function() {
		SS.containerEl.hide()
	},
	attachToParent: function() {
		if(SS.currentParentDivId) {
			if(AirbnbSearch.currentViewType=="map") {
				SS.containerEl.appendTo(SS.currentParentDivId);
				SS.containerEl.attr("href",jQuery(SS.currentParentDivId).find("a.image_link").attr("href"))
			} else {
				SS.containerEl.appendTo(SS.currentParentDivId);
				SS.containerEl.attr("href",jQuery(SS.currentParentDivId).find("a.image_link").attr("href"))
			}
		}
	},
	reset: function() {
		SS.hide();
		SS.imgEl.hide();
		clearTimeout(SS.hoverTimeout);
		SS.hoverTimeout=false;
		SS.isFirstHover=true
	},
	totalPicturesSize: function() {
		return SS.pictureArrays[SS.currentHostingId].length
	},
	preloadImage: function(b,c) {
		var a=new Image();
		a.src=b;
		if(a.complete) {
			if(SS.hoverTimeout!==false) {
				c()
			}
			a.onload= function() {
			}
		} else {
			a.onload= function() {
				if(SS.hoverTimeout!==false) {
					c()
				}
				a.onload= function() {
				}
			}
		}
	}
};
AirbnbSearch.$.bind("finishedrendering", function() {
	AirbnbSearch.updateFacebookBannerText()
});