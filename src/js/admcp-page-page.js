(function($){
    "use strict";

    var AVT_PAGE = Backbone.View.extend({
        el : '#avt-admcp-handle-page',

        events: {
            'change .avt-check-menu': 'handleCheckMenu',
            'change .avt-check-icon': 'handleCheckIcon',
        },

        initialize: function() {     
        },

        handleCheckMenu: function(e){
            if( $(e.currentTarget).is(":checked") ){
                $('.avt-menu-js').show();
            } else {
                $( 'input[name=avt_page_order]').val('');
                $('.avt-menu-js').hide();
            }
        },
        handleCheckIcon: function(e){
            if( $(e.currentTarget).is(":checked") ){
                $('.avt-icon-js').show();
            } else {
                $( 'input[name=avt_page_icon]').val('');
                $('.avt-icon-js').hide();
            }
        },
    });
    new AVT_PAGE;
    
})(jQuery);