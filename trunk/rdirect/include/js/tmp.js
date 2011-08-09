var AirbnbSearch = {
	enableAutocomplete : function() {
		var closedBySelect = false;
		var $locationSearch = $('#location');
		var locationSearchHasFocus = false;

		$('.ui-autocomplete li.ui-menu-item').live('click', function() {
			PostRoom.selectMenuItem(this);
		});
		$locationSearch.focus(function() {
			locationSearchHasFocus = true;
		});
		$locationSearch.blur(function() {
			locationSearchHasFocus = false;
		});
		$locationSearch.autocomplete({
			minLength : 4,
			delay : 300,
			source : function(request, response) {
				var reqObj = {
					address : request.term
				};
				geocoder.geocode(reqObj, function(results, status) {
					var first, suggestions;

					if(status === google.maps.GeocoderStatus.OK) {
						first = results.length > 0 && results[0];
						suggestions = jQuery.map(results, function(res) {
							return {
								'label' : res.formatted_address,
								'value' : res
							};
						});
						AutocompleteCache.currentSuggestions = jQuery.map(results, function(res) {
							return {
								'label' : res.formatted_address,
								'value' : res
							};
						});
						response(suggestions);

						if(!locationSearchHasFocus) {
							$locationSearch.autocomplete("close");
						}
					}
				});
			},
			focus : function(event, ui) {
				// Don't do anything on focus
				return false;
			}
		});

		$locationSearch.bind("autocompleteclose", function(event, ui) {
			var address, cache, i, li;
			function fakeSelect(item) {
				$locationSearch.trigger("autocompleteselect", {
					item : item,
					fakeSelect : true
				});
				AutocompleteCache.currentSuggestions = null;
			}

			if(!closedBySelect && $locationSearch.val()) {
				cache = AutocompleteCache.currentSuggestions;
				if(cache) {
					fakeSelect(cache[0]);
				}
			}
			closedBySelect = false;
		});
		$locationSearch.bind("autocompleteselect", function(event, ui) {
			if(!ui.fakeSelect) {
				closedBySelect = true;
			}

			$locationSearch.val(ui.item.label);
			return false;
		});
	},
	selectMenuItem : function(menuItem) {
		var aLink = $(menuItem).children();
		var label = $(aLink[0]).html();

		$.each(AutocompleteCache.currentSuggestions || [], function(index, el) {
			if(el.label == label) {
				var ui = el;
				var $lsearch = $("#location");
				$lsearch.trigger('autocompleteselect', {
					item : ui
				});
				$lsearch.autocomplete('close');
				AutocompleteCache.currentSuggestions = null;
				return true;
			}
		});
	},
}