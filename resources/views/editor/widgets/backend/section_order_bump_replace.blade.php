@if ( !empty(is_object($data['bumpProduct'])) )
    <ul style="background-color:#ffff99">
        <li><img src="{{ asset('images/arrow-flash-small.gif') }}"/></li>
        <li><input type="checkbox" class="checkbox" name="bump[product_id]"
                   value="{{ $data['bumpProduct']->id }}" id="bump_product_offer"
                   data-product-type="{{ $data['stepProduct']->product_type }}"/></li>
        <li style="font-size: 21px;color:#009900"><b>Yes, I will Take It!</b></li>
    </ul>

    <div class="bump-details">
        <span style="font-size: 15px;">One time offer</span>:
        <span style="color:#2f2f2f;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut, quod hic expedita consectetur vitae nulla sint adipisci cupiditate at. Commodi, dolore hic eaque tempora a repudiandae obcaecati deleniti mollitia possimus.</span>
    </div>
@else
    <ul style="background-color:#ffff99">
        <li><img src="{{ asset('images/arrow-flash-small.gif') }}"/></li>
        @if ( !empty($data['bumpProduct']) )
            <li><input type="checkbox" class="checkbox" name="bump[product_id]"
                       value="{{ $data['bumpProduct'] }}" id="bump_product_offer"
                       data-product-type="{{ $data['stepProduct']->product_type }}"/></li>
        @else
            <li><input type="checkbox" class="checkbox" name="bump[product_id]" value="{{ $data['bumpProduct'] }}"
                       id="bump_product_offer" data-product-type="{{ $data['stepProduct']->product_type }}"/></li>
        @endif
        <li style="font-size: 21px;color:#009900"><b>Yes, I will Take It!</b></li>
    </ul>

    <div class="bump-details">
        <span style="font-size: 15px;">One time offer</span>:
        <span style="color:#2f2f2f;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut, quod hic expedita consectetur vitae nulla sint adipisci cupiditate at. Commodi, dolore hic eaque tempora a repudiandae obcaecati deleniti mollitia possimus.</span>
    </div>
@endif
