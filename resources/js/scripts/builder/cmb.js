let dragSrcEl = null;
let dragSrcElParent = null;
let prevWidgetPlaceholder = null;
let placeholderPlaced = false;
let beforeReplaceContent = null;
let placeholderSource = null;
let cmbBuilder = null;

function initDragDrop(cmbBuilder) {

    window.cmbBuilder = cmbBuilder;

    // Initialize the draggable widget items from the right sidebar
    let draggableItems = $('.ui-draggable');
    //let draggableItems = $('.item-wrapper');
    let droppableItems = $('.ui-droppable');
    let clickableItems = $('.ui-clickable');

    $(draggableItems).each(function (index, widget) {

        /*widget.setAttribute('draggable', 'true');
        widget.setAttribute('aria-grabbed', 'false');
        widget.setAttribute('tabindex', '0');*/

        widget.addEventListener('dragstart', dragStart);
        widget.addEventListener('dragend', dragEnd);

    });


    $(clickableItems).each(function (index, widget) {

        widget.addEventListener('click', sidebarWidgetClick);
    });


    $(droppableItems).each(function (index, widget) {

        widget.addEventListener('dragenter', dragEnter);
        widget.addEventListener('dragleave', dragLeave);
        widget.addEventListener('dragover', dragOver);
        widget.addEventListener('drop', drop);
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

}

function dragOver(e) {
    e.preventDefault();
    e.stopPropagation();

    console.log($(e.target).attr('class'));
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

                        console.log($(sourceElement).attr('class'));

                        if ( $(sourceElement).hasClass('cmb-add-new-section') ) {

                            $(sourceElement).replaceWith($(data));
                        } else {

                            let replaceableParent = $(sourceElement).find('.cmb-replaceable-placeholder');
                            $(replaceableParent).replaceWith($(data));
                        }
                    } else {



                        if ( $(sourceElement).hasClass('cmb-add-new-section') ) {

                            $(sourceElement).replaceWith($(data));
                        } else {

                            let replaceableParent = $(sourceElement).find('.cmb-sortable-placeholder');
                            $(replaceableParent).replaceWith($(data));
                        }
                    }
                } else {

                    if ($(".cmb-add-new-section").length === 1) {
                        $(".cmb-add-new-section").replaceWith(data);
                    } else {
                        $(".cm-section-wrapper").append(data);
                    }
                }

                // mark the container as non-empty container
                // console.log(window.util);
                window.cmbBuilder.utils.mark_container_non_empty(sourceElement);
                window.cmbBuilder.viewWidgetSections = [];

                //sortable_ui();

                $('.cm-section-wrapper').sortable({

                    // connectWith: ".cmb-cb",
                    // handle: ".handle",

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

                // close the right sidebar
                $('#open-widget-list').trigger('click');

                window.widgetAddSourcePlaceholder = null;
            });

        return contentData;
    }('sidebar/widget/', {'id': widget_id_str});
}




function sortable_ui() {

    // $('.cm-builder-inner').each(function (index, element) {
    //
    //     $(element).sortable({
    //
    //         connectWith: ".cmb-cb",
    //
    //         start: function (event, ui) {
    //             console.log(event);
    //         },
    //         change: function (event, ui) {
    //             console.log(event);
    //         },
    //         update: function (event, ui) {
    //             // $('#sortable li').removeClass('highlights');
    //             console.log("Updated");
    //         }
    //     });
    // });
}

export {initDragDrop};