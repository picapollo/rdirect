var AirbnbDashboard = {
  init: function(){
    // close handlers for the notification area notices
    jQuery('#notification-area div span.close').live('click', function(){
      jQuery(this).parent().fadeOut(500, function(){
        jQuery(this).remove(); 
      });
    });

    // add the browser name to the body classname (for conditional CSS)
    if(jQuery.browser.webkit)
      jQuery('body').addClass('webkit');

    // preload the spinner
    var spinner = new Image();
    spinner.src = "/images/spinner.gif";
  },

  createNotificationItem: function(label, type, context){
    if(context != null)
      jQuery('#notification-area [data-form="' + jQuery(context).attr('id') + '"]').remove();

    jQuery('#notification-area').prepend(jQuery('#notification-item-template').jqote({type: type, label: label}, '*'));

    // grab the notification we just tossed in there
    var notification = jQuery('#notification-area > :first-child');

    if(context != null)
      notification.attr('data-form', jQuery(context).attr('id'));

    notification.children('.label').effect('pulsate', {times: 4}, 700);
  },
  
  updateProgressBar: function(fraction, nextSteps, prompt, available) {
    var progressbar = jQuery('#listing_progress');
    
    progressbar.fadeOut(350, function() {
      jQuery('#progress_text').html(prompt);
      
      var filling = jQuery('#creamy_bar_filling');
      filling.removeClass();
      filling.addClass('filled_' + (Math.floor(fraction * 10) * 10));
      
      var list = jQuery('#next_steps');
      list.empty();
      
      for(var key in nextSteps) {
        var step = nextSteps[key];
        list.append('<li><a class="step_link" href="' + step.url + '" title="' + step.description + '">'  + step.description + '</a><span class="plus_percent">(+' + Math.round(step.weight * 100) + '%)</span></li>');
      }
      
      if(available !== true) {
        progressbar.fadeIn(350);
        jQuery('.set-availability').availabilityWidget('setInactive');
      }
      else {
        jQuery('.set-availability').availabilityWidget('setActive');
      }
    });
  }
};
