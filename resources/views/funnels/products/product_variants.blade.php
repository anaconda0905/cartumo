<div class="option-container">
    @if ( $data['type'] == 'manual' )
        @if ( !empty(json_decode($data['product']->options)) )

            <?php $variant_options = json_decode($data['product']->options->first()->options); ?>
            <?php $options = $variant_options->options->option_name; ?>

            @foreach ( $options as $key=>$option )
                <div class="form-group option-items">
                    <label class="control-label col-sm-3" for="product_add_product">{{ $option }}:</label>
                    <div class="col-sm-9">
                        <select name="product_options[{{ strtolower($option) }}]" class="form-control">
                            <?php $variants = explode(',', $variant_options->options->option_value[$key]); ?>
                            @foreach ($variants as $k => $variant)
                                <option value="{{ $variant }}">{{ $variant }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
            @endforeach        
        @endif

        <div class="form-group">
            <label class="control-label col-sm-3" for="product_add_product">Quantity:</label>
            <div class="col-sm-9">
                <select class="form-control" id="product_quantity" name="product_quantity">
                    @foreach ( range(1, 10) as $item )
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
            </div>
        </div>       

        <input type="hidden" name="hid_option_index" value=""/>
    @else
        @if ( !empty($data['product']->product->options) )
            @foreach ( $data['product']->product->options as $key=>$option )

                <div class="form-group option-items">
                    <label class="control-label col-sm-3" for="product_add_product">{{ $option->name }}:</label>
                    <div class="col-sm-9">
                        <select name="product_options[{{ strtolower($option->name) }}]" class="form-control">
                            @foreach ($option->values as $k => $variant)
                                <option value="{{ $variant }}">{{ $variant }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>            
            @endforeach

            <div class="form-group">
                <label class="control-label col-sm-3" for="product_add_product">Quantity:</label>
                <div class="col-sm-9">
                    <select class="form-control" id="product_quantity" name="product_quantity">
                        @foreach ( range(1, 10) as $item )
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
            </div>   

            <input type="hidden" name="hid_option_index" value=""/>
        @endif
    @endif
 </div>