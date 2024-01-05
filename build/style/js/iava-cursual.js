        $(document).ready(function () {
            
            numCarousel = parseInt($(".carousel .viewport .overview li").length);
            carouselPages = Math.ceil(numCarousel / 4);
            var templateBullets = '<li><a href="#" class="bullet" data-slide="{off}">{off}</a></li>';
            for (b = 0; b < carouselPages; b++) {
                c = (4 * b);
                $(".carousel .viewport .bullets").append(templateBullets.replace(/{off}/g, c.toString()));
            }
            $('.slider').nivoSlider({
                effect: 'random',               // Specify sets like: 'fold,fade,sliceDown'
                slices: 15,                     // For slice animations
                boxCols: 8,                     // For box animations
                boxRows: 4,                     // For box animations
                animSpeed: 500,                 // Slide transition speed
                pauseTime: 3000,                // How long each slide will show
                startSlide: 0,                  // Set starting Slide (0 index)
                directionNav: false,             // Next & Prev navigation
                controlNav: true,               // 1,2,3... navigation
                controlNavThumbs: false,        // Use thumbnails for Control Nav
                pauseOnHover: true,             // Stop animation while hovering
                manualAdvance: false,           // Force manual transitions
                prevText: 'Prev',               // Prev directionNav text
                nextText: 'Next',               // Next directionNav text
                randomStart: false,             // Start on a random slide
                beforeChange: function () { },     // Triggers before a slide transition
                afterChange: function () { },      // Triggers after a slide transition
                slideshowEnd: function () { },     // Triggers after all slides have been shown
                lastSlide: function () { },        // Triggers when last slide is shown
                afterLoad: function () { }         // Triggers when slider has loaded
            });
            $(".carousel").tinycarousel({ bullets: true, infinite: false });
            $(window).scroll(function (event) {
                var scroll = $(window).scrollTop();
                if (scroll > 100) {
                    $(".row_two").css({ "position": "fixed", "top": "-7px", "background-color": "#FFF", "z-index": "999999999", "box-shadow": "1px 3px 4px 0 rgba(0,0,0,0.15)", "padding-top":"10px", "padding-bottom":"10px" });
                } else {
                    $(".row_two").removeAttr("style");
                }
            });
        });


									$(document).ready(function(){
 									 $("#mcts1").hover(function(){
  									  $(".navNext").show("slow");		
										  });
											});
									$(document).ready(function(){
 									 $("#mcts1").mouseleave(function(){
  									  $(".navNext").hide("slow");		
										  });
											});
											
									$(document).ready(function(){
 									 $("#mcts1").hover(function(){
  									  $(".navPrev").show("slow");		
										  });
											});
									$(document).ready(function(){
 									 $("#mcts1").mouseleave(function(){
  									  $(".navPrev").hide("slow");		
										  });
											});
