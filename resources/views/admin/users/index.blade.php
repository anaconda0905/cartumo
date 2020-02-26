@extends('admin.layouts.master')

@section("title", "Users")

@section('content') 

<style type="text/css">

    .btn-row{
        margin-bottom:10px;
    }

    .panel-body a.btn-blue {
        background-color: #0099ff;
        color: #fff;
    } 

    .wrapper-area {
    min-height: 710px;
}

</style>

<style>
    .switch {
      display: inline-block;
      height: 25px;
      position: relative;
      vertical-align: middle;
      width: 31px;
    }

    .switch input {display:none;}

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }

    .slider::before {
      background-color: white;
      bottom: 3px;
      content: "";
      height: 17px;
      left: 3px;
      position: absolute;
      transition: all 0.4s ease 0s;
      width: 13px;
    }

    input:checked + .slider {
      background-color: #2196F3;
    }

    input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
      -webkit-transform: translateX(12px);
      -ms-transform: translateX(12px);
      transform: translateX(12px);
    }

    /* Rounded sliders */
    .slider.round {
      border-radius: 34px;
    }

    .slider.round:before {
      border-radius: 50%;
    }
</style>

<?php
    $resourceName = "User";

?>

@include('admin.elements.modal-delete')

<section id="main-content">
    <section class="wrapper wrapper-area">

        @include('admin.elements.notifications')

        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h3>Users Listing</h3>
                    </header>
                    <div class="panel-body">
                        <div class="btn-row">
                            <a href="{{ route('admin.users.create') }}" id="editable-sample_new" class="btn btn-blue">
                                Add New <i class="fa fa-plus"></i>
                            </a>
                        </div>
                        <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Email</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Status</th>
                                        <th>Actions</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>

                                            <td>
                                                <a title="View" href="{{ route('admin.users.show', [$user->id]) }}">
                                                    {!! $user->email !!}
                                                </a>
                                            </td>

                                            <td>
                                                {!! $user->first_name !!}
                                            </td>

                                            <td>
                                                {!! $user->last_name !!}
                                            </td>

                                            <td>
                                                @if($user->status == 1)
                                                    <span class="label label-success label-mini spn-status" user-id="{{ $user->id }}">Active</span>
                                                @else
                                                    <span class="label label-danger label-mini spn-status" user-id="{{ $user->id }}">Inactive</span>
                                                @endif       
                                            </td>

                                            <td>
                                                <label title="Change Status" class="switch">
                                                    <input type="checkbox" name="checkbox" {{ ($user->status==1) ? 'checked' : '' }}>
                                                    <div class="slider round switch-status" user-id="{{ $user->id }}"></div>
                                                </label>

                                                <a title="Edit" class="btn btn-success btn-xs" href="{{ route('admin.users.edit', [$user->id]) }}"><i class="fa fa-pencil"></i></a>

                                                <a title="Delete" href="{{ route('admin.users.destroy', [$user->id]) }}" class="btn btn-danger btn-xs btn-confirm-delete"><i class="fa fa-trash-o"></i></a> 
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </section>
                    </div>
                </section>
            </div>
        </div>
    </section>
</section>


<script type="text/javascript">
    
    $('.switch-status').on('click', function(){

        userId = $(this).attr('user-id');

        $.ajax({
            type : 'post',
            url  : '{{ route("admin.users-ajax-switch") }}',
            data : {
                '_token' : '{{ csrf_token() }}',
                'id'     : userId
            },
            dataType : 'json',

            success : function(response){
                
                if(response.success)
                {
                    span   = $(".spn-status[user-id=" + userId + "]");
                    status = span.html();
                    status = status.toLowerCase();

                    if( status == 'active' )
                    {
                        span.html("Inactive");
                        span.removeClass('label-success')
                        span.addClass('label-danger');
                    }
                    else if(status == 'inactive')
                    {
                        span.html("Active");
                        span.removeClass('label-danger')
                        span.addClass('label-success');
                    }
                }
            }
        });


    });


    $(".btn-confirm-delete").on('click', function(e){

        e.preventDefault();
        href = $(this).attr('href');
        $("#frmDelete").attr('action', href);
        $("#modalDelete").modal("show");

    });

</script>


@endsection      
