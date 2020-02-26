
let widgetAddSourcePlaceholder = null;
let cmbBuilder = null;

function initFunctions(cmbBuilder) {

    window.cmbBuilder = cmbBuilder;

    let currentHoverElement = null;

    $(document).ready(function() {

        // on mouse over, widget option show
        $(document).on('mouseover', '.main-container', function(e) {

            //console.log($(e.target).attr('class'));

            console.log($(e.target).attr('class'));

            if ( $(e.target).closest('.cmb-wrapper').length > 0 ) {

                $(currentHoverElement).removeClass('on-hover');

                $(e.target).closest('.cmb-wrapper').addClass('on-hover');

                $("#edit-icons").css('top', $(e.target).closest('.cmb-wrapper').offset().top - 46);

                $("#edit-icons").css('left', ($(e.target).closest('.cmb-wrapper').offset().left + $(e.target).closest('.cmb-wrapper').width() - 65));

                currentHoverElement = $(e.target).closest('.cmb-wrapper');


                $("#cmb-inner-actions #edit-icons").removeClass('hover-cmb-sections');
                $("#cmb-inner-actions #edit-icons").removeClass('hover-cmb-row');
                $("#cmb-inner-actions #edit-icons").removeClass('hover-cmb-element');
                $("#cmb-inner-actions #edit-icons").addClass('hover-' + $(e.target).closest('.cmb-wrapper').attr('class').split(" ")[1]);

            } else if ( (($(e.target).closest('.cmb-action-icons').length === 0)) ) {

                $(currentHoverElement).removeClass('on-hover');

                $("#edit-icons").css('top', -1000);

                currentHoverElement = null;
            }

        });


       //toggle right sidebar
        $(document).on('click', '.right-sidebar-expand-toggle', function(e) {

            let allowed_items = $(this).attr('data-allowed-widget-items');
            console.log("AI: " + allowed_items);

            allowed_items = allowed_items.split(',');

            allowed_items.forEach(function(item, index, array) {

                cmbBuilder.viewWidgetSections.push('cmb-' + item);
            });


            ////////////
            $('#widget-collection-list .page-element-list-container').each(function(index, element) {

                console.log(cmbBuilder.viewWidgetSections[index] + ", " + $(element).attr('id'));

                allowed_items.forEach(function(item, i, array) {

                    if (cmbBuilder.viewWidgetSections[i] === $(element).attr('id')) {

                        $(element).addClass('active');
                        return;

                    } else {

                        $(element).removeClass('active');
                    }
                });
            });


            $('#open-widget-list').trigger('click');

            // holds the source placeholder parent where widget will be added from the right sidebar
            // PARENT CLASS: cmb-cb cmb-parent-placeholder-empty

            if ( $(this).parents('.cmb-add-new-section').length === 1 ) {

                window.widgetAddSourcePlaceholder = $(this).parent().parent();
            } else {

                window.widgetAddSourcePlaceholder = $(this).parent().parent();
            }
        });

        // open widget list on button click
        $(document).on('click', "#right-sidebar .option-links #open-widget-list", function () {

            let widgetCollectionList = $('#widget-collection-list');

            console.log(widgetCollectionList.hasClass('active'));

            if (widgetCollectionList.hasClass('active')) {
                widgetCollectionList.removeClass('active');
            } else {
                widgetCollectionList.addClass('active');
            }
        });

        // add section
        $(document).on('click', '.cmb-add-section', function(e) {

            e.preventDefault();

            console.log('CLICK: .cmb-add-section');

            // only section widgets will show
            cmbBuilder.viewWidgetSections.push('cmb-section');

            // open the widget list
            $('#open-widget-list').trigger('click');
        });
    });
}

export {initFunctions};