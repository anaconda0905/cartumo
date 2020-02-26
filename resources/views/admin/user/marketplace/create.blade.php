@extends('layouts.admin')

@section('title', 'Add Funnel to Marketplace')

@section('styles')
    {!! Html::style('backend/css/custom.css') !!}
    <style>
        .btn-submit-form {
            margin-top: 15px;
        }

        .list_funnels {
            /*padding: 15px;*/
            border: 1px solid #ddd;
            max-height: 450px;
            overflow: auto
        }
        .list_funnels table {
            list-style-type: none;
            padding: 0px;
        }

        .user_list {

        }
        .user_list #search_popup {
            border: 1px solid #eee;
            padding: 0px;
        }
        .user_list #search_popup ul {
            list-style-type: none;
            padding: 0px;
        }
        .user_list #search_popup ul > li {
            padding: 15px;
        }

        .user-marketplace-table {
            width: 100%;
            border: 2px solid #eee;
            max-height: 450px;
            overflow: auto
        }
        .user-marketplace-table td {
            padding: 15px;
        }
        .user-marketplace-table td:first-child {
            font-weight: 600;
        }
    </style>
@endsection


@section ('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                New Marketplace Funnel
                <small>Add new marketplace funnel</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="{{ route('dashboard.index') }}">Dashboard</a>
                </li>
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="{{ route('admin.user-marketplace.index') }}">User</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> New Marketplace Funnel
                </li>
            </ol>
        </div>
    </div>

    @if(!empty($errors))
        @foreach($errors->all() as $error)
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <strong>Error!</strong> {{ $error }}
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    <div class="row">

        {!! Form::open(array('route' => 'admin.user-marketplace.store', 'class' => 'clearfix')) !!}
            {{ csrf_field() }}
            <div class="col-md-6">
                <h3>Users</h3>
                <div class="user_list">
                    <input type="search" id="search_textbox" name="keyword" placeholder="Enter user name here..." class="form-control" />
                    <div class="search-popup" id="search_popup"></div>
                    <div class="marketplace_list_add" id="marketplace_list_add"></div>
                </div>
            </div>

            <div class="col-md-6">                    
                <div class="form-group">
                    <div class="search-list">
                        <!--<input type="text" name="keyword_funnel" placeholder="Enter funnel name" id="search_funnel" />-->
                        <h3>Funnels</h3>
                        <div class="list_funnels" id="list_funnels">
                            <table class="table table-bordered">
                                <thead>
                                    <tr><th></th><th>Name</th> <th>Type</th></tr>
                                </thead>
                                @foreach ( $data['funnels'] as $funnel )
                                    <tr>
                                        <td><input type="checkbox" name="marketplace_funnels[]" id="funnel_{{ $funnel->id }}" value="{{ $funnel->id }}" /></td>
                                        <td>
                                            <label for="funnel_{{ $funnel->id }}">
                                                &nbsp; {{ $funnel->name }} &nbsp;
                                            </label>
                                        </td>
                                        <td><small>({{ $funnel->type }})</small></td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            
        {!! Form::close() !!}

    </div>

@endsection


@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.0/parsley.min.js"></script>
    <script>
        $('form').parsley();

        //$("#search_user_list").keyup(function(e) {

            $(document).on('keyup', '#search_textbox', function(e) {

                if ( $(this).val().length > 0 ) {
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('admin.user.list') }}",
                        data: "_token={{ csrf_token() }}&keyword=" + $(this).val(),
                        beforeSend: function() {
                            $("#search_popup").html('<img style="margin:auto" src="{{ asset('images/ajax-loader.gif') }}" />');
                            $("#search_popup").show();
                        },
                        success: function(response) {
                            console.log(response);

                            var json = JSON.parse(response);

                            if ( json.status == 'success' ) {
                                $("#search_popup").html(json.html);
                            }
                        },
                        error: function(a, b) {
                            console.log(a.responseText);
                        }
                    });
                } else {
                    $("#search_popup").hide();
                }
            });
        //});

        $(document).on("click", "#search_popup > .user-upgrade-choose-list > li input[type='checkbox']", function(e) {

            //e.preventDefault();

            //alert($(this).text());

            //if ( $(this).is(":checked") ) {
                $("#search_textbox").val($(this).attr('data-user-name'));
                $("#search_textbox").parent().find('#hid_user_marketplace_id').remove();
                $("#search_textbox").after("<input type='hidden' id='hid_user_marketplace_id' name='hid_user_marketplace_id' value='" + $(this).val() + "' />");

                $("#search_popup").hide();

                //refresh funnel list
                $.ajax({
                        type: 'GET',
                        url: "{{ route('admin.user-marketplace.create') }}",
                        data: "_token={{ csrf_token() }}&user_id=" + $(this).val() + '&action=ajax',                        
                        success: function(response) {
                            console.log(response);

                            var json = JSON.parse(response);

                            if ( json.status == 'success' ) {
                                $("#list_funnels").html(json.html);
                                $("#marketplace_list_add").html(json.marketplace);
                            }
                        },
                        error: function(a, b) {
                            console.log(a.responseText);
                        }
                });
            //}            
        });

        /////////////
        $(document).on('change', '#list_funnels td:first-child input[type="checkbox"]', function(e) {

            var funnel_id = $(this).val();
            var user_id = $("#hid_user_marketplace_id").val();
            var row = $(this).parent().parent();

            if ( $(this).is(':checked') ) {
                if ( $("#hid_user_marketplace_id").length > 0 ) {
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('admin.user-marketplace.store') }}",
                        data: "_token={{ csrf_token() }}&funnel_id=" + funnel_id + '&user_id=' + user_id + '&action=add',                        
                        success: function(response) {
                            console.log(response);

                            var json = JSON.parse(response);

                            if ( json.status == 'success' ) {
                                $(row).remove();

                                //list all marketplace funnels
                                $.ajax({
                                    type: 'GET',
                                    url: "{{ route('admin.user-marketplace.show', 0) }}",
                                    data: "_token={{ csrf_token() }}&user_id=" + user_id,                                    
                                    success: function(response) {
                                        console.log(response);

                                        var json = JSON.parse(response);

                                        if ( json.status == 'success' ) {
                                            $("#marketplace_list_add").html(json.html);
                                        }
                                    },
                                    error: function(a, b) {
                                        console.log(a.responseText);
                                    }
                                });
                            }
                        },
                        error: function(a, b) {
                            console.log(a.responseText);
                        }
                    });

                } else {
                    alert("Please choose a user first");
                }
            }
            
        });

        //remove funnel from user's marketplace
        $(document).on('click', '.user-marketplace-table tr > td:last-child > button', function(e) {

            var marketplace_id = $(this).attr('data-marketplace-id');
            var user_id = $(this).attr('data-user-id');
            var row = $(this).parent().parent();

            $.ajax({
                type: 'DELETE',
                url: "{{ route('admin.user-marketplace.destroy', 0) }}",
                data: "_token={{ csrf_token() }}&marketplace_id=" + marketplace_id,  
                beforeSend: function() {
                    $(row).css('opacity', '0.05');
                },                   
                success: function(response) {
                    console.log(response);

                    var json = JSON.parse(response);

                    if ( json.status == 'success' ) {
                        $(row).remove();

                        //refresh funnel list
                        $.ajax({
                                type: 'GET',
                                url: "{{ route('admin.user-marketplace.create') }}",
                                data: "_token={{ csrf_token() }}&user_id=" + user_id + '&action=ajax',                        
                                success: function(response) {
                                    console.log(response);

                                    var json = JSON.parse(response);

                                    if ( json.status == 'success' ) {
                                        $("#list_funnels").html(json.html);
                                        $("#marketplace_list_add").html(json.marketplace);
                                    }
                                },
                                error: function(a, b) {
                                    console.log(a.responseText);
                                }
                        });
                    }
                },
                error: function(a, b) {
                    console.log(a.responseText);
                }
            });
        });
    </script>
@endsection
