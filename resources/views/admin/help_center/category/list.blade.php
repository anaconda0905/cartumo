@extends('layouts.admin')

@section('title', 'Help Center Categories')

@section('styles')
    {!! Html::style('backend/css/custom.css') !!}
@endsection

@section ('content')

<section id="main-content">
    <section class="wrapper wrapper-area">

        @include('admin.elements.notifications')

        <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Help Center Categories
                        <small>All Categories</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>

                        <li class="active">
                            <i class="fa fa-file"></i> Help Center Categories
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

        <!-- page start-->
        <div class="row">
                <div class="col-lg-12">
                    <div class="pull-left">
                        <a href="{{ route('admin.help-center.categories.create') }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add New User</a>
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
                                                <th>ID#</th>
                                                <th>Title</th>
                                                <th>Position</th>
                                                <th>Status</th>
                                                <th>Actions</th> 
                                            </tr>
                                </thead>
                                <tbody>
                                        @if ( count($helpCategories) > 0 )
                                            @foreach($helpCategories as $helpCategory)
                                                <tr>
                                                    <td>
                                                        {{ $helpCategory->id }}
                                                    </td>
    
                                                    <td>
                                                        {{ $helpCategory->title }}
                                                    </td>
    
                                                    <td>
                                                        {{ $helpCategory->position }}
                                                    </td>
    
                                                    <td>
                                                        @if($helpCategory->status == 1)
                                                            <span class="label label-success label-mini spn-status" help-id="{{ $helpCategory->id }}">Active</span>
                                                        @else
                                                            <span class="label label-danger label-mini spn-status" help-id="{{ $helpCategory->id }}">Inactive</span>
                                                        @endif       
                                                    </td>
    
                                                    <td>
                                                        <label title="Change Status" class="switch">                                                        
                                                            <div class="slider round switch-status" help-id="{{ $helpCategory->id }}"></div>
                                                        </label>
    
                                                        <a title="Edit" class="btn btn-success" href="{{ route('admin.help-center.categories.edit', [$helpCategory->id]) }}"><i class="fa fa-pencil"></i></a>
                                                        <button type="button" title="Delete" data-action="{{ route('admin.help-center.categories.destroy', [$helpCategory->id]) }}" class="btn btn-danger remove_category"><i class="fa fa-trash-o"></i></button> 
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                                <tr>
                                                    <td colspan="5">No Categories</td>
                                                </tr>
                                        @endif
                                    </tbody>
                            </table>
                        </div>

                        <div class="row text-center">
                        
                        </div>

                </div>        
    </section>
</section>


@endsection   

@section('scripts')
<script type="text/javascript">
    
    $(document).ready(function() {

        $(".remove_category").click(function(e) {

            e.preventDefault();
            var row = $(this).parent().parent();

            if ( confirm("Are you sure to delete the category?") ) {

                $.ajax({
                    type: 'delete',
                    url: $(this).attr('data-action'),
                    data: "_token={{ csrf_token() }}",
                    beforeSend: function() {
                        $(row).css('opacity', '0.50');
                    },
                    success: function(response) {
                        var json = JSON.parse(response);
                        if ( json.status == 'success' ) {
                            $(row).remove();
                        }
                    }
                });
            }
        });
    });

</script>
@endsection
