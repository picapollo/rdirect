LazyLoad= function(g) {
	function c(k,i) {
		var j=g.createElement(k),h;
		for(h in i) {
			i.hasOwnProperty(h)&&j.setAttribute(h,i[h])
		}
		return j
	}

	function e(k) {
		var i=f[k],h,j;
		if(i) {h=i.callback,j=i.urls,j.shift(),o=0,j.length||(h&&h.call(i.context,i.obj),f[k]=null,d[k].length&&l(k))
		}
	}

	function v() {
		if(!q) {
			var b=navigator.userAgent;
			q= {
				async:g.createElement("script").async===!0
			};
			(q.webkit=/AppleWebKit\//.test(b))||(q.ie=/MSIE/.test(b))||(q.opera=/Opera/.test(b))||(q.gecko=/Gecko\//.test(b))||(q.unknown=!0)
		}
	}

	function l(u,y,p,s,n) {
		var m= function() {
			e(u)
		},j=u==="css",r,k,t,b;
		v();
		if(y) {
			if(y=typeof y==="string"?[y]:y.concat(),j||q.async||q.gecko||q.opera) {
				d[u].push({
					urls:y,
					callback:p,
					obj:s,
					context:n
				})
			} else {
				r=0;
				for(k=y.length;r<k;++r) {
					d[u].push({
						urls:[y[r]],
						callback:r===k-1?p:null,
						obj:s,
						context:n
					})
				}
			}
		}
		if(!f[u]&&(b=f[u]=d[u].shift())) {
			a||(a=g.head||g.getElementsByTagName("head")[0]);
			y=b.urls;
			r=0;
			for(k=y.length;r<k;++r) {p=y[r],j?t=q.gecko?c("style"):c("link", {
					href:p,
					rel:"stylesheet"
				}):(t=c("script", {
						src:p
					}),t.async=!1),t.className="lazyload",t.setAttribute("charset","utf-8"),q.ie&&!j?t.onreadystatechange= function() {
					if(/loaded|complete/.test(t.readyState)) {t.onreadystatechange=null,m()
					}
				}:j&&(q.gecko||q.webkit)?q.webkit?(b.urls[r]=t.href,x()):(t.innerHTML='@import "'+p+'";',e("css")):t.onload=t.onerror=m,a.appendChild(t)
			}
		}
	}

	function x() {
		var h=f.css,b;
		if(h) {
			for(b=w.length;--b>=0;) {
				if(w[b].href===h.urls[0]) {
					e("css");
					break
				}
			}
			o+=1;
			h&&(o<200?setTimeout(x,50):e("css"))
		}
	}

	var q,a,f= {},o=0,d= {
		css:[],
		js:[]
	},w=g.styleSheets;
	return {
		css: function(k,i,h,j) {
			l("css",k,i,h,j)
		},
		js: function(k,i,h,j) {
			l("js",k,i,h,j)
		}
	}
}(this.document);
function ajax_log(c,b,a) {
	var d= {
		namespace:c,
		name:b
	};
	if(a) {
		d.fields=a
	}
	jQuery.ajax({
		url:base_url+"ajax_log",
		type:"post",
		dataType:"json",
		data:d
	})
}

function bind_logging(b,f,c,a) {
	var l=$(b);
	if(!l.get(0)) {
		return
	}
	var i=l.get(0).nodeName.toLowerCase(),d=a.selector||[i,"#",l.attr("id")].join(""),e=a.prefix?(a.prefix+"."):"",h=a.field_fns?a.field_fns: {},k= function(o) {
		var n=[e,o.type,"_",d].join("");
		var m=h[o.type]?h[o.type](l): {};
		ajax_log(c,n,m)
	};
	var g= {
		blur: function(m) {
			return {
				value:m.val()
			}
		},
		change: function(m) {
			if(i=="select") {
				return {
					option:m.find("option:selected").val()
				}
			} else {
				if(i=="input"||i=="textarea") {
					return {
						value:m.val()
					}
				} else {
					return {}
				}
			}
		},
		click: function(m) {
			if(i=="input"&&m.attr("type")=="checkbox") {
				return {
					checked:m.attr("checked")
				}
			} else {
				return {}
			}
		}
	};
	for(var j in g) {
		if(g.hasOwnProperty(j)&&!h[j]) {
			h[j]=g[j]
		}
	}
	if(typeof f=="string") {
		f=[f]
	}
	for(var j in f) {
		if(f.hasOwnProperty(j)) {
			l.bind(f[j],k)
		}
	}
}

function textCounter(c,a,b) {
	if(c.value.length>b) {
		c.value=c.value.substring(0,b)
	} else {
		a.innerHTML=b-c.value.length
	}
}

function rollover(a,c,b) {
	jQuery("#"+a).addClass(b).removeClass(c)
}

function calendar_is_not_set_date(b) {
	var a=null;
	if(typeof(b)==="string") {
		a=jQuery("#"+b)
	} else {
		if(typeof(b)==="object") {
			a=jQuery(b)
		}
	}
	return jQuery.trim(a.val())===""||a.val()===jQuery.datepicker._defaults.dateFormat
}

function calendar_process_onfocus(a) {
	if(calendar_is_not_set_date(a)) {
		a.onclick()
	}
}

function calendar_helper_simple_today() {
	var a=new Date();
	a.setHours(0);
	a.setMinutes(0);
	a.setSeconds(0);
	a.setMilliseconds(0);
	return a
}

function calendar_show_cal(d,a,c) {
	if(arguments.length<3) {
		c="checkout"
	}
	a=typeof(a)!="undefined"?a:"absolute";
	var b=0;
	if(c!="one_calendar_override") {
		if(calendar_is_not_set_date(d)) {
			if(typeof(d)=="string") {
				jQuery("#"+d).datepicker("show")
			} else {
				jQuery(d).datepicker("show")
			}
		} else {
			if(calendar_is_not_set_date(c)) {
				jQuery("#"+c).datepicker("show")
			}
		}
	}
}

function calendar_show_cal_checkout(d,c,a) {
	a=typeof(a)!="undefined"?a:"absolute";
	var e=new Date();
	if(!calendar_is_not_set_date(c)) {
		e=Date.parse(jQuery("#"+c).val())
	}
	if(isNaN(e)) {
		e=new Date()
	}
	var b=Math.ceil((e-new Date())/(24*60*60*1000))+1;
	return new CalendarDateSelect(d, {
		position:a,
		month_year:"label",
		buttons:true,
		clear_button:true,
		default_date_offset:b,
		year_range:[new Date().getFullYear(),new Date().getFullYear()+2],
		valid_date_check: function(f) {
			return(f>e)
		}
	})
}

var re_airbnb=/airbnb\.com/;
var re_http=/(ftp|http|https):\/\//i;
var re_www=/www\.\w+/i;
var re_domain_ext=/\w+\.(com|net|org|biz|ws|name)/i;
var re_phone_number=/([0-9]{3,9}[\- ]?){3,9}/;
var re_phone_word=/((zero|one|two|three|four|five|six|seven|eight|nine)\W+){6,100}/i;
var re_email=/\w+(\.\w+){0,1}(@)[\w|\-]+(\.|\W{1,3}dot\W{1,3})\w+/;
var re_email_domain=/( aol|gmail|hotmail|msn|yahoo)(\.com){0,1}/i;
var censor_attempt_counter=0;
function censor_validate_content(a,c) {
	if(re_airbnb.test(a)) {
		return(true)
	}
	var d=(re_http.test(a)||re_www.test(a)||re_domain_ext.test(a));
	var b=(re_phone_number.test(a)||re_phone_word.test(a));
	var e=(re_email.test(a)||re_email_domain.test(a));
	if(d||b||e) {
		censor_attempt_counter++;
		if((censor_attempt_counter>3)&&c) {
			alert("Warning: It looks like you may be trying to send contact information. 100% of scams begin with contact information being exchanged and ultimately exchanging money offline. If you follow the rules, you are 100% protected against scams. If you believe your message does not contain a website, phone number, or email address, then email us at contact@airbnb.com and we can help.")
		} else {
			alert("It appears as though you entered a website, phone number, or email address. This information cannot be exchanged until after the booking is complete for your protection. Scams can only occur if you exchange money outside of the system. Please edit your message and try again.")
		}
		return(false)
	}
	return(true)
}

function lwlb_show(b,a) {
	if(!a) {
		a= {}
	}
	jQuery("#lwlb_overlay").css("display","block");
	jQuery("#"+b).css("display","block");
	if(!a.no_scroll) {
		window.scroll(0,0)
	}
}

function lwlb_hide(a) {
	jQuery("#"+a).hide();
	jQuery("#lwlb_overlay").hide()
}

function pluralize(a,b) {
	return(a+" "+b+((a==1)?"":"s"))
}

function show_options(a) {
	star_el=jQuery("div#thread_"+a+"_starred");
	if(!star_el.hasClass("permashow")) {
		star_el.fadeIn(50)
	}
	hidden_el=jQuery("div#thread_"+a+"_hidden");
	if(!hidden_el.hasClass("permashow")) {
		hidden_el.fadeIn(50)
	}
}

function hide_options(a) {
	hidden_el=jQuery("div#thread_"+a+"_hidden");
	if(!hidden_el.hasClass("permashow")) {
		hidden_el.fadeOut(50);
		star_el=jQuery("div#thread_"+a+"_starred");
		if(!star_el.hasClass("permashow")) {
			star_el.fadeOut(50)
		}
	}
}

function select_tab(c,a,b) {
	jQuery("."+c+"_link").removeClass("selected");
	b.addClass("selected");
	jQuery("#"+a).show();
	jQuery("."+c+"_content").hide();
	jQuery("#"+a).show()
}

var newWin=null;
function popup(e,d,a,c) {
	if(newWin!=null&&!newWin.closed) {
		newWin.close();var b=""
	}
	if(d=="console") {
		b="resizable,height="+a+",width="+c
	}
	if(d=="fixed") {
		b="status,height="+a+",width="+c
	}
	if(d=="elastic") {
		b="toolbar,menubar,scrollbars,resizable,location,height="+a+",width="+c
	}
	newWin=window.open(e,"newWin",b);
	newWin.focus()
}

var DEFAULT_COOKIE_OPTIONS= {
	path:base_url+"",
	expires:30
};
jQuery.cookie= function(b,j,m) {
	if(typeof j!="undefined") {
		m=m|| {};
		if(j===null) {
			j="";
			m=jQuery.extend({},m);
			m.expires=-1
		}
		var e="";
		if(m.expires&&(typeof m.expires=="number"||m.expires.toUTCString)) {
			var f;
			if(typeof m.expires=="number") {
				f=new Date();
				f.setTime(f.getTime()+(m.expires*24*60*60*1000))
			} else {
				f=m.expires
			}
			e="; expires="+f.toUTCString()
		}
		var l=m.path?"; path="+(m.path):"";
		var g=m.domain?"; domain="+(m.domain):"";
		var a=m.secure?"; secure":"";
		document.cookie=[b,"=",encodeURIComponent(j),e,l,g,a].join("")
	} else {
		var d=null;
		if(document.cookie&&document.cookie!="") {
			var k=document.cookie.split(";");
			for(var h=0;h<k.length;h++) {
				var c=jQuery.trim(k[h]);
				if(c.substring(0,b.length+1)==(b+"=")) {
					d=decodeURIComponent(c.substring(b.length+1));
					break
				}
			}
		}
		return d
	}
};
function save_page3_view_to_cookie(a) {
	add_data_to_cookie("viewed_page3_ids",a)
}

function get_viewed_page3_ids() {
	comma_separated_page3_ids=jQuery.cookie("viewed_page3_ids");
	if(comma_separated_page3_ids!=null) {
		array_of_page3_ids=comma_separated_page3_ids.split(",");
		array_of_page3_ids=jQuery.unique(array_of_page3_ids);
		return array_of_page3_ids
	}
	return false
}

function add_data_to_cookie(a,b) {
	existing_data=jQuery.cookie(a);
	if(existing_data==null) {
		new_data=b
	} else {
		new_data=existing_data+","+b;
		new_data=new_data.split(",");
		while(new_data.length>75) {
			new_data.splice(0,1)
		}
		new_data=jQuery.unique(new_data);
		new_data=new_data.join(",")
	}
	jQuery.cookie(a,new_data,DEFAULT_COOKIE_OPTIONS)
}

function show_super_lightbox(a) {
	jQuery("#transparent_bg_overlay").fadeIn(40);
	jQuery("#"+a).fadeIn(40);
	jQuery("#transparent_bg_overlay").click( function() {
		hide_super_lightbox(a)
	})
}

function hide_super_lightbox(a) {
	jQuery("#"+a).fadeOut(40);
	jQuery("#transparent_bg_overlay").fadeOut(40);
	jQuery("#transparent_bg_overlay").unbind("click")
}

function log(a) {
	if(window.console&&window.console.firebug) {
		console.log(a)
	}
}

Array.prototype.unique= function() {
	var b=this;
	var d=[];
	for(var a=b.length;a--;) {
		var c=b[a];
		if(jQuery.inArray(c,d)===-1) {
			d.unshift(c)
		}
	}
	return d
};
jQuery.leftPad= function(b,d,c) {
	var a=b.toString();
	if(!c) {
		c="0"
	}
	while(a.length<d) {
		a=c+a
	}
	return a
};
jQuery.support.placeholder=(function() {
	var a=document.createElement("input");
	return"placeholder" in a
})();
jQuery(document).ready( function(b) {
	var a=b("#language_currency_selector");
	b("#language_currency_display").toggle( function() {
		b("#language_currency_selector_container").show();
		b(this).addClass("selected")
	}, function() {
		b("#language_currency_selector_container").hide();
		b(this).removeClass("selected")
	});
	b("#language_currency").mouseleave( function(c) {
		if(b("#language_currency_selector_container").is(":visible")&&!(b(c.relatedTarget).parents().index(b("#language_currency_selector_container"))>=0)) {
			b("#language_currency_display").click()
		}
	});
	a.delegate("li.language","click", function() {
		b(this).effect("pulsate", {
			times:10
		},1000);
		a.css("cursor","progress");
		b.post(base_url+"users/change_locale", {
			new_locale:b(this).attr("name")
		}, function() {
			window.location.reload(true)
		})
	}).delegate("li.currency","click", function() {
		b(this).effect("pulsate", {
			times:10
		},1000);
		a.css("cursor","progress");
		b.post(base_url+"users/change_currency", {
			new_currency:b(this).attr("name")
		}, function() {
			window.location.reload(true)
		})
	})
});
if(!Array.indexOf) {
	Array.prototype.indexOf= function(b) {
		for(var a=0;a<this.length;a++) {
			if(this[a]==b) {
				return a
			}
		}
		return -1
	}
}
(function(a) {
	a.fn.airbnbInputDateSpan= function(d) {
		var b= {
			minDate:0,
			maxDate:"+2Y",
			nextText:"",
			prevText:"",
			numberOfMonths:1,
			showButtonPanel:true
		};
		d=d|| {};
		if(typeof d==="string") {
			var e=jQuery(this).data("airbnb-datepickeroptions");
			if(d==="enableClearDatesButton") {
				jQuery(".ui-datepicker-close").live("click", function() {
					var j=e.checkinDatePicker;
					var i=e.checkoutDatePicker;
					j.datepicker("option","minDate","+0");
					j.val(a.datepicker._defaults.dateFormat);
					i.datepicker("option","minDate","+1");
					i.val(a.datepicker._defaults.dateFormat);
					jQuery("#search_inputs").css("background-color","#ffe75f")
				})
			}
		} else {
			if(typeof d==="object") {
				var g=jQuery(this);
				var f= {
					checkinDatePicker:jQuery(d.checkin),
					checkoutDatePicker:jQuery(d.checkout),
					onSuccessCallback:d.onSuccess,
					onCheckinClose:d.onCheckinClose,
					onCheckoutClose:d.onCheckoutClose
				};
				if(!d.defaultsCheckin) {
					d.defaultsCheckin=b
				}
				if(!d.defaultsCheckout) {
					d.defaultsCheckout=b
				}
				if(!d.checkin) {
					f.checkinDatePicker=g.find("input.checkin")
				}
				if(!d.checkout) {
					f.checkoutDatePicker=g.find("input.checkout")
				}
				jQuery.each(["onSuccessCallback","onCheckinClose","onCheckoutClose"], function(j,k) {
					if(!f[k]) {
						f[k]= function() {
						}
					}
				});
				g.data("airbnb-datepickeroptions",f);
				var c=jQuery.extend(jQuery.extend(true, {},d.defaultsCheckin), {
					onClose: function(p,m) {
						var i=a.datepicker._defaults.dateFormat;
						var l=g.data("airbnb-datepickeroptions");
						if(p!==i) {
							var o=a.datepicker.parseDate(i,p);
							o=new Date(o.setDate(o.getDate()+1));
							var j=l.checkoutDatePicker;
							try {
								var k=a.datepicker.parseDate(i,j.val());
								j.datepicker("option","minDate",o);
								if(o>k) {
									j.val(a.datepicker.formatDate(i,o));
									j.datepicker("show")
								}
							} catch(n) {
								j.datepicker("option","minDate",o);
								j.val(a.datepicker.formatDate(i,o));
								j.datepicker("show")
							}
						}
						l.onCheckinClose()
					}
				});
				var h=jQuery.extend(jQuery.extend(true, {},d.defaultsCheckout), {
					onClose: function(n,l) {
						var i=a.datepicker._defaults.dateFormat;
						var k=g.data("airbnb-datepickeroptions");
						if(n!==i) {
							var p=a.datepicker.parseDate(i,n);
							p=new Date(p.setDate(p.getDate()-1));
							var o=k.checkinDatePicker;
							try {
								var j=a.datepicker.parseDate(i,o.val());
								if(p<j) {
									o.val(a.datepicker.formatDate(i,p));
									o.datepicker("show")
								} else {
									jQuery("#search_inputs").css("background-color","#ececec");
									k.onSuccessCallback()
								}
							} catch(m) {
								jQuery("#search_inputs").css("background-color","#ffe75f");
								o.val(a.datepicker.formatDate(i,p));
								o.datepicker("show")
							}
						}
						k.onCheckoutClose()
					}
				});
				f.checkinDatePicker.datepicker(c);
				f.checkoutDatePicker.datepicker(h);
				var e=g.data("airbnb-datepickeroptions");
				jQuery(".ui-datepicker-close").live("click", function() {
					var j=e.checkinDatePicker;
					var i=e.checkoutDatePicker;
					j.datepicker("option","minDate","+0");
					j.val(a.datepicker._defaults.dateFormat);
					i.datepicker("option","minDate","+1");
					i.val(a.datepicker._defaults.dateFormat);
					jQuery("#search_inputs").css("background-color","#ffe75f")
				})
			}
		}
	}
})(jQuery);
var Airbnb= {
	init: function(a) {
		Airbnb.Utils.formatPhoneNumbers();
		Airbnb.Utils.isUserLoggedIn=!a||!a.userLoggedIn?false:true
	},
	StringValidator: {
		Regexes: {
			url:/(https?)|(webcal):\/\/([-\w\.]+)+(:\d+)?(\/([\w\/_\.]*(\?\S+)?)?)?/,
			email:/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
			date:/[0-9]{2}\/[0-9]{2}\/[0-9]{4}/,
			phone:/((.*)?\d(.*?)){10,15}/
		},
		validate: function(a,b) {
			if(a===undefined||b===undefined||typeof b!="string") {
				return false
			}
			return(b.match(Airbnb.StringValidator.Regexes[a])!==null)
		}
	},
	Bookmarks: {
		initializeStarIcons: function(a) {
			jQuery(".star_icon_container").clickStar(a)
		},
		starredIds:[]
	},
	Utils: {
		isUserLoggedIn:false,
		usingIosDevice: function() {
			return !((navigator.userAgent.indexOf("iPhone")==-1)&&(navigator.userAgent.indexOf("iPod")==-1)&&(navigator.userAgent.indexOf("iPad")==-1))
		},
		fb_status: function() {
			return jQuery.cookie("fbs")
		},
		keyPressEventName:jQuery.browser.mozilla?"keypress":"keydown",
		decode: function(a) {
			return $("<div/>").html(a).text()
		},
		setInnerText: function(a) {
			jQuery.each(jQuery(".inner_text"), function(d,f) {
				var b=jQuery(f).next("input, textarea");
				var c=b.val();
				if(jQuery.support.placeholder&&b.attr("placeholder")!=="undefined"&&b.attr("placeholder")!=="") {
					jQuery(f).hide();
					return
				}
				b.attr("defaultValue",f.innerHTML);
				b.val(f.innerHTML);
				if(c.length===0) {
				} else {
					b.val(c);
					b.addClass("active")
				}
				b.bind("focus", function() {
					if(jQuery(b).val()==b.attr("defaultValue")) {
						jQuery(b).val("");
						global_test_var=jQuery(b);
						jQuery(b).addClass("active")
					}
					jQuery(b).removeClass("error");
					return true
				});
				b.bind("blur", function() {
					if(jQuery(b).val()==="") {
						jQuery(b).removeClass("active");
						jQuery(b).val(b.attr("defaultValue"))
					} else {
						jQuery(b).removeClass("error")
					}
				});
				if(a) {
					a.push(b)
				}
				jQuery(f).remove()
			})
		},
		createFlashNotice: function(a) {
		},
		clearInnerText: function(a) {
			var b,c,d;
			for(c=0;c<a.length;c++) {
				b=jQuery(a[c]);
				if(b.val()===b.attr("defaultValue")) {
					b.val("")
				}
			}
		},
		textCounter: function(c,b,a) {
			if(c.val().length>a) {
				c.val(c.val().substring(0,a))
			} else {
				b.html(a-c.val().length)
			}
		},
		formatPhoneNumbers: function() {
			if(jQuery(".phone_number_to_format").length>0) {
				try {var a=i18n.phonenumbers.PhoneNumberUtil.getInstance()
				} catch(b) {
					log("validator not loaded...");
					LazyLoad.js([base_url+"include/js/libphonenumber.compiled.js",base_url+"include/js/jquery.validatedphone.js"], function() {
						Airbnb.Utils.formatPhoneNumbers()
					});
					return false
				}
				jQuery(".phone_number_to_format").each( function(c,d) {
					d=jQuery(d);
					try {
						var f=a.parseAndKeepRawInput(d.html(),"US");
						var g=a.format(f,i18n.phonenumbers.PhoneNumberFormat.INTERNATIONAL);
						d.html(g)
					} catch(e) {
					}
				})
			}
		},
		initHowItWorksLightbox: function(b,c) {
			var a='<object id="video" width="764" height="458"><param name="movie" value="http://www.youtube.com/v/'+c+'?fs=1&amp;hl=en_US&amp;rel=0&amp;hd=1&amp;autoplay=1"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/'+c+'?fs=1&amp;hl=en_US&amp;rel=0&amp;hd=1&amp;autoplay=1" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="764" height="458"></embed></object>';
			Airbnb.Utils.initVideoLightbox(b,Translations.video_lightbox_title,a)
		},
		initVideoLightbox: function(b,c,a) {
			if(jQuery("#video_lightbox_content").length==0) {
				jQuery("body").append('<div id="video_lightbox_content"></div>')
			}
			jQuery(b).colorbox({
				inline:true,
				href:"#video_lightbox_content",
				onLoad: function() {
					jQuery("#video_lightbox_content").html(a)
				},
				onComplete: function() {
					jQuery("#cboxTitle").html(c)
				},
				onCleanup: function() {
					jQuery("#video_lightbox_content").html("");
					jQuery("#cboxTitle").html("")
				}
			})
		}
	},
	Currency:( function() {
		var c= {},a,b= {
			AUD:1.10004,
			CAD:1.06408,
			DKK:6.0803,
			EUR:0.673737,
			GBP:0.60359,
			JPY:90.8836,
			USD:1,
			ZAR:7.64502615
		};
		a= {
			USD: {
				symbol:"$",
				rate:1
			},
			EUR: {
				symbol:"&euro;",
				rate:b.EUR
			},
			DKK: {
				symbol:"kr",
				rate:b.DKK
			},
			CAD: {
				symbol:"$",
				rate:b.CAD
			},
			JPY: {
				symbol:"&yen;",
				rate:b.JPY
			},
			GBP: {
				symbol:"&pound;",
				rate:b.GBP
			},
			AUD: {
				symbol:"$",
				rate:b.AUD
			},
			ZAR: {
				symbol:"R",
				rate:b.ZAR
			}
		};
		c.currencyConversionTable=a;
		c.setCurrencyConversions= function(d) {
			for(var e in d) {
				if(d.hasOwnProperty(e)) {
					a[e].rate=d[e]
				}
			}
		};
		c.convert= function(e,g,f,d) {
			var h=e*a[f]["rate"]/a[g]["rate"];
			if(d) {
				return parseInt(Math.round(h))
			}
			return h
		};
		c.getSymbolForCurrency= function(d) {
			return a[d]["symbol"]
		};
		return c
	}())
};
(function(a) {
	a.fn.labelBlur= function() {
		return this.each( function() {
			var b=a(this).show(),e=a("#"+b.attr("for")),c;
			var d= function() {
				if(e.val().length) {
					b.hide();
					if(c) {
						clearInterval(c)
					}
				}
			};
			d();
			c=setInterval(d,100);
			e.focus( function() {
				b.hide();
				if(c) {
					clearInterval(c)
				}
			}).blur( function() {
				if(e.val()==="") {
					b.show()
				}
			});
			return this
		})
	};
	a.labelBlur= function() {
		a("label.labelBlur").labelBlur()
	};
	a(document).ready( function() {
		a.labelBlur()
	});
	a.fn.disableSubmit= function() {
		return this.each( function() {
			var c=a(this),b;
			if(c.is("input:submit")) {
				b=c
			} else {
				b=c.find("input:submit")
			}
			b.attr("disabled","disabled");
			return this
		})
	}
})(jQuery);
(function(a9,aK) {
	var aR="none",aq="LoadedContent",a8=false,aP="resize.",aW="y",aU="auto",a6=true,ar="nofollow",aY="x";
	function a5(b,d) {
		b=b?' id="'+a2+b+'"':"";
		d=d?' style="'+d+'"':"";
		return a9("<div"+b+d+"/>")
	}

	function aV(d,c) {
		c=c===aY?aX.width():aX.height();
		return typeof d==="string"?Math.round(/%/.test(d)?c/100*parseInt(d,10):parseInt(d,10)):d
	}

	function ai(a) {
		return ba.photo||/\.(gif|png|jpg|jpeg|bmp)(?:\?([^#]*))?(?:#(\.*))?$/i.test(a)
	}

	function aI(b) {
		for(var d in b) {
			if(a9.isFunction(b[d])&&d.substring(0,2)!=="on") {
				b[d]=b[d].call(aZ)
			}
		}
		b.rel=b.rel||aZ.rel||ar;
		b.href=b.href||a9(aZ).attr("href");
		b.title=b.title||aZ.title;
		return b
	}

	function aO(d,b) {
		b&&b.call(aZ);
		a9.event.trigger(d)
	}

	function aH() {
		var a,h=a2+"Slideshow_",i="click."+a2,g,d;
		if(ba.slideshow&&a3[1]) {
			g= function() {
				ay.text(ba.slideshowStop).unbind(i).bind(ah, function() {
					if(a4<a3.length-1||ba.loop) {
						a=setTimeout(a7.next,ba.slideshowSpeed)
					}
				}).bind(ag, function() {
					clearTimeout(a)
				}).one(i+" "+ap,d);
				a1.removeClass(h+"off").addClass(h+"on");
				a=setTimeout(a7.next,ba.slideshowSpeed)
			};
			d= function() {
				clearTimeout(a);
				ay.text(ba.slideshowStart).unbind([ah,ag,ap,i].join(" ")).one(i,g);
				a1.removeClass(h+"on").addClass(h+"off")
			};ba.slideshowAuto?g():d()
		}
	}

	function aF(b) {
		if(!ao) {
			aZ=b;
			ba=aI(a9.extend({},a9.data(aZ,aT)));
			a3=a9(aZ);
			a4=0;
			if(ba.rel!==ar) {
				a3=a9("."+ax).filter( function() {
					return(a9.data(this,aT).rel||this.rel)===ba.rel
				});
				a4=a3.index(aZ);
				if(a4===-1) {
					a3=a3.add(aZ);
					a4=a3.length-1
				}
			}
			if(!aQ) {
				aQ=aA=a6;
				a1.show();
				if(ba.returnFocus) {
					try {
						aZ.blur();
						a9(aZ).one(aa, function() {
							try {
								this.focus()
							} catch(c) {
							}
						})
					} catch(a) {
					}
				}
				aN.css({
					opacity:+ba.opacity,
					cursor:ba.overlayClose?"pointer":aU
				}).show();
				ba.w=aV(ba.initialWidth,aY);
				ba.h=aV(ba.initialHeight,aW);
				a7.position(0);
				af&&aX.bind(aP+an+" scroll."+an, function() {
					aN.css({
						width:aX.width(),
						height:aX.height(),
						top:aX.scrollTop(),
						left:aX.scrollLeft()
					})
				}).trigger("scroll."+an);
				aO(aJ,ba.onOpen);
				ae.add(aw).add(av).add(ay).add(ad).hide();
				aD.html(ba.close).show()
			}
			a7.load(a6)
		}
	}

	var aG= {
		transition:"elastic",
		speed:300,
		width:a8,
		initialWidth:"600",
		innerWidth:a8,
		maxWidth:a8,
		height:a8,
		initialHeight:"450",
		innerHeight:a8,
		maxHeight:a8,
		scalePhotos:a6,
		scrolling:a6,
		inline:a8,
		html:a8,
		iframe:a8,
		photo:a8,
		href:a8,
		title:a8,
		rel:a8,
		opacity:0.9,
		preloading:a6,
		current:"image {current} of {total}",
		previous:"previous",
		next:"next",
		close:"close",
		open:a8,
		returnFocus:a6,
		loop:a6,
		slideshow:a8,
		slideshowAuto:a6,
		slideshowSpeed:2500,
		slideshowStart:"start slideshow",
		slideshowStop:"stop slideshow",
		onOpen:a8,
		onLoad:a8,
		onComplete:a8,
		onCleanup:a8,
		onClosed:a8,
		overlayClose:a6,
		escKey:a6,
		arrowKey:a6
	},aT="colorbox",a2="cbox",aJ=a2+"_open",ag=a2+"_load",ah=a2+"_complete",ap=a2+"_cleanup",aa=a2+"_closed",am=a2+"_purge",ac=a2+"_loaded",az=a9.browser.msie&&!a9.support.opacity,af=az&&a9.browser.version<7,an=a2+"_IE6",aN,a1,aE,aS,bc,aj,al,ak,a3,aX,a0,au,at,ad,ae,ay,av,aw,aD,aC,aB,aM,aL,aZ,a4,ba,aQ,aA,ao=a8,a7,ax=a2+"Element";
	a7=a9.fn[aT]=a9[aT]= function(h,e) {
		var b=this,g;
		if(!b[0]&&b.selector) {
			return b
		}
		h=h|| {};
		if(e) {
			h.onComplete=e
		}
		if(!b[0]||b.selector===undefined) {
			b=a9("<a/>");
			h.open=a6
		}
		b.each( function() {
			a9.data(this,aT,a9.extend({},a9.data(this,aT)||aG,h));
			a9(this).addClass(ax)
		});
		g=h.open;
		if(a9.isFunction(g)) {
			g=g.call(b)
		}
		g&&aF(b[0]);
		return b
	};
	a7.init= function() {
		var b="hover",a="clear:left";
		aX=a9(aK);
		a1=a5().attr({
			id:aT,
			"class":az?a2+"IE":""
		});
		aN=a5("Overlay",af?"position:absolute":"").hide();
		aE=a5("Wrapper");
		aS=a5("Content").append(a0=a5(aq,"width:0; height:0; overflow:hidden"),at=a5("LoadingOverlay").add(a5("LoadingGraphic")),ad=a5("Title"),ae=a5("Current"),av=a5("Next"),aw=a5("Previous"),ay=a5("Slideshow").bind(aJ,aH),aD=a5("Close"));
		aE.append(a5().append(a5("TopLeft"),bc=a5("TopCenter"),a5("TopRight")),a5(a8,a).append(aj=a5("MiddleLeft"),aS,al=a5("MiddleRight")),a5(a8,a).append(a5("BottomLeft"),ak=a5("BottomCenter"),a5("BottomRight"))).children().children().css({
			"float":"left"
		});
		au=a5(a8,"position:absolute; width:9999px; visibility:hidden; display:none");
		a9("body").prepend(aN,a1.append(aE,au));
		aS.children().hover( function() {
			a9(this).addClass(b)
		}, function() {
			a9(this).removeClass(b)
		}).addClass(b);
		aC=bc.height()+ak.height()+aS.outerHeight(a6)-aS.height();
		aB=aj.width()+al.width()+aS.outerWidth(a6)-aS.width();
		aM=a0.outerHeight(a6);
		aL=a0.outerWidth(a6);
		a1.css({
			"padding-bottom":aC,
			"padding-right":aB
		}).hide();
		av.click(a7.next);
		aw.click(a7.prev);
		aD.click(a7.close);
		aS.children().removeClass(b);
		a9("."+ax).live("click", function(c) {
			if(!(c.button!==0&&typeof c.button!=="undefined"||c.ctrlKey||c.shiftKey||c.altKey)) {
				c.preventDefault();
				aF(this)
			}
		});
		aN.click( function() {
			ba.overlayClose&&a7.close()
		});
		a9(document).bind("keydown", function(c) {
			if(aQ&&ba.escKey&&c.keyCode===27) {
				c.preventDefault();
				a7.close()
			}
			if(aQ&&ba.arrowKey&&!aA&&a3[1]) {
				if(c.keyCode===37&&(a4||ba.loop)) {
					c.preventDefault();
					aw.click()
				} else {
					if(c.keyCode===39&&(a4<a3.length-1||ba.loop)) {
						c.preventDefault();
						av.click()
					}
				}
			}
		})
	};
	a7.remove= function() {
		a1.add(aN).remove();
		a9("."+ax).die("click").removeData(aT).removeClass(ax)
	};
	a7.position= function(j,l) {
		function a(b) {
			bc[0].style.width=ak[0].style.width=aS[0].style.width=b.style.width;
			at[0].style.height=at[1].style.height=aS[0].style.height=aj[0].style.height=al[0].style.height=b.style.height
		}

		var k,c=Math.max(document.documentElement.clientHeight-ba.h-aM-aC,0)/2+aX.scrollTop(),i=Math.max(aX.width()-ba.w-aL-aB,0)/2+aX.scrollLeft();
		k=a1.width()===ba.w+aL&&a1.height()===ba.h+aM?0:j;
		aE[0].style.width=aE[0].style.height="9999px";
		a1.dequeue().animate({
			width:ba.w+aL,
			height:ba.h+aM,
			top:c,
			left:i
		}, {
			duration:k,
			complete: function() {
				a(this);
				aA=a8;
				aE[0].style.width=ba.w+aL+aB+"px";
				aE[0].style.height=ba.h+aM+aC+"px";
				l&&l()
			},
			step: function() {
				a(this)
			}
		})
	};
	a7.resize= function(a) {
		if(aQ) {
			a=a|| {};
			if(a.width) {
				ba.w=aV(a.width,aY)-aL-aB
			}
			if(a.innerWidth) {
				ba.w=aV(a.innerWidth,aY)
			}
			a0.css({
				width:ba.w
			});
			if(a.height) {
				ba.h=aV(a.height,aW)-aM-aC
			}
			if(a.innerHeight) {
				ba.h=aV(a.innerHeight,aW)
			}
			if(!a.innerHeight&&!a.height) {
				a=a0.wrapInner("<div style='overflow:auto'></div>").children();
				ba.h=a.height();
				a.replaceWith(a.children())
			}
			a0.css({
				height:ba.h
			});
			a7.position(ba.transition===aR?0:ba.speed)
		}
	};
	a7.prep= function(a) {
		var g="hidden";
		function b(i) {
			var n,k,e,o,h=a3.length,j=ba.loop;
			a7.position(i, function() {
				function c() {
					az&&a1[0].style.removeAttribute("filter")
				}

				if(aQ) {
					az&&f&&a0.fadeIn(100);
					a0.show();
					aO(ac);
					ad.show().html(ba.title);
					if(h>1) {
						typeof ba.current==="string"&&ae.html(ba.current.replace(/\{current\}/,a4+1).replace(/\{total\}/,h)).show();
						av[j||a4<h-1?"show":"hide"]().html(ba.next);
						aw[j||a4?"show":"hide"]().html(ba.previous);
						n=a4?a3[a4-1]:a3[h-1];
						e=a4<h-1?a3[a4+1]:a3[0];
						ba.slideshow&&ay.show();
						if(ba.preloading) {
							o=a9.data(e,aT).href||e.href;
							k=a9.data(n,aT).href||n.href;
							o=a9.isFunction(o)?o.call(e):o;
							k=a9.isFunction(k)?k.call(n):k;
							if(ai(o)) {
								a9("<img/>")[0].src=o
							}
							if(ai(k)) {
								a9("<img/>")[0].src=k
							}
						}
					}
					at.hide();ba.transition==="fade"?a1.fadeTo(d,1, function() {
						c()
					}):c();
					aX.bind(aP+a2, function() {
						a7.position(0)
					});
					aO(ah,ba.onComplete)
				}
			})
		}

		if(aQ) {
			var f,d=ba.transition===aR?0:ba.speed;
			aX.unbind(aP+a2);
			a0.remove();
			a0=a5(aq).html(a);
			a0.hide().appendTo(au.show()).css({
				width: function() {
					ba.w=ba.w||a0.width();
					ba.w=ba.mw&&ba.mw<ba.w?ba.mw:ba.w;
					return ba.w
				}(),
				overflow:ba.scrolling?aU:g
			}).css({
				height: function() {
					ba.h=ba.h||a0.height();
					ba.h=ba.mh&&ba.mh<ba.h?ba.mh:ba.h;
					return ba.h
				}()
			}).prependTo(aS);
			au.hide();
			a9("#"+a2+"Photo").css({
				cssFloat:aR,
				marginLeft:aU,
				marginRight:aU
			});
			af&&a9("select").not(a1.find("select")).filter( function() {
				return this.style.visibility!==g
			}).css({
				visibility:g
			}).one(ap, function() {
				this.style.visibility="inherit"
			});ba.transition==="fade"?a1.fadeTo(d,0, function() {
				b(0)
			}):b(d)
		}
	};
	a7.load= function(a) {
		var f,e,b,d=a7.prep;
		aA=a6;
		aZ=a3[a4];
		a||(ba=aI(a9.extend({},a9.data(aZ,aT))));
		aO(am);
		aO(ag,ba.onLoad);
		ba.h=ba.height?aV(ba.height,aW)-aM-aC:ba.innerHeight&&aV(ba.innerHeight,aW);
		ba.w=ba.width?aV(ba.width,aY)-aL-aB:ba.innerWidth&&aV(ba.innerWidth,aY);
		ba.mw=ba.w;
		ba.mh=ba.h;
		if(ba.maxWidth) {
			ba.mw=aV(ba.maxWidth,aY)-aL-aB;
			ba.mw=ba.w&&ba.w<ba.mw?ba.w:ba.mw
		}
		if(ba.maxHeight) {
			ba.mh=aV(ba.maxHeight,aW)-aM-aC;
			ba.mh=ba.h&&ba.h<ba.mh?ba.h:ba.mh
		}
		f=ba.href;
		at.show();
		if(ba.inline) {
			a5().hide().insertBefore(a9(f)[0]).one(am, function() {
				a9(this).replaceWith(a0.children())
			});
			d(a9(f))
		} else {
			if(ba.iframe) {
				a1.one(ac, function() {
					var g=a9("<iframe frameborder='0' style='width:100%; height:100%; border:0; display:block'/>")[0];
					g.name=a2+ +new Date;
					g.src=ba.href;
					if(!ba.scrolling) {
						g.scrolling="no"
					}
					if(az) {
						g.allowtransparency="true"
					}
					a9(g).appendTo(a0).one(am, function() {
						g.src="//about:blank"
					})
				});
				d(" ")
			} else {
				if(ba.html) {
					d(ba.html)
				} else {
					if(ai(f)) {
						e=new Image;
						e.onload= function() {
							var c;
							e.onload=null;
							e.id=a2+"Photo";
							a9(e).css({
								border:aR,
								display:"block",
								cssFloat:"left"
							});
							if(ba.scalePhotos) {
								b= function() {
									e.height-=e.height*c;
									e.width-=e.width*c
								};
								if(ba.mw&&e.width>ba.mw) {
									c=(e.width-ba.mw)/e.width;
									b()
								}
								if(ba.mh&&e.height>ba.mh) {
									c=(e.height-ba.mh)/e.height;
									b()
								}
							}
							if(ba.h) {
								e.style.marginTop=Math.max(ba.h-e.height,0)/2+"px"
							}
							a3[1]&&(a4<a3.length-1||ba.loop)&&a9(e).css({
								cursor:"pointer"
							}).click(a7.next);
							if(az) {
								e.style.msInterpolationMode="bicubic"
							}
							setTimeout( function() {
								d(e)
							},1)
						};
						setTimeout( function() {
							e.src=f
						},1)
					} else {
						f&&au.load(f, function(h,i,g) {
							d(i==="error"?"Request unsuccessful: "+g.statusText:a9(this).children())
						})
					}
				}
			}
		}
	};
	a7.next= function() {
		if(!aA) {
			a4=a4<a3.length-1?a4+1:0;
			a7.load()
		}
	};
	a7.prev= function() {
		if(!aA) {
			a4=a4?a4-1:a3.length-1;
			a7.load()
		}
	};
	a7.close= function() {
		if(aQ&&!ao) {
			ao=a6;
			aQ=a8;
			aO(ap,ba.onCleanup);
			aX.unbind("."+a2+" ."+an);
			aN.fadeTo("fast",0);
			a1.stop().fadeTo("fast",0, function() {
				aO(am);
				a0.remove();
				a1.add(aN).css({
					opacity:1,
					cursor:aU
				}).hide();
				setTimeout( function() {
					ao=a8;
					aO(aa,ba.onClosed)
				},1)
			})
		}
	};
	a7.element= function() {
		return a9(aZ)
	};
	a7.settings=aG;
	a9(a7.init)
})(jQuery,this);
(function(a) {
	a(document).bind("cbox_complete", function() {
		a("#cboxOverlay").css("opacity",0.8);
		a("#cboxContent a[rel=close]").click( function() {
			a.colorbox.close()
		});
		if(a("#cboxLoadedContent").children().eq(0).hasClass("noClose")) {
			a.colorbox.noClose()
		}
	});
	a.colorbox.loading= function() {
		var b=a('<div class="loading"></div>').appendTo("#cboxContent").fadeIn("fast"),c=a("#cboxLoadedContent").fadeOut("fast");
		a("#cboxOverlay").css("opacity",0.8);
		a(document).one("cbox_load", function() {
			b.fadeOut("fast", function() {
				b.remove()
			});
			c.fadeIn("fast")
		})
	};
	a.colorbox.noClose= function() {
		a("#colorbox").addClass("noClose")
	}
})(jQuery);
(function(h) {
	var p=false,s="UndefinedTemplateError",o="TemplateCompilationError",m="TemplateExecutionError",d="[object Array]",g="[object String]",t="[object Function]",e=1,k="%",b=/^[^<]*(<[\w\W]+>)[^>]*$/,j=Object.prototype.toString;
	function a(l,c) {throw (h.extend(l,c),l)
	}

	function i(r) {
		var n=[];
		if(j.call(r)!==d) {
			return p
		}
		for(var q=0,c=r.length;q<c;q++) {
			n[q]=r[q].jqote_id
		}
		return n.length?n.sort().join(".").replace(/(\b\d+\b)\.(?:\1(\.|$))+/g,"$1$2"):p
	}

	function f(u,r) {
		var w,v=[],r=r||k,c=j.call(u);
		if(c===t) {
			return u.jqote_id?[u]:p
		}
		if(c!==d) {
			return[h.jqotec(u,r)]
		}
		if(c===d) {
			for(var q=0,n=u.length;q<n;q++) {
				return v.length?v:p
			}
		}
	}

	h.fn.extend({
		jqote: function(c,n) {
			var c=j.call(c)===d?c:[c],l="";
			this.each( function(r) {
				var u=h.jqotec(this,n);
				for(var q=0;q<c.length;q++) {
					l+=u.call(c[q],r,q,c,u)
				}
			});
			return l
		}
	});
	h.each({
		app:"append",
		pre:"prepend",
		sub:"html"
	}, function(c,l) {
		h.fn["jqote"+c]= function(x,y,q) {
			var w,v,u=h.jqote(x,y,q),n=!b.test(u)? function(r) {
				return h(document.createTextNode(r))
			}:h;
			if(!!(w=i(f(x)))) {
				v=new RegExp("(^|\\.)"+w.split(".").join("\\.(.*)?")+"(\\.|$)")
			}
			return this.each( function() {
				var r=n(u);
				h(this)[l](r);
				(r[0].nodeType===3?h(this):r).trigger("jqote."+c,[r,v])
			})
		}
	});
	h.extend({
		jqote: function(v,w,q) {
			var r="",q=q||k,u=f(v);
			if(u===p) {
				a(new Error("Empty or undefined template passed to $.jqote"), {
					type:s
				})
			}
			w=j.call(w)!==d?[w]:w;
			for(var n=0,c=u.length;n<c;n++) {
				for(var l=0;l<w.length;l++) {
					r+=u[n].call(w[l],n,l,w,u[n])
				}
			}
			return r
		},
		jqotec: function(B,C) {
			var q,u,w,C=C||k,v=j.call(B);
			if(v===g&&b.test(B)) {
				u=w=B;
				if(q=h.jqotecache[B]) {
					return q
				}
			} else {
				u=v===g||B.nodeType?h(B):B instanceof jQuery?B:null;
				if(!u[0]||!(w=u[0].innerHTML)&&!(w=u.text())) {
					a(new Error("Empty or undefined template passed to $.jqotec"), {
						type:s
					})
				}
				if(q=h.jqotecache[h.data(u[0],"jqote_id")]) {
					return q
				}
			}
			var D="",n,A=w.replace(/\s*<!\[CDATA\[\s*|\s*\]\]>\s*|[\r\n\t]/g,"").split("<"+C).join(C+">\x1b").split(C+">");
			for(var c=0,l=A.length;c<l;c++) {
				D+=A[c].charAt(0)!=="\x1b"?"out+='"+A[c].replace(/(\\|["'])/g,"\\$1")+"'":(A[c].charAt(1)==="="?";out+=("+A[c].substr(2)+");":(A[c].charAt(1)==="!"?";out+=$.jqotenc(("+A[c].substr(2)+"));":";"+A[c].substr(1)))
			}
			D="try{"+('var out="";'+D+";return out;").split("out+='';").join("").split('var out="";out+=').join("var out=")+'}catch(e){e.type="'+m+'";e.args=arguments;e.template=arguments.callee.toString();throw e;}';
			try {var r=new Function("i, j, data, fn",D)
			} catch(u) {
				a(u, {
					type:o
				})
			}
			n=u instanceof jQuery?h.data(u[0],"jqote_id",e):u;
			return h.jqotecache[n]=(r.jqote_id=e++,r)
		},
		jqotefn: function(n) {
			var l=j.call(n),c=l===g&&b.test(n)?n:h.data(h(n)[0],"jqote_id");
			return h.jqotecache[c]||p
		},
		jqotetag: function(c) {
			if(j.call(c)===g) {
				k=c
			}
		},
		jqotenc: function(c) {
			return c.toString().replace(/&(?!\w+;)/g,"&#38;").split("<").join("&#60;").split(">").join("&#62;").split('"').join("&#34;").split("'").join("&#39;")
		},
		jqotecache: {}
	});
	h.event.special.jqote= {
		add: function(q) {
			var r,c=q.handler,l=!q.data?[]:j.call(q.data)!==d?[q.data]:q.data;
			if(!q.namespace) {
				q.namespace="app.pre.sub"
			}
			if(!l.length||!(r=i(f(l)))) {
				return
			}
			q.handler= function(v,n,u) {
				return !u||u.test(r)?c.apply(this,[v,n]):null
			}
		}
	}
})(jQuery);
(function(a) {
	FlagWidget= function(c,b) {
		if(c) {
			this.init(c,b)
		}
	};
	a.extend(FlagWidget.prototype, {
		name:"flagWidget",
		success: function() {
		},
		init: function(c,b) {
			this.element=a(c);
			a.data(c,this.name,this);
			var d=this;
			this.element.show();
			this.element.children(".click-target").click( function() {
				d.togglePanel();
				return false
			});
			var e= function(f) {
				f.data.hidePanel()
			};
			this.element.hover( function() {
				jQuery(document).unbind("click",e)
			}, function() {
				jQuery(document).bind("click",d,e)
			});
			this.element.find("ul li a").click( function() {
				d.itemClick(this);
				return false
			});
			if(b&&b.success) {
				this.success=b.success
			}
			this.element.parent().submit( function() {
				var g=jQuery(this);
				if(g.find('input[name="user_flag[name]"]').val()==="Other") {
					var f=g.find('input[name="user_flag[other_note]"]').val();
					if(f===undefined||jQuery.trim(f)==="") {
						return false
					}
				}
				d.hidePanel();
				d.element.addClass("spinner");
				jQuery.post(g.attr("action"),g.serialize(), function(h) {
					d.element.children(".click-target").unbind("click");
					d.element.removeClass("spinner");
					d.element.addClass("success").delay(2000).fadeOut(1000);
					d.success()
				});
				return false
			})
		},
		showPanel: function() {
			if(!this.element.hasClass("expanded")) {
				this.element.addClass("expanded")
			}
		},
		hidePanel: function() {
			this.element.removeClass("expanded");
			this.element.find("li.other.clicked").removeClass("clicked")
		},
		togglePanel: function() {
			if(this.element.hasClass("expanded")) {
				this.hidePanel()
			} else {
				this.showPanel()
			}
		},
		itemClick: function(e) {
			var d=jQuery(e);
			var c=this.element.parent();
			var f=d.parent();
			c.find('input[name="user_flag[name]"]').val(d.data("reason-id"));
			if(f.hasClass("other")) {
				var b=f.find("input");
				b.val("");
				f.addClass("clicked")
			} else {
				f.find("input").val("");
				c.submit()
			}
		}
	});
	a.fn.flagWidget= function(c) {
		var b=a.makeArray(arguments),d=b.slice(1);
		return this.each( function() {
			var e=a.data(this,"flagWidget");
			if(e) {
				if(typeof c==="string") {
					e[c].apply(e,d)
				} else {
					if(e.update) {
						e.update.apply(e,b)
					}
				}
			} else {new FlagWidget(this,c)
			}
		})
	};
	a.fn.clickStar= function(d) {
		var c=a("#star_count");
		var b=parseInt(c.html());
		return this.each( function() {
			var e=a(this).data("hosting_id");
			if(e==undefined||e==null) {
				a(this).data("hosting_id",parseInt(a(this).attr("id").substring(5)))
			} else {
				return
			}
			if(a.inArray(a(this).data("hosting_id"),Airbnb.Bookmarks.starredIds)!=-1) {
				a(this).find("div.star_icon").addClass("starred")
			}
			a(this).click( function() {
				if(!Airbnb.Utils.isUserLoggedIn) {
					if(confirm("You must create a free account or login to use this feature. Continue?")) {
						window.location=base_url+"signup_login"
					}
					return
				}
				var h=a(this).find("div.star_icon");
				var f=h.hasClass("starred");
				if(f) {
					var g=a.inArray(a(this).data("hosting_id"),Airbnb.Bookmarks.starredIds);
					if(g!=-1) {
						Airbnb.Bookmarks.starredIds.splice(g,1)
					}
					b--;
					h.removeClass("starred")
				} else {
					Airbnb.Bookmarks.starredIds.push(a(this).data("hosting_id"));
					b++;
					h.addClass("starred")
				}
				c.fadeOut(100, function() {
					c.html(b);
					c.fadeIn(300, function() {
						var i=jQuery("#star-indicator");
						if(i.is(":visible")&&b==0) {
							i.fadeOut(500)
						} else {
							if(!i.is(":visible")&&b>0) {
								i.fadeIn(500)
							}
						}
					})
				});
				jQuery.ajax({
					url:base_url+"favorites/"+a(this).data("hosting_id")+"/star",
					type:f?"DELETE":"POST",
					dataType:"json",
					async:true,
					context:this,
					success: function(i) {
						var j=a(this).find("div.star_icon");
						if(i.result=="login") {
							j.removeClass("starred");
							if(confirm("You must create a free account to use this feature. Continue?")) {
								window.location=i.redirect_to
							}
						} else {
							if(i.result=="deleted"&&j.hasClass("starred")) {
								j.removeClass("starred")
							} else {
								if(i.result=="created"&&!j.hasClass("starred")) {
									j.addClass("starred")
								}
							}
						}
					}
				});
				f=!f;
				if(d) {
					d(this,f)
				}
				return false
			})
		})
	}
})(jQuery);
(function(a,b) {
	var d=[],c="38,38,40,40,37,39,37,39,66,65";
	b(window).bind("keydown", function(f) {
		d.push(f.keyCode);
		if(d.toString().indexOf(c)>=0) {
			d=[];
			b(window).trigger("konami")
		}
	});
	a.EasterEgg= function() {
		var m=20,g=0,h=b("#logo img"),r=b(window).height(),f=b(window).width(),o,q,j,n,l;
		$container=b("<div/>").attr("id","easter-egg-container").prependTo("body").css({
			overflow:"hidden",
			width:f+"px",
			height:r+"px",
			position:"absolute",
			top:0,
			left:0,
			"z-index":99999
		});
		for(var k=0;k<m;k++) {
			l=Math.random()*5000;
			q= function() {
				j=Math.random()+0.5;
				n=5000/j;
				o=h.clone().addClass("easter-egg").appendTo("#easter-egg-container").css({
					position:"absolute",
					top:r*Math.random()+"px",
					left:"-200px",
					"-webkit-transform":"scale("+j+")",
					"-moz-transform":"scale("+j+")"
				});
				e(o,n)
			};
			setTimeout(q,l)
		}
		function e(i,s) {
			i.animate({
				left:"+"+(f+100)+"px"
			},s, function() {
				p()
			})
		}

		function p() {
			g++;
			if(g===m) {
				$container.remove()
			}
		}

	};
	b(window).bind("konami",a.EasterEgg)
})(Airbnb,jQuery);
