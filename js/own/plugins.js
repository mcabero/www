jQuery(document).ready(function(){

  // HAMBURGUER
  jQuery('#nav').hide({});
  
  jQuery('#menu-show' ).click(function() {
    jQuery('#nav').toggle( "slow", function() {
    });
  });

  // FLUIDVIDS
  fluidvids.init({
    selector: ['iframe', 'object'], // runs querySelectorAll()
    players: ['www.youtube.com', 'player.vimeo.com'] // players to support
  });

  // VER QUE CONFIG A CADA BREAK  
  // NOTES SLIDER    
  jQuery('.flexslider').flexslider({
    animation: "slide",
    animationLoop: false,
    slideshow: false,
    prevText: "",     
    nextText: "",  
    selector: ".slides > article",
    controlNav: false,
    itemMargin: 20,
    itemWidth: 285,
    useCSS: false,
    start: function (slider) {
      jQuery(slider).parent().find(".slider-load-img").fadeOut();
      jQuery(slider).animate({
        opacity: 1
      }, 200);
       // lazy load
       // jQuery(slider).find("img.lazy").each(function () {
       //    var src = jQuery(this).attr("data-src");
       //    jQuery(this).attr("src", src).removeAttr("data-src");
       // });
     }
  });

  // ARTICLE SLIDER    
  jQuery('.note-slider').flexslider({
    animation: "slide",
    slideshow: true,
    prevText: "",     
    nextText: "",  
    selector: ".note-slides > article",
    controlNav: false,
    pauseOnHover: true,   
  }); 

  // SCROLL TOP
  // browser window scroll (in pixels) after which the "back to top" link is shown
  var offset = 300,
  //browser window scroll (in pixels) after which the "back to top" link opacity is reduced
  offset_opacity = 1200,
  //duration of the top scrolling animation (in ms)
  scroll_top_duration = 700,
  //grab the "back to top" link
  $back_to_top = $('.to-top');

  //hide or show the "back to top" link
  $(window).scroll(function(){
    ( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
    if( $(this).scrollTop() > offset_opacity ) { 
      $back_to_top.addClass('cd-fade-out');
    }
  });

  //smooth scroll to top
  $back_to_top.on('click', function(event){
    event.preventDefault();
    $('body,html').animate({
      scrollTop: 0 ,
      }, scroll_top_duration
    );
  });
   
  // matchMEDIA 768w
  if (window.matchMedia('(min-width: 768px)').matches)
  {

    jQuery('#nav').show({});

    // FLEXSLIDER
    jQuery('.flexslider').flexslider({
      itemMargin: 20,
      itemWidth: 285,
    });

    // PRINCIPAL SLIDER    
    jQuery('.principal-slider').flexslider({
      animation: "slide",
      slideshow: true,
      prevText: "",     
      nextText: "",  
      selector: ".principal-slides > article",
    });  


    // STICKY HEADER
    var offset = jQuery(".header-item-bottom").offset();
    var stickyHeaderTop = offset.top;
    var stickyHeader = function(){ 
        var scrollTop = jQuery(window).scrollTop(); 
        
        if (scrollTop > stickyHeaderTop) {   
            jQuery('.header-item-bottom').addClass('sticky');
                        
        } else {  
            jQuery('.header-item-bottom').removeClass('sticky');   
        }  
    };

    stickyHeader();
    $(window).scroll(function() { 
        stickyHeader();
    });

  } // MatchMedia for > desktop +

});