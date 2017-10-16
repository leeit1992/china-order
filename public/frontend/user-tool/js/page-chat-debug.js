(function($){
	"use strict";

	var AVT_CHAT = Backbone.View.extend({
		el : '#avt-form-chat',

		events: {
			'click #btn-send-chat' : 'clickSendChat',
			'keyup #btn-input-chat' : 'enterSendChat',
		},

		initialize: function() {
         
        },

        clickSendChat: function(e){
        	this.sendChat();
        },

        enterSendChat: function(e){
        	if(e.keyCode == 13){
        		this.sendChat();
		    }
        },

        sendChat: function(){
        	var mes = $('#btn-input-chat').val();
        	var output = '\
	    		<li class="right clearfix">\
                    <span class="chat-img pull-right">\
                        <img src="http://placehold.it/50/FA6F57/fff&amp;text=ME" alt="User Avatar" class="img-circle">\
                    </span>\
                    <div class="chat-body clearfix">\
                        <div class="header">\
                            <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>1 mins ago</small>\
                            <strong class="pull-right primary-font">Bhaumik Patel</strong>\
                        </div>\
                        <p>'+mes+'</p>\
                    </div>\
                </li>\
	    	';

	    	$(".chat").append(output);
	    	$(".card-body").animate({ scrollTop: $(".chat").height() }, 1);
	    	$('#btn-input-chat').val('');
        }

	});
	new AVT_CHAT;
	
})(jQuery);