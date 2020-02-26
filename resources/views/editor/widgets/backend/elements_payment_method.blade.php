
    <div class="ld-element ld-element-form payment-form-wrapper inline-element" id="{{ $id }}"
         data-de-type="payment-form">
        <div class="element-payment-form lh4 ld-margin0 element-text-shadow">
            <div class="wrapper">

                <div class="payment-form-panel">
                    <div class="section-title">
                        <span>Payment method</span>
                        <p>All transactions are secure and encrypted.</p>
                    </div>

                    <div class="panels">
                        <div class="form-group">
                            <label for="selection_payment_card">
                                <input type="radio" id="selection_payment_card" name="payment_selection" class="panel-selection-radio"
                                       value="credit_card" checked required />
                                <strong>Credit Card</strong>
                            </label>

                            <label class="cards" style="width: 70%;">
                                <img src="{{ asset('images/cards.png') }}" />
                            </label>
                        </div>

                        <div class="body">
                            <div class="form-group">
                                <div class="row clearfix">
                                    <div class="col-md-8 col-sm-8 col-xs-12 div-grid">
                                        <label for="number">Credit Card Number:</label>
                                        <input type="text" class="form-control" name="number" id="number"
                                               placeholder="Card Number" />
                                    </div>

                                    <div class="col-md-4 col-sm-4 col-xs-12 div-grid">
                                        <label for="ccv">CVC:</label>
                                        <input type="text" class="form-control" name="cvc" id="cvc" placeholder="CVC"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row clearfix">
                                    <div class="col-md-6 col-sm-6 col-xs-12 div-grid">
                                        <label for="exp-month">Expiry Month:</label>
                                        <select class="form-control" id="exp-month" name="exp-month">
                                            @foreach (range(1, 12) as $key => $month)
                                                <option value="{{ $month }}">{{ $month }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-12 div-grid">
                                        <label for="exp-year">Expiry Year:</label>
                                        <select class="form-control" name="exp-year" id="exp-year">
                                            @foreach (range(date('Y'), intval(date('Y') + 20)) as $key => $year)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endforeach
                                        </select>
                                    </div>
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
                <li class="ld_controls_edit open-payment-setings-modal" data-toggle="modal"
                    data-target="#paymentSettingsModal">
                    <i class="fa fa-cog" aria-hidden="true"></i></li>
                <li class="ld_controls_close"><i class="fa fa-times" aria-hidden="true"></i></li>
            </ul>
        </div>

        <button type="button" class="addElementFlyoutDOM replace-element" data-section-id="element-forms"
                alt="Add elements" data-toggle="modal" data-target="#elementModal"><i class="fa fa-plus"></i></button>
    </div>