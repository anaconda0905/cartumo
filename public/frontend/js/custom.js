$(document).ready(function () {

    //Create funnel


    $(document).on('submit', "#frm_create_funnel_steps", function (e) {

        e.preventDefault();

        var element = $(this);

        //alert($(this).serialize());

        $.ajax({
            type: 'POST',
            url: $(element).attr('action'),
            data: $(this).serialize(),
            success: function (response) {
                console.log(response);
                var json = JSON.parse(response);

                if (json.status == 200) {
                    location.href = json.route;
                } else {
                    alert(json.message);
                }
            },
            error: function (a, b) {
                document.write(a.responseText);
            }
        });
    });


    //update funnel
    $("#frm_update_funnel").submit(function (e) {

        e.preventDefault();

        var element = $(this);

        //alert($(this).serialize());

        $.ajax({
            type: 'PUT',
            url: $(element).attr('action'),
            data: $(this).serialize(),
            success: function (response) {
                console.log(response);
                var json = JSON.parse(response);

                if (json.status == 200) {
                    location.href = json.route;
                } else {
                    alert(json.message);
                }
            },
            error: function (a, b) {
                document.write(a.responseText);
            }
        });
    });

    //funnel remove
    $(".funnel_remove").click(function (e) {

        e.preventDefault();

        var funnel_id = $(this).attr('data-funnel-id');

        if (confirm("Are you sure to delete the funnel?")) {
            $.ajax({
                type: 'DELETE',
                url: $("#hid_base_url").val() + '/funnels/' + funnel_id,
                data: '_token=' + $("#csrf_token").val(),
                success: function (response) {
                    console.log(response);
                    var json = JSON.parse(response);

                    if (json.status == 200) {
                        location.href = json.route;
                    } else {
                        alert(json.message);
                    }
                },
                error: function (a, b) {
                    document.write(a.responseText);
                }
            });
        }
    });


    //remove template for funnel
    $(document).on('click', '.page-template-remove', function (e) {

        e.preventDefault();

        if (confirm("Are you sure to remove the template from the step?")) {
            var page_id = $(this).attr('data-page-id');

            //alert(page_id);

            $.ajax({
                type: 'GET',
                url: $("#hid_base_url").val() + '/pages/remove-template/' + page_id,
                data: '_token=' + $("#csrf_token").val(),
                success: function (response) {
                    console.log(response);

                    var json = JSON.parse(response);

                    if (json.status == 200) {
                        location.href = location.href;
                    }

                },
                error: function (a, b) {
                    console.log(a.responseText);
                }
            });
        }
    });


    //add product
    $("#frm_save_product").submit(function (e) {

        e.preventDefault();

        //alert(this);

        var form = $(this);

        $.ajax({
            type: 'POST',
            url: $("form").attr('action'),
            data: $(this).serialize() + '&product_type=manual',
            success: function (response) {
                //alert(response);
                console.log(response);

                $("#myModal").modal('hide');
                $("#product_list").prepend(response);
            },
            error: function (a, b) {
                console.log(a.responseText);
            }
        });
    });


    /*$(document).on('click', '.manual-choose-product', function (e) {

        e.preventDefault();

        //alert(this);

        var button = $(this);

        alert($(button).attr('data-action-url'));

        $.ajax({
            type: 'POST',
            url: $(button).attr('data-action-url'),
            data: 'product_type=manual&product[product_id]=' + $(button).attr('data-product-id') + '&_token=' + $("#csrf_token").val(),
            success: function (response) {
                //alert(response);
                console.log(response);

                location.href = location.href;

                //$("#myModal").modal('hide');
                //$("#product_list").prepend(response);
            },
            error: function (a, b) {
                console.log(a.responseText);
            }
        });
    });*/

    var row_edit;

    //edit products
    $(document).on('click', ".product-edit", function (e) {

        e.preventDefault();

        //alert($(this).attr('data-product-step-id'));
        //alert($("#hid_base_url").val() + '/funnels/' + $(this).attr('data-product-funnel-id') + '/steps/' + $(this).attr('data-product-step-id') + '/product/' + $(this).attr('data-step-product-id'));

        var product_id = $(this).attr('data-step-product-id');
        var funnel_id = $(this).attr('data-product-funnel-id');
        var step_id = $(this).attr('data-product-step-id');
        var element = $(this);

        $.ajax({
            type: 'GET',
            url: $("#hid_base_url").val() + '/funnels/' + $(this).attr('data-product-funnel-id') + '/steps/' + $(this).attr('data-product-step-id') + '/product/' + $(this).attr('data-step-product-id') + '/edit',
            //url: $("#hid_base_url").val() + '/products/' + $(this).attr('data-product-id') ,
            data: $(this).serialize(),
            success: function (response) {
                //alert(response);
                //console.log(response);

                $("#productEditModal").find('.modal-body').html(response);
                //row_edit = $(this).parent().parent().parent().parent();
                row_edit = $(element).parents('.products');
            },
            error: function (a, b) {
                console.log(a.responseText);
            }
        });
    });

    //update product
    $(document).on('submit', "#frm_update_product", function (e) {

        e.preventDefault();

        var form = $(this);

        //alert($(form).attr('action'));

        $.ajax({
            type: 'PUT',
            url: $(form).attr('action'),
            data: $(this).serialize(),
            success: function (response) {
                //alert(response);
                //console.log(response);

                $("#productEditModal").modal('hide');
                //$(this).parent().parent().parent().parent().remove();
                $(row_edit).remove();
                $("#product_list").prepend(response);
            },
            error: function (a, b) {
                console.log(a.responseText);
            }
        });
    });

    //remove product
    $(document).on('click', ".data-product-remove", function (e) {

        e.preventDefault();

        //alert(this);

        if (confirm("Are you sure to delete this product?")) {
            var element = $(this);
            var step_product_id = $(this).attr('data-step-product-id');
            var product_id = $(this).attr('data-product-id');
            var funnel_id = $(this).attr('data-product-funnel-id');
            var step_id = $(this).attr('data-product-step-id');
            var row = $(this).parent().parent().parent().parent();
            var url = $(this).attr('data-action-url');

            //alert($("#hid_base_url").val() + '/funnels/' + funnel_id +'/steps/' +  step_id+ '/products/' + product_id);

            $.ajax({
                type: 'DELETE',
                url: url,
                //url: $("#hid_base_url").val() + '/funnels/' + funnel_id + '/steps/' + step_id + '/product/' + product_id,
                data: '_token=' + $("#csrf_token").val() + '&step_product_id=' + step_product_id,
                beforeSend: function () {
                    $(row).css('opacity', '0.50');
                },
                success: function (response) {
                    console.log(response);

                    var json = JSON.parse(response);

                    if (json.status == 200) {
                        alert(json.message);
                        $(row).remove();

                        location.href = location.href;
                    }
                },
                error: function (a, b) {
                    console.log(a.responseText);
                }
            });
        }
    });


    /*$(document).on('click', ".funnel-steps-block .steps li a", function (e) {

        //alert(( e.target.offsetWidth) + ',' + e.offsetX);

        if (e.offsetX > (e.target.offsetWidth - 28)) {
            // click on element
            //alert('item');

            e.preventDefault();

            if (confirm("Are you sure to delete the step?")) {
                //alert($("#hid_base_url").val() + '/funnels/' + $(this).attr('data-funnel-id') + '/steps/' + $(this).attr('data-step-id'));

                alert($("#hid_base_url").val() + '/funnels/' + $(this).attr('data-funnel-id') + '/steps/' + $(this).attr('data-step-id'));

                $.ajax({
                    type: 'DELETE',
                    url: $("#hid_base_url").val() + '/funnels/' + $(this).attr('data-funnel-id') + '/steps/' + $(this).attr('data-step-id'),
                    data: "_token=" + $("#csrf_token").val(),
                    success: function (response) {
                        console.log(response);
                        var json = JSON.parse(response);

                        if (json.status == 200) {
                            location.href = json.route;
                        } else {
                            alert(json.message);
                        }
                    },
                    error: function (a, b) {
                        document.write(a.responseText);
                    }
                });
            }
        }
    });*/

    $(document).on("click", "#sortable .funnel-steps-items > li:last-child", function (e) {

        e.preventDefault();

        if (confirm("Are you sure to delete the step?")) {
            //alert($("#hid_base_url").val() + '/funnels/' + $(this).attr('data-funnel-id') + '/steps/' + $(this).attr('data-step-id'));

            //alert($("#hid_base_url").val() + '/funnels/' + $(this).attr('data-funnel-id') + '/steps/' + $(this).attr('data-step-id'));

            $.ajax({
                type: 'DELETE',
                url: $("#hid_base_url").val() + '/funnels/' + $(this).parent().parent().attr('data-funnel-id') + '/steps/' + $(this).parent().parent().attr('data-step-id'),
                data: "_token=" + $("#csrf_token").val(),
                success: function (response) {
                    console.log(response);
                    var json = JSON.parse(response);

                    if (json.status == 200) {
                        location.href = json.route;
                    } else {
                        alert(json.message);
                    }
                },
                error: function (a, b) {
                    document.write(a.responseText);
                }
            });
        }
    });


    //dynamic image load
    if ($("#img_dynamic").attr('data-page-id') != null) {
        //alert('_token=' + $("#csrf_token").val() + '&step_id=' + $(this).attr('data-step-id'));


        /*$.ajax({
         type: 'POST',
         url: $("#hid_base_url").val() + '/pages/get-template-image',
         data: '_token=' + $("#csrf_token").val() + '&uri_load=' + $('#img_dynamic').attr('data-uri-load'),
         success: function(response) {
         console.log(response);
         },
         error:function(a, b) {
         document.write(a.responseText);
         }
         });*/

        $.ajax({
            type: 'POST',
            url: $("#hid_base_url").val() + '/pages/get-screenshoot/' + $("#img_dynamic").attr('data-page-id'),
            data: '_token=' + $("#csrf_token").val(),
            success: function (response) {
                //alert(response);

                /*html2canvas($(response), {
                 allowTaint: true,
                 onrendered: function(canvas) {
                 $('#img_dynamic').html(canvas);
                 var dataURL = canvas.toDataURL();
                 console.log(dataURL);
                 }
                 });*/
            },
            error: function (a, b) {
                document.write(a.responseText);
            }
        });
    }


    ////CSV download
    $("#sales_csv_download").click(function (e) {

        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: $("#hid_base_url").val() + '/order/download-csv/',
            data: '_token=' + $("#csrf_token").val(),
            success: function (response) {
                console.log(response);
            },
            error: function (a, b) {
                document.write(a.responseText);
            }
        });
    });


    //NAV
    var tmp_menu_item;
    $(".menu_section>ul.side-menu>li").hover(function (e) {

        e.preventDefault();

        //alert(this);

        if (!$(this).hasClass('active')) {
            $(this).addClass('active');

            if ($(this).find('a').next().hasClass('child_menu')) {
                $(this).find('a').next().show();
            }
        }

    }).bind('mouseleave', function (e1) {

        e1.preventDefault();

        if ($(this).hasClass('active')) {
            $(this).removeClass('active');

            if ($(this).find('a').next().hasClass('child_menu')) {
                $(this).find('a').next().hide();
            }
        }
    });

    /* --------------------------------------------------- MENU FIX ------------------------------------------ */


    //html2canvas
    if ($("#hid_content") != null) {
        //alert('ok');

        //var element = $("#hid_content");

        /*html2canvas(document.getElementById("hid_content"), {
         onrendered: function(canvas) {
         var img = canvas.toDataURL("image/png");
         $('body').append('<img src="'+img+'"/>');
         console.log(img);
         }
         });*/
    }


    /* --------------------------------------------------------------- PRODUCT ---------------------------------------------------- */

    $("#frm_manual_product_add").submit(function (e) {

        e.preventDefault();

        var button = $(this).find('.buttion-product-action');

        //alert(this);

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            beforeSend: function () {
                $(button).attr('disabled', 'disabled')
                $(button).html('<i class="fa fa-circle-o-notch fa-spin"></i>');
            },
            success: function (response) {
                console.log(response);
                $(button).prop('disable', false);
                var json = JSON.parse(response);

                if (json.status == 200) {
                    location.href = json.url;
                }
            },
            error: function (a, b) {
                document.write(a.responseText);
            }
        });
    });


    $("#product_manual_update").submit(function (e) {

        e.preventDefault();

        var button = $(this).find('.buttion-product-action');
        //alert(this);

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            beforeSend: function () {
                $(button).attr('disabled', 'disabled');
                $(button).html('<i class="fa fa-circle-o-notch fa-spin"></i>');
            },
            success: function (response) {
                console.log(response);
                $(button).prop('disable', false);
                var json = JSON.parse(response);

                if (json.status == 200) {
                    location.href = json.url;
                }
            },
            error: function (a, b) {
                document.write(a.responseText);
            }
        });
    });

    //remove varient
    $(document).on('click', '.remove-product-varient', function (e) {

        e.preventDefault();

        //alert($(this).attr('data-option-id'));
        var button = $(this);
        var option_id = $(this).attr('data-option-id');
        var index = $(this).attr('data-index-id');
        var row = $(this).parent();

        //alert(option_id);

        $.ajax({
            type: 'POST',
            url: $("#hid_base_url").val() + '/products/remove-varient/' + option_id,
            data: '_token=' + $("#csrf_token").val() + '&index=' + index,
            beforeSend: function () {
                $(button).prop('disable', true);
                $(row).css('opacity', '0.50');
            },
            success: function (response) {
                console.log(response);
                $(button).prop('disable', false);
                var json = JSON.parse(response);

                if (json.status == 200) {
                    $(row).remove();
                }
            },
            error: function (a, b) {
                document.write(a.responseText);
            }
        });
    });


    //remove product
    $('.product-manual-remove').click(function (e) {

        e.preventDefault();

        if (confirm("Are you sure to delete the product?")) {
            //alert($(this).attr('data-option-id'));
            var button = $(this);
            var product_id = $(this).attr('data-product-id');
            var row = $(this).parent().parent();

            $.ajax({
                type: 'DELETE',
                url: $("#hid_base_url").val() + '/products/' + product_id,
                data: '_token=' + $("#csrf_token").val(),
                beforeSend: function () {
                    $(button).prop('disable', true);
                    $(row).css('opacity', '0.50');
                },
                success: function (response) {
                    console.log(response);
                    $(button).prop('disable', false);
                    var json = JSON.parse(response);

                    if (json.status == 200) {
                        $(row).remove();
                    }
                },
                error: function (a, b) {
                    document.write(a.responseText);
                }
            });
        }
    });


    //add varients
    $("#add_product_varients").click(function (e) {

        e.preventDefault();

        /*var html = "<ul>";
         html += "<li><lable>Name</lable><select name='option_name[]' class='form-control'><option name='size'>Size</option> <option name='color'>Color</option></select></li>"
         html += "<li><lable>Value</lable><input class='form-control' type='text' name='opion_value[]' /></li>";
         html += "<li><lable>Price</lable><input class='form-control' type='text' name='option_price[]' /></li>";
         html += "<li><i class='fa fa-trash trash_varients' aria-hidden='true'></i></li>";
         html += "</ul>";*/

        var html = "<ul>";
        html += "<li><lable>Name</lable><select name='option_name[]' class='form-control'><option name='style'>Style</option><option name='size'>Size</option> <option name='color'>Color</option><option name='quantity'>Quantity</option> <option name='price'>Price</option></select></li>"
        html += "<li><lable>Value</lable><input class='form-control' type='text' name='opion_value[]' /></li>";
        html += "<li><i class='fa fa-trash trash_varients' aria-hidden='true'></i></li>";
        html += "</ul>";

        $(this).prev().append(html);
    });


    var replace_row;
    $(document).on('click', '.edit-product-varients', function (e) {

        e.preventDefault();

        //alert(this);

        var row = replace_row = $(this).parent().parent();
        var modal = $("#productOptionEditModal");

        var style = $(row).find("td:nth-child(3)").text();
        var size = $(row).find("td:nth-child(4)").text();
        var color = $(row).find("td:nth-child(5)").text();
        var price = $(row).find("td:nth-child(6)").text();
        var quantity = $(row).find("td:nth-child(7)").text();
        //var html = "<tr>";
        //var json = '{"style": "' + style + '","color": "' + color + '","size":"' + size + '","price": "' + price + '","quantity": "' + quantity + '", "image": ""}';

        //alert(style);

        $(modal).find("#ed_style").val(style);
        $(modal).find("#ed_size").val(size);
        $(modal).find("#ed_color").val(color);
        $(modal).find("#ed_price").val(price);
        $(modal).find("#ed_quantity").val(quantity);

        $(modal).modal('show');
    });


    /*$(document).on('click', '#modal_save_varients', function(e) {

     e.preventDefault();

     var form = $("#frm_product_varients_add");
     var modal = $("#productOptionAddModal");
     var style = $(modal).find("input[name='style']").val();
     var size = $(modal).find("input[name='size']").val();
     var color = $(modal).find("input[name='color']").val();
     var price = $(modal).find("input[name='price']").val();
     var quantity = $(modal).find("input[name='quantity']").val();
     var html = "<tr>";
     var json = '{"style": "' + style + '","color": "' + color + '","size":"' + size + '","price": "' + price + '","quantity": "' + quantity + '", "image": ""}';

     html += "<td><input type='checkbox' name='options[]' /></td>";
     html += "<td><img src='../../images/no-images.png' style='width: 42px; height: 42px' class='varient-image' /></td>";
     html += "<td>" + style + "</td>";
     html += "<td>" + size + "</td>";
     html += "<td>" + color + "</td>";
     html += "<td class='text-right'>" + price + "</td>";
     html += "<td class='text-right'>" + quantity + "</td>";
     html += "<td class='text-right'><button class='btn btn-success'><i class='fa fa-pencil' aria-hidden='true'></i></button><button class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button></td>";
     html += "<input type='hidden' name='varients[]' value='" + json + "' />";
     html += "</tr>";

     console.log(json);

     $("#product_varients_container tbody").append(html);

     $("#frm_product_varients_add").trigger('reset');
     });*/


    $(document).on('click', '#modal_update_varients', function (e) {

        e.preventDefault();

        var form = $("#frm_product_varients_edit");
        var modal = $("#productOptionEditModal");
        var style = $(modal).find("input[name='style']").val();
        var size = $(modal).find("input[name='size']").val();
        var color = $(modal).find("input[name='color']").val();
        var price = $(modal).find("input[name='price']").val();
        var quantity = $(modal).find("input[name='quantity']").val();
        var html = "<tr>";
        var json = '{"style": "' + style + '","color": "' + color + '","size":"' + size + '","price": "' + price + '","quantity": "' + quantity + '", "image": ""}';

        html += "<td><input type='checkbox' name='options[]' /></td>";
        html += "<td><img src=" + $("#hid_base_url").val() + "'images/no-images.png' style='width: 42px; height: 42px' class='varient-image' /></td>";
        html += "<td>" + style + "</td>";
        html += "<td>" + size + "</td>";
        html += "<td>" + color + "</td>";
        html += "<td class='text-right'>" + price + "</td>";
        html += "<td class='text-right'>" + quantity + "</td>";
        html += "<td class='text-right'><button class='btn btn-success'><i class='fa fa-pencil' aria-hidden='true'></i></button><button class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button></td>";
        html += "<input type='hidden' name='varients[]' value='" + json + "' />";
        html += "</tr>";

        console.log(json);

        $(replace_row).find("td:nth-child(3)").text(style);
        $(replace_row).find("td:nth-child(4)").text(size);
        $(replace_row).find("td:nth-child(5)").text(color);
        $(replace_row).find("td:nth-child(6)").text(price);
        $(replace_row).find("td:nth-child(7)").text(quantity);

        $(replace_row).find("input[name='varients[]']").remove();
        $(replace_row).append("<input type='hidden' name='varients[]' value='" + json + "' />");


        //$(replace_row).after(html);
        //$(replace_row).remove();

        //$("#frm_product_varients_add").trigger('reset');
    });

    //Image upload
    var varient_image_holder = "";
    $(document).on('click', ".varient-image", function (e) {

        e.preventDefault();

        varient_image_holder = $(this);

        $("#varient_image_file").trigger("click");
    });

    $(document).on('change', "#varient_image_file", function (e) {
        e.preventDefault();
        $(this).parent().submit();
    });

    $(document).on('submit', "#product_variants_image_upload", function (e) {

        e.preventDefault();

        //alert('submited');

        var formData = new FormData(this);
        formData.append("_token", $("#csrf_token").val());

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $(varient_image_holder).after("<img src='../../images/ajax-loader.gif' id='image_loader' />");
            },
            success: function (data) {
                console.log("success");
                console.log(data);

                $(varient_image_holder).parent().find('#image_loader').remove();

                var json = JSON.parse(data);

                if (json.success == 'done') {
                    $(varient_image_holder).attr('src', json.url);
                    $(varient_image_holder).parent().find(":input[type='hidden']").remove();
                    $(varient_image_holder).after("<input type='hidden' name='varient_image[]' data-image-file='" + json.image + "' value='" + json.url + "' />");
                }
            },
            error: function (data, b) {
                console.log("error");
                console.log(data.responseText);
            }
        });
    });


    $(document).on('click', '.remove-varients', function (e) {

        e.preventDefault();

        //alert(this);

        var button = $(this);
        var varient_id = $(this).attr('data-varient-id');
        var row = $(this).parent().parent();

        if (confirm("Are you sure to delete the option?")) {
            $.ajax({
                type: 'DELETE',
                url: $("#hid_base_url").val() + '/products/remove-varient/' + varient_id,
                data: '_token=' + $("#csrf_token").val(),
                beforeSend: function () {
                    $(button).prop('disable', true);
                    $(row).css('opacity', '0.50');
                },
                success: function (response) {
                    console.log(response);
                    $(button).prop('disable', false);
                    var json = JSON.parse(response);

                    if (json.status == 200) {
                        $(row).remove();
                    }
                },
                error: function (a, b) {
                    document.write(a.responseText);
                }
            });
        }
    });


    //////////////////////////////////////////////
    $(document).on('click', '#modal_add_varient_option', function (e) {

        e.preventDefault();

        if ($(".option-varient-container .row").length < 3)
            $(this).parent().prev().find('.option-varient-container').append('<div class="row clearfix"><div class="col-md-3"><div class="form-group"><label for="style">Option Name</label><input type="text" class="form-control" name="option_name[]" placeholder="Option Name" /></div></div><div class="col-md-8"><div class="form-group"><label for="style">Option Value</label><textarea rows="2" name="option_value[]" class="form-control" placeholder="Seperate options with comma"></textarea></div></div><div class="col-md-1" style="margin-top: 31px;"><button type="button" class="btn btn-danger remove-varient-option"><i class="fa fa-times" aria-hidden="true"></i></button></div></div>');
        else {
            $("#modal_add_varient_option").hide();
        }
    });


    $(document).on('click', '.remove-varient-option', function (e) {

        e.preventDefault();

        $(this).parent().parent().remove();
    });


    $(document).on('click', '#modal_save_varients', function (e) {

        e.preventDefault();

        var base = $(".option-varient-container");
        var flag_first_run = true;
        var no_of_options = 1;
        var hidden_html = "";

        $(base).find('.row').each(function (index, element) {

            //no_of_options *= $(element).find('textarea').val().split(',').length;

            //hidden_html += "<input type='hidden' name='option_name[]' value='" + $(element).find(":input[name='option_name']").val() + "' />";
        });

        $("#product_varients_container tbody").html("");

        var options = $(base).find('.row:first-child').find('textarea').val().split(',');
        //alert(options.length);
        //alert($(".option-varient-container").find('.row:nth-child(2)').html());
        //alert($(".option-varient-container").find('.row:nth-child(2)').find('textarea').val().split(','));

        for (i = 0; i < options.length; i++) {

            //var option_name = options[i];

            //var sub_rows = (base).find('.row:not(:first-child)').length;
            //alert(sub_rows);

            //alert($(".option-varient-container").find('.row:nth-child(2)').html());

            if ($(".option-varient-container").find('.row:nth-child(2)').find('textarea').val()) {

                var inner1 = $(".option-varient-container").find('.row:nth-child(2)').find('textarea').val().split(',');
                //alert(inner1.length);

                for (j = 0; j < inner1.length; j++) {

                    if ($(".option-varient-container").find('.row:nth-child(3)').find('textarea').val()) {

                        var inner2 = $(".option-varient-container").find('.row:nth-child(3)').find('textarea').val().split(',');
                        var row = $(".option-varient-container").find('.row:nth-child(3)');

                        for (k = 0; k < inner2.length; k++) {
                            var html = "<tr>";
                            html += "<td><input type='checkbox' name='options[]' /></td>"; //checkbox
                            html += "<td><img src='" + $("#hid_base_url").val() + "/images/no-images.png' style='width: 42px; height: 42px' class='varient-image' /></td>"; //image
                            html += "<td class='varient_name'>" + options[i] + ', ' + inner1[j] + ', ' + inner2[k];
                            html += "<input type='hidden' name='variants[]' value='" + options[i] + ',' + inner1[j] + ',' + inner2[k] + "' /></td>";
                            html += "<td><input type='text' class='form-control' name='option_price[]' value='' /></td>";
                            html += "<td><input type='text' class='form-control' name='option_sku[]' value='' /></td>";
                            html += "<td><input type='text' class='form-control' name='option_inventory[]' value='' /></td>";
                            html += "<td class='text-right'><button type='button' class='btn btn-danger varient-table-option-remove'><i class='fa fa-trash' aria-hidden='true'></i></button></td>";
                            html += "</tr>";

                            $("#product_varients_container tbody").append(html);
                        }

                    } else {

                        var html = "<tr>";
                        html += "<td><input type='checkbox' name='options[]' /></td>"; //checkbox
                        html += "<td><img src='" + $("#hid_base_url").val() + "/images/no-images.png' style='width: 42px; height: 42px' class='varient-image' /></td>"; //image
                        html += "<td class='varient_name'>" + options[i] + ', ' + inner1[j];
                        html += "<input type='hidden' name='variants[]' value='" + options[i] + ',' + inner1[j] + "' /></td>";
                        html += "<td><input type='text' class='form-control' name='option_price[]' value='' /></td>";
                        html += "<td><input type='text' class='form-control' name='option_sku[]' value='' /></td>";
                        html += "<td><input type='text' class='form-control' name='option_inventory[]' value='' /></td>";
                        html += "<td class='text-right'><button type='button' class='btn btn-danger varient-table-option-remove'><i class='fa fa-trash' aria-hidden='true'></i></button></td>";
                        html += "</tr>";

                        $("#product_varients_container tbody").append(html);
                    }
                }
            } else {

                var html = "<tr>";
                html += "<td><input type='checkbox' name='options[]' /></td>"; //checkbox
                html += "<td><img src='" + $("#hid_base_url").val() + "/images/no-images.png' style='width: 42px; height: 42px' class='varient-image' /></td>"; //image
                html += "<td class='varient_name'>" + options[i];
                html += "<input type='hidden' name='variants[]' value='" + options[i] + "' /></td>";
                html += "<td><input type='text' class='form-control' name='option_price[]' value='' /></td>";
                html += "<td><input type='text' class='form-control' name='option_sku[]' value='' /></td>";
                html += "<td><input type='text' class='form-control' name='option_inventory[]' value='' /></td>";
                html += "<td class='text-right'><button type='button' class='btn btn-danger varient-table-option-remove'><i class='fa fa-trash' aria-hidden='true'></i></button></td>";
                html += "</tr>";

                $("#product_varients_container tbody").append(html);
            }
        }

        //$("#product_varients_container tbody").after(hidden_html);

    });


    $(document).on('click', '.varient-table-option-remove', function (e) {

        e.preventDefault();

        $(this).parent().parent().remove();
    });


    function getFormData($form) {
        var unindexed_array = $form.serializeArray();
        var indexed_array = {};
        var str = "";

        $.map(unindexed_array, function (n, i) {
            indexed_array[n['name']] = n['value'];
        });

        return indexed_array;
    }


    /*$(document).on('click', '.trash_varients', function(e) {

     e.preventDefault();

     $(this).parent().parent().remove();
     });*/


    //Image upload Product
    var image_holder;
    var img_type;
    $(".image .main-image img").click(function (e) {

        e.preventDefault();

        image_holder = $(this);
        img_type = "main";

        $("#frm_product_image_upload > #file_product_add_image").trigger("click");
    });

    $(".image .addition-images img").click(function (e) {

        e.preventDefault();

        image_holder = $(this);
        img_type = "additionsals";

        $("#frm_product_image_upload > #file_product_add_image").trigger("click");
    });

    $("#file_product_add_image").change(function (e) {
        e.preventDefault();
        $(this).parent().submit();
    });

    $("#frm_product_image_upload").submit(function (e) {

        e.preventDefault();

        //alert('submited');

        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $(image_holder).parent().append("<img src='" + $("#hid_base_url").val() + "/images/ajax-loader.gif' id='image_loader' />");
            },
            success: function (data) {
                console.log("success");
                console.log(data);

                $(image_holder).parent().find('#image_loader').remove();

                var json = JSON.parse(data);

                if (json.success == 'done') {
                    $(image_holder).attr('src', json.url);

                    if (img_type == "main") {
                        if ($("#frm_manual_product_add").attr('id') != null)
                            $("#frm_manual_product_add").append("<input type='hidden' name='image' value='" + json.url + "' />");
                        else
                            $("#product_manual_update").append("<input type='hidden' name='image' value='" + json.url + "' />");
                    }
                    else if ($("#frm_manual_product_add").attr('id') != null)
                        $("#frm_manual_product_add").append("<input type='hidden' name='additionsals[]' value='" + json.url + "' />");
                    else
                        $("#product_manual_update").append("<input type='hidden' name='additionsals[]' value='" + json.url + "' />");
                }
            },
            error: function (data) {
                console.log("error");
                console.log(data);
            }
        });
    });


    //Funnel clone
    $("#funnel_step_clone").click(function (e) {

        e.preventDefault();

        var funnel_id = $(this).attr('data-funnel-id');
        var step_id = $(this).attr('data-step-id');

        //alert($("#hid_base_url").val() + '/funnels/' + funnel_id + '/step/' + step_id + '/clone');

        $.ajax({
            type: 'POST',
            url: $(this).attr('data-action-url'),
            data: '_token=' + $("#csrf_token").val(),
            success: function (response) {
                console.log(response);

                var json = JSON.parse(response);

                if (json.status == 'success') {
                    location.href = json.url;
                } else {
                    alert(json.message);
                }
            },
            error: function (a, b) {
                document.write(a.responseText);
            }
        });
    });

    //update funnel step
    $(document).on('submit', "#update_funnel_steps", function (e) {

        e.preventDefault();

        var element = $(this);

        //alert($(this).serialize());

        $.ajax({
            type: 'put',
            url: $(this).attr('data-action-url'),
            data: $(this).serialize(),
            success: function (response) {
                console.log(response);
                var json = JSON.parse(response);

                if (json.status == 'success') {
                    location.href = json.route;
                } else {
                    alert(json.message);
                }
            },
            error: function (a, b) {
                document.write(a.responseText);
            }
        });
    });


    //remove funnel step template
    $(document).on('click', "#funnel_step_template_remove", function (e) {

        e.preventDefault();

        var element = $(this);

        //alert($(this).serialize());

        if (confirm("Are you sure to remove the template?")) {
            $.ajax({
                type: 'post',
                url: $(this).attr('data-action-url'),
                data: '_token=' + $("#csrf_token").val(),
                success: function (response) {
                    console.log(response);
                    //alert(response);
                    var json = JSON.parse(response);

                    if (json.status == 'success') {
                        location.href = json.url;
                    } else {
                        alert(json.message);
                    }
                },
                error: function (a, b) {
                    document.write(a.responseText);
                }
            });
        }
    });


    //remove funnel step
    $(document).on('click', "#funnel_step_remove", function (e) {

        e.preventDefault();

        if (confirm("Are you sure to delete the step?")) {
            //alert($("#hid_base_url").val() + '/funnels/' + $(this).attr('data-funnel-id') + '/steps/' + $(this).attr('data-step-id'));

            $.ajax({
                type: 'DELETE',
                url: $(this).attr('data-action-url'),
                data: "_token=" + $("#csrf_token").val(),
                success: function (response) {
                    console.log(response);
                    var json = JSON.parse(response);

                    if (json.status == 200) {
                        location.href = json.route;
                    } else {
                        alert(json.message);
                    }
                },
                error: function (a, b) {
                    document.write(a.responseText);
                }
            });
        }
    });


    ////Manual dropdown click
    $(document).on("click", ".full-dropdown ul > li > a", function (e) {

        $(this).parent().parent().next().val($(this).attr('data-product-id'));
        $(this).parent().parent().prev().prev().find('span:first-child').html($(this).find("span:last-child").html());
    });


    //.nav.navbar-nav > li > a
    $(document).on("click", ".nav.navbar-nav > li > a", function (e) {

        var html = $(this).html().trim().split('</i> ');
        console.log(html);

        if ( html[1] == 'Help' ) {
            window.open($(this).attr('href'));
            return true;
        }
    });
});


//create a script that will check for new order for logged in user and notify
function check_new_order() {

    console.log("Sales Proof fired Up");

    $.ajax({
        type: 'POST',
        url: $("#hid_base_url").val() + '/order/latest-order-toast',
        data: "_token=" + $("#csrf_token").val(),
        success: function (response) {
            console.log(response);
            var json = JSON.parse(response);

            if (json.status == 'success') {

                // Display a success toast, with a title
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": function () {
                        location.href = json.url;
                    },
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                toastr.success(json.title, json.message);

            } else {
                //alert(json.message);
            }
        },
        error: function (a, b) {
            //console.log(a.responseText);
        }
    });
}
