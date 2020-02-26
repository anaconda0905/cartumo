$(function () {

    var $sections = $('.step-section');

    function navigateTo(index) {
        // Mark the current section with the class 'current'
        $sections
            .removeClass('current')
            .eq(index)
            .addClass('current');

        $(".two-step-form .step-header ul > li").removeClass('active').eq(index).addClass('active');

        // Show only the navigation buttons that make sense for the current section:
        $('.form-navigation .btn-next-step').toggle(index == 0);
        var atTheEnd = index >= $sections.length - 1;

        //alert(index );

        if (index > 0) {
            $('.step-section:first-child').hide();
        } else {
            $('.step-section:first-child').show();
        }

        $('.form-navigation .complete-order').toggle(atTheEnd);
        //$('.form-navigation .complete-order').toggle(atTheEnd);
    }

    function curIndex() {
        // Return the current index by looking at which section has the class 'current'
        //alert($sections.index($sections.filter('.current')));
        return $sections.index($sections.filter('.current'));
    }

    // Previous button is easy, just go back
    $('.step-section .back-shipping').click(function () {
        navigateTo(curIndex() - 1);
    });

    // Next button goes forward iff current block validates
    $(document).on('click', '.btn-next-step', function (e) {
        if ($('.validate-form').parsley().validate({
                group: 'block-' + curIndex()
            }))
            navigateTo(curIndex() + 1);
        //alert(this);
    });

    //Complete
    $(document).on('click', '.complete-order', function (e) {
        if ($('.validate-form').parsley().validate({
                group: 'block-' + curIndex()
            })) {
            //Submit
            e.preventDefault();

            var $form = $("#frm_htmleditor_container");
            var $button = $(this);

            $.ajax({
                type: 'POST',
                url: $($form).attr('action'),
                data: $($form).serialize() + '&_token=' + $("#csrf_token").val() + '&page_id=' + $("#hid_page_id").val(),
                beforeSend: function () {
                    // Disable the submit button to prevent repeated clicks
                    $button.prop('disabled', true);
                },
                success: function (response) {
                    console.log(response);
                    $button.prop('disabled', false);

                    var json = JSON.parse(response);
                    location.href = json.url;
                },
                error: function (a, b) {
                    document.write(a.responseText);
                }
            });
        }
    });

    $sections.each(function (index, section) {
        $(section).find('.form-group input,select').attr('data-parsley-group', 'block-' + index);
    });
    navigateTo(0); // Start at the beginning
});


$(document).ready(function () {

    var monthes = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];


    //$("#frm_htmleditor_container").


    $(".open-setings-modal").click(function (e) {

        /*location.href = $(this).attr('href');*/
    });


    //Countdown days
    if ($(".date-countdown > ul").attr('data-end-date') != null) {
        // Set the date we're counting down to
        //var countDownDate = new Date("Jan 5, 2018 15:37:25").getTime();

        //var countDownDate = new Date("May 29, 2017 12:00:00").getTime();
        var dateStr = $(".date-countdown > ul").attr('data-end-date').split('/');
        var timeStr = $(".date-countdown > ul").attr('data-end-time').split(':');
        //var countDownDate = new Date(dateStr[2], dateStr[1], dateStr[0], timeStr[0], 0, 0, 0).getTime();
        //var countDownDate = new Date('"' + monthes[eval(dateStr[1])] + ' ' + eval(dateStr[0]) + ', ' + eval(dateStr[2]) + ' ' + eval(timeStr[0]) + ':00:00' + '"').getTime();
        //var countDownDate = new Date(2017, 6, 10).getTime();

        //alert(monthes[eval(dateStr[1]) - 1] + " " + eval(dateStr[0]) + ', ' + eval(dateStr[2]) + ' ' + eval(timeStr[0]) + ":" + eval(timeStr[1]) + ":00");
        //alert(dateStr[1]);
        var countDownDate = new Date(monthes[eval(dateStr[0]) - 1] + " " + eval(dateStr[1]) + ', ' + eval(dateStr[2]) + ' ' + eval(timeStr[0]) + ":" + eval(timeStr[1]) + ":00").getTime();
        //var countDownDate = new Date(monthes[eval(dateStr[1]) - 1] + " " + eval(dateStr[0]) + ', ' + eval(dateStr[2]) + ' ' + eval(timeStr[0]) + ":00:00").getTime();
        //console.log('"' + monthes[eval(dateStr[1]) - 1] + ' ' + eval(dateStr[0]) + ', ' + eval(dateStr[2]) + ' ' + eval(timeStr[0]) + ':00:00' + '"');

        // Update the count down every 1 second
        var countdownfunction = setInterval(function () {

            // Get todays date and time
            var now = new Date().getTime();

            // Find the distance between now an the count down date

            if (now <= countDownDate) {
                var distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Output the result in an element with id="demo"
                /*document.getElementById("demo").innerHTML = days + "d " + hours + "h "
                + minutes + "m " + seconds + "s ";*/

                if (days > 0)
                    $(".date-countdown > ul > .days > strong").html((days > 9) ? days : '0' + days);
                else {
                    //$(".date-countdown > ul > .days").hide();
                }

                $(".date-countdown > ul > .hours > strong").html((hours > 9) ? hours : '0' + hours);
                $(".date-countdown > ul > .minutes > strong").html((minutes > 9) ? minutes : '0' + minutes);
                $(".date-countdown > ul > .seconds > strong").html((seconds > 9) ? seconds : '0' + seconds);

                // If the count down is over, write some text
                if (distance < 0) {
                    clearInterval(countdownfunction);
                    //document.getElementById("demo").innerHTML = "EXPIRED";
                }
            } else {
                clearInterval(countdownfunction);

                if ($(".date-countdown-wrapper .date-countdown").attr('data-action-type') == 'go_to_page') {
                    location.href = $(".date-countdown-wrapper .date-countdown").attr('data-action-url');
                }
            }
        }, 1000);
    }

    //action after time is over
    /*if ($(".date-countdown-wrapper").length > 0) {

        var days = $(".date-countdown-wrapper .date-countdown ul > li.days > strong").html();
        var hours = $(".date-countdown-wrapper .date-countdown ul > li.hours > strong").html();
        var minutes = $(".date-countdown-wrapper .date-countdown ul > li.minutes > strong").html();
        var seconds = $(".date-countdown-wrapper .date-countdown ul > li.seconds > strong").html();

        if ((days == 0) && (hours == 0) && (minutes == 0) && (seconds == 0)) {
            if ($(".date-countdown-wrapper .date-countdown").attr('data-action-type') == 'go_to_page') {
                location.href = $(".date-countdown-wrapper .date-countdown").attr('data-action-url');
            }
        }
    }*/


    //Open video modal
    if ($(".open-video-modal").attr('data-video-url') != null) {

        $(document).on('click', '.open-video-modal', function (e) {

            var video_url = $(this).attr('data-video-url');
            var modal = $(this).attr('data-target');

            $.ajax({
                type: 'POST',
                url: $("#hid_base_url").val() + '/editor/load-video-from-url',
                data: 'video_url=' + video_url + '&_token=' + $("#csrf_token").val(),
                success: function (response) {
                    console.log(response);
                    $(modal).find('.modal-body').html(response);
                },
                error: function (a, b) {
                    document.write(a.responseText);
                }
            });
        });
    }


    //Dynamic product update
    if ($(".dynamic-product-selection-table").hasClass('table')) {

        $.ajax({
            type: 'GET',
            url: $("#hid_base_url").val() + '/funnels/' + $("#hid_funnel_id").val() + '/steps/' + $("#hid_funnel_step_id").val() + '/products/list',
            beforeSend: function () {
                $(".dynamic-product-selection-table tbody").html("<tr><td colspan='2'>Loading ...</td></tr>");
            },
            success: function (response) {
                console.log(response);

                $(".dynamic-product-selection-table tbody").html(response);
            },
            error: function (a, b) {
                document.write(a.responseText);
            }
        });
    }


    //Dynamic product purchased
    if ($(".dynamic-product-purchased-table").hasClass('table')) {

        $.ajax({
            type: 'GET',
            url: $("#hid_base_url").val() + '/order/recent',
            beforeSend: function () {
                $(".dynamic-product-purchased-table tbody").html("<tr><td colspan='2'>Loading ...</td></tr>");
            },
            success: function (response) {
                console.log(response);

                $(".dynamic-product-purchased-table tbody").html(response);
            },
            error: function (a, b) {
                document.write(a.responseText);
            }
        });
    }


    // ------------------ For submit button to make payment -----------------------------------
    var $stoken = null;
    var link_click = 0;

    $("#frm_htmleditor_container").submit(function (e) {

        e.preventDefault();

        var $form = $(this);
        var action = $($form).attr('action').split('/');
        var button_text = "";
        var flag = false;
        var token = "";
        var payment_types = $(this).find(".payment-form-panel input[name='payment_selection']");
        var payment_type = null;

        //alert($("input[name='payment_selection']").val());

        //alert($("form").find("input[name='payment_selection']").val());

        //alert($("#hid_page_submit_type").val());

        /*if (($("#hid_page_submit_type").val() == 'order') || ($("#hid_page_submit_type").val() == 'sales')) {
            if ($($form).find("#stripe_payment_token").length <= 0) {
                if (!$($form).find(".paypal-panel > .body").is(":visible")) {

                    //alert($("form").find("input[name='payment_selection']").val());

                    // This identifies your website in the createToken call below
                    //Stripe.setPublishableKey('pk_test_Y4uHfKpeYKNLCoRHbgj71e4o');
                    Stripe.setPublishableKey($("#hid_stripe_key").val());
                    var stripeResponseHandler = function (status, response) {
                        //alert("Start");
                        //var $form = $("#frm_htmleditor_container");
                        if (response.error) {
                            // Show the errors on the form
                            alert(response.error.message);
                            $form.find('.payment-errors').text(response.error.message);
                            $form.find('.btn-submit-form-self').prop('disabled', false);
                        } else {
                            // token contains id, last4, and card type
                            token = response.id;
                            // Insert the token into the form so it gets submitted to the server
                            $form.append($('<input type="hidden" id="stripe_payment_token" name="stripeToken" />').val(token));
                            // and re-submit
                            alert(token);
                            //$form.get(0).submit();
                            submitForm($form);

                            return false;
                        }
                    };

                    if ($(token).length <= 0) {
                        // Disable the submit button to prevent repeated clicks
                        $form.find('.btn-submit-form-self').prop('disabled', true);
                        Stripe.card.createToken($form, stripeResponseHandler);
                        // Prevent the form from submitting with the default action
                        //alert("button");
                        return false;
                    }
                } else {

                    flag = true;
                }
            }
        }*/

        $(payment_types).each(function (index, element) {

            //alert($(element).is(":checked"));

            if (payment_type == null) {
                if ($(element).is(":checked")) {
                    payment_type = $(element).val();
                }
            }
        });

        //alert(payment_type);


        if (($("#hid_page_submit_type").val() == 'order') || ($("#hid_page_submit_type").val() == 'sales')) {
            //if ($($form).find("#stripe_payment_token").length <= 0) {
            if (payment_type == 'credit_card') {
                if (!$($form).find(".paypal-panel > .body").is(":visible")) {

                    Stripe.setPublishableKey($("#hid_stripe_key").val());

                    if ($("input[name='selection']").val() == 'same') {
                        var name = $("input[name='billing_first_name']").val() + ' ' + $("input[name='first_name']").val();
                        var address = $("input[name='full_address']").val();
                        var city = $("input[name='city']").val();
                        var state = $("input[name='state']").val();
                        var zip = $("input[name='zip']").val();
                        var country = $("input[name='country']").val();
                    } else {
                        var name = $("input[name='billing_first_name']").val() + ' ' + $("input[name='billing_last_name']").val();
                        var address = $("input[name='billing_full_address']").val();
                        var city = $("input[name='billing_city']").val();
                        var state = $("input[name='billing_state']").val();
                        var zip = $("input[name='billing_zip']").val();
                        var country = $("input[name='billing_country']").val();
                    }

                    Stripe.createToken({
                        number: $('#number').val(),
                        cvc: $('#cvc').val(),
                        exp_month: $('#exp-month').val(),
                        exp_year: $('#exp-year').val(),
                        name: name,
                        address_line1: address,
                        address_city: city,
                        address_state: state,
                        address_zip: zip,
                        address_country: country
                    }, stripeResponseHandler);

                } else {
                    flag = true;
                }
            } else {
                //PayPal or something else
                submitForm();
            }
        } else {
            //alert("no payment");
            submitForm();
        }

    });

    function stripeResponseHandler(status, response) {
        if (response.error) {
            // show the errors on the form
            alert(response.error.message);
        } else {
            //alert("with payment");

            var token = response['id'];
            // insert the token into the form so it gets submitted to the server
            $("#frm_htmleditor_container").append("<input type='hidden' name='stripeToken' value='" + token + "' />");

            submitForm();
            return false;
        }
    }


    ///////////////////////////////////////////// FORM SUBMIT ///////////////////////////
    function submitForm() {

        var button_text;

        //alert(this);

        $.ajax({
            type: $("#frm_htmleditor_container").attr('method'),
            url: $("#frm_htmleditor_container").attr('action'),
            data: $("#frm_htmleditor_container").serialize() + '&_token=' + $("#csrf_token").val() + '&page_id=' + $("#hid_page_id").val() + '&step_id=' + $("#hid_funnel_step_id").val() + '&funnel_id=' + $("#hid_funnel_id").val(),
            beforeSend: function () {
                // Disable the submit button to prevent repeated clicks
                $("#frm_htmleditor_container").find('.btn-submit-form-self').bind('click', false);
                button_text = $("#frm_htmleditor_container").find('.btn-submit-form-self').text();
                $("#frm_htmleditor_container").find('.btn-submit-form-self').text("loading ...");
                $("#frm_htmleditor_container").find('.btn-submit-form-self').prepend('<i class="fa fa-circle-o-notch fa-spin"></i>&nbsp;');
            },
            success: function (response) {
                console.log(response);

                var json = JSON.parse(response);

                if (json.url) {
                    location.href = json.url;
                } else {
                    //alert(json.form);
                    if (json.form) {

                        $("#frm_htmleditor_container").after(json.form);
                        $("#paypal_payment_form").submit();
                    }
                }
            },
            error: function (a, b) {
                console.log(a.responseText);
                //alert(a.responseText);
                var json = JSON.parse(a.responseText);

                if (json.message)
                    alert(json.message);
            }
        });
    }


    $(".btn-link-submit").click(function (e) {
        e.preventDefault();
        //$("#frm_htmleditor_container").trigger('submit');

        var $form = $("#frm_htmleditor_container");

        $.ajax({
            type: 'POST',
            url: $($form).attr('action'),
            data: $($form).serialize() + '&_token=' + $("#csrf_token").val() + '&page_id=' + $("#hid_page_id").val(),
            beforeSend: function () {
                // Disable the submit button to prevent repeated clicks
                $form.find('.btn-submit-form').prop('disabled', true);
            },
            success: function (response) {
                console.log(response);
                $form.find('.btn-submit-form').prop('disabled', false);

                //alert(this);

                var json = JSON.parse(response);
                location.href = json.url;
            },
            error: function (a, b) {
                document.write(a.responseText);
            }
        });
    });


    /* ----------------- SOCIAL LIKES ------------------------- */
    if ($(".social-share").attr('data-url') != null) {

        var title = $(".social-share").attr('data-title');
        var fb_data_url = "https://www.facebook.com/sharer/sharer.php?u=" + encodeURI($(".social-share").attr('data-url')) + "&t=" + title;
        var twitter_data_url = "https://twitter.com/share?url=" + encodeURI($(".social-share").attr('data-url')) + "&via=TWITTER_HANDLE&text=" + title;
        var gplus_data_url = "https://plus.google.com/share?url=" + encodeURI($(".social-share").attr('data-url'));


        $(".social-share > .widget-facebook > a").attr('href', fb_data_url);
        $(".social-share > .widget-twitter > a").attr('href', twitter_data_url);
        $(".social-share > .widget-gplus > a").attr('href', gplus_data_url);
    }


    //credit card detection
    $(".payment-form-panel #number").keyup(function (e) {

        console.log(GetCardType($(this).val()));
    });

});


/*function stripeResponseHandler(status, response) {
    var $form = $('#frm_htmleditor_container');
    var token;

    if (response.error) {
        alert(response.error);
        // Show the errors on the form
        $form.find('.payment-errors').text(response.error.message);
        $form.find('.payment-errors').addClass('alert alert-danger');
        $form.find('.btn-submit-form').prop('disabled', false);
        $('.btn-submit-form').button('reset');
    } else {
        // response contains id and card, which contains additional card details
        token = response.id;
        // Insert the token into the form so it gets submitted to the server
        $form.append($('<input type="hidden" name="stripeToken" />').val(token));
        // and submit
        //$form.get(0).submit();

        $.ajax({
            type: 'POST',
            url: $($form).attr('action'),
            data: $($form).serialize() + '&_token=' + $("#csrf_token").val() + '&page_id=' + $("#hid_page_id").val(),
            beforeSend: function() {
                // Disable the submit button to prevent repeated clicks
                $form.find('.btn-submit-form').prop('disabled', true);
            },
            success: function(response) {
                console.log(response);
                $form.find('.btn-submit-form').prop('disabled', false);

                var json = JSON.parse(response);
                location.href = json.url;
            },
            error:function(a, b) {
                document.write(a.responseText);
            }
        });

        //alert(token);

        return token;
    }
};*/


/*if ( $(".product-varients-wrapper").find('.option-item') != null ) {
    $(document).on("change", "select[name='product_options']", function(e) {

        //alert($(this).val());

        //alert($('option:selected', this).attr('data-option-price'));

        $(this).parent().parent().next().val($('option:selected', this).attr('data-option-index'));

        if ( $(".price-wrapper").find(".price") != null ) {
            $(".price-wrapper").find(".price strong").html('$' + $('option:selected', this).attr('data-option-price'));
            $(".price-wrapper").find(".price input[name='product_price']").val($('option:selected', this).attr('data-option-price'));
        }
    });
}*/


// Product varients change option
if ($(".embed-video-wrapper").find('.video-holder').length > 0) {
    //var url = 'https://www.youtube.com/embed/'; //57tJE7HDVmM?autoplay=0&modestbranding=1&controls=1&showinfo=0&rel=0&hd=1&wmode=transparent


    $(".embed-video-wrapper").find('.video-holder').each(function (index, element) {

        var img_attr = $(element).find('img');
        //alert($(img_attr).attr('data-video-url'));

        //alert($(img_attr).attr('data-video-url'));

        var url = "";
        var link = "";

        if ($(img_attr).attr('data-video-type') == 'youtube') {
            url = 'https://www.youtube.com/embed/';

            if ($(img_attr).attr('data-video-url')) {
                link = $(img_attr).attr('data-video-url').split('?v=');
                url += link[1];
            }

            if ($(img_attr).attr('data-video-autoplay') == 'on') {
                url += '?autoplay=1';
            } else {
                url += '?autoplay=0';
            }

            if ($(img_attr).attr('data-video-controls') == 'on') {
                url += '&controls=1';
            } else {
                url += '&controls=0'
            }

            if ($(img_attr).attr('data-video-branding') == 'on') {
                url += '&modestbranding=1';
            } else {
                url += '&modestbranding=0'
            }

            url += '&showinfo=0&rel=0&hd=1&wmode=transparent';

        } else {
            url = 'https://player.vimeo.com/video/';

            if ($(img_attr).attr('data-video-url')) {
                link = $(img_attr).attr('data-video-url').split('video/');

                if (link[1].indexOf('?') >= 0) {
                    link = link[1].split('?');
                    url += link[0];
                } else {
                    url += link[1];
                }
            }

            if ($(img_attr).attr('data-video-autoplay') == 'on') {
                url += '?autoplay=1';
            } else {
                url += '?autoplay=0';
            }

            /*if ( $(img_attr).attr('data-video-controls') == 'on' ) {
                url += '&controls=1';
            } else {
                url += '&controls=0'
            }*/

            if ($(img_attr).attr('data-video-branding') == 'on') {
                url += '&title=1';
            } else {
                url += '&title=0'
            }

            url += '&byline=0&portrait=0';
        }


        //console.log(url);
        // alert(url);

        var width, height;
        if ($(img_attr).attr('data-video-width')) {
            width = $(img_attr).attr('data-video-width');
        } else {
            width = '646px';
        }

        if ($(img_attr).attr('data-video-height')) {
            height = $(img_attr).attr('data-video-height');
        } else {
            height = '409px';
        }

        $(element).html('<iframe src="' + url + '" frameborder="0" allowfullscreen="" wmode="opaque" style="width: ' + width + '; height: ' + height + '"></iframe>');
    });
}


if ($(".form-address-selection-panel .panels").find(":input[name='selection']").hasClass('panel-selection-radio') != null) {
    /*$(document).on('change', $(".form-address-selection-panel .panels").find(":input[name='selection']"), function(e) {

        alert($(this).val());
    });*/

    var bodyelement;

    $(".form-address-selection-panel .panels").find(":input[name='selection']").change(function (e) {

        //alert($(this).val());

        if ($(this).val() == 'diff') {
            $(this).parent().next().show();
            bodyelement = $(this).parent().next();
        } else {
            $(bodyelement).hide();
        }
    });
}

//card / paypal
if ($(".payment-form-panel .panels").find(":input[name='payment_selection']").hasClass('panel-selection-radio') != null) {

    var paymentbodyelement = $(".payment-form-panel .panels");

    $(".payment-form-panel .panels").find(":input[name='payment_selection']").change(function (e) {

        //alert($(this).val());

        var pos = $(this).parent().parent().parent().index();

        //alert(pos);

        if (paymentbodyelement) {

            $(paymentbodyelement).find('.body').hide();

        }

        $(this).parent().parent().parent().find('.body').show();
        paymentbodyelement = $(this).parent().parent().parent();

        /*if ( $(this).val() == 'diff' ) {
            $(this).parent().parent().next().hide();
            $(this).parent().parent().show();
            paymentbodyelement = $(this).parent().parent();
        } else {
            $(paymentbodyelement).hide();
        }*/
    });
}


//add to cart, element button click
if ($(".element-button").attr('data-url') != null) {


    $(".element-button").click(function (e) {

        e.preventDefault();

        //alert($(this).attr('data-url'));

        if ($(this).attr('data-url') == 'add_to_cart') {

            $.ajax({
                type: 'post',
                url: $("#frm_htmleditor_container").attr('action'),
                //data: $("#frm_htmleditor_container").serialize() + '&_token=' + $("#csrf_token").val() + '&page_id=' + $("#hid_page_id").val(),
                data: $("#frm_htmleditor_container").serialize(),
                success: function (response) {
                    console.log(response);
                    var json = JSON.parse(response);

                    if (json.status == 'success')
                        location.href = json.url;
                    else {
                        alert(json.message);
                    }
                },
                error: function (a, b) {
                    document.write(a.responseText);
                }
            });

        } else if ($(this).attr('data-url') == 'next_step') {

            //alert('hello');

            $.ajax({
                type: 'post',
                url: $("#hid_base_url").val() + '/page/' + $("#hid_page_id").val() + '/next-step',
                data: $("#frm_htmleditor_container").serialize() + '&_token=' + $("#csrf_token").val(),
                success: function (response) {
                    console.log(response);
                    var json = JSON.parse(response);

                    if (json.status == 'success') {
                        location.href = json.url;
                    }
                },
                error: function (a, b) {
                    document.write(a.responseText);
                }
            });
        } else if ($(this).attr('data-url') == 'submit') {
            if ($(".product-availability-wrapper b > span").hasClass('product-not-availabel')) {
                alert("Please select valid quantity");
            } else {

                $('#frm_htmleditor_container').submit();
            }
        } else if ($(this).attr('data-url') == 'goto_section') {

            $("html, body").delay(100).animate({
                scrollTop: $($(this).attr('href')).offset().top
            }, 500);
        } else if ($(this).attr('data-url') == 'goto_link') {

            //location.href = $(this).attr('href');
            window.open($(this).attr('href'), '_blank');

        } else if ($(this).attr('data-url') == 'open_modal') {

            //alert($("#data_page_popup").find('.popup-inner').height());

            //alert($("#data_page_popup").find('.popup-inner').height());
            //var calculate_top = eval($("#data_page_popup").offset().top);
            //alert(calculate_top);
            //alert($("#data_page_popup").height());
            //var calculate_top = (eval($("#data_page_popup").height()) / 2) - e.pageY;

            //var calculate_top = e.pageY / 2;
            var calculate_top = 0;
            var window_height = ($(window).height());
            if (e.pageY > window_height) {
                //calculate_top = e.pageY - window_height;
                calculate_top = e.pageY;
                //calculate_top = calculate_top + eval($("#data_page_popup").height() / 2);
            } else {
                calculate_top = e.pageY;
                //calculate_top = calculate_top - eval($("#data_page_popup").height() / 2);
            }

            $("#data_page_popup").show();
            var popup_height = $("#data_page_popup").find('.popup-inner').height();


            calculate_top = calculate_top - (popup_height / 2);
            //alert(calculate_top);
            //alert($("#data_page_popup").find('.popup-inner').height());
            if ((calculate_top + popup_height) >= $(document).height()) {
                calculate_top = calculate_top - popup_height;
            }

            //alert(calculate_top);
            //alert($(document).height());
            //alert($("#data_page_popup").find('.popup-inner').height());

            //alert($('body').height());
            //alert($(window).height());
            $("#data_page_popup").height($('body').height());
            $("#data_page_popup").find('.popup-inner').css('top', calculate_top + 'px');
            //$("#data_page_popup").show();

            /*$("#data_page_popup").css('height', $('body').height());
            //$("#data_page_popup").find('.popup-inner').css('top', e.pageY - 300 + 'px');
            $("#data_page_popup").show();*/

        } else if ($(this).attr('data-url') == 'skip_step') {

            if ($(this).attr('href') == '#skip_step') {
                //alert($(this).attr('href'));
                $.ajax({
                    type: 'post',
                    url: $("#hid_base_url").val() + '/page/skip-steps/skip',
                    data: 'page_id=' + $("#hid_page_id").val() + '&_token=' + $("#csrf_token").val(),
                    success: function (response) {
                        console.log(response);
                        var json = JSON.parse(response);
                        //next_url = response.url;

                        //$("#frm_button_settings").find(":input[name='step_next_url']").val(json.url);
                        location.href = json.url;
                    },
                    error: function (a, b) {
                        document.write(a.responseText);
                    }
                });
            } else {
                location.href = $(this).attr('href');
            }
        }


        $(this).clearQueue();
        e.stopPropagation();
    });

}

$(document).on('click', '.coupon-button, .btn-advance-button', function (e) {

    e.preventDefault();

    var builder_element;
    var button = $(this);
    var this_class = $(button).attr('class');

    //alert("." + this_class);

    //remove other product informations
    //if ( this_class == '' )
    $("." + this_class).each(function (index, element) {

        //alert($(element).attr('id')  + ', ' +  $(button).attr('id'));

        if ($(element).parent().parent().parent().attr('id') != $(button).parent().parent().parent().attr('id')) {
            $(element).find('#hid_product_id').remove();
            $(element).find('#hid_product_price').remove();
            $(element).find('#hid_product_variant_id').remove();
            $(element).find('#product_quantity').remove();
        } else {
            builder_element = element;
        }
    });

    //alert($(builder_element).find('#hid_product_id').val());

    //add the product into step
    $.ajax({
        type: 'post',
        url: $("#hid_base_url").val() + '/funnel/' + $("#frm_hid_funnel_id").val() + '/step/' + $("#frm_hid_funnel_step_id").val() + '/product',
        data: '_token=' + $("#csrf_token").val() + '&product_id=' + $(builder_element).find('#hid_product_id').val() + '&type=' + $(builder_element).find('#hid_product_type').val() + '&step_id=' + $("#frm_hid_funnel_step_id").val() + '&action=sales',
        success: function (response) {
            console.log(response);
            var json = JSON.parse(response);

            if (json.status == 'success') {
                //location.href = json.url;

                //submit the url
                $("#frm_htmleditor_container").submit();
            }
        },
        error: function (a, b) {
            document.write(a.responseText);
        }
    });
});

$(".btn-submit-form-self").click(function (e) {

    e.preventDefault();

    //$("#frm_htmleditor_container").submit();
});


//display order info
/*if ($(".order-info-wrapper").attr("data-de-type") != null) {

    $.ajax({
        type: 'get',
        url: $("#hid_base_url").val() + '/order/get-order-session',
        data: '_token=' + $("#csrf_token").val(),
        success: function (response) {
            console.log(response);

            //alert(response);

            var json = JSON.parse(response);

            if (json.status == 'success') {
                //$(".order-info-wrapper").html(json.html);
                var order = json.order;
                var orderDetails = JSON.parse(order.details);

                //alert(order.details);
                $("#order_confirmation_email_address").text(orderDetails.order.info.customer.email);
                $("#order_confirmation_id").text("");
                //$(".element-order-info > .wrapper > .rows:nth-child(2), .element-order-info > .wrapper > .rows:nth-child(2)").hide();
            }
        },
        error: function (a, b) {
            document.write(a.responseText);
        }
    });
}*/


//Image additionsals click
$(document).on('click', '.product-image-wrapper .additionals ul > li', function (e) {

    e.preventDefault();

    var image_id = $(this).attr('data-image-id');
    var product_type = $(this).attr('data-product-type');
    var product_id = $(this).attr('data-product-id');
    var element = $(this);

    if (product_type == 'shopify') {
        $.ajax({
            type: 'POST',
            url: $("#hid_base_url").val() + '/shopify/image-additional/' + product_id,
            data: '_token=' + $("#csrf_token").val() + '&image_id=' + image_id + '&funnel_id=' + $("#hid_funnel_id").val(),
            //data: '_token=' + $("#csrf_token").val() + '&image_id=' + image_id + '&user_id=' + $("#frm_hid_user_id").val(),
            beforeSend: function () {
                $(element).parent().parent().prev().css('opacity', '0.50');
            },
            success: function (response) {
                console.log(response);

                var json = JSON.parse(response);

                $(element).parent().parent().prev().css('opacity', '1');

                if (json.image.src) {
                    $(element).parent().parent().prev().attr('src', json.image.src);
                }
            },
            error: function (a, b) {
                document.write(a.responseText);
            }
        });
    } else {

        $(element).parent().parent().prev().attr('src', $(this).find('img').attr('src'));
    }
});


if ($(".shipping-method-wrapper").length > 0) {

    /*$.ajax({
        type: 'POST',
        //url: $("#hid_base_url").val() + '/product/info/' + $("#hid_product_id").val(),
        url: $("#hid_base_url").val() + '/product/get-shipping-methods',
        data: '_token=' + $("#csrf_token").val() + '&user_id=' + $("#frm_hid_user_id").val() + '&step_id=' + $("#frm_hid_funnel_step_id").val(),
        beforeSend: function () {
            $(".shipping-method-wrapper").css('opacity', '0.25');
        },
        success: function (response) {
            console.log(response);

            //alert(response);

            $(".shipping-method-wrapper").css('opacity', '1');

            var json = JSON.parse(response);

            if (json.status == 'success') {
                $(".shipping-method-wrapper .wrapper").html(json.html);
            }

        },
        error: function (a, b) {
            document.write(a.responseText);
        }
    });*/

    //update cart on click the shipping
    $(document).on('change', "input[name='shipping_method']", function (e) {

        e.preventDefault();

        $.ajax({
            type: 'POST',
            //url: $("#hid_base_url").val() + '/product/info/' + $("#hid_product_id").val(),
            url: $("#hid_base_url").val() + '/product/shipping/update-cart',
            data: '_token=' + $("#csrf_token").val() + '&user_id=' + $("#frm_hid_user_id").val() + '&step_id=' + $("#frm_hid_funnel_step_id").val() + '&amount=' + $(this).val() + '&shipping_name=' + $(this).next().text(),
            beforeSend: function () {
                $(".product-cart-wrapper").css('opacity', '0.25');
            },
            success: function (response) {
                console.log(response);

                //alert(response);

                $(".product-cart-wrapper").css('opacity', '1');

                var json = JSON.parse(response);

                if (json.status == 'success') {
                    $(".product-cart-wrapper").html(json.html);
                }

            },
            error: function (a, b) {
                document.write(a.responseText);
            }
        });
    });
}

//COUPON / DISCOUNT
if ($(".button-apply-coupon").length > 0) {

    $(document).on('click', '.button-apply-coupon', function (e) {

        e.preventDefault();

        const element = $(this);
        const code = $(this).parent().prev().find('input').val();

        if (code.length > 0) {
            $.ajax({
                type: 'POST',
                url: $("#hid_base_url").val() + '/coupon/apply-coupon',
                data: '_token=' + $("#csrf_token").val() + '&step_id=' + $("#hid_funnel_step_id").val() + '&code=' + code,
                beforeSend: function () {
                    $(".product-cart-wrapper").css('opacity', '0.25');
                },
                success: function (response) {
                    console.log(response);

                    //alert(response);

                    $(".product-cart-wrapper").css('opacity', '1');

                    var json = JSON.parse(response);

                    if (json.status == 'success') {
                        //$(".product-cart-wrapper").html(json.html);

                        html_cart = replace_styles_switch((json.html), $(".product-cart-switch"));
                        $(".product-cart-switch").html(html_cart);

                        $(element).parent().prev().parent().parent().find('.danger').remove();
                        $(element).parent().prev().parent().after("<p class='success'>" + json.message + "</p>");
                    } else {
                        $(element).parent().prev().parent().parent().find('.success').remove();
                        $(element).parent().prev().parent().parent().find('.danger').remove();
                        $(element).parent().prev().parent().after("<p class='danger'>" + json.message + "</p>");
                    }

                },
                error: function (a, b) {
                    document.write(a.responseText);
                }
            });
        } else {
            alert("Please enter the code");
            $(this).parent().prev().find('input').focus();
        }
    });


}

//Shipping Method
/*if ($(".order-shipping-switch").length > 0) {

    $(document).on('click', '.button-apply-coupon', function (e) {

        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: $("#hid_base_url").val() + '/coupon/apply-coupon',
            data: '_token=' + $("#csrf_token").val() + '&step_id=' + $("#hid_funnel_step_id").val() + '&code=' + code,
            beforeSend: function () {
                $(".product-cart-wrapper").css('opacity', '0.25');
            },
            success: function (response) {
                console.log(response);

                //alert(response);

                $(".product-cart-wrapper").css('opacity', '1');

                var json = JSON.parse(response);

                if (json.status == 'success') {
                    //$(".product-cart-wrapper").html(json.html);

                    html_shipping_method = replace_styles_switch((json.html), $(".product-shipping-switch"));
                    $(".order-shipping-switch").html(html_shipping_method);
                }
            },
            error: function (a, b) {
                document.write(a.responseText);
            }
        });
    });
}*/


//display product summary
//if ( $(".product-cart-wrapper").attr("data-de-type") != null ) {



//text field
$(document).on('keyup', '.text-field-wrapper', function (e) {

    $(this).find("input[type='text']").next().val($(this).find("input[type='text']").val());
});


$('[data-popup-open]').on('click', function (e) {
    var targeted_popup_class = jQuery(this).attr('data-popup-open');
    $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);

    e.preventDefault();
});

//----- CLOSE
$('[data-popup-close]').on('click', function (e) {
    var targeted_popup_class = jQuery(this).attr('data-popup-close');
    $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);

    e.preventDefault();
});


//open popup after x seconds
if ($("#data_page_popup").length > 0) {

    //alert(eval($("#data_page_popup").find('.popup-inner').attr('data-modal-open-after')) * 1000);

    var seconds = eval($("#data_page_popup").find('.popup-inner').attr('data-modal-open-after'));

    //alert(seconds);

    if (seconds > 0) {
        $(document).ready(function () {
            setTimeout(function () {
                $("#data_page_popup").css('height', $('body').height());
                $("#data_page_popup").find('.popup-inner').css('top', '145px');
                $("#data_page_popup").show();
            }, seconds * 1000);
        });
    }
}


/////////////////////////////// CREDIT CARd DETECTION
function GetCardType(number) {
    // visa
    var re = new RegExp("^4");
    if (number.match(re) != null)
        return "Visa";

    // Mastercard
    // Updated for Mastercard 2017 BINs expansion
    if (/^(5[1-5][0-9]{14}|2(22[1-9][0-9]{12}|2[3-9][0-9]{13}|[3-6][0-9]{14}|7[0-1][0-9]{13}|720[0-9]{12}))$/.test(number))
        return "Mastercard";

    // AMEX
    re = new RegExp("^3[47]");
    if (number.match(re) != null)
        return "AMEX";

    // Discover
    re = new RegExp("^(6011|622(12[6-9]|1[3-9][0-9]|[2-8][0-9]{2}|9[0-1][0-9]|92[0-5]|64[4-9])|65)");
    if (number.match(re) != null)
        return "Discover";

    // Diners
    re = new RegExp("^36");
    if (number.match(re) != null)
        return "Diners";

    // Diners - Carte Blanche
    re = new RegExp("^30[0-5]");
    if (number.match(re) != null)
        return "Diners - Carte Blanche";

    // JCB
    re = new RegExp("^35(2[89]|[3-8][0-9])");
    if (number.match(re) != null)
        return "JCB";

    // Visa Electron
    re = new RegExp("^(4026|417500|4508|4844|491(3|7))");
    if (number.match(re) != null)
        return "Visa Electron";

    return "";
}


function replace_styles_switch(replacer, replaceable) {

    var element_styles = new Array();

    $(replaceable).find('*').each(function (index, element) {
        if (typeof $(element).attr('style') != 'undefined') {
            element_styles[index] = $(element).attr('style');
            console.log(element_styles[index] + ", ");
        }
    });

    //console.log(alert(element_styles.split()));

    //alert($(replacer).find('*').length);

    var dom_element = document.createElement('div');
    dom_element.innerHTML = replacer;
    $(dom_element).find('*').each(function (index, element) {
        //alert(this);
        $(element).attr('style', element_styles[index]);
    });

    replacer = dom_element.innerHTML;

    //alert(replacer);

    return replacer;
}