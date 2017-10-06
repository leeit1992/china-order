$(document).ready(function(){

	//Hover item work 
    $('.work-wrap .work-item.hoverdir').each( function() { $(this).hoverdir(); } ); 

    //  Fillter Isotop Plugin 
    var container = $('.work-wrap');
    container.isotope({
        animationEngine : 'best-available',
        animationOptions: {
            duration: 200,
            queue: false
        },
        layoutMode: 'fitRows'
    });
    $('.filters li:eq(0) a').addClass('select-filter');
    $('.filters a').click(function(){
        $('#filters a').removeClass('select-filter');
        $(this).addClass('select-filter');
        var selector = $(this).attr('data-filter');
        container.isotope({ filter: selector });
        setProjects();
        return false;
    });

    // Responsive Column
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

        container.find('.awe-works.fullwidth .work-item').each(function () {
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


    // Script Skill Style 1
    $('.skillbar').appear(function(){
        $(this).find('.skillbar-run').animate({
            width:$(this).attr('data-percent')
        },2000);
        // $('.skillbar-percent').addClass('fade');
    });


    //Sticky Navigation
    $("#navigation").sticky({topSpacing: 0});

    
});




