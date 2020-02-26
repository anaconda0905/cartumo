
export function mark_container_non_empty(containerElement) {

    if ( $(containerElement).hasClass('cmb-parent-placeholder-empty') ) {

        $(containerElement).removeClass('cmb-parent-placeholder-empty')
    }
}