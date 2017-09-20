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
        el : 'page-user-tool-cart',
        formClassError : 'md-input-danger',

        initialize: function() {
            AVTLIB.checkAll( this.el );
        },

    });
    new PAGE_USER_TOOL_CART;
    
})(jQuery);