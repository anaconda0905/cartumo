<?php $counter = 0; ?>
<div role="tabpanel" class="tab-pane fade <?php echo ($counter == 0) ? 'active in' : ''; ?>" id="tab_grid" aria-labelledby="grid-tab">
    <ul class="editor-element-items clearfix">
    <?php usort($widgets, function ($a, $b) { return strnatcmp($a['title'], $b['title']); }); ?>

    @foreach ($widgets as $key => $element)

        @if ( stripos($element['visibility'], ',') !== FALSE )
            <?php $visibilities = explode(',', $element['visibility']); ?>
        @else
            <?php $visibilities = array($element['visibility']); ?>
        @endif

        @if ( ($pos = array_search(strtolower($type->name), $visibilities)) !== FALSE )
          @if ( $pos == 0 )
            @if ( !empty($stepProduct) )
              <li class="item col-md-3" data-filter="{{ (!empty($element['data-filter'])) ? $element['data-filter'] : '' }}">
                  <div class="item-container">
                      <?php //echo strpos($element['icon'], '.'); ?>
                      <i class="<?php echo (strpos($element['icon'], '.') != FALSE) ? 'fa fa-square-o' : $element['icon']; ?> widget-element-icon" aria-hidden="true" style="font-family: FontAwesome"></i>
                      <a id="{{ $element['id'] }}" class="{{ implode(' ', $element['class']) }}" data-tag="{{ $element['id'] }}" class="dropable_el vc_shortcode-link" href="#" data-vc-clickable="">
                          {{ $element['title'] }}
                          <i class="vc_element-description">{{ $element['description'] }}</i>
                      </a>
                  </div>
              </li>
            @else
              <li class="item col-md-3 disabled-selection" data-filter="{{ (!empty($element['data-filter'])) ? $element['data-filter'] : '' }}" disabled>
                  <div class="item-container">
                      <?php //echo strpos($element['icon'], '.'); ?>
                      <i class="<?php echo (strpos($element['icon'], '.') != FALSE) ? 'fa fa-square-o' : $element['icon']; ?> widget-element-icon" aria-hidden="true" style="font-family: FontAwesome"></i>
                      <a id="{{ $element['id'] }}" class="{{ implode(' ', $element['class']) }}" data-tag="{{ $element['id'] }}" class="dropable_el vc_shortcode-link" href="#" data-vc-clickable="">
                          {{ $element['title'] }}
                          <i class="vc_element-description">{{ $element['description'] }}</i>
                      </a>
                  </div>
              </li>
            @endif
          @else
            <li class="item col-md-3" data-filter="{{ (!empty($element['data-filter'])) ? $element['data-filter'] : '' }}">
                <div class="item-container">
                    <?php //echo strpos($element['icon'], '.'); ?>
                    <i class="<?php echo (strpos($element['icon'], '.') != FALSE) ? 'fa fa-square-o' : $element['icon']; ?> widget-element-icon" aria-hidden="true" style="font-family: FontAwesome"></i>
                    <a id="{{ $element['id'] }}" class="{{ implode(' ', $element['class']) }}" data-tag="{{ $element['id'] }}" class="dropable_el vc_shortcode-link" href="#" data-vc-clickable="">
                        {{ $element['title'] }}
                        <i class="vc_element-description">{{ $element['description'] }}</i>
                    </a>
                </div>
            </li>
          @endif

        @elseif ( array_search('all', $visibilities) !== FALSE )
          <li class="item col-md-3" data-filter="{{ (!empty($element['data-filter'])) ? $element['data-filter'] : '' }}">
              <div class="item-container">
                  <?php //echo strpos($element['icon'], '.'); ?>
                  <i class="<?php echo (strpos($element['icon'], '.') != FALSE) ? 'fa fa-square-o' : $element['icon']; ?> widget-element-icon" aria-hidden="true" style="font-family: FontAwesome"></i>
                  <a id="{{ $element['id'] }}" class="{{ implode(' ', $element['class']) }}" data-tag="{{ $element['id'] }}" class="dropable_el vc_shortcode-link" href="#" data-vc-clickable="">
                      {{ $element['title'] }}
                      <i class="vc_element-description">{{ $element['description'] }}</i>
                  </a>
              </div>
          </li>
        @endif
        <?php $counter++; ?>
    @endforeach
    </ul>
</div>
