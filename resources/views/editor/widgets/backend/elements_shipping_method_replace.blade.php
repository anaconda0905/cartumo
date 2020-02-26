<?php if ( ! empty( $data['stepProduct'] ) ) { ?>
    <?php $details = json_decode( $data['stepProduct']->details ); ?>
    <?php if ( ! empty( $details->shipping ) ) { ?>
        <?php foreach ( $details->shipping as $shippingMethod ) { ?>
            @if ( !empty($shippingMethod->title) )
                <div class="form-group">
                    <label for="shipping_method">
                        <input type="radio" name="shipping_method" class="panel-selection-radio"
                               value="<?php echo $shippingMethod->amount; ?>"
                               required/>
                        <span><?php echo $shippingMethod->title; ?></span> <span
                                class="amount">$<?php echo $shippingMethod->amount; ?></span>
                    </label>
                </div>
            @else
                <p>No shipping method</p>
            @endif
        <?php } ?>
    <?php } ?>
<?php } ?>
