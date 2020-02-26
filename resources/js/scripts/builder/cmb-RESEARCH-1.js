let dragSrcEl = null;
let dragSrcElParent = null;
let prevWidgetPlaceholder = null;

function initDragDrop() {

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

        // console.log(widgetCollectionList);

        if (widgetCollectionList.hasClass('active')) {
            widgetCollectionList.removeClass('active');
        } else {
            widgetCollectionList.addClass('active');
        }
    });

}

function dragStart(e) {

    console.log("CUR:");

    // dragSrcEl = e.target;
    // e.dataTransfer.effectAllowed = 'move';
    // e.dataTransfer.dropEffect = "copy";

    dragSrcEl = e.target;

    // this.classList.add("dragging");
    this.classList.add("ui-sortable");
    this.classList.add("dragging");
    console.log("CUR" + this);

    // sortable_ui();

    /*var crt = e.target.cloneNode(true);
    crt.style.backgroundColor = "red";
    e.dataTransfer.setDragImage(crt, 0, 0);*/

    e.dataTransfer.setData("text/plain", 'widget-' + e.target.getAttribute('data-element'));
}

function dragEnter(e) {

    // e.target.classList.add('drag-over');
    this.classList.add('drag-over');
    // console.log(e);


    // console.log(e.target.parentElement.classList[0]);
    //
    // if (e.target.parentElement.classList[0] === 'cmb-widget-container') {
    //     console.log(e);
    // }

    //console.log(e.target);
    // console.log(dragSrcEl);

    // window.prevWidgetPlaceholder = $(e.target.parentElement).closest('.cmb-wrapper').append('<div class="cmb-sortable-placeholder cmb-widget-placeholder"></div>');
}

function dragLeave(e) {
    // e.target.classList.remove('drag-over');  // this / e.target is previous target element.
    this.classList.remove('drag-over');

    // $(window.prevWidgetPlaceholder).find('.cmb-sortable-placeholder').remove();
}

function dragOver(e) {
    e.preventDefault();

    // console.log("Y:" + e.y + ', ' + "offsetY:" + e.offsetY + ', ' + "clientY:" + e.clientY + ', ' + "layerY:" + e.layerY + ', ' + "pageY:" + e.pageY + ', ' + "screenY:" + e.screenY);

    // if (e.offsetY <= e.y) {
    //     console.log('PREPEND');
    // } else {
    //     console.log('APPEND');
    // }

    // console.log(e);

    // $(e.target.parentElement).closest('.cmb-wrapper').append('<div class="cmb-sortable-placeholder cmb-widget-placeholder"></div>');

    // if (e.offsetY < e.target.offsetY) {
    //
    //     console.log(e.offsetY + " - " + e.target.offsetY);
    // } else {
    //
    //     console.log(e.offsetY + " - " + e.target.offsetY);
    // }

    // console.log(e.offsetY + " - " + e.target.offsetTop); // offsetTop

    /* WORKING PATTERN */
    // if (e.offsetY < e.target.offsetTop) {
    //     console.log('PREPEND');
    // } else {
    //     console.log('APPEND');
    // }
}

function drop(e) {

    if (e.stopPropagation) {
        e.stopPropagation(); // stops the browser from redirecting.
    }

    console.log("DROPED");
    /*console.log(e.dataTransfer.getData('text'));
    console.log("CLASS: " + e.target.parentElement.className);*/

    // Don't do anything if dropping the same column we're dragging.
    /*if (dragSrcEl != this) {
        console.log("DRAG CANCEL");
    }*/

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

            // console.log(`http://${location}:8000/${url}`);

            const contentData = await fetch(`http://${location}:8000/${url}`, settings)
                .then(response => response.text())
                .then(data => {

                    $('#cm-builder .cm-section-wrapper').append(data);

                    // e.target.append(data);

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