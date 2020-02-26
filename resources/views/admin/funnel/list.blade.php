@extends('layouts.admin')

@section('title', 'Funnels')

@section('styles')
    {!! Html::style('backend/css/custom.css') !!}
@endsection

@section ('content')




    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Funnels
                <small>All funnels</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>

                <li class="active">
                    <i class="fa fa-file"></i> Funnels
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
        <div class="table-responsive col-md-12">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>User</th>
                    <th>Steps</th>
                    <th>Sales</th>
                    <th class="text-right">Action</th>
                </tr>
                </thead>
                <tbody>
                @if(count($funnels) > 0)

                    @foreach($funnels as $key => $funnel)
                        <tr>
                            <td>{{ $funnel->id }}</td>
                            <td>{{ $funnel->name }}</td>
                            <td>
                                @if ( !empty($funnel->user) )
                                    {{ $funnel->user->name }}
                                @endif
                            </td>
                            <td>{{ $funnel->steps->count() }}</td>

                            <td></td>

                            <td class="text-right">
                                <a href="{{ route('admin.funnels.show', $funnel->id) }}"
                                   data-funnel-id="{{ $funnel->id }}" class="btn btn-default"><i class="fa fa-eye"
                                                                                                 aria-hidden="true"></i></a>

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
        {!! $funnels->links() !!}
    </div>


    </div>


@endsection


@section('scripts')
    <script>
        $(document).on('click', '.user-remove', function (e) {

            e.preventDefault();

            var row = $(this).parent().parent();

            if (confirm("Are you sure to delete the user?")) {
                $.ajax({
                    type: 'DELETE',
                    url: $("#hid_base_url").val() + '/admin/user/' + $(this).attr('data-user-id'),
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