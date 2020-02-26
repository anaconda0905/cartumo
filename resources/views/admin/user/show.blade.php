@extends('layouts.admin')

@section('title', 'View User')

@section('styles')
    {!! Html::style('backend/css/custom.css') !!}
    <style>
        .btn-submit-form {
            margin-top: 15px;
        }

        .user-table {
            width: 100%;
        }
    </style>
@endsection


@section ('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                View user
                <small>view user details</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="{{ route('dashboard.index') }}">Dashboard</a>
                </li>
                <li>
                    <i class="fa fa-dashboard"></i> <a href="{{ route('admin.user.index') }}">User</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> View User
                </li>
            </ol>
        </div>
    </div>


    <div class="row">

        <div class="col-md-9">

            <table class="user-table">
                <tr>
                    <td>
                        <span>Name: </span>
                        <strong>{{ $data['user']->name }}</strong>
                    </td>

                    <td>
                        <span>Email Address: </span>
                        <strong>{{ $data['user']->email }}</strong>
                    </td>
                </tr>
            </table>

        </div>


        <div class="col-md-3">
        </div>

    </div>


    <div class="row">
        <div class="col-md-12">
            <hr/>

            <h4>Upgrades</h4>
            <table class="table table-bordered">
                <tr>
                    <th>Upgrade</th>
                    <th>Payment Status</th>
                    <th>Status</th>
                    <th class="text-right">Action</th>
                </tr>

                @if ( $data['user']->upgrades->count() > 0 )
                    @foreach ( $data['user']->upgrades as $upgrade )
                        <tr>
                            <td>{{ $upgrade->upgrade->name }}</td>
                            <td>{{ ($upgrade->payment_status) ? 'PAID' : 'NOT PAID' }}</td>
                            <td>{{ ($upgrade->upgrade->name) ? 'INSTALLED' : 'NOT INSTALLED' }}</td>
                            <td class="text-right">
                                <button type="button" data-user-upgrade-id="{{ $upgrade->id }}"
                                        class="btn btn-danger user-upgrade-remove"><i class="fa fa-times"
                                                                                      aria-hidden="true"></i></button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4">No Upgrade</td>
                    </tr>
                @endif
            </table>
        </div>
    </div>

@endsection


@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.0/parsley.min.js"></script>
    <script>
        $('form').parsley();
    </script>
    <script>
        $(document).on('click', '.user-upgrade-remove', function (e) {

            e.preventDefault();

            var row = $(this).parent().parent();

            if (confirm("Are you sure to delete the user upgrade?")) {
                $.ajax({
                    type: 'DELETE',
                    url: $("#hid_base_url").val() + '/admin/feature-upgrade/' + $(this).attr('data-user-upgrade-id') + "/users/{{ $data['user']->id }}",
                    data: "_token={{ csrf_token() }}",
                    beforeSend: function () {
                        $(row).css('opacity', '0.50');
                    },
                    success: function (response) {
                        console.log(response);

                        var json = JSON.parse(response);

                        if (json.status == 'success') {
                            $(row).remove();
                        }
                    }
                });
            }
        });
    </script>
@endsection
