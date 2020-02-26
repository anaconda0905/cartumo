class Cmb {
    constructor() {

        let dragSrcEl = null;
        let dragSrcElParent = null;

        // Initialize the draggable widget items from the right sidebar
        let initDraggableSidebarWidgets = function () {

            // let draggableItems = $('#widget-collection-list .column-items .item-wrapper .item');
            // let draggableItems = $('.ui-draggable');
            let draggableItems = $('.item-wrapper');
            let droppableItems = $('.ui-droppable');
            // console.log(draggableItems.length);
            let currentDraggedElement = null;

            $(draggableItems).draggable({
                revert: 'none',
                proxy: 'clone',
                connectToSortable: ".ui-sortable",
                helper: "clone",
                appendTo: "body",
                drag: function( event, ui ) {
                    // console.log(event.target.getAttribute('data-element'));
                },
                start: function(event, ui) {
                    currentDraggedElement = event.target.children[0];
                    console.log(currentDraggedElement);
                }
            });

            $('.ui-droppable').droppable({
                drop: function (e, ui) {
                    //console.log(e.target);
                    //console.log(ui);

                    e.preventDefault();

                    let widget_id = 'widget-' + currentDraggedElement.getAttribute('data-element');
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

                                console.log(data);

                                $('#cm-builder .cm-section-wrapper').append(data).sortable();
                            });

                        return contentData;
                    }('sidebar/widget/', {'id': widget_id});
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
        }();
    }
}

export default new Cmb();