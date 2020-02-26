<?php $counter = 0; ?>
<div role="tabpanel" class="tab-pane fade <?php echo ($counter == 0) ? 'active in' : ''; ?>" id="tab_secton" aria-labelledby="grid-tab">
    <ul class="editor-element-items clearfix">
    @foreach ($widgets as $key => $element)
        <li class="item col-md-3">
            <div class="item-container">
                <i class="<?php echo $element['icon'] ?> widget-element-icon" aria-hidden="true" style="font-family: FontAwesome"></i>
                <a id="{{ $element['id'] }}" class="{{ implode(' ', $element['class']) }}" data-tag="{{ $element['id'] }}" class="dropable_el vc_shortcode-link" href="#" data-vc-clickable="">
                    <!--<i class="vc_general vc_element-icon icon-wpb-contactform7"></i>-->

                    {{ $element['title'] }}
                    <i class="vc_element-description">{{ $element['description'] }}</i>
                </a>
            </div>
        </li>
        <?php $counter++; ?>
    @endforeach
    </ul>
</div>
