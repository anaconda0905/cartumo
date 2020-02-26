<div class="ld-element order-two-step-wrapper ld-editable inline-element" id="{{ $id }}" data-de-type="order-two-step">
    <div class="element-order-two-step ld-margin0 element-text-shadow">
        <div class="wrapper">

            <form action="" method="post" class="validate-form">
                <div class="two-step-form">
                    <div class="header" style="background-color:#2a3f54;color:#ffffff;">
                        <h3>Get Your FREE Graffiti Delivered In Less Than 7 Days</h3>
                    </div>
                    <div class="step-header">
                        <ul>
                            <li class="active"><strong style="font-size: 16px;">SHIPPING</strong>
                                <p style="color:#000000;font-size:14px;">Where To Ship Book</p></li>
                            <li><strong style="font-size: 16px;">BILLING INFO</strong>
                                <p style="color:#000000;font-size:14px;">Your Billing Info</p></li>
                        </ul>
                    </div>

                    <div class="step-body">
                        <div class="step-section">
                            <!--<div class="form-group">
                                <input type="text" class="form-control" id="full_name" name="full_name"
                                    placeholder="Full Name" data-parsley-required="true"/>
                            </div>-->
                            <div class="form-group">
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <!--<label for="">First Name</label>-->
                                        <input type="text" name="first_name" class="form-control"
                                               placeholder="First name" required/>
                                    </div>

                                    <div class="col-md-6">
                                        <!--<label for="">Last Name</label>-->
                                        <input type="text" name="last_name" class="form-control" placeholder="Last name"
                                               required/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" id="email" name="email"
                                       placeholder="Email Address" data-parsley-required="true"/>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="phone" name="phone"
                                       placeholder="Phone Number" data-parsley-required="true"/>
                            </div>

                            <input type="hidden" name="selection" class="panel-selection-radio" value="same" checked/>
                            <p class="bar-info">Shipping</p>

                            <div class="form-group">
                                <input type="text" class="form-control" id="funn_name" name="full_address"
                                       placeholder="Full address" data-parsley-required="true"/>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="funn_name" name="city"
                                       placeholder="City name" data-parsley-required="true"/>
                            </div>
                            <div class="form-group">
                                <div class="row clearfix">
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type="text" class="form-control" name="state" id="state"
                                               placeholder="State" data-parsley-required="true"/>
                                    </div>

                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <input type="text" class="form-control" name="zip" id="zip_code"
                                               placeholder="Zip code" data-parsley-required="true"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <select name="country" class="form-control" data-parsley-required="true">
                                    <option>Select country</option>
                                    <option value="">Select Country</option>
                                    <option value="">------------------------------</option>
                                    <option value="United States">United States</option>
                                    <option value="Canada">Canada</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="Ireland">Ireland</option>
                                    <option value="Australia">Australia</option>
                                    <option value="New Zealand">New Zealand</option>
                                    <option value="">------------------------------</option>
                                    <option value="Afghanistan">Afghanistan</option>
                                    <option value="Albania">Albania</option>
                                    <option value="Algeria">Algeria</option>
                                    <option value="American Samoa">American Samoa</option>
                                    <option value="Andorra">Andorra</option>
                                    <option value="Angola">Angola</option>
                                    <option value="Anguilla">Anguilla</option>
                                    <option value="Antarctica">Antarctica</option>
                                    <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                    <option value="Argentina">Argentina</option>
                                    <option value="Armenia">Armenia</option>
                                    <option value="Aruba">Aruba</option>
                                    <option value="Australia">Australia</option>
                                    <option value="Austria">Austria</option>
                                    <option value="Azerbaijan">Azerbaijan</option>
                                    <option value="Bahamas">Bahamas</option>
                                    <option value="Bahrain">Bahrain</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="Barbados">Barbados</option>
                                    <option value="Belarus">Belarus</option>
                                    <option value="Belgium">Belgium</option>
                                    <option value="Belize">Belize</option>
                                    <option value="Benin">Benin</option>
                                    <option value="Bermuda">Bermuda</option>
                                    <option value="Bhutan">Bhutan</option>
                                    <option value="Bolivia">Bolivia</option>
                                    <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                    <option value="Botswana">Botswana</option>
                                    <option value="Bouvet Island">Bouvet Island</option>
                                    <option value="Brazil">Brazil</option>
                                    <option value="British Indian Ocean Territory">British Indian Ocean Territory
                                    </option>
                                    <option value="Brunei Darussalam">Brunei Darussalam</option>
                                    <option value="Bulgaria">Bulgaria</option>
                                    <option value="Burkina Faso">Burkina Faso</option>
                                    <option value="Burundi">Burundi</option>
                                    <option value="Cambodia">Cambodia</option>
                                    <option value="Cameroon">Cameroon</option>
                                    <option value="Canada">Canada</option>
                                    <option value="Cape Verde">Cape Verde</option>
                                    <option value="Cayman Islands">Cayman Islands</option>
                                    <option value="Central African Republic">Central African Republic</option>
                                    <option value="Chad">Chad</option>
                                    <option value="Chile">Chile</option>
                                    <option value="China">China</option>
                                    <option value="Christmas Island">Christmas Island</option>
                                    <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                    <option value="Colombia">Colombia</option>
                                    <option value="Comoros">Comoros</option>
                                    <option value="Congo">Congo</option>
                                    <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic
                                        of The
                                    </option>
                                    <option value="Cook Islands">Cook Islands</option>
                                    <option value="Costa Rica">Costa Rica</option>
                                    <option value="Cote D'ivoire">Cote D'ivoire</option>
                                    <option value="Croatia">Croatia</option>
                                    <option value="Cuba">Cuba</option>
                                    <option value="Cyprus">Cyprus</option>
                                    <option value="Czech Republic">Czech Republic</option>
                                    <option value="Denmark">Denmark</option>
                                    <option value="Djibouti">Djibouti</option>
                                    <option value="Dominica">Dominica</option>
                                    <option value="Dominican Republic">Dominican Republic</option>
                                    <option value="Ecuador">Ecuador</option>
                                    <option value="Egypt">Egypt</option>
                                    <option value="El Salvador">El Salvador</option>
                                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                                    <option value="Eritrea">Eritrea</option>
                                    <option value="Estonia">Estonia</option>
                                    <option value="Ethiopia">Ethiopia</option>
                                    <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                    <option value="Faroe Islands">Faroe Islands</option>
                                    <option value="Fiji">Fiji</option>
                                    <option value="Finland">Finland</option>
                                    <option value="France">France</option>
                                    <option value="French Guiana">French Guiana</option>
                                    <option value="French Polynesia">French Polynesia</option>
                                    <option value="French Southern Territories">French Southern Territories</option>
                                    <option value="Gabon">Gabon</option>
                                    <option value="Gambia">Gambia</option>
                                    <option value="Georgia">Georgia</option>
                                    <option value="Germany">Germany</option>
                                    <option value="Ghana">Ghana</option>
                                    <option value="Gibraltar">Gibraltar</option>
                                    <option value="Greece">Greece</option>
                                    <option value="Greenland">Greenland</option>
                                    <option value="Grenada">Grenada</option>
                                    <option value="Guadeloupe">Guadeloupe</option>
                                    <option value="Guam">Guam</option>
                                    <option value="Guatemala">Guatemala</option>
                                    <option value="Guinea">Guinea</option>
                                    <option value="Guinea-bissau">Guinea-bissau</option>
                                    <option value="Guyana">Guyana</option>
                                    <option value="Haiti">Haiti</option>
                                    <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald
                                        Islands
                                    </option>
                                    <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                    <option value="Honduras">Honduras</option>
                                    <option value="Hong Kong">Hong Kong</option>
                                    <option value="Hungary">Hungary</option>
                                    <option value="Iceland">Iceland</option>
                                    <option value="India">India</option>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                    <option value="Iraq">Iraq</option>
                                    <option value="Ireland">Ireland</option>
                                    <option value="Israel">Israel</option>
                                    <option value="Italy">Italy</option>
                                    <option value="Jamaica">Jamaica</option>
                                    <option value="Japan">Japan</option>
                                    <option value="Jordan">Jordan</option>
                                    <option value="Kazakhstan">Kazakhstan</option>
                                    <option value="Kenya">Kenya</option>
                                    <option value="Kiribati">Kiribati</option>
                                    <option value="Korea, Democratic People's Republic of">Korea, Democratic People's
                                        Republic of
                                    </option>
                                    <option value="Korea, Republic of">Korea, Republic of</option>
                                    <option value="Kuwait">Kuwait</option>
                                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                                    <option value="Lao People's Democratic Republic">Lao People's Democratic Republic
                                    </option>
                                    <option value="Latvia">Latvia</option>
                                    <option value="Lebanon">Lebanon</option>
                                    <option value="Lesotho">Lesotho</option>
                                    <option value="Liberia">Liberia</option>
                                    <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                    <option value="Liechtenstein">Liechtenstein</option>
                                    <option value="Lithuania">Lithuania</option>
                                    <option value="Luxembourg">Luxembourg</option>
                                    <option value="Macao">Macao</option>
                                    <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former
                                        Yugoslav Republic of
                                    </option>
                                    <option value="Madagascar">Madagascar</option>
                                    <option value="Malawi">Malawi</option>
                                    <option value="Malaysia">Malaysia</option>
                                    <option value="Maldives">Maldives</option>
                                    <option value="Mali">Mali</option>
                                    <option value="Malta">Malta</option>
                                    <option value="Marshall Islands">Marshall Islands</option>
                                    <option value="Martinique">Martinique</option>
                                    <option value="Mauritania">Mauritania</option>
                                    <option value="Mauritius">Mauritius</option>
                                    <option value="Mayotte">Mayotte</option>
                                    <option value="Mexico">Mexico</option>
                                    <option value="Micronesia, Federated States of">Micronesia, Federated States of
                                    </option>
                                    <option value="Moldova, Republic of">Moldova, Republic of</option>
                                    <option value="Monaco">Monaco</option>
                                    <option value="Mongolia">Mongolia</option>
                                    <option value="Montserrat">Montserrat</option>
                                    <option value="Morocco">Morocco</option>
                                    <option value="Mozambique">Mozambique</option>
                                    <option value="Myanmar">Myanmar</option>
                                    <option value="Namibia">Namibia</option>
                                    <option value="Nauru">Nauru</option>
                                    <option value="Nepal">Nepal</option>
                                    <option value="Netherlands">Netherlands</option>
                                    <option value="Netherlands Antilles">Netherlands Antilles</option>
                                    <option value="New Caledonia">New Caledonia</option>
                                    <option value="New Zealand">New Zealand</option>
                                    <option value="Nicaragua">Nicaragua</option>
                                    <option value="Niger">Niger</option>
                                    <option value="Nigeria">Nigeria</option>
                                    <option value="Niue">Niue</option>
                                    <option value="Norfolk Island">Norfolk Island</option>
                                    <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                    <option value="Norway">Norway</option>
                                    <option value="Oman">Oman</option>
                                    <option value="Pakistan">Pakistan</option>
                                    <option value="Palau">Palau</option>
                                    <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied
                                    </option>
                                    <option value="Panama">Panama</option>
                                    <option value="Papua New Guinea">Papua New Guinea</option>
                                    <option value="Paraguay">Paraguay</option>
                                    <option value="Peru">Peru</option>
                                    <option value="Philippines">Philippines</option>
                                    <option value="Pitcairn">Pitcairn</option>
                                    <option value="Poland">Poland</option>
                                    <option value="Portugal">Portugal</option>
                                    <option value="Puerto Rico">Puerto Rico</option>
                                    <option value="Qatar">Qatar</option>
                                    <option value="Reunion">Reunion</option>
                                    <option value="Romania">Romania</option>
                                    <option value="Russian Federation">Russian Federation</option>
                                    <option value="Rwanda">Rwanda</option>
                                    <option value="Saint Helena">Saint Helena</option>
                                    <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                    <option value="Saint Lucia">Saint Lucia</option>
                                    <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                    <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines
                                    </option>
                                    <option value="Samoa">Samoa</option>
                                    <option value="San Marino">San Marino</option>
                                    <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                    <option value="Saudi Arabia">Saudi Arabia</option>
                                    <option value="Senegal">Senegal</option>
                                    <option value="Serbia and Montenegro">Serbia and Montenegro</option>
                                    <option value="Seychelles">Seychelles</option>
                                    <option value="Sierra Leone">Sierra Leone</option>
                                    <option value="Singapore">Singapore</option>
                                    <option value="Slovakia">Slovakia</option>
                                    <option value="Slovenia">Slovenia</option>
                                    <option value="Solomon Islands">Solomon Islands</option>
                                    <option value="Somalia">Somalia</option>
                                    <option value="South Africa">South Africa</option>
                                    <option value="South Georgia and The South Sandwich Islands">South Georgia and The
                                        South Sandwich Islands
                                    </option>
                                    <option value="Spain">Spain</option>
                                    <option value="Sri Lanka">Sri Lanka</option>
                                    <option value="Sudan">Sudan</option>
                                    <option value="Suriname">Suriname</option>
                                    <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                    <option value="Swaziland">Swaziland</option>
                                    <option value="Sweden">Sweden</option>
                                    <option value="Switzerland">Switzerland</option>
                                    <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                    <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                                    <option value="Tajikistan">Tajikistan</option>
                                    <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                    <option value="Thailand">Thailand</option>
                                    <option value="Timor-leste">Timor-leste</option>
                                    <option value="Togo">Togo</option>
                                    <option value="Tokelau">Tokelau</option>
                                    <option value="Tonga">Tonga</option>
                                    <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                    <option value="Tunisia">Tunisia</option>
                                    <option value="Turkey">Turkey</option>
                                    <option value="Turkmenistan">Turkmenistan</option>
                                    <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                    <option value="Tuvalu">Tuvalu</option>
                                    <option value="Uganda">Uganda</option>
                                    <option value="Ukraine">Ukraine</option>
                                    <option value="United Arab Emirates">United Arab Emirates</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="United States">United States</option>
                                    <option value="United States Minor Outlying Islands">United States Minor Outlying
                                        Islands
                                    </option>
                                    <option value="Uruguay">Uruguay</option>
                                    <option value="Uzbekistan">Uzbekistan</option>
                                    <option value="Vanuatu">Vanuatu</option>
                                    <option value="Venezuela">Venezuela</option>
                                    <option value="Viet Nam">Viet Nam</option>
                                    <option value="Virgin Islands, British">Virgin Islands, British</option>
                                    <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                    <option value="Wallis and Futuna">Wallis and Futuna</option>
                                    <option value="Western Sahara">Western Sahara</option>
                                    <option value="Yemen">Yemen</option>
                                    <option value="Zambia">Zambia</option>
                                    <option value="Zimbabwe">Zimbabwe</option>
                                </select>
                            </div>

                        </div>

                        <div class="step-section">
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <button class="btn btn-none back-shipping">
                                        <i class="fa fa-arrow-left"></i>
                                        <span class="goBacktoStepOneOrderBumpSpan">Edit Shipping Details</span>
                                    </button>
                                </div>
                            </div>

                            <div class="row product-cart-wrapper clearfix" data-de-type="product-cart">
                                <div class="col-md-12 wrapper">
                                    @if ( !empty($data['stepProduct']) )

                                        @if ( $data['stepProduct']->product_type == 'manual' )
                                            <div class="summary">
                                                <div class="product-description clearfix rows">
                                                    <ul>
                                                        <li class="image">
															<?php $images = json_decode( $data['product']->images ) ?>
                                                            <img src="{{ $images->main }}"/>
                                                            <span class="cart_badge_counter">1</span>
                                                        </li>

                                                        <li class="description">
                                                            <span>{{ $data['product']->name }}</span>
                                                            <div class="product-varients"
                                                                 id="cart_product_varients"></div>
                                                        </li>

                                                        <li class="price" id="cart_product_price">
                                                            ${{ $data['product']->price }}
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="rows">
                                                    <ul>
                                                        <li>
                                                            <span>Subtotal</span>
                                                            <strong id="cart_product_subtotal">${{ $data['product']->price }}</strong>
                                                        </li>
                                                        <li>
                                                            <span>Shipping</span>
                                                            <strong id="cart_product_shipping">Free</strong>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="rows">
                                                    <ul>
                                                        <li>
                                                            <span>Total: </span>
                                                            <strong class="price"
                                                                    id="cart_product_total">${{ $data['product']->price }}</strong>
                                                            <input type="hidden" name="product_price" value=""/>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        @else
                                            <div class="summary">
                                                <div class="product-description clearfix rows">
                                                    <ul>
                                                        <li class="image">
                                                            <img src="{{ $data['product']->product->image->src }}"/>
                                                            <span class="cart_badge_counter">1</span>
                                                        </li>

                                                        <li class="description">
                                                            <span>{{ $data['product']->product->title }}</span>
                                                            <div class="product-varients"
                                                                 id="cart_product_varients"></div>
                                                        </li>

                                                        <li class="price" id="cart_product_price">
                                                            ${{-- $data['product']->price --}}
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="rows">
                                                    <ul>
                                                        <li>
                                                            <span>Subtotal</span>
                                                            <strong id="cart_product_subtotal">${{-- $data['product']->price --}}</strong>
                                                        </li>
                                                        <li>
                                                            <span>Shipping</span>
                                                            <strong id="cart_product_shipping">Free</strong>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="rows">
                                                    <ul>
                                                        <li>
                                                            <span>Total: </span>
                                                            <strong class="price"
                                                                    id="cart_product_total">${{-- $data['product']->price --}}</strong>
                                                            <input type="hidden" name="product_price" value=""/>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        @endif
                                    @else
                                        <div class="summary">
                                            <div class="product-description clearfix rows">
                                                <ul>
                                                    <li class="image">
                                                        <img src="{{ asset('frontend/images/empty_product.png') }}"/>
                                                        <span class="cart_badge_counter">1</span>
                                                    </li>

                                                    <li class="description">
                                                        <span>Product</span>
                                                        <div class="product-varients" id="cart_product_varients">product
                                                            variants
                                                        </div>
                                                    </li>

                                                    <li class="price" id="cart_product_price">
                                                        $0.00
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="rows">
                                                <ul>
                                                    <li>
                                                        <span>Subtotal</span>
                                                        <strong id="cart_product_subtotal">$0.00</strong>
                                                    </li>
                                                    <li>
                                                        <span>Shipping</span>
                                                        <strong id="cart_product_shipping">Free</strong>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="rows">
                                                <ul>
                                                    <li>
                                                        <span>Total: </span>
                                                        <strong class="price"
                                                                id="cart_product_total">$0.00</strong>
                                                        <input type="hidden" name="product_price" value=""/>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="bump-details">
                                <div class="row clearfix">
                                    <div class="col-md-12 order-bump-wrapper">
                                        @if ( !empty($data['product_id']) )
                                            <div class="order-for-bump border-dashed-black product-item product-bump-switch">
                                                <ul style="background-color:#ffff99">
                                                    <li><img src="{{ asset('images/arrow-flash-small.gif') }}"/></li>
                                                    <li><input type="checkbox" class="checkbox" name="bump[product_id]"
                                                               value="{{ $data['product_id'] }}" id="bump_product_offer"
                                                               data-product-type="{{ $data['product_type'] = $data['product_type'] }}"/>
                                                    </li>
                                                    <li style="font-size: 21px;color:#009900"><b>Yes, I will Take
                                                            It!</b></li>
                                                </ul>

                                                <div class="bump-details">
                                                    <span style="font-size: 15px;">One time offer</span>:
                                                    <span style="color:#2f2f2f;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut, quod hic expedita consectetur vitae nulla sint adipisci cupiditate at. Commodi, dolore hic eaque tempora a repudiandae obcaecati deleniti mollitia possimus.</span>
                                                </div>
                                            </div>
                                        @elseif ( !empty($data['bumpProduct']) )
                                            <div class="order-for-bump border-dashed-black product-item product-bump-switch">
                                                <ul style="background-color:#ffff99">
                                                    <li><img src="{{ asset('images/arrow-flash-small.gif') }}"/></li>
                                                    @if ( !empty($data['bumpProduct']) )
                                                        <li><input type="checkbox" class="checkbox"
                                                                   name="bump[product_id]"
                                                                   value="{{ $data['bumpProduct']->id }}"
                                                                   id="bump_product_offer"
                                                                   data-product-type="{{ $data['stepProduct']->product_type }}"/>
                                                        </li>
                                                    @else
                                                        <li><input type="checkbox" class="checkbox"
                                                                   name="bump[product_id]" value="11"
                                                                   id="bump_product_offer"
                                                                   data-product-type="{{ $data['product_type'] }}"/>
                                                        </li>
                                                    @endif
                                                    <li style="font-size: 21px;color:#009900"><b>Yes, I will Take
                                                            It!</b></li>
                                                </ul>

                                                <div class="bump-details">
                                                    <span style="font-size: 15px;">One time offer</span>:
                                                    <span style="color:#2f2f2f;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut, quod hic expedita consectetur vitae nulla sint adipisci cupiditate at. Commodi, dolore hic eaque tempora a repudiandae obcaecati deleniti mollitia possimus.</span>
                                                </div>
                                            </div>
                                        @else
                                            <div class="order-for-bump border-dashed-black product-item product-bump-switch">
                                                <ul style="background-color:#ffff99">
                                                    <li><img src="{{ asset('images/arrow-flash-small.gif') }}"/></li>
                                                    <li><input type="checkbox" class="checkbox" name="bump[product_id]"
                                                               value="" id="bump_product_offer"
                                                               data-product-type=""/></li>
                                                    <li style="font-size: 21px;color:#009900"><b>Yes, I will Take
                                                            It!</b></li>
                                                </ul>

                                                <div class="bump-details">
                                                    <span style="font-size: 15px;">One time offer</span>:
                                                    <span style="color:#2f2f2f;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut, quod hic expedita consectetur vitae nulla sint adipisci cupiditate at. Commodi, dolore hic eaque tempora a repudiandae obcaecati deleniti mollitia possimus.</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="credit-card-details">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="row clearfix">
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <label for="number">Credit Card Number:</label>
                                                    <input type="text" class="form-control" name="number" id="number"
                                                           placeholder="Card Number" data-parsley-required="true"/>
                                                </div>

                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                    <label for="cvc">CCV:</label>
                                                    <input type="text" class="form-control" name="cvc" id="cvc"
                                                           placeholder="CCV" data-parsley-required="true"/>
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
                                                <select class="form-control" name="exp-month"
                                                        data-parsley-required="true">
                                                    @foreach ($data['months'] as $key => $month)
                                                        <option value="{{ $month }}">{{ $month }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <label for="">Expiry Year:</label>
                                                <select class="form-control" name="exp-year"
                                                        data-parsley-required="true">
                                                    @foreach ($data['years'] as $key => $year)
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
                        </div>
                    </div>


                    <div class="form-navigation clearfix">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-primary btn-block btn-lg btn-next-step">Go To Step #2
                            </button>
                            <button type="submit" class="btn btn-primary btn-block btn-lg complete-order">Complete
                                Order
                            </button>
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
            <li class="ld_controls_edit open-order-two-step-settings" data-toggle="modal"
                data-target="#orderTwoStepSettings">
                <i class="fa fa-cog" aria-hidden="true"></i></li>
            <li class="ld_controls_close"><i class="fa fa-times" aria-hidden="true"></i></li>
        </ul>
    </div>

    <button type="button" class="addElementFlyoutDOM replace-element" data-section-id="element-order"
            alt="Add elements" data-toggle="modal" data-target="#elementModal"><i class="fa fa-plus"></i></button>
</div>