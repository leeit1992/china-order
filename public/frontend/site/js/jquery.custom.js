"use strict";

//Preloader
var rotate = 1;
function hide_preloader() {
    rotate = 0;
    $("#preloader").fadeOut(1000);
}

function mobilecheck() {
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        return false;
    }
    return true;
}

jQuery(window).load(function($){

//Google Map
    var MY_MAPTYPE_ID = 'custom_style';

    var featureOpts = [
        
        {
            stylers: [
            { hue: '#ff1a00' },
            { invert_lightness: true },
            { saturation: -100  },
            { lightness: 33 },
            { gamma: 0.5 }
            ]
    },{
        featureType: 'water',
        elementType: 'geometry',
        stylers: [
            { color: '#2D333C' }
        ]
    }
    ];

    var latlng = new google.maps.LatLng(45.738028,21.224535);
    var settings = {
        zoom: 16,
        center: latlng,
        mapTypeControlOptions: {
            mapTypeIds: [google.maps.MapTypeId.ROADMAP, MY_MAPTYPE_ID]
        },
        mapTypeControl: false,
        mapTypeId: MY_MAPTYPE_ID,
        scrollwheel: false,
        draggable: true,
    };


    var map = new google.maps.Map(document.getElementById("map_canvas"), settings);

    var styledMapOptions = {
        name: 'Custom Style'
    };
    var customMapType = new google.maps.StyledMapType(featureOpts, styledMapOptions);

    map.mapTypes.set(MY_MAPTYPE_ID, customMapType);

    google.maps.event.addDomListener(window, "resize", function() {
        var center = map.getCenter();
        google.maps.event.trigger(map, "resize");
        map.setCenter(center);
    });

    var contentString = '<div id="content">'+
        '<div id="siteNotice">'+
        '</div>'+
        '<h3 id="firstHeading" class="firstHeading">W&M STUDIO</h3>'+
        '<div id="bodyContent">'+
        '<p>Come here and drink a coffee!</p>'+
        '</div>'+
        '</div>';
    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });

    var companyImage = new google.maps.MarkerImage('images/marker.png',
        new google.maps.Size(26,41), //Width and height of the marker
        new google.maps.Point(0,0),
        new google.maps.Point(35,20)// Position of the marker 
    );



    var companyPos = new google.maps.LatLng(45.738028,21.224535);

    var companyMarker = new google.maps.Marker({
        position: companyPos,
        map: map,
        icon: companyImage,
        title:"W&M STUDIO",
        zIndex: 3});



    google.maps.event.addListener(companyMarker, 'click', function() {
        infowindow.open(map,companyMarker);
    });

});


jQuery(document).ready(function($) {

    //Menu mobile
    
    $('#navigation .menu-mobile').click(function(){
        $(this).toggleClass('menu-mobile-active');
        $('#navigation ul.menu').toggleClass('fade-nav');
        $('#navigation.nav-ver2').toggleClass('nav-active');
    });
    $('#navigation ul.menu a').click(function(){
        $('.menu-mobile').removeClass('menu-mobile-active');
        $('#navigation ul.menu').removeClass('fade-nav');
        $('#navigation.nav-ver2').removeClass('nav-active');
    });

    //Style option
    $('#style-option .button').click(function() {
       $('#style-option').toggleClass('style-option-toggle');
    });

    //Scroll-contact
    $('.contact-link').click(function () {
        $('html').animate({ scrollTop: $('#start-project').offset().top }, 'slow');
        return false;
    });

    //Video btn
    $('#header-wrap.video').addClass('video-place');
    $('.play-btn').click(function () {
        $('.pause-btn, .volume-btn').fadeIn(600);
        $('.play-btn, #header-wrap.video .logo, #header-wrap.video h2, #header-wrap.video .link, #owl-text').fadeOut(600);
        $('#header-wrap.video').removeClass('video-place');
    });
    $('.pause-btn').click(function () {
        $('.play-btn, #header-wrap.video .logo, #header-wrap.video h2, #header-wrap.video .link, #owl-text').fadeIn(600);
        $('.pause-btn, .volume-btn').fadeOut(600);
        $('#header-wrap.video').addClass('video-place');
    });

    //Header height full
    var hw = $(window).height();
    $('header#header-wrap').css('height',hw+'px');

    //Skill run
    $('.skillbar').appear(function(){
        $(this).find('.skillbar-run').animate({
            width:$(this).attr('data-percent')
        },2000);
        $('.skillbar-percent').addClass('fade');
    });
    
    //Direction hover
    $(' .work-item-ver3 article, .work-item-dark article ').each( function() { $(this).hoverdir(); } ); 

    //Textarea auto resize
    $('.textarea-form').autosize({append: "\n"});

    //Map open
    $('#our-office-dark .open-map').click(function() {
        $(this).toggleClass('open-map-active');
        $('#map_canvas.dark').toggleClass('map-toggle');
    });

    //Hover services
    $('#services .inner').hover(function() {
        $('#services article').toggleClass('article-hover');
    });

    //Nav scroll to
    $('.home #navigation ul li:eq(0)').addClass('current-page-item');
    $('#navigation').onePageNav({
        currentClass: 'current-page-item',
    });

    //Sticky Navigation
    $("#navigation, #navigation.nav-ver2").sticky({topSpacing: 0});

    
    //Video youtube custom
    $('.player').mb_YTPlayer();


    //SLIDER BANNER
    $("#owl-banner").owlCarousel({
        autoPlay: 5000,
        slideSpeed : 2000,
        navigation: true,
        navigationText : ["", ""],
        pagination: false,
        singleItem:true,
        transitionStyle : "fade",
    });

    

    //SLIDER TEXT
    $("#owl-text").owlCarousel({
        autoPlay: 2000,
        slideSpeed : 1000,
        navigation: false,
        pagination: false,
        singleItem:true,
        transitionStyle : "fade"
    });

    //SLIDER TEXT 2
    $("#owl-text-2").owlCarousel({
        autoPlay: 4000,
        slideSpeed : 1000,
        navigation: false,
        pagination: false,
        singleItem:true,
        transitionStyle : "fade",
    });

    //SLIDER TWITTER
    $("#owl-twitter").owlCarousel({
        autoPlay: 5000,
        slideSpeed : 1000,
        navigation: true,
        navigationText : ["", ""],
        pagination: false,
        singleItem:true,
        transitionStyle : "fade",
    });

    //SLIDER TESTIMONIAL
    $("#owl-testimonials").owlCarousel({
        autoPlay: 6000,
        slideSpeed : 1000,
        navigation: true,
        navigationText : ["", ""],
        pagination: false,
        singleItem:true,
        transitionStyle : "fade",
    });

    

	//SLIDER LASTED POST
	$("#owl-lasted-post").owlCarousel({
        autoPlay: 10000,
        items : 3,
        navigation: false,
        pagination: true,
    });

    //SLIDER BLOG LIST
    $("#owl-blog-list").owlCarousel({
        autoPlay: 4000,
        slideSpeed : 1000,
        navigation: true,
        navigationText : ["", ""],
        pagination: false,
        singleItem:true,
    });
	
	

	//NAV SCROLL TO
	// $('.home header nav ul li:eq(0)').addClass('current-page-item');
	// $('header nav').onePageNav();

	//GO TOP
	$('#scroll-top').click(function () {
		$("html, body").animate({scrollTop: 0}, 1000);
	}); 

    

    //HEADER PARALLAX MOUSE MOVE
    $('#header-wrap.parallax-mouse-move').mousemove(function(e){
        var amountMovedX = (e.pageX * -1 / 12);
        var amountMovedY = (e.pageY * -1 / 10);
        $(this).css({
            'background-position': amountMovedX + 'px ' + amountMovedY + 'px'
        });
    });

	//LIGHTBOX TEAM
    if($(".popup-image").length>0){
		$(".popup-image").magnificPopup({type:"image"});
	}
	if($(".popup-gallery").length>0){
		$(".popup-gallery").magnificPopup({
			type:"inline",
			callbacks:{open:function(){
				$(".img-slideshow").owlCarousel({
					slideSpeed:500,
					navigation:true,
					pagination:false,
					singleItem:true
				})
				},
				close:function(){},
				imageLoadComplete:function(){}
			}
		});
	}
	if($(".popup-soundcloud").length>0){
		$(".popup-soundcloud").magnificPopup({type:"iframe",mainClass:"soundcloud-popup"});
	}
	if($(".popup-youtube, .popup-vimeo, .popup-gmaps").length>0){
		$(".popup-youtube, .popup-vimeo, .popup-gmaps").magnificPopup({
			disableOn:700,
			type:"iframe",
			fixedContentPos:false,
			fixedBgPos:false,
			mainClass:"mfp-fade",
			removalDelay:160,
			preloader:false
		});
	}
	
	
	
    if ($(window).width() > 767) {
        //CountUp
        $('#fun-facts .col').appear(function() {
            var count_element = $('.countup', this).html();
            $(".countup", this).countTo({
                from: 0,
                to: count_element,
                speed: 2500,
                refreshInterval: 50,
            });
        });
        //Animation
        if (mobilecheck()) {
            new WOW().init();
        }
    }

    /* Contact form: Ajax & Validate
        ---------------------------------------------------------- */   
    if($("#contact-form").length > 0){
      // Validate the contact form
      $('#contact-form').validate({
        // Add requirements to each of the fields
        rules: {
          name: {
            required: true,
            minlength: 2
          },
          email: {
            required: true,
            email: true
          },
          message: {
            required: true,
            minlength: 10
          }
        },

        // Specify what error messages to display
        // when the user does something horrid
        messages: {
          name: {
            required: "Please enter your name.",
            minlength: $.format("At least {0} characters required.")
          },
          email: {
            required: "Please enter your email.",
            email: "Please enter a valid email."
          },
          message: {
            required: "Please enter a message.",
            minlength: $.format("At least {0} characters required.")
          }
        },

        // Use Ajax to send everything to processForm.php
        submitHandler: function(form) {
          $("#submit-contact").html("Sending...");
          $(form).ajaxSubmit({
            success: function(responseText, statusText, xhr, $form) {
              $("#contact-content").slideUp(600, function() {
                $("#contact-content").html(responseText).slideDown(600);
                $("#submit-contact").html("Submit");
              });
            }
          });
          return false;
        }
      });
    }

});

function parallaxInit() {
    $('#header-wrap').parallax("50%", 0.2);
    $('#twitter').parallax("50%", 0.2);
    $('#fun-facts').parallax("50%", 0.2);
    $('#team').parallax("50%", 0.2);
    $('#testimonials').parallax("50%", 0.2);
    $('#our-office-dark').parallax("50%", 0.2);
    $('#our-skill').parallax("50%", 0.2);
    $('#header-wrap .flexslider .item-parallax').parallax("50%", 0.2);
}
    
//Background parallax
if ($(window).width() > 992) {

	$(window).bind('load', function () {
		parallaxInit();                       
	});
	
}


jQuery(document).ready(function($) {
// Portfolio Isotope
    var container = $('#work-wrap');


    container.isotope({
        animationEngine : 'best-available',
        animationOptions: {
            duration: 200,
            queue: false
        },
        layoutMode: 'fitRows'
    });

    $('#filters li:eq(0) a').addClass('select-filter');
    $('#filters a').click(function(){
        $('#filters a').removeClass('select-filter');
        $(this).addClass('select-filter');
        var selector = $(this).attr('data-filter');
        container.isotope({ filter: selector });
        setProjects();
        return false;
    });


    function splitColumns() {
        var winWidth = $(window).width(),
            columnNumb = 1;


        if (winWidth > 1200) {
            // Large devices Desktops (≥1200px)
            columnNumb = 4;
        } else if (winWidth > 992) {
            // Medium devices Desktops (≥992px)
            columnNumb = 3; 
        } else if (winWidth > 768) {
            // Small devices Tablets (≥768px)
            columnNumb = 3; 
        } else if (winWidth > 480) {
            // Small devices Tablets (≥768px)
            columnNumb = 3; 
        } else if (winWidth < 480) {
            // Extra small devices Phones (>480px)
            columnNumb = 1;
        }

        return columnNumb;


    }

    function setColumns() {
        var winWidth = $(window).width(),
            columnNumb = splitColumns(),
            postWidth = Math.floor(winWidth / columnNumb);

        container.find('.work-item').each(function () {
            $(this).css( {
                width : postWidth + 'px'
            });
        });
    }

    function setProjects() {
        setColumns();
        container.isotope('reLayout');
    }


    container.imagesLoaded(function () {
        setColumns();
    });

    $(window).bind('resize', function () {
        setProjects();
    });

});


$(window).bind('resize', function() {
    //Header height full
    var hw = $(window).height();
    $('header#header-wrap').css('height',hw+'px');
});

$(window).load(function() {
    document.getElementById("all").click();
	
	//Flex slide setting
    $('.flexslider').flexslider({
        animation: "fade",
        controlNav: false,
        directionNav: true,
        prevText: "",
        nextText: "",
        start: function(slider){
            $('body').removeClass('loading');
        }
    });
});




