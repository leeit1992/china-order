(function($) {

    window.AVTLIB = {
        validateEmail: function(email) {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        },
        fileReader: function(event, appendTo = '', resize = false) {
            var file = event.target.files[0];
            var img = document.createElement("img");
            if (/\.(jpe?g|png|gif)$/i.test(file.name)) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    // The file's text will be printed here
                    $(appendTo).attr('src', event.target.result);

                    if (resize) {
                        $(appendTo).css('max-height',100);
                    }

                };
                reader.readAsDataURL(file);
            }
        },
        checkAll: function($el = null) {
            $(".avt-checkbox-primary-js", $el).change(function() {
                if (this.checked) {
                    $(".avt-checkbox-child-js", $el).each(function(index, el) {
                        $(el).prop('checked', true)
                    });
                } else {
                    $(".avt-checkbox-child-js", $el).each(function(index, el) {
                        $(el).prop('checked', false)
                    });
                }
            });

            return false;
        },
        makeid: function() {
            var text = "";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

            for (var i = 0; i < 5; i++)
                text += possible.charAt(Math.floor(Math.random() * possible.length));

            return text;
        },

        formatPriceInteger: function(int) {
            var newInt = int;
            newInt = newInt.replace("$", "");
            newInt = newInt.replace(",", "");
            newInt = newInt.replace(".00", "");
            newInt = newInt.trim();

            return newInt;
        },

        inputMask: function(args) {
            return '<input type="text" value="' + args.value + '" name="' + args.name + '" class="masked_input md-input ' + args.class + '" data-inputmask="\'alias\': \'numeric\', \'groupSeparator\': \',\', \'autoGroup\': true, \'digits\': 2, \'digitsOptional\': false, \'prefix\': \'$ \', \'placeholder\': \'0\'" data-inputmask-showmaskonhover="false" />';
        },

        errorFormTpl: _.template('<div class="uk-notify-message <%= classes %>">\
                                        <a class="uk-close"></a>\
                                        <div>\
                                           <%= message %>\
                                        </div>\
                                    </div>'),
    }

})(jQuery);