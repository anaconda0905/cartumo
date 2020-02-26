@extends('layouts.app')

@section("title", "Products")

@section('styles')
    <style>
        .products table {
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
                    <h3 class="dashboard-page-title"><i class="fa fa-cubes"></i> Products</h3>
                </div>

                <div class="title_right">
                    <!--<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                      <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                          <button class="btn btn-default" type="button">Go!</button>
                        </span>
                      </div>
                    </div>-->
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row products">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Products</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a href="{{ route('products.create') }}" class="btn special-button-primary"><i
                                                class="fa fa-plus" aria-hidden="true"></i> Add Manual Product</a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th style="width:5%">Product</th>
                                        <th></th>
                                        <th class="text-right">Quantity</th>
                                        <th class="text-right">Price</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @if ( !empty($products) )
                                        @foreach ($products as $key => $product)
                                            <tr>
                                                <td>{{ $product->id }}</td>
                                                <td>
													<?php $image = json_decode( $product->images ); ?>
                                                    @if ( !empty($image) )
                                                        @if ( !empty($image->main) )
                                                            <!--<img src="{{ $image->main }}"
                                                                 style="width: 64px; height: 64px;"/> <br/>-->
                                                            <img src="{{ asset('asset/Timthumb.php?src=') . $image->main . '&w=88&h=88' }}"> <br>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td><strong>{{ $product->name }}</strong></td>
                                                <td class="text-right">{{ $product->quantity }}</td>
                                                <td class="text-right"><b
                                                            style="color: #1ABB9C">${{ $product->price }}</b></td>
                                                <td class="text-right">
                                                    <a href="{{ route('products.edit', $product->id) }}"
                                                       class="btn btn-warning">
                                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                                    </a>

                                                    <button class="btn btn-danger product-manual-remove"
                                                            data-product-id="{{ $product->id }}">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>

                                <div class="row text-center">
                                    {!! $products->links() !!}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->

@endsection
