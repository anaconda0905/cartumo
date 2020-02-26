@extends('layouts.admin')

@section('title', 'Developers')

@section('styles')
    {!! Html::style('backend/css/custom.css') !!}
@endsection

@section ('content')




                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                    Developers
                                <small>All Developers</small>
                            </h1>
                            <ol class="breadcrumb">
                                <li>
                                    <i class="fa fa-dashboard"></i>  <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>

                                <li class="active">
                                    <i class="fa fa-file"></i> Developers
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
                                <a href="{{ route('admin.developer.create') }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add New Developer</a>
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
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Number of Templates</th>
                                            <th>Status</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($data['developers']) > 0)

                                            @foreach($data['developers'] as $key => $developer)
                                                <tr>
                                                    <td>{{ $developer->id }}</td>
                                                    <td>{{ $developer->name }}</td>
                                                    <td>{{ $developer->email }}</td>
                                                    
                                                    <td>{{ $developer->templates->count() }}</td>

                                                    <td>
                                                        @if ( $developer->status )
                                                            <span class="label label-success">Enabled</span>
                                                        @else
                                                            <span class="label label-default">Disabled</span>
                                                        @endif
                                                    </td>

                                                    <td class="text-right">
                                                        <!--<a href="#"  class="btn btn-flat">Add member</a> |-->
                                                        <a href="{{ route('admin.developer.show', $developer->id) }}" data-user-id="{{ $developer->id }}" class="btn btn-default"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                        <a href="{{ route('admin.developer.edit', $developer->id) }}" data-user-id="{{ $developer->id }}" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                        <button type="button" data-developer-id="{{ $developer->id }}" class="btn btn-danger developer-remove"><i class="fa fa-times" aria-hidden="true"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6">
                                                    No developer yet.
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                    </div>

                    <div class="row text-center">
                        {!! $data['developers']->links() !!}
                    </div>


                </div>


@endsection


@section('scripts')
<script>
    $(document).on('click', '.developer-remove', function(e) {

        e.preventDefault();

        var row = $(this).parent().parent();

        if ( confirm("Are you sure to delete the developer?") ) {
            $.ajax({
                type: 'DELETE',
                url: $("#hid_base_url").val() + '/admin/developer/' + $(this).attr('data-developer-id'),
                data: "_token={{ csrf_token() }}",
                beforeSend: function() {
                    $(row).css('opacity', '0.50');
                },
                success: function(response) {
                    console.log(response);

                    var json = JSON.parse(response);

                    if ( json.status == 'success' ) {
                        $(row).remove();
                    } else {
                        alert(json.message);
                    }
                }
            });
        }
    });
</script>
@endsection