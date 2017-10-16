/**
 * Handle 
 *
 * @version     1.0
 * @author      HaLe
 * @package     ATL
 */
(function($){
    "use strict";
    var PAGE_USER_TOOL_CART = Backbone.View.extend({
        el : '#page-user-tool-cart',
        formClassError : 'md-input-danger',

        events : {
            'change .avt-checkbox-primary-js' : 'handleCheckCart'
        },

        initialize: function() {
            
        },

        handleCheckCart: function(e){
            if($(e.currentTarget).context.checked) {
                $(e.currentTarget).closest('.avt-group-item').find('.avt-checkbox-child-js').each(function(i, el) {
                    $(el).prop('checked', true)
                });
            }else{
                 $(e.currentTarget).closest('.avt-group-item').find('.avt-checkbox-child-js').each(function(i, el) {
                    $(el).prop('checked', false)
                });
            }
        },

    });
    new PAGE_USER_TOOL_CART;
    
})(jQuery);