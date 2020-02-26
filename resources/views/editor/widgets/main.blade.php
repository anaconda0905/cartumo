<div class="" role="tabpanel" data-example-id="togglable-tabs">
    <div id="myTabContent" class="tab-contents">
        <?php $counter = 0; ?>
        @foreach ($widgets as $key => $widget)
            <div role="tabpanel" class="tab-pane fade <?php echo ($counter == 0) ? 'active in' : ''; ?>"
                 id="tab_{{ $key }}" aria-labelledby="{{ $key }}-tab">
                <ul class="editor-element-items">

                    @foreach ($widget as $key => $element)
                        <li class="item">
                            <div class="item-container">
                                <a id="{{ $element['id'] }}" class="{{ implode(' ', $element['class']) }}"
                                   data-tag="{{ $element['id'] }}" class="dropable_el vc_shortcode-link" href="#"
                                   data-vc-clickable="">
                                    <i class="vc_general vc_element-icon icon-wpb-contactform7"></i> {{ $element['title'] }}
                                    <i class="vc_element-description">{{ $element['description'] }}</i>
                                </a>
                            </div>
                        </li>
                        @endforeach


                                <!--<li class="item">
                          <div class="item-container">
                              <a id="element_grid" data-tag="contact-form-7" class="dropable_el vc_shortcode-link" href="#" data-vc-clickable="">
                                  <i class="vc_general vc_element-icon icon-wpb-contactform7"></i> Bootstrap Grid
                                  <i class="vc_element-description">Place bootstrap grid</i>
                              </a>
                          </div>
                      </li>-->
                </ul>
            </div>
            <?php $counter++; ?>
            @endforeach


                    <!--<div role="tabpanel" class="tab-pane fade" id="tab_content" aria-labelledby="profile-tab">
            <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
              booth letterpress, commodo enim craft beer mlkshk aliquip</p>
          </div>

          <div role="tabpanel" class="tab-pane fade" id="tab_form" aria-labelledby="profile-tab">
            <p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
              booth letterpress, commodo enim craft beer mlkshk </p>
          </div>-->
    </div>
</div>
