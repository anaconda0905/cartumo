@extends('layouts.admin')

@section('title', 'User Marketplace')

@section('styles')
    {!! Html::style('backend/css/custom.css') !!}
@endsection

@section ('content')




                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                User Marketplace
                                <small>all user's marketplace</small>
                            </h1>
                            <ol class="breadcrumb">
                                <li>
                                    <i class="fa fa-dashboard"></i>  <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>

                                <li class="active">
                                    <i class="fa fa-file"></i> Marketplace
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
                            <div class="pull-left">
                                <a href="{{ route('admin.user-marketplace.create') }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add Funnel to Marketplace</a>
                            </div>

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
                                            <th>ID</th>
                                            <th>Funnel</th>
                                            <th>User</th>
                                            <th>Date Added</th>
                                            <th>Status</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($data['userMarketplaces']) > 0)

                                            @foreach($data['userMarketplaces'] as $key => $marketplace)
                                                <tr>
                                                    <td>{{ $marketplace->id }}</td>
                                                    @if ( !empty($marketplace->funnel) )
                                                        <td>{{-- $marketplace->funnel->name --}}</td
                                                        >
                                                    @else
                                                        <td></td>
                                                    @endif

                                                    @if ( !empty($marketplace->funnel) )
                                                        <td>{{-- $marketplace->user->name --}}</td> 
                                                    @else
                                                        <td></td>
                                                    @endif

                                                    <td>{{ date('D M, Y' , strtotime($marketplace->updated_at)) }}</td>
                                                    <td>
                                                        @if ( $marketplace->status )
                                                            <span class="label label-success">Enabled</span>
                                                        @else
                                                            <span class="label label-default">Disabled</span>
                                                        @endif
                                                    </td>

                                                    <td class="text-right">
                                                        <!--<a href="#"  class="btn btn-flat">Add member</a> |-->
                                                        <!--<a href="{{ route('admin.user-marketplace.show', $marketplace->id) }}" data-user-id="{{ $marketplace->id }}" class="btn btn-default"><i class="fa fa-eye" aria-hidden="true"></i></a>-->
                                                        <a href="{{ route('admin.user-marketplace.edit', $marketplace->id) }}" data-funnel-id="{{-- $marketplace->funnel->id }}" data-user-id="{{ $marketplace->id --}}" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                        <button type="button" data-user-id="{{ $marketplace->id }}" class="btn btn-danger vs"><i class="fa fa-times" aria-hidden="true"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6">
                                                    No funnels yet.
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                    </div>

                    <div class="row text-center">
                        {!! $data['userMarketplaces']->links() !!}
                    </div>


                </div>


@endsection


@section('scripts')
<script>
    $(document).on('click', '.user-marketplace-remove', function(e) {

        e.preventDefault();

        var row = $(this).parent().parent();

        if ( confirm("Are you sure to remove the funnel from user's marketplace?") ) {
            $.ajax({
                type: 'DELETE',
                url: $("#hid_base_url").val() + '/admin/user-marketplace/' + $(this).attr('data-user-marketplace-id'),
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