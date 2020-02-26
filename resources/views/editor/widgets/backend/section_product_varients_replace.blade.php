@if ( !empty($data['stepProduct']) )
    @if ( $data['stepProduct']->product_type == 'manual' )
        @if ( !empty(json_decode($data['product']->options)) )
			<?php $variant_options = json_decode( $data['product']->options->first()->options ); ?>
			<?php $options = $variant_options->options->option_name; ?>
            @foreach ( $options as $key=>$option )
                <ul class="option-item clearfix">
                    <li class="text-left"><label for="">{{ $option }}:</label></li>
                    <li class="text-left">
                        <select name="product_options[{{ strtolower($option) }}]" class="form-control">
							<?php $variants = explode( ',', $variant_options->options->option_value[ $key ] ); ?>
                            @foreach ($variants as $k => $variant)
								<?php
								$str = preg_replace( "[^a-z0-9\040]", "", str_replace( "_", " ", $variant ) );
								$str = preg_replace( "[\040]", "_", trim( $variant ) ); ?>
                                <option value="{{ strtolower($str) }}">{{ $variant }}</option>
                            @endforeach
                        </select>
                    </li>
                </ul>
            @endforeach
            <input type="hidden" name="hid_option_index" value=""/>
        @endif
    @else
        @if ( !empty($data['product']->product->options) )
            @foreach ( $data['product']->product->options as $key=>$option )
                <ul class="option-item clearfix">
                    <li class="text-left"><label for="">{{ $option->name }}:</label></li>
                    <li class="text-left">
                        <select name="product_options[{{ strtolower($option->name) }}]"
                                class="form-control">
                            @foreach ($option->values as $k => $variant)
                                <option value="{{ $variant }}">{{ $variant }}</option>
                            @endforeach
                        </select>
                    </li>
                </ul>
            @endforeach

            <input type="hidden" name="hid_option_index" value=""/>
        @endif
    @endif
@endif