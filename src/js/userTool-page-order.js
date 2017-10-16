/**
 * Handle page user Tool order
 *
 * @version 	1.0
 * @author 		HaLe
 */
(function($){
	"use strict";
	var AVT_USERT_ORDER = Backbone.View.extend({
		el : '#avt-userT-handle-order',

		formClassError : 'has-danger',

		events: {
			'submit #avt-userT-order-form' : 'handleForm',
		},

		initialize: function() {
			var self = this;
		},

		/**
		 * handleForm
		 * Handle form data before search.
		 * @return void
		 */
		handleForm: function( event ){
			var self 		= this,
				error 		= new Array();

			var formDate = $( 'input[name=avt_userT_order_date]', this.el );
			if( (0 !== formDate.val().length) && ( false === AVTLIB.validateDateSearch( formDate.val() )) ){
				formDate.parent().addClass( self.formClassError );
				error.push('date', 1);
			}else{
				formDate.parent().removeClass( self.formClassError );
				error.splice('date', 1);
			}
			
			if( 0 === error.length ){
				this.handleSearch( event );
				return false;
			}else{
				return false;
			}
		},
		/**
		 * handleSearch
		 * Handle search order
		 * @return void
		 */
		handleSearch: function( event ){
			var data = {
                formData: $('#avt-userT-order-form', this.el).serialize()
            },
            self = this;

            $(".avt-userT-orders-not-js",this.el).fadeOut();
	        $(".avt-userT-orders-js",this.el).fadeIn();

			// Send to server handle.
			$.get(AVTDATA.adminUrl + '/ajax-userT-order-manage', data, function(result) {
            	var dataResult = JSON.parse( result );
            	$(".avt-userT-orders-js", self.el).html( dataResult.output );
            });
		},

	});
	new AVT_USERT_ORDER;
	
})(jQuery);