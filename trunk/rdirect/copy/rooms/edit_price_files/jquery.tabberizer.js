(function($){
  Tabberizer = function(el, options){
    if(el){
      this.init(el, options);
    }
  };

  $.extend(Tabberizer.prototype, {
    name: 'tabberizer',

    init: function(el, options){
      this.element = $(el);
      $.data(el, this.name, this);

      var _ref = this;

      var _ulRef = this.element;
      var _ulId = _ulRef.attr('id');

      _ulRef.find("li").each(function(){
        $(this).click(function(){
          var $this = $(this);

          var i = parseInt(_ulRef.find("li").index(this));
          $('#' + _ulId + ', #' + _ulId + "_panels").find('> li.selected').removeClass('selected');
          $(this).addClass("selected");
          $('#' + _ulId + "_panels").find('> li:nth-child(' + (i + 1) + ')').addClass('selected');

          $('span.notification', this).fadeOut(function(){
            $(this).remove();
          });
    
          var tabId = $this.attr('id');

          // defuse the tab id so that we don't get page scroll when we change this guy
          if(tabId !== ''){
            $this.attr('id', '');
            window.location.hash = tabId;
            $this.attr('id', tabId);
          }
          else {
            window.location.hash = '';
          }
        });
      });

      // check for hashtag
      if(window.location.hash){
        jQuery('li' + window.location.hash).click();
      }
      else {
        jQuery('li:first-child', this.element).click();
      }
    }
  });

  /**
   * This plugin links a navbar (consisting of an unordered list) to panel
   * content (contained in an unordered list where the elements are 1-to-1 mapped with
   * the navbar list).
   *
   * The following assumptions are made:
   *   - The plugin is invoked on a ul with some ID e.g. #<yournavid>
   *   - THe DOM contains a ul containing of the various panels with ID #<yournavid>_panels
   *   - #<yournavid>_panels contains the same number of li elements as #<yournavid>
   *   - Selected nav list items and panels will have the class "selected"
   */
  $.fn.tabberizer = function(options){
    // get the arguments 
    var args = $.makeArray(arguments),
        after = args.slice(1);

    return this.each(function() {
      // see if we have an instance
      var instance = $.data(this, 'tabberizer');

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
        new Tabberizer(this, options);
      }
    });

    return this.each(function(){
    });
  }
 })(jQuery);
