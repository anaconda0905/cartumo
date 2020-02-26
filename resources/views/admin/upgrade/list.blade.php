@extends('layouts.admin')

@section('title', 'Feature Upgrade')

@section('styles')
    {!! Html::style('backend/css/custom.css') !!}
@endsection

@section ('content')




                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                Upgrades
                                <small>All Upgrades</small>
                            </h1>
                            <ol class="breadcrumb">
                                <li>
                                    <i class="fa fa-dashboard"></i>  <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>

                                <li class="active">
                                    <i class="fa fa-file"></i> Feature Upgrade
                                </li>
                            </ol>


                            @if (session('status'))
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Success!</strong> {{ session('status') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <div class="col-lg-12">
                            <!--<div class="pull-left">
                                <a href="{{ route('admin.feature-upgrade.create') }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add New User</a>
                            </div>-->

                            <form class="form-inline text-right" role="form">
                                <div class="form-group">
                                    <label for="search">Search:</label>
                                    <input type="search" class="form-control" id="search" name="search" value="{{ (!empty($data['search'])) ? $data['search'] : '' }}">
                                    <button type="submit" class="btn btn-default">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <br />

                    <div class="row">
                        <div class="table-responsive col-md-12">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($data['feature_upgrades']) > 0)

                                            @foreach($data['feature_upgrades'] as $key => $upgrade)
                                                <tr>                                                    
                                                    <td>{{ $upgrade->name }}</td>
                                                    <td>{{ $upgrade->type }}</td> 
                                                    <td>
                                                        @if ( $upgrade->status )
                                                            <span class="label label-success">Enabled</span>
                                                        @else
                                                            <span class="label label-default">Disabled</span>
                                                        @endif
                                                    </td>

                                                    <td class="text-right">
                                                        <!--<a href="#"  class="btn btn-flat">Add member</a> |-->
                                                        <a href="{{ route('admin.upgrade.users.create', $upgrade->id) }}" data-upgrade-id="{{ $upgrade->id }}" class="btn btn-default"><i class="fa fa-user" aria-hidden="true"></i></a>
                                                        <a href="{{ route('admin.feature-upgrade.edit', $upgrade->id) }}" data-upgrade-id="{{ $upgrade->id }}" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                        <button type="button" data-upgrade-id="{{ $upgrade->id }}" class="btn btn-danger user-remove"><i class="fa fa-times" aria-hidden="true"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6">
                                                    No feature upgrade yet.
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                    </div>

                    <div class="row text-center">
                        {!! $data['feature_upgrades']->links() !!}
                    </div>


                </div>


@endsection


@section('scripts')
<script>
    $(document).on('click', '.user-remove', function(e) {

        e.preventDefault();

        var row = $(this).parent().parent();

        if ( confirm("Are you sure to delete the user?") ) {
            $.ajax({
                type: 'DELETE',
                url: $("#hid_base_url").val() + '/admin/user/' + $(this).attr('data-user-id'),
                data: "_token={{ csrf_token() }}",
                beforeSend: function() {
                    $(row).css('opacity', '0.50');
                },
                success: function(response) {
                    console.log(response);

                    var json = JSON.parse(response);

                    if ( json.status == 'success' ) {
                        $(row).remove();
                    }
                }
            });
        }
    });
</script>
@endsection