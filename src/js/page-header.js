(function($){
    "use strict";

    var AVT_HEADER = Backbone.View.extend({
        el : '.header',

        events: {
            'click .avt-notice-status': 'handleStatusNotice'
        },

        initialize: function() {     
        },

        handleStatusNotice: function(e){
        var self = this,
            id = $(e.currentTarget).attr('data-id'),
            link = $(e.currentTarget).attr('data-link');
        var data = { id: id };
        // Send to server handle.
        $.post(AVTDATA.SITE_URI + '/status-notice', data, function(result) {
            var dataResult = JSON.parse( result );
            if (dataResult.status) {
                window.location = link;
            }
        });
        },

    });
    new AVT_HEADER;
    
})(jQuery);