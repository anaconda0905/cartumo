var insert_into;
var element_handler;
var openedModel;
var settingsOpenModal;
var switch_to_tab;
var replace_container;
var main_body_element = $("#main-html-container");
var option_open_for;
var page_content = "";
var is_page_saved = false;

const DEFAULT_PARAGRAPH_LINE_HEIGHT = 20;
const DEFAULT_PARAGRAPH_FONT_SIZE = 17;
const DEFAULT_SUB_HEADLINE_LINE_HEIGHT = 20;
const DEFAULT_ICON_LIST_LINE_HEIGHT = 20;
const DEFAULT_ICON_LIST_FONT_SIZE = 15;
const DEFAULT_ICON_LIST_ICON_FONT_SIZE = 15;
const DEFAULT_ICON_LIST_ICON_TEXT_GAP = 15;
const DEFAULT_TEXT_BLOCK_HEADLINE_PARAGRAPH_GAP = 15;
const DEFAULT_TEXT_BLOCK_HEADLINE_FONT_SIZE = 32;
const DEFAULT_TEXT_BLOCK_PARAGRAPH_FONT_SIZE = 16;
const DEFAULT_FAQ_ANSWAR_LINE_HEIGHT = 22;

//shipping address form
const DEFAULT_SHIPPING_FORM_CAPTION_FONT_SIZE = 16;
const DEFAULT_SHIPPING_FORM_INFO_FONT_SIZE = 15;
const DEFAULT_SHIPPING_FORM_CAPTION_PADDING = 15;
const DEFAULT_SHIPPING_FORM_CAPTION_MARGIN = 15;

const DEFAULT_PRODUCT_VARIENT_WIDTH = 100;


function make_element_draggable() {

    $(".section-groups").sortable({
        connectWith: ".section-groups",
        distance: 5,
        helper: "clone",
        placeholder: "sortable-placeholder",
        start: function (e, ui) {
            ui.placeholder.height(ui.item.height());
            ui.placeholder.css('visibility', 'visible');
        },
        stop: function (event, ui) {
            // save new sort order
        }
    });

    $(".row-groups").sortable({
        connectWith: ".row-groups",
        distance: 5,
        helper: "clone",
        placeholder: "sortable-placeholder",
        start: function (e, ui) {
            ui.placeholder.height(ui.item.height());
            ui.placeholder.css('visibility', 'visible');
        },
        stop: function (event, ui) {
            // save new sort order
        }
    });

    $(".element-groups").sortable({
        connectWith: ".element-groups",
        distance: 5,
        helper: "clone",
        placeholder: "sortable-placeholder",
        start: function (e, ui) {
            $(this).sortable('refreshPositions');
            ui.placeholder.height(ui.item.height());
            ui.placeholder.css('visibility', 'visible');
            ////console.log(ui);
            //sender_element_holder
        },
        update: function (event, ui) {
            if (ui.sender) {

                if ($(ui.sender).html().trim().length == 0) {
                    if ($(ui.sender).hasClass('element-groups')) {
                        $(ui.sender).html("<button class='add-inner-element btn btn-primary add-element' data-section-id='element' id='element_modal' alt='Add elements' data-toggle='modal' data-target='#elementModal'>ADD ELEMENT </button>");
                    }
                }
            }

        },
        stop: function (event, ui) {
            if (typeof $(ui.item).parent().find('.add-element') != 'undefined') {
                $(ui.item).parent().find('.add-element').remove();
            }
        }
    });
}


//$(document).ready(function() {
$(document).ready(function () {


    //$('.html-editor').trumbowyg();
    $('.html-editor').summernote();

    //$('#frm_htmleditor_save').data('serialize', $('#frm_htmleditor_save').serialize()); // On load save form current state
    $("#htmleditor").find('grammarly-btn').remove();
    page_content = $("#htmleditor").html();

    //alert($("#htmleditor").html().length  + ", " + page_content.length);

    // With JQuery
    $("#seperator_margin").slider({
        min: 1,
        max: 50,
        scale: 'logarithmic',
        step: 1
    });

    // With JQuery
    $('#ex1').slider({
        formatter: function (value) {
            return 'Current value: ' + value;
        }
    });

    $(".padding-setting-sliders").slider({
        min: 1,
        max: 50,
        scale: 'logarithmic',
        step: 1
    });

    $(".margin-setting-sliders").slider({
        min: 1,
        max: 50,
        scale: 'logarithmic',
        step: 1
    });


    $('.datetimepicker.date').datetimepicker({
        format: 'MM/DD/YYYY'
    });

    $('.datetimepicker.time').datetimepicker({
        format: 'hh:mm'
    });

    var color_selector_element;


    $(document).on("focus", ".color-settings", function (e) {

        e.preventDefault();

        color_selector_element = $(this);

        $(color_selector_element).ColorPicker({
            /*onSubmit: function(hsb, hex, rgb, el) {
                color_selector_element = el;
                $(el).val("#"+hex);
                $(el).ColorPickerHide();
            },*/
            onShow: function (colpkr) {
                $(colpkr).fadeIn(500);
                return false;
            },
            onHide: function (colpkr) {
                $(colpkr).fadeOut(500);
                return false;
            },
            onChange: function (hsb, hex, rgb) {
                //alert(rgb);
                $(color_selector_element).val("#" + hex);
                //$(color_selector_element).css('backgroundColor', '#' + hex);
            },
            onBeforeShow: function () {
                $(this).ColorPickerSetColor(this.value);
            }
        });
    });

    $(document).on("click", ".color-settings", function (e) {

        e.preventDefault();

        color_selector_element = $(this);

        $(color_selector_element).ColorPicker({
            /*onSubmit: function(hsb, hex, rgb, el) {
                color_selector_element = el;
                $(el).val("#"+hex);
                $(el).ColorPickerHide();
            },*/
            onShow: function (colpkr) {
                $(colpkr).fadeIn(500);
                return false;
            },
            onHide: function (colpkr) {
                $(colpkr).fadeOut(500);
                return false;
            },
            onChange: function (hsb, hex, rgb) {
                //alert(rgb);
                $(color_selector_element).val("#" + hex);
                //$('#colorSelector div').css('backgroundColor', '#' + hex);
            },
            onBeforeShow: function () {
                $(this).ColorPickerSetColor(this.value);
            }
        });
    });


    //main modal button click
    var current_container;

    $(document).on('click', ".add-section, #grid_modal", function (e) {

        var modal = $(this).attr('data-target'); //modal to open
        openedModel = modal;
        var openSection = $(this).attr('data-section-id'); //row,column, element etc..
        current_container = $(this).parent();

        //save the place where section will be placed
        if ($("#main-html-container > #row_modal"))
            insert_into = $(this).parent();
        else
            insert_into = $(this).prev();

        //alert($("#main-html-container").html().trim(' ').length);

        $.ajax({
            type: 'GET',
            url: $("#hid_base_url").val() + '/widget/' + openSection,
            data: $(this).serialize() + '&step_id=' + $("#hid_funnel_step_id").val(),
            success: function (response) {
                ////console.log(response);

                $(modal).find('#' + openSection + '_body').html(response);
            },
            error: function (a, b) {
                document.write(a.responseText);
            }
        });

        e.preventDefault();
        e.stopPropagation();
        return false;
    });


    //Add element
    var parent_element_product_id;
    $(document).on('click', ".add-element", function (e) {

        replace_container = "";

        var modal = $(this).attr('data-target'); //modal to open
        openedModel = modal;
        var openSection = $(this).attr('data-section-id'); //row,column, element etc..
        var tab_sections;

        if (openSection.indexOf('-') >= 0) {
            tab_sections = openSection.split('-');
            openSection = tab_sections[0];
            switch_to_tab = tab_sections[1];
        } else {
            switch_to_tab = 'all';
        }

        //save the place where section will be placed
        if ($(this).hasClass('add-inner-element')) {
            //alert("1");
            //insert_into = $(this).parent();
            //insert_into = $(this).parent(); **
            insert_into = $(this).parent();
            //$(this).remove();
        } else {
            //alert("2");
            insert_into = $(this).prev();
        }

        //row add on parent
        /*if ( $(this).hasClass('add-row') ) {
            insert_into = $("#main-html-container");
        } else if ( $(this).hasClass('add-grid') ) {
            //alert("4");
            insert_into = $(this).parent().parent();
        }*/

        if ($(this).attr('data-section-id') == 'row') {
            //alert('row');

            if (($(this).hasClass('add-row')))
                insert_into = $(this).parent();
            else
                insert_into = $(this).parent();
        }


        //alert($(this).attr('data-section-id'));
        if (($(this).attr('data-section-id') == 'grid') && ($(this).hasClass('add-grid'))) {
            insert_into = $(this).parent();
        }

        if ($(this).hasClass('add-grid-in-row')) {
            insert_into = $(this).parent();
        }

        //remove button only not the small circle buttons
        if (!$(this).hasClass('content-add-element'))
            element_handler = $(this);


        parent_element_product_id = $(this).parents('.product-row').attr('data-product-id');
        //parent_element_product_id = $(this).parent().attr('data-product-id');

        //alert($("#hid_base_url").val() + '/widget/' + openSection);

        /*if ( parent_element_product_id != null ) {
            openSection = 'product';
            modal = $(this).attr('data-target'); //modal to open
        }*/

        $.ajax({
            type: 'GET',
            url: $("#hid_base_url").val() + '/widget/' + openSection,
            data: $(this).serialize() + '&_token=' + $('#csrf_token').val() + '&step_id=' + $("#hid_funnel_step_id").val(),
            success: function (response) {
                ////console.log(response);
                $(modal).find('#' + openSection + '_body').html(response);

                if (switch_to_tab) {
                    //$(".modal-header-tab ul > li").attr('data-filter-type').trigger('click');
                    //$(".modal-header-tab ul > li").trigger('click');

                    $(".modal-header-tab ul > li").each(function (index, element) {

                        if ($(element).attr('data-filter-type') == switch_to_tab) {

                            $(element).trigger('click');
                        }
                    });
                }

            },
            error: function (a, b) {
                document.write(a.responseText);
            }
        });

        e.preventDefault();
        e.stopPropagation();
        return false;
    });


    //REPLACE element
    var parent_element_product_id;
    $(document).on('click', ".replace-element", function (e) {

        //alert(this);

        //replace_container = $(this).parent().append();
        //replace_container = $(this).parent().after();
        //replace_container = $(this).parent().after(); //

        //replace_container = $(this).parent().after();

        //save the place where section will be placed
        if ($(this).hasClass('add-inner-element')) {
            //alert("re-1");
            replace_container = $(this).parent().parent().after();
        } else {
            //alert("re-2");
            replace_container = $(this).parent(); ///////// running
        }

        //$(replace_container)
        //test the sortable newly code added

        var modal = $(this).attr('data-target'); //modal to open
        openedModel = modal;
        var openSection = $(this).attr('data-section-id'); //row,column, element etc..
        var tab_sections;

        if (openSection.indexOf('-') >= 0) {
            tab_sections = openSection.split('-');
            openSection = tab_sections[0];
            switch_to_tab = tab_sections[1];
        } else {
            switch_to_tab = 'all';
        }

        //save the place where section will be placed
        insert_into = $(this).prev();
        parent_element_product_id = $(this).parents('.product-row').attr('data-product-id');


        $.ajax({
            type: 'GET',
            url: $("#hid_base_url").val() + '/widget/' + openSection,
            data: $(this).serialize() + '&step_id=' + $("#hid_funnel_step_id").val(),
            success: function (response) {
                //console.log(response);
                $(modal).find('#' + openSection + '_body').html(response);

                if (switch_to_tab) {

                    $(".modal-header-tab ul > li").each(function (index, element) {

                        if ($(element).attr('data-filter-type') == switch_to_tab) {

                            $(element).trigger('click');
                        }
                    });
                }

            },
            error: function (a, b) {
                document.write(a.responseText);
            }
        });

        e.preventDefault();
        e.stopPropagation();
        return false;
    });


    //add product to editor
    $(document).on('click', '.add-product-to-editor', function (e) {

        e.preventDefault();

        var product_id = $(this).attr('data-product-id');

        $.ajax({
            type: 'GET',
            url: $("#hid_base_url").val() + '/widget/element/product-row',
            data: 'funnel_id=' + $("#hid_funnel_id").val() + '&step_id=' + $("#hid_funnel_step_id").val() + '&product_id=' + product_id,
            success: function (response) {
                //console.log(response);
                $("#manualProductsModal").modal('hide');
                $("#frm_htmleditor_container").append(response);
            },
            error: function (a, b) {
                document.write(a.responseText);
            }
        });
    });


    //Item click on widget modal
    $(document).on('click', ".editor-element-items .item", function (e) {

        e.preventDefault();

        //$(current_container).find('.lb-content-body').css('background', 'transparent');

        //var element = $(this);
        var element_id = $(this).find('a').attr('data-tag');
        var element = $(this);
        var filter_tag = $(this).attr('data-filter');

        //alert($("#main-html-container").html().trim(' ').length);

        //alert(element_id);

        if (filter_tag == 'product') {

            $.ajax({
                type: 'GET',
                url: $("#hid_base_url").val() + '/widget/element/' + element_id,
                data: 'step_id=' + $("#hid_funnel_step_id").val() + '&hid_page_id=' + $("#hid_page_id").val(),
                success: function (response) {
                    //console.log(response);
                    $(openedModel).modal('hide');

                    if (replace_container) {

                        //alert(this);

                        $(replace_container).after(response);
                        make_element_draggable();

                    } else {

                        $(insert_into).html(response);
                    }

                },
                error: function (a, b) {
                    document.write(a.responseText);
                }
            });

        } else {
            $.ajax({
                type: 'GET',
                url: $("#hid_base_url").val() + '/widget/element/' + element_id,
                data: 'step_id=' + $('#hid_funnel_step_id').val(),
                success: function (response) {
                    //console.log(response);
                    $(openedModel).modal('hide');

                    $(element_handler).remove();

                    if (replace_container) {

                        //alert("replacement");

                        $(replace_container).after(response);
                        make_element_draggable();

                        adjust_page_seperator_column_height();

                    } else {

                        //alert("normal");

                        //section and elements adjustment
                        if ($(insert_into).hasClass('element-groups') || $(insert_into).hasClass('section-groups') || $(insert_into).hasClass('row-groups')) {
                            $(insert_into).append(response); ///////was OK
                        } else {
                            $(insert_into).after(response);
                        }
                        make_element_draggable();
                    }
                },
                error: function (a, b) {
                    document.write(a.responseText);
                }
            });
        }

        e.preventDefault();
        e.stopPropagation();
        return false;
    });

    function adjust_page_seperator_column_height() {

        //alert(typeof $('.section-page-seperator'));
        //Page seperator madjust column height
        if (typeof $('.section-page-seperator') != 'undefined') {

            //alert($('.section-page-seperator .sub-parent:first-child').height());
            var col_height = $('.section-page-seperator .sub-parent:first-child').height();
            //$('.section-page-seperator .sub-parent').css('height', eval(col_height + 'px'));
        }
    }


    //product
    $(document).on('click', '.product-element-items .item', function (e) {

        e.preventDefault();

        var element_id = $(this).find('a').attr('data-tag');

        alert(parent_element_product_id); //

        $.ajax({
            type: 'GET',
            url: $("#hid_base_url").val() + '/widget/element/' + element_id,
            data: 'product_id=' + parent_element_product_id,
            success: function (response) {
                //console.log(response);
                $(openedModel).modal('hide');
                $(insert_into).append(response);
            },
            error: function (a, b) {
                document.write(a.responseText);
            }
        });
    });


    $(document).on('click', '.show-settings-product-list', function (e) {

        e.preventDefault();

        insert_into = $(this).parent().parent().parent();

        $.ajax({
            type: 'GET',
            url: $("#hid_base_url").val() + '/product/editor-product-list/',
            data: '_token=' + $("#csrf_token").val(),
            success: function (response) {
                //console.log(response);
                $("#manualProductsModal").find('.modal-body').html(response);
                //$(this).parent().parent().parent().html(response);
            },
            error: function (a, b) {
                document.write(a.responseText);
            }
        });
    });


    //add product from modal to editor
    $(document).on('click', '.modal-product-add-editor', function (e) {

        e.preventDefault();

        var product_id = $(this).attr('data-product-id');

        $.ajax({
            type: 'GET',
            url: $("#hid_base_url").val() + '/editor/product/' + product_id + '/section/',
            data: '_token=' + $("#csrf_token").val(),
            success: function (response) {
                //console.log(response);
                //$("#manualProductsModal").modal('hide');
                //$("#manual_product_settings_body").attr('data-product-id', product_id);


                $(insert_into).html(response);
            },
            error: function (a, b) {
                document.write(a.responseText);
            }
        });
    });


    //show control on hover of every elements
    var tmp_element_hover;
    var prev_element_enter;
    $(document).on('mouseover', '.element', function (e) {

        if (prev_element_enter) {
            //$(prev_element_enter).find('.add-inner-element').remove();
        }

        if (!$(this).hasClass('active')) {
            $(this).addClass('active');
            //alert("1st");
            //$(this).find('.content-add-element').show();
            //$(this).append("<button class='add-inner-element btn btn-primary'>ADD ELEMENT</button>");
        } else {
            //$(this).closest("button.add-inner-element").remove();
        }


        ////console.log($(this).offset().top  + ", " + ($(".top_nav").offset().top + $(".top_nav").height() + 3));

        if ((typeof $(this).offset() != 'undefined') && (typeof $(".top_nav").offset() != 'undefined')) {
            if ($(this).offset().top <= ($(".top_nav").offset().top + $(".top_nav").height() + 3)) {

                //$(this).find('.ld_controls').css({top: 'initial', bottom: '-23px'});
                $(this).find('.ld_controls').css({
                    top: '0px',
                    bottom: 'initial'
                });
                $(this).find('.ld_inline_controls').css({
                    top: '0px',
                    bottom: 'initial'
                });
            } else {
                $(this).find('.ld_controls').css({
                    top: '-24px',
                    bottom: 'initial'
                });
                $(this).find('.ld_inline_controls').css({
                    top: '-24px',
                    bottom: 'initial'
                });
            }
        }

        prev_element_enter = $(this);

        e.preventDefault();
        e.stopPropagation();
        return false;
    });

    $(document).on('mouseout', '.element', function (e) {

        //if ( $(this).find('.ld_controls').hasClass('ld_option_menu') )
        //   $(this).find('.ld_controls').remove();

        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            //$(this).find('.content-add-element').hide();
            //$(this).find("button.add-inner-element").remove();
        }

        $(this).find('.addElementFlyoutDOM').hide();

        e.preventDefault();
        e.stopPropagation();
        return false;
    });


    //Inline element hover
    $(document).on('mouseover', '.ld-element, .element-row, .element-section', function (e) {

        //alert(this);

        if (!$(this).hasClass('active')) {
            $(this).addClass('active');
            //alert("2nd");
        }


        //alert($(".top_nav").offset().top + $(".top_nav").height());

        //alert($(this).offset().top);

        //alert($(this).offset().top  + ", " + $(".top_nav").offset().top + $(".top_nav").height());

        //alert(eval(e.pageY - $(".top_nav").height()) + ', ' + eval($(".top_nav").offset().top + $(".top_nav").height()));
        //$(this).find('.ld_inline_controls').css({top: '50px !important', bottom: 'initial'});

        //if ( $(this).offset().top <= $(".top_nav").offset().top + $(".top_nav").height() ) {

        if (typeof $(".top_nav").offset() != 'undefined') {
            if (eval(e.pageY - $(".top_nav").height()) > $(".top_nav").offset().top + $(".top_nav").height()) {

                //$(this).find('.ld_inline_controls').css({top: 'initial', bottom: '-23px'});
                if (typeof $(this).find('.ld_inline_controls') != 'undefined')
                    $(this).find('.ld_inline_controls').css({
                        top: '0px',
                        bottom: 'initial'
                    });
                else {
                    if (typeof $(this).find('.ld_controls') != 'undefined') {
                        $(this).find('.ld_controls').css({
                            top: '0px',
                            bottom: 'initial'
                        });
                    }
                }
            } else {
                //$(this).find('.ld_inline_controls').css({top: '24px', bottom: 'initial'});
                if (typeof $(this).find('.ld_inline_controls') != 'undefined')
                    $(this).find('.ld_inline_controls').css({
                        top: '24px',
                        bottom: 'initial'
                    });
                else {
                    if (typeof $(this).find('.ld_controls') != 'undefined') {
                        $(this).find('.ld_controls').css({
                            top: '24px',
                            bottom: 'initial'
                        });
                    }
                }
            }
        }


        //$(this).append('<button class="addElementFlyoutDOM"><i class="fa fa-plus"></i></button>');
        //$(this).find('.addElementFlyoutDOM').show();


        e.preventDefault();
        e.stopPropagation();
        return false;
    });

    $(document).on('mouseout', '.ld-element, .element-row, .element-section', function (e) {

        if ($(this).hasClass('active'))
            $(this).removeClass('active');


        //$(this).find('.addElementFlyoutDOM').hide();

        e.preventDefault();
        e.stopPropagation();
        return false;
    });

    /*$('.ld-editable .wrapper').attr('contenteditable', true);



    $('.ld-editable .wrapper, .ld-element .ld-editable').mousemove(function (e) {
        $(this).attr("data-toggle", "tooltip");
        //$('.ld-editable .wrapper').attr("title", "");
        $(this).attr("data-placement", "top");
        //$('[data-toggle="tooltip"]').tooltip();
        $(this).attr("title", "Double click to edit the text");
    });

    $('.ld-editable .wrapper, .ld-element .ld_editable').mouseout(function (e1) {

        //$(this).attr('contenteditable', false);
        $('.section-groups, .row-groups, .element-groups').sortable("enable");
    });

    $('.ld-editable .wrapper, .ld-element .ld-editable').click(function (e) {

        $(this).attr('contenteditable', true);
        $('.section-groups, .row-groups, .element-groups').sortable("disable");
        //$(this).trigger("click");

    }).focusout(function (e1) {

        $('.section-groups, .row-groups, .element-groups').sortable("enable");
        $(this).find('.ld-editable').attr('contenteditable', false);
    });*/


    /* --------------------------------------------------------------- SELECT TEMPLATE ---------------------------------------------- */
    /*$(".select-funnel-template").click(function(e) {

        e.preventDefault();

        alert(this);
    });*/


    /* ------------------------------------------- SECTION CONTROL FUNCTIONS ------------------------------------------------- */

    //CLONE
    $(document).on("click", ".ld_controls_clone", function (e) {

        e.preventDefault();

        var current_element = $(this).parent().parent().parent();
        var current_element_id = $(current_element).attr('id');
        //alert($(current_element).html());

        //var new_element = $(current_element).insertAfter('#' + current_element_id);
        var new_element = $($(current_element).clone()).insertAfter('#' + current_element_id);

        var new_id = $(current_element).attr('data-de-type');

        //alert(new_id);

        $(new_element).attr('id', new_id + new Date().getTime());
        $(new_element).removeClass('active');

        //adjust page seperation column height
        adjust_page_seperator_column_height();

        e.preventDefault();
        e.stopPropagation();
        return false;
    });

    //REMOVE
    $(document).on("click", ".ld_controls_close", function (e) {

        e.preventDefault();

        var tmp;
        var sub_parent = $(this).parents('.sub-parent');

        if (confirm("Are you sure to remove it?")) {

            var current_element = $(this).parent().parent().parent();
            var parent_group = $(current_element).parent();

            $(current_element).remove();
            //alert($(parent_group).html());
            //alert($(parent_group).html().trim().length);

            //if container column or section has no element left or empty, add a button to add other elements
            if ($(parent_group).html().trim().length == 0) {

                //alert($(parent_group).hasClass('element-groups'));

                //add button based on the parent group type
                if ($(parent_group).hasClass('element-groups')) {
                    $(parent_group).html("<button class='add-inner-element btn btn-primary add-element' data-section-id='element' id='element_modal' alt='Add elements' data-toggle='modal' data-target='#elementModal'>ADD ELEMENT </button>");
                } else if ($(parent_group).hasClass('row-groups')) {
                    $(parent_group).html("<button class='add-inner-element btn btn-primary add-element add-grid-in-row' data-section-id='grid' id='grid_modal' alt='Add elements' data-toggle='modal' data-target='#gridModal'>ADD ROW</button>");
                } else if ($(parent_group).hasClass('section-groups')) {
                    $(parent_group).html("<button style='margin-top: 30px; width: 70%' class='add-inner-element btn btn-primary add-element' data-section-id='row' id='row_modal' alt='Add elements' data-toggle='modal' data-target='#rowModal'>ADD SECTION </button>");
                }
            }
        }

        //adjust page seperation column height
        adjust_page_seperator_column_height();

        e.preventDefault();
        e.stopPropagation();
        return false;
    });


    // ----------------------------------------------------- SETTINGS MODAL --------------------------------------------------- */
    var tmp_setting_element;
    var tmp_setting_modal;

    $(document).on('click', '.open-setings-modal', function (e) {

        var data_type = $(this).parent().parent().parent().attr('data-de-type');
        var modal = $(this).attr('data-target');

        //console.log(data_type);

        tmp_setting_element = $(this).parent().parent().parent();
        tmp_setting_modal = modal;

        //change the modal header by element type
        $(modal).find('.modal-header > .modal-title').text(data_type + " settings");

        $(modal).find('#settings_body').html("");


        $.ajax({
            type: 'POST',
            url: $("#hid_base_url").val() + '/widget/settings/' + data_type,
            data: 'settings=' + jsonSettings + '&_token=' + $("#csrf_token").val() + '&page_id=' + $("#hid_page_id").val(),
            success: function (response) {
                //console.log(response);
                $(modal).find('#settings_body').html(response);

                //load icons
                if (data_type == 'icon-list') {
                    $.get('https://rawgit.com/FortAwesome/Font-Awesome/master/src/icons.yml', function (data) {
                        var parsedYaml = jsyaml.load(data);
                        var body = $('#settings_body').find('.icon-package-list > ul');

                        //alert(settings.icon_class);

                        $.each(parsedYaml.icons, function (index, icon) {
                            if ('fa fa-' + settings.icon_class == icon.id)
                                body.append('<li class="active"><i data-code="' + icon.unicode + '" class="fa fa-' + icon.id + '"></i></li>');
                            else
                                body.append('<li><i data-code="' + icon.unicode + '" class="fa fa-' + icon.id + '"></i></li>');

                            //body.append('<li><i class="fa fa-' + icon.id + '"></i></li>');
                        })
                    });
                }
            },
            error: function (a, b) {
                document.write(a.responseText);
            }
        });

        e.preventDefault();
        e.stopPropagation();
        return false;
    });


    //On icon click
    $(document).on('click', '.icon-package-list .icons > li', function (e) {

        e.preventDefault();

        $(this).parent().parent().find("#hid_icon_class").val($(this).find('i').attr('class'));
        $(this).parent().parent().find("#hid_icon_code").val($(this).find('i').attr('data-code'));
    });


    //for button
    var next_url = "";
    /*$(document).on('click', '#button_setting_save', function(e) {

        //e.preventDefault();

        //format form data to JSON format
        var data = "" + JSON.stringify($('#frm_button_settings').serializeObject());
        var json = JSON.parse(data);

        //button type
        $(tmp_setting_element).find('a').attr('data-button-type', json.button_type);
        if ( json.button_type == 'full' ) {
            $(tmp_setting_element).find('a').removeClass('btn-lg');
            $(tmp_setting_element).find('a').addClass('btn-block');
        } else if ( json.button_type == 'large' ) {
            $(tmp_setting_element).find('a').removeClass('btn-block');
            $(tmp_setting_element).find('a').addClass('btn-lg');
        } else if ( json.button_type == 'full_large' ) {
            $(tmp_setting_element).find('a').addClass('btn-block');
            $(tmp_setting_element).find('a').addClass('btn-lg')
        } else {
            $(tmp_setting_element).find('a').removeClass('btn-block');
            $(tmp_setting_element).find('a').removeClass('btn-lg');
        }

        //alert($(tmp_setting_element).find('a').attr('href'));

        $(tmp_setting_element).find('a').attr('href', json.step_next_url);

        //alert(json.button_section_id.length);



        if ( json.product != null ) {
            if ( !$(tmp_setting_element).find('a').hasClass('btn-link-submit') ) {
                $(tmp_setting_element).find('a').addClass('btn-link-submit');
            }

            $(tmp_setting_element).find('a').parent().append("<input type='hidden' name='product' value='" + json.product + "' />");
        }

        //video URL
        //alert($('#frm_button_settings').find("#video_url_textbox").is(":visible"));
        if ( $('#frm_button_settings').find("#video_url_textbox").is(":visible") ) {
            $(tmp_setting_element).find('a').attr('href', '#');
            $(tmp_setting_element).find('a').attr("data-video-url", json.video_url);
            $(tmp_setting_element).find('a').attr('data-toggle', 'modal');
            $(tmp_setting_element).find('a').attr('data-target', '#editorVideoModal');

            //if ( $(tmp_setting_element).find('a').hasClass('open-setings-modal') ) {
                $(tmp_setting_element).find('a').removeClass('open-setings-modal');
                $(tmp_setting_element).find('a').addClass('open-video-modal');
            //}

        }

        if ( json.button_section_id.length > 0 ) {
            $(tmp_setting_element).find('a').attr('href', '#' + json.button_section_id);
        }

        //button text
        $(tmp_setting_element).find('span').text(json.button_text);

        //text color
        $(tmp_setting_element).find('span').css('color', json.text_color);

        //background color
        $(tmp_setting_element).find('a').css('background-color', json.bg_color);

        $(tmp_setting_modal).modal('hide');

        e.preventDefault();
        e.stopPropagation();
        return false;
    });*/


    //For submit button
    $(document).on('click', '#button_submit_setting_save', function (e) {

        //e.preventDefault();

        //alert(this);

        //format form data to JSON format
        var data = "" + JSON.stringify($('#frm_submit_button_settings').serializeObject());
        var json = JSON.parse(data);

        //button type
        $(tmp_setting_element).find('button').attr('data-button-type', json.button_type);
        if (json.button_type == 'full') {
            $(tmp_setting_element).find('button').removeClass('btn-lg');
            $(tmp_setting_element).find('button').addClass('btn-block');
        } else if (json.button_type == 'large') {
            $(tmp_setting_element).find('button').removeClass('btn-block');
            $(tmp_setting_element).find('button').addClass('btn-lg');
        } else if (json.button_type == 'full_large') {
            $(tmp_setting_element).find('button').addClass('btn-block');
            $(tmp_setting_element).find('button').addClass('btn-lg')
        } else {
            $(tmp_setting_element).find('button').removeClass('btn-block');
            $(tmp_setting_element).find('button').removeClass('btn-lg');
        }

        //video URL
        //$(tmp_setting_element).find('span').text(json.button_text);

        //button text
        $(tmp_setting_element).find('span').text(json.button_text);

        //text color
        $(tmp_setting_element).find('span').css('color', json.text_color);

        //background color
        $(tmp_setting_element).find('a').css('background-color', json.bg_color);

        $(tmp_setting_modal).modal('hide');

        e.preventDefault();
        e.stopPropagation();
        return false;
    });


    //select action for button
    $(document).on('change', '#frm_button_settings #button_action', function (e) {

        if ($(this).val().length > 0) {

            $("#button_settings_goto_link").hide();

            if ($(this).val() == 'next_step') {
                $("#button_open_section_id").hide();
                $("#frm_button_settings").find("#video_url_textbox").show();
                //hide video modal if opened
                $("#frm_button_settings").find("#video_url_textbox").hide();

                $.ajax({
                    type: 'post',
                    url: $("#hid_base_url").val() + '/settings/buttonurl/' + $(this).val(),
                    data: 'page_id=' + $("#hid_page_id").val() + 'step_id=' + $("#hid_page_id").val() + '&_token=' + $("#csrf_token").val(),
                    success: function (response) {
                        //console.log(response);
                        var json = JSON.parse(response);
                        //next_url = response.url;

                        $("#frm_button_settings").find(":input[name='step_skip_url']").val(json.url);
                    },
                    error: function (a, b) {
                        document.write(a.responseText);
                    }
                });
            } else if ($(this).val() == 'skip_step') {
                $("#button_open_section_id").hide();
                $("#button_settings_goto_link").hide();
                $("#integration_data_section").hide();
                $("#frm_button_settings").find("#video_url_textbox").hide();
                //hide video modal if opened
                $("#frm_button_settings").find("#video_url_textbox").hide();

                $.ajax({
                    type: 'post',
                    url: $("#hid_base_url").val() + '/settings/skip-steps/' + $(this).val(),
                    data: 'page_id=' + $("#hid_page_id").val() + '&_token=' + $("#csrf_token").val(),
                    success: function (response) {
                        //console.log(response);
                        var json = JSON.parse(response);
                        //next_url = response.url;

                        $("#frm_button_settings").find(":input[name='step_next_url']").val(json.url);
                    },
                    error: function (a, b) {
                        document.write(a.responseText);
                    }
                });

            } else if ($(this).val() == 'open_video') {
                $("#frm_button_settings").find("#video_url_textbox").show();
                $("#button_open_section_id").hide();
            } else if ($(this).val() == 'add_to_cart') {
                //$("#frm_button_settings").find(":input[name='step_next_url']").val(json.url);
            } else if ($(this).val() == 'goto_section') {
                $("#button_open_section_id").show();
                $("#button_settings_goto_link").hide();
                $("#frm_button_settings").find("#video_url_textbox").hide();
                $("#integration_data_section").hide();
            } else if ($(this).val() == 'goto_link') {
                $("#button_settings_goto_link").show();
                $("#frm_button_settings").find("#video_url_textbox").hide();
                $("#integration_data_section").hide();
                //$("#button_setting_goto_link_url").val($(option_open_for).find('.wrapper > a').attr('href'));
                //$("#button_setting_goto_link_behaviour").val($(option_open_for).find('.wrapper > a').attr('data-link-open-behaviour'));
            } else if ($(this).val() == 'integration_data') {
                $("#integration_data_section").show();
                $("#button_settings_goto_link").hide();
                $("#frm_button_settings").find("#video_url_textbox").hide();
                $("#button_settings_goto_link").hide();
            } else {
                var product_val = $(this).val().split('_');
                $("#integration_data_section").hide();
                $("#button_open_section_id").hide();
                $("#frm_button_settings").find("#video_url_textbox").hide();
                $("#button_settings_goto_link").hide();

                if (product_val[0] == 'product') {
                    $(this).parent().append("<input type='hidden' name='product' value='" + product_val[1] + "' />")
                }
            }
        }
    });


    //for text block
    $(document).on('click', '#text_block_setting_save', function (e) {

        //e.preventDefault();

        //format form data to JSON format
        var data = "" + JSON.stringify($('#frm_text_block_settings').serializeObject());
        var json = JSON.parse(data);

        //headline text
        $(tmp_setting_element).find('b').text(json.headline_text);

        //paragraph text
        $(tmp_setting_element).find('p').text(json.headline_text);

        //heading color
        $(tmp_setting_element).find('b').css('color', json.text_color);

        //paragraph color
        $(tmp_setting_element).find('p').css('color', json.text_color);

        //heading background color
        $(tmp_setting_element).find('b').css('background-color', json.bg_color);

        //paragraph background color
        $(tmp_setting_element).find('p').css('background-color', json.bg_color);

        $(tmp_setting_modal).modal('hide');

        e.preventDefault();
        e.stopPropagation();
        return false;
    });


    //for headline
    /*$(document).on('click', '#headline_setting_save', function(e) {

        //e.preventDefault();

        //format form data to JSON format
        var data = "" + JSON.stringify($('#frm_headline_settings').serializeObject());
        var json = JSON.parse(data);

        //button text
        $(tmp_setting_element).find('b').text(json.headline_text);

        //text color
        alert(json.text_color);
        $(tmp_setting_element).find('.wrapper').css('color', json.text_color);

        //background color
        $(tmp_setting_element).css('background-color', json.bg_color);

        $(tmp_setting_modal).modal('hide');

        e.preventDefault();
        e.stopPropagation();
        return false;
    });*/


    //for sub headline
    /*$(document).on('click', '#sub_headline_setting_save', function(e) {

        //e.preventDefault();

        //format form data to JSON format
        var data = "" + JSON.stringify($('#frm_headline_settings').serializeObject());
        var json = JSON.parse(data);

        //button text
        $(tmp_setting_element).find('b').text(json.headline_text);

        //text color
        $(tmp_setting_element).find('b').css('color', json.text_color);

        //background color
        $(tmp_setting_element).css('background-color', json.bg_color);

        $(tmp_setting_modal).modal('hide');

        e.preventDefault();
        e.stopPropagation();
        return false;
    });*/


    //for paragraph
    /*$(document).on('click', '#paragraph_setting_save', function(e) {

        //e.preventDefault();

        //format form data to JSON format
        var data = "" + JSON.stringify($('#frm_paragraph_settings').serializeObject());
        var json = JSON.parse(data);

        //button text
        $(tmp_setting_element).find('p').text(json.headline_text);

        //text color
        $(tmp_setting_element).find('p').css('color', json.text_color);

        //background color
        $(tmp_setting_element).css('background-color', json.bg_color);

        $(tmp_setting_modal).modal('hide');

        e.preventDefault();
        e.stopPropagation();
        return false;
    });*/


    //for single image
    /*$(document).on('click', '#single_image_save', function(e) {

        //e.preventDefault();

        //format form data to JSON format
        var data = "" + JSON.stringify($('#frm_single_image_settings').serializeObject());
        var json = JSON.parse(data);

        //path
        $(tmp_setting_element).find('img').attr('src', json.path);

        //ALT text
        $(tmp_setting_element).find('img').attr('alt', json.alt_text);

        //width
        if ( (json.width == 0)  || ($(tmp_setting_element).find('img').attr('style') == null) )
            $(tmp_setting_element).find('img').css('width', '100%');
        else
            $(tmp_setting_element).find('img').css('width', json.width);

        //height
        if ( json.width == 0 )
            $(tmp_setting_element).find('img').css('height', 'auto');
        else
            $(tmp_setting_element).find('img').css('height', json.height);

        $(tmp_setting_modal).modal('hide');

        e.preventDefault();
        e.stopPropagation();
        return false;
    });*/


    //for row
    /*$(document).on('click', '#row_setting_save', function(e) {

        //e.preventDefault();

        //format form data to JSON format
        var data = "" + JSON.stringify($('#frm_row_settings').serializeObject());
        var json = JSON.parse(data);

        //text color
        $(tmp_setting_element).css('color', json.text_color);

        //background color
        $(tmp_setting_element).css('background-color', json.bg_color);

        $(tmp_setting_modal).modal('hide');

        e.preventDefault();
        e.stopPropagation();
        return false;
    });*/


    //for grid
    $(document).on('click', '#grid_setting_save', function (e) {

        //e.preventDefault();

        //format form data to JSON format
        var data = "" + JSON.stringify($('#frm_grid_settings').serializeObject());
        var json = JSON.parse(data);

        //text color
        //$(tmp_setting_element).find('.lb-content-body').css('color', json.text_color);
        $(tmp_setting_element).css('color', json.text_color);

        //background color
        //$(tmp_setting_element).find('.lb-content-body').css('background-color', json.bg_color);
        $(tmp_setting_element).css('background-color', json.bg_color);

        $(tmp_setting_modal).modal('hide');

        e.preventDefault();
        e.stopPropagation();
        return false;
    });


    //for video
    $(document).on('click', '#embed_video_setting_save', function (e) {

        //e.preventDefault();

        //format form data to JSON format
        var data = "" + JSON.stringify($('#frm_embed_video_settings').serializeObject());
        var json = JSON.parse(data);

        //video html
        $(tmp_setting_element).find('.video-holder').html(json.video_embed);

        $(tmp_setting_modal).modal('hide');

        e.preventDefault();
        e.stopPropagation();
        return false;
    });


    //for select box
    $(document).on('click', '#select_box_setting_save', function (e) {

        //e.preventDefault();

        //format form data to JSON format
        var data = "" + JSON.stringify($('#frm_select_box_settings').serializeObject());
        var json = JSON.parse(data);

        //select box options
        $(tmp_setting_element).find('select').attr('data-option-type', json.select_options);

        $(tmp_setting_modal).modal('hide');

        e.preventDefault();
        e.stopPropagation();
        return false;
    });


    //for date countdown
    /*$(document).on('click', '#date_countdown_setting_save', function(e) {

        //e.preventDefault();

        //format form data to JSON format
        var data = "" + JSON.stringify($('#frm_date_countdown_settings').serializeObject());
        var json = JSON.parse(data);

        //text color
        $(tmp_setting_element).find('.date-countdown > ul').attr('data-end-date', json.end_date);

        //background color
        $(tmp_setting_element).find('.date-countdown > ul').attr('data-end-time', json.end_time);

        $(tmp_setting_modal).modal('hide');

        e.preventDefault();
        e.stopPropagation();
        return false;
    });*/


    //for shipping form
    $(document).on('click', '#shipping_form_setting_save', function (e) {

        //e.preventDefault();

        //format form data to JSON format
        var data = "" + JSON.stringify($('#frm_shipping_form_settings').serializeObject());
        var json = JSON.parse(data);

        //caption text
        $(tmp_setting_element).find('.step-caption span:last-child').html(json.caption_text);

        //alert(json.enable_step_number);

        if (json.enable_step_number != null) {
            $(tmp_setting_element).find('.step-caption span > strong').attr('data-step-enabled', json.enable_step_number);
            $(tmp_setting_element).find('.step-caption span > strong').html(json.step_number);
        } else {
            $(tmp_setting_element).find('.step-caption span > strong').html("");
        }

        $(tmp_setting_modal).modal('hide');

        e.preventDefault();
        e.stopPropagation();
        return false;
    });


    //for card details form
    $(document).on('click', '#card_details_form_setting_save', function (e) {

        //e.preventDefault();

        //format form data to JSON format
        var data = "" + JSON.stringify($('#frm_card_details_form_settings').serializeObject());
        var json = JSON.parse(data);

        //caption text
        $(tmp_setting_element).find('.step-caption span:last-child').html(json.caption_text);

        //alert(json.enable_step_number);

        if (json.enable_step_number != null) {
            $(tmp_setting_element).find('.step-caption span > strong').attr('data-step-enabled', json.enable_step_number);
            $(tmp_setting_element).find('.step-caption span > strong').html(json.step_number);
        } else {
            $(tmp_setting_element).find('.step-caption span > strong').html("");
        }

        $(tmp_setting_modal).modal('hide');

        e.preventDefault();
        e.stopPropagation();
        return false;
    });


    //for dynamic product selection
    $(document).on('click', '#product_selection_setting_save', function (e) {

        //e.preventDefault();

        //format form data to JSON format
        var data = "" + JSON.stringify($('#frm_product_selection_settings').serializeObject());
        var json = JSON.parse(data);

        //caption text
        $(tmp_setting_element).find('thead > tr > th:first-child').html(json.left_caption);
        $(tmp_setting_element).find('thead > tr > th:last-child').html(json.right_caption);

        $(tmp_setting_modal).modal('hide');

        e.preventDefault();
        e.stopPropagation();
        return false;
    });


    //for dynamic product purchased
    $(document).on('click', '#product_purchased_setting_save', function (e) {

        //e.preventDefault();

        //format form data to JSON format
        var data = "" + JSON.stringify($('#frm_product_purchased_settings').serializeObject());
        var json = JSON.parse(data);

        //caption text
        $(tmp_setting_element).find('thead > tr > th:first-child').html(json.left_caption);
        $(tmp_setting_element).find('thead > tr > th:last-child').html(json.right_caption);

        $(tmp_setting_modal).modal('hide');

        e.preventDefault();
        e.stopPropagation();
        return false;
    });


    /* -------------------------------------------------------- EDITOR SAVE -------------------------------------------------------- */
    var button_editor_save;
    $("#button_editor_save").click(function (e) {

        if ($("#data_page_popup").is(':visible')) {
            $("#data_page_popup").hide();
        }

        //remove grammerly plugin text from html
        $("#htmleditor").find('grammarly-btn').remove();

        var content = $("#htmleditor").html();
        page_content = content;

        //alert(this);

        ////console.log(content);

        //write all the content into textarea for submit
        $("#frm_htmleditor_save").find(":input[name='htmlbody']").html(content);

        button_editor_save = $(this);
        $(this).html('<i class="fa fa-circle-o-notch fa-spin"></i>');
        $(this).attr('disabled', 'disabled');

        $("#frm_htmleditor_save").submit();
    });


    //save the design html editor contents
    $("#frm_htmleditor_save").submit(function (e) {

        e.preventDefault();

        //format form data to JSON format
        var dataJson = "" + JSON.stringify($('#frm_htmleditor_save').serializeObject());
        var form = $(this);

        //escape '&' character
        dataJson = encodeURIComponent(dataJson);

        //alert($(this).attr('method'));

        $.ajax({
            type: "PUT",
            url: $(form).attr('action'),
            data: 'page=' + dataJson + '&_token=' + $("#csrf_token").val(),
            success: function (response) {
                //console.log(response);

                var json = JSON.parse(response);
                $(button_editor_save).attr('disabled', false);

                if (json.success) {
                    $(button_editor_save).text(' Save ');

                    //check if the form is update/replacer form
                    if (typeof $("#hid_update_page_url") != 'undefined') {

                        $.ajax({
                            type: 'GET',
                            url: $("#hid_update_page_url").val(),
                            data: "_token=" + $("#csrf_token").val() + "&action=stop_update",
                            success: function (response) {
                                //console.log(response);
                            },
                            error: function (a, b) {
                                document.write(a.responseText);
                            }
                        });
                    }
                } else {
                    $(button_editor_save).text(' Not Saved! ');
                }
            },
            error: function (a, b) {
                document.write(a.responseText);
            }
        });
    });


    /* ------------------------------------------------------------ INLINE EDITOR ------------------------------------------------------------ */

    //Init editor
    $(document).on('click', '.ld_controls_editor', function (e) {

        e.preventDefault();

        $(this).parent().parent().parent().find('.ld_editable').froalaEditor({
            toolbarButtons: ['bold', 'italic', 'underline', 'fontFamily', 'fontSize', 'color', 'align', 'formatOL', 'formatUL', 'indent', 'outdent', 'html'],
        });

        if ($(this).find('i').hasClass('fa-floppy-o')) {
            $(this).html('<i class="fa fa-code" aria-hidden="true"></i>');

            if ($(this).parent().parent().parent().find('.ld_editable').data('froala.editor')) {
                $(this).parent().parent().parent().find('.ld_editable').froalaEditor('destroy');
            }
        } else {
            $(this).html('<i class="fa fa-floppy-o" aria-hidden="true"></i>');

            /*if (!$('div.ld_editable').data('froala.editor')) {
              $('div.ld_editable').froalaEditor();
          }*/

            if (!$(this).parent().parent().parent().find('.ld_editable').data('froala.editor')) {
                $(this).parent().parent().parent().find('.ld_editable').froalaEditor();
            }
        }
    });


    //destroy editor
    /*$(document).click(function(event) {
        if(!$(event.target).closest('.ld_editable').length) {
            if ($('div.ld_editable').data('froala.editor')) {
                  $('div.ld_editable').froalaEditor('destroy');
            }
        }
    })*/


    $(document).on('click', '.color-settings', function (e) {

        e.preventDefault();

        // /alert(this);

        //$('.color-settings').ColorPicker();

        //$('textarea').trumbowyg();
    });


    //=========================================== ******************************************* ================================================


    /* =====================================/* ========================================================= SETTINGS MODAL OPEN ================================================ */
    //


    //HTMl BLOCK SETTING
    $(document).on('click', '.open-html-block-settings-modal', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        //code
        $('#html_block_custom_html').val($(option_open_for).find('.wrapper > div').html());

        //BG color
        $("#html_block_bg_color").val(rgb2hex($(option_open_for).find('.wrapper').prop('style')['background-color']));

        //padding
        $("input[name='html_block_padding_top']").val($(option_open_for).find('.wrapper > div').prop('style')['padding-top'].split('px')[0]);
        $("input[name='html_block_padding_top']").prev().slider({
            value: $("input[name='html_block_padding_top']").val()
        });
        $("input[name='html_block_padding_right']").val($(option_open_for).find('.wrapper > div').prop('style')['padding-right'].split('px')[0]);
        $("input[name='html_block_padding_right']").prev().slider({
            value: $("input[name='html_block_padding_right']").val()
        });
        $("input[name='html_block_padding_bottom']").val($(option_open_for).find('.wrapper > div').prop('style')['padding-bottom'].split('px')[0]);
        $("input[name='html_block_padding_bottom']").prev().slider({
            value: $("input[name='html_block_padding_bottom']").val()
        });
        $("input[name='html_block_padding_left']").val($(option_open_for).find('.wrapper > div').prop('style')['padding-left'].split('px')[0]);
        $("input[name='html_block_padding_left']").prev().slider({
            value: $("input[name='html_block_padding_left']").val()
        });

        //margin
        $("input[name='html_block_margin_top']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='html_block_margin_top']").prev().slider({
            value: $("input[name='html_block_margin_top']").val()
        });
        $("input[name='html_block_margin_right']").val($(option_open_for).find('.wrapper').prop('style')['margin-right'].split('px')[0]);
        $("input[name='html_block_margin_right']").prev().slider({
            value: $("input[name='html_block_margin_right']").val()
        });
        $("input[name='html_block_margin_bottom']").val($(option_open_for).find('.wrapper').prop('style')['margin-bottom'].split('px')[0]);
        $("input[name='html_block_margin_bottom']").prev().slider({
            value: $("input[name='html_block_margin_bottom']").val()
        });
        $("input[name='html_block_margin_left']").val($(option_open_for).find('.wrapper').prop('style')['margin-left'].split('px')[0]);
        $("input[name='html_block_margin_left']").prev().slider({
            value: $("input[name='html_block_margin_left']").val()
        });


        //alert($(option_open_for).find('.wrapper > p').prop('style')['color']);
        $("#customer_info_caption_text").val($(option_open_for).find('.wrapper .section-title').text());
    });


    //PAYMENT METHOD SETTING
    $(document).on('click', '.open-social-share-buttons-modal', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        $("#social_share_button_url").val($(option_open_for).find('.social-button-data').attr('data-share-url'));
        $("#social_share_title").val($(option_open_for).find('.social-button-data').attr('data-share-title'));

        try {
            $("input[name='social_share_buttons_width']").val($(option_open_for).find('.social-share-buttons').attr('data-button-width').split('%')[0]);
            $("input[name='social_share_buttons_width']").prev().slider({
                value: $("input[name='social_share_buttons_width']").val()
            });

            if ($(option_open_for).find('ul.social-share-buttons > li').prop('style')['line-height'].split('px')[0] > 0) {
                $("input[name='social_share_buttons_line_height']").val($(option_open_for).find('ul.social-share-buttons > li').prop('style')['line-height'].split('px')[0]);
                $("input[name='social_share_buttons_line_height']").prev().slider({
                    value: $("input[name='social_share_buttons_line_height']").val()
                });
            } else {
                $("input[name='social_share_buttons_line_height']").val("51"); //51px
            }
        } catch (ex) {
        }

        //get buttons settings
        if ($(option_open_for).find('ul.social-share-buttons').attr('data-has-buttons')) {

            $("#all_social_buttons").html("");

            $(option_open_for).find('ul.social-share-buttons > li').each(function (index, element) {

                //var title_text = $(element).attr('data-title-text');
                var button_type = $(element).attr('data-button-type');
                var button_image = $(element).attr('data-button-image');
                var button_type_select_html = "";

                if (button_type == 'facebook') {
                    button_type_select_html = '<select class="form-control" id="social_button_type" name="social_button_type"><option>CHOOSE</option><option value="facebook" selected>Facebook</option><option value="google">Google</option><option value="twitter">Twitter</option></select>';
                } else if (button_type == 'google') {
                    button_type_select_html = '<select class="form-control" id="social_button_type" name="social_button_type"><option>CHOOSE</option><option value="facebook">Facebook</option><option value="google" selected>Google</option><option value="twitter">Twitter</option></select>';
                } else if (button_type == 'twitter') {
                    button_type_select_html = '<select class="form-control" id="social_button_type" name="social_button_type"><option>CHOOSE</option><option value="facebook">Facebook</option><option value="google">Google</option><option value="twitter" selected>Twitter</option></select>';
                }


                var html = '<div class="social-button-items">' +
                    '<div class="form-group">' +
                    '<label class="control-label col-sm-3" for="social_buttons_title_text">Social Button Type:</label>' +
                    '<div class="col-sm-9">' + button_type_select_html +
                    '</div>' +
                    '</div>' +
                    /*'<div class="form-group">' +
                    '<label class="control-label col-sm-3" for="social_buttons_title_text">Title Text:</label>' +
                    '<div class="col-sm-9">' +
                    '<input class="form-control" id="social_buttons_title_text" name="social_buttons_title_text" placeholder="Enter Title text" value="' + title_text + '" type="text">' +
                    '</div>' +
                    '</div>' +*/
                    '<div class="form-group">' +
                    '<label class="control-label col-sm-3" for="social_button_button_image">Image:</label>' +
                    '<div class="col-sm-9">' +
                    '<div class="input-group gallery-open" data-toggle="modal" data-target="#imageGalleryModal">' +
                    '<input class="form-control" placeholder="Image path" id="image_path" name="path" aria-describedby="basic-addon2" value="' + button_image + '" type="text">' +
                    '<span class="input-group-addon" id="basic-addon2"><i class="fa fa-picture-o" aria-hidden="true"></i></span>' +
                    '<span class="input-group-addon remove-image-path" id="image_setting_remove_image_path"><i class="fa fa-trash-o" alt="Remove Image" title="Remove Image" aria-hidden="true"></i></span>' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<button type="submit" class="btn btn-danger btn-social-button-remove">Remove</button>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>';

                $("#all_social_buttons").append(html);
            });
        }

        //padding
        $("input[name='social_share_buttons_padding_top']").val($(option_open_for).find('.wrapper').prop('style')['padding-top'].split('px')[0]);
        $("input[name='social_share_buttons_padding_top']").prev().slider({
            value: $("input[name='social_share_buttons_padding_top']").val()
        });
        $("input[name='social_share_buttons_padding_right']").val($(option_open_for).find('.wrapper').prop('style')['padding-right'].split('px')[0]);
        $("input[name='social_share_buttons_padding_right']").prev().slider({
            value: $("input[name='social_share_buttons_padding_right']").val()
        });
        $("input[name='social_share_buttons_padding_bottom']").val($(option_open_for).find('.wrapper').prop('style')['padding-bottom'].split('px')[0]);
        $("input[name='social_share_buttons_padding_bottom']").prev().slider({
            value: $("input[name='payment_method_padding_bottom']").val()
        });
        $("input[name='social_share_buttons_padding_left']").val($(option_open_for).find('.wrapper').prop('style')['padding-left'].split('px')[0]);
        $("input[name='social_share_buttons_padding_left']").prev().slider({
            value: $("input[name='social_share_buttons_padding_left']").val()
        });

        //margin
        $("input[name='social_share_buttons_margin_top']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='social_share_buttons_margin_top']").prev().slider({
            value: $("input[name='social_share_buttons_margin_top']").val()
        });
        $("input[name='social_share_buttons_margin_right']").val($(option_open_for).find('.wrapper').prop('style')['margin-right'].split('px')[0]);
        $("input[name='social_share_buttons_margin_right']").prev().slider({
            value: $("input[name='social_share_buttons_margin_right']").val()
        });
        $("input[name='social_share_buttons_margin_bottom']").val($(option_open_for).find('.wrapper').prop('style')['margin-bottom'].split('px')[0]);
        $("input[name='social_share_buttons_margin_bottom']").prev().slider({
            value: $("input[name='social_share_buttons_margin_bottom']").val()
        });
        $("input[name='social_share_buttons_margin_left']").val($(option_open_for).find('.wrapper').prop('style')['margin-left'].split('px')[0]);
        $("input[name='social_share_buttons_margin_left']").prev().slider({
            value: $("input[name='social_share_buttons_margin_left']").val()
        });
    });

    //add social buttons
    $("#add_social_button").click(function (e) {

        e.preventDefault();


        var html = '<div class="social-button-items">' +
            '<div class="form-group">' +
            '<label class="control-label col-sm-3" for="social_buttons_title_text">Social Button Type:</label>' +
            '<div class="col-sm-9">' +
            '<select class="form-control" id="social_button_type" name="social_button_type"><option>CHOOSE</option><option value="facebook">Facebook</option><option value="google">Google</option><option value="twitter">Twitter</option></select>' +
            '</div>' +
            '</div>' +
            /*'<div class="form-group">' +
            '<label class="control-label col-sm-3" for="social_buttons_title_text">Title Text:</label>' +
            '<div class="col-sm-9">' +
            '<input class="form-control" id="social_buttons_title_text" name="social_buttons_title_text" placeholder="Enter Title text" value="" type="text">' +
            '</div>' +
            '</div>' +*/
            '<div class="form-group">' +
            '<label class="control-label col-sm-3" for="social_button_button_image">Image:</label>' +
            '<div class="col-sm-9">' +
            '<div class="input-group gallery-open" data-toggle="modal" data-target="#imageGalleryModal">' +
            '<input class="form-control" placeholder="Image path" id="image_path" name="path" aria-describedby="basic-addon2" value="" type="text">' +
            '<span class="input-group-addon" id="basic-addon2"><i class="fa fa-picture-o" aria-hidden="true"></i></span>' +
            '<span class="input-group-addon remove-image-path" id="image_setting_remove_image_path"><i class="fa fa-trash-o" alt="Remove Image" title="Remove Image" aria-hidden="true"></i></span>' +
            '</div>' +
            '<div class="form-group">' +
            '<button type="submit" class="btn btn-danger btn-social-button-remove">Remove</button>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>';

        $("#all_social_buttons").append(html);
    });

    $(document).on('click', '.btn-social-button-remove', function (e) {

        e.preventDefault();

        $(this).parent().parent().parent().parent().remove();
    });


    //PAYMENT METHOD SETTING
    $(document).on('click', '.open-payment-setings-modal', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        //colors
        $("#payment_method_caption_text_color").val(rgb2hex($(option_open_for).find('.wrapper .section-title > span').prop('style')['color']));
        $("#payment_method_info_text_color").val(rgb2hex($(option_open_for).find('.wrapper .section-title > p').prop('style')['background-color']));

        //Font
        if ($(option_open_for).find('.wrapper .section-title > span').prop('style')['font-size'].split('px')[0].length > 0)
            $("input[name='payment_method_caption_text_font_size']").val($(option_open_for).find('.wrapper .section-title > span').prop('style')['font-size'].split('px')[0]);
        else
            $("input[name='payment_method_caption_text_font_size']").val(DEFAULT_SHIPPING_FORM_CAPTION_FONT_SIZE);
        $("input[name='payment_method_caption_text_font_size']").prev().slider({
            value: $("input[name='payment_method_caption_text_font_size']").val()
        });

        if ($(option_open_for).find('.wrapper .section-title > p').prop('style')['font-size'].split('px')[0].length > 0)
            $("input[name='payment_method_info_text_font_size']").val($(option_open_for).find('.wrapper .section-title > p').prop('style')['font-size'].split('px')[0]);
        else
            $("input[name='payment_method_info_text_font_size']").val(DEFAULT_SHIPPING_FORM_INFO_FONT_SIZE);
        $("input[name='payment_method_info_text_font_size']").prev().slider({
            value: $("input[name='payment_method_info_text_font_size']").val()
        });

        //padding
        $("input[name='payment_method_padding_top']").val($(option_open_for).find('.wrapper').prop('style')['padding-top'].split('px')[0]);
        $("input[name='payment_method_padding_top']").prev().slider({
            value: $("input[name='payment_method_padding_top']").val()
        });
        $("input[name='payment_method_padding_right']").val($(option_open_for).find('.wrapper').prop('style')['padding-right'].split('px')[0]);
        $("input[name='payment_method_padding_right']").prev().slider({
            value: $("input[name='payment_method_padding_right']").val()
        });
        $("input[name='payment_method_padding_bottom']").val($(option_open_for).find('.wrapper').prop('style')['padding-bottom'].split('px')[0]);
        $("input[name='payment_method_padding_bottom']").prev().slider({
            value: $("input[name='payment_method_padding_bottom']").val()
        });
        $("input[name='payment_method_padding_left']").val($(option_open_for).find('.wrapper').prop('style')['padding-left'].split('px')[0]);
        $("input[name='payment_method_padding_left']").prev().slider({
            value: $("input[name='payment_method_padding_left']").val()
        });

        //margin
        $("input[name='payment_method_margin_top']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='payment_method_margin_top']").prev().slider({
            value: $("input[name='payment_method_margin_top']").val()
        });
        $("input[name='payment_method_margin_right']").val($(option_open_for).find('.wrapper').prop('style')['margin-right'].split('px')[0]);
        $("input[name='payment_method_margin_right']").prev().slider({
            value: $("input[name='payment_method_margin_right']").val()
        });
        $("input[name='payment_method_margin_bottom']").val($(option_open_for).find('.wrapper').prop('style')['margin-bottom'].split('px')[0]);
        $("input[name='payment_method_margin_bottom']").prev().slider({
            value: $("input[name='payment_method_margin_bottom']").val()
        });
        $("input[name='payment_method_margin_left']").val($(option_open_for).find('.wrapper').prop('style')['margin-left'].split('px')[0]);
        $("input[name='payment_method_margin_left']").prev().slider({
            value: $("input[name='payment_method_margin_left']").val()
        });


        //alert($(option_open_for).find('.wrapper > p').prop('style')['color']);
        $("#payment_method_caption_text").val($(option_open_for).find('.wrapper .section-title > span').text());
        $("#payment_method_info_text").val($(option_open_for).find('.wrapper .section-title > p').text());
    });


    //CUSTOMER INFORMATION SETTING
    $(document).on('click', '.open-customer-info-setings-modal', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        //colors
        $("#customer_info_caption_text_color").val(rgb2hex($(option_open_for).find('.wrapper .section-title ').prop('style')['color']));
        $("#customer_info_caption_text_bg_color").val(rgb2hex($(option_open_for).find('.wrapper .section-title').prop('style')['background-color']));

        //Font
        if ($(option_open_for).find('.wrapper .section-title').prop('style')['font-size'].split('px')[0].length > 0)
            $("input[name='customer_info_caption_text_font_size']").val($(option_open_for).find('.wrapper .section-title').prop('style')['font-size'].split('px')[0]);
        else
            $("input[name='customer_info_caption_text_font_size']").val(DEFAULT_SHIPPING_FORM_CAPTION_FONT_SIZE);
        $("input[name='customer_info_caption_text_font_size']").prev().slider({
            value: $("input[name='customer_info_caption_text_font_size']").val()
        });

        //padding
        $("input[name='customer_info_padding_top']").val($(option_open_for).find('.wrapper').prop('style')['padding-top'].split('px')[0]);
        $("input[name='customer_info_padding_top']").prev().slider({
            value: $("input[name='customer_info_padding_top']").val()
        });
        $("input[name='customer_info_padding_right']").val($(option_open_for).find('.wrapper').prop('style')['padding-right'].split('px')[0]);
        $("input[name='customer_info_padding_right']").prev().slider({
            value: $("input[name='customer_info_padding_right']").val()
        });
        $("input[name='customer_info_padding_bottom']").val($(option_open_for).find('.wrapper').prop('style')['padding-bottom'].split('px')[0]);
        $("input[name='customer_info_padding_bottom']").prev().slider({
            value: $("input[name='customer_info_padding_bottom']").val()
        });
        $("input[name='customer_info_padding_left']").val($(option_open_for).find('.wrapper').prop('style')['padding-left'].split('px')[0]);
        $("input[name='customer_info_padding_left']").prev().slider({
            value: $("input[name='customer_info_padding_left']").val()
        });

        //margin
        $("input[name='customer_info_margin_top']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='customer_info_margin_top']").prev().slider({
            value: $("input[name='customer_info_margin_top']").val()
        });
        $("input[name='customer_info_margin_right']").val($(option_open_for).find('.wrapper').prop('style')['margin-right'].split('px')[0]);
        $("input[name='customer_info_margin_right']").prev().slider({
            value: $("input[name='customer_info_margin_right']").val()
        });
        $("input[name='customer_info_margin_bottom']").val($(option_open_for).find('.wrapper').prop('style')['margin-bottom'].split('px')[0]);
        $("input[name='customer_info_margin_bottom']").prev().slider({
            value: $("input[name='customer_info_margin_bottom']").val()
        });
        $("input[name='customer_info_margin_left']").val($(option_open_for).find('.wrapper').prop('style')['margin-left'].split('px')[0]);
        $("input[name='customer_info_margin_left']").prev().slider({
            value: $("input[name='customer_info_margin_left']").val()
        });


        //alert($(option_open_for).find('.wrapper > p').prop('style')['color']);
        $("#customer_info_caption_text").val($(option_open_for).find('.wrapper .section-title').text());
    });

    //CART SETTING
    $(document).on('click', '.open-cart-setings-modal', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        //colors
        $("#cart_setting_product_text_color").val(rgb2hex($(option_open_for).find('.product-description ul > li.description > span').prop('style')['color']));
        $("#cart_setting_label_text_color").val(rgb2hex($(option_open_for).find('.wrapper ul.options > li > span').prop('style')['color']));
        $("#cart_setting_price_text_color").val(rgb2hex($(option_open_for).find('.wrapper ul > li > strong, .wrapper ul > li.price').prop('style')['color']));

        //padding
        //alert($(option_open_for).html());
        $("input[name='cart_setting_padding_top']").val($(option_open_for).find('.wrapper').prop('style')['padding-top'].split('px')[0]);
        $("input[name='cart_setting_padding_top']").prev().slider({
            value: $("input[name='cart_setting_padding_top']").val()
        });
        $("input[name='cart_setting_padding_right']").val($(option_open_for).find('.wrapper').prop('style')['padding-right'].split('px')[0]);
        $("input[name='cart_setting_padding_right']").prev().slider({
            value: $("input[name='cart_setting_padding_right']").val()
        });
        $("input[name='cart_setting_padding_bottom']").val($(option_open_for).find('.wrapper').prop('style')['padding-bottom'].split('px')[0]);
        $("input[name='cart_setting_padding_bottom']").prev().slider({
            value: $("input[name='cart_setting_padding_bottom']").val()
        });
        $("input[name='cart_setting_padding_left']").val($(option_open_for).find('.wrapper').prop('style')['padding-left'].split('px')[0]);
        $("input[name='cart_setting_padding_left']").prev().slider({
            value: $("input[name='cart_setting_padding_left']").val()
        });

        //margin
        $("input[name='cart_setting_margin_top']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='cart_setting_margin_top']").prev().slider({
            value: $("input[name='cart_setting_margin_top']").val()
        });
        $("input[name='cart_setting_margin_right']").val($(option_open_for).find('.wrapper').prop('style')['margin-right'].split('px')[0]);
        $("input[name='cart_setting_margin_right']").prev().slider({
            value: $("input[name='cart_setting_margin_right']").val()
        });
        $("input[name='cart_setting_margin_bottom']").val($(option_open_for).find('.wrapper').prop('style')['margin-bottom'].split('px')[0]);
        $("input[name='cart_setting_margin_bottom']").prev().slider({
            value: $("input[name='cart_setting_margin_bottom']").val()
        });
        $("input[name='cart_setting_margin_left']").val($(option_open_for).find('.wrapper').prop('style')['margin-left'].split('px')[0]);
        $("input[name='cart_setting_margin_left']").prev().slider({
            value: $("input[name='cart_setting_margin_left']").val()
        });


        //alert($(option_open_for).find('.wrapper > p').prop('style')['color']);
        //$("#billing_address_caption_text").val($(option_open_for).find('.wrapper > .billing-form > .section-title').text());
    });


    //BILLING ADDRESS SETTING
    $(document).on('click', '.open-billing-address-setings-modal', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        //colors
        $("#billing_address_caption_text_color").val(rgb2hex($(option_open_for).find('.wrapper > .billing-form > .section-title').prop('style')['color']));
        $("#billing_address_caption_text_bg_color").val(rgb2hex($(option_open_for).find('.wrapper > .billing-form > .section-title').prop('style')['background-color']));

        //Font
        if ($(option_open_for).find('.wrapper > .billing-form > .section-title').prop('style')['font-size'].split('px')[0].length > 0)
            $("input[name='billing_address_caption_text_font_size']").val($(option_open_for).find('.wrapper > .billing-form > .section-title').prop('style')['font-size'].split('px')[0]);
        else
            $("input[name='billing_address_caption_text_font_size']").val(DEFAULT_SHIPPING_FORM_CAPTION_FONT_SIZE);
        $("input[name='billing_address_caption_text_font_size']").prev().slider({
            value: $("input[name='billing_address_caption_text_font_size']").val()
        });

        //padding
        $("input[name='billing_address_padding_top']").val($(option_open_for).find('.wrapper > .billing-form').prop('style')['padding-top'].split('px')[0]);
        $("input[name='billing_address_padding_top']").prev().slider({
            value: $("input[name='billing_address_padding_top']").val()
        });
        $("input[name='billing_address_padding_right']").val($(option_open_for).find('.wrapper > .billing-form').prop('style')['padding-right'].split('px')[0]);
        $("input[name='billing_address_padding_right']").prev().slider({
            value: $("input[name='billing_address_padding_right']").val()
        });
        $("input[name='billing_address_padding_bottom']").val($(option_open_for).find('.wrapper > .billing-form').prop('style')['padding-bottom'].split('px')[0]);
        $("input[name='billing_address_padding_bottom']").prev().slider({
            value: $("input[name='billing_address_padding_bottom']").val()
        });
        $("input[name='billing_address_padding_left']").val($(option_open_for).find('.wrapper > .billing-form').prop('style')['padding-right'].split('px')[0]);
        $("input[name='billing_address_padding_left']").prev().slider({
            value: $("input[name='billing_address_padding_left']").val()
        });

        //margin
        $("input[name='billing_address_margin_top']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='billing_address_margin_top']").prev().slider({
            value: $("input[name='billing_address_margin_top']").val()
        });
        $("input[name='billing_address_margin_right']").val($(option_open_for).find('.wrapper').prop('style')['margin-right'].split('px')[0]);
        $("input[name='billing_address_margin_right']").prev().slider({
            value: $("input[name='billing_address_margin_right']").val()
        });
        $("input[name='billing_address_margin_bottom']").val($(option_open_for).find('.wrapper').prop('style')['margin-bottom'].split('px')[0]);
        $("input[name='billing_address_margin_bottom']").prev().slider({
            value: $("input[name='billing_address_margin_bottom']").val()
        });
        $("input[name='billing_address_margin_left']").val($(option_open_for).find('.wrapper').prop('style')['margin-left'].split('px')[0]);
        $("input[name='billing_address_margin_left']").prev().slider({
            value: $("input[name='billing_address_margin_left']").val()
        });


        //alert($(option_open_for).find('.wrapper > p').prop('style')['color']);
        $("#billing_address_caption_text").val($(option_open_for).find('.wrapper > .billing-form > .section-title').text());
    });


    //SHIPPING ADDRESS SETTING
    $(document).on('click', '.open-shipping-addresssetings-modal', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        //colors
        $("#shipping_address_caption_text_color").val(rgb2hex($(option_open_for).find('.wrapper > .shipping-form > .section-title').prop('style')['color']));
        $("#shipping_address_caption_text_bg_color").val(rgb2hex($(option_open_for).find('.wrapper > .shipping-form > .section-title').prop('style')['background-color']));

        //Font
        if ($(option_open_for).find('.wrapper > .shipping-form > .section-title').prop('style')['font-size'].split('px')[0].length > 0)
            $("input[name='shipping_address_caption_text_font_size']").val($(option_open_for).find('.wrapper > .shipping-form > .section-title').prop('style')['font-size'].split('px')[0]);
        else
            $("input[name='shipping_address_caption_text_font_size']").val(DEFAULT_SHIPPING_FORM_CAPTION_FONT_SIZE);
        $("input[name='shipping_address_caption_text_font_size']").prev().slider({
            value: $("input[name='shipping_address_caption_text_font_size']").val()
        });

        //padding
        $("input[name='shipping_address_padding_top']").val($(option_open_for).find('.wrapper > .shipping-form').prop('style')['padding-top'].split('px')[0]);
        $("input[name='shipping_address_padding_top']").prev().slider({
            value: $("input[name='shipping_address_padding_top']").val()
        });
        $("input[name='shipping_address_padding_right']").val($(option_open_for).find('.wrapper > .shipping-form').prop('style')['padding-right'].split('px')[0]);
        $("input[name='shipping_address_padding_right']").prev().slider({
            value: $("input[name='shipping_address_padding_right']").val()
        });
        $("input[name='shipping_address_padding_bottom']").val($(option_open_for).find('.wrapper > .shipping-form').prop('style')['padding-bottom'].split('px')[0]);
        $("input[name='shipping_address_padding_bottom']").prev().slider({
            value: $("input[name='shipping_address_padding_bottom']").val()
        });
        $("input[name='shipping_address_padding_left']").val($(option_open_for).find('.wrapper > .shipping-form').prop('style')['padding-left'].split('px')[0]);
        $("input[name='shipping_address_padding_left']").prev().slider({
            value: $("input[name='shipping_address_padding_left']").val()
        });

        //margin
        $("input[name='shipping_address_margin_top']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='shipping_address_margin_top']").prev().slider({
            value: $("input[name='shipping_address_margin_top']").val()
        });
        $("input[name='shipping_address_margin_right']").val($(option_open_for).find('.wrapper').prop('style')['margin-right'].split('px')[0]);
        $("input[name='shipping_address_margin_right']").prev().slider({
            value: $("input[name='shipping_address_margin_right']").val()
        });
        $("input[name='shipping_address_margin_bottom']").val($(option_open_for).find('.wrapper').prop('style')['margin-bottom'].split('px')[0]);
        $("input[name='shipping_address_margin_bottom']").prev().slider({
            value: $("input[name='shipping_address_margin_bottom']").val()
        });
        $("input[name='shipping_address_margin_left']").val($(option_open_for).find('.wrapper').prop('style')['margin-left'].split('px')[0]);
        $("input[name='shipping_address_margin_left']").prev().slider({
            value: $("input[name='shipping_address_margin_left']").val()
        });


        //alert($(option_open_for).find('.wrapper > p').prop('style')['color']);
        $("#shipping_address_caption_text").val($(option_open_for).find('.wrapper > .shipping-form > .section-title').text());
    });


    //SELECT SETTINGS
    $(document).on('click', '.open-select-box-setings-modal', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        /*var input_type = $(option_open_for).find('.text-field-wrapper > input').attr('name');
        //alert(input_type);
        //$('#text_field_input_type').val(input_type);

        var required = $(option_open_for).find('.text-field-wrapper > input').attr('required');
        $('#text_field_required').val(required);*/

        $("#frm_select_box_settings").find('input, select').val('');
        $("#custom_option_select table > tbody > tr").each(function (index, element) {

            if (index > 1) {
                $(element).remove();
            }
        });

        var input_type = $(option_open_for).find('.select-box-wrapper > select').attr('data-select-type');
        //alert(input_type);
        $('#select_box_type').val(input_type);
        $('#select_box_type').trigger('change');

        if (input_type == 'custom') {
            $("#custom_option_select").show();

            $("#custom_option_select  table > tbody > tr").html("");

            $(".select-box-wrapper > select").find('option').each(function (index, element) {

                $("#custom_option_select  table > tbody").append('<tr><td><input type="text" class="form-control" placeholder="i.e: Rex" value="' + $(element).attr('value') + '" /></td><td><input type="text" class="form-control" placeholder="i.e: Rex" value="' + $(element).text() + '" /></td></tr>');
            });

        } else {
            $("#custom_option_select").hide();
        }

        $("#select_box_custom_type_name").val($(option_open_for).find('.select-box-wrapper > select').attr('data-select-name'));

        //padding
        $("input[name='select_box_padding_top']").val(($(option_open_for).find('.select-box-wrapper > select').prop('style')['padding-top'].split('px')[0]));
        $("input[name='select_box_padding_top']").prev().slider({
            value: $("input[name='select_box_padding_top']").val()
        });
        $("input[name='select_box_padding_right']").val(($(option_open_for).find('.select-box-wrapper > select').prop('style')['padding-right'].split('px')[0]));
        $("input[name='select_box_padding_right']").prev().slider({
            value: $("input[name='select_box_padding_right']").val()
        });
        $("input[name='select_box_padding_bottom']").val(($(option_open_for).find('.select-box-wrapper > select').prop('style')['padding-bottom'].split('px')[0]));
        $("input[name='select_box_padding_bottom']").prev().slider({
            value: $("input[name='select_box_padding_bottom']").val()
        });
        $("input[name='select_box_padding_left']").val(($(option_open_for).find('.select-box-wrapper > select').prop('style')['padding-left'].split('px')[0]));
        $("input[name='select_box_padding_left']").prev().slider({
            value: $("input[name='select_box_padding_left']").val()
        });

        //margin
        $("input[name='select_box_margin_top']").val($(option_open_for).find('.select-box-wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='select_box_margin_top']").prev().slider({
            value: $("input[name='select_box_margin_top']").val()
        });
        $("input[name='select_box_margin_right']").val($(option_open_for).find('.select-box-wrapper').prop('style')['margin-right'].split('px')[0]);
        $("input[name='select_box_margin_right']").prev().slider({
            value: $("input[name='select_box_margin_right']").val()
        });
        $("input[name='select_box_margin_bottom']").val($(option_open_for).find('.select-box-wrapper').prop('style')['margin-bottom'].split('px')[0]);
        $("input[name='select_box_margin_bottom']").prev().slider({
            value: $("input[name='select_box_margin_bottom']").val()
        });
        $("input[name='select_box_margin_left']").val($(option_open_for).find('.select-box-wrapper').prop('style')['margin-left'].split('px')[0]);
        $("input[name='select_box_margin_left']").prev().slider({
            value: $("input[name='select_box_margin_left']").val()
        });
    });

    $(document).on('change', '#select_box_type', function (e) {

        if ($(this).val() == 'custom') {
            $("#custom_option_select").show();
        } else {
            $("#custom_option_select").hide();
        }
    });


    //POPUP SETTINGS
    $(document).on('click', '.open-page-popup-setings-modal', function (e) {

        option_open_for = $(data_page_popup);
        settingsOpenModal = $(this).attr('data-target');

        $("#frm_page_popup_settings").find('input, select').val('');

        /*var input_type = $(option_open_for).find('.text-field-wrapper > input').attr('type');
        $('#text_field_input_type').val(input_type);

        var required = $(option_open_for).find('.text-field-wrapper > input').attr('required');
        $('#text_field_required').val(required);*/

        $("#page_popup_bg_image").val($(option_open_for).find('.popup-inner').attr('data-bg-image'));
        $("#page_popup_image_position").val($(option_open_for).find('.popup-inner').attr('data-bg-position'));
        $("#page_popup_modal_width").val($(option_open_for).find('.popup-inner').attr('data-modal-width'));
        $("#page_popup_modal_open_after").val($(option_open_for).find('.popup-inner').attr('data-modal-open-after'));

        //colors
        $("#page_popup_backdrop").val(rgb2hex($(option_open_for).prop('style')['background-color']));
        $("#page_popup_bg_color").val(rgb2hex($(option_open_for).find('.popup-inner').prop('style')['background-color']));
        $("#page_popup_text_color").val(rgb2hex($(option_open_for).find('.popup-inner').prop('style')['color']));

        //borders
        $("#page_popup_backdrop").val(rgb2hex($(option_open_for).prop('style')['background-color']));
        $("#page_popup_bg_color").val(rgb2hex($(option_open_for).find('.popup-inner').prop('style')['background-color']));
        $("#page_popup_text_color").val(rgb2hex($(option_open_for).find('.popup-inner').prop('style')['color']));

        try {
            var border = $(option_open_for).find('.popup-inner').prop('style')['border-style'];
            var border_width = $(option_open_for).find('.popup-inner').prop('style')['border-width'];
            if (border)
                $('#page_popup_border_style option[value="' + border + '"]').attr("selected", "selected");
            else
                $('#page_popup_border_style option[value="none"]').attr("selected", "selected");

            $("#image_border_color").val(rgb2hex($(option_open_for).find('.popup-inner').prop('style')['border-color']));
            $('#page_popup_border_size option[value="' + border_width + '"]').attr("selected", "selected");
        } catch (err) {
        }

        //padding
        //alert($(option_open_for).find('.popup-inner').prop('style')['padding-top']);
        $("input[name='page_popup_padding_top']").val(($(option_open_for).find('.popup-inner').prop('style')['padding-top'].split('px')[0]));
        $("input[name='page_popup_padding_top']").prev().slider({
            value: $("input[name='page_popup_padding_top']").val()
        });
        $("input[name='page_popup_padding_right']").val(($(option_open_for).find('.popup-inner').prop('style')['padding-right'].split('px')[0]));
        $("input[name='page_popup_padding_right']").prev().slider({
            value: $("input[name='page_popup_padding_right']").val()
        });
        $("input[name='page_popup_padding_bottom']").val(($(option_open_for).find('.popup-inner').prop('style')['padding-bottom'].split('px')[0]));
        $("input[name='page_popup_padding_bottom']").prev().slider({
            value: $("input[name='page_popup_padding_bottom']").val()
        });
        $("input[name='page_popup_padding_left']").val(($(option_open_for).find('.popup-inner').prop('style')['padding-left'].split('px')[0]));
        $("input[name='page_popup_padding_left']").prev().slider({
            value: $("input[name='page_popup_padding_left']").val()
        });

        //margin
        $("input[name='page_popup_margin_top']").val($(option_open_for).find('.popup-inner').prop('style')['margin-top'].split('px')[0]);
        $("input[name='page_popup_margin_top']").prev().slider({
            value: $("input[name='page_popup_margin_top']").val()
        });
        $("input[name='page_popup_margin_right']").val($(option_open_for).find('.popup-inner').prop('style')['margin-right'].split('px')[0]);
        $("input[name='page_popup_margin_right']").prev().slider({
            value: $("input[name='page_popup_margin_right']").val()
        });
        $("input[name='page_popup_margin_bottom']").val($(option_open_for).find('.popup-inner').prop('style')['margin-bottom'].split('px')[0]);
        $("input[name='page_popup_margin_bottom']").prev().slider({
            value: $("input[name='page_popup_margin_bottom']").val()
        });
        $("input[name='page_popup_margin_left']").val($(option_open_for).find('.popup-inner').prop('style')['margin-left'].split('px')[0]);
        $("input[name='page_popup_margin_left']").prev().slider({
            value: $("input[name='page_popup_margin_left']").val()
        });
    });


    //INPUT TEXT SETTINGS
    $(document).on('click', '.open-text-field-setings-modal', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        /*var input_type = $(option_open_for).find('.text-field-wrapper > input').attr('name');
        //alert(input_type);
        //$('#text_field_input_type').val(input_type);

        var required = $(option_open_for).find('.text-field-wrapper > input').attr('required');
        $('#text_field_required').val(required);*/

        var input_type = $(option_open_for).find('.text-field-wrapper > input').attr('name');
        //alert(input_type);
        $('#text_field_input_type').val(input_type);

        var required = $(option_open_for).find('.text-field-wrapper > input').attr('required');
        $('#text_field_required').val(required);

        $("#text_field_placeholder_text").val($(option_open_for).find('.text-field-wrapper > input[type="text"]').attr('placeholder'));


        //font size
        $("input[name='text_field_font_size']").val(($(option_open_for).find('.text-field-wrapper > input[type="text"]').prop('style')['font-size'].split('px')[0]));
        $("input[name='text_field_font_size']").prev().slider({
            value: $("input[name='text_field_font_size']").val()
        });


        //padding
        $("input[name='text_field_padding_top']").val(($(option_open_for).find('.text-field-wrapper > input[type="text"]').prop('style')['padding-top'].split('px')[0]));
        $("input[name='text_field_padding_top']").prev().slider({
            value: $("input[name='text_field_padding_top']").val()
        });
        $("input[name='text_field_padding_right']").val(($(option_open_for).find('.text-field-wrapper > input[type="text"]').prop('style')['padding-right'].split('px')[0]));
        $("input[name='text_field_padding_right']").prev().slider({
            value: $("input[name='text_field_padding_right']").val()
        });
        $("input[name='text_field_padding_bottom']").val(($(option_open_for).find('.text-field-wrapper > input[type="text"]').prop('style')['padding-bottom'].split('px')[0]));
        $("input[name='text_field_padding_bottom']").prev().slider({
            value: $("input[name='text_field_padding_bottom']").val()
        });
        $("input[name='text_field_padding_left']").val(($(option_open_for).find('.text-field-wrapper > input[type="text"]').prop('style')['padding-left'].split('px')[0]));
        $("input[name='text_field_padding_left']").prev().slider({
            value: $("input[name='text_field_padding_left']").val()
        });

        //margin
        $("input[name='text_field_margin_top']").val($(option_open_for).find('.text-field-wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='text_field_margin_top']").prev().slider({
            value: $("input[name='text_field_margin_top']").val()
        });
        $("input[name='text_field_margin_right']").val($(option_open_for).find('.text-field-wrapper').prop('style')['margin-right'].split('px')[0]);
        $("input[name='text_field_margin_right']").prev().slider({
            value: $("input[name='text_field_margin_right']").val()
        });
        $("input[name='text_field_margin_bottom']").val($(option_open_for).find('.text-field-wrapper').prop('style')['margin-bottom'].split('px')[0]);
        $("input[name='text_field_margin_bottom']").prev().slider({
            value: $("input[name='text_field_margin_bottom']").val()
        });
        $("input[name='text_field_margin_left']").val($(option_open_for).find('.text-field-wrapper').prop('style')['margin-left'].split('px')[0]);
        $("input[name='text_field_margin_left']").prev().slider({
            value: $("input[name='text_field_margin_left']").val()
        });
    });


    //SEPERATOR TEXT SETTINGS
    $(document).on('click', '.open-order-two-step-settings', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        $("#order_two_step_headline").val($(option_open_for).find('.wrapper .two-step-form > .header > h3').text());
        $("#order_two_step_left_title").val($(option_open_for).find('.wrapper .two-step-form > .step-header li:first-child > strong').text());
        $("#order_two_step_right_title").val($(option_open_for).find('.wrapper .two-step-form > .step-header li:last-child > strong').text());
        $("#order_two_step_left_info").val($(option_open_for).find('.wrapper .two-step-form > .step-header li:first-child > p').text());
        $("#order_two_step_right_info").val($(option_open_for).find('.wrapper .two-step-form > .step-header li:last-child > p').text());

        $("#order_two_step_headline_color").val(rgb2hex($(option_open_for).find('.wrapper .two-step-form > .header').prop('style')['color']));
        $("#order_two_step_headline_bg_color").val(rgb2hex($(option_open_for).find('.wrapper .two-step-form > .header').prop('style')['background-color']));

        $("#order_two_step_button_color").val(rgb2hex($(option_open_for).find('.wrapper .two-step-form button.btn-next-step, .wrapper .two-step-form button.complete-order').prop('style')['color']));
        $("#order_two_step_button_bg_color").val(rgb2hex($(option_open_for).find('.wrapper .two-step-form button.btn-next-step, .wrapper .two-step-form button.complete-order').prop('style')['background-color']));
        //$("#order_two_step_normal_color").val(rgb2hex($(option_open_for).find('.horizontal-seperator-wrapper > .fake-legend > span').prop('style')['color']));
        //$("#order_two_step_active_color").val(rgb2hex($(option_open_for).find('.horizontal-seperator-wrapper > .fake-legend').prop('style')['border-bottom-color']));
        //$("#order_two_step_normal_bg_color").val(rgb2hex($(option_open_for).find('.horizontal-seperator-wrapper > .fake-legend > span').prop('style')['background-color']));
        //$("#order_two_step_active_bg_color").val(rgb2hex($(option_open_for).find('.horizontal-seperator-wrapper > .fake-legend > span').prop('style')['background-color']));

        //font size
        $("input[name='order_two_step_headline_font_size']").val(($(option_open_for).find('.wrapper .two-step-form > .header > h3').prop('style')['font-size'].split('px')[0]));
        $("input[name='order_two_step_headline_font_size']").prev().slider({
            value: $("input[name='order_two_step_headline_font_size']").val()
        });

        $("input[name='order_two_step_header_font_size']").val(($(option_open_for).find('.wrapper .two-step-form > .step-header li > strong').prop('style')['font-size'].split('px')[0]));
        $("input[name='order_two_step_header_font_size']").prev().slider({
            value: $("input[name='order_two_step_header_font_size']").val()
        });

        $("input[name='order_two_step_info_font_size']").val(($(option_open_for).find('.wrapper .two-step-form > .step-header li > p').prop('style')['font-size'].split('px')[0]));
        $("input[name='order_two_step_info_font_size']").prev().slider({
            value: $("input[name='order_two_step_info_font_size']").val()
        });

        //padding
        $("input[name='order_two_step_padding_top']").val(($(option_open_for).find('.wrapper').prop('style')['padding-top'].split('px')[0]));
        $("input[name='order_two_step_padding_top']").prev().slider({
            value: $("input[name='order_two_step_padding_top']").val()
        });
        $("input[name='order_two_step_padding_right']").val(($(option_open_for).find('.wrapper').prop('style')['padding-right'].split('px')[0]));
        $("input[name='order_two_step_padding_right']").prev().slider({
            value: $("input[name='order_two_step_padding_right']").val()
        });
        $("input[name='order_two_step_padding_bottom']").val(($(option_open_for).find('.wrapper').prop('style')['padding-bottom'].split('px')[0]));
        $("input[name='order_two_step_padding_bottom']").prev().slider({
            value: $("input[name='order_two_step_padding_bottom']").val()
        });
        $("input[name='order_two_step_padding_left']").val(($(option_open_for).find('.wrapper').prop('style')['padding-left'].split('px')[0]));
        $("input[name='order_two_step_padding_left']").prev().slider({
            value: $("input[name='order_two_step_padding_left']").val()
        });

        //margin
        $("input[name='order_two_step_margin_top']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='order_two_step_margin_top']").prev().slider({
            value: $("input[name='order_two_step_margin_top']").val()
        });
        $("input[name='order_two_step_margin_right']").val($(option_open_for).find('.wrapper').prop('style')['margin-right'].split('px')[0]);
        $("input[name='order_two_step_margin_right']").prev().slider({
            value: $("input[name='order_two_step_margin_right']").val()
        });
        $("input[name='order_two_step_margin_bottom']").val($(option_open_for).find('.wrapper').prop('style')['margin-bottom'].split('px')[0]);
        $("input[name='order_two_step_margin_bottom']").prev().slider({
            value: $("input[name='order_two_step_margin_bottom']").val()
        });
        $("input[name='order_two_step_margin_left']").val($(option_open_for).find('.wrapper').prop('style')['margin-left'].split('px')[0]);
        $("input[name='order_two_step_margin_left']").prev().slider({
            value: $("input[name='order_two_step_margin_left']").val()
        });
    });


    //SPACEBAR SETTINGS
    $(document).on('click', '.open-spacebar-setings-modal', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        $("input[name='specebar_settings_height']").val(($(option_open_for).find('.empty-space-wrapper > div').prop('style')['height'].split('px')[0]));
        $("input[name='specebar_settings_height']").prev().slider({
            value: $("input[name='specebar_settings_height']").val()
        });
    });


    //SEPERATOR TEXT SETTINGS
    $(document).on('click', '.open-horizontal-seperator-setings-modal', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        $("#seperator_text_settings").val($(option_open_for).find('.horizontal-seperator-wrapper > .fake-legend > span').text());

        $("#seperator_text_settings_text_color").val(rgb2hex($(option_open_for).find('.horizontal-seperator-wrapper > .fake-legend > span').prop('style')['color']));
        $("#seperator_text_settings_line_color").val(rgb2hex($(option_open_for).find('.horizontal-seperator-wrapper > .fake-legend').prop('style')['border-bottom-color']));

        if ($(option_open_for).find('.horizontal-seperator-wrapper > .fake-legend > span').prop('style')['background-color'].length > 0)
            $("#seperator_text_settings_bg_color").val(rgb2hex($(option_open_for).find('.horizontal-seperator-wrapper > .fake-legend > span').prop('style')['background-color']));

        //font size
        $("input[name='seperator_text_settings_font_size']").val(($(option_open_for).find('.horizontal-seperator-wrapper > .fake-legend > span').prop('style')['font-size'].split('px')[0]));
        $("input[name='seperator_text_settings_font_size']").prev().slider({
            value: $("input[name='seperator_text_settings_font_size']").val()
        });

        var weight = $(option_open_for).find('.horizontal-seperator-wrapper > .fake-legend > span').prop('style')['font-weight'];
        $('#seperator_text_settings_font_weight option[value="' + weight + '"]').attr("selected", "selected");

        //padding
        $("input[name='seperator_text_settings_padding_top']").val(($(option_open_for).find('.image-inside-tab-wrapper > .tab-image').prop('style')['padding-top'].split('px')[0]));
        $("input[name='seperator_text_settings_padding_top']").prev().slider({
            value: $("input[name='seperator_text_settings_padding_top']").val()
        });
        $("input[name='seperator_text_settings_padding_right']").val(($(option_open_for).find('.image-inside-tab-wrapper > .tab-image').prop('style')['padding-right'].split('px')[0]));
        $("input[name='seperator_text_settings_padding_right']").prev().slider({
            value: $("input[name='seperator_text_settings_padding_right']").val()
        });
        $("input[name='seperator_text_settings_padding_bottom']").val(($(option_open_for).find('.image-inside-tab-wrapper > .tab-image').prop('style')['padding-bottom'].split('px')[0]));
        $("input[name='seperator_text_settings_padding_bottom']").prev().slider({
            value: $("input[name='seperator_text_settings_padding_bottom']").val()
        });
        $("input[name='seperator_text_settings_padding_left']").val(($(option_open_for).find('.image-inside-tab-wrapper > .tab-image').prop('style')['padding-left'].split('px')[0]));
        $("input[name='seperator_text_settings_padding_left']").prev().slider({
            value: $("input[name='seperator_text_settings_padding_left']").val()
        });

        //margin
        $("input[name='seperator_text_settings_margin_top']").val($(option_open_for).find('.image-inside-tab-wrapper > .tab-image').prop('style')['margin-top'].split('px')[0]);
        $("input[name='seperator_text_settings_margin_top']").prev().slider({
            value: $("input[name='seperator_text_settings_margin_top']").val()
        });
        $("input[name='seperator_text_settings_margin_right']").val($(option_open_for).find('.image-inside-tab-wrapper > .tab-image').prop('style')['margin-right'].split('px')[0]);
        $("input[name='seperator_text_settings_margin_right']").prev().slider({
            value: $("input[name='seperator_text_settings_margin_right']").val()
        });
        $("input[name='seperator_text_settings_margin_bottom']").val($(option_open_for).find('.image-inside-tab-wrapper > .tab-image').prop('style')['margin-bottom'].split('px')[0]);
        $("input[name='seperator_text_settings_margin_bottom']").prev().slider({
            value: $("input[name='seperator_text_settings_margin_bottom']").val()
        });
        $("input[name='seperator_text_settings_margin_left']").val($(option_open_for).find('.image-inside-tab-wrapper > .tab-image').prop('style')['margin-left'].split('px')[0]);
        $("input[name='seperator_text_settings_margin_left']").prev().slider({
            value: $("input[name='seperator_text_settings_margin_left']").val()
        });
    });


    //IMAGE INSIDE TAB SETTINGS
    $(document).on('click', '.open-image-inside-tab-setings-modal', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        $("#image_inside_tab_image_path").val($(option_open_for).find('.image-inside-tab-wrapper .tab-image').attr('data-tab-src'));
        $("#image_inside_inner_image_path").val($(option_open_for).find('.image-inside-tab-wrapper .tab-image > img').attr('src'));

        if ($(option_open_for).find('.image-inside-tab-wrapper .tab-image > img').attr('style')) {

            $("input[name='image_inside_width']").val(($(option_open_for).find('.image-inside-tab-wrapper .tab-image > img').prop('style')['width'].split('%')[0]));
            $("input[name='image_inside_width']").prev().slider({
                value: $("input[name='image_inside_width']").val()
            });

            $("#image_inside_height").val($(option_open_for).find('.image-inside-tab-wrapper .tab-image > img').prop('style')['height']);
        }
        //}

        //padding
        $("input[name='image_inside_padding_top']").val(($(option_open_for).find('.image-inside-tab-wrapper > .tab-image').prop('style')['padding-top'].split('px')[0]));
        $("input[name='image_inside_padding_top']").prev().slider({
            value: $("input[name='image_inside_padding_top']").val()
        });
        $("input[name='image_inside_padding_right']").val(($(option_open_for).find('.image-inside-tab-wrapper > .tab-image').prop('style')['padding-right'].split('px')[0]));
        $("input[name='image_inside_padding_right']").prev().slider({
            value: $("input[name='image_inside_padding_right']").val()
        });
        $("input[name='image_inside_padding_bottom']").val(($(option_open_for).find('.image-inside-tab-wrapper > .tab-image').prop('style')['padding-bottom'].split('px')[0]));
        $("input[name='image_inside_padding_bottom']").prev().slider({
            value: $("input[name='image_inside_padding_bottom']").val()
        });
        $("input[name='image_inside_padding_left']").val(($(option_open_for).find('.image-inside-tab-wrapper > .tab-image').prop('style')['padding-left'].split('px')[0]));
        $("input[name='image_inside_padding_left']").prev().slider({
            value: $("input[name='image_inside_padding_left']").val()
        });

        //margin
        $("input[name='image_inside_margin_top']").val($(option_open_for).find('.image-inside-tab-wrapper > .tab-image').prop('style')['margin-top'].split('px')[0]);
        $("input[name='image_inside_margin_top']").prev().slider({
            value: $("input[name='image_inside_margin_top']").val()
        });
        $("input[name='image_inside_margin_right']").val($(option_open_for).find('.image-inside-tab-wrapper > .tab-image').prop('style')['margin-right'].split('px')[0]);
        $("input[name='image_inside_margin_right']").prev().slider({
            value: $("input[name='image_inside_margin_right']").val()
        });
        $("input[name='image_inside_margin_bottom']").val($(option_open_for).find('.image-inside-tab-wrapper > .tab-image').prop('style')['margin-bottom'].split('px')[0]);
        $("input[name='image_inside_margin_bottom']").prev().slider({
            value: $("input[name='image_inside_margin_bottom']").val()
        });
        $("input[name='image_inside_margin_left']").val($(option_open_for).find('.image-inside-tab-wrapper > .tab-image').prop('style')['margin-left'].split('px')[0]);
        $("input[name='image_inside_margin_left']").prev().slider({
            value: $("input[name='image_inside_margin_left']").val()
        });
    });


    //EMPTY CONTAINER TEXT
    $(document).on('click', '.open-empty-container-setings-modal', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        //action
        var align = $(option_open_for).find('.lb-content-body').prop('style')['text-align'];
        $('#empty_container_text_align option[value="' + align + '"]').attr("selected", "selected");


        ///////////
        //alert($('.wrapper .section-title > strong').text());
        $("#empty_container_section_id").val($(option_open_for).find('.lb-content-body').attr('id'));

        //Color
        $("#empty_container_text_color").val(rgb2hex($(option_open_for).find('.lb-content-body').prop('style')['color']));
        $("#empty_container_bg_color").val(rgb2hex($(option_open_for).find('.lb-content-body').prop('style')['background-color']));

        //Border
        $("#empty_container_border_style").val($(option_open_for).find('.lb-content-body').prop('style')['border-style']);
        //$("#empty_container_border_size").val($(option_open_for).find('.lb-content-body').prop('style')['border-width'].split('px')[0]);
        var border_size = $(option_open_for).find('.lb-content-body').prop('style')['border-width'];
        $('#empty_container_border_size option[value="' + border_size + '"]').attr("selected", "selected");
        $("#empty_container_border_color").val(rgb2hex($(option_open_for).find('.lb-content-body').prop('style')['border-color']));

        //width
        $("input[name='empty_container_width']").val($(option_open_for).find('.lb-content-body').prop('style')['width'].split('%')[0]);
        $("input[name='empty_container_width']").prev().slider({
            value: $("input[name='empty_container_width']").val()
        });

        //padding
        $("input[name='empty_container_padding_top']").val($(option_open_for).find('.lb-content-body').prop('style')['padding-top'].split('px')[0]);
        $("input[name='empty_container_padding_top']").prev().slider({
            value: $("input[name='empty_container_padding_top']").val()
        });
        $("input[name='empty_container_padding_right']").val($(option_open_for).find('.lb-content-body').prop('style')['padding-right'].split('px')[0]);
        $("input[name='empty_container_padding_right']").prev().slider({
            value: $("input[name='empty_container_padding_right']").val()
        });
        $("input[name='empty_container_padding_bottom']").val($(option_open_for).find('.lb-content-body').prop('style')['padding-bottom'].split('px')[0]);
        $("input[name='empty_container_padding_bottom']").prev().slider({
            value: $("input[name='empty_container_padding_bottom']").val()
        });
        $("input[name='empty_container_padding_left']").val($(option_open_for).find('.lb-content-body').prop('style')['padding-left'].split('px')[0]);
        $("input[name='empty_container_text_padding_left']").prev().slider({
            value: $("input[name='empty_container_padding_left']").val()
        });

        //margin
        $("input[name='empty_container_text_margin_top']").val($(option_open_for).find('.lb-content-body').prop('style')['margin-top'].split('px')[0]);
        $("input[name='empty_container_text_margin_top']").prev().slider({
            value: $("input[name='empty_container_margin_top']").val()
        });
        $("input[name='empty_container_text_margin_right']").val($(option_open_for).find('.lb-content-body').prop('style')['margin-right'].split('px')[0]);
        $("input[name='empty_container_text_margin_right']").prev().slider({
            value: $("input[name='empty_container_margin_right']").val()
        });
        $("input[name='empty_container_text_margin_bottom']").val($(option_open_for).find('.lb-content-body').prop('style')['margin-bottom'].split('px')[0]);
        $("input[name='empty_container_text_margin_bottom']").prev().slider({
            value: $("input[name='empty_container_margin_bottom']").val()
        });
        $("input[name='empty_container_text_margin_left']").val($(option_open_for).find('.lb-content-body').prop('style')['margin-left'].split('px')[0]);
        $("input[name='empty_container_text_margin_left']").prev().slider({
            value: $("input[name='empty_container_margin_left']").val()
        });
    });


    //FAQ block setting
    $(document).on('click', '.open-faq-block-setings-modal', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        //alert($(option_open_for).find('.wrapper > b').html());

        $("#faq_question_text").val($(option_open_for).find('.wrapper .faq-block .faq-title-text > b').text());
        $('#faq_answar_text').summernote('code', $(option_open_for).find('.wrapper .faq-block .faq-answer').html());

        //if ( $(option_open_for).find('.wrapper > b').attr('style') != null )
        $("#faq_question_color").val(rgb2hex($(option_open_for).find('.wrapper .faq-title-text').css('color')));

        //if ( $(option_open_for).find('.wrapper > p').attr('style') != null )
        $("#headline_bg_color").val(rgb2hex($(option_open_for).find('.wrapper .faq-answer').css('color')));


        //size
        $("input[name='faq_question_size']").val($(option_open_for).find('.wrapper .faq-title').prop('style')['font-size'].split('px')[0]);
        $("input[name='faq_question_size']").prev().slider({
            value: $("input[name='faq_question_size']").val()
        });

        $("input[name='faq_answar_size']").val($(option_open_for).find('.wrapper .faq-answer').prop('style')['font-size'].split('px')[0]);
        $("input[name='faq_answar_size']").prev().slider({
            value: $("input[name='faq_answar_size']").val()
        });

        //line height
        if ($(option_open_for).find('.wrapper .faq-answer').prop('style')['line-height'].split('px')[0].length > 0)
            $("input[name='faq_answar_line_height']").val($(option_open_for).find('.wrapper .faq-answer').prop('style')['line-height'].split('px')[0]);
        else
            $("input[name='faq_answar_line_height']").val(DEFAULT_FAQ_ANSWAR_LINE_HEIGHT);
        $("input[name='faq_answar_line_height']").prev().slider({
            value: $("input[name='faq_answar_line_height']").val()
        });

        //padding
        $("input[name='faq_padding_top']").val($(option_open_for).find('.wrapper .faq-block').prop('style')['padding-top'].split('px')[0]);
        $("input[name='faq_padding_top']").prev().slider({
            value: $("input[name='faq_padding_top']").val()
        });
        $("input[name='faq_padding_right']").val($(option_open_for).find('.wrapper .faq-block').prop('style')['padding-right'].split('px')[0]);
        $("input[name='faq_padding_right']").prev().slider({
            value: $("input[name='faq_padding_right']").val()
        });
        $("input[name='faq_padding_bottom']").val($(option_open_for).find('.wrapper .faq-block').prop('style')['padding-bottom'].split('px')[0]);
        $("input[name='faq_padding_bottom']").prev().slider({
            value: $("input[name='faq_padding_bottom']").val()
        });
        $("input[name='faq_padding_left']").val($(option_open_for).find('.wrapper .faq-block').prop('style')['padding-left'].split('px')[0]);
        $("input[name='faq_padding_left']").prev().slider({
            value: $("input[name='faq_padding_left']").val()
        });

        //margin
        $("input[name='faq_margin_top']").val($(option_open_for).find('.wrapper .faq-block').parent().prop('style')['margin-top'].split('px')[0]);
        $("input[name='faq_margin_top']").prev().slider({
            value: $("input[name='faq_margin_top']").val()
        });
        $("input[name='faq_margin_right']").val($(option_open_for).find('.wrapper .faq-block').parent().prop('style')['margin-right'].split('px')[0]);
        $("input[name='faq_margin_right']").prev().slider({
            value: $("input[name='faq_margin_right']").val()
        });
        $("input[name='faq_margin_bottom']").val($(option_open_for).find('.wrapper .faq-block').parent().prop('style')['margin-bottom'].split('px')[0]);
        $("input[name='faq_margin_bottom']").prev().slider({
            value: $("input[name='faq_margin_bottom']").val()
        });
        $("input[name='faq_margin_left']").val($(option_open_for).find('.wrapper .faq-block').parent().prop('style')['margin-left'].split('px')[0]);
        $("input[name='faq_margin_left']").prev().slider({
            value: $("input[name='faq_margin_left']").val()
        });

    });


    //Advance Button block setting
    /*$(document).on('click', '.open-advance-button-setings-modal', function(e) {

                option_open_for = $(this).parent().parent().parent();
                settingsOpenModal = $(this).attr('data-target');

                const element_products = $("#advance_button_add_product");

                //load products based on the funnel type
                $.ajax({
                    type: 'get',
                    url: $("#hid_base_url").val() + '/funnels/' + $("#hid_funnel_id").val() + '/load-products/',
                    data: '_token=' + $("#csrf_token").val() + '&step_id=' + $("#hid_funnel_step_id").val() + '&page_id=' + $("#hid_page_id").val(),
                    beforeSend: function() {
                        $(element_products).after('<span id="product_loading">loading...</span>');
                    },
                    success: function(response) {
                        //console.log(response);
                        $("#product_loading").remove();

                        var json = JSON.parse(response);

                        if ( json.status == 'success' ) {
                            $(element_products).html(json.html);
                            $(element_products).trigger('change');
                        }
                    },
                    error: function(a, b) {
                        //console.log(a.responseText);
                    }
                });



                //text
                //var btn_text = $(option_open_for).find('.wrapper > button').html().split("<p>");
                $("#advance_button_text").val($(option_open_for).find('.wrapper > button > span').text());
                $("#advance_button_secondary_text").val($(option_open_for).find('.wrapper > button > p').text());

                //type
                var type = $(option_open_for).find('.wrapper > a').attr('data-button-type');
                if ( type == '' ) {
                    $('#advance_button_type option[value=""]').attr("selected", "selected");
                } else if (type == 'full') {
                    $('#advance_button_type option[value="full"]').attr("selected", "selected");
                } else if (type == 'large') {
                    $('#advance_button_type option[value="large"]').attr("selected", "selected");
                } else if (type == 'full_large') {
                    $('#advance_button_type option[value="full_large"]').attr("selected", "selected");
                }

                //style
                var style = $(option_open_for).find('.wrapper > button').attr('data-button-style');
                $('#advance_button_style option[value="' + style + '"]').attr("selected", "selected");

                //Font size
                //alert($(option_open_for).find('.wrapper a').prop('style')['font-size'].split('px')[0]);
                //$("#advance_button_font_size").val($(option_open_for).find('.wrapper > a').css('font-size'));

                $("input[name='advance_button_font_size']").val($(option_open_for).find('.wrapper > button').prop('style')['font-size'].split('px')[0]);
                $("input[name='advance_button_font_size']").prev().slider({value: $("input[name='advance_button_font_size']").val()});

                //padding
                //$("#button_padding_top").val($(option_open_for).find('.wrapper > a').css('padding-top'));
                //$("#button_padding_bottom").val($(option_open_for).find('.wrapper > a').css('padding-bottom'));



                //padding
                $("input[name='advance_button_padding_top']").val($(option_open_for).find('.wrapper > button').prop('style')['padding-top'].split('px')[0]);
                $("input[name='advance_button_padding_top']").prev().slider({value: $("input[name='advance_button_padding_top']").val()});
                $("input[name='advance_button_padding_right']").val($(option_open_for).find('.wrapper > button').prop('style')['padding-right'].split('px')[0]);
                $("input[name='advance_button_padding_right']").prev().slider({value: $("input[name='advance_button_padding_right']").val()});
                $("input[name='advance_button_padding_bottom']").val($(option_open_for).find('.wrapper > button').prop('style')['padding-bottom'].split('px')[0]);
                $("input[name='advance_button_padding_bottom']").prev().slider({value: $("input[name='advance_button_padding_bottom']").val()});
                $("input[name='advance_button_padding_left']").val($(option_open_for).find('.wrapper > button').prop('style')['padding-left'].split('px')[0]);
                $("input[name='advance_button_padding_left']").prev().slider({value: $("input[name='advance_button_padding_left']").val()});

                //margin
                $("input[name='advance_button_margin_top']").val($(option_open_for).find('.wrapper > button').prop('style')['margin-top'].split('px')[0]);
                $("input[name='advance_button_margin_top']").prev().slider({value: $("input[name='advance_button_margin_top']").val()});
                $("input[name='advance_button_margin_right']").val($(option_open_for).find('.wrapper > button').prop('style')['margin-right'].split('px')[0]);
                $("input[name='advance_button_margin_right']").prev().slider({value: $("input[name='advance_button_margin_right']").val()});
                $("input[name='advance_button_margin_bottom']").val($(option_open_for).find('.wrapper > button').prop('style')['margin-bottom'].split('px')[0]);
                $("input[name='advance_button_margin_bottom']").prev().slider({value: $("input[name='advance_button_margin_bottom']").val()});
                $("input[name='advance_button_margin_left']").val($(option_open_for).find('.wrapper > button').prop('style')['margin-left'].split('px')[0]);
                $("input[name='advance_button_margin_left']").prev().slider({value: $("input[name='advance_button_margin_left']").val()});



                //text color
                $("#advance_button_text_color").val(rgb2hex($(option_open_for).find('.wrapper > button').css('color')));

                //bg color
                $("#advance_button_bg_color").val(rgb2hex($(option_open_for).find('.wrapper > button').css('background-color')));
    });*/


    //PRODUCT ADD
    /*var product_block_button;
    $(document).on('click', '.open-product-add-setings-modal', function(e) {

                option_open_for = $(this).parent().parent().parent();
                settingsOpenModal = $(this).attr('data-target');
                product_block_button = $(this).find('.coupon-button');

                const element_products = $("#product_add_product");

                //load products based on the funnel type
                $.ajax({
                    type: 'get',
                    url: 'https://cartumo.io/funnels/' + $("#hid_funnel_id").val() + '/load-products/',
                    data: '_token=' + $("#csrf_token").val() + '&step_id=' + $("#hid_funnel_step_id").val() + '&page_id=' + $("#hid_page_id").val(),
                    beforeSend: function() {
                        $(element_products).after('<span id="product_loading">loading...</span>');
                    },
                    success: function(response) {
                        //console.log(response);
                        $("#product_loading").remove();

                        var json = JSON.parse(response);

                        if ( json.status == 'success' ) {
                            $(element_products).html(json.html);
                            $(element_products).trigger('change');
                        }
                    },
                    error: function(a, b) {
                        //console.log(a.responseText);
                    }
                });


                //texts
                $("#product_add_header_text").val($(option_open_for).find('.wrapper .coupon-container .coupon-banner > p').text());
                $("#product_add_recomonded_text").val($(option_open_for).find('.wrapper .coupon-container .recommended').text());
                $("#product_add_regular_price").val($(option_open_for).find('.wrapper .coupon-container .reg-p > p').text());
                $("#product_add_instant_saving").val($(option_open_for).find('.wrapper .coupon-container .save-p > p').text());
                $("#product_add_short_info").val($(option_open_for).find('.wrapper .coupon-container .sticker > p').text());
                $("#product_add_price").val($(option_open_for).find('.wrapper .coupon-container .price-amount').text());
                $("#product_add_info_with_price").val($(option_open_for).find('.wrapper .coupon-container .price-heading').text());
                $("#product_add_button_text").val($(option_open_for).find('.wrapper .coupon-container .coupon-button').text());

                //Color
                $("#product_add_text_color").val($(option_open_for).find('.wrapper .coupon-banner').prop('style')['color']);
                $("#product_add_bg_color").val($(option_open_for).find('.wrapper .coupon-banner').prop('style')['background-color']);
                $("#product_add_saving_color").val($(option_open_for).find('.wrapper .save-p').prop('style')['color']);
                $("#product_add_button_text_color").val($(option_open_for).find('.wrapper .coupon-button').prop('style')['color']);
                $("#product_add_button_bg_color").val($(option_open_for).find('.wrapper .coupon-button').prop('style')['background-color']);


                //padding
                $("input[name='product_add_padding_top']").val($(option_open_for).find('.hamburger-menu').prop('style')['padding-top'].split('px')[0]);
                $("input[name='product_add_padding_top']").prev().slider({value: $("input[name='product_add_padding_top']").val()});
                $("input[name='product_add_padding_right']").val($(option_open_for).find('.hamburger-menu').prop('style')['padding-right'].split('px')[0]);
                $("input[name='product_add_padding_right']").prev().slider({value: $("input[name='product_add_padding_right']").val()});
                $("input[name='product_add_padding_bottom']").val($(option_open_for).find('.hamburger-menu').prop('style')['padding-bottom'].split('px')[0]);
                $("input[name='product_add_padding_bottom']").prev().slider({value: $("input[name='product_add_padding_bottom']").val()});
                $("input[name='product_add_padding_left']").val($(option_open_for).find('.hamburger-menu').prop('style')['padding-left'].split('px')[0]);
                $("input[name='product_add_padding_left']").prev().slider({value: $("input[name='product_add_padding_left']").val()});

                //margin
                $("input[name='product_add_margin_top']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
                $("input[name='product_add_margin_top']").prev().slider({value: $("input[name='product_add_margin_top']").val()});
                $("input[name='product_add_margin_right']").val($(option_open_for).find('.wrapper').prop('style')['margin-right'].split('px')[0]);
                $("input[name='product_add_margin_right']").prev().slider({value: $("input[name='product_add_margin_right']").val()});
                $("input[name='product_add_margin_bottom']").val($(option_open_for).find('.wrapper').prop('style')['margin-bottom'].split('px')[0]);
                $("input[name='product_add_margin_bottom']").prev().slider({value: $("input[name='product_add_margin_bottom']").val()});
                $("input[name='product_add_margin_left']").val($(option_open_for).find('.wrapper').prop('style')['margin-left'].split('px')[0]);
                $("input[name='product_add_margin_left']").prev().slider({value: $("input[name='product_add_margin_left']").val()});
    });*/

    //////////////////////
    $(document).on('change', '#product_add_product, #advance_button_add_product', function (e) {

        //var element_container = $("#product_add_variant_container");
        var element_container = $(this).parent().parent().next();

        //console.log($("#hid_base_url").val() + '/product/' + $(this).val() + '/variant/details');

        $.ajax({
            type: 'POST',
            url: $("#hid_base_url").val() + '/funnels/' + $("#hid_funnel_id").val() + '/product/' + $(this).val() + '/variants',
            data: '_token=' + $("#csrf_token").val() + '&step_id=' + $("#hid_funnel_step_id").val() + '&page_id=' + $("#hid_page_id").val(),
            beforeSend: function () {
                //$(element_products).after('<span id="product_loading">loading...</span>');
            },
            success: function (response) {
                //console.log(response);

                var json = JSON.parse(response);

                if (json.status == 'success') {
                    $(element_container).html(json.html);
                    //$(element_container).find('.option-items:first-child select').trigger('change');
                    $(element_container).find('#product_quantity').trigger('change');
                }

            },
            error: function (a, b) {
                //console.log(a);
            }
        });
    });


    //////////////////////////////////////////////
    // Product varients change option
    $(document).on("change", "#product_add_variant_container select, #advance_button_variant_container select", function (e) {

        e.preventDefault();

        /*var style = $(".element-product-varients .option-item:nth-child(1) select").val();
        var size = $(".element-product-varients .option-item:nth-child(2) select").val();
        var color = $(".element-product-varients .option-item:nth-child(3) select").val();*/

        var data = "";
        var title = "";
        var data_element = $(this);

        /*$("#product_add_variant_container .option-items").each(function(index, element) {

            var data_name = $(element).find("select").attr('name');
            var data_value = $(element).find("select").val();

            data += "&" + data_name + "=" + data_value;
            title += data_value + ',';
        });*/

        $(this).parent().parent().parent().find('.option-items').each(function (index, element) {

            var data_name = $(element).find("select").attr('name');
            var data_value = $(element).find("select").val();

            data += "&" + data_name + "=" + data_value;
            title += data_value + ',';
        });

        //alert(data);

        title = title.substr(0, title.length - 1);

        var quantity = $("#product_quantity").val();
        //var product_id = $("#product_add_product").val();
        var product_id = $(this).parent().parent().parent().parent().prev().find('select').val();

        //alert($("#hid_base_url").val() + '/product/varient-image/' + $("#product").val());
        ////console.log($("#hid_base_url").val() + '/product/varient-image/' + $("#product").val());

        $.ajax({
            type: 'POST',
            url: $("#hid_base_url").val() + "/product/" + product_id + "/variant/details",
            //data: '_token=' + $("#csrf_token").val() + '&style=' + style + '&size=' + size + '&color=' + color + '&quantity=' + quantity + '&step_id=' + $("#hid_funnel_step_id").val(),
            data: '_token=' + $("#csrf_token").val() + '&data=' + data + '&title=' + title + '&quantity=' + quantity + '&funnel_id=' + $("#hid_funnel_id").val() + '&user_id=' + $("#frm_hid_user_id").val(),
            beforeSend: function () {
                $(data_element).after('<span id="product_loading">loadings...</span>');
            },
            success: function (response) {
                //console.log(response);

                $('#product_loading').remove();

                var json = JSON.parse(response);

                if (json.status == 'success') {

                    //$(product_block_button).find("#hid_product_variant_id").remove();
                    //$(product_block_button).find("#hid_product_price").remove();

                    $("#hid_product_variant_id").remove();
                    $("#hid_product_price").remove();

                    $(data_element).after('<input name="hid_product_variant_id" id="hid_product_variant_id" value="' + json.variant_id + '" type="hidden">');
                    $(data_element).after('<input name="hid_product_price" id="hid_product_price" value="' + json.price[0] + '" type="hidden">');
                }
            },
            error: function (a, b) {
                //console.log(a.responseText);
            }
        });
    });


    //MENU
    $(document).on('click', '.open-menu-setings-modal', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        //action
        var align = $(option_open_for).find('.wrapper .hamburger-menu').prop('style')['text-align'];
        $('#menu_setting_align option[value="' + align + '"]').attr("selected", "selected");

        //behaviour
        /*var behaviour = $(option_open_for).find('.wrapper .hamburger-menu').attr('data-menu-behaviour');
        $('#menu_settings_behaviour option[value="' + behaviour + '"]').attr("selected", "selected");

        if ( behaviour == 'goto_section' ) {
            $("#menu_settings_scroll_to_section").show();
            $("#menu_settings_scroll_to_section > #menu_settings_section_id").val($(option_open_for).find('.wrapper .hamburger-menu').attr('data-scroll-to-section'));
        }*/

        $(".menu_add_container").html('');
        $(".hamburger-menu > ul > li").each(function (index, element) {

            const title = $(element).find('a').text();
            const href = $(element).find('a').attr('href');
            const target = $(element).find('a').attr('target');

            var html = '<div class="panels"><div class="form-group"><label class="control-label col-sm-3" for="menu_settings_title">Menu Title:</label><div class="col-sm-9"><input type="text" class="form-control" name="menu_title[]" placeholder="Enter menu title" value="' + title + '"/></div></div>';
            html += '<div class="form-group"><label class="control-label col-sm-3" for="menu_settings_link">Menu Link:</label><div class="col-sm-9"><input type="text" class="form-control" name="menu_links[]" placeholder="Enter menu link" value="' + href + '"/></div></div>';
            html += '<div class="form-group"><label class="control-label col-sm-3" for="image_text_setting_align">Menu Target:</label><div class="col-sm-9"><select name="image_text_setting_align" value="' + target + '" class="form-control"><option value="">Same Tab</option><option value="_blank"> Next tab</option></select></div></div> <hr />';

            $(".menu_add_container").append(html);
        });


        //Color
        $("#menu_item_color").val($(option_open_for).find('.wrapper .hamburger-menu a').prop('style')['color']);
        $("#menu_item_bg_color").val($(option_open_for).find('.wrapper .hamburger-menu').prop('style')['background-color']);

        //Font
        $("input[name='menu_items_font_size']").val($(option_open_for).find('.wrapper .hamburger-menu a').prop('style')['font-size'].split('px')[0]);
        $("input[name='menu_items_font_size']").prev().slider({
            value: $("input[name='menu_items_font_size']").val()
        });

        //padding
        $("input[name='menu_setting_padding_top']").val($(option_open_for).find('.hamburger-menu').prop('style')['padding-top'].split('px')[0]);
        $("input[name='menu_setting_padding_top']").prev().slider({
            value: $("input[name='menu_setting_padding_top']").val()
        });
        $("input[name='menu_setting_padding_right']").val($(option_open_for).find('.hamburger-menu').prop('style')['padding-right'].split('px')[0]);
        $("input[name='menu_setting_padding_right']").prev().slider({
            value: $("input[name='menu_setting_padding_right']").val()
        });
        $("input[name='menu_setting_padding_bottom']").val($(option_open_for).find('.hamburger-menu').prop('style')['padding-bottom'].split('px')[0]);
        $("input[name='menu_setting_padding_bottom']").prev().slider({
            value: $("input[name='menu_setting_padding_bottom']").val()
        });
        $("input[name='menu_setting_padding_left']").val($(option_open_for).find('.hamburger-menu').prop('style')['padding-left'].split('px')[0]);
        $("input[name='menu_setting_padding_left']").prev().slider({
            value: $("input[name='menu_setting_padding_left']").val()
        });

        //margin
        $("input[name='menu_setting_margin_top']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='menu_setting_margin_top']").prev().slider({
            value: $("input[name='menu_setting_margin_top']").val()
        });
        $("input[name='menu_setting_margin_right']").val($(option_open_for).find('.wrapper').prop('style')['margin-right'].split('px')[0]);
        $("input[name='menu_setting_margin_right']").prev().slider({
            value: $("input[name='menu_setting_margin_right']").val()
        });
        $("input[name='menu_setting_margin_bottom']").val($(option_open_for).find('.wrapper').prop('style')['margin-bottom'].split('px')[0]);
        $("input[name='menu_setting_margin_bottom']").prev().slider({
            value: $("input[name='menu_setting_margin_bottom']").val()
        });
        $("input[name='menu_setting_margin_left']").val($(option_open_for).find('.wrapper').prop('style')['margin-left'].split('px')[0]);
        $("input[name='menu_setting_margin_left']").prev().slider({
            value: $("input[name='menu_setting_margin_left']").val()
        });
    });


    //IMAGE TEXT
    $(document).on('click', '.open-image-text-block-setings-modal', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        //action
        var align = $(option_open_for).find('.wrapper .how-text').prop('style')['text-align'];

        $('#image_text_setting_align option[value="' + align + '"]').attr("selected", "selected");


        ///////////
        //alert($('.wrapper .section-title > strong').text());
        $("#image_text_headline_text").val($(option_open_for).find('.wrapper .how-text > h4').text());
        $("#image_text_sub_headline_text").val($(option_open_for).find('.wrapper .how-text > p').text());

        //
        $("#image_text_image_path").val($(option_open_for).find('.wrapper .how-image img').attr('src'));

        //Color
        $("#image_text_headline_text_color").val($(option_open_for).find('.wrapper .how-text > h4').prop('style')['color']);
        $("#image_text_sub_headline_text_color").val($(option_open_for).find('.wrapper .how-text > p').prop('style')['color']);

        //Font
        $("input[name='image_text_headline_font_size']").val($(option_open_for).find('.wrapper .how-text > h4').prop('style')['font-size'].split('px')[0]);
        $("input[name='image_text_headline_font_size']").prev().slider({
            value: $("input[name='image_text_headline_font_size']").val()
        });

        $("input[name='image_text_sub_headline_font_size']").val($(option_open_for).find('.wrapper .how-text > p').prop('style')['font-size'].split('px')[0]);
        $("input[name='image_text_sub_headline_font_size']").prev().slider({
            value: $("input[name='image_text_sub_headline_font_size']").val()
        });

        //padding
        $("input[name='image_text_padding_top']").val($(option_open_for).find('.how-single').prop('style')['padding-top'].split('px')[0]);
        $("input[name='image_text_padding_top']").prev().slider({
            value: $("input[name='image_text_padding_top']").val()
        });
        $("input[name='image_text_padding_right']").val($(option_open_for).find('.how-single').prop('style')['padding-right'].split('px')[0]);
        $("input[name='image_text_padding_right']").prev().slider({
            value: $("input[name='image_text_padding_right']").val()
        });
        $("input[name='image_text_padding_bottom']").val($(option_open_for).find('.how-single').prop('style')['padding-bottom'].split('px')[0]);
        $("input[name='image_text_padding_bottom']").prev().slider({
            value: $("input[name='image_text_padding_bottom']").val()
        });
        $("input[name='image_text_padding_left']").val($(option_open_for).find('.how-single').prop('style')['padding-left'].split('px')[0]);
        $("input[name='image_text_padding_left']").prev().slider({
            value: $("input[name='image_text_padding_left']").val()
        });

        //margin
        $("input[name='image_text_margin_top']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='image_text_margin_top']").prev().slider({
            value: $("input[name='image_text_margin_top']").val()
        });
        $("input[name='image_text_margin_right']").val($(option_open_for).find('.wrapper').prop('style')['margin-right'].split('px')[0]);
        $("input[name='image_text_margin_right']").prev().slider({
            value: $("input[name='image_text_margin_right']").val()
        });
        $("input[name='image_text_margin_bottom']").val($(option_open_for).find('.wrapper').prop('style')['margin-bottom'].split('px')[0]);
        $("input[name='image_text_margin_bottom']").prev().slider({
            value: $("input[name='image_text_margin_bottom']").val()
        });
        $("input[name='image_text_margin_left']").val($(option_open_for).find('.wrapper').prop('style')['margin-left'].split('px')[0]);
        $("input[name='image_text_margin_left']").prev().slider({
            value: $("input[name='image_text_margin_left']").val()
        });
    });


    //TESTIMONIAL
    $(document).on('click', '.open-testimonial-setings-modal', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        //action
        var align = $(option_open_for).find('.wrapper').prop('style')['text-align'];

        $('#open-testimonial-setings-modal option[value="' + align + '"]').attr("selected", "selected");


        ///////////
        //alert($('.wrapper .section-title > strong').text());
        $("#testimonial_text").val($(option_open_for).find('.wrapper .testimonial-text > p').text());
        $("#testimonial_customer_name_text").val($(option_open_for).find('.wrapper .testimonial-details > .name').text());
        $("#testimonial_customer_place_text").val($(option_open_for).find('.wrapper .testimonial-details > .location').text());
        $("#testimonial_customer_rating").val($(option_open_for).find('.wrapper .rating > i').length);

        $("#testimonial_text_color").val($(option_open_for).find('.wrapper .testimonial-text > p').prop('style')['color']);
        $("#testimonial_customer_name_color").val($(option_open_for).find('.wrapper .testimonial-details > .name').prop('style')['color']);
        $("#testimonial_rating_color").val($(option_open_for).find('.wrapper .rating > i').prop('style')['color']);
        $("#testimonial_bg_color").val($(option_open_for).find('.wrapper .testimonial-single').prop('style')['background-color']);


        //
        $("#testimonial_image_path").val($(option_open_for).find('.wrapper > .testimonial-single .profile > img').attr('src'));

        //Font
        $("input[name='testimonial_font_size']").val($(option_open_for).find('.wrapper').prop('style')['font-size'].split('px')[0]);
        $("input[name='testimonial_font_size']").prev().slider({
            value: $("input[name='testimonial_font_size']").val()
        });

        //padding
        $("input[name='testimonial_padding_top']").val($(option_open_for).find('.testimonial-single').prop('style')['padding-top'].split('px')[0]);
        $("input[name='testimonial_padding_top']").prev().slider({
            value: $("input[name='testimonial_padding_top']").val()
        });
        $("input[name='testimonial_padding_right']").val($(option_open_for).find('.testimonial-single').prop('style')['padding-right'].split('px')[0]);
        $("input[name='testimonial_padding_right']").prev().slider({
            value: $("input[name='testimonial_padding_right']").val()
        });
        $("input[name='testimonial_padding_bottom']").val($(option_open_for).find('.testimonial-single').prop('style')['padding-bottom'].split('px')[0]);
        $("input[name='testimonial_padding_bottom']").prev().slider({
            value: $("input[name='testimonial_padding_bottom']").val()
        });
        $("input[name='testimonial_padding_left']").val($(option_open_for).find('.testimonial-single').prop('style')['padding-left'].split('px')[0]);
        $("input[name='testimonial_padding_left']").prev().slider({
            value: $("input[name='testimonial_padding_left']").val()
        });

        //margin
        $("input[name='testimonial_margin_top']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='testimonial_margin_top']").prev().slider({
            value: $("input[name='testimonial_margin_top']").val()
        });
        $("input[name='testimonial_margin_right']").val($(option_open_for).find('.wrapper').prop('style')['margin-right'].split('px')[0]);
        $("input[name='testimonial_margin_right']").prev().slider({
            value: $("input[name='testimonial_margin_right']").val()
        });
        $("input[name='testimonial_margin_bottom']").val($(option_open_for).find('.wrapper').prop('style')['margin-bottom'].split('px')[0]);
        $("input[name='testimonial_margin_bottom']").prev().slider({
            value: $("input[name='testimonial_margin_bottom']").val()
        });
        $("input[name='testimonial_margin_left']").val($(option_open_for).find('.wrapper').prop('style')['margin-left'].split('px')[0]);
        $("input[name='testimonial_margin_left']").prev().slider({
            value: $("input[name='testimonial_margin_left']").val()
        });
    });


    //COUPON SYSTEM
    $(document).on('click', '.open-coupon-system-setings-modal', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        //action
        var align = $(option_open_for).find('.wrapper .section-title').prop('style')['text-align'];

        //alert(align);

        if (align == '' || align == 'left') {
            $('#coupon_system_headline_alignment option[value="left"]').attr("selected", "selected");
        } else if (align == 'center') {
            $('#coupon_system_headline_alignment option[value="center"]').attr("selected", "selected");
        } else if (align == 'right') {
            $('#coupon_system_headline_alignment option[value="right"]').attr("selected", "selected");
        }

        //alert($('.order-bump-wrapper .element-bump-info ul > li:last-child').prop('style')['font-size']);


        ///////////
        //alert($('.wrapper .section-title > strong').text());
        $("#coupon_system_headline_text").val($(option_open_for).find('.wrapper .section-title > strong').text());
        $("#coupon_system_button_text").val($(option_open_for).find('.wrapper .panels button').text());

        $("#coupon_system_text_color").val($(option_open_for).find('.wrapper .coupon-system-form-panel').prop('style')['color']);
        $("#coupon_system_bg_color").val($(option_open_for).find('.wrapper .coupon-system-form-panel').prop('style')['background-color']);
        $("#coupon_system_text_color").val($(option_open_for).find('.wrapper .panels button').prop('style')['color']);
        $("#coupon_system_bg_color").val($(option_open_for).find('.wrapper .panels button').prop('style')['background-color']);


        //padding
        $("input[name='coupon_system_padding_top']").val($(option_open_for).find('.coupon-system-form-panel').prop('style')['padding-top'].split('px')[0]);
        $("input[name='coupon_system_padding_top']").prev().slider({
            value: $("input[name='coupon_system_padding_top']").val()
        });
        $("input[name='coupon_system_padding_right']").val($(option_open_for).find('.coupon-system-form-panel').prop('style')['padding-right'].split('px')[0]);
        $("input[name='coupon_system_padding_right']").prev().slider({
            value: $("input[name='coupon_system_padding_right']").val()
        });
        $("input[name='coupon_system_padding_bottom']").val($(option_open_for).find('.coupon-system-form-panel').prop('style')['padding-bottom'].split('px')[0]);
        $("input[name='coupon_system_padding_bottom']").prev().slider({
            value: $("input[name='coupon_system_padding_bottom']").val()
        });
        $("input[name='coupon_system_padding_left']").val($(option_open_for).find('.coupon-system-form-panel').prop('style')['padding-left'].split('px')[0]);
        $("input[name='coupon_system_padding_left']").prev().slider({
            value: $("input[name='coupon_system_padding_left']").val()
        });

        //margin
        $("input[name='coupon_system_margin_top']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='coupon_system_margin_top']").prev().slider({
            value: $("input[name='coupon_system_margin_top']").val()
        });
        $("input[name='coupon_system_margin_right']").val($(option_open_for).find('.wrapper').prop('style')['margin-right'].split('px')[0]);
        $("input[name='coupon_system_margin_right']").prev().slider({
            value: $("input[name='coupon_system_margin_right']").val()
        });
        $("input[name='coupon_system_margin_bottom']").val($(option_open_for).find('.wrapper').prop('style')['margin-bottom'].split('px')[0]);
        $("input[name='coupon_system_margin_bottom']").prev().slider({
            value: $("input[name='coupon_system_margin_bottom']").val()
        });
        $("input[name='coupon_system_margin_left']").val($(option_open_for).find('.wrapper').prop('style')['margin-left'].split('px')[0]);
        $("input[name='coupon_system_margin_left']").prev().slider({
            value: $("input[name='coupon_system_margin_left']").val()
        });
    });


    //SHIPPING METHODS
    $(document).on('click', '.open-shipping-method-setings-modal', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        //action
        var align = $(option_open_for).find('.wrapper .section-title').prop('style')['text-align'];

        //alert(align);

        if (align == '' || align == 'left') {
            $('#shipping_method_headline_alignment option[value="left"]').attr("selected", "selected");
        } else if (align == 'center') {
            $('#shipping_method_headline_alignment option[value="center"]').attr("selected", "selected");
        } else if (align == 'right') {
            $('#shipping_method_headline_alignment option[value="right"]').attr("selected", "selected");
        }

        //alert($('.order-bump-wrapper .element-bump-info ul > li:last-child').prop('style')['font-size']);


        ///////////
        //alert($('.wrapper .section-title > strong').text());
        $("#shipping_method_headline_text").val($(option_open_for).find('.wrapper .section-title > strong').text());

        $("#shipping_method_text_color").val($(option_open_for).find('.wrapper .panels > .body').prop('style')['color']);
        $("#shipping_method_bg_color").val($(option_open_for).find('.wrapper .panels > .body').prop('style')['background-color']);


        //padding
        $("input[name='shipping_method_padding_top']").val($(option_open_for).find('.wrapper > .shipping-method-form-panel').prop('style')['padding-top'].split('px')[0]);
        $("input[name='shipping_method_padding_top']").prev().slider({
            value: $("input[name='shipping_method_padding_top']").val()
        });
        $("input[name='shipping_method_padding_right']").val($(option_open_for).find('.wrapper > .shipping-method-form-panel').prop('style')['padding-right'].split('px')[0]);
        $("input[name='shipping_method_padding_right']").prev().slider({
            value: $("input[name='shipping_method_padding_right']").val()
        });
        $("input[name='shipping_method_padding_bottom']").val($(option_open_for).find('.wrapper > .shipping-method-form-panel').prop('style')['padding-bottom'].split('px')[0]);
        $("input[name='shipping_method_padding_bottom']").prev().slider({
            value: $("input[name='shipping_method_padding_bottom']").val()
        });
        $("input[name='shipping_method_padding_left']").val($(option_open_for).find('.wrapper > .shipping-method-form-panel').prop('style')['padding-left'].split('px')[0]);
        $("input[name='shipping_method_padding_left']").prev().slider({
            value: $("input[name='shipping_method_padding_left']").val()
        });

        //margin
        $("input[name='shipping_method_margin_top']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='shipping_method_margin_top']").prev().slider({
            value: $("input[name='shipping_method_margin_top']").val()
        });
        $("input[name='shipping_method_margin_right']").val($(option_open_for).find('.wrapper').prop('style')['margin-right'].split('px')[0]);
        $("input[name='shipping_method_margin_right']").prev().slider({
            value: $("input[name='shipping_method_margin_right']").val()
        });
        $("input[name='shipping_method_margin_bottom']").val($(option_open_for).find('.wrapper').prop('style')['margin-bottom'].split('px')[0]);
        $("input[name='shipping_method_margin_bottom']").prev().slider({
            value: $("input[name='shipping_method_margin_bottom']").val()
        });
        $("input[name='shipping_method_margin_left']").val($(option_open_for).find('.wrapper').prop('style')['margin-left'].split('px')[0]);
        $("input[name='shipping_method_margin_left']").prev().slider({
            value: $("input[name='shipping_method_margin_left']").val()
        });
    });


    //ORDER BUMP
    $(document).on('click', '.open-order-bump-settings-modal', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        //action
        var align = $(option_open_for).find('.wrapper > .order-for-bump').prop('style')['text-align'];

        if (align == '') {
            $('#order_info_setting_align option[value="center"]').attr("selected", "selected");
        } else if (align == 'left') {
            $('#order_info_setting_align option[value="left"]').attr("selected", "selected");
        } else if (align == 'right') {
            $('#order_info_setting_align option[value="right"]').attr("selected", "selected");
        }

        //alert($('.order-bump-wrapper .element-bump-info ul > li:last-child').prop('style')['font-size']);


        ///////////
        $("#order_bump_headline").val($('.wrapper .order-for-bump ul > li:last-child > b').text());
        $("#order_bump_oto_headline").val($('.wrapper .bump-details > span:first-child').text());
        $("#order_bump_oto_text").val($('.wrapper .bump-details > span:last-child').text());

        $("input[name='order_bump_headline_font_size']").val($('.order-bump-wrapper .element-bump-info ul > li:last-child').prop('style')['font-size'].split('px')[0]);
        $("input[name='order_bump_headline_font_size']").prev().slider({
            value: $("input[name='order_bump_headline_font_size']").val()
        });
        $("input[name='order_bump_text_font_size']").val($('.order-bump-wrapper .element-bump-info .bump-details > span:first-child').prop('style')['font-size'].split('px')[0]);
        $("input[name='order_bump_text_font_size']").prev().slider({
            value: $("input[name='order_bump_text_font_size']").val()
        });

        $("#order_bump_headline_color").val(rgb2hex($('.order-bump-wrapper .element-bump-info ul > li:last-child').prop('style')['color']));
        $("#order_bump_text_color").val(rgb2hex($('.order-bump-wrapper .element-bump-info .bump-details > span:last-child').prop('style')['color']));
        $("#order_bump_headline_bg").val(rgb2hex($('.order-bump-wrapper .element-bump-info ul').prop('style')['background-color']));
        $("#order_bump_background").val(rgb2hex($('.order-bump-wrapper .element-bump-info').prop('style')['background-color']));


        //padding
        $("input[name='order_bump_padding_top']").val(($(option_open_for).find('.wrapper').prop('style')['padding-top']) ? $(option_open_for).find('.wrapper').prop('style')['padding-top'].split('px')[0] : 0);
        $("input[name='order_bump_padding_top']").prev().slider({
            value: $("input[name='order_bump_padding_top']").val()
        });
        $("input[name='order_bump_padding_right']").val(($(option_open_for).find('.wrapper').prop('style')['padding-right']) ? $(option_open_for).find('.wrapper').prop('style')['padding-right'].split('px')[0] : 0);
        $("input[name='order_bump_padding_right']").prev().slider({
            value: $("input[name='order_bump_padding_right']").val()
        });
        $("input[name='order_bump_padding_bottom']").val(($(option_open_for).find('.wrapper').prop('style')['padding-bottom']) ? $(option_open_for).find('.wrapper').prop('style')['padding-bottom'].split('px')[0] : 0);
        $("input[name='order_bump_padding_bottom']").prev().slider({
            value: $("input[name='order_bump_padding_bottom']").val()
        });
        $("input[name='order_bump_padding_left']").val(($(option_open_for).find('.wrapper').prop('style')['padding-left']) ? $(option_open_for).find('.wrapper').prop('style')['padding-left'].split('px')[0] : 0);
        $("input[name='order_bump_padding_left']").prev().slider({
            value: $("input[name='order_bump_padding_left']").val()
        });

        //margin
        //alert($(option_open_for).find('.element-bump-info').prop('style')['margin-left'].split('px')[0]);
        $("input[name='order_bump_margin_top']").val($(option_open_for).find('.element-bump-info').prop('style')['margin-top'].split('px')[0]);
        $("input[name='order_bump_margin_top']").prev().slider({
            value: $("input[name='order_bump_margin_top']").val()
        });
        $("input[name='order_bump_margin_right']").val($(option_open_for).find('.element-bump-info').prop('style')['margin-right'].split('px')[0]);
        $("input[name='order_bump_margin_right']").prev().slider({
            value: $("input[name='order_bump_margin_right']").val()
        });
        $("input[name='order_bump_margin_bottom']").val($(option_open_for).find('.element-bump-info').prop('style')['margin-bottom'].split('px')[0]);
        $("input[name='order_bump_margin_bottom']").prev().slider({
            value: $("input[name='order_bump_margin_bottom']").val()
        });
        $("input[name='order_bump_margin_left']").val(eval($(option_open_for).find('.element-bump-info').prop('style')['margin-left'].split('px')[0]));
        $("input[name='order_bump_margin_left']").prev().slider({
            value: $("input[name='order_bump_margin_left']").val()
        });
    });


    //CARd DETAILS FORM
    $(document).on('click', '.open-card-details-setings-modal', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        $("#card_details_form_caption_text").val($(option_open_for).find('.wrapper .step-parts > .step-caption span:last-child').text());

        //padding
        $("input[name='card_details_form_form_padding_top']").val(($(option_open_for).find('.wrapper').prop('style')['padding-top']) ? $(option_open_for).find('.wrapper').prop('style')['padding-top'].split('px')[0] : 0);
        $("input[name='card_details_form_form_padding_top']").prev().slider({
            value: $("input[name='card_details_form_form_padding_top']").val()
        });
        $("input[name='card_details_form_form_padding_right']").val(($(option_open_for).find('.wrapper').prop('style')['padding-right']) ? $(option_open_for).find('.wrapper').prop('style')['padding-right'].split('px')[0] : 0);
        $("input[name='card_details_form_form_padding_right']").prev().slider({
            value: $("input[name='card_details_form_form_padding_right']").val()
        });
        $("input[name='card_details_form_form_padding_bottom']").val(($(option_open_for).find('.wrapper').prop('style')['padding-bottom']) ? $(option_open_for).find('.wrapper').prop('style')['padding-bottom'].split('px')[0] : 0);
        $("input[name='card_details_form_form_padding_bottom']").prev().slider({
            value: $("input[name='card_details_form_form_padding_bottom']").val()
        });
        $("input[name='card_details_form_form_padding_left']").val(($(option_open_for).find('.wrapper').prop('style')['padding-left']) ? $(option_open_for).find('.wrapper').prop('style')['padding-left'].split('px')[0] : 0);
        $("input[name='card_details_form_form_padding_left']").prev().slider({
            value: $("input[name='card_details_form_form_padding_left']").val()
        });

        //margin
        $("input[name='card_details_form_form_margin_top']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='card_details_form_form_margin_top']").prev().slider({
            value: $("input[name='card_details_form_form_margin_top']").val()
        });
        $("input[name='card_details_form_form_margin_right']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='card_details_form_form_margin_right']").prev().slider({
            value: $("input[name='card_details_form_form_margin_right']").val()
        });
        $("input[name='card_details_form_form_margin_bottom']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='card_details_form_form_margin_bottom']").prev().slider({
            value: $("input[name='card_details_form_form_margin_bottom']").val()
        });
        $("input[name='card_details_form_form_margin_left']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='card_details_form_form_margin_left']").prev().slider({
            value: $("input[name='card_details_form_form_margin_left']").val()
        });
    });


    //SHIPPING FORM
    $(document).on('click', '.open-shipping-form-setings-modal', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        $("#shipping_caption_text").val($(option_open_for).find('.wrapper > .shipping-form > .section-title').text());

        //padding
        $("input[name='shipping_address_form_padding_top']").val(($(option_open_for).find('.wrapper').prop('style')['padding-top']) ? $(option_open_for).find('.wrapper').prop('style')['padding-top'].split('px')[0] : 0);
        $("input[name='shipping_address_form_padding_top']").prev().slider({
            value: $("input[name='shipping_address_form_padding_top']").val()
        });
        $("input[name='shipping_address_form_padding_right']").val(($(option_open_for).find('.wrapper').prop('style')['padding-right']) ? $(option_open_for).find('.wrapper').prop('style')['padding-right'].split('px')[0] : 0);
        $("input[name='shipping_address_form_padding_right']").prev().slider({
            value: $("input[name='shipping_address_form_padding_right']").val()
        });
        $("input[name='shipping_address_form_padding_bottom']").val(($(option_open_for).find('.wrapper').prop('style')['padding-bottom']) ? $(option_open_for).find('.wrapper').prop('style')['padding-bottom'].split('px')[0] : 0);
        $("input[name='shipping_address_form_padding_bottom']").prev().slider({
            value: $("input[name='shipping_address_form_padding_bottom']").val()
        });
        $("input[name='shipping_address_form_padding_left']").val(($(option_open_for).find('.wrapper').prop('style')['padding-left']) ? $(option_open_for).find('.wrapper').prop('style')['padding-left'].split('px')[0] : 0);
        $("input[name='shipping_address_form_padding_left']").prev().slider({
            value: $("input[name='shipping_address_form_padding_left']").val()
        });

        //margin
        $("input[name='shipping_address_form_margin_top']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='shipping_address_form_margin_top']").prev().slider({
            value: $("input[name='shipping_address_form_margin_top']").val()
        });
        $("input[name='shipping_address_form_margin_right']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='shipping_address_form_margin_right']").prev().slider({
            value: $("input[name='shipping_address_form_margin_right']").val()
        });
        $("input[name='shipping_address_form_margin_bottom']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='shipping_address_form_margin_bottom']").prev().slider({
            value: $("input[name='shipping_address_form_margin_bottom']").val()
        });
        $("input[name='shipping_address_form_margin_left']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='shipping_address_form_margin_left']").prev().slider({
            value: $("input[name='shipping_address_form_margin_left']").val()
        });
    });


    //Contact Form
    $(document).on('click', '.open-contact-form-setings-modal', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        $("#caption_text").val($(option_open_for).find('.step-caption > span:last-child').text());

        $("#step_number").val($(option_open_for).find('.step-caption > span:first-child').text());

        $(document).on("change", "#enable_step_number", function (e) {

            if ($(this).is(':checked')) {
                $("input[name='step_number']").show();
            } else {
                $("input[name='step_number']").hide();
            }
        });


        //padding
        $("input[name='contact_form_padding_top']").val(($(option_open_for).find('.wrapper').prop('style')['padding-top']) ? $(option_open_for).find('.wrapper').prop('style')['padding-top'].split('px')[0] : 0);
        $("input[name='contact_form_padding_top']").prev().slider({
            value: $("input[name='contact_form_padding_top']").val()
        });
        $("input[name='contact_form_padding_right']").val(($(option_open_for).find('.wrapper').prop('style')['padding-right']) ? $(option_open_for).find('.wrapper').prop('style')['padding-right'].split('px')[0] : 0);
        $("input[name='contact_form_padding_right']").prev().slider({
            value: $("input[name='contact_form_padding_right']").val()
        });
        $("input[name='contact_form_padding_bottom']").val(($(option_open_for).find('.wrapper').prop('style')['padding-bottom']) ? $(option_open_for).find('.wrapper').prop('style')['padding-bottom'].split('px')[0] : 0);
        $("input[name='contact_form_padding_bottom']").prev().slider({
            value: $("input[name='contact_form_padding_bottom']").val()
        });
        $("input[name='contact_form_padding_left']").val(($(option_open_for).find('.wrapper').prop('style')['padding-left']) ? $(option_open_for).find('.wrapper').prop('style')['padding-left'].split('px')[0] : 0);
        $("input[name='contact_form_padding_left']").prev().slider({
            value: $("input[name='contact_form_padding_left']").val()
        });

        //margin
        $("input[name='contact_form_margin_top']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='contact_form_margin_top']").prev().slider({
            value: $("input[name='contact_form_margin_top']").val()
        });
        $("input[name='contact_form_margin_right']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='contact_form_margin_right']").prev().slider({
            value: $("input[name='contact_form_margin_right']").val()
        });
        $("input[name='contact_form_margin_bottom']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='contact_form_margin_bottom']").prev().slider({
            value: $("input[name='contact_form_margin_bottom']").val()
        });
        $("input[name='contact_form_margin_left']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='contact_form_margin_left']").prev().slider({
            value: $("input[name='contact_form_margin_left']").val()
        });
    });


    //PRODUCT AVAILABLITY
    $(document).on('click', '.open-product-available-modal', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        //action
        var align = $(option_open_for).find('.wrapper').prop('style')['text-align'];

        if (align == '') {
            $('#product_availabel_align option[value="center"]').attr("selected", "selected");
        } else if (align == 'left') {
            $('#product_availabel_align option[value="left"]').attr("selected", "selected");
        } else if (align == 'right') {
            $('#product_availabel_align option[value="right"]').attr("selected", "selected");
        }

        //$("#headline_text").val($(option_open_for).find('.wrapper > b').html());
        $("#product_availabel_text_color").val(rgb2hex($(option_open_for).find('.wrapper > b').css('color')));

        //$("#heading_padding_top_settings").val($(option_open_for).find('.wrapper').css('padding-top'));
        //$("#heading_padding_bottom_settings").val($(option_open_for).find('.wrapper').css('padding-bottom'));


        //padding
        $("input[name='product_availabel_padding_top']").val($(option_open_for).find('.wrapper').prop('style')['padding-top'].split('px')[0]);
        $("input[name='product_availabel_padding_top']").prev().slider({
            value: $("input[name='product_availabel_padding_top']").val()
        });
        $("input[name='product_availabel_padding_right']").val($(option_open_for).find('.wrapper').prop('style')['padding-right'].split('px')[0]);
        $("input[name='product_availabel_padding_right']").prev().slider({
            value: $("input[name='product_availabel_padding_right']").val()
        });
        $("input[name='product_availabel_padding_bottom']").val($(option_open_for).find('.wrapper').prop('style')['padding-bottom'].split('px')[0]);
        $("input[name='product_availabel_padding_bottom']").prev().slider({
            value: $("input[name='product_availabel_padding_bottom']").val()
        });
        $("input[name='product_availabel_padding_left']").val($(option_open_for).find('.wrapper').prop('style')['padding-left'].split('px')[0]);
        $("input[name='product_availabel_padding_left']").prev().slider({
            value: $("input[name='product_availabel_padding_left']").val()
        });

        //margin
        $("input[name='product_availabel_margin_top']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='product_availabel_margin_top']").prev().slider({
            value: $("input[name='product_availabel_margin_top']").val()
        });
        $("input[name='product_availabel_margin_right']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='product_availabel_margin_right']").prev().slider({
            value: $("input[name='product_availabel_margin_right']").val()
        });
        $("input[name='product_availabel_margin_bottom']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='product_availabel_margin_bottom']").prev().slider({
            value: $("input[name='product_availabel_margin_bottom']").val()
        });
        $("input[name='product_availabel_margin_left']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='product_availabel_margin_left']").prev().slider({
            value: $("input[name='product_availabel_margin_left']").val()
        });
    });


    //ORDER DETAILS
    $(document).on('click', '.open-order-address_details-settings-modal', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        //action
        var align = $(option_open_for).find('.wrapper').prop('style')['text-align'];

        if (align == '') {
            $('#order_address_details_setting_align option[value="center"]').attr("selected", "selected");
        } else if (align == 'left') {
            $('#order_address_details_setting_align option[value="left"]').attr("selected", "selected");
        } else if (align == 'right') {
            $('#order_address_details_setting_align option[value="right"]').attr("selected", "selected");
        }


        $("#order_address_details_setting_align").val(($(option_open_for).find('.wrapper h4').prop('style')['color']));


        //padding
        $("input[name='order_address_details_padding_top']").val(($(option_open_for).find('.wrapper').prop('style')['padding-top']) ? $(option_open_for).find('.wrapper').prop('style')['padding-top'].split('px')[0] : 0);
        $("input[name='order_address_details_padding_top']").prev().slider({
            value: $("input[name='order_address_details_padding_top']").val()
        });
        $("input[name='order_address_details_padding_right']").val(($(option_open_for).find('.wrapper').prop('style')['padding-right']) ? $(option_open_for).find('.wrapper').prop('style')['padding-right'].split('px')[0] : 0);
        $("input[name='order_address_details_padding_right']").prev().slider({
            value: $("input[name='order_address_details_padding_right']").val()
        });
        $("input[name='order_address_details_padding_bottom']").val(($(option_open_for).find('.wrapper').prop('style')['padding-bottom']) ? $(option_open_for).find('.wrapper').prop('style')['padding-bottom'].split('px')[0] : 0);
        $("input[name='order_address_details_padding_bottom']").prev().slider({
            value: $("input[name='order_address_details_padding_bottom']").val()
        });
        $("input[name='order_address_details_padding_left']").val(($(option_open_for).find('.wrapper').prop('style')['padding-left']) ? $(option_open_for).find('.wrapper').prop('style')['padding-left'].split('px')[0] : 0);
        $("input[name='order_address_details_padding_left']").prev().slider({
            value: $("input[name='order_address_details_padding_left']").val()
        });

        //margin
        $("input[name='order_address_details_margin_top']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='order_address_details_margin_top']").prev().slider({
            value: $("input[name='order_address_details_margin_top']").val()
        });
        $("input[name='order_address_details_margin_right']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='order_address_details_margin_right']").prev().slider({
            value: $("input[name='order_address_details_margin_right']").val()
        });
        $("input[name='order_address_details_margin_bottom']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='order_address_details_margin_bottom']").prev().slider({
            value: $("input[name='order_address_details_margin_bottom']").val()
        });
        $("input[name='order_address_details_margin_left']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='order_address_details_margin_left']").prev().slider({
            value: $("input[name='order_address_details_margin_left']").val()
        });
    });


    //ORDER ACTION
    $(document).on('click', '.open-order-action-settings-modal', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        //action
        var align = $(option_open_for).find('.wrapper').prop('style')['text-align'];

        if (align == '') {
            $('#order_action_setting_align option[value="center"]').attr("selected", "selected");
        } else if (align == 'left') {
            $('#order_action_setting_align option[value="left"]').attr("selected", "selected");
        } else if (align == 'right') {
            $('#order_action_setting_align option[value="right"]').attr("selected", "selected");
        }

        $("#order_action_button_text").val($(option_open_for).find('.wrapper > a').html());
        $("#order_print_button_text").val($(option_open_for).find('.wrapper > button').html());

        $("#order_button_color").val(($(option_open_for).find('.wrapper > a').prop('style')['color']));
        $("#order_button_bg_color").val(($(option_open_for).find('.wrapper > a').prop('style')['background-color']));
        $("#order_print_button_text_color").val(($(option_open_for).find('.wrapper > button').prop('style')['color']));
        $("#order_print_button_bg_color").val(($(option_open_for).find('.wrapper > button').prop('style')['background-color']));

        //$("#heading_padding_top_settings").val($(option_open_for).find('.wrapper').css('padding-top'));
        //$("#heading_padding_bottom_settings").val($(option_open_for).find('.wrapper').css('padding-bottom'));


        //padding
        $("input[name='order_info_padding_top']").val(($(option_open_for).find('.wrapper').prop('style')['padding-top']) ? $(option_open_for).find('.wrapper').prop('style')['padding-top'].split('px')[0] : 0);
        $("input[name='order_info_padding_top']").prev().slider({
            value: $("input[name='order_info_padding_top']").val()
        });
        $("input[name='order_info_padding_right']").val(($(option_open_for).find('.wrapper').prop('style')['padding-right']) ? $(option_open_for).find('.wrapper').prop('style')['padding-right'].split('px')[0] : 0);
        $("input[name='order_info_padding_right']").prev().slider({
            value: $("input[name='order_info_padding_right']").val()
        });
        $("input[name='order_info_padding_bottom']").val(($(option_open_for).find('.wrapper').prop('style')['padding-bottom']) ? $(option_open_for).find('.wrapper').prop('style')['padding-bottom'].split('px')[0] : 0);
        $("input[name='order_info_padding_bottom']").prev().slider({
            value: $("input[name='order_info_padding_bottom']").val()
        });
        $("input[name='order_info_padding_left']").val(($(option_open_for).find('.wrapper').prop('style')['padding-left']) ? $(option_open_for).find('.wrapper').prop('style')['padding-left'].split('px')[0] : 0);
        $("input[name='order_info_padding_left']").prev().slider({
            value: $("input[name='order_info_padding_left']").val()
        });

        //margin
        $("input[name='order_info_margin_top']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='order_info_margin_top']").prev().slider({
            value: $("input[name='order_info_margin_top']").val()
        });
        $("input[name='order_info_margin_right']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='order_info_margin_right']").prev().slider({
            value: $("input[name='order_info_margin_right']").val()
        });
        $("input[name='order_info_margin_bottom']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='order_info_margin_bottom']").prev().slider({
            value: $("input[name='order_info_margin_bottom']").val()
        });
        $("input[name='order_info_margin_left']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='order_info_margin_left']").prev().slider({
            value: $("input[name='order_info_margin_left']").val()
        });
    });


    //ORDER INFO
    $(document).on('click', '.open-order-info-settings-modal', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        //action
        var align = $(option_open_for).find('.wrapper').prop('style')['text-align'];

        if (align == '') {
            $('#order_info_setting_align option[value="center"]').attr("selected", "selected");
        } else if (align == 'left') {
            $('#order_info_setting_align option[value="left"]').attr("selected", "selected");
        } else if (align == 'right') {
            $('#order_info_setting_align option[value="right"]').attr("selected", "selected");
        }

        $("#order_successful_message").val($(option_open_for).find('.wrapper > h1').html());
        $("#order_successful_message_color").val(rgb2hex($(option_open_for).find('.wrapper > h1').css('color')));

        //$("#heading_padding_top_settings").val($(option_open_for).find('.wrapper').css('padding-top'));
        //$("#heading_padding_bottom_settings").val($(option_open_for).find('.wrapper').css('padding-bottom'));


        //padding
        $("input[name='order_info_padding_top']").val(($(option_open_for).find('.wrapper').prop('style')['padding-top']) ? $(option_open_for).find('.wrapper').prop('style')['padding-top'].split('px')[0] : 0);
        $("input[name='order_info_padding_top']").prev().slider({
            value: $("input[name='order_info_padding_top']").val()
        });
        $("input[name='order_info_padding_right']").val(($(option_open_for).find('.wrapper').prop('style')['padding-right']) ? $(option_open_for).find('.wrapper').prop('style')['padding-right'].split('px')[0] : 0);
        $("input[name='order_info_padding_right']").prev().slider({
            value: $("input[name='order_info_padding_right']").val()
        });
        $("input[name='order_info_padding_bottom']").val(($(option_open_for).find('.wrapper').prop('style')['padding-bottom']) ? $(option_open_for).find('.wrapper').prop('style')['padding-bottom'].split('px')[0] : 0);
        $("input[name='order_info_padding_bottom']").prev().slider({
            value: $("input[name='order_info_padding_bottom']").val()
        });
        $("input[name='order_info_padding_left']").val(($(option_open_for).find('.wrapper').prop('style')['padding-left']) ? $(option_open_for).find('.wrapper').prop('style')['padding-left'].split('px')[0] : 0);
        $("input[name='order_info_padding_left']").prev().slider({
            value: $("input[name='order_info_padding_left']").val()
        });

        //margin
        $("input[name='order_info_margin_top']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='order_info_margin_top']").prev().slider({
            value: $("input[name='order_info_margin_top']").val()
        });
        $("input[name='order_info_margin_right']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='order_info_margin_right']").prev().slider({
            value: $("input[name='order_info_margin_right']").val()
        });
        $("input[name='order_info_margin_bottom']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='order_info_margin_bottom']").prev().slider({
            value: $("input[name='order_info_margin_bottom']").val()
        });
        $("input[name='order_info_margin_left']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='order_info_margin_left']").prev().slider({
            value: $("input[name='order_info_margin_left']").val()
        });
    });


    //PRODUCT DESCRIPTION
    $(document).on('click', '.product-description-modal', function (e) {

        e.preventDefault();

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        //action
        //var align = $(option_open_for).find('.wrapper > div').attr('data-align');
        var align = $(option_open_for).find('.wrapper > div').prop('style')['text-align'];

        if (align == '') {
            $('#select_product_description_align_option option[value="center"]').attr("selected", "selected");
        } else if (align == 'left') {
            $('#select_product_description_align_option option[value="left"]').attr("selected", "selected");
        } else if (align == 'right') {
            $('#select_product_description_align_option option[value="right"]').attr("selected", "selected");
        }


        //Text
        //alert($(option_open_for).find('.product-description-wrapper .product-description-switch > div').html());
        $('#product_description_text').summernote('code', $(option_open_for).find('.wrapper > div').html());

        $("#productDescriptionModal").find(":input[name='description_color']").val(rgb2hex($(option_open_for).find('.wrapper > div').css('color')));


        $("input[name='description_font_size']").val($(option_open_for).find('.wrapper > div').prop('style')['font-size'].split('px')[0]);
        $("input[name='description_font_size']").prev().slider({
            value: $("input[name='description_font_size']").val()
        });

        //line height
        //$("input[name='product_description_line_height']").val($(option_open_for).find('.wrapper p').prop('style')['line-height'].split('px')[0]);
        //$("input[name='product_description_line_height']").prev().slider({value: $("input[name='product_description_line_height']").val()});

        if ($(option_open_for).find('.wrapper > div').prop('style')['line-height'].split('px')[0].length > 0)
            $("input[name='product_description_line_height']").val($(option_open_for).find('.wrapper > div').prop('style')['line-height'].split('px')[0]);
        else
            $("input[name='product_description_line_height']").val(DEFAULT_PARAGRAPH_LINE_HEIGHT);
        $("input[name='product_description_line_height']").prev().slider({
            value: $("input[name='product_description_line_height']").val()
        });

        //font size
        if ($(option_open_for).find('.wrapper > div').prop('style')['font-size'].split('px')[0].length > 0)
            $("input[name='product_description_font_size']").val($(option_open_for).find('.wrapper > div').prop('style')['font-size'].split('px')[0]);
        else
            $("input[name='product_description_font_size']").val(DEFAULT_PARAGRAPH_FONT_SIZE);
        $("input[name='product_description_font_size']").prev().slider({
            value: $("input[name='product_description_font_size']").val()
        });

        //padding
        $("input[name='product_description_padding_top']").val($(option_open_for).find('.wrapper').prop('style')['padding-top'].split('px')[0]);
        $("input[name='product_description_padding_top']").prev().slider({
            value: $("input[name='product_description_padding_top']").val()
        });
        $("input[name='product_description_padding_right']").val($(option_open_for).find('.wrapper').prop('style')['padding-right'].split('px')[0]);
        $("input[name='product_description_padding_right']").prev().slider({
            value: $("input[name='product_description_padding_right']").val()
        });
        $("input[name='product_description_padding_bottom']").val($(option_open_for).find('.wrapper').prop('style')['padding-bottom'].split('px')[0]);
        $("input[name='product_description_padding_bottom']").prev().slider({
            value: $("input[name='product_description_padding_bottom']").val()
        });
        $("input[name='product_description_padding_left']").val($(option_open_for).find('.wrapper').prop('style')['padding-left'].split('px')[0]);
        $("input[name='product_description_padding_left']").prev().slider({
            value: $("input[name='product_description_padding_left']").val()
        });

        //margin
        $("input[name='product_description_margin_top']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='product_description_margin_top']").prev().slider({
            value: $("input[name='product_description_margin_top']").val()
        });
        $("input[name='product_description_margin_right']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='product_description_margin_right']").prev().slider({
            value: $("input[name='product_description_margin_right']").val()
        });
        $("input[name='product_description_margin_bottom']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='product_description_margin_bottom']").prev().slider({
            value: $("input[name='product_description_margin_bottom']").val()
        });
        $("input[name='product_description_margin_left']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='product_description_margin_left']").prev().slider({
            value: $("input[name='product_description_margin_left']").val()
        });


        //$("#productPriceSettingsModal").find(":input[name='description_font_size']").css('font-size', $(option_open_for).find('.wrapper p').css('font-size'));
        //$("#productPriceSettingsModal").find(":input[name='description_setting_padding']").css('padding-top', $(option_open_for).find('.wrapper p').css('padding-top'));

        //$("#productPriceSettingsModal").find(".description-fontsize-value").html($(option_open_for).find('.wrapper p').css('font-size'));
        //$("#productPriceSettingsModal").find(".description-padding-setting").html($(option_open_for).find('.wrapper p').css('font-size'));
    });


    //PRODUCT PRICE
    $(document).on('click', '.open-product-price-setings-modal', function (e) {

        e.preventDefault();

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        //action
        var align = $(option_open_for).find('.wrapper').prop('style')['text-align'];

        if (align == '') {
            $('#select_product_price_align_option option[value="center"]').attr("selected", "selected");
        } else if (align == 'left') {
            $('#select_product_price_align_option option[value="left"]').attr("selected", "selected");
        } else if (align == 'right') {
            $('#select_product_price_align_option option[value="right"]').attr("selected", "selected");
        }

        //$("#productPriceSettingsModal").find(":input[name='price_as']").val($(option_open_for).find('.wrapper strong').html());
        $("#productPriceSettingsModal").find(":input[name='price_as']").summernote('code', $(option_open_for).find('.wrapper strong').html());

        if ($(option_open_for).find('.wrapper strong').prop('style')['color'].length > 0) {
            $("#productPriceSettingsModal").find(":input[name='price_color']").val(rgb2hex($(option_open_for).find('.wrapper strong').prop('style')['color']));
        } else {
            $("#productPriceSettingsModal").find(":input[name='price_color']").val('#000000');
        }

        /*if ( $(option_open_for).find('.wrapper strong').prop('style')['font-size'] > 0 ) {
            $("#productPriceSettingsModal").find(":input[name='price_font_size']").val($(option_open_for).find('.wrapper strong').prop('style')['font-size']);
        } else {
            $("#productPriceSettingsModal").find(":input[name='price_font_size']").val('30px');
        }*/

        //alert($(option_open_for).find('.wrapper').prop('style')['font-size']);

        $("input[name='price_setting_padding']").val($(option_open_for).find('.wrapper').prop('style')['padding-top'].split('px')[0]);
        $("input[name='price_setting_padding']").prev().slider({
            value: $("input[name='price_setting_padding']").val()
        });

        $("input[name='product_price_font_size']").val($(option_open_for).find('.wrapper > strong').prop('style')['font-size'].split('px')[0]);
        $("input[name='product_price_font_size']").prev().slider({
            value: $("input[name='product_price_font_size']").val()
        });

        //padding
        //if ( $(option_open_for).find('.wrapper').prop('style')['padding-top'] > 0 ) {
        //$("#productPriceSettingsModal").find(":input[name='price_setting_padding']").val($(option_open_for).find('.wrapper').prop('style')['padding-top']);
        //} else {
        //$("#productPriceSettingsModal").find(":input[name='price_setting_padding']").val('0px');
        //}


        /*if ( $(option_open_for).find('.wrapper').prop('style')['padding-top'] > 0 ) {
            $("#productPriceSettingsModal").find(".price-padding-setting").html($(option_open_for).find('.wrapper').prop('style')['padding-top']);
            $("#productPriceSettingsModal").find('.price-padding-setting').text($(option_open_for).find('.wrapper strong').prop('style')['padding-top']);
            //$("#productPriceSettingsModal").find(".price-setting-value").html($(option_open_for).find('.wrapper strong').css('font-size'));
        } else {
            $("#productPriceSettingsModal").find(".price-padding-setting").html('0px');
            $("#productPriceSettingsModal").find('.price-padding-setting').text('0px');
        }*/
    });


    //PRODUCT QUANTITY
    $(document).on('click', '.open-product-quantity-setings-modal', function (e) {

        e.preventDefault();

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        //action
        var align = $(option_open_for).find('.wrapper').attr('data-align');

        if (align == '') {
            $('#select_product_quantity_align_option option[value="center"]').attr("selected", "selected");
        } else if (align == 'left') {
            $('#select_product_quantity_align_option option[value="left"]').attr("selected", "selected");
        } else if (align == 'right') {
            $('#select_product_quantity_align_option option[value="right"]').attr("selected", "selected");
        }


        $("#product_quantity_width").val($(option_open_for).find('.wrapper').prop('style')['width'].split('%')[0]);

        //padding
        $("input[name='product_quantity_padding_top']").val($(option_open_for).find('.wrapper').prop('style')['padding-top'].split('px')[0]);
        $("input[name='product_quantity_padding_top']").prev().slider({
            value: $("input[name='product_quantity_padding_top']").val()
        });
        $("input[name='product_quantity_padding_right']").val($(option_open_for).find('.wrapper').prop('style')['padding-right'].split('px')[0]);
        $("input[name='product_quantity_padding_right']").prev().slider({
            value: $("input[name='product_quantity_padding_right']").val()
        });
        $("input[name='product_quantity_padding_bottom']").val($(option_open_for).find('.wrapper').prop('style')['padding-bottom'].split('px')[0]);
        $("input[name='product_quantity_padding_bottom']").prev().slider({
            value: $("input[name='product_quantity_padding_bottom']").val()
        });
        $("input[name='product_quantity_padding_left']").val($(option_open_for).find('.wrapper').prop('style')['padding-left'].split('px')[0]);
        $("input[name='product_quantity_padding_left']").prev().slider({
            value: $("input[name='product_quantity_padding_left']").val()
        });
    });


    //PRODUCT VARIENTS
    $(document).on('click', '.open-product-varient-setings-modal', function (e) {

        e.preventDefault();

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        //align
        var align = $(option_open_for).find('.wrapper > i').attr('data-align');

        if (typeof align != 'undefined') {
            if (align == 'center' || align == 'center') {
                $('#select_product_varient_align_option option[value="center"]').attr("selected", "selected");
            } else if (align == 'left') {
                $('#select_product_varient_align_option option[value="left"]').attr("selected", "selected");
            } else if (align == 'right') {
                $('#select_product_varient_align_option option[value="right"]').attr("selected", "selected");
            }
        } else {
            $('#select_product_varient_align_option option[value=""]').attr("selected", "selected");
        }

        //width
        //alert($(option_open_for).find('.element-product-varients .wrapper').prop('style')['width'].split('px')[0]);
        if ($(option_open_for).find('.element-product-varients .wrapper').prop('style')['width'].split('%')[0].length <= 0)
            $('#product_varient_width').val($(option_open_for).find('.element-product-varients .wrapper').prop('style')['width'].split('%')[0]); //
        else
            $('#product_varient_width').val(DEFAULT_PRODUCT_VARIENT_WIDTH); //


        //padding
        $("input[name='product_varient_padding_top']").val($(option_open_for).find('.wrapper').prop('style')['padding-top'].split('px')[0]);
        $("input[name='product_varient_padding_top']").prev().slider({
            value: $("input[name='product_varient_padding_top']").val()
        });
        $("input[name='product_varient_padding_right']").val($(option_open_for).find('.wrapper').prop('style')['padding-right'].split('px')[0]);
        $("input[name='product_varient_padding_right']").prev().slider({
            value: $("input[name='product_varient_padding_right']").val()
        });
        $("input[name='product_varient_padding_bottom']").val($(option_open_for).find('.wrapper').prop('style')['padding-bottom'].split('px')[0]);
        $("input[name='product_varient_padding_bottom']").prev().slider({
            value: $("input[name='product_varient_padding_bottom']").val()
        });
        $("input[name='product_varient_padding_left']").val($(option_open_for).find('.wrapper').prop('style')['padding-left'].split('px')[0]);
        $("input[name='product_varient_padding_left']").prev().slider({
            value: $("input[name='product_varient_padding_left']").val()
        });

        //margin
        $("input[name='product_varient_margin_top']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='product_varient_margin_top']").prev().slider({
            value: $("input[name='product_varient_margin_top']").val()
        });
        $("input[name='product_varient_margin_right']").val($(option_open_for).find('.wrapper').prop('style')['margin-right'].split('px')[0]);
        $("input[name='product_varient_margin_right']").prev().slider({
            value: $("input[name='product_varient_margin_right']").val()
        });
        $("input[name='product_varient_margin_bottom']").val($(option_open_for).find('.wrapper').prop('style')['margin-bottom'].split('px')[0]);
        $("input[name='product_varient_margin_bottom']").prev().slider({
            value: $("input[name='product_varient_margin_bottom']").val()
        });
        $("input[name='product_varient_margin_left']").val($(option_open_for).find('.wrapper').prop('style')['margin-left'].split('px')[0]);
        $("input[name='product_varient_margin_left']").prev().slider({
            value: $("input[name='product_varient_margin_left']").val()
        });
    });


    //SINGLE IMAGE setting
    $(document).on('click', '.open-manual-product-setings-modal', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        var product_image = $(option_open_for).find('.image > .main img').attr('src');
        var product_name = $(option_open_for).find('.details h2').html();

        //alert(product_image);

        $("#manualProductSettingsModal").find('.now-product ul > li img').attr('src', product_image);
        $("#manualProductSettingsModal").find('.now-product ul > li h3').html(product_name);

        $("#manualProductSettingsModal").find(":input[name='price_as']").val($(option_open_for).find('.price strong').html());
    });


    //SINGLE IMAGE setting
    $(document).on('click', '.open-single-image-setings-modal', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        $("#image_path").val($(option_open_for).find('.image-wrapper > .image > img').attr('src'));

        //alert($(option_open_for).find('.image-wrapper > .image > img').prop('style')['width']);

        if ($(option_open_for).find('.image-wrapper > .image > img').attr('style')) {

            if ($(option_open_for).find('.image-wrapper > .image > img').attr('style')) {
                /*$("#image_gallery_width").val($(option_open_for).find('.image-wrapper > .image > img').css('width'));
                $("#image_gallery_height").val($(option_open_for).find('.image-wrapper > .image > img').css('height'));*/

                //$("#image_gallery_width").val($(option_open_for).find('.image-wrapper > .image > img').prop('style')['width']);

                $("input[name='image_gallery_width']").val(($(option_open_for).find('.image-wrapper > .image > img').prop('style')['width'].split('%')[0]));
                $("input[name='image_gallery_width']").prev().slider({
                    value: $("input[name='image_gallery_width']").val()
                });

                $("#image_gallery_height").val($(option_open_for).find('.image-wrapper > .image > img').prop('style')['height']);

                var align = "";
                if (typeof $(option_open_for).find('.image-wrapper image').prop('style') != 'undefined') {
                    align = $(option_open_for).find('.image-wrapper image').prop('style')['text-align'];
                    if (align)
                        $('#align option[value="' + align + '"]').attr("selected", "selected");
                    else
                        $('#align option[value="none"]').attr("selected", "selected");
                }

                //alert($(option_open_for).find('.image-wrapper > .image').prop('style')['padding-top'].split('px')[0]);

                //padding
                $("input[name='image_padding_top']").val(($(option_open_for).find('.image-wrapper > .image').prop('style')['padding-top'].split('px')[0]));
                $("input[name='image_padding_top']").prev().slider({
                    value: $("input[name='image_padding_top']").val()
                });
                $("input[name='image_padding_right']").val(($(option_open_for).find('.image-wrapper > .image').prop('style')['padding-right'].split('px')[0]));
                $("input[name='image_padding_right']").prev().slider({
                    value: $("input[name='image_padding_right']").val()
                });
                $("input[name='image_padding_bottom']").val(($(option_open_for).find('.image-wrapper > .image').prop('style')['padding-bottom'].split('px')[0]));
                $("input[name='image_padding_bottom']").prev().slider({
                    value: $("input[name='image_padding_bottom']").val()
                });
                $("input[name='image_padding_left']").val(($(option_open_for).find('.image-wrapper > .image').prop('style')['padding-left'].split('px')[0]));
                $("input[name='image_padding_left']").prev().slider({
                    value: $("input[name='image_padding_left']").val()
                });

                //margin
                $("input[name='image_margin_top']").val($(option_open_for).find('.image-wrapper > .image').prop('style')['margin-top'].split('px')[0]);
                $("input[name='image_margin_top']").prev().slider({
                    value: $("input[name='image_margin_top']").val()
                });
                $("input[name='image_margin_right']").val($(option_open_for).find('.image-wrapper > .image').prop('style')['margin-right'].split('px')[0]);
                $("input[name='image_margin_right']").prev().slider({
                    value: $("input[name='image_margin_right']").val()
                });
                $("input[name='image_margin_bottom']").val($(option_open_for).find('.image-wrapper > .image').prop('style')['margin-bottom'].split('px')[0]);
                $("input[name='image_margin_bottom']").prev().slider({
                    value: $("input[name='image_margin_bottom']").val()
                });
                $("input[name='image_margin_left']").val($(option_open_for).find('.image-wrapper > .image').prop('style')['margin-left'].split('px')[0]);
                $("input[name='image_margin_left']").prev().slider({
                    value: $("input[name='image_margin_left']").val()
                });


                //border
                var border = $(option_open_for).find('.image-wrapper img').prop('style')['border-style'];

                if (border)
                    $('#image_border_style option[value="' + border + '"]').attr("selected", "selected");
                else
                    $('#image_border_style option[value="none"]').attr("selected", "selected");

                $("#image_border_color").val($(option_open_for).find('.image-wrapper img').prop('style')['border-color']);

                $("input[name='image_border_size']").val($(option_open_for).find('.image-wrapper > .image').prop('style')['border-width'].split('px')[0]);
                $("input[name='image_border_size']").prev().slider({
                    value: $("input[name='image_border_size']").val()
                });
                $("input[name='image_border_radius']").val($(option_open_for).find('.image-wrapper > .image').prop('style')['border-radius'].split('px')[0]);
                $("input[name='image_border_radius']").prev().slider({
                    value: $("input[name='image_border_radius']").val()
                });


                //shadow
                var shadow = $(option_open_for).find('.wrapper img').prop('style')['box-shadow'];

                //alert(shadow);

                if (shadow.indexOf('rgb') >= 0) {
                    shadow = shadow.split(') ');
                    shadow = shadow[1].split(' ');

                    $("#image_shadow_x_offset").val((shadow[0]) ? shadow[0] : 0);
                    $("#image_shadow_y_offset").val((shadow[1]) ? shadow[1] : 0);
                    $("#image_shadow_blur").val((shadow[2]) ? shadow[2] : 0);
                } else {
                    shadow = shadow.split(' ');

                    if (shadow[3])
                        $('#image_shadow_type option[value="' + shadow[3] + '"]').attr("selected", "selected");
                    else
                        $('#image_shadow_type option[value="outset"]').attr("selected", "selected");


                    $("#image_shadow_color").val((shadow[0]) ? shadow[0] : 'transparent');

                    $("input[name='image_shadow_x_offset']").val((shadow[0]) ? shadow[0] : 0);
                    $("input[name='image_shadow_x_offset']").prev().slider({
                        value: (shadow[0]) ? shadow[0] : 0
                    });
                    $("input[name='image_shadow_y_offset']").val((shadow[1]) ? shadow[1] : 0);
                    $("input[name='image_shadow_y_offset']").prev().slider({
                        value: $("input[name='image_shadow_y_offset']").val()
                    });
                    $("input[name='image_shadow_blur']").val((shadow[2]) ? shadow[2] : 0);
                    $("input[name='image_shadow_blur']").prev().slider({
                        value: $("input[name='image_shadow_blur']").val()
                    });

                    //$("#image_shadow_x_offset").val((shadow[0]) ? shadow[0] : 0);
                    //$("#image_shadow_y_offset").val((shadow[1]) ? shadow[1] : 0);
                    //$("#image_shadow_blur").val((shadow[2]) ? shadow[2] : 0);
                }
            }
        }

        $("#image_padding").val($(option_open_for).find('.image-wrapper > .image').css('padding-top'));

        //image additionals
        if (typeof $(option_open_for).find('.image-wrapper > .image > .additionals').prop('style') != 'undefined') {
            if ($(option_open_for).find('.image-wrapper > .image > .additionals').prop('style')['display'] == 'none') {
                $("#image_show_additionals").attr('checked', false);
            } else {
                $("#image_show_additionals").attr('checked', true);
            }
        }
    });


    //SOCIAl SHARE setting
    $(document).on('click', '.open-social-share-setings-modal', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        $("#social_url").val($(option_open_for).find('.wrapper > .social-share').attr('data-url'));
        $("#social_share_title").val($(option_open_for).find('.wrapper > .social-share').attr('data-title'));
    });


    //PRICETABLE setting
    $(document).on('click', '.open-pricing-table-setings-modal', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        $('.html-editor').summernote('code', $(option_open_for).find('.wrapper').html());
    });


    //SELECTBOX setting
    $(document).on('click', '.open-select-setings-modal', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        //List Options
        var list_options = $(option_open_for).find('.wrapper > select').attr('data-option-type');

        if (list_options == '') {
            $('#select_options option[value=""]').attr("selected", "selected");
        } else if (list_options == 'all_countries') {
            $('#select_options option[value="all_countries"]').attr("selected", "selected");
        }
    });


    //EMBED VIDEO setting
    $(document).on('click', '.open-embed-video-setings-modal', function (e) {

        //var data_embed_url = "//www.youtube.com/embed/";

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        var video_type = $(option_open_for).find('.wrapper > .video-holder img').attr('data-video-type');
        //if ( video_type == 'youtube' ) {
        $('#select_options option[value="' + video_type + '"]').attr("selected", "selected");
        //}

        $('#video_embed').val($(option_open_for).find('.wrapper > .video-holder img').attr('data-video-url'));

        video_type = $(option_open_for).find('.wrapper > .video-holder img').attr('data-video-autoplay');
        if (video_type == 'on') {
            $('#video_autoplay option[value="on"]').attr("selected", "selected");
        } else {
            $('#video_autoplay option[value="off"]').attr("selected", "selected");
        }

        video_controls = $(option_open_for).find('.wrapper > .video-holder img').attr('data-video-controls');
        if (video_controls == 'on') {
            $('#video_controls option[value="on"]').attr("selected", "selected");
        } else {
            $('#video_controls option[value="off"]').attr("selected", "selected");
        }

        video_branding = $(option_open_for).find('.wrapper > .video-holder img').attr('data-video-branding');
        if (video_branding == 'on') {
            $('#video_branding option[value="on"]').attr("selected", "selected");
        } else {
            $('#video_branding option[value="off"]').attr("selected", "selected");
        }

        //alert($(option_open_for).find('.wrapper > .video-holder img').height());
        if (typeof $(option_open_for).find('.wrapper > .video-holder img').attr('data-video-width') == 'undefined')
            $('#video_width').val($(option_open_for).find('.wrapper > .video-holder img').attr('data-video-width'));
        else
            $('#video_width').val($(option_open_for).find('.wrapper > .video-holder img').width());

        if (typeof $(option_open_for).find('.wrapper > .video-holder img').attr('data-video-height') == 'undefined')
            $('#video_height').val($(option_open_for).find('.wrapper > .video-holder img').attr('data-video-height'));
        else
            $('#video_height').val($(option_open_for).find('.wrapper > .video-holder img').height());


        //image
        if (($(option_open_for).attr('data-alt-thumb-image'))) {
            $("#embaded_video_image").val($(option_open_for).attr('data-alt-thumb-image'));
        }


        //border
        var border_style = $(option_open_for).find('.wrapper').prop('style')['border-style'];
        $('#embaded_video_border_style option[value="' + border_style + '"]').attr("selected", "selected");

        var border_size = $(option_open_for).find('.wrapper').prop('style')['border-width'];
        $('#embaded_video_border_size option[value="' + border_size + '"]').attr("selected", "selected");

        $("#embaded_video_border_color").val(rgb2hex($(option_open_for).find('.wrapper').prop('style')['border-color']));


        //padding
        $("input[name='embaded_video_padding_top']").val(($(option_open_for).find('.wrapper').prop('style')['padding-top'].split('px')[0]));
        $("input[name='embaded_video_padding_top']").prev().slider({
            value: $("input[name='embaded_video_padding_top']").val()
        });
        $("input[name='embaded_video_padding_right']").val(($(option_open_for).find('.wrapper').prop('style')['padding-right'].split('px')[0]));
        $("input[name='embaded_video_padding_right']").prev().slider({
            value: $("input[name='embaded_video_padding_right']").val()
        });
        $("input[name='embaded_video_padding_bottom']").val(($(option_open_for).find('.wrapper').prop('style')['padding-bottom'].split('px')[0]));
        $("input[name='embaded_video_padding_bottom']").prev().slider({
            value: $("input[name='embaded_video_padding_bottom']").val()
        });
        $("input[name='embaded_video_padding_left']").val(($(option_open_for).find('.wrapper').prop('style')['padding-left'].split('px')[0]));
        $("input[name='embaded_video_padding_left']").prev().slider({
            value: $("input[name='embaded_video_padding_left']").val()
        });

        //margin
        $("input[name='embaded_video_margin_top']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='embaded_video_margin_top']").prev().slider({
            value: $("input[name='embaded_video_margin_top']").val()
        });
        $("input[name='embaded_video_margin_right']").val($(option_open_for).find('.wrapper').prop('style')['margin-right'].split('px')[0]);
        $("input[name='embaded_video_margin_right']").prev().slider({
            value: $("input[name='embaded_video_margin_right']").val()
        });
        $("input[name='embaded_video_margin_bottom']").val($(option_open_for).find('.wrapper').prop('style')['margin-bottom'].split('px')[0]);
        $("input[name='embaded_video_margin_bottom']").prev().slider({
            value: $("input[name='embaded_video_margin_bottom']").val()
        });
        $("input[name='embaded_video_margin_left']").val($(option_open_for).find('.wrapper').prop('style')['margin-left'].split('px')[0]);
        $("input[name='embaded_video_margin_left']").prev().slider({
            value: $("input[name='embaded_video_margin_left']").val()
        });

    });


    //ICON LIST setting
    /*$(document).on('click', '.open-icon-list-setings-modal', function(e) {

        var data_type = 'icon';
        var element = $(this);
        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        //alert($(option_open_for).find('.wrapper > .icon-list').html())

        $('.html-editor').summernote('code', $(option_open_for).find('.wrapper > .icon-list').html());

        //align
        var align = $(option_open_for).find('.wrapper > i').attr('data-align');

        if ( align == '' ) {
            $('#alignment_type option[value="center"]').attr("selected", "selected");
        } else if (align == 'left') {
            $('#alignment_type option[value="left"]').attr("selected", "selected");
        } else if (align == 'right') {
            $('#alignment_type option[value="right"]').attr("selected", "selected");
        }

        //$("#icon_color").val(rgb2hex($(option_open_for).find('.wrapper > i').css('color')));
        $("#hid_icon_list_class").val((option_open_for).find('.wrapper > i').attr('class'));

        $.get('https://rawgit.com/FortAwesome/Font-Awesome/master/src/icons.yml', function(data){
            var parsedYaml = jsyaml.load(data);
            var body = $('.icon-package-list > ul');

            //alert(settings.icon_class);

            $.each(parsedYaml.icons, function(index, icon){
                body.append('<li><i data-code="' + icon.unicode + '" class="fa fa-' + icon.id + '"></i></li>');
            })
        });
    });*/


    //ICON TEXT
    $(document).on('click', '.open-icon-text-setings-modal', function (e) {

        var data_type = 'icon';
        var element = $(this);
        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');


        var icon_classes = $(option_open_for).find('.wrapper > .icon-text > li i').attr('class').split(' ');
        //alert(icon_classes[icon_classes.length - 1]);
        $("#icon-picker-button").attr('data-icon', icon_classes[icon_classes.length - 1]);
        $("#icon-picker-button > i").attr('class', 'fa ' + icon_classes[icon_classes.length - 1]);
        $("#icon-picker-button").parent().find('input[name="hid_selected_icon"]').val(icon_classes[icon_classes.length - 1]);


        //Text
        $('#icon_text_paragraph_text').summernote('code', $(option_open_for).find('.wrapper .icon-text > li strong').html());

        //Weight
        var weight = $(option_open_for).find('.wrapper ul > li strong').prop('style')['font-weight'];
        $('#icon_text_font_weight option[value="' + weight + '"]').attr("selected", "selected");

        //Alignment
        var alignment = $(option_open_for).find('.wrapper > .icon-text > li').prop('style')['text-align'];
        $('#icon_text_text_align option[value="' + alignment + '"]').attr("selected", "selected");

        //Icon Size
        $("input[name='icon_text_icon_size']").val($(option_open_for).find('.wrapper ul > li i').prop('style')['font-size'].split('px')[0]);
        $("input[name='icon_text_icon_size']").prev().slider({
            value: $("input[name='icon_text_icon_size']").val()
        });

        //Text Size
        $("input[name='icon_text_text_size']").val($(option_open_for).find('.wrapper ul > li > strong').prop('style')['font-size'].split('px')[0]);
        $("input[name='icon_text_text_size']").prev().slider({
            value: $("input[name='icon_text_text_size']").val()
        });

        //Icon Position
        var icon_position = $(option_open_for).find('.wrapper ul > li > span').prop('style')['vertical-align'];

        if (icon_position.length > 1)
            $('#icon_text_icon_position option[value="' + icon_position + '"]').attr("selected", "selected");
        else
            $('#icon_text_icon_position option[value="middle"]').attr("selected", "selected");

        //Line height
        $("input[name='icon_text_line_height']").val($(option_open_for).find('.wrapper ul > li > strong').prop('style')['line-height'].split('px')[0]);
        $("input[name='icon_text_line_height']").prev().slider({
            value: $("input[name='icon_text_line_height']").val()
        });

        $("#icon_text_icon_color").val(rgb2hex($(option_open_for).find('.wrapper ul > li i').css('color')));
        $("#icon_text_text_color").val(rgb2hex($(option_open_for).find('.wrapper ul > li').css('color')));

        //padding
        $("input[name='icon_text_padding_top']").val($(option_open_for).find('.wrapper').prop('style')['padding-top'].split('px')[0]);
        $("input[name='icon_text_padding_top']").prev().slider({
            value: $("input[name='icon_text_padding_top']").val()
        });
        $("input[name='icon_text_padding_right']").val($(option_open_for).find('.wrapper').prop('style')['padding-right'].split('px')[0]);
        $("input[name='icon_text_padding_right']").prev().slider({
            value: $("input[name='icon_text_padding_right']").val()
        });
        $("input[name='icon_text_padding_bottom']").val($(option_open_for).find('.wrapper').prop('style')['padding-bottom'].split('px')[0]);
        $("input[name='icon_text_padding_bottom']").prev().slider({
            value: $("input[name='icon_text_padding_bottom']").val()
        });
        $("input[name='icon_text_padding_left']").val($(option_open_for).find('.wrapper').prop('style')['padding-left'].split('px')[0]);
        $("input[name='icon_text_padding_left']").prev().slider({
            value: $("input[name='icon_text_padding_left']").val()
        });

        //margin
        $("input[name='icon_text_margin_top']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='icon_text_margin_top']").prev().slider({
            value: $("input[name='icon_text_margin_top']").val()
        });
        $("input[name='icon_text_margin_right']").val($(option_open_for).find('.wrapper').prop('style')['margin-right'].split('px')[0]);
        $("input[name='icon_text_margin_right']").prev().slider({
            value: $("input[name='icon_text_margin_right']").val()
        });
        $("input[name='icon_text_margin_bottom']").val($(option_open_for).find('.wrapper').prop('style')['margin-bottom'].split('px')[0]);
        $("input[name='icon_text_margin_bottom']").prev().slider({
            value: $("input[name='icon_text_margin_bottom']").val()
        });
        $("input[name='icon_text_margin_left']").val($(option_open_for).find('.wrapper').prop('style')['margin-left'].split('px')[0]);
        $("input[name='icon_text_margin_left']").prev().slider({
            value: $("input[name='icon_text_margin_left']").val()
        });
    });


    //Image List
    $(document).on('click', '.open-image-list-setings-modal', function (e) {

        var data_type = 'image';
        var element = $(this);
        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        //alert($(option_open_for).find('.wrapper ul > li').attr('data-img-url'));

        //Path
        $("#image_list_image_path").val($(option_open_for).find('.wrapper ul > li').attr('data-img-url'));

        //Text
        $('#image_text_paragraph_text').summernote('code', $(option_open_for).find('.wrapper .image-list > li').html());


        //Weight
        var weight = $(option_open_for).find('.wrapper .image-list > li').prop('style')['font-weight'];
        $('#icon_list_font_weight option[value="' + weight + '"]').attr("selected", "selected");

        //BG Size
        var bgsize = $(option_open_for).find('.wrapper .image-list > li').prop('style')['background-size'];
        $('#image_list_image_size option[value="' + bgsize + '"]').attr("selected", "selected");


        //Text Size
        //alert($(option_open_for).find('.wrapper .image-list > li').prop('style')['font-size']);
        $("input[name='image_list_text_size']").val($(option_open_for).find('.wrapper .image-list > li').prop('style')['font-size'].split('px')[0]);
        $("input[name='image_list_text_size']").prev().slider({
            value: $("input[name='image_list_text_size']").val()
        });

        //Image Text Gap
        $("input[name='image_list_image_text_gap']").val($(option_open_for).find('.wrapper .image-list > li').prop('style')['padding-left'].split('px')[0]);
        $("input[name='image_list_image_text_gap']").prev().slider({
            value: $("input[name='image_list_image_text_gap']").val()
        });


        //Line height
        $("input[name='image_list_line_height']").val($(option_open_for).find('.wrapper .image-list > li').prop('style')['line-height'].split('px')[0]);
        $("input[name='image_list_line_height']").prev().slider({
            value: $("input[name='image_list_line_height']").val()
        });


        $("#image_list_text_color").val(rgb2hex($(option_open_for).find('.wrapper .image-list > li').css('color')));

        //padding
        $("input[name='image_list_padding_top']").val($(option_open_for).find('.wrapper').prop('style')['padding-top'].split('px')[0]);
        $("input[name='image_list_padding_top']").prev().slider({
            value: $("input[name='image_list_padding_top']").val()
        });
        $("input[name='image_list_padding_right']").val($(option_open_for).find('.wrapper').prop('style')['padding-right'].split('px')[0]);
        $("input[name='image_list_padding_right']").prev().slider({
            value: $("input[name='image_list_padding_right']").val()
        });
        $("input[name='image_list_padding_bottom']").val($(option_open_for).find('.wrapper').prop('style')['padding-bottom'].split('px')[0]);
        $("input[name='image_list_padding_bottom']").prev().slider({
            value: $("input[name='image_list_padding_bottom']").val()
        });
        $("input[name='image_list_padding_left']").val($(option_open_for).find('.wrapper').prop('style')['padding-left'].split('px')[0]);
        $("input[name='image_list_padding_left']").prev().slider({
            value: $("input[name='image_list_padding_left']").val()
        });

        //margin
        $("input[name='image_list_margin_top']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='image_list_margin_top']").prev().slider({
            value: $("input[name='image_list_margin_top']").val()
        });
        $("input[name='image_list_margin_right']").val($(option_open_for).find('.wrapper').prop('style')['margin-right'].split('px')[0]);
        $("input[name='image_list_margin_right']").prev().slider({
            value: $("input[name='image_list_margin_right']").val()
        });
        $("input[name='image_list_margin_bottom']").val($(option_open_for).find('.wrapper').prop('style')['margin-bottom'].split('px')[0]);
        $("input[name='image_list_margin_bottom']").prev().slider({
            value: $("input[name='image_list_margin_bottom']").val()
        });
        $("input[name='image_list_margin_left']").val($(option_open_for).find('.wrapper').prop('style')['margin-left'].split('px')[0]);
        $("input[name='image_list_margin_left']").prev().slider({
            value: $("input[name='image_list_margin_left']").val()
        });
    });


    $(document).on('click', '.open-icon-list-setings-modal', function (e) {

        var data_type = 'icon';
        var element = $(this);
        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');
        var container = $("#frm_icon_list_settings .repeat-icon-list");

        //alert($(option_open_for).find('.wrapper > .icon-list').html())
        //container.html('');

        var icon_classes = $(option_open_for).find('.wrapper > .icon-list > li i').attr('class').split(' ');
        //alert(icon_classes[icon_classes.length - 1]);
        $("#icon-picker-button").attr('data-icon', icon_classes[icon_classes.length - 1]);
        $("#icon-picker-button > i").attr('class', 'fa ' + icon_classes[icon_classes.length - 1]);
        $("#icon-picker-button").parent().find('input[name="hid_selected_icon"]').val(icon_classes[icon_classes.length - 1]);

        var list_item_count = $(option_open_for).find('.wrapper > .icon-list > li').length;
        var list_items = $(option_open_for).find('.wrapper > .icon-list > li');

        //list all texts
        //alert($(".icon-list > li").length);
        if ($(list_items).length > 0) {
            $('.repeat-icon-list').html('');

            $(option_open_for).find(".icon-list > li").each(function (index, element) {

                $(".repeat-icon-list").append('<div class="form-group"><input type="text" name="list_text" value="' + $(element).find('strong').text() + '" class="form-control" /> <button type="button" class="btn btn-remove-icon-list-item" title="Remove item" alt="Remove item"><i class="fa fa-trash-o" aria-hidden="true"></i></button></div>');
            });
        }


        //Weight
        var weight = $(option_open_for).find('.wrapper ul > li strong').prop('style')['font-weight'];
        $('#icon_list_font_weight option[value="' + weight + '"]').attr("selected", "selected");

        //Icon Text Gap
        if ($(option_open_for).find('.wrapper ul > li').prop('style')['padding-left'].split('px')[0].length > 0)
            $("input[name='icon_list_icon_text_gap']").val($(option_open_for).find('.wrapper ul > li').prop('style')['padding-left'].split('px')[0]);
        else
            $("input[name='icon_list_icon_text_gap']").val(DEFAULT_ICON_LIST_ICON_TEXT_GAP);
        $("input[name='icon_list_icon_text_gap']").prev().slider({
            value: $("input[name='icon_list_icon_text_gap']").val()
        });

        //Icon Size
        if ($(option_open_for).find('.wrapper ul > li i').prop('style')['font-size'].split('px')[0].length > 0)
            $("input[name='icon_list_icon_size']").val($(option_open_for).find('.wrapper ul > li i').prop('style')['font-size'].split('px')[0]);
        else
            $("input[name='icon_list_icon_size']").val(DEFAULT_ICON_LIST_ICON_FONT_SIZE);
        $("input[name='icon_list_icon_size']").prev().slider({
            value: $("input[name='icon_list_icon_size']").val()
        });

        //Text Size
        if ($(option_open_for).find('.wrapper ul > li > strong').prop('style')['font-size'].split('px')[0].length > 0)
            $("input[name='icon_list_text_size']").val($(option_open_for).find('.wrapper ul > li > strong').prop('style')['font-size'].split('px')[0]);
        else
            $("input[name='icon_list_text_size']").val(DEFAULT_ICON_LIST_FONT_SIZE);

        $("input[name='icon_list_text_size']").prev().slider({
            value: $("input[name='icon_list_text_size']").val()
        });

        //Line height
        if ($(option_open_for).find('.wrapper ul > li').prop('style')['line-height'].split('px')[0].length > 0)
            $("input[name='icon_list_line_height']").val($(option_open_for).find('.wrapper ul > li').prop('style')['line-height'].split('px')[0]);
        else
            $("input[name='icon_list_line_height']").val(DEFAULT_ICON_LIST_LINE_HEIGHT);
        $("input[name='icon_list_line_height']").prev().slider({
            value: $("input[name='icon_list_line_height']").val()
        });

        $("#icon_list_icon_color").val(rgb2hex($(option_open_for).find('.wrapper ul > li i').css('color')));
        $("#icon_list_text_color").val(rgb2hex($(option_open_for).find('.wrapper ul > li').css('color')));

        //padding
        $("input[name='icon_list_padding_top']").val($(option_open_for).find('.wrapper').prop('style')['padding-top'].split('px')[0]);
        $("input[name='icon_list_padding_top']").prev().slider({
            value: $("input[name='icon_list_padding_top']").val()
        });
        $("input[name='icon_list_padding_right']").val($(option_open_for).find('.wrapper').prop('style')['padding-right'].split('px')[0]);
        $("input[name='icon_list_padding_right']").prev().slider({
            value: $("input[name='icon_list_padding_right']").val()
        });
        $("input[name='icon_list_padding_bottom']").val($(option_open_for).find('.wrapper').prop('style')['padding-bottom'].split('px')[0]);
        $("input[name='icon_list_padding_bottom']").prev().slider({
            value: $("input[name='icon_list_padding_bottom']").val()
        });
        $("input[name='icon_list_padding_left']").val($(option_open_for).find('.wrapper').prop('style')['padding-left'].split('px')[0]);
        $("input[name='icon_list_padding_left']").prev().slider({
            value: $("input[name='icon_list_padding_left']").val()
        });

        //margin
        $("input[name='icon_list_margin_top']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='icon_list_margin_top']").prev().slider({
            value: $("input[name='icon_list_margin_top']").val()
        });
        $("input[name='icon_list_margin_right']").val($(option_open_for).find('.wrapper').prop('style')['margin-right'].split('px')[0]);
        $("input[name='icon_list_margin_right']").prev().slider({
            value: $("input[name='icon_list_margin_right']").val()
        });
        $("input[name='icon_list_margin_bottom']").val($(option_open_for).find('.wrapper').prop('style')['margin-bottom'].split('px')[0]);
        $("input[name='icon_list_margin_bottom']").prev().slider({
            value: $("input[name='icon_list_margin_bottom']").val()
        });
        $("input[name='icon_list_margin_left']").val($(option_open_for).find('.wrapper').prop('style')['margin-left'].split('px')[0]);
        $("input[name='icon_list_margin_left']").prev().slider({
            value: $("input[name='icon_list_margin_left']").val()
        });
    });

    //remove icon list item
    $(document).on('click', '.btn-remove-icon-list-item', function (e) {

        e.preventDefault();

        $(this).parent().remove();
    });

    var icon_container_button;
    $(document).on('click', '#icon-picker-button', function (e) {

        icon_container_button = $(this);
        //alert('button');

        //$(this).next().remove();
        //$(this).after("<input type='hidden' name='hid_selected_icon' value='" + $(this).find("input[type='hidden']").val() + "' />");
    });

    //$(document).on("")


    //click on icon
    $(document).on("click", ".iconpicker-popover .table-icons tr > td > button", function (e) {

        //alert('button list');
        //$(icon_container_button).find(":input[name='hid_selected_icon']").remove();

        //$("#icon-picker-button").parent().find("input[name='hid_selected_icon']").remove();
        //$("#icon-picker-button").after("<input type='hidden' name='hid_selected_icon' value='" + $(this).attr('value') + "' />");

        $(icon_container_button).next().remove();
        $(icon_container_button).after("<input type='hidden' name='hid_selected_icon' value='" + $(this).attr("value") + "' />");
    });

    //Icon list add item
    $(document).on('click', '#icon_list_add_item', function (e) {

        e.preventDefault();

        //$(this).prev().append($(this).prev().find('.form-group:last-child').clone().find(':input').val(''));
        //$(this).prev().find('.form-group:last-child').clone().find(':input').val('').appendTo($(this).prev());
        //$(this).prev().append($(this).prev().find('.form-group:last-child').clone()).find('.form-group:last-child input').val('');

        /*$(this).prev().find('.form-group:last-child').clone()
            .find("input:text").val("").end()
            .appendTo($(this).prev());*/

        var html = '<div class="form-group" style="margin-top:15px;"><input type="text" name="list_text" value="" class="form-control" /> <button type="button" class="btn btn-remove-icon-list-item" title="Remove item" alt="Remove item"><i class="fa fa-trash-o" aria-hidden="true"></i></button></div>';


        $(this).prev().append(html);
        /*$(this).prev().find('.form-group:last-child button').iconpicker({
            align: 'center', // Only in div tag
            arrowClass: 'btn-primary',
            arrowPrevIconClass: 'glyphicon glyphicon-chevron-left',
            arrowNextIconClass: 'glyphicon glyphicon-chevron-right',
            cols: 10,
            footer: true,
            header: true,
            icon: 'fa-check',
            iconset: 'fontawesome',
            labelHeader: '{0} of {1} pages',
            labelFooter: '{0} - {1} of {2} icons',
            placement: 'bottom', // Only in button tag
            rows: 5,
            search: true,
            searchText: 'Search',
            selectedClass: 'btn-normal-success',
            unselectedClass: ''
        });*/
    });


    //ICON setting
    $(document).on('click', '.open-icon-setings-modal', function (e) {

        var data_type = 'icon';
        var element = $(this);
        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');
        var icon_id = $(option_open_for).find('.wrapper > i').prop('class').split('-');

        //action
        var align = $(option_open_for).find('.wrapper > i').attr('data-align');

        if (align == '') {
            $('#alignment_type option[value="center"]').attr("selected", "selected");
        } else if (align == 'left') {
            $('#alignment_type option[value="left"]').attr("selected", "selected");
        } else if (align == 'right') {
            $('#alignment_type option[value="right"]').attr("selected", "selected");
        }

        $("#icon_color").val(rgb2hex($(option_open_for).find('.wrapper > i').css('color')));
        $("#hid_icon_class").val((option_open_for).find('.wrapper > i').attr('class'));

        $.get('https://rawgit.com/FortAwesome/Font-Awesome/master/src/icons.yml', function (data) {
            var parsedYaml = jsyaml.load(data);
            var body = $('.icon-package-list > ul');

            //alert(settings.icon_class);
            $(body).html("");

            $.each(parsedYaml.icons, function (index, icon) {


                var selected_icon_id;

                if (icon_id.length >= 3) {
                    selected_icon_id = icon_id[icon_id.length - 2] + '-' + icon_id[icon_id.length - 1];
                } else {
                    selected_icon_id = icon_id[icon_id.length - 1];
                }

                //console.log(selected_icon_id + ", " + icon.id);


                if (selected_icon_id == icon.id) {
                    body.append('<li style="background: #0f0; color: #fff"><i data-code="' + icon.unicode + '" class="fa fa-' + icon.id + '"></i></li>');
                } else {
                    body.append('<li><i data-code="' + icon.unicode + '" class="fa fa-' + icon.id + '"></i></li>');
                }
            })
        });


        //padding
        $("input[name='icon_padding_top']").val($(option_open_for).find('.wrapper > i').prop('style')['padding-top'].split('px')[0]);
        $("input[name='icon_padding_top']").prev().slider({
            value: $("input[name='icon_padding_top']").val()
        });
        $("input[name='icon_padding_right']").val($(option_open_for).find('.wrapper > i').prop('style')['padding-right'].split('px')[0]);
        $("input[name='icon_padding_right']").prev().slider({
            value: $("input[name='icon_padding_right']").val()
        });
        $("input[name='icon_padding_bottom']").val($(option_open_for).find('.wrapper > i').prop('style')['padding-bottom'].split('px')[0]);
        $("input[name='icon_padding_bottom']").prev().slider({
            value: $("input[name='icon_padding_bottom']").val()
        });
        $("input[name='icon_padding_left']").val($(option_open_for).find('.wrapper > i').prop('style')['padding-left'].split('px')[0]);
        $("input[name='icon_padding_left']").prev().slider({
            value: $("input[name='icon_padding_left']").val()
        });

        //margin
        $("input[name='icon_margin_top']").val($(option_open_for).find('.wrapper > i').prop('style')['margin-top'].split('px')[0]);
        $("input[name='icon_margin_top']").prev().slider({
            value: $("input[name='icon_margin_top']").val()
        });
        $("input[name='icon_margin_right']").val($(option_open_for).find('.wrapper > i').prop('style')['margin-right'].split('px')[0]);
        $("input[name='icon_margin_right']").prev().slider({
            value: $("input[name='icon_margin_right']").val()
        });
        $("input[name='icon_margin_bottom']").val($(option_open_for).find('.wrapper > i').prop('style')['margin-bottom'].split('px')[0]);
        $("input[name='icon_margin_bottom']").prev().slider({
            value: $("input[name='icon_margin_bottom']").val()
        });
        $("input[name='icon_margin_left']").val($(option_open_for).find('.wrapper > i').prop('style')['margin-left'].split('px')[0]);
        $("input[name='icon_margin_left']").prev().slider({
            value: $("input[name='icon_margin_left']").val()
        });


        //border
        //var border = $(option_open_for).find('.wrapper > i').attr('data-border-style');
        var border = $(option_open_for).find('.wrapper > i').prop('style')['border-style'];

        if (border)
            $('#icon_border_style option[value="' + border + '"]').attr("selected", "selected");
        else
            $('#icon_border_style option[value="none"]').attr("selected", "selected");

        $("#icon_border_color").val($(option_open_for).find('.wrapper > i').prop('style')['border-color']);

        $("input[name='icon_border_size']").val($(option_open_for).find('.wrapper > i').prop('style')['border-width'].split('px')[0]);
        $("input[name='icon_border_size']").prev().slider({
            value: $("input[name='icon_border_size']").val()
        });
        $("input[name='icon_border_radius']").val($(option_open_for).find('.wrapper > i').prop('style')['border-radius'].split('px')[0]);
        $("input[name='icon_border_radius']").prev().slider({
            value: $("input[name='icon_border_radius']").val()
        });


        //$("#icon_border_size").val($(option_open_for).find('.wrapper > i').prop('style')['border-width']);
        //$("#icon_border_radius").val($(option_open_for).find('.wrapper > i').prop('style')['border-radius']);
    });


    //SEPERATOR setting
    $(document).on('click', '.open-seperator-setings-modal', function (e) {

        //$("form").reset();

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        $("#seperator_margin").on("slide", function (slideEvt) {
            $("#hid_seperator_margin").val(slideEvt.value);
        });

        //$("#seperator_color").val(rgb2hex($(option_open_for).find('.wrapper > hr').css('color')));
        //$("#seperator_margin").val($(option_open_for).find('.wrapper > hr').css('height'));

        //border
        var border_style = $(option_open_for).find('.wrapper > .ld-seperator').prop('style')['border-style'];
        if (border_style.lastIndexOf('!')) {
            var styles = border_style.split('!');
            border_style = styles[0].trim();
        }

        //alert(border_style.length);

        $('#seperator_border_style option[value="' + border_style + '"]').attr("selected", "selected");

        var border_size = $(option_open_for).find('.wrapper > .ld-seperator').prop('style')['border-width'];
        $('#seperator_border_size option[value="' + border_size + '"]').attr("selected", "selected");

        $("#seperator_border_color").val(rgb2hex($(option_open_for).find('.wrapper > .ld-seperator').prop('style')['border-color']));


        //padding
        $("input[name='seperator_padding_top']").val(($(option_open_for).find('.wrapper').prop('style')['padding-top']) ? $(option_open_for).find('.wrapper').prop('style')['padding-top'].split('px')[0] : 0);
        $("input[name='seperator_padding_top']").prev().slider({
            value: $("input[name='seperator_padding_top']").val()
        });
        $("input[name='seperator_padding_right']").val(($(option_open_for).find('.wrapper').prop('style')['padding-right']) ? $(option_open_for).find('.wrapper').prop('style')['padding-right'].split('px')[0] : 0);
        $("input[name='seperator_padding_right']").prev().slider({
            value: $("input[name='seperator_padding_right']").val()
        });
        $("input[name='seperator_padding_bottom']").val(($(option_open_for).find('.wrapper').prop('style')['padding-bottom']) ? $(option_open_for).find('.wrapper').prop('style')['padding-bottom'].split('px')[0] : 0);
        $("input[name='seperator_padding_bottom']").prev().slider({
            value: $("input[name='seperator_padding_bottom']").val()
        });
        $("input[name='seperator_padding_left']").val(($(option_open_for).find('.wrapper').prop('style')['padding-left']) ? $(option_open_for).find('.wrapper').prop('style')['padding-left'].split('px')[0] : 0);
        $("input[name='seperator_padding_left']").prev().slider({
            value: $("input[name='seperator_padding_left']").val()
        });

        //margin
        $("input[name='seperator_margin_top']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='seperator_margin_top']").prev().slider({
            value: $("input[name='seperator_margin_top']").val()
        });
        $("input[name='seperator_margin_right']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='seperator_margin_right']").prev().slider({
            value: $("input[name='seperator_margin_right']").val()
        });
        $("input[name='seperator_margin_bottom']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='seperator_margin_bottom']").prev().slider({
            value: $("input[name='seperator_margin_bottom']").val()
        });
        $("input[name='seperator_margin_left']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='seperator_margin_left']").prev().slider({
            value: $("input[name='seperator_margin_left']").val()
        });
    });


    //PARAGRAPH setting
    $(document).on('click', '.open-paragraph-setings-modal', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        //$("#paragraph_text").val($(option_open_for).find('.wrapper > p').html());

        $('#paragraph_text').summernote('code', $(option_open_for).find('.wrapper').html());

        //font
        var family = $(option_open_for).find('.wrapper').prop('style')['font-family'];
        if (family != "")
            $('#paragraph_text_font_family option[value=' + family + ']').attr("selected", "selected");
        else
            $('#paragraph_text_font_family option[value=Nunito]').attr("selected", "selected");

        if ($(option_open_for).find('.wrapper > p').attr('style')) {
            //$("#paragraph_text_color").val(rgb2hex($(option_open_for).find('.wrapper > p').css('color')));
            //$("#paragraph_bg_color").val(rgb2hex($(option_open_for).find('.wrapper > p').css('background-color')));

            $("#paragraph_text_color").val(rgb2hex($(option_open_for).find('.wrapper').prop('style')['color']));
            $("#paragraph_bg_color").val(rgb2hex($(option_open_for).find('.wrapper').prop('style')['background-color']));
        }


        //Line height
        if ($(option_open_for).find('.wrapper > p').prop('style')['line-height'].split('px')[0].length > 0)
            $("input[name='paragraph_line_height']").val($(option_open_for).find('.wrapper > p').prop('style')['line-height'].split('px')[0]);
        else
            $("input[name='paragraph_line_height']").val(DEFAULT_PARAGRAPH_LINE_HEIGHT);
        $("input[name='paragraph_line_height']").prev().slider({
            value: $("input[name='paragraph_line_height']").val()
        });

        //Font size
        //alert($(option_open_for).find('.wrapper > p').prop('style')['font-size']);
        if ($(option_open_for).find('.wrapper > p').prop('style')['font-size'].split('px')[0].length > 0)
            $("input[name='paragraph_font_size']").val($(option_open_for).find('.wrapper > p').prop('style')['font-size'].split('px')[0]);
        else
            $("input[name='paragraph_font_size']").val(DEFAULT_PARAGRAPH_FONT_SIZE);
        $("input[name='paragraph_font_size']").prev().slider({
            value: $("input[name='paragraph_font_size']").val()
        });


        var align = $(option_open_for).find('.wrapper').prop('style')['text-align'];
        $('#paragraph_alignment option[value=" ' + align + '"]').attr("selected", "selected");


        //padding
        $("input[name='paragraph_padding_top']").val($(option_open_for).find('.wrapper').prop('style')['padding-top'].split('px')[0]);
        $("input[name='paragraph_padding_top']").prev().slider({
            value: $("input[name='paragraph_padding_top']").val()
        });
        $("input[name='paragraph_padding_right']").val($(option_open_for).find('.wrapper').prop('style')['padding-right'].split('px')[0]);
        $("input[name='paragraph_padding_right']").prev().slider({
            value: $("input[name='paragraph_padding_right']").val()
        });
        $("input[name='paragraph_padding_bottom']").val($(option_open_for).find('.wrapper').prop('style')['padding-bottom'].split('px')[0]);
        $("input[name='paragraph_padding_bottom']").prev().slider({
            value: $("input[name='paragraph_padding_bottom']").val()
        });
        $("input[name='paragraph_padding_left']").val($(option_open_for).find('.wrapper').prop('style')['padding-left'].split('px')[0]);
        $("input[name='paragraph_padding_left']").prev().slider({
            value: $("input[name='paragraph_padding_left']").val()
        });

        //margin
        $("input[name='paragraph_margin_top']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='paragraph_margin_top']").prev().slider({
            value: $("input[name='paragraph_margin_top']").val()
        });
        $("input[name='paragraph_margin_right']").val($(option_open_for).find('.wrapper').prop('style')['margin-right'].split('px')[0]);
        $("input[name='paragraph_margin_right']").prev().slider({
            value: $("input[name='paragraph_margin_right']").val()
        });
        $("input[name='paragraph_margin_bottom']").val($(option_open_for).find('.wrapper').prop('style')['margin-bottom'].split('px')[0]);
        $("input[name='paragraph_margin_bottom']").prev().slider({
            value: $("input[name='paragraph_margin_bottom']").val()
        });
        $("input[name='paragraph_margin_left']").val($(option_open_for).find('.wrapper').prop('style')['margin-left'].split('px')[0]);
        $("input[name='paragraph_margin_left']").prev().slider({
            value: $("input[name='paragraph_margin_left']").val()
        });

        try {
            //Shadow Size
            var shadows = $(option_open_for).find('.wrapper').prop('style')['text-shadow'].split(')');
            shadows = shadows[1].split(' ');
            //alert(shadows[1].split(' '));
            var shadow = shadows[shadows.length - 1].split('px');
            $("input[name='paragraph_shadow_size']").val(shadow[0]);
            $("input[name='paragraph_shadow_size']").prev().slider({
                value: $("input[name='paragraph_shadow_size']").val()
            });
        } catch (err) {
        }

    });


    //SUB Headline setting
    $(document).on('click', '.open-sub-headline-setings-modal', function (e) {

        //$("form").reset();

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        //font
        var family = $(option_open_for).find('.wrapper').prop('style')['font-family'];
        if (family != "")
            $('#sub_headline_text_font_family option[value=' + family + ']').attr("selected", "selected");
        else
            $('#sub_headline_text_font_family option[value=Nunito]').attr("selected", "selected");

        //action
        var align = $(option_open_for).find('.wrapper').prop('style')['text-align'];

        if (align == '') {
            $('#sub_headline_setting_align option[value="center"]').attr("selected", "selected");
        } else if (align == 'left') {
            $('#sub_headline_setting_align option[value="left"]').attr("selected", "selected");
        } else if (align == 'right') {
            $('#sub_headline_setting_align option[value="right"]').attr("selected", "selected");
        }

        //Weight
        var weight = $(option_open_for).find('.wrapper > p').prop('style')['font-weight'];
        $('#sub_headline_font_weight option[value="' + weight + '"]').attr("selected", "selected");

        //Line Height
        if ($(option_open_for).find('.wrapper > p').prop('style')['line-height'].split('px')[0].length > 0)
            $("input[name='sub_headline_line_height']").val($(option_open_for).find('.wrapper > p').prop('style')['line-height'].split('px')[0]);
        else
            $("input[name='sub_headline_line_height']").val(DEFAULT_SUB_HEADLINE_LINE_HEIGHT);
        $("input[name='sub_headline_line_height']").prev().slider({
            value: $("input[name='sub_headline_line_height']").val()
        });

        //Font
        $("input[name='sub_headline_font_size']").val($(option_open_for).find('.wrapper > p').prop('style')['font-size'].split('px')[0]);
        $("input[name='sub_headline_font_size']").prev().slider({
            value: $("input[name='sub_headline_font_size']").val()
        });

        //padding
        $("input[name='sub_headline_padding_top']").val(($(option_open_for).find('.wrapper').prop('style')['padding-top']) ? $(option_open_for).find('.wrapper').prop('style')['padding-top'].split('px')[0] : 0);
        $("input[name='sub_headline_padding_top']").prev().slider({
            value: $("input[name='sub_headline_padding_top']").val()
        });
        $("input[name='sub_headline_padding_right']").val(($(option_open_for).find('.wrapper').prop('style')['padding-right']) ? $(option_open_for).find('.wrapper').prop('style')['padding-right'].split('px')[0] : 0);
        $("input[name='sub_headline_padding_right']").prev().slider({
            value: $("input[name='sub_headline_padding_right']").val()
        });
        $("input[name='sub_headline_padding_bottom']").val(($(option_open_for).find('.wrapper').prop('style')['padding-bottom']) ? $(option_open_for).find('.wrapper').prop('style')['padding-bottom'].split('px')[0] : 0);
        $("input[name='sub_headline_padding_bottom']").prev().slider({
            value: $("input[name='sub_headline_padding_bottom']").val()
        });
        $("input[name='sub_headline_padding_left']").val(($(option_open_for).find('.wrapper').prop('style')['padding-left']) ? $(option_open_for).find('.wrapper').prop('style')['padding-left'].split('px')[0] : 0);
        $("input[name='sub_headline_padding_left']").prev().slider({
            value: $("input[name='sub_headline_padding_left']").val()
        });

        //margin
        $("input[name='sub_headline_margin_top']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='sub_headline_margin_top']").prev().slider({
            value: $("input[name='sub_headline_margin_top']").val()
        });
        $("input[name='sub_headline_margin_right']").val($(option_open_for).find('.wrapper').prop('style')['margin-right'].split('px')[0]);
        $("input[name='sub_headline_margin_right']").prev().slider({
            value: $("input[name='sub_headline_margin_right']").val()
        });
        $("input[name='sub_headline_margin_bottom']").val($(option_open_for).find('.wrapper').prop('style')['margin-bottom'].split('px')[0]);
        $("input[name='sub_headline_margin_bottom']").prev().slider({
            value: $("input[name='sub_headline_margin_bottom']").val()
        });
        $("input[name='sub_headline_margin_left']").val($(option_open_for).find('.wrapper').prop('style')['margin-left'].split('px')[0]);
        $("input[name='sub_headline_margin_left']").prev().slider({
            value: $("input[name='sub_headline_margin_left']").val()
        });


        try {
            //Shadow Size
            var shadows = $(option_open_for).find('.wrapper > p').prop('style')['text-shadow'].split(')');
            shadows = shadows[1].split(' ');
            //alert(shadows[1].split(' '));
            var shadow = shadows[shadows.length - 1].split('px');
            $("input[name='sub_headline_shadow_size']").val(shadow[0]);
            $("input[name='sub_headline_shadow_size']").prev().slider({
                value: $("input[name='sub_headline_shadow_size']").val()
            });
        } catch (err) {
        }


        //alert($(option_open_for).find('.wrapper > p').prop('style')['color']);
        //$("#sub_headline_text").val($(option_open_for).find('.wrapper > p').html());
        $('#sub_headline_text').summernote('code', $(option_open_for).find('.wrapper > p').html());
        $("#sub_headline_text_color").val(rgb2hex($(option_open_for).find('.wrapper > p').prop('style')['color']));
        $("#sub_headline_bg_color").val(rgb2hex($(option_open_for).find('.wrapper').prop('style')['background-color']));

    });


    //Headline setting
    $(document).on('click', '.open-headline-setings-modal', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        //action
        var align = $(option_open_for).find('.wrapper').prop('style')['text-align'];

        if (align == '') {
            $('#headline_setting_align option[value="center"]').attr("selected", "selected");
        } else if (align == 'left') {
            $('#headline_setting_align option[value="left"]').attr("selected", "selected");
        } else if (align == 'right') {
            $('#headline_setting_align option[value="right"]').attr("selected", "selected");
        }

        //$("#headline_text").val($(option_open_for).find('.wrapper > b').html());
        $('#headline_text').summernote('code', $(option_open_for).find('.wrapper > b').html());

        //$("#headline_text_color").val(rgb2hex($(option_open_for).find('.wrapper > b').css('color')));
        //$("#main_headline_bg_color").val(rgb2hex($(option_open_for).find('.wrapper').css('background-color')));

        if ($(option_open_for).find('.wrapper > b').prop('style')['color'])
            $("#headline_text_color").val(rgb2hex($(option_open_for).find('.wrapper > b').prop('style')['color']));
        else
            $("#headline_text_color").val(rgb2hex($(option_open_for).find('.wrapper').prop('style')['color']));

        $("#main_headline_bg_color").val(rgb2hex($(option_open_for).find('.wrapper').prop('style')['background-color']));

        //$("#heading_padding_top_settings").val($(option_open_for).find('.wrapper').css('padding-top'));
        //$("#heading_padding_bottom_settings").val($(option_open_for).find('.wrapper').css('padding-bottom'));


        //Font Family
        //$("#headline_text_font").val($(option_open_for).find('.wrapper > b').prop('style')['font-family']);
        var family = $(option_open_for).find('.wrapper > b').prop('style')['font-family'];
        //alert(family);

        if (family != "")
            $('#headline_text_font option[value=' + family + ']').attr("selected", "selected");
        else
            $('#headline_text_font option[value=Nunito]').attr("selected", "selected");
        //$('#headline_text_font').val(family);

        //Font
        //alert($(option_open_for).find('.wrapper > b').prop('style')['font-size'].split('px')[0]);
        $("input[name='headline_font_size']").val($(option_open_for).find('.wrapper > b').prop('style')['font-size'].split('px')[0]);
        $("input[name='headline_font_size']").prev().slider({
            value: $("input[name='headline_font_size']").val()
        });

        //alert($(option_open_for).find('.wrapper > b').prop('style')['padding-left'].split('px')[0]);

        //padding
        $("input[name='headline_padding_top']").val($(option_open_for).find('.wrapper > b').prop('style')['padding-top'].split('px')[0]);
        $("input[name='headline_padding_top']").prev().slider({
            value: $("input[name='headline_padding_top']").val()
        });
        $("input[name='headline_padding_right']").val($(option_open_for).find('.wrapper > b').prop('style')['padding-right'].split('px')[0]);
        $("input[name='headline_padding_right']").prev().slider({
            value: $("input[name='headline_padding_right']").val()
        });
        $("input[name='headline_padding_bottom']").val($(option_open_for).find('.wrapper > b').prop('style')['padding-bottom'].split('px')[0]);
        $("input[name='headline_padding_bottom']").prev().slider({
            value: $("input[name='headline_padding_bottom']").val()
        });
        // $("input[name='headline_padding_left']").val($(option_open_for).find('.wrapper > b').prop('style')['padding-left'].split('px')[0]);

        console.log($(option_open_for).find('.wrapper > b').css('padding-left'));

        if ( $(option_open_for).find('.wrapper > b').css('padding-left') !== '0px' ) {
            $("input[name='headline_padding_left']").val($(option_open_for).find('.wrapper > b').css('padding-left').split('px')[0]);
            //$("input[name='headline_padding_left']").val($(option_open_for).find('.wrapper > b').prop('style')['padding-left'].split('px')[0]);
            $("input[name='headline_padding_left']").prev().slider({
                value: $("input[name='headline_padding_left']").val()
            });
        }

        console.log($(option_open_for).find('.wrapper > b').css('padding-left').split('px')[0]);

        //margin
        $("input[name='headline_margin_top']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='headline_margin_top']").prev().slider({
            value: $("input[name='headline_margin_top']").val()
        });
        $("input[name='headline_margin_right']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='headline_margin_right']").prev().slider({
            value: $("input[name='headline_margin_right']").val()
        });
        $("input[name='headline_margin_bottom']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='headline_margin_bottom']").prev().slider({
            value: $("input[name='headline_margin_bottom']").val()
        });
        $("input[name='headline_margin_left']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='headline_margin_left']").prev().slider({
            value: $("input[name='headline_margin_left']").val()
        });

        //Shadow Size
        var shadows = $(option_open_for).find('.wrapper > b').prop('style')['text-shadow'].split(')');
        shadows = shadows[1].split(' ');
        //alert(shadows[1].split(' '));
        var shadow = shadows[shadows.length - 1].split('px');
        $("input[name='headline_shadow_size']").val(shadow[0]);
        $("input[name='headline_shadow_size']").prev().slider({
            value: $("input[name='headline_shadow_size']").val()
        });
    });

    //GRID 1 setting
    $(document).on('click', '.grid-one-setings-modal', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        //$("#grid1_setting_padding").val($(option_open_for).css('padding-top'));

        $("#grid_one_setting_section_id").val($(option_open_for).attr('id'));

        //$("#grid_one_text_color").val(rgb2hex($(option_open_for).css('color')));
        //$("#grid_one_bg_color").val(rgb2hex($(option_open_for).css('background')));

        if ($(option_open_for).prop('style')['color'].length > 1) {
            $("#grid_one_text_color").val(rgb2hex($(option_open_for).prop('style')['color']));
        }

        if ($(option_open_for).prop('style')['background-color'].length > 1) {
            $("#grid_one_bg_color").val(rgb2hex($(option_open_for).prop('style')['background-color']));
        }

        //if ( $(option_open_for).prop('style')['background'].length > 1 )
        if ($(option_open_for).css('background-color'))
            $("#grid_one_container_bg_color").val(rgb2hex($(option_open_for).find('.sub-parent > .element-groups').prop('style')['background-color']));


        if ($(option_open_for).css('border-radius')) {
            $("input[name='grid_one_border_radius']").val($(option_open_for).prop('style')['border-radius'].split('px')[0]);
        } else {
            $("input[name='grid_one_border_radius']").val(0);
        }

        $("input[name='grid_one_border_radius']").prev().slider({
            value: $("input[name='grid_one_border_radius']").val()
        });


        //Border
        var apply_for = $(option_open_for).attr('data-border-apply-for');
        $('#grid_one_border_apply_for option[value="' + apply_for + '"]').attr("selected", "selected");

        var border_type = $(option_open_for).attr('data-border-type');
        $('#grid_one_border_type option[value="' + border_type + '"]').attr("selected", "selected");

        if (apply_for == 'inner') {

            var border_style = $(option_open_for).find('.sub-parent > .element-groups').prop('style')['border-style'];
            $('#grid_one_border_style option[value="' + border_style + '"]').attr("selected", "selected");

            var border_size = $(option_open_for).find('.sub-parent > .element-groups').prop('style')['border-width'];
            $('#grid_one_border_size option[value="' + border_size + '"]').attr("selected", "selected");

            $("#grid_one_border_color").val(rgb2hex($(option_open_for).find('.sub-parent > .element-groups').prop('style')['border-color']));

        } else {

            var border_style = $(option_open_for).prop('style')['border-style'];
            $('#grid_one_border_style option[value="' + border_style + '"]').attr("selected", "selected");

            var border_size = $(option_open_for).prop('style')['border-width'];
            $('#grid_one_border_size option[value="' + border_size + '"]').attr("selected", "selected");

            $("#grid_one_border_color").val(rgb2hex($(option_open_for).prop('style')['border-color']));
        }


        //bg image
        if (($(option_open_for).attr('data-bg-position'))) {

            //position
            var pos = $(option_open_for).attr('data-bg-position');
            $('#grid_one_image_position option[value="' + pos + '"]').attr("selected", "selected");
        }

        //alert($(option_open_for).attr('data-bg-image'));
        if (typeof $(option_open_for).attr('data-bg-image') != 'undefined') {
            $("#grid_one_bg_image").val($(option_open_for).attr('data-bg-image'));
        } else {
            $("#grid_one_bg_image").val("");
        }


        //container bg opacity
        if (typeof $(option_open_for).attr('data-container-bg-opacity') != 'undefined') {
            $("#grid_one_container_bg_opacity").val($(option_open_for).attr('data-container-bg-opacity'));
        } else {
            $("#grid_one_container_bg_opacity").val("");
        }

        //padding
        //alert($(option_open_for).attr('id'));
        $("input[name='grid_setting_padding_top']").val($(option_open_for).prop('style')['padding-top'].split('px')[0]);
        $("input[name='grid_setting_padding_top']").prev().slider({
            value: $("input[name='grid_setting_padding_top']").val()
        });
        $("input[name='grid_setting_padding_right']").val($(option_open_for).prop('style')['padding-right'].split('px')[0]);
        $("input[name='grid_setting_padding_right']").prev().slider({
            value: $("input[name='grid_setting_padding_right']").val()
        });
        $("input[name='grid_setting_padding_bottom']").val($(option_open_for).prop('style')['padding-bottom'].split('px')[0]);
        $("input[name='grid_setting_padding_bottom']").prev().slider({
            value: $("input[name='grid_setting_padding_bottom']").val()
        });
        $("input[name='grid_setting_padding_left']").val($(option_open_for).prop('style')['padding-left'].split('px')[0]);
        $("input[name='grid_setting_padding_left']").prev().slider({
            value: $("input[name='grid_setting_padding_left']").val()
        });

        //margin
        $("input[name='grid_setting_margin_top']").val($(option_open_for).prop('style')['margin-top'].split('px')[0]);
        $("input[name='grid_setting_margin_top']").prev().slider({
            value: $("input[name='grid_setting_margin_top']").val()
        });

        $("input[name='grid_setting_margin_bottom']").val($(option_open_for).prop('style')['margin-bottom'].split('px')[0]);
        $("input[name='grid_setting_margin_bottom']").prev().slider({
            value: $("input[name='grid_setting_margin_bottom']").val()
        });

        //shadows
        try {
            //console.log($(option_open_for).prop('style')['box-shadow'].length);

            if ($(option_open_for).prop('style')['box-shadow'].length > 0) {
                var g_box_shadow_items = $(option_open_for).prop('style')['box-shadow'].split('px');
                //console.log(g_box_shadow_items);
                $("input[name='grid_setting_shadow']").val(g_box_shadow_items[2]);
                $("input[name='grid_setting_shadow']").prev().slider({
                    value: $("input[name='grid_setting_shadow']").val()
                });
            } else {
                $("input[name='grid_setting_shadow']").val(0);
                $("input[name='grid_setting_shadow']").prev().slider({
                    value: $("input[name='grid_setting_shadow']").val()
                });
            }
        } catch (err) {
        }
    });

    //GRID 2 setting
    $(document).on('click', '.grid-two-setings-modal', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        $("#grid2_setting_padding").val($(option_open_for).css('padding-top'));

        $("#text_color").val(rgb2hex($(option_open_for).css('color')));
        $("#bg_color").val(rgb2hex($(option_open_for).css('background')));
    });

    //GRID 3 setting
    $(document).on('click', '.grid-three-setings-modal', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        $("#text_color").val(rgb2hex($(option_open_for).css('color')));
        $("#bg_color").val(rgb2hex($(option_open_for).css('background')));
    });

    //GRID 4 setting
    $(document).on('click', '.grid-four-setings-modal', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        $("#text_color").val(rgb2hex($(option_open_for).css('color')));
        $("#bg_color").val(rgb2hex($(option_open_for).css('background')));
    });


    //Header Row Setting
    $(document).on('click', '.open-header-row-setings-modal', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        //row type
        var row_type = $(option_open_for).attr('data-row-type');
        if (row_type == '') {
            $('#header_row_type option[value=""]').attr("selected", "selected");
        } else if (row_type == 'large') {
            $('#header_row_type option[value="large"]').attr("selected", "selected");
        }

        //$("#row_setting_padding").val($(option_open_for).css('padding-top'));
        //$("#row_setting_margin").val($(option_open_for).css('margin-top'));

        $("#header_row_text_color").val($(option_open_for).prop('style')['color']);
        $("#header_row_bg_color").val($(option_open_for).prop('style')['background-color']);


        //bg image
        if (($(option_open_for).attr('data-bg-position'))) {

            //position
            var pos = $(option_open_for).attr('data-bg-position');
            $('#header_row_background_image_position option[value="' + pos + '"]').attr("selected", "selected");
        }

        if ($(option_open_for).prop('style')['background-image']) {
            //$("#header_row_setting_image_path").val($(option_open_for).prop('style')['background-image']);
            $("#header_row_setting_image_path").val($(option_open_for).attr('data-bg-image'));
        }


        //alert($(option_open_for).css('padding-top'));

        //padding
        $("input[name='header_row_padding_top']").val($(option_open_for).find('.lb-content-body').css('padding-top').split('px')[0]);
        $("input[name='header_row_padding_top']").prev().slider({
            value: $("input[name='header_row_padding_top']").val()
        });
        $("input[name='header_row_padding_right']").val($(option_open_for).find('.lb-content-body').css('padding-right').split('px')[0]);
        $("input[name='header_row_padding_right']").prev().slider({
            value: $("input[name='header_row_padding_right']").val()
        });
        $("input[name='header_row_padding_bottom']").val($(option_open_for).find('.lb-content-body').css('padding-bottom').split('px')[0]);
        $("input[name='header_row_padding_bottom']").prev().slider({
            value: $("input[name='header_row_padding_bottom']").val()
        });
        $("input[name='header_row_padding_left']").val($(option_open_for).find('.lb-content-body').css('padding-left').split('px')[0]);
        $("input[name='header_row_padding_left']").prev().slider({
            value: $("input[name='header_row_padding_left']").val()
        });

        //margin
        /*$("input[name='header_row_margin_top']").val($(option_open_for).css('margin-top').split('px')[0]);
        $("input[name='header_row_margin_top']").prev().slider({value: $("input[name='header_row_margin_top']").val()});
        $("input[name='header_row_margin_right']").val($(option_open_for).css('margin-top').split('px')[0]);
        $("input[name='header_row_margin_right']").prev().slider({value: $("input[name='header_row_margin_right']").val()});
        $("input[name='header_row_margin_bottom']").val($(option_open_for).css('margin-top').split('px')[0]);
        $("input[name='header_row_margin_bottom']").prev().slider({value: $("input[name='header_row_margin_bottom']").val()});
        $("input[name='header_row_margin_left']").val($(option_open_for).css('margin-top').split('px')[0]);
        $("input[name='header_row_margin_left']").prev().slider({value: $("input[name='header_row_margin_left']").val()});*/

    });


    //Row setting
    $(document).on('click', '.open-row-setings-modal', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        //row type
        var row_type = $(option_open_for).attr('data-row-type');
        if (row_type == '') {
            $('#row_type option[value=""]').attr("selected", "selected");
        } else if (row_type == 'small') {
            $('#row_type option[value="small"]').attr("selected", "selected");
        } else if (row_type == 'big') {
            $('#row_type option[value="large"]').attr("selected", "selected");
        }

        var content_width = $(option_open_for).attr('data-content-width');
        $('#row_setting_content_width option[value="' + content_width + '"]').attr("selected", "selected");

        //$("#row_setting_padding").val($(option_open_for).css('padding-top'));
        //$("#row_setting_margin").val($(option_open_for).css('margin-top'));

        //alert($(option_open_for).prop('style')['background-color']);

        $("#row_setting_text_color").val(rgb2hex($(option_open_for).prop('style')['color']));
        //$("#row_setting_text_color").css('background-color', $("#row_setting_text_color").val());
        $("#row_setting_text_color").css('color', $("#row_setting_text_color").val());

        $("#row_setting_bg_color").val(rgb2hex($(option_open_for).prop('style')['background-color']));
        //$("#row_setting_bg_color").css('background-color', $("#row_setting_bg_color").val());
        //$("#row_setting_bg_color").css('color', $("#row_setting_bg_color").val());


        //bg image
        if (($(option_open_for).attr('data-bg-position'))) {

            //position
            var pos = $(option_open_for).attr('data-bg-position');
            $('#row_background_image_position option[value="' + pos + '"]').attr("selected", "selected");
        }

        if ($(option_open_for).prop('style')['background-image']) {
            $("#row_setting_image_path").val($(option_open_for).attr('data-bg-image'));
        }


        //Border
        /*var border_type = $(option_open_for).find('.row-groups').prop('style')['border-style'];
        $('#row_setting_border_style option[value="' + border_type + '"]').attr("selected", "selected");
        $("#row_setting_border_color").val(rgb2hex($(option_open_for).find('.row-groups').prop('style')['border-color']));
        $("input[name='row_setting_border_size']").val($(option_open_for).find('.row-groups').prop('style')['border-width'].split('px')[0]);
        $("input[name='row_setting_border_size']").prev().slider({
            value: $("input[name='row_setting_border_size']").val()
        });*/

        var border_type = $(option_open_for).find('.row-groups').prop('style')['border-style'];
        $('#row_setting_border_style option[value="' + border_type + '"]').attr("selected", "selected");
        $("#row_setting_border_color").val(rgb2hex($(option_open_for).find('.row-groups').prop('style')['border-color']));
        $("input[name='row_setting_border_size']").val($(option_open_for).find('.row-groups').prop('style')['border-width'].split('px')[0]);
        $("input[name='row_setting_border_size']").prev().slider({
            value: $("input[name='row_setting_border_size']").val()
        });

        $("input[name='row_setting_border_radius']").val($(option_open_for).find('.row-groups').prop('style')['border-radius'].split('px')[0]);
        $("input[name='row_setting_border_radius']").prev().slider({
            value: $("input[name='row_setting_border_radius']").val()
        });


        //padding
        $("input[name='row_padding_top']").val($(option_open_for).find('.row-groups').prop('style')['padding-top'].split('px')[0]);
        $("input[name='row_padding_top']").prev().slider({
            value: $("input[name='row_padding_top']").val()
        });
        $("input[name='row_padding_right']").val($(option_open_for).find('.row-groups').prop('style')['padding-right'].split('px')[0]);
        $("input[name='row_padding_right']").prev().slider({
            value: $("input[name='row_padding_right']").val()
        });
        $("input[name='row_padding_bottom']").val($(option_open_for).find('.row-groups').prop('style')['padding-bottom'].split('px')[0]);
        $("input[name='row_padding_bottom']").prev().slider({
            value: $("input[name='row_padding_bottom']").val()
        });
        $("input[name='row_padding_left']").val($(option_open_for).find('.row-groups').prop('style')['padding-left'].split('px')[0]);
        $("input[name='row_padding_left']").prev().slider({
            value: $("input[name='row_padding_left']").val()
        });

        //margin
        /*$("input[name='row_margin_top']").val($(option_open_for).css('margin-top').split('px')[0]);
        $("input[name='row_margin_top']").prev().slider({value: $("input[name='row_margin_top']").val()});
        $("input[name='row_margin_right']").val($(option_open_for).css('margin-top').split('px')[0]);
        $("input[name='row_margin_right']").prev().slider({value: $("input[name='row_margin_right']").val()});
        $("input[name='row_margin_bottom']").val($(option_open_for).css('margin-top').split('px')[0]);
        $("input[name='row_margin_bottom']").prev().slider({value: $("input[name='row_margin_bottom']").val()});
        $("input[name='row_margin_left']").val($(option_open_for).css('margin-top').split('px')[0]);
        $("input[name='row_margin_left']").prev().slider({value: $("input[name='row_margin_left']").val()});*/

    });


    //Date Countdown setting
    $(document).on('click', '.open_date_countdown_settings', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        $("#end_date").val($(option_open_for).find('.date-countdown ul').attr('data-end-date'));
        $("#end_time").val($(option_open_for).find('.date-countdown ul').attr('data-end-time'));

        //action
        var action_type = $(option_open_for).find('.date-countdown').attr('data-action-type');
        if (action_type == '') {
            $('#countdown_settings_after_timer_over_action option[value=""]').attr("selected", "selected");
            $("#countdown_settings_action_url").hide();
        } else if (action_type == 'go_to_page') {
            $('#countdown_settings_after_timer_over_action option[value="go_to_page"]').attr("selected", "selected");
            $("#countdown_settings_action_url").val($(option_open_for).find('.date-countdown').attr('data-action-url'));
            $("#countdown_settings_action_url").show();
        }

        //colors
        $("#date_countdown_timer_color").val(rgb2hex($(option_open_for).find('.date-countdown li > strong').prop('style')['color']));
        $("#date_countdown_text_color").val(rgb2hex($(option_open_for).find('.date-countdown li > p').prop('style')['color']));
        try {
            //$("#date_countdown_seperator_color").val(rgb2hex($(option_open_for).find('.date-countdown li.dc-seperator > span').css('color')));
        } catch (err) {
        }
        $("#date_countdown_bg_color").val(rgb2hex($(option_open_for).find('.date-countdown li > strong').prop('style')['background-color']));

        //padding
        $("input[name='date_countdown_padding_top']").val($(option_open_for).find('.wrapper').prop('style')['padding-top'].split('px')[0]);
        $("input[name='date_countdown_padding_top']").prev().slider({
            value: $("input[name='date_countdown_padding_top']").val()
        });
        $("input[name='date_countdown_padding_right']").val($(option_open_for).find('.wrapper').prop('style')['padding-right'].split('px')[0]);
        $("input[name='date_countdown_padding_right']").prev().slider({
            value: $("input[name='date_countdown_padding_right']").val()
        });
        $("input[name='date_countdown_padding_bottom']").val($(option_open_for).find('.wrapper').prop('style')['padding-bottom'].split('px')[0]);
        $("input[name='date_countdown_padding_bottom']").prev().slider({
            value: $("input[name='date_countdown_padding_bottom']").val()
        });
        $("input[name='date_countdown_padding_left']").val($(option_open_for).find('.wrapper').prop('style')['padding-left'].split('px')[0]);
        $("input[name='date_countdown_padding_left']").prev().slider({
            value: $("input[name='date_countdown_padding_left']").val()
        });

        //margin
        $("input[name='date_countdown_margin_top']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='date_countdown_margin_top']").prev().slider({
            value: $("input[name='date_countdown_margin_top']").val()
        });
        $("input[name='date_countdown_margin_right']").val($(option_open_for).find('.wrapper').prop('style')['margin-right'].split('px')[0]);
        $("input[name='date_countdown_margin_right']").prev().slider({
            value: $("input[name='date_countdown_margin_right']").val()
        });
        $("input[name='date_countdown_margin_bottom']").val($(option_open_for).find('.wrapper').prop('style')['margin-bottom'].split('px')[0]);
        $("input[name='date_countdown_margin_bottom']").prev().slider({
            value: $("input[name='date_countdown_margin_bottom']").val()
        });
        $("input[name='date_countdown_margin_left']").val($(option_open_for).find('.wrapper').prop('style')['margin-left'].split('px')[0]);
        $("input[name='date_countdown_margin_left']").prev().slider({
            value: $("input[name='date_countdown_margin_left']").val()
        });
    });

    $("#countdown_settings_after_timer_over_action").change(function (e) {

        e.preventDefault();

        if ($(this).val() == 'go_to_page') {
            $("#countdown_settings_action_url").show();
        } else {
            $("#countdown_settings_action_url").hide();
        }
    });


    //Text block setting
    $(document).on('click', '.open-text-block-settings', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        //alert($(option_open_for).find('.wrapper > b').html());

        $("#textblock_headline_text").val($(option_open_for).find('.wrapper > b').html());
        //$("#sub_headline_text").val($(option_open_for).find('.wrapper > p').html());

        //headline color
        //alert($(option_open_for).find('.wrapper > b').attr('style'));
        if ($(option_open_for).find('.wrapper > b').attr('style') != null)
            $("#textblock_headline_text_color").val(rgb2hex($(option_open_for).find('.wrapper > b').prop('style')['color']));

        //paragraph color
        if ($(option_open_for).find('.wrapper > div').attr('style') != null)
            $("#textblock_paragraph_color").val(rgb2hex($(option_open_for).find('.wrapper > div').css('color')));

        $('#text_clock_html_editor').summernote('code', $(option_open_for).find('.wrapper > b').next().html());


        //font
        var family_headline = $(option_open_for).find('.wrapper > b').prop('style')['font-family'];
        if (family_headline != "")
            $('#text_block_headline_font_family option[value=' + family_headline + ']').attr("selected", "selected");
        else
            $('#text_block_headline_font_family option[value=Nunito]').attr("selected", "selected");

        var family_paragraph = $(option_open_for).find('.wrapper > div').prop('style')['font-family'];
        if (family_paragraph != "")
            $('#text_block_paragraph_font_family option[value=' + family_paragraph + ']').attr("selected", "selected");
        else
            $('#text_block_paragraph_font_family option[value=Nunito]').attr("selected", "selected");


        //action
        var align = $(option_open_for).find('.wrapper > b').prop('style')['text-align'];
        $('#text_block_setting_align option[value="' + align + '"]').attr("selected", "selected");

        var paragraph_align = $(option_open_for).find('.wrapper > div').prop('style')['text-align'];
        $('#text_block_setting_paragraph_align option[value="' + paragraph_align + '"]').attr("selected", "selected");

        //heading font size
        if ($(option_open_for).find('.wrapper > b').prop('style')['font-size'].split('px')[0].length > 0)
            $("input[name='text_block_heading_font_size']").val($(option_open_for).find('.wrapper > b').prop('style')['font-size'].split('px')[0]);
        else
            $("input[name='text_block_heading_font_size']").val(DEFAULT_TEXT_BLOCK_HEADLINE_FONT_SIZE);
        $("input[name='text_block_heading_font_size']").prev().slider({
            value: $("input[name='text_block_heading_font_size']").val()
        });


        //paragraph font size
        if ($(option_open_for).find('.wrapper > div').prop('style')['font-size'].split('px')[0].length > 0)
            $("input[name='text_block_paragraph_font_size']").val($(option_open_for).find('.wrapper > div').prop('style')['font-size'].split('px')[0]);
        else
            $("input[name='text_block_paragraph_font_size']").val(DEFAULT_TEXT_BLOCK_PARAGRAPH_FONT_SIZE);
        $("input[name='text_block_paragraph_font_size']").prev().slider({
            value: $("input[name='text_block_paragraph_font_size']").val()
        });


        //gap
        if ($(option_open_for).find('.wrapper > div').prop('style')['padding-top'].split('px')[0].length > 0)
            $("input[name='text_block_headline_gap']").val($(option_open_for).find('.wrapper > div').prop('style')['padding-top'].split('px')[0]);
        else
            $("input[name='text_block_headline_gap']").val(DEFAULT_TEXT_BLOCK_HEADLINE_PARAGRAPH_GAP);
        $("input[name='text_block_headline_gap']").prev().slider({
            value: $("input[name='text_block_headline_gap']").val()
        });

        //Line Height
        //alert($(option_open_for).find('.wrapper > p').prop('style')['line-height'].split('px')[0]);
        //alert($(option_open_for).find('.wrapper > p, .wrapper > div').prop('style')['line-height'].split('px')[0]);

        if ($(option_open_for).find('.wrapper > p, .wrapper > div').prop('style')['line-height'].split('px')[0].length > 0) {
            $("input[name='text_block_line_height']").val($(option_open_for).find('.wrapper > p, .wrapper > div').prop('style')['line-height'].split('px')[0]);
        } else {
            $("input[name='text_block_line_height']").val(DEFAULT_PARAGRAPH_LINE_HEIGHT);
        }

        $("input[name='text_block_line_height']").prev().slider({
            value: $("input[name='text_block_line_height']").val()
        });

        //padding
        $("input[name='text_block_padding_top']").val($(option_open_for).find('.wrapper').prop('style')['padding-top'].split('px')[0]);
        $("input[name='text_block_padding_top']").prev().slider({
            value: $("input[name='text_block_padding_top']").val()
        });
        $("input[name='text_block_padding_right']").val($(option_open_for).find('.wrapper').prop('style')['padding-right'].split('px')[0]);
        $("input[name='text_block_padding_right']").prev().slider({
            value: $("input[name='text_block_padding_right']").val()
        });
        $("input[name='text_block_padding_bottom']").val($(option_open_for).find('.wrapper').prop('style')['padding-bottom'].split('px')[0]);
        $("input[name='text_block_padding_bottom']").prev().slider({
            value: $("input[name='text_block_padding_bottom']").val()
        });
        $("input[name='text_block_padding_left']").val($(option_open_for).find('.wrapper').prop('style')['padding-left'].split('px')[0]);
        $("input[name='text_block_padding_left']").prev().slider({
            value: $("input[name='text_block_padding_left']").val()
        });

        //margin
        $("input[name='text_block_margin_top']").val($(option_open_for).find('.wrapper').parent().prop('style')['margin-top'].split('px')[0]);
        $("input[name='text_block_margin_top']").prev().slider({
            value: $("input[name='text_block_margin_top']").val()
        });
        $("input[name='text_block_margin_right']").val($(option_open_for).find('.wrapper').parent().prop('style')['margin-right'].split('px')[0]);
        $("input[name='text_block_margin_right']").prev().slider({
            value: $("input[name='text_block_margin_right']").val()
        });
        $("input[name='text_block_margin_bottom']").val($(option_open_for).find('.wrapper').parent().prop('style')['margin-bottom'].split('px')[0]);
        $("input[name='text_block_margin_bottom']").prev().slider({
            value: $("input[name='text_block_margin_bottom']").val()
        });
        $("input[name='text_block_margin_left']").val($(option_open_for).find('.wrapper').parent().prop('style')['margin-left'].split('px')[0]);
        $("input[name='text_block_margin_left']").prev().slider({
            value: $("input[name='text_block_margin_left']").val()
        });

    });


    //Button block setting
    $(document).on('click', '.open-button-setings-modal', function (e) {

        option_open_for = $(this).parent().parent().parent();
        settingsOpenModal = $(this).attr('data-target');

        //$("#frm_button_settings").trigger('reset')
        //document.getElementById("frm_button_settings").reset();
        //$('#frm_button_settings').trigger("reset");
        //$("#frm_button_settings").get(0).reset();
        $("#frm_button_settings").find('input, select').val('');

        //action
        //alert($(option_open_for).find('.wrapper > a').attr('data-url'));
        var action = $(option_open_for).find('.wrapper > a').attr('data-url');
        //alert(action);
        //$('#button_action option[value="' + action + '"]').attr("selected", "selected");
        $('#button_action').val(action);
        $('#button_action').trigger('change');

        $("#button_settings_goto_link").hide();

        if (action == 'goto_section') {
            var href = $(option_open_for).find('.wrapper > a').attr('href').split('#')[1];
            //alert(href);
            $("#button_section_id").val(href);
        } else if (action == 'goto_link') {
            $("#button_settings_goto_link").show();
            $("#button_setting_goto_link_url").val($(option_open_for).find('.wrapper > a').attr('href'));
            $("#button_setting_goto_link_behaviour").val($(option_open_for).find('.wrapper > a').attr('data-link-open-behaviour'));
        } else if (action == 'integration_data') {
            $("#integration_data_section").show();
            $("#integration_data_behaviour").val($(option_open_for).find('.wrapper > a').attr('data-integration-process-after'));
        }

        /*if ( action == '' ) {
            $("#button_action").val('');
        } else if (action == 'next_step') {
            $('#button_action option[value="next_step"]').attr("selected", "selected");
        } else if (action == 'open_video') {
            $('#button_action option[value="open_video"]').attr("selected", "selected");
        } else if (action == 'add_to_cart') {
            $('#button_action option[value="add_to_cart"]').attr("selected", "selected");
        } else if (action == 'submit') {
            $('#button_action option[value="submit"]').attr("selected", "selected");
        }*/

        //text
        $("#button_text").val($(option_open_for).find('.wrapper > a > span').text());
        $("#simple_button_secondary_text").val($(option_open_for).find('.wrapper > a > p').text());

        //type
        var type = $(option_open_for).find('.wrapper > a').attr('data-button-type');
        if (type == '') {
            $('#button_type option[value=""]').attr("selected", "selected");
        } else if (type == 'full') {
            $('#button_type option[value="full"]').attr("selected", "selected");
        } else if (type == 'large') {
            $('#button_type option[value="large"]').attr("selected", "selected");
        } else if (type == 'full_large') {
            $('#button_type option[value="full_large"]').attr("selected", "selected");
        }

        //style
        var style = $(option_open_for).find('.wrapper > a').attr('data-button-style');
        $('#button_style option[value="' + style + '"]').attr("selected", "selected");

        //align
        var align = $(option_open_for).find('.wrapper').attr('data-button-align');
        //alert(align);
        $('#button_alignment option[value="' + align + '"]').attr("selected", "selected");

        //Font size
        //alert($(option_open_for).find('.wrapper a').prop('style')['font-size'].split('px')[0]);
        //$("#button_font_size").val($(option_open_for).find('.wrapper > a').css('font-size'));

        $("input[name='button_font_size']").val($(option_open_for).find('.wrapper > a > span').prop('style')['font-size'].split('px')[0]);
        $("input[name='button_font_size']").prev().slider({
            value: $("input[name='button_font_size']").val()
        });

        //alert($(option_open_for).find('.wrapper > a > p').length);

        if ($(option_open_for).find('.wrapper > a > p').length > 0) {
            $("input[name='button_secondary_font_size']").val($(option_open_for).find('.wrapper > a > p').prop('style')['font-size'].split('px')[0]);
            $("input[name='button_secondary_font_size']").prev().slider({
                value: $("input[name='button_secondary_font_size']").val()
            });
        } else {
            $("input[name='button_secondary_font_size']").val(0);
        }

        //padding
        //$("#button_padding_top").val($(option_open_for).find('.wrapper > a').css('padding-top'));
        //$("#button_padding_bottom").val($(option_open_for).find('.wrapper > a').css('padding-bottom'));


        //padding
        $("input[name='button_padding_top']").val($(option_open_for).find('.wrapper > a').prop('style')['padding-top'].split('px')[0]);
        $("input[name='button_padding_top']").prev().slider({
            value: $("input[name='button_padding_top']").val()
        });
        $("input[name='button_padding_right']").val($(option_open_for).find('.wrapper > a').prop('style')['padding-right'].split('px')[0]);
        $("input[name='button_padding_right']").prev().slider({
            value: $("input[name='button_padding_right']").val()
        });
        $("input[name='button_padding_bottom']").val($(option_open_for).find('.wrapper > a').prop('style')['padding-bottom'].split('px')[0]);
        $("input[name='button_padding_bottom']").prev().slider({
            value: $("input[name='button_padding_bottom']").val()
        });
        $("input[name='button_padding_left']").val($(option_open_for).find('.wrapper > a').prop('style')['padding-left'].split('px')[0]);
        $("input[name='button_padding_left']").prev().slider({
            value: $("input[name='button_padding_left']").val()
        });

        //margin
        $("input[name='button_margin_top']").val($(option_open_for).find('.wrapper').prop('style')['margin-top'].split('px')[0]);
        $("input[name='button_margin_top']").prev().slider({
            value: $("input[name='button_margin_top']").val()
        });
        $("input[name='button_margin_right']").val($(option_open_for).find('.wrapper').prop('style')['margin-right'].split('px')[0]);
        $("input[name='button_margin_right']").prev().slider({
            value: $("input[name='button_margin_right']").val()
        });
        $("input[name='button_margin_bottom']").val($(option_open_for).find('.wrapper').prop('style')['margin-bottom'].split('px')[0]);
        $("input[name='button_margin_bottom']").prev().slider({
            value: $("input[name='button_margin_bottom']").val()
        });
        $("input[name='button_margin_left']").val($(option_open_for).find('.wrapper').prop('style')['margin-left'].split('px')[0]);
        $("input[name='button_margin_left']").prev().slider({
            value: $("input[name='button_margin_left']").val()
        });

        if ($(option_open_for).find('.wrapper > a').prop('style')['border-radius'].split('px')[0] > 0) {
            $("input[name='button_border_radius']").val($(option_open_for).find('.wrapper > a').prop('style')['border-radius'].split('px')[0]);
        } else {
            $("input[name='button_border_radius']").val(0);
        }
        $("input[name='button_border_radius']").prev().slider({
            value: $("input[name='button_border_radius']").val()
        });

        //text color
        $("#button_text_color").val(rgb2hex($(option_open_for).find('.wrapper > a').css('color')));

        //bg color
        $("#button_bg_color").val(rgb2hex($(option_open_for).find('.wrapper > a').css('background-color')));

        //icon
        $(".icon-picker-button").click(function (e) {

            icon_container_button = $(this);
        });

        if (typeof $(option_open_for).find('.wrapper > a').find('.button-icon') != 'undefined') {

            var button_icon = $(option_open_for).find('.wrapper > a > span').find('.button-icon');

            if (typeof $(option_open_for).find('.wrapper > a').attr('show-icon') != 'undefined')
                $("#button_enable_icon").attr('checked', $(option_open_for).find('.wrapper > a').attr('show-icon'));
            else
                $("#button_enable_icon").attr('checked', false);

            $(".icon-picker-button > i").attr('class', 'fa ' + $(button_icon).attr('data-icon'));
            $("input[name='hid_selected_icon']").val('fa ' + $(button_icon).attr('data-icon'));

            var icon_pos = $(button_icon).attr('data-position');
            if (icon_pos != '')
                $('#button_icon_position option[value="' + icon_pos + '"]').attr("selected", "selected");
            else
                $('#button_icon_position option[value="left"]').attr("selected", "selected");

            if ($(button_icon).attr('data-icon-size') > 0) {
                $("input[name='button_icon_size']").val($(button_icon).attr('data-icon-size'));
            } else {
                $("input[name='button_icon_size']").val(14);
            }

            $("input[name='button_icon_size']").prev().slider({
                value: $("input[name='button_icon_size']").val()
            });
        }
    });


    /* ================================================================ EDITOR SETTINGS SAVE ============================================ */


    //CUSTOM BLOCK SAVE
    $(document).on('click', '#html_block_setting_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_html_block_settings').serializeObject());
        //console.log(data);
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();

        $(option_open_for).find('.wrapper > div').html(json.html_block_custom_html); //data-select-name

        //Colors
        $(option_open_for).find('.wrapper').css('background-color', json.html_block_bg_color);


        $(option_open_for).find('.wrapper > div').css('padding-top', json.html_block_padding_top + 'px');
        $(option_open_for).find('.wrapper > div').css('padding-right', json.html_block_padding_right + 'px');
        $(option_open_for).find('.wrapper > div').css('padding-bottom', json.html_block_padding_bottom + 'px');
        $(option_open_for).find('.wrapper > div').css('padding-left', json.html_block_padding_left + 'px');

        $(option_open_for).find('.wrapper').css('margin-top', json.html_block_margin_top + 'px');
        $(option_open_for).find('.wrapper').css('margin-right', json.html_block_margin_right + 'px');
        $(option_open_for).find('.wrapper').css('margin-bottom', json.html_block_margin_bottom + 'px');
        $(option_open_for).find('.wrapper').css('margin-left', json.html_block_margin_left + 'px');

        $(settingsOpenModal).modal('hide');
    });


    //SOCIAL BUTTON SAVE
    $(document).on('click', '#social_share_buttons_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_social_share_buttons').serializeObject());
        //console.log(data);
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();


        //settings
        $(option_open_for).find('.social-button-data').attr('data-share-url', json.social_share_button_url);
        $(option_open_for).find('.social-button-data').attr('data-share-title', json.social_share_title);

        //buttons
        if ($(".social-button-items").length > 0) {

            var new_html = "";
            //alert(json.social_share_buttons_width);
            var button_width = json.social_share_buttons_width;
            var button_line_height = json.social_share_buttons_line_height;

            $(".social-button-items").each(function (index, element) {

                ////console.log($(element).find('select[name="social_button_type"]').get(index).val());

                var button_type = $(element).find('#social_button_type').val();
                var button_image = $(element).find('input[name="path"]').val();
                var share_url = "";
                var share_image = "";
                if (button_type == 'facebook') {
                    share_url = "https://www.facebook.com/sharer.php?u=" + json.social_share_button_url;
                } else if (button_type == 'google') {
                    share_url = "https://plus.google.com/share?url=" + json.social_share_button_url + "&text=" + json.social_share_title + "&hl=en";
                } else if (button_type == 'twitter') {
                    share_url = "https://twitter.com/intent/tweet?url=" + json.social_share_button_url + "&text=" + json.social_share_title;
                }
                share_image = "<img src='" + button_image + "' style='width: " + button_width + "%'>";

                new_html += "<li data-button-type='" + button_type + "' data-button-image='" + button_image + "' style='line-height: " + button_line_height + "px'>";
                new_html += "<a href='" + share_url + "' target='_blank'>";
                new_html += share_image;
                new_html += "</a>";
                new_html += "</li>"
            });

            $(option_open_for).find('.social-share-buttons').attr('data-button-width', button_width + '%');
            $(option_open_for).find('.social-share-buttons').attr('data-has-buttons', true);
            $(option_open_for).find('.social-share-buttons').html(new_html); //data-has-buttons
        } else {
            $(option_open_for).find('.social-share-buttons').attr('data-has-buttons', false);
            $(option_open_for).find('.social-share-buttons').html("Add Social Buttons"); //data-has-buttons
        }

        $(option_open_for).find('.wrapper').css('padding-top', json.social_share_buttons_padding_top + 'px');
        $(option_open_for).find('.wrapper').css('padding-right', json.social_share_buttonspadding_right + 'px');
        $(option_open_for).find('.wrapper').css('padding-bottom', json.social_share_buttons_padding_bottom + 'px');
        $(option_open_for).find('.wrapper').css('padding-left', json.social_share_buttons_padding_left + 'px');

        $(option_open_for).find('.wrapper').css('margin-top', json.social_share_buttons_margin_top + 'px');
        $(option_open_for).find('.wrapper').css('margin-right', json.social_share_buttons_margin_right + 'px');
        $(option_open_for).find('.wrapper').css('margin-bottom', json.social_share_buttons_margin_bottom + 'px');
        $(option_open_for).find('.wrapper').css('margin-left', json.social_share_buttons_margin_left + 'px');

        $(settingsOpenModal).modal('hide');
    });


    //PAYMENT METHOD SAVE
    $(document).on('click', '#payment_method_setting_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_payment_method_settings').serializeObject());
        //console.log(data);
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();

        //alert(json.shipping_address_caption_text);
        //$(option_open_for).find('.text-field-wrapper > input[type="text"]').attr('name', json.text_field_input_type);
        $(option_open_for).find('.wrapper .section-title > span').text(json.payment_method_caption_text); //data-select-name
        $(option_open_for).find('.wrapper .section-title > p').text(json.payment_method_info_text); //data-select-name

        //Colors
        $(option_open_for).find('.wrapper .section-title > span').css('color', json.payment_method_caption_text_color);
        $(option_open_for).find('.wrapper .section-title > p').css('color', json.payment_method_info_text_color);

        //Font size
        $(option_open_for).find('.wrapper .section-title > span').css('font-size', json.payment_method_caption_text_font_size + 'px');
        $(option_open_for).find('.wrapper .section-title > p').css('font-size', json.payment_method_info_text_font_size + 'px');

        $(option_open_for).find('.wrapper').css('padding-top', json.payment_method_padding_top + 'px');
        $(option_open_for).find('.wrapper').css('padding-right', json.payment_method_padding_right + 'px');
        $(option_open_for).find('.wrapper').css('padding-bottom', json.payment_method_padding_bottom + 'px');
        $(option_open_for).find('.wrapper').css('padding-left', json.payment_method_padding_left + 'px');

        $(option_open_for).find('.wrapper').css('margin-top', json.payment_method_margin_top + 'px');
        $(option_open_for).find('.wrapper').css('margin-right', json.payment_method_margin_right + 'px');
        $(option_open_for).find('.wrapper').css('margin-bottom', json.payment_method_margin_bottom + 'px');
        $(option_open_for).find('.wrapper').css('margin-left', json.payment_method_margin_left + 'px');

        $(settingsOpenModal).modal('hide');
    });

    //CUSTOMER INFORMATION SAVE
    $(document).on('click', '#customer_info_setting_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_customer_info_settings').serializeObject());
        //console.log(data);
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();

        //alert(json.shipping_address_caption_text);
        //$(option_open_for).find('.text-field-wrapper > input[type="text"]').attr('name', json.text_field_input_type);
        $(option_open_for).find('.wrapper .section-title').text(json.customer_info_caption_text); //data-select-name

        //Colors
        $(option_open_for).find('.wrapper .section-title').css('color', json.customer_info_caption_text_color);
        $(option_open_for).find('.wrapper .section-title').css('background-color', json.customer_info_caption_text_bg_color);

        //Font size
        $(option_open_for).find('.wrapper .section-title').css('font-size', json.customer_info_caption_text_font_size + 'px');

        $(option_open_for).find('.wrapper').css('padding-top', json.customer_info_padding_top + 'px');
        $(option_open_for).find('.wrapper').css('padding-right', json.customer_info_padding_right + 'px');
        $(option_open_for).find('.wrapper').css('padding-bottom', json.customer_info_padding_bottom + 'px');
        $(option_open_for).find('.wrapper').css('padding-left', json.customer_info_padding_left + 'px');

        $(option_open_for).find('.wrapper').css('margin-top', json.customer_info_margin_top + 'px');
        $(option_open_for).find('.wrapper').css('margin-right', json.customer_info_margin_right + 'px');
        $(option_open_for).find('.wrapper').css('margin-bottom', json.customer_info_margin_bottom + 'px');
        $(option_open_for).find('.wrapper').css('margin-left', json.customer_info_margin_left + 'px');

        $(settingsOpenModal).modal('hide');
    });

    //CART SAVE
    $(document).on('click', '#cart_setting_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_cart_settings').serializeObject());
        //console.log(data);
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();

        //alert(json.shipping_address_caption_text);
        //$(option_open_for).find('.text-field-wrapper > input[type="text"]').attr('name', json.text_field_input_type);
        //$(option_open_for).find('.wrapper > .billing-form > .section-title').text(json.billing_address_caption_text); //data-select-name

        //Colors
        //alert(json.cart_setting_product_text_color);
        $(option_open_for).find('.product-description ul > li.description > span').css('color', json.cart_setting_product_text_color + ' !important');
        $(option_open_for).find('.wrapper ul.options > li > span').css('color', json.cart_setting_label_text_color);
        $(option_open_for).find('.wrapper ul > li > strong, .wrapper ul > li.price').css('color', json.cart_setting_price_text_color);

        $(option_open_for).find('.wrapper').css('padding-top', json.cart_setting_padding_top + 'px');
        $(option_open_for).find('.wrapper').css('padding-right', json.cart_setting_padding_right + 'px');
        $(option_open_for).find('.wrapper').css('padding-bottom', json.cart_setting_padding_bottom + 'px');
        $(option_open_for).find('.wrapper').css('padding-left', json.cart_setting_padding_left + 'px');

        $(option_open_for).find('.wrapper').css('billing-top', json.cart_setting_margin_top + 'px');
        $(option_open_for).find('.wrapper').css('billing-right', json.cart_setting_margin_right + 'px');
        $(option_open_for).find('.wrapper').css('billing-bottom', json.cart_setting_margin_bottom + 'px');
        $(option_open_for).find('.wrapper').css('billing-left', json.cart_setting_margin_left + 'px');

        $(settingsOpenModal).modal('hide');
    });


    //BILLING FORM/ADDRESS SAVE
    $(document).on('click', '#billing_address_setting_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_billing_address_settings').serializeObject());
        //console.log(data);
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();

        //alert(json.shipping_address_caption_text);
        //$(option_open_for).find('.text-field-wrapper > input[type="text"]').attr('name', json.text_field_input_type);
        $(option_open_for).find('.wrapper > .billing-form > .section-title').text(json.billing_address_caption_text); //data-select-name

        //Colors
        $(option_open_for).find('.wrapper > .billing-form > .section-title').css('color', json.billing_address_caption_text_color);
        $(option_open_for).find('.wrapper > .billing-form > .section-title').css('background-color', json.billing_address_caption_text_bg_color);

        //Font size
        $(option_open_for).find('.wrapper > .billing-form > .section-title').css('font-size', json.billing_address_caption_text_font_size + 'px');

        $(option_open_for).find('.wrapper > .billing-form').css('padding-top', json.billing_address_padding_top + 'px');
        $(option_open_for).find('.wrapper > .billing-form').css('padding-right', json.billing_address_padding_right + 'px');
        $(option_open_for).find('.wrapper > .billing-form').css('padding-bottom', json.billing_address_padding_bottom + 'px');
        $(option_open_for).find('.wrapper > .billing-form').css('padding-left', json.billing_address_padding_left + 'px');

        $(option_open_for).find('.wrapper').css('billing-top', json.billing_address_margin_top + 'px');
        $(option_open_for).find('.wrapper').css('billing-right', json.billing_address_margin_right + 'px');
        $(option_open_for).find('.wrapper').css('billing-bottom', json.billing_address_margin_bottom + 'px');
        $(option_open_for).find('.wrapper').css('billing-left', json.billing_address_margin_left + 'px');

        $(settingsOpenModal).modal('hide');
    });


    //SHIPPING FORM/ADDRESS SAVE
    $(document).on('click', '#shipping_address_setting_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_shipping_address_settings').serializeObject());
        //console.log(data);
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();

        //alert(json.shipping_address_caption_text);
        //$(option_open_for).find('.text-field-wrapper > input[type="text"]').attr('name', json.text_field_input_type);
        $(option_open_for).find('.wrapper > .shipping-form > .section-title').text(json.shipping_address_caption_text); //data-select-name

        //Colors
        $(option_open_for).find('.wrapper > .shipping-form > .section-title').css('color', json.shipping_address_caption_text_color);
        $(option_open_for).find('.wrapper > .shipping-form > .section-title').css('background-color', json.shipping_address_caption_text_bg_color);

        //Font size
        $(option_open_for).find('.wrapper > .shipping-form > .section-title').css('font-size', json.shipping_address_caption_text_font_size + 'px');

        $(option_open_for).find('.wrapper > .shipping-form').css('padding-top', json.shipping_address_padding_top + 'px');
        $(option_open_for).find('.wrapper > .shipping-form').css('padding-right', json.shipping_address_padding_right + 'px');
        $(option_open_for).find('.wrapper > .shipping-form').css('padding-bottom', json.shipping_address_padding_bottom + 'px');
        $(option_open_for).find('.wrapper > .shipping-form').css('padding-left', json.shipping_address_padding_left + 'px');

        $(option_open_for).find('.wrapper').css('margin-top', json.shipping_address_margin_top + 'px');
        $(option_open_for).find('.wrapper').css('margin-right', json.shipping_address_margin_right + 'px');
        $(option_open_for).find('.wrapper').css('margin-bottom', json.shipping_address_margin_bottom + 'px');
        $(option_open_for).find('.wrapper').css('margin-left', json.shipping_address_margin_left + 'px');

        $(settingsOpenModal).modal('hide');
    });


    //SELECT BOX
    $(document).on('click', '#select_box_settings_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_select_box_settings').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();

        //alert(settingsOpenModal);
        //$(option_open_for).find('.text-field-wrapper > input[type="text"]').attr('name', json.text_field_input_type);
        $(option_open_for).find('.select-box-wrapper > select').attr('data-select-name', json.select_box_custom_type_name); //data-select-name
        $(option_open_for).find('.select-box-wrapper > select').attr('name', 'integration[' + json.select_box_custom_type_name + ']'); //data-select-name
        $(option_open_for).find('.select-box-wrapper > select').attr('data-select-type', json.select_box_type);

        //$(option_open_for).find('.select-box-wrapper > select+#hid_integration_info').remove();
        //$(option_open_for).find('.select-box-wrapper > select').after("<input type='hidden' id='hid_integration_info' name='integration[" + json.select_box_custom_type_name + "]' />");


        //add option
        $(option_open_for).find('.select-box-wrapper > select').empty();
        $("#custom_option_select table > tbody > tr").each(function (index, element) {

            //alert($(element).find("td:first-child > input[type='text']").length);

            if ($(element).find("td:first-child > input[type='text']").length > 0) {
                var dataName = $(element).find("td:first-child > input[type='text']").val();
                var dataValue = $(element).find("td:last-child > input[type='text']").val();

                $(option_open_for).find('.select-box-wrapper > select').append("<option value='" + dataName + "'>" + dataValue + "</option>");
            }
        });


        //$(option_open_for).find('.text-field-wrapper > input[type="text"]').css('font-size', json.text_field_font_size + 'px');

        $(option_open_for).find('.select-box-wrapper > select').css('padding-top', json.select_box_padding_top + 'px');
        $(option_open_for).find('.select-box-wrapper > select').css('padding-right', json.select_box_padding_right + 'px');
        $(option_open_for).find('.select-box-wrapper > select').css('padding-bottom', json.select_box_padding_bottom + 'px');
        $(option_open_for).find('.select-box-wrapper > select').css('padding-left', json.select_box_padding_left + 'px');

        $(option_open_for).find('.select-box-wrapper').css('margin-top', json.select_box_margin_top + 'px');
        $(option_open_for).find('.select-box-wrapper').css('margin-right', json.select_box_margin_right + 'px');
        $(option_open_for).find('.select-box-wrapper').css('margin-bottom', json.select_box_margin_bottom + 'px');
        $(option_open_for).find('.select-box-wrapper').css('margin-left', json.select_box_margin_left + 'px');

        $(settingsOpenModal).modal('hide');
    });


    //POPUP
    $(document).on('click', '#text_page_popup_settings_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_page_popup_settings').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        //var $element = $(this).parent().parent();

        var element = $("#data_page_popup");
        var positions = json.page_popup_image_position;
        var background_image = (json.page_popup_bg_image.length > 0) ? "background-image: url('" + json.page_popup_bg_image + "');" : "";
        var str_bg_pos = "";
        var str_body_css = "";


        if (positions == 'bgCover') {
            str_bg_pos = 'background-size: cover !important; -webkit-background-size: cover !important; background-attachment: fixed !important; background-repeat: repeat repeat !important;';
        } else if (positions == 'bgCover100') {
            str_bg_pos = 'background-size: 100% auto !important; -webkit-background-size: 100% auto !important; background-repeat: no-repeat !important;';
        } else if (positions == 'bgNoRepeat') {
            str_bg_pos = 'background-repeat: no-repeat !important;';
        } else if (positions == 'bgRepeatX') {
            str_bg_pos = 'background-repeat: repeat-x !important;';
        } else if (positions == 'bgRepeatY') {
            str_bg_pos = 'background-repeat: repeat-y !important;';
        } else if (positions == 'bgRepeatXTop') {
            str_bg_pos = 'background-repeat: repeat-x !important; background-position: top !important;';
        } else if (positions == 'bgRepeatXBottom') {
            str_bg_pos = 'background-repeat: repeat-x !important; background-position: bottom !important;';
        }

        if (json.page_popup_text_color)
            str_bg_pos += "color: " + json.page_popup_text_color + ';';

        if (json.page_popup_bg_color)
            str_bg_pos += "background-color: " + json.page_popup_bg_color + ';';


        if (json.page_popup_border_style.length > 0) {

            str_bg_pos += "border-style:" + json.page_popup_border_style + ";";
            str_bg_pos += "border-width:" + json.page_popup_border_size + ";";
            str_bg_pos += "border-color:" + json.page_popup_border_color + ";";
        }

        str_bg_pos += background_image;
        //console.log(str_bg_pos);

        //remove css class to apply the changes
        if (json.page_popup_padding_top.length > 0) {

            /*str_bg_pos += 'padding-top:' + json.row_padding_top + 'px !important;';
            str_bg_pos += 'padding-right:' + json.row_padding_right + 'px !important;';
            str_bg_pos += 'padding-bottom:' + json.row_padding_bottom + 'px !important;';
            str_bg_pos += 'padding-left:' + json.row_padding_left + 'px !important;';*/

            /*str_bg_pos += 'margin-top:' + json.row_margin_top + 'px !important;';
            str_bg_pos += 'margin-right:' + json.row_margin_right + 'px !important;';
            str_bg_pos += 'margin-bottom:' + json.row_margin_bottom + 'px !important;';
            str_bg_pos += 'margin-left:' + json.row_margin_left + 'px !important;';*/

            str_bg_pos += 'padding-top:' + json.page_popup_padding_top + 'px !important;';
            str_bg_pos += 'padding-right:' + json.page_popup_padding_right + 'px !important;';
            str_bg_pos += 'padding-bottom:' + json.page_popup_padding_bottom + 'px !important;';
            str_bg_pos += 'padding-left:' + json.page_popup_padding_left + 'px !important;';
        }

        if (json.page_popup_margin_top.length > 0) {
            str_bg_pos += 'margin-top:' + json.page_popup_margin_top + 'px !important;';
            str_bg_pos += 'margin-right:' + json.page_popup_margin_right + 'px !important;';
            str_bg_pos += 'margin-bottom:' + json.page_popup_margin_bottom + 'px !important;';
            str_bg_pos += 'margin-left:' + json.page_popup_margin_left + 'px !important;';
        }


        if (json.page_popup_modal_width == 'large') {
            str_bg_pos += "max-width:960px;";
        } else if (json.page_popup_modal_width == 'medium') {
            str_bg_pos += "width:720px;";
        } else if (json.page_popup_modal_width == 'small') {
            str_bg_pos += "width:550px;";
        }

        //backdrop
        if (json.page_popup_backdrop.length > 0) {

            var hexr = hex2Rgb(json.page_popup_backdrop);
            //alert(hexr);
            $(element).attr('style', 'background-color:rgba(' + hexr + ',0.75) !important');
        }

        //alert(json.page_popup_modal_width);

        //$(element).css({background: "url('" + json.path + "')"});
        $(element).find('.popup-inner').attr('style', str_bg_pos);
        $(element).attr('data-bg-position', positions);
        $(element).find('.popup-inner').attr('data-modal-width', json.page_popup_modal_width);
        $(element).find('.popup-inner').attr('data-modal-open-after', json.page_popup_modal_open_after);
        $(element).attr('data-bg-image', json.page_popup_bg_image);
        $(element_body).attr('style', str_body_css);

        $(option_open_for).css('background-image', background_image);
        $(option_open_for).css(str_bg_pos);

        $("#openPagePopupSettingsModal").modal('hide');
    });


    //TEXT FIELD TAB
    $(document).on('click', '#text_field_settings_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_text_field_settings').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();

        //alert(json.text_field_input_type);
        //$(option_open_for).find('.text-field-wrapper > input[type="text"]').attr('name', json.text_field_input_type);
        $(option_open_for).find('.text-field-wrapper > input[type="text"]').attr('name', json.text_field_input_type);
        $(option_open_for).find('.text-field-wrapper > input+#hid_integration_info').remove();
        $(option_open_for).find('.text-field-wrapper > input').after("<input type='hidden' id='hid_integration_info' name='integration[" + json.text_field_input_type + "]' />");


        $(option_open_for).find('.text-field-wrapper > input[type="text"]').attr('placeholder', json.text_field_placeholder_text);

        if (json.text_field_required.length > 0)
            $(option_open_for).find('.text-field-wrapper > input[type="text"]').prop('required', true);
        else
            $(option_open_for).find('.text-field-wrapper > input[type="text"]').prop('required', false);

        $(option_open_for).find('.text-field-wrapper > input[type="text"]').css('font-size', json.text_field_font_size + 'px');

        $(option_open_for).find('.text-field-wrapper > input[type="text"]').css('padding-top', json.text_field_padding_top + 'px');
        $(option_open_for).find('.text-field-wrapper > input[type="text"]').css('padding-right', json.text_field_padding_right + 'px');
        $(option_open_for).find('.text-field-wrapper > input[type="text"]').css('padding-bottom', json.text_field_padding_bottom + 'px');
        $(option_open_for).find('.text-field-wrapper > input[type="text"]').css('padding-left', json.text_field_padding_left + 'px');

        $(option_open_for).find('.text-field-wrapper').css('margin-top', json.text_field_margin_top + 'px');
        $(option_open_for).find('.text-field-wrapper').css('margin-right', json.text_field_margin_right + 'px');
        $(option_open_for).find('.text-field-wrapper').css('margin-bottom', json.text_field_margin_bottom + 'px');
        $(option_open_for).find('.text-field-wrapper').css('margin-left', json.text_field_margin_left + 'px');

        $(settingsOpenModal).modal('hide');
    });


    //IMAGE INSIDE TAB
    $(document).on('click', '#order_two_step_settings_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_order_two_step_setting').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();


        /*$("#order_two_step_headline").val($(option_open_for).find('.wrapper .two-step-form > .header > h3').text());
        $("#order_two_step_left_title").val($(option_open_for).find('.wrapper .two-step-form > .step-header li:first-child > strong').text());
        $("#order_two_step_right_title").val($(option_open_for).find('.wrapper .two-step-form > .step-header li:last-child > strong').text());
        $("#order_two_step_left_info").val($(option_open_for).find('.wrapper .two-step-form > .step-header li:first-child > p').text());
        $("#order_two_step_right_info").val($(option_open_for).find('.wrapper .two-step-form > .step-header li:last-child > p').text());               */


        $(option_open_for).find('.wrapper .two-step-form > .header > h3').text(json.order_two_step_headline);
        $(option_open_for).find('.wrapper .two-step-form > .step-header li:first-child > strong').text(json.order_two_step_left_title);
        $(option_open_for).find('.wrapper .two-step-form > .step-header li:last-child > strong').text(json.order_two_step_right_title);
        $(option_open_for).find('.wrapper .two-step-form > .step-header li:first-child > p').text(json.order_two_step_left_info);
        $(option_open_for).find('.wrapper .two-step-form > .step-header li:last-child > p').text(json.order_two_step_right_info);

        $(option_open_for).find('.wrapper .two-step-form > .header').css('color', json.order_two_step_headline_color);
        $(option_open_for).find('.wrapper .two-step-form > .header').css('background-color', json.order_two_step_headline_bg_color);
        $(option_open_for).find('.wrapper .two-step-form button.btn-next-step,.wrapper .two-step-form button.complete-order').css('color', json.order_two_step_button_color);
        $(option_open_for).find('.wrapper .two-step-form button.btn-next-step,.wrapper .two-step-form button.complete-order').css('background-color', json.order_two_step_button_bg_color);

        $(option_open_for).find('.wrapper .two-step-form > .header > h3').css('font-size', json.order_two_step_headline_font_size + 'px');
        $(option_open_for).find('.wrapper .two-step-form > .step-header li > strong').css('font-size', json.order_two_step_header_font_size + 'px');
        $(option_open_for).find('.wrapper .two-step-form > .step-header li > p').css('font-size', json.order_two_step_info_font_size + 'px');


        $(option_open_for).find('.wrapper').css('padding-top', json.order_two_step_padding_top + 'px');
        $(option_open_for).find('.wrapper').css('padding-right', json.order_two_step_padding_right + 'px');
        $(option_open_for).find('.wrapper').css('padding-bottom', json.order_two_step_padding_bottom + 'px');
        $(option_open_for).find('.wrapper').css('padding-left', json.order_two_step_padding_left + 'px');

        $(option_open_for).find('.wrapper').css('margin-top', json.order_two_step_margin_top + 'px');
        $(option_open_for).find('.wrapper').css('margin-right', json.order_two_step_margin_right + 'px');
        $(option_open_for).find('.wrapper').css('margin-bottom', json.order_two_step_margin_bottom + 'px');
        $(option_open_for).find('.wrapper').css('margin-left', json.order_two_step_margin_left + 'px');

        $(settingsOpenModal).modal('hide');
    });


    //SPACEBAR
    $(document).on('click', '#specebar_settings_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_specebar_settings').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();

        $(option_open_for).find('.empty-space-wrapper > div').css('height', json.specebar_settings_height);

        $(settingsOpenModal).modal('hide');
    });


    //SEPERATOR TEXT TAB
    $(document).on('click', '#seperator_text_settings_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_seperator_text_settings').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();


        /*$("#seperator_text_settings").val($(option_open_for).find('.horizontal-seperator-wrapper > .fake-legend > span').text());

        $("#seperator_text_settings_text_color").val(rgb2hex($(option_open_for).find('.horizontal-seperator-wrapper > .fake-legend > span').prop('style')['color']));
        $("#seperator_text_settings_line_color").val(rgb2hex($(option_open_for).find('.horizontal-seperator-wrapper > .fake-legend').prop('style')['border-bottom-color']));
        $("#seperator_text_settings_bg_color").val(rgb2hex($(option_open_for).find('.horizontal-seperator-wrapper > .fake-legend > span').prop('style')['background-color']));        */

        $(option_open_for).find('.horizontal-seperator-wrapper > .fake-legend > span').text(json.seperator_text_settings);
        $(option_open_for).find('.horizontal-seperator-wrapper > .fake-legend > span').css('color', json.seperator_text_settings_text_color);
        $(option_open_for).find('.horizontal-seperator-wrapper > .fake-legend').css('border-bottom-color', json.seperator_text_settings_line_color);

        if (json.seperator_text_settings_bg_color.length > 1)
            $(option_open_for).find('.horizontal-seperator-wrapper > .fake-legend > span').css('background-color', json.seperator_text_settings_bg_color);
        else
            $(option_open_for).find('.horizontal-seperator-wrapper > .fake-legend > span').css('background-color', 'transparent');


        $(option_open_for).find('.horizontal-seperator-wrapper > .fake-legend > span').css('font-size', json.seperator_text_settings_font_size + 'px');
        $(option_open_for).find('.horizontal-seperator-wrapper > .fake-legend > span').css('font-weight', json.seperator_text_settings_font_weight);


        $(option_open_for).find('.horizontal-seperator-wrapper > .fake-legend').css('padding-top', json.seperator_text_settings_padding_top + 'px');
        $(option_open_for).find('.horizontal-seperator-wrapper > .fake-legend').css('padding-right', json.seperator_text_settings_padding_right + 'px');
        $(option_open_for).find('.horizontal-seperator-wrapper > .fake-legend').css('padding-bottom', json.seperator_text_settings_padding_bottom + 'px');
        $(option_open_for).find('.horizontal-seperator-wrapper > .fake-legend').css('padding-left', json.seperator_text_settings_padding_left + 'px');

        $(option_open_for).find('.horizontal-seperator-wrapper > .fake-legend').css('margin-top', json.seperator_text_settings_margin_top + 'px');
        $(option_open_for).find('.horizontal-seperator-wrapper > .fake-legend').css('margin-right', json.seperator_text_settings_margin_right + 'px');
        $(option_open_for).find('.horizontal-seperator-wrapper > .fake-legend').css('margin-bottom', json.seperator_text_settings_margin_bottom + 'px');
        $(option_open_for).find('.horizontal-seperator-wrapper > .fake-legend').css('margin-left', json.seperator_text_settings_margin_left + 'px');

        $(settingsOpenModal).modal('hide');
    });


    //IMAGE INSIDE TAB
    $(document).on('click', '#image_inside_tab_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_image_inside_tab_settings').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();

        $(option_open_for).find('.image-inside-tab-wrapper > .tab-image > img').attr('src', json.image_inside_inner_image_path);

        var taber_css = "";


        if (json.image_inside_width) {
            $(option_open_for).find('.image-inside-tab-wrapper > .tab-image > img').css('width', json.image_inside_width + '%');
        }


        if (json.image_inside_height)
            $(option_open_for).find('.image-inside-tab-wrapper > .tab-image > img').attr('height', json.image_inside_height);
        else
            $(option_open_for).find('.image-inside-tab-wrapper > .tab-image > img').attr('height', 'auto');


        taber_css += "padding-top:" + json.image_inside_padding_top + 'px;';
        taber_css += "padding-right:" + json.image_inside_padding_right + 'px;';
        taber_css += "padding-bottom:" + json.image_inside_padding_bottom + 'px;';
        taber_css += "padding-left:" + json.image_inside_padding_left + 'px;';

        taber_css += "margin-top:" + json.image_inside_margin_top + 'px;';
        taber_css += "margin-right:" + json.image_inside_margin_right + 'px;';
        taber_css += "margin-bottom:" + json.image_inside_margin_bottom + 'px;';
        taber_css += "margin-left:" + json.image_inside_margin_left + 'px;';

        /*$(option_open_for).find('.image-inside-tab-wrapper > .tab-image').css('padding-top', json.image_padding_top + 'px');
        $(option_open_for).find('.image-inside-tab-wrapper > .tab-image').css('padding-right', json.image_padding_right + 'px');
        $(option_open_for).find('.image-inside-tab-wrapper > .tab-image').css('padding-bottom', json.image_padding_bottom + 'px');
        $(option_open_for).find('.image-inside-tab-wrapper > .tab-image').css('padding-left', json.image_padding_left + 'px');

        $(option_open_for).find('.image-inside-tab-wrapper > .tab-image').css('margin-top', json.image_margin_top + 'px');
        $(option_open_for).find('.image-inside-tab-wrapper > .tab-image').css('margin-right', json.image_margin_right + 'px');
        $(option_open_for).find('.image-inside-tab-wrapper > .tab-image').css('margin-bottom', json.image_margin_bottom + 'px');
        $(option_open_for).find('.image-inside-tab-wrapper > .tab-image').css('margin-left', json.image_margin_left + 'px');*/

        if (json.image_inside_tab_image_path.length > 0) {
            taber_css += "background:url('" + json.image_inside_tab_image_path + "') 0px 0px no-repeat;";
            taber_css += "background-position: center;";
        }

        $(option_open_for).find('.image-inside-tab-wrapper > .tab-image').attr('style', taber_css);

        $(settingsOpenModal).modal('hide');
    });


    //EMPTY CONTAINER
    $(document).on('click', '#empty_container_setting_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_empty_container_settings').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();


        //texts
        $(option_open_for).find('.lb-content-body').attr('id', json.empty_container_section_id);

        //color
        $(option_open_for).find('.lb-content-body').css('color', json.empty_container_section_id);
        $(option_open_for).find('.lb-content-body').css('background-color', json.empty_container_bg_color);

        //align
        $(option_open_for).find('.lb-content-body').css('text-align', json.empty_container_text_align);


        //border
        //alert(json.empty_container_border_size);
        var border_css = "";

        if (json.empty_container_border_style.length > 0) {
            border_css = 'border-style:' + json.empty_container_border_style;
            border_css += 'border-width:' + json.empty_container_border_size;
            border_css += 'border-color:' + json.empty_container_border_color;
        }
        $(option_open_for).find('.lb-content-body').css('border-style', json.empty_container_border_style);
        $(option_open_for).find('.lb-content-body').css('border-width', json.empty_container_border_size);
        $(option_open_for).find('.lb-content-body').css('border-color', json.empty_container_border_color);


        //$(option_open_for).find('.lb-content-body').attr('style', border_css);

        $(option_open_for).find('.lb-content-body').css('width', json.empty_container_width + "%");

        //padding
        $(option_open_for).find('.lb-content-body').css('padding-top', json.empty_container_padding_top + 'px');
        $(option_open_for).find('.lb-content-body').css('padding-right', json.empty_container_padding_right + 'px');
        $(option_open_for).find('.lb-content-body').css('padding-bottom', json.empty_container_padding_bottom + 'px');
        $(option_open_for).find('.lb-content-body').css('padding-left', json.empty_container_padding_left + 'px');

        //margin
        if (json.empty_container_width > 0) {
            $(option_open_for).find('.lb-content-body').css('margin', 'auto');
        } else {
            $(option_open_for).find('.lb-content-body').css('margin-top', json.empty_container_margin_top + 'px');
            $(option_open_for).find('.lb-content-body').css('margin-right', json.empty_container_margin_right + 'px');
            $(option_open_for).find('.lb-content-body').css('margin-bottom', json.empty_container_margin_bottom + 'px');
            $(option_open_for).find('.lb-content-body').css('margin-left', json.empty_container_margin_left + 'px');
        }

        $(settingsOpenModal).modal('hide');
    });


    //FAQ
    $(document).on('click', '#faq_setting_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_faq_settings').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();


        //texts
        $(option_open_for).find('.wrapper .faq-block .faq-title-text > b').text(json.faq_question_text);
        $(option_open_for).find('.wrapper .faq-block .faq-answer').text(json.faq_answar_text);

        //color
        $(option_open_for).find('.wrapper .faq-block .faq-title-text').css('color', json.faq_question_color);
        $(option_open_for).find('.wrapper .faq-block .faq-title').css('color', json.faq_question_color);
        $(option_open_for).find('.wrapper .faq-block .faq-answer').css('color', json.faq_answar_color);


        //size
        $(option_open_for).find('.wrapper .faq-block .faq-title').css('font-size', json.faq_question_size + 'px');
        $(option_open_for).find('.wrapper .faq-block .faq-answer').css('font-size', json.faq_answar_size + 'px');

        //line height
        //alert(json.faq_answar_line_height);
        // $(option_open_for).find('.wrapper .faq-block .faq-answar').css('line-height: 35px !important');
        $(option_open_for).find('.wrapper .faq-block .faq-answar').css('line-height', json.faq_answar_line_height + 'px !important');

        //padding
        $(option_open_for).find('.wrapper .faq-block').css('padding-top', json.faq_padding_top + 'px');
        $(option_open_for).find('.wrapper .faq-block').css('padding-right', json.faq_padding_right + 'px');
        $(option_open_for).find('.wrapper .faq-block').css('padding-bottom', json.faq_padding_bottom + 'px');
        $(option_open_for).find('.wrapper .faq-block').css('padding-left', json.faq_padding_left + 'px');

        //margin
        $(option_open_for).find('.wrapper .faq-block').css('margin-top', json.faq_margin_top + 'px');
        $(option_open_for).find('.wrapper .faq-block').css('margin-right', json.faq_margin_right + 'px');
        $(option_open_for).find('.wrapper .faq-block').css('margin-bottom', json.faq_margin_bottom + 'px');
        $(option_open_for).find('.wrapper .faq-block').css('margin-left', json.faq_margin_left + 'px');

        $(settingsOpenModal).modal('hide');
    });


    //PRODUCT ADD
    $(document).on('click', '#product_add_setting_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_product_add_settings').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();


        //texts
        $(option_open_for).find('.wrapper .coupon-container .coupon-banner > p').text(json.product_add_header_text);
        $(option_open_for).find('.wrapper .recommended').text(json.product_add_recomonded_text);
        $(option_open_for).find('.wrapper .reg-p > p').text(json.product_add_regular_price);
        $(option_open_for).find('.wrapper .save-p > p').text(json.product_add_instant_saving);
        $(option_open_for).find('.wrapper .sticker > p').text(json.product_add_short_info);
        $(option_open_for).find('.wrapper .price-heading').text(json.product_add_info_with_price);
        $(option_open_for).find('.wrapper .coupon-button').text(json.product_add_button_text);

        //////////////////
        $(option_open_for).find('.wrapper .coupon-button #hid_product_price').remove();
        $(option_open_for).find('.wrapper .coupon-button #hid_product_variant_id').remove();

        var product_option = $('option:selected', $("#product_add_product")).attr('data-product-type');

        $(option_open_for).find('.wrapper .coupon-button').append('<input name="hid_product_type" id="hid_product_type" value="' + product_option + '" type="hidden">');
        $(option_open_for).find('.wrapper .coupon-button').append('<input name="hid_product_id" id="hid_product_id" value="' + json.product_add_product + '" type="hidden">');
        $(option_open_for).find('.wrapper .coupon-button').append('<input name="hid_product_price" id="hid_product_price" value="' + json.hid_product_price + '" type="hidden">');

        if (json.hid_product_variant_id.length > 0)
            $(option_open_for).find('.wrapper .coupon-button').append('<input name="hid_product_variant_id" id="hid_product_variant_id" value="' + json.hid_product_variant_id + '" type="hidden">');

        $(option_open_for).find('.wrapper .coupon-button').append('<input name="product_quantity" id="product_quantity" value="' + json.product_quantity + '" type="hidden">');

        //color
        $(option_open_for).find('.wrapper .coupon-container .coupon-banner').css('color', json.product_add_text_color);
        $(option_open_for).find('.wrapper .coupon-container .coupon-banner').css('background-color', json.product_add_bg_color);
        $(option_open_for).find('.wrapper .save-p').css('color', json.product_add_saving_color);
        $(option_open_for).find('.wrapper .coupon-button').css('color', json.product_add_button_text_color);
        $(option_open_for).find('.wrapper .coupon-button').css('background-color', json.product_add_button_bg_color);


        //padding
        $(option_open_for).find('.wrapper').css('padding-top', json.product_add_padding_top + 'px');
        $(option_open_for).find('.wrapper').css('padding-right', json.product_add_padding_right + 'px');
        $(option_open_for).find('.wrapper').css('padding-bottom', json.product_add_padding_bottom + 'px');
        $(option_open_for).find('.wrapper').css('padding-left', json.product_add_padding_left + 'px');

        //margin
        $(option_open_for).find('.wrapper').css('margin-top', json.product_add_margin_top + 'px');
        $(option_open_for).find('.wrapper').css('margin-right', json.product_add_margin_right + 'px');
        $(option_open_for).find('.wrapper').css('margin-bottom', json.product_add_margin_bottom + 'px');
        $(option_open_for).find('.wrapper').css('margin-left', json.product_add_margin_left + 'px');

        $(settingsOpenModal).modal('hide');
    });


    //MENU
    $(document).on('click', '#menu_setting_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_menu_settings').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();

        $(option_open_for).find('.wrapper').css('text-align', json.image_text_setting_align);


        $(".hamburger-menu > ul").html("");

        $(".menu_add_container > .panels").each(function (index, element) {

            //alert($(element).find("select").val());

            var title = $(element).find(".form-group:first-child input").val();
            var href = $(element).find(".form-group:nth-child(2) input").val();
            var target = $(element).find("select").val();

            var html = '<li>';
            if (target == '')
                html += '<a href="' + href + '">' + title + '</a>';
            else
                html += '<a href="' + href + '" target="' + target + '">' + title + '</a>';
            html += '</li>';

            $(".hamburger-menu > ul").append(html);
        });


        $(option_open_for).find('.wrapper .hamburger-menu a').css('color', json.menu_item_color);
        $(option_open_for).find('.wrapper .hamburger-menu').css('background-color', json.menu_item_bg_color);


        //alert(json.headline_padding_right);

        //Font
        $(option_open_for).find('.wrapper .hamburger-menu a').css('font-size', json.menu_items_font_size + 'px');

        //Align
        $(option_open_for).find('.wrapper .hamburger-menu').css('text-align', json.menu_setting_align);

        //padding
        $(option_open_for).find('.wrapper .hamburger-menu').css('padding-top', json.menu_setting_padding_top + 'px');
        $(option_open_for).find('.wrapper .hamburger-menu').css('padding-right', json.menu_setting_padding_right + 'px');
        $(option_open_for).find('.wrapper .hamburger-menu').css('padding-bottom', json.menu_setting_padding_bottom + 'px');
        $(option_open_for).find('.wrapper .hamburger-menu').css('padding-left', json.menu_setting_padding_left + 'px');

        //margin
        $(option_open_for).find('.wrapper').css('margin-top', json.menu_setting_margin_top + 'px');
        $(option_open_for).find('.wrapper').css('margin-right', json.menu_setting_margin_right + 'px');
        $(option_open_for).find('.wrapper').css('margin-bottom', json.menu_setting_margin_bottom + 'px');
        $(option_open_for).find('.wrapper').css('margin-left', json.menu_setting_margin_left + 'px');

        $(settingsOpenModal).modal('hide');
    });


    //IMAGE TEXT
    $(document).on('click', '#image_text_setting_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_image_text_settings').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();

        $(option_open_for).find('.wrapper').css('text-align', json.image_text_setting_align);


        $(option_open_for).find('.wrapper .how-text > h4').html(json.image_text_headline_text);
        $(option_open_for).find('.wrapper .how-text > p').html(json.image_text_sub_headline_text);


        $(option_open_for).find('.wrapper .how-text > h4').css('color', json.image_text_headline_text_color);
        $(option_open_for).find('.wrapper .how-text > p').css('color', json.image_text_sub_headline_text_color);
        $(option_open_for).find('.wrapper').css('background-color', json.image_text_bg_color);


        //image
        $(option_open_for).find('.wrapper .how-image img').attr('src', json.image_text_image_path);

        //Font
        $(option_open_for).find('.wrapper .how-text > h4').css('font-size', json.image_text_headline_font_size + 'px');
        $(option_open_for).find('.wrapper .how-text > p').css('font-size', json.image_text_sub_headline_font_size + 'px');

        //padding
        $(option_open_for).find('.wrapper .how-single').css('padding-top', json.image_text_padding_top + 'px');
        $(option_open_for).find('.wrapper .how-single').css('padding-right', json.image_text_padding_right + 'px');
        $(option_open_for).find('.wrapper .how-single').css('padding-bottom', json.image_text_padding_bottom + 'px');
        $(option_open_for).find('.wrapper .how-single').css('padding-left', json.image_text_padding_left + 'px');

        //margin
        $(option_open_for).find('.wrapper').css('margin-top', json.image_text_margin_top + 'px');
        $(option_open_for).find('.wrapper').css('margin-right', json.image_text_margin_right + 'px');
        $(option_open_for).find('.wrapper').css('margin-bottom', json.image_text_margin_bottom + 'px');
        $(option_open_for).find('.wrapper').css('margin-left', json.image_text_margin_left + 'px');

        $(settingsOpenModal).modal('hide');
    });


    //TESTIMONIAL
    $(document).on('click', '#testimonial_setting_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_testimonial_settings').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();

        $(option_open_for).find('.wrapper').css('text-align', json.testimonial_text_setting_align);


        $(option_open_for).find('.wrapper .testimonial-text > p').html(json.testimonial_text);
        $(option_open_for).find('.wrapper .testimonial-details > .name').html(json.testimonial_customer_name_text);
        $(option_open_for).find('.wrapper .testimonial-details > .location').html(json.testimonial_customer_place_text);
        //$(option_open_for).find('.wrapper > b').html(json.testimonial_customer_rating);


        //image
        $(option_open_for).find('.wrapper .testimonial-single .profile > img').attr('src', json.testimonial_image_path);

        $(option_open_for).find('.wrapper .testimonial-text > p').css('color', json.testimonial_text_color);
        $(option_open_for).find('.wrapper .testimonial-details > .name').css('color', json.testimonial_customer_name_color);
        $(option_open_for).find('.wrapper .rating > i').css('color', json.testimonial_rating_color);
        $(option_open_for).find('.wrapper .testimonial-single').css('background-color', json.testimonial_bg_color);


        //alert(json.headline_padding_right);

        //Font
        $(option_open_for).find('.wrapper .testimonial-single').css('font-size', json.testimonial_font_size + 'px');

        //padding
        $(option_open_for).find('.wrapper .testimonial-single').css('padding-top', json.testimonial_padding_top + 'px');
        $(option_open_for).find('.wrapper .testimonial-single').css('padding-right', json.testimonial_padding_right + 'px');
        $(option_open_for).find('.wrapper .testimonial-single').css('padding-bottom', json.testimonial_padding_bottom + 'px');
        $(option_open_for).find('.wrapper .testimonial-single').css('padding-left', json.testimonial_padding_left + 'px');

        //margin
        $(option_open_for).find('.wrapper').css('margin-top', json.testimonial_margin_top + 'px');
        $(option_open_for).find('.wrapper').css('margin-right', json.testimonial_margin_right + 'px');
        $(option_open_for).find('.wrapper').css('margin-bottom', json.testimonial_margin_bottom + 'px');
        $(option_open_for).find('.wrapper').css('margin-left', json.testimonial_margin_left + 'px');

        $(settingsOpenModal).modal('hide');
    });


    //SHIPPING METHOD
    $(document).on('click', '#coupon_system_setting_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_coupon_system_settings').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();

        //alert(json.shipping_method_padding_top);

        $(option_open_for).find('.wrapper .section-title').css('text-align', json.coupon_system_headline_alignment);

        //texts
        $(option_open_for).find('.wrapper .section-title > strong').text(json.coupon_system_headline_text);
        $(option_open_for).find('.wrapper .panels button').text(json.coupon_system_button_text);

        //colors
        $(option_open_for).find('.wrapper .coupon-system-form-panel').css('color', json.coupon_system_text_color);
        $(option_open_for).find('.wrapper .coupon-system-form-panel').css('background-color', json.coupon_system_bg_color);
        $(option_open_for).find('.wrapper .panels button').css('color', json.coupon_system_button_text_color);
        $(option_open_for).find('.wrapper .panels button').css('background-color', json.coupon_system_button_bg);


        //padding
        $(option_open_for).find('.wrapper .coupon-system-form-panel').css('padding-top', json.coupon_system_padding_top + 'px');
        $(option_open_for).find('.wrapper .coupon-system-form-panel').css('padding-right', json.coupon_system_padding_right + 'px');
        $(option_open_for).find('.wrapper .coupon-system-form-panel').css('padding-bottom', json.coupon_system_padding_bottom + 'px');
        $(option_open_for).find('.wrapper .coupon-system-form-panel').css('padding-left', json.coupon_system_padding_left + 'px');

        //margin
        $(option_open_for).find('.wrapper').css('margin-top', json.coupon_system_margin_top + 'px');
        $(option_open_for).find('.wrapper').css('margin-right', json.coupon_system_margin_right + 'px');
        $(option_open_for).find('.wrapper').css('margin-bottom', json.coupon_system_margin_bottom + 'px');
        $(option_open_for).find('.wrapper').css('margin-left', json.coupon_system_margin_left + 'px');

        $('.modal').modal('hide');
    });


    //SHIPPING METHOD
    $(document).on('click', '#shipping_method_setting_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_shipping_method_settings').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();

        //alert(json.shipping_method_padding_top);

        $(option_open_for).find('.wrapper .section-title').css('text-align', json.shipping_method_headline_alignment);

        //texts
        $(option_open_for).find('.wrapper .section-title > strong').text(json.shipping_method_headline_text);

        //colors
        $(option_open_for).find('.wrapper .panels > .body').css('color', json.shipping_method_text_color);
        $(option_open_for).find('.wrapper .panels > .body').css('background-color', json.shipping_method_bg_color);


        //padding
        $(option_open_for).find('.wrapper > .shipping-method-form-panel').css('padding-top', json.shipping_method_padding_top + 'px');
        $(option_open_for).find('.wrapper > .shipping-method-form-panel').css('padding-right', json.shipping_method_padding_right + 'px');
        $(option_open_for).find('.wrapper > .shipping-method-form-panel').css('padding-bottom', json.shipping_method_padding_bottom + 'px');
        $(option_open_for).find('.wrapper > .shipping-method-form-panel').css('padding-left', json.shipping_method_padding_left + 'px');

        //margin
        $(option_open_for).find('.wrapper').css('margin-top', json.shipping_method_margin_top + 'px');
        $(option_open_for).find('.wrapper').css('margin-right', json.shipping_method_margin_right + 'px');
        $(option_open_for).find('.wrapper').css('margin-bottom', json.shipping_method_margin_bottom + 'px');
        $(option_open_for).find('.wrapper').css('margin-left', json.shipping_method_margin_left + 'px');

        $(settingsOpenModal).modal('hide');
    });


    //ORDER BUMP
    $(document).on('click', '#order_bump_setting_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_order_bump_settings').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();

        //alert($(option_open_for).find('.wrapper .bump-details span:first-child').text());

        //$(option_open_for).find('.wrapper > .order-for-bump').css('text-align', json.order_bump_setting_align);

        //texts
        $(option_open_for).find('.wrapper .order-for-bump ul li:last-child b').text(json.order_bump_headline);
        $(option_open_for).find('.wrapper .bump-details span:first-child').text(json.order_bump_oto_headline);
        $(option_open_for).find('.wrapper .bump-details span:last-child').text(json.order_bump_oto_text);

        //font size
        $(option_open_for).find('.wrapper .order-for-bump ul li:last-child').css('font-size', json.order_bump_headline_font_size + 'px');
        $(option_open_for).find('.wrapper .bump-details span:last-child').css('font-size', json.order_bump_text_font_size + 'px');

        //colors
        $(option_open_for).find('.wrapper .order-for-bump ul li:last-child').css('color', json.order_bump_headline_color);
        $(option_open_for).find('.wrapper .bump-details span:last-child').css('color', json.order_bump_text_color);
        $(option_open_for).find('.wrapper .order-for-bump ul').css('background-color', json.order_bump_headline_bg);
        $(option_open_for).find('.element-bump-info').css('background-color', json.order_bump_background);


        //padding
        $(option_open_for).find('.wrapper').css('padding-top', json.order_bump_padding_top + 'px');
        $(option_open_for).find('.wrapper').css('padding-right', json.order_bump_padding_right + 'px');
        $(option_open_for).find('.wrapper').css('padding-bottom', json.order_bump_padding_bottom + 'px');
        $(option_open_for).find('.wrapper').css('padding-left', json.order_bump_padding_left + 'px');

        //margin
        $(option_open_for).find('.element-bump-info').css('margin-top', json.order_bump_margin_top + 'px');
        $(option_open_for).find('.element-bump-info').css('margin-right', json.order_bump_margin_right + 'px');
        $(option_open_for).find('.element-bump-info').css('margin-bottom', json.order_bump_margin_bottom + 'px');
        $(option_open_for).find('.element-bump-info').css('margin-left', json.order_bump_margin_left + 'px');

        $(settingsOpenModal).modal('hide');
    });


    //CARD DETAILS FORM
    $(document).on('click', '#card_form_setting_save', function (e) {

        //e.preventDefault();

        //format form data to JSON format
        var data = "" + JSON.stringify($('#frm_card_form_settings').serializeObject());
        var json = JSON.parse(data);

        //caption text
        $(option_open_for).find('.wrapper .step-parts > .step-caption span:last-child').html(json.card_details_form_caption_text);

        //alert(json.card_details_form_padding_top);

        //padding
        $(option_open_for).find('.wrapper').css('padding-top', json.card_details_form_form_padding_top + 'px');
        $(option_open_for).find('.wrapper').css('padding-right', json.card_details_form_form_padding_right + 'px');
        $(option_open_for).find('.wrapper').css('padding-bottom', json.card_details_form_form_padding_bottom + 'px');
        $(option_open_for).find('.wrapper').css('padding-left', json.card_details_form_form_padding_left + 'px');

        //margin
        $(option_open_for).find('.wrapper').css('margin-top', json.card_details_form_form_margin_top + 'px');
        $(option_open_for).find('.wrapper').css('margin-right', json.card_details_form_form_margin_right + 'px');
        $(option_open_for).find('.wrapper').css('margin-bottom', json.card_details_form_form_margin_bottom + 'px');
        $(option_open_for).find('.wrapper').css('margin-left', json.card_details_form_form_margin_left + 'px');

        $(settingsOpenModal).modal('hide');
    });


    //SHIPPING FORM
    $(document).on('click', '#shipping_address_form_setting_save', function (e) {

        //e.preventDefault();

        //format form data to JSON format
        var data = "" + JSON.stringify($('#frm_shipping_address_form_settings').serializeObject());
        var json = JSON.parse(data);

        //caption text
        $(option_open_for).find('.wrapper .shipping-form > .section-title').html(json.shipping_caption_text);

        //padding
        $(option_open_for).find('.wrapper').css('padding-top', json.shipping_address_form_padding_top + 'px');
        $(option_open_for).find('.wrapper').css('padding-right', json.shipping_address_form_padding_right + 'px');
        $(option_open_for).find('.wrapper').css('padding-bottom', json.shipping_address_form_padding_bottom + 'px');
        $(option_open_for).find('.wrapper').css('padding-left', json.shipping_address_form_padding_left + 'px');

        //margin
        $(option_open_for).find('.wrapper').css('margin-top', json.shipping_address_form_margin_top + 'px');
        $(option_open_for).find('.wrapper').css('margin-right', json.shipping_address_form_margin_right + 'px');
        $(option_open_for).find('.wrapper').css('margin-bottom', json.shipping_address_form_margin_bottom + 'px');
        $(option_open_for).find('.wrapper').css('margin-left', json.shipping_address_form_margin_left + 'px');

        $(settingsOpenModal).modal('hide');
    });


    //CONTACT FORM
    $(document).on('click', '#contact_form_setting_save', function (e) {

        //e.preventDefault();

        //format form data to JSON format
        var data = "" + JSON.stringify($('#frm_contact_form_settings').serializeObject());
        var json = JSON.parse(data);

        //caption text
        $(option_open_for).find('.step-caption span:last-child').html(json.caption_text);

        //alert(json.enable_step_number);

        if (json.enable_step_number != null) {
            $(option_open_for).find('.step-caption span > strong').attr('data-step-enabled', json.enable_step_number);
            $(option_open_for).find('.step-caption span > strong').html(json.step_number);
        } else {
            $(option_open_for).find('.step-caption span > strong').html("");
        }


        //padding
        $(option_open_for).find('.wrapper').css('padding-top', json.contact_form_padding_top + 'px');
        $(option_open_for).find('.wrapper').css('padding-right', json.contact_form_padding_right + 'px');
        $(option_open_for).find('.wrapper').css('padding-bottom', json.contact_form_padding_bottom + 'px');
        $(option_open_for).find('.wrapper').css('padding-left', json.contact_form_padding_left + 'px');

        //margin
        $(option_open_for).find('.wrapper').css('margin-top', json.contact_form_margin_top + 'px');
        $(option_open_for).find('.wrapper').css('margin-right', json.contact_form_margin_right + 'px');
        $(option_open_for).find('.wrapper').css('margin-bottom', json.contact_form_margin_bottom + 'px');
        $(option_open_for).find('.wrapper').css('margin-left', json.contact_form_margin_left + 'px');

        $(settingsOpenModal).modal('hide');
    });


    //PRODUCT QUANTITY
    $(document).on('click', '#product_quantity_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_product_quantity_settings').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();

        $(option_open_for).find('.wrapper').css('text-align', json.select_product_quantity_align_option);
        $(option_open_for).find('.wrapper').css('width', json.product_quantity_width + '%');
        $(option_open_for).find('.wrapper').css('margin', 'auto');


        //padding
        $(option_open_for).find('.wrapper').css('padding-top', json.product_quantity_padding_top + 'px');
        $(option_open_for).find('.wrapper').css('padding-right', json.product_quantity_padding_right + 'px');
        $(option_open_for).find('.wrapper').css('padding-bottom', json.product_quantity_padding_bottom + 'px');
        $(option_open_for).find('.wrapper').css('padding-left', json.product_quantity_padding_left + 'px');

        $(settingsOpenModal).modal('hide');
    });


    //PRODUCT VARIANT
    $(document).on('click', '#product_varient_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_product_varient_settings').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();

        $(option_open_for).find('.wrapper').css('text-align', json.select_product_varient_align_option);
        $(option_open_for).find('.wrapper').attr('data-align', json.select_product_varient_align_option);
        $(option_open_for).find('.wrapper').css('width', json.product_varient_width + '%');
        $(option_open_for).find('.wrapper').css('margin', 'auto');


        //padding
        $(option_open_for).find('.wrapper').css('padding-top', json.product_varient_padding_top + 'px');
        $(option_open_for).find('.wrapper').css('padding-right', json.product_varient_padding_right + 'px');
        $(option_open_for).find('.wrapper').css('padding-bottom', json.product_varient_padding_bottom + 'px');
        $(option_open_for).find('.wrapper').css('padding-left', json.product_varient_padding_left + 'px');

        //margin
        $(option_open_for).find('.wrapper').css('margin-top', json.product_varient_margin_top + 'px');
        $(option_open_for).find('.wrapper').css('margin-right', json.product_varient_margin_right + 'px');
        $(option_open_for).find('.wrapper').css('margin-bottom', json.product_varient_margin_bottom + 'px');
        $(option_open_for).find('.wrapper').css('margin-left', json.product_varient_margin_left + 'px');

        $(settingsOpenModal).modal('hide');
    });


    //PRODUCT AVAIBILITY
    $(document).on('click', '#product_availabel_setting_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_product_availabel_settings').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();

        $(option_open_for).find('.wrapper').css('text-align', json.product_availabel_align);
        $(option_open_for).find('.wrapper > b').css('color', json.product_availabel_text_color);
        //$(option_open_for).find('.wrapper').css('padding-top', json.heading_padding_top_settings);
        //$(option_open_for).find('.wrapper').css('padding-bottom', json.heading_padding_bottom_settings);
        //$(option_open_for).find('.wrapper > b').css('background-color', json.bg_color);


        //padding
        $(option_open_for).find('.wrapper').css('padding-top', json.product_availabel_padding_top + 'px');
        $(option_open_for).find('.wrapper').css('padding-right', json.product_availabel_padding_right + 'px');
        $(option_open_for).find('.wrapper').css('padding-bottom', json.product_availabel_padding_bottom + 'px');
        $(option_open_for).find('.wrapper').css('padding-left', json.product_availabel_padding_left + 'px');

        //margin
        $(option_open_for).find('.wrapper').css('margin-top', json.product_availabel_margin_top + 'px');
        $(option_open_for).find('.wrapper').css('margin-right', json.product_availabel_margin_right + 'px');
        $(option_open_for).find('.wrapper').css('margin-bottom', json.product_availabel_margin_bottom + 'px');
        $(option_open_for).find('.wrapper').css('margin-left', json.product_availabel_margin_left + 'px');

        $(settingsOpenModal).modal('hide');
    });


    //ORDER DETAILS
    $(document).on('click', '#order_address_details_setting_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_order_address_details_settings').serializeObject());
        var json = JSON.parse(data);

        //alert(json.order_address_details_setting_align);
        var $element = $(this).parent().parent();

        $(option_open_for).find('.wrapper').css('text-align', json.order_address_details_setting_align);
        $(option_open_for).find('.wrapper h4').css('color', json.order_address_details_header_color);


        //padding
        $(option_open_for).find('.wrapper').css('padding-top', json.order_address_details_padding_top + 'px');
        $(option_open_for).find('.wrapper').css('padding-right', json.order_address_details_padding_right + 'px');
        $(option_open_for).find('.wrapper').css('padding-bottom', json.order_address_details_padding_bottom + 'px');
        $(option_open_for).find('.wrapper').css('padding-left', json.order_address_details_padding_left + 'px');

        //margin
        $(option_open_for).find('.wrapper').css('margin-top', json.order_address_details_margin_top + 'px');
        $(option_open_for).find('.wrapper').css('margin-right', json.order_address_details_margin_right + 'px');
        $(option_open_for).find('.wrapper').css('margin-bottom', json.order_address_details_margin_bottom + 'px');
        $(option_open_for).find('.wrapper').css('margin-left', json.order_address_details_margin_left + 'px');

        $(settingsOpenModal).modal('hide');
    });


    //ORDER Action
    $(document).on('click', '#order_action_setting_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_order_action_settings').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();

        $(option_open_for).find('.wrapper').css('text-align', json.order_action_setting_align);
        $(option_open_for).find('.wrapper > a').html(json.order_action_button_text);
        $(option_open_for).find('.wrapper > button').html(json.order_print_button_text);

        $(option_open_for).find('.wrapper > a').css('color', json.order_button_color);
        $(option_open_for).find('.wrapper > a').css('background-color', json.order_button_bg_color);
        $(option_open_for).find('.wrapper > button').css('color', json.order_print_button_text_color);
        $(option_open_for).find('.wrapper > button').css('background-color', json.order_print_button_bg_color);


        //padding
        $(option_open_for).find('.wrapper').css('padding-top', json.order_action_padding_top + 'px');
        $(option_open_for).find('.wrapper').css('padding-right', json.order_action_padding_right + 'px');
        $(option_open_for).find('.wrapper').css('padding-bottom', json.order_action_padding_bottom + 'px');
        $(option_open_for).find('.wrapper').css('padding-left', json.order_action_padding_left + 'px');

        //margin
        $(option_open_for).find('.wrapper').css('margin-top', json.order_action_margin_top + 'px');
        $(option_open_for).find('.wrapper').css('margin-right', json.order_action_margin_right + 'px');
        $(option_open_for).find('.wrapper').css('margin-bottom', json.order_action_margin_bottom + 'px');
        $(option_open_for).find('.wrapper').css('margin-left', json.order_action_margin_left + 'px');

        $(settingsOpenModal).modal('hide');
    });


    //ORDER INFO
    $(document).on('click', '#order_info_setting_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_order_info_settings').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();

        $(option_open_for).find('.wrapper').css('text-align', json.order_info_setting_align);
        $(option_open_for).find('.wrapper > h1').html(json.order_successful_message); //colors
        $(option_open_for).find('.wrapper > h1').css('color', json.order_successful_message_color);
        //$(option_open_for).find('.wrapper').css('padding-top', json.heading_padding_top_settings);
        //$(option_open_for).find('.wrapper').css('padding-bottom', json.heading_padding_bottom_settings);
        //$(option_open_for).find('.wrapper > b').css('background-color', json.bg_color);


        //padding
        $(option_open_for).find('.wrapper').css('padding-top', json.order_info_padding_top + 'px');
        $(option_open_for).find('.wrapper').css('padding-right', json.order_info_padding_right + 'px');
        $(option_open_for).find('.wrapper').css('padding-bottom', json.order_info_padding_bottom + 'px');
        $(option_open_for).find('.wrapper').css('padding-left', json.order_info_padding_left + 'px');

        //margin
        $(option_open_for).find('.wrapper').css('margin-top', json.order_info_margin_top + 'px');
        $(option_open_for).find('.wrapper').css('margin-right', json.order_info_margin_right + 'px');
        $(option_open_for).find('.wrapper').css('margin-bottom', json.order_info_margin_bottom + 'px');
        $(option_open_for).find('.wrapper').css('margin-left', json.order_info_margin_left + 'px');

        $(settingsOpenModal).modal('hide');
    });


    //PAGE SETTINGS
    $(document).on('click', '#btn_page_settings', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_page_settings').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();

        $('#htmleditor').parent().parent().css('background', json.page_bg_color);
        $('#htmleditor').parent().parent().css('padding', json.page_setting_padding);

        var styles = "background:" + json.page_bg_color + ";";
        styles += "padding:" + json.page_setting_padding + "px;";

        $("#frm_htmleditor_save").find("textarea[name='pagestyle']").html(styles);

        $("#editorSettingModal").modal('hide');
    });


    //VARIENTS
    $(document).on('click', '#btn_save_product_description_setting', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_product_description_settings').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();

        $(option_open_for).find('.wrapper > div').html(json.product_description_text);
        $(option_open_for).find('.wrapper > div').css('text-align', json.select_product_description_align_option);
        $(option_open_for).find('.wrapper > div').css('color', json.description_color);
        //$(option_open_for).find('.wrapper > div').css('padding-top', json.description_setting_padding + 'px');
        //$(option_open_for).find('.wrapper > div').css('font-size', json.description_font_size + 'px');

        $(option_open_for).find('.wrapper > div').css('font-size', json.product_description_font_size + 'px');
        $(option_open_for).find('.wrapper > div > *').css('font-size', json.product_description_font_size + 'px');

        //line height
        $(option_open_for).find('.wrapper > div, .wrapper > div > *').css('line-height', json.product_description_line_height + 'px');

        //padding
        $(option_open_for).find('.wrapper').css('padding-top', json.product_description_padding_top + 'px');
        $(option_open_for).find('.wrapper').css('padding-right', json.product_description_padding_right + 'px');
        $(option_open_for).find('.wrapper').css('padding-bottom', json.product_description_padding_bottom + 'px');
        $(option_open_for).find('.wrapper').css('padding-left', json.product_description_padding_left + 'px');

        //margin
        $(option_open_for).find('.wrapper').css('margin-top', json.product_description_margin_top + 'px');
        $(option_open_for).find('.wrapper').css('margin-right', json.product_description_margin_right + 'px');
        $(option_open_for).find('.wrapper').css('margin-bottom', json.product_description_margin_bottom + 'px');
        $(option_open_for).find('.wrapper').css('margin-left', json.product_description_margin_left + 'px');

        $(settingsOpenModal).modal('hide');
    });


    //VARIENTS
    $(document).on('click', '#btn_save_product_price_setting', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_product_price_settings').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();

        $(option_open_for).find('.wrapper').css('text-align', json.select_product_price_align_option);
        $(option_open_for).find('.wrapper strong').html(json.price_as);
        $(option_open_for).find('.wrapper strong').css('color', json.price_color);
        //alert(json.frm_product_price_settings);
        $(option_open_for).find('.wrapper').css('padding-top', json.price_setting_padding + 'px');
        $(option_open_for).find('.wrapper strong').css('font-size', json.product_price_font_size + 'px');

        $(settingsOpenModal).modal('hide');
    });


    //VARIENTS
    $(document).on('click', '#btn_save_product_varients_setting', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_product_varients_settings').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();

        $(option_open_for).find('.wrapper').css('text-align', json.select_product_varient_align_option);
        $(option_open_for).find('.wrapper').css('padding-top', json.varient_setting_padding + 'px');

        $(settingsOpenModal).modal('hide');
    });


    //Image
    $(document).on('click', '#single_image_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_single_image_settings').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();

        $(option_open_for).find('.image-wrapper > .image > img').attr('src', json.path);
        $(option_open_for).find('.image-wrapper > .image > img').attr('alt', json.alt_text);
        $(option_open_for).find('.image-wrapper > .image').css('text-align', json.image_setting_align);

        if (json.image_gallery_width) {
            $(option_open_for).find('.image-wrapper > .image > img').css('width', json.image_gallery_width + '%');
        }
        //$(option_open_for).find('.image-wrapper > .image > img').css('width', json.image_gallery_width);
        else
            $(option_open_for).find('.image-wrapper > .image > img').css('width', 'auto');

        if (json.image_gallery_height)
            $(option_open_for).find('.image-wrapper > .image > img').attr('height', json.image_gallery_height);
        else
            $(option_open_for).find('.image-wrapper > .image > img').attr('height', 'auto');

        //Show/Hide additional image
        if (json.image_show_additionals) {
            $(option_open_for).find('.image-wrapper > .image > .additionals').css('display', 'block');
        } else {
            $(option_open_for).find('.image-wrapper > .image > .additionals').css('display', 'none');
        }

        //alert(json.image_padding_top);

        $(option_open_for).find('.image-wrapper > .image').css('padding-top', json.image_padding_top + 'px');
        $(option_open_for).find('.image-wrapper > .image').css('padding-right', json.image_padding_right + 'px');
        $(option_open_for).find('.image-wrapper > .image').css('padding-bottom', json.image_padding_bottom + 'px');
        $(option_open_for).find('.image-wrapper > .image').css('padding-left', json.image_padding_left + 'px');

        $(option_open_for).find('.image-wrapper > .image').css('margin-top', json.image_margin_top + 'px');
        $(option_open_for).find('.image-wrapper > .image').css('margin-right', json.image_margin_right + 'px');
        $(option_open_for).find('.image-wrapper > .image').css('margin-bottom', json.image_margin_bottom + 'px');
        $(option_open_for).find('.image-wrapper > .image').css('margin-left', json.image_margin_left + 'px');


        //border
        $(option_open_for).find('.image-wrapper img').css('border-width', json.image_border_size + 'px');
        $(option_open_for).find('.image-wrapper img').css('border-style', json.image_border_style);
        $(option_open_for).find('.image-wrapper img').css('border-color', json.image_border_color);
        $(option_open_for).find('.image-wrapper img').css('border-radius', json.image_border_radius + 'px');

        //shadow
        var type = (json.image_shadow_type != 'outset') ? json.image_shadow_type : '';
        var x_offset = json.image_shadow_x_offset + 'px';
        var y_offset = json.image_shadow_y_offset + 'px';
        var blur = json.image_shadow_blur + 'px';
        var color = json.image_shadow_color;
        var shadow_str = type + ' ' + x_offset + ' ' + y_offset + ' ' + blur + ' ' + color;

        //alert(shadow_str);

        $(option_open_for).find('.image-wrapper img').css('box-shadow', shadow_str);

        $(settingsOpenModal).modal('hide');
    });


    //after save manual product setting
    $(document).on('submit', '#frm_manual_product_settings', function (e) {

        e.preventDefault();

        var dataJson = "" + JSON.stringify($('#frm_manual_product_settings').serializeObject());
        var json = JSON.parse(dataJson);

        $(option_open_for).find(".details .price strong").html(json.price_as);
        $(option_open_for).find(".details .price strong").css('color', json.price_color);

        $(settingsOpenModal).modal('hide');
    });


    //SOCIAL SHARE
    $(document).on('click', '#social_share_setting_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_social_share_settings').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();

        $(option_open_for).find('.wrapper > .social-share').attr('data-title', json.social_share_title);
        $(option_open_for).find('.wrapper > .social-share').attr('data-url', json.social_url);
        var share_url = "https://twitter.com/share?url=" + json.social_url + "&via=TWITTER_HANDLE&text=TEXT";

        /*$(option_open_for).find('.wrapper > .social-share > li').each(function(index, element) {

            $(element).find('a').attr('href', encodeURI(share_url));
        });*/

        $(settingsOpenModal).modal('hide');
    });


    //PRICING TABLE
    $(document).on('click', '#pricing_table_setting_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_pricing_table_settings').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();

        $(option_open_for).find('.wrapper').html(json.pricing_table_html);

        $(settingsOpenModal).modal('hide');
    });


    //SELECTBOX
    $(document).on('click', '#select_box_setting_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_select_box_settings').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();

        $(option_open_for).find('.wrapper > select').attr('data-option-type', json.select_options);

        $(settingsOpenModal).modal('hide');
    });


    //EMBED VIDEO
    $(document).on('click', '#embed_videos_setting_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_embaded_video_settings').serializeObject());
        //console.log(data);
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();

        $(option_open_for).find('.wrapper > .video-holder img').attr('data-video-type', json.video_type);
        $(option_open_for).find('.wrapper > .video-holder img').attr('data-video-url', json.video_embed);
        $(option_open_for).find('.wrapper > .video-holder img').attr('data-video-autoplay', json.video_autoplay);
        $(option_open_for).find('.wrapper > .video-holder img').attr('data-video-controls', json.video_controls);
        $(option_open_for).find('.wrapper > .video-holder img').attr('data-video-branding', json.video_branding);
        $(option_open_for).find('.wrapper > .video-holder img').attr('data-video-width', json.video_width + 'px');
        $(option_open_for).find('.wrapper > .video-holder img').attr('data-video-height', json.video_height + 'px');


        if (json.embaded_video_image.length > 0) {

            $(option_open_for).find('.wrapper > .video-holder img').attr('src', json.embaded_video_image);
            $(option_open_for).find('.wrapper > .video-holder img').attr('style', 'width: 100% !important');
        }


        //border
        var css_border_style = "";
        css_border_style += "border-style:" + json.embaded_video_border_style + ' !important;';
        css_border_style += "border-width:" + json.embaded_video_border_size + '!important;';
        css_border_style += "border-color:" + json.embaded_video_border_color + ' !important;';
        $(option_open_for).find('.wrapper').attr('style', css_border_style);


        //padding
        $(option_open_for).find('.wrapper').css('padding-top', json.embaded_video_padding_top + 'px');
        $(option_open_for).find('.wrapper').css('padding-right', json.embaded_video_padding_right + 'px');
        $(option_open_for).find('.wrapper').css('padding-bottom', json.embaded_video_padding_bottom + 'px');
        $(option_open_for).find('.wrapper').css('padding-left', json.embaded_video_padding_left + 'px');

        //margin
        $(option_open_for).find('.wrapper').css('margin-top', json.embaded_video_margin_top + 'px');
        $(option_open_for).find('.wrapper').css('margin-right', json.embaded_video_margin_right + 'px');
        $(option_open_for).find('.wrapper').css('margin-bottom', json.embaded_video_margin_bottom + 'px');
        $(option_open_for).find('.wrapper').css('margin-left', json.embaded_video_margin_left + 'px');

        $(settingsOpenModal).modal('hide');
    });


    //ICON LIST
    $(document).on('click', '#icon_text_setting_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_icon_text_settings').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();

        //alert(json.hid_icon_list_class);

        //$(option_open_for).find('.wrapper > i').attr('data-align', json.alignment_type);
        //$(option_open_for).find('.wrapper > i').css('text-align', json.alignment_type);

        //$(option_open_for).find('.wrapper > ul').html(json.icon_list_text);
        //$(option_open_for).find('.wrapper > ul > li > span > i').attr('class', json.hid_icon_list_class);

        //alert(data);

        var html = "";

        //alert(json.list_text.length);


        //$(option_open_for).find('.wrapper > ul').html(html); json.hid_selected_icon

        //Icon
        $(option_open_for).find('.wrapper .icon-text > li > span').html('<i class="fa ' + json.hid_selected_icon + '" aria-hidden="true"></i>');

        //Text
        $(option_open_for).find('.wrapper .icon-text > li > strong').html(json.icon_text_paragraph_text);

        //weight
        $(option_open_for).find('.wrapper > ul > li strong').css('font-weight', json.icon_text_font_weight);

        //weight
        $(option_open_for).find('.wrapper > .icon-text > li').css('text-align', json.icon_text_text_align);

        //Font size
        $(option_open_for).find('.wrapper > ul > li i').css('font-size', json.icon_text_icon_size + 'px');
        $(option_open_for).find('.wrapper > ul > li > strong').css('font-size', json.icon_text_text_size + 'px');
        $(option_open_for).find('.wrapper > ul > li > strong > *').css('font-size', json.icon_text_text_size + 'px');

        //Icon position
        $(option_open_for).find('.wrapper > ul > li > span').css('vertical-align', json.icon_text_icon_position);

        //Line height
        $(option_open_for).find('.wrapper > ul > li > strong').css('line-height', json.icon_text_line_height + 'px');
        $(option_open_for).find('.wrapper > ul > li > strong > *').css('line-height', json.icon_text_line_height + 'px');

        //Icon Color
        $(option_open_for).find('.wrapper > ul > li i').css('color', json.icon_text_icon_color);

        //Text Color
        $(option_open_for).find('.wrapper > ul > li').css('color', json.icon_text_text_color);


        //padding
        $(option_open_for).find('.wrapper').css('padding-top', json.icon_text_padding_top + 'px');
        $(option_open_for).find('.wrapper').css('padding-right', json.icon_text_padding_right + 'px');
        $(option_open_for).find('.wrapper').css('padding-bottom', json.icon_text_padding_bottom + 'px');
        $(option_open_for).find('.wrapper').css('padding-left', json.icon_text_padding_left + 'px');

        //margin
        $(option_open_for).find('.wrapper').css('margin-top', json.icon_text_margin_top + 'px');
        $(option_open_for).find('.wrapper').css('margin-right', json.icon_text_margin_right + 'px');
        $(option_open_for).find('.wrapper').css('margin-bottom', json.icon_text_margin_bottom + 'px');
        $(option_open_for).find('.wrapper').css('margin-left', json.icon_text_margin_left + 'px');

        $(settingsOpenModal).modal('hide');
    });


    //Image LIST
    $(document).on('click', '#image_list_setting_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_image_list_settings').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();


        //for ( i=0; i<json.list_text.length; i++ ) {
        //html += '<li><span><i class="fa ' + json.hid_selected_icon + '" aria-hidden="true"></i></span> <strong>' + json.list_text[i] + '</strong></li>';
        //html += "<li style='background-image:" + json.path + ";font-size: 18px;background-repeat: no-repeat;background-position: 0px 0px;padding-left: 72px;'>" + json.list_text[i] + "</li>";
        //html += "<li style='background-image:" + json.path + ";font-size: 18px;background-repeat: no-repeat;background-position: 0px 0px;padding-left: 72px;'>" + json.list_text[i] + "</li>";
        //html += "<li data-img-url='{{ asset('images/orange-1.jpg) }}' style='background-image:url({{ "  + json.path +  " }});background-repeat: no-repeat;background-position: 0px 0px;padding-left: 72px;text-align:left;line-height: " + json.image_list_line_height + "px;font-size: " + json.image_list_text_size + ";font-weight:" + json.image_list_font_weight + "'>" + json.list_text[i] + "</li>";
        //}

        //adjust settings

        //$(option_open_for).find('.wrapper > ul').html(html);

        var html = "<li data-img-url='" + json.path + "' style='background-image:url(" + json.path + ");background-repeat: no-repeat;background-position: 0px 0px;text-align:left;line-height: " + json.image_list_line_height + "px;font-size: " + json.image_list_text_size + "px;font-weight:" + json.image_list_font_weight + ";background-size:" + json.image_list_image_size + ";padding-left:" + json.image_list_image_text_gap + "px'>" + json.image_text_paragraph_text + "</li>";
        $(option_open_for).find('.wrapper > ul').html(html);

        //weight
        //$(option_open_for).find('.wrapper > ul > li').css('font-weight', json.image_list_font_weight);

        //Font size
        //$(option_open_for).find('.wrapper > ul > li').css('font-size', json.image_list_text_size + 'px');


        //Line height
        //$(option_open_for).find('.wrapper > ul > li').css('line-height', json.image_list_line_height + 'px');


        //Text Color
        $(option_open_for).find('.wrapper > ul > li').css('color', json.icon_list_text_color);


        //padding
        $(option_open_for).find('.wrapper').css('padding-top', json.image_list_padding_top + 'px');
        $(option_open_for).find('.wrapper').css('padding-right', json.image_list_padding_right + 'px');
        $(option_open_for).find('.wrapper').css('padding-bottom', json.image_list_padding_bottom + 'px');
        $(option_open_for).find('.wrapper').css('padding-left', json.image_list_padding_left + 'px');

        //margin
        $(option_open_for).find('.wrapper').css('margin-top', json.image_list_margin_top + 'px');
        $(option_open_for).find('.wrapper').css('margin-right', json.image_list_margin_right + 'px');
        $(option_open_for).find('.wrapper').css('margin-bottom', json.image_list_margin_bottom + 'px');
        $(option_open_for).find('.wrapper').css('margin-left', json.image_list_margin_left + 'px');

        $(settingsOpenModal).modal('hide');
    });


    //ICON LIST
    $(document).on('click', '#icon_list_setting_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_icon_list_settings').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();

        //alert(json.hid_icon_list_class);

        //$(option_open_for).find('.wrapper > i').attr('data-align', json.alignment_type);
        //$(option_open_for).find('.wrapper > i').css('text-align', json.alignment_type);

        //$(option_open_for).find('.wrapper > ul').html(json.icon_list_text);
        //$(option_open_for).find('.wrapper > ul > li > span > i').attr('class', json.hid_icon_list_class);

        //alert(data);

        var html = "";

        //alert(json.list_text.length);

        for (i = 0; i < json.list_text.length; i++) {
            html += '<li><span><i class="fa ' + json.hid_selected_icon + '" aria-hidden="true"></i></span> <strong>' + json.list_text[i] + '</strong></li>';
        }

        $(option_open_for).find('.wrapper > ul').html(html);

        //weight
        $(option_open_for).find('.wrapper > ul > li strong').css('font-weight', json.icon_list_font_weight);

        //icon text gap
        $(option_open_for).find('.wrapper > ul > li').css('padding-left', json.icon_list_icon_text_gap + 'px');

        //Font size
        $(option_open_for).find('.wrapper > ul > li i').css('font-size', json.icon_list_icon_size + 'px');
        $(option_open_for).find('.wrapper > ul > li > strong').css('font-size', json.icon_list_text_size + 'px');


        //Line height
        $(option_open_for).find('.wrapper > ul > li').css('line-height', json.icon_list_line_height + 'px');

        //Icon Color
        $(option_open_for).find('.wrapper > ul > li i').css('color', json.icon_list_icon_color);

        //Text Color
        $(option_open_for).find('.wrapper > ul > li').css('color', json.icon_list_text_color);


        //padding
        $(option_open_for).find('.wrapper').css('padding-top', json.icon_list_padding_top + 'px');
        $(option_open_for).find('.wrapper').css('padding-right', json.icon_list_padding_right + 'px');
        $(option_open_for).find('.wrapper').css('padding-bottom', json.icon_list_padding_bottom + 'px');
        $(option_open_for).find('.wrapper').css('padding-left', json.icon_list_padding_left + 'px');

        //margin
        $(option_open_for).find('.wrapper').css('margin-top', json.icon_list_margin_top + 'px');
        $(option_open_for).find('.wrapper').css('margin-right', json.icon_list_margin_right + 'px');
        $(option_open_for).find('.wrapper').css('margin-bottom', json.icon_list_margin_bottom + 'px');
        $(option_open_for).find('.wrapper').css('margin-left', json.icon_list_margin_left + 'px');

        $(settingsOpenModal).modal('hide');
    });


    //ICON
    $(document).on('click', '#icon_setting_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_icon_settings').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();

        $(option_open_for).find('.wrapper > i').attr('data-align', json.alignment_type);
        $(option_open_for).find('.wrapper > i').css('text-align', json.alignment_type);
        $(option_open_for).find('.wrapper > i').attr('class', json.hid_icon_class);
        $(option_open_for).find('.wrapper > i').css('color', json.icon_color);


        //padding
        $(option_open_for).find('.wrapper > i').css('padding-top', json.icon_padding_top + 'px');
        $(option_open_for).find('.wrapper > i').css('padding-right', json.icon_padding_right + 'px');
        $(option_open_for).find('.wrapper > i').css('padding-bottom', json.icon_padding_bottom + 'px');
        $(option_open_for).find('.wrapper > i').css('padding-left', json.icon_padding_left + 'px');

        //margin
        $(option_open_for).find('.wrapper > i').css('margin-top', json.icon_margin_top + 'px');
        $(option_open_for).find('.wrapper > i').css('margin-right', json.icon_margin_right + 'px');
        $(option_open_for).find('.wrapper > i').css('margin-bottom', json.icon_margin_bottom + 'px');
        $(option_open_for).find('.wrapper > i').css('margin-left', json.icon_margin_left + 'px');


        $(option_open_for).find('.wrapper > i').css('border-width', json.icon_border_size + 'px');
        $(option_open_for).find('.wrapper > i').css('border-style', json.icon_border_style);
        $(option_open_for).find('.wrapper > i').css('border-color', json.icon_border_color);
        $(option_open_for).find('.wrapper > i').css('border-radius', json.icon_border_radius + 'px');

        //data-border-style
        $(option_open_for).find('.wrapper > i').attr('data-border-style', json.icon_border_style);

        $(settingsOpenModal).modal('hide');
    });


    //SEPERATOR
    $(document).on('click', '#seperator_setting_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_seperator_settings').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();

        //alert(json.hid_seperator_margin);

        //$(option_open_for).find('.wrapper > hr').css('border-color', json.seperator_color);
        //$(option_open_for).find('.wrapper > hr').css({'margin-top': json.hid_seperator_margin, 'margin-bottom': json.hid_seperator_margin});
        $(option_open_for).find('.wrapper > hr').css('margin-top', json.hid_seperator_margin);


        //alert(json.seperator_padding_top);
        var str_body_css = "";
        if (json.seperator_border_style.length > 0) {
            str_body_css += 'border-style:' + json.seperator_border_style + ' !important;';
            str_body_css += 'border-color:' + json.seperator_border_color + ' !important;';
            str_body_css += 'border-width:' + json.seperator_border_size + ' !important;';
            //str_body_css += 'border-radius:' + json.row_setting_border_radius + 'px !important;';
        }

        $(option_open_for).find('.wrapper > hr').attr('style', str_body_css);

        //padding
        $(option_open_for).find('.wrapper').css('padding-top', json.seperator_padding_top + 'px');
        $(option_open_for).find('.wrapper').css('padding-right', json.seperator_padding_right + 'px');
        $(option_open_for).find('.wrapper').css('padding-bottom', json.seperator_padding_bottom + 'px');
        $(option_open_for).find('.wrapper').css('padding-left', json.seperator_padding_left + 'px');

        //margin
        $(option_open_for).find('.wrapper').css('margin-top', json.seperator_margin_top + 'px');
        $(option_open_for).find('.wrapper').css('margin-right', json.seperator_margin_right + 'px');
        $(option_open_for).find('.wrapper').css('margin-bottom', json.seperator_margin_bottom + 'px');
        $(option_open_for).find('.wrapper').css('margin-left', json.seperator_margin_left + 'px');


        $(settingsOpenModal).modal('hide');
    });


    //PARAGRAPH
    $(document).on('click', '#paragraph_setting_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_paragraph_settings').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();

        $(option_open_for).find('.wrapper').html(json.paragraph_text); //colors
        $(option_open_for).find('.wrapper').css('color', json.paragraph_text_color + ' !important');
        //$(option_open_for).find('.wrapper').css('color', json.paragraph_text_color);
        $(option_open_for).find('.wrapper').css('background-color', json.paragraph_bg_color);

        //line height
        //alert(json.paragraph_line_height);
        var css = "";

        if (json.paragraph_line_height.length > 0) {
            css += 'line-height:' + json.paragraph_line_height + 'px !important;';
        }

        if (json.paragraph_font_size.length > 0) {
            css += 'font-size:' + json.paragraph_font_size + 'px !important;';
        }

        $(option_open_for).find('.wrapper > p').attr('style', css);

        //align
        //alert(json.paragraph_alignment);
        $(option_open_for).find('.wrapper').attr('style', $(option_open_for).find('.wrapper').attr('style') + ';text-align:' + json.paragraph_alignment + '!important');
        $(option_open_for).find('.wrapper > *').css('text-align', json.paragraph_alignment + '!important');

        //padding
        /*$(option_open_for).find('.wrapper').css('padding-top', json.paragraph_padding_top + 'px');
        $(option_open_for).find('.wrapper').css('padding-right', json.paragraph_padding_right + 'px');
        $(option_open_for).find('.wrapper').css('padding-bottom', json.paragraph_padding_bottom + 'px');
        $(option_open_for).find('.wrapper').css('padding-left', json.paragraph_padding_left + 'px');*/

        //margin
        $(option_open_for).find('.wrapper').css('margin-top', json.paragraph_margin_top + 'px');
        $(option_open_for).find('.wrapper').css('margin-right', json.paragraph_margin_right + 'px');
        $(option_open_for).find('.wrapper').css('margin-bottom', json.paragraph_margin_bottom + 'px');
        $(option_open_for).find('.wrapper').css('margin-left', json.paragraph_margin_left + 'px');

        if (json.paragraph_shadow_size > 0) {
            //padding_style += "text-shadow: 1px 2px " + json.headline_shadow_size + "px #666;";
            $(option_open_for).find('.wrapper').css('text-shadow', '1px 2px ' + json.paragraph_shadow_size + 'px #888888');
        } else {
            $(option_open_for).find('.wrapper').css('text-shadow', 'none');
        }


        //fonts
        var padding_style = "padding-top:" + json.paragraph_padding_top + 'px;';
        padding_style += "padding-right:" + json.paragraph_padding_right + 'px;';
        padding_style += "padding-bottom:" + json.paragraph_padding_bottom + 'px;';
        padding_style += "padding-left:" + json.paragraph_padding_left + 'px;';
        padding_style += "font-family: '" + json.paragraph_text_font_family + "' !important;";
        padding_style += "display:block;";
        $(option_open_for).find('.wrapper').attr('style', $(option_open_for).find('.wrapper').attr('style') + padding_style);

        $(option_open_for).find('.wrapper *').each(function (index, element) {
            //$(element).attr('style', $(element).attr('style') + 'font-family:' + json.sub_headline_text_font_family + ' !important;');
            if (typeof $(element).css('font-family') != 'undefined') {
                $(element).css('font-family', json.paragraph_text_font_family + ' !important');
            }
        });
        //$(option_open_for).find('.wrapper *').css('font-family', "'" + json.sub_headline_text_font_family + "' !important");

        $(option_open_for).find('.wrapper font').attr('face', json.sub_headline_text_font_family);

        if ($("#title_after_font_style").length == 0)
            $('title').after('<link id="title_after_font_style" rel="stylesheet" href="https://fonts.googleapis.com/css?family=' + encodeURI(json.hid_font_family) + '">');
        else
            $('title').after('<link id="title_after_font_style" rel="stylesheet" href="https://fonts.googleapis.com/css?family=' + encodeURI(json.hid_font_family) + '">');

        if ($("#external_fonts").val().length > 0)
            $('#external_fonts').val($("#external_fonts").val() + "," + encodeURI(json.hid_font_family));
        else
            $('#external_fonts').val(encodeURI(json.hid_font_family));

        $(settingsOpenModal).modal('hide');
    });


    //SUB HEADLINE
    $(document).on('click', '#sub_headline_setting_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_sub_headline_settings').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();

        //font
        //alert(json.sub_headline_text_font_family);

        if ($("#title_after_font_style").length == 0)
            $('title').after('<link id="title_after_font_style" rel="stylesheet" href="https://fonts.googleapis.com/css?family=' + encodeURI(json.hid_font_family) + '">');
        else
            $('title').after('<link id="title_after_font_style" rel="stylesheet" href="https://fonts.googleapis.com/css?family=' + encodeURI(json.hid_font_family) + '">');

        if ($("#external_fonts").val().length > 0)
            $('#external_fonts').val($("#external_fonts").val() + "," + encodeURI(json.hid_font_family));
        else
            $('#external_fonts').val(encodeURI(json.hid_font_family));


        $(option_open_for).find('.wrapper').css('text-align', json.sub_headline_setting_align);

        $(option_open_for).find('.wrapper > p').html(json.sub_headline_text); //colors

        $(option_open_for).find('.wrapper > p').css('color', json.sub_headline_text_color);
        $(option_open_for).find('.wrapper').css('background-color', json.sub_headline_bg_color);

        //Font
        $(option_open_for).find('.wrapper > p').css('font-size', json.sub_headline_font_size + 'px');

        //Font Weight
        $(option_open_for).find('.wrapper > p').css('font-weight', json.sub_headline_font_weight);

        //Line Height
        $(option_open_for).find('.wrapper > p').css('line-height', json.sub_headline_line_height + 'px');

        //padding
        /*$(option_open_for).find('.wrapper').css('padding-top', json.sub_headline_padding_top + 'px');
        $(option_open_for).find('.wrapper').css('padding-right', json.sub_headline_padding_right + 'px');
        $(option_open_for).find('.wrapper').css('padding-bottom', json.sub_headline_padding_bottom + 'px');
        $(option_open_for).find('.wrapper').css('padding-left', json.sub_headline_padding_left + 'px');

        //margin
        */

        var padding_style = "padding-top:" + json.sub_headline_padding_top + 'px;';
        padding_style += "padding-right:" + json.sub_headline_padding_right + 'px;';
        padding_style += "padding-bottom:" + json.sub_headline_padding_bottom + 'px;';
        padding_style += "padding-left:" + json.sub_headline_padding_left + 'px;';
        padding_style += "font-family: '" + json.sub_headline_text_font_family + "' !important;";
        padding_style += "display:block;";
        $(option_open_for).find('.wrapper').attr('style', padding_style);

        $(option_open_for).find('.wrapper *').each(function (index, element) {
            //$(element).attr('style', $(element).attr('style') + 'font-family:' + json.sub_headline_text_font_family + ' !important;');
            if (typeof $(element).css('font-family') != 'undefined') {
                $(element).css('font-family', json.sub_headline_text_font_family + ' !important');
            }
        });
        //$(option_open_for).find('.wrapper *').css('font-family', "'" + json.sub_headline_text_font_family + "' !important");

        $(option_open_for).find('.wrapper font').attr('face', json.sub_headline_text_font_family);

        $(option_open_for).find('.wrapper').css('margin-top', json.sub_headline_margin_top + 'px');
        $(option_open_for).find('.wrapper').css('margin-right', json.sub_headline_margin_right + 'px');
        $(option_open_for).find('.wrapper').css('margin-bottom', json.sub_headline_margin_bottom + 'px');
        $(option_open_for).find('.wrapper').css('margin-left', json.sub_headline_margin_left + 'px');

        //alert(json.sub_headline_shadow_size);

        if (json.sub_headline_shadow_size > 0) {
            //padding_style += "text-shadow: 1px 2px " + json.headline_shadow_size + "px #666;";
            $(option_open_for).find('.wrapper > p').css('text-shadow', '1px 2px ' + json.sub_headline_shadow_size + 'px #888888');
        } else {
            $(option_open_for).find('.wrapper > p').css('text-shadow', 'none');
        }

        $(settingsOpenModal).modal('hide');
    });


    //HEADLINE
    $(document).on('click', '#headline_setting_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_headline_settings').serializeObject());
        
        var json = JSON.parse(data);
        console.log(json);

        $.each(json, function(k, v) {

            if (Array.isArray(v)) { 
                console.log("ARR: " + k + ', ' + v[0]);               
                json[k] = v[0];
            }
        });

        // console.log(json.headline_padding_left);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();

        //alert(json.headline_text);

        //alert(json.text_color);
        $(option_open_for).find('.wrapper').css('text-align', json.headline_setting_align);
        //$(option_open_for).find('.wrapper > b').html(json.headline_text); //colors
        $(option_open_for).find('.wrapper > b').html(json.headline_text); //colors
        $(option_open_for).find('.wrapper > b').css('color', json.headline_text_color);
        //$(option_open_for).find('.wrapper').css('padding-top', json.heading_padding_top_settings);
        //$(option_open_for).find('.wrapper').css('padding-bottom', json.heading_padding_bottom_settings);
        $(option_open_for).find('.wrapper').css('background-color', json.main_headline_bg_color);

        if (json.main_headline_bg_color.length > 1)
            $(option_open_for).css('border', "2px solid " + json.main_headline_bg_color);


        if ($("#title_after_font_style").length == 0)
            $('title').after('<link id="title_after_font_style" rel="stylesheet" href="https://fonts.googleapis.com/css?family=' + encodeURI(json.hid_font_family) + '">');
        else
            $('title').after('<link id="title_after_font_style" rel="stylesheet" href="https://fonts.googleapis.com/css?family=' + encodeURI(json.hid_font_family) + '">');

        if ($("#external_fonts").val().length > 0)
            $('#external_fonts').val($("#external_fonts").val() + "," + encodeURI(json.hid_font_family));
        else
            $('#external_fonts').val(encodeURI(json.hid_font_family));
        //$(option_open_for).find('.wrapper > b').css('font-family', json.hid_font_family);

        console.log("SAVING: " + json.headline_padding_left);

        var padding_style = "padding-top:" + json.headline_padding_top + 'px;';
        padding_style += "padding-right:" + json.headline_padding_right + 'px;';
        padding_style += "padding-bottom:" + json.headline_padding_bottom + 'px;';
        padding_style += "padding-left:" + json.headline_padding_left + 'px;';
        padding_style += "font-size:" + json.headline_font_size + 'px;';
        padding_style += "font-family:" + json.headline_text_font + ' !important;';
        padding_style += "display:block;";
        padding_style += "color:" + json.headline_text_color + "!important;";

        if (json.headline_shadow_size > 0) {
            padding_style += "text-shadow: 1px 2px " + json.headline_shadow_size + "px #000000;";
        } else {
            padding_style += "text-shadow:none;";
        }

        $(option_open_for).find('.wrapper > b').attr('style', padding_style);
        $(option_open_for).find('.wrapper > b > *').css('font-family', json.headline_text_font + ' !important');
        $(option_open_for).find('.wrapper > b font').attr('face', json.headline_text_font);

        //margin
        $(option_open_for).find('.wrapper').css('margin-top', json.headline_margin_top + 'px');
        $(option_open_for).find('.wrapper').css('margin-right', json.headline_margin_right + 'px');
        $(option_open_for).find('.wrapper').css('margin-bottom', json.headline_margin_bottom + 'px');
        $(option_open_for).find('.wrapper').css('margin-left', json.headline_margin_left + 'px');

        $(settingsOpenModal).modal('hide');
    });


    //GRID 1
    $(document).on('click', '#grid_one_setting_save', function (e) {

        e.preventDefault();

        //alert(this);

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#grid_one_row_settings').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        //var $element = $(this).parent().parent();

        //$(option_open_for).css('padding-top', json.grid1_setting_padding + 'px');

        $(option_open_for).attr('id', json.grid_one_setting_section_id);

        //alert($(option_open_for));
        $(option_open_for).css('color', json.grid_one_text_color);
        //$(option_open_for).css('background', json.grid_one_bg_color);
        //$(option_open_for).find('.sub-parent > .g-container').css('background-color', json.grid_one_inner_bg_color + ' !important');

        var css_border_style = "";


        css_border_style += "border-style:" + json.grid_one_border_style + ' !important;';
        css_border_style += "border-width:" + json.grid_one_border_size + ' !important;';
        css_border_style += "border-color:" + json.grid_one_border_color + ' !important;';

        /*if ( json.grid_one_bg_color.length > 0 ) {
            //$(option_open_for).find('.lb-content-body').attr('style', "background-color:" + json.grid_one_bg_color);
            css_border_style += "background-color:" + json.grid_one_bg_color + ' !important;';
        }*/

        //border


        var str_bg_pos = "";
        var positions = json.grid_one_image_position;
        var background_image = (json.grid_one_bg_image.length > 0) ? "background-image: url('" + json.grid_one_bg_image + "');" : "";
        //str_bg_pos += background_image;

        if (positions == 'bgCover') {
            str_bg_pos = 'background-size: cover !important; -webkit-background-size: cover !important; background-attachment: fixed !important; background-repeat: repeat !important;';
        } else if (positions == 'bgCover100') {
            str_bg_pos = 'background-size: 100% auto !important; -webkit-background-size: 100% auto !important; background-repeat: no-repeat !important;';
        } else if (positions == 'bgNoRepeat') {
            str_bg_pos = 'background-repeat: no-repeat !important;';
        } else if (positions == 'bgRepeatX') {
            str_bg_pos = 'background-repeat: repeat-x !important;';
        } else if (positions == 'bgRepeatY') {
            str_bg_pos = 'background-repeat: repeat-y !important;';
        } else if (positions == 'bgRepeatXTop') {
            str_bg_pos = 'background-repeat: repeat-x !important; background-position: top !important;';
        } else if (positions == 'bgRepeatXBottom') {
            str_bg_pos = 'background-repeat: repeat-x !important; background-position: bottom !important;';
        }

        if (json.grid_one_text_color)
            str_bg_pos += "color: " + json.grid_one_text_color + ';';

        if (json.grid_one_bg_color)
            str_bg_pos += "background-color: " + json.grid_one_bg_color + ';';

        str_bg_pos += background_image;

        str_bg_pos += 'margin-top:' + json.grid_setting_margin_top + 'px;';
        str_bg_pos += 'margin-bottom:' + json.grid_setting_margin_bottom + 'px;';


        /*if (json.grid_one_container_bg_color.length > 0) { //.find('.sub-parent > .element-groups')

            if (json.grid_one_container_bg_opacity.length > 0) {
                str_bg_pos += "background-color:rgba(" + hex2Rgb(json.grid_one_container_bg_color, json.grid_one_container_bg_opacity) + ");"
                $(option_open_for).attr('data-container-bg-opacity', json.grid_one_container_bg_opacity);
            } else
                str_bg_pos += "background-color:" + json.grid_one_container_bg_color + ";"
        }*/

        if (json.grid_one_bg_color.length > 0) { //.find('.sub-parent > .element-groups')

            if (json.grid_one_container_bg_opacity.length > 0) {
                str_bg_pos += "background-color:rgba(" + hex2Rgb(json.grid_one_bg_color, json.grid_one_container_bg_opacity) + ");"
                $(option_open_for).attr('data-container-bg-opacity', json.grid_one_container_bg_opacity);
            }
        }


        //opacity
        /*if ( json.grid_one_container_bg_opacity.length > 0 ) {
            str_bg_pos += "opacity:" + json.grid_one_container_bg_opacity + ";"
        }*/

        ////console.log(str_bg_pos);

        //alert(json.grid_one_bg_color.length);


        if (json.grid_one_border_apply_for == 'inner') {
            $(option_open_for).attr('data-border-apply-for', 'inner');
            $(option_open_for).attr('data-border-type', json.grid_one_border_type);

            /*$(option_open_for).find('.sub-parent').css('border-style', json.grid_one_border_style + ' !important');
            $(option_open_for).find('.sub-parent').css('border-width', json.grid_one_border_size + 'px !important');
            $(option_open_for).find('.sub-parent').css('border-color', json.grid_one_border_color + ' !important');*/

            $(option_open_for).find('.lb-content-body').attr('style', "border: none");
            //$(option_open_for).find('.sub-parent > .g-container').attr('style', css_border_style);
            $(option_open_for).find('.sub-parent > .element-groups').attr('style', css_border_style);

        } else {
            $(option_open_for).attr('data-border-apply-for', '');
            $(option_open_for).find('.sub-parent > .g-container').attr('style', "border: none");
            $(option_open_for).attr('data-border-type', json.grid_one_border_type);

            $(option_open_for).find('.lb-content-body').attr('style', "border: none");
            //$(option_open_for).find('.sub-parent > .g-container').attr('style', css_border_style);
            $(option_open_for).find('.sub-parent > .element-groups').attr('style', "border: none");

            if (json.grid_one_border_style.length > 0) {
                str_bg_pos += "border-style:" + json.grid_one_border_style + ";";
                str_bg_pos += "border-width:" + json.grid_one_border_size + ";";
                str_bg_pos += "border-color:" + json.grid_one_border_color + ";";
            }
        }

        str_bg_pos += "border-radius:" + json.grid_one_border_radius + "px;";

        //console.log(str_bg_pos);

        //shadow
        if (json.grid_setting_shadow > 0) {
            //$(option_open_for).css('box-shadow', '0px 0px ' + eval(json.grid_setting_shadow) + 'px ' + (eval(json.grid_setting_shadow) / 2) + 'px rgba(0,0,0,0.75)');
            str_bg_pos += 'box-shadow: 0px 0px ' + eval(json.grid_setting_shadow) + 'px ' + (eval(json.grid_setting_shadow) / 2) + 'px rgba(0,0,0,0.75);';
            str_bg_pos += '-webkit-box-shadow: 0px 0px ' + eval(json.grid_setting_shadow) + 'px ' + (eval(json.grid_setting_shadow) / 2) + 'px rgba(0,0,0,0.75);';
            str_bg_pos += '-moz-box-shadow: 0px 0px ' + eval(json.grid_setting_shadow) + 'px ' + (eval(json.grid_setting_shadow) / 2) + 'px rgba(0,0,0,0.75);';
        }

        $(option_open_for).attr('style', str_bg_pos);
        $(option_open_for).attr('data-row-type', json.header_row_type);
        $(option_open_for).attr('data-bg-position', positions);
        $(option_open_for).attr('data-bg-image', json.grid_one_bg_image);

        //$(option_open_for).css('background-image', background_image);
        //$(option_open_for).css(str_bg_pos);

        ///////////
        //alert(json.grid_one_container_bg_color);
        if (json.grid_one_container_bg_color.length > 0) {

            $(option_open_for).find('.sub-parent > .element-groups').css('background-color', json.grid_one_container_bg_color + ' !important');
            //alert($(option_open_for).find('.sub-parent > .element-groups').attr('style'));
        }


        //padding
        $(option_open_for).css('padding-top', json.grid_setting_padding_top + 'px');
        $(option_open_for).css('padding-right', json.grid_setting_padding_right + 'px');
        $(option_open_for).css('padding-bottom', json.grid_setting_padding_bottom + 'px');
        $(option_open_for).css('padding-left', json.grid_setting_padding_left + 'px');


        //margin
        //$(option_open_for).css('margin-top', json.grid_setting_margin_top + 'px');
        //$(option_open_for).css('margin-bottom', json.grid_setting_margin_bottom + 'px');

        $(settingsOpenModal).modal('hide');
    });

    //GRID 2
    $(document).on('click', '#grid_two_setting_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#grid_two_row_settings').serializeObject());
        var json = JSON.parse(data);

        $(option_open_for).css('padding-top', json.grid2_setting_padding + 'px');

        //alert($(this).find('#headline_text').val());
        //var $element = $(this).parent().parent();

        //alert($(option_open_for));
        $(option_open_for).css('color', json.text_color);
        $(option_open_for).css('background', json.bg_color);

        $(settingsOpenModal).modal('hide');
    });

    //GRID 3
    $(document).on('click', '#grid_three_setting_save', function (e) {

        e.preventDefault();

        //alert(this);

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#grid_three_row_settings').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        //var $element = $(this).parent().parent();

        //alert($(option_open_for));
        $(option_open_for).css('color', json.text_color);
        $(option_open_for).css('background', json.bg_color);

        $(settingsOpenModal).modal('hide');
    });

    //GRID 4
    $(document).on('click', '#grid_four_setting_save', function (e) {

        e.preventDefault();

        //alert(this);

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#grid_four_row_settings').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        //var $element = $(this).parent().parent();

        //alert($(option_open_for));
        $(option_open_for).css('color', json.text_color);
        $(option_open_for).css('background', json.bg_color);

        $(settingsOpenModal).modal('hide');
    });


    //Header Row
    $(document).on('click', '#header_row_setting_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_header_row_settings').serializeObject());
        var json = JSON.parse(data);

        //alert(json.header_row_type);

        if (json.header_row_type == 'small') {
            if ($(option_open_for).hasClass('row-full'))
                $(option_open_for).removeClass('row-full');
            else if ($(option_open_for).hasClass('row-medium'))
                $(option_open_for).removeClass('row-medium');

            $(option_open_for).addClass('row-small');
        } else if (json.header_row_type == 'large') {
            if ($(option_open_for).hasClass('row-small'))
                $(option_open_for).removeClass('row-small');
            else if ($(option_open_for).hasClass('row-medium'))
                $(option_open_for).removeClass('row-medium');

            $(option_open_for).addClass('row-full');
        } else {
            if ($(option_open_for).hasClass('row-smal'))
                $(option_open_for).removeClass('row-smal');
            else if ($(option_open_for).hasClass('row-full'))
                $(option_open_for).removeClass('row-full');

            $(option_open_for).addClass('row-medium');
        }

        //alert(json.row_setting_padding);

        //$(option_open_for).css('padding-top', json.row_setting_padding);
        //$(option_open_for).css('margin-top', json.row_setting_margin + "px");

        //alert(json.header_row_bg_color);
        $(option_open_for).css('color', json.header_row_text_color);
        //$(option_open_for).css('background-color', json.header_row_bg_color + ' !important');

        //alert(json.header_row_padding_top);


        var element = $(option_open_for);
        var positions = json.header_row_background_image_position;
        var background_image = "background-image: url('" + json.header_row_setting_image_path + "');";
        var str_bg_pos = "";


        if (positions == 'bgCover') {
            str_bg_pos = 'background-size: cover !important; -webkit-background-size: cover !important; background-attachment: fixed !important; background-repeat: repeat repeat !important;';
        } else if (positions == 'bgCover100') {
            str_bg_pos = 'background-size: 100% auto !important; -webkit-background-size: 100% auto !important; background-repeat: no-repeat !important;';
        } else if (positions == 'bgNoRepeat') {
            str_bg_pos = 'background-repeat: no-repeat !important;';
        } else if (positions == 'bgRepeatX') {
            str_bg_pos = 'background-repeat: repeat-x !important;';
        } else if (positions == 'bgRepeatY') {
            str_bg_pos = 'background-repeat: repeat-y !important;';
        } else if (positions == 'bgRepeatXTop') {
            str_bg_pos = 'background-repeat: repeat-x !important; background-position: top !important;';
        } else if (positions == 'bgRepeatXBottom') {
            str_bg_pos = 'background-repeat: repeat-x !important; background-position: bottom !important;';
        }

        if (json.header_row_bg_color) {
            str_bg_pos += "background-color: " + json.header_row_bg_color + ';';
        }

        str_bg_pos += background_image;
        //console.log(str_bg_pos);

        var str_padding_pos = "";


        //remove css class to apply the changes
        if (json.header_row_padding_top > 0) {
            if ($(option_open_for).hasClass('less-padding')) {
                $(option_open_for).removeClass('less-padding');
            }

            str_padding_pos += 'padding-top:' + json.header_row_padding_top + 'px !important;';
            str_padding_pos += 'padding-right:' + json.header_row_padding_right + 'px !important;';
            str_padding_pos += 'padding-bottom:' + json.header_row_padding_bottom + 'px !important;';
            str_padding_pos += 'padding-left:' + json.header_row_padding_left + 'px !important;';

            /*str_bg_pos += 'margin-top:' + json.header_row_margin_top + 'px !important;';
            str_bg_pos += 'margin-right:' + json.header_row_margin_right + 'px !important;';
            str_bg_pos += 'margin-bottom:' + json.header_row_margin_bottom + 'px !important;';
            str_bg_pos += 'margin-left:' + json.header_row_margin_left + 'px !important;';*/
        }


        //$(element).css({background: "url('" + json.path + "')"});
        $(element).attr('style', str_bg_pos);
        $(element).attr('data-row-type', json.header_row_type);
        $(element).attr('data-bg-position', positions);
        $(element).attr('data-bg-image', json.header_row_setting_image_path);

        $(option_open_for).css('background-image', background_image);
        $(option_open_for).css(str_bg_pos);


        $(element).find('.lb-content-body').attr('style', str_padding_pos);

        /*$(option_open_for).css('margin-top', json.header_row_margin_top + 'px !important');
        $(option_open_for).css('margin-right', json.header_row_margin_right + 'px !important');
        $(option_open_for).css('margin-bottom', json.header_row_margin_bottom + 'px !important');
        $(option_open_for).css('margin-left', json.header_row_margin_left + 'px !important');*/

        $(settingsOpenModal).modal('hide');
    });


    //Row
    $(document).on('click', '#row_setting_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_row_settings').serializeObject());
        var json = JSON.parse(data);

        //alert(json.row_type);

        if (json.row_type == 'small') {
            if ($(option_open_for).hasClass('element-section-full'))
                $(option_open_for).removeClass('element-section-full');
            else if ($(option_open_for).hasClass('element-section-medium'))
                $(option_open_for).removeClass('element-section-medium');

            $(option_open_for).addClass('element-section-small');
        } else if (json.row_type == 'large') {
            if ($(option_open_for).hasClass('element-section-small'))
                $(option_open_for).removeClass('element-section-small');
            else if ($(option_open_for).hasClass('element-section-medium'))
                $(option_open_for).removeClass('element-section-medium');

            $(option_open_for).addClass('element-section-full');
        } else {
            if ($(option_open_for).hasClass('element-section-small'))
                $(option_open_for).removeClass('element-section-small');
            else if ($(option_open_for).hasClass('element-section-full'))
                $(option_open_for).removeClass('element-section-full');

            $(option_open_for).addClass('element-section-medium');
        }

        //alert(json.row_setting_padding);

        $(option_open_for).css('padding-top', json.row_setting_padding);
        //$(option_open_for).css('margin-top', json.row_setting_margin + "px");

        //alert($(option_open_for));
        //$(option_open_for).css('color', json.text_color);
        //$(option_open_for).css('background-color', json.bg_color);

        //alert($(option_open_for).find('.lb-content-body').html());

        $(option_open_for).attr('data-content-width', json.row_setting_content_width);

        if (json.row_setting_content_width == 'fixed') {
            $(option_open_for).children('div:first-child').addClass('container');
        } else {
            $(option_open_for).children('div:first-child').removeClass('container');
        }

        var element = $(option_open_for);
        var element_body = $(option_open_for).children('.lb-content-body');
        var positions = json.row_background_image_position;
        var background_image = (json.row_setting_image_path.length > 0) ? "background-image: url('" + json.row_setting_image_path + "');" : "";
        var str_bg_pos = "";
        var str_body_css = "";
        //alert(json.row_setting_image_path.length);

        if (positions == 'bgCover') {
            str_bg_pos = 'background-size: cover !important; -webkit-background-size: cover !important; background-attachment: fixed !important; background-repeat: repeat repeat !important;';
        } else if (positions == 'bgCover100') {
            str_bg_pos = 'background-size: 100% auto !important; -webkit-background-size: 100% auto !important; background-repeat: no-repeat !important;';
        } else if (positions == 'bgNoRepeat') {
            str_bg_pos = 'background-repeat: no-repeat !important;';
        } else if (positions == 'bgRepeatX') {
            str_bg_pos = 'background-repeat: repeat-x !important;';
        } else if (positions == 'bgRepeatY') {
            str_bg_pos = 'background-repeat: repeat-y !important;';
        } else if (positions == 'bgRepeatXTop') {
            str_bg_pos = 'background-repeat: repeat-x !important; background-position: top !important;';
        } else if (positions == 'bgRepeatXBottom') {
            str_bg_pos = 'background-repeat: repeat-x !important; background-position: bottom !important;';
        }

        if (json.row_setting_text_color)
            str_bg_pos += "color: " + json.row_setting_text_color + ';';

        if (json.row_setting_bg_color)
            str_bg_pos += "background-color: " + json.row_setting_bg_color + ';';

        str_bg_pos += background_image;
        //console.log(str_bg_pos);

        //alert(json.row_padding_top);
        //remove css class to apply the changes
        if (json.row_padding_top > 0) {

            /*str_bg_pos += 'padding-top:' + json.row_padding_top + 'px !important;';
            str_bg_pos += 'padding-right:' + json.row_padding_right + 'px !important;';
            str_bg_pos += 'padding-bottom:' + json.row_padding_bottom + 'px !important;';
            str_bg_pos += 'padding-left:' + json.row_padding_left + 'px !important;';*/

            /*str_bg_pos += 'margin-top:' + json.row_margin_top + 'px !important;';
            str_bg_pos += 'margin-right:' + json.row_margin_right + 'px !important;';
            str_bg_pos += 'margin-bottom:' + json.row_margin_bottom + 'px !important;';
            str_bg_pos += 'margin-left:' + json.row_margin_left + 'px !important;';*/
            //alert(json.row_padding_right.length != '');
            str_body_css += 'padding-top:' + ((json.row_padding_top.length != '') ? json.row_padding_top : 0) + 'px !important;';
            str_body_css += 'padding-right:' + ((json.row_padding_right.length != '') ? json.row_padding_right : 0) + 'px !important;';
            str_body_css += 'padding-bottom:' + ((json.row_padding_bottom.length != '') ? json.row_padding_bottom : 0) + 'px !important;';
            str_body_css += 'padding-left:' + ((json.row_padding_left.length != '') ? json.row_padding_left : 0) + 'px !important;';
        }

        if (json.row_setting_border_style.length > 0) {
            str_body_css += 'border-style:' + json.row_setting_border_style + ' !important;';
            str_body_css += 'border-color:' + json.row_setting_border_color + ' !important;';
            str_body_css += 'border-width:' + json.row_setting_border_size + 'px !important;';
            str_body_css += 'border-radius:' + json.row_setting_border_radius + 'px !important;';
            //$(option_open_for).find('.lb-content-body').css('border-style', json.row_setting_border_style + ' !important;');
            //$(option_open_for).find('.lb-content-body').css('border-color', json.row_setting_border_color + ' !important;');
            //$(option_open_for).find('.lb-content-body').css('border-width', json.row_setting_border_size + 'px !important;');
            //$(option_open_for).find('.lb-content-body').css('border-radius', json.row_setting_border_radius + 'px !important;');
        }

        //alert(json.row_setting_border_style.length);


        //$(element).css({background: "url('" + json.path + "')"});
        $(element).attr('style', str_bg_pos);
        $(element).attr('data-bg-position', positions);
        $(element).attr('data-bg-image', json.row_setting_image_path);

        //alert($(element_body).html());
        $(option_open_for).find('.row-groups').attr('style', str_body_css);

        //$(option_open_for).css('background-image', background_image);
        //$(option_open_for).css(str_bg_pos);

        $(settingsOpenModal).modal('hide');
    });


    //Date Countdown
    $(document).on('click', '#date_countdown_setting_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_date_countdown_settings').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();

        $(option_open_for).find('.date-countdown').attr('data-action-type', json.countdown_settings_after_timer_over_action);
        $(option_open_for).find('.date-countdown').attr('data-action-url', json.countdown_settings_action_url);

        $(option_open_for).find('.date-countdown > ul').attr('data-end-date', json.end_date);
        $(option_open_for).find('.date-countdown > ul').attr('data-end-time', json.end_time);

        //colors
        $(option_open_for).find('.date-countdown > ul > li > strong').css('color', json.date_countdown_timer_color + ' !important');
        $(option_open_for).find('.date-countdown > ul > li > p').css('color', json.date_countdown_text_color + ' !important');
        $(option_open_for).find('.date-countdown > ul > li.dc-seperator > span').css('color', json.date_countdown_seperator_color + ' !important');
        $(option_open_for).find('.date-countdown > ul > li > strong').css('background-color', json.date_countdown_bg_color + ' !important');

        //padding
        $(option_open_for).find('.wrapper').css('padding-top', json.date_countdown_padding_top + 'px');
        $(option_open_for).find('.wrapper').css('padding-right', json.date_countdown_padding_right + 'px');
        $(option_open_for).find('.wrapper').css('padding-bottom', json.date_countdown_padding_bottom + 'px');
        $(option_open_for).find('.wrapper').css('padding-left', json.date_countdown_padding_left + 'px');

        //margin
        $(option_open_for).find('.wrapper').css('margin-top', json.date_countdown_margin_top + 'px');
        $(option_open_for).find('.wrapper').css('margin-right', json.date_countdown_margin_right + 'px');
        $(option_open_for).find('.wrapper').css('margin-bottom', json.date_countdown_margin_bottom + 'px');
        $(option_open_for).find('.wrapper').css('margin-left', json.date_countdown_margin_left + 'px');

        $(settingsOpenModal).modal('hide');
    });


    //TextBlock
    $(document).on('click', '#text_block_setting_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_text_block_settings').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();

        $(option_open_for).find('.wrapper > b').html(json.textblock_headline_text);
        $(option_open_for).find('.wrapper > b').next().html(json.sub_headline_text);

        //colors
        $(option_open_for).find('.wrapper > b').css('color', json.textblock_headline_text_color);
        $(option_open_for).find('.wrapper > div').css('color', json.textblock_paragraph_color);

        //alert(json.text_block_padding_top);

        //align
        $(option_open_for).find('.wrapper > b').css('text-align', json.text_block_setting_align);
        $(option_open_for).find('.wrapper > div, .wrapper > div > *').css('text-align', json.text_block_setting_paragraph_align);

        //gap
        $(option_open_for).find('.wrapper > div').css('padding-top', json.text_block_headline_gap + 'px');

        //font sizes
        $(option_open_for).find('.wrapper > b').css('font-size', json.text_block_heading_font_size + 'px');
        $(option_open_for).find('.wrapper > div, .wrapper > div > *').css('font-size', json.text_block_paragraph_font_size + 'px');

        //line-height
        $(option_open_for).find('.wrapper > b').next().css('line-height', json.text_block_line_height + 'px');
        $(option_open_for).find('.wrapper > b').next().find('p').css('line-height', json.text_block_line_height + 'px');

        //padding
        $(option_open_for).find('.wrapper').css('padding-top', json.text_block_padding_top + 'px');
        $(option_open_for).find('.wrapper').css('padding-right', json.text_block_padding_right + 'px');
        $(option_open_for).find('.wrapper').css('padding-bottom', json.text_block_padding_bottom + 'px');
        $(option_open_for).find('.wrapper').css('padding-left', json.text_block_padding_left + 'px');

        //margin
        $(option_open_for).find('.wrapper').parent().css('margin-top', json.text_block_margin_top + 'px');
        $(option_open_for).find('.wrapper').parent().css('margin-right', json.text_block_margin_right + 'px');
        $(option_open_for).find('.wrapper').parent().css('margin-bottom', json.text_block_margin_bottom + 'px');
        $(option_open_for).find('.wrapper').parent().css('margin-left', json.text_block_margin_left + 'px');

        //fonts
        $(option_open_for).find('.wrapper > b').attr('style', $(option_open_for).find('.wrapper > b').attr('style') + "font-family: " + json.text_block_headline_font_family + " !important;");

        //alert(json.text_block_paragraph_font_family);
        var paragraph_style_attr = "";
        paragraph_style_attr += "color:" + json.textblock_paragraph_color + " !important;";
        paragraph_style_attr += "text-align:" + json.text_block_setting_paragraph_align + "  !important;";
        paragraph_style_attr += "font-size:" + json.text_block_paragraph_font_size + "px !important;";
        paragraph_style_attr += "font-family: '" + json.text_block_paragraph_font_family + "' !important;";
        //console.log(paragraph_style_attr);
        //console.log(json.hid_font_family);

        $(option_open_for).find('.wrapper > div').attr('style', paragraph_style_attr);
        $(option_open_for).find('.wrapper > div').each(function (index, element) {
            if (typeof $(element).css('font-family') != 'undefined') {
                $(element).css('font-family', json.text_block_paragraph_font_family + ' !important');
            }
        });
        $(option_open_for).find('.wrapper > div font').attr('face', json.text_block_paragraph_font_family);
        //console.log(json.hid_font_family[1]);

        if ($("#title_after_font_style").length == 0) {
            $('title').after('<link id="title_after_font_style" rel="stylesheet" href="https://fonts.googleapis.com/css?family=' + encodeURI(json.hid_font_family[0]) + '">');
            $('title').after('<link id="title_after_font_style" rel="stylesheet" href="https://fonts.googleapis.com/css?family=' + encodeURI(json.hid_font_family[1]) + '">');
        }
        else {
            $('title').after('<link id="title_after_font_style" rel="stylesheet" href="https://fonts.googleapis.com/css?family=' + encodeURI(json.hid_font_family[0]) + '">');
            $('title').after('<link id="title_after_font_style" rel="stylesheet" href="https://fonts.googleapis.com/css?family=' + encodeURI(json.hid_font_family[1]) + '">');
        }

        if ($("#external_fonts").val().length > 0) {
            $('#external_fonts').val($("#external_fonts").val() + "," + encodeURI(json.hid_font_family[0]));
            $('#external_fonts').val($("#external_fonts").val() + "," + encodeURI(json.hid_font_family[1]));
        }
        else {
            $('#external_fonts').val(encodeURI(json.hid_font_family[0]));
            $('#external_fonts').val(encodeURI(json.hid_font_family[1]));
        }


        $(settingsOpenModal).modal('hide');

    });


    //Advance Button
    $(document).on('click', '#advance_button_setting_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_advance_button_settings').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();

        //$(option_open_for).find('.wrapper > button').html(json.advance_button_text);
        if (json.advance_button_secondary_text.length > 1) {
            $(option_open_for).find('.wrapper > button > p').remove('');
            $(option_open_for).find('.wrapper > button > span').html(json.advance_button_text);
            $(option_open_for).find('.wrapper > button').append("<p>" + json.advance_button_secondary_text + "</p>");
        } else {
            $(option_open_for).find('.wrapper > button > span').html(json.advance_button_text);
            $(option_open_for).find('.wrapper > button > p').remove('');
        }

        $(option_open_for).find('.wrapper > button').attr('data-button-type', json.advance_button_type);


        if (json.advance_button_type == 'full_large') {
            $(option_open_for).find('.wrapper > button').addClass('btn-lg btn-block');
            //$(option_open_for).find('a').css('display', 'block');
        } else if (json.advance_button_type == 'large') {
            $(option_open_for).find('.wrapper > button').addClass('btn-lg');
            //$(option_open_for).find('a').css('display', 'block');
        } else if (json.advance_button_type == 'full') {
            $(option_open_for).find('.wrapper > button').addClass('btn-block');
            //$(option_open_for).find('a').css('display', 'block');
        } else {
            //alert(json.advance_button_type);
            $(option_open_for).find('.wrapper > button').removeClass('btn-block');
            $(option_open_for).find('.wrapper > button').removeClass('btn-lg');
            //$(option_open_for).find('a').css('display', 'block');
        }


        //style
        if (json.advance_button_style == 'transparent') {
            $(option_open_for).find('.wrapper > button').addClass('btn-primary bg-btn-transparent');
            $(option_open_for).find('.wrapper > button').attr('data-button-style', json.advance_button_style);
        } else {
            $(option_open_for).find('.wrapper > button').removeClass('btn-primary');
            $(option_open_for).find('.wrapper > button').removeClass('bg-btn-transparent');
            $(option_open_for).find('.wrapper > button').attr('data-button-style', json.advance_button_style);
        }


        ////////////////////
        $(option_open_for).find('.wrapper > button #hid_product_type').remove();
        $(option_open_for).find('.wrapper > button #hid_product_id').remove();
        $(option_open_for).find('.wrapper > button #hid_product_price').remove();
        $(option_open_for).find('.wrapper > button #hid_product_variant_id').remove();
        $(option_open_for).find('.wrapper > button #product_quantity').remove();

        var product_option = $('option:selected', $("#advance_button_add_product")).attr('data-product-type');
        $(option_open_for).find('.wrapper > button').append('<input name="hid_product_type" id="hid_product_type" value="' + product_option + '" type="hidden">');
        $(option_open_for).find('.wrapper > button').append('<input name="hid_product_id" id="hid_product_id" value="' + json.advance_button_add_product + '" type="hidden">');
        $(option_open_for).find('.wrapper > button').append('<input name="hid_product_price" id="hid_product_price" value="' + json.hid_product_price + '" type="hidden">');

        if (json.hid_product_variant_id.length > 0)
            $(option_open_for).find('.wrapper > button').append('<input name="hid_product_variant_id" id="hid_product_variant_id" value="' + json.hid_product_variant_id + '" type="hidden">');

        $(option_open_for).find('.wrapper > button').append('<input name="product_quantity" id="product_quantity" value="' + json.product_quantity + '" type="hidden">');


        //Font size
        $(option_open_for).find('.wrapper > button').css('font-size', json.advance_button_font_size + 'px');

        //padding
        $(option_open_for).find('.wrapper > button').css('padding-top', json.advance_button_padding_top + 'px');
        $(option_open_for).find('.wrapper > button').css('padding-right', json.advance_button_padding_right + 'px');
        $(option_open_for).find('.wrapper > button').css('padding-bottom', json.advance_button_padding_bottom + 'px');
        $(option_open_for).find('.wrapper > button').css('padding-left', json.advance_button_padding_left + 'px');

        //margin
        $(option_open_for).find('.wrapper > button').css('margin-top', json.advance_button_margin_top + 'px');
        $(option_open_for).find('.wrapper > button').css('margin-right', json.advance_button_margin_right + 'px');
        $(option_open_for).find('.wrapper > button').css('margin-bottom', json.advance_button_margin_bottom + 'px');
        $(option_open_for).find('.wrapper > button').css('margin-left', json.advance_button_margin_left + 'px');

        //button_border_radius

        //step_next_url
        $(option_open_for).find('.wrapper > button').css('color', json.advance_button_text_color + ' !important');
        $(option_open_for).find('.wrapper > button').css('background-color', json.advance_button_bg_color + ' !important');

        $(settingsOpenModal).modal('hide');
    });


    //Button
    $(document).on('click', '#button_setting_save', function (e) {

        e.preventDefault();

        //var $formData = $("#frm_text_block_settings").serialize();
        var data = "" + JSON.stringify($('#frm_button_settings').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var $element = $(this).parent().parent();

        $(option_open_for).find('.wrapper > a').attr('data-url', json.button_action);

        if ($(".element-payment-form .paypal-panel") != 'undefined') {
            $(".element-payment-form .paypal-panel .body > p > span").text(json.button_text);
        }

        if (json.simple_button_secondary_text.length > 0) {
            $(option_open_for).find('.wrapper > a > p').remove();
            $(option_open_for).find('.wrapper > a').append("<p>" + json.simple_button_secondary_text + "</p>");
        } else {
            $(option_open_for).find('.wrapper > a > p').remove();
        }

        $(option_open_for).find('.wrapper > a').attr('data-button-type', json.button_type);

        if (json.step_next_url) {
            $(option_open_for).find('.wrapper > a').attr('href', json.step_next_url);
            $(option_open_for).find('.wrapper > a').attr('data-video-url', '');
        }

        if (json.step_skip_url) {
            $(option_open_for).find('.wrapper > a').attr('href', json.step_skip_url);
            $(option_open_for).find('.wrapper > a').attr('data-video-url', '');
        }

        //alert(json.button_action);

        //clear target
        $(option_open_for).find('.wrapper > a').attr('target', '');

        if (json.button_action == 'submit') {
            $(option_open_for).find('.wrapper > a').addClass('btn-submit-form-self');
        } else if (json.button_action == 'goto_link') {

            //alert(json.button_setting_goto_link_behaviour);

            $(option_open_for).find('.wrapper > a').attr('href', json.button_setting_goto_link_url);
            $(option_open_for).find('.wrapper > a').attr('data-link-open-behaviour', json.button_setting_goto_link_behaviour);

            if (json.button_setting_goto_link_behaviour == "other_tab") {
                $(option_open_for).find('.wrapper > a').attr('target', '_blank');
            }
        } else if (json.button_action == 'integration_data') { //data-integration-process-after

            $(option_open_for).find('.wrapper > a').attr('data-integration-process-after', json.integration_data_behaviour);

            //alert(json.integration_data_behaviour);

            if (json.integration_data_behaviour == 'redirect_next') {
                $.ajax({
                    type: 'post',
                    url: $("#hid_base_url").val() + '/settings/buttonurl/next_step',
                    data: 'page_id=' + $("#hid_page_id").val() + '&_token=' + $("#csrf_token").val() + '&type=live',
                    success: function (response) {
                        //console.log(response);
                        var json = JSON.parse(response);
                        //next_url = response.url;

                        $(option_open_for).find('.wrapper > a').attr('after-process-url', json.url);
                    },
                    error: function (a, b) {
                        document.write(a.responseText);
                    }
                });
            }
        }

        if (json.video_url) {
            $(option_open_for).find('.wrapper > a').attr('href', '#');
            $(option_open_for).find('.wrapper > a').attr('data-video-url', json.video_url);
        }

        ///
        if (json.button_section_id.length > 0) {
            $(option_open_for).find('.wrapper > a').attr('href', '#' + json.button_section_id);
        }

        if (json.button_type == 'full_large') {
            $(option_open_for).find('.wrapper > a').addClass('btn-lg btn-block');
        } else if (json.button_type == 'large') {
            $(option_open_for).find('.wrapper > a').addClass('btn-lg');
        } else if (json.button_type == 'full') {
            $(option_open_for).find('.wrapper > a').addClass('btn-block');
        }


        //style
        if (json.button_style == 'transparent') {
            $(option_open_for).find('.wrapper > a').addClass('btn-primary bg-btn-transparent');
            $(option_open_for).find('.wrapper > a').attr('data-button-style', json.button_style);
        } else {
            $(option_open_for).find('.wrapper > a').removeClass('btn-primary');
            $(option_open_for).find('.wrapper > a').removeClass('bg-btn-transparent');
            $(option_open_for).find('.wrapper > a').attr('data-button-style', json.button_style);
        }

        //alignment
        $(option_open_for).find('.wrapper').attr('data-button-align', json.button_alignment);
        $(option_open_for).find('.wrapper').css('text-align', json.button_alignment);

        //Font size
        //alert(json.button_font_size);
        //$(option_open_for).find('.wrapper').css('font-size', json.button_font_size + 'px !important');
        //alert(json.button_secondary_font_size);
        $(option_open_for).find('.wrapper > a > span').attr('style', "font-size:" + json.button_font_size + "px;line-height:" + json.button_font_size + "px");
        $(option_open_for).find('.wrapper > a > p').attr('style', "font-size:" + json.button_secondary_font_size + 'px !important');
        //$(option_open_for).find('.wrapper > a > p').css('font-size', json.button_secondary_font_size + 'px !important');

        //padding
        $(option_open_for).find('.wrapper > a').css('padding-top', json.button_padding_top + 'px');
        $(option_open_for).find('.wrapper > a').css('padding-right', json.button_padding_right + 'px');

        //adjust the padding bottom when secondary text is present
        if (json.simple_button_secondary_text.length > 0)
            $(option_open_for).find('.wrapper > a').css('padding-bottom', '0px');
        else
            $(option_open_for).find('.wrapper > a').css('padding-bottom', json.button_padding_bottom + 'px');

        $(option_open_for).find('.wrapper > a').css('padding-left', json.button_padding_left + 'px');

        //margin
        $(option_open_for).find('.wrapper').css('margin-top', json.button_margin_top + 'px');
        $(option_open_for).find('.wrapper').css('margin-right', json.button_margin_right + 'px');
        $(option_open_for).find('.wrapper').css('margin-bottom', json.button_margin_bottom + 'px');
        $(option_open_for).find('.wrapper').css('margin-left', json.button_margin_left + 'px');

        //button_border_radius
        $(option_open_for).find('.wrapper > a').css('border-radius', json.button_border_radius + 'px');

        //step_next_url
        $(option_open_for).find('.wrapper > a').css('color', json.button_text_color + ' !important');
        $(option_open_for).find('.wrapper > a').css('background-color', json.button_bg_color + ' !important');

        //icon
        if (typeof json.button_icon_position != 'undefined') {
            var ic_pos = (json.button_icon_position.length > 1) ? json.button_icon_position : 'left';
            var padding_css = "";
            if (ic_pos == 'left') {
                padding_css = "padding-right:15px";
            } else {
                padding_css = "padding-left:15px";
            }

            $(option_open_for).find('.wrapper > a > span > div.button-icon').remove();

            if (ic_pos == 'left') {
                json.button_text = '<div class="button-icon" style="' + padding_css + '" data-icon="' + json.hid_selected_icon + '" data-position="' + ic_pos + '" data-icon-size="' + json.button_icon_size + '"><i class="fa ' + json.hid_selected_icon + '" aria-hidden="true"></i></div>' + json.button_text;
                $(option_open_for).find('.wrapper > a > span').html(json.button_text);
            }
            else {
                json.button_text = json.button_text + '<div class="button-icon" style="' + padding_css + '" data-icon="' + json.hid_selected_icon + '" data-position="' + ic_pos + '" data-icon-size="' + json.button_icon_size + '"><i class="fa ' + json.hid_selected_icon + '" aria-hidden="true"></i></div>';
                $(option_open_for).find('.wrapper > a > span').html(json.button_text);
            }

            //$(option_open_for).find('.wrapper > a > span > .button-icon').css('float', (json.button_icon_position.length > 1) ? json.button_icon_position : 'left');
            $(option_open_for).find('.wrapper > a > span > .button-icon').css('font-size', json.button_icon_size + 'px');

            if (typeof json.button_enable_icon == 'undefined') {
                $(option_open_for).find('.wrapper > a > span > .button-icon').remove();
                $(option_open_for).find('.wrapper > a').attr('show-icon', false);
            } else {
                $(option_open_for).find('.wrapper > a').attr('show-icon', true);
            }
        }

        $(settingsOpenModal).modal('hide');
    });


    /* MODAL DATA FILTER ITEM CLICK */
    var tmp_filter
    var current_builder_element_tab = $(".modal-header-tab ul > li:first-child");
    $(document).on("click", ".modal-header-tab ul > li", function (e) {

        e.preventDefault();

        var items = $(this).parent().parent().parent().next().find(".editor-element-items .item");
        var filter_data = $(this).attr('data-filter-type');

        $(current_builder_element_tab).removeClass('active');
        $(this).addClass('active');

        //alert(switch_to_tab);

        /*if ( switch_to_tab != 'all' ) {

            //alert(switch_to_tab);

            $(items).each(function (index, element) {

                if ($(element).attr('data-filter') == switch_to_tab) {
                    $(element).show();
                } else {
                    $(element).hide();
                }
            });
        } else {*/

        if (filter_data != 'all') {
            $(items).each(function (index, element) {

                if ($(element).attr('data-filter') == filter_data) {
                    $(element).show();
                } else {
                    $(element).hide();
                }
            });
        } else {
            $(items).each(function (index, element) {

                $(element).show();
            });
        }
        //}

        current_builder_element_tab = $(this);

    });


    /* ------------------------------------------ DARGA DROP -------------------------------------- */

    //$(".ui-droppable").droppable();


    /* -------------------------------------------------- 2 STEP FUNCTION ------------------------------------ */


    /* -------------------------------------------------- EDITOR LEFT SETTINGS -----------------------------------*/

    $("#left_editor_setting").click(function (e) {

        e.preventDefault();


    });


    /* --------------------------------------------------- TRACKING CODE ----------------------------------------- */
    /*$(".show-tracking-modal").click(function(e) {

        e.preventDefault();

        var header_code = $("#frm_tracking_code :input[name='tracking_header_code']").val();
        var footer_code = $("#frm_tracking_code :input[name='tracking_footer_code']").val();

        $("#funnelTrackingModal .modal-body #frm_tracking_code textarea[name='page[tracking][header]")
    });*/


    $("#add_tracking_code").click(function (e) {

        e.preventDefault();

        var header_code = $("#frm_tracking_code textarea[name='tracking_header_code']").val();
        var footer_code = $("#frm_tracking_code textarea[name='tracking_footer_code']").val();


        //header url encode
        if (header_code.length > 0 && (header_code.indexOf('http') >= 0)) {
            var header_code_encodes = header_code.split('src="https://');
            var hen = header_code_encodes[1].split('=1"');
            var final_head_str = 'https://' + hen[0] + '=1';
            var encoded_final_head_str = encodeURIComponent(final_head_str);
            header_code = header_code.replace(final_head_str, encoded_final_head_str);
        }

        //footer url encode
        /*var footer_code_encodes = footer_code.split('src="https://');
        var hen = footer_code_encodes[1].split('=1"');
        var final_foot_str = 'https://' + hen[0] + '=1';
        var encoded_final_foot_str = encodeURIComponent(final_foot_str);*/

        //header_code_encodes = 'src="https://' + header_code_encodes[1].substr(0, header_code_encodes[1].length - 1);

        //alert(final_head_str);
        ////console.log(final_head_str);

        //header_code = header_code.replace(final_head_str, encoded_final_head_str);
        //footer_code = footer_code.replace(final_foot_str, encoded_final_foot_str);
        //alert(header_code);

        //var data_header = JSON.stringify(header_code);
        //var data_footer = JSON.stringify(footer_code);

        /*var page_id = $("#hid_page_id").val();
        var step_id = $("#hid_funnel_step_id").val();*/

        ////console.log(data_header);

        //var en_head = JSON.stringify(encodeURIComponent(header_code));
        //var en_foot = encodeURIComponent(footer_code);
        //alert(decodeURIComponent(en));

        $("#frm_htmleditor_save textarea[name='tracking_header']").text(header_code);
        $("#frm_htmleditor_save textarea[name='tracking_footer']").text(footer_code);

        $("#funnelTrackingModal").modal('hide');
    });


    //Add custom CSS
    $("#add_page_custom_css_code").click(function (e) {

        e.preventDefault();

        var css_code = $("#frm_add_page_custom_css_code textarea[name='page_custom_css_code']").val();
        var add_css = "<style>" + css_code + "</style>";

        $("head style").remove();

        if (css_code.length > 0) {
            $("head").append(add_css);
            $("#frm_htmleditor_save textarea[name='pagestyle']").val(css_code);
        } else {

            $("#frm_htmleditor_save #textarea_pagestyle").val(css_code);
            $("#frm_htmleditor_save #textarea_pagestyle").text(css_code);
        }

        $("#customCssModal").modal('hide');
    });


    //Add SEO META Data
    $("#add_seo_meta_data").click(function (e) {

        e.preventDefault();

        var data = "" + JSON.stringify($('#frm_seo_meta_data').serializeObject());
        var json = JSON.parse(data);

        if ($("#frm_htmleditor_save :input[name='seo_meta_data_title']")) {
            $("#frm_htmleditor_save :input[name='seo_meta_data_title']").remove();
            $("#frm_htmleditor_save :input[name='seo_meta_data_description']").remove();
            $("#frm_htmleditor_save :input[name='seo_meta_data_keywords']").remove();
            $("#frm_htmleditor_save :input[name='seo_meta_data_author']").remove();
        }

        $("#frm_htmleditor_save").append('<input type="hidden" name="seo_meta_data_title" value="' + json.seo_meta_data_title + '" />');
        $("#frm_htmleditor_save").append('<input type="hidden" name="seo_meta_data_description" value="' + json.seo_meta_data_description + '" />');
        $("#frm_htmleditor_save").append('<input type="hidden" name="seo_meta_data_keywords" value="' + json.seo_meta_data_keywords + '" />');
        $("#frm_htmleditor_save").append('<input type="hidden" name="seo_meta_data_author" value="' + json.seo_meta_data_author + '" />');

        $("#pageSeoMetaData").modal('hide');
    });


    //Page BAckground
    $("#add_page_background").click(function (e) {

        e.preventDefault();

        var data = "" + JSON.stringify($('#frm_page_background').serializeObject());
        var json = JSON.parse(data);

        //alert($(this).find('#headline_text').val());
        var element = $('html');
        var positions = json.page_background_image_position;
        var background_image = "background: url('" + json.path + "');";
        var background_color = json.page_background_bg_color;
        var str_bg_pos = "";

        if (json.path.length > 0) {
            if (positions == 'bgCover') {
                str_bg_pos = 'background-size: cover !important; -webkit-background-size: cover !important; background-attachment: fixed !important; background-repeat: repeat repeat !important;';
            } else if (positions == 'bgCover100') {
                str_bg_pos = 'background-size: 100% auto !important; -webkit-background-size: 100% auto !important; background-repeat: no-repeat !important;';
            } else if (positions == 'bgNoRepeat') {
                str_bg_pos = 'background-repeat: no-repeat !important;';
            } else if (positions == 'bgRepeatX') {
                str_bg_pos = 'background-repeat: repeat-x !important;';
            } else if (positions == 'bgRepeatY') {
                str_bg_pos = 'background-repeat: repeat-y !important;';
            } else if (positions == 'bgRepeatXTop') {
                str_bg_pos = 'background-repeat: repeat-x !important; background-position: top !important;';
            } else if (positions == 'bgRepeatXBottom') {
                str_bg_pos = 'background-repeat: repeat-x !important; background-position: bottom !important;';
            }

            str_bg_pos += background_image;
        } else {
            str_bg_pos = 'background-color: ' + background_color;
        }
        //console.log(str_bg_pos);

        //$(element).css({background: "url('" + json.path + "')"});
        $(element).attr('style', str_bg_pos);

        $("#pagebackground").val(str_bg_pos);
        $("#pagebackground").text(str_bg_pos);

        //
        if ($("#frm_htmleditor_save :input[name='page_background_image']")) {
            $("#frm_htmleditor_save :input[name='page_background_image']").remove();
            $("#frm_htmleditor_save :input[name='page_background_image_position']").remove();
            $("#frm_htmleditor_save :input[name='page_background_color']").remove();
        }

        $("#frm_htmleditor_save").append('<input type="hidden" name="page_background_image" value="' + json.path + '" />');
        $("#frm_htmleditor_save").append('<input type="hidden" name="page_background_image_position" value="' + positions + '" />');
        $("#frm_htmleditor_save").append('<input type="hidden" name="page_background_color" value="' + background_color + '" />');


        $("#pageBackgroundModal").modal('hide');
    });


    $(document).on("click", ".add-menu-item", function (e) {

        e.preventDefault();

        //alert(this);

        $('.menu_add_container > .panels:last').clone()
            .find("input:text").val("").end()
            .appendTo('.menu_add_container');
    });


    $(".button_add_modal_setting_options").click(function (e) {

        var container_repeat = $(this).parent().parent().parent().prev();

        $(container_repeat).find('tr:last').clone()
            .find("input:text").val("").end()
            .appendTo(container_repeat);
    });


    /////////////////////////////// POPUP /////////////////////////////
    /*$(document).on('click', '#open_the_popup', function(e) {

        e.preventDefault();

        $(body)
    });*/


    /* --------------------------------- FONT FAMILY LOADER --------------------------------------- */
    $.ajax({
        type: 'get',
        url: 'https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyDyx1ZviaUBKj-ImleRy99maAjYfZ047j4',
        success: function (response) {
            //$(".font-family-chooser").
            //console.log(response);

            //var jsonData = JSON.stringify(response);

            $.each(response.items, function (index, json) {
                //console.log('index', json);

                $(".font-family-chooser").append("<option value='" + json.family + "' data-font-url='" + json.files.regular + "'>" + json.family + "</option>");

                if (index == 0) {
                    $(".font-family-chooser").after("<input type='hidden' name='hid_font_family' value='" + json.family + "' data-font-url='" + json.files.regular + "' />");
                }
            })
        }
    });


    $(document).on("change", ".font-family-chooser", function () {

        var option = $('option:selected', this).attr('data-font-url');

        $(this).parent().find("input[name='hid_font_family']").remove();
        $(this).after("<input type='hidden' name='hid_font_family' value='" + $(this).val() + "' data-font-url='" + option + "' />");
    });


    //device view
    $("#show_mobile_view").click(function (e) {

        e.preventDefault();

        $("html").addClass("mobileViewer");
        $("html").removeClass("desktopMode");
        $mobileSideWidth = $(window).width();
        $mobileSideWidth -= 414; //360
        $mobileSideWidth /= 2;

        //alert($(window).height());

        $(".mobileLeftArea").css("width", $mobileSideWidth + "px");
        $(".mobileRightArea").css("width", $mobileSideWidth + "px");
        $(".mobilePreviewBackdrop").show();

        $("#open_the_view_options").html('<i class="fa fa-mobile"></i> &nbsp; Mobile</a>');
    });


    $("#show_desktop_view").click(function (e) {

        e.preventDefault();

        $("html").addClass("desktopMode");
        $("html").removeClass("mobileViewer");
        $(".mobilePreviewBackdrop").hide();

        $("#open_the_view_options").html('<i class="fa fa-desktop"></i> &nbsp; Desktop</a>');
    });


    //remove image path on modals
    $(".remove-image-path").click(function (e) {

        e.preventDefault();

        $(this).prev().prev().val('');
        e.stopPropagation();
    });
});


//POPUP
$(function () {
    //----- OPEN
    $('[data-popup-open]').on('click', function (e) {
        var targeted_popup_class = jQuery(this).attr('data-popup-open');
        $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);

        //$("body").scrollTop(0);
        window.scrollTo(0, 0);

        e.preventDefault();
    });

    //----- CLOSE
    $('[data-popup-close]').on('click', function (e) {
        var targeted_popup_class = jQuery(this).attr('data-popup-close');
        $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);

        e.preventDefault();
    });
});


$(function () {

    var $sections = $('.step-section');


    function navigateTo(index) {
        // Mark the current section with the class 'current'
        $sections
            .removeClass('current')
            .eq(index)
            .addClass('current');

        // Show only the navigation buttons that make sense for the current section:
        $('.form-navigation .btn-next-step').toggle(index == 0);
        var atTheEnd = index >= $sections.length - 1;

        //alert(atTheEnd);

        $('.form-navigation .complete-order').toggle(atTheEnd);
        //$('.form-navigation .complete-order').toggle(atTheEnd);
    }

    function curIndex() {
        // Return the current index by looking at which section has the class 'current'
        //alert($sections.index($sections.filter('.current')));
        return $sections.index($sections.filter('.current'));
    }

    // Previous button is easy, just go back
    $('.form-navigation .previous').click(function () {
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
        }
    });

    $sections.each(function (index, section) {
        $(section).find('.form-group input,select').attr('data-parsley-group', 'block-' + index);
    });
    navigateTo(0); // Start at the beginning
});


//change screen resolution
$(document).on('click', '.change-screen-resolution', function (e) {

    e.preventDefault();

    var attr_id = $(this).attr('id');

    if (attr_id == 'button_view_as_desktop') {
        //$('body').resizeTo("700px"); //= "700px";
        viewport.setAttribute('content', 'width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no');
    } else if (attr_id == 'button_view_as_mobile') {
        screen.width = "600px";
    } else if (attr_id == 'button_view_as_tablet') {
        screen.width = "500px";
    }
});


//Modal close
$(document).on('click', '#imageGalleryModal .modal-footer > button', function (e) {

    e.preventDefault();

    $(this).parent().parent().parent().parent().modal('hide');
});

$(document).on('click', '#imageGalleryModal .close', function (e) {

    e.preventDefault();

    $(this).parent().parent().parent().parent().parent().parent().modal('hide');
});


/* --------------------------------------- IMAGE GALLERY ---------------------------------------------- */


//CLick to open the gallery
var image_placeholder;

/*$(document).on('click', '.gallery-open', function(e) {

    image_placeholder = $(this);
});*/


//Select the image from gallery
var gallery_selected_image_src = "";
var selectd_gallery_image = "";
var selected_gallery_item;
$(document).on('click', '.gallery-container .gallery-item', function (e) {

    e.preventDefault();

    //if ( !$(this).hasClass('active') )
    //$(this).toggleClass('active');

    $(selected_gallery_item).removeClass('active');
    $(this).addClass('active');

    selectd_gallery_image = $(this).find('img');
    gallery_selected_image_src = $(this).find('img').attr('src');

    selected_gallery_item = $(this);
});

//add the image path to placeholder
$(document).on('click', '#add_image_from_gallery', function (e) {

    e.preventDefault();

    //alert(gallery_selected_image_src);

    $(image_placeholder).find(":input[type='text']").val(gallery_selected_image_src);
    //$(image_placeholder).find(":input[name='image_gallery_width']").val('auto');
    //$(image_placeholder).find(":input[name='image_gallery_height']").val('auto');
    $("#imageGalleryModal").modal('hide');
});

var current_media_tab;
var buttonElementUpload;
$(document).on('click', '#upload_image_to_gallery', function (e) {

    e.preventDefault();

    buttonElementUpload = $(this);

    //$("#frm_gallery_image_upload").find(":input[type='file']").trigger('click');
    //$("#frm_gallery_image_upload").ajaxForm(options);
    //alert(this);

    $("#imageGalleryModal .modalFooter .btn-imgs").each(function (index, element) {

        if ($(element).hasClass('btn-imgs-active')) {
            current_media_tab = $(element).find('span').text();
        }

        /*if ( $(element).attr('data-filter') != 'library' ) {
            $("#remove_image_from_gallery").hide();
        } else {
            $("#remove_image_from_gallery").show();
        }*/
    });

    //$(this).html('<i class="fa fa-circle-o-notch fa-spin"></i>');


    $('#frm_gallery_image_upload input[type="file"]').trigger('click');
});

/*$('#frm_gallery_image_upload input[type="file"]').change(function () {
    $(this).after("<input type='hidden' name='media_tab' value='" + current_media_tab + "' />")

    var form_data =

    $("#frm_gallery_image_upload").ajaxForm({
        data: {
            media_tab: current_media_tab
        },
        complete: function(response)
        {
            //console.log(response);
            if($.isEmptyObject(response.error)){
                //alert('Image Upload Successfully.');

				//var url = $("#hid_base_url").val();
				//url = url.replace("http://", "https://");

                $.ajax({
                    type: 'GET',
					url: 'https://dev.cartumo.net/gallery-images/',
                    //url: $("#hid_base_url").val() + '/gallery-images/',
					//url: url + '/gallery-images/',
                    data: '_token=' + $("#csrf_token").val() + '&media_tab=' + current_media_tab,
                    success: function(response) {

                        //console.log(response);
                        $("#imageGalleryModal .modal-body").html(response);
                    },
                    error:function(a, b) {
                        document.write(a.responseText);
                    }
                });

            } else {
                printErrorMsg(response.responseJSON.error);
                //console.log(response.responseJSON.error);
            }
        },
        error: function(a, b) {
            //console.log(a.responseText);
        }
    }).submit();

});*/

var options = {
    beforeSend: function () {
        $("#upload_image_to_gallery").html('<i class="fa fa-circle-o-notch fa-spin"></i>');
    },
    complete: function (response) {
        //alert(response);
        if ($.isEmptyObject(response.error)) {
            //alert('Image Upload Successfully.');

            $.ajax({
                type: 'GET',
                url: $("#hid_base_url").val() + '/gallery-images/',
                data: '_token=' + $("#csrf_token").val(),
                success: function (response) {
                    //alert(response);
                    //console.log(response);
                    $("#upload_image_to_gallery").html('<i class="fa fa-cloud-upload" aria-hidden="true"></i>');
                    $("#imageGalleryModal .modal-body").html(response);
                },
                error: function (a, b) {
                    document.write(a.responseText);
                }
            });

        } else {
            printErrorMsg(response.responseJSON.error);
            //console.log(response.responseJSON.error);
        }
    }
};

var tmp_gallery_tab = $("#imageGalleryModal .modal-body .gallery-container:nth-child(2)");
var tmp_gallery_menu = $("#imageGalleryModal .modalFooter a:first-child");
$(document).on('click', '#imageGalleryModal .modalFooter a', function (e) {

    //alert(this);

    var filter = $(this).attr('data-filter');

    $(tmp_gallery_tab).hide();
    $(tmp_gallery_menu).removeClass('btn-imgs-active');

    $("#imageGalleryModal .modal-body .gallery-container").each(function (index, element) {
        $(element).hide();
    });

    $("#imageGalleryModal .modal-body .gallery-container").each(function (index, element) {

        //alert($(element).attr('data-open-content') + ", " +  filter)

        if ($(element).attr('data-open-content') == filter) {
            $(element).show();
            tmp_gallery_tab = $(element);
        }
    });

    if ($(this).attr('data-filter') != 'library') {
        $("#remove_image_from_gallery").hide();
        $("#gallery_image_counter").hide();
        $(".image-gallery-option-buttons").hide();
    } else {
        $("#remove_image_from_gallery").show();
        $("#gallery_image_counter").show();
        $(".image-gallery-option-buttons").show();
    }

    $(this).addClass('btn-imgs-active');
    tmp_gallery_menu = $(this);

});


function printErrorMsg(msg) {
    /*$(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display','block');
    $.each( msg, function( key, value ) {
        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
    });*/

    $.each(msg, function (key, value) {
        //console.log(value);
    });
}


/* -------------------------------------------- CUSTOM FUNCTIONS ----------------------------------------- */

$.fn.serializeObject = function () {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function () {
        if (o[this.name]) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};


function componentToHex(c) {
    var hex = "51".toString(16);
    return hex.length == 1 ? "0" + hex : hex;
}

function rgbToHex(rgbstr) {

    var str = rgbstr.substring(4, rgbstr.length - 1);
    str = str.split(',');

    var rgb = str[0] | (str[1] << 8) | (str[2] << 16);
    return '#' + (0x1000000 + rgb).toString(16).slice(1);

    //return "#" + componentToHex(str[0]) + componentToHex(str[1]) + componentToHex(str[2]);
}


//Function to convert hex format to a rgb color
function rgb2hex(rgb) {
    rgb = rgb.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);
    return (rgb && rgb.length === 4) ? "#" +
        ("0" + parseInt(rgb[1], 10).toString(16)).slice(-2) +
        ("0" + parseInt(rgb[2], 10).toString(16)).slice(-2) +
        ("0" + parseInt(rgb[3], 10).toString(16)).slice(-2) : '';
}

function hex2Rgb(hex, opacity) {
    var h = hex.replace('#', '');
    h = h.match(new RegExp('(.{' + h.length / 3 + '})', 'g'));

    for (var i = 0; i < h.length; i++)
        h[i] = parseInt(h[i].length == 1 ? h[i] + h[i] : h[i], 16);

    if (typeof opacity != 'undefined') h.push(opacity);

    return h.join(',');
}


/* ------------------------------ RANGE SLIDER -------------------------- */
var rangeSlider = function () {
    var slider = $('.range-slider'),
        range = $('.range-slider__range'),
        value = $('.range-slider__value');

    slider.each(function () {

        value.each(function () {
            var value = $(this).prev().attr('value');
            $(this).html(value);
        });

        range.on('input', function () {
            $(this).next(value).html(this.value + 'px');
        });
    });
};

rangeSlider();

window.onbeforeunload = confirmExit;

function confirmExit() {
    //document.write($("#htmleditor").html().length  + ", " + page_content.length); return false;
    if (eval($("#htmleditor").html().trim().length) != eval(page_content.trim().length))
        return "Do you want to leave this page without saving?";
}
