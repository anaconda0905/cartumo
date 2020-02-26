<div class="element-order-info lh4 size3 ld-margin0 element-text-shadow padd-15">
    <div class="wrapper ld_editable">
        <div class="rows">
            <h1 class="" data-align="">Thank you for your purchase</h1>
            <p>A confirmation email has been send to <span
                        id="order_confirmation_email_address">{{ $order['order']['customer']['email'] }}</span></p>
            <p><strong id="order_confirmation_id">Order #123456</strong></p>
        </div>

        <div class="rows">
            <a href="#" class="btn btn-primary" data-text-color="#ffffff" data-bg-color="">Continue Shopping</a>
            <button class="btn btn-primary-transparent" id="order-print-receipt"><i class="fa fa-print"
                                                                                    aria-hidden="true"></i> &nbsp; Print
                Receipt
            </button>
        </div>

        <div class="rows" style="padding-top: 30px">
            <div class="clearfix">
                <div class="col-md-6">
                    <h4 class="text-left">SHIPPING ADDRESS</h4>
                    <div class="info text-left">
                        <div class="rows">
                            <strong>First Name</strong>
                            <p>{{ $order['order']['shipping']['first_name'] }}</p>
                        </div>
                        <div class="rows">
                            <strong>Last Name</strong>
                            <p>{{ $order['order']['shipping']['last_name'] }}</p>
                        </div>
                        <div class="rows">
                            <strong>Full Address</strong>
                            <p>{{ $order['order']['shipping']['full_address'] }}</p>
                        </div>
                        <div class="rows">
                            <strong>Apt</strong>
                            <p>{{ $order['order']['shipping']['apt'] }}</p>
                        </div>
                        <div class="rows">
                            <strong>City</strong>
                            <p>{{ $order['order']['shipping']['city'] }}</p>
                        </div>
                        <div class="rows">
                            <strong>Country</strong>
                            <p>{{ $order['order']['shipping']['country'] }}</p>
                        </div>
                        <div class="rows">
                            <strong>State</strong>
                            <p>{{ $order['order']['shipping']['state'] }}</p>
                        </div>
                        <div class="rows">
                            <strong>Zip</strong>
                            <p>{{ $order['order']['shipping']['zip'] }}</p>
                        </div>
                        <div class="rows">
                            <strong>Phone</strong>
                            <p>{{ $order['order']['shipping']['phone'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h4 class="text-right">BILLING ADDRESS</h4>
                    <div class="info text-right">
                        <div class="rows">
                            <strong>First Name</strong>
                            <p>{{ $order['order']['billing']['first_name'] }}</p>
                        </div>
                        <div class="rows">
                            <strong>Last Name</strong>
                            <p>{{ $order['order']['billing']['last_name'] }}</p>
                        </div>
                        <div class="rows">
                            <strong>Full Address</strong>
                            <p>{{ $order['order']['billing']['full_address'] }}</p>
                        </div>
                        <div class="rows">
                            <strong>Apt</strong>
                            <p>{{ $order['order']['billing']['apt'] }}</p>
                        </div>
                        <div class="rows">
                            <strong>City</strong>
                            <p>{{ $order['order']['billing']['city'] }}</p>
                        </div>
                        <div class="rows">
                            <strong>Country</strong>
                            <p>{{ $order['order']['billing']['country'] }}</p>
                        </div>
                        <div class="rows">
                            <strong>State</strong>
                            <p>{{ $order['order']['billing']['state'] }}</p>
                        </div>
                        <div class="rows">
                            <strong>Zip</strong>
                            <p>{{ $order['order']['billing']['zip'] }}</p>
                        </div>
                        <div class="rows">
                            <strong>Phone</strong>
                            <p>{{ $order['order']['billing']['phone'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- controls -->
<div class="ld_inline_controls">
    <ul class="ld_option_menu">
        <!--<li class="ld_controls_editor"><i class="fa fa-code" aria-hidden="true"></i></li>-->
        <li class="ld_controls_move"><i class="fa fa-arrows" aria-hidden="true"></i></li>
        <li class="ld_controls_clone"><i class="fa fa-files-o" aria-hidden="true"></i></li>
        <li class="ld_controls_edit open-order-info-settings-modal" data-toggle="modal"
            data-target="#orderInfoSettingsModal"><i class="fa fa-cog" aria-hidden="true"></i></li>
        <li class="ld_controls_close"><i class="fa fa-times" aria-hidden="true"></i></li>
    </ul>
</div>

<button type="button" class="addElementFlyoutDOM replace-element" data-section-id="element-order" alt="Add elements"
        data-toggle="modal" data-target="#elementModal"><i class="fa fa-plus"></i></button>