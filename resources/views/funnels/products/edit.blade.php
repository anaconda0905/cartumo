<form id="frm_update_product" action="{{ route('product.update', array($stepProduct->funnel_id, $stepProduct->step_id, $stepProduct->id)) }}" method="post">
    <div class="" role="tabpanel" data-example-id="togglable-tabs">
          <ul id="myTab1" class="nav nav-tabs bar_tabs right" role="tablist">
            <!--<li role="presentation" class="">
                <a href="#tab_email" id="general-tabb" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Email</a>
            </li>-->
            <li role="presentation" class="active">
                <a href="#tab_general" role="tab" id="email-tabb" data-toggle="tab" aria-controls="profile" aria-expanded="false">General</a>
            </li>
          </ul>
          <div id="myTabContent2" class="tab-content">
            <div role="tabpanel" class="tab-pane fade active in" id="tab_general" aria-labelledby="home-tab">
                <div class="form-group">
                    <label for="billing_info">Choose product:</label>
                      <div class="dropdown full-dropdown">
                          <button class="btn dropdown-toggle col-md-12" type="button" data-toggle="dropdown">
                              <span>{{ $stepProduct->product->name }}</span>
                              <span class="caret"></span>
                          </button>

                          <div class="clearfix"></div>

                          <ul class="dropdown-menu col-md-12">
                              @foreach ( $manualProducts as $key => $product)
                                  <li>
                                      <a href="#" data-product-id="{{ $product->id }}">
                                          <?php $image = json_decode($product->images); ?>
                                          <span><img src="{{ $image->main }}" style="width: 42px; height: 42px;" /></span>
                                          <span class="title">{{ $product->name }}</span>
                                      </a>
                                  </li>
                              @endforeach
                          </ul>

                          <input type="hidden" name="product_id" id="modal_hid_product_id" value="{{ $stepProduct->product->id }}" />
                      </div>

                </div> <br />

                <div class="form-group">
                  <label for="billing_info">Billing Integration:</label>
                  <select name="billing_info" id="billing_info" class="form-control" required>
                      <option>--SELECT--</option>
                      <option value="stripe" {{ ($stepProduct->payment_getway == 'stripe') ? 'selected' : '' }}>Stripe</option>
                  </select>
                </div>
            </div>
            <!--<div role="tabpanel" class="tab-pane fade" id="tab_email" aria-labelledby="profile-tab">
              <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
                booth letterpress, commodo enim craft beer mlkshk aliquip</p>
            </div>-->
          </div>
       </div>

    <input type="hidden" name="funnel_id" value="{{ $product->funnel_id }}" />
    <input type="hidden" name="step_id" value="{{ $product->funnel_step_id }}" />
    <input type="hidden" id="csrf_token" name="_token" value="{{ csrf_token() }}" />

    <br />
    <div class="modal-footer">
      <button type="submit" class="btn btn-success"> Save Product </button>
    </div>


</form>
