
let cmbBuilder = null;

function initComponents(cmbBuilder) {

    window.cmbBuilder = cmbBuilder;

    $(document).ready(function(e) {

        // open-close component settings panel from left
        $(document).on('click', '#cmb-inner-actions #edit-icons .cmb-control-settings-handle', function(e) {


            $("#panel-left-sidebar #cmb-option-panel").toggleClass("active");

            // console.log(window.cmbBuilder.component.init_component_sidebar);

            init_component_sidebar($("#panel-left-sidebar #cmb-option-panel"));
        });

    });
}


export function init_component_sidebar(sidebar) {

    console.log("init_component_sidebar");

    // if the option settings has clicked
    if ($(sidebar).hasClass('active')) {

        // get the current block
        let block = get_current_block();

        console.log(block);

        if ( $(block).hasClass('cmb-sections') ) {

            load_section_component();
        }
    }
}



function load_section_component() {


}



function get_current_block() {

    return $(".on-hover");
}


export {initComponents};