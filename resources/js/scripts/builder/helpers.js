
export function mark_container_non_empty(sourceElement) {

    if ($(sourceElement).hasClass('cmb-parent-placeholder-empty')) {

        $(sourceElement).removeClass('cmb-parent-placeholder-empty');
    }
}