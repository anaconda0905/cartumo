let dragSrcEl = null;
let dragSrcElParent = null;
let prevWidgetPlaceholder = null;
let placeholderPlaced = false;
let utils = null;
let beforeReplaceContent = null;
let placeholderSource = null;

function initDragDrop(utils) {

    window.utils = utils;

    // Initialize the draggable widget items from the right sidebar
    let draggableItems = $('.ui-draggable');
    //let draggableItems = $('.item-wrapper');
    let droppableItems = $('.ui-droppable');

    $(draggableItems).each(function (index, widget) {

        /*widget.setAttribute('draggable', 'true');
        widget.setAttribute('aria-grabbed', 'false');
        widget.setAttribute('tabindex', '0');*/

        widget.addEventListener('dragstart', dragStart);
        widget.addEventListener('dragend', dragEnd);

        if ( $(widget).hasClass('ui-clickable') ) {

            widget.addEventListener('click', sidebarWidgetClick);
        }
    });

    $(droppableItems).each(function (index, widget) {

        widget.addEventListener('dragenter', dragEnter);
        widget.addEventListener('dragleave', dragLeave);
        widget.addEventListener('dragover', dragOver);
        widget.addEventListener('drop', drop);
    });

    // open widget list on button click
    $(document).on('click', "#right-sidebar .option-links #open-widget-list", function () {

        let widgetCollectionList = $('#widget-collection-list');

        if (widgetCollectionList.hasClass('active')) {
            widgetCollectionList.removeClass('active');
        } else {
            widgetCollectionList.addClass('active');
        }
    });
}

function dragStart(e) {

    window.dragSrcElParent = e;
    dragSrcEl = e.target;

    // this.classList.add("dragging");
    this.classList.add("ui-sortable");
    this.classList.add("dragging");
    console.log("CUR" + this);

    let widget_id_str = 'widget-' + e.target.getAttribute('data-element');
    widget_id_str = e.target.getAttribute('data-element-group') + '_' + widget_id_str;

    e.dataTransfer.setData("text/plain", widget_id_str);
}

function dragEnter(e) {

    // e.target.classList.add('drag-over');
    // this.classList.add('drag-over');

    // console.log($(e.target).hasClass('cmb-btn-add-new'));

    // if ( ($(e.target).hasClass('cmb-btn-add-new')) || ($(e.target).parent().hasClass('cmb-btn-add-new')) ) {
    //
    //     window.placeholderSource = $(e.target).parent();
    //     window.beforeReplaceContent = $(e.target).clone();
    //     $(e.target).replaceWith('<div class="cmb-sortable-placeholder cmb-widget-placeholder placeholder-inner"></div>')
    //
    // } else {
    //
    //     // console.log($(window.beforeReplaceContent).html());
    //
    //     // if ( !$(window.placeholderSource).hasClass('cmb-btn-add-new') ) {
    //     //
    //     //     $(window.placeholderSource).html(window.beforeReplaceContent);
    //     // }
    // }


    // if ( ($(e.target).hasClass('cmb-replaceable-placeholder')) ) {
    //
    //     window.placeholderSource = $(e.target);
    //     window.beforeReplaceContent = $(e.target).html();
    //     $(e.target).html('<div class="cmb-sortable-placeholder cmb-widget-placeholder placeholder-inner"></div>')
    //
    // }



    // if (!window.placeholderPlaced) {
    //
    //     if (($(e.target).hasClass('cmb-replaceable-placeholder')) || ($(e.target).parents('.cmb-replaceable-placeholder').length === 1) ) {
    //
    //         console.log("I AM IN");
    //         window.placeholderPlaced = true;
    //         // console.log($(e.target).parents('.cmb-replaceable-placeholder').length);
    //     }
    // }


    if (($(e.target).hasClass('cmb-replaceable-placeholder')) || ($(e.target).parents('.cmb-replaceable-placeholder').length === 1) ) {

        if (!window.placeholderPlaced) {

            console.log("I AM IN");
            window.placeholderPlaced    = true;
            window.placeholderSource    = $(e.target).closest('.cmb-parent-placeholder-empty'); //cmb-cb
            window.beforeReplaceContent = $(window.placeholderSource).find('.cmb-btn-add-new').clone();

            $(window.placeholderSource).find('.cmb-btn-add-new').replaceWith('<div class="cmb-sortable-placeholder cmb-widget-placeholder placeholder-inner"></div>');
        }
    } else {

        if ( !$(e.target).hasClass('cmb-sortable-placeholder') ) {

            if (window.placeholderPlaced) {

                $(window.placeholderSource).find('.cmb-sortable-placeholder').replaceWith(window.beforeReplaceContent);

                console.log("I AM OUT");
                window.placeholderPlaced = false;
            }
        }
    }
}

function dragLeave(e) {

    e.preventDefault();
    e.stopPropagation();

    // this.classList.remove('drag-over');

    // $(e.target).closest('.cmb-wrapper').removeClass('drag-over');
    //
    // if (e.target.parentElement.classList[0] === 'cmb-widget-container') {
    //
    //     $('.cmb-sortable-placeholder').each(function(index, element) {
    //
    //         //$(element).remove();
    //     });
    // }

    // if ( !$(window.placeholderSource).hasClass('cmb-replaceable-placeholder') ) {
    //
    //     $(window.placeholderSource).html(window.beforeReplaceContent);
    // }

    // if ( typeof ($(e.target).parents('cmb-replaceable-placeholder')) === 'undefined' ) {
    //
    //     $(window.placeholderSource).html(window.beforeReplaceContent);
    // }

    // console.log($(e.target).attr('class') + "HAS:" + $(e.target).hasClass('cmb-replaceable-placeholder'));
    // console.log($(e.target).parents('.cmb-replaceable-placeholder').length + " HAS: " + $(e.target).hasClass('cmb-replaceable-placeholder'));

    // if ( $(e.target).hasClass('cmb-replaceable-placeholder') ) {
    //
    //     console.log($(e.target).parents('.cmb-replaceable-placeholder').length);
    //
    //     if ( $(e.target).parents('.cmb-replaceable-placeholder').length === 0 ) {
    //
    //         if (window.placeholderPlaced) {
    //
    //             console.log("I AM OUT!");
    //             window.placeholderPlaced = false;
    //         }
    //     }
    // }

    // if ( $(e.target).parents('.cmb-replaceable-placeholder').length === 1 ) {
    // // if ( $(e.target).hasClass('cmb-replaceable-placeholder') ) {
    //
    //     if (window.placeholderPlaced) {
    //
    //         console.log("I AM OUT!");
    //         window.placeholderPlaced = false;
    //     }
    // } else {
    //
    //     console.log("CHILDERN: " + $(e.target).parents('.cmb-replaceable-placeholder').length);
    // }

    // if ( $(e.target).hasClass('cmb-replaceable-placeholder') ) {
    //
    //     console.log("I AM OUT!");
    //
    //     $(e.target).html(window.beforeReplaceContent);
    // }
}

function dragOver(e) {
    e.preventDefault();
    e.stopPropagation();

    console.log($(e.target).attr('class'));

    // console.log($(e.target).hasClass('cmb-btn-add-new'));
    //
    // if ( ($(e.target).hasClass('cmb-btn-add-new')) ) {
    //
    //     window.placeholderSource = $(e.target).parent();
    //     window.beforeReplaceContent = $(e.target).clone();
    //     $(e.target).replaceWith('<div class="cmb-sortable-placeholder cmb-widget-placeholder placeholder-inner"></div>')
    //
    // } else {
    //
    //     // console.log($(window.beforeReplaceContent).html());
    //
    //     if ( !$(window.placeholderSource).hasClass('cmb-btn-add-new') ) {
    //
    //         $(window.placeholderSource).html(window.beforeReplaceContent);
    //     }
    // }

    // else {
    //
    //
    //     if (e.target.parentElement.classList[0] === 'cmb-widget-container') { //cmb-widget-container-box
    //         let eleHeight = e.target.parentElement.clientHeight / 2;
    //
    //         console.log("CAL: " + e.offsetY + ", " + eleHeight);
    //
    //
    //         let pElement = $(e.target.parentElement).parent().parent();
    //
    //         clean_existing_placeholder(pElement);
    //
    //         // $(pElement).addClass('mt-50');
    //
    //         console.log(e.offsetY + ", " + eleHeight);
    //
    //         if (e.offsetY <= eleHeight) {
    //
    //             if (!is_placeholder_placed($(pElement).prev())) {
    //
    //                 $(pElement).before('<div class="cmb-sortable-placeholder cmb-widget-placeholder placeholder-before"></div>');
    //             }
    //         } else {
    //
    //             if (!is_placeholder_placed($(pElement).next())) {
    //                 $(pElement).after('<div class="cmb-sortable-placeholder cmb-widget-placeholder placeholder-after"></div>');
    //             }
    //         }
    //
    //     } else {
    //
    //         if (e.target.parentElement.classList[0] === 'cmb-wrapper') {
    //             $('.cmb-sortable-placeholder').each(function (index, element) {
    //                 $(element).remove();
    //             });
    //         }
    //     }
    // }
}

function drop(e) {

    e.preventDefault();
    e.stopPropagation();

    $(e.target).closest('.cmb-wrapper').removeClass('drag-over');

    if (e.stopPropagation) {
        e.stopPropagation(); // stops the browser from redirecting.
    }

    console.log("DROPED");

    if ((e.target.parentElement.className.trim() !== 'item-wrapper') && (e.target.parentElement.className.trim() !== 'item ui-droppable') && (e.target.parentElement.className.trim() !== 'item') && (e.target.parentElement.className.trim() !== 'icon') && (e.target.parentElement.className.trim() !== 'widget-headline')) {

        let widget_id = e.dataTransfer.getData("text");
        console.log("WIDGET ID: " + widget_id);

        window.widgetAddSourcePlaceholder = window.placeholderSource; //cmb-cb

        // console.log(dragSrcEl);

        sidebarWidgetClick(window.dragSrcElParent);

        // let widgetContent = async function ajaxCall(url, data) {
        //
        //     const location = window.location.hostname;
        //     const settings = {
        //         method: 'POST',
        //         headers: {
        //             // Accept: 'application/json',
        //             'Content-Type': 'application/json',
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         body: JSON.stringify(data), // body data type must match "Content-Type" header
        //     };
        //
        //     const contentData = await fetch(`http://${location}:8000/${url}`, settings)
        //         .then(response => response.text())
        //         .then(data => {
        //
        //             console.log($('#cm-builder').find('.cmb-sortable-placeholder').length);
        //
        //             if ($('#cm-builder').find('.cmb-sortable-placeholder').length) {
        //                 $('.cmb-sortable-placeholder').replaceWith($(data).find('h2').text(Math.random()));
        //             } else {
        //
        //                 $('#cm-builder .cm-section-wrapper').append(data);
        //             }
        //
        //             sortable_ui();
        //         });
        //
        //     return contentData;
        // }('sidebar/widget/', {'id': widget_id});
    }
}


function dragEnd(e) {
    console.log("dragSrcEl" + dragSrcEl);
    this.classList.remove('over');  // this / e.target is previous target element.
    dragSrcEl.classList.remove("ui-sortable");
    dragSrcEl.classList.remove("dragging");
}

function is_placeholder_placed(element) {

    console.log(element);

    if ($(element).hasClass('cmb-sortable-placeholder')) {

        return true;
    }

    return false;
}

function clean_existing_placeholder(element) {

    console.log(element);

    if ($(element).prev().hasClass('cmb-sortable-placeholder')) {

        $(element).prev().remove();
    } else if ($(element).next().hasClass('cmb-sortable-placeholder')) {

        $(element).next().remove();
    }
}


function sidebarWidgetClick(e) {

    e.preventDefault();

    let widget_id_str = null;
    let sourceElement = window.widgetAddSourcePlaceholder;

    if ($(e.target).hasClass('item')) {

        widget_id_str = 'widget-' + e.target.getAttribute('data-element');
        widget_id_str = e.target.getAttribute('data-element-group') + '_' + widget_id_str;
    } else {

        // console.log($(e.target).parent().closest('.item'));

        widget_id_str = 'widget-' + $(e.target).parent().closest('.item').attr('data-element');
        widget_id_str = $(e.target).parent().closest('.item').attr('data-element-group') + '_' + widget_id_str;
    }

    console.log("WIDGET ID: " + widget_id_str);

    let widgetContent = async function ajaxCall(url, data) {

        const location = window.location.hostname;
        const settings = {
            method: 'POST',
            headers: {
                // Accept: 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: JSON.stringify(data), // body data type must match "Content-Type" header
        };

        const contentData = await fetch(`http://${location}:8000/${url}`, settings)
            .then(response => response.text())
            .then(data => {

                // replace the placeholder with widget's content
                if (sourceElement) {

                    if ($(sourceElement).find('.cmb-replaceable-placeholder').length === 1) {

                        let replaceableParent = $(sourceElement).find('.cmb-replaceable-placeholder');
                        $(replaceableParent).replaceWith($(data));
                    } else {

                        let replaceableParent = $(sourceElement).find('.cmb-sortable-placeholder');
                        $(replaceableParent).replaceWith($(data));
                    }
                } else {

                    $(".cm-section-wrapper").append(data);
                }

                // mark the container as non-empty container
                console.log(window.util);
                window.utils.mark_container_non_empty(sourceElement);

                sortable_ui();

                // close the right sidebar
                $('#open-widget-list').trigger('click');

                window.widgetAddSourcePlaceholder = null;
            });

        return contentData;
    }('sidebar/widget/', {'id': widget_id_str});
}




function sortable_ui() {

    $('.ui-sortable').each(function (index, element) {
        $(element).sortable({

            connectWith: ".cmb-cb",

            start: function (event, ui) {
                console.log(event);
            },
            change: function (event, ui) {
                console.log(event);
            },
            update: function (event, ui) {
                // $('#sortable li').removeClass('highlights');
                console.log("Updated");
            }
        });
    });
}

export {initDragDrop};