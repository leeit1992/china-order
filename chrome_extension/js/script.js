var exchange_rate = 3387;
var CommonTool = function() {
    this.addDisabledButtonCart = function(){
        $('#addToCart').attr("disabled","disabled");
    };

    this.removeDisabledButtonCart = function(){
        $('#addToCart').removeAttr("disabled");
    };

    this.htmlFormAddCart = function(){
        var _services_name = "";
        if(typeof services_name === 'undefined'){
            _services_name = "";
        }

        var html = '<li class="div-block-price-book" id="li_sd_price">' +
            '<h1 style="font-size: 22px;/* color: red; */color: rgb(232, 3, 3);' +
            'text-align: center;">Công Cụ Đặt Hàng '+_services_name+'</h1>' +
            '<div class="oqc-note" id="_box_input_exception" style="color: #111;">' +
            '<div class="note-imgv2"></div>' +
            '<div class="note-item"><span>Giá:</span><p><input type="text" id="_price" placeholder="Giá"></p></div>' +
            '<div class="note-item"><span>Thuộc tính:</span><p><textarea style="width: 100%" rows="3" id="_properties" ' +
            'placeholder="Nhập màu sắc, kích thước VD:Màu đen; Size 41" name="_properties"></textarea></p></div>' +
            '<div class="note-item"><span>Số lượng:</span><p><input type="text" id="_quantity" placeholder="Số lượng"></p></div>' +
                /* Div category*/
            '</div>' +
            '<div class="note-text"><p>Chú thích: </p>' +
            '<textarea cols="60" id="_comment_item" placeholder="Chú thích cho sản phẩm" ' +
            'name="_comment_item"></textarea>' +
            '</div><div class="xbTipBlock add-book"><div class="add-button" id="block_button_sd">' +
            '<button id="addToCart" type="button" style="border: none;cursor: pointer;font-size:15px">ĐẶT HÀNG</button>' +
            '<a href="'+cart_url+'" class="cart" target="_blank" style="border: none;cursor: pointer;font-size:15px;margin-left:10px;padding:10px;">VÀO GIỎ HÀNG</a>    ' +
            '</div></div>';

        var is_translate = this.getCookie("is_translate");
        var is_translate_first = 1;
        if(typeof translate_first === 'undefined' || translate_first === 0){
            is_translate_first = 0;
        }

        var version = "1.0";
        if(typeof version_tool === 'undefined'){
            version = "1.0";
        }else{
            version = version_tool;
        }

        /*
         if(parseInt(is_translate) == 1 || (is_translate === "" && is_translate_first == 1)){
         html += '<label><input type="checkbox" checked="checked" name="is_translate" class="_is_translate" id="_is_translate"/>Dịch sang tiếng Việt</label>';
         }else {
         html += '<label><input type="checkbox" name="is_translate" class="_is_translate" id="_is_translate"/>Dịch sang tiếng Việt</label>';
         }
         */

        html += '<p><span style="float: right;"><a style="color:blue" href="h#">Project 8</a><b> phiên bản '+version+'</b></span></p>';

        return html;
    };

    this.getOriginSite = function(){
        var url = window.location.href;
        url = url.replace("http://", "");
        url = url.replace("https://", "");
        var urlExplode = url.split("/");

        return urlExplode[0];
    };

    this.getHomeLand = function(){
        var url = window.location.href;
        if(url.match(/taobao/)){
            return "TAOBAO";
        }
        if(url.match(/tmall/)){
            return "TMALL";
        }
        if(url.match(/1688|alibaba/)){
            return "1688";
        }
        return null;
    };

    this.currency_format = function (num,rounding) {

        if(!$.isNumeric(num)){
            return num;
        }
        if(rounding === null){
            var roundingConfig = 10;
            num = Math.ceil(num / roundingConfig) * roundingConfig;
        }
        num = num.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");

        return (num );
    };
    this.getExchangeRate = function(){
        return exchange_rate;
    };
    this.trackError = function(link,error,TrackUrl){
        var param = "link="+link+"&error="+error+"&tool=bookmarklet";

        $.ajax({
            url : TrackUrl,
            type : "POST",
            data : param,
            success : function(data){

            }
        });
    };

    this.hasClass = function(element,$class){
        return (element.className).indexOf( $class) > -1;
    };

    this.resizeImage = function (image){
        return image.replace(/[0-9]{2,3}[x][0-9]{2,3}/g, '150x150');
    };

    this.getParamsUrl = function(name, link){
        var l = '';
        if(link) {
            l = link;
        } else {
            l = window.location.href;
        }
        if(l == '') return null;

        var results = new RegExp('[\\?&]' + name + '=([^&#]*)').exec(l);
        if (results === null) return null;

        return results[1] || 0;
    };
    this.processPrice = function(price,site){

        if (price == null || parseFloat(price) == 0)
            return 0;

        var p = 0;
        if(price.constructor === Array){
            p = String(price[0]).replace(',', '.').match(/[0-9]*[\.]?[0-9]+/g);
        }else{
            p = String(price).replace(',', '.').match(/[0-9]*[\.]?[0-9]+/g);
        }

        if(isNaN(p) || parseFloat(price) == 0){
            return 0;
        }

        var price_show = "";
        var pri = 0;
        if(price.constructor === Array && price.length > 1){
            var pri_start = this.currency_format(parseFloat(price[0]) * this.getExchangeRate());
            var key_end = price.length - 1;
            var pri_end = this.currency_format(parseFloat(price[key_end]) * this.getExchangeRate());

            if(parseFloat(price[key_end]) > 0){
                price_show = pri_start + " ~ " + pri_end;
            }else{
                price_show = pri_start;
            }

        }else{
            pri = parseFloat(price);
            price_show = this.currency_format(pri * this.getExchangeRate());
        }
        var li = document.createElement('li');
        var li_price = null;
        var J_PromoPrice = null;
        var J_StrPriceModBox = null;

        if(site == 'TMALL' || site == 'TAOBAO'){
            J_PromoPrice = document.getElementById('J_StrPrice');

            if(J_PromoPrice == null || J_PromoPrice.length == 0){
                J_PromoPrice = document.getElementById('J_priceStd');
            }

            if(J_PromoPrice == null || J_PromoPrice.length == 0){
                J_PromoPrice = document.getElementById('J_StrPriceModBox');
            }

            if(J_PromoPrice == null || J_PromoPrice.length == 0){
                J_PromoPrice = document.getElementById('J_PromoPrice');
            }

            if(site == "TAOBAO"){

                li.setAttribute("style",'color: blue ! important; padding: 30px 0px; font-family: arial;');

                li_price = '<span class="tb-property-type" style="color: blue; font-weight: bold; font-size: 25px;">Giá</span>     ' +
                '<strong id="price_vnd" class="" style="font-size: 25px;">' +
                '<em class=""> '+price_show+' </em><em class=""> VNĐ</em></strong>';
                li.innerHTML = li_price;
            }else{
                li.setAttribute("style",'font-weight: bold; padding: 10px 0px;');
                li.setAttribute("class",'tm-promo-price tm-promo-cur');

                li_price = '<strong id="price_vnd" class="" style="font-size: 30px;">' +
                '<span class="tm-price">Giá</span>' +
                '<em class="tm-price" style="font-size: 30px; margin-left: 10px;"> '+price_show+'  VNĐ </em></strong>';
                li.innerHTML = li_price;
            }

            if(J_PromoPrice != null || J_PromoPrice.length != 0){
                J_PromoPrice.parentNode.insertBefore(li, J_PromoPrice.nextSibling);
            }

        }

        return parseFloat(p);
    };
    this.sendAjaxToCart = function (add_cart_url,data) {
        chrome.runtime.sendMessage({
            action: "addToCart",
            url: add_cart_url,
            data: data,
            method: 'POST',
            callback: 'afterAddToCart'
        });


        //var common_tool = new CommonTool();
        //$.ajax({
        //    url: add_cart_url,
        //    data:data,
        //    type:'POST',
        //    contentType: 'application/x-www-form-urlencoded',
        //    xhrFields: {
        //        withCredentials: true
        //    },
        //    success:function(result) {
        //
        //        common_tool.removeDisabledButtonCart();
        //        if(result.html){
        //            $('body').append(result.html);
        //        }else{
        //            $('body').append(result);
        //        }
        //    },error:function(){
        //        common_tool.removeDisabledButtonCart();
        //    }
        //});
        return true;
    };
    this.loadJsFile = function(jsUrl){
        var file_ali = document.createElement('script');
        file_ali.setAttribute('src', jsUrl+'?t=' + Math.random());
        document.body.appendChild(file_ali);
        return true;
    };
    this.key_translate_lib = function (key) {
        var translate = [];
        translate['颜色'] = 'Màu';
        translate['尺码'] = 'Kích cỡ';
        translate['尺寸'] = 'Kích cỡ';

        translate['价格'] = 'Giá';
        translate['促销'] = 'Khuyến mại';
        translate['配送'] = 'Vận Chuyển';
        translate['数量'] = 'Số Lượng';
        translate['销量'] = 'Chính sách';
        translate['评价'] = 'Đánh Giá';
        translate['颜色分类'] = 'Màu sắc';
        translate['促销价'] = 'Giá';

        translate['套餐类型'] = 'Loại';
        translate['单价（元）'] = 'Giá (NDT)';
        translate['库存量'] = 'Tồn kho';
        translate['采购量'] = 'SL mua';
        var detect = key;
        if(translate[key]) {
            detect = translate[key];
        }
        return detect;
    };
    this.stripTags = function (object) {
        if( typeof object == 'object') {
            return object.replaceWith( object.html().replace(/<\/?[^>]+>/gi, '') );
        }
        return false;
    };

    this.setIsTranslateToCookie = function(element){

        if(element.prop('checked')){
            this.setCookie("is_translate",1,100);
        }else{
            this.setCookie("is_translate",0,100);
        }
        return true;
    };

    this.translate_title =  function (title, type, object) {
        return false;
        var is_translate = this.getCookie("is_translate");
        if(parseInt(is_translate) == 1 && 1 == 2){
            $.ajax ({
                url: translate_url,
                type:'post',
                contentType: 'application/x-www-form-urlencoded',
                xhrFields: {
                    withCredentials: true
                },
                data:{
                    text:title,
                    type:type
                },
                success:function (data) {
                    var result = $.parseJSON(data);

                    object.set_translate({title:result['data_translate']});
                },error: function(){
                    console.log("error translate");
                }
            });
            return true;
        }
        return false;
    };

    this.translate = function(dom,type){
        var is_translate = this.getCookie("is_translate");
        if(parseInt(is_translate) == 1){
            if(type == "properties"){
                this.translateStorage(dom);
            }
        }
    };

    this.translateStorage = function(dom){
        try{
            var content = dom.text();
            var content_origin = content;
            var resource = keyword;
            if(resource != null){
                var data = resource.resource;

                for (var i = 0; i < data.length; i++) {
                    var obj = data[i];
                    try{
                        if(content.match(obj.k_c,'g')){
                            content = content.replace(obj.k_c, obj.k_v+ ' ');
                        }
                    }catch(ex){
                        try{
                            if(content.match(obj.keyword_china,'g')){
                                content = content.replace(obj.keyword_china, obj.keyword_vi+ ' ');
                            }
                        }catch(ex){

                        }

                    }
                }
                dom.text(content);
                dom.attr('data-text',content_origin);
            }
        }catch(ex){
            console.log("error");
        }
    };

    this.ajaxTranslate = function(dom,type){
        var context = dom.text();

        $.ajax({
            url : translate_url,
            type : "POST",
            contentType: 'application/x-www-form-urlencoded',
            xhrFields: {
                withCredentials: true
            },
            data : {
                text: context,
                type: type
            },
            success : function(data){
                var result = $.parseJSON(data);
                if(result['data_translate'] && result['data_translate'] !=null) {
                    dom.attr("data-text",dom.text());
                    dom.text(result['data_translate']);
                }
            }
        });
    };

    this.getKeywordSearch = function(){
        $.ajax({
            url : translate_keyword_url,
            type : "POST",
            contentType: 'application/x-www-form-urlencoded',
            xhrFields: {
                withCredentials: true
            },
            data : {
                text: "text",
                type: "type"
            },

            success : function(data){
                var resource = JSON.stringify(data);
                localStorage.setItem("keyword_search",resource);
            }
        });
        return true;
    };

    /* Hiển thị input khi xảy ra lỗi lấy dữ liệu*/
    this.showInputEx = function(site){
        var box_input_exception = $('#_box_input_exception');
        box_input_exception.show();
        box_input_exception.attr("data-is-show",1);

        var price_dom = $('#_price');

        var object = new factory(cart_url,add_to_cart_url);
        var price_origin = object.getPriceInput();
        var properties_origin = object.getPropertiesInput();
        var quantity = object.getQuantityInput();
        console.log(quantity+'_'+properties_origin+'_'+price_origin);
        if(quantity == "" && properties_origin == "" && price_origin == ""){
            alert("Chúng tôi không thể lấy được thông tin của sản phẩm." +
            "Bạn vui lòng điền thông tin để chúng tôi mua hàng cho bạn");
            price_dom.focus();
            try{
                if(site != 'alibaba'){
                    if(parseFloat(object.getPromotionPrice()) > 0 ){
                        price_dom.val(object.getPromotionPrice());
                    }else{
                        price_dom.attr("placeholder","Nhập số tiền tệ - Trung Quoc");
                    }
                    $('#_properties').val(object.getPropertiesOrigin());
                    $('#_quantity').val(object.getQuantity());
                }
            }catch(ex){
                console.log(ex);
            }
        }
        return true;
    };

    this.setCookie = function(cname,cvalue,exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires=" + d.toGMTString();
        document.cookie = cname+"="+cvalue+"; "+expires;
        return true;
    };

    this.getCookie = function(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i=0; i<ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1);
            if (c.indexOf(name) != -1) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    };
};

var factory = function (cart_url,add_cart_url) {
    var common_tool = new CommonTool();
    var origin_site = common_tool.getOriginSite();

    var _class;

    if(origin_site.match(/1688.com/)) {
        _class = new alibaba(cart_url,add_cart_url);
    }else if(origin_site.match(/taobao.com/)){
        _class = new taobao(cart_url);
    }else if(origin_site.match(/tmall.com/)){
        _class = new tmall(cart_url);
    }
    return _class;
};


/**
 * Created by Admin on 9/19/14.
 */
var AddonTool = function(){
    /**
     * item_data: Array
     * keys: amount, color, size
     */
    this.common_tool = new CommonTool();

    /*Cho vào giỏ hàng đối với Tmall và taobao*/
    this.AddToCart = function () {
        /* chuẩn bị dữ liệu */

        var error = 0;

        var object = new factory(cart_url,add_to_cart_url);

        var is_show = $('#_box_input_exception').attr("data-is-show");

        var price_origin = '',
            price_promotion = '',
            properties_translated = '',
            properties_origin = '',
            quantity = '',
            shop_id = '',
            image_origin = '',
            shop_name= '',
            title_origin = '',
            title_translate = '';

        var check_select = object.checkSelectFull();

        if(!check_select){
            alert("Yêu cầu chọn đầy đủ thuộc tính");
            this.common_tool.removeDisabledButtonCart();
            return false;
        }

        image_origin = object.getImgLink();

        shop_id = object.getSellerId();

        shop_name = object.getSellerName();

        shop_wangwang = object.getWangwang();

        if(shop_wangwang == ''){
            shop_wangwang = shop_name;
        }

        title_origin = object.getTitleOrigin();
        title_translate = object.getTitleTranslate();

        comment = object.getCommentInput();

        link_origin = window.location.href;
        item_id = object.getItemID();

        data_value = object.getDataValue();
        outer_id = object.getOuterId(data_value);

        if($.isArray(outer_id)){
            outer_id = outer_id[0];
        }

        site = this.common_tool.getHomeLand();

        stock = object.getStock();

        if(!$.isNumeric(stock) || parseInt(stock) <= 0 ){
            stock = 99;
        }

        try{
            price_origin = object.getOriginPrice();
            price_promotion = object.getPromotionPrice();

            if($.isArray(price_origin)){
                price_origin = price_origin[0];
            }

            if($.isArray(price_promotion)){
                price_promotion = price_promotion[0];
            }
            properties_translated = object.getProperties();
            properties_origin = object.getPropertiesOrigin();
            quantity = object.getQuantity();
        }catch(ex){
            error = 1;
            price_origin = price_promotion = object.getPriceInput();
            properties_origin = properties_translated = object.getPropertiesInput();
            quantity = object.getQuantityInput();
        }

        if(!((parseFloat(price_origin) > 0 || parseFloat(price_promotion) > 0) && parseFloat(quantity) > 0 )){
            error = 1;
            price_origin = price_promotion = object.getPriceInput();
            properties_origin = properties_translated = object.getPropertiesInput();
            quantity = object.getQuantityInput();
        }

        /**
         * Trong trường hợp xảy ra lỗi đối với Gia, So luong,properties sẽ show form để khách hàng tự động nhập
         */
        if((error && parseFloat(is_show) != 1) || !(parseFloat(is_show) == 1
            || parseInt(price_promotion) > 0 || parseInt(price_origin) > 0)){
            this.common_tool.showInputEx();
            this.common_tool.removeDisabledButtonCart();
            return false;
        }

        if(!((parseFloat(price_origin) > 0 || parseFloat(price_promotion) > 0) && parseFloat(quantity) > 0 ) && parseFloat(is_show) == 1){
            alert("Yêu cầu bổ sung thông tin.");
            $('#_price').focus();
            this.common_tool.removeDisabledButtonCart();
            return false;
        }

        if(!$.isNumeric(price_promotion) && parseFloat(is_show) == 1){
            alert("Nhập giá của sản phẩm.");
            $('#_price').focus();
            this.common_tool.removeDisabledButtonCart();
            return false;
        }


        var data = {
            title_origin: $.trim(title_origin),
            title_translated: $.trim(title_translate),
            price_origin: price_origin,
            price_promotion: price_promotion,
            property_translated: properties_translated,
            property: properties_origin,
            data_value: data_value,
            image_model: image_origin,
            image_origin: image_origin,
            shop_id: shop_id,
            shop_name: shop_name,
            wangwang: shop_wangwang,
            quantity: quantity,
            stock:stock,
            site: site,
            comment:comment,
            item_id:item_id,
            link_origin:link_origin,
            outer_id:outer_id,
            error : error,
            weight:0,
            step:1,
            tool: "Addon"
        };

        this.common_tool.sendAjaxToCart(add_to_cart_url,data);
    };
};

var taobao =  function(cart_url) {
    this.source = 'taobao';
    this.common_tool = new CommonTool();
    this.init = function () {
        $('#detail').css('border','1px solid red');
        $('#detail').css('font-size','11px');
        $('.tb-rmb').remove();

        this.parse();
    };
    this.parse = function () {

        var common = this.common_tool;
        $('.tb-property-type').each(function (index, value) {
            var text = $(this).text();
            $(this).text(common_tool.key_translate_lib(text));
        });

        var html = common.htmlFormAddCart();

        $('body').append(
            html );

        var price = this.getPromotionPrice("TAOBAO");
        var price_html = '<p style="font-size: 20px;margin-top: 15px;color: orange;font-weight: bold;">Tỉ giá: 1NDT = '+
            common.currency_format(common.getExchangeRate(),false)+' VNĐ</p>';
        var j_str_price = $('#J_StrPriceModBox');
        if(j_str_price == null || j_str_price == "" || (typeof j_str_price === 'object' && j_str_price.length == 0)){
            j_str_price = $('.tm-promo-price');
        }

        if(j_str_price == null || j_str_price == "" || (typeof j_str_price === 'object' && j_str_price.length == 0)){
            j_str_price = $('.tb-detail-hd');
        }
        if(j_str_price == null || j_str_price == "" || (typeof j_str_price === 'object' && j_str_price.length == 0)){
            j_str_price = $('#J_PromoPrice');
        }

        if(j_str_price != null && j_str_price != ""){
            j_str_price.append(price_html);
        }

        var title_content = this.getTitleOrigin();

        /*common.translate_title(title_content,'title', this);

         this.translateProperties();*/

        return false;
    };

    this.translateProperties = function(){
        var common = this.common_tool;
        var span_pro = $('.J_TSaleProp li span');
        if(span_pro == null || span_pro.length == 0){
            span_pro = $('.J_SKU a span');
        }
        span_pro.each(function() {
            common.translate($(this),"properties");
        });
    };

    this.getPriceInput = function(){
        return $('#_price').val();
    };

    this.getPropertiesInput = function(){
        return $('#_properties').val();
    };

    this.getQuantityInput = function(){
        return $('#_quantity').val();
    };

    this.getCommentInput = function(){
        return $('#_comment_item').val();
    };

    this.set_translate = function(data) {
        var _title = this.getDomTitle();

        if(_title != null && data.title != ""){
            _title.setAttribute("data-text",_title.textContent);
            _title.textContent = data.title;
        }
    };

    this.getPromotionPrice = function(site){
        try{
            var span_price = null;
            var normal_price = document.getElementById('J_StrPrice');

            if(normal_price == null){
                normal_price = document.getElementById("J_priceStd");
            }

            if(normal_price == null) {
                normal_price = document.getElementById('J_StrPriceModBox');
            }

            if(normal_price == null){
                normal_price = document.getElementById('J_PromoPrice');
            }

            var promotion_price = document.getElementById('J_PromoPrice');

            var price = 0;
            if(promotion_price == null){
                promotion_price = normal_price;
            }
            if(promotion_price != null) {
                try{
                    if(promotion_price.getElementsByClassName('tm-price').length > 0) {
                        span_price = promotion_price.getElementsByClassName('tm-price');
                        if(span_price != null && span_price != "" && span_price != "undefined"){
                            price = span_price[0].textContent.match(/[0-9]*[\.,]?[0-9]+/g);
                        }
                    }else if(promotion_price.getElementsByClassName('tb-rmb-num').length > 0){
                        span_price = promotion_price.getElementsByClassName('tb-rmb-num');
                        if(span_price != null && span_price != "" && span_price != "undefined"){
                            price = span_price[0].textContent.match(/[0-9]*[\.,]?[0-9]+/g);
                        }
                    }
                }catch(e){
                    price = 0;
                }

            }

            return this.common_tool.processPrice(price,site);
        }catch(ex){
            throw Error(ex.message+ " Line:" +ex.lineNumber + " function getPromotionPrice");
        }
    };

    this.getStock = function(){
        try{
            var stock_id = document.getElementById('J_EmStock');
            var stock = 99;
            if(stock_id == null || stock_id == 'undefined'){
                stock_id = document.getElementById("J_SpanStock");
            }

            if(stock_id != null && stock_id != 'undefined'){
                stock = stock_id.textContent;
                stock = parseInt(stock.replace(/[^\d.]/g, ''));
            }
        }catch(ex){
            stock = 99;
        }


        return stock;
    };

    this.getOriginPrice = function(){
        try{
            var str_price = $('#J_StrPrice');
            var origin_price = str_price.find('.tm-price');

            if(origin_price == null || origin_price.length == 0){
                origin_price = str_price.find('.tb-rmb-num');
            }

            if(origin_price == null || origin_price.length == 0){
                origin_price = $('#J_priceStd').find('.tb-rmb-num');
            }

            if(origin_price == null || origin_price.length == 0){
                origin_price = $('#J_priceStd').find('.tm-price');
            }

            if(origin_price == null || origin_price.length == 0){
                origin_price = $('#J_StrPriceModBox').find('.tm-price');
            }

            if(origin_price == null || origin_price.length == 0){
                origin_price = $('#J_StrPriceModBox').find('.tb-rmb-num');
            }

            if(origin_price == null || origin_price.length == 0){
                origin_price = $('#J_PromoPrice').find('.tm-price');
            }

            if(origin_price == null || origin_price.length == 0){
                origin_price = $('#J_PromoPrice').find('.tb-rmb-num');
            }

            var price = origin_price.text();
            price = price.match(/[0-9]*[\.,]?[0-9]+/g);

            return this.common_tool.processPrice(price);
        }catch(ex){
            throw Error(ex.message+ " Can't get origin price function getOriginPrice");
        }
    };

    this.getOuterId = function(data_value){
        try{
            var scripts = document.getElementsByTagName('script');
            var skuId = "";
            var skuMap = null;
            if(scripts.length > 0) {
                for(var script = 0; script < scripts.length; script++) {
                    if(scripts[script].innerHTML.match(/Hub\.config\.set/)) {
                        try{
                            detailJsStart();
                            skuId = Hub.config.get('sku').valItemInfo.skuMap[";"+data_value+";"].skuId;
                        }catch(e){
                            skuMap = scripts[script].innerHTML.replace(/\s/g, '').substr(scripts[script].innerHTML.replace(/\s/g, '').indexOf(data_value) , 60);
                            skuId = skuMap.substr(skuMap.indexOf('skuId') + 8, 15).match(/[0-9]+/);
                        }
                    }else if(scripts[script].innerHTML.match(/TShop\.Setup/)){
                        skuMap = scripts[script].innerHTML.replace(/\s/g, '').substr(scripts[script].innerHTML.replace(/\s/g, '').indexOf(data_value) , 60);
                        skuId = skuMap.substr(skuMap.indexOf('skuId') + 8, 15).match(/[0-9]+/);
                    }
                }
            }

            return skuId;
        }catch(ex){
            return "";
        }
    };

    this.getTitleTranslate = function(){
        try{
            var _title = this.getDomTitle();
            var title_translate = _title.textContent;
            if(title_translate == ""){
                title_translate = _title.getAttribute("data-text");
            }
            return title_translate;
        }catch(ex){
            return "";
        }

    };

    this.getTitleOrigin = function(){

        try{
            var _title = this.getDomTitle();
            var title_origin = _title.getAttribute("data-text");
            if(title_origin == "" || typeof title_origin == "undefined" || title_origin == null){
                title_origin = _title.textContent;
            }
            return title_origin;
        }catch(ex){
            return "";
        }

    };

    this.getDomTitle = function(){
        try{
            var _title = null;
            if (document.getElementsByClassName("tb-main-title").length > 0) {
                _title =  document.getElementsByClassName("tb-main-title")[0];
            }

            if (_title == null && document.getElementsByClassName("tb-detail-hd").length > 0) {
                var h = document.getElementsByClassName("tb-detail-hd")[0];
                if (h.getElementsByTagName('h3').length > 0 && h != null) {
                    _title = h.getElementsByTagName('h3')[0];
                }else{
                    _title = h.getElementsByTagName("h1")[0];
                }
            }

            if (_title.textContent == "" && document.getElementsByClassName("tb-tit").length > 0) {
                _title = document.getElementsByClassName("tb-tit")[0];
            }
            if (_title.textContent == "") {
                _title = document.querySelectorAll('h3.tb-item-title');
                if (_title != null) {
                    _title = _title[0];
                }else{
                    _title = document.getElementsByClassName('tb-item-title');
                    if(_title.length > 0){
                        _title = _title[0];
                    }
                }
            }
            return _title;
        }catch(ex){
            return null;
        }
    };

    this.getSellerName = function(){
        try{
            var seller_name = '';
            if(document.getElementsByClassName('tb-seller-name').length > 0){
                seller_name = document.getElementsByClassName('tb-seller-name')[0].textContent;

                if(seller_name == '' || seller_name == null) {

                    var shop_card = document.getElementsByClassName('shop-card');
                    var data_nick = shop_card.length > 0 ? shop_card[0].getElementsByClassName('ww-light') : '';
                    seller_name = (data_nick.length > 0 ? data_nick[0].getAttribute('data-nick') : '');
                    if(seller_name == '') {
                        /* Find base info*/
                        if( document.getElementsByClassName('base-info').length > 0) {
                            for(var i =0; i < document.getElementsByClassName('base-info').length; i++) {
                                if(document.getElementsByClassName('base-info')[i].getElementsByClassName('seller').length > 0) {
                                    if(document.getElementsByClassName('base-info')[i].getElementsByClassName('seller')[0].getElementsByClassName('J_WangWang').length > 0) {
                                        seller_name = document.getElementsByClassName('base-info')[i].getElementsByClassName('seller')[0].getElementsByClassName('J_WangWang')[0].getAttribute('data-nick');
                                        break;
                                    }
                                    if(document.getElementsByClassName('base-info')[i].getElementsByClassName('seller')[0].getElementsByClassName('ww-light').length > 0) {
                                        seller_name = document.getElementsByClassName('base-info')[i].getElementsByClassName('seller')[0].getElementsByClassName('ww-light')[0].getAttribute('data-nick');
                                        break;
                                    }
                                }
                            }
                        }
                    }
                }
            }else if($('#J_tab_shopDetail').length > 0){
                seller_name = $('#J_tab_shopDetail').find('span').first().attr('data-nick');
            }
            seller_name = seller_name.trim();
            return seller_name;
        }catch(ex){
            return "";
        }

    };

    this.getSellerId = function(){
        try{
            var seller_id = '';
            var url = '';

            var url_shop = "";

            var supplier = document.querySelectorAll('.tb-shop-name');
            if (supplier.length > 0) {
                url_shop = supplier[0].getElementsByTagName("a")[0];
            } else {
                supplier = document.querySelectorAll('div.shop-card');
                if (supplier.length > 0) {
                    url_shop = supplier[0].getElementsByTagName("p")[0].getElementsByTagName("a")[0];
                }
            }

            if(!((typeof supplier !== 'object' && supplier != "" && supplier != null)
                || (typeof supplier === 'object' && supplier.length > 0))){
                supplier = document.getElementsByClassName('hd-shop-name');
                if((typeof supplier !== 'object' && supplier != "" && supplier != null)
                    || (typeof supplier === 'object' && supplier.length > 0)){
                    url_shop = supplier[0].getElementsByTagName("a")[0];
                }
            }

            if(!((typeof supplier !== 'object' && supplier != "" && supplier != null)
                || (typeof supplier === 'object' && supplier.length > 0))){
                supplier = document.querySelectorAll('span.shop-name');
                if (supplier.length > 0 && supplier != null) {
                    url_shop = supplier[0].getElementsByTagName("a")[0];
                }else{
                    supplier = document.querySelectorAll('div.shop-card');
                    if (supplier.length > 0 && supplier != null) {
                        url_shop = supplier[0].getElementsByTagName("p")[0].getElementsByTagName("a")[0];
                    }else{
                        supplier = document.querySelectorAll('a.slogo-shopname');
                        if(supplier.length > 0 && supplier != null){
                            url_shop = supplier[0];
                        }else{
                            supplier = document.querySelectorAll("div#side-shop-info");
                            if((typeof supplier !== 'object' && supplier != "" && supplier != null)
                                || (typeof supplier === 'object' && supplier.length > 0)){
                                supplier = supplier[0].getElementsByClassName('shop-intro')[0];
                                url_shop = supplier.getElementsByTagName("a");
                                url_shop = url_shop[0];
                            }
                        }
                    }
                }
            }

            if(url_shop != null && url_shop != ""){
                url = url_shop.getAttribute('href');
                seller_id = url.split('.')[0];
                if(seller_id.match(/http:\/\//)){
                    seller_id = seller_id.split('http://')[1];
                }else if(seller_id.match(/\/\//)){
                    seller_id = seller_id.split('//')[1];
                }
            }

            return seller_id;
        }catch(ex){
            return "";
        }
    };

    this.getProperties = function(){
        try{
            var selected_props = document.getElementsByClassName('J_TSaleProp');

            var color_size = '';

            if(!((typeof selected_props != 'object' && selected_props != "" && selected_props != null)
                || (typeof selected_props === 'object' && selected_props.length > 0))){

                selected_props = document.querySelectorAll("ul.tb-cleafix");
            }

            if(selected_props.length > 0 && selected_props != null) {
                for(var i = 0; i < selected_props.length; i++) {
                    var li_origin = selected_props[i].getElementsByClassName('tb-selected')[0];

                    if(li_origin != null){
                        var c_s = li_origin.getElementsByTagName('span')[0].getAttribute("data-text");
                        if(c_s == "" || c_s == null || typeof c_s == "undefined"){
                            c_s = li_origin.getElementsByTagName('span')[0].textContent;
                        }
                        color_size+=c_s+';';
                    }
                }
            }

            return color_size;
        }catch(ex){
            throw Error(ex.message+ " Can't get origin price function getPropertiesOrigin");
        }
    };

    this.getPropertiesOrigin = function(){
        try{
            var selected_props = document.getElementsByClassName('J_TSaleProp');
            var color_size = '';

            if(!((typeof selected_props !== 'object' && selected_props != "" && selected_props != null)
                || (typeof selected_props === 'object' && selected_props.length > 0))){
                selected_props = document.querySelectorAll("ul.tb-cleafix");
            }
            if(selected_props.length > 0) {
                for(var i = 0; i < selected_props.length; i++) {
                    var li_origin = selected_props[i].getElementsByClassName('tb-selected')[0];
                    if(li_origin != null){
                        var c_s = li_origin.getElementsByTagName('span')[0].getAttribute("data-text");
                        if(c_s == "" || c_s == null || typeof c_s == "undefined"){
                            c_s = li_origin.getElementsByTagName('span')[0].textContent;
                        }
                        color_size+=c_s+';';
                    }
                }
            }
            return color_size;
        }catch(ex){
            throw Error(ex.message+ " Can't get origin price function getPropertiesOrigin");
        }

    };

    this.getDataValue = function(){
        try{
            var selected_props = document.getElementsByClassName('J_TSaleProp');
            var data_value = '';
            if(selected_props.length > 0) {
                for(var i = 0; i < selected_props.length; i++) {
                    var li_origin = selected_props[i].getElementsByClassName('tb-selected')[0];

                    data_value+= ";"+li_origin.getAttribute('data-value');
                }
            }
            if(data_value.charAt(0) == ';'){
                data_value = data_value.substring(1,data_value.length);
            }
            return data_value;
        }catch(ex){
            return "";
        }

    };

    this.getWangwang = function(){
        try{
            var wangwang = "";

            var span_wangwang = $('.tb-shop-ww .ww-light');

            if(span_wangwang != null && span_wangwang != '' && span_wangwang.length > 0){
                wangwang = span_wangwang.attr('data-nick');
            }

            if(wangwang == ''){
                span_wangwang = document.querySelectorAll("span.seller");

                if(span_wangwang == null || span_wangwang == "" || span_wangwang == "undefined" || span_wangwang.length == 0){
                    var div_wangwang = document.getElementsByClassName('slogo-extraicon');
                    if(div_wangwang != null && div_wangwang != "" && div_wangwang != "undefined" && div_wangwang.length > 0){
                        span_wangwang = div_wangwang[0].getElementsByClassName("ww-light");
                    }
                }

                if(span_wangwang == null || span_wangwang == '' || span_wangwang.length == 0){
                    span_wangwang = document.querySelectorAll("div.hd-shop-desc span.ww-light");
                }


                if(span_wangwang.length > 0){
                    var sp_wangwang = span_wangwang[0].getElementsByTagName("span");
                    if(sp_wangwang != null && sp_wangwang != '' && sp_wangwang.length == 0){
                        wangwang = decodeURIComponent(sp_wangwang[0].getAttribute('data-nick'));
                    }else{
                        wangwang = decodeURIComponent(span_wangwang[0].getAttribute('data-nick'));
                    }
                }
            }
        }catch(ex){
            wangwang = "";
        }
        return wangwang;
    };

    this.checkSelectFull = function(){
        var props = document.getElementsByClassName('J_TSaleProp');
        if(!((typeof props != 'object' && props != "" && props != null)
            || (typeof props === 'object' && props.length > 0))){

            props = document.querySelectorAll("ul.tb-cleafix");
        }
        var full = true;
        if (props.length > 0) {
            /*            kiem tra so thuoc tinh da chon cua sp*/
            var count_selected = 0;
            for (var i = 0; i < props.length; i++) {
                var selected_props = props[i].getElementsByClassName('tb-selected');
                if (selected_props != null && selected_props != 'undefined')
                    count_selected += selected_props.length;
            }
            if (count_selected < props.length) {
                full = false;
            }

        }
        return full;
    };

    this.getQuantity = function(){
        try{
            var quantity = '';
            var element = document.getElementById("J_IptAmount");
            if (element) {
                quantity = element.value;
            } else quantity = '';

            if (quantity == '') {
                try {
                    quantity = document.getElementsByClassName('mui-amount-input')[0].value;
                } catch (e) {
                    console.log(e);
                }
            }

            return quantity;
        }catch(ex){
            throw Error(ex.message+ " Can't get origin price function getQuantity");
        }

    };

    this.getImgLink = function() {
        try{
            var img_src = "";
            try {
                var img_obj = document.getElementById('J_ImgBooth');
                if (img_obj != null) {
                    img_src = img_obj.getAttribute("src");
                    img_src = this.common_tool.resizeImage(img_src);
                    return encodeURIComponent(img_src);
                }

                img_obj = document.getElementById('J_ThumbView');

                if(img_obj != null && img_obj != ""){
                    img_src = img_obj.getAttribute("src");
                    img_src = this.common_tool.resizeImage(img_src);
                    return encodeURIComponent(img_src);
                }

                if (document.getElementById('J_ImgBooth').tagName == "IMG") {

                    var thumbs_img_tag = document.getElementById('J_UlThumb');
                    try {
                        if (thumbs_img_tag != null) {
                            img_src = thumbs_img_tag.getElementsByTagName("img")[0].src;
                        } else {
                            img_src = document.getElementById('J_ImgBooth').src;
                        }
                    } catch (e) {
                        console.log(e);
                    }
                } else {
                    /*                   Find thumb image*/
                    var thumbs_a_tag = document.getElementById('J_UlThumb');
                    if (thumbs_a_tag != null) {
                        img_src = thumbs_a_tag.getElementsByTagName("li")[0].style.backgroundImage.replace(/^url\(["']?/, '').replace(/["']?\)$/, '');
                    } else {
                        img_src = document.getElementById('J_ImgBooth').style.backgroundImage.replace(/^url\(["']?/, '').replace(/["']?\)$/, '');
                    }
                }

            } catch (e) {
                console.log("Image not found!" + e);
            }

            img_src = this.common_tool.resizeImage(img_src);
            return encodeURIComponent(img_src);
        }catch(ex){
            return "";
        }

    };


    this.getItemID = function(){
        try{
            var home = window.location.href;
            var item_id = this.common_tool.getParamsUrl('id',home);
            var dom_id = document.getElementsByName("item_id");
            if(item_id <= 0 || !$.isNumeric(item_id)){
                if (dom_id.length > 0) {
                    dom_id = dom_id[0];
                    item_id = dom_id.value;
                } else item_id = 0;

                if (item_id == 0 || item_id == null || item_id == '') {
                    dom_id = document.getElementsByName("item_id_num");
                    if (dom_id.length > 0) {
                        dom_id = dom_id[0];
                        item_id = dom_id.value;
                    } else item_id = 0;
                }
            }

            if(parseInt(item_id) <= 0 || !$.isNumeric(item_id)){
                item_id = home.split('.htm')[0];
                item_id = item_id.split('item/')[1];
            }

            return item_id;
        }catch(ex){
            return 0;
        }

    };
};

var tmall =  function(cart_url) {
    this.source = 'tmall';
    this.common_tool = new CommonTool();
    this.init = function (){
        $('#detail').css(
            'border','2px solid orange');
        this.parse();
    };

    this.parse = function () {

        var common = this.common_tool;
        $('.tb-metatit').each(function () {
            var text = $(this).text();
            $(this).text(common.key_translate_lib(text));
        });

        var html = common.htmlFormAddCart();

        $('body').append(
            html );

//        $('.tm-delivery-panel').hide();
//        $('.mui-amount-unit').hide();
//        $('.tm-bar-panel').html('');
        $('#J_ButtonWaitWrap').hide();

        var price_html = '<p style="font-size: 20px;margin-top: 15px;color: orange;font-weight: bold;">Tỉ giá: 1NDT = '+
            common.currency_format(common.getExchangeRate(),false)+' VNĐ</p>';
        this.getPromotionPrice("TMALL");
        var tb_detail_hd =  $('.tb-detail-hd');
        if(tb_detail_hd != null && tb_detail_hd != ""){
            tb_detail_hd.append(price_html);
        }else{
            $('.tb-btn-buy').html(price_html);
        }
        var title_content = this.getTitleOrigin();

        common.translate_title(title_content,'title', this);

        this.translateProperties();

        return false;
    };

    this.set_translate = function(data) {
        var _title = this.getDomTitle();

        if(_title != null && data.title != ""){
            _title.setAttribute("data-text",_title.textContent);
            _title.textContent = data.title;
        }
    };

    this.translateProperties = function(){
        var common = this.common_tool;

        $('.J_TSaleProp li span').each(function() {
            common.translate($(this),"properties");
        });
    };

    this.getPriceInput = function(){
        return $('#_price').val();
    };

    this.getPropertiesInput = function(){
        return $('#_properties').val();
    };

    this.getQuantityInput = function(){
        return $('#_quantity').val();
    };

    this.getCommentInput = function(){
        return $('#_comment_item').val();
    };

    this.checkSelectFull = function(){
        var props = document.getElementsByClassName('J_TSaleProp');
        if(!((typeof props != 'object' && props != "" && props != null)
            || (typeof props === 'object' && props.length > 0))){

            props = document.querySelectorAll("ul.tb-cleafix");
        }
        var full = true;
        if (props.length > 0) {
            var count_selected = 0;
            for (var i = 0; i < props.length; i++) {
                var selected_props = props[i].getElementsByClassName('tb-selected');
                if (selected_props != null && selected_props != 'undefined')
                    count_selected += selected_props.length;
            }
            if (count_selected < props.length) {
                full = false;
            }
        }
        return full;
    };

    this.getPromotionPrice = function(site){
        try{
            var span_price = null;
            var normal_price = document.getElementById('J_StrPrice');

            if(normal_price == null){
                normal_price = document.getElementById("J_priceStd");
            }

            if(normal_price == null) {
                normal_price = document.getElementById('J_StrPriceModBox');
            }

            if(normal_price == null){
                normal_price = document.getElementById('J_PromoPrice');
            }

            var promotion_price = document.getElementById('J_PromoPrice');

            var price = 0;
            if(promotion_price == null){
                promotion_price = normal_price;
            }
            if(promotion_price != null) {
                try{
                    if(promotion_price.getElementsByClassName('tm-price').length > 0) {
                        span_price = promotion_price.getElementsByClassName('tm-price');
                        if(span_price != null && span_price != "" && span_price != "undefined"){
                            price = span_price[0].textContent.match(/[0-9]*[\.,]?[0-9]+/g);
                        }
                    }else if(promotion_price.getElementsByClassName('tb-rmb-num').length > 0){
                        span_price = promotion_price.getElementsByClassName('tb-rmb-num');
                        if(span_price != null && span_price != "" && span_price != "undefined"){
                            price = span_price[0].textContent.match(/[0-9]*[\.,]?[0-9]+/g);
                        }
                    }
                }catch(e){
                    price = 0;
                }

            }
            return this.common_tool.processPrice(price,site);
        }catch(ex){
            throw Error(ex.message+ " Line:" +ex.lineNumber + " function getPromotionPrice");
        }
    };

    this.getOriginPrice = function(){
        try{
            var str_price = $('#J_StrPrice');
            var origin_price = str_price.find('.tm-price');

            if(origin_price == null || origin_price.length == 0){
                origin_price = str_price.find('.tb-rmb-num');
            }

            if(origin_price == null || origin_price.length == 0){
                origin_price = $('#J_priceStd').find('.tb-rmb-num');
            }

            if(origin_price == null || origin_price.length == 0){
                origin_price = $('#J_priceStd').find('.tm-price');
            }

            if(origin_price == null || origin_price.length == 0){
                origin_price = $('#J_StrPriceModBox').find('.tm-price');
            }

            if(origin_price == null || origin_price.length == 0){
                origin_price = $('#J_StrPriceModBox').find('.tb-rmb-num');
            }

            if(origin_price == null || origin_price.length == 0){
                origin_price = $('#J_PromoPrice').find('.tm-price');
            }

            if(origin_price == null || origin_price.length == 0){
                origin_price = $('#J_PromoPrice').find('.tb-rmb-num');
            }

            var price = origin_price.text();
            price = price.match(/[0-9]*[\.,]?[0-9]+/g);

            return this.common_tool.processPrice(price);
        }catch(ex){
            throw Error(ex.message+ " Can't get origin price function getOriginPrice");
        }
    };

    this.getQuantity = function(){
        try{
            var quantity = '';
            var element = document.getElementById("J_IptAmount");
            if (element) {
                quantity = element.value;
            } else quantity = '';
            if (quantity == '') {
                quantity = document.getElementsByClassName('mui-amount-input')[0].value;
            }

            return quantity;
        }catch(ex){
            throw Error(ex.message+ " Can't get origin price function getQuantity");
        }

    };

    this.getOuterId = function(data_value){
        try{
            var scripts = document.getElementsByTagName('script');
            var skuId = "";
            var skuMap = null;
            if(scripts.length > 0) {
                for(var script = 0; script < scripts.length; script++) {
                    if(scripts[script].innerHTML.match(/Hub\.config\.set/)) {
                        try{
                            detailJsStart();
                            skuId = Hub.config.get('sku').valItemInfo.skuMap[";"+data_value+";"].skuId;
                        }catch(e){
                            skuMap = scripts[script].innerHTML.replace(/\s/g, '').substr(scripts[script].innerHTML.replace(/\s/g, '').indexOf(data_value) , 60);
                            skuId = skuMap.substr(skuMap.indexOf('skuId') + 8, 15).match(/[0-9]+/);
                        }
                    }else if(scripts[script].innerHTML.match(/TShop\.Setup/)){
                        skuMap = scripts[script].innerHTML.replace(/\s/g, '').substr(scripts[script].innerHTML.replace(/\s/g, '').indexOf(data_value) , 60);
                        skuId = skuMap.substr(skuMap.indexOf('skuId') + 8, 15).match(/[0-9]+/);
                    }
                }
            }

            return skuId;
        }catch(ex){
            return "";
        }

    };

    this.getTitleTranslate = function(){
        try{
            var _title = this.getDomTitle();
            var title_translate = _title.textContent;
            if(title_translate == ""){
                title_translate = _title.getAttribute("data-text");
            }
            return title_translate;
        }catch(ex){
            return "";
        }

    };

    this.getTitleOrigin = function(){
        try{
            var _title = this.getDomTitle();
            var title_origin = _title.getAttribute("data-text");
            if(title_origin == "" || typeof title_origin == "undefined" || title_origin == null){
                title_origin = _title.textContent;
            }
            return title_origin;
        }catch(ex){
            return "";
        }

    };

    this.getDomTitle = function(){
        var _title = null;
        if (document.getElementsByClassName("tb-main-title").length > 0) {
            _title =  document.getElementsByClassName("tb-main-title")[0];
        }

        if (_title == null && document.getElementsByClassName("tb-detail-hd").length > 0) {
            var h = document.getElementsByClassName("tb-detail-hd")[0];
            if (h.getElementsByTagName('h3').length > 0 && h != null) {
                _title = h.getElementsByTagName('h3')[0];
            }else{
                _title = h.getElementsByTagName("h1")[0];
            }
        }

        if (_title.textContent == "" && document.getElementsByClassName("tb-tit").length > 0) {
            _title = document.getElementsByClassName("tb-tit")[0];
        }

        if (_title.textContent == "") {
            _title = document.querySelectorAll('h3.tb-item-title');
            if (_title != null) {
                _title = _title[0];
            }else{
                _title = document.getElementsByClassName('tb-item-title');
                if(_title.length > 0){
                    _title = _title[0];
                }
            }
        }
        return _title;
    };

    this.getSellerName = function(){
        try{
            var seller_name = '';
            if(document.getElementsByClassName('slogo').length > 0) {
                if (document.getElementsByClassName('slogo-shopname').length > 0) {
                    seller_name = document.getElementsByClassName('slogo-shopname')[0].innerHTML;
                } else if(document.getElementsByClassName('flagship-icon').length > 0) {
                    seller_name = document.getElementsByClassName('slogo')[0].getElementsByTagName('span')[1].getAttribute('data-tnick');
                } else {
                    seller_name = document.getElementsByClassName('slogo')[0].getElementsByTagName('span')[0].getAttribute('data-tnick');
                }
            } else {
                if(document.getElementsByClassName('bts-extend').length > 0 ) {
                    try {
                        seller_name = document.getElementsByClassName('bts-extend')[0].getElementsByTagName('li')[1].getElementsByTagName('span')[0].getAttribute('data-tnick');
                    } catch(e) {
                        console.log('Seller name not found!' + e);
                    }
                }
            }
            seller_name = seller_name.trim();
        }catch(ex){
            seller_name = "";
        }

        return seller_name;
    };

    this.getStock = function(){
        try{
            var stock_id = document.getElementById('J_EmStock');
            var stock = 99;
            if(stock_id == null || stock_id == 'undefined'){
                stock_id = document.getElementById("J_SpanStock");
            }

            if(stock_id != null && stock_id != 'undefined'){
                stock = stock_id.textContent;
                stock = parseInt(stock.replace(/[^\d.]/g, ''));
            }
        }catch(ex){
            stock = 99;
        }

        return stock;
    };

    this.getSellerId = function(){
        try{
            var seller_id = '';
            var url = '';

            var url_shop = "";

            var supplier = document.querySelectorAll('.tb-shop-name');
            if (supplier.length > 0) {
                url_shop = supplier[0].getElementsByTagName("a")[0];
            } else {
                supplier = document.querySelectorAll('div.shop-card');
                if (supplier.length > 0) {
                    url_shop = supplier[0].getElementsByTagName("p")[0].getElementsByTagName("a")[0];
                }
            }

            if(!((typeof supplier !== 'object' && supplier != "" && supplier != null)
                || (typeof supplier === 'object' && supplier.length > 0))){
                supplier = document.getElementsByClassName('hd-shop-name');
                if((typeof supplier !== 'object' && supplier != "" && supplier != null)
                    || (typeof supplier === 'object' && supplier.length > 0)){
                    url_shop = supplier[0].getElementsByTagName("a")[0];
                }
            }

            if(!((typeof supplier !== 'object' && supplier != "" && supplier != null)
                || (typeof supplier === 'object' && supplier.length > 0))){
                supplier = document.querySelectorAll('span.shop-name');

                if (supplier.length > 0 && supplier != null) {
                    url_shop = supplier[0].getElementsByTagName("a")[0];
                }else{
                    supplier = document.querySelectorAll('div.shop-card');
                    if (supplier.length > 0 && supplier != null) {
                        url_shop = supplier[0].getElementsByTagName("p")[0].getElementsByTagName("a")[0];
                    }else{
                        supplier = document.querySelectorAll('a.slogo-shopname');
                        if(supplier.length > 0 && supplier != null){
                            url_shop = supplier[0];
                        }else{
                            supplier = document.querySelectorAll("div#side-shop-info");
                            if((typeof supplier !== 'object' && supplier != "" && supplier != null)
                                || (typeof supplier === 'object' && supplier.length > 0)){
                                supplier = supplier[0].getElementsByClassName('shop-intro')[0];
                                url_shop = supplier.getElementsByTagName("a");
                                url_shop = url_shop[0];
                            }
                        }
                    }
                }
            }

            if(url_shop != null && url_shop != ""){

                url = url_shop.getAttribute('href');

                seller_id = url.split('.')[0];
                if(seller_id.match(/http:\/\//)){
                    seller_id = seller_id.split('http://')[1];
                }else if(seller_id.match(/\/\//)){
                    seller_id = seller_id.split('//')[1];
                }
            }
        }catch(ex){
            seller_id = "";
        }

        return seller_id;
    };

    this.getProperties = function(){
        var selected_props = document.getElementsByClassName('J_TSaleProp');

        var color_size = '';

        if(!((typeof selected_props != 'object' && selected_props != "" && selected_props != null)
            || (typeof selected_props === 'object' && selected_props.length > 0))){

            selected_props = document.querySelectorAll("ul.tb-cleafix");
        }
        if(selected_props.length > 0 && selected_props != null) {
            for(var i = 0; i < selected_props.length; i++) {
                var li_origin = selected_props[i].getElementsByClassName('tb-selected')[0];

                if(li_origin != null){
                    var c_s = li_origin.getElementsByTagName('span')[0].getAttribute("data-text");
                    if(c_s == "" || c_s == null || typeof c_s == "undefined"){
                        c_s = li_origin.getElementsByTagName('span')[0].textContent;
                    }
                    color_size+=c_s+';';
                }
            }
        }

        return color_size;
    };

    this.getPropertiesOrigin = function(){
        //Màu sắc
        var selected_props = document.getElementsByClassName('J_TSaleProp');
        var color_size = '';

        if(!((typeof selected_props !== 'object' && selected_props != "" && selected_props != null)
            || (typeof selected_props === 'object' && selected_props.length > 0))){
            selected_props = document.querySelectorAll("ul.tb-cleafix");
        }
        if(selected_props.length > 0) {
            for(var i = 0; i < selected_props.length; i++) {
                var li_origin = selected_props[i].getElementsByClassName('tb-selected')[0];
                if(li_origin != null){
                    var c_s = li_origin.getElementsByTagName('span')[0].getAttribute("data-text");
                    if(c_s == "" || c_s == null || typeof c_s == "undefined"){
                        c_s = li_origin.getElementsByTagName('span')[0].textContent;
                    }
                    color_size+=c_s+';';
                }
            }
        }
        return color_size;
    };

    this.getDataValue = function(){
        try{
            var selected_props = document.getElementsByClassName('J_TSaleProp');
            var data_value = '';
            if(selected_props.length > 0) {
                for(var i = 0; i < selected_props.length; i++) {
                    var li_origin = selected_props[i].getElementsByClassName('tb-selected')[0];

                    data_value+= ";"+li_origin.getAttribute('data-value');
                }
            }
            if(data_value.charAt(0) == ';'){
                data_value = data_value.substring(1,data_value.length);
            }
            return data_value;
        }catch(ex){
            return "";
        }

    };


    this.getWangwang = function(){
        try{

            var wangwang = "";

            var seller_nickname = $('input[name=seller_nickname]');

            if(seller_nickname != null && seller_nickname.length > 0){
                wangwang = seller_nickname.val();
            }

            if(wangwang == ''){
                var span_wangwang = document.querySelectorAll("span.seller");

                if(span_wangwang != null && span_wangwang != "" && span_wangwang != "undefined" && span_wangwang.length > 0){
                    var div_wangwang = document.getElementsByClassName('slogo-extraicon');
                    if(div_wangwang != null && div_wangwang != "" && div_wangwang != "undefined" && div_wangwang.length > 0){
                        span_wangwang = div_wangwang[0].getElementsByClassName("ww-light");
                    }
                }

                if(span_wangwang == null || span_wangwang == '' || span_wangwang.length == 0){
                    span_wangwang = document.querySelectorAll("div.hd-shop-desc span.ww-light");
                }

                if(span_wangwang.length > 0){
                    var sp_wangwang = span_wangwang[0].getElementsByTagName("span");
                    if(sp_wangwang != null && sp_wangwang != '' && sp_wangwang.length == 0){
                        wangwang = decodeURIComponent(sp_wangwang[0].getAttribute('data-nick'));
                    }else{
                        wangwang = decodeURIComponent(span_wangwang[0].getAttribute('data-nick'));
                    }
                }
            }

        }catch(ex){
            console.log(ex);
            wangwang = "";
        }
        return wangwang;

    };

    this.getImgLink = function() {
        var img_src = "";
        try {
            var img_obj = document.getElementById('J_ImgBooth');
            if (img_obj != null) { // Image taobao and t
                img_src = img_obj.getAttribute("src");
                img_src = this.common_tool.resizeImage(img_src);
                return encodeURIComponent(img_src);
            }

            img_obj = document.getElementById('J_ThumbView');

            if(img_obj != null && img_obj != ""){
                img_src = img_obj.getAttribute("src");
                img_src = this.common_tool.resizeImage(img_src);
                return encodeURIComponent(img_src);
            }

            if (document.getElementById('J_ImgBooth').tagName == "IMG") {
                // Find thumb image
                var thumbs_img_tag = document.getElementById('J_UlThumb');
                try {
                    if (thumbs_img_tag != null) {
                        img_src = thumbs_img_tag.getElementsByTagName("img")[0].src;
                    } else {
                        img_src = document.getElementById('J_ImgBooth').src;
                    }
                } catch (e) {
                    console.log(e);
                }
            } else {
                // Find thumb image
                var thumbs_a_tag = document.getElementById('J_UlThumb');
                if (thumbs_a_tag != null) {
                    img_src = thumbs_a_tag.getElementsByTagName("li")[0].style.backgroundImage.replace(/^url\(["']?/, '').replace(/["']?\)$/, '');
                } else {
                    img_src = document.getElementById('J_ImgBooth').style.backgroundImage.replace(/^url\(["']?/, '').replace(/["']?\)$/, '');
                }
            }

        } catch (e) {
            img_src = "";
        }

        img_src = this.common_tool.resizeImage(img_src);
        return encodeURIComponent(img_src);
    };

    this.getItemID = function(){
        try{
            var home = window.location.href;
            var item_id = this.common_tool.getParamsUrl('id',home);
            var dom_id = document.getElementsByName("item_id");
            if(item_id <= 0 || !$.isNumeric(item_id)){
                if (dom_id.length > 0) {
                    dom_id = dom_id[0];
                    item_id = dom_id.value;
                } else item_id = 0;

                if (item_id == 0 || item_id == null || item_id == '') {
                    dom_id = document.getElementsByName("item_id_num");
                    if (dom_id.length > 0) {
                        dom_id = dom_id[0];
                        item_id = dom_id.value;
                    } else item_id = 0;
                }
            }

            if(parseInt(item_id) <= 0 || !$.isNumeric(item_id)){
                item_id = home.split('.htm')[0];
                item_id = item_id.split('item/')[1];
            }

            return item_id;
        }catch(ex){
            return "";
        }

    };
};

var alibaba = function (cart_url,add_cart_url) {
    this.source = 'alibaba';
    this.common_tool = new CommonTool();
    this.init = function () {
        $('#J_DetailInside').css('border', 'solid 1px blue;');

        this.parse();
    };
    this.parse = function () {

        //parse label description
        var common = this.common_tool;
        $('.content-wrapper table thead th').each(function () {
            var text = $.trim($(this).text());
            $(this).text(common.key_translate_lib(text));
        });
        var prop_single = $('.prop-single');
        var text_single = $.trim(prop_single.text());
        prop_single.text(common.key_translate_lib(text_single));

        var content_wrapper = $('div.content-wrapper-spec');

        content_wrapper.css("height", "300px");

        var summary = content_wrapper.find(".summary");
        var content = content_wrapper.find(".content");
        var unit_detail = content_wrapper.find(".unit-detail-order-action");

        summary.css("height", "100% !important");
        content.css("height", "100%");
        unit_detail.css("width", "230px");

        //parse price
        var item_price = this.getPrice(1);
        var table_wrap = $('.table-wrap');

        var html = common.htmlFormAddCart();



        $('body').append(
            html );

        var detail_bd = $('#mod-detail-bd');

        if(detail_bd != null){
            detail_bd.css("border","2px solid red")
        }

        var price_html = '<div style="font-size: 24px;color: #c00;height: 100px;padding: 20px">' +
            '<p>Tỉ giá : ' + this.common_tool.getExchangeRate() + ' VNĐ / 1 CNY</p>' +
            '<span style="font-weight:normal">Giá tạm tính: ' + common.currency_format(item_price * this.common_tool.getExchangeRate()) + ' VNĐ</span></div>';
        if (table_wrap != null && (typeof table_wrap === 'object' && table_wrap.length > 0)) {
            table_wrap.append(price_html);
        }else{
            try{
                var obj_leading = $('.obj-leading');
                if(obj_leading != null && obj_leading.length > 0){
                    obj_leading.before(price_html);
                }else{
                    $('.obj-sku').before(price_html);
                }
            }catch(ex){

            }
        }

        //translate
        var title_content = $('.mod-detail-hd h1');
        title_content.attr('data-origin-title', title_content.text());

        this.common_tool.translate_title(title_content.text(), 'title', this);

        return false;

    };
    this.set_translate = function (data) {
        var title_content = $('.mod-detail-hd h1');
        title_content.html(data['title']);
        return true;
    };

    this.getPriceInput = function(){
        return $('#_price').val();
    };

    this.getPropertiesInput = function(){
        return $('#_properties').val();
    };

    this.getQuantityInput = function(){
        return $('#_quantity').val();
    };

    this.getCommentInput = function(){
        return $('#_comment_item').val();
    };

    this.add_to_cart = function () {
        var data_send = null;
        try {
            var data = this.get_item_data();

            // Find color required and checked
            var tbl_wrap = document.getElementsByClassName('content-wrapper');
            var content = null;
            var color_selected = true;
            if (tbl_wrap.length > 0) {
                content = tbl_wrap[0].getElementsByClassName('content');
                if (content.length > 0) {
                    var color_dom = content[0].getElementsByClassName('leading');
                    if(!(color_dom != null && (typeof color_dom === 'object' && color_dom.length > 0))){
                        color_selected = false;
                    }
                }
            }else{
                var tag_ul_color = document.getElementsByClassName('list-leading');
                if (tag_ul_color.length > 0) {
                    var tag_a_color = tag_ul_color[0].getElementsByClassName('selected');
                    if (tag_a_color.length > 0) {
                        color_selected = true;
                    }
                }
            }

            if (color_selected == false) {
                alert("Bạn chưa chọn Màu sắc");
                this.common_tool.removeDisabledButtonCart();
                return;
            }

            if (data.length == 0) {
                alert("Bạn chưa chọn số lượng sản phẩm");
                this.common_tool.removeDisabledButtonCart();
                return;
            }

            for (var o in data) {
                if (!$.isNumeric(o)) {
                    continue;
                }
                if (data[o]['amount'] == 0) {
                    alert("Bạn chưa chọn số lượng sản phẩm");
                    this.common_tool.removeDisabledButtonCart();
                    return;
                }

                data_send = this.getDataSend(data[o]);

                if (data_send != null && typeof data_send != "undefined" && data_send != "") {
                    this.common_tool.sendAjaxToCart(add_cart_url,data_send);
                }

            }
            return true;
        } catch (e) {
            data_send = this.getDataSend([]);

            if(data_send != null){
                this.common_tool.sendAjaxToCart(add_cart_url,data_send);
            }

            return false;
        }
    };

    this.getDataSend = function(item_data){
        try {
            //l?y item_id
            var error = 0;

            var item_id = this.getItemId();
            //l?y item_title
            var item_title = this.getItemTitle();
            //l?y item_image
            var item_image = this.getItemImage();
            //l?y item_link
            var item_link = this.getItemLink();
            //l?y seller_id
            var seller_id = this.getShopId();
            var seller_name = this.getShopName();
            //lay comment
            var price_table = this.getPriceTable();

            var step = this.getStep();

            var require_min = this.getRequireMin();

            var stock = this.getStock();

            try{
                if (stock <= 0) {
                    stock = item_data[1];
                }
            }catch(ex){
                stock = 9999;
            }

            var wangwang = this.getWangwang();

            if(wangwang == ''){
                wangwang = seller_name;
            }

            var weight = this.getWeight();

            //

            var item_price = this.getPrice(item_data[0]);

            if(parseFloat(item_price) <= 0){
                var tbl_wrap = document.getElementsByClassName('content-wrapper');
                if (tbl_wrap.length > 0) {
                    if (tbl_wrap[0].getElementsByClassName('content').length > 0) {
                        item_price = item_data[4];
                    }
                }
            }
            //console.log(item_data);
            if(parseFloat(item_price) <= 0) {
                item_price = item_data[4];
            }

            //console.log(item_price);return false;
            if(!$.isNumeric(item_price) || parseFloat(item_price) <= 0){
                error = 1;
                item_price = this.getPriceInput();
            }

            //


            try{
                var color_size_name = item_data[3] + ";" + item_data[2];

                if(color_size_name ===  'undefined;undefined' || color_size_name === 'undefined' ){
                    error = 1;
                    color_size_name = this.getPropertiesInput();
                }
            }catch(ex){
                error = 1;
                color_size_name = this.getPropertiesInput();
            }

            try{
                var quantity = item_data[0];
                if(!$.isNumeric(quantity) || parseInt(quantity) <= 0){
                    error = 1;
                    quantity = this.getQuantityInput();
                }
            }catch(ex){
                error = 1;
                quantity = this.getQuantityInput();
            }

            var comment = $('.unit-detail-order-action textarea').val();

            if(!$.isNumeric(quantity) || parseInt(quantity) <= 0 || !$.isNumeric(item_price) || parseFloat(item_price) <= 0){
                var is_show = $('#_box_input_exception').attr("data-is-show");
                if(parseFloat(is_show) != 1){
                    try{
                        alert("Chúng tôi không thể lấy được thông tin của sản phẩm, " +
                        "bạn vui lòng điền thông tin để chúng tôi mua hàng cho bạn");
                        var price = $('#_price');
                        price.focus();
                        if(parseFloat(item_price) > 0 ){
                            price.val(item_price);
                        }else{
                            price.attr("placeholder","Nhập tiền Nhân dân tệ");
                        }
                        $('#_properties').val(color_size_name);
                        $('#_quantity').val(quantity);

                    }catch(ex){

                    }
                    this.common_tool.showInputEx('alibaba');
                }
                this.common_tool.removeDisabledButtonCart();
                return null;
            }

            var data = {
                title_origin: $.trim(item_title),
                title_translated: $.trim(item_title),
                price_origin: item_price,
                price_promotion: item_price,
                price_table: price_table,
                property_translated: color_size_name,
                property: color_size_name,
                data_value: "",
                image_model: item_image,
                image_origin: item_image,
                shop_id: seller_id,
                shop_name: seller_name,
                wangwang: wangwang,
                quantity: quantity,
                require_min: require_min,
                stock: stock,
                site: "1688",
                comment: comment,
                item_id: item_id,
                link_origin: item_link,
                outer_id: '',
                weight: weight,
                error : error,
                step: step,
                tool: "Addon"
            };
            console.log(data);
            return data;
        } catch (e) {
            throw Error(e + "Error function getDataSend()");
        }
    };

    /**
     * Lấy dữ liệu send
     * return Array 2 chiều
     *  result[i]['amount'] = 0;
     result[i]['min_amount'] = 0;
     result[i]['size'] = 0;
     result[i]['color'] = 0;
     result[i]['price'] = 0;
     * data gồm amount, color, size, min_amount
     **/
    this.get_item_data = function () {

        var result = [];
        var input_data = [];
        var i = 0;
        var parent_obj = null;

        try {
            // Multi buy
            var tbl_wrap = document.getElementsByClassName('content-wrapper');
            var content = null;
            var color = null;
            if (tbl_wrap.length > 0) {
                content = tbl_wrap[0].getElementsByClassName('content');
            }
            /**
             * Chú thích mảng Result:
             * [0] => Quantity
             * [1] => Stock
             * [2] => Site
             * [3] => Màu sắc
             * [4] => price
             */
            if (content != null) { // New 22/5/2013
                content = content[0];
                input_data = content.getElementsByClassName('amount-input'); // Get Số Lượng đặt
                if (input_data.length > 0) {

                    i = 0;
                    /**
                     * Có class 'leading': màu sắc nằm trong class leading
                     * danh sách phía dưới là kích thước
                     * Nếu không có class 'leading', không có kích thước, chỉ có màu sắc
                     */
                    color = tbl_wrap[0].getElementsByClassName('leading');
                    if (color.length > 0) { // Has color, and size
                        color = color[0].getElementsByClassName('selected')[0].getAttribute('title').replace(/\n+/, '').replace(/\s+/, '');
                        for (var inc in input_data) {
                            if (isNaN(input_data[inc].value) || input_data[inc].value == 0) {
                                continue;
                            }
                            parent_obj = input_data[inc].parentNode.parentNode.parentNode.parentNode; // Find tr node
                            result[i] = new Array();
                            // Add data to arrayn
                            result[i][0] = input_data[inc].value;
                            result[i][1] = parent_obj.getElementsByClassName('count')[0].getElementsByTagName('span')[0].textContent.replace(/\s+/, "");
                            result[i][2] = color == "" ? "" : parent_obj.getElementsByClassName('name')[0].getElementsByTagName('span')[0].textContent.replace(/\s+/, '').replace(/\n+/, '');
                            result[i][3] = color == "" ? parent_obj.getElementsByClassName('name')[0].getElementsByTagName('span')[0].textContent.replace(/\s+/, '').replace(/\n+/, '') : color;
                            result[i][4] = parent_obj.getElementsByClassName('price')[0].getElementsByTagName('em')[0].textContent.replace(/\s+/, "");
                            i++;
                        }
                    } else { // Có màu sắc, ko có size

                        for (var inc in input_data) {
                            if (isNaN(input_data[inc].value) || input_data[inc].value == 0) {
                                continue;
                            }
                            parent_obj = input_data[inc].parentNode.parentNode.parentNode.parentNode; // Find tr node
                            result[i] = new Array();
                            // Add data to arrayn
                            result[i][0] = input_data[inc].value;
                            result[i][1] = parent_obj.getElementsByClassName('count')[0].getElementsByTagName('span')[0].textContent.replace(/\s+/, "");
                            result[i][2] = "";

                            var span_color = parent_obj.getElementsByClassName('name')[0].getElementsByTagName('span');
                            var img_color = parent_obj.getElementsByClassName('name')[0].getElementsByClassName('image');
                            result[i][3] = img_color.length > 0 ?
                                (img_color[0].getAttribute('title'))
                                :
                                span_color[0].textContent.replace(/\s+/, '').replace(/\n+/, '');
                            result[i][4] = parent_obj.getElementsByClassName('price')[0].getElementsByTagName('em')[0].textContent.replace(/\s+/, "");
                            i++;
                        }
                    }
                }
            } else {
                var obj_sku = document.getElementsByClassName('obj-sku');
                var obj_amount = document.getElementsByClassName('obj-amount');
                if (obj_sku != null && (typeof obj_sku === 'object' && obj_sku.length > 0)) {
                    input_data = obj_sku[0].getElementsByClassName("amount-input");
                } else if (obj_amount != null && (typeof obj_amount === 'object' && obj_amount.length > 0)) {
                    input_data = obj_amount[0].getElementsByClassName("amount-input");
                }

                if (input_data.length > 0) {

                    i = 0;
                    /**
                     * Có class 'leading': màu sắc nằm trong class leading
                     * danh sách phía dưới là kích thước
                     * Nếu không có class 'leading', không có kích thước, chỉ có màu sắc
                     */
                    color = document.getElementsByClassName('obj-leading');
                    if (color.length > 0) { // Has color, and size
                        color = color[0].querySelectorAll('a.selected'); //
                        if (color != null) {
                            color = color[0].getAttribute('title').replace(/\n+/, '').replace(/\s+/, '');
                        }
                        for (var inc in input_data) {
                            if (isNaN(input_data[inc].value) || input_data[inc].value == 0) {
                                continue;
                            }
                            parent_obj = input_data[inc].parentNode.parentNode.parentNode.parentNode; // Find tr node
                            result[i] = this.getProperties(parent_obj, input_data[inc], color);

                            i++;
                        }
                    } else { // Có màu sắc, ko có size
                        for (var inc in input_data) {
                            if (isNaN(input_data[inc].value) || input_data[inc].value == 0) {
                                continue;
                            }
                            parent_obj = input_data[inc].parentNode.parentNode.parentNode.parentNode; // Find tr node
                            result[i] = this.getProperties(parent_obj, input_data[inc], "");
                            i++;
                        }
                    }
                }
            }
            return result;
        } catch (e) {
            throw Error(e + "Error function get_item_data()");
        }
    };

    this.getProperties = function (tr_prop, input_data, color) {
        try{
            var content = null;
            var count_span = null;
            var size_span = null;
            var price_span = null;
            var result = [];
            var span = null;
            result[0] = input_data.value;
            count_span = tr_prop.getElementsByClassName('count');
            if (count_span != null && (typeof count_span === 'object' && count_span.length > 0)) {
                result[1] = count_span[0].getElementsByTagName('span')[0].textContent.replace(/\s+/, "");
            } else {
                result[1] = 9999;
            }
            size_span = tr_prop.getElementsByClassName('name');
            if (size_span != null && (typeof size_span === 'object' && size_span.length > 0 && color != "")) {
                span = size_span[0].getElementsByTagName('span')[0];
                if (this.common_tool.hasClass(span, "image")) {
                    result[2] = span.getAttribute("title").
                        replace(/\s+/, '').replace(/\n+/, '');
                } else {
                    result[2] = span.textContent.replace(/\s+/, '').replace(/\n+/, '');
                }
            } else {
                result[2] = "";
            }

            if (size_span != null && (typeof size_span === 'object' && size_span.length > 0) && color == "") {
                span = size_span[0].getElementsByTagName('span')[0];
                if (this.common_tool.hasClass(span, "image")) {
                    result[3] = span.getAttribute("title").
                        replace(/\s+/, '').replace(/\n+/, '');
                } else {
                    result[3] = span.textContent.replace(/\s+/, '').replace(/\n+/, '');
                }
            } else {
                result[3] = color;
            }

            price_span = tr_prop.getElementsByClassName('price');

            if (price_span != null && (typeof price_span === 'object' && price_span.length > 0)) {
                result[4] = price_span[0].getElementsByTagName('em')[0].textContent.replace(/\s+/, "");
            } else {
                result[4] = 0;
            }

            return result;
        }catch(ex){
            throw Error(ex + "Error function getProperties()");
        }

    };

    // Comment
    this.getComment = function () {
        var comment = document.getElementById("_comment_sd");
        if (comment != null) {
            comment = comment.value;
        } else {
            comment = "";
        }
        return comment;
    };

    // Hàm l?y b?ng Giá
    this.getPriceTable = function () {
        //-- get price amount
        var price_table = [];

        var price_range = null;

        var pri = [];

        var detail_price = null;

        var tr_price = null;

        var i = 0;

        try {
            detail_price = document.getElementById("mod-detail-price");
            if (detail_price != null) { //price by amount

                var price_container = detail_price.getElementsByClassName("unit-detail-price-amount");

                if (price_container != null && price_container.length > 0) {
                    tr_price = price_container[0].getElementsByTagName("tr");

                    if (tr_price.length > 0) {
                        for (i = 0; i < tr_price.length; i++) {
                            pri = tr_price[i];
                            price_range = JSON.parse(pri.getAttribute("data-range"));
                            price_table.push(price_range);
                        }
                    }
                } else {
                    tr_price = detail_price.querySelectorAll("tr.price td");
                    if (tr_price != null && tr_price.length > 0) {
                        for (var j = 0; j < tr_price.length; j++) {
                            try {
                                pri = tr_price[j];
                                var range = pri.getAttribute("data-range");
                                if (range !== "") {
                                    price_range = JSON.parse(range);
                                    price_table.push(price_range);
                                }
                            } catch (e) {

                            }

                        }
                    }
                }
            } else {
                var price = {};
                var price_common = document.getElementsByClassName("offerdetail_common_beginAmount");

                // One price
                if (price_common.length > 0) {
                    price.begin = price_common[0].getElementsByTagName('p')[0].textContent;

                    price.begin = price.begin.match(/[0-9]+/)[0];
                    // get prices
                    detail_price = document.getElementsByClassName("unit-detail-price-display")[0].textContent.split('-');
                    var price_display = {};
                    for (i = 0; i < detail_price.length; i++) {
                        price_display[i] = detail_price[i].match(/[0-9]*[\.]?[0-9]+/g).join('');
                    }
                    price.price = price_display;
                    price.end = "";
                }
                price_table.push(price);
            }
        } catch (ex) {
            console.log("Fuck " + ex);
            throw Error(e + "Error function getPriceTable()");
        }
        return JSON.stringify(price_table);
    };

    this.getRequireMin = function () {
        var require_min = 1;
        try {
            require_min = iDetailConfig.beginAmount;
        } catch (e) {
            try{
                var div_unit = $('.unit-detail-freight-cost');
                if(div_unit != null){
                    var data_config = div_unit.attr('data-unit-config');
                    data_config = $.parseJSON(data_config);
                    require_min = data_config.beginAmount;
                }
            }catch (ex){
                require_min = 1;
            }

        }
        return require_min;
    };

    /**
     * get Step item
     * @returns {number}
     */
    this.getStep = function () {
        try{
            var step = 1;
            var purchasing_multiple = document.getElementsByClassName('mod-detail-purchasing-multiple');
            var purchasing_single = document.getElementsByClassName('mod-detail-purchasing-single');
            var purchasing_quotation = document.getElementsByClassName('mod-detail-purchasing-quotation');

            var purchasing = null;

            if (purchasing_multiple.length > 0 && purchasing_multiple != null) {
                purchasing = JSON.parse(purchasing_multiple[0].getAttribute("data-mod-config"));
                step = purchasing.wsRuleNum;
            } else if (purchasing_single.length > 0 && purchasing_single != null) { //SINGLE MODE
                purchasing = JSON.parse(purchasing_single[0].getAttribute("data-mod-config"));
                step = purchasing.wsRuleNum;
            } else if (purchasing_quotation.length > 0 && purchasing_quotation != null) {
                step = 0;
            } else {
                step = 1;
            }
            if (step == '' || step == null) {
                step = 1;
            }

            return step;
        }catch(ex){
            throw Error(ex + "Error function getStep()");
        }

    };

    // Get min amount
    this.getMinAmount = function () {

        var min_amount = 1;

        var list_amount = document.getElementById("mod-detail-price");
        if (list_amount == null) {
            return min_amount;
        }

        var span_amount = list_amount.getElementsByTagName("span");
        if (span_amount == null) {
            return min_amount;
        }

        var str = span_amount[0].textContent;

        // Find range of amount
        if (str.indexOf('-') != -1) {
            return str.split('-')[0];
        }
        // Less than
        if (str.indexOf('<') != -1) {
            return min_amount;
        }
        // Greater than
        if (str.indexOf('>') != -1) {
            return str.split('>')[0];
        }
        if (str.indexOf('?') != -1) {
            return str.split('?')[1];
        }
        return min_amount;
    };

    // Get price by item amout
    this.getPrice = function (quantity) {
        try {
            var price = 0;
            quantity = parseInt(quantity);

            var price_table = this.getPriceTable();

            price = this.getPriceByPriceTable(price_table,quantity);

            if(parseFloat(price) > 0){
                return this.common_tool.processPrice(price);
            }

            /* nếu lấy theo mod-detail-price-sku*/
            var span_price = document.getElementsByClassName('mod-detail-price-sku');
            if(span_price != null && span_price != "" && span_price != "undefined"){
                span_price = span_price[0];
            }

            if (span_price != null && span_price != "" && span_price != "undefined") {
                var e_num = span_price.getElementsByTagName('span')[2].textContent;
                var p_num = span_price.getElementsByTagName('span')[3].textContent;
                price = e_num + p_num;
                return this.common_tool.processPrice(price);
            }
            /* nếu lấy theo mod-detail-price*/
            var div_prices = document.getElementById('mod-detail-price');

            if (div_prices == null) {
                return this.common_tool.processPrice(price);
            }
            // lay theo table, kieu moi
            var price_content = $('#mod-detail-price table');

            if(price_content != null && price_content != "" && price_content != "undefined"){
                var td = price_content.find('tr[class="price"] td');

                /* kieu khoang Giá 2-2000*/
                if(price == 0 || $.isNumeric(price)) {
                    $('.table-sku tr .amount-input').each(function() {
                        var value = $(this).val();
                        if(value > 0) {
                            var doc = $(this).parent().parent().parent().parent();

                            var prop_to_compare = $.trim(doc.find('td.name').text());
                            price = doc.find('td.price .value').text();
                        }
                    });
                }
                /* ket thuc kieu cu chuoi*/

                if(price == 0) {
                    var price_about = $('.price-original-sku').find('span:nth-child(5)');
                    var check = price_about.html();
                    if(check && check!=null && check !='undefined') {
                        price = price_about.text();
                    }else{
                        price = $('.price-original-sku').find('span:nth-child(2)').text();
                    }
                }
                if(price == 0) {
                    var tr = $('.unit-detail-price-amount').find('tr');
                    var d = $('.amount-input').first();
                    var quantity = d.val();

                    for(var j = 0;j < tr.length; j++){
                        var price_sku = $(tr[j]).attr('data-range');
                        price_sku = $.parseJSON(price_sku);
                        if(quantity < price_sku.begin) {
                            price_sku.begin = 1;
                        }
                        if(price_sku.end == 0||price_sku.end == '') {
                            price_sku.end = 5000;
                        }
                        if(quantity >= price_sku.begin
                            && quantity <= price_sku.end) {

                            price = price_sku.price;
                            break;
                        }
                    }
                }

                return this.common_tool.processPrice(price);
            }

            var span_prices = div_prices.getElementsByTagName("span");
            if (span_prices == null || span_prices == '') {
                return this.common_tool.processPrice(price);
            }else{


                var quan_compare = '';
                for (var i = 0; i < span_prices.length; i++) {
                    var str = span_prices[i].textContent;
                    if ((str.indexOf('-') != -1) || (str.indexOf('?') != -1)) {
                        if (str.indexOf('-') != -1) {
                            quan_compare = str.split('-');
                            price = span_prices[i + 1].textContent + '' + span_prices[i + 2].textContent;
                            if (quantity >= quan_compare[0] && quantity <= quan_compare[1]) {
                                break;
                            }
                        }
                        if (str.indexOf('?') != -1) {
                            price = span_prices[i + 1].textContent + '' + span_prices[i + 2].textContent;
                        }
                    }
                }
            }
            return this.common_tool.processPrice(price);
        }
        catch (e) {
            throw Error(e + "Error function getPrice()");
        }
    };


    this.getPriceByPriceTable = function (price_table, quantity) {
        var price = 0;
        try {
            price_table = JSON.parse(price_table);
            if (typeof price_table === 'object') {
                for (var o in price_table) {
                    if (price_table[o] != null) {
                        var begin = price_table[o].begin;
                        var end = price_table[o].end;

                        if ((begin <= quantity && quantity <= end) ||
                            (begin <= quantity && (parseInt(end) == 0 || end == null || end == "")) || quantity <= begin) {
                            price = price_table[o].price;
                            break;
                        } else {
                            price = price_table[o].price;
                        }
                    }
                }
            }
        } catch (e) {
            price = 0;
        }

        return price;
    };

    // Seller id
    this.getShopName = function () {
        var shop_name = '';
        try {
            //

            //
            var element = document.getElementsByName("sellerId");
            if (element.length > 0) {
                element = element[0];
                shop_name = element.value;
            } else {
                // New 24/4/2013
                element = document.getElementsByClassName('contact-div');
                if (element.length > 0) {
                    shop_name = element[0].getElementsByTagName('a')[0].innerHTML;
                }
            }

            if(shop_name == ''){
                var company_name = document.querySelectorAll('div.company-name');
                if(company_name != null && company_name.length > 0){
                    var a = company_name[0].querySelectorAll("a.name");
                    if(a != null && a.length > 0){
                        shop_name = a[0].innerHTML;
                    }
                }
            }
            if(shop_name == '') {
                shop_name = $('a.name').first().text();
            }
        } catch (e) {
            console.log('Khong lay duoc thong tin nguoi ban!');
        }

        return shop_name;
    };

    this.getShopId = function () {
        var shop_id = "";
        try{
            var WolfSmoke = WolfSmoke;
            shop_id = WolfSmoke.acookieAdditional.member_id;
        }catch (e){
            try{
                shop_id = iDetailConfig.feedbackUid;
            }catch (err){
                shop_id = "";
            }
        }

        if(shop_id == ""){
            var a_shop = document.getElementsByClassName("tplogo");
            if(a_shop != null && a_shop.length > 0){
                var href = a_shop[0].getAttribute("href");
                shop_id = href.split('.')[0];
                shop_id = shop_id.split('http://')[1];
            }else{
                var div_logo = document.querySelectorAll('div.logo');
                if(div_logo != null && div_logo.length > 0){
                    a_shop = div_logo[0].getElementsByTagName("a");
                    if(a_shop != null && a_shop.length > 0){
                        href = a_shop[0].getAttribute("href");
                        shop_id = href.split('.')[0];
                        shop_id = shop_id.split('http://')[1];
                    }
                }else{
                    var company_name = document.querySelectorAll('div.company-name');
                    if(company_name != null && company_name.length > 0){
                        a_shop = company_name[0].getElementsByTagName("a");
                        if(a_shop != null && a_shop.length > 0){
                            href = a_shop[0].getAttribute("href");
                            shop_id = href.split('.')[0];
                            shop_id = shop_id.split('http://')[1];
                        }
                    }
                }
            }
        }
        if(shop_id == "" || shop_id == 'undefined' || shop_id == undefined) {
            shop_id = $('a.name').first().text();
        }

        return shop_id;
    };

    /**
     * Get Item Id
     * @returns {number}
     */
    this.getItemId = function () {

        try{
            var offerid = 0;
            try {
                offerid = iDetailConfig.offerid;
            } catch (e) {
                var link = window.location.href;
                var item_id = link.split('.html')[0];
                offerid = item_id.split('offer/')[1];
            }
            return offerid;
        }catch(ex){
            return 0;
        }
    };

    /**
     * Get stock item
     * @returns {number}
     */
    this.getStock = function () {
        var stock = 0;
        try {
            stock = iDetailData.sku.canBookCount;
        } catch (e) {
            stock = 0;
        }
        return stock;
    };

    /**
     * Get item title
     * @returns {string}
     */
    this.getItemTitle = function () {
        try{
            var element = document.getElementsByName("offerTitle");
            var item_title = '';
            if (element.length > 0) {
                element = element[0];
                item_title = element.value;
            } else {
                // New 24/4/2013
                if (document.getElementById('mod-detail-hd') != null) {
                    item_title = document.getElementById('mod-detail-hd').getElementsByTagName('h1')[0].innerHTML;
                } else {
                    item_title = '';
                }
            }

            return item_title;
        }catch(ex){
            return "";
        }

    };

    // Item image
    this.getItemImage = function () {
        try{
            var main_image = document.getElementsByClassName("mod-detail-gallery");
            var item_image = "";
            if (main_image != null) {
                var img_obj = main_image[0].getElementsByTagName("img");
                if (img_obj.length > 1) {
                    item_image = img_obj[1].getAttribute('src');
                } else {
                    // Large image
                    item_image = img_obj[0].getAttribute('src');
                }
            }
            item_image = this.common_tool.resizeImage(item_image);
            return item_image;
        }catch(ex){
            return "";
        }

    };
    this.getItemLink = function () {
        return window.location.href;
    };

    this.getVNDPrice = function (price_taobao) {
        var rate = this.common_tool.getExchangeRate();
        var price_result = price_taobao * rate;
        price_result = this.common_tool.currency_format(price_result);

        return price_result;
    };

    this.getWangwang = function () {
        try{

            var wangwang = "";

            try {
                var a_contact = $('.contact-div .alitalk');

                if(a_contact != null && a_contact.length > 0){
                    var data_alitalk = a_contact.attr('data-alitalk');

                    if(typeof data_alitalk != 'object')
                    {
                        data_alitalk = $.parseJSON(data_alitalk);
                    }

                    wangwang = data_alitalk.id;
                }else{
                    wangwang = eService.contactList[0].name;
                }

            } catch (e) {
                wangwang = "";
            }

            return wangwang;
        }catch(e){
            return "";
        }
    };

    this.getWeight = function () {
        var weight = 0;
        try {
            var unit_detail = document.getElementsByClassName("unit-detail-freight-cost");
            if (unit_detail.length > 0) {
                var carriage = JSON.parse(unit_detail[0].getAttribute("data-unit-config"));
                weight = !isNaN(carriage.unitWeight) ? carriage.unitWeight : 0;
            }
        } catch (e) {
            weight = 0;
        }
        return parseFloat(weight);
    };
    return true;
};

var common_tool = new CommonTool();
var origin_site = common_tool.getOriginSite();
var addon_tool = new AddonTool();

common_tool.getExchangeRate();

var SessionStorage = {
    set: function(key, value) {
        window.sessionStorage.setItem(key, JSON.stringify(value))
    },
    get: function(key) {
        var saved = window.sessionStorage.getItem(key);
        saved = JSON.parse(saved);
        return saved;
    }
};
chrome.runtime.onMessage.addListener(function(request, sender, sendResponse) {
    var link = window.location.href;
    if(!link.match(request.response.item_id)){
        return;
    }
    switch (request.action) {
        case "afterGetExchangeRate":
            //console.info('afterGetExchangeRate');
            if (request.response) {
                exchange_rate = parseFloat(request.response).toFixed(0);
                SessionStorage.set("exchange_rate", exchange_rate);
                start()
            }
            break;
        case "afterAddToCart":

            var common_tool = new CommonTool();
            common_tool.removeDisabledButtonCart();
            if (request.response.html) {
                console.log(request.response);
                $('body').append(request.response.html);
            } else {
                console.log(request.response);
                $('body').append(request.response);
            }
            break;
        case "afterGetCategory":
            var data = request.response;
            var option = '<option value="0">Chọn danh mục</option>';
            var ct = new CommonTool();
            var category_id = ct.getCategorySelected();
            for (var i = 0; i < data.length; i++) {
                var catalog = data[i];
                option += '<option value="' + catalog.id + '"';
                if (parseInt(category_id) === parseInt(catalog.id)) {
                    option += ' selected="selected"'
                }
                option += '>';
                for (var j = 0; j < catalog.level; j++) {
                    if (parseInt(catalog.level) > 1) {
                        option += "&#8212;"
                    }
                }
                option += catalog.name + "</option>"
            }
            option += '<option value="-1">Khác</option>';
            $('._select_category').html(option);
            $('._select_category').attr('data-loaded', 1);
            break;
        default:
            break
    }
});
setTimeout(function() {
    var er = SessionStorage.get("exchange_rate");
    if (er == null) {
        //console.info("Lấy tỉ giá trên server.");
        chrome.runtime.sendMessage({
            action: "getExchangeRate",
            url: exchange_rate_url,
            callback: 'afterGetExchangeRate'
        })
    } else {
        //console.info("Lấy tỉ giá ở session storage.");
        exchange_rate = parseFloat(er).toFixed(0);
        start()
    }
}, 2000);

function start(){
    var str = window.location.href;
    if(!(str.match(/item.taobao/) || str.match(/detail.tmall/) || str.match(/detail.1688/)
        || str.match(/tmall.com\/item\//) || str.match(/taobao.com\/item\//))){
        return false;
    }
    var object = new factory(cart_url,add_to_cart_url);

    object.init();
    $(document).on('click','#addToCart', function () {
        common_tool.addDisabledButtonCart();
        if(origin_site.match(/1688.com/)) {
            object.add_to_cart();
        }else {
            addon_tool.AddToCart();
        }
    });
    $(document).on('click','#_is_translate',function(){
        var check = common_tool.setIsTranslateToCookie($(this));

        if(check){
            window.location.reload();
        }
    });
    return true;
}
