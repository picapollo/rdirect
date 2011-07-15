(function($){
  AvailabilityWidget = function(el, options){
    if(el)
      this.init(el, options);
  };

  $.extend(AvailabilityWidget.prototype, {
    name: 'availabilityWidget',

    init: function(el, options){
      this.buttonContent = options;

      this.buttonStates = {
        active: { status: "active", next_status: "inactive" },
        inactive: { status: "inactive", next_status: "active" }
      };

      this.element = $(el);
      $.data(el,this.name,this);

      // set the initial state
      if(this.element.attr('data-has-availability') == 'true')
        this.setActive();
      else
        this.setInactive();

      var outsideClickHandler = function(eventObject){
        eventObject.data.hidePanel();
      };

      var _ref = this;

      this.element.hover(
        function(){ jQuery(document).unbind('click', outsideClickHandler); },
        function(){ jQuery(document).bind('click', _ref, outsideClickHandler); }
      );
    },

    // toggle between showing and hiding the panel
    togglePanel: function() {
      if(this.element.hasClass('expanded'))
        this.hidePanel();
      else
        this.showPanel(); 
    },

    // hide the panel if it is shown
    hidePanel: function() {
      this.element.find('.toggle-info').hide();
      this.element.removeClass('expanded');

    },

    // show the panel if it is hidden
    showPanel: function() {
      this.element.find('.toggle-info').show();
      this.element.addClass('expanded');
    },

    // set the panel contents to the 'active' state (e.g. "Active" w/ green icon)
    setActive: function(){
      var button = $.extend(true, {}, this.buttonContent.active, this.buttonStates.active, 
                            {url: this.element.attr('data-unavailable-url')});

      this.detachListeners();
      this.element.html($('#availability_button_template').jqote(button, '*'));
      this.attachListeners();
    },

    // set the panel to the 'inactive' state (e.g. "Hidden" w/ red icon)
    setInactive: function(){
      var button = $.extend(true, {}, this.buttonContent.inactive, this.buttonStates.inactive, 
                            {url: this.element.attr('data-available-url')});

      this.detachListeners();
      this.element.html($('#availability_button_template').jqote(button, '*'));
      this.attachListeners();
    },

    // handle all the listeners
    attachListeners: function() {
      var _ref = this;

      this.element.find('span.icon').bind('click', function(){
        _ref.togglePanel();
      });

      // attach the click listener
      this.element.find('.toggle-action').bind('click', function(){
        _ref.hidePanel();
        _ref.element.find('span.icon').addClass('widget-spinner').children('span.label').html('Saving');

        // TODO: make this instance-specific rather than global
        $('#availability-error-message').html('');

        $.ajax({
          url: $(this).attr('href'), 
          dataType: "json",
          type: "POST", 
          success: function(data){
            _ref.element.find('span.icon').removeClass('widget-spinner');
            
            if(data['result'] == 'available')
              _ref.setActive();
            else if(data['result'] == 'unavailable')
              _ref.setInactive();
            else if(data['result'] == 'error'){
              _ref.setInactive();

              // TODO: another instance-specific bit of code!
              var $error_message = $('#availability-error-message');
              $error_message.html(data['message']);
              $error_message.slideDown(1000);
            }
          }
        });

        return false;
      });
    },

    // unregister all listeners
    detachListeners : function() {
      this.element.find('span.icon').unbind('click');
      this.element.find('.toggle-action').unbind('click'); 
    }
  });

  $.fn.availabilityWidget = function(options){
    // get the arguments 
    var args = $.makeArray(arguments),
        after = args.slice(1);

    return this.each(function() {
      // see if we have an instance
      var instance = $.data(this, 'availabilityWidget');

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
        new AvailabilityWidget(this, options);
      }
    });
  };
})(jQuery);

var AirbnbRoomEdit = {
  init: function(options){
    var hostingCoords = options.exactCoords;
    var offsetCoords = options.fuzzyCoords;

    // create the info window that tells users they can change their address via CS
    var supportInfoWindow = new google.maps.InfoWindow({
      content: options.supportContent, 
      maxWidth: 150,
      zIndex: 0
    });

    jQuery(".address-support-link").click(function() {
      if (window._gaq) {
        _gaq.push([
          "_trackEvent", "EditListing",
          "AddressContactSupport", "",
          parseInt(jQuery(this).attr("data-res-count"), 10)]);
      }
    });

    //
    // Draw the private (full detail) map
    //
    jQuery('#private-map').airbnbMap({
      position: hostingCoords,
      onMarkerClick: function(_ref){
        supportInfoWindow.open(_ref.map, _ref.marker); 
      }
    });

    // close the infowindow when the user clicks outside of the infowindow (on the map)
    var gMap = jQuery('#private-map').airbnbMap().map;
    google.maps.event.addListener(gMap, 'click', function(){
      supportInfoWindow.close();
    });

    jQuery('#public-map').airbnbMap({
      position: offsetCoords,
      isFuzzy: true,
      accuracy: options.accuracy
    });

    //
    // Now draw the street view
    //
    var panorama = new google.maps.StreetViewPanorama(document.getElementById('street-view-colorbox'), {
      position: offsetCoords,
      visible: false,
      scrollwheel: false,
      enableCloseButton: false,
      pov: {
        heading: 265,
        zoom: 1,
        pitch: 0
      }
    });

    // hide the 'view' link if the user specified that they
    // didn't want street view
    jQuery('#address_street_view').change(function(){
      if(jQuery(this).val() === '0')
        jQuery('#street-view-link').hide();
      else
        jQuery('#street-view-link').show();
    });

    // toss street view into a sweet lightbox!
    jQuery('#street-view-link').colorbox({
      href: '#street-view-colorbox',
      inline: true,
      onComplete: function(){ 
        if(jQuery('#address_street_view').val() === '1'){
          panorama.setPosition(offsetCoords);
          panorama.setVisible(true); 
        }
        else if(jQuery('#address_street_view').val() === '2'){
          panorama.setPosition(hostingCoords);
          panorama.setVisible(true); 
        }
      },
      onCleanup: function(){ panorama.setVisible(false); }
    });
    
  }
};


