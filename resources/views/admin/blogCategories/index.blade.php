@extends('admin.layouts.master')

@section("title", "Steller Winds")

@section('content') 

<style type="text/css">

    .btn-row{
        margin-bottom:10px;
    }

    .panel-body a.btn-blue {
        background-color: #0099ff;
        color: #fff;
    } 

</style>

<?php
    $resourceName = "Blog Category";
?>
@include('admin.elements.modal-delete')

<!-- Modal -->
<div id="modalAddCategory" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
            <h4 class="modal-title">Add Blog Category</h4>
        </div>
        <div class="modal-body">
            <p>
                <form method="post" action="{{ route('admin.blog-categories.store') }}">
                    {{ csrf_field() }}
                    <div class="form-group ">
                        <label>Category Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Blog Category">
                        {!! $errors->first('name', '<span class="help-block red">:message</span>') !!}
                    </div>
                    <button type="submit" class="btn btn-success" id="btnDelete" style="margin-right:15px;">Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </form>
            </p>
        </div>
        <!-- <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div> -->
    </div>

  </div>
</div>

<section id="main-content">
    <section class="wrapper wrapper-area">

        @include('admin.elements.notifications')

        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h3>Blog Categories Listing</h3>
                    </header>
                    <div class="panel-body">
                        <div class="btn-row">
                            <a href="#" id="editable-sample_new" class="btn btn-blue " data-toggle="modal" data-target="#modalAddCategory">
                                Add New <i class="fa fa-plus"></i>
                            </a>
                        </div>
                        <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>No. of Blogs</th>
                                        <th>Created at</th>
                                        <th>Action</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($blogCategories as $blogCategory)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $blogCategory->name }}
                                            </td>
                                            <td>
                                                0    
                                            </td>
                                            <td>
                                                {{ date('M d, Y H:i', strtotime($blogCategory->created_at)) }}
                                            </td>
                                            <td>
                                                <a class="btn btn-success btn-xs" href="{{ route('admin.blog-categories.edit', [$blogCategory->id]) }}"><i class="fa fa-pencil"></i></a>

                                                <a href="{{ route('admin.blog-categories.destroy', [$blogCategory->id]) }}" class="btn btn-danger btn-xs btn-confirm-delete"><i class="fa fa-trash-o"></i></a> 
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

        blogId = $(this).attr('blog-id');

        $.ajax({
            type : 'post',
            url  : '{{ route("admin.ajax-switch") }}',
            data : {
                '_token' : '{{ csrf_token() }}',
                'id'     : blogId
            },
            dataType : 'json',

            success : function(response){
                
                if(response.success)
                {
                    span   = $(".spn-status[blog-id=" + blogId + "]");
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

    });

    $(".btn-confirm-delete").on('click', function(e){

        e.preventDefault();
        href = $(this).attr('href');
        $("#frmDelete").attr('action', href);
        $("#modalDelete").modal("show");

    });

</script>

@endsection      
