$(document).ready(function(){
$.fn.countTo = function (options,element) {
    options = options || {};
    return $(this).each(function () {
      settings = options
      // how many times to update the value, and how much to increment the value on each update
      var loops = Math.ceil(settings.speed / settings.refreshInterval),
        increment = (settings.to - settings.from) / loops;
      // references & variables that will change with each update
      var self = element,
        $self = element,
        loopCount = 0,
        value = settings.from,
        data = $self.data('countTo') || {};
      $self.data('countTo', data);
      // if an existing interval can be found, clear it first
      if (data.interval) {
        clearInterval(data.interval);
      }
      data.interval = setInterval(updateTimer, settings.refreshInterval);
      
      // initialize the element with the starting value
      render(value);
      
      function updateTimer() {
        value += increment;
        loopCount++;
        
        render(value);
        
        if (typeof(settings.onUpdate) == 'function') {
          settings.onUpdate.call(self, value);
        }
        
        if (loopCount >= loops) {
          // remove the interval
          $self.removeData('countTo');
          clearInterval(data.interval);
          value = settings.to;
          
          if (typeof(settings.onComplete) == 'function') {
            settings.onComplete.call(self, value);
          }
        }
      }
      
      function render(value) {
        var formattedValue = counter.numberFormate(value.toFixed(2));
        $self.html(formattedValue);
      }
    });
  };
  
$.fn.countTo.defaults = {
    from: 0,               // the number the element should start at
    to: 0,                 // the number the element should end at
    speed: 1000,           // how long it should take to count between the target numbers
    refreshInterval: 100,  // how often the element should be updated
    decimals: 0,           // the number of decimal places to show
    formatter: app.formatter,  // handler for formatting the value before rendering
    onUpdate: null,        // callback method for every time the element is updated
    onComplete: null       // callback method for when the element finishes updating
  };
  counter.init();
  
});

const counter = {
  init: function(){
    // this.initiate();
  },
  initiate: function(element){
      $('.count-number').data('countToOptions', {
        formatter: function (value, options) {
          return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
        }
        });
      // start all the timers
      $('#'+element+' .timer').each(this.count);
  },
  formatter: function(value, settings){
       return value.toFixed(settings.decimals);
  },
  count:function(options){
      var $this = $(this);
      let counter_val = $this.attr("data-to");
      options = {
            "from": 0,
            "to": counter_val,
            "speed": 1500,
            "refreshInterval": 100,
            "decimals": 0,
            "onUpdate": null,
            "onComplete": null
      };
      $this.countTo(options,$this);
  },
  numberFormate: function(number, prefix, thousand_separator, decimal_separator){
        number = number.toString();
        var thousand_separator = thousand_separator || ',',
                decimal_separator = decimal_separator || '.',
                regex = new RegExp('[^' + decimal_separator + '\\d]', 'g'),
                number_string = number.replace(regex, '').toString(),
                split = number_string.split(decimal_separator),
                rest = split[0].length % 3,
                result = split[0].substr(0, rest),
                thousands = split[0].substr(rest).match(/\d{3}/g);
        if (thousands) {
            separator = rest ? thousand_separator : '';
            result += separator + thousands.join(thousand_separator);
        }
        result = split[1] != undefined ? result + decimal_separator + split[1] : result;
    
        return prefix == undefined ? result : (result ? prefix + result : '');   
  }
}


  