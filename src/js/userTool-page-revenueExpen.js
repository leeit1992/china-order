/**
 * Handle page user Tool revenue Expen
 *
 * @version 	1.0
 * @author 		HaLe
 */
(function($){
	"use strict";
	var AVT_USERT_REVENUEEXPEN = Backbone.View.extend({
		el : '#avt-userT-handle-revenueExpen',

		formClassError : 'has-danger',

		events: {
			'submit #avt-userT-revenueExpen-form' : 'handleForm',
		},

		iinitialize: function() {
			var self = this;
		},

		/**
	     * Handle form data before search.
	     * @return void
	     */
		handleForm: function( event ){
			var self 		= this,
				error 		= new Array();

			var formDate = $( 'input[name=avt_userT_revenueExpen_date]', this.el );
			if( (0 !== formDate.val().length) && ( false === AVTLIB.validateDateSearch( formDate.val() )) ){
				formDate.parent().addClass( self.formClassError );
				error.push('date', 1);
			}else{
				formDate.parent().removeClass( self.formClassError );
				error.splice('date', 1);
			}
			
			var formCode = $( 'input[name=avt_userT_revenueExpen_code]', this.el );
			if( (0 !== formCode.val().length) && ( false === AVTLIB.validateStringSearch( formCode.val() )) ){
				formCode.parent().addClass( self.formClassError );
				error.push('code', 1);
			}else{
				formCode.parent().removeClass( self.formClassError );
				error.splice('code', 1);
			}

			if( 0 === error.length ){
				this.handleSearch( event );
				return false;
			}else{
				return false;
			}
		},
		/**
		 * handleForm
		 * Handle form search revenueExpen
		 * @return void
		 */
		handleSearch: function( event ){
			var data = {
                formData: $('#avt-userT-revenueExpen-form', this.el).serialize()
            },
            self = this;

            $(".avt-userT-revenueExpen-not-js",this.el).fadeOut();
	        $(".avt-userT-revenueExpen-js",this.el).fadeIn();

			// Send to server handle.
			$.get(AVTDATA.adminUrl + '/ajax-userT-revenueExpen-manage', data, function(result) {
            	var dataResult = JSON.parse( result );
            	$(".avt-userT-revenueExpen-js", self.el).html( dataResult.output );
            });
		},

	});
	new AVT_USERT_REVENUEEXPEN;
	
})(jQuery);