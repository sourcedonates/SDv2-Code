//Jquery Validation
(function($){
  function trim(el) {
    return (''.trim) ? el.val().trim() : $.trim(el.val());
  }
  $.fn.isHappy = function (config) {
    var fields = [], item;
    
    function getError(error) {
      return $('<span id="'+error.id+'" class="unhappyMessage">'+error.message+'</span>');
    }
    function handleSubmit() {
      var errors = false, i, l;
      for (i = 0, l = fields.length; i < l; i += 1) {
        if (!fields[i].testValid(true)) {
          errors = true;
        }
      }
      if (errors) {
        if (isFunction(config.unHappy)) config.unHappy();
        return false;
      } else if (config.testMode) {
        if (window.console) console.warn('would have submitted');
        return false;
      }
    }
    function isFunction (obj) {
      return !!(obj && obj.constructor && obj.call && obj.apply);
    }
    function processField(opts, selector) {
      var field = $(selector),
        error = {
          message: opts.message,
          id: selector.slice(1) + '_unhappy'
        },
        errorEl = $(error.id).length > 0 ? $(error.id) : getError(error);
        
      fields.push(field);
      field.testValid = function (submit) {
        var val,
          el = $(this),
          gotFunc,
          error = false,
          temp, 
          required = !!el.get(0).attributes.getNamedItem('required') || opts.required,
          password = (field.attr('type') === 'password'),
          arg = isFunction(opts.arg) ? opts.arg() : opts.arg;
        
        // clean it or trim it
        if (isFunction(opts.clean)) {
          val = opts.clean(el.val());
        } else if (!opts.trim && !password) {
          val = trim(el);
        } else {
          val = el.val();
        }
        
        // write it back to the field
        el.val(val);
        
        // get the value
        gotFunc = ((val.length > 0 || required === 'sometimes') && isFunction(opts.test));
        
        // check if we've got an error on our hands
        if (submit === true && required === true && val.length === 0) {
          error = true;
        } else if (gotFunc) {
          error = !opts.test(val, arg);
        }
        
        if (error) {
          el.addClass('unhappy animated shake').before(errorEl);
          return false;
        } else {
          temp = errorEl.get(0);
          // this is for zepto
          if (temp.parentNode) {
            temp.parentNode.removeChild(temp);
          }
          el.removeClass('unhappy animated shake');
          return true;
        }
      };
      field.bind(config.when || 'blur', field.testValid);
    }
    
    for (item in config.fields) {
      processField(config.fields[item], item);
    }
    
    if (config.submitButton) {
      $(config.submitButton).click(handleSubmit);
    } else {
      this.bind('submit', handleSubmit);
    }
    return this;
  };
})(this.jQuery || this.Zepto);//Jquery validation methods
  var happy = {
    USPhone: function (val) {
      return /^\(?(\d{3})\)?[\- ]?\d{3}[\- ]?\d{4}$/.test(val)
    },
   
    // matches mm/dd/yyyy (requires leading 0's (which may be a bit silly, what do you think?)
    date: function (val) {
      return /^(?:0[1-9]|1[0-2])\/(?:0[1-9]|[12][0-9]|3[01])\/(?:\d{4})/.test(val);
    },
    
    email: function (val) {
      return /^(?:\w+\.?)*\w+@(?:\w+\.)+\w+$/.test(val);
    },
    
    minLength: function (val, length) {
      return val.length >= length;
    },
    
    maxLength: function (val, length) {
      return val.length <= length;
    },
    
    equal: function (val1, val2) {
      return (val1 == val2);
    },
    steamid: function (val) {
      return /^STEAM_\d:\d:\d+$/.test(val)
    }
  };


  //Set cookie to disable animations if cookie is present
var cookieName = 'firstvisit_itemviewer';

var animatieIn = 'bounceIn';
var animatieUit = 'fadeOut';
var lightBoxClose = $('#lightboxclose');

var lightbox = function(){
  $('a.lightbox').colorbox({
    rel:'gal',
    overlayClose: true,
    transition: 'none',
    fadeOut: 300,
    returnFocus: false,
    opacity: 0.95,
    maxWidth: '70%', 
    maxHeight: '80%', 
    current: "item {current} van de {total}",
    fixed: true,
    reposition: true,
    onOpen: function(){
        //resetten van de animatie
        lightBoxClose.removeClass('visible');
        $('#cboxContent, #lightboxcontrols').removeClass('animated visible '+animatieIn+' '+animatieUit+'');
        //Colorbox hiden totdat alles geladen is
        $("#colorbox, #cboxContent").addClass('hidden');
        //loading screen activeren
        $('.indicator').addClass('visible');
        $('#cboxOverlay').removeClass('hidden');
    },
    onComplete: function(){
        //Animatie op de lightbox zetten
        lightBoxClose.addClass('visible');
        $('#cboxContent, #lightboxcontrols').addClass('visible animated '+animatieIn+'');
        //Colorbox tonen
        $("#colorbox, #cboxContent").removeClass('hidden');
        //loading screen de-activeren
        $('.indicator').removeClass('visible');
    },
    onCleanup: function () {
      lightBoxClose.removeClass('visible');
      $('#cboxContent, #lightboxcontrols').removeClass(animatieIn);
      $('#cboxContent, #lightboxcontrols').addClass(animatieUit);
      $('#cboxOverlay').addClass('hidden');
      $('#lightboxcontrols').removeClass('visible');
    },
    onClosed: function () {
      $('#cboxOverlay').addClass('hidden');
    }
  });
}

$(function() {

  /*png fallback for svg*/
  if (!Modernizr.svg) {
      var imgs = document.getElementsByTagName('img');
      var endsWithDotSvg = /.*\.svg$/
      var i=0;
      var l = imgs.length;
      for (; i != l; ++i) {
          if (imgs[i].src.match(endsWithDotSvg)) {
              imgs[i].src = imgs[i].src.slice(0, -3) + "png";
          }
      }
  }

  /*Smooth scroll*/
  $('a.smooth').bind('click',function(event){
        var $anchor = $(this);
 
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 300,'swing');
        /*
        if you don't want to use the easing effects:
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1000);
        */
        event.preventDefault();
    });

  $('#filter li').click(function(){
    $('.indicator2').addClass('visible');
  });
  $("#lightboxnext").click(function(){
    $(this).colorbox.next();
  });
  $("#lightboxprev").click(function(){
    $(this).colorbox.prev();
  });
  $("#lightboxclose").click(function(){
    $(this).colorbox.close();
  });


  //Validation
  $("#buy-submit").click(function(){
    setTimeout(function() {
      /*var payProviderClass = $('#payProvider').attr('class');
      console.log(payProviderClass);
      $('.selecter-selected').attr('class', payProviderClass);*/
      if ( $("#payProvider").hasClass("unhappy") ) {
        $(".selecter-selected").addClass('unhappy animated shake');
      } else{
        $(".selecter-selected").removeClass('unhappy animated shake');
      }

    }, 10); 
  });
  $('.selecter-item').click(function(){
      $(".selecter-selected").removeClass('unhappy animated shake');
  })
  
  //Debug
  /*$('#buybutton').attr('data-toggled','on');
  itemViewer.addClass('animatedFast '+buyAnimatieOut+'');
  $('#buybutton').text('Sluit overlay')
  setTimeout(function() {
    itemViewer.addClass('remove');
    buyOverlay.removeClass('animatedFast '+buyAnimatieOut+'');
    buyOverlay.removeClass('remove hidden');
    buyOverlay.addClass('animatedFast '+buyAnimatieIn+'');
  }, 200);
  //animate form after package selection
    $('#buy-indication').addClass('animated fadeOutUp');
    setTimeout(function() {
      $('#buy-innercontent').removeClass('hidden remove');
      $('#buy-indication').addClass('remove');
      $('#buy-innercontent').addClass('animated '+buyAnimatieIn+'');
      $('#buy-form input[value=""]:first').attr('autofocus');
    }, 200);*/
  //Debug

  /*fetch value of packages and print in the form*/
  var buyItem = $('.buy-item');
  buyItem.click(function(){
    var packageID = $(this).attr("data-id");
    var packageName = $(this).attr("data-packagename");
    var packagePrice = $(this).attr("data-price");
    $('#buy-value').attr('value', packageID);
    $('#packageName').text(packageName);
    $('#packagePrice').text(packagePrice);
    $('#packages .buy-item').removeClass('active');
    $(this).addClass('active');
    

    /*animate form after package selection*/
    $('#buy-indication').addClass('animated fadeOutUp');
    setTimeout(function() {
      $('#buy-innercontent').removeClass('hidden remove');
      $('#buy-indication').addClass('remove');
      $('#buy-innercontent').addClass('animated visible '+buyAnimatieIn+'');
      $('#buy-form input[value=""]:first').attr('autofocus');
    }, 200);
    
  });

  /*purchase overlay*/
  var buyAnimatieIn = 'fadeInDown';
  var buyAnimatieOut = 'fadeOutDown';
  var buyOverlay = $('#buyoverlay');
  var itemViewer = $('#itemviewer');
  var buttonContent = $('#buybutton').html()
  $('#buybutton').on('click', function(){
      if (!$(this).attr('data-toggled') || $(this).attr('data-toggled') == 'off'){
              $(this).attr('data-toggled','on');
              itemViewer.addClass('animatedFast '+buyAnimatieOut+'');
              $(this).text('Sluit overlay')
              setTimeout(function() {
                itemViewer.addClass('remove');
                buyOverlay.removeClass('animatedFast '+buyAnimatieOut+'');
                buyOverlay.removeClass('remove hidden');
                buyOverlay.addClass('animatedFast '+buyAnimatieIn+'');
              }, 200);
              $('#logo').click(function(){
                $('#buybutton').attr('data-toggled','off'); 
                $('#buybutton').text(buttonContent);
                buyOverlay.removeClass('animatedFast '+buyAnimatieIn+'');
                buyOverlay.addClass('animatedFast '+buyAnimatieOut+'');
                setTimeout(function() {
                  buyOverlay.addClass("remove hidden");
                  itemViewer.removeClass('remove animatedFast '+buyAnimatieOut+'');
                  itemViewer.addClass('animatedFast '+buyAnimatieIn+'');
                }, 200); 
              });
      }
      else if ($(this).attr('data-toggled') == 'on'){
              $(this).attr('data-toggled','off'); 
              $(this).text(buttonContent);
              buyOverlay.removeClass('animatedFast '+buyAnimatieIn+'');
              buyOverlay.addClass('animatedFast '+buyAnimatieOut+'');
              setTimeout(function() {
                buyOverlay.addClass("remove hidden");
                itemViewer.removeClass('remove animatedFast '+buyAnimatieOut+'');
                itemViewer.addClass('animatedFast '+buyAnimatieIn+'');
              }, 200);   
              
      }

  });


  

  //execute cookie function
  checkCookie();
  //cookie function
  function checkCookie() {
    if (document.cookie.length > 0 && document.cookie.indexOf(cookieName + '=') != -1) {
      var delaytime2nd = 600;
	    $('.loading-container').delay(delaytime2nd)
	      .queue(function() {
	        $(this).addClass("animated fadeOut")
	      });
	      setTimeout(function() {
	        $('.loading-container').addClass('hidden');
	      }, delaytime2nd + 400);

    }
    else{
      var delaytime = 1000;
      $('.loading-container').delay(delaytime)
       .queue(function() {
          $(this).addClass("animated fadeOut");
       });
       setTimeout(function() {
        $('.loading-container').addClass('hidden');
      }, delaytime + 800);

      // set the cookie to show user has already visited
      document.cookie = cookieName + "=1";

      } /*end else*/
  } /*end functie cookiecheck*/

  $('#grid').mixitup({
    effects: ['fade','scale'],
    easing: 'smooth',
    transitionSpeed: '600',
    onMixLoad: function(){
      lightbox();
    },
    onMixStart: function() {
      $('.indicator').addClass('visible');
    },
    onMixEnd: function() {
      $('.indicator').removeClass('visible');
      lightbox();
    }
  });

  lightbox();

  $('#buy-form').isHappy({
      fields: {
        // reference the field you're talking about, probably by `id`
        // but you could certainly do $('[name=name]') as well.
        '#nickname': {
          required: true,
          message: 'Enter a relevant nickname please'
        },
        '#steamID': {
          required: true,
          message: 'Enter a valid SteamID please',
          test: happy.steamid // this can be *any* function that returns true or false
        },
        '#payProvider': {
          required: true,
          message: 'How do you want to pay?'
        },
        '#e-mail': {
          required: true,
          message: 'Enter a valid email.',
          test: happy.email // this can be *any* function that returns true or false
        }
        /*'#tos': {
          required: true,
          message: 'you need to agree with our Terms of Service'
        }*/
      }
    });

  $("select").selecter({
      defaultLabel: "Kies een methode"
    });

});

$(document).keyup(function(e) {
  if (e.keyCode == 27) { $('.indicator').removeClass('visible'); }   // esc
});

/*$(document).ready(function() {
  $("#scrollDown").click(function(event){
        $('html, body').stop().animate({scrollTop: '+=150px'}, 400);

  });
  $("#scrollUp").click(function(event){
        $('html, body').stop().animate({scrollTop: '-=150px'}, 400);
  });
  $("#scrollDownbig").click(function(event){
        $('html, body').stop().animate({scrollTop: '+=650px'}, 400);

  });
  $("#scrollUpbig").click(function(event){
        $('html, body').stop().animate({scrollTop: '-=650px'}, 400);
  });
});
*/
$(window).scroll(function(){ 
  var $header = $('header');
  var $totop = $('#totop');
  if ($(this).scrollTop() > 500){      
    $header.addClass("small-header");
    //$("#buyoverlay").addClass("small-buyoverlay");
  } 
  else{
    if($header.hasClass('small-header')) {
        $header.removeClass("small-header");
        //$("#buyoverlay").removeClass("small-buyoverlay");
    }
  }
  var totopIn = 'flipInX';
  var totopOut = 'fadeOut';
  if ($(this).scrollTop() > 1500){    
    $totop.removeClass('animated '+totopOut+'');
    $totop.addClass('animated '+totopIn+'');
    //buyOverlay.addClass('small-buyoverlay');
  } 
  else{
    if($totop.hasClass(''+totopIn+'')) {
        $totop.addClass('animated '+totopOut+'');
        //buyOverlay.removeClass('small-buyoverlay');
    }
  }
});

