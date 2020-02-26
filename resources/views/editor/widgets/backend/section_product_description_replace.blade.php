@if ( !empty($data['stepProduct']) )
    @if ( $data['stepProduct']->product_type == 'manual' )
        <div data-element-type="product-description">
			<?php echo $data['product']->description ?>
        </div>
    @else
        <div data-element-type="product-description">
            <?php echo $data['product']->product->body_html ?>
        </div>
    @endif
@endif