<?php $emailSettings = json_decode($data['stepProduct']->details, TRUE) ?>

<form id="frm_product_update" class="form-horizontal">
    <div class="" role="tabpanel" data-example-id="togglable-tabs">
        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">

            <li role="presentation" class="active">
                <a href="#update_shipping_tab_settings" role="tab"
                   id="profile-tab" data-toggle="tab"
                   aria-expanded="false"><i class="fa fa-plug"
                                            aria-hidden="true"></i>&nbsp; Shipping
                </a>
            </li>
            <li role="presentation">
                <a href="#update_fullfillment_emai_tab_settings"
                   id="home-tab" role="tab" data-toggle="tab"
                   aria-expanded="true">
                    <i class="fa fa-envelope" aria-hidden="true"></i>&nbsp; Fulfillment Email
                </a>
            </li>
            <li role="presentation" class="">
                <a href="#update_email_integration_tab_settings"
                   role="tab"
                   id="profile-tab" data-toggle="tab"
                   aria-expanded="false"><i class="fa fa-plug"
                                            aria-hidden="true"></i>&nbsp; Email Integration
                </a>
            </li>
        </ul>
        <div id="myTabContentUpdate" class="tab-content">
            <div role="tabpanel" class="tab-pane fade active in"
                 id="update_shipping_tab_settings"
                 aria-labelledby="home-tab">

            </div>

            <div role="tabpanel" class="tab-pane fade"
                 id="update_fullfillment_emai_tab_settings"
                 aria-labelledby="home-tab">

                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" class="form-control"
                           name="email_subject"
                           id="email_subject"
                           value="{{ (!empty($emailSettings)) ? $emailSettings['fulfillment']['subject'] : 'Thank you for your purchase' }}"/>
                </div>

                <div class="form-group">
                    <label for="html_body">HTML Body</label>
                    <textarea class="form-control summernote"
                              name="html_body"
                              id="html_body">{{ (!empty($emailSettings)) ? $emailSettings['fulfillment']['body'] : 'Thank you for your purchase' }}</textarea>
                </div>

            </div>

            <div role="tabpanel" class="tab-pane fade"
                 id="update_email_integration_tab_settings"
                 aria-labelledby="home-tab">

                <h2>Email Integration Trigger</h2>

                <div class="form-group">
                    <label for="subject">Select The Integration
                        Method: </label>
                    <select class="form-control"
                            name="integration_method"
                            id="integration_method">
                        @if ( $data['userIntegrations']->count() > 0 )
                            <option value="">Select an Integration
                            </option>
                            @foreach( $data['userIntegrations'] as $userIntegration )
                                @if ( $data['userIntegration']->id == $userIntegration->id )
                                    <option value="{{ $userIntegration->id }}"
                                            data-integration-type="{{ $userIntegration->service_type }}"
                                            data-integration-id="{{ $userIntegration->id }}"
                                            selected>
                                        {{ $userIntegration->name }}
                                        ({{ $userIntegration->service_type }}
                                        )
                                    </option>
                                @else
                                    <option value="{{ $userIntegration->id }}"
                                            data-integration-type="{{ $userIntegration->service_type }}"
                                            data-integration-id="{{ $userIntegration->id }}">
                                        {{ $userIntegration->name }}
                                        ({{ $userIntegration->service_type }}
                                        )
                                    </option>
                                @endif
                            @endforeach
                        @else
                            <option value="">No Email Integrations
                            </option>
                        @endif
                    </select>
                </div>

                <div class="form-group">
                    <label for="subject">List To Add Lead:</label>
                    <select class="form-control" name="list_lead" id="list_lead">
                        @if ( empty($data['integrationLists']) || $data['integrationLists']->count() > 0 )
                            @foreach ( $data['integrationLists'] as $list )
                                <option value="{{ $list->id }}">{{ $list->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

            </div>
        </div>
    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
    <input type="hidden" name="product_type" value="{{ $data['stepProduct']->product_type }}"/>
</form>