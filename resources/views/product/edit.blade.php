@extends('layouts.app')

@section("title", "Edit Product")

@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.css" rel="stylesheet"/>
    <style>
        #product_varients_container td > span {
            height: 38px;
            border: 2px solid #ffffff;
            display: block;
        }
        .product-details-body {
            font-family: Arial;
        }
    </style>
@endsection

@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                        <h3>Update Product Details</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row product-details-body">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Update Product details</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content product-add">


                            {!! Form::model($product, array('route' => ['products.update', $product->id], 'method' => 'PUT', 'data-parsley-required' => '', 'id' => 'product_manual_update')) !!}
                            <fieldset class="clearfix row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        {{ Form::label('name', 'Product Name:') }}
                                        {{ Form::text('name', null, array('class' => 'form-control', 'required' => '', 'autofocus' => '')) }}
                                    </div>

                                    <div class="form-group">
                                        {{ Form::label('description', 'Description:') }}
                                        {{ Form::textarea('description', null, array('class' => 'form-control html-editor', 'required' => '')) }}
                                    </div>

                                    <div class="form-group">
                                        {{ Form::label('sku', 'Product SKU:') }}
                                        {{ Form::text('sku', null, array('class' => 'form-control', 'required' => '')) }}
                                    </div>

                                    <div class="form-group row clearfix">
                                        <div class="col-md-6">
                                            {{ Form::label('quantity', 'Product Quantity:') }}
                                            {{ Form::text('quantity', null, array('class' => 'form-control', 'required' => '')) }}
                                        </div>

                                        <div class="col-md-6">
                                            {{ Form::label('price', 'Product Price:') }}
                                            {{ Form::text('price', null, array('class' => 'form-control', 'required' => '', 'placeholder'=>'0.00', 'data-parsley-pattern'=>"^[0-9]*\.[0-9]{2}$")) }}
                                        </div>
                                    </div>

                                    <hr/>

                                    <h2>Variants</h2>
                                    <div class="varients-container" id="product_varients_container">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th style="width:2%"></th>
                                                <th style="width:8%">Image</th>
                                                <th style="width:30%">Variant</th>
                                                <th style="width:12%" class="text-right">Price</th>
                                                <th style="width:15%">SKU</th>
                                                <th style="width:13%" class="text-right">Inventory</th>
                                                <th class="text-right" style="width:15%"></th>
                                            </tr>
                                            </thead>

                                            <tbody>


											<?php //$variants = json_decode($options->options, TRUE); ?>

                                            @if ( !empty($variants) )
                                            @foreach( $variants as $key=>$variant )

											<?php $varient_options = json_decode( $variant->options, TRUE ); ?>

                                            <tr>
                                                <td><input type='checkbox' name='options[]'/></td>
                                                <td>
                                                    <img src="{{ (!empty($variant->image)) ? $variant->image : asset('images/no-images.png') }}"
                                                         style="width: 42px; height: 42px;"
                                                         class='varient-image'/>
                                                    <input type='hidden' name='varient_image[]'
                                                           data-image-file='' value="{{ $variant->image }}"/>
                                                </td>
                                                <td>
													<?php $options = ""; ?>
                                                    @foreach ( $varient_options as $key=>$val )
                                                        @if ( $key == 'price' )
                                                            <input type='hidden' name='variants[]' value="{{ trim($options, ',') }}"/>
															<?php break; ?>
                                                        @else
                                                            <span><?php echo $val ?></span>
															<?php $options .= $val . ','; ?>
                                                        <!--<input type='hidden' name='variants[]' value="{{ $val }}"/>-->
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td class="text-right">
                                                    @foreach ( $varient_options as $key=>$val )
                                                        @if ( $key == 'price' )
                                                            <span><?php echo $val ?></span>
                                                            <input type="hidden" class="form-control"
                                                                   name="option_price[]" value="{{ $val }}">
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach ( $varient_options as $key=>$val )
                                                        @if ( $key == 'sku' )
                                                            <span><?php echo $val ?></span>
                                                            <input type="hidden" class="form-control"
                                                                   name="option_sku[]" value="{{ $val }}">
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td class="text-right">
                                                    @foreach ( $varient_options as $key=>$val )
                                                        @if ( $key == 'inventory' )
                                                            <span><?php echo $val ?></span>
                                                            <input type="hidden" class="form-control"
                                                                   name="option_inventory[]" value="{{ $val }}">
                                                        @endif
                                                    @endforeach
                                                </td>

                                                <td class="text-right">
                                                    <button type="button" class="btn btn-success varient-option-edit"
                                                            data-url="{{ route('product.varient.details.remove', [$variant->product_id, $variant->id]) }}"
                                                            data-edit-status="1">
                                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger varient-option-remove"
                                                            data-url="{{ route('product.varient.details.remove', [$variant->product_id, $variant->id]) }}">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif

                                            </tbody>
                                        </table>


                                    </div>
                                    <button type="button" class="btn btn-default" data-toggle="modal"
                                            data-target="#productOptionAddModal">Add option
                                    </button>
                                </div>

                                <div class="col-md-4">
									<?php $images = json_decode( $product->images ) ?>
                                    <div class="image">
                                        <div class="main-image">
                                            @if ( empty($images->main) )
                                                <img src="{{ asset('images/no-images.png') }}"/>
                                            @else
                                                <img src="{{ $images->main }}"/>
                                                <input type='hidden' name='image' value="{{ $images->main }}"/>
                                            @endif

                                        </div>

                                        <div class="addition-images">
                                            <ul>
                                                @if ( empty($images->additionals) )
                                                    <li><img src="{{ asset('images/no-images.png') }}"/></li>
                                                    <li><img src="{{ asset('images/no-images.png') }}"/></li>
                                                    <li><img src="{{ asset('images/no-images.png') }}"/></li>
                                                    <li><img src="{{ asset('images/no-images.png') }}"/></li>
                                                    <li><img src="{{ asset('images/no-images.png') }}"/></li>
                                                @else
                                                    @foreach ($images->additionals as $key => $image)
                                                        <li><img src="{{ $image }}"/></li>
                                                        <input type='hidden' name='additionsals[]'
                                                               value="{{ $image }}"/>
                                                    @endforeach


                                                    @for ($i=$key+1; $i<5; $i++)
                                                        <li><img src="{{ asset('images/no-images.png') }}"/></li>
                                                    @endfor
                                                @endif
                                            </ul>
                                        </div>

                                        <p style="text-align: center;margin: 30px;color: #46b39c; font-size:15px;">Click
                                            the <span><i class="fa fa-camera" aria-hidden="true"></i></span> icon to
                                            upload an image</p>
                                    </div>
                                </div>


                                <div class="clearfix"></div>
                                <hr/>

                                <div id="productOptionAddModal" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close"
                                                        data-dismiss="modal">&times;
                                                </button>
                                                <h4 class="modal-title">Add New Varient</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form id="frm_product_varients_add" action="" method="post">
                                                    <div class="option-varient-container">


                                                        @if ( !empty($options->options) )
															<?php $options = json_decode( $options->options, TRUE ); ?>
                                                            @if ( !empty($options['options']) )
                                                                @foreach( $options['options']['option_name'] as $key=>$option_name )
                                                                    <div class="row clearfix">
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label for="style">Option Name</label>
                                                                                <input type="text" class="form-control"
                                                                                       name="option_name[]"
                                                                                       placeholder="Option Name"
                                                                                       value="{{ $option_name }}"/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <div class="form-group">
                                                                                <label for="style">Option Value</label>
                                                                                <textarea name="option_value[]" rows="2"
                                                                                          class="form-control"
                                                                                          placeholder="Separate options with comma">{{ $options['options']['option_value'][$key] }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        @endif

                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary"
                                                        id="modal_add_varient_option">
                                                    Add New
                                                </button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal"
                                                        id="modal_save_varients">Save
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <!-- Change this to a button or input when using this as a form -->
                                {{-- Form::submit('Update Product', array('class' => 'btn btn-primary btn-lg pull-right buttion-product-action')) --}}
                                <button type="submit" class="btn btn-primary btn-lg pull-right buttion-product-action">Update Product</button>
                            </fieldset>


                            {!! Form::close() !!}

                            <form id="frm_product_image_upload" action="{{ route('products.imgeupload') }}"
                                  method="POST">
                                <input type="file" name="image" id="file_product_add_image" style="display: none;"/>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                            </form>

                            <form id="product_variants_image_upload" action="{{ route('products.varient.imgeupload') }}"
                                  method="POST">
                                <input type="file" name="varient_image" id="varient_image_file" style="display: none"/>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->

@endsection



@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.js"></script>
    <script>
        $('.html-editor').summernote();

        $(document).ready(function (e) {

            $(".varient-option-remove").click(function (e) {

                e.preventDefault();

                var button = $(this);
                var row = $(this).parent().parent();

                if (confirm("Are you sure to delete the variant?")) {

                    $.ajax({
                        type: "POST",
                        url: $(button).attr('data-url'),
                        data: "_token={{ csrf_token() }}",
                        beforeSend: function () {
                            $(button).html('<i class="fa fa-circle-o-notch fa-spin"></i>');
                            $(row).css('opacity', '0.50');
                        },
                        success: function (response) {
                            console.log(response);

                            var json = JSON.parse(response);

                            if (json.status == "success") {
                                $(row).remove();
                                alert(json.message);
                            } else {
                                alert(json.message);
                            }
                        },
                        error: function (a, b) {
                            console.log(a.responseText);
                        }
                    });
                }
            });


            //edit variants
            $(".varient-option-edit").click(function (e) {

                e.preventDefault();

                var parent = $(this).parent().parent();
                var row_index = $(this).parent().parent().index();

                if ($(this).attr('data-edit-status') == 1) {
                    //$(parent).find("td:nth-child(3) > span").remove();
                    $(parent).find("td:nth-child(4) > span").remove();
                    $(parent).find("td:nth-child(5) > span").remove();
                    $(parent).find("td:nth-child(6) > span").remove();

                    //$(parent).find("td:nth-child(3) input").attr('type', 'text').attr('class', 'form-control');
                    $(parent).find("td:nth-child(4) input").attr('type', 'number').attr('class', 'form-control');
                    $(parent).find("td:nth-child(5) input").attr('type', 'text').attr('class', 'form-control');
                    $(parent).find("td:nth-child(6) input").attr('type', 'number').attr('class', 'form-control');

                    $(this).html('<i class="fa fa-check" aria-hidden="true"></i>');

                    $(this).attr('data-edit-status', 0);
                } else {
                    //$(parent).find("td:nth-child(3)").prepend("<span>" + $(parent).find("td:nth-child(3) input").val() + "</span>");
                    $(parent).find("td:nth-child(4)").prepend("<span>" + $(parent).find("td:nth-child(4) input").val() + "</span>");
                    $(parent).find("td:nth-child(5)").prepend("<span>" + $(parent).find("td:nth-child(5) input").val() + "</span>");
                    $(parent).find("td:nth-child(6)").prepend("<span>" + $(parent).find("td:nth-child(6) input").val() + "</span>");

                    //$(parent).find("td:nth-child(3) input").attr('type', 'hidden').attr('class', 'form-control');
                    $(parent).find("td:nth-child(4) input").attr('type', 'hidden').attr('class', 'form-control');
                    $(parent).find("td:nth-child(5) input").attr('type', 'hidden').attr('class', 'form-control');
                    $(parent).find("td:nth-child(6) input").attr('type', 'hidden').attr('class', 'form-control');

                    $(this).html('<i class="fa fa-pencil" aria-hidden="true"></i>');


                    $(this).attr('data-edit-status', 1);
                }
            });
        });
    </script>
@endsection
