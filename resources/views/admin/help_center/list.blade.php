@extends('layouts.admin')

@section('title', 'Help Center Topics')

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
                        Help Center Topics
                        <small>All Topics</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>

                        <li class="active">
                            <i class="fa fa-file"></i> Help Center Topics
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
                        <a href="{{ route('admin.help-center.create') }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add New Topic</a>
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
                                                <th>Category</th>
                                                <th>Status</th>
                                                <th>Actions</th> 
                                            </tr>
                                </thead>
                                <tbody>
                                        @if ( count($helpTopics) > 0 )
                                            @foreach($helpTopics as $helpTopic)
                                                <tr>
                                                    <td>
                                                        {{ $helpTopic->id }}
                                                    </td>
    
                                                    <td>
                                                        {{ $helpTopic->title }}
                                                    </td>
    
                                                    <td>
                                                        {{ $helpTopic->category->title }}
                                                    </td>
    
                                                    <td>
                                                        @if($helpTopic->status == 1)
                                                            <span class="label label-success label-mini spn-status" help-id="{{ $helpTopic->id }}">Active</span>
                                                        @else
                                                            <span class="label label-danger label-mini spn-status" help-id="{{ $helpTopic->id }}">Inactive</span>
                                                        @endif       
                                                    </td>
    
                                                    <td>
                                                        <label title="Change Status" class="switch">                                                        
                                                            <div class="slider round switch-status" help-id="{{ $helpTopic->id }}"></div>
                                                        </label>    
                                                        
                                                        <a title="Edit" class="btn btn-success" href="{{ route('admin.help-center.edit', [$helpTopic->id]) }}"><i class="fa fa-pencil"></i></a>
                                                        <button type="button" title="Delete" data-action="{{ route('admin.help-center.destroy', [$helpTopic->id]) }}" class="btn btn-danger remove_topic"><i class="fa fa-trash-o"></i></abutton> 
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                                <tr>
                                                    <td colspan="5">No topics</td>
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

        $(".remove_topic").click(function(e) {

            e.preventDefault();
            var row = $(this).parent().parent();

            if ( confirm("Are you sure to delete the topic?") ) {

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