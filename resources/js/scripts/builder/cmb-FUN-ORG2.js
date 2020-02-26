let dragSrcEl = null;
let dragSrcElParent = null;

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
    /*this.classList.add("ui-sortable");
    this.classList.add("dragging");
    console.log("CUR" + this);

    $(dragSrcEl).sortable({

        connectWith: ".ui-sortable",
        distance: 5,
        helper: "clone",
        placeholder: "sortable-placeholder",
        start: function (e, ui) {
            ui.placeholder.height(ui.item.height());
            ui.placeholder.css('visibility', 'visible');
        },
        stop: function (event, ui) {
            // save new sort order
        },
        update: function (event, ui) {
            if ($(ui.sender).hasClass('ui-sortable')) {
                $(ui.sender).html("<button style='margin-top: 30px; width: 70%' class='add-inner-element btn btn-primary add-element' data-section-id='row' id='row_modal' alt='Add elements' data-toggle='modal' data-target='#rowModal'>ADD SECTION </button>");
            }
        }
    });*/

    /*var crt = e.target.cloneNode(true);
    crt.style.backgroundColor = "red";
    e.dataTransfer.setDragImage(crt, 0, 0);*/

    e.dataTransfer.setData("text/plain", 'widget-' + e.target.getAttribute('data-element'));
}

function dragEnter(e) {

    // e.target.classList.add('drag-over');
    this.classList.add('drag-over');

    console.log(this);


    dragSrcEl.classList.add("ui-sortable");
    dragSrcEl.classList.add("dragging");
    console.log("CUR" + this);

    $(dragSrcEl).parent().sortable({

        connectWith: ".ui-sortable",
        distance: 5,
        helper: "clone",
        placeholder: "sortable-placeholder",
        start: function (e, ui) {
            ui.placeholder.height(ui.item.height());
            ui.placeholder.css('visibility', 'visible');
        },
        stop: function (event, ui) {
            // save new sort order
        },
        update: function (event, ui) {
            if ($(ui.sender).hasClass('ui-sortable')) {
                // $(ui.sender).html("<button style='margin-top: 30px; width: 70%' class='add-inner-element btn btn-primary add-element' data-section-id='row' id='row_modal' alt='Add elements' data-toggle='modal' data-target='#rowModal'>ADD SECTION </button>");
            }
        }
    });
}

function dragLeave(e) {
    // e.target.classList.remove('drag-over');  // this / e.target is previous target element.
    this.classList.remove('drag-over');
}

function dragOver(e) {
    e.preventDefault();
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