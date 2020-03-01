@extends('layouts.app')

@section("title", "Product Bump")

@section('styles')
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.7/summernote.css"/>
    <style>
        #sortable {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        #sortable li {
            margin-bottom: 0;
            padding: 0em;
            padding-left: 0em;
            font-size: 0em;
            height: auto;
        }

        #sortable li span {
            position: absolute;
            margin-left: -1.3em;
        }
    </style>

@endsection

@section('content')


    <div class="area-container">
        <!-- page content -->
        <div class="right_col" role="main">
            <div class="funnel-page-inner-header">

                <div class="rows clearfix">
                    <div class="col-md-4">
                        <div class="title_left">
                            <ul>
                                <li>
                                    @if ( $funnel->type == 'manual' )
                                        <a href="{{ route('funnels.show', $funnel->id) }}"><img
                                                    src="{{ asset('frontend/images/manual-product.png') }}"/></a>
                                    @else
                                        <a href="{{ route('funnels.show', $funnel->id) }}"><img
                                                    src="{{ asset('frontend/images/shopify-product.png') }}"/></a>
                                    @endif
                                </li>
                                <li><a href="{{ route('funnels.show', $funnel->id) }}"><h3>{{ $funnel->name }}</h3></a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-8 text-right">
                        @include('funnels.partials.funnel-menu')
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="row">

                    <div class="col-md-4 step-body-left">
                        <div class="x_panel funnel-steps-block step-body-right">
                            <!--<h2><i class="fa fa-bars" aria-hidden="true"></i> Funnel Steps</h2>-->
                            <ul class="funnel-steps-items funnel-steps-items-main">
                                <li><i class="fa fa-bars" aria-hidden="true"></i></li>
                                <li class="funnel-steps-caption">FUNNEL STEPS</li>
                            </ul>

                            <ul id="sortable" class="steps">
                                @foreach ($steps as $key => $step)

                                    <li class="ui-state-default" data-sort-position="{{ $step->order_position }}"
                                        data-step-id="{{ $step->id }}">
                                        <a data-funnel-id="{{ $funnel->id }}" data-step-id="{{ $step->id }}"
                                           href="{{ route('steps.show', array($funnel->id, $step->id)) }}">
                                            <ul class="step-details funnel-steps-items">
                                                <li><?php echo App\Models\FunnelType::getIcon( $step->type ) ?></li>
                                                <li>{{ $step->display_name }}
                                                    <small class="step-footer">{{ App\Models\FunnelType::getTypeName($step->type) }}</small>
                                                </li>
                                                <li><i class="fa fa-times" aria-hidden="true"></i></li>
                                            </ul>
                                        </a>
                                    </li>
                                @endforeach

                                <li class="button-area" style="padding-top: 15px;">
                                    <button class="btn special-button-primary btn-block" data-toggle="modal"
                                            data-target="#addFunnelModal"><i class="fa fa-plus" aria-hidden="true"></i>
                                        Add
                                        New Step
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-8 col-sm-12 col-xs-12 funnel-step-area">


                        <div class="x_panel">
                            @include('funnels.partials.funnel-option-menu')
                            <div class="x_content funnel-templates">
                                {{-- $steps[0]->templates --}}


                                @if ( $hasBump )

                                    @foreach ( $stepProducts as $stepProduct )

                                        @include('funnels.products.partials.list-item')

                                    @endforeach

                                @else
                                    <h2>Add a New Product to Funnel Step</h2>
                                    <p>Looks like you haven't added any products for this funnel step yet. Begin by
                                        selecting
                                        'Add a Product' below and set the price of your product inside of the settings
                                        popup.
                                        You can add as many products as you need for this funnel step.</p>
                                    <div class="col-md-12 text-right">
                                        <span><button type="button" id="button_bump_product_manual"
                                                      class="btn special-button-warning btn-lg"
                                                      data-toggle="modal"
                                                      data-target="#bumpProductModal">
                                                        <i class="fa fa-plus" aria-hidden="true"></i> Add Bump Product</button>
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->
    </div>
    </div>

    <!-- Bump product -->
    @if ( !$hasBump )
        <div id="bumpProductModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <form id="frm_bump_product_settings" class="form-horizontal">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close"
                                    data-dismiss="modal">&times;
                            </button>
                            <h4 class="modal-title">Choose Bump Product</h4>
                        </div>
                        <div class="modal-body" id="paragraph_settings_body">

                            <div class="form-group">
                                <input type="search" id="search_product" name="search_product" placeholder="Enter a product name to search" class="form-control">
                            </div>

                            <div id="bump_product_list">

                            </div>

                        </div>

                        <div class="modal-footer">
                            <!--<button type="submit" class="btn btn-success"
                                    id="update_bump_product_settings"> Save Product
                            </button>-->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
@endsection


@section('scripts')
    <script>
        $(document).ready(function() {

            // search product
            $(document).on("keyup keychange", "#search_product", function(e) {

                $.ajax({
                    type: 'POST',
                    url: "{{ route('funnel.step.product.search', array($funnel->id, $currentStep->id)) }}",
                    data: "_token={{ csrf_token() }}&type={{ $funnel->type }}&keyword=" + $(this).val(),
                    success: function (response) {
                        console.log(response);
                        $("#bump_product_list").html(response);
                    },
                    error: function (a, b) {
                        console.log(a.responseText);
                    }
                });
            });

            $("#button_bump_product_manual").click(function (e) {

                $.ajax({
                    type: 'GET',
                    url: "{{ route('bump.product.list', array($currentStep->id)) }}",
                    data: "_token={{ csrf_token() }}&type={{ $funnel->type }}",
                    success: function (response) {
                        // window.alert("ok");
                        // console.log(response);
                        $("#bump_product_list").html(response);
                    },
                    error: function (a, b) {
                        console.log(a.responseText);
                    }
                });
            });

            // create/update bump product
            $(document).on("click", ".bump-choose-product", function (e) {

                e.preventDefault();

                const button = $(this);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{ route('product.store', [$funnel->id, $currentStep->id]) }}",
                    data: $("#frm_bump_product_settings").serialize() + '&product_id=' + $(button).attr('data-product-id') + '&type=bump&chk_bump_product=true'+ '&product_type=' + $(button).attr('data-product-type'),
                    beforeSend: function () {

                        tmp = $(button).html();
                        $(button).html('<i class="fa fa-circle-o-notch fa-spin"></i><span class="sr-only">Loading...</span>');
                        //$("body").append("<iframe src='' id='iframe_updater' style='display: block'></iframe>");
                    },
                    success: function (response) {
                        //alert(response);
                        console.log(response);

                        var json = JSON.parse(response);

                        if (json.status == 'success') {
                            // location.href = json.url;
                            location.href = location.href;

                        } else {
                            alert(json.message);
                        }

                    },
                    error: function (a, b) {
                        console.log(a.responseText);
                    }
                });
            });
        });
    </script>
@endsection
