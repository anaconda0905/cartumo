let dragSrcEl = null;
let dragSrcElParent = null;
let prevWidgetPlaceholder = null;
let placeholderPlaced = false;
let utils = null;

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
    this.classList.add('drag-over');

    window.placeholderPlaced = false;
}

function dragLeave(e) {

    e.preventDefault();
    e.stopPropagation();

    this.classList.remove('drag-over');

    $(e.target).closest('.cmb-wrapper').removeClass('drag-over');

    if (e.target.parentElement.classList[0] === 'cmb-widget-container') {

        $('.cmb-sortable-placeholder').each(function(index, element) {

            //$(element).remove();
        });
    }
}

function dragOver(e) {
    e.preventDefault();
    e.stopPropagation();

    if (e.target.parentElement.classList[0] === 'cmb-widget-container') {
        let eleHeight = e.target.parentElement.clientHeight / 2;

        console.log("CAL: " + e.offsetY + ", " + eleHeight);


        let pElement = $(e.target.parentElement).parent().parent();

        clean_existing_placeholder(pElement);

        // $(pElement).addClass('mt-50');

        console.log(e.offsetY + ", " + eleHeight);

        if (e.offsetY <= eleHeight) {

            if ( !is_placeholder_placed($(pElement).prev()) ) {

                $(pElement).before('<div class="cmb-sortable-placeholder cmb-widget-placeholder placeholder-before"></div>');
            }
        } else {

            if ( !is_placeholder_placed($(pElement).next()) ) {
                $(pElement).after('<div class="cmb-sortable-placeholder cmb-widget-placeholder placeholder-after"></div>');
            }
        }

    } else {

        if (e.target.parentElement.classList[0] === 'cmb-wrapper')
        {
            $('.cmb-sortable-placeholder').each(function (index, element) {
                $(element).remove();
            });
        }
    }
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

                    console.log($('#cm-builder').find('.cmb-sortable-placeholder').length);

                    if ($('#cm-builder').find('.cmb-sortable-placeholder').length) {
                        $('.cmb-sortable-placeholder').replaceWith($(data).find('h2').text(Math.random()));
                    } else {

                        $('#cm-builder .cm-section-wrapper').append(data);
                    }

                    sortable_ui();
                });

            return contentData;
        }('sidebar/widget/', {'id': widget_id});
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
                let replaceableParent = $(sourceElement).find('.cmb-replaceable-placeholder');
                if ($(replaceableParent).parent().hasClass('cmb-add-new-section')) {
                    $(replaceableParent).parent().replaceWith($(data));
                } else {
                    $(sourceElement).replaceWith($(data));
                }

                // mark the container as non-empty container
                console.log(window.util);
                window.utils.mark_container_non_empty(sourceElement);

                sortable_ui();

                // close the right sidebar
                $('#open-widget-list').trigger('click');
            });

        return contentData;
    }('sidebar/widget/', {'id': widget_id_str});
}




function sortable_ui() {

    $('.ui-sortable').each(function (index, element) {
        $(element).sortable({

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