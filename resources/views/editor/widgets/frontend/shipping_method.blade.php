<div class="shipping-method-form-panel">
    <div class="section-title" style="text-align: left">
        <strong>Shipping Methods</strong>
    </div>

    <div class="panels">
        <div class="body">
            @if ( !empty($shippings) )
                @foreach ( $shippings as $key=>$shipping )                
                    <div class="form-group">
                        <label for="shipping_method{{ $key }}">
                            @if ( (!empty($cart['shipping'])) && (floatVal($cart['shipping'])==floatVal($shipping->amount)) )
                                <input type="radio" name="shipping_method" id="shipping_method{{ $key }}" class="panel-selection-radio"
                                   value="{{ $shipping->amount }}" checked />
                            @else
                                <input type="radio" name="shipping_method" id="shipping_method{{ $key }}" class="panel-selection-radio"
                                   value="{{ $shipping->amount }}" />
                            @endif
                            
                            <span>{{ $shipping->title }}</span> <span
                                    class="amount">${{ $shipping->amount }}</span>
                        </label>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>