
    <div class="ld-element headline-wrapper ld-editable inline-element" id="{{ $id }}" data-de-type="order-two-step">
        <div class="element-headline ld-margin0 element-text-shadow">
            <div class="wrapper">

                <form action="" method="post" class="" data-parsley-validate="">
                    <div class="order-info-one">
                        <div class="clearfix">
                            <div class="col-md-6 sides">
                                <div class="parts-container">
                                    <div class="step-parts">
                                        <div class="step-caption">
                                            <span><strong>Step #1</strong></span> <span>Contact Information</span>
                                        </div>

                                        <div class="step-body">
                                            <div class="form-group">
                                                <label for="full_name">Full Name:</label>
                                                <input type="text" name="full_name" id="full_name" class="form-control"
                                                       placeholder="Full Name.." data-parsley-required="true"/>
                                            </div>

                                            <div class="form-group">
                                                <label for="email">Email Address:</label>
                                                <input type="email" name="email" id="email" class="form-control"
                                                       placeholder="Email Address.." data-parsley-required="true"/>
                                            </div>

                                            <div class="form-group">
                                                <label for="phone">Phone Number:</label>
                                                <input type="text" name="phone" id="phone" class="form-control"
                                                       placeholder="Phone Number.." data-parsley-required="true"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="step-parts">
                                        <div class="step-caption">
                                            <span><strong>Step #2</strong></span> <span>Shipping Address</span>
                                        </div>

                                        <div class="step-body">
                                            <div class="form-group">
                                                <label for="street_address">Street Address:</label>
                                                <input type="text" name="street_address" id="full_name"
                                                       class="form-control" placeholder="Street Address.."
                                                       data-parsley-required="true"/>
                                            </div>

                                            <div class="form-group">
                                                <label for="city">City:</label>
                                                <input type="text" name="city" id="city" class="form-control"
                                                       placeholder="City.." data-parsley-required="true"/>
                                            </div>

                                            <div class="form-group">
                                                <label for="state_province">State / Province:</label>
                                                <input type="text" name="state_province" id="state_province"
                                                       class="form-control" placeholder="State / Province.."
                                                       data-parsley-required="true"/>
                                            </div>

                                            <div class="form-group">
                                                <label for="zip_postal">Zip / Postal Code:</label>
                                                <input type="text" name="cizip_postalty" id="zip_postal"
                                                       class="form-control" placeholder="Zip / Postal Code.."
                                                       data-parsley-required="true"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 sides">
                                <div class="parts-container">
                                    <div class="step-parts">
                                        <div class="rows">
                                            <div class="col-md-12">
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>Item</th>
                                                        <th>Price</th>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td><input type="radio" checked/> Dynamically Updated</td>
                                                        <td>$0.00</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="credit-card-details">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="row clearfix">
                                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                                <label for="">Credit Card Number:</label>
                                                                <input type="text" class="form-control"
                                                                       name="card_number" id="card_number"
                                                                       placeholder="card Number"
                                                                       data-parsley-required="true"/>
                                                            </div>

                                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                                <label for="">CCV:</label>
                                                                <input type="text" class="form-control" name="ccv"
                                                                       id="ccv" placeholder="CCV"
                                                                       data-parsley-required="true"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix">
                                                <div class="col-md-12">
                                                    <div class="row clearfix">
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <label for="">Expiry Month:</label>
                                                            <select class="form-control" name="exp_month"
                                                                    data-parsley-required="true">
                                                                @foreach (range(1, 12) as $key => $month)
                                                                    <option value="{{ $month }}">{{ $month }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <label for="">Expiry Year:</label>
                                                            <select class="form-control" name="exp_year"
                                                                    data-parsley-required="true">
                                                                @foreach (range(date('Y'), intval(date('Y') + 20)) as $key => $year)
                                                                    <option value="{{ $year }}">{{ $year }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <br class="clearfix"/> <br/><br/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <br class="clearfix"/>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>Item</th>
                                                        <th>Price</th>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>Dynamically Updated</td>
                                                        <td>$0.00</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>

                                    <br class="clearfix"/>
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary btn-block"> Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>


            </div>
        </div>

        <!-- controls -->
        <div class="ld_inline_controls">
            <ul class="ld_option_menu">
                <!--<li class="ld_controls_editor"><i class="fa fa-code" aria-hidden="true"></i></li>-->
                <li class="ld_controls_move"><i class="fa fa-arrows" aria-hidden="true"></i></li>
                <li class="ld_controls_clone"><i class="fa fa-files-o" aria-hidden="true"></i></li>
                <li class="ld_controls_edit open-setings-modal" data-toggle="modal" data-target="#elementSettingsModal">
                    <i class="fa fa-cog" aria-hidden="true"></i></li>
                <li class="ld_controls_close"><i class="fa fa-times" aria-hidden="true"></i></li>
            </ul>
        </div>

        <button type="button" class="addElementFlyoutDOM replace-element" data-section-id="element-order"
                alt="Add elements" data-toggle="modal" data-target="#elementModal"><i class="fa fa-plus"></i></button>
    </div>