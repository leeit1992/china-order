chrome.runtime.onMessage.addListener(
    function(request, sender, sendResponse) {
        switch (request.action)
        {
            case "getExchangeRate":
            case "addToCart":
            case "getCategory":
                sendAjaxRequest(request, sender);
                break;
            default :
                //todo
                break;

        }
    }
);

function sendAjaxRequest(request, sender){
    $.ajax({
        url: request.url,
        data: request.data == undefined ? {} : request.data,
        method: request.method == undefined ? 'GET' : request.method,
        contentType: 'application/x-www-form-urlencoded',
        xhrFields: {
            withCredentials: true
        },
        success: function(d){
			
            chrome.tabs.sendMessage(sender.tab.id, { action: request.callback, response: d }, function(response) {

            });
			var data = $.parseJSON(d);
			if(data.status == 'success' && data.message !='' && data.message != 'undefined') {
				alert(data.message);
			}
        },
        error: function(){
            alert("Xảy ra lỗi khi đặt hàng, vui lòng liên hệ CSKH để được hỗ trợ");
        }
    });

}
