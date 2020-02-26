let dragSrcEl = null;
let dragSrcElParent = null;
let widgetContentData = null;

function initDragDrop() {

    // Initialize the draggable widget items from the right sidebar
    let draggableItems = $('.ui-draggable');
    //let draggableItems = $('.item-wrapper');
    let droppableItems = $('.ui-droppable');

    bind_sortable();
    bind_draggble();

    $(droppableItems).droppable({
        // accept : 'div',
        drop: function(ev, ui) {

            console.log("CONTENT:" + window.widgetContentData);

            // $(ui.draggable).clone(true).appendTo(window.widgetContentData);

           // bind_draggble();
            // bind_sortable();

            ev.stopPropagation();
            ev.preventDefault();
        }
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

function bind_draggble(){

    $(".ui-draggable").draggable({
        // containment : '#cm-builder',
        // connectToSortable : '.cm-section-wrapper',

        containment : '#cm-builder',
        revert: 'none',
        proxy: 'clone',
        connectToSortable: ".cm-section-wrapper",
        helper: "clone",
        drag: function( event, ui ) {
            $(ui).addClass('dragging');
        },
        start: function(event, ui) {
            console.log(event);
            $(ui.helper).addClass('dragging');

            let widget_id = 'widget-' + event.target.getAttribute('data-element');
            console.log("WIDGET ID: " + widget_id);

            let widgetContent = async function ajaxCall(url, data) {

                const location = window.location.hostname;
                const settings = {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: JSON.stringify(data), // body data type must match "Content-Type" header
                };


                const contentData = await fetch(`http://${location}:8000/${url}`, settings)
                    .then(response => response.text())
                    .then(data => {

                        // $('#cm-builder .cm-section-wrapper').append(data);

                        window.widgetContentData = data;
                    });

                return contentData;
            }('sidebar/widget/', {'id': widget_id});
        }
    });
}

function bind_sortable(){
    $(".ui-sortable").sortable({
        start: function (e, ui) {
            ui.placeholder.height(ui.item.height());
            ui.placeholder.css('visibility', 'visible');
        },
        stop: function (event, ui) {
            // save new sort order
        },
        update: function (event, ui) {
            if ($(ui.sender).hasClass('section-groups')) {
                $(ui.sender).html("<button style='margin-top: 30px; width: 70%' class='add-inner-element btn btn-primary add-element' data-section-id='row' id='row_modal' alt='Add elements' data-toggle='modal' data-target='#rowModal'>ADD SECTION </button>");
            }
        },
        receive : function( event, ui ){
            // ui.item.draggable('disable');
        }
    });
}

export {initDragDrop};