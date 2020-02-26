<div class="ld-element ui-draggable product-wrapper ld-editable inline-element" id="{{ $id }}" data-de-type="manual-product">
    <div class="element-product lh4 size3 ld-margin0 element-text-shadow">
        <div class="wrapper">

            <div class="product clearfix">
                <?php $images = json_decode( $product->images ); ?>

                <div class="col-md-6">
                    <div class="image">
                        <div class="main">
                            <img src="{{ $images->main }}" />
                        </div>

                        <div class="additionals">
                            <ul>
                                @if ( !empty($images->additionals) )
                                    @foreach ($images->additionals as $key => $image)
                                        <li><img src ="{{ $image }}" /></li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 details">
                    <h2>{{ $product->name }}</h2>
                    <div class="price">
                        <span>Price: </span> <strong>${{ $product->price }}</strong>
                    </div>
                    <hr />

                    <div class="description">
                        <h4>Description</h4>
                        <?php echo $product->description ?>
                    </div>

                    @if ( !empty($product->options) )
                        @foreach ($product->options as $key => $option)
                            <ul class="option-item">
                                <li><label for="">{{ $option->option_name }}</label></li>
                                <li>
                                    <select name="product_options" class="form-control">
                                        <option value="">-- SELECT --</option>
                                        <?php $options = json_decode( $option->option_value ) ?>
                                        @foreach ($options as $key => $value)
                                            <option value="{{ $value->name }}" data-option-price="{{ $value->price }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </li>
                            </ul>
                        @endforeach
                    @endif

                    <hr />

                    <div class="buy-options">
                        <button type="button" class="btn btn-success btn-block btn-lg">Click to BUY</button>
                    </div>

                    <div class="share-product">
                        <ul class="social-share" data-url="">
                            <li class="social-likes-button widget-facebook">
                                <a href="#" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
                                   target="_blank" title="Share on Facebook"><i class="fa fa-facebook-official" aria-hidden="true"></i> Facebook
                               </a>
                            </li>

                            <li class="social-likes-button widget-twitter">
                                <a href="#"
                                   onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
                                   target="_blank" title="Share on Twitter">
                                   <i class="fa fa-twitter-square" aria-hidden="true"></i> Twitter
                                </a>
                            </li>

                            <li class="social-likes-button widget-gplus">
                                <a href="#"
                                   onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=350,width=480');return false;"
                                   target="_blank" title="Share on Google+">
                                   <i class="fa fa-google-plus-square" aria-hidden="true"></i> Google+
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>

            </div>

        </div>
  	</div>

    <!-- controls -->
    <div class="ld_inline_controls">
        <ul class="ld_option_menu">
            <li class="ld_controls_change_product show-settings-product-list" data-toggle="modal" data-target="#manualProductsModal"><i class="fa fa-cubes" aria-hidden="true"></i></li>
            <li class="ld_controls_move"><i class="fa fa-arrows" aria-hidden="true"></i></li>
            <li class="ld_controls_clone"><i class="fa fa-files-o" aria-hidden="true"></i></li>
            <li class="ld_controls_edit open-manual-product-setings-modal" data-toggle="modal" data-target="#manualProductSettingsModal"><i class="fa fa-cog" aria-hidden="true"></i></li>
            <li class="ld_controls_close"><i class="fa fa-times" aria-hidden="true"></i></li>
        </ul>
    </div>
</div>
