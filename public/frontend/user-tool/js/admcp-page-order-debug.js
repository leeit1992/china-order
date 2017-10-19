/**
 * Handle page admcp order
 *
 * @version 	1.0
 * @author 		HaLe
 */
(function($){
	"use strict";

	var AVT_ADMCP_ORDER = Backbone.View.extend({
		el : '#avt-admcp-handle-order',

		formClassError : 'has-danger',

		events: {
			'submit #avt-admcp-order-form' : 'handleForm',
			'click .avt-price-kg-choose' : 'addPriceKg'
		},

		initialize: function() {
        	$(".avt-price-status").change(function(){
        		var $wrap = $(this).closest('.avt-group-item');
        		console.log($wrap);
        		if( 2 == $(this).val() ) {
        			$wrap.find(".avt-input-weight").hide();
        		}else{
        			$wrap.find(".avt-input-weight").show();
        		}
        		
        	})
        },

		/**
	     * Handle form data before search.
	     * @return void
	     */
		handleForm: function( event ){
			var self 		= this,
				error 		= new Array();

			var formCode = $( 'input[name=avt_admcp_order_code]', this.el );
			if( (0 !== formCode.val().length) && ( false === AVTLIB.validateStringSearch( formCode.val() )) ){
				formCode.parent().addClass( self.formClassError );
				error.push('code', 1);
			}else{
				formCode.parent().removeClass( self.formClassError );
				error.splice('code', 1);
			}

			var formDate = $( 'input[name=avt_admcp_order_date]', this.el );
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
                formData: $('#avt-admcp-order-form', this.el).serialize()
            },
            self = this;

            $(".avt-admcp-orders-not-js",this.el).fadeOut();
	        $(".avt-admcp-orders-js",this.el).fadeIn();

			// Send to server handle.
			$.get(AVTDATA.adminUrl + '/ajax-admcp-order-manage', data, function(result) {
            	var dataResult = JSON.parse( result );
            	$(".avt-admcp-orders-js", self.el).html( dataResult.output );
            });
		},

		addPriceKg: function(e) {
			var price = $(e.currentTarget).attr('data-price');
			var priceText = $(e.currentTarget).attr('data-text');
			var dataKey = $(e.currentTarget).attr('data-key');
			var weight = $(e.currentTarget).closest('.avt-item-order-form-' + dataKey).find('.avt-order-shop-weight').val();

			if( 0 != weight.length  ){
				var wrapPrice = $(e.currentTarget).closest('.avt-item-order-form-' + dataKey).find('.avt-price-kg').html(priceText);
				
				$(e.currentTarget).closest('.avt-item-order-form-' + dataKey).find('.avt-price-set-from-weight').val( price * weight);
			}else{
				alert('Số cân nặng phải lớn hơn 0.');
			}
			
			
			return false;
		}

	});
	new AVT_ADMCP_ORDER;
	
})(jQuery);