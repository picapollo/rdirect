var map, geocoder, marker, center;

var AutocompleteCache = {
    currentSuggestions: null
};

/* Mimic google.maps.LatLng
 */
function GeocoderLatLng(lat, lng) {
	this.latVal = lat;
	this.lngVal = lng;
}

GeocoderLatLng.prototype.lat = function() {
	return this.latVal;
};

GeocoderLatLng.prototype.lng = function() {
	return this.lngVal;
};

var PostRoom = {
	errors: [],
	fieldsToClearOnSubmit: [],
	localized_hiw_video_code: 'SaOFuW011G8',
	hostingLat: 0.0,
	hostingLng: 0.0,
	useAlternateMap: false,

	// This is where center of map will start, can be overridden on page load
	defaultLat: 20.00,
	defaultLng: -32.00,
	mapZoomLevel: 10, //todo - tighten this up if location is specified
	mapInitialized: false,
	recentResult: null,
	lastCurrency: '',
	ADDRESS_TYPES: {
		exact: [
			'street_address',
			'subpremise',
			'premise'
		],

		// When we get these, allow the user to place their own point on the map
		pinpointable: [
			'route', //route ~== a street with no number
			'locality',
			'sublocality',
			'postal_code',
			'administrative_area_level_2',
			'administrative_area_level_3',
			'neighborhood'],

		// Addresses allowed based on bounding box size
		boundable: ['natural_feature']
	},

	init: function(opts) {
		var $directionsField = $("#hosting_directions");
		var $userDefinedLoc = $("#address_user_defined_location");
		$(".post_room_step2, #submit-wrapper").hide();

		Airbnb.Utils.initHowItWorksLightbox(
			'#how_it_works_vid_screenshot', PostRoom.localized_hiw_video_code);

		$('#post_room_submit_button').click(function(e) {
			$('#new_room_form').submit();
			e.preventDefault();
		});

		$('#facebook_share').click(function(e) {
			if (PostRoom.validateSubmit()) {
				var $sw = $(".connect-p").css("visibility", "hidden"),
				$fl = $(".facebook_loading").show();
				FB.login(function(response) {
					if (response.session) {
						$.post("/users/authenticate", function() {
							$('#new_room_form').submit();
						});
					} else {
						$sw.css("visibility", "visible");
						$fl.hide();
					}
				},
				{perms: "email,user_birthday,user_likes,user_education_history," +
					"user_hometown,user_interests,user_activities,user_location"});
			}
			e.preventDefault();
		});

		$('#new_room_form').submit(function() {
			return PostRoom.validateSubmit();
		});

		$('input.validation_error, textarea.validation_error').live(Airbnb.Utils.keyPressEventName, function(e) {
			$(e.currentTarget).removeClass('validation_error');
		});

		Airbnb.Utils.setInnerText(PostRoom.fieldsToClearOnSubmit);
		PostRoom.initMap();
		PostRoom.lastCurrency = $('#hosting_native_currency').val();
		PostRoom.interceptEnterOnLocationBar();

		// Only allow 35 characters
		$('#hosting_name').bind(Airbnb.Utils.keyPressEventName, function(e) {
			Airbnb.Utils.textCounter($("#hosting_name"), $("#letter_count"), 35);
		});

		$('#hosting_room_type').bind('change', function(e) {
			PostRoom.getPricingRecommendation(); 
		});

		$('#hosting_native_currency').bind('change', function(e) {
			var new_currency= $("#hosting_native_currency").val();
			var price_field = $("#hosting_price_native");

			if(!isNaN(parseInt(price_field.val(), 10))) {
				price_field.val(Airbnb.Currency.convert(price_field.val(), PostRoom.lastCurrency, new_currency, true));
			}

			$("#price_suggestion_low_text").html(Airbnb.Currency.convert(
				$("#price_suggestion_low_text").html(), PostRoom.lastCurrency, new_currency, true));
			$("#price_suggestion_high_text").html(Airbnb.Currency.convert(
				$("#price_suggestion_high_text").html(), PostRoom.lastCurrency, new_currency, true));
			$(".currency_symbol").html(Airbnb.Currency.getSymbolForCurrency(new_currency));
			PostRoom.lastCurrency = new_currency; 
		});

		PostRoom.enableAutocomplete();
		geocoder = new google.maps.Geocoder(PostRoom.hostingLat, PostRoom.hostingLng);

		if (opts.location_search) {
			$('#location_search').val(opts.location_search);
			PostRoom.selectFirst();
		}

		$("#exact_address_1").change(function() {
			if ($(this).is(":checked")) {
				$directionsField.parent().hide();
				$directionsField.attr("disabled", "disabled");
				$userDefinedLoc.attr("disabled", "disabled");
			}
		});

		$("#exact_address_2").change(function() {
			if ($(this).is(":checked")) {
				$directionsField.parent().show();
				$directionsField.removeAttr("disabled");
				$userDefinedLoc.removeAttr("disabled");
			}
		});

		function checkFlatMonthly() {
			var startDate, endDate;
			var dateFormat = $.datepicker._defaults.dateFormat;

			try {
				startDate = $.datepicker.parseDate(dateFormat, $("#sublet_checkin").val());
				endDate = $.datepicker.parseDate(dateFormat, $("#sublet_checkout").val());
			} catch(e) {}

			if (startDate && endDate) {
				if ((endDate - startDate) > PostRoom.SUBLET_CROSSOVER_MS) {
					$("#per-month-span").show();
					$("#flat-rate-span").hide();
				} else {
					$("#per-month-span").hide();
					$("#flat-rate-span").show();
				}
			}
		}

		$("#new_room_form").airbnbInputDateSpan({
			checkin: "#sublet_checkin",
			checkout: "#sublet_checkout",
			onCheckinClose: checkFlatMonthly,
			onCheckoutClose: checkFlatMonthly
		});

		$("#is_sublet").change(function() {
			if ($(this).is(":checked")) {
				$("#per-night-span, #price_suggestion").hide();
				$("#sublet-rates, #sublet_dates").show();
			} else {
				$("#per-night-span, #price_suggestion").show();
				$("#sublet-rates, #sublet_dates").hide();
			}
		}).change();
	},

	initSublets: function(location) {
		if (location && location.address_components) {
			var components = location.address_components;
			var c, i, len;
			for (i = 0, len = components.length; i < len; i++) {
				c = components[i];
				if (c.types[0] === "country" && ($.inArray(c.short_name, PostRoom.SUBLET_COUNTRIES) >= 0)) {
					$(".sublets").show();
					return;
				}
			}
		}
		$(".sublets").hide();
	},

	initMap: function() {
		if (PostRoom.mapInitialized === false) {
			$('#map_container').show();
			center = new google.maps.LatLng(PostRoom.defaultLat, PostRoom.defaultLng);
			map = new google.maps.Map(document.getElementById("map_canvas"), {
				zoom: 1,
				scrollwheel: false,
				center: center,
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				mapTypeControl: false
			});

			PostRoom.mapInitialized = true;
		}
	},

	placeMarker: function(location) {
		PostRoom.clearMarker();
		marker = new google.maps.Marker({
			position: location,
			map: map,
			icon: new google.maps.MarkerImage(
				"/images/guidebook/pin_home.png",
				null,
				null,
				new google.maps.Point(14, 32))
		});
	},

	clearMarker: function() {
		if (marker) {
			google.maps.event.clearInstanceListeners(marker);
			marker.setMap(null);
		}
	},

	matchesResultType: function(types, source_types) {
		var matches = $.grep(types, function(type) { 
			return ($.inArray(type, source_types) >= 0);
		});

		return (matches.length > 0);
	},

    allowPinpoint: function(result) {
		var MAX_SPAN_AREA = 0.05;

		if (PostRoom.matchesResultType(result.types, PostRoom.ADDRESS_TYPES.boundable) &&
				result.geometry.bounds &&
				result.address_components.length > 1) {
			span = result.geometry.bounds.toSpan();

			// Max span area (GMap terminology) of 0.05 to prevent large
			// features like lakes and oceans from being valid
			return (span.lat() * span.lng()) <= MAX_SPAN_AREA;
		} else {
			return PostRoom.matchesResultType(result.types, PostRoom.ADDRESS_TYPES.pinpointable);
		}
	},

	resetLocation: function() {
		PostRoom.recentResult = null;
		PostRoom.clearMarker();
		PostRoom.hideErrors();
		$('#address_lat, #address_lng, #address_formatted_address_native, #hosting_directions').val('');
		$("#address_apt").val('').blur();
		$('#formatted_address').html('...');
		$("#exact_address_1").attr("checked", "checked").change();
		$("#is_sublet").removeAttr("checked").change();
		Drag.reset();
		$("#step1_extras").hide();
	},

	displayLocationResult: function(result) {
		var geometry, layer, marker, pos;
		var $wayTooVague = $('#way_too_vague').fadeOut();

		PostRoom.resetLocation();

		var newCenter = new google.maps.LatLng(
			result.geometry.location.lat(),
			result.geometry.location.lng());
		map.setCenter(newCenter);

		if (PostRoom.matchesResultType(result.types, PostRoom.ADDRESS_TYPES.boundable)) {
			map.fitBounds(result.geometry.bounds);
		} else if (PostRoom.matchesResultType(result.types, PostRoom.ADDRESS_TYPES.pinpointable)) {
			map.setZoom(12);
		} else {
			map.setZoom(4);
		}

		if(!PostRoom.matchesResultType(result.types, PostRoom.ADDRESS_TYPES.exact)) {
			if (PostRoom.altMapContainer) {PostRoom.altMapContainer.hide();}
			$("#map_canvas").children().first().show();
			if (PostRoom.allowPinpoint(result) && !PostRoom.useAlternateMap) {
				Drag.initialize();
			} else {
				$wayTooVague.fadeIn();
			}
		} else {
			PostRoom.recentResult = result;
			PostRoom.initMap();
			geometry = result.geometry;

			setTimeout(function() {
				jQuery('#address_apt').show().val('').blur();
			}, 1);

			var formatted_address_with_line_breaks = '';
			try {
				formatted_address_with_line_breaks = result.formatted_address.split(',').join('<br />');
			} catch (error) {}

			PostRoom.initSublets(result);
			$('#step1_extras').show();
			$('#formatted_address').html(formatted_address_with_line_breaks);
			$('#selected_address, #step1_extras, #contact_info_section').show();
			$('#address_lat').val(geometry.location.lat());
			$('#address_lng').val(geometry.location.lng());
			$('#address_formatted_address_native').val(result.formatted_address);
			$('#location_search').removeClass('validation_error');
			$(".post_room_step2, #submit-wrapper").show();
			PostRoom.updatePhoneCountry(result);

			if (PostRoom.useAlternateMap) {
				$("#map_canvas").children().first().hide();

				if (!PostRoom.altMap) {
					PostRoom.altMap = new Map(308, 308);
					PostRoom.altMapContainer = $(document.createElement("div"));
					$("#map_canvas").append(PostRoom.altMapContainer);
					PostRoom.altMap.writeMapToContainer(PostRoom.altMapContainer[0]);
				}

 				PostRoom.altMapContainer.show();
				layer = PostRoom.altMap.getLayersManager().createLocalVectorLayer("");
				layer.enableAutoRedraw();
				pos = new LatLong(geometry.location.lat(), geometry.location.lng());
				var polyLineStylePen = new LineStyle(4,'fdb2f2',80);
				var polyLineStyleFill = new LineStyle(0,'ffd7fc',40);
				var circle = new Circle('circleId', pos, 100, polyLineStylePen, polyLineStyleFill, '', 'Your listing', true, false);
				layer.addShape(circle);
				layer.redraw();
				PostRoom.altMap.setCenterPosition(pos, -3);
			} else {
				if (PostRoom.altMapContainer) {PostRoom.altMapContainer.hide();}
				$("#map_canvas").children().first().show();
				PostRoom.placeMarker(geometry.location);
				map.fitBounds(geometry.viewport);
			}
		}
    },

	selectMenuItem: function(menuItem) {
		var aLink = $(menuItem).children();
		var label = $(aLink[0]).html();

		$.each(AutocompleteCache.currentSuggestions || [], function(index, el) {
			if (el.label == label) {
				var ui = el;
				var $lsearch = $("#location_search");
				$lsearch.trigger('autocompleteselect', {item:ui});
				$lsearch.autocomplete('close');
				AutocompleteCache.currentSuggestions = null;
				return true;
			}
		});
	},

	selectFirst: function() {
		var $lsearch = $("#location_search");
		$lsearch.autocomplete('search');
		setTimeout(function() {
			$lsearch.autocomplete("close");
		}, 1300); //need to wait for autocomplete to work
	},

    // Autocomplete for location search
    enableAutocomplete : function() {
		var $addressList = $("#didyoumean-addresses");
		var closedBySelect = false;
		var $didyoumean = $("#didyoumean");
		var $locationSearch = $('#location_search');
		var locationSearchHasFocus = false;

		$('.ui-autocomplete li.ui-menu-item').live('click', function(){
			PostRoom.selectMenuItem(this);
		});

		$locationSearch.focus(function() {
			locationSearchHasFocus = true;
		});

		$locationSearch.blur(function() {
			locationSearchHasFocus = false;
		});

		$locationSearch.autocomplete({
			minLength: 4,
			delay: 300,
			source: function(request, response) {
				var reqObj = {address: request.term};
				geocoder.geocode(reqObj, function(results, status) {
					var first, suggestions;

					if (status === google.maps.GeocoderStatus.OK) {
						first = results.length > 0 && results[0];
						if (first && PostRoom.matchesResultType(first.types, ["country", "locality"]) &&
								first.address_components[0].long_name === "Israel" ||
								(first.address_components.length > 1 && first.address_components[1].long_name === "Israel")) {
							$.get("/geocoder/atlas_ct", reqObj, function(atlasResults, atlasStatus) {
								if (atlasResults.status === google.maps.GeocoderStatus.OK) {
									suggestions = jQuery.map(atlasResults.results, function(res) {
										var loc = res.geometry.location;
										res.geometry.location = new GeocoderLatLng(
											loc.lat, loc.lng
										);
										return {'label': res.formatted_address, 'value': res};
									});

									AutocompleteCache.currentSuggestions = jQuery.map(atlasResults.results, function(res) {
										return {'label': res.formatted_address, 'value': res};
									});

									PostRoom.useAlternateMap = true;
									response(suggestions);

									if (!locationSearchHasFocus) {
										$locationSearch.autocomplete("close");
									}
								}
							});
						} else {
							suggestions = jQuery.map(results, function(res) {
								return {'label': res.formatted_address, 'value': res};
							});

							AutocompleteCache.currentSuggestions = jQuery.map(results, function(res) {
								return {'label': res.formatted_address, 'value': res};
							});
							PostRoom.useAlternateMap = false;
							response(suggestions);

							if (!locationSearchHasFocus) {
								$locationSearch.autocomplete("close");
							}
						}
					}
				});
			},
			focus: function(event, ui) {
				// Don't do anything on focus
				return false;
			}
		});

		$locationSearch.bind("autocompleteclose", function(event, ui) {
			var address, cache, i, li;
			function fakeSelect(item) {
				$locationSearch.trigger("autocompleteselect",
					{item: item, fakeSelect: true});
				AutocompleteCache.currentSuggestions = null;
			}

			if (!closedBySelect && $locationSearch.val()) {
				cache = AutocompleteCache.currentSuggestions;
				if (cache) {
					fakeSelect(cache[0]);
				}
			}
			closedBySelect = false;
		});

		$locationSearch.bind("autocompleteselect", function(event, ui) {
			if (!ui.fakeSelect) {
				closedBySelect = true;
			}

			$didyoumean.hide();
			$addressList.undelegate("click");
			$locationSearch.val(ui.item.label);
			$('#address_step2').show();
			PostRoom.displayLocationResult(ui.item.value);
			if (!PostRoom.useAlternateMap) {
				PostRoom.getPricingRecommendation();
			}
			return false;
		});
    },

	interceptEnterOnLocationBar: function() {
		$('#location_search').bind(Airbnb.Utils.keyPressEventName, function(e) {
			var code = e.keyCode || e.which;
			if (code === $.ui.keyCode.ENTER) {
				$(this).autocomplete("close");
			}
		});
	},

	hasErrors: function() {
		return (PostRoom.errors.length > 0);
	},

	addError: function(errorTitle, errorText, elementIdToHighlight) {
		PostRoom.errors.push([errorTitle, errorText, elementIdToHighlight]);
		return true;
	},

	// Warning - this function will empty errors 
	showErrors: function() {
		PostRoom.hideErrors();
		var error;
		var errorContainer = $('#error_summary');
		var errorUl = errorContainer.children("ul");

		if (PostRoom.hasErrors()) {
			while (PostRoom.errors.length > 0) {
				error = PostRoom.errors.shift();
				errorUl.append(['<li class="bad"><b>', error[0],'</b><br/>', error[1], '</li>'].join(''));
				$('#' + error[2]).addClass('validation_error');
			}

			errorContainer.show();
			return true;
		} else {
			return false;
		}
	},

	hideErrors: function() {
		$('.validation_error').removeClass('validation_error');
		$('#error_summary ul').empty().parent().hide();
	},

	getPricingRecommendation: function() {
		var formatted_address = $("#address_formatted_address_native").val();
        
		if (!formatted_address || formatted_address === "") {
			return false;
		}

		$.getJSON(Urls.ajax_worth,
			{location: formatted_address, room_type: $("#hosting_room_type").val()},
			function(data) {
				var new_currency = $("#hosting_native_currency").val();
				var average = data.avg * 0.8; 
				var price_suggestion_low = Airbnb.Currency.convert(
					Math.max(Math.round(average - data.stddev / 4), 10), 'USD', new_currency, true);
				var price_suggestion_high = Airbnb.Currency.convert(
					Math.max(Math.round(average + data.stddev / 4), 10), 'USD', new_currency, true);

				$("#price_suggestion_low").val(price_suggestion_low);
				$("#price_suggestion_high").val(price_suggestion_high);
				$("#price_suggestion_low_text").html(price_suggestion_low);
				$("#price_suggestion_high_text").html(price_suggestion_high);
				$(".currency_symbol").html(Airbnb.Currency.getSymbolForCurrency(new_currency));
				$('#price_suggestion').show();
				$('#price').hide();
			}
		);
	},

	validateSubmit: function() {
		ajax_log('signup_funnel', 'rooms.create.click_save');
		var subletStartDate, subletEndDate,
			hasValidDates, isValidDate, priceNative,
			dateFormat;

		$('.validation_error').removeClass('validation_error');
		if (PostRoom.recentResult === null) { 
			PostRoom.addError(Translations.address, Translations.address_error, 'location_search');
		} else if (!$("#step1_extras").is(":visible")) {
			PostRoom.addError("Address", Translations.not_so_vague_3, "map_canvas");
		}

		var email = $('#hosting_email');
		var phone = $('#hosting_phone');

		if (email.is(':visible') && !Airbnb.StringValidator.validate('email', email.val())) {
			PostRoom.addError(Translations.email_address, Translations.email_address_error, 'hosting_email');
		}

		if ($('#hosting_name').val() === '') { 
			PostRoom.addError(Translations.title, Translations.room_name_error, 'hosting_name');
		}

		if ($('#hosting_description').val() === '') { 
			PostRoom.addError(Translations.description, Translations.description_error, 'hosting_description');
		}

		priceNative = $("#hosting_price_native").val();
		if (priceNative === '') { 
			PostRoom.addError(Translations.price, Translations.price_error, 'hosting_price_native');
		} else if (parseInt(priceNative, 10) < 10) {
			PostRoom.addError(Translations.price, Translations.priceTooSmall_error, "hosting_price_native");
		}

		if ($("#sublet_dates").is(":visible")) {
			dateFormat = $.datepicker._defaults.dateFormat;
			hasValidDates = true;

			try {
				subletStartDate = $.datepicker.parseDate(dateFormat, $("#sublet_checkin").val());
				subletEndDate = $.datepicker.parseDate(dateFormat, $("#sublet_checkout").val());
			} catch(e) {}

			isValidDate = function isValidDate(d) {
				if (Object.prototype.toString.call(d) !== "[object Date]") {
					return false;
				}
				return !isNaN(d.getTime());
			};

			if (!isValidDate(subletStartDate)) {
				PostRoom.addError("Sublet start date", Translations.sublet_real_start, "sublet_checkin");
				hasValidDates = false;
			}

			if (!isValidDate(subletEndDate)) {
				PostRoom.addError("Sublet end date", Translations.sublet_real_end, "sublet_checkout");
				hasValidDates = false;
			}

			if (hasValidDates) {
				if (subletStartDate >= subletEndDate) {
					PostRoom.addError("Sublet end date", Translations.sublet_start_before, "sublet_checkout");
				} else if ((subletEndDate.getTime() - subletStartDate.getTime()) < (PostRoom.MINIMUM_SUBLET_STAY_MS)) {
					PostRoom.addError("Sublet end date", Translations.sublet_min_nights, "sublet_checkout");
				}
			}
		}

		if (PostRoom.hasErrors()) {
			PostRoom.showErrors();
			ajax_log('signup_funnel', 'rooms.create.error_submit');
			return false;
		} else {
			$('#hosting_submit').attr('disabled', 'disabled').css('cursor','progress');
			PostRoom.hideErrors();
			Airbnb.Utils.clearInnerText(PostRoom.fieldsToClearOnSubmit);
			ajax_log('signup_funnel', 'rooms.create.successful_submit');
			return true;
		}
	},
	
	updatePhoneCountry: function(result) {
		if (result && result.address_components) {
			var matches = $.grep(result.address_components, function(component) { 
				return ($.inArray("country", component.types) >= 0);
			});
			if (matches && matches[0]) {
				$('#hosting_phone_country').val(matches[0].short_name);
			}
		}
	}
};

var Drag = {
	geocoder: null,
	marker: null,
	latLng: null,
	initialDrag: true,

    geocodePosition: function(pos) {
      geocoder.geocode({
        latLng: pos
      }, function(responses) {
        if (responses && responses.length > 0) {
          PostRoom.recentResult = responses[0];
          Drag.updateMarkerAddress(responses[0]);
        } else {
          PostRoom.recentResult = null;
          Drag.updateMarkerAddress();
        }
      });
    },

    updateMarkerPosition: function(latLng) {
        $('#address_lat').val(latLng.lat());
        $('#address_lng').val(latLng.lng());
    },

    updateMarkerAddress: function(result, fade) {
		var str = (typeof result === 'undefined') ? 'Cannot determine address at this location.' : result.formatted_address;
		var applyFade = ((typeof fade === 'undefined') ? false : fade);
		$('#address_formatted_address_native').val(str);

		if (applyFade === true) {
			Drag.fadeOutMarkerAddress();
		} else {
			Drag.fadeInMarkerAddress();
			formatted_address_with_line_breaks = str.split(',').join('<br />');
			$('#formatted_address').html(formatted_address_with_line_breaks);
		}

		if (Drag.initialDrag) {
			Drag.initialDrag = false;
		} else {
			PostRoom.hideErrors();
			PostRoom.initSublets(PostRoom.recentResult);
			$('#location_search').val(result.formatted_address);
			$('#exact_address_prompt').show();
			$('#step1_extras').show();
			$('#contact_info_section').show();
			$(".post_room_step2, #submit-wrapper").show();
	        PostRoom.updatePhoneCountry(result);
		}
    },

	fadeOutMarkerAddress: function() {
		$('#formatted_address').fadeTo(0, 0.5);
	},

	fadeInMarkerAddress: function() {
		$('#formatted_address').fadeTo(0, 1.0);
	},

	initialize: function() {
		Drag.initialDrag = true;
		$('#step1_extras').hide();
		Drag.geocoder = new google.maps.Geocoder();
		Drag.latLng = map.getCenter();
		Drag.infoWindow = new google.maps.InfoWindow({
			content: Translations.not_so_vague
		});

		PostRoom.clearMarker();
		marker = Drag.marker = new google.maps.Marker({
			position: Drag.latLng,
			title: Translations.your_listing,
			map: map,
			icon: new google.maps.MarkerImage(
				"/images/guidebook/pin_home.png",
				new google.maps.Size(48, 36),
				null,
				new google.maps.Point(14, 32)),
			draggable: true
		});

		// Update current position info.
		Drag.updateMarkerPosition(Drag.latLng);
		Drag.geocodePosition(Drag.latLng);
		map.setZoom(15);
		Drag.infoWindow.open(map, Drag.marker);

		// Add dragging event listeners.
		google.maps.event.addListener(Drag.marker, 'dragstart', function() {
			Drag.fadeOutMarkerAddress();
			Drag.infoWindow.close();
			Drag.infoWindow.setContent("<em>" + Translations.not_so_vague_2 + "</em>");
		});

		google.maps.event.addListener(Drag.marker, 'dragend', function() {
			Drag.infoWindow.open(map, Drag.marker);
			Drag.updateMarkerPosition(Drag.marker.getPosition());
			Drag.geocodePosition(Drag.marker.getPosition());
		});
	},

	reset: function() {
		$('#exact_address_prompt').hide();
		PostRoom.clearMarker();
		if (Drag.infoWindow) {
			Drag.infoWindow.close();
		}
		if (Drag.marker) {
			google.maps.event.clearInstanceListeners(Drag.marker);
			Drag.marker.setMap(null);
			Drag.marker = null;
		}
	}
};

jQuery(document).ready(function() {
  $("#post_a_room_header a.learn_more").click(function(e) {
    ajax_log('signup_funnel', 'rooms.create.click_learn_more');
  });

  // Basic Info
  bind_logging("#hosting_email", 'change',
    'signup_funnel', {prefix: 'rooms.create'});
  bind_logging("#hosting_phone", 'change',
    'signup_funnel', {prefix: 'rooms.create'});

  // Details
  bind_logging("#hosting_property_type_id", 'change',
    'signup_funnel', {prefix: 'rooms.create'});
  bind_logging("#hosting_property_type_id", 'change',
    'signup_funnel', {prefix: 'rooms.create'});
  bind_logging("#hosting_person_capacity", 'change',
    'signup_funnel', {prefix: 'rooms.create'});
  bind_logging("#hosting_room_type", 'change',
    'signup_funnel', {prefix: 'rooms.create'});
  bind_logging("#hosting_bedrooms", 'change',
    'signup_funnel', {prefix: 'rooms.create'});
  bind_logging("#hosting_name", 'change',
    'signup_funnel', {prefix: 'rooms.create'});
  bind_logging("#hosting_description", 'change',
    'signup_funnel', {prefix: 'rooms.create'});
  bind_logging("#is_sublet", 'click',
    'signup_funnel', {prefix: 'rooms.create'});
  bind_logging("#sublet_checkin", 'change',
    'signup_funnel', {prefix: 'rooms.create'});
  bind_logging("#sublet_checkout", 'change',
    'signup_funnel', {prefix: 'rooms.create'});
  bind_logging("#hosting_native_currency", 'change',
    'signup_funnel', {prefix: 'rooms.create'});
  bind_logging("#hosting_price_native", 'change',
    'signup_funnel', {prefix: 'rooms.create'});
});
