@extends('layouts.app')

@section("title", "Products")

@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.css" rel="stylesheet"/>
    <style>
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
                    <h3>Add New Product</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row product-details-body">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Products</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content product-add">


                            {!! Form::open(array('route' => 'products.store', 'id' => 'frm_manual_product_add')) !!}
                            <fieldset class="clearfix row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        {{ Form::label('name', 'Product Name:') }}
                                        {{ Form::text('name', null, array('class' => 'form-control', 'required' => '', 'maxlength' => 255, 'autofocus' => '')) }}
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
                                            {{ Form::number('quantity', null, array('class' => 'form-control', 'required' => '')) }}
                                        </div>

                                        <div class="col-md-6">
                                            {{ Form::label('price', 'Product Price:') }}
                                            {{ Form::text('price', null, array('class' => 'form-control', 'placeholder'=>'0.00', 'required' => '', 'data-parsley-pattern'=>"^[0-9]*\.[0-9]{2}$")) }}
                                        </div>
                                    </div>

                                    <hr/>

                                    <h2>Variants</h2>
                                    <!--<div class="varients-container"></div>
                                    <button type="button" class="btn btn-default" id="add_product_varients">Add option</button>-->

                                    <div class="varients-container" id="product_varients_container">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th></th>
                                                <th>Image</th>
                                                <th>Variant</th>
                                                <th class="text-right">Price</th>
                                                <th>SKU</th>
                                                <th class="text-right">Inventory</th>
                                                <th class="text-right"></th>
                                            </tr>
                                            </thead>

                                            <tbody></tbody>
                                        </table>


                                    </div>

                                    <button type="button" class="btn btn-default" data-toggle="modal"
                                            data-target="#productOptionAddModal">Add option
                                    </button>

                                    <!-- Modal -->
                                    <div id="productOptionAddModal" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;
                                                    </button>
                                                    <h4 class="modal-title">Add New Variant</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="frm_product_varients_add" action="" method="post">
                                                        <div class="option-varient-container">

                                                            <div class="row clearfix">
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label for="style">Option Name</label>
                                                                        <input type="text" class="form-control"
                                                                               name="option_name[]"
                                                                               placeholder="Option Name"/>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="form-group">
                                                                        <label for="style">Option Value</label>
                                                                        <textarea name="option_value[]" rows="2"
                                                                                  class="form-control"
                                                                                  placeholder="Seperate options with comma"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary"
                                                            id="modal_add_varient_option">Add New
                                                    </button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal"
                                                            id="modal_save_varients">Save
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-4">
                                    <div class="image">
                                        <div class="main-image">
                                            <img src="{{ asset('images/no-images.png') }}"/>
                                        </div>

                                        <div class="addition-images">
                                            <ul>
                                                <li><img src="{{ asset('images/no-images.png') }}"/></li>
                                                <li><img src="{{ asset('images/no-images.png') }}"/></li>
                                                <li><img src="{{ asset('images/no-images.png') }}"/></li>
                                                <li><img src="{{ asset('images/no-images.png') }}"/></li>
                                                <li><img src="{{ asset('images/no-images.png') }}"/></li>
                                            </ul>
                                        </div>

                                        <p style="text-align: center;margin: 30px;color: #46b39c; font-size:15px;">Click
                                            the <span><i class="fa fa-camera" aria-hidden="true"></i></span> icon to
                                            upload an image</p>
                                    </div>
                                </div>


                                <div class="clearfix"></div>
                                <hr/>

                                <!-- Change this to a button or input when using this as a form -->
                                {{ Form::submit('Save Product', array('class' => 'btn btn-primary btn-lg pull-right buttion-product-action')) }}
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.0/parsley.min.js"></script>
    <script>
        $('.html-editor').summernote();
        $('#frm_manual_product_add').parsley();
    </script>
@endsection
